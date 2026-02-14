<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">

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
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
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
<a class="btn btn-primary" href="#"><h6>Movimientos de Caja</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_egreso_movimiento_caja';
$tipo                        = 'eliminar';
$campo                       = 'cod_egreso';
$fecha                       = date("Ymd");
$origen                      = 'PARACLINICOS';

$time_seg                    = time();
$time_date_ymd               = strtotime(date("Y/m/d"));
$hora                        = date("His");
$fecha_venta_ymd             = date("Ymd");
$hora_venta_his              = date("His");

if (isset($_GET['fecha_dmy_ini'])) {
    $fecha_dmy_ini                           = addslashes($_GET['fecha_dmy_ini']);
    $fecha_dmy_fin                           = addslashes($_GET['fecha_dmy_fin']);

    $sql_total_egreso = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin')";
    $consulta_total_egreso = mysqli_query($conectar, $sql_total_egreso) or die(mysqli_error($conectar));
    $datos_total_egreso = mysqli_fetch_assoc($consulta_total_egreso);

    $total_egreso                            = $datos_total_egreso['costo'];

    $sql_total_ingreso = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') AND (nombre_tipo_puc = 'INGRESOS')";
    $consulta_total_ingreso = mysqli_query($conectar, $sql_total_ingreso) or die(mysqli_error($conectar));
    $datos_total_ingreso = mysqli_fetch_assoc($consulta_total_ingreso);

    $total_ingreso                            = $datos_total_ingreso['costo'];

    $sql_total_gasto = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') AND (nombre_tipo_puc = 'EGRESOS')";
    $consulta_total_gasto = mysqli_query($conectar, $sql_total_gasto) or die(mysqli_error($conectar));
    $datos_total_gasto = mysqli_fetch_assoc($consulta_total_gasto);

    $total_gasto                             = $datos_total_gasto['costo'];
} else {
    $fecha_dmy_ini                           = date("Y-m-d");
    $fecha_dmy_fin                           = date("Y-m-d");

    $sql_total_egreso = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin')";
    $consulta_total_egreso = mysqli_query($conectar, $sql_total_egreso) or die(mysqli_error($conectar));
    $datos_total_egreso = mysqli_fetch_assoc($consulta_total_egreso);

    $total_egreso                            = $datos_total_egreso['costo'];

    $sql_total_ingreso = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') AND (nombre_tipo_puc = 'INGRESOS')";
    $consulta_total_ingreso = mysqli_query($conectar, $sql_total_ingreso) or die(mysqli_error($conectar));
    $datos_total_ingreso = mysqli_fetch_assoc($consulta_total_ingreso);

    $total_ingreso                            = $datos_total_ingreso['costo'];

    $sql_total_gasto = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') AND (nombre_tipo_puc = 'EGRESOS')";
    $consulta_total_gasto = mysqli_query($conectar, $sql_total_gasto) or die(mysqli_error($conectar));
    $datos_total_gasto = mysqli_fetch_assoc($consulta_total_gasto);

    $total_gasto                             = $datos_total_gasto['costo'];
}

$sql_movimiento_caja = "SELECT SUM(total_saldo) AS total_saldo, total_compra_producto, total_venta_producto, fecha_ymd_movimiento_caja FROM tbl15_movimiento_caja";
$consulta_movimiento_caja = mysqli_query($conectar, $sql_movimiento_caja) or die(mysqli_error($conectar));
$datos_movimiento_caja = mysqli_fetch_assoc($consulta_movimiento_caja);

$total_compra_producto                 = $datos_movimiento_caja['total_compra_producto'];
$total_venta_producto                  = $datos_movimiento_caja['total_venta_producto'];
$total_saldo                           = $datos_movimiento_caja['total_saldo'];
?>
<br>
<table class="table table-striped">
    <tr>
        <?php if ($cod_estado_egreso_registrar == '1') { ?>
        <th style="text-align:left">
            <?php if ($cod_seguridad == '1') { ?><a href="../admin/edit_movimiento_caja.php?cod_movimiento_caja=1&pagina=<?php echo $pagina ?>">.</a><?php } ?>
            <a href="../admin/reg_egreso_movimiento_caja.php"><font size='+2'>AGREGAR NUEVO MOVIMIENTO</font></a></th>
        <th style="text-align:left"><font size='+2'>TOTAL SALDO CAJAS: <?php echo number_format($total_saldo, 0, ",", ".") ?></font></th>
        <?php } ?>
        <!--<th style="text-align:right"><a href="../admin/reg_concepto_egreso_movimiento_caja.php"><font size='+2'>AGREGAR NUEVO CONCEPTO DE MOVIMIENTO</font></a></th>-->
    </tr>
</table>

<div class="table-responsive">

