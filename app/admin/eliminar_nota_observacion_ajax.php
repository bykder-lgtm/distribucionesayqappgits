<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php'); 
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
date_default_timezone_set("America/Bogota");
$cuenta_actual                              = addslashes($_SESSION['usuario']);
$cuenta                                     = addslashes($_SESSION['usuario']);
$cod_caja_virtual                           = addslashes($_SESSION['cod_caja_virtual']);

$tab                                        = addslashes($_REQUEST['tab']);
$tipo                                       = addslashes($_REQUEST['tipo']);
$campo                                      = addslashes($_REQUEST['campo']);
$pagina                                     = addslashes($_REQUEST['pagina']);

$retorno_array                              = array();
$retorno_array2                             = array();
$codigoHTML_menu                            = '';
$codigoHTML_menu_total_reg                  = '';
$respuesta_ajax                             = array();
// ------------------------------------------------------------------------------------------------- //
if ($tipo == 'eliminar' && $tab == 'tbl15_nota_observacion') {
	$llave                     = addslashes($_REQUEST['llave']);

	$borrar_sql = sprintf("DELETE FROM tbl15_nota_observacion WHERE $campo = '$llave'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json');

	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['emisor']                          = $campo;
	$respuesta_ajax['mensaje']                         = 'Datos actualizados correctamente.';

	echo json_encode($respuesta_ajax);
}
?>