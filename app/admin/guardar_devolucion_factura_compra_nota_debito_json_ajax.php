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
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT cod_estado_subproducto_global, cod_estado_venta_dependencia_de_usuario_global, cod_estado_tipo_venta_zapateria_global, cod_estado_limite_venta_pos_factura_electronica_global, 
cod_estado_enviar_factura_venta_electronica_dian_api_global, cod_estado_dia_sin_iva_global, cod_estado_puntos_redimibles_campanya_global, cod_estado_movimiento_contable_caja_personal_global, 
cod_estado_movimiento_contable_cuenta_personal_global, cod_estado_verificar_precio_venta_en_cero_venta_temp_global
FROM tbl15_info_empresa WHERE (cod_info_empresa = '1')";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_subproducto_global                                   = $info_empresa_data['cod_estado_subproducto_global'];
$cod_estado_venta_dependencia_de_usuario_global                  = $info_empresa_data['cod_estado_venta_dependencia_de_usuario_global'];
$cod_estado_tipo_venta_zapateria_global                          = $info_empresa_data['cod_estado_tipo_venta_zapateria_global'];
$cod_estado_limite_venta_pos_factura_electronica_global          = $info_empresa_data['cod_estado_limite_venta_pos_factura_electronica_global'];
$cod_estado_enviar_factura_venta_electronica_dian_api_global     = $info_empresa_data['cod_estado_enviar_factura_venta_electronica_dian_api_global'];
$cod_estado_dia_sin_iva_global                                   = $info_empresa_data['cod_estado_dia_sin_iva_global'];
$cod_estado_puntos_redimibles_campanya_global                    = $info_empresa_data['cod_estado_puntos_redimibles_campanya_global'];
$cod_estado_movimiento_contable_caja_personal_global             = $info_empresa_data['cod_estado_movimiento_contable_caja_personal_global'];
$cod_estado_movimiento_contable_cuenta_personal_global           = $info_empresa_data['cod_estado_movimiento_contable_cuenta_personal_global'];
$cod_estado_verificar_precio_venta_en_cero_venta_temp_global     = $info_empresa_data['cod_estado_verificar_precio_venta_en_cero_venta_temp_global'];
// ------------------------------------------------------------------------------------------------- //
if (($campo=='cod_info_factura_compra') && ($tipo_ajax=='tbl15_info_factura_compra')) {
	if (isset($_REQUEST['cod_info_factura_compra'])) { $cod_info_factura_compra = intval($_REQUEST['cod_info_factura_compra']); } else { $cod_info_factura_compra = ''; }
	if (isset($_REQUEST['cod_sino_crear_mov_contable'])) { $cod_sino_crear_mov_contable = addslashes($_REQUEST['cod_sino_crear_mov_contable']); } else { $cod_sino_crear_mov_contable = '1'; }
	if (isset($_REQUEST['cod_puc'])) { $cod_puc_post = addslashes($_REQUEST['cod_puc']); } else { $cod_puc_post = ''; }
	if (isset($_REQUEST['cod_movimiento_contable_cuenta_personal'])) { $cod_movimiento_contable_cuenta_personal = addslashes($_REQUEST['cod_movimiento_contable_cuenta_personal']); } else { $cod_movimiento_contable_cuenta_personal = '0'; }
	if (isset($_REQUEST['observacion'])) { $observacion = addslashes($_REQUEST['observacion']); } else { $observacion = ''; }
	if (isset($_REQUEST['fecha_ymd'])) { $fecha_ymd = addslashes($_REQUEST['fecha_ymd']); } else { $fecha_ymd = date("Y-m-d"); }
	if (isset($_REQUEST['cod_tipo_pago']) <> '') { $cod_tipo_pago = intval($_REQUEST['cod_tipo_pago']); } else { $cod_tipo_pago = '1'; }
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_info_nota_debito = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_nota_debito'";
	$exec_autoincremento_info_nota_debito = mysqli_query($conectar, $sql_autoincremento_info_nota_debito) or die(mysqli_error($conectar));
	$datos_autoincremento_info_nota_debito = mysqli_fetch_assoc($exec_autoincremento_info_nota_debito);
	$cod_info_nota_debito = $datos_autoincremento_info_nota_debito['AUTO_INCREMENT'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$origen_operacion                                = 'compras';
	$fecha_devolucion                                = date("Y-m-d");
	$hora_devolucion                                 = date("H:i:s");
	$fecha_time                                      = time();	
	$fecha_dia                                       = date("Y-m-d");
	$fecha_mes                                       = date("Y-m");
	$fecha_anyo                                      = date("Y-m-d");
	$anyo                                            = date("Y");
	$fecha_hora                                      = date("H:i:s");
	$fecha_creacion                                  = date("Y-m-d H:i:s");
	$comentario                                      = 'devolucion compra nota debito total - json';
	$fecha	                                         = $fecha_time;
	$nombre_estado_factura_dataico_dian              = 'ANULADA';
	$fecha_seg                                       = time();
	$fecha_factura                                   = '';
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
    $sql_info_factura_compra = "SELECT * FROM tbl15_info_factura_compra WHERE cod_info_factura_compra = '$cod_info_factura_compra'";
    $consulta_info_factura_compra = mysqli_query($conectar, $sql_info_factura_compra) or die(mysqli_error($conectar));
    $datos_info_factura_compra = mysqli_fetch_assoc($consulta_info_factura_compra);

    $cod_factura                                     = $datos_info_factura_compra['cod_factura'];
    $cod_resolucion_facturacion                      = $datos_info_factura_compra['cod_resolucion_facturacion'];
    $cod_tercero                                     = $datos_info_factura_compra['cod_tercero'];
    $cod_caja_virtual                                = $datos_info_factura_compra['cod_caja_virtual'];
    $cod_tipo_pago                                   = $datos_info_factura_compra['cod_tipo_pago'];
    $cod_tipo_forma_pago                             = $datos_info_factura_compra['cod_tipo_forma_pago'];
    $nombre_tipo_factura                             = $datos_info_factura_compra['nombre_tipo_factura'];
    $total_precio_compra                             = $datos_info_factura_compra['total_factura_compra_retefuente'];
    $total_precio_venta                              = $datos_info_factura_compra['total_precio_venta'];
	$ptj_ret_fuente                                  = $datos_info_factura_compra['nombre_rete_fuente_ptj'];

	$cod_cufe                                        = $datos_info_factura_compra['cod_cufe'];
	$dataico_email_status                            = $datos_info_factura_compra['dataico_email_status'];
	$dataico_uuid                                    = $datos_info_factura_compra['dataico_uuid'];
	$dataico_issue_date                              = $datos_info_factura_compra['dataico_issue_date'];
	$dataico_dian_messages                           = $datos_info_factura_compra['dataico_dian_messages'];
	$dataico_payment_date                            = $datos_info_factura_compra['dataico_payment_date'];
	$dataico_xml_url                                 = $datos_info_factura_compra['dataico_xml_url'];
	$dataico_customer_status                         = $datos_info_factura_compra['dataico_customer_status'];
	$dataico_validation_date                         = $datos_info_factura_compra['dataico_validation_date'];
	$dataico_qrcode                                  = $datos_info_factura_compra['dataico_qrcode'];
	$dataico_xml                                     = $datos_info_factura_compra['dataico_xml'];
	$dataico_invoice_type_code                       = $datos_info_factura_compra['dataico_invoice_type_code'];
	$dataico_pdf_url                                 = $datos_info_factura_compra['dataico_pdf_url'];
	$dataico_dian_status                             = $datos_info_factura_compra['dataico_dian_status'];
	$dataico_dian_error                              = $datos_info_factura_compra['dataico_dian_error'];
	$dataico_dian_path                               = $datos_info_factura_compra['dataico_dian_path'];
	$dataico_dian_reason                             = '';
	$tiempo_final                                    = microtime(true);
	$tiempo_ejecucion_dian_dataico                   = $tiempo_final - $tiempo_inicial;
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
	$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

	$cedula_cli                                      = $matriz_cliente['identificacion_tercero'];
	$nit_cliente                                     = $matriz_cliente['identificacion_tercero'];
	$nombres_clientes                                = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['nombre2_tercero'].' '.$matriz_cliente['apellido1_tercero'].' '.$matriz_cliente['apellido2_tercero'];
	$digito_tercero                                  = $matriz_cliente['digito_tercero'];
	if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_max_info_nota_debito = "SELECT MAX(cod_factura_nota_debito) AS cod_factura_nota_debito FROM tbl15_info_nota_debito";
	$resultado_max_info_nota_debito = mysqli_query($conectar, $sql_max_info_nota_debito);
	$info_max_info_nota_debito = mysqli_fetch_assoc($resultado_max_info_nota_debito);

	$cod_factura_nota_debito                        = 0; 
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$mostrar_datos_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
	$consulta_resolucion_facturacion = mysqli_query($conectar, $mostrar_datos_resolucion_facturacion) or die(mysqli_error($conectar));
	$matriz_consulta_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

	$prefijo_nota_debito                            = $matriz_consulta_resolucion_facturacion['prefijo_resolucion_facturacion'];
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_datos = "SELECT * FROM tbl15_factura_compra_producto WHERE cod_info_factura_compra = '$cod_info_factura_compra'";
	$resultado_datos = mysqli_query($conectar, $sql_datos);
	while ($info_datos = mysqli_fetch_assoc($resultado_datos)) {

		$cod_factura_compra_producto                  = $info_datos['cod_factura_compra_producto']; 
		$cod_producto                                 = $info_datos['cod_producto']; 
		$cod_producto_barra                           = $info_datos['cod_producto_barra']; 
		$cod_info_factura_compra                      = $info_datos['cod_info_factura_compra']; 
		$cod_factura                                  = $info_datos['cod_factura']; 
		$cod_tercero                                  = $info_datos['cod_tercero']; 
		$cod_caja_virtual                             = $info_datos['cod_caja_virtual']; 
		$nombre_producto                              = $info_datos['nombre_producto']; 
		$und_compra                                   = $info_datos['und_compra']; 
		$precio_compra_producto                       = $info_datos['precio_compra_producto']; 
		$total_compra_producto                        = $info_datos['total_compra_producto']; 
		$precio_costo_producto                        = $info_datos['precio_costo_producto']; 
		$total_costo_producto                         = $info_datos['total_costo_producto']; 
		$precio_venta_producto                        = $info_datos['precio_venta_producto']; 
		$peso_producto                                = $info_datos['peso_producto']; 
		$unidad_medida_peso                           = $info_datos['unidad_medida_peso']; 
		$nombre_tipo_producto                         = $info_datos['nombre_tipo_producto']; 
		$nombre_tipo_unidad_medida                    = $info_datos['nombre_tipo_unidad_medida']; 
		$nombre_tipo_presentacion                     = $info_datos['nombre_tipo_presentacion']; 
		$und_producto                                 = $info_datos['und_producto']; 
		$fecha_ymd_venta_producto                     = $info_datos['fecha_ymd_venta_producto']; 
		$fecha_mes_venta_producto                     = $info_datos['fecha_mes_venta_producto']; 
		$fecha_anyo_venta_producto                    = $info_datos['fecha_anyo_venta_producto']; 
		$fecha_seg_venta_producto                     = $info_datos['fecha_seg_venta_producto']; 
		$fecha_alerta                                 = $info_datos['fecha_alerta']; 
		$cod_estado_vacuna                            = $info_datos['cod_estado_vacuna']; 
		$cuenta                                       = $info_datos['cuenta']; 
		$cod_administrador                            = $info_datos['cod_administrador']; 
		$cod_base_caja                                = $info_datos['cod_base_caja']; 
		$iva_ptj                                      = $info_datos['iva_ptj']; 
		$iva_saludable_ptj                            = $info_datos['iva_saludable_ptj']; 
		$precio_ipc_total                             = $info_datos['precio_ipc_total']; 
		$precio_ipc                                   = $info_datos['precio_ipc']; 
		$nombre_tipo_precio                           = $info_datos['nombre_tipo_precio']; 
		$nombre_tipo_precio_venta                     = $info_datos['nombre_tipo_precio_venta']; 
		$comision_ptj                                 = $info_datos['comision_ptj']; 
		$cod_tipo_pago                                = $info_datos['cod_tipo_pago']; 
		$cod_tipo_forma_pago                          = $info_datos['cod_tipo_forma_pago']; 
		$nombre_tipo_factura                          = $info_datos['nombre_tipo_factura']; 
		$nombre_tipo_moneda                           = $info_datos['nombre_tipo_moneda']; 
		$nombre_tipo_compra                           = $info_datos['nombre_tipo_compra']; 
		$cod_puc                                      = $info_datos['cod_puc']; 
		$vendedor                                     = $info_datos['cuenta'];

		$total_costo_producto                         = $info_datos['precio_costo_producto'] * $und_compra;
		$total_factura_compra_producto                = $precio_compra_producto * $und_compra;
		$unidades_vendidas                            = $und_compra - $und_compra;
		$und_vend_orig                                = $und_compra;
		$vlr_total_venta                              = $precio_compra_producto * $und_compra;
		$vlr_total_compra                             = $precio_compra_producto * $und_compra;
		$devoluciones                                 = $und_compra;

		$sql_datos_producto = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
		$resultado_datos_producto = mysqli_query($conectar, $sql_datos_producto);
		$info_datos_producto = mysqli_fetch_assoc($resultado_datos_producto);

		$und_producto_inv                              = $info_datos_producto['und_producto']; 
		$und_producto                                  = $und_producto_inv - $und_compra;
		$und_inventario	                               = $und_producto_inv;
		$und_nuevas                                    = $und_compra;
		$und_venta                                     = $und_compra;

		$agregar_regis = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
		$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

		$sql_datos_producto_desp = "SELECT und_producto FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
		$resultado_datos_producto_desp = mysqli_query($conectar, $sql_datos_producto_desp);
		$info_datos_producto_desp = mysqli_fetch_assoc($resultado_datos_producto_desp);

		$unidades_faltantes                            = $info_datos_producto_desp['und_producto']; 
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
		$agregar_operacion = "INSERT INTO tbl15_operacion (cod_producto_barra, nombre_producto, origen_operacion, cod_factura, 
		unidades_vendidas, und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
		vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
		vendedor, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes) 
		VALUES ('$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$cod_factura', 
		'$unidades_vendidas', '$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
		'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_ymd_venta_producto', '$fecha_ymd_venta_producto', 
		'$vendedor', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes')";
		$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
		$agregar_nota_debito = "INSERT INTO tbl15_nota_debito (cod_info_nota_debito, cod_info_factura_compra, cod_factura_compra_producto, cod_producto, cod_producto_barra, 
		cod_factura, cod_tercero, cod_caja_virtual, nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, 
		total_costo_producto, precio_venta_producto, unidad_medida_peso, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, und_producto, 
		fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, 
		fecha_seg_venta_producto, cuenta, cod_administrador, und_producto_inv, iva_ptj, iva_saludable_ptj, 
		ptj_ret_fuente, precio_ipc_total, precio_ipc, cod_resolucion_facturacion, nombre_tipo_precio, 
		nombre_tipo_precio_venta, comision_ptj, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, nombre_tipo_compra, cod_puc) 
		VALUES ('$cod_info_nota_debito', '$cod_info_factura_compra', '$cod_factura_compra_producto', '$cod_producto', '$cod_producto_barra', 
		'$cod_factura', '$cod_tercero', '$cod_caja_virtual', '$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', 
		'$total_costo_producto', '$precio_venta_producto', '$unidad_medida_peso', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', '$und_producto', 
		'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', 
		'$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', '$und_producto_inv', '$iva_ptj', '$iva_saludable_ptj', 
		'$ptj_ret_fuente', '$precio_ipc_total', '$precio_ipc', '$cod_resolucion_facturacion', '$nombre_tipo_precio', 
		'$nombre_tipo_precio_venta', '$comision_ptj', '$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$nombre_tipo_compra', '$cod_puc')";
		$resultado_nota_debiton = mysqli_query($conectar, $agregar_nota_debito) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
		/*
		if ($cod_tipo_pago == '2') {
			$sql_total_deuda_debito = "SELECT SUM(total_venta_producto) AS monto_deuda FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
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
		*/
	}
	//-------------------------------------------------------------------------------------------------------------------//
	$cod_administrador           = $_SESSION['cod_administrador'];

	$agreg = "INSERT INTO tbl15_info_nota_debito (cod_factura_nota_debito, cod_info_factura_compra, prefijo_nota_debito, cod_cufe, dataico_email_status, dataico_uuid, 
	dataico_issue_date, dataico_dian_messages, dataico_customer_status, dataico_xml_url, dataico_validation_date, dataico_qrcode, dataico_xml, dataico_pdf_url, 
	dataico_dian_status, dataico_invoice_type_code, dataico_dian_reason, cod_factura, cod_resolucion_facturacion, cod_tercero, cod_caja_virtual, cod_tipo_pago, cod_tipo_forma_pago, 
	nombre_tipo_factura, total_precio_compra, total_precio_venta, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, fecha_creacion, tiempo_ejecucion_dian_dataico, observacion, cod_administrador) 
	VALUES ('$cod_factura_nota_debito', '$cod_info_factura_compra', '$prefijo_nota_debito', '$cod_cufe', '$dataico_email_status', '$dataico_uuid', 
	'$dataico_issue_date', '$dataico_dian_messages', '$dataico_customer_status', '$dataico_xml_url', '$dataico_validation_date', '$dataico_qrcode', '$dataico_xml', '$dataico_pdf_url', 
	'$dataico_dian_status', '$dataico_invoice_type_code', '$dataico_dian_reason', '$cod_factura', '$cod_resolucion_facturacion', '$cod_tercero', '$cod_caja_virtual', '$cod_tipo_pago', '$cod_tipo_forma_pago', 
	'$nombre_tipo_factura', '$total_precio_compra', '$total_precio_venta', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$fecha_creacion', '$tiempo_ejecucion_dian_dataico', '$observacion', '$cod_administrador')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {

		$nombre_tipo_documento                                 = 'RECIBO DE CAJA';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");

		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		$cod_puc                                               = '2360';
		$codigo_puc                                            = '6225';
		$nombre_puc                                            = 'DEVOLUCIONES EN COMPRAS (CR)';
		$tipo_puc                                              = 'COSTOS DE VENTAS';
		$und_vendida                                           = '1';
		$costo_movimiento_contable                             = $total_precio_compra;
		$total_costo_movimiento_contable                       = $total_precio_compra;

		$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
		$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

		$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
		$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal + $total_precio_compra;
		$saldo_actual_puc                                      = $total_precio_compra;
		$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
		$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
		$valor_movimiento_contable_cuenta_personal             = $total_precio_compra;
		$fecha_ymd_movimiento_caja                             = date("Y-m-d");
		$fecha_mes_movimiento_caja                             = date("Y-m");
		$fecha_anyo_movimiento_caja                            = date("Y");
		$fecha_hora_movimiento_caja                            = date("H:i:s");
		$fecha_seg_movimiento_caja                             = time();
		$fecha_creacion                                        = date("Y-m-d H:i:s");
		$simbolo_tipo_operacion                                = "-";

		$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

		$agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, 
		nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, 
		fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_tipo_forma_pago, cod_info_factura_compra, 
		simbolo_tipo_operacion, total_saldo, cod_tipo_pago)
		VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
		'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_ymd_movimiento_caja', '$fecha_mes_movimiento_caja', 
		'$fecha_seg_movimiento_caja', '$fecha_ymd_movimiento_caja', '$fecha_anyo_movimiento_caja', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$cod_info_factura_compra', 
		'$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_tipo_pago')";
		$resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));
	}
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	if ($cod_sino_crear_mov_contable == '2') {

		$nombre_tipo_documento                                                        = 'NOTA DEBITO';
		$nombre_estado_factura                                                        = 'CERRADA';
		$ip                                                                           = $_SERVER["REMOTE_ADDR"];
		$total_costo_movimiento_contable_smrt                                         = 0;
		$fecha_movimiento_contable_cuenta_personal                                    = date("Y-m-d");
		$cod_estado_automatico                                                        = "1";
		$cod_tipo_nota_observacion                                                    = 1;
		$cod_factura                                                                  = '';
		$venta_movimiento_contable                                                    = '';
		$total_venta_movimiento_contable                                              = '';

		$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
		$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
		$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

		$cod_movimiento_contable                                                      = $datos_autoincremento_egresos['AUTO_INCREMENT'];
		$cod_movimiento_contable2                                                     = $cod_movimiento_contable;

		$sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
		$consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
		$info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

		$cod_guia                                                                     = $info_guia_movimiento['cod_guia']+1;
		$descripcion_movimiento                                                       = "Comprobante de ingreso por devolucion (nota debito) | ".$observacion." | fecha: ".$fecha_movimiento_contable_cuenta_personal." | vendedor: ".$cuenta." | ID COMPRA: ".$cod_info_factura_compra;
		$total_costo_movimiento_contable                                              = $total_precio_compra;

		$agreg_mov_contable_reg = "INSERT INTO tbl15_movimiento_contable (nombre_estado_factura, nombre_tipo_documento, descripcion_movimiento, total_costo_movimiento_contable, cod_tercero, fecha_anyo, 
		fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, cod_tipo_forma_pago, ip, cuenta, cod_guia, cod_tipo_nota_observacion, cod_estado_automatico, nit_cliente, nombres_clientes)
		VALUES ('$nombre_estado_factura',  '$nombre_tipo_documento', '$descripcion_movimiento', '$total_costo_movimiento_contable', '$cod_tercero', '$fecha_anyo', 
		'$fecha_ymd', '$fecha_mes', '$anyo', '$fecha_seg', '$fecha_factura', '$cod_tipo_forma_pago', '$ip', '$cuenta', '$cod_guia', '$cod_tipo_nota_observacion', '$cod_estado_automatico', '$nit_cliente', '$nombres_clientes')";
		$resultado_mov_contable = mysqli_query($conectar, $agreg_mov_contable_reg) or die(mysqli_error($conectar));
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		$sql_total_tipos_iva = "SELECT Sum(total_compra_producto) As total_venta, 
		Sum(total_compra_producto - (total_compra_producto / ((iva_ptj/100)+(100/100)))) As total_base_iva, 
		Sum((total_compra_producto * ((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
		FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
		$consulta_total_tipos_iva = mysqli_query($conectar, $sql_total_tipos_iva) or die(mysqli_error($conectar));
		$datos_total_tipos_iva = mysqli_fetch_assoc($consulta_total_tipos_iva);

		$total_venta                                                                  = $datos_total_tipos_iva['total_venta'];
		$total_base_iva                                                               = $datos_total_tipos_iva['total_base_iva'];
		$total_iva                                                                    = $datos_total_tipos_iva['total_iva'];

	    $sql_puc_debito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc_post')";
	    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
	    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

	    $cod_puc_debito_db                                                            = $info_puc_debito['cod_puc'];
	    $codigo_puc_debito_db                                                         = $info_puc_debito['codigo_puc'];
	    $nombre_puc_debito_db                                                         = $info_puc_debito['nombre_puc'];
	    $tipo_puc_debito_db                                                           = $info_puc_debito['tipo_puc'];
	    $saldo_actual_puc_debito_db                                                   = $info_puc_debito['saldo_actual_puc'];

		$nombre_tipo_movimiento 	                                                  = 'DEBITOS';
		$cod_puc                                                                      = $cod_puc_debito_db;
		$codigo_puc                                                                   = $codigo_puc_debito_db;
		$nombre_puc                                                                   = $nombre_puc_debito_db;
		$tipo_puc                                                                     = $tipo_puc_debito_db;
		$und_vendida                                                                  = '1';
		$costo_movimiento_contable                                                    = $total_precio_compra;
		$total_costo_movimiento_contable                                              = $total_precio_compra;

		$agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
		total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
		VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
		$resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

	    $sql_puc_debito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
	    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

	    $saldo_actual_puc_debito_db                                                   = $info_puc_debito['saldo_actual_puc'];
		$saldo_actual_puc_debito                                                      = $saldo_actual_puc_debito_db + $total_precio_compra;

		$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

		if ($total_iva <> '0') {
			$nombre_tipo_movimiento 	                                                  = 'DEBITOS';
			$cod_puc                                                                      = '1728';
			$codigo_puc                                                                   = '511570';
			$nombre_puc                                                                   = 'IVA DESCONTABLE';
			$tipo_puc                                                                     = 'GASTOS';
			$und_vendida                                                                  = '1';
			$costo_movimiento_contable                                                    = $total_iva;
			$total_costo_movimiento_contable                                              = $total_iva;

			$agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
			total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
			VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
			$resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

		    $sql_puc_debito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $saldo_actual_puc_debito_db                                                   = $info_puc_debito['saldo_actual_puc'];
			$saldo_actual_puc_debito                                                      = $saldo_actual_puc_debito_db + $total_precio_compra;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
		WHERE (nombre_modulo_puc = 'DEVOLUCIONES EN COMPRAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '20')";
		$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
		$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

		$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//289
		$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//1435
		$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//INVENTARIO - MERCANCIAS NO FABRICADAS POR LA EMPRESA
		$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//ACTIVO

		$nombre_tipo_movimiento                                                       = 'CREDITOS';
		//$cod_puc                                                                      = '289';
		//$codigo_puc                                                                   = '1435';
		//$nombre_puc                                                                   = 'INVENTARIO - MERCANCIAS NO FABRICADAS POR LA EMPRESA';
		//$tipo_puc                                                                     = 'ACTIVO';
		$und_vendida                                                                  = '1';
		$costo_movimiento_contable                                                    = $total_precio_compra - $total_iva;
		$total_costo_movimiento_contable                                              = $total_precio_compra - $total_iva;

		$agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
		total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
		VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
		$resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

		$sql_puc_debito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
	    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

	    $saldo_actual_puc_debito_db                                                  = $info_puc_debito['saldo_actual_puc'];
		$saldo_actual_puc_debito                                                     = $saldo_actual_puc_debito_db - $total_precio_compra;

		$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
	}
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$borrar_sql = sprintf("DELETE FROM tbl15_factura_compra_producto WHERE cod_info_factura_compra = '$cod_info_factura_compra'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$data_sql = ("UPDATE tbl15_info_factura_compra SET nombre_estado_factura_dataico_dian = '$nombre_estado_factura_dataico_dian' WHERE cod_info_factura_compra = '$cod_info_factura_compra'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	header('Content-Type: application/json'); 

	$datos_array['afectado'] = "".$afectado;
	$datos_array['cod_info_factura_compra'] = "".$cod_info_factura_compra;
	$datos_array['cod_factura'] = "".$cod_factura;
	$datos_array['cod_factura_nota_debito'] = "".$cod_factura_nota_debito;

	echo json_encode($datos_array);
}
// ------------------------------------------------------------------------------------------------- //
?>