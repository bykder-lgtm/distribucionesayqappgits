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
<a href="#"><h4>Evaluación Médica Para Trabajo En Alturas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
//$fecha_hoy = date("Y/m/d");
$pagina                                 = addslashes($_GET['pagina']);
$pagina_local                           = $_SERVER['PHP_SELF'];
$cod_trabajo_altura                     = intval($_GET['cod_trabajo_altura']);
$cod_historia_clinica                   = intval($_GET['cod_historia_clinica']);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_trab_altura = "SELECT * FROM tbl15_trabajo_altura WHERE cod_trabajo_altura = '".($cod_trabajo_altura)."'";
$consultar_trab_altura = mysqli_query($conectar, $obtener_trab_altura) or die(mysqli_error($conectar));
$info_trab_altura= mysqli_fetch_assoc($consultar_trab_altura);

$motivo                                = $info_trab_altura['motivo_trabajo_altura'];
$cod_cliente                           = $info_trab_altura['cod_cliente'];
$cod_administrador                     = $info_trab_altura['cod_administrador'];
$motivo_trabajo_altura                 = $info_trab_altura['motivo_trabajo_altura'];
$trab_ant_centro_trab                  = $info_trab_altura['trab_ant_centro_trab'];
$trab_ant_tiempo                       = $info_trab_altura['trab_ant_tiempo'];
$trab_ant_puesto                       = $info_trab_altura['trab_ant_puesto'];
$trab_ant_descrip_tarea                = $info_trab_altura['trab_ant_descrip_tarea'];
$trab_ant_acci_lab_secue               = $info_trab_altura['trab_ant_acci_lab_secue'];
$trab_ant_enf_prof_secue               = $info_trab_altura['trab_ant_enf_prof_secue'];
$ant_fam_diabetes                      = $info_trab_altura['ant_fam_diabetes'];
$ant_fam_hipertension                  = $info_trab_altura['ant_fam_hipertension'];
$ant_fam_cardiacas                     = $info_trab_altura['ant_fam_cardiacas'];
$ant_fam_asma                          = $info_trab_altura['ant_fam_asma'];
$ant_fam_convulsiones                  = $info_trab_altura['ant_fam_convulsiones'];
$ant_fam_otros                         = $info_trab_altura['ant_fam_otros'];
$ant_fam_cuales                        = $info_trab_altura['ant_fam_cuales'];
$ant_gine_menarquia                    = $info_trab_altura['ant_gine_menarquia'];
$ant_gine_fmu                          = $info_trab_altura['ant_gine_fmu'];
$ant_gine_ritmo                        = $info_trab_altura['ant_gine_ritmo'];
$ant_gine_g                            = $info_trab_altura['ant_gine_g'];
$ant_gine_p                            = $info_trab_altura['ant_gine_p'];
$ant_gine_a                            = $info_trab_altura['ant_gine_a'];
$ant_gine_c                            = $info_trab_altura['ant_gine_c'];
$ant_gine_ivsa                         = $info_trab_altura['ant_gine_ivsa'];
$ant_gine_mpf                          = $info_trab_altura['ant_gine_mpf'];
$ant_gine_fpp                          = $info_trab_altura['ant_gine_fpp'];
$ant_gine_doc                          = $info_trab_altura['ant_gine_doc'];
$ant_gine_fecha                        = $info_trab_altura['ant_gine_fecha'];
$ant_gine_resultado                    = $info_trab_altura['ant_gine_resultado'];
$ant_gine_tratamiento                  = $info_trab_altura['ant_gine_tratamiento'];
$ant_gine_cual                         = $info_trab_altura['ant_gine_cual'];
$ant_nopatolog_fuma                    = $info_trab_altura['ant_nopatolog_fuma'];
$ant_nopatolog_alcohol                 = $info_trab_altura['ant_nopatolog_alcohol'];
$ant_nopatolog_toxicomanias            = $info_trab_altura['ant_nopatolog_toxicomanias'];
$ant_nopatolog_otros                   = $info_trab_altura['ant_nopatolog_otros'];
$ant_nopatolog_cuanto                  = $info_trab_altura['ant_nopatolog_cuanto'];
$ant_person_pato_convul                = $info_trab_altura['ant_person_pato_convul'];
$ant_person_pato_dificulresp           = $info_trab_altura['ant_person_pato_dificulresp'];
$ant_person_pato_reacalerg             = $info_trab_altura['ant_person_pato_reacalerg'];
$ant_person_pato_problemcorazon        = $info_trab_altura['ant_person_pato_problemcorazon'];
$ant_person_pato_claustofob            = $info_trab_altura['ant_person_pato_claustofob'];
$ant_person_pato_presionalta           = $info_trab_altura['ant_person_pato_presionalta'];
$ant_person_pato_dificuloler           = $info_trab_altura['ant_person_pato_dificuloler'];
$ant_person_pato_tomamedicam           = $info_trab_altura['ant_person_pato_tomamedicam'];
$ant_person_pato_diabetes              = $info_trab_altura['ant_person_pato_diabetes'];
$ant_person_pato_usalentes             = $info_trab_altura['ant_person_pato_usalentes'];
$ant_person_pato_problempulmonar       = $info_trab_altura['ant_person_pato_problempulmonar'];
$ant_person_pato_dificuldistinguircolor = $info_trab_altura['ant_person_pato_dificuldistinguircolor'];
$explo_fis_signovital                  = $info_trab_altura['explo_fis_signovital'];
$explo_fis_fc                          = $info_trab_altura['explo_fis_fc'];
$explo_fis_fr                          = $info_trab_altura['explo_fis_fr'];
$explo_fis_ta                          = $info_trab_altura['explo_fis_ta'];
$explo_fis_antropometria               = $info_trab_altura['explo_fis_antropometria'];
$explo_fis_peso                        = $info_trab_altura['explo_fis_peso'];
$explo_fis_talla                       = $info_trab_altura['explo_fis_talla'];
$explo_fis_imc                         = $info_trab_altura['explo_fis_imc'];
$explo_fis_perimuneca                  = $info_trab_altura['explo_fis_perimuneca'];
$explo_fis_pericintura                 = $info_trab_altura['explo_fis_pericintura'];

