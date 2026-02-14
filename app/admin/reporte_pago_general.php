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
    if (isset($_GET['cod_factura'])) { $cod_factura = intval($_GET['cod_factura']); } else { $cod_factura = 0; }
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
    $fecha_pago_reg_ini            = "2010-01-01";
}

} else {
    $fecha_pago_reg_ini            = date("Y-m-d");
    $fecha_pago_reg_fin            = date("Y-m-d");
    $cod_tercero                                 = 0;
    $cod_factura                                 = "";
    $fecha                                       = date("Y-m-d");

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
        <th style="text-align:left"><a href="#"><font size='+2'>REPORTE GENERAL</font></a></th>
    </tr>
</table>

<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <!--<th style="text-align:center; width:100px;">CONTRATO</th>-->
    <!--<th style="text-align:center;">ARRENDATARIO</th>-->
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
  </tr>
    <!--<td style="text-align:center;"><input type="text" id="cod_factura" name="cod_factura" style="width:80px;" autofocus/></td>-->
    <!--
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
    -->
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
FROM tbl15_cuentas_cobrar_factura_comision_propietario WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin')";
$consulta_total_cuentas_cobrar_factura_comision_propietario = mysqli_query($conectar, $sql_total_cuentas_cobrar_factura_comision_propietario) or die(mysqli_error($conectar));
$datos_total_cuentas_cobrar_factura_comision_propietario = mysqli_fetch_assoc($consulta_total_cuentas_cobrar_factura_comision_propietario);

$total_ingreso_por_comision_administarcion  = $datos_total_cuentas_cobrar_factura_comision_propietario['total_ingreso_por_comision_administarcion'];
$total_valor_pagado_a_propietario           = $datos_total_cuentas_cobrar_factura_comision_propietario['total_valor_pagado_a_propietario'];
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_total_tipo_factura = "SELECT SUM(total_recibido) AS total_recibido_pago_inquilino, SUM(monto_cuota_interes) AS total_ingreso_por_interes_inquilino 
FROM tbl15_cuentas_cobrar_alerta WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (cod_estado = '1')";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
$datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura);

$total_recibido_pago_inquilino              = $datos_total_tipo_factura['total_recibido_pago_inquilino'];
$total_ingreso_por_interes_inquilino        = $datos_total_tipo_factura['total_ingreso_por_interes_inquilino'];
$total_interes_mas_total_interes            = $total_recibido_pago_inquilino + $total_ingreso_por_interes_inquilino;
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_total_tipo_factura = "SELECT SUM(valor_solicitud_arriendo) AS total_ingreso_por_solicitud_arriendo_inquilino 
FROM tbl15_tercero 
WHERE (fecha_solicitud_arriendo BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_solicitud = '$nombre_tipo_solicitud')";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
$datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura);

$total_ingreso_por_solicitud_arriendo_inquilino  = $datos_total_tipo_factura['total_ingreso_por_solicitud_arriendo_inquilino'];
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_total_gasto_inmueble_detalle_venta = "SELECT SUM(precio_compra_producto) AS sum_precio_compra_producto, SUM(precio_venta_producto) AS sum_precio_venta_producto 
FROM tbl15_gasto_inmueble_detalle_venta WHERE (fecha_gasto_inmueble_detalle BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin')";
$consulta_total_gasto_inmueble_detalle_venta = mysqli_query($conectar, $sql_total_gasto_inmueble_detalle_venta) or die(mysqli_error($conectar));
$datos_total_gasto_inmueble_detalle_venta = mysqli_fetch_assoc($consulta_total_gasto_inmueble_detalle_venta);

$sum_precio_compra_producto                        = $datos_total_gasto_inmueble_detalle_venta['sum_precio_compra_producto'];
$sum_precio_venta_producto                         = $datos_total_gasto_inmueble_detalle_venta['sum_precio_venta_producto'];
$total_ingreso_por_reparaciones                    = $sum_precio_venta_producto - $sum_precio_compra_producto;
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_ingresos_inmobil = "SELECT SUM(costo) AS total_otros_ingresos_inmobil FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO') AND (cod_dependencia = '1')";
$resultado_ingresos_inmobil = mysqli_query($conectar, $sql_ingresos_inmobil) or die(mysqli_error($conectar));
$info_ingresos_inmobil = mysqli_fetch_assoc($resultado_ingresos_inmobil);

$total_otros_ingresos_inmobil                      = $info_ingresos_inmobil['total_otros_ingresos_inmobil'];
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_ingresos_juridica = "SELECT SUM(costo) AS total_otros_ingresos_juridica FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO') AND (cod_dependencia = '2')";
$resultado_ingresos_juridica = mysqli_query($conectar, $sql_ingresos_juridica) or die(mysqli_error($conectar));
$info_ingresos_juridica = mysqli_fetch_assoc($resultado_ingresos_juridica);

$total_otros_ingresos_juridica                             = $info_ingresos_juridica['total_otros_ingresos_juridica'];
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_ingresos_abogado_yamid = "SELECT SUM(costo) AS total_otros_ingresos_abogado_yamid FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO') AND (cod_dependencia = '3')";
$resultado_ingresos_abogado_yamid = mysqli_query($conectar, $sql_ingresos_abogado_yamid) or die(mysqli_error($conectar));
$info_ingresos_abogado_yamid = mysqli_fetch_assoc($resultado_ingresos_abogado_yamid);

$total_otros_ingresos_abogado_yamid                             = $info_ingresos_abogado_yamid['total_otros_ingresos_abogado_yamid'];
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_ingresos_abogado_trillo = "SELECT SUM(costo) AS total_otros_ingresos_abogado_trillo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO') AND (cod_dependencia = '4')";
$resultado_ingresos_abogado_trillo = mysqli_query($conectar, $sql_ingresos_abogado_trillo) or die(mysqli_error($conectar));
$info_ingresos_abogado_trillo = mysqli_fetch_assoc($resultado_ingresos_abogado_trillo);

$total_otros_ingresos_abogado_trillo                             = $info_ingresos_abogado_trillo['total_otros_ingresos_abogado_trillo'];
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_egresos_inmobil = "SELECT SUM(costo) AS total_otros_egresos_inmobil FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'EGRESO') AND (cod_dependencia = '1')";
$resultado_egresos_inmobil = mysqli_query($conectar, $sql_egresos_inmobil) or die(mysqli_error($conectar));
$info_egresos_inmobil = mysqli_fetch_assoc($resultado_egresos_inmobil);

$total_otros_egresos_inmobil                      = $info_egresos_inmobil['total_otros_egresos_inmobil'];
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_egresos_juridica = "SELECT SUM(costo) AS total_otros_egresos_juridica FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'EGRESO') AND (cod_dependencia = '2')";
$resultado_egresos_juridica = mysqli_query($conectar, $sql_egresos_juridica) or die(mysqli_error($conectar));
$info_egresos_juridica = mysqli_fetch_assoc($resultado_egresos_juridica);

$total_otros_egresos_juridica                             = $info_egresos_juridica['total_otros_egresos_juridica'];
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_egresos_abogado_yamid = "SELECT SUM(costo) AS total_otros_egresos_abogado_yamid FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'EGRESO') AND (cod_dependencia = '3')";
$resultado_egresos_abogado_yamid = mysqli_query($conectar, $sql_egresos_abogado_yamid) or die(mysqli_error($conectar));
$info_egresos_abogado_yamid = mysqli_fetch_assoc($resultado_egresos_abogado_yamid);

$total_otros_egresos_abogado_yamid                             = $info_egresos_abogado_yamid['total_otros_egresos_abogado_yamid'];
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_egresos_abogado_trillo = "SELECT SUM(costo) AS total_otros_egresos_abogado_trillo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'EGRESO') AND (cod_dependencia = '4')";
$resultado_egresos_abogado_trillo = mysqli_query($conectar, $sql_egresos_abogado_trillo) or die(mysqli_error($conectar));
$info_egresos_abogado_trillo = mysqli_fetch_assoc($resultado_egresos_abogado_trillo);

$total_otros_egresos_abogado_trillo                             = $info_egresos_abogado_trillo['total_otros_egresos_abogado_trillo'];
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$total_otros_ingresos                             = $total_otros_ingresos_inmobil + $total_otros_ingresos_juridica + $total_otros_ingresos_abogado_yamid + $total_otros_ingresos_abogado_trillo;
$total_otros_egresos                              = $total_otros_egresos_inmobil + $total_otros_egresos_juridica + $total_otros_egresos_abogado_yamid + $total_otros_egresos_abogado_trillo;
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_total_cuentas_cobrar_alerta = "SELECT SUM(ingreso_gasto_juridica) AS total_otros_ingresos_juridica_arriendo FROM tbl15_cuentas_cobrar_alerta 
WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (cod_estado = '1')";
$consulta_total_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_total_cuentas_cobrar_alerta) or die(mysqli_error($conectar));
$datos_total_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_total_cuentas_cobrar_alerta);

