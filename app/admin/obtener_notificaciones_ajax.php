<?php
/** * API para obtener notificaciones pendientes del asesor * Filtra por cod_administrador de la sesión y cod_estado = 0 (no leídas) */
include_once('../conexiones/conexione.php');
include_once('../admin/01_modulo_diseno_superior_visitante_intern_movil.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

header('Content-Type: application/json');
$respuesta = array('success' => false, 'count' => 0, 'notificaciones' => array());
// Verificar que existe el cod_administrador de la sesión
if (!isset($cod_administrador) || empty($cod_administrador)) { echo json_encode($respuesta); exit; }
// Obtener notificaciones no leídas del asesor actual
$sql_notificaciones = "SELECT nar.cod_notificacion_alerta_renovacion, nar.nombre_notificacion_alerta_renovacion, nar.descipcion_notificacion_alerta_renovacion,
nar.cod_tipo_notificacion_alerta, nar.fecha_creacion, nar.fecha, nar.cod_estado, nar.cod_estado_aviso 
FROM tbl15_notificacion_alerta_renovacion nar LEFT JOIN tbl15_info_factura_venta ifv ON nar.cod_info_factura_venta = ifv.cod_info_factura_venta
WHERE (nar.cod_administrador = '$cod_administrador' OR ifv.cod_administrador_aliado_estrategico = '$cod_administrador' 
OR ifv.cod_administrador_asesor = '$cod_administrador') AND nar.cod_estado = '0' ORDER BY nar.fecha_creacion DESC LIMIT 20";
$consulta = mysqli_query($conectar, $sql_notificaciones);
if ($consulta) {
    $notificaciones = array();
    while ($row = mysqli_fetch_assoc($consulta)) {
        $notificaciones[] = array('id' => $row['cod_notificacion_alerta_renovacion'], 'titulo' => $row['nombre_notificacion_alerta_renovacion'], 'descripcion' => $row['descipcion_notificacion_alerta_renovacion'], 'tipo' => $row['cod_tipo_notificacion_alerta'], 'fecha' => $row['fecha_creacion'], 'fecha_corta' => date('d/m/Y H:i', strtotime($row['fecha_creacion'])));
    }
    $respuesta['success'] = true;
    $respuesta['count'] = count($notificaciones);
    $respuesta['notificaciones'] = $notificaciones;
}
echo json_encode($respuesta);
?>
