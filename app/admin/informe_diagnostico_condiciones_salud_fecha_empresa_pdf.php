<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");

$serguridad_pagina           = 1; 
$fecha                       = addslashes($_GET['fecha']);
$tipo_fecha                  = addslashes($_GET['tipo_fecha']);
$nombre_empresa              = addslashes($_GET['nombre_empresa']);
$fecha_hoy_ymd_seg           = strtotime(date("Y/m/d"));

$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp = $info_empresa_data['titulo'];
$nombre_emp = $info_empresa_data['nombre'];
$eslogan_emp = $info_empresa_data['eslogan'];
$direccion_emp = $info_empresa_data['direccion'];
$ciudad_emp = $info_empresa_data['ciudad'];
$correo_emp = $info_empresa_data['correo'];
$img_cabecera_emp = $info_empresa_data['img_cabecera'];
$telefono_emp = $info_empresa_data['telefono'];
$info_legal_emp = $info_empresa_data['info_legal'];
$propietario_nombres_apellidos_emp = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp = $info_empresa_data['propietario_nit'];
$nit_empresa_emp = $info_empresa_data['nit_empresa'];
$cabecera_emp = $info_empresa_data['cabecera'];
$icono_emp = $info_empresa_data['icono'];
$nombre_font_emp = $info_empresa_data['nombre_font'];
$tamano_font_emp = $info_empresa_data['tamano_font'];
$tamano_font_aptlab_emp = $info_empresa_data['tamano_font_aptlab'];
$departamento_emp = $info_empresa_data['departamento'];
$localidad_emp = $info_empresa_data['localidad'];
$reg_medico_emp = $info_empresa_data['reg_medico'];
$regimen_emp = $info_empresa_data['regimen'];
$propietario_url_firma_emp = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp = $info_empresa_data['fecha_time'];
$licencia_emp = $info_empresa_data['licencia'];
$info_histclinic_emp = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp = $info_empresa_data['info_aptlaboral'];

$nombres_completos = "CONCEPTO DE APTITUD LABORAL-";

include_once('mpdf/mpdf.php');
$margen_izq = '10';
$margen_der = '10';
$margen_inf_encabezado = '15';
$margen_sup_encabezado = '5';
$posicion_sup_encabezado = '1';
$posicion_inf_encabezado = '20';

$titulo_doc_pdf            = $nombres_completos;
$autor_doc_pdf             = $propietario_nombres_apellidos_emp;
$creador_doc_pdf           = $propietario_nombres_apellidos_emp;
$tema_doc_pdf              = "CONCEPTO DE APTITUD LABORAL";
$palabras_claves_doc_pdf   = $nombres_cli.' '.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_actitud_laboral;

//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','Legal','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

$header = '';
$headerE = '';
$footer = '';
$footerE = '
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
#chartdiv01 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv02 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv03 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv04 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv05 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv06 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv07 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv08 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv09 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv10 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv11 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv12 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv13 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv14 { width: 100%; height: 600px; font-size: 15px; }
#chartdiv15 { width: 100%; height: 600px; font-size: 15px; }

.amcharts-pie-slice {
transform: scale(1); transform-origin: 50% 50%; transition-duration: 0.3s; transition: all .3s ease-out; -webkit-transition: all .3s ease-out; 
-moz-transition: all .3s ease-out; -o-transition: all .3s ease-out; cursor: pointer; box-shadow: 0 0 30px 0 #000;
}
.amcharts-pie-slice:hover { transform: scale(1.1); filter: url(#shadow); }
</style>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script src="../js/amcharts_graf/amcharts.js"></script>
<script src="../js/amcharts_graf/funnel.js"></script>
<script src="../js/amcharts_graf/pie.js"></script>
<script src="../js/amcharts_graf/serial.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/amcharts_graf/dataloader.min.js"></script>
<script src="../js/amcharts_graf/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="../js/amcharts_graf/plugins/export/export.css" type="text/css" media="all" />
<script src="../js/amcharts_graf/themes/light.js"></script>
<script src="../js/amcharts_graf/themes/black.js"></script>
<script src="../js/amcharts_graf/themes/chalk.js"></script>
<script src="../js/amcharts_graf/themes/dark.js"></script>
<script src="../js/amcharts_graf/themes/patterns.js"></script>

<script>
var chartdiv01 = AmCharts.makeChart( "chartdiv01", {
  "type": "funnel",
  "theme": "light",
  "titles": [ {
  "text": "DR. EDINSON CASTRO VALDERRAMA",
  "size": 16
  } ],
dataLoader: { "url": "data_Pie_Chart_with_Legend_mes_personevaluada_json.php?fecha='.$fecha.'&tipo_fecha='.$tipo_fecha.'&nombre_empresa='.$nombre_empresa.'" },
  "balloon": {
    "fixedPosition": true
  },
  "valueField": "conteo_estado_facturacion",
  "titleField": "nombre_person_eval",
  "marginRight": 240,
  "marginLeft": 50,
  "startX": -500,
  "depth3D": 100,
  "angle": 40,
  "outlineAlpha": 1,
  "outlineColor": "#FFFFFF",
  "outlineThickness": 2,
  "labelPosition": "right",
  "balloonText": "[[nombre_person_eval]]: [[conteo_estado_facturacion]]n[[description]]",
  "export": {
    "enabled": true
  }
} );
</script>
<div id="chartdiv01"></div>

<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  </tr>

  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
     </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:7pt; width:100%">
  <tr>
    <td colspan="2"><p><strong>'.$info_aptlaboral_emp.'</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>FIRMA DEL MÉDICO</strong></p>
    <div><img src="'.$propietario_url_firma_emp.'" height="60px"/></div>
    <div>_________________________________________ </div>
        <p><strong>'.$nombres_prof.' '.$apellidos_prof.'</strong></p></td>

    <td><p><strong>FIRMA DEL PACIENTE</strong></p>
    <div><img src="'.$url_img_firma_min_cli.'" height="60px"/></div>
    <div>_________________________________________ </div>
        <p><strong>'.$nombres_cli.' '.$apellido1_cli.'</strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Reg. M&eacute;dico: '.$reg_medico_emp. ' </strong><strong>Licencia Salud Ocupacional '.$licencia_emp.'</strong><strong> </strong></p></td>
    <td><p><strong>C.C '.$cedula.'</strong> </p></td>
  </tr>
</table>

</body>
</html>
';
$mpdf->WriteHTML(($codigoHTML));
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle($titulo_doc_pdf);
$mpdf->SetAuthor($autor_doc_pdf);
$mpdf->SetCreator($autor_doc_pdf);
$mpdf->SetSubject($tema_doc_pdf);
$mpdf->SetKeywords($palabras_claves_doc_pdf);
$mpdf->SetWatermarkText("Paid");
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->showWatermarkText = true;
//$mpdf->SetJS('print();');
$ruta = '../pdfs/';
$nombre_archivo = 'CONCAPTLAB_'.'.pdf';
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