<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_else = addslashes($_POST['pagina']);
include_once('../admin/funcion_eliminar_acentos.php');
include_once('../admin/class_php/fecha_en_espanol_dia_mes_anyo.php');

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	if (isset($_POST['nombre_propietario_mascota']) <> '') { $nombre_propietario_mascota = addslashes($_POST['nombre_propietario_mascota']); } else { $nombre_propietario_mascota = ''; }
	if (isset($_POST['documento_propietario_mascota']) <> '') { $documento_propietario_mascota = addslashes($_POST['documento_propietario_mascota']); } else { $documento_propietario_mascota = ''; }
	if (isset($_POST['direccion_propietario_mascota']) <> '') { $direccion_propietario_mascota = addslashes($_POST['direccion_propietario_mascota']); } else { $direccion_propietario_mascota = ''; }
	if (isset($_POST['correo_propietario_mascota']) <> '') { $correo_propietario_mascota = addslashes($_POST['correo_propietario_mascota']); } else { $correo_propietario_mascota = ''; }
	if (isset($_POST['nombre_mascota']) <> '') { $nombre_mascota = addslashes($_POST['nombre_mascota']); } else { $nombre_mascota = ''; }
	if (isset($_POST['edad_mascota']) <> '') { $edad_mascota = addslashes($_POST['edad_mascota']); } else { $edad_mascota = ''; }
	if (isset($_POST['nombre_raza_mascota']) <> '') { $nombre_raza_mascota = addslashes($_POST['nombre_raza_mascota']); } else { $nombre_raza_mascota = ''; }
	if (isset($_POST['color_mascota']) <> '') { $color_mascota = addslashes($_POST['color_mascota']); } else { $color_mascota = ''; }
	if (isset($_POST['peso_mascota']) <> '') { $peso_mascota = addslashes($_POST['peso_mascota']); } else { $peso_mascota = ''; }
	if (isset($_POST['talla_mascota']) <> '') { $talla_mascota = addslashes($_POST['talla_mascota']); } else { $talla_mascota = ''; }
	if (isset($_POST['fecha_certificado_apoyo_emocional']) <> '') { $fecha_certificado_apoyo_emocional = addslashes($_POST['fecha_certificado_apoyo_emocional']); } else { $fecha_certificado_apoyo_emocional = date("Y-m-d"); }
	/* ----------------------------------------------------------------------------------------------------------/ */
	$nombre_profesional                                                = "JEAN PAULINA PLAZA VIELLARD";
	$documento_profesional                                             = "50760399";
	$tarjeta_profesional                                               = "113935";
	$hora_certificado_apoyo_emocional                                  = date("H:i:s");
	$fecha_creacion_certificado_apoyo_emocional                        = date("Y-m-d H:i:s");
	$nombre_propietario_mascota                                        = mb_convert_case($nombre_propietario_mascota, MB_CASE_TITLE, "UTF-8");

	$fecha_dia_texto                                                   = fecha_en_espanol_dia(strtotime($fecha_certificado_apoyo_emocional));
	$fecha_mes_texto                                                   = fecha_en_espanol_mes(strtotime($fecha_certificado_apoyo_emocional));
	$fecha_anyo_texto                                                  = fecha_en_espanol_anyo(strtotime($fecha_certificado_apoyo_emocional));
	$fecha_mes_ingles_texto                                            = fecha_en_ingles_mes(strtotime($fecha_certificado_apoyo_emocional));

	$estructura_titulo_certificado_apoyo_emocional_esp                 = '';
	$estructura_titulo_certificado_apoyo_emocional_esp                .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family: calibri; font-size: 13pt;">';
	$estructura_titulo_certificado_apoyo_emocional_esp                .= '  <tbody>';
	$estructura_titulo_certificado_apoyo_emocional_esp                .= '  <tr>';
	$estructura_titulo_certificado_apoyo_emocional_esp                .= '    <td style="text-align: center;"><strong>CERTIFICADO DE APOYO EMOCIONAL <br> A QUIEN PUEDA INTERESAR</strong></td>';
	$estructura_titulo_certificado_apoyo_emocional_esp                .= '  </tr>';
	$estructura_titulo_certificado_apoyo_emocional_esp                .= '  </tbody>';
	$estructura_titulo_certificado_apoyo_emocional_esp                .= '</table>';

	$estructura_profesional_certificado_apoyo_emocional_esp            = '';
	$estructura_profesional_certificado_apoyo_emocional_esp           .= '<table cellpadding="0" cellspacing="0" width="100%" style="font-family: calibri; font-size: 10pt;">';
	$estructura_profesional_certificado_apoyo_emocional_esp           .= '  <tbody>';
	$estructura_profesional_certificado_apoyo_emocional_esp           .= '  <tr>';
	$estructura_profesional_certificado_apoyo_emocional_esp           .= '    <td style="text-align: justify;">Yo, <strong>'.$nombre_profesional.'</strong>, con CC. '.number_format($documento_profesional, 0, ",", ".").', de San Pelayo - Córdoba, Psicóloga de profesión con tarjeta profesional N .'.$tarjeta_profesional.' acreditada por COLPSIC.</td>';
	$estructura_profesional_certificado_apoyo_emocional_esp           .= '  </tr>';
	$estructura_profesional_certificado_apoyo_emocional_esp           .= '  </tbody>';
	$estructura_profesional_certificado_apoyo_emocional_esp           .= '</table>';

	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp  = '';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family: calibri; font-size: 13pt;">';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '  <tbody>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '  <tr>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '    <td style="text-align: center;"><strong>CERTIFICO</strong></td>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '  </tr>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '  </tbody>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '</table>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '<table cellpadding="0" cellspacing="0" width="100%" style="font-family: calibri; font-size: 10pt;">';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '  <tbody>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '  <tr>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '    <td style="text-align: justify;">Que la señora <strong>'.$nombre_propietario_mascota.'. con CC. '.number_format($documento_propietario_mascota, 0, ",", ".").'</strong>, Con dirección '.$direccion_propietario_mascota.', la cual asistió a sesión de atención psicológica, en dicha evaluación se evidencio que la paciente presenta el siguiente diagnóstico: F41.2 Trastorno Mixto Ansioso-Depresivo, con episodio depresivo presente, razón por la cual se ha prescrito como parte de su tratamiento psicológico, la presencia de su mascota como apoyo emocional: El animal debe acompañar a la  paciente: En un portador en la cabina de la aeronave durante el viaje, dentro o fuera  de un portador en la cabina de la aeronave durante el viaje. Ya que, el animal se usará para acomodar la discapacidad relacionada a la salud mental de la paciente; así mismo podrá estar en las mismas condiciones con la mascota de apoyo emocional en establecimientos comerciales, metro, transporte público, hoteles  u otros.</td>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '  </tr>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '  </tbody>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp .= '</table>';

	$estructura_justificacion_certificado_apoyo_emocional_esp          = '';
	$estructura_justificacion_certificado_apoyo_emocional_esp         .= '<table cellpadding="0" cellspacing="0" width="100%" style="font-family: calibri; font-size: 10pt;">';
	$estructura_justificacion_certificado_apoyo_emocional_esp         .= '  <tbody>';
	$estructura_justificacion_certificado_apoyo_emocional_esp         .= '  <tr>';
	$estructura_justificacion_certificado_apoyo_emocional_esp         .= '    <td style="text-align: justify;">Por lo tanto, el paciente mantiene un apego emocional con su mascota; ya que esta le genera estabilidad emocional y psicológica, puesto que desde hace '.$edad_mascota.' años ha tenido episodios depresivos y de ansiedad, por lo cual decidió adoptarlo y desde que está en compañía de su mascota ha mejorado su situación emocional.</td>';
	$estructura_justificacion_certificado_apoyo_emocional_esp         .= '  </tr>';
	$estructura_justificacion_certificado_apoyo_emocional_esp         .= '  </tbody>';
	$estructura_justificacion_certificado_apoyo_emocional_esp         .= '</table>';
	$estructura_justificacion_certificado_apoyo_emocional_esp         .= '';

	$estructura_tabla_mascota_certificado_apoyo_emocional_esp          = '';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '<table border="1" cellpadding="10" cellspacing="0" width="100%" style="font-family: calibri; font-size: 10pt;">';
	$estructura_justificacion_certificado_apoyo_emocional_esp         .= '  <tbody>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '  <tr>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '    <td style="background-color:#80C6E1; text-align:center">NOMBRE</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '    <td style="background-color:#80C6E1; text-align:center">EDAD</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '    <td style="background-color:#80C6E1; text-align:center">RAZA</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '    <td style="background-color:#80C6E1; text-align:center">COLOR</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '    <td style="background-color:#80C6E1; text-align:center">PESO </td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '    <td style="background-color:#80C6E1; text-align:center">TALLA</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '  </tr>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '  <tr>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '    <td style="text-align:center">'.$nombre_mascota.'</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '    <td style="text-align:center">'.$edad_mascota.' AÑOS</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '    <td style="text-align:center">'.$nombre_raza_mascota.'</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '    <td style="text-align:center">'.$color_mascota.'</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '    <td style="text-align:center">'.$peso_mascota.' KILOS </td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '    <td style="text-align:center">'.$talla_mascota.'</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '  </tr>';
	$estructura_justificacion_certificado_apoyo_emocional_esp         .= '  </tbody>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_esp         .= '</table>';

	$estructura_vigencia_certificado_apoyo_emocional_esp               = '';
	$estructura_vigencia_certificado_apoyo_emocional_esp              .= '<table cellpadding="0" cellspacing="0" width="100%" style="font-family: calibri; font-size: 10pt;">';
	$estructura_vigencia_certificado_apoyo_emocional_esp              .= '  <tbody>';
	$estructura_vigencia_certificado_apoyo_emocional_esp              .= '  <tr>';
	$estructura_vigencia_certificado_apoyo_emocional_esp              .= '    <td style="text-align: justify;">El presente certificado tiene una vigencia de un año a partir de su fecha de expedición; dada en '.$fecha_mes_texto.' a los '.$fecha_dia_texto.' días del '.$fecha_anyo_texto.'.</td>';
	$estructura_vigencia_certificado_apoyo_emocional_esp              .= '  </tr>';
	$estructura_vigencia_certificado_apoyo_emocional_esp              .= '  </tbody>';
	$estructura_vigencia_certificado_apoyo_emocional_esp              .= '</table>';


	$estructura_titulo_certificado_apoyo_emocional_eng                 = '';
	$estructura_titulo_certificado_apoyo_emocional_eng                .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family: calibri; font-size: 13pt;">';
	$estructura_titulo_certificado_apoyo_emocional_eng                .= '  <tbody>';
	$estructura_titulo_certificado_apoyo_emocional_eng                .= '  <tr>';
	$estructura_titulo_certificado_apoyo_emocional_eng                .= '    <td style="text-align: center;"><strong>EMOTIONAL SUPPORT CERTIFICATE <br> TO WHOM IT MAY CONCERN</strong></td>';
	$estructura_titulo_certificado_apoyo_emocional_eng                .= '  </tr>';
	$estructura_titulo_certificado_apoyo_emocional_eng                .= '  </tbody>';
	$estructura_titulo_certificado_apoyo_emocional_eng                .= '</table>';

	$estructura_profesional_certificado_apoyo_emocional_eng            = '<table cellpadding="0" cellspacing="0" width="100%" style="font-family: calibri; font-size: 10pt;">';
	$estructura_profesional_certificado_apoyo_emocional_eng           .= '  <tbody>';
	$estructura_profesional_certificado_apoyo_emocional_eng           .= '  <tr>';
	$estructura_profesional_certificado_apoyo_emocional_eng           .= '    <td style="text-align: justify;">I, <strong>'.$nombre_profesional.'</strong>, with CC. '.number_format($documento_profesional, 0, ",", ".").'</strong> from San Pelayo, Córdoba, Colombia, a psychologist by profession with professional card No. '.$tarjeta_profesional.' accredited by COLPSIC.</td>';
	$estructura_profesional_certificado_apoyo_emocional_eng           .= '  </tr>';
	$estructura_profesional_certificado_apoyo_emocional_eng           .= '  </tbody>';
	$estructura_profesional_certificado_apoyo_emocional_eng           .= '</table>';

	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng  = '';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family: calibri; font-size: 13pt;">';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '  <tbody>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '  <tr>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '    <td style="text-align: center;"><strong>CERTIFY</strong></td>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '  </tr>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '  </tbody>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '</table>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '<table cellpadding="0" cellspacing="0" width="100%" style="font-family: calibri; font-size: 10pt;">';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '  <tbody>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '  <tr>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= "    <td style=".'text-align: justify'.";>That Mrs, <strong>".$nombre_propietario_mascota.". con CC. ".number_format($documento_propietario_mascota, 0, ",", ".")."</strong>, with address ".$direccion_propietario_mascota.", attended a psychological care session. During said evaluation, it was found that the patient\'s has the following diagnosis: F41.2 Mixed Anxiety-Depressive Disorder, with a current depressive episode. Therefore, as part of her psychological treatment, the presence of her pet has been prescribed for emotional support: The animal must accompany the patient: In a carrier in the aircraft cabin during travel, inside or outside of a carrier in the aircraft cabin during travel. The animal will be used to accommodate the patients mental health-related disability. Likewise, the patient can be in the same conditions as the emotional support pet in commercial establishments, on the subway, on public transportation, in hotels, or else where.</td>";
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '  </tr>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '  </tbody>';
	$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng .= '</table>';

	$estructura_justificacion_certificado_apoyo_emocional_eng          = '';
	$estructura_justificacion_certificado_apoyo_emocional_eng         .= '<table cellpadding="0" cellspacing="0" width="100%" style="text-align: justify; font-family: calibri; font-size: 10pt;">';
	$estructura_justificacion_certificado_apoyo_emocional_eng         .= '  <tbody>';
	$estructura_justificacion_certificado_apoyo_emocional_eng         .= '  <tr>';
	$estructura_justificacion_certificado_apoyo_emocional_eng         .= '    <td style="text-align: justify;">Therefore, the patient maintains an emotional attachment to his pet, as it provides him with emotional and psychological stability. He has suffered from bouts of depression and anxiety for the past 7 years, which is why he decided to adopt it. Since his pet has been with him, his emotional situation has improved.</td>';
	$estructura_justificacion_certificado_apoyo_emocional_eng         .= '  </tr>';
	$estructura_justificacion_certificado_apoyo_emocional_eng         .= '  </tbody>';
	$estructura_justificacion_certificado_apoyo_emocional_eng         .= '</table>';

	$estructura_tabla_mascota_certificado_apoyo_emocional_eng          = '';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '<table border="1" cellpadding="10" cellspacing="0" width="100%" style="font-family: calibri; font-size: 10pt;">';
	$estructura_justificacion_certificado_apoyo_emocional_eng         .= '  <tbody>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '  <tr>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '    <td style="background-color:#80C6E1; text-align:center">NAME</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '    <td style="background-color:#80C6E1; text-align:center">AGE</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '    <td style="background-color:#80C6E1; text-align:center">RACE</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '    <td style="background-color:#80C6E1; text-align:center">COLOR</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '    <td style="background-color:#80C6E1; text-align:center">WEIGHT</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '    <td style="background-color:#80C6E1; text-align:center">SIZE</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '  </tr>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '  <tr>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '    <td style="text-align:center">'.$nombre_mascota.'</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '    <td style="text-align:center">'.$edad_mascota.' YEAR</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '    <td style="text-align:center">'.$nombre_raza_mascota.'</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '    <td style="text-align:center">'.$color_mascota.'</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '    <td style="text-align:center">'.$peso_mascota.' KILOS </td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '    <td style="text-align:center">'.$talla_mascota.'</td>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '  </tr>';
	$estructura_justificacion_certificado_apoyo_emocional_eng         .= '  </tbody>';
	$estructura_tabla_mascota_certificado_apoyo_emocional_eng         .= '</table>';

	$estructura_vigencia_certificado_apoyo_emocional_eng               = '';
	$estructura_vigencia_certificado_apoyo_emocional_eng              .= '<table cellpadding="0" cellspacing="0" width="100%" style="font-family: calibri; font-size: 10pt;">';
	$estructura_vigencia_certificado_apoyo_emocional_eng              .= '  <tbody>';
	$estructura_vigencia_certificado_apoyo_emocional_eng              .= '  <tr>';
	$estructura_vigencia_certificado_apoyo_emocional_eng              .= '    <td style="text-align: justify;">This certificate is valid for one year from its date of issue, issued on '.$fecha_mes_ingles_texto.' '.$fecha_dia_texto.', '.$fecha_anyo_texto.'.</td>';
	$estructura_vigencia_certificado_apoyo_emocional_eng              .= '  </tr>';
	$estructura_vigencia_certificado_apoyo_emocional_eng             .= '  </tbody>';
	$estructura_vigencia_certificado_apoyo_emocional_eng              .= '</table>';

	$tabla_separadora_html                                            = '<table cellpadding="0" cellspacing="0" style="font-family:calibri; font-size:10pt; width:100%"><tbody><tr><td>&nbsp;</td></tr></tbody></table>';
	$estructura_todo_certificado_apoyo_emocional_esp                  = $estructura_titulo_certificado_apoyo_emocional_esp.$tabla_separadora_html.$estructura_profesional_certificado_apoyo_emocional_esp.$tabla_separadora_html.$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp.$tabla_separadora_html.$estructura_justificacion_certificado_apoyo_emocional_esp.$tabla_separadora_html.$estructura_tabla_mascota_certificado_apoyo_emocional_esp.$tabla_separadora_html.$estructura_vigencia_certificado_apoyo_emocional_esp;
	$estructura_todo_certificado_apoyo_emocional_eng                  = $estructura_titulo_certificado_apoyo_emocional_eng.$tabla_separadora_html.$estructura_profesional_certificado_apoyo_emocional_eng.$tabla_separadora_html.$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng.$tabla_separadora_html.$estructura_justificacion_certificado_apoyo_emocional_eng.$tabla_separadora_html.$estructura_tabla_mascota_certificado_apoyo_emocional_eng.$tabla_separadora_html.$estructura_vigencia_certificado_apoyo_emocional_eng;
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_archivador = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_certificado_apoyo_emocional'";
	$exec_autoincremento_archivador = mysqli_query($conectar, $sql_autoincremento_archivador) or die(mysqli_error($conectar));
	$datos_autoincremento_archivador = mysqli_fetch_assoc($exec_autoincremento_archivador);
	
	$cod_certificado_apoyo_emocional                                   = $datos_autoincremento_archivador['AUTO_INCREMENT'];
    $cod_certificado_apoyo_emocional_codif                             = DAXCODIFCRYPTOR::encodifdax($cod_certificado_apoyo_emocional);
    $cod_certificado_apoyo_emocional_codifcryp                         = DAXCODIFCRYPTOR::encriptardax($cod_certificado_apoyo_emocional_codif);
	/* ----------------------------------------------------------------------------------------------------------/ */
	$fecha_hora                                                        = date("H:i:s");
	$fecha_creacion                                                    = date("Y-m-d");
	$tipo_soporte                                                      = "ARCHIVADOR";
