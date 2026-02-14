<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
include_once("../session/funciones_admin.php");

date_default_timezone_set("America/Bogota");
$codigo_estado_facturacion = 7;
// Verificar que el usuario esté autenticado
if (!verificar_usuario()) {
    echo json_encode([
        'success' => false,
        'message' => 'No tiene permisos para realizar esta acción.'
    ]);
    exit;
}
// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Método de petición inválido.'
    ]);
    exit;
}
// Obtener datos del POST
$cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, trim($_POST['cod_info_factura_venta'])) : '';
$cod_tercero = isset($_POST['cod_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['cod_tercero'])) : '';
$motivo_rechazo = isset($_POST['motivo_rechazo']) ? mysqli_real_escape_string($conectar, trim($_POST['motivo_rechazo'])) : '';
$action = isset($_POST['action']) ? $_POST['action'] : '';
// Validaciones
if (empty($cod_info_factura_venta)) {
    echo json_encode([
        'success' => false,
        'message' => 'El código de factura es requerido.'
    ]);
    exit;
}
if (empty($motivo_rechazo)) {
    echo json_encode([
        'success' => false,
        'message' => 'El motivo de rechazo es requerido.'
    ]);
    exit;
}
if ($action !== 'rechazar_solicitud') {
    echo json_encode([
        'success' => false,
        'message' => 'Acción inválida.'
    ]);
    exit;
}
// Obtener información del usuario actual
$cod_administrador = $_SESSION['cod_administrador'];
$fecha_actual = date("Y-m-d H:i:s");

try {
    // Verificar que la factura exista y esté en estado ABIERTA
    $sql_verificar = "SELECT cod_info_factura_venta, nombre_estado_factura, cod_estado_factura FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $resultado_verificar = mysqli_query($conectar, $sql_verificar);
    
    if (!$resultado_verificar || mysqli_num_rows($resultado_verificar) == 0) {
        throw new Exception('La factura no existe.');
    }
    $datos_factura = mysqli_fetch_assoc($resultado_verificar);
    // Actualizar el estado de la factura a RECHAZADA
    $sql_actualizar = "UPDATE tbl15_info_factura_venta SET cod_estado_factura = '$codigo_estado_facturacion', 
    observacion_tercero = CONCAT(COALESCE(observacion_tercero, ''), '\n[RECHAZADA] ', '$motivo_rechazo', ' - ', '$fecha_actual'),
    observacion = CONCAT(COALESCE(observacion_tercero, ''), '\n[RECHAZADA] ', '$motivo_rechazo', ' - ', '$fecha_actual')
    WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    
    if (!mysqli_query($conectar, $sql_actualizar)) { throw new Exception('Error al actualizar el estado de la factura: ' . mysqli_error($conectar)); }
    // Confirmar transacción
    mysqli_commit($conectar);
    
    echo json_encode([
        'success' => true,
        'message' => 'La solicitud ha sido rechazada correctamente.',
        'cod_info_factura_venta' => $cod_info_factura_venta
    ]);
    
} catch (Exception $e) {
    // Revertir transacción
    mysqli_rollback($conectar);
    
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
// Cerrar conexión
mysqli_close($conectar);
?>
