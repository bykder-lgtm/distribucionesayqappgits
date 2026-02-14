<?php ob_start();?>
<?php 
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");

$fecha_hoy = time();

$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp = $info_empresa_data['titulo'];
$nombre_emp = $info_empresa_data['nombre'];
$eslogan_emp = $info_empresa_data['eslogan'];
$direccion_emp = $info_empresa_data['direccion'];
$ciudad_emp = $info_empresa_data['ciudad'];
$pais_emp = $info_empresa_data['pais'];
$correo_emp = $info_empresa_data['correo'];
$img_cabecera_emp = $info_empresa_data['img_cabecera'];
$telefono_emp = $info_empresa_data['telefono'];
$info_legal_emp = $info_empresa_data['info_legal'];
$logotipo_emp = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp = $info_empresa_data['propietario_nit'];
$nit_empresa_emp = $info_empresa_data['nit_empresa'];
$cabecera_emp = $info_empresa_data['cabecera'];
$icono_emp = $info_empresa_data['icono'];
$desarrollador_emp = $info_empresa_data['desarrollador'];
$anyo_emp = $info_empresa_data['anyo'];
$url_pag = $info_empresa_data['url_pag'];
$nombre_font_emp = $info_empresa_data['nombre_font'];
$tamano_font_emp = $info_empresa_data['tamano_font'];
$tamano_font_aptlab_emp = $info_empresa_data['tamano_font_aptlab'];
$res_emp = $info_empresa_data['res'];
$res1_emp = $info_empresa_data['res1'];
$res2_emp = $info_empresa_data['res2'];
$departamento_emp = $info_empresa_data['departamento'];
$localidad_emp = $info_empresa_data['localidad'];
$reg_medico_emp = $info_empresa_data['reg_medico'];
$regimen_emp = $info_empresa_data['regimen'];
$version_emp = $info_empresa_data['version'];
$propietario_url_firma_emp = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp = $info_empresa_data['fecha_time'];
$licencia_emp = $info_empresa_data['licencia'];
$info_histclinic_emp = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp = $info_empresa_data['info_aptlaboral'];

$nombres_completos = "CONCEPTO DE APTITUD LABORAL";

include_once('mpdf/mpdf.php');
$margen_izq                = '10';
$margen_der                = '10';
$margen_inf_encabezado     = '20';
$margen_sup_encabezado     = '5';
$posicion_sup_encabezado   = '5';
$posicion_inf_encabezado   = '20';

$titulo_doc_pdf            = "CONCEPTO DE APTITUD LABORAL";
$autor_doc_pdf             = "CONCEPTO DE APTITUD LABORAL";
$creador_doc_pdf           = "CONCEPTO DE APTITUD LABORAL";
$tema_doc_pdf              = "CONCEPTO DE APTITUD LABORAL";
$palabras_claves_doc_pdf   = "CONCEPTO DE APTITUD LABORAL";

//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','Legal','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins


$header = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tbody>
    <tr>
      <td><img src="../imagenes/logo_superior_actitud_laboral_pdf_imprimir.png" /></td>
      <td style="text-align:center"><strong>[APL:  ]</strong></td>
    </tr>
  </tbody>
</table>
';
$headerE = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tbody>
    <tr>
      <td><img src="../imagenes/logo_superior_actitud_laboral_pdf_imprimir.png" /></td>
      <td style="text-align:center"><strong>[APL:  ]</strong></td>
    </tr>
  </tbody>
