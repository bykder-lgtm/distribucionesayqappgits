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

if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

$cod_grupo_area_cargo                = intval($_POST['cod_grupo_area_cargo']);
$cod_grupo_area                      = intval($_POST['cod_grupo_area']);
$nombre_grupo_area_cargo             = addslashes(strtoupper($_POST['nombre_grupo_area_cargo']));
$funcion_grupo_area_cargo            = addslashes(($_POST['funcion_grupo_area_cargo']));
$nombre_escolaridad                  = addslashes(($_POST['nombre_escolaridad']));
$conocimientos_especificos           = addslashes(($_POST['conocimientos_especificos']));
$experiencia_previa_requerida        = addslashes(($_POST['experiencia_previa_requerida']));
$resp_supervision                    = addslashes(($_POST['resp_supervision']));
$resp_maquina_equipo_material        = addslashes(($_POST['resp_maquina_equipo_material']));
$resp_relacion                       = addslashes(($_POST['resp_relacion']));
$resp_operaciones_tecnica            = addslashes(($_POST['resp_operaciones_tecnica']));
$resp_valores                        = addslashes(($_POST['resp_valores']));
$org_metodo_trabajo                  = addslashes(($_POST['org_metodo_trabajo']));
$nombre_nivel_esfuerzo               = addslashes(($_POST['nombre_nivel_esfuerzo']));
$descripcion_ambiente                = addslashes(($_POST['descripcion_ambiente']));
$maquinas_equipo_herramienta         = addslashes(($_POST['maquinas_equipo_herramienta']));
$horario                             = addslashes(($_POST['horario']));
$dat_ocupa_visu1                     = addslashes(($_POST['dat_ocupa_visu1']));
$dat_ocupa_audi1                     = addslashes(($_POST['dat_ocupa_audi1']));
$dat_ocupa_resp1                     = addslashes(($_POST['dat_ocupa_resp1']));
$dat_ocupa_cabeza1                   = addslashes(($_POST['dat_ocupa_cabeza1']));
$dat_ocupa_manos1                    = addslashes(($_POST['dat_ocupa_manos1']));
$dat_ocupa_tronco1                   = addslashes(($_POST['dat_ocupa_tronco1']));
$dat_ocupa_pies1                     = addslashes(($_POST['dat_ocupa_pies1']));
$dat_ocupa_altu1                     = addslashes(($_POST['dat_ocupa_altu1']));
$descrip_protec_visual               = addslashes(($_POST['descrip_protec_visual']));
$descrip_protec_audit                = addslashes(($_POST['descrip_protec_audit']));
$descrip_protec_resp                 = addslashes(($_POST['descrip_protec_resp']));
$descrip_protec_cabeza               = addslashes(($_POST['descrip_protec_cabeza']));
$descrip_protec_manos                = addslashes(($_POST['descrip_protec_manos']));
$descrip_protec_tronco               = addslashes(($_POST['descrip_protec_tronco']));
$descrip_protec_pies                 = addslashes(($_POST['descrip_protec_pies']));
$descrip_protec_altura               = addslashes(($_POST['descrip_protec_altura']));
$ingreso_hemograma                   = addslashes(($_POST['ingreso_hemograma']));
$ingreso_perfil_lipidico             = addslashes(($_POST['ingreso_perfil_lipidico']));
$ingreso_audiometria                 = addslashes(($_POST['ingreso_audiometria']));
$ingreso_visiometria                 = addslashes(($_POST['ingreso_visiometria']));
$ingreso_espirometria                = addslashes(($_POST['ingreso_espirometria']));
$ingreso_enfa_osteo                  = addslashes(($_POST['ingreso_enfa_osteo']));
$ingreso_manipul_aliment             = addslashes(($_POST['ingreso_manipul_aliment']));
$periodico_anyo_hemograma            = addslashes(($_POST['periodico_anyo_hemograma']));
$periodico_anyo_perfil_lipidico      = addslashes(($_POST['periodico_anyo_perfil_lipidico']));
$periodico_anyo_audiometria          = addslashes(($_POST['periodico_anyo_audiometria']));
$periodico_anyo_visiometria          = addslashes(($_POST['periodico_anyo_visiometria']));
$periodico_anyo_espirometria         = addslashes(($_POST['periodico_anyo_espirometria']));
$periodico_anyo_enfa_osteo           = addslashes(($_POST['periodico_anyo_enfa_osteo']));
$periodico_anyo_manipul_aliment      = addslashes(($_POST['periodico_anyo_manipul_aliment']));
$egreso_hemograma                    = addslashes(($_POST['egreso_hemograma']));
$egreso_perfil_lipidico              = addslashes(($_POST['egreso_perfil_lipidico']));
$egreso_audiometria                  = addslashes(($_POST['egreso_audiometria']));
$egreso_visiometria                  = addslashes(($_POST['egreso_visiometria']));
$egreso_espirometria                 = addslashes(($_POST['egreso_espirometria']));
$egreso_enfa_osteo                   = addslashes(($_POST['egreso_enfa_osteo']));
$egreso_manipul_aliment              = addslashes(($_POST['egreso_manipul_aliment']));
$vacunacion_tetano                   = addslashes(($_POST['vacunacion_tetano']));
$vacunacion_fiebre_amarilla          = addslashes(($_POST['vacunacion_fiebre_amarilla']));
$vacunacion_influenza                = addslashes(($_POST['vacunacion_influenza']));

