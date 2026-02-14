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
 <!--<div class="container">-->
<div class="divPanel page-content">
<div class="breadcrumbs">
 <!--<a class="btn btn-primary" href="#"><h6>Egreso</h6></a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                                  = $_SERVER['PHP_SELF'];
$tab                                     = 'tbl15_egreso_ingreso';
$tipo                                    = 'eliminar';
$campo                                   = 'cod_egreso';
$fecha                                   = date("Ymd");
$origen                                  = 'PARACLINICOS';

$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y/m/d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Ymd");
$hora_venta_his                          = date("His");

$cod_tipo_forma_pago                     = 0;
$cod_dependencia                         = 0;
$seleccionado                            = "selected";

$filtro_consulta_tipo_forma_pago         = "";
$filtro_consulta_dependencia             = "";

if (isset($_GET['fecha_dmy_ini'])) {
    $fecha_dmy_ini                           = addslashes($_GET['fecha_dmy_ini']);
    $fecha_dmy_fin                           = addslashes($_GET['fecha_dmy_fin']);
    $cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
    $cod_dependencia                         = intval($_GET['cod_dependencia']);
    $nombre_tipo_puc                         = addslashes($_GET['nombre_tipo_puc']);



    if ($nombre_tipo_puc==0) {
        $filtro_consulta_nombre_tipo_puc = "";
        $filtro_consulta_nombre_tipo_puc_rel = "";
    } else {
        $filtro_consulta_nombre_tipo_puc = "AND (nombre_tipo_puc = '$nombre_tipo_puc')";
        $filtro_consulta_nombre_tipo_puc_rel = "AND (tbl15_egreso.nombre_tipo_puc = '$nombre_tipo_puc')";
    }

    if ($cod_tipo_forma_pago==0) {
        $filtro_consulta_tipo_forma_pago = "";
        $filtro_consulta_tipo_forma_pago_rel = "";
    } else {
        $filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
        $filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_egreso.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    }

    if ($cod_dependencia==0) {
        $filtro_consulta_dependencia = "";
        $filtro_consulta_dependencia_rel = "";
    } else {
        $filtro_consulta_dependencia = "AND (cod_dependencia = '$cod_dependencia')";
        $filtro_consulta_dependencia_rel = "AND (tbl15_egreso.cod_dependencia = '$cod_dependencia')";
    }

    $sql_total_egreso = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin')";
    $consulta_total_egreso = mysqli_query($conectar, $sql_total_egreso) or die(mysqli_error($conectar));
    $datos_total_egreso = mysqli_fetch_assoc($consulta_total_egreso);

    $total_egreso                            = $datos_total_egreso['costo'];

    $sql_total_ingreso = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') AND (nombre_tipo_puc = 'INGRESO') $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia";
    $consulta_total_ingreso = mysqli_query($conectar, $sql_total_ingreso) or die(mysqli_error($conectar));
    $datos_total_ingreso = mysqli_fetch_assoc($consulta_total_ingreso);

    $total_ingreso                            = $datos_total_ingreso['costo'];

    $sql_total_gasto = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') AND (nombre_tipo_puc = 'EGRESO') $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia";
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

    $sql_total_ingreso = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') AND (nombre_tipo_puc = 'INGRESO') $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia";
    $consulta_total_ingreso = mysqli_query($conectar, $sql_total_ingreso) or die(mysqli_error($conectar));
    $datos_total_ingreso = mysqli_fetch_assoc($consulta_total_ingreso);

    $total_ingreso                            = $datos_total_ingreso['costo'];

    $sql_total_gasto = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') AND (nombre_tipo_puc = 'EGRESO') $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia";
    $consulta_total_gasto = mysqli_query($conectar, $sql_total_gasto) or die(mysqli_error($conectar));
    $datos_total_gasto = mysqli_fetch_assoc($consulta_total_gasto);

    $total_gasto                             = $datos_total_gasto['costo'];
}

    $sql_movimiento_caja = "SELECT total_compra_producto, total_venta_producto, total_saldo, fecha_ymd_movimiento_caja FROM tbl15_movimiento_caja WHERE (cod_movimiento_caja = '1')";
    $consulta_movimiento_caja = mysqli_query($conectar, $sql_movimiento_caja) or die(mysqli_error($conectar));
    $datos_movimiento_caja = mysqli_fetch_assoc($consulta_movimiento_caja);

    $total_compra_producto                 = $datos_movimiento_caja['total_compra_producto'];
    $total_venta_producto                  = $datos_movimiento_caja['total_venta_producto'];
    $total_saldo                           = $datos_movimiento_caja['total_saldo'];


    $sql_mov_contable_debito = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') AND (nombre_tipo_puc = 'INGRESO') $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia";
    $consulta_mov_contable_debito = mysqli_query($conectar, $sql_mov_contable_debito) or die(mysqli_error($conectar));
    $total_datos_debitos = mysqli_num_rows($consulta_mov_contable_debito);

    $sql_mov_contable_credito = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') AND (nombre_tipo_puc = 'EGRESO') $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia";
    $consulta_mov_contable_credito = mysqli_query($conectar, $sql_mov_contable_credito) or die(mysqli_error($conectar));
    $total_datos_creditos = mysqli_num_rows($consulta_mov_contable_credito);

    if ($total_datos_debitos > $total_datos_creditos) {
      $repetir_movimiento_debitos = 0;
      $repetir_movimiento_creditos = $total_datos_debitos - $total_datos_creditos;
    } elseif ($total_datos_debitos < $total_datos_creditos) {
      $repetir_movimiento_debitos = $total_datos_creditos - $total_datos_debitos;
      $repetir_movimiento_creditos = 0;
    } else {
      $repetir_movimiento_debitos = 0;
      $repetir_movimiento_creditos = 0;
    }