</table>
';
$footer = '
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_aptlab_emp.'pt; border-top: 1px solid #000000; vertical-align: bottom; color: #000000; width:100%">
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
<table align="center" border="0" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_aptlab_emp.'pt; border-top: 1px solid #000000; vertical-align: bottom; color: #000000; width:100%">
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

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tr>
    <td colspan="3"><strong>Empresa Contratante:</strong></td>
    <td colspan="2"><strong></strong></td>
    <td colspan="4"><strong>FECHA:</strong></td>
    <td style="text-align:center"><strong></strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Empresa a Laborar:</strong></td>
    <td colspan="2"><strong></strong></td>
    <td colspan="5"><strong>&nbsp;</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>TIPO DE EXAMEN:</strong></td>
    <td colspan="8"></td>
  </tr>
  <tr>
    <td><strong>NOMBRE:</strong></td>
    <td colspan="3"><strong></strong></td>
    <td colspan="2"><strong>:</strong></td>
    <td colspan="4"><strong></strong></td>
  </tr>
  <tr>
    <td><strong>CARGO:</strong></td>
    <td colspan="3"><strong></strong></td>
    <td colspan="2"><strong>CIUDAD:</strong></td>
    <td colspan="4"><strong></strong></td>
  </tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tr><td style="text-align:center" bgcolor="#FAC090" colspan="15"><strong>CONCEPTOS GENERALES POR TIPO DE EXAMEN</strong></td>
  </tr>
  <tr><td style="text-align:center" bgcolor="#FAC090" colspan="15"><strong>Examen de </strong></td></tr>
  <tr>
    <td colspan="6"><strong>Apto para desempeñar el cargo</strong></td><td style="text-align:center"><strong>[ ]</strong></td>
    <td colspan="4"><strong>Presenta Restricción</strong></td><td style="text-align:center"><strong>[ ]</strong></td>
    <td colspan="2"><strong>Aplazado</strong></td><td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr><td style="text-align:center" colspan="14"><strong>1.2 Examen Periódico</strong></td></tr>
  <tr>
    <td colspan="4" bgcolor="#FAC090"><strong>Puede continuar laborando</strong></td><td style="text-align:center"><strong>[ ]</strong></td>
    <td colspan="2" bgcolor="#FAC090"><strong>Aplazado&nbsp;&nbsp;</strong></td><td style="text-align:center"><strong>[ ]</strong></td>
    <td colspan="4" bgcolor="#FAC090"><strong>Reasignación de tareas</strong></td><td style="text-align:center"><strong>[ ]</strong></td>
    <td bgcolor="#FAC090"><strong>Temporalidad:</strong></td><td style="text-align:center; width:50px"><strong>[ ]</strong>   Dias</td>
  </tr>
  <tr><td colspan="18"><p align="center"><strong>1.3 Examen periódico seguimiento de recomendaciones</strong></td></tr>
  <tr>
    <td colspan="4" bgcolor="#FAC090"><strong>Puede continuar laborando</strong></td><td style="text-align:center"><strong>[ ]</strong></td>
    <td colspan="2" bgcolor="#FAC090"><strong>Aplazado&nbsp;&nbsp;</strong></td><td style="text-align:center"><strong>[ ]</strong></td>
    <td colspan="4" bgcolor="#FAC090"><strong>Reasignación de tareas</strong></td><td style="text-align:center"><strong>[ ]</strong></td>
    <td bgcolor="#FAC090"><strong>Temporalidad:</strong></td><td style="text-align:center; width:50px"><strong>[ ]</strong>   Dias</td>
  </tr>
  <tr><td colspan="14"><p align="center"><strong>1.4 Reintegro / Post &ndash; Incapacidad </strong></td></tr>
  <tr>
    <td colspan="4" bgcolor="#FAC090"><strong>Reincorporación al Puesto de trabajo</strong></td><td style="text-align:center"><strong>[ ]</strong></td>
    <td colspan="2" bgcolor="#FAC090"><strong>Aplazado&nbsp;&nbsp;</strong></td><td style="text-align:center"><strong>[ ]</strong></td>
    <td colspan="4" bgcolor="#FAC090"><strong>Reasignación de tareas</strong></td><td style="text-align:center"><strong>[ ]</strong></td>
    <td bgcolor="#FAC090"><strong>Temporalidad:</strong></td><td style="text-align:center; width:50px"><strong>[ ]</strong>   Dias</td>
  </tr>
  <tr><td style="text-align:center" colspan="15"><strong>1.5 EGRESO</strong></td></tr>
  <tr>
    <td colspan="15"><strong>Realizado<strong>[ ]</strong></strong></td>
  </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" bgcolor="#FAC090" colspan="28"><strong>EX&Aacute;MENES COMPLEMENTARIOS</strong></td>
  </tr>
  <tr>
    <td style="text-align:center" colspan="3"><strong>Optometría</strong></td>
    <td style="text-align:center" colspan="4"><strong>Espirometría</strong></td>
    <td style="text-align:center" colspan="3"><strong>Audiometría</strong></td>
    <td style="text-align:center" colspan="4"><strong>Prueba Psicot&eacute;cnica</strong></td>
    <td style="text-align:center" colspan="3"><strong>Visiometría</strong></td>
    <td style="text-align:center" colspan="4"><strong>Laboratorios</strong></td>
    <td style="text-align:center" colspan="7"><strong>Otros</strong>: </td>
  </tr>
  <tr>
    <td style="text-align:center" colspan="3"><strong><strong>[ ]</strong></strong></td>
    <td style="text-align:center" colspan="4"><strong><strong>[ ]</strong></strong></td>
    <td style="text-align:center" colspan="3"><strong><strong>[ ]</strong></strong></td>
    <td style="text-align:center" colspan="4"><strong><strong>[ ]</strong></strong></td>
    <td style="text-align:center" colspan="3"><strong><strong>[ ]</strong></strong></td>
    <td style="text-align:center" colspan="4"><strong><strong>[ ]</strong></strong></td>
    <td style="text-align:center" colspan="7"> </td>
  </tr>
