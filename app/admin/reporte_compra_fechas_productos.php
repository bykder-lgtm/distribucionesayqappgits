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
<a class="btn btn-primary" href="#"><h6>Reporte Compras Por Rango de Fechas</h6></a>
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
if ($cod_seguridad == '1') {
$condicion_inventario = 'cod_tipo_inventario = "1" OR cod_tipo_inventario = "2"';
$condicion_vendedor = '';
$condicion_vendedor_option = '<option value="0" $seleccionado >TODOS</option>';
} else {
if ($cod_estado_facturacion_venta_acceso_facturas_otros_user == '1') {
$condicion_inventario = 'cod_tipo_inventario = "1"';
$condicion_vendedor = '';
$condicion_vendedor_option = '<option value="0" $seleccionado >TODOS</option>';
} else {
$condicion_inventario = 'cod_tipo_inventario = "1"';
$condicion_vendedor = 'WHERE cod_administrador = '.$cod_administrador;
$condicion_vendedor_option = '';
}
}

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
$fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$cod_administrador                       = intval($_GET['cod_administrador']);
$fecha                                   = date("Y-m-d");

$total_productos                         = count($_GET['cod_producto_barra']);
$filtro_cod_producto_barra               = "";
$filtro_cod_producto_barra_rel           = "";
$contador                                = 0;
$filtro_cod_producto_barra              .= "";


if ($cod_estado_facturacion_venta_acceso_facturas_otros_user == '1') {
if ($cod_administrador==0) {
$filtro_consulta_vendedor = "";
$filtro_consulta_vendedor_rel = "";
} else {
$filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
$filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
}
} else {
$filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
$filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
}


foreach ($_GET['cod_producto_barra'] as &$valor_cod_producto_barra) {
$cod_producto_barra           = $valor_cod_producto_barra;
$contador ++;

    if ($contador > 1) {
      $filtro_cod_producto_barra        .= " OR (cod_producto_barra LIKE '".$cod_producto_barra."')";
      $filtro_cod_producto_barra_rel    .= " OR (tbl15_venta_producto.cod_producto_barra LIKE '".$cod_producto_barra."')";
    } else {
      $filtro_cod_producto_barra        .= " AND ((cod_producto_barra LIKE '".$cod_producto_barra."')";
      $filtro_cod_producto_barra_rel    .= " AND ((tbl15_venta_producto.cod_producto_barra LIKE '".$cod_producto_barra."')";
    }
}
$filtro_cod_producto_barra              .= ")";
$filtro_cod_producto_barra_rel          .= ")";
unset($valor_cod_producto_barra);

} else {
$fecha_ymd_venta_producto_ini            = date("Y-m-d");
$fecha_ymd_venta_producto_fin            = date("Y-m-d");
$cod_administrador                       = 0;
$fecha                                   = date("Y-m-d");

if ($cod_estado_facturacion_venta_acceso_facturas_otros_user == '1') {
if ($cod_administrador==0) {
$filtro_consulta_vendedor = "";
$filtro_consulta_vendedor_rel = "";
} else {
$filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
$filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
}
} else {
$filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
$filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
}


}
if ($cod_administrador==0) {
$cuenta_get                                  = 'TODOS';
} else {
$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta_get                                  = $datos_administrador['cuenta'];
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
    <td style="text-align:right;">USUARIO: </td>
    <td style="text-align:left;">
        <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_administrador)) { echo $condicion_vendedor_option; } else { echo $condicion_vendedor_option; }
            $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador $condicion_vendedor ORDER BY cod_administrador ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_administrador'];
            $nombre = $datos2['cuenta'];
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
    <td style="text-align:right;">PRODUCTO: </td>
    <td style="text-align:left;">
      <select name="cod_producto_barra[]" id="cod_producto_barra" data-placeholder="Productos" class="chosen-select" multiple tabindex="4">
      <?php $consulta2_sql = "SELECT cod_producto, cod_producto_barra, nombre_producto FROM tbl15_producto ORDER BY nombre_producto ASC";
      $consulta2 = mysqlI_query($conectar, $consulta2_sql);
      while ($datos2 = mysqlI_fetch_assoc($consulta2)) {
      $cod_producto         = $datos2['cod_producto'];
      $cod_producto_barra   = $datos2['cod_producto_barra'];
      $nombre_producto      = $datos2['nombre_producto']; ?>
      <option value="<?php echo $cod_producto_barra ?>"><?php echo $cod_producto_barra.' | '.$nombre_producto ?></option>
      <?php } ?>
      </select>
    </td>
  </tr>
  <tr>
    <td style="text-align:right;"></td>
    <td style="text-align:left;"><button type="submit">Ver Registros</button></td>
  </tr>