?>
<br>

<?php if ($cod_estado_egreso_registrar == '1') { ?>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/reg_egreso_ingreso_movimiento_caja_inmobiliaria.php?nombre_tipo_puc=EGRESO"><font size='+2'>REGISTRAR EGRESOS</font></a></th>
        <th style="text-align:center"><a href="../admin/reg_egreso_ingreso_movimiento_caja_inmobiliaria.php?nombre_tipo_puc=INGRESO"><font size='+2'>REGISTRAR INGRESOS</font></a></th>
    </tr>
</table>
<?php } ?>



<div class="table-responsive">

<form action="" id="" method="GET">

<table class="table table-striped">
  <tr>
    <th style="text-align:right;">TIPO: </th>
    <td style="text-align:left;">
        <select name="nombre_tipo_puc" id="nombre_tipo_puc" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" required>
            <?php if (isset($nombre_tipo_puc)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_tipo_puc, nombre_tipo_puc FROM tbl15_tipo_puc WHERE (cod_estado = '1') ORDER BY nombre_tipo_puc DESC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_puc) AND $nombre_tipo_puc == $datos2['nombre_tipo_puc']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_puc'];
            $nombre = $datos2['nombre_tipo_puc'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <th style="text-align:right;">FECHA INI: </th>
    <td style="text-align:left;"><input class="input-block-level" name="fecha_dmy_ini" type="date" value="<?php echo $fecha_dmy_ini ?>" required/></td>
    <th style="text-align:right;">FECHA FIN: </th>
    <td style="text-align:left;"><input class="input-block-level" name="fecha_dmy_fin" type="date" value="<?php echo $fecha_dmy_fin ?>" required/></td>
    <th style="text-align:right;">DEPENDENCIA: </th>
    <td style="text-align:left;">
        <select name="cod_dependencia" id="cod_dependencia" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" required>
            <?php if (isset($cod_dependencia)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia WHERE (cod_estado = '1') ORDER BY cod_dependencia ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_dependencia) AND $cod_dependencia == $datos2['cod_dependencia']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_dependencia'];
            $nombre = $datos2['nombre_dependencia'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <th style="text-align:right;">FORMA PAGO: </th>
    <td style="text-align:left;">
        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;" required>
            <?php if (isset($cod_tipo_forma_pago)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo "<option value='0' $seleccionado >TODOS</option>"; }
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
    <td style="width:50%">

<?php if ($nombre_tipo_puc == 'INGRESO' || $nombre_tipo_puc == '0') { ?>
    <table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:15pt; width:100%"><tr><th style="text-align:center; background-color:#DBE0F3; color:#000;">TOTAL INGRESOS: <?php echo number_format($total_ingreso, 0, ",", ".") ?></th></tr></table>
      <table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono;  font-size:10pt; width:100%">
        <tr>
            <?php if ($cod_estado_egreso_eliminar == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">ELM</th><?php } ?>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">CONCEPTO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">VALOR</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">OBSERVACION</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">DEPENDENCIA</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">TIPO PAGO</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">FECHA</th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;">SOPORTE</th>
            <?php if ($cod_estado_egreso_editar == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">EDIT</th><?php } ?>
        </tr>
<?php
$total_costo_ingreso                    = 0;
$incre_ingreso                          = 0;

$sql_ingreso = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') AND (nombre_tipo_puc = 'INGRESO') 
$filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia ORDER BY cod_egreso DESC";
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
            <?php if ($cod_estado_egreso_eliminar == '1') { ?><td style="text-align:center"><a href="../admin/eliminar.php?llave=<?php echo $cod_egreso ?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&cod_dependencia=<?php echo $cod_dependencia ?>&nombre_tipo_puc=<?php echo $nombre_tipo_puc ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td><?php } ?>
            <td style="text-align:left; background-color:#DBE0F3; color:#000;"><?php echo $nombre_concepto_movimiento_caja?></td>
            <td style="text-align:left; background-color:#DBE0F3; color:#000;"><?php echo number_format($costo, 0, ",", ".") ?></td>
            <td style="text-align:left; background-color:#DBE0F3; color:#000;"><?php echo $comentario?></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo $nombre_dependencia?></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo $nombre_tipo_forma_pago?></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo date("d-m-Y", strtotime($fecha_dmy))?></td>
            <td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="../admin/edit_egreso_ingreso_movimiento_caja_inmobiliaria_archivo_adjunto.php?cod_egreso=<?php echo $cod_egreso ?>&fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&cod_dependencia=<?php echo $cod_dependencia ?>&nombre_tipo_puc=<?php echo $nombre_tipo_puc ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td>
            <?php if ($cod_estado_egreso_editar == '1') { ?><td style="text-align:center"><a href="../admin/edit_egreso_ingreso_movimiento_caja_inmobiliaria.php?cod_egreso=<?php echo $cod_egreso ?>&fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&cod_dependencia=<?php echo $cod_dependencia ?>&nombre_tipo_puc=<?php echo $nombre_tipo_puc ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td> <?php } ?>
        </tr>
<?php } ?>
    </table>
                                                                                                                                                                                                                                                
        <table align="center" border="0" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:11pt; width:100%">
<?php
          for ($i=0; $i < $repetir_movimiento_debitos; $i++) {
?>
          <tr><td style="text-align:center"><img src="../imagenes/eliminar_vacio.png"></td></tr>
<?php } ?>
        </table> 
<?php } ?>   
    </td>

    <td style="width:50%">
<?php
$incre                                        = 0;
$und_vendida                                  = 0;
$costo_movimiento_diario                      = 0;
$total_costo_movimiento_diario                = 0;
$nombre_tabla                                 = "tbl15_movimiento_diario_pago";
$nombre_llave                                 = "cod_movimiento_diario_pago";
$id_campo_total                               = "total_costo_movimiento_diario_pago";
$nombre_campo_class_sumar                     = "costo_movimiento_diario_pago";
?>

<?php if ($nombre_tipo_puc == 'EGRESO' || $nombre_tipo_puc == '0') { ?>
    <table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:15pt; width:100%"><tr><th style="text-align:center; background-color:#FCE5D7; color:#000;">TOTAL EGRESOS: <?php echo number_format($total_gasto, 0, ",", ".") ?></th></tr></table>
      <table align="center" border="1" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:10pt; width:100%">
        <tr>
            <?php if ($cod_estado_egreso_eliminar == '1') { ?><th style="text-align:center; background-color:#FCE5D7; color:#000;">ELM</th><?php } ?>
            <th style="text-align:center; background-color:#FCE5D7; color:#000;">CONCEPTO</th>
            <th style="text-align:center; background-color:#FCE5D7; color:#000;">VALOR</th>
            <th style="text-align:center; background-color:#FCE5D7; color:#000;">OBSERVACION</th>
            <th style="text-align:center; background-color:#FCE5D7; color:#000;">DEPENDENCIA</th>
            <th style="text-align:center; background-color:#FCE5D7; color:#000;">TIPO PAGO</th>
            <th style="text-align:center; background-color:#FCE5D7; color:#000;">FECHA</th>
            <th style="text-align:center; background-color:#FCE5D7; color:#000;">SOPORTE</th>
            <?php if ($cod_estado_egreso_editar == '1') { ?><th style="text-align:center; background-color:#FCE5D7; color:#000;">EDIT</th><?php } ?>
        </tr>
<?php
$total_costo_egreso                     = 0;
$incre_egreso                           = 0;
$sql_egreso = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') AND (nombre_tipo_puc = 'EGRESO') 
$filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia ORDER BY cod_egreso DESC";
$resultado_egreso = mysqli_query($conectar, $sql_egreso) or die(mysqli_error($conectar));
$total_egreso = mysqli_num_rows($resultado_egreso);
while ($info_egreso = mysqli_fetch_assoc($resultado_egreso)) {

$cod_egreso                             = $info_egreso['cod_egreso'];
$conceptos                              = $info_egreso['conceptos'];
$costo                                  = $info_egreso['costo'];
$comentario                             = $info_egreso['comentario'];
$cod_concepto_movimiento_caja           = $info_egreso['cod_concepto_movimiento_caja'];
$nombre_concepto_movimiento_caja        = $info_egreso['nombre_concepto_movimiento_caja'];
$cod_tipo_puc                           = $info_egreso['cod_tipo_puc'];
//$nombre_tipo_puc                        = $info_egreso['nombre_tipo_puc'];
$simbolo_tipo_operacion                 = $info_egreso['simbolo_tipo_operacion'];
$cod_tipo_forma_pago_db                 = $info_egreso['cod_tipo_forma_pago'];
$fecha_dmy                              = $info_egreso['fecha_dmy'];
$cod_cuentas_pagar                      = $info_egreso['cod_cuentas_pagar'];
$cod_tercero                            = $info_egreso['cod_tercero'];
$cod_dependencia_db                     = $info_egreso['cod_dependencia'];
$url_img_orig_producto                  = $info_egreso['url_img_orig_producto'];
$url_img_min_producto                   = $info_egreso['url_img_min_producto'];
$total_costo_egreso                    += $costo;
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

$incre_egreso++;
?>
        <tr>
            <?php if ($cod_estado_egreso_eliminar == '1') { ?><td style="text-align:center"><a href="../admin/eliminar.php?llave=<?php echo $cod_egreso ?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&cod_dependencia=<?php echo $cod_dependencia ?>&nombre_tipo_puc=<?php echo $nombre_tipo_puc ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td><?php } ?>
            <td style="text-align:left; background-color:#FCE5D7; color:#000;"><?php echo $nombre_concepto_movimiento_caja?></td>
            <td style="text-align:left; background-color:#FCE5D7; color:#000;"><?php echo number_format($costo, 0, ",", ".") ?></td>
            <td style="text-align:left; background-color:#FCE5D7; color:#000;"><?php echo $comentario?></td>
            <td style="text-align:center; background-color:#FCE5D7; color:#000;"><?php echo $nombre_dependencia?></td>
            <td style="text-align:center; background-color:#FCE5D7; color:#000;"><?php echo $nombre_tipo_forma_pago?></td>
            <td style="text-align:center; background-color:#FCE5D7; color:#000;"><?php echo date("d-m-Y", strtotime($fecha_dmy))?></td>
            <td style="text-align:center; background-color:#FCE5D7; color:#000;"><a href="../admin/edit_egreso_ingreso_movimiento_caja_inmobiliaria_archivo_adjunto.php?cod_egreso=<?php echo $cod_egreso ?>&fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&cod_dependencia=<?php echo $cod_dependencia ?>&nombre_tipo_puc=<?php echo $nombre_tipo_puc ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td>
            <?php if ($cod_estado_egreso_editar == '1') { ?><td style="text-align:center"><a href="../admin/edit_egreso_ingreso_movimiento_caja_inmobiliaria.php?cod_egreso=<?php echo $cod_egreso ?>&fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>&cod_tipo_forma_pago=<?php echo $cod_tipo_forma_pago ?>&cod_dependencia=<?php echo $cod_dependencia ?>&nombre_tipo_puc=<?php echo $nombre_tipo_puc ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td> <?php } ?>
        </tr>
<?php } ?>
    </table>

        <table align="center" border="0" cellspacing="0" cellpadding="1" style="font-family:mono; font-size:11pt; width:100%">
<?php
          for ($i=0; $i < $repetir_movimiento_creditos ; $i++) {
?>
          <tr><td style="text-align:center"><img src="../imagenes/eliminar_vacio.png"></td></tr>
<?php } ?>
        </table>   
    </td> 
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
 <!--</div>-->
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