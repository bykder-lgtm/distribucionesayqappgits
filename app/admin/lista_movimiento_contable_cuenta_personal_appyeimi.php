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
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                                          = $_SERVER['PHP_SELF'];
$tab                                             = 'tbl15_movimiento_contable_cuenta_personal';
$tipo                                            = 'eliminar';
$campo                                           = 'cod_egreso';
$fecha                                           = date("Ymd");
$origen                                          = 'PARACLINICOS';

$time_seg                                        = time();
$time_date_ymd                                   = strtotime(date("Y/m/d"));
$hora                                            = date("His");
$fecha_venta_ymd                                 = date("Ymd");
$hora_venta_his                                  = date("His");
$nombre_puc_get                                  = '';
$tipo_puc_get                                    = '';
$cod_movimiento_contable_cuenta_personal_get     = '';
$seleccionado                                    = '';

$sql_movimiento_contable_cuenta_personal_total = "SELECT SUM(total_saldo) AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_estado = '1')";
$consulta_movimiento_contable_cuenta_personal_total = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_total) or die(mysqli_error($conectar));
$datos_movimiento_contable_cuenta_personal_total = mysqli_fetch_assoc($consulta_movimiento_contable_cuenta_personal_total);

$total_saldo_movimiento_contable_cuenta_personal                 = $datos_movimiento_contable_cuenta_personal_total['total_saldo_movimiento_contable_cuenta_personal'];

if (isset($_GET['fecha_anyo_ini'])) { $fecha_anyo_ini = addslashes($_GET['fecha_anyo_ini']); } else { $fecha_anyo_ini = date("Y-m-d"); }
if (isset($_GET['fecha_anyo_fin'])) { $fecha_anyo_fin = addslashes($_GET['fecha_anyo_fin']); } else { $fecha_anyo_fin = date("Y-m-d"); }
if (isset($_GET['nombre_puc'])) { $nombre_puc_get = addslashes($_GET['nombre_puc']); }
if (isset($_GET['tipo_puc'])) { $tipo_puc_get = addslashes($_GET['tipo_puc']); }
if (isset($_GET['cod_movimiento_contable_cuenta_personal'])) { $cod_movimiento_contable_cuenta_personal_get = addslashes($_GET['cod_movimiento_contable_cuenta_personal']); }

if ($nombre_puc_get == 'TODOS') { 
    $filtro_consulta_nombre_puc = ""; 
} else { 
    $filtro_consulta_nombre_puc = "AND (nombre_puc = '$nombre_puc_get')"; 
}

if ($tipo_puc_get == 'TODOS') { 
    $filtro_consulta_tipo_puc = ""; 
} else { 
    $filtro_consulta_tipo_puc = "AND (tipo_puc = '$tipo_puc_get')"; 
}

if ($cod_movimiento_contable_cuenta_personal_get == 'TODOS') { 
    $filtro_cod_movimiento_contable_cuenta_personal = ""; 
} else { 
    $filtro_cod_movimiento_contable_cuenta_personal = "AND (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_get')"; 
}

$sql_info_totales_ingresos = "SELECT SUM(costo_movimiento_contable) AS total_costo_movimiento_contable_ingresos FROM tbl15_movimiento_contable_cuenta_personal_concepto 
WHERE (fecha_anyo BETWEEN '$fecha_anyo_ini' AND '$fecha_anyo_fin') AND (tipo_puc = '$tipo_puc_get')";
$resultado_info_totales_ingresos = mysqli_query($conectar, $sql_info_totales_ingresos) or die(mysqli_error($conectar));
$info_info_totales_ingresos = mysqli_fetch_assoc($resultado_info_totales_ingresos);

