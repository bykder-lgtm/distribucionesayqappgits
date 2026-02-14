<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);

$sql_infos_empresas = "SELECT cod_estado_movimiento_contable_cuenta_personal_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_movimiento_contable_cuenta_personal_global                                                        = $info_empresa_data['cod_estado_movimiento_contable_cuenta_personal_global'];

if (isset($_POST['cod_movimiento_contable'])) {

	$cod_movimiento_contable   = intval($_POST['cod_movimiento_contable']);
	if (isset($_POST['nombre_tipo_documento'])) { $nombre_tipo_documento = addslashes($_POST['nombre_tipo_documento']); } else { $nombre_tipo_documento = ""; } 
	if (isset($_POST['descripcion_movimiento'])) { $descripcion_movimiento = addslashes($_POST['descripcion_movimiento']); } else { $descripcion_movimiento = ""; } 
	if (isset($_POST['cod_factura'])) { $cod_factura = addslashes($_POST['cod_factura']); } else { $cod_factura = ""; } 
	if (isset($_POST['doc_modifica'])) { $doc_modifica = addslashes($_POST['doc_modifica']); } else { $doc_modifica = ""; } 
	if (isset($_POST['motivo_modificacion'])) { $motivo_modificacion = addslashes($_POST['motivo_modificacion']); } else { $motivo_modificacion = ""; } 
	if (isset($_POST['fecha_factura'])) { $fecha_factura = addslashes($_POST['fecha_factura']); } else { $fecha_factura = ""; } 
	if (isset($_POST['fecha_ymd'])) { $fecha_ymd = addslashes($_POST['fecha_ymd']); } else { $fecha_ymd = ""; } 
	if (isset($_POST['cod_tercero'])) { $cod_tercero = intval($_POST['cod_tercero']); } else { $cod_tercero = ""; } 
	if (isset($_POST['cod_tipo_forma_pago'])) { $cod_tipo_forma_pago = intval($_POST['cod_tipo_forma_pago']); } else { $cod_tipo_forma_pago = ""; } 
	if (isset($_POST['descripcion_tipo_forma_pago'])) { $descripcion_tipo_forma_pago = addslashes($_POST['descripcion_tipo_forma_pago']); } else { $descripcion_tipo_forma_pago = ""; } 
	if (isset($_POST['cod_movimiento_contable_cuenta_personal_entrada'])) { $cod_movimiento_contable_cuenta_personal_entrada = intval($_POST['cod_movimiento_contable_cuenta_personal_entrada']); } else { $cod_movimiento_contable_cuenta_personal_entrada = "0"; } 
	if (isset($_POST['cod_movimiento_contable_cuenta_personal_salida'])) { $cod_movimiento_contable_cuenta_personal_salida = intval($_POST['cod_movimiento_contable_cuenta_personal_salida']); } else { $cod_movimiento_contable_cuenta_personal_salida = "0"; } 
	if (isset($_POST['cod_dependencia'])) { $cod_dependencia = intval($_POST['cod_dependencia']); } else { $cod_dependencia = "0"; } 
	if (isset($_POST['nombre_ccosto'])) { $nombre_ccosto = addslashes($_POST['nombre_ccosto']); } else { $nombre_ccosto = ""; } 
	if (isset($_POST['cod_tipo_pago']) <> '') { $cod_tipo_pago = intval($_POST['cod_tipo_pago']); } else { $cod_tipo_pago = '1'; }

	$pagina                                     = addslashes($_POST['pagina']);
	$fecha_seg                                  = strtotime($fecha_ymd.' '.date('H:i:s'));
	$fecha_anyo                                 = date("Y-m-d", $fecha_seg);
	$fecha_mes                                  = date("Y-m", $fecha_seg);
	$anyo                                       = date("Y", $fecha_seg);
	$ip                                         = $_SERVER["REMOTE_ADDR"];
	$cuenta                                     = $cuenta_actual;
	$total_costo_movimiento_contable_smrt       = 0;
	$nombre_estado_factura                      = 'CERRADA';
	$fecha_movimiento_contable_cuenta_personal  = date("Y-m-d");
	$fecha_hora                                 = date("H:i:s", $fecha_seg);

	$obtener_info_cliente = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
	$resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
	$info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

	$nit_cliente                                = $info_cliente['identificacion_tercero'];
	$nombres_clientes                           = $info_cliente['nombre1_tercero'].' '.$info_cliente['apellido1_tercero'];
	$digito                                     = $info_cliente['digito_tercero'];

	$sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable 
	WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
	$consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
	$info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

	$cod_guia                                   = $info_guia_movimiento['cod_guia']+1;

	foreach ($_POST["cod_movimiento_contable_temporal_concepto"] as $clave => $cod_movimiento_contable_temporal_concepto) { 

		$und_vendida                            = $_POST["und_vendida"][$clave];
		$codigo_puc                             = $_POST["codigo_puc"][$clave];
		$nombre_puc                             = $_POST["nombre_puc"][$clave];
		$costo_movimiento_contable              = $_POST["costo_movimiento_contable"][$clave];
		$total_costo_movimiento_contable        = $und_vendida * $costo_movimiento_contable;
		$comentario                             = $_POST["comentario"][$clave];

		$obtener_info_cod_nota_credit = "SELECT * FROM tbl15_movimiento_contable_temporal_concepto WHERE cod_movimiento_contable_temporal_concepto = '$cod_movimiento_contable_temporal_concepto'";
		$resultado_info_cod_nota_credit = mysqli_query($conectar, $obtener_info_cod_nota_credit) or die(mysqli_error($conectar));
		$info_cod_nota_credit = mysqli_fetch_assoc($resultado_info_cod_nota_credit);

		$cod_puc                                = $info_cod_nota_credit['cod_puc'];
		$nombre_tipo_movimiento                 = $info_cod_nota_credit['nombre_tipo_movimiento'];
		$tipo_puc                               = $info_cod_nota_credit['tipo_puc'];
		$venta_movimiento_contable              = $info_cod_nota_credit['venta_movimiento_contable'];
		$total_venta_movimiento_contable        = $info_cod_nota_credit['total_venta_movimiento_contable'];

		$agreg_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
		venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, fecha_hora)
		VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$fecha_hora')";
		$resultado_ventas = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));

		$sql_cliente = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		$resultado_cliente = mysqli_query($conectar, $sql_cliente);
		$info_cliente = mysqli_fetch_assoc($resultado_cliente);

		$saldo_actual_puc_db                     = $info_cliente['saldo_actual_puc'];

		//if ($saldo_actual_puc_db <> '0') {
			if ($nombre_tipo_movimiento == 'DEBITOS') { 
				$cod_puc_debito                                                  = $cod_puc;
				$total_costo_movimiento_contable_debito                          = $total_costo_movimiento_contable; 
				$total_costo_movimiento_contable_smrt                           += $total_costo_movimiento_contable; 
				$saldo_actual_puc                                                = $saldo_actual_puc_db + $total_costo_movimiento_contable;

				$obtener_info_cod_nota_debit = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal WHERE cod_puc = '$cod_puc_debito'";
				$resultado_info_cod_nota_debit = mysqli_query($conectar, $obtener_info_cod_nota_debit) or die(mysqli_error($conectar));
				$info_cod_nota_debit = mysqli_fetch_assoc($resultado_info_cod_nota_debit);

				$cod_movimiento_contable_cuenta_personal_debit                   = $info_cod_nota_debit['cod_movimiento_contable_cuenta_personal'];
			} elseif ($nombre_tipo_movimiento == 'CREDITOS') { 
				$cod_puc_credito                                                 = $cod_puc;
				$total_costo_movimiento_contable_credito                         = $total_costo_movimiento_contable; 
				$saldo_actual_puc                                                = $saldo_actual_puc_db - $total_costo_movimiento_contable;

				$obtener_info_cod_nota_credit = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal WHERE cod_puc = '$cod_puc_credito'";
				$resultado_info_cod_nota_credit = mysqli_query($conectar, $obtener_info_cod_nota_credit) or die(mysqli_error($conectar));
				$info_cod_nota_credit = mysqli_fetch_assoc($resultado_info_cod_nota_credit);

				$cod_movimiento_contable_cuenta_personal_credit                  = $info_cod_nota_credit['cod_movimiento_contable_cuenta_personal'];
			} else { 
				$saldo_actual_puc                                                = $saldo_actual_puc_db;
			}
		//} else { 
			//$saldo_actual_puc = 0;
		//}
		$agregar_total_nota_credit = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc' WHERE cod_puc = '$cod_puc'";
		$resultado_total_nota_credit = mysqli_query($conectar, $agregar_total_nota_credit) or die(mysqli_error($conectar));

		$sql_elim1  = "DELETE FROM tbl15_movimiento_contable_temporal_concepto WHERE cod_movimiento_contable_temporal_concepto = '$cod_movimiento_contable_temporal_concepto'";
		$Resultado1 = mysqli_query($conectar , $sql_elim1) or die(mysqli_error($conectar));
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------- */
		if ($cod_estado_movimiento_contable_cuenta_personal_global == '1' && $nombre_tipo_documento == 'RECIBO DE CAJA' && $nombre_tipo_movimiento == 'DEBITOS') {

			$nombre_tipo_documento                                 = $nombre_tipo_documento;
			$nombre_estado_factura                                 = 'CERRADA';
			$ip                                                    = $_SERVER["REMOTE_ADDR"];
			$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");

			$nombre_tipo_movimiento 	                           = 'RECIBO DE CAJA';
			//$cod_puc                                               = '';
			//$codigo_puc                                            = '';
			//$nombre_puc                                            = 'RECIBO DE CAJA';
			$tipo_puc                                              = 'INGRESOS';
			$und_vendida                                           = '1';
			$costo_movimiento_contable                             = $total_costo_movimiento_contable_debito;
			$total_costo_movimiento_contable                       = $total_costo_movimiento_contable_debito;

			$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_debit')";
			$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
			$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

			$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
			$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal + $total_costo_movimiento_contable_debito;
			$saldo_actual_puc                                      = $total_costo_movimiento_contable_debito;
			$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
			$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
			$valor_movimiento_contable_cuenta_personal             = $total_costo_movimiento_contable_debito;
			$fecha_ymd_movimiento_caja                             = date("Y-m-d");
			$fecha_mes_movimiento_caja                             = date("Y-m");
			$fecha_anyo_movimiento_caja                            = date("Y");
			$fecha_hora_movimiento_caja                            = date("H:i:s");
			$fecha_seg_movimiento_caja                             = time();
			$fecha_creacion                                        = date("Y-m-d H:i:s");
			$simbolo_tipo_operacion                                = "+";

			$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_debit')";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------- */
		if ($cod_estado_movimiento_contable_cuenta_personal_global == '1' && $nombre_tipo_documento == 'COMPROBANTE DE EGRESO' && $nombre_tipo_movimiento == 'CREDITOS') {

			$nombre_tipo_documento                                 = $nombre_tipo_documento;
			$nombre_estado_factura                                 = 'CERRADA';
			$ip                                                    = $_SERVER["REMOTE_ADDR"];
			$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");
			$comentario                                            = $descripcion_movimiento;

			$nombre_tipo_movimiento 	                           = 'COMPROBANTE DE EGRESO';
			//$cod_puc                                               = '';
			//$codigo_puc                                            = '';
			//$nombre_puc                                            = 'COMPROBANTE DE EGRESO';
			$tipo_puc                                              = 'EGRESOS';
			$und_vendida                                           = '1';
			$costo_movimiento_contable                             = $total_costo_movimiento_contable_credito;
			$total_costo_movimiento_contable                       = $total_costo_movimiento_contable_credito;

			$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_credit')";
			$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
			$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

			$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
			$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal - $total_costo_movimiento_contable_credito;
			$saldo_actual_puc                                      = $total_costo_movimiento_contable_credito;
			$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
			$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
			$valor_movimiento_contable_cuenta_personal             = $total_costo_movimiento_contable_credito;
			$fecha_ymd_movimiento_caja                             = date("Y-m-d");
			$fecha_mes_movimiento_caja                             = date("Y-m");
			$fecha_anyo_movimiento_caja                            = date("Y");
			$fecha_hora_movimiento_caja                            = date("H:i:s");
			$fecha_seg_movimiento_caja                             = time();
			$fecha_creacion                                        = date("Y-m-d H:i:s");
			$simbolo_tipo_operacion                                = "-";

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, nombre_tipo_documento, nombre_tipo_movimiento, 
			nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
			cuenta, comentario, cod_tercero, cod_tipo_forma_pago, simbolo_tipo_operacion, total_saldo, cod_tipo_pago)
			VALUES ('$cod_movimiento_contable_cuenta_personal_credit', '$nombre_tipo_documento', '$nombre_tipo_movimiento', 
			'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
			'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_tipo_pago')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_credit')";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}
/* -------------------------------------------------------------------------------------------------------------------------------------------------------------- */
		if ($cod_estado_movimiento_contable_cuenta_personal_global == '1' && $nombre_tipo_documento == 'MOVIMIENTO INTERNO' && $nombre_tipo_movimiento == 'DEBITOS') {

			$nombre_tipo_documento                                 = $nombre_tipo_documento;
			$nombre_estado_factura                                 = 'CERRADA';
			$ip                                                    = $_SERVER["REMOTE_ADDR"];
			$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");
			$comentario                                            = $descripcion_movimiento;

			$nombre_tipo_movimiento 	                           = 'MOVIMIENTO INTERNO';
			//$cod_puc                                               = '';
			//$codigo_puc                                            = '';
			//$nombre_puc                                            = '';
			$tipo_puc                                              = 'INGRESOS';
			$und_vendida                                           = '1';
			$costo_movimiento_contable                             = $total_costo_movimiento_contable_debito;
			$total_costo_movimiento_contable                       = $total_costo_movimiento_contable_debito;
			$nombre_tipo_cuenta_cobrar_pagar                       = 'PASIVOS';

			$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_debit')";
			$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
			$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

			$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
			$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal + $total_costo_movimiento_contable_debito;
			$saldo_actual_puc                                      = $total_costo_movimiento_contable_debito;
			$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
			$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
			$valor_movimiento_contable_cuenta_personal             = $total_costo_movimiento_contable_debito;
			$fecha_ymd_movimiento_caja                             = date("Y-m-d");
			$fecha_mes_movimiento_caja                             = date("Y-m");
			$fecha_anyo_movimiento_caja                            = date("Y");
			$fecha_hora_movimiento_caja                            = date("H:i:s");
			$fecha_seg_movimiento_caja                             = time();
			$fecha_creacion                                        = date("Y-m-d H:i:s");
			$simbolo_tipo_operacion                                = "+";

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, nombre_tipo_documento, nombre_tipo_movimiento, 
			nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
			cuenta, comentario, cod_tercero, cod_tipo_forma_pago, simbolo_tipo_operacion, total_saldo, cod_tipo_pago, nombre_tipo_cuenta_cobrar_pagar)
			VALUES ('$cod_movimiento_contable_cuenta_personal_debit', '$nombre_tipo_documento', '$nombre_tipo_movimiento', 
			'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
			'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_tipo_pago', '$nombre_tipo_cuenta_cobrar_pagar')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_debit')";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}
		if ($cod_estado_movimiento_contable_cuenta_personal_global == '1' && $nombre_tipo_documento == 'MOVIMIENTO INTERNO' && $nombre_tipo_movimiento == 'CREDITOS') {

			$nombre_tipo_documento                                 = $nombre_tipo_documento;
			$nombre_estado_factura                                 = 'CERRADA';
			$ip                                                    = $_SERVER["REMOTE_ADDR"];
			$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");
			$comentario                                            = $descripcion_movimiento;

			$nombre_tipo_movimiento 	                           = 'MOVIMIENTO INTERNO';
			//$cod_puc                                               = '';
			//$codigo_puc                                            = '';
			//$nombre_puc                                            = '';
			$tipo_puc                                              = 'EGRESOS';
			$und_vendida                                           = '1';
			$costo_movimiento_contable                             = $total_costo_movimiento_contable_credito;
			$total_costo_movimiento_contable                       = $total_costo_movimiento_contable_credito;
			$nombre_tipo_cuenta_cobrar_pagar                       = 'PASIVOS';

			$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_credit')";
			$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
			$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

			$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
			$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal - $total_costo_movimiento_contable_credito;
			$saldo_actual_puc                                      = $total_costo_movimiento_contable_credito;
			$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
			$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
			$valor_movimiento_contable_cuenta_personal             = $total_costo_movimiento_contable_credito;
			$fecha_ymd_movimiento_caja                             = date("Y-m-d");
			$fecha_mes_movimiento_caja                             = date("Y-m");
			$fecha_anyo_movimiento_caja                            = date("Y");
			$fecha_hora_movimiento_caja                            = date("H:i:s");
			$fecha_seg_movimiento_caja                             = time();
			$fecha_creacion                                        = date("Y-m-d H:i:s");
			$simbolo_tipo_operacion                                = "-";

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, nombre_tipo_documento, nombre_tipo_movimiento, 
			nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
			cuenta, comentario, cod_tercero, cod_tipo_forma_pago, simbolo_tipo_operacion, total_saldo, cod_tipo_pago, nombre_tipo_cuenta_cobrar_pagar)
			VALUES ('$cod_movimiento_contable_cuenta_personal_credit', '$nombre_tipo_documento', '$nombre_tipo_movimiento', 
			'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
			'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_tipo_pago', '$nombre_tipo_cuenta_cobrar_pagar')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_credit')";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}
	}
