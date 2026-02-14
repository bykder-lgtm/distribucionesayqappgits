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

	if (isset($_POST['nombre_tabla_mes']) <> '') { $nombre_tabla_mes = mysqli_real_escape_string($conectar, ($_POST['nombre_tabla_mes'])); } else { $nombre_tabla_mes = ''; }
	if (isset($_POST['nombre_tabla_anyo']) <> '') { $nombre_tabla_anyo = mysqli_real_escape_string($conectar, ($_POST['nombre_tabla_anyo'])); } else { $nombre_tabla_anyo = ''; }
	if (isset($_POST['pagina']) <> '') { $pagina = mysqli_real_escape_string($conectar, ($_POST['pagina'])); } else { $pagina = ''; }

	$fecha_mes_venta_producto             = $nombre_tabla_anyo.'-'.$nombre_tabla_mes;
	$fecha_mes                            = $fecha_mes_venta_producto;
	$anyo                                 = $nombre_tabla_anyo;

	$total_datos_ingre_operacional        = intval($_POST['total_datos_ingre_operacional']);
	$total_datos_costo_operacional        = intval($_POST['total_datos_costo_operacional']);
	$total_datos_gasto_operacional        = intval($_POST['total_datos_gasto_operacional']);

	$mostrar_datos_sql_venta = "SELECT Sum(total_venta_producto-(total_venta_producto*(descuento_ptj/100))) As total_ingre_operacional, 
	Sum(total_compra_producto) As total_costo_operacional 
	FROM tbl15_venta_producto WHERE (fecha_mes_venta_producto = '$fecha_mes_venta_producto')";
	$consulta_venta = mysqli_query($conectar, $mostrar_datos_sql_venta) or die(mysqli_error($conectar));
	$matriz_venta = mysqli_fetch_assoc($consulta_venta);

	$total_ingre_operacional              = $matriz_venta['total_ingre_operacional'];
	$total_costo_operacional              = $matriz_venta['total_costo_operacional'];
	$total_utilidad_bruta                 = 0;
	$total_gasto_operacional              = 0;
	$total_resultado_operacional          = 0;
	$total_resultado_antes_impuesto       = 0;
	$total_resultado_ejercicio            = 0;
	$fecha_anyo                           = date("d-m-Y");
	$fecha_seg                            = strtotime(date("Y-m-d"));
	$fecha_ymd                            = date("Y-m-d");
	$ip                                   = $_SERVER["REMOTE_ADDR"];
	$cuenta                               = $cuenta_actual;

	$sql_autoincremento_pyg = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_pyg'";
	$exec_autoincremento_pyg = mysqli_query($conectar, $sql_autoincremento_pyg) or die(mysqli_error($conectar));
	$datos_autoincremento_pyg = mysqli_fetch_assoc($exec_autoincremento_pyg);
	$cod_pyg                  = $datos_autoincremento_pyg['AUTO_INCREMENT'];
	/* ----------------------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------------------- */
	$agreg_reg = "INSERT INTO tbl15_pyg (total_ingre_operacional, total_costo_operacional, total_utilidad_bruta, total_gasto_operacional, total_resultado_operacional, total_resultado_antes_impuesto, total_resultado_ejercicio, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
	VALUES ('$total_ingre_operacional', '$total_costo_operacional', '$total_utilidad_bruta', '$total_gasto_operacional', '$total_resultado_operacional', '$total_resultado_antes_impuesto', '$total_resultado_ejercicio', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
	$resultado_ventas = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
	/* ----------------------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------------------- */
	foreach ($_POST["puc_ingre_operacional"] as $clave => $puc_ingre_operacional) { 
		$nombre_ingre_operacional         = $_POST["nombre_ingre_operacional"][$clave];
		$costo_ingre_operacional          = $total_ingre_operacional;

		$reg = "INSERT INTO tbl15_ingre_operacional (cod_pyg, puc_ingre_operacional, nombre_ingre_operacional, costo_ingre_operacional, 
		fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
		VALUES ('$cod_pyg', '$puc_ingre_operacional', '$nombre_ingre_operacional', '$costo_ingre_operacional', 
		'$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
		$resultado_ventas = mysqli_query($conectar, $reg) or die(mysqli_error($conectar));
	}
	/* ----------------------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------------------- */
	foreach ($_POST["puc_costo_operacional"] as $clave => $puc_costo_operacional) { 
		$nombre_costo_operacional        = $_POST["nombre_costo_operacional"][$clave];
		$costo_costo_operacional         = $total_costo_operacional;

		$reg = "INSERT INTO tbl15_costo_operacional (cod_pyg, puc_costo_operacional, nombre_costo_operacional, costo_costo_operacional, 
		fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
		VALUES ('$cod_pyg', '$puc_costo_operacional', '$nombre_costo_operacional', '$costo_costo_operacional', 
		'$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
		$resultado_ventas = mysqli_query($conectar, $reg) or die(mysqli_error($conectar));
	}
	/* ----------------------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------------------- */
	foreach ($_POST["puc_gasto_operacional"] as $clave => $puc_gasto_operacional) { 
		$nombre_gasto_operacional       = $_POST["nombre_gasto_operacional"][$clave];
		$costo_gasto_operacional        = 0;

		$reg = "INSERT INTO tbl15_gasto_operacional (cod_pyg, puc_gasto_operacional, nombre_gasto_operacional, costo_gasto_operacional, 
		fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
		VALUES ('$cod_pyg', '$puc_gasto_operacional', '$nombre_gasto_operacional', '$costo_gasto_operacional', 
		'$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
		$resultado_ventas = mysqli_query($conectar, $reg) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_pyg.php?cod_pyg=<?php echo $cod_pyg?>&fecha_mes=<?php echo $fecha_mes?>&anyo=<?php echo $anyo?>">
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