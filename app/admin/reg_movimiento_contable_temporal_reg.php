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

	if (isset($_POST['pagina']) <> '') { $pagina = mysqli_real_escape_string($conectar, ($_POST['pagina'])); } else { $pagina = ''; }

	$total_datos_movimiento_contable_concepto    = intval($_POST['total_datos_movimiento_contable_concepto']);
	$nombre_tipo_documento                       = addslashes($_POST['nombre_tipo_documento']);
	$und_vendida                                 = 1;
	$fecha_anyo                                  = date("d-m-Y");
	$fecha_mes                                   = date("Y-m");
	$fecha_seg                                   = strtotime(date("Y-m-d"));
	$fecha_ymd                                   = date("Y-m-d");
	$anyo                                        = date("Y");
	$ip                                          = $_SERVER["REMOTE_ADDR"];
	$cuenta                                      = $cuenta_actual;
	$fecha_factura	                             = date("d-m-Y");
	$nombre_estado_factura                       = "ABIERTA";
	$cod_tipo_forma_pago                         = 1;

	$sql_autoincremento_pyg = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
	$exec_autoincremento_pyg = mysqli_query($conectar, $sql_autoincremento_pyg) or die(mysqli_error($conectar));
	$datos_autoincremento_pyg = mysqli_fetch_assoc($exec_autoincremento_pyg);
	$cod_movimiento_contable      = $datos_autoincremento_pyg['AUTO_INCREMENT'];

	for ($i=0; $i < $total_datos_movimiento_contable_concepto; $i++) {
		$nombre_tipo_movimiento                = $_POST['nombre_tipo_movimiento'][$i];

		$agreg_reg = "INSERT INTO tbl15_movimiento_contable_temporal_concepto (cod_movimiento_contable, und_vendida, nombre_tipo_movimiento, nombre_tipo_documento, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
		VALUES ('$cod_movimiento_contable', '$und_vendida', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
		$resultado_ventas = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
	}
	$agreg_reg = "INSERT INTO tbl15_movimiento_contable (nombre_tipo_documento, nombre_estado_factura, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, fecha_factura, cod_tipo_forma_pago)
	VALUES ('$nombre_tipo_documento', '$nombre_estado_factura', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$fecha_factura', '$cod_tipo_forma_pago')";
	$resultado_ventas = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_movimiento_contable_temporal.php?cod_movimiento_contable=<?php echo $cod_movimiento_contable?>">
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