<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:right;">FECHA INI: </td>
    <td style="text-align:left;"><input class="input-block-level" name="fecha_dmy_ini" type="date" value="<?php echo $fecha_dmy_ini ?>" required/></td>
  </tr>
  <tr>
    <td style="text-align:right;">FECHA FIN: </td>
    <td style="text-align:left;"><input class="input-block-level" name="fecha_dmy_fin" type="date" value="<?php echo $fecha_dmy_fin ?>" required/></td>
  </tr>
  <tr>
    <td style="text-align:right;"></td>
    <td style="text-align:left;"><button type="submit">Ver Registros</button></td>
  </tr>
</table>
</form>

<?php if (isset($_GET['fecha_dmy_ini'])) { ?>

<table class="table table-striped">
    <tr>
        <th style="text-align:center"><font size='+1'>TOTAL INGRESO</font></th>
        <th style="text-align:center"><font size='+1'>TOTAL EGRESO</font></th>
        <th style="text-align:center"><font size='+1'>EXPORTAR CSV</font></th>

        <?php if ($cod_estado_egreso_imprimir == '1') { ?>
        <th style="text-align:center"><font size='+1'>IMPRIMIR</font></th>
        <?php } ?>
        <!--<th style="text-align:center"><font size='+1'>DESCARGAR</font></th>-->
    </tr>
    <tr>
        <th style="text-align:center"><font size='+1'><?php echo number_format($total_ingreso, 0, ",", ".") ?></font></a></th>
        <th style="text-align:center"><font size='+1'><?php echo number_format($total_gasto, 0, ",", ".") ?></font></a></th>
        <td style="text-align:center"><a href="../admin/descargar_movimiento_caja_puntoycoma_csv.php?fecha_dmy_ini=<?php echo $fecha_dmy_ini?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin?>"><img src=../imagenes/btn_csv.png alt="btn_csv"></a></td>
        <?php if ($cod_estado_egreso_imprimir == '1') { ?>
        <th style="text-align:center"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></th>
        <?php } ?>
        <!--<td style="text-align:center;"><a href="../admin/descargar_egreso_generales_pos_xlsx.php?fecha_dmy_ini=<?php echo $fecha_dmy_ini?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></td>-->
    </tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <?php if ($cod_estado_egreso_eliminar == '1') { ?>
        <th style="text-align:center">ELM</th>
        <?php } ?>
        <th style="text-align:center">CONCEPTO</th>
        <th style="text-align:center">VALOR</th>
        <th style="text-align:center">COMENTARIO</th>
        <th style="text-align:center">C.COSTO</th>
        <th style="text-align:center"></th>
        <th style="text-align:center">FECHA</th>
        <th style="text-align:center">ID</th>
        <?php if ($cod_estado_egreso_editar == '1') { ?>
        <!--<th style="text-align:center">EDIT</th>-->
        <?php } ?>
    </tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') ORDER BY cod_egreso DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

    $cod_egreso                          = $info_info_factura['cod_egreso'];
    $cod_concepto_movimiento_caja        = $info_info_factura['cod_concepto_movimiento_caja'];
    $cod_tipo_forma_pago                 = $info_info_factura['cod_tipo_forma_pago'];
    $conceptos                           = $info_info_factura['conceptos'];
    $costo                               = $info_info_factura['costo'];
    $comentario                          = $info_info_factura['comentario'];
    $fecha_dmy                           = $info_info_factura['fecha_dmy'];
    $nombre_ccosto                       = $info_info_factura['nombre_ccosto'];
    $cod_cuentas_pagar                   = $info_info_factura['cod_cuentas_pagar'];
    $nombre_cuenta_pagar                 = $info_info_factura['nombre_cuenta_pagar'];
    //---------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------//
    $sql_concepto_movimiento_caja = "SELECT * FROM tbl15_concepto_movimiento_caja WHERE (cod_concepto_movimiento_caja = '$cod_concepto_movimiento_caja')";
    $resultado_concepto_movimiento_caja = mysqli_query($conectar, $sql_concepto_movimiento_caja) or die(mysqli_error($conectar));
    $info_concepto_movimiento_caja = mysqli_fetch_assoc($resultado_concepto_movimiento_caja);

    $nombre_concepto_movimiento_caja      = $info_concepto_movimiento_caja['nombre_concepto_movimiento_caja'];
    $nombre_tipo_puc                      = $info_concepto_movimiento_caja['nombre_tipo_puc'];
    $simbolo_tipo_operacion               = $info_concepto_movimiento_caja['simbolo_tipo_operacion'];
    //---------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------//
    $sql_cuentas_pagar = "SELECT cod_factura, cod_tercero FROM tbl15_cuentas_pagar WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')";
    $resultado_cuentas_pagar = mysqli_query($conectar, $sql_cuentas_pagar) or die(mysqli_error($conectar));
    $info_cuentas_pagar = mysqli_fetch_assoc($resultado_cuentas_pagar);

    $cod_factura                          = $info_cuentas_pagar['cod_factura'];
    $cod_tercero                          = $info_cuentas_pagar['cod_tercero'];
    //---------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------//
    $sql_tercero = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $resultado_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $info_tercero = mysqli_fetch_assoc($resultado_tercero);

    $nombre1_tercero                      = $info_tercero['nombre1_tercero'];
?>
    <tr>
        <?php if ($cod_estado_egreso_eliminar == '1') { ?>
        <td style="text-align:center"><a href="../admin/eliminar.php?llave=<?php echo $cod_egreso ?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina ?>&fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
        <?php } ?>
        <td style="text-align:left;"><?php echo $nombre_concepto_movimiento_caja ?> (<?php echo $nombre_tipo_puc ?>) | <?php echo $nombre1_tercero ?> (<?php echo "FACTURA: ".$cod_factura ?>)</td>
        <td style="text-align:right"><?php echo number_format($costo, 0, ",", ".") ?></td>
        <td style="text-align:left"><?php echo $comentario?></td>
        <td style="text-align:center"><?php echo $nombre_ccosto?></td>
        <td style="text-align:left"><?php echo $nombre_cuenta_pagar?></td>
        <td style="text-align:center"><?php echo $fecha_dmy?></td>
        <td style="text-align:center"><?php echo $cod_egreso?></td>
        <?php if ($cod_estado_egreso_editar == '1') { ?>
        <!--<td style="text-align:center"><a href="../admin/edit_egreso_movimiento_caja.php?cod_egreso=<?php echo $cod_egreso ?>&fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>-->
        <?php } ?>
    </tr>
<?php } ?>
    </tbody>
