<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                  = $_SESSION['usuario'];
$cod_administrador                       = $_SESSION['cod_administrador'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_info_factura_compra                 = intval($_POST['cod_info_factura_compra']);
$cod_tercero                             = intval($_POST['cod_tercero']);
$cod_tipo_forma_pago                     = intval($_POST['cod_tipo_forma_pago']);
$cod_tipo_pago                           = intval($_POST['cod_tipo_pago']);
$valor                                   = intval($_POST['valor']);
$campo                                   = addslashes($_POST['campo']);
$tipo_ajax                               = addslashes($_POST['tipo_ajax']);
$opcion                                  = addslashes($_POST['opcion']);
$array_precio_compra_producto            = explode("+", $valor);
$total_datos_data                        = count($array_precio_compra_producto);
$total_datos                             = $total_datos_data;
$array_recibido                          = explode("|", $valor);
$fecha_anyo                              = date('Y-m-d');

$nombre_rete_fuente_ptj                  = 0;
$ret_ica_ptj                             = 0;
$subtotal                                = $valor;
$total_valor_iva                         = 0;
$total_descuento                         = 0;
$total_precio_ipc                        = 0;
$total_compra_imp                        = 0;
$total_rete_fuente                       = 0;
$total_ret_ica                           = 0;
$total_factura_compra_retefuente         = $valor;
$vlr_cancelado                           = 0;
$fecha_anyo_seg                          = strtotime($fecha_anyo);
$nombre_estado_factura                   = 'CERRADA';
$nombre_maquina                          = gethostname();
$fecha_ult_compra                        = date("Y-m-d");
$total                                   = $valor;
$subtotal_total_precio_compra            = $valor;
$subtotal_total_precio_costo             = $valor;
$total_factura_compra                    = $valor;
$fecha_compra                            = $fecha_anyo;

$fecha_pago_abono                        = date("Y-m-d");
$fecha                                   = date("Y-m-d");
$fecha_invert                            = date("Y-m-d");
$fecha_seg                               = time();
$fecha_creacion                          = date("Y-m-d H:i:s");
$fecha_hoy                               = date("Y-m-d");
$vlr_vuelto                              = 0;
$cod_factura                             = '';

$total_precio_costo                      = $valor;
$total_precio_compra                     = $valor;
$total_precio_venta                      = $valor;
$total_compra_precio_costo               = $valor;
$total_compra_precio_compra              = $valor;
$total_compra_precio_venta               = $valor;
$precio_compra_producto_ant_desc         = $valor;
$total_compra_producto_ant_desc          = $valor;
$total_inv_compra_desp_factura           = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_tipo_inventario'])) { $cod_tipo_inventario = intval($_POST['cod_tipo_inventario']); } else { $cod_tipo_inventario = '1'; }
if (isset($_POST['cod_tipo_producto_consumo'])) { $cod_tipo_producto_consumo = intval($_POST['cod_tipo_producto_consumo']); } else { $cod_tipo_producto_consumo = '1'; }
if (isset($_POST['nombre_tipo_compra'])) { $nombre_tipo_compra = addslashes($_POST['nombre_tipo_compra']); } else { $nombre_tipo_compra = 'NORMAL'; }
if (isset($_POST['nombre_tipo_moneda'])) { $nombre_tipo_moneda = addslashes($_POST['nombre_tipo_moneda']); } else { $nombre_tipo_moneda = 'COP'; }
if (isset($_POST['nombre_tipo_factura'])) { $nombre_tipo_factura = addslashes($_POST['nombre_tipo_factura']); } else { $nombre_tipo_factura = 'POS'; }
if (isset($_POST['nombre_tipo_cargue_factura'])) { $nombre_tipo_cargue_factura = addslashes($_POST['nombre_tipo_cargue_factura']); } else { $nombre_tipo_cargue_factura = 'FACTURA_COMPRA_NORMAL'; }
if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }

