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

	if (isset($_POST['cod_factura']) <> '') { $cod_factura = mysqli_real_escape_string($conectar, ($_POST['cod_factura'])); } else { $cod_factura = ''; }
	if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = mysqli_real_escape_string($conectar, ($_POST['cod_tercero'])); } else { $cod_tercero = ''; }
	if (isset($_POST['monto_deuda']) <> '') { $monto_deuda = mysqli_real_escape_string($conectar, ($_POST['monto_deuda'])); } else { $monto_deuda = ''; }
	if (isset($_POST['fecha']) <> '') { $fecha = mysqli_real_escape_string($conectar, ($_POST['fecha'])); } else { $fecha = ''; }
	if (isset($_POST['fecha_pago']) <> '') { $fecha_pago = mysqli_real_escape_string($conectar, ($_POST['fecha_pago'])); } else { $fecha_pago = ''; }
	if (isset($_POST['cod_info_factura_compra']) <> '') { $cod_info_factura_compra = intval($_POST['cod_info_factura_compra']); } else { $cod_info_factura_compra = '0'; }

	$mensaje                         = 'CREADO MANUALMENTE';
	$fecha_seg       	             = time();
	$fecha_mes	                     = date("Y-m", strtotime($fecha));
	$anyo		                     = date("Y", strtotime($fecha));
	$fecha	                         = $fecha;
	$fecha_invert	                 = $fecha;
	$hora	                         = date("H:i:s");
	$cuenta                          = $cuenta_actual;
	$vendedor                        = $cuenta_actual;
	$subtotal                        = $monto_deuda;
	$abonado                         = 0;
	$fecha_hora                      = date("H:i:s");
	$nombre_origen_cargue            = "CARGUE_FACTURA_COMPRA_MANUAL";

	$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_pagar'";
	$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
	$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

	$cod_cuentas_pagar  = $datos_autoincremento_egresos['AUTO_INCREMENT'];

	$agreg = "INSERT INTO tbl15_cuentas_pagar (cod_cuentas_pagar, cod_factura, cod_tercero, monto_deuda, subtotal, abonado, vendedor, cuenta, 
	fecha_pago, fecha, fecha_invert, fecha_seg, fecha_hora, nombre_origen_cargue, mensaje, cod_info_factura_compra) 
	VALUES ('$cod_cuentas_pagar', '$cod_factura', '$cod_tercero', '$monto_deuda', '$subtotal', '$abonado', '$vendedor', '$cuenta', 
	'$fecha_pago', '$fecha', '$fecha_invert', '$fecha_seg', '$fecha_hora', '$nombre_origen_cargue', '$mensaje', '$cod_info_factura_compra')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/cuentas_pagar_detalle_factura.php?cod_tercero=<?php echo $cod_tercero ?>&pagina=<?php echo $pagina_else ?>">
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