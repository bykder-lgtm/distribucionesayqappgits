<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../gestor_administrar_msj_alerta_error/gestor_alerta_error.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

// ============================================
// VALIDACIONES DE SEGURIDAD
// ============================================
// 1. Verificar sesión
if (!isset($_SESSION['cod_administrador']) || $_SESSION['cod_administrador'] == null) { echo json_encode(['error' => 'Sesión no válida']); exit; }
// 2. Validar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo json_encode(['error' => 'Método no permitido']); exit; }
// 3. Validar Content-Type (protección contra CSRF básico)
$content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
if (strpos($content_type, 'application/x-www-form-urlencoded') === false && strpos($content_type, 'multipart/form-data') === false) { echo json_encode(['error' => 'Content-Type no válido']); exit; }

// 4. Validar origen del request (anti-clonación)
$allowed_origins = [$_SERVER['HTTP_HOST'], 'localhost', '127.0.0.1'];
$http_origin = isset($_SERVER['HTTP_ORIGIN']) ? parse_url($_SERVER['HTTP_ORIGIN'], PHP_URL_HOST) : '';
$http_referer = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) : '';

if (!empty($http_origin) && !in_array($http_origin, $allowed_origins)) { echo json_encode(['error' => 'Origen no autorizado']); exit; }
if (!empty($http_referer) && !in_array($http_referer, $allowed_origins)) { echo json_encode(['error' => 'Referer no autorizado']); exit; }

$cod_administrador = intval($_SESSION['cod_administrador']);

// 5. Rate Limiting: Verificar límite de solicitudes por administrador
$ip_cliente = $_SERVER['REMOTE_ADDR'];
$tiempo_limite = date('Y-m-d H:i:s', strtotime('-5 minutes'));

$sql_rate_limit = "SELECT COUNT(*) as total FROM tbl15_firma_digital_documento WHERE cod_administrador = ? AND ip_maquina = ? AND fecha_creacion_registro_firma_digital_documento > ?";
$stmt_rate = mysqli_prepare($conectar, $sql_rate_limit);
mysqli_stmt_bind_param($stmt_rate, "iss", $cod_administrador, $ip_cliente, $tiempo_limite);
mysqli_stmt_execute($stmt_rate);
$result_rate = mysqli_stmt_get_result($stmt_rate);
$row_rate = mysqli_fetch_assoc($result_rate);

if ($row_rate['total'] >= 10) { /*Máximo 10 solicitudes en 5 minutos*/ echo json_encode(['error' => 'Límite de solicitudes excedido. Intente en 5 minutos.']); exit; }

// Obtener datos del POST
$cod_aliado_estrategico_cryp = isset($_POST['cod_aliado_estrategico']) ? trim($_POST['cod_aliado_estrategico']) : '';
$nombre_tipo_firma_digital = 'Documentación Aliado';
$origen_firma_digital = 'aliado_estrategico';

if (empty($cod_aliado_estrategico_cryp)) { echo json_encode(['error' => 'Código de aliado no válido']); exit; }
// 6. Desencriptar el código del aliado
$cod_aliado_estrategico = intval(DAXCODIFCRYPTOR::descriptardax($cod_aliado_estrategico_cryp));
if ($cod_aliado_estrategico <= 0) { echo json_encode(['error' => 'Código de aliado no válido después de desencriptar']); exit; }

// 7. Validar que el aliado existe y pertenece al asesor
$sql_validar_aliado = "SELECT a.cod_administrador, a.nombres, a.apellidos, a.correo, a.telefono FROM tbl15_administrador a
WHERE a.cod_administrador = ? AND a.cod_asesor = (SELECT cod_asesor FROM tbl15_administrador WHERE cod_administrador = ?) AND a.cod_estado = 1";
$stmt_aliado = mysqli_prepare($conectar, $sql_validar_aliado);
mysqli_stmt_bind_param($stmt_aliado, "ii", $cod_aliado_estrategico, $cod_administrador);
mysqli_stmt_execute($stmt_aliado);
$result_aliado = mysqli_stmt_get_result($stmt_aliado);
if (mysqli_num_rows($result_aliado) == 0) { echo json_encode(['error' => 'Aliado no encontrado o no autorizado']); exit; }
$datos_aliado = mysqli_fetch_assoc($result_aliado);

// 8. Validar que no exista un token activo para este aliado (prevenir duplicados)
$sql_token_activo = "SELECT cod_firma_digital_documento FROM tbl15_firma_digital_documento WHERE cod_aliado_estrategico = ? AND cod_estado_firma_signature = 0 AND cod_estado = 1 AND fecha_creacion_registro_firma_digital_documento > DATE_SUB(NOW(), INTERVAL 48 HOUR)";
$stmt_token = mysqli_prepare($conectar, $sql_token_activo);
mysqli_stmt_bind_param($stmt_token, "i", $cod_aliado_estrategico);
mysqli_stmt_execute($stmt_token);
$result_token = mysqli_stmt_get_result($stmt_token);

if (mysqli_num_rows($result_token) > 0) { echo json_encode(['error' => 'Ya existe un documento de firma activo para este aliado']); exit; }
// Generar token único
$token_firma_digital_documento = bin2hex(random_bytes(32));
// 9. Generar hash HMAC del servidor (firma digital del servidor)
// Este hash valida que el documento fue generado por el servidor legítimo
$secret_server_key = SECRET_KEY; // Usando la misma secret_key del encriptador
$timestamp_expiracion = strtotime('+48 hours'); // Expira en 48 horas
$datos_para_hash = $token_firma_digital_documento . '|' . $cod_aliado_estrategico . '|' . $timestamp_expiracion . '|' . $ip_cliente;
$hash_seguridad_servidor = hash_hmac('sha256', $datos_para_hash, $secret_server_key);

