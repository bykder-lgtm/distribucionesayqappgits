<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");

$cod_historia_clinica = intval($_GET['cod_historia_clinica']);
$fecha_hoy = time();

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
$tamano_font_hc_emp                  = $info_empresa_data['tamano_font_hc'];
$tamano_font_aptlab_emp              = $info_empresa_data['tamano_font_aptlab'];
$tamano_font_trabaltu_emp            = $info_empresa_data['tamano_font_trabaltu'];
$tamano_font_manaliment_emp          = $info_empresa_data['tamano_font_manaliment'];
$tamano_font_remision_emp            = $info_empresa_data['tamano_font_remision'];
$tamano_font_factura_emp             = $info_empresa_data['tamano_font_factura'];
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

$sql_historia_clinica = "SELECT tbl15_historia_clinica.cod_historia_clinica, tbl15_cliente.cod_cliente, tbl15_cliente.nombre_tipo_doc, 
tbl15_cliente.nombre_ocupacion, tbl15_cliente.cod_entidad, tbl15_cliente.cedula, tbl15_cliente.nombre_sexo, tbl15_cliente.nombre_contacto1, 
tbl15_cliente.parentesco_contacto1, tbl15_cliente.nombre_escolaridad,
tbl15_cliente.url_img_firma_min AS url_img_firma_min_cli, tbl15_cliente.url_img_firma AS url_img_firma_cli, tbl15_cliente.url_img_foto_min AS url_img_foto_min_cli, 
tbl15_cliente.url_img_foto AS url_img_foto_cli,
tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, 
tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_cliente.fecha_nac_ymd, tbl15_cliente.fecha_nac_time, tbl15_cliente.edad_anyo, tbl15_cliente.nombre_empresa,
tbl15_cliente.nombre_grupo_rh, tbl15_cliente.tel_cliente AS tel_cliente_cli, tbl15_cliente.correo, tbl15_cliente.direccion, tbl15_cliente.nombre_ciudad, tbl15_cliente.nombre_pais, 
tbl15_cliente.cargo_empresa, tbl15_cliente.area_empresa, tbl15_cliente.ciudad_empresa, tbl15_cliente.direccion_contacto1, tbl15_cliente.direccion_contacto2,
tbl15_cliente.nombre_tipo_regimen, tbl15_cliente.nombre_fondo_pension, tbl15_cliente.nombre_numero_hijos, tbl15_cliente.nombre_arl, tbl15_cliente.lugar_nac, 
tbl15_cliente.lugar_residencia, tbl15_cliente.lugar_procedencia, tbl15_cliente.nombre_estado_civil, tbl15_cliente.nombre_raza, tbl15_cliente.direccion_contacto1, tbl15_cliente.direccion_contacto2, 
tbl15_historia_clinica.motivo, tbl15_historia_clinica.dat_ocupa_emp1, tbl15_historia_clinica.dat_ocupa_carg1, tbl15_historia_clinica.dat_ocupa_visu1, 
tbl15_historia_clinica.descripcion_ayuda_diagnostica, tbl15_historia_clinica.nombre_religion, tbl15_historia_clinica.nombre_ocupacion, 
tbl15_historia_clinica.nombre_estado_civil, tbl15_historia_clinica.nombre_escolaridad, tbl15_historia_clinica.nombre_tipo_regimen, tbl15_historia_clinica.nombre_fondo_pension, 
tbl15_historia_clinica.nombre_actividad_ecoemp, tbl15_historia_clinica.nombre_estrato, tbl15_historia_clinica.nombre_numero_hijos, 
tbl15_historia_clinica.nombre_arl, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.cargo_empresa, tbl15_historia_clinica.area_empresa, 
tbl15_historia_clinica.ciudad_empresa, tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.tel_cliente AS tel_cliente_hist, tbl15_historia_clinica.correo, 
tbl15_historia_clinica.cod_entidad, tbl15_historia_clinica.lugar_residencia AS lugar_residencia_hist, tbl15_historia_clinica.nombre_contacto1, tbl15_historia_clinica.tel_contacto1, 
tbl15_historia_clinica.parentesco_contacto1, tbl15_historia_clinica.direccion_contacto1, tbl15_historia_clinica.fecha_mes, tbl15_historia_clinica.fecha_anyo, 
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, tbl15_historia_clinica.fecha_reg_time, 
tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, 
tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, tbl15_historia_clinica.cuenta, tbl15_historia_clinica.cuenta_reg, 
tbl15_historia_clinica.cod_administrador, 
tbl15_historia_clinica.sintoma_covid19,
tbl15_historia_clinica.covid19_fiebre,
tbl15_historia_clinica.covid19_escolofrio,
tbl15_historia_clinica.covid19_cansansio,
tbl15_historia_clinica.covid19_malestar_gral,
tbl15_historia_clinica.covid19_fatiga,
tbl15_historia_clinica.covid19_tos_seca,
tbl15_historia_clinica.covid19_cefaleas,
tbl15_historia_clinica.covid19_congestion_nasal,
tbl15_historia_clinica.covid19_secrecion_nasal,
tbl15_historia_clinica.covid19_dorlor_garganta,
tbl15_historia_clinica.covid19_diarrea,
tbl15_historia_clinica.covid19_dificul_resp,
tbl15_historia_clinica.covid19_inapetencia,
tbl15_historia_clinica.covid19_perdida_olfato,
tbl15_historia_clinica.covid19_perdida_gusto,
tbl15_historia_clinica.covid19_dedos_covid,
tbl15_historia_clinica.covid19_dolor_pecho,
tbl15_historia_clinica.covid19_confusion,
tbl15_historia_clinica.covid19_color_azul_labios
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE (tbl15_historia_clinica.cod_historia_clinica = '$cod_historia_clinica')";
$resultado_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
$info_historia_clinica = mysqli_fetch_assoc($resultado_historia_clinica);

