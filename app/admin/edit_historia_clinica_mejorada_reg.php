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

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {
$pagina_else = addslashes($_POST['pagina']);

$cod_historia_clinica = intval($_POST['cod_historia_clinica']);

if (isset($_POST['nombre_tipo_doc']) <> '') { $nombre_tipo_doc = addslashes($_POST['nombre_tipo_doc']); } else { $nombre_tipo_doc = ''; }
if (isset($_POST['cedula']) <> '') { $cedula = intval($_POST['cedula']); } else { $cedula = ''; }
if (isset($_POST['nombres']) <> '') { $nombres = addslashes($_POST['nombres']); } else { $nombres = ''; }
if (isset($_POST['apellido1']) <> '') { $apellido1 = addslashes($_POST['apellido1']); } else { $apellido1 = ''; }
if (isset($_POST['nombre_sexo']) <> '') { $nombre_sexo = addslashes($_POST['nombre_sexo']); } else { $nombre_sexo = ''; }
if (isset($_POST['fecha_nac_ymd']) <> '') { $fecha_nac_ymd = addslashes($_POST['fecha_nac_ymd']); } else { $fecha_nac_ymd = ''; }
if (isset($_POST['lugar_nac']) <> '') { $lugar_nac = addslashes($_POST['lugar_nac']); } else { $lugar_nac = ''; }
if (isset($_POST['lugar_procedencia']) <> '') { $lugar_procedencia = addslashes($_POST['lugar_procedencia']); } else { $lugar_procedencia = ''; }
$fecha_nac_time                = strtotime($fecha_nac_ymd);

if (isset($_POST['nombre_estado_civil']) <> '') { $nombre_estado_civil = addslashes($_POST['nombre_estado_civil']); } else { $nombre_estado_civil = ''; }
if (isset($_POST['nombre_numero_hijos']) <> '') { $nombre_numero_hijos = addslashes($_POST['nombre_numero_hijos']); } else { $nombre_numero_hijos = ''; }
if (isset($_POST['tel_cliente']) <> '') { $tel_cliente = addslashes($_POST['tel_cliente']); } else { $tel_cliente = ''; }
if (isset($_POST['nombre_escolaridad']) <> '') { $nombre_escolaridad = addslashes($_POST['nombre_escolaridad']); } else { $nombre_escolaridad = ''; }
if (isset($_POST['cod_entidad']) <> '') { $cod_entidad = intval($_POST['cod_entidad']); } else { $cod_entidad = ''; }
if (isset($_POST['nombre_tipo_regimen']) <> '') { $nombre_tipo_regimen = addslashes($_POST['nombre_tipo_regimen']); } else { $nombre_tipo_regimen = ''; }
if (isset($_POST['nombre_fondo_pension']) <> '') { $nombre_fondo_pension = addslashes($_POST['nombre_fondo_pension']); } else { $nombre_fondo_pension = ''; }
if (isset($_POST['nombre_arl']) <> '') { $nombre_arl = addslashes($_POST['nombre_arl']); } else { $nombre_arl = ''; }
if (isset($_POST['nombre_contacto1']) <> '') { $nombre_contacto1 = addslashes($_POST['nombre_contacto1']); } else { $nombre_contacto1 = ''; }
if (isset($_POST['parentesco_contacto1']) <> '') { $parentesco_contacto1 = addslashes($_POST['parentesco_contacto1']); } else { $parentesco_contacto1 = ''; }
if (isset($_POST['direccion_contacto1']) <> '') { $direccion_contacto1 = addslashes($_POST['direccion_contacto1']); } else { $direccion_contacto1 = ''; }
if (isset($_POST['tel_contacto1']) <> '') { $tel_contacto1 = addslashes($_POST['tel_contacto1']); } else { $tel_contacto1 = ''; }

if (isset($_POST['motivo']) <> '') { $motivo = addslashes($_POST['motivo']); } else { $motivo = ''; }
if (isset($_POST['nombre_empresa_contratante']) <> '') { $nombre_empresa_contratante = addslashes($_POST['nombre_empresa_contratante']); } else { $nombre_empresa_contratante = ''; }
if (isset($_POST['nombre_empresa']) <> '') { $nombre_empresa = addslashes($_POST['nombre_empresa']); } else { $nombre_empresa = ''; }
if (isset($_POST['nombre_actividad_ecoemp']) <> '') { $nombre_actividad_ecoemp = addslashes($_POST['nombre_actividad_ecoemp']); } else { $nombre_actividad_ecoemp = ''; }
//if (isset($_POST['area_empresa']) <> '') { $area_empresa = addslashes($_POST['area_empresa']); } else { $area_empresa = ''; }
if (isset($_POST['ciudad_empresa']) <> '') { $ciudad_empresa = addslashes($_POST['ciudad_empresa']); } else { $ciudad_empresa = ''; }

$sql_cliente = "SELECT cod_cliente FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$cod_cliente = $datos_cliente['cod_cliente'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_grupo_area_cargo']) <> '') { $cod_grupo_area_cargo = intval($_POST['cod_grupo_area_cargo']); } else { $cod_grupo_area_cargo = '0'; }
$sql_grupo_area_cargo = "SELECT cod_grupo_area, nombre_grupo_area_cargo FROM tbl15_grupo_area_cargo WHERE cod_grupo_area_cargo = '$cod_grupo_area_cargo'";
$consulta_grupo_area_cargo = mysqli_query($conectar, $sql_grupo_area_cargo) or die(mysqli_error($conectar));
$datos_grupo_area_cargo = mysqli_fetch_assoc($consulta_grupo_area_cargo);

$cod_grupo_area = $datos_grupo_area_cargo['cod_grupo_area'];
$cargo_empresa = $datos_grupo_area_cargo['nombre_grupo_area_cargo'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_grupo_area = "SELECT * FROM tbl15_grupo_area WHERE cod_grupo_area = '$cod_grupo_area'";
$consulta_grupo_area = mysqli_query($conectar, $sql_grupo_area) or die(mysqli_error($conectar));
$datos_grupo_area = mysqli_fetch_assoc($consulta_grupo_area);

$nombre_grupo_area = $datos_grupo_area['nombre_grupo_area'];
$area_empresa = $datos_grupo_area['nombre_grupo_area'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['dat_ocupa_emp1']) <> '') { $dat_ocupa_emp1 = addslashes($_POST['dat_ocupa_emp1']); } else { $dat_ocupa_emp1 = ''; }
//if (isset($_POST['dat_ocupa_carg1']) <> '') { $dat_ocupa_carg1 = addslashes($_POST['dat_ocupa_carg1']); } else { $dat_ocupa_carg1 = ''; }
$dat_ocupa_carg1 = $nombre_grupo_area.' - '.$cargo_empresa;

if (isset($_POST['dat_ocupa_visu1']) <> '') { $dat_ocupa_visu1 = addslashes($_POST['dat_ocupa_visu1']); } else { $dat_ocupa_visu1 = 'N'; }
if (isset($_POST['dat_ocupa_audi1']) <> '') { $dat_ocupa_audi1 = addslashes($_POST['dat_ocupa_audi1']); } else { $dat_ocupa_audi1 = 'N'; }
if (isset($_POST['dat_ocupa_altu1']) <> '') { $dat_ocupa_altu1 = addslashes($_POST['dat_ocupa_altu1']); } else { $dat_ocupa_altu1 = 'N'; }
if (isset($_POST['dat_ocupa_resp1']) <> '') { $dat_ocupa_resp1 = addslashes($_POST['dat_ocupa_resp1']); } else { $dat_ocupa_resp1 = 'N'; }
if (isset($_POST['dat_ocupa_cabeza1']) <> '') { $dat_ocupa_cabeza1 = addslashes($_POST['dat_ocupa_cabeza1']); } else { $dat_ocupa_cabeza1 = 'N'; }
if (isset($_POST['dat_ocupa_manos1']) <> '') { $dat_ocupa_manos1 = addslashes($_POST['dat_ocupa_manos1']); } else { $dat_ocupa_manos1 = 'N'; }
if (isset($_POST['dat_ocupa_tronco1']) <> '') { $dat_ocupa_tronco1 = addslashes($_POST['dat_ocupa_tronco1']); } else { $dat_ocupa_tronco1 = 'N'; }
if (isset($_POST['dat_ocupa_pies1']) <> '') { $dat_ocupa_pies1 = addslashes($_POST['dat_ocupa_pies1']); } else { $dat_ocupa_pies1 = 'N'; }
if (isset($_POST['dat_ocupa_fech_ini1']) <> '') { $dat_ocupa_fech_ini1 = addslashes($_POST['dat_ocupa_fech_ini1']); } else { $dat_ocupa_fech_ini1 = ''; }
if (isset($_POST['dat_ocupa_dura_anyo1']) <> '') { $dat_ocupa_dura_anyo1 = addslashes($_POST['dat_ocupa_dura_anyo1']); } else { $dat_ocupa_dura_anyo1 = ''; }
if (isset($_POST['dat_ocupa_emp2']) <> '') { $dat_ocupa_emp2 = addslashes($_POST['dat_ocupa_emp2']); } else { $dat_ocupa_emp2 = ''; }
if (isset($_POST['dat_ocupa_carg2']) <> '') { $dat_ocupa_carg2 = addslashes($_POST['dat_ocupa_carg2']); } else { $dat_ocupa_carg2 = 'N'; }
if (isset($_POST['dat_ocupa_visu2']) <> '') { $dat_ocupa_visu2 = addslashes($_POST['dat_ocupa_visu2']); } else { $dat_ocupa_visu2 = 'N'; }
if (isset($_POST['dat_ocupa_audi2']) <> '') { $dat_ocupa_audi2 = addslashes($_POST['dat_ocupa_audi2']); } else { $dat_ocupa_audi2 = 'N'; }
if (isset($_POST['dat_ocupa_altu2']) <> '') { $dat_ocupa_altu2 = addslashes($_POST['dat_ocupa_altu2']); } else { $dat_ocupa_altu2 = 'N'; }
if (isset($_POST['dat_ocupa_resp2']) <> '') { $dat_ocupa_resp2 = addslashes($_POST['dat_ocupa_resp2']); } else { $dat_ocupa_resp2 = 'N'; }
if (isset($_POST['dat_ocupa_cabeza2']) <> '') { $dat_ocupa_cabeza2 = addslashes($_POST['dat_ocupa_cabeza2']); } else { $dat_ocupa_cabeza2 = 'N'; }
if (isset($_POST['dat_ocupa_manos2']) <> '') { $dat_ocupa_manos2 = addslashes($_POST['dat_ocupa_manos2']); } else { $dat_ocupa_manos2 = 'N'; }
if (isset($_POST['dat_ocupa_tronco2']) <> '') { $dat_ocupa_tronco2 = addslashes($_POST['dat_ocupa_tronco2']); } else { $dat_ocupa_tronco2 = 'N'; }
if (isset($_POST['dat_ocupa_pies2']) <> '') { $dat_ocupa_pies2 = addslashes($_POST['dat_ocupa_pies2']); } else { $dat_ocupa_pies2 = 'N'; }
if (isset($_POST['dat_ocupa_fech_ini2']) <> '') { $dat_ocupa_fech_ini2 = addslashes($_POST['dat_ocupa_fech_ini2']); } else { $dat_ocupa_fech_ini2 = ''; }
if (isset($_POST['dat_ocupa_dura_anyo2']) <> '') { $dat_ocupa_dura_anyo2 = addslashes($_POST['dat_ocupa_dura_anyo2']); } else { $dat_ocupa_dura_anyo2 = ''; }
if (isset($_POST['dat_ocupa_emp3']) <> '') { $dat_ocupa_emp3 = addslashes($_POST['dat_ocupa_emp3']); } else { $dat_ocupa_emp3 = ''; }
if (isset($_POST['dat_ocupa_carg3']) <> '') { $dat_ocupa_carg3 = addslashes($_POST['dat_ocupa_carg3']); } else { $dat_ocupa_carg3 = 'N'; }
if (isset($_POST['dat_ocupa_visu3']) <> '') { $dat_ocupa_visu3 = addslashes($_POST['dat_ocupa_visu3']); } else { $dat_ocupa_visu3 = 'N'; }
if (isset($_POST['dat_ocupa_audi3']) <> '') { $dat_ocupa_audi3 = addslashes($_POST['dat_ocupa_audi3']); } else { $dat_ocupa_audi3 = 'N'; }
if (isset($_POST['dat_ocupa_altu3']) <> '') { $dat_ocupa_altu3 = addslashes($_POST['dat_ocupa_altu3']); } else { $dat_ocupa_altu3 = 'N'; }
if (isset($_POST['dat_ocupa_resp3']) <> '') { $dat_ocupa_resp3 = addslashes($_POST['dat_ocupa_resp3']); } else { $dat_ocupa_resp3 = 'N'; }
if (isset($_POST['dat_ocupa_cabeza3']) <> '') { $dat_ocupa_cabeza3 = addslashes($_POST['dat_ocupa_cabeza3']); } else { $dat_ocupa_cabeza3 = 'N'; }
if (isset($_POST['dat_ocupa_manos3']) <> '') { $dat_ocupa_manos3 = addslashes($_POST['dat_ocupa_manos3']); } else { $dat_ocupa_manos3 = 'N'; }
if (isset($_POST['dat_ocupa_tronco3']) <> '') { $dat_ocupa_tronco3 = addslashes($_POST['dat_ocupa_tronco3']); } else { $dat_ocupa_tronco3 = 'N'; }
if (isset($_POST['dat_ocupa_pies3']) <> '') { $dat_ocupa_pies3 = addslashes($_POST['dat_ocupa_pies3']); } else { $dat_ocupa_pies3 = 'N'; }
if (isset($_POST['dat_ocupa_fech_ini3']) <> '') { $dat_ocupa_fech_ini3 = addslashes($_POST['dat_ocupa_fech_ini3']); } else { $dat_ocupa_fech_ini3 = ''; }
if (isset($_POST['dat_ocupa_dura_anyo3']) <> '') { $dat_ocupa_dura_anyo3 = addslashes($_POST['dat_ocupa_dura_anyo3']); } else { $dat_ocupa_dura_anyo3 = ''; }
if (isset($_POST['dat_ocupa_observacion']) <> '') { $dat_ocupa_observacion = addslashes($_POST['dat_ocupa_observacion']); } else { $dat_ocupa_observacion = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['clasrieg_carg1']) <> '') { $clasrieg_carg1 = addslashes($_POST['clasrieg_carg1']); } else { $clasrieg_carg1 = ''; }
if (isset($_POST['clasrieg_fis1_ruid']) <> '') { $clasrieg_fis1_ruid = addslashes($_POST['clasrieg_fis1_ruid']); } else { $clasrieg_fis1_ruid = 'N'; }
if (isset($_POST['clasrieg_fis1_ilum']) <> '') { $clasrieg_fis1_ilum = addslashes($_POST['clasrieg_fis1_ilum']); } else { $clasrieg_fis1_ilum = 'N'; }
if (isset($_POST['clasrieg_fis1_noionic']) <> '') { $clasrieg_fis1_noionic = addslashes($_POST['clasrieg_fis1_noionic']); } else { $clasrieg_fis1_noionic = 'N'; }
if (isset($_POST['clasrieg_fis1_vibra']) <> '') { $clasrieg_fis1_vibra = addslashes($_POST['clasrieg_fis1_vibra']); } else { $clasrieg_fis1_vibra = 'N'; }
if (isset($_POST['clasrieg_fis1_tempextrem']) <> '') { $clasrieg_fis1_tempextrem = addslashes($_POST['clasrieg_fis1_tempextrem']); } else { $clasrieg_fis1_tempextrem = 'N'; }
if (isset($_POST['clasrieg_fis1_cambpres']) <> '') { $clasrieg_fis1_cambpres = addslashes($_POST['clasrieg_fis1_cambpres']); } else { $clasrieg_fis1_cambpres = 'N'; }
if (isset($_POST['clasrieg_quim1_gasvapor']) <> '') { $clasrieg_quim1_gasvapor = addslashes($_POST['clasrieg_quim1_gasvapor']); } else { $clasrieg_quim1_gasvapor = 'N'; }
if (isset($_POST['clasrieg_quim1_aeroliq']) <> '') { $clasrieg_quim1_aeroliq = addslashes($_POST['clasrieg_quim1_aeroliq']); } else { $clasrieg_quim1_aeroliq = 'N'; }
if (isset($_POST['clasrieg_quim1_solid']) <> '') { $clasrieg_quim1_solid = addslashes($_POST['clasrieg_quim1_solid']); } else { $clasrieg_quim1_solid = 'N'; }
if (isset($_POST['clasrieg_quim1_liquid']) <> '') { $clasrieg_quim1_liquid = addslashes($_POST['clasrieg_quim1_liquid']); } else { $clasrieg_quim1_liquid = 'N'; }
if (isset($_POST['clasrieg_biolog1_viru']) <> '') { $clasrieg_biolog1_viru = addslashes($_POST['clasrieg_biolog1_viru']); } else { $clasrieg_biolog1_viru = 'N'; }
if (isset($_POST['clasrieg_biolog1_bacter']) <> '') { $clasrieg_biolog1_bacter = addslashes($_POST['clasrieg_biolog1_bacter']); } else { $clasrieg_biolog1_bacter = 'N'; }
if (isset($_POST['clasrieg_biolog1_parasi']) <> '') { $clasrieg_biolog1_parasi = addslashes($_POST['clasrieg_biolog1_parasi']); } else { $clasrieg_biolog1_parasi = 'N'; }
if (isset($_POST['clasrieg_biolog1_morde']) <> '') { $clasrieg_biolog1_morde = addslashes($_POST['clasrieg_biolog1_morde']); } else { $clasrieg_biolog1_morde = 'N'; }
if (isset($_POST['clasrieg_biolog1_picad']) <> '') { $clasrieg_biolog1_picad = addslashes($_POST['clasrieg_biolog1_picad']); } else { $clasrieg_biolog1_picad = 'N'; }
if (isset($_POST['clasrieg_biolog1_hongo']) <> '') { $clasrieg_biolog1_hongo = addslashes($_POST['clasrieg_biolog1_hongo']); } else { $clasrieg_biolog1_hongo = 'N'; }
if (isset($_POST['clasrieg_ergo1_trabestat']) <> '') { $clasrieg_ergo1_trabestat = addslashes($_POST['clasrieg_ergo1_trabestat']); } else { $clasrieg_ergo1_trabestat = 'N'; }
if (isset($_POST['clasrieg_ergo1_esfuerfis']) <> '') { $clasrieg_ergo1_esfuerfis = addslashes($_POST['clasrieg_ergo1_esfuerfis']); } else { $clasrieg_ergo1_esfuerfis = 'N'; }
if (isset($_POST['clasrieg_ergo1_carga']) <> '') { $clasrieg_ergo1_carga = addslashes($_POST['clasrieg_ergo1_carga']); } else { $clasrieg_ergo1_carga = 'N'; }
if (isset($_POST['clasrieg_ergo1_postforz']) <> '') { $clasrieg_ergo1_postforz = addslashes($_POST['clasrieg_ergo1_postforz']); } else { $clasrieg_ergo1_postforz = 'N'; }
if (isset($_POST['clasrieg_ergo1_movrepet']) <> '') { $clasrieg_ergo1_movrepet = addslashes($_POST['clasrieg_ergo1_movrepet']); } else { $clasrieg_ergo1_movrepet = 'N'; }
if (isset($_POST['clasrieg_ergo1_jortrab']) <> '') { $clasrieg_ergo1_jortrab = addslashes($_POST['clasrieg_ergo1_jortrab']); } else { $clasrieg_ergo1_jortrab = 'N'; }
if (isset($_POST['clasrieg_psi1_monoto']) <> '') { $clasrieg_psi1_monoto = addslashes($_POST['clasrieg_psi1_monoto']); } else { $clasrieg_psi1_monoto = 'N'; }
if (isset($_POST['clasrieg_psi1_relhuman']) <> '') { $clasrieg_psi1_relhuman = addslashes($_POST['clasrieg_psi1_relhuman']); } else { $clasrieg_psi1_relhuman = 'N'; }
if (isset($_POST['clasrieg_psi1_contentarea']) <> '') { $clasrieg_psi1_contentarea = addslashes($_POST['clasrieg_psi1_contentarea']); } else { $clasrieg_psi1_contentarea = 'N'; }
if (isset($_POST['clasrieg_psi1_orgtiemptrab']) <> '') { $clasrieg_psi1_orgtiemptrab = addslashes($_POST['clasrieg_psi1_orgtiemptrab']); } else { $clasrieg_psi1_orgtiemptrab = 'N'; }
if (isset($_POST['clasrieg_segur1_mecanic']) <> '') { $clasrieg_segur1_mecanic = addslashes($_POST['clasrieg_segur1_mecanic']); } else { $clasrieg_segur1_mecanic = 'N'; }
if (isset($_POST['clasrieg_segur1_electri']) <> '') { $clasrieg_segur1_electri = addslashes($_POST['clasrieg_segur1_electri']); } else { $clasrieg_segur1_electri = 'N'; }
if (isset($_POST['clasrieg_segur1_locat']) <> '') { $clasrieg_segur1_locat = addslashes($_POST['clasrieg_segur1_locat']); } else { $clasrieg_segur1_locat = 'N'; }
if (isset($_POST['clasrieg_segur1_fisiquim']) <> '') { $clasrieg_segur1_fisiquim = addslashes($_POST['clasrieg_segur1_fisiquim']); } else { $clasrieg_segur1_fisiquim = 'N'; }
if (isset($_POST['clasrieg_segur1_public']) <> '') { $clasrieg_segur1_public = addslashes($_POST['clasrieg_segur1_public']); } else { $clasrieg_segur1_public = 'N'; }
if (isset($_POST['clasrieg_segur1_espconfi']) <> '') { $clasrieg_segur1_espconfi = addslashes($_POST['clasrieg_segur1_espconfi']); } else { $clasrieg_segur1_espconfi = 'N'; }
if (isset($_POST['clasrieg_segur1_trabaltura']) <> '') { $clasrieg_segur1_trabaltura = addslashes($_POST['clasrieg_segur1_trabaltura']); } else { $clasrieg_segur1_trabaltura = 'N'; }
if (isset($_POST['clasrieg_observ1_otro']) <> '') { $clasrieg_observ1_otro = addslashes($_POST['clasrieg_observ1_otro']); } else { $clasrieg_observ1_otro = 'N'; }

