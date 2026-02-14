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
<a class="btn btn-primary" href="#"><h6>Reporte Compras Por Rango de Fechas</h6></a>
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

if (isset($_GET['cod_tercero'])) {
    $cod_tercero                             = intval($_GET['cod_tercero']);
    $fecha                                   = date("Y-m-d");
} else {
    $cod_tercero                             = 0;
    $fecha                                   = date("Y-m-d");
}

if ($cod_tercero==0) {
    $nombre_cliente                                  = 'TODOS';
} else {
    $sql_tercero = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

    $nombre_cliente                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['nombre2_tercero'].' '.$datos_tercero['apellido1_tercero'].' '.$datos_tercero['apellido2_tercero'].' | '.$datos_tercero['identificacion_tercero'];
}
$resta                                   = 1516399999;
$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y-m-d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Ymd");
$hora_venta_his                          = date("His");
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");
?>
<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">PROVEEDOR</td>
    <th style="text-align:center;">FECHA INI</td>
    <th style="text-align:center;">FECHA FIN</td>
    <th style="text-align:center;">VER</td>

  </tr>
  <tr>
    <th style="text-align:center;">
        <select name="cod_tercero" id="cod_tercero" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tercero)) { echo ""; } else { echo ""; }
            $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE nombre_tipo_tercero = 'PROVEEDOR' ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' | '.$datos2['identificacion_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
    </td>
    <th style="text-align:center;"><input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
  </tr>
</table>
</form>
fecha_ymd_venta_producto
<?php
if (isset($_GET['cod_tercero'])) {
$motivo                                  = 'TODOS';
$cod_tercero                             = intval($_GET['cod_tercero']);
$fecha                                   = date("Y/m/d");
$pagina                                  = $_SERVER['PHP_SELF'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($cod_tercero==0) {
    $filtro_consulta_tercero = "";
    $filtro_consulta_tercero_rel = "";
    $filtro_consulta_tercero_productos_rel = "";
} else {
    $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
    $filtro_consulta_tercero_rel = "AND (tbl15_info_factura_compra.cod_tercero = '$cod_tercero')";
    $filtro_consulta_tercero_productos_rel = "AND (tbl15_factura_compra_producto.cod_tercero = '$cod_tercero')";
}
?>
<table class="table table-striped">
<tr>
<td style="text-align:left;">PROVEEDOR: <?php echo $nombre_cliente ?></td>
</tr>
</table>

<table class="table table-striped">
<thead>
<tr>
    <th style="text-align:center">Proveedor</th>
    <th style="text-align:center">Cod</th>
    <th style="text-align:center">Concepto</th>
    <th style="text-align:center">Unidades</th>
    <th style="text-align:center">P.Compra</th>
    <th style="text-align:center">P.Venta</th>
    <th style="text-align:center">%Iva</th>
</tr>
</thead>
<tbody>
<?php
$total_precio_compra_producto = 0;
$total_precio_venta_producto = 0;

$sql_cliente = "SELECT * FROM tbl15_factura_compra_producto WHERE (cod_tercero = '$cod_tercero') ORDER BY nombre_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

    $cod_producto                  = $info_cliente['cod_producto'];
    $cod_producto_barra            = $info_cliente['cod_producto_barra'];
    $nombre_producto               = $info_cliente['nombre_producto'];
    $precio_compra_producto        = $info_cliente['precio_compra_producto'];
    $precio_venta_producto         = $info_cliente['precio_venta_producto'];
    $iva_ptj                       = $info_cliente['iva_ptj'];
    $und_producto                  = $info_cliente['und_producto'];
    $total_compra                  = $und_producto * $precio_compra_producto;
    $total_venta                   = $und_producto * $precio_venta_producto;
    $total_precio_compra_producto  = $total_precio_compra_producto + $total_compra;
    $total_precio_venta_producto   = $total_precio_venta_producto + $total_venta;
?>
<tr>
    <td style="text-align:left"><?php echo $nombre_cliente?></td>
    <td style="text-align:left"><?php echo $cod_producto_barra?></td>
    <td style="text-align:left"><?php echo $nombre_producto?></td>
    <td style="text-align:center"><?php echo $und_producto?></td>
    <td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", ".")?></td>
    <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".")?></td>
    <td style="text-align:center"><?php echo $iva_ptj?></td>
</tr>
<?php } ?>
<tr>
    <th style="text-align:left"></th>
    <th style="text-align:left"></th>
    <th style="text-align:left"></th>
    <th style="text-align:center"></th>
    <th style="text-align:right"><?php echo number_format($total_precio_compra_producto, 0, ",", ".")?></th>
    <th style="text-align:right"><?php echo number_format($total_precio_venta_producto, 0, ",", ".")?></th>
    <th style="text-align:center"></th>
</tr>
</tbody>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<hr>
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

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>REPORTE COMPRAS</strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>VENDEDOR: <?php echo $cuenta_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TERCERO: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>DEPENDENCIA: <?php echo $nombre_dependencia_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TIPO PAGO: <?php echo $nombre_tipo_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA INI: <?php echo $fecha_ymd_venta_producto_ini; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA FIN: <?php echo $fecha_ymd_venta_producto_fin; ?></strong></td>
  </tr>
</table>

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
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'_'?></strong>_imp_repvent</td>
  </tr>
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