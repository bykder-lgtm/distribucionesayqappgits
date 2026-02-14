
<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
if (isset($_GET['cod_puc'])) {
	$cod_puc                                      = intval($_GET['cod_puc']);
	$nombre_modulo_puc                            = addslashes($_GET['nombre_modulo_puc']);
	$cod_tipo_forma_pago                          = intval($_GET['cod_tipo_forma_pago']);
	$pagina                                       = addslashes($_GET['pagina']);
	
	$sql_producto = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
	$existe_producto = mysqli_num_rows($consulta_producto);
	$datos_producto = mysqli_fetch_assoc($consulta_producto);

	$codigo_puc                                   = $datos_producto['codigo_puc'];
	$nombre_puc                                   = $datos_producto['nombre_puc'];
	$tipo_puc                                     = $datos_producto['tipo_puc'];
	$fecha_creacion 	                          = date("Y-m-d H:i:s");
	$cod_estado                                   = 1;
	$pagina_redirect                              = addslashes($_GET['pagina'])."?nombre_modulo_puc=".$nombre_modulo_puc."&cod_tipo_forma_pago=".$cod_tipo_forma_pago."&pagina=".$pagina;
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
	$sql_data = "INSERT INTO tbl15_movimiento_contable_cuenta_personal (nombre_modulo_puc, cod_tipo_forma_pago, cod_puc, codigo_puc, nombre_puc, tipo_puc, fecha_creacion, cod_estado) 
	VALUES ('$nombre_modulo_puc', '$cod_tipo_forma_pago', '$cod_puc', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$fecha_creacion', '$cod_estado')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>