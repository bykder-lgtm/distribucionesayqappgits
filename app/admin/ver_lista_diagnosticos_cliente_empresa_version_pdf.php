<?php ob_start();?>
<?php
date_default_timezone_set("America/Bogota");
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');

$serguridad_pagina                 = 1; 
$fecha_ini                         = addslashes($_GET['fecha_ini']);
$fecha_fin                         = addslashes($_GET['fecha_fin']);
$nombre_empresa                    = addslashes($_GET['nombre_empresa']);
$fecha_ymdhis                      = date("Y/m/d H:i:s");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                        = $info_empresa_data['titulo'];
$nombre_emp                        = $info_empresa_data['nombre'];
$eslogan_emp                       = $info_empresa_data['eslogan'];
$direccion_emp                     = $info_empresa_data['direccion'];
$ciudad_emp                        = $info_empresa_data['ciudad'];
$pais_emp                          = $info_empresa_data['pais'];
$correo_emp                        = $info_empresa_data['correo'];
$img_cabecera_emp                  = $info_empresa_data['img_cabecera'];
$telefono_emp                      = $info_empresa_data['telefono'];
$info_legal_emp                    = $info_empresa_data['info_legal'];
$logotipo_emp                      = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp               = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                   = $info_empresa_data['nit_empresa'];
$cabecera_emp                      = $info_empresa_data['cabecera'];
$icono_emp                         = $info_empresa_data['icono'];
$desarrollador_emp                 = $info_empresa_data['desarrollador'];
$anyo_emp                          = $info_empresa_data['anyo'];
$url_pag                           = $info_empresa_data['url_pag'];
$nombre_font_emp                   = $info_empresa_data['nombre_font'];
$tamano_font_emp                   = $info_empresa_data['tamano_font'];
$tamano_font_factura_emp           = $info_empresa_data['tamano_font_aptlab'];
$tamano_font_factura_emp           = $info_empresa_data['tamano_font_factura'];
$res_emp                           = $info_empresa_data['res'];
$res1_emp                          = $info_empresa_data['res1'];
$res2_emp                          = $info_empresa_data['res2'];
$departamento_emp                  = $info_empresa_data['departamento'];
$localidad_emp                     = $info_empresa_data['localidad'];
$reg_medico_emp                    = $info_empresa_data['reg_medico'];
$regimen_emp                       = $info_empresa_data['regimen'];
$version_emp                       = $info_empresa_data['version'];
$propietario_url_firma_emp         = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                    = $info_empresa_data['fecha_time'];
$licencia_emp                      = $info_empresa_data['licencia'];
$info_histclinic_emp               = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp               = $info_empresa_data['info_aptlaboral'];

$nombres_completos = "LISTA_DIAGNOSTICOS";

include_once('mpdf/mpdf.php');
$margen_izq = '10';
$margen_der = '10';
$margen_inf_encabezado = '40';
$margen_sup_encabezado = '10';
$posicion_sup_encabezado = '5';
$posicion_inf_encabezado = '2';

$titulo_doc_pdf            = 'LISTA_DIAGNOSTICOS'.'_'.$nombre_empresa.'_'.'FECHA_INI'.'_'.$fecha_ini.'_'.'FECHA_FIN'.'_'.$fecha_fin;
$autor_doc_pdf             = 'LISTA_DIAGNOSTICOS'.'_'.$nombre_empresa.'_'.'FECHA_INI'.'_'.$fecha_ini.'_'.'FECHA_FIN'.'_'.$fecha_fin;
$creador_doc_pdf           = 'LISTA_DIAGNOSTICOS'.'_'.$nombre_empresa.'_'.'FECHA_INI'.'_'.$fecha_ini.'_'.'FECHA_FIN'.'_'.$fecha_fin;
$tema_doc_pdf              = 'LISTA_DIAGNOSTICOS'.'_'.$nombre_empresa.'_'.'FECHA_INI'.'_'.$fecha_ini.'_'.'FECHA_FIN'.'_'.$fecha_fin;
$palabras_claves_doc_pdf   = 'LISTA_DIAGNOSTICOS'.'_'.$nombre_empresa.'_'.'FECHA_INI'.'_'.$fecha_ini.'_'.'FECHA_FIN'.'_'.$fecha_fin;
$aaaaaa   = "LISTA";

//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

$header = '
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:20pt; width:100%">
  <tr><td style="text-align:center"><strong>'.$nombre_emp.'</strong></td></tr>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td rowspan="5" valign="top"><img src="../imagenes/logo_limp.png" height="90px"/></td>
    <td style="text-align:center">CC '.$propietario_nit_emp.'</td>
  </tr>
  <tr><td style="text-align:center">'.$cabecera_emp.'</td></tr>
  <tr><td style="text-align:center" valign="top">'.$eslogan_emp.'</td></tr>
  <tr><td style="text-align:center" valign="top">RM. '.$reg_medico_emp.' - RM. '.$licencia_emp.' - Tel. '.$telefono_emp.'</td></tr>
  <tr><td style="text-align:center" valign="top">'.$departamento_emp.', '.$pais_emp.'</td></tr>
</table>
';
$headerE = '
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:20pt; width:100%">
  <tr><td style="text-align:center"><strong>'.$nombre_emp.'</strong></td></tr>
</table>

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td rowspan="5" valign="top"><img src="../imagenes/logo_limp.png" height="90px"/></td>
    <td style="text-align:center">CC '.$propietario_nit_emp.'</td>
  </tr>
  <tr><td style="text-align:center">'.$cabecera_emp.'</td></tr>
  <tr><td style="text-align:center" valign="top">'.$eslogan_emp.'</td></tr>
  <tr><td style="text-align:center" valign="top">RM. '.$reg_medico_emp.' - RM. '.$licencia_emp.' - Tel. '.$telefono_emp.'</td></tr>
  <tr><td style="text-align:center" valign="top">'.$departamento_emp.', '.$pais_emp.'</td></tr>
