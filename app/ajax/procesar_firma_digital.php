<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../gestor_administrar_msj_alerta_error/gestor_alerta_error.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

header('Content-Type: application/json');

// ============================================
// VALIDACIONES DE SEGURIDAD PARA PROCESAMIENTO DE FIRMA
// ============================================
// 1. Verificar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo json_encode(['error' => 'Método no permitido']); exit; }
// 2. Obtener y validar datos
$token = isset($_POST['token']) ? trim($_POST['token']) : '';
$hash_seguridad = isset($_POST['hash']) ? trim($_POST['hash']) : '';
$base64_firma = isset($_POST['firma']) ? $_POST['firma'] : '';
$ip_firmante = $_SERVER['REMOTE_ADDR'];
$user_agent_firmante = $_SERVER['HTTP_USER_AGENT'];
if (empty($token) || empty($hash_seguridad) || empty($base64_firma)) { echo json_encode(['error' => 'Datos incompletos para procesar la firma']); exit; }
// 3. Validar longitud del token (debe ser 64 caracteres)
if (strlen($token) !== 64) { echo json_encode(['error' => 'Token inválido']); exit; }
// 4. Rate Limiting por IP - Máximo 5 intentos en 10 minutos
$tiempo_limite_intentos = date('Y-m-d H:i:s', strtotime('-10 minutes'));
$sql_intentos = "SELECT COUNT(*) as total FROM tbl15_log_firma_digital WHERE ip_origen = ? AND fecha_accion > ? AND accion IN ('INTENTO_FIRMA', 'FIRMA_FALLIDA')";
$stmt_intentos = mysqli_prepare($conectar, $sql_intentos);
mysqli_stmt_bind_param($stmt_intentos, "ss", $ip_firmante, $tiempo_limite_intentos);
mysqli_stmt_execute($stmt_intentos);
$result_intentos = mysqli_stmt_get_result($stmt_intentos);
$row_intentos = mysqli_fetch_assoc($result_intentos);

if ($row_intentos['total'] >= 5) { echo json_encode(['error' => 'Demasiados intentos. Intente nuevamente en 10 minutos.']); exit; }

// 5. Buscar el documento de firma en la base de datos
$sql_buscar = "SELECT f.cod_firma_digital_documento, f.cod_aliado_estrategico, f.token_firma_digital_documento, f.url_zapsing_interno, f.fecha_creacion_registro_firma_digital_documento,
f.cod_estado_firma_signature, f.cod_estado, f.ip_maquina as ip_creador, a.nombres, a.apellidos, a.correo, a.telefono
FROM tbl15_firma_digital_documento f INNER JOIN tbl15_administrador a ON f.cod_aliado_estrategico = a.cod_administrador
WHERE f.token_firma_digital_documento = ? AND f.cod_estado = 1";
$stmt_buscar = mysqli_prepare($conectar, $sql_buscar);
mysqli_stmt_bind_param($stmt_buscar, "s", $token);
mysqli_stmt_execute($stmt_buscar);
$result_buscar = mysqli_stmt_get_result($stmt_buscar);

if (mysqli_num_rows($result_buscar) == 0) {
    // Registrar intento fallido
    $sql_log = "INSERT INTO tbl15_log_firma_digital (cod_firma_digital_documento, accion, ip_origen, user_agent, fecha_accion, descripcion) VALUES (0, 'INTENTO_FIRMA', ?, ?, NOW(), 'Token no encontrado')";
    $stmt_log = mysqli_prepare($conectar, $sql_log);
    mysqli_stmt_bind_param($stmt_log, "ss", $ip_firmante, $user_agent_firmante);
    mysqli_stmt_execute($stmt_log);
    echo json_encode(['error' => 'Documento de firma no encontrado o inválido']);
    exit;
}
$datos_firma = mysqli_fetch_assoc($result_buscar);
// 6. Validar que el documento no haya sido firmado ya (One-time use)
if ($datos_firma['cod_estado_firma_signature'] == 1) { echo json_encode(['error' => 'Este documento ya ha sido firmado']); exit; }

// 7. Validar expiración del token (48 horas desde creación)
$fecha_creacion = strtotime($datos_firma['fecha_creacion_registro_firma_digital_documento']);
$fecha_expiracion = $fecha_creacion + (48 * 3600); // 48 horas
$fecha_actual = time();

