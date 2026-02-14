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
<a class="btn btn-primary" href="#"><h6>Reporte Movimientos Contables Por Rango de Fechas</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<?php
$seleccionado                      = 0;

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
    $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
    $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
    $cod_tercero                             = intval($_GET['cod_tercero']);
    $nombre_tipo_documento                   = addslashes($_GET['nombre_tipo_documento']);
    $fecha                                   = date("Y-m-d");
} else {
    $fecha_ymd_venta_producto_ini            = date("Y-m-d");
    $fecha_ymd_venta_producto_fin            = date("Y-m-d");
    $cod_tercero                             = 0;
    $nombre_tipo_documento                   = "0";
    $fecha                                   = date("Y-m-d");
}



if ($cod_tercero==0) {
    $nombre_tercero_get                                  = 'TODOS';
} else {
    $sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido2_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

    $nombre_tercero_get                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido2_tercero'];
}

if ($nombre_tipo_documento=='0') {
    $nombre_tipo_documento_get                            = 'TODOS';
} else {
    $sql_tipo_factura  = "SELECT nombre_tipo_documento FROM tbl15_tipo_documento WHERE nombre_tipo_documento = '$nombre_tipo_documento'";
    $consulta_tipo_factura  = mysqli_query($conectar, $sql_tipo_factura ) or die(mysqli_error($conectar));
    $datos_tipo_factura  = mysqli_fetch_assoc($consulta_tipo_factura );

    $nombre_tipo_documento_get                            = $datos_tipo_factura['nombre_tipo_documento'];
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
    <th style="text-align:center;">TERCERO</th>
    <th style="text-align:center;">TIPO MOVIMIENTO</th>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <td style="text-align:center;">
        <select name="cod_tercero" id="cod_tercero" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;">
        <select name="nombre_tipo_documento" id="nombre_tipo_documento" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_documento)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT nombre_tipo_documento FROM tbl15_tipo_documento WHERE (cod_estado = '1') ORDER BY nombre_tipo_documento ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_documento) AND $nombre_tipo_documento == $datos2['nombre_tipo_documento']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_documento'];
            $nombre = $datos2['nombre_tipo_documento'];
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

    if ($cod_tercero==0) {
        $filtro_consulta_tercero = "";
        $filtro_consulta_tercero_rel = "";
        $nombre_tercero_get                                  = 'TODOS';
    } else {
        $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
        $filtro_consulta_tercero_rel = "AND (cod_tercero = '$cod_tercero')";

        $sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
        $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
        $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

        $nombre_tercero_get                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['nombre2_tercero'].' '.$datos_tercero['apellido1_tercero'].' '.$datos_tercero['apellido2_tercero'];
    }

    if ($nombre_tipo_documento=='0') {
        $filtro_consulta_tipo_documento = "";
        $filtro_consulta_tipo_documento_rel = "";
    } else {
        $filtro_consulta_tipo_documento = "AND (nombre_tipo_documento = '$nombre_tipo_documento')";
        $filtro_consulta_tipo_documento_rel = "AND (nombre_tipo_documento = '$nombre_tipo_documento')";
    }

    $sql_info_totales_ingresos_pyg = "SELECT SUM(total_costo_movimiento_contable) AS total_costo_movimiento_contable_ingresos_pyg FROM tbl15_movimiento_contable 
    WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (nombre_estado_factura = 'CERRADA') AND (nombre_tipo_documento = 'RECIBO DE CAJA' OR nombre_tipo_documento = 'FACTURA DE VENTA')";
    $resultado_info_totales_ingresos_pyg = mysqli_query($conectar, $sql_info_totales_ingresos_pyg) or die(mysqli_error($conectar));
    $info_info_totales_ingresos_pyg = mysqli_fetch_assoc($resultado_info_totales_ingresos_pyg);

    $total_costo_movimiento_contable_ingresos_pyg         = $info_info_totales_ingresos_pyg['total_costo_movimiento_contable_ingresos_pyg'];

    $sql_info_totales_egresos_pyg = "SELECT SUM(total_costo_movimiento_contable) AS total_costo_movimiento_contable_egresos_pyg FROM tbl15_movimiento_contable 
    WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (nombre_estado_factura = 'CERRADA') AND (nombre_tipo_documento = 'COMPROBANTE DE EGRESO')";
    $resultado_info_totales_egresos_pyg = mysqli_query($conectar, $sql_info_totales_egresos_pyg) or die(mysqli_error($conectar));
    $info_info_totales_egresos_pyg = mysqli_fetch_assoc($resultado_info_totales_egresos_pyg);

    $total_costo_movimiento_contable_egresos_pyg         = $info_info_totales_egresos_pyg['total_costo_movimiento_contable_egresos_pyg'];

    $total_utilidad_pyg                                  = $total_costo_movimiento_contable_ingresos_pyg - $total_costo_movimiento_contable_egresos_pyg;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<table class="table table-striped">
    <tr>
        <td style="text-align:center;">TERCERO: <?php echo $nombre_tercero_get ?></td>
        <td style="text-align:center;">TIPO MOVIMIENTO: <?php echo $nombre_tipo_documento_get ?></td>
        <td style="text-align:center;">FECHA INICAL: <?php echo $fecha_ymd_venta_producto_ini ?></td>
        <td style="text-align:center;">FECHA FINAL: <?php echo $fecha_ymd_venta_producto_fin ?></td>
    </tr>