</table>
</form>
<?php
if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
$motivo               = 'TODOS';
$fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$fecha                                   = date("Y/m/d");
$pagina                                  = $_SERVER['PHP_SELF'];
$contado                                 = '1';
$credito                                 = '2';
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($cod_administrador==0) {
  $sql_total_compra = "SELECT SUM(total_compra_producto) AS total_suma_compra_producto, SUM(precio_venta_producto * und_compra) AS total_venta_producto_sum, 
  SUM(total_costo_producto) AS total_costo_producto, SUM(total_compra_producto * (comision_ptj/100)) AS total_comision, 
  SUM(und_compra) AS total_suma_und_compra FROM tbl15_factura_compra_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_cod_producto_barra";
  $consulta_total_compra = mysqli_query($conectar, $sql_total_compra) or die(mysqli_error($conectar));
  $datos_total_compra = mysqli_fetch_assoc($consulta_total_compra);

  $total_suma_compra_producto       = $datos_total_compra['total_suma_compra_producto'];
  $total_costo_producto             = $datos_total_compra['total_costo_producto'];
  $total_ganancia                   = $total_suma_compra_producto - $total_costo_producto;
  $total_comision_compra            = $datos_total_compra['total_comision'];
  $total_suma_und_compra            = $datos_total_compra['total_suma_und_compra'];
  $total_venta_producto_sum         = $datos_total_compra['total_venta_producto_sum'];

  $sql_total_compra_contado = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(total_costo_producto) AS total_costo_producto
  FROM tbl15_factura_compra_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_cod_producto_barra AND (cod_tipo_pago = '$contado')";
  $consulta_total_compra_contado = mysqli_query($conectar, $sql_total_compra_contado) or die(mysqli_error($conectar));
  $datos_total_compra_contado = mysqli_fetch_assoc($consulta_total_compra_contado);

  $total_compra_producto_contado    = $datos_total_compra_contado['total_compra_producto'];
  $total_costo_producto_contado    = $datos_total_compra_contado['total_costo_producto'];

  $sql_total_compra_credito = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(total_costo_producto) AS total_costo_producto 
  FROM tbl15_factura_compra_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_cod_producto_barra AND (cod_tipo_pago = '$credito')";
  $consulta_total_compra_credito = mysqli_query($conectar, $sql_total_compra_credito) or die(mysqli_error($conectar));
  $datos_total_compra_credito = mysqli_fetch_assoc($consulta_total_compra_credito);

  $total_compra_producto_credito    = $datos_total_compra_credito['total_compra_producto'];
  $total_costo_producto_credito    = $datos_total_compra_credito['total_costo_producto'];

  $sql_total_cuenta_credito_abono = "SELECT SUM(abonado) AS total_cuenta_credito_abonado FROM tbl15_cuentas_cobrar_abonos 
  WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
  $consulta_cuenta_credito_abono = mysqli_query($conectar, $sql_total_cuenta_credito_abono) or die(mysqli_error($conectar));
  $datos_cuenta_credito_abono = mysqli_fetch_assoc($consulta_cuenta_credito_abono);

  $total_cuenta_credito_abonado    = $datos_cuenta_credito_abono['total_cuenta_credito_abonado'];

  $total_caja_compra_fisica         = $total_compra_producto_contado + $total_cuenta_credito_abonado;
} else {
  $sql_total_compra = "SELECT SUM(total_compra_producto) AS total_suma_compra_producto, SUM(precio_venta_producto * und_compra) AS total_venta_producto_sum,
  SUM(total_costo_producto) AS total_costo_producto, SUM(total_compra_producto * (comision_ptj/100)) AS total_comision, 
  SUM(und_compra) AS total_suma_und_compra FROM tbl15_factura_compra_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_cod_producto_barra AND (cod_administrador = '$cod_administrador')";
  $consulta_total_compra = mysqli_query($conectar, $sql_total_compra) or die(mysqli_error($conectar));
  $datos_total_compra = mysqli_fetch_assoc($consulta_total_compra);

  $total_suma_compra_producto       = $datos_total_compra['total_suma_compra_producto'];
  $total_costo_producto             = $datos_total_compra['total_costo_producto'];
  $total_ganancia                   = $total_suma_compra_producto - $total_costo_producto;
  $total_comision_compra            = $datos_total_compra['total_comision'];
  $total_suma_und_compra            = $datos_total_compra['total_suma_und_compra'];
  $total_venta_producto_sum         = $datos_total_compra['total_venta_producto_sum'];

  $sql_total_compra_contado = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(total_costo_producto) AS total_costo_producto 
  FROM tbl15_factura_compra_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '$contado') $filtro_cod_producto_barra AND (cod_administrador = '$cod_administrador')";
  $consulta_total_compra_contado = mysqli_query($conectar, $sql_total_compra_contado) or die(mysqli_error($conectar));
  $datos_total_compra_contado = mysqli_fetch_assoc($consulta_total_compra_contado);

  $total_compra_producto_contado    = $datos_total_compra_contado['total_compra_producto'];
  $total_costo_producto_contado    = $datos_total_compra_contado['total_costo_producto'];

  $sql_total_compra_credito = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(total_costo_producto) AS total_costo_producto 
  FROM tbl15_factura_compra_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '$credito') $filtro_cod_producto_barra AND (cod_administrador = '$cod_administrador')";
  $consulta_total_compra_credito = mysqli_query($conectar, $sql_total_compra_credito) or die(mysqli_error($conectar));
  $datos_total_compra_credito = mysqli_fetch_assoc($consulta_total_compra_credito);

  $total_compra_producto_credito    = $datos_total_compra_credito['total_compra_producto'];
  $total_costo_producto_credito    = $datos_total_compra_credito['total_costo_producto'];

  $sql_total_cuenta_credito_abono = "SELECT SUM(abonado) AS total_cuenta_credito_abonado FROM tbl15_cuentas_cobrar_abonos 
  WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_administrador = '$cod_administrador')";
  $consulta_cuenta_credito_abono = mysqli_query($conectar, $sql_total_cuenta_credito_abono) or die(mysqli_error($conectar));
  $datos_cuenta_credito_abono = mysqli_fetch_assoc($consulta_cuenta_credito_abono);

  $total_cuenta_credito_abonado    = $datos_cuenta_credito_abono['total_cuenta_credito_abonado'];

  $total_caja_compra_fisica         = $total_compra_producto_contado + $total_cuenta_credito_abonado;
}
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<form action="" method="GET">
<table class="table table-striped">
<tr>
<td style="text-align:center;">USUARIO: <?php echo $cuenta_get ?></td>
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
    <th style="text-align:center;"><a href="#">Total Unidades</a></th>
    <th style="text-align:center;"><a href="#">Total P.Compra</a></th>
    <th style="text-align:center;"><a href="#">Total P.Venta</a></th>
    <th style="text-align:center;"><a href="#">Imprimir</th>
  </tr>
  <tr>
    <td style="text-align:center;"><?php echo number_format($total_suma_und_compra, 0, ",", ".") ?></td>
    <td style="text-align:center;"><?php echo number_format($total_suma_compra_producto, 0, ",", ".") ?></td>
    <td style="text-align:center;"><?php echo number_format($total_venta_producto_sum, 0, ",", ".") ?></td>
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></td>
  </tr>
