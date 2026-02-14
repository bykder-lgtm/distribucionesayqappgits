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
<a class="btn btn-primary" href="#"><h6>Reporte de Retefuente en Ventas Por Rango de Fechas</h6></a>
</div>
<script>
function printPageArea(areaID){

  var printContent = document.getElementById(areaID);
  $("#area_imprimible_invisible").show();

  var WinPrint = window.open('', '', 'width=400,height=1000');
  WinPrint.document.write(printContent.innerHTML);
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
  WinPrint.close();
}
</script>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<?php
$cod_producto_barra                     = "11113333";
$resta                                   = 1516399999;
$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y-m-d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Ymd");
$hora_venta_his                          = date("His");
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
  $cod_tercero                             = intval($_GET['cod_tercero']);
  $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
  $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);

  $fecha                                   = date("Y-m-d");

  if ($cod_tercero==0) {
    $filtro_consulta_tercero = "";
    $filtro_consulta_tercero_rel = "";
    $nombre_cliente                                  = 'TODOS';
  } else {
    $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
    $filtro_consulta_tercero_rel = "AND (tbl15_venta_producto.cod_tercero = '$cod_tercero')";

  $sql_tercero = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
  $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
  $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

  $nombre_cliente               = trim($datos_tercero['nombre1_tercero'].' '.$datos_tercero['nombre2_tercero'].' '.$datos_tercero['apellido1_tercero'].' '.$datos_tercero['apellido1_tercero']);
  }
}
?>
<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:right;">CLIENTE: </td>
    <td style="text-align:left;">
        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" tabindex="1" required>
            <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
  </tr> 
  <tr>
    <td style="text-align:right;">FECHA INI: </td>
    <td style="text-align:left;"><input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" required/></td>
  </tr>
  <tr>
    <td style="text-align:right;">FECHA FIN: </td>
    <td style="text-align:left;"><input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" required/></td>
  </tr>
  <tr>
    <td style="text-align:right;"></td>
    <td style="text-align:left;"><button type="submit">Ver Registros</button></td>
  </tr>
</table>
</form>
<?php
if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
  $motivo                                  = 'TODOS';
  $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
  $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
  $fecha                                   = date("Y/m/d");
  $pagina                                  = $_SERVER['PHP_SELF'];
  $contado                                 = '1';
  $credito                                 = '2';
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_venta_contado = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_compra_producto
  FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_producto_barra = '$cod_producto_barra') $filtro_consulta_tercero";
  $consulta_total_venta_contado = mysqli_query($conectar, $sql_total_venta_contado) or die(mysqli_error($conectar));
  $datos_total_venta_contado = mysqli_fetch_assoc($consulta_total_venta_contado);

  $total_suma_venta_producto       = $datos_total_venta_contado['total_suma_venta_producto'];
  $total_compra_producto_contado   = $datos_total_venta_contado['total_compra_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<form action="" method="GET">
<table class="table table-striped">

    <tr>
    <td style="text-align:center;">CLIENTE: <?php echo $nombre_cliente ?></td>
  </tr>
  <tr>
    <td style="text-align:center;">FECHA INI: <?php echo $fecha_ymd_venta_producto_ini ?></td>
  </tr>
  <tr>
    <td style="text-align:center;">FECHA FIN: <?php echo $fecha_ymd_venta_producto_fin ?></td>
  </tr>
</table>
</form> 

<br>
<div class="table-responsive">
<table class="table table-striped">
  <tr>
    <th style="text-align:center;"><a href="#">Total Retefuente</a></th>
    <th style="text-align:center;"><a href="#">Imprimir</th>
  </tr>
  <tr>
    <td style="text-align:center;"><?php echo number_format(abs($total_suma_venta_producto), 0, ",", ".") ?></td>
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></td>
  </tr>
</table>
</div>

<br>
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th style="text-align:center">Ver</th>
      <th style="text-align:center">Factura</th>
      <th style="text-align:center">Cliente</th>
      <th style="text-align:center">Concepto</th>
      <th style="text-align:center">Retefuente</th>
      <th style="text-align:center">Cuenta</th>
      <th style="text-align:center">Fecha</th>
      <th style="text-align:center">Hora</th>
      <th style="text-align:center">Id</th>
      <th style="text-align:center">Id Fg</th>
    </tr>
  </thead>
  <tbody>
<?php
$total_total_venta_producto    = 0;
$total_ganancia_venta_sum      = 0;

$sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_compra_producto, tbl15_venta_producto.total_compra_producto, tbl15_venta_producto.precio_venta_producto, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, 
tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, 
tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_venta_producto.cod_administrador,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, tbl15_tercero.identificacion_tercero, 
tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar, tbl15_venta_producto.comision_ptj, tbl15_venta_producto.und_producto, tbl15_venta_producto.cod_estado_cava
FROM tbl15_tercero RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_venta_producto ON tbl15_cliente.cod_cliente = tbl15_venta_producto.cod_cliente) 
ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_producto_barra = '$cod_producto_barra') $filtro_consulta_tercero_rel
ORDER BY tbl15_venta_producto.cod_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

  $cod_venta_producto            = $info_cliente['cod_venta_producto'];
  $cod_producto                  = $info_cliente['cod_producto'];
  $cod_producto_barra            = $info_cliente['cod_producto_barra'];
  $cod_info_factura_venta        = $info_cliente['cod_info_factura_venta'];
  $cod_factura                   = $info_cliente['cod_factura'];
  $cod_historia_clinica          = $info_cliente['cod_historia_clinica'];
  $nombre_producto               = $info_cliente['nombre_producto'];
  $und_venta                     = $info_cliente['und_venta'];
  $precio_compra_producto        = $info_cliente['precio_compra_producto'];
  $total_compra_producto         = $info_cliente['total_compra_producto'];
  $precio_venta_producto         = $info_cliente['precio_venta_producto'];
  $total_venta_producto          = $info_cliente['total_venta_producto'];
  $nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
  $nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
  $nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
  $nombre_via_administracion     = $info_cliente['nombre_via_administracion'];
  $nombre_frec_duracion          = $info_cliente['nombre_frec_duracion'];
  $fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
  $fecha_hora_venta_producto     = $info_cliente['fecha_hora_venta_producto'];
  $cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
  $cod_administrador_db          = $info_cliente['cod_administrador'];
  $nombre_propietario            = $info_cliente['nombre1_tercero'].' '.$info_cliente['apellido1_tercero'].' ('.$info_cliente['identificacion_tercero'].')';
  $comision_ptj                  = $info_cliente['comision_ptj'];
  $total_comision                = ($total_venta_producto * ($comision_ptj/100));
  $und_producto                  = $info_cliente['und_producto'];

  $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
  $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
  $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

  $cuenta                        = $datos_administrador['cuenta'];

  if ($total_compra_producto == '0') { $total_compra_producto = 1; } else { $total_compra_producto = $info_cliente['total_compra_producto']; }
  if ($total_venta_producto == '0') { $total_venta_producto = 1; } else { $total_venta_producto = $info_cliente['total_venta_producto']; }

  $sql_dependencia = "SELECT retefuente_ptj, total_precio_venta, total_retefuente FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
  $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
  $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

  $retefuente_ptj                = $datos_dependencia['retefuente_ptj'];
  $total_precio_venta            = $datos_dependencia['total_precio_venta'];
  $total_retefuente              = $datos_dependencia['total_retefuente'];
