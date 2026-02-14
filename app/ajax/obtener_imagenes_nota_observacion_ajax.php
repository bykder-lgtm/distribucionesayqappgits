<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

// Recibir datos
$cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']) : '';
// Inicializar respuesta
$response = array('success' => false, 'imagen_cedula' => '', 'imagen_producto' => '');

if ($cod_info_factura_venta != '') {
    // Obtener imagen de cédula en mano
    $sql_cedula = "SELECT url_img_min_producto, url_img_orig_producto FROM tbl15_nota_observacion WHERE cod_info_factura_venta = '$cod_info_factura_venta' AND nombre_nota_observacion = 'FOTO DEL CLIENTE CON CEDULA EN MANO' ORDER BY cod_nota_observacion DESC LIMIT 1";
    $consulta_cedula = mysqli_query($conectar, $sql_cedula);
    if ($consulta_cedula && mysqli_num_rows($consulta_cedula) > 0) {
        $datos_cedula = mysqli_fetch_assoc($consulta_cedula);
        // Usar imagen miniatura si existe, sino la original
        $response['imagen_cedula'] = !empty($datos_cedula['url_img_min_producto']) 
            ? $datos_cedula['url_img_min_producto'] 
            : $datos_cedula['url_img_orig_producto'];
    }
    // Obtener imagen de producto como constancia de entrega
    $sql_producto = "SELECT url_img_min_producto, url_img_orig_producto FROM tbl15_nota_observacion WHERE cod_info_factura_venta = '$cod_info_factura_venta' AND nombre_nota_observacion = 'FOTO CON EL PRODUCTO COMO CONSTANCIA DE ENTREGA' ORDER BY cod_nota_observacion DESC LIMIT 1";
    $consulta_producto = mysqli_query($conectar, $sql_producto);
    if ($consulta_producto && mysqli_num_rows($consulta_producto) > 0) {
        $datos_producto = mysqli_fetch_assoc($consulta_producto);
        // Usar imagen miniatura si existe, sino la original
        $response['imagen_producto'] = !empty($datos_producto['url_img_min_producto']) 
            ? $datos_producto['url_img_min_producto'] 
            : $datos_producto['url_img_orig_producto'];
    }
    $response['success'] = true;
}
// Enviar respuesta JSON
echo json_encode($response);
?>
