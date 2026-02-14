<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_caja_registradora.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<meta charset="utf-8">
<title><?php echo $nombre_emp;?></title>
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="../estilo_css/caja_registradora_jqueryscripttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../estilo_css/caja_registradora_bootstrap.min.css">
<script src="../js/caja_registradora_jquery-3.2.1.min.js"></script>
<script src="../js/caja_registradora_popper.min.js"></script>
<script src="../js/caja_registradora_bootstrap.min.js"></script>
<link rel="stylesheet" href="../estilo_css/caja_registradora_font-awesome.min.css">
</head>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php
$seleccionado                      = 0;

if ($cod_seguridad == '1') {
$condicion_inventario = 'cod_tipo_inventario = "1" OR cod_tipo_inventario = "2"';
$condicion_vendedor = '';
$condicion_vendedor_option = '<option value="0" $seleccionado >TODOS</option>';
} else {
$condicion_inventario = 'cod_tipo_inventario = "1"';
$condicion_vendedor = 'WHERE cod_administrador = '.$cod_administrador;
$condicion_vendedor_option = '';
}

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
$fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$cod_administrador                       = intval($_GET['cod_administrador']);
$cod_tercero                             = intval($_GET['cod_tercero']);
$cod_tipo_pago                           = intval($_GET['cod_tipo_pago']);
$cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
$cod_dependencia                         = intval($_GET['cod_dependencia']);
$nombre_tipo_factura                     = addslashes($_GET['nombre_tipo_factura']);
$fecha                                   = date("Y-m-d");

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
$cod_administrador                       = 0;
$cod_tercero                             = 0;
$cod_tipo_pago                           = 0;
$cod_tipo_forma_pago                     = 0;
$cod_dependencia                         = 0;
$nombre_tipo_factura                     = "0";
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


$resta                                   = 1516399999;
$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y-m-d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Ymd");
$hora_venta_his                          = date("His");
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");
?>
<body>
<table class="table table-striped">
  <tr>
    <td style="text-align:center;"><a href="../admin/facturacion_venta_temporal_producto_manual_caja_registradora_pos.php" class="btn btn-primary">Facturar</a></td>
    <td style="text-align:center;"><a href="../admin/lista_info_factura_venta_caja_registradora.php" class="btn btn-warning">Lista</a></td>
    <td style="text-align:center;"><a href="../admin/reporte_venta_fechas_caja_registradora.php" class="btn btn-info">Reporte</a></td>
    <td style="text-align:center;"><a href="../session/salir_caja_registradora.php?token=<?php echo $token ?>" class="btn btn-danger">Salir</a></td>
  </tr>
</table>

<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">TERCERO</th>
    <th style="text-align:center;">DEPENDENCIA</th>
    <th style="text-align:center;">TIPO PAGO</th>
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
  </tr>
  <tr>
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO FACTURA</th>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
  </tr>
  <tr>
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
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_suma_compra_producto, 
SUM(total_venta_producto * (comision_ptj/100)) AS total_comision 
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura";
$consulta_total_venta = mysqli_query($conectar, $sql_total_venta) or die(mysqli_error($conectar));
$datos_total_venta = mysqli_fetch_assoc($consulta_total_venta);

$total_suma_venta_producto       = $datos_total_venta['total_suma_venta_producto'];
$total_suma_compra_producto      = $datos_total_venta['total_suma_compra_producto'];
$total_ganancia                  = $total_suma_venta_producto - $total_suma_compra_producto;
$total_comision_venta            = $datos_total_venta['total_comision'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta_contado_efectivo = "SELECT SUM(total_venta_producto) AS total_venta_producto_contado_efectivo, SUM(total_compra_producto) AS total_compra_producto
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura";
$consulta_total_venta_contado_efectivo = mysqli_query($conectar, $sql_total_venta_contado_efectivo) or die(mysqli_error($conectar));
$datos_total_venta_contado_efectivo = mysqli_fetch_assoc($consulta_total_venta_contado_efectivo);

$total_venta_producto_contado_efectivo    = $datos_total_venta_contado_efectivo['total_venta_producto_contado_efectivo'];
$total_compra_producto_contado             = $datos_total_venta_contado_efectivo['total_compra_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta_contado = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
AND (cod_tipo_pago = '$contado') $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura";
$consulta_total_venta_contado = mysqli_query($conectar, $sql_total_venta_contado) or die(mysqli_error($conectar));
$datos_total_venta_contado = mysqli_fetch_assoc($consulta_total_venta_contado);

$total_venta_producto_contado    = $datos_total_venta_contado['total_venta_producto'];
$total_compra_producto_contado    = $datos_total_venta_contado['total_compra_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_venta_credito = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto 
FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta 
AND (cod_tipo_pago = '$credito') $filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura";
$consulta_total_venta_credito = mysqli_query($conectar, $sql_total_venta_credito) or die(mysqli_error($conectar));
$datos_total_venta_credito = mysqli_fetch_assoc($consulta_total_venta_credito);

$total_venta_producto_credito    = $datos_total_venta_credito['total_venta_producto'];
$total_compra_producto_credito    = $datos_total_venta_credito['total_compra_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_total_servicio_propina = "SELECT SUM(total_venta_producto) AS total_suma_servicio_propina FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta
AND (cod_producto_barra = '$cod_producto_barra') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura";
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
<thead>
<tr>
<th style="text-align:center">Factura</th>
<th style="text-align:center">Cod</th>
<th style="text-align:center">Concepto</th>
<th style="text-align:center">Total Venta</th>
<th style="text-align:center">Fecha</th>
<th style="text-align:center">Hora</th>
<th style="text-align:center">Imp</th>
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_costo_producto, tbl15_venta_producto.total_compra_producto, tbl15_venta_producto.precio_venta_producto, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, 
tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, 
tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_venta_producto.cod_administrador,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar, tbl15_venta_producto.comision_ptj, tbl15_venta_producto.cod_tipo_pago, 
tbl15_venta_producto.cod_tipo_forma_pago, tbl15_venta_producto.cod_dependencia, tbl15_venta_producto.nombre_tipo_factura, tbl15_venta_producto.und_producto
FROM tbl15_tercero RIGHT JOIN tbl15_venta_producto ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $condicion_hora_reporte_venta_rel 
$filtro_consulta_vendedor_rel $filtro_consulta_tercero_rel $filtro_consulta_tipo_pago_rel $filtro_consulta_tipo_forma_pago_rel $filtro_consulta_dependencia_rel $filtro_consulta_nombre_tipo_factura_rel
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
$und_producto                  = $info_cliente['und_producto'];

$total_ganancia_venta          = ($total_venta_producto - $total_compra_producto);
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

$sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_dependencia            = $datos_dependencia['nombre_dependencia'];
?>
<tr>
<td style="text-align:center"><?php echo $cod_factura?></td>
<td style="text-align:left"><?php echo $cod_producto_barra?></td>
<td style="text-align:left"><?php echo $nombre_producto?></td>
<td style="text-align:right"><?php echo number_format($total_venta_producto, 0, ",", ".")?></td>
<td style="text-align:center"><?php echo $fecha_ymd_venta_producto?></td>
<td style="text-align:center"><?php echo $fecha_hora_venta_producto?></td>
<td style="text-align:center"><a href="../admin/facturacion_venta_temporal_producto_manual_caja_registradora_pos.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta; ?>"><img src="../imagenes/imprimir_2.png"></a></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php } ?>

</body>
</html>