?>
    <tr>
      <td style="text-align:center"><a href="../admin/edit_factura_venta.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta; ?>"><img src="../imagenes/ver.png"></a></td>
      <td style="text-align:center"><?php echo $cod_factura?></td>
      <td style="text-align:left"><?php echo $nombre_propietario?></td>
      <td style="text-align:left"><?php echo $nombre_producto?> (<?php echo $retefuente_ptj?>%)</td>
      <td style="text-align:right"><?php echo number_format(abs($total_venta_producto), 0, ",", ".")?></td>
      <td style="text-align:center"><?php echo $cuenta?></td>
      <td style="text-align:center"><?php echo $fecha_ymd_venta_producto?></td>
      <td style="text-align:center"><?php echo $fecha_hora_venta_producto?></td>
      <td style="text-align:center"><?php echo $cod_venta_producto?></td>
      <td style="text-align:center"><?php echo $cod_info_factura_venta?></td>
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


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: center;"><div>

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
      <th style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;">REPORTE DE RETEFUENTE VENTA</th>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center;"><=======================================></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
      <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;">CLIENTE:</th>
      <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;"><?php echo $nombre_cliente ?></th>
  </tr>
  <tr>
      <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;">FECHA INICIAL:</th>
      <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;"><?php echo $fecha_ymd_venta_producto_ini ?></th>
  </tr>
  <tr>
      <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;">FECHA FINAL:</th>
      <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;"><?php echo $fecha_ymd_venta_producto_fin ?></th>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center;"><=======================================></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
    <tr>
      <th style="text-align:center">Cliente</th>
      <th style="text-align:center">Concepto</th>
      <th style="text-align:center">Retefuente</th>
    </tr>
  <tbody>
<?php
$total_total_venta_producto    = 0;
$total_ganancia_venta_sum      = 0;

$sql_cliente = "SELECT tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.nombre_producto, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.identificacion_tercero
FROM tbl15_tercero RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_venta_producto ON tbl15_cliente.cod_cliente = tbl15_venta_producto.cod_cliente) 
ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_producto_barra = '$cod_producto_barra') $filtro_consulta_tercero_rel
ORDER BY tbl15_venta_producto.cod_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

  $cod_info_factura_venta        = $info_cliente['cod_info_factura_venta'];
  $nombre_producto               = $info_cliente['nombre_producto'];
  $total_venta_producto          = $info_cliente['total_venta_producto'];
  $nombre_propietario            = $info_cliente['nombre1_tercero'].' ('.$info_cliente['identificacion_tercero'].')';

  $sql_dependencia = "SELECT retefuente_ptj, total_precio_venta, total_retefuente FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
  $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
  $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

  $retefuente_ptj                = $datos_dependencia['retefuente_ptj'];
  $total_precio_venta            = $datos_dependencia['total_precio_venta'];
  $total_retefuente              = $datos_dependencia['total_retefuente'];

  if ($total_venta_producto == '0') { $total_venta_producto = 1; } else { $total_venta_producto = $info_cliente['total_venta_producto']; }
?>
    <tr>
      <td style="text-align:left"><?php echo $nombre_propietario?></td>
      <td style="text-align:left"><?php echo $nombre_producto?> (<?php echo $retefuente_ptj?>%)</td>
      <td style="text-align:right"><?php echo number_format(abs($total_venta_producto), 0, ",", ".")?></td>
    </tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center;"><=======================================></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;">Total Retefuente:</th>
    <th style="text-align: right; width: 48%; font-family: Courier; font-size:8pt;"><?php echo number_format(abs($total_suma_venta_producto), 0, ",", ".") ?></th>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center;"><=======================================></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Helvetica; font-size:8pt;">
  <tr>
    <th style="text-align: center; width: 98%; font-family: Helvetica; font-size:8pt;"><== Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?> ==></th>
  </tr>
  <tr>
    <th style="text-align: center; width: 98%; font-family: Helvetica; font-size:8pt;"><== <?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?> ==></th>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center;"><=======================================></td>
  </tr>
</table>

<div>