$total_otros_ingresos_juridica_arriendo           = $datos_total_cuentas_cobrar_alerta['total_otros_ingresos_juridica_arriendo'];
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$sql_total_ingreso_por_reparaciones_arrendatario = "SELECT SUM(precio_venta_producto - precio_compra_producto) AS total_ingreso_por_reparaciones_arrendatario FROM tbl15_gasto_inmueble_inquilino_venta 
WHERE (fecha_gasto_inmueble_detalle BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin')";
$consulta_total_ingreso_por_reparaciones_arrendatario = mysqli_query($conectar, $sql_total_ingreso_por_reparaciones_arrendatario) or die(mysqli_error($conectar));
$datos_total_ingreso_por_reparaciones_arrendatario = mysqli_fetch_assoc($consulta_total_ingreso_por_reparaciones_arrendatario);

$total_ingreso_por_reparaciones_arrendatario           = $datos_total_ingreso_por_reparaciones_arrendatario['total_ingreso_por_reparaciones_arrendatario'];
//**********************************************************************************************************************************************************//
//**********************************************************************************************************************************************************//
$total_ingreso                                    = $total_ingreso_por_interes_inquilino + $total_ingreso_por_reparaciones + $total_ingreso_por_reparaciones_arrendatario + $total_ingreso_por_solicitud_arriendo_inquilino + $total_ingreso_por_comision_administarcion + $total_otros_ingresos_juridica_arriendo + $total_otros_ingresos_inmobil + $total_otros_ingresos_juridica + $total_otros_ingresos_abogado_yamid + $total_otros_ingresos_abogado_trillo;
?>
<fieldset><legend>TOTAL INGRESOS <a href="../admin/descargar_reporte_general_total_ingresos_inmobiliaria_spout_xlsx.php?fecha_pago_reg_ini=<?php echo $fecha_pago_reg_ini?>&fecha_pago_reg_fin=<?php echo $fecha_pago_reg_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></legend>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL INGRESO POR INTERESES</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL INGRESO POR REPARACIONES (PROPIETARIOS)</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL INGRESO POR REPARACIONES (ARRENDATARIO)</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL INGRESO POR SOLICITUD DE ESTUDIO</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL INGRESO POR COMISION DE ADMINISTRACION</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL INGRESO GESTION DE JURIDICA (COBRANZA)</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL INGRESO INMOBILIARIA (INGRESO_P)</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL INGRESO JURIDICA (INGRESO_P)</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL INGRESO ABOGADO YAMID (INGRESO_P)</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL INGRESO ABOGADO TRILLO (INGRESO_P)</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL INGRESOS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_ingreso_por_interes_inquilino, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_ingreso_por_reparaciones, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_ingreso_por_reparaciones_arrendatario, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_ingreso_por_solicitud_arriendo_inquilino, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_ingreso_por_comision_administarcion, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_otros_ingresos_juridica_arriendo, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_otros_ingresos_inmobil, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_otros_ingresos_juridica, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_otros_ingresos_abogado_yamid, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_otros_ingresos_abogado_trillo, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_ingreso, 0, ",", ".") ?></th>
            </tr>
        </tbody>
    </table>
</fieldset>

<hr>

<fieldset><legend>TOTAL EGRESOS <a href="../admin/descargar_reporte_general_total_egresos_inmobiliaria_spout_xlsx.php?fecha_pago_reg_ini=<?php echo $fecha_pago_reg_ini?>&fecha_pago_reg_fin=<?php echo $fecha_pago_reg_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></legend>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL EGRESO INMOBILIARIA (EGRESO_P)</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL EGRESO JURIDICA (EGRESO_P)</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL EGRESO ABOGADO YAMID (EGRESO_P)</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL EGRESO ABOGADO TRILLO (EGRESO_P)</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL EGRESOS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_otros_egresos_inmobil, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_otros_egresos_juridica, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_otros_egresos_abogado_yamid, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_otros_egresos_abogado_trillo, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_otros_egresos, 0, ",", ".") ?></th>
            </tr>
        </tbody>
    </table>
</fieldset>


<hr>

<fieldset><legend>TOTAL PAGOS <a href="../admin/descargar_reporte_general_total_pagos_inmobiliaria_spout_xlsx.php?fecha_pago_reg_ini=<?php echo $fecha_pago_reg_ini?>&fecha_pago_reg_fin=<?php echo $fecha_pago_reg_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></legend>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL VALOR PAGADO A PROPIETARIOS</th>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL VALOR PAGADO POR ARRENDATARIOS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_valor_pagado_a_propietario, 0, ",", ".") ?></th>
                <th style="text-align:center; font-size:11pt;"><?php echo number_format($total_recibido_pago_inquilino, 0, ",", ".") ?></th>
            </tr>
        </tbody>
    </table>
</fieldset>

<hr>

<fieldset><legend>PAGO DETALLADO A PROPIETARIOS <a href="../admin/descargar_reporte_general_pago_detallado_propietario_inmobiliaria_spout_xlsx.php?fecha_pago_reg_ini=<?php echo $fecha_pago_reg_ini?>&fecha_pago_reg_fin=<?php echo $fecha_pago_reg_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></legend>
    <table class="table table-striped">
    <thead>
    <tr>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">CONTRATO</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">PROPIETARIO | INMUEBLE</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">VALOR PAGADO</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">COMISION ADMINISTRACION</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">FECHA REG PAGO</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">ID</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $fecha_hoy                                         = date("Y-m-d");

    $sql_cuentas_cobrar_factura_comision_propietario = "SELECT cod_cuentas_cobrar_factura_comision_propietario, deduccion_comision, total_ingreso, 
    cod_tercero_propietario, fecha_pago_reg, cod_producto, nombre_producto, cod_administrador, hora_pago_reg, cod_factura, cod_tercero 
    FROM tbl15_cuentas_cobrar_factura_comision_propietario WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') 
    ORDER BY fecha_pago_reg DESC";
    $consulta_cuentas_cobrar_factura_comision_propietario = mysqli_query($conectar, $sql_cuentas_cobrar_factura_comision_propietario) or die(mysqli_error($conectar));
    while ($datos_cuentas_cobrar_factura_comision_propietario = mysqli_fetch_assoc($consulta_cuentas_cobrar_factura_comision_propietario)) {

    $cod_cuentas_cobrar_factura_comision_propietario   = $datos_cuentas_cobrar_factura_comision_propietario['cod_cuentas_cobrar_factura_comision_propietario'];
    $cod_factura                                       = $datos_cuentas_cobrar_factura_comision_propietario['cod_factura'];
    $cod_tercero_propietario                           = $datos_cuentas_cobrar_factura_comision_propietario['cod_tercero_propietario'];
    $fecha_pago_reg                                    = $datos_cuentas_cobrar_factura_comision_propietario['fecha_pago_reg'];
    $cod_producto                                      = $datos_cuentas_cobrar_factura_comision_propietario['cod_producto'];
    $nombre_producto                                   = $datos_cuentas_cobrar_factura_comision_propietario['nombre_producto'];
    $cod_administrador                                 = $datos_cuentas_cobrar_factura_comision_propietario['cod_administrador'];
    $hora_pago_reg                                     = $datos_cuentas_cobrar_factura_comision_propietario['hora_pago_reg'];
    $deduccion_comision                                = $datos_cuentas_cobrar_factura_comision_propietario['deduccion_comision'];
    $total_ingreso                                     = $datos_cuentas_cobrar_factura_comision_propietario['total_ingreso'];
    $cod_tercero                                       = $datos_cuentas_cobrar_factura_comision_propietario['cod_tercero'];

    $sql_propietario = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_propietario'";
    $consulta_propietario = mysqli_query($conectar, $sql_propietario) or die(mysqli_error($conectar));
    $datos_propietario = mysqli_fetch_assoc($consulta_propietario);

    $nombre_tercero                               = $datos_propietario['nombre1_tercero'].' '.$datos_propietario['apellido1_tercero'];

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];
    ?>
    <tr>
        <td style="text-align:center; font-size:11pt;"><?php echo ($cod_factura)?></td>
        <td style="text-align:left; font-size:11pt;"><?php echo $nombre_tercero?> | <?php echo $nombre_producto?></td>
        <td style="text-align:right; font-size:11pt;"><?php echo number_format($total_ingreso, 0, ",", ".") ?></td>
        <td style="text-align:right; font-size:11pt;"><?php echo number_format($deduccion_comision, 0, ",", ".") ?></td>
        <td style="text-align:center; font-size:11pt;"><?php echo date("d-m-Y", strtotime($fecha_pago_reg))?></td>
        <td style="text-align:center; font-size:11pt;"><?php echo $cod_cuentas_cobrar_factura_comision_propietario?></td>
    </tr>
    <?php } ?>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL</th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_valor_pagado_a_propietario, 0, ",", ".") ?></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_ingreso_por_comision_administarcion, 0, ",", ".") ?></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
    </tbody>
    </table>
