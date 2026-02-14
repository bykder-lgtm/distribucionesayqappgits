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
	$monto_deuda                                   = intval($_POST['monto_deuda']);
	$monto_cuota                                   = intval($_POST['monto_cuota']);
	$numero_cuota                                  = intval($_POST['numero_cuota']);
    $accion_soportes                               = 'REFRESCAR_PAGINA';
	$total_precio_venta                            = $monto_deuda;

	$sql_info_factura_venta = sprintf("UPDATE tbl15_info_factura_venta SET monto_deuda = '$monto_deuda', monto_cuota = '$monto_cuota', numero_cuota = '$numero_cuota', total_precio_venta = '$total_precio_venta' 
	WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
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