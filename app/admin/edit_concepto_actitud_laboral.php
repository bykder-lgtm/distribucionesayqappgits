<?php $serguridad_pagina = 1; ?> 
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
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

<div class="breadcrumbs">
<a href="#"><h4>Concepto de Aptitud Laboral&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_historia_clinica                  = intval($_GET['cod_historia_clinica']);
$cod_actitud_laboral                   = intval($_GET['cod_actitud_laboral']);
$cod_cliente                           = intval($_GET['cod_cliente']);
$pagina                                = $_SERVER['PHP_SELF'];

$obtener_concepto_actitud_laboral = "SELECT nombre_empresa, cargo_empresa, area_empresa, ciudad_empresa, nombre_empresa_contratante, motivo, cod_cliente,  
cod_administrador FROM tbl15_historia_clinica WHERE cod_historia_clinica = '".($cod_historia_clinica)."'";
$consultar_concepto_actitud_laboral = mysqli_query($conectar, $obtener_concepto_actitud_laboral) or die(mysqli_error($conectar));
$info_concepto_actitud_laboral= mysqli_fetch_assoc($consultar_concepto_actitud_laboral);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_prof = "SELECT nombres AS nombre_prof, apellidos AS apellidos_prof FROM tbl15_administrador WHERE cod_administrador = '".($cod_administrador)."'";
$consultar_prof = mysqli_query($conectar, $obtener_prof) or die(mysqli_error($conectar));
$info_prof = mysqli_fetch_assoc($consultar_prof);

