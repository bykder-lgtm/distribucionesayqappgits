<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");

// Verificar sesión
if (!verificar_usuario()) { echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }
// Validar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo json_encode(['success' => false, 'message' => 'Método no permitido']); exit; }
// Obtener y sanitizar datos
$cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, trim($_POST['cod_info_factura_venta'])) : '';
$observacion_tercero = isset($_POST['observacion_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['observacion_tercero'])) : '';
// Validaciones
if (empty($cod_info_factura_venta)) { echo json_encode(['success' => false, 'message' => 'ID de factura no proporcionado']); exit; }
if (empty($observacion_tercero)) { echo json_encode(['success' => false, 'message' => 'La observación no puede estar vacía']); exit; }
// Obtener fecha y hora actual
$fecha_modificacion = date('Y-m-d H:i:s');
// Actualizar observación en la base de datos
$sql_actualizar = "UPDATE tbl15_info_factura_venta SET observacion_tercero = '$observacion_tercero', fecha_modificacion = '$fecha_modificacion' WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$resultado = mysqli_query($conectar, $sql_actualizar);
if ($resultado) {
    if (mysqli_affected_rows($conectar) > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Observación actualizada correctamente',
            'observacion_tercero' => $observacion_tercero,
            'fecha_modificacion' => $fecha_modificacion
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'message' => 'No hubo cambios en la observación',
            'observacion_tercero' => $observacion_tercero
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error al actualizar la observación: ' . mysqli_error($conectar)
    ]);
}
mysqli_close($conectar);
?>
