<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_administrador            = ($_SESSION['cod_administrador']);
//include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
//include_once('../evitar_mensaje_error/error.php'); 
 
//include_once("../session/funciones_admin.php");
//if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	//} else { header("Location:../index.php");
//}
//$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_info_factura_venta_carrito_compra             = intval($_REQUEST['cod_info_factura_venta_carrito_compra']);
//$cod_info_factura_venta_carrito_compra_codif       = DAXCODIFCRYPTOR::descriptardax($cod_info_factura_venta_carrito_compra_codifcryp);
//$cod_info_factura_venta_carrito_compra             = intval(DAXCODIFCRYPTOR::descodifdax($cod_info_factura_venta_carrito_compra_codif));

$latitud                                           = addslashes($_REQUEST['latitud']);
$longitud                                          = addslashes($_REQUEST['longitud']);
$latitud_longitud                                  = addslashes($_REQUEST['latitud_longitud']);
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (isset($_REQUEST['cod_info_factura_venta_carrito_compra'])) {

$actualizar_carrito_compra = "UPDATE tbl15_info_factura_venta_carrito_compra SET latitud = '$latitud', longitud = '$longitud', 
latitud_longitud = '$latitud_longitud' WHERE cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra'";
$resultado_carrito_compra = mysqli_query($conectar, $actualizar_carrito_compra) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "SI"; } else { echo "NO"; }                
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>