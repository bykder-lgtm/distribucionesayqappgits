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
$cod_info_plan_accion_correctiva_preventiva_mejora       = intval($_GET['cod_info_plan_accion_correctiva_preventiva_mejora']);
$foco                         = addslashes($_GET['foco']);
$pagina                       = addslashes($_GET['pagina'])."?&cod_info_plan_accion_correctiva_preventiva_mejora=".$cod_info_plan_accion_correctiva_preventiva_mejora."&foco=".$foco."&pagina=edit_factura_venta.php";

$sql_profesional = "SELECT cod_factura FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$cod_factura                       = $info_profesional['cod_factura'];

$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total = mysqli_num_rows($consulta);
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_producto_barra                = $matriz_consulta['cod_producto_barra'];
$nombre_producto                   = $matriz_consulta['nombre_producto'];
$und_producto                      = $matriz_consulta['und_producto'];
$precio_costo_producto             = $matriz_consulta['precio_costo_producto'];
$total_costo_producto              = $precio_costo_producto;
$precio_venta_producto             = $matriz_consulta['precio_venta_producto'];
$total_venta_producto              = $precio_venta_producto;
$nombre_tipo_producto              = $matriz_consulta['nombre_tipo_producto'];
$und_venta                         = 1;
$fecha_ymd_venta_producto          = date("Y-m-d");
$fecha_mes_venta_producto          = date("Y-m");
$fecha_anyo_venta_producto         = date("Y");
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
//$total_precio_compra              += $und_venta * $precio_costo_producto;
//$total_precio_venta               += $und_venta * $precio_venta_producto;

$sql_data = "INSERT INTO tbl15_plan_accion_correctiva_preventiva_mejora (cod_factura, cod_info_plan_accion_correctiva_preventiva_mejora, cod_producto, cod_producto_barra, nombre_producto, und_venta, precio_costo_producto, total_costo_producto, 
precio_venta_producto, total_venta_producto, nombre_tipo_producto, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, 
fecha_seg_venta_producto, cuenta, cod_administrador, 
nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, nombre_tipo_presentacion, nombre_via_administracion, nombre_frec_duracion, und_producto_inv) 
VALUES ('$cod_factura', '$cod_info_plan_accion_correctiva_preventiva_mejora', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', '$precio_costo_producto', '$total_costo_producto', 
'$precio_venta_producto', '$total_venta_producto', '$nombre_tipo_producto', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', 
'$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
'$nombre_tipo_unidad_medida', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_presentacion', '$nombre_via_administracion', '$nombre_frec_duracion', '$und_producto_inv')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
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