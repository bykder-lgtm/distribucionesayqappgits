<?php 
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');

$anyo                          = intval($_GET['anyo']);
$cod_balance_general           = intval($_GET['cod_balance_general']);
$fecha_dmy                     = '01-'.$fecha_mes;
$frag_fecha                    = explode('-', $fecha_dmy);
$fech_dia                      = $frag_fecha[0];
$fech_mes                      = $frag_fecha[1];
$fech_anyo                     = $frag_fecha[2];
$fecha_ymd                     = $fech_anyo.'-'.$fech_mes.'-'.$fech_dia;
$fecha_ymd_seg                 = strtotime($fecha_ymd);
$fecha_sig_seg                 = strtotime($fecha_ymd.'+1 month');
$fecha_actual_seg              = strtotime($fecha_sig_seg.'-1 day');
$fecha_mes_esp                 = fecha_en_espanol_mes($fecha_ymd_seg);
$fecha_dia                     = date("d", $fecha_actual_seg);

include_once('mpdf/mpdf.php');
$margen_izq                    = '10';
$margen_der                    = '10';
$margen_inf_encabezado         = '15';
$margen_sup_encabezado         = '5';
$posicion_sup_encabezado       = '1';
$posicion_inf_encabezado       = '20';

$titulo_doc_pdf                = "BALANCE GENERAL A DICIEMBRE 31 DE".' '.$anyo;
$autor_doc_pdf                 = "BALANCE GENERAL A DICIEMBRE 31 DE".' '.$anyo;
$creador_doc_pdf               = "BALANCE GENERAL A DICIEMBRE 31 DE".' '.$anyo;
$tema_doc_pdf                  = "BALANCE GENERAL A DICIEMBRE 31 DE".' '.$anyo;
$palabras_claves_doc_pdf       = "BALANCE GENERAL A DICIEMBRE 31 DE".' '.$anyo;

//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

$header = '
<!--
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tbody>
    <tr>
      <td><img src="../imagenes/logo_superior_certificado_manipulacion_alimento_pdf_imprimir.png" /></td>
      <td style="text-align:center"><strong>[FECHA - HORA: '.$fecha_ymd_hora.' - '.$fecha_hora.']  [CMA: '.$cod_manipulacion_alimento.']  [HC: '.$cod_historia_clinica.']</strong></td>
    </tr>
  </tbody>
</table>
-->
';
$headerE = '
<!--
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tbody>
    <tr>
      <td><img src="../imagenes/logo_superior_certificado_manipulacion_alimento_pdf_imprimir.png" /></td>
      <td style="text-align:center"><strong>[FECHA - HORA: '.$fecha_ymd_hora.' - '.$fecha_hora.']  [CMA: '.$cod_manipulacion_alimento.']  [HC: '.$cod_historia_clinica.']</strong></td>
    </tr>
  </tbody>
</table>
-->
';
$footer = '
<!--
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_aptlab_emp.'pt; border-top: 1px solid #000000; vertical-align: bottom; color: #000000; width:100%">
<tr>
<td width="100%" style="text-align: center;">
<h6>'.$direccion_emp.' - Teléfonos: '.$telefono_emp.'
<br>
Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6>
</td>
</tr>
</table>
-->
';
$footerE = '
<!--
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_aptlab_emp.'pt; border-top: 1px solid #000000; vertical-align: bottom; color: #000000; width:100%">
<tr>
<td width="100%" style="text-align: center;">
<h6>'.$direccion_emp.' - Teléfonos: '.$telefono_emp.'
<br>
Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6>
</td>
</tr>
</table>
-->
';
$mpdf->SetHTMLHeader(($header));
$mpdf->SetHTMLHeader(($headerE),'E');
$mpdf->SetHTMLFooter(($footer));
$mpdf->SetHTMLFooter(($footerE),'E');

$codigoHTML='
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head></head>
<body>
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:90%">
  <tr height="17">
    <td height="17" width="73"></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td style="text-align:center" colspan="4"><strong>BALANCE GENERAL</strong></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td style="text-align:center" colspan="4"><strong>A DICIEMBRE 31 DE '.$anyo.'</strong></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>

<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:90%">
  <tr height="17">
    <td height="17" width="73"></td>
    <td width="300"><strong>ACTIVOS</strong></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="17">
    <td height="17" width="73"></td>
    <td width="300"><strong>CORRIENTES</strong></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>';
