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
$cuenta                       = ($cuenta_actual);
$cod_administrador            = ($_SESSION['cod_administrador']);
$cod_caja_virtual             = ($_SESSION['cod_caja_virtual']);
header('Content-Type: application/json');


//include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
//include_once('../evitar_mensaje_error/error.php'); 
 
//include_once("../session/funciones_admin.php");
//if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	//} else { header("Location:../index.php");
//}
//$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$tab_codifcryp                      = $_POST['tab_codifcryp'];
$tab_codif                          = DAXCODIFCRYPTOR::descriptardax($tab_codifcryp);
$tab                                = addslashes(DAXCODIFCRYPTOR::descodiftextodax($tab_codif));

$tipo_codifcryp                     = $_POST['tipo_codifcryp'];
$tipo_codif                         = DAXCODIFCRYPTOR::descriptardax($tipo_codifcryp);
$tipo                               = addslashes(DAXCODIFCRYPTOR::descodiftextodax($tipo_codif));

$campo_codifcryp                    = $_POST['campo_codifcryp'];
$campo_codif                        = DAXCODIFCRYPTOR::descriptardax($campo_codifcryp);
$campo                              = addslashes(DAXCODIFCRYPTOR::descodiftextodax($campo_codif));

$retorno_array                      = array();
$retorno_array2                     = array();
$codigoHTML_menu                    = '';
$codigoHTML_menu_total_reg          = '';
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_carrito_compra_temporal') {
$cod_carrito_compra_temporal         = intval($_POST['cod_carrito_compra_temporal']);
//$cod_carrito_compra_temporal_codif        = DAXCODIFCRYPTOR::descriptardax($cod_carrito_compra_temporal_codifcryp);
//$cod_carrito_compra_temporal              = intval(DAXCODIFCRYPTOR::descodifdax($cod_carrito_compra_temporal_codif));

$sql_cod_info_impuesto_facturas = "SELECT cod_info_factura_venta_carrito_compra FROM tbl15_carrito_compra_temporal WHERE (cod_carrito_compra_temporal = '$cod_carrito_compra_temporal')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_factura_venta_carrito_compra            = $datos_cod_info_impuesto_facturas['cod_info_factura_venta_carrito_compra'];

$borrar_sql = sprintf("DELETE FROM tbl15_carrito_compra_temporal WHERE cod_carrito_compra_temporal = '$cod_carrito_compra_temporal'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

//if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
$conteo                              = 0;
$total_venta                         = 0;

$sql_producto = "SELECT cod_carrito_compra_temporal, nombre_producto, und_venta, precio_venta_producto, 
total_venta_producto, url_img_min_producto, url_img_producto_orig FROM tbl15_carrito_compra_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_carrito_compra_temporal DESC";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$total_reg = mysqli_num_rows($consulta_producto);
while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

$conteo++;
$cod_carrito_compra_temporal         = $datos_producto['cod_carrito_compra_temporal'];
$nombre_producto                     = $datos_producto['nombre_producto'];
$und_venta                           = $datos_producto['und_venta'];
$precio_venta_producto               = $datos_producto['precio_venta_producto'];
$total_venta_producto                = $datos_producto['total_venta_producto'];
$url_img_min_producto                = $datos_producto['url_img_min_producto'];
$url_img_producto_orig               = $datos_producto['url_img_producto_orig'];
$total_venta                        += $und_venta * $precio_venta_producto;

$codigoHTML_menu .= '        <li>';
$codigoHTML_menu .= '            <a href="#" class="photo"><img src="'.$url_img_min_producto.'" class="cart-thumb" alt="" /></a>';
$codigoHTML_menu .= '            <h6><a href="#">'.$nombre_producto.'</a></h6>';
$codigoHTML_menu .= '            <p>'.$und_venta.'x - <span class="price">$ '.number_format($precio_venta_producto, 0, ",", ".").'</span></p>';
$codigoHTML_menu .= '        </li>';
}

$datos_info_factura_cero = "SELECT cod_carrito_compra_temporal FROM tbl15_carrito_compra_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_venta_carrito_compra WHERE (cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra') AND (nombre_estado_factura = 'ABIERTA')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}

$codigoHTML_menu .= '        <li class="total">';
$codigoHTML_menu .= '            <a href="../admin/carrito_compra_temporal_visitante.php" class="btn btn-default hvr-hover btn-cart">VER CARRITO</a>';
$codigoHTML_menu .= '            <span class="float-right"><strong></strong>$ '.number_format($total_venta, 0, ",", ".").'</span>';
$codigoHTML_menu .= '        </li>';

$subtotal_carrito                    = number_format($total_venta, 0, ",", ".");
$subtotal_carrito_hidden             = $total_venta;
$total_carrito                       = number_format($total_venta, 0, ",", ".");
$total_carrito_hidden                = $total_venta;


$datos_array = array(
'salida_info_actualizada_carrito_compra_menu_total_reg_ajax' => $total_reg, 
'salida_info_actualizada_carrito_compra_menu_ajax' => $codigoHTML_menu, 
'subtotal_carrito' => $subtotal_carrito, 
'subtotal_carrito_hidden' => $subtotal_carrito_hidden, 
'total_carrito' => $total_carrito, 
'total_carrito_hidden' => $total_carrito_hidden 
);
echo json_encode($datos_array);
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>