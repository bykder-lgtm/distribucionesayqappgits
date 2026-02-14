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
if (($campo=='cod_info_factura_venta') && ($tipo_ajax=='tbl15_info_factura_venta_notificacion_chatbot_telegram')) {
	
	if (isset($_REQUEST['cod_info_factura_venta'])) { $cod_info_factura_venta = intval($_REQUEST['cod_info_factura_venta']); } else{ $cod_info_factura_venta = ''; }
	if (isset($_REQUEST['respuesta_ok'])) { $respuesta_info_factura_venta_notificacion_chatbot_telegram = addslashes($_REQUEST['respuesta_ok']); } else{ $respuesta_info_factura_venta_notificacion_chatbot_telegram = ''; }
	if (isset($_REQUEST['cod_estado_enviado'])) { $cod_estado_enviado = intval($_REQUEST['cod_estado_enviado']); } else{ $cod_estado_enviado = ''; }
	$nombre_info_factura_venta_notificacion_chatbot_telegram = 'API_TELEGRAM';
	$fecha_creacion = date("Y-m-d H:i:s");

	$sql_data = "INSERT INTO tbl15_info_factura_venta_notificacion_chatbot_telegram (nombre_info_factura_venta_notificacion_chatbot_telegram, cod_info_factura_venta, 
	respuesta_info_factura_venta_notificacion_chatbot_telegram, cod_estado_enviado, fecha_creacion) 
	VALUES ('$nombre_info_factura_venta_notificacion_chatbot_telegram', '$cod_info_factura_venta', 
	'$respuesta_info_factura_venta_notificacion_chatbot_telegram', '$cod_estado_enviado', '$fecha_creacion')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	header('Content-Type: application/json'); 
	$datos_array['afectado'] = "".$afectado;
	$datos_array['cod_info_factura_venta'] = "".$cod_info_factura_venta;
	$datos_array['cod_estado_enviado'] = "".$cod_estado_enviado;

	echo json_encode($datos_array);
}
// ------------------------------------------------------------------------------------------------- //
?>