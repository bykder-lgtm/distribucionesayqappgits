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

<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor)
myajax.Link('guardar_cuentas_cobrar_abonos_editable.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
</head>
<body id="pageBody" onLoad="myajax = new isiAJAX();">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="#"><h4>Prestamo</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_cuentas_cobrar                    = intval($_GET['cod_cuentas_cobrar']);
$cod_tercero                           = intval($_GET['cod_tercero']);
$cod_factura                           = intval($_GET['cod_factura']);
$cliente                               = addslashes($_GET['cliente']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                            = date("Ymd");
$hora_impr                             = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_sum_abonos = "SELECT Sum(abonado) As total_abonado FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_sum_abonos  = mysqli_query($conectar, $sql_sum_abonos) or die(mysqli_error($conectar));
$sum_abonos = mysqli_fetch_assoc($consulta_sum_abonos);

$sql_monto_deuda = "SELECT monto_deuda AS total_venta FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_monto_deuda  = mysqli_query($conectar, $sql_monto_deuda) or die(mysqli_error($conectar));
$sum_monto_deuda = mysqli_fetch_assoc($consulta_monto_deuda);

$total_venta                    = $sum_monto_deuda['total_venta'];
$total_abonado                  = $sum_abonos['total_abonado'];
$total_deuda                    = $total_venta - $total_abonado;

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
<td style="text-align: center;"><strong><a href="../admin/cuentas_cobrar_detalle_factura_prestamo.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar?>&cod_tercero=<?php echo $cod_tercero?>"><font size="3px">REGRESAR</font></a></strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="3px">ABONOS TERCERO: <?php echo $nombre_cliente;?> </font></strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="3px">FACTURA: <?php echo $cod_factura; ?></font></strong></td>
</tr>
<tr>
<td style="text-align: center;"><a href="../admin/reg_cuentas_cobrar_abono.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar?>&cod_tercero=<?php echo $cod_tercero?>&cod_factura=<?php echo $cod_factura?>"><font size="3px">NUEVO ABONO</font></a></td>
</tr>
</table>

<table class="table table-striped">
<tr>
<td style="text-align: center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
<!--<td style="text-align: center;"><a href="../admin/descargar_abonos_cuentas_cobrar_por_factura_xls.php?cod_factura=<?php echo $cod_factura?>&cod_tercero=<?php echo $cod_tercero?>"><img src=../imagenes/btn_xls.png alt="btn_xls"></a></td>-->
</tr>
</table>
<br>

<table class="table table-striped">
<tr>
<td style="text-align: center;"><strong># CUOTA</strong></td>
<td style="text-align: center;"><strong>ABONOS</strong></td>
<td style="text-align: center;"><strong>PAGO A</strong></td>
<td style="text-align: center;"><strong>MENSAJE</strong></td>
<td style="text-align: center;"><strong>FECHA</strong></td>
<td style="text-align: center;"><strong>HORA</strong></td>
<td style="text-align: center;"><strong>CALIFICACION</strong></td>
<td style="text-align: center;"><strong>VER SOPORTE</strong></td>
<td style="text-align: center;"><strong>CAMBIAR SOPORTE</strong></td>
<!--<td style="text-align: center;"><strong>IMP</strong></td>-->
</tr>
<?php
$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') ORDER BY cod_cuentas_cobrar_abonos DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

$cod_cuentas_cobrar_abonos  = $datos['cod_cuentas_cobrar_abonos'];
$abonado                    = $datos['abonado'];
//$cuenta                     = $datos['cuenta'];
$mensaje                    = $datos['mensaje'];
$fecha_pago                 = $datos['fecha_pago'];
$hora                       = $datos['hora'];
$numero_alerta              = $datos['numero_alerta'];
$url_img_orig_producto      = $datos['url_img_orig_producto'];
$url_img_min_producto       = $datos['url_img_min_producto'];
$cod_tipo_calificacion      = $datos['cod_tipo_calificacion'];
$nombre_tipo_calificacion   = $datos['nombre_tipo_calificacion'];
$cod_administrador          = $datos['cod_administrador'];

$sql_usuario_admin = "SELECT * FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_usuario_admin = mysqli_query($conectar, $sql_usuario_admin);
$info_usuario_admin = mysqli_fetch_assoc($resultado_usuario_admin);
  
$cedula                        = $info_usuario_admin['cedula'];
$nombres                       = $info_usuario_admin['nombres'];
$apellidos                     = $info_usuario_admin['apellidos'];
$cuenta                        = $info_usuario_admin['cuenta'];
$usuario                       = $cuenta;

if ($url_img_orig_producto == '') { $imagen_cargar = "../imagenes/img_nodisponible.png"; } else { $imagen_cargar = "../imagenes/img_disponible.png"; }
?>
<tr>
<td style="text-align: center;"><font size="3px"><?php echo $numero_alerta; ?></font></td>
<?php if ($cod_seguridad== '1') { ?><td style="text-align: center;"><input onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'abonado', <?php echo $cod_cuentas_cobrar_abonos;?>)" id="<?php echo $cod_cuentas_cobrar_abonos;?>" value="<?php echo $abonado;?>" class="input-block-level"></td><?php } else { ?><td style="text-align: center;"><font size="4px"><?php echo number_format($abonado, 0, ",", "."); ?></font></td><?php } ?>
<td style="text-align: center;"><font size="3px"><?php echo $usuario; ?></font></td>
<td align="left"><font size="3px"><?php echo $mensaje; ?></font></td>
<td style="text-align: center;"><font size="3px"><?php echo $fecha_pago; ?></font></td>
<td style="text-align: center;"><font size="3px"><?php echo $hora; ?></font></td>
<td style="text-align: center;"><font size="3px"><?php echo $nombre_tipo_calificacion; ?></font></td>
<td style="text-align: center;"><font size='3'><a href="<?php echo $url_img_orig_producto; ?>" target="_blank" ><img src="<?php echo $imagen_cargar; ?>" alt=""></a></font></td>
<td style="text-align: center;"><font size='3'><a href="../admin/edit_soporte_cuenta_cobrar_abonos_prestamo.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos; ?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar; ?>&cod_tercero=<?php echo $cod_tercero; ?>&cod_factura=<?php echo $cod_factura; ?>&cliente=<?php echo $cliente; ?>"><img src="../imagenes/adjuntar_archivo.png" alt=""></a></font></td>
<!--<td style="text-align: center;"><a href="../admin/cuentas_cobrar_abonos_imprimir_80mm_pdf.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos?>&cod_factura=<?php echo $cod_factura?>&cod_tercero=<?php echo $cod_tercero?>"  target="_blank"><img src=../imagenes/imprimir_imgpeq.png alt="imprimir_imgpeq"></a></td>-->
</tr>
<?php } ?>
</table>

<table class="table table-striped">
<tr>
<td align="left"><font size="3">TOTAL CREDITO: </font></td><td style="text-align: left;"><font size="3"><?php echo number_format($total_venta, 0, ",", "."); ?></font></td>
</tr>
<tr>
<td align="left"><font size="3">TOTAL ABONADO: </font></td><td style="text-align: left;"><font size="3"><?php echo number_format($total_abonado, 0, ",", "."); ?></font></td>
</tr>
<tr>
<td align="left"><font size="3">TOTAL PENDIENTE: </font></td><td style="text-align: left;"><font size="3"><?php echo number_format($total_deuda, 0, ",", "."); ?></font></td>
</tr>
</table>
</form>

<table class="table table-striped">
	
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
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width: 90%; font-family: Courier; font-size:10pt;"><strong>ABONOS CUENTAS POR COBRAR (POR FACTURA)</strong></td>
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
  <tr>
    <td style="text-align: left; width: 50%; font-family: Courier; font-size:10pt;"><strong>FACTURA: <?php echo $cod_factura; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center;">----------------------------------</td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:10pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong>ABONO</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:9pt;"><strong>FECHA</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:9pt;"><strong>PAGO A</strong></td>
</td>
<?php
$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE cod_factura = '$cod_factura' ORDER BY fecha_invert DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta)) {

$cod_cuentas_cobrar_abonos    = $datos_cuenta_cobrar['cod_cuentas_cobrar_abonos'];
$abonado                      = $datos_cuenta_cobrar['abonado'];
//$cuenta                       = $datos_cuenta_cobrar['cuenta'];
$mensaje                      = $datos_cuenta_cobrar['mensaje'];
$fecha_pago                   = $datos_cuenta_cobrar['fecha_pago'];
$hora                         = $datos_cuenta_cobrar['hora'];
$cod_administrador            = $datos_cuenta_cobrar['cod_administrador'];

$sql_usuario_admin = "SELECT * FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_usuario_admin = mysqli_query($conectar, $sql_usuario_admin);
$info_usuario_admin = mysqli_fetch_assoc($resultado_usuario_admin);
  
$cedula                        = $info_usuario_admin['cedula'];
$nombres                       = $info_usuario_admin['nombres'];
$apellidos                     = $info_usuario_admin['apellidos'];
$cuenta                        = $info_usuario_admin['cuenta'];
$usuario                       = $cuenta;
?>
<tr>
<td style="text-align: center; width:50%; font-family: Courier; font-size:9pt;"><strong><?php echo number_format($abonado, 0, ",", ".") ?></strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:9pt;"><strong><?php echo $fecha_pago ?></strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:9pt;"><strong><?php echo $usuario ?></strong></td>
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
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_venta, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:10pt;"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL ABONADO:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_abonado, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:10pt;"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 99%; font-family: Courier; font-size:10pt;"><strong>TOTAL PENDIENTE:</strong></td>
    <td style="text-align: right; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_deuda, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:10pt;"><strong></strong></td>
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
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'-'.$cod_tercero ?></strong>_imp_cob_abon</td>
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