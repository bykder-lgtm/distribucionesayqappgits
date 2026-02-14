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
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT cod_estado_generar_movimiento_contable_automatico_global, cod_estado_promediar_precio_compra_y_venta_cargar_factura_global, 
cod_estado_enviar_factura_documento_soporte_dian_api_global, cod_estado_movimiento_contable_cuenta_personal_global
FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_generar_movimiento_contable_automatico_global         = $info_empresa_data['cod_estado_generar_movimiento_contable_automatico_global'];
$cod_estado_promediar_precio_compra_y_venta_cargar_factura_global = $info_empresa_data['cod_estado_promediar_precio_compra_y_venta_cargar_factura_global'];
$cod_estado_enviar_factura_documento_soporte_dian_api_global      = $info_empresa_data['cod_estado_enviar_factura_documento_soporte_dian_api_global'];
$cod_estado_movimiento_contable_cuenta_personal_global            = $info_empresa_data['cod_estado_movimiento_contable_cuenta_personal_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//

if (isset($_GET['cod_info_factura_compra'])) {
	$cod_info_factura_compra                           = intval($_GET['cod_info_factura_compra']);
	$pagina                                            = addslashes($_GET['pagina']);

	$sql_info_imp_factura = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$modificar_info_imp_factura = mysqli_query($conectar, $sql_info_imp_factura) or die(mysqli_error($conectar));
	$total_encontrado_info_imp_factura = mysqli_num_rows($modificar_info_imp_factura);
	$matriz_info_imp_factura  = mysqli_fetch_assoc($modificar_info_imp_factura);

	$cod_tercero                                       = $matriz_info_imp_factura['cod_tercero'];
	$nombre_rete_fuente_ptj                            = $matriz_info_imp_factura['nombre_rete_fuente_ptj'];
	$ret_ica_ptj                                       = $matriz_info_imp_factura['ret_ica_ptj'];
	$subtotal                                          = $matriz_info_imp_factura['subtotal'];
	$total_valor_iva                                   = $matriz_info_imp_factura['valor_iva'];
	$total_factura_compra_retefuente                   = $matriz_info_imp_factura['total_factura_compra_retefuente'];
	$cod_tipo_forma_pago                               = $matriz_info_imp_factura['cod_tipo_forma_pago'];
	$cod_tipo_pago                                     = $matriz_info_imp_factura['cod_tipo_pago'];
	$cod_factura                                       = $matriz_info_imp_factura['cod_factura'];
	$fecha_ymdhis                                      = $matriz_info_imp_factura['fecha_ymdhis'];
	$fecha_anyo                                        = $matriz_info_imp_factura['fecha_anyo'];
	$cod_resolucion_facturacion                        = $matriz_info_imp_factura['cod_resolucion_facturacion'];
	$total_compra_imp                                  = $matriz_info_imp_factura['total_compra_imp'];
	$cuenta                                            = $matriz_info_imp_factura['cuenta'];
	$cod_caja_virtual                                  = $matriz_info_imp_factura['cod_caja_virtual'];
	$total_rete_fuente                                 = $matriz_info_imp_factura['total_rete_fuente'];
	$observacion                                       = $matriz_info_imp_factura['observacion'];
	$cod_puc_post                                      = $matriz_info_imp_factura['cod_puc'];
	$cod_movimiento_contable_cuenta_personal           = $matriz_info_imp_factura['cod_movimiento_contable_cuenta_personal'];
	$cod_sino_crear_mov_contable                       = '2';

	$fecha_anyo_seg                                    = strtotime($fecha_anyo);
	$fecha_dia                                         = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes                                         = date("Y-m", $fecha_anyo_seg);
	$anyo                                              = date("Y", $fecha_anyo_seg);
	$fecha_factura                                     = date("Y-m-d");
	$comentario                                        = '';
	$venta_movimiento_contable                         = '0';
	$total_venta_movimiento_contable                   = '0';
	$cod_estado_mov_contable_antes_de_guardar          = '1';
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion')";
	$resultado_resolucion_facturacion = mysqli_query($conectar, $sql_resolucion_facturacion);
	$info_resolucion_facturacion = mysqli_fetch_assoc($resultado_resolucion_facturacion);

	$nombre_tipo_resolucion_facturacion                 = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
	$nombre_tipo_factura                                = $nombre_tipo_resolucion_facturacion;
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_info_cliente = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
	$resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
	$info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

	$nit_cliente                                        = $info_cliente['identificacion_tercero'];
	$nombres_clientes                                   = $info_cliente['nombre1_tercero'];
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($cod_estado_generar_movimiento_contable_automatico_global == '1') {
		$fecha_ymd                                             = date("Y-m-d", strtotime($fecha_anyo));
		$fecha_mes                                             = date("Y-m", strtotime($fecha_anyo));
		$anyo                                                  = date("Y", strtotime($fecha_anyo));
		$fecha_seg                                             = strtotime($fecha_anyo);

		$nombre_tipo_documento                                 = 'COMPROBANTE DE EGRESO';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$total_costo_movimiento_contable_smrt                  = 0;
		$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");

		$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
		$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
		$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

		$cod_movimiento_contable                               = $datos_autoincremento_egresos['AUTO_INCREMENT'];

		$sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
		$consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
		$info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

		$cod_guia                                              = $info_guia_movimiento['cod_guia']+1;
/* ----------------------------------------------------------------------------------------------------------/ */
		$doc_modifica                                          = "FACTURA COMPRA: ".$cod_factura." | ".$nombres_clientes." | ".(($subtotal + $total_valor_iva) - $total_rete_fuente)." | ".$fecha_anyo." | ID ".$cod_info_factura_compra;
		$descripcion_movimiento                                = "factura compra: ".$cod_factura." | ".$observacion;
		$total_costo_movimiento_contable                       = $total_compra_imp;
		$cod_tipo_nota_observacion                             = 3;
/* ----------------------------------------------------------------------------------------------------------/ */
		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable (nombre_estado_factura, cod_factura, doc_modifica, nombre_tipo_documento, descripcion_movimiento, total_costo_movimiento_contable,  
		cod_tercero, nombres_clientes, nit_cliente, fecha_anyo, fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, cod_tipo_forma_pago, ip, cuenta, cod_guia, cod_tipo_nota_observacion, cod_info_factura_compra)
		VALUES ('$nombre_estado_factura', '$cod_factura',  '$doc_modifica', '$nombre_tipo_documento', '$descripcion_movimiento', '$total_costo_movimiento_contable', 
		'$cod_tercero', '$nombres_clientes', '$nit_cliente', '$fecha_anyo', '$fecha_ymd', '$fecha_mes', '$anyo', '$fecha_seg', '$fecha_factura', '$cod_tipo_forma_pago', '$ip', '$cuenta', '$cod_guia', '$cod_tipo_nota_observacion', '$cod_info_factura_compra')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
		$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
		WHERE (nombre_modulo_puc = 'COMPRAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '9')";
		$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
		$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

		$cod_puc                                               = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//1659
		$codigo_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//470510
		$nombre_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//INVENTARIOS (CR)
		$tipo_puc                                              = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//INGRESOS

		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		//$cod_puc                                               = '1659';
		//$codigo_puc                                            = '470510';
		//$nombre_puc                                            = 'INVENTARIOS (CR)';
		//$tipo_puc                                              = 'INGRESOS';
		$und_vendida                                           = '1';
		$costo_movimiento_contable                             = $subtotal;
		$total_costo_movimiento_contable                       = $subtotal;	

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
		venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
		VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

		$sql_puc_debito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
	    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

	    $saldo_actual_puc_debito_db                        = $info_puc_debito['saldo_actual_puc'];
		$saldo_actual_puc_debito                           = $saldo_actual_puc_debito_db + $costo_movimiento_contable;

		$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
		if ($total_valor_iva > 0) {

			$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
			WHERE (nombre_modulo_puc = 'COMPRAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '10')";
			$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
			$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

			$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//1914
			$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//521570
			$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//IVA DESCONTABLE
			$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//GASTOS

			$nombre_tipo_movimiento 	                       = 'DEBITOS';
			//$cod_puc                                           = '1914';
			//$codigo_puc                                        = '521570';
			//$nombre_puc                                        = 'IVA DESCONTABLE';
			//$tipo_puc                                          = 'GASTOS';
			$und_vendida                                       = '1';
			$costo_movimiento_contable                         = $total_valor_iva;
			$total_costo_movimiento_contable                   = $total_valor_iva;	

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
			venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
			VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$sql_puc_debito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $saldo_actual_puc_debito_db                        = $info_puc_debito['saldo_actual_puc'];
			$saldo_actual_puc_debito                           = $saldo_actual_puc_debito_db + $costo_movimiento_contable;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}
/* ----------------------------------------------------------------------------------------------------------/ */
		if ($total_rete_fuente > 0) {

			$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
			WHERE (nombre_modulo_puc = 'COMPRAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '11')";
			$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
			$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

			$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//211
			$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//135515
			$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//RETENCION EN LA FUENTE
			$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//ACTIVO

			$nombre_tipo_movimiento 	                       = 'CREDITOS';
			//$cod_puc                                           = '211';
			//$codigo_puc                                        = '135515';
			//$nombre_puc                                        = 'RETENCION EN LA FUENTE';
			//$tipo_puc                                          = 'ACTIVO';
			$und_vendida                                       = '1';
			$costo_movimiento_contable                         = $total_rete_fuente;
			$total_costo_movimiento_contable                   = $total_rete_fuente;	

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
			venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
			VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$sql_puc_debito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $saldo_actual_puc_debito_db                        = $info_puc_debito['saldo_actual_puc'];
			$saldo_actual_puc_debito                           = $saldo_actual_puc_debito_db + $costo_movimiento_contable;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}
/* ----------------------------------------------------------------------------------------------------------/ */
		if ($cod_tipo_pago == '1') { //CONTADO

		    $sql_puc_credito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc_post')";
		    $resultado_puc_credito = mysqli_query($conectar, $sql_puc_credito);
		    $info_puc_credito = mysqli_fetch_assoc($resultado_puc_credito);
	        //$existe_reg = mysqli_num_rows($resultado_puc_credito);

		    $cod_puc_credito_db                                = $info_puc_credito['cod_puc'];
		    $codigo_puc_credito_db                             = $info_puc_credito['codigo_puc'];
		    $nombre_puc_credito_db                             = $info_puc_credito['nombre_puc'];
		    $tipo_puc_credito_db                               = $info_puc_credito['tipo_puc'];
		    $saldo_actual_puc_credito_db                       = $info_puc_credito['saldo_actual_puc'];

			$nombre_tipo_movimiento 	                       = 'CREDITOS';
			$cod_puc                                           = $cod_puc_credito_db;
			$codigo_puc                                        = $codigo_puc_credito_db;
			$nombre_puc                                        = $nombre_puc_credito_db;
			$tipo_puc                                          = $tipo_puc_credito_db;
			$und_vendida                                       = '1';
			$costo_movimiento_contable                         = ($subtotal + $total_valor_iva) - $total_rete_fuente;
			$total_costo_movimiento_contable                   = ($subtotal + $total_valor_iva) - $total_rete_fuente;	

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
			venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
			VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$sql_puc_debito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $saldo_actual_puc_debito_db                        = $info_puc_debito['saldo_actual_puc'];
			$saldo_actual_puc_debito                           = $saldo_actual_puc_debito_db - $costo_movimiento_contable;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

		} else { //CREDITO

			$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
			WHERE (nombre_modulo_puc = 'COMPRAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '12')";
			$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
			$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

			$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//765
			$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//23
			$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//CUENTAS POR PAGAR
			$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//PASIVOS

			$nombre_tipo_movimiento 	                                                  = 'CREDITOS';
			//$cod_puc                                                                      = '765';
			//$codigo_puc                                                                   = '23';
			//$nombre_puc                                                                   = 'CUENTAS POR PAGAR';
			//$tipo_puc                                                                     = 'PASIVOS';
			$und_vendida                                                                  = '1';
			$costo_movimiento_contable                                                    = ($subtotal + $total_valor_iva) - $total_rete_fuente;
			$total_costo_movimiento_contable                                              = ($subtotal + $total_valor_iva) - $total_rete_fuente;	

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
			venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
			VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$sql_puc_debito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $saldo_actual_puc_debito_db                        = $info_puc_debito['saldo_actual_puc'];
			$saldo_actual_puc_debito                           = $saldo_actual_puc_debito_db - $costo_movimiento_contable;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}
		if ($cod_tipo_pago == '1') { $nombre_tipo_documento = 'COMPROBANTE DE EGRESO'; } else { $nombre_tipo_documento = 'MOVIMIENTO INTERNO'; }
		$costo_movimiento_contable                             = $total_factura_compra_retefuente;
		$total_costo_movimiento_contable                       = $total_factura_compra_retefuente;
		$fecha_ymd                                             = date("Y-m-d", strtotime($fecha_anyo));
		$fecha_mes                                             = date("Y-m", strtotime($fecha_anyo));
		$anyo                                                  = date("Y", strtotime($fecha_anyo));
		$fecha_seg                                             = time();
		$comentario                                            = 'generado por factura de compra antes de cargar ID: '.$cod_info_factura_compra.' - factura: '.$cod_factura.' - proveedor: '.$nombres_clientes;

		$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
		$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

		$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
		$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal - $total_factura_compra_retefuente;
		$saldo_actual_puc                                      = $total_factura_compra_retefuente;
		$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
		$simbolo_tipo_operacion                                = "-";

		if ($cod_tipo_pago == '1') {

			$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
			WHERE (nombre_modulo_puc = 'COMPRAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '7')";
			$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
			$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

			$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//754
			$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//22
			$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//PAGO A PROVEEDORES
			$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//GASTOS

			$nombre_tipo_movimiento 	                           = 'DEBITOS';
			//$cod_puc                                               = '754';
			//$codigo_puc                                            = '22';
			//$nombre_puc                                            = 'PAGO A PROVEEDORES';
			$tipo_puc                                              = 'PASIVOS';

			$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		} else {
			$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
			WHERE (nombre_modulo_puc = 'COMPRAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '8')";
			$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
			$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

			$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//765
			$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//23
			$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//CUENTAS POR PAGAR
			$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//PASIVOS

			$nombre_tipo_movimiento 	                           = 'DEBITOS';
			//$cod_puc                                               = '765';
			//$codigo_puc                                            = '23';
			//$nombre_puc                                            = 'CUENTAS POR PAGAR';
			//$tipo_puc                                              = 'PASIVOS';
		}

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, 
		nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
		cuenta, comentario, cod_tercero, cod_tipo_forma_pago, simbolo_tipo_operacion, total_saldo, cod_info_factura_compra, cod_tipo_pago)
		VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
		'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
		'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_info_factura_compra', '$cod_tipo_pago')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	}
	$agregar_regis = sprintf("UPDATE tbl15_info_factura_compra SET cod_estado_mov_contable_antes_de_guardar = '$cod_estado_mov_contable_antes_de_guardar' WHERE (cod_info_factura_compra = '$cod_info_factura_compra')");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
	$url_redir = $pagina."?cod_info_factura_compra=".$cod_info_factura_compra."&cuenta=".$cuenta."&cod_caja_virtual=".$cod_caja_virtual;
	header("Location: $url_redir");
}
?>