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

header('Content-Type: application/json');

if (isset($_REQUEST['id'])) {

$cod_carrito_compra_temporal        = intval($_REQUEST['id']);
$valor                              = intval($_REQUEST['valor']);
$campo_codifcryp                    = addslashes($_REQUEST['campo_codifcryp']);
//$tipo                               = addslashes($_REQUEST['tipo']);
//$foco                               = 'busqueda';
$cuenta                             = $cuenta_actual;
//$pagina                             = addslashes($_REQUEST['pagina'])."?&foco=".$foco."&cuenta=".$cuenta."&pagina=facturacion_venta_temporal_producto_manual_pos.php";

$retorno_array                      = array();
$retorno_array2                     = array();
$codigoHTML_menu                    = '';
$codigoHTML_menu_total_reg          = '';

$sql_venta_producto_temporal = "SELECT precio_venta_producto FROM tbl15_carrito_compra_temporal WHERE (cod_carrito_compra_temporal = '$cod_carrito_compra_temporal')";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
$datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

$und_venta                         = $valor;
$precio_venta_producto             = $datos_venta_producto_temporal['precio_venta_producto'];
$total_venta_producto              = $und_venta * $precio_venta_producto;
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = sprintf("UPDATE tbl15_carrito_compra_temporal SET und_venta = '$und_venta', total_venta_producto = '$total_venta_producto' WHERE (cod_carrito_compra_temporal = '$cod_carrito_compra_temporal')");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//************************************************************************************************************************************//
//************************************************************************************************************************************//
$datos_array['ok_ajax']                       = '1';
//$datos_array = array('salida_info_actualizada_carrito_compra_menu_total_reg_ajax' => $total_reg, 'salida_info_actualizada_carrito_compra_menu_ajax' => $codigoHTML_menu);
echo json_encode($datos_array);
} 
?>
