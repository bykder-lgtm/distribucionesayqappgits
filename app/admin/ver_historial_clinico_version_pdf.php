<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");

$cod_historia_clinica = intval($_GET['cod_historia_clinica']);
$fecha_hoy = time();

$sql_info_empresa = "SELECT titulo, nombre, eslogan, direccion, ciudad, pais, correo, cabecera, img_cabecera, telefono, info_legal, 
res, res1, res2, departamento, localidad, reg_medico, regimen, version, propietario_url_firma, fecha_time, licencia,
logotipo, icono, propietario_nombres_apellidos, propietario_nit, nit_empresa, desarrollador, anyo, url_pag, nombre_font FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
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
$nombre_font = $info_empresa_data['nombre_font'];
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

$sql_historia_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cod_cliente, tbl15_cliente.nombre_tipo_doc, 
tbl15_cliente.nombre_ocupacion, tbl15_cliente.cod_entidad, tbl15_cliente.cedula, tbl15_cliente.nombre_sexo, tbl15_cliente.nombre_contacto1, 
tbl15_cliente.parentesco_contacto1, tbl15_cliente.tel_contacto1, tbl15_cliente.antperson_alergia_si, tbl15_cliente.antperson_alergia_no, tbl15_cliente.nombre_escolaridad,
tbl15_cliente.antperson_patologico_si, tbl15_cliente.antperson_patologico_no, tbl15_cliente.antperson_quirurgico_si, tbl15_cliente.antperson_quirurgico_no, 
tbl15_cliente.url_img_firma_min AS url_img_firma_min_cli, tbl15_cliente.url_img_firma AS url_img_firma_cli, tbl15_cliente.url_img_foto_min AS url_img_foto_min_cli, 
tbl15_cliente.url_img_foto AS url_img_foto_cli,
tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, 
tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_cliente.fecha_nac_ymd, tbl15_cliente.fecha_nac_time, tbl15_cliente.edad_anyo, tbl15_cliente.nombre_empresa,
tbl15_cliente.nombre_grupo_rh, tbl15_cliente.tel_cliente, tbl15_cliente.correo, tbl15_cliente.direccion, tbl15_cliente.nombre_ciudad, tbl15_cliente.nombre_pais, 
tbl15_cliente.cargo_empresa, tbl15_cliente.area_empresa, tbl15_cliente.ciudad_empresa, tbl15_cliente.direccion_contacto1, tbl15_cliente.direccion_contacto2,
tbl15_cliente.nombre_tipo_regimen, tbl15_cliente.nombre_fondo_pension, tbl15_cliente.nombre_numero_hijos, tbl15_cliente.nombre_arl, tbl15_cliente.lugar_nac, 
tbl15_cliente.lugar_residencia, tbl15_cliente.nombre_estado_civil, tbl15_cliente.nombre_raza, tbl15_cliente.direccion_contacto1, tbl15_cliente.direccion_contacto2, 
tbl15_historia_clinica.estructura_tipo_historia_clinica, tbl15_historia_clinica.nombre_laboratorio, tbl15_historia_clinica.motivo,  tbl15_historia_clinica.fecha_reg_time, 
tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.cuenta, 
tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.nombre_medicamento, tbl15_historia_clinica.descripcion_medicamento, 
tbl15_historia_clinica.nombre_ayuda_diagnostica, tbl15_historia_clinica.descripcion_ayuda_diagnostica 
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE (tbl15_historia_clinica.cod_historia_clinica = '$cod_historia_clinica')";
$resultado_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
$info_historia_clinica = mysqli_fetch_assoc($resultado_historia_clinica);

$cod_entidad = $info_historia_clinica['cod_entidad'];

$sql_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '$cod_entidad'";
$resultado_entidad = mysqli_query($conectar, $sql_entidad);
$info_entidad = mysqli_fetch_assoc($resultado_entidad);

$nombre_entidad = $info_entidad['nombre_entidad'];

$cedula = $info_historia_clinica['cedula'];
$nombres = $info_historia_clinica['nombres'];
$apellido1 = $info_historia_clinica['apellido1'];
$apellido2 = $info_historia_clinica['apellido2'];
$fecha_nac_time = $info_historia_clinica['fecha_nac_time'];
$fecha_nac_ymd = date("Y/m/d", $fecha_nac_time);
$nombre_ocupacion = $info_historia_clinica['nombre_ocupacion'];

$nombres_completos = "Historia Clinica: ".$nombres.' '.$apellido1.' '.$apellido2;

$diferencia_edad = abs($fecha_hoy - $fecha_nac_time);
$edad_anyo = floor($diferencia_edad / (365*60*60*24));
//$edad_anyo = $info_historia_clinica['edad_anyo'];
$nombre_grupo_rh = $info_historia_clinica['nombre_grupo_rh'];
$tel_cliente = $info_historia_clinica['tel_cliente'];

