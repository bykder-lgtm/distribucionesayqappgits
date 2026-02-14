<?php
// Obtener datos de un producto para editar
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");

if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

try {
    // Verificar que sea una petición GET
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') { throw new Exception('Método no permitido'); }
    // Verificar sesión activa
    if (!isset($_SESSION['cod_administrador'])) { throw new Exception('Sesión no válida'); }
    // Obtener código de producto
    $cod_producto = isset($_GET['cod_producto']) ? (int)$_GET['cod_producto'] : 0;
    if ($cod_producto <= 0) { throw new Exception('Código de producto no válido'); }
    // Consultar producto
    $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, cod_tienda, precio_compra_producto, precio_venta_producto, cod_categoria, 
    iva_ptj, descripcion_producto, cod_estado, nombre_estado, url_img_orig_producto, url_img_min_producto FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
    $resultado = mysqli_query($conectar, $sql_producto);
    if (!$resultado || mysqli_num_rows($resultado) == 0) { throw new Exception('Producto no encontrado'); }
    $producto = mysqli_fetch_assoc($resultado);
    // Respuesta exitosa
    $respuesta = ['success' => true, 'producto' => $producto, 'timestamp' => date('Y-m-d H:i:s')];
    echo json_encode($respuesta);
    
} catch (Exception $e) {
    error_log("Error en obtener_producto_catalogo_ajax.php: " . $e->getMessage());
    http_response_code(400);
    $respuesta = ['success' => false, 'mensaje' => $e->getMessage(), 'timestamp' => date('Y-m-d H:i:s')];
    echo json_encode($respuesta);
} catch (Error $e) {
    error_log("Error fatal en obtener_producto_catalogo_ajax.php: " . $e->getMessage());
    http_response_code(500);
    $respuesta = ['success' => false, 'mensaje' => 'Error interno del servidor', 'timestamp' => date('Y-m-d H:i:s')];
    echo json_encode($respuesta);
}
?>
