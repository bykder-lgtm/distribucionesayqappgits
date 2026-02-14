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
<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<a class="btn btn-primary" href="#"><h6>Reporte Fecha de Vencimiento</h6></a>
<a class="btn btn-primary" href="../admin/reporte_fecha_vencidos.php"><h6>PRODUCTOS VENCIDOS</h6></a>
<?php } ?>

<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
<a class="btn btn-primary" href="#"><h6>Reporte Fecha de Mantenimiento</h6></a>
<?php } ?>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<?php
$seleccionado = 0;

if (isset($_GET['dias_vencimiento_producto_alerta'])) {
$dias_vencimiento_producto_alerta       = intval($_GET['dias_vencimiento_producto_alerta']);
$fecha_ini                              = date("Y-m-d");
$fecha_fin                              = date("Y-m-d", strtotime($fecha_ini."+".$dias_vencimiento_producto_alerta." day"));
$difrencia_seg                          = 0;
$fecha_hoy_seg                          = strtotime($fecha_ini);
$dias_a_vencer                          = 0;
}
?>
<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
	<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
    <td style="text-align:right;">PRODUCTOS A VENDER DENTRO DE </td>
	<?php } ?>
	<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
    <td style="text-align:right;">PRODUCTOS A HACER MANTENIMIENTO DENTRO DE </td>
	<?php } ?>
    <td style="text-align:left;"><input class="input-block-level" name="dias_vencimiento_producto_alerta" type="number" value="<?php echo $dias_vencimiento_producto_alerta ?>" required/></td>
    <td style="text-align:left;">DIAS</td>
    <td style="text-align:left;"><input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
  </tr>
