<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {
include("../admin/class_php/class.upload.php");
//include("../admin/class_php/class.upload.php");
/* ----------------------------------------------------------------------------------------------------------/ */
$cod_cliente                   = intval($_POST['cod_cliente']);
if (isset($_POST['nombres']) <> '') { $nombres = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombres']))); } else { $nombres = ''; }
if (isset($_POST['nombre_especie']) <> '') { $nombre_especie = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_especie']))); } else { $nombre_especie = ''; }
if (isset($_POST['nombre_raza']) <> '') { $nombre_raza = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_raza']))); } else { $nombre_raza = ''; }
if (isset($_POST['nombre_color']) <> '') { $nombre_color = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_color']))); } else { $nombre_color = ''; }
if (isset($_POST['nombre_sexo']) <> '') { $nombre_sexo = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_sexo']))); } else { $nombre_sexo = ''; }
if (isset($_POST['fecha_nac_ymd']) <> '') { $fecha_nac_ymd = mysqli_real_escape_string($conectar,(($_POST['fecha_nac_ymd']))); } else { $fecha_nac_ymd = ''; }
if (isset($_POST['edad_mes']) <> '') { $edad_mes = mysqli_real_escape_string($conectar,(($_POST['edad_mes']))); } else { $edad_mes = ''; }
if (isset($_POST['edad_anyo']) <> '') { $edad_anyo = mysqli_real_escape_string($conectar,(($_POST['edad_anyo']))); } else { $edad_anyo = ''; }
if (isset($_POST['senas_particulares']) <> '') { $senas_particulares = mysqli_real_escape_string($conectar,(($_POST['senas_particulares']))); } else { $senas_particulares = ''; }
if (isset($_POST['nombre_procedencia']) <> '') { $nombre_procedencia = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_procedencia']))); } else { $nombre_procedencia = ''; }
if (isset($_POST['nombre_contacto1']) <> '') { $nombre_contacto1 = mysqli_real_escape_string($conectar,(strtoupper($_POST['nombre_contacto1']))); } else { $nombre_contacto1 = ''; }
if (isset($_POST['identificacion_contacto1']) <> '') { $identificacion_contacto1 = mysqli_real_escape_string($conectar,(strtoupper($_POST['identificacion_contacto1']))); } else { $identificacion_contacto1 = ''; }
if (isset($_POST['direccion_contacto1']) <> '') { $direccion_contacto1 = mysqli_real_escape_string($conectar,(strtoupper($_POST['direccion_contacto1']))); } else { $direccion_contacto1 = ''; }
if (isset($_POST['estrato_contacto1']) <> '') { $estrato_contacto1 = intval($_POST['estrato_contacto1']); } else { $estrato_contacto1 = ''; }
if (isset($_POST['municipio_contacto1']) <> '') { $municipio_contacto1 = mysqli_real_escape_string($conectar,(strtoupper($_POST['municipio_contacto1']))); } else { $municipio_contacto1 = ''; }
if (isset($_POST['tel_contacto1']) <> '') { $tel_contacto1 = mysqli_real_escape_string($conectar,(strtoupper($_POST['tel_contacto1']))); } else { $tel_contacto1 = ''; }
if (isset($_POST['correo_contacto1']) <> '') { $correo_contacto1 = mysqli_real_escape_string($conectar,(($_POST['correo_contacto1']))); } else { $correo_contacto1 = ''; }
if (isset($_POST['ocupacion_contacto1']) <> '') { $ocupacion_contacto1 = mysqli_real_escape_string($conectar,(strtoupper($_POST['ocupacion_contacto1']))); } else { $ocupacion_contacto1 = ''; }
if (isset($_POST['motivo']) <> '') { $motivo = mysqli_real_escape_string($conectar,(strtoupper($_POST['motivo']))); } else { $motivo = ''; }
if (isset($_POST['cod_administrador']) <> '') { $cod_administrador = intval($_POST['cod_administrador']); } else { $cod_administrador = ''; }
if (isset($_POST['fecha_ymd']) <> '') { $fecha_ymd = mysqli_real_escape_string($conectar,(($_POST['fecha_ymd']))); } else { $fecha_ymd = ''; }
if (isset($_POST['fecha_hora']) <> '') { $fecha_hora = mysqli_real_escape_string($conectar,(($_POST['fecha_hora']))); } else { $fecha_hora = ''; }
if (isset($_POST['costo_motivo_consulta']) <> '') { $costo_motivo_consulta = mysqli_real_escape_string($conectar,(($_POST['costo_motivo_consulta']))); } else { $costo_motivo_consulta = ''; }
if (isset($_POST['cod_empresa']) <> '') { $cod_empresa = intval($_POST['cod_empresa']); } else { $cod_empresa = ''; }

$nombre_vacum_can              = 'NO';
$nombre_vacum_can_pvc          = 'PVC';
$nombre_vacum_can_triple       = 'TRIPLE';
$nombre_vacum_can_rabia        = 'RABIA';
$nombre_vacum_can_otra         = 'OTRA';
$motivo_consulta               = $motivo;
$fecha_nac_time                = strtotime($fecha_nac_ymd);
/* ---------------------------------------------------------------------------------------------------------- */
//trim(strip_tags(stripslashes($_POST['motivo'])));
$obtener_cod_max = "SELECT MAX(cod_historia_clinica) AS cod_historia_clinica_ultima_hist_cliente FROM tbl15_historia_clinica WHERE (cod_cliente = '$cod_cliente') AND (cod_estado_facturacion = '1')";
$consultar_cod_max = mysqli_query($conectar, $obtener_cod_max) or die(mysqli_error($conectar));
$info_cod_max = mysqli_fetch_assoc($consultar_cod_max);

$cod_historia_clinica_ultima_hist_cliente       = $info_cod_max['cod_historia_clinica_ultima_hist_cliente'];

$obtener_cod_hist = "SELECT cod_historia_clinica FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica_ultima_hist_cliente'";
$consultar_cod_hist = mysqli_query($conectar, $obtener_cod_hist) or die(mysqli_error($conectar));
$info_cod_hist = mysqli_fetch_assoc($consultar_cod_hist);

$cod_historia_clinicall                = $info_cod_hist['cod_historia_clinica'];

$fecha_ymd_hora                      = $fecha_ymd.' '.$fecha_hora;
$formato                             = 'jpg';
$time                                = time();
$fecha_ymdHis                        = date("YmdHis");
$fecha_time                          = strtotime($fecha_ymd_hora);
$fecha_dmy                           = date("d-m-Y", $fecha_time);
$fecha_mes                           = date("Y-m", $fecha_time);
$fecha_anyo                          = date("Y", $fecha_time);
$hora                                = date("H:i", $fecha_time);
$fecha_reg_time                      = time();
$cuenta                              = $cuenta_actual;
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_autoincremento_historia_clinica = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_historia_clinica'";
$exec_autoincremento_historia_clinica = mysqli_query($conectar, $sql_autoincremento_historia_clinica) or die(mysqli_error($conectar));
$datos_autoincremento_historia_clinica = mysqli_fetch_assoc($exec_autoincremento_historia_clinica);
$cod_historia_clinica = $datos_autoincremento_historia_clinica['AUTO_INCREMENT'];
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
$ruta_firma_miniatura                = '../archivador/firma/miniatura/';
$ruta_foto_miniatura                 = '../archivador/foto/miniatura/';
$ruta_firma_orig                     = '../archivador/firma/original/';
$ruta_foto_orig                      = '../archivador/foto/original/';

$nombre_lista_problema               = "";
$nombre_lista_maestra                = "";
$nombre_diagnostico_diferencial      = "";
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
//if (isset($_POST['url_img_foto']) <> '') { $url_img_foto = addslashes($_POST['url_img_foto']); } else { $url_img_foto = ''; }
//$formato_img2                        = explode(".", $url_img_foto);
//$formato_img2                        = end($formato_img2);
//$formato_orig2                       = strtolower($formato_img2);
//$nombre_foto_cryp                    = crc32($url_img_foto);
//$nombre_normal2                      = $fecha_ymdHis.'_'.$cod_historia_clinica.'_'.$cod_cliente.'_'.$cedula.'_ori'.'.'.$formato_orig2;
//$url_img_foto_orig                   = $ruta_foto_orig.$nombre_normal2;
//$url_img_foto_min                    = $ruta_foto_orig.$nombre_normal2;
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
//$sql_reg_cie10 = "INSERT INTO tbl15_cie10diag (cie10_cod, cie10_diag, cie10_impdiag, cie10_confirnuev, cie10_confirepet, cie10_diagprinc, cod_historia_clinica, cod_cliente, cod_administrador)
//SELECT cie10_cod, cie10_diag, cie10_impdiag, cie10_confirnuev, cie10_confirepet, cie10_diagprinc, '$cod_historia_clinica', '$cod_cliente', '$cod_administrador' 
//FROM tbl15_cie10diag WHERE cod_historia_clinica = '$cod_historia_clinica_ultima_hist_cliente'";
//$consultar_reg_cie10 = mysqli_query($conectar, $sql_reg_cie10) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_data = "INSERT INTO tbl15_historia_clinica (cod_empresa, cod_cliente, cod_administrador, motivo, motivo_consulta, 
nombre_contacto1, identificacion_contacto1, direccion_contacto1, estrato_contacto1, 
municipio_contacto1, tel_contacto1, correo_contacto1, ocupacion_contacto1, cuenta, fecha_mes, fecha_anyo, fecha_ymd, 
fecha_dmy, hora, fecha_time, fecha_reg_time, costo_motivo_consulta, 
nombre_vacum_can, nombre_vacum_can_pvc, nombre_vacum_can_triple, nombre_vacum_can_rabia, nombre_vacum_can_otra) 
VALUES ('$cod_empresa', '$cod_cliente', '$cod_administrador', '$motivo', '$motivo_consulta', 
'$nombre_contacto1', '$identificacion_contacto1', '$direccion_contacto1', '$estrato_contacto1', 
'$municipio_contacto1', '$tel_contacto1', '$correo_contacto1', '$ocupacion_contacto1', '$cuenta', '$fecha_mes', '$fecha_anyo', '$fecha_ymd', 
'$fecha_dmy', '$hora', '$fecha_time', '$fecha_reg_time', '$costo_motivo_consulta', 
'$nombre_vacum_can', '$nombre_vacum_can_pvc', '$nombre_vacum_can_triple', '$nombre_vacum_can_rabia', '$nombre_vacum_can_otra')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_data = "UPDATE tbl15_cliente SET nombres = '$nombres', nombre_especie = '$nombre_especie', 
nombre_raza = '$nombre_raza', nombre_color = '$nombre_color', nombre_sexo = '$nombre_sexo', 
fecha_nac_ymd = '$fecha_nac_ymd', edad_mes = '$edad_mes', edad_anyo = '$edad_anyo', 
senas_particulares = '$senas_particulares', identificacion_contacto1 = '$identificacion_contacto1', 
nombre_contacto1 = '$nombre_contacto1', direccion_contacto1 = '$direccion_contacto1', 
estrato_contacto1 = '$estrato_contacto1', municipio_contacto1 = '$municipio_contacto1', 
tel_contacto1 = '$tel_contacto1', correo_contacto1 = '$correo_contacto1', ocupacion_contacto1 = '$ocupacion_contacto1', cod_empresa = '$cod_empresa'
WHERE cod_cliente = '$cod_cliente'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_data = "INSERT INTO tbl15_lista_problema (cod_historia_clinica, nombre_lista_problema, nombre_lista_maestra, 
nombre_diagnostico_diferencial) 
VALUES ('$cod_historia_clinica', '$nombre_lista_problema', '$nombre_lista_maestra', 
'$nombre_diagnostico_diferencial')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_data = "INSERT INTO tbl15_plan_terapeutico (cod_historia_clinica, fecha_mes, fecha_anyo, 
fecha_ymd, fecha_dmy, fecha_time, fecha_reg_time, cuenta) 
VALUES ('$cod_historia_clinica', '$fecha_mes', '$fecha_anyo', 
'$fecha_ymd', '$fecha_dmy', '$fecha_time', '$fecha_reg_time', '$cuenta')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_data = "INSERT INTO tbl15_auxiliar_pasante (cod_historia_clinica, fecha_mes, fecha_anyo, 
fecha_ymd, fecha_dmy, fecha_time, fecha_reg_time, cuenta) 
VALUES ('$cod_historia_clinica', '$fecha_mes', '$fecha_anyo', 
'$fecha_ymd', '$fecha_dmy', '$fecha_time', '$fecha_reg_time', '$cuenta')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
/*
if ($url_img_foto <> '') {
rename ($url_img_foto, $url_img_foto_orig);

$actualizar_foto_cliente = "UPDATE tbl15_cliente SET url_img_foto = '$url_img_foto_orig', url_img_foto_min = '$url_img_foto_min' WHERE cod_cliente = '$cod_cliente'";
$resultado_foto_cliente = mysqli_query($conectar, $actualizar_foto_cliente) or die(mysqli_error($conectar));
}
*/
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
$url_redict = "../admin/lista_cita_historia_clinica_individual.php?cod_historia_clinica=".$cod_historia_clinica."&cod_cliente=".$cod_cliente;
?>
<h3>Se ha guardado correctamente la información</h3>
<META HTTP-EQUIV="REFRESH" CONTENT="1; <?php echo $url_redict ?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="1; <?php echo $pagina_else?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
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