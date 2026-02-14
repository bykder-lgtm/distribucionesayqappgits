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
<!--
<div class="breadcrumbs">
<a href="#"><h4>Cuentas por Cobrar</h4></a>
</div>
-->
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                         = $_SERVER['PHP_SELF'];
$cod_cuentas_cobrar             = intval($_GET['cod_cuentas_cobrar']);
$cod_tercero                    = intval($_GET['cod_tercero']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                     = date("Ymd");
$hora_impr                      = date("His");
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
$cliente                        = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

$monto_deuda_smtr       = 0;
$abonado_smtr           = 0;
$subtotal_smtr          = 0;

$sql_total_facturas = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta,
tbl15_cuentas_cobrar.monto_deuda_sin_interes, tbl15_cuentas_cobrar.subtotal_sin_interes, tbl15_cuentas_cobrar.numero_cuota, tbl15_cuentas_cobrar.monto_cuota, 
tbl15_cuentas_cobrar.monto_cuota_sin_interes, tbl15_cuentas_cobrar.interes_ptj, tbl15_cuentas_cobrar.monto_cuota_interes,
tbl15_cuentas_cobrar.nombre_tipo_cobro 
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_cuentas_cobrar='$cod_cuentas_cobrar') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$total_facturas = mysqli_num_rows($consulta_total_facturas);
$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

$cod_factura                    = $datos_total_facturas['cod_factura'];
$monto_deuda                    = $datos_total_facturas['monto_deuda'];
$monto_deuda_sin_interes        = $datos_total_facturas['monto_deuda_sin_interes'];
$subtotal                       = $datos_total_facturas['subtotal'];
$subtotal_sin_interes           = $datos_total_facturas['subtotal_sin_interes'];
$numero_cuota                   = $datos_total_facturas['numero_cuota'];
$monto_cuota                    = $datos_total_facturas['monto_cuota'];
$monto_cuota_sin_interes        = $datos_total_facturas['monto_cuota_sin_interes'];
$interes_ptj                    = $datos_total_facturas['interes_ptj'];
$monto_cuota_interes            = $datos_total_facturas['monto_cuota_interes'];
$nombre_tipo_cobro              = $datos_total_facturas['nombre_tipo_cobro'];
$abonado                        = $datos_total_facturas['abonado'];
$cod_factura_strpad             = str_pad($cod_factura, 4, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
<script>
function printPageArea(areaID){

var cod_factura = "<?php echo $cod_factura_strpad ?>";
var estandar_barras = "code128";
var renderer = "css";

var settings = { output:renderer, bgColor: "#FFFFFF", color: "#000000", barWidth: 2, barHeight: 40, moduleSize: 5, posX: 10, posY: 20, addQuietZone: 1 };
$("#barcodeTarget").html("").show().barcode(cod_factura, estandar_barras, settings);

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
<td style="text-align: center;"><strong><a href="../admin/lista_cuentas_cobrar_prestamo.php"><font size="4px">REGRESAR</font></a></strong></td>
</tr>
<!--
<tr>
<td style="text-align: center;"><strong><a href="../admin/ver_cuentas_cobrar_abonos_globales.php?cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>"><font size="4px">VER ABONOS GLOBALES</font></a></strong></td><br><br>
</tr>
-->
<tr>
<td style="text-align: center;"><strong><font size="4">TERCERO: <?php echo $cliente;?><br><br>
</tr>
</table>

<table class="table table-striped">
<tr>
<!--
<?php
if ($total_facturas > 1) { ?>
<td style="text-align: center;"><a href="../admin/cuentas_cobrar_abono_global_cliente.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_tercero=<?php echo $cod_tercero?>"><img src=../imagenes/abono_global.png alt="imprimir"></a></td>
<?php } else { ?>
<td style="text-align: center;"><a href="../admin/modificar_cuentas_cobrar.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura?>&cod_tercero=<?php echo $cod_tercero?>&cliente=<?php echo $cliente?>"><img src=../imagenes/abono_global.png alt="imprimir"></a></td>
<?php } ?>
-->
<td style="text-align: center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
</tr>
</table>

<table class="table table-striped">
<tr>
<th style="text-align: center;"><font size='3'>TOTAL PRESTAMO</font></th>
<th style="text-align: center;"><font size='3'>% INTERES</font></th>
<th style="text-align: center;"><font size='3'>TOTAL PRESTAMO + INTERES</font></th>
<th style="text-align: center;"><font size='3'># CUOTAS</font></th>
<th style="text-align: center;"><font size='3'>VALOR CUOTA</font></th>
<th style="text-align: center;"><font size='3'>TOTAL ABONADO</font></th>
<th style="text-align: center;"><font size='3'>TOTAL PENDIENTE</font></th>
</tr>
<tr>
<td style="text-align: center;"><font size='3'><?php echo number_format($monto_deuda_sin_interes, 0, ",", ".")?></font></a></td>
<th style="text-align: center;"><font size='3'><?php echo $interes_ptj?></font></a></th>
<th style="text-align: center;"><font size='3'><?php echo number_format($monto_deuda, 0, ",", ".")?></font></a></th>
<th style="text-align: center;"><font size='3'><?php echo $numero_cuota?></font></a></th>
<th style="text-align: center;"><font size='3'><?php echo number_format($monto_cuota, 0, ",", ".")?></font></a></th>
<th style="text-align: center;"><font size='3'><?php echo number_format($abonado, 0, ",", ".");?></font></th>
<th style="text-align: center;"><font size='3'><?php echo number_format($subtotal, 0, ",", "."); ?></font></th>
</tr>
</table>


<table class="table table-striped">
<tr>
<?php if ($cod_seguridad== '3') { ?>
<td style="text-align: center;"><strong>ELIM</strong></td>
<?php } ?>
<td style="text-align: center;"><strong>ABONAR</strong></td>
<td style="text-align: center;"><strong># CUOTA</strong></td>
<td style="text-align: center;"><strong>VALOR CUOTA</strong></td>
<td style="text-align: center;"><strong>FECHA PAGO</strong></td>
<td style="text-align: center;"><strong>ESTADO</strong></td>
</tr>
<?php
$calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar='$cod_cuentas_cobrar') ORDER BY fecha_pago ASC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cod_cuentas_cobrar_alerta      = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
$cod_cuentas_cobrar             = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
$numero_alerta                  = $datos_cuenta_cobrar['numero_alerta'];
$cod_factura                    = $datos_cuenta_cobrar['cod_factura'];
$monto_deuda                    = $datos_cuenta_cobrar['monto_deuda'];
$abonado                        = $datos_cuenta_cobrar['abonado'];
$subtotal                       = $datos_cuenta_cobrar['subtotal'];
$mensaje                        = $datos_cuenta_cobrar['mensaje'];
$fecha_pago                     = $datos_cuenta_cobrar['fecha_pago'];
$vendedor                       = $datos_cuenta_cobrar['vendedor'];
$monto_deuda_smtr               = $monto_deuda_smtr + $monto_deuda;
$monto_cuota                    = $datos_cuenta_cobrar['monto_cuota'];
$cod_estado                     = $datos_cuenta_cobrar['cod_estado'];

$abonado_smtr                   = $abonado_smtr + $abonado;
$subtotal_smtr                  = $subtotal_smtr + $subtotal;

if ($cod_estado == '1') { $nombre_estado = 'PAGADO'; $estilo_letra = 'class="text-success"'; } elseif ($cod_estado == '0') { $nombre_estado = 'NO PAGADO'; $estilo_letra = 'class="text-warning"'; } else { $nombre_estado = 'VENCIDO'; $estilo_letra = 'class="text-danger"'; }
?>
<tr>
<?php if ($cod_seguridad== '3') { ?>
<td style="text-align: center;"><a href="../modificar_eliminar/eliminar_cuentas_cobrar_y_abonos.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>&pagina=<?php echo $pagina;?>"><img src=../imagenes/eliminar.png alt="Abonar"></a></td>
<?php } ?>
<?php if ($cod_estado== '0') { ?>
<td style="text-align: center;"><a href="../admin/reg_cuentas_cobrar_abono.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_cuentas_cobrar_alerta=<?php echo $cod_cuentas_cobrar_alerta;?>&cod_factura=<?php echo $cod_factura;?>&numero_alerta=<?php echo $numero_alerta;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><img src=../imagenes/base_caja.png alt="Abonar"></a></td>
<?php } else { ?>
<td style="text-align: center;"></td>
<?php } ?>
<td style="text-align: center;"><font size='3'><?php echo $numero_alerta;?></font></td>
<td style="text-align: center;"><font size='3'><?php echo number_format($monto_cuota, 0, ",", ".")?></font></a></td>
<td style="text-align: center;"><font size='3'><?php echo $fecha_pago;?></font></td>
<td style="text-align: center;" <?php echo $estilo_letra;?>><font size='3'><?php echo $nombre_estado;?></font></td>
</tr>
<?php } ?>
</table>
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: left;"><div>