</table>
</div>

<!--
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:left"><a href="#">FORMA DE PAGO</a></th>
<th style="text-align:left"><a href="#">TOTAL</a></th>
</tr>
</thead>
<tbody>
<?php
if ($cod_administrador==0) {
$sql_total_forma_pago = "SELECT Sum(tbl15_factura_compra_producto.total_compra_producto) AS suma_total_compra_producto, tbl15_tipo_forma_pago.nombre_tipo_forma_pago
FROM tbl15_tipo_forma_pago RIGHT JOIN tbl15_factura_compra_producto ON tbl15_tipo_forma_pago.cod_tipo_forma_pago = tbl15_factura_compra_producto.cod_tipo_forma_pago
WHERE (tbl15_factura_compra_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_cod_producto_barra
GROUP BY tbl15_tipo_forma_pago.cod_tipo_forma_pago";
} else {
$sql_total_forma_pago = "SELECT Sum(tbl15_factura_compra_producto.total_compra_producto) AS suma_total_compra_producto, tbl15_tipo_forma_pago.nombre_tipo_forma_pago
FROM tbl15_tipo_forma_pago RIGHT JOIN tbl15_factura_compra_producto ON tbl15_tipo_forma_pago.cod_tipo_forma_pago = tbl15_factura_compra_producto.cod_tipo_forma_pago
WHERE (tbl15_factura_compra_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tbl15_factura_compra_producto.cod_administrador = '$cod_administrador')
$filtro_cod_producto_barra
GROUP BY tbl15_tipo_forma_pago.cod_tipo_forma_pago";
}
$consulta_total_forma_pago = mysqli_query($conectar, $sql_total_forma_pago) or die(mysqli_error($conectar));
while ($datos_total_forma_pago = mysqli_fetch_assoc($consulta_total_forma_pago)) {

$nombre_tipo_forma_pago        = $datos_total_forma_pago['nombre_tipo_forma_pago'];
$suma_total_compra_producto     = $datos_total_forma_pago['suma_total_compra_producto'];
?>
<tr>
<td style="text-align:left"><?php echo $nombre_tipo_forma_pago?></td>
<td style="text-align:left"><?php echo number_format($suma_total_compra_producto, 0, ",", ".")?></td>
</tr>
<?php } ?>
</tbody>
</table>
-->
<br>
<div class="table-responsive">
<table class="table table-striped">
<thead>
  <tr>
    <th style="text-align:center">Ver</th>
    <th style="text-align:center">Factura</th>
    <th style="text-align:center">Cod</th>
    <th style="text-align:center">Concepto</th>
    <th style="text-align:center">Proveedor</th>
    <th style="text-align:center">Unidades</th>
    <th style="text-align:center">P.Compra</th>
    <th style="text-align:center">Total Compra</th>
    <th style="text-align:center">P.Venta</th>
    <?php if ($cod_estado_ptj_comision_global == '1') { ?>
    <th style="text-align:center">% Comision</th>
    <th style="text-align:center">$ Comision</th>
    <?php } ?>
    <th style="text-align:center">Tipo</th>
    <th style="text-align:center">Cuenta</th>
    <th style="text-align:center">Fecha</th>
    <th style="text-align:center">Hora</th>
    <?php if ($cod_seguridad==1) { ?><th style="text-align:center">Inv</th><?php } ?>
    <th style="text-align:center">Id</th>
  </tr>
</thead>
<tbody>
<?php
if ($cod_administrador==0) {
$sql_cliente = "SELECT tbl15_factura_compra_producto.cod_factura_compra_producto, tbl15_factura_compra_producto.cod_producto, tbl15_factura_compra_producto.cod_producto_barra, 
tbl15_factura_compra_producto.cod_info_factura_compra, tbl15_factura_compra_producto.cod_factura, tbl15_factura_compra_producto.cod_historia_clinica, tbl15_factura_compra_producto.nombre_producto, 
tbl15_factura_compra_producto.und_compra, tbl15_factura_compra_producto.precio_compra_producto, tbl15_factura_compra_producto.total_compra_producto, 
tbl15_factura_compra_producto.precio_costo_producto, tbl15_factura_compra_producto.total_costo_producto, tbl15_factura_compra_producto.precio_venta_producto, 
tbl15_factura_compra_producto.total_venta_producto, tbl15_factura_compra_producto.nombre_tipo_producto, tbl15_factura_compra_producto.nombre_tipo_unidad_medida, 
tbl15_factura_compra_producto.nombre_tipo_presentacion, tbl15_factura_compra_producto.nombre_via_administracion, tbl15_factura_compra_producto.nombre_frec_duracion, 
tbl15_factura_compra_producto.fecha_ymd_venta_producto, tbl15_factura_compra_producto.fecha_seg_venta_producto, tbl15_factura_compra_producto.cod_administrador,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_factura_compra_producto.cuenta, tbl15_factura_compra_producto.cod_tipo_cobrar, tbl15_factura_compra_producto.comision_ptj, tbl15_factura_compra_producto.und_producto
FROM tbl15_tercero RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_factura_compra_producto ON tbl15_cliente.cod_cliente = tbl15_factura_compra_producto.cod_cliente) 
ON tbl15_tercero.cod_tercero = tbl15_factura_compra_producto.cod_tercero 
WHERE (tbl15_factura_compra_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_cod_producto_barra 
ORDER BY tbl15_factura_compra_producto.cod_factura_compra_producto DESC";
} else {
$sql_cliente = "SELECT tbl15_factura_compra_producto.cod_factura_compra_producto, tbl15_factura_compra_producto.cod_producto, tbl15_factura_compra_producto.cod_producto_barra, 
tbl15_factura_compra_producto.cod_info_factura_compra, tbl15_factura_compra_producto.cod_factura, tbl15_factura_compra_producto.cod_historia_clinica, tbl15_factura_compra_producto.nombre_producto, 
tbl15_factura_compra_producto.und_compra, tbl15_factura_compra_producto.precio_compra_producto, tbl15_factura_compra_producto.total_compra_producto, 
tbl15_factura_compra_producto.precio_costo_producto, tbl15_factura_compra_producto.total_costo_producto, tbl15_factura_compra_producto.precio_venta_producto, 
tbl15_factura_compra_producto.total_venta_producto, tbl15_factura_compra_producto.nombre_tipo_producto, tbl15_factura_compra_producto.nombre_tipo_unidad_medida, 
tbl15_factura_compra_producto.nombre_tipo_presentacion, tbl15_factura_compra_producto.nombre_via_administracion, tbl15_factura_compra_producto.nombre_frec_duracion, 
tbl15_factura_compra_producto.fecha_ymd_venta_producto, tbl15_factura_compra_producto.fecha_seg_venta_producto, tbl15_factura_compra_producto.cod_administrador,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_factura_compra_producto.cuenta, tbl15_factura_compra_producto.cod_tipo_cobrar, tbl15_factura_compra_producto.comision_ptj, tbl15_factura_compra_producto.und_producto
FROM tbl15_tercero RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_factura_compra_producto ON tbl15_cliente.cod_cliente = tbl15_factura_compra_producto.cod_cliente) 
ON tbl15_tercero.cod_tercero = tbl15_factura_compra_producto.cod_tercero 
WHERE (tbl15_factura_compra_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_cod_producto_barra 
AND (tbl15_factura_compra_producto.cod_administrador = '$cod_administrador')
ORDER BY tbl15_factura_compra_producto.cod_factura_compra_producto DESC";
}
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

  $cod_factura_compra_producto   = $info_cliente['cod_factura_compra_producto'];
  $cod_producto                  = $info_cliente['cod_producto'];
  $cod_producto_barra            = $info_cliente['cod_producto_barra'];
  $cod_info_factura_compra       = $info_cliente['cod_info_factura_compra'];
  $cod_factura                   = $info_cliente['cod_factura'];
  $cod_historia_clinica          = $info_cliente['cod_historia_clinica'];
  $nombre_producto               = $info_cliente['nombre_producto'];
  $und_compra                    = $info_cliente['und_compra'];
  $precio_compra_producto        = $info_cliente['precio_compra_producto'];
  $total_compra_producto         = $info_cliente['total_compra_producto'];
  $precio_costo_producto         = $info_cliente['precio_costo_producto'];
  $total_costo_producto          = $info_cliente['total_costo_producto'];
  $precio_venta_producto         = $info_cliente['precio_venta_producto'];
  $total_venta_producto          = $info_cliente['total_venta_producto'];
  $nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
  $nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
  $nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
  $nombre_via_administracion     = $info_cliente['nombre_via_administracion'];
  $nombre_frec_duracion          = $info_cliente['nombre_frec_duracion'];
  $fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
  $fecha_seg_venta_producto      = $info_cliente['fecha_seg_venta_producto'];
  $fecha_hora                    = date("H:i:s", $fecha_seg_venta_producto);
  //$cuenta                        = $info_cliente['cuenta'];
  $cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
  $cod_administrador_db          = $info_cliente['cod_administrador'];
  $nombre_propietario            = $info_cliente['nombre1_tercero'].' '.$info_cliente['apellido1_tercero'];
  $comision_ptj                  = $info_cliente['comision_ptj'];
  $total_comision                = ($total_venta_producto * ($comision_ptj/100));
  $und_producto                  = $info_cliente['und_producto'];

  $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
  $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
  $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

  $cuenta                        = $datos_administrador['cuenta'];
?>
  <tr>
    <td style="text-align:center"><a href="../admin/ver_factura_compra.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra; ?>"><img src="../imagenes/ver.png"></a></td>
    <td style="text-align:center"><?php echo $cod_factura?></td>
    <td style="text-align:center"><?php echo $cod_producto_barra?></td>
    <td style="text-align:left"><?php echo $nombre_producto?></td>
    <td style="text-align:left"><?php echo $nombre_propietario?></td>
    <td style="text-align:center"><?php echo $und_compra?></td>
    <td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", ".")?></td>
    <td style="text-align:right"><?php echo number_format($total_compra_producto, 0, ",", ".")?></td>
    <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".")?></td>
    <?php if ($cod_estado_ptj_comision_global == '1') { ?>
    <td style="text-align:center"><?php echo $comision_ptj.'%' ?></td>
    <td style="text-align:right"><?php echo number_format($total_comision, 0, ",", ".")?></td>
    <?php } ?>
    <td style="text-align:center"><?php echo $nombre_tipo_producto?></td>
    <td style="text-align:center"><?php echo $cuenta?></td>
    <td style="text-align:center"><?php echo $fecha_ymd_venta_producto?></td>
    <td style="text-align:center"><?php echo $fecha_hora?></td>
    <?php if ($cod_seguridad==1) { ?><td style="text-align:center"><?php echo $und_producto?></td><?php } ?>
    <td style="text-align:center"><?php echo $cod_factura_compra_producto?></td>
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
      <th style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;">REPORTE DE COMPRA POR PRODUCTO</th>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center;"><=======================================></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
      <th style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><?php echo $nombre_producto ?> | <?php echo $cod_producto_barra ?></th>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
      <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;">FECHA INICIAL:</th>
      <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;"><?php echo $fecha_ymd_venta_producto_ini ?></th>
  </tr>
  <tr>
      <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;">FECHA FINAL:</th>
      <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;"><?php echo $fecha_ymd_venta_producto_fin ?></th>
  </tr>
  <tr>
      <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;">USUARIO:</th>
      <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;"><?php echo $cuenta_get ?></th>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center;"><=======================================></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;">Total Unidades:</th>
    <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;"><?php echo number_format($total_suma_und_compra, 0, ",", ".") ?></th>
  </tr>
  <tr>
    <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;">Total P.Compra:</th>
    <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;"><?php echo number_format($total_suma_compra_producto, 0, ",", ".") ?></th>
  </tr>
  <tr>
    <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;">Total P.Venta:</th>
    <th style="text-align: left; width: 48%; font-family: Courier; font-size:8pt;"><?php echo number_format($total_venta_producto_sum, 0, ",", ".") ?></th>
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