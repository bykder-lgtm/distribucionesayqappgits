<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
header('Content-Type: application/json');
// Obtener parámetros
$cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']) : '';

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura) or die(mysqli_error($conectar));
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);

$cod_administrador_lider                                        = $data_info_factura['cod_administrador_lider'];
$cod_administrador_coordinador                                  = $data_info_factura['cod_administrador_coordinador'];
$cod_administrador_asesor                                       = $data_info_factura['cod_administrador_asesor'];
$cod_administrador_aliado_estrategico                           = $data_info_factura['cod_administrador_aliado_estrategico'];
$cod_administrador_revisor                                      = $data_info_factura['cod_administrador_revisor'];
// Consultar cuentas bancarias disponibles
$sql = "SELECT cod_banco_cuenta, nombre_banco_cuenta, numero_banco_cuenta, nombre_titular_cuenta FROM tbl15_banco_cuenta WHERE (cod_aliado_estrategico = '$cod_administrador_aliado_estrategico' AND cod_estado = '1') ORDER BY cod_banco_cuenta DESC";
$consulta = mysqli_query($conectar, $sql);
if ($consulta) {
    $bancos_cuentas = array();
    while ($row = mysqli_fetch_assoc($consulta)) {
        $bancos_cuentas[] = array(
            'cod_banco_cuenta' => $row['cod_banco_cuenta'],
            'nombre_banco_cuenta' => $row['nombre_banco_cuenta'],
            'numero_banco_cuenta' => $row['numero_banco_cuenta'],
            'nombre_titular_cuenta' => $row['nombre_titular_cuenta']
        );
    }
    echo json_encode(array('success' => true, 'bancos_cuentas' => $bancos_cuentas, 'cod_administrador_aliado_estrategico' => $cod_administrador_aliado_estrategico, 'cod_info_factura_venta' => $cod_info_factura_venta));
} else {
    echo json_encode(array('success' => false, 'message' => 'Error al consultar las cuentas bancarias: ' . mysqli_error($conectar)));
}
mysqli_close($conectar);
?>
