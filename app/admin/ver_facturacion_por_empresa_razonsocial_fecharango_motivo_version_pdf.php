<?php ob_start();?>
<?php 
date_default_timezone_set("America/Bogota");
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');

$serguridad_pagina                 = 1; 
$razonsocial_empresa                    = addslashes($_GET['razonsocial_empresa']);
$fecha_ini                         = addslashes($_GET['fecha_ini']);
$fecha_fin                         = addslashes($_GET['fecha_fin']);
$total_motivo                      = intval($_GET['total_motivo']);
$cuenta                            = addslashes($_GET['cuenta']);
$fecha                             = addslashes($_GET['fecha']);
$fecha_seg                         = strtotime($fecha);
$dia_hoy                           = date("d", $fecha_seg);
$mes_hoy                           = date("m", $fecha_seg);
$anyo_hoy                          = date("Y", $fecha_seg);
$fecha_ymdhis                      = date("Y/m/d H:i:s");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_info_factura_max = "SELECT MAX(cod_factura) AS cod_factura_max FROM tbl15_info_factura_venta";
$resultado_info_factura_max = mysqli_query($conectar, $sql_info_factura_max);
$info_info_factura_max = mysqli_fetch_assoc($resultado_info_factura_max);

$cod_factura_max                   = $info_info_factura_max['cod_factura_max'];
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_info_factura = "SELECT cod_factura, fecha_ini, fecha_fin, razonsocial_empresa, motivo FROM tbl15_info_factura_venta WHERE cod_factura = '$cod_factura_max'";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura);
$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

$fecha_ini_db                      = $info_info_factura['fecha_ini'];
$fecha_fin_db                      = $info_info_factura['fecha_fin'];
$razonsocial_empresa_db            = $info_info_factura['razonsocial_empresa'];
$motivo_db                         = $info_info_factura['motivo'];
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
if (($fecha_ini_db == $fecha_ini) && ($fecha_fin_db == $fecha_fin) && ($razonsocial_empresa_db == $razonsocial_empresa) && ($motivo_db == $motivo)) {
$cod_factura                    = $info_info_factura['cod_factura'];
} else {
$cod_factura                    = $info_info_factura['cod_factura']+1;
}

$sql_profesional = "SELECT cod_empresa, razonsocial_empresa, direccion_empresa, telefono_empresa, nit_empresa FROM tbl15_empresa WHERE razonsocial_empresa = '$razonsocial_empresa'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$cod_empresa                 = $info_profesional['cod_empresa'];
$direccion_empresa           = $info_profesional['direccion_empresa'];
$telefono_empresa            = $info_profesional['telefono_empresa'];
$nit_empresa                 = $info_profesional['nit_empresa'];

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

$nombres_completos = "LISTA_SOCIEDAD";

include_once('mpdf/mpdf.php');
$margen_izq = '10';
$margen_der = '10';
$margen_inf_encabezado = '40';
$margen_sup_encabezado = '10';
$posicion_sup_encabezado = '5';
$posicion_inf_encabezado = '2';

$titulo_doc_pdf            = 'LISTA_SOCIEDAD_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$razonsocial_empresa;
$autor_doc_pdf             = 'LISTA_SOCIEDAD_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$razonsocial_empresa;
$creador_doc_pdf           = 'LISTA_SOCIEDAD_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$razonsocial_empresa;
$tema_doc_pdf              = 'LISTA_SOCIEDAD_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$razonsocial_empresa;
$palabras_claves_doc_pdf   = 'LISTA_SOCIEDAD_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$razonsocial_empresa;

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
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr><td style="text-align:center"><strong>SOCIEDAD: '.$razonsocial_empresa.'</strong></td></tr>
</table>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr><td style="text-align:center"><strong>FECHA INICIAL: '.$fecha_ini.'</strong></td></tr>
  <tr><td style="text-align:center"><strong>FECHA FINAL: '.$fecha_fin.'</strong></td></tr>
</table>
';

$codigoHTML.='
<br>
        <table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <td style="text-align:center"><strong>#</strong></td>
            <td style="text-align:center"><strong>Empresa</strong></td>
            <td style="text-align:center"><strong>Cedula</strong></td>
            <td style="text-align:center"><strong>Nombres Y Apellidos</strong></td>
            <td style="text-align:center"><strong>Concepto</strong></td>
            <td style="text-align:center"><strong>Costo</strong></td>
            <td style="text-align:center"><strong>Fecha</strong></td>
           </tr>';

if ($total_motivo==1) {
$motivo = addslashes($_GET['motivo']); 

$sql_motivo_conteo = "SELECT tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.motivo, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.url_img_firma_min,
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.costo_motivo_consulta 
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo')) AND (cod_estado_facturacion=1)) ORDER BY tbl15_historia_clinica.fecha_ymd DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo);
}
elseif ($total_motivo==2) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 

