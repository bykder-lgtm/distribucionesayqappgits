<?php ob_start();?>
<?php
date_default_timezone_set("America/Bogota");
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');

$serguridad_pagina                          = 1; 
$cod_info_plan_accion_correctiva_preventiva_mejora    = intval($_GET['cod_info_plan_accion_correctiva_preventiva_mejora']);
$fecha                                      = addslashes($_GET['fecha']);

$sql_info_factura = "SELECT * FROM tbl15_info_plan_accion_correctiva_preventiva_mejora WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura);
$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

$cod_factura                       = $info_info_factura['cod_factura'];
$cod_tercero                       = $info_info_factura['cod_tercero'];
$razonsocial_empresa               = $info_info_factura['razonsocial_empresa'];
$cuenta                            = $info_info_factura['cuenta'];
$cod_estado_factura                = $info_info_factura['cod_estado_factura'];
$fecha_anyo                        = $info_info_factura['fecha_anyo'];
$fecha_hora                        = $info_info_factura['fecha_hora'];
$cod_tipo_pago                     = $info_info_factura['cod_tipo_pago'];
$cod_administrador                 = $info_info_factura['cod_administrador'];
$nombre_tipo_producto              = $info_info_factura['nombre_tipo_producto'];
$cod_cliente                       = $info_info_factura['cod_cliente'];
$nombre_tipo_factura               = $info_info_factura['nombre_tipo_factura'];
$fecha_seg                         = strtotime($fecha_anyo);
$dia_hoy                           = date("d", $fecha_seg);
$mes_hoy                           = date("m", $fecha_seg);
$anyo_hoy                          = date("Y", $fecha_seg);

$sql_profesional = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$nombre1_tercero                   = $info_profesional['nombre1_tercero'];
$nombre2_tercero                   = $info_profesional['nombre2_tercero'];
$apellido1_tercero                 = $info_profesional['apellido1_tercero'];
$apellido2_tercero                 = $info_profesional['apellido2_tercero'];
$identificacion_tercero            = $info_profesional['identificacion_tercero'];
$direccion_tercero                 = $info_profesional['direccion_tercero'];
$telefono1_tercero                 = $info_profesional['telefono1_tercero'];

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
$fecha_res_emp                     = $info_empresa_data['fecha_res'];
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
$pag_desarrollador_emp             = $info_empresa_data['pag_desarrollador'];
$correo_desarrollador_emp          = $info_empresa_data['correo_desarrollador'];


include_once('mpdf/mpdf.php');
$margen_izq = '5';
$margen_der = '5';
$margen_inf_encabezado = '5';
$margen_sup_encabezado = '5';
$posicion_sup_encabezado = '5';
$posicion_inf_encabezado = '2';

