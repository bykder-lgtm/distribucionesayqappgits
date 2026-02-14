<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");

$cod_remision             = intval($_GET['cod_remision']);
$fecha_hoy                = time();
$fecha_hoy_time           = strtotime(date("Y/m/d"));

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
$nombre_font                           = $info_empresa_data['nombre_font'];
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
$tamano_font_hc_emp                    = $info_empresa_data['tamano_font_hc'];
$tamano_font_aptlab_emp                = $info_empresa_data['tamano_font_aptlab'];
$tamano_font_trabaltu_emp              = $info_empresa_data['tamano_font_trabaltu'];
$tamano_font_manaliment_emp            = $info_empresa_data['tamano_font_manaliment'];
$tamano_font_remision_emp              = $info_empresa_data['tamano_font_remision'];
$tamano_font_factura_emp               = $info_empresa_data['tamano_font_factura'];
$info_histclinic_emp                   = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                   = $info_empresa_data['info_aptlaboral'];
$dia_ini_facturacion_emp               = $info_empresa_data['dia_ini_facturacion'];
$dia_fin_facturacion_emp               = $info_empresa_data['dia_fin_facturacion'];
$smtp_correo_host_emp                  = $info_empresa_data['smtp_correo_host'];
$smtp_correo_auth_emp                  = $info_empresa_data['smtp_correo_auth'];
$smtp_correo_username_emp              = $info_empresa_data['smtp_correo_username'];
$smtp_correo_password_emp              = $info_empresa_data['smtp_correo_password'];
$smtp_correo_secure_emp                = $info_empresa_data['smtp_correo_secure'];
$smtp_correo_port_emp                  = $info_empresa_data['smtp_correo_port'];

$sql_remision = "SELECT tbl15_remision.cod_remision, tbl15_cliente.cod_cliente, tbl15_cliente.nombre_tipo_doc, 
tbl15_remision.cod_grupo_area, tbl15_remision.cod_grupo_area_cargo, tbl15_remision.costo_motivo_consulta, tbl15_remision.cod_factura, tbl15_remision.nombre_ocupacion, 
tbl15_remision.nombre_empresa, tbl15_remision.cargo_empresa, tbl15_remision.area_empresa, tbl15_remision.ciudad_empresa, tbl15_remision.nombre_empresa_contratante,
tbl15_cliente.cod_entidad, tbl15_cliente.cedula, tbl15_cliente.nombre_sexo, tbl15_remision.estructura_remision, tbl15_remision.nombre_tipo_remision, 
tbl15_cliente.parentesco_contacto1, tbl15_cliente.tel_contacto1, tbl15_cliente.antperson_alergia_si, tbl15_cliente.antperson_alergia_no, tbl15_cliente.nombre_escolaridad,
tbl15_cliente.url_img_firma_min AS url_img_firma_min_cli, tbl15_cliente.url_img_firma AS url_img_firma_cli, tbl15_cliente.url_img_foto_min AS url_img_foto_min_cli, 
tbl15_cliente.url_img_foto AS url_img_foto_cli, tbl15_cliente.nombres, tbl15_cliente.apellido1, tbl15_cliente.apellido2, tbl15_cliente.fecha_nac_ymd, tbl15_cliente.fecha_nac_time, 
tbl15_cliente.nombre_grupo_rh, tbl15_cliente.tel_cliente, tbl15_cliente.direccion, tbl15_cliente.nombre_ciudad, tbl15_cliente.nombre_numero_hijos, tbl15_cliente.nombre_estado_civil, 
tbl15_cliente.nombre_tipo_regimen, tbl15_cliente.nombre_fondo_pension, tbl15_cliente.nombre_arl, tbl15_cliente.lugar_nac, 
tbl15_cliente.lugar_residencia, tbl15_remision.motivo, tbl15_remision.fecha_reg_time, 
tbl15_remision.fecha_time, tbl15_remision.fecha_ymd, tbl15_remision.cuenta, 
tbl15_remision.exa_fis_talla, tbl15_remision.exa_fis_peso, tbl15_remision.exa_fis_imc, 
tbl15_remision.exa_fis_interpreimc, tbl15_remision.exa_fis_fresp, tbl15_remision.exa_fis_ta, 
tbl15_remision.exa_fis_fc, tbl15_remision.exa_fis_lateral, tbl15_remision.exa_fis_periabdom, 
tbl15_remision.exa_fis_temperat, tbl15_remision.exa_fis_ojoder_sncorre_vlejan, 
tbl15_remision.exa_fis_ojoder_sncorre_vcerca, tbl15_remision.exa_fis_ojoder_cncorre_vlejan, 
tbl15_remision.exa_fis_ojoder_cncorre_vcerca, tbl15_remision.exa_fis_ojoizq_sncorre_vlejan, 
tbl15_remision.exa_fis_ojoizq_sncorre_vcerca, tbl15_remision.exa_fis_ojoizq_cncorre_vlejan, 
tbl15_remision.exa_fis_ojoizq_cncorre_vcerca, tbl15_remision.exa_fis_ojoamb_sncorre_vlejan, 
tbl15_remision.exa_fis_ojoamb_sncorre_vcerca, tbl15_remision.exa_fis_oojoamb_cncorre_vlejan, 
tbl15_remision.exa_fis_ojoamb_cncorre_vcerca, tbl15_remision.fecha_dmy 
FROM tbl15_cliente RIGHT JOIN tbl15_remision ON tbl15_cliente.cod_cliente = tbl15_remision.cod_cliente 
WHERE (tbl15_remision.cod_remision = '$cod_remision')";
$resultado_remision = mysqli_query($conectar, $sql_remision);
$info_remision = mysqli_fetch_assoc($resultado_remision);

