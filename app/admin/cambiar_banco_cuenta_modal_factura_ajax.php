<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");

try {
    // Recibir datos del POST
    $cod_info_factura_venta = mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']);
    $cod_banco_cuenta = mysqli_real_escape_string($conectar, $_POST['cod_banco_cuenta']);
    $cod_estado_factura = '';

    // Validar que se recibieron los datos necesarios
    if (empty($cod_info_factura_venta) || empty($cod_banco_cuenta)) { throw new Exception('Faltan datos requeridos'); }
    // Actualizar el vendedor en la factura
    $sql_actualizar = "UPDATE tbl15_info_factura_venta SET cod_banco_cuenta = ? WHERE cod_info_factura_venta = ?";
    $stmt = mysqli_prepare($conectar, $sql_actualizar);
    if (!$stmt) { throw new Exception('Error al preparar la consulta: ' . mysqli_error($conectar)); }
    mysqli_stmt_bind_param($stmt, "ii", $cod_banco_cuenta, $cod_info_factura_venta);
    if (!mysqli_stmt_execute($stmt)) { throw new Exception('Error al actualizar el vendedor: ' . mysqli_stmt_error($stmt)); }
    $filas_afectadas = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    
    $sql_info_factura_venta = "SELECT cod_vendedor, cod_banco_cuenta, cod_estado_factura FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta);
    $matriz_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    $cod_vendedor                               = $matriz_info_factura_venta['cod_vendedor'];
    $cod_banco_cuenta                           = $matriz_info_factura_venta['cod_banco_cuenta'];
    //$cod_estado_factura                         = $matriz_info_factura_venta['cod_estado_factura'];

    if (($cod_vendedor <> '0') && ($cod_banco_cuenta <> '0')) {
        $cod_estado_factura = '3';

        $sql_actualizar2 = "UPDATE tbl15_info_factura_venta SET cod_estado_factura = '$cod_estado_factura' WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
        $consulta_actualizar2 = mysqli_query($conectar, $sql_actualizar2);
    }

    if ($filas_afectadas > 0) { 
        echo json_encode(array('success' => true, 'message' => 'Cuenta bancaria actualizada correctamente', 'cod_vendedor' => $cod_vendedor, 'cod_banco_cuenta' => $cod_banco_cuenta, 'cod_estado_factura' => $cod_estado_factura)); 
    } else { 
        echo json_encode(array('success' => true, 'message' => 'Error al actualizar la cuenta bancaria', 'cod_vendedor' => $cod_vendedor, 'cod_banco_cuenta' => $cod_banco_cuenta, 'cod_estado_factura' => $cod_estado_factura)); 
    }

} catch (Exception $e) {
    echo json_encode(array(
        'success' => false,
        'cod_estado_factura' => $cod_estado_factura,
        'message' => $e->getMessage()
    ));
}
mysqli_close($conectar);
?>