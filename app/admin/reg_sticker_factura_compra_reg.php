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

$cod_info_factura_compra      = intval($_GET['cod_info_factura_compra']);
$cod_factura 	              = $cod_info_factura_compra;
$cod_tercero 	              = 1;
$cod_caja_virtual 	          = 1;
$nombre_estado_factura        = "CERRADA";
$fecha_ymdhis 	              = date("YmdHis");
$cuenta                       = $cuenta_actual;
$fecha_dia 	                  = date("Y-m-d");
$fecha_mes 	                  = date("Y-m");
$fecha_anyo 	              = date("Y-m-d");
$anyo 	                      = date("Y");
$fecha_hora                   = date("H:i:s");
$cod_tipo_pago 	              = 1;
$cod_administrador            = $cod_administrador;
$cod_estado_factura 	      = 0;
$cod_dependencia 	          = 1;
$cod_tipo_forma_pago 	      = 1;
$nombre_tipo_factura          = "POS";
$nombre_tipo_moneda           = "COP";
$cod_estado_vacuna 	          = 1;
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_sticker'";
$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

$cod_info_factura_sticker             = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
$pagina                               = "../admin/edit_facturacion_sticker_producto_barras_pos.php"."?&cod_info_factura_sticker=".$cod_info_factura_sticker."&pagina=edit_facturacion_sticker_producto_barras_pos.php";
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = "INSERT INTO tbl15_info_factura_sticker (cod_info_factura_sticker, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, 
cod_caja_virtual, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, 
cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, cod_tercero) 
VALUES ('$cod_info_factura_sticker', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', 
'$cod_caja_virtual', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', 
'$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_factura_compra_producto = "SELECT * FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra') 
ORDER BY cod_factura_compra_producto DESC";
$consulta_factura_compra_producto = mysqli_query($conectar, $sql_factura_compra_producto);
while ($datos_factura_compra_producto = mysqli_fetch_assoc($consulta_factura_compra_producto)) {

$cod_factura_compra_producto                   = $datos_factura_compra_producto['cod_factura_compra_producto'];
$cod_producto                                  = $datos_factura_compra_producto['cod_producto'];
$cod_producto_barra                            = $datos_factura_compra_producto['cod_producto_barra'];
$nombre_producto                               = $datos_factura_compra_producto['nombre_producto'];
$cedula                                        = $datos_factura_compra_producto['cedula'];
$nombre_cliente                                = $datos_factura_compra_producto['nombre_cliente'];
$und_compra                                    = $datos_factura_compra_producto['und_compra'];
$und_unidades                                  = $datos_factura_compra_producto['und_unidades'];
$und_caja                                      = $datos_factura_compra_producto['und_caja'];
$precio_costo_producto                         = $datos_factura_compra_producto['precio_costo_producto'];
$precio_compra_producto                        = $datos_factura_compra_producto['precio_compra_producto'];
$total_costo_producto                          = $datos_factura_compra_producto['total_costo_producto'];
$total_compra_producto                         = $datos_factura_compra_producto['total_compra_producto'];
$precio_venta_producto                         = $datos_factura_compra_producto['precio_venta_producto'];
$precio_venta_producto2                        = $datos_factura_compra_producto['precio_venta_producto2'];
$precio_venta_producto3                        = $datos_factura_compra_producto['precio_venta_producto3'];
$precio_venta_producto4                        = $datos_factura_compra_producto['precio_venta_producto4'];
$precio_venta_producto5                        = $datos_factura_compra_producto['precio_venta_producto5'];
$iva_ptj                                       = $datos_factura_compra_producto['iva_ptj'];
$dto1                                          = $datos_factura_compra_producto['dto1'];
$dto2                                          = $datos_factura_compra_producto['dto2'];
$precio_ipc                                    = $datos_factura_compra_producto['precio_ipc'];
$precio_venta_producto                         = $datos_factura_compra_producto['precio_venta_producto'];
$total_venta_producto                          = $datos_factura_compra_producto['total_venta_producto'];
$nombre_tipo_producto                          = $datos_factura_compra_producto['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                     = $datos_factura_compra_producto['nombre_tipo_unidad_medida'];
$posologia_cantidad                            = $datos_factura_compra_producto['posologia_cantidad'];
$posologia_peso                                = $datos_factura_compra_producto['posologia_peso'];
$nombre_tipo_presentacion                      = $datos_factura_compra_producto['nombre_tipo_presentacion'];
$nombre_via_administracion                     = $datos_factura_compra_producto['nombre_via_administracion'];
$nombre_frec_duracion                          = $datos_factura_compra_producto['nombre_frec_duracion'];
$cod_tipo_cobrar                               = $datos_factura_compra_producto['cod_tipo_cobrar'];
$cod_info_factura_compra                       = $datos_factura_compra_producto['cod_info_factura_compra'];
$nombre_tipo_precio_venta                      = $datos_factura_compra_producto['nombre_tipo_precio_venta'];
$cod_estado_permitir_venta                     = $datos_factura_compra_producto['cod_estado_permitir_venta'];
$cod_tercero                                   = $datos_factura_compra_producto['cod_tercero'];
$und_venta                                     = $und_compra;
$fecha_ymd_venta_producto                      = $datos_factura_compra_producto['fecha_ymd_venta_producto'];
$fecha_mes_venta_producto 	                   = $datos_factura_compra_producto['fecha_mes_venta_producto'];
$fecha_anyo_venta_producto 	                   = $datos_factura_compra_producto['fecha_anyo_venta_producto'];
$fecha_seg_venta_producto 	                   = $datos_factura_compra_producto['fecha_seg_venta_producto'];
$nombre_tipo_precio_venta 	                   = $datos_factura_compra_producto['nombre_tipo_precio_venta'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = "INSERT INTO tbl15_sticker_producto (cod_info_factura_sticker, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_venta, 
precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
precio_venta_producto, total_venta_producto, posologia_cantidad, posologia_peso, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, 
nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
cod_administrador, cod_tipo_cobrar, cod_estado_vacuna, cod_caja_virtual, nombre_tipo_precio_venta, cod_factura_compra_producto) 
VALUES ('$cod_info_factura_sticker', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', 
'$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', 
'$precio_venta_producto', '$total_venta_producto', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', 
'$nombre_via_administracion', '$nombre_frec_duracion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
'$cod_administrador', '$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$cod_factura_compra_producto')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//---------------------------------------------------------------------FACTURA ABIERTA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA ABIERTA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
?>
<?php } ?>
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