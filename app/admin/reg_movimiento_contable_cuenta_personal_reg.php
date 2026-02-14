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
$cod_administrador                  = ($_SESSION['cod_administrador']);
$pagina_else                        = addslashes($_POST['pagina']);
if (isset($_POST['tipo_modulo']) <> '') { $tipo_modulo = addslashes($_POST['tipo_modulo']); } else { $tipo_modulo = 'NORMAL'; }
if ($tipo_modulo <> 'NORMAL') { $pag_redirect_imprimir = "../admin/lista_movimiento_contable_cuenta_personal.php"; } else { $pag_redirect_imprimir = "../admin/lista_movimiento_contable_cuenta_personal.php"; }
$pagina_redirect = '../admin/lista_movimiento_contable_cuenta_personal.php';

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	if (isset($_POST['cod_movimiento_contable_cuenta_personal']) <> '') { $cod_movimiento_contable_cuenta_personal = intval($_POST['cod_movimiento_contable_cuenta_personal']); } else { $cod_movimiento_contable_cuenta_personal = ''; }
	if (isset($_POST['cod_concepto_movimiento_caja']) <> '') { $cod_concepto_movimiento_caja = intval($_POST['cod_concepto_movimiento_caja']); } else { $cod_concepto_movimiento_caja = ''; }
	if (isset($_POST['costo']) <> '') { $costo = mysqli_real_escape_string($conectar, ($_POST['costo'])); } else { $costo = ''; }
	if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = mysqli_real_escape_string($conectar, ($_POST['cod_tercero'])); } else { $cod_tercero = ''; }
	if (isset($_POST['comentario']) <> '') { $comentario = mysqli_real_escape_string($conectar, ($_POST['comentario'])); } else { $comentario = ''; }
	if (isset($_POST['codigo_puc']) <> '') { $codigo_puc = mysqli_real_escape_string($conectar, ($_POST['codigo_puc'])); } else { $codigo_puc = ''; }
	if (isset($_POST['nombre_puc']) <> '') { $nombre_puc = mysqli_real_escape_string($conectar, ($_POST['nombre_puc'])); } else { $nombre_puc = ''; }
	if (isset($_POST['cod_dependencia']) <> '') { $cod_dependencia = mysqli_real_escape_string($conectar, ($_POST['cod_dependencia'])); } else { $cod_dependencia = ''; }
	if (isset($_POST['nombre_ccosto']) <> '') { $nombre_ccosto = mysqli_real_escape_string($conectar, ($_POST['nombre_ccosto'])); } else { $nombre_ccosto = ''; }
	if (isset($_POST['fecha_dmy']) <> '') { $fecha_dmy = mysqli_real_escape_string($conectar, ($_POST['fecha_dmy'])); } else { $fecha_dmy = ''; }
	if (isset($_POST['cod_tipo_forma_pago']) <> '') { $cod_tipo_forma_pago = mysqli_real_escape_string($conectar, ($_POST['cod_tipo_forma_pago'])); } else { $cod_tipo_forma_pago = ''; }
	if (isset($_POST['cod_cuentas_pagar']) <> '') { $cod_cuentas_pagar = intval($_POST['cod_cuentas_pagar']); } else { $cod_cuentas_pagar = '0'; }
	if (isset($_POST['nombre_cuenta_pagar']) <> '') { $nombre_cuenta_pagar = mysqli_real_escape_string($conectar, ($_POST['nombre_cuenta_pagar'])); } else { $nombre_cuenta_pagar = ''; }
	if (isset($_POST['cod_tipo_pago']) <> '') { $cod_tipo_pago = intval($_POST['cod_tipo_pago']); } else { $cod_tipo_pago = '1'; }
	//-------------------------------------- -----------------------------------------------------------------//
	if (($nombre_cuenta_pagar <> '') && ($cod_cuentas_pagar <> '0')) { $nombre_tipo_cuenta_cobrar_pagar = 'CUENTA_PAGAR'; } else { $nombre_tipo_cuenta_cobrar_pagar    = ''; }
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_info_factura = "SELECT * FROM tbl15_concepto_movimiento_caja WHERE (cod_concepto_movimiento_caja = '$cod_concepto_movimiento_caja')";
	$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
	$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

	$nombre_concepto_movimiento_caja       = $info_info_factura['nombre_concepto_movimiento_caja'];
	$nombre_tipo_puc                       = $info_info_factura['nombre_tipo_puc'];
	$simbolo_tipo_operacion                = $info_info_factura['simbolo_tipo_operacion'];
	$tipo_puc                              = $nombre_tipo_puc;
	$nombre_puc                            = $nombre_concepto_movimiento_caja;

	$fecha_time     	                   = time();
	$fecha_mes_ym	                       = date("Y-m", strtotime($fecha_dmy));
	$anyo		                           = date("Y", strtotime($fecha_dmy));
	$hora	                               = date("H:i:s");
	$cuenta                                = $cuenta_actual;
	$und_vendida                           = 1;
	$costo_movimiento_contable             = $costo;
	$total_costo_movimiento_contable       = $costo;

	$fecha_anyo                            = $fecha_dmy;
	$fecha_mes                             = date("Y-m", strtotime($fecha_dmy));
	$fecha_seg                             = time();
	$fecha_ymd                             = $fecha_dmy;
	$anyo                                  = date("Y", strtotime($fecha_dmy));
	$ip                                    = $_SERVER["REMOTE_ADDR"];
	$fecha_ymd_movimiento_caja             = $fecha_dmy;
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
	WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
	$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
	$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

	$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
	$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal;
	$saldo_actual_puc                                      = $costo;
	$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_egreso'";
	$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
	$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);
	$cod_egreso                                            = $datos_autoincremento_egresos['AUTO_INCREMENT'];
	//-------------------------------------- -----------------------------------------------------------------//
	if ($nombre_tipo_puc == 'INGRESOS') {
		$total_saldo_final                     = $total_saldo + $costo;
		$nombre_tipo_documento                 = 'RECIBO DE CAJA';
		$nombre_tipo_movimiento                = 'DEBITOS';
	} elseif ($nombre_tipo_puc == 'EGRESOS') {
		$total_saldo_final                     = $total_saldo - $costo;
		$nombre_tipo_documento                 = 'COMPROBANTE DE EGRESO';
		$nombre_tipo_movimiento                = 'DEBITOS';

		$agreg = "INSERT INTO tbl15_egreso (cod_concepto_movimiento_caja, nombre_concepto_movimiento_caja, nombre_tipo_puc, simbolo_tipo_operacion, 
		costo, cod_tercero, comentario, codigo_puc, nombre_puc, cod_dependencia, total_saldo, 
		cod_tipo_forma_pago, fecha_dmy, fecha_time, fecha_mes_ym, anyo, hora, cuenta, nombre_ccosto, fecha_ymd_movimiento_caja, cod_cuentas_pagar, nombre_cuenta_pagar, nombre_tipo_cuenta_cobrar_pagar) 
		VALUES ('$cod_concepto_movimiento_caja', '$nombre_concepto_movimiento_caja', '$nombre_tipo_puc', '$simbolo_tipo_operacion', 
		'$costo', '$cod_tercero', '$comentario', '$codigo_puc', '$nombre_puc', '$cod_dependencia', '$total_saldo',  
		'$cod_tipo_forma_pago', '$fecha_dmy', '$fecha_time', '$fecha_mes_ym', '$anyo', '$hora', '$cuenta', '$nombre_ccosto', '$fecha_ymd_movimiento_caja', '$cod_cuentas_pagar', '$nombre_cuenta_pagar', '$nombre_tipo_cuenta_cobrar_pagar')";
		$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
	} elseif ($nombre_tipo_puc == 'PASIVOS') {
		$total_saldo_final                     = $total_saldo - $costo;
		$nombre_tipo_documento                 = 'COMPROBANTE DE EGRESO';
		$nombre_tipo_movimiento                = 'DEBITOS';
	} else {

	}
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo_final', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
	WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
	$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	$sql_autoincremento_movimiento_contable_cuenta_personal_concepto = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable_cuenta_personal_concepto'";
	$exec_autoincremento_movimiento_contable_cuenta_personal_concepto = mysqli_query($conectar, $sql_autoincremento_movimiento_contable_cuenta_personal_concepto) or die(mysqli_error($conectar));
	$datos_autoincremento_movimiento_contable_cuenta_personal_concepto = mysqli_fetch_assoc($exec_autoincremento_movimiento_contable_cuenta_personal_concepto);

	$cod_movimiento_contable_cuenta_personal_concepto        = $datos_autoincremento_movimiento_contable_cuenta_personal_concepto['AUTO_INCREMENT'];

	$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, nombre_tipo_documento, nombre_tipo_movimiento, 
	nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
	cuenta, comentario, cod_tercero, cod_tipo_forma_pago, simbolo_tipo_operacion, total_saldo, cod_egreso, cod_tipo_pago)
	VALUES ('$cod_movimiento_contable_cuenta_personal', '$nombre_tipo_documento', '$nombre_tipo_movimiento', 
	'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
	'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_egreso', '$cod_tipo_pago')";
	$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- -----------------------------------------------------------------//
	if (($nombre_cuenta_pagar <> '') && ($cod_cuentas_pagar <> '0')) {

		$nombre_tipo_cuenta_cobrar_pagar = 'CUENTA_PAGAR';
		$abonado                         = $costo;
		$mensaje                         = $comentario.' | MOV CAJA';
		$fecha_pago                      = $fecha_dmy;

		$fecha_anyo                      = date("Y-m-d", strtotime($fecha_pago));
		$fecha_mes                       = date("Y-m", strtotime($fecha_pago));
		$anyo                            = date("Y", strtotime($fecha_pago));
		$fecha_invert                    = date("Y-m-d", strtotime($fecha_pago));
		$fecha_seg                       = strtotime($fecha_pago);
		$hora                            = date("H:i:s");

		$sql_autoincremento_cuentas_pagar_abonos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_pagar_abonos'";
		$exec_autoincremento_cuentas_pagar_abonos = mysqli_query($conectar, $sql_autoincremento_cuentas_pagar_abonos) or die(mysqli_error($conectar));
		$datos_autoincremento_cuentas_pagar_abonos = mysqli_fetch_assoc($exec_autoincremento_cuentas_pagar_abonos);

		$cod_cuentas_pagar_abonos        = $datos_autoincremento_cuentas_pagar_abonos['AUTO_INCREMENT'];

		$sql_info_cuentas_pagar = "SELECT * FROM tbl15_cuentas_pagar WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')";
		$resultado_info_cuentas_pagar = mysqli_query($conectar, $sql_info_cuentas_pagar) or die(mysqli_error($conectar));
		$info_info_cuentas_pagar = mysqli_fetch_assoc($resultado_info_cuentas_pagar);

		$cod_factura                      = $info_info_cuentas_pagar['cod_factura'];
		$cod_tercero                      = $info_info_cuentas_pagar['cod_tercero'];
	//-------------------------------------- -----------------------------------------------------------------//
	//-------------------------------------- REGISTRAR DATOS --------------------------------------//
		$agregar_reg_cuentas_pagar_abonos = "INSERT INTO tbl15_cuentas_pagar_abonos (cod_tercero, cod_factura, abonado, cuenta, fecha_pago, fecha_anyo, fecha_mes, 
		anyo, fecha_invert, fecha_seg, hora, mensaje, cod_administrador, cod_tipo_forma_pago, cod_cuentas_pagar) 
		VALUES ('$cod_tercero', '$cod_factura', '$abonado', '$cuenta_actual', '$fecha_pago', '$fecha_anyo', '$fecha_mes', 
		'$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$mensaje', '$cod_administrador', '$cod_tipo_forma_pago', '$cod_cuentas_pagar')";
		$resultado_cuentas_pagar_abonos = mysqli_query($conectar, $agregar_reg_cuentas_pagar_abonos) or die(mysqli_error($conectar));
		//-------------------------------------- REGISTRAR DATOS --------------------------------------//
		$sql_cuenta_pagar_factura = "SELECT monto_deuda FROM tbl15_cuentas_pagar WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'";
		$consulta_cuenta_pagar_factura = mysqli_query($conectar, $sql_cuenta_pagar_factura) or die(mysqli_error($conectar));
		$dato_cuenta_pagar_factura = mysqli_fetch_assoc($consulta_cuenta_pagar_factura);

		$sql_total_abono_factura = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_pagar_abonos WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'";
		$consulta_total_abono_factura = mysqli_query($conectar, $sql_total_abono_factura) or die(mysqli_error($conectar));
		$total_abono_factura = mysqli_fetch_assoc($consulta_total_abono_factura);

		$monto_deuda             = $dato_cuenta_pagar_factura['monto_deuda'];
		$abonado_total           = $total_abono_factura['abonado'];
		$subtotal                = $monto_deuda - $abonado_total;

		$actualizar_sql1 = sprintf("UPDATE tbl15_cuentas_pagar SET abonado = '$abonado_total', subtotal = '$subtotal' WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'");
		$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/opcion_imprimir_movimiento_contable_cuenta_personal.php?cod_movimiento_contable_cuenta_personal_concepto=<?php echo $cod_movimiento_contable_cuenta_personal_concepto ?>&pagina_redirect=<?php echo $pagina_redirect ?>&pagina=<?php echo $pagina_else ?>">
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