<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
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
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_cierre_cajas                     = intval($_GET['cod_cierre_cajas']);
$pagina                               = '../admin/lista_cierre_caja_ultima_version.php?cod_cierre_cajas='.$cod_cierre_cajas;
$pagina_local                         = $_SERVER['PHP_SELF'];
$hora_compra_his                      = date("His");


$obtener_informacion = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$consultar_informacion = mysqli_query($conectar, $obtener_informacion) or die(mysqli_error($conectar));
$info_emp = mysqli_fetch_assoc($consultar_informacion);

$titulo_emp                                         = $info_emp['titulo'];
$desarrollador_emp                                  = $info_emp['desarrollador'];
$pag_desarrollador_emp                              = $info_emp['pag_desarrollador'];
$correo_desarrollador_emp                           = $info_emp['correo_desarrollador'];
$anyo_emp                                           = $info_emp['anyo'];
$nombre_emp                                         = $info_emp['nombre'];
$eslogan_emp                                        = $info_emp['eslogan'];
$nombre_propietario_emp                             = $info_emp['nombre_propietario'];
$cedula_propietario_emp                             = $info_emp['cedula_propietario'];
$res_emp                                            = $info_emp['res'];
$res1_emp                                           = $info_emp['res1'];
$res2_emp                                           = $info_emp['res2'];
$fecha_res_emp                                      = $info_emp['fecha_res'];
$prefijo_res_emp                                    = $info_emp['prefijo_res'];
$pais_emp                                           = $info_emp['pais'];
$departamento_emp                                   = $info_emp['departamento'];
$ciudad_emp                                         = $info_emp['ciudad'];
$localidad_emp                                      = $info_emp['localidad'];
$direccion_emp                                      = $info_emp['direccion'];
$correo_emp                                         = $info_emp['correo'];
$cabecera_emp                                       = $info_emp['cabecera'];
$telefono_emp                                       = $info_emp['telefono'];
$nit_empresa_emp                                    = $info_emp['nit_empresa'];
$regimen_emp                                        = $info_emp['regimen'];
$propietario_nombres_apellidos_emp                  = $info_emp['propietario_nombres_apellidos'];
$propietario_nit_emp                                = $info_emp['propietario_nit'];
$propietario_url_firma_emp                          = $info_emp['propietario_url_firma'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_info_fact = "SELECT * FROM tbl15_cierre_caja WHERE (cod_cierre_cajas = '$cod_cierre_cajas')";
$resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
$info_fact = mysqli_fetch_assoc($resultado_info_fact);

$total_fisico_cierre_caja                           = $info_fact['total_fisico_cierre_caja'];
$total_sistema_cierre_caja                          = $info_fact['total_sistema_cierre_caja'];
$total_sistema_contado_efectivo_cierre_caja         = $info_fact['total_sistema_contado_efectivo_cierre_caja'];
$total_sistema_credito_cierre_caja                  = $info_fact['total_sistema_credito_cierre_caja'];
$total_base_cierre_caja                             = $info_fact['total_base_cierre_caja'];
$total_abono_cuenta_cobrar                          = $info_fact['total_abono_cuenta_cobrar'];
$moneda_50                                          = $info_fact['moneda_50'];
$moneda_100                                         = $info_fact['moneda_100'];
$moneda_200                                         = $info_fact['moneda_200'];
$moneda_500                                         = $info_fact['moneda_500'];
$moneda_1000                                        = $info_fact['moneda_1000'];
$moneda_2000                                        = $info_fact['moneda_2000'];
$moneda_5000                                        = $info_fact['moneda_5000'];
$moneda_10000                                       = $info_fact['moneda_10000'];
$moneda_20000                                       = $info_fact['moneda_20000'];
$moneda_50000                                       = $info_fact['moneda_50000'];
$moneda_100000                                      = $info_fact['moneda_100000'];
$comentario                                         = $info_fact['comentario'];
$vendedor                                           = $info_fact['vendedor'];
$fecha_anyo                                         = $info_fact['fecha_anyo'];
$fecha_mes                                          = $info_fact['fecha_mes'];
$fecha_cierre_caja                                  = $info_fact['fecha_cierre_caja'];
$hora_cierre_caja                                   = $info_fact['hora_cierre_caja'];
$fecha_time_cierre_caja                             = $info_fact['fecha_time_cierre_caja'];
$cod_cierre_caja                                    = $info_fact['cod_cierre_caja'];
$cod_administrador                                  = $info_fact['cod_administrador'];

$obtener_diseno_usario_vendedor = "SELECT cuenta, nombres, apellidos, cod_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_diseno_usario_vendedor = mysqli_query($conectar, $obtener_diseno_usario_vendedor) or die(mysqli_error($conectar));
$matriz_usario_vendedor = mysqli_fetch_assoc($resultado_diseno_usario_vendedor);

$usario_vendedor                                    = $matriz_usario_vendedor['nombres'].' '.$matriz_usario_vendedor['apellidos'];
$cod_caja                                           = $matriz_usario_vendedor['cod_caja'];
$cuenta                                             = $matriz_usario_vendedor['cuenta'];

$cod_factura_strpad                                 = str_pad($cod_cierre_cajas, 4, "0", STR_PAD_LEFT);
$cod_info_factura_strpad                            = str_pad($cod_cierre_cajas, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$resta                                              = 1516399999;
$time_seg                                           = time();
$time_date_ymd                                      = strtotime(date("Y/m/d"));
$fecha                                              = date("Ymd");
$hora                                               = date("His");
$fecha_venta_ymd                                    = date("Ymd", strtotime($fecha_anyo));
$hora_venta_his                                     = date("His");
?>
<script>
function printPageArea(areaID){

  var cod_factura_strpad = <?php echo $cod_factura_strpad; ?>;
  var cod_info_factura_strpad = <?php echo $cod_info_factura_strpad; ?>;
  $("#codigo_codabar_php").html('<img src="class_php\\barcode.php?text='+cod_factura_strpad+'&size=25&codetype=Code128&print=false"/>');

  var printContent = document.getElementById(areaID);
  document.getElementById("listo").focus();
  var WinPrint = window.open('', '', 'width=400,height=1000');
  WinPrint.document.write(printContent.innerHTML);
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
  WinPrint.close();
}
</script>

<div class="table-responsive">
<center>
<table class="table table-striped">
  <tr>
    <td><font color='black' size= "+3">CIERRE:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $cod_cierre_caja; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">VENDEDOR:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $cuenta; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">BASE:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($total_base_cierre_caja, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">TOTAL FISICO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($total_fisico_cierre_caja, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">BASE + FISICO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($total_base_cierre_caja + $total_fisico_cierre_caja, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">TOTAL VENTA EN EL SISTEMA:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($total_sistema_cierre_caja, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">TOTAL VENTA EN EL SISTEMA EN EFECTIVO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($total_sistema_contado_efectivo_cierre_caja, 0, ",", "."); ?></font></td>
  </tr>

  <tr>
    <td><font color='black' size= "+3">FECHA DE CIERRE:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $fecha_anyo; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">HORA DE CIERRE:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $hora_cierre_caja; ?></font></td>
  </tr>
  <tr>
    <td style="text-align:center;"><a href="<?php echo $pagina?>" id="listo"><img src="../imagenes/listo.png"></a></td>
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
  </tr>
</table>
</center>
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


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td align="center"><strong>TICKET CIERRE DE CAJA</strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td align="center"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <th style="text-align: left; width: 60%; font-family: Courier; font-size:7pt;">CIERRE:</th>
    <th style="text-align: right; width: 25%; font-family: Courier; font-size:7pt;"><?php echo $cod_cierre_caja; ?></th>
    <th style="text-align: right; width: 5%;"></th>
  </tr>
  <tr>
    <th style="text-align: left; width: 60%; font-family: Courier; font-size:7pt;">VENDEDOR:</th>
    <th style="text-align: right; width: 25%; font-family: Courier; font-size:7pt;"><?php echo $cuenta; ?></th>
    <th style="text-align: right; width: 5%;"></th>
  </tr>
  <tr>
    <th style="text-align: left; width: 70%; font-family: Courier; font-size:7pt;">BASE:</th>
    <th style="text-align: right; width: 25%; font-family: Courier; font-size:7pt;"><?php echo number_format($total_base_cierre_caja, 0, ",", "."); ?></th>
    <th style="text-align: right; width: 5%;"></th>
  </tr>
  <tr>
    <th style="text-align: left; width: 60%; font-family: Courier; font-size:7pt;">TOTAL VENTA EN EFECTIVO + BASE + ABONOS EN EFECTIVO:</th>
    <th style="text-align: right; width: 25%; font-family: Courier; font-size:7pt;"><?php echo number_format($total_base_cierre_caja + $total_fisico_cierre_caja, 0, ",", "."); ?></th>
    <th style="text-align: right; width: 5%;"></th>
  </tr>
  <tr>
    <th style="text-align: left; width: 60%; font-family: Courier; font-size:7pt;">TOTAL VENTA (EFECTIVO + TRANSFERENCIA):</th>
    <th style="text-align: right; width: 25%; font-family: Courier; font-size:7pt;"><?php echo number_format($total_sistema_cierre_caja, 0, ",", "."); ?></th>
    <th style="text-align: right; width: 5%;"></th>
  </tr>
  <tr>
    <th style="text-align: left; width: 60%; font-family: Courier; font-size:8pt;">TOTAL VENTA + ABONOS EN EFECTIVO:</th>
    <th style="text-align: right; width: 25%; font-family: Courier; font-size:8pt;"><?php echo number_format($total_sistema_contado_efectivo_cierre_caja, 0, ",", "."); ?></th>
    <th style="text-align: right; width: 5%;"></th>
  </tr>
  <tr>
    <th style="text-align: left; width: 60%; font-family: Courier; font-size:8pt;">TOTAL CONTEO CAJA EN EFECTIVO:</th>
    <th style="text-align: right; width: 25%; font-family: Courier; font-size:8pt;"><?php echo number_format($total_fisico_cierre_caja, 0, ",", "."); ?></th>
    <th style="text-align: right; width: 5%;"></th>
  </tr>
  <tr>
    <th style="text-align: left; width: 60%; font-family: Courier; font-size:7pt;">FECHA DE CIERRE:</th>
    <th style="text-align: right; width: 25%; font-family: Courier; font-size:7pt;"><?php echo $fecha_anyo; ?></th>
    <th style="text-align: right; width: 5%;"></th>
  </tr>
  <tr>
    <th style="text-align: left; width: 60%; font-family: Courier; font-size:7pt;">HORA DE CIERRE:</th>
    <th style="text-align: right; width: 25%; font-family: Courier; font-size:7pt;"><?php echo $hora_cierre_caja; ?></th>
    <th style="text-align: right; width: 5%;"></th>
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
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha.$hora.'-'.$cod_cierre_caja.'-'.$fecha_venta_ymd.$hora_compra_his ?></strong>_imp_cierr_caj</td>
  </tr>
</table>
<!--</div>-->
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script>
window.onload = function() {
  document.getElementById("foco_btn_imprimir").focus();
}
</script>
</body>
</html>