</fieldset>

<hr>

<fieldset><legend>PAGO DETALLADO DE ARRENDATARIOS <a href="../admin/descargar_reporte_general_pago_detallado_arrendatario_inmobiliaria_spout_xlsx.php?fecha_pago_reg_ini=<?php echo $fecha_pago_reg_ini?>&fecha_pago_reg_fin=<?php echo $fecha_pago_reg_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></legend>
    <table class="table table-striped">
    <thead>
    <tr>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">CONTRATO</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">ARRENDATARIO | INMUEBLE</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">VALOR RECIBIDO</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">INTERESES</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">INGRESO JURIDICA (ARRIENDO)</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">FECHA REG PAGO</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">ID</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $fecha_hoy                                         = date("Y-m-d");

    $sql_total_tipo_factura = "SELECT cod_cuentas_cobrar_alerta, cod_factura, cod_tercero, fecha_pago_reg, cod_producto, nombre_producto, 
    total_recibido, monto_cuota_interes, cod_administrador, hora_pago_reg, cod_estado, ingreso_gasto_juridica
    FROM tbl15_cuentas_cobrar_alerta 
    WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (cod_estado = '1')
    ORDER BY fecha_pago_reg DESC";
    $consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
    while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

    $cod_cuentas_cobrar_alerta                         = $datos_total_tipo_factura['cod_cuentas_cobrar_alerta'];
    $cod_factura                                       = $datos_total_tipo_factura['cod_factura'];
    $cod_tercero                                       = $datos_total_tipo_factura['cod_tercero'];
    $fecha_pago_reg                                    = $datos_total_tipo_factura['fecha_pago_reg'];
    $cod_producto                                      = $datos_total_tipo_factura['cod_producto'];
    $nombre_producto                                   = $datos_total_tipo_factura['nombre_producto'];
    $total_recibido                                    = $datos_total_tipo_factura['total_recibido'];
    $monto_cuota_interes                               = $datos_total_tipo_factura['monto_cuota_interes'];
    $ingreso_gasto_juridica                            = $datos_total_tipo_factura['ingreso_gasto_juridica'];
    $cod_administrador                                 = $datos_total_tipo_factura['cod_administrador'];
    $hora_pago_reg                                     = $datos_total_tipo_factura['hora_pago_reg'];

    $sql_dependencia = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
    $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

    $nombre_tercero                               = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['apellido1_tercero'];

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];
    ?>
    <tr>
        <td style="text-align:center; font-size:11pt;"><?php echo ($cod_factura)?></td>
        <td style="text-align:left; font-size:11pt;"><?php echo $nombre_tercero?> | <?php echo $nombre_producto?></td>
        <td style="text-align:right; font-size:11pt;"><?php echo number_format($total_recibido, 0, ",", ".") ?></td>
        <td style="text-align:right; font-size:11pt;"><?php echo number_format($monto_cuota_interes, 0, ",", ".") ?></td>
        <td style="text-align:right; font-size:11pt;"><?php echo number_format($ingreso_gasto_juridica, 0, ",", ".") ?></td>
        <td style="text-align:center; font-size:11pt;"><?php echo date("d-m-Y", strtotime($fecha_pago_reg))?></td>
        <td style="text-align:center; font-size:11pt;"><?php echo $cod_cuentas_cobrar_alerta?></td>
    </tr>
    <?php } ?>
    <tr>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL</th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_recibido_pago_inquilino, 0, ",", ".") ?></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_ingreso_por_interes_inquilino, 0, ",", ".") ?></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_otros_ingresos_juridica_arriendo, 0, ",", ".") ?></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
    </tr>
    </tbody>
    </table>
