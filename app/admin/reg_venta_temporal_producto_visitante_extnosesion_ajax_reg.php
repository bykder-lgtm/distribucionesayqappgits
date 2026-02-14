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

if (isset($_REQUEST['cod_producto_barra'])) {

$cod_producto_barra                 = addslashes($_REQUEST['cod_producto_barra']);
$nombre_tipo_moneda                 = addslashes($_REQUEST['nombre_tipo_moneda']);
$nombre_tipo_factura                = addslashes($_REQUEST['nombre_tipo_factura']);
$foco                               = addslashes($_REQUEST['foco']);
$cod_estado_vacuna                  = intval($_REQUEST['cod_estado_vacuna']);
$buscar_por                         = addslashes($_REQUEST['buscar_por']);
$cuenta                             = addslashes($_REQUEST['cuenta']);
$cod_caja_virtual                   = intval($_REQUEST['cod_caja_virtual']);
$cod_base_caja                      = intval($_REQUEST['cod_base_caja']);
$cod_tipo_pedido                    = 1;

if (isset($_REQUEST['cod_tipo_metodo_envio'])) { $cod_tipo_metodo_envio = intval($_REQUEST['cod_tipo_metodo_envio']); } else { $cod_tipo_metodo_envio = '1'; }
if (isset($_REQUEST['cod_tipo_aplicacion'])) { $cod_tipo_aplicacion = intval($_REQUEST['cod_tipo_aplicacion']); } else { $cod_tipo_aplicacion = '1'; }

$pagina                             = addslashes($_REQUEST['pagina'])."?&foco=".$foco."&buscar_por=".$buscar_por."&cuenta=".$cuenta."&cod_caja_virtual=".$cod_caja_virtual."&pagina=facturacion_venta_temporal_producto_manual_pos.php";
$retorno_array                      = array();
$retorno_array2                     = array();
$codigoHTML_menu                    = '';
$codigoHTML_menu_total_reg          = '';
$salida_carrito_compra_ajax         = '';

$sql_producto = "SELECT * FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$existe_producto = mysqli_num_rows($consulta_producto);
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$cod_producto                       = $datos_producto['cod_producto'];
//$cod_producto_barra                 = $datos_producto['cod_producto_barra'];
$nombre_producto                    = $datos_producto['nombre_producto'];
$und_producto                       = $datos_producto['und_producto'];
$precio_compra_producto             = $datos_producto['precio_compra_producto'];
$precio_costo_producto              = $datos_producto['precio_costo_producto'];
$precio_venta_producto              = $datos_producto['precio_venta_producto'];
$precio_venta_producto2             = $datos_producto['precio_venta_producto2'];
$precio_venta_producto3             = $datos_producto['precio_venta_producto3']; 
$precio_venta_producto4             = $datos_producto['precio_venta_producto4'];
$precio_venta_producto5             = $datos_producto['precio_venta_producto5'];
$nombre_tipo_unidad_medida          = $datos_producto['nombre_tipo_unidad_medida'];
$posologia_cantidad                 = $datos_producto['posologia_cantidad'];
$posologia_peso                     = $datos_producto['posologia_peso'];
$iva_ptj                            = $datos_producto['iva_ptj'];
$nombre_tipo_producto               = $datos_producto['nombre_tipo_producto'];
$nombre_tipo_presentacion           = $datos_producto['nombre_tipo_presentacion'];
$nombre_via_administracion          = $datos_producto['nombre_via_administracion'];
$nombre_frec_duracion               = $datos_producto['nombre_frec_duracion'];
$cod_marca                          = $datos_producto['cod_marca'];
$cod_proveedor                      = $datos_producto['cod_proveedor'];
$cod_estado                         = $datos_producto['cod_estado'];
$cod_dependencia                    = $datos_producto['cod_dependencia'];
$fecha_ult_compra                   = $datos_producto['fecha_ult_compra'];
$fecha_ult_venta                    = $datos_producto['fecha_ult_venta'];
$fecha_vencimiento1                 = $datos_producto['fecha_vencimiento1'];
$vencimiento_lote1                  = $datos_producto['vencimiento_lote1'];
$fecha_vencimiento2                 = $datos_producto['fecha_vencimiento2'];
$vencimiento_lote2                  = $datos_producto['vencimiento_lote2'];
$tope_min                           = $datos_producto['tope_min'];
$fecha_creacion                     = $datos_producto['fecha_creacion'];
$fecha_modificacion                 = $datos_producto['fecha_modificacion'];
$cod_info_factura_compra            = $datos_producto['cod_info_factura_compra'];
$nombre_tipo_precio                 = $datos_producto['nombre_tipo_precio'];
$nombre_tipo_precio_venta           = $datos_producto['nombre_tipo_precio_venta'];
$cod_opcion_descontable_inv         = $datos_producto['cod_opcion_descontable_inv'];
$url_img_orig_producto              = $datos_producto['url_img_orig_producto'];
$url_img_min_producto               = $datos_producto['url_img_min_producto'];

$fecha_ymd_venta_producto           = date("Y-m-d");
$fecha_mes_venta_producto           = date("Y-m");
$fecha_anyo_venta_producto          = date("Y");
$fecha_seg_venta_producto           = time();
//$cuenta                             = $cuenta_actual;
$cod_estado_factura                 = '1';
$descuento_ptj                      = '0';
$flete_ptj                          = '0';
$vlr_cancelado                      = '';
$vlr_vuelto                         = '';
$fecha_dia                          = strtotime(date("Y/m/d"));
$fecha_mes                          = date("Y-m");
$fecha_anyo                         = date("Y-m-d");
$anyo                               = date("Y");
$fecha_hora                         = date("H:i:s");
$fecha_remision                     = date("Y-m-d");
$nombre_ccosto                      = '';
$garantia_meses                     = '';
$observacion                        = '';
$cod_tipo_pago                      = '1';
$cod_empresa                        = '0';
$fecha_ymdhis                       = date("Y-m-d H:is");
$cod_tipo_cobrar                    = '1';
$cod_tercero                        = '1';
$nombre_estado_factura              = 'ABIERTA';
$cod_tipo_forma_pago                = "1";
$und_venta                          = "1";
$total_compra_producto              = $precio_compra_producto;
$total_costo_producto               = $precio_costo_producto;
$total_venta_producto               = $precio_venta_producto;
$cod_tipo_inventario                = "1";
$precio_venta_producto_orig         = $precio_venta_producto;

if ($total_costo_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

if ($nombre_tipo_precio_venta=='PV1') { $precio_venta_producto = $precio_venta_producto; $total_venta_producto = $precio_venta_producto; } 
elseif ($nombre_tipo_precio_venta=='PV2') { $precio_venta_producto = $precio_venta_producto2; $total_venta_producto = $precio_venta_producto2; } 
elseif ($nombre_tipo_precio_venta=='PV3') { $precio_venta_producto = $precio_venta_producto3; $total_venta_producto = $precio_venta_producto3; } 
elseif ($nombre_tipo_precio_venta=='PV4') { $precio_venta_producto = $precio_venta_producto4; $total_venta_producto = $precio_venta_producto4; } 
elseif ($nombre_tipo_precio_venta=='PV5') { $precio_venta_producto = $precio_venta_producto5; $total_venta_producto = $precio_venta_producto5; } 
elseif ($nombre_tipo_precio_venta=='PVAR') { $precio_venta_producto = $precio_venta_producto; $total_venta_producto = $precio_venta_producto; } 
else { $precio_venta_producto = $precio_venta_producto; $total_venta_producto = $precio_venta_producto; }

$datos_info = "SELECT * FROM tbl15_info_factura_venta_carrito_compra WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
$factura_abierta = mysqli_num_rows($consulta_info);
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
if ($factura_abierta == '0') {

$sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_factura_venta_carrito_compra WHERE (nombre_estado_factura = '$nombre_estado_factura')";
$consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
$datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

$cod_prioridad                      = $datos_max_prioridad['cod_prioridad']+1;

$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta_carrito_compra'";
$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

$cod_info_factura_venta_carrito_compra             = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = "INSERT INTO tbl15_info_factura_venta_carrito_compra (cod_info_factura_venta_carrito_compra, cod_tipo_pedido, nombre_estado_factura, fecha_ymdhis, 
cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, cod_tipo_forma_pago, 
nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_tipo_inventario, cod_prioridad, cod_base_caja, cod_tipo_metodo_envio, cod_tipo_aplicacion) 
VALUES ('$cod_info_factura_venta_carrito_compra', '$cod_tipo_pedido', '$nombre_estado_factura', '$fecha_ymdhis', 
'$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', 
'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_tipo_inventario', '$cod_prioridad', '$cod_base_caja', '$cod_tipo_metodo_envio', '$cod_tipo_aplicacion')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$sql_data = "INSERT INTO tbl15_carrito_compra_temporal (cod_info_factura_venta_carrito_compra, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_venta, 
precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
precio_venta_producto, total_venta_producto, posologia_cantidad, posologia_peso, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, 
nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
cod_administrador, cod_tipo_cobrar, cod_estado_vacuna, cod_caja_virtual, nombre_tipo_precio_venta, cod_estado_permitir_venta, 
precio_venta_producto_orig, und_producto, cod_base_caja, cod_opcion_descontable_inv, url_img_orig_producto, url_img_min_producto) 
VALUES ('$cod_info_factura_venta_carrito_compra', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', 
'$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', 
'$precio_venta_producto', '$total_venta_producto', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', 
'$nombre_via_administracion', '$nombre_frec_duracion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
'$cod_administrador', '$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$cod_estado_permitir_venta',
'$precio_venta_producto_orig', '$und_producto', '$cod_base_caja', '$cod_opcion_descontable_inv', '$url_img_orig_producto', '$url_img_min_producto')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//---------------------------------------------------------------------FACTURA NUEVA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
}
//---------------------------------------------------------------------FACTURA ABIERTA INICIO----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA ABIERTA INICIO----------------------------------------------------------------//
else { 

$sql_info_factura = "SELECT cod_info_factura_venta_carrito_compra, cod_tercero FROM tbl15_info_factura_venta_carrito_compra WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
$datos_info_factura = mysqli_fetch_assoc($consulta_info_factura);

$cod_info_factura_venta_carrito_compra             = $datos_info_factura['cod_info_factura_venta_carrito_compra'];
$cod_tercero                        = $datos_info_factura['cod_tercero'];
$fecha_ymdhis                       = date("Y-m-d H:is");

$sql_data = "INSERT INTO tbl15_carrito_compra_temporal (cod_info_factura_venta_carrito_compra, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_venta, 
precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
precio_venta_producto, total_venta_producto, posologia_cantidad, posologia_peso, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, 
nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
cod_administrador, cod_tipo_cobrar, cod_estado_vacuna, cod_caja_virtual, nombre_tipo_precio_venta, precio_venta_producto_orig, und_producto, cod_base_caja, 
cod_opcion_descontable_inv, url_img_orig_producto, url_img_min_producto) 
VALUES ('$cod_info_factura_venta_carrito_compra', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', 
'$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', 
'$precio_venta_producto', '$total_venta_producto', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', 
'$nombre_via_administracion', '$nombre_frec_duracion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
'$cod_administrador', '$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$precio_venta_producto_orig', '$und_producto', '$cod_base_caja', 
'$cod_opcion_descontable_inv', '$url_img_orig_producto', '$url_img_min_producto')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
//---------------------------------------------------------------------FACTURA ABIERTA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA ABIERTA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
$total_venta                    = 0;
$conteo                         = 0;
//************************************************************************************************************************************//
//************************************************************************************************************************************//

