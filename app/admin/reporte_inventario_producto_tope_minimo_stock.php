<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Reporte Tope Minimo Inventario (Stock)</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<?php
$sql_conteo_atendido_mujer = "SELECT Count(cod_producto) AS total_codigos, SUM(precio_compra_producto * und_producto) AS 
total_compra_producto, SUM(precio_venta_producto * und_producto) AS total_venta_producto, 
SUM(precio_compra_producto * und_producto_bodega) AS total_compra_producto_bodega, 
SUM(precio_venta_producto * und_producto_bodega) AS total_venta_producto_bodega
FROM tbl15_producto";
$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

$total_codigos                                = $datos_conteo_atendido_mujer['total_codigos'];
$total_compra_producto                        = $datos_conteo_atendido_mujer['total_compra_producto'];
$total_venta_producto                         = $datos_conteo_atendido_mujer['total_venta_producto'];
$total_compra_producto_bodega                 = $datos_conteo_atendido_mujer['total_compra_producto_bodega'];
$total_venta_producto_bodega                  = $datos_conteo_atendido_mujer['total_venta_producto_bodega'];

$total_compra_producto_mostrador_bodega       = $total_compra_producto + $total_compra_producto_bodega;
$total_venta_producto_mostrador_bodega        = $total_venta_producto + $total_venta_producto_bodega;

$resta                                        = 1516399999;
$time_seg                                     = time();
$time_date_ymd                                = strtotime(date("Y-m-d"));
$hora                                         = date("His");
$fecha_venta_ymd                              = date("Y-m-d");
$hora_venta_his                               = date("H:i:s");
$fecha_impr                                   = date("Ymd");
$hora_impr                                    = date("His");
$pagina                                       = $_SERVER['PHP_SELF'];
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<!--<th style="text-align:center">Elm</th>-->
<th style="text-align:center">COD PRODUCTO</th>
<th style="text-align:center">NOMBRE PRODUCTO</th>
<th style="text-align:center">T.UND</th>
<th style="text-align:center">TOPE MINIMO (STOCK)</th>
<?php if ($cod_estado_inventario_bodega_global == '1') { ?>
<th style="text-align:center">T.UND BODEGA</th>
<?php } ?>
<?php if ($cod_seguridad == '1') { ?>
<th style="text-align:center">MEDIDA</th>
<th style="text-align:center">P.COMPRA</th>
<th style="text-align:center">P.VENTA</th>
<th style="text-align:center">IVA</th>
<?php if ($cod_estado_ptj_comision_global == '1') { ?><th style="text-align:center">COMISION</th><?php } ?>
<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<th style="text-align:center">F.VENCIMIENTO</th>
<th style="text-align:center">LOTE</th>
<?php } ?>
<th style="text-align:center">TIPO PRODUCTO</th>
<th style="text-align:center">DEPENDENCIA</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_producto WHERE (und_producto <= tope_min) ORDER BY nombre_producto ASC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_producto                   = $info_info_factura['cod_producto'];
$cod_producto_barra             = $info_info_factura['cod_producto_barra'];
$nombre_producto                = $info_info_factura['nombre_producto'];
$und_producto                   = $info_info_factura['und_producto'];
$precio_compra_producto         = $info_info_factura['precio_compra_producto'];
$precio_costo_producto          = $info_info_factura['precio_costo_producto'];
$precio_venta_producto          = $info_info_factura['precio_venta_producto'];
$precio_venta_producto2         = $info_info_factura['precio_venta_producto2'];
$precio_venta_producto3         = $info_info_factura['precio_venta_producto3'];
$precio_venta_producto4         = $info_info_factura['precio_venta_producto4'];
$precio_venta_producto5         = $info_info_factura['precio_venta_producto5'];
$cod_dependencia                = $info_info_factura['cod_dependencia'];
$iva_ptj                        = $info_info_factura['iva_ptj'];
$nombre_tipo_producto           = $info_info_factura['nombre_tipo_producto'];
$comision_ptj                   = $info_info_factura['comision_ptj'];
$fecha_vencimiento              = $info_info_factura['fecha_vencimiento'];
$fecha_vencimiento1             = $info_info_factura['fecha_vencimiento1'];
$lote_vencimiento               = $info_info_factura['lote_vencimiento'];
$vencimiento_lote1              = $info_info_factura['vencimiento_lote1'];
$nombre_tipo_precio_venta       = $info_info_factura['nombre_tipo_precio_venta'];
$und_producto_bodega            = $info_info_factura['und_producto_bodega'];
$nombre_tipo_unidad_medida      = $info_info_factura['nombre_tipo_unidad_medida'];
$tope_min                       = $info_info_factura['tope_min'];

