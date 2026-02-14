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

	$cod_producto_auxiliar               = intval($_POST['cod_producto_auxiliar']);
	$cod_producto_barra                  = (addslashes($_POST['cod_producto_barra']));
	$nombre_producto                     = strtoupper(addslashes($_POST['nombre_producto']));
	$precio_compra_producto              = (addslashes($_POST['precio_compra_producto']));
	$precio_venta_producto               = (addslashes($_POST['precio_venta_producto']));
	$iva_ptj                             = (addslashes($_POST['iva_ptj']));
	$nombre_tipo_precio_venta            = (addslashes($_POST['nombre_tipo_precio_venta']));
	$nombre_tipo_unidad_medida           = (addslashes($_POST['nombre_tipo_unidad_medida']));
	$nombre_tipo_producto                = (addslashes($_POST['nombre_tipo_producto']));
	$pagina                              = (addslashes($_POST['pagina']));

	$sql_data = sprintf("UPDATE tbl15_producto_auxiliar SET cod_producto_barra = '$cod_producto_barra', nombre_producto = '$nombre_producto', precio_compra_producto = '$precio_compra_producto', 
	precio_venta_producto = '$precio_venta_producto', iva_ptj = '$iva_ptj', nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida', 
	nombre_tipo_producto = '$nombre_tipo_producto' WHERE cod_producto_auxiliar = '$cod_producto_auxiliar'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } else { ?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
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