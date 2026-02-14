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
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);


$valor_intro                            = addslashes($_REQUEST['valor']);
$campo                                  = addslashes($_REQUEST['campo']);
$cod_factura_compra_producto            = intval($_REQUEST['id']);

$sql_factura_compra_producto = "SELECT cod_producto, cod_producto_barra, cod_factura, cod_info_factura_compra, fecha_ymd_venta_producto 
FROM tbl15_factura_compra_producto WHERE (cod_factura_compra_producto = '$cod_factura_compra_producto')";
$consulta_factura_compra_producto = mysqli_query($conectar, $sql_factura_compra_producto);
$datos_factura_compra_producto = mysqli_fetch_assoc($consulta_factura_compra_producto);

$cod_producto                          = $datos_factura_compra_producto['cod_producto'];
$cod_producto_barra                    = $datos_factura_compra_producto['cod_producto_barra'];
$cod_factura                           = $datos_factura_compra_producto['cod_factura'];
$cod_info_factura_compra               = $datos_factura_compra_producto['cod_info_factura_compra'];
$fecha_compra                          = $datos_factura_compra_producto['fecha_ymd_venta_producto'];
$vencimiento_lote                      = "EDITFECHVEN";

if ($campo == 'fecha_vencimiento') {

	$fecha_vencimiento    = addslashes($valor_intro);
	$fecha_vencimiento1   = $fecha_vencimiento;

	$data_sql = ("UPDATE tbl15_factura_compra_producto SET fecha_vencimiento = '$fecha_vencimiento' WHERE cod_factura_compra_producto = '$cod_factura_compra_producto'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	$data_sql = ("UPDATE tbl15_producto SET fecha_vencimiento = '$fecha_vencimiento', fecha_vencimiento1 = '$fecha_vencimiento1' WHERE cod_producto_barra = '$cod_producto_barra'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	$agreg = "INSERT INTO tbl15_historial_fecha_vencimiento (cod_producto_barra, fecha_vencimiento, cod_factura, cod_info_factura_compra, fecha_compra, vencimiento_lote) 
	VALUES ('$cod_producto_barra', '$fecha_vencimiento', '$cod_factura', '$cod_info_factura_compra', '$fecha_compra', '$vencimiento_lote')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>