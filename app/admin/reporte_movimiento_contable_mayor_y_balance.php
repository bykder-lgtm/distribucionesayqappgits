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
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Reporte Movimientos Contables Por Rango de Fechas</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<?php
$seleccionado                      = 0;

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
    $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
    $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
    if (isset($_GET['cod_tercero'])) { $cod_tercero = intval($_GET['cod_tercero']); } else { $cod_tercero = '0'; }
    if (isset($_GET['nombre_tipo_documento'])) { $nombre_tipo_documento = addslashes($_GET['nombre_tipo_documento']); } else { $nombre_tipo_documento = ''; }
    $fecha                                   = date("Y-m-d");
} else {
    $fecha_ymd_venta_producto_ini            = date("Y-m-d");
    $fecha_ymd_venta_producto_fin            = date("Y-m-d");
    $cod_tercero                             = "0";
    $nombre_tipo_documento                   = "";
    $fecha                                   = date("Y-m-d");
}


if ($cod_tercero==0) {
    $nombre_tercero_get                                  = 'TODOS';
} else {
    $sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido2_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

    $nombre_tercero_get                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido2_tercero'];
}

if ($nombre_tipo_documento=='0') {
    $nombre_tipo_documento_get                            = 'TODOS';
} else {
    $sql_tipo_factura  = "SELECT nombre_tipo_documento FROM tbl15_tipo_documento WHERE nombre_tipo_documento = '$nombre_tipo_documento'";
    $consulta_tipo_factura  = mysqli_query($conectar, $sql_tipo_factura ) or die(mysqli_error($conectar));
    $datos_tipo_factura  = mysqli_fetch_assoc($consulta_tipo_factura );

    $nombre_tipo_documento_get                            = $datos_tipo_factura['nombre_tipo_documento'];
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
<!--
    <th style="text-align:center;">TERCERO</th>
    <th style="text-align:center;">TIPO MOVIMIENTO</th>
-->
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
  </tr>
  <tr>
<!--
    <td style="text-align:center;">
        <select name="cod_tercero" id="cod_tercero" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;">
        <select name="nombre_tipo_documento" id="nombre_tipo_documento" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_documento)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT nombre_tipo_documento FROM tbl15_tipo_documento WHERE (cod_estado = '1') ORDER BY nombre_tipo_documento ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_documento) AND $nombre_tipo_documento == $datos2['nombre_tipo_documento']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_documento'];
            $nombre = $datos2['nombre_tipo_documento'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
-->
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" required/></td>
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

    if ($cod_tercero==0) {
        $filtro_consulta_tercero = "";
        $filtro_consulta_tercero_rel = "";
        $nombre_tercero_get                                  = 'TODOS';
    } else {
        $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
        $filtro_consulta_tercero_rel = "AND (cod_tercero = '$cod_tercero')";

        $sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
        $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
        $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

        $nombre_tercero_get                                  = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['nombre2_tercero'].' '.$datos_tercero['apellido1_tercero'].' '.$datos_tercero['apellido2_tercero'];
    }

    if ($nombre_tipo_documento=='0') {
        $filtro_consulta_tipo_documento = "";
        $filtro_consulta_tipo_documento_rel = "";
    } else {
        $filtro_consulta_tipo_documento = "AND (nombre_tipo_documento = '$nombre_tipo_documento')";
        $filtro_consulta_tipo_documento_rel = "AND (nombre_tipo_documento = '$nombre_tipo_documento')";
    }
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<table class="table table-striped">
    <tr>
<!--
        <td style="text-align:center;">TERCERO: <?php echo $nombre_tercero_get ?></td>
        <td style="text-align:center;">TIPO MOVIMIENTO: <?php echo $nombre_tipo_documento_get ?></td>
-->
        <td style="text-align:center;">FECHA INICAL: <?php echo $fecha_ymd_venta_producto_ini ?></td>
        <td style="text-align:center;">FECHA FINAL: <?php echo $fecha_ymd_venta_producto_fin ?></td>
    </tr>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<!--
<hr>
<table class="table table-striped">
    <tr>
        <td style="text-align:center;"><a href="../admin/reporte_movimiento_contable_pdf.php?cod_tercero=<?php echo $cod_tercero?>&nombre_tipo_documento=<?php echo $nombre_tipo_documento?>&fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>" target="_blank"><img src=../imagenes/imprimir_.png alt="imprimir_peq"></a></td>
    </tr>
</table>
-->
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<hr>
<?php
$increment                                          = 0;

$obtener_info_movimiento_contable_concepto = "SELECT cod_puc, codigo_puc, nombre_puc, tipo_puc FROM tbl15_movimiento_contable_concepto 
WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') GROUP BY cod_puc ORDER BY tipo_puc ASC";
$resultado_info_movimiento_contable_concepto = mysqli_query($conectar, $obtener_info_movimiento_contable_concepto) or die(mysqli_error($conectar));
while ($info_movimiento_contable_concepto = mysqli_fetch_assoc($resultado_info_movimiento_contable_concepto)) {

    $cod_puc                                        = $info_movimiento_contable_concepto['cod_puc'];
    $codigo_puc                                     = $info_movimiento_contable_concepto['codigo_puc'];
    $nombre_puc                                     = $info_movimiento_contable_concepto['nombre_puc'];
    $tipo_puc                                       = $info_movimiento_contable_concepto['tipo_puc'];

    $datos_puc_agrupados[$increment] = array("cod_puc"=>$cod_puc, "codigo_puc"=>$codigo_puc, "nombre_puc"=>$nombre_puc, "tipo_puc"=>$tipo_puc);
    $increment++;
}
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Cuenta</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Descripción</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Movimiento Debitos</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Movimiento Creditos</a></th>
        </tr>
    </thead>
<tbody>
<?php
$total_costo_movimiento_contable_debito         = 0;
$total_costo_movimiento_contable_credito        = 0;

foreach ($datos_puc_agrupados as $datos_puc) {
    $cod_puc                                        = $datos_puc["cod_puc"];
    $codigo_puc                                     = $datos_puc["codigo_puc"];
    $nombre_puc                                     = $datos_puc["nombre_puc"];
    $tipo_puc                                       = $datos_puc["tipo_puc"];

    $obtener_info_movimiento_contable_concepto_debito = "SELECT total_costo_movimiento_contable FROM tbl15_movimiento_contable_concepto 
    WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (nombre_tipo_movimiento = 'DEBITOS') AND (cod_puc = '$cod_puc')";
    $resultado_info_movimiento_contable_concepto_debito = mysqli_query($conectar, $obtener_info_movimiento_contable_concepto_debito) or die(mysqli_error($conectar));
    $info_movimiento_contable_concepto_debito = mysqli_fetch_assoc($resultado_info_movimiento_contable_concepto_debito);

    $total_costo_movimiento_contable_debito         = $info_movimiento_contable_concepto_debito['total_costo_movimiento_contable'];

    $obtener_info_movimiento_contable_concepto_credito = "SELECT total_costo_movimiento_contable FROM tbl15_movimiento_contable_concepto 
    WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (nombre_tipo_movimiento = 'CREDITOS') AND (cod_puc = '$cod_puc')";
    $resultado_info_movimiento_contable_concepto_credito = mysqli_query($conectar, $obtener_info_movimiento_contable_concepto_credito) or die(mysqli_error($conectar));
    $info_movimiento_contable_concepto_credito = mysqli_fetch_assoc($resultado_info_movimiento_contable_concepto_credito);

    $total_costo_movimiento_contable_credito         = $info_movimiento_contable_concepto_credito['total_costo_movimiento_contable'];
?>
    <tr>
        <td style="text-align:left"><?php echo $codigo_puc?></td>
        <td style="text-align:left"><?php echo $nombre_puc?></td>
        <td style="text-align:right"><?php echo number_format($total_costo_movimiento_contable_debito, 0, ",", ".") ?></td>
        <td style="text-align:right"><?php echo number_format($total_costo_movimiento_contable_credito, 0, ",", ".") ?></td>
    </tr>
<?php } ?>
</tbody>
</table>

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

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
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
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>