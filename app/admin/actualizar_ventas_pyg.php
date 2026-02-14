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
if (isset($_GET["cod_pyg"])) {

	$cod_pyg                              = intval($_GET['cod_pyg']);
	$fecha_mes_venta_producto             = addslashes($_GET['fecha_mes']);
	$fecha_mes                            = addslashes($_GET['fecha_mes']);
	$pagina                               = 'edit_pyg.php?cod_pyg='.$cod_pyg.'&fecha_mes='.$fecha_mes_venta_producto;

	$mostrar_datos_sql_venta = "SELECT Sum(total_venta_producto) As total_ingre_operacional, sum(total_compra_producto) As total_costo_operacional 
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
	$fecha_anyo                           = date("Y-m-d");
	$fecha_seg                            = strtotime(date("Y-m-d"));
	$fecha_ymd                            = date("Y-m-d");
	//$anyo                                 = $nombre_tabla_anyo;
	$ip                                   = $_SERVER["REMOTE_ADDR"];
	$cuenta                               = $cuenta_actual;

	$actualizar_sql = "UPDATE tbl15_pyg SET total_ingre_operacional = '$total_ingre_operacional', total_costo_operacional = '$total_costo_operacional', fecha_anyo = '$fecha_anyo', 
	 fecha_mes = '$fecha_mes', fecha_seg = '$fecha_seg', fecha_ymd = '$fecha_ymd', ip = '$ip' WHERE cod_pyg = '$cod_pyg'";
	$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

	$actualizar_sql = "UPDATE tbl15_ingre_operacional SET costo_ingre_operacional = '$total_ingre_operacional', fecha_anyo = '$fecha_anyo', 
	 fecha_mes = '$fecha_mes', fecha_seg = '$fecha_seg', fecha_ymd = '$fecha_ymd', ip = '$ip' WHERE cod_pyg = '$cod_pyg'";
	$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

	$actualizar_sql = "UPDATE tbl15_costo_operacional SET costo_costo_operacional = '$total_costo_operacional', fecha_anyo = '$fecha_anyo', 
	 fecha_mes = '$fecha_mes', fecha_seg = '$fecha_seg', fecha_ymd = '$fecha_ymd', ip = '$ip' WHERE cod_pyg = '$cod_pyg'";
	$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
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