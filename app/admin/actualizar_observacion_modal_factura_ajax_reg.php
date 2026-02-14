<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']) : '';
    $observacion_tercero = isset($_POST['observacion_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['observacion_tercero'])) : '';
    
    if (empty($cod_info_factura_venta)) {
        echo json_encode(array('success' => false, 'message' => 'Faltan datos requeridos'));
        exit;
    }
    
    // Actualizar observación en la tabla tbl15_info_factura_venta
    $sql = "UPDATE tbl15_info_factura_venta SET observacion_tercero = ? WHERE cod_info_factura_venta = ?";
    $stmt = mysqli_prepare($conectar, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $observacion_tercero, $cod_info_factura_venta);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(array(
            'success' => true,
            'message' => 'Observación actualizada correctamente',
            'observacion_tercero' => $observacion_tercero
        ));
    } else {
        echo json_encode(array(
            'success' => false,
            'message' => 'Error al actualizar la observación: ' . mysqli_error($conectar)
        ));
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(array(
        'success' => false,
        'message' => 'Método no permitido'
    ));
}
?>
