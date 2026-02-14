<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');

$response = array('success' => false, 'message' => '');

if (isset($_POST['cod_info_factura_venta']) && !empty($_POST['cod_info_factura_venta'])) {
    $cod_info_factura_venta = intval($_POST['cod_info_factura_venta']);
    
    $sql = "SELECT cod_estado_dilig_todo, cod_estado_dilig_infocliente, cod_estado_dilig_infoproducto, cod_estado_dilig_infocreditval, cod_estado_dilig_infoequipogest, cod_estado_dilig_infocomercial, cod_estado_dilig_infodocumentfoto
    FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $resultado = mysqli_query($conectar, $sql);
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $datos = mysqli_fetch_assoc($resultado);
        $response['success'] = true;
        $response['estados'] = array('cod_estado_dilig_todo' => $datos['cod_estado_dilig_todo'], 'cod_estado_dilig_infocliente' => $datos['cod_estado_dilig_infocliente'], 'cod_estado_dilig_infoproducto' => $datos['cod_estado_dilig_infoproducto'], 'cod_estado_dilig_infocreditval' => $datos['cod_estado_dilig_infocreditval'], 'cod_estado_dilig_infoequipogest' => $datos['cod_estado_dilig_infoequipogest'], 'cod_estado_dilig_infocomercial' => $datos['cod_estado_dilig_infocomercial'], 'cod_estado_dilig_infodocumentfoto' => $datos['cod_estado_dilig_infodocumentfoto']);
    } else {
        $response['message'] = 'No se encontró el registro';
    }
} else {
    $response['message'] = 'Código de factura no proporcionado';
}
echo json_encode($response);
?>