if ($fecha_actual > $fecha_expiracion) {
    // Marcar el documento como expirado
    $sql_expirar = "UPDATE tbl15_firma_digital_documento SET cod_estado = 0 WHERE cod_firma_digital_documento = ?";
    $stmt_expirar = mysqli_prepare($conectar, $sql_expirar);
    mysqli_stmt_bind_param($stmt_expirar, "i", $datos_firma['cod_firma_digital_documento']);
    mysqli_stmt_execute($stmt_expirar);
    
    echo json_encode(['error' => 'El link de firma ha expirado. Solicite uno nuevo.']);
    exit;
}

// 8. Validar hash HMAC del servidor (verificar que fue generado por el servidor legítimo)
$secret_server_key = SECRET_KEY;
$timestamp_creacion = strtotime($datos_firma['fecha_creacion_registro_firma_digital_documento']);
$timestamp_expiracion_calculado = $timestamp_creacion + (48 * 3600);
$datos_para_hash = $token . '|' . $datos_firma['cod_aliado_estrategico'] . '|' . $timestamp_expiracion_calculado . '|' . $datos_firma['ip_creador'];
$hash_calculado = hash_hmac('sha256', $datos_para_hash, $secret_server_key);

if (!hash_equals($hash_calculado, $hash_seguridad)) {
    // Registrar intento de firma con hash inválido (posible ataque)
    $sql_log = "INSERT INTO tbl15_log_firma_digital (cod_firma_digital_documento, accion, ip_origen, user_agent, fecha_accion, descripcion) 
    VALUES (?, 'FIRMA_FALLIDA', ?, ?, NOW(), 'Hash de seguridad inválido - Posible intento de suplantación')";
    $stmt_log = mysqli_prepare($conectar, $sql_log);
    mysqli_stmt_bind_param($stmt_log, "iss", $datos_firma['cod_firma_digital_documento'], $ip_firmante, $user_agent_firmante);
    mysqli_stmt_execute($stmt_log);
    echo json_encode(['error' => 'Hash de seguridad inválido. Documento no autorizado.']);
    exit;
}
// 9. Validar formato de la firma base64
if (!preg_match('/^data:image\/(png|jpeg|jpg);base64,/', $base64_firma)) { echo json_encode(['error' => 'Formato de firma inválido']); exit; }

// 10. Validar tamaño de la firma (máximo 500KB)
$firma_size = (strlen($base64_firma) * 3) / 4; // Aproximado del tamaño en bytes
if ($firma_size > 512000) { /*500KB*/ echo json_encode(['error' => 'La firma es demasiado grande. Máximo 500KB']); exit; }

// 11. Actualizar el registro con la firma
$fecha_firma = date('Y-m-d H:i:s');

$sql_actualizar = "UPDATE tbl15_firma_digital_documento SET base64_firma_digital_documento = ?, fecha_generacion_firma_digital_documento = ?, cod_estado_firma_signature = 1
WHERE cod_firma_digital_documento = ? AND cod_estado_firma_signature = 0";
$stmt_actualizar = mysqli_prepare($conectar, $sql_actualizar);
mysqli_stmt_bind_param($stmt_actualizar, "ssi", $base64_firma, $fecha_firma, $datos_firma['cod_firma_digital_documento']);

if (mysqli_stmt_execute($stmt_actualizar)) {
    if (mysqli_stmt_affected_rows($stmt_actualizar) > 0) {
        // 12. Registrar en log de auditoría
        $sql_log = "INSERT INTO tbl15_log_firma_digital (cod_firma_digital_documento, accion, ip_origen, user_agent, fecha_accion, descripcion) VALUES (?, 'FIRMA_EXITOSA', ?, ?, NOW(), ?)";
        $descripcion = "Firma realizada por " . $datos_firma['nombres'] . " " . $datos_firma['apellidos'];
        $stmt_log = mysqli_prepare($conectar, $sql_log);
        mysqli_stmt_bind_param($stmt_log, "isss", $datos_firma['cod_firma_digital_documento'], $ip_firmante, $user_agent_firmante, $descripcion);
        mysqli_stmt_execute($stmt_log);
        echo json_encode(['success' => true, 'mensaje' => 'Documento firmado exitosamente', 'cod_firma_digital_documento' => $datos_firma['cod_firma_digital_documento'], 'fecha_firma' => $fecha_firma, 'nombre_firmante' => $datos_firma['nombres'] . ' ' . $datos_firma['apellidos']]);
    } else {
        echo json_encode(['error' => 'El documento ya fue firmado o no existe']);
    }
} else {
    echo json_encode(['error' => 'Error al procesar la firma']);
}
mysqli_close($conectar);
?>
