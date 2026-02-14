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
if (isset($_GET['cod_producto'])) {

$cod_producto                 = intval($_GET['cod_producto']);
$cod_info_factura_venta       = intval($_GET['cod_info_factura_venta']);
$foco                         = addslashes($_GET['foco']);
$pagina                       = addslashes($_GET['pagina'])."?&cod_info_factura_venta=".$cod_info_factura_venta."&foco=".$foco."&pagina=edit_factura_venta.php";
$comentario_producto          = 'producto gregado en edicion de factura';

$sql_profesional = "SELECT cod_factura, cod_tercero, cod_caja_virtual, cod_resolucion_facturacion, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, cod_tipo_inventario, 
cod_tipo_metodo_envio, cod_tipo_pedido, cod_tipo_aplicacion, cod_zona_envio, cod_estado_cava, fecha_anyo FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$cod_factura                       = $info_profesional['cod_factura'];
$cod_tercero                       = $info_profesional['cod_tercero'];
$cod_caja_virtual                  = $info_profesional['cod_caja_virtual'];
$cod_resolucion_facturacion        = $info_profesional['cod_resolucion_facturacion'];
$cod_tipo_pago                     = $info_profesional['cod_tipo_pago'];
$cod_tipo_forma_pago               = $info_profesional['cod_tipo_forma_pago'];
$nombre_tipo_factura               = $info_profesional['nombre_tipo_factura'];
$nombre_tipo_moneda                = $info_profesional['nombre_tipo_moneda'];
$cod_tipo_inventario               = $info_profesional['cod_tipo_inventario'];
$cod_tipo_metodo_envio             = $info_profesional['cod_tipo_metodo_envio'];
$cod_tipo_pedido                   = $info_profesional['cod_tipo_pedido'];
$cod_tipo_aplicacion 	           = $info_profesional['cod_tipo_aplicacion'];
$cod_zona_envio 	               = $info_profesional['cod_zona_envio'];
$cod_estado_cava                   = $info_profesional['cod_estado_cava'];
$fecha_anyo                        = $info_profesional['fecha_anyo'];

$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total = mysqli_num_rows($consulta);
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_producto_barra                = $matriz_consulta['cod_producto_barra'];
$nombre_producto                   = $matriz_consulta['nombre_producto'];
$und_producto_db_inv               = $matriz_consulta['und_producto'];
$precio_compra_producto            = $matriz_consulta['precio_compra_producto'];
$total_compra_producto             = $precio_compra_producto;
$precio_costo_producto             = $precio_compra_producto;
$total_costo_producto              = $precio_costo_producto;
$precio_venta_producto             = $matriz_consulta['precio_venta_producto'];
$total_venta_producto              = $precio_venta_producto;
$nombre_tipo_producto              = $matriz_consulta['nombre_tipo_producto'];
$und_venta                         = 1;
$fecha_ymd_venta_producto          = $fecha_anyo;
$fecha_mes_venta_producto          = date("Y-m", strtotime($fecha_anyo));
$fecha_anyo_venta_producto         = date("Y", strtotime($fecha_anyo));
$fecha_hora_venta_producto         = date("H:i:s");
$fecha_seg_venta_producto          = time();
$cuenta                            = $cuenta_actual;
$nombre_tipo_unidad_medida         = $matriz_consulta['nombre_tipo_unidad_medida'];
$posologia_cantidad                = $matriz_consulta['posologia_cantidad'];
$posologia_peso                    = $matriz_consulta['posologia_peso'];
$nombre_tipo_presentacion          = $matriz_consulta['nombre_tipo_presentacion'];
$nombre_via_administracion         = $matriz_consulta['nombre_via_administracion'];
$nombre_frec_duracion              = $matriz_consulta['nombre_frec_duracion'];
$und_producto_inv                  = $matriz_consulta['und_producto'];
$und_producto                      = $und_producto_inv - $und_venta;
$nombre_tipo_precio_venta          = $matriz_consulta['nombre_tipo_precio_venta'];
$precio_venta_producto_orig        = $precio_venta_producto;
$und_caja_sobre                    = $matriz_consulta['cajas_sobre'];
$cajas_sobre                       = $matriz_consulta['und_sobre'];
$iva_ptj                           = $matriz_consulta['iva_ptj'];
$cod_categoria                     = $matriz_consulta['cod_categoria'];
$cod_categoria_sub                 = $matriz_consulta['cod_categoria_sub'];
$cod_dependencia                   = $matriz_consulta['cod_dependencia'];
$nombre_tipo_compra                = $matriz_consulta['nombre_tipo_compra'];	 	
$nombre_cliente                    = "cargado en edicion";

$sql_data = "INSERT INTO tbl15_venta_producto (cod_factura, cod_info_factura_venta, cod_producto, cod_producto_barra, nombre_producto, und_venta, precio_costo_producto, total_costo_producto, 
precio_venta_producto, total_venta_producto, nombre_tipo_producto, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, 
fecha_seg_venta_producto, cuenta, cod_administrador, nombre_tipo_precio_venta, precio_compra_producto, total_compra_producto, precio_venta_producto_orig, und_caja_sobre, cajas_sobre, 
nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, nombre_tipo_presentacion, nombre_via_administracion, nombre_frec_duracion, und_producto_inv, 
cod_tercero, cod_caja_virtual, und_producto, fecha_hora_venta_producto, iva_ptj, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, 
cod_categoria, cod_categoria_sub, cod_dependencia, cod_tipo_inventario, nombre_tipo_compra, cod_tipo_metodo_envio, cod_resolucion_facturacion, comentario_producto, 
cod_tipo_pedido, cod_tipo_aplicacion, cod_zona_envio, cod_estado_cava, nombre_cliente) 
VALUES ('$cod_factura', '$cod_info_factura_venta', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', '$precio_costo_producto', '$total_costo_producto', 
'$precio_venta_producto', '$total_venta_producto', '$nombre_tipo_producto', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', 
'$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', '$nombre_tipo_precio_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_venta_producto_orig', '$und_caja_sobre', '$cajas_sobre',
'$nombre_tipo_unidad_medida', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_presentacion', '$nombre_via_administracion', '$nombre_frec_duracion', '$und_producto_inv', 
'$cod_tercero', '$cod_caja_virtual', '$und_producto_db_inv', '$fecha_hora_venta_producto', '$iva_ptj', '$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', 
'$cod_categoria', '$cod_categoria_sub', '$cod_dependencia', '$cod_tipo_inventario', '$nombre_tipo_compra', '$cod_tipo_metodo_envio', '$cod_resolucion_facturacion', '$comentario_producto', 
'$cod_tipo_pedido', '$cod_tipo_aplicacion', '$cod_zona_envio', '$cod_estado_cava', '$nombre_cliente')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------------------//
$und_producto                       = $und_producto_db_inv - $und_venta;

$actualiza_producto = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_total_venta_producto_temporal = "SELECT SUM(und_venta * precio_venta_producto) AS total_precio_venta, SUM(und_venta * precio_costo_producto) AS total_precio_compra
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
$datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal);

$total_precio_compra               = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_precio_venta                = $datos_total_venta_producto_temporal['total_precio_venta'];
$vlr_vuelto                        = 0;

$sql_datos_data = "SELECT cod_info_factura_venta FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_datos_data = mysqli_query($conectar, $sql_datos_data) or die(mysqli_error($conectar));
$total_datos_data = mysqli_num_rows($consulta_datos_data);

$agregar_regis = sprintf("UPDATE tbl15_info_factura_venta SET total_precio_compra = '$total_precio_compra', total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data'
WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php }  ?>
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