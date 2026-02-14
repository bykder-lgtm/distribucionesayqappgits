<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');

if ((isset($_GET['cod_movimiento_contable_cuenta_personal_concepto'])) && ($_GET['cod_movimiento_contable_cuenta_personal_concepto'] != "")) {

	$cod_movimiento_contable_cuenta_personal_concepto  = intval($_GET["cod_movimiento_contable_cuenta_personal_concepto"]);
	$fecha_anyo_ini                                    = addslashes($_GET["fecha_anyo_ini"]);
	$fecha_anyo_fin                                    = addslashes($_GET["fecha_anyo_fin"]);
	$tipo_puc_get                                      = addslashes($_GET["tipo_puc"]);
	$pagina                                            = addslashes($_GET["pagina"]);
	$pagina_redirect                                   = $pagina."?fecha_anyo_ini=".$fecha_anyo_ini."&fecha_anyo_fin=".$fecha_anyo_fin."&tipo_puc=".$tipo_puc_get."";
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_info_factura = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal_concepto WHERE (cod_movimiento_contable_cuenta_personal_concepto = '$cod_movimiento_contable_cuenta_personal_concepto')";
	$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
	$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

    $nombre_tipo_movimiento                                   = $info_info_factura['nombre_tipo_movimiento'];
    $nombre_tipo_documento                                    = $info_info_factura['nombre_tipo_documento'];
    $cod_tercero                                              = $info_info_factura['cod_tercero'];
    $cod_puc                                                  = $info_info_factura['cod_puc'];
    $codigo_puc                                               = $info_info_factura['codigo_puc'];
    $nombre_puc                                               = $info_info_factura['nombre_puc'];
    $tipo_puc                                                 = $info_info_factura['tipo_puc'];
    $costo_movimiento_contable                                = $info_info_factura['costo_movimiento_contable'];
    $cod_movimiento_contable_cuenta_personal                  = $info_info_factura['cod_movimiento_contable_cuenta_personal'];
    $cod_egreso                                               = $info_info_factura['cod_egreso'];
    $cod_tipo_pago                                            = $info_info_factura['cod_tipo_pago'];
    $nombre_tipo_puc                                          = $tipo_puc;
    $costo                                                    = $costo_movimiento_contable ;
    $nombre_modulo_puc                                        = $info_info_factura['nombre_modulo_puc'];
    $cod_movimiento_contable                                  = $info_info_factura['cod_movimiento_contable'];
    $und_vendida                                              = $info_info_factura['und_vendida'];
    $total_costo_movimiento_contable                          = $info_info_factura['total_costo_movimiento_contable'];
    $fecha_anyo                                               = $info_info_factura['fecha_anyo'];
    $fecha_mes                                                = $info_info_factura['fecha_mes'];
    $fecha_seg                                                = $info_info_factura['fecha_seg'];
    $fecha_ymd                                                = $info_info_factura['fecha_ymd'];
    $anyo                                                     = $info_info_factura['anyo'];
    $ip                                                       = $info_info_factura['ip'];
    $cuenta                                                   = $info_info_factura['cuenta'];
    $comentario                                               = $info_info_factura['comentario'];
    $simbolo_tipo_operacion                                   = $info_info_factura['simbolo_tipo_operacion'];
    $cod_tipo_forma_pago                                      = $info_info_factura['cod_tipo_forma_pago'];
    $total_saldo                                              = $info_info_factura['total_saldo'];
    $nombre_tipo_cuenta_cobrar_pagar                          = $info_info_factura['nombre_tipo_cuenta_cobrar_pagar'];
    $cod_cuentas_pagar                                        = $info_info_factura['cod_cuentas_pagar'];
    $nombre_cuenta_pagar                                      = $info_info_factura['nombre_cuenta_pagar'];
    $cod_info_factura_venta                                   = $info_info_factura['cod_info_factura_venta'];
    $cod_info_factura_compra                                  = $info_info_factura['cod_info_factura_compra'];
    $cod_info_cotizacion_factura_compra                       = $info_info_factura['cod_info_cotizacion_factura_compra'];
    $cod_info_cotizacion_factura_venta                        = $info_info_factura['cod_info_cotizacion_factura_venta'];
    $cod_info_factura_auditoria                               = $info_info_factura['cod_info_factura_auditoria'];
    $cod_info_factura_transferencia                           = $info_info_factura['cod_info_factura_transferencia'];
    $cod_info_factura_transferencia_bodega_entrada            = $info_info_factura['cod_info_factura_transferencia_bodega_entrada'];
    $cod_info_factura_transferencia_bodega                    = $info_info_factura['cod_info_factura_transferencia_bodega'];
    $cod_cuentas_cobrar                                       = $info_info_factura['cod_cuentas_cobrar'];
    $cod_cuentas_cobrar_abonos                                = $info_info_factura['cod_cuentas_cobrar_abonos'];
    $cod_cuentas_pagar_abonos                                 = $info_info_factura['cod_cuentas_pagar_abonos'];
    $fecha_creacion                                           = $info_info_factura['fecha_creacion'];
    $fecha_modificacion                                       = $info_info_factura['fecha_modificacion'];
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
	$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
	$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

	$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
	$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal;
	$saldo_actual_puc                                      = $costo;
	$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	if ($nombre_tipo_puc == 'INGRESOS' && $cod_tipo_pago == '1') {
		$total_saldo_final                     = $total_saldo - $costo;
		$nombre_tipo_documento                 = 'RECIBO DE CAJA';
		$nombre_tipo_movimiento                = 'DEBITOS';

		$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo_final', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
	} elseif ($nombre_tipo_puc == 'EGRESOS' && $cod_tipo_pago == '1') {
		$total_saldo_final                     = $total_saldo + $costo;
		$nombre_tipo_documento                 = 'COMPROBANTE DE EGRESO';
		$nombre_tipo_movimiento                = 'DEBITOS';

		$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo_final', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
	} elseif ($nombre_tipo_puc == 'PASIVOS' && $cod_tipo_pago == '1') {
		$total_saldo_final                     = $total_saldo + $costo;
		$nombre_tipo_documento                 = 'COMPROBANTE DE EGRESO';
		$nombre_tipo_movimiento                = 'DEBITOS';

		$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo_final', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
	} else {

	}
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_data = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto_copia (cod_movimiento_contable_cuenta_personal_concepto, 
	nombre_modulo_puc, cod_movimiento_contable, nombre_tipo_movimiento, nombre_tipo_documento, cod_tercero, 
	cod_puc, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, 
	fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, simbolo_tipo_operacion, cod_tipo_forma_pago, 
	total_saldo, nombre_tipo_cuenta_cobrar_pagar, cod_cuentas_pagar, nombre_cuenta_pagar, cod_info_factura_venta, cod_info_factura_compra, 
	cod_info_cotizacion_factura_compra, cod_info_cotizacion_factura_venta, cod_info_factura_auditoria, cod_info_factura_transferencia, 
	cod_info_factura_transferencia_bodega_entrada, cod_info_factura_transferencia_bodega, cod_cuentas_cobrar, cod_cuentas_cobrar_abonos, 
	cod_cuentas_pagar_abonos, cod_egreso, cod_movimiento_contable_cuenta_personal, fecha_creacion, fecha_modificacion, cod_tipo_pago) 
	VALUES ('$cod_movimiento_contable_cuenta_personal_concepto', 
	'$nombre_modulo_puc', '$cod_movimiento_contable', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$cod_tercero', 
	'$cod_puc', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', 
	'$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$simbolo_tipo_operacion', '$cod_tipo_forma_pago', 
	'$total_saldo', '$nombre_tipo_cuenta_cobrar_pagar', '$cod_cuentas_pagar', '$nombre_cuenta_pagar', '$cod_info_factura_venta', '$cod_info_factura_compra', 
	'$cod_info_cotizacion_factura_compra', '$cod_info_cotizacion_factura_venta', '$cod_info_factura_auditoria', '$cod_info_factura_transferencia', 
	'$cod_info_factura_transferencia_bodega_entrada', '$cod_info_factura_transferencia_bodega', '$cod_cuentas_cobrar', '$cod_cuentas_cobrar_abonos', 
	'$cod_cuentas_pagar_abonos', '$cod_egreso', '$cod_movimiento_contable_cuenta_personal', '$fecha_creacion', '$fecha_modificacion', '$cod_tipo_pago')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$borrar_sql = ("DELETE FROM tbl15_movimiento_contable_cuenta_personal_concepto WHERE cod_movimiento_contable_cuenta_personal_concepto = '$cod_movimiento_contable_cuenta_personal_concepto'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	if ($cod_info_factura_venta <> '0') {
		
		$borrar_sql = ("DELETE FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

		$borrar_sql = ("DELETE FROM tbl15_venta_producto WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	} elseif ($cod_info_factura_compra <> '0') {

		$sql_max_info_nota_debito = "SELECT MAX(cod_factura_nota_debito) AS cod_factura_nota_debito FROM tbl15_info_nota_debito";
		$resultado_max_info_nota_debito = mysqli_query($conectar, $sql_max_info_nota_debito);
		$info_max_info_nota_debito = mysqli_fetch_assoc($resultado_max_info_nota_debito);
		$cod_factura_nota_debito                        = $info_max_info_nota_debito['cod_factura_nota_debito'] + 1; 

		$sql_autoincremento_info_nota_debito = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_nota_debito'";
		$exec_autoincremento_info_nota_debito = mysqli_query($conectar, $sql_autoincremento_info_nota_debito) or die(mysqli_error($conectar));
		$datos_autoincremento_info_nota_debito = mysqli_fetch_assoc($exec_autoincremento_info_nota_debito);
		$cod_info_nota_debito = $datos_autoincremento_info_nota_debito['AUTO_INCREMENT'];

		$borrar_sql = ("DELETE FROM tbl15_info_factura_compra WHERE cod_info_factura_compra = '$cod_info_factura_compra'");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

		$borrar_sql = ("DELETE FROM tbl15_factura_compra_producto WHERE cod_info_factura_compra = '$cod_info_factura_compra'");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	} elseif ($cod_cuentas_cobrar_abonos <> '0') {

	} else {

	}
	//-------------------------------------- -----------------------------------------------------------------//
	if ($cod_egreso <> '0') {
		$sql_egreso = "SELECT * FROM tbl15_egreso WHERE (cod_egreso = '$cod_egreso')";
		$resultado_egreso = mysqli_query($conectar, $sql_egreso) or die(mysqli_error($conectar));
		$info_egreso = mysqli_fetch_assoc($resultado_egreso);

	    $conceptos                                                = $info_egreso['conceptos'];
	    $costo                                                    = $info_egreso['costo'];
	    $comentario                                               = $info_egreso['comentario'];
	    $cod_concepto_movimiento_caja                             = $info_egreso['cod_concepto_movimiento_caja'];
	    $nombre_concepto_movimiento_caja                          = $info_egreso['nombre_concepto_movimiento_caja'];
	    $cod_tipo_puc                                             = $info_egreso['cod_tipo_puc'];
	    $nombre_tipo_puc                                          = $info_egreso['nombre_tipo_puc'];
	    $simbolo_tipo_operacion                                   = $info_egreso['simbolo_tipo_operacion'];
	    $cod_tipo_forma_pago                                      = $info_egreso['cod_tipo_forma_pago'];
	    $total_compra_producto                                    = $info_egreso['total_compra_producto'];
	    $total_venta_producto                                     = $info_egreso['total_venta_producto'];
	    $total_saldo                                              = $info_egreso['total_saldo'];
	    $fecha_ymd_movimiento_caja                                = $info_egreso['fecha_ymd_movimiento_caja'];
	    $nombre_ccosto                                            = $info_egreso['nombre_ccosto'];
	    $fecha_time                                               = $info_egreso['fecha_time'];
	    $fecha_dmy                                                = $info_egreso['fecha_dmy'];
	    $fecha_mes_ym                                             = $info_egreso['fecha_mes_ym'];
	    $anyo                                                     = $info_egreso['anyo'];
	    $hora                                                     = $info_egreso['hora'];
	    $ip                                                       = $info_egreso['ip'];
	    $cod_tercero                                              = $info_egreso['cod_tercero']; 
	    $codigo_puc                                               = $info_egreso['codigo_puc'];
	    $nombre_puc                                               = $info_egreso['nombre_puc'];     
	    $tipo_puc                                                 = $info_egreso['tipo_puc'];
	    $cod_dependencia                                          = $info_egreso['cod_dependencia']; 
	    $cuenta                                                   = $info_egreso['cuenta'];
	    $nombre_tipo_cuenta_cobrar_pagar                          = $info_egreso['nombre_tipo_cuenta_cobrar_pagar']; 
	    $cod_cuentas_pagar                                        = $info_egreso['cod_cuentas_pagar'];
	    $nombre_cuenta_pagar                                      = $info_egreso['nombre_cuenta_pagar']; 
	    $cod_info_empresa                                         = $info_egreso['cod_info_empresa'];
	    $nombre_info_empresa                                      = $info_egreso['nombre_info_empresa'];     
	    $fecha_creacion                                           = $info_egreso['fecha_creacion'];
	    $fecha_modificacion                                       = $info_egreso['fecha_modificacion']; 

		$sql_data = "INSERT INTO tbl15_egreso_copia (cod_egreso, conceptos, costo, comentario, cod_concepto_movimiento_caja, nombre_concepto_movimiento_caja, 
		cod_tipo_puc, nombre_tipo_puc, simbolo_tipo_operacion, cod_tipo_forma_pago, total_compra_producto, total_venta_producto, total_saldo, fecha_ymd_movimiento_caja, 
		nombre_ccosto, fecha_time, fecha_dmy, fecha_mes_ym, anyo, hora, ip, cod_tercero, codigo_puc, nombre_puc, tipo_puc, cod_dependencia, cuenta, 
		nombre_tipo_cuenta_cobrar_pagar, cod_cuentas_pagar, nombre_cuenta_pagar, cod_info_empresa, nombre_info_empresa, fecha_creacion, fecha_modificacion) 
		VALUES ('$cod_egreso', '$conceptos', '$costo', '$comentario', '$cod_concepto_movimiento_caja', '$nombre_concepto_movimiento_caja', 
		'$cod_tipo_puc', '$nombre_tipo_puc', '$simbolo_tipo_operacion', '$cod_tipo_forma_pago', '$total_compra_producto', '$total_venta_producto', '$total_saldo', '$fecha_ymd_movimiento_caja', 
		'$nombre_ccosto', '$fecha_time', '$fecha_dmy', '$fecha_mes_ym', '$anyo', '$hora', '$ip', '$cod_tercero', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$cod_dependencia', '$cuenta', 
		'$nombre_tipo_cuenta_cobrar_pagar', '$cod_cuentas_pagar', '$nombre_cuenta_pagar', '$cod_info_empresa', '$nombre_info_empresa', '$fecha_creacion', '$fecha_modificacion')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

		$borrar_sql = ("DELETE FROM tbl15_egreso WHERE cod_egreso = '$cod_egreso'");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	}

?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>