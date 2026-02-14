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
	if (isset($_POST['monto_deuda_sin_interes_hidden']) <> '') { $monto_deuda_sin_interes_hidden = mysqli_real_escape_string($conectar, ($_POST['monto_deuda_sin_interes_hidden'])); } else { $monto_deuda_sin_interes = '0'; }
	if (isset($_POST['fecha_pago']) <> '') { $fecha_pago = mysqli_real_escape_string($conectar, ($_POST['fecha_pago'])); } else { $fecha_pago = ''; }
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }

	if (isset($_POST['interes_ptj']) <> '') { $interes_ptj = mysqli_real_escape_string($conectar, ($_POST['interes_ptj'])); } else { $interes_ptj = '0'; }
	if (isset($_POST['monto_deuda_sin_interes_hidden']) <> '') { $monto_deuda_sin_interes_libre = mysqli_real_escape_string($conectar, ($_POST['monto_deuda_sin_interes_hidden'])); } else { $monto_deuda_sin_interes_libre = '0'; }
	if (isset($_POST['deduccion_retefuente_hidden']) <> '') { $deduccion_retefuente = mysqli_real_escape_string($conectar, ($_POST['deduccion_retefuente_hidden'])); } else { $deduccion_retefuente = '0'; }
	if (isset($_POST['deduccion_otro_concepto_hidden']) <> '') { $deduccion_otro_concepto = mysqli_real_escape_string($conectar, ($_POST['deduccion_otro_concepto_hidden'])); } else { $deduccion_otro_concepto = '0'; }
	if (isset($_POST['cod_renovacion_contrato']) <> '') { $cod_renovacion_contrato = intval($_POST['cod_renovacion_contrato']); } else { $cod_renovacion_contrato = ''; }
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_total_facturas = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
	$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
	$total_facturas = mysqli_num_rows($consulta_total_facturas);
	$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

	$cod_factura                                = $datos_total_facturas['cod_factura'];
	$cod_tercero                                = $datos_total_facturas['cod_tercero'];
	$cod_producto                               = $datos_total_facturas['cod_producto'];
	$cod_producto_barra                         = $datos_total_facturas['cod_producto_barra'];
	$nombre_producto                            = $datos_total_facturas['nombre_producto'];
	$cod_tercero_propietario                    = $datos_total_facturas['cod_tercero_propietario'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_propietario_inmueble = "SELECT cod_tercero, dia_pago_propietario_inmueble, nombre_tipo_cobro_propietario_inmueble FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
	$consulta_propietario_inmueble = mysqli_query($conectar, $sql_propietario_inmueble);
	$datos_propietario_inmueble = mysqli_fetch_assoc($consulta_propietario_inmueble);

	//$cod_tercero_propietario                    = $datos_propietario_inmueble['cod_tercero'];
	$dia_pago_propietario_inmueble              = $datos_propietario_inmueble['dia_pago_propietario_inmueble'];
	$nombre_tipo_cobro_propietario_inmueble     = $datos_propietario_inmueble['nombre_tipo_cobro_propietario_inmueble'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$time                                       = time();
	$fecha_ymdHis                               = date("YmdHis");
	$formato                                    = 'jpg';
	$fecha_hora                                 = date("H:i:s");
	$fecha_ymd                                  = date("Y-m-d");
	/* ----------------------------------------------------------------------------------------------------------/ */
	$ruta_firma_miniatura                       = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura                        = '../archivador/foto/miniatura/';
	$ruta_firma_orig                            = '../archivador/firma/original/';
	$ruta_foto_orig                             = '../archivador/documentos/';

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
	/* ----------------------------------------------------------------------------------------------------------/ */
	$monto_deuda                    = $monto_deuda_sin_interes_hidden;
	$subtotal                       = $monto_deuda_sin_interes_hidden;	
	$subtotal_sin_interes           = $monto_deuda_sin_interes_hidden;
	$monto_cuota 	                = $monto_deuda_sin_interes_libre;
	$monto_cuota_sin_interes 	    = $monto_deuda_sin_interes_libre;
	$total_pendiente 	            = $monto_deuda_sin_interes_libre;
	$total_pagar 	                = $monto_deuda_sin_interes_libre;
	$monto_cuota_interes            = ($monto_deuda_sin_interes_libre * ($interes_ptj/100));
	/* ----------------------------------------------------------------------------------------------------------/ */
	$fecha_seg       	            = time();
	$fecha_mes	                    = date("Y-m", strtotime($fecha_pago));
	$anyo		                    = date("Y", strtotime($fecha_pago));
	$fecha	                        = $fecha_pago;
	$fecha_invert	                = $fecha_pago;
	$hora	                        = date("H:i:s");
	$cuenta                         = $cuenta_actual;
	$vendedor                       = $cuenta_actual;
	$abonado                        = 0;
	$cod_estado_inmueble            = 0;
	$cod_estado                     = 0;
	$cod_estado_contrato            = 0;
	$monto_deuda_sin_interes        = $monto_deuda_sin_interes_libre;
	$usuario_elim                   = $cuenta_actual;
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar SET monto_deuda_sin_interes = '$monto_deuda_sin_interes', numero_cuota = '$numero_cuota', monto_deuda = '$monto_deuda', 
	subtotal = '$subtotal', subtotal_sin_interes = '$subtotal_sin_interes', monto_cuota = '$monto_cuota', monto_cuota_sin_interes = '$monto_cuota_sin_interes', monto_cuota_interes = '$monto_cuota_interes', 
	fecha = '$fecha', fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_invert = '$fecha_invert', fecha_seg = '$fecha_seg', abonado = '$abonado', cod_estado_contrato = '$cod_estado_contrato', 
	cod_renovacion_contrato = '$cod_renovacion_contrato' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	/* ----------------------------------------------------------------------------------------------------------/ */
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_cuentas_cobrar_alerta = "SELECT cod_cuentas_cobrar_alerta FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') ORDER BY numero_alerta ASC";
	$query_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta);
	while ($datos_cuentas_cobrar_alerta = mysqli_fetch_array($query_cuentas_cobrar_alerta)) {

		$numero_alerta++;
		$numero_alerta_correcion++;
		$cod_cuentas_cobrar_alerta      = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar_alerta'];
		$fecha_pago_alerta              = date('Y-m-d', strtotime($fecha_pago.'+'.$numero_alerta_correcion.' '.$tipo_cobro));
		$fecha_mes	                    = date("Y-m", strtotime($fecha_pago_alerta));
		$anyo	                        = date("Y", strtotime($fecha_pago_alerta));
		$fecha_pago_periodo_orig        = $fecha_pago_alerta ;

		$dia_pago_propietario           = date("d", strtotime($dia_pago_propietario_inmueble));
		$fecha_alerta_mes               = date('Y-m-d', strtotime($fecha_pago_periodo_orig.'+1 month'));

		if ($nombre_tipo_cobro_propietario_inmueble == 'MES VENCIDO') { $fecha_alerta_pago_comision_prop = date('Y-m', strtotime($fecha_alerta_mes)).'-'.$dia_pago_propietario; } else { $fecha_alerta_pago_comision_prop = $fecha_pago_periodo_orig; }


		$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_alerta SET monto_deuda_sin_interes = '$monto_deuda_sin_interes', monto_deuda = '$monto_deuda', subtotal = '$subtotal', 
		subtotal_sin_interes = '$subtotal_sin_interes', monto_cuota = '$monto_cuota', monto_cuota_sin_interes = '$monto_cuota_sin_interes', monto_cuota_interes = '$monto_cuota_interes', 
		fecha_pago = '$fecha_pago_alerta', fecha = '$fecha', fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_invert = '$fecha_invert', fecha_seg = '$fecha_seg', abonado = '$abonado', 
		cod_estado = '$cod_estado', cod_renovacion_contrato = '$cod_renovacion_contrato', fecha_pago_periodo_orig = '$fecha_pago_periodo_orig', 
		deduccion_retefuente = '$deduccion_retefuente', deduccion_otro_concepto = '$deduccion_otro_concepto', 
		total_pagar = '$total_pagar', total_pendiente = '$total_pendiente', fecha_alerta_pago_comision_prop = '$fecha_alerta_pago_comision_prop' 
		WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
	/* ----------------------------------------------------------------------------------------------------------/ */
	$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_cobrar_abonos WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/cuentas_cobrar_agrupado_detalle_factura_alquiler.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&cod_factura=<?php echo $cod_factura ?>&pagina=<?php echo $pagina_else ?>">
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