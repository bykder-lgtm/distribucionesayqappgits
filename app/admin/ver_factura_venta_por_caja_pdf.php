<?php ob_start();?>
<?php
date_default_timezone_set("America/Bogota");
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');

$serguridad_pagina                 = 1; 
$cod_info_factura_venta            = intval($_GET['cod_info_factura_venta']);
$fecha                             = addslashes($_GET['fecha']);

$sql_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
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

$nombre1_tercero                                      = $info_profesional['nombre1_tercero'];
$nombre2_tercero                                      = $info_profesional['nombre2_tercero'];
$apellido1_tercero                                    = $info_profesional['apellido1_tercero'];
$apellido2_tercero                                    = $info_profesional['apellido2_tercero'];
$identificacion_tercero                               = $info_profesional['identificacion_tercero'];
$nombre_tipo_identificacion                           = $info_profesional['nombre_tipo_identificacion'];
$direccion_tercero                                    = $info_profesional['direccion_tercero'];
$telefono1_tercero                                    = $info_profesional['telefono1_tercero'];
$digito_tercero                                       = $info_profesional['digito_tercero'];
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$info_profesional['digito_tercero']; }

$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                                           = $info_empresa_data['titulo'];
$nombre_emp                                           = $info_empresa_data['nombre'];
$eslogan_emp                                          = $info_empresa_data['eslogan'];
$direccion_emp                                        = $info_empresa_data['direccion'];
$ciudad_emp                                           = $info_empresa_data['ciudad'];
$pais_emp                                             = $info_empresa_data['pais'];
$correo_emp                                           = $info_empresa_data['correo'];
$img_cabecera_emp                                     = $info_empresa_data['img_cabecera'];
$telefono_emp                                         = $info_empresa_data['telefono'];
$info_legal_emp                                       = $info_empresa_data['info_legal'];
$logotipo_emp                                         = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp                    = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                                  = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                                      = $info_empresa_data['nit_empresa'];
$cabecera_emp                                         = $info_empresa_data['cabecera'];
$icono_emp                                            = $info_empresa_data['icono'];
$desarrollador_emp                                    = $info_empresa_data['desarrollador'];
$anyo_emp                                             = $info_empresa_data['anyo'];
$url_pag                                              = $info_empresa_data['url_pag'];
$nombre_font_emp                                      = $info_empresa_data['nombre_font'];
$tamano_font_emp                                      = $info_empresa_data['tamano_font'];
$tamano_font_factura_emp                              = $info_empresa_data['tamano_font_aptlab'];
$tamano_font_factura_emp                              = $info_empresa_data['tamano_font_factura'];
$res_emp                                              = $info_empresa_data['res'];
$res1_emp                                             = $info_empresa_data['res1'];
$res2_emp                                             = $info_empresa_data['res2'];
$fecha_res_emp                                        = $info_empresa_data['fecha_res'];
$departamento_emp                                     = $info_empresa_data['departamento'];
$localidad_emp                                        = $info_empresa_data['localidad'];
$reg_medico_emp                                       = $info_empresa_data['reg_medico'];
$regimen_emp                                          = $info_empresa_data['regimen'];
$version_emp                                          = $info_empresa_data['version'];
$propietario_url_firma_emp                            = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                                       = $info_empresa_data['fecha_time'];
$licencia_emp                                         = $info_empresa_data['licencia'];
$info_histclinic_emp                                  = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                                  = $info_empresa_data['info_aptlaboral'];
$pag_desarrollador_emp                                = $info_empresa_data['pag_desarrollador'];
$correo_desarrollador_emp                             = $info_empresa_data['correo_desarrollador'];
$url_pag_emp                                          = $info_empresa_data['url_pag'];
$cod_tipo_sistema_numeracion_und_venta                = $info_empresa_data['cod_tipo_sistema_numeracion_und_venta'];
$cod_estado_mostrar_venta_por_caja_global             = $info_empresa_data['cod_estado_mostrar_venta_por_caja_global'];




