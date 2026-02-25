<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
// Fallback para versiones de PHP menores a 5.6.0
if (!function_exists('hash_equals')) { function hash_equals($str1, $str2) { if (strlen($str1) != strlen($str2)) { return false; } else { $res = $str1 ^ $str2; $ret = 0; for ($i = strlen($res) - 1; $i >= 0; $i--) { $ret |= ord($res[$i]); } return !$ret; } } }
header('Content-Type: application/json; charset=utf-8');
// ============================================
// PROCESAMIENTO ESPECIAL DE FIRMA ALIADO
// ============================================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo json_encode(['success' => false, 'error' => 'Método no permitido']); exit; }
$token                                                              = isset($_POST['token']) ? trim($_POST['token']) : '';
$hash_seguridad                                                     = isset($_POST['hash']) ? trim($_POST['hash']) : '';
$base64_firma                                                       = isset($_POST['firma']) ? $_POST['firma'] : '';
if (empty($token) || empty($hash_seguridad) || empty($base64_firma)) { echo json_encode(['success' => false, 'error' => 'Datos incompletos']); exit; }
// 1. Buscar el documento
$sql_buscar = "SELECT f.cod_firma_digital_documento, f.cod_aliado_estrategico, f.fecha_creacion_registro_firma_digital_documento,
f.cod_estado_firma_signature, f.cod_estado, f.ip_maquina as ip_creador, a.nombres, a.apellidos FROM tbl15_firma_digital_documento f INNER JOIN tbl15_administrador a ON 
f.cod_aliado_estrategico = a.cod_administrador WHERE f.token_firma_digital_documento = ? AND f.cod_estado = 1";
$stmt = mysqli_prepare($conectar, $sql_buscar);
mysqli_stmt_bind_param($stmt, "s", $token);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) == 0) { echo json_encode(['success' => false, 'error' => 'Documento no encontrado o inactivo']); exit; }
$datos = mysqli_fetch_assoc($result);
// 2. Validar si ya fue firmado
if ($datos['cod_estado_firma_signature'] == 1) { echo json_encode(['success' => false, 'error' => 'Este documento ya ha sido firmado']); exit; }
// 3. Validar expiración (48 horas)
$fecha_creacion_ts                                                  = strtotime($datos['fecha_creacion_registro_firma_digital_documento']);
$fecha_expiracion_ts                                                = $fecha_creacion_ts + (48 * 3600);
if (time() > $fecha_expiracion_ts) { echo json_encode(['success' => false, 'error' => 'El enlace ha expirado']); exit; }
// 4. Validar Hash de seguridad
$datos_para_hash                                                    = $token . '|' . $datos['cod_aliado_estrategico'] . '|' . $fecha_expiracion_ts . '|' . $datos['ip_creador'];
$hash_calculado                                                     = hash_hmac('sha256', $datos_para_hash, SECRET_KEY);

if (!hash_equals($hash_calculado, $hash_seguridad)) { echo json_encode(['success' => false, 'error' => 'Error de autenticidad del enlace']); exit; }
// 5. Validar formato de firma
if (!preg_match('/^data:image\/(png|jpeg|jpg);base64,/', $base64_firma)) { echo json_encode(['success' => false, 'error' => 'Formato de firma no válido']); exit; }
// 6. Actualizar el registro
$fecha_firma                                                        = date('Y-m-d H:i:s');
$ip_firma                                                           = $_SERVER['REMOTE_ADDR'];
$nombre_maquina_firma                                               = gethostbyaddr($ip_firma);
$user_agent                                                         = $_SERVER['HTTP_USER_AGENT'];
$sql_upd = "UPDATE tbl15_firma_digital_documento SET base64_firma_digital_documento = ?, fecha_generacion_firma_digital_documento = ?, cod_estado_firma_signature = 1,
ip_maquina_firma = ?, nombre_maquina_firma = ?, nombre_navegador_firma = ? WHERE cod_firma_digital_documento = ?";
$stmt_upd = mysqli_prepare($conectar, $sql_upd);
mysqli_stmt_bind_param($stmt_upd, "sssssi", $base64_firma, $fecha_firma, $ip_firma, $nombre_maquina_firma, $user_agent, $datos['cod_firma_digital_documento']);

if (mysqli_stmt_execute($stmt_upd)) {
    // 7. Registrar en LOG
    $accion                                                         = "FIRMA_EXITOSA_ALIADO";
    $descripcion                                                    = "Firma realizada por ".$datos['nombres']." ".$datos['apellidos']." desde IP ".$ip_firma;
    $sql_log = "INSERT INTO tbl15_log_firma_digital (cod_firma_digital_documento, accion, ip_origen, user_agent, fecha_accion, descripcion) VALUES (?, ?, ?, ?, NOW(), ?)";
    $stmt_log = mysqli_prepare($conectar, $sql_log);
    mysqli_stmt_bind_param($stmt_log, "issss", $datos['cod_firma_digital_documento'], $accion, $ip_firma, $user_agent, $descripcion);
    mysqli_stmt_execute($stmt_log);
    echo json_encode(['success' => true, 'message' => 'Firma registrada correctamente']);
} else {
    echo json_encode(['success' => false, 'error' => 'Error al guardar la firma en la base de datos']);
}
mysqli_close($conectar);
?>
