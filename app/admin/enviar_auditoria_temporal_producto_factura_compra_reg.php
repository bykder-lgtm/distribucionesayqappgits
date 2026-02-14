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
if (isset($_GET['cod_info_factura_compra'])) {

	$cod_info_factura_compra                = intval($_GET['cod_info_factura_compra']);
	$fecha_ymd_venta_producto               = date("Y-m-d");
	$fecha_mes_venta_producto               = date("Y-m");
	$fecha_anyo_venta_producto              = date("Y");
	$fecha_seg_venta_producto               = time();
	$cuenta                                 = $cuenta_actual;
	$cod_estado_factura                     = '1';
	$descuento_ptj                          = '0';
	$flete_ptj                              = '0';
	$vlr_cancelado                          = '';
	$vlr_vuelto                             = '';
	$fecha_dia                              = strtotime(date("Y/m/d"));
	$fecha_mes                              = date("Y-m");
	$fecha_anyo                             = date("Y-m-d");
	$anyo                                   = date("Y");
	$fecha_hora                             = date("H:i:s");
	$fecha_remision                         = date("Y-m-d");
	$nombre_ccosto                          = '';
	$garantia_meses                         = '';
	$observacion                            = '';
	$cod_tipo_pago                          = '1';
	$cod_empresa                            = '0';
	$fecha_ymdhis                           = date("Y-m-d H:is");
	$cod_tipo_cobrar                        = '1';
	$cod_tercero                            = '1';
	$nombre_estado_factura                  = 'ABIERTA';
	$nombre_tipo_compra                     = 'NORMAL';
	$cod_tipo_producto_consumo              = '1';
	$cod_tipo_forma_pago                    = "1";
	$und_venta                              = "1";
	$cod_tipo_inventario                    = "1";
	$cod_caja_virtual                       = "1";
	$cod_dependencia                        = "1";
	$nombre_tipo_factura                    = "POS";
	$nombre_tipo_moneda                     = "COP";
	$nombre_tipo_cargue_factura             = "FACTURA_COMPRA_NORMAL";
	$foco                                   = "busqueda";
	$buscar_por                             = "todo";

	$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_auditoria'";
	$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
	$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

	$cod_info_factura_auditoria             = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
	$pagina                                 = "../admin/facturacion_auditoria_temporal_producto_manual_pos.php?cod_info_factura_auditoria=".$cod_info_factura_auditoria."&foco=".$foco."&buscar_por=".$buscar_por."&pagina=facturacion_auditoria_temporal_producto_manual_pos.php";

	$sql_data = "INSERT INTO tbl15_info_factura_auditoria (cod_info_factura_auditoria, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
	fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, cod_tipo_forma_pago, 
	nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, nombre_tipo_cargue_factura, cod_tipo_inventario, nombre_tipo_compra, 
	cod_tipo_producto_consumo) 
	VALUES ('$cod_info_factura_auditoria', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
	'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', 
	'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$nombre_tipo_cargue_factura', '$cod_tipo_inventario', '$nombre_tipo_compra', 
	'$cod_tipo_producto_consumo')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_factura_compra_producto = "SELECT * FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$consulta_factura_compra_producto = mysqli_query($conectar, $sql_factura_compra_producto) or die(mysqli_error($conectar));
	$existe_factura_compra_producto = mysqli_num_rows($consulta_factura_compra_producto);
	while ($datos_factura_compra_producto = mysqli_fetch_assoc($consulta_factura_compra_producto)) {

		$cod_producto                       = $datos_factura_compra_producto['cod_producto'];
		$cod_producto_barra                 = $datos_factura_compra_producto['cod_producto_barra'];
		$nombre_producto                    = $datos_factura_compra_producto['nombre_producto'];
		//$und_producto                       = $datos_factura_compra_producto['und_producto'];
		$und_unidades                       = $datos_factura_compra_producto['und_unidades'];
		$und_caja                           = 0;
		$und_compra                         = $und_unidades * $und_caja;
		$precio_compra_producto             = $datos_factura_compra_producto['precio_compra_producto'];
		$precio_costo_producto              = $datos_factura_compra_producto['precio_costo_producto'];
		$precio_venta_producto              = $datos_factura_compra_producto['precio_venta_producto'];
		$precio_venta_producto2             = $datos_factura_compra_producto['precio_venta_producto2'];
		$precio_venta_producto3             = $datos_factura_compra_producto['precio_venta_producto3']; 
		$precio_venta_producto4             = $datos_factura_compra_producto['precio_venta_producto4'];
		$precio_venta_producto5             = $datos_factura_compra_producto['precio_venta_producto5'];
		$nombre_tipo_unidad_medida          = $datos_factura_compra_producto['nombre_tipo_unidad_medida'];
		$iva_ptj                            = $datos_factura_compra_producto['iva_ptj'];
		$nombre_tipo_producto               = $datos_factura_compra_producto['nombre_tipo_producto'];
		$nombre_tipo_precio_venta           = $datos_factura_compra_producto['nombre_tipo_precio_venta'];
		$comision_ptj                       = $datos_factura_compra_producto['comision_ptj'];
		$total_compra_producto              = $precio_compra_producto * $und_compra;
		$total_costo_producto               = $precio_costo_producto * $und_compra;
		$total_venta_producto               = $precio_venta_producto;
		$precio_compra_producto_viejo       = $precio_compra_producto;
		$precio_costo_producto_viejo        = $precio_costo_producto;

		$sql_producto = "SELECT und_producto FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
		$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
		$datos_producto = mysqli_fetch_assoc($consulta_producto);

		$und_producto                       = $datos_producto['und_producto'];

		$sql_data = "INSERT INTO tbl15_auditoria_producto_temporal (cod_info_factura_auditoria, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_compra, 
		precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
		precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, 
		nombre_tipo_producto, nombre_tipo_unidad_medida, iva_ptj, precio_compra_producto_viejo, precio_costo_producto_viejo, 
		fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
		cod_administrador, cod_tipo_cobrar, cod_caja_virtual, nombre_tipo_precio_venta, und_unidades, und_caja, nombre_tipo_cargue_factura, comision_ptj) 
		VALUES ('$cod_info_factura_auditoria', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_compra', 
		'$precio_compra_producto', '$total_compra_producto',  '$precio_costo_producto', '$total_costo_producto', 
		'$precio_venta_producto', '$precio_venta_producto2', '$precio_venta_producto3', '$precio_venta_producto4', '$precio_venta_producto5', 
		'$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$iva_ptj', '$precio_compra_producto_viejo', '$precio_costo_producto_viejo', 
		'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
		'$cod_administrador', '$cod_tipo_cobrar', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$und_unidades', '$und_caja', '$nombre_tipo_cargue_factura', '$comision_ptj')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
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