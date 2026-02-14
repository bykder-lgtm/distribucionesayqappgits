<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']) : '';
    $cod_tienda = isset($_POST['cod_tienda']) ? mysqli_real_escape_string($conectar, $_POST['cod_tienda']) : '';
    
    if (empty($cod_info_factura_venta) || empty($cod_tienda)) { echo json_encode(array('success' => false, 'message' => 'Faltan datos requeridos')); exit; }
    
    $sql = "UPDATE tbl15_info_factura_venta SET cod_tienda = ? WHERE cod_info_factura_venta = ?";
    $stmt = mysqli_prepare($conectar, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $cod_tienda, $cod_info_factura_venta);
    
    if (mysqli_stmt_execute($stmt)) {
        // Obtener el nombre de la nueva tienda
        $sql_tienda = "SELECT nombre_tienda FROM tbl15_tienda WHERE cod_tienda = ?";
        $stmt_tienda = mysqli_prepare($conectar, $sql_tienda);
        mysqli_stmt_bind_param($stmt_tienda, "s", $cod_tienda);
        mysqli_stmt_execute($stmt_tienda);
        $resultado_tienda = mysqli_stmt_get_result($stmt_tienda);
        $tienda_data = mysqli_fetch_assoc($resultado_tienda);
        echo json_encode(array('success' => true, 'message' => 'Tienda actualizada correctamente', 'nombre_tienda' => $tienda_data['nombre_tienda'] ));
    } else {
        echo json_encode(array(
            'success' => false,
            'message' => 'Error al actualizar la tienda: ' . mysqli_error($conectar)
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
