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

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
    $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
    $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
    $cod_administrador                       = intval($_GET['cod_administrador']);
    $cod_tercero                             = intval($_GET['cod_tercero']);
    $cod_tipo_pago                           = intval($_GET['cod_tipo_pago']);
    $cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
    $cod_dependencia                         = intval($_GET['cod_dependencia']);
    $nombre_tipo_compra                      = addslashes($_GET['nombre_tipo_compra']);
    $fecha                                   = date("Y-m-d");
} else {
    $fecha_ymd_venta_producto_ini            = date("Y-m-d");
    $fecha_ymd_venta_producto_fin            = date("Y-m-d");
    $cod_administrador                       = 0;
    $cod_tercero                             = 0;
    $cod_tipo_pago                           = 0;
    $cod_tipo_forma_pago                     = 0;
    $cod_dependencia                         = 0;
    $nombre_tipo_compra                      = "0";
    $fecha                                   = date("Y-m-d");
}


if ($cod_administrador==0) {
    $cuenta_get                                  = 'TODOS';
} else {
    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta_get                                  = $datos_administrador['cuenta'];
}

if ($cod_tercero==0) {
    $nombre_cliente                                  = 'TODOS';
} else {
    $sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido2_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

    $nombre_cliente                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido2_tercero'];
}

if ($cod_tipo_pago==0) {
    $nombre_tipo_pago_get                             = 'TODOS';
} else {
    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago_get                             = $datos_tipo_pago['nombre_tipo_pago'];
}

if ($cod_tipo_forma_pago==0) {
    $nombre_tipo_forma_pago_get                        = 'TODOS';
} else {
    $sql_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
    $datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

    $nombre_tipo_forma_pago_get                        = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
}

if ($cod_dependencia==0) {
    $nombre_dependencia_get                             = 'TODOS';
} else {
    $sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
    $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
    $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

    $nombre_dependencia_get                             = $datos_dependencia['nombre_dependencia'];
}