$nombre_prof                           = $info_prof['nombre_prof'];
$apellidos_prof                        = $info_prof['apellidos_prof'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_cedula = "SELECT cedula, nombres, apellido1, apellido2, nombre_tipo_doc, url_img_firma_min AS url_img_firma_min_cli FROM tbl15_cliente WHERE cod_cliente = '".($cod_cliente)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$cedula                               = $info_cliente['cedula'];
$nombres                              = $info_cliente['nombres'];
$apellido1                            = $info_cliente['apellido1'];
$apellido2                            = $info_cliente['apellido2'];
$nombre_tipo_doc                      = $info_cliente['nombre_tipo_doc'];
$url_img_firma_min_cli                = $info_cliente['url_img_firma_min_cli'];
$nom_ape                              = $nombres.' '.$apellido1.' '.$apellido2;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_actitud_laboral = "SELECT * FROM tbl15_actitud_laboral WHERE cod_actitud_laboral = '".($cod_actitud_laboral)."'";
$consultar_actitud_laboral = mysqli_query($conectar, $obtener_actitud_laboral) or die(mysqli_error($conectar));
$info_actitud_laboral= mysqli_fetch_assoc($consultar_actitud_laboral);

$cod_actitud_laboral                  = $info_actitud_laboral['cod_actitud_laboral'];
$cod_historia_clinica                 = $info_actitud_laboral['cod_historia_clinica'];
$cod_cliente                          = $info_actitud_laboral['cod_cliente'];
$cod_administrador                    = $info_actitud_laboral['cod_administrador'];
$motivo                               = $info_actitud_laboral['motivo_actilab'];
$motivo_actilab                       = $info_actitud_laboral['motivo_actilab'];
$aptdesemp_carg                       = $info_actitud_laboral['aptdesemp_carg'];
$present_restric                      = $info_actitud_laboral['present_restric'];
$aplazad                              = $info_actitud_laboral['aplazad'];
$contin_lab1                          = $info_actitud_laboral['contin_lab1'];
$aplaz1                               = $info_actitud_laboral['aplaz1'];
$resig_tarea1                         = $info_actitud_laboral['resig_tarea1'];
$temporal1                            = $info_actitud_laboral['temporal1'];
$contin_lab2                          = $info_actitud_laboral['contin_lab2'];
$aplaz2                               = $info_actitud_laboral['aplaz2'];
$resig_tarea2                         = $info_actitud_laboral['resig_tarea2'];
$temporal2                            = $info_actitud_laboral['temporal2'];
$rein_trab                            = $info_actitud_laboral['rein_trab'];
$aplaz3                               = $info_actitud_laboral['aplaz3'];
$resig_tarea3                         = $info_actitud_laboral['resig_tarea3'];
$temporal3                            = $info_actitud_laboral['temporal3'];
$realiz                               = $info_actitud_laboral['realiz'];
$exacomple_opto                       = $info_actitud_laboral['exacomple_opto'];
$exacomple_espiro                     = $info_actitud_laboral['exacomple_espiro'];
$exacomple_audi                       = $info_actitud_laboral['exacomple_audi'];
$exacomple_psico                      = $info_actitud_laboral['exacomple_psico'];
$exacomple_visio                      = $info_actitud_laboral['exacomple_visio'];
$exacomple_lab                        = $info_actitud_laboral['exacomple_lab'];
$exacomple_otro                       = $info_actitud_laboral['exacomple_otro'];
$acuedenfa_altu_apto                  = $info_actitud_laboral['acuedenfa_altu_apto'];
$acuedenfa_altu_nocump                = $info_actitud_laboral['acuedenfa_altu_nocump'];
$acuedenfa_altu_aplaz                 = $info_actitud_laboral['acuedenfa_altu_aplaz'];
$acuedenfa_altu_obser                 = $info_actitud_laboral['acuedenfa_altu_obser'];
$acuedenfa_aliment_apto               = $info_actitud_laboral['acuedenfa_aliment_apto'];
$acuedenfa_aliment_nocump             = $info_actitud_laboral['acuedenfa_aliment_nocump'];
$acuedenfa_aliment_aplaz              = $info_actitud_laboral['acuedenfa_aliment_aplaz'];
$acuedenfa_aliment_obser              = $info_actitud_laboral['acuedenfa_aliment_obser'];
$acuedenfa_alime_apto                 = $info_actitud_laboral['acuedenfa_alime_apto'];
$acuedenfa_alime_nocump               = $info_actitud_laboral['acuedenfa_alime_nocump'];
$acuedenfa_alime_aplaz                = $info_actitud_laboral['acuedenfa_alime_aplaz'];
$acuedenfa_alime_obser                = $info_actitud_laboral['acuedenfa_alime_obser'];
$acuedenfa_medica_apto                = $info_actitud_laboral['acuedenfa_medica_apto'];
$acuedenfa_medica_nocump              = $info_actitud_laboral['acuedenfa_medica_nocump'];
$acuedenfa_medica_aplaz               = $info_actitud_laboral['acuedenfa_medica_aplaz'];
$acuedenfa_medica_obser               = $info_actitud_laboral['acuedenfa_medica_obser'];
$acuedenfa_realiz                     = $info_actitud_laboral['acuedenfa_realiz'];
$acuedenfa_realiz_obser               = $info_actitud_laboral['acuedenfa_realiz_obser'];
$acuedenfa_espconf_apto               = $info_actitud_laboral['acuedenfa_espconf_apto'];
$acuedenfa_espconf_nocump             = $info_actitud_laboral['acuedenfa_espconf_nocump'];
$acuedenfa_espconf_aplaz              = $info_actitud_laboral['acuedenfa_espconf_aplaz'];
$acuedenfa_espconf_obser              = $info_actitud_laboral['acuedenfa_espconf_obser'];
$acuedenfa_brigad_apto                = $info_actitud_laboral['acuedenfa_brigad_apto'];
$acuedenfa_brigad_nocump              = $info_actitud_laboral['acuedenfa_brigad_nocump'];
$acuedenfa_brigad_aplaz               = $info_actitud_laboral['acuedenfa_brigad_aplaz'];
$acuedenfa_brigad_obser               = $info_actitud_laboral['acuedenfa_brigad_obser'];
$acuedenfa_actdepor_apto              = $info_actitud_laboral['acuedenfa_actdepor_apto'];
$acuedenfa_actdepor_nocump            = $info_actitud_laboral['acuedenfa_actdepor_nocump'];
$acuedenfa_actdepor_aplaz             = $info_actitud_laboral['acuedenfa_actdepor_aplaz'];
$acuedenfa_actdepor_obser             = $info_actitud_laboral['acuedenfa_actdepor_obser'];
$acuedenfa_segvial_apto               = $info_actitud_laboral['acuedenfa_segvial_apto'];
$acuedenfa_segvial_nocump             = $info_actitud_laboral['acuedenfa_segvial_nocump'];
$acuedenfa_segvial_aplaz              = $info_actitud_laboral['acuedenfa_segvial_aplaz'];
$acuedenfa_segvial_obser              = $info_actitud_laboral['acuedenfa_segvial_obser'];
$enfosteo_contperocupa                = $info_actitud_laboral['enfosteo_contperocupa'];
$enfosteo_contperpromprev             = $info_actitud_laboral['enfosteo_contperpromprev'];
$enfosteo_habnutsalud                 = $info_actitud_laboral['enfosteo_habnutsalud'];
$enfosteo_eppelemprot                 = $info_actitud_laboral['enfosteo_eppelemprot'];
$enfosteo_manejmedic                  = $info_actitud_laboral['enfosteo_manejmedic'];
$enfosteo_ejerreg                     = $info_actitud_laboral['enfosteo_ejerreg'];
$enfosteo_dejhabitfum                 = $info_actitud_laboral['enfosteo_dejhabitfum'];
$enfosteo_contnutrieps                = $info_actitud_laboral['enfosteo_contnutrieps'];
$enfosteo_redconsualcoh               = $info_actitud_laboral['enfosteo_redconsualcoh'];
$enfosteo_realpruebcomp               = $info_actitud_laboral['enfosteo_realpruebcomp'];
$enfosteo_remieps                     = $info_actitud_laboral['enfosteo_remieps'];
$enfosteo_contperpypeps               = $info_actitud_laboral['enfosteo_contperpypeps'];
$enfosteo_remiepsmedigenesp           = $info_actitud_laboral['enfosteo_remiepsmedigenesp'];
$enfosteo_eppcarg                     = $info_actitud_laboral['enfosteo_eppcarg'];
$enfosteo_pausactiva                  = $info_actitud_laboral['enfosteo_pausactiva'];
$enfosteo_ingrepve                    = $info_actitud_laboral['enfosteo_ingrepve'];
$enfosteo_pausaergo                   = $info_actitud_laboral['enfosteo_pausaergo'];
$enfosteo_bloqsolar                   = $info_actitud_laboral['enfosteo_bloqsolar'];
$enfosteo_recommanejcarg              = $info_actitud_laboral['enfosteo_recommanejcarg'];
$enfosteo_observ                      = $info_actitud_laboral['enfosteo_observ'];
$prio_osteo                           = $info_actitud_laboral['prio_osteo'];
$prio_manialiment                     = $info_actitud_laboral['prio_manialiment'];
$prio_visual                          = $info_actitud_laboral['prio_visual'];
$prio_altura                          = $info_actitud_laboral['prio_altura'];
$prio_piel                            = $info_actitud_laboral['prio_piel'];
$prio_resp                            = $info_actitud_laboral['prio_resp'];
$prio_biolog                          = $info_actitud_laboral['prio_biolog'];
$prio_tempextem                       = $info_actitud_laboral['prio_tempextem'];
$prio_espconfi                        = $info_actitud_laboral['prio_espconfi'];
$prio_cuidvoz                         = $info_actitud_laboral['prio_cuidvoz'];
$prio_quim                            = $info_actitud_laboral['prio_quim'];
$prio_audi                            = $info_actitud_laboral['prio_audi'];
$recomend_emp                         = $info_actitud_laboral['recomend_emp'];
$recomend_trab                        = $info_actitud_laboral['recomend_trab'];
$fecha_mes                            = $info_actitud_laboral['fecha_mes'];
$fecha_anyo                           = $info_actitud_laboral['fecha_anyo'];
$fecha_ymd                            = $info_actitud_laboral['fecha_ymd'];
$fecha_dmy                            = $info_actitud_laboral['fecha_dmy'];
$fecha_time                           = $info_actitud_laboral['fecha_time'];
$fecha_reg_time                       = $info_actitud_laboral['fecha_reg_time'];
$cuenta                               = $info_actitud_laboral['cuenta'];
$cuenta_reg                           = $info_actitud_laboral['cuenta_reg'];
$nombre_condicion_salud               = $info_actitud_laboral['nombre_condicion_salud'];
$comentario_nombre_condicion_salud    = $info_actitud_laboral['comentario_nombre_condicion_salud'];
$enfosteo_habito_vida_saludable       = $info_actitud_laboral['enfosteo_habito_vida_saludable'];
$prio_otro                            = $info_actitud_laboral['prio_otro'];
$prio_otro_descripcion                = $info_actitud_laboral['prio_otro_descripcion'];
$temporal1_num                        = $info_actitud_laboral['temporal1_num'];
$temporal2_num                        = $info_actitud_laboral['temporal2_num'];
$temporal3_num                        = $info_actitud_laboral['temporal3_num'];
$cod_grupo_area                       = $info_actitud_laboral['cod_grupo_area'];
$cod_grupo_area_cargo                 = $info_actitud_laboral['cod_grupo_area_cargo'];
$costo_motivo_consulta                = $info_actitud_laboral['costo_motivo_consulta'];
$cod_factura                          = $info_actitud_laboral['cod_factura'];
$nombre_ocupacion                     = $info_actitud_laboral['nombre_ocupacion'];
$nombre_empresa                       = $info_actitud_laboral['nombre_empresa'];
$cargo_empresa                        = $info_actitud_laboral['cargo_empresa'];
$area_empresa                         = $info_actitud_laboral['area_empresa'];
$ciudad_empresa                       = $info_actitud_laboral['ciudad_empresa'];
$nombre_empresa_contratante           = $info_actitud_laboral['nombre_empresa_contratante'];
$enfosteo_retroparaclinicexamen       = $info_actitud_laboral['enfosteo_retroparaclinicexamen'];

if ($fecha_ymd == '') { $fecha_ymd = date("Y/m/d"); } 
else { $fecha_ymd = $fecha_ymd; } ?>
<!--<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_asignar_profesional_paciente_reg.php">-->
<form name="frmSubir" method="post" enctype="multipart/form-data" action="edit_concepto_actitud_laboral_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td colspan="3" style="text-align:center"><strong>Empresa Contratante:</strong></td>

<td colspan="2" style="text-align:center">
<select name="nombre_empresa_contratante" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_empresa_contratante)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_empresa_contratante, nombre_empresa_contratante FROM tbl15_empresa_contratante ORDER BY nombre_empresa_contratante ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_empresa_contratante) and $nombre_empresa_contratante == $datos2['nombre_empresa_contratante']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_empresa_contratante'];
$nombre = $datos2['nombre_empresa_contratante'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>
    <td colspan="2" style="text-align:center"><strong>FECHA:</strong></td>
    <td style="text-align:center"><td><div id="fecha_ymd" class="input-append date"><input type="text" name="fecha_ymd" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $fecha_ymd ?>"></input><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div></td></td>
    <td colspan="2"><strong>[APT - <?php echo ($cod_actitud_laboral) ?>] - [HC - <?php echo ($cod_historia_clinica) ?>]</strong></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center"><strong>Empresa a Laborar:</strong></td>

<td colspan="2" style="text-align:center">
<select name="nombre_empresa" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
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
    <td colspan="5"><strong>&nbsp;</strong></td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:center"><strong>TIPO DE EXAMEN:</strong></td>
        <td colspan="8">
<select name="motivo_actilab" id="<?php echo $cod_actitud_laboral ?>" required>
<?php if (isset($motivo_actilab)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_motivo_consulta, motivo FROM tbl15_motivo_consulta ORDER BY motivo ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($motivo_actilab) and $motivo_actilab == $datos2['motivo']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['motivo'];
$nombre = $datos2['motivo'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
    </td>
  </tr>
  <tr>
    <td style="text-align:center"><strong>NOMBRE:</strong></td>
    <td colspan="3" style="text-align:center"><strong><?php echo ($nombres) ?> <?php echo ($apellido1) ?></strong></td>
    <td colspan="2" style="text-align:center"><strong><?php echo ($nombre_tipo_doc) ?>:</strong></td>
    <td colspan="4"><strong><?php echo ($cedula) ?></strong></td>
  </tr>
  <tr>
    <td style="text-align:center"><strong>CARGO:</strong></td>
<td colspan="3" style="text-align:center">
<select name="cod_grupo_area_cargo" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($cod_grupo_area_cargo)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT tbl15_grupo_area.nombre_grupo_area, tbl15_grupo_area_cargo.nombre_grupo_area_cargo, tbl15_grupo_area_cargo.cod_grupo_area_cargo
FROM tbl15_grupo_area RIGHT JOIN tbl15_grupo_area_cargo ON tbl15_grupo_area.cod_grupo_area = tbl15_grupo_area_cargo.cod_grupo_area");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_grupo_area_cargo) and $cod_grupo_area_cargo == $datos2['cod_grupo_area_cargo']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_grupo_area_cargo'];
$nombre = $datos2['nombre_grupo_area_cargo'];
$nombre2 = $datos2['nombre_grupo_area'];
echo "<option value='".$codigo."' $seleccionado >".$nombre2.' | '.$nombre."</option>"; } ?></select></td>

    <td colspan="2" style="text-align:center"><strong>CIUDAD:</strong></td>
    <td colspan="4"><input class="input-block-level" name="ciudad_empresa" type="text" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $ciudad_empresa ?>"/></td>
  </tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr><td bgcolor="#FAC090" colspan="14"><strong>CONCEPTOS GENERALES POR TIPO DE EXAMEN</strong></td>
  </tr>
  <tr><td bgcolor="#FAC090" colspan="14"><strong>Examen de <?php echo $motivo ?></strong></td></tr>
  <tr>
    <td colspan="5"><strong>Condición de salud sin restricciones</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="aptdesemp_carg" class="aptdesemp_carg" id="<?php echo $cod_actitud_laboral ?>" class="aaa" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($aptdesemp_carg=='X'){ echo "checked"; } ?> /></td>
    <td colspan="5"><strong>Condición de salud con restricción que no interfiere con su cargo</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="present_restric" class="present_restric" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($present_restric=='X'){ echo "checked"; } ?> /></td>
    <td colspan="5"><strong>Condición de salud con restricción que interfiere con su cargo</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="aplazad" class="aplazad" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($aplazad=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td colspan="15"><input class="input-block-level" name="comentario_nombre_condicion_salud" type="text" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $comentario_nombre_condicion_salud ?>"/></td>
  </tr>
  <tr><td style="text-align:center" colspan="14"><strong>1.2 Examen Periódico</strong></td></tr>
  <tr>
    <td colspan="3"><strong>Puede continuar laborando</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="contin_lab1" class="contin_lab1" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($contin_lab1=='X'){ echo "checked"; } ?> /></td>
    <td colspan="3"><strong>Aplazado</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="aplaz1" class="aplaz1" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($aplaz1=='X'){ echo "checked"; } ?> /></td>
    <td colspan="4"><strong>Reasignación de tareas</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="resig_tarea1" class="resig_tarea1" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($resig_tarea1=='X'){ echo "checked"; } ?> /></td>
    <td><strong>Temporalidad:</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="temporal1" class="temporal1" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($temporal1=='X'){ echo "checked"; } ?> />
<input class="" name="temporal1_num" type="number" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $temporal1_num ?>"/>
    </td>
  </tr>
  <tr><td colspan="14"><p align="center"><strong>1.3 Examen periódico seguimiento de recomendaciones</strong></td></tr>
  <tr>
    <td colspan="3"><strong>Puede continuar laborando</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="contin_lab2" class="contin_lab2" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($contin_lab2=='X'){ echo "checked"; } ?> /></td>
    <td colspan="3"><strong>Condición de salud con restricción que interfiere con su cargo</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="aplaz2" class="aplaz2" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($aplaz2=='X'){ echo "checked"; } ?> /></td>
    <td colspan="4"><strong>Reasignación de tareas</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="resig_tarea2" class="resig_tarea2" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($resig_tarea2=='X'){ echo "checked"; } ?> /></td>
    <td><strong>Temporalidad:</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="temporal2" class="temporal2" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($temporal2=='X'){ echo "checked"; } ?> />
<input class="" name="temporal2_num" type="number" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $temporal2_num ?>"/>
    </td>
  </tr>
  <tr><td colspan="14"><p align="center"><strong>1.4 Reintegro / Post &ndash; Incapacidad </strong></td></tr>
  <tr>
    <td colspan="5"><strong>Reincorporación al Puesto de trabajo</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="rein_trab" class="rein_trab" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($rein_trab=='X'){ echo "checked"; } ?> /></td>
    <td><strong>Condición de salud con restricción que interfiere con su cargo</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="aplaz3" class="aplaz3" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($aplaz3=='X'){ echo "checked"; } ?> /></td>
    <td colspan="4"><strong>Reasignación de tareas</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="resig_tarea3" class="resig_tarea3" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($resig_tarea3=='X'){ echo "checked"; } ?> /></td>
    <td><strong>Temporalidad:</strong>&nbsp;&nbsp;&nbsp;&nbsp;<input name="temporal3" class="temporal3" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($temporal3=='X'){ echo "checked"; } ?> /></strong>
<input class="" name="temporal3_num" type="number" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $temporal3_num ?>"/>
    </td>
  </tr>
  <tr><td style="text-align:center" colspan="14"><strong>1.5 EGRESO</strong></td></tr>
  <tr>
    <td><strong>Realizado&nbsp;&nbsp;&nbsp;&nbsp;<input name="realiz" class="realiz" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($realiz=='X'){ echo "checked"; } ?> /></strong></td>
    <td colspan="13"></td>
  </tr>
</table>

<table border="1" align="center" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:center" bgcolor="#FAC090" colspan="22"><strong>EXÁMENES COMPLEMENTARIOS</strong></td>
  </tr>
  <tr>
    <td colspan="3" valign="bottom"><strong>Optometría&nbsp;<input name="exacomple_opto" class="exacomple_opto" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($exacomple_opto=='X'){ echo "checked"; } ?> /></strong></td>
    <td colspan="4" valign="bottom"><strong>Espirometría&nbsp;<input name="exacomple_espiro" class="exacomple_espiro" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($exacomple_espiro=='X'){ echo "checked"; } ?> /></strong></td>
    <td colspan="3" valign="bottom"><strong>Audiometría&nbsp;<input name="exacomple_audi" class="exacomple_audi" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($exacomple_audi=='X'){ echo "checked"; } ?> /></strong></td>
    <td colspan="4" valign="bottom"><strong>Prueba Psicotécnica&nbsp;<input name="exacomple_psico" class="exacomple_psico" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($exacomple_psico=='X'){ echo "checked"; } ?> /></strong></td>
    <td colspan="3" valign="bottom"><strong>Visiometría&nbsp;<input name="exacomple_visio" class="exacomple_visio" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($exacomple_visio=='X'){ echo "checked"; } ?> /></strong></td>
    <td colspan="4" valign="bottom"><strong>Laboratorios&nbsp;<input name="exacomple_lab" class="exacomple_lab" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($exacomple_lab=='X'){ echo "checked"; } ?> /></strong></td>
    <td colspan="7" valign="bottom"><strong>Otros</strong>:<input class="input-block-level" name="exacomple_otro" type="text" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $exacomple_otro ?>"/></td>
  </tr>
</table>
  <!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr><td bgcolor="#FAC090" colspan="5"><strong>CONCEPTO DE ACUERDO AL ÉNFASIS</strong></td></tr>
  <tr>
    <td valign="bottom"><p align="center"><strong>Énfasis</strong></td>
    <td valign="bottom"><p align="center"><strong>Apto</strong></td>
    <td valign="bottom"><p align="center"><strong>No cumple</strong></td>
    <td valign="bottom"><p align="center"><strong>Condición de salud con restricción que interfiere con su cargo</strong></td>
    <td valign="bottom"><p align="center"><strong>Observaciones</strong></td>
  </tr>
  <tr>
    <td><strong>Seguridad vial</strong></td>
    <td style="text-align:center"><input name="acuedenfa_segvial_apto" class="acuedenfa_segvial_apto" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_segvial_apto=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_segvial_nocump" class="acuedenfa_segvial_nocump" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_segvial_nocump=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_segvial_aplaz" class="acuedenfa_segvial_aplaz" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_segvial_aplaz=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input class="input-block-level" name="acuedenfa_segvial_obser" type="text" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $acuedenfa_segvial_obser ?>"/></td>
  </tr>
  <tr>
    <td><strong>Espacios confinados</strong></td>
    <td style="text-align:center"><input name="acuedenfa_espconf_apto" class="acuedenfa_espconf_apto" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_espconf_apto=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_espconf_nocump" class="acuedenfa_espconf_nocump" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_espconf_nocump=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_espconf_aplaz" class="acuedenfa_espconf_aplaz" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_espconf_aplaz=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input class="input-block-level" name="acuedenfa_espconf_obser" type="text" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $acuedenfa_espconf_obser ?>"/></td>
  </tr>
  <tr>
    <td><strong>Alturas</strong></td>
    <td style="text-align:center"><input name="acuedenfa_altu_apto" class="acuedenfa_altu_apto" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_altu_apto=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_altu_nocump" class="acuedenfa_altu_nocump" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_altu_nocump=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_altu_aplaz" class="acuedenfa_altu_aplaz" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_altu_aplaz=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input class="input-block-level" name="acuedenfa_altu_obser" type="text" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $acuedenfa_altu_obser ?>"/></td>
  </tr>
  <tr>
    <td><strong>Alimentos</strong></td>
    <td style="text-align:center"><input name="acuedenfa_alime_apto" class="acuedenfa_alime_apto" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_alime_apto=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_alime_nocump" class="acuedenfa_alime_nocump" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_alime_nocump=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_alime_aplaz" class="acuedenfa_alime_aplaz" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_alime_aplaz=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input class="input-block-level" name="acuedenfa_alime_obser" type="text" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $acuedenfa_alime_obser ?>"/></td>
  </tr>
  <tr>
    <td><strong>Actividad deportiva</strong></td>
    <td style="text-align:center"><input name="acuedenfa_actdepor_apto" class="acuedenfa_actdepor_apto" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_actdepor_apto=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_actdepor_nocump" class="acuedenfa_actdepor_nocump" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_actdepor_nocump=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_actdepor_aplaz" class="acuedenfa_actdepor_aplaz" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_actdepor_aplaz=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input class="input-block-level" name="acuedenfa_actdepor_obser" type="text" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $acuedenfa_actdepor_obser ?>"/></td>
  </tr>
  <tr>
    <td><strong>Brigadista</strong></td>
    <td style="text-align:center"><input name="acuedenfa_brigad_apto" class="acuedenfa_brigad_apto" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_brigad_apto=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_brigad_nocump" class="acuedenfa_brigad_nocump" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_brigad_nocump=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_brigad_aplaz" class="acuedenfa_brigad_aplaz" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_brigad_aplaz=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input class="input-block-level" name="acuedenfa_brigad_obser" type="text" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $acuedenfa_brigad_obser ?>"/></td>
  </tr>
  <tr>
    <td><strong>Medicamentos</strong></td>
    <td style="text-align:center"><input name="acuedenfa_medica_apto" class="acuedenfa_medica_apto" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_medica_apto=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_medica_nocump" class="acuedenfa_medica_nocump" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_medica_nocump=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input name="acuedenfa_medica_aplaz" class="acuedenfa_medica_aplaz" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($acuedenfa_medica_aplaz=='X'){ echo "checked"; } ?> /></td>
    <td style="text-align:center"><input class="input-block-level" name="acuedenfa_medica_obser" type="text" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $acuedenfa_medica_obser ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:center" colspan="4"><strong>ENFASIS OSTEOMUSCULAR REALIZADO</strong>&nbsp;&nbsp;&nbsp;SI<input type="radio" name="acuedenfa_realiz" value="SI" <?php echo ($acuedenfa_realiz=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;NO<input type="radio" name="acuedenfa_realiz" value="NO" <?php echo ($acuedenfa_realiz=='NO')?'checked':'' ?> /></td>
    <td><input class="input-block-level" name="acuedenfa_realiz_obser" type="text" id="<?php echo $cod_actitud_laboral ?>" value="<?php echo $acuedenfa_realiz_obser ?>"/></td>
  </tr>
</table>

<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td bgcolor="#FAC090" colspan="6"><strong>RECOMENDACIONES GENERALES</strong></td>
  </tr>
  <tr>
    <td><strong>Se realiza retroalimención de los paraclínicos o exámenes</strong></td>
    <td style="text-align:center"><input name="enfosteo_retroparaclinicexamen" class="enfosteo_retroparaclinicexamen" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_retroparaclinicexamen=='X'){ echo "checked"; } ?> /></td>
    <td></td>
    <td style="text-align:center"></td>
    <td></td>
    <td style="text-align:center"></td>
  </tr>
  <tr>
    <td><strong>Control Nutricional en su EPS</strong></td>
    <td style="text-align:center"><input name="enfosteo_contnutrieps" class="enfosteo_contnutrieps" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_contnutrieps=='X'){ echo "checked"; } ?> /></td>
    <td><strong>Control periódico por PyP en su EPS</strong></td>
    <td style="text-align:center"><input name="enfosteo_contperpypeps" class="enfosteo_contperpypeps" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_contperpypeps=='X'){ echo "checked"; } ?> /></td>
    <td><strong>Remisión a su EPS por medicina General o especializada.</strong></td>
    <td style="text-align:center"><input name="enfosteo_remiepsmedigenesp" class="enfosteo_remiepsmedigenesp" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_remiepsmedigenesp=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>Continuar manejo Médico</strong></td>
    <td style="text-align:center"><input name="enfosteo_manejmedic" class="enfosteo_manejmedic" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_manejmedic=='X'){ echo "checked"; } ?> /></td>
    <td><strong>Uso de E.P.P. de acuerdo al cargo</strong></td>
    <td style="text-align:center"><input name="enfosteo_eppcarg" class="enfosteo_eppcarg" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_eppcarg=='X'){ echo "checked"; } ?> /></td>
    <td><strong>Inicio o continuar actividad física mínimo 3 veces por semana</strong></td>
    <td style="text-align:center"><input name="enfosteo_ejerreg" class="enfosteo_ejerreg" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_ejerreg=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>Control periódico ocupacional</strong></td>
    <td style="text-align:center"><input name="enfosteo_contperocupa" class="enfosteo_contperocupa" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_contperocupa=='X'){ echo "checked"; } ?> /></td>