$actualizar_historia_clinica = "UPDATE tbl15_grupo_area_cargo SET cod_grupo_area = '$cod_grupo_area', nombre_grupo_area_cargo = '$nombre_grupo_area_cargo', 
funcion_grupo_area_cargo = '$funcion_grupo_area_cargo', 
nombre_escolaridad = '$nombre_escolaridad', conocimientos_especificos = '$conocimientos_especificos', 
experiencia_previa_requerida = '$experiencia_previa_requerida', resp_supervision = '$resp_supervision', 
resp_maquina_equipo_material = '$resp_maquina_equipo_material', resp_relacion = '$resp_relacion', 
resp_operaciones_tecnica = '$resp_operaciones_tecnica', resp_valores = '$resp_valores', 
org_metodo_trabajo = '$org_metodo_trabajo', nombre_nivel_esfuerzo = '$nombre_nivel_esfuerzo', 
descripcion_ambiente = '$descripcion_ambiente', maquinas_equipo_herramienta = '$maquinas_equipo_herramienta', 
horario = '$horario', dat_ocupa_visu1 = '$dat_ocupa_visu1', dat_ocupa_audi1 = '$dat_ocupa_audi1', 
dat_ocupa_resp1 = '$dat_ocupa_resp1', dat_ocupa_cabeza1 = '$dat_ocupa_cabeza1', dat_ocupa_manos1 = '$dat_ocupa_manos1', 
dat_ocupa_tronco1 = '$dat_ocupa_tronco1', dat_ocupa_pies1 = '$dat_ocupa_pies1', dat_ocupa_altu1 = '$dat_ocupa_altu1', 
descrip_protec_visual = '$descrip_protec_visual', descrip_protec_audit = '$descrip_protec_audit', 
descrip_protec_resp = '$descrip_protec_resp', descrip_protec_cabeza = '$descrip_protec_cabeza', 
descrip_protec_manos = '$descrip_protec_manos', descrip_protec_tronco = '$descrip_protec_tronco', 
descrip_protec_pies = '$descrip_protec_pies', descrip_protec_altura = '$descrip_protec_altura', 
ingreso_hemograma = '$ingreso_hemograma', ingreso_perfil_lipidico = '$ingreso_perfil_lipidico', 
ingreso_audiometria = '$ingreso_audiometria', ingreso_visiometria = '$ingreso_visiometria', 
ingreso_espirometria = '$ingreso_espirometria', ingreso_enfa_osteo = '$ingreso_enfa_osteo', 
ingreso_manipul_aliment = '$ingreso_manipul_aliment', periodico_anyo_hemograma = '$periodico_anyo_hemograma', 
periodico_anyo_perfil_lipidico = '$periodico_anyo_perfil_lipidico', periodico_anyo_audiometria = '$periodico_anyo_audiometria', 
periodico_anyo_visiometria = '$periodico_anyo_visiometria', periodico_anyo_espirometria = '$periodico_anyo_espirometria', 
periodico_anyo_enfa_osteo = '$periodico_anyo_enfa_osteo', periodico_anyo_manipul_aliment = '$periodico_anyo_manipul_aliment', 
egreso_hemograma = '$egreso_hemograma', egreso_perfil_lipidico = '$egreso_perfil_lipidico', egreso_audiometria = '$egreso_audiometria', 
egreso_visiometria = '$egreso_visiometria', egreso_espirometria = '$egreso_espirometria', 
egreso_enfa_osteo = '$egreso_enfa_osteo', egreso_manipul_aliment = '$egreso_manipul_aliment', 
vacunacion_tetano = '$vacunacion_tetano', vacunacion_fiebre_amarilla = '$vacunacion_fiebre_amarilla', 
vacunacion_influenza = '$vacunacion_influenza'
WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'";
$resultado_historia_clinica = mysqli_query($conectar, $actualizar_historia_clinica) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_grupo_area_cargo.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_grupo_area_cargo.php">
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