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
<a class="btn btn-primary" href="../admin/reporte_venta_factura_electronica_fechas_enviar_correo.php"><h6>Reporte Facturas Electronica Enviadas por Correo</h6></a>
<a class="btn btn-secondary" href="../admin/reporte_venta_factura_electronica_fechas.php?cod_administrador=0&cod_tercero=0&cod_dependencia=0&cod_tipo_pago=0&nombre_tipo_compra=0&fecha_ymd_venta_producto_ini=2010-01-01&fecha_ymd_venta_producto_fin=2050-01-01&cod_tipo_forma_pago=0&nombre_tipo_factura=ELECTRONICA"><h6>Reporte Ventas Por Factura Electronica</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local                                = $_SERVER['PHP_SELF'];

$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE (nombre_tipo_resolucion_facturacion = 'NOTA CREDITO')";
$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

$cod_resolucion_facturacion_nota_credito       = $matriz_resol_fact['cod_resolucion_facturacion'];

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
    $cod_administrador_consulta              = $cod_administrador;
    $cod_tipo_pago_consulta                  = $cod_tipo_pago;
    $cod_tipo_forma_pago_consulta            = $cod_tipo_forma_pago;
    $cod_dependencia_consulta                = $cod_dependencia;
    $nombre_tipo_factura_consulta            = $nombre_tipo_factura;
    $nombre_tipo_compra_consulta             = $nombre_tipo_compra;


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
} else {
    $fecha_hora_venta_producto_ini           = '';
    $fecha_hora_venta_producto_fin           = '';
    $condicion_hora_reporte_venta            = '';
    $condicion_hora_reporte_venta_rel        = '';
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
} else {
    $fecha_hora_venta_producto_ini           = '';
    $fecha_hora_venta_producto_fin           = '';
    $condicion_hora_reporte_venta            = '';
    $condicion_hora_reporte_venta_rel        = '';
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
$nombre_tipo_factura                     = 'ELECTRONICA';
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
?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<?php if ($cod_estado_subreporte_ventasporfacturas==1) { ?>

<?php if ($nombre_operador_factura_electronica == 'DATAICO') { ?>
<form method="post" name="formulario" action="../admin/descargar_factura_venta_electronica_dataico_precio_venta_sin_iva_puntoycoma_masivo_csv.php">
<?php } ?>
<?php if ($nombre_operador_factura_electronica == 'MONEYBOX') { ?>
<form method="post" name="formulario" action="../admin/descargar_factura_venta_electronica_moneybox_masivo_xlsx.php">
<?php } ?>

<?php
/*
$sql_total_tipo_factura = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
$datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura);

$cod_info_factura_venta                      = $datos_total_tipo_factura['cod_info_factura_venta'];
*/
?>
<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center"><a href="#"></a></th>
        <?php if ($cod_estado_enviar_factura_venta_electronica_dian_api == '1') { ?>
        <th style="text-align:center;"><a href="#">Enviar Correo</a></th>
        <?php } ?>
        <!--<th style="text-align:center; font-size:13pt;">Consultar</th>-->
        <th style="text-align:center"><a href="#">Factura</a></th>
        <th style="text-align:center"><a href="#">Tercero</a></th>
        <th style="text-align:center"><a href="#">Total Venta</a></th>
        <th style="text-align:center"><a href="#">Total Iva</a></th>
        <th style="text-align:center"><a href="#">Recibido</a></th>
        <th style="text-align:center"><a href="#">Fecha</a></th>
        <th style="text-align:center"><a href="#">Hora</a></th>
        <th style="text-align:center"><a href="#">Vendedor</a></th>
        <th style="text-align:center"><a href="#">Tipo Pago</a></th>
        <th style="text-align:center"><a href="#">Forma Pago</a></th>
        <th style="text-align:center"><a href="#">Tipo Factura</a></th>
        <th style="text-align:center"><a href="#">ID</a></th>
    </tr>
</thead>
<tbody>
<?php
$sql_total_tipo_factura = "SELECT * FROM tbl15_info_factura_venta 
WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura 
AND (nombre_estado_factura = 'CERRADA') ORDER BY cod_factura ASC";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

    $cod_info_factura_venta                          = $datos_total_tipo_factura['cod_info_factura_venta'];
    $cod_resolucion_facturacion                      = $datos_total_tipo_factura['cod_resolucion_facturacion'];
    $cod_factura                                     = $datos_total_tipo_factura['cod_factura'];
    $cod_tercero_db                                  = $datos_total_tipo_factura['cod_tercero'];
    $vlr_cancelado                                   = $datos_total_tipo_factura['vlr_cancelado'];
    $vlr_vuelto                                      = $datos_total_tipo_factura['vlr_vuelto'];
    $fecha_anyo                                      = $datos_total_tipo_factura['fecha_anyo'];
    $fecha_hora                                      = $datos_total_tipo_factura['fecha_hora'];
    $cod_tipo_pago_db                                = $datos_total_tipo_factura['cod_tipo_pago'];
    $cod_administrador_db                            = $datos_total_tipo_factura['cod_administrador'];
    $total_precio_compra                             = $datos_total_tipo_factura['total_precio_compra'];
    $total_precio_venta                              = $datos_total_tipo_factura['total_precio_venta'];
    $cod_dependencia_db                              = $datos_total_tipo_factura['cod_dependencia'];
    $cod_tipo_forma_pago_db                          = $datos_total_tipo_factura['cod_tipo_forma_pago'];
    $nombre_tipo_factura_db                          = $datos_total_tipo_factura['nombre_tipo_factura'];
    $nombre_tipo_moneda                              = $datos_total_tipo_factura['nombre_tipo_moneda'];
    $total_datos_data                                = $datos_total_tipo_factura['total_datos_data'];
    $cod_estado_check_factura_electronica            = $datos_total_tipo_factura['cod_estado_check_factura_electronica'];
    $cod_estado_factura_electronica_enviado_dian     = $datos_total_tipo_factura['cod_estado_factura_electronica_enviado_dian'];
    $cod_estado_factura_electronica_enviado_dataico  = $datos_total_tipo_factura['cod_estado_factura_electronica_enviado_dataico'];
    $nombre_estado_factura_dataico_dian              = $datos_total_tipo_factura['nombre_estado_factura_dataico_dian'];
    $dataico_email_status                            = $datos_total_tipo_factura['dataico_email_status'];

    $mostrar_datos_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
    $consulta_resolucion_facturacion = mysqli_query($conectar, $mostrar_datos_resolucion_facturacion) or die(mysqli_error($conectar));
    $matriz_consulta_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

    $prefijo_resolucion_facturacion                  = $matriz_consulta_resolucion_facturacion['prefijo_resolucion_facturacion'];

    $sql_tercero = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, correo_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_db'";
    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

    $nombre_tercero                = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['nombre2_tercero'].' '.$datos_tercero['apellido1_tercero'].' '.$datos_tercero['apellido2_tercero'].' ('.$datos_tercero['identificacion_tercero'].')';
    $correo_tercero                = $datos_tercero['correo_tercero'];
    $estado_correo_correcto        =  filter_var($correo_tercero, FILTER_VALIDATE_EMAIL);
    if ($estado_correo_correcto) { $correo_tercero = $correo_tercero; } else { $correo_tercero = 'SIN CORREO O MAL ESCRITO'; }

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];

    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago_db'";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago_db'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

    $suma_temporal = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
    Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
    Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
    FROM tbl15_venta_producto 
    WHERE (cod_info_factura_venta= '$cod_info_factura_venta')";
    $consulta_temporal = mysqli_query($conectar, $suma_temporal) or die(mysqli_error($conectar));
    $suma = mysqli_fetch_assoc($consulta_temporal);

    $subtotal_base                       = ($suma['subtotal_base']);
    $total_iva                           = ($suma['total_iva']);

    if ($cod_estado_factura_electronica_enviado_dian == '1') { $imagen_estado_factura_dian = '../imagenes/btn_dian_peq.png'; } else { $imagen_estado_factura_dian = '../imagenes/btn_dian_peq_gris.png'; }
    if ($cod_estado_factura_electronica_enviado_dataico == '1') { $imagen_estado_factura_dataico = '../imagenes/btn_dataico.png'; } else { $imagen_estado_factura_dataico = '../imagenes/btn_dataico_gris.png'; }
?>
    <tr>
        <td style="text-align:center;" id="respuesta<?php echo $cod_info_factura_venta ?>"></td>
        <?php if ($cod_estado_enviar_factura_venta_electronica_dian_api == '1') { ?>
                <td style="text-align:center;" id="apidian<?php echo $cod_info_factura_venta ?>" data="<?php echo $cod_info_factura_venta ?>">
                    <?php if ($estado_correo_correcto) { ?>
                        <a class="EnviarCorreoDianDataico" style="cursor:pointer;"><img src="../imagenes/arroba.png" style="width:40px;" class="img-polaroid" alt=""></a>
                    <?php } else { ?>
                        <a><img src="../imagenes/admiracion.png" style="width:40px;" class="img-polaroid" alt=""></a>
                    <?php } ?>
                    <br><?php echo $dataico_email_status ?><br><?php echo $correo_tercero ?></td>
        <?php } ?>

        <!--<th style="text-align:center;" id="edit<?php echo $cod_info_factura_venta;?>"><a href="../admin/consultar_factura_dian_json.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/btn_dian_grand.png" class="img-polaroid" alt=""></a></th>-->
        <td style="text-align:center"><?php echo ($prefijo_resolucion_facturacion.'|'.$cod_factura)?></td>
        <td style="text-align:left">
            <?php echo $nombre_tercero?>
            <?php if ($cod_estado_tercero_editar == '1') { ?>
                <a href="../admin/edit_tercero.php?cod_tercero=<?php echo $cod_tercero_db?>&cod_tercero_consulta=<?php echo $cod_tercero?>&cod_administrador=<?php echo $cod_administrador_consulta?>&cod_tipo_pago=<?php echo $cod_tipo_pago_consulta?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago_consulta?>&cod_dependencia=<?php echo $cod_dependencia_consulta?>&nombre_tipo_factura=<?php echo $nombre_tipo_factura_consulta?>&nombre_tipo_compra=<?php echo $nombre_tipo_compra_consulta?>&fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/editar.png" style="width:25px;" class="img-polaroid" alt=""></a>
            <?php } ?>
        </td>
        
        <td style="text-align:right"><?php echo number_format($total_precio_venta, 0, ",", ".")?></td>
        <td style="text-align:right"><?php echo number_format($total_iva, 0, ",", ".")?></td>
        <td style="text-align:right"><?php echo number_format($vlr_cancelado, 0, ",", ".")?></td>
        <td style="text-align:center"><?php echo $fecha_anyo?></td>
        <td style="text-align:center"><?php echo $fecha_hora?></td>
        <td style="text-align:center"><?php echo $cuenta?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_pago?></td>

        <td style="text-align:center">
            <select name="cod_tipo_forma_pago" id="<?php echo $cod_info_factura_venta;?>" class="cod_tipo_forma_pago" style="width: 120px;">
            <?php if (isset($cod_tipo_forma_pago_db)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
            $sql_consulta2 = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
            $consulta2 = mysqli_query($conectar, $sql_consulta2);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_forma_pago_db) and $cod_tipo_forma_pago_db == $datos2['cod_tipo_forma_pago']) { $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_forma_pago'];
            $nombre = $datos2['nombre_tipo_forma_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </td>

        <td style="text-align:center"><?php echo $nombre_tipo_factura_db?></td>
        <td style="text-align:center"><?php echo $cod_info_factura_venta?></td>
    </tr>
<?php } ?>
</tbody>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
</form>

<script language="javascript">
$(document).ready(function(){
    $(".cod_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            let id = this.id;
            var campo = "cod_tipo_forma_pago";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<?php if ($cod_estado_enviar_factura_venta_electronica_dian_api == '1' && $nombre_tipo_factura == 'ELECTRONICA') { ?>
<script type="text/javascript">
$(document).ready(function() {

    $('.EnviarCorreoDianDataico').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_info_factura_venta = $(this).parent().attr('data');
        var tab = "tbl15_info_factura_venta";
        var campo = "cod_info_factura_venta";
        var tipo_ajax = "tbl15_info_factura_venta";
        var cod_resolucion_facturacion = "<?php echo $cod_resolucion_facturacion;?>";
        var pagina = "<?php echo $pagina;?>";

        var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;

        $.ajax({
            type: "GET",
            url: "../admin/enviar_correo_factura_venta_dian_json.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
            },
            success:function(respuesta){

                if(respuesta.errors) {
                    var dataico_dian_error = respuesta.errors[0].error;
                    var dataico_dian_path = respuesta.errors[0].path;
                    var error_respuesta = "Error";
                    var imagen_status_error = "../imagenes/error.jpg";
                    var imagen_status_dian = "../imagenes/btn_dian_peq_gris.png";
                    var imagen_status_dataico = "../imagenes/btn_dataico_gris.png";
                    var resultado_envio_dian = "No Enviado a la Dian";
                    var resultado_envio_dataico = "No Enviado a Dataico";
                    var imagen_status = "../imagenes/error.jpg";


                    var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina+'&'+'dataico_dian_error='+dataico_dian_error+'&'+'dataico_dian_path='+dataico_dian_path;
                    $.ajax({
                        type: "POST",
                        url: "../admin/guardar_factura_venta_enviada_error_dian_dataico_json_ajax.php",
                        data: datos_url_ajax,
                        beforeSend: function(objeto){
                            //$('#loader').html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
                        },
                        success:function(respuesta){
                            if (respuesta.dataico_dian_error) { var dataico_dian_error = respuesta.dataico_dian_error; } else { var dataico_dian_error = ''; }
                            if (respuesta.dataico_dian_path) { var dataico_dian_path = respuesta.dataico_dian_path; } else { var dataico_dian_path = ''; }

                            $('#apidian'+cod_info_factura_venta).html("");
                            $('#apidian'+cod_info_factura_venta).html('Error: '+dataico_dian_error+'<br>'+dataico_dian_path);
                        }
                    });
                    //$('#resultado_envio_dian'+cod_info_factura_venta).html("<img src="+imagen_status_dian+" class='img-polaroid'>"+"<br>"+resultado_envio_dian);
                    //$('#resultado_envio_dataico'+cod_info_factura_venta).html("<img src="+imagen_status_dataico+" class='img-polaroid'>"+"<br>"+resultado_envio_dataico);
                    $('#enviando_cargador'+cod_info_factura_venta).html("");
                    $('#resultado_error_envio_dian_dataico'+cod_info_factura_venta).html("<img src="+imagen_status_error+" class='img-polaroid'>"+"<br>"+dataico_dian_error+" ["+dataico_dian_path+"]");
                } else {
                    if (respuesta.number) { var cod_factura_prefijo = respuesta.number; } else { var cod_factura_prefijo = ''; }
                    if (respuesta.numbering.prefix) { var prefijo_resolucion_facturacion = respuesta.numbering.prefix; } else { var prefijo_resolucion_facturacion = ''; }
                    if (respuesta.numbering.resolution_number) { var numero_resolucion_facturacion = respuesta.numbering.resolution_number; } else { var numero_resolucion_facturacion = ''; }
                    if (respuesta.email_status) { var dataico_email_status = respuesta.email_status; } else { var dataico_email_status = ''; }
                    if (respuesta.uuid) { var dataico_uuid = respuesta.uuid; } else { var dataico_uuid = ''; }
                    if (respuesta.cufe) { var cod_cufe = respuesta.cufe; } else { var cod_cufe = ''; }
                    if (respuesta.issue_date) { var dataico_issue_date = respuesta.issue_date; } else { var dataico_issue_date = ''; }
                    if (respuesta.dian_messages) { var dataico_dian_messages = respuesta.dian_messages; } else { var dataico_dian_messages = ''; }
                    if (respuesta.payment_date) { var dataico_payment_date = respuesta.payment_date; } else { var dataico_payment_date = ''; }
                    if (respuesta.customer_status) { var dataico_customer_status = respuesta.customer_status; } else { var dataico_customer_status = ''; }
                    if (respuesta.xml_url) { var dataico_xml_url = respuesta.xml_url; } else { var dataico_xml_url = ''; }
                    if (respuesta.validation_date) { var dataico_validation_date = respuesta.validation_date; } else { var dataico_validation_date = ''; }
                    if (respuesta.qrcode) { var dataico_qrcode = respuesta.qrcode; } else { var dataico_qrcode = ''; }
                    if (respuesta.xml) { var dataico_xml = respuesta.xml; } else { var dataico_xml = ''; }
                    if (respuesta.invoice_type_code) { var dataico_invoice_type_code = respuesta.invoice_type_code; } else { var dataico_invoice_type_code = ''; }
                    if (respuesta.pdf_url) { var dataico_pdf_url = respuesta.pdf_url; } else { var dataico_pdf_url = ''; }
                    if (respuesta.dian_status) { var dataico_dian_status = respuesta.dian_status; } else { var dataico_dian_status = ''; }

                    if (dataico_dian_status == 'DIAN_ACEPTADO') {
                        var cod_estado_factura_electronica_enviado_dian = 1;
                        var cod_estado_factura_electronica_enviado_dataico = 1;
                        var datos_url_ajax = 'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_factura_prefijo='+cod_factura_prefijo+'&'+'prefijo_resolucion_facturacion='+prefijo_resolucion_facturacion+'&'+'numero_resolucion_facturacion='+numero_resolucion_facturacion+'&'+'cod_estado_factura_electronica_enviado_dian='+cod_estado_factura_electronica_enviado_dian+'&'+'cod_estado_factura_electronica_enviado_dataico='+cod_estado_factura_electronica_enviado_dataico+'&'+'dataico_email_status='+dataico_email_status+'&'+'dataico_uuid='+dataico_uuid+'&'+'cod_cufe='+cod_cufe+'&'+'dataico_issue_date='+dataico_issue_date+'&'+'dataico_dian_messages='+dataico_dian_messages+'&'+'dataico_payment_date='+dataico_payment_date+'&'+'dataico_customer_status='+dataico_customer_status+'&'+'dataico_xml_url='+dataico_xml_url+'&'+'dataico_validation_date='+dataico_validation_date+'&'+'dataico_qrcode='+dataico_qrcode+'&'+'dataico_xml='+dataico_xml+'&'+'dataico_invoice_type_code='+dataico_invoice_type_code+'&'+'dataico_pdf_url='+dataico_pdf_url+'&'+'dataico_dian_status='+dataico_dian_status;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                        $.ajax({
                            type: "POST",
                            url: "../admin/guardar_factura_venta_enviada_dian_dataico_json_ajax.php",
                            data: datos_url_ajax,
                            beforeSend: function(objeto){
                                $('#estadodian'+cod_info_factura_venta).html("");
                                $('#estadodataico'+cod_info_factura_venta).html("");
                                $('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
                            },
                            success:function(respuesta){
                                var cod_info_factura_venta = respuesta.cod_info_factura_venta;
                                var cod_estado_factura_electronica_enviado_dian = respuesta.cod_estado_factura_electronica_enviado_dian;
                                var cod_estado_factura_electronica_enviado_dataico = respuesta.cod_estado_factura_electronica_enviado_dataico;
                                var resultado_envio_dian = respuesta.resultado_envio_dian;
                                var resultado_envio_dataico = respuesta.resultado_envio_dataico;
                                var imagen_status_dian = "../imagenes/btn_dian_peq.png";
                                var imagen_status_dataico = "../imagenes/btn_dataico.png";
                            
                                $('#apidian'+cod_info_factura_venta).html(''+dataico_email_status);

                            }
                        });
                    } 
                    if (dataico_dian_status == 'DIAN_NO_ENVIADO') {
                        var cod_estado_factura_electronica_enviado_dian = 0;
                        var cod_estado_factura_electronica_enviado_dataico = 1;
                        var datos_url_ajax = 'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_factura_prefijo='+cod_factura_prefijo+'&'+'prefijo_resolucion_facturacion='+prefijo_resolucion_facturacion+'&'+'numero_resolucion_facturacion='+numero_resolucion_facturacion+'&'+'cod_estado_factura_electronica_enviado_dian='+cod_estado_factura_electronica_enviado_dian+'&'+'cod_estado_factura_electronica_enviado_dataico='+cod_estado_factura_electronica_enviado_dataico+'&'+'dataico_email_status='+dataico_email_status+'&'+'dataico_uuid='+dataico_uuid+'&'+'cod_cufe='+cod_cufe+'&'+'dataico_issue_date='+dataico_issue_date+'&'+'dataico_dian_messages='+dataico_dian_messages+'&'+'dataico_payment_date='+dataico_payment_date+'&'+'dataico_customer_status='+dataico_customer_status+'&'+'dataico_xml_url='+dataico_xml_url+'&'+'dataico_validation_date='+dataico_validation_date+'&'+'dataico_qrcode='+dataico_qrcode+'&'+'dataico_xml='+dataico_xml+'&'+'dataico_invoice_type_code='+dataico_invoice_type_code+'&'+'dataico_pdf_url='+dataico_pdf_url+'&'+'dataico_dian_status='+dataico_dian_status;
                        
                        $.ajax({
                            type: "POST",
                            url: "../admin/guardar_factura_venta_enviada_dataico_json_ajax.php",
                            data: datos_url_ajax,
                            beforeSend: function(objeto){
                                $('#estadodian'+cod_info_factura_venta).html("");
                                $('#estadodataico'+cod_info_factura_venta).html("");
                                $('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
                            },
                            success:function(respuesta){
                                var cod_info_factura_venta = respuesta.cod_info_factura_venta;
                                var cod_estado_factura_electronica_enviado_dian = respuesta.cod_estado_factura_electronica_enviado_dian;
                                var cod_estado_factura_electronica_enviado_dataico = respuesta.cod_estado_factura_electronica_enviado_dataico;
                                var resultado_envio_dian = respuesta.resultado_envio_dian;
                                var resultado_envio_dataico = respuesta.resultado_envio_dataico;
                                var imagen_status_dian = "../imagenes/btn_dian_peq_gris.png";
                                var imagen_status_dataico = "../imagenes/btn_dataico.png";
                                var longitud_cod_cufe = cod_cufe.length;
                                var mitad_longitud_cod_cufe = longitud_cod_cufe / 2;
                                var cod_cufe_parte1 = cod_cufe.substr(0, mitad_longitud_cod_cufe);
                                var cod_cufe_parte2 = cod_cufe.substr(mitad_longitud_cod_cufe + 1, longitud_cod_cufe);
                                var imagen_status_dataico = "../imagenes/btn_dataico.png";

                                $('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/arroba.png" style="width:40px;" class="img-polaroid" alt="">');

                            }
                        });
                    } 
                    if (dataico_dian_status == 'DIAN_RECHAZADO') {
                        var cod_estado_factura_electronica_enviado_dian = 0;
                        var cod_estado_factura_electronica_enviado_dataico = 0;
                        var datos_url_ajax = 'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_factura_prefijo='+cod_factura_prefijo+'&'+'prefijo_resolucion_facturacion='+prefijo_resolucion_facturacion+'&'+'numero_resolucion_facturacion='+numero_resolucion_facturacion+'&'+'cod_estado_factura_electronica_enviado_dian='+cod_estado_factura_electronica_enviado_dian+'&'+'cod_estado_factura_electronica_enviado_dataico='+cod_estado_factura_electronica_enviado_dataico+'&'+'dataico_email_status='+dataico_email_status+'&'+'dataico_uuid='+dataico_uuid+'&'+'cod_cufe='+cod_cufe+'&'+'dataico_issue_date='+dataico_issue_date+'&'+'dataico_dian_messages='+dataico_dian_messages+'&'+'dataico_payment_date='+dataico_payment_date+'&'+'dataico_customer_status='+dataico_customer_status+'&'+'dataico_xml_url='+dataico_xml_url+'&'+'dataico_validation_date='+dataico_validation_date+'&'+'dataico_qrcode='+dataico_qrcode+'&'+'dataico_xml='+dataico_xml+'&'+'dataico_invoice_type_code='+dataico_invoice_type_code+'&'+'dataico_pdf_url='+dataico_pdf_url+'&'+'dataico_dian_status='+dataico_dian_status;

                        var dataico_dian_messages = respuesta.dian_messages;

                        $('#apidian'+cod_info_factura_venta).html("");
                        $('#apidian'+cod_info_factura_venta).html(dataico_dian_messages);
/*
                        $.ajax({
                            type: "POST",
                            url: "../admin/guardar_factura_venta_enviada_dian_dataico_json_ajax.php",
                            data: datos_url_ajax,
                            beforeSend: function(objeto){
                                $('#estadodian'+cod_info_factura_venta).html("");
                                $('#estadodataico'+cod_info_factura_venta).html("");
                                $('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
                            },
                            success:function(respuesta){
                                var cod_info_factura_venta = respuesta.cod_info_factura_venta;
                                var cod_estado_factura_electronica_enviado_dian = respuesta.cod_estado_factura_electronica_enviado_dian;
                                var cod_estado_factura_electronica_enviado_dataico = respuesta.cod_estado_factura_electronica_enviado_dataico;
                                var resultado_envio_dian = respuesta.resultado_envio_dian;
                                var resultado_envio_dataico = respuesta.resultado_envio_dataico;
                                var imagen_status_dian = "../imagenes/btn_dian_peq.png";
                                var imagen_status_dataico = "../imagenes/btn_dataico.png";
                            }
                        });
*/
                    }
                }
            }
        });
    });
});
</script>
<?php } ?>

<script language="javascript">
    $("input").on('change', function () {
    var valor = $(this).val();
    var campo = $(this).attr("name");
    var id = $(this).attr("id");

    var fecha_ymd_venta_producto_ini = '<?php echo $fecha_ymd_venta_producto_ini;?>';
    var fecha_ymd_venta_producto_fin = '<?php echo $fecha_ymd_venta_producto_fin;?>';
    var cod_administrador = '<?php echo $cod_administrador;?>';
    var cod_tercero = '<?php echo $cod_tercero;?>';
    var cod_tipo_pago = '<?php echo $cod_tipo_pago;?>';
    var cod_tipo_forma_pago = '<?php echo $cod_tipo_forma_pago;?>';
    var cod_dependencia = '<?php echo $cod_dependencia;?>';
    var nombre_tipo_factura = '<?php echo $nombre_tipo_factura;?>';
    var nombre_tipo_compra = '<?php echo $nombre_tipo_compra;?>';

    let framentador = id.split('__');
    var ids = framentador[1];
    var cod_estado_check_factura_electronica = valor;
    var tab = "tbl15_info_factura_venta";

    let vector_id_factura = [];

    $("input:checkbox:checked").each(function() {
        vector_id_factura.push($(this).val());
    });

    var datos_url_ajax = 'valor='+vector_id_factura+'&'+'campo='+campo+'&'+'tab='+tab+'&'+'id='+id+'&'+'fecha_ymd_venta_producto_ini='+fecha_ymd_venta_producto_ini+'&'+'fecha_ymd_venta_producto_fin='+fecha_ymd_venta_producto_fin+'&'+'cod_administrador='+cod_administrador+'&'+'cod_tercero='+cod_tercero+'&'+'cod_tipo_pago='+cod_tipo_pago+'&'+'cod_tipo_forma_pago='+cod_tipo_forma_pago+'&'+'cod_dependencia='+cod_dependencia+'&'+'nombre_tipo_factura='+nombre_tipo_factura+'&'+'nombre_tipo_compra='+nombre_tipo_compra;

    $.ajax({
        type: "POST",
        url: "../admin/calcular_total_venta_total_iva_factura_electronica_ajax.php",
        data: datos_url_ajax,
        //dataType: 'json',
        success:function(respuesta){ 
            var total_venta = respuesta.total_venta;
            var total_base_iva = respuesta.total_base_iva;
            var total_iva = respuesta.total_iva;
            var mensaje = respuesta.mensaje;
            var total_reg = respuesta.total_reg;

            $('#total_venta').html(total_venta);
            $('#total_base_iva').html(total_base_iva);
            $('#total_iva').html(total_iva);
            $('#total_reg').html(total_reg);
        }
    });
});
</script>
<?php } ?>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->

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