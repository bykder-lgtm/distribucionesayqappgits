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
<a href="#"><h4>PAGO COMISION A PROPIETARIO</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_cuentas_cobrar_factura_comision_propietario   = intval($_GET['cod_cuentas_cobrar_factura_comision_propietario']);
$cod_cuentas_cobrar          = intval($_GET['cod_cuentas_cobrar']);
$cod_cuentas_cobrar_alerta   = intval($_GET['cod_cuentas_cobrar_alerta']);
$cod_cuentas_cobrar_abonos   = intval($_GET['cod_cuentas_cobrar_abonos']);
$cod_factura                 = intval($_GET['cod_factura']);
$cod_tercero                 = intval($_GET['cod_tercero']);
$cliente                     = addslashes($_GET['cliente']);
$pagina                      = addslashes($_GET['pagina']);
$palabra                     = addslashes($_GET['palabra']);
$pagina_local                = $_SERVER['PHP_SELF'];
$pagina_redirect             = '../admin/comision_propietario_detalle_factura_alquiler.php?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&cod_factura='.$cod_factura.'&pagina='.$pagina.'&palabra='.$palabra;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                  = date("Ymd");
$hora_impr                   = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_cuentas_cobrar_alerta = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
$consulta_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta) or die(mysqli_error($conectar));
$datos_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta);

