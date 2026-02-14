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
<a class="btn btn-primary" href="#"><h6>Reporte Ventas Por Rango de Fechas</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php include_once("../admin/menu_atendidos.php") ?>
<?php
$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
$seleccionado                      = 0;
$cod_estado_ignorar_venta          = 0;

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
    $cod_tipo_pago                           = intval($_GET['cod_tipo_pago']);
    $cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
    $cod_dependencia                         = intval($_GET['cod_dependencia']);
    $nombre_tipo_factura                     = addslashes($_GET['nombre_tipo_factura']);
    $nombre_tipo_compra                      = addslashes($_GET['nombre_tipo_compra']);
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
        $cod_tipo_pago                           = 0;
        $cod_tipo_forma_pago                     = 0;
        $cod_dependencia                         = 0;
        $nombre_tipo_factura                     = "0";
        $nombre_tipo_compra                      = "0";
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

if (isset($_GET['cod_tipo_metodo_envio'])) { $cod_tipo_metodo_envio = intval($_GET['cod_tipo_metodo_envio']); } else { $cod_tipo_metodo_envio = "0"; }


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

if ($nombre_tipo_factura=='0') {
    $nombre_tipo_factura_get                            = 'TODOS';
} else {
    $sql_tipo_factura  = "SELECT nombre_tipo_factura FROM tbl15_tipo_factura WHERE nombre_tipo_factura = '$nombre_tipo_factura'";
    $consulta_tipo_factura  = mysqli_query($conectar, $sql_tipo_factura ) or die(mysqli_error($conectar));
    $datos_tipo_factura  = mysqli_fetch_assoc($consulta_tipo_factura );

    $nombre_tipo_factura_get                            = $datos_tipo_factura['nombre_tipo_factura'];
}

if ($nombre_tipo_compra=='0') {
    $nombre_tipo_compra_get                            = 'TODOS';
} else {
    $sql_tipo_compra  = "SELECT nombre_tipo_compra FROM tbl15_tipo_compra WHERE nombre_tipo_compra = '$nombre_tipo_compra'";
    $consulta_tipo_compra  = mysqli_query($conectar, $sql_tipo_compra ) or die(mysqli_error($conectar));
    $datos_tipo_compra  = mysqli_fetch_assoc($consulta_tipo_compra );

    $nombre_tipo_compra_get                            = $datos_tipo_compra['nombre_tipo_compra'];
}