if (isset($_POST['clasrieg_observ1_coment']) <> '') { $clasrieg_observ1_coment = addslashes($_POST['clasrieg_observ1_coment']); } else { $clasrieg_observ1_coment = ''; }
if (isset($_POST['clasrieg_carg2']) <> '') { $clasrieg_carg2 = addslashes($_POST['clasrieg_carg2']); } else { $clasrieg_carg2 = 'N'; }
if (isset($_POST['clasrieg_fis2_ruid']) <> '') { $clasrieg_fis2_ruid = addslashes($_POST['clasrieg_fis2_ruid']); } else { $clasrieg_fis2_ruid = 'N'; }
if (isset($_POST['clasrieg_fis2_ilum']) <> '') { $clasrieg_fis2_ilum = addslashes($_POST['clasrieg_fis2_ilum']); } else { $clasrieg_fis2_ilum = 'N'; }
if (isset($_POST['clasrieg_fis2_noionic']) <> '') { $clasrieg_fis2_noionic = addslashes($_POST['clasrieg_fis2_noionic']); } else { $clasrieg_fis2_noionic = 'N'; }
if (isset($_POST['clasrieg_fis2_vibra']) <> '') { $clasrieg_fis2_vibra = addslashes($_POST['clasrieg_fis2_vibra']); } else { $clasrieg_fis2_vibra = 'N'; }
if (isset($_POST['clasrieg_fis2_tempextrem']) <> '') { $clasrieg_fis2_tempextrem = addslashes($_POST['clasrieg_fis2_tempextrem']); } else { $clasrieg_fis2_tempextrem = 'N'; }
if (isset($_POST['clasrieg_fis2_cambpres']) <> '') { $clasrieg_fis2_cambpres = addslashes($_POST['clasrieg_fis2_cambpres']); } else { $clasrieg_fis2_cambpres = 'N'; }
if (isset($_POST['clasrieg_quim2_gasvapor']) <> '') { $clasrieg_quim2_gasvapor = addslashes($_POST['clasrieg_quim2_gasvapor']); } else { $clasrieg_quim2_gasvapor = 'N'; }
if (isset($_POST['clasrieg_quim2_aeroliq']) <> '') { $clasrieg_quim2_aeroliq = addslashes($_POST['clasrieg_quim2_aeroliq']); } else { $clasrieg_quim2_aeroliq = 'N'; }
if (isset($_POST['clasrieg_quim2_solid']) <> '') { $clasrieg_quim2_solid = addslashes($_POST['clasrieg_quim2_solid']); } else { $clasrieg_quim2_solid = 'N'; }
if (isset($_POST['clasrieg_quim2_liquid']) <> '') { $clasrieg_quim2_liquid = addslashes($_POST['clasrieg_quim2_liquid']); } else { $clasrieg_quim2_liquid = 'N'; }
if (isset($_POST['clasrieg_biolog2_viru']) <> '') { $clasrieg_biolog2_viru = addslashes($_POST['clasrieg_biolog2_viru']); } else { $clasrieg_biolog2_viru = 'N'; }
if (isset($_POST['clasrieg_biolog2_bacter']) <> '') { $clasrieg_biolog2_bacter = addslashes($_POST['clasrieg_biolog2_bacter']); } else { $clasrieg_biolog2_bacter = 'N'; }
if (isset($_POST['clasrieg_biolog2_parasi']) <> '') { $clasrieg_biolog2_parasi = addslashes($_POST['clasrieg_biolog2_parasi']); } else { $clasrieg_biolog2_parasi = 'N'; }
if (isset($_POST['clasrieg_biolog2_morde']) <> '') { $clasrieg_biolog2_morde = addslashes($_POST['clasrieg_biolog2_morde']); } else { $clasrieg_biolog2_morde = 'N'; }
if (isset($_POST['clasrieg_biolog2_picad']) <> '') { $clasrieg_biolog2_picad = addslashes($_POST['clasrieg_biolog2_picad']); } else { $clasrieg_biolog2_picad = 'N'; }
if (isset($_POST['clasrieg_biolog2_hongo']) <> '') { $clasrieg_biolog2_hongo = addslashes($_POST['clasrieg_biolog2_hongo']); } else { $clasrieg_biolog2_hongo = 'N'; }
if (isset($_POST['clasrieg_ergo2_trabestat']) <> '') { $clasrieg_ergo2_trabestat = addslashes($_POST['clasrieg_ergo2_trabestat']); } else { $clasrieg_ergo2_trabestat = 'N'; }
if (isset($_POST['clasrieg_ergo2_esfuerfis']) <> '') { $clasrieg_ergo2_esfuerfis = addslashes($_POST['clasrieg_ergo2_esfuerfis']); } else { $clasrieg_ergo2_esfuerfis = 'N'; }
if (isset($_POST['clasrieg_ergo2_carga']) <> '') { $clasrieg_ergo2_carga = addslashes($_POST['clasrieg_ergo2_carga']); } else { $clasrieg_ergo2_carga = 'N'; }
if (isset($_POST['clasrieg_ergo2_postforz']) <> '') { $clasrieg_ergo2_postforz = addslashes($_POST['clasrieg_ergo2_postforz']); } else { $clasrieg_ergo2_postforz = 'N'; }
if (isset($_POST['clasrieg_ergo2_movrepet']) <> '') { $clasrieg_ergo2_movrepet = addslashes($_POST['clasrieg_ergo2_movrepet']); } else { $clasrieg_ergo2_movrepet = 'N'; }
if (isset($_POST['clasrieg_ergo2_jortrab']) <> '') { $clasrieg_ergo2_jortrab = addslashes($_POST['clasrieg_ergo2_jortrab']); } else { $clasrieg_ergo2_jortrab = 'N'; }
if (isset($_POST['clasrieg_psi2_monoto']) <> '') { $clasrieg_psi2_monoto = addslashes($_POST['clasrieg_psi2_monoto']); } else { $clasrieg_psi2_monoto = 'N'; }
if (isset($_POST['clasrieg_psi2_relhuman']) <> '') { $clasrieg_psi2_relhuman = addslashes($_POST['clasrieg_psi2_relhuman']); } else { $clasrieg_psi2_relhuman = 'N'; }
if (isset($_POST['clasrieg_psi2_contentarea']) <> '') { $clasrieg_psi2_contentarea = addslashes($_POST['clasrieg_psi2_contentarea']); } else { $clasrieg_psi2_contentarea = 'N'; }
if (isset($_POST['clasrieg_psi2_orgtiemptrab']) <> '') { $clasrieg_psi2_orgtiemptrab = addslashes($_POST['clasrieg_psi2_orgtiemptrab']); } else { $clasrieg_psi2_orgtiemptrab = 'N'; }
if (isset($_POST['clasrieg_segur2_mecanic']) <> '') { $clasrieg_segur2_mecanic = addslashes($_POST['clasrieg_segur2_mecanic']); } else { $clasrieg_segur2_mecanic = 'N'; }
if (isset($_POST['clasrieg_segur2_electri']) <> '') { $clasrieg_segur2_electri = addslashes($_POST['clasrieg_segur2_electri']); } else { $clasrieg_segur2_electri = 'N'; }
if (isset($_POST['clasrieg_segur2_locat']) <> '') { $clasrieg_segur2_locat = addslashes($_POST['clasrieg_segur2_locat']); } else { $clasrieg_segur2_locat = 'N'; }
if (isset($_POST['clasrieg_segur2_fisiquim']) <> '') { $clasrieg_segur2_fisiquim = addslashes($_POST['clasrieg_segur2_fisiquim']); } else { $clasrieg_segur2_fisiquim = 'N'; }
if (isset($_POST['clasrieg_segur2_public']) <> '') { $clasrieg_segur2_public = addslashes($_POST['clasrieg_segur2_public']); } else { $clasrieg_segur2_public = 'N'; }
if (isset($_POST['clasrieg_segur2_espconfi']) <> '') { $clasrieg_segur2_espconfi = addslashes($_POST['clasrieg_segur2_espconfi']); } else { $clasrieg_segur2_espconfi = 'N'; }
if (isset($_POST['clasrieg_segur2_trabaltura']) <> '') { $clasrieg_segur2_trabaltura = addslashes($_POST['clasrieg_segur2_trabaltura']); } else { $clasrieg_segur2_trabaltura = 'N'; }
if (isset($_POST['clasrieg_observ2_otro']) <> '') { $clasrieg_observ2_otro = addslashes($_POST['clasrieg_observ2_otro']); } else { $clasrieg_observ2_otro = 'N'; }
if (isset($_POST['clasrieg_observ2_coment']) <> '') { $clasrieg_observ2_coment = addslashes($_POST['clasrieg_observ2_coment']); } else { $clasrieg_observ2_coment = ''; }
if (isset($_POST['clasrieg_carg3']) <> '') { $clasrieg_carg3 = addslashes($_POST['clasrieg_carg3']); } else { $clasrieg_carg3 = 'N'; }
if (isset($_POST['clasrieg_fis3_ruid']) <> '') { $clasrieg_fis3_ruid = addslashes($_POST['clasrieg_fis3_ruid']); } else { $clasrieg_fis3_ruid = 'N'; }
if (isset($_POST['clasrieg_fis3_ilum']) <> '') { $clasrieg_fis3_ilum = addslashes($_POST['clasrieg_fis3_ilum']); } else { $clasrieg_fis3_ilum = 'N'; }
if (isset($_POST['clasrieg_fis3_noionic']) <> '') { $clasrieg_fis3_noionic = addslashes($_POST['clasrieg_fis3_noionic']); } else { $clasrieg_fis3_noionic = 'N'; }
if (isset($_POST['clasrieg_fis3_vibra']) <> '') { $clasrieg_fis3_vibra = addslashes($_POST['clasrieg_fis3_vibra']); } else { $clasrieg_fis3_vibra = 'N'; }
if (isset($_POST['clasrieg_fis3_tempextrem']) <> '') { $clasrieg_fis3_tempextrem = addslashes($_POST['clasrieg_fis3_tempextrem']); } else { $clasrieg_fis3_tempextrem = 'N'; }
if (isset($_POST['clasrieg_fis3_cambpres']) <> '') { $clasrieg_fis3_cambpres = addslashes($_POST['clasrieg_fis3_cambpres']); } else { $clasrieg_fis3_cambpres = 'N'; }
if (isset($_POST['clasrieg_quim3_gasvapor']) <> '') { $clasrieg_quim3_gasvapor = addslashes($_POST['clasrieg_quim3_gasvapor']); } else { $clasrieg_quim3_gasvapor = 'N'; }
if (isset($_POST['clasrieg_quim3_aeroliq']) <> '') { $clasrieg_quim3_aeroliq = addslashes($_POST['clasrieg_quim3_aeroliq']); } else { $clasrieg_quim3_aeroliq = 'N'; }
if (isset($_POST['clasrieg_quim3_solid']) <> '') { $clasrieg_quim3_solid = addslashes($_POST['clasrieg_quim3_solid']); } else { $clasrieg_quim3_solid = 'N'; }
if (isset($_POST['clasrieg_quim3_liquid']) <> '') { $clasrieg_quim3_liquid = addslashes($_POST['clasrieg_quim3_liquid']); } else { $clasrieg_quim3_liquid = 'N'; }
if (isset($_POST['clasrieg_biolog3_viru']) <> '') { $clasrieg_biolog3_viru = addslashes($_POST['clasrieg_biolog3_viru']); } else { $clasrieg_biolog3_viru = 'N'; }
if (isset($_POST['clasrieg_biolog3_bacter']) <> '') { $clasrieg_biolog3_bacter = addslashes($_POST['clasrieg_biolog3_bacter']); } else { $clasrieg_biolog3_bacter = 'N'; }
if (isset($_POST['clasrieg_biolog3_parasi']) <> '') { $clasrieg_biolog3_parasi = addslashes($_POST['clasrieg_biolog3_parasi']); } else { $clasrieg_biolog3_parasi = 'N'; }
if (isset($_POST['clasrieg_biolog3_morde']) <> '') { $clasrieg_biolog3_morde = addslashes($_POST['clasrieg_biolog3_morde']); } else { $clasrieg_biolog3_morde = 'N'; }
if (isset($_POST['clasrieg_biolog3_picad']) <> '') { $clasrieg_biolog3_picad = addslashes($_POST['clasrieg_biolog3_picad']); } else { $clasrieg_biolog3_picad = 'N'; }
if (isset($_POST['clasrieg_biolog3_hongo']) <> '') { $clasrieg_biolog3_hongo = addslashes($_POST['clasrieg_biolog3_hongo']); } else { $clasrieg_biolog3_hongo = 'N'; }
if (isset($_POST['clasrieg_ergo3_trabestat']) <> '') { $clasrieg_ergo3_trabestat = addslashes($_POST['clasrieg_ergo3_trabestat']); } else { $clasrieg_ergo3_trabestat = 'N'; }
if (isset($_POST['clasrieg_ergo3_esfuerfis']) <> '') { $clasrieg_ergo3_esfuerfis = addslashes($_POST['clasrieg_ergo3_esfuerfis']); } else { $clasrieg_ergo3_esfuerfis = 'N'; }
if (isset($_POST['clasrieg_ergo3_carga']) <> '') { $clasrieg_ergo3_carga = addslashes($_POST['clasrieg_ergo3_carga']); } else { $clasrieg_ergo3_carga = 'N'; }
if (isset($_POST['clasrieg_ergo3_postforz']) <> '') { $clasrieg_ergo3_postforz = addslashes($_POST['clasrieg_ergo3_postforz']); } else { $clasrieg_ergo3_postforz = 'N'; }
if (isset($_POST['clasrieg_ergo3_movrepet']) <> '') { $clasrieg_ergo3_movrepet = addslashes($_POST['clasrieg_ergo3_movrepet']); } else { $clasrieg_ergo3_movrepet = 'N'; }
if (isset($_POST['clasrieg_ergo3_jortrab']) <> '') { $clasrieg_ergo3_jortrab = addslashes($_POST['clasrieg_ergo3_jortrab']); } else { $clasrieg_ergo3_jortrab = 'N'; }
if (isset($_POST['clasrieg_psi3_monoto']) <> '') { $clasrieg_psi3_monoto = addslashes($_POST['clasrieg_psi3_monoto']); } else { $clasrieg_psi3_monoto = 'N'; }
if (isset($_POST['clasrieg_psi3_relhuman']) <> '') { $clasrieg_psi3_relhuman = addslashes($_POST['clasrieg_psi3_relhuman']); } else { $clasrieg_psi3_relhuman = 'N'; }
if (isset($_POST['clasrieg_psi3_contentarea']) <> '') { $clasrieg_psi3_contentarea = addslashes($_POST['clasrieg_psi3_contentarea']); } else { $clasrieg_psi3_contentarea = 'N'; }
if (isset($_POST['clasrieg_psi3_orgtiemptrab']) <> '') { $clasrieg_psi3_orgtiemptrab = addslashes($_POST['clasrieg_psi3_orgtiemptrab']); } else { $clasrieg_psi3_orgtiemptrab = 'N'; }
if (isset($_POST['clasrieg_segur3_mecanic']) <> '') { $clasrieg_segur3_mecanic = addslashes($_POST['clasrieg_segur3_mecanic']); } else { $clasrieg_segur3_mecanic = 'N'; }
if (isset($_POST['clasrieg_segur3_electri']) <> '') { $clasrieg_segur3_electri = addslashes($_POST['clasrieg_segur3_electri']); } else { $clasrieg_segur3_electri = 'N'; }
if (isset($_POST['clasrieg_segur3_locat']) <> '') { $clasrieg_segur3_locat = addslashes($_POST['clasrieg_segur3_locat']); } else { $clasrieg_segur3_locat = 'N'; }
if (isset($_POST['clasrieg_segur3_fisiquim']) <> '') { $clasrieg_segur3_fisiquim = addslashes($_POST['clasrieg_segur3_fisiquim']); } else { $clasrieg_segur3_fisiquim = 'N'; }
if (isset($_POST['clasrieg_segur3_public']) <> '') { $clasrieg_segur3_public = addslashes($_POST['clasrieg_segur3_public']); } else { $clasrieg_segur3_public = 'N'; }
if (isset($_POST['clasrieg_segur3_espconfi']) <> '') { $clasrieg_segur3_espconfi = addslashes($_POST['clasrieg_segur3_espconfi']); } else { $clasrieg_segur3_espconfi = 'N'; }
if (isset($_POST['clasrieg_segur3_trabaltura']) <> '') { $clasrieg_segur3_trabaltura = addslashes($_POST['clasrieg_segur3_trabaltura']); } else { $clasrieg_segur3_trabaltura = 'N'; }
if (isset($_POST['clasrieg_observ3_otro']) <> '') { $clasrieg_observ3_otro = addslashes($_POST['clasrieg_observ3_otro']); } else { $clasrieg_observ3_otro = 'N'; }
if (isset($_POST['clasrieg_observ3_coment']) <> '') { $clasrieg_observ3_coment = addslashes($_POST['clasrieg_observ3_coment']); } else { $clasrieg_observ3_coment = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['ant_impor_accilab']) <> '') { $ant_impor_accilab = addslashes($_POST['ant_impor_accilab']); } else { $ant_impor_accilab = ''; }
if (isset($_POST['ant_impor_fecha1']) <> '') { $ant_impor_fecha1 = addslashes($_POST['ant_impor_fecha1']); } else { $ant_impor_fecha1 = ''; }
if (isset($_POST['ant_impor_empre1']) <> '') { $ant_impor_empre1 = addslashes($_POST['ant_impor_empre1']); } else { $ant_impor_empre1 = ''; }
if (isset($_POST['ant_impor_causa1']) <> '') { $ant_impor_causa1 = addslashes($_POST['ant_impor_causa1']); } else { $ant_impor_causa1 = ''; }
if (isset($_POST['ant_impor_tip_lesi1']) <> '') { $ant_impor_tip_lesi1 = addslashes($_POST['ant_impor_tip_lesi1']); } else { $ant_impor_tip_lesi1 = ''; }
if (isset($_POST['ant_impor_part_afect1']) <> '') { $ant_impor_part_afect1 = addslashes($_POST['ant_impor_part_afect1']); } else { $ant_impor_part_afect1 = ''; }
if (isset($_POST['ant_impor_dias_incap1']) <> '') { $ant_impor_dias_incap1 = addslashes($_POST['ant_impor_dias_incap1']); } else { $ant_impor_dias_incap1 = ''; }
if (isset($_POST['ant_impor_secuela1']) <> '') { $ant_impor_secuela1 = addslashes($_POST['ant_impor_secuela1']); } else { $ant_impor_secuela1 = ''; }
if (isset($_POST['ant_impor_fecha2']) <> '') { $ant_impor_fecha2 = addslashes($_POST['ant_impor_fecha2']); } else { $ant_impor_fecha2 = ''; }
if (isset($_POST['ant_impor_empre2']) <> '') { $ant_impor_empre2 = addslashes($_POST['ant_impor_empre2']); } else { $ant_impor_empre2 = ''; }
if (isset($_POST['ant_impor_causa2']) <> '') { $ant_impor_causa2 = addslashes($_POST['ant_impor_causa2']); } else { $ant_impor_causa2 = ''; }
if (isset($_POST['ant_impor_tip_lesi2']) <> '') { $ant_impor_tip_lesi2 = addslashes($_POST['ant_impor_tip_lesi2']); } else { $ant_impor_tip_lesi2 = ''; }
if (isset($_POST['ant_impor_part_afect2']) <> '') { $ant_impor_part_afect2 = addslashes($_POST['ant_impor_part_afect2']); } else { $ant_impor_part_afect2 = ''; }
if (isset($_POST['ant_impor_dias_incap2']) <> '') { $ant_impor_dias_incap2 = addslashes($_POST['ant_impor_dias_incap2']); } else { $ant_impor_dias_incap2 = ''; }
if (isset($_POST['ant_impor_secuela2']) <> '') { $ant_impor_secuela2 = addslashes($_POST['ant_impor_secuela2']); } else { $ant_impor_secuela2 = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['enf_lab']) <> '') { $enf_lab = addslashes($_POST['enf_lab']); } else { $enf_lab = ''; }
if (isset($_POST['enf_cual']) <> '') { $enf_cual = addslashes($_POST['enf_cual']); } else { $enf_cual = ''; }
if (isset($_POST['enf_hace_cuanto']) <> '') { $enf_hace_cuanto = addslashes($_POST['enf_hace_cuanto']); } else { $enf_hace_cuanto = ''; }
if (isset($_POST['enf_descripcion']) <> '') { $enf_descripcion = addslashes($_POST['enf_descripcion']); } else { $enf_descripcion = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['ant_fam_no_presenta']) <> '') { $ant_fam_no_presenta = addslashes($_POST['ant_fam_no_presenta']); } else { $ant_fam_no_presenta = ""; }
if (isset($_POST['ant_fam_hiper_pad']) <> '') { $ant_fam_hiper_pad = addslashes($_POST['ant_fam_hiper_pad']); } else { $ant_fam_hiper_pad = "N"; }
if (isset($_POST['ant_fam_hiper_mad']) <> '') { $ant_fam_hiper_mad = addslashes($_POST['ant_fam_hiper_mad']); } else { $ant_fam_hiper_mad = "N"; }
if (isset($_POST['ant_fam_hiper_herm']) <> '') { $ant_fam_hiper_herm = addslashes($_POST['ant_fam_hiper_herm']); } else { $ant_fam_hiper_herm = "N"; }
if (isset($_POST['ant_fam_hiper_otro']) <> '') { $ant_fam_hiper_otro = addslashes($_POST['ant_fam_hiper_otro']); } else { $ant_fam_hiper_otro = "N"; }
if (isset($_POST['ant_fam_diabet_pad']) <> '') { $ant_fam_diabet_pad = addslashes($_POST['ant_fam_diabet_pad']); } else { $ant_fam_diabet_pad = "N"; }
if (isset($_POST['ant_fam_diabet_mad']) <> '') { $ant_fam_diabet_mad = addslashes($_POST['ant_fam_diabet_mad']); } else { $ant_fam_diabet_mad = "N"; }
if (isset($_POST['ant_fam_diabet_herm']) <> '') { $ant_fam_diabet_herm = addslashes($_POST['ant_fam_diabet_herm']); } else { $ant_fam_diabet_herm = "N"; }
if (isset($_POST['ant_fam_diabet_otro']) <> '') { $ant_fam_diabet_otro = addslashes($_POST['ant_fam_diabet_otro']); } else { $ant_fam_diabet_otro = "N"; }
if (isset($_POST['ant_fam_trombos_pad']) <> '') { $ant_fam_trombos_pad = addslashes($_POST['ant_fam_trombos_pad']); } else { $ant_fam_trombos_pad = "N"; }
if (isset($_POST['ant_fam_trombos_mad']) <> '') { $ant_fam_trombos_mad = addslashes($_POST['ant_fam_trombos_mad']); } else { $ant_fam_trombos_mad = "N"; }
if (isset($_POST['ant_fam_trombos_herm']) <> '') { $ant_fam_trombos_herm = addslashes($_POST['ant_fam_trombos_herm']); } else { $ant_fam_trombos_herm = "N"; }
if (isset($_POST['ant_fam_trombos_otro']) <> '') { $ant_fam_trombos_otro = addslashes($_POST['ant_fam_trombos_otro']); } else { $ant_fam_trombos_otro = "N"; }
if (isset($_POST['ant_fam_tum_malig_pad']) <> '') { $ant_fam_tum_malig_pad = addslashes($_POST['ant_fam_tum_malig_pad']); } else { $ant_fam_tum_malig_pad = "N"; }
if (isset($_POST['ant_fam_tum_malig_mad']) <> '') { $ant_fam_tum_malig_mad = addslashes($_POST['ant_fam_tum_malig_mad']); } else { $ant_fam_tum_malig_mad = "N"; }
if (isset($_POST['ant_fam_tum_malig_herm']) <> '') { $ant_fam_tum_malig_herm = addslashes($_POST['ant_fam_tum_malig_herm']); } else { $ant_fam_tum_malig_herm = "N"; }
if (isset($_POST['ant_fam_tum_malig_otro']) <> '') { $ant_fam_tum_malig_otro = addslashes($_POST['ant_fam_tum_malig_otro']); } else { $ant_fam_tum_malig_otro = "N"; }
if (isset($_POST['ant_fam_enf_ment_pad']) <> '') { $ant_fam_enf_ment_pad = addslashes($_POST['ant_fam_enf_ment_pad']); } else { $ant_fam_enf_ment_pad = "N"; }
if (isset($_POST['ant_fam_enf_ment_mad']) <> '') { $ant_fam_enf_ment_mad = addslashes($_POST['ant_fam_enf_ment_mad']); } else { $ant_fam_enf_ment_mad = "N"; }
if (isset($_POST['ant_fam_enf_ment_herm']) <> '') { $ant_fam_enf_ment_herm = addslashes($_POST['ant_fam_enf_ment_herm']); } else { $ant_fam_enf_ment_herm = "N"; }
if (isset($_POST['ant_fam_enf_ment_otro']) <> '') { $ant_fam_enf_ment_otro = addslashes($_POST['ant_fam_enf_ment_otro']); } else { $ant_fam_enf_ment_otro = "N"; }
if (isset($_POST['ant_fam_cadio_pad']) <> '') { $ant_fam_cadio_pad = addslashes($_POST['ant_fam_cadio_pad']); } else { $ant_fam_cadio_pad = "N"; }
if (isset($_POST['ant_fam_cadio_mad']) <> '') { $ant_fam_cadio_mad = addslashes($_POST['ant_fam_cadio_mad']); } else { $ant_fam_cadio_mad = "N"; }
if (isset($_POST['ant_fam_cadio_herm']) <> '') { $ant_fam_cadio_herm = addslashes($_POST['ant_fam_cadio_herm']); } else { $ant_fam_cadio_herm = "N"; }
if (isset($_POST['ant_fam_cadio_otro']) <> '') { $ant_fam_cadio_otro = addslashes($_POST['ant_fam_cadio_otro']); } else { $ant_fam_cadio_otro = "N"; }
if (isset($_POST['ant_fam_trans_convul_pad']) <> '') { $ant_fam_trans_convul_pad = addslashes($_POST['ant_fam_trans_convul_pad']); } else { $ant_fam_trans_convul_pad = "N"; }
if (isset($_POST['ant_fam_trans_convul_mad']) <> '') { $ant_fam_trans_convul_mad = addslashes($_POST['ant_fam_trans_convul_mad']); } else { $ant_fam_trans_convul_mad = "N"; }
if (isset($_POST['ant_fam_trans_convul_herm']) <> '') { $ant_fam_trans_convul_herm = addslashes($_POST['ant_fam_trans_convul_herm']); } else { $ant_fam_trans_convul_herm = "N"; }
if (isset($_POST['ant_fam_trans_convul_otro']) <> '') { $ant_fam_trans_convul_otro = addslashes($_POST['ant_fam_trans_convul_otro']); } else { $ant_fam_trans_convul_otro = "N"; }
if (isset($_POST['ant_fam_enf_gene_pad']) <> '') { $ant_fam_enf_gene_pad = addslashes($_POST['ant_fam_enf_gene_pad']); } else { $ant_fam_enf_gene_pad = "N"; }
if (isset($_POST['ant_fam_enf_gene_mad']) <> '') { $ant_fam_enf_gene_mad = addslashes($_POST['ant_fam_enf_gene_mad']); } else { $ant_fam_enf_gene_mad = "N"; }
if (isset($_POST['ant_fam_enf_gene_herm']) <> '') { $ant_fam_enf_gene_herm = addslashes($_POST['ant_fam_enf_gene_herm']); } else { $ant_fam_enf_gene_herm = "N"; }
if (isset($_POST['ant_fam_enf_gene_otro']) <> '') { $ant_fam_enf_gene_otro = addslashes($_POST['ant_fam_enf_gene_otro']); } else { $ant_fam_enf_gene_otro = "N"; }
if (isset($_POST['ant_fam_alerg_pad']) <> '') { $ant_fam_alerg_pad = addslashes($_POST['ant_fam_alerg_pad']); } else { $ant_fam_alerg_pad = "N"; }
if (isset($_POST['ant_fam_alerg_mad']) <> '') { $ant_fam_alerg_mad = addslashes($_POST['ant_fam_alerg_mad']); } else { $ant_fam_alerg_mad = "N"; }
if (isset($_POST['ant_fam_alerg_herm']) <> '') { $ant_fam_alerg_herm = addslashes($_POST['ant_fam_alerg_herm']); } else { $ant_fam_alerg_herm = "N"; }
if (isset($_POST['ant_fam_alerg_otro']) <> '') { $ant_fam_alerg_otro = addslashes($_POST['ant_fam_alerg_otro']); } else { $ant_fam_alerg_otro = "N"; }
if (isset($_POST['ant_fam_tuber_pad']) <> '') { $ant_fam_tuber_pad = addslashes($_POST['ant_fam_tuber_pad']); } else { $ant_fam_tuber_pad = "N"; }
if (isset($_POST['ant_fam_tuber_mad']) <> '') { $ant_fam_tuber_mad = addslashes($_POST['ant_fam_tuber_mad']); } else { $ant_fam_tuber_mad = "N"; }
if (isset($_POST['ant_fam_tuber_herm']) <> '') { $ant_fam_tuber_herm = addslashes($_POST['ant_fam_tuber_herm']); } else { $ant_fam_tuber_herm = "N"; }
if (isset($_POST['ant_fam_tuber_otro']) <> '') { $ant_fam_tuber_otro = addslashes($_POST['ant_fam_tuber_otro']); } else { $ant_fam_tuber_otro = "N"; }
if (isset($_POST['ant_fam_osteomusc_pad']) <> '') { $ant_fam_osteomusc_pad = addslashes($_POST['ant_fam_osteomusc_pad']); } else { $ant_fam_osteomusc_pad = "N"; }
if (isset($_POST['ant_fam_osteomusc_mad']) <> '') { $ant_fam_osteomusc_mad = addslashes($_POST['ant_fam_osteomusc_mad']); } else { $ant_fam_osteomusc_mad = "N"; }
if (isset($_POST['ant_fam_osteomusc_herm']) <> '') { $ant_fam_osteomusc_herm = addslashes($_POST['ant_fam_osteomusc_herm']); } else { $ant_fam_osteomusc_herm = "N"; }
if (isset($_POST['ant_fam_osteomusc_otro']) <> '') { $ant_fam_osteomusc_otro = addslashes($_POST['ant_fam_osteomusc_otro']); } else { $ant_fam_osteomusc_otro = "N"; }
if (isset($_POST['ant_fam_artitri_pad']) <> '') { $ant_fam_artitri_pad = addslashes($_POST['ant_fam_artitri_pad']); } else { $ant_fam_artitri_pad = "N"; }
if (isset($_POST['ant_fam_artitri_mad']) <> '') { $ant_fam_artitri_mad = addslashes($_POST['ant_fam_artitri_mad']); } else { $ant_fam_artitri_mad = "N"; }
if (isset($_POST['ant_fam_artitri_herm']) <> '') { $ant_fam_artitri_herm = addslashes($_POST['ant_fam_artitri_herm']); } else { $ant_fam_artitri_herm = "N"; }
if (isset($_POST['ant_fam_artitri_otro']) <> '') { $ant_fam_artitri_otro = addslashes($_POST['ant_fam_artitri_otro']); } else { $ant_fam_artitri_otro = "N"; }
if (isset($_POST['ant_fam_varice_pad']) <> '') { $ant_fam_varice_pad = addslashes($_POST['ant_fam_varice_pad']); } else { $ant_fam_varice_pad = "N"; }
if (isset($_POST['ant_fam_varice_mad']) <> '') { $ant_fam_varice_mad = addslashes($_POST['ant_fam_varice_mad']); } else { $ant_fam_varice_mad = "N"; }
if (isset($_POST['ant_fam_varice_herm']) <> '') { $ant_fam_varice_herm = addslashes($_POST['ant_fam_varice_herm']); } else { $ant_fam_varice_herm = "N"; }
if (isset($_POST['ant_fam_varice_otro']) <> '') { $ant_fam_varice_otro = addslashes($_POST['ant_fam_varice_otro']); } else { $ant_fam_varice_otro = "N"; }
if (isset($_POST['ant_fam_otro_pad']) <> '') { $ant_fam_otro_pad = addslashes($_POST['ant_fam_otro_pad']); } else { $ant_fam_otro_pad = "N"; }
if (isset($_POST['ant_fam_otro_mad']) <> '') { $ant_fam_otro_mad = addslashes($_POST['ant_fam_otro_mad']); } else { $ant_fam_otro_mad = "N"; }
if (isset($_POST['ant_fam_otro_herm']) <> '') { $ant_fam_otro_herm = addslashes($_POST['ant_fam_otro_herm']); } else { $ant_fam_otro_herm = "N"; }
if (isset($_POST['ant_fam_otro_otro']) <> '') { $ant_fam_otro_otro = addslashes($_POST['ant_fam_otro_otro']); } else { $ant_fam_otro_otro = "N"; }
if (isset($_POST['ant_fam_descripcion']) <> '') { $ant_fam_descripcion = addslashes($_POST['ant_fam_descripcion']); } else { $ant_fam_descripcion = ""; }
if (isset($_POST['ant_fam_hiper_otro_cual']) <> '') { $ant_fam_hiper_otro_cual = addslashes($_POST['ant_fam_hiper_otro_cual']); } else { $ant_fam_hiper_otro_cual = ""; }
if (isset($_POST['ant_fam_diabet_otro_cual']) <> '') { $ant_fam_diabet_otro_cual = addslashes($_POST['ant_fam_diabet_otro_cual']); } else { $ant_fam_diabet_otro_cual = ""; }
if (isset($_POST['ant_fam_trombos_otro_cual']) <> '') { $ant_fam_trombos_otro_cual = addslashes($_POST['ant_fam_trombos_otro_cual']); } else { $ant_fam_trombos_otro_cual = ""; }
if (isset($_POST['ant_fam_tum_malig_otro_cual']) <> '') { $ant_fam_tum_malig_otro_cual = addslashes($_POST['ant_fam_tum_malig_otro_cual']); } else { $ant_fam_tum_malig_otro_cual = ""; }
if (isset($_POST['ant_fam_enf_ment_otro_cual']) <> '') { $ant_fam_enf_ment_otro_cual = addslashes($_POST['ant_fam_enf_ment_otro_cual']); } else { $ant_fam_enf_ment_otro_cual = ""; }
if (isset($_POST['ant_fam_cadio_otro_cual']) <> '') { $ant_fam_cadio_otro_cual = addslashes($_POST['ant_fam_cadio_otro_cual']); } else { $ant_fam_cadio_otro_cual = ""; }
if (isset($_POST['ant_fam_trans_convul_otro_cual']) <> '') { $ant_fam_trans_convul_otro_cual = addslashes($_POST['ant_fam_trans_convul_otro_cual']); } else { $ant_fam_trans_convul_otro_cual = ""; }
if (isset($_POST['ant_fam_enf_gene_otro_cual']) <> '') { $ant_fam_enf_gene_otro_cual = addslashes($_POST['ant_fam_enf_gene_otro_cual']); } else { $ant_fam_enf_gene_otro_cual = ""; }
if (isset($_POST['ant_fam_alerg_otro_cual']) <> '') { $ant_fam_alerg_otro_cual = addslashes($_POST['ant_fam_alerg_otro_cual']); } else { $ant_fam_alerg_otro_cual = ""; }
if (isset($_POST['ant_fam_tuber_otro_cual']) <> '') { $ant_fam_tuber_otro_cual = addslashes($_POST['ant_fam_tuber_otro_cual']); } else { $ant_fam_tuber_otro_cual = ""; }
if (isset($_POST['ant_fam_osteomusc_otro_cual']) <> '') { $ant_fam_osteomusc_otro_cual = addslashes($_POST['ant_fam_osteomusc_otro_cual']); } else { $ant_fam_osteomusc_otro_cual = ""; }
if (isset($_POST['ant_fam_artitri_otro_cual']) <> '') { $ant_fam_artitri_otro_cual = addslashes($_POST['ant_fam_artitri_otro_cual']); } else { $ant_fam_artitri_otro_cual = ""; }
if (isset($_POST['ant_fam_varice_otro_cual']) <> '') { $ant_fam_varice_otro_cual = addslashes($_POST['ant_fam_varice_otro_cual']); } else { $ant_fam_varice_otro_cual = ""; }
if (isset($_POST['ant_fam_otro_otro_cual']) <> '') { $ant_fam_otro_otro_cual = addslashes($_POST['ant_fam_otro_otro_cual']); } else { $ant_fam_otro_otro_cual = ""; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['ant_pato_no_presenta']) <> '') { $ant_pato_no_presenta = addslashes($_POST['ant_pato_no_presenta']); } else { $ant_pato_no_presenta = ""; }
if (isset($_POST['ant_pato_neuro']) <> '') { $ant_pato_neuro = addslashes($_POST['ant_pato_neuro']); } else { $ant_pato_neuro = "NO"; }
if (isset($_POST['ant_pato_resp']) <> '') { $ant_pato_resp = addslashes($_POST['ant_pato_resp']); } else { $ant_pato_resp = "NO"; }
if (isset($_POST['ant_pato_derma']) <> '') { $ant_pato_derma = addslashes($_POST['ant_pato_derma']); } else { $ant_pato_derma = "NO"; }
if (isset($_POST['ant_pato_psiq']) <> '') { $ant_pato_psiq = addslashes($_POST['ant_pato_psiq']); } else { $ant_pato_psiq = "NO"; }
if (isset($_POST['ant_pato_alerg']) <> '') { $ant_pato_alerg = addslashes($_POST['ant_pato_alerg']); } else { $ant_pato_alerg = "NO"; }
if (isset($_POST['ant_pato_osteomusc']) <> '') { $ant_pato_osteomusc = addslashes($_POST['ant_pato_osteomusc']); } else { $ant_pato_osteomusc = "NO"; }
if (isset($_POST['ant_pato_gastrointes']) <> '') { $ant_pato_gastrointes = addslashes($_POST['ant_pato_gastrointes']); } else { $ant_pato_gastrointes = "NO"; }
if (isset($_POST['ant_pato_hematolog']) <> '') { $ant_pato_hematolog = addslashes($_POST['ant_pato_hematolog']); } else { $ant_pato_hematolog = "NO"; }
if (isset($_POST['ant_pato_org_sentid']) <> '') { $ant_pato_org_sentid = addslashes($_POST['ant_pato_org_sentid']); } else { $ant_pato_org_sentid = "NO"; }
if (isset($_POST['ant_pato_onco']) <> '') { $ant_pato_onco = addslashes($_POST['ant_pato_onco']); } else { $ant_pato_onco = "NO"; }
if (isset($_POST['ant_pato_hiperten']) <> '') { $ant_pato_hiperten = addslashes($_POST['ant_pato_hiperten']); } else { $ant_pato_hiperten = "NO"; }
if (isset($_POST['ant_pato_genurinario']) <> '') { $ant_pato_genurinario = addslashes($_POST['ant_pato_genurinario']); } else { $ant_pato_genurinario = "NO"; }
if (isset($_POST['ant_pato_infesios']) <> '') { $ant_pato_infesios = addslashes($_POST['ant_pato_infesios']); } else { $ant_pato_infesios = "NO"; }
if (isset($_POST['ant_pato_congenit']) <> '') { $ant_pato_congenit = addslashes($_POST['ant_pato_congenit']); } else { $ant_pato_congenit = "NO"; }
if (isset($_POST['ant_pato_farmacolog']) <> '') { $ant_pato_farmacolog = addslashes($_POST['ant_pato_farmacolog']); } else { $ant_pato_farmacolog = "NO"; }
if (isset($_POST['ant_pato_transfus']) <> '') { $ant_pato_transfus = addslashes($_POST['ant_pato_transfus']); } else { $ant_pato_transfus = "NO"; }
if (isset($_POST['ant_pato_endocrino']) <> '') { $ant_pato_endocrino = addslashes($_POST['ant_pato_endocrino']); } else { $ant_pato_endocrino = "NO"; }
if (isset($_POST['ant_pato_vascular']) <> '') { $ant_pato_vascular = addslashes($_POST['ant_pato_vascular']); } else { $ant_pato_vascular = "NO"; }
if (isset($_POST['ant_pato_auntoinmun']) <> '') { $ant_pato_auntoinmun = addslashes($_POST['ant_pato_auntoinmun']); } else { $ant_pato_auntoinmun = "NO"; }
if (isset($_POST['ant_pato_otro']) <> '') { $ant_pato_otro = addslashes($_POST['ant_pato_otro']); } else { $ant_pato_otro = "NO"; }
if (isset($_POST['ant_pato_descripcion']) <> '') { $ant_pato_descripcion = addslashes($_POST['ant_pato_descripcion']); } else { $ant_pato_descripcion = "NO"; }