</table>
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
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>

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
<td style="text-align: center; width: 99%; font-family: Courier; font-size:12pt;"><strong><?php echo $cabecera_emp; ?></strong></td>
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


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td align="center"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL MOVIMIENTO: <?php echo number_format($total_egreso, 0, ",", ".") ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td align="center"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>CONCEPTO</strong></td>
<td style="text-align: center; width:24%; font-family: Courier; font-size:8pt;"><strong>VALOR</strong></td>
<td style="text-align: center; width:24%; font-family: Courier; font-size:8pt;"><strong>FECHA</strong></td>
</tr>
<?php
$sql_info_factura = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') ORDER BY cod_egreso DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_egreso                          = $info_info_factura['cod_egreso'];
$cod_concepto_movimiento_caja        = $info_info_factura['cod_concepto_movimiento_caja'];
$cod_tipo_forma_pago                 = $info_info_factura['cod_tipo_forma_pago'];
$conceptos                           = $info_info_factura['conceptos'];
$costo                               = $info_info_factura['costo'];
$comentario                          = $info_info_factura['comentario'];
$fecha_dmy                           = $info_info_factura['fecha_dmy'];
$nombre_ccosto                       = $info_info_factura['nombre_ccosto'];
$cod_cuentas_pagar                   = $info_info_factura['cod_cuentas_pagar'];
//---------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------//
$sql_concepto_movimiento_caja = "SELECT * FROM tbl15_concepto_movimiento_caja WHERE (cod_concepto_movimiento_caja = '$cod_concepto_movimiento_caja')";
$resultado_concepto_movimiento_caja = mysqli_query($conectar, $sql_concepto_movimiento_caja) or die(mysqli_error($conectar));
$info_concepto_movimiento_caja = mysqli_fetch_assoc($resultado_concepto_movimiento_caja);

$nombre_concepto_movimiento_caja      = $info_concepto_movimiento_caja['nombre_concepto_movimiento_caja'];
$nombre_tipo_puc                      = $info_concepto_movimiento_caja['nombre_tipo_puc'];
$simbolo_tipo_operacion               = $info_concepto_movimiento_caja['simbolo_tipo_operacion'];
//---------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------//
$sql_cuentas_pagar = "SELECT cod_factura, cod_tercero FROM tbl15_cuentas_pagar WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')";
$resultado_cuentas_pagar = mysqli_query($conectar, $sql_cuentas_pagar) or die(mysqli_error($conectar));
$info_cuentas_pagar = mysqli_fetch_assoc($resultado_cuentas_pagar);

$cod_factura                          = $info_cuentas_pagar['cod_factura'];
$cod_tercero                          = $info_cuentas_pagar['cod_tercero'];
//---------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------//
$sql_tercero = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
$info_tercero = mysqli_fetch_assoc($resultado_tercero);

$nombre1_tercero                      = $info_tercero['nombre1_tercero'];
?>
<tr>
<td style="text-align: left; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_concepto_movimiento_caja ?> (<?php echo $nombre_tipo_puc ?>) | <?php echo $nombre1_tercero ?> (<?php echo $cod_factura ?>)</strong></td>
<td style="text-align: right; width:24%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($costo, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:24%; font-family: Courier; font-size:7pt;"><strong><?php echo $fecha_dmy ?></strong></td>
</tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td align="center"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha.$hora ?></strong>_imp_nrm_multiegret</td>
  </tr>
</table>

        </div>
    </div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->