$exa_fis_ojoder_sncorre_vlejan         = $info_trab_altura['exa_fis_ojoder_sncorre_vlejan'];
$exa_fis_ojoder_sncorre_vcerca         = $info_trab_altura['exa_fis_ojoder_sncorre_vcerca'];
$exa_fis_ojoder_cncorre_vlejan         = $info_trab_altura['exa_fis_ojoder_cncorre_vlejan'];
$exa_fis_ojoder_cncorre_vcerca         = $info_trab_altura['exa_fis_ojoder_cncorre_vcerca'];
$exa_fis_ojoizq_sncorre_vlejan         = $info_trab_altura['exa_fis_ojoizq_sncorre_vlejan'];
$exa_fis_ojoizq_sncorre_vcerca         = $info_trab_altura['exa_fis_ojoizq_sncorre_vcerca'];
$exa_fis_ojoizq_cncorre_vlejan         = $info_trab_altura['exa_fis_ojoizq_cncorre_vlejan'];
$exa_fis_ojoizq_cncorre_vcerca         = $info_trab_altura['exa_fis_ojoizq_cncorre_vcerca'];
$exa_fis_ojoamb_sncorre_vlejan         = $info_trab_altura['exa_fis_ojoamb_sncorre_vlejan'];
$exa_fis_ojoamb_sncorre_vcerca         = $info_trab_altura['exa_fis_ojoamb_sncorre_vcerca'];
$exa_fis_oojoamb_cncorre_vlejan        = $info_trab_altura['exa_fis_oojoamb_cncorre_vlejan'];
$exa_fis_ojoamb_cncorre_vcerca         = $info_trab_altura['exa_fis_ojoamb_cncorre_vcerca'];