$nombre_tipo_doc = $info_historia_clinica['nombre_tipo_doc'];
$nombre_sexo = $info_historia_clinica['nombre_sexo'];
$nombre_contacto1 = $info_historia_clinica['nombre_contacto1'];
$parentesco_contacto1 = $info_historia_clinica['parentesco_contacto1'];
$tel_contacto1 = $info_historia_clinica['tel_contacto1'];
$antperson_alergia_si = $info_historia_clinica['antperson_alergia_si'];
$antperson_alergia_no = $info_historia_clinica['antperson_alergia_no'];
$antperson_patologico_si = $info_historia_clinica['antperson_patologico_si'];
$antperson_patologico_no = $info_historia_clinica['antperson_patologico_no'];
$antperson_quirurgico_si = $info_historia_clinica['antperson_quirurgico_si'];
$antperson_quirurgico_no = $info_historia_clinica['antperson_quirurgico_no'];
$url_img_firma_min_cli = $info_historia_clinica['url_img_firma_min_cli'];
$url_img_firma_cli = $info_historia_clinica['url_img_firma_cli'];
$url_img_foto_min_cli = $info_historia_clinica['url_img_foto_min_cli'];
$url_img_foto_cli = $info_historia_clinica['url_img_foto_cli'];
$url_img_firma_min = $info_historia_clinica['url_img_firma_min'];
$url_img_firma_orig = $info_historia_clinica['url_img_firma_orig'];
$url_img_foto_min = $info_historia_clinica['url_img_foto_min'];
$url_img_foto_orig = $info_historia_clinica['url_img_foto_orig'];
$estructura_tipo_historia_clinica = $info_historia_clinica['estructura_tipo_historia_clinica'];
$nombre_laboratorio = $info_historia_clinica['nombre_laboratorio'];
$nombre_medicamento = $info_historia_clinica['nombre_medicamento'];
$descripcion_medicamento = $info_historia_clinica['descripcion_medicamento'];
$nombre_ayuda_diagnostica = $info_historia_clinica['nombre_ayuda_diagnostica'];
$descripcion_ayuda_diagnostica = $info_historia_clinica['descripcion_ayuda_diagnostica'];
$nombre_tipo_regimen = $info_historia_clinica['nombre_tipo_regimen'];
$nombre_fondo_pension = $info_historia_clinica['nombre_fondo_pension'];
$nombre_numero_hijos = $info_historia_clinica['nombre_numero_hijos'];
$lugar_residencia = $info_historia_clinica['lugar_residencia'];
$nombre_estado_civil = $info_historia_clinica['nombre_estado_civil'];
$nombre_arl = $info_historia_clinica['nombre_arl'];
$lugar_nac = $info_historia_clinica['lugar_nac'];
$nombre_raza = $info_historia_clinica['nombre_raza'];
$nombre_escolaridad = $info_historia_clinica['nombre_escolaridad'];
$direccion_contacto1 = $info_historia_clinica['direccion_contacto1'];
$direccion_contacto2 = $info_historia_clinica['direccion_contacto2'];
$nombre_empresa = $info_historia_clinica['nombre_empresa'];
$motivo = $info_historia_clinica['motivo'];
$cargo_empresa = $info_historia_clinica['cargo_empresa'];
$area_empresa = $info_historia_clinica['area_empresa'];
$ciudad_empresa = $info_historia_clinica['ciudad_empresa'];
$direccion_contacto1 = $info_historia_clinica['direccion_contacto1'];
$direccion_contacto2 = $info_historia_clinica['direccion_contacto2'];
$fecha_time = $info_historia_clinica['fecha_time'];
$fecha_reg_time = $info_historia_clinica['fecha_reg_time'];
$fecha_ymd = $info_historia_clinica['fecha_ymd'];
$cuenta = $info_historia_clinica['cuenta'];
$fecha_dmy = $info_historia_clinica['fecha_dmy'];
$fecha_reg_time_dmy = date("d/m/Y", $fecha_reg_time);
$fecha_hisroria_clinica = date("Y/m/d", $fecha_time);

include_once('mpdf/mpdf.php');
$margen_izq = '20';
$margen_der = '15';
$margen_inf_encabezado = '20';
$margen_sup_encabezado = '20';
$posicion_sup_encabezado = '3';
$posicion_inf_encabezado = '3';

$titulo_doc_pdf = $nombres_completos;
$autor_doc_pdf = $propietario_nombres_apellidos;
$creador_doc_pdf = $propietario_nombres_apellidos;
$tema_doc_pdf = "Historia Clinica";
$palabras_claves_doc_pdf = $nombres_completos." ".$cedula;