</table>
</form>
<?php
if (isset($_GET['dias_vencimiento_producto_alerta'])) { ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center"><a href="#">Codigo</a></th>
<th style="text-align:center"><a href="#">Nombre Producto</a></th>
<th style="text-align:center"><a href="#">P.Venta</a></th>
<!--<th style="text-align:center"><a href="#">Fecha Compra</a></th>-->
<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<th style="text-align:center"><a href="#">Fecha Vencimiento</a></th>
<th style="text-align:center"><a href="#">Lote</a></th>
<?php } ?>
<?php if ($cod_estado_fecha_mantenimiento_global == '1') { ?>
<th style="text-align:center"><a href="#">Fecha Mantenimiento</a></th>
<?php } ?>
<th style="text-align:center"><a href="#">Vence En</a></th>
<th style="text-align:center"><a href="#">Factura</a></th>
<th style="text-align:center"><a href="#">Proveedor</a></th>
</tr>
</thead>
<tbody>
<?php
$sql_total_forma_pago = "SELECT tbl15_historial_fecha_vencimiento.cod_historial_fecha_vencimiento, tbl15_producto.cod_producto_barra, 
tbl15_producto.nombre_producto, tbl15_historial_fecha_vencimiento.fecha_compra, tbl15_historial_fecha_vencimiento.fecha_vencimiento, 
tbl15_historial_fecha_vencimiento.vencimiento_lote, tbl15_historial_fecha_vencimiento.cod_factura, 
tbl15_historial_fecha_vencimiento.cod_info_factura_compra, tbl15_producto.precio_venta_producto
FROM tbl15_producto RIGHT JOIN tbl15_historial_fecha_vencimiento ON tbl15_producto.cod_producto_barra = tbl15_historial_fecha_vencimiento.cod_producto_barra
WHERE (tbl15_historial_fecha_vencimiento.fecha_vencimiento BETWEEN '$fecha_ini' AND '$fecha_fin') 
ORDER BY tbl15_historial_fecha_vencimiento.fecha_vencimiento ASC";
$consulta_total_forma_pago = mysqli_query($conectar, $sql_total_forma_pago) or die(mysqli_error($conectar));
while ($datos_total_forma_pago = mysqli_fetch_assoc($consulta_total_forma_pago)) {

$cod_historial_fecha_vencimiento        = $datos_total_forma_pago['cod_historial_fecha_vencimiento'];
$cod_producto_barra                     = $datos_total_forma_pago['cod_producto_barra'];
$nombre_producto                        = $datos_total_forma_pago['nombre_producto'];
$fecha_compra                           = $datos_total_forma_pago['fecha_compra'];
$fecha_vencimiento                      = $datos_total_forma_pago['fecha_vencimiento'];
$vencimiento_lote                       = $datos_total_forma_pago['vencimiento_lote'];
$cod_factura                            = $datos_total_forma_pago['cod_factura'];
$cod_info_factura_compra                = $datos_total_forma_pago['cod_info_factura_compra'];
$precio_venta_producto                  = $datos_total_forma_pago['precio_venta_producto'];
$difrencia_seg                          = strtotime($fecha_vencimiento) - $fecha_hoy_seg;
$dias_a_vencer                          = ((($difrencia_seg / 60) /60) / 24);

$sql_infos_empresas = "SELECT cod_tercero FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_tercero                            = $info_empresa_data['cod_tercero'];

$sql_infos_empresas = "SELECT nombre1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$nombre1_tercero                        = $info_empresa_data['nombre1_tercero'];
?>
<tr>
<td style="text-align:left"><?php echo $cod_producto_barra?></td>
<td style="text-align:left"><?php echo $nombre_producto?></td>
<td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".")?></td>
<!--<td style="text-align:center"><?php echo $fecha_compra?></td>-->
<td style="text-align:center"><?php echo $fecha_vencimiento?></td>
<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<td style="text-align:center"><?php echo $vencimiento_lote?></td>
<?php } ?>
<td style="text-align:center"><?php echo $dias_a_vencer?> Dias</td>
<td style="text-align:center"><?php echo $cod_factura?></td>
<td style="text-align:center"><?php echo $nombre1_tercero?></td>
</tr>
<?php } ?>
</tbody>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
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

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:5%; font-family: Courier; font-size:8pt;"><strong>Prod</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>fecha</strong></td>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong>Factura</strong></td>
</tr>
<?php
$suma_total_venta = 0;
$sql_cliente = "SELECT tbl15_historial_fecha_vencimiento.cod_historial_fecha_vencimiento, tbl15_producto.cod_producto_barra, 
tbl15_producto.nombre_producto, tbl15_historial_fecha_vencimiento.fecha_compra, tbl15_historial_fecha_vencimiento.fecha_vencimiento, 
tbl15_historial_fecha_vencimiento.vencimiento_lote, tbl15_historial_fecha_vencimiento.cod_factura, tbl15_historial_fecha_vencimiento.cod_info_factura_compra
FROM tbl15_producto RIGHT JOIN tbl15_historial_fecha_vencimiento ON tbl15_producto.cod_producto_barra = tbl15_historial_fecha_vencimiento.cod_producto_barra
WHERE (tbl15_historial_fecha_vencimiento.fecha_vencimiento BETWEEN '$fecha_ini' AND '$fecha_fin') 
ORDER BY tbl15_historial_fecha_vencimiento.fecha_vencimiento ASC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_historial_fecha_vencimiento        = $info_cliente['cod_historial_fecha_vencimiento'];
$cod_producto_barra                     = $info_cliente['cod_producto_barra'];
$nombre_producto                        = $info_cliente['nombre_producto'];
$fecha_compra                           = $info_cliente['fecha_compra'];
$fecha_vencimiento                      = $info_cliente['fecha_vencimiento'];
$vencimiento_lote                       = $info_cliente['vencimiento_lote'];
$cod_factura                            = $info_cliente['cod_factura'];
$cod_info_factura_compra                = $info_cliente['cod_info_factura_compra'];
?>
<tr>
<td style="text-align: center; width:5%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_producto ?></strong></td>
<td style="text-align: left; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_compra ?></strong></td>
<td style="text-align: right; width:3%; font-family: Courier; font-size:5pt;"><?php echo $fecha_vencimiento ?></td>
</tr>
<?php } ?>
</table>
</div>
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
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>