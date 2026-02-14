<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_else                               = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {
	$fecha_anyo                              = addslashes($_POST['fecha_anyo']);
	$cod_tercero                             = intval($_POST['cod_tercero']);
	$total_factura_compra_retefuente         = addslashes($_POST['total_factura_compra_retefuente']);
	$nombre_rete_fuente_ptj                  = 0;
	$ret_ica_ptj                             = 0;
	$subtotal                                = $total_factura_compra_retefuente;
	$valor_iva                               = addslashes($_POST['valor_iva']);
	$total_descuento                         = 0;
	$total_precio_ipc                        = 0;
	$total_compra_imp                        = $total_factura_compra_retefuente;
	$total_rete_fuente                       = 0;
	$total_ret_ica                           = 0;
	$cod_tipo_forma_pago                     = intval($_POST['cod_tipo_forma_pago']);
	$cod_tipo_pago                           = intval($_POST['cod_tipo_pago']);
	$cod_administrador                       = intval($_POST['cod_administrador']);
	$cod_factura                             = addslashes($_POST['cod_factura']);
	$total_datos                             = 1;
	$vlr_cancelado                           = 0;
	$pagina                                  = addslashes($_POST['pagina']);
	$fecha_anyo_seg                          = strtotime($fecha_anyo);
	$total_datos_data                        = $total_datos;
	$nombre_estado_factura                   = 'CERRADA';
	$nombre_maquina                          = gethostname();
	$fecha_ult_compra                        = date("Y-m-d");
	$total                                   = $total_factura_compra_retefuente;
	$subtotal_total_precio_compra            = $subtotal;
	$subtotal_total_precio_costo             = $subtotal;
	$total_factura_compra                    = $total_factura_compra_retefuente;
	$fecha_compra                            = $fecha_anyo;
	$total_precio_costo                      = $total_factura_compra_retefuente;
    $precio_compra_producto_ant_desc         = $total_factura_compra_retefuente;
    $total_compra_producto_ant_desc          = $total_factura_compra_retefuente;
    $total_precio_compra                     = $total_factura_compra_retefuente;
    $total_precio_venta                      = 0;
    $fecha_pago                              = $fecha_anyo;
    $monto_deuda                             = $total_factura_compra_retefuente;

	if (isset($_POST['cod_movimiento_contable_cuenta_personal']) <> '') { $cod_movimiento_contable_cuenta_personal = intval($_POST['cod_movimiento_contable_cuenta_personal']); } else { $cod_movimiento_contable_cuenta_personal = ''; }
	if (isset($_POST['cod_tipo_inventario'])) { $cod_tipo_inventario = intval($_POST['cod_tipo_inventario']); } else { $cod_tipo_inventario = '1'; }
	if (isset($_POST['cod_tipo_producto_consumo'])) { $cod_tipo_producto_consumo = intval($_POST['cod_tipo_producto_consumo']); } else { $cod_tipo_producto_consumo = '1'; }
	if (isset($_POST['nombre_tipo_compra'])) { $nombre_tipo_compra = addslashes($_POST['nombre_tipo_compra']); } else { $nombre_tipo_compra = 'NORMAL'; }
	if (isset($_POST['nombre_tipo_moneda'])) { $nombre_tipo_moneda = addslashes($_POST['nombre_tipo_moneda']); } else { $nombre_tipo_moneda = 'COP'; }
	if (isset($_POST['nombre_tipo_factura'])) { $nombre_tipo_factura = addslashes($_POST['nombre_tipo_factura']); } else { $nombre_tipo_factura = 'POS'; }
	if (isset($_POST['nombre_tipo_cargue_factura'])) { $nombre_tipo_cargue_factura = addslashes($_POST['nombre_tipo_cargue_factura']); } else { $nombre_tipo_cargue_factura = 'FACTURA_COMPRA_NORMAL'; }
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	if (isset($_POST['cod_concepto_movimiento_caja']) <> '') { $cod_concepto_movimiento_caja = intval($_POST['cod_concepto_movimiento_caja']); } else { $cod_concepto_movimiento_caja = '14'; }

	$sql_max_factura = "SELECT MAX(cod_factura) AS cod_factura FROM tbl15_info_factura_compra WHERE (nombre_tipo_cargue_factura = 'FACTURA_COMPRA_DOC_SOPORTE')";
	$consulta_max_factura = mysqli_query($conectar, $sql_max_factura) or die(mysqli_error($conectar));
	$datos_max_factura = mysqli_fetch_assoc($consulta_max_factura);

	if ($nombre_tipo_cargue_factura == 'FACTURA_COMPRA_DOC_SOPORTE') { $cod_factura = $datos_max_factura['cod_factura']+1; } else { $cod_factura = $cod_factura; } 
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_tipo_inventario == '1') { $campo_und_inventario = 'und_producto'; } elseif ($cod_tipo_inventario == '2') { $campo_und_inventario = 'und_producto_bodega'; } else { $campo_und_inventario = 'und_producto'; }
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_info_cliente = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
	$resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
	$info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

	$nit_cliente                                        = $info_cliente['identificacion_tercero'];
	$nombres_clientes                                   = trim($info_cliente['nombre1_tercero'].' '.$info_cliente['nombre2_tercero'].' '.$info_cliente['apellido1_tercero'].' '.$info_cliente['apellido2_tercero']);
	$digito                                             = $info_cliente['digito_tercero'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_factura_compra_producto = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_compra'";
	$exec_autoincremento_factura_compra_producto = mysqli_query($conectar, $sql_autoincremento_factura_compra_producto) or die(mysqli_error($conectar));
	$datos_autoincremento_factura_compra_producto = mysqli_fetch_assoc($exec_autoincremento_factura_compra_producto);

	$cod_info_factura_compra                 = $datos_autoincremento_factura_compra_producto['AUTO_INCREMENT'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$time                                    = time();
	$fecha_ymdHis                            = date("YmdHis");
	$formato                                 = 'jpg';
	$fecha_hora                              = date("H:i:s");
	$fecha_ymd                               = date("Y-m-d");
	$nombre_origen_cargue                    = "CARGUE_FACTURA_COMPRA";
	/* ----------------------------------------------------------------------------------------------------------/ */
	$ruta_firma_miniatura                    = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura                     = '../archivador/foto/miniatura/';
	$ruta_firma_orig                         = '../archivador/firma/original/';
	$ruta_foto_orig                          = '../archivador/documentos/';
	$url_img_orig_producto                   = "";
	$url_img_min_producto                    = "";
	/* ----------------------------------------------------------------------------------------------------------/ */
	$fecha_seg       	                     = time();
	$fecha_mes	                             = date("Y-m", strtotime($fecha_anyo));
	$anyo		                             = date("Y", strtotime($fecha_anyo));
	$fecha	                                 = $fecha_anyo;
	$fecha_invert	                         = $fecha_anyo;
	$hora	                                 = date("H:i:s");
	$cuenta                                  = $cuenta_actual;
	$vendedor                                = $cuenta_actual;
	$subtotal                                = $monto_deuda;
	$abonado                                 = 0;
	$fecha_hora                              = date("H:i:s");
	$nombre_origen_cargue                    = "CARGUE_FACTURA_COMPRA_MANUAL";

	$nombre_tipo_puc                         = 'PASIVOS';
	$fecha_time     	                     = time();
	$fecha_mes_ym	                         = date("Y-m", strtotime($fecha_anyo));
	$anyo		                             = date("Y", strtotime($fecha_anyo));
	$hora	                                 = date("H:i:s");
	$und_vendida                             = 1;
	$costo_movimiento_contable               = $total_factura_compra_retefuente;
	$total_costo_movimiento_contable         = $total_factura_compra_retefuente;
	$comentario                              = "factura de factura compra cargadada por modulo simplificado ID: ".$cod_info_factura_compra." - factura: ".$cod_factura." - Proveedor: ".$nombres_clientes;
	$observacion                             = $comentario;
	$ip                                      = "";
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion 
	WHERE (nombre_tipo_resolucion_facturacion = '$nombre_tipo_factura') AND (nombre_tipo_estado = 'ACTIVO')";
	$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
	$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
	$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

	$cod_resolucion_facturacion              = intval($matriz_resol_fact['cod_resolucion_facturacion']);
	//---------------------------------------------------------------------------------------------------------------------------------//
	$fecha_ymdhis                            = $fecha_ymdHis;
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
	$fecha_remision                          = "";
	$nombre_ccosto                           = "";
	$garantia_meses                          = "";
	$fecha_ymd_venta_producto                = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes_venta_producto                = date("Y-m", $fecha_anyo_seg);
	$fecha_anyo_venta_producto               = date("Y", $fecha_anyo_seg);
	$fecha_seg_venta_producto                = time();
	$und_compra                              = 1;
	$unidades_total                          = 1;
	$cod_producto                            = "1";
	$cod_producto_barra                      = "999999";
	$nombre_producto                         = "PRODUCTOS VARIOS";
	$precio_compra_producto                  = $total_factura_compra_retefuente;
	$total_compra_producto                   = $total_factura_compra_retefuente;
	$precio_costo_producto                   = $total_factura_compra_retefuente;
	$total_costo_producto                    = $total_factura_compra_retefuente;

	$sql_info_factura = "SELECT * FROM tbl15_concepto_movimiento_caja WHERE (cod_concepto_movimiento_caja = '$cod_concepto_movimiento_caja')";
	$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
	$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

	$nombre_concepto_movimiento_caja       = $info_info_factura['nombre_concepto_movimiento_caja'];
	$nombre_tipo_puc                       = $info_info_factura['nombre_tipo_puc'];
	$simbolo_tipo_operacion                = $info_info_factura['simbolo_tipo_operacion'];
	$tipo_puc                              = $nombre_tipo_puc;
	$nombre_puc                            = $nombre_concepto_movimiento_caja;
	/* ----------------------------------------------------------------------------------------------------------/ */
	$agregar_reg_compra_producto = "INSERT INTO tbl15_info_factura_compra (cod_info_factura_compra, total, subtotal_total_precio_compra, subtotal_total_precio_costo, total_factura_compra, 
	total_precio_costo, cod_factura, fecha_anyo, fecha_dia, fecha_mes, anyo, fecha_hora, total_precio_compra, total_precio_venta, total_datos_data, 
	cod_tercero, nombre_estado_factura, cuenta, cod_tipo_pago, cod_tipo_forma_pago,
	cod_administrador, nombre_tipo_factura, nombre_tipo_moneda, nombre_tipo_cargue_factura, nombre_rete_fuente_ptj, ret_ica_ptj, subtotal, valor_iva, 
	total_descuento, total_precio_ipc, total_compra_imp, total_rete_fuente, total_ret_ica, total_factura_compra_retefuente, nombre_maquina, cod_resolucion_facturacion, 
	cod_tipo_inventario, cod_tipo_producto_consumo, observacion)
	VALUES ('$cod_info_factura_compra', '$total',  '$subtotal_total_precio_compra', '$subtotal_total_precio_costo', '$total_factura_compra', 
	'$total_precio_costo', '$cod_factura', '$fecha_anyo', '$fecha_dia', '$fecha_mes', '$anyo', '$fecha_hora', '$total_precio_compra', '$total_precio_venta', '$total_datos_data', 
	'$cod_tercero', '$nombre_estado_factura', '$cuenta', '$cod_tipo_pago', '$cod_tipo_forma_pago', 
	'$cod_administrador', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$nombre_tipo_cargue_factura', '$nombre_rete_fuente_ptj', '$ret_ica_ptj', '$subtotal', '$valor_iva', 
	'$total_descuento', '$total_precio_ipc', '$total_compra_imp', '$total_rete_fuente', '$total_ret_ica', '$total_factura_compra_retefuente', '$nombre_maquina', '$cod_resolucion_facturacion', 
	'$cod_tipo_inventario', '$cod_tipo_producto_consumo', '$observacion')";
	$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));

	$agregar_reg_compra_producto = "INSERT INTO tbl15_factura_compra_producto (cod_info_factura_compra, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, 
	und_compra, unidades_total, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, fecha_ymd_venta_producto, 
	fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, nombre_tipo_compra, nombre_tipo_cargue_factura, cod_administrador, 
	cuenta, cod_tipo_inventario, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, cod_factura, cod_tipo_producto_consumo, 
	precio_compra_producto_ant_desc, total_compra_producto_ant_desc)
	VALUES ('$cod_info_factura_compra', '$cod_tercero',  '$cod_producto', '$cod_producto_barra', '$nombre_producto', 
	'$und_compra', '$unidades_total', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$fecha_ymd_venta_producto', 
	'$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$nombre_tipo_compra', '$nombre_tipo_cargue_factura', '$cod_administrador', 
	'$cuenta', '$cod_tipo_inventario', 	'$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_factura', '$cod_tipo_producto_consumo', 
	'$precio_compra_producto_ant_desc', '$total_compra_producto_ant_desc')";
	$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
	WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
	$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
	$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

	$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
	$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal;
	$saldo_actual_puc                                      = $total_factura_compra_retefuente;
	$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
	//-------------------------------------- -----------------------------------------------------------------//
	$total_saldo_final                                     = $total_saldo - $total_factura_compra_retefuente;
	$nombre_tipo_documento                                 = 'COMPROBANTE DE EGRESO';
	$nombre_tipo_movimiento                                = 'DEBITOS';
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	if ($cod_tipo_pago=='1') {
		$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo_final', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
	}
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_autoincremento_movimiento_contable_cuenta_personal_concepto = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable_cuenta_personal_concepto'";
	$exec_autoincremento_movimiento_contable_cuenta_personal_concepto = mysqli_query($conectar, $sql_autoincremento_movimiento_contable_cuenta_personal_concepto) or die(mysqli_error($conectar));
	$datos_autoincremento_movimiento_contable_cuenta_personal_concepto = mysqli_fetch_assoc($exec_autoincremento_movimiento_contable_cuenta_personal_concepto);

	$cod_movimiento_contable_cuenta_personal_concepto        = $datos_autoincremento_movimiento_contable_cuenta_personal_concepto['AUTO_INCREMENT'];

	$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, nombre_tipo_documento, nombre_tipo_movimiento, 
	nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
	cuenta, comentario, cod_tercero, cod_tipo_forma_pago, simbolo_tipo_operacion, total_saldo, cod_info_factura_compra, cod_tipo_pago)
	VALUES ('$cod_movimiento_contable_cuenta_personal', '$nombre_tipo_documento', '$nombre_tipo_movimiento', 
	'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
	'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_info_factura_compra', '$cod_tipo_pago')";
	$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	if ($cod_tipo_pago=='2') {
		$monto_deuda	                   = $total_factura_compra_retefuente;
		$subtotal	                       = $total_factura_compra_retefuente;
		$vendedor	                       = $cuenta;
		$fecha_pago	                       = $fecha_anyo;
		$fecha	                           = $fecha_anyo;
		$fecha_invert	                   = $fecha_anyo;
		$fecha_seg	                       = time();

		$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_pagar'";
		$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
		$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

		$cod_cuentas_pagar  = $datos_autoincremento_egresos['AUTO_INCREMENT'];

		$agregar_reg_compra_producto = "INSERT INTO tbl15_cuentas_pagar (cod_factura, cod_tercero, monto_deuda, subtotal, 
		vendedor, cuenta, fecha_pago, fecha, fecha_invert, fecha_seg, cod_info_factura_compra, cod_cuentas_pagar, fecha_hora, nombre_origen_cargue)
		VALUES ('$cod_factura', '$cod_tercero', '$monto_deuda', '$subtotal', 
		'$vendedor', '$cuenta', '$fecha_pago', '$fecha', '$fecha_invert', '$fecha_seg', '$cod_info_factura_compra', '$cod_cuentas_pagar', '$fecha_hora', '$nombre_origen_cargue')";
		$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/factura_compra_productos_opcion_imprimir.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra ?>&cod_tipo_pago=<?php echo $cod_tipo_pago ?>&pagina=<?php echo $pagina ?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>