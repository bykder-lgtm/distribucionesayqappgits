<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }
header('Content-Type: application/json');

if(isset($_POST['cod_administrador'])) {
    $cod_administrador = intval($_POST['cod_administrador']);
    // Consultar cuentas bancarias del aliado
    $sql = "SELECT bc.cod_banco_cuenta, bc.nombre_banco_cuenta, bc.numero_banco_cuenta, bc.cod_tipo_cuenta_banco, bc.cod_estado, bc.url_certificado_banco_cuenta, bc.nombre_titular_cuenta, bc.identificacion_titular_cuenta 
    FROM tbl15_banco_cuenta bc WHERE bc.cod_aliado_estrategico = '$cod_administrador' ORDER BY bc.nombre_banco_cuenta ASC";
    $resultado = mysqli_query($conectar, $sql);
    if($resultado) {
        $bancos = array();
        while($row = mysqli_fetch_assoc($resultado)) {
            $bancos[] = array('cod_banco_cuenta' => $row['cod_banco_cuenta'], 'nombre_banco_cuenta' => $row['nombre_banco_cuenta'], 'numero_banco_cuenta' => $row['numero_banco_cuenta'], 'cod_tipo_cuenta_banco' => $row['cod_tipo_cuenta_banco'], 'cod_estado' => $row['cod_estado'], 'url_certificado_banco_cuenta' => $row['url_certificado_banco_cuenta'], 'nombre_titular_cuenta' => $row['nombre_titular_cuenta'], 'identificacion_titular_cuenta' => $row['identificacion_titular_cuenta']);
        }
        echo json_encode(array('success' => true, 'bancos' => $bancos, 'count' => count($bancos)));
    } else {
        echo json_encode(array('success' => false, 'mensaje' => 'Error en la consulta: ' . mysqli_error($conectar)));
    }
} else {
    echo json_encode(array('success' => false, 'mensaje' => 'Parámetros incompletos'));
}
?>