if (isset($_POST['ant_fam_asma_pad']) <> '') { $ant_fam_asma_pad = addslashes($_POST['ant_fam_asma_pad']); } else { $ant_fam_asma_pad = "N"; }
if (isset($_POST['ant_fam_asma_mad']) <> '') { $ant_fam_asma_mad = addslashes($_POST['ant_fam_asma_mad']); } else { $ant_fam_asma_mad = "N"; }
if (isset($_POST['ant_fam_asma_herm']) <> '') { $ant_fam_asma_herm = addslashes($_POST['ant_fam_asma_herm']); } else { $ant_fam_asma_herm = "N"; }
if (isset($_POST['ant_fam_asma_otro']) <> '') { $ant_fam_asma_otro = addslashes($_POST['ant_fam_asma_otro']); } else { $ant_fam_asma_otro = "N"; }
if (isset($_POST['ant_fam_asma_otro_cual']) <> '') { $ant_fam_asma_otro_cual = addslashes($_POST['ant_fam_asma_otro_cual']); } else { $ant_fam_asma_otro_cual = ""; }
if (isset($_POST['habit_tox_toxicomania']) <> '') { $habit_tox_toxicomania = addslashes($_POST['habit_tox_toxicomania']); } else { $habit_tox_toxicomania = "NO"; }
if (isset($_POST['ant_pato_convulsion']) <> '') { $ant_pato_convulsion = addslashes($_POST['ant_pato_convulsion']); } else { $ant_pato_convulsion = "NO"; }
if (isset($_POST['ant_pato_claustrofobia']) <> '') { $ant_pato_claustrofobia = addslashes($_POST['ant_pato_claustrofobia']); } else { $ant_pato_claustrofobia = "NO"; }
if (isset($_POST['ant_pato_dificuloler']) <> '') { $ant_pato_dificuloler = addslashes($_POST['ant_pato_dificuloler']); } else { $ant_pato_dificuloler = "NO"; }
if (isset($_POST['ant_pato_cardiopatia']) <> '') { $ant_pato_cardiopatia = addslashes($_POST['ant_pato_cardiopatia']); } else { $ant_pato_cardiopatia = "NO"; }
if (isset($_POST['ant_pato_lentes']) <> '') { $ant_pato_lentes = addslashes($_POST['ant_pato_lentes']); } else { $ant_pato_lentes = "NO"; }
if (isset($_POST['ant_pato_dificuldistincolor']) <> '') { $ant_pato_dificuldistincolor = addslashes($_POST['ant_pato_dificuldistincolor']); } else { $ant_pato_dificuldistincolor = "NO"; }
if (isset($_POST['exa_fis_sistemmusculesquelet']) <> '') { $exa_fis_sistemmusculesquelet = addslashes($_POST['exa_fis_sistemmusculesquelet']); } else { $exa_fis_sistemmusculesquelet = "N"; }
if (isset($_POST['exa_fis_sistemmusculesquelet_observ']) <> '') { $exa_fis_sistemmusculesquelet_observ = addslashes($_POST['exa_fis_sistemmusculesquelet_observ']); } else { $exa_fis_sistemmusculesquelet_observ = ""; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['ant_altu_no']) <> '') { $ant_altu_no = addslashes($_POST['ant_altu_no']); } else { $ant_altu_no = ""; }
if ($ant_altu_no == 'NO') {
$ant_altu_epilep      = 'NO';
$ant_altu_otitmed     = 'NO';
$ant_altu_enfmanier   = 'NO';
$ant_altu_traumcran   = 'NO';
$ant_altu_tumcereb    = 'NO';
$ant_altu_malfocereb  = 'NO';
$ant_altu_trombo      = 'NO';
$ant_altu_hipoac      = 'NO';
$ant_altu_arritcardi  = 'NO';
$ant_altu_hipogli     = 'NO';
$ant_altu_fobia       = 'NO';
$ant_altu_observ      = addslashes($_POST['ant_altu_observ']);
} else {
if (isset($_POST['ant_altu_epilep']) <> '') { $ant_altu_epilep = addslashes($_POST['ant_altu_epilep']); } else { $ant_altu_epilep = "NA"; }
if (isset($_POST['ant_altu_otitmed']) <> '') { $ant_altu_otitmed = addslashes($_POST['ant_altu_otitmed']); } else { $ant_altu_otitmed = "NA"; }
if (isset($_POST['ant_altu_enfmanier']) <> '') { $ant_altu_enfmanier = addslashes($_POST['ant_altu_enfmanier']); } else { $ant_altu_enfmanier = "NA"; }
if (isset($_POST['ant_altu_traumcran']) <> '') { $ant_altu_traumcran = addslashes($_POST['ant_altu_traumcran']); } else { $ant_altu_traumcran = "NA"; }
if (isset($_POST['ant_altu_tumcereb']) <> '') { $ant_altu_tumcereb = addslashes($_POST['ant_altu_tumcereb']); } else { $ant_altu_tumcereb = "NA"; }
if (isset($_POST['ant_altu_malfocereb']) <> '') { $ant_altu_malfocereb = addslashes($_POST['ant_altu_malfocereb']); } else { $ant_altu_malfocereb = "NA"; }
if (isset($_POST['ant_altu_trombo']) <> '') { $ant_altu_trombo = addslashes($_POST['ant_altu_trombo']); } else { $ant_altu_trombo = "NA"; }
if (isset($_POST['ant_altu_hipoac']) <> '') { $ant_altu_hipoac = addslashes($_POST['ant_altu_hipoac']); } else { $ant_altu_hipoac = "NA"; }
if (isset($_POST['ant_altu_arritcardi']) <> '') { $ant_altu_arritcardi = addslashes($_POST['ant_altu_arritcardi']); } else { $ant_altu_arritcardi = "NA"; }
if (isset($_POST['ant_altu_hipogli']) <> '') { $ant_altu_hipogli = addslashes($_POST['ant_altu_hipogli']); } else { $ant_altu_hipogli = "NA"; }
if (isset($_POST['ant_altu_fobia']) <> '') { $ant_altu_fobia = addslashes($_POST['ant_altu_fobia']); } else { $ant_altu_fobia = "NA"; }
if (isset($_POST['ant_altu_observ']) <> '') { $ant_altu_observ = addslashes($_POST['ant_altu_observ']); } else { $ant_altu_observ = ""; }
}
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['ant_trau']) <> '') { $ant_trau = addslashes($_POST['ant_trau']); } else { $ant_trau = ''; }
if (isset($_POST['ant_trau_enfer1']) <> '') { $ant_trau_enfer1 = addslashes($_POST['ant_trau_enfer1']); } else { $ant_trau_enfer1 = ''; }
if (isset($_POST['ant_trau_observ1']) <> '') { $ant_trau_observ1 = addslashes($_POST['ant_trau_observ1']); } else { $ant_trau_observ1 = ''; }
if (isset($_POST['ant_trau_fech_aprox1']) <> '') { $ant_trau_fech_aprox1 = addslashes($_POST['ant_trau_fech_aprox1']); } else { $ant_trau_fech_aprox1 = ''; }
if (isset($_POST['ant_trau_enfer2']) <> '') { $ant_trau_enfer2 = addslashes($_POST['ant_trau_enfer2']); } else { $ant_trau_enfer2 = ''; }
if (isset($_POST['ant_trau_observ2']) <> '') { $ant_trau_observ2 = addslashes($_POST['ant_trau_observ2']); } else { $ant_trau_observ2 = ''; }
if (isset($_POST['ant_trau_fech_aprox2']) <> '') { $ant_trau_fech_aprox2 = addslashes($_POST['ant_trau_fech_aprox2']); } else { $ant_trau_fech_aprox2 = ''; }
if (isset($_POST['ant_trau_enfer3']) <> '') { $ant_trau_enfer3 = addslashes($_POST['ant_trau_enfer3']); } else { $ant_trau_enfer3 = ''; }
if (isset($_POST['ant_trau_observ3']) <> '') { $ant_trau_observ3 = addslashes($_POST['ant_trau_observ3']); } else { $ant_trau_observ3 = ''; }
if (isset($_POST['ant_trau_fech_aprox3']) <> '') { $ant_trau_fech_aprox3 = addslashes($_POST['ant_trau_fech_aprox3']); } else { $ant_trau_fech_aprox3 = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['ant_quirur']) <> '') { $ant_quirur = addslashes($_POST['ant_quirur']); } else { $ant_quirur = ''; }
if (isset($_POST['ant_quirur_enfer1']) <> '') { $ant_quirur_enfer1 = addslashes($_POST['ant_quirur_enfer1']); } else { $ant_quirur_enfer1 = ''; }
if (isset($_POST['ant_quirur_observ1']) <> '') { $ant_quirur_observ1 = addslashes($_POST['ant_quirur_observ1']); } else { $ant_quirur_observ1 = ''; }
if (isset($_POST['ant_quirur_fech_aprox1']) <> '') { $ant_quirur_fech_aprox1 = addslashes($_POST['ant_quirur_fech_aprox1']); } else { $ant_quirur_fech_aprox1 = ''; }
if (isset($_POST['ant_quirur_enfer2']) <> '') { $ant_quirur_enfer2 = addslashes($_POST['ant_quirur_enfer2']); } else { $ant_quirur_enfer2 = ''; }
if (isset($_POST['ant_quirur_observ2']) <> '') { $ant_quirur_observ2 = addslashes($_POST['ant_quirur_observ2']); } else { $ant_quirur_observ2 = ''; }
if (isset($_POST['ant_quirur_fech_aprox2']) <> '') { $ant_quirur_fech_aprox2 = addslashes($_POST['ant_quirur_fech_aprox2']); } else { $ant_quirur_fech_aprox2 = ''; }
if (isset($_POST['ant_quirur_enfer3']) <> '') { $ant_quirur_enfer3 = addslashes($_POST['ant_quirur_enfer3']); } else { $ant_quirur_enfer3 = ''; }
if (isset($_POST['ant_quirur_observ3']) <> '') { $ant_quirur_observ3 = addslashes($_POST['ant_quirur_observ3']); } else { $ant_quirur_observ3 = ''; }
if (isset($_POST['ant_quirur_fech_aprox3']) <> '') { $ant_quirur_fech_aprox3 = addslashes($_POST['ant_quirur_fech_aprox3']); } else { $ant_quirur_fech_aprox3 = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['costo_motivo_consulta']) <> '') { $costo_motivo_consulta = intval($_POST['costo_motivo_consulta']); } else { $costo_motivo_consulta = '0'; }
if (isset($_POST['cod_factura']) <> '') { $cod_factura = intval($_POST['cod_factura']); } else { $cod_factura = '0'; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['ant_inmuni']) == 'SI') {
$ant_inmuni = 'SI';
if (isset($_POST['ant_inmuni_tetano']) <> '') { $ant_inmuni_tetano = addslashes($_POST['ant_inmuni_tetano']); } else { $ant_inmuni_tetano = 'SI'; }
if (isset($_POST['ant_inmuni_fiebtifo']) <> '') { $ant_inmuni_fiebtifo = addslashes($_POST['ant_inmuni_fiebtifo']); } else { $ant_inmuni_fiebtifo = 'SI'; }
if (isset($_POST['ant_inmuni_hepatita']) <> '') { $ant_inmuni_hepatita = addslashes($_POST['ant_inmuni_hepatita']); } else { $ant_inmuni_hepatita = 'SI'; }
if (isset($_POST['ant_inmuni_influenza']) <> '') { $ant_inmuni_influenza = addslashes($_POST['ant_inmuni_influenza']); } else { $ant_inmuni_influenza = 'SI'; }
if (isset($_POST['ant_inmuni_hepatitb']) <> '') { $ant_inmuni_hepatitb = addslashes($_POST['ant_inmuni_hepatitb']); } else { $ant_inmuni_hepatitb = 'SI'; }
if (isset($_POST['ant_inmuni_saramp']) <> '') { $ant_inmuni_saramp = addslashes($_POST['ant_inmuni_saramp']); } else { $ant_inmuni_saramp = 'SI'; }
if (isset($_POST['ant_inmuni_fiebamarill']) <> '') { $ant_inmuni_fiebamarill = addslashes($_POST['ant_inmuni_fiebamarill']); } else { $ant_inmuni_fiebamarill = 'SI'; }
if (isset($_POST['ant_inmuni_otra']) <> '') { $ant_inmuni_otra = addslashes($_POST['ant_inmuni_otra']); } else { $ant_inmuni_otra = 'SI'; }
} else {
$ant_inmuni = 'NO';
if (isset($_POST['ant_inmuni_tetano']) <> '') { $ant_inmuni_tetano = addslashes($_POST['ant_inmuni_tetano']); } else { $ant_inmuni_tetano = 'NO'; }
if (isset($_POST['ant_inmuni_fiebtifo']) <> '') { $ant_inmuni_fiebtifo = addslashes($_POST['ant_inmuni_fiebtifo']); } else { $ant_inmuni_fiebtifo = 'NO'; }
if (isset($_POST['ant_inmuni_hepatita']) <> '') { $ant_inmuni_hepatita = addslashes($_POST['ant_inmuni_hepatita']); } else { $ant_inmuni_hepatita = 'NO'; }
if (isset($_POST['ant_inmuni_influenza']) <> '') { $ant_inmuni_influenza = addslashes($_POST['ant_inmuni_influenza']); } else { $ant_inmuni_influenza = 'NO'; }
if (isset($_POST['ant_inmuni_hepatitb']) <> '') { $ant_inmuni_hepatitb = addslashes($_POST['ant_inmuni_hepatitb']); } else { $ant_inmuni_hepatitb = 'NO'; }
if (isset($_POST['ant_inmuni_saramp']) <> '') { $ant_inmuni_saramp = addslashes($_POST['ant_inmuni_saramp']); } else { $ant_inmuni_saramp = 'NO'; }
if (isset($_POST['ant_inmuni_fiebamarill']) <> '') { $ant_inmuni_fiebamarill = addslashes($_POST['ant_inmuni_fiebamarill']); } else { $ant_inmuni_fiebamarill = 'NO'; }
if (isset($_POST['ant_inmuni_otra']) <> '') { $ant_inmuni_otra = addslashes($_POST['ant_inmuni_otra']); } else { $ant_inmuni_otra = 'NO'; }
}
if (isset($_POST['ant_inmuni_tetano_anyo']) <> '') { $ant_inmuni_tetano_anyo = addslashes($_POST['ant_inmuni_tetano_anyo']); } else { $ant_inmuni_tetano_anyo = ''; }
if (isset($_POST['ant_inmuni_fiebtifo_anyo']) <> '') { $ant_inmuni_fiebtifo_anyo = addslashes($_POST['ant_inmuni_fiebtifo_anyo']); } else { $ant_inmuni_fiebtifo_anyo = ''; }
if (isset($_POST['ant_inmuni_hepatita_anyo']) <> '') { $ant_inmuni_hepatita_anyo = addslashes($_POST['ant_inmuni_hepatita_anyo']); } else { $ant_inmuni_hepatita_anyo = ''; }
if (isset($_POST['ant_inmuni_influenza_anyo']) <> '') { $ant_inmuni_influenza_anyo = addslashes($_POST['ant_inmuni_influenza_anyo']); } else { $ant_inmuni_influenza_anyo = ''; }
if (isset($_POST['ant_inmuni_hepatitb_anyo']) <> '') { $ant_inmuni_hepatitb_anyo = addslashes($_POST['ant_inmuni_hepatitb_anyo']); } else { $ant_inmuni_hepatitb_anyo = ''; }
if (isset($_POST['ant_inmuni_saramp_anyo']) <> '') { $ant_inmuni_saramp_anyo = addslashes($_POST['ant_inmuni_saramp_anyo']); } else { $ant_inmuni_saramp_anyo = ''; }
if (isset($_POST['ant_inmuni_fiebamarill_anyo']) <> '') { $ant_inmuni_fiebamarill_anyo = addslashes($_POST['ant_inmuni_fiebamarill_anyo']); } else { $ant_inmuni_fiebamarill_anyo = ''; }
if (isset($_POST['ant_inmuni_otra_anyo']) <> '') { $ant_inmuni_otra_anyo = addslashes($_POST['ant_inmuni_otra_anyo']); } else { $ant_inmuni_otra_anyo = ''; }
if (isset($_POST['ant_inmuni_observacion']) <> '') { $ant_inmuni_observacion = addslashes($_POST['ant_inmuni_observacion']); } else { $ant_inmuni_observacion = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['ant_gine_prim_mestrua']) <> '') { $ant_gine_prim_mestrua = addslashes($_POST['ant_gine_prim_mestrua']); } else { $ant_gine_prim_mestrua = ''; }
if (isset($_POST['ant_gine_anyos']) <> '') { $ant_gine_anyos = addslashes($_POST['ant_gine_anyos']); } else { $ant_gine_anyos = ''; }
if (isset($_POST['ant_gine_cliclo']) <> '') { $ant_gine_cliclo = addslashes($_POST['ant_gine_cliclo']); } else { $ant_gine_cliclo = ''; }
if (isset($_POST['ant_gine_fum']) <> '') { $ant_gine_fum = addslashes($_POST['ant_gine_fum']); } else { $ant_gine_fum = ''; }
if (isset($_POST['ant_gine_fup']) <> '') { $ant_gine_fup = addslashes($_POST['ant_gine_fup']); } else { $ant_gine_fup = ''; }
if (isset($_POST['ant_gine_fuc']) <> '') { $ant_gine_fuc = addslashes($_POST['ant_gine_fuc']); } else { $ant_gine_fuc = ''; }
if (isset($_POST['ant_gine_fich_gine']) <> '') { $ant_gine_fich_gine = addslashes($_POST['ant_gine_fich_gine']); } else { $ant_gine_fich_gine = ''; }
if (isset($_POST['ant_gine_fich_gine_g']) <> '') { $ant_gine_fich_gine_g = addslashes($_POST['ant_gine_fich_gine_g']); } else { $ant_gine_fich_gine_g = ''; }
if (isset($_POST['ant_gine_fich_gine_p']) <> '') { $ant_gine_fich_gine_p = addslashes($_POST['ant_gine_fich_gine_p']); } else { $ant_gine_fich_gine_p = ''; }
if (isset($_POST['ant_gine_fich_gine_a']) <> '') { $ant_gine_fich_gine_a = addslashes($_POST['ant_gine_fich_gine_a']); } else { $ant_gine_fich_gine_a = ''; }
if (isset($_POST['ant_gine_fich_gine_c']) <> '') { $ant_gine_fich_gine_c = addslashes($_POST['ant_gine_fich_gine_c']); } else { $ant_gine_fich_gine_c = ''; }
if (isset($_POST['ant_gine_fich_gine_m']) <> '') { $ant_gine_fich_gine_m = addslashes($_POST['ant_gine_fich_gine_m']); } else { $ant_gine_fich_gine_m = ''; }
if (isset($_POST['ant_gine_fich_gine_e']) <> '') { $ant_gine_fich_gine_e = addslashes($_POST['ant_gine_fich_gine_e']); } else { $ant_gine_fich_gine_e = ''; }
if (isset($_POST['ant_gine_fich_gine_v']) <> '') { $ant_gine_fich_gine_v = addslashes($_POST['ant_gine_fich_gine_v']); } else { $ant_gine_fich_gine_v = ''; }
if (isset($_POST['ant_gine_fech_ult_exa_mama']) <> '') { $ant_gine_fech_ult_exa_mama = addslashes($_POST['ant_gine_fech_ult_exa_mama']); } else { $ant_gine_fech_ult_exa_mama = ''; }
if (isset($_POST['ant_gine_planifica']) <> '') { $ant_gine_planifica = addslashes($_POST['ant_gine_planifica']); } else { $ant_gine_planifica = ''; }
if (isset($_POST['ant_gine_observacion']) <> '') { $ant_gine_observacion = addslashes($_POST['ant_gine_observacion']); } else { $ant_gine_observacion = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['habit_tox_fum_nofum_exfum']) <> '') { $habit_tox_fum_nofum_exfum = addslashes($_POST['habit_tox_fum_nofum_exfum']); } else { $habit_tox_fum_nofum_exfum = ''; }
if (isset($_POST['habit_tox_ciga_aldia']) <> '') { $habit_tox_ciga_aldia = addslashes($_POST['habit_tox_ciga_aldia']); } else { $habit_tox_ciga_aldia = ''; }
if (isset($_POST['habit_tox_anyos_fum']) <> '') { $habit_tox_anyos_fum = addslashes($_POST['habit_tox_anyos_fum']); } else { $habit_tox_anyos_fum = ''; }
if (isset($_POST['habit_tox_tiem_sinfum']) <> '') { $habit_tox_tiem_sinfum = addslashes($_POST['habit_tox_tiem_sinfum']); } else { $habit_tox_tiem_sinfum = ''; }
if (isset($_POST['habit_tox_consum_alcoh']) <> '') { $habit_tox_consum_alcoh = addslashes($_POST['habit_tox_consum_alcoh']); } else { $habit_tox_consum_alcoh = ''; }
if (isset($_POST['habit_tox_activ_extralab']) <> '') { $habit_tox_activ_extralab = addslashes($_POST['habit_tox_activ_extralab']); } else { $habit_tox_activ_extralab = ''; }
if (isset($_POST['habit_tox_activfis']) <> '') { $habit_tox_activfis = addslashes($_POST['habit_tox_activfis']); } else { $habit_tox_activfis = ''; }
if (isset($_POST['habit_tox_actividad']) <> '') { $habit_tox_actividad = addslashes($_POST['habit_tox_actividad']); } else { $habit_tox_actividad = ''; }
if (isset($_POST['habit_tox_frecuenc']) <> '') { $habit_tox_frecuenc = addslashes($_POST['habit_tox_frecuenc']); } else { $habit_tox_frecuenc = ''; }
if (isset($_POST['habit_tox_tiempo']) <> '') { $habit_tox_tiempo = addslashes($_POST['habit_tox_tiempo']); } else { $habit_tox_tiempo = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['rev_sist_no']) <> '') { $rev_sist_no = addslashes($_POST['rev_sist_no']); } else { $rev_sist_no = ''; }
if (isset($_POST['rev_sist_orgsentido']) <> '') { $rev_sist_orgsentido = addslashes($_POST['rev_sist_orgsentido']); } else { $rev_sist_orgsentido = 'NO'; }
if (isset($_POST['rev_sist_ref_orgsentido']) <> '') { $rev_sist_ref_orgsentido = addslashes($_POST['rev_sist_ref_orgsentido']); } else { $rev_sist_ref_orgsentido = 'NO'; }
if (isset($_POST['rev_sist_noref_orgsentido']) <> '') { $rev_sist_noref_orgsentido = addslashes($_POST['rev_sist_noref_orgsentido']); } else { $rev_sist_noref_orgsentido = 'NO'; }
if (isset($_POST['rev_sist_observ_orgsentido']) <> '') { $rev_sist_observ_orgsentido = addslashes($_POST['rev_sist_observ_orgsentido']); } else { $rev_sist_observ_orgsentido = ''; }
if (isset($_POST['rev_sist_neurolog']) <> '') { $rev_sist_neurolog = addslashes($_POST['rev_sist_neurolog']); } else { $rev_sist_neurolog = 'NO'; }
if (isset($_POST['rev_sist_ref_neurolog']) <> '') { $rev_sist_ref_neurolog = addslashes($_POST['rev_sist_ref_neurolog']); } else { $rev_sist_ref_neurolog = 'NO'; }
if (isset($_POST['rev_sist_noref_neurolog']) <> '') { $rev_sist_noref_neurolog = addslashes($_POST['rev_sist_noref_neurolog']); } else { $rev_sist_noref_neurolog = 'NO'; }
if (isset($_POST['rev_sist_observ_neurolog']) <> '') { $rev_sist_observ_neurolog = addslashes($_POST['rev_sist_observ_neurolog']); } else { $rev_sist_observ_neurolog = ''; }
if (isset($_POST['rev_sist_resp']) <> '') { $rev_sist_resp = addslashes($_POST['rev_sist_resp']); } else { $rev_sist_resp = 'NO'; }
if (isset($_POST['rev_sist_ref_resp']) <> '') { $rev_sist_ref_resp = addslashes($_POST['rev_sist_ref_resp']); } else { $rev_sist_ref_resp = 'NO'; }
if (isset($_POST['rev_sist_noref_resp']) <> '') { $rev_sist_noref_resp = addslashes($_POST['rev_sist_noref_resp']); } else { $rev_sist_noref_resp = 'NO'; }
if (isset($_POST['rev_sist_observ_resp']) <> '') { $rev_sist_observ_resp = addslashes($_POST['rev_sist_observ_resp']); } else { $rev_sist_observ_resp = ''; }
if (isset($_POST['rev_sist_gastrointes']) <> '') { $rev_sist_gastrointes = addslashes($_POST['rev_sist_gastrointes']); } else { $rev_sist_gastrointes = 'NO'; }
if (isset($_POST['rev_sist_ref_gastrointes']) <> '') { $rev_sist_ref_gastrointes = addslashes($_POST['rev_sist_ref_gastrointes']); } else { $rev_sist_ref_gastrointes = 'NO'; }
if (isset($_POST['rev_sist_noref_gastrointes']) <> '') { $rev_sist_noref_gastrointes = addslashes($_POST['rev_sist_noref_gastrointes']); } else { $rev_sist_noref_gastrointes = 'NO'; }
if (isset($_POST['rev_sist_observ_gastrointes']) <> '') { $rev_sist_observ_gastrointes = addslashes($_POST['rev_sist_observ_gastrointes']); } else { $rev_sist_observ_gastrointes = ''; }
if (isset($_POST['rev_sist_geniuri']) <> '') { $rev_sist_geniuri = addslashes($_POST['rev_sist_geniuri']); } else { $rev_sist_geniuri = 'NO'; }
if (isset($_POST['rev_sist_ref_geniuri']) <> '') { $rev_sist_ref_geniuri = addslashes($_POST['rev_sist_ref_geniuri']); } else { $rev_sist_ref_geniuri = 'NO'; }
if (isset($_POST['rev_sist_noref_geniuri']) <> '') { $rev_sist_noref_geniuri = addslashes($_POST['rev_sist_noref_geniuri']); } else { $rev_sist_noref_geniuri = 'NO'; }
if (isset($_POST['rev_sist_observ_geniuri']) <> '') { $rev_sist_observ_geniuri = addslashes($_POST['rev_sist_observ_geniuri']); } else { $rev_sist_observ_geniuri = ''; }
if (isset($_POST['rev_sist_osteomus']) <> '') { $rev_sist_osteomus = addslashes($_POST['rev_sist_osteomus']); } else { $rev_sist_osteomus = 'NO'; }
if (isset($_POST['rev_sist_ref_osteomus']) <> '') { $rev_sist_ref_osteomus = addslashes($_POST['rev_sist_ref_osteomus']); } else { $rev_sist_ref_osteomus = 'NO'; }
if (isset($_POST['rev_sist_noref_osteomus']) <> '') { $rev_sist_noref_osteomus = addslashes($_POST['rev_sist_noref_osteomus']); } else { $rev_sist_noref_osteomus = 'NO'; }
if (isset($_POST['rev_sist_observ_osteomus']) <> '') { $rev_sist_observ_osteomus = addslashes($_POST['rev_sist_observ_osteomus']); } else { $rev_sist_observ_osteomus = ''; }
if (isset($_POST['rev_sist_dermato']) <> '') { $rev_sist_dermato = addslashes($_POST['rev_sist_dermato']); } else { $rev_sist_dermato = 'NO'; }
if (isset($_POST['rev_sist_ref_dermato']) <> '') { $rev_sist_ref_dermato = addslashes($_POST['rev_sist_ref_dermato']); } else { $rev_sist_ref_dermato = 'NO'; }
if (isset($_POST['rev_sist_noref_dermato']) <> '') { $rev_sist_noref_dermato = addslashes($_POST['rev_sist_noref_dermato']); } else { $rev_sist_noref_dermato = 'NO'; }
if (isset($_POST['rev_sist_observ_dermato']) <> '') { $rev_sist_observ_dermato = addslashes($_POST['rev_sist_observ_dermato']); } else { $rev_sist_observ_dermato = ''; }
if (isset($_POST['rev_sist_cardiovas']) <> '') { $rev_sist_cardiovas = addslashes($_POST['rev_sist_cardiovas']); } else { $rev_sist_cardiovas = 'NO'; }
if (isset($_POST['rev_sist_ref_cardiovas']) <> '') { $rev_sist_ref_cardiovas = addslashes($_POST['rev_sist_ref_cardiovas']); } else { $rev_sist_ref_cardiovas = 'NO'; }
if (isset($_POST['rev_sist_noref_cardiovas']) <> '') { $rev_sist_noref_cardiovas = addslashes($_POST['rev_sist_noref_cardiovas']); } else { $rev_sist_noref_cardiovas = 'NO'; }
if (isset($_POST['rev_sist_observ_cardiovas']) <> '') { $rev_sist_observ_cardiovas = addslashes($_POST['rev_sist_observ_cardiovas']); } else { $rev_sist_observ_cardiovas = ''; }
if (isset($_POST['rev_sist_constitu']) <> '') { $rev_sist_constitu = addslashes($_POST['rev_sist_constitu']); } else { $rev_sist_constitu = 'NO'; }
if (isset($_POST['rev_sist_ref_constitu']) <> '') { $rev_sist_ref_constitu = addslashes($_POST['rev_sist_ref_constitu']); } else { $rev_sist_ref_constitu = 'NO'; }
if (isset($_POST['rev_sist_noref_constitu']) <> '') { $rev_sist_noref_constitu = addslashes($_POST['rev_sist_noref_constitu']); } else { $rev_sist_noref_constitu = 'NO'; }
if (isset($_POST['rev_sist_observ_constitu']) <> '') { $rev_sist_observ_constitu = addslashes($_POST['rev_sist_observ_constitu']); } else { $rev_sist_observ_constitu = ''; }
if (isset($_POST['rev_sist_metabolendocri']) <> '') { $rev_sist_metabolendocri = addslashes($_POST['rev_sist_metabolendocri']); } else { $rev_sist_metabolendocri = 'NO'; }
if (isset($_POST['rev_sist_ref_metabolendocri']) <> '') { $rev_sist_ref_metabolendocri = addslashes($_POST['rev_sist_ref_metabolendocri']); } else { $rev_sist_ref_metabolendocri = 'NO'; }
if (isset($_POST['rev_sist_noref_metabolendocri']) <> '') { $rev_sist_noref_metabolendocri = addslashes($_POST['rev_sist_noref_metabolendocri']); } else { $rev_sist_noref_metabolendocri = 'NO'; }
if (isset($_POST['rev_sist_observ_metabolendocri']) <> '') { $rev_sist_observ_metabolendocri = addslashes($_POST['rev_sist_observ_metabolendocri']); } else { $rev_sist_observ_metabolendocri = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['eval_estment_norm_orient']) <> '') { $eval_estment_norm_orient = addslashes($_POST['eval_estment_norm_orient']); } else { $eval_estment_norm_orient = ''; }
if (isset($_POST['eval_estment_disf_orient']) <> '') { $eval_estment_disf_orient = addslashes($_POST['eval_estment_disf_orient']); } else { $eval_estment_disf_orient = ''; }
if (isset($_POST['eval_estment_halla_orient']) <> '') { $eval_estment_halla_orient = addslashes($_POST['eval_estment_halla_orient']); } else { $eval_estment_halla_orient = ''; }
if (isset($_POST['eval_estment_norm_atenconcent']) <> '') { $eval_estment_norm_atenconcent = addslashes($_POST['eval_estment_norm_atenconcent']); } else { $eval_estment_norm_atenconcent = ''; }
if (isset($_POST['eval_estment_disf_atenconcent']) <> '') { $eval_estment_disf_atenconcent = addslashes($_POST['eval_estment_disf_atenconcent']); } else { $eval_estment_disf_atenconcent = ''; }
if (isset($_POST['eval_estment_halla_atenconcent']) <> '') { $eval_estment_halla_atenconcent = addslashes($_POST['eval_estment_halla_atenconcent']); } else { $eval_estment_halla_atenconcent = ''; }
if (isset($_POST['eval_estment_norm_sensoper']) <> '') { $eval_estment_norm_sensoper = addslashes($_POST['eval_estment_norm_sensoper']); } else { $eval_estment_norm_sensoper = ''; }
if (isset($_POST['eval_estment_disf_sensoper']) <> '') { $eval_estment_disf_sensoper = addslashes($_POST['eval_estment_disf_sensoper']); } else { $eval_estment_disf_sensoper = ''; }
if (isset($_POST['eval_estment_halla_sensoper']) <> '') { $eval_estment_halla_sensoper = addslashes($_POST['eval_estment_halla_sensoper']); } else { $eval_estment_halla_sensoper = ''; }
if (isset($_POST['eval_estment_norm_memor']) <> '') { $eval_estment_norm_memor = addslashes($_POST['eval_estment_norm_memor']); } else { $eval_estment_norm_memor = ''; }
if (isset($_POST['eval_estment_disf_memor']) <> '') { $eval_estment_disf_memor = addslashes($_POST['eval_estment_disf_memor']); } else { $eval_estment_disf_memor = ''; }
if (isset($_POST['eval_estment_halla_memor']) <> '') { $eval_estment_halla_memor = addslashes($_POST['eval_estment_halla_memor']); } else { $eval_estment_halla_memor = ''; }
if (isset($_POST['eval_estment_norm_pensami']) <> '') { $eval_estment_norm_pensami = addslashes($_POST['eval_estment_norm_pensami']); } else { $eval_estment_norm_pensami = ''; }
if (isset($_POST['eval_estment_disf_pensami']) <> '') { $eval_estment_disf_pensami = addslashes($_POST['eval_estment_disf_pensami']); } else { $eval_estment_disf_pensami = ''; }
if (isset($_POST['eval_estment_halla_pensami']) <> '') { $eval_estment_halla_pensami = addslashes($_POST['eval_estment_halla_pensami']); } else { $eval_estment_halla_pensami = ''; }
if (isset($_POST['eval_estment_norm_lenguaj']) <> '') { $eval_estment_norm_lenguaj = addslashes($_POST['eval_estment_norm_lenguaj']); } else { $eval_estment_norm_lenguaj = ''; }
if (isset($_POST['eval_estment_disf_lenguaj']) <> '') { $eval_estment_disf_lenguaj = addslashes($_POST['eval_estment_disf_lenguaj']); } else { $eval_estment_disf_lenguaj = ''; }
if (isset($_POST['eval_estment_halla_lenguaj']) <> '') { $eval_estment_halla_lenguaj = addslashes($_POST['eval_estment_halla_lenguaj']); } else { $eval_estment_halla_lenguaj = ''; }
if (isset($_POST['eval_estment_concept']) <> '') { $eval_estment_concept = addslashes($_POST['eval_estment_concept']); } else { $eval_estment_concept = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['exa_fis_peso']) <> '') { $exa_fis_peso = addslashes($_POST['exa_fis_peso']); } else { $exa_fis_peso = ''; }
if (isset($_POST['exa_fis_talla']) <> '') { $exa_fis_talla = addslashes($_POST['exa_fis_talla']); } else { $exa_fis_talla = ''; }
//if (isset($_POST['exa_fis_imc']) <> '') { $exa_fis_imc = addslashes($_POST['exa_fis_imc']); } else { $exa_fis_imc = ''; }
//$exa_fis_imc = $_POST['exa_fis_peso'] / pow($_POST['exa_fis_talla'], 2);
if (isset($_POST['exa_fis_imc']) <> '') { $exa_fis_imc = addslashes($_POST['exa_fis_imc']); } else { $exa_fis_imc = ''; }
if (isset($_POST['exa_fis_interpreimc']) <> '') { $exa_fis_interpreimc = addslashes($_POST['exa_fis_interpreimc']); } else { $exa_fis_interpreimc = ''; }
if (isset($_POST['exa_fis_fresp']) <> '') { $exa_fis_fresp = addslashes($_POST['exa_fis_fresp']); } else { $exa_fis_fresp = ''; }
if (isset($_POST['exa_fis_fc']) <> '') { $exa_fis_fc = addslashes($_POST['exa_fis_fc']); } else { $exa_fis_fc = ''; }
if (isset($_POST['exa_fis_ta']) <> '') { $exa_fis_ta = addslashes($_POST['exa_fis_ta']); } else { $exa_fis_ta = ''; }
if (isset($_POST['exa_fis_lateral']) <> '') { $exa_fis_lateral = addslashes($_POST['exa_fis_lateral']); } else { $exa_fis_lateral = ''; }
if (isset($_POST['exa_fis_periabdom']) <> '') { $exa_fis_periabdom = addslashes($_POST['exa_fis_periabdom']); } else { $exa_fis_periabdom = ''; }
if (isset($_POST['exa_fis_temperat']) <> '') { $exa_fis_temperat = addslashes($_POST['exa_fis_temperat']); } else { $exa_fis_temperat = ''; }
if (isset($_POST['exa_fis_concepto']) <> '') { $exa_fis_concepto = addslashes($_POST['exa_fis_concepto']); } else { $exa_fis_concepto = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//

if (isset($_POST['exa_fis_ojoder_sncorre_vlejan']) <> '') { $exa_fis_ojoder_sncorre_vlejan = addslashes($_POST['exa_fis_ojoder_sncorre_vlejan']); } else { $exa_fis_ojoder_sncorre_vlejan = ''; }
if (isset($_POST['exa_fis_ojoder_sncorre_vcerca']) <> '') { $exa_fis_ojoder_sncorre_vcerca = addslashes($_POST['exa_fis_ojoder_sncorre_vcerca']); } else { $exa_fis_ojoder_sncorre_vcerca = ''; }
if (isset($_POST['exa_fis_ojoder_cncorre_vlejan']) <> '') { $exa_fis_ojoder_cncorre_vlejan = addslashes($_POST['exa_fis_ojoder_cncorre_vlejan']); } else { $exa_fis_ojoder_cncorre_vlejan = ''; }
if (isset($_POST['exa_fis_ojoder_cncorre_vcerca']) <> '') { $exa_fis_ojoder_cncorre_vcerca = addslashes($_POST['exa_fis_ojoder_cncorre_vcerca']); } else { $exa_fis_ojoder_cncorre_vcerca = ''; }
if (isset($_POST['exa_fis_ojoizq_sncorre_vlejan']) <> '') { $exa_fis_ojoizq_sncorre_vlejan = addslashes($_POST['exa_fis_ojoizq_sncorre_vlejan']); } else { $exa_fis_ojoizq_sncorre_vlejan = ''; }
if (isset($_POST['exa_fis_ojoizq_sncorre_vcerca']) <> '') { $exa_fis_ojoizq_sncorre_vcerca = addslashes($_POST['exa_fis_ojoizq_sncorre_vcerca']); } else { $exa_fis_ojoizq_sncorre_vcerca = ''; }
if (isset($_POST['exa_fis_ojoizq_cncorre_vlejan']) <> '') { $exa_fis_ojoizq_cncorre_vlejan = addslashes($_POST['exa_fis_ojoizq_cncorre_vlejan']); } else { $exa_fis_ojoizq_cncorre_vlejan = ''; }
if (isset($_POST['exa_fis_ojoizq_cncorre_vcerca']) <> '') { $exa_fis_ojoizq_cncorre_vcerca = addslashes($_POST['exa_fis_ojoizq_cncorre_vcerca']); } else { $exa_fis_ojoizq_cncorre_vcerca = ''; }
if (isset($_POST['exa_fis_ojoamb_sncorre_vlejan']) <> '') { $exa_fis_ojoamb_sncorre_vlejan = addslashes($_POST['exa_fis_ojoamb_sncorre_vlejan']); } else { $exa_fis_ojoamb_sncorre_vlejan = ''; }
if (isset($_POST['exa_fis_ojoamb_sncorre_vcerca']) <> '') { $exa_fis_ojoamb_sncorre_vcerca = addslashes($_POST['exa_fis_ojoamb_sncorre_vcerca']); } else { $exa_fis_ojoamb_sncorre_vcerca = ''; }
if (isset($_POST['exa_fis_oojoamb_cncorre_vlejan']) <> '') { $exa_fis_oojoamb_cncorre_vlejan = addslashes($_POST['exa_fis_oojoamb_cncorre_vlejan']); } else { $exa_fis_oojoamb_cncorre_vlejan = ''; }
if (isset($_POST['exa_fis_ojoamb_cncorre_vcerca']) <> '') { $exa_fis_ojoamb_cncorre_vcerca = addslashes($_POST['exa_fis_ojoamb_cncorre_vcerca']); } else { $exa_fis_ojoamb_cncorre_vcerca = ''; }
if (isset($_POST['exa_fis_ojo']) <> '') { $exa_fis_ojo = addslashes($_POST['exa_fis_ojo']); } else { $exa_fis_ojo = 'NE'; }
if (isset($_POST['exa_fis_ojo_obser']) <> '') { $exa_fis_ojo_obser = addslashes($_POST['exa_fis_ojo_obser']); } else { $exa_fis_ojo_obser = ''; }
if (isset($_POST['exa_fis_oido']) <> '') { $exa_fis_oido = addslashes($_POST['exa_fis_oido']); } else { $exa_fis_oido = 'NE'; }
if (isset($_POST['exa_fis_oido_obser']) <> '') { $exa_fis_oido_obser = addslashes($_POST['exa_fis_oido_obser']); } else { $exa_fis_oido_obser = ''; }
if (isset($_POST['exa_fis_cabeza']) <> '') { $exa_fis_cabeza = addslashes($_POST['exa_fis_cabeza']); } else { $exa_fis_cabeza = 'NE'; }
if (isset($_POST['exa_fis_cabeza_obser']) <> '') { $exa_fis_cabeza_obser = addslashes($_POST['exa_fis_cabeza_obser']); } else { $exa_fis_cabeza_obser = ''; }
if (isset($_POST['exa_fis_nariz']) <> '') { $exa_fis_nariz = addslashes($_POST['exa_fis_nariz']); } else { $exa_fis_nariz = 'NE'; }
if (isset($_POST['exa_fis_nariz_obser']) <> '') { $exa_fis_nariz_obser = addslashes($_POST['exa_fis_nariz_obser']); } else { $exa_fis_nariz_obser = ''; }
if (isset($_POST['exa_fis_orofaring']) <> '') { $exa_fis_orofaring = addslashes($_POST['exa_fis_orofaring']); } else { $exa_fis_orofaring = 'NE'; }
if (isset($_POST['exa_fis_orofaring_obser']) <> '') { $exa_fis_orofaring_obser = addslashes($_POST['exa_fis_orofaring_obser']); } else { $exa_fis_orofaring_obser = ''; }
if (isset($_POST['exa_fis_cuello']) <> '') { $exa_fis_cuello = addslashes($_POST['exa_fis_cuello']); } else { $exa_fis_cuello = 'NE'; }
if (isset($_POST['exa_fis_cuello_obser']) <> '') { $exa_fis_cuello_obser = addslashes($_POST['exa_fis_cuello_obser']); } else { $exa_fis_cuello_obser = ''; }
if (isset($_POST['exa_fis_torax']) <> '') { $exa_fis_torax = addslashes($_POST['exa_fis_torax']); } else { $exa_fis_torax = 'NE'; }
if (isset($_POST['exa_fis_torax_obser']) <> '') { $exa_fis_torax_obser = addslashes($_POST['exa_fis_torax_obser']); } else { $exa_fis_torax_obser = ''; }
if (isset($_POST['exa_fis_glandumama']) <> '') { $exa_fis_glandumama = addslashes($_POST['exa_fis_glandumama']); } else { $exa_fis_glandumama = 'NE'; }
if (isset($_POST['exa_fis_glandumama_obser']) <> '') { $exa_fis_glandumama_obser = addslashes($_POST['exa_fis_glandumama_obser']); } else { $exa_fis_glandumama_obser = ''; }
if (isset($_POST['exa_fis_cardiopulm']) <> '') { $exa_fis_cardiopulm = addslashes($_POST['exa_fis_cardiopulm']); } else { $exa_fis_cardiopulm = 'NE'; }
if (isset($_POST['exa_fis_cardiopulm_obser']) <> '') { $exa_fis_cardiopulm_obser = addslashes($_POST['exa_fis_cardiopulm_obser']); } else { $exa_fis_cardiopulm_obser = ''; }
if (isset($_POST['exa_fis_abdomen']) <> '') { $exa_fis_abdomen = addslashes($_POST['exa_fis_abdomen']); } else { $exa_fis_abdomen = 'NE'; }
if (isset($_POST['exa_fis_abdomen_obser']) <> '') { $exa_fis_abdomen_obser = addslashes($_POST['exa_fis_abdomen_obser']); } else { $exa_fis_abdomen_obser = ''; }
if (isset($_POST['exa_fis_genital']) <> '') { $exa_fis_genital = addslashes($_POST['exa_fis_genital']); } else { $exa_fis_genital = 'NE'; }
if (isset($_POST['exa_fis_genital_obser']) <> '') { $exa_fis_genital_obser = addslashes($_POST['exa_fis_genital_obser']); } else { $exa_fis_genital_obser = ''; }
if (isset($_POST['exa_fis_miemsup']) <> '') { $exa_fis_miemsup = addslashes($_POST['exa_fis_miemsup']); } else { $exa_fis_miemsup = 'NE'; }
if (isset($_POST['exa_fis_miemsup_obser']) <> '') { $exa_fis_miemsup_obser = addslashes($_POST['exa_fis_miemsup_obser']); } else { $exa_fis_miemsup_obser = ''; }
if (isset($_POST['exa_fis_mieminf']) <> '') { $exa_fis_mieminf = addslashes($_POST['exa_fis_mieminf']); } else { $exa_fis_mieminf = 'NE'; }
if (isset($_POST['exa_fis_mieminf_obser']) <> '') { $exa_fis_mieminf_obser = addslashes($_POST['exa_fis_mieminf_obser']); } else { $exa_fis_mieminf_obser = ''; }
if (isset($_POST['exa_fis_columna']) <> '') { $exa_fis_columna = addslashes($_POST['exa_fis_columna']); } else { $exa_fis_columna = 'NE'; }
if (isset($_POST['exa_fis_columna_obser']) <> '') { $exa_fis_columna_obser = addslashes($_POST['exa_fis_columna_obser']); } else { $exa_fis_columna_obser = ''; }
if (isset($_POST['exa_fis_neurolog']) <> '') { $exa_fis_neurolog = addslashes($_POST['exa_fis_neurolog']); } else { $exa_fis_neurolog = 'NE'; }
if (isset($_POST['exa_fis_neurolog_obser']) <> '') { $exa_fis_neurolog_obser = addslashes($_POST['exa_fis_neurolog_obser']); } else { $exa_fis_neurolog_obser = ''; }
if (isset($_POST['exa_fis_neurolog_romberg']) <> '') { $exa_fis_neurolog_romberg = addslashes($_POST['exa_fis_neurolog_romberg']); } else { $exa_fis_neurolog_romberg = 'NA'; }
if (isset($_POST['exa_fis_neurolog_barany']) <> '') { $exa_fis_neurolog_barany = addslashes($_POST['exa_fis_neurolog_barany']); } else { $exa_fis_neurolog_barany = 'NA'; }
if (isset($_POST['exa_fis_neurolog_dixhalp']) <> '') { $exa_fis_neurolog_dixhalp = addslashes($_POST['exa_fis_neurolog_dixhalp']); } else { $exa_fis_neurolog_dixhalp = 'NA'; }
if (isset($_POST['exa_fis_neurolog_mciega']) <> '') { $exa_fis_neurolog_mciega = addslashes($_POST['exa_fis_neurolog_mciega']); } else { $exa_fis_neurolog_mciega = 'NA'; }
if (isset($_POST['exa_fis_neurolog_pciega']) <> '') { $exa_fis_neurolog_pciega = addslashes($_POST['exa_fis_neurolog_pciega']); } else { $exa_fis_neurolog_pciega = 'NA'; }
if (isset($_POST['exa_fis_estmentaparent']) <> '') { $exa_fis_estmentaparent = addslashes($_POST['exa_fis_estmentaparent']); } else { $exa_fis_estmentaparent = 'NE'; }
if (isset($_POST['exa_fis_estmentaparent_obser']) <> '') { $exa_fis_estmentaparent_obser = addslashes($_POST['exa_fis_estmentaparent_obser']); } else { $exa_fis_estmentaparent_obser = ''; }
if (isset($_POST['exa_fis_pielfanera']) <> '') { $exa_fis_pielfanera = addslashes($_POST['exa_fis_pielfanera']); } else { $exa_fis_pielfanera = 'NE'; }
if (isset($_POST['exa_fis_pielfanera_obser']) <> '') { $exa_fis_pielfanera_obser = addslashes($_POST['exa_fis_pielfanera_obser']); } else { $exa_fis_pielfanera_obser = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['exaosteo_homb_movart']) <> '') { $exaosteo_homb_movart = addslashes($_POST['exaosteo_homb_movart']); } else { $exaosteo_homb_movart = ''; }
if (isset($_POST['exaosteo_homb_fuerza']) <> '') { $exaosteo_homb_fuerza = addslashes($_POST['exaosteo_homb_fuerza']); } else { $exaosteo_homb_fuerza = ''; }
if (isset($_POST['exaosteo_manjobe_sig']) <> '') { $exaosteo_manjobe_sig = addslashes($_POST['exaosteo_manjobe_sig']); } else { $exaosteo_manjobe_sig = ''; }
if (isset($_POST['exaosteo_manjobe_lat']) <> '') { $exaosteo_manjobe_lat = addslashes($_POST['exaosteo_manjobe_lat']); } else { $exaosteo_manjobe_lat = ''; }
if (isset($_POST['exaosteo_manjobe_movart']) <> '') { $exaosteo_manjobe_movart = addslashes($_POST['exaosteo_manjobe_movart']); } else { $exaosteo_manjobe_movart = ''; }
if (isset($_POST['exaosteo_manjobe_fuerza']) <> '') { $exaosteo_manjobe_fuerza = addslashes($_POST['exaosteo_manjobe_fuerza']); } else { $exaosteo_manjobe_fuerza = ''; }
if (isset($_POST['exaosteo_manyega_sig']) <> '') { $exaosteo_manyega_sig = addslashes($_POST['exaosteo_manyega_sig']); } else { $exaosteo_manyega_sig = ''; }
if (isset($_POST['exaosteo_manyega_lat']) <> '') { $exaosteo_manyega_lat = addslashes($_POST['exaosteo_manyega_lat']); } else { $exaosteo_manyega_lat = ''; }
if (isset($_POST['exaosteo_manyega_movart']) <> '') { $exaosteo_manyega_movart = addslashes($_POST['exaosteo_manyega_movart']); } else { $exaosteo_manyega_movart = ''; }
if (isset($_POST['exaosteo_manyega_fuerza']) <> '') { $exaosteo_manyega_fuerza = addslashes($_POST['exaosteo_manyega_fuerza']); } else { $exaosteo_manyega_fuerza = ''; }
if (isset($_POST['exaosteo_manpatte_sig']) <> '') { $exaosteo_manpatte_sig = addslashes($_POST['exaosteo_manpatte_sig']); } else { $exaosteo_manpatte_sig = ''; }
if (isset($_POST['exaosteo_manpatte_lat']) <> '') { $exaosteo_manpatte_lat = addslashes($_POST['exaosteo_manpatte_lat']); } else { $exaosteo_manpatte_lat = ''; }
if (isset($_POST['exaosteo_epicond_sig']) <> '') { $exaosteo_epicond_sig = addslashes($_POST['exaosteo_epicond_sig']); } else { $exaosteo_epicond_sig = ''; }
if (isset($_POST['exaosteo_epicond_lat']) <> '') { $exaosteo_epicond_lat = addslashes($_POST['exaosteo_epicond_lat']); } else { $exaosteo_epicond_lat = ''; }
if (isset($_POST['exaosteo_tinel_sig']) <> '') { $exaosteo_tinel_sig = addslashes($_POST['exaosteo_tinel_sig']); } else { $exaosteo_tinel_sig = ''; }
if (isset($_POST['exaosteo_tinel_lat']) <> '') { $exaosteo_tinel_lat = addslashes($_POST['exaosteo_tinel_lat']); } else { $exaosteo_tinel_lat = ''; }
if (isset($_POST['exaosteo_epitro_sig']) <> '') { $exaosteo_epitro_sig = addslashes($_POST['exaosteo_epitro_sig']); } else { $exaosteo_epitro_sig = ''; }
if (isset($_POST['exaosteo_epitro_lat']) <> '') { $exaosteo_epitro_lat = addslashes($_POST['exaosteo_epitro_lat']); } else { $exaosteo_epitro_lat = ''; }
if (isset($_POST['exaosteo_phalen_sig']) <> '') { $exaosteo_phalen_sig = addslashes($_POST['exaosteo_phalen_sig']); } else { $exaosteo_phalen_sig = ''; }
if (isset($_POST['exaosteo_phalen_lat']) <> '') { $exaosteo_phalen_lat = addslashes($_POST['exaosteo_phalen_lat']); } else { $exaosteo_phalen_lat = ''; }
if (isset($_POST['exaosteo_thomp_sig']) <> '') { $exaosteo_thomp_sig = addslashes($_POST['exaosteo_thomp_sig']); } else { $exaosteo_thomp_sig = ''; }
if (isset($_POST['exaosteo_thomp_lat']) <> '') { $exaosteo_thomp_lat = addslashes($_POST['exaosteo_thomp_lat']); } else { $exaosteo_thomp_lat = ''; }
if (isset($_POST['exaosteo_finkel_sig']) <> '') { $exaosteo_finkel_sig = addslashes($_POST['exaosteo_finkel_sig']); } else { $exaosteo_finkel_sig = ''; }
if (isset($_POST['exaosteo_finkel_lat']) <> '') { $exaosteo_finkel_lat = addslashes($_POST['exaosteo_finkel_lat']); } else { $exaosteo_finkel_lat = ''; }
if (isset($_POST['exaosteo_laseg_sig']) <> '') { $exaosteo_laseg_sig = addslashes($_POST['exaosteo_laseg_sig']); } else { $exaosteo_laseg_sig = ''; }
if (isset($_POST['exaosteo_bostezo_sig']) <> '') { $exaosteo_bostezo_sig = addslashes($_POST['exaosteo_bostezo_sig']); } else { $exaosteo_bostezo_sig = ''; }
if (isset($_POST['exaosteo_bostezo_lat']) <> '') { $exaosteo_bostezo_lat = addslashes($_POST['exaosteo_bostezo_lat']); } else { $exaosteo_bostezo_lat = ''; }
if (isset($_POST['exaosteo_flexion']) <> '') { $exaosteo_flexion = addslashes($_POST['exaosteo_flexion']); } else { $exaosteo_flexion = ''; }
if (isset($_POST['exaosteo_cajon_sig']) <> '') { $exaosteo_cajon_sig = addslashes($_POST['exaosteo_cajon_sig']); } else { $exaosteo_cajon_sig = ''; }
if (isset($_POST['exaosteo_cajon_lat']) <> '') { $exaosteo_cajon_lat = addslashes($_POST['exaosteo_cajon_lat']); } else { $exaosteo_cajon_lat = ''; }
if (isset($_POST['exaosteo_extension']) <> '') { $exaosteo_extension = addslashes($_POST['exaosteo_extension']); } else { $exaosteo_extension = ''; }
if (isset($_POST['exaosteo_mcmurray_sig']) <> '') { $exaosteo_mcmurray_sig = addslashes($_POST['exaosteo_mcmurray_sig']); } else { $exaosteo_mcmurray_sig = ''; }
if (isset($_POST['exaosteo_mcmurray_lat']) <> '') { $exaosteo_mcmurray_lat = addslashes($_POST['exaosteo_mcmurray_lat']); } else { $exaosteo_mcmurray_lat = ''; }
if (isset($_POST['exaosteo_bragard_sig']) <> '') { $exaosteo_bragard_sig = addslashes($_POST['exaosteo_bragard_sig']); } else { $exaosteo_bragard_sig = ''; }
if (isset($_POST['exaosteo_bragard_lat']) <> '') { $exaosteo_bragard_lat = addslashes($_POST['exaosteo_bragard_lat']); } else { $exaosteo_bragard_lat = ''; }
if (isset($_POST['exaosteo_tredelen']) <> '') { $exaosteo_tredelen = addslashes($_POST['exaosteo_tredelen']); } else { $exaosteo_tredelen = ''; }
if (isset($_POST['exaosteo_valmarcha']) <> '') { $exaosteo_valmarcha = addslashes($_POST['exaosteo_valmarcha']); } else { $exaosteo_valmarcha = ''; }
if (isset($_POST['exaosteo_observ']) <> '') { $exaosteo_observ = addslashes($_POST['exaosteo_observ']); } else { $exaosteo_observ = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['paracli_audimet']) <> '') { $paracli_audimet = addslashes($_POST['paracli_audimet']); } else { $paracli_audimet = 'NR'; }
if (isset($_POST['paracli_audimet_observ']) <> '') { $paracli_audimet_observ = addslashes($_POST['paracli_audimet_observ']); } else { $paracli_audimet_observ = 'NR'; }
if (isset($_POST['paracli_visiomet']) <> '') { $paracli_visiomet = addslashes($_POST['paracli_visiomet']); } else { $paracli_visiomet = 'NR'; }
if (isset($_POST['paracli_visiomet_observ']) <> '') { $paracli_visiomet_observ = addslashes($_POST['paracli_visiomet_observ']); } else { $paracli_visiomet_observ = 'NR'; }
if (isset($_POST['paracli_torax']) <> '') { $paracli_torax = addslashes($_POST['paracli_torax']); } else { $paracli_torax = 'NR'; }
if (isset($_POST['paracli_torax_observ']) <> '') { $paracli_torax_observ = addslashes($_POST['paracli_torax_observ']); } else { $paracli_torax_observ = 'NR'; }
if (isset($_POST['paracli_espiro']) <> '') { $paracli_espiro = addslashes($_POST['paracli_espiro']); } else { $paracli_espiro = 'NR'; }
if (isset($_POST['paracli_espiro_observ']) <> '') { $paracli_espiro_observ = addslashes($_POST['paracli_espiro_observ']); } else { $paracli_espiro_observ = 'NR'; }
if (isset($_POST['paracli_ekg']) <> '') { $paracli_ekg = addslashes($_POST['paracli_ekg']); } else { $paracli_ekg = 'NR'; }
if (isset($_POST['paracli_ekg_observ']) <> '') { $paracli_ekg_observ = addslashes($_POST['paracli_ekg_observ']); } else { $paracli_ekg_observ = 'NR'; }
if (isset($_POST['paracli_rxcolum']) <> '') { $paracli_rxcolum = addslashes($_POST['paracli_rxcolum']); } else { $paracli_rxcolum = 'NR'; }
if (isset($_POST['paracli_rxcolum_observ']) <> '') { $paracli_rxcolum_observ = addslashes($_POST['paracli_rxcolum_observ']); } else { $paracli_rxcolum_observ = 'NR'; }
if (isset($_POST['paracli_otrcomplement']) <> '') { $paracli_otrcomplement = addslashes($_POST['paracli_otrcomplement']); } else { $paracli_otrcomplement = 'NR'; }
if (isset($_POST['paracli_otrcomplement_observ']) <> '') { $paracli_otrcomplement_observ = addslashes($_POST['paracli_otrcomplement_observ']); } else { $paracli_otrcomplement_observ = 'NR'; }
if (isset($_POST['paracli_fisiote']) <> '') { $paracli_fisiote = addslashes($_POST['paracli_fisiote']); } else { $paracli_fisiote = 'NR'; }
if (isset($_POST['paracli_fisiote_observ']) <> '') { $paracli_fisiote_observ = addslashes($_POST['paracli_fisiote_observ']); } else { $paracli_fisiote_observ = 'NR'; }
if (isset($_POST['paracli_lab']) <> '') { $paracli_lab = addslashes($_POST['paracli_lab']); } else { $paracli_lab = 'NR'; }
if (isset($_POST['paracli_lab_observ']) <> '') { $paracli_lab_observ = addslashes($_POST['paracli_lab_observ']); } else { $paracli_lab_observ = 'NR'; }
if (isset($_POST['paracli_otro']) <> '') { $paracli_otro = addslashes($_POST['paracli_otro']); } else { $paracli_otro = 'NR'; }
if (isset($_POST['paracli_otro_observ']) <> '') { $paracli_otro_observ = addslashes($_POST['paracli_otro_observ']); } else { $paracli_otro_observ = 'NR'; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['sintoma_covid19_todo']) <> '') { $sintoma_covid19_todo = addslashes($_POST['sintoma_covid19_todo']); } else { $sintoma_covid19_todo = ''; }
if (isset($_POST['sintoma_covid19']) <> '') { $sintoma_covid19 = addslashes($_POST['sintoma_covid19']); } else { $sintoma_covid19 = ''; }
if (isset($_POST['covid19_fiebre']) <> '') { $covid19_fiebre = addslashes($_POST['covid19_fiebre']); } else { $covid19_fiebre = ''; }
if (isset($_POST['covid19_escolofrio']) <> '') { $covid19_escolofrio = addslashes($_POST['covid19_escolofrio']); } else { $covid19_escolofrio = ''; }
if (isset($_POST['covid19_cansansio']) <> '') { $covid19_cansansio = addslashes($_POST['covid19_cansansio']); } else { $covid19_cansansio = ''; }
if (isset($_POST['covid19_malestar_gral']) <> '') { $covid19_malestar_gral = addslashes($_POST['covid19_malestar_gral']); } else { $covid19_malestar_gral = ''; }
if (isset($_POST['covid19_fatiga']) <> '') { $covid19_fatiga = addslashes($_POST['covid19_fatiga']); } else { $covid19_fatiga = ''; }
if (isset($_POST['covid19_tos_seca']) <> '') { $covid19_tos_seca = addslashes($_POST['covid19_tos_seca']); } else { $covid19_tos_seca = ''; }
if (isset($_POST['covid19_cefaleas']) <> '') { $covid19_cefaleas = addslashes($_POST['covid19_cefaleas']); } else { $covid19_cefaleas = ''; }
if (isset($_POST['covid19_congestion_nasal']) <> '') { $covid19_congestion_nasal = addslashes($_POST['covid19_congestion_nasal']); } else { $covid19_congestion_nasal = ''; }
if (isset($_POST['covid19_secrecion_nasal']) <> '') { $covid19_secrecion_nasal = addslashes($_POST['covid19_secrecion_nasal']); } else { $covid19_secrecion_nasal = ''; }
if (isset($_POST['covid19_dorlor_garganta']) <> '') { $covid19_dorlor_garganta = addslashes($_POST['covid19_dorlor_garganta']); } else { $covid19_dorlor_garganta = ''; }
if (isset($_POST['covid19_diarrea']) <> '') { $covid19_diarrea = addslashes($_POST['covid19_diarrea']); } else { $covid19_diarrea = ''; }
if (isset($_POST['covid19_dificul_resp']) <> '') { $covid19_dificul_resp = addslashes($_POST['covid19_dificul_resp']); } else { $covid19_dificul_resp = ''; }
if (isset($_POST['covid19_inapetencia']) <> '') { $covid19_inapetencia = addslashes($_POST['covid19_inapetencia']); } else { $covid19_inapetencia = ''; }
if (isset($_POST['covid19_perdida_olfato']) <> '') { $covid19_perdida_olfato = addslashes($_POST['covid19_perdida_olfato']); } else { $covid19_perdida_olfato = ''; }
if (isset($_POST['covid19_perdida_gusto']) <> '') { $covid19_perdida_gusto = addslashes($_POST['covid19_perdida_gusto']); } else { $covid19_perdida_gusto = ''; }
if (isset($_POST['covid19_dedos_covid']) <> '') { $covid19_dedos_covid = addslashes($_POST['covid19_dedos_covid']); } else { $covid19_dedos_covid = ''; }
if (isset($_POST['covid19_dolor_pecho']) <> '') { $covid19_dolor_pecho = addslashes($_POST['covid19_dolor_pecho']); } else { $covid19_dolor_pecho = ''; }
if (isset($_POST['covid19_confusion']) <> '') { $covid19_confusion = addslashes($_POST['covid19_confusion']); } else { $covid19_confusion = ''; }
if (isset($_POST['covid19_color_azul_labios']) <> '') { $covid19_color_azul_labios = addslashes($_POST['covid19_color_azul_labios']); } else { $covid19_color_azul_labios = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['habit_tox_medicamento']) <> '') { $habit_tox_medicamento = addslashes($_POST['habit_tox_medicamento']); } else { $habit_tox_medicamento = ''; }
if (isset($_POST['habit_tox_horasueno']) <> '') { $habit_tox_horasueno = addslashes($_POST['habit_tox_horasueno']); } else { $habit_tox_horasueno = ''; }