/* ------------------------------------------------------------------------------------------------------------------------------------------------- */
	$agregar_total_nota_credit = "UPDATE tbl15_movimiento_contable SET cod_factura = '$cod_factura', nombre_tipo_documento = '$nombre_tipo_documento', 
	total_costo_movimiento_contable = '$total_costo_movimiento_contable_smrt', total_venta_movimiento_contable = '$total_venta_movimiento_contable', 
	cod_tercero = '$cod_tercero', nombres_clientes = '$nombres_clientes', nit_cliente = '$nit_cliente', digito = '$digito', 
	motivo_modificacion = '$motivo_modificacion', fecha_anyo = '$fecha_anyo', fecha_mes = '$fecha_mes', fecha_seg = '$fecha_seg', fecha_ymd = '$fecha_ymd', 
	anyo = '$anyo', fecha_factura = '$fecha_factura', ip = '$ip', cuenta = '$cuenta', cod_guia = '$cod_guia', nombre_estado_factura = '$nombre_estado_factura', 
	cod_tipo_forma_pago = '$cod_tipo_forma_pago', descripcion_tipo_forma_pago = '$descripcion_tipo_forma_pago', cod_movimiento_contable_cuenta_personal_entrada = '$cod_movimiento_contable_cuenta_personal_entrada', 
	cod_movimiento_contable_cuenta_personal_salida = '$cod_movimiento_contable_cuenta_personal_salida', cod_dependencia = '$cod_dependencia', nombre_ccosto = '$nombre_ccosto', fecha_hora = '$fecha_hora'
	WHERE cod_movimiento_contable = '$cod_movimiento_contable'";
	$resultado_total_nota_credit = mysqli_query($conectar, $agregar_total_nota_credit) or die(mysqli_error($conectar));
