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
$tipo_ajax                                  = addslashes($_POST['tipo_ajax']);
$campo                                      = addslashes($_POST['campo']);

$retorno_array                              = array();
$retorno_array2                             = array();
$codigoHTML_menu                            = '';
$codigoHTML_menu_total_reg                  = '';
$respuesta_ajax                             = array();
// ------------------------------------------------------------------------------------------------- //
if (($tipo_ajax=='tbl15_administrador')) {
	$valor                         = addslashes($_POST['valor']);
	$cod_administrador             = intval($_POST['id']);

	$data_sql = ("UPDATE tbl15_administrador SET $campo = '$valor' WHERE cod_administrador = '$cod_administrador'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json');

	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['emisor']                          = $campo;
	$respuesta_ajax['mensaje']                         = 'Datos actualizados correctamente.';

	echo json_encode($respuesta_ajax);
}