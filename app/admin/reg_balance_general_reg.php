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

	$total_datos_activo_corriente         = intval($_POST['total_datos_activo_corriente']);
	$total_datos_propied_planta_equipo    = intval($_POST['total_datos_propied_planta_equipo']);
	$total_datos_pasivo_corriente         = intval($_POST['total_datos_pasivo_corriente']);
	$total_datos_patrimonio               = intval($_POST['total_datos_patrimonio']);
	$total_activo_corriente               = 0;
	$total_propied_planta_equipo          = 0;
	$total_activo                         = 0;
	$total_pasivo_corriente               = 0;
	$total_pasivo                         = 0;
	$total_patrimonio                     = 0;
	$total_pasivo_patrimonio              = 0;

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
	/* ----------------------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------------------- */
	$sql_autoincremento_pyg = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_balance_general'";
	$exec_autoincremento_pyg = mysqli_query($conectar, $sql_autoincremento_pyg) or die(mysqli_error($conectar));
	$datos_autoincremento_pyg = mysqli_fetch_assoc($exec_autoincremento_pyg);
	$cod_balance_general                  = $datos_autoincremento_pyg['AUTO_INCREMENT'];
	/* ----------------------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------------------- */
	$mostrar_datos_sql = "SELECT SUM(total_resultado_ejercicio) AS total_resultado_ejercicio FROM tbl15_pyg WHERE (fecha_mes = '$fecha_mes')";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$datos = mysqli_fetch_assoc($consulta);

	$total_resultado_ejercicio = $datos['total_resultado_ejercicio'];
	/* ----------------------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------------------- */
	$agreg_reg = "INSERT INTO tbl15_balance_general (total_activo_corriente, total_propied_planta_equipo, total_activo, total_pasivo_corriente, total_pasivo, total_patrimonio, total_pasivo_patrimonio, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
	VALUES ('$total_activo_corriente', '$total_propied_planta_equipo', '$total_activo', '$total_pasivo_corriente', '$total_pasivo', '$total_patrimonio', '$total_pasivo_patrimonio', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
	$resultado_ventas = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));

	for ($i=0; $i < $total_datos_activo_corriente; $i++) {
		$nombre_activo_corriente           = $_POST['nombre_activo_corriente'][$i];
		$puc_activo_corriente              = $_POST['puc_activo_corriente'][$i];
		$costo_activo_corriente            = 0;

		$agreg_reg = "INSERT INTO tbl15_activo_corriente (cod_balance_general, nombre_activo_corriente, costo_activo_corriente, puc_activo_corriente, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
		VALUES ('$cod_balance_general', '$nombre_activo_corriente', '$costo_activo_corriente', '$puc_activo_corriente', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
		$resultado_ventas = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
	}

	for ($i=0; $i < $total_datos_pasivo_corriente; $i++) {
		$nombre_pasivo_corriente           = $_POST['nombre_pasivo_corriente'][$i];
		$puc_pasivo_corriente              = $_POST['puc_pasivo_corriente'][$i];
		$costo_pasivo_corriente            = 0;

		$agreg_reg = "INSERT INTO tbl15_pasivo_corriente (cod_balance_general, nombre_pasivo_corriente, costo_pasivo_corriente, puc_pasivo_corriente, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
		VALUES ('$cod_balance_general', '$nombre_pasivo_corriente', '$costo_pasivo_corriente', '$puc_pasivo_corriente', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
		$resultado_ventas = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
	}

	for ($i=0; $i < $total_datos_propied_planta_equipo; $i++) {
		$nombre_propied_planta_equipo       = $_POST['nombre_propied_planta_equipo'][$i];
		$puc_propied_planta_equipo          = $_POST['puc_propied_planta_equipo'][$i];
		$costo_propied_planta_equipo        = 0;

		$agreg_reg = "INSERT INTO tbl15_propied_planta_equipo (cod_balance_general, nombre_propied_planta_equipo, costo_propied_planta_equipo, puc_propied_planta_equipo, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
		VALUES ('$cod_balance_general', '$nombre_propied_planta_equipo', '$costo_propied_planta_equipo', '$puc_propied_planta_equipo', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
		$resultado_ventas = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
	}

	for ($i=0; $i < $total_datos_patrimonio; $i++) {
		$nombre_patrimonio                  = $_POST['nombre_patrimonio'][$i];
		$puc_patrimonio                     = $_POST['puc_patrimonio'][$i];
		$costo_patrimonio                   = 0;

		if ($nombre_patrimonio == 'Resultados del ejercicio') { $costo_patrimonio = $total_resultado_ejercicio; }

		$agreg_reg = "INSERT INTO tbl15_patrimonio (cod_balance_general, nombre_patrimonio, costo_patrimonio, puc_patrimonio, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
		VALUES ('$cod_balance_general', '$nombre_patrimonio', '$costo_patrimonio', '$puc_patrimonio', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
		$resultado_ventas = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_balance_general.php?cod_balance_general=<?php echo $cod_balance_general?>&fecha_mes=<?php echo $fecha_mes?>&anyo=<?php echo $anyo?>">
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