<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery-3.1.1.min.js"></script> 

<script language="javascript" src="../admin/class_php/isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor)
myajax.Link('guardar_medicamento_formulado_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
<body id="pageBody" onLoad="myajax = new isiAJAX();">

</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); 
$tabla = 0;
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="#"><h4>Consentimiento Informado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/ver_consentimiento_informado_version_pdf.php?tabla=<?php echo $tabla ?>" target="_blank">Version Imprimible</h4></a>
</div>

<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ********************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ********************************************************************************************** -->
<?php
$cod_consentimiento_informado                       = intval($_GET['cod_consentimiento_informado']);
$cod_historia_clinica                               = intval($_GET['cod_historia_clinica']);
$cod_cliente                                        = intval($_GET['cod_cliente']);
$pagina                                             = addslashes($_GET['pagina']);
$pagina_local                                       = $_SERVER['PHP_SELF'];
$fecha_hoy_time                                     = strtotime(date("Y/m/d"));
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_consentimiento_informado = "SELECT * FROM tbl15_consentimiento_informado WHERE cod_consentimiento_informado = '".($cod_consentimiento_informado)."'";
$consultar_consentimiento_informado = mysqli_query($conectar, $obtener_consentimiento_informado) or die(mysqli_error($conectar));
$info_consentimiento_informado= mysqli_fetch_assoc($consultar_consentimiento_informado);