$explo_fis_visionav                    = $info_trab_altura['explo_fis_visionav'];
$explo_fis_od                          = $info_trab_altura['explo_fis_od'];
$explo_fis_oi                          = $info_trab_altura['explo_fis_oi'];
$explo_fis_ishihara                    = $info_trab_altura['explo_fis_ishihara'];
$explo_fis_cabeza                      = $info_trab_altura['explo_fis_cabeza'];
$explo_fis_cuello                      = $info_trab_altura['explo_fis_cuello'];
$explo_fis_cadiopulm                   = $info_trab_altura['explo_fis_cadiopulm'];
$explo_fis_digestivo                   = $info_trab_altura['explo_fis_digestivo'];
$explo_fis_sistemmuscesquelet          = $info_trab_altura['explo_fis_sistemmuscesquelet'];
$explo_fis_pielanexos                  = $info_trab_altura['explo_fis_pielanexos'];
$explo_fis_testromberg                 = $info_trab_altura['explo_fis_testromberg'];
$explo_fis_priebmarcha                 = $info_trab_altura['explo_fis_priebmarcha'];
$explo_fis_recomenespeciftrab          = $info_trab_altura['explo_fis_recomenespeciftrab'];
$explo_fis_recomenespecifempre         = $info_trab_altura['explo_fis_recomenespecifempre'];
$explo_fis_idx                         = $info_trab_altura['explo_fis_idx'];
$nombre_acepta_trab_altura             = $info_trab_altura['nombre_acepta_trab_altura'];
$fecha_mes                             = $info_trab_altura['fecha_mes'];
$fecha_anyo                            = $info_trab_altura['fecha_anyo'];
$fecha_ymd                             = $info_trab_altura['fecha_ymd'];
$fecha_dmy                             = $info_trab_altura['fecha_dmy'];
$fecha_time                            = $info_trab_altura['fecha_time'];
$fecha_reg_time                        = $info_trab_altura['fecha_reg_time'];
$cuenta                                = $info_trab_altura['cuenta'];
$cuenta_reg                            = $info_trab_altura['cuenta_reg'];
$cod_grupo_area                        = $info_trab_altura['cod_grupo_area'];
$cod_grupo_area_cargo                  = $info_trab_altura['cod_grupo_area_cargo'];
$costo_motivo_consulta                 = $info_trab_altura['costo_motivo_consulta'];
$cod_factura                           = $info_trab_altura['cod_factura'];
$nombre_ocupacion                      = $info_trab_altura['nombre_ocupacion'];
$nombre_empresa                        = $info_trab_altura['nombre_empresa'];
$cargo_empresa                         = $info_trab_altura['cargo_empresa'];
$area_empresa                          = $info_trab_altura['area_empresa'];
$ciudad_empresa                        = $info_trab_altura['ciudad_empresa'];
$nombre_empresa_contratante            = $info_trab_altura['nombre_empresa_contratante'];
$nombre_tipo_remision                  = $info_trab_altura['nombre_tipo_remision'];
$fecha_control                         = $info_trab_altura['fecha_control'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$obtener_estructura_trabajo_altura = "SELECT nombre_empresa, cargo_empresa, area_empresa, ciudad_empresa, nombre_empresa_contratante, 
motivo, cod_cliente, cod_administrador, exa_fis_peso, exa_fis_talla, exa_fis_imc, exa_fis_fresp, exa_fis_fc, exa_fis_ta 
FROM tbl15_historia_clinica WHERE cod_historia_clinica = '".($cod_historia_clinica)."'";
$consultar_estructura_trabajo_altura = mysqli_query($conectar, $obtener_estructura_trabajo_altura) or die(mysqli_error($conectar));
$info_estructura_trabajo_altura= mysqli_fetch_assoc($consultar_estructura_trabajo_altura);

$exa_fis_peso                           = $info_estructura_trabajo_altura['exa_fis_peso'];
$exa_fis_talla                          = $info_estructura_trabajo_altura['exa_fis_talla'];
$exa_fis_imc                            = $info_estructura_trabajo_altura['exa_fis_imc'];
$exa_fis_fresp                          = $info_estructura_trabajo_altura['exa_fis_fresp'];
$exa_fis_fc                             = $info_estructura_trabajo_altura['exa_fis_fc'];
$exa_fis_ta                             = $info_estructura_trabajo_altura['exa_fis_ta'];
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

$cedula                                = $info_cliente['cedula'];
$nombres                               = $info_cliente['nombres'];
$apellido1                             = $info_cliente['apellido1'];
$apellido2                             = $info_cliente['apellido2'];
$nombre_tipo_doc                       = $info_cliente['nombre_tipo_doc'];
$url_img_firma_min_cli                 = $info_cliente['url_img_firma_min_cli'];
$nom_ape                               = $nombres.' '.$apellido1.' '.$apellido2;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($fecha_ymd == '') { $fecha_ymd = date("Y/m/d"); } 
else { $fecha_ymd = $fecha_ymd; } ?>
<!--<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_asignar_profesional_paciente_reg.php">-->
<form name="frmSubir" method="post" enctype="multipart/form-data" action="edit_concepto_trabajo_altura_reg.php">
<fieldset>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td><strong>Evaluación Médica Para Trabajo En Alturas<a href="../admin/actualizar_exploracion_fisica_trabajo_altura.php?cod_trabajo_altura=<?php echo $cod_trabajo_altura?>&cod_historia_clinica=<?php echo $cod_historia_clinica?>&pagina=<?php echo $pagina_local?>"><img src="../imagenes/btn_recargar.png" alt=""></a></strong></td>
  </tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td><strong>I. TIPO DE EXAMEN&nbsp;</strong></td>
    <td><strong>Fecha:<div id="fecha_ymd" class="input-append date"><input id="<?php echo $cod_trabajo_altura ?>" type="text" name="fecha_ymd" value="<?php echo $fecha_ymd ?>"></input><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div></strong></td>
    <td></td>
  </tr>
  <tr>
    <td><strong>MOTIVO DE EVALUACIÓN: </strong></td>
    <td>
<select name="motivo_trabajo_altura" id="<?php echo $cod_trabajo_altura ?>" required>
<?php if (isset($motivo_trabajo_altura)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_motivo_consulta, motivo FROM tbl15_motivo_consulta ORDER BY motivo ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($motivo_trabajo_altura) and $motivo_trabajo_altura == $datos2['motivo']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['motivo'];
$nombre = $datos2['motivo'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</select>
</td>
  </tr>
  <tr>
    <td colspan="15"><strong>II. IDENTIFICACIÓN DE LA EMPRESA</strong></td>
  </tr>
  <tr>
    <td>Empresa Contratante: 
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

    <td>Empresa a Laborar: 
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
  </tr>
  <tr>
    <td><strong>III. DATOS DEL TRABAJADOR</strong></td>
  </tr>
  <tr>
    <td>Apellidos y Nombres: <?php echo $nom_ape ?></td>
    <td>Identificación: <?php echo $cedula ?></td>
  </tr>
  <tr>
    <td>Cargo: 
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
echo "<option value='".$codigo."' $seleccionado >".$nombre2.' | '.$nombre."</option>"; } ?></select>
    </td>
    <td>Ciudad: <input class="input-block-level" name="ciudad_empresa" type="text" id="<?php echo $cod_trabajo_altura ?>" value="<?php echo $ciudad_empresa ?>"/></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>

<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td><strong>IV. TRABAJOS ANTERIORES</strong></td>
  </tr>
  <tr>
    <td><strong>CENTRO DE TRABAJO: <input class="input-block-level" name="trab_ant_centro_trab" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $trab_ant_centro_trab ?>"/></strong></td>
    <td><strong>TIEMPO: <input class="input-block-level" name="trab_ant_tiempo" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $trab_ant_tiempo ?>"/></strong></td>
    <td><strong>PUESTO: <input class="input-block-level" name="trab_ant_puesto" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $trab_ant_puesto ?>"/></strong></td>
    <td><strong>DESCRIPCIÓN DE LA TAREA: <input class="input-block-level" name="trab_ant_descrip_tarea" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $trab_ant_descrip_tarea ?>"/></strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>ACCIDENTES LABORALES Y SECUELAS: <input class="input-block-level" name="trab_ant_acci_lab_secue" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $trab_ant_acci_lab_secue ?>"/></strong></td>
    <td colspan="2"><strong>ENFERMEDADES PROFESIONALES Y SECUELAS: <input class="input-block-level" name="trab_ant_enf_prof_secue" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $trab_ant_enf_prof_secue ?>"/></strong></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>

<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td><strong>V. ANTECEDENTES HEREDO FAMILIARES</strong></td>
    <td><strong></strong></td>
    <td><strong>VI. ANTECEDENTES GINECO OBSTÉTRICOS</strong></td>
  </tr>
  <tr>
    <td><strong></strong></td>
    <td><strong></strong></td>
    <td>Menarquia: <input class="" name="ant_gine_menarquia" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $ant_gine_menarquia ?>" style="width:150px;height:20px"/> 
      F.M.U: <input class="" name="ant_gine_fmu" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $ant_gine_fmu ?>" style="width:150px;height:20px"/> 
      Ritmo: <input class="" name="ant_gine_ritmo" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $ant_gine_ritmo ?>" style="width:150px;height:20px"/></td>
  </tr>
  <tr>
    <td>Diabetes<strong></strong></td>
    <td style="text-align:center"><strong>SI<input type="radio" name="ant_fam_diabetes" value="SI" <?php echo ($ant_fam_diabetes=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_fam_diabetes" value="NO" <?php echo ($ant_fam_diabetes=='NO')?'checked':'' ?> /></strong></td>
    <td>
      G:<input class="" name="ant_gine_g" type="number" value="<?php echo $ant_gine_g ?>" style="width:50px;height:20px"/> 
      P:<input class="" name="ant_gine_p" type="number" value="<?php echo $ant_gine_p ?>" style="width:50px;height:20px"/> 
      A: <input class="" name="ant_gine_a" type="number" value="<?php echo $ant_gine_a ?>" style="width:50px;height:20px"/> 
      C: <input class="" name="ant_gine_c" type="number" value="<?php echo $ant_gine_c ?>" style="width:50px;height:20px"/> 
      I.V.S.A: <input class="" name="ant_gine_ivsa" type="number" value="<?php echo $ant_gine_ivsa ?>" style="width:50px;height:20px"/></td>
  </tr>
  <tr>
    <td>Hipertensión<strong></strong></td>
    <td style="text-align:center"><strong>SI<input type="radio" name="ant_fam_hipertension" value="SI" <?php echo ($ant_fam_hipertension=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_fam_hipertension" value="NO" <?php echo ($ant_fam_hipertension=='NO')?'checked':'' ?> /></strong></td>
    <td>
      M.P.F: <input class="" name="ant_gine_mpf" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $ant_gine_mpf ?>" style="width:150px;height:20px"/>
      F.P.P: <input class="" name="ant_gine_fpp" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $ant_gine_fpp ?>" style="width:150px;height:20px"/>
      D.O.C: <input class="" name="ant_gine_doc" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $ant_gine_doc ?>" style="width:150px;height:20px"/></td>
  </tr>
  <tr>
    <td><p>Cardiopatia<strong></strong></p></td>
    <td style="text-align:center"><strong>SI<input type="radio" name="ant_fam_cardiacas" value="SI" <?php echo ($ant_fam_cardiacas=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_fam_cardiacas" value="NO" <?php echo ($ant_fam_cardiacas=='NO')?'checked':'' ?> /></strong></td>
    <td>
      FECHA: <input class="" name="ant_gine_fecha" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $ant_gine_fecha ?>"/>
      Resultado: <input class="" name="ant_gine_resultado" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $ant_gine_resultado ?>"/></td>
  </tr>
  <tr>
    <td>Asma</td>
    <td style="text-align:center"><strong>SI<input type="radio" name="ant_fam_asma" value="SI" <?php echo ($ant_fam_asma=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_fam_asma" value="NO" <?php echo ($ant_fam_asma=='NO')?'checked':'' ?> /></strong></td>
    <td>Tratamiento: SI<input type="radio" name="ant_gine_tratamiento" value="SI" <?php echo ($ant_gine_tratamiento=='SI')?'checked':'' ?> >&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_gine_tratamiento" value="NO" <?php echo ($ant_gine_tratamiento=='NO')?'checked':'' ?> />¿Cuál?
    <input style="text-align:center;width:450px;height:20px" class="input-block-level" name="ant_gine_cual" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $ant_gine_cual ?>"/>
    </td>
  </tr>
  <tr>
    <td>Convulsiones<strong></strong></td>
    <td style="text-align:center"><strong>SI<input type="radio" name="ant_fam_convulsiones" value="SI" <?php echo ($ant_fam_convulsiones=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_fam_convulsiones" value="NO" <?php echo ($ant_fam_convulsiones=='NO')?'checked':'' ?> /></strong></td>
    <td></td>
  </tr>
  <tr>
    <td>Otros</td>
    <td style="text-align:center"><strong>SI<input type="radio" name="ant_fam_otros" value="SI" <?php echo ($ant_fam_otros=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_fam_otros" value="NO" <?php echo ($ant_fam_otros=='NO')?'checked':'' ?> /></strong></td>
    <td><strong>Cuáles: </strong><input style="width:550px;height:20px"class="input-block-level" name="ant_fam_cuales" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $ant_fam_cuales ?>"/></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>

<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td colspan="14">
      <strong>VII. ANTECEDENTES  PERSONALES NO PATOLÓGICOS </strong>
    </td>
  </tr>
  <tr>
    <td><strong></strong></td>
    <td style="text-align:center" colspan="2"><strong>SI NO</strong></td>
    <td colspan="20"><strong>Cuanto: <input style="width:650px;height:20px" class="input-block-level" name="ant_nopatolog_cuanto" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $ant_nopatolog_cuanto ?>"/></strong></td>
  </tr>
  <tr>
    <td>Fuma</td>
    <td style="text-align:center" colspan="2"><strong>SI<input type="radio" name="ant_nopatolog_fuma" value="SI" <?php echo ($ant_nopatolog_fuma=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_nopatolog_fuma" value="NO" <?php echo ($ant_nopatolog_fuma=='NO')?'checked':'' ?> /></strong></td>
  </tr>
  <tr>
    <td>Consume Alcohol</td>
    <td style="text-align:center" colspan="2"><strong>SI<input type="radio" name="ant_nopatolog_alcohol" value="SI" <?php echo ($ant_nopatolog_alcohol=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_nopatolog_alcohol" value="NO" <?php echo ($ant_nopatolog_alcohol=='NO')?'checked':'' ?> /></strong></td>
  </tr>
  <tr>
    <td>Toxicoman&iacute;as</td>
    <td style="text-align:center" colspan="2"><strong>SI<input type="radio" name="ant_nopatolog_toxicomanias" value="SI" <?php echo ($ant_nopatolog_toxicomanias=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_nopatolog_toxicomanias" value="NO" <?php echo ($ant_nopatolog_toxicomanias=='NO')?'checked':'' ?> /></strong></td>
  </tr>
  <tr>
    <td>Otros</td>
    <td style="text-align:center" colspan="2"><strong>SI<input type="radio" name="ant_nopatolog_otros" value="SI" <?php echo ($ant_nopatolog_otros=='SI')?'checked':'' ?> required>&nbsp;&nbsp;&nbsp;NO<input type="radio" name="ant_nopatolog_otros" value="NO" <?php echo ($ant_nopatolog_otros=='NO')?'checked':'' ?> /></strong></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td colspan="14">
      <strong>VIII. ANTECEDENTES PERSONALES PATOLÓGICOS</strong>
    </td>
  </tr>
  <tr>
    <td colspan="6"><strong>CONVULSIONES (ATAQUES)</strong></td>
    <td style="text-align:center;"><input name="ant_person_pato_convul" class="ant_person_pato_convul" class="ant_person_pato_convul" id="<?php echo $cod_trabajo_altura ?>" type="checkbox" value="SI" <? if($ant_person_pato_convul=='SI'){ echo "checked"; } ?>></td>
    <td colspan="6"><strong>DIFICULTAD AL RESPIRAR</strong></td>
    <td style="text-align:center"><input name="ant_person_pato_dificulresp" class="ant_person_pato_dificulresp" class="ant_person_pato_dificulresp" id="<?php echo $cod_trabajo_altura ?>" type="checkbox" value="SI" <? if($ant_person_pato_dificulresp=='SI'){ echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td colspan="6"><strong>REACCIONES ALÉRGICAS QUE NO LO DEJAN RESPIRAR</strong></td>
    <td style="text-align:center"><input name="ant_person_pato_reacalerg" class="ant_person_pato_reacalerg" class="ant_person_pato_reacalerg" id="<?php echo $cod_trabajo_altura ?>" type="checkbox" value="SI" <? if($ant_person_pato_reacalerg=='SI'){ echo "checked"; } ?>></td>
    <td colspan="6"><strong>PROBLEMAS DEL CORAZÓN</strong></td>
    <td style="text-align:center"><input name="ant_person_pato_problemcorazon" class="ant_person_pato_problemcorazon" class="ant_person_pato_problemcorazon" id="<?php echo $cod_trabajo_altura ?>" type="checkbox" value="SI" <? if($ant_person_pato_problemcorazon=='SI'){ echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td colspan="6"><strong>CLAUSTROFOBIA (MIEDO A ESTAR EN ESPACIOS CERRADOS)</strong></td>
    <td style="text-align:center"><input name="ant_person_pato_claustofob" class="ant_person_pato_claustofob" class="ant_person_pato_claustofob" id="<?php echo $cod_trabajo_altura ?>" type="checkbox" value="SI" <? if($ant_person_pato_claustofob=='SI'){ echo "checked"; } ?>></td>
    <td colspan="6"><strong>PRESIÓN ALTA</strong></td>
    <td style="text-align:center"><input name="ant_person_pato_presionalta" class="ant_person_pato_presionalta" class="ant_person_pato_presionalta" id="<?php echo $cod_trabajo_altura ?>" type="checkbox" value="SI" <? if($ant_person_pato_presionalta=='SI'){ echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td colspan="6"><strong>DIFICULTAD AL OLER (EXCEPTO CON RESFRIADO)</strong></td>
    <td style="text-align:center"><input name="ant_person_pato_dificuloler" class="ant_person_pato_dificuloler" class="ant_person_pato_dificuloler" id="<?php echo $cod_trabajo_altura ?>" type="checkbox" value="SI" <? if($ant_person_pato_dificuloler=='SI'){ echo "checked"; } ?>></td>
    <td colspan="6"><strong>TOMA MEDICAMENTOS</strong></td>
    <td style="text-align:center"><input name="ant_person_pato_tomamedicam" class="ant_person_pato_tomamedicam" class="ant_person_pato_tomamedicam" id="<?php echo $cod_trabajo_altura ?>" type="checkbox" value="SI" <? if($ant_person_pato_tomamedicam=='SI'){ echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td colspan="6"><strong>DIABETES (AZÚCAR EN LA SANGRE)</strong></td>
    <td style="text-align:center"><input name="ant_person_pato_diabetes" class="ant_person_pato_diabetes" class="ant_person_pato_diabetes" id="<?php echo $cod_trabajo_altura ?>" type="checkbox" value="SI" <? if($ant_person_pato_diabetes=='SI'){ echo "checked"; } ?>></td>
    <td colspan="6"><p><strong>USA LENTES</strong></td>
    <td style="text-align:center"><input name="ant_person_pato_usalentes" class="ant_person_pato_usalentes" class="ant_person_pato_usalentes" id="<?php echo $cod_trabajo_altura ?>" type="checkbox" value="SI" <? if($ant_person_pato_usalentes=='SI'){ echo "checked"; } ?>></td>
  </tr>
  <tr>
    <td colspan="6"><strong>PROBLEMAS PULMONARES</strong></td>
    <td style="text-align:center"><input name="ant_person_pato_problempulmonar" class="ant_person_pato_problempulmonar" class="ant_person_pato_problempulmonar" id="<?php echo $cod_trabajo_altura ?>" type="checkbox" value="SI" <? if($ant_person_pato_problempulmonar=='SI'){ echo "checked"; } ?>></td>
    <td colspan="6"><strong>DIFICULTAD PARA DISTINGUIR LOS COLORES</strong></td>
    <td style="text-align:center"><input name="ant_person_pato_dificuldistinguircolor" class="ant_person_pato_dificuldistinguircolor" class="ant_person_pato_dificuldistinguircolor" id="<?php echo $cod_trabajo_altura ?>" type="checkbox" value="SI" <? if($ant_person_pato_dificuldistinguircolor=='SI'){ echo "checked"; } ?>></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td colspan="14"><strong>IX. EXPLORACIÓN FÍSICA</strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>SIGNOS VITALES:<input style="text-align:center;width:150px;height:20px" class="input-block-level" name="explo_fis_signovital" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_signovital ?>"/></strong></td>
    <td colspan="6"><strong>FC:<input style="text-align:center;width:150px;height:20px" class="input-block-level" name="explo_fis_fc" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_fc ?>"/></strong></td>
    <td colspan="2"><strong>FR:<input style="text-align:center;width:150px;height:20px" class="input-block-level" name="explo_fis_fr" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_fr ?>"/></strong></td>
    <td colspan="3"><strong>TA:<input style="text-align:center;width:150px;height:20px" class="input-block-level" name="explo_fis_ta" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_ta ?>"/></strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>ANTROPOMETRÍA:<input style="text-align:center;width:150px;height:20px" class="input-block-level" name="explo_fis_antropometria" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_antropometria ?>"/></strong></td>
    <td colspan="6"><strong>PESO:<input style="text-align:center;width:150px;height:20px" class="input-block-level" name="explo_fis_peso" class="explo_fis_peso" id="explo_fis_peso" type="text" value="<?php echo $explo_fis_peso ?>" onChange="calc_imc();"/></strong></td>
    <td colspan="2"><strong>TALLA:<input style="text-align:center;width:150px;height:20px" class="input-block-level" name="explo_fis_talla" class="explo_fis_talla" id="explo_fis_talla" type="text" value="<?php echo $explo_fis_talla ?>" onChange="calc_imc();"/></strong></td>
    <td colspan="3"><strong>IMC:<input style="text-align:center;width:150px;height:20px" class="input-block-level" name="explo_fis_imc" id="explo_fis_imc" type="text" value="<?php echo $explo_fis_imc ?>"/></strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>PERÍMETRO DE LA MUÑECA:<input style="text-align:center;width:150px;height:20px" class="input-block-level" name="explo_fis_perimuneca" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_perimuneca ?>"/></strong></td>
    <td colspan="7"><strong>PERÍMETRO DE LA CINTURA:<input style="text-align:center;width:150px;height:20px" class="input-block-level" name="explo_fis_pericintura" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_pericintura ?>"/></strong></td>
  </tr>
</table>

<script>
function calc_imc(){
var explo_fis_talla = document.getElementById("explo_fis_talla").value;
var explo_fis_peso = document.getElementById("explo_fis_peso").value;
var explo_fis_imc = (explo_fis_peso / Math.pow(explo_fis_talla, 2)).toFixed(2);
var exa_fis_interpreimc = "";
var img_imc = "";

if ((explo_fis_imc  < 18.50)) { exa_fis_interpreimc = "BAJO PESO"; img_imc = '<img src="../imagenes/imc/peso1.png">'; }
if ((explo_fis_imc  >= 18.50) && (explo_fis_imc  <= 24.99)) { exa_fis_interpreimc = "PESO NORMAL"; img_imc = '<img src="../imagenes/imc/peso2.png">'; }
if ((explo_fis_imc  >= 25.0) && (explo_fis_imc  <= 29.99)) { exa_fis_interpreimc = "SOBREPESO"; img_imc = '<img src="../imagenes/imc/peso3.png">'; }
if ((explo_fis_imc  >= 30.0) && (explo_fis_imc  <= 34.99)) { exa_fis_interpreimc = "OBESIDAD I"; img_imc = '<img src="../imagenes/imc/peso4.png">'; }
if ((explo_fis_imc  >= 35.0) && (explo_fis_imc  <= 39.99)) { exa_fis_interpreimc = "OBESIDAD II"; img_imc = '<img src="../imagenes/imc/peso5.png">'; }
if ((explo_fis_imc  >= 40.0) && (explo_fis_imc  <= 49.99)) { exa_fis_interpreimc = "OBESIDAD III"; img_imc = '<img src="../imagenes/imc/peso6.png">'; }
if ((explo_fis_imc  >= 50.0)) { exa_fis_interpreimc = "OBESIDAD EXTREMA"; img_imc = '<img src="../imagenes/imc/peso7.png">'; }

document.getElementById("explo_fis_imc").value = explo_fis_imc;
//document.getElementById("exa_fis_interpreimc").value = exa_fis_interpreimc;
//document.getElementsByName("img_imc").innerHTML=img_imc;
}
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
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
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_sncorre_vlejan" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $exa_fis_ojoder_sncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_sncorre_vcerca" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $exa_fis_ojoder_sncorre_vcerca ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_cncorre_vlejan" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $exa_fis_ojoder_cncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoder_cncorre_vcerca" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $exa_fis_ojoder_cncorre_vcerca ?>"/></td>
        </tr>
        <tr>
            <td><strong>OJO IZQUIERDO</strong></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_sncorre_vlejan" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $exa_fis_ojoizq_sncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_sncorre_vcerca" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $exa_fis_ojoizq_sncorre_vcerca ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_cncorre_vlejan" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $exa_fis_ojoizq_cncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoizq_cncorre_vcerca" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $exa_fis_ojoizq_cncorre_vcerca ?>"/></td>
        </tr>
        <tr>
            <td><strong>AMBOS OJOS</strong></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoamb_sncorre_vlejan" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $exa_fis_ojoamb_sncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoamb_sncorre_vcerca" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $exa_fis_ojoamb_sncorre_vcerca ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_oojoamb_cncorre_vlejan"id="<?php echo $cod_trabajo_altura ?>"  type="text" value="<?php echo $exa_fis_oojoamb_cncorre_vlejan ?>"/></td>
            <td style="text-align:center"><input style="text-align:center" class="form-control input-sm" name="exa_fis_ojoamb_cncorre_vcerca" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $exa_fis_ojoamb_cncorre_vcerca ?>"/></td>
        </tr>
    </tbody>
</table>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td colspan="2" rowspan="2"><strong>VISIÓN AV:<input style="text-align:center;width:150px;height:20px" class="input-block-level" name="explo_fis_visionav" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_visionav ?>"/></strong></td>
    <td colspan="3"><strong>OD:<input style="text-align:center;width:100px;height:20px" class="input-block-level" name="explo_fis_od" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_od ?>"/></strong></td>
    <td colspan="9" rowspan="2"><strong>ISHIHARA:<input style="width:550px;height:20px" class="input-block-level" name="explo_fis_ishihara" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_ishihara ?>"/></strong></td>
  </tr>
  <tr>
    <td colspan="3"><strong>OI:<input style="text-align:center;width:100px;height:20px" class="input-block-level" name="explo_fis_oi" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_oi ?>"/></strong></td>
  </tr>
  <tr>
    <td colspan="12"><strong>CABEZA:</strong></td>
    <td colspan="2"><strong><input style="width:650px;height:20px" class="input-block-level" name="explo_fis_cabeza" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_cabeza ?>"/></strong></td>
  </tr>
  <tr>
    <td colspan="12"><strong>CUELLO:</strong></td>
    <td colspan="2"><strong><input style="width:650px;height:20px" class="input-block-level" name="explo_fis_cuello" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_cuello ?>"/></strong></td>
  </tr>
  <tr>
    <td colspan="12"><strong>CARDIO PULMONAR:</strong></td>
    <td colspan="2"><strong><input style="width:650px;height:20px" class="input-block-level" name="explo_fis_cadiopulm" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_cadiopulm ?>"/></strong></td>
  </tr>
  <tr>
    <td colspan="12"><strong>DIGESTIVO:</strong></td>
    <td colspan="2"><strong><input style="width:650px;height:20px" class="input-block-level" name="explo_fis_digestivo" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_digestivo ?>"/></strong></td>
  </tr>
  <tr>
    <td colspan="12"><strong>SISTEMA MUSCULO ESQUELÉTICO:</strong></td>
    <td colspan="2"><strong><input style="width:650px;height:20px" class="input-block-level" name="explo_fis_sistemmuscesquelet" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_sistemmuscesquelet ?>"/></strong></td>
  </tr>
  <tr>
    <td colspan="12"><strong>PIEL Y ANEXOS:</strong></td>
    <td colspan="2"><strong><input style="width:650px;height:20px" class="input-block-level" name="explo_fis_pielanexos" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_pielanexos ?>"/></strong></td>
  </tr>
  <tr>
    <td colspan="12"><strong>TEST DE ROMBERG:</strong></td>
    <td colspan="2"><strong><input style="width:650px;height:20px" class="input-block-level" name="explo_fis_testromberg" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_testromberg ?>"/></strong></td>
  </tr>
  <tr>
    <td colspan="12"><strong>PRUEBA DE LA MARCHA:</strong></td>
    <td colspan="2"><strong><input style="width:650px;height:20px" class="input-block-level" name="explo_fis_priebmarcha" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_priebmarcha ?>"/></strong></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>

<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td><strong>X. RECOMENDACIONES ESPECÍFICAS TRABAJADOR: <input style="te;width:650px;height:20px" class="input-block-level" name="explo_fis_recomenespeciftrab" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_recomenespeciftrab ?>"/></strong></td>
  </tr>
  <tr>
    <td><strong>XI. RECOMENDACIONES ESPECÍFICAS EMPRESA: <input style="width:650px;height:20px" class="input-block-level" name="explo_fis_recomenespecifempre" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_recomenespecifempre ?>"/></strong></td>
  </tr>
  <tr>
    <td>IDX: <input style="width:650px;height:20px" class="input-block-level" name="explo_fis_idx" id="<?php echo $cod_trabajo_altura ?>" type="text" value="<?php echo $explo_fis_idx ?>"/></td>
  </tr>
</table>
<!-- /////////////////////////////////////////////////// -->
<br>

<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
  <tr>
    <td style="text-align:center;">REMITIDO:
<select name="nombre_tipo_remision" class="selectpicker" data-show-subtext="true" data-live-search="true" >
<?php if (isset($nombre_tipo_remision)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_tipo_remision, nombre_tipo_remision FROM tbl15_tipo_remision ORDER BY nombre_tipo_remision ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_tipo_remision) and $nombre_tipo_remision == $datos2['nombre_tipo_remision']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_tipo_remision'];
$nombre = $datos2['nombre_tipo_remision'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
   </td>

    <td style="text-align:center;">FECHA CONTROL:
	<div id="fecha_control" class="input-append date"><input id="<?php echo $cod_trabajo_altura ?>" type="text" name="fecha_control" value="<?php echo $fecha_control ?>"></input><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div>
   </td>

    <td style="text-align:center;">ESTADO TRABAJADOR:
<select name="nombre_acepta_trab_altura" required>
<?php if (isset($nombre_acepta_trab_altura)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_acepta_trab_altura, nombre_acepta_trab_altura FROM tbl15_acepta_trab_altura ORDER BY nombre_acepta_trab_altura ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_acepta_trab_altura) and $nombre_acepta_trab_altura == $datos2['nombre_acepta_trab_altura']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_acepta_trab_altura'];
$nombre = $datos2['nombre_acepta_trab_altura'];
echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</select>
   </td>
  </tr>
</table>

<!-- /////////////////////////////////////////////////// -->
<br>

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
<input type="hidden" name="cod_trabajo_altura" value="<?php echo $cod_trabajo_altura ?>">
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>">
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
<script type="text/javascript">$('#fecha_control').datetimepicker({ format: 'yyyy/MM/dd', language: 'es' });</script>
<!-- 1****************************************************************************************************** -->
<script type="text/javascript">
$(document).ready(function() {

$(".ant_person_pato_convul").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_convul").val("SI"); } else { $(".ant_person_pato_convul").val("NO"); } });
$(".ant_person_pato_dificulresp").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_dificulresp").val("SI"); } else { $(".ant_person_pato_dificulresp").val("NO"); } });
$(".ant_person_pato_reacalerg").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_reacalerg").val("SI"); } else { $(".ant_person_pato_reacalerg").val("NO"); } });
$(".ant_person_pato_problemcorazon").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_problemcorazon").val("SI"); } else { $(".ant_person_pato_problemcorazon").val("NO"); } });
$(".ant_person_pato_claustofob").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_claustofob").val("SI"); } else { $(".ant_person_pato_claustofob").val("NO"); } });
$(".ant_person_pato_presionalta").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_presionalta").val("SI"); } else { $(".ant_person_pato_presionalta").val("NO"); } });
$(".ant_person_pato_dificuloler").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_dificuloler").val("SI"); } else { $(".ant_person_pato_dificuloler").val("NO"); } });
$(".ant_person_pato_tomamedicam").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_tomamedicam").val("SI"); } else { $(".ant_person_pato_tomamedicam").val("NO"); } });
$(".ant_person_pato_diabetes").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_diabetes").val("SI"); } else { $(".ant_person_pato_diabetes").val("NO"); } });
$(".ant_person_pato_usalentes").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_usalentes").val("SI"); } else { $(".ant_person_pato_usalentes").val("NO"); } });
$(".ant_person_pato_problempulmonar").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_problempulmonar").val("SI"); } else { $(".ant_person_pato_problempulmonar").val("NO"); } });
$(".ant_person_pato_dificuldistinguircolor").change(function(){ if( $(this).is(':checked') ){ $(".ant_person_pato_dificuldistinguircolor").val("SI"); } else { $(".ant_person_pato_dificuldistinguircolor").val("NO"); } });

$("input").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
$.ajax({  
    url:"guardar_edit_trabajo_altura_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_trabajo_altura ?>},  
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
    url:"guardar_edit_trabajo_altura_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_trabajo_altura ?>},  
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
    url:"guardar_edit_trabajo_altura_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:<?php echo $cod_trabajo_altura ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});

});
</script>
</body>
</html>