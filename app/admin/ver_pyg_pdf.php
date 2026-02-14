<?php 
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');

$cod_pyg                   = intval($_GET['cod_pyg']);
$fecha_mes                 = addslashes($_GET['fecha_mes']);
$fecha_dmy                 = $fecha_mes.'-01';
$frag_fecha                = explode('-', $fecha_dmy);
$fech_dia                  = $frag_fecha[2];
$fech_mes                  = $frag_fecha[1];
$fech_anyo                 = $frag_fecha[0];
$fecha_ymd                 = $fech_anyo.'-'.$fech_mes.'-'.$fech_dia;
$fecha_ymd_seg             = strtotime($fecha_ymd);
$fecha_sig_seg             = strtotime($fecha_ymd.'+1 month');
$fecha_actual_seg          = strtotime($fecha_sig_seg.'-1 day');
$fecha_mes_esp             = fecha_en_espanol_mes($fecha_ymd_seg);
$fecha_dia                 = date("d", $fecha_actual_seg);

include_once('mpdf/mpdf.php');
$margen_izq                = '10';
$margen_der                = '10';
$margen_inf_encabezado     = '15';
$margen_sup_encabezado     = '5';
$posicion_sup_encabezado   = '1';
$posicion_inf_encabezado   = '20';

$titulo_doc_pdf            = "ESTADO DE RESULTADOS - PYG A".' '.$fecha_dia.' DE '.strtoupper($fecha_mes_esp).' DE '.$fech_anyo;
$autor_doc_pdf             = "ESTADO DE RESULTADOS - PYG A".' '.$fecha_dia.' DE '.strtoupper($fecha_mes_esp).' DE '.$fech_anyo;
$creador_doc_pdf           = "ESTADO DE RESULTADOS - PYG A".' '.$fecha_dia.' DE '.strtoupper($fecha_mes_esp).' DE '.$fech_anyo;
$tema_doc_pdf              = "ESTADO DE RESULTADOS - PYG A".' '.$fecha_dia.' DE '.strtoupper($fecha_mes_esp).' DE '.$fech_anyo;
$palabras_claves_doc_pdf   = "ESTADO DE RESULTADOS - PYG A".' '.$fecha_dia.' DE '.strtoupper($fecha_mes_esp).' DE '.$fech_anyo;

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
</head>
<body>
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:12pt; width:90%">
  <tr height="17">
    <td height="17" width="43"></td>
    <td style="text-align:center" colspan="4" width="535"><strong>ESTADO DE RESULTADOS - PYG</strong></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td style="text-align:center" colspan="4"><strong>A '.$fecha_dia.' DE '.strtoupper($fecha_mes_esp).' DE '.$fech_anyo.'</strong></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td></td><td></td><td></td><td></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td></td><td></td><td></td><td></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td><strong>INGRESOS OPERACIONALES</strong></td>
    <td></td><td></td><td></td>
  </tr>';
$obtener_info_ingre_operacional = "SELECT cod_ingre_operacional, nombre_ingre_operacional, costo_ingre_operacional, puc_ingre_operacional 
FROM tbl15_ingre_operacional WHERE cod_pyg = '$cod_pyg'";
$resultado_info_ingre_operacional = mysqli_query($conectar, $obtener_info_ingre_operacional) or die(mysqli_error($conectar));
$total_datos_ingre_operacional = mysqli_num_rows($resultado_info_ingre_operacional);
while ($info_ingre_operacional = mysqli_fetch_assoc($resultado_info_ingre_operacional)) { 

$cod_ingre_operacional            = $info_ingre_operacional['cod_ingre_operacional'];
$nombre_ingre_operacional         = $info_ingre_operacional['nombre_ingre_operacional'];
$costo_ingre_operacional          = $info_ingre_operacional['costo_ingre_operacional'];
$puc_ingre_operacional            = $info_ingre_operacional['puc_ingre_operacional'];
$total_ingre_operacional         += $costo_ingre_operacional;

$codigoHTML.='
  <tr height="17">
    <td height="17" align="left">'.$puc_ingre_operacional.'</td>
    <td>'.$nombre_ingre_operacional.'</td>
    <td></td>
    <td align="right">'.number_format($costo_ingre_operacional, 0, ",", ".").'</td>
  </tr>';
}
$codigoHTML.='
  <tr height="17">
    <td height="17"></td>
    <td><strong>TOTAL INGRESOS OPERACIONALES</strong></td>
    <td></td><td></td>
    <td align="right"><strong>'.number_format($total_ingre_operacional, 0, ",", ".").'</strong></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td></td><td></td><td></td>
    <td></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td><strong>COSTOS OPERACIONALES</strong></td>
    <td></td><td></td>
    <td align="right"></td>
  </tr>';