//$mpdf = new mPDF('c','A4');
$mpdf = new mPDF('c','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins


$header = '
<table border="0" style="font-family:Helvetica; font-size:12pt; vertical-align: bottom; color: #000000; width:100%">
<tbody><tr><td><img src="../imagenes/logo_superior_pdf_imprimir.png" /></td></tr></tbody>
</table>
';
$headerE = '
<table border="0" style="font-family:Helvetica; font-size:12pt; vertical-align: bottom; color: #000000; width:100%">
<tbody><tr><td><img src="../imagenes/logo_superior_pdf_imprimir.png" /></td></tr></tbody>
</table>
';
$footer = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' - Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [P. {PAGENO}]</h6></td></tr>
</table>
';
$footerE = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' - Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [P. {PAGENO}]</h6></td></tr>
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

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: 10pt;">
<tbody>
<!--<tr><th>HISTORIA CLINICA No.</th><td align="center">'.$cod_historia_clinica.'</td></tr>-->
<tr><th>FECHA HISTORIA</th><td align="center">'.$fecha_hisroria_clinica.'</td><td align="center">N '.$cod_historia_clinica.'</td></tr>

</tbody>
</table>

<table align="center" border="1" width="100%" style="font-family: Mono; font-size: 10pt;"><thead><tr><th valign="middle"><span style="color:#FF0000">1. DATOS DEL TRABAJADOR</span></th></tr></thead></table>

<table align="center" border="1" cellspacing="0" width="100%"><thead><tr><th valign="middle"><img src="'.$url_img_foto_min_cli.'" width="71px"/></th></tr></thead></table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead><tr><th>NOMBRES Y APELLIDOS</th><th>TIPO IDENTIFICACIÓN</th><th>IDENTIFICACIÓN</th><th>GÉNERO</th><th>EDAD</th></tr></thead>
<tbody><tr>
<td align="center">'.$nombres.' '.$apellido1.' '.$apellido2.'</td>
<td align="center">'.$nombre_tipo_doc.'</td>
<td align="center">'.$cedula.'</td>
<td align="center">'.$nombre_sexo.'</td>
<td align="center">'.$edad_anyo.'</td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead><tr><th>FECHA DE NACIMIENTO</th><th>LUGAR DE NACIMIENTO</th><th>DIRECCIÓN DE RESIDENCIA</th><th>ESTADO CIVIL</th><th>Nº HIJOS</th></tr></thead>
<tbody><tr>
<td align="center">'.$fecha_nac_ymd.'</td>
<td align="center">'.$lugar_nac.'</td>
<td align="center">'.$lugar_residencia.'</td>
<td align="center">'.$nombre_estado_civil.'</td>
<td align="center">'.$nombre_numero_hijos.'</td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead><tr><th>TELÉFONO FIJO O CELULAR</th><th>NIVEL EDUCATIVO</th><th>NOMBRE EPS</th><th>TIPO DE RÉGIMEN</th><th>FONDO DE PENSIONES</th><th>ARL</th></tr></thead>
<tbody><tr>
<td align="center">'.$tel_cliente.'</td>
<td align="center">'.$nombre_escolaridad.'</td>
<td align="center">'.$nombre_entidad.'</td>
<td align="center">'.$nombre_tipo_regimen.'</td>
<td align="center">'.$nombre_fondo_pension.'</td>
<td align="center">'.$nombre_arl.'</td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 10pt;"><thead><tr><th valign="middle">DATOS DE CONTACTO EN CASO DE EMERGENCIA</th></tr></thead></table>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead><tr><th>Nombre</th><th>Dirección</th><th>Parentesco</th><th>Teléfono</th></tr></thead>
<tbody><tr>
<td align="center">'.$nombre_contacto1.'</td>
<td align="center">'.$direccion_contacto1.'</td>
<td align="center">'.$parentesco_contacto1.'</td>
<td align="center">'.$tel_contacto1.'</td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 10pt;"><thead><tr><th valign="middle">1.1. DATOS DE INGRESO</td></tr></thead></table>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead><tr><td><strong>AMOTIVO DE EVALUACIÓN:</strong> '.$motivo.'</td></tr></thead>
<tbody></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 10pt;"><thead><tr><th valign="middle">1.2. DATOS DE LA EMPRESA</td></tr></thead></table>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead><tr><th>Empresa</th><th>Cargo</th><th>Area a Laborar</th><th>Ciudad</th></tr></thead>
<tbody><tr>
<td align="center">'.$nombre_empresa.'</td>
<td align="center">'.$cargo_empresa.'</td>
<td align="center">'.$area_empresa.'</td>
<td align="center">'.$ciudad_empresa.'</td>
</tr></tbody>
</table>
<br>
'.$estructura_tipo_historia_clinica.'
'.$info_legal_emp.'
<br>
<table align="center" border="0" cellspacing="0" style="font-family:mono; font-size:10pt; width:100%">
  <tr>
    <td width="387" valign="top"><p><strong>Medico</strong></p>
    <div><img src="'.$propietario_url_firma_emp.'" height="90px"/></div>
    <div>_________________________________________ </div>
    <p><strong>Firma</strong>
    <br />
    <strong>Reg. Medico</strong>
    <br />
    <strong>Licencia Salud Ocupacional '.$cedula.'</strong> </p></td>
    <td width="387" valign="top"><p><strong>Paciente</strong></p>
    <div><img src="'.$url_img_firma_min_cli.'" height="90px"/></div>
    <div>_________________________________________ </div>
    <p><strong>Firma</strong><br />
    <strong>C.C '.$cedula.'</strong> </p></td>
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
$nombre_archivo = $nombres.'_'.$apellido1.'_'.$apellido2.'_'.$cedula.'_'.$fecha_hoy.'.pdf';
$mpdf->Output();
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