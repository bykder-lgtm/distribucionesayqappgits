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

try {
    // Verificar que sea una petición POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') { throw new Exception('Método no permitido'); }
    // Verificar sesión activa
    if (!isset($_SESSION['cod_administrador'])) { throw new Exception('Sesión no válida'); }

    $cod_administrador                                             = $_SESSION['cod_administrador'];
    $cuenta                                                        = $_SESSION['usuario'];
    // Obtener y validar parámetros
    $cod_producto                                                  = isset($_POST['cod_producto']) ? (int)$_POST['cod_producto'] : 0;
    $cod_categoria                                                 = isset($_POST['cod_categoria']) ? (int)$_POST['cod_categoria'] : 0;
    $cod_producto_barra                                            = isset($_POST['cod_producto_barra']) ? trim($_POST['cod_producto_barra']) : '';
    $nombre_producto                                               = isset($_POST['nombre_producto']) ? trim($_POST['nombre_producto']) : '';
    $serial1_producto                                              = isset($_POST['serial1_producto']) ? trim($_POST['serial1_producto']) : '';
    $serial2_producto                                              = isset($_POST['serial2_producto']) ? trim($_POST['serial2_producto']) : '';
    $cod_info_factura_venta                                        = isset($_POST['cod_info_factura_venta']) ? (int)$_POST['cod_info_factura_venta'] : 0;
    $nombre_estado_factura                                         = isset($_POST['nombre_estado_factura']) ? trim($_POST['nombre_estado_factura']) : '';
    // Validaciones básicas
    if (!$cod_info_factura_venta) { throw new Exception('Código de factura requerido'); }
    if (empty($cod_producto_barra)) { throw new Exception('Código de barra requerido'); }
    if (empty($nombre_producto)) { throw new Exception('Nombre del producto requerido'); }
    // Validaciones específicas para celulares (categoría 2)
    //if ($cod_categoria == 2) { if (empty($serial1_producto)) { throw new Exception('IMEI 1 requerido para celulares'); } if (empty($serial2_producto)) { throw new Exception('IMEI 2 requerido para celulares'); } }
    // Determinar tabla de productos según estado de factura
    $tabla_productos_venta = ($nombre_estado_factura == 'ABIERTA') ? 'tbl15_venta_producto_temporal' : 'tbl15_venta_producto';
    // Verificar que el producto existe en la factura
    $sql_verificar = "SELECT cod_producto FROM $tabla_productos_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $resultado_verificar = mysqli_query($conectar, $sql_verificar);
    
    if (!$resultado_verificar || mysqli_num_rows($resultado_verificar) === 0) { throw new Exception('No se encontró el producto en esta factura o no tienes permisos para modificarlo'); }

    // Actualizar datos del producto
    $sql_actualizar = sprintf("UPDATE %s SET cod_producto_barra = '%s', nombre_producto = '%s', serial1_producto = '%s', serial2_producto = '%s' WHERE cod_info_factura_venta = '%s'",
        $tabla_productos_venta,
        mysqli_real_escape_string($conectar, $cod_producto_barra),
        mysqli_real_escape_string($conectar, $nombre_producto),
        mysqli_real_escape_string($conectar, $serial1_producto),
        mysqli_real_escape_string($conectar, $serial2_producto),
        intval($cod_info_factura_venta));
    $resultado_actualizar = mysqli_query($conectar, $sql_actualizar);

    if (!$resultado_actualizar) { throw new Exception('Error al actualizar el producto: ' . mysqli_error($conectar)); }
    // Verificar que se actualizó al menos una fila
    if (mysqli_affected_rows($conectar) === 0) { throw new Exception('No se realizaron cambios en el producto'); }
    // Construir string del producto actualizado para el frontend
    $sql_categoria = "SELECT nombre_categoria FROM tbl15_categoria WHERE cod_categoria = '$cod_categoria'";
    $consulta_categoria = mysqli_query($conectar, $sql_categoria);
    $datos_categoria = mysqli_fetch_assoc($consulta_categoria);
    $nombre_categoria = trim($datos_categoria['nombre_categoria']) ?: "No especificado";

    $producto_actualizado = '';
    if ($cod_categoria == 2) { // Celulares
        $producto_actualizado = $nombre_producto . ' | Categoria: ' . $nombre_categoria . ' [ Imei1: ' . $serial1_producto . ' - Imei2: ' . $serial2_producto . ' ]';
    } else {
        $producto_actualizado = $nombre_producto . ' | Categoria: ' . $nombre_categoria;
    }

    // Respuesta exitosa
    $respuesta = [
        'success' => true,
        'message' => 'Producto actualizado correctamente',
        'data' => [
            'cod_producto' => $cod_producto,
            'cod_producto_barra' => $cod_producto_barra,
            'nombre_producto' => $nombre_producto,
            'serial1_producto' => $serial1_producto,
            'serial2_producto' => $serial2_producto,
            'tabla_utilizada' => $tabla_productos_venta,
            'nombre_estado_factura' => $nombre_estado_factura
        ],
        'producto_actualizado' => $producto_actualizado,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    echo json_encode($respuesta);
} catch (Exception $e) {
    // Log del error
    error_log("Error en editar_producto_ajax.php: " . $e->getMessage());
    // Respuesta de error
    http_response_code(400);
    $respuesta = ['success' => false, 'message' => $e->getMessage(), 'timestamp' => date('Y-m-d H:i:s')];
    echo json_encode($respuesta);
} catch (Error $e) {
    // Capturar errores fatales también
    error_log("Error fatal en editar_producto_ajax.php: " . $e->getMessage());
    http_response_code(500);
    $respuesta = ['success' => false, 'message' => 'Error interno del servidor: ' . $e->getMessage(), 'timestamp' => date('Y-m-d H:i:s')];
    echo json_encode($respuesta);
}
?>