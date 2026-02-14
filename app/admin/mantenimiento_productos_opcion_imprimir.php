<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../js/qrcode.js"></script>

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
$pagina_local = $_SERVER['PHP_SELF'];

$cod_info_factura_venta               = intval($_GET['cod_info_factura_venta']);
$pagina                               = addslashes($_GET['pagina']).'?cod_info_factura_venta='.$cod_info_factura_venta;
$cod_info_factura_venta_codif         = DAXCODIFCRYPTOR::encodifdax($cod_info_factura_venta);
$cod_info_factura_venta_codif_cryp    = DAXCODIFCRYPTOR::encriptardax($cod_info_factura_venta_codif);

$obtener_informacion = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$consultar_informacion = mysqli_query($conectar, $obtener_informacion) or die(mysqli_error($conectar));
$info_emp = mysqli_fetch_assoc($consultar_informacion);

$titulo_emp                          = $info_emp['titulo'];
$desarrollador_emp                   = $info_emp['desarrollador'];
$pag_desarrollador_emp               = $info_emp['pag_desarrollador'];
$correo_desarrollador_emp            = $info_emp['correo_desarrollador'];
$anyo_emp                            = $info_emp['anyo'];
$nombre_emp                          = $info_emp['nombre'];
$eslogan_emp                         = $info_emp['eslogan'];
$nombre_propietario_emp              = $info_emp['nombre_propietario'];
$cedula_propietario_emp              = $info_emp['cedula_propietario'];
$res_emp                             = $info_emp['res'];
$res1_emp                            = $info_emp['res1'];
$res2_emp                            = $info_emp['res2'];
$fecha_res_emp                       = $info_emp['fecha_res'];
$prefijo_res_emp                     = $info_emp['prefijo_res'];
$pais_emp                            = $info_emp['pais'];
$departamento_emp                    = $info_emp['departamento'];
$ciudad_emp                          = $info_emp['ciudad'];
$localidad_emp                       = $info_emp['localidad'];
$direccion_emp                       = $info_emp['direccion'];
$correo_emp                          = $info_emp['correo'];
$cabecera_emp                        = $info_emp['cabecera'];
$telefono_emp                        = $info_emp['telefono'];
$nit_empresa_emp                     = $info_emp['nit_empresa'];
$regimen_emp                         = $info_emp['regimen'];
$propietario_nombres_apellidos_emp   = $info_emp['propietario_nombres_apellidos'];
$propietario_nit_emp                 = $info_emp['propietario_nit'];
$propietario_url_firma_emp           = $info_emp['propietario_url_firma'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_info_fact = "SELECT * FROM tbl15_info_factura_mantenimiento WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
$info_fact = mysqli_fetch_assoc($resultado_info_fact);

$cod_factura                         = $info_fact['cod_factura'];
$fecha_anyo                          = $info_fact['fecha_anyo'];
$fecha_hora                          = substr($info_fact['fecha_hora'], 0, 5);
$total_precio_compra                 = $info_fact['total_precio_compra'];
$total_precio_venta                  = $info_fact['total_precio_venta'];
$total_datos_data                    = $info_fact['total_datos_data'];
$cod_tercero                         = $info_fact['cod_tercero'];
$cuenta                              = $info_fact['cuenta'];
$vlr_cancelado                       = $info_fact['vlr_cancelado'];
$vlr_vuelto                          = $info_fact['vlr_vuelto'];
$cod_tipo_pago                       = $info_fact['cod_tipo_pago'];
$cod_administrador                   = $info_fact['cod_administrador'];
$cod_tipo_forma_pago                 = $info_fact['cod_tipo_forma_pago'];
$nombre_tipo_factura                 = $info_fact['nombre_tipo_factura'];
$nombre_tipo_moneda                  = $info_fact['nombre_tipo_moneda'];
$cod_resolucion_facturacion          = $info_fact['cod_resolucion_facturacion'];
$descuento_ptj                       = $info_fact['descuento_ptj'];
$cod_caja_virtual                    = $info_fact['cod_caja_virtual'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);

$nombre_tipo_forma_pago                         = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion')";
$consulta_resolucion_facturacion = mysqli_query($conectar, $sql_resolucion_facturacion) or die(mysqli_error($conectar));
$matriz_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

$cod_tipo_resolucion_facturacion        = $matriz_resolucion_facturacion['cod_tipo_resolucion_facturacion'];
$nombre_tipo_resolucion_facturacion     = $matriz_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
$numero_resolucion_facturacion          = $matriz_resolucion_facturacion['numero_resolucion_facturacion'];
$ini_resolucion_facturacion             = $matriz_resolucion_facturacion['ini_resolucion_facturacion'];
$fin_resolucion_facturacion             = $matriz_resolucion_facturacion['fin_resolucion_facturacion'];
$prefijo_resolucion_facturacion         = $matriz_resolucion_facturacion['prefijo_resolucion_facturacion'];
$fecha_resolucion_facturacion           = $matriz_resolucion_facturacion['fecha_resolucion_facturacion'];
$vigencia_meses_resolucion_facturacion  = $matriz_resolucion_facturacion['vigencia_meses_resolucion_facturacion'];
$nombre_tipo_estado                     = $matriz_resolucion_facturacion['nombre_tipo_estado'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_diseno_usario_vendedor = "SELECT nombres, apellidos, cod_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_diseno_usario_vendedor = mysqli_query($conectar, $obtener_diseno_usario_vendedor) or die(mysqli_error($conectar));
$matriz_usario_vendedor = mysqli_fetch_assoc($resultado_diseno_usario_vendedor);

$usario_vendedor                     = $matriz_usario_vendedor['nombres'].' '.$matriz_usario_vendedor['apellidos'];
$cod_caja                            = $matriz_usario_vendedor['cod_caja'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$nombre_cliente                      = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
$direccion_cli                       = $matriz_cliente['direccion_tercero'];
$nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$suma_temporal = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva, 
Sum(total_venta_producto*(descuento_ptj/100)) AS total_desc, Sum(total_venta_producto) AS total_venta_neta FROM tbl15_mantenimiento_producto 
WHERE (cod_info_factura_venta= '$cod_info_factura_venta')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_temporal);

$total_venta_neta                    = ($suma['total_venta_neta']);
$subtotal_base                       = ($suma['subtotal_base']);
$total_desc                          = ($suma['total_desc']);
$total_iva                           = ($suma['total_iva']);
$total_venta_temp                    = ($suma['total_venta']);
$vlr_cambio                          = ($vlr_cancelado - $total_venta_temp);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
$resultado_tipo_pago = mysqli_query($conectar, $obtener_tipo_pago) or die(mysqli_error($conectar));
$data_tipo_pago = mysqli_fetch_assoc($resultado_tipo_pago);

$nombre_tipo_pago                     = $data_tipo_pago['nombre_tipo_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad                   = str_pad($cod_factura, 3, "0", STR_PAD_LEFT);
$cod_info_factura_strpad              = str_pad($cod_info_factura_venta, 3, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$resta                               = 1516399999;
$time_seg                            = time();
$time_date_ymd                       = strtotime(date("Y/m/d"));
$fecha                               = date("Ymd");
$hora                                = date("His");
$fecha_venta_ymd                     = date("Ymd", strtotime($fecha_anyo));
$hora_venta_his                      = date("His");
$fecha_hoy                           = date("Y-m-d");
$url_qr                              = $url_encuesta_experiencia_compra."/pageditaxe/admin/inicio.php?cod_info_factura_venta_codif_cryp=".$cod_info_factura_venta_codif_cryp;  
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
    <td><font color='black' size= "+3">TIPO FACTURA:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_tipo_factura; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">FACTURA NO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $cod_factura; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">TIPO DE PAGO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_tipo_pago; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">CLIENTE:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo $nombre_cliente; ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">SUBTOTAL:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($subtotal_base, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='green' size= "+2">%DESCUENTO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='green' size= "+2"><?php echo $descuento_ptj.'%'; ?></font></td>
  </tr>
  <tr>
    <td><font color='green' size= "+2">$DESCUENTO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='green' size= "+2"><?php echo number_format($total_desc, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='green' size= "+2">IVA:</font></td>
    <td style="text-align:right;" colspan="2"><font color='green' size= "+2"><?php echo number_format($total_iva, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+3">TOTAL VENTA:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($total_venta_temp, 0, ",", "."); ?></font></td>
  </tr>
<?php if ($cod_tipo_pago == '1') { ?>
  <tr>
    <td><font color='black' size= "+3">RECIBIDO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+3"><?php echo number_format($vlr_cancelado, 0, ",", "."); ?></font></td>
  </tr>
  <tr>
    <td><font color='black' size= "+4">CAMBIO:</font></td>
    <td style="text-align:right;" colspan="2"><font color='black' size= "+4"><?php echo number_format($vlr_cambio, 0, ",", "."); ?></font></td>
  </tr>
<?php } ?>
</table>

<table class="table table-striped">
  <tr>
    <td style="text-align:center;"><a href="<?php echo $pagina?>" id="listo"><img src="../imagenes/listo.png" alt="listo"></a></td>
    <td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>
    <td style="text-align:center;"><button id="btnImprimir"><img src="../imagenes/imprimir_2.png" alt="imprimir"></button></td>
    <td style="text-align:center;"><a href="../admin/ver_factura_mantenimiento_pdf.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>" target="_blank"><img src="../imagenes/imprimir_.png"></a></td>
  </tr>
</table>
</center>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: center;"><div>

<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width: 98%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:10pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><===========================================></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>FECHA: <?php echo $fecha_anyo; ?>-<?php echo $fecha_hora; ?></strong></td>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>FACTURA DE MANTENIMIENTO: <?php echo $prefijo_resolucion_facturacion.' '.$cod_factura; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago; ?></strong></td>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>TIPO DE PAGO: <?php echo $nombre_tipo_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong><?php echo ($nombre_tipo_identificacion); ?> CLIENTE: <?php echo ($cedula_cli); ?></strong></td>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>CLIENTE: <?php echo utf8_decode($nombre_cliente); ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong>CAJA: <?php echo $cod_caja; ?></strong></td>
    <td style="text-align: left; width: 49%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_concepto_multi_virtual; ?> VIRTUAL: <?php echo $cod_caja_virtual; ?></strong></td>
  </tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:7pt;"><strong>VENDEDOR (A): <?php echo $usario_vendedor; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><===========================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong>CANT</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:7pt;"><strong>ARTICULO</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:7pt;"><strong>P.UNIT</strong></td>
<td style="text-align: center; width:15%; font-family: Courier; font-size:7pt;"><strong>P.TOTAL</strong></td>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
</tr>
<?php
if ($cod_estado_ordenamiento_alfabetico_venta_global == '1') { $ordenamiento = 'ORDER BY nombre_producto ASC'; } else { $ordenamiento = ''; }

$resultado_sql = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_venta, precio_venta_producto, total_venta_producto, iva_ptj, precio_ipc 
FROM tbl15_mantenimiento_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') $ordenamiento";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

$cod_producto                = $info_venta['cod_producto'];
$cod_producto_barra          = $info_venta['cod_producto_barra'];
$nombre_producto             = $info_venta['nombre_producto'];
$und_venta                   = $info_venta['und_venta'];
$precio_venta_producto       = $info_venta['precio_venta_producto'];
$total_venta_producto        = $info_venta['total_venta_producto'];
$iva_ptj                     = $info_venta['iva_ptj'];
$precio_ipc                  = $info_venta['precio_ipc'];

$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }
?>
<tr>
<td style="text-align: center; width:10%; font-family: Courier; font-size:7pt;"><strong><?php echo $und_venta ?></strong></td>
<td style="text-align: left; width:50%; font-family: Courier; font-size:7pt;"><strong><?php echo $nombre_producto ?></strong></td>
<td style="text-align: right; width:14%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:14%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:10%; font-family: Courier; font-size:5pt;"><strong><?php echo $nombre_tipo_iva ?></strong></td>
</tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><===========================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong>SUBTOTAL</strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong>%DESC</strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong>$DESC</strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong>IVA</strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:10pt;"><strong>TOTAL</strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:7pt;"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($subtotal_base, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($descuento_ptj, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_desc, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_iva, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 9%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($total_venta_temp, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 5%; font-family: Courier; font-size:7pt;"><strong></strong></td>
  </tr>
</table>

<?php if ($cod_tipo_pago == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><===========================================></td>
</tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:7pt;"><strong>RECIBIDO</strong></td>
    <td style="text-align: right; width: 40%; font-family: Courier; font-size:10pt;"><strong>CAMBIO</strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
    <td style="text-align: left; width: 40%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($vlr_cancelado, 0, ",", ".") ?></strong></td>
    <td style="text-align: right; width: 40%; font-family: Courier; font-size:10pt;"><strong><?php echo number_format($vlr_cambio, 0, ",", ".") ?></strong></td>
    <td style="text-align: center; width: 10%; font-family: Courier; font-size:7pt;"><strong></strong></td>
  </tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><===========================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center; width:20%; font-family: Courier; font-size:7pt;"><strong>RESUMEN DE IMPUESTOS</strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong>TIPO</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong>COMPRA</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong>BASE/IMP</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong>IVA</strong></td>
</td>
<?php
$sql_total_tipos_iva_19 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_mantenimiento_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '19')";
$consulta_total_tipos_iva_19 = mysqli_query($conectar, $sql_total_tipos_iva_19) or die(mysqli_error($conectar));
$datos_total_tipos_iva_19 = mysqli_fetch_assoc($consulta_total_tipos_iva_19);

$total_venta_19                         = $datos_total_tipos_iva_19['total_venta'];
$total_base_iva_19                      = $datos_total_tipos_iva_19['total_base_iva'];
$total_iva_19                           = $datos_total_tipos_iva_19['total_iva'];
//$total_iva_19                           = $total_compra_19 - $total_base_iva_19;

$sql_total_tipos_iva_5 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_mantenimiento_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '5')";
$consulta_total_tipos_iva_5 = mysqli_query($conectar, $sql_total_tipos_iva_5) or die(mysqli_error($conectar));
$datos_total_tipos_iva_5 = mysqli_fetch_assoc($consulta_total_tipos_iva_5);

$total_venta_5                         = $datos_total_tipos_iva_5['total_venta'];
$total_base_iva_5                      = $datos_total_tipos_iva_5['total_base_iva'];
$total_iva_5                           = $datos_total_tipos_iva_5['total_iva'];
//$total_iva_5                           = $total_compra_5 - $total_base_iva_5;

$sql_total_tipos_iva_0 = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_mantenimiento_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (iva_ptj = '0')";
$consulta_total_tipos_iva_0 = mysqli_query($conectar, $sql_total_tipos_iva_0) or die(mysqli_error($conectar));
$datos_total_tipos_iva_0 = mysqli_fetch_assoc($consulta_total_tipos_iva_0);

$total_venta_0                         = $datos_total_tipos_iva_0['total_venta'];
$total_base_iva_0                      = $datos_total_tipos_iva_0['total_base_iva'];
$total_iva_0                           = $datos_total_tipos_iva_0['total_iva'];
//$total_iva_0                           = $total_compra_5 - $total_base_iva_5;

$sql_total_tipos_iva_ipc = "SELECT SUM(precio_ipc) AS total_precio_ipc
FROM tbl15_mantenimiento_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (precio_ipc <> '0')";
$consulta_total_tipos_iva_ipc = mysqli_query($conectar, $sql_total_tipos_iva_ipc) or die(mysqli_error($conectar));
$datos_total_tipos_iva_ipc = mysqli_fetch_assoc($consulta_total_tipos_iva_ipc);

$total_precio_ipc                      = $datos_total_tipos_iva_ipc['total_precio_ipc'];
$total_valor_base                      = $total_base_iva_19 + $total_base_iva_5 + $total_base_iva_0;
$total_valor_iva                       = $total_iva_19 + $total_iva_5 + $total_iva_0;
$total_valor_total                     = $total_venta_19 + $total_venta_5 + $total_venta_0;
//$total_iva_0                           = $total_compra_5 - $total_base_iva_5;
/*
$resultado_sql = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

$nombre_tipo_iva             = $info_venta['nombre_tipo_iva'];
$descripcion_tipo_iva        = $info_venta['descripcion_tipo_iva'];
$iva                         = $info_venta['iva'];

$sql_total_tipos_iva = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_mantenimiento_producto WHERE (iva_ptj = '$iva_ptj')";
$consulta_total_tipos_iva = mysqli_query($conectar, $sql_total_tipos_iva) or die(mysqli_error($conectar));
$datos_total_tipos_iva = mysqli_fetch_assoc($consulta_total_tipos_iva);

$total_venta                         = $datos_total_tipos_iva['total_venta'];
$total_base_iva                      = $datos_total_tipos_iva['total_base_iva'];
$total_iva                           = $datos_total_tipos_iva['total_iva'];
*/
?>
<tr>
<td style="text-align: left; width:10%; font-family: Courier; font-size:7pt;"><strong>G=19%</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_venta_19, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_base_iva_19, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_iva_19, 0, ",", ".") ?></strong></td>
</tr>
<tr>
<td style="text-align: left; width:10%; font-family: Courier; font-size:7pt;"><strong>S=5%</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_venta_5, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_base_iva_5, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_iva_5, 0, ",", ".") ?></strong></td>
</tr>
<tr>
<td style="text-align: left; width:10%; font-family: Courier; font-size:7pt;"><strong>A=0%</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_venta_0, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_base_iva_0, 0, ",", ".") ?></strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_iva_0, 0, ",", ".") ?></strong></td>
</tr>
<?php //} ?>
</table>

<?php 
$sql_total_imp_bolsa = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
FROM tbl15_mantenimiento_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '0000')";
$consulta_total_imp_bolsa = mysqli_query($conectar, $sql_total_imp_bolsa) or die(mysqli_error($conectar));
$total_imp_bolsa = mysqli_num_rows($consulta_total_imp_bolsa);
$datos_total_imp_bolsa = mysqli_fetch_assoc($consulta_total_imp_bolsa);

$total_venta_imp_bolsa                 = $datos_total_imp_bolsa['total_venta'];
$total_base_iva_imp_bolsa              = $datos_total_imp_bolsa['total_base_iva'];
$total_iva_imp_bolsa                   = $datos_total_imp_bolsa['total_iva'];

if (intval($total_venta_imp_bolsa) == '0') { } else { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong>IMP A LA BOLSA</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_venta_imp_bolsa, 0, ",", ".") ?></strong></td>
</tr>
</table>
<?php } ?>


<?php 
$sql_total_impoconsumo = "SELECT Sum(precio_ipc * und_venta) AS total_impoconsumo FROM tbl15_mantenimiento_producto 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (precio_ipc <> '0')";
$consulta_total_impoconsumo = mysqli_query($conectar, $sql_total_impoconsumo) or die(mysqli_error($conectar));
$total_impoconsumo = mysqli_num_rows($consulta_total_impoconsumo);
$datos_total_impoconsumo = mysqli_fetch_assoc($consulta_total_impoconsumo);

$total_impoconsumo                     = $datos_total_impoconsumo['total_impoconsumo'];

if (intval($total_impoconsumo) == '0') { } else { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong>I = IMPO CONSUMO</strong></td>
<td style="text-align: left; width:20%; font-family: Courier; font-size:7pt;"><strong><?php echo number_format($total_impoconsumo, 0, ",", ".") ?></strong></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
<tr>
<td style="text-align: center;"><===========================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;"><strong>FACTURA <?php echo $nombre_tipo_resolucion_facturacion ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;"><strong>RESOLUCION DIAN: <?php echo $numero_resolucion_facturacion ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;"><strong>DESDE <?php echo $prefijo_resolucion_facturacion ?> <?php echo ($ini_resolucion_facturacion) ?> AL <?php echo $prefijo_resolucion_facturacion ?> <?php echo $fin_resolucion_facturacion ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;"><strong>REGIMEN <?php echo $regimen_emp ?></strong></td>
  </tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;">****************************************</td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;"><strong>Muchas gracias por su preferencia</strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 95%; font-family: Courier; font-size:7pt;">****************************************</td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:7pt;"><strong><== Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?> ==></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:7pt;"><strong><== <?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?> ==></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:7pt;"><div id="codigo_codabar_php"></div></td>
  </tr>
</table>

<?php if ($cod_estado_encuesta_experiencia_compra_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:7pt;"><strong>Califica tu experiencia de compra en</strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:7pt;"><strong><?php echo $url_encuesta_experiencia_compra ?></strong></td>
  </tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:7pt;">.</td>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:7pt;"><div id="qrcode"></div></td>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:7pt;">.</td>
  </tr>
</table>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:7pt;">.</td>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:7pt;"><strong>ESCANEAME</strong></td>
    <td style="text-align: center; width: 32%; font-family: Courier; font-size:7pt;">.</td>
  </tr>
</table>
<?php } ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:7pt;">
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:7pt;"><strong><== <?php echo $fecha.$hora.'-'.$cod_factura.'-'.$cod_info_factura_venta ?>_imp_nrm ==></strong></td>
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

<script>  
 $(document).ready(function(){  
  $('#btnImprimir').click(function(){
  var cod_info_factura_venta = <?php echo $cod_info_factura_venta ?>;  
    $.ajax({ url:"imprimir_factura_venta_ticket_pos.php", method:"GET", data:{cod_info_factura_venta:cod_info_factura_venta, campo:"cod_info_factura_venta", id:cod_info_factura_venta }, 
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

<script type="text/javascript">
/*
var qrcode = new QRCode(document.getElementById("qrcode"), {
  width : 60,
  height : 60
});
function makeCode () {    
  var text = "https://editaxe.xyz";
  qrcode.makeCode(text);
}
makeCode();
*/
</script>

</body>
</html>