$cod_entidad                         = $info_historia_clinica['cod_entidad'];
$cod_administrador                   = $info_historia_clinica['cod_administrador'];

$sql_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '$cod_entidad'";
$resultado_entidad = mysqli_query($conectar, $sql_entidad);
$info_entidad = mysqli_fetch_assoc($resultado_entidad);

$nombre_entidad                      = $info_entidad['nombre_entidad'];

$sql_profesional = "SELECT nombres, apellidos FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$nombres_prof                        = $info_profesional['nombres'];
$apellidos_prof                      = $info_profesional['apellidos'];

$cedula                              = $info_historia_clinica['cedula'];
$nombres_cli                         = $info_historia_clinica['nombres'];
$apellido1_cli                       = $info_historia_clinica['apellido1'];
$apellido2_cli                       = $info_historia_clinica['apellido2'];
$fecha_nac_time                      = $info_historia_clinica['fecha_nac_time'];
$fecha_nac_ymd                       = date("Y/m/d", $fecha_nac_time);
$nombre_ocupacion                    = $info_historia_clinica['nombre_ocupacion'];

$diferencia_edad                     = abs($fecha_hoy - $fecha_nac_time);
$edad_anyo                           = floor($diferencia_edad / (365*60*60*24));
//$edad_anyo                           = $info_historia_clinica['edad_anyo'];
$nombre_grupo_rh                     = $info_historia_clinica['nombre_grupo_rh'];
$tel_cliente_hist                    = $info_historia_clinica['tel_cliente_hist'];

