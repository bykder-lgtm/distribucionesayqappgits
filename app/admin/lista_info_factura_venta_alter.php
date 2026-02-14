<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="js/json2.min.js"></script>

<link rel="stylesheet" href="../estilo_css/chosen_250px.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

<script>
    $(document).ready(function(){
        $("#cod_tercero").chosen();
   });
</script>
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
<a class="btn btn-primary" href="#"><h6>Lista Facturas</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$seleccionado = 1;

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
    $cod_tercero                             = intval($_GET['cod_tercero']);
    $cod_tipo_pago                           = intval($_GET['cod_tipo_pago']);
    $cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
    $cod_factura                             = intval($_GET['cod_factura']);
    $nombre_tipo_factura                     = addslashes($_GET['nombre_tipo_factura']);
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

    if ($cod_tercero==0) { $filtro_consulta_tercero = ""; $filtro_consulta_tercero_rel = ""; } else { $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')"; $filtro_consulta_tercero_rel = "AND (tbl15_venta_producto.cod_tercero = '$cod_tercero')"; }
    if ($cod_tipo_pago==0) { $filtro_consulta_tipo_pago = ""; $filtro_consulta_tipo_pago_rel = ""; } else { $filtro_consulta_tipo_pago = "AND (cod_tipo_pago = '$cod_tipo_pago')"; $filtro_consulta_tipo_pago_rel = "AND (tbl15_venta_producto.cod_tipo_pago = '$cod_tipo_pago')"; }
    if ($cod_tipo_forma_pago==0) { $filtro_consulta_tipo_forma_pago = ""; $filtro_consulta_tipo_forma_pago_rel = ""; } else { $filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')"; $filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_venta_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')"; }
    if ($cod_factura=='0' || $cod_factura=='') { $filtro_consulta_cod_factura = ""; $filtro_consulta_cod_factura_rel = ""; $fecha_ymd_venta_producto_ini = addslashes($_GET['fecha_ymd_venta_producto_ini']); } else { $filtro_consulta_cod_factura = "AND (cod_factura = '$cod_factura')"; $filtro_consulta_cod_factura_rel = "AND (tbl15_venta_producto.cod_factura = '$cod_factura')"; $fecha_ymd_venta_producto_ini = "2010-01-01"; }
    if ($nombre_tipo_factura=='0') { $filtro_consulta_nombre_tipo_factura = ""; $filtro_consulta_nombre_tipo_factura_rel = ""; } else { $filtro_consulta_nombre_tipo_factura = "AND (nombre_tipo_factura = '$nombre_tipo_factura')"; $filtro_consulta_nombre_tipo_factura_rel = "AND (tbl15_venta_producto.nombre_tipo_factura = '$nombre_tipo_factura')"; }

} else {
    $fecha_ymd_venta_producto_ini            = date("Y-m-d");
    $fecha_ymd_venta_producto_fin            = date("Y-m-d");
    $cod_administrador                       = 0;
    $cod_tercero                             = 0;
    $cod_tipo_pago                           = 0;
    $cod_tipo_forma_pago                     = 0;
    $cod_factura                             = "";
    $nombre_tipo_factura                     = "0";
    $fecha                                   = date("Y-m-d");

    if ($cod_administrador==0) { $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')"; $filtro_consulta_vendedor_rel = "AND (cod_administrador = '$cod_administrador')"; } else { $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')"; $filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')"; }
    if ($cod_estado_facturacion_venta_acceso_facturas_otros_user=='1') { $filtro_consulta_vendedor = ""; $filtro_consulta_vendedor_rel = ""; } else { $filtro_consulta_vendedor = ""; $filtro_consulta_vendedor_rel = ""; }
    if ($cod_tercero==0) { $filtro_consulta_tercero = ""; $filtro_consulta_tercero_rel = ""; } else { $filtro_consulta_tercero = ""; $filtro_consulta_tercero_rel = ""; }
    if ($cod_tipo_pago==0) { $filtro_consulta_tipo_pago = ""; $filtro_consulta_tipo_pago_rel = ""; } else { $filtro_consulta_tipo_pago = ""; $filtro_consulta_tipo_pago_rel = ""; }
    if ($cod_tipo_forma_pago==0) { $filtro_consulta_tipo_forma_pago = ""; $filtro_consulta_tipo_forma_pago_rel = ""; } else { $filtro_consulta_tipo_forma_pago = ""; $filtro_consulta_tipo_forma_pago_rel = ""; }
    if ($cod_factura=='0' || $cod_factura=='') { $filtro_consulta_cod_factura = ""; $filtro_consulta_cod_factura_rel = ""; } else { $filtro_consulta_cod_factura = ""; $filtro_consulta_cod_factura_rel = ""; }
    if ($nombre_tipo_factura=='0') { $filtro_consulta_nombre_tipo_factura = ""; $filtro_consulta_nombre_tipo_factura_rel = ""; } else { $filtro_consulta_nombre_tipo_factura = ""; $filtro_consulta_nombre_tipo_factura_rel = ""; }
}