</table>
  <!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tr><td style="text-align:center" bgcolor="#FAC090" colspan="5"><strong>CONCEPTO DE ACUERDO AL &Eacute;NFASIS</strong></td></tr>
  <tr>
    <td style="text-align:center"><strong>&Eacute;nfasis </strong></td>
    <td style="text-align:center"><strong>Apto</strong></td>
    <td style="text-align:center"><strong>No cumple</strong></td>
    <td style="text-align:center"><strong>Aplazado</strong></td>
    <td style="text-align:center"><strong>Observaciones</strong></td>
  </tr>
  <tr>
    <td><strong>Seguridad vial</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td></td>
  </tr>
  <tr>
    <td><strong>Espacios confinados</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td></td>
  </tr>
  <tr>
    <td><strong>Alturas</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td></td>
  </tr>
  <tr>
    <td><strong>Alimentos</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td></td>
  </tr>
  <tr>
    <td><strong>Actividad deportiva</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td></td>
  </tr>
  <tr>
    <td><strong>Brigadista</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td></td>
  </tr>
  <tr>
    <td><strong>Medicamentos</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td></td>
  </tr>
  <tr>
    <td style="text-align:center" colspan="4"><strong>ENFASIS OSTEOMUSCULAR REALIZADO</strong>&nbsp;&nbsp;&nbsp;<strong>[ ]</strong></td>
    <td></td>
  </tr>
</table>

