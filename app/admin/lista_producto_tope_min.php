<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor) {
myajax.Link('guardar_inventario_productos.php?valor='+valor+'&campo='+campo+'&id='+id);
}
}
</script>
</head>
<body id="pageBody" onLoad="myajax = new isiAJAX();">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">

<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="../admin/lista_producto.php"><h4>Lista Productos en Stock&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_producto.php">Registrar Producto</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">CODIGO</th>
<th style="text-align:center">NOMBRE</th>
<th style="text-align:center">UNIDADES</th>
<th style="text-align:center">P.COMPRA</th>
<th style="text-align:center">P.VENTA</th>
<th style="text-align:center">STOCK</th>
<!--
<th align='center'>MEDIDA</th>
<th align='center'>TIPO</th>
<th align='center'>PRESENTACION</th>
<th align='center'>ADMINISTRACION</th>
-->
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT * FROM tbl15_producto WHERE und_producto <= tope_min";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
 	
$cod_producto                      = $info_cliente['cod_producto'];
$cod_producto_barra                = $info_cliente['cod_producto_barra'];
$nombre_producto                   = $info_cliente['nombre_producto'];
$und_producto                      = $info_cliente['und_producto'];
$precio_compra_producto            = $info_cliente['precio_compra_producto'];
$precio_costo_producto             = $info_cliente['precio_costo_producto'];
$precio_venta_producto             = $info_cliente['precio_venta_producto'];
$precio_venta_producto2            = $info_cliente['precio_venta_producto2'];
$precio_venta_producto3            = $info_cliente['precio_venta_producto3'];
$precio_venta_producto4            = $info_cliente['precio_venta_producto4'];
$precio_venta_producto5            = $info_cliente['precio_venta_producto5'];
$nombre_tipo_unidad_medida         = $info_cliente['nombre_tipo_unidad_medida'];
$posologia_cantidad                = $info_cliente['posologia_cantidad'];
$posologia_peso                    = $info_cliente['posologia_peso'];
$iva_ptj                           = $info_cliente['iva_ptj'];
$nombre_tipo_producto              = $info_cliente['nombre_tipo_producto'];
$nombre_tipo_presentacion          = $info_cliente['nombre_tipo_presentacion'];
$nombre_via_administracion         = $info_cliente['nombre_via_administracion'];
$nombre_frec_duracion              = $info_cliente['nombre_frec_duracion'];
$cod_marca                         = $info_cliente['cod_marca'];
$cod_proveedor                     = $info_cliente['cod_proveedor'];
$cod_tercero                       = $info_cliente['cod_tercero'];
$cod_estado                        = $info_cliente['cod_estado'];
$cod_dependencia                   = $info_cliente['cod_dependencia'];
$fecha_ult_compra                  = $info_cliente['fecha_ult_compra'];
$fecha_ult_venta                   = $info_cliente['fecha_ult_venta'];
$fecha_vencimiento1                = $info_cliente['fecha_vencimiento1'];
$vencimiento_lote1                 = $info_cliente['vencimiento_lote1'];
$fecha_vencimiento2                = $info_cliente['fecha_vencimiento2'];
$vencimiento_lote2                 = $info_cliente['vencimiento_lote2'];
$tope_min                          = $info_cliente['tope_min'];
$fecha_creacion                    = $info_cliente['fecha_creacion'];
$fecha_modificacion                = $info_cliente['fecha_modificacion'];
$cuenta                            = $info_cliente['cuenta'];
$cod_info_factura_compra           = $info_cliente['cod_info_factura_compra'];
?>
<tr>
<td style="text-align:left"><?php echo $cod_producto_barra;?></td>
<td style="text-align:left"><?php echo $nombre_producto;?></td>
<td style="text-align:center"><?php echo $und_producto;?></td>
<td style="text-align:right"><?php echo number_format($precio_costo_producto, 0, ",", "."); ?></td>
<td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
<td style="text-align:center"><?php echo $tope_min;?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
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