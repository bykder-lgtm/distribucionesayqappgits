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
    $cod_servicio_propina                    = '22222222';
    $cod_producto_barra                      = $cod_servicio_propina;
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
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta = mysqli_query($conectar, $sql_total_venta) or die(mysqli_error($conectar));
    $datos_total_venta = mysqli_fetch_assoc($consulta_total_venta);

    $total_suma_venta_producto       = $datos_total_venta['total_suma_venta_producto'];
    $total_suma_compra_producto      = $datos_total_venta['total_suma_compra_producto'];
    $total_ganancia                  = $total_suma_venta_producto - $total_suma_compra_producto;
    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $total_ganancia_porcentaje = (($total_ganancia / $total_suma_compra_producto) * 100); } else { $total_ganancia_porcentaje = (($total_ganancia / $total_suma_venta_producto) * 100); }
    $total_comision_venta            = $datos_total_venta['total_comision'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_contado_efectivo = "SELECT SUM(total_venta_producto) AS total_venta_producto_contado_efectivo, SUM(total_compra_producto) AS total_compra_producto
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_contado_efectivo = mysqli_query($conectar, $sql_total_venta_contado_efectivo) or die(mysqli_error($conectar));
    $datos_total_venta_contado_efectivo = mysqli_fetch_assoc($consulta_total_venta_contado_efectivo);

    $total_venta_producto_contado_efectivo    = $datos_total_venta_contado_efectivo['total_venta_producto_contado_efectivo'];
    $total_compra_producto_contado             = $datos_total_venta_contado_efectivo['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_contado = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$contado') $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago 
    $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_contado = mysqli_query($conectar, $sql_total_venta_contado) or die(mysqli_error($conectar));
    $datos_total_venta_contado = mysqli_fetch_assoc($consulta_total_venta_contado);

    $total_venta_producto_contado    = $datos_total_venta_contado['total_venta_producto'];
    $total_compra_producto_contado    = $datos_total_venta_contado['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_credito = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto 
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$credito') $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago 
    $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_credito = mysqli_query($conectar, $sql_total_venta_credito) or die(mysqli_error($conectar));
    $datos_total_venta_credito = mysqli_fetch_assoc($consulta_total_venta_credito);

    $total_venta_producto_credito    = $datos_total_venta_credito['total_venta_producto'];
    $total_compra_producto_credito    = $datos_total_venta_credito['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_servicio_propina = "SELECT SUM(total_venta_producto) AS total_suma_servicio_propina FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta
    AND (cod_producto_barra = '$cod_producto_barra') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_servicio_propina = mysqli_query($conectar, $sql_total_servicio_propina) or die(mysqli_error($conectar));
    $datos_total_servicio_propina = mysqli_fetch_assoc($consulta_total_servicio_propina);

    $total_suma_servicio_propina       = $datos_total_servicio_propina['total_suma_servicio_propina'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_credito_abono = "SELECT SUM(abonado) AS total_cuenta_credito_abonado FROM tbl15_cuentas_cobrar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia";
    $consulta_cuenta_credito_abono = mysqli_query($conectar, $sql_total_cuenta_credito_abono) or die(mysqli_error($conectar));
    $datos_cuenta_credito_abono = mysqli_fetch_assoc($consulta_cuenta_credito_abono);

    $total_cuenta_credito_abonado    = $datos_cuenta_credito_abono['total_cuenta_credito_abonado'];

    $total_caja_venta_fisica         = $total_venta_producto_contado_efectivo + $total_cuenta_credito_abonado;
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_egreso_normal = "SELECT SUM(costo) AS total_egreso FROM tbl15_egreso 
    WHERE (fecha_dmy BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
    $consulta_total_egreso_normal = mysqli_query($conectar, $sql_total_egreso_normal) or die(mysqli_error($conectar));
    $datos_total_egreso_normal = mysqli_fetch_assoc($consulta_total_egreso_normal);

    $total_egreso_normal                      = $datos_total_egreso_normal['total_egreso'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_egreso_movimiento_contable = "SELECT SUM(total_costo_movimiento_contable) AS total_egreso_movimiento_contable FROM tbl15_movimiento_contable 
    WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND ((nombre_tipo_documento = 'COMPROBANTE DE EGRESO') AND (nombre_estado_factura = 'CERRADA'))";
    $consulta_total_egreso_movimiento_contable = mysqli_query($conectar, $sql_total_egreso_movimiento_contable) or die(mysqli_error($conectar));
    $datos_total_egreso_movimiento_contable = mysqli_fetch_assoc($consulta_total_egreso_movimiento_contable);

    $total_egreso_movimiento_contable                      = $datos_total_egreso_movimiento_contable['total_egreso_movimiento_contable'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $total_egreso                      = $total_egreso_normal + $total_egreso_movimiento_contable;
    $total_utilidad                    = $total_ganancia - $total_egreso;
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
        <?php if ($cod_estado_prod_precio_compra==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total P.Compra</a></th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total P.Venta</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta Contado</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta Credito</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta Efectivo</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Abonos</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Caja</a></th>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">$Total Ganancia</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">%Ganancia</th>

        <?php } ?>
        <?php if ($cod_estado_egreso_registrar==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Egresos</a></th>
        <?php } ?>
        <?php if ($cod_estado_reporte_venta_total_utilidad==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">$Total Utilidad</th>
        <?php } ?>
        <?php if ($cod_estado_ptj_comision_global == '1') { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Comision</th>
        <?php } ?>
        <?php if ($cod_estado_propina_global == '1') { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Propina</th>
        <?php } ?>
    </tr>
    <tr>
        <?php if ($cod_estado_prod_precio_compra==1) { ?><td style="text-align:center;"><?php echo number_format($total_suma_compra_producto, 0, ",", ".") ?></td><?php } ?>
        <td style="text-align:center;"><?php echo number_format($total_suma_venta_producto, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_venta_producto_contado, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_venta_producto_credito, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_venta_producto_contado_efectivo, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_cuenta_credito_abonado, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_caja_venta_fisica, 0, ",", ".") ?></td>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <td style="text-align:center;"><?php echo number_format($total_ganancia, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_ganancia_porcentaje, 0, ",", ".") ?>%</td>
        <?php } ?>
        <?php if ($cod_estado_egreso_registrar==1) { ?>
        <td style="text-align:center;"><?php echo number_format($total_egreso, 0, ",", ".") ?></td>
        <?php } ?>
        <?php if ($cod_estado_reporte_venta_total_utilidad==1) { ?>
        <td style="text-align:center;"><?php echo number_format($total_utilidad, 0, ",", ".") ?></td>
        <?php } ?>
        <?php if ($cod_estado_ptj_comision_global == '1') { ?>
        <td style="text-align:center;"><?php echo number_format($total_comision_venta, 0, ",", ".") ?></td>
        <?php } ?>
        <?php if ($cod_estado_propina_global == '1') { ?>
        <td style="text-align:center;"><?php echo number_format($total_suma_servicio_propina, 0, ",", ".") ?></td>
        <?php } ?>
    </tr>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->

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
<td style="text-align:center;"><a href="../admin/descargar_venta_generales_pos_xls.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_administrador=<?php echo $cod_administrador?>&cod_tercero=<?php echo $cod_tercero?>&cod_tipo_pago=<?php echo $cod_tipo_pago?>&cod_dependencia=<?php echo $cod_dependencia?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago?>&nombre_tipo_factura=<?php echo $nombre_tipo_factura?>"><img src=../imagenes/xls.png alt="imprimir_peq"></a></td>
<td style="text-align:center;"><a href="../admin/descargar_venta_generales_pos_xlsx.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&cod_administrador=<?php echo $cod_administrador?>&cod_tercero=<?php echo $cod_tercero?>&cod_tipo_pago=<?php echo $cod_tipo_pago?>&cod_dependencia=<?php echo $cod_dependencia?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago?>&nombre_tipo_factura=<?php echo $nombre_tipo_factura?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></td>
</tr>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
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
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL ABONOS:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_cuenta_credito_abonado, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL CAJA:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_caja_venta_fisica, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
<?php if ($cod_seguridad==1) { ?>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL EGRESOS:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier;total_caja_venta_fisica font-size:9pt;"><strong><?php echo number_format($total_egreso, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL UTILIDAD:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"> <strong><?php echo number_format($total_utilidad, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 55%; font-family: Courier; font-size:9pt;"><strong>TOTAL GANANCIA:</strong></td>
    <td style="text-align: right; width: 30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($total_ganancia, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:9pt;"></td>
  </tr>
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

<?php } ?>
</table>

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
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta_rel 
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
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
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
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
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
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta_rel 
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
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta_rel 
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