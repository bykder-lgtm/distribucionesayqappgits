<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");

// Verificar sesión
if (!verificar_usuario()) { echo json_encode(['success' => false, 'message' => 'Sesión no válida. Por favor, inicie sesión nuevamente.']); exit; }

// Validar que se reciban los datos necesarios
if (!isset($_POST['cod_info_factura_venta']) || !isset($_POST['codigo_estado_facturacion'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos. Por favor, intente nuevamente.']); exit; }

// Obtener y limpiar los datos
$cod_info_factura_venta = mysqli_real_escape_string($conectar, trim($_POST['cod_info_factura_venta']));
$codigo_estado_facturacion = mysqli_real_escape_string($conectar, trim($_POST['codigo_estado_facturacion']));

// Validar que los datos no estén vacíos
if (empty($cod_info_factura_venta) || empty($codigo_estado_facturacion)) {
    echo json_encode(['success' => false, 'message' => 'Los datos proporcionados no son válidos.']); exit; }

$datos_estado = mysqli_fetch_assoc($resultado_estado);
$cod_estado_facturacion_validacion = $datos_estado['cod_estado_facturacion'];
$codigo_estado_facturacion_validacion = $datos_estado['codigo_estado_facturacion'];

// Verificar que la factura existe
$sql_verificar = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$resultado_verificar = mysqli_query($conectar, $sql_verificar);

if (!$resultado_verificar || mysqli_num_rows($resultado_verificar) == 0) {
    echo json_encode([
        'success' => false,
        'message' => 'La factura especificada no existe.'
    ]);
    exit;
}

// Actualizar el estado de facturación
$sql_actualizar = "UPDATE tbl15_info_factura_venta 
                   SET cod_estado_facturacion = '$cod_estado_facturacion_validacion',
                       codigo_estado_facturacion = '$codigo_estado_facturacion_validacion'
                   WHERE cod_info_factura_venta = '$cod_info_factura_venta'";

if (mysqli_query($conectar, $sql_actualizar)) {
    // Verificar que se actualizó correctamente
    if (mysqli_affected_rows($conectar) > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'El estado de la factura ha sido cambiado a VALIDACIÓN DE DATOS correctamente.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No se realizaron cambios. Es posible que el estado ya esté actualizado.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error al actualizar el estado: ' . mysqli_error($conectar)
    ]);
}

mysqli_close($conectar);
?>
