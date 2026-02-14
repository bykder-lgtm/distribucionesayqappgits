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
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

	if (isset($_POST['cod_cuentas_cobrar']) <> '') { $cod_cuentas_cobrar = intval($_POST['cod_cuentas_cobrar']); } else { $cod_cuentas_cobrar = ''; }
	if (isset($_POST['nombre_tipo_cobro']) <> '') { $nombre_tipo_cobro = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_cobro'])); } else { $nombre_tipo_cobro = ''; }
	if (isset($_POST['numero_cuota']) <> '') { $numero_cuota = intval($_POST['numero_cuota']); } else { $numero_cuota = ''; }
	if (isset($_POST['cod_tipo_moneda']) <> '') { $cod_tipo_moneda = intval($_POST['cod_tipo_moneda']); } else { $cod_tipo_moneda = ''; }
	if (isset($_POST['monto_deuda_sin_interes_hidden']) <> '') { $monto_deuda_sin_interes = mysqli_real_escape_string($conectar, ($_POST['monto_deuda_sin_interes_hidden'])); } else { $monto_deuda_sin_interes = '0'; }
	if (isset($_POST['fecha_pago']) <> '') { $fecha_pago = mysqli_real_escape_string($conectar, ($_POST['fecha_pago'])); } else { $fecha_pago = ''; }
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }

	if (isset($_POST['cod_factura']) <> '') { $cod_factura = mysqli_real_escape_string($conectar, ($_POST['cod_factura'])); } else { $cod_factura = '0'; }
	if (isset($_POST['interes_ptj']) <> '') { $interes_ptj = mysqli_real_escape_string($conectar, ($_POST['interes_ptj'])); } else { $interes_ptj = '0'; }
	if (isset($_POST['monto_deuda_sin_interes_hidden']) <> '') { $monto_deuda_sin_interes_libre = mysqli_real_escape_string($conectar, ($_POST['monto_deuda_sin_interes_hidden'])); } else { $monto_deuda_sin_interes_libre = '0'; }
	if (isset($_POST['cod_renovacion_contrato']) <> '') { $cod_renovacion_contrato = mysqli_real_escape_string($conectar, ($_POST['cod_renovacion_contrato'])); } else { $cod_renovacion_contrato = '0'; }
	if (isset($_POST['pagina']) <> '') { $pagina = addslashes($_POST['pagina']); } else { $pagina = ''; }
	if (isset($_POST['deduccion_retefuente']) <> '') { $deduccion_retefuente = intval($_POST['deduccion_retefuente']); } else { $deduccion_retefuente = ''; }
	if (isset($_POST['deduccion_otro_concepto']) <> '') { $deduccion_otro_concepto = intval($_POST['deduccion_otro_concepto']); } else { $deduccion_otro_concepto = ''; }
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_total_facturas = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
	$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
	$total_facturas = mysqli_num_rows($consulta_total_facturas);
	$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

	$cod_factura                     = $datos_total_facturas['cod_factura'];
	$cod_tercero                     = $datos_total_facturas['cod_tercero'];
	$cod_producto                    = $datos_total_facturas['cod_producto'];
	$cod_producto_barra              = $datos_total_facturas['cod_producto_barra'];
	$nombre_producto                 = $datos_total_facturas['nombre_producto'];
	$cod_tercero_propietario         = $datos_total_facturas['cod_tercero_propietario'];
	$deduccion_saldo_favor           = $datos_total_facturas['deduccion_saldo_favor'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_propietario_inmueble = "SELECT cod_tercero, dia_pago_propietario_inmueble, nombre_tipo_cobro_propietario_inmueble FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
	$consulta_propietario_inmueble = mysqli_query($conectar, $sql_propietario_inmueble);
	$datos_propietario_inmueble = mysqli_fetch_assoc($consulta_propietario_inmueble);

	//$cod_tercero_propietario                    = $datos_propietario_inmueble['cod_tercero'];
	$dia_pago_propietario_inmueble              = $datos_propietario_inmueble['dia_pago_propietario_inmueble'];
	$nombre_tipo_cobro_propietario_inmueble     = $datos_propietario_inmueble['nombre_tipo_cobro_propietario_inmueble'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar'";
	$exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
	$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);

	$cod_cuentas_cobrar_incre        = $datos_autoincremento_sesion['AUTO_INCREMENT'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$cuenta                          = $cuenta_actual;
	$vendedor                        = $cuenta_actual;
	$fecha_seg       	             = time();
	$fecha_mes	                     = date("Y-m", strtotime($fecha_pago));
	$anyo		                     = date("Y", strtotime($fecha_pago));
	$fecha	                         = $fecha_pago;
	$fecha_invert	                 = $fecha_pago;
	$hora	                         = date("H:i:s");
	$cod_tipo_forma_pago             = 0;
	$mensaje                         = '';
	$url_img_orig_producto           = '';
	$url_img_min_producto            = '';
	$clausula_alquiler               = '';
	$cod_estado_contrato             = 0;
	$cod_estado                      = 0;
	$cod_estado_inmueble             = 0;
	/* ----------------------------------------------------------------------------------------------------------/ */
	$monto_deuda                     = $monto_deuda_sin_interes;
	$subtotal                        = $monto_deuda_sin_interes;
	$subtotal_sin_interes            = $monto_deuda_sin_interes;
	$monto_cuota                     = $monto_deuda_sin_interes;
	$monto_cuota_sin_interes         = $monto_deuda_sin_interes;
	$monto_cuota_interes             = $monto_deuda_sin_interes;
	$total_pendiente                 = $monto_deuda_sin_interes;
	$total_pagar                     = $monto_deuda_sin_interes;
	$abonado                         = 0;
	/* ----------------------------------------------------------------------------------------------------------/ */
	$time                            = time();
	$fecha_ymdHis                    = date("YmdHis");
	$formato                         = 'jpg';
	$fecha_hora                      = date("H:i:s");
	$fecha_ymd                       = date("Y-m-d");
	/* ----------------------------------------------------------------------------------------------------------/ */
	$ruta_firma_miniatura            = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura             = '../archivador/foto/miniatura/';
	$ruta_firma_orig                 = '../archivador/firma/original/';
	$ruta_foto_orig                  = '../archivador/documentos/';
	/* ----------------------------------------------------------------------------------------------------------/ */
	if ($nombre_tipo_cobro == 'DIARIO') { 
		$tipo_cobro                     = 'day';
		$numero_alerta                  = 0;
		$numero_alerta_correcion        = 0;
	} elseif ($nombre_tipo_cobro == 'SEMANAL') {
		$tipo_cobro                     = 'week';
		$numero_alerta                  = 0;
		$numero_alerta_correcion        = 0;
	} elseif ($nombre_tipo_cobro == 'QUINCENAL') {
		$tipo_cobro                     = 'week';
		$numero_alerta                  = 0;
		$numero_alerta_correcion        = 0;
	} elseif ($nombre_tipo_cobro == 'MES VENCIDO') {
		$tipo_cobro                     = 'month';
		$numero_alerta                  = 0;
		$numero_alerta_correcion        = 0;
	} elseif ($nombre_tipo_cobro == 'MES ANTICIPADO') {
		$tipo_cobro                     = 'month';
		$numero_alerta                  = 0;
		$numero_alerta_correcion        = -1;
	} else {
		$tipo_cobro                     = 'year';
		$numero_alerta                  = 0;
		$numero_alerta_correcion        = 0;
	}

	if ($url_img1 <> '') { 
		$formato_img2                    = explode(".", $url_img1);
		$formato_img2                    = end($formato_img2);
		$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_cuentas_cobrar_incre.'_'.$cod_tercero.'.'.$formato_img2;
		$url_img_orig_producto           = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto            = $ruta_foto_orig.$nombre_normal2;
	} else { 
		$formato_img2                    = "";
		$formato_img2                    = "";
		$nombre_normal2                  = "";
		$url_img_orig_producto           = "";
		$url_img_min_producto            = "";
	}
	/* ----------------------------------------------------------------------------------------------------------/ */
	$monto_deuda_sin_interes        = ($monto_deuda_sin_interes + ($monto_deuda_sin_interes * ($interes_ptj/100))) * $numero_cuota;
	$usuario_elim                   = $cuenta_actual;
	$cod_estado_renovacio_contrato  = 1;
	/* ----------------------------------------------------------------------------------------------------------/ */
	/* ----------------------------------------------------------------------------------------------------------/ */
	$agreg = "INSERT INTO tbl15_cuentas_cobrar (cod_cuentas_cobrar, cod_tercero, monto_deuda_sin_interes, numero_cuota, interes_ptj, nombre_tipo_cobro, fecha_pago, 
	monto_deuda, subtotal, subtotal_sin_interes, monto_cuota, monto_cuota_sin_interes, monto_cuota_interes, vendedor, 
	cuenta, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, abonado, cod_factura, cod_tipo_forma_pago, mensaje, url_img_orig_producto, 
	url_img_min_producto, cod_administrador, cod_tipo_moneda, clausula_alquiler, cod_producto, cod_producto_barra, nombre_producto, cod_estado_contrato, 
	cod_renovacion_contrato, cod_tercero_propietario, deduccion_saldo_favor) 
	VALUES ('$cod_cuentas_cobrar_incre', '$cod_tercero', '$monto_deuda_sin_interes', '$numero_cuota', '$interes_ptj', '$nombre_tipo_cobro', '$fecha_pago', 
	'$monto_deuda', '$subtotal', '$subtotal_sin_interes', '$monto_cuota', '$monto_cuota_sin_interes', '$monto_cuota_interes', '$vendedor', 
	'$cuenta', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$abonado', '$cod_factura', '$cod_tipo_forma_pago', '$mensaje', '$url_img_orig_producto', 
	'$url_img_min_producto', '$cod_administrador', '$cod_tipo_moneda', '$clausula_alquiler', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$cod_estado_contrato', 
	'$cod_renovacion_contrato', '$cod_tercero_propietario', '$deduccion_saldo_favor')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
	/* ----------------------------------------------------------------------------------------------------------/ */
	$data_sql = ("UPDATE tbl15_cuentas_cobrar_alerta SET cod_estado_renovacio_contrato = '$cod_estado_renovacio_contrato' WHERE cod_factura = '$cod_factura'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
	/* ----------------------------------------------------------------------------------------------------------/ */
	$monto_deuda_sin_interes        = ($monto_deuda_sin_interes_libre + ($monto_deuda_sin_interes_libre * ($interes_ptj/100)));
	$monto_deuda                    = ($monto_deuda_sin_interes_libre + ($monto_deuda_sin_interes_libre * ($interes_ptj/100)));
	$subtotal                       = $monto_deuda;	
	$subtotal_sin_interes           = $monto_deuda;
	$monto_cuota 	                = $monto_deuda;
	$monto_cuota_sin_interes 	    = $monto_deuda;
	$monto_cuota_interes            = ($monto_deuda * ($interes_ptj/100));
	/* ----------------------------------------------------------------------------------------------------------/ */
	for ($contador=0; $contador < $numero_cuota ; $contador++) { 

		$numero_alerta++;
		$numero_alerta_correcion++;
		$dia_corte_pago                 = date("d", strtotime($fecha_pago));
		$mes_corte_pago                 = date("m", strtotime($fecha_pago));
		$anyo_corte_pago                = date("Y", strtotime($fecha_pago));
	    $fecha_pago_modif               = $anyo_corte_pago.'-'.$mes_corte_pago.'-'.'01';
	    $fecha_mes_pago_modif           = $anyo_corte_pago.'-'.$mes_corte_pago;
	    $fecha_mes_modif                = date('Y-m-d', strtotime($fecha_pago_modif.'+'.$numero_alerta_correcion.' '.$tipo_cobro));
	    $fecha_mes_real                 = date("Y-m", strtotime($fecha_mes_modif));

		$fecha_pago_alerta_datetime     = DateTime::createFromFormat('Y-m-d', $fecha_mes_modif); //(1) aquí se pone el formato que tiene el dato original
		$ultimo_del_dia	                = $fecha_pago_alerta_datetime->format('t');

		if ($dia_corte_pago > $ultimo_del_dia) { 
			$fecha_pago_alerta              = $fecha_mes_real.'-'.$ultimo_del_dia;
			$fecha_mes	                    = date("Y-m", strtotime($fecha_pago_alerta));
			$anyo	                        = date("Y", strtotime($fecha_pago_alerta));
			$fecha_pago_periodo_orig        = $fecha_pago_alerta;
		} else { 
			$fecha_pago_alerta              = $fecha_mes_real.'-'.$dia_corte_pago;
			$fecha_mes	                    = date("Y-m", strtotime($fecha_pago_alerta));
			$anyo	                        = date("Y", strtotime($fecha_pago_alerta));
			$fecha_pago_periodo_orig        = $fecha_pago_alerta;
		}
		$dia_pago_propietario                              = date("d", strtotime($dia_pago_propietario_inmueble));
		$fecha_alerta_mes                                  = date('Y-m-d', strtotime($fecha_pago_periodo_orig.'+1 month'));

		if ($nombre_tipo_cobro_propietario_inmueble == 'MES VENCIDO') { $fecha_alerta_pago_comision_prop = date('Y-m', strtotime($fecha_alerta_mes)).'-'.$dia_pago_propietario; } else { $fecha_alerta_pago_comision_prop = $fecha_pago_periodo_orig; }

		$agreg_alerta = "INSERT INTO tbl15_cuentas_cobrar_alerta (cod_cuentas_cobrar, numero_alerta, cod_tercero, monto_deuda_sin_interes, 
		numero_cuota, interes_ptj, nombre_tipo_cobro, fecha_pago, monto_deuda, subtotal, subtotal_sin_interes, monto_cuota, monto_cuota_sin_interes, 
		monto_cuota_interes, vendedor, cuenta, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, abonado, cod_factura, cod_administrador, cod_tipo_moneda, 
		cod_producto, cod_producto_barra, nombre_producto, cod_estado, cod_renovacion_contrato, deduccion_retefuente, deduccion_otro_concepto, 
		total_pagar, total_pendiente, cod_tercero_propietario, fecha_pago_periodo_orig, fecha_alerta_pago_comision_prop) 
		VALUES ('$cod_cuentas_cobrar_incre', '$numero_alerta', '$cod_tercero', '$monto_deuda_sin_interes', '$numero_cuota', 
		'$interes_ptj', '$nombre_tipo_cobro', '$fecha_pago_alerta', '$monto_deuda', '$subtotal', '$subtotal_sin_interes', '$monto_cuota', '$monto_cuota_sin_interes', 
		'$monto_cuota_interes', '$vendedor', '$cuenta', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$abonado', '$cod_factura', '$cod_administrador', '$cod_tipo_moneda', 
		'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$cod_estado', '$cod_renovacion_contrato', '$deduccion_retefuente', '$deduccion_otro_concepto', 
		'$total_pagar', '$total_pendiente', '$cod_tercero_propietario', '$fecha_pago_periodo_orig', '$fecha_alerta_pago_comision_prop')";
		$resultado_alerta = mysqli_query($conectar, $agreg_alerta) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
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