include_once('mpdf/mpdf.php');
$margen_izq = '10';
$margen_der = '10';
$margen_inf_encabezado = '40';
$margen_sup_encabezado = '10';
$posicion_sup_encabezado = '5';
$posicion_inf_encabezado = '2';

$titulo_doc_pdf                    = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$autor_doc_pdf                     = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$creador_doc_pdf                   = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$tema_doc_pdf                      = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$palabras_claves_doc_pdf           = 'FACTURA_'.str_pad($cod_factura, 4, "0", STR_PAD_LEFT).'_'.$nombre_tipo_producto.'_'.$nombre_empresa;
$aaaaaa   = "FACTURA";
$cod_factura_strpad                = str_pad($cod_factura, 6, "0", STR_PAD_LEFT);
$cod_info_factura_strpad           = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);
$nombres_completos                 = "FACTURA";
//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

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
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; TELEFONO: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$departamento_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
<tr><td width="100%" style="text-align: center;"><h6>.</h6></td></tr>
</table>
';
$footerE = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; TELEFONO: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$departamento_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
<tr><td width="100%" style="text-align: center;"><h6>.</h6></td></tr>
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
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:right" valign="top">Número de Formulario: '.$res_emp.'</td>
  </tr>
    <tr>
    <td style="text-align:right" valign="top">Fecha de Formulario: '.$fecha_res_emp.'</td>
  </tr>
    <tr>
    <td style="text-align:right" valign="top">Autorizado desde: '.$res1_emp.' hasta la '.$res2_emp.'</td>
  </tr>
<!--
  <tr>
    <td style="text-align:right" valign="top">'.$regimen_emp.'</td>
  </tr>
-->
</table>
<!-- /////////////////////////////////////////////////// -->

<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>

    <td width="337" valign="top"><p>&nbsp;</p>
      <table align="" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:90%">
          <tr>
            <td style="text-align:center" rowspan="2">FECHA </td>
            <td style="text-align:center" valign="top">D</td>
            <td style="text-align:center" valign="top">M</td>
            <td style="text-align:center" valign="top">A</td>
          </tr>
          <tr>
            <td style="text-align:center" valign="top">'.$dia_hoy.'</td>
            <td style="text-align:center" valign="top">'.$mes_hoy.'</td>
            <td style="text-align:center" valign="top">'.$anyo_hoy.'</td>
          </tr>
      </table>
    </td>

    <td width="345" valign="top"><p>&nbsp;
       <table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:90%">
          <tr>
            <td style="text-align:center">FACTURA DE VENTA</td>
            <td style="text-align:center">N&ordm;. '.$cod_factura_strpad.'</td>
          </tr>
          <tr>
            <td style="text-align:center">TIPO FACTURA</td>
            <td style="text-align:center">'.$nombre_tipo_factura.'</td>
          </tr>
      </table>
    </td>

  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td width="87" valign="top">Señor (es): '.$nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero.'</td>
    <td width="40" valign="top">'.$nombre_tipo_identificacion.': '.$identificacion_tercero.$digito_tercero.'</td>
  </tr>
  <tr>
    <td width="87" valign="top">Dirección: '.$direccion_tercero.'</td>
    <td width="40" valign="top">Tel: '.$telefono1_tercero.'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">';
$codigoHTML.='
  <tr>
    <td width="576" height="400" valign="top"><p>&nbsp;</p>
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
          <tr>
            <td style="text-align:center" width="120" valign="top"><strong>Cantidad (Unidad)</strong></td>
            <td style="text-align:left" width="250" valign="top"><strong>Descripción</strong></td>
            <td style="text-align:right" width="125" valign="top"><strong>Valor Unitario</strong></td>
            <td style="text-align:right" width="125" valign="top"><strong>Valor Total</strong></td>
            <td style="text-align:right" width="50" valign="top"></td>
           </tr>';

$smtr_total_costo_motivo_consulta = 0;
$numero                           = 0;
$nombre_producto_cliente          = '';

