<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");

// Verificar sesión
if (!verificar_usuario()) { echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }
// Obtener parámetro
$cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']) : '';
if (empty($cod_info_factura_venta)) { echo json_encode(['success' => false, 'message' => 'No se proporcionó el código de factura']); exit; }
// Consultar notificaciones con JOIN para obtener el nombre del tipo
$sql = "SELECT nar.cod_notificacion_alerta_renovacion, nar.descipcion_notificacion_alerta_renovacion, nar.cod_tipo_notificacion_alerta, nar.fecha_creacion, nar.fecha_modificacion,
nar.cod_estado, tna.nombre_tipo_notificacion_alerta FROM tbl15_notificacion_alerta_renovacion nar LEFT JOIN tbl15_tipo_notificacion_alerta tna 
ON nar.cod_tipo_notificacion_alerta = tna.cod_tipo_notificacion_alerta WHERE nar.cod_info_factura_venta = '$cod_info_factura_venta' ORDER BY nar.fecha_creacion DESC";
$consulta = mysqli_query($conectar, $sql);
if (!$consulta) { echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . mysqli_error($conectar)]); exit; }
$notificaciones = array();
while ($fila = mysqli_fetch_assoc($consulta)) {
    $cod_estado = $fila['cod_estado'];
    if($cod_estado == '1') {
        $estado_leido = '<span class="badge" style="background: #48bb78; padding: 0.5rem 1rem; font-size: 0.9rem;">Si</span>';
    } else {
        $estado_leido = '<span class="badge" style="background: #718096; padding: 0.5rem 1rem; font-size: 0.9rem;">No</span>';
    }
    $notificaciones[] = array(
        'cod_notificacion_alerta_renovacion' => $fila['cod_notificacion_alerta_renovacion'],
        'descipcion_notificacion_alerta_renovacion' => $fila['descipcion_notificacion_alerta_renovacion'],
        'cod_tipo_notificacion_alerta' => $fila['cod_tipo_notificacion_alerta'],
        'fecha_creacion' => $fila['fecha_creacion'],
        'fecha_modificacion' => $fila['fecha_modificacion'],
        'cod_estado' => $cod_estado,
        'estado_leido' => $estado_leido,
        'nombre_tipo_notificacion_alerta' => $fila['nombre_tipo_notificacion_alerta']
    );
}
echo json_encode([
    'success' => true,
    'notificaciones' => $notificaciones,
    'total' => count($notificaciones)
]);
?>
