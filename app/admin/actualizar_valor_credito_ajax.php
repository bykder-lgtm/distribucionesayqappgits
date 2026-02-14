<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
include_once("../session/funciones_admin.php");
// Verificar sesión
if (!verificar_usuario()) { echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }
// Obtener datos del POST
$cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']) : '';
$monto_deuda = isset($_POST['nuevo_valor_credito']) ? mysqli_real_escape_string($conectar, $_POST['nuevo_valor_credito']) : '';
// Validar datos
if (empty($cod_info_factura_venta) || empty($monto_deuda)) { echo json_encode(['success' => false, 'message' => 'Datos incompletos']); exit; }
// Validar que el valor sea numérico y positivo
if (!is_numeric($monto_deuda) || $monto_deuda <= 0) { echo json_encode(['success' => false, 'message' => 'El valor debe ser un número positivo']); exit; }
// Actualizar el valor en la base de datos
$sql_actualizar = "UPDATE tbl15_info_factura_venta SET monto_deuda = '$monto_deuda', fecha_modificacion = NOW() WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
if (mysqli_query($conectar, $sql_actualizar)) {
    // Verificar si se actualizó algún registro
    if (mysqli_affected_rows($conectar) > 0) {
        echo json_encode([
            'success' => true,
            'message' => 'Valor a crédito actualizado correctamente'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No se encontró el registro o el valor es el mismo'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error al actualizar: ' . mysqli_error($conectar)
    ]);
}
mysqli_close($conectar);
?>