$sql_motivo_conteo = "SELECT tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.motivo, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.url_img_firma_min,
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.costo_motivo_consulta 
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2')) AND (cod_estado_facturacion=1)) ORDER BY tbl15_historia_clinica.fecha_ymd DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo);
}
elseif ($total_motivo==3) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 

$sql_motivo_conteo = "SELECT tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.motivo, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.url_img_firma_min,
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.costo_motivo_consulta 
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3')) AND (cod_estado_facturacion=1)) ORDER BY tbl15_historia_clinica.fecha_ymd DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo);
}
elseif ($total_motivo==4) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 

$sql_motivo_conteo = "SELECT tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.motivo, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.url_img_firma_min,
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.costo_motivo_consulta 
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4')) 
AND (cod_estado_facturacion=1)) ORDER BY tbl15_historia_clinica.fecha_ymd DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo);
}
elseif ($total_motivo==5) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 

$sql_motivo_conteo = "SELECT tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.motivo, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.url_img_firma_min,
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.costo_motivo_consulta 
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
  OR (tbl15_historia_clinica.motivo='$motivo5')) AND (cod_estado_facturacion=1)) ORDER BY tbl15_historia_clinica.fecha_ymd DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo);
}
elseif ($total_motivo==6) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 

$sql_motivo_conteo = "SELECT tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.motivo, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.url_img_firma_min,
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.costo_motivo_consulta 
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
  OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6')) AND (cod_estado_facturacion=1)) ORDER BY tbl15_historia_clinica.fecha_ymd DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo);
}
elseif ($total_motivo==7) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 
$motivo7 = addslashes($_GET['motivo7']); 

$sql_motivo_conteo = "SELECT tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.motivo, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.url_img_firma_min,
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.costo_motivo_consulta 
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
  OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7')) 
AND (cod_estado_facturacion=1)) ORDER BY tbl15_historia_clinica.fecha_ymd DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo);
}
elseif ($total_motivo==8) {
$motivo = addslashes($_GET['motivo']); 
$motivo2 = addslashes($_GET['motivo2']); 
$motivo3 = addslashes($_GET['motivo3']); 
$motivo4 = addslashes($_GET['motivo4']); 
$motivo5 = addslashes($_GET['motivo5']); 
$motivo6 = addslashes($_GET['motivo6']); 
$motivo7 = addslashes($_GET['motivo7']); 
$motivo8 = addslashes($_GET['motivo8']);

$sql_motivo_conteo = "SELECT tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_historia_clinica.motivo, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.url_img_firma_min,
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, tbl15_historia_clinica.costo_motivo_consulta
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE ((tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.razonsocial_empresa='$razonsocial_empresa') 
AND ((tbl15_historia_clinica.motivo='$motivo') OR (tbl15_historia_clinica.motivo='$motivo2') OR (tbl15_historia_clinica.motivo='$motivo3') OR (tbl15_historia_clinica.motivo='$motivo4') 
  OR (tbl15_historia_clinica.motivo='$motivo5') OR (tbl15_historia_clinica.motivo='$motivo6') OR (tbl15_historia_clinica.motivo='$motivo7') OR (tbl15_historia_clinica.motivo='$motivo8')) AND (cod_estado_facturacion=1)) ORDER BY tbl15_historia_clinica.fecha_ymd DESC";
$resultado_motivo_conteo = mysqli_query($conectar, $sql_motivo_conteo);
}

$smtr_total_costo_motivo_consulta = 0;
$numero                           = 0;
while ($info_motivo_conteo = mysqli_fetch_assoc($resultado_motivo_conteo) ) { 

$numero++;
$cedula                  = $info_motivo_conteo['cedula'];
$nombres                 = $info_motivo_conteo['nombres'];
$apellido1               = $info_motivo_conteo['apellido1'];
$motivo                  = $info_motivo_conteo['motivo'];
$fecha_ymd               = $info_motivo_conteo['fecha_ymd'];
$nombre_empresa          = $info_motivo_conteo['nombre_empresa'];
$razonsocial_empresa     = $info_motivo_conteo['razonsocial_empresa'];
$costo_motivo_consulta   = $info_motivo_conteo['costo_motivo_consulta'];
$url_img_firma_min_cli   = $info_motivo_conteo['url_img_firma_min'];

$codigoHTML.='
          <tr>
            <td style="text-align:center">'.$numero.'</td>
            <td style="text-align:left">'.$nombre_empresa.'</td>
            <td style="text-align:right">'.$cedula.'</td>
            <td style="text-align:left">'.$nombres.' '.$apellido1.'</td>
            <td style="text-align:left">'.$motivo.'</td>
            <td style="text-align:left">'.number_format($costo_motivo_consulta, 0, ",", ".").'</td>
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
$nombre_archivo = 'LISTA_SOCIEDAD_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$razonsocial_empresa.'.pdf';
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