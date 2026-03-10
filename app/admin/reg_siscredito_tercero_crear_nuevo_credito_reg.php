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

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	$cod_tercero                                              = intval($_POST['cod_tercero']);
	$cod_cliente                                              = $cod_tercero;
	$cod_entidad_crediticia                                   = intval($_POST['cod_entidad_crediticia']);
	$cod_lider                                                = intval($_POST['cod_lider']);
	$cod_coordinador                                          = intval($_POST['cod_coordinador']);
	$cod_asesor                                               = intval($_POST['cod_asesor']);
	$cod_vendedor                                             = intval($_POST['cod_vendedor']);
	$cod_proveedor                                            = intval($_POST['cod_proveedor']);
	$cod_aliado_estrategico                                   = intval($_POST['cod_aliado_estrategico']);
	$monto_deuda_sin_interes                                  = addslashes($_POST['monto_deuda_sin_interes']);
	$monto_deuda_mas_interes                                  = addslashes($_POST['monto_deuda_mas_interes']);
	$nombre_producto                                          = addslashes($_POST['nombre_producto']);
	$fecha_pago                                               = addslashes($_POST['fecha_pago']);
	$monto_deuda                                              = $monto_deuda_mas_interes;
	$total_pendiente                                          = $monto_deuda_mas_interes;
	$total_valor_venta                                        = $monto_deuda_sin_interes;
	$total_valor_recibir                                      = $monto_deuda_mas_interes;
	$total                                                    = $monto_deuda_mas_interes;
	$fecha_pago_periodo_orig                                  = $fecha_pago;
	$fecha_reg                                                = $fecha_pago;
	if (isset($_POST['cod_factura']) <> '') { $cod_factura = addslashes($_POST['cod_factura']); } else { $cod_factura = ''; }
	if (isset($_POST['cod_tipo_forma_pago']) <> '') { $cod_tipo_forma_pago = intval($_POST['cod_tipo_forma_pago']); } else { $cod_tipo_forma_pago = '0'; }
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	if (isset($_POST['mensaje']) <> '') { $mensaje = addslashes($_POST['mensaje']); } else { $mensaje = ''; }
//-------------------------------------- -----------------------------------------------------------------//
	$cod_administrador                                        = ($_SESSION['cod_administrador']);
	$fecha_anyo                                               = $fecha_pago;
	$fecha_seg       	                                      = time();
	$fecha_mes	                                              = date("Y-m", strtotime($fecha_pago));
	$anyo		                                              = date("Y", strtotime($fecha_pago));
	$fecha	                                                  = $fecha_pago;
	$fecha_invert	                                          = $fecha_pago;
	$hora	                                                  = date("H:i:s");
	$cuenta                                                   = $cuenta_actual;
	$vendedor                                                 = $cuenta_actual;
	$subtotal                                                 = $monto_deuda;
	$abonado                                                  = 0;
	$cod_estado_cuenta_cobrar                                 = 1;
	$fecha_modificacion_cuenta_cobrar                         = date("Y-m-d H:i:s");
	$fecha_factura                                            = $fecha_pago;
	$tipo_soporte                                             = "CUENTA_COBRAR";
	$cod_tipo_nota_observacion                                = 16;
	$cod_dependencia                                          = 1;
	$nombre_ccosto                                            = 'PERSONAL';
//-------------------------------------- -----------------------------------------------------------------//
	$cliente                                                  = "";
	$fecha_ymd                                                = $fecha_pago;
	$fecha_anyo_seg                                           = strtotime($fecha_anyo);
	$fecha_dia                                                = date("Y-m-d", $fecha_anyo_seg);
	$fecha_hora_venta_producto                                = date("H:i:s");
	$comentario                                               = $mensaje;
/* ----------------------------------------------------------------------------------------------------------/ */
	$time                                                     = time();
	$fecha_ymdHis                                             = date("YmdHis");
	$formato                                                  = 'jpg';
	$fecha_hora                                               = date("H:i:s");
	$fecha_ymd                                                = date("Y-m-d");
	$fecha_creacion                                           = date("Y-m-d");

	$ruta_firma_miniatura                                     = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura                                      = '../archivador/foto/miniatura/';
	$ruta_firma_orig                                          = '../archivador/firma/original/';
	$ruta_foto_orig                                           = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
		$formato_img2                                         = explode(".", $url_img1);
		$formato_img2                                         = end($formato_img2);
		$nombre_normal2                                       = $tipo_soporte.'_'.$fecha_ymdHis.'_'.$cod_cuentas_cobrar.'_'.$cod_tercero.'_'.$cod_administrador.'.'.$formato_img2;
		$url_img_orig_producto                                = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto                                 = $ruta_foto_orig.$nombre_normal2;
	} else { 
		$formato_img2                                         = "";
		$formato_img2                                         = "";
		$nombre_normal2                                       = "";
		$url_img_orig_producto                                = "";
		$url_img_min_producto                                 = "";
	}
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_cuentas_cobrar = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar'";
	$exec_autoincremento_cuentas_cobrar = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_cobrar = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar);

	$cod_cuentas_cobrar                                       = $datos_autoincremento_cuentas_cobrar['AUTO_INCREMENT'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_data = "INSERT INTO tbl15_cuentas_cobrar (cod_cuentas_cobrar, cod_factura, cod_tipo_forma_pago, monto_deuda, subtotal, abonado, total_pendiente, total_valor_venta, monto_deuda_mas_interes, 
	total_valor_recibir, total, vendedor, cuenta, mensaje, nombre_producto, 
	cod_tercero, cod_cliente, cod_entidad_crediticia, cod_lider, cod_coordinador, cod_asesor, cod_vendedor, cod_proveedor, cod_aliado_estrategico, monto_deuda_sin_interes, 
	fecha_pago, fecha_pago_periodo_orig, fecha_reg, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, url_img_orig_producto, cod_intermediario_credito) 
	VALUES ('$cod_cuentas_cobrar', '$cod_factura', '$cod_tipo_forma_pago', '$monto_deuda', '$subtotal', '$abonado', '$total_pendiente', '$total_valor_venta', '$monto_deuda_mas_interes',
	'$total_valor_recibir', '$total', '$vendedor', '$cuenta', '$mensaje', '$nombre_producto', 
	'$cod_tercero', '$cod_cliente', '$cod_entidad_crediticia', '$cod_lider', '$cod_coordinador', '$cod_asesor', '$cod_vendedor', '$cod_proveedor', '$cod_aliado_estrategico', '$monto_deuda_sin_interes', 
	'$fecha_pago', '$fecha_pago_periodo_orig', '$fecha_reg', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$url_img_orig_producto', '1')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
	FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

	$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_datos_cuentas_cobrar_abonos);
	$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_cobrar_abonos);

	$total_abonado_cuenta_cobrar           = $datos_cuentas_cobrar_abonos['total_abonado_cuenta_cobrar'];
	$total_subtotal_cuenta_cobrar          = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar;
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
	total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto); }
	?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_cuentas_cobrar_directa_no_por_factura_sistecredito.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar?>">
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