</fieldset>

<hr>

<fieldset><legend>PAGOS SOLICITUD ARRIENDO <a href="../admin/descargar_reporte_general_pago_solicitud_arriendo_inmobiliaria_spout_xlsx.php?fecha_pago_reg_ini=<?php echo $fecha_pago_reg_ini?>&fecha_pago_reg_fin=<?php echo $fecha_pago_reg_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></legend>
    <table class="table table-striped">
    <thead>
    <tr>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">DOCUMENTO</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">ARRENDATARIO</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">VALOR RECIBIDO</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">FECHA</th>
        <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">COD</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sql_solicitud_arreiendo = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, cod_solicitud_arriendo, tiempo_contrato_solicitud_arriendo, 
    valor_solicitud_arriendo, fecha_solicitud_arriendo, nombre_estado_solicitud_arriendo, nombre_tipo_producto 
    FROM tbl15_tercero 
    WHERE (fecha_solicitud_arriendo BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_solicitud = '$nombre_tipo_solicitud')
    ORDER BY fecha_solicitud_arriendo DESC";
    $consulta_solicitud_arreiendo = mysqli_query($conectar, $sql_solicitud_arreiendo) or die(mysqli_error($conectar));
    while ($datos_solicitud_arreiendo = mysqli_fetch_assoc($consulta_solicitud_arreiendo)) {

    $cod_tercero                                       = $datos_solicitud_arreiendo['cod_tercero'];
    $identificacion_tercero                            = $datos_solicitud_arreiendo['identificacion_tercero'];
    $nombre1_tercero                                   = $datos_solicitud_arreiendo['nombre1_tercero'];
    $cod_solicitud_arriendo                            = $datos_solicitud_arreiendo['cod_solicitud_arriendo'];
    $tiempo_contrato_solicitud_arriendo                = $datos_solicitud_arreiendo['tiempo_contrato_solicitud_arriendo'];
    $valor_solicitud_arriendo                          = $datos_solicitud_arreiendo['valor_solicitud_arriendo'];
    $fecha_solicitud_arriendo                          = $datos_solicitud_arreiendo['fecha_solicitud_arriendo'];
    $nombre_estado_solicitud_arriendo                  = $datos_solicitud_arreiendo['nombre_estado_solicitud_arriendo'];
    $nombre_tipo_producto                              = $datos_solicitud_arreiendo['nombre_tipo_producto'];
    ?>
    <tr>
        <td style="text-align:center; font-size:11pt;"><?php echo ($identificacion_tercero)?></td>
        <td style="text-align:left; font-size:11pt;"><?php echo $nombre1_tercero?></td>
        <td style="text-align:right; font-size:11pt;"><?php echo number_format($valor_solicitud_arriendo, 0, ",", ".") ?></td>
        <td style="text-align:center; font-size:11pt;"><?php echo date("d-m-Y", strtotime($fecha_solicitud_arriendo))?></td>
        <td style="text-align:center; font-size:11pt;"><?php echo $cod_solicitud_arriendo?></td>
    </tr>
    <?php } ?>
    <tr>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL</th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_ingreso_por_solicitud_arriendo_inquilino, 0, ",", ".") ?></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
    </tr>
    </tbody>
    </table>
