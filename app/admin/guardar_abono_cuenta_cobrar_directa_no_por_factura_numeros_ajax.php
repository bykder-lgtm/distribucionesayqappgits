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
$cod_cuentas_cobrar                    = intval($_POST['cod_cuentas_cobrar']);
$nombre_tipo_factura                   = 'POS';
$respuesta_ajax                        = array();
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='abono') && ($tipo_ajax=='tbl15_cuentas_cobrar')) {

	$abono        = addslashes($_POST['valor']);
	$total_precio_venta           = 0;
	$total_venta_producto         = 0;


	$array_abono  = explode("+", $valor);
	$total_datos_data             = count($array_abono);
	$array_recibido               = explode("|", $valor);

	for($i = 0; $i < $total_datos_data; $i++)   {
		$abono = intval($array_abono[$i]);
		$total_venta_producto = $abono;
		$abono_orig = $abono;

		if (($abono <> '') || ($abono <> '0')) {
			$total_precio_venta    += $abono;
		}
	}
	echo number_format($total_precio_venta, 0, ",", ".");
}
?>