<!--
    <td><strong>Suspender tabaquismo</strong></td>
    <td style="text-align:center"><input name="enfosteo_dejhabitfum" class="enfosteo_dejhabitfum" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_dejhabitfum=='X'){ echo "checked"; } ?> /></td>
-->
    <td><strong>Pausas Activas.</strong></td>
    <td style="text-align:center"><input name="enfosteo_pausactiva" class="enfosteo_pausactiva" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_pausactiva=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
<!--
    <td><strong>Reducir consumo de alcohol</strong></td>
    <td style="text-align:center"><input name="enfosteo_redconsualcoh" class="enfosteo_redconsualcoh" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_redconsualcoh=='X'){ echo "checked"; } ?> /></td>
-->
    <td><strong>Habitos de vida saludable</strong></td>
    <td style="text-align:center"><input name="enfosteo_habito_vida_saludable" class="enfosteo_habito_vida_saludable" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_habito_vida_saludable=='X'){ echo "checked"; } ?> /></td>

    <td><strong>Ingreso a P.V.E.</strong></td>
    <td style="text-align:center"><input name="enfosteo_ingrepve" class="enfosteo_ingrepve" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_ingrepve=='X'){ echo "checked"; } ?> /></td>
    <td><strong>Remisión a EPS/ARL:</strong></td>
    <td style="text-align:center"><input name="enfosteo_remieps" class="enfosteo_remieps" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_remieps=='X'){ echo "checked"; } ?> /></td>
  </tr>
   <tr>
    <td><strong>Posturas Ergonómicas</strong></td>
    <td style="text-align:center"><input name="enfosteo_pausaergo" class="enfosteo_pausaergo" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_pausaergo=='X'){ echo "checked"; } ?> /></td>
    <td><strong>Uso de bloqueador Solar</strong></td>
    <td style="text-align:center"><input name="enfosteo_bloqsolar" class="enfosteo_bloqsolar" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_bloqsolar=='X'){ echo "checked"; } ?> /></td>
    <td><strong>Realización de pruebas complementarias.</strong></td>
    <td style="text-align:center"><input name="enfosteo_realpruebcomp" class="enfosteo_realpruebcomp" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_realpruebcomp=='X'){ echo "checked"; } ?> /></td>
  </tr>
   <tr>
    <td><strong>Recomendaciones para manejo de cargas.</strong></td>
    <td style="text-align:center"><input name="enfosteo_recommanejcarg" class="enfosteo_recommanejcarg" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($enfosteo_recommanejcarg=='X'){ echo "checked"; } ?> /></td>
    <td colspan="4" style="text-align:center"><strong> Siglas: EPS: Entidad Promotora de salud - PYP: Promoción y Prevención -ARL: Administradora de Riesgos Laborales.</strong></td>
   </tr>
  <tr><td colspan="6"><strong>Observaciones:</strong><input class="input-block-level" name="enfosteo_observ" id="<?php echo $cod_actitud_laboral ?>" type="text" value="<?php echo $enfosteo_observ ?>"/></td></tr>
  <tr><td colspan="6"><strong> Priorizar en los programas de vigilancia, los riesgos definidos en la matriz de la tbl15_entidad.</strong></td></tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr><td bgcolor="#FAC090" colspan="2"><strong>RECOMENDACIONES OCUPACIONALES PREVENTIVAS</strong></td></tr>
  <tr>
    <td><strong>OSTEOMUSCULAR: Higiene Postural; estiramientos, Pausas activas</strong></td>
    <td style="text-align:center"><input name="prio_osteo" class="prio_osteo" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_osteo=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>MANIPULACIÓN DE ALIMENTOS: Lavado de manos; BPM (Buenas Prácticas de Manufactura).</strong></td>
    <td style="text-align:center"><input name="prio_manialiment" class="prio_manialiment" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_manialiment=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>VISUAL: Pausas activas visuales, iluminación adecuada en el puesto de trabajo. Educación y prevención en higiene visual, Uso de protección visual según tipo de exposición.</strong></td>
    <td style="text-align:center"><input name="prio_visual" class="prio_visual" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_visual=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>ALTURAS: Certificación en alturas y Capacitación al personal.</strong></td>
    <td style="text-align:center"><input name="prio_altura" class="prio_altura" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_altura=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>PIEL: Reportar alteraciones en la piel, uso de protección en zonas expuestas a agentes irritantes.</strong>.</td>
    <td style="text-align:center"><input name="prio_piel" class="prio_piel" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_piel=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>RESPIRATORIA: Protección según exposición, Uso de E.P.R. (elementos de protección respiratoria).</strong></td>
    <td><p style="text-align:center"><input name="prio_resp" class="prio_resp" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_resp=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>BIOLÓGICO: Verificación del esquema de vacunación, Uso de elementos de bioseguridad según riesgos.</strong></td>
    <td style="text-align:center"><input name="prio_biolog" class="prio_biolog" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_biolog=='X'){ echo "checked"; } ?> /></td>
  </tr>
    <tr>
    <td><strong>ESPACIOS CONFINADOS: Capacitación, Acompañamiento durante la labor, Sistemas de tbl15_seguridadde emergencia.</strong></td>
    <td style="text-align:center"><input name="prio_espconfi" class="prio_espconfi" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_espconfi=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>CUIDADO DE LA VOZ: Calentamiento y reposo vocal, educación de uso adecuado para la voz.</strong></td>
    <td style="text-align:center"><input name="prio_cuidvoz" class="prio_cuidvoz" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_cuidvoz=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>QUÍMICO: Enviar marcadores biológicos específicos según exposición en los trabajadores.</strong></td>
    <td style="text-align:center"><input name="prio_quim" class="prio_quim" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_quim=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>AUDITIVO: Reposo auditivo extralaboral, Protección auditiva de acuerdo con la exposición a ruido.</strong></td>
    <td style="text-align:center"><input name="prio_audi" class="prio_audi" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_audi=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>TEMPERATURAS EXTREMAS: Capacitación en identificación temprana de signos de alarma, Uso de la ropa adecuada.</strong></td>
    <td style="text-align:center"><input name="prio_tempextem" class="prio_tempextem" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_tempextem=='X'){ echo "checked"; } ?> /></td>
  </tr>
  <tr>
    <td><strong>OTRO:</strong><input class="input-block-level" name="prio_otro_descripcion" id="<?php echo $cod_actitud_laboral ?>" type="text" value="<?php echo $prio_otro_descripcion ?>"/></td>
    <td style="text-align:center"><input name="prio_otro" class="prio_otro" id="<?php echo $cod_actitud_laboral ?>" type="checkbox" value="X" <? if($prio_otro=='X'){ echo "checked"; } ?> /></td>
  </tr>
