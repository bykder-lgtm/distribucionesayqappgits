<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");

$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp              = $info_empresa_data['titulo'];
$nombre_emp              = $info_empresa_data['nombre'];
$eslogan_emp             = $info_empresa_data['eslogan'];
$direccion_emp           = $info_empresa_data['direccion'];
$ciudad_emp              = $info_empresa_data['ciudad'];
$pais_emp                = $info_empresa_data['pais'];
$correo_emp              = $info_empresa_data['correo'];
$img_cabecera_emp        = $info_empresa_data['img_cabecera'];
$telefono_emp            = $info_empresa_data['telefono'];
$info_legal_emp          = $info_empresa_data['info_legal'];
$logotipo_emp            = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp     = $info_empresa_data['propietario_nit'];
$nit_empresa_emp         = $info_empresa_data['nit_empresa'];
$cabecera_emp            = $info_empresa_data['cabecera'];
$icono_emp               = $info_empresa_data['icono'];
$desarrollador_emp       = $info_empresa_data['desarrollador'];
$anyo_emp                = $info_empresa_data['anyo'];
$url_pag                 = $info_empresa_data['url_pag'];
$nombre_font_emp         = $info_empresa_data['nombre_font'];
$tamano_font_emp         = $info_empresa_data['tamano_font'];
$res_emp                 = $info_empresa_data['res'];
$res1_emp                = $info_empresa_data['res1'];
$res2_emp                = $info_empresa_data['res2'];
$departamento_emp        = $info_empresa_data['departamento'];
$localidad_emp           = $info_empresa_data['localidad'];
$reg_medico_emp          = $info_empresa_data['reg_medico'];
$regimen_emp             = $info_empresa_data['regimen'];
$version_emp             = $info_empresa_data['version'];
$propietario_url_firma_emp = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp          = $info_empresa_data['fecha_time'];
$licencia_emp            = $info_empresa_data['licencia'];
$info_histclinic_emp     = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp     = $info_empresa_data['info_aptlaboral'];

$fecha_hoy               = time();
$fecha_ymd_hora          = date("Y/m/d H:i:s", $fecha_hoy);
$fecha_reg_time_dmy      = date("d/m/Y", $fecha_hoy);
$fecha_hisroria_clinica  = date("Y/m/d", $fecha_hoy);
$nombres_completos       = "HISTORIA CLINICA";

include_once('mpdf/mpdf.php');
$margen_izq                = '10';
$margen_der                = '10';
$margen_inf_encabezado     = '20';
$margen_sup_encabezado     = '5';
$posicion_sup_encabezado   = '5';
$posicion_inf_encabezado   = '20';

