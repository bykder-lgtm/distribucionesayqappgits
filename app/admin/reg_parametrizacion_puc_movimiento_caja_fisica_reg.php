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
	$pagina                                       = addslashes($_GET['pagina']);
	
	$sql_producto = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
	$existe_producto = mysqli_num_rows($consulta_producto);
	$datos_producto = mysqli_fetch_assoc($consulta_producto);

	$codigo_puc                                   = $datos_producto['codigo_puc'];
	$nombre_puc                                   = $datos_producto['nombre_puc'];
	$tipo_puc                                     = $datos_producto['tipo_puc'];
	$fecha_ymd_movimiento_caja 	                  = date("Y-m-d");
	$fecha_mes_movimiento_caja 	                  = date("Y-m");
	$fecha_anyo_movimiento_caja 	              = date("Y");
	$fecha_hora_movimiento_caja 	              = date("H:i:s");
	$fecha_seg_movimiento_caja 	                  = time();
	$fecha_creacion 	                          = date("Y-m-d H:i:s");
	$cod_estado                                   = 1;
	$pagina_redirect                              = addslashes($_GET['pagina'])."?pagina=".$pagina;
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
	$sql_data = "INSERT INTO tbl15_movimiento_caja (cod_puc, codigo_puc, nombre_puc, tipo_puc, fecha_ymd_movimiento_caja, fecha_mes_movimiento_caja, 
	fecha_anyo_movimiento_caja, fecha_hora_movimiento_caja, fecha_seg_movimiento_caja, fecha_creacion, cod_estado) 
	VALUES ('$cod_puc', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$fecha_ymd_movimiento_caja', '$fecha_mes_movimiento_caja', 
	'$fecha_anyo_movimiento_caja', '$fecha_hora_movimiento_caja', '$fecha_seg_movimiento_caja', '$fecha_creacion', '$cod_estado')";
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