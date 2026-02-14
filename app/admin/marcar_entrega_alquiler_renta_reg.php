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

	$cod_info_factura_venta                              = (intval($_POST['cod_info_factura_venta']));
	$fecha_entrega_renta_alquiler                        = (addslashes($_POST['fecha_entrega_renta_alquiler']));
	$hora_entrega_renta_alquiler                         = (addslashes($_POST['hora_entrega_renta_alquiler']));
	$cod_estado_alquiler_renta                           = 0;
	$pagina                                              = (addslashes($_POST['pagina']));
	$pagina_redirect                                     = $pagina;
	$nombre_producto_concat                              = '';
	
    $sql_datos_venta_temp = "SELECT cod_producto, cod_producto_barra, und_venta, nombre_producto FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
    $consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
    while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

        $cod_producto                        = $datos_venta_temp['cod_producto'];
        $und_producto                        = 1;
        $nombre_producto_con                 = $datos_venta_temp['nombre_producto'];
        $und_venta_con                       = $datos_venta_temp['und_venta'];
        $nombre_producto_concat             .= "".$nombre_producto_con.' | <br>';

		$sql_data_producto = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE (cod_producto = '$cod_producto')");
		$exec_data_producto = mysqli_query($conectar, $sql_data_producto) or die(mysqli_error($conectar));
    }

	$sql_data = sprintf("UPDATE tbl15_info_factura_venta SET fecha_entrega_renta_alquiler = '$fecha_entrega_renta_alquiler', 
	hora_entrega_renta_alquiler = '$hora_entrega_renta_alquiler', cod_estado_alquiler_renta = '$cod_estado_alquiler_renta' 
	WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
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