<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                              = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
//$cuenta                                     = $_SESSION['usuario'];

$retorno_array                              = array();
$retorno_array2                             = array();
$codigoHTML_menu                            = '';
$codigoHTML_menu_total_reg                  = '';
$respuesta_ajax                             = array();

$sql_autoincremento_banco_cuenta = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_banco_cuenta'";
$exec_autoincremento_banco_cuenta = mysqli_query($conectar, $sql_autoincremento_banco_cuenta) or die(mysqli_error($conectar));
$datos_autoincremento_banco_cuenta = mysqli_fetch_assoc($exec_autoincremento_banco_cuenta);

$cod_banco_cuenta                              = $datos_autoincremento_banco_cuenta['AUTO_INCREMENT'];
	
if (isset($_POST['cod_info_factura_venta'])) {
	$cod_info_factura_venta                        = intval($_POST['cod_info_factura_venta']);
	$cod_tercero                                   = intval($_POST['cod_tercero']);
	$nombre_banco_cuenta                           = addslashes($_POST['nombre_banco_cuenta']);
	$numero_banco_cuenta                           = addslashes($_POST['numero_banco_cuenta']);
	$nombre_titular_cuenta                         = addslashes($_POST['nombre_titular_cuenta']);
	$identificacion_titular_cuenta                 = addslashes($_POST['identificacion_titular_cuenta']);

	$nombre_tipo_identificacion                    = 'CC';
    $accion_soportes                               = 'REFRESCAR_PAGINA';
    $cod_estado                                    = 1;

    $sql_info_factura_venta = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
    $existe_info_factura_venta = mysqli_num_rows($consulta_info_factura_venta);
    $info_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    $cod_tienda                                    = $info_info_factura_venta['cod_tienda'];
    $cod_aliado_estrategico                        = $info_info_factura_venta['cod_administrador_aliado_estrategico'];

	$sql_data = "INSERT INTO tbl15_banco_cuenta (cod_banco_cuenta, nombre_banco_cuenta, numero_banco_cuenta, nombre_titular_cuenta, identificacion_titular_cuenta, cod_estado, cod_tienda, cod_aliado_estrategico) 
	VALUES ('$cod_banco_cuenta', UPPER('$nombre_banco_cuenta'), '$numero_banco_cuenta', UPPER('$nombre_titular_cuenta'), '$identificacion_titular_cuenta', '$cod_estado', '$cod_tienda', '$cod_aliado_estrategico')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_info_factura_venta = sprintf("UPDATE tbl15_info_factura_venta SET cod_banco_cuenta = '$cod_banco_cuenta' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
	$resultado_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json');
	$respuesta_ajax['afectado']                    = $afectado;
	$respuesta_ajax['cod_info_factura_venta']      = $cod_info_factura_venta;
	$respuesta_ajax['cod_tercero']                 = $cod_tercero;
	$respuesta_ajax['accion_soportes']             = $accion_soportes;
	$respuesta_ajax['mensaje']                     = 'Hecho correctamente.';

	echo json_encode($respuesta_ajax);
}
?>