$obtener_info_activo_corriente = "SELECT cod_activo_corriente, nombre_activo_corriente, costo_activo_corriente, puc_activo_corriente 
FROM tbl15_activo_corriente WHERE cod_balance_general = '$cod_balance_general'";
$resultado_info_activo_corriente = mysqli_query($conectar, $obtener_info_activo_corriente) or die(mysqli_error($conectar));
$total_datos_activo_corriente = mysqli_num_rows($resultado_info_activo_corriente);
while ($info_activo_corriente = mysqli_fetch_assoc($resultado_info_activo_corriente)) { 

$cod_activo_corriente            = $info_activo_corriente['cod_activo_corriente'];
$nombre_activo_corriente         = $info_activo_corriente['nombre_activo_corriente'];
$costo_activo_corriente          = $info_activo_corriente['costo_activo_corriente'];
$puc_activo_corriente            = $info_activo_corriente['puc_activo_corriente'];
$total_activo_corriente         += $costo_activo_corriente;

$codigoHTML.='
  <tr height="17">
    <td height="17" width="73">'.$puc_activo_corriente.'</td>
    <td width="300">'.$nombre_activo_corriente.'</td>
    <td></td>
    <td align="right">'.number_format($costo_activo_corriente, 0, ",", ".").'</td>
    <td></td>
  </tr>';
}
$codigoHTML.='
  <tr height="17">
    <td height="17" width="73"></td>
    <td width="300"><strong>Total Activos Corrientes</strong></td>
    <td></td>
    <td></td>
    <td align="right"><strong>'.number_format($total_activo_corriente, 0, ",", ".").'</strong></td>
  </tr>
</table>
<br>
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:90%">
  <tr height="17">
    <td height="17" width="73"></td>
    <td width="300"><strong>PROPIEDADES, PLANTA Y EQUIPO</strong></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>';
$obtener_info_propied_planta_equipo = "SELECT cod_propied_planta_equipo, nombre_propied_planta_equipo, costo_propied_planta_equipo, puc_propied_planta_equipo 
FROM tbl15_propied_planta_equipo WHERE cod_balance_general = '$cod_balance_general'";
$resultado_info_propied_planta_equipo = mysqli_query($conectar, $obtener_info_propied_planta_equipo) or die(mysqli_error($conectar));
$total_datos_propied_planta_equipo = mysqli_num_rows($resultado_info_propied_planta_equipo);
while ($info_propied_planta_equipo = mysqli_fetch_assoc($resultado_info_propied_planta_equipo)) { 

$cod_propied_planta_equipo            = $info_propied_planta_equipo['cod_propied_planta_equipo'];
$nombre_propied_planta_equipo         = $info_propied_planta_equipo['nombre_propied_planta_equipo'];
$costo_propied_planta_equipo          = $info_propied_planta_equipo['costo_propied_planta_equipo'];
$puc_propied_planta_equipo            = $info_propied_planta_equipo['puc_propied_planta_equipo'];
$total_propied_planta_equipo         += $costo_propied_planta_equipo;

$codigoHTML.='
  <tr height="17">
    <td height="17" width="73">'.$puc_propied_planta_equipo.'</td>
    <td width="300">'.$nombre_propied_planta_equipo.'</td>
    <td></td>
    <td align="right">'.number_format($costo_propied_planta_equipo, 0, ",", ".").'</td>
    <td></td>
  </tr>'; 
}
$codigoHTML.='
  <tr height="17">
    <td height="17" width="73"></td>
    <td width="300"><strong>Total Propiedades, Planta y Equipo</strong></td>
    <td></td>
    <td></td>
    <td align="right"><strong>'.number_format($total_propied_planta_equipo, 0, ",", ".").'</strong></td>
  </tr>
  <tr height="21">
    <td height="21"></td>
    <td><strong>TOTAL ACTIVOS</strong></td>
    <td></td>
    <td></td>
    <td align="right"><strong>'.number_format($total_activo_corriente + $total_propied_planta_equipo, 0, ",", ".").'</strong></td>
  </tr>
</table>
<br>
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:90%">
  <tr height="17">
    <td height="17" width="73"></td>
    <td width="300"><strong>PASIVOS</strong></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr height="17">
    <td height="17" width="73"></td>
    <td width="300"><strong>CORRIENTES</strong></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>'; 
