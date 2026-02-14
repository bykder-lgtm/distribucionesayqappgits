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

if (isset($_POST['cod_info_factura_venta'])) {
	$cod_info_factura_venta                        = intval($_POST['cod_info_factura_venta']);
	$cod_tercero                                   = intval($_POST['cod_tercero']);
	$identificacion_tercero                        = intval($_POST['identificacion_tercero']);
	$nombre1_tercero                               = addslashes($_POST['nombre1_tercero']);
	$nombre2_tercero                               = addslashes($_POST['nombre2_tercero']);
	$apellido1_tercero                             = addslashes($_POST['apellido1_tercero']);
	$apellido2_tercero                             = addslashes($_POST['apellido2_tercero']);
    $accion_soportes                               = 'REFRESCAR_PAGINA';

	$sql_info_factura_venta = sprintf("UPDATE tbl15_info_factura_venta SET identificacion_tercero = '$identificacion_tercero', nombre1_tercero = UPPER('$nombre1_tercero'), 
	nombre2_tercero = UPPER('$nombre2_tercero'), apellido1_tercero = UPPER('$apellido1_tercero'), apellido2_tercero = UPPER('$apellido2_tercero') WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
	$resultado_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));

	$sql_tercero = sprintf("UPDATE tbl15_tercero SET identificacion_tercero = '$identificacion_tercero', nombre1_tercero = UPPER('$nombre1_tercero'), 
	nombre2_tercero = UPPER('$nombre2_tercero'), apellido1_tercero = UPPER('$apellido1_tercero'), apellido2_tercero = UPPER('$apellido2_tercero') WHERE (cod_tercero = '$cod_tercero')");
	$resultado_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));

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