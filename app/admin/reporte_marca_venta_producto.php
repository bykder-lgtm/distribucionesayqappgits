<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="../estilo_css/chosen.css">
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
<a class="btn btn-primary" href="#"><h6>Reporte Ventas Por Marca y Rango de Fechas</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<?php
if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
  $cod_marca                               = intval($_GET['cod_marca']);
  $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
  $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
} else {
  $cod_marca                               = 0;
  $fecha_ymd_venta_producto_ini            = date("Y-m-d");
  $fecha_ymd_venta_producto_fin            = date("Y-m-d");
}
?>
<form action="" id="" method="GET">
<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">MARCA</th>
    <th style="text-align:center;">FECHA INI</th>
    <th style="text-align:center;">FECHA FIN</th>
    <th style="text-align:center;">VER</th>
  </tr>
  <tr>
    <td style="text-align:left;">
        <select name="cod_marca" id="cod_marca" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" tabindex="1" required>
            <?php if (isset($cod_marca)) { echo "<option value='' $seleccionado >Selecione</option>"; } else { echo  "<option value='' $seleccionado >Selecione</option>"; }
            $consulta2_sql = "SELECT cod_marca, nombre_marca FROM tbl15_marca ORDER BY nombre_marca ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_marca) AND $cod_marca == $datos2['cod_marca']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_marca'];
            $nombre = $datos2['nombre_marca'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" required/></td>
    <td style="text-align:center;"><button type="submit">Ver Registros</button></td>
  </tr>
</table>
</form>
<?php
if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
  $cod_marca                               = intval($_GET['cod_marca']);
  $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
  $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
  $pagina                                  = $_SERVER['PHP_SELF'];

  $sql_profesional = "SELECT * FROM tbl15_marca WHERE cod_marca = '$cod_marca'";
  $resultado_profesional = mysqli_query($conectar, $sql_profesional);
  $info_profesional = mysqli_fetch_assoc($resultado_profesional);

  $nombre_marca                                      = $info_profesional['nombre_marca'];

  $sql_total_venta = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_compra_producto, SUM(und_venta) AS total_suma_und_venta FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_marca = '$cod_marca')";
  $consulta_total_venta = mysqli_query($conectar, $sql_total_venta) or die(mysqli_error($conectar));
  $datos_total_venta = mysqli_fetch_assoc($consulta_total_venta);

  $total_suma_venta_producto       = $datos_total_venta['total_suma_venta_producto'];
  $total_compra_producto           = $datos_total_venta['total_compra_producto'];
  $total_ganancia                  = $total_suma_venta_producto - $total_compra_producto;
  $total_suma_und_venta            = $datos_total_venta['total_suma_und_venta'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">MARCA</th>
    <th style="text-align:center;">FECHA INI</th>
    <th style="text-align:center;">FECHA FIN</th>
    <th style="text-align:center;">TOTAL VENTA</th>

  </tr>
  <tr>
    <td style="text-align:center;"><?php echo $nombre_marca ?></td>
    <td style="text-align:center;"><?php echo $fecha_ymd_venta_producto_ini ?></td>
    <td style="text-align:center;"><?php echo $fecha_ymd_venta_producto_fin ?></td>
    <td style="text-align:center;"><?php echo number_format($total_suma_venta_producto, 0, ",", ".") ?></td>
  </tr>
</table>

<br>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th style="text-align:center">Marca</th>
      <th style="text-align:center">Cod</th>
      <th style="text-align:center">Concepto</th>
      <th style="text-align:center">Unidades</th>
      <th style="text-align:center">P.Venta</th>
      <th style="text-align:center">Total Venta</th>
      <th style="text-align:center">Fecha</th>
      <th style="text-align:center">Hora</th>
      <th style="text-align:center">Factura</th>
      <th style="text-align:center">Id</th>
    </tr>
  </thead>
  <tbody>
<?php
$total_total_venta_producto    = 0;
$total_ganancia_venta_sum      = 0;

$sql_cliente = "SELECT cod_venta_producto, cod_producto, cod_producto_barra, cod_info_factura_venta, cod_factura, nombre_producto, und_venta, precio_compra_producto, precio_venta_producto, total_venta_producto, 
fecha_hora_venta_producto, und_producto, cod_administrador, fecha_ymd_venta_producto
FROM tbl15_venta_producto WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_marca = '$cod_marca') ORDER BY cod_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

  $cod_venta_producto            = $info_cliente['cod_venta_producto'];
  $cod_producto                  = $info_cliente['cod_producto'];
  $cod_producto_barra            = $info_cliente['cod_producto_barra'];
  $cod_info_factura_venta        = $info_cliente['cod_info_factura_venta'];
  $cod_factura                   = $info_cliente['cod_factura'];
  $nombre_producto               = $info_cliente['nombre_producto'];
  $und_venta                     = $info_cliente['und_venta'];
  $precio_compra_producto        = $info_cliente['precio_compra_producto'];
  $precio_venta_producto         = $info_cliente['precio_venta_producto'];
  $total_venta_producto          = $info_cliente['total_venta_producto'];
  $fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
  $fecha_hora_venta_producto     = $info_cliente['fecha_hora_venta_producto'];
  $cod_administrador_db          = $info_cliente['cod_administrador'];
?>
    <tr>
      <td style="text-align:center"><?php echo $nombre_marca?></td>
      <td style="text-align:center"><?php echo $cod_producto_barra?></td>
      <td style="text-align:left"><?php echo $nombre_producto?></td>
      <td style="text-align:center"><?php echo $und_venta?></td>
      <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".")?></td>
      <td style="text-align:right"><?php echo number_format($total_venta_producto, 0, ",", ".")?></td>
      <td style="text-align:center"><?php echo $fecha_ymd_venta_producto?></td>
      <td style="text-align:center"><?php echo $fecha_hora_venta_producto?></td>
      <td style="text-align:center"><?php echo $cod_factura?></td>
      <td style="text-align:center"><?php echo $cod_venta_producto?></td>
    </tr>
<?php } ?>
  </tbody>
</table>
</div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>