$cod_entidad                           = $info_remision['cod_entidad'];

$sql_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '$cod_entidad'";
$resultado_entidad = mysqli_query($conectar, $sql_entidad);
$info_entidad = mysqli_fetch_assoc($resultado_entidad);

$nombre_entidad                        = $info_entidad['nombre_entidad'];
$cedula                                = $info_remision['cedula'];
$nombres_cli                           = $info_remision['nombres'];
$apellido1_cli                         = $info_remision['apellido1'];
$apellido2_cli                         = $info_remision['apellido2'];

$cod_grupo_area                        = $info_remision['cod_grupo_area'];
$cod_grupo_area_cargo                  = $info_remision['cod_grupo_area_cargo'];
$costo_motivo_consulta                 = $info_remision['costo_motivo_consulta'];
$cod_factura                           = $info_remision['cod_factura'];
$nombre_ocupacion                      = $info_remision['nombre_ocupacion'];
$nombre_empresa                        = $info_remision['nombre_empresa'];
$cargo_empresa                         = $info_remision['cargo_empresa'];
$area_empresa                          = $info_remision['area_empresa'];
$ciudad_empresa                        = $info_remision['ciudad_empresa'];
$nombre_empresa_contratante            = $info_remision['nombre_empresa_contratante'];

$fecha_nac_ymd                         = $info_remision['fecha_nac_ymd'];
$fecha_nac_timedb                      = $info_remision['fecha_nac_time'];
$fecha_nac_time                        = strtotime($fecha_nac_ymd);
$diferencia_edad                       = abs($fecha_hoy_time - $fecha_nac_time);
$edad_anyo                             = floor($diferencia_edad / (365*60*60*24));
$diferencia_edad                       = abs($fecha_hoy - $fecha_nac_time);
$edad_anyo                             = floor($diferencia_edad / (365*60*60*24));

$nombre_grupo_rh                       = $info_remision['nombre_grupo_rh'];
$tel_cliente                           = $info_remision['tel_cliente'];