/* ------------------------------------------------------------------------------------------------------------------------------------------------- */
	$obtener_info_movimiento_contable_cuenta_personal_salida = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal WHERE cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_salida'";
	$resultado_info_movimiento_contable_cuenta_personal_salida = mysqli_query($conectar, $obtener_info_movimiento_contable_cuenta_personal_salida) or die(mysqli_error($conectar));
	$info_movimiento_contable_cuenta_personal_salida = mysqli_fetch_assoc($resultado_info_movimiento_contable_cuenta_personal_salida);

	$valor_movimiento_contable_cuenta_personal_salida_smrt            = $info_movimiento_contable_cuenta_personal_salida['valor_movimiento_contable_cuenta_personal'];
	$valor_movimiento_contable_cuenta_personal_salida                 = $valor_movimiento_contable_cuenta_personal_salida_smrt - $total_costo_movimiento_contable_smrt;
	$cupo_disponible_movimiento_contable_cuenta_personal_salida       = $valor_movimiento_contable_cuenta_personal_salida_smrt;
	$disponible_avances_movimiento_contable_cuenta_personal_salida    = $valor_movimiento_contable_cuenta_personal_salida;

	$agregar_salida = "UPDATE tbl15_movimiento_contable_cuenta_personal SET valor_movimiento_contable_cuenta_personal = '$valor_movimiento_contable_cuenta_personal_salida', 
	fecha_movimiento_contable_cuenta_personal = '$fecha_movimiento_contable_cuenta_personal', cupo_disponible_movimiento_contable_cuenta_personal = '$cupo_disponible_movimiento_contable_cuenta_personal_salida', 
	disponible_avances_movimiento_contable_cuenta_personal = '$disponible_avances_movimiento_contable_cuenta_personal_salida', cuenta = '$cuenta'
	WHERE cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_salida'";
	$resultado_salida = mysqli_query($conectar, $agregar_salida) or die(mysqli_error($conectar));