</fieldset>

<hr>

<fieldset><legend>GASTOS POR REPARACIONES PROPIETARIOS <a href="../admin/descargar_reporte_general_gastos_por_reparaciones_propietarios_inmobiliaria_spout_xlsx.php?fecha_pago_reg_ini=<?php echo $fecha_pago_reg_ini?>&fecha_pago_reg_fin=<?php echo $fecha_pago_reg_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></legend>
<table class="table table-striped">
        <thead>
            <tr>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">CONTRATO</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">PROPIETARIO | INMUEBLE</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">CONCEPTO</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">DESCRIPCION</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">COSTO FINAL (P.VENTA)</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">COSTO ADMINISTRACION DE REPARACION (P.COMPRA)</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">GANANCIA</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">FECHA</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">ID</th>
            </tr>
        </thead>
    <tbody>
<?php
$sql_total_tipo_factura = "SELECT * FROM tbl15_gasto_inmueble_detalle_venta 
WHERE (fecha_gasto_inmueble_detalle BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') 
ORDER BY cod_info_gasto_inmueble_detalle_venta DESC";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

$cod_gasto_inmueble_detalle_venta                  = $datos_total_tipo_factura['cod_gasto_inmueble_detalle_venta'];
$cod_info_gasto_inmueble_detalle_venta             = $datos_total_tipo_factura['cod_info_gasto_inmueble_detalle_venta'];
$cod_factura                                       = $datos_total_tipo_factura['cod_factura'];
$cod_tercero_propietario                           = $datos_total_tipo_factura['cod_tercero_propietario'];
$fecha_gasto_inmueble_detalle                      = $datos_total_tipo_factura['fecha_gasto_inmueble_detalle'];
$cod_administrador                                 = $datos_total_tipo_factura['cod_administrador'];
$nombre_gasto_inmueble_detalle                     = $datos_total_tipo_factura['nombre_gasto_inmueble_detalle'];
$descripcion_gasto_inmueble_detalle                = $datos_total_tipo_factura['descripcion_gasto_inmueble_detalle'];
$nombre_producto                                   = $datos_total_tipo_factura['nombre_producto'];
$precio_venta_producto                             = $datos_total_tipo_factura['precio_venta_producto'];
$precio_compra_producto                            = $datos_total_tipo_factura['precio_compra_producto'];
$total_ganancia                                    = $precio_venta_producto - $precio_compra_producto;

$cod_cuentas_cobrar_factura_comision_propietario   = $datos_total_tipo_factura['cod_cuentas_cobrar_factura_comision_propietario'];
$cod_cuentas_cobrar_alerta                         = $datos_total_tipo_factura['cod_cuentas_cobrar_alerta'];
$fecha_mes                                         = '';
$nombre_tabla_mes                                  = '';
$nombre_tabla_anyo                                 = '';
$cod_estado_pago                                   = '';
$cod_estado_aprobado                               = 1;
$pagina                                            = '';

$sql_dependencia = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_propietario'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_tercero                               = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['apellido1_tercero'];

$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                        = $datos_administrador['cuenta'];

$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero_propietario')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$cliente                             = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
$direccion_cli                       = $matriz_cliente['direccion_tercero'];
$nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
$digito_tercero                      = $matriz_cliente['digito_tercero'];
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }
?>
        <tr>
            <td style="text-align:center; font-size:11pt;"><?php echo ($cod_factura)?></td>
            <td style="text-align:left; font-size:11pt;"><?php echo $nombre_tercero?> | <?php echo $nombre_producto?></td>
            <td style="text-align:left; font-size:11pt;"><?php echo $nombre_gasto_inmueble_detalle?></td>
            <td style="text-align:left; font-size:11pt;"><?php echo $descripcion_gasto_inmueble_detalle?></td>
            <td style="text-align:right; font-size:11pt;"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
            <td style="text-align:right; font-size:11pt;"><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></td>
            <td style="text-align:right; font-size:11pt;"><?php echo number_format($total_ganancia, 0, ",", ".") ?></td>
            <td style="text-align:center; font-size:11pt;"><?php echo date("d-m-Y", strtotime($fecha_gasto_inmueble_detalle))?></td>
            <td style="text-align:center; font-size:11pt;"><?php echo $cod_info_gasto_inmueble_detalle_venta?></td>
        </tr>
<?php } ?>
    <tr>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL</th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($sum_precio_venta_producto, 0, ",", ".") ?></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($sum_precio_compra_producto, 0, ",", ".") ?></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_ingreso_por_reparaciones, 0, ",", ".") ?></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
    </tr>
    </tbody>
</table>
</fieldset>

<hr>

<fieldset><legend>GASTOS POR REPARACIONES ARRENDATARIOS <a href="../admin/descargar_reporte_general_gastos_por_reparaciones_arrendatarios_inmobiliaria_spout_xlsx.php?fecha_pago_reg_ini=<?php echo $fecha_pago_reg_ini?>&fecha_pago_reg_fin=<?php echo $fecha_pago_reg_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></legend>
<table class="table table-striped">
        <thead>
            <tr>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">CONTRATO</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">ARRENDATARIO | INMUEBLE</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">CONCEPTO</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">DESCRIPCION</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">COSTO FINAL (P.VENTA)</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">COSTO ADMINISTRACION DE REPARACION (P.COMPRA)</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">GANANCIA</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">FECHA</th>
            <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">ID</th>
            </tr>
        </thead>
    <tbody>