</table>

<table class="table table-striped">
    <tr>
        <th style="text-align:center"><font size='+1'>TOTAL INGRESOS</font></th>
        <th style="text-align:center"><font size='+1'>TOTAL EGRESOS</font></th>
        <th style="text-align:center"><font size='+1'>TOTAL UTILIDAD (PYG)</font></th>
    </tr>
    <tr>
        <th style="text-align:center"><font size='+1'><?php echo number_format($total_costo_movimiento_contable_ingresos_pyg, 0, ",", ".") ?></font></th>
        <th style="text-align:center"><font size='+1'><?php echo number_format($total_costo_movimiento_contable_egresos_pyg, 0, ",", ".") ?></font></th>
        <th style="text-align:center"><font size='+1'><?php echo number_format($total_utilidad_pyg, 0, ",", ".") ?></font></th>
    </tr>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center;"><a href="../admin/reporte_movimiento_contable_pdf.php?cod_tercero=<?php echo $cod_tercero?>&nombre_tipo_documento=<?php echo $nombre_tipo_documento?>&fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>" target="_blank"><img src=../imagenes/imprimir_.png alt="imprimir_peq"></a></td>
    </tr>
</table>

<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<hr>
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Totales Por Tipo de Movimiento Contable</a></th>
</tr>
</thead>
</table>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:left; background-color:#DBE0F3; color:#000;"><a href="#">Tipo Movimiento Contable</a></th>
<th style="text-align:left; background-color:#DBE0F3; color:#000;"><a href="#">Total Movimiento</a></th>
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT SUM(total_costo_movimiento_contable) AS total_costo_movimiento_contable, nombre_tipo_documento 
FROM tbl15_movimiento_contable WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_consulta_tercero $filtro_consulta_tipo_documento
AND (nombre_estado_factura = 'CERRADA') GROUP BY nombre_tipo_documento DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$nombre_tipo_documento                   = $info_cliente['nombre_tipo_documento'];
$total_costo_movimiento_contable         = $info_cliente['total_costo_movimiento_contable'];
?>
<tr>
<td style="text-align:left"><?php echo $nombre_tipo_documento?></td>
<td style="text-align:left"><?php echo number_format($total_costo_movimiento_contable, 0, ",", ".")?></td>
</tr>
<?php } ?>
</tbody>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Guia</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tipo Movimiento Contable</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tercero</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Descripcion</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Movimiento</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Forma pago</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"></a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Fecha</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Id</a></th>
        </tr>
    </thead>
<tbody>
<?php
$total_movimiento_contable                      = 0;

$sql_mov_detalle = "SELECT * FROM tbl15_movimiento_contable WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_consulta_tercero $filtro_consulta_tipo_documento
AND (nombre_estado_factura = 'CERRADA') ORDER BY cod_movimiento_contable DESC";
$resultado_mov_detalle = mysqli_query($conectar, $sql_mov_detalle) or die(mysqli_error($conectar));
while ($info_mov_detalle = mysqli_fetch_assoc($resultado_mov_detalle)) {

$cod_movimiento_contable                 = $info_mov_detalle['cod_movimiento_contable'];
$nombre_estado_factura                   = $info_mov_detalle['nombre_estado_factura'];
$cod_factura                             = $info_mov_detalle['cod_factura'];
$doc_modifica                            = $info_mov_detalle['doc_modifica'];
$nombre_tipo_documento                   = $info_mov_detalle['nombre_tipo_documento'];
$descripcion_movimiento                  = $info_mov_detalle['descripcion_movimiento'];
$total_costo_movimiento_contable         = $info_mov_detalle['total_costo_movimiento_contable'];
$cod_tercero                             = $info_mov_detalle['cod_tercero'];
$fecha_ymd                               = $info_mov_detalle['fecha_ymd'];
$cod_guia                                = $info_mov_detalle['cod_guia'];
$cod_tipo_forma_pago                     = $info_mov_detalle['cod_tipo_forma_pago'];
$descripcion_tipo_forma_pago             = $info_mov_detalle['descripcion_tipo_forma_pago'];
$total_movimiento_contable              += $total_costo_movimiento_contable;

$sql_tipo_pago = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

$identificacion_tercero       = $datos_tipo_pago['identificacion_tercero'];
$nombre1_tercero              = $datos_tipo_pago['nombre1_tercero'];
$nombre2_tercero              = $datos_tipo_pago['nombre2_tercero'];
$apellido1_tercero            = $datos_tipo_pago['apellido1_tercero'];
$apellido2_tercero            = $datos_tipo_pago['apellido2_tercero'];
$nombre_tercero               = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

$sql_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

$nombre_tipo_forma_pago                        = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
?>
    <tr>
        <td style="text-align:center"><?php echo $cod_guia?></td>
        <td style="text-align:left"><?php echo $nombre_tipo_documento?></td>
        <td style="text-align:left"><?php echo $nombre_tercero?></td>
        <td style="text-align:left"><?php echo $descripcion_movimiento?></td>
        <td style="text-align:right"><?php echo number_format($total_costo_movimiento_contable, 0, ",", ".")?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
        <td style="text-align:left"><?php echo $descripcion_tipo_forma_pago?></td>
        <td style="text-align:center"><?php echo $fecha_ymd?></td>
        <td style="text-align:center"><?php echo $cod_movimiento_contable?></td>
    </tr>
<?php } ?>
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
        <th style="text-align:right; background-color:#DBE0F3; color:#000;">TOTAL</th>
        <th style="text-align:right; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_movimiento_contable, 0, ",", ".")?></th>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
    </tr>
