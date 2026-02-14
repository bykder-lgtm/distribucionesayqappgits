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


$valor_intro             = addslashes($_GET['valor']);
$campo                   = addslashes($_GET['campo']);
$cod_info_factura_venta  = intval($_GET['id']);

$sql_productos = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$productos_consulta = mysqli_query($conectar, $sql_productos) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($productos_consulta);


if ($campo == 'cod_base_caja') {

$cod_base_caja = intval($valor_intro);

$data_sql = ("UPDATE tbl15_info_factura_venta SET cod_base_caja = '$cod_base_caja' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_venta_producto_temporal SET cod_base_caja = '$cod_base_caja' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'cod_prioridad') {

$cod_prioridad = intval($valor_intro);

$data_sql = ("UPDATE tbl15_info_factura_venta SET cod_prioridad = '$cod_prioridad' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$data_sql = ("UPDATE tbl15_venta_producto_temporal SET cod_prioridad = '$cod_prioridad' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
else {
echo "NO HACER NADA";
}
?>