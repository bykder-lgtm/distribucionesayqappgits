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
<!--<div class="container">-->
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Reporte Abonos Cuentas por Cobrar Por Rango de Fechas</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
$seleccionado                      = 0;

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
    $fecha_mes_venta_producto_ini            = date("Y-m", strtotime($fecha_ymd_venta_producto_ini));
    $fecha_mes_venta_producto_fin            = date("Y-m", strtotime($fecha_ymd_venta_producto_fin));
    $cod_administrador                       = intval($_GET['cod_administrador']);
    $cod_tercero                             = intval($_GET['cod_tercero']);
    $cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
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


    if ($cod_estado_hora_reporte_venta_global == '1') {
        $fecha_hora_venta_producto_ini           = addslashes($_GET['fecha_hora_venta_producto_ini']);
        $fecha_hora_venta_producto_fin           = addslashes($_GET['fecha_hora_venta_producto_fin']);
        $condicion_hora_reporte_venta            = "AND (fecha_hora_venta_producto BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_rel        = "AND (tbl15_venta_producto.fecha_hora_venta_producto BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_info       = "AND (fecha_hora BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_info_rel   = "AND (tbl15_venta_producto.fecha_hora BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
    } else {
        $fecha_hora_venta_producto_ini           = '';
        $fecha_hora_venta_producto_fin           = '';
        $condicion_hora_reporte_venta            = '';
        $condicion_hora_reporte_venta_rel        = '';
        $condicion_hora_reporte_venta_info       = '';
        $condicion_hora_reporte_venta_info_rel   = '';
    }

    } else {
        $fecha_ymd_venta_producto_ini            = date("Y-m-d");
        $fecha_ymd_venta_producto_fin            = date("Y-m-d");
        $fecha_mes_venta_producto_ini            = date("Y-m");
        $fecha_mes_venta_producto_fin            = date("Y-m");
        $cod_administrador                       = 0;
        $cod_tercero                             = 0;
        $cod_tipo_forma_pago                     = 0;
        $fecha                                   = date("Y-m-d");

    if ($cod_estado_hora_reporte_venta_global == '1') {
        $fecha_hora_venta_producto_ini           = '00:00:00';
        $fecha_hora_venta_producto_fin           = '23:59:59';
        $condicion_hora_reporte_venta            = "AND (fecha_hora_venta_producto BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_rel        = "AND (tbl15_venta_producto.fecha_hora_venta_producto BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_info       = "AND (fecha_hora BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_info_rel   = "AND (tbl15_venta_producto.fecha_hora BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
    } else {
        $fecha_hora_venta_producto_ini           = '';
        $fecha_hora_venta_producto_fin           = '';
        $condicion_hora_reporte_venta            = '';
        $condicion_hora_reporte_venta_rel        = '';
        $condicion_hora_reporte_venta_info       = '';
        $condicion_hora_reporte_venta_info_rel   = '';
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

if ($cod_tercero==0) {
    $nombre_cliente                                  = 'TODOS';
} else {
    $sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido2_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

    $nombre_cliente                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido2_tercero'];
}

if ($cod_tipo_forma_pago==0) {
    $nombre_tipo_forma_pago_get                        = 'TODOS';
} else {
    $sql_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
    $datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

    $nombre_tipo_forma_pago_get                        = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
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
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TERCERO</th>

  </tr>
  <tr>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" style="width: 140px;" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" style="width: 140px;" required/></td>
     <td style="text-align:center;">
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
    <td style="text-align:center;">
        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_forma_pago)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
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
    $fecha_mes_venta_producto_ini            = date("Y-m", strtotime($fecha_ymd_venta_producto_ini));
    $fecha_mes_venta_producto_fin            = date("Y-m", strtotime($fecha_ymd_venta_producto_fin));
    $fecha                                   = date("Y/m/d");
    $pagina                                  = $_SERVER['PHP_SELF'];
    $contado                                 = '1';
    $credito                                 = '2';
    $efectivo                                = '1';
    $transfer                                = '10';
    $cod_servicio_propina                    = '22222222';
    $cod_servicio_cava                       = '55555555';
    $cod_servicio_domicilio                  = '44444444';
    $cod_servicio_descuento_punto_redimible  = '11112222';
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    if ($cod_administrador==0) {
        $filtro_consulta_vendedor = "";
        $filtro_consulta_vendedor_rel = "";
    } else {
        $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
    }
    if ($cod_tercero==0) {
        $filtro_consulta_tercero = "";
        $filtro_consulta_tercero_rel = "";
    } else {
        $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
        $filtro_consulta_tercero_rel = "AND (tbl15_venta_producto.cod_tercero = '$cod_tercero')";
    }
    if ($cod_tipo_forma_pago==0) {
        $filtro_consulta_tipo_forma_pago = "";
        $filtro_consulta_tipo_forma_pago_rel = "";
    } else {
        $filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
        $filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_venta_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    }
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<table class="table table-striped">
    <tr>
        <td style="text-align:left;">VENDEDOR: <?php echo $cuenta_get ?></td>
        <td style="text-align:left;">TERCERO: <?php echo $nombre_cliente ?></td>
        <td style="text-align:left;">FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago_get ?></td>
        <td style="text-align:left;">FECHA INICAL: <?php echo $fecha_ymd_venta_producto_ini ?><?php if ($cod_estado_hora_reporte_venta_global == '1') { ?> | <?php echo $fecha_hora_venta_producto_ini ?><?php } ?></td>
        <td style="text-align:left;">FECHA FINAL: <?php echo $fecha_ymd_venta_producto_fin ?><?php if ($cod_estado_hora_reporte_venta_global == '1') { ?> | <?php echo $fecha_hora_venta_producto_fin ?><?php } ?></td>
    </tr>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_cuenta_cobrar == '1') { ?>
    <table class="table table-striped">
        <tr>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>ABONOS CUENTAS POR COBRAR (ABONOS CARTERA)</strong></a></td>
        </tr>
    </table>

    <table class="table table-striped">
        <tr>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>CLIENTE</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>ABONOS</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>PAGO A</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>MENSAJE</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>FORMA PAGO</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>FECHA</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>HORA</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>ID</strong></td>
            <!--<td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>IMP</strong></td>-->
        </tr>
    <?php
    $total_abonado = 0;

    $sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_forma_pago ORDER BY cod_cuentas_cobrar_abonos DESC";
    $consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
    $total_datos = mysqli_num_rows($consulta);
    while ($datos = mysqli_fetch_assoc($consulta)) {

        $cod_cuentas_cobrar_abonos  = $datos['cod_cuentas_cobrar_abonos'];
        $abonado                    = $datos['abonado'];
        $cuenta                     = $datos['cuenta'];
        $mensaje                    = $datos['mensaje'];
        $fecha_pago                 = $datos['fecha_pago'];
        $hora                       = $datos['hora'];
        $cod_dependencia            = $datos['cod_dependencia'];
        $cod_tipo_forma_pago        = $datos['cod_tipo_forma_pago'];
        $cod_tercero                = $datos['cod_tercero'];
        $total_abonado             += $abonado;

        $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
        $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
        $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

        $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

        $sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
        $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
        $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

        $nombre_dependencia        = $datos_dependencia['nombre_dependencia'];

        $sql_tercero = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
        $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
        $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

        $nombre_cliente            = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['nombre2_tercero'].' '.$datos_tercero['apellido1_tercero'].' '.$datos_tercero['apellido2_tercero'].' - '.$datos_tercero['identificacion_tercero'];
    ?>
        <tr>
            <td style="text-align: left;"><?php echo $nombre_cliente; ?></td>
            <td style="text-align: center;"><?php echo number_format($abonado, 0, ",", ".")?></td>
            <td style="text-align: center;"><?php echo $cuenta; ?></td>
            <td style="text-align: left;"><?php echo $mensaje; ?></td>
            <td style="text-align: center;"><?php echo $nombre_tipo_forma_pago; ?></td>
            <td style="text-align: center;"><?php echo $fecha_pago; ?></td>
            <td style="text-align: center;"><?php echo $hora; ?></td>
            <td style="text-align: center;"><?php echo $cod_cuentas_cobrar_abonos; ?></td>
        </tr>
    <?php } ?>
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">TOTAL</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_abonado, 0, ",", ".")?></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
            <!--<th style="text-align:center; background-color:#DBE0F3; color:#000;">IMP</th>-->
        </tr>
    </table>
    <table class="table table-striped">
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">ABONOS POR FORMA DE PAGO (ABONOS CARTERA)</a></th>
        </tr>
    </table>


    <table class="table table-striped">
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">FORMA PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">ABONOS POR FORMA DE PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">FECHA</th>
        </tr>
    <?php
    $total_abonado_forma_pago = 0;

    $sql_abonos_cuenta_cobrar_forma_pago = "SELECT SUM(abonado) AS abonado_forma_pago, cod_tipo_forma_pago, fecha_pago FROM tbl15_cuentas_cobrar_abonos WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_forma_pago GROUP BY cod_tipo_forma_pago";
    $consulta_abonos_cuenta_cobrar_forma_pago = mysqli_query($conectar, $sql_abonos_cuenta_cobrar_forma_pago) or die(mysqli_error($conectar));
    while ($matriz_forma_pago = mysqli_fetch_assoc($consulta_abonos_cuenta_cobrar_forma_pago)) {

    $abonado_forma_pago         = $matriz_forma_pago['abonado_forma_pago'];
    $fecha_pago                 = $matriz_forma_pago['fecha_pago'];
    $cod_tipo_forma_pago        = $matriz_forma_pago['cod_tipo_forma_pago'];
    $total_abonado_forma_pago  += $abonado_forma_pago;

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];
    ?>
        <tr>
            <td style="text-align: center;"><?php echo $nombre_tipo_forma_pago; ?></td>
            <td style="text-align: center;"><?php echo number_format($abonado_forma_pago, 0, ",", ".")?></td>
            <td style="text-align: center;"><?php echo $fecha_pago; ?></td>
        </tr>
    <?php } ?>
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">TOTAL</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_abonado_forma_pago, 0, ",", ".")?></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        </tr>
    </table>
<?php } ?>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
<!--</div>-->
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>