$sql_max_factura = "SELECT MAX(cod_factura) AS cod_factura FROM tbl15_info_factura_compra WHERE (nombre_tipo_cargue_factura = 'FACTURA_COMPRA_DOC_SOPORTE')";
$consulta_max_factura = mysqli_query($conectar, $sql_max_factura) or die(mysqli_error($conectar));
$datos_max_factura = mysqli_fetch_assoc($consulta_max_factura);

if ($nombre_tipo_cargue_factura == 'FACTURA_COMPRA_DOC_SOPORTE') { $cod_factura = $datos_max_factura['cod_factura']+1; } else { $cod_factura = $cod_factura; } 
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_tipo_inventario == '1') { $campo_und_inventario = 'und_producto'; } elseif ($cod_tipo_inventario == '2') { $campo_und_inventario = 'und_producto_bodega'; } else { $campo_und_inventario = 'und_producto'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$time                                    = time();
$fecha_ymdHis                            = date("YmdHis");
$formato                                 = 'jpg';
$fecha_hora                              = date("H:i:s");
$fecha_ymd                               = date("Y-m-d");
$nombre_origen_cargue                    = "CARGUE_FACTURA_COMPRA";
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion 
WHERE (nombre_tipo_resolucion_facturacion = '$nombre_tipo_factura') AND (nombre_tipo_estado = 'ACTIVO')";
$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

$cod_resolucion_facturacion              = intval($matriz_resol_fact['cod_resolucion_facturacion']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_totales_inv = "SELECT SUM(und_producto * precio_costo_producto) AS total_inv_precio_costo, SUM(und_producto * precio_compra_producto) AS total_inv_precio_compra, 
SUM(und_producto * precio_venta_producto) AS total_inv_precio_venta FROM tbl15_producto";
$consulta_totales_inv = mysqli_query($conectar, $sql_totales_inv) or die(mysqli_error($conectar));
$datos_totales_inv = mysqli_fetch_assoc($consulta_totales_inv);

$total_inv_precio_costo                  = $datos_totales_inv['total_inv_precio_costo'];
$total_inv_precio_compra                 = $datos_totales_inv['total_inv_precio_compra'];
$total_inv_precio_venta                  = $datos_totales_inv['total_inv_precio_venta'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_imp_factura = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$modificar_info_imp_factura = mysqli_query($conectar, $sql_info_imp_factura) or die(mysqli_error($conectar));
$total_encontrado_info_imp_factura = mysqli_num_rows($modificar_info_imp_factura);
$matriz_info_imp_factura  = mysqli_fetch_assoc($modificar_info_imp_factura);

$fecha_ymdhis                            = $matriz_info_imp_factura['fecha_ymdhis'];
//$cuenta                                  = $cuenta_actual;
$cod_estado_factura                      = '0';
$descuento_ptj                           = '0';
$iva_ptj                                 = '0';
$flete_ptj                               = '0';
//$cod_cliente                             = '0';
$vlr_vuelto                              = '0';
$fecha_dia                               = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                               = date("Y-m", $fecha_anyo_seg);
$anyo                                    = date("Y", $fecha_anyo_seg);
$fecha_hora_venta_producto               = date("H:i:s");
$fecha_remision                          = $matriz_info_imp_factura['fecha_remision'];
$nombre_ccosto                           = $matriz_info_imp_factura['nombre_ccosto'];
$garantia_meses                          = $matriz_info_imp_factura['garantia_meses'];
$observacion                             = $matriz_info_imp_factura['observacion'];
//$cod_administrador                       = $matriz_info_imp_factura['cod_administrador'];
$fecha_ymd_venta_producto                = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes_venta_producto                = date("Y-m", $fecha_anyo_seg);
$fecha_anyo_venta_producto               = date("Y", $fecha_anyo_seg);
$fecha_seg_venta_producto                = time();
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------- LLAVE DE INICIO DEL CONDICIONAL VENDER POR CONTADO ---------------------------------------//
$respuesta_ajax                          = array();
// ------------------------------------------------------------------------------------------------- //
$fecha_ymdHis                            = date("YmdHis");
$ruta_firma_miniatura                    = '../archivador/firma/miniatura/';
$ruta_foto_miniatura                     = '../archivador/foto/miniatura/';
$ruta_firma_orig                         = '../archivador/firma/original/';
$ruta_foto_orig                          = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
if ($url_img1 <> '') { 
	$formato_img2                    = explode(".", $url_img1);
	$formato_img2                    = end($formato_img2);
	$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_info_factura_compra.'_'.$cod_tercero.'_'.$cod_administrador.'.'.$formato_img2;
	$url_img_orig_producto           = $ruta_foto_orig.$nombre_normal2;
	$url_img_min_producto            = $ruta_foto_orig.$nombre_normal2;
	copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
} else { 
	$formato_img2                    = "";
	$formato_img2                    = "";
	$nombre_normal2                  = "";
	$url_img_orig_producto           = "";
	$url_img_min_producto            = "";
}
// ------------------------------------------------------------------------------------------------- //
$datos_info = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_estado_factura = '1') AND (cuenta = '$cuenta_actual')";
$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
$info = mysqli_fetch_assoc($consulta_info);
$factura_ocupada = mysqli_num_rows($consulta_info);
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_modificar_und_venta_una_sola_vez_global                = $info_empresa_data['cod_estado_modificar_und_venta_una_sola_vez_global'];
// ------------------------------------------------------------------------------------------------- //
$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_compra WHERE (nombre_tipo_factura = '$nombre_tipo_factura') AND (nombre_estado_factura = 'CERRADA')";
$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

$cod_factura                         = $maxima_factura['cod_factura']+1;
// ------------------------------------------------------------------------------------------------- //
$cod_producto                        = '0';
$cod_producto_barra                  = '999999';
$nombre_producto                     = 'PRODUCTOS VARIOS';
$und_venta                           = '1';
$precio_compra_producto              = $valor;
$total_compra_producto               = $valor;
$precio_costo_producto               = $valor;
$total_costo_producto                = $valor;
$nombre_tipo_producto                = 'PRODUCTO';
$und_producto                        = '0';
$und_producto_bodega_inv             = '0';
$nombre_tipo_unidad_medida           = 'UND';
$iva_ptj                             = '0';
$cod_caja_virtual                    = '1';
$nombre_tipo_precio_venta            = 'PV1';
$nombre_tipo_moneda                  = 'COP';
$cod_dependencia                     = '1';
$cod_categoria                       = '1';
$cod_categoria_sub                   = '1';
$total_precio_compra                 = '0';
$cod_tipo_inventario                 = '1';
$comentario_producto                 = '';
$direccion_tercero                   = 'CAJA_REG';

$cod_doc_soporte                     = '';
$und_compra                          = '1';
$und_producto                        = '';
$und_producto_bodega                 = '';
$und_unidades                        = '';
$und_caja                            = '';
$unidades_total                      = '1';
$precio_venta_producto               = $valor;
$precio_venta_producto2              = '';
$precio_venta_producto3              = '';
$precio_venta_producto4              = '';
$precio_venta_producto5              = '';
$total_venta_producto                = $valor;
$nombre_tipo_presentacion            = '';
$fecha_alerta                        = '';
$nombre_tipo_precio                  = 'PVAR';
$nombre_tipo_precio_venta            = 'PVAR';
$comision_ptj                        = '';
$dto1                                = '';
$dto2                                = '';
$descuento                           = '';
$total_dto                           = '';
$iva_ptj                             = '';
$total_iva                           = '';
$valor_iva                           = '';
$ganancia_ptj                        = '';
$fecha_vencimiento                   = '';
$lote_vencimiento                    = '';
$precio_compra_producto_viejo        = '';
$precio_costo_producto_viejo         = '';
$cod_dependencia                     = '';
$ipc_ptj                             = '';
$precio_ipc                          = '';
$precio_ipc_total                    = '';
$ret_ica_ptj                         = '';
$total_ret_ica                       = '';
$iva_teorico_ptj                     = '';
$total_iva_teorico                   = '';
$tarifa_rete_vigente_ptj             = '';
$total_tarifa_rete_vigente           = '';
$rete_iva_asumido_ptj                = '';
$total_rete_iva_asumido              = '';
$nombre_tipo_bienes_serv             = '';
$nombre_tipo_medida                  = '';
$cajas                               = '';
$cajas_sobre                         = '';
$und_sobre                           = '';
$check_caja                          = '';
$check_und                           = '';
$chk                                 = '';
$cod_interno                         = '';
$cod_proveedor                       = '';
$cod_original                        = '';
$codificacion                        = '';
$nombre_proveedor                    = '';
$tope_min                            = '';
$posologia_cantidad                  = '';
$posologia_peso                      = '';
$nombre_frec_duracion                = '';
$nombre_via_administracion           = '';
$cod_tipo_cobrar                     = '';
$cod_estado_vacuna                   = '';
$cod_estado_permitir_venta           = '';
$cod_base_caja                       = '';
$cod_guia                            = '';
$cod_tipo_inventario                 = '';
$cod_tipo_producto_consumo           = '';
$fecha_mantenimiento                 = '';
$meses_mantenimiento                 = '';
$meses_garantia                      = '';
$peso_producto                       = '';
$unidad_medida_peso                  = '';
$precio_compra_producto_ant_desc     = '';
$total_compra_producto_ant_desc      = '';
$und_producto_inv                    = '';

$fecha_anyo_seg                      = strtotime($fecha_anyo);
$cod_estado_factura                  = '0';
$descuento_ptj                       = '0';
$iva_ptj                             = '0';
$flete_ptj                           = '0';
$vlr_vuelto                          = '0';
$fecha_dia                           = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                           = date("m-Y", $fecha_anyo_seg);
$anyo                                = date("Y", $fecha_anyo_seg);
$fecha_hora                          = date("H:i:s");
$fecha_hora_factura_compra_producto  = date("H:i:s");
$fecha_ymd_factura_compra_producto   = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes_factura_compra_producto   = date("m-Y", $fecha_anyo_seg);
$fecha_anyo_factura_compra_producto  = date("Y", $fecha_anyo_seg);
$fecha_seg_factura_compra_producto   = time();
$fecha_pago                          = $fecha_anyo;
// ------------------------------------------------------------------------------------------------- //
$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE (nombre_tipo_resolucion_facturacion = '$nombre_tipo_factura') AND (nombre_tipo_estado = 'ACTIVO')";
$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

$cod_resolucion_facturacion          = intval($matriz_resol_fact['cod_resolucion_facturacion']);
// ------------------------------------------------------------------------------------------------- //
if ($cod_tipo_pago == '2') {
	$sql_autoincremento_cuentas_pagar = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_pagar'";
	$exec_autoincremento_cuentas_pagar = mysqli_query($conectar, $sql_autoincremento_cuentas_pagar) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_pagar = mysqli_fetch_assoc($exec_autoincremento_cuentas_pagar);

	$cod_cuentas_pagar           = $datos_autoincremento_cuentas_pagar['AUTO_INCREMENT'];
} else {
	$cod_cuentas_pagar           = '0';
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo == 'precio_compra_producto') && ($tipo_ajax == 'tbl15_compra_producto_temporal') && ($valor <> '')) {

	$precio_compra_producto_concat = $valor;
	$total_precio_venta            = 0;
	$total_venta_producto          = 0;

	for($i = 0; $i < $total_datos_data; $i++)   {
		$precio_compra_producto = intval($array_precio_compra_producto[$i]);
		$total_venta_producto = $precio_compra_producto;
		$precio_compra_producto_orig = $precio_compra_producto;

		if (($precio_compra_producto <> '') || ($precio_compra_producto <> '0')) {

			$agregar_reg_compra_producto = "INSERT INTO tbl15_factura_compra_producto (cod_info_factura_compra, cod_tercero, cod_doc_soporte, cod_caja_virtual, 
			cod_producto, cod_producto_barra, nombre_producto, und_compra, und_producto, und_producto_bodega, und_unidades, und_caja, unidades_total, precio_compra_producto, 
			total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, 
			precio_venta_producto4, precio_venta_producto5, total_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, 
			nombre_tipo_presentacion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, 
			fecha_alerta, nombre_tipo_precio, nombre_tipo_precio_venta, comision_ptj, dto1, dto2, descuento, total_dto, iva_ptj, 
			total_iva, valor_iva, ganancia_ptj, fecha_vencimiento, lote_vencimiento, precio_compra_producto_viejo, precio_costo_producto_viejo, 
			cod_dependencia, ipc_ptj, precio_ipc, precio_ipc_total, ret_ica_ptj, total_ret_ica, iva_teorico_ptj, total_iva_teorico, 
			tarifa_rete_vigente_ptj, total_tarifa_rete_vigente, rete_iva_asumido_ptj, total_rete_iva_asumido, nombre_tipo_bienes_serv, 
			nombre_tipo_compra, nombre_tipo_cargue_factura, nombre_tipo_medida, cajas, cajas_sobre, und_sobre, check_caja, 
			check_und, chk, cod_interno, cod_proveedor, cod_original, codificacion, nombre_proveedor, tope_min, 
			posologia_cantidad, posologia_peso, nombre_frec_duracion, nombre_via_administracion, 
			cod_tipo_cobrar, cod_estado_vacuna, cod_estado_permitir_venta, cod_base_caja, cod_guia, cod_administrador, cuenta, cod_tipo_inventario,
			cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, cod_factura, cod_tipo_producto_consumo, fecha_mantenimiento, meses_mantenimiento, 
			meses_garantia, peso_producto, unidad_medida_peso, precio_compra_producto_ant_desc, total_compra_producto_ant_desc)
			VALUES ('$cod_info_factura_compra', '$cod_tercero', '$cod_doc_soporte', '$cod_caja_virtual', 
			'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_compra', '$und_producto_inv', '$und_producto_bodega_inv', '$und_unidades', '$und_caja', '$unidades_total', '$precio_compra_producto', 
			'$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', '$precio_venta_producto2', '$precio_venta_producto3', 
			'$precio_venta_producto4', '$precio_venta_producto5', '$total_venta_producto', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', 
			'$nombre_tipo_presentacion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', 
			'$fecha_alerta', '$nombre_tipo_precio', '$nombre_tipo_precio_venta', '$comision_ptj', '$dto1', '$dto2', '$descuento', '$total_dto', '$iva_ptj', 
			'$total_iva', '$valor_iva', '$ganancia_ptj', '$fecha_vencimiento', '$lote_vencimiento', '$precio_compra_producto_viejo', '$precio_costo_producto_viejo', 
			'$cod_dependencia', '$ipc_ptj', '$precio_ipc', '$precio_ipc_total', '$ret_ica_ptj', '$total_ret_ica', '$iva_teorico_ptj', '$total_iva_teorico', 
			'$tarifa_rete_vigente_ptj', '$total_tarifa_rete_vigente', '$rete_iva_asumido_ptj', '$total_rete_iva_asumido', '$nombre_tipo_bienes_serv', 
			'$nombre_tipo_compra', '$nombre_tipo_cargue_factura', '$nombre_tipo_medida', '$cajas', '$cajas_sobre', '$und_sobre', '$check_caja', 
			'$check_und', '$chk', '$cod_interno', '$cod_proveedor', '$cod_original', '$codificacion', '$nombre_proveedor', '$tope_min', 
			'$posologia_cantidad', '$posologia_peso', '$nombre_frec_duracion', '$nombre_via_administracion', 
			'$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_estado_permitir_venta', '$cod_base_caja', '$cod_guia', '$cod_administrador', '$cuenta', '$cod_tipo_inventario', 
			'$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_factura', '$cod_tipo_producto_consumo', '$fecha_mantenimiento', '$meses_mantenimiento', 
			'$meses_garantia', '$peso_producto', '$unidad_medida_peso', '$precio_compra_producto_ant_desc', '$total_compra_producto_ant_desc')";
			$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));

			$total_precio_venta    += $precio_compra_producto;
		}
	}

	//if ($total_recibido <> '0') { $vlr_cancelado = end($array_recibido); $vlr_vuelto = $vlr_cancelado - $total_precio_venta; } else { $vlr_cancelado = $total_precio_venta; $vlr_vuelto = '0'; }
	if (strpos($valor, '|') != false) { $vlr_cancelado = end($array_recibido); $vlr_vuelto = $vlr_cancelado - $total_precio_venta; } else { $vlr_cancelado = $total_precio_venta; $vlr_vuelto = '0'; }

	$tiempo_final                      = microtime(true);
	$tiempo_ejecucion                  = $tiempo_final - $tiempo_inicial;

	$agregar_regis = sprintf("UPDATE tbl15_info_factura_compra SET total = '$total', subtotal_total_precio_compra = '$subtotal_total_precio_compra', 
	subtotal_total_precio_costo = '$subtotal_total_precio_costo', total_factura_compra = '$total_factura_compra', total_precio_costo = '$total_precio_costo', 
	cod_estado_factura = '$cod_estado_factura', cod_factura = '$cod_factura', fecha_anyo = '$fecha_anyo', 
	fecha_dia = '$fecha_dia', fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', total_precio_compra = '$total_precio_compra', 
	total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data', cod_tercero = '$cod_tercero', nombre_estado_factura = '$nombre_estado_factura',
	cuenta = '$cuenta', vlr_cancelado = '$vlr_cancelado', vlr_vuelto = '$vlr_vuelto', cod_tipo_pago = '$cod_tipo_pago', cod_administrador = '$cod_administrador', 
	cod_tipo_forma_pago = '$cod_tipo_forma_pago', nombre_tipo_factura = '$nombre_tipo_factura', nombre_tipo_moneda = '$nombre_tipo_moneda', 
	nombre_tipo_cargue_factura = '$nombre_tipo_cargue_factura', nombre_rete_fuente_ptj = '$nombre_rete_fuente_ptj', ret_ica_ptj = '$ret_ica_ptj', 
	subtotal = '$subtotal', valor_iva = '$total_valor_iva', total_descuento = '$total_descuento', total_precio_ipc = '$total_precio_ipc', 
	total_compra_imp = '$total_compra_imp', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
	total_factura_compra_retefuente = '$total_factura_compra_retefuente', nombre_maquina = '$nombre_maquina', tiempo_ejecucion = '$tiempo_ejecucion', 
	cod_resolucion_facturacion = '$cod_resolucion_facturacion', total_inv_precio_costo = '$total_inv_precio_costo', total_inv_precio_compra = '$total_inv_precio_compra', 
	total_inv_precio_venta = '$total_inv_precio_venta', total_inv_compra_desp_factura = '$total_inv_compra_desp_factura', 
	total_compra_precio_costo = '$total_compra_precio_costo', total_compra_precio_compra = '$total_compra_precio_compra', 
	total_compra_precio_venta = '$total_compra_precio_venta', cod_tipo_inventario = '$cod_tipo_inventario', cod_tipo_producto_consumo = '$cod_tipo_producto_consumo'  
	WHERE (cod_info_factura_compra = '$cod_info_factura_compra')");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

	if ($cod_tipo_pago == '2') {
		$monto_deuda                          = $valor; 
		$vlr_cancelado_abono                  = 0;
		$subtotal                             = $valor - $vlr_cancelado_abono; 
		$abonado                              = $vlr_cancelado_abono; 
		$hora                                 = $fecha_hora;
		$mensaje                              = 'cargado por caja registradora compra';
		$vendedor                             = $cuenta;
		$cod_estado_cuenta_pagar              = 1;
		$fecha_modificacion_cuenta_pagar      = date("Y-m-d H:i:s");

		$sql_reg_cuentas_pagar = "INSERT INTO tbl15_cuentas_pagar (cod_factura, cod_tercero, monto_deuda, subtotal, vendedor, cuenta, abonado, fecha_pago, fecha, fecha_invert, fecha_seg, mensaje, fecha_hora, cod_administrador, cod_info_factura_compra)
		VALUES ('$cod_factura', '$cod_tercero', '$monto_deuda', '$subtotal', '$vendedor', '$cuenta', '$abonado', '$fecha_pago', '$fecha', '$fecha_invert', '$fecha_seg', '$mensaje', '$fecha_hora', '$cod_administrador', '$cod_info_factura_compra')";
		$resultado_cuentas_pagar = mysqli_query($conectar, $sql_reg_cuentas_pagar) or die(mysqli_error($conectar));

		$sql_datos_cuenta_pagar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_pagar, SUM(subtotal) AS total_subtotal_cuenta_pagar, SUM(abonado) AS total_abonado_cuenta_pagar 
		FROM tbl15_cuentas_pagar WHERE (cod_tercero = '$cod_tercero')";
		$consulta_datos_cuenta_pagar = mysqli_query($conectar, $sql_datos_cuenta_pagar);
		$datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar);

		$total_monto_deuda_cuenta_pagar       = $datos_cuenta_pagar['total_monto_deuda_cuenta_pagar'];
		$total_subtotal_cuenta_pagar          = $datos_cuenta_pagar['total_subtotal_cuenta_pagar'];
		$total_abonado_cuenta_pagar           = $datos_cuenta_pagar['total_abonado_cuenta_pagar'];

		$sql_cuenta_pagar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_pagar = '$cod_estado_cuenta_pagar', total_monto_deuda_cuenta_pagar = '$total_monto_deuda_cuenta_pagar', 
		total_subtotal_cuenta_pagar = '$total_subtotal_cuenta_pagar', total_abonado_cuenta_pagar = '$total_abonado_cuenta_pagar', fecha_modificacion_cuenta_pagar = '$fecha_modificacion_cuenta_pagar' 
		WHERE (cod_tercero = '$cod_tercero')");
		$resultado_cuenta_pagar_tercero = mysqli_query($conectar, $sql_cuenta_pagar_tercero) or die(mysqli_error($conectar));
	}
	$respuesta_ajax['llave']                    = $cod_info_factura_compra;
	$respuesta_ajax['total_precio_compra']      = $valor;
	$respuesta_ajax['vlr_cancelado']            = $vlr_cancelado;
	$respuesta_ajax['vlr_vuelto']               = $vlr_vuelto;
	$respuesta_ajax['estado']                   = '1';
	$respuesta_ajax['total_datos_data']         = $total_datos_data;

	echo json_encode($respuesta_ajax);
} else {
	$respuesta_ajax['llave']                    = 0;
	$respuesta_ajax['total_precio_compra']      = 0;
	$respuesta_ajax['vlr_cancelado']            = 0;
	$respuesta_ajax['vlr_vuelto']               = 0;
	$respuesta_ajax['estado']                   = '0';
	$respuesta_ajax['total_datos_data']         = 0;

	echo json_encode($respuesta_ajax);
}

?>