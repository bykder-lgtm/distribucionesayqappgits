<?php
// Endpoint para crear notificaciones de alerta
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); }
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

function sendJsonResponse($data) { echo json_encode($data); exit; }
try {
    if (!isset($conectar) || !$conectar) { sendJsonResponse(['success' => false, 'message' => 'Error de conexión a la base de datos']); }
    // Obtener parámetros
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? intval($_POST['cod_info_factura_venta']) : 0;
    $nombre_notificacion_alerta_renovacion = isset($_POST['nombre_notificacion_alerta_renovacion']) ? trim($_POST['nombre_notificacion_alerta_renovacion']) : '';
    $descipcion_notificacion_alerta_renovacion = isset($_POST['descripcion_notificacion_alerta_renovacion']) ? trim($_POST['descripcion_notificacion_alerta_renovacion']) : '';
    $cod_tipo_notificacion_alerta = isset($_POST['cod_tipo_notificacion_alerta']) ? intval($_POST['cod_tipo_notificacion_alerta']) : 1;
    // Validar parámetros obligatorios
    if ($cod_info_factura_venta <= 0) { throw new Exception('Código de factura de venta no válido'); }
    if (empty($descipcion_notificacion_alerta_renovacion)) { throw new Exception('La descripción de la notificación es requerida'); }
    //if (empty($nombre_notificacion_alerta_renovacion)) { throw new Exception('El nombre de la notificación es requerido'); }
    //if ($cod_tipo_notificacion_alerta <= 0) { throw new Exception('Debe seleccionar un tipo de notificación válido'); }
    
    $fecha_creacion                                   = date('Y-m-d H:i:s');
    $fecha                                            = date('Y-m-d');
    $fecha_mes                                        = date('Y-m');
    $anyo                                             = date('Y');
    $fecha_invert                                     = date('Y-m-d');
    $fecha_seg                                        = time();
    $cod_estado                                       = '0';
    $cod_estado_aviso                                 = '0';

    // Escapar strings para prevenir SQL injection
    $nombre_notificacion_alerta_renovacion            = mysqli_real_escape_string($conectar, $nombre_notificacion_alerta_renovacion);
    $descipcion_notificacion_alerta_renovacion        = mysqli_real_escape_string($conectar, $descipcion_notificacion_alerta_renovacion);

    // Obtener cod_administrador y cod_tienda de la factura si no están definidos
    // Se prioriza cod_administrador_aliado_estrategico para que aparezca en el módulo móvil del aliado
    $sql_factura = "SELECT cod_administrador, cod_administrador_aliado_estrategico, cod_tienda FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $consulta_factura = mysqli_query($conectar, $sql_factura);
    $datos_factura = mysqli_fetch_assoc($consulta_factura);
    
    $cod_administrador = !empty($datos_factura['cod_administrador_aliado_estrategico']) ? $datos_factura['cod_administrador_aliado_estrategico'] : $datos_factura['cod_administrador'];
    $cod_tienda = isset($datos_factura['cod_tienda']) ? $datos_factura['cod_tienda'] : 0;

    // Insertar la notificación en la base de datos
    $sql_insert = "INSERT INTO tbl15_notificacion_alerta_renovacion (cod_info_factura_venta, cod_administrador, cod_tienda, nombre_notificacion_alerta_renovacion, descipcion_notificacion_alerta_renovacion, 
    cod_tipo_notificacion_alerta, fecha_creacion, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_estado, cod_estado_aviso) 
    VALUES ('$cod_info_factura_venta', '$cod_administrador', '$cod_tienda', '$nombre_notificacion_alerta_renovacion', '$descipcion_notificacion_alerta_renovacion', 
    '$cod_tipo_notificacion_alerta', '$fecha_creacion', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_estado', '$cod_estado_aviso')";
    $resultado = mysqli_query($conectar, $sql_insert);
    if (!$resultado) { sendJsonResponse(['success' => false, 'message' => 'Error al guardar la notificación: ' . mysqli_error($conectar)]); }
    sendJsonResponse(['success' => true, 'message' => 'Notificación creada exitosamente']);
} catch (Exception $e) {
    sendJsonResponse(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>