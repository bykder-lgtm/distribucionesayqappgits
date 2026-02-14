<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json; charset=utf-8');
date_default_timezone_set("America/Bogota");

$cod_tienda = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;

$response = array('success' => false, 'tienda' => null);

if ($cod_tienda > 0) {
    $sql = "SELECT * FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
    $consulta = mysqli_query($conectar, $sql);
    
    if ($consulta && mysqli_num_rows($consulta) > 0) {
        $tienda = mysqli_fetch_assoc($consulta);
        $response['success'] = true;
        $response['tienda'] = array(
            'cod_tienda' => $tienda['cod_tienda'],
            'identificacion_tercero' => $tienda['identificacion_tercero'],
            'nombre_tienda' => $tienda['nombre_tienda'],
            'nombre1_tercero' => $tienda['nombre1_tercero'],
            'telefono1_tercero' => $tienda['telefono1_tercero'],
            'correo_tercero' => $tienda['correo_tercero'],
            'direccion_tercero' => $tienda['direccion_tercero'],
            'cod_aliado_estrategico' => $tienda['cod_aliado_estrategico'],
            'nombre_representante' => $tienda['nombre_representante'],
            'documento_representante' => $tienda['documento_representante'],
            'correo_representante' => $tienda['correo_representante'],
            'nombre_tipo_industria' => $tienda['nombre_tipo_industria'],
            'nombre_tipo_subindustria' => $tienda['nombre_tipo_subindustria'],
            'nombre_tipo_otraindustria' => $tienda['nombre_tipo_otraindustria'],
            'numero_comercios' => $tienda['numero_comercios'],
            'existe_rues' => $tienda['existe_rues'],
            'venta_presencial' => $tienda['venta_presencial'],
            'venta_online' => $tienda['venta_online'],
            'nombre_plataforma_ecommerce' => $tienda['nombre_plataforma_ecommerce'],
            'nombre_sistema_contable' => $tienda['nombre_sistema_contable'],
            'comision_ptj' => $tienda['comision_ptj'],
            'cod_banco_cuenta' => $tienda['cod_banco_cuenta'],
            'cod_estado' => $tienda['cod_estado']
        );
    }
}
mysqli_close($conectar);
echo json_encode($response);
?>
