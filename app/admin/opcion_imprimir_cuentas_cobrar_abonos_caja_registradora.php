<?php $serguridad_pagina = 1; ?>
<?php $cod_tipo_accion_caja_registradora = "1"; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior_caja_registradora.php'); ?>
<?php include_once('../admin/01_modulo_permisos.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<meta charset="utf-8">
<title><?php echo $nombre_emp;?></title>
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo $icono_emp;?>" type="image/x-icon" rel="shortcut icon" />

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="../estilo_css/caja_registradora_jqueryscripttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../estilo_css/caja_registradora_bootstrap.min.css">
<script src="../js/caja_registradora_math.min.js"></script>
<script src="../js/caja_registradora_jquery-3.2.1.min.js"></script>
<script src="../js/caja_registradora_popper.min.js"></script>
<script src="../js/caja_registradora_bootstrap.min.js"></script>

<script src="../js/default.js" type="text/javascript"></script>
<script type="text/javascript" src="js/chosen.jquery.js"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="../estilo_css/chosen_600px.css">

<link rel="stylesheet" href="../estilo_css/caja_registradora_font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/estilo_caja_registradora.css">

<script type="text/javascript" src="../js/qrious.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">

<style> .deshabilitar_boton { pointer-events: none; } </style>
</head>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<body>
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
  $cliente                      = "";
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
  $fecha_impr                  = date("Ymd");
  $hora_impr                   = date("His");
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
      <td style="text-align:center; width:50%"><a href="../admin/facturacion_caja_registradora.php" class="btn btn-primary">Ir a Caja Registradora</a></td>
      <?php if ($cod_estado_habilitar_btn_imp_venta_direct_driv_global == '0') { ?>
      <td style="text-align:center; width:50%"><button id="btnImprimirAbonoCuentaCobrar"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
      <?php } ?>
      <td style="text-align: center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
    </tr>
  </table>

  <script>  
  $(document).ready(function(){  
    $('#btnImprimirAbonoCuentaCobrar').click(function(){
    var cod_cuentas_cobrar_abonos = <?php echo $cod_cuentas_cobrar_abonos ?>;
    var origen = "0";  
      $.ajax({ url:"../admin/imprimir_abono_cuenta_cobrar_ticket_pos.php", method:"GET", data:{cod_cuentas_cobrar_abonos:cod_cuentas_cobrar_abonos, campo:"cod_cuentas_cobrar_abonos", id:cod_cuentas_cobrar_abonos, origen:origen }, 
       success: function(response) {
           if(response==1){
               //alert('Imprimiendo....');
           } else {
               //alert('Error');
           }
       }
      });  
    });
  });  
  </script>
<?php } ?>


<hr>
<table class="table table-striped">
  <tr>
    <td style="text-align:center;"><a href="../admin/lista_caja_virtual.php" class="btn btn-warning">Ir a Modulo Administrativo</a></td>
  </tr>
</table>

</body>
</html>

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
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'-'.$cod_cuentas_cobrar_abonos ?></strong>_imp_cobcajreg_opcimpr</td>
  </tr>
</table>

    </div>
  </div>
</div>