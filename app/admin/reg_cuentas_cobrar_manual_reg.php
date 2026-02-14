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

	$fecha_seg       	                      = time();
	$fecha_mes	                              = date("Y-m", strtotime($fecha));
	$anyo		                              = date("Y", strtotime($fecha));
	$fecha	                                  = $fecha;
	$fecha_invert	                          = $fecha;
	$hora	                                  = date("H:i:s");
	$cuenta                                   = $cuenta_actual;
	$vendedor                                 = $cuenta_actual;
	$subtotal                                 = $monto_deuda;
	$abonado                                  = 0;
	$cod_estado_cuenta_cobrar                 = 1;
	$total_monto_deuda_cuenta_cobrar_nuevo    = $monto_deuda;

	$sql_tercero = "SELECT total_monto_deuda_cuenta_cobrar AS total_monto_deuda_cuenta_cobrar_viejo, total_abonado_cuenta_cobrar AS total_abonado_cuenta_cobrar_viejo FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	$consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
	$matriz_tercero = mysqli_fetch_assoc($consulta_tercero);

	$total_monto_deuda_cuenta_cobrar_viejo    = $matriz_tercero['total_monto_deuda_cuenta_cobrar_viejo'];
	$total_abonado_cuenta_cobrar_viejo        = $matriz_tercero['total_abonado_cuenta_cobrar_viejo'];
	$total_monto_deuda_cuenta_cobrar          = $total_monto_deuda_cuenta_cobrar_viejo + $total_monto_deuda_cuenta_cobrar_nuevo;
	$total_subtotal_cuenta_cobrar             = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar_viejo;

	$sql_datos_permiso_usuario = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (cod_factura = '$cod_factura')";
	$consulta_datos_permiso_usuario = mysqli_query($conectar, $sql_datos_permiso_usuario) or die(mysqli_error($conectar));
	$matriz_datos_permiso_usuario = mysqli_fetch_assoc($consulta_datos_permiso_usuario);

	$cod_info_factura_venta            = $matriz_datos_permiso_usuario['cod_info_factura_venta'];

	$sql_autoincremento_cuentas_cobrar = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar'";
	$exec_autoincremento_cuentas_cobrar = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_cobrar = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar);
	$cod_cuentas_cobrar = $datos_autoincremento_cuentas_cobrar['AUTO_INCREMENT'];

	$sql_data = "UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar' WHERE (cod_tercero = '$cod_tercero')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$agreg = "INSERT INTO tbl15_cuentas_cobrar (cod_cuentas_cobrar, cod_factura, cod_tercero, monto_deuda, subtotal, abonado, vendedor, cuenta, 
	fecha_pago, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_info_factura_venta) 
	VALUES ('$cod_cuentas_cobrar', '$cod_factura', '$cod_tercero', '$monto_deuda', '$subtotal', '$abonado', '$vendedor', '$cuenta', 
	'$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_info_factura_venta')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/cuentas_cobrar_detalle_factura.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_tercero=<?php echo $cod_tercero ?>&pagina=<?php echo $pagina_else ?>">
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