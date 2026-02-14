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
header('Content-Type: application/json');

$cuenta_actual                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$id                                                 = addslashes($_GET['id']);
$cod_info_factura_venta                             = intval($_GET['valor']);
$campo                                              = addslashes($_GET['campo']);
$fecha_ymd_venta_producto_ini                       = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin                       = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$cod_administrador                                  = intval($_GET['cod_administrador']);
$cod_tercero                                        = intval($_GET['cod_tercero']);
$cod_tipo_pago                                      = intval($_GET['cod_tipo_pago']);
$cod_tipo_forma_pago                                = intval($_GET['cod_tipo_forma_pago']);
$cod_dependencia                                    = intval($_GET['cod_dependencia']);
$nombre_tipo_factura                                = addslashes($_GET['nombre_tipo_factura']);
$nombre_tipo_compra                                 = addslashes($_GET['nombre_tipo_compra']);
$respuesta_ajax                                     = array();
$contador                                           = 0;
$filtro_in_factura_venta                            = '';
$filtro_id_factura_venta                            = '';

if ($campo == 'cod_info_factura_venta[]') {

	$sql_productos = "SELECT cod_estado_check_factura_electronica FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
	$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
	$datos_producto = mysqli_fetch_assoc($productos_consulta);

	$cod_estado_check_factura_electronica               = $datos_producto['cod_estado_check_factura_electronica'];

	if ($cod_estado_check_factura_electronica = '0') { $cod_estado_check_factura_electronica = '1'; } else { $cod_estado_check_factura_electronica = '0'; }

	$data_sql = ("UPDATE tbl15_info_factura_venta SET cod_estado_check_factura_electronica = '$cod_estado_check_factura_electronica' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	$data_sql = ("UPDATE tbl15_venta_producto SET cod_estado_check_factura_electronica = '$cod_estado_check_factura_electronica' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	$respuesta_ajax['afectado']                                = $afectado;
	$respuesta_ajax['cod_estado_check_factura_electronica']    = $cod_estado_check_factura_electronica;
	$respuesta_ajax['total_iva']                               = 'Datos';
	$respuesta_ajax['mensaje']                                 = 'Datos';

	echo json_encode($respuesta_ajax);
}
else {

}
?>