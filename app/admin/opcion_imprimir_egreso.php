<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">

<?php
if (isset($_GET['cod_egreso'])) {
$cod_egreso                  = intval($_GET['cod_egreso']);
$pagina                      = $_GET['pagina'];
$tab                         = 'tbl15_egresos';
$tipo                        = 'eliminar';
$campo                       = 'cod_egreso';
$fecha_dmy                   = date("Y-m-d");
$origen                      = 'PARACLINICOS';
$cod_egreso_strpad           = str_pad($cod_egreso, 4, "0", STR_PAD_LEFT);
$time_seg                    = time();
$time_date_ymd               = strtotime(date("Y/m/d"));
$fecha                       = date("Ymd");
$hora                        = date("His");
$fecha_venta_ymd             = date("Ymd");
$hora_venta_his              = date("His");
//----------------------------------------------------
$mostrar_totales_fisico = "SELECT * FROM tbl15_egreso WHERE (cod_egreso = '$cod_egreso')";
$consulta_totales_fisico = mysqli_query($conectar, $mostrar_totales_fisico) or die(mysqli_error($conectar));
$datos_totales_fisico = mysqli_fetch_assoc($consulta_totales_fisico);

$conceptos                   = $datos_totales_fisico['conceptos'];
$comentario                  = $datos_totales_fisico['comentario'];
$costo                       = $datos_totales_fisico['costo'];
$nombre_ccosto               = $datos_totales_fisico['nombre_ccosto'];
$fecha_dmy                   = $datos_totales_fisico['fecha_dmy'];
$cuenta                      = $datos_totales_fisico['cuenta'];
$hora                        = $datos_totales_fisico['hora'];
}
?>
<script>
function printPageArea(areaID){

var cod_egreso_strpad = <?php echo $cod_egreso_strpad; ?>;
$("#codigo_codabar_php").html('<img src="class_php\\barcode.php?text='+cod_egreso_strpad+'&size=25&codetype=Code128&print=false"/>');

var printContent = document.getElementById(areaID);
var WinPrint = window.open('', '', 'width=400,height=1000');
WinPrint.document.write(printContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
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
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

<?php if (isset($_GET['cod_egreso'])) { ?>
<div class="table-responsive">
<form method="post" action="<?php echo $pagina;?>">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center"><input type="image" id ="foco" src="../imagenes/listo.png" name="listo" value="listo" /></th>
<th style="text-align:center"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></th>
</tr>
</table>
</form>
</div>
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
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>EGRESOS</strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td align="center"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong>CONCEPTO</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>COSTO</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:8pt;"><strong>COMENTARIO</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:8pt;"><strong>FECHA</strong></td>
</tr>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:8pt;"><strong><?php echo $conceptos ?></strong></td>
<td style="text-align: center; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($costo, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:14%; font-family: Courier; font-size:8pt;"><strong><?php echo $comentario ?></strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong><?php echo $fecha_dmy ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td align="center"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><div id="codigo_codabar_php"></div></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha.$hora.'-'.$cod_egreso ?></strong>_imp_nrm_egret</td>
  </tr>
</table>

        </div>
    </div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->