if ($nombre_tipo_compra=='0') {
    $nombre_tipo_compra_get                            = 'TODOS';
} else {
    $sql_tipo_factura  = "SELECT nombre_tipo_compra FROM tbl15_tipo_compra WHERE nombre_tipo_compra = '$nombre_tipo_compra'";
    $consulta_tipo_factura  = mysqli_query($conectar, $sql_tipo_factura ) or die(mysqli_error($conectar));
    $datos_tipo_factura  = mysqli_fetch_assoc($consulta_tipo_factura );

    $nombre_tipo_compra_get                            = $datos_tipo_factura['nombre_tipo_compra'];
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
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">TERCERO</th>
    <th style="text-align:center;">DEPENDENCIA</th>
    <th style="text-align:center;">TIPO PAGO</th>
  </tr>
  <td style="text-align:center;">
    <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
        <?php if (isset($cod_administrador)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo "<option value='0' $seleccionado >TODOS</option>"; }
        $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador ORDER BY cod_administrador ASC";
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_administrador'];
        $nombre = $datos2['cuenta'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>
    <td style="text-align:center;">
        <select name="cod_tercero" id="cod_tercero" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE nombre_tipo_tercero = 'PROVEEDOR' ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['apellido1_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;">
        <select name="cod_dependencia" id="cod_dependencia" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_dependencia)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia ORDER BY nombre_dependencia ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_dependencia) AND $cod_dependencia == $datos2['cod_dependencia']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_dependencia'];
            $nombre = $datos2['nombre_dependencia'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;">
        <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_pago)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago ORDER BY cod_tipo_pago ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_pago) AND $cod_tipo_pago == $datos2['cod_tipo_pago']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_pago'];
            $nombre = $datos2['nombre_tipo_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
  </tr>
  <tr>
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO FACTURA</th>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <td style="text-align:center;">
        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_forma_pago)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_forma_pago'];
            $nombre = $datos2['nombre_tipo_forma_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;">
        <select name="nombre_tipo_compra" id="nombre_tipo_compra" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_compra)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT nombre_tipo_compra FROM tbl15_tipo_compra ORDER BY nombre_tipo_compra ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_compra) AND $nombre_tipo_compra == $datos2['nombre_tipo_compra']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_compra'];
            $nombre = $datos2['nombre_tipo_compra'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" required/></td>
    <td style="text-align:center;"></td>
  </tr>
</table>
<div class="actions">
<input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
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
$efectivo                                = '1';
$cod_servicio_propina                    = '22222222';
$cod_producto_barra                      = $cod_servicio_propina;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($cod_administrador==0) {
    $filtro_consulta_vendedor = "";
    $filtro_consulta_vendedor_rel = "";
} else {
    $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
    $filtro_consulta_vendedor_rel = "AND (tbl15_factura_compra_producto.cod_administrador = '$cod_administrador')";
}

if ($cod_tercero==0) {
    $filtro_consulta_tercero = "";
    $filtro_consulta_tercero_rel = "";
    $filtro_consulta_tercero_productos_rel = "";
} else {
    $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
    $filtro_consulta_tercero_rel = "AND (tbl15_info_factura_compra.cod_tercero = '$cod_tercero')";
    $filtro_consulta_tercero_productos_rel = "AND (tbl15_factura_compra_producto.cod_tercero = '$cod_tercero')";
}

if ($cod_tipo_pago==0) {
    $filtro_consulta_tipo_pago = "";
    $filtro_consulta_tipo_pago_rel = "";
} else {
    $filtro_consulta_tipo_pago = "AND (cod_tipo_pago = '$cod_tipo_pago')";
    $filtro_consulta_tipo_pago_rel = "AND (tbl15_factura_compra_producto.cod_tipo_pago = '$cod_tipo_pago')";
}

if ($cod_tipo_forma_pago==0) {
    $filtro_consulta_tipo_forma_pago = "";
    $filtro_consulta_tipo_forma_pago_rel = "";
} else {
    $filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    $filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_factura_compra_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
}

if ($cod_dependencia==0) {
    $filtro_consulta_dependencia = "";
    $filtro_consulta_dependencia_rel = "";
} else {
    $filtro_consulta_dependencia = "AND (cod_dependencia = '$cod_dependencia')";
    $filtro_consulta_dependencia_rel = "AND (tbl15_factura_compra_producto.cod_dependencia = '$cod_dependencia')";
}

if ($nombre_tipo_compra=='0') {
    $filtro_consulta_nombre_tipo_compra = "";
    $filtro_consulta_nombre_tipo_compra_rel = "";
    $filtro_consulta_nombre_tipo_compra_info_rel = "";
} else {
    $filtro_consulta_nombre_tipo_compra = "AND (nombre_tipo_compra = '$nombre_tipo_compra')";
    $filtro_consulta_nombre_tipo_compra_rel = "AND (tbl15_factura_compra_producto.nombre_tipo_compra = '$nombre_tipo_compra')";
    $filtro_consulta_nombre_tipo_compra_info_rel = "AND (tbl15_info_factura_compra.nombre_tipo_compra = '$nombre_tipo_compra')";
}

/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta = "SELECT SUM(total_compra_producto) AS total_suma_venta_producto, SUM(total_costo_producto) AS total_costo_producto, 
SUM(total_compra_producto * (comision_ptj/100)) AS total_comision 
FROM tbl15_factura_compra_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_compra";
$consulta_total_venta = mysqli_query($conectar, $sql_total_venta) or die(mysqli_error($conectar));
$datos_total_venta = mysqli_fetch_assoc($consulta_total_venta);

$total_suma_venta_producto       = $datos_total_venta['total_suma_venta_producto'];
$total_costo_producto            = $datos_total_venta['total_costo_producto'];
$total_ganancia                  = $total_suma_venta_producto - $total_costo_producto;
$total_comision_venta            = $datos_total_venta['total_comision'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta_contado_efectivo = "SELECT SUM(total_compra_producto) AS total_compra_producto_contado_efectivo, SUM(total_costo_producto) AS total_costo_producto
FROM tbl15_factura_compra_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_compra";
$consulta_total_venta_contado_efectivo = mysqli_query($conectar, $sql_total_venta_contado_efectivo) or die(mysqli_error($conectar));
$datos_total_venta_contado_efectivo = mysqli_fetch_assoc($consulta_total_venta_contado_efectivo);

$total_compra_producto_contado_efectivo    = $datos_total_venta_contado_efectivo['total_compra_producto_contado_efectivo'];
$total_costo_producto_contado             = $datos_total_venta_contado_efectivo['total_costo_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta_contado = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(total_costo_producto) AS total_costo_producto
FROM tbl15_factura_compra_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (cod_tipo_pago = '$contado') $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_compra";
$consulta_total_venta_contado = mysqli_query($conectar, $sql_total_venta_contado) or die(mysqli_error($conectar));
$datos_total_venta_contado = mysqli_fetch_assoc($consulta_total_venta_contado);

$total_compra_producto_contado    = $datos_total_venta_contado['total_compra_producto'];
$total_costo_producto_contado    = $datos_total_venta_contado['total_costo_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta_credito = "SELECT SUM(total_compra_producto) AS total_compra_producto, SUM(total_costo_producto) AS total_costo_producto 
FROM tbl15_factura_compra_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (cod_tipo_pago = '$credito') $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_compra";
$consulta_total_venta_credito = mysqli_query($conectar, $sql_total_venta_credito) or die(mysqli_error($conectar));
$datos_total_venta_credito = mysqli_fetch_assoc($consulta_total_venta_credito);

$total_compra_producto_credito    = $datos_total_venta_credito['total_compra_producto'];
$total_costo_producto_credito    = $datos_total_venta_credito['total_costo_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<table class="table table-striped">
<tr>
<td style="text-align:left;">VENDEDOR: <?php echo $cuenta_get ?></td>
<td style="text-align:left;">TERCERO: <?php echo $nombre_cliente ?></td>
<td style="text-align:left;">DEPENDENCIA: <?php echo $nombre_dependencia_get ?></td>
<td style="text-align:left;">TIPO PAGO: <?php echo $nombre_tipo_pago_get ?></td>
</tr>
<tr>
<td style="text-align:left;">FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago_get ?></td>
<td style="text-align:left;">TIPO DE FACTURA: <?php echo $nombre_tipo_compra_get ?></td>
<td style="text-align:left;">FECHA INICAL: <?php echo $fecha_ymd_venta_producto_ini ?></td>
<td style="text-align:left;">FECHA FINAL: <?php echo $fecha_ymd_venta_producto_fin ?></td>
</tr>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<!--
<hr>
<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="#"><strong>CONSOLIDADO DE COMPRAS</strong></a></td>
</tr>
</table>

<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
</tr>
</table>
-->
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<table class="table table-striped">
<tr>
<th style="text-align:center;"><a href="#">TOTAL COMPRA</a></th>
<th style="text-align:center;"><a href="#">DESCARGAR EXCEL XLS</a></th>
<th style="text-align:center;"><a href="#">DESCARGAR EXCEL XLSX</a></th>
</tr>
<tr>
<td style="text-align:center;"><?php echo number_format($total_suma_venta_producto, 0, ",", ".") ?></td>
<td style="text-align:center;"><a href="../admin/descargar_compra_generales_pos_xls.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_administrador=<?php echo $cod_administrador?>&cod_tercero=<?php echo $cod_tercero?>&cod_tipo_pago=<?php echo $cod_tipo_pago?>&cod_dependencia=<?php echo $cod_dependencia?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>"><img src=../imagenes/xls.png alt="imprimir_peq"></a></td>
<td style="text-align:center;"><a href="../admin/descargar_compra_generales_pos_xlsx.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_administrador=<?php echo $cod_administrador?>&cod_tercero=<?php echo $cod_tercero?>&cod_tipo_pago=<?php echo $cod_tipo_pago?>&cod_dependencia=<?php echo $cod_dependencia?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></td>
</tr>
</table>
                                                                                                                                                                                                                                                                                                                 
<hr>
<table class="table table-striped">
<tr>
<th style="text-align:center;"><a href="#"><strong>COMPRAS POR FACTURA</strong></a></th>
</tr>
</table>
<!--
<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="../admin/descargar_venta_generales_pos_xls.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_administrador=<?php echo $cod_administrador?>&cod_tercero=<?php echo $cod_tercero?>&cod_tipo_pago=<?php echo $cod_tipo_pago?>&cod_dependencia=<?php echo $cod_dependencia?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>"><img src=../imagenes/xls.png alt="imprimir_peq"></a></td>
<td style="text-align:center;"><a href="../admin/descargar_venta_generales_pos_xlsx.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_administrador=<?php echo $cod_administrador?>&cod_tercero=<?php echo $cod_tercero?>&cod_tipo_pago=<?php echo $cod_tipo_pago?>&cod_dependencia=<?php echo $cod_dependencia?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></td>
</tr>
</table>
-->
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">Tipo Factura</th>
<th style="text-align:center">Factura</th>
<th style="text-align:center">Proveedor</th>
<th style="text-align:center">%Rete Fuente</th>
<th style="text-align:center">%Rete Ica</th>
<th style="text-align:center">Total Compra</th>
<th style="text-align:center">Total Iva</th>
<th style="text-align:center">Tipo Pago</th>
<th style="text-align:center">Vendedor</th>
<th style="text-align:center">Fecha</th>
<th style="text-align:center">Tipo Cargue</th>
<th style="text-align:center">Id</th>
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT tbl15_info_factura_compra.cod_info_factura_compra, tbl15_info_factura_compra.valor_iva, 
tbl15_info_factura_compra.cod_info_factura_compra, tbl15_info_factura_compra.cod_factura, 
tbl15_info_factura_compra.total_precio_costo, tbl15_info_factura_compra.nombre_rete_fuente_ptj, tbl15_info_factura_compra.ret_ica_ptj, 
tbl15_info_factura_compra.total_factura_compra_retefuente, tbl15_info_factura_compra.fecha_anyo, 
tbl15_info_factura_compra.cod_administrador, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, 
tbl15_tercero.direccion_tercero, tbl15_info_factura_compra.cuenta, tbl15_info_factura_compra.cod_tipo_pago, tbl15_info_factura_compra.cod_tipo_forma_pago, 
tbl15_info_factura_compra.cod_dependencia, tbl15_info_factura_compra.nombre_tipo_compra, tbl15_info_factura_compra.nombre_tipo_cargue_factura  
FROM tbl15_tercero RIGHT JOIN tbl15_info_factura_compra ON tbl15_tercero.cod_tercero = tbl15_info_factura_compra.cod_tercero 
WHERE (tbl15_info_factura_compra.fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel $filtro_consulta_nombre_tipo_compra_info_rel
AND (tbl15_info_factura_compra.nombre_estado_factura = 'CERRADA') ORDER BY tbl15_info_factura_compra.cod_info_factura_compra DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

    $cod_info_factura_compra                 = $info_cliente['cod_info_factura_compra'];
    $cod_factura                             = $info_cliente['cod_factura'];
    $total_precio_costo                      = $info_cliente['total_precio_costo'];
    $total_factura_compra_retefuente         = $info_cliente['total_factura_compra_retefuente'];
    $fecha_anyo                              = $info_cliente['fecha_anyo'];
    //$cuenta                                  = $info_cliente['cuenta'];
    $cod_administrador_db                    = $info_cliente['cod_administrador'];
    $nombre_propietario                      = $info_cliente['nombre1_tercero'];
    $cod_tipo_pago                           = $info_cliente['cod_tipo_pago'];
    $cod_tipo_forma_pago                     = $info_cliente['cod_tipo_forma_pago'];
    $cod_dependencia                         = $info_cliente['cod_dependencia'];
    $nombre_tipo_compra                      = $info_cliente['nombre_tipo_compra'];
    $nombre_rete_fuente_ptj                  = $info_cliente['nombre_rete_fuente_ptj'];
    $ret_ica_ptj                             = $info_cliente['ret_ica_ptj'];
    $nombre_tipo_cargue_factura              = $info_cliente['nombre_tipo_cargue_factura'];
    $valor_iva                               = $info_cliente['valor_iva'];

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];

    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

    $sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
    $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
    $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

    $nombre_dependencia            = $datos_dependencia['nombre_dependencia'];
?>
<tr>
<td style="text-align:center"><?php echo $nombre_tipo_compra?></td>
<td style="text-align:center"><?php echo $cod_factura?></td>
<td style="text-align:left"><?php echo $nombre_propietario?></td>
<td style="text-align:center"><?php echo $nombre_rete_fuente_ptj?></td>
<td style="text-align:center"><?php echo $ret_ica_ptj?></td>
<td style="text-align:right"><?php echo number_format($total_factura_compra_retefuente, 0, ",", ".")?></td>
<td style="text-align:right"><?php echo number_format($valor_iva, 0, ",", ".")?></td>
<td style="text-align:center"><?php echo $nombre_tipo_pago?></td>
<td style="text-align:center"><?php echo $cuenta?></td>
<td style="text-align:center"><?php echo $fecha_anyo?></td>
<td style="text-align:center"><?php echo $nombre_tipo_cargue_factura?></td>
<td style="text-align:center"><?php echo $cod_info_factura_compra?></td>
</tr>
<?php } ?>
</tbody>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<hr>
<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="#"><strong>COMPRAS GENERALES</strong></a></td>
</tr>
</table>
<!--
<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="../admin/descargar_venta_generales_pos_xls.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_administrador=<?php echo $cod_administrador?>&cod_tercero=<?php echo $cod_tercero?>&cod_tipo_pago=<?php echo $cod_tipo_pago?>&cod_dependencia=<?php echo $cod_dependencia?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>"><img src=../imagenes/xls.png alt="imprimir_peq"></a></td>
<td style="text-align:center;"><a href="../admin/descargar_venta_generales_pos_xlsx.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_administrador=<?php echo $cod_administrador?>&cod_tercero=<?php echo $cod_tercero?>&cod_tipo_pago=<?php echo $cod_tipo_pago?>&cod_dependencia=<?php echo $cod_dependencia?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></td>
</tr>
</table>
-->
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">Tipo Factura</th>
<th style="text-align:center">Factura</th>
<th style="text-align:center">Cod</th>
<th style="text-align:center">Concepto</th>
<th style="text-align:center">Proveedor</th>
<th style="text-align:center">Unidades</th>
<th style="text-align:center">P.Compra</th>
<th style="text-align:center">Total Compra</th>
<th style="text-align:center">%Iva</th>
<th style="text-align:center">Tipo Pago</th>
<th style="text-align:center">Vendedor</th>
<th style="text-align:center">Fecha</th>
<th style="text-align:center">Inv</th>
<th style="text-align:center">Id</th>
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT tbl15_factura_compra_producto.cod_factura_compra_producto, tbl15_factura_compra_producto.cod_producto, tbl15_factura_compra_producto.cod_producto_barra, 
tbl15_factura_compra_producto.cod_info_factura_compra, tbl15_factura_compra_producto.cod_factura, tbl15_factura_compra_producto.cod_historia_clinica, tbl15_factura_compra_producto.nombre_producto, 
tbl15_factura_compra_producto.und_compra, tbl15_factura_compra_producto.precio_costo_producto, tbl15_factura_compra_producto.total_costo_producto, tbl15_factura_compra_producto.precio_compra_producto, 
tbl15_factura_compra_producto.total_compra_producto, tbl15_factura_compra_producto.nombre_tipo_producto, tbl15_factura_compra_producto.nombre_tipo_unidad_medida, 
tbl15_factura_compra_producto.nombre_tipo_presentacion, tbl15_factura_compra_producto.nombre_via_administracion, tbl15_factura_compra_producto.nombre_frec_duracion, 
tbl15_factura_compra_producto.fecha_ymd_venta_producto, tbl15_factura_compra_producto.cod_administrador, tbl15_factura_compra_producto.iva_ptj, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_factura_compra_producto.cuenta, tbl15_factura_compra_producto.cod_tipo_cobrar, tbl15_factura_compra_producto.comision_ptj, tbl15_factura_compra_producto.cod_tipo_pago, 
tbl15_factura_compra_producto.cod_tipo_forma_pago, tbl15_factura_compra_producto.cod_dependencia, 
tbl15_factura_compra_producto.nombre_tipo_compra, tbl15_factura_compra_producto.und_producto
FROM tbl15_tercero RIGHT JOIN tbl15_factura_compra_producto ON tbl15_tercero.cod_tercero = tbl15_factura_compra_producto.cod_tercero 
WHERE (tbl15_factura_compra_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_productos_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel $filtro_consulta_nombre_tipo_compra_rel
ORDER BY tbl15_factura_compra_producto.cod_factura_compra_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_factura_compra_producto   = $info_cliente['cod_factura_compra_producto'];
$cod_producto                  = $info_cliente['cod_producto'];
$cod_producto_barra            = $info_cliente['cod_producto_barra'];
$cod_info_factura_compra       = $info_cliente['cod_info_factura_compra'];
$cod_factura                   = $info_cliente['cod_factura'];
$nombre_producto               = $info_cliente['nombre_producto'];
$und_compra                    = $info_cliente['und_compra'];
$precio_costo_producto         = $info_cliente['precio_costo_producto'];
$total_costo_producto          = $info_cliente['total_costo_producto'];
$precio_compra_producto        = $info_cliente['precio_compra_producto'];
$total_compra_producto         = $info_cliente['total_compra_producto'];
$nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
$nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
$fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
//$cuenta                        = $info_cliente['cuenta'];
$cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
$cod_administrador_db          = $info_cliente['cod_administrador'];
$nombre_propietario            = $info_cliente['nombre1_tercero'];
$comision_ptj                  = $info_cliente['comision_ptj'];
$cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
$cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
$cod_dependencia               = $info_cliente['cod_dependencia'];
$nombre_tipo_compra            = $info_cliente['nombre_tipo_compra'];
$iva_ptj                       = $info_cliente['iva_ptj'];
$und_producto                  = $info_cliente['und_producto'];

$total_comision                = ($total_compra_producto * ($comision_ptj/100));

$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                        = $datos_administrador['cuenta'];

$sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

$nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

$sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

$nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

$sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_dependencia            = $datos_dependencia['nombre_dependencia'];
?>
<tr>
<td style="text-align:center"><?php echo $nombre_tipo_compra?></td>
<td style="text-align:center"><?php echo $cod_factura?></td>
<td style="text-align:left"><?php echo $cod_producto_barra?></td>
<td style="text-align:left"><?php echo $nombre_producto?></td>
<td style="text-align:left"><?php echo $nombre_propietario?></td>
<td style="text-align:center"><?php echo $und_compra?></td>
<td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", ".")?></td>
<td style="text-align:right"><?php echo number_format($total_compra_producto, 0, ",", ".")?></td>
<td style="text-align:center"><?php echo $iva_ptj?></td>
<td style="text-align:center"><?php echo $nombre_tipo_pago?></td>
<td style="text-align:center"><?php echo $cuenta?></td>
<td style="text-align:center"><?php echo $fecha_ymd_venta_producto?></td>
<td style="text-align:center;"><?php echo $und_producto;?></td>
<td style="text-align:center"><?php echo $cod_factura_compra_producto?></td>
</tr>
<?php } ?>
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