<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" bgcolor="#FAC090" colspan="6"><strong>RECOMENDACIONES GENERALES</strong></td>
  </tr>
  <tr>
    <td><strong>Se realiza retroalimención de los paraclínicos o exámenes</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td></td>
    <td style="text-align:center"></td>
    <td></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><strong>Control Nutricional en su EPS</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td><strong>Control periódico por PyP en su EPS</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td><strong>Remisión a su EPS por medicina General o especializada.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>Continuar manejo Médico</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td><strong>Uso de E.P.P. de acuerdo al cargo</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td><strong>Inicio o continuar actividad física mínimo 3 veces por semana</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>Control periódico ocupacional</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td><strong>Suspender tabaquismo</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td><strong>Pausas Activas.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>Reducir consumo de alcohol</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td><strong>Ingreso a P.V.E.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td><strong>Remisión a EPS/ARL:</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
   <tr>
    <td><strong>Posturas Ergonómicas</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td><strong>Uso de bloqueador Solar</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td><strong>Realización de pruebas complementarias.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
   <tr>
    <td><strong>Recomendaciones para manejo de cargas.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
    <td colspan="4" style="text-align:center"><strong> Siglas: EPS: Entidad Promotora de salud - PYP: Promoción y Prevención -ARL: Administradora de Riesgos Laborales.</strong></td>
   </tr>
  <tr><td colspan="6"><strong>Observaciones:</strong></td></tr>
  <tr><td colspan="6"><strong> Priorizar en los programas de vigilancia, los riesgos definidos en la matriz de la tbl15_entidad.</strong></td></tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tr><td style="text-align:center" bgcolor="#FAC090" colspan="2"><strong>RECOMENDACIONES OCUPACIONALES PREVENTIVAS</strong></td></tr>
  <tr>
    <td><strong>OSTEOMUSCULAR: Higiene Postural; estiramientos, Pausas activas</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>MANIPULACIÓN DE ALIMENTOS: Lavado de manos; BPM (Buenas Prácticas de Manufactura.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>VISUAL: Pausas activas visuales, iluminación adecuada en el puesto de trabajo. Educación y prevención en higiene visual, Uso de protección visual según tipo de exposición.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>ALTURAS: Certificación en alturas y Capacitación al personal.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>PIEL: Reportar alteraciones en la piel, uso de protección en zonas expuestas a agentes irritantes.</strong>.</td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>RESPIRATORIA: Protección según exposición, Uso de E.P.R. (elementos de protección respiratoria).</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>BIOLÓGICO: Verificación del esquema de vacunación, Uso de elementos de bioseguridad según riesgos.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
    <tr>
    <td><strong>ESPACIOS CONFINADOS: Capacitación, Acompañamiento durante la labor, Sistemas de tbl15_seguridadde emergencia.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>CUIDADO DE LA VOZ: Calentamiento y reposo vocal, educación de uso adecuado para la voz.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>QUÍMICO: Enviar marcadores biológicos específicos según exposición en los trabajadores.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>AUDITIVO: Reposo auditivo extralaboral, Protección auditiva de acuerdo con la exposición a ruido.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
  <tr>
    <td><strong>TEMPERATURAS EXTREMAS: Capacitación en identificación temprana de signos de alarma, Uso de la ropa adecuada.</strong></td>
    <td style="text-align:center"><strong>[ ]</strong></td>
  </tr>
</table>

<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tr><td bgcolor="#FAC090"><strong>RECOMENDACIONES / EMPRESA</strong></td></tr>
  <tr><td style="text-align:left">_</td></tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table border="1" align="center" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tr><td bgcolor="#FAC090"><strong>RECOMENDACIONES / TRABAJADOR </strong></td></tr>
  <tr><td style="text-align:left">_</td></tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
     </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="justify" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:7pt; width:100%">
    <tbody>
    	<tr>
    		<td style="text-align:justify">'.$info_aptlaboral_emp.'</td>
    	</tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" style="font-family:mono; font-size:10pt; width:100%">
  <tr>
    <td width="387" valign="top"><strong>Medico</strong>
    <div style="text-align:center"><img src="../imagenes/firma_vacia.jpg" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong></strong>
    <br />
    <strong>Reg. Medico </strong>
    <br />
    <strong>Licencia Salud Ocupacional </strong> </td>
    <td width="387" valign="top"><strong>Paciente</strong>
    <div style="text-align:center"><img src="../imagenes/firma_vacia.jpg"height="60px"/></div>
    <div>_________________________________________ </div>
    <strong></strong><br />
    <strong>C.C </strong> </td>
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
$nombre_archivo = 'CONCAPTLAB_'.$nombres_cli.'_'.$apellido1_cli.'_'.$nombre_empresa.'_'.$fecha_ymd.'-'.$cedula.'-'.$fecha_hoy.'.pdf';
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