<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:11pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 95%; font-family: Courier; font-size:10pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 90%; font-family: Courier; font-size:10pt;"><strong>PRESTAMOS (POR TERCERO)</strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NIT TERCERO: <?php echo $identificacion_tercero; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>NOMBRE TERCERO: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="1" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:9pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:10pt;"><strong>FACT</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:10pt;"><strong>CREDIT</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:10pt;"><strong>ABONAD</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong>PENDIENTE</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong>FECHA</strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong></strong></td>
<tr>
</tr>
<?php
$monto_deuda_smtr_1              = 0;
$abonado_smtr_1                  = 0;
$subtotal_smtr_1                 = 0;

$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cod_cuentas_cobrar            = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
$cod_factura                   = $datos_cuenta_cobrar['cod_factura'];
$cliente                       = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
$monto_deuda                   = $datos_cuenta_cobrar['monto_deuda'];
$abonado                       = $datos_cuenta_cobrar['abonado'];
$subtotal                      = $datos_cuenta_cobrar['subtotal'];
$mensaje                       = $datos_cuenta_cobrar['mensaje'];
$fecha_pago                    = $datos_cuenta_cobrar['fecha_pago'];
$vendedor                      = $datos_cuenta_cobrar['vendedor'];
$monto_deuda_smtr_1            = $monto_deuda_smtr_1 + $monto_deuda;
$abonado_smtr_1                = $abonado_smtr_1 + $abonado;
$subtotal_smtr_1               = $subtotal_smtr_1 + $subtotal;
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:10pt;"><strong><?php echo $cod_factura ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($monto_deuda, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:50%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($subtotal, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:15%; font-family: Courier; font-size:10pt;"><strong><?php echo $fecha_pago ?></strong></td>
<td style="text-align: center; width:5%; font-family: Courier; font-size:10pt;"><strong></strong></td>
</tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL CREDITO:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($monto_deuda_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL ABONADO:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($abonado_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL PENDIENTE:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($subtotal_smtr_1, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:10pt;"></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
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
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'-'.$cod_tercero ?></strong>_imp_cobdetallfact</td>
  </tr>
</table>

		</div>
	</div>
</div>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
</body>
</html>