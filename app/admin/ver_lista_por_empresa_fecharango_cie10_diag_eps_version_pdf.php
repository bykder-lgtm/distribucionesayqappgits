<?php ob_start();?>
<?php 
date_default_timezone_set("America/Bogota");
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
include_once('../evitar_mensaje_error/error.php');
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$serguridad_pagina                 = 1; 
$nombre_empresa                    = addslashes($_GET['nombre_empresa']);
$fecha_ini                         = addslashes($_GET['fecha_ini']);
$fecha_fin                         = addslashes($_GET['fecha_fin']);
$cod_entidad                       = intval($_GET['cod_entidad']);
$total_cie10_diag                  = intval($_GET['total_cie10_diag']);
$cuenta                            = addslashes($_GET['cuenta']);
$fecha                             = addslashes($_GET['fecha']);
$fecha_seg                         = strtotime($fecha);
$dia_hoy                           = date("d", $fecha_seg);
$mes_hoy                           = date("m", $fecha_seg);
$anyo_hoy                          = date("Y", $fecha_seg);
$fecha_ymdhis                      = date("Y/m/d H:i:s");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_profesional = "SELECT cod_empresa, nombre_empresa, direccion_empresa, telefono_empresa, nit_empresa FROM tbl15_empresa WHERE nombre_empresa = '$nombre_empresa'";
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

$nombres_completos = "LISTA_DIAGNOSTICOS";

include_once('mpdf/mpdf.php');
$margen_izq                = '10';
$margen_der                = '10';
$margen_inf_encabezado     = '40';
$margen_sup_encabezado     = '10';
$posicion_sup_encabezado   = '5';
$posicion_inf_encabezado   = '2';

$nombre_archivo            = 'LISTA_DIAGNOSTICOS_'.$nombre_empresa.'_INI_'.$fecha_ini.'_FIN_'.$fecha_fin;
$titulo_doc_pdf            = 'LISTA_DIAGNOSTICOS_'.$nombre_empresa.'_INI_'.$fecha_ini.'_FIN_'.$fecha_fin;
$autor_doc_pdf             = 'LISTA_DIAGNOSTICOS_'.$nombre_empresa.'_INI_'.$fecha_ini.'_FIN_'.$fecha_fin;
$creador_doc_pdf           = 'LISTA_DIAGNOSTICOS_'.$nombre_empresa.'_INI_'.$fecha_ini.'_FIN_'.$fecha_fin;
$tema_doc_pdf              = 'LISTA_DIAGNOSTICOS_'.$nombre_empresa.'_INI_'.$fecha_ini.'_FIN_'.$fecha_fin;
$palabras_claves_doc_pdf   = 'LISTA_DIAGNOSTICOS_'.$nombre_empresa.'_INI_'.$fecha_ini.'_FIN_'.$fecha_fin;
$aaaaaa   = "LISTA_DIAGNOSTICOS_";

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
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td width="87" valign="top">Empresa: '.$nombre_empresa.'</td>
    <td width="40" valign="top">Nit: '.$nit_empresa.'</td>
  </tr>
  <tr>
    <td width="87" valign="top">Dirección: '.$direccion_empresa.'</td>
    <td width="40" valign="top">Tel: '.$telefono_empresa.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" width="87" valign="top">FECHA INI: '.$fecha_ini.'</td>
    <td style="text-align:center" width="40" valign="top">FECHA FIN: '.$fecha_fin.'</td>
  </tr>
</table>
';

$codigoHTML.='
<br>
        <table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <th style="text-align:center">#</th>
            <th style="text-align:center">Cedula</th>
            <th style="text-align:center">Nombres</th>
            <th style="text-align:center">Motivo</th>
            <th style="text-align:center">Diágnostico</th>
            <th style="text-align:center">Eps</th>
            <th style="text-align:center">Cod</th>
           </tr>';

