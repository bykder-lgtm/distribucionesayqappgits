<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");

if (verificar_usuario()){
} else { 
    echo json_encode(['success' => false, 'message' => 'Sesión no válida']);
    exit;
}

$response = array();

// Validar que se reciban los parámetros necesarios
if (!isset($_POST['cod_info_factura_venta']) || !isset($_POST['nuevo_estado'])) { $response['success'] = false; $response['message'] = 'Faltan parámetros requeridos'; echo json_encode($response); exit; }

$cod_info_factura_venta              = mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']);
$nuevo_estado                        = mysqli_real_escape_string($conectar, $_POST['nuevo_estado']);
$codigo_estado_facturacion           = $nuevo_estado;
$cod_estado_facturacion              = $nuevo_estado;
$cod_administrador                   = $_SESSION['cod_administrador'];
$fecha_modificacion                  = date("Y-m-d H:i:s");

try {
    // Obtener el nombre del nuevo estado
    $sql_nombre_estado = "SELECT nombre_estado_facturacion FROM tbl15_estado_facturacion WHERE codigo_estado_facturacion = '$nuevo_estado'";
    $consulta_nombre_estado = mysqli_query($conectar, $sql_nombre_estado);
    $datos_nombre_estado = mysqli_fetch_assoc($consulta_nombre_estado);
    
    if (!$datos_nombre_estado) { $response['success'] = false; $response['message'] = 'Estado no encontrado'; echo json_encode($response); exit; }
    $nombre_estado                   = $datos_nombre_estado['nombre_estado_facturacion'];
    // Actualizar el estado de facturación
        $sql_update = "UPDATE tbl15_info_factura_venta SET codigo_estado_facturacion = '$codigo_estado_facturacion', cod_estado_facturacion = '$cod_estado_facturacion', fecha_modificacion = '$fecha_modificacion' WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
        $resultado_update = mysqli_query($conectar, $sql_update);
    
    if ($resultado_update) {
        $response['success'] = true;
        $response['message'] = 'Estado cambiado exitosamente a: ' . $nombre_estado;
    } else {
        $response['success'] = false;
        $response['message'] = 'Error al actualizar el estado: ' . mysqli_error($conectar);
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = 'Error: ' . $e->getMessage();
}
echo json_encode($response);
?>
