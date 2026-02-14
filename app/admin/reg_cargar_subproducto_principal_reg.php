<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
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
if (isset($_GET['cod_producto_barra'])) {

	$cod_producto_barra                 = addslashes($_GET['cod_producto_barra']);
	$cod_producto_barra_madre           = $cod_producto_barra ;
	$nombre_tipo_moneda                 = 'COP';
	$nombre_tipo_factura                = 'POS';
	$foco                               = 'busqueda';
	$cod_estado_vacuna                  = 1;
	$buscar_por                         = $nombre_buscar_por;
	$cuenta                             = $cuenta_actual;
	$cod_estado_factura                 = '1';
	$fecha_dia                          = strtotime(date("Y/m/d"));
	$fecha_mes                          = date("Y-m");
	$fecha_anyo                         = date("Y-m-d");
	$anyo                               = date("Y");
	$fecha_hora                         = date("H:i:s");
	$cod_tipo_pago                      = '1';
	$fecha_ymdhis                       = date("Y-m-d H:is");
	$cod_tercero                        = '1';
	$nombre_estado_factura              = 'ABIERTA';
	$cod_tipo_forma_pago                = "1";
	$cod_tipo_inventario                = "1";

	$sql_producto = "SELECT * FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
	$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
	$existe_producto = mysqli_num_rows($consulta_producto);
	$datos_producto = mysqli_fetch_assoc($consulta_producto);

	$cod_producto                       = $datos_producto['cod_producto'];
	$nombre_producto                    = $datos_producto['nombre_producto'];

	$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_subproducto'";
	$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
	$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

	$cod_info_factura_subproducto             = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$sql_data = "INSERT INTO tbl15_info_factura_subproducto (cod_info_factura_subproducto, cod_producto, cod_producto_barra, nombre_producto, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
	fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_tipo_forma_pago, 
	nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_tipo_inventario) 
	VALUES ('$cod_info_factura_subproducto', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
	'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_tipo_forma_pago', 
	'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_tipo_inventario')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	
	$pagina                             = '../admin/subproducto_temporal_producto_manual_pos.php'."?&cod_info_factura_subproducto=".$cod_info_factura_subproducto."&foco=".$foco."&buscar_por=".$buscar_por."&pagina=facturacion_subproducto_temporal_producto_manual_pos.php";
	//---------------------------------------------------------------------FACTURA NUEVA FIN----------------------------------------------------------------//
	?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>