$cod_historia_clinica                               = $info_consentimiento_informado['cod_historia_clinica'];
$cod_cliente                                        = $info_consentimiento_informado['cod_cliente'];
$cod_administrador                                  = $info_consentimiento_informado['cod_administrador'];
$motivo_cosulta                                     = $info_consentimiento_informado['motivo_cosulta'];
$cod_grupo_area                                     = $info_consentimiento_informado['cod_grupo_area'];
$cod_grupo_area_cargo                               = $info_consentimiento_informado['cod_grupo_area_cargo'];
$cod_factura                                        = $info_consentimiento_informado['cod_factura'];
$nombre_ocupacion                                   = $info_consentimiento_informado['nombre_ocupacion'];
$nombre_empresa                                     = $info_consentimiento_informado['nombre_empresa'];
$cargo_empresa                                      = $info_consentimiento_informado['cargo_empresa'];
$area_empresa                                       = $info_consentimiento_informado['area_empresa'];
$ciudad_empresa                                     = $info_consentimiento_informado['ciudad_empresa'];
$nombre_empresa_contratante                         = $info_consentimiento_informado['nombre_empresa_contratante'];
$objetivo_autoreport                                = $info_consentimiento_informado['objetivo_autoreport'];
$antecpersonosteo_problem_column                    = $info_consentimiento_informado['antecpersonosteo_problem_column'];
$antecpersonosteo_esguience_luxac                   = $info_consentimiento_informado['antecpersonosteo_esguience_luxac'];
$antecpersonosteo_epicondi_tunelcarp                = $info_consentimiento_informado['antecpersonosteo_epicondi_tunelcarp'];
$antecpersonosteo_enferm_huesos                     = $info_consentimiento_informado['antecpersonosteo_enferm_huesos'];
$antecpersonosteo_lesion_deport_cual                = $info_consentimiento_informado['antecpersonosteo_lesion_deport_cual'];
$antecpersonosteo_lesion_deport                     = $info_consentimiento_informado['antecpersonosteo_lesion_deport'];
$antecpersonneurol_temor_altura                     = $info_consentimiento_informado['antecpersonneurol_temor_altura'];
$antecpersonneurol_epilespsia                       = $info_consentimiento_informado['antecpersonneurol_epilespsia'];
$antecpersonneurol_ansiedad                         = $info_consentimiento_informado['antecpersonneurol_ansiedad'];
$antecpersoncardiov_enf_corazon                     = $info_consentimiento_informado['antecpersoncardiov_enf_corazon'];
$antecpersoncardiov_asma                            = $info_consentimiento_informado['antecpersoncardiov_asma'];
$antecpersoncardiov_hiperarter                      = $info_consentimiento_informado['antecpersoncardiov_hiperarter'];
$antecpersoncardiov_otra_enfer                      = $info_consentimiento_informado['antecpersoncardiov_otra_enfer'];
$antecpersoncardiov_otra_enfer_cual                 = $info_consentimiento_informado['antecpersoncardiov_otra_enfer_cual'];
$antecpersonendocrino_diabete                       = $info_consentimiento_informado['antecpersonendocrino_diabete'];
$antecpersonendocrino_anemia                        = $info_consentimiento_informado['antecpersonendocrino_anemia'];
$antecpersonendocrino_hiperuricemia                 = $info_consentimiento_informado['antecpersonendocrino_hiperuricemia'];
$antecpersonendocrino_alter_tiroid                  = $info_consentimiento_informado['antecpersonendocrino_alter_tiroid'];
$antecpersonendocrino_cancer                        = $info_consentimiento_informado['antecpersonendocrino_cancer'];
$antecpersonendocrino_piel_amarilla                 = $info_consentimiento_informado['antecpersonendocrino_piel_amarilla'];
$antecpersonendocrino_calc_colicos                  = $info_consentimiento_informado['antecpersonendocrino_calc_colicos'];
$antecpersonendocrino_hipertrof_prost               = $info_consentimiento_informado['antecpersonendocrino_hipertrof_prost'];
$antecpersonendocrino_enf_piel                      = $info_consentimiento_informado['antecpersonendocrino_enf_piel'];
$antecpersonendocrino_problem_renal                 = $info_consentimiento_informado['antecpersonendocrino_problem_renal'];
$antecpersonendocrino_reflujo                       = $info_consentimiento_informado['antecpersonendocrino_reflujo'];
$antecpersonoidnarisojos_problem_oido               = $info_consentimiento_informado['antecpersonoidnarisojos_problem_oido'];
$antecpersonoidnarisojos_vertigo                    = $info_consentimiento_informado['antecpersonoidnarisojos_vertigo'];
$antecpersonoidnarisojos_dificul_vision             = $info_consentimiento_informado['antecpersonoidnarisojos_dificul_vision'];
$antecpersonoidnarisojos_problem_ojos               = $info_consentimiento_informado['antecpersonoidnarisojos_problem_ojos'];
$antecpersoninmunizac_vacum10anyos                  = $info_consentimiento_informado['antecpersoninmunizac_vacum10anyos'];
$antecpersoninmunizac_vacum10anyos_cual             = $info_consentimiento_informado['antecpersoninmunizac_vacum10anyos_cual'];
$antecpersoninmunizac_vacum10anyos_fecha            = $info_consentimiento_informado['antecpersoninmunizac_vacum10anyos_fecha'];
$antecpersongeneral_sufre_enf_menson_ant            = $info_consentimiento_informado['antecpersongeneral_sufre_enf_menson_ant'];
$antecpersongeneral_sufre_enf_menson_ant_cual       = $info_consentimiento_informado['antecpersongeneral_sufre_enf_menson_ant_cual'];
$antecpersongeneral_tranf_sangre                    = $info_consentimiento_informado['antecpersongeneral_tranf_sangre'];
$antecpersongeneral_tranf_sangre_fecha              = $info_consentimiento_informado['antecpersongeneral_tranf_sangre_fecha'];
$antecpersongeneral_tranf_sangre_fecha_causa        = $info_consentimiento_informado['antecpersongeneral_tranf_sangre_fecha_causa'];
$antecpersongeneral_presen_reaccion                 = $info_consentimiento_informado['antecpersongeneral_presen_reaccion'];
$antecpersongeneral_trata_segui_medic_cual          = $info_consentimiento_informado['antecpersongeneral_trata_segui_medic_cual'];
$antecpersongeneral_trata_segui_medic               = $info_consentimiento_informado['antecpersongeneral_trata_segui_medic'];
$antecpersongeneral_dicho_operarse_operado_cual     = $info_consentimiento_informado['antecpersongeneral_dicho_operarse_operado_cual'];
$antecpersongeneral_dicho_operarse_operado          = $info_consentimiento_informado['antecpersongeneral_dicho_operarse_operado'];
$antecpersongeneral_alguna_hospitaliza_clinic       = $info_consentimiento_informado['antecpersongeneral_alguna_hospitaliza_clinic'];
$antecpersongeneral_alergico_algo_cual              = $info_consentimiento_informado['antecpersongeneral_alergico_algo_cual'];
$antecpersongeneral_alergico_algo                   = $info_consentimiento_informado['antecpersongeneral_alergico_algo'];
$antecpersongeneral_medicament_actualm_cual         = $info_consentimiento_informado['antecpersongeneral_medicament_actualm_cual'];
$antecpersongeneral_medicament_actualm              = $info_consentimiento_informado['antecpersongeneral_medicament_actualm'];
$antecpersongeneral_sufre_deter_fisico_cual         = $info_consentimiento_informado['antecpersongeneral_sufre_deter_fisico_cual'];
$antecpersongeneral_sufre_deter_fisico              = $info_consentimiento_informado['antecpersongeneral_sufre_deter_fisico'];
$antecpersongeneral_calif_perdcapc_lab_cual         = $info_consentimiento_informado['antecpersongeneral_calif_perdcapc_lab_cual'];
$antecpersongeneral_calif_perdcapc_lab              = $info_consentimiento_informado['antecpersongeneral_calif_perdcapc_lab'];
$antecpersongeneral_repor_arl_empresa_cual          = $info_consentimiento_informado['antecpersongeneral_repor_arl_empresa_cual'];
$antecpersongeneral_repor_arl_empresa               = $info_consentimiento_informado['antecpersongeneral_repor_arl_empresa'];
$antecpersongeneral_calif_eps_arl_enf_trab_cual     = $info_consentimiento_informado['antecpersongeneral_calif_eps_arl_enf_trab_cual'];
$antecpersongeneral_calif_eps_arl_enf_trab          = $info_consentimiento_informado['antecpersongeneral_calif_eps_arl_enf_trab'];
$nombre_empresa                                     = $info_consentimiento_informado['nombre_empresa'];
$politic_protec_datos                               = $info_consentimiento_informado['politic_protec_datos'];