if ($total_cie10_diag==1) {
$cie10_diag = addslashes($_GET['cie10_diag']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND (tbl15_cie10diag.cie10_diag='$cie10_diag') AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==2) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2')) AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') 
AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==3) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==4) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==5) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==6) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==7) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==8) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==9) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') OR (tbl15_cie10diag.cie10_diag='$cie10_diag9')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==10) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);
$cie10_diag10 = addslashes($_GET['cie10_diag10']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==11) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);
$cie10_diag10 = addslashes($_GET['cie10_diag10']);
$cie10_diag11 = addslashes($_GET['cie10_diag11']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==12) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);
$cie10_diag10 = addslashes($_GET['cie10_diag10']);
$cie10_diag11 = addslashes($_GET['cie10_diag11']);
$cie10_diag12 = addslashes($_GET['cie10_diag12']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag12')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==13) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);
$cie10_diag10 = addslashes($_GET['cie10_diag10']);
$cie10_diag11 = addslashes($_GET['cie10_diag11']);
$cie10_diag12 = addslashes($_GET['cie10_diag12']);
$cie10_diag13 = addslashes($_GET['cie10_diag13']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag12') OR (tbl15_cie10diag.cie10_diag='$cie10_diag13')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==14) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);
$cie10_diag10 = addslashes($_GET['cie10_diag10']);
$cie10_diag11 = addslashes($_GET['cie10_diag11']);
$cie10_diag12 = addslashes($_GET['cie10_diag12']);
$cie10_diag13 = addslashes($_GET['cie10_diag13']);
$cie10_diag14 = addslashes($_GET['cie10_diag14']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag12') OR (tbl15_cie10diag.cie10_diag='$cie10_diag13') OR (tbl15_cie10diag.cie10_diag='$cie10_diag14')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}
elseif ($total_cie10_diag==15) {
$cie10_diag = addslashes($_GET['cie10_diag']); 
$cie10_diag2 = addslashes($_GET['cie10_diag2']); 
$cie10_diag3 = addslashes($_GET['cie10_diag3']); 
$cie10_diag4 = addslashes($_GET['cie10_diag4']); 
$cie10_diag5 = addslashes($_GET['cie10_diag5']); 
$cie10_diag6 = addslashes($_GET['cie10_diag6']); 
$cie10_diag7 = addslashes($_GET['cie10_diag7']); 
$cie10_diag8 = addslashes($_GET['cie10_diag8']);
$cie10_diag9 = addslashes($_GET['cie10_diag9']);
$cie10_diag10 = addslashes($_GET['cie10_diag10']);
$cie10_diag11 = addslashes($_GET['cie10_diag11']);
$cie10_diag12 = addslashes($_GET['cie10_diag12']);
$cie10_diag13 = addslashes($_GET['cie10_diag13']);
$cie10_diag14 = addslashes($_GET['cie10_diag14']);
$cie10_diag15 = addslashes($_GET['cie10_diag15']);

$sql_cie10_diag_conteo = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, 
tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.motivo, tbl15_entidad.nombre_entidad, tbl15_cie10diag.cie10_diag, 
tbl15_cliente.nombre_sexo, tbl15_historia_clinica.cod_historia_clinica, tbl15_historia_clinica.fecha_time 
FROM (tbl15_entidad RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente) 
ON tbl15_entidad.cod_entidad = tbl15_historia_clinica.cod_entidad) LEFT JOIN tbl15_cie10diag 
ON tbl15_historia_clinica.cod_historia_clinica = tbl15_cie10diag.cod_historia_clinica
WHERE (tbl15_historia_clinica.fecha_ymd BETWEEN '$fecha_ini' AND '$fecha_fin') AND (tbl15_historia_clinica.nombre_empresa='$nombre_empresa') 
AND ((tbl15_cie10diag.cie10_diag='$cie10_diag') OR (tbl15_cie10diag.cie10_diag='$cie10_diag2') OR (tbl15_cie10diag.cie10_diag='$cie10_diag3') OR (tbl15_cie10diag.cie10_diag='$cie10_diag4') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag5') OR (tbl15_cie10diag.cie10_diag='$cie10_diag6') OR (tbl15_cie10diag.cie10_diag='$cie10_diag7') OR (tbl15_cie10diag.cie10_diag='$cie10_diag8') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag9') OR (tbl15_cie10diag.cie10_diag='$cie10_diag10') OR (tbl15_cie10diag.cie10_diag='$cie10_diag11') 
OR (tbl15_cie10diag.cie10_diag='$cie10_diag12') OR (tbl15_cie10diag.cie10_diag='$cie10_diag13') OR (tbl15_cie10diag.cie10_diag='$cie10_diag14') OR (tbl15_cie10diag.cie10_diag='$cie10_diag15')) 
AND (tbl15_historia_clinica.cod_entidad='$cod_entidad') AND (tbl15_historia_clinica.cod_estado_facturacion=1) ORDER BY tbl15_historia_clinica.fecha_time DESC";
$resultado_cie10_diag_conteo = mysqli_query($conectar, $sql_cie10_diag_conteo) or die(mysqli_error($conectar));
}

$smtr_total_costo_motivo_consulta = 0;
$numero                           = 0;
while ($info_cie10_diag_conteo = mysqli_fetch_assoc($resultado_cie10_diag_conteo) ) { 

$numero++;
$cod_historia_clinica          = $info_cie10_diag_conteo['cod_historia_clinica'];
$cod_cliente                   = $info_cie10_diag_conteo['cod_cliente'];
$cedula                        = $info_cie10_diag_conteo['cedula'];
$nombres                       = $info_cie10_diag_conteo['nombres'];
$apellido1                     = $info_cie10_diag_conteo['apellido1'];
$nombres_apellidos             = $nombres.' '.$apellido1;
$motivo                        = $info_cie10_diag_conteo['motivo'];
$nombre_sexo                   = $info_cie10_diag_conteo['nombre_sexo'];
$nombre_empresa                = $info_cie10_diag_conteo['nombre_empresa'];
$nombre_entidad                = $info_cie10_diag_conteo['nombre_entidad'];
$cie10_diag                    = $info_cie10_diag_conteo['cie10_diag'];
$fecha_time                    = $info_cie10_diag_conteo['fecha_time'];
$fecha_dmy                     = date("Y/m/d", $fecha_time);
$hora                          = date("H:i", $fecha_time);
//$mes                           = fecha_en_espanol_mes(strtotime($fecha_ymd));
//$fecha_anyo                    = $info_cie10_diag_conteo['fecha_anyo'];

$codigoHTML.='
          <tr>
            <td style="text-align:center">'.$numero.'</td>
            <td style="text-align:right">'.$cedula.'</td>
            <td style="text-align:left">'.$nombres_apellidos.'</td>
            <td style="text-align:left">'.$motivo.'</td>
            <td style="text-align:left">'.$cie10_diag.'</td>
            <td style="text-align:center">'.$nombre_entidad.'</td>
            <td style="text-align:center">'.$cod_historia_clinica.'</td>
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
$nombre_archivo = 'LISTA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_empresa.'_INI'.$fecha_ini.'_FIN'.$fecha_fin.'.pdf';
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