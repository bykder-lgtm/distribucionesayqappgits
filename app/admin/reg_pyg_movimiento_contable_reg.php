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
	$fecha_anyo                           = date("Y-m-d");
	$fecha_seg                            = strtotime(date("Y-m-d"));
	$fecha_ymd                            = date("Y-m-d");
	$ip                                   = $_SERVER["REMOTE_ADDR"];
	$cuenta                               = $cuenta_actual;
	$total_utilidad_bruta                 = 0;
	$total_ingre_operacional              = 0;
	$total_costo_operacional              = 0;
	$total_gasto_operacional              = 0;
	$total_resultado_operacional          = 0;
	$total_resultado_antes_impuesto       = 0;
	$total_resultado_ejercicio            = 0;

	$sql_autoincremento_pyg = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_pyg'";
	$exec_autoincremento_pyg = mysqli_query($conectar, $sql_autoincremento_pyg) or die(mysqli_error($conectar));
	$datos_autoincremento_pyg = mysqli_fetch_assoc($exec_autoincremento_pyg);
	$cod_pyg                  = $datos_autoincremento_pyg['AUTO_INCREMENT'];
	/* ----------------------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------------------- */
    $sql_ingre_operacional_agrupado = "SELECT SUM(costo_movimiento_contable) AS total_ingre_operacional, cod_puc, codigo_puc, nombre_puc, tipo_puc 
    FROM tbl15_movimiento_contable_concepto WHERE (fecha_mes = '$fecha_mes') AND (tipo_puc = 'INGRESOS') GROUP BY cod_puc DESC";
    $consulta_ingre_operacional_agrupado = mysqli_query($conectar, $sql_ingre_operacional_agrupado) or die(mysqli_error($conectar));
    $matriz_ingre_operacional_agrupado = mysqli_fetch_all($consulta_ingre_operacional_agrupado , MYSQLI_ASSOC);
	foreach ($matriz_ingre_operacional_agrupado as $dato_ingre_operacional_agrupado) { 

		$cod_puc                              = $dato_ingre_operacional_agrupado['cod_puc'];
		$codigo_puc                           = $dato_ingre_operacional_agrupado['codigo_puc'];
		$nombre_puc                           = $dato_ingre_operacional_agrupado['nombre_puc'];
		$tipo_puc                             = $dato_ingre_operacional_agrupado['tipo_puc'];
		$puc_ingre_operacional                = $codigo_puc;
		$nombre_ingre_operacional             = $nombre_puc;
		$costo_ingre_operacional              = $dato_ingre_operacional_agrupado['total_ingre_operacional'];
		$total_ingre_operacional             += $costo_ingre_operacional;

		$reg = "INSERT INTO tbl15_ingre_operacional (cod_pyg, puc_ingre_operacional, nombre_ingre_operacional, costo_ingre_operacional, 
		cod_puc, codigo_puc, nombre_puc, tipo_puc, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
		VALUES ('$cod_pyg', '$puc_ingre_operacional', '$nombre_ingre_operacional', '$costo_ingre_operacional', 
		'$cod_puc', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
		$resultado_ventas = mysqli_query($conectar, $reg) or die(mysqli_error($conectar));
	}
	/* ----------------------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------------------- */
    $sql_costo_operacional_agrupado = "SELECT SUM(costo_movimiento_contable) AS total_costo_operacional, cod_puc, codigo_puc, nombre_puc, tipo_puc 
    FROM tbl15_movimiento_contable_concepto WHERE (fecha_mes = '$fecha_mes') AND (tipo_puc = 'COSTOS DE VENTAS') GROUP BY cod_puc DESC";
    $consulta_costo_operacional_agrupado = mysqli_query($conectar, $sql_costo_operacional_agrupado) or die(mysqli_error($conectar));
    $matriz_costo_operacional_agrupado = mysqli_fetch_all($consulta_costo_operacional_agrupado , MYSQLI_ASSOC);
	foreach ($matriz_costo_operacional_agrupado as $datos_costo_operacional_agrupado) { 

		$cod_puc                              = $datos_costo_operacional_agrupado['cod_puc'];
		$codigo_puc                           = $datos_costo_operacional_agrupado['codigo_puc'];
		$nombre_puc                           = $datos_costo_operacional_agrupado['nombre_puc'];
		$tipo_puc                             = $datos_costo_operacional_agrupado['tipo_puc'];
		$puc_costo_operacional                = $codigo_puc;
		$nombre_costo_operacional             = $nombre_puc;
		$costo_costo_operacional              = $datos_costo_operacional_agrupado['total_costo_operacional'];
		$total_costo_operacional             += $costo_costo_operacional;

		$reg = "INSERT INTO tbl15_costo_operacional (cod_pyg, puc_costo_operacional, nombre_costo_operacional, costo_costo_operacional, 
		cod_puc, codigo_puc, nombre_puc, tipo_puc, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
		VALUES ('$cod_pyg', '$puc_costo_operacional', '$nombre_costo_operacional', '$costo_costo_operacional', 
		'$cod_puc', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
		$resultado_ventas = mysqli_query($conectar, $reg) or die(mysqli_error($conectar));
	}
	/* ----------------------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------------------- */
    $sql_gatos_operacionales_agrupado = "SELECT SUM(costo_movimiento_contable) AS costo_gasto_operacional, cod_puc, codigo_puc, nombre_puc, tipo_puc 
    FROM tbl15_movimiento_contable_concepto WHERE (fecha_mes = '$fecha_mes') AND (tipo_puc = 'GASTOS') GROUP BY cod_puc DESC";
    $consulta_gatos_operacionales_agrupado = mysqli_query($conectar, $sql_gatos_operacionales_agrupado) or die(mysqli_error($conectar));
    $matriz_gatos_operacionales_agrupado = mysqli_fetch_all($consulta_gatos_operacionales_agrupado , MYSQLI_ASSOC);
	foreach ($matriz_gatos_operacionales_agrupado as $datos_gatos_operacionales_agrupado) { 

		$cod_puc                              = $datos_gatos_operacionales_agrupado['cod_puc'];
		$codigo_puc                           = $datos_gatos_operacionales_agrupado['codigo_puc'];
		$nombre_puc                           = $datos_gatos_operacionales_agrupado['nombre_puc'];
		$tipo_puc                             = $datos_gatos_operacionales_agrupado['tipo_puc'];
		$puc_gasto_operacional                = $codigo_puc;
		$nombre_gasto_operacional             = $nombre_puc;
		$costo_gasto_operacional              = $datos_gatos_operacionales_agrupado['costo_gasto_operacional'];
		$total_gasto_operacional             += $costo_gasto_operacional;

		$reg = "INSERT INTO tbl15_gasto_operacional (cod_pyg, puc_gasto_operacional, nombre_gasto_operacional, costo_gasto_operacional, 
		cod_puc, codigo_puc, nombre_puc, tipo_puc, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
		VALUES ('$cod_pyg', '$puc_gasto_operacional', '$nombre_gasto_operacional', '$costo_gasto_operacional', 
		'$cod_puc', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
		$resultado_ventas = mysqli_query($conectar, $reg) or die(mysqli_error($conectar));
	}
	/* ----------------------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------------------- */
	$total_utilidad_bruta                 = 0;
	$total_resultado_operacional          = 0;
	$total_resultado_antes_impuesto       = 0;
	$total_resultado_ejercicio            = 0;

	$agreg_reg = "INSERT INTO tbl15_pyg (total_ingre_operacional, total_costo_operacional, total_utilidad_bruta, total_gasto_operacional, total_resultado_operacional, total_resultado_antes_impuesto, total_resultado_ejercicio, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
	VALUES ('$total_ingre_operacional', '$total_costo_operacional', '$total_utilidad_bruta', '$total_gasto_operacional', '$total_resultado_operacional', '$total_resultado_antes_impuesto', '$total_resultado_ejercicio', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
	$resultado_ventas = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_pyg_movimiento_contable.php?cod_pyg=<?php echo $cod_pyg?>&fecha_mes=<?php echo $fecha_mes?>&anyo=<?php echo $anyo?>">
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