<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");

$pagina_local                  = $_SERVER['PHP_SELF'];
$fecha_hoy_time                = strtotime(date("Y/m/d"));
$fecha_hoy                     = time();
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                          = $info_empresa_data['titulo'];
$nombre_emp                          = $info_empresa_data['nombre'];
$eslogan_emp                         = $info_empresa_data['eslogan'];
$direccion_emp                       = $info_empresa_data['direccion'];
$ciudad_emp                          = $info_empresa_data['ciudad'];
$pais_emp                            = $info_empresa_data['pais'];
$correo_emp                          = $info_empresa_data['correo'];
$img_cabecera_emp                    = $info_empresa_data['img_cabecera'];
$telefono_emp                        = $info_empresa_data['telefono'];
$info_legal_emp                      = $info_empresa_data['info_legal'];
$logotipo_emp                        = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp   = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                 = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                     = $info_empresa_data['nit_empresa'];
$cabecera_emp                        = $info_empresa_data['cabecera'];
$icono_emp                           = $info_empresa_data['icono'];
$desarrollador_emp                   = $info_empresa_data['desarrollador'];
$anyo_emp                            = $info_empresa_data['anyo'];
$url_pag                             = $info_empresa_data['url_pag'];
$nombre_font_emp                     = $info_empresa_data['nombre_font'];
$tamano_font_emp                     = $info_empresa_data['tamano_font'];
$tamano_font_aptlab_emp              = $info_empresa_data['tamano_font_aptlab'];
$res_emp                             = $info_empresa_data['res'];
$res1_emp                            = $info_empresa_data['res1'];
$res2_emp                            = $info_empresa_data['res2'];
$departamento_emp                    = $info_empresa_data['departamento'];
$localidad_emp                       = $info_empresa_data['localidad'];
$reg_medico_emp                      = $info_empresa_data['reg_medico'];
$regimen_emp                         = $info_empresa_data['regimen'];
$version_emp                         = $info_empresa_data['version'];
$propietario_url_firma_emp           = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                      = $info_empresa_data['fecha_time'];
$licencia_emp                        = $info_empresa_data['licencia'];
$info_histclinic_emp                 = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                 = $info_empresa_data['info_aptlaboral'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$nombres_completos = "CERTIFICADO DE MANIPULACION DE ALIMENTOS";

include_once('mpdf/mpdf.php');
$margen_izq                = '10';
$margen_der                = '10';
$margen_inf_encabezado     = '20';
$margen_sup_encabezado     = '5';
$posicion_sup_encabezado   = '5';
$posicion_inf_encabezado   = '20';

$titulo_doc_pdf            = "CERTIFICADO DE MANIPULACION DE ALIMENTOS";
$autor_doc_pdf             = "CERTIFICADO DE MANIPULACION DE ALIMENTOS";
$creador_doc_pdf           = "CERTIFICADO DE MANIPULACION DE ALIMENTOS";
$tema_doc_pdf              = "CERTIFICADO DE MANIPULACION DE ALIMENTOS";
$palabras_claves_doc_pdf   = "CERTIFICADO DE MANIPULACION DE ALIMENTOS";

//$mpdf = new mPDF('c','Legal');
$mpdf = new mPDF('en-GB-x','Legal','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins

$header = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tbody>
    <tr>
      <td><img src="../imagenes/logo_superior_certificado_manipulacion_alimento_pdf_imprimir.png" /></td>
      <td style="text-align:center"><strong>[FECHA - HORA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;] <br> [CMA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]</strong></td>
    </tr>
  </tbody>
</table>
';
$headerE = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_aptlab_emp.'pt; width:100%">
  <tbody>
    <tr>
      <td><img src="../imagenes/logo_superior_certificado_manipulacion_alimento_pdf_imprimir.png" /></td>
      <td style="text-align:center"><strong>[FECHA - HORA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;] <br> [CMA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]</strong></td>
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
    <td style="text-align:center" colspan="7"><strong>&nbsp; 1. IDENTIFICACION DEL MANIPULADOR DE ALIMENTOS</strong></td>
  </tr>
  <tr>
    <td>1.1 </td>
    <td colspan="3">Apellidos: </td>
    <td>1.2 </td>
    <td colspan="2">Nombres: </td>
  </tr>
  <tr>
    <td>1.3 </td>
    <td colspan="3">Tipo de documento: </td>
    <td>1.4 </td>
    <td colspan="2">Numero documento: </td>
  </tr>
  <tr>
    <td>1.5 </td>
    <td>Sexo: </td>
    <td colspan="2">
        <table border="0" cellspacing="0" cellpadding="0" align="left">
          <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>
      </table></td>
    <td>1.6 </td>
    <td colspan="2">Edad:  Años</td>
  </tr>
  <tr>
    <td>1.7 </td>
    <td colspan="2">Afiliación EPS: </td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left"><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table></td>
    <td>1.8 </td>
    <td>Régimen: </td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left"><tr><td>&nbsp;&nbsp;</td></tr></table></td>
  </tr>
  <tr>
    <td>1.9 </td>
    <td colspan="6">Nombre Empresa: &nbsp;&nbsp;</td>
  </tr>

   <tr>
    <td>1.10 </td>
    <td colspan="2">Afiliación ARL: </td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left"><tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table></td>
    <td>1.11 </td>
    <td>Nombre aseguradora: </td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left"><tr><td>&nbsp;&nbsp;</td></tr></table></td>
  </tr>
<!-- ***************************************************************************************************************************** -->
     <table border="1" cellspacing="0" cellpadding="0" align="left"><tr><td></td></tr></table>
<!-- ***************************************************************************************************************************** -->
  <tr>
    <td>1.12 </td>
    <td colspan="6">Dirección residencia: </td>
  </tr>
  <tr>
    <td>1.13 </td>
    <td colspan="3">Barrio: </td>
    <td>1.14 </td>
    <td colspan="2">Teléfonos: </td>
  </tr>
  <tr>
    <td>1.15 </td>
    <td colspan="6">Nombre del establecimiento donde labora:  </td>
  </tr>
  <tr>
    <td>1.16 </td>
    <td colspan="6">Dirección establecimiento: </td>
  </tr>
  <tr>
    <td>1.17 </td>
    <td colspan="3">Barrio: </td>
    <td>1.18 </td>
    <td colspan="2">Teléfonos: </td>
  </tr>
  <tr>
    <td>1.19 </td>
    <td colspan="3">Cargo que desempeña: </td>
    <td>1.20 </td>
    <td colspan="2">Área de trabajo: </td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="7"><strong>2. ANTECEDENTES INFECCIOSOS DEL MANIPULADOR DE ALIMENTOS</strong></td>
  </tr>
  <tr>
    <td colspan="6">El paciente ha presentado alguno de los siguientes síntomas en los últimos 15 o más días: </td>
    <td></td>
  </tr>
  <tr>
    <td>Tos con expectoración</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Fiebre o febrículas</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Lesiones en piel o uñas</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td></td>
  </tr>
  <tr>
    <td>Piel y ojos amarillos </td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Prurito</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
<!-- ***************************************************************************************************************************** -->
     <table border="1" cellspacing="0" cellpadding="0" align="left"><tr><td></td></tr></table>
<!-- ***************************************************************************************************************************** -->
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="7"><strong>3. RECONOCIMIENTO MEDICO DEL MANIPULADOR DE ALIMENTOS</strong></td>
  </tr>
  <tr>
    <td rowspan="3">3.1 </td>
    <td colspan="6">Datos positivos al examen físico del manipulador de alimentos: </td>
  </tr>
  <tr>
    <td>Piel</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Uñas</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Mucosas</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>Aparato gastrointestinal</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td>Extremidades</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td colspan="2">Observaciones: </td>
<!-- ***************************************************************************************************************************** -->
     <table border="1" cellspacing="0" cellpadding="0" align="left"><tr><td></td></tr></table>
<!-- ***************************************************************************************************************************** -->
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="7"><strong>4. RESULTADOS DE EXAMENES DE LABORATORIO </strong></td>
  </tr>
  <tr>
    <td rowspan="3">4.1 </td>
    <td colspan="6">Exámenes clínicos del manipulador de alimentos:<strong> </strong></td>
  </tr>
  <tr>
    <td >Cultivo faríngeo</td>
    <td colspan="2"><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td colspan="2">KOH + cultivo uñas negativo</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">BK Seriado (en caso de sintomático respiratorio)</td>
    <td colspan="2"><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
    <td colspan="2">Observaciones: </td>
  </tr>
<!-- ***************************************************************************************************************************** -->
     <table border="1" cellspacing="0" cellpadding="0" align="left"><tr><td></td></tr></table>
<!-- ***************************************************************************************************************************** -->
  <tr>
    <td>4.2 </td>
    <td colspan="6">Nombre del tbl15_laboratorio clínico: </td>
  </tr>
  <tr>
    <td>4.3 </td>
    <td colspan="6">Nombre y apellido del bacteriólogo que realizo el análisis: </td>
  </tr>
  <tr>
    <td>4.4 </td>
    <td colspan="6">Número de tarjeta profesional: </td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="3"><strong>5. CONCEPTO MEDICO Y TRATAMIENTO</strong></td>
  </tr>
  <tr>
    <td>5.1</td>
    <td>Concepto médico del manipulador de alimentos: </td>
    <td ><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>5.2</td>
    <td>El manipulador de alimentos requiere tratamiento: </td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
<!-- ***************************************************************************************************************************** -->
     <table border="1" cellspacing="0" cellpadding="0" align="left"><tr><td></td></tr></table>
<!-- ***************************************************************************************************************************** -->
  <tr>
    <td>5.3</td>
    <td colspan="2">Descripción tratamiento: </td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<thead>
<tr>
    <td style="text-align:center" rowspan="5">5.4 </td>
    <td style="text-align:center" rowspan="5">Medicamentos formulados: </td>
    <td style="text-align:center" rowspan="2">Nombre genérico</td>
    <td style="text-align:center" rowspan="2">Concentración</td>
    <td style="text-align:center" rowspan="2">Forma farmacéutica</td>
    <td style="text-align:center" rowspan="2">Dosis/vía de administración</td>
    <td style="text-align:center" colspan="2">Cantidad prescrita</td>
</tr>
  <tr>
    <td>En Números</td>
    <td>En letras</td>
  </tr>
</thead>
<tbody>
<tr>
<td>_</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td>_</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td>5.5</td>
    <td colspan="2">El manipulador requiere ser reubicado    temporalmente fuera del área de alimentos:</td>
    <td><table border="0" cellspacing="0" cellpadding="0" align="left">
      <tr>
<td>&nbsp;&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>5.6</td>
    <td>Fecha control médico: </td>
    <td colspan="2"><div align="center">
      <table border="1" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;&nbsp;DIA&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;MES&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;AÑO&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr>
<!-- ***************************************************************************************************************************** -->
     <table border="1" cellspacing="0" cellpadding="0" align="left"><tr><td></td></tr></table>
<!-- ***************************************************************************************************************************** -->
      </table>
    </div></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ***************************************************************************************************************************** -->
<table align="justify" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
  <tr>
    <td style="text-align:center" colspan="4" valign="top"><strong>6. DATOS MEDICO TRATANTE</strong></td>
  </tr>
  <tr>
    <td><p>6.1 </p></td>
    <td><p>Firma: <img src="../imagenes/firma_vacia.jpg" height="60px"/></p></td>
    <td><p>6.2 </p></td>
    <td><p>Nombre y apellido: </p></td>
  </tr>
  <tr>
    <td><p>6.3 </p></td>
    <td><p>Tipo de documento: CC</p></td>
    <td><p>6.3 </p></td>
    <td><p>Número de documento: </p></td>
  </tr>
  <tr>
    <td><p>6.5 </p></td>
    <td><p>Registro medico: </p></td>
    <td><p>6.6 </p></td>
    <td><p>Institución donde labora: '.$direccion_emp.'</p></td>
  </tr>
  <tr>
    <td><p>6.7 </p></td>
    <td><p>Dirección: '.$direccion_emp.'</p></td>
    <td><p>6.8 </p></td>
    <td><p>Teléfono: '.$telefono_emp.'</p></td>
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
$nombre_archivo = 'MANIPULACION_DE_ALIMENTOS_'.$nombres_cli.'_'.$apellido1_cli.'_'.$nombre_empresa.'_'.$fecha_ymd.'-'.$cedula.'-'.$fecha_hoy.'.pdf';
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