<?php
$total_precio_venta_producto                       = 0;
$total_precio_compra_producto                      = 0;
$total_ingreso_por_reparaciones                    = 0;

$sql_gasto_inmueble_inquilino_venta = "SELECT * FROM tbl15_gasto_inmueble_inquilino_venta 
WHERE (fecha_gasto_inmueble_detalle BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') 
ORDER BY cod_info_gasto_inmueble_inquilino_venta DESC";
$consulta_gasto_inmueble_inquilino_venta = mysqli_query($conectar, $sql_gasto_inmueble_inquilino_venta) or die(mysqli_error($conectar));
while ($datos_gasto_inmueble_inquilino_venta = mysqli_fetch_assoc($consulta_gasto_inmueble_inquilino_venta)) {

$cod_gasto_inmueble_inquilino_venta                = $datos_gasto_inmueble_inquilino_venta['cod_gasto_inmueble_inquilino_venta'];
$cod_info_gasto_inmueble_inquilino_venta           = $datos_gasto_inmueble_inquilino_venta['cod_info_gasto_inmueble_inquilino_venta'];
$cod_factura                                       = $datos_gasto_inmueble_inquilino_venta['cod_factura'];
$cod_tercero                                       = $datos_gasto_inmueble_inquilino_venta['cod_tercero'];
$cod_tercero_propietario                           = $datos_gasto_inmueble_inquilino_venta['cod_tercero_propietario'];
$fecha_gasto_inmueble_detalle                      = $datos_gasto_inmueble_inquilino_venta['fecha_gasto_inmueble_detalle'];
$cod_administrador                                 = $datos_gasto_inmueble_inquilino_venta['cod_administrador'];
$nombre_gasto_inmueble_detalle                     = $datos_gasto_inmueble_inquilino_venta['nombre_gasto_inmueble_detalle'];
$descripcion_gasto_inmueble_detalle                = $datos_gasto_inmueble_inquilino_venta['descripcion_gasto_inmueble_detalle'];
$nombre_producto                                   = $datos_gasto_inmueble_inquilino_venta['nombre_producto'];
$precio_venta_producto                             = $datos_gasto_inmueble_inquilino_venta['precio_venta_producto'];
$precio_compra_producto                            = $datos_gasto_inmueble_inquilino_venta['precio_compra_producto'];
$total_ganancia                                    = $precio_venta_producto - $precio_compra_producto;
$cod_cuentas_cobrar_factura_comision_propietario   = $datos_gasto_inmueble_inquilino_venta['cod_cuentas_cobrar_factura_comision_propietario'];
$cod_cuentas_cobrar_alerta                         = $datos_gasto_inmueble_inquilino_venta['cod_cuentas_cobrar_alerta'];
$fecha_mes                                         = '';
$nombre_tabla_mes                                  = '';
$nombre_tabla_anyo                                 = '';
$cod_estado_pago                                   = '';
$cod_estado_aprobado                               = 1;
$pagina                                            = '';

$sql_dependencia = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_tercero                               = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['apellido1_tercero'];

$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                        = $datos_administrador['cuenta'];

$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero_propietario')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$cliente                             = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
$direccion_cli                       = $matriz_cliente['direccion_tercero'];
$nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
$digito_tercero                      = $matriz_cliente['digito_tercero'];
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }

$total_precio_venta_producto        += $precio_venta_producto;
$total_precio_compra_producto       += $precio_compra_producto;
$total_ingreso_por_reparaciones     += $total_ganancia;
?>
        <tr>
            <td style="text-align:center; font-size:11pt;"><?php echo ($cod_factura)?></td>
            <td style="text-align:left; font-size:11pt;"><?php echo $nombre_tercero?> | <?php echo $nombre_producto?></td>
            <td style="text-align:left; font-size:11pt;"><?php echo $nombre_gasto_inmueble_detalle?></td>
            <td style="text-align:left; font-size:11pt;"><?php echo $descripcion_gasto_inmueble_detalle?></td>
            <td style="text-align:right; font-size:11pt;"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
            <td style="text-align:right; font-size:11pt;"><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></td>
            <td style="text-align:right; font-size:11pt;"><?php echo number_format($total_ganancia, 0, ",", ".") ?></td>
            <td style="text-align:center; font-size:11pt;"><?php echo date("d-m-Y", strtotime($fecha_gasto_inmueble_detalle))?></td>
            <td style="text-align:center; font-size:11pt;"><?php echo $cod_info_gasto_inmueble_inquilino_venta?></td>
        </tr>
<?php } ?>
    <tr>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL</th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_precio_venta_producto, 0, ",", ".") ?></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_precio_compra_producto, 0, ",", ".") ?></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_ingreso_por_reparaciones, 0, ",", ".") ?></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:right; font-size:11pt; background-color:#DBE0F3; color:#000;"></th>
    </tr>
    </tbody>
</table>
</fieldset>

<hr>

<fieldset><legend>INGRESOS DETALLADO (INGRESOS) <a href="../admin/descargar_reporte_general_ingresos_detallado_inmobiliaria_spout_xlsx.php?fecha_pago_reg_ini=<?php echo $fecha_pago_reg_ini?>&fecha_pago_reg_fin=<?php echo $fecha_pago_reg_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></legend>
    <table class="table table-striped">
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">CONCEPTO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">VALOR</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">OBSERVACION</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">DEPENDENCIA</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">TIPO PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">FECHA</th>
        </tr>
<?php
$total_costo_ingreso                    = 0;
$incre_ingreso                          = 0;

