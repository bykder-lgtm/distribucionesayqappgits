<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                = $_SESSION['usuario'];
$cod_administrador                     = $_SESSION['cod_administrador'];
$tipo_ajax                             = addslashes($_POST['tipo_ajax']);
$campo                                 = addslashes($_POST['campo']);
$valor                                 = addslashes($_POST['valor']);
$opcion                                = addslashes($_POST['opcion']);
$cod_tipo_accion_caja_registradora     = intval($_POST['cod_tipo_accion_caja_registradora']);
$nombre_tipo_factura                   = 'POS';
$respuesta_ajax                        = array();
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (isset($_POST['cod_tipo_accion_caja_registradora'])) {

	$precio_venta_producto        = addslashes($_POST['valor']);
	$total_precio_venta           = 0;
	$total_venta_producto         = 0;


	$array_precio_venta_producto  = explode("+", $valor);
	$total_datos_data             = count($array_precio_venta_producto);
	$array_recibido               = explode("|", $valor);

	for($i = 0; $i < $total_datos_data; $i++)   {
		$precio_venta_producto = intval($array_precio_venta_producto[$i]);
		$total_venta_producto = $precio_venta_producto;
		$precio_venta_producto_orig = $precio_venta_producto;

		if (($precio_venta_producto <> '') || ($precio_venta_producto <> '0')) {
			$total_precio_venta    += $precio_venta_producto;
		}
	}

	echo number_format($total_precio_venta, 0, ",", ".");

	//$respuesta_ajax['llave']                    = $cod_tipo_accion_caja_registradora;
	//$respuesta_ajax['total_precio_venta']       = $total_precio_venta;
	//$respuesta_ajax['estado']                   = '1';
	//echo json_encode($respuesta_ajax);
}
?>