$resultado_sql = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto ASC";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql);
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta) ) { 

  $cod_producto                   = $info_venta['cod_producto'];
  $cod_producto_barra             = $info_venta['cod_producto_barra'];
  $nombre_producto                = $info_venta['nombre_producto'];
  $und_venta                      = $info_venta['und_venta'];
  $precio_venta_producto          = $info_venta['precio_venta_producto'];
  $total_venta_producto           = $info_venta['total_venta_producto'];
  $iva_ptj                        = $info_venta['iva_ptj'];
  $precio_ipc                     = $info_venta['precio_ipc'];
  $comentario_producto            = $info_venta['comentario_producto'];
  $und_caja_sobre                 = $info_venta['und_caja_sobre'];
  $cajas_sobre                    = $info_venta['cajas_sobre'];
  $nombre_tipo_und_caja_sobre     = $info_venta['nombre_tipo_und_caja_sobre'];
  $nombre_tipo_unidad_medida      = $info_venta['nombre_tipo_unidad_medida'];

  $cedula                         = $info_venta['cedula'];
  $nombre_cliente                 = $info_venta['nombre_cliente'];
  $total_venta_temp              += $total_venta_producto;
  $total_costo_motivo_consulta   += $total_venta_producto;
  $numero++;

  if ($cod_estado_mostrar_venta_por_caja_global == '1') { if ($nombre_tipo_unidad_medida == 'CAJA') { $und_venta = $und_venta; $und_venta_caja = intval($und_caja_sobre); $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } elseif ($nombre_tipo_unidad_medida == 'SOBRE') { $und_venta = $cajas_sobre; $und_venta_caja = ''; $subtitulo_tipo_caja = '|'.$nombre_tipo_unidad_medida; } else { $und_venta = $und_venta; $und_venta_caja = ''; $subtitulo_tipo_caja = "|UND"; } }
  if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
  if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

  $sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
  $resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
  $info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

  $nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

  if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }
  if ($nombre_cliente=='') { $nombre_producto_cliente = $nombre_producto; } else { $nombre_producto_cliente = $nombre_cliente.' - '.$nombre_producto; }

$codigoHTML.='
          <tr>
            <td style="text-align:center">'.$und_venta.'</td>
            <td style="text-align:left">'.$nombre_producto.'</td>
            <td style="text-align:right">'.number_format($precio_venta_producto, 0, ",", ".").'</td>
            <td style="text-align:right">'.number_format($total_venta_producto, 0, ",", ".").'</td>
            <td style="text-align:right;font-size:5pt;">'.($und_venta_caja).$subtitulo_tipo_caja.'</td>
          </tr>';
}
$codigoHTML.='
        </table>
  </tr>
</table>';

$codigoHTML.='
<!-- /////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" width="354" valign="top">TOTAL</td>
    <td style="text-align:right" width="332" valign="top">$ '.number_format($total_costo_motivo_consulta, 0, ",", ".").'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td width="45" valign="top">SON:</td>
    <td width="650" valign="top">'.convertir_numeros_a_letras($total_costo_motivo_consulta).'</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td><p><strong>FIRMA</strong></p>
    <div><img src="'.$propietario_url_firma_emp.'" height="90px"/></div>
    <div>___________________________________</div><br> 
      <!-- <p><strong>'.$nombres_prof.' '.$apellidos_prof.'</strong></p></td> -->

    <td><p><strong>RECIBE</strong></p>
    <div><img src="../imagenes/firma_vacia.jpg" height="90px"/></div>
    <div>___________________________________</div><br> 
       <!-- <p><strong>'.$nombres_cli.' '.$apellido1_cli.'</strong></p></td> -->
  </tr>
<!--
  <tr>
    <td><p><strong>Reg. M&eacute;dico: '.$reg_medico_emp. ' </strong><strong>Licencia Salud Ocupacional '.$licencia_emp.'</strong><strong> </strong></p></td>
    <td><p><strong>C.C '.$cedula.'</strong> </p></td>
  </tr>
-->
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<!--
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_factura_emp.'pt; width:100%">
  <tr>
    <td width="693" valign="top">TEL</td>
  </tr>
</table>
-->
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