$titulo_doc_pdf                    = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$autor_doc_pdf                     = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$creador_doc_pdf                   = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$tema_doc_pdf                      = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$palabras_claves_doc_pdf           = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$aaaaaa   = "FACTURA";
$cod_factura_strpad                = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
$cod_info_factura_strpad           = str_pad($cod_info_plan_accion_correctiva_preventiva_mejora, 6, "0", STR_PAD_LEFT);
$nombres_completos                 = "FACTURA";
//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
/*
$header = '
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:20pt; width:100%">
  <tr>
    <td style="text-align:left" rowspan="6" width="200"><img src="../imagenes/logo_limp.png" class="img img-responsive" style="width:200px;"></td>
    <th style="text-align:center; font-size:18pt;" width="442">'.$nombre_emp.'</th>
    <td style="text-align:right" rowspan="6" width="140"><barcode code="'.$pag_desarrollador_emp.'" size="1" type="QR" error="M" class="barcode" /></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;">NIT: '.$propietario_nit_emp.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;">TELEFONO: '.$telefono_emp.' - EMAIL: '.$correo_emp.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;">'.$ciudad_emp.' - '.$departamento_emp.', '.$pais_emp.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;"><barcode code="'.$cod_factura_strpad.'" type="C128A" size="0.6" height="1" /></td>
  </tr>
</table>
';
$headerE = '
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:20pt; width:100%">
  <tr>
    <td style="text-align:left" rowspan="6" width="140"><img src="../imagenes/logo_limp.png" class="img img-responsive" style="width:100px;"></td>
    <th style="text-align:center; font-size:18pt;" width="442">'.$nombre_emp.'</th>
    <td style="text-align:right" rowspan="6" width="140"><barcode code="'.$pag_desarrollador_emp.'" size="1" type="QR" error="M" class="barcode" /></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;">NIT: '.$propietario_nit_emp.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;">TELEFONO: '.$telefono_emp.' - EMAIL: '.$correo_emp.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;">'.$ciudad_emp.' - '.$departamento_emp.', '.$pais_emp.'</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:8pt;"><barcode code="'.$cod_factura_strpad.'" type="C128A" size="0.6" height="1" /></td>
  </tr>
</table>
';
$footer = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$departamento_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
</table>
';
$footerE = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$departamento_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
</table>
';

$mpdf->SetHTMLHeader(($header));
$mpdf->SetHTMLHeader(($headerE),'E');
$mpdf->SetHTMLFooter(($footer));
$mpdf->SetHTMLFooter(($footerE),'E');
*/
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
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellpadding="1" cellspacing="4" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr >
    <td style="text-align:center" colspan="3" rowspan="2" width="20"><img src="../imagenes/image-1.png" class="img img-responsive" style="width:90px;"></td>
    <td style="text-align:left; font-size:12pt;" width="120">Industrias</td>
    <td></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:30pt" width="120"><strong>Corfibra Ltda.</strong></td>
    <td style="text-align:center; font-size:7pt" rowspan="2">
    Calle 41 No. 14-136
    <br>
    Tel. 792 62 44 - 792 6243
    <br>
    Cel. 314 548 57 50 - Cel. 321 533 07 53
    <br>
    Monteria - Cordoba
    </td>
  </tr>
  <tr>
    <td style="text-align:center" width="8">DIA</td>
    <td style="text-align:center" width="8">MES</td>
    <td style="text-align:center" width="8">AÑO</td>
    <td style="text-align:center; font-size:12pt" width="5"><strong>NIT. 9000142732-7</strong></td>
  </tr>
  <tr>
    <td style="text-align:center" width="8">10</td>
    <td style="text-align:center" width="8">10</td>
    <td style="text-align:center" width="8">2021</td>
    <td style="text-align:center; font-size:8pt">Diseño, ingeniera, recubrimiento Industrial, Tanques en cualquier forma y capacidad, Laminas, Ductos y Tuberías, Juegos para parques de Diversiones, etc.</td>
    <td style="text-align:center" width="120">ORDEN DE PRODUCCION<br>2154</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="1" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:left">CLIENTE:</td>
    <td style="text-align:left" colspan="3">ANA LUNA</td>
    <td style="text-align:left">CC.ó NIT: 212511511</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="1" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:left">DIRECCION:</td>
    <td style="text-align:left" colspan="2">CLL 20 78A 25-95</td>
    <td style="text-align:left">TELEFONO: </td>
    <td style="text-align:left">302541151</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="1" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:left">CELULARES:</td>
    <td style="text-align:left">3215145212</td>
    <td style="text-align:center">PENDIENTE:</td>
    <td style="text-align:left">MATERIAL</td>
    <td style="text-align:left">decrpc</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="1" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:left">COMENTARIOS:</td>
    <td style="text-align:left">coment</td>
    <td style="text-align:right" rowspan="2" width="70">TIEMPO DE ENTREGA</td>
    <td style="text-align:center">FECHA:</td>
    <td style="text-align:center">10/12/2021</td>
  </tr>
  <tr>
    <td style="text-align:left">FACTURA O REMISION:</td>
    <td style="text-align:left">REMI</td>
    <td style="text-align:center">HORA:</td>
    <td style="text-align:center">10:24</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="4" cellspacing="4" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
  <tr>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
  </tr>
</table>
';

$codigoHTML.='
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" width="100">VR. TOTAL IVA INCLUIDO</td>
    <td style="text-align:center">'.number_format(0, 0, ",", ".").'</td>
    <td style="text-align:center"></td>
    <td style="text-align:center" width="100">ELABORO</td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td style="text-align:center">ANTICIPO $</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td style="text-align:left" colspan="2" rowspan="2">ACEPTACION DE CLIENTE<br>CC<br>.</td>
  </tr>
  <tr>
    <td style="text-align:center">SALDO $</td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center">NORA: SE RESPONDE  UNICAMENTE POR MEDIDAS Y ESPECIFICACIONES ANOTADAS</td>
  </tr>
  <tr>
    <td style="text-align:center">ORIGINAL: EMPRESA - COPIA 1 CLIENTE COPIA 2 TECNICO</td>
  </tr>
  <tr>
    <td style="text-align:center"><a href="http://www.corfibra.com/">WWW.corfibra.com</a></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
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
$nombre_archivo = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa.'.pdf';
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