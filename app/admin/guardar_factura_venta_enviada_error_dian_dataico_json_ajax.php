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
$tipo_ajax                          = addslashes($_REQUEST['tipo_ajax']);
$campo                              = addslashes($_REQUEST['campo']);
// ------------------------------------------------------------------------------------------------- //
$retorno_array                      = array();
$retorno_array2                     = array();
$codigoHTML_menu                    = '';
$codigoHTML_menu_total_reg          = '';
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_info_factura_venta') && ($tipo_ajax=='tbl15_info_factura_venta')) {
	if (isset($_REQUEST['cod_info_factura_venta'])) { $cod_info_factura_venta = intval($_REQUEST['cod_info_factura_venta']); } else{ $cod_info_factura_venta = ''; }
	if (isset($_REQUEST['cod_factura_prefijo'])) { $cod_factura_prefijo = addslashes($_REQUEST['cod_factura_prefijo']); } else{ $cod_factura_prefijo = ''; }
	if (isset($_REQUEST['dataico_dian_error'])) { $dataico_dian_error = addslashes($_REQUEST['dataico_dian_error']); } else{ $dataico_dian_error = ''; }
	if (isset($_REQUEST['dataico_dian_path'])) { $dataico_dian_path = addslashes($_REQUEST['dataico_dian_path']); } else{ $dataico_dian_path = ''; }

	$data_sql = ("UPDATE tbl15_info_factura_venta SET dataico_dian_error = '$dataico_dian_error', dataico_dian_path = '$dataico_dian_path' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json'); 
	$datos_array['afectado'] = "".$afectado;
	$datos_array['cod_info_factura_venta'] = "".$cod_info_factura_venta;
	$datos_array['dataico_dian_error'] = "".$dataico_dian_error;
	$datos_array['dataico_dian_path'] = "".$dataico_dian_path;

	echo json_encode($datos_array);
}
// ------------------------------------------------------------------------------------------------- //
?>