</table>


<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr><td bgcolor="#FAC090"><strong>RECOMENDACIONES / EMPRESA</strong></td></tr>
  <tr><td style="text-align:center"><input class="input-block-level" name="recomend_emp" id="<?php echo $cod_actitud_laboral ?>" type="text" value="<?php echo $recomend_emp ?>"/></td></tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<table border="1" align="center" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr><td bgcolor="#FAC090"><strong>RECOMENDACIONES / TRABAJADOR </strong></td></tr>
  <tr><td style="text-align:center"><input class="input-block-level" name="recomend_trab" id="<?php echo $cod_actitud_laboral ?>" type="text" value="<?php echo $recomend_trab ?>"/></td></tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
     </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="justify" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <tbody>
      <tr><td style="text-align:center"><?php echo $info_aptlaboral_emp ?></td></tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" style="font-family:mono; font-size:10pt; width:100%">
  <tr>
    <td width="387" valign="top"><p><strong>Medico</strong></p>
    <div><img src="<?php echo $propietario_url_firma_emp ?>" height="90px"/></div>
    <div>_________________________________________ </div>
    <p><strong>Firma</strong>
    <br />
    <strong>Reg. Medico <?php echo $reg_medico_emp ?></strong>
    <br />
    <strong>Licencia Salud Ocupacional <?php echo $licencia_emp ?></strong> </p></td>
    <td width="387" valign="top"><p><strong>Paciente</strong></p>
    <div><img src="<?php echo $url_img_firma_min_cli ?>" height="90px"/></div>
    <div>_________________________________________ </div>
    <p><strong>Firma</strong><br />
    <strong>C.C <?php echo $cedula ?></strong> </p></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>">
