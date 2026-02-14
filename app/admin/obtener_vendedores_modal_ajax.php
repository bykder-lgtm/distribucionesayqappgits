<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");

try {
    // Recibir el parámetro cod_info_factura_venta (opcional por si se necesita filtrar en el futuro)
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']) : '';

    $datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura) or die(mysqli_error($conectar));
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);

    $cod_administrador_lider                                        = $data_info_factura['cod_administrador_lider'];
    $cod_administrador_coordinador                                  = $data_info_factura['cod_administrador_coordinador'];
    $cod_administrador_asesor                                       = $data_info_factura['cod_administrador_asesor'];
    $cod_administrador_aliado_estrategico                           = $data_info_factura['cod_administrador_aliado_estrategico'];
    $cod_administrador_revisor                                      = $data_info_factura['cod_administrador_revisor'];
    // Consultar todos los vendedores activos desde tbl15_administrador (cod_seguridad = '2')
    $sql_vendedores = "SELECT cod_administrador, cuenta, nombres_apellidos_tercero, identificacion_tercero, telefono1_tercero, correo_tercero 
    FROM tbl15_administrador WHERE cod_seguridad = '2' AND cod_aliado_estrategico = '$cod_administrador_aliado_estrategico' 
    AND cod_estado_activacion_usuario = '1' ORDER BY nombres_apellidos_tercero ASC";
    $resultado_vendedores = mysqli_query($conectar, $sql_vendedores);
    if (!$resultado_vendedores) { throw new Exception('Error al consultar vendedores: ' . mysqli_error($conectar)); }
    $vendedores = array();
    while ($vendedor = mysqli_fetch_assoc($resultado_vendedores)) {
        $vendedores[] = array(
            'cod_vendedor' => $vendedor['cod_administrador'], 
            'cod_administrador' => $vendedor['cod_administrador'],
            'nombres' => $vendedor['nombres_apellidos_tercero'], 
            'apellidos' => '', 
            'nombres_apellidos_tercero' => $vendedor['nombres_apellidos_tercero'],
            'identificacion_tercero' => $vendedor['identificacion_tercero'],
            'cuenta' => $vendedor['cuenta'] ?: '', 
            'telefono' => $vendedor['telefono1_tercero'] ?: '', 
            'correo' => $vendedor['correo_tercero'] ?: ''
        );
    }
    echo json_encode(array('success' => true, 'vendedores' => $vendedores, 'cod_info_factura_venta' => $cod_info_factura_venta));
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'message' => $e->getMessage()));
}
mysqli_close($conectar);
?>