if (isset($_POST['ant_gine_problem_mamario']) <> '') { $ant_gine_problem_mamario = addslashes($_POST['ant_gine_problem_mamario']); } else { $ant_gine_problem_mamario = ''; }
if (isset($_POST['ant_gine_problem_ginecol']) <> '') { $ant_gine_problem_ginecol = addslashes($_POST['ant_gine_problem_ginecol']); } else { $ant_gine_problem_ginecol = ''; }
if (isset($_POST['ant_gine_cree_estar_embarazada']) <> '') { $ant_gine_cree_estar_embarazada = addslashes($_POST['ant_gine_cree_estar_embarazada']); } else { $ant_gine_cree_estar_embarazada = ''; }

if (isset($_POST['ant_pato_enf_hepaticas']) <> '') { $ant_pato_enf_hepaticas = addslashes($_POST['ant_pato_enf_hepaticas']); } else { $ant_pato_enf_hepaticas = 'NO'; }
if (isset($_POST['ant_pato_transplates']) <> '') { $ant_pato_transplates = addslashes($_POST['ant_pato_transplates']); } else { $ant_pato_transplates = ''; }
if (isset($_POST['ant_pato_obesidad_morbida']) <> '') { $ant_pato_obesidad_morbida = addslashes($_POST['ant_pato_obesidad_morbida']); } else { $ant_pato_obesidad_morbida = 'NO'; }
if (isset($_POST['ant_pato_hereditarios']) <> '') { $ant_pato_hereditarios = addslashes($_POST['ant_pato_hereditarios']); } else { $ant_pato_hereditarios = 'NO'; }
if (isset($_POST['ant_pato_enf_infaltil']) <> '') { $ant_pato_enf_infaltil = addslashes($_POST['ant_pato_enf_infaltil']); } else { $ant_pato_enf_infaltil = 'NO'; }
if (isset($_POST['ant_pato_enf_dental']) <> '') { $ant_pato_enf_dental = addslashes($_POST['ant_pato_enf_dental']); } else { $ant_pato_enf_dental = 'NO'; }
if (isset($_POST['ant_pato_enf_corazon']) <> '') { $ant_pato_enf_corazon = addslashes($_POST['ant_pato_enf_corazon']); } else { $ant_pato_enf_corazon = 'NO'; }