<input type="hidden" name="cod_actitud_laboral" value="<?php echo $cod_actitud_laboral ?>">
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">

<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
</form>
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
<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#fecha_ymd').datetimepicker({ format: 'yyyy/MM/dd', language: 'es' });</script>
<!-- 1****************************************************************************************************** -->

<script type="text/javascript">
$(document).ready(function() {

$(".aptdesemp_carg").change(function(){ if( $(this).is(':checked') ){ $(".aptdesemp_carg").val("X"); } else { $(".aptdesemp_carg").val(""); } });
$(".present_restric").change(function(){ if( $(this).is(':checked') ){ $(".present_restric").val("X"); } else { $(".present_restric").val(""); } });
$(".aplazad").change(function(){ if( $(this).is(':checked') ){ $(".aplazad").val("X"); } else { $(".aplazad").val(""); } });
$(".contin_lab1").change(function(){ if( $(this).is(':checked') ){ $(".contin_lab1").val("X"); } else { $(".contin_lab1").val(""); } });
$(".aplaz1").change(function(){ if( $(this).is(':checked') ){ $(".aplaz1").val("X"); } else { $(".aplaz1").val(""); } });
$(".resig_tarea1").change(function(){ if( $(this).is(':checked') ){ $(".resig_tarea1").val("X"); } else { $(".resig_tarea1").val(""); } });
$(".temporal1").change(function(){ if( $(this).is(':checked') ){ $(".temporal1").val("X"); } else { $(".temporal1").val(""); } });
$(".contin_lab2").change(function(){ if( $(this).is(':checked') ){ $(".contin_lab2").val("X"); } else { $(".contin_lab2").val(""); } });
$(".aplaz2").change(function(){ if( $(this).is(':checked') ){ $(".aplaz2").val("X"); } else { $(".aplaz2").val(""); } });
$(".resig_tarea2").change(function(){ if( $(this).is(':checked') ){ $(".resig_tarea2").val("X"); } else { $(".resig_tarea2").val(""); } });
$(".temporal2").change(function(){ if( $(this).is(':checked') ){ $(".temporal2").val("X"); } else { $(".temporal2").val(""); } });
$(".rein_trab").change(function(){ if( $(this).is(':checked') ){ $(".rein_trab").val("X"); } else { $(".rein_trab").val(""); } });
$(".aplaz3").change(function(){ if( $(this).is(':checked') ){ $(".aplaz3").val("X"); } else { $(".aplaz3").val(""); } });
$(".resig_tarea3").change(function(){ if( $(this).is(':checked') ){ $(".resig_tarea3").val("X"); } else { $(".resig_tarea3").val(""); } });
$(".temporal3").change(function(){ if( $(this).is(':checked') ){ $(".temporal3").val("X"); } else { $(".temporal3").val(""); } });
$(".realiz").change(function(){ if( $(this).is(':checked') ){ $(".realiz").val("X"); } else { $(".realiz").val(""); } });
$(".exacomple_opto").change(function(){ if( $(this).is(':checked') ){ $(".exacomple_opto").val("X"); } else { $(".exacomple_opto").val(""); } });
$(".exacomple_espiro").change(function(){ if( $(this).is(':checked') ){ $(".exacomple_espiro").val("X"); } else { $(".exacomple_espiro").val(""); } });
$(".exacomple_audi").change(function(){ if( $(this).is(':checked') ){ $(".exacomple_audi").val("X"); } else { $(".exacomple_audi").val(""); } });
$(".exacomple_psico").change(function(){ if( $(this).is(':checked') ){ $(".exacomple_psico").val("X"); } else { $(".exacomple_psico").val(""); } });
$(".exacomple_visio").change(function(){ if( $(this).is(':checked') ){ $(".exacomple_visio").val("X"); } else { $(".exacomple_visio").val(""); } });
$(".exacomple_lab").change(function(){ if( $(this).is(':checked') ){ $(".exacomple_lab").val("X"); } else { $(".exacomple_lab").val(""); } });
$(".acuedenfa_segvial_apto").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_segvial_apto").val("X"); } else { $(".acuedenfa_segvial_apto").val(""); } });
$(".acuedenfa_segvial_nocump").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_segvial_nocump").val("X"); } else { $(".acuedenfa_segvial_nocump").val(""); } });
$(".acuedenfa_segvial_aplaz").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_segvial_aplaz").val("X"); } else { $(".acuedenfa_segvial_aplaz").val(""); } });
$(".acuedenfa_espconf_apto").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_espconf_apto").val("X"); } else { $(".acuedenfa_espconf_apto").val(""); } });
$(".acuedenfa_espconf_nocump").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_espconf_nocump").val("X"); } else { $(".acuedenfa_espconf_nocump").val(""); } });
$(".acuedenfa_espconf_aplaz").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_espconf_aplaz").val("X"); } else { $(".acuedenfa_espconf_aplaz").val(""); } });
$(".acuedenfa_altu_apto").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_altu_apto").val("X"); } else { $(".acuedenfa_altu_apto").val(""); } });
$(".acuedenfa_altu_nocump").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_altu_nocump").val("X"); } else { $(".acuedenfa_altu_nocump").val(""); } });
$(".acuedenfa_altu_aplaz").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_altu_aplaz").val("X"); } else { $(".acuedenfa_altu_aplaz").val(""); } });
$(".acuedenfa_alime_apto").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_alime_apto").val("X"); } else { $(".acuedenfa_alime_apto").val(""); } });
$(".acuedenfa_alime_nocump").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_alime_nocump").val("X"); } else { $(".acuedenfa_alime_nocump").val(""); } });
$(".acuedenfa_alime_aplaz").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_alime_aplaz").val("X"); } else { $(".acuedenfa_alime_aplaz").val(""); } });
$(".acuedenfa_actdepor_apto").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_actdepor_apto").val("X"); } else { $(".acuedenfa_actdepor_apto").val(""); } });
$(".acuedenfa_actdepor_nocump").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_actdepor_nocump").val("X"); } else { $(".acuedenfa_actdepor_nocump").val(""); } });
$(".acuedenfa_actdepor_aplaz").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_actdepor_aplaz").val("X"); } else { $(".acuedenfa_actdepor_aplaz").val(""); } });
$(".acuedenfa_brigad_apto").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_brigad_apto").val("X"); } else { $(".acuedenfa_brigad_apto").val(""); } });
$(".acuedenfa_brigad_nocump").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_brigad_nocump").val("X"); } else { $(".acuedenfa_brigad_nocump").val(""); } });
$(".acuedenfa_brigad_aplaz").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_brigad_aplaz").val("X"); } else { $(".acuedenfa_brigad_aplaz").val(""); } });
$(".acuedenfa_medica_apto").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_medica_apto").val("X"); } else { $(".acuedenfa_medica_apto").val(""); } });
$(".acuedenfa_medica_nocump").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_medica_nocump").val("X"); } else { $(".acuedenfa_medica_nocump").val(""); } });
$(".acuedenfa_medica_aplaz").change(function(){ if( $(this).is(':checked') ){ $(".acuedenfa_medica_aplaz").val("X"); } else { $(".acuedenfa_medica_aplaz").val(""); } });
$(".enfosteo_contnutrieps").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_contnutrieps").val("X"); } else { $(".enfosteo_contnutrieps").val(""); } });
$(".enfosteo_contperpypeps").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_contperpypeps").val("X"); } else { $(".enfosteo_contperpypeps").val(""); } });
$(".enfosteo_remiepsmedigenesp").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_remiepsmedigenesp").val("X"); } else { $(".enfosteo_remiepsmedigenesp").val(""); } });
$(".enfosteo_manejmedic").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_manejmedic").val("X"); } else { $(".enfosteo_manejmedic").val(""); } });
$(".enfosteo_eppcarg").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_eppcarg").val("X"); } else { $(".enfosteo_eppcarg").val(""); } });
$(".enfosteo_ejerreg").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_ejerreg").val("X"); } else { $(".enfosteo_ejerreg").val(""); } });
$(".enfosteo_contperocupa").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_contperocupa").val("X"); } else { $(".enfosteo_contperocupa").val(""); } });
$(".enfosteo_dejhabitfum").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_dejhabitfum").val("X"); } else { $(".enfosteo_dejhabitfum").val(""); } });
$(".enfosteo_pausactiva").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_pausactiva").val("X"); } else { $(".enfosteo_pausactiva").val(""); } });
$(".enfosteo_redconsualcoh").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_redconsualcoh").val("X"); } else { $(".enfosteo_redconsualcoh").val(""); } });
$(".enfosteo_ingrepve").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_ingrepve").val("X"); } else { $(".enfosteo_ingrepve").val(""); } });
$(".enfosteo_remieps").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_remieps").val("X"); } else { $(".enfosteo_remieps").val(""); } });
$(".enfosteo_pausaergo").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_pausaergo").val("X"); } else { $(".enfosteo_pausaergo").val(""); } });
$(".enfosteo_bloqsolar").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_bloqsolar").val("X"); } else { $(".enfosteo_bloqsolar").val(""); } });
$(".enfosteo_realpruebcomp").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_realpruebcomp").val("X"); } else { $(".enfosteo_realpruebcomp").val(""); } });
$(".enfosteo_recommanejcarg").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_recommanejcarg").val("X"); } else { $(".enfosteo_recommanejcarg").val(""); } });
$(".prio_osteo").change(function(){ if( $(this).is(':checked') ){ $(".prio_osteo").val("X"); } else { $(".prio_osteo").val(""); } });
$(".prio_manialiment").change(function(){ if( $(this).is(':checked') ){ $(".prio_manialiment").val("X"); } else { $(".prio_manialiment").val(""); } });
$(".prio_visual").change(function(){ if( $(this).is(':checked') ){ $(".prio_visual").val("X"); } else { $(".prio_visual").val(""); } });
$(".prio_altura").change(function(){ if( $(this).is(':checked') ){ $(".prio_altura").val("X"); } else { $(".prio_altura").val(""); } });
$(".prio_piel").change(function(){ if( $(this).is(':checked') ){ $(".prio_piel").val("X"); } else { $(".prio_piel").val(""); } });
$(".prio_resp").change(function(){ if( $(this).is(':checked') ){ $(".prio_resp").val("X"); } else { $(".prio_resp").val(""); } });
$(".prio_espconfi").change(function(){ if( $(this).is(':checked') ){ $(".prio_espconfi").val("X"); } else { $(".prio_espconfi").val(""); } });
$(".prio_cuidvoz").change(function(){ if( $(this).is(':checked') ){ $(".prio_cuidvoz").val("X"); } else { $(".prio_cuidvoz").val(""); } });
$(".prio_quim").change(function(){ if( $(this).is(':checked') ){ $(".prio_quim").val("X"); } else { $(".prio_quim").val(""); } });
$(".prio_audi").change(function(){ if( $(this).is(':checked') ){ $(".prio_audi").val("X"); } else { $(".prio_audi").val(""); } });
$(".prio_tempextem").change(function(){ if( $(this).is(':checked') ){ $(".prio_tempextem").val("X"); } else { $(".prio_tempextem").val(""); } });
$(".prio_biolog").change(function(){ if( $(this).is(':checked') ){ $(".prio_biolog").val("X"); } else { $(".prio_biolog").val(""); } });
$(".enfosteo_habito_vida_saludable").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_habito_vida_saludable").val("X"); } else { $(".enfosteo_habito_vida_saludable").val(""); } });
$(".enfosteo_retroparaclinicexamen").change(function(){ if( $(this).is(':checked') ){ $(".enfosteo_retroparaclinicexamen").val("X"); } else { $(".enfosteo_retroparaclinicexamen").val(""); } });


$("input").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_concepto_actitud_laboral_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_actitud_laboral ?>},  
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
    url:"guardar_edit_concepto_actitud_laboral_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_actitud_laboral ?>},  
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
    url:"guardar_edit_concepto_actitud_laboral_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_actitud_laboral ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

});
</script>
</body>
</html>