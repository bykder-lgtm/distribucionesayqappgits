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
$nombre_tipo_moneda                 = addslashes($_GET['nombre_tipo_moneda']);
$nombre_tipo_factura                = addslashes($_GET['nombre_tipo_factura']);
$foco                               = addslashes($_GET['foco']);
$cod_estado_vacuna                  = intval($_GET['cod_estado_vacuna']);
$nombre_tipo_cargue_factura         = addslashes($_GET['nombre_tipo_cargue_factura']);
$cod_info_factura_compra            = intval($_GET['cod_info_factura_compra']);
$pagina                             = addslashes($_GET['pagina'])."?&cod_info_factura_compra=".$cod_info_factura_compra."&foco=".$foco."&pagina=edit_factura_compra.php";

$sql_producto = "SELECT * FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$existe_producto = mysqli_num_rows($consulta_producto);
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$cod_producto                       = $datos_producto['cod_producto'];
//$cod_producto_barra                 = $datos_producto['cod_producto_barra'];
$nombre_producto                    = $datos_producto['nombre_producto'];
$und_producto                       = $datos_producto['und_producto'];
$und_unidades                       = $datos_producto['und_unidades'];
$und_caja                           = $datos_producto['und_caja'];
$und_compra                         = $und_unidades * $und_caja;
$precio_compra_producto             = $datos_producto['precio_compra_producto'];
$precio_costo_producto              = $datos_producto['precio_costo_producto'];
$precio_venta_producto              = $datos_producto['precio_venta_producto'];
$precio_venta_producto2             = $datos_producto['precio_venta_producto2'];
$precio_venta_producto3             = $datos_producto['precio_venta_producto3']; 
$precio_venta_producto4             = $datos_producto['precio_venta_producto4'];
$precio_venta_producto5             = $datos_producto['precio_venta_producto5'];
$nombre_tipo_unidad_medida          = $datos_producto['nombre_tipo_unidad_medida'];
$posologia_cantidad                 = $datos_producto['posologia_cantidad'];
$posologia_peso                     = $datos_producto['posologia_peso'];
$iva_ptj                            = $datos_producto['iva_ptj'];
$nombre_tipo_producto               = $datos_producto['nombre_tipo_producto'];
$nombre_tipo_presentacion           = $datos_producto['nombre_tipo_presentacion'];
$nombre_via_administracion          = $datos_producto['nombre_via_administracion'];
$nombre_frec_duracion               = $datos_producto['nombre_frec_duracion'];
$cod_marca                          = $datos_producto['cod_marca'];
$cod_proveedor                      = $datos_producto['cod_proveedor'];
$cod_estado                         = $datos_producto['cod_estado'];
$cod_dependencia                    = $datos_producto['cod_dependencia'];
$fecha_ult_compra                   = $datos_producto['fecha_ult_compra'];
$fecha_ult_venta                    = $datos_producto['fecha_ult_venta'];
$fecha_vencimiento1                 = $datos_producto['fecha_vencimiento1'];
$vencimiento_lote1                  = $datos_producto['vencimiento_lote1'];
$fecha_vencimiento2                 = $datos_producto['fecha_vencimiento2'];
$vencimiento_lote2                  = $datos_producto['vencimiento_lote2'];
$tope_min                           = $datos_producto['tope_min'];
$fecha_creacion                     = $datos_producto['fecha_creacion'];
$fecha_modificacion                 = $datos_producto['fecha_modificacion'];
$cod_info_factura_compra            = $datos_producto['cod_info_factura_compra'];
$nombre_tipo_precio                 = $datos_producto['nombre_tipo_precio'];
$nombre_tipo_precio_venta           = $datos_producto['nombre_tipo_precio_venta'];
$fecha_ymd_venta_producto           = date("Y-m-d");
$fecha_mes_venta_producto           = date("Y-m");
$fecha_anyo_venta_producto          = date("Y");
$fecha_seg_venta_producto           = time();
$cuenta                             = $cuenta_actual;
$cod_estado_factura                 = '1';
$descuento_ptj                      = '0';
$flete_ptj                          = '0';
$vlr_cancelado                      = '';
$vlr_vuelto                         = '';
$fecha_dia                          = strtotime(date("Y/m/d"));
$fecha_mes                          = date("Y-m");
$fecha_anyo                         = date("Y-m-d");
$anyo                               = date("Y");
$fecha_hora                         = date("H:i:s");
$fecha_remision                     = date("Y-m-d");
$nombre_ccosto                      = '';
$garantia_meses                     = '';
$observacion                        = '';
$cod_tipo_pago                      = '1';
$cod_empresa                        = '0';
$fecha_ymdhis                       = date("Y-m-d H:is");
$cod_tipo_cobrar                    = '1';
$cod_tercero                        = '1';
$nombre_estado_factura              = 'ABIERTA';
$cod_tipo_forma_pago                = "1";
$und_venta                          = "1";
$total_compra_producto              = $precio_compra_producto * $und_compra;
$total_costo_producto               = $precio_costo_producto * $und_compra;
$total_venta_producto               = $precio_venta_producto;
$precio_compra_producto_viejo       = $precio_compra_producto;
$precio_costo_producto_viejo        = $precio_costo_producto;

if ($total_costo_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

if ($existe_producto == '1') {
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA NUEVA INICIO----------------------------------------------------------------//
$sql_data = "INSERT INTO tbl15_factura_compra_producto (cod_info_factura_compra, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_compra, 
precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
precio_venta_producto, precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, 
nombre_tipo_producto, nombre_tipo_unidad_medida, iva_ptj, precio_compra_producto_viejo, precio_costo_producto_viejo, 
fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
cod_administrador, cod_tipo_cobrar, cod_estado_vacuna, cod_caja_virtual, nombre_tipo_precio_venta, cod_estado_permitir_venta, und_unidades, und_caja, nombre_tipo_cargue_factura) 
VALUES ('$cod_info_factura_compra', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_compra', 
'$precio_compra_producto', '$total_compra_producto',  '$precio_costo_producto', '$total_costo_producto', 
'$precio_venta_producto', '$precio_venta_producto2', '$precio_venta_producto3', '$precio_venta_producto4', '$precio_venta_producto5', 
'$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$iva_ptj', '$precio_compra_producto_viejo', '$precio_costo_producto_viejo', 
'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
'$cod_administrador', '$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$cod_estado_permitir_venta', '$und_unidades', '$und_caja', '$nombre_tipo_cargue_factura')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//---------------------------------------------------------------------FACTURA ABIERTA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------FACTURA ABIERTA FIN----------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } else {
?>
<center><font size= '+2'><img src=../imagenes/advertencia.gif alt='Advertencia'> <strong>EL CODIGO </font><font size= '+2'><?php echo $cod_producto_barra ?> </font><font size= '+2'>NO EXISTE EN EL INVENTARIO.</font></strong> <img src=../imagenes/advertencia.gif alt='Advertencia'><center><br>
<META HTTP-EQUIV="REFRESH" CONTENT="3; <?php echo $pagina?>">
<?php } ?>
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