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
$cuenta                                     = $_SESSION['usuario'];
$tipo_ajax                                  = addslashes($_REQUEST['tipo_ajax']);
$campo                                      = addslashes($_REQUEST['campo']);

$retorno_array                              = array();
$retorno_array2                             = array();
$codigoHTML_menu                            = '';
$codigoHTML_menu_total_reg                  = '';
$respuesta_ajax                             = array();
// ------------------------------------------------------------------------------------------------- //
if (($campo == 'nombre_tipo_cobro') && ($tipo_ajax == 'tbl15_venta_producto')) {
	$nombre_tipo_cobro               = addslashes($_REQUEST['valor']);
	$cod_venta_producto              = intval($_REQUEST['id']);

	$data_sql = ("UPDATE tbl15_venta_producto SET nombre_tipo_cobro = '$nombre_tipo_cobro' WHERE cod_venta_producto = '$cod_venta_producto'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json');

	$campo_incre                                       = addslashes($_REQUEST['campo_incre']);
	$incre_explode                                     = explode($campo, $campo_incre);
	$incre                                             = $incre_explode[1];

	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['emisor']                          = $campo;
	$respuesta_ajax['incre']                           = $incre;
	$respuesta_ajax['mensaje']                         = 'Datos actualizados correctamente.';

	echo json_encode($respuesta_ajax);
}
?>