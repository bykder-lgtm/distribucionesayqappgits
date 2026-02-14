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
<a class="btn btn-primary" href="#"><h6>Reporte Ventas Mesas Por Vendedor</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
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
    <td style="text-align:center;">
        <select name="cod_tercero" id="cod_tercero" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE nombre_tipo_tercero = 'CLIENTE' ORDER BY nombre1_tercero ASC";
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
$total_ganancia_porcentaje       = (($total_ganancia / $total_suma_venta_producto) * 100);
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
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_dependencia";
$consulta_cuenta_credito_abono = mysqli_query($conectar, $sql_total_cuenta_credito_abono) or die(mysqli_error($conectar));
$datos_cuenta_credito_abono = mysqli_fetch_assoc($consulta_cuenta_credito_abono);

$total_cuenta_credito_abonado    = $datos_cuenta_credito_abono['total_cuenta_credito_abonado'];

$total_caja_venta_fisica         = $total_venta_producto_contado_efectivo + $total_cuenta_credito_abonado;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_egreso = "SELECT SUM(costo) AS total_egreso FROM tbl15_egreso 
WHERE (fecha_dmy BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
$consulta_total_egreso = mysqli_query($conectar, $sql_total_egreso) or die(mysqli_error($conectar));
$datos_total_egreso = mysqli_fetch_assoc($consulta_total_egreso);

$total_egreso                      = $datos_total_egreso['total_egreso'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
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

<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_ventasporvendedor==1) { ?>

<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="#"><strong>VENTAS POR <?php echo $nombre_concepto_multi_virtual?>S DE VENDEDORES</strong></a></td>
</tr>
</table>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center"><a href="#">Vendedor</a></th>
<th style="text-align:center"><a href="#">Total Mesas</a></th>
<th style="text-align:center"><a href="#">Mesas</a></th>
<th style="text-align:center"><a href="#">Facturas</a></th>
</tr>
</thead>
<tbody>
<?php
$sql_venta_vendedor_info = "SELECT COUNT(*) AS total_mesas, cod_info_factura_venta, cod_factura, cod_tercero, fecha_anyo, cod_tipo_pago, cod_administrador, cod_tipo_forma_pago, cod_base_caja 
FROM tbl15_info_factura_venta 
WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
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

$concatenar_mesas                = '';
$concatenar_factura              = '';
$contador_mesas                  = 0;

$sql_concat_info = "SELECT cod_base_caja, cod_factura FROM tbl15_info_factura_venta WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_administrador = '$cod_administrador')
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