// Obtener información de la máquina y navegador
$ip_maquina = $ip_cliente;
$nombre_maquina = gethostbyaddr($ip_maquina);
$nombre_navegador = mysqli_real_escape_string($conectar, $_SERVER['HTTP_USER_AGENT']);

// Obtener información del asesor (cod_asesor desde sesión) usando prepared statement
$sql_asesor = "SELECT cod_asesor, cod_tienda, cod_lider, cod_coordinador FROM tbl15_administrador WHERE cod_administrador = ?";
$stmt_asesor = mysqli_prepare($conectar, $sql_asesor);
mysqli_stmt_bind_param($stmt_asesor, "i", $cod_administrador);
mysqli_stmt_execute($stmt_asesor);
$result_asesor = mysqli_stmt_get_result($stmt_asesor);
$data_asesor = mysqli_fetch_array($result_asesor);

$cod_asesor = isset($data_asesor['cod_asesor']) ? intval($data_asesor['cod_asesor']) : 0;
$cod_tienda = isset($data_asesor['cod_tienda']) ? intval($data_asesor['cod_tienda']) : 0;
$cod_lider = isset($data_asesor['cod_lider']) ? intval($data_asesor['cod_lider']) : 0;
$cod_coordinador = isset($data_asesor['cod_coordinador']) ? intval($data_asesor['cod_coordinador']) : 0;

// Crear URL del documento
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
$script_path = dirname(dirname($_SERVER['PHP_SELF']));
$url_firma_digital_documento = $base_url . $script_path . '/admin/firma_digital_documento.php?token=' . urlencode($token_firma_digital_documento) . '&hash=' . urlencode($hash_seguridad_servidor);

// Fecha actual y fecha de expiración
$fecha_creacion_registro_firma_digital_documento = date('Y-m-d H:i:s');
$fecha_expiracion = date('Y-m-d H:i:s', $timestamp_expiracion);

// 10. Insertar registro en la base de datos con prepared statement (prevenir SQL injection)
$sql_insert = "INSERT INTO tbl15_firma_digital_documento (
nombre_tipo_firma_digital,
origen_firma_digital,
token_firma_digital_documento,
url_firma_digital_documento,
hash_seguridad_servidor,
url_documento_generado_firmado,
base64_firma_digital_documento,
base64_documento_digital_firmado,
fecha_creacion_registro_firma_digital_documento,
fecha_generacion_firma_digital_documento,
estado_sendgrid,
fecha_envio_sendgrid,
fecha_firma_sendgrid,
url_zapsing_interno,
url_documento_form_firmado,
url_documento_oferta_firmado,
url_documento_orden_compra_firmado,
ip_maquina,
nombre_maquina,
nombre_navegador,
cod_administrador,
cod_tienda,
cod_lider,
cod_coordinador,
cod_asesor,
cod_aliado_estrategico,
cod_vendedor,
cod_estado_firma_signature,
cod_estado) 
VALUES (?, ?, ?, ?, ?, '', '', '', ?, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 
?, '', '', '', ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0, 1)";
$stmt_insert = mysqli_prepare($conectar, $sql_insert);
mysqli_stmt_bind_param(
$stmt_insert,
"ssssssssssiiiiii",
$nombre_tipo_firma_digital, 
$origen_firma_digital, 
$token_firma_digital_documento, 
$url_firma_digital_documento, 
$hash_seguridad_servidor, 
$fecha_creacion_registro_firma_digital_documento, 
$hash_seguridad_servidor, 
$ip_maquina, 
$nombre_maquina, 
$nombre_navegador, 
$cod_administrador, 
$cod_tienda, 
$cod_lider, 
$cod_coordinador, 
$cod_asesor,
$cod_aliado_estrategico);
if (mysqli_stmt_execute($stmt_insert)) {
    $cod_firma_digital_documento = mysqli_insert_id($conectar);
    // Encriptar el token para el enlace (capa adicional de seguridad)
    $token_encrypted = DAXCODIFCRYPTOR::encriptardax($token_firma_digital_documento);
    // 11. Registrar en log de auditoría (opcional pero recomendado)
    $sql_log = "INSERT INTO tbl15_log_firma_digital (cod_firma_digital_documento, accion, ip_origen, user_agent, fecha_accion) VALUES (?, 'TOKEN_GENERADO', ?, ?, NOW())";
    if ($stmt_log = mysqli_prepare($conectar, $sql_log)) { mysqli_stmt_bind_param($stmt_log, "iss", $cod_firma_digital_documento, $ip_maquina, $nombre_navegador); mysqli_stmt_execute($stmt_log); mysqli_stmt_close($stmt_log); }
    echo json_encode(['success' => true, 'cod_firma_digital_documento' => $cod_firma_digital_documento, 'token' => $token_firma_digital_documento, 'token_encrypted' => $token_encrypted, 'url' => $url_firma_digital_documento, 'expira' => $fecha_expiracion, 'hash_seguridad' => $hash_seguridad_servidor]);
} else {
    echo json_encode(['error' => 'Error al crear el registro de firma digital']);
}
mysqli_close($conectar);
?>
