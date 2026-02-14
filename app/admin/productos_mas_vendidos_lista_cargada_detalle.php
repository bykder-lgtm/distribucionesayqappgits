<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
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
<?php 
$pagina                                  = $_SERVER['PHP_SELF']; 
$fecha_hoy_seg                           = date("Y-m-d");
$fecha_mes_venta_producto_anterior       = date("Y-m",strtotime($fecha_hoy_seg."- 1 month")); 
$fecha_mes_venta_producto                = date("Y-m");
$cod_guia                                = intval($_GET['cod_guia']);
?>
<div class="breadcrumbs">
<a class="btn btn-success" href="../admin/importar_productos_mas_vendidos_archivo_plano.php">CARGADOS POR ARCHIVO CSV MAS VENDIDOS</a>
</div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<table class="table table-striped">
  <thead>
    <tr>
      <th style="text-align:center">BARRA</th>
      <th style="text-align:center">PRODUCTO</th>
      <th style="text-align:center">UND INVENTARIO</th>
      <th style="text-align:center">UND VENDIDAS</th>
      <th style="text-align:center">P.VENTA</th>
      <th style="text-align:center">TOTAL</th>
      <th style="text-align:center">FECHA - MES</th>
      <th style="text-align:center">GUIA</th>
    </tr>
  </thead>
<tbody>
<?php
$sql_info_factura = "SELECT nombre_producto, cod_producto_barra, precio_venta_producto, total_venta_producto, fecha_mes_venta_producto, und_venta, und_producto, cod_guia
FROM tbl15_producto_mas_vendido_externo WHERE (cod_guia = '$cod_guia')";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$und_venta                                    = $info_info_factura['und_venta'];
$cod_producto_barra                           = $info_info_factura['cod_producto_barra'];
$nombre_producto                              = $info_info_factura['nombre_producto'];
$precio_venta_producto                        = $info_info_factura['precio_venta_producto'];
$total_venta_producto                         = $info_info_factura['total_venta_producto'];
$fecha_mes_venta_producto                     = $info_info_factura['fecha_mes_venta_producto'];
$und_producto                                 = $info_info_factura['und_producto'];
$cod_guia                                     = $info_info_factura['cod_guia'];
?>
  <tr>
    <td style="text-align:left;"><?php echo $cod_producto_barra ?></td>
    <td style="text-align:left"><?php echo $nombre_producto?></td>
    <td style="text-align:center"><?php echo number_format($und_producto, 0, ",", ".") ?></td>
    <td style="text-align:center"><?php echo number_format($und_venta, 0, ",", ".") ?></td>
    <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
    <td style="text-align:right"><?php echo number_format($total_venta_producto, 0, ",", ".") ?></td>
    <td style="text-align:center"><?php echo $fecha_mes_venta_producto?></td>
    <td style="text-align:center"><?php echo $cod_guia?></td>
  </tr>
<?php } ?>
</tbody>
</table>
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
<script src="js/jquery-ui.js"></script>

</body>
</html>