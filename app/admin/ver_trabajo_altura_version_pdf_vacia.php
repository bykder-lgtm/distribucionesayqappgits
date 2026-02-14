<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");

$fecha_hoy                  = time();

$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                            = $info_empresa_data['titulo'];
$nombre_emp                            = $info_empresa_data['nombre'];
$eslogan_emp                           = $info_empresa_data['eslogan'];
$direccion_emp                         = $info_empresa_data['direccion'];
$ciudad_emp                            = $info_empresa_data['ciudad'];
$pais_emp                              = $info_empresa_data['pais'];
$correo_emp                            = $info_empresa_data['correo'];
$img_cabecera_emp                      = $info_empresa_data['img_cabecera'];
$telefono_emp                          = $info_empresa_data['telefono'];
$info_legal_emp                        = $info_empresa_data['info_legal'];
$logotipo_emp                          = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp     = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                   = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                       = $info_empresa_data['nit_empresa'];
$cabecera_emp                          = $info_empresa_data['cabecera'];
$icono_emp                             = $info_empresa_data['icono'];
$desarrollador_emp                     = $info_empresa_data['desarrollador'];
$anyo_emp                              = $info_empresa_data['anyo'];
$url_pag                               = $info_empresa_data['url_pag'];
$nombre_font_emp                       = $info_empresa_data['nombre_font'];
$tamano_font_emp                       = $info_empresa_data['tamano_font'];
$tamano_font_aptlab_emp                = $info_empresa_data['tamano_font_aptlab'];
$res_emp                               = $info_empresa_data['res'];
$res1_emp                              = $info_empresa_data['res1'];
$res2_emp                              = $info_empresa_data['res2'];
$departamento_emp                      = $info_empresa_data['departamento'];
$localidad_emp                         = $info_empresa_data['localidad'];
$reg_medico_emp                        = $info_empresa_data['reg_medico'];
$regimen_emp                           = $info_empresa_data['regimen'];
$version_emp                           = $info_empresa_data['version'];
$propietario_url_firma_emp             = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                        = $info_empresa_data['fecha_time'];
$licencia_emp                          = $info_empresa_data['licencia'];
$info_histclinic_emp                   = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                   = $info_empresa_data['info_aptlaboral'];

$nombres_completos                     = "TRABAJO EN ALTURAS";

include_once('mpdf/mpdf.php');
$margen_izq                = '10';
$margen_der                = '10';
$margen_inf_encabezado     = '20';
$margen_sup_encabezado     = '5';
$posicion_sup_encabezado   = '5';
$posicion_inf_encabezado   = '20';

$titulo_doc_pdf            = "TRABAJO EN ALTURAS";
$autor_doc_pdf             = "TRABAJO EN ALTURAS";
$creador_doc_pdf           = "TRABAJO EN ALTURAS";
$tema_doc_pdf              = "TRABAJO EN ALTURAS";
$palabras_claves_doc_pdf   = "TRABAJO EN ALTURAS";

//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','Legal','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins


$header = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_emp.'pt; width:100%">
  <tbody>
    <tr>
      <td><img src="../imagenes/logo_superior_trabajo_altura_pdf_imprimir.png" /></td>
      <td style="text-align:center"><strong>[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]  [&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]</strong></td>
    </tr>
  </tbody>
</table>
';
$headerE = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_emp.'pt; width:100%">
  <tbody>
    <tr>
      <td><img src="../imagenes/logo_superior_trabajo_altura_pdf_imprimir.png" /></td>
      <td style="text-align:center"><strong>[&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]  [&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]</strong></td>
    </tr>
  </tbody>
</table>
';
$footer = '
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; border-top: 1px solid #000000; vertical-align: bottom; color: #000000; width:100%">
<tr>
<td width="100%" style="text-align: center;">
<h6>'.$direccion_emp.' - Teléfonos: '.$telefono_emp.'
<br>
Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6>
</td>
</tr>
</table>
';
$footerE = '
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; border-top: 1px solid #000000; vertical-align: bottom; color: #000000; width:100%">
<tr>
<td width="100%" style="text-align: center;">
<h6>'.$direccion_emp.' - Teléfonos: '.$telefono_emp.'
<br>
Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6>
</td>
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
</style>

