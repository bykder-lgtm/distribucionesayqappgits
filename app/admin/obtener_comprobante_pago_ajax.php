<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include("../session/funciones_admin.php");
// Verificar sesión
if (!verificar_usuario()) { header('Content-Type: application/json'); echo json_encode(['success' => false, 'mensaje' => 'Sesión no válida']); exit; }
header('Content-Type: application/json');
// Verificar que se recibió el código del crédito
if (!isset($_POST['cod_info_factura_venta'])) { echo json_encode(['success' => false, 'mensaje' => 'Datos incompletos']); exit; }

$cod_info_factura_venta = intval($_POST['cod_info_factura_venta']);

// Primero intentar obtener de la tabla principal (créditos cerrados)
$sql = "SELECT url_img_orig_producto, nombre_estado_factura FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$result = mysqli_query($conectar, $sql);

$url_comprobante = '';

if (mysqli_num_rows($result) > 0) {
    $datos = mysqli_fetch_assoc($result);
    $url_comprobante = $datos['url_img_orig_producto'];
    $nombre_estado_factura = $datos['nombre_estado_factura'];
    // Si está en estado temporal, buscar en la tabla temporal
    if ($nombre_estado_factura == 'ABIERTA' && empty($url_comprobante)) {
        $sql_temporal = "SELECT url_img_orig_producto FROM tbl15_info_factura_venta_temporal WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
        $result_temporal = mysqli_query($conectar, $sql_temporal);
        
        if (mysqli_num_rows($result_temporal) > 0) {
            $datos_temporal = mysqli_fetch_assoc($result_temporal);
            $url_comprobante = $datos_temporal['url_img_orig_producto'];
        }
    }
}
if (!empty($url_comprobante)) {
    // Construir URL completa si es necesario
    if (!preg_match('/^http/', $url_comprobante)) { /*Si la URL no comienza con http, construir la ruta completa*/ $url_comprobante = '../' . $url_comprobante; }
    echo json_encode(['success' => true, 'url_comprobante' => $url_comprobante]);
} else {
    echo json_encode(['success' => false, 'mensaje' => 'No hay comprobante registrado']);
}
?>