$nombre_tipo_doc                     = $info_historia_clinica['nombre_tipo_doc'];
$nombre_sexo                         = $info_historia_clinica['nombre_sexo'];
$nombre_contacto1                    = $info_historia_clinica['nombre_contacto1'];
$parentesco_contacto1                = $info_historia_clinica['parentesco_contacto1'];
$tel_contacto1                       = $info_historia_clinica['tel_contacto1'];
$url_img_firma_min_cli               = $info_historia_clinica['url_img_firma_min_cli'];
$url_img_firma_cli                   = $info_historia_clinica['url_img_firma_cli'];
$url_img_foto_min_cli                = $info_historia_clinica['url_img_foto_min_cli'];
$url_img_foto_cli                    = $info_historia_clinica['url_img_foto_cli'];
$url_img_firma_min                   = $info_historia_clinica['url_img_firma_min'];
$url_img_firma_orig                  = $info_historia_clinica['url_img_firma_orig'];
$url_img_foto_min                    = $info_historia_clinica['url_img_foto_min'];
$url_img_foto_orig                   = $info_historia_clinica['url_img_foto_orig'];
$nombre_laboratorio                  = $info_historia_clinica['nombre_laboratorio'];
$nombre_medicamento                  = $info_historia_clinica['nombre_medicamento'];
$nombre_tipo_regimen                 = $info_historia_clinica['nombre_tipo_regimen'];
$nombre_fondo_pension                = $info_historia_clinica['nombre_fondo_pension'];
$nombre_numero_hijos                 = $info_historia_clinica['nombre_numero_hijos'];
$lugar_residencia                    = $info_historia_clinica['lugar_residencia'];
$lugar_residencia_hist               = $info_historia_clinica['lugar_residencia_hist'];
$nombre_estado_civil                 = $info_historia_clinica['nombre_estado_civil'];
$nombre_arl                          = $info_historia_clinica['nombre_arl'];
$lugar_nac                           = $info_historia_clinica['lugar_nac'];
$direccion                           = $info_historia_clinica['direccion'];
$nombre_raza                         = $info_historia_clinica['nombre_raza'];
$nombre_escolaridad                  = $info_historia_clinica['nombre_escolaridad'];
$direccion_contacto1                 = $info_historia_clinica['direccion_contacto1'];
$direccion_contacto2                 = $info_historia_clinica['direccion_contacto2'];
$nombre_empresa                      = $info_historia_clinica['nombre_empresa'];
$cargo_empresa                       = $info_historia_clinica['cargo_empresa'];
$area_empresa                        = $info_historia_clinica['area_empresa'];
$ciudad_empresa                      = $info_historia_clinica['ciudad_empresa'];
$direccion_contacto1                 = $info_historia_clinica['direccion_contacto1'];
$direccion_contacto2                 = $info_historia_clinica['direccion_contacto2'];
$direccion_contacto2                 = $info_historia_clinica['direccion_contacto2'];
$motivo                              = $info_historia_clinica['motivo'];
//$dat_ocupa_emp1                      = $info_historia_clinica['dat_ocupa_emp1'];
$dat_ocupa_emp1                      = $info_historia_clinica['nombre_empresa'];
$nombre_religion = $info_historia_clinica['nombre_religion'];
$nombre_ocupacion = $info_historia_clinica['nombre_ocupacion'];
$nombre_estado_civil = $info_historia_clinica['nombre_estado_civil'];
$nombre_escolaridad = $info_historia_clinica['nombre_escolaridad'];
$nombre_tipo_regimen = $info_historia_clinica['nombre_tipo_regimen'];
$nombre_fondo_pension = $info_historia_clinica['nombre_fondo_pension'];
$nombre_actividad_ecoemp = $info_historia_clinica['nombre_actividad_ecoemp'];
$nombre_estrato = $info_historia_clinica['nombre_estrato'];
$nombre_numero_hijos = $info_historia_clinica['nombre_numero_hijos'];
$nombre_arl = $info_historia_clinica['nombre_arl'];
$nombre_empresa = $info_historia_clinica['nombre_empresa'];
$cargo_empresa = $info_historia_clinica['cargo_empresa'];
$area_empresa = $info_historia_clinica['area_empresa'];
$ciudad_empresa = $info_historia_clinica['ciudad_empresa'];
$nombre_empresa_contratante = $info_historia_clinica['nombre_empresa_contratante'];
$tel_cliente_cli = $info_historia_clinica['tel_cliente_cli'];
$correo = $info_historia_clinica['correo'];
$cod_entidad = $info_historia_clinica['cod_entidad'];
$lugar_procedencia = $info_historia_clinica['lugar_procedencia'];
$nombre_contacto1 = $info_historia_clinica['nombre_contacto1'];
$tel_contacto1 = $info_historia_clinica['tel_contacto1'];
$parentesco_contacto1 = $info_historia_clinica['parentesco_contacto1'];
$direccion_contacto1 = $info_historia_clinica['direccion_contacto1'];
$fecha_mes = $info_historia_clinica['fecha_mes'];
$fecha_anyo = $info_historia_clinica['fecha_anyo'];
$fecha_ymd = $info_historia_clinica['fecha_ymd'];
$fecha_dmy = $info_historia_clinica['fecha_dmy'];
$hora = $info_historia_clinica['hora'];
$fecha_time = $info_historia_clinica['fecha_time'];
$fecha_reg_time = $info_historia_clinica['fecha_reg_time'];
$url_img_firma_min = $info_historia_clinica['url_img_firma_min'];
$url_img_firma_orig = $info_historia_clinica['url_img_firma_orig'];
$url_img_foto_min = $info_historia_clinica['url_img_foto_min'];
$url_img_foto_orig = $info_historia_clinica['url_img_foto_orig'];
$cuenta = $info_historia_clinica['cuenta'];
$cuenta_reg = $info_historia_clinica['cuenta_reg'];

