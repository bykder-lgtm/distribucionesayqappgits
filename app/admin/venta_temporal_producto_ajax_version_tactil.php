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
if (isset($_REQUEST['cod_tipo_aplicacion'])) { $cod_tipo_aplicacion = intval($_REQUEST['cod_tipo_aplicacion']); } else { $cod_tipo_aplicacion = '0'; }
if (isset($_REQUEST['cod_info_factura_venta'])) { $cod_info_factura_venta = intval($_REQUEST['cod_info_factura_venta']); } else { $cod_info_factura_venta = '0'; }

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
//************************************************************************************************************************************//
//************************************************************************************************************************************//
//************************************************************************************************************************************//
//************************************************************************************************************************************//
if (($tipo_accion == 'eliminar') && ($tab == 'tbl15_venta_producto_temporal')) {

	$cod_venta_producto_temporal        = intval($id);

	$sql_venta_temporal = "SELECT cod_producto_barra, und_venta, fecha_seg_venta_producto FROM tbl15_venta_producto_temporal WHERE (cod_venta_producto_temporal = '$cod_venta_producto_temporal')";
	$consulta_venta_temporal = mysqli_query($conectar, $sql_venta_temporal) or die(mysqli_error($conectar));
	$datos_venta_temporal = mysqli_fetch_assoc($consulta_venta_temporal);

	$cod_producto_barra                = $datos_venta_temporal['cod_producto_barra'];
	$fecha_seg_venta_producto          = $datos_venta_temporal['fecha_seg_venta_producto'];
	$und_venta                         = $datos_venta_temporal['und_venta'];
	$fecha_hora_venta_producto         = date("H:i", $fecha_seg_venta_producto);

	$borrar_sql = sprintf("DELETE FROM tbl15_venta_producto_temporal WHERE cod_venta_producto_temporal = '$cod_venta_producto_temporal'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

	$datos_info_factura_cero = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_info_factura_cero = mysqli_query($conectar, $datos_info_factura_cero) or die(mysqli_error($conectar));
	$existe_factura_abierta_cero = mysqli_num_rows($consulta_info_factura_cero);

	if ($existe_factura_abierta_cero == 0) {
	$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_estado_factura = 'ABIERTA')");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	}

	$sql_producto = "SELECT * FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
	$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
	$existe_producto = mysqli_num_rows($consulta_producto);
	$datos_producto = mysqli_fetch_assoc($consulta_producto);

	$nombre_promocion_ing               = $datos_producto['nombre_promocion_ing'];
	$nombre_promocion                   = $datos_producto['nombre_promocion'];
	$url_img_orig_producto              = $datos_producto['url_img_orig_producto'];
	$nombre_producto                    = $datos_producto['nombre_producto'];
	$precio_venta_producto              = $datos_producto['precio_venta_producto'];
	$total_venta_ind                    = $und_venta * $precio_venta_producto;
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//
if (($tipo_accion == 'registrar') && ($tab == 'tbl15_venta_producto_temporal')) {

	$cod_producto_barra                 = addslashes($_REQUEST['cod_producto_barra']);;

	$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_venta_producto_temporal'";
	$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
	$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

	$cod_venta_producto_temporal        = $datos_autoincremento_info_factura['AUTO_INCREMENT'];

	$sql_producto = "SELECT * FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
	$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
	$existe_producto = mysqli_num_rows($consulta_producto);
	$datos_producto = mysqli_fetch_assoc($consulta_producto);

	$cod_producto                       = $datos_producto['cod_producto'];
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
	$nombre_promocion_ing               = $datos_producto['nombre_promocion_ing'];
	$nombre_promocion                   = $datos_producto['nombre_promocion'];

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
	$fecha_hora_venta_producto          = date("H:i", $fecha_seg_venta_producto);
	$total_venta_ind                    = $und_venta * $precio_venta_producto;

	if ($total_costo_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

	if ($nombre_tipo_precio_venta=='PV1') { $precio_venta_producto = $precio_venta_producto; $total_venta_producto = $precio_venta_producto; } 
	elseif ($nombre_tipo_precio_venta=='PV2') { $precio_venta_producto = $precio_venta_producto2; $total_venta_producto = $precio_venta_producto2; } 
	elseif ($nombre_tipo_precio_venta=='PV3') { $precio_venta_producto = $precio_venta_producto3; $total_venta_producto = $precio_venta_producto3; } 
	elseif ($nombre_tipo_precio_venta=='PV4') { $precio_venta_producto = $precio_venta_producto4; $total_venta_producto = $precio_venta_producto4; } 
	elseif ($nombre_tipo_precio_venta=='PV5') { $precio_venta_producto = $precio_venta_producto5; $total_venta_producto = $precio_venta_producto5; } 
	elseif ($nombre_tipo_precio_venta=='PVAR') { $precio_venta_producto = $precio_venta_producto; $total_venta_producto = $precio_venta_producto; } 
	$datos_info = "SELECT * FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
	$factura_abierta = mysqli_num_rows($consulta_info);
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
	if ($factura_abierta == '0') {

		$sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura')";
		$consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
		$datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

		$cod_prioridad                      = $datos_max_prioridad['cod_prioridad']+1;

		$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
		$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
		$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

		$cod_info_factura_venta             = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
	//---------------------------------------------------------------------------------------------------------------------------------------------//
		$sql_data = "INSERT INTO tbl15_info_factura_venta (cod_info_factura_venta, cod_tipo_pedido, nombre_estado_factura, fecha_ymdhis, 
		cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
		fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, cod_tipo_forma_pago, 
		nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_tipo_inventario, cod_prioridad, cod_base_caja, cod_tipo_metodo_envio, cod_tipo_aplicacion) 
		VALUES ('$cod_info_factura_venta', '$cod_tipo_pedido', '$nombre_estado_factura', '$fecha_ymdhis', 
		'$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
		'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', 
		'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_tipo_inventario', '$cod_prioridad', '$cod_base_caja', '$cod_tipo_metodo_envio', '$cod_tipo_aplicacion')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$sql_data = "INSERT INTO tbl15_venta_producto_temporal (cod_info_factura_venta, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_venta, 
		precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
		precio_venta_producto, total_venta_producto, posologia_cantidad, posologia_peso, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, 
		nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
		cod_administrador, cod_tipo_cobrar, cod_estado_vacuna, cod_caja_virtual, nombre_tipo_precio_venta, cod_estado_permitir_venta, 
		precio_venta_producto_orig, und_producto, cod_base_caja, cod_opcion_descontable_inv, url_img_orig_producto, url_img_min_producto) 
		VALUES ('$cod_info_factura_venta', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', 
		'$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', 
		'$precio_venta_producto', '$total_venta_producto', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', 
		'$nombre_via_administracion', '$nombre_frec_duracion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
		'$cod_administrador', '$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$cod_estado_permitir_venta',
		'$precio_venta_producto_orig', '$und_producto', '$cod_base_caja', '$cod_opcion_descontable_inv', '$url_img_orig_producto', '$url_img_min_producto')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
//---------------------------------------------------------------------FACTURA NUEVA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//

//---------------------------------------------------------------------FACTURA ABIERTA INICIO----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA ABIERTA INICIO----------------------------------------------------------------//
	else { 

		$sql_info_factura = "SELECT cod_info_factura_venta, cod_tercero FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
		$consulta_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
		$datos_info_factura = mysqli_fetch_assoc($consulta_info_factura);

		$cod_info_factura_venta                            = $datos_info_factura['cod_info_factura_venta'];
		$cod_tercero                                       = $datos_info_factura['cod_tercero'];
		$fecha_ymdhis                                      = date("Y-m-d H:is");

		$sql_data = "INSERT INTO tbl15_venta_producto_temporal (cod_info_factura_venta, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_venta, 
		precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
		precio_venta_producto, total_venta_producto, posologia_cantidad, posologia_peso, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, 
		nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
		cod_administrador, cod_tipo_cobrar, cod_estado_vacuna, cod_caja_virtual, nombre_tipo_precio_venta, precio_venta_producto_orig, und_producto, cod_base_caja, 
		cod_opcion_descontable_inv, url_img_orig_producto, url_img_min_producto) 
		VALUES ('$cod_info_factura_venta', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', 
		'$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', 
		'$precio_venta_producto', '$total_venta_producto', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', 
		'$nombre_via_administracion', '$nombre_frec_duracion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
		'$cod_administrador', '$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$precio_venta_producto_orig', '$und_producto', '$cod_base_caja', 
		'$cod_opcion_descontable_inv', '$url_img_orig_producto', '$url_img_min_producto')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
}
//------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------------------------------------------------------------------------------------------------------//

//************************************************************************************************************************************//
//************************************************************************************************************************************//
//************************************************************************************************************************************//
//************************************************************************************************************************************//
	$sql_producto_total = "SELECT SUM(und_venta * precio_venta_producto) as total_venta FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_producto_total = mysqli_query($conectar, $sql_producto_total) or die(mysqli_error($conectar));
	$datos_producto_total = mysqli_fetch_assoc($consulta_producto_total);

	$total_venta              = $datos_producto_total['total_venta'];
	$total_venta_tactil       = $total_venta;

	$sql_producto = "SELECT cod_venta_producto_temporal FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
	$total_datos = mysqli_num_rows($consulta_producto);
//************************************************************************************************************************************//
//************************************************************************************************************************************//
$datos_array = array(
	'salida_info_actualizada_carrito_compra_menu_total_reg_ajax' => $total_datos, 
	'total_venta_tactil_ajax' => '$ '.number_format($total_venta_tactil, 0, ",", "."), 
	'salida_info_actualizada_carrito_compra_menu_total_venta_reg_ajax' => '$ '.number_format($total_venta_tactil, 0, ",", "."), 
	'cod_venta_producto_temporal' => $cod_venta_producto_temporal, 
	'cod_producto_barra' => $cod_producto_barra, 
	'nombre_promocion_ing' => $nombre_promocion_ing, 
	'nombre_promocion' => $nombre_promocion, 
	'url_img_orig_producto' => $url_img_orig_producto, 
	'nombre_producto' => $nombre_producto, 
	'und_venta' => intval($und_venta), 
	'total_venta_ind' => number_format($total_venta_ind, 0, ",", "."), 
	'fecha_hora_venta_producto' => $fecha_hora_venta_producto, 
	'precio_venta_producto' => number_format($precio_venta_producto, 0, ",", "."));

echo json_encode($datos_array);
?>
