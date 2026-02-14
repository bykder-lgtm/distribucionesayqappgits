<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../houseburger_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
header('Content-Type: application/json');

$cuenta_actual                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$id                                                 = addslashes($_POST['id']);
$cod_info_factura_venta                             = intval($_POST['valor']);
$campo                                              = addslashes($_POST['campo']);
$fecha_ymd_venta_producto_ini                       = addslashes($_POST['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin                       = addslashes($_POST['fecha_ymd_venta_producto_fin']);
$cod_administrador                                  = intval($_POST['cod_administrador']);
$cod_tercero                                        = intval($_POST['cod_tercero']);
$cod_tipo_pago                                      = intval($_POST['cod_tipo_pago']);
$cod_tipo_forma_pago                                = intval($_POST['cod_tipo_forma_pago']);
$cod_dependencia                                    = intval($_POST['cod_dependencia']);
$nombre_tipo_factura                                = addslashes($_POST['nombre_tipo_factura']);
$nombre_tipo_compra                                 = addslashes($_POST['nombre_tipo_compra']);
$respuesta_ajax                                     = array();
/*
$sql_productos = "SELECT * FROM houseburger_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($productos_consulta);

$cod_info_factura_venta                             = $datos_producto['cod_info_factura_venta'];
*/
$contador                                           = 0;
$filtro_in_factura_venta                            = '';
$filtro_id_factura_venta                            = '';

//foreach ($_POST['valor'] as $clave => $cod_info_factura_venta) {
	//$contador++;
	//$cantidad_reg = count($_POST['valor']);
	//$filtro_in_factura_venta .= $cod_info_factura_venta.",";
//}
$filtro_in_factura_venta = $_POST['valor'];
$filtro_in_factura_venta = str_replace("on", '0', $filtro_in_factura_venta);
$total_reg = count(explode(",", $filtro_in_factura_venta));


if(substr($filtro_in_factura_venta,-1,1) == ',') { $filtro_in_factura_venta = substr($filtro_in_factura_venta, 0, (strlen($filtro_in_factura_venta)-1)).""; }

//echo "filtro_in_factura_venta = ".$filtro_in_factura_venta;

if ($campo == 'cod_info_factura_venta[]') {

	$sql_total_tipos_iva = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
	Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
	Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
	FROM tbl15_venta_producto WHERE cod_info_factura_venta IN ($filtro_in_factura_venta)";
	$consulta_total_tipos_iva = mysqli_query($conectar, $sql_total_tipos_iva) or die(mysqli_error($conectar));
	$datos_total_tipos_iva = mysqli_fetch_assoc($consulta_total_tipos_iva);

	$total_venta                                = $datos_total_tipos_iva['total_venta'];
	$total_base_iva                             = $datos_total_tipos_iva['total_base_iva'];
	$total_iva                                  = $datos_total_tipos_iva['total_iva'];

	$respuesta_ajax['total_venta']              = number_format($total_venta, 0, ",", ".");
	$respuesta_ajax['total_base_iva']           = number_format($total_base_iva, 0, ",", ".");
	$respuesta_ajax['total_iva']                = number_format($total_iva, 0, ",", ".");
	$respuesta_ajax['total_reg']                = $total_reg;
	$respuesta_ajax['filtro_in_factura_venta']  = $filtro_in_factura_venta;
	$respuesta_ajax['mensaje']                  = 'Datos cargados correctamente.';

	echo json_encode($respuesta_ajax);
}
else {
}
?>