</table>
';
$footer = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
</table>
';
$footerE = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
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
<br>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
<tr>
  <td style="text-align:center"><strong>EMPRESA</strong></td>
  <td style="text-align:center"><strong>FECHA INICAL</strong></td>
  <td style="text-align:center"><strong>FECHA FINAL</strong></td>
</tr>
<tr>
  <td style="text-align:center"><strong>'.$nombre_empresa.'</strong></td>
  <td style="text-align:center"><strong>'.$fecha_ini.'</strong></td>
  <td style="text-align:center"><strong>'.$fecha_fin.'</strong></td>
</tr>
</table>';

$codigoHTML.='
<br>
        <table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <td style="text-align:center"><strong>#</strong></td>
            <td style="text-align:center">Empresa</td>
            <td style="text-align:center"><strong>Cedula</strong></td>
            <td style="text-align:center"><strong>Nombres Y Apellidos</strong></td>
            <td style="text-align:center"><strong>Motivo</strong></td>
            <td style="text-align:center"><strong>Edad (Años)</strong></td>
            <td style="text-align:center"><strong>IMC</strong></td>
            <td style="text-align:center"><strong>Diágnostico</strong></td>
            <td style="text-align:center"><strong>Fecha</strong></td>
           </tr>';
$numero                         = 0;
$fecha_hoy_time                 = strtotime(date("Y/m/d"));
$integral                       = "";

$sql_cliente = "SELECT tbl15_historia_clinica.nombre_empresa, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.motivo, tbl15_historia_clinica.fecha_ymd, 
tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.exa_fis_imc, tbl15_historia_clinica.exa_fis_interpreimc, tbl15_cliente.fecha_nac_ymd
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente
WHERE (tbl15_historia_clinica.cod_estado_facturacion=1) AND (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$nombre_empresa                = $info_cliente['nombre_empresa'];
$cedula                        = $info_cliente['cedula'];
$cedula                        = $info_cliente['cedula'];
$nombres                       = $info_cliente['nombres'];
$apellido1                     = $info_cliente['apellido1'];
$motivo                        = $info_cliente['motivo'];
$fecha_ymd                     = $info_cliente['fecha_ymd'];
$exa_fis_imc                   = $info_cliente['exa_fis_imc'];
$exa_fis_interpreimc           = $info_cliente['exa_fis_interpreimc'];
$fecha_nac_ymd                 = $info_cliente['fecha_nac_ymd'];
$cod_historia_clinica          = $info_cliente['cod_historia_clinica'];

$fecha_nac_time                = strtotime($fecha_nac_ymd);
$diferencia_edad               = abs($fecha_hoy_time - $fecha_nac_time);
$edad_anyo                     = floor($diferencia_edad / (365*60*60*24));
$integral                       = "";

$sql_cliente1 = "SELECT cie10_cod, cie10_diag FROM tbl15_cie10diag WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_cliente1 = mysqli_query($conectar, $sql_cliente1) or die(mysqli_error($conectar));
while ($info_cliente1 = mysqli_fetch_assoc($resultado_cliente1)) {

$cie10_cod                     = $info_cliente1['cie10_cod'];
$cie10_diag                    = $info_cliente1['cie10_diag'];

$integral                     .= '|'.$cie10_cod.' - '.$cie10_diag.'|';
}
$numero++;

$codigoHTML.='
          <tr>
            <td style="text-align:center">'.$numero.'</td>
            <td style="text-align:left">'.$nombre_empresa.'</td>
            <td style="text-align:left">'.$cedula.'</td>
            <td style="text-align:left">'.$nombres.' '.$apellido1.'</td>
            <td style="text-align:left">'.$motivo.'</td>
            <td style="text-align:center">'.$edad_anyo.'</td>
            <td style="text-align:left">'.$exa_fis_imc.' ('.$exa_fis_interpreimc.')</td>
            <td style="text-align:left">'.$integral.'</td>
            <td style="text-align:center">'.$fecha_ymd.'</td>
          </tr>';
}
$codigoHTML.='
        </table>';

$codigoHTML.='
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
$nombre_archivo = 'LISTA_DIAGNOSTICOS'.'_'.$nombre_empresa.'_'.'FECHA_INI'.'_'.$fecha_ini.'_'.'FECHA_FIN'.'_'.$fecha_fin.'.pdf';
$mpdf->Output($nombre_archivo, 'I');
exit;
/*
$mpdf->WriteHTML('<tocpagebreak sheet-size="A4-L" toc-sheet-size="A5" toc-preHTML="This ToC should print on an A5 sheet" />');
$mpdf->WriteHTML('<tocentry content="A4 landscape" /><p>This page appears just after the ToC and should print on an A4 (landscape) sheet</p>');
$mpdf->WriteHTML('<pagebreak sheet-size="A5-L" />');
$mpdf->WriteHTML('<tocentry content="A5 landscape" /><p>This should print on an A5 (landscape) sheet</p>');
$mpdf->WriteHTML('<pagebreak sheet-size="Letter" />');
$mpdf->WriteHTML('<tocentry content="Letter portrait" /><p>This should print on an Letter sheet</p>');
$mpdf->WriteHTML('<pagebreak sheet-size="150mm 150mm" />');
$mpdf->WriteHTML('<tocentry content="150mm square" /><p>This should print on a sheet 150mm x 150mm</p>');
$mpdf->WriteHTML('<pagebreak sheet-size="11.69in 8.27in" />');
*/
?>
<?php ob_end_flush(); ?>