if ($cod_administrador==0) { 

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

if ($cod_factura=='0') {
    $nombre_dependencia_get                             = 'TODOS';
} else {
    $nombre_dependencia_get                             = $cod_factura;
}

if ($nombre_tipo_factura=='0') {
    $nombre_tipo_factura_get                            = 'TODOS';
} else {
    $sql_tipo_factura  = "SELECT nombre_tipo_factura FROM tbl15_tipo_factura WHERE nombre_tipo_factura = '$nombre_tipo_factura'";
    $consulta_tipo_factura  = mysqli_query($conectar, $sql_tipo_factura ) or die(mysqli_error($conectar));
    $datos_tipo_factura  = mysqli_fetch_assoc($consulta_tipo_factura );

    $nombre_tipo_factura_get                            = $datos_tipo_factura['nombre_tipo_factura'];
}

$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_informe_condiciones_salud';
$tipo                        = 'eliminar';
$campo                       = 'cod_informe_condiciones_salud';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><font size='+2'>Lista Facturas de Venta</font></a></th>
        <th style="text-align:right"><a href="../admin/buscar_por_cod_factura_venta.php"><font size='+2'>Buscar Por Factura</font></a></th>
        <th style="text-align:right"><a href="../admin/facturacion_venta_temporal_producto_manual_pos.php"><font size='+2'>Facturar Venta</font></a></th>
    </tr>
</table>

<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
    <tr>
        <th style="text-align:center;">FACTURA</th>
        <th style="text-align:center;">VENDEDOR</th>
        <th style="text-align:center;">TERCERO</th>
        <th style="text-align:center;">TIPO PAGO</th>
    </tr>
    <tr>
        <td style="text-align:center;"><input type="text" id="cod_factura" name="cod_factura" autofocus/></td>

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
            <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
                <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
                $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero FROM tbl15_tercero WHERE (nombre_tipo_tercero='CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
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
                <?php if (isset($cod_tipo_forma_pago)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
                $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago ORDER BY cod_tipo_forma_pago ASC";
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
            <select name="nombre_tipo_factura" id="nombre_tipo_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
                <?php if (isset($nombre_tipo_factura)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
                $consulta2_sql = "SELECT nombre_tipo_factura FROM tbl15_tipo_factura ORDER BY nombre_tipo_factura ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_tipo_factura'];
                $nombre = $datos2['nombre_tipo_factura'];
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

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center; font-size:13pt;">cod_movimiento_contable</th>
            <th style="text-align:center; font-size:13pt;">nombre_estado_factura</th>
            <th style="text-align:center; font-size:13pt;">nombre_tipo_documento</th>
            <th style="text-align:center; font-size:13pt;">doc_modifica</th>
            <th style="text-align:center; font-size:13pt;">cod_factura</th>
            <th style="text-align:center; font-size:13pt;">cod_tercero</th>
            <th style="text-align:center; font-size:13pt;">total_costo_movimiento_contable</th>
            <th style="text-align:center; font-size:13pt;">fecha_ymd</th>
            <th style="text-align:center; font-size:13pt;">nombre_tipo_forma_pago</th>
            <th style="text-align:center; font-size:13pt;">nombre_ccosto</th>
            <th style="text-align:center; font-size:13pt;">cuenta</th>
            <th style="text-align:center; font-size:13pt;">descripcion_movimiento</th>
        </tr>
    </thead>
    <tbody>
<?php
        $fecha_hoy                           = date("Y-m-d");

        $sql_total_tipo_factura = "SELECT * FROM tbl15_info_factura_venta 
        WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
        $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_cod_factura $filtro_consulta_nombre_tipo_factura 
        AND (nombre_estado_factura = 'CERRADA') ORDER BY cod_info_factura_venta DESC";
        $consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
        while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

        $cod_info_factura_venta                             = $datos_total_tipo_factura['cod_info_factura_venta'];
        $cod_factura                                        = $datos_total_tipo_factura['cod_factura'];
        $cod_tercero                                        = $datos_total_tipo_factura['cod_tercero'];
        $vlr_cancelado                                      = $datos_total_tipo_factura['vlr_cancelado'];
        $vlr_vuelto                                         = $datos_total_tipo_factura['vlr_vuelto'];
        $fecha_anyo                                         = $datos_total_tipo_factura['fecha_anyo'];
        $fecha_hora                                         = $datos_total_tipo_factura['fecha_hora'];
        $cod_tipo_pago                                      = $datos_total_tipo_factura['cod_tipo_pago'];
        $cod_administrador                                  = $datos_total_tipo_factura['cod_administrador'];
        $total_precio_compra                                = $datos_total_tipo_factura['total_precio_compra'];
        $total_precio_venta                                 = $datos_total_tipo_factura['total_precio_venta'];
        $cod_dependencia                                    = $datos_total_tipo_factura['cod_dependencia'];
        $cod_tipo_forma_pago                                = $datos_total_tipo_factura['cod_tipo_forma_pago'];
        $nombre_tipo_factura                                = $datos_total_tipo_factura['nombre_tipo_factura'];
        $nombre_tipo_moneda                                 = $datos_total_tipo_factura['nombre_tipo_moneda'];
        $total_datos_data                                   = $datos_total_tipo_factura['total_datos_data'];
        $observacion_tercero                                = $datos_total_tipo_factura['observacion_tercero'];
        $cod_base_caja                                      = $datos_total_tipo_factura['cod_base_caja'];
        $cod_estado_cava                                    = $datos_total_tipo_factura['cod_estado_cava'];
        $cod_cuentas_cobrar                                 = $datos_total_tipo_factura['cod_cuentas_cobrar'];
        $fecha_entrega                                      = $datos_total_tipo_factura['fecha_entrega'];
        $cod_resolucion_facturacion                         = $datos_total_tipo_factura['cod_resolucion_facturacion'];
        $nombre_estado_factura_dataico_dian                 = $datos_total_tipo_factura['nombre_estado_factura_dataico_dian'];
        $nombre_producto_concat                             = "";

        $mostrar_datos_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
        $consulta_resolucion_facturacion = mysqli_query($conectar, $mostrar_datos_resolucion_facturacion) or die(mysqli_error($conectar));
        $matriz_consulta_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

        $prefijo_resolucion_facturacion                     = $matriz_consulta_resolucion_facturacion['prefijo_resolucion_facturacion'];

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

        if ($total_precio_venta == '0') {
        $sql_venta_producto_temporal = "SELECT SUM(total_venta_producto) AS total_precio_venta FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
        $consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
        $datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

        $total_precio_venta       = $datos_venta_producto_temporal['total_precio_venta'];

        $actualiza_producto = sprintf("UPDATE tbl15_info_factura_venta SET total_precio_venta = '$total_precio_venta' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
        $resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));
        }

        if ($cod_estado_cava == '1') { $img_entrega_cava = "<img src=../imagenes/sem_no_atendido_peq.png>"; $url_entrega_cava = "../admin/marcar_cava_entregada.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_venta_producto=0"; } else { $img_entrega_cava = ""; $url_entrega_cava = "#"; }

        $sql_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
        $resultado_cuenta_cobrar = mysqli_query($conectar, $sql_cuenta_cobrar) or die(mysqli_error($conectar));
        $matriz_cuenta_cobrar = mysqli_fetch_assoc($resultado_cuenta_cobrar);

        $monto_deuda                         = $matriz_cuenta_cobrar['monto_deuda'];
        $subtotal                            = $matriz_cuenta_cobrar['subtotal'];
        $abonado                             = $matriz_cuenta_cobrar['abonado'];


        $obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
        $resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
        $matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

        $cliente                             = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
        $cedula_cli                          = $matriz_cliente['identificacion_tercero'];
        $direccion_cli                       = $matriz_cliente['direccion_tercero'];
        $nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
        $digito_tercero                      = $matriz_cliente['digito_tercero'];
        if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }

        if (($fecha_hoy > $fecha_entrega) && ($subtotal > '0')) { $boton_alerta_caducidad = '<img src="../imagenes/sem_no_atendido_peq.png">'; } else { $boton_alerta_caducidad = ''; }
        if ($subtotal > '0') { $url_redirect = '<a href="../admin/modificar_cuentas_cobrar.php?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_factura='.$cod_factura.'&cod_info_factura_venta='.$cod_info_factura_venta.'&cod_tercero='.$cod_tercero.'&cliente='.$cliente.'&pagina='.$pagina.'">'.number_format($subtotal, 0, ",", ".").'</a>'; } else { $url_redirect = number_format($subtotal, 0, ",", "."); }

        $sql_datos_venta_temp = "SELECT cod_producto_barra, nombre_producto, fecha_hora_venta_producto FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
        $consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
        while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

            $nombre_producto_con                 = $datos_venta_temp['nombre_producto'];
            $fecha_hora_venta_productocon        = $datos_venta_temp['fecha_hora_venta_producto'];
            $nombre_producto_concat             .= $nombre_producto_con.' - ';
        }
        $nombre_producto_concat = $nombre_producto_concat;
?>
        <tr id="<?php echo $cod_info_factura_venta;?>">
            <th style="text-align:center; font-size:13pt;" id="cod_factura<?php echo $cod_info_factura_venta;?>">0</th>
            <th style="text-align:center; font-size:13pt;" id="cod_factura<?php echo $cod_info_factura_venta;?>">CERRADA</th>
            <th style="text-align:center; font-size:13pt;" id="cod_factura<?php echo $cod_info_factura_venta;?>">RECIBO DE CAJA</th>
            <th style="text-align:left; font-size:13pt;" id="nombre_tercero<?php echo $cod_info_factura_venta;?>"><?php echo $cod_info_factura_venta?></th>
            <th style="text-align:left; font-size:13pt;" id="nombre_tercero<?php echo $cod_info_factura_venta;?>"><?php echo $cod_factura?></th>
            <th style="text-align:left; font-size:13pt;" id="nombre_tercero<?php echo $cod_info_factura_venta;?>"><?php echo $cod_tercero?></th>
            <th style="text-align:right; font-size:13pt;" id="total_precio_venta<?php echo $cod_info_factura_venta;?>"><?php echo $total_precio_venta ?></th>
            <th style="text-align:center; font-size:13pt;" id="fecha_anyo<?php echo $cod_info_factura_venta;?>"><?php echo $fecha_anyo?></th>
            <th style="text-align:center; font-size:13pt;" id="fecha_hora<?php echo $cod_info_factura_venta;?>"><?php echo $fecha_hora_venta_productocon?></th>
            <th style="text-align:center; font-size:13pt;" id="cod_factura<?php echo $cod_info_factura_venta;?>">PERSONAL</th>
            <th style="text-align:center; font-size:13pt;" id="nombre_tipo_factura<?php echo $cod_info_factura_venta;?>"><?php echo $cuenta?></th>
            <th style="text-align:left; font-size:13pt;" id="nombre_tercero<?php echo $cod_info_factura_venta;?>"><?php echo $nombre_producto_concat?></th>
        </tr id="<?php echo $cod_info_factura_venta;?>">
<?php } ?>
    </tbody>
</table>
</div>
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>

<script type="text/javascript">
$(document).ready(function() {

    $('.EnviarFacturaDianDataico').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_info_factura_venta = $(this).parent().attr('data');
        var datos_url_ajax = 'cod_info_factura_venta='+cod_info_factura_venta;
        console.log("cod_info_factura_venta = "+cod_info_factura_venta);

        $.ajax({
            type: "GET",
            url: "../admin/enviar_datos_factura_venta_dian_json.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                //var ok_ajax = respuesta.numbering.prefix;
                var number_factura = respuesta.number;
                var dian_status = respuesta.dian_status;

                //var correo = respuesta[2].costumer.email;
                //var resolution_number = respuesta.number;

                console.log("number_factura = "+number_factura);
                //console.log("correo = "+correo);
                //console.log("respuesta = "+respuesta);

            }
        });

    });

});
</script>

</div>
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>