$obtener_info_costo_operacional = "SELECT cod_costo_operacional, nombre_costo_operacional, costo_costo_operacional, puc_costo_operacional 
FROM tbl15_costo_operacional WHERE cod_pyg = '$cod_pyg'";
$resultado_info_costo_operacional = mysqli_query($conectar, $obtener_info_costo_operacional) or die(mysqli_error($conectar));
$total_datos_costo_operacional = mysqli_num_rows($resultado_info_costo_operacional);
while ($info_costo_operacional = mysqli_fetch_assoc($resultado_info_costo_operacional)) { 

$cod_costo_operacional            = $info_costo_operacional['cod_costo_operacional'];
$nombre_costo_operacional         = $info_costo_operacional['nombre_costo_operacional'];
$costo_costo_operacional          = $info_costo_operacional['costo_costo_operacional'];
$puc_costo_operacional            = $info_costo_operacional['puc_costo_operacional'];
$total_costo_operacional         += $costo_costo_operacional;

$codigoHTML.='
  <tr height="17">
    <td height="17" align="left">'.$puc_costo_operacional.'</td>
    <td>'.$nombre_costo_operacional.'</td>
    <td></td>
    <td align="right">'.number_format($costo_costo_operacional, 0, ",", ".").'</td>
    <td></td>
  </tr>';
}
$total_utilidad_bruta = $total_ingre_operacional - $total_costo_operacional;

$codigoHTML.='
  <tr height="17">
    <td height="17"></td>
    <td><strong>TOTAL COSTOS OPERACIONALES</strong></td>
    <td></td><td></td>
    <td align="right">'.number_format($total_costo_operacional, 0, ",", ".").'</td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td>UTILIDAD BRUTA</td>
    <td></td><td></td>
    <td align="right">'.number_format($total_utilidad_bruta, 0, ",", ".").'</td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td></td><td></td><td></td><td></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td><strong>Menos</strong></td>
    <td></td><td></td><td></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td><strong>GASTOS OPERACIONALES</strong></td>
    <td></td><td></td><td></td>
  </tr>';
$obtener_info_gasto_operacional = "SELECT cod_gasto_operacional, nombre_gasto_operacional, costo_gasto_operacional, puc_gasto_operacional 
FROM tbl15_gasto_operacional WHERE cod_pyg = '$cod_pyg'";
$resultado_info_gasto_operacional = mysqli_query($conectar, $obtener_info_gasto_operacional) or die(mysqli_error($conectar));
$total_datos_gasto_operacional = mysqli_num_rows($resultado_info_gasto_operacional);
while ($info_gasto_operacional = mysqli_fetch_assoc($resultado_info_gasto_operacional)) { 

$cod_gasto_operacional            = $info_gasto_operacional['cod_gasto_operacional'];
$nombre_gasto_operacional         = $info_gasto_operacional['nombre_gasto_operacional'];
$costo_gasto_operacional          = $info_gasto_operacional['costo_gasto_operacional'];
$puc_gasto_operacional            = $info_gasto_operacional['puc_gasto_operacional'];
$total_gasto_operacional         += $costo_gasto_operacional;

$codigoHTML.='
  <tr height="20">
    <td height="17" align="left">'.$puc_gasto_operacional.'</td>
    <td>'.$nombre_gasto_operacional.'</td>
    <td></td>
    <td align="right">'.number_format($costo_gasto_operacional, 0, ",", ".").'</td>
    <td></td>
  </tr>';
}
$total_resultado_operacional     = $total_utilidad_bruta - $total_gasto_operacional;
$total_resultado_antes_impuesto  = $total_resultado_operacional;
$total_resultado_ejercicio       = $total_resultado_operacional;

$codigoHTML.='
  <tr height="17">
    <td height="17"></td>
    <td><strong>TOTAL GASTOS OPERACIONALES</strong></td>
    <td></td><td></td>
    <td align="right"><strong>'.number_format($total_gasto_operacional, 0, ",", ".").'</strong></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td></td><td></td><td></td><td></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td><strong>RESULTADO OPERACIONAL</strong></td>
    <td></td>
    <td></td>
    <td align="right"><strong>'.number_format($total_resultado_operacional, 0, ",", ".").'</strong></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td></td><td></td><td></td><td></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td></td>
    <td><u></u></td><td></td><td></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td></td><td></td><td></td><td></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td><strong>RESULTADO ANTES DE IMPUESTOS</strong></td>
    <td></td><td></td>
    <td align="right"><strong>'.number_format($total_resultado_antes_impuesto, 0, ",", ".").'</strong></td>
  </tr>
  <tr height="17">
    <td height="17"></td>
    <td></td><td></td><td></td><td></td>
  </tr>
  <tr height="18">
    <td height="18"></td>
    <td><strong>RESULTADOS DEL EJERCICIO</strong></td>
    <td></td><td></td>
    <td align="right"><strong>'.number_format($total_resultado_ejercicio, 0, ",", ".").'</strong></td>
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
$nombre_archivo = 'ESTADO DE RESULTADOS - PYG A '.$fecha_dia.' DE '.strtoupper($fecha_mes_esp).' DE '.$fech_anyo;
$mpdf->Output($nombre_archivo, 'I');
exit;
?>