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
?>
<div class="breadcrumbs">
<a class="btn btn-success" href="../admin/producto_mas_vendido_mes.php">MAS VENDIDOS DEL MES (<?php echo $fecha_mes_venta_producto?>)<a/> -
<a class="btn btn-danger" href="../admin/producto_mas_vendido_mes_anterior.php">MAS VENDIDOS MES ANTERIOR (<?php echo $fecha_mes_venta_producto_anterior?>)<a/> - 
<a class="btn btn-success" href="../admin/productos_mas_vendidos.php">MAS VENDIDOS</a> - 
<a class="btn btn-success" href="../admin/importar_productos_mas_vendidos_archivo_plano.php">CARGAR ARCHIVO CSV MAS VENDIDOS</a>
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
      <th style="text-align:center"><a href="../admin/descargar_productos_mas_vendidos_csv.php?fecha_mes_venta_producto=<?php echo $fecha_mes_venta_producto_anterior?>">DESCARGAR ARCHIVO PRODUCTOS MAS VENDIDOS MES<img src=../imagenes/descargar.png alt="descargar"></a></th>
    </tr>
  </thead>
</table>

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
    </tr>
  </thead>
<tbody>
<?php
$sql_info_factura = "SELECT nombre_producto, cod_producto_barra, precio_venta_producto, total_venta_producto, fecha_mes_venta_producto, Sum(und_venta) AS und_venta 
FROM tbl15_venta_producto WHERE (fecha_mes_venta_producto = '$fecha_mes_venta_producto_anterior') GROUP BY cod_producto_barra ORDER BY und_venta DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$und_venta                                    = $info_info_factura['und_venta'];
$cod_producto_barra                           = $info_info_factura['cod_producto_barra'];
$nombre_producto                              = $info_info_factura['nombre_producto'];
$precio_venta_producto                        = $info_info_factura['precio_venta_producto'];
$total_venta_producto                         = $info_info_factura['total_venta_producto'];
$fecha_mes_venta_producto                     = $info_info_factura['fecha_mes_venta_producto'];

$sql_tercero = "SELECT und_producto FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
$resultado_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
$info_tercero = mysqli_fetch_assoc($resultado_tercero);

$und_producto                                 = $info_tercero['und_producto'];
?>
  <tr>
    <td style="text-align:left;"><?php echo $cod_producto_barra ?></td>
    <td style="text-align:left"><?php echo $nombre_producto?></td>
    <td style="text-align:center"><?php echo number_format($und_producto, 0, ",", ".") ?></td>
    <td style="text-align:center"><?php echo number_format($und_venta, 0, ",", ".") ?></td>
    <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
    <td style="text-align:right"><?php echo number_format($total_venta_producto, 0, ",", ".") ?></td>
    <td style="text-align:center"><?php echo $fecha_mes_venta_producto?></td>
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