$sql_ingreso = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO') ORDER BY cod_egreso DESC";
$resultado_ingreso = mysqli_query($conectar, $sql_ingreso) or die(mysqli_error($conectar));
$total_ingreso = mysqli_num_rows($resultado_ingreso);
while ($info_ingreso = mysqli_fetch_assoc($resultado_ingreso)) {

$cod_egreso                             = $info_ingreso['cod_egreso'];
$conceptos                              = $info_ingreso['conceptos'];
$costo                                  = $info_ingreso['costo'];
$comentario                             = $info_ingreso['comentario'];
$cod_concepto_movimiento_caja           = $info_ingreso['cod_concepto_movimiento_caja'];
$nombre_concepto_movimiento_caja        = $info_ingreso['nombre_concepto_movimiento_caja'];
$cod_tipo_puc                           = $info_ingreso['cod_tipo_puc'];
//$nombre_tipo_puc                        = $info_ingreso['nombre_tipo_puc'];
$simbolo_tipo_operacion                 = $info_ingreso['simbolo_tipo_operacion'];
$cod_tipo_forma_pago_db                 = $info_ingreso['cod_tipo_forma_pago'];
$fecha_dmy                              = $info_ingreso['fecha_dmy'];
$cod_cuentas_pagar                      = $info_ingreso['cod_cuentas_pagar'];
$cod_tercero                            = $info_ingreso['cod_tercero'];
$cod_dependencia_db                     = $info_ingreso['cod_dependencia'];
$url_img_orig_producto                  = $info_ingreso['url_img_orig_producto'];
$url_img_min_producto                   = $info_ingreso['url_img_min_producto'];
$total_costo_ingreso                   += $costo;
$incre_ingreso++;
//---------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------//
$sql_concepto_movimiento_caja = "SELECT * FROM tbl15_concepto_movimiento_caja WHERE (cod_concepto_movimiento_caja = '$cod_concepto_movimiento_caja')";
$resultado_concepto_movimiento_caja = mysqli_query($conectar, $sql_concepto_movimiento_caja) or die(mysqli_error($conectar));
$info_concepto_movimiento_caja = mysqli_fetch_assoc($resultado_concepto_movimiento_caja);

$nombre_concepto_movimiento_caja      = $info_concepto_movimiento_caja['nombre_concepto_movimiento_caja'];
//$nombre_tipo_puc                      = $info_concepto_movimiento_caja['nombre_tipo_puc'];
$simbolo_tipo_operacion               = $info_concepto_movimiento_caja['simbolo_tipo_operacion'];
//---------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------//
$sql_dependencia = "SELECT * FROM tbl15_dependencia WHERE (cod_dependencia = '$cod_dependencia_db')";
$resultado_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$info_dependencia = mysqli_fetch_assoc($resultado_dependencia);

$nombre_dependencia                   = $info_dependencia['nombre_dependencia'];
//---------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------//
$sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago_db')";
$resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);

$nombre_tipo_forma_pago               = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
?>
        <tr>
            <td style="text-align:left; font-size:11pt;"><?php echo $nombre_concepto_movimiento_caja?></td>
            <td style="text-align:right; font-size:11pt;"><?php echo number_format($costo, 0, ",", ".") ?></td>
            <td style="text-align:left; font-size:11pt;"><?php echo $comentario?></td>
            <td style="text-align:center; font-size:11pt;"><?php echo $nombre_dependencia?></td>
            <td style="text-align:center; font-size:11pt;"><?php echo $nombre_tipo_forma_pago?></td>
            <td style="text-align:center; font-size:11pt;"><?php echo date("d-m-Y", strtotime($fecha_dmy))?></td>
        </tr>
<?php } ?>
        <tr>
            <th style="text-align:right; background-color:#DBE0F3; color:#000;">TOTAL</th>
            <th style="text-align:right; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_otros_ingresos, 0, ",", ".") ?></th>
            <th style="text-align:right; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:right; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:right; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:right; background-color:#DBE0F3; color:#000;"></th>
        </tr>
    </table>
</fieldset>


<fieldset><legend>GASTOS DETALLADO (EGRESOS) <a href="../admin/descargar_reporte_general_gastos_detallado_inmobiliaria_spout_xlsx.php?fecha_pago_reg_ini=<?php echo $fecha_pago_reg_ini?>&fecha_pago_reg_fin=<?php echo $fecha_pago_reg_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></legend>
    <table class="table table-striped">
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">CONCEPTO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">VALOR</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">OBSERVACION</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">DEPENDENCIA</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">TIPO PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">FECHA</th>
        </tr>
<?php
$total_costo_ingreso                    = 0;
$incre_ingreso                          = 0;

$sql_ingreso = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'EGRESO') ORDER BY cod_egreso DESC";
$resultado_ingreso = mysqli_query($conectar, $sql_ingreso) or die(mysqli_error($conectar));
$total_ingreso = mysqli_num_rows($resultado_ingreso);
while ($info_ingreso = mysqli_fetch_assoc($resultado_ingreso)) {

$cod_egreso                             = $info_ingreso['cod_egreso'];
$conceptos                              = $info_ingreso['conceptos'];
$costo                                  = $info_ingreso['costo'];
$comentario                             = $info_ingreso['comentario'];
$cod_concepto_movimiento_caja           = $info_ingreso['cod_concepto_movimiento_caja'];
$nombre_concepto_movimiento_caja        = $info_ingreso['nombre_concepto_movimiento_caja'];
$cod_tipo_puc                           = $info_ingreso['cod_tipo_puc'];
//$nombre_tipo_puc                        = $info_ingreso['nombre_tipo_puc'];
$simbolo_tipo_operacion                 = $info_ingreso['simbolo_tipo_operacion'];
$cod_tipo_forma_pago_db                 = $info_ingreso['cod_tipo_forma_pago'];
$fecha_dmy                              = $info_ingreso['fecha_dmy'];
$cod_cuentas_pagar                      = $info_ingreso['cod_cuentas_pagar'];
$cod_tercero                            = $info_ingreso['cod_tercero'];
$cod_dependencia_db                     = $info_ingreso['cod_dependencia'];
$url_img_orig_producto                  = $info_ingreso['url_img_orig_producto'];
$url_img_min_producto                   = $info_ingreso['url_img_min_producto'];
$total_costo_ingreso                   += $costo;
$incre_ingreso++;
//---------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------//
$sql_concepto_movimiento_caja = "SELECT * FROM tbl15_concepto_movimiento_caja WHERE (cod_concepto_movimiento_caja = '$cod_concepto_movimiento_caja')";
$resultado_concepto_movimiento_caja = mysqli_query($conectar, $sql_concepto_movimiento_caja) or die(mysqli_error($conectar));
$info_concepto_movimiento_caja = mysqli_fetch_assoc($resultado_concepto_movimiento_caja);

$nombre_concepto_movimiento_caja      = $info_concepto_movimiento_caja['nombre_concepto_movimiento_caja'];
//$nombre_tipo_puc                      = $info_concepto_movimiento_caja['nombre_tipo_puc'];
$simbolo_tipo_operacion               = $info_concepto_movimiento_caja['simbolo_tipo_operacion'];
//---------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------//
$sql_dependencia = "SELECT * FROM tbl15_dependencia WHERE (cod_dependencia = '$cod_dependencia_db')";
$resultado_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$info_dependencia = mysqli_fetch_assoc($resultado_dependencia);

$nombre_dependencia                   = $info_dependencia['nombre_dependencia'];
//---------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------//
$sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago_db')";
$resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);

