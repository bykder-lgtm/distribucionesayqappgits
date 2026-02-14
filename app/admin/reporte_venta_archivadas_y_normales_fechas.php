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
<h4>Reporte Ventas Archivadas y Normales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if ($cod_estado_reporte_venta_archivada == '1') { ?>
<a href="../admin/reporte_venta_archivadas_fechas.php">Reporte Ventas Archivadas</h4></a>
<?php } ?>
</div>

<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Reporte Ventas Archivadas y Normales</h6></a>
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
$total_suma_compra_producto_archivada = 1;
$total_suma_venta_producto_archivada = 1;

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
            $filtro_consulta_vendedor                      = "";
            $filtro_consulta_vendedor_rel                  = "";
            $filtro_consulta_vendedor_archivado            = "";
            $filtro_consulta_vendedor_archivado_rel        = "";
        } else {
            $filtro_consulta_vendedor                      = "AND (cod_administrador = '$cod_administrador')";
            $filtro_consulta_vendedor_rel                  = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
            $filtro_consulta_vendedor_archivado            = "AND (cod_administrador = '$cod_administrador')";
            $filtro_consulta_vendedor_archivado_rel        = "AND (tbl15_venta_producto_archivado.cod_administrador = '$cod_administrador')";
        }
    } else {
        $filtro_consulta_vendedor                          = "AND (cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_rel                      = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_archivado                = "AND (cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_archivado_rel            = "AND (tbl15_venta_producto_archivado.cod_administrador = '$cod_administrador')";
    }


    if ($cod_estado_hora_reporte_venta_global == '1') {
        $fecha_hora_venta_producto_ini                     = addslashes($_GET['fecha_hora_venta_producto_ini']);
        $fecha_hora_venta_producto_fin                     = addslashes($_GET['fecha_hora_venta_producto_fin']);
        $condicion_hora_reporte_venta                      = "AND (fecha_hora_venta_producto BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_rel                  = "AND (tbl15_venta_producto.fecha_hora_venta_producto BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_info                 = "AND (fecha_hora BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_info_rel             = "AND (tbl15_venta_producto.fecha_hora BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_archivado_rel        = "AND (tbl15_venta_producto_archivado.fecha_hora_venta_producto BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_archivado_info_rel   = "AND (tbl15_venta_producto_archivado.fecha_hora BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
    } else {
        $fecha_hora_venta_producto_ini                     = '';
        $fecha_hora_venta_producto_fin                     = '';
        $condicion_hora_reporte_venta                      = '';
        $condicion_hora_reporte_venta_rel                  = '';
        $condicion_hora_reporte_venta_info                 = '';
        $condicion_hora_reporte_venta_info_rel             = '';
        $condicion_hora_reporte_venta_archivado_rel        = '';
        $condicion_hora_reporte_venta_archivado_info_rel   = '';
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
        $fecha_hora_venta_producto_ini                     = '00:00:00';
        $fecha_hora_venta_producto_fin                     = '23:59:59';
        $condicion_hora_reporte_venta                      = "AND (fecha_hora_venta_producto BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_rel                  = "AND (tbl15_venta_producto.fecha_hora_venta_producto BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_info                 = "AND (fecha_hora BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_info_rel             = "AND (tbl15_venta_producto.fecha_hora BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_archivado_rel        = "AND (tbl15_venta_producto_archivado.fecha_hora_venta_producto BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
        $condicion_hora_reporte_venta_archivado_info_rel   = "AND (tbl15_venta_producto_archivado.fecha_hora BETWEEN '".$fecha_hora_venta_producto_ini."' AND '".$fecha_hora_venta_producto_fin."')";
    } else {
        $fecha_hora_venta_producto_ini                     = '';
        $fecha_hora_venta_producto_fin                     = '';
        $condicion_hora_reporte_venta                      = '';
        $condicion_hora_reporte_venta_rel                  = '';
        $condicion_hora_reporte_venta_info                 = '';
        $condicion_hora_reporte_venta_info_rel             = '';
        $condicion_hora_reporte_venta_archivado_rel        = "";
        $condicion_hora_reporte_venta_archivado_info_rel   = "";
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
        $filtro_consulta_vendedor_archivado = "";
        $filtro_consulta_vendedor_archivado_rel = "";
    } else {
        $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_archivado = "AND (cod_administrador = '$cod_administrador')";
        $filtro_consulta_vendedor_archivado_rel = "AND (tbl15_venta_producto_archivado.cod_administrador = '$cod_administrador')";
    }

    if ($cod_tercero==0) {
        $filtro_consulta_tercero = "";
        $filtro_consulta_tercero_rel = "";
        $filtro_consulta_tercero_archivado = "";
        $filtro_consulta_tercero_archivado_rel = "";
    } else {
        $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
        $filtro_consulta_tercero_rel = "AND (tbl15_venta_producto.cod_tercero = '$cod_tercero')";
        $filtro_consulta_tercero_archivado = "AND (cod_tercero = '$cod_tercero')";
        $filtro_consulta_tercero_archivado_rel = "AND (tbl15_venta_producto_archivado.cod_tercero = '$cod_tercero')";
    }

    if ($cod_tipo_pago==0) {
        $filtro_consulta_tipo_pago = "";
        $filtro_consulta_tipo_pago_rel = "";
        $filtro_consulta_tipo_pago_archivado = "";
        $filtro_consulta_tipo_pago_archivado_rel = "";
    } else {
        $filtro_consulta_tipo_pago = "AND (cod_tipo_pago = '$cod_tipo_pago')";
        $filtro_consulta_tipo_pago_rel = "AND (tbl15_venta_producto.cod_tipo_pago = '$cod_tipo_pago')";
        $filtro_consulta_tipo_pago_archivado = "AND (cod_tipo_pago = '$cod_tipo_pago')";
        $filtro_consulta_tipo_pago_archivado_rel = "AND (tbl15_venta_producto_archivado.cod_tipo_pago = '$cod_tipo_pago')";
    }

    if ($cod_tipo_forma_pago==0) {
        $filtro_consulta_tipo_forma_pago = "";
        $filtro_consulta_tipo_forma_pago_rel = "";
        $filtro_consulta_tipo_forma_pago_archivado = "";
        $filtro_consulta_tipo_forma_pago_archivado_rel = "";
    } else {
        $filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
        $filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_venta_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
        $filtro_consulta_tipo_forma_pago_archivado = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
        $filtro_consulta_tipo_forma_pago_archivado_rel = "AND (tbl15_venta_producto_archivado.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    }

    if ($cod_dependencia==0) {
        $filtro_consulta_dependencia = "";
        $filtro_consulta_dependencia_rel = "";
        $filtro_consulta_dependencia_archivado = "";
        $filtro_consulta_dependencia_archivado_rel = "";
    } else {
        $filtro_consulta_dependencia = "AND (cod_dependencia = '$cod_dependencia')";
        $filtro_consulta_dependencia_rel = "AND (tbl15_venta_producto.cod_dependencia = '$cod_dependencia')";
        $filtro_consulta_dependencia_archivado = "AND (cod_dependencia = '$cod_dependencia')";
        $filtro_consulta_dependencia_archivado_rel = "AND (tbl15_venta_producto_archivado.cod_dependencia = '$cod_dependencia')";
    }

    if ($nombre_tipo_factura=='0') {
        $filtro_consulta_nombre_tipo_factura = "";
        $filtro_consulta_nombre_tipo_factura_rel = "";
        $filtro_consulta_nombre_tipo_factura_archivado = "";
        $filtro_consulta_nombre_tipo_factura_archivado_rel = "";
    } else {
        $filtro_consulta_nombre_tipo_factura = "AND (nombre_tipo_factura = '$nombre_tipo_factura')";
        $filtro_consulta_nombre_tipo_factura_rel = "AND (tbl15_venta_producto.nombre_tipo_factura = '$nombre_tipo_factura')";
        $filtro_consulta_nombre_tipo_factura_archivado = "AND (nombre_tipo_factura = '$nombre_tipo_factura')";
        $filtro_consulta_nombre_tipo_factura_archivado_rel = "AND (tbl15_venta_producto_archivado.nombre_tipo_factura = '$nombre_tipo_factura')";
    }

    if ($nombre_tipo_compra=='0') {
        $filtro_consulta_nombre_tipo_compra = "";
        $filtro_consulta_nombre_tipo_compra_rel = "";
        $filtro_consulta_nombre_tipo_compra_archivado = "";
        $filtro_consulta_nombre_tipo_compra_archivado_rel = "";
    } else {
        $filtro_consulta_nombre_tipo_compra = "AND (nombre_tipo_compra = '$nombre_tipo_compra')";
        $filtro_consulta_nombre_tipo_compra_rel = "AND (tbl15_venta_producto.nombre_tipo_compra = '$nombre_tipo_compra')";
        $filtro_consulta_nombre_tipo_compra_archivado = "AND (nombre_tipo_compra = '$nombre_tipo_compra')";
        $filtro_consulta_nombre_tipo_compra_archivado_rel = "AND (tbl15_venta_producto_archivado.nombre_tipo_compra = '$nombre_tipo_compra')";
    }

    if ($cod_tipo_metodo_envio==0) {
        $filtro_consulta_tipo_metodo_envio = "";
        $filtro_consulta_tipo_metodo_envio_rel = "";
        $filtro_consulta_tipo_metodo_envio_archivado = "";
        $filtro_consulta_tipo_metodo_envio_archivado_rel = "";
    } else {
        $filtro_consulta_tipo_metodo_envio = "AND (cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
        $filtro_consulta_tipo_metodo_envio_rel = "AND (tbl15_venta_producto.cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
        $filtro_consulta_tipo_metodo_envio_archivado = "AND (cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
        $filtro_consulta_tipo_metodo_envio_archivado_rel = "AND (tbl15_venta_producto_archivado.cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
    }
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_normal = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_suma_compra_producto, 
    Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva, 
    SUM(total_venta_producto * (comision_ptj/100)) AS total_comision 
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_mormal = mysqli_query($conectar, $sql_total_venta_normal) or die(mysqli_error($conectar));
    $datos_total_venta_normal = mysqli_fetch_assoc($consulta_total_venta_mormal);

    $total_suma_venta_producto_normal       = $datos_total_venta_normal['total_suma_venta_producto'];
    $total_suma_compra_producto_normal      = $datos_total_venta_normal['total_suma_compra_producto'];
    $total_ganancia_normal                  = $total_suma_venta_producto_normal - $total_suma_compra_producto_normal;
    $total_comision_venta_normal            = $datos_total_venta_normal['total_comision'];
    $total_iva_normal                       = $datos_total_venta_normal['total_iva'];

    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $total_ganancia_porcentaje_normal = (($total_ganancia_normal / $total_suma_compra_producto_normal) * 100); } else { $total_ganancia_porcentaje_normal = (($total_ganancia_normal / $total_suma_venta_producto_normal) * 100); }
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_contado_efectivo_normal = "SELECT SUM(total_venta_producto) AS total_venta_producto_contado_efectivo, SUM(total_compra_producto) AS total_compra_producto
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_contado_efectivo_normal = mysqli_query($conectar, $sql_total_venta_contado_efectivo_normal) or die(mysqli_error($conectar));
    $datos_total_venta_contado_efectivo_normal = mysqli_fetch_assoc($consulta_total_venta_contado_efectivo_normal);

    $total_venta_producto_contado_efectivo_normal     = $datos_total_venta_contado_efectivo_normal['total_venta_producto_contado_efectivo'];
    $total_compra_producto_contado_normal             = $datos_total_venta_contado_efectivo_normal['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_contado_normal = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$contado') $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago 
    $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_contado_normal = mysqli_query($conectar, $sql_total_venta_contado_normal) or die(mysqli_error($conectar));
    $datos_total_venta_contado_normal = mysqli_fetch_assoc($consulta_total_venta_contado_normal);

    $total_venta_producto_contado_normal     = $datos_total_venta_contado_normal['total_venta_producto'];
    $total_compra_producto_contado_normal    = $datos_total_venta_contado_normal['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_credito_normal = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto 
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$credito') $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago 
    $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_credito_normal = mysqli_query($conectar, $sql_total_venta_credito_normal) or die(mysqli_error($conectar));
    $datos_total_venta_credito_normal = mysqli_fetch_assoc($consulta_total_venta_credito_normal);

    $total_venta_producto_credito_normal     = $datos_total_venta_credito_normal['total_venta_producto'];
    $total_compra_producto_credito_normal    = $datos_total_venta_credito_normal['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_servicio_propina_normal = "SELECT SUM(total_venta_producto) AS total_suma_servicio_propina FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta
    AND (cod_producto_barra = '$cod_producto_barra') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_servicio_propina_normal = mysqli_query($conectar, $sql_total_servicio_propina_normal) or die(mysqli_error($conectar));
    $datos_total_servicio_propina_normal = mysqli_fetch_assoc($consulta_total_servicio_propina_normal);

    $total_suma_servicio_propina_normal       = $datos_total_servicio_propina_normal['total_suma_servicio_propina'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_credito_abono = "SELECT SUM(abonado) AS total_cuenta_credito_abonado FROM tbl15_cuentas_cobrar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia";
    $consulta_cuenta_credito_abono = mysqli_query($conectar, $sql_total_cuenta_credito_abono) or die(mysqli_error($conectar));
    $datos_cuenta_credito_abono = mysqli_fetch_assoc($consulta_cuenta_credito_abono);

    $total_cuenta_credito_abonado    = $datos_cuenta_credito_abono['total_cuenta_credito_abonado'];
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

    $total_egreso_movimiento_contable                              = $datos_total_egreso_movimiento_contable['total_egreso_movimiento_contable'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $total_egreso                                                  = $total_egreso_normal + $total_egreso_movimiento_contable;
    $total_utilidad_normal                                         = $total_ganancia_normal - $total_egreso;
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_archivada = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_suma_compra_producto, 
    Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva, 
    SUM(total_venta_producto * (comision_ptj/100)) AS total_comision 
    FROM tbl15_venta_producto_archivado 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_mormal = mysqli_query($conectar, $sql_total_venta_archivada) or die(mysqli_error($conectar));
    $datos_total_venta_archivada = mysqli_fetch_assoc($consulta_total_venta_mormal);

    $total_suma_venta_producto_archivada                           = intval($datos_total_venta_archivada['total_suma_venta_producto']);
    $total_suma_compra_producto_archivada                          = intval($datos_total_venta_archivada['total_suma_compra_producto']);
    $total_ganancia_archivada                                      = $total_suma_venta_producto_archivada - $total_suma_compra_producto_archivada;
    $total_comision_venta_archivada                                = $datos_total_venta_archivada['total_comision'];
    $total_iva_archivada                                           = $datos_total_venta_archivada['total_iva'];

    if ($total_suma_compra_producto_archivada == '0') { $total_suma_compra_producto_archivada = 1; } else { $total_suma_compra_producto_archivada = $datos_total_venta_archivada['total_suma_compra_producto']; }
    if ($total_suma_venta_producto_archivada == '0') { $total_suma_venta_producto_archivada = 1; } else { $total_suma_venta_producto_archivada = $datos_total_venta_archivada['total_suma_venta_producto']; }
    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $total_ganancia_porcentaje_archivada = (($total_ganancia_archivada / $total_suma_compra_producto_archivada) * 100); } else { $total_ganancia_porcentaje_archivada = (($total_ganancia_archivada / $total_suma_venta_producto_archivada) * 100); }
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_contado_efectivo_archivada = "SELECT SUM(total_venta_producto) AS total_venta_producto_contado_efectivo, SUM(total_compra_producto) AS total_compra_producto
    FROM tbl15_venta_producto_archivado 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_contado_efectivo_archivada = mysqli_query($conectar, $sql_total_venta_contado_efectivo_archivada) or die(mysqli_error($conectar));
    $datos_total_venta_contado_efectivo_archivada = mysqli_fetch_assoc($consulta_total_venta_contado_efectivo_archivada);

    $total_venta_producto_contado_efectivo_archivada     = $datos_total_venta_contado_efectivo_archivada['total_venta_producto_contado_efectivo'];
    $total_compra_producto_contado_archivada             = $datos_total_venta_contado_efectivo_archivada['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_contado_archivada = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto
    FROM tbl15_venta_producto_archivado 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$contado') $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago 
    $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_contado_archivada = mysqli_query($conectar, $sql_total_venta_contado_archivada) or die(mysqli_error($conectar));
    $datos_total_venta_contado_archivada = mysqli_fetch_assoc($consulta_total_venta_contado_archivada);

    $total_venta_producto_contado_archivada     = $datos_total_venta_contado_archivada['total_venta_producto'];
    $total_compra_producto_contado_archivada    = $datos_total_venta_contado_archivada['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_credito_archivada = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto 
    FROM tbl15_venta_producto_archivado 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    AND (cod_tipo_pago = '$credito') $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago 
    $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_venta_credito_archivada = mysqli_query($conectar, $sql_total_venta_credito_archivada) or die(mysqli_error($conectar));
    $datos_total_venta_credito_archivada = mysqli_fetch_assoc($consulta_total_venta_credito_archivada);

    $total_venta_producto_credito_archivada     = $datos_total_venta_credito_archivada['total_venta_producto'];
    $total_compra_producto_credito_archivada    = $datos_total_venta_credito_archivada['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_servicio_propina_archivada = "SELECT SUM(total_venta_producto) AS total_suma_servicio_propina FROM tbl15_venta_producto_archivado 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta
    AND (cod_producto_barra = '$cod_producto_barra') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_servicio_propina_archivada = mysqli_query($conectar, $sql_total_servicio_propina_archivada) or die(mysqli_error($conectar));
    $datos_total_servicio_propina_archivada = mysqli_fetch_assoc($consulta_total_servicio_propina_archivada);

    $total_suma_servicio_propina_archivada           = $datos_total_servicio_propina_archivada['total_suma_servicio_propina'];
    $total_utilidad_archivada                        = $total_ganancia_archivada - $total_egreso; 
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $total_suma_compra_producto                      = $total_suma_compra_producto_normal + $total_suma_compra_producto_archivada;
    $total_suma_venta_producto                       = $total_suma_venta_producto_normal + $total_suma_venta_producto_archivada;
    $total_venta_producto_contado                    = $total_venta_producto_contado_normal + $total_venta_producto_contado_archivada;

    $total_venta_producto_credito                    = $total_venta_producto_credito_normal + $total_venta_producto_credito_archivada;
    $total_venta_producto_contado_efectivo           = $total_venta_producto_contado_efectivo_normal + $total_venta_producto_contado_efectivo_archivada;
    $total_ganancia                                  = $total_ganancia_normal + $total_ganancia_archivada;
    $total_utilidad                                  = $total_utilidad_normal + $total_utilidad_archivada;
    $total_comision_venta                            = $total_comision_venta_normal + $total_comision_venta_archivada;
    $total_suma_servicio_propina                     = $total_suma_servicio_propina_normal + $total_suma_servicio_propina_archivada;
    $total_caja_venta_fisica                         = $total_venta_producto_contado_efectivo_normal + $total_venta_producto_contado_efectivo_archivada + $total_cuenta_credito_abonado;
?>

<?php if (isset($_GET['fecha_ymd_venta_producto_ini'])) { ?>
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
        <?php if ($cod_estado_prod_precio_compra==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total P.Compra</a></th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total P.Venta</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta Contado</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta Credito</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta Efectivo</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Abonos</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Caja</a></th>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">$Total Ganancia</th>
        <!--<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">%Ganancia</th>-->

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
        <!--<td style="text-align:center;"><?php echo number_format($total_ganancia_porcentaje, 0, ",", ".") ?>%</td>-->
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
<hr>
<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="#"><strong>ORIGEN DE LA VENTA</strong></a></td>
</tr>
</table>
<table class="table table-striped">
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">ORIGEN</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">TOTAL VENTA</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">TOTAL IVA</a></th>
    </tr>
    <tr>
        <td style="text-align:center;">NORMAL</td>
        <td style="text-align:center;"><?php echo number_format($total_suma_venta_producto_normal, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_iva_normal, 0, ",", ".") ?></td>
     </tr>
    <tr>
        <td style="text-align:center;">ARCHIVADA</td>
        <td style="text-align:center;"><?php echo number_format($total_suma_venta_producto_archivada, 0, ",", ".") ?></td>
        <td style="text-align:center;"><?php echo number_format($total_iva_archivada, 0, ",", ".") ?></td>
    </tr>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">TOTAL</a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><?php echo number_format($total_suma_venta_producto_normal + $total_suma_venta_producto_archivada, 0, ",", ".") ?></a></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><?php echo number_format($total_iva_normal + $total_iva_archivada, 0, ",", ".") ?></a></th>
    </tr>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_impuestos==1) { ?>
<!--
<hr>
<table class="table table-striped">
<tr>
<td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS IMPUESTOS</strong></a></td>
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
-->
<?php
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$total_valor_base_normal                     = 0;
$total_valor_iva_normal                      = 0;
$total_valor_total_normal                    = 0;
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$sql_total_tipos_iva_ipc_normal = "SELECT SUM(precio_ipc * und_venta) AS total_impoconsumo FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta AND (precio_ipc <> '0') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
$consulta_total_tipos_iva_ipc_normal = mysqli_query($conectar, $sql_total_tipos_iva_ipc_normal) or die(mysqli_error($conectar));
$datos_total_tipos_iva_ipc_normal = mysqli_fetch_assoc($consulta_total_tipos_iva_ipc_normal);

$total_venta_impoconsumo_normal              = 0;
$total_base_impoconsumo_normal               = 0;
$total_impoconsumo_normal                    = $datos_total_tipos_iva_ipc_normal['total_impoconsumo'];
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$mostrar_datos_sql = "SELECT  cod_tipo_iva, nombre_tipo_iva, descripcion_tipo_iva, iva, nombre_estado FROM tbl15_tipo_iva WHERE nombre_estado = 'ACTIVO' ORDER BY iva ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

    $iva_ptj                                     = $datos['iva'];

    $sql_total_tipos_iva_normal = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
    Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
    Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
    FROM tbl15_venta_producto WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    AND (iva_ptj = '$iva_ptj') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_tipos_iva_normal = mysqli_query($conectar, $sql_total_tipos_iva_normal) or die(mysqli_error($conectar));
    $datos_total_tipos_iva_normal = mysqli_fetch_assoc($consulta_total_tipos_iva_normal);

    $total_venta_normal                         = $datos_total_tipos_iva_normal['total_venta'];
    $total_base_iva_normal                      = $datos_total_tipos_iva_normal['total_base_iva'];
    $total_iva_normal                           = $datos_total_tipos_iva_normal['total_iva'];

    $total_valor_base_normal                    += $total_base_iva_normal;
    $total_valor_iva_normal                     += $total_iva_normal;
    $total_valor_total_normal                   += $total_venta_normal;
}
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$total_valor_base_archivada                     = 0;
$total_valor_iva_archivada                      = 0;
$total_valor_total_archivada                    = 0;
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$sql_total_tipos_iva_ipc_archivada = "SELECT SUM(precio_ipc * und_venta) AS total_impoconsumo FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta AND (precio_ipc <> '0') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
$filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
$consulta_total_tipos_iva_ipc_archivada = mysqli_query($conectar, $sql_total_tipos_iva_ipc_archivada) or die(mysqli_error($conectar));
$datos_total_tipos_iva_ipc_archivada = mysqli_fetch_assoc($consulta_total_tipos_iva_ipc_archivada);

$total_venta_impoconsumo_archivada              = 0;
$total_base_impoconsumo_archivada               = 0;
$total_impoconsumo_archivada                    = $datos_total_tipos_iva_ipc_archivada['total_impoconsumo'];
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$mostrar_datos_sql = "SELECT  cod_tipo_iva, nombre_tipo_iva, descripcion_tipo_iva, iva, nombre_estado FROM tbl15_tipo_iva WHERE nombre_estado = 'ACTIVO' ORDER BY iva ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$total_resultados = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

    $iva_ptj                                 = $datos['iva'];

    $sql_total_tipos_iva_archivada = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
    Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
    Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
    FROM tbl15_venta_producto WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
    AND (iva_ptj = '$iva_ptj') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia 
    $filtro_consulta_nombre_tipo_factura $filtro_consulta_nombre_tipo_compra $filtro_consulta_tipo_metodo_envio";
    $consulta_total_tipos_iva_archivada = mysqli_query($conectar, $sql_total_tipos_iva_archivada) or die(mysqli_error($conectar));
    $datos_total_tipos_iva_archivada = mysqli_fetch_assoc($consulta_total_tipos_iva_archivada);

    $total_venta_archivada                         = $datos_total_tipos_iva_archivada['total_venta'];
    $total_base_iva_archivada                      = $datos_total_tipos_iva_archivada['total_base_iva'];
    $total_iva_archivada                           = $datos_total_tipos_iva_archivada['total_iva'];

    $total_valor_base_archivada                    += $total_base_iva_archivada;
    $total_valor_iva_archivada                     += $total_iva_archivada;
    $total_valor_total_archivada                   += $total_venta_archivada;
}
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------//
$total_base_iva                                 = $total_base_iva_normal + $total_base_iva_archivada;
$total_iva                                      = $total_iva_normal + $total_iva_archivada;
$total_venta                                    = $total_venta_normal + $total_venta_archivada;

$total_venta_impoconsumo                        = $total_venta_impoconsumo_normal + $total_venta_impoconsumo_archivada;
$total_base_impoconsumo                         = $total_base_impoconsumo_normal + $total_base_impoconsumo_archivada;
$total_impoconsumo                              = $total_impoconsumo_normal + $total_impoconsumo_archivada;

$total_valor_base                               = $total_valor_base_normal + $total_valor_base_archivada;
$total_valor_iva                                = $total_valor_iva_normal + $total_valor_iva_archivada;
$total_valor_total                              = $total_valor_total_normal + $total_valor_total_archivada;


if ($iva_ptj == '0') { $operacion = 'No'; } else { $operacion = ''; }
?>
<!--
  <tr>
    <td style="text-align:left">Ingresos Por Operac. <?php echo $operacion ?> Gravadas: <?php echo $iva_ptj ?>%</td>
    <td style="text-align:right"><?php echo number_format($total_base_iva, 0, ",", "."); ?></td>
    <td style="text-align:right"><?php echo number_format($total_iva, 0, ",", "."); ?></td>
    <td style="text-align:right"><?php echo number_format($total_venta, 0, ",", "."); ?></td>
  </tr>
-->
<?php } ?>
<!--
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
-->
</tbody>
</table>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_reporte_venta_archivada_y_normal==1) { ?>
<hr>
<?php
$total_total_venta_producto    = 0;
$total_ganancia_venta_sum      = 0;
$total_total_venta_producto    = 0;
$total_ganancia_venta_sum      = 0;
$contador_array_venta          = 1;
$contador_array_info_venta     = 1;
$datos_vectores_venta          = array();
$datos_vectores_info_venta     = array();

$sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_compra_producto, tbl15_venta_producto.precio_costo_producto, tbl15_venta_producto.total_compra_producto, 
tbl15_venta_producto.precio_venta_producto, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, 
tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, 
tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_venta_producto.cod_administrador,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar, tbl15_venta_producto.comision_ptj, tbl15_venta_producto.cod_tipo_pago, 
tbl15_venta_producto.cod_tipo_forma_pago, tbl15_venta_producto.cod_dependencia, tbl15_venta_producto.nombre_tipo_factura, tbl15_venta_producto.und_producto, 
tbl15_venta_producto.nombre_tipo_compra, tbl15_venta_producto.cod_tipo_metodo_envio, tbl15_venta_producto.nombre_tipo_cobro, tbl15_venta_producto.fecha_seg_venta_producto
FROM tbl15_tercero RIGHT JOIN tbl15_venta_producto ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta_rel 
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
    $cod_dependencia               = $info_cliente['cod_dependencia'];
    $nombre_tipo_factura           = $info_cliente['nombre_tipo_factura'];
    $nombre_tipo_compra            = $info_cliente['nombre_tipo_compra'];
    $und_producto                  = $info_cliente['und_producto'];
    $cod_tipo_metodo_envio         = $info_cliente['cod_tipo_metodo_envio'];
    $nombre_tipo_cobro             = $info_cliente['nombre_tipo_cobro'];
    $fecha_seg_venta_producto      = $info_cliente['fecha_seg_venta_producto'];

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

    if ($total_compra_producto == '0') { $total_compra_producto = 1; } else { $total_compra_producto = $info_cliente['total_compra_producto']; }
    if ($total_venta_producto == '0') { $total_venta_producto = 1; } else { $total_venta_producto = $info_cliente['total_venta_producto']; }

    $total_ganancia_venta          = ($total_venta_producto - $total_compra_producto);
    $total_comision                = ($total_venta_producto * ($comision_ptj/100));
    $total_ganancia_venta_sum     += $total_ganancia_venta;

    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $porcentaje_ganancia_venta = (($total_ganancia_venta / $total_compra_producto) * 100); } else { $porcentaje_ganancia_venta = (($total_ganancia_venta / $total_venta_producto) * 100); }

    $tipo_operacion                                     = "NORMAL";
    $id_operacion                                       = $cod_venta_producto;
    $datos_vectores_venta[$contador_array_venta]                    = array("id_operacion"=>$id_operacion, 
                                                                "tipo_operacion"=>$tipo_operacion, 
                                                                "cod_venta_producto"=>$cod_venta_producto, 
                                                                "nombre_tipo_factura"=>$nombre_tipo_factura, 
                                                                "cod_factura"=>$cod_factura, 
                                                                "cod_producto_barra"=>$cod_producto_barra, 
                                                                "nombre_producto"=>$nombre_producto, 
                                                                "nombre_propietario"=>$nombre_propietario, 
                                                                "und_venta"=>$und_venta, 
                                                                "precio_compra_producto"=>$precio_compra_producto, 
                                                                "total_compra_producto"=>$total_compra_producto, 
                                                                "precio_venta_producto"=>$precio_venta_producto, 
                                                                "total_venta_producto"=>$total_venta_producto, 
                                                                "total_ganancia_venta"=>$total_ganancia_venta, 
                                                                "porcentaje_ganancia_venta"=>$porcentaje_ganancia_venta, 
                                                                "cuenta"=>$cuenta, 
                                                                "fecha_ymd_venta_producto"=>$fecha_ymd_venta_producto, 
                                                                "fecha_hora_venta_producto"=>$fecha_hora_venta_producto, 
                                                                "nombre_tipo_pago"=>$nombre_tipo_pago, 
                                                                "nombre_tipo_forma_pago"=>$nombre_tipo_forma_pago, 
                                                                "nombre_dependencia"=>$nombre_dependencia, 
                                                                "comision_ptj"=>$comision_ptj, 
                                                                "total_comision"=>$total_comision, 
                                                                "und_producto"=>$und_producto, 
                                                                "nombre_tipo_compra"=>$nombre_tipo_compra, 
                                                                "nombre_tipo_metodo_envio"=>$nombre_tipo_metodo_envio, 
                                                                "nombre_tipo_producto"=>$nombre_tipo_producto, 
                                                                "fecha_seg_venta_producto"=>$fecha_seg_venta_producto, 
                                                                "cod_info_factura_venta"=>$cod_info_factura_venta
                                                            );
    $contador_array_venta ++;
}



$sql_cliente = "SELECT tbl15_venta_producto_archivado.cod_venta_producto, tbl15_venta_producto_archivado.cod_producto, tbl15_venta_producto_archivado.cod_producto_barra, 
tbl15_venta_producto_archivado.cod_info_factura_venta, tbl15_venta_producto_archivado.cod_factura, tbl15_venta_producto_archivado.cod_historia_clinica, tbl15_venta_producto_archivado.nombre_producto, 
tbl15_venta_producto_archivado.und_venta, tbl15_venta_producto_archivado.precio_compra_producto, tbl15_venta_producto_archivado.precio_costo_producto, tbl15_venta_producto_archivado.total_compra_producto, 
tbl15_venta_producto_archivado.precio_venta_producto, 
tbl15_venta_producto_archivado.total_venta_producto, tbl15_venta_producto_archivado.nombre_tipo_producto, tbl15_venta_producto_archivado.nombre_tipo_unidad_medida, 
tbl15_venta_producto_archivado.nombre_tipo_presentacion, tbl15_venta_producto_archivado.nombre_via_administracion, tbl15_venta_producto_archivado.nombre_frec_duracion, 
tbl15_venta_producto_archivado.fecha_ymd_venta_producto, tbl15_venta_producto_archivado.fecha_hora_venta_producto, tbl15_venta_producto_archivado.cod_administrador,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_venta_producto_archivado.cuenta, tbl15_venta_producto_archivado.cod_tipo_cobrar, tbl15_venta_producto_archivado.comision_ptj, tbl15_venta_producto_archivado.cod_tipo_pago, 
tbl15_venta_producto_archivado.cod_tipo_forma_pago, tbl15_venta_producto_archivado.cod_dependencia, tbl15_venta_producto_archivado.nombre_tipo_factura, tbl15_venta_producto_archivado.und_producto, 
tbl15_venta_producto_archivado.nombre_tipo_compra, tbl15_venta_producto_archivado.cod_tipo_metodo_envio, tbl15_venta_producto_archivado.nombre_tipo_cobro, tbl15_venta_producto_archivado.fecha_seg_venta_producto
FROM tbl15_tercero RIGHT JOIN tbl15_venta_producto_archivado ON tbl15_tercero.cod_tercero = tbl15_venta_producto_archivado.cod_tercero 
WHERE (tbl15_venta_producto_archivado.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor_archivado_rel $filtro_consulta_tercero_archivado_rel $filtro_consulta_tipo_pago_archivado_rel $filtro_consulta_tipo_forma_pago_archivado_rel 
$filtro_consulta_dependencia_archivado_rel $filtro_consulta_nombre_tipo_factura_archivado_rel $filtro_consulta_nombre_tipo_compra_archivado_rel $filtro_consulta_tipo_metodo_envio_archivado_rel
ORDER BY tbl15_venta_producto_archivado.cod_venta_producto DESC";
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
    $cod_dependencia               = $info_cliente['cod_dependencia'];
    $nombre_tipo_factura           = $info_cliente['nombre_tipo_factura'];
    $nombre_tipo_compra            = $info_cliente['nombre_tipo_compra'];
    $und_producto                  = $info_cliente['und_producto'];
    $cod_tipo_metodo_envio         = $info_cliente['cod_tipo_metodo_envio'];
    $nombre_tipo_cobro             = $info_cliente['nombre_tipo_cobro'];
    $fecha_seg_venta_producto      = $info_cliente['fecha_seg_venta_producto'];

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

    if ($total_compra_producto == '0') { $total_compra_producto = 1; } else { $total_compra_producto = $info_cliente['total_compra_producto']; }
    if ($total_venta_producto == '0') { $total_venta_producto = 1; } else { $total_venta_producto = $info_cliente['total_venta_producto']; }

    $total_ganancia_venta          = ($total_venta_producto - $total_compra_producto);
    $total_comision                = ($total_venta_producto * ($comision_ptj/100));
    $total_ganancia_venta_sum     += $total_ganancia_venta;

    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $porcentaje_ganancia_venta = (($total_ganancia_venta / $total_compra_producto) * 100); } else { $porcentaje_ganancia_venta = (($total_ganancia_venta / $total_venta_producto) * 100); }

    $tipo_operacion                                     = "ARCHIVADA";
    $id_operacion                                       = $cod_venta_producto;
    $datos_vectores_venta[$contador_array_venta]                    = array("id_operacion"=>$id_operacion, 
                                                                "tipo_operacion"=>$tipo_operacion, 
                                                                "cod_venta_producto"=>$cod_venta_producto, 
                                                                "nombre_tipo_factura"=>$nombre_tipo_factura, 
                                                                "cod_factura"=>$cod_factura, 
                                                                "cod_producto_barra"=>$cod_producto_barra, 
                                                                "nombre_producto"=>$nombre_producto, 
                                                                "nombre_propietario"=>$nombre_propietario, 
                                                                "und_venta"=>$und_venta, 
                                                                "precio_compra_producto"=>$precio_compra_producto, 
                                                                "total_compra_producto"=>$total_compra_producto, 
                                                                "precio_venta_producto"=>$precio_venta_producto, 
                                                                "total_venta_producto"=>$total_venta_producto, 
                                                                "total_ganancia_venta"=>$total_ganancia_venta, 
                                                                "porcentaje_ganancia_venta"=>$porcentaje_ganancia_venta, 
                                                                "cuenta"=>$cuenta, 
                                                                "fecha_ymd_venta_producto"=>$fecha_ymd_venta_producto, 
                                                                "fecha_hora_venta_producto"=>$fecha_hora_venta_producto, 
                                                                "nombre_tipo_pago"=>$nombre_tipo_pago, 
                                                                "nombre_tipo_forma_pago"=>$nombre_tipo_forma_pago, 
                                                                "nombre_dependencia"=>$nombre_dependencia, 
                                                                "comision_ptj"=>$comision_ptj, 
                                                                "total_comision"=>$total_comision, 
                                                                "und_producto"=>$und_producto, 
                                                                "nombre_tipo_compra"=>$nombre_tipo_compra, 
                                                                "nombre_tipo_metodo_envio"=>$nombre_tipo_metodo_envio, 
                                                                "nombre_tipo_producto"=>$nombre_tipo_producto, 
                                                                "fecha_seg_venta_producto"=>$fecha_seg_venta_producto, 
                                                                "cod_info_factura_venta"=>$cod_info_factura_venta
                                                            );
    $contador_array_venta ++;
}
$total_reg_normal = count($datos_vectores_venta);
?>


<?php if ($total_reg_normal <> '0') { ?>
<table class="table table-striped">
<tr>
<td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS GENERALES</strong></a></td>
</tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Origen</th>
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
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Vendedor</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Fecha</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Hora</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo Pago</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Forma Pago</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Dependencia</th>
        <?php if ($cod_estado_ptj_comision_global == '1') { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">% Comision</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">$ Comision</th>
        <?php } ?>
        <?php if ($cod_seguridad==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Inv</th><?php } ?>
        <?php if ($cod_estado_tipo_compra_global == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo Compra</th><?php } ?>
        <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Metodo Envio</th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">IdKey</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">IdForeG</th>
    </tr>
</thead>
<tbody>
  <?php
  foreach ($datos_vectores_venta as $key => $fecha_operacion_seg) {
      $datos_fecha_para_ordenar_venta[$key] = $fecha_operacion_seg['fecha_seg_venta_producto'];
  }

  array_multisort($datos_fecha_para_ordenar_venta, SORT_DESC, $datos_vectores_venta);
  foreach ($datos_vectores_venta as $clave=>$value) {

     $id_operacion                                      = $value['id_operacion'];
     $tipo_operacion                                    = $value['tipo_operacion'];
     $cod_venta_producto                                = $value['cod_venta_producto'];
     $nombre_tipo_factura                               = $value['nombre_tipo_factura'];
     $cod_factura                                       = $value['cod_factura'];
     $cod_producto_barra                                = $value['cod_producto_barra'];
     $nombre_producto                                   = $value['nombre_producto'];
     $nombre_propietario                                = $value['nombre_propietario'];
     $und_venta                                         = $value['und_venta'];
     $precio_compra_producto                            = $value['precio_compra_producto'];
     $total_compra_producto                             = $value['total_compra_producto'];
     $precio_venta_producto                             = $value['precio_venta_producto'];
     $total_venta_producto                              = $value['total_venta_producto'];
     $total_ganancia_venta                              = $value['total_ganancia_venta'];
     $porcentaje_ganancia_venta                         = $value['porcentaje_ganancia_venta'];
     $cuenta                                            = $value['cuenta'];
     $fecha_ymd_venta_producto                          = $value['fecha_ymd_venta_producto'];
     $fecha_hora_venta_producto                         = $value['fecha_hora_venta_producto'];
     $nombre_tipo_pago                                  = $value['nombre_tipo_pago'];
     $nombre_tipo_forma_pago                            = $value['nombre_tipo_forma_pago'];
     $nombre_dependencia                                = $value['nombre_dependencia'];
     $comision_ptj                                      = $value['comision_ptj'];
     $total_comision                                    = $value['total_comision'];
     $und_producto                                      = $value['und_producto'];
     $nombre_tipo_compra                                = $value['nombre_tipo_compra'];
     $nombre_tipo_metodo_envio                          = $value['nombre_tipo_metodo_envio'];
     $nombre_tipo_producto                              = $value['nombre_tipo_producto'];
     $fecha_seg_venta_producto                          = $value['fecha_seg_venta_producto'];
     $cod_info_factura_venta                            = $value['cod_info_factura_venta'];
     $total_total_venta_producto                       += $total_venta_producto;

    $total_ganancia_venta                              = ($total_venta_producto - $total_compra_producto);
    $total_comision                                    = ($total_venta_producto * ($comision_ptj/100));
    $total_ganancia_venta_sum                         += $total_ganancia_venta;
    ?>
    <tr>
        <td style="text-align:center"><?php echo $tipo_operacion?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_factura?></td>
        <td style="text-align:center"><?php echo $cod_factura?></td>
        <td style="text-align:left"><?php echo $cod_producto_barra?></td>
        <td style="text-align:left"><?php echo $nombre_producto?></td>
        <td style="text-align:left"><?php echo $nombre_propietario?></td>
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
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_suma_venta_producto, 0, ",", ".")?></th>
        <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><p class="text-success"><?php echo number_format($total_ganancia, 0, ",", ".")?></p></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <?php } ?>
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

<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_ventasporfacturas==1) { ?>

    <?php
    $sql_total_tipo_factura_normal = "SELECT * FROM tbl15_info_factura_venta 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura 
    AND (nombre_estado_factura = 'CERRADA') ORDER BY cod_info_factura_venta ASC";
    $consulta_total_tipo_factura_normal = mysqli_query($conectar, $sql_total_tipo_factura_normal) or die(mysqli_error($conectar));
    while ($datos_total_tipo_factura_normal = mysqli_fetch_assoc($consulta_total_tipo_factura_normal)) {

        $cod_info_factura_venta        = $datos_total_tipo_factura_normal['cod_info_factura_venta'];
        $cod_factura                   = $datos_total_tipo_factura_normal['cod_factura'];
        $cod_tercero                   = $datos_total_tipo_factura_normal['cod_tercero'];
        $vlr_cancelado                 = $datos_total_tipo_factura_normal['vlr_cancelado'];
        $vlr_vuelto                    = $datos_total_tipo_factura_normal['vlr_vuelto'];
        $fecha_anyo                    = $datos_total_tipo_factura_normal['fecha_anyo'];
        $fecha_hora                    = $datos_total_tipo_factura_normal['fecha_hora'];
        $cod_tipo_pago                 = $datos_total_tipo_factura_normal['cod_tipo_pago'];
        $cod_administrador             = $datos_total_tipo_factura_normal['cod_administrador'];
        $total_precio_compra           = $datos_total_tipo_factura_normal['total_precio_compra'];
        $total_precio_venta            = $datos_total_tipo_factura_normal['total_precio_venta'];
        $cod_dependencia               = $datos_total_tipo_factura_normal['cod_dependencia'];
        $cod_tipo_forma_pago           = $datos_total_tipo_factura_normal['cod_tipo_forma_pago'];
        $nombre_tipo_factura           = $datos_total_tipo_factura_normal['nombre_tipo_factura'];
        $nombre_tipo_moneda            = $datos_total_tipo_factura_normal['nombre_tipo_moneda'];
        $total_datos_data              = $datos_total_tipo_factura_normal['total_datos_data'];
        $fecha_ymdhis                  = $datos_total_tipo_factura_normal['fecha_ymdhis'];
        $fecha_ymdhis_seg              = strtotime($fecha_ymdhis);

        $sql_dependencia = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
        $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
        $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

        $nombre_tercero                = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['apellido1_tercero'];

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

        $tipo_operacion                                     = "NORMAL";
        $id_operacion                                       = $cod_venta_producto;
        $datos_vectores_info_venta[$contador_array_info_venta]         = array("id_operacion"=>$id_operacion, 
                                                                    "tipo_operacion"=>$tipo_operacion, 
                                                                    "cod_info_factura_venta"=>$cod_info_factura_venta, 
                                                                    "nombre_tipo_factura"=>$nombre_tipo_factura, 
                                                                    "cod_factura"=>$cod_factura, 
                                                                    "nombre_tercero"=>$nombre_tercero, 
                                                                    "total_precio_venta"=>$total_precio_venta, 
                                                                    "vlr_cancelado"=>$vlr_cancelado, 
                                                                    "fecha_anyo"=>$fecha_anyo, 
                                                                    "fecha_hora"=>$fecha_hora, 
                                                                    "cuenta"=>$cuenta, 
                                                                    "nombre_tipo_pago"=>$nombre_tipo_pago, 
                                                                    "nombre_tipo_forma_pago"=>$nombre_tipo_forma_pago,
                                                                    "fecha_ymdhis_seg"=>$fecha_ymdhis_seg
                                                                );
        $contador_array_info_venta ++;
    }
    $total_reg_normal = count($datos_vectores_info_venta);


    $sql_total_tipo_factura_archivada = "SELECT * FROM tbl15_info_factura_venta_archivado 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
    $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura 
    AND (nombre_estado_factura = 'CERRADA') ORDER BY cod_info_factura_venta ASC";
    $consulta_total_tipo_factura_archivada = mysqli_query($conectar, $sql_total_tipo_factura_archivada) or die(mysqli_error($conectar));
    while ($datos_total_tipo_factura_archivada = mysqli_fetch_assoc($consulta_total_tipo_factura_archivada)) {

        $cod_info_factura_venta        = $datos_total_tipo_factura_archivada['cod_info_factura_venta'];
        $cod_factura                   = $datos_total_tipo_factura_archivada['cod_factura'];
        $cod_tercero                   = $datos_total_tipo_factura_archivada['cod_tercero'];
        $vlr_cancelado                 = $datos_total_tipo_factura_archivada['vlr_cancelado'];
        $vlr_vuelto                    = $datos_total_tipo_factura_archivada['vlr_vuelto'];
        $fecha_anyo                    = $datos_total_tipo_factura_archivada['fecha_anyo'];
        $fecha_hora                    = $datos_total_tipo_factura_archivada['fecha_hora'];
        $cod_tipo_pago                 = $datos_total_tipo_factura_archivada['cod_tipo_pago'];
        $cod_administrador             = $datos_total_tipo_factura_archivada['cod_administrador'];
        $total_precio_compra           = $datos_total_tipo_factura_archivada['total_precio_compra'];
        $total_precio_venta            = $datos_total_tipo_factura_archivada['total_precio_venta'];
        $cod_dependencia               = $datos_total_tipo_factura_archivada['cod_dependencia'];
        $cod_tipo_forma_pago           = $datos_total_tipo_factura_archivada['cod_tipo_forma_pago'];
        $nombre_tipo_factura           = $datos_total_tipo_factura_archivada['nombre_tipo_factura'];
        $nombre_tipo_moneda            = $datos_total_tipo_factura_archivada['nombre_tipo_moneda'];
        $total_datos_data              = $datos_total_tipo_factura_archivada['total_datos_data'];
        $fecha_ymdhis                  = $datos_total_tipo_factura_normal['fecha_ymdhis'];
        $fecha_ymdhis_seg              = strtotime($fecha_ymdhis);

        $sql_dependencia = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
        $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
        $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

        $nombre_tercero                = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['apellido1_tercero'];

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

        $tipo_operacion                                     = "ARCHIVADA";
        $id_operacion                                       = $cod_info_factura_venta;
        $datos_vectores_info_venta[$contador_array_info_venta] = array("id_operacion"=>$id_operacion, 
                                                                    "tipo_operacion"=>$tipo_operacion, 
                                                                    "cod_info_factura_venta"=>$cod_info_factura_venta, 
                                                                    "nombre_tipo_factura"=>$nombre_tipo_factura, 
                                                                    "cod_factura"=>$cod_factura, 
                                                                    "nombre_tercero"=>$nombre_tercero, 
                                                                    "total_precio_venta"=>$total_precio_venta, 
                                                                    "vlr_cancelado"=>$vlr_cancelado, 
                                                                    "fecha_anyo"=>$fecha_anyo, 
                                                                    "fecha_hora"=>$fecha_hora, 
                                                                    "cuenta"=>$cuenta, 
                                                                    "nombre_tipo_pago"=>$nombre_tipo_pago, 
                                                                    "nombre_tipo_forma_pago"=>$nombre_tipo_forma_pago,
                                                                    "fecha_ymdhis_seg"=>$fecha_ymdhis_seg
                                                                );
        $contador_array_info_venta ++;
    }
    $total_reg_normal = count($datos_vectores_info_venta);
?>

    <table class="table table-striped">
    <tr>
    <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS POR FACTURA</strong></a></td>
    </tr>
    </table>

    <table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Origen</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tipo Factura</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Factura</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tercero</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Venta</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Recibido</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Fecha</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Hora</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Vendedor</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Tipo Pago</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Forma Pago</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">ID</a></th>
        </tr>
    </thead>
    <tbody>
    <?php
      foreach ($datos_vectores_info_venta as $key => $fecha_operacion_seg) {
          $datos_fecha_para_ordenar_info_venta[$key] = $fecha_operacion_seg['fecha_ymdhis_seg'];
      }

      array_multisort($datos_fecha_para_ordenar_info_venta, SORT_DESC, $datos_vectores_info_venta);
      foreach ($datos_vectores_info_venta as $clave=>$value) {

         $id_operacion                                      = $value['id_operacion'];
         $tipo_operacion                                    = $value['tipo_operacion'];
         $cod_info_factura_venta                            = $value['cod_info_factura_venta'];
         $nombre_tipo_factura                               = $value['nombre_tipo_factura'];
         $cod_factura                                       = $value['cod_factura'];
         $nombre_tercero                                    = $value['nombre_tercero'];
         $total_precio_venta                                = $value['total_precio_venta'];
         $vlr_cancelado                                     = $value['vlr_cancelado'];
         $fecha_anyo                                        = $value['fecha_anyo'];
         $fecha_hora                                        = $value['fecha_hora'];
         $cuenta                                            = $value['cuenta'];
         $nombre_tipo_pago                                  = $value['nombre_tipo_pago'];
         $nombre_tipo_forma_pago                            = $value['nombre_tipo_forma_pago'];
         $fecha_ymdhis_seg                                  = $value['fecha_ymdhis_seg'];
    ?>
        <tr>
            <td style="text-align:center"><?php echo ($tipo_operacion)?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_factura?></td>
            <td style="text-align:center"><?php echo ($cod_factura)?></td>
            <td style="text-align:left"><?php echo $nombre_tercero?></td>
            <td style="text-align:right"><?php echo number_format($total_precio_venta, 0, ",", ".")?></td>
            <td style="text-align:right"><?php echo number_format($vlr_cancelado, 0, ",", ".")?></td>
            <td style="text-align:center"><?php echo $fecha_anyo?></td>
            <td style="text-align:center"><?php echo $fecha_hora?></td>
            <td style="text-align:center"><?php echo $cuenta?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_pago?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
            <td style="text-align:center"><?php echo $cod_info_factura_venta?></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php } ?>

<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
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