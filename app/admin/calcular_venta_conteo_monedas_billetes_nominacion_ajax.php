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
//header('Content-Type: application/json');

$cuenta_actual                                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$tipo_ajax                                     = $_REQUEST['tipo_ajax'];
$campo                                         = $_REQUEST['campo'];
$cod_tipo_pago                                 = '1';
$cod_tipo_forma_pago                           = '1';
$respuesta_ajax                                = array();
//-----------------------------------------------------------------------------------------------------------------//
if ($campo == 'cod_administrador' || $campo == 'fecha_ymd_venta_producto') {

	$cod_administrador                             = intval($_REQUEST['cod_administrador']);
	$fecha_ymd_venta_producto                      = addslashes($_REQUEST['fecha_ymd_venta_producto']);
	$total_base_cierre_caja                        = intval($_REQUEST['total_base_cierre_caja']);
//-----------------------------------------------------------------------------------------------------------------//
	$sql_cierre_caja = "SELECT SUM(total_retirar_caja) AS total_retirar_caja FROM tbl15_conteo_monedas_billetes_nominacion WHERE (cod_administrador = '$cod_administrador' AND fecha_anyo = '$fecha_ymd_venta_producto')";
	$consulta_cierre_caja = mysqli_query($conectar, $sql_cierre_caja) or die(mysqli_error($conectar));
	$info_cierre_caja = mysqli_fetch_assoc($consulta_cierre_caja);

	$total_retirar_caja                        = intval($info_cierre_caja['total_retirar_caja']);
//-----------------------------------------------------------------------------------------------------------------//
	$sql_venta_total = "SELECT SUM(total_venta_producto) AS total_sistema_cierre_caja, SUM(total_compra_producto) AS total_compra_producto_sistema_cierre_caja FROM tbl15_venta_producto 
	WHERE (cod_administrador = '$cod_administrador') AND (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto')";
	$consulta_venta_total = mysqli_query($conectar, $sql_venta_total) or die(mysqli_error($conectar));
	$info_venta_total = mysqli_fetch_assoc($consulta_venta_total);

	$total_sistema_cierre_caja                     = $info_venta_total['total_sistema_cierre_caja'];
	$total_compra_producto_sistema_cierre_caja     = $info_venta_total['total_compra_producto_sistema_cierre_caja'];
//-----------------------------------------------------------------------------------------------------------------//
	$sql_venta_total_contado_efectivo = "SELECT SUM(total_venta_producto) AS total_sistema_contado_efectivo_cierre_caja FROM tbl15_venta_producto 
	WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador') 
	AND (cod_tipo_pago = '$cod_tipo_pago') AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
	$consulta_venta_total_contado_efectivo = mysqli_query($conectar, $sql_venta_total_contado_efectivo) or die(mysqli_error($conectar));
	$info_venta_total_contado_efectivo = mysqli_fetch_assoc($consulta_venta_total_contado_efectivo);

	$total_sistema_contado_efectivo_cierre_caja    = $info_venta_total_contado_efectivo['total_sistema_contado_efectivo_cierre_caja'] - $total_retirar_caja;
//-----------------------------------------------------------------------------------------------------------------//
	$sql_venta_total_credito = "SELECT SUM(total_venta_producto) AS total_sistema_credito_cierre_caja FROM tbl15_venta_producto 
	WHERE (cod_administrador = '$cod_administrador') AND (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_tipo_pago = '2')";
	$consulta_venta_total_credito = mysqli_query($conectar, $sql_venta_total_credito) or die(mysqli_error($conectar));
	$info_venta_total_credito = mysqli_fetch_assoc($consulta_venta_total_credito);

	$total_sistema_credito_cierre_caja    = $info_venta_total_credito['total_sistema_credito_cierre_caja'];
//-----------------------------------------------------------------------------------------------------------------//
	//$mostrar_datos_sql = "SELECT total_base_cierre_caja FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
	//$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	//$matriz_consulta = mysqli_fetch_assoc($consulta);

	//$total_base_cierre_caja       = $matriz_consulta['total_base_cierre_caja'];
//-----------------------------------------------------------------------------------------------------------------//
	$total_base_mas_fisico_cierre_caja         = ($total_sistema_contado_efectivo_cierre_caja + $total_base_cierre_caja);
//-----------------------------------------------------------------------------------------------------------------//
	$respuesta_ajax['cod_administrador']                                = ($cod_administrador);
	$respuesta_ajax['fecha_anyo']                                       = ($fecha_ymd_venta_producto);
	$respuesta_ajax['total_sistema_cierre_caja']                        = intval($total_sistema_cierre_caja);
	$respuesta_ajax['total_sistema_contado_efectivo_cierre_caja']       = intval($total_sistema_contado_efectivo_cierre_caja);
	$respuesta_ajax['total_sistema_credito_cierre_caja']                = intval($total_sistema_credito_cierre_caja);
	$respuesta_ajax['total_base_cierre_caja']                           = intval($total_base_cierre_caja);
	$respuesta_ajax['total_compra_producto_sistema_cierre_caja']        = intval($total_compra_producto_sistema_cierre_caja);
	$respuesta_ajax['total_retirar_caja']                               = intval($total_retirar_caja);
	$respuesta_ajax['total_base_mas_fisico_cierre_caja']                = intval($total_base_mas_fisico_cierre_caja);

	echo json_encode($respuesta_ajax);
}
?>