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
$cuenta_actual                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                       = $_SESSION['usuario'];
$cod_administrador            = $_SESSION['cod_administrador'];
$tipo_ajax                    = addslashes($_POST['tipo_ajax']);
$campo                        = addslashes($_POST['campo']);

$datos_info = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_estado_factura = '1') AND (cuenta = '$cuenta_actual')";
$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
$info = mysqli_fetch_assoc($consulta_info);
$factura_ocupada = mysqli_num_rows($consulta_info);

// ------------------------------------------------------------------------------------------------- //
if (($campo=='nombre1_tercero') && ($tipo_ajax=='tbl15_info_factura_venta_carrito_compra')) {
$nombre1_tercero         = addslashes($_POST['valor']);
$cod_info_factura_venta_carrito_compra             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_venta_carrito_compra SET nombre1_tercero = UPPER('$nombre1_tercero') WHERE cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='telefono1_tercero') && ($tipo_ajax=='tbl15_info_factura_venta_carrito_compra')) {
$telefono1_tercero         = addslashes($_POST['valor']);
$cod_info_factura_venta_carrito_compra             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_venta_carrito_compra SET telefono1_tercero = '$telefono1_tercero' WHERE cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='correo_tercero') && ($tipo_ajax=='tbl15_info_factura_venta_carrito_compra')) {
$correo_tercero         = addslashes($_POST['valor']);
$cod_info_factura_venta_carrito_compra             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_venta_carrito_compra SET correo_tercero = '$correo_tercero' WHERE cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='direccion_tercero') && ($tipo_ajax=='tbl15_info_factura_venta_carrito_compra')) {
$direccion_tercero         = addslashes($_POST['valor']);
$cod_info_factura_venta_carrito_compra             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_venta_carrito_compra SET direccion_tercero = UPPER('$direccion_tercero') WHERE cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_tipo_forma_pago') && ($tipo_ajax=='tbl15_info_factura_venta_carrito_compra')) {
$cod_tipo_forma_pago         = addslashes($_POST['valor']);
$cod_info_factura_venta_carrito_compra             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_venta_carrito_compra SET cod_tipo_forma_pago = '$cod_tipo_forma_pago' WHERE cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
if (($campo=='observacion') && ($tipo_ajax=='tbl15_info_factura_venta_carrito_compra')) {
$observacion                                       = addslashes($_POST['valor']);
$cod_info_factura_venta_carrito_compra             = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_info_factura_venta_carrito_compra SET observacion = '$observacion' WHERE cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>
