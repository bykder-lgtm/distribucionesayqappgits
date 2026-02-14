<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php');
date_default_timezone_set("America/Bogota");
include_once('../evitar_mensaje_error/error.php'); 
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$cuenta_actual               = addslashes($_SESSION['usuario']);
$token_sesion                = addslashes($_SESSION['token']);
$token_verificador           = addslashes($_GET['token']);
$cod_sesion                  = addslashes($_SESSION['cod_sesion']);
$fecha_salida_time           = time();
$ips                         = $_SERVER['REMOTE_ADDR'];
$fecha_fin_time              = time();
$fecha_salida                = date("Y-m-d H:i:s");

$datos_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual')";
$consulta_info_factura = mysqli_query($conectar, $datos_info_factura);
$info_factura = mysqli_fetch_assoc($consulta_info_factura);
$factura_venta_abierta = mysqli_num_rows($consulta_info_factura);


$obtener_cod_sesion = "SELECT cod_sesion FROM tbl15_sesion WHERE usuario = '$cuenta_actual' ORDER BY cod_sesion DESC LIMIT 1";
$resultado_cod_sesion = mysqli_query($conectar, $obtener_cod_sesion) or die(mysqli_error($conectar));
$matriz_cod_sesion = mysqli_fetch_assoc($resultado_cod_sesion);


if ($factura_venta_abierta==0) {
if (verificar_usuario() && (isset($token_verificador)) && (isset($token_sesion)) && ($token_verificador==$token_sesion) ){

$agregar_regis = sprintf("UPDATE tbl15_sesion SET fecha_salida_time = '$fecha_salida_time', fecha_salida = '$fecha_salida' WHERE cod_sesion = '$cod_sesion'");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

session_unset(); 
session_destroy(); 
session_start(); 
session_regenerate_id(true); 
header ("Location:../index.php");

} else { header ("Location:../admin/facturacion_venta_temporal_producto_manual_pos.php"); }
} else {
header ("Location:../admin/mensaje_salir_sesion_factura_venta_sin_cerrar.php");
}
?>