$nombre_tipo_forma_pago               = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
?>
        <tr>
            <td style="text-align:left; font-size:11pt;"><?php echo $nombre_concepto_movimiento_caja?></td>
            <td style="text-align:right; font-size:11pt;"><?php echo number_format($costo, 0, ",", ".") ?></td>
            <td style="text-align:left; font-size:11pt;"><?php echo $comentario?></td>
            <td style="text-align:center; font-size:11pt;"><?php echo $nombre_dependencia?></td>
            <td style="text-align:center; font-size:11pt;"><?php echo $nombre_tipo_forma_pago?></td>
            <td style="text-align:center; font-size:11pt;"><?php echo date("d-m-Y", strtotime($fecha_dmy))?></td>
        </tr>
<?php } ?>
        <tr>
            <th style="text-align:right; background-color:#DBE0F3; color:#000;">TOTAL</th>
            <th style="text-align:right; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_costo_ingreso, 0, ",", ".") ?></th>
            <th style="text-align:right; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:right; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:right; background-color:#DBE0F3; color:#000;"></th>
            <th style="text-align:right; background-color:#DBE0F3; color:#000;"></th>
        </tr>
    </table>
</fieldset>


<hr>


<fieldset><legend>TOTAL GASTOS (EGRESOS DEPENDENCIA) <a href="../admin/descargar_reporte_general_total_gastos_por_dependencia_inmobiliaria_spout_xlsx.php?fecha_pago_reg_ini=<?php echo $fecha_pago_reg_ini?>&fecha_pago_reg_fin=<?php echo $fecha_pago_reg_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></legend>
    <table class="table table-striped">
        <thead>
<?php
$total_egresos_dependencia = 0;

$sql_egreso_inmobil = "SELECT SUM(costo) AS egresos_dependencia, cod_dependencia FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'EGRESO') GROUP BY cod_dependencia";
$resultado_egreso_inmobil = mysqli_query($conectar, $sql_egreso_inmobil) or die(mysqli_error($conectar));
while ($info_egreso_inmobil = mysqli_fetch_assoc($resultado_egreso_inmobil)) {

$egresos_dependencia                = $info_egreso_inmobil['egresos_dependencia'];
$cod_dependencia                    = $info_egreso_inmobil['cod_dependencia'];
$total_egresos_dependencia         += $egresos_dependencia;

$sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE (cod_dependencia = '$cod_dependencia')";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_dependencia                 = $datos_dependencia['nombre_dependencia'];
?>
        </thead>
        <tbody>
            <tr>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000; width:50%"><?php echo $nombre_dependencia ?></th>
                <th style="text-align:left; font-size:11pt; width:50%"><?php echo number_format($egresos_dependencia, 0, ",", ".") ?></th>
            </tr>
        </tbody>
<?php } ?>
            <tr>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL</th>
                <th style="text-align:left; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_egresos_dependencia, 0, ",", ".") ?></th>
            </tr>
    </table>
</fieldset>

<hr>

<fieldset><legend>TOTAL INGRESOS (INGRESOS DEPENDENCIA) <a href="../admin/descargar_reporte_general_total_ingresos_por_dependencia_inmobiliaria_spout_xlsx.php?fecha_pago_reg_ini=<?php echo $fecha_pago_reg_ini?>&fecha_pago_reg_fin=<?php echo $fecha_pago_reg_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></legend>
    <table class="table table-striped">
        <thead>
<?php
$total_ingresos_dependencia = 0;

$sql_egreso_inmobil = "SELECT SUM(costo) AS ingresos_dependencia, cod_dependencia FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO') GROUP BY cod_dependencia";
$resultado_egreso_inmobil = mysqli_query($conectar, $sql_egreso_inmobil) or die(mysqli_error($conectar));
while ($info_egreso_inmobil = mysqli_fetch_assoc($resultado_egreso_inmobil)) {

$ingresos_dependencia                = $info_egreso_inmobil['ingresos_dependencia'];
$cod_dependencia                    = $info_egreso_inmobil['cod_dependencia'];
$total_ingresos_dependencia         += $ingresos_dependencia;

$sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE (cod_dependencia = '$cod_dependencia')";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_dependencia                 = $datos_dependencia['nombre_dependencia'];
?>
        </thead>
        <tbody>
            <tr>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000; width:50%"><?php echo $nombre_dependencia ?></th>
                <th style="text-align:left; font-size:11pt; width:50%"><?php echo number_format($ingresos_dependencia, 0, ",", ".") ?></th>
            </tr>
        </tbody>
<?php } ?>
            <tr>
                <th style="text-align:center; font-size:11pt; background-color:#DBE0F3; color:#000;">TOTAL</th>
                <th style="text-align:left; font-size:11pt; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_ingresos_dependencia, 0, ",", ".") ?></th>
            </tr>
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