$nombre_tipo_doc                       = $info_remision['nombre_tipo_doc'];
$nombre_sexo                           = $info_remision['nombre_sexo'];
$url_img_firma_min_cli                 = $info_remision['url_img_firma_min_cli'];
$url_img_firma_cli                     = $info_remision['url_img_firma_cli'];
$url_img_foto_min_cli                  = $info_remision['url_img_foto_min_cli'];
$url_img_foto_cli                      = $info_remision['url_img_foto_cli'];
//$nombre_laboratorio                    = $info_remision['nombre_laboratorio'];
//$nombre_medicamento                    = $info_remision['nombre_medicamento'];
$nombre_tipo_regimen                   = $info_remision['nombre_tipo_regimen'];
$nombre_fondo_pension                  = $info_remision['nombre_fondo_pension'];
$nombre_numero_hijos                   = $info_remision['nombre_numero_hijos'];
$lugar_residencia                      = $info_remision['lugar_residencia'];
$nombre_estado_civil                   = $info_remision['nombre_estado_civil'];
$nombre_arl                            = $info_remision['nombre_arl'];
$lugar_nac                             = $info_remision['lugar_nac'];
//$nombre_raza                           = $info_remision['nombre_raza'];
$nombre_escolaridad                    = $info_remision['nombre_escolaridad'];
$motivo                                = $info_remision['motivo'];
$estructura_remision                   = $info_remision['estructura_remision'];
$nombre_tipo_remision                  = $info_remision['nombre_tipo_remision'];
$exa_fis_talla                         = $info_remision['exa_fis_talla'];
$exa_fis_peso                          = $info_remision['exa_fis_peso'];
$exa_fis_imc                           = $info_remision['exa_fis_imc'];
$exa_fis_interpreimc                   = $info_remision['exa_fis_interpreimc'];
$exa_fis_fresp                         = $info_remision['exa_fis_fresp'];
$exa_fis_ta                            = $info_remision['exa_fis_ta'];
$exa_fis_fc                            = $info_remision['exa_fis_fc'];
$exa_fis_lateral                       = $info_remision['exa_fis_lateral'];
$exa_fis_periabdom                     = $info_remision['exa_fis_periabdom'];
$exa_fis_temperat                      = $info_remision['exa_fis_temperat'];
$exa_fis_ojoder_sncorre_vlejan         = $info_remision['exa_fis_ojoder_sncorre_vlejan'];
$exa_fis_ojoder_sncorre_vcerca         = $info_remision['exa_fis_ojoder_sncorre_vcerca'];
$exa_fis_ojoder_cncorre_vlejan         = $info_remision['exa_fis_ojoder_cncorre_vlejan'];
$exa_fis_ojoder_cncorre_vcerca         = $info_remision['exa_fis_ojoder_cncorre_vcerca'];
$exa_fis_ojoizq_sncorre_vlejan         = $info_remision['exa_fis_ojoizq_sncorre_vlejan'];
$exa_fis_ojoizq_sncorre_vcerca         = $info_remision['exa_fis_ojoizq_sncorre_vcerca'];
$exa_fis_ojoizq_cncorre_vlejan         = $info_remision['exa_fis_ojoizq_cncorre_vlejan'];
$exa_fis_ojoizq_cncorre_vcerca         = $info_remision['exa_fis_ojoizq_cncorre_vcerca'];
$exa_fis_ojoamb_sncorre_vlejan         = $info_remision['exa_fis_ojoamb_sncorre_vlejan'];
$exa_fis_ojoamb_sncorre_vcerca         = $info_remision['exa_fis_ojoamb_sncorre_vcerca'];
$exa_fis_oojoamb_cncorre_vlejan        = $info_remision['exa_fis_oojoamb_cncorre_vlejan'];
$exa_fis_ojoamb_cncorre_vcerca         = $info_remision['exa_fis_ojoamb_cncorre_vcerca'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$fecha_time                            = $info_remision['fecha_time'];
$fecha_reg_time                        = $info_remision['fecha_reg_time'];
$fecha_ymd                             = $info_remision['fecha_ymd'];
$cuenta                                = $info_remision['cuenta'];
$fecha_dmy                             = $info_remision['fecha_dmy'];
$fecha_reg_time_dmy                    = date("d/m/Y", $fecha_reg_time);
$fecha_hisroria_clinica                = date("Y/m/d", $fecha_time);
$nombres_completos                     = "REMISION-".$nombres_cli.'_'.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_remision;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
include_once('mpdf/mpdf.php');

$margen_izq                          = '10';
$margen_der                          = '10';
$margen_inf_encabezado               = '20';
$margen_sup_encabezado               = '5';
$posicion_sup_encabezado             = '5';
$posicion_inf_encabezado             = '20';

$titulo_doc_pdf                      = $nombres_completos;
$autor_doc_pdf                       = $propietario_nombres_apellidos_emp;
$creador_doc_pdf                     = $propietario_nombres_apellidos_emp;
$tema_doc_pdf                        = "REMISION";
$palabras_claves_doc_pdf             = "REMISION ".$nombres_cli.' '.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_remision;
$cod_remision_strpad                 = str_pad($cod_remision, 6, "0", STR_PAD_LEFT);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
//$mpdf = new mPDF('c','A4');
$mpdf                                = new mPDF('c','A4','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$header = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_remision_emp.'pt; width:100%">
  <tr>
    <td width="25%" rowspan="3" align="center"><img src="../imagenes/logo_superior_gerencia_salud_ocupacional.png" /></td>
    <td width="50%" rowspan="3" align="center">REMISIÓN</td>
    <td width="25%" align="center"><barcode code="'.$cod_remision_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr >
    <td align="center">FECHA: '.$fecha_hisroria_clinica.'</td>
  </tr>
  <tr>
    <td align="center">CRM: '.$cod_remision.'</td>
  </tr>
</table>
';
$headerE = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_remision_emp.'pt; width:100%">
  <tr>
    <td width="25%" rowspan="3" align="center"><img src="../imagenes/logo_superior_gerencia_salud_ocupacional.png" /></td>
    <td width="50%" rowspan="3" align="center">REMISIÓN</td>
    <td width="25%" align="center"><barcode code="'.$cod_remision_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr >
    <td align="center">FECHA: '.$fecha_hisroria_clinica.'</td>
  </tr>
  <tr>
    <td align="center">CRM: '.$cod_remision.'</td>
  </tr>
</table>
';
$footer = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 12pt; color: #000000;">
<tr>
<td width="100%" style="text-align: center;">
<h6>'.$direccion_emp.' - Tel&eacute;fonos: '.$telefono_emp.'
<br>
Email: '.$correo_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6>
</td>
</tr>
</table>
';
$footerE = '
<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 12pt; color: #000000;">
<tr>
<td width="100%" style="text-align: center;">
<h6>'.$direccion_emp.' - Tel&eacute;fonos: '.$telefono_emp.'
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
<br>
<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;">
<tbody>
<tr><th>REMISIÓN: '.$nombre_tipo_remision.'</th></tr>
</tbody>
</table>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;">
<tbody>
<!--<tr><th>HISTORIA CLINICA No.</th><td align="center">'.$cod_remision.'</td></tr>-->
<tr><th>FECHA HISTORIA</th><td align="center">'.$fecha_hisroria_clinica.'</td><td align="center">HC - '.$cod_remision.'</td></tr>

</tbody>
</table>

<table align="center" border="1" width="100%" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;"><thead><tr><th valign="middle">1. DATOS DEL TRABAJADOR</th></tr></thead></table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;">
<thead><tr><th>NOMBRES Y APELLIDOS</th><th>TIPO IDENTIFICACIÓN</th><th>IDENTIFICACIÓN</th><th>GÉNERO</th><th>EDAD</th></tr></thead>
<tbody><tr>
<td align="center">'.$nombres_cli.' '.$apellido1_cli.' '.$apellido2_cli.'</td>
<td align="center">'.$nombre_tipo_doc.'</td>
<td align="center">'.$cedula.'</td>
<td align="center">'.$nombre_sexo.'</td>
<td align="center">'.$edad_anyo.'</td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;">
<thead><tr><th>FECHA DE NACIMIENTO</th><th>LUGAR DE NACIMIENTO</th><th>DIRECCIÓN DE RESIDENCIA</th><th>ESTADO CIVIL</th><th>Nº HIJOS</th></tr></thead>
<tbody><tr>
<td align="center">'.$fecha_nac_ymd.'</td>
<td align="center">'.$lugar_nac.'</td>
<td align="center">'.$lugar_residencia.'</td>
<td align="center">'.$nombre_estado_civil.'</td>
<td align="center">'.$nombre_numero_hijos.'</td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;">
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

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;"><thead><tr><th valign="middle">1.1. DATOS DE INGRESO</td></tr></thead></table>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;">
<thead><tr><td><strong>MOTIVO DE EVALUACIÓN:</strong> '.$motivo.'</td></tr></thead>
<tbody></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;"><thead><tr><th valign="middle">1.2. DATOS DE LA EMPRESA</td></tr></thead></table>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;">
<thead><tr><th>Empresa</th><th>Cargo</th><th>Area a Laborar</th><th>Ciudad</th></tr></thead>
<tbody><tr>
<td align="center">'.$nombre_empresa.'</td>
<td align="center">'.$cargo_empresa.'</td>
<td align="center">'.$area_empresa.'</td>
<td align="center">'.$ciudad_empresa.'</td>
</tr></tbody>
</table>

<br>
<table align="center" border="1" width="100%" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;">
<thead><tr><td>'.$estructura_remision.'</td></tr></thead>
<tbody></tbody>
</table>
<br>

<table align="center" border="1" width="100%" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;">
<tbody>
<tr>
<td style="text-align:center"><strong>&nbsp;Talla: (Mts)&nbsp;&nbsp; '.$exa_fis_talla.'</strong></td>
<td style="text-align:center"><strong>PESO: (Kg)&nbsp;&nbsp; '.$exa_fis_peso.'</strong></td>
<td style="text-align:center"><strong>IMC:&nbsp;&nbsp; '.$exa_fis_imc.'</strong></td>
<td style="text-align:center"><strong>INTERPRETACIÓN IMC:&nbsp;&nbsp; '.$exa_fis_interpreimc.'</strong></td>
<td style="text-align:center"><strong>F. Resp: (/Min)&nbsp;&nbsp; '.$exa_fis_fresp.'</strong></td>
</tr>
<tr>
<td style="text-align:center"><strong>TA: (Mm/Hg)&nbsp;&nbsp; '.$exa_fis_ta.'</strong></td>
<td style="text-align:center"><strong>FC: (/Min)'.$exa_fis_fc.'</strong></td>
<td style="text-align:center"><strong>Lateralidad: &nbsp;&nbsp; '.$exa_fis_lateral.'</strong></td>
<td style="text-align:center"><strong>Perímetro Abdominal: (Cm)&nbsp;&nbsp;'.$exa_fis_periabdom.'
<td style="text-align:center"><strong>Temperatura:&nbsp;&nbsp;'.$exa_fis_temperat.'</strong></td>
</tr>
</tbody>
</table>
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" width="100%" style="font-family: Mono; font-size:'.$tamano_font_remision_emp.'pt;">
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
            <td style="text-align:center">'.$exa_fis_ojoder_sncorre_vlejan.'</td>
            <td style="text-align:center">'.$exa_fis_ojoder_sncorre_vcerca.'</td>
            <td style="text-align:center">'.$exa_fis_ojoder_cncorre_vlejan.'</td>
            <td style="text-align:center">'.$exa_fis_ojoder_cncorre_vcerca.'</td>
        </tr>
        <tr>
            <td><strong>OJO IZQUIERDO</strong></td>
            <td style="text-align:center">'.$exa_fis_ojoizq_sncorre_vlejan.'</td>
            <td style="text-align:center">'.$exa_fis_ojoizq_sncorre_vcerca.'</td>
            <td style="text-align:center">'.$exa_fis_ojoizq_cncorre_vlejan.'</td>
            <td style="text-align:center">'.$exa_fis_ojoizq_cncorre_vcerca.'</td>
        </tr>
        <tr>
            <td><strong>AMBOS OJOS</strong></td>
            <td style="text-align:center">'.$exa_fis_ojoamb_sncorre_vlejan.'</td>
            <td style="text-align:center">'.$exa_fis_ojoamb_sncorre_vcerca.'</td>
            <td style="text-align:center">'.$exa_fis_oojoamb_cncorre_vlejan.'</td>
            <td style="text-align:center">'.$exa_fis_ojoamb_cncorre_vcerca.'</td>
        </tr>
    </tbody>
</table>
<br>
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:7pt; width:100%">
  <tr>
    <td><p><strong>FIRMA DEL MÉDICO</strong></p>
    <div><img src="'.$propietario_url_firma_emp.'" height="75px"/></div>
    <div>_________________________________________ </div>
        <p><strong>'.$propietario_nombres_apellidos_emp.'</strong></p></td>

    <td><p><strong>FIRMA DEL PACIENTE</strong></p>
    <div><img src="'.$url_img_firma_min_cli.'" height="75px"/></div>
    <div>_________________________________________ </div>
        <p><strong>'.$nombres_cli.' '.$apellido1_cli.' '.$apellido2_cli.'</strong></p></td>
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
$mpdf->SetTitle($titulo_doc_pdf);
$mpdf->SetAuthor($autor_doc_pdf);
$mpdf->SetCreator($autor_doc_pdf);
$mpdf->SetSubject($tema_doc_pdf);
$mpdf->SetKeywords($palabras_claves_doc_pdf);
$ruta = '../pdfs/';
$nombre_archivo = 'REMISION_'.$nombres_cli.'_'.$apellido1_cli.'_'.$nombre_empresa.'_'.$fecha_ymd.'-'.$cedula.'-'.$fecha_hoy.'.pdf';
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