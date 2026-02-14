<?php
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
// Recibir parámetros
$cod_tienda = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
// Inicializar respuesta
$response = array('success' => false, 'productos' => array(), 'total' => 0);

if ($cod_tienda > 0) {
    // Consultar productos de la tienda
    $consulta_sql = "SELECT p.cod_producto, p.cod_producto_barra, p.nombre_producto, p.descripcion_producto, 
    p.precio_venta_producto, p.precio_venta_producto2, p.und_producto, p.nombre_estado, p.url_img_min_producto, p.url_img_orig_producto,
    c.nombre_categoria FROM tbl15_producto p 
    LEFT JOIN tbl15_categoria c ON p.cod_categoria = c.cod_categoria WHERE p.cod_tienda = '$cod_tienda' ORDER BY p.nombre_producto ASC LIMIT 50";
    $consulta = mysqli_query($conectar, $consulta_sql);
    
    if ($consulta && mysqli_num_rows($consulta) > 0) {
        while ($row = mysqli_fetch_assoc($consulta)) {

            $cod_producto                         = $row['cod_producto'];
            $cod_producto_barra                   = $row['cod_producto_barra'];
            $nombre_producto                      = $row['nombre_producto'];
            $descripcion_producto                 = $row['descripcion_producto'];
            $precio_venta_producto                = $row['precio_venta_producto'];
            $precio_venta_producto2               = $row['precio_venta_producto2'];
            $nombre_estado                        = $row['nombre_estado'];
            $url_img_min_producto                 = $row['url_img_min_producto'];
            $nombre_categoria                     = $row['nombre_categoria'];

            $response['productos'][] = array(
            'cod_producto' => $cod_producto, 'cod_producto_barra' => $cod_producto_barra, 'nombre_producto' => $nombre_producto, 'descripcion_producto' => $descripcion_producto, 
            'precio_venta' => number_format($precio_venta_producto, 0, ',', '.'), 'precio_credito' => number_format($precio_venta_producto2, 0, ',', '.'),
            'stock' => $und_producto, 'estado' => $nombre_estado, 'imagen' => !empty($url_img_min_producto) ? $url_img_min_producto : '../imagenes/no-image.png', 'categoria' => $nombre_categoria
            );
        }
        $response['success'] = true;
        $response['total'] = count($response['productos']);
    }
    // Contar total de productos
    $sql_count = "SELECT COUNT(*) as total FROM tbl15_producto WHERE cod_tienda = '$cod_tienda'";
    $result_count = mysqli_query($conectar, $sql_count);
    if ($result_count) { $count_data = mysqli_fetch_assoc($result_count); $response['total'] = $count_data['total']; }
}
// Cerrar conexión
mysqli_close($conectar);
// Enviar respuesta JSON
echo json_encode($response);
?>