if (isset($_POST['ant_pato_enf_renal']) <> '') { $ant_pato_enf_renal = addslashes($_POST['ant_pato_enf_renal']); } else { $ant_pato_enf_renal = 'NO'; }

if (isset($_POST['exa_fis_sto2']) <> '') { $exa_fis_sto2 = addslashes($_POST['exa_fis_sto2']); } else { $exa_fis_sto2 = ''; }

if (isset($_POST['covid19_artralgia']) <> '') { $covid19_artralgia = addslashes($_POST['covid19_artralgia']); } else { $covid19_artralgia = ''; }
if (isset($_POST['covid19_artralgia_valor']) <> '') { $covid19_artralgia_valor = addslashes($_POST['covid19_artralgia_valor']); } else { $covid19_artralgia_valor = ''; }
if (isset($_POST['covid19_mialgia']) <> '') { $covid19_mialgia = addslashes($_POST['covid19_mialgia']); } else { $covid19_mialgia = ''; }
if (isset($_POST['covid19_mialgia_valor']) <> '') { $covid19_mialgia_valor = addslashes($_POST['covid19_mialgia_valor']); } else { $covid19_mialgia_valor = ''; }
if (isset($_POST['covid19_astenia']) <> '') { $covid19_astenia = addslashes($_POST['covid19_astenia']); } else { $covid19_astenia = ''; }
if (isset($_POST['covid19_astenia_valor']) <> '') { $covid19_astenia_valor = addslashes($_POST['covid19_astenia_valor']); } else { $covid19_astenia_valor = ''; }
if (isset($_POST['covid19_odinofagia']) <> '') { $covid19_odinofagia = addslashes($_POST['covid19_odinofagia']); } else { $covid19_odinofagia = ''; }
if (isset($_POST['covid19_odinofagia_valor']) <> '') { $covid19_odinofagia_valor = addslashes($_POST['covid19_odinofagia_valor']); } else { $covid19_odinofagia_valor = ''; }
if (isset($_POST['covid19_irritacion_ardor_ojos']) <> '') { $covid19_irritacion_ardor_ojos = addslashes($_POST['covid19_irritacion_ardor_ojos']); } else { $covid19_irritacion_ardor_ojos = ''; }
if (isset($_POST['covid19_irritacion_ardor_ojos_valor']) <> '') { $covid19_irritacion_ardor_ojos_valor = addslashes($_POST['covid19_irritacion_ardor_ojos_valor']); } else { $covid19_irritacion_ardor_ojos_valor = ''; }
if (isset($_POST['covid19_nauseas']) <> '') { $covid19_nauseas = addslashes($_POST['covid19_nauseas']); } else { $covid19_nauseas = ''; }
if (isset($_POST['covid19_nauseas_valor']) <> '') { $covid19_nauseas_valor = addslashes($_POST['covid19_nauseas_valor']); } else { $covid19_nauseas_valor = ''; }
if (isset($_POST['covid19_contacto_person_sospech_covid']) <> '') { $covid19_contacto_person_sospech_covid = addslashes($_POST['covid19_contacto_person_sospech_covid']); } else { $covid19_contacto_person_sospech_covid = ''; }
if (isset($_POST['covid19_contacto_person_sospech_covid_valor']) <> '') { $covid19_contacto_person_sospech_covid_valor = addslashes($_POST['covid19_contacto_person_sospech_covid_valor']); } else { $covid19_contacto_person_sospech_covid_valor = ''; }
if (isset($_POST['nombre_tiempo_molestia_actual_covid']) <> '') { $nombre_tiempo_molestia_actual_covid = addslashes($_POST['nombre_tiempo_molestia_actual_covid']); } else { $nombre_tiempo_molestia_actual_covid = ''; }
if (isset($_POST['valor_tiempo_molestia_actual_covid']) <> '') { $valor_tiempo_molestia_actual_covid = addslashes($_POST['valor_tiempo_molestia_actual_covid']); } else { $valor_tiempo_molestia_actual_covid = ''; }
if (isset($_POST['nombre_temperatura_covid']) <> '') { $nombre_temperatura_covid = addslashes($_POST['nombre_temperatura_covid']); } else { $nombre_temperatura_covid = ''; }
if (isset($_POST['valor_temperatura_covid']) <> '') { $valor_temperatura_covid = addslashes($_POST['valor_temperatura_covid']); } else { $valor_temperatura_covid = ''; }
if (isset($_POST['nombre_pulso_covid']) <> '') { $nombre_pulso_covid = addslashes($_POST['nombre_pulso_covid']); } else { $nombre_pulso_covid = ''; }
if (isset($_POST['valor_pulso_covid']) <> '') { $valor_pulso_covid = addslashes($_POST['valor_pulso_covid']); } else { $valor_pulso_covid = ''; }
if (isset($_POST['nombre_saturacion_covid']) <> '') { $nombre_tbl15_saturacion_covid= addslashes($_POST['nombre_saturacion_covid']); } else { $nombre_tbl15_saturacion_covid= ''; }
if (isset($_POST['valor_saturacion_covid']) <> '') { $valor_tbl15_saturacion_covid= addslashes($_POST['valor_saturacion_covid']); } else { $valor_tbl15_saturacion_covid= ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['control_examen']) <> '') { $control_examen = addslashes($_POST['control_examen']); } else { $control_examen = ''; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
$fecha_ymd_hora            = addslashes($_POST['fecha_ymd_hora']);
$fecha_time                = strtotime($fecha_ymd_hora);
$fecha_ymd                 = date("Y/m/d", $fecha_time);
$fecha_dmy                 = date("d/m/Y", $fecha_time);
$fecha_mes                 = date("m/Y", $fecha_time);
$fecha_anyo                = date("Y", $fecha_time);
$hora                      = date("H:i", $fecha_time);
$fecha_reg_time            = time();
$cuenta                    = $cuenta_actual;
$cod_estado_facturacion    = 1;
//---------------------------------------------------------------------------------------------------------------------------------------------//
$actualizar_historia_clinica = "UPDATE tbl15_historia_clinica SET motivo = '$motivo', cod_grupo_area = '$cod_grupo_area', cod_grupo_area_cargo = '$cod_grupo_area_cargo', 
nombre_empresa_contratante = '$nombre_empresa_contratante', 
nombre_empresa = '$nombre_empresa', nombre_actividad_ecoemp = '$nombre_actividad_ecoemp', 
cargo_empresa = '$cargo_empresa', area_empresa = '$area_empresa', ciudad_empresa = '$ciudad_empresa', 
dat_ocupa_emp1 = '$dat_ocupa_emp1', dat_ocupa_carg1 = '$dat_ocupa_carg1', dat_ocupa_visu1 = '$dat_ocupa_visu1', dat_ocupa_audi1 = '$dat_ocupa_audi1', 
dat_ocupa_altu1 = '$dat_ocupa_altu1', dat_ocupa_resp1 = '$dat_ocupa_resp1', dat_ocupa_fech_ini1 = '$dat_ocupa_fech_ini1', 
dat_ocupa_dura_anyo1 = '$dat_ocupa_dura_anyo1', dat_ocupa_emp2 = '$dat_ocupa_emp2', dat_ocupa_carg2 = '$dat_ocupa_carg2', 
dat_ocupa_visu2 = '$dat_ocupa_visu2', dat_ocupa_audi2 = '$dat_ocupa_audi2', dat_ocupa_altu2 = '$dat_ocupa_altu2', 
dat_ocupa_resp2 = '$dat_ocupa_resp2', dat_ocupa_fech_ini2 = '$dat_ocupa_fech_ini2', dat_ocupa_dura_anyo2 = '$dat_ocupa_dura_anyo2', 
dat_ocupa_emp3 = '$dat_ocupa_emp3', dat_ocupa_carg3 = '$dat_ocupa_carg3', dat_ocupa_visu3 = '$dat_ocupa_visu3', 
dat_ocupa_audi3 = '$dat_ocupa_audi3', dat_ocupa_altu3 = '$dat_ocupa_altu3', dat_ocupa_resp3 = '$dat_ocupa_resp3', 
dat_ocupa_cabeza1 = '$dat_ocupa_cabeza1', dat_ocupa_manos1 = '$dat_ocupa_manos1', dat_ocupa_tronco1 = '$dat_ocupa_tronco1', dat_ocupa_pies1 = '$dat_ocupa_pies1', 
dat_ocupa_cabeza2 = '$dat_ocupa_cabeza2', dat_ocupa_manos2 = '$dat_ocupa_manos2', dat_ocupa_tronco2 = '$dat_ocupa_tronco2', dat_ocupa_pies2 = '$dat_ocupa_pies2', 
dat_ocupa_cabeza3 = '$dat_ocupa_cabeza3', dat_ocupa_manos3 = '$dat_ocupa_manos3', dat_ocupa_tronco3 = '$dat_ocupa_tronco3', dat_ocupa_pies3 = '$dat_ocupa_pies3', 
dat_ocupa_fech_ini3 = '$dat_ocupa_fech_ini3', dat_ocupa_dura_anyo3 = '$dat_ocupa_dura_anyo3', dat_ocupa_observacion = '$dat_ocupa_observacion', 
clasrieg_carg1 = '$clasrieg_carg1', clasrieg_fis1_ruid = '$clasrieg_fis1_ruid', clasrieg_fis1_ilum = '$clasrieg_fis1_ilum', 
clasrieg_fis1_noionic = '$clasrieg_fis1_noionic', clasrieg_fis1_vibra = '$clasrieg_fis1_vibra', 
clasrieg_fis1_tempextrem = '$clasrieg_fis1_tempextrem', clasrieg_fis1_cambpres = '$clasrieg_fis1_cambpres', 
clasrieg_quim1_gasvapor = '$clasrieg_quim1_gasvapor', clasrieg_quim1_aeroliq = '$clasrieg_quim1_aeroliq', 
clasrieg_quim1_solid = '$clasrieg_quim1_solid', clasrieg_quim1_liquid = '$clasrieg_quim1_liquid', 
clasrieg_biolog1_viru = '$clasrieg_biolog1_viru', clasrieg_biolog1_bacter = '$clasrieg_biolog1_bacter', 
clasrieg_biolog1_parasi = '$clasrieg_biolog1_parasi', clasrieg_biolog1_morde = '$clasrieg_biolog1_morde', 
clasrieg_biolog1_picad = '$clasrieg_biolog1_picad', clasrieg_biolog1_hongo = '$clasrieg_biolog1_hongo', 
clasrieg_ergo1_trabestat = '$clasrieg_ergo1_trabestat', clasrieg_ergo1_esfuerfis = '$clasrieg_ergo1_esfuerfis', 
clasrieg_ergo1_carga = '$clasrieg_ergo1_carga', clasrieg_ergo1_postforz = '$clasrieg_ergo1_postforz', 
clasrieg_ergo1_movrepet = '$clasrieg_ergo1_movrepet', clasrieg_ergo1_jortrab = '$clasrieg_ergo1_jortrab', 
clasrieg_psi1_monoto = '$clasrieg_psi1_monoto', clasrieg_psi1_relhuman = '$clasrieg_psi1_relhuman', 
clasrieg_psi1_contentarea = '$clasrieg_psi1_contentarea', clasrieg_psi1_orgtiemptrab = '$clasrieg_psi1_orgtiemptrab', 
clasrieg_segur1_mecanic = '$clasrieg_segur1_mecanic', clasrieg_segur1_electri = '$clasrieg_segur1_electri', 
clasrieg_segur1_locat = '$clasrieg_segur1_locat', clasrieg_segur1_fisiquim = '$clasrieg_segur1_fisiquim', 
clasrieg_segur1_public = '$clasrieg_segur1_public', clasrieg_segur1_espconfi = '$clasrieg_segur1_espconfi', 
clasrieg_segur1_trabaltura = '$clasrieg_segur1_trabaltura', clasrieg_observ1_otro = '$clasrieg_observ1_otro', 
clasrieg_observ1_coment = '$clasrieg_observ1_coment', clasrieg_carg2 = '$clasrieg_carg2', clasrieg_fis2_ruid = '$clasrieg_fis2_ruid', 
clasrieg_fis2_ilum = '$clasrieg_fis2_ilum', clasrieg_fis2_noionic = '$clasrieg_fis2_noionic', 
clasrieg_fis2_vibra = '$clasrieg_fis2_vibra', clasrieg_fis2_tempextrem = '$clasrieg_fis2_tempextrem', 
clasrieg_fis2_cambpres = '$clasrieg_fis2_cambpres', clasrieg_quim2_gasvapor = '$clasrieg_quim2_gasvapor', 
clasrieg_quim2_aeroliq = '$clasrieg_quim2_aeroliq', clasrieg_quim2_solid = '$clasrieg_quim2_solid', 
clasrieg_quim2_liquid = '$clasrieg_quim2_liquid', clasrieg_biolog2_viru = '$clasrieg_biolog2_viru', 
clasrieg_biolog2_bacter = '$clasrieg_biolog2_bacter', clasrieg_biolog2_parasi = '$clasrieg_biolog2_parasi', 
clasrieg_biolog2_morde = '$clasrieg_biolog2_morde', clasrieg_biolog2_picad = '$clasrieg_biolog2_picad', 
clasrieg_biolog2_hongo = '$clasrieg_biolog2_hongo', clasrieg_ergo2_trabestat = '$clasrieg_ergo2_trabestat', 
clasrieg_ergo2_esfuerfis = '$clasrieg_ergo2_esfuerfis', clasrieg_ergo2_carga = '$clasrieg_ergo2_carga', 
clasrieg_ergo2_postforz = '$clasrieg_ergo2_postforz', clasrieg_ergo2_movrepet = '$clasrieg_ergo2_movrepet', 
clasrieg_ergo2_jortrab = '$clasrieg_ergo2_jortrab', clasrieg_psi2_monoto = '$clasrieg_psi2_monoto', 
clasrieg_psi2_relhuman = '$clasrieg_psi2_relhuman', clasrieg_psi2_contentarea = '$clasrieg_psi2_contentarea', 
clasrieg_psi2_orgtiemptrab = '$clasrieg_psi2_orgtiemptrab', clasrieg_segur2_mecanic = '$clasrieg_segur2_mecanic', 
clasrieg_segur2_electri = '$clasrieg_segur2_electri', clasrieg_segur2_locat = '$clasrieg_segur2_locat', 
clasrieg_segur2_fisiquim = '$clasrieg_segur2_fisiquim', clasrieg_segur2_public = '$clasrieg_segur2_public', 
clasrieg_segur2_espconfi = '$clasrieg_segur2_espconfi', clasrieg_segur2_trabaltura = '$clasrieg_segur2_trabaltura', 
clasrieg_observ2_otro = '$clasrieg_observ2_otro', clasrieg_observ2_coment = '$clasrieg_observ2_coment', 
clasrieg_carg3 = '$clasrieg_carg3', clasrieg_fis3_ruid = '$clasrieg_fis3_ruid', clasrieg_fis3_ilum = '$clasrieg_fis3_ilum', 
clasrieg_fis3_noionic = '$clasrieg_fis3_noionic', clasrieg_fis3_vibra = '$clasrieg_fis3_vibra', 
clasrieg_fis3_tempextrem = '$clasrieg_fis3_tempextrem', clasrieg_fis3_cambpres = '$clasrieg_fis3_cambpres', 
clasrieg_quim3_gasvapor = '$clasrieg_quim3_gasvapor', clasrieg_quim3_aeroliq = '$clasrieg_quim3_aeroliq', 
clasrieg_quim3_solid = '$clasrieg_quim3_solid', clasrieg_quim3_liquid = '$clasrieg_quim3_liquid', 
clasrieg_biolog3_viru = '$clasrieg_biolog3_viru', clasrieg_biolog3_bacter = '$clasrieg_biolog3_bacter', 
clasrieg_biolog3_parasi = '$clasrieg_biolog3_parasi', clasrieg_biolog3_morde = '$clasrieg_biolog3_morde', 
clasrieg_biolog3_picad = '$clasrieg_biolog3_picad', clasrieg_biolog3_hongo = '$clasrieg_biolog3_hongo', 
clasrieg_ergo3_trabestat = '$clasrieg_ergo3_trabestat', clasrieg_ergo3_esfuerfis = '$clasrieg_ergo3_esfuerfis', 
clasrieg_ergo3_carga = '$clasrieg_ergo3_carga', clasrieg_ergo3_postforz = '$clasrieg_ergo3_postforz', 
clasrieg_ergo3_movrepet = '$clasrieg_ergo3_movrepet', clasrieg_ergo3_jortrab = '$clasrieg_ergo3_jortrab', 
clasrieg_psi3_monoto = '$clasrieg_psi3_monoto', clasrieg_psi3_relhuman = '$clasrieg_psi3_relhuman', 
clasrieg_psi3_contentarea = '$clasrieg_psi3_contentarea', clasrieg_psi3_orgtiemptrab = '$clasrieg_psi3_orgtiemptrab', 
clasrieg_segur3_mecanic = '$clasrieg_segur3_mecanic', clasrieg_segur3_electri = '$clasrieg_segur3_electri', 
clasrieg_segur3_locat = '$clasrieg_segur3_locat', clasrieg_segur3_fisiquim = '$clasrieg_segur3_fisiquim', 
clasrieg_segur3_public = '$clasrieg_segur3_public', clasrieg_segur3_espconfi = '$clasrieg_segur3_espconfi', 
clasrieg_segur3_trabaltura = '$clasrieg_segur3_trabaltura', clasrieg_observ3_otro = '$clasrieg_observ3_otro', 
clasrieg_observ3_coment = '$clasrieg_observ3_coment', 
ant_impor_accilab = '$ant_impor_accilab', ant_impor_fecha1 = '$ant_impor_fecha1', ant_impor_empre1 = '$ant_impor_empre1', 
ant_impor_causa1 = '$ant_impor_causa1', ant_impor_tip_lesi1 = '$ant_impor_tip_lesi1', ant_impor_part_afect1 = '$ant_impor_part_afect1', 
ant_impor_dias_incap1 = '$ant_impor_dias_incap1', ant_impor_secuela1 = '$ant_impor_secuela1', ant_impor_fecha2 = '$ant_impor_fecha2', 
ant_impor_empre2 = '$ant_impor_empre2', ant_impor_causa2 = '$ant_impor_causa2', ant_impor_tip_lesi2 = '$ant_impor_tip_lesi2', 
ant_impor_part_afect2 = '$ant_impor_part_afect2', ant_impor_dias_incap2 = '$ant_impor_dias_incap2', ant_impor_secuela2 = '$ant_impor_secuela2',
enf_lab = '$enf_lab', enf_cual = '$enf_cual', enf_hace_cuanto = '$enf_hace_cuanto', enf_descripcion = '$enf_descripcion',
ant_fam_no_presenta = '$ant_fam_no_presenta', ant_fam_hiper_pad = '$ant_fam_hiper_pad', ant_fam_hiper_mad = '$ant_fam_hiper_mad', 
ant_fam_hiper_herm = '$ant_fam_hiper_herm', ant_fam_hiper_otro = '$ant_fam_hiper_otro', 
ant_fam_diabet_pad = '$ant_fam_diabet_pad', ant_fam_diabet_mad = '$ant_fam_diabet_mad', ant_fam_diabet_herm = '$ant_fam_diabet_herm', 
ant_fam_diabet_otro = '$ant_fam_diabet_otro', ant_fam_trombos_pad = '$ant_fam_trombos_pad', 
ant_fam_trombos_mad = '$ant_fam_trombos_mad', ant_fam_trombos_herm = '$ant_fam_trombos_herm', 
ant_fam_trombos_otro = '$ant_fam_trombos_otro', ant_fam_tum_malig_pad = '$ant_fam_tum_malig_pad', 
ant_fam_tum_malig_mad = '$ant_fam_tum_malig_mad', ant_fam_tum_malig_herm = '$ant_fam_tum_malig_herm', 
ant_fam_tum_malig_otro = '$ant_fam_tum_malig_otro', ant_fam_enf_ment_pad = '$ant_fam_enf_ment_pad', 
ant_fam_enf_ment_mad = '$ant_fam_enf_ment_mad', ant_fam_enf_ment_herm = '$ant_fam_enf_ment_herm', 
ant_fam_enf_ment_otro = '$ant_fam_enf_ment_otro', ant_fam_cadio_pad = '$ant_fam_cadio_pad', 
ant_fam_cadio_mad = '$ant_fam_cadio_mad', ant_fam_cadio_herm = '$ant_fam_cadio_herm', 
ant_fam_cadio_otro = '$ant_fam_cadio_otro', ant_fam_trans_convul_pad = '$ant_fam_trans_convul_pad', 
ant_fam_trans_convul_mad = '$ant_fam_trans_convul_mad', ant_fam_trans_convul_herm = '$ant_fam_trans_convul_herm', 
ant_fam_trans_convul_otro = '$ant_fam_trans_convul_otro', ant_fam_enf_gene_pad = '$ant_fam_enf_gene_pad', 
ant_fam_enf_gene_mad = '$ant_fam_enf_gene_mad', ant_fam_enf_gene_herm = '$ant_fam_enf_gene_herm', 
ant_fam_enf_gene_otro = '$ant_fam_enf_gene_otro', ant_fam_alerg_pad = '$ant_fam_alerg_pad', 
ant_fam_alerg_mad = '$ant_fam_alerg_mad', ant_fam_alerg_herm = '$ant_fam_alerg_herm', 
ant_fam_alerg_otro = '$ant_fam_alerg_otro', ant_fam_tuber_pad = '$ant_fam_tuber_pad', 
ant_fam_tuber_mad = '$ant_fam_tuber_mad', ant_fam_tuber_herm = '$ant_fam_tuber_herm', 
ant_fam_tuber_otro = '$ant_fam_tuber_otro', ant_fam_osteomusc_pad = '$ant_fam_osteomusc_pad', 
ant_fam_osteomusc_mad = '$ant_fam_osteomusc_mad', ant_fam_osteomusc_herm = '$ant_fam_osteomusc_herm', 
ant_fam_osteomusc_otro = '$ant_fam_osteomusc_otro', ant_fam_artitri_pad = '$ant_fam_artitri_pad', 
ant_fam_artitri_mad = '$ant_fam_artitri_mad', ant_fam_artitri_herm = '$ant_fam_artitri_herm', 
ant_fam_artitri_otro = '$ant_fam_artitri_otro', ant_fam_varice_pad = '$ant_fam_varice_pad', 
ant_fam_varice_mad = '$ant_fam_varice_mad', ant_fam_varice_herm = '$ant_fam_varice_herm', ant_fam_varice_otro = '$ant_fam_varice_otro', 
ant_fam_otro_pad = '$ant_fam_otro_pad', ant_fam_otro_mad = '$ant_fam_otro_mad', 
ant_fam_otro_herm = '$ant_fam_otro_herm', ant_fam_otro_otro = '$ant_fam_otro_otro', ant_fam_descripcion = '$ant_fam_descripcion',
ant_pato_no_presenta = '$ant_pato_no_presenta', ant_pato_neuro = '$ant_pato_neuro', ant_pato_resp = '$ant_pato_resp', ant_pato_derma = '$ant_pato_derma',
ant_pato_psiq = '$ant_pato_psiq', ant_pato_alerg = '$ant_pato_alerg', ant_pato_osteomusc = '$ant_pato_osteomusc',
ant_pato_gastrointes = '$ant_pato_gastrointes', ant_pato_hematolog = '$ant_pato_hematolog', ant_pato_org_sentid = '$ant_pato_org_sentid',
ant_pato_onco = '$ant_pato_onco', ant_pato_hiperten = '$ant_pato_hiperten', ant_pato_genurinario = '$ant_pato_genurinario',
ant_pato_infesios = '$ant_pato_infesios', ant_pato_congenit = '$ant_pato_congenit', ant_pato_farmacolog = '$ant_pato_farmacolog',
ant_pato_transfus = '$ant_pato_transfus', ant_pato_endocrino = '$ant_pato_endocrino', ant_pato_vascular = '$ant_pato_vascular',
ant_pato_auntoinmun = '$ant_pato_auntoinmun', ant_pato_auntoinmun = '$ant_pato_auntoinmun', ant_pato_auntoinmun = '$ant_pato_auntoinmun',
ant_pato_otro = '$ant_pato_otro', ant_pato_descripcion = '$ant_pato_descripcion', 
ant_altu_no = '$ant_altu_no', ant_altu_epilep = '$ant_altu_epilep', ant_altu_otitmed = '$ant_altu_otitmed', 
ant_altu_enfmanier = '$ant_altu_enfmanier', ant_altu_traumcran = '$ant_altu_traumcran', ant_altu_tumcereb = '$ant_altu_tumcereb', 
ant_altu_malfocereb = '$ant_altu_malfocereb', ant_altu_trombo = '$ant_altu_trombo', ant_altu_hipoac = '$ant_altu_hipoac', 
ant_altu_arritcardi = '$ant_altu_arritcardi', ant_altu_hipogli = '$ant_altu_hipogli', 
ant_altu_fobia = '$ant_altu_fobia', ant_altu_observ = '$ant_altu_observ', 
ant_trau = '$ant_trau', ant_trau_enfer1 = '$ant_trau_enfer1', ant_trau_observ1 = '$ant_trau_observ1', ant_trau_fech_aprox1 = '$ant_trau_fech_aprox1',
ant_trau_enfer2 = '$ant_trau_enfer2', ant_trau_observ2 = '$ant_trau_observ2', ant_trau_fech_aprox2 = '$ant_trau_fech_aprox2', 
ant_trau_enfer3 = '$ant_trau_enfer3', ant_trau_observ3 = '$ant_trau_observ3', ant_trau_fech_aprox3 = '$ant_trau_fech_aprox3',
ant_quirur = '$ant_quirur', ant_quirur_enfer1 = '$ant_quirur_enfer1', ant_quirur_observ1 = '$ant_quirur_observ1',
ant_quirur_fech_aprox1 = '$ant_quirur_fech_aprox1', ant_quirur_enfer2 = '$ant_quirur_enfer2', ant_quirur_observ2 = '$ant_quirur_observ2',
ant_quirur_fech_aprox2 = '$ant_quirur_fech_aprox2', ant_quirur_enfer3 = '$ant_quirur_enfer3', ant_quirur_observ3 = '$ant_quirur_observ3',
ant_quirur_fech_aprox3 = '$ant_quirur_fech_aprox3', costo_motivo_consulta = '$costo_motivo_consulta', cod_factura = '$cod_factura',
ant_inmuni = '$ant_inmuni', ant_inmuni_tetano = '$ant_inmuni_tetano', ant_inmuni_tetano_anyo = '$ant_inmuni_tetano_anyo', 
ant_inmuni_fiebtifo = '$ant_inmuni_fiebtifo', ant_inmuni_fiebtifo_anyo = '$ant_inmuni_fiebtifo_anyo', 
ant_inmuni_hepatita = '$ant_inmuni_hepatita', ant_inmuni_hepatita_anyo = '$ant_inmuni_hepatita_anyo', 
ant_inmuni_influenza = '$ant_inmuni_influenza', ant_inmuni_influenza_anyo = '$ant_inmuni_influenza_anyo', 
ant_inmuni_hepatitb = '$ant_inmuni_hepatitb', ant_inmuni_hepatitb_anyo = '$ant_inmuni_hepatitb_anyo', 
ant_inmuni_saramp = '$ant_inmuni_saramp', ant_inmuni_saramp_anyo = '$ant_inmuni_saramp_anyo', 
ant_inmuni_fiebamarill = '$ant_inmuni_fiebamarill', ant_inmuni_fiebamarill_anyo = '$ant_inmuni_fiebamarill_anyo', 
ant_inmuni_otra = '$ant_inmuni_otra', ant_inmuni_otra_anyo = '$ant_inmuni_otra_anyo', 
ant_inmuni_observacion = '$ant_inmuni_observacion', ant_gine_prim_mestrua = '$ant_gine_prim_mestrua', ant_gine_anyos = '$ant_gine_anyos', 
ant_gine_cliclo = '$ant_gine_cliclo', ant_gine_fum = '$ant_gine_fum', ant_gine_fup = '$ant_gine_fup', ant_gine_fuc = '$ant_gine_fuc', 
ant_gine_fich_gine_g = '$ant_gine_fich_gine_g', ant_gine_fich_gine_p = '$ant_gine_fich_gine_p', 
ant_gine_fich_gine_a = '$ant_gine_fich_gine_a', ant_gine_fich_gine_c = '$ant_gine_fich_gine_c', 
ant_gine_fich_gine_m = '$ant_gine_fich_gine_m', ant_gine_fich_gine_e = '$ant_gine_fich_gine_e', 
ant_gine_fich_gine_v = '$ant_gine_fich_gine_v', ant_gine_fech_ult_exa_mama = '$ant_gine_fech_ult_exa_mama', 
ant_gine_planifica = '$ant_gine_planifica', ant_gine_observacion = '$ant_gine_observacion', 
habit_tox_fum_nofum_exfum = '$habit_tox_fum_nofum_exfum', habit_tox_ciga_aldia = '$habit_tox_ciga_aldia', 
habit_tox_anyos_fum = '$habit_tox_anyos_fum', habit_tox_tiem_sinfum = '$habit_tox_tiem_sinfum', 
habit_tox_consum_alcoh = '$habit_tox_consum_alcoh', habit_tox_activ_extralab = '$habit_tox_activ_extralab', 
habit_tox_activfis = '$habit_tox_activfis', habit_tox_actividad = '$habit_tox_actividad', 
habit_tox_frecuenc = '$habit_tox_frecuenc', habit_tox_tiempo = '$habit_tox_tiempo', 
rev_sist_no = '$rev_sist_no', rev_sist_orgsentido = '$rev_sist_orgsentido', rev_sist_neurolog = '$rev_sist_neurolog', 
rev_sist_resp = '$rev_sist_resp', rev_sist_gastrointes = '$rev_sist_gastrointes', rev_sist_geniuri = '$rev_sist_geniuri', 
rev_sist_osteomus = '$rev_sist_osteomus', rev_sist_dermato = '$rev_sist_dermato', rev_sist_cardiovas = '$rev_sist_cardiovas', 
rev_sist_constitu = '$rev_sist_constitu', rev_sist_metabolendocri = '$rev_sist_metabolendocri', 
rev_sist_observ_orgsentido = '$rev_sist_observ_orgsentido', rev_sist_observ_neurolog = '$rev_sist_observ_neurolog', 
rev_sist_observ_resp = '$rev_sist_observ_resp', rev_sist_observ_gastrointes = '$rev_sist_observ_gastrointes', 
rev_sist_observ_geniuri = '$rev_sist_observ_geniuri', rev_sist_observ_osteomus = '$rev_sist_observ_osteomus', 
rev_sist_observ_dermato = '$rev_sist_observ_dermato', rev_sist_observ_cardiovas = '$rev_sist_observ_cardiovas', 
rev_sist_observ_constitu = '$rev_sist_observ_constitu', rev_sist_observ_metabolendocri = '$rev_sist_observ_metabolendocri', 
eval_estment_norm_orient = '$eval_estment_norm_orient', eval_estment_disf_orient = '$eval_estment_disf_orient', 
eval_estment_halla_orient = '$eval_estment_halla_orient', eval_estment_norm_atenconcent = '$eval_estment_norm_atenconcent', 
eval_estment_disf_atenconcent = '$eval_estment_disf_atenconcent', eval_estment_halla_atenconcent = '$eval_estment_halla_atenconcent', 
eval_estment_norm_sensoper = '$eval_estment_norm_sensoper', eval_estment_disf_sensoper = '$eval_estment_disf_sensoper', 
eval_estment_halla_sensoper = '$eval_estment_halla_sensoper', eval_estment_norm_memor = '$eval_estment_norm_memor', 
eval_estment_disf_memor = '$eval_estment_disf_memor', eval_estment_halla_memor = '$eval_estment_halla_memor', 
eval_estment_norm_pensami = '$eval_estment_norm_pensami', eval_estment_disf_pensami = '$eval_estment_disf_pensami', 
eval_estment_halla_pensami = '$eval_estment_halla_pensami', eval_estment_norm_lenguaj = '$eval_estment_norm_lenguaj', 
eval_estment_disf_lenguaj = '$eval_estment_disf_lenguaj', eval_estment_halla_lenguaj = '$eval_estment_halla_lenguaj', 
eval_estment_concept = '$eval_estment_concept',
exa_fis_peso = '$exa_fis_peso', exa_fis_talla = '$exa_fis_talla', exa_fis_imc = '$exa_fis_imc', 
exa_fis_interpreimc = '$exa_fis_interpreimc', exa_fis_fresp = '$exa_fis_fresp', exa_fis_fc = '$exa_fis_fc', 
exa_fis_ta = '$exa_fis_ta', exa_fis_lateral = '$exa_fis_lateral', exa_fis_periabdom = '$exa_fis_periabdom', 
exa_fis_temperat = '$exa_fis_temperat', exa_fis_concepto = '$exa_fis_concepto', 
exa_fis_ojoder_sncorre_vlejan = '$exa_fis_ojoder_sncorre_vlejan', 
exa_fis_ojoder_sncorre_vcerca = '$exa_fis_ojoder_sncorre_vcerca', exa_fis_ojoder_cncorre_vlejan = '$exa_fis_ojoder_cncorre_vlejan', 
exa_fis_ojoder_cncorre_vcerca = '$exa_fis_ojoder_cncorre_vcerca', exa_fis_ojoizq_sncorre_vlejan = '$exa_fis_ojoizq_sncorre_vlejan', 
exa_fis_ojoizq_sncorre_vcerca = '$exa_fis_ojoizq_sncorre_vcerca', exa_fis_ojoizq_cncorre_vlejan = '$exa_fis_ojoizq_cncorre_vlejan', 
exa_fis_ojoizq_cncorre_vcerca = '$exa_fis_ojoizq_cncorre_vcerca', exa_fis_ojoamb_sncorre_vlejan = '$exa_fis_ojoamb_sncorre_vlejan', 
exa_fis_ojoamb_sncorre_vcerca = '$exa_fis_ojoamb_sncorre_vcerca', exa_fis_oojoamb_cncorre_vlejan = '$exa_fis_oojoamb_cncorre_vlejan', 
exa_fis_ojoamb_cncorre_vcerca = '$exa_fis_ojoamb_cncorre_vcerca', exa_fis_oido = '$exa_fis_oido', 
exa_fis_ojo = '$exa_fis_ojo', exa_fis_cabeza = '$exa_fis_cabeza', exa_fis_nariz = '$exa_fis_nariz', exa_fis_orofaring = '$exa_fis_orofaring', 
exa_fis_cuello = '$exa_fis_cuello', exa_fis_torax = '$exa_fis_torax', exa_fis_glandumama = '$exa_fis_glandumama', 
exa_fis_cardiopulm = '$exa_fis_cardiopulm', exa_fis_abdomen = '$exa_fis_abdomen', exa_fis_genital = '$exa_fis_genital', 
exa_fis_miemsup = '$exa_fis_miemsup', exa_fis_mieminf = '$exa_fis_mieminf', exa_fis_columna = '$exa_fis_columna', 
exa_fis_neurolog = '$exa_fis_neurolog', exa_fis_neurolog_romberg = '$exa_fis_neurolog_romberg',
exa_fis_neurolog_barany = '$exa_fis_neurolog_barany', exa_fis_neurolog_dixhalp = '$exa_fis_neurolog_dixhalp',
exa_fis_neurolog_mciega = '$exa_fis_neurolog_mciega', exa_fis_neurolog_pciega = '$exa_fis_neurolog_pciega',
exa_fis_estmentaparent = '$exa_fis_estmentaparent', exa_fis_pielfanera = '$exa_fis_pielfanera', 
exa_fis_ojo_obser = '$exa_fis_ojo_obser', exa_fis_oido_obser = '$exa_fis_oido_obser', exa_fis_cabeza_obser = '$exa_fis_cabeza_obser',
exa_fis_nariz_obser = '$exa_fis_nariz_obser', exa_fis_orofaring_obser = '$exa_fis_orofaring_obser', exa_fis_cuello_obser = '$exa_fis_cuello_obser',
exa_fis_cuello_obser = '$exa_fis_cuello_obser', exa_fis_cuello_obser = '$exa_fis_cuello_obser', exa_fis_torax_obser = '$exa_fis_torax_obser',
exa_fis_glandumama_obser = '$exa_fis_glandumama_obser', exa_fis_cardiopulm_obser = '$exa_fis_cardiopulm_obser', exa_fis_abdomen_obser = '$exa_fis_abdomen_obser',
exa_fis_genital_obser = '$exa_fis_genital_obser', exa_fis_miemsup_obser = '$exa_fis_miemsup_obser', exa_fis_mieminf_obser = '$exa_fis_mieminf_obser', 
exa_fis_columna_obser = '$exa_fis_columna_obser', exa_fis_neurolog_obser = '$exa_fis_neurolog_obser', 
exa_fis_estmentaparent_obser = '$exa_fis_estmentaparent_obser', exa_fis_pielfanera_obser = '$exa_fis_pielfanera_obser', 
exaosteo_homb_movart = '$exaosteo_homb_movart', exaosteo_homb_fuerza = '$exaosteo_homb_fuerza', 
exaosteo_manjobe_sig = '$exaosteo_manjobe_sig', exaosteo_manjobe_lat = '$exaosteo_manjobe_lat', 
exaosteo_manjobe_movart = '$exaosteo_manjobe_movart', exaosteo_manjobe_fuerza = '$exaosteo_manjobe_fuerza', 
exaosteo_manyega_sig = '$exaosteo_manyega_sig', exaosteo_manyega_lat = '$exaosteo_manyega_lat', 
exaosteo_manyega_movart = '$exaosteo_manyega_movart', exaosteo_manyega_fuerza = '$exaosteo_manyega_fuerza', 
exaosteo_manpatte_sig = '$exaosteo_manpatte_sig', exaosteo_manpatte_lat = '$exaosteo_manpatte_lat', 
exaosteo_epicond_sig = '$exaosteo_epicond_sig', exaosteo_epicond_lat = '$exaosteo_epicond_lat', 
exaosteo_tinel_sig = '$exaosteo_tinel_sig', exaosteo_tinel_lat = '$exaosteo_tinel_lat', 
exaosteo_epitro_sig = '$exaosteo_epitro_sig', exaosteo_epitro_lat = '$exaosteo_epitro_lat', 
exaosteo_phalen_sig = '$exaosteo_phalen_sig', exaosteo_phalen_lat = '$exaosteo_phalen_lat', 
exaosteo_thomp_sig = '$exaosteo_thomp_sig', exaosteo_thomp_lat = '$exaosteo_thomp_lat', 
exaosteo_finkel_sig = '$exaosteo_finkel_sig', exaosteo_finkel_lat = '$exaosteo_finkel_lat', 
exaosteo_laseg_sig = '$exaosteo_laseg_sig', exaosteo_bostezo_sig = '$exaosteo_bostezo_sig', 
exaosteo_bostezo_lat = '$exaosteo_bostezo_lat', exaosteo_flexion = '$exaosteo_flexion', 
exaosteo_cajon_sig = '$exaosteo_cajon_sig', exaosteo_cajon_lat = '$exaosteo_cajon_lat', 
exaosteo_extension = '$exaosteo_extension', exaosteo_mcmurray_sig = '$exaosteo_mcmurray_sig', 
exaosteo_mcmurray_lat = '$exaosteo_mcmurray_lat', exaosteo_bragard_sig = '$exaosteo_bragard_sig', 
exaosteo_bragard_lat = '$exaosteo_bragard_lat', exaosteo_tredelen = '$exaosteo_tredelen', 
exaosteo_valmarcha = '$exaosteo_valmarcha', exaosteo_observ = '$exaosteo_observ', 
paracli_audimet = '$paracli_audimet', paracli_audimet_observ = '$paracli_audimet_observ', 
paracli_visiomet = '$paracli_visiomet', paracli_visiomet_observ = '$paracli_visiomet_observ', 
paracli_torax = '$paracli_torax', paracli_torax_observ = '$paracli_torax_observ', 
paracli_espiro = '$paracli_espiro', paracli_espiro_observ = '$paracli_espiro_observ', 
paracli_ekg = '$paracli_ekg', paracli_ekg_observ = '$paracli_ekg_observ', 
paracli_rxcolum = '$paracli_rxcolum', paracli_rxcolum_observ = '$paracli_rxcolum_observ', 
paracli_otrcomplement = '$paracli_otrcomplement', paracli_otrcomplement_observ = '$paracli_otrcomplement_observ', 
paracli_fisiote = '$paracli_fisiote', paracli_fisiote_observ = '$paracli_fisiote_observ', 
paracli_lab = '$paracli_lab', paracli_lab_observ = '$paracli_lab_observ', 
paracli_otro = '$paracli_otro', paracli_otro_observ = '$paracli_otro_observ', 
control_examen = '$control_examen', 
ant_fam_hiper_otro_cual = '$ant_fam_hiper_otro_cual', 
ant_fam_diabet_otro_cual = '$ant_fam_diabet_otro_cual',
ant_fam_trombos_otro_cual = '$ant_fam_trombos_otro_cual',
ant_fam_tum_malig_otro_cual = '$ant_fam_tum_malig_otro_cual',
ant_fam_enf_ment_otro_cual = '$ant_fam_enf_ment_otro_cual',
ant_fam_cadio_otro_cual = '$ant_fam_cadio_otro_cual',
ant_fam_trans_convul_otro_cual = '$ant_fam_trans_convul_otro_cual',
ant_fam_enf_gene_otro_cual = '$ant_fam_enf_gene_otro_cual', 
ant_fam_alerg_otro_cual = '$ant_fam_alerg_otro_cual',
ant_fam_tuber_otro_cual = '$ant_fam_tuber_otro_cual',
ant_fam_osteomusc_otro_cual = '$ant_fam_osteomusc_otro_cual',
ant_fam_artitri_otro_cual = '$ant_fam_artitri_otro_cual',
ant_fam_varice_otro_cual = '$ant_fam_varice_otro_cual',
ant_fam_otro_otro_cual = '$ant_fam_otro_otro_cual',
cod_estado_facturacion = '$cod_estado_facturacion', fecha_dmy = '$fecha_dmy', 
fecha_ymd = '$fecha_ymd', fecha_time = '$fecha_time', fecha_mes = '$fecha_mes', fecha_anyo = '$fecha_anyo', fecha_reg_time = '$fecha_reg_time',
nombre_estado_civil = '$nombre_estado_civil', nombre_numero_hijos = '$nombre_numero_hijos', 
tel_cliente = '$tel_cliente', nombre_escolaridad = '$nombre_escolaridad', 
cod_entidad = '$cod_entidad', nombre_tipo_regimen = '$nombre_tipo_regimen', 
nombre_fondo_pension = '$nombre_fondo_pension', nombre_arl = '$nombre_arl', 
nombre_contacto1 = '$nombre_contacto1', parentesco_contacto1 = '$parentesco_contacto1', 
direccion_contacto1 = '$direccion_contacto1', tel_contacto1 = '$tel_contacto1', 
ant_fam_asma_pad = '$ant_fam_asma_pad', ant_fam_asma_mad = '$ant_fam_asma_mad', ant_fam_asma_herm = '$ant_fam_asma_herm', 
ant_fam_asma_otro = '$ant_fam_asma_otro', ant_fam_asma_otro_cual = '$ant_fam_asma_otro_cual', 
ant_pato_convulsion = '$ant_pato_convulsion', ant_pato_claustrofobia = '$ant_pato_claustrofobia', ant_pato_dificuloler = '$ant_pato_dificuloler', 
ant_pato_cardiopatia = '$ant_pato_cardiopatia', ant_pato_lentes = '$ant_pato_lentes', ant_pato_dificuldistincolor = '$ant_pato_dificuldistincolor', 
habit_tox_toxicomania = '$habit_tox_toxicomania', 
exa_fis_sistemmusculesquelet = '$exa_fis_sistemmusculesquelet', exa_fis_sistemmusculesquelet_observ = '$exa_fis_sistemmusculesquelet_observ', 
sintoma_covid19_todo = '$sintoma_covid19_todo', 
sintoma_covid19 = '$sintoma_covid19', 
covid19_fiebre = '$covid19_fiebre', 
covid19_escolofrio = '$covid19_escolofrio', 
covid19_cansansio = '$covid19_cansansio', 
covid19_malestar_gral = '$covid19_malestar_gral', 
covid19_fatiga = '$covid19_fatiga', 
covid19_tos_seca = '$covid19_tos_seca', 
covid19_cefaleas = '$covid19_cefaleas', 
covid19_congestion_nasal = '$covid19_congestion_nasal', 
covid19_secrecion_nasal = '$covid19_secrecion_nasal', 
covid19_dorlor_garganta = '$covid19_dorlor_garganta', 
covid19_diarrea = '$covid19_diarrea', 
covid19_dificul_resp = '$covid19_dificul_resp', 
covid19_inapetencia = '$covid19_inapetencia', 
covid19_perdida_olfato = '$covid19_perdida_olfato', 
covid19_perdida_gusto = '$covid19_perdida_gusto', 
covid19_dedos_covid = '$covid19_dedos_covid', 
covid19_dolor_pecho = '$covid19_dolor_pecho', 
covid19_confusion = '$covid19_confusion', 
covid19_color_azul_labios = '$covid19_color_azul_labios', 
habit_tox_medicamento = '$habit_tox_medicamento', 
habit_tox_horasueno = '$habit_tox_horasueno', 
ant_gine_problem_mamario = '$ant_gine_problem_mamario', 
ant_gine_problem_ginecol = '$ant_gine_problem_ginecol', 
ant_gine_cree_estar_embarazada = '$ant_gine_cree_estar_embarazada', 
ant_pato_enf_hepaticas = '$ant_pato_enf_hepaticas', 
ant_pato_transplates = '$ant_pato_transplates', 
ant_pato_obesidad_morbida = '$ant_pato_obesidad_morbida', 
ant_pato_hereditarios = '$ant_pato_hereditarios', 
ant_pato_enf_infaltil = '$ant_pato_enf_infaltil', 
ant_pato_enf_dental = '$ant_pato_enf_dental', 
ant_pato_enf_corazon = '$ant_pato_enf_corazon', 
ant_pato_enf_renal = '$ant_pato_enf_renal', 
exa_fis_sto2 = '$exa_fis_sto2', 
covid19_artralgia = '$covid19_artralgia', 
covid19_artralgia_valor = '$covid19_artralgia_valor', 
covid19_mialgia = '$covid19_mialgia', 
covid19_mialgia_valor = '$covid19_mialgia_valor', 
covid19_astenia = '$covid19_astenia', 
covid19_astenia_valor = '$covid19_astenia_valor', 
covid19_odinofagia = '$covid19_odinofagia', 
covid19_odinofagia_valor = '$covid19_odinofagia_valor', 
covid19_irritacion_ardor_ojos = '$covid19_irritacion_ardor_ojos', 
covid19_irritacion_ardor_ojos_valor = '$covid19_irritacion_ardor_ojos_valor', 
covid19_nauseas = '$covid19_nauseas', 
covid19_nauseas_valor = '$covid19_nauseas_valor', 
covid19_contacto_person_sospech_covid = '$covid19_contacto_person_sospech_covid', 
covid19_contacto_person_sospech_covid_valor = '$covid19_contacto_person_sospech_covid_valor', 
nombre_tiempo_molestia_actual_covid = '$nombre_tiempo_molestia_actual_covid', 
valor_tiempo_molestia_actual_covid = '$valor_tiempo_molestia_actual_covid', 
nombre_temperatura_covid = '$nombre_temperatura_covid', 
valor_temperatura_covid = '$valor_temperatura_covid', 
nombre_pulso_covid = '$nombre_pulso_covid', 
valor_pulso_covid = '$valor_pulso_covid', 
nombre_tbl15_saturacion_covid= '$nombre_saturacion_covid', 
valor_tbl15_saturacion_covid= '$valor_saturacion_covid' 
WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_historia_clinica = mysqli_query($conectar, $actualizar_historia_clinica) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------------------//
$actualizar_info_paciente= "UPDATE tbl15_cliente SET nombre_tipo_doc = '$nombre_tipo_doc', cedula = '$cedula', nombres = '$nombres', 
apellido1 = '$apellido1', nombre_sexo = '$nombre_sexo', fecha_nac_ymd = '$fecha_nac_ymd', lugar_nac = '$lugar_nac', fecha_nac_time = '$fecha_nac_time', 
lugar_procedencia = '$lugar_procedencia' WHERE cod_cliente = '$cod_cliente'";
$resultado_info_paciente = mysqli_query($conectar, $actualizar_info_paciente) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------------------//
$actualizar_info_aptlab= "UPDATE tbl15_actitud_laboral SET motivo_actilab = '$motivo' WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_info_aptlab = mysqli_query($conectar, $actualizar_info_aptlab) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------------------//
$actualizar_info_trabaltura= "UPDATE tbl15_trabajo_altura SET motivo_trabajo_altura = '$motivo', explo_fis_fc = '$exa_fis_fc', 
explo_fis_fr = '$exa_fis_fresp', explo_fis_ta = '$exa_fis_ta', explo_fis_peso = '$exa_fis_peso', 
explo_fis_talla = '$exa_fis_talla', explo_fis_imc = '$exa_fis_imc', explo_fis_pericintura = '$exa_fis_periabdom', 
ant_gine_menarquia = '$ant_gine_prim_mestrua', ant_gine_fmu = '$ant_gine_fum', ant_gine_g = '$ant_gine_fich_gine_g', 
ant_gine_p = '$ant_gine_fich_gine_p', ant_gine_a = '$ant_gine_fich_gine_a', ant_gine_c = '$ant_gine_fich_gine_c', 
explo_fis_testromberg = '$exa_fis_neurolog_romberg', explo_fis_priebmarcha = '$exa_fis_neurolog_mciega', 
explo_fis_dixhalp = '$exa_fis_neurolog_dixhalp' WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_info_trabaltura = mysqli_query($conectar, $actualizar_info_trabaltura) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------------------//
?>
<h3>Se ha guardado correctamente la historia clinica</h3>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/escoger_opcion_cie10_o_actitudlaboral.php?cod_historia_clinica=<?php echo $cod_historia_clinica ?>&cod_cliente=<?php echo $cod_cliente ?>&pagina=<?php echo $pagina_else ?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_else?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>