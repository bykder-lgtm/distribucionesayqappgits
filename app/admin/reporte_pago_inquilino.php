<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<?php include_once('../admin/02_modulo_estilo_css_chosen_600px.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="js/json2.min.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

<script>
    $(document).ready(function(){
        $("#cod_tercero_propietario").chosen();
   });
</script>
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
<!--<a class="btn btn-primary" href="#"><h6>Lista Facturas</h6></a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$seleccionado = 1;
$pagina_local = '';

if (isset($_GET['fecha_pago_reg_ini'])) {
    $fecha_pago_reg_ini            = addslashes($_GET['fecha_pago_reg_ini']);
    $fecha_pago_reg_fin            = addslashes($_GET['fecha_pago_reg_fin']);
    if (isset($_GET['cod_tercero'])) { $cod_tercero = intval($_GET['cod_tercero']); } else { $cod_tercero = 0; }
    $cod_factura                                 = intval($_GET['cod_factura']);
    $fecha                                       = date("Y-m-d");


    if ($cod_tercero==0) {
        $filtro_consulta_tercero                     = "";
        $filtro_consulta_tercero_rel                 = "";
    } else {
        $filtro_consulta_tercero                     = "AND (cod_tercero = '$cod_tercero')";
        $filtro_consulta_tercero_rel                 = "AND (tbl15_venta_producto.cod_tercero = '$cod_tercero')";
    }

    if ($cod_factura=='0' || $cod_factura=='') {
        $filtro_consulta_cod_factura                 = "";
        $filtro_consulta_cod_factura_rel             = "";
        $fecha_pago_reg_ini            = addslashes($_GET['fecha_pago_reg_ini']);
    } else {
        $filtro_consulta_cod_factura                 = "AND (cod_factura = '$cod_factura')";
        $filtro_consulta_cod_factura_rel             = "AND (tbl15_venta_producto.cod_factura = '$cod_factura')";
        $fecha_pago_reg_ini                          = "2010-01-01";
    }

} else {
    $fecha_pago_reg_ini                              = date("Y-m-d");
    $fecha_pago_reg_fin                              = date("Y-m-d");
    $cod_tercero                                     = 0;
    $cod_factura                                     = "";
    $fecha                                           = date("Y-m-d");

    if ($cod_tercero==0) {
        $filtro_consulta_tercero                     = "";
        $filtro_consulta_tercero_rel                 = "";
    } else {
        $filtro_consulta_tercero                     = "";
        $filtro_consulta_tercero_rel                 = "";
    }

    if ($cod_factura=='0' || $cod_factura=='') {
        $filtro_consulta_cod_factura                 = "";
        $filtro_consulta_cod_factura_rel             = "";
    } else {
        $filtro_consulta_cod_factura                 = "";
        $filtro_consulta_cod_factura_rel             = "";
    }

}

if ($cod_tercero==0) {
    $nombre_cliente                                  = 'TODOS';
} else {
    $sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido2_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

    $nombre_cliente                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido2_tercero'];
}

if ($cod_factura=='0') {
    $nombre_dependencia_get                             = 'TODOS';
} else {
    $nombre_dependencia_get                             = $cod_factura;
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
        <th style="text-align:left"><a href="#"><font size='+2'>Reporte Pagos Inquilinos</font></a></th>
    </tr>
</table>

<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center; width:100px;">CONTRATO</th>
    <th style="text-align:center;">INQUILINO</th>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
  </tr>
    <td style="text-align:center;"><input type="text" id="cod_factura" name="cod_factura" style="width:80px;" autofocus/></td>
    <td style="text-align:left;">
        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE nombre_tipo_tercero = 'INQUILINO' ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_pago_reg_ini" type="date" value="<?php echo $fecha_pago_reg_ini ?>" style="width:150px;" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_pago_reg_fin" type="date" value="<?php echo $fecha_pago_reg_fin ?>" style="width:150px;" required/></td>
  </tr>
</table>
<div class="actions">
<input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<?php if (isset($_GET['fecha_pago_reg_ini'])) { 
$nombre_tipo_solicitud                      = 'SOLICITUD DE ARRIENDO';

$sql_total_cuentas_cobrar_factura_comision_propietario = "SELECT SUM(deduccion_comision) AS total_ingreso_por_comision_administarcion, SUM(total_ingreso) AS total_valor_pagado_a_propietario 
FROM tbl15_cuentas_cobrar_factura_comision_propietario WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') $filtro_consulta_tercero $filtro_consulta_cod_factura";
$consulta_total_cuentas_cobrar_factura_comision_propietario = mysqli_query($conectar, $sql_total_cuentas_cobrar_factura_comision_propietario) or die(mysqli_error($conectar));
$datos_total_cuentas_cobrar_factura_comision_propietario = mysqli_fetch_assoc($consulta_total_cuentas_cobrar_factura_comision_propietario);

$total_ingreso_por_comision_administarcion  = $datos_total_cuentas_cobrar_factura_comision_propietario['total_ingreso_por_comision_administarcion'];
$total_valor_pagado_a_propietario           = $datos_total_cuentas_cobrar_factura_comision_propietario['total_valor_pagado_a_propietario'];

$sql_total_tipo_factura = "SELECT SUM(total_recibido) AS total_recibido_pago_inquilino, SUM(monto_cuota_interes) AS total_ingreso_por_interes_inquilino 
FROM tbl15_cuentas_cobrar_alerta WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (cod_estado = '1') $filtro_consulta_tercero $filtro_consulta_cod_factura";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
$datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura);

$total_recibido_pago_inquilino              = $datos_total_tipo_factura['total_recibido_pago_inquilino'];
$total_ingreso_por_interes_inquilino        = $datos_total_tipo_factura['total_ingreso_por_interes_inquilino'];
$total_interes_mas_total_interes            = $total_recibido_pago_inquilino + $total_ingreso_por_interes_inquilino;


$sql_total_tipo_factura = "SELECT SUM(valor_solicitud_arriendo) AS total_ingreso_por_solicitud_arriendo_inquilino 
FROM tbl15_tercero 
WHERE (fecha_solicitud_arriendo BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_solicitud = '$nombre_tipo_solicitud')
ORDER BY fecha_solicitud_arriendo DESC";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
$datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura);

$total_ingreso_por_solicitud_arriendo_inquilino  = $datos_total_tipo_factura['total_ingreso_por_solicitud_arriendo_inquilino'];

$sql_total_gasto_inmueble_detalle_venta = "SELECT SUM(precio_compra_producto) AS sum_precio_compra_producto, SUM(precio_venta_producto) AS sum_precio_venta_producto 
FROM tbl15_gasto_inmueble_detalle_venta WHERE (fecha_gasto_inmueble_detalle BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') 
$filtro_consulta_tercero $filtro_consulta_cod_factura ORDER BY cod_info_gasto_inmueble_detalle_venta";
$consulta_total_gasto_inmueble_detalle_venta = mysqli_query($conectar, $sql_total_gasto_inmueble_detalle_venta) or die(mysqli_error($conectar));
$datos_total_gasto_inmueble_detalle_venta = mysqli_fetch_assoc($consulta_total_gasto_inmueble_detalle_venta);

$sum_precio_compra_producto                        = $datos_total_gasto_inmueble_detalle_venta['sum_precio_compra_producto'];
$sum_precio_venta_producto                         = $datos_total_gasto_inmueble_detalle_venta['sum_precio_venta_producto'];
$total_ingreso_por_reparaciones                    = $sum_precio_venta_producto - $sum_precio_compra_producto;

$sql_ingreso_inmobil = "SELECT SUM(costo) AS total_otros_ingresos_inmobil FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO') AND (cod_dependencia = '1')";
$resultado_ingreso_inmobil = mysqli_query($conectar, $sql_ingreso_inmobil) or die(mysqli_error($conectar));
$info_ingreso_inmobil = mysqli_fetch_assoc($resultado_ingreso_inmobil);

$total_otros_ingresos_inmobil                      = $info_ingreso_inmobil['total_otros_ingresos_inmobil'];

$sql_ingreso_juridica = "SELECT SUM(costo) AS total_otros_ingresos_juridica FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO') AND (cod_dependencia = '2')";
$resultado_ingreso_juridica = mysqli_query($conectar, $sql_ingreso_juridica) or die(mysqli_error($conectar));
$info_ingreso_juridica = mysqli_fetch_assoc($resultado_ingreso_juridica);

$total_otros_ingresos_juridica                             = $info_ingreso_juridica['total_otros_ingresos_juridica'];

$sql_ingreso = "SELECT SUM(costo) AS total_otros_ingresos FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO')";
$resultado_ingreso = mysqli_query($conectar, $sql_ingreso) or die(mysqli_error($conectar));
$info_ingreso = mysqli_fetch_assoc($resultado_ingreso);

$total_otros_ingresos                             = $info_ingreso['total_otros_ingresos'];


$sql_egreso_inmobil = "SELECT SUM(costo) AS total_otros_egresos_inmobil FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'EGRESO') AND (cod_dependencia = '1')";
$resultado_egreso_inmobil = mysqli_query($conectar, $sql_egreso_inmobil) or die(mysqli_error($conectar));
$info_egreso_inmobil = mysqli_fetch_assoc($resultado_egreso_inmobil);

$total_otros_egresos_inmobil                      = $info_egreso_inmobil['total_otros_egresos_inmobil'];


$sql_total_cuentas_cobrar_alerta = "SELECT SUM(ingreso_gasto_juridica) AS total_otros_ingresos_juridica_arriendo, SUM(total_pagar) AS total_pagar_inquilino FROM tbl15_cuentas_cobrar_alerta 
WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (cod_estado = '1')
$filtro_consulta_tercero $filtro_consulta_cod_factura ORDER BY fecha_pago_reg DESC";
$consulta_total_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_total_cuentas_cobrar_alerta) or die(mysqli_error($conectar));
$datos_total_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_total_cuentas_cobrar_alerta);

