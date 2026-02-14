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
if (isset($_GET["llave"])) {

$cod_compra_producto_temporal            = intval($_GET['llave']);
$cuenta                                  = addslashes($_GET['cuenta']);
$cod_caja_virtual                        = intval($_GET['cod_caja_virtual']);
$pagina                                  = addslashes($_GET['pagina']);

$sql_compra_producto_temporal = "SELECT * FROM tbl15_compra_producto_temporal WHERE (cod_compra_producto_temporal = '$cod_compra_producto_temporal')";
$consulta_compra_producto_temporal = mysqli_query($conectar, $sql_compra_producto_temporal);
$datos_compra_producto_temporal = mysqli_fetch_assoc($consulta_compra_producto_temporal);

$cod_info_factura_compra                       = $datos_compra_producto_temporal['cod_info_factura_compra'];
$cod_producto_barra                            = $datos_compra_producto_temporal['cod_producto_barra'];
$nombre_producto                               = $datos_compra_producto_temporal['nombre_producto'];
$und_unidades                                  = $datos_compra_producto_temporal['und_unidades'];
$und_caja                                      = 1;
$precio_costo_producto                         = $datos_compra_producto_temporal['precio_costo_producto'];
$precio_compra_producto                        = $datos_compra_producto_temporal['precio_compra_producto'];
$precio_venta_producto                         = $datos_compra_producto_temporal['precio_venta_producto'];
$precio_venta_producto2                        = $datos_compra_producto_temporal['precio_venta_producto2'];
$precio_venta_producto3                        = $datos_compra_producto_temporal['precio_venta_producto3'];
$precio_venta_producto4                        = $datos_compra_producto_temporal['precio_venta_producto4'];
$precio_venta_producto5                        = $datos_compra_producto_temporal['precio_venta_producto5'];
$iva_ptj                                       = $datos_compra_producto_temporal['iva_ptj'];
$dto1                                          = $datos_compra_producto_temporal['dto1'];
$dto2                                          = $datos_compra_producto_temporal['dto2'];
$nombre_tipo_producto                          = 'PRODUCTO';
$nombre_tipo_unidad_medida                     = 'UND';
$nombre_tipo_precio_venta                      = 'PV1';
$fecha_vencimiento                             = $datos_compra_producto_temporal['fecha_vencimiento'];
$lote_vencimiento                              = $datos_compra_producto_temporal['lote_vencimiento'];
$comision_ptj                                  = $datos_compra_producto_temporal['comision_ptj'];
$cajas_sobre                                   = $datos_compra_producto_temporal['cajas_sobre'];
$und_sobre                                     = $datos_compra_producto_temporal['und_sobre'];
$unidad_medida_peso                            = 'UND';
//$cuenta                                        = $cuenta_actual;

$nombre_producto0                              = $datos_compra_producto_temporal['nombre_producto']; 
$nombre_producto1                              = str_replace("'", " PULG ", $nombre_producto0);
$nombre_producto2                              = str_replace(",", ".", $nombre_producto1);
$nombre_producto3                              = str_replace("#", " NO ", $nombre_producto2);
$nombre_producto4                              = str_replace("%", " PTJ ", $nombre_producto3);
$nombre_producto                               = trim(str_replace('"', " PULG ", $nombre_producto4));

$creador                                       = $cuenta_actual;
$fecha_compra                                  = date("Y-m-d");
$fecha_creacion                                = date("Y-m-d H:i:s");
$fecha_hora                                    = date("H:i:s");
$time                                          = time();
$fecha_ymdHis                                  = date("YmdHis");
$formato                                       = 'jpg';
$fecha_hora                                    = date("H:i:s");
$fecha_ymd                                     = date("Y-m-d");
$ruta_archivo_adjunto_orig                     = '../archivador/documentos/';

$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_producto'";
$exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);
$cod_producto = $datos_autoincremento_sesion['AUTO_INCREMENT'];

$agreg = "INSERT INTO tbl15_producto (cod_producto_barra, nombre_producto, und_caja, precio_costo_producto, precio_compra_producto,  
precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, iva_ptj, dto1, dto2, nombre_tipo_producto, 
nombre_tipo_unidad_medida, nombre_tipo_precio_venta, fecha_vencimiento, lote_vencimiento, comision_ptj, cajas_sobre, und_sobre, unidad_medida_peso, fecha_creacion, cuenta) 
VALUES ('$cod_producto_barra', UPPER('$nombre_producto'), '$und_caja', '$precio_costo_producto', '$precio_compra_producto', 
'$precio_venta_producto', '$precio_venta_producto2', '$precio_venta_producto3', '$precio_venta_producto4', '$precio_venta_producto5', '$iva_ptj', '$dto1', '$dto2', '$nombre_tipo_producto', 
'$nombre_tipo_unidad_medida', '$nombre_tipo_precio_venta', '$fecha_vencimiento', '$lote_vencimiento', '$comision_ptj', '$cajas_sobre', '$und_sobre', '$unidad_medida_peso', '$fecha_creacion', '$cuenta')";
$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

$url_redir = $pagina.'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_factura_compra='.$cod_info_factura_compra;
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