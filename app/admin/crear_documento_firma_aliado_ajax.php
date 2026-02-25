<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no iniciada']); exit; }
$cod_aliado_estrategico                                             = isset($_POST['cod_aliado']) ? intval($_POST['cod_aliado']) : 0;
$cod_asesor                                                         = $_SESSION['cod_administrador'];
$cod_estado                                                         = 1;

if ($cod_aliado_estrategico <= 0) { echo json_encode(['success' => false, 'message' => 'Código de aliado no válido']); exit; }
// 1. Obtener datos del aliado y su jerarquía
// Se usa 'cedula' que es el nombre correcto de la columna en tbl15_administrador
$sql_aliado = "SELECT a.cod_administrador, a.nombres, a.apellidos, a.cedula as identificacion, a.correo, a.telefono,
a.cod_lider, a.cod_coordinador, a.cod_asesor as cod_asesor_actual, 
(SELECT cod_tienda FROM tbl15_tienda WHERE cod_aliado_estrategico = a.cod_administrador LIMIT 1) as cod_tienda
FROM tbl15_administrador a WHERE a.cod_administrador = '$cod_aliado_estrategico'";
$res_aliado = mysqli_query($conectar, $sql_aliado);
if (!$res_aliado) { echo json_encode(['success' => false, 'message' => 'Error SQL: ' . mysqli_error($conectar)]); exit; }
if (mysqli_num_rows($res_aliado) == 0) { echo json_encode(['success' => false, 'message' => 'Aliado no encontrado (ID: '.$cod_aliado_estrategico . ')']); exit; }
$aliado = mysqli_fetch_assoc($res_aliado);
// 2. Preparar datos para el registro
$nombre_tipo                                                        = "FIRMA ALIADO";
$origen                                                             = "ASESOR MOVIL";
// Generar Token compatible con versiones antiguas de PHP
if (function_exists('random_bytes')) { $token_firma_digital_documento = bin2hex(random_bytes(32)); } elseif (function_exists('openssl_random_pseudo_bytes')) { $token_firma_digital_documento = bin2hex(openssl_random_pseudo_bytes(32)); } else { $token_firma_digital_documento = hash('sha256', uniqid(mt_rand(), true) . microtime() . $_SERVER['REMOTE_ADDR']); }
$ip_maquina                                                         = $_SERVER['REMOTE_ADDR'];
$nombre_maquina                                                     = gethostbyaddr($ip_maquina);
$nombre_navegador                                                   = $_SERVER['HTTP_USER_AGENT'];
// Sincronizar fechas con la lógica de firma_digital_documento.php
$fecha_creacion_registro_firma_digital_documento                     = date('Y-m-d H:i:s');
$timestamp_creacion                                                 = strtotime($fecha_creacion_registro_firma_digital_documento);
$expiracion                                                         = $timestamp_creacion + (48 * 3600); // 48 horas
// 3. Generar Hash de Seguridad (siguiendo la lógica de firma_digital_documento.php)
$secret_server_key                                                  = SECRET_KEY;
$datos_para_hash                                                    = $token_firma_digital_documento.'|'.$cod_aliado_estrategico.'|'.$expiracion.'|'.$ip_maquina;
$hash_seguridad_servidor                                            = hash_hmac('sha256', $datos_para_hash, $secret_server_key);
// 4. Determinar jerarquía (priorizar la del aliado, sino la del asesor)
$cod_lider                                                          = $aliado['cod_lider'] ?: 0;
$cod_coordinador                                                    = $aliado['cod_coordinador'] ?: 0;
$cod_tienda                                                         = isset($_POST['cod_tienda']) && intval($_POST['cod_tienda']) > 0 ? intval($_POST['cod_tienda']) : ($aliado['cod_tienda'] ?: 0);
// 5. Insertar en la base de datos
$sql_ins = "INSERT INTO tbl15_firma_digital_documento (nombre_tipo_firma_digital, origen_firma_digital, token_firma_digital_documento, hash_seguridad_servidor, fecha_creacion_registro_firma_digital_documento, ip_maquina, nombre_maquina, nombre_navegador, cod_administrador, cod_aliado_estrategico, cod_tienda, cod_estado) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conectar, $sql_ins);
mysqli_stmt_bind_param($stmt, "ssssssssiiii", 
$nombre_tipo, $origen, $token_firma_digital_documento, $hash_seguridad_servidor, $fecha_creacion_registro_firma_digital_documento, $ip_maquina, $nombre_maquina, $nombre_navegador, $cod_asesor, $cod_aliado_estrategico, $cod_tienda, $cod_estado);
if (mysqli_stmt_execute($stmt)) {
    $cod_firma_digital_documento                                    = mysqli_insert_id($conectar);
    // Generar URL completa
    $protocol                                                       = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $host                                                           = $_SERVER['HTTP_HOST'];
    $uri                                                            = $_SERVER['REQUEST_URI'];
    $path                                                           = dirname($uri);
    $url_firma_digital_documento                                    = "$protocol://$host$path/firma_digital_aliado.php?token=$token_firma_digital_documento&hash=$hash_seguridad_servidor";
    // Guardar URL en el registro (opcional pero bueno para consistencia)
    mysqli_query($conectar, "UPDATE tbl15_firma_digital_documento SET url_firma_digital_documento = '$url_firma_digital_documento' WHERE cod_firma_digital_documento = '$cod_firma_digital_documento'");
    echo json_encode(['success' => true, 'message' => 'Documento de firma creado correctamente', 'url_firma_digital_documento' => $url_firma_digital_documento, 'token_firma_digital_documento' => $token_firma_digital_documento, 'hash_seguridad_servidor' => $hash_seguridad_servidor, 'aliado' => $aliado['nombres'].' '.$aliado['apellidos'], 'identificacion' => $aliado['identificacion'], 'correo' => $aliado['correo'], 'telefono' => $aliado['telefono']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar el registro: '.mysqli_error($conectar)]);
}
mysqli_close($conectar);
?>
