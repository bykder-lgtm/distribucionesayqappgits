<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script type="text/javascript" src="js/jquery-barcode.js"></script>
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
<a href="#"><h4>Cuentas por Cobrar</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php 
if (isset($_GET['cod_cuentas_cobrar_abonos'])) { 

  $cod_cuentas_cobrar_abonos    = intval($_GET['cod_cuentas_cobrar_abonos']);

  $sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')";
  $consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
  $total_datos = mysqli_num_rows($consulta);
  $datos = mysqli_fetch_assoc($consulta);

  $cod_cuentas_cobrar           = $datos['cod_cuentas_cobrar'];
  $cod_factura                  = $datos['cod_factura'];
  $cod_tercero                  = $datos['cod_tercero'];
  $abonado                      = $datos['abonado'];
  $cuenta                       = $datos['cuenta'];
  $mensaje                      = $datos['mensaje'];
  $fecha_pago                   = $datos['fecha_pago'];
  $hora                         = $datos['hora'];
  $cliente                     = addslashes($_GET['cliente']);
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = "../admin/cuentas_cobrar_detalle_factura_caja_registradora.php"; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
  $fecha_impr                  = date("Ymd");
  $hora_impr                   = date("His");
  $cod_factura_strpad                  = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
  $sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
  $consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente) or die(mysqli_error($conectar));
  $total_cliente = mysqli_fetch_assoc($consulta_cliente);

  $identificacion_tercero         = $total_cliente['identificacion_tercero'];
  $nombre1_tercero                = $total_cliente['nombre1_tercero'];
  $apellido1_tercero              = $total_cliente['apellido1_tercero'];
  $nombre_cliente                 = $nombre1_tercero.' '.$apellido1_tercero;
//-----------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------//
  $sql_sum_abonos = "SELECT Sum(abonado) As total_abonado FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
  $consulta_sum_abonos  = mysqli_query($conectar, $sql_sum_abonos) or die(mysqli_error($conectar));
  $sum_abonos = mysqli_fetch_assoc($consulta_sum_abonos);

  $sql_monto_deuda = "SELECT monto_deuda AS total_venta, cod_info_factura_venta FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
  $consulta_monto_deuda  = mysqli_query($conectar, $sql_monto_deuda) or die(mysqli_error($conectar));
  $sum_monto_deuda = mysqli_fetch_assoc($consulta_monto_deuda);

  $total_venta                   = $sum_monto_deuda['total_venta'];
  $total_abonado                 = $sum_abonos['total_abonado'];
  $total_deuda                   = $total_venta - $total_abonado;
  $cod_info_factura_venta        = $sum_monto_deuda['cod_info_factura_venta'];
?>
  <table class="table table-striped">
    <tr>
      <td><font color='black' size= "+3">ABONO CUENTAS POR COBRAR:</font></td>
      <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $cod_cuentas_cobrar_abonos; ?></font></td>
    </tr>
    <tr>
      <td><font color='black' size= "+3">NOMBRE CLIENTE:</font></td>
      <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_cliente; ?></font></td>
    </tr>
    <tr>
      <td><font color='black' size= "+3">ABONO:</font></td>
      <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($abonado, 0, ",", "."); ?></font></td>
    </tr>
  </table>

  <table class="table table-striped">
    <tr>
      <td style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $pagina ?>?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>&cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>" id="listo"><img src="../imagenes/listo.png" alt="listo"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td style="text-align: center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>

      <?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
      <td style="text-align:center; width:50%"><button id="btnImprimirAbonoCuentaCobrar"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
      <?php } ?>
      <!--<td style="text-align: center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>-->
    </tr>
  </table>

  <script>  
  $(document).ready(function(){  
    $('#btnImprimirAbonoCuentaCobrar').click(function(){
    var cod_cuentas_cobrar_abonos = <?php echo $cod_cuentas_cobrar_abonos ?>;
    var origen = "0";  
      $.ajax({ url:"../admin/imprimir_abono_cuenta_cobrar_ticket_pos.php", method:"GET", data:{cod_cuentas_cobrar_abonos:cod_cuentas_cobrar_abonos, campo:"cod_cuentas_cobrar_abonos", id:cod_cuentas_cobrar_abonos, origen:origen }, 
       success: function(response){
           if(response==1){
               //alert('Imprimiendo....');
           }else{
               //alert('Error');
           }
       }
      });  
    });
  });  
  </script>
