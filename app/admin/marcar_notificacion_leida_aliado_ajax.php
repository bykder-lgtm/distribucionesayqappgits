<?php
/** * API para marcar notificaciones como leídas * Actualiza cod_estado y cod_estado_aviso a 1 */
include_once('../conexiones/conexione.php');
include_once('../admin/01_modulo_diseno_superior_visitante_intern_movil.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

header('Content-Type: application/json');

$respuesta = array('success' => false, 'message' => 'Error desconocido');
// Verificar que existe el cod_administrador de la sesión
if (!isset($cod_administrador) || empty($cod_administrador)) { $respuesta['message'] = 'Sesión no válida'; echo json_encode($respuesta); exit; }
// Obtener el ID de la notificación
$cod_notificacion = isset($_POST['cod_notificacion']) ? mysqli_real_escape_string($conectar, $_POST['cod_notificacion']) : '';

$sql_update = "UPDATE tbl15_notificacion_alerta_renovacion SET cod_estado = '1', cod_estado_aviso = '1' WHERE cod_notificacion_alerta_renovacion = '$cod_notificacion'";
if (mysqli_query($conectar, $sql_update)) {
    $respuesta['success'] = true;
    $respuesta['message'] = 'Notificación(es) marcada(s) como leída(s)';
    $respuesta['cod_notificacion_alerta_renovacion'] = $cod_notificacion;
    $respuesta['afectados'] = mysqli_affected_rows($conectar);
} else {
    $respuesta['message'] = 'Error al actualizar: ' . mysqli_error($conectar);
}
echo json_encode($respuesta);
?>