$cod_producto                 = $datos_cuentas_cobrar_alerta['cod_producto'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_producto = "SELECT cod_producto_barra, nombre_producto, nombre_tipo_producto, direccion_producto, descripcion_producto, cod_tercero FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
$consulta_producto = mysqli_query($conectar, $sql_consulta_producto) or die(mysqli_error($conectar));
$total_producto = mysqli_fetch_assoc($consulta_producto);

$cod_producto_barra                         = $total_producto['cod_producto_barra'];
$nombre_producto                            = $total_producto['nombre_producto'];
$nombre_tipo_producto                       = $total_producto['nombre_tipo_producto'];
$direccion_producto                         = $total_producto['direccion_producto'];
$descripcion_producto                       = $total_producto['descripcion_producto'];
$cod_tercero_propietario                    = $total_producto['cod_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente) or die(mysqli_error($conectar));
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$identificacion_tercero         = $total_cliente['identificacion_tercero'];
$nombre1_tercero                = $total_cliente['nombre1_tercero'];
$nombre2_tercero                = $total_cliente['nombre2_tercero'];
$apellido1_tercero              = $total_cliente['apellido1_tercero'];
$apellido2_tercero              = $total_cliente['apellido2_tercero'];
$nombre_cliente                 = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_propietario = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_propietario'";
$consulta_propietario = mysqli_query($conectar, $sql_consulta_propietario) or die(mysqli_error($conectar));
$total_propietario = mysqli_fetch_assoc($consulta_propietario);

$identificacion_tercero_propietario         = $total_propietario['identificacion_tercero'];
$nombre1_tercero_propietario                = $total_propietario['nombre1_tercero'];
$nombre2_tercero_propietario                = $total_propietario['nombre2_tercero'];
$apellido1_tercero_propietario              = $total_propietario['apellido1_tercero'];
$apellido2_tercero_propietario              = $total_propietario['apellido2_tercero'];
$nombre_cliente_propietario                 = $nombre1_tercero_propietario.' '.$nombre2_tercero_propietario.' '.$apellido1_tercero_propietario.' '.$apellido2_tercero_propietario;
$cliente_propietario                        = $nombre1_tercero_propietario.' '.$nombre2_tercero_propietario.' '.$apellido1_tercero_propietario.' '.$apellido2_tercero_propietario;
$nombre_tipo_identificacion_propietario     = $total_propietario['nombre_tipo_identificacion'];
$telefono1_tercero_propietario              = $total_propietario['telefono1_tercero'];
$correo_tercero_propietario                 = $total_propietario['correo_tercero'];
$nombre_pais_propietario                    = $total_propietario['nombre_pais'];
//-----------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------//
$sql_sum_abonos = "SELECT Sum(abonado) As total_abonado FROM tbl15_cuentas_cobrar_factura_comision_propietario WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
$consulta_sum_abonos  = mysqli_query($conectar, $sql_sum_abonos) or die(mysqli_error($conectar));
$sum_abonos = mysqli_fetch_assoc($consulta_sum_abonos);

$sql_monto_deuda = "SELECT monto_deuda AS total_venta FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
$consulta_monto_deuda  = mysqli_query($conectar, $sql_monto_deuda) or die(mysqli_error($conectar));
$sum_monto_deuda = mysqli_fetch_assoc($consulta_monto_deuda);

$total_venta                   = $sum_monto_deuda['total_venta'];
$total_abonado                 = $sum_abonos['total_abonado'];
$total_deuda                   = $total_venta - $total_abonado;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_cuentas_cobrar_factura_comision_propietario = "SELECT * FROM tbl15_cuentas_cobrar_factura_comision_propietario WHERE cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario'";
$consulta_cuentas_cobrar_factura_comision_propietario = mysqli_query($conectar, $sql_cuentas_cobrar_factura_comision_propietario) or die(mysqli_error($conectar));
$datos_cuentas_cobrar_factura_comision_propietario = mysqli_fetch_assoc($consulta_cuentas_cobrar_factura_comision_propietario);

$numero_alerta                          = $datos_cuentas_cobrar_factura_comision_propietario['numero_alerta'];
$cod_cuentas_cobrar_alerta              = $datos_cuentas_cobrar_factura_comision_propietario['cod_cuentas_cobrar_alerta'];
$fecha_mes                              = $datos_cuentas_cobrar_factura_comision_propietario['fecha_mes'];
$nombre_tabla_mes                       = '0';
$nombre_tabla_anyo                      = '0';
$cod_estado_envio_correo_cuenta_cobro   = '0';
$nombre_tabla_mes                       = '0';

//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//if ($tipo_pago == 1) { $nombre_tipo_pago = 'CONTADO'; $total_cambio = $vlr_cancelado - $total_venta_temp; } elseif ($tipo_pago == 2) { $nombre_tipo_pago = 'CREDITO'; } else { $nombre_tipo_pago = 'CONTADO'; $total_cambio = 0; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad                  = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
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
  <tr>
    <td style="text-align: center;"><strong>NIT PROPIETARIO: <?php echo $identificacion_tercero_propietario; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center;"><strong>NOMBRE PROPIETARIO: <?php echo $nombre1_tercero_propietario; ?></strong></td>
  </tr>
</table>

<table class="table table-striped">
<tr>
<th style="text-align: center;"><strong>PAGADO</strong></th>
<th style="text-align: center;"><strong>FECHA</strong></th>
<th style="text-align: center;"><strong>PERIODO</strong></th>
<?php
$sql = "SELECT * FROM tbl15_cuentas_cobrar_factura_comision_propietario WHERE cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario' ORDER BY fecha_invert DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

$cod_cuentas_cobrar_factura_comision_propietario    = $datos['cod_cuentas_cobrar_factura_comision_propietario'];
$abonado                      = $datos['abonado'];
$cuenta                       = $datos['cuenta'];
$mensaje                      = $datos['mensaje'];
$fecha_pago                   = $datos['fecha_pago'];
$hora                         = $datos['hora'];
$numero_alerta                = $datos['numero_alerta'];
?>
<tr>
<td style="text-align: center;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
<td style="text-align: center;"><strong><?php echo $fecha_pago ?></strong></td>
<td style="text-align: center;"><strong><?php echo $numero_alerta ?></strong></td>
</tr>
<?php } ?>
</table>

<table class="table table-striped">
<input id="cod_factura" type="hidden" name="cod_factura" value="<?php echo $cod_factura ?>"/>
<td style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $pagina_redirect ?>" id="listo"><img src="../imagenes/listo.png" alt="listo"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<!--<td style="text-align: center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>-->
<td style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/cuentas_cobrar_abonos_alquiler_comprobante_comision_propietario_imprimir_pdf.php?cod_cuentas_cobrar_factura_comision_propietario=<?php echo $cod_cuentas_cobrar_factura_comision_propietario ?>&cod_factura=<?php echo $cod_factura ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $nombre_cliente ?>" target="_blank"><img src=../imagenes/imprimir_.png alt="imprimir"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<!--<td style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/enviar_comprobante_ingreso_pagado_alquiler_correo_inquilino_reg.php?cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&fecha_mes=<?php echo $fecha_mes;?>&nombre_tabla_mes=<?php echo $nombre_tabla_mes;?>&nombre_tabla_anyo=<?php echo $nombre_tabla_anyo;?>&cod_estado_envio_correo_cuenta_cobro=<?php echo $cod_estado_envio_correo_cuenta_cobro;?>&pagina=<?php echo $pagina;?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_cuentas_cobrar_factura_comision_propietario=<?php echo $cod_cuentas_cobrar_factura_comision_propietario;?>&cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/enviar_historia_clinica_correo.png alt="Adjuntar"></a></td>-->
<td style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://sucursalpersonas.transaccionesbancolombia.com/" target="_blank"><img src=../imagenes/btn_bancolobia.png alt="btn_bancolobia"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
<td style="text-align: center; width: 99%; font-family: Courier; font-size:10pt;"><strong>ABONOS PRESTAMOS</strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td align="center">---------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NIT TERCERO: <?php echo $identificacion_tercero; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NOMBRE TERCERO: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>FACTURA: <?php echo $cod_factura; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td align="center">---------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong>ABONO</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:9pt;"><strong>FECHA</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:9pt;"><strong># CUOTA</strong></td>
</td>
<?php
$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario' ORDER BY fecha_invert DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

$cod_cuentas_cobrar_factura_comision_propietario    = $datos['cod_cuentas_cobrar_factura_comision_propietario'];
$abonado                      = $datos['abonado'];
$cuenta                       = $datos['cuenta'];
$mensaje                      = $datos['mensaje'];
$fecha_pago                   = $datos['fecha_pago'];
$hora                         = $datos['hora'];
$numero_alerta                = $datos['numero_alerta'];
?>
<tr>
<td style="text-align: center; width:50%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong><?php echo $fecha_pago ?></strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:9pt;"><strong><?php echo $numero_alerta ?></strong></td>
</tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td align="center">---------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL CREDITO:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_venta, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL ABONADO:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_abonado, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>SALDO PENDIENTE:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_deuda, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"></td>
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