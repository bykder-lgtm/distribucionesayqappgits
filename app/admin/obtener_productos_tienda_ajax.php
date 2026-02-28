<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../session/funciones_admin.php');
header('Content-Type: application/json');

if (!verificar_usuario()) { echo json_encode(array('success' => false, 'message' => 'Sesión no válida')); exit; }
$cod_tienda = isset($_GET['cod_tienda']) ? intval($_GET['cod_tienda']) : 0;
if ($cod_tienda <= 0) { echo json_encode(array('success' => false, 'message' => 'Código de tienda inválido')); exit; }
// Obtener productos habilitados de la tienda
$sql = "SELECT cod_producto, nombre_producto, precio_venta_producto, url_img_min_producto, cod_producto_barra FROM tbl15_producto WHERE cod_tienda = '$cod_tienda' ORDER BY nombre_producto ASC";
$resultado = mysqli_query($conectar, $sql);
$productos = array();
if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Formatear precio para que sea amigable en el JSON
        $fila['precio_formateado'] = '$' . number_format($fila['precio_venta_producto'], 0, ',', '.');
        // Manejar imagen de producto
        if (empty($fila['url_img_min_producto']) || !file_exists($fila['url_img_min_producto'])) {
            $fila['url_img_min_producto'] = ''; // Placeholder manejado en JS
        }
        $productos[] = $fila;
    }
    echo json_encode(array('success' => true, 'productos' => $productos));
} else {
    echo json_encode(array('success' => false, 'message' => 'Error al consultar productos: ' . mysqli_error($conectar)));
}
mysqli_close($conectar);
?>