$sql_producto_total = "SELECT SUM(und_venta * precio_venta_producto) as total_venta FROM tbl15_carrito_compra_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_producto_total = mysqli_query($conectar, $sql_producto_total) or die(mysqli_error($conectar));
$datos_producto_total = mysqli_fetch_assoc($consulta_producto_total);

$total_venta              = $datos_producto_total['total_venta'];

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
$codigoHTML_menu .= '            <a href="../admin/carrito_compra_temporal_visitante_extnosesion.php" class="btn btn-default hvr-hover btn-cart">VER CARRITO</a>';
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
total_venta_producto, url_img_min_producto, url_img_orig_producto FROM tbl15_carrito_compra_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') 
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
///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
$url_img_min_producto                     = $datos_producto['url_img_min_producto'];
$url_img_orig_producto                    = $datos_producto['url_img_orig_producto'];
$total_venta_ind                          = $und_venta * $precio_venta_producto;
//$total_venta                             += $und_venta * $precio_venta_producto;

$salida_carrito_compra_ajax .= '														<div class="media mb-2 border-bottom">';
$salida_carrito_compra_ajax .= '															<div class="media-body"> <a href="#">'.$nombre_producto.'</a>';
$salida_carrito_compra_ajax .= '																<div class="small text-muted"><a class="eliminar" data="'.$cod_carrito_compra_temporal.'" id="cod_carrito_compra_temporal'.$cod_carrito_compra_temporal.'"><i id="eliminar_load'.$cod_carrito_compra_temporal.'" class="fas fa-times"></i></a><span class="mx-2">|</span>Precio: $'.number_format($precio_venta_producto, 0, ",", ".").'<span class="mx-2">|</span>Cant: '.$und_venta.'<span class="mx-2">|</span>Total: $'.number_format($total_venta_ind, 0, ",", ".").'</div>';
$salida_carrito_compra_ajax .= '															</div>';
$salida_carrito_compra_ajax .= '														</div>';
}
$salida_carrito_compra_ajax .= '													</div>';
$salida_carrito_compra_ajax .= '												</div>';
$salida_carrito_compra_ajax .= '											</div>';
$salida_carrito_compra_ajax .= '											<div class="col-md-12 col-lg-12">';
$salida_carrito_compra_ajax .= '												<div class="order-box">';
$salida_carrito_compra_ajax .= '													<div class="d-flex">';
$salida_carrito_compra_ajax .= '														<h4>SubTotal</h4>';
$salida_carrito_compra_ajax .= '														<div class="ml-auto font-weight-bold">$ '.number_format($total_venta, 0, ",", ".").'</div>';
$salida_carrito_compra_ajax .= '													</div>';
$salida_carrito_compra_ajax .= '													<hr>';
$salida_carrito_compra_ajax .= '													<div class="d-flex gr-total">';
$salida_carrito_compra_ajax .= '														<h5>Total</h5>';
$salida_carrito_compra_ajax .= '														<div class="ml-auto h5">$ '.number_format($total_venta, 0, ",", ".").'</div>';
$salida_carrito_compra_ajax .= '													</div>';
$salida_carrito_compra_ajax .= '													<hr>';
$salida_carrito_compra_ajax .= '												</div>';
$salida_carrito_compra_ajax .= '											</div>';
$salida_carrito_compra_ajax .= '											<div class="col-12 d-flex shopping-box"><button type="submit" class="btn hvr-hover">Realizar pedido</button></div>';
$salida_carrito_compra_ajax .= '										</div>';
$salida_carrito_compra_ajax .= '									</div>';
$salida_carrito_compra_ajax .= '								</div>';
$salida_carrito_compra_ajax .= '							</div>';
$salida_carrito_compra_ajax .= '						</div>';
/*  ///////////////////////////////////////////////////////CARRITO COMPRA FIN//////////////////////////////////////////////////////////////// */
//************************************************************************************************************************************//
//************************************************************************************************************************************//
//$datos_array['salida_info_actualizada_carrito_compra_menu_total_reg_ajax']             = $total_reg;
//$datos_array['salida_info_actualizada_carrito_compra_menu_ajax']                       = $codigoHTML_menu;
//array_push($retorno_array, $datos_array);
//echo json_encode($retorno_array);

$datos_array = array('salida_info_actualizada_carrito_compra_menu_total_reg_ajax' => $total_reg, 'salida_info_actualizada_carrito_compra_menu_ajax' => $codigoHTML_menu, 'salida_info_actualizada_carrito_compra_ajax' => $salida_carrito_compra_ajax);
echo json_encode($datos_array);
} 
?>