$total_costo_movimiento_contable_ingresos         = $info_info_totales_ingresos['total_costo_movimiento_contable_ingresos'];
/*
$sql_info_totales_gastos = "SELECT SUM(costo_movimiento_contable) AS total_costo_movimiento_contable_gastos FROM tbl15_movimiento_contable_cuenta_personal_concepto 
WHERE (fecha_anyo BETWEEN '$fecha_anyo_ini' AND '$fecha_anyo_fin') AND (tipo_puc = 'GASTOS')";
$resultado_info_totales_gastos = mysqli_query($conectar, $sql_info_totales_gastos) or die(mysqli_error($conectar));
$info_info_totales_gastos = mysqli_fetch_assoc($resultado_info_totales_gastos);

$total_costo_movimiento_contable_gastos         = $info_info_totales_gastos['total_costo_movimiento_contable_gastos'];

$sql_info_totales_pasivos = "SELECT SUM(costo_movimiento_contable) AS total_costo_movimiento_contable_pasivos FROM tbl15_movimiento_contable_cuenta_personal_concepto 
WHERE (fecha_anyo BETWEEN '$fecha_anyo_ini' AND '$fecha_anyo_fin') AND (tipo_puc = 'PASIVOS')";
$resultado_info_totales_pasivos = mysqli_query($conectar, $sql_info_totales_pasivos) or die(mysqli_error($conectar));
$info_info_totales_pasivos = mysqli_fetch_assoc($resultado_info_totales_pasivos);

$total_costo_movimiento_contable_pasivos         = $info_info_totales_pasivos['total_costo_movimiento_contable_pasivos'];
*/
?>
<div class="table-responsive">

<br>
<table class="table table-striped">
    <tr>
        <?php if ($cod_estado_egreso_registrar == '1') { ?>
        <th style="text-align:left"><font size='+1'>TOTAL SALDO CAJAS: <?php echo number_format($total_saldo_movimiento_contable_cuenta_personal, 0, ",", ".") ?></font></th>
        <th style="text-align:left"><a href="../admin/reg_movimiento_contable_cuenta_personal_appyeimi.php"><font size='+1'>REGISTRAR NUEVO MOVIMIENTO</font></a></th>
        <?php } ?>
        <!--<th style="text-align:right"><a href="../admin/reg_concepto_egreso_movimiento_caja.php"><font size='+2'>AGREGAR NUEVO CONCEPTO DE MOVIMIENTO</font></a></th>-->
    </tr>
</table>

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center; width:70px; font-size:20px;">COD PUC</th>
    <th style="text-align:left; width:130px; font-size:20px;">NOMBRE CUENTA PERSONAL</th>
    <th style="text-align:right; width:50px; font-size:20px;">SALDO</th>
    <th style="text-align:center; width:60px; font-size:20px;"></th>
    <th style="text-align:right; width:100px; font-size:20px;">ID</th>
  </tr>
<?php
$sql_movimiento_contable_cuenta_personal = "SELECT cod_movimiento_contable_cuenta_personal, cod_puc, codigo_puc, nombre_puc, total_saldo FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_estado = '1')";
$consulta_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal) or die(mysqli_error($conectar));
while ($datos_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($consulta_movimiento_contable_cuenta_personal)) {

    $cod_movimiento_contable_cuenta_personal                  = $datos_movimiento_contable_cuenta_personal['cod_movimiento_contable_cuenta_personal'];
    $cod_puc                                                  = $datos_movimiento_contable_cuenta_personal['cod_puc'];
    $codigo_puc                                               = $datos_movimiento_contable_cuenta_personal['codigo_puc'];
    $nombre_puc                                               = $datos_movimiento_contable_cuenta_personal['nombre_puc'];
    $total_saldo                                              = $datos_movimiento_contable_cuenta_personal['total_saldo'];
?>
  <tr>
    <td style="text-align:center; font-size:20px;"><?php echo $codigo_puc ?></td>
    <td style="text-align:left; font-size:20px;"><?php echo $nombre_puc ?></td>
    <td style="text-align:right; font-size:20px;"><?php echo number_format($total_saldo, 0, ",", ".") ?></td>
    <td style="text-align:right; font-size:20px;"></td>
    <td style="text-align:right; font-size:20px;"><?php echo $cod_movimiento_contable_cuenta_personal ?></td>
  </tr>
<?php } ?>
  <tr>
    <th style="text-align:center; font-size:20px;"></th>
    <th style="text-align:left; font-size:20px;">TOTAL SALDO</th>
    <th style="text-align:right; font-size:20px;"><?php echo number_format($total_saldo_movimiento_contable_cuenta_personal, 0, ",", ".") ?></th>
    <th style="text-align:right; font-size:20px;"></th>
    <th style="text-align:right; font-size:20px;"></th>
  </tr>
</table>

