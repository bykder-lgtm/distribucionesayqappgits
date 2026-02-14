<?php
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');
// Recibir parámetros
$cod_aliado_estrategico = isset($_POST['cod_aliado_estrategico']) ? $_POST['cod_aliado_estrategico'] : '';
// Inicializar respuesta
$response = array('success' => false, 'bancos' => array(), 'comision_ptj' => 0);

if (!empty($cod_aliado_estrategico)) {
    // Consultar datos del aliado (comisión)
    $consulta_aliado_sql = "SELECT comision_ptj FROM tbl15_administrador WHERE cod_aliado_estrategico = '$cod_aliado_estrategico'";
    $consulta_aliado = mysqli_query($conectar, $consulta_aliado_sql);
    if ($consulta_aliado && mysqli_num_rows($consulta_aliado) > 0) {
        $datos_aliado = mysqli_fetch_assoc($consulta_aliado);
        $response['comision_ptj'] = $datos_aliado['comision_ptj'] ? $datos_aliado['comision_ptj'] : 0;
    }
    // Consultar cuentas bancarias según cod_aliado_estrategico y cod_estado = '1'
    $consulta_sql = "SELECT cod_banco_cuenta, nombre_banco_cuenta, numero_banco_cuenta, nombre_titular_cuenta FROM tbl15_banco_cuenta WHERE (cod_aliado_estrategico = '$cod_aliado_estrategico') AND (cod_estado = '1') ORDER BY nombre_banco_cuenta ASC";
    $consulta = mysqli_query($conectar, $consulta_sql);
    
    if ($consulta && mysqli_num_rows($consulta) > 0) {
        while ($row = mysqli_fetch_assoc($consulta)) {
            $response['bancos'][] = array('cod_banco_cuenta' => $row['cod_banco_cuenta'], 'nombre_banco_cuenta' => $row['nombre_banco_cuenta'], 'numero_banco_cuenta' => $row['numero_banco_cuenta'], 'nombre_titular_cuenta' => $row['nombre_titular_cuenta']);
        }
    }
    $response['success'] = true;
}
// Cerrar conexión
mysqli_close($conectar);
// Enviar respuesta JSON
echo json_encode($response);
?>