/* ----------------------------------------------------------------------------------------------------------/ */
	$time                                                              = time();
	$fecha_ymdHis                                                      = date("YmdHis");
	$formato                                                           = 'jpg';
	$fecha_hora                                                        = date("H:i:s");
	$fecha_ymd                                                         = date("Y-m-d");

	$ruta_firma_miniatura                                              = '../archivador/documentos/';
	$ruta_foto_miniatura                                               = '../archivador/documentos/';
	$ruta_firma_orig                                                   = '../archivador/documentos/';
	$ruta_foto_orig                                                    = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_archivador = "INSERT INTO tbl15_certificado_apoyo_emocional (cod_certificado_apoyo_emocional, nombre_propietario_mascota, documento_propietario_mascota, 
	direccion_propietario_mascota, correo_propietario_mascota, nombre_mascota, edad_mascota, nombre_raza_mascota, color_mascota, peso_mascota, talla_mascota, 
	fecha_certificado_apoyo_emocional, hora_certificado_apoyo_emocional, fecha_creacion_certificado_apoyo_emocional, 
	estructura_titulo_certificado_apoyo_emocional_esp, estructura_profesional_certificado_apoyo_emocional_esp, estructura_propietario_diagnosti_certificado_apoyo_emocional_esp, estructura_justificacion_certificado_apoyo_emocional_esp, 
	estructura_tabla_mascota_certificado_apoyo_emocional_esp, estructura_vigencia_certificado_apoyo_emocional_esp, estructura_titulo_certificado_apoyo_emocional_eng, 
	estructura_profesional_certificado_apoyo_emocional_eng, estructura_propietario_diagnosti_certificado_apoyo_emocional_eng, estructura_justificacion_certificado_apoyo_emocional_eng, 
	estructura_tabla_mascota_certificado_apoyo_emocional_eng, estructura_vigencia_certificado_apoyo_emocional_eng, estructura_todo_certificado_apoyo_emocional_esp, estructura_todo_certificado_apoyo_emocional_eng, 
	nombre_profesional, documento_profesional, tarjeta_profesional) 
	VALUES ('$cod_certificado_apoyo_emocional', UPPER('$nombre_propietario_mascota'), '$documento_propietario_mascota', 
	'$direccion_propietario_mascota', '$correo_propietario_mascota', UPPER('$nombre_mascota'), '$edad_mascota', UPPER('$nombre_raza_mascota'), '$color_mascota', '$peso_mascota', '$talla_mascota', 
	'$fecha_certificado_apoyo_emocional', '$hora_certificado_apoyo_emocional', '$fecha_creacion_certificado_apoyo_emocional', '$estructura_titulo_certificado_apoyo_emocional_esp', 
	'$estructura_profesional_certificado_apoyo_emocional_esp', '$estructura_propietario_diagnosti_certificado_apoyo_emocional_esp', '$estructura_justificacion_certificado_apoyo_emocional_esp', 
	'$estructura_tabla_mascota_certificado_apoyo_emocional_esp', '$estructura_vigencia_certificado_apoyo_emocional_esp', '$estructura_titulo_certificado_apoyo_emocional_eng', 
	'$estructura_profesional_certificado_apoyo_emocional_eng', '$estructura_propietario_diagnosti_certificado_apoyo_emocional_eng', '$estructura_justificacion_certificado_apoyo_emocional_eng', 
	'$estructura_tabla_mascota_certificado_apoyo_emocional_eng', '$estructura_vigencia_certificado_apoyo_emocional_eng', '$estructura_todo_certificado_apoyo_emocional_esp', '$estructura_todo_certificado_apoyo_emocional_eng', 
	'$nombre_profesional', '$documento_profesional', '$tarjeta_profesional')";
	$resultado_archivador = mysqli_query($conectar, $sql_archivador) or die(mysqli_error($conectar));

 	$pagina_redirect                                    = '../admin/lista_certificado_apoyo_emocional.php'.'?cod_certificado_apoyo_emocional='.$cod_certificado_apoyo_emocional.'&cod_certificado_apoyo_emocional_codifcryp='.$cod_certificado_apoyo_emocional_codifcryp;
/* ----------------------------------------------------------------------------------------------------------/ */
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>