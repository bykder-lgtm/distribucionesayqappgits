<?php ob_start();?>
<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");

$serguridad_pagina                                    = 1; 
$cod_certificado_retefuente                           = intval($_GET['cod_certificado_retefuente']);
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
$mostrar_datos_sql = "SELECT * FROM tbl15_certificado_retefuente WHERE cod_certificado_retefuente = '$cod_certificado_retefuente'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_tercero                                         = $matriz_consulta['cod_tercero'];
$nombre_certificado_retefuente                       = $matriz_consulta['nombre_certificado_retefuente'];
$fecha_ini_certificado_retefuente                    = $matriz_consulta['fecha_ini_certificado_retefuente'];
$fecha_fin_certificado_retefuente                    = $matriz_consulta['fecha_fin_certificado_retefuente'];
$fecha_generacion_documento_certificado_retefuente   = $matriz_consulta['fecha_generacion_documento_certificado_retefuente'];
$hora_generacion_documento_certificado_retefuente    = $matriz_consulta['hora_generacion_documento_certificado_retefuente'];
$nombre_rete_fuente_ptj                              = $matriz_consulta['nombre_rete_fuente_ptj'];
$subtotal_base_retencion                             = $matriz_consulta['subtotal_base_retencion'];
$total_retefuente_valor_retenido                     = $matriz_consulta['total_retefuente_valor_retenido'];
$fecha_creacion                                      = $matriz_consulta['fecha_creacion'];
$fecha_modificacion                                  = $matriz_consulta['fecha_modificacion'];
$cod_administrador                                   = $matriz_consulta['cod_administrador'];
$cod_estado                                          = $matriz_consulta['cod_estado'];
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
$nombre_cliente                                       = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;
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

$titulo_doc_pdf                                       = 'CERTIFICADO_DE_RETENCION_'.$nombre_cliente.'_'.$fecha_ini_certificado_retefuente.'_'.$fecha_fin_certificado_retefuente;
$autor_doc_pdf                                        = 'CERTIFICADO_DE_RETENCION_'.$nombre_cliente.'_'.$fecha_ini_certificado_retefuente.'_'.$fecha_fin_certificado_retefuente;
$creador_doc_pdf                                      = 'CERTIFICADO_DE_RETENCION_'.$nombre_cliente.'_'.$fecha_ini_certificado_retefuente.'_'.$fecha_fin_certificado_retefuente;
$tema_doc_pdf                                         = 'CERTIFICADO_DE_RETENCION_'.$nombre_cliente.'_'.$fecha_ini_certificado_retefuente.'_'.$fecha_fin_certificado_retefuente;
$palabras_claves_doc_pdf                              = 'CERTIFICADO_DE_RETENCION_'.$nombre_cliente.'_'.$fecha_ini_certificado_retefuente.'_'.$fecha_fin_certificado_retefuente;
$nombres_completos                                    = "CERTIFICADO_DE_RETENCION";
//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','letter','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
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
    	<td style="text-align:left; font-size:11pt;">'.$fecha_ini_certificado_retefuente.' A '.$fecha_fin_certificado_retefuente.'</td>
	</tr>
	<tr>
    	<th style="text-align:left; font-size:11pt;">RETENIDO A</th>
    	<td style="text-align:left; font-size:11pt;">'.$nombre_cliente.'</td>
	</tr>
	<tr>
    	<th style="text-align:left; font-size:11pt;">NIT</th>
    	<td style="text-align:left; font-size:11pt;">'.$identificacion_tercero.''.$digito_tercero.'</td>
	</tr>
	<tr>
    	<th style="text-align:left; font-size:11pt;">CONSIGNADO EN</th>
    	<td style="text-align:left; font-size:11pt;">'.$localidad_emp.'</td>
	</tr>
	<tr>
    	<th style="text-align:left; font-size:11pt;">FECHA Y HORA DE GENERACIÓN</th>
    	<td style="text-align:left; font-size:11pt;">'.$fecha_generacion_documento_certificado_retefuente.' '.$hora_generacion_documento_certificado_retefuente.'</td>
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
    <td style="text-align:left; font-size:10pt;" valign="top">'.$nombre_certificado_retefuente.'</td>
    <td style="text-align:center; font-size:10pt;" valign="top">'.$nombre_rete_fuente_ptj.'</td>
    <td style="text-align:center; font-size:10pt;" valign="top">'.number_format($subtotal_base_retencion, 0, ",", ".").'</td>
    <td style="text-align:center; font-size:10pt;" valign="top">'.number_format($total_retefuente_valor_retenido, 0, ",", ".").'</td>
  </tr>
</table>
<hr>

<table width="100%" style="font-family:serif; font-size: 10pt; color: #606060;">
<tr>
	<td width="100%" style="text-align: left;">
	<br><br>
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
$nombre_archivo = 'CERTIFICADO_DE_RETENCION_'.$nombre_cliente.'_'.$fecha_ini_certificado_retefuente.'_'.$fecha_fin_certificado_retefuente.'.pdf';
$mpdf->Output($nombre_archivo, 'I');
exit;
?>
<?php ob_end_flush(); ?>