$obtener_info_pasivo_corriente = "SELECT cod_pasivo_corriente, nombre_pasivo_corriente, costo_pasivo_corriente, puc_pasivo_corriente 
FROM tbl15_pasivo_corriente WHERE cod_balance_general = '$cod_balance_general'";
$resultado_info_pasivo_corriente = mysqli_query($conectar, $obtener_info_pasivo_corriente) or die(mysqli_error($conectar));
$total_datos_pasivo_corriente = mysqli_num_rows($resultado_info_pasivo_corriente);
while ($info_pasivo_corriente = mysqli_fetch_assoc($resultado_info_pasivo_corriente)) { 

$cod_pasivo_corriente            = $info_pasivo_corriente['cod_pasivo_corriente'];
$nombre_pasivo_corriente         = $info_pasivo_corriente['nombre_pasivo_corriente'];
$costo_pasivo_corriente          = $info_pasivo_corriente['costo_pasivo_corriente'];
$puc_pasivo_corriente            = $info_pasivo_corriente['puc_pasivo_corriente'];
$total_pasivo_corriente         += $costo_pasivo_corriente;

$codigoHTML.='
  <tr height="17">
    <td height="17" width="73">'.$puc_pasivo_corriente.'</td>
    <td width="300">'.$nombre_pasivo_corriente.'</td>
    <td></td>
    <td align="right">'.number_format($costo_pasivo_corriente, 0, ",", ".").'</td>
    <td></td>
  </tr>'; 
}
$codigoHTML.='
  <tr height="18">
    <td height="18"></td>
    <td><strong>Total Pasivos Corrientes</strong></td>
    <td></td>
    <td></td>
    <td align="right"><strong>'.number_format($total_pasivo_corriente, 0, ",", ".").'</strong></td>
  </tr>
  <tr height="19">
    <td height="19"></td>
    <td><strong>TOTAL PASIVOS</strong></td>
    <td></td>
    <td></td>
    <td align="right"><strong>'.number_format($total_pasivo_corriente, 0, ",", ".").'</strong></td>
  </tr>
</table>
<br>
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:90%">
  <tr height="17">
    <td height="17" width="73"></td>
    <td><strong>PATRIMONIO</strong></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>'; 
$obtener_info_patrimonio = "SELECT cod_patrimonio, nombre_patrimonio, costo_patrimonio, puc_patrimonio 
FROM tbl15_patrimonio WHERE cod_balance_general = '$cod_balance_general'";
$resultado_info_patrimonio = mysqli_query($conectar, $obtener_info_patrimonio) or die(mysqli_error($conectar));
$total_datos_patrimonio = mysqli_num_rows($resultado_info_patrimonio);
while ($info_patrimonio = mysqli_fetch_assoc($resultado_info_patrimonio)) { 

$cod_patrimonio            = $info_patrimonio['cod_patrimonio'];
$nombre_patrimonio         = $info_patrimonio['nombre_patrimonio'];
$costo_patrimonio          = $info_patrimonio['costo_patrimonio'];
$puc_patrimonio            = $info_patrimonio['puc_patrimonio'];
$total_patrimonio_smtr    += $costo_patrimonio;

$codigoHTML.='
  <tr height="17">
    <td height="17" width="73">'.$puc_patrimonio.'</td>
    <td width="300">'.$nombre_patrimonio.'</td>
    <td></td>
    <td align="right">'.number_format($costo_patrimonio, 0, ",", ".").'</td>
    <td></td>
  </tr>'; 
}
$total_patrimonio            = $total_patrimonio_smtr - $total_resultado_ejercicio;
$total_pasivo_patrimonio     = $total_pasivo_corriente + $total_patrimonio;

$codigoHTML.='
  <tr height="17">
    <td height="17" width="73"></td>
    <td width="300"><strong>TOTAL PATRIMONIO</strong></td>
    <td></td>
    <td></td>
    <td align="right"><strong>'.number_format($total_patrimonio, 0, ",", ".").'</strong></td>
  </tr>
</table>
<br>
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:90%">
  <tr>
    <td height="21" width="73"></td>
    <td width="300"><strong>TOTAL PASIVO MAS PATRIMONIO</strong></td>
    <td></td>
    <td></td>
    <td align="right"><strong>'.number_format($total_pasivo_patrimonio, 0, ",", ".").'</strong></td>
  </tr>
</table>
</body>
</html>';

$mpdf->WriteHTML(($codigoHTML));
$mpdf->SetTitle($titulo_doc_pdf);
$mpdf->SetAuthor($autor_doc_pdf);
$mpdf->SetCreator($autor_doc_pdf);
$mpdf->SetSubject($tema_doc_pdf);
$mpdf->SetKeywords($palabras_claves_doc_pdf);
$ruta = '../pdfs/';
$nombre_archivo = "BALANCE GENERAL A DICIEMBRE 31 DE".' '.$anyo;
$mpdf->Output($nombre_archivo, 'I');
exit;
?>