/* ------------------------------------------------------------------------------------------------------------------------------------------------- */
	$obtener_info_movimiento_contable_cuenta_personal_entrada = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal WHERE cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_entrada'";
	$resultado_info_movimiento_contable_cuenta_personal_entrada = mysqli_query($conectar, $obtener_info_movimiento_contable_cuenta_personal_entrada) or die(mysqli_error($conectar));
	$info_movimiento_contable_cuenta_personal_entrada = mysqli_fetch_assoc($resultado_info_movimiento_contable_cuenta_personal_entrada);

	$valor_movimiento_contable_cuenta_personal_entrada_smrt           = $info_movimiento_contable_cuenta_personal_entrada['valor_movimiento_contable_cuenta_personal'];
	$valor_movimiento_contable_cuenta_personal_entrada                = $valor_movimiento_contable_cuenta_personal_entrada_smrt + $total_costo_movimiento_contable_smrt;
	$cupo_disponible_movimiento_contable_cuenta_personal_entrada      = $valor_movimiento_contable_cuenta_personal_entrada_smrt;
	$disponible_avances_movimiento_contable_cuenta_personal_entrada   = $valor_movimiento_contable_cuenta_personal_entrada;

	$agregar_entrada = "UPDATE tbl15_movimiento_contable_cuenta_personal SET valor_movimiento_contable_cuenta_personal = '$valor_movimiento_contable_cuenta_personal_entrada', 
	fecha_movimiento_contable_cuenta_personal = '$fecha_movimiento_contable_cuenta_personal', cupo_disponible_movimiento_contable_cuenta_personal = '$cupo_disponible_movimiento_contable_cuenta_personal_entrada', 
	disponible_avances_movimiento_contable_cuenta_personal = '$disponible_avances_movimiento_contable_cuenta_personal_entrada', cuenta = '$cuenta'
	WHERE cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_entrada'";
	$resultado_entrada = mysqli_query($conectar, $agregar_entrada) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
/*
	if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {

		$nombre_tipo_documento                                 = 'RECIBO DE CAJA';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");

		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		$cod_puc                                               = '1473';
		$codigo_puc                                            = '4205';
		$nombre_puc                                            = 'OTRAS VENTAS';
		$tipo_puc                                              = 'INGRESOS';
		$und_vendida                                           = '1';
		$costo_movimiento_contable                             = $total_precio_venta;
		$total_costo_movimiento_contable                       = $total_precio_venta;

		$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
		$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

		$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
		$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal + $total_precio_venta;
		$saldo_actual_puc                                      = $total_precio_venta;
		$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
		$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
		$valor_movimiento_contable_cuenta_personal             = $total_precio_venta;
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

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, 
		nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, 
		fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_tipo_forma_pago, cod_info_factura_venta, 
		simbolo_tipo_operacion, total_saldo)
		VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
		'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_ymd_movimiento_caja', '$fecha_mes_movimiento_caja', 
		'$fecha_seg_movimiento_caja', '$fecha_ymd_movimiento_caja', '$fecha_anyo_movimiento_caja', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$cod_info_factura_venta', 
		'$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	}
*/
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
<?php } ?>