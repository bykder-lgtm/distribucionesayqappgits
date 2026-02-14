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
if (isset($_GET["cod_nota_observacion"])) {

	$cod_nota_observacion               = intval($_GET['cod_nota_observacion']);
	$pagina                             = addslashes($_GET['pagina']);

	$mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE cod_nota_observacion = '$cod_nota_observacion'";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	$matriz_consulta = mysqli_fetch_assoc($consulta);

	$cod_tipo_nota_observacion          = $matriz_consulta['cod_tipo_nota_observacion'];
	$url_img_orig_producto              = $matriz_consulta['url_img_orig_producto'];
	$url_img_min_producto               = $matriz_consulta['url_img_min_producto'];

	if ($cod_tipo_nota_observacion == '2') {
		$tabla_origen                   = 'tbl15_info_factura_venta';
		$campo_origen                   = 'cod_info_factura_venta';
		$llave_origen                   = $matriz_consulta['cod_info_factura_venta'];
		$pagina_redirect                = $pagina.'?'.$campo_origen.'='.$llave_origen.'&pagina='.$pagina;
	} elseif ($cod_tipo_nota_observacion == '3') {
		$tabla_origen                   = 'tbl15_info_factura_compra';
		$campo_origen                   = 'cod_info_factura_compra';
		$llave_origen                   = $matriz_consulta['cod_info_factura_compra'];
		$pagina_redirect                = $pagina.'?'.$campo_origen.'='.$llave_origen.'&pagina='.$pagina;
	} elseif ($cod_tipo_nota_observacion == '4') {
		$tabla_origen                   = 'tbl15_info_cotizacion_factura_compra';
		$campo_origen                   = 'cod_info_cotizacion_factura_compra';
		$llave_origen                   = $matriz_consulta['cod_info_cotizacion_factura_compra'];
		$pagina_redirect                = $pagina.'?'.$campo_origen.'='.$llave_origen.'&pagina='.$pagina;
	} elseif ($cod_tipo_nota_observacion == '5') {
		$tabla_origen                   = 'tbl15_info_cotizacion_factura_venta';
		$campo_origen                   = 'cod_info_cotizacion_factura_venta';
		$llave_origen                   = $matriz_consulta['cod_info_cotizacion_factura_venta'];
		$pagina_redirect                = $pagina.'?'.$campo_origen.'='.$llave_origen.'&pagina='.$pagina;
	} elseif ($cod_tipo_nota_observacion == '6') {
		$tabla_origen                   = 'tbl15_info_factura_auditoria';
		$campo_origen                   = 'cod_info_factura_auditoria';
		$llave_origen                   = $matriz_consulta['cod_info_factura_auditoria'];
		$pagina_redirect                = $pagina.'?'.$campo_origen.'='.$llave_origen.'&pagina='.$pagina;
	} elseif ($cod_tipo_nota_observacion == '7') {
		$tabla_origen                   = 'tbl15_info_factura_transferencia';
		$campo_origen                   = 'cod_info_factura_transferencia';
		$llave_origen                   = $matriz_consulta['cod_info_factura_transferencia'];
		$pagina_redirect                = $pagina.'?'.$campo_origen.'='.$llave_origen.'&pagina='.$pagina;
	} elseif ($cod_tipo_nota_observacion == '8') {
		$tabla_origen                   = 'tbl15_info_factura_transferencia_bodega_entrada';
		$campo_origen                   = 'cod_info_factura_transferencia_bodega_entrada';
		$llave_origen                   = $matriz_consulta['cod_info_factura_transferencia_bodega_entrada'];
		$pagina_redirect                = $pagina.'?'.$campo_origen.'='.$llave_origen.'&pagina='.$pagina;
	} elseif ($cod_tipo_nota_observacion == '9') {
		$tabla_origen                   = 'tbl15_info_factura_transferencia_bodega';
		$campo_origen                   = 'cod_info_factura_transferencia_bodega';
		$llave_origen                   = $matriz_consulta['cod_info_factura_transferencia_bodega'];
		$pagina_redirect                = $pagina.'?'.$campo_origen.'='.$llave_origen.'&pagina='.$pagina;
	} elseif ($cod_tipo_nota_observacion == '10') {
		$tabla_origen                   = 'tbl15_movimiento_contable';
		$campo_origen                   = 'cod_movimiento_contable';
		$llave_origen                   = $matriz_consulta['cod_movimiento_contable'];
		$pagina_redirect                = $pagina.'?'.$campo_origen.'='.$llave_origen.'&pagina='.$pagina;
	} elseif ($cod_tipo_nota_observacion == '11') {
		$tabla_origen                   = 'tbl15_egreso';
		$campo_origen                   = 'cod_egreso';
		$llave_origen                   = $matriz_consulta['cod_egreso'];
		$pagina_redirect                = $pagina.'?'.$campo_origen.'='.$llave_origen.'&pagina='.$pagina;
	} elseif ($cod_tipo_nota_observacion == '12') {
		$tabla_origen                   = 'tbl15_cuentas_cobrar_abonos';
		$campo_origen                   = 'cod_cuentas_cobrar_abonos';
		$llave_origen                   = $matriz_consulta['cod_cuentas_cobrar_abonos'];
		$pagina_redirect                = $pagina.'?'.$campo_origen.'='.$llave_origen.'&pagina='.$pagina;
	} else {
		$tabla_origen                   = '';
		$campo_origen                   = '';
		$llave_origen                   = '';
		$pagina_redirect                = '';
	}
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_max_imagen = "SELECT MAX(cod_posicion) AS cod_posicion FROM tbl15_nota_observacion WHERE $campo_origen = '$llave_origen'";
	$consulta_max_imagen = mysqli_query($conectar, $sql_max_imagen) or die(mysqli_error($conectar));
	$info_max_imagen = mysqli_fetch_assoc($consulta_max_imagen);

	$cod_posicion                       = 1;
	$active                             = 1;
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_data = sprintf("UPDATE tbl15_nota_observacion SET active = '0' WHERE $campo_origen = '$llave_origen'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = sprintf("UPDATE tbl15_nota_observacion SET cod_posicion = '$cod_posicion', active = '$active' WHERE cod_nota_observacion = '$cod_nota_observacion'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = sprintf("UPDATE $tabla_origen SET url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto' WHERE $campo_origen = '$llave_origen'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
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