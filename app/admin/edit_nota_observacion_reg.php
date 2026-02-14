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
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

	$cod_nota_observacion            = intval($_POST['cod_nota_observacion']);
	$nombre_nota_observacion         = (addslashes($_POST['nombre_nota_observacion']));
	$cod_tipo_nota_observacion       = (intval($_POST['cod_tipo_nota_observacion']));
	$fecha_ymd                       = (addslashes($_POST['fecha_ymd']));
	$pagina                          = (addslashes($_POST['pagina']));
	$pagina_redirect                 = $pagina.'&pagina='.$pagina_redirect;


	if ($cod_tipo_nota_observacion == 3) {

		$mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE cod_nota_observacion = '$cod_nota_observacion'";
		$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
		$matriz_consulta = mysqli_fetch_assoc($consulta);

		$cod_info_factura_compra                        = $matriz_consulta['cod_info_factura_compra'];
		$pagina_redirect                                = $pagina_redirect.'?cod_info_factura_compra='.$cod_info_factura_compra.'?pagina='.$pagina;
	}


	$sql_data = sprintf("UPDATE tbl15_nota_observacion SET nombre_nota_observacion = '$nombre_nota_observacion', cod_tipo_nota_observacion = '$cod_tipo_nota_observacion', fecha_ymd = '$fecha_ymd' WHERE (cod_nota_observacion = '$cod_nota_observacion')");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
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