$sintoma_covid19_todo                               = $info_consentimiento_informado['sintoma_covid19_todo'];
$sintoma_covid19                                    = $info_consentimiento_informado['sintoma_covid19'];
$covid19_fiebre                                     = $info_consentimiento_informado['covid19_fiebre'];
$covid19_escolofrio                                 = $info_consentimiento_informado['covid19_escolofrio'];
$covid19_cansansio                                  = $info_consentimiento_informado['covid19_cansansio'];
$covid19_malestar_gral                              = $info_consentimiento_informado['covid19_malestar_gral'];
$covid19_fatiga                                     = $info_consentimiento_informado['covid19_fatiga'];
$covid19_tos_seca                                   = $info_consentimiento_informado['covid19_tos_seca'];
$covid19_cefaleas                                   = $info_consentimiento_informado['covid19_cefaleas'];
$covid19_congestion_nasal                           = $info_consentimiento_informado['covid19_congestion_nasal'];
$covid19_secrecion_nasal                            = $info_consentimiento_informado['covid19_secrecion_nasal'];
$covid19_dorlor_garganta                            = $info_consentimiento_informado['covid19_dorlor_garganta'];
$covid19_diarrea                                    = $info_consentimiento_informado['covid19_diarrea'];
$covid19_dificul_resp                               = $info_consentimiento_informado['covid19_dificul_resp'];
$covid19_inapetencia                                = $info_consentimiento_informado['covid19_inapetencia'];
$covid19_perdida_olfato                             = $info_consentimiento_informado['covid19_perdida_olfato'];
$covid19_perdida_gusto                              = $info_consentimiento_informado['covid19_perdida_gusto'];
$covid19_dedos_covid                                = $info_consentimiento_informado['covid19_dedos_covid'];
$covid19_dolor_pecho                                = $info_consentimiento_informado['covid19_dolor_pecho'];
$covid19_confusion                                  = $info_consentimiento_informado['covid19_confusion'];
$covid19_color_azul_labios                          = $info_consentimiento_informado['covid19_color_azul_labios'];