</tbody>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<hr>
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Detallado Movimiento Debito</a></th>
</tr>
</thead>
</table>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Guia</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tipo</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Codigo</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Nombre</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Comentario</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Valor</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Fecha</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">IdMov</a></th>

        </tr>
    </thead>
<tbody>
<?php
$incres                                         = 0;
$total_costo_movimiento_contable_debito         = 0;
       
$obtener_info_movimiento_contable_concepto = "SELECT * FROM tbl15_movimiento_contable_concepto 
WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_consulta_tercero $filtro_consulta_tipo_documento AND (nombre_tipo_movimiento = 'DEBITOS') ORDER BY fecha_ymd DESC";
$resultado_info_movimiento_contable_concepto = mysqli_query($conectar, $obtener_info_movimiento_contable_concepto) or die(mysqli_error($conectar));
while ($info_movimiento_contable_concepto = mysqli_fetch_assoc($resultado_info_movimiento_contable_concepto)) {

    $cod_movimiento_contable_concepto               = $info_movimiento_contable_concepto['cod_movimiento_contable_concepto'];
    $nombre_tipo_movimiento                         = $info_movimiento_contable_concepto['nombre_tipo_movimiento'];
    $nombre_tipo_documento                          = $info_movimiento_contable_concepto['nombre_tipo_documento'];
    $codigo_puc                                     = $info_movimiento_contable_concepto['codigo_puc'];
    $nombre_puc                                     = $info_movimiento_contable_concepto['nombre_puc'];
    $tipo_puc                                       = $info_movimiento_contable_concepto['tipo_puc'];
    $und_vendida                                    = $info_movimiento_contable_concepto['und_vendida'];
    $costo_movimiento_contable                      = $info_movimiento_contable_concepto['costo_movimiento_contable'];
    $venta_movimiento_contable                      = $info_movimiento_contable_concepto['venta_movimiento_contable'];
    $total_costo_movimiento_contable                = $info_movimiento_contable_concepto['total_costo_movimiento_contable'];
    $total_venta_movimiento_contable                = $info_movimiento_contable_concepto['total_venta_movimiento_contable'];
    $comentario                                     = $info_movimiento_contable_concepto['comentario'];
    $fecha_ymd                                      = $info_movimiento_contable_concepto['fecha_ymd'];
    $cod_movimiento_contable                        = $info_movimiento_contable_concepto['cod_movimiento_contable'];
    $cod_guia                                       = $info_movimiento_contable_concepto['cod_guia'];
    $total_costo_movimiento_contable_debito        += $total_costo_movimiento_contable;
    $incres++;
?>
    <tr>
        <td style="text-align:center"><?php echo $cod_guia?></td>
        <td style="text-align:left"><?php echo $nombre_tipo_documento?></td>
        <td style="text-align:left"><?php echo $codigo_puc?></td>
        <td style="text-align:left"><?php echo $nombre_puc?></td>
        <td style="text-align:left"><?php echo $comentario?></td>
        <td style="text-align:right"><?php echo number_format($total_costo_movimiento_contable, 0, ",", ".")?></td>
        <td style="text-align:center"><?php echo $fecha_ymd?></td>
        <td style="text-align:center"><?php echo $cod_movimiento_contable?></td>
    </tr>
<?php } ?>
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
        <th style="text-align:right; background-color:#DBE0F3; color:#000;">TOTAL</th>
        <th style="text-align:right; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_costo_movimiento_contable_debito, 0, ",", ".")?></th>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"></td>
    </tr>
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