<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">FECHA INI</th>
    <th style="text-align:center;">FECHA FIN</th>
    <th style="text-align:center;">CONCEPTO</th>
    <th style="text-align:center;">TIPO</th>
    <th style="text-align:center;">CUENTA PERSONAL</th>
    <th style="text-align:center;">VER REGISTROS</th>

  </tr>
  <tr>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_anyo_ini" type="date" value="<?php echo $fecha_anyo_ini ?>" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_anyo_fin" type="date" value="<?php echo $fecha_anyo_fin ?>" required/></td>
    <td style="text-align:left">
        <select name="nombre_puc" id="nombre_puc" class="chosen-select" data-show-subtext="true" data-live-search="true">
            <?php if (isset($nombre_puc)) { echo "<option value='TODOS' >TODOS</option>"; } else { echo "<option value='TODOS' >TODOS</option>"; }
            $consulta2_sql = ("SELECT cod_concepto_movimiento_caja, nombre_concepto_movimiento_caja, nombre_tipo_puc FROM tbl15_concepto_movimiento_caja WHERE (cod_estado = '1') ORDER BY cod_concepto_movimiento_caja ASC");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_puc) and $nombre_puc == $datos2['nombre_concepto_movimiento_caja']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_concepto_movimiento_caja'];
            $nombre = $datos2['nombre_concepto_movimiento_caja'].' ('.$datos2['nombre_tipo_puc'].')';
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;">
        <select name="tipo_puc" id="tipo_puc" class="selectpicker" data-show-subtext="true" data-live-search="true">
            <?php if (isset($tipo_puc_get)) { echo "<option value='TODOS' $seleccionado >TODOS</option>"; } else { echo "<option value='TODOS' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT * FROM tbl15_tipo_puc WHERE (cod_estado = '1')";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($tipo_puc_get) AND $tipo_puc_get == $datos2['nombre_tipo_puc']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_puc'];
            $nombre = $datos2['nombre_tipo_puc'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;">
        <select name="cod_movimiento_contable_cuenta_personal" id="cod_movimiento_contable_cuenta_personal" class="selectpicker" data-show-subtext="true" data-live-search="true">
            <?php if (isset($cod_movimiento_contable_cuenta_personal_get)) { echo "<option value='TODOS' $seleccionado >TODOS</option>"; } else { echo "<option value='TODOS' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_estado = '1')";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_movimiento_contable_cuenta_personal_get) AND $cod_movimiento_contable_cuenta_personal_get == $datos2['cod_movimiento_contable_cuenta_personal']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_movimiento_contable_cuenta_personal'];
            $nombre = $datos2['nombre_puc'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <td style="text-align:center;"><button type="submit">Ver Registros</button></td>
  </tr>
</table>
</form>

<?php if (isset($_GET['fecha_anyo_ini'])) { ?>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center">CONCEPTO</th>
        <th style="text-align:center">VALOR</th>
        <th style="text-align:center">TIPO</th>
        <th style="text-align:center">COMENTARIO</th>
        <th style="text-align:center">FECHA - HORA</th>
        <th style="text-align:center">CUENTA PERSONAL</th>
        <th style="text-align:center">FORMA PAGO</th>
        <th style="text-align:center">SALDO ANT</th>
        <th style="text-align:center">ID</th>
        <?php if ($cod_estado_egreso_editar == '1') { ?>
        <!--<th style="text-align:center">EDIT</th>-->
        <th style="text-align:center">ELM</th>
        <?php } ?>
    </tr>
</thead>
<tbody>
<?php
$suma_total_costo_movimiento_contable = 0;

$sql_info_factura = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal_concepto WHERE (fecha_anyo BETWEEN '$fecha_anyo_ini' AND '$fecha_anyo_fin') $filtro_consulta_nombre_puc $filtro_consulta_tipo_puc $filtro_cod_movimiento_contable_cuenta_personal
ORDER BY cod_movimiento_contable_cuenta_personal_concepto DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

    $cod_movimiento_contable_cuenta_personal_concepto         = $info_info_factura['cod_movimiento_contable_cuenta_personal_concepto'];
    $nombre_modulo_puc                                        = $info_info_factura['nombre_modulo_puc'];
    $nombre_tipo_movimiento                                   = $info_info_factura['nombre_tipo_movimiento'];
    $nombre_tipo_documento                                    = $info_info_factura['nombre_tipo_documento'];
    $cod_tercero                                              = $info_info_factura['cod_tercero'];
    $cod_puc                                                  = $info_info_factura['cod_puc'];
    $codigo_puc                                               = $info_info_factura['codigo_puc'];
    $nombre_puc                                               = $info_info_factura['nombre_puc'];
    $tipo_puc                                                 = $info_info_factura['tipo_puc'];
    $costo_movimiento_contable                                = $info_info_factura['costo_movimiento_contable'];
    $venta_movimiento_contable                                = $info_info_factura['venta_movimiento_contable'];
    $total_costo_movimiento_contable                          = $info_info_factura['total_costo_movimiento_contable'];
    $fecha_anyo                                               = $info_info_factura['fecha_anyo'];
    $comentario                                               = $info_info_factura['comentario'];
    $total_saldo                                              = $info_info_factura['total_saldo'];
    $cod_movimiento_contable_cuenta_personal                  = $info_info_factura['cod_movimiento_contable_cuenta_personal'];
    $fecha_seg                                                = $info_info_factura['fecha_seg'];
    $suma_total_costo_movimiento_contable                     = $suma_total_costo_movimiento_contable + $costo_movimiento_contable;
    $cod_tipo_forma_pago                                      = $info_info_factura['cod_tipo_forma_pago'];

    $sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    $resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago);
    $info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);

    $nombre_tipo_forma_pago                                   = $info_tipo_forma_pago['nombre_tipo_forma_pago'];

    $sql_movimiento_contable_cuenta_personal = "SELECT nombre_puc AS nombre_puc_movimiento_contable_cuenta_personal  FROM tbl15_movimiento_contable_cuenta_personal 
    WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
    $resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
    $info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

    $nombre_puc_movimiento_contable_cuenta_personal          = $info_movimiento_contable_cuenta_personal['nombre_puc_movimiento_contable_cuenta_personal'];
    //---------------------------------------------------------------------------------------------------------//
    //---------------------------------------------------------------------------------------------------------//
    $sql_tercero = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $resultado_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $info_tercero = mysqli_fetch_assoc($resultado_tercero);

    $nombre1_tercero                                          = $info_tercero['nombre1_tercero'];
?>
    <tr>
        <td style="text-align:left;"><?php echo $nombre_puc ?></td>
        <td style="text-align:right"><?php echo number_format($costo_movimiento_contable, 0, ",", ".") ?></td>
        <td style="text-align:center"><?php echo $tipo_puc?></td>
        <td style="text-align:left"><?php echo $comentario?></td>
        <td style="text-align:center"><?php echo date('Y-m-d H:i:s', $fecha_seg)?></td>
        <td style="text-align:center"><?php echo $nombre_puc_movimiento_contable_cuenta_personal?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
        <td style="text-align:right"><?php echo number_format($total_saldo, 0, ",", ".") ?></td>
        <td style="text-align:center"><?php echo $cod_movimiento_contable_cuenta_personal_concepto?></td>
        <?php if ($cod_estado_egreso_editar == '1') { ?>
        <!--<td style="text-align:center"><a href="../admin/edit_egreso_movimiento_caja.php?cod_movimiento_contable_cuenta_personal_concepto=<?php echo $cod_movimiento_contable_cuenta_personal_concepto ?>&fecha_anyo_ini=<?php echo $fecha_anyo_ini ?>&fecha_anyo_fin=<?php echo $fecha_anyo_fin ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>-->
        <?php } ?>
        <td style="text-align:center"><a href="../admin/eliminar_movimiento_contable_cuenta_personal_concepto.php?cod_movimiento_contable_cuenta_personal_concepto=<?php echo $cod_movimiento_contable_cuenta_personal_concepto ?>&fecha_anyo_ini=<?php echo $fecha_anyo_ini ?>&fecha_anyo_fin=<?php echo $fecha_anyo_fin ?>&tipo_puc=<?php echo $tipo_puc_get ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
    </tr>
<?php } ?>
    <tr>
        <th style="text-align:left;">TOTAL</th>
        <th style="text-align:right"><?php echo number_format($suma_total_costo_movimiento_contable, 0, ",", ".") ?></th>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
        <td style="text-align:center"></td>
    </tr>
    </tbody>
</table>

<table class="table table-striped">
    <tr>
        <?php if ($tipo_puc_get <> 'TODOS') { ?>
        <th style="text-align:center"><font size='+1'>TOTAL <?php echo $tipo_puc_get ?>: <?php echo number_format($total_costo_movimiento_contable_ingresos, 0, ",", ".") ?></font></th>
        <?php } ?>
    </tr>
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