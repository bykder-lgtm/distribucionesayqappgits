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
$cuenta_actual                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                             = $_SESSION['usuario'];
$cod_administrador_sesion           = $_SESSION['cod_administrador'];
$tipo_ajax                          = addslashes($_REQUEST['tipo_ajax']);
$campo                              = addslashes($_REQUEST['campo']);
// ------------------------------------------------------------------------------------------------- //
$retorno_array                      = array();
$retorno_array2                     = array();
$codigoHTML_menu                    = '';
$codigoHTML_menu_total_reg          = '';
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_info_factura_venta') && ($tipo_ajax=='tbl15_info_factura_venta')) {
	if (isset($_REQUEST['cod_info_factura_venta'])) { $cod_info_factura_venta = intval($_REQUEST['cod_info_factura_venta']); } else { $cod_info_factura_venta = ''; }
	if (isset($_REQUEST['cod_resolucion_facturacion'])) { $cod_resolucion_facturacion = intval($_REQUEST['cod_resolucion_facturacion']); } else { $cod_resolucion_facturacion = ''; }
	if (isset($_REQUEST['cod_factura_prefijo'])) { $cod_factura_prefijo = addslashes($_REQUEST['cod_factura_prefijo']); } else { $cod_factura_prefijo = ''; }
	if (isset($_REQUEST['prefijo_resolucion_facturacion'])) { $prefijo_resolucion_facturacion = addslashes($_REQUEST['prefijo_resolucion_facturacion']); } else { $prefijo_resolucion_facturacion = ''; }
	if (isset($_REQUEST['numero_resolucion_facturacion'])) { $numero_resolucion_facturacion = addslashes($_REQUEST['numero_resolucion_facturacion']); } else { $numero_resolucion_facturacion = ''; }

	if (isset($_REQUEST['cod_cufe'])) { $cod_cufe = addslashes($_REQUEST['cod_cufe']); } else { $cod_cufe = ''; }
	if (isset($_REQUEST['dataico_email_status'])) { $dataico_email_status = addslashes($_REQUEST['dataico_email_status']); } else { $dataico_email_status = ''; }
	if (isset($_REQUEST['dataico_uuid'])) { $dataico_uuid = addslashes($_REQUEST['dataico_uuid']); } else { $dataico_uuid = ''; }
	if (isset($_REQUEST['dataico_issue_date'])) { $dataico_issue_date = addslashes($_REQUEST['dataico_issue_date']); } else { $dataico_issue_date = ''; }
	if (isset($_REQUEST['dataico_xml_url'])) { $dataico_xml_url = addslashes($_REQUEST['dataico_xml_url']); } else { $dataico_xml_url = ''; }
	if (isset($_REQUEST['dataico_customer_status'])) { $dataico_customer_status = addslashes($_REQUEST['dataico_customer_status']); } else { $dataico_customer_status = ''; }
	if (isset($_REQUEST['dataico_validation_date'])) { $dataico_validation_date = addslashes($_REQUEST['dataico_validation_date']); } else { $dataico_validation_date = ''; }
	if (isset($_REQUEST['dataico_qrcode'])) { $dataico_qrcode = addslashes($_REQUEST['dataico_qrcode']); } else { $dataico_qrcode = ''; }
	if (isset($_REQUEST['dataico_xml'])) { $dataico_xml = addslashes($_REQUEST['dataico_xml']); } else { $dataico_xml = ''; }
	if (isset($_REQUEST['dataico_invoice_type_code'])) { $dataico_invoice_type_code = addslashes($_REQUEST['dataico_invoice_type_code']); } else { $dataico_invoice_type_code = ''; }
	if (isset($_REQUEST['dataico_pdf_url'])) { $dataico_pdf_url = addslashes($_REQUEST['dataico_pdf_url']); } else { $dataico_pdf_url = ''; }
	if (isset($_REQUEST['dataico_dian_status'])) { $dataico_dian_status = addslashes($_REQUEST['dataico_dian_status']); } else { $dataico_dian_status = ''; }
	if (isset($_REQUEST['dataico_dian_reason'])) { $dataico_dian_reason = addslashes($_REQUEST['dataico_dian_reason']); } else { $dataico_dian_reason = ''; }

	if (isset($_REQUEST['dataico_dian_messages'])) { 
		$dataico_dian_messages0 = addslashes($_REQUEST['dataico_dian_messages']); 
		$dataico_dian_messages1 = str_replace("'", " PULG ", $dataico_dian_messages0);
		$dataico_dian_messages2 = str_replace(",", ".", $dataico_dian_messages1);
		$dataico_dian_messages3 = str_replace("#", " NO ", $dataico_dian_messages2);
		$dataico_dian_messages4 = str_replace("%", " PTJ ", $dataico_dian_messages3);
		$dataico_dian_messages = trim(str_replace('"', " PULG ", $dataico_dian_messages4));
	} else { 
		$dataico_dian_messages = ''; 
	}
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_info_nota_debito = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_nota_debito'";
	$exec_autoincremento_info_nota_debito = mysqli_query($conectar, $sql_autoincremento_info_nota_debito) or die(mysqli_error($conectar));
	$datos_autoincremento_info_nota_debito = mysqli_fetch_assoc($exec_autoincremento_info_nota_debito);
	$cod_info_nota_debito = $datos_autoincremento_info_nota_debito['AUTO_INCREMENT'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$origen_operacion                                = 'ventas';
	$fecha_devolucion                                = date("Y-m-d");
	$hora_devolucion                                 = date("H:i:s");
	$fecha_time                                      = time();	
	$fecha_dia                                       = date("Y-m-d");
	$fecha_mes                                       = date("Y-m");
	$fecha_anyo                                      = date("Y-m-d");
	$anyo                                            = date("Y");
	$fecha_hora                                      = date("H:i:s");
	$fecha_creacion                                  = date("Y-m-d H:i:s");
	$comentario                                      = 'devolucion venta nota debito total';
	$fecha	                                         = $fecha_time;
	$nombre_estado_factura_dataico_dian              = 'ANULADA';
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_max_info_nota_debito = "SELECT MAX(cod_factura_nota_debito) AS cod_factura_nota_debito FROM tbl15_info_nota_debito";
	$resultado_max_info_nota_debito = mysqli_query($conectar, $sql_max_info_nota_debito);
	$info_max_info_nota_debito = mysqli_fetch_assoc($resultado_max_info_nota_debito);

	$cod_factura_nota_debito                        = $info_max_info_nota_debito['cod_factura_nota_debito'] + 1; 
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$mostrar_datos_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
	$consulta_resolucion_facturacion = mysqli_query($conectar, $mostrar_datos_resolucion_facturacion) or die(mysqli_error($conectar));
	$matriz_consulta_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

	$prefijo_nota_debito                            = $matriz_consulta_resolucion_facturacion['prefijo_resolucion_facturacion'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_datos = "SELECT * FROM tbl15_venta_producto WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
	$resultado_datos = mysqli_query($conectar, $sql_datos);
	while ($info_datos = mysqli_fetch_assoc($resultado_datos)) {

		$cod_venta_producto                           = $info_datos['cod_venta_producto']; 
		$cod_producto                                 = $info_datos['cod_producto']; 
		$cod_producto_barra                           = $info_datos['cod_producto_barra']; 
		$cod_producto_barra_madre                     = $info_datos['cod_producto_barra_madre']; 
		$cod_info_factura_venta                       = $info_datos['cod_info_factura_venta']; 
		$cod_factura                                  = $info_datos['cod_factura']; 
		$cod_tercero                                  = $info_datos['cod_tercero']; 
		$cod_caja_virtual                             = $info_datos['cod_caja_virtual']; 
		$nombre_producto                              = $info_datos['nombre_producto']; 
		$und_venta                                    = $info_datos['und_venta']; 
		$precio_compra_producto                       = $info_datos['precio_compra_producto']; 
		$total_compra_producto                        = $info_datos['total_compra_producto']; 
		$precio_costo_producto                        = $info_datos['precio_costo_producto']; 
		$total_costo_producto                         = $info_datos['total_costo_producto']; 
		$precio_venta_producto                        = $info_datos['precio_venta_producto']; 
		$total_venta_producto                         = $info_datos['total_venta_producto']; 
		$precio_venta_producto_orig                   = $info_datos['precio_venta_producto_orig']; 
		$und_caja_sobre                               = $info_datos['und_caja_sobre']; 
		$cajas_sobre                                  = $info_datos['cajas_sobre']; 
		$nombre_tipo_und_caja_sobre                   = $info_datos['nombre_tipo_und_caja_sobre']; 
		$posologia_cantidad                           = $info_datos['posologia_cantidad']; 
		$posologia_peso                               = $info_datos['posologia_peso']; 
		$peso_producto                                = $info_datos['peso_producto']; 
		$unidad_medida_peso                           = $info_datos['unidad_medida_peso']; 
		$nombre_tipo_producto                         = $info_datos['nombre_tipo_producto']; 
		$nombre_tipo_unidad_medida                    = $info_datos['nombre_tipo_unidad_medida']; 
		$nombre_tipo_presentacion                     = $info_datos['nombre_tipo_presentacion']; 
		$nombre_via_administracion                    = $info_datos['nombre_via_administracion']; 
		$nombre_frec_duracion                         = $info_datos['nombre_frec_duracion']; 
		$und_producto                                 = $info_datos['und_producto']; 
		$fecha_ymd_venta_producto                     = $info_datos['fecha_ymd_venta_producto']; 
		$fecha_mes_venta_producto                     = $info_datos['fecha_mes_venta_producto']; 
		$fecha_anyo_venta_producto                    = $info_datos['fecha_anyo_venta_producto']; 
		$fecha_hora_venta_producto                    = $info_datos['fecha_hora_venta_producto']; 
		$fecha_seg_venta_producto                     = $info_datos['fecha_seg_venta_producto']; 
		$fecha_alerta                                 = $info_datos['fecha_alerta']; 
		$cod_estado_vacuna                            = $info_datos['cod_estado_vacuna']; 
		$cuenta                                       = $info_datos['cuenta']; 
		$cod_administrador                            = $info_datos['cod_administrador']; 
		$cod_base_caja                                = $info_datos['cod_base_caja']; 
		$cod_opcion_descontable_inv                   = $info_datos['cod_opcion_descontable_inv']; 
		$und_producto_inv                             = $info_datos['und_producto_inv']; 
		$und_producto_bodega_inv                      = $info_datos['und_producto_bodega_inv']; 
		$cod_tipo_cobrar                              = $info_datos['cod_tipo_cobrar']; 
		$descuento_ptj                                = $info_datos['descuento_ptj']; 
		$iva_ptj                                      = $info_datos['iva_ptj']; 
		$iva_saludable_ptj                            = $info_datos['iva_saludable_ptj']; 
		$ptj_imp_consumo                              = $info_datos['ptj_imp_consumo']; 
		$ptj_ret_iva                                  = $info_datos['ptj_ret_iva']; 
		$ptj_ret_ica                                  = $info_datos['ptj_ret_ica']; 
		$ptj_ret_fuente                               = $info_datos['ptj_ret_fuente']; 
		$ptj_ipc                                      = $info_datos['ptj_ipc']; 
		$precio_ipc_total                             = $info_datos['precio_ipc_total']; 
		$precio_ipc                                   = $info_datos['precio_ipc']; 
		$cod_factura_electronica                      = $info_datos['cod_factura_electronica']; 
		$cod_resolucion_facturacion                   = $info_datos['cod_resolucion_facturacion']; 
		$nombre_tipo_precio                           = $info_datos['nombre_tipo_precio']; 
		$nombre_tipo_precio_venta                     = $info_datos['nombre_tipo_precio_venta']; 
		$comision_ptj                                 = $info_datos['comision_ptj']; 
		$nombre_cliente                               = $info_datos['nombre_cliente']; 
		$cedula                                       = $info_datos['cedula']; 
		$nombre_empresa                               = $info_datos['nombre_empresa']; 
		$cod_empresa                                  = $info_datos['cod_empresa']; 
		$cod_cliente                                  = $info_datos['cod_cliente']; 
		$cod_historia_clinica                         = $info_datos['cod_historia_clinica']; 
		$cod_prioridad                                = $info_datos['cod_prioridad']; 
		//$cod_cufe                                     = $info_datos['cod_cufe']; 
		$cod_tipo_mantenimiento                       = $info_datos['cod_tipo_mantenimiento']; 
		$cod_tipo_pago                                = $info_datos['cod_tipo_pago']; 
		$cod_tipo_forma_pago                          = $info_datos['cod_tipo_forma_pago']; 
		$total_datos_data                             = $info_datos['total_datos_data']; 
		$nombre_tipo_factura                          = $info_datos['nombre_tipo_factura']; 
		$nombre_tipo_moneda                           = $info_datos['nombre_tipo_moneda']; 
		$vlr_cancelado                                = $info_datos['vlr_cancelado']; 
		$vlr_vuelto                                   = $info_datos['vlr_vuelto']; 
		$nombre_promocion                             = $info_datos['nombre_promocion']; 
		$nombre_promocion_ing                         = $info_datos['nombre_promocion_ing']; 
		$url_img_producto_min                         = $info_datos['url_img_producto_min']; 
		$url_img_producto_orig                        = $info_datos['url_img_producto_orig']; 
		$cod_categoria                                = $info_datos['cod_categoria']; 
		$cod_categoria_sub                            = $info_datos['cod_categoria_sub']; 
		$cod_estado                                   = $info_datos['cod_estado']; 
		$cod_dependencia                              = $info_datos['cod_dependencia']; 
		$cod_tipo_inventario                          = $info_datos['cod_tipo_inventario']; 
		$cod_tipo_pedido                              = $info_datos['cod_tipo_pedido']; 
		$cod_factura_compra_producto                  = $info_datos['cod_factura_compra_producto']; 
		$cod_tipo_producto_cocina                     = $info_datos['cod_tipo_producto_cocina']; 
		$cod_cierre_caja                              = $info_datos['cod_cierre_caja']; 
		$fecha_cierre_caja                            = $info_datos['fecha_cierre_caja']; 
		$hora_cierre_caja                             = $info_datos['hora_cierre_caja']; 
		$fecha_time_cierre_caja                       = $info_datos['fecha_time_cierre_caja']; 
		$comentario_producto                          = $info_datos['comentario_producto']; 
		$nombre_categoria                             = $info_datos['nombre_categoria']; 
		$nombre_categoria_sub                         = $info_datos['nombre_categoria_sub']; 
		$nombre_tipo_compra                           = $info_datos['nombre_tipo_compra']; 
		$placa_producto                               = $info_datos['placa_producto']; 
		$fecha_ymd_parqueo_ini                        = $info_datos['fecha_ymd_parqueo_ini']; 
		$fecha_hora_parqueo_ini                       = $info_datos['fecha_hora_parqueo_ini']; 
		$fecha_ymd_parqueo_fin                        = $info_datos['fecha_ymd_parqueo_fin']; 
		$fecha_hora_parqueo_fin                       = $info_datos['fecha_hora_parqueo_fin']; 
		$cod_info_parqueo_cotizacion_factura_venta    = $info_datos['cod_info_parqueo_cotizacion_factura_venta']; 
		$cod_parqueo_cotizacion_venta_producto        = $info_datos['cod_parqueo_cotizacion_venta_producto']; 
		$cod_info_hotel_cotizacion_factura_venta      = $info_datos['cod_info_hotel_cotizacion_factura_venta']; 
		$cod_hotel_cotizacion_venta_producto          = $info_datos['cod_hotel_cotizacion_venta_producto']; 
		$cod_tipo_metodo_envio                        = $info_datos['cod_tipo_metodo_envio']; 
		$cod_tipo_aplicacion                          = $info_datos['cod_tipo_aplicacion']; 
		$cod_zona_envio                               = $info_datos['cod_zona_envio']; 
		$cod_estado_cava                              = $info_datos['cod_estado_cava']; 
		$cod_dia_semana                               = $info_datos['cod_dia_semana']; 
		$cod_estado_check_factura_electronica         = $info_datos['cod_estado_check_factura_electronica']; 
		$cod_estado_factura_electronica_enviado_dian  = $info_datos['cod_estado_factura_electronica_enviado_dian']; 
		$cod_factura_antigua                          = $info_datos['cod_factura_antigua']; 
		$cod_venta_producto_temporal                  = $info_datos['cod_venta_producto_temporal']; 
		$cod_estado_habitacion_hotel                  = $info_datos['cod_estado_habitacion_hotel']; 
		$cod_tipo_habitacion_hotel                    = $info_datos['cod_tipo_habitacion_hotel']; 
		$cod_estado_tipo_hotel_parqueo                = $info_datos['cod_estado_tipo_hotel_parqueo']; 
		$total_horas                                  = $info_datos['total_horas']; 
		$total_dias                                   = $info_datos['total_dias']; 
		$cod_tipo_cod_barra                           = $info_datos['cod_tipo_cod_barra']; 
		$nombre_tipo_cobro                            = $info_datos['nombre_tipo_cobro']; 
		$fecha_cobro_renovacion                       = $info_datos['fecha_cobro_renovacion']; 
		$cod_puc                                      = $info_datos['cod_puc']; 
		$vendedor                                     = $info_datos['cuenta'];

		$total_costo_producto                         = $info_datos['precio_costo_producto'] * $und_venta;
		$total_venta_producto                         = $info_datos['precio_venta_producto'] * $und_venta;
		$unidades_vendidas                            = $und_venta - $und_venta;
		$und_vend_orig                                = $und_venta;
		$vlr_total_venta                              = $precio_venta_producto * $und_venta;
		$vlr_total_compra                             = $precio_compra_producto * $und_venta;
		$devoluciones                                 = $und_venta;

		$sql_datos_producto = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
		$resultado_datos_producto = mysqli_query($conectar, $sql_datos_producto);
		$info_datos_producto = mysqli_fetch_assoc($resultado_datos_producto);

		$und_producto_inv      = $info_datos_producto['und_producto']; 
		$und_producto          = $und_producto_inv + $und_venta;
		$und_inventario	       = $und_producto_inv;
		$und_nuevas            = $und_venta;

		$agregar_regis = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
		$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

		$sql_datos_producto_desp = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
		$resultado_datos_producto_desp = mysqli_query($conectar, $sql_datos_producto_desp);
		$info_datos_producto_desp = mysqli_fetch_assoc($resultado_datos_producto_desp);

		$unidades_faltantes      = $info_datos_producto_desp['und_producto']; 
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
		$agregar_operacion = "INSERT INTO tbl15_operacion (cod_venta_producto, cod_info_factura_venta, cod_producto_barra, nombre_producto, origen_operacion, cod_factura, 
		unidades_vendidas, und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
		vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
		fecha_hora, vendedor, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes) 
		VALUES ('$cod_venta_producto', '$cod_info_factura_venta', '$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$cod_factura', 
		'$unidades_vendidas', '$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
		'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_ymd_venta_producto', '$fecha_ymd_venta_producto', 
		'$fecha_hora_venta_producto', '$vendedor', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes')";
		$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
		$agregar_nota_debito = "INSERT INTO tbl15_nota_debito (cod_info_nota_debito, cod_info_factura_venta, cod_venta_producto, cod_producto, cod_producto_barra, cod_producto_barra_madre, 
		cod_factura, cod_tercero, cod_caja_virtual, nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, 
		total_costo_producto, precio_venta_producto, total_venta_producto, precio_venta_producto_orig, und_caja_sobre, cajas_sobre, 
		nombre_tipo_und_caja_sobre, posologia_cantidad, posologia_peso, peso_producto, unidad_medida_peso, nombre_tipo_producto, 
		nombre_tipo_unidad_medida, nombre_tipo_presentacion, nombre_via_administracion, nombre_frec_duracion, und_producto, 
		fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_hora_venta_producto, 
		fecha_seg_venta_producto, fecha_alerta, cod_estado_vacuna, cuenta, cod_administrador, cod_base_caja, 
		cod_opcion_descontable_inv, und_producto_inv, und_producto_bodega_inv, cod_tipo_cobrar, descuento_ptj, 
		iva_ptj, iva_saludable_ptj, ptj_imp_consumo, ptj_ret_iva, ptj_ret_ica, ptj_ret_fuente, ptj_ipc, 
		precio_ipc_total, precio_ipc, cod_factura_electronica, cod_resolucion_facturacion, nombre_tipo_precio, 
		nombre_tipo_precio_venta, comision_ptj, nombre_cliente, cedula, nombre_empresa, cod_empresa, cod_cliente, 
		cod_historia_clinica, cod_prioridad, cod_tipo_mantenimiento, cod_tipo_pago, cod_tipo_forma_pago, 
		total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, vlr_cancelado, vlr_vuelto, nombre_promocion, 
		nombre_promocion_ing, url_img_producto_min, url_img_producto_orig, cod_categoria, cod_categoria_sub, 
		cod_estado, cod_dependencia, cod_tipo_inventario, cod_tipo_pedido, cod_factura_compra_producto, 
		cod_tipo_producto_cocina, cod_cierre_caja, fecha_cierre_caja, hora_cierre_caja, fecha_time_cierre_caja, 
		comentario_producto, nombre_categoria, nombre_categoria_sub, nombre_tipo_compra, placa_producto, 
		fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin, 
		cod_info_parqueo_cotizacion_factura_venta, cod_parqueo_cotizacion_venta_producto, cod_info_hotel_cotizacion_factura_venta, 
		cod_hotel_cotizacion_venta_producto, cod_tipo_metodo_envio, cod_tipo_aplicacion, cod_zona_envio, 
		cod_estado_cava, cod_dia_semana, cod_estado_check_factura_electronica, cod_estado_factura_electronica_enviado_dian, 
		cod_factura_antigua, cod_venta_producto_temporal, cod_estado_habitacion_hotel, cod_tipo_habitacion_hotel, 
		cod_estado_tipo_hotel_parqueo, total_horas, total_dias, cod_tipo_cod_barra, nombre_tipo_cobro, fecha_cobro_renovacion, cod_puc) 
		VALUES ('$cod_info_nota_debito', '$cod_info_factura_venta', '$cod_venta_producto', '$cod_producto', '$cod_producto_barra', '$cod_producto_barra_madre', 
		'$cod_factura', '$cod_tercero', '$cod_caja_virtual', '$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', 
		'$total_costo_producto', '$precio_venta_producto', '$total_venta_producto', '$precio_venta_producto_orig', '$und_caja_sobre', '$cajas_sobre', 
		'$nombre_tipo_und_caja_sobre', '$posologia_cantidad', '$posologia_peso', '$peso_producto', '$unidad_medida_peso', '$nombre_tipo_producto', 
		'$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', '$nombre_via_administracion', '$nombre_frec_duracion', '$und_producto', 
		'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_hora_venta_producto', 
		'$fecha_seg_venta_producto', '$fecha_alerta', '$cod_estado_vacuna', '$cuenta', '$cod_administrador', '$cod_base_caja', 
		'$cod_opcion_descontable_inv', '$und_producto_inv', '$und_producto_bodega_inv', '$cod_tipo_cobrar', '$descuento_ptj', 
		'$iva_ptj', '$iva_saludable_ptj', '$ptj_imp_consumo', '$ptj_ret_iva', '$ptj_ret_ica', '$ptj_ret_fuente', '$ptj_ipc', 
		'$precio_ipc_total', '$precio_ipc', '$cod_factura_electronica', '$cod_resolucion_facturacion', '$nombre_tipo_precio', 
		'$nombre_tipo_precio_venta', '$comision_ptj', '$nombre_cliente', '$cedula', '$nombre_empresa', '$cod_empresa', '$cod_cliente', 
		'$cod_historia_clinica', '$cod_prioridad', '$cod_tipo_mantenimiento', '$cod_tipo_pago', '$cod_tipo_forma_pago', 
		'$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$vlr_cancelado', '$vlr_vuelto', '$nombre_promocion', 
		'$nombre_promocion_ing', '$url_img_producto_min', '$url_img_producto_orig', '$cod_categoria', '$cod_categoria_sub', 
		'$cod_estado', '$cod_dependencia', '$cod_tipo_inventario', '$cod_tipo_pedido', '$cod_factura_compra_producto', 
		'$cod_tipo_producto_cocina', '$cod_cierre_caja', '$fecha_cierre_caja', '$hora_cierre_caja', '$fecha_time_cierre_caja', 
		'$comentario_producto', '$nombre_categoria', '$nombre_categoria_sub', '$nombre_tipo_compra', '$placa_producto', 
		'$fecha_ymd_parqueo_ini', '$fecha_hora_parqueo_ini', '$fecha_ymd_parqueo_fin', '$fecha_hora_parqueo_fin', 
		'$cod_info_parqueo_cotizacion_factura_venta', '$cod_parqueo_cotizacion_venta_producto', '$cod_info_hotel_cotizacion_factura_venta', 
		'$cod_hotel_cotizacion_venta_producto', '$cod_tipo_metodo_envio', '$cod_tipo_aplicacion', '$cod_zona_envio', 
		'$cod_estado_cava', '$cod_dia_semana', '$cod_estado_check_factura_electronica', '$cod_estado_factura_electronica_enviado_dian', 
		'$cod_factura_antigua', '$cod_venta_producto_temporal', '$cod_estado_habitacion_hotel', '$cod_tipo_habitacion_hotel', 
		'$cod_estado_tipo_hotel_parqueo', '$total_horas', '$total_dias', '$cod_tipo_cod_barra', '$nombre_tipo_cobro', '$fecha_cobro_renovacion', '$cod_puc')";
		$resultado_nota_debiton = mysqli_query($conectar, $agregar_nota_debito) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
		if ($cod_tipo_pago == '2') {
			$sql_total_deuda_debito = "SELECT SUM(total_venta_producto) AS monto_deuda FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
			$consulta_total_deuda_debito = mysqli_query($conectar, $sql_total_deuda_debito) or die(mysqli_error($conectar));
			$info_total_deuda_debito = mysqli_fetch_assoc($consulta_total_deuda_debito);

			$monto_deuda                  = $info_total_deuda_debito['monto_deuda'];

			$sql_total_abonado_debito = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_cobrar_abonos WHERE (cod_factura = '$cod_factura')";
			$consulta_total_abonado_debito = mysqli_query($conectar, $sql_total_abonado_debito) or die(mysqli_error($conectar));
			$info_total_abonado_debito = mysqli_fetch_assoc($consulta_total_abonado_debito);

			$abonado                      = $info_total_abonado_debito['abonado'];
			$subtotal                     = $monto_deuda - $abonado;

			$data_sql = ("UPDATE tbl15_cuentas_cobrar SET monto_deuda = '$monto_deuda', subtotal = '$subtotal', abonado = '$abonado' WHERE cod_factura = '$cod_factura'");
			$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
		}
	}
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
    $sql_info_factura_venta = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
    $consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
    $datos_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

    $cod_factura                                     = $datos_info_factura_venta['cod_factura'];
    $cod_resolucion_facturacion                      = $datos_info_factura_venta['cod_resolucion_facturacion'];
    $cod_tercero                                     = $datos_info_factura_venta['cod_tercero'];
    $cod_caja_virtual                                = $datos_info_factura_venta['cod_caja_virtual'];
    $cod_tipo_pago                                   = $datos_info_factura_venta['cod_tipo_pago'];
    $cod_tipo_forma_pago                             = $datos_info_factura_venta['cod_tipo_forma_pago'];
    $nombre_tipo_factura                             = $datos_info_factura_venta['nombre_tipo_factura'];
    $total_precio_compra                             = $datos_info_factura_venta['total_precio_compra'];
    $total_precio_venta                              = $datos_info_factura_venta['total_precio_venta'];
    $cod_factura_antigua                             = $datos_info_factura_venta['cod_factura_antigua'];

	$cod_cufe_viejo                                  = $datos_info_factura_venta['cod_cufe'];
	$dataico_email_status_viejo                      = $datos_info_factura_venta['dataico_email_status'];
	$dataico_uuid_viejo                              = $datos_info_factura_venta['dataico_uuid'];
	$dataico_issue_date_viejo                        = $datos_info_factura_venta['dataico_issue_date'];
	$dataico_dian_messages_viejo                     = $datos_info_factura_venta['dataico_dian_messages'];
	$dataico_payment_date_viejo                      = $datos_info_factura_venta['dataico_payment_date'];
	$dataico_xml_url_viejo                           = $datos_info_factura_venta['dataico_xml_url'];
	$dataico_customer_status_viejo                   = $datos_info_factura_venta['dataico_customer_status'];
	$dataico_validation_date_viejo                   = $datos_info_factura_venta['dataico_validation_date'];
	$dataico_qrcode_viejo                            = $datos_info_factura_venta['dataico_qrcode'];
	$dataico_xml_viejo                               = $datos_info_factura_venta['dataico_xml'];
	$dataico_invoice_type_code_viejo                 = $datos_info_factura_venta['dataico_invoice_type_code'];
	$dataico_pdf_url_viejo                           = $datos_info_factura_venta['dataico_pdf_url'];
	$dataico_dian_status_viejo                       = $datos_info_factura_venta['dataico_dian_status'];
	$dataico_dian_error_viejo                        = $datos_info_factura_venta['dataico_dian_error'];
	$dataico_dian_path_viejo                         = $datos_info_factura_venta['dataico_dian_path'];
	$tiempo_final                                    = microtime(true);
	$tiempo_ejecucion_dian_dataico                   = $tiempo_final - $tiempo_inicial;
	//-------------------------------------------------------------------------------------------------------------------//
	$agreg = "INSERT INTO tbl15_info_nota_debito (cod_factura_nota_debito, cod_info_factura_venta, prefijo_nota_debito, cod_cufe, dataico_email_status, dataico_uuid, 
	dataico_issue_date, dataico_dian_messages, dataico_customer_status, 
	dataico_xml_url, dataico_validation_date, dataico_qrcode, dataico_xml, dataico_pdf_url, dataico_dian_status, dataico_invoice_type_code, dataico_dian_reason, 
	cod_factura, cod_resolucion_facturacion, cod_tercero, cod_caja_virtual, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, total_precio_compra, total_precio_venta, 
	cod_factura_antigua, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, fecha_creacion, tiempo_ejecucion_dian_dataico, 
	cod_cufe_viejo, dataico_email_status_viejo, dataico_uuid_viejo, dataico_issue_date_viejo, dataico_dian_messages_viejo, 
	dataico_payment_date_viejo, dataico_xml_url_viejo, dataico_customer_status_viejo, dataico_validation_date_viejo, 
	dataico_qrcode_viejo, dataico_xml_viejo, dataico_invoice_type_code_viejo, dataico_pdf_url_viejo, 
	dataico_dian_status_viejo, dataico_dian_error_viejo, dataico_dian_path_viejo) 
	VALUES ('$cod_factura_nota_debito', '$cod_info_factura_venta', '$prefijo_nota_debito', '$cod_cufe', '$dataico_email_status', '$dataico_uuid', 
	'$dataico_issue_date', '$dataico_dian_messages', '$dataico_customer_status', 
	'$dataico_xml_url', '$dataico_validation_date', '$dataico_qrcode', '$dataico_xml', '$dataico_pdf_url', '$dataico_dian_status', '$dataico_invoice_type_code', '$dataico_dian_reason', 
	'$cod_factura', '$cod_resolucion_facturacion', '$cod_tercero', '$cod_caja_virtual', '$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$total_precio_compra', '$total_precio_venta', 
	'$cod_factura_antigua', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$fecha_creacion', '$tiempo_ejecucion_dian_dataico', 
	'$cod_cufe_viejo', '$dataico_email_status_viejo', '$dataico_uuid_viejo', '$dataico_issue_date_viejo', '$dataico_dian_messages_viejo', 
	'$dataico_payment_date_viejo', '$dataico_xml_url_viejo', '$dataico_customer_status_viejo', '$dataico_validation_date_viejo', 
	'$dataico_qrcode_viejo', '$dataico_xml_viejo', '$dataico_invoice_type_code_viejo', '$dataico_pdf_url_viejo', 
	'$dataico_dian_status_viejo', '$dataico_dian_error_viejo', '$dataico_dian_path_viejo')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }
	//-------------------------------------------------------------------------------------------------------------------//
	$borrar_sql = sprintf("DELETE FROM tbl15_venta_producto WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$data_sql = ("UPDATE tbl15_info_factura_venta SET nombre_estado_factura_dataico_dian = '$nombre_estado_factura_dataico_dian' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
	//$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	//$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	header('Content-Type: application/json'); 

	$datos_array['afectado'] = "".$afectado;
	$datos_array['cod_info_factura_venta'] = "".$cod_info_factura_venta;
	$datos_array['cod_factura'] = "".$cod_factura;
	$datos_array['cod_factura_nota_debito'] = "".$cod_factura_nota_debito;
	$datos_array['cod_cufe'] = "".$cod_cufe;
	$datos_array['dataico_email_status'] = "".$dataico_email_status;
	$datos_array['dataico_uuid'] = "".$dataico_uuid;
	$datos_array['dataico_issue_date'] = "".$dataico_issue_date;
	$datos_array['dataico_dian_messages'] = "".$dataico_dian_messages;
	$datos_array['dataico_xml_url'] = "".$dataico_xml_url;
	$datos_array['dataico_customer_status'] = "".$dataico_customer_status;
	$datos_array['dataico_validation_date'] = "".$dataico_validation_date;
	$datos_array['dataico_qrcode'] = "".$dataico_qrcode;
	$datos_array['dataico_xml'] = "".$dataico_xml;
	$datos_array['dataico_invoice_type_code'] = "".$dataico_invoice_type_code;
	$datos_array['dataico_pdf_url'] = "".$dataico_pdf_url;
	$datos_array['dataico_dian_status'] = "".$dataico_dian_status;

	echo json_encode($datos_array);
}
// ------------------------------------------------------------------------------------------------- //
?>