<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_tienda = isset($_POST['nombre_tienda']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_tienda'])) : '';
    $direccion_tienda = isset($_POST['direccion_tienda']) ? mysqli_real_escape_string($conectar, trim($_POST['direccion_tienda'])) : '';
    $telefono_tienda = isset($_POST['telefono_tienda']) ? mysqli_real_escape_string($conectar, trim($_POST['telefono_tienda'])) : '';
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']) : '';
    
    if (empty($nombre_tienda)) { echo json_encode(array('success' => false, 'message' => 'El nombre de la tienda es requerido' )); exit; }
    // Insertar nueva tienda
    $sql = "INSERT INTO tbl15_tienda (nombre_tienda, direccion_tienda, telefono_tienda, cod_estado, fecha_creacion) VALUES (?, ?, ?, '1', NOW())";
    $stmt = mysqli_prepare($conectar, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nombre_tienda, $direccion_tienda, $telefono_tienda);
    
    if (mysqli_stmt_execute($stmt)) {
        $cod_tienda = mysqli_insert_id($conectar);
        
        // Si se proporcionó cod_info_factura_venta, actualizar la factura con la nueva tienda
        if (!empty($cod_info_factura_venta)) {
            $sql_update = "UPDATE tbl15_info_factura_venta SET cod_tienda = ? WHERE cod_info_factura_venta = ?";
            $stmt_update = mysqli_prepare($conectar, $sql_update);
            mysqli_stmt_bind_param($stmt_update, "ss", $cod_tienda, $cod_info_factura_venta);
            mysqli_stmt_execute($stmt_update);
            mysqli_stmt_close($stmt_update);
        }
        
        echo json_encode(array(
            'success' => true,
            'message' => 'Tienda registrada correctamente',
            'cod_tienda' => $cod_tienda,
            'nombre_tienda' => $nombre_tienda
        ));
    } else {
        echo json_encode(array(
            'success' => false,
            'message' => 'Error al registrar la tienda: ' . mysqli_error($conectar)
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