if ($cod_tipo_metodo_envio=='0') {
    $nombre_tipo_metodo_envio_get                     = 'TODOS';
} else {
    $sql_tipo_metodo_envio  = "SELECT nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio WHERE cod_tipo_metodo_envio = '$cod_tipo_metodo_envio'";
    $consulta_tipo_metodo_envio  = mysqli_query($conectar, $sql_tipo_metodo_envio) or die(mysqli_error($conectar));
    $datos_tipo_metodo_envio  = mysqli_fetch_assoc($consulta_tipo_metodo_envio);

    $nombre_tipo_metodo_envio_get                     = $datos_tipo_metodo_envio['nombre_tipo_metodo_envio'];
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
    <?php if ($cod_estado_tipo_compra_global == '1') { ?><th style="text-align:center;">TIPO COMPRA</th><?php } ?>  
  </tr>
  <tr>
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
    <td style="text-align:center;">
        <select name="cod_dependencia" id="cod_dependencia" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_dependencia)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
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
            <?php if (isset($cod_tipo_pago)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
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
    <?php if ($cod_estado_tipo_compra_global == '1') { ?>
    <td style="text-align:center;">
        <select name="nombre_tipo_compra" id="nombre_tipo_compra" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" required>
            <?php if (isset($nombre_tipo_compra)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT nombre_tipo_compra FROM tbl15_tipo_compra ORDER BY nombre_tipo_compra DESC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_compra) AND $nombre_tipo_compra == $datos2['nombre_tipo_compra']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_compra'];
            $nombre = $datos2['nombre_tipo_compra'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <?php } else { ?><input name="nombre_tipo_compra" type="hidden" value="0"/><?php } ?>  
  </tr>
  <tr>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO FACTURA</th>
    <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?>
    <th style="text-align:center;">METODO ENVIO</th>
    <?php } ?>
  </tr>
  <tr>
    <td style="text-align:center;">
        <input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" style="width: 140px;" required/>
        <?php if ($cod_estado_hora_reporte_venta_global == '1') { ?>
        <input class="input-block-level" name="fecha_hora_venta_producto_ini" type="time" value="<?php echo $fecha_hora_venta_producto_ini ?>" style="width: 140px;" required/>
        <?php } ?>
    </td>

    <td style="text-align:center;">
        <input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" style="width: 140px;" required/>
        <?php if ($cod_estado_hora_reporte_venta_global == '1') { ?>
        <input class="input-block-level" name="fecha_hora_venta_producto_fin" type="time" value="<?php echo $fecha_hora_venta_producto_fin ?>" style="width: 140px;" required/>
        <?php } ?>
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

    <td style="text-align:center;">
        <select name="nombre_tipo_factura" id="nombre_tipo_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" required>
            <?php if (isset($nombre_tipo_factura)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT nombre_tipo_factura FROM tbl15_tipo_factura ORDER BY nombre_tipo_factura DESC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_factura'];
            $nombre = $datos2['nombre_tipo_factura'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?>
    <td style="text-align:center;">
        <select name="cod_tipo_metodo_envio" id="cod_tipo_metodo_envio" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_metodo_envio)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tipo_metodo_envio, nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio WHERE (cod_estado = '1') ORDER BY cod_tipo_metodo_envio ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_metodo_envio) AND $cod_tipo_metodo_envio == $datos2['cod_tipo_metodo_envio']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_metodo_envio'];
            $nombre = $datos2['nombre_tipo_metodo_envio'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <?php } ?>
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

        $sql_total_base_venddor = "SELECT SUM(total_base_cierre_caja) AS total_base_cierre_caja FROM tbl15_administrador";
        $consulta_total_base_venddor = mysqli_query($conectar, $sql_total_base_venddor) or die(mysqli_error($conectar));
        $datos_total_base_venddor = mysqli_fetch_assoc($consulta_total_base_venddor);

        $total_base_cierre_caja                                  = intval($datos_total_base_venddor['total_base_cierre_caja']);
    } else {
        $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";

        $sql_total_base_venddor = "SELECT SUM(total_base_cierre_caja) AS total_base_cierre_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
        $consulta_total_base_venddor = mysqli_query($conectar, $sql_total_base_venddor) or die(mysqli_error($conectar));
        $datos_total_base_venddor = mysqli_fetch_assoc($consulta_total_base_venddor);

        $total_base_cierre_caja                                  = intval($datos_total_base_venddor['total_base_cierre_caja']);
    }

    if ($cod_tercero==0) {
        $filtro_consulta_tercero = "";
        $filtro_consulta_tercero_rel = "";
    } else {
        $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
        $filtro_consulta_tercero_rel = "AND (tbl15_venta_producto.cod_tercero = '$cod_tercero')";
    }

    if ($cod_tipo_pago==0) {
        $filtro_consulta_tipo_pago = "";
        $filtro_consulta_tipo_pago_rel = "";
    } else {
        $filtro_consulta_tipo_pago = "AND (cod_tipo_pago = '$cod_tipo_pago')";
        $filtro_consulta_tipo_pago_rel = "AND (tbl15_venta_producto.cod_tipo_pago = '$cod_tipo_pago')";
    }

    if ($cod_tipo_forma_pago==0) {
        $filtro_consulta_tipo_forma_pago = "";
        $filtro_consulta_tipo_forma_pago_rel = "";
    } else {
        $filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
        $filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_venta_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    }

    if ($cod_dependencia==0) {
        $filtro_consulta_dependencia = "";
        $filtro_consulta_dependencia_rel = "";
    } else {
        $filtro_consulta_dependencia = "AND (cod_dependencia = '$cod_dependencia')";
        $filtro_consulta_dependencia_rel = "AND (tbl15_venta_producto.cod_dependencia = '$cod_dependencia')";
    }

    if ($nombre_tipo_factura=='0') {
        $filtro_consulta_nombre_tipo_factura = "";
        $filtro_consulta_nombre_tipo_factura_rel = "";
    } else {
        $filtro_consulta_nombre_tipo_factura = "AND (nombre_tipo_factura = '$nombre_tipo_factura')";
        $filtro_consulta_nombre_tipo_factura_rel = "AND (tbl15_venta_producto.nombre_tipo_factura = '$nombre_tipo_factura')";
    }
    
    if ($nombre_tipo_compra=='0') {
        $filtro_consulta_nombre_tipo_compra = "";
        $filtro_consulta_nombre_tipo_compra_rel = "";
    } else {
        $filtro_consulta_nombre_tipo_compra = "AND (nombre_tipo_compra = '$nombre_tipo_compra')";
        $filtro_consulta_nombre_tipo_compra_rel = "AND (tbl15_venta_producto.nombre_tipo_compra = '$nombre_tipo_compra')";
    }

    if ($cod_tipo_metodo_envio==0) {
        $filtro_consulta_tipo_metodo_envio = "";
        $filtro_consulta_tipo_metodo_envio_rel = "";
    } else {
        $filtro_consulta_tipo_metodo_envio = "AND (cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
        $filtro_consulta_tipo_metodo_envio_rel = "AND (tbl15_venta_producto.cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
    }
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_suma_compra_producto, 
    SUM(total_venta_producto * (comision_ptj/100)) AS total_comision 
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta = mysqli_query($conectar, $sql_total_venta) or die(mysqli_error($conectar));
    $datos_total_venta = mysqli_fetch_assoc($consulta_total_venta);

    $total_suma_venta_producto                                    = $datos_total_venta['total_suma_venta_producto'];
    $total_suma_compra_producto                                   = $datos_total_venta['total_suma_compra_producto'];
    $total_ganancia                                               = $total_suma_venta_producto - $total_suma_compra_producto;
    $total_utilidad_bruta                                         = $total_suma_venta_producto - $total_suma_compra_producto;
    $total_ganancia_venta                                         = $total_suma_venta_producto - $total_suma_compra_producto;
    $total_comision_venta                                         = $datos_total_venta['total_comision'];
    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $total_ganancia_porcentaje = (($total_ganancia / $total_suma_compra_producto) * 100); } else { $total_ganancia_porcentaje = (($total_ganancia / $total_suma_venta_producto) * 100); }
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_ganancia_venta_contado = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_suma_compra_producto 
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  $condicion_hora_reporte_venta 
    $filtro_consulta_vendedor $filtro_consulta_tercero AND (cod_tipo_pago = '$contado') $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_ganancia_venta_contado = mysqli_query($conectar, $sql_total_ganancia_venta_contado) or die(mysqli_error($conectar));
    $datos_total_ganancia_venta_contado = mysqli_fetch_assoc($consulta_total_ganancia_venta_contado);

    $total_suma_venta_producto_contado                             = $datos_total_ganancia_venta_contado['total_suma_venta_producto'];
    $total_suma_compra_producto_contado                            = $datos_total_ganancia_venta_contado['total_suma_compra_producto'];
    $total_ganancia_venta_contado                                  = $total_suma_venta_producto_contado - $total_suma_compra_producto_contado;
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_credito_utilidad_neta_abono = "SELECT SUM(total_utilidad_neta) AS total_utilidad_neta_abono_cuenta_cobrar_credito FROM tbl15_cuentas_cobrar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia";
    $consulta_cuenta_credito_utilidad_neta_abono = mysqli_query($conectar, $sql_total_cuenta_credito_utilidad_neta_abono) or die(mysqli_error($conectar));
    $datos_cuenta_credito_utilidad_neta_abono = mysqli_fetch_assoc($consulta_cuenta_credito_utilidad_neta_abono);

    $total_utilidad_neta_abono_cuenta_cobrar_credito              = $datos_cuenta_credito_utilidad_neta_abono['total_utilidad_neta_abono_cuenta_cobrar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_utilidad_bruta_contado = "SELECT SUM(total_venta_producto) AS total_venta_producto_utilidad_bruta_contado, SUM(total_compra_producto) AS total_compra_producto_utilidad_bruta_contado 
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  $condicion_hora_reporte_venta 
    $filtro_consulta_vendedor $filtro_consulta_tercero AND (cod_tipo_pago = '$contado') $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_utilidad_bruta_contado = mysqli_query($conectar, $sql_total_venta_utilidad_bruta_contado) or die(mysqli_error($conectar));
    $datos_total_venta_utilidad_bruta_contado = mysqli_fetch_assoc($consulta_total_venta_utilidad_bruta_contado);

    $total_venta_producto_utilidad_bruta_contado                  = $datos_total_venta_utilidad_bruta_contado['total_venta_producto_utilidad_bruta_contado'];
    $total_compra_producto_utilidad_bruta_contado                 = $datos_total_venta_utilidad_bruta_contado['total_compra_producto_utilidad_bruta_contado'];
    $total_utilidad_bruta_contado                                 = ($total_venta_producto_utilidad_bruta_contado + $total_utilidad_neta_abono_cuenta_cobrar_credito) - $total_compra_producto_utilidad_bruta_contado;
    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $total_utilidad_bruta_contado_porcentaje = (($total_utilidad_bruta_contado / $total_compra_producto_utilidad_bruta_contado) * 100); } else { $total_utilidad_bruta_contado_porcentaje = (($total_utilidad_bruta_contado / $total_venta_producto_utilidad_bruta_contado) * 100); }
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_contado_efectivo = "SELECT SUM(total_venta_producto) AS total_venta_producto_contado_efectivo, SUM(total_compra_producto) AS total_compra_producto
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_contado_efectivo = mysqli_query($conectar, $sql_total_venta_contado_efectivo) or die(mysqli_error($conectar));
    $datos_total_venta_contado_efectivo = mysqli_fetch_assoc($consulta_total_venta_contado_efectivo);

    $total_venta_producto_contado_efectivo                = $datos_total_venta_contado_efectivo['total_venta_producto_contado_efectivo'];
    $total_compra_producto_contado                        = $datos_total_venta_contado_efectivo['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_contado_transferencia = "SELECT SUM(total_venta_producto) AS total_venta_producto_contado_transferencia, SUM(total_compra_producto) AS total_compra_producto_transfrencia
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$transfer') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_contado_transferencia = mysqli_query($conectar, $sql_total_venta_contado_transferencia) or die(mysqli_error($conectar));
    $datos_total_venta_contado_transferencia = mysqli_fetch_assoc($consulta_total_venta_contado_transferencia);

    $total_venta_producto_contado_transferencia           = $datos_total_venta_contado_transferencia['total_venta_producto_contado_transferencia'];
    $total_compra_producto_contado_transfrencia           = $datos_total_venta_contado_transferencia['total_compra_producto_transfrencia'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_contado = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$contado') $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago 
    $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_contado = mysqli_query($conectar, $sql_total_venta_contado) or die(mysqli_error($conectar));
    $datos_total_venta_contado = mysqli_fetch_assoc($consulta_total_venta_contado);

    $total_venta_producto_contado                         = $datos_total_venta_contado['total_venta_producto'];
    $total_compra_producto_contado                        = $datos_total_venta_contado['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_credito = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto 
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$credito') $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago 
    $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_credito = mysqli_query($conectar, $sql_total_venta_credito) or die(mysqli_error($conectar));
    $datos_total_venta_credito = mysqli_fetch_assoc($consulta_total_venta_credito);

    $total_venta_producto_credito                         = $datos_total_venta_credito['total_venta_producto'];
    $total_compra_producto_credito                        = $datos_total_venta_credito['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_servicio_propina = "SELECT SUM(total_venta_producto) AS total_suma_servicio_propina FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta
    AND (cod_producto_barra = '$cod_servicio_propina') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_servicio_propina = mysqli_query($conectar, $sql_total_servicio_propina) or die(mysqli_error($conectar));
    $datos_total_servicio_propina = mysqli_fetch_assoc($consulta_total_servicio_propina);

    $total_suma_servicio_propina                          = $datos_total_servicio_propina['total_suma_servicio_propina'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_servicio_cava = "SELECT SUM(total_venta_producto) AS total_suma_servicio_cava FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta
    AND (cod_producto_barra = '$cod_servicio_cava') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_servicio_cava = mysqli_query($conectar, $sql_total_servicio_cava) or die(mysqli_error($conectar));
    $datos_total_servicio_cava = mysqli_fetch_assoc($consulta_total_servicio_cava);

    $total_suma_servicio_cava                          = $datos_total_servicio_cava['total_suma_servicio_cava'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_servicio_domicilio = "SELECT SUM(total_venta_producto) AS total_suma_servicio_domicilio FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta
    AND (cod_producto_barra = '$cod_servicio_domicilio') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_servicio_domicilio = mysqli_query($conectar, $sql_total_servicio_domicilio) or die(mysqli_error($conectar));
    $datos_total_servicio_domicilio = mysqli_fetch_assoc($consulta_total_servicio_domicilio);

    $total_suma_servicio_domicilio                          = $datos_total_servicio_domicilio['total_suma_servicio_domicilio'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_servicio_descuento_punto_redimible = "SELECT SUM(total_venta_producto) AS total_suma_servicio_descuento_punto_redimible FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta
    AND (cod_producto_barra = '$cod_servicio_descuento_punto_redimible') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_servicio_descuento_punto_redimible = mysqli_query($conectar, $sql_total_servicio_descuento_punto_redimible) or die(mysqli_error($conectar));
    $datos_total_servicio_descuento_punto_redimible = mysqli_fetch_assoc($consulta_total_servicio_descuento_punto_redimible);

    $total_suma_servicio_descuento_punto_redimible                          = $datos_total_servicio_descuento_punto_redimible['total_suma_servicio_descuento_punto_redimible'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_credito_abono_en_efectivo = "SELECT SUM(abonado) AS total_abono_en_efectivo_cuenta_cobrar_credito FROM tbl15_cuentas_cobrar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
    $filtro_consulta_vendedor $filtro_consulta_tercero AND (cod_tipo_forma_pago = '1') $filtro_consulta_dependencia";
    $consulta_cuenta_credito_abono_en_efectivo = mysqli_query($conectar, $sql_total_cuenta_credito_abono_en_efectivo) or die(mysqli_error($conectar));
    $datos_cuenta_credito_abono_en_efectivo = mysqli_fetch_assoc($consulta_cuenta_credito_abono_en_efectivo);

    $total_abono_en_efectivo_cuenta_cobrar_credito        = $datos_cuenta_credito_abono_en_efectivo['total_abono_en_efectivo_cuenta_cobrar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_credito_abono_en_transferencia = "SELECT SUM(abonado) AS total_abono_en_transferencia_cuenta_cobrar_credito FROM tbl15_cuentas_cobrar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
    $filtro_consulta_vendedor $filtro_consulta_tercero AND (cod_tipo_forma_pago = '10') $filtro_consulta_dependencia";
    $consulta_cuenta_credito_abono_en_transferencia = mysqli_query($conectar, $sql_total_cuenta_credito_abono_en_transferencia) or die(mysqli_error($conectar));
    $datos_cuenta_credito_abono_en_transferencia = mysqli_fetch_assoc($consulta_cuenta_credito_abono_en_transferencia);

    $total_abono_en_transferencia_cuenta_cobrar_credito        = $datos_cuenta_credito_abono_en_transferencia['total_abono_en_transferencia_cuenta_cobrar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_credito_abono = "SELECT SUM(abonado) AS total_abono_cuenta_cobrar_credito FROM tbl15_cuentas_cobrar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia";
    $consulta_cuenta_credito_abono = mysqli_query($conectar, $sql_total_cuenta_credito_abono) or die(mysqli_error($conectar));
    $datos_cuenta_credito_abono = mysqli_fetch_assoc($consulta_cuenta_credito_abono);

    $total_abono_cuenta_cobrar_credito                    = $datos_cuenta_credito_abono['total_abono_cuenta_cobrar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_pagar_credito_abono_en_efectivo = "SELECT SUM(abonado) AS total_abono_en_efectivo_cuenta_pagar_credito FROM tbl15_cuentas_pagar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_forma_pago = '1')";
    $consulta_cuenta_pagar_credito_abono_en_efectivo = mysqli_query($conectar, $sql_total_cuenta_pagar_credito_abono_en_efectivo) or die(mysqli_error($conectar));
    $datos_cuenta_pagar_credito_abono_en_efectivo = mysqli_fetch_assoc($consulta_cuenta_pagar_credito_abono_en_efectivo);

    $total_abono_en_efectivo_cuenta_pagar_credito         = $datos_cuenta_pagar_credito_abono_en_efectivo['total_abono_en_efectivo_cuenta_pagar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_pagar_credito_abono_en_transferencia = "SELECT SUM(abonado) AS total_abono_en_transferencia_cuenta_cobrar_credito FROM tbl15_cuentas_pagar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_forma_pago = '10')";
    $consulta_cuenta_pagar_credito_abono_en_transferencia = mysqli_query($conectar, $sql_total_cuenta_pagar_credito_abono_en_transferencia) or die(mysqli_error($conectar));
    $datos_cuenta_pagar_credito_abono_en_transferencia = mysqli_fetch_assoc($consulta_cuenta_pagar_credito_abono_en_transferencia);

    $total_abono_en_transferencia_cuenta_pagar_credito         = $datos_cuenta_pagar_credito_abono_en_transferencia['total_abono_en_transferencia_cuenta_cobrar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_pagar_credito_abono = "SELECT SUM(abonado) AS total_abono_cuenta_pagar_credito FROM tbl15_cuentas_pagar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
    $consulta_cuenta_pagar_credito_abono = mysqli_query($conectar, $sql_total_cuenta_pagar_credito_abono) or die(mysqli_error($conectar));
    $datos_cuenta_pagar_credito_abono = mysqli_fetch_assoc($consulta_cuenta_pagar_credito_abono);

    $total_abono_cuenta_pagar_credito                     = $datos_cuenta_pagar_credito_abono['total_abono_cuenta_pagar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $total_caja_venta_fisica                              = ($total_venta_producto_contado_efectivo + $total_abono_en_efectivo_cuenta_cobrar_credito) - $total_abono_en_efectivo_cuenta_pagar_credito;
    //$total_caja_venta_fisica                              = ($total_venta_producto_contado_efectivo + $total_abono_en_efectivo_cuenta_cobrar_credito);
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_egreso_normal = "SELECT SUM(costo) AS total_egreso FROM tbl15_egreso 
    WHERE (fecha_dmy BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
    $consulta_total_egreso_normal = mysqli_query($conectar, $sql_total_egreso_normal) or die(mysqli_error($conectar));
    $datos_total_egreso_normal = mysqli_fetch_assoc($consulta_total_egreso_normal);

    $total_egreso_normal                                  = $datos_total_egreso_normal['total_egreso'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_egreso_movimiento_contable = "SELECT SUM(total_costo_movimiento_contable) AS total_egreso_movimiento_contable FROM tbl15_movimiento_contable 
    WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND ((nombre_tipo_documento = 'COMPROBANTE DE EGRESO') AND (nombre_estado_factura = 'CERRADA'))";
    $consulta_total_egreso_movimiento_contable = mysqli_query($conectar, $sql_total_egreso_movimiento_contable) or die(mysqli_error($conectar));
    $datos_total_egreso_movimiento_contable = mysqli_fetch_assoc($consulta_total_egreso_movimiento_contable);

    $total_egreso_movimiento_contable                      = $datos_total_egreso_movimiento_contable['total_egreso_movimiento_contable'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_info_totales_egresos = "SELECT SUM(costo_movimiento_contable) AS total_costo_movimiento_contable_egresos FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tipo_puc = 'EGRESOS')";
    $resultado_info_totales_egresos = mysqli_query($conectar, $sql_info_totales_egresos) or die(mysqli_error($conectar));
    $info_info_totales_egresos = mysqli_fetch_assoc($resultado_info_totales_egresos);

    $total_costo_movimiento_contable_egresos         = $info_info_totales_egresos['total_costo_movimiento_contable_egresos'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_info_totales_egresos_efectivo = "SELECT SUM(costo_movimiento_contable) AS total_costo_movimiento_contable_egresos FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tipo_puc = 'EGRESOS') AND (cod_tipo_forma_pago = '$efectivo')";
    $resultado_info_totales_egresos_efectivo = mysqli_query($conectar, $sql_info_totales_egresos_efectivo) or die(mysqli_error($conectar));
    $info_info_totales_egresos_efectivo = mysqli_fetch_assoc($resultado_info_totales_egresos_efectivo);

    $total_costo_movimiento_contable_egresos_efectivo   = $info_info_totales_egresos_efectivo['total_costo_movimiento_contable_egresos'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_info_totales_egresos_transfer = "SELECT SUM(costo_movimiento_contable) AS total_costo_movimiento_contable_egresos FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tipo_puc = 'EGRESOS') AND (cod_tipo_forma_pago = '$transfer')";
    $resultado_info_totales_egresos_transfer = mysqli_query($conectar, $sql_info_totales_egresos_transfer) or die(mysqli_error($conectar));
    $info_info_totales_egresos_transfer = mysqli_fetch_assoc($resultado_info_totales_egresos_transfer);

    $total_costo_movimiento_contable_egresos_transfer         = $info_info_totales_egresos_transfer['total_costo_movimiento_contable_egresos'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_iva_venta = "SELECT SUM((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
    SUM(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva_producto_venta 
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_iva_venta = mysqli_query($conectar, $sql_total_iva_venta) or die(mysqli_error($conectar));
    $datos_total_iva_venta = mysqli_fetch_assoc($consulta_total_iva_venta);

    $subtotal_base                                         = $datos_total_iva_venta['subtotal_base'];
    $total_iva_producto_venta                              = $datos_total_iva_venta['total_iva_producto_venta'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_movimiento_contable_cuenta_personal_concepto = "SELECT SUM(costo_movimiento_contable) AS total_factura_compra_movimiento_contable_personal FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_info_factura_compra <> '0')";
    $consulta_movimiento_contable_cuenta_personal_concepto = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_concepto) or die(mysqli_error($conectar));
    $datos_movimiento_contable_cuenta_personal_concepto = mysqli_fetch_assoc($consulta_movimiento_contable_cuenta_personal_concepto);

    $total_factura_compra_movimiento_contable_personal   = $datos_movimiento_contable_cuenta_personal_concepto['total_factura_compra_movimiento_contable_personal'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_movimiento_contable_cuenta_personal_concepto_efectivo = "SELECT SUM(costo_movimiento_contable) AS total_factura_compra_movimiento_contable_personal FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo') AND (cod_info_factura_compra <> '0')";
    $consulta_movimiento_contable_cuenta_personal_concepto_efectivo = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_concepto_efectivo) or die(mysqli_error($conectar));
    $datos_movimiento_contable_cuenta_personal_concepto_efectivo = mysqli_fetch_assoc($consulta_movimiento_contable_cuenta_personal_concepto_efectivo);

    $total_factura_compra_movimiento_contable_personal_efectivo   = $datos_movimiento_contable_cuenta_personal_concepto_efectivo['total_factura_compra_movimiento_contable_personal'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_movimiento_contable_cuenta_personal_concepto_transfer = "SELECT SUM(costo_movimiento_contable) AS total_factura_compra_movimiento_contable_personal FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_forma_pago = '$transfer') AND (cod_info_factura_compra <> '0')";
    $consulta_movimiento_contable_cuenta_personal_concepto_transfer = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_concepto_transfer) or die(mysqli_error($conectar));
    $datos_movimiento_contable_cuenta_personal_concepto_transfer = mysqli_fetch_assoc($consulta_movimiento_contable_cuenta_personal_concepto_transfer);

    $total_factura_compra_movimiento_contable_personal_transfer   = $datos_movimiento_contable_cuenta_personal_concepto_transfer['total_factura_compra_movimiento_contable_personal'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_movimiento_contable_cuenta_personal_concepto_contado = "SELECT SUM(costo_movimiento_contable) AS total_factura_compra_movimiento_contable_personal FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '$contado') AND (cod_info_factura_compra <> '0')";
    $consulta_movimiento_contable_cuenta_personal_concepto_contado = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_concepto_contado) or die(mysqli_error($conectar));
    $datos_movimiento_contable_cuenta_personal_concepto_contado = mysqli_fetch_assoc($consulta_movimiento_contable_cuenta_personal_concepto_contado);

    $total_factura_compra_movimiento_contable_personal_contado   = $datos_movimiento_contable_cuenta_personal_concepto_contado['total_factura_compra_movimiento_contable_personal'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_movimiento_contable_cuenta_personal_concepto_credito = "SELECT SUM(costo_movimiento_contable) AS total_factura_compra_movimiento_contable_personal FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '$credito') AND (cod_info_factura_compra <> '0')";
    $consulta_movimiento_contable_cuenta_personal_concepto_credito = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_concepto_credito) or die(mysqli_error($conectar));
    $datos_movimiento_contable_cuenta_personal_concepto_credito = mysqli_fetch_assoc($consulta_movimiento_contable_cuenta_personal_concepto_credito);

    $total_factura_compra_movimiento_contable_personal_credito   = $datos_movimiento_contable_cuenta_personal_concepto_credito['total_factura_compra_movimiento_contable_personal'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {
        $total_egreso                                          = $total_costo_movimiento_contable_egresos;
    } else {
        $total_egreso                                          = $total_egreso_normal + $total_egreso_movimiento_contable;
    }
    $total_utilidad_neta                                       = $total_utilidad_bruta_contado - $total_egreso;
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $total_caja_venta_fisica_mas_base_vendedor                 = $total_caja_venta_fisica + $total_base_cierre_caja;
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
        <td style="text-align:left;">TIPO DE FACTURA: <?php echo $nombre_tipo_factura_get ?></td>
        <td style="text-align:left;">FECHA INICAL: <?php echo $fecha_ymd_venta_producto_ini ?><?php if ($cod_estado_hora_reporte_venta_global == '1') { ?> | <?php echo $fecha_hora_venta_producto_ini ?><?php } ?></td>
        <td style="text-align:left;">FECHA FINAL: <?php echo $fecha_ymd_venta_producto_fin ?><?php if ($cod_estado_hora_reporte_venta_global == '1') { ?> | <?php echo $fecha_hora_venta_producto_fin ?><?php } ?></td>
    </tr>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_totalventa==1) { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center;"><a href="#"><strong>CONSOLIDADO DE VENTAS</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
    <tr>
        <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
    </tr>
</table>

<table class="table table-striped">
    <tr>
        <?php if ($cod_estado_prod_precio_compra==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_suma_compra_producto">Total P.Compra</a></th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_suma_venta_producto">Total P.Venta</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_venta_producto_contado">Total Venta Contado</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_venta_producto_credito">Total Venta Credito</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_venta_producto_contado_efectivo">Total Venta (En Efectivo)</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_abono_cuenta_cobrar_credito">Total Abonos (Cuentas Cobrar)</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_abono_en_efectivo_cuenta_cobrar_credito">Total Abono En Efectivo (Cuentas Cobrar)</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_abono_cuenta_pagar_credito">Total Abonos (Cuentas Pagar)</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_abono_en_efectivo_cuenta_pagar_credito">Total Abono En Efectivo (Cuentas Pagar)</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_caja_venta_fisica">Total Caja (En Efectivo)</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_iva_producto_venta">Total Iva</a></th>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_ganancia">$Total Ganancia</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_ganancia_porcentaje">%Ganancia</th>
        <!--<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="aaaaaaaaaa">$Total Ganancia (Venta Contado)</th>-->
        <?php } ?>
        <?php if ($cod_estado_reporte_venta_total_compra_caja_registradora_global==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_factura_compra_movimiento_contable_personal">Total Factura de Compra</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_factura_compra_movimiento_contable_personal_efectivo">Total Factura de Compra (En Efectivo)</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_factura_compra_movimiento_contable_personal_transfer">Total Factura de Compra (Transferencia)</a></th>

        <?php } ?>
        <?php if ($cod_estado_egreso_registrar==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_egreso">Total Egresos</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_costo_movimiento_contable_egresos_efectivo">Total Egresos (En Efectivo)</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_costo_movimiento_contable_egresos_transfer">Total Egresos (Transferencia)</a></th>
        <?php } ?>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_utilidad_bruta_contado">$Total Utilidad Bruta</th>
        <?php } ?>
        <?php if ($cod_estado_reporte_venta_total_utilidad==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_utilidad_neta">$Total Utilidad Neta</th>
        <?php } ?>
        <?php if ($cod_estado_ptj_comision_global == '1') { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_comision_venta">Total Comision</th>
        <?php } ?>
        <?php if ($cod_estado_propina_global == '1') { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_suma_servicio_propina">Total Propina</th>
        <?php } ?>
        <?php if ($cod_estado_mod_domicilio_y_estado_habilitado_producto_global == '1') { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_suma_servicio_domicilio">Total Domicilio</th>
        <?php } ?>
    </tr>
    <tr>
        <?php if ($cod_estado_prod_precio_compra==1) { ?><td style="text-align:center;"><?php echo number_format($total_suma_compra_producto, 0, ",", ".") ?></td><?php } ?>
        <td style="text-align:center;"><?php echo number_format($total_suma_venta_producto, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_venta_producto_contado, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_venta_producto_credito, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_venta_producto_contado_efectivo, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_abono_cuenta_cobrar_credito, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_abono_en_efectivo_cuenta_cobrar_credito, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_abono_cuenta_pagar_credito, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_abono_en_efectivo_cuenta_pagar_credito, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_caja_venta_fisica, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_iva_producto_venta, 0, ",", ".") ?></td>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <td style="text-align:center;"><?php echo number_format($total_ganancia, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_ganancia_porcentaje, 0, ",", ".") ?>%</td>
        <!--<td style="text-align:center;"><?php echo number_format($total_ganancia_venta_contado, 0, ",", ".") ?></td>-->
        <?php } ?>
        <?php if ($cod_estado_reporte_venta_total_compra_caja_registradora_global==1) { ?>
        <td style="text-align:center;"><?php echo number_format($total_factura_compra_movimiento_contable_personal, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_factura_compra_movimiento_contable_personal_efectivo, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_factura_compra_movimiento_contable_personal_transfer, 0, ",", ".") ?></td>
        <?php } ?>
        <?php if ($cod_estado_egreso_registrar==1) { ?>
        <td style="text-align:center;"><?php echo number_format($total_egreso, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_costo_movimiento_contable_egresos_efectivo, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_costo_movimiento_contable_egresos_transfer, 0, ",", ".") ?></td>
        <?php } ?>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <td style="text-align:center;"><?php echo number_format($total_utilidad_bruta_contado, 0, ",", ".") ?></td>
        <?php } ?>
        <?php if ($cod_estado_reporte_venta_total_utilidad==1) { ?>
        <td style="text-align:center;"><?php echo number_format($total_utilidad_neta, 0, ",", ".") ?></td>
        <?php } ?>
        <?php if ($cod_estado_ptj_comision_global == '1') { ?>
        <td style="text-align:center;"><?php echo number_format($total_comision_venta, 0, ",", ".") ?></td>
        <?php } ?>
        <?php if ($cod_estado_propina_global == '1') { ?>
        <td style="text-align:center;"><?php echo number_format($total_suma_servicio_propina, 0, ",", ".") ?></td>
        <?php } ?>
        <?php if ($cod_estado_mod_domicilio_y_estado_habilitado_producto_global == '1') { ?>
        <td style="text-align:center;"><?php echo number_format($total_suma_servicio_domicilio, 0, ",", ".") ?></td>
        <?php } ?>
    </tr>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_reporte_venta_total_compra_caja_registradora_global==1) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center; background-color:#DBE0F3; color:#000; width:10%;"><a href="#">Caja En Efectivo.</a></th>
                <th style="text-align:center; background-color:#DBE0F3; color:#000; width:10%;"><a href="#">Total Caja (En Efectivo).</a></th>
            </tr>
        </thead>
    <tbody>
    <?php
    $totales_forma_pago_efectivo = 0;
    $filtro_consulta_tipo_forma_pago_rel_efectivo = "AND (tbl15_venta_producto.cod_tipo_forma_pago = '1')";
    $filtro_consulta_tipo_pago_rel_contado = "AND (tbl15_venta_producto.cod_tipo_pago = '1')";

    $sql_total_forma_pago_efectivo = "SELECT Sum(tbl15_venta_producto.total_venta_producto) AS suma_total_venta_producto, tbl15_tipo_forma_pago.nombre_tipo_forma_pago
    FROM tbl15_tipo_forma_pago RIGHT JOIN tbl15_venta_producto ON tbl15_tipo_forma_pago.cod_tipo_forma_pago = tbl15_venta_producto.cod_tipo_forma_pago
    WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tbl15_venta_producto.cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  $condicion_hora_reporte_venta_rel 
    $filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel_contado $filtro_consulta_tipo_forma_pago_rel_efectivo 
    $filtro_consulta_dependencia_rel $filtro_consulta_nombre_tipo_factura_rel $filtro_consulta_nombre_tipo_compra_rel $filtro_consulta_tipo_metodo_envio_rel 
    GROUP BY tbl15_tipo_forma_pago.cod_tipo_forma_pago";
    $consulta_total_forma_pago_efectivo = mysqli_query($conectar, $sql_total_forma_pago_efectivo) or die(mysqli_error($conectar));
    $datos_total_forma_pago_efectivo = mysqli_fetch_assoc($consulta_total_forma_pago_efectivo);

    $nombre_tipo_forma_pago_efectivo        = $datos_total_forma_pago_efectivo['nombre_tipo_forma_pago'];
    $suma_total_venta_producto              = $datos_total_forma_pago_efectivo['suma_total_venta_producto'];
    $totales_forma_pago_efectivo            = ($suma_total_venta_producto + $total_abono_en_efectivo_cuenta_cobrar_credito) - ($total_factura_compra_movimiento_contable_personal_efectivo + $total_egreso) - ($total_abono_en_efectivo_cuenta_pagar_credito)
    //$totales_forma_pago_efectivo            = ($suma_total_venta_producto + $total_abono_en_efectivo_cuenta_cobrar_credito) - ($total_factura_compra_movimiento_contable_personal_efectivo + $total_egreso)
    ?>
            <tr>
                <td style="text-align:center"><?php echo $nombre_tipo_forma_pago_efectivo?></td>
                <td style="text-align:center"><?php echo number_format($totales_forma_pago_efectivo, 0, ",", ".")?></td>
            </tr>
        </tbody>
    </table>
<?php } ?>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; width:10%;"><a href="#">Forma de Pago</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; width:10%;"><a href="#">Total Venta</a></th>
        </tr>
    </thead>
<tbody>
<?php
$totales_forma_pago = 0;

$sql_total_forma_pago = "SELECT Sum(tbl15_venta_producto.total_venta_producto) AS suma_total_venta_producto, tbl15_tipo_forma_pago.nombre_tipo_forma_pago
FROM tbl15_tipo_forma_pago RIGHT JOIN tbl15_venta_producto ON tbl15_tipo_forma_pago.cod_tipo_forma_pago = tbl15_venta_producto.cod_tipo_forma_pago
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tbl15_venta_producto.cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  $condicion_hora_reporte_venta_rel 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel 
$filtro_consulta_dependencia_rel $filtro_consulta_nombre_tipo_factura_rel $filtro_consulta_nombre_tipo_compra_rel $filtro_consulta_tipo_metodo_envio_rel 
GROUP BY tbl15_tipo_forma_pago.cod_tipo_forma_pago";
$consulta_total_forma_pago = mysqli_query($conectar, $sql_total_forma_pago) or die(mysqli_error($conectar));
while ($datos_total_forma_pago = mysqli_fetch_assoc($consulta_total_forma_pago)) {

    $nombre_tipo_forma_pago        = $datos_total_forma_pago['nombre_tipo_forma_pago'];
    $suma_total_venta_producto     = $datos_total_forma_pago['suma_total_venta_producto'];
    $totales_forma_pago            = $totales_forma_pago + $suma_total_venta_producto
?>
        <tr>
            <td style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
            <td style="text-align:center"><?php echo number_format($suma_total_venta_producto, 0, ",", ".")?></td>
        </tr>
<?php } ?>
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; width:10%;">TOTAL</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000; width:10%;"><?php echo number_format($totales_forma_pago, 0, ",", ".")?></th>
        </tr>
    </tbody>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_cuenta_cobrar == '1') { ?>
<table class="table table-striped">
<tr>
<td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>FORMAS DE PAGOS ABONOS CUENTA POR COBRAR (ABONOS CARTERA)</strong></a></td>
</tr>
</table>

<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>FORMA PAGO</strong></a></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>ABONOS</strong></a></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>FECHA</strong></a></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>HORA</strong></a></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>ID</strong></a></td>
        <!--<td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>IMP</strong></td>-->
    </tr>
<?php
$total_abonado = 0;

$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia ORDER BY cod_cuentas_cobrar_abonos DESC";
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

    $sql_tercero = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

    $nombre_cliente            = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido1_tercero'];
?>
    <tr>
        <td style="text-align: center;"><?php echo $nombre_tipo_forma_pago; ?></td>
        <td style="text-align: center;"><?php echo number_format($abonado, 0, ",", ".")?></td>
        <td style="text-align: center;"><?php echo $fecha_pago; ?></td>
        <td style="text-align: center;"><?php echo $hora; ?></td>
        <td style="text-align: center;"><?php echo $cod_cuentas_cobrar_abonos; ?></td>
    </tr>
<?php } ?>
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>TOTAL</strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong><?php echo number_format($total_abonado, 0, ",", ".")?></strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong></strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong></strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong></strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong></strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong></strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong></strong></td>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong></strong></td>
        <!--<td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>IMP</strong></td>-->
    </tr>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_impuestos==1) { ?>
<hr>
<table class="table table-striped">
<tr>
<td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS IMPUESTOS</strong></a></td>
</tr>
</table>

<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="../admin/imprimir_datos_ventas_pos_ivas_pdf.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_administrador=<?php echo addslashes($_GET['cod_administrador']) ?>&cod_tercero=<?php echo addslashes($_GET['cod_tercero']) ?>&cod_tipo_pago=<?php echo addslashes($_GET['cod_tipo_pago']) ?>&cod_dependencia=<?php echo addslashes($_GET['cod_dependencia']) ?>&cod_tipo_forma_pago=<?php echo addslashes($_GET['cod_tipo_pago']) ?>&nombre_tipo_factura=<?php echo addslashes($_GET['nombre_tipo_factura']) ?>" target="_blank"><img src=../imagenes/imprimir_.png alt="imprimir_peq"></a></td>
</tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Porcentaje Iva</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Valor Base</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Valor Iva</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Valor Total</a></th>
    </tr>
</thead>
<tbody>
<?php
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$total_valor_base                     = 0;
$total_valor_iva                      = 0;
$total_valor_total                    = 0;
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$sql_total_tipos_iva_ipc = "SELECT SUM(precio_ipc * und_venta) AS total_impoconsumo FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta AND (precio_ipc <> '0') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
$consulta_total_tipos_iva_ipc = mysqli_query($conectar, $sql_total_tipos_iva_ipc) or die(mysqli_error($conectar));
$datos_total_tipos_iva_ipc = mysqli_fetch_assoc($consulta_total_tipos_iva_ipc);

$total_venta_impoconsumo              = 0;
$total_base_impoconsumo               = 0;
$total_impoconsumo                    = $datos_total_tipos_iva_ipc['total_impoconsumo'];
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$mostrar_datos_sql = "SELECT  cod_tipo_iva, nombre_tipo_iva, descripcion_tipo_iva, iva, nombre_estado FROM tbl15_tipo_iva WHERE nombre_estado = 'ACTIVO' ORDER BY iva ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

$iva_ptj                                 = $datos['iva'];

$sql_total_tipos_iva = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva_impuesto_contadores 
FROM tbl15_venta_producto WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
AND (iva_ptj = '$iva_ptj') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
$consulta_total_tipos_iva = mysqli_query($conectar, $sql_total_tipos_iva) or die(mysqli_error($conectar));
$datos_total_tipos_iva = mysqli_fetch_assoc($consulta_total_tipos_iva);

$total_venta                         = $datos_total_tipos_iva['total_venta'];
$total_base_iva                      = $datos_total_tipos_iva['total_base_iva'];
$total_iva_impuesto_contadores       = $datos_total_tipos_iva['total_iva_impuesto_contadores'];

$total_valor_base                    += $total_base_iva;
$total_valor_iva                     += $total_iva_impuesto_contadores;
$total_valor_total                   += $total_venta;

if ($iva_ptj == '0') { $operacion = 'No'; } else { $operacion = ''; }
?>
  <tr>
    <td style="text-align:left">Ingresos Por Operac. <?php echo $operacion ?> Gravadas: <?php echo $iva_ptj ?>%</td>
    <td style="text-align:right"><?php echo number_format($total_base_iva, 0, ",", "."); ?></td>
    <td style="text-align:right"><?php echo number_format($total_iva_impuesto_contadores, 0, ",", "."); ?></td>
    <td style="text-align:right"><?php echo number_format($total_venta, 0, ",", "."); ?></td>
  </tr>
<?php } ?>
  <tr>
    <td style="text-align:left">Impuesto al Consumo</td>
    <td style="text-align:right"><?php echo number_format($total_venta_impoconsumo, 0, ",", "."); ?></td>
    <td style="text-align:right"><?php echo number_format($total_base_impoconsumo, 0, ",", "."); ?></td>
    <td style="text-align:right"><?php echo number_format($total_impoconsumo, 0, ",", "."); ?></td>
  </tr>
  <tr>
    <td style="text-align:right; background-color:#DBE0F3; color:#000;"></td>
    <td style="text-align:right; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_valor_base + $total_venta_impoconsumo, 0, ",", "."); ?></td>
    <td style="text-align:right; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_valor_iva + $total_base_impoconsumo, 0, ",", "."); ?></td>
    <td style="text-align:right; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_valor_total + $total_impoconsumo, 0, ",", "."); ?></td>
  </tr>
</tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_ventasgenerales==1) { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS GENERALES</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
    <tr>
        <td style="text-align:center;"><a href="../admin/descargar_venta_generales_pos_xls.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_administrador=<?php echo addslashes($_GET['cod_administrador']) ?>&cod_tercero=<?php echo addslashes($_GET['cod_tercero']) ?>&cod_tipo_pago=<?php echo addslashes($_GET['cod_tipo_pago']) ?>&cod_tipo_forma_pago=<?php echo addslashes($_GET['cod_tipo_pago']) ?>&cod_dependencia=<?php echo addslashes($_GET['cod_dependencia']) ?>&nombre_tipo_factura=<?php echo addslashes($_GET['nombre_tipo_factura']) ?>"><img src=../imagenes/xls.png alt="imprimir_peq"></a></td>
        <td style="text-align:center;"><a href="../admin/descargar_venta_generales_pos_xlsx.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_administrador=<?php echo addslashes($_GET['cod_administrador']) ?>&cod_tercero=<?php echo addslashes($_GET['cod_tercero']) ?>&cod_tipo_pago=<?php echo addslashes($_GET['cod_tipo_pago']) ?>&cod_tipo_forma_pago=<?php echo addslashes($_GET['cod_tipo_pago']) ?>&cod_dependencia=<?php echo addslashes($_GET['cod_dependencia']) ?>&nombre_tipo_factura=<?php echo addslashes($_GET['nombre_tipo_factura']) ?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></td>
    </tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">#</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Ver</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo Factura</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Factura</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Cod</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Concepto</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Cliente</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Unidades</th>
        <?php if ($cod_estado_prod_precio_compra== '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">P.Compra</th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">P.Venta</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Total Venta</th>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><p class="text-success">$Ganancia</p></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><p class="text-success">%Ganancia</p></th>
        <?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">%Iva</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">$Iva</th>

        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Vendedor</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Fecha</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Hora</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo Pago</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Forma Pago</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Dependencia</th>
        <?php if ($cod_estado_ptj_comision_global == '1') { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">%Comision</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">$Comision</th>
        <?php } ?>
        <?php if ($cod_seguridad==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Inv</th><?php } ?>
        <?php if ($cod_estado_tipo_compra_global == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo Compra</th><?php } ?>
        <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Metodo Envio</th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo</th>
        <?php if ($cod_estado_tipo_cobro_aviso_alerta_renovacion_global==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo Cobro</th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">IdKey</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">IdForeG</th>
    </tr>
</thead>
<tbody>
<?php
$total_total_venta_producto    = 0;
$total_ganancia_venta_sum      = 0;
$contador_reg_prod_venta       = 0;

$sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_compra_producto, tbl15_venta_producto.precio_costo_producto, tbl15_venta_producto.total_compra_producto, 
tbl15_venta_producto.precio_venta_producto, tbl15_venta_producto.iva_ptj, tbl15_venta_producto.descuento_ptj, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, 
tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, 
tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_venta_producto.cod_administrador,
tbl15_tercero.cod_tercero, tbl15_tercero.nombre1_tercero, tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.apellido2_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar, tbl15_venta_producto.comision_ptj, tbl15_venta_producto.cod_tipo_pago, 
tbl15_venta_producto.cod_tipo_forma_pago, tbl15_venta_producto.cod_dependencia, tbl15_venta_producto.nombre_tipo_factura, tbl15_venta_producto.und_producto, 
tbl15_venta_producto.nombre_tipo_compra, tbl15_venta_producto.cod_tipo_metodo_envio, tbl15_venta_producto.nombre_tipo_cobro
FROM tbl15_tercero RIGHT JOIN tbl15_venta_producto ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tbl15_venta_producto.cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  $condicion_hora_reporte_venta_rel 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel 
$filtro_consulta_nombre_tipo_factura_rel $filtro_consulta_nombre_tipo_compra_rel $filtro_consulta_tipo_metodo_envio_rel
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
    $precio_costo_producto         = $info_cliente['precio_costo_producto'];
    $total_compra_producto         = $info_cliente['total_compra_producto'];
    $precio_venta_producto         = $info_cliente['precio_venta_producto'];
    $total_venta_producto          = $info_cliente['total_venta_producto'];
    $cod_tercero                   = $info_cliente['cod_tercero'];
    ///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
    if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
    if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
    $nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
    $nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
    $nombre_via_administracion     = $info_cliente['nombre_via_administracion'];
    $nombre_frec_duracion          = $info_cliente['nombre_frec_duracion'];
    $fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
    $fecha_hora_venta_producto     = $info_cliente['fecha_hora_venta_producto'];
    //$cuenta                        = $info_cliente['cuenta'];
    $cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
    $cod_administrador_db          = $info_cliente['cod_administrador'];
    $nombre_propietario            = $info_cliente['nombre1_tercero'].' '.$info_cliente['nombre2_tercero'].''.$info_cliente['apellido1_tercero'].' '.$info_cliente['apellido2_tercero'].' | '.$info_cliente['identificacion_tercero'].' | '.$cod_tercero;
    $comision_ptj                  = $info_cliente['comision_ptj'];
    $cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
    $cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
    $cod_dependencia               = $info_cliente['cod_dependencia'];
    $nombre_tipo_factura           = $info_cliente['nombre_tipo_factura'];
    $nombre_tipo_compra            = $info_cliente['nombre_tipo_compra'];
    $und_producto                  = $info_cliente['und_producto'];
    $cod_tipo_metodo_envio         = $info_cliente['cod_tipo_metodo_envio'];
    $nombre_tipo_cobro             = $info_cliente['nombre_tipo_cobro'];
    $iva_ptj                       = $info_cliente['iva_ptj'];
    $descuento_ptj                 = $info_cliente['descuento_ptj'];
    $total_iva_por_producto_venta  = ((($total_venta_producto - (($descuento_ptj/100)*$total_venta_producto))/(($iva_ptj/100)+(100/100)))*($iva_ptj/100));

    if ($total_compra_producto == '0') { $total_compra_producto = 1; } else { $total_compra_producto = $info_cliente['total_compra_producto']; }
    if ($total_venta_producto == '0') { $total_venta_producto = 1; } else { $total_venta_producto = $info_cliente['total_venta_producto']; }

    $total_ganancia_venta          = ($total_venta_producto - $total_compra_producto);
    $total_comision                = ($total_venta_producto * ($comision_ptj/100));
    $total_ganancia_venta_sum     += $total_ganancia_venta;

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


    $sql_tipo_metodo_envio = "SELECT nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio WHERE cod_tipo_metodo_envio = '$cod_tipo_metodo_envio'";
    $consulta_tipo_metodo_envio = mysqli_query($conectar, $sql_tipo_metodo_envio) or die(mysqli_error($conectar));
    $datos_tipo_metodo_envio = mysqli_fetch_assoc($consulta_tipo_metodo_envio);

    $nombre_tipo_metodo_envio      = $datos_tipo_metodo_envio['nombre_tipo_metodo_envio'];
    $total_total_venta_producto   += $total_venta_producto;

    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $porcentaje_ganancia_venta = (($total_ganancia_venta / $total_compra_producto) * 100); } else { $porcentaje_ganancia_venta = (($total_ganancia_venta / $total_venta_producto) * 100); }
    $contador_reg_prod_venta ++;
?>
    <tr>
        <td style="text-align:center"><?php echo $contador_reg_prod_venta?></td>
        <td style="text-align:center"><a href="../admin/edit_factura_venta.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta; ?>"><img src="../imagenes/ver.png"></a></td>
        <td style="text-align:center"><?php echo $nombre_tipo_factura?></td>
        <td style="text-align:center"><?php echo $cod_factura?></td>
        <td style="text-align:left"><?php echo $cod_producto_barra?></td>
        <td style="text-align:left"><?php echo $nombre_producto?></td>
        <td style="text-align:left"><?php echo trim($nombre_propietario)?></td>
        <td style="text-align:center"><?php echo $und_venta?></td>
        <?php if ($cod_estado_prod_precio_compra== '1') { ?>
        <td style="text-align:right"><p class="text-warning"><strong><?php echo number_format($precio_compra_producto, 0, ",", ".")?></strong></p></td>
        <?php } ?>
        <td style="text-align:right"><p class="text-info"><strong><?php echo number_format($precio_venta_producto, 0, ",", ".")?></strong></p></td>
        <td style="text-align:right"><p class="text-info"><strong><?php echo number_format($total_venta_producto, 0, ",", ".")?></strong></p></td>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <th style="text-align:right"><p class="text-success"><?php echo number_format($total_ganancia_venta, 0, ",", ".")?></p></th>
        <th style="text-align:right"><p class="text-success"><?php echo intval($porcentaje_ganancia_venta)?>%</p></th>
        <?php } ?>
        <td style="text-align:right"><?php echo intval($iva_ptj).'%'?></td>
        <td style="text-align:right"><?php echo number_format($total_iva_por_producto_venta, 0, ",", ".")?></td>
        <td style="text-align:center"><?php echo $cuenta?></td>
        <td style="text-align:center"><?php echo $fecha_ymd_venta_producto?></td>
        <td style="text-align:center"><?php echo $fecha_hora_venta_producto?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_pago?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
        <td style="text-align:center"><?php echo $nombre_dependencia?></td>
        <?php if ($cod_estado_ptj_comision_global == '1') { ?>
        <td style="text-align:center"><?php echo $comision_ptj.'%' ?></td>
        <td style="text-align:right"><?php echo number_format($total_comision, 0, ",", ".")?></td>
        <?php } ?>
        <?php if ($cod_seguridad==1) { ?><td style="text-align:center"><?php echo $und_producto?></td><?php } ?>
        <?php if ($cod_estado_tipo_compra_global == '1') { ?><td style="text-align:center"><?php echo $nombre_tipo_compra?></td><?php } ?>
        <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?><td style="text-align:center"><?php echo $nombre_tipo_metodo_envio?></td><?php } ?>
        <td style="text-align:center"><?php echo $nombre_tipo_producto?></td>
        <?php if ($cod_estado_tipo_cobro_aviso_alerta_renovacion_global==1) { ?><td style="text-align:center"><?php echo $nombre_tipo_cobro?></td><?php } ?>
        <td style="text-align:center"><?php echo $cod_venta_producto?></td>
        <td style="text-align:center"><?php echo $cod_info_factura_venta?></td>
    </tr>
<?php } ?>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <?php if ($cod_estado_prod_precio_compra== '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;"></th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">TOTAL</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_total_venta_producto, 0, ",", ".")?></th>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><p class="text-success"><?php echo number_format($total_ganancia_venta_sum, 0, ",", ".")?></p></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_iva_producto_venta, 0, ",", ".")?></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <?php if ($cod_estado_ptj_comision_global == '1') { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <?php } ?>
        <?php if ($cod_seguridad==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;"></th><?php } ?>
        <?php if ($cod_estado_tipo_compra_global == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;"></th><?php } ?>
        <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;"></th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    </tr>
</tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_categoria_global == '1') { ?>
    <hr>
    <table class="table table-striped">
    <tr>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR CATEGORIAS</strong></a></td>
    </tr>
    </table>

    <table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Nombre Categoria</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total P.Compra</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total P.Venta</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Ganancia</a></th>
        </tr>
    </thead>
    <tbody>
    <?php
    $sql_venta_vendedor = "SELECT SUM(total_venta_producto) AS total_venta_categoria, SUM(total_compra_producto) AS total_compra_categoria, cod_categoria
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio 
    GROUP BY cod_categoria";
    $consulta_venta_vendedor = mysqli_query($conectar, $sql_venta_vendedor) or die(mysqli_error($conectar));
    while ($datos_venta_vendedor = mysqli_fetch_assoc($consulta_venta_vendedor)) {

    $cod_categoria_db                = $datos_venta_vendedor['cod_categoria'];
    $total_compra_categoria          = $datos_venta_vendedor['total_compra_categoria'];
    $total_venta_categoria           = $datos_venta_vendedor['total_venta_categoria'];
    $total_ganancia_categoria        = $total_venta_categoria - $total_compra_categoria;

    $sql_vendedor_venta = "SELECT nombre_categoria FROM tbl15_categoria WHERE cod_categoria = '$cod_categoria_db'";
    $consulta_vendedor_venta = mysqli_query($conectar, $sql_vendedor_venta) or die(mysqli_error($conectar));
    $datos_vendedor_venta = mysqli_fetch_assoc($consulta_vendedor_venta);

    $nombre_categoria                  = $datos_vendedor_venta['nombre_categoria'];
    ?>
        <tr>
            <td style="text-align:center"><?php echo $nombre_categoria?></td>
            <td style="text-align:center"><?php echo number_format($total_compra_categoria, 0, ",", ".")?></td>
            <td style="text-align:center"><?php echo number_format($total_venta_categoria, 0, ",", ".")?></td>
            <td style="text-align:center"><?php echo number_format($total_ganancia_categoria, 0, ",", ".")?></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_ventasporfacturas==1) { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR FACTURA</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
    <tr>
        <td style="text-align:center;"><a href="../admin/descargar_info_impuesto_facturas_venta_spout_xlsx.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_administrador=<?php echo addslashes($_GET['cod_administrador']) ?>&cod_tercero=<?php echo addslashes($_GET['cod_tercero']) ?>&cod_tipo_pago=<?php echo addslashes($_GET['cod_tipo_pago']) ?>&cod_tipo_forma_pago=<?php echo addslashes($_GET['cod_tipo_pago']) ?>&cod_dependencia=<?php echo addslashes($_GET['cod_dependencia']) ?>&nombre_tipo_factura=<?php echo addslashes($_GET['nombre_tipo_factura']) ?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></td>
    </tr>
</table>

<table class="table table-striped">
    <tr>
        <td style="text-align:right;"><input type="checkbox" id="seleccionar-todos"><strong> Seleccionar todos</strong></td>
    </tr>
</table>

<?php if ($nombre_operador_factura_electronica == 'DATAICO') { ?>
<form method="post" name="formulario" action="../admin/descargar_factura_venta_electronica_dataico_precio_venta_sin_iva_puntoycoma_masivo_simple_csv.php">
<?php } ?>
<?php if ($nombre_operador_factura_electronica == 'MONEYBOX') { ?>
<form method="post" name="formulario" action="../admin/descargar_factura_venta_electronica_moneybox_masivo_xlsx.php">
<?php } ?>
<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Factura</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tercero</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Recibido</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Fecha</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Hora</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Vendedor</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tipo Pago</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Forma Pago</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tipo Factura</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><?php echo ucfirst(strtolower($nombre_concepto_multi_virtual)) ?></a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Trabajador</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Check</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">ID</a></th>
    </tr>
</thead>
<tbody>
<?php
$sql_total_tipo_factura = "SELECT * FROM tbl15_info_factura_venta 
WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura 
AND (nombre_estado_factura = 'CERRADA') ORDER BY cod_info_factura_venta ASC";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

    $cod_info_factura_venta        = $datos_total_tipo_factura['cod_info_factura_venta'];
    $cod_factura                   = $datos_total_tipo_factura['cod_factura'];
    $cod_tercero                   = $datos_total_tipo_factura['cod_tercero'];
    $vlr_cancelado                 = $datos_total_tipo_factura['vlr_cancelado'];
    $vlr_vuelto                    = $datos_total_tipo_factura['vlr_vuelto'];
    $fecha_anyo                    = $datos_total_tipo_factura['fecha_anyo'];
    $fecha_hora                    = $datos_total_tipo_factura['fecha_hora'];
    $cod_tipo_pago                 = $datos_total_tipo_factura['cod_tipo_pago'];
    $cod_administrador             = $datos_total_tipo_factura['cod_administrador'];
    $total_precio_compra           = $datos_total_tipo_factura['total_precio_compra'];
    $total_precio_venta            = $datos_total_tipo_factura['total_precio_venta'];
    $cod_dependencia               = $datos_total_tipo_factura['cod_dependencia'];
    $cod_tipo_forma_pago           = $datos_total_tipo_factura['cod_tipo_forma_pago'];
    $nombre_tipo_factura           = $datos_total_tipo_factura['nombre_tipo_factura'];
    $nombre_tipo_moneda            = $datos_total_tipo_factura['nombre_tipo_moneda'];
    $total_datos_data              = $datos_total_tipo_factura['total_datos_data'];
    $cod_base_caja                 = $datos_total_tipo_factura['cod_base_caja'];
    $cod_domiciliario              = $datos_total_tipo_factura['cod_domiciliario'];

    $sql_dependencia = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
    $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

    $nombre_tercero                = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['nombre2_tercero'].''.$datos_dependencia['apellido1_tercero'].' '.$datos_dependencia['apellido2_tercero'].' | '.$datos_dependencia['identificacion_tercero'].' | '.$cod_tercero;

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
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

    $sql_vendedor_domiciliario = "SELECT nombres_domiciliario, apellidos_domiciliario FROM tbl15_domiciliario WHERE cod_domiciliario = '$cod_domiciliario'";
    $consulta_vendedor_domiciliario = mysqli_query($conectar, $sql_vendedor_domiciliario) or die(mysqli_error($conectar));
    $datos_vendedor_domiciliario = mysqli_fetch_assoc($consulta_vendedor_domiciliario);

    $nombres_domiciliario                  = $datos_vendedor_domiciliario['nombres_domiciliario'].' '.$datos_vendedor_domiciliario['apellidos_domiciliario'];

    $suma_temporal = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
    Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
    Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
    FROM tbl15_venta_producto 
    WHERE (cod_info_factura_venta= '$cod_info_factura_venta')";
    $consulta_temporal = mysqli_query($conectar, $suma_temporal) or die(mysqli_error($conectar));
    $suma = mysqli_fetch_assoc($consulta_temporal);
?>
    <tr>
        <td style="text-align:center"><?php echo ($cod_factura)?></td>
        <td style="text-align:left"><?php echo $nombre_tercero?></td>
        <td style="text-align:right"><?php echo number_format($total_precio_venta, 0, ",", ".")?></td>
        <td style="text-align:right"><?php echo number_format($vlr_cancelado, 0, ",", ".")?></td>
        <td style="text-align:center"><?php echo $fecha_anyo?></td>
        <td style="text-align:center"><?php echo $fecha_hora?></td>
        <td style="text-align:center"><?php echo $cuenta?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_pago?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_factura?></td>
        <td style="text-align:center"><?php echo $cod_base_caja?></td>
        <td style="text-align:center"><?php echo $nombres_domiciliario?></td>
        <td style="text-align:center"><div id="listado"><input name="cod_info_factura_venta[]" type="checkbox" value='<?php echo $cod_info_factura_venta;?>'></div></td>
        <td style="text-align:center"><?php echo $cod_info_factura_venta?></td>
    </tr>
<?php } ?>
</tbody>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<table class="table table-striped">
<tr>
<td style="text-align:center;"><input type="image" src="../imagenes/btn_exportar_archivo_factura_electronica.png" name="submit" value="GENERAR ARCHIVO PLANO DE FACTURA ELECTRONICA" title="GENERAR ARCHIVO PLANO DE FACTURA ELECTRONICA" /></td>
</tr>
<input name="fecha_ymd_venta_producto_ini" type="hidden" value='<?php echo $fecha_ymd_venta_producto_ini;?>'>
<input name="fecha_ymd_venta_producto_fin" type="hidden" value='<?php echo $fecha_ymd_venta_producto_fin;?>'>
<input name="cod_administrador" type="hidden" value='<?php echo $cod_administrador;?>'>
<input name="cod_tercero" type="hidden" value='<?php echo $cod_tercero;?>'>
<input name="cod_tipo_pago" type="hidden" value='<?php echo $cod_tipo_pago;?>'>
<input name="cod_tipo_forma_pago" type="hidden" value='<?php echo $cod_tipo_forma_pago;?>'>
<input name="cod_dependencia" type="hidden" value='<?php echo $cod_dependencia;?>'>
<input name="nombre_tipo_factura" type="hidden" value='<?php echo $nombre_tipo_factura;?>'>
<input name="nombre_tipo_compra" type="hidden" value='<?php echo $nombre_tipo_compra;?>'>
<input name="pagina" type="hidden" value='<?php echo $pagina;?>'>
</table>
</form>

<script>
  $(function(){
    $('#seleccionar-todos').change(function() {
      $('#listado > input[type=checkbox]').prop('checked', $(this).is(':checked'));
    });
  });
</script>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_venta_diaria==1) { ?>
<hr>
<table class="table table-striped">
<tr>
<td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR DIA</strong></a></td>
</tr>
</table>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center; background-color:#DBE0F3; color:#000;">Dia</th>
<?php if ($cod_estado_prod_precio_compra==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Total P.Compra</th><?php } ?>
<th style="text-align:center; background-color:#DBE0F3; color:#000;">Total P.Venta</th>
<?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a>$Ganancia</a></th>
<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a>%Ganancia</a></th>
<?php } ?></tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto, fecha_ymd_venta_producto 
FROM tbl15_venta_producto WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio
GROUP BY fecha_ymd_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$fecha_ymd_venta_producto          = $info_cliente['fecha_ymd_venta_producto'];
$total_venta_producto_dia          = $info_cliente['total_venta_producto'];
$total_compra_producto_dia         = $info_cliente['total_compra_producto'];
$total_utilidad_dia                = $total_venta_producto_dia - $total_compra_producto_dia;

if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $total_utilidad_dia_porcentaje = (($total_utilidad_dia / $total_compra_producto_dia) * 100); } else { $total_utilidad_dia_porcentaje = (($total_utilidad_dia / $total_venta_producto_dia) * 100); }
?>
<tr>
<td style="text-align:center"><?php echo $fecha_ymd_venta_producto?></td>
<?php if ($cod_estado_prod_precio_compra==1) { ?><td style="text-align:center"><?php echo number_format($total_compra_producto_dia, 0, ",", ".")?></td><?php } ?>
<td style="text-align:center"><?php echo number_format($total_venta_producto_dia, 0, ",", ".")?></td>
<?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
<th style="text-align:center"><a><?php echo number_format($total_utilidad_dia, 0, ",", ".")?></a></th>
<th style="text-align:center"><a><?php echo number_format($total_utilidad_dia_porcentaje, 0, ",", ".")?>%</a></th>
<?php } ?>
</tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_venta_mensual==1) { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR MES</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Mes</th>
        <?php if ($cod_estado_prod_precio_compra==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Total P.Compra</th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Total P.Venta</th>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a>$Ganancia</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a>%Ganancia</a></th>
        <?php } ?>
    </tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto, fecha_mes_venta_producto 
FROM tbl15_venta_producto WHERE (fecha_mes_venta_producto BETWEEN '$fecha_mes_venta_producto_ini' AND '$fecha_mes_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')   
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio
GROUP BY fecha_mes_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

    $fecha_mes_venta_producto          = $info_cliente['fecha_mes_venta_producto'];
    $total_venta_producto_mes          = $info_cliente['total_venta_producto'];
    $total_compra_producto_mes         = $info_cliente['total_compra_producto'];
    $total_utilidad_mes                = $total_venta_producto_mes - $total_compra_producto_mes;

    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $total_utilidad_mes_porcentaje = (($total_utilidad_mes / $total_compra_producto_mes) * 100); } else { $total_utilidad_mes_porcentaje = (($total_utilidad_mes / $total_venta_producto_mes) * 100); }
?>
    <tr>
        <td style="text-align:center"><?php echo $fecha_mes_venta_producto?></td>
        <?php if ($cod_estado_prod_precio_compra==1) { ?><td style="text-align:center"><?php echo number_format($total_compra_producto_mes, 0, ",", ".")?></td><?php } ?>
        <td style="text-align:center"><?php echo number_format($total_venta_producto_mes, 0, ",", ".")?></td>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <th style="text-align:center"><a><?php echo number_format($total_utilidad_mes, 0, ",", ".")?></a></th>
        <th style="text-align:center"><a><?php echo number_format($total_utilidad_mes_porcentaje, 0, ",", ".")?>%</a></th>
        <?php } ?>
    </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_venta_anual==1) { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR AÑO</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Año</th>
        <?php if ($cod_estado_prod_precio_compra==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Total P.Compra</th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Total P.Venta</th>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a>$Ganancia</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a>%Ganancia</a></th>
        <?php } ?>
    </tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto, fecha_anyo_venta_producto 
FROM tbl15_venta_producto WHERE (fecha_anyo_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio
GROUP BY fecha_anyo_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

    $fecha_anyo_venta_producto          = $info_cliente['fecha_anyo_venta_producto'];
    $total_venta_producto_anyo          = $info_cliente['total_venta_producto'];
    $total_compra_producto_anyo         = $info_cliente['total_compra_producto'];
    $total_utilidad_anyo                = $total_venta_producto_anyo - $total_compra_producto_anyo;

    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $total_utilidad_anyo_porcentaje = (($total_utilidad_anyo / $total_compra_producto_anyo) * 100); } else { $total_utilidad_anyo_porcentaje = (($total_utilidad_anyo / $total_venta_producto_anyo) * 100); }
?>
    <tr>
        <td style="text-align:center"><?php echo $fecha_anyo_venta_producto?></td>
        <?php if ($cod_estado_prod_precio_compra==1) { ?><td style="text-align:center"><?php echo number_format($total_compra_producto_anyo, 0, ",", ".")?></td><?php } ?>
        <td style="text-align:center"><?php echo number_format($total_venta_producto_anyo, 0, ",", ".")?></td>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <th style="text-align:center"><a><?php echo number_format($total_utilidad_anyo, 0, ",", ".")?></a></th>
        <th style="text-align:center"><a><?php echo number_format($total_utilidad_anyo_porcentaje, 0, ",", ".")?>%</a></th>
        <?php } ?>
    </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_ventasportipofacturas==1) { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR TIPO DE FACTURA</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tipo de factura</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta</a></th>
    </tr>
</thead>
<tbody>
<?php
$sql_total_tipo_factura = "SELECT Sum(total_venta_producto) AS suma_total_venta_producto, nombre_tipo_factura
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio 
GROUP BY nombre_tipo_factura";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

    $nombre_tipo_factura           = $datos_total_tipo_factura['nombre_tipo_factura'];
    $suma_total_venta_producto     = $datos_total_tipo_factura['suma_total_venta_producto'];
?>
    <tr>
        <td style="text-align:center"><?php echo $nombre_tipo_factura?></td>
        <td style="text-align:center"><?php echo number_format($suma_total_venta_producto, 0, ",", ".")?></td>
    </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_ventaspordependencia==1) { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR DEPENDENCIA</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Nombre Dependencia</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta</a></th>
    </tr>
</thead>
<tbody>
<?php
$sql_venta_vendedor = "SELECT SUM(total_venta_producto) AS total_venta_dependencia, cod_dependencia
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio 
GROUP BY cod_dependencia";
$consulta_venta_vendedor = mysqli_query($conectar, $sql_venta_vendedor) or die(mysqli_error($conectar));
while ($datos_venta_vendedor = mysqli_fetch_assoc($consulta_venta_vendedor)) {

    $cod_dependencia_db              = $datos_venta_vendedor['cod_dependencia'];
    $total_venta_dependencia         = $datos_venta_vendedor['total_venta_dependencia'];

    $sql_vendedor_venta = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia_db'";
    $consulta_vendedor_venta = mysqli_query($conectar, $sql_vendedor_venta) or die(mysqli_error($conectar));
    $datos_vendedor_venta = mysqli_fetch_assoc($consulta_vendedor_venta);

    $nombre_dependencia                  = $datos_vendedor_venta['nombre_dependencia'];
?>
    <tr>
        <td style="text-align:center"><?php echo $nombre_dependencia?></td>
        <td style="text-align:center"><?php echo number_format($total_venta_dependencia, 0, ",", ".")?></td>
    </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_ventasportipoproducto==1) { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR TIPO DE PRODUCTO</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tipo Producto</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta</a></th>
    </tr>
</thead>
<tbody>
<?php
$sql_venta_vendedor = "SELECT SUM(total_venta_producto) AS total_venta_tipo_producto, nombre_tipo_producto
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio 
GROUP BY nombre_tipo_producto";
$consulta_venta_vendedor = mysqli_query($conectar, $sql_venta_vendedor) or die(mysqli_error($conectar));
while ($datos_venta_vendedor = mysqli_fetch_assoc($consulta_venta_vendedor)) {

    $nombre_tipo_producto_db         = $datos_venta_vendedor['nombre_tipo_producto'];
    $total_venta_tipo_producto       = $datos_venta_vendedor['total_venta_tipo_producto'];

    $sql_vendedor_venta = "SELECT nombre_tipo_producto FROM tbl15_tipo_producto WHERE nombre_tipo_producto = '$nombre_tipo_producto_db'";
    $consulta_vendedor_venta = mysqli_query($conectar, $sql_vendedor_venta) or die(mysqli_error($conectar));
    $datos_vendedor_venta = mysqli_fetch_assoc($consulta_vendedor_venta);

    $nombre_tipo_producto            = $datos_vendedor_venta['nombre_tipo_producto'];
?>
    <tr>
        <td style="text-align:center"><?php echo $nombre_tipo_producto?></td>
        <td style="text-align:center"><?php echo number_format($total_venta_tipo_producto, 0, ",", ".")?></td>
    </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_ventasporvendedor==1) { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR VENDEDORES</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Vendedor</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta</a></th>
    </tr>
</thead>
<tbody>
<?php
$sql_venta_vendedor = "SELECT SUM(total_venta_producto) AS total_venta_vendedor, cod_administrador
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio 
GROUP BY cod_administrador";
$consulta_venta_vendedor = mysqli_query($conectar, $sql_venta_vendedor) or die(mysqli_error($conectar));
while ($datos_venta_vendedor = mysqli_fetch_assoc($consulta_venta_vendedor)) {

    $cod_administrador_db            = $datos_venta_vendedor['cod_administrador'];
    $total_venta_vendedor            = $datos_venta_vendedor['total_venta_vendedor'];

    $sql_vendedor_venta = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
    $consulta_vendedor_venta = mysqli_query($conectar, $sql_vendedor_venta) or die(mysqli_error($conectar));
    $datos_vendedor_venta = mysqli_fetch_assoc($consulta_vendedor_venta);

    $vendedor_venta                  = $datos_vendedor_venta['cuenta'];
?>
    <tr>
        <td style="text-align:center"><?php echo $vendedor_venta?></td>
        <td style="text-align:center"><?php echo number_format($total_venta_vendedor, 0, ",", ".")?></td>
    </tr>
<?php } ?>
</tbody>
</table>

<hr>

<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR <?php echo (($nombre_concepto_multi_virtual)) ?>S DE VENDEDORES</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Vendedor</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total <?php echo ucfirst(strtolower($nombre_concepto_multi_virtual)) ?>s</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><?php echo ucfirst(strtolower($nombre_concepto_multi_virtual)) ?>s</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Facturas</a></th>
        </tr>
    </thead>
    <tbody>
<?php
$sql_venta_vendedor_info = "SELECT COUNT(*) AS total_mesas, cod_info_factura_venta, cod_factura, cod_tercero, fecha_anyo, cod_tipo_pago, cod_administrador, cod_tipo_forma_pago, cod_base_caja 
FROM tbl15_info_factura_venta 
WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura 
AND (nombre_estado_factura = 'CERRADA') GROUP BY cod_administrador";
$consulta_venta_vendedor_info = mysqli_query($conectar, $sql_venta_vendedor_info) or die(mysqli_error($conectar));
while ($datos_venta_vendedor_info = mysqli_fetch_assoc($consulta_venta_vendedor_info)) {

    $cod_info_factura_venta        = $datos_venta_vendedor_info['cod_info_factura_venta'];
    $cod_factura                   = $datos_venta_vendedor_info['cod_factura'];
    $cod_tercero                   = $datos_venta_vendedor_info['cod_tercero'];
    $fecha_anyo                    = $datos_venta_vendedor_info['fecha_anyo'];
    $cod_tipo_pago                 = $datos_venta_vendedor_info['cod_tipo_pago'];
    $cod_administrador             = $datos_venta_vendedor_info['cod_administrador'];
    $cod_tipo_forma_pago           = $datos_venta_vendedor_info['cod_tipo_forma_pago'];
    $total_mesas                   = $datos_venta_vendedor_info['total_mesas'];

    $sql_dependencia = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
    $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

    $nombre_tercero                = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['apellido1_tercero'];

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

    $sql_vendedor_venta = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
    $consulta_vendedor_venta = mysqli_query($conectar, $sql_vendedor_venta) or die(mysqli_error($conectar));
    $datos_vendedor_venta = mysqli_fetch_assoc($consulta_vendedor_venta);

    $vendedor_venta                  = $datos_vendedor_venta['cuenta'];

    $concatenar_mesas                = '';
    $concatenar_factura              = '';
    $contador_mesas                  = 0;

    $sql_concat_info = "SELECT cod_base_caja, cod_factura FROM tbl15_info_factura_venta WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  AND (cod_administrador = '$cod_administrador')
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura 
    AND (nombre_estado_factura = 'CERRADA')";
    $consulta_concat_info = mysqli_query($conectar, $sql_concat_info) or die(mysqli_error($conectar));
    while ($datos_concat_info = mysqli_fetch_assoc($consulta_concat_info)) {

        $cod_base_caja                 = $datos_concat_info['cod_base_caja'];
        $cod_factura                   = $datos_concat_info['cod_factura'];
        $concatenar_mesas             .= $cod_base_caja.' | ';
        $concatenar_factura           .= $cod_factura.' | ';

        $contador_mesas++;
    }
?>
        <tr>
            <td style="text-align:center"><?php echo $cuenta?></td>
            <td style="text-align:center"><?php echo $total_mesas?></td>
            <td style="text-align:center"><?php echo $concatenar_mesas?></td>
            <td style="text-align:center"><?php echo $concatenar_factura?></td>
        </tr>
<?php } ?>
    </tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR METODO DE ENVIO</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Nombre Metodo de envio</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta</a></th>
    </tr>
</thead>
<tbody>
<?php
$sql_venta_vendedor = "SELECT SUM(total_venta_producto) AS total_venta_tipo_metodo_envio, cod_tipo_metodo_envio
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio 
GROUP BY cod_tipo_metodo_envio";
$consulta_venta_vendedor = mysqli_query($conectar, $sql_venta_vendedor) or die(mysqli_error($conectar));
while ($datos_venta_vendedor = mysqli_fetch_assoc($consulta_venta_vendedor)) {

    $cod_tipo_metodo_envio_db              = $datos_venta_vendedor['cod_tipo_metodo_envio'];
    $total_venta_tipo_metodo_envio         = $datos_venta_vendedor['total_venta_tipo_metodo_envio'];

    $sql_vendedor_venta = "SELECT nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio WHERE cod_tipo_metodo_envio = '$cod_tipo_metodo_envio_db'";
    $consulta_vendedor_venta = mysqli_query($conectar, $sql_vendedor_venta) or die(mysqli_error($conectar));
    $datos_vendedor_venta = mysqli_fetch_assoc($consulta_vendedor_venta);

    $nombre_tipo_metodo_envio                  = $datos_vendedor_venta['nombre_tipo_metodo_envio'];
?>
    <tr>
        <td style="text-align:center"><?php echo $nombre_tipo_metodo_envio?></td>
        <td style="text-align:center"><?php echo number_format($total_venta_tipo_metodo_envio, 0, ",", ".")?></td>
    </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_tipo_compra_global == '1') { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR TIPO DE COMPRA</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Nombre Tipo de Compra</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta</a></th>
    </tr>
</thead>
<tbody>
<?php
$sql_venta_tipo_compra = "SELECT SUM(total_venta_producto) AS total_venta_tipo_compra, nombre_tipo_compra
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio 
GROUP BY nombre_tipo_compra";
$consulta_venta_tipo_compra = mysqli_query($conectar, $sql_venta_tipo_compra) or die(mysqli_error($conectar));
while ($datos_venta_tipo_compra = mysqli_fetch_assoc($consulta_venta_tipo_compra)) {

    $nombre_tipo_compra_db           = $datos_venta_tipo_compra['nombre_tipo_compra'];
    $total_venta_tipo_compra         = $datos_venta_tipo_compra['total_venta_tipo_compra'];

    $sql_vendedor_venta = "SELECT nombre_tipo_compra FROM tbl15_tipo_compra WHERE nombre_tipo_compra = '$nombre_tipo_compra_db'";
    $consulta_vendedor_venta = mysqli_query($conectar, $sql_vendedor_venta) or die(mysqli_error($conectar));
    $datos_vendedor_venta = mysqli_fetch_assoc($consulta_vendedor_venta);

    $nombre_tipo_compra                  = $datos_vendedor_venta['nombre_tipo_compra'];
?>
    <tr>
        <td style="text-align:center"><?php echo $nombre_tipo_compra?></td>
        <td style="text-align:center"><?php echo number_format($total_venta_tipo_compra, 0, ",", ".")?></td>
    </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_reporte_por_caja_virtual_global == '1') { ?>
    <table class="table table-striped">
        <tr>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR <?php echo (($nombre_concepto_multi_virtual)) ?></strong></a></td>
        </tr>
    </table>

    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><?php echo ucfirst(strtolower($nombre_concepto_multi_virtual)) ?></a></th>
                <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total compra</a></th>
                <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta</a></th>
                <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">$Ganancia</a></th>
                <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Trabajador</a></th>
                <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Observacion</a></th>
            </tr>
        </thead>
        <tbody>
    <?php
    $sql_venta_caja_virtual = "SELECT cod_base_caja, total_precio_venta, total_precio_compra, observacion_tercero, cod_domiciliario FROM tbl15_info_factura_venta 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura 
    AND (nombre_estado_factura = 'CERRADA') GROUP BY cod_base_caja";
    $consulta_venta_caja_virtual = mysqli_query($conectar, $sql_venta_caja_virtual) or die(mysqli_error($conectar));
    while ($datos_venta_caja_virtual = mysqli_fetch_assoc($consulta_venta_caja_virtual)) {

        $cod_base_caja                 = $datos_venta_caja_virtual['cod_base_caja'];
        $total_precio_venta            = $datos_venta_caja_virtual['total_precio_venta'];
        $total_precio_compra           = $datos_venta_caja_virtual['total_precio_compra'];
        $observacion_tercero           = $datos_venta_caja_virtual['observacion_tercero'];
        $cod_domiciliario              = $datos_venta_caja_virtual['cod_domiciliario'];
        $ganancia_venta_caja           = $total_precio_venta - $total_precio_compra;

        $sql_vendedor_domiciliario = "SELECT nombres_domiciliario, apellidos_domiciliario FROM tbl15_domiciliario WHERE cod_domiciliario = '$cod_domiciliario'";
        $consulta_vendedor_domiciliario = mysqli_query($conectar, $sql_vendedor_domiciliario) or die(mysqli_error($conectar));
        $datos_vendedor_domiciliario = mysqli_fetch_assoc($consulta_vendedor_domiciliario);

        $nombres_domiciliario                  = $datos_vendedor_domiciliario['nombres_domiciliario'].' '.$datos_vendedor_domiciliario['apellidos_domiciliario'];
    ?>
            <tr>
                <td style="text-align:center"><?php echo $cod_base_caja?></td>
                <td style="text-align:center"><?php echo number_format($total_precio_compra, 0, ",", ".") ?></td>
                <td style="text-align:center"><?php echo number_format($total_precio_venta, 0, ",", ".") ?></td>
                <td style="text-align:center"><?php echo number_format($ganancia_venta_caja, 0, ",", ".") ?></td>
                <td style="text-align:center"><?php echo $nombres_domiciliario?></td>
                <td style="text-align:center"><?php echo $observacion_tercero?></td>
            </tr>
    <?php } ?>
        </tbody>
    </table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_reporte_venta_total_comision==1) { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>COMISION POR VENDEDORES</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Comision Vendedor</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Comision</a></th>
    </tr>
</thead>
<tbody>
<?php
$sql_comision_vendedor = "SELECT SUM(total_venta_producto * (comision_ptj/100)) AS total_comision_vendedor, cod_administrador
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio 
GROUP BY cod_administrador";
$consulta_comision_vendedor = mysqli_query($conectar, $sql_comision_vendedor) or die(mysqli_error($conectar));
while ($datos_comision_vendedor = mysqli_fetch_assoc($consulta_comision_vendedor)) {

    $cod_administrador_db            = $datos_comision_vendedor['cod_administrador'];
    $total_comision_vendedor         = $datos_comision_vendedor['total_comision_vendedor'];

    $sql_vendedor_comision = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
    $consulta_vendedor_comision = mysqli_query($conectar, $sql_vendedor_comision) or die(mysqli_error($conectar));
    $datos_vendedor_comision = mysqli_fetch_assoc($consulta_vendedor_comision);

    $vendedor_comision                = $datos_vendedor_comision['cuenta'];
?>
    <tr>
        <td style="text-align:center"><?php echo $vendedor_comision?></td>
        <td style="text-align:center"><?php echo number_format($total_comision_vendedor, 0, ",", ".")?></td>
    </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_ventasporpropinavendedor == '1') { ?>
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>PROPINAS POR VENDEDORES</strong></a></td>
    </tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Propina Vendedor</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Vendedor</a></th>
    </tr>
</thead>
<tbody>
<?php
$sql_propina_vendedor = "SELECT SUM(total_venta_producto) AS total_servicio_propina, cod_administrador FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
AND (cod_producto_barra = '22222222') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura 
GROUP BY cod_administrador";
$consulta_propina_vendedor = mysqli_query($conectar, $sql_propina_vendedor) or die(mysqli_error($conectar));
while ($datos_propina_vendedor = mysqli_fetch_assoc($consulta_propina_vendedor)) {

    $cod_administrador_db            = $datos_propina_vendedor['cod_administrador'];
    $total_servicio_propina          = $datos_propina_vendedor['total_servicio_propina'];

    $sql_vendedor_propina = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
    $consulta_vendedor_propina = mysqli_query($conectar, $sql_vendedor_propina) or die(mysqli_error($conectar));
    $datos_vendedor_propina = mysqli_fetch_assoc($consulta_vendedor_propina);

    $vendedor_propina                = $datos_vendedor_propina['cuenta'];
?>
    <tr>
        <td style="text-align:center"><?php echo $vendedor_propina?></td>
        <td style="text-align:center"><?php echo number_format($total_servicio_propina, 0, ",", ".")?></td>
    </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>

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
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>DEPENDENCIA</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>FECHA</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>HORA</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>ID</strong></td>
            <!--<td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>IMP</strong></td>-->
        </tr>
    <?php
    $total_abonado = 0;

    $sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia ORDER BY cod_cuentas_cobrar_abonos DESC";
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
            <?php if ($cod_seguridad== '1') { ?><td style="text-align: left;"><a href="../admin/cuentas_cobrar_detalle_factura_directa_no_por_factura.php?cod_tercero=<?php echo $cod_tercero; ?>&cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos; ?>"><?php echo $nombre_cliente; ?></a></td><?php } else { ?><td style="text-align: left;"><?php echo $nombre_cliente; ?></td><?php } ?>
            <td style="text-align: center;"><?php echo number_format($abonado, 0, ",", ".")?></td>
            <td style="text-align: center;"><?php echo $cuenta; ?></td>
            <td style="text-align: left;"><?php echo $mensaje; ?></td>
            <td style="text-align: center;"><?php echo $nombre_tipo_forma_pago; ?></td>
            <td style="text-align: center;"><?php echo $nombre_dependencia; ?></td>
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
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia GROUP BY cod_tipo_forma_pago";
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
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_cuenta_pagar == '1') { ?>
    <table class="table table-striped">
        <tr>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>ABONOS CUENTAS POR PAGAR</strong></a></td>
        </tr>
    </table>

    <table class="table table-striped">
        <tr>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>PROVEEEDOR</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>ABONOS</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>PAGO A</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>MENSAJE</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>FORMA PAGO</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>DEPENDENCIA</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>FECHA</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>HORA</strong></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>ID</strong></td>
        </tr>
    <?php
    $total_abonado_pagar = 0;

    $sql = "SELECT * FROM tbl15_cuentas_pagar_abonos WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') ORDER BY cod_cuentas_pagar_abonos DESC";
    $consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
    $total_datos = mysqli_num_rows($consulta);
    while ($datos = mysqli_fetch_assoc($consulta)) {

        $cod_cuentas_pagar_abonos  = $datos['cod_cuentas_pagar_abonos'];
        $abonado                    = $datos['abonado'];
        $cuenta                     = $datos['cuenta'];
        $mensaje                    = $datos['mensaje'];
        $fecha_pago                 = $datos['fecha_pago'];
        $hora                       = $datos['hora'];
        $cod_tipo_forma_pago        = $datos['cod_tipo_forma_pago'];
        $cod_tercero                = $datos['cod_tercero'];
        $total_abonado_pagar        += $abonado;

        $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
        $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
        $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

        $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

        $sql_tercero = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
        $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
        $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

        $nombre_cliente            = trim($datos_tercero['nombre1_tercero'].' '.$datos_tercero['nombre2_tercero'].' '.$datos_tercero['apellido1_tercero'].' '.$datos_tercero['apellido2_tercero'].' - '.$datos_tercero['identificacion_tercero']);
    ?>
        <tr>
            <td style="text-align: left;"><?php echo $nombre_cliente; ?></td>
            <td style="text-align: center;"><?php echo number_format($abonado, 0, ",", ".")?></td>
            <td style="text-align: center;"><?php echo $cuenta; ?></td>
            <td style="text-align: left;"><?php echo $mensaje; ?></td>
            <td style="text-align: center;"><?php echo $nombre_tipo_forma_pago; ?></td>
            <td style="text-align: center;"><?php echo $fecha_pago; ?></td>
            <td style="text-align: center;"><?php echo $hora; ?></td>
            <td style="text-align: center;"><?php echo $cod_cuentas_pagar_abonos; ?></td>
        </tr>
    <?php } ?>
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">TOTAL</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_abonado_pagar, 0, ",", ".")?></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        </tr>
    </table>

    <table class="table table-striped">
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">ABONOS POR FORMA DE PAGO (CUENTA POR PAGAR)</a></th>
        </tr>
    </table>

    <table class="table table-striped">
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">FORMA PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">ABONOS POR FORMA DE PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">FECHA</th>
        </tr>
    <?php
    $total_abonado_pagar_forma_pago = 0;

    $sql_abonos_cuenta_pagar_forma_pago = "SELECT SUM(abonado) AS abonado_forma_pago, cod_tipo_forma_pago, fecha_pago FROM tbl15_cuentas_pagar_abonos WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') GROUP BY cod_tipo_forma_pago";
    $consulta_abonos_cuenta_pagar_forma_pago = mysqli_query($conectar, $sql_abonos_cuenta_pagar_forma_pago) or die(mysqli_error($conectar));
    while ($matriz_forma_pago = mysqli_fetch_assoc($consulta_abonos_cuenta_pagar_forma_pago)) {

        $abonado_forma_pago                = $matriz_forma_pago['abonado_forma_pago'];
        $fecha_pago                        = $matriz_forma_pago['fecha_pago'];
        $cod_tipo_forma_pago               = $matriz_forma_pago['cod_tipo_forma_pago'];
        $total_abonado_pagar_forma_pago   += $abonado_forma_pago;

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
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_abonado_pagar_forma_pago, 0, ",", ".")?></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        </tr>
    </table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_ventasporcreditocliente == '1') { ?>
<hr>
<table class="table table-striped">
<tr>
<td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS EN CREDITO POR CLIENTES</strong></a></td>
</tr>
</table>

<table class="table table-striped">
<thead>
<tr>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Factura</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Cod</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Concepto</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Cliente</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Unidades</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">P.Venta</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Total Venta</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo Pago</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Forma Pago</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Vendedor</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Fecha</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Hora</th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">Id</th>
</tr>
</thead>
<tbody>
<?php
$total_venta_credito_cliente = 0;

$sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_costo_producto, tbl15_venta_producto.total_compra_producto, tbl15_venta_producto.precio_venta_producto, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, 
tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, 
tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_venta_producto.cod_administrador,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar, tbl15_venta_producto.comision_ptj,
tbl15_venta_producto.cod_tipo_pago, tbl15_venta_producto.cod_tipo_forma_pago
FROM tbl15_tercero RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_venta_producto ON tbl15_cliente.cod_cliente = tbl15_venta_producto.cod_cliente) 
ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tbl15_venta_producto.cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  $condicion_hora_reporte_venta_rel 
AND (cod_tipo_pago = '2') 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel 
$filtro_consulta_nombre_tipo_factura_rel $filtro_consulta_nombre_tipo_compra_rel $filtro_consulta_tipo_metodo_envio_rel
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
    $precio_costo_producto         = $info_cliente['precio_costo_producto'];
    $total_compra_producto         = $info_cliente['total_compra_producto'];
    $precio_venta_producto         = $info_cliente['precio_venta_producto'];
    $total_venta_producto          = $info_cliente['total_venta_producto'];
    ///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
    if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
    if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
    $nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
    $nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
    $nombre_via_administracion     = $info_cliente['nombre_via_administracion'];
    $nombre_frec_duracion          = $info_cliente['nombre_frec_duracion'];
    $fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
    $fecha_hora_venta_producto     = $info_cliente['fecha_hora_venta_producto'];
    //$cuenta                        = $info_cliente['cuenta'];
    $cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
    $cod_administrador_db          = $info_cliente['cod_administrador'];
    $nombre_propietario            = $info_cliente['nombre1_tercero'].' '.$info_cliente['apellido1_tercero'];
    $comision_ptj                  = $info_cliente['comision_ptj'];
    $cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
    $cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
    $total_comision                = ($total_venta_producto * ($comision_ptj/100));

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

    $total_venta_credito_cliente  += $total_venta_producto;
?>
<tr>
    <td style="text-align:center"><?php echo $cod_factura?></td>
    <td style="text-align:left"><?php echo $cod_producto_barra?></td>
    <td style="text-align:left"><?php echo $nombre_producto?></td>
    <td style="text-align:left"><?php echo $nombre_propietario?></td>
    <td style="text-align:center"><?php echo $und_venta?></td>
    <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".")?></td>
    <td style="text-align:right"><?php echo number_format($total_venta_producto, 0, ",", ".")?></td>
    <td style="text-align:center"><?php echo $nombre_tipo_pago?></td>
    <td style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
    <td style="text-align:center"><?php echo $nombre_tipo_producto?></td>
    <td style="text-align:center"><?php echo $cuenta?></td>
    <td style="text-align:center"><?php echo $fecha_ymd_venta_producto?></td>
    <td style="text-align:center"><?php echo $fecha_hora_venta_producto?></td>
    <td style="text-align:center"><?php echo $cod_venta_producto?></td>
</tr>
<?php } ?>
<tr>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;">TOTAL</th>
    <th style="text-align:right; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_venta_credito_cliente, 0, ",", ".")?></th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
</tr>
</tbody>
</table>
<?php } ?>
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

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:9pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:9pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:9pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:9pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:9pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:9pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:9pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:9pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:9pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:9pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:9pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:9pt;"><strong>REPORTE VENTAS</strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:9pt;"><strong>VENDEDOR: <?php echo $cuenta_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:9pt;"><strong>TERCERO: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:9pt;"><strong>DEPENDENCIA: <?php echo $nombre_dependencia_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:9pt;"><strong>TIPO PAGO: <?php echo $nombre_tipo_pago_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:9pt;"><strong>FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:9pt;"><strong>FECHA INI: <?php echo $fecha_ymd_venta_producto_ini; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:9pt;"><strong>FECHA FIN: <?php echo $fecha_ymd_venta_producto_fin; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:9pt;">
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL VENTA:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_suma_venta_producto, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL VENTA CONTADO:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_venta_producto_contado, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL VENTA CREDITO:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_venta_producto_credito, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL VENTA (EN EFECTIVO):</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_venta_producto_contado_efectivo, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL ABONOS (CUENTA COBRAR):</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_abono_cuenta_cobrar_credito, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL ABONOS EN EFECTIVO (CUENTA COBRA):</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_abono_en_efectivo_cuenta_cobrar_credito, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL CAJA (EN EFECTIVO):</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_caja_venta_fisica, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL IVA:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_iva_producto_venta, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>

<?php if ($cod_estado_reporte_venta_total_compra_caja_registradora_global==1) { ?>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL FACTURA DE COMPRA:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_factura_compra_movimiento_contable_personal, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
<?php } ?>

<?php if ($cod_estado_egreso_registrar==1) { ?>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL EGRESOS:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier;total_caja_venta_fisica font-size:9pt;"><strong><?php echo number_format($total_egreso, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
<?php } ?>
<?php if ($cod_estado_reporte_venta_total_utilidad==1) { ?>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL UTILIDAD:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"> <strong><?php echo number_format($total_utilidad_neta, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
<?php } ?>
<?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL GANANCIA:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_ganancia, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
<?php } ?>
<?php if ($cod_estado_ptj_comision_global == '1') { ?>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL COMISION:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"> <strong><?php echo number_format($total_comision_venta, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
<?php } ?>
<?php if ($cod_estado_propina_global == '1') { ?>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL PROPINA:</strong></td>
    <td style="text-align: right; width: 47%; font-family: Courier; font-size:9pt;"> <strong><?php echo number_format($total_suma_servicio_propina, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
<?php } ?>
</table>

<?php if ($cod_estado_reporte_venta_total_compra_caja_registradora_global==1) { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
    <tr>
    <td style="text-align: center;"><strong>CAJA EN EFECTIVO</strong></td>
    </tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
    <thead>
        <tr>
            <th style="text-align: left; width: 47%; font-family: Courier; font-size:9pt;">CAJA EN EFECTIVO</th>
            <th style="text-align: center; width: 47%; font-family: Courier; font-size:9pt;">TOTAL EN EFECTIVO</th>
            <th style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th style="text-align: left; width: 47%; font-family: Courier; font-size:9pt;"><?php echo $nombre_tipo_forma_pago_efectivo?></th>
            <th style="text-align: center; width: 47%; font-family: Courier; font-size:9pt;"><?php echo number_format($totales_forma_pago_efectivo, 0, ",", ".")?></th>
            <th style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></th>
        </tr>
    </tbody>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
    <tr>
        <td style="text-align: center;"><=======================================></td>
    </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
    <tr>
        <td style="text-align: center;"><strong>FORMAS DE PAGO</strong></td>
    </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<thead>
    <tr>
        <th style="text-align: left; width: 47%; font-family: Courier; font-size:9pt;"><strong></strong></th>
        <th style="text-align: left; width: 47%; font-family: Courier; font-size:9pt;"><strong></strong></th>
        <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
    </tr>
</thead>
<tbody>
<?php
$sql_total_forma_pago = "SELECT Sum(tbl15_venta_producto.total_venta_producto) AS suma_total_venta_producto, tbl15_tipo_forma_pago.nombre_tipo_forma_pago
FROM tbl15_tipo_forma_pago RIGHT JOIN tbl15_venta_producto ON tbl15_tipo_forma_pago.cod_tipo_forma_pago = tbl15_venta_producto.cod_tipo_forma_pago
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tbl15_venta_producto.cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  $condicion_hora_reporte_venta_rel 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel 
$filtro_consulta_nombre_tipo_factura_rel $filtro_consulta_nombre_tipo_compra_rel $filtro_consulta_tipo_metodo_envio_rel
GROUP BY tbl15_tipo_forma_pago.cod_tipo_forma_pago";
$consulta_total_forma_pago = mysqli_query($conectar, $sql_total_forma_pago) or die(mysqli_error($conectar));
while ($datos_total_forma_pago = mysqli_fetch_assoc($consulta_total_forma_pago)) {

$nombre_tipo_forma_pago        = $datos_total_forma_pago['nombre_tipo_forma_pago'];
$suma_total_venta_producto     = $datos_total_forma_pago['suma_total_venta_producto'];

?>
    <tr>
        <td style="text-align: left; width: 47%; font-family: Courier; font-size:9pt;"><strong><?php echo $nombre_tipo_forma_pago?>:</strong></td>
        <td style="text-align: right; width: 47%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($suma_total_venta_producto, 0, ",", ".")?></strong></td>
        <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
    </tr>
<?php } ?>
</tbody>
</table>

<?php if ($cod_estado_categoria_global == '1') { ?>
    <table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
        <tr>
            <td style="text-align: center;"><=======================================></td>
        </tr>
    </table>

    <table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
        <tr>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>VENTAS POR CATEGORIA</strong></td>
        </tr>
    </table>

    <table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
    <thead>
        <tr>
            <td style="text-align: left; width: 47%; font-family: Courier; font-size:9pt;"><strong>CATEGORIA</strong></th>
            <td style="text-align: center; width: 47%; font-family: Courier; font-size:9pt;"><strong>TOTAL P.VENTA</strong></th>
            <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
        </tr>
    </thead>
    <tbody>
    <?php
    $sql_venta_vendedor = "SELECT SUM(total_venta_producto) AS total_venta_categoria, SUM(total_compra_producto) AS total_compra_categoria, cod_categoria
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio 
    GROUP BY cod_categoria";
    $consulta_venta_vendedor = mysqli_query($conectar, $sql_venta_vendedor) or die(mysqli_error($conectar));
    while ($datos_venta_vendedor = mysqli_fetch_assoc($consulta_venta_vendedor)) {

    $cod_categoria_db                = $datos_venta_vendedor['cod_categoria'];
    $total_compra_categoria          = $datos_venta_vendedor['total_compra_categoria'];
    $total_venta_categoria           = $datos_venta_vendedor['total_venta_categoria'];
    $total_ganancia_categoria        = $total_venta_categoria - $total_compra_categoria;

    $sql_vendedor_venta = "SELECT nombre_categoria FROM tbl15_categoria WHERE cod_categoria = '$cod_categoria_db'";
    $consulta_vendedor_venta = mysqli_query($conectar, $sql_vendedor_venta) or die(mysqli_error($conectar));
    $datos_vendedor_venta = mysqli_fetch_assoc($consulta_vendedor_venta);

    $nombre_categoria                  = $datos_vendedor_venta['nombre_categoria'];
    ?>
        <tr>
            <td style="text-align: left; width: 47%; font-family: Courier; font-size:9pt;"><strong><?php echo $nombre_categoria?></strong></td>
            <td style="text-align: right; width: 47%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_venta_categoria, 0, ",", ".")?></strong></td>
            <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
    <tr>
        <td style="text-align:center; background-color:#DBE0F3; color:#000;"><strong>VENTAS POR DEPENDENCIA</strong></td>
    </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<thead>
    <tr>
        <td style="text-align: left; width: 47%; font-family: Courier; font-size:9pt;"><strong>DEPENDENCIA</strong></th>
        <td style="text-align: center; width: 47%; font-family: Courier; font-size:9pt;"><strong>TOTAL VENTA</strong></th>
        <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
    </tr>
</thead>
<tbody>
<?php
$sql_venta_vendedor = "SELECT SUM(total_venta_producto) AS total_venta_dependencia, cod_dependencia
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') $condicion_hora_reporte_venta 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio 
GROUP BY cod_dependencia";
$consulta_venta_vendedor = mysqli_query($conectar, $sql_venta_vendedor) or die(mysqli_error($conectar));
while ($datos_venta_vendedor = mysqli_fetch_assoc($consulta_venta_vendedor)) {

    $cod_dependencia_db              = $datos_venta_vendedor['cod_dependencia'];
    $total_venta_dependencia         = $datos_venta_vendedor['total_venta_dependencia'];

    $sql_vendedor_venta = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia_db'";
    $consulta_vendedor_venta = mysqli_query($conectar, $sql_vendedor_venta) or die(mysqli_error($conectar));
    $datos_vendedor_venta = mysqli_fetch_assoc($consulta_vendedor_venta);

    $nombre_dependencia                  = $datos_vendedor_venta['nombre_dependencia'];
?>
    <tr>
        <td style="text-align: left; width: 47%; font-family: Courier; font-size:9pt;"><strong><?php echo $nombre_dependencia?></strong></td>
        <td style="text-align: right; width: 47%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_venta_dependencia, 0, ",", ".")?></strong></td>
        <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
    </tr>
<?php } ?>
</tbody>
</table>


<?php if ($cod_estado_imprimir_reporte_venta_con_productos_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
    <tr>
        <td style="text-align: center; width:5%; font-family: Courier; font-size:9pt;"><strong>Und</strong></td>
        <td style="text-align: center; width:50%; font-family: Courier; font-size:9pt;"><strong>Concepto</strong></td>
        <td style="text-align: center; width:30%; font-family: Courier; font-size:9pt;"><strong>P.Total</strong></td>
        <td style="text-align: center; width:3%; font-family: Courier; font-size:9pt;"><strong>Id</strong></td>
    </tr>
<?php
$suma_total_venta = 0;
if ($cod_estado_mostrar_agrupado_produc_repventa_imprimir_global == '0') {
    $sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
    tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
    tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_costo_producto, tbl15_venta_producto.total_compra_producto, tbl15_venta_producto.precio_venta_producto, 
    tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, 
    tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, 
    tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_venta_producto.cod_administrador,
    tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
    tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar, tbl15_venta_producto.comision_ptj
    FROM tbl15_tercero RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_venta_producto ON tbl15_cliente.cod_cliente = tbl15_venta_producto.cod_cliente) 
    ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
    WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tbl15_venta_producto.cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  $condicion_hora_reporte_venta_rel 
    $filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel 
    $filtro_consulta_nombre_tipo_factura_rel $filtro_consulta_nombre_tipo_compra_rel $filtro_consulta_tipo_metodo_envio_rel
    ORDER BY tbl15_venta_producto.cod_venta_producto DESC";
} else {
    $sql_cliente = "SELECT tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
    tbl15_venta_producto.nombre_producto, SUM(tbl15_venta_producto.und_venta) AS und_venta, tbl15_venta_producto.precio_venta_producto, 
    SUM(tbl15_venta_producto.total_venta_producto) AS total_venta_producto, tbl15_venta_producto.cod_administrador,
    tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_venta_producto.cuenta, tbl15_venta_producto.comision_ptj, tbl15_venta_producto.cod_venta_producto
    FROM tbl15_tercero RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_venta_producto ON tbl15_cliente.cod_cliente = tbl15_venta_producto.cod_cliente) 
    ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
    WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tbl15_venta_producto.cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')  $condicion_hora_reporte_venta_rel 
    $filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel 
    $filtro_consulta_nombre_tipo_factura_rel $filtro_consulta_nombre_tipo_compra_rel $filtro_consulta_tipo_metodo_envio_rel
    GROUP BY tbl15_venta_producto.cod_producto_barra ORDER BY tbl15_venta_producto.nombre_producto DESC";
}
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

    $cod_venta_producto            = $info_cliente['cod_venta_producto'];
    $cod_producto                  = $info_cliente['cod_producto'];
    $cod_producto_barra            = $info_cliente['cod_producto_barra'];
    $nombre_producto               = $info_cliente['nombre_producto'];
    $und_venta                     = $info_cliente['und_venta'];
    $precio_venta_producto         = $info_cliente['precio_venta_producto'];
    $total_venta_producto          = $info_cliente['total_venta_producto'];
    $comision_ptj                  = $info_cliente['comision_ptj'];
    $cod_administrador_db          = $info_cliente['cod_administrador'];
    $nombre_propietario            = $info_cliente['nombre1_tercero'].' '.$info_cliente['apellido1_tercero'];
    $suma_total_venta              = $suma_total_venta + $total_venta_producto;
    $total_comision                = $total_comision + ($total_venta_producto * ($comision_ptj/100));

    if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
    if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];
?>
    <tr>
        <td style="text-align: center; width:5%; font-family: Courier; font-size:9pt;"><strong><?php echo $und_venta ?></strong></td>
        <td style="text-align: left; width:50%; font-family: Courier; font-size:9pt;"><strong><?php echo $nombre_producto ?></strong></td>
        <td style="text-align: right; width:30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
        <td style="text-align: right; width:3%; font-family: Courier; font-size:5pt;"><?php echo $cod_venta_producto ?></td>
    </tr>
<?php } ?>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:9pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:9pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:9pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:9pt;"><?php echo $fecha_impr.$hora_impr?>_imp_repventnav</td>
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
<!--</div>-->
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>