$sintoma_covid19                       = $info_historia_clinica['sintoma_covid19'];
$covid19_fiebre                        = $info_historia_clinica['covid19_fiebre'];
$covid19_escolofrio                    = $info_historia_clinica['covid19_escolofrio'];
$covid19_cansansio                     = $info_historia_clinica['covid19_cansansio'];
$covid19_malestar_gral                 = $info_historia_clinica['covid19_malestar_gral'];
$covid19_fatiga                        = $info_historia_clinica['covid19_fatiga'];
$covid19_tos_seca                      = $info_historia_clinica['covid19_tos_seca'];
$covid19_cefaleas                      = $info_historia_clinica['covid19_cefaleas'];
$covid19_congestion_nasal              = $info_historia_clinica['covid19_congestion_nasal'];
$covid19_secrecion_nasal               = $info_historia_clinica['covid19_secrecion_nasal'];
$covid19_dorlor_garganta               = $info_historia_clinica['covid19_dorlor_garganta'];
$covid19_diarrea                       = $info_historia_clinica['covid19_diarrea'];
$covid19_dificul_resp                  = $info_historia_clinica['covid19_dificul_resp'];
$covid19_inapetencia                   = $info_historia_clinica['covid19_inapetencia'];
$covid19_perdida_olfato                = $info_historia_clinica['covid19_perdida_olfato'];
$covid19_perdida_gusto                 = $info_historia_clinica['covid19_perdida_gusto'];
$covid19_dedos_covid                   = $info_historia_clinica['covid19_dedos_covid'];
$covid19_dolor_pecho                   = $info_historia_clinica['covid19_dolor_pecho'];
$covid19_confusion                     = $info_historia_clinica['covid19_confusion'];
$covid19_color_azul_labios             = $info_historia_clinica['covid19_color_azul_labios'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$fecha_time                          = $info_historia_clinica['fecha_time'];
$fecha_reg_time                      = $info_historia_clinica['fecha_reg_time'];
$fecha_ymd                           = $info_historia_clinica['fecha_ymd'];
$cuenta                              = $info_historia_clinica['cuenta'];
$fecha_ymd_hora                      = date("Y/m/d H:i:s", $fecha_time);
$fecha_dmy                           = $info_historia_clinica['fecha_dmy'];
$fecha_reg_time_dmy                  = date("d/m/Y", $fecha_reg_time);
$fecha_hisroria_clinica              = date("Y/m/d", $fecha_time);
$nombres_completos                   = "COVID 19-".$nombres_cli.' '.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_historia_clinica;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
include_once('mpdf/mpdf.php');
$margen_izq                          = '10';
$margen_der                          = '10';
$margen_inf_encabezado               = '20';
$margen_sup_encabezado               = '30';
$posicion_sup_encabezado             = '5';
$posicion_inf_encabezado             = '20';

$titulo_doc_pdf                      = $nombres_completos;
$autor_doc_pdf                       = $propietario_nombres_apellidos_emp;
$creador_doc_pdf                     = $propietario_nombres_apellidos_emp;
$tema_doc_pdf                        = "COVID 19";
$palabras_claves_doc_pdf             = $nombres_cli.' '.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_historia_clinica;
$cod_historia_clinica_strpad         = str_pad($cod_historia_clinica, 6, "0", STR_PAD_LEFT);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
//$mpdf                                = new mPDF('c','A4');
$mpdf                                = new mPDF('en-GB-x','Legal','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$header = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_hc_emp.'pt; width:100%">
  <tr>
    <td width="25%" rowspan="3" align="center"><img src="../imagenes/logo_superior_gerencia_salud_ocupacional.png" /></td>
    <td width="50%" rowspan="3" align="center">COVID 19</td>
    <td width="25%" align="center"><barcode code="'.$cod_historia_clinica_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr >
    <td align="center">FECHA: '.$fecha_hisroria_clinica.'</td>
  </tr>
  <tr>
    <td align="center">HC: '.$cod_historia_clinica.'</td>
  </tr>
</table>
';
$headerE = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_hc_emp.'pt; width:100%">
  <tr>
    <td width="25%" rowspan="3" align="center"><img src="../imagenes/logo_superior_gerencia_salud_ocupacional.png" /></td>
    <td width="50%" rowspan="3" align="center">COVID 19</td>
    <td width="25%" align="center"><barcode code="'.$cod_historia_clinica_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr >
    <td align="center">FECHA: '.$fecha_hisroria_clinica.'</td>
  </tr>
  <tr>
    <td align="center">HC: '.$cod_historia_clinica.'</td>
  </tr>
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
</style>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>
<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;">
<tbody>

</tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%"><thead><tr><th valign="middle"><span style="color:#FF0000">1. DATOS DEL TRABAJADOR</span></th></tr></thead></table>

<table align="center" border="1" cellspacing="0" width="100%"><thead><tr><th valign="middle"><img src="'.$url_img_foto_min_cli.'" width="71px"/></th></tr></thead></table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<thead><tr>
<th>NOMBRES Y APELLIDOS</th>
<th>TIPO IDENTIFICACIÓN</th>
<th>IDENTIFICACIÓN</th>
<th>GÉNERO</th>
<th>EDAD</th>
</tr></thead>
<tbody><tr>
<td align="center">'.$nombres_cli.' '.$apellido1_cli.'</td>
<td align="center">'.$nombre_tipo_doc.'</td>
<td align="center">'.$cedula.'</td>
<td align="center">'.$nombre_sexo.'</td>
<td align="center">'.$edad_anyo.'</td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;">
<thead><tr>
<th>FECHA DE NACIMIENTO</th>
<th>LUGAR DE NACIMIENTO</th>
<th>DIRECCIÓN DE RESIDENCIA</th>
<th>ESTADO CIVIL</th>
<th>Nº HIJOS</th>
</tr></thead>
<tbody><tr>
<td align="center">'.$fecha_nac_ymd.'</td>
<td align="center">'.$lugar_nac.'</td>
<td align="center">'.$lugar_residencia.' - '.$direccion.'</td>
<td align="center">'.$nombre_estado_civil.'</td>
<td align="center">'.$nombre_numero_hijos.'</td>
</tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<thead><tr>
<th>TELEFONO Y/O CELULAR</th>
<th>NIVEL EDUCATIVO</th>
<th>NOMBRE EPS</th>
<th>TIPO DE RÉGIMEN</th>
<th>FONDO DE PENSIONES</th>
<th>ARL</th>
</tr></thead>
<tbody><tr>
<td align="center">'.$tel_cliente_cli.'</td>
<td align="center">'.$nombre_escolaridad.'</td>
<td align="center">'.$nombre_entidad.'</td>
<td align="center">'.$nombre_tipo_regimen.'</td>
<td align="center">'.$nombre_fondo_pension.'</td>
<td align="center">'.$nombre_arl.'</td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;"><thead><tr><th valign="middle">DATOS DE CONTACTO EN CASO DE EMERGENCIA</th></tr></thead></table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<thead><tr>
<th>NOMBRE</th>
<th>DIRECCIÓN</th>
<th>PARENTESCO</th>
<th>TELÉFONO</th>
</tr></thead>
<tbody><tr>
<td align="center">'.$nombre_contacto1.'</td>
<td align="center">'.$direccion_contacto1.'</td>
<td align="center">'.$parentesco_contacto1.'</td>
<td align="center">'.$tel_contacto1.'</td>
</tr></tbody>
</table>
<br>
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;"><thead><tr><th valign="middle">1.1. DATOS DE INGRESO</td></tr></thead></table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<thead><tr><td align="center"><strong>MOTIVO DE EVALUACIÓN:</strong> '.$motivo.'</td></tr></thead>
<tbody></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;"><thead><tr><th valign="middle">1.2. DATOS DE LA EMPRESA</td></tr></thead></table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
<thead><tr>
<th>EMPRESA CONTRATANTE</th>
<th>EMPRESA A LABORAR</th>
<th>CARGO</th>
<th>AREA A LABORAR</th>
<th>CIUDAD</th>
</tr></thead>
<tbody><tr>
<td align="center">'.$nombre_empresa_contratante.'</td>
<td align="center">'.$nombre_empresa.'</td>
<td align="center">'.$cargo_empresa.'</td>
<td align="center">'.$area_empresa.'</td>
<td align="center">'.$ciudad_empresa.'</td>
</tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
';
$codigoHTML.='
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>EN LOS ULTIMOS 14 DÍAS HA PRESENTADO ESTOS SÍNTOMAS </strong></td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%">
  <tr>
    <td style="text-align:left"><strong>FIEBRE MAYOR A 38 °C</strong></td>
    <td style="text-align:center"><strong>'.$covid19_fiebre.'</strong></td>
    <td style="text-align:left"><strong>ESCALOFRIOS</strong></td>
    <td style="text-align:center"><strong>'.$covid19_escolofrio.'</strong></td>
    <td style="text-align:left"><strong>CANSANCIO</strong></td>
    <td style="text-align:center"><strong>'.$covid19_cansansio.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>MALESTAR GENERAL</strong></td>
    <td style="text-align:center"><strong>'.$covid19_malestar_gral.'</strong></td>
    <td style="text-align:left"><strong>FATIGA</strong></td>
    <td style="text-align:center"><strong>'.$covid19_fatiga.'</strong></td>
    <td style="text-align:left"><strong>TOS SECA O PRODUCTIVA</strong></td>
    <td style="text-align:center"><strong>'.$covid19_tos_seca.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>CEFALEA (DOLOR DE CABEZA)</strong></td>
    <td style="text-align:center"><strong>'.$covid19_cefaleas.'</strong></td>
    <td style="text-align:left"><strong>CONGESTION NASAL</strong></td>
    <td style="text-align:center"><strong>'.$covid19_congestion_nasal.'</strong></td>
    <td style="text-align:left"><strong>RINORREA (ESCURRIMIENTO NASAL)</strong></td>
    <td style="text-align:center"><strong>'.$covid19_secrecion_nasal.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>DOLOR DE GARGANTA</strong></td>
    <td style="text-align:center"><strong>'.$covid19_dorlor_garganta.'</strong></td>
    <td style="text-align:left"><strong>DIARREA</strong></td>
    <td style="text-align:center"><strong>'.$covid19_diarrea.'</strong></td>
    <td style="text-align:left"><strong>DIFICULTAD RESPIRATORIA</strong></td>
    <td style="text-align:center"><strong>'.$covid19_dificul_resp.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>INAPETENCIA</strong></td>
    <td style="text-align:center"><strong>'.$covid19_inapetencia.'</strong></td>
    <td style="text-align:left"><strong>ANOSMIA (PERDIDA DEL OLFATO)</strong></td>
    <td style="text-align:center"><strong>'.$covid19_perdida_olfato.'</strong></td>
    <td style="text-align:left"><strong>DISGEUSIA (PERDIDA EL GUSTO)</strong></td>
    <td style="text-align:center"><strong>'.$covid19_perdida_gusto.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>DEDOS DE COVID(MORETONES EN CUALQUIER SITIO DEL CUERPO</strong></td>
    <td style="text-align:center"><strong>'.$covid19_dedos_covid.'</strong></td>
    <td style="text-align:left"><strong>DOLOR TORÁCICO</strong></td>
    <td style="text-align:center"><strong>'.$covid19_dolor_pecho.'</strong></td>
    <td style="text-align:left"><strong>CONFUSION</strong></td>
    <td style="text-align:center"><strong>'.$covid19_confusion.'</strong></td>
  </tr>
  <tr>
    <td style="text-align:left"><strong>COLORACION AZULADA EN LABIOS O EL ROSTRO</strong></td>
    <td style="text-align:center"><strong>'.$covid19_color_azul_labios.'</strong></td>
    <td style="text-align:left"></td>
    <td style="text-align:center"></td>

    <td style="text-align:left"></td>
    <td style="text-align:center"></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
';

$codigoHTML.='
<table align="center" border="1" cellspacing="0" style="font-family:mono; font-size:10pt; width:100%">
  <tr>
    <td width="387" valign="top"><strong>Medico</strong>
    <div style="text-align:center"><img src="'.$propietario_url_firma_emp.'" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong>'.$nombres_prof.' '.$apellidos_prof.'</strong>
    <br />
    <strong>Reg. Medico '.$reg_medico_emp.'</strong>
    <br />
    <strong>Licencia Salud Ocupacional '.$licencia_emp.'</strong> </td>
    <td width="387" valign="top"><strong>Paciente</strong>
    <div style="text-align:center"><img src="'.$url_img_firma_min_cli.'" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong>'.$nombres_cli.' '.$apellido1_cli.'</strong><br />
    <strong>C.C '.$cedula.'</strong> </td>
  </tr>
</table>
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
$nombre_archivo = 'HC_'.$nombres_cli.'_'.$apellido1_cli.'_'.$nombre_empresa.'_'.$fecha_ymd.'-'.$cedula.'-'.$fecha_hoy.'.pdf';
$mpdf->Output($nombre_archivo, 'I');
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