$total_otros_ingresos_juridica_arriendo           = $datos_total_cuentas_cobrar_alerta['total_otros_ingresos_juridica_arriendo'];
$total_ingreso                                    = $total_ingreso_por_interes_inquilino + $total_ingreso_por_reparaciones + $total_ingreso_por_solicitud_arriendo_inquilino + $total_ingreso_por_comision_administarcion + $total_otros_ingresos_inmobil + $total_otros_ingresos_juridica + $total_otros_ingresos_juridica_arriendo;
$total_pagar_inquilino                            = $datos_total_cuentas_cobrar_alerta['total_pagar_inquilino'];
?>
<fieldset><legend>INFO</legend>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">INQUILINO</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">FECHA INICIAL</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">FECHA FINAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="text-align:center; font-size:11pt;"><?php echo $nombre_cliente ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo date("d-m-Y", strtotime($fecha_pago_reg_ini)) ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo date("d-m-Y", strtotime($fecha_pago_reg_fin)) ?></th>
            </tr>
        </tbody>
    </table>
</fieldset>

<hr>

<fieldset><legend>PAGOS A INQUILINOS</legend>
    <table class="table table-striped">
    <thead>
    <tr>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">CONTRATO</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">INQUILINO | INMUEBLE</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL PAGAR</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">VALOR RECIBIDO</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">INTERESES</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">INGRESO JURIDICA (ARRIENDO)</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">FECHA REG PAGO</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">ARCH</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">ID</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $fecha_hoy                                         = date("Y-m-d");

    $calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar_alerta 
    WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (cod_estado = '1')
    $filtro_consulta_tercero $filtro_consulta_cod_factura ORDER BY fecha_pago_reg DESC";
    $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
    while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

        $cod_cuentas_cobrar_alerta                     = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
        $cod_cuentas_cobrar                            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
        $numero_alerta                                 = $datos_cuenta_cobrar['numero_alerta'];
        $cod_factura                                   = $datos_cuenta_cobrar['cod_factura'];
        $monto_deuda                                   = $datos_cuenta_cobrar['monto_deuda'];
        $abonado                                       = $datos_cuenta_cobrar['abonado'];
        $subtotal                                      = $datos_cuenta_cobrar['subtotal'];
        $mensaje                                       = $datos_cuenta_cobrar['mensaje'];
        $fecha_pago                                    = $datos_cuenta_cobrar['fecha_pago'];
        $vendedor                                      = $datos_cuenta_cobrar['vendedor'];
        $monto_cuota                                   = $datos_cuenta_cobrar['monto_cuota'];
        $cod_estado                                    = $datos_cuenta_cobrar['cod_estado'];
        $fecha_pago_reg                                = $datos_cuenta_cobrar['fecha_pago_reg'];
        $hora_pago_reg                                 = $datos_cuenta_cobrar['hora_pago_reg'];
        $cod_cuentas_cobrar_abonos                     = $datos_cuenta_cobrar['cod_cuentas_cobrar_abonos'];
        $url_img_orig_producto                         = $datos_cuenta_cobrar['url_img_orig_producto'];
        $total_recibido                                = $datos_cuenta_cobrar['total_recibido'];
        $total_pendiente                               = $datos_cuenta_cobrar['total_pendiente'];
        $cod_renovacion_contrato                       = $datos_cuenta_cobrar['cod_renovacion_contrato'];
        $cod_tercero                                   = $datos_cuenta_cobrar['cod_tercero'];
        $cod_tipo_forma_pago                           = $datos_cuenta_cobrar['cod_tipo_forma_pago'];
        $total_pagar                                   = $datos_cuenta_cobrar['total_pagar'];
        $monto_cuota_interes                           = $datos_cuenta_cobrar['monto_cuota_interes'];
        $cod_estado_archivado                          = $datos_cuenta_cobrar['cod_estado_archivado'];
        $ingreso_gasto_juridica                        = $datos_cuenta_cobrar['ingreso_gasto_juridica'];
        $nombre_producto                               = $datos_cuenta_cobrar['nombre_producto'];

        $fecha_mes                                     = $datos_cuenta_cobrar['fecha_mes'];
        $nombre_tabla_anyo                             = $datos_cuenta_cobrar['anyo'];
        $cod_estado_envio_correo_cuenta_cobro          = $datos_cuenta_cobrar['cod_estado_envio_correo_cuenta_cobro'];
        $cod_estado_envio_correo_comprobante_ingreso   = $datos_cuenta_cobrar['cod_estado_envio_correo_comprobante_ingreso'];
        $fecha_mes_complet                             = $fecha_mes.'-01';

        $cod_estado_pago                               = 1;
        $fecha_pago_dmy                                = date("d-m-Y", strtotime($fecha_pago));
        if ($fecha_pago_reg <> '') { $fecha_pago_reg_dmy = date("d-m-Y", strtotime($fecha_pago_reg)); } else { $fecha_pago_reg_dmy = ""; }

        $nombre_tabla_mes                              = date("m", strtotime($fecha_mes_complet));

        $mostrar_datos_sql = "SELECT nombre_letra_tabla_mes FROM tbl15_tabla_mes WHERE nombre_tabla_mes  = '$nombre_tabla_mes'";
        $consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
        $matriz_consulta = mysqli_fetch_assoc($consulta);

        $nombre_letra_tabla_mes                   = $matriz_consulta['nombre_letra_tabla_mes'];

        $sql_estado_pago = "SELECT * FROM tbl15_estado_pago WHERE cod_estado_pago = '$cod_estado'";
        $consulta_estado_pago = mysqli_query($conectar, $sql_estado_pago) or die(mysqli_error($conectar));
        $matriz_estado_pago = mysqli_fetch_assoc($consulta_estado_pago);

        $nombre_estado_pago             = $matriz_estado_pago['nombre_estado_pago'];
        $color_fondo_celda_estado_pago  = $matriz_estado_pago['color_fondo_celda_estado_pago'];
        $color_letra_celda_estado_pago  = $matriz_estado_pago['color_letra_celda_estado_pago'];

        $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
        $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
        $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

        $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

        $sql_consulta_inquilino = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
        $consulta_inquilino = mysqli_query($conectar, $sql_consulta_inquilino) or die(mysqli_error($conectar));
        $total_inquilino = mysqli_fetch_assoc($consulta_inquilino);

        $identificacion_tercero_inquilino         = $total_inquilino['identificacion_tercero'];
        $nombre1_tercero_inquilino                = $total_inquilino['nombre1_tercero'];
        $nombre2_tercero_inquilino                = $total_inquilino['nombre2_tercero'];
        $apellido1_tercero_inquilino              = $total_inquilino['apellido1_tercero'];
        $apellido2_tercero_inquilino              = $total_inquilino['apellido2_tercero'];
    ?>
    <tr>
        <td style="text-align:center; font-size:11pt;"><?php echo ($cod_factura)?></td>
        <td style="text-align:left; font-size:11pt;"><?php echo $nombre1_tercero_inquilino?> | <?php echo $nombre_producto?></td>
        <td style="text-align:right; font-size:11pt;"><?php echo number_format($total_pagar, 0, ",", ".") ?></td>
        <td style="text-align:right; font-size:11pt;"><?php echo number_format($total_recibido, 0, ",", ".") ?></td>
        <td style="text-align:right; font-size:11pt;"><?php echo number_format($monto_cuota_interes, 0, ",", ".") ?></td>
        <td style="text-align:right; font-size:11pt;"><?php echo number_format($ingreso_gasto_juridica, 0, ",", ".") ?></td>
        <td style="text-align:center; font-size:11pt;"><?php echo date("d-m-Y", strtotime($fecha_pago_reg))?></td>
        <td style="text-align:center; font-size:11pt;"><?php echo $cod_estado_archivado?></td>
        <td style="text-align:center; font-size:11pt;"><?php echo $cod_cuentas_cobrar_alerta?></td>
    </tr>
    <?php } ?>
    <tr>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_pagar_inquilino, 0, ",", ".") ?></th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_recibido_pago_inquilino, 0, ",", ".") ?></th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_ingreso_por_interes_inquilino, 0, ",", ".") ?></th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_otros_ingresos_juridica_arriendo, 0, ",", ".") ?></th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
    </tr>
    </tbody>
    </table>
</fieldset>
<?php } ?>
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>