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
$cuenta_actual                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                             = $_SESSION['usuario'];
$cod_administrador_sesion           = $_SESSION['cod_administrador'];
$tipo_ajax                          = addslashes($_POST['tipo_ajax']);
$campo                              = addslashes($_POST['campo']);
// ------------------------------------------------------------------------------------------------- //
$retorno_array                      = array();
$retorno_array2                     = array();
$codigoHTML_menu                    = '';
$codigoHTML_menu_total_reg          = '';
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_estado') && ($tipo_ajax=='tbl15_puc')) {
	$cod_estado                   = intval($_POST['valor']);
	$cod_puc                      = intval($_POST['id']);

	$data_sql = ("UPDATE tbl15_puc SET cod_estado = '$cod_estado' WHERE cod_puc = '$cod_puc'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json'); 
	$datos_array['afectado'] = "".$afectado;
	$datos_array['ok_ajax'] = "".$afectado;
	echo json_encode($datos_array);
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre_modulo_puc') && ($tipo_ajax=='tbl15_puc')) {
	$nombre_modulo_puc            = addslashes($_POST['valor']);
	$cod_puc                      = intval($_POST['id']);

	$data_sql = ("UPDATE tbl15_puc SET nombre_modulo_puc = '$nombre_modulo_puc' WHERE cod_puc = '$cod_puc'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json'); 
	$datos_array['afectado'] = "".$afectado;
	$datos_array['ok_ajax'] = "".$afectado;
	echo json_encode($datos_array);
}
?>