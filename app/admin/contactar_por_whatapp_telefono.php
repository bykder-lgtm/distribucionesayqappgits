<?php include_once("../conexiones/conexione.php"); 
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../admin/01_info_empresa_visitante_ext.php');

$tiempo_inicial = microtime(true);
error_reporting(E_ALL ^ E_NOTICE);

$cod_info_factura_venta             = intval($_GET['cod_info_factura_venta']);

$accion_codifcryp                   = $_GET['accion_codifcryp'];
$accion_codif                       = DAXCODIFCRYPTOR::descriptardax($accion_codifcryp);
$accion                             = addslashes(DAXCODIFCRYPTOR::descodiftextodax($accion_codif));

$tipo_codifcryp                     = $_GET['tipo_codifcryp'];
$tipo_codif                         = DAXCODIFCRYPTOR::descriptardax($tipo_codifcryp);
$tipo                               = addslashes(DAXCODIFCRYPTOR::descodiftextodax($tipo_codif));

$origen_codifcryp                   = $_GET['origen_codifcryp'];
$origen_codif                       = DAXCODIFCRYPTOR::descriptardax($origen_codifcryp);
$origen                             = addslashes(DAXCODIFCRYPTOR::descodiftextodax($origen_codif));
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($accion == 'redirecionar_whatapp' && $origen == 'carrito') {

$sqlr_adm = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$modificar_adm = mysqli_query($conectar, $sqlr_adm) or die(mysqli_error($conectar));
$datos_adm = mysqli_fetch_assoc($modificar_adm);

$fecha_anyo                     = $datos_adm['fecha_anyo'];
$fecha_hora                     = $datos_adm['fecha_hora'];

$url_redir = "https://api.whatsapp.com/send?phone=57$telefono&text=Id%20de%20pedido:%20".$cod_info_factura_venta;
header("Location: $url_redir");
} 
elseif ($accion == 'redirecionar_telefono' && $origen == 'carrito') {

$url_redir = "tel:57$telefono";
header("Location: $url_redir");
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>