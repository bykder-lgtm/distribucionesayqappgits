<?php
// Endpoint para actualizar el estado de revisión de una imagen
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

$cod_administrador                                              = $_SESSION['cod_administrador'];
$cuenta                                                         = $_SESSION['usuario'];

try {
    // Verificar que sea una petición POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { throw new Exception('Método no permitido'); }
    // Verificar sesión activa
    if (!isset($_SESSION['cod_administrador'])) { throw new Exception('Sesión no válida'); }
    // Obtener y validar parámetros
    if (!isset($_POST['cod_info_factura_venta']) || empty($_POST['cod_info_factura_venta'])) { throw new Exception('Código de factura requerido'); }

    $cod_info_factura_venta = (int)$_POST['cod_info_factura_venta'];

    // Determinar tabla según estado de la factura
    $sql_estado = "SELECT nombre_estado_factura FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $resultado_estado = mysqli_query($conectar, $sql_estado);
    if (!$resultado_estado || mysqli_num_rows($resultado_estado) === 0) { throw new Exception('No se encontró la factura especificada'); }
    $datos_estado = mysqli_fetch_assoc($resultado_estado);
    $nombre_estado_factura = $datos_estado['nombre_estado_factura'];
    // Determinar tabla de productos
    $tabla_productos_venta = ($nombre_estado_factura == 'ABIERTA') ? 'tbl15_venta_producto_temporal' : 'tbl15_venta_producto';
    // Obtener datos del producto
    $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, serial1_producto, serial2_producto, cod_categoria 
                     FROM $tabla_productos_venta 
                     WHERE cod_info_factura_venta = '$cod_info_factura_venta' 
                     LIMIT 1";
    $resultado_producto = mysqli_query($conectar, $sql_producto);
    
    if (!$resultado_producto) { throw new Exception('Error en la consulta: ' . mysqli_error($conectar)); }
    if (mysqli_num_rows($resultado_producto) === 0) { throw new Exception('No se encontraron productos para esta factura'); }
    $producto = mysqli_fetch_assoc($resultado_producto);

    // Respuesta exitosa
    $respuesta = [
        'success' => true,
        'message' => 'Datos del producto obtenidos correctamente',
        'data' => [
            'cod_producto' => $producto['cod_producto'],
            'cod_producto_barra' => $producto['cod_producto_barra'],
            'nombre_producto' => $producto['nombre_producto'],
            'serial1_producto' => $producto['serial1_producto'],
            'serial2_producto' => $producto['serial2_producto'],
            'cod_categoria' => $producto['cod_categoria'],
            'tabla_utilizada' => $tabla_productos_venta,
            'nombre_estado_factura' => $nombre_estado_factura
        ]
    ];
    
    echo json_encode($respuesta);
    
} catch (Exception $e) {
    // Log del error
    error_log("Error en obtener_datos_producto_ajax.php: " . $e->getMessage());
    // Respuesta de error
    http_response_code(400);
    $respuesta = [
        'success' => false,
        'message' => $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s')
    ];
    echo json_encode($respuesta);
} catch (Error $e) {
    // Capturar errores fatales también
    error_log("Error fatal en obtener_datos_producto_ajax.php: " . $e->getMessage());
    
    http_response_code(500);
    $respuesta = [
        'success' => false,
        'message' => 'Error interno del servidor: ' . $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s')
    ];
    echo json_encode($respuesta);
}
?>