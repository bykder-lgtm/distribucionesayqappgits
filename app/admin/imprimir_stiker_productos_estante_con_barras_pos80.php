<?php
require_once('mpdf/mpdf.php');
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
//-------------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------//
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);

$cod_info_factura_sticker = intval($_GET['cod_info_factura_sticker']);

$sql_sum_und = "SELECT SUM(und_venta) AS sum_und_venta FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker'";
$consulta_sum_und = mysqli_query($conectar, $sql_sum_und) or die(mysqli_error($conectar));
$datos_sum_und = mysqli_fetch_assoc($consulta_sum_und);

$sum_und_venta = $datos_sum_und['sum_und_venta'];
$smtr = 0;

$codigoHTML='<!DOCTYPE html><html lang="es"><head><title>'."Stiker_Factura_No_".$cod_info_factura_sticker.'</title><meta charset="utf-8" /></head>
<style>body { font-family: arial; font-size: 14pt; } .barcode { padding: 1.5mm; margin: 0; vertical-align: top; color: #000000; } </style>
</head><body>
<table border="0" width="100%"><tr>';

$mostrar_datos_sql = "SELECT und_venta, nombre_producto, cod_producto_barra FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($datos = mysqli_fetch_assoc($consulta)) {

$und_venta                  = $datos['und_venta'];
$nombre_producto            = $datos['nombre_producto'];
$cod_producto_barra         = $datos['cod_producto_barra'];

for ($i=0; $i < $und_venta; $i++) {

$smtr++;

if ($smtr%1 == 0 && $smtr <= $sum_und_venta) {
$codigoHTML.='
<tr>$smtr</tr>
';
}
$codigoHTML.='<td style="text-align: left; font-family: Courier; font-size:8pt;">'.utf8_decode($nombre_producto).'&nbsp;&nbsp;<br>
<barcode code="'.$cod_producto_barra.'" type="EAN128A"  size="1" height="1"/><br>
'.$cod_producto_barra.'</td>';
}
}
$codigoHTML.='</tr></table></div></body></html>';
/*
A4-L = horizontal
A4 = carta
A5 = extralarga
A5-L = horizontal
Letter = oficio
*/
$margen_izq = '4';
$margen_der = '4';
$margen_inf_encabezado = '4';
$margen_sup_encabezado = '4';
$posicion_sup_encabezado = '4';
$posicion_inf_encabezado = '4';
$mpdf = new mPDF('en-GB-x','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 5;
$mpdf->SetDisplayMode('fullpage');
$mpdf->writeHTML(utf8_encode($codigoHTML));
$nombre_archivo = 'Stiker_Barras_No_'.$cod_info_factura_sticker.'.pdf';
$mpdf->output($nombre_archivo, 'I');
exit;
?>