$titulo_doc_pdf             = "HISTORIA CLINICA";
$autor_doc_pdf              = "HISTORIA CLINICA";
$creador_doc_pdf            = "HISTORIA CLINICA";
$tema_doc_pdf               = "HISTORIA CLINICA";
$palabras_claves_doc_pdf    = "HISTORIA CLINICA";
//$mpdf = new mPDF('c','A4');
$mpdf = new mPDF('en-GB-x','Legal','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins


$header = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_emp.'pt; width:100%">
<tbody><tr>
<td><img src="../imagenes/logo_superior_pdf_imprimir.png" /></td>
<td style="text-align:center; width:200px"><strong>[FECHA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]</strong></td>
</tr></tbody>
</table>
';
$headerE = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_emp.'pt; width:100%">
<tbody><tr>
<td><img src="../imagenes/logo_superior_pdf_imprimir.png" /></td>
<td style="text-align:center; width:200px"><strong>[FECHA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;]</strong></td>
</tr></tbody>
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

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size:'.$tamano_font_emp.'pt;">
<tbody>

</tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%"><thead><tr><th valign="middle"><span style="color:#FF0000">1. DATOS DEL TRABAJADOR</span></th></tr></thead></table>

<table align="center" border="1" cellspacing="0" width="100%"><thead><tr><th valign="middle"><img src="../imagenes/firma_paciente_vacia.jpg" width="71px"/></th></tr></thead></table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<thead><tr>
<th>NOMBRES Y APELLIDOS</th>
<th style="text-align:center; width:100px">TIPO IDENTIFICACIÓN</th>
<th>IDENTIFICACIÓN</th>
<th>GÉNERO</th>
<th>EDAD</th>
</tr></thead>
<tbody><tr>
<td align="left">_</td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_emp.'pt;">
<thead><tr>
<th>FECHA DE NACIMIENTO</th>
<th>LUGAR DE NACIMIENTO</th>
<th>DIRECCIÓN DE RESIDENCIA</th>
<th>ESTADO CIVIL</th>
<th>Nº HIJOS</th>
</tr></thead>
<tbody><tr>
<td align="left">_</td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
</tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<thead><tr>
<th style="text-align:center; width:100px">TELEFONO Y/O CELULAR</th>
<th>NIVEL EDUCATIVO</th>
<th>NOMBRE EPS</th>
<th>TIPO DE RÉGIMEN</th>
<th>FONDO DE PENSIONES</th>
<th style="text-align:center; width:100px">ARL</th>
</tr></thead>
<tbody><tr>
<td align="left">_</td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
</tr></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_emp.'pt;"><thead><tr><th valign="middle">DATOS DE CONTACTO EN CASO DE EMERGENCIA</th></tr></thead></table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<thead><tr>
<th>NOMBRE</th>
<th>DIRECCIÓN</th>
<th>PARENTESCO</th>
<th>TELÉFONO</th>
</tr></thead>
<tbody><tr>
<td align="left">_</td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
</tr></tbody>
</table>
<br>
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_emp.'pt;"><thead><tr><th valign="middle">1.1. DATOS DE INGRESO</td></tr></thead></table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<thead><tr><td align="center"><strong>MOTIVO DE EVALUACIÓN:</strong> </td></tr></thead>
<tbody></tbody>
</table>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size:'.$tamano_font_emp.'pt;"><thead><tr><th valign="middle">1.2. DATOS DE LA EMPRESA</td></tr></thead></table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<thead><tr>
<th>EMPRESA CONTRATANTE</th>
<th>EMPRESA A LABORAR</th>
<th style="text-align:center; width:150px">CARGO</th>
<th>AREA A LABORAR</th>
<th style="text-align:center; width:100px">CIUDAD</th>
</tr></thead>
<tbody><tr>
<td align="left">_</td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
</tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">2. DATOS OCUPACIONALES</span></strong></td></tr>
        <tr><td bgcolor="#B6DDE8"><strong>2.1. Historia Laboral</strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center" rowspan="2"><strong>Empresa nombre comercial</strong><br />ACTUAL (1) ANTERIORES (2 Y 3)</td>
            <td style="text-align:center; width:150px" rowspan="2"><strong>Cargo</strong> </td>
            <td style="text-align:center" colspan="8"><strong>Elementos de protección personal</strong></td>
            <td style="text-align:center; width:100px" rowspan="2"><strong>Fecha inicio</strong></td>
            <td style="text-align:center; width:20px" rowspan="2"><strong>Duración (Años)</strong></td>
        </tr>
        <tr>
            <td style="text-align:center"><strong>Visual</strong></td>
            <td style="text-align:center"><strong>Auditivo</strong></td>
            <td style="text-align:center"><strong>Alturas</strong></td>
            <td style="text-align:center"><strong>Respiratorios</strong></td>
            <td style="text-align:center"><strong>Cabeza</strong></td>
            <td style="text-align:center"><strong>Manos</strong></td>
            <td style="text-align:center"><strong>Tronco</strong></td>
            <td style="text-align:center"><strong>Pies</strong></td>
        </tr>
        <tr>
            <td>_</td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
        </tr>
        <tr>
            <td>_</td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
        </tr>
        <tr>
            <td>_</td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
        </tr>
        <tr>
            <td colspan="8"><strong>Observaciones: </strong></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td><strong>2.2. Clasificación de riesgos</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td>&nbsp;</td>
            <td style="text-align:center" colspan="6" bgcolor="#95B3D7"><strong>FÍSICOS</strong></td>
            <td style="text-align:center" colspan="4" bgcolor="#B6DDE8"><strong>QUÍMICOS</strong></td>
            <td style="text-align:center" colspan="6" bgcolor="#C5BE97"><strong>BIOLÓGICO</strong></td>
            <td style="text-align:center" colspan="5" bgcolor="#B2A1C7"><strong>ERGONÓMICOS</strong></td>
            <td style="text-align:center" colspan="5" bgcolor="#E6B9B8"><strong>PSICOSOCIALES</strong></td>
            <td style="text-align:center" colspan="7" bgcolor="#FAC090"><strong>SEGURIDAD</strong></td>
            <td style="text-align:center" colspan="3" bgcolor="#FF6666"><strong>OBSERVACIONES</strong></td>
        </tr>
        <tr>
            <td style="text-align:center; width:150px"><strong>EMPRESA</strong></td>
            <td><img src="../imagenes/img_riesgos/01.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/02.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/03.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/04.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/05.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/06.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/07.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/08.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/09.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/10.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/11.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/12.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/13.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/14.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/15.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/16.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/17.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/18.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/19.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/20.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/21.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/22.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/23.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/24.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/25.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/26.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/27.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/28.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/29.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/30.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/31.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/32.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/33.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/34.jpg" /></td>
            <td><img src="../imagenes/img_riesgos/35.jpg" /></td>
        </tr>
        <tr>
            <td style="text-align:left">_</td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
        </tr>
        <tr>
            <td style="text-align:left">_</td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
        </tr>
        <tr>
            <td style="text-align:left">_</td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong>Antecedentes relacionados de importancia</strong></td></tr>
        <tr><td bgcolor="#B6DDE8"><strong>2.3 Accidente Laboral&nbsp;&nbsp;&nbsp;[ ]</strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center; width:100px"><strong>FECHA</strong></td>
            <td style="text-align:center; width:100px"><strong>EMPRESA</strong></td>
            <td style="text-align:center; width:100px"><strong>CAUSA</strong></td>
            <td style="text-align:center; width:100px"><strong>TIPO DE LESIÓN</strong></td>
            <td style="text-align:center; width:100px"><strong>PARTE AFECTADA</strong></td>
            <td style="text-align:center; width:100px"><strong>DIAS INCAPACIDAD</strong></td>
            <td style="text-align:center; width:100px"><strong>SECUELAS</strong></td>
        </tr>
        <tr>
            <td style="text-align:left;">_</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td style="text-align:left;">_</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong>2.4 Enfermedad Laboral&nbsp;&nbsp;&nbsp;[ ]</strong></td></tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
    	<tr>
        <td><strong>Cual: </strong></td>
        <td><strong>Hace Cuánto: </strong></td>
        <td><strong>Descripción: </strong></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<div style="page-break-after: always"></div>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">3. ANTECEDENTES FAMILIARES/PERSONALES</span></strong></td></tr>
        <tr><td bgcolor="#B6DDE8"><strong>3.1 ANTECEDENTES FAMILIARES</strong></td></tr>
    </tbody>
</table>
<!--
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr><td><strong>No Presenta Antecedentes Familiares&nbsp;&nbsp;&nbsp;[ ]</strong></td></tr>
    </tbody>
</table>
-->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td></td>
            <td style="text-align:center"><strong>Padre</strong></td>
            <td style="text-align:center"><strong>Madre</strong></td>
            <td style="text-align:center"><strong>H/nos</strong></td>
            <td style="text-align:center"><strong>Otros</strong></td>
            <td style="text-align:center"><strong>Cual</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"><strong>Padre</strong></td>
            <td style="text-align:center"><strong>Madre</strong></td>
            <td style="text-align:center"><strong>H/nos</strong></td>
            <td style="text-align:center"><strong>Otros</strong></td>
            <td style="text-align:center"><strong>Cual</strong></td>
            <td style="text-align:center">&nbsp;</td>
            <td style="text-align:center"><strong>Padre</strong></td>
            <td style="text-align:center"><strong>Madre</strong></td>
            <td style="text-align:center"><strong>H/nos</strong></td>
            <td style="text-align:center"><strong>Otros</strong></td>
            <td style="text-align:center"><strong>Cual</strong></td>
        </tr>
        <tr>
            <td><strong>Hipertensión</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
            <td><strong>Cardiopatia</strong><strong> </strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
            <td><strong>Osteomusculares</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Diabetes</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
            <td><strong>Trans. Convulsivo</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
            <td><strong>Artitris</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>ACV o Trombosis</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
            <td><strong>Efermedad Genetica </strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
            <td><strong>Varices</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Tumores Malignos </strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
            <td><strong>Alergias</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
            <td><strong>Asma</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Enfermedad Mental </strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
           <td></td>
            <td><strong>Tuberculosis</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
            <td><strong>Otros</strong></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
    </tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.2 Antecedentes Patológicos</strong></td></tr></tbody>
</table>
<!--
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr><td bgcolor="#B6DDE8"><strong>No Presenta Antecedentes Patológicos&nbsp;&nbsp;&nbsp;[ ]</strong></td></tr>
    </tbody>
</table>
-->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td><strong>Neurologicos</strong></td>
            <td  style="text-align:center; width:20px"></td>
            <td><strong>Pulmonar</strong></td>
            <td  style="text-align:center; width:20px"></td>
            <td><strong>Dermatologico</strong></td>
            <td  style="text-align:center; width:20px"></td>
            <td><strong>Psiquiatrico</strong></td>
            <td  style="text-align:center; width:20px"></td>
            <td><strong>Alergico</strong></td>
            <td  style="text-align:center; width:20px"></td>
        </tr>
        <tr>
            <td><strong>Osteomusculares</strong></td>
            <td  style="text-align:center; width:20px"></td>
            <td><strong>Gastrointestinal</strong></td>
            <td  style="text-align:center; width:20px"></td>
            <td><strong>Hematologico</strong></td>
            <td  style="text-align:center; width:20px"></td>
            <td><strong>Organos de los Sentidos </strong></td>
            <td  style="text-align:center; width:20px"></td>
            <td><strong>Cancer</strong></td>
            <td  style="text-align:center; width:20px"></td>
        </tr>
        <tr>
            <td><strong>Hipertensión</strong></td>
            <td  style="text-align:center; width:20px"></td>
            <td><strong>Genitourinario</strong></td>
            <td  style="text-align:center; width:20px"></td>
            <td><strong>Infeccioso</strong></td>
            <td  style="text-align:center; width:20px"></td>
            <td><strong>Congénito</strong></td>
            <td  style="text-align:center; width:20px"></td>
            <td><strong>Famacologico</strong></td>
            <td  style="text-align:center; width:20px"></td>
        </tr>
        <tr>
            <td><strong>Transfusiones</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Endocrino (Diabetes Tiroides)</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Vasculares</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Autoinmunes</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Convulsiones (Ataques)</strong></td>
            <td style="text-align:center; width:20px"></td>
        </tr>
        <tr>
            <td><strong>Claustrofobia</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Dificultad Al Oler</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Cardiopatia</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Usa Lentes</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Dificultad para Distinguir los Colores</strong></td>
            <td style="text-align:center; width:20px"></td>
        </tr>
        <tr>
            <td><strong>Otros</strong></td>
            <td style="text-align:center; width:20px"></td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.3 Antecedentes para Alturas&nbsp;&nbsp;&nbsp;</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td><strong>Epilepsia</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Otitis media</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Enfermedad de maniere</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Traumas craneales</strong></td>
            <td style="text-align:center; width:20px"></td>
        </tr>
        <tr>
            <td><strong>Tumores cerebrales</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Malformaciones cerebrales</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Trombosis (ACV)</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Hipoacusia</strong></td>
            <td style="text-align:center; width:20px"></td>         
        </tr>
        <tr>
            <td><strong>Arritmia cardíaca</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Hipoglicemias</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>Fobias</strong></td>
            <td style="text-align:center; width:20px"></td>                        
        </tr>
            </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.4 Antecedentes Traumáticos &nbsp;&nbsp;&nbsp;[ ]</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td  style="text-align:center; width:100px"><strong>Enfermedad</strong></td>
            <td  style="text-align:center; width:100px"><strong>Observaciones</strong></td>
            <td  style="text-align:center; width:100px"><strong>Fecha Aproximada</strong></td>
        </tr>
        <tr>
            <td style="text-align:left;">_</td>
            <td></td>
            <td style="text-align:center"></td>
        </tr>
        <tr>
            <td style="text-align:left;">_</td>
            <td></td>
            <td style="text-align:center"></td>
        </tr>
        <tr>
            <td style="text-align:left;">_</td>
            <td></td>
            <td style="text-align:center"></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.5 Antecedentes Quirúrgicos&nbsp;&nbsp;&nbsp;[ ]</strong></td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td  style="text-align:center; width:100px"><strong>Enfermedad</strong></td>
            <td  style="text-align:center; width:100px"><strong>Observaciones</strong></td>
            <td  style="text-align:center; width:100px"><strong>Fecha Aproximada</strong></td>
        </tr>
        <tr>
            <td style="text-align:left;">_</td>
            <td></td>
            <td style="text-align:center"></td>
        </tr>
        <tr>
            <td style="text-align:left;">_</td>
            <td></td>
            <td style="text-align:center"></td>
        </tr>
        <tr>
            <td style="text-align:left;">_</td>
            <td></td>
            <td style="text-align:center"></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>3.6 Antecedentes - Inmunizaciones (Presenta Vacunas:&nbsp;&nbsp;&nbsp;[ ])</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Vacuna</strong></td>
            <td></td>
            <td style="text-align:center"><strong>Año Aplicación</strong></td>
            <td style="text-align:center"><strong>Vacuna</strong></td>
            <td></td>
            <td style="text-align:center"><strong>Año Aplicación</strong></td>
        </tr>
        <tr>
            <td><strong>TETANO</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>FIEBRE TIFOIDEA</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td style="text-align:center; width:20px"></td>
        </tr>
        <tr>
            <td><strong>HEPATITIS A</strong></td>
            <td style="text-align:center; width:20px"></td>
           <td style="text-align:center; width:20px"></td>>
            <td><strong>INFLUENZA</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td style="text-align:center; width:20px"></td>
        </tr>
        <tr>
            <td><strong>HEPATITIS B </strong></td>
            <td style="text-align:center; width:20px"></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>SARAMPION</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td style="text-align:center; width:20px"></td>
        </tr>
        <tr>
            <td><strong>FIEBRE AMARILLA</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td style="text-align:center; width:20px"></td>
            <td><strong>OTRA</strong></td>
            <td style="text-align:center; width:20px"></td>
            <td style="text-align:center; width:20px"></td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090">3.7 <strong>Antecedentes Ginecologicos</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Primera Mestruación </strong></td>
            <td style="text-align:center"><strong>Años</strong></td>
            <td style="text-align:center"><strong>Ciclo</strong></td>
            <td style="text-align:center"><strong>FUM</strong></td>
            <td style="text-align:center"><strong>FUP</strong></td>
            <td style="text-align:center"><strong>FUC</strong></td>
            <td style="text-align:center" colspan="7" width="30%"><strong>FICHAS GINECOBSTETRICA</strong></td>
            <td style="text-align:center"><strong>Fecha Ultimo Examen de Mama</strong></td>
        </tr>
        <tr>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center"></td>
            <td style="text-align:center; width:60px">G- </td>
            <td style="text-align:center; width:60px">P- </td>
            <td style="text-align:center; width:60px">A- </td>
            <td style="text-align:center; width:60px">C- </td>
            <td style="text-align:center; width:60px">M- </td>
            <td style="text-align:center; width:60px">E- </td>
            <td style="text-align:center; width:60px">V- </td>
            <td style="text-align:center"></td>
        </tr>
    </tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td><strong>Planificaciones: </strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td><strong>Observaciones: </strong></td></tr></tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<tbody>
<tr><td colspan="9" bgcolor="#FAC090"><strong>3.8 Hábitos Personales </strong></td></tr>
<tr>
<td style="text-align:left; width:10px" colspan="2"><strong>Tabaquismo:&nbsp;</strong></td>
<td style="text-align:left; width:10px" colspan="3"><strong>No. Cigarrillos al día:</strong></td>
<td style="text-align:left; width:100px" colspan="2"><strong>Total Años fumando: </strong></td>
<td style="text-align:left; width:200px" colspan="2"><strong>Tiempo sin fumar:</strong></td>
</tr>
<tr>
<td colspan="3"><strong>Consumo de Alcohol:&nbsp;</strong>
<br>
<strong>Toxicomanías:&nbsp;</strong></td>
<td colspan="6"><strong>Actividad Extralaboral:</strong></td>
</tr>
<tr>
<td style="text-align:left; width:50px"colspan="3"><strong>Actividad física:&nbsp;</strong></td>
<td style="text-align:left; width:200px" colspan="2"><strong>Actividad: </strong></td>
<td style="text-align:left; width:200px" colspan="2"><strong>Frecuencia: </strong></td>
<td colspan="2"><strong>Tiempo: </strong></td>
</tr>
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<div style="page-break-after: always"></div>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">4. REVISIÓN POR SISTEMAS</span></strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>Síntomas</strong></td>
            <td style="text-align:center"><strong>Refiere</strong></td>
            <td style="text-align:center"><strong>Observaciones</strong></td>
        </tr>
        <tr>
            <td><strong>Órgano de los Sentidos </strong></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Neurológicos</strong></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Respiratorios</strong></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Gastrointestinales</strong></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Genitourinarios</strong></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Osteomuscular</strong></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Dermatológicos</strong></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Cardiovasculares</strong></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Constitucionales</strong></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Metabolico y Endocrino</strong></td>
            <td style="text-align:center"></td>
            <td></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">5. EVALUACIÓN DEL ESTADO MENTAL</span></strong></td></tr></tbody>
</table>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td style="text-align:center"><strong>PROCESOS</strong></td>
            <td style="text-align:center"><strong>NORMAL</strong></td>
            <td style="text-align:center"><strong>DISFUNCIÓN</strong></td>
            <td style="text-align:center"><strong>HALLAZGO</strong></td>
        </tr>
        <tr>
            <td><strong>ORIENTACIÓN</strong></td>
            <td style="text-align:center"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
            <strong>ATENCIÓN CONCENTRACIÓN</strong></td>
            <td style="text-align:center"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>SENSOPERCEPCIÓN</strong></td>
            <td style="text-align:center"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>MEMORIA</strong></td>
            <td style="text-align:center"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>PENSAMIENTO</strong></td>
            <td style="text-align:center"></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>LENGUAJE</strong></td>
            <td style="text-align:center"></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
        <tr>
            <td><strong>CONCEPTO:&nbsp;&nbsp;&nbsp;</strong></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">6. EXAMEN FÍSICO</span></strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<tbody>
<tr>
<td><strong>&nbsp;Talla: &nbsp;&nbsp; (Mts)</strong></td>
<td><strong>PESO: &nbsp;&nbsp; (Kg)</strong></td>
<td><strong>IMC:</strong></td>
<td><strong>INTERPRETACIÓN IMC:</strong></td>
<td><strong>F. Resp: &nbsp;&nbsp; (/Min)</strong></td>
</tr>
<tr>
<td><strong>TA: &nbsp;&nbsp; (Mm/Hg)</strong></td>
<td><strong>FC:&nbsp;&nbsp;  (/Min)</strong></td>
<td><strong>Lateralidad:&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
<td><strong>Perímetro Abdominal: &nbsp;&nbsp; (Cm)</strong></td>
<td><strong>Temperatura:&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
</tr>
</tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td><strong>CONCEPTO &nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>EXAMEN FÍSICO N(Normal) &ndash; A(Anormal) &ndash; NE(No examinado)</strong></td></tr></tbody>
</table>
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
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<tbody>
<tr>
<td><strong>OJOS</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>OIDOS</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>CABEZA</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>NARIZ</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>OROFARINGE</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>CUELLO</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>TÓRAX</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>SISTEMA MUSCULO ESQUELÉTICO</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td ><strong>GLÁNDULAS MAMARIAS</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>CARDIOPULMONAR</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>ABDOMEN</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td ><strong>GENITALES</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>MIEMBROS SUPERIORES</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>MIEMBROS INFERIORES</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>COLUMNA</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>NEUROLÓGICO</strong><strong> (PRUEBAS DE EQUILIBRIO)</strong>
<br>
<strong>(Equilibrio Estático)</strong><br>
Prueba de Romberg <strong>[ ]</strong>
<br>Prueba de Barany <strong>[ ]</strong>
<br>Maniobra de Dix Halpike <strong>[ ]</strong>
<br><strong>(Equilibrio Dinamico)</strong>
<br>Marcha a Ciegas <strong>[ ]</strong>
<br>Pisoteo a Ciegas <strong>[ ]</strong>
</td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>ESTADO MENTAL APARENTE</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
<tr>
<td><strong>PIEL Y FANERAS</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
</tr>
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<div style="page-break-after: always"></div>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<tbody><tr><td bgcolor="#FAC090"><strong><span style="color:#FF0000">7. EXAMEN OSTEOMUSCULAR </span></strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<tbody>
<tr>
<td><strong>Maniobra semiológicas</strong></td>
<td colspan="2"><strong>Interpretación</strong></td>
<td><strong>&nbsp;</strong></td>
<td style="text-align:center" colspan="2"><strong>Movilidad Articular</strong></td>
<td colspan="3"><strong>Fuerza</strong></td>
</tr>
<tr>
<td colspan="3"><strong>Hombro</strong></td>
<td><strong>MMSS</strong></td>
<td style="text-align:center" colspan="2"></td>
<td style="text-align:center" colspan="3"></td>
</tr>
<tr>
<td><strong>Maniobra Jobe</strong></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
<td><strong>MMII</strong></td>
<td style="text-align:center" colspan="2"></td>
<td style="text-align:center" colspan="3"></td>
</tr>
<tr>
<td><strong>Maniobra de Yergason</strong></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
<td><strong>Columna</strong></td>
<td style="text-align:center" colspan="2"></td>
<td style="text-align:center" colspan="3"></td>
</tr>
<tr>
<td><strong>Maniobra de Patte</strong></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
<td><strong>&nbsp;</strong></td>
<td style="text-align:center" colspan="2"><strong>&nbsp;</strong></td>
<td style="text-align:center" colspan="3"><strong>&nbsp;</strong></td>
</tr>
<tr>
<td style="text-align:center" colspan="3"><strong>Codo</strong></td>
<td style="text-align:center" colspan="6"><strong>Mu&ntilde;eca</strong></td>
</tr>
<tr>
<td><strong>Prueba de Epicondilitis</strong></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
<td colspan="2"><strong>Phalen</strong></td>
<td style="text-align:center" colspan="2"></td>
<td style="text-align:center" colspan="2"></td>
</tr>
<tr>
<td><strong>Prueba de Epitrocleitis</strong></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
<td colspan="2"><strong>Finkelstein</strong></td>
<td style="text-align:center" colspan="2"></td>
<td style="text-align:center" colspan="2"></td>
</tr>
<tr>
<td><strong>Prueba de Thompson</strong></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
<td colspan="2"><strong>Tinel</strong></td>
<td style="text-align:center" colspan="2"></td>
<td style="text-align:center" colspan="2"></td>
</tr>
<tr>
<td style="text-align:center" colspan="3"><strong>Lumbar</strong></td>
<td style="text-align:center" colspan="6"><strong>Miembro Inferior</strong></td>
</tr>
<tr>
<td><strong>Signo de Lasegue</strong></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center">&nbsp;</td>
<td colspan="2"><strong>Signo del Cajón</strong></td>
<td style="text-align:center" colspan="2"></td>
<td style="text-align:center" colspan="2"></td>
</tr>
<tr>
<td><strong>Signo de Schober Flexión</strong></td>
<td style="text-align:center; width:100px"></td>
<td><strong>Cm</strong></td>
<td colspan="2"><strong>Signo del Bostezo</strong></td>
<td style="text-align:center" colspan="2"></td>
<td style="text-align:center" colspan="2"></td>
</tr>
<tr>
<td><strong>Signo de Schober </strong> <strong>Extensión</strong></td>
<td style="text-align:center; width:100px"></td>
<td><strong>Grados</strong></td>
<td colspan="2"><strong>Mc Murray</strong></td>
<td style="text-align:center" colspan="2"></td>
<td style="text-align:center" colspan="2"></td>
</tr>
<tr>
<td><strong>Signo de Bragard</strong></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
</tr>
<tr>
<td colspan="3"><strong>Cadera</strong></td>
<td colspan="6"><strong>&nbsp;</strong></td>
</tr>
<tr>
<td><strong>Trendelemburg</strong></td>
<td style="text-align:center; width:100px"></td>
<td></td>
<td colspan="6"></td>
</tr>
<tr><td colspan="9"><strong>Valoración de la Marcha: </strong></td></tr>
<tr><td colspan="9"><strong>Observaciones Generales: </strong></td></tr>
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<tbody>
<tr>
<td colspan="3" bgcolor="#FAC090"><span style="color:#FF0000"><strong>8. PARACLÍNICOS Y VALORACIONES COMPLEMENTARIAS <em>N(Normal) &ndash; A(Anormal) &ndash; NR(No Realizado)</em></strong></span></td>
</tr>
<tr>
<td style="text-align:center"><strong>Grupo</strong></td>
<td style="text-align:center; width:10px"><strong>Valores</strong></td>
<td style="text-align:center"><strong>Observaciones</strong></td>
</tr>
<tr>
<td><strong>Audiometría</strong></td>
<td style="text-align:center"><strong></strong></td>
<td></td>
</tr>
<tr>
<td><strong>Visiometría / Optometría</strong></td>
<td style="text-align:center"><strong></strong></td>
<td></td>
</tr>
<tr>
<td><strong>Rx de Tórax </strong></td>
<td style="text-align:center"><strong></strong></td>
<td></td>
</tr>
<tr>
<td><strong>Espirometría</strong></td>
<td style="text-align:center"><strong></strong></td>
<td></td>
</tr>
<tr>
<td><strong>EKG</strong></td>
<td style="text-align:center"><strong></strong></td>
<td></td>
</tr>
<tr>
<td><strong>Rx de Columna</strong></td>
<td style="text-align:center"><strong></strong></td>
<td></td>
</tr>
<tr>
<td><strong>Otras pruebas complementarias</strong></td>
<td style="text-align:center"><strong></strong></td>
<td></td>
</tr>
<tr>
<td><strong>Examen por Fisioterapia</strong></td>
<td style="text-align:center"><strong></strong></td>
<td></td>
</tr>
<tr>
<td><strong>Laboratorios</strong></td>
<td style="text-align:center"><strong></strong></td>
<td></td>
</tr>
<tr>
<td><strong>Otros</strong></td>
<td style="text-align:center"><strong></strong></td>
<td><strong>Cuales: </strong> </td>
</tr>
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
<thead>
<tr>
<td style="text-align:center"><strong>CIE 10</strong></td>
<td style="text-align:center"><strong>Diágnostico</strong></td>
<td style="text-align:center"><strong>Impresión Diagnostica</strong></td>
<td style="text-align:center"><strong>Confirmado Nuevo</strong></td>
<td style="text-align:center"><strong>Confirmado Repetido</strong></td>
<td style="text-align:center"><strong>DIÁGNOSTICO PRINCIPAL</strong></td>
</tr>
</thead>
<tbody>
<tr>
<td>_</td>
<td></td>
<td style="text-align:center"></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
</tr>
<tr>
<td>_</td>
<td></td>
<td style="text-align:center"></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
</tr>
<tr>
<td>_</td>
<td></td>
<td style="text-align:center"></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
<td style="text-align:center; width:100px"></td>
</tr>
</tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody><tr><td bgcolor="#FAC090"><strong>CONTROL</strong></td></tr></tbody>
</table>
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_emp.'pt; width:100%">
    <tbody>
    	<tr>
    		<td style="text-align:justify">_</td>
    	</tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="justify" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:7pt; width:100%">
    <tbody>
    	<tr>
    		<td style="text-align:justify">'.$info_histclinic_emp.'</td>
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
$nombre_archivo = 'HC.pdf';
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