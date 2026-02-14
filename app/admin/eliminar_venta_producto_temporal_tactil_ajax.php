<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../admin/01_info_empresa_tactil.php');
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

if (isset($_REQUEST['tipo_accion'])) { $tipo_accion = addslashes($_REQUEST['tipo_accion']); } else { $tipo_accion = ''; }
if (isset($_REQUEST['tab'])) { $tab = addslashes($_REQUEST['tab']); } else { $tab = ''; }
if (isset($_REQUEST['campo'])) { $campo = addslashes($_REQUEST['campo']); } else { $campo = ''; }
if (isset($_REQUEST['id'])) { $id = addslashes($_REQUEST['id']); } else { $id = ''; }

if (isset($_REQUEST['cod_tipo_metodo_envio'])) { $cod_tipo_metodo_envio = intval($_REQUEST['cod_tipo_metodo_envio']); } else { $cod_tipo_metodo_envio = '1'; }
if (isset($_REQUEST['cod_tipo_aplicacion'])) { $cod_tipo_aplicacion = intval($_REQUEST['cod_tipo_aplicacion']); } else { $cod_tipo_aplicacion = '2'; }

$nombre_tipo_moneda                 = addslashes($_REQUEST['nombre_tipo_moneda']);
$nombre_tipo_factura                = addslashes($_REQUEST['nombre_tipo_factura']);
$foco                               = addslashes($_REQUEST['foco']);
$cod_estado_vacuna                  = intval($_REQUEST['cod_estado_vacuna']);
$buscar_por                         = addslashes($_REQUEST['buscar_por']);
$cuenta                             = addslashes($_REQUEST['cuenta']);
$cuenta_actual                      = addslashes($_REQUEST['cuenta']);
$cod_caja_virtual                   = intval($_REQUEST['cod_caja_virtual']);
$cod_base_caja                      = intval($_REQUEST['cod_base_caja']);
$cod_tipo_pedido                    = 1;
$pagina                             = addslashes($_REQUEST['pagina'])."?&foco=".$foco."&buscar_por=".$buscar_por."&cuenta=".$cuenta."&cod_caja_virtual=".$cod_caja_virtual."&pagina=facturacion_venta_temporal_producto_manual_pos.php";
$retorno_array                      = array();
$retorno_array2                     = array();
$codigoHTML_menu                    = '';
$codigoHTML_menu_total_reg          = '';
$salida_carrito_compra_ajax         = '';
$total_venta                        = 0;
$conteo                             = 0;

$retorno_array                      = array();
$retorno_array2                     = array();
$codigoHTML_menu                    = '';
$codigoHTML_menu_total_reg          = '';
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo_accion == 'eliminar' && $tab == 'tbl15_venta_producto_temporal') {
$cod_venta_producto_temporal         = intval($_POST['cod_venta_producto_temporal']);

$sql_cod_info_impuesto_facturas = "SELECT cod_info_factura_venta FROM tbl15_venta_producto_temporal WHERE (cod_venta_producto_temporal = '$cod_venta_producto_temporal')";
$consulta_cod_info_impuesto_facturas = mysqli_query($conectar, $sql_cod_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_cod_info_impuesto_facturas = mysqli_fetch_assoc($consulta_cod_info_impuesto_facturas);

$cod_info_factura_venta            = $datos_cod_info_impuesto_facturas['cod_info_factura_venta'];

$borrar_sql = sprintf("DELETE FROM tbl15_venta_producto_temporal WHERE cod_venta_producto_temporal = '$cod_venta_producto_temporal'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

//if ( mysqli_affected_rows($conectar) > 0) { echo "ELIMINADO SI"; } else { echo "ELIMINADO NO"; }
$conteo                              = 0;
$total_venta                         = 0;

$sql_producto_total = "SELECT SUM(und_venta * precio_venta_producto) as total_venta FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_producto_total = mysqli_query($conectar, $sql_producto_total) or die(mysqli_error($conectar));
$datos_producto_total = mysqli_fetch_assoc($consulta_producto_total);

$total_venta              = $datos_producto_total['total_venta'];
$total_venta_tactil       = $total_venta;

$sql_producto = "SELECT cod_venta_producto_temporal, nombre_producto, und_venta, precio_venta_producto, 
total_venta_producto, url_img_min_producto, url_img_producto_orig FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') 
ORDER BY cod_venta_producto_temporal DESC";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$total_reg = mysqli_num_rows($consulta_producto);
while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

$conteo++;
$cod_venta_producto_temporal         = $datos_producto['cod_venta_producto_temporal'];
$nombre_producto                     = $datos_producto['nombre_producto'];
$und_venta                           = $datos_producto['und_venta'];
$precio_venta_producto               = $datos_producto['precio_venta_producto'];
$total_venta_producto                = $datos_producto['total_venta_producto'];
$url_img_min_producto                = $datos_producto['url_img_min_producto'];
$url_img_producto_orig               = $datos_producto['url_img_producto_orig'];
//$total_venta                        += $und_venta * $precio_venta_producto;

$codigoHTML_menu .= '        <li>';
$codigoHTML_menu .= '            <a href="#" class="photo"><img src="'.$url_img_min_producto.'" class="cart-thumb" alt="" /></a>';
$codigoHTML_menu .= '            <h6><a href="#">'.$nombre_producto.'</a></h6>';
$codigoHTML_menu .= '            <p>'.$und_venta.'x - <span class="price">$ '.number_format($precio_venta_producto, 0, ",", ".").'</span></p>';
$codigoHTML_menu .= '        </li>';
}

$datos_info_factura_cero = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

if ($existe_factura_abierta_cero == 0) {
$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_estado_factura = 'ABIERTA')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
}

$codigoHTML_menu .= '        <li class="total">';
$codigoHTML_menu .= '            <a href="../admin/venta_producto_temporal_tactil.php" class="btn btn-default hvr-hover btn-cart">VER CARRITO</a>';
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
	'total_venta_tactil_ajax' => '$ '.number_format($total_venta_tactil, 0, ",", "."), 
	'salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax' => '$ '.number_format($total_venta_tactil, 0, ",", "."), 
	'total_carrito_hidden' => $total_carrito_hidden 
);
echo json_encode($datos_array);
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>