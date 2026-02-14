<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../admin/01_info_empresa_visitante_ext.php');
//include_once('../admin/detectar_tipo_dispositivo.php');
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
if (isset($_REQUEST['id'])) { $id = addslashes($_REQUEST['id']); } else { $id = ''; }

if (isset($_REQUEST['cod_carrito_compra_temporal'])) {

	$cod_carrito_compra_temporal        = intval($id);
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
	if (isset($_REQUEST['cod_tipo_metodo_envio'])) { $cod_tipo_metodo_envio = intval($_REQUEST['cod_tipo_metodo_envio']); } else { $cod_tipo_metodo_envio = '1'; }
	if (isset($_REQUEST['cod_tipo_aplicacion'])) { $cod_tipo_aplicacion = intval($_REQUEST['cod_tipo_aplicacion']); } else { $cod_tipo_aplicacion = '2'; }

	$pagina                             = addslashes($_REQUEST['pagina'])."?&foco=".$foco."&buscar_por=".$buscar_por."&cuenta=".$cuenta."&cod_caja_virtual=".$cod_caja_virtual."&pagina=facturacion_venta_temporal_producto_manual_pos.php";
	$retorno_array                      = array();
	$retorno_array2                     = array();
	$codigoHTML_menu                    = '';
	$codigoHTML_menu_total_reg          = '';
	$salida_carrito_compra_ajax         = '';
	$total_venta                        = 0;
	$conteo                             = 0;
//************************************************************************************************************************************//
//************************************************************************************************************************************//
	$borrar_sql = sprintf("DELETE FROM tbl15_carrito_compra_temporal WHERE cod_carrito_compra_temporal = '$cod_carrito_compra_temporal'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
//************************************************************************************************************************************//
//************************************************************************************************************************************//
	$sql_producto_total = "SELECT SUM(und_venta * precio_venta_producto) as total_venta FROM tbl15_carrito_compra_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_producto_total = mysqli_query($conectar, $sql_producto_total) or die(mysqli_error($conectar));
	$datos_producto_total = mysqli_fetch_assoc($consulta_producto_total);

	$total_venta              = $datos_producto_total['total_venta'];
	$total_venta_tactil       = $total_venta;
//************************************************************************************************************************************//
//************************************************************************************************************************************//
	$codigoHTML_menu .= '        <li class="total">';
	$codigoHTML_menu .= '            <a href="../admin/carrito_compra_temporal_visitante_ext.php" class="btn btn-default hvr-hover btn-cart">VER CARRITO</a>';
	$codigoHTML_menu .= '            <span class="float-right"><strong></strong>$ '.number_format($total_venta, 0, ",", ".").'</span>';
	$codigoHTML_menu .= '        </li>';
/*  ///////////////////////////////////////////////////////CARRITO COMPRA INI//////////////////////////////////////////////////////////////// */
	$salida_carrito_compra_ajax .= '						<div class="filter-sidebar-left">';
	$salida_carrito_compra_ajax .= '							<div class="title-left">';
	$salida_carrito_compra_ajax .= '								<h3><a href="#">Carrito de compra</a></h3>';
	$salida_carrito_compra_ajax .= '							</div>';
	$salida_carrito_compra_ajax .= '							<div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">';
	$salida_carrito_compra_ajax .= '								<div class="list-group-collapse sub-men">';
	$salida_carrito_compra_ajax .= '									<div class="collapse show" id="sub-men1" data-parent="#list-group-men">';
	$salida_carrito_compra_ajax .= '										<div class="list-group">';
	$salida_carrito_compra_ajax .= '											<div class="col-md-12 col-lg-12">';
	$salida_carrito_compra_ajax .= '												<div class="odr-box">';
	$salida_carrito_compra_ajax .= '													<div class="rounded p-2 bg-light">';

	$conteo = 0;

	$sql_producto = "SELECT cod_carrito_compra_temporal, nombre_producto, und_venta, precio_venta_producto, 
	total_venta_producto, url_img_min_producto, url_img_orig_producto, fecha_seg_venta_producto
	FROM tbl15_carrito_compra_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') 
	ORDER BY cod_carrito_compra_temporal DESC";
	$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
	$total_reg = mysqli_num_rows($consulta_producto);
	while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

		$conteo++;
		$cod_carrito_compra_temporal              = $datos_producto['cod_carrito_compra_temporal'];
		$cod_carrito_compra_temporal_codif        = DAXCODIFCRYPTOR::encodifdax($cod_carrito_compra_temporal);
		$cod_carrito_compra_temporal_codifcryp    = DAXCODIFCRYPTOR::encriptardax($cod_carrito_compra_temporal_codif);
		$nombre_producto                          = $datos_producto['nombre_producto'];
		$und_venta                                = $datos_producto['und_venta'];
		$precio_venta_producto                    = $datos_producto['precio_venta_producto'];
		$total_venta_producto                     = $datos_producto['total_venta_producto'];
		$fecha_seg_venta_producto                 = $datos_producto['fecha_seg_venta_producto'];
		$fecha_hora_venta_producto                = date("H:i", $fecha_seg_venta_producto);
		///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
		if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
		if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
		$url_img_min_producto                     = $datos_producto['url_img_min_producto'];
		$url_img_orig_producto                    = $datos_producto['url_img_orig_producto'];
		$total_venta_ind                          = $und_venta * $precio_venta_producto;
		//$total_venta                             += $und_venta * $precio_venta_producto;

		$salida_carrito_compra_ajax .= '														<div class="media mb-2 border-bottom" id="elim'.$cod_carrito_compra_temporal.'">';
		$salida_carrito_compra_ajax .= '															<div class="media-body"><a class="eliminar" data="'.$cod_carrito_compra_temporal.'" id="cod_carrito_compra_temporal'.$cod_carrito_compra_temporal.'"><i id="eliminar_load'.$cod_carrito_compra_temporal.'" class="fas fa-times"></i></a><span class="mx-2">|</span><a href="#">'.$nombre_producto.'</a><span class="mx-2">|</span>'.$fecha_hora_venta_producto.'';
		$salida_carrito_compra_ajax .= '																<div class="small text-muted">Precio: $'.number_format($precio_venta_producto, 0, ",", ".").'<span class="mx-2">|</span>Cant: '.$und_venta.'<span class="mx-2">|</span>Total: $'.number_format($total_venta_ind, 0, ",", ".").'</div>';
		$salida_carrito_compra_ajax .= '															</div>';
		$salida_carrito_compra_ajax .= '														</div>';
	}
	$salida_carrito_compra_ajax .= '													</div>';
	$salida_carrito_compra_ajax .= '												</div>';
	$salida_carrito_compra_ajax .= '											</div>';
	$salida_carrito_compra_ajax .= '											<div class="col-md-12 col-lg-12">';
	$salida_carrito_compra_ajax .= '												<div class="order-box">';
	$salida_carrito_compra_ajax .= '													<div class="d-flex gr-total">';
	$salida_carrito_compra_ajax .= '														<h5>Total</h5>';
	$salida_carrito_compra_ajax .= '														<div class="ml-auto h5" id="total_venta_tactil_ajax">$ '.number_format($total_venta, 0, ",", ".").'</div>';
	$salida_carrito_compra_ajax .= '													</div>';
	$salida_carrito_compra_ajax .= '													<hr>';
	$salida_carrito_compra_ajax .= '												</div>';
	$salida_carrito_compra_ajax .= '											</div>';
	$salida_carrito_compra_ajax .= '											<div class="col-12 d-flex shopping-box"><button type="submit" class="btn hvr-hover">Facturar Venta</button></div>';
	$salida_carrito_compra_ajax .= '										</div>';
	$salida_carrito_compra_ajax .= '									</div>';
	$salida_carrito_compra_ajax .= '								</div>';
	$salida_carrito_compra_ajax .= '							</div>';
	$salida_carrito_compra_ajax .= '						</div>';
/*  ///////////////////////////////////////////////////////CARRITO COMPRA FIN//////////////////////////////////////////////////////////////// */
}
//************************************************************************************************************************************//
//************************************************************************************************************************************//
$sql_producto = "SELECT cod_carrito_compra_temporal, nombre_producto, und_venta, precio_venta_producto, 
total_venta_producto, url_img_min_producto, url_img_orig_producto FROM tbl15_carrito_compra_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') 
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
	$url_img_orig_producto               = $datos_producto['url_img_orig_producto'];
	//$total_venta                        += $und_venta * $precio_venta_producto;

	$codigoHTML_menu .= '        <li>';
	$codigoHTML_menu .= '            <a href="#" class="photo"><img src="'.$url_img_min_producto.'" class="cart-thumb" alt="" /></a>';
	$codigoHTML_menu .= '            <h6><a href="#">'.$nombre_producto.'</a></h6>';
	$codigoHTML_menu .= '            <p>'.$und_venta.'x - <span class="price">$ '.number_format($precio_venta_producto, 0, ",", ".").'</span></p>';
	$codigoHTML_menu .= '        </li>';
}
$codigoHTML_menu .= '        <li class="total">';
$codigoHTML_menu .= '            <a href="../admin/carrito_compra_temporal_visitante_ext.php" class="btn btn-default hvr-hover btn-cart">VER CARRITO</a>';
$codigoHTML_menu .= '            <span class="float-right"><strong></strong>$ '.number_format($total_venta, 0, ",", ".").'</span>';
$codigoHTML_menu .= '        </li>';
//************************************************************************************************************************************//
//************************************************************************************************************************************//
$datos_array = array('salida_info_actualizada_carrito_compra_menu_total_reg_ajax' => $total_reg, 'salida_info_actualizada_carrito_compra_menu_ajax' => $codigoHTML_menu, 'salida_info_actualizada_carrito_compra_ajax' => $salida_carrito_compra_ajax, 'total_venta_tactil_ajax' => '$ '.number_format($total_venta_tactil, 0, ",", "."), 'salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax' => '$ '.number_format($total_venta_tactil, 0, ",", "."));
echo json_encode($datos_array);
?>