$fecha_mes                                          = $info_consentimiento_informado['fecha_mes'];
$fecha_anyo                                         = $info_consentimiento_informado['fecha_anyo'];
$fecha_ymd                                          = $info_consentimiento_informado['fecha_ymd'];
$fecha_dmy                                          = $info_consentimiento_informado['fecha_dmy'];
$fecha_hora                                         = $info_consentimiento_informado['fecha_hora'];
$fecha_time                                         = $info_consentimiento_informado['fecha_time'];
$fecha_reg_time                                     = $info_consentimiento_informado['fecha_reg_time'];
$cuenta                                             = $info_consentimiento_informado['cuenta'];
$cuenta_reg                                         = $info_consentimiento_informado['cuenta_reg'];
$check_diligenciado                                 = $info_consentimiento_informado['check_diligenciado'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_estructura_consentimiento_informado = "SELECT nombre_empresa, cargo_empresa, area_empresa, ciudad_empresa, nombre_empresa_contratante, motivo, cod_cliente,  
cod_administrador, nombre_arl, nombre_tipo_regimen FROM tbl15_historia_clinica WHERE cod_historia_clinica = '".($cod_historia_clinica)."'";
$consultar_estructura_consentimiento_informado = mysqli_query($conectar, $obtener_estructura_consentimiento_informado) or die(mysqli_error($conectar));
$info_estructura_consentimiento_informado= mysqli_fetch_assoc($consultar_estructura_consentimiento_informado);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_empresa= "SELECT razonsocial_empresa, direccion_empresa, telefono_empresa, nit_empresa FROM tbl15_empresa WHERE nombre_empresa = '".($nombre_empresa)."'";
$consultar_empresa= mysqli_query($conectar, $obtener_empresa) or die(mysqli_error($conectar));
$tbl15_info_empresa= mysqli_fetch_assoc($consultar_empresa);

$razonsocial_empresa                 = $tbl15_info_empresa['razonsocial_empresa'];
$direccion_empresa                   = $tbl15_info_empresa['direccion_empresa'];
$telefono_empresa                    = $tbl15_info_empresa['telefono_empresa'];
$nit_empresa                         = $tbl15_info_empresa['nit_empresa'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_prof = "SELECT nombres AS nombre_prof, apellidos AS apellidos_prof FROM tbl15_administrador WHERE cod_administrador = '".($cod_administrador)."'";
$consultar_prof = mysqli_query($conectar, $obtener_prof) or die(mysqli_error($conectar));
$info_prof = mysqli_fetch_assoc($consultar_prof);

$nombre_prof                         = $info_prof['nombre_prof'];
$apellidos_prof                      = $info_prof['apellidos_prof'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_cedula = "SELECT cedula, nombres, apellido1, apellido2, nombre_tipo_doc, nombre_sexo, url_img_firma_min AS url_img_firma_min_cli, direccion, lugar_residencia,
tel_cliente, cod_entidad, fecha_nac_ymd, nombre_arl, nombre_tipo_regimen, nombre_empresa 
FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$cedula                              = $info_cliente['cedula'];
$nombres                             = $info_cliente['nombres'];
$apellido1                           = $info_cliente['apellido1'];
$apellido2                           = $info_cliente['apellido2'];
$nombre_tipo_doc                     = $info_cliente['nombre_tipo_doc'];
$url_img_firma_min_cli               = $info_cliente['url_img_firma_min_cli'];
$nombre_sexo                         = $info_cliente['nombre_sexo'];
$direccion                           = $info_cliente['direccion'];
$lugar_residencia                    = $info_cliente['lugar_residencia'];
$tel_cliente                         = $info_cliente['tel_cliente'];
$cod_entidad                         = $info_cliente['cod_entidad'];
$nombre_arl                          = $info_cliente['nombre_arl'];
$nombre_tipo_regimen                 = $info_cliente['nombre_tipo_regimen'];
$fecha_nac_ymd                       = $info_cliente['fecha_nac_ymd'];

$fecha_nac_time                      = strtotime($fecha_nac_ymd);
$diferencia_edad                     = abs($fecha_hoy_time - $fecha_nac_time);
$edad_anyo                           = floor($diferencia_edad / (365*60*60*24));
$nom_ape                             = $nombres.' '.$apellido1.' '.$apellido2;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_entidad = "SELECT nombre_entidad FROM tbl15_entidad WHERE cod_entidad = '".($cod_entidad)."'";
$consultar_entidad = mysqli_query($conectar, $obtener_entidad) or die(mysqli_error($conectar));
$info_entidad = mysqli_fetch_assoc($consultar_entidad);

$nombre_entidad                      = $info_entidad['nombre_entidad'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
//if ($fecha_ymd_hora == '') { $fecha_ymd_hora = date("Y/m/d H:i:s"); } 
//else { $fecha_ymd_hora = $fecha_ymd_hora.' '.$fecha_hora; } 
$aaaa = 'aasssbbb';
?>
<!--<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_asignar_profesional_paciente_reg.php">-->
<form name="frmSubir" method="post" enctype="multipart/form-data" action="edit_consentimiento_informado_reg.php">
<fieldset>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td style="text-align:center">AUTOREPORTE DE CONDICIONES DE SALUD Y ANTECEDENTES MEDICOS</td>
  </tr>
  <tr>
    <td>El objetivo del presente anexo es suministrar al médico ocupacional la información de su tbl15_estado de salud y 
      antecedentes personales, para poder determinar su  aptitud laboral y sus tareas a realizar. 
      La confidencialidad y su uso serán primordiales para la elaboración de la historia clínica ocupacional. 
      <br>Resolución 2346 del 2007 y resolución 1918 del 2009 expedidas por el ministerio de protección social.
    </td>
  </tr>
</table>
<br>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td style="text-align:center">TIPO DE IDENTIFICACIÓN</td>
    <td style="text-align:center">IDENTIFICACIÓN</td>
    <td style="text-align:center">NOMBRES</td>
    <td style="text-align:center">APELLIDOS</td>
    <td style="text-align:center">SEXO</td>
    <td style="text-align:center">FECHA DE NACIMIENTO</td>
    <td style="text-align:center">EDAD</td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo $nombre_tipo_doc ?></td>
    <td style="text-align:center"><?php echo $cedula ?></td>
    <td style="text-align:center"><?php echo $nombres ?></td>
    <td style="text-align:center"><?php echo $apellido1 ?></td>
    <td style="text-align:center"><?php echo $nombre_sexo ?></td>
    <td style="text-align:center"><?php echo $fecha_nac_ymd ?></td>
    <td style="text-align:center"><?php echo $edad_anyo ?></td>
  </tr>
</table>
<br>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td style="text-align:center">CELULAR</td>
    <td style="text-align:center">EMPRESA</td>
    <td style="text-align:center">FECHA</td>
    <td style="text-align:center">HORA</td>
  </tr>
  <tr>
    <td style="text-align:center"><?php echo $tel_cliente ?></td>
    <td style="text-align:center">
      <select name="nombre_empresa" id="<?php echo $cod_consentimiento_informado ?>" required>
      <?php if (isset($nombre_empresa)) { echo "<option value='' >Selecione</option>";
      } else { echo  "<option value='' selected >Selecione</option>"; }
      $consulta2_sql = ("SELECT cod_empresa, nombre_empresa FROM tbl15_empresa ORDER BY nombre_empresa ASC");
      $consulta2 = mysqli_query($conectar, $consulta2_sql);
      while ($datos2 = mysqli_fetch_assoc($consulta2)) {
      if(isset($nombre_empresa) and $nombre_empresa == $datos2['nombre_empresa']) {
      $seleccionado = "selected"; } else { $seleccionado = ""; }
      $codigo = $datos2['nombre_empresa'];
      $nombre = $datos2['nombre_empresa'];
      echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
    <td style="text-align:center"><input class="input-block-level" type="date" name="fecha_ymd" value="<?php echo $fecha_ymd ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" type="time" name="fecha_hora" value="<?php echo $fecha_hora ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
  </tr>
</table>
<br>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td>POR FAVOR RESPONDA LAS SIGUIENTES PREGUNTAS: (Marque x a la casilla que corresponda):</td>
  </tr>
</table>
<br>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td colspan="3">I. ANTECEDENTES PERSONALES OSTEOMUSCULARES:</td>
  </tr>
  <tr>
    <td><ul><li>Ha tenido problemas de columna (desviación, fractura, escoliosis, hernia, cirugías, etc.)</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonosteo_problem_column" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonosteo_problem_column=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonosteo_problem_column" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonosteo_problem_column=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Esguince, luxación fracturas, o proceso inflamatorio de alguna extremidad</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonosteo_esguience_luxac" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonosteo_esguience_luxac=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonosteo_esguience_luxac" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonosteo_esguience_luxac=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Ha presentado epicondilitis, túnel del carpo, tendinitis, manguito rotador. Hombro doloroso</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonosteo_epicondi_tunelcarp" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonosteo_epicondi_tunelcarp=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonosteo_epicondi_tunelcarp" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonosteo_epicondi_tunelcarp=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Le han diagnosticado enfermedad en los huesos, articulaciones o los músculos</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonosteo_enferm_huesos" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonosteo_enferm_huesos=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonosteo_enferm_huesos" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonosteo_enferm_huesos=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Ha sufrido lesión deportiva o trauma importante</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonosteo_lesion_deport" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonosteo_lesion_deport=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonosteo_lesion_deport" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonosteo_lesion_deport=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center">Cual: <input class="input-block-level" type="text" name="antecpersonosteo_lesion_deport_cual" value="<?php echo $antecpersonosteo_lesion_deport_cual ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
  </tr>
</table>
<br>
<!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td colspan="2">II. ANTECEDENTES PERSONALES NEUROLOGICOS, PSIQUIATRICOS, PSICOLOGICOS</td>
  </tr>
  <tr>
    <td><ul><li>Temor a las alturas o espacios cerrados</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonneurol_temor_altura" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonneurol_temor_altura=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonneurol_temor_altura" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonneurol_temor_altura=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Epilepsia(convulsiones), Migrañas, Accidentes Cerebro-vascular(Derrames e isquemia cerebral)</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonneurol_epilespsia" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonneurol_epilespsia=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonneurol_epilespsia" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonneurol_epilespsia=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Ansiedad, Depresión, alguna enfermedad neurológica o psiquiátrica</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonneurol_ansiedad" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonneurol_ansiedad=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonneurol_ansiedad" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonneurol_ansiedad=='NO')?'checked':'' ?> /></td>
  </tr>
</table>
<br>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td colspan="3">III. ANTECEDENTES  PERSONALES CARDIOVASCULARES Y PULMONARES:</td>
  </tr>
  <tr>
    <td><ul><li>Enfermedades del corazón (Infartos, arritmias, soplos, alteración de válvulas cardiacas)</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersoncardiov_enf_corazon" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersoncardiov_enf_corazon=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersoncardiov_enf_corazon" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersoncardiov_enf_corazon=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Asma, venas varices, neumonía</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersoncardiov_asma" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersoncardiov_asma=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersoncardiov_asma" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersoncardiov_asma=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Hipertensión arterial</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersoncardiov_hiperarter" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersoncardiov_hiperarter=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersoncardiov_hiperarter" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersoncardiov_hiperarter=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Otras enfermedades pulmonares especifique</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersoncardiov_otra_enfer" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersoncardiov_otra_enfer=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersoncardiov_otra_enfer" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersoncardiov_otra_enfer=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center">Cual: <input class="input-block-level" type="text" name="antecpersoncardiov_otra_enfer_cual" value="<?php echo $antecpersoncardiov_otra_enfer_cual ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
  </tr>
</table>
<br>
<!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td colspan="2">IV. ANTECEDENTES PERSONALES DEL SISTEMA ENDOCRINO Y OTROS SISTEMAS</td>
  </tr>
  <tr>
    <td><ul><li>Diabetes (Azúcar elevada), e Hipoglucemias (Azúcar baja)</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonendocrino_diabete" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonendocrino_diabete=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonendocrino_diabete" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonendocrino_diabete=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Anemia (cansancio fácil, palidez) </li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonendocrino_anemia" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonendocrino_anemia=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonendocrino_anemia" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonendocrino_anemia=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Hiperuricemia (Gota acido úrico elevado)</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonendocrino_hiperuricemia" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonendocrino_hiperuricemia=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonendocrino_hiperuricemia" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonendocrino_hiperuricemia=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Alteración de la tiroides(hipertiroidismo, hipotiroidismo)</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonendocrino_alter_tiroid" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonendocrino_alter_tiroid=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonendocrino_alter_tiroid" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonendocrino_alter_tiroid=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Cáncer, Tumor o Leucemia</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonendocrino_cancer" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonendocrino_cancer=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonendocrino_cancer" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonendocrino_cancer=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Piel amarilla por Ictericia, cálculos en la vesícula, hepatitis </li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonendocrino_piel_amarilla" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonendocrino_piel_amarilla=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonendocrino_piel_amarilla" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonendocrino_piel_amarilla=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Cálculos cólicos o infecciones renales</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonendocrino_calc_colicos" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonendocrino_calc_colicos=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonendocrino_calc_colicos" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonendocrino_calc_colicos=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Hipertrofia de próstata (Esfuerzo al orinar, disminución del grosor del chorro</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonendocrino_hipertrof_prost" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonendocrino_hipertrof_prost=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonendocrino_hipertrof_prost" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonendocrino_hipertrof_prost=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Enfermedades de la piel</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonendocrino_enf_piel" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonendocrino_enf_piel=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonendocrino_enf_piel" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonendocrino_enf_piel=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Problemas renales e intestinales (cólicos, infecciones, hernias, ulceras</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonendocrino_problem_renal" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonendocrino_problem_renal=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonendocrino_problem_renal" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonendocrino_problem_renal=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Reflujo, gastritis y colon irritable</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonendocrino_reflujo" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonendocrino_reflujo=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonendocrino_reflujo" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonendocrino_reflujo=='NO')?'checked':'' ?> /></td>
  </tr>
</table>
<br>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td colspan="2">V. ANTECEDENTES PERSONALES DE LOS OIDOS NARIZ Y OJOS:</td>
  </tr>
  <tr>
    <td><ul><li>Problemas de oídos (Cerumen, Infecciones, Traumas y Cirugías)</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonoidnarisojos_problem_oido" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonoidnarisojos_problem_oido=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonoidnarisojos_problem_oido" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonoidnarisojos_problem_oido=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Vértigo, Disminución para escuchar (Sordera)</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonoidnarisojos_vertigo" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonoidnarisojos_vertigo=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonoidnarisojos_vertigo" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonoidnarisojos_vertigo=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Dificultad para la visión, usa gafas o lentes de contacto o se los han formulado</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonoidnarisojos_dificul_vision" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonoidnarisojos_dificul_vision=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonoidnarisojos_dificul_vision" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonoidnarisojos_dificul_vision=='NO')?'checked':'' ?> /></td>
  </tr>
  <tr>
    <td><ul><li>Tiene problemas en los ojos, (Pterigio, glaucoma, ardor, cataratas)</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersonoidnarisojos_problem_ojos" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersonoidnarisojos_problem_ojos=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersonoidnarisojos_problem_ojos" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersonoidnarisojos_problem_ojos=='NO')?'checked':'' ?> /></td>
  </tr>
</table>
<br>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td colspan="4">VI. ANTECEDENTES PERSONALES DE INMUNIZACION</td>
  </tr>
  <tr>
    <td>Se ha aplicado alguna vacuna en los últimos 10 años?</td>
    <td style="text-align:center">SI<input type="radio" name="antecpersoninmunizac_vacum10anyos" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersoninmunizac_vacum10anyos=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersoninmunizac_vacum10anyos" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersoninmunizac_vacum10anyos=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center">Cual: ?<input class="input-block-level" type="text" name="antecpersoninmunizac_vacum10anyos_cual" value="<?php echo $antecpersoninmunizac_vacum10anyos_cual ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td style="text-align:center">Fecha ?<input class="input-block-level" type="date" name="antecpersoninmunizac_vacum10anyos_fecha" value="<?php echo $antecpersoninmunizac_vacum10anyos_fecha ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
  </tr>
</table>
<br>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td colspan="5">VII. ANTECEDENTES PERSONALES GENERALES:</td>
  </tr>
  <tr>
    <td><ul><li>Usted sufre de alguna enfermedad no relacionada anteriormente</li></ul></td>
    <td style="text-align:center; width:10%">SI<input type="radio" name="antecpersongeneral_sufre_enf_menson_ant" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersongeneral_sufre_enf_menson_ant=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersongeneral_sufre_enf_menson_ant" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersongeneral_sufre_enf_menson_ant=='NO')?'checked':'' ?> /></td>
    <td>Cual: <input class="input-block-level" type="text" name="antecpersongeneral_sufre_enf_menson_ant_cual" value="<?php echo $antecpersongeneral_sufre_enf_menson_ant_cual ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Le han transfundido sangre</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersongeneral_tranf_sangre" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersongeneral_tranf_sangre=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersongeneral_tranf_sangre" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersongeneral_tranf_sangre=='NO')?'checked':'' ?> /></td>
    <td>Causa <input class="input-block-level" type="text" name="antecpersongeneral_tranf_sangre_fecha_causa" value="<?php echo $antecpersongeneral_tranf_sangre_fecha_causa ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td>Presentó reacción <input class="input-block-level" type="text" name="antecpersongeneral_presen_reaccion" value="<?php echo $antecpersongeneral_presen_reaccion ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td>Fecha <input class="input-block-level" type="date" name="antecpersongeneral_tranf_sangre_fecha" value="<?php echo $antecpersongeneral_tranf_sangre_fecha ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
  </tr>
  <tr>
    <td><ul><li>Se encuentra en tratamiento o seguimiento médico </li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersongeneral_trata_segui_medic" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersongeneral_trata_segui_medic=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersongeneral_trata_segui_medic" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersongeneral_trata_segui_medic=='NO')?'checked':'' ?> /></td>
    <td>Cual: <input class="input-block-level" type="text" name="antecpersongeneral_trata_segui_medic_cual" value="<?php echo $antecpersongeneral_trata_segui_medic_cual ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Le han dicho que tenía que operarse o lo han operado?</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersongeneral_dicho_operarse_operado" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersongeneral_dicho_operarse_operado=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersongeneral_dicho_operarse_operado" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersongeneral_dicho_operarse_operado=='NO')?'checked':'' ?> /></td>
    <td>De que <input class="input-block-level" type="text" name="antecpersongeneral_dicho_operarse_operado_cual" value="<?php echo $antecpersongeneral_dicho_operarse_operado_cual ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Alguna vez ha tbl15_estado hospitalizado en una clínica </li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersongeneral_alguna_hospitaliza_clinic" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersongeneral_alguna_hospitaliza_clinic=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersongeneral_alguna_hospitaliza_clinic" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersongeneral_alguna_hospitaliza_clinic=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Es alérgico a algo? Químicos, insectos, medicamentos, polvos, metales, mariscos, maní, condimentos</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersongeneral_alergico_algo" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersongeneral_alergico_algo=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersongeneral_alergico_algo" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersongeneral_alergico_algo=='NO')?'checked':'' ?> /></td>
    <td>Cual: <input class="input-block-level" type="text" name="antecpersongeneral_alergico_algo_cual" value="<?php echo $antecpersongeneral_alergico_algo_cual ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Toma algún tbl15_medicamento actualmente?</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersongeneral_medicament_actualm" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersongeneral_medicament_actualm=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersongeneral_medicament_actualm" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersongeneral_medicament_actualm=='NO')?'checked':'' ?> /></td>
    <td>Cual: <input class="input-block-level" type="text" name="antecpersongeneral_medicament_actualm_cual" value="<?php echo $antecpersongeneral_medicament_actualm_cual ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Sufre actualmente de algún deterioro físico o mental que pueda limitar su capacidad laboral</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersongeneral_sufre_deter_fisico" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersongeneral_sufre_deter_fisico=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersongeneral_sufre_deter_fisico" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersongeneral_sufre_deter_fisico=='NO')?'checked':'' ?> /></td>
    <td>Cual: <input class="input-block-level" type="text" name="antecpersongeneral_sufre_deter_fisico_cual" value="<?php echo $antecpersongeneral_sufre_deter_fisico_cual ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Le han calificado por pérdida de capacidad laboral, o se encuentra en proceso </li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersongeneral_calif_perdcapc_lab" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersongeneral_calif_perdcapc_lab=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersongeneral_calif_perdcapc_lab" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersongeneral_calif_perdcapc_lab=='NO')?'checked':'' ?> /></td>
    <td>Cual: <input class="input-block-level" type="text" name="antecpersongeneral_calif_perdcapc_lab_cual" value="<?php echo $antecpersongeneral_calif_perdcapc_lab_cual ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>Ha tenido reportes a la ARL de las empresas donde ha laborado? </li></ul></td>
        <td style="text-align:center">SI<input type="radio" name="antecpersongeneral_repor_arl_empresa" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersongeneral_repor_arl_empresa=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersongeneral_repor_arl_empresa" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersongeneral_repor_arl_empresa=='NO')?'checked':'' ?> /></td>
    <td>Cual: <input class="input-block-level" type="text" name="antecpersongeneral_repor_arl_empresa_cual" value="<?php echo $antecpersongeneral_repor_arl_empresa_cual ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>han calificado por EPS/ARL alguna enfermedad relacionada con el trabajo en enfermedad laboral</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="antecpersongeneral_calif_eps_arl_enf_trab" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($antecpersongeneral_calif_eps_arl_enf_trab=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="antecpersongeneral_calif_eps_arl_enf_trab" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($antecpersongeneral_calif_eps_arl_enf_trab=='NO')?'checked':'' ?> /></td>
    <td>Cual: <input class="input-block-level" type="text" name="antecpersongeneral_calif_eps_arl_enf_trab_cual" value="<?php echo $antecpersongeneral_calif_eps_arl_enf_trab_cual ?>" id="<?php echo $cod_consentimiento_informado ?>"/></td>
    <td style="text-align:center"></td>
    <td style="text-align:center"></td>
  </tr>
</table>

<br>

<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td colspan="3">VIII. HA TENIDO ALGUNOS DE ESTOS SIGNOS O SINTOMATOLOGIA:</td>
  </tr>
  <tr>
    <td><ul><li>FIEBRE</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_fiebre" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_fiebre=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_fiebre" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_fiebre=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>ESCALOFRIOS</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_escolofrio" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_escolofrio=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_escolofrio" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_escolofrio=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>CANSANCIO</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_cansansio" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_cansansio=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_cansansio" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_cansansio=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>MALESTAR GENERAL</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_malestar_gral" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_malestar_gral=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_malestar_gral" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_malestar_gral=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>FATIGA</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_fatiga" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_fatiga=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_fatiga" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_fatiga=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>TOS SECA</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_tos_seca" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_tos_seca=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_tos_seca" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_tos_seca=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>CEFALEAS</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_cefaleas" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_cefaleas=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_cefaleas" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_cefaleas=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>CONGESTION NASAL</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_congestion_nasal" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_congestion_nasal=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_congestion_nasal" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_congestion_nasal=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>SECRECIONES NASALES</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_secrecion_nasal" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_secrecion_nasal=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_secrecion_nasal" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_secrecion_nasal=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>DOLOR DE GARGANTA</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_dorlor_garganta" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_dorlor_garganta=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_dorlor_garganta" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_dorlor_garganta=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>DIARREA</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_diarrea" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_diarrea=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_diarrea" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_diarrea=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>DIFICULTAD RESPIRATORIA</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_dificul_resp" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_dificul_resp=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_dificul_resp" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_dificul_resp=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>INAPETENCIA</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_inapetencia" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_inapetencia=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_inapetencia" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_inapetencia=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>PERDIDA DEL OLFATO</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_perdida_olfato" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_perdida_olfato=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_perdida_olfato" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_perdida_olfato=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>PERDIDA EL GUSTO</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_perdida_gusto" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_perdida_gusto=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_perdida_gusto" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_perdida_gusto=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>DEDOS DE COVID(MORETONES EN CUALQUIER SITIO DEL CUERPO</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_dedos_covid" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_dedos_covid=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_dedos_covid" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_dedos_covid=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>DOLOR TORÁCICO</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_dolor_pecho" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_dolor_pecho=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_dolor_pecho" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_dolor_pecho=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>CONFUSION</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_confusion" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_confusion=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_confusion" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_confusion=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><ul><li>COLORACION AZULADA EN LABIOS O EL ROSTRO</li></ul></td>
    <td style="text-align:center">SI<input type="radio" name="covid19_color_azul_labios" id="<?php echo $cod_consentimiento_informado ?>" value="SI" <?php echo ($covid19_color_azul_labios=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;
  NO<input type="radio" name="covid19_color_azul_labios" id="<?php echo $cod_consentimiento_informado ?>" value="NO" <?php echo ($covid19_color_azul_labios=='NO')?'checked':'' ?> /></td>
    <td style="text-align:center"></td>
  </tr>
</table>
<br>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td>VIII. POLITICA DE PROTECCION DE DATOS.</td>
  </tr>
  <tr>
    <td>Me acojo a las disposiciones establecidas en la ley 1581 de 2012, (Art. 2, 6, 13, 17, y    18) 
      y su decreto reglamentario 1377 del 2013, art 4, 13), hablan de la entrada en vigencia del régimen 
      general de protección de datos personales desarrollando el derecho constitucional que tiene toda persona 
      a conocer, actualizar y rectificar todo  tipo de información y que haya sido objeto de recolección en 
      base de datos o archivos de entidades públicas o privadas.<br />
      Soy responsable del tratamiento de datos personales recolectados con ocasión de la prestación de servicios 
      en salud ocupacional, se da a conocer a sus clientes y pacientes, la importancia del proceso dando 
      cumplimiento a las disposiciones legales vigentes garantizando la confidencialidad de la información 
      registrada en la historia clínica y sus anexos.<br />
      Como son datos sensibles, no se realiza el tratamientos de estos datos para fines diferentes a los 
      establecido por la legislación vigente, estos pueden ser conocidos por terceros con previa 
      autorización del paciente o en los casos provistos por la ley.</td>
  </tr>
</table>
<br>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td>IX. CONSENTIMIENTO INFORMADO.</td>
  </tr>
  <tr>
    <td>Yo <?php echo $nom_ape ?>, con documento de identificación No <?php echo $cedula ?> en 
      calidad de paciente/usuario previamente informado acepto que estos datos sean  empleados para fines 
      estrictamente citados en materia de salud ocupacional.<br />
      Además certifico que he sido informado (a) a cerca de la naturaleza y propósito de estos exámenes, 
      entiendo que la realización de los mismos es voluntaria y tuve la oportunidad de retirar mi 
      consentimiento en cualquier momento, certifico que las respuestas son verídicas. Este documento es 
      estrictamente confidencial.</td>
  </tr>
</table>
<br>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<table align="center" border="1" cellspacing="0" width="100%" style="font-family: Mono; font-size: 11pt;">
  <tr>
    <td style="text-align:center">Firma del Paciente:</td>
    <td style="text-align:center">Huella índice derecho</td>
  </tr>
  <tr>
    <td style="text-align:center"><img src="<?php echo $url_img_firma_min_cli ?>" height="90px"/></td>
    <td style="text-align:center"></td>
  </tr>
</table>
<!-- ********************************************************************************************** -->
<!-- ********************************************************************************************** -->
<input type="hidden" name="cod_consentimiento_informado" value="<?php echo $cod_consentimiento_informado ?>">
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>">
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>">
<!--<input type="hidden" name="pagina" value="<?php echo $pagina ?>">-->
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
</form>
<!-- ********************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ********************************************************************************************** -->

<!-- ********************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ********************************************************************************************** -->
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
<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#fecha_ymd_hora').datetimepicker({ format: 'yyyy/MM/dd', language: 'es' });</script>
<!-- 1*********************************************************************** -->
</body>
</html>

<script type="text/javascript">
$(document).ready(function() {

$("input").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_consentimiento_informado_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_consentimiento_informado ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

$("select").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_consentimiento_informado_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_consentimiento_informado ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

$("textarea").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_consentimiento_informado_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_consentimiento_informado ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

});
</script>