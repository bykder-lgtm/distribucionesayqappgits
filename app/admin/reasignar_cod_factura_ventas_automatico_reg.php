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

<div class="breadcrumbs"><a href="../admin/reasignar_cod_factura_ventas_automatico.php"><h4>Archivando Facturas de Venta</h4></a></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if (isset($_POST['nombre_tipo_factura'])) {

	$nombre_tipo_factura                                = addslashes($_POST['nombre_tipo_factura']);
	$cod_factura                                        = 1;

	$sql_datos = "SELECT cod_info_factura_venta, cod_factura FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_tipo_factura') AND (nombre_estado_factura = 'CERRADO') ORDER BY fecha_ymdhis ASC";
	$resultado_datos = mysqli_query($conectar, $sql_datos);
	while ($info_datos = mysqli_fetch_assoc($resultado_datos)) {

		$cod_info_factura_venta       = $info_datos['cod_info_factura_venta']; 
		$cod_factura_vieja            = $info_datos['cod_factura']; 

		$actualizar_sql = "UPDATE tbl15_info_factura_venta SET cod_factura = '$cod_factura', observacion_tercero = '$cod_factura_vieja' WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

		$actualizar_sql = "UPDATE tbl15_venta_producto SET cod_factura = '$cod_factura', nombre_empresa = '$cod_factura_vieja' WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

		$cod_factura++;

		if ($cod_factura % 500 == 0) { echo "<br>".$cod_factura; } else { echo $cod_factura; }
	}
	echo "<br>Correcto";
}
?>
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