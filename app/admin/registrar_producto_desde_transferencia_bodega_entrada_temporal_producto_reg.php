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
if (isset($_GET["cod_info_factura_transferencia_bodega_entrada"])) {

	$cod_info_factura_transferencia_bodega_entrada      = intval($_GET['cod_info_factura_transferencia_bodega_entrada']);
	$cod_transferencia_bodega_entrada_producto_temporal = intval($_GET['cod_transferencia_bodega_entrada_producto_temporal']);
	$pagina                                             = addslashes($_GET['pagina']);

	$sql_transferencia_bodega_entrada_producto_temporal = "SELECT * FROM tbl15_transferencia_bodega_entrada_producto_temporal WHERE (cod_transferencia_bodega_entrada_producto_temporal = '$cod_transferencia_bodega_entrada_producto_temporal')";
	$consulta_transferencia_bodega_entrada_producto_temporal = mysqli_query($conectar, $sql_transferencia_bodega_entrada_producto_temporal);
	$datos_transferencia_bodega_entrada_producto_temporal = mysqli_fetch_assoc($consulta_transferencia_bodega_entrada_producto_temporal);

	$cod_producto_barra                                 = $datos_transferencia_bodega_entrada_producto_temporal['cod_producto_barra'];
	$precio_compra_producto                             = $datos_transferencia_bodega_entrada_producto_temporal['precio_compra_producto'];
	$precio_venta_producto                              = $datos_transferencia_bodega_entrada_producto_temporal['precio_venta_producto'];
	$nombre_tipo_producto                               = $datos_transferencia_bodega_entrada_producto_temporal['nombre_tipo_producto'];
	$nombre_tipo_unidad_medida                          = $datos_transferencia_bodega_entrada_producto_temporal['nombre_tipo_unidad_medida'];
	$iva_ptj                                            = $datos_transferencia_bodega_entrada_producto_temporal['iva_ptj'];
	$nombre_tipo_precio_venta                           = 'PV1';
	$cajas_sobre                                        = $datos_transferencia_bodega_entrada_producto_temporal['cajas_sobre'];
	$und_sobre                                          = $datos_transferencia_bodega_entrada_producto_temporal['und_sobre'];
	$unidad_medida_peso                                 = 'UND';
	$cuenta                                             = $cuenta_actual;
	$und_caja                                           = $cajas_sobre;
	$nombre_producto0                                   = $datos_transferencia_bodega_entrada_producto_temporal['nombre_producto']; 
	$nombre_producto1                                   = str_replace("'", " PULG ", $nombre_producto0);
	$nombre_producto2                                   = str_replace(",", ".", $nombre_producto1);
	$nombre_producto3                                   = str_replace("#", " NO ", $nombre_producto2);
	$nombre_producto4                                   = str_replace("%", " PTJ ", $nombre_producto3);
	$nombre_producto                                    = trim(str_replace('"', " PULG ", $nombre_producto4));

	$creador                                            = $cuenta_actual;
	$fecha_creacion                                     = date("Y-m-d H:i:s");
	$fecha_hora                                         = date("H:i:s");
	$time                                               = time();
	$fecha_ymdHis                                       = date("YmdHis");
	$fecha_ymd                                          = date("Y-m-d");

	$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_producto'";
	$exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
	$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);
	$cod_producto = $datos_autoincremento_sesion['AUTO_INCREMENT'];

	$agreg = "INSERT INTO tbl15_producto (cod_producto_barra, nombre_producto, und_caja, precio_compra_producto, precio_venta_producto, iva_ptj, nombre_tipo_producto, 
	nombre_tipo_unidad_medida, nombre_tipo_precio_venta, cajas_sobre, und_sobre, unidad_medida_peso, fecha_creacion, cuenta) 
	VALUES ('$cod_producto_barra', UPPER('$nombre_producto'), '$und_caja', '$precio_compra_producto', '$precio_venta_producto', '$iva_ptj', '$nombre_tipo_producto', 
	'$nombre_tipo_unidad_medida', '$nombre_tipo_precio_venta', '$cajas_sobre', '$und_sobre', '$unidad_medida_peso', '$fecha_creacion', '$cuenta')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

	$url_redir = $pagina.'?cod_info_factura_transferencia_bodega_entrada='.$cod_info_factura_transferencia_bodega_entrada;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $url_redir;?>">
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