<?php } ?>


<script>
function printPageArea(areaID){

var cod_factura = "<?php echo $cod_factura ?>";
var estandar_barras = "code128";
var renderer = "css";
//var settings = { output:renderer, bgColor: "#FFFFFF", color: "#000000", barWidth: 2, barHeight: 40, moduleSize: 5, posX: 10, posY: 20, addQuietZone: 1 };
//$("#barcodeTarget").html("").show().barcode(cod_factura, estandar_barras, settings);
var printContent = document.getElementById(areaID);
var WinPrint = window.open('', '', 'width=400,height=1000');
WinPrint.document.write(printContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

<div class="table-responsive">
<table class="table table-striped">
<input id="cod_factura" type="hidden" name="cod_factura" value="<?php echo $cod_factura ?>"/>
<!--<td style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/cuentas_cobrar_abonos_imprimir_80mm_pdf.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos ?>&cod_factura=<?php echo $cod_factura ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>" target="_blank"><img src=../imagenes/imprimir_1.png alt="imprimir"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
</table>
</div>

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


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td align="center">---------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:10pt;"><strong>ABONOS CUENTAS POR COBRAR</strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td align="center">---------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NIT CLIENTE: <?php echo $identificacion_tercero; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NOMBRE CLIENTE: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td align="center">---------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><strong>ABONO</strong></td>
<td style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><strong>FECHA</strong></td>
<td style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><strong>PAGO A</strong></td>
<td style="text-align: left; width:2%; font-family: Courier; font-size:9pt;"><strong></strong></td>
</td>
<?php
$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
$datos = mysqli_fetch_assoc($consulta);

$cod_cuentas_cobrar                  = $datos['cod_cuentas_cobrar'];
$cod_tipo_forma_pago                 = $datos['cod_tipo_forma_pago'];
$cod_factura                         = $datos['cod_factura'];
$cod_tercero                         = $datos['cod_tercero'];
$abonado                             = $datos['abonado'];
$cuenta                              = $datos['cuenta'];
$mensaje                             = $datos['mensaje'];
$fecha_pago                          = $datos['fecha_pago'];
$hora                                = $datos['hora'];
$cliente                             = "";
?>
<tr>
<td style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><strong><?php echo $fecha_pago ?></strong></td>
<td style="text-align: left; width:30%; font-family: Courier; font-size:9pt;"><strong><?php echo $cuenta ?></strong></td>
<td style="text-align: left; width:2%; font-family: Courier; font-size:9pt;"><strong></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td align="center">---------------------------------</td>
</tr>
</table>
<?php
$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$nombre_cliente                      = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
$direccion_cli                       = $matriz_cliente['direccion_tercero'];
$nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
$digito_tercero                      = $matriz_cliente['digito_tercero'];
$cod_estado_cuenta_cobrar            = $matriz_cliente['cod_estado_cuenta_cobrar'];
$total_monto_deuda_cuenta_cobrar     = $matriz_cliente['total_monto_deuda_cuenta_cobrar'];
$total_abonado_cuenta_cobrar         = $matriz_cliente['total_abonado_cuenta_cobrar'];
$total_subtotal_cuenta_cobrar        = $matriz_cliente['total_subtotal_cuenta_cobrar'];
$fecha_modificacion_cuenta_cobrar    = $matriz_cliente['fecha_modificacion_cuenta_cobrar'];

if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }
?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:10pt;"><strong>TOTAL CREDITO:</strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_monto_deuda_cuenta_cobrar, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:10pt;"><strong>TOTAL ABONADO:</strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_abonado_cuenta_cobrar, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:10pt;"><strong>SALDO PENDIENTE:</strong></td>
    <td style="text-align: center; width: 40%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_subtotal_cuenta_cobrar, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 2%; font-family: Courier; font-size:10pt;"></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td align="center">---------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%;" id="barcodeTarget" class="barcodeTarget"></td>
    <!--<td style="text-align: center; width: 95%;" id="barcodeTarget" class="barcodeTarget"><div id="barcodeTarget" class="barcodeTarget"></div></td>-->
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'-'.$cod_cuentas_cobrar_abonos ?></strong>_imp_cob_opcimpr</td>
  </tr>
</table>

    </div>
  </div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
</body>
</html>