$sql_dependencia = "SELECT * FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_dependencia              = $datos_dependencia['nombre_dependencia'];
?>
<tr>
<td style="text-align:left"><?php echo $cod_producto_barra;?></td>
<td style="text-align:left"><?php echo $nombre_producto;?></td>
<td style="text-align:right"><?php echo $und_producto;?></td>
<td style="text-align:right"><?php echo $tope_min;?></td>
<?php if ($cod_estado_inventario_bodega_global == '1') { ?>
<td style="text-align:right"><?php echo $und_producto_bodega;?></td>
<?php } ?>
<?php if ($cod_seguridad == '1') { ?>
<td style="text-align:center"><?php echo $nombre_tipo_unidad_medida;?></td>
<td style="text-align:right"><?php echo intval($precio_compra_producto);?></td>
<td style="text-align:right"><?php echo $precio_venta_producto;?></td>
<td style="text-align:center"><?php echo $iva_ptj;?></td>
<?php if ($cod_estado_ptj_comision_global == '1') { ?><td style="text-align:center"><?php echo $comision_ptj;?></td><?php } ?>
<td style="text-align:center"><?php echo $nombre_tipo_producto;?></td>
<td style="text-align:center"><?php echo $nombre_dependencia;?></td>
<?php } ?>
</tr>
<?php } ?>
</tbody>
</table>

<script>
function printPageArea(areaID){

var printContent = document.getElementById(areaID);
var WinPrint = window.open('', '', 'width=400,height=1000');
WinPrint.document.write(printContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: center;"><div>

<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 98%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>REPORTE INVENTARIO</strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA: <?php echo $fecha_venta_ymd; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>HORA: <?php echo $hora_venta_his; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong>Total Codigos</strong></td>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong>Inv Precio Compra</strong></td>
<td style="text-align: center; width:3%; font-family: Courier; font-size:8pt;"><strong>Inv Precio Venta</strong></td>
<td style="text-align: center; width:3%; font-family: Courier; font-size:8pt;"><strong></strong></td>
</tr>
<tr>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_codigos, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_compra_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:3%; font-family: Courier; font-size:5pt;"></td>
</tr>
</table>

<?php if ($cod_estado_inventario_bodega_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong>Inv Precio Compra Bodega</strong></td>
<td style="text-align: center; width:3%; font-family: Courier; font-size:8pt;"><strong>Inv Precio Venta Bodega</strong></td>
<td style="text-align: center; width:3%; font-family: Courier; font-size:8pt;"><strong></strong></td>
</tr>
<tr>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_compra_producto_bodega, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto_bodega, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:3%; font-family: Courier; font-size:5pt;"></td>
</tr>
</table>
<?php } ?>

<?php if ($cod_estado_inventario_bodega_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong>Inv Precio Compra Mostrador + Bodega</strong></td>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong>Inv Precio Venta Mostrador + Bodega</strong></td>
<td style="text-align: center; width:3%; font-family: Courier; font-size:8pt;"><strong></strong></td>
</tr>
<tr>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_compra_producto_mostrador_bodega, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto_mostrador_bodega, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:3%; font-family: Courier; font-size:5pt;"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'_'?></strong>_imp_repinvent</td>
  </tr>
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
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>