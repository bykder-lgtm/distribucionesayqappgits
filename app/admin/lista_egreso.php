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
<a class="btn btn-primary" href="#"><h6>Egreso</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_egreso';
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
} else {
$fecha_dmy_ini                           = date("Y-m-d");
$fecha_dmy_fin                           = date("Y-m-d");

$sql_total_egreso = "SELECT SUM(costo) AS costo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin')";
$consulta_total_egreso = mysqli_query($conectar, $sql_total_egreso) or die(mysqli_error($conectar));
$datos_total_egreso = mysqli_fetch_assoc($consulta_total_egreso);

$total_egreso                            = $datos_total_egreso['costo'];
}
?>
<br>
<table class="table table-striped">
    <tr>
        <?php if ($cod_estado_egreso_registrar == '1') { ?>
        <th style="text-align:left"><a href="../admin/reg_egreso.php"><font size='+2'>AGREGAR NUEVO EGRESO</font></a></th>
        <?php } ?>
        <th style="text-align:right"><a href="../admin/reg_concepto_egreso.php"><font size='+2'>AGREGAR NUEVO CONCEPTO DE EGRESO</font></a></th>
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
        <th style="text-align:center"><font size='+1'>TOTAL</font></th>
        <?php if ($cod_estado_egreso_imprimir == '1') { ?>
        <th style="text-align:center"><font size='+1'>IMPRIMIR</font></th>
        <?php } ?>
        <th style="text-align:center"><font size='+1'>DESCARGAR</font></th>
    </tr>
    <tr>
        <th style="text-align:center"><font size='+1'><?php echo number_format($total_egreso, 0, ",", ".") ?></font></a></th>
        <?php if ($cod_estado_egreso_imprimir == '1') { ?>
        <th style="text-align:center"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></th>
        <?php } ?>
        <td style="text-align:center;"><a href="../admin/descargar_egreso_generales_pos_xlsx.php?fecha_dmy_ini=<?php echo $fecha_dmy_ini?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin?>"><img src=../imagenes/btn_xlsx.png alt="imprimir_peq"></a></td>
    </tr>
</table>

<table class="table table-striped">
<thead>
<tr>
<?php if ($cod_estado_egreso_eliminar == '1') { ?>
<th style="text-align:center">ELM</th>
<?php } ?>
<th style="text-align:center">CONCEPTO</th>
<th style="text-align:center">COSTO</th>
<th style="text-align:center">COMENTARIO</th>
<th style="text-align:center">C.COSTO</th>
<th style="text-align:center">FECHA</th>
<?php if ($cod_estado_egreso_editar == '1') { ?>
<th style="text-align:center">EDIT</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') ORDER BY cod_egreso DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_egreso                          = $info_info_factura['cod_egreso'];
$conceptos                           = $info_info_factura['conceptos'];
$costo                               = $info_info_factura['costo'];
$comentario                          = $info_info_factura['comentario'];
$fecha_dmy                           = $info_info_factura['fecha_dmy'];
$nombre_ccosto                       = $info_info_factura['nombre_ccosto'];
?>
<tr>
<?php if ($cod_estado_egreso_eliminar == '1') { ?>
<td style="text-align:center"><a href="../admin/eliminar.php?llave=<?php echo $cod_egreso ?>&tab=<?php echo $tab ?>&tipo=<?php echo $tipo ?>&campo=<?php echo $campo ?>&pagina=<?php echo $pagina ?>&fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
<?php } ?>
<td style="text-align:left"><?php echo $conceptos?></td>
<td style="text-align:right"><?php echo number_format($costo, 0, ",", ".") ?></td>
<td style="text-align:left"><?php echo $comentario?></td>
<td style="text-align:center"><?php echo $nombre_ccosto?></td>
<td style="text-align:center"><?php echo $fecha_dmy?></td>
<?php if ($cod_estado_egreso_editar == '1') { ?>
<td style="text-align:center"><a href="../admin/edit_egreso.php?cod_egreso=<?php echo $cod_egreso ?>&fecha_dmy_ini=<?php echo $fecha_dmy_ini ?>&fecha_dmy_fin=<?php echo $fecha_dmy_fin ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td> 
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
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL EGRESO: <?php echo number_format($total_egreso, 0, ",", ".") ?></strong></td>
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
<td style="text-align: center; width:24%; font-family: Courier; font-size:8pt;"><strong>COSTO</strong></td>
<td style="text-align: center; width:24%; font-family: Courier; font-size:8pt;"><strong>FECHA</strong></td>
</tr>
<?php
$sql_info_factura = "SELECT * FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_dmy_ini' AND '$fecha_dmy_fin') ORDER BY cod_egreso DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_egreso                          = $info_info_factura['cod_egreso'];
$conceptos                           = $info_info_factura['conceptos'];
$costo                               = $info_info_factura['costo'];
$comentario                          = $info_info_factura['comentario'];
$fecha_dmy                           = $info_info_factura['fecha_dmy'];
?>
<tr>
<td style="text-align: left; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo $conceptos ?></strong></td>
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