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
if (isset($_GET['cod_factura_auditoria_producto'])) {

$cod_factura_auditoria_producto     = intval($_GET['cod_factura_auditoria_producto']);
$cod_info_factura_auditoria         = intval($_GET['cod_info_factura_auditoria']);
$estado                             = addslashes($_GET['estado']);
$pagina                             = addslashes($_GET['pagina'])."?&cod_info_factura_auditoria=".$cod_info_factura_auditoria;
//---------------------------------------------------------------------------------------------------------------------------------------------//
$origen_operacion                   = 'auditoria';
$fecha_hora                         = date("H:i:s");
$fecha_actual_hoy                   = date("Y-m-d");
$ip                                 = $_SERVER['REMOTE_ADDR'];
$fecha_time                         = time();
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_factura_auditoria_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, und_compra, comentario 
FROM tbl15_factura_auditoria_producto WHERE (cod_factura_auditoria_producto = '$cod_factura_auditoria_producto')";
$consulta_factura_auditoria_producto = mysqli_query($conectar, $sql_factura_auditoria_producto);
$datos_factura_auditoria_producto = mysqli_fetch_assoc($consulta_factura_auditoria_producto);

$cod_producto                       = $datos_factura_auditoria_producto['cod_producto'];
$cod_producto_barra                 = $datos_factura_auditoria_producto['cod_producto_barra'];
$nombre_producto                    = $datos_factura_auditoria_producto['nombre_producto'];
$und_producto                       = $datos_factura_auditoria_producto['und_producto'];
$und_compra                         = $datos_factura_auditoria_producto['und_compra'];
$comentario                         = $datos_factura_auditoria_producto['comentario'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_producto = "SELECT * FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$existe_producto = mysqli_num_rows($consulta_producto);
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$und_producto_inv                   = $datos_producto['und_producto'];
$rasteo_anterior                    = $datos_producto['nombre_frec_duracion'];
$unidades_vendidas                  = $und_compra;
$und_vend_orig                      = $und_producto_inv;
$devoluciones                       = $und_producto - $und_producto_inv;
$precio_compra_producto             = $datos_producto['precio_compra_producto'];
$precio_costo_producto              = $datos_producto['precio_costo_producto'];
$precio_venta_producto              = $datos_producto['precio_venta_producto'];
$vlr_total_compra                   = $datos_producto['total_precio_costo_producto'];
$vlr_total_venta                    = $datos_producto['total_precio_venta_producto'];
$cod_tercero                        = $datos_producto['cod_tercero'];
$iva_ptj                            = $datos_producto['iva_ptj'];
$und_inventario                     = $und_producto_inv;
$unidades_faltantes                 = $und_compra;
$und_nuevas                         = ($und_producto - $und_compra);

$fecha_devolucion                   = date("Y-m-d");
$hora_devolucion                    = date("H:i:s");
$fecha_anyo                         = $fecha_devolucion;
$fecha_hora                         = $hora_devolucion;
$fecha_orig                         = $fecha_devolucion;
$fecha                              = $fecha_time;
$fecha_mes                          = date("Y-m");
$vendedor                           = $cuenta_actual;
$cuenta                             = $cuenta_actual;
$cod_estado_correccion              = 1;
//---------------------------------------------------------------------------------------------------------------------------------------------//
$nombre_frec_duracion               = $rasteo_anterior.' - '.$origen_operacion.' - '.$ip.' - und_producto = '.$und_producto;
//---------------------------------------------------------------------------------------------------------------------------------------------//
if ($estado=='sobran') {
$und_nuevas                         = ($und_compra - $und_producto);
$devoluciones                       = $und_nuevas;
$corregir_inventario                = $und_nuevas;

$sql_data = "UPDATE tbl15_producto SET und_producto = '$und_compra', nombre_frec_duracion = '$nombre_frec_duracion' WHERE cod_producto_barra = '$cod_producto_barra'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$agregar_operacion = "INSERT INTO tbl15_operacion (cod_producto_barra, nombre_producto, origen_operacion, unidades_vendidas, 
und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
fecha_hora, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes, vendedor, cuenta) 
VALUES ('$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$unidades_vendidas', 
'$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_orig', '$fecha_anyo', 
'$fecha_hora', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes', '$vendedor', '$cuenta')";
$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));

//$borrar_sql = "DELETE FROM tbl15_factura_auditoria_producto WHERE cod_factura_auditoria_producto = '$cod_factura_auditoria_producto'";
//$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$sql_data = "UPDATE tbl15_factura_auditoria_producto SET cod_estado_correccion = '$cod_estado_correccion', corregir_inventario = '$corregir_inventario' WHERE cod_factura_auditoria_producto = '$cod_factura_auditoria_producto'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
//---------------------------------------------------------------------------------------------------------------------------------------------//
if ($estado=='faltan') {
$und_compra                         = ($und_inventario - $und_nuevas);
$und_nuevas                         = -($und_producto - $und_compra);
$devoluciones                       = $und_nuevas;
$corregir_inventario                = $und_nuevas;

$sql_data = "UPDATE tbl15_producto SET und_producto = '$und_compra', nombre_frec_duracion = '$nombre_frec_duracion' WHERE cod_producto_barra = '$cod_producto_barra'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$agregar_operacion = "INSERT INTO tbl15_operacion (cod_producto_barra, nombre_producto, origen_operacion, unidades_vendidas, 
und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
fecha_hora, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes, vendedor, cuenta) 
VALUES ('$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$unidades_vendidas', 
'$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_orig', '$fecha_anyo', 
'$fecha_hora', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes', '$vendedor', '$cuenta')";
$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));

//$borrar_sql = "DELETE FROM tbl15_factura_auditoria_producto WHERE cod_factura_auditoria_producto = '$cod_factura_auditoria_producto'";
//$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$sql_data = "UPDATE tbl15_factura_auditoria_producto SET cod_estado_correccion = '$cod_estado_correccion', corregir_inventario = '$corregir_inventario' WHERE cod_factura_auditoria_producto = '$cod_factura_auditoria_producto'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
//---------------------------------------------------------------------------------------------------------------------------------------------//
if ($estado=='bien') {
//$borrar_sql = "DELETE FROM tbl15_factura_auditoria_producto WHERE cod_factura_auditoria_producto = '$cod_factura_auditoria_producto'";
//$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$sql_data = "UPDATE tbl15_factura_auditoria_producto SET cod_estado_correccion = '$cod_estado_correccion' WHERE cod_factura_auditoria_producto = '$cod_factura_auditoria_producto'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
//---------------------------------------------------------------------------------------------------------------------------------------------//
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