<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td><strong>I. TIPO DE EXAMEN</strong></td>
    <td><strong>Fecha: </strong></td>
    <td></td>
  </tr>
  <tr>
    <td><strong>MOTIVO DE EVALUACIÓN: </strong></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="14"><strong>II. IDENTIFICACIÓN DE LA EMPRESA</strong></td>
  </tr>
  <tr>
    <td><strong>Empresa Contratante:</strong></td>
    <td><strong>Empresa a Laborar:</strong></td>
  </tr>
  <tr>
    <td><strong>III. DATOS DEL TRABAJADOR</strong></td>
  </tr>
  <tr>
    <td><strong>Apellidos y Nombres:</strong></td>
    <td><strong>Identificación:</strong></td>
  </tr>
  <tr>
    <td><strong>Cargo:</strong></td>
    <td><strong>Ciudad:</strong></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td><strong>IV. TRABAJOS ANTERIORES</strong></td>
  </tr>
  <tr>
    <td><strong>CENTRO DE TRABAJO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
    <td><strong>TIEMPO:&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
    <td><strong>PUESTO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
    <td><strong>DESCRIPCIÓN DE LA TAREA:</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>ACCIDENTES LABORALES Y SECUELAS:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
    <td colspan="2"><strong>ENFERMEDADES PROFESIONALES Y SECUELAS:</strong></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td><strong>V. ANTECEDENTES HEREDO FAMILIARES</strong></td>
    <td><strong></strong></td>
    <td><strong>VI. ANTECEDENTES GINECO OBSTÉTRICOS</strong></td>
  </tr>
  <tr>
    <td></td>
    <td><strong></strong></td>
    <td>
    <strong>Menarquia:</strong>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>F.M.U:</strong> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Ritmo:</strong></td>
  </tr>
  <tr>
    <td>Diabetes<strong></strong></td>
    <td style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>
      <strong>G:</strong>
      &nbsp;&nbsp;&nbsp;&nbsp;<strong>P:</strong>
      &nbsp;&nbsp;&nbsp;&nbsp;<strong>A:</strong>
      &nbsp;&nbsp;&nbsp;&nbsp;<strong>C:</strong>
      &nbsp;&nbsp;&nbsp;&nbsp;<strong>I.V.S.A:</strong></td>
  </tr>
  <tr>
    <td>Hipertensión<strong></strong></td>
    <td style="text-align:center"></td>
    <td>
      <strong>M.P.F:</strong>&nbsp;&nbsp;&nbsp;&nbsp;
      <strong>F.P.P:</strong>&nbsp;&nbsp;&nbsp;&nbsp;
      <strong>D.O.C:</strong></td>
  </tr>
  <tr>
    <td><p>Cardiopatia<strong></strong></p></td>
    <td style="text-align:center"></td>
    <td>
      <strong>FECHA:</strong>&nbsp;&nbsp;&nbsp;&nbsp;
      <strong>Resultado:</strong></td>
  </tr>
  <tr>
    <td>Asma</td>
    <td style="text-align:center"></td>
    <td><strong>Tratamiento:</strong> 
    &nbsp;&nbsp;&nbsp;&nbsp;<strong>¿Cuál?</strong></td>
  </tr>
  <tr>
    <td>Convulsiones<strong></strong></td>
    <td style="text-align:center"></td>
    <td></td>
  </tr>
  <tr>
    <td>Otros</td>
    <td style="text-align:center"></td>
    <td><strong>Cuáles: </strong></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td colspan="23"><strong>VII. ANTECEDENTES PERSONALES NO PATOLÓGICOS </strong></td>
  </tr>
  <tr>
    <td><strong></strong></td>
    <td style="text-align:center" colspan="2"></td>
    <td colspan="20"><strong>Cuanto:</strong></td>
  </tr>
  <tr>
    <td>Fuma</td>
    <td style="text-align:center" colspan="2"></td>
  </tr>
  <tr>
    <td>Consume Alcohol</td>
    <td style="text-align:center" colspan="2"></td>
  </tr>
  <tr>
    <td>Toxicoman&iacute;as</td>
    <td style="text-align:center" colspan="2"></td>
  </tr>
  <tr>
    <td>Otros</td>
    <td style="text-align:center" colspan="2"></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td colspan="14">
      <strong>VIII. ANTECEDENTES PERSONALES PATOLÓGICOS</strong>
    </td>
  </tr>
  <tr>
    <td colspan="6"><strong>CONVULSIONES (ATAQUES)</strong></td>
    <td style="text-align:center;"></td>
    <td colspan="6"><strong>DIFICULTAD AL RESPIRAR</strong></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td colspan="6"><strong>REACCIONES ALÉRGICAS QUE NO LO DEJAN RESPIRAR</strong></td>
    <td style="text-align:center"></td>
    <td colspan="6"><strong>PROBLEMAS DEL CORAZÓN</strong></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td colspan="6"><strong>CLAUSTROFOBIA (MIEDO A ESTAR EN ESPACIOS CERRADOS)</strong></td>
    <td style="text-align:center"></td>
    <td colspan="6"><strong>PRESIÓN ALTA</strong></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td colspan="6"><strong>DIFICULTAD AL OLER (EXCEPTO CON RESFRIADO)</strong></td>
    <td style="text-align:center"></td>
    <td colspan="6"><strong>TOMA MEDICAMENTOS</strong></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td colspan="6"><strong>DIABETES (AZÚCAR EN LA SANGRE)</strong></td>
    <td style="text-align:center"></td>
    <td colspan="6"><p><strong>USA LENTES</strong></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td colspan="6"><strong>PROBLEMAS PULMONARES</strong></td>
    <td style="text-align:center"></td>
    <td colspan="6"><strong>DIFICULTAD PARA DISTINGUIR LOS COLORES</strong></td>
    <td style="text-align:center"></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td colspan="14"><strong>IX. EXPLORACIÓN FÍSICA</strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>SIGNOS VITALES:</strong></td>
    <td colspan="6"><strong>FC:</strong></td>
    <td colspan="2"><strong>FR:</strong></td>
    <td colspan="3"><strong>TA:</strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>ANTROPOMETRÍA:</strong></td>
    <td colspan="6"><strong>PESO:</strong></td>
    <td colspan="2"><strong>TALLA:</strong></td>
    <td colspan="3"><strong>IMC:</strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>PERÍMETRO DE LA MUÑECA:</strong></td>
    <td colspan="12"><strong>PERÍMETRO DE LA CINTURA:</strong></td>
  </tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr><td colspan="5"></td></tr>
        <tr>
            <td style="text-align:center" rowspan="2"><strong>AGUDEZA VISUAL</strong></td>
            <td style="text-align:center" colspan="2"><strong>SIN CORRECCIÓN</strong></td>
            <td style="text-align:center" colspan="2"><strong>CON CORRECCIÓN</strong></td>
        </tr>
        <tr>
            <td style="text-align:center"><strong>V/ LEJANA</strong></td>
            <td style="text-align:center"><strong>V/ CERCANA</strong></td>
            <td style="text-align:center"><strong>V/ LEJANA</strong></td>
            <td style="text-align:center"><strong>V/ CERCANA</strong></td>
        </tr>
        <tr>
            <td><strong>OJO DERECHO</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
        </tr>
        <tr>
            <td><strong>OJO IZQUIERDO</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
        </tr>
        <tr>
            <td><strong>AMBOS OJOS</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td colspan="2" rowspan="2"><strong>VISIÓN AV:</strong></td>
    <td colspan="3"><strong>OD:</strong></td>
    <td colspan="9" rowspan="2"><strong>ISHIHARA:</strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>OI:</strong></td>
  </tr>
  <tr>
    <td colspan="12"><strong>CABEZA:</strong></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="12"><strong>CUELLO:</strong></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="12"><strong>CARDIO PULMONAR:</strong></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="12"><strong>DIGESTIVO:</strong></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="12"><strong>SISTEMA MUSCULO ESQUELÉTICO:</strong></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="12"><strong>PIEL Y ANEXOS:</strong></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="12"><strong>TEST DE ROMBERG:</strong></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="12"><strong>PRUEBA DE LA MARCHA:</strong></td>
    <td colspan="2"></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td><strong>X. RECOMENDACIONES ESPECÍFICAS TRABAJADOR:</strong></td>
  </tr>
  <tr>
    <td><strong>XI. RECOMENDACIONES ESPECÍFICAS EMPRESA:</strong></td>
  </tr>
  <tr>
    <td>IDX:</td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center;"></td>
  </tr>
</table>
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:7pt; width:100%">
  <tr>
    <td><p><strong>FIRMA DEL MÉDICO</strong></p>
    <div><img src="../imagenes/firma_vacia.jpg" height="60px"/></div>
    <div>_________________________________________ </div>
        <p><strong></strong></p></td>

    <td><p><strong>FIRMA DEL PACIENTE</strong></p>
    <div><img src="../imagenes/firma_vacia.jpg" height="60px"/></div>
    <div>_________________________________________ </div>
        <p><strong></strong></p></td>
  </tr>
  <tr>
    <td><p><strong>Reg. M&eacute;dico: </strong><strong>Licencia Salud Ocupacional</strong><strong> </strong></p></td>
    <td><p><strong>C.C </strong> </p></td>
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
$nombre_archivo = 'CONCTRABALTURA_'.$nombres_cli.'_'.$apellido1_cli.'_'.$nombre_empresa.'_'.$fecha_ymd.'-'.$cedula.'-'.$fecha_hoy.'.pdf';
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