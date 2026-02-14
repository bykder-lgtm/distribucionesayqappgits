<?php ob_start();?>
<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");

$serguridad_pagina                                    = 1; 
$fecha_ymd_venta_producto_ini                         = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin                         = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$cod_tercero                                          = intval($_GET['cod_tercero']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                                        = $info_empresa_data['titulo'];
$nombre_emp                                                        = $info_empresa_data['nombre'];
$eslogan_emp                                                       = $info_empresa_data['eslogan'];
$direccion_emp                                                     = $info_empresa_data['direccion'];
$ciudad_emp                                                        = $info_empresa_data['ciudad'];
$pais_emp                                                          = $info_empresa_data['pais'];
$correo_emp                                                        = $info_empresa_data['correo'];
$img_cabecera_emp                                                  = $info_empresa_data['img_cabecera'];
$telefono_emp                                                      = $info_empresa_data['telefono'];
$info_legal_emp                                                    = $info_empresa_data['info_legal'];
$logotipo_emp                                                      = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp                                 = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                                               = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                                                   = $info_empresa_data['nit_empresa'];
$cabecera_emp                                                      = $info_empresa_data['cabecera'];
$icono_emp                                                         = $info_empresa_data['icono'];
$desarrollador_emp                                                 = $info_empresa_data['desarrollador'];
$pag_desarrollador_emp                                             = $info_empresa_data['pag_desarrollador'];
$anyo_emp                                                          = $info_empresa_data['anyo'];
$url_pag                                                           = $info_empresa_data['url_pag'];
$nombre_font                                                       = $info_empresa_data['nombre_font'];
$res_emp                                                           = $info_empresa_data['res'];
$res1_emp                                                          = $info_empresa_data['res1'];
$res2_emp                                                          = $info_empresa_data['res2'];
$departamento_emp                                                  = $info_empresa_data['departamento'];
$localidad_emp                                                     = $info_empresa_data['localidad'];
$reg_medico_emp                                                    = $info_empresa_data['reg_medico'];
$regimen_emp                                                       = $info_empresa_data['regimen'];
$version_emp                                                       = $info_empresa_data['version'];
$propietario_url_firma_emp                                         = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                                                    = $info_empresa_data['fecha_time'];
$licencia_emp                                                      = $info_empresa_data['licencia'];
$tamano_font_emp                                                   = $info_empresa_data['tamano_font'];
$info_histclinic_emp                                               = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                                               = $info_empresa_data['info_aptlaboral'];
$cod_estado_converir_und_a_caja_mostrar_imprimir_global            = $info_empresa_data['cod_estado_converir_und_a_caja_mostrar_imprimir_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_profesional = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$nombre1_tercero                                      = $info_profesional['nombre1_tercero'];
$nombre2_tercero                                      = $info_profesional['nombre2_tercero'];
$apellido1_tercero                                    = $info_profesional['apellido1_tercero'];
$apellido2_tercero                                    = $info_profesional['apellido2_tercero'];
$identificacion_tercero                               = $info_profesional['identificacion_tercero'];
$nombre_tipo_identificacion                           = $info_profesional['nombre_tipo_identificacion'];
$direccion_tercero                                    = $info_profesional['direccion_tercero'];
$telefono1_tercero                                    = $info_profesional['telefono1_tercero'];
$digito_tercero                                       = $info_profesional['digito_tercero'];
$correo_tercero                                       = $info_profesional['correo_tercero'];
$nombre_departamento                                  = $info_profesional['nombre_departamento'];
$nombre_ciudad                                        = $info_profesional['nombre_ciudad'];
$nombre_cliente                                       = $nombre1_tercero.' '.$nombre2_terceroo.' '.$apellido1_tercero.' '.$apellido2_tercero;
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$info_profesional['digito_tercero']; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
include_once('mpdf/mpdf.php');
$margen_izq                                           = '10';
$margen_der                                           = '10';
$margen_inf_encabezado                                = '5';
$margen_sup_encabezado                                = '10';
$posicion_sup_encabezado                              = '5';
$posicion_inf_encabezado                              = '2';

$titulo_doc_pdf                                       = 'CERTIFICADO_DE_RETENCION_'.$nombre_cliente.'_'.$fecha_ymd_venta_producto_ini.'_'.$fecha_ymd_venta_producto_fin;
$autor_doc_pdf                                        = 'CERTIFICADO_DE_RETENCION_'.$nombre_cliente.'_'.$fecha_ymd_venta_producto_ini.'_'.$fecha_ymd_venta_producto_fin;
$creador_doc_pdf                                      = 'CERTIFICADO_DE_RETENCION_'.$nombre_cliente.'_'.$fecha_ymd_venta_producto_ini.'_'.$fecha_ymd_venta_producto_fin;
$tema_doc_pdf                                         = 'CERTIFICADO_DE_RETENCION_'.$nombre_cliente.'_'.$fecha_ymd_venta_producto_ini.'_'.$fecha_ymd_venta_producto_fin;
$palabras_claves_doc_pdf                              = 'CERTIFICADO_DE_RETENCION_'.$nombre_cliente.'_'.$fecha_ymd_venta_producto_ini.'_'.$fecha_ymd_venta_producto_fin;
$nombres_completos                                    = "CERTIFICADO_DE_RETENCION";
//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','letter','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_retencion_compra = "SELECT SUM(subtotal) AS subtotal_base_retencion, SUM(total_rete_fuente) AS total_rete_fuente_valor_retenido FROM tbl15_info_factura_compra 
WHERE (fecha_dia BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (total_rete_fuente <> '0') $filtro_consulta_tercero";
$consulta_retencion_compra = mysqli_query($conectar, $sql_retencion_compra) or die(mysqli_error($conectar));
$datos_retencion_compra = mysqli_fetch_assoc($consulta_retencion_compra);

$subtotal_base_retencion                     = $datos_retencion_compra['subtotal_base_retencion'];
$total_rete_fuente_valor_retenido            = $datos_retencion_compra['total_rete_fuente_valor_retenido'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_profesional = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$nombre1_tercero                                      = $info_profesional['nombre1_tercero'];
$nombre2_tercero                                      = $info_profesional['nombre2_tercero'];
$apellido1_tercero                                    = $info_profesional['apellido1_tercero'];
$apellido2_tercero                                    = $info_profesional['apellido2_tercero'];
$identificacion_tercero                               = $info_profesional['identificacion_tercero'];
$nombre_tipo_identificacion                           = $info_profesional['nombre_tipo_identificacion'];
$direccion_tercero                                    = $info_profesional['direccion_tercero'];
$telefono1_tercero                                    = $info_profesional['telefono1_tercero'];
$digito_tercero                                       = $info_profesional['digito_tercero'];
$correo_tercero                                       = $info_profesional['correo_tercero'];
$nombre_departamento                                  = $info_profesional['nombre_departamento'];
$nombre_ciudad                                        = $info_profesional['nombre_ciudad'];
$nombre_cliente                                       = $nombre1_tercero.' '.$nombre2_terceroo.' '.$apellido1_tercero.' '.$apellido2_tercero;
//---------------------------------------------------------------------------------------------------------------------------------//
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$info_profesional['digito_tercero']; }
//---------------------------------------------------------------------------------------------------------------------------------//
$nombre_certificado_retefuente                        = "RETENCIÓN APLICADA A COMPRAS DECLARANTES";
$fecha_ini_certificado_retefuente                     = $fecha_ymd_venta_producto_ini;
$fecha_fin_certificado_retefuente                     = $fecha_ymd_venta_producto_fin;
$fecha_generacion_documento_certificado_retefuente 	  = date("Y-m-d");
$hora_generacion_documento_certificado_retefuente     = date("H:i:s");
$nombre_rete_fuente_ptj 	                          = "2.5";
$subtotal_base_retencion 	                          = $subtotal_base_retencion;
$total_retefuente_valor_retenido 	                  = $total_rete_fuente_valor_retenido;
$fecha_creacion 		                              = date("Y-m-d H:i:s");
$cod_estado                                           = 0;

$sql_data = "INSERT INTO tbl15_certificado_retefuente (cod_tercero, nombre_certificado_retefuente, fecha_ini_certificado_retefuente, fecha_fin_certificado_retefuente, 
fecha_generacion_documento_certificado_retefuente, hora_generacion_documento_certificado_retefuente, nombre_rete_fuente_ptj, subtotal_base_retencion, 
total_retefuente_valor_retenido, fecha_creacion, cod_estado) 
VALUES ('$cod_tercero', '$nombre_certificado_retefuente', '$fecha_ini_certificado_retefuente', '$fecha_fin_certificado_retefuente', 
'$fecha_generacion_documento_certificado_retefuente', '$hora_generacion_documento_certificado_retefuente', '$nombre_rete_fuente_ptj', '$subtotal_base_retencion', 
'$total_retefuente_valor_retenido', '$fecha_creacion', '$cod_estado')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_imp                                            = date("Y-m-d");
$hora_imp                                             = date("H.i:s");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$headerE = '
';
$headerE = '
';
$footer = '
<table width="100%" style="font-family:serif; font-size: 10pt; color: #606060;">
<tr>
	<td width="100%" style="text-align: center;"><h6>Software '.$titulo_emp.' - Implementado por Proveedor Tecnológico '.$desarrollador_emp.'</h6></td>
</tr>
<tr>
	<td width="100%" style="text-align: right;"><h6>[Página {PAGENO} de {nbpg}]</h6></td>
</tr>
</table>
';
$footerE = '
<table width="100%" style="font-family:serif; font-size: 10pt; color: #606060;">
<tr>
	<td width="100%" style="text-align: center;"><h6>Software '.$titulo_emp.' - Implementado por Proveedor Tecnológico '.$desarrollador_emp.'</h6></td>
</tr>
<tr>
	<td width="100%" style="text-align: right;"><h6>[Página {PAGENO} de {nbpg}]</h6></td>
</tr>
</table>
';
$mpdf->SetHTMLHeader(($header));
$mpdf->SetHTMLHeader(($headerE),'E');
$mpdf->SetHTMLFooter(($footer));
$mpdf->SetHTMLFooter(($footerE),'E');


$codigoHTML = '
<!DOCTYPE html>
<html lang="es">
<head>
<title></title>
<meta charset="utf-8" />
</head>

<body>
<style type="text/css"> 
#centrar { margin-right:auto; margin-left:auto; width: 30%; } 
.Estilo1 { color: #FF0000; font-weight: bold; }
.Estilo2 {color: #FF0000}
</style>';

$codigoHTML.='
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
	<tr>
    	<td style="text-align:center; font-size:17px; font-weight: bold;">'.$cabecera_emp.'</td>
	</tr>
	<tr>
		<td align="center"><p style="font-size:12px">'.$cabecera_emp.' - NIT '.$propietario_nit_emp.'</p></td>
	</tr>
	<tr>
		<td align="center"><p style="font-size:12px">'.$telefono_emp.' / '.$correo_emp.'</p></td>
	</tr>
	<tr>
		<td align="center"><p style="font-size:12px">DIRECCION: '.$direccion_emp.' / '.$localidad_emp.'</p></td>
	</tr>
</table>
';

$codigoHTML.='
<hr>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
	<tr>
    	<th style="text-align:center; font-size:15pt;">CERTIFICADO DE RETENCIÓN A TÍTULO DE RENTA</th>
	</tr>
</table>
';

$codigoHTML.='
<hr>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
	<tr>
    	<th style="text-align:left; font-size:11pt;">PERIODO GRAVABLE</th>
    	<td style="text-align:left; font-size:11pt;">'.$fecha_ymd_venta_producto_ini.' A '.$fecha_ymd_venta_producto_fin.'</td>
	</tr>
	<tr>
    	<th style="text-align:left; font-size:11pt;">RETENIDO A</th>
    	<td style="text-align:left; font-size:11pt;">'.$nombre_cliente.'</td>
	</tr>
	<tr>
    	<th style="text-align:left; font-size:11pt;">NIT</th>
    	<td style="text-align:left; font-size:11pt;">'.$identificacion_tercero.'</td>
	</tr>
	<tr>
    	<th style="text-align:left; font-size:11pt;">CONSIGNADO EN</th>
    	<td style="text-align:left; font-size:11pt;">'.$localidad_emp.'</td>
	</tr>
	<tr>
    	<th style="text-align:left; font-size:11pt;">FECHA Y HORA DE GENERACIÓN</th>
    	<td style="text-align:left; font-size:11pt;">'.$fecha_imp.' '.$hora_imp.'</td>
	</tr>
</table>
';

$codigoHTML.='
<hr>
<table align="center" border="0" cellpadding="4" cellspacing="4" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <th style="text-align:left; font-size:10pt;" valign="top">CONCEPTO</th>
    <th style="text-align:left; font-size:10pt;" valign="top">TASA%</th>
    <th style="text-align:left; font-size:10pt;" valign="top">BASE RETENCION</th>
    <th style="text-align:left; font-size:10pt;" valign="top">VALOR RETENIDO</th>
  </tr>
  <tr>
    <td style="text-align:left; font-size:10pt;" valign="top">1. RETENCIÓN APLICADA A COMPRAS DECLARANTES</td>
    <td style="text-align:center; font-size:10pt;" valign="top">2.50</td>
    <td style="text-align:center; font-size:10pt;" valign="top">'.number_format($subtotal_base_retencion, 0, ",", ".").'</td>
    <td style="text-align:center; font-size:10pt;" valign="top">'.number_format($total_rete_fuente_valor_retenido, 0, ",", ".").'</td>
  </tr>
</table>
<hr>

<table width="100%" style="font-family:serif; font-size: 10pt; color: #606060;">
<tr>
	<td width="100%" style="text-align: left;">
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	Este documento no requiere para su validez firma autógrafa de acuerdo con el artículo 10 del Decreto 836 de 1991
	</td>
</tr>
</table>
</body>
</html>
';
$mpdf->WriteHTML(($codigoHTML));
$mpdf->SetTitle($titulo_doc_pdf);
$mpdf->SetAuthor($autor_doc_pdf);
$mpdf->SetCreator($autor_doc_pdf);
$mpdf->SetSubject($tema_doc_pdf);
$mpdf->SetKeywords($palabras_claves_doc_pdf);
$ruta = '../pdfs/';
$nombre_archivo = 'CERTIFICADO_DE_RETENCION_'.$nombre_cliente.'_'.$fecha_ymd_venta_producto_ini.'_'.$fecha_ymd_venta_producto_fin.'.pdf';
$mpdf->Output($nombre_archivo, 'I');
exit;
?>
<?php ob_end_flush(); ?>