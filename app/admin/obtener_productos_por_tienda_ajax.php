<?php
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
// Recibir parámetros
$cod_tienda = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
// Inicializar respuesta
$response = array('success' => false, 'productos' => array());

if ($cod_tienda > 0) {
    // Consultar productos de tbl15_producto
    $consulta_sql = "SELECT cod_producto, cod_producto_barra, nombre_producto, precio_venta_producto, url_img_min_producto 
    FROM tbl15_producto WHERE cod_tienda = '$cod_tienda' AND active_producto = 'SI' ORDER BY nombre_producto ASC";
    $consulta = mysqli_query($conectar, $consulta_sql);
    
    if ($consulta) {
        while ($row = mysqli_fetch_assoc($consulta)) {
            $response['productos'][] = array('cod_producto' => $row['cod_producto'], 'nombre' => $row['nombre_producto'], 'codigo' => $row['cod_producto_barra'], 'precio' => $row['precio_venta_producto'], 'imagen' => $row['url_img_min_producto']);
        }
        $response['success'] = true;
    }
}
// Cerrar conexión
mysqli_close($conectar);
// Enviar respuesta JSON
echo json_encode($response);
?>
