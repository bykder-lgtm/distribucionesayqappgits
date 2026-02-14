<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
<link rel="stylesheet" href="../estilo_css/bootstrap-select.min.css">
<link rel="stylesheet" href="../estilo_css/estilo_multiselect_chosen.css">
<link rel="stylesheet" href="../estilo_css/prism.css">
<link rel="stylesheet" href="../estilo_css/chosen.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
<script src="../js/jquery-3.2.1.min.js" type="text/javascript"></script>

<!--
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
myajax.Link('guardar_cie10_ajax.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
-->
</head>


<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Crear Historia Clinica</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$fecha_hoy                          = date("Y/m/d");
$fecha_hoy_time                     = strtotime(date("Y/m/d"));
$cod_historia_clinica               = intval($_GET['cod_historia_clinica']);
$cod_cliente                        = intval($_GET['cod_cliente']);
$required                           = '';
$pagina_actual                      = $_SERVER['PHP_SELF'];

if ($cod_seguridad == 1) { $required = 'required'; } elseif ($cod_seguridad == 2) { $required = ''; } elseif ($cod_seguridad == 3) { $required = ''; } else { $required = '';  }
if (isset($_GET['foco'])) { $foco = addslashes($_GET['foco']); } else { $foco = ''; }

$sql_historia_clinica = "SELECT tbl15_cliente.cod_cliente, tbl15_cliente.cedula, tbl15_cliente.nombres, tbl15_cliente.fecha_nac_ymd, 
tbl15_cliente.fecha_nac_time, tbl15_cliente.senas_particulares, tbl15_cliente.nombre_procedencia, tbl15_cliente.nombre_sexo, 
tbl15_cliente.nombre_especie, tbl15_cliente.nombre_raza, tbl15_cliente.nombre_estrato, tbl15_cliente.nombre_color, 
tbl15_cliente.edad_anyo, tbl15_cliente.edad_mes, tbl15_cliente.nombre_contacto1, 
tbl15_cliente.identificacion_contacto1, tbl15_cliente.estrato_contacto1, tbl15_cliente.municipio_contacto1, 
tbl15_cliente.ocupacion_contacto1, tbl15_cliente.tel_contacto1, tbl15_cliente.parentesco_contacto1, tbl15_cliente.direccion_contacto1, 
tbl15_cliente.url_img_foto_min AS url_img_foto_min_cli, tbl15_cliente.url_img_foto AS url_img_foto_cli, 
tbl15_cliente.tel_cliente AS tel_cliente_cli, tbl15_cliente.correo_contacto1, 
tbl15_historia_clinica.cod_administrador, 
tbl15_historia_clinica.cod_grupo_area, tbl15_historia_clinica.cod_grupo_area_cargo, tbl15_historia_clinica.motivo, 
tbl15_historia_clinica.motivo2, tbl15_historia_clinica.motivo_consulta, tbl15_historia_clinica.anamnesicos, 
tbl15_historia_clinica.vacum_can, tbl15_historia_clinica.vacum_can_pvc, tbl15_historia_clinica.vacum_can_pvc_fecha, 
tbl15_historia_clinica.vacum_can_triple, tbl15_historia_clinica.vacum_can_triple_fecha, tbl15_historia_clinica.vacum_can_rabia, 
tbl15_historia_clinica.vacum_can_rabia_fecha, tbl15_historia_clinica.vacum_can_otra, tbl15_historia_clinica.vacum_can_otra_fecha, 
tbl15_historia_clinica.vacum_can_otra_cual, tbl15_historia_clinica.vacum_fel, tbl15_historia_clinica.vacum_fel_pvc, 
tbl15_historia_clinica.vacum_fel_pvc_fecha, tbl15_historia_clinica.vacum_fel_triple, tbl15_historia_clinica.vacum_fel_triple_fecha, 
tbl15_historia_clinica.vacum_fel_rabia, tbl15_historia_clinica.vacum_fel_rabia_fecha, tbl15_historia_clinica.vacum_fel_otra, 
tbl15_historia_clinica.vacum_fel_otra_fecha, tbl15_historia_clinica.vacum_fel_otra_cual, tbl15_historia_clinica.ult_desparacit, 
tbl15_historia_clinica.ult_desparacit_producto, tbl15_historia_clinica.ult_desparacit_fecha, tbl15_historia_clinica.nombre_alimentacion, 
tbl15_historia_clinica.nombre_alimentacion_otra, tbl15_historia_clinica.nombre_estado_reproductivo, tbl15_historia_clinica.nombre_alergias, 
tbl15_historia_clinica.nombre_enf_ant, tbl15_historia_clinica.nombre_cirugias, tbl15_historia_clinica.ant_fam, 
tbl15_historia_clinica.nombre_habitat, tbl15_historia_clinica.nombre_actitud, tbl15_historia_clinica.nombre_condicion_corporal, 
tbl15_historia_clinica.nombre_estado_hidratacion, tbl15_historia_clinica.mucosas, tbl15_historia_clinica.mucosas_observ, 
tbl15_historia_clinica.conjuntival, tbl15_historia_clinica.conjuntival_observ, tbl15_historia_clinica.oral, 
tbl15_historia_clinica.oral_observ, tbl15_historia_clinica.vulvar_prepucial, tbl15_historia_clinica.vulvar_prepucial_observ, 
tbl15_historia_clinica.rectal, tbl15_historia_clinica.rectal_observ, tbl15_historia_clinica.ojos, 
tbl15_historia_clinica.ojos_observ, tbl15_historia_clinica.oidos, tbl15_historia_clinica.oidos_observ, 
tbl15_historia_clinica.nodulos_linfa, tbl15_historia_clinica.nodulos_linfa_observ, tbl15_historia_clinica.piel_anexos, 
tbl15_historia_clinica.piel_anexos_observ, tbl15_historia_clinica.locomocion, tbl15_historia_clinica.locomocion_observ, 
tbl15_historia_clinica.aparato_musculoesquelet, tbl15_historia_clinica.aparato_musculoesquelet_observ, 
tbl15_historia_clinica.sistem_nervioso, tbl15_historia_clinica.sistem_nervioso_observ, tbl15_historia_clinica.aparato_cardiovascu, 
tbl15_historia_clinica.aparato_cardiovascu_observ, tbl15_historia_clinica.aparato_respirat, tbl15_historia_clinica.aparato_respirat_observ, 
tbl15_historia_clinica.aparato_digestivo, tbl15_historia_clinica.aparato_digestivo_observ, tbl15_historia_clinica.aparato_genitourinario, 
tbl15_historia_clinica.aparato_genitourinario_observ, 
tbl15_historia_clinica.plan_diag, tbl15_historia_clinica.plan_diag_autorizado, 
tbl15_historia_clinica.plan_diag_cuadhemat, 
tbl15_historia_clinica.plan_diag_cuadhemat_autorizado, tbl15_historia_clinica.plan_diag_cuadhemat_fecha, 
tbl15_historia_clinica.plan_diag_cuadhemat_lab, tbl15_historia_clinica.plan_diag_cuadhemat_resul, 
tbl15_historia_clinica.plan_diag_parcialorina, tbl15_historia_clinica.plan_diag_parcialorina_autorizado, 
tbl15_historia_clinica.plan_diag_parcialorina_fecha, tbl15_historia_clinica.plan_diag_parcialorina_lab, 
tbl15_historia_clinica.plan_diag_parcialorina_resul, 
tbl15_historia_clinica.plan_diag_coprologico, tbl15_historia_clinica.plan_diag_coprologico_autorizado, 
tbl15_historia_clinica.plan_diag_coprologico_fecha, tbl15_historia_clinica.plan_diag_coprologico_lab, 
tbl15_historia_clinica.plan_diag_coprologico_resul, 
tbl15_historia_clinica.plan_diag_citologfecal, 
tbl15_historia_clinica.plan_diag_citologfecal_autorizado, tbl15_historia_clinica.plan_diag_citologfecal_fecha, 
tbl15_historia_clinica.plan_diag_citologfecal_lab, tbl15_historia_clinica.plan_diag_citologfecal_resul, 
tbl15_historia_clinica.plan_diag_citolog, tbl15_historia_clinica.plan_diag_citolog_autorizado, 
tbl15_historia_clinica.plan_diag_citolog_fecha, tbl15_historia_clinica.plan_diag_citolog_lab, 
tbl15_historia_clinica.plan_diag_citolog_resul, tbl15_historia_clinica.plan_diag_quimicsang1, 
tbl15_historia_clinica.plan_diag_quimicsang1_autorizado, tbl15_historia_clinica.plan_diag_quimicsang1_fecha, 
tbl15_historia_clinica.plan_diag_quimicsang1_lab, tbl15_historia_clinica.plan_diag_quimicsang1_resul, 
tbl15_historia_clinica.plan_diag_quimicsang2, tbl15_historia_clinica.plan_diag_quimicsang2_autorizado, 
tbl15_historia_clinica.plan_diag_quimicsang2_fecha, tbl15_historia_clinica.plan_diag_quimicsang2_lab, 
tbl15_historia_clinica.plan_diag_quimicsang2_resul, tbl15_historia_clinica.plan_diag_quimicsang3, 
tbl15_historia_clinica.plan_diag_quimicsang3_autorizado, tbl15_historia_clinica.plan_diag_quimicsang3_fecha, 
tbl15_historia_clinica.plan_diag_quimicsang3_lab, tbl15_historia_clinica.plan_diag_quimicsang3_resul, 
tbl15_historia_clinica.plan_diag_quimicsang4, tbl15_historia_clinica.plan_diag_quimicsang4_autorizado, 
tbl15_historia_clinica.plan_diag_quimicsang4_fecha, tbl15_historia_clinica.plan_diag_quimicsang4_lab, 
tbl15_historia_clinica.plan_diag_quimicsang4_resul, tbl15_historia_clinica.plan_diag_rayx, 
tbl15_historia_clinica.plan_diag_rayx_autorizado, tbl15_historia_clinica.plan_diag_rayx_fecha, 
tbl15_historia_clinica.plan_diag_rayx_lab, tbl15_historia_clinica.plan_diag_rayx_resul, 
tbl15_historia_clinica.plan_diag_usg, tbl15_historia_clinica.plan_diag_usg_autorizado, 
tbl15_historia_clinica.plan_diag_usg_fecha, tbl15_historia_clinica.plan_diag_usg_lab, 
tbl15_historia_clinica.plan_diag_usg_resul, tbl15_historia_clinica.plan_diag_cultivo, 
tbl15_historia_clinica.plan_diag_cultivo_autorizado, tbl15_historia_clinica.plan_diag_cultivo_fecha, 
tbl15_historia_clinica.plan_diag_cultivo_lab, tbl15_historia_clinica.plan_diag_cultivo_resul, 
tbl15_historia_clinica.plan_diag_antibiograma, tbl15_historia_clinica.plan_diag_antibiograma_autorizado, 
tbl15_historia_clinica.plan_diag_antibiograma_fecha, tbl15_historia_clinica.plan_diag_antibiograma_lab, 
tbl15_historia_clinica.plan_diag_antibiograma_resul, 
tbl15_historia_clinica.plan_diag_encima_hepatica, tbl15_historia_clinica.plan_diag_encima_hepatica_autorizado, 
tbl15_historia_clinica.plan_diag_encima_hepatica_fecha, tbl15_historia_clinica.plan_diag_encima_hepatica_lab, 
tbl15_historia_clinica.plan_diag_encima_hepatica_resul, 
tbl15_historia_clinica.plan_diag_otro, 
tbl15_historia_clinica.plan_diag_otro_autorizado, tbl15_historia_clinica.plan_diag_otro_fecha, 
tbl15_historia_clinica.plan_diag_otro_lab, tbl15_historia_clinica.plan_diag_otro_resul, 
tbl15_historia_clinica.plan_diag_interpre_resul, tbl15_historia_clinica.plan_diag_impresion_diag, 
tbl15_historia_clinica.enfermedad_actual, tbl15_historia_clinica.examen_fisico, tbl15_historia_clinica.antecedente, 
tbl15_historia_clinica.analisis, tbl15_historia_clinica.plan, tbl15_historia_clinica.exa_fis_peso, 
tbl15_historia_clinica.exa_fis_talla, tbl15_historia_clinica.exa_fis_imc, tbl15_historia_clinica.exa_fis_interpreimc, 
tbl15_historia_clinica.exa_fis_fresp, tbl15_historia_clinica.exa_fis_fc, tbl15_historia_clinica.exa_fis_ta, 
tbl15_historia_clinica.exa_fis_lateral, tbl15_historia_clinica.exa_fis_periabdom, tbl15_historia_clinica.exa_fis_temperat, 
tbl15_historia_clinica.exa_fis_tllc, tbl15_historia_clinica.exa_fis_pulso, tbl15_historia_clinica.exa_fis_sto2, 
tbl15_historia_clinica.exa_fis_concepto, tbl15_historia_clinica.exa_fis, tbl15_historia_clinica.exa_fis_ojo, 
tbl15_historia_clinica.exa_fis_ojo_obser, tbl15_historia_clinica.exa_fis_oido, tbl15_historia_clinica.exa_fis_oido_obser, 
tbl15_historia_clinica.exa_fis_cabeza, tbl15_historia_clinica.exa_fis_cabeza_obser, tbl15_historia_clinica.exa_fis_nariz, 
tbl15_historia_clinica.exa_fis_nariz_obser, tbl15_historia_clinica.exa_fis_orofaring, tbl15_historia_clinica.exa_fis_orofaring_obser, 
tbl15_historia_clinica.exa_fis_cuello, tbl15_historia_clinica.exa_fis_cuello_obser, tbl15_historia_clinica.exa_fis_torax, 
tbl15_historia_clinica.exa_fis_torax_obser, tbl15_historia_clinica.exa_fis_sistemmusculesquelet, tbl15_historia_clinica.exa_fis_sistemmusculesquelet_observ, 
tbl15_historia_clinica.exa_fis_glandumama, tbl15_historia_clinica.exa_fis_glandumama_obser, tbl15_historia_clinica.exa_fis_cardiopulm, 
tbl15_historia_clinica.exa_fis_cardiopulm_obser, tbl15_historia_clinica.exa_fis_abdomen, tbl15_historia_clinica.exa_fis_abdomen_obser, 
tbl15_historia_clinica.exa_fis_genital, tbl15_historia_clinica.exa_fis_genital_obser, tbl15_historia_clinica.exa_fis_miemsup, 
tbl15_historia_clinica.exa_fis_miemsup_obser, tbl15_historia_clinica.exa_fis_mieminf, tbl15_historia_clinica.exa_fis_mieminf_obser, 
tbl15_historia_clinica.exa_fis_columna, tbl15_historia_clinica.exa_fis_columna_obser, tbl15_historia_clinica.exa_fis_neurolog, 
tbl15_historia_clinica.exa_fis_neurolog_obser, tbl15_historia_clinica.exa_fis_pielfanera, tbl15_historia_clinica.exa_fis_pielfanera_obser, 
tbl15_historia_clinica.control_examen, tbl15_historia_clinica.fecha_control, tbl15_historia_clinica.plan_historia_clinica, 
tbl15_historia_clinica.cod_tipo_historia_clinica, tbl15_historia_clinica.cod_estado_facturacion, tbl15_historia_clinica.costo_motivo_consulta, 
tbl15_historia_clinica.cod_factura, tbl15_historia_clinica.total_terapia, tbl15_historia_clinica.nombre_religion, 
tbl15_historia_clinica.nombre_ocupacion, tbl15_historia_clinica.nombre_estado_civil, tbl15_historia_clinica.nombre_escolaridad, 
tbl15_historia_clinica.nombre_escolaridad_estado, tbl15_historia_clinica.nombre_tipo_regimen, tbl15_historia_clinica.nombre_fondo_pension, 
tbl15_historia_clinica.nombre_actividad_ecoemp, tbl15_historia_clinica.nombre_estrato, tbl15_historia_clinica.nombre_numero_hijos, 
tbl15_historia_clinica.nombre_arl, tbl15_historia_clinica.cod_empresa, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, 
tbl15_historia_clinica.cargo_empresa, tbl15_historia_clinica.area_empresa, tbl15_historia_clinica.ciudad_empresa, 
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.tel_cliente, tbl15_historia_clinica.correo, 
tbl15_historia_clinica.cod_entidad, tbl15_historia_clinica.lugar_residencia,  
tbl15_historia_clinica.nombre_pais, tbl15_historia_clinica.nombre_departamento, 
tbl15_historia_clinica.nombre_municipio, tbl15_historia_clinica.fecha_mes, tbl15_historia_clinica.fecha_anyo, 
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, 
tbl15_historia_clinica.fecha_reg_time, tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, 
tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, tbl15_historia_clinica.cuenta,
tbl15_historia_clinica.nombre_vacum_can, tbl15_historia_clinica.nombre_vacum_can_pvc, tbl15_historia_clinica.nombre_vacum_can_triple, 
tbl15_historia_clinica.nombre_vacum_can_rabia, tbl15_historia_clinica.nombre_vacum_can_otra, tbl15_historia_clinica.nombre_vacum_can_otra, 
tbl15_historia_clinica.cod_actitud, tbl15_historia_clinica.cod_condicion_corporal, tbl15_historia_clinica.cod_estado_hidratacion
FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
WHERE (tbl15_historia_clinica.cod_historia_clinica = '$cod_historia_clinica')";
$resultado_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
$info_historia_clinica = mysqli_fetch_assoc($resultado_historia_clinica);

$cod_cliente                              = $info_historia_clinica['cod_cliente'];
$cedula                                   = $info_historia_clinica['cedula'];
$nombres                                  = $info_historia_clinica['nombres'];
$fecha_nac_ymd                            = $info_historia_clinica['fecha_nac_ymd'];
$fecha_nac_time                           = $info_historia_clinica['fecha_nac_time'];
$senas_particulares                       = $info_historia_clinica['senas_particulares'];
$nombre_procedencia                       = $info_historia_clinica['nombre_procedencia'];
$nombre_sexo                              = $info_historia_clinica['nombre_sexo'];
$nombre_especie                           = $info_historia_clinica['nombre_especie'];
$nombre_raza                              = $info_historia_clinica['nombre_raza'];
$nombre_estrato                           = $info_historia_clinica['nombre_estrato'];
$nombre_color                             = $info_historia_clinica['nombre_color'];
$edad_anyo                                = $info_historia_clinica['edad_anyo'];
$edad_mes                                 = $info_historia_clinica['edad_mes'];
$tel_cliente                              = $info_historia_clinica['tel_cliente'];
$url_img_foto_min_cli                     = $info_historia_clinica['url_img_foto_min_cli'];
$url_img_foto_cli                         = $info_historia_clinica['url_img_foto_cli'];
$nombres_cli                              = $info_historia_clinica['nombres'];
$nombres_completos                        = $nombres_cli;
$fecha_nac_timedb                         = $info_historia_clinica['fecha_nac_time'];
$fecha_nac_time                           = strtotime($fecha_nac_ymd);
$diferencia_edad                          = abs($fecha_hoy_time - $fecha_nac_time);

$cod_administrador                        = $info_historia_clinica['cod_administrador'];
$motivo                                   = $info_historia_clinica['motivo'];
$motivo2                                  = $info_historia_clinica['motivo2'];
$motivo_consulta                          = $info_historia_clinica['motivo_consulta'];
$anamnesicos                              = $info_historia_clinica['anamnesicos'];
$vacum_can                                = $info_historia_clinica['vacum_can'];
$vacum_can_pvc                            = $info_historia_clinica['vacum_can_pvc'];
$vacum_can_pvc_fecha                      = $info_historia_clinica['vacum_can_pvc_fecha'];
$vacum_can_triple                         = $info_historia_clinica['vacum_can_triple'];
$vacum_can_triple_fecha                   = $info_historia_clinica['vacum_can_triple_fecha'];
$vacum_can_rabia                          = $info_historia_clinica['vacum_can_rabia'];
$vacum_can_rabia_fecha                    = $info_historia_clinica['vacum_can_rabia_fecha'];
$vacum_can_otra                           = $info_historia_clinica['vacum_can_otra'];
$vacum_can_otra_fecha                     = $info_historia_clinica['vacum_can_otra_fecha'];
$vacum_can_otra_cual                      = $info_historia_clinica['vacum_can_otra_cual'];
$vacum_fel                                = $info_historia_clinica['vacum_fel'];
$vacum_fel_pvc                            = $info_historia_clinica['vacum_fel_pvc'];
$vacum_fel_pvc_fecha                      = $info_historia_clinica['vacum_fel_pvc_fecha'];
$vacum_fel_triple                         = $info_historia_clinica['vacum_fel_triple'];
$vacum_fel_triple_fecha                   = $info_historia_clinica['vacum_fel_triple_fecha'];
$vacum_fel_rabia                          = $info_historia_clinica['vacum_fel_rabia'];
$vacum_fel_rabia_fecha                    = $info_historia_clinica['vacum_fel_rabia_fecha'];
$vacum_fel_otra                           = $info_historia_clinica['vacum_fel_otra'];
$vacum_fel_otra_fecha                     = $info_historia_clinica['vacum_fel_otra_fecha'];
$vacum_fel_otra_cual                      = $info_historia_clinica['vacum_fel_otra_cual'];
$ult_desparacit                           = $info_historia_clinica['ult_desparacit'];
$ult_desparacit_producto                  = $info_historia_clinica['ult_desparacit_producto'];
$ult_desparacit_fecha                     = $info_historia_clinica['ult_desparacit_fecha'];
$nombre_alimentacion                      = $info_historia_clinica['nombre_alimentacion'];
$nombre_alimentacion_otra                 = $info_historia_clinica['nombre_alimentacion_otra'];
$nombre_estado_reproductivo               = $info_historia_clinica['nombre_estado_reproductivo'];
$nombre_alergias                          = $info_historia_clinica['nombre_alergias'];
$nombre_enf_ant                           = $info_historia_clinica['nombre_enf_ant'];
$nombre_cirugias                          = $info_historia_clinica['nombre_cirugias'];
$ant_fam                                  = $info_historia_clinica['ant_fam'];
$nombre_habitat                           = $info_historia_clinica['nombre_habitat'];
$nombre_actitud                           = $info_historia_clinica['nombre_actitud'];
$nombre_condicion_corporal                = $info_historia_clinica['nombre_condicion_corporal'];
$nombre_estado_hidratacion                = $info_historia_clinica['nombre_estado_hidratacion'];
$mucosas                                  = $info_historia_clinica['mucosas'];
$mucosas_observ                           = $info_historia_clinica['mucosas_observ'];
$conjuntival                              = $info_historia_clinica['conjuntival'];
$conjuntival_observ                       = $info_historia_clinica['conjuntival_observ'];
$oral                                     = $info_historia_clinica['oral'];
$oral_observ                              = $info_historia_clinica['oral_observ'];
$vulvar_prepucial                         = $info_historia_clinica['vulvar_prepucial'];
$vulvar_prepucial_observ                  = $info_historia_clinica['vulvar_prepucial_observ'];
$rectal                                   = $info_historia_clinica['rectal'];
$rectal_observ                            = $info_historia_clinica['rectal_observ'];
$ojos                                     = $info_historia_clinica['ojos'];
$ojos_observ                              = $info_historia_clinica['ojos_observ'];
$oidos                                    = $info_historia_clinica['oidos'];
$oidos_observ                             = $info_historia_clinica['oidos_observ'];
$nodulos_linfa                            = $info_historia_clinica['nodulos_linfa'];
$nodulos_linfa_observ                     = $info_historia_clinica['nodulos_linfa_observ'];
$piel_anexos                              = $info_historia_clinica['piel_anexos'];
$piel_anexos_observ                       = $info_historia_clinica['piel_anexos_observ'];
$locomocion                               = $info_historia_clinica['locomocion'];
$locomocion_observ                        = $info_historia_clinica['locomocion_observ'];
$aparato_musculoesquelet                  = $info_historia_clinica['aparato_musculoesquelet'];
$aparato_musculoesquelet_observ           = $info_historia_clinica['aparato_musculoesquelet_observ'];
$sistem_nervioso                          = $info_historia_clinica['sistem_nervioso'];
$sistem_nervioso_observ                   = $info_historia_clinica['sistem_nervioso_observ'];
$aparato_cardiovascu                      = $info_historia_clinica['aparato_cardiovascu'];
$aparato_cardiovascu_observ               = $info_historia_clinica['aparato_cardiovascu_observ'];
$aparato_respirat                         = $info_historia_clinica['aparato_respirat'];
$aparato_respirat_observ                  = $info_historia_clinica['aparato_respirat_observ'];
$aparato_digestivo                        = $info_historia_clinica['aparato_digestivo'];
$aparato_digestivo_observ                 = $info_historia_clinica['aparato_digestivo_observ'];
$aparato_genitourinario                   = $info_historia_clinica['aparato_genitourinario'];
$aparato_genitourinario_observ            = $info_historia_clinica['aparato_genitourinario_observ'];
$plan_diag                                = $info_historia_clinica['plan_diag'];
$plan_diag_autorizado                     = $info_historia_clinica['plan_diag_autorizado'];
$plan_diag_cuadhemat                      = $info_historia_clinica['plan_diag_cuadhemat'];
$plan_diag_cuadhemat_autorizado           = $info_historia_clinica['plan_diag_cuadhemat_autorizado'];
$plan_diag_cuadhemat_fecha                = $info_historia_clinica['plan_diag_cuadhemat_fecha'];
$plan_diag_cuadhemat_lab                  = $info_historia_clinica['plan_diag_cuadhemat_lab'];
$plan_diag_cuadhemat_resul                = $info_historia_clinica['plan_diag_cuadhemat_resul'];
$plan_diag_parcialorina                   = $info_historia_clinica['plan_diag_parcialorina'];
$plan_diag_parcialorina_autorizado        = $info_historia_clinica['plan_diag_parcialorina_autorizado'];
$plan_diag_parcialorina_fecha             = $info_historia_clinica['plan_diag_parcialorina_fecha'];
$plan_diag_parcialorina_lab               = $info_historia_clinica['plan_diag_parcialorina_lab'];
$plan_diag_parcialorina_resul             = $info_historia_clinica['plan_diag_parcialorina_resul'];
$plan_diag_coprologico                    = $info_historia_clinica['plan_diag_coprologico'];
$plan_diag_coprologico_autorizado         = $info_historia_clinica['plan_diag_coprologico_autorizado'];
$plan_diag_coprologico_fecha              = $info_historia_clinica['plan_diag_coprologico_fecha'];
$plan_diag_coprologico_lab                = $info_historia_clinica['plan_diag_coprologico_lab'];
$plan_diag_coprologico_resul              = $info_historia_clinica['plan_diag_coprologico_resul'];
$plan_diag_citologfecal                   = $info_historia_clinica['plan_diag_citologfecal'];
$plan_diag_citologfecal_autorizado        = $info_historia_clinica['plan_diag_citologfecal_autorizado'];
$plan_diag_citologfecal_fecha             = $info_historia_clinica['plan_diag_citologfecal_fecha'];
$plan_diag_citologfecal_lab               = $info_historia_clinica['plan_diag_citologfecal_lab'];
$plan_diag_citologfecal_resul             = $info_historia_clinica['plan_diag_citologfecal_resul'];
$plan_diag_citolog                        = $info_historia_clinica['plan_diag_citolog'];
$plan_diag_citolog_autorizado             = $info_historia_clinica['plan_diag_citolog_autorizado'];
$plan_diag_citolog_fecha                  = $info_historia_clinica['plan_diag_citolog_fecha'];
$plan_diag_citolog_lab                    = $info_historia_clinica['plan_diag_citolog_lab'];
$plan_diag_citolog_resul                  = $info_historia_clinica['plan_diag_citolog_resul'];
$plan_diag_quimicsang1                    = $info_historia_clinica['plan_diag_quimicsang1'];
$plan_diag_quimicsang1_autorizado         = $info_historia_clinica['plan_diag_quimicsang1_autorizado'];
$plan_diag_quimicsang1_fecha              = $info_historia_clinica['plan_diag_quimicsang1_fecha'];
$plan_diag_quimicsang1_lab                = $info_historia_clinica['plan_diag_quimicsang1_lab'];
$plan_diag_quimicsang1_resul              = $info_historia_clinica['plan_diag_quimicsang1_resul'];
$plan_diag_quimicsang2                    = $info_historia_clinica['plan_diag_quimicsang2'];
$plan_diag_quimicsang2_autorizado         = $info_historia_clinica['plan_diag_quimicsang2_autorizado'];
$plan_diag_quimicsang2_fecha              = $info_historia_clinica['plan_diag_quimicsang2_fecha'];
$plan_diag_quimicsang2_lab                = $info_historia_clinica['plan_diag_quimicsang2_lab'];
$plan_diag_quimicsang2_resul              = $info_historia_clinica['plan_diag_quimicsang2_resul'];
$plan_diag_quimicsang3                    = $info_historia_clinica['plan_diag_quimicsang3'];
$plan_diag_quimicsang3_autorizado         = $info_historia_clinica['plan_diag_quimicsang3_autorizado'];
$plan_diag_quimicsang3_fecha              = $info_historia_clinica['plan_diag_quimicsang3_fecha'];
$plan_diag_quimicsang3_lab                = $info_historia_clinica['plan_diag_quimicsang3_lab'];
$plan_diag_quimicsang3_resul              = $info_historia_clinica['plan_diag_quimicsang3_resul'];
$plan_diag_quimicsang4                    = $info_historia_clinica['plan_diag_quimicsang4'];
$plan_diag_quimicsang4_autorizado         = $info_historia_clinica['plan_diag_quimicsang4_autorizado'];
$plan_diag_quimicsang4_fecha              = $info_historia_clinica['plan_diag_quimicsang4_fecha'];
$plan_diag_quimicsang4_lab                = $info_historia_clinica['plan_diag_quimicsang4_lab'];
$plan_diag_quimicsang4_resul              = $info_historia_clinica['plan_diag_quimicsang4_resul'];
$plan_diag_rayx                           = $info_historia_clinica['plan_diag_rayx'];
$plan_diag_rayx_autorizado                = $info_historia_clinica['plan_diag_rayx_autorizado'];
$plan_diag_rayx_fecha                     = $info_historia_clinica['plan_diag_rayx_fecha'];
$plan_diag_rayx_lab                       = $info_historia_clinica['plan_diag_rayx_lab'];
$plan_diag_rayx_resul                     = $info_historia_clinica['plan_diag_rayx_resul'];
$plan_diag_usg                            = $info_historia_clinica['plan_diag_usg'];
$plan_diag_usg_autorizado                 = $info_historia_clinica['plan_diag_usg_autorizado'];
$plan_diag_usg_fecha                      = $info_historia_clinica['plan_diag_usg_fecha'];
$plan_diag_usg_lab                        = $info_historia_clinica['plan_diag_usg_lab'];
$plan_diag_usg_resul                      = $info_historia_clinica['plan_diag_usg_resul'];
$plan_diag_cultivo                        = $info_historia_clinica['plan_diag_cultivo'];
$plan_diag_cultivo_autorizado             = $info_historia_clinica['plan_diag_cultivo_autorizado'];
$plan_diag_cultivo_fecha                  = $info_historia_clinica['plan_diag_cultivo_fecha'];
$plan_diag_cultivo_lab                    = $info_historia_clinica['plan_diag_cultivo_lab'];
$plan_diag_cultivo_resul                  = $info_historia_clinica['plan_diag_cultivo_resul'];
$plan_diag_antibiograma                   = $info_historia_clinica['plan_diag_antibiograma'];
$plan_diag_antibiograma_autorizado        = $info_historia_clinica['plan_diag_antibiograma_autorizado'];
$plan_diag_antibiograma_fecha             = $info_historia_clinica['plan_diag_antibiograma_fecha'];
$plan_diag_antibiograma_lab               = $info_historia_clinica['plan_diag_antibiograma_lab'];
$plan_diag_antibiograma_resul             = $info_historia_clinica['plan_diag_antibiograma_resul'];
$plan_diag_encima_hepatica                = $info_historia_clinica['plan_diag_encima_hepatica'];
$plan_diag_encima_hepatica_autorizado     = $info_historia_clinica['plan_diag_encima_hepatica_autorizado'];
$plan_diag_encima_hepatica_fecha          = $info_historia_clinica['plan_diag_encima_hepatica_fecha'];
$plan_diag_encima_hepatica_lab            = $info_historia_clinica['plan_diag_encima_hepatica_lab'];
$plan_diag_encima_hepatica_resul          = $info_historia_clinica['plan_diag_encima_hepatica_resul'];
$plan_diag_otro                           = $info_historia_clinica['plan_diag_otro'];
$plan_diag_otro_autorizado                = $info_historia_clinica['plan_diag_otro_autorizado'];
$plan_diag_otro_fecha                     = $info_historia_clinica['plan_diag_otro_fecha'];
$plan_diag_otro_lab                       = $info_historia_clinica['plan_diag_otro_lab'];
$plan_diag_otro_resul                     = $info_historia_clinica['plan_diag_otro_resul'];
$plan_diag_interpre_resul                 = $info_historia_clinica['plan_diag_interpre_resul'];
$plan_diag_impresion_diag                 = $info_historia_clinica['plan_diag_impresion_diag'];
$enfermedad_actual                        = $info_historia_clinica['enfermedad_actual'];
$examen_fisico                            = $info_historia_clinica['examen_fisico'];
$antecedente                              = $info_historia_clinica['antecedente'];
$analisis                                 = $info_historia_clinica['analisis'];
$plan                                     = $info_historia_clinica['plan'];
$exa_fis_peso                             = $info_historia_clinica['exa_fis_peso'];
$exa_fis_talla                            = $info_historia_clinica['exa_fis_talla'];
$exa_fis_imc                              = $info_historia_clinica['exa_fis_imc'];
$exa_fis_interpreimc                      = $info_historia_clinica['exa_fis_interpreimc'];
$exa_fis_fresp                            = $info_historia_clinica['exa_fis_fresp'];
$exa_fis_fc                               = $info_historia_clinica['exa_fis_fc'];
$exa_fis_ta                               = $info_historia_clinica['exa_fis_ta'];
$exa_fis_lateral                          = $info_historia_clinica['exa_fis_lateral'];
$exa_fis_periabdom                        = $info_historia_clinica['exa_fis_periabdom'];
$exa_fis_temperat                         = $info_historia_clinica['exa_fis_temperat'];
$exa_fis_tllc                             = $info_historia_clinica['exa_fis_tllc'];
$exa_fis_pulso                            = $info_historia_clinica['exa_fis_pulso'];
$exa_fis_sto2                             = $info_historia_clinica['exa_fis_sto2'];
$exa_fis_concepto                         = $info_historia_clinica['exa_fis_concepto'];
$exa_fis                                  = $info_historia_clinica['exa_fis'];
$exa_fis_ojo                              = $info_historia_clinica['exa_fis_ojo'];
$exa_fis_ojo_obser                        = $info_historia_clinica['exa_fis_ojo_obser'];
$exa_fis_oido                             = $info_historia_clinica['exa_fis_oido'];
$exa_fis_oido_obser                       = $info_historia_clinica['exa_fis_oido_obser'];
$exa_fis_cabeza                           = $info_historia_clinica['exa_fis_cabeza'];
$exa_fis_cabeza_obser                     = $info_historia_clinica['exa_fis_cabeza_obser'];
$exa_fis_nariz                            = $info_historia_clinica['exa_fis_nariz'];
$exa_fis_nariz_obser                      = $info_historia_clinica['exa_fis_nariz_obser'];
$exa_fis_orofaring                        = $info_historia_clinica['exa_fis_orofaring'];
$exa_fis_orofaring_obser                  = $info_historia_clinica['exa_fis_orofaring_obser'];
$exa_fis_cuello                           = $info_historia_clinica['exa_fis_cuello'];
$exa_fis_cuello_obser                     = $info_historia_clinica['exa_fis_cuello_obser'];
$exa_fis_torax                            = $info_historia_clinica['exa_fis_torax'];
$exa_fis_torax_obser                      = $info_historia_clinica['exa_fis_torax_obser'];
$exa_fis_sistemmusculesquelet             = $info_historia_clinica['exa_fis_sistemmusculesquelet'];
$exa_fis_sistemmusculesquelet_observ      = $info_historia_clinica['exa_fis_sistemmusculesquelet_observ'];
$exa_fis_glandumama                       = $info_historia_clinica['exa_fis_glandumama'];
$exa_fis_glandumama_obser                 = $info_historia_clinica['exa_fis_glandumama_obser'];
$exa_fis_cardiopulm                       = $info_historia_clinica['exa_fis_cardiopulm'];
$exa_fis_cardiopulm_obser                 = $info_historia_clinica['exa_fis_cardiopulm_obser'];
$exa_fis_abdomen                          = $info_historia_clinica['exa_fis_abdomen'];
$exa_fis_abdomen_obser                    = $info_historia_clinica['exa_fis_abdomen_obser'];
$exa_fis_genital                          = $info_historia_clinica['exa_fis_genital'];
$exa_fis_genital_obser                    = $info_historia_clinica['exa_fis_genital_obser'];
$exa_fis_miemsup                          = $info_historia_clinica['exa_fis_miemsup'];
$exa_fis_miemsup_obser                    = $info_historia_clinica['exa_fis_miemsup_obser'];
$exa_fis_mieminf                          = $info_historia_clinica['exa_fis_mieminf'];
$exa_fis_mieminf_obser                    = $info_historia_clinica['exa_fis_mieminf_obser'];
$exa_fis_columna                          = $info_historia_clinica['exa_fis_columna'];
$exa_fis_columna_obser                    = $info_historia_clinica['exa_fis_columna_obser'];
$exa_fis_neurolog                         = $info_historia_clinica['exa_fis_neurolog'];
$exa_fis_neurolog_obser                   = $info_historia_clinica['exa_fis_neurolog_obser'];
$exa_fis_pielfanera                       = $info_historia_clinica['exa_fis_pielfanera'];
$exa_fis_pielfanera_obser                 = $info_historia_clinica['exa_fis_pielfanera_obser'];
$control_examen                           = $info_historia_clinica['control_examen'];
$fecha_control                            = $info_historia_clinica['fecha_control'];
$plan_historia_clinica                    = $info_historia_clinica['plan_historia_clinica'];
$cod_tipo_historia_clinica                = $info_historia_clinica['cod_tipo_historia_clinica'];
$cod_estado_facturacion                   = $info_historia_clinica['cod_estado_facturacion'];
$costo_motivo_consulta                    = $info_historia_clinica['costo_motivo_consulta'];
$cod_factura                              = $info_historia_clinica['cod_factura'];
$nombre_ocupacion                         = $info_historia_clinica['nombre_ocupacion'];
$nombre_estrato                           = $info_historia_clinica['nombre_estrato'];
$nombre_numero_hijos                      = $info_historia_clinica['nombre_numero_hijos'];
//$tel_cliente                              = $info_historia_clinica['tel_cliente'];
$correo                                   = $info_historia_clinica['correo'];
$cod_entidad                              = $info_historia_clinica['cod_entidad'];
$lugar_residencia                         = $info_historia_clinica['lugar_residencia'];
$nombre_contacto1                         = $info_historia_clinica['nombre_contacto1'];
$identificacion_contacto1                 = $info_historia_clinica['identificacion_contacto1'];
$estrato_contacto1                        = $info_historia_clinica['estrato_contacto1'];
$municipio_contacto1                      = $info_historia_clinica['municipio_contacto1'];
$ocupacion_contacto1                      = $info_historia_clinica['ocupacion_contacto1'];
$tel_contacto1                            = $info_historia_clinica['tel_contacto1'];
$parentesco_contacto1                     = $info_historia_clinica['parentesco_contacto1'];
$direccion_contacto1                      = $info_historia_clinica['direccion_contacto1'];
$nombre_pais                              = $info_historia_clinica['nombre_pais'];
$nombre_departamento                      = $info_historia_clinica['nombre_departamento'];
$nombre_municipio                         = $info_historia_clinica['nombre_municipio'];
$fecha_mes                                = $info_historia_clinica['fecha_mes'];
$fecha_anyo                               = $info_historia_clinica['fecha_anyo'];
$fecha_ymd                                = $info_historia_clinica['fecha_ymd'];
$fecha_dmy                                = $info_historia_clinica['fecha_dmy'];
$hora                                     = $info_historia_clinica['hora'];
$fecha_time                               = $info_historia_clinica['fecha_time'];
$fecha_reg_time                           = $info_historia_clinica['fecha_reg_time'];
$url_img_firma_min                        = $info_historia_clinica['url_img_firma_min'];
$url_img_firma_orig                       = $info_historia_clinica['url_img_firma_orig'];
$url_img_foto_min                         = $info_historia_clinica['url_img_foto_min'];
$url_img_foto_orig                        = $info_historia_clinica['url_img_foto_orig'];
$cuenta                                   = $info_historia_clinica['cuenta'];
$correo_contacto1                         = $info_historia_clinica['correo_contacto1'];
$nombre_vacum_can                         = $info_historia_clinica['nombre_vacum_can'];
$nombre_vacum_can_pvc                     = $info_historia_clinica['nombre_vacum_can_pvc'];
$nombre_vacum_can_triple                  = $info_historia_clinica['nombre_vacum_can_triple'];
$nombre_vacum_can_rabia                   = $info_historia_clinica['nombre_vacum_can_rabia'];
$nombre_vacum_can_otra                    = $info_historia_clinica['nombre_vacum_can_otra'];
$cod_actitud                              = $info_historia_clinica['cod_actitud'];
$cod_condicion_corporal                   = $info_historia_clinica['cod_condicion_corporal'];
$cod_estado_hidratacion                   = $info_historia_clinica['cod_estado_hidratacion'];
$cod_empresa                              = $info_historia_clinica['cod_empresa'];
$dia                                      = date("d", strtotime($fecha_ymd));
$mes                                      = date("m", strtotime($fecha_ymd));
$anyo                                     = date("Y", strtotime($fecha_ymd));
// ------------------------------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------- //

$sql_cod_historia_clinica_anterior = "SELECT cod_historia_clinica FROM tbl15_historia_clinica WHERE cod_cliente = '$cod_cliente' LIMIT 1, 1";
$resultado_cod_historia_clinica_anterior = mysqli_query($conectar, $sql_cod_historia_clinica_anterior);
$info_cod_historia_clinica_anterior = mysqli_fetch_assoc($resultado_cod_historia_clinica_anterior);

$cod_historia_clinica_anterior = $info_cod_historia_clinica_anterior['cod_historia_clinica'];
// ------------------------------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------- //
$sql_profesional = "SELECT nombres, apellidos FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$resultado_profesional = mysqli_query($conectar, $sql_profesional);
$info_profesional = mysqli_fetch_assoc($resultado_profesional);

$nombres_prof                              = $info_profesional['nombres'];
$apellidos_prof                            = $info_profesional['apellidos'];
// ------------------------------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------------------------------- //
$pagina_local                          = $_SERVER['PHP_SELF'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/reg_historia_clinica_mejorada_reg.php">


<table align="center" border="1" width="100%" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;"><thead><tr><th bgcolor="#FAC090" valign="middle"><span style="color:#FF0000">1. DATOS DEL TRABAJADOR</span></th></tr></thead></table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%">
	<thead><tr>
		<th valign="middle">
			<img src="<?php echo $url_img_foto_min_cli ?>" class="img-thumbnail" alt="Foto Paciente" style="border-style:dotted;border-width:1px;" width="71px"/>
		</th>
	</tr></thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td><strong>FECHA DE ADMISIÓN:</td>
    <td><input name="fecha_ymd" id="<?php echo $cod_historia_clinica ?>" type="date" class="input-block-level" value="<?php echo $fecha_ymd ?>"/></td>
    <td><strong>HORA:</strong></td>
    <td><input name="hora" id="<?php echo $cod_historia_clinica ?>" type="time" class="input-block-level" value="<?php echo $hora ?>"/></td>
    <td><strong>H.C:</strong></td>
    <td><?php echo $cod_historia_clinica ?></td>
  <tr>
    <td><strong>MÉDICO VETERINARIO:</td>
    <td><?php echo $nombres_prof.' '.$apellidos_prof ?></td>
    <td><strong>T.P.:</strong></td>
    <td><?php echo $licencia_emp ?></td>
    <td><strong>CHIP:</strong></td>
    <td></td>
  </tr>
</table>

&nbsp;

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td colspan="5"><strong><em>RESEÑA DEL PACIENTE</em></strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>NOMBRE: <?php echo $nombres_completos ?></strong></td>
    <td><strong>ESPECIE: <?php echo $nombre_especie ?></strong></td>
    <td colspan="2"><strong>RAZA: <?php echo $nombre_raza ?></strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>COLOR: <?php echo $nombre_color ?></strong></td>
    <td><strong>SEXO: <?php echo $nombre_sexo ?></strong></td>
    <td colspan="2"><strong>FECHA NACIMIENTO: <?php echo $fecha_nac_ymd ?></strong></td>
  </tr>
  <tr>
    <td><strong>EDAD (MESES): <?php echo $edad_mes ?></strong></td>
    <td colspan="3"><strong>SEÑAS PARTICULARES: <?php echo $senas_particulares ?></strong></td>
    <td><strong>PROCEDENCIA: <?php echo $nombre_procedencia ?></strong></td>
  </tr>
</table>

&nbsp;

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td colspan="5"><strong><em>DATOS DEL PROPIETARIO</em></strong></td>
  </tr>
    <td style="text-align:center;">
<select name="cod_empresa" id="<?php echo $cod_historia_clinica ?>" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($cod_empresa)) { echo "<option value='' >...</option>";
} else { echo  "<option value='' selected ></option>"; }
$consulta2_sql = "SELECT cod_empresa, nombre_empresa, nit_empresa FROM tbl15_empresa ORDER BY nombre_empresa ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_empresa) AND $cod_empresa == $datos2['cod_empresa']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_empresa'];
$nombre = $datos2['nombre_empresa'];
$nit_empresa = $datos2['nit_empresa'];
echo "<option value='".$codigo."' $seleccionado >".$nombre.' - '.$nit_empresa."</option>"; } ?></select>
    </td>
</table>

<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td><strong><em>MOTIVO DE LA CONSULTA: </em></strong></td>
  </tr>
  <tr>
    <td><input name="motivo" id="<?php echo $cod_historia_clinica ?>" type="text" class="input-block-level" value="<?php echo $motivo ?>"/></td>
  </tr>
  <tr>
    <td><strong><em>COSTO: </em></strong></td>
  </tr>
  <tr>
    <td><input name="costo_motivo_consulta" id="<?php echo $cod_historia_clinica ?>" type="text" class="input-block-level" value="<?php echo $costo_motivo_consulta ?>"/></td>
  </tr>
  <tr>
    <td><strong><em>ANAMNÉSICOS: </em></strong></td>
  </tr>
  <tr>
    <td><input name="anamnesicos" id="<?php echo $cod_historia_clinica ?>" type="text" class="input-block-level" value="<?php echo $anamnesicos ?>"/></td>
  </tr>
</table>

<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td colspan="7"><strong><em>HISTORIA DEL PACIENTE</em></strong></td>
  </tr>
  <tr>
    <td style="text-align:center" rowspan="7"><strong>VACUNACIÓN</strong></td>
    <td style="text-align:center" colspan="3"><strong><?php echo $nombre_especie ?></strong></td>
  </tr>
  <tr>
    <td><input name="nombre_vacum_can" id="<?php echo $cod_historia_clinica ?>" type="text" class="input-block-level" value="<?php echo $nombre_vacum_can ?>"/></td>
    <td style="text-align:center">SI<input type="radio" name="vacum_can" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($vacum_can=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="vacum_can" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($vacum_can=='NO')?'checked':'' ?> ></td>
    <td></td>
  </tr>
  <tr>
    <td><input name="nombre_vacum_can_pvc" id="<?php echo $cod_historia_clinica ?>" type="text" class="input-block-level" value="<?php echo $nombre_vacum_can_pvc ?>"/></td>
    <td style="text-align:center">SI<input type="radio" name="vacum_can_pvc" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($vacum_can_pvc=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="vacum_can_pvc" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($vacum_can_pvc=='NO')?'checked':'' ?> ></td>
    <td>Fecha: <input name="vacum_can_pvc_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $vacum_can_pvc_fecha ?>"/></td>
  </tr>
  <tr>
    <td><input name="nombre_vacum_can_triple" id="<?php echo $cod_historia_clinica ?>" type="text" class="input-block-level" value="<?php echo $nombre_vacum_can_triple ?>"/></td>
    <td style="text-align:center">SI<input type="radio" name="vacum_can_triple" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($vacum_can_triple=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="vacum_can_triple" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($vacum_can_triple=='NO')?'checked':'' ?> ></td>
    <td>Fecha: <input name="vacum_can_triple_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $vacum_can_triple_fecha ?>"/></td>
  </tr>
  <tr>
    <td><input name="nombre_vacum_can_rabia" id="<?php echo $cod_historia_clinica ?>" type="text" class="input-block-level" value="<?php echo $nombre_vacum_can_rabia ?>"/></td>
    <td style="text-align:center">SI<input type="radio" name="vacum_can_rabia" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($vacum_can_rabia=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="vacum_can_rabia" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($vacum_can_rabia=='NO')?'checked':'' ?> ></td>
    <td>Fecha: <input name="vacum_can_rabia_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $vacum_can_rabia_fecha ?>"/></td>
  </tr>
  <tr>
    <td><input name="nombre_vacum_can_otra" id="<?php echo $cod_historia_clinica ?>" type="text" class="input-block-level" value="<?php echo $nombre_vacum_can_otra ?>"/></td>
    <td style="text-align:center">SI<input type="radio" name="vacum_can_otra" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($vacum_can_otra=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="vacum_can_otra" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($vacum_can_otra=='NO')?'checked':'' ?> ></td>
    <td>Fecha: <input name="vacum_can_otra_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $vacum_can_otra_fecha ?>"/></td>
  </tr>
  <tr>
    <td>¿Cuál?</td>
    <td style="text-align:center"><input class="input-block-level" name="vacum_can_otra_cual" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $vacum_can_otra_cual ?>"/></td>
    <td>Fecha: <input name="vacum_can_otra_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $vacum_can_otra_fecha ?>"/></td>
  </tr>
</table>


<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td style="text-align:center"><strong><em>ULTIMA DESPARASITACION</em></strong></td>
    <td style="text-align:center"><strong>PRODUCTO</strong></td>
    <td style="text-align:center"><strong>FECHA</strong></td>
    <td style="text-align:center"><strong>ALIMENTACIÓN</strong></td>
  </tr>
  <tr>
    <td style="text-align:center">
		SI<input type="radio" name="ult_desparacit" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($ult_desparacit=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		NO<input type="radio" name="ult_desparacit" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($ult_desparacit=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input name="ult_desparacit_producto" class="input-block-level" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ult_desparacit_producto ?>"/></td>
    <td style="text-align:center"><input name="ult_desparacit_fecha" class="input-block-level" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $ult_desparacit_fecha ?>"/></td>
    <td style="text-align:center">
		<select name="nombre_alimentacion" id="<?php echo $cod_historia_clinica ?>" class="input-block-level" data-show-subtext="false" data-live-search="false" required>
		<?php if (isset($nombre_alimentacion)) { echo "<option value='' >Selecione</option>";
		} else { echo  "<option value='' selected >Selecione</option>"; }
		$consulta2_sql = ("SELECT cod_alimentacion, nombre_alimentacion FROM tbl15_alimentacion ORDER BY cod_alimentacion ASC");
		$consulta2 = mysqli_query($conectar, $consulta2_sql);
		while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		if(isset($nombre_alimentacion) and $nombre_alimentacion == $datos2['nombre_alimentacion']) {
		$seleccionado = "selected"; } else { $seleccionado = ""; }
		$codigo = $datos2['nombre_alimentacion'];
		$nombre = $datos2['nombre_alimentacion'];
		echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?>
		</select>
    </td>
  </tr>
</table>


<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td><strong><em>ESTADO REPRODUCTIVO:</em></strong></td>
    <td>
	    <select name="nombre_estado_reproductivo" id="<?php echo $cod_historia_clinica ?>" class="input-block-level" data-show-subtext="false" data-live-search="false" required>
		<?php if (isset($nombre_estado_reproductivo)) { echo "<option value='' >Selecione</option>";
		} else { echo  "<option value='' selected >Selecione</option>"; }
		$consulta2_sql = ("SELECT cod_estado_reproductivo, nombre_estado_reproductivo FROM tbl15_estado_reproductivo ORDER BY cod_estado_reproductivo ASC");
		$consulta2 = mysqli_query($conectar, $consulta2_sql);
		while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		if(isset($nombre_estado_reproductivo) and $nombre_estado_reproductivo == $datos2['nombre_estado_reproductivo']) {
		$seleccionado = "selected"; } else { $seleccionado = ""; }
		$codigo = $datos2['nombre_estado_reproductivo'];
		$nombre = $datos2['nombre_estado_reproductivo'];
		echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?>
		</select>
    </td>
    <td>ALERGIAS:</td>
    <td><input name="nombre_alergias" class="input-block-level" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $nombre_alergias ?>"/></td>
  </tr>
</table>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td><strong><em>ENFERMEDADES ANTERIORES:</em></strong></td>
    <td><input name="nombre_enf_ant" class="input-block-level" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $nombre_enf_ant ?>"/></td>
    <td><strong><em>CIRUGÍAS:</em></strong></td>
    <td><input name="nombre_cirugias" class="input-block-level" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $nombre_cirugias ?>"/></td>
  </tr>
</table>


<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td><strong><em>ANTECEDENTES FAMILIARES:</em></strong></td>
    <td><input name="ant_fam" class="input-block-level" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ant_fam ?>"/></td>
  </tr>
</table>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td><strong><em>HÁBITAT:</em></strong></td>
    <td>
	    <select name="nombre_habitat" id="<?php echo $cod_historia_clinica ?>" class="input-block-level" data-show-subtext="false" data-live-search="false" required>
		<?php if (isset($nombre_habitat)) { echo "<option value='' >Selecione</option>";
		} else { echo  "<option value='' selected >Selecione</option>"; }
		$consulta2_sql = ("SELECT cod_habitat, nombre_habitat FROM tbl15_habitat ORDER BY cod_habitat ASC");
		$consulta2 = mysqli_query($conectar, $consulta2_sql);
		while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		if(isset($nombre_habitat) and $nombre_habitat == $datos2['nombre_habitat']) {
		$seleccionado = "selected"; } else { $seleccionado = ""; }
		$codigo = $datos2['nombre_habitat'];
		$nombre = $datos2['nombre_habitat'];
		echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?>
		</select>
    </td>
  </tr>
</table>

<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td colspan="3"><strong><em>CONSTANTES FISIOLÓGICAS</em></strong></td>
  </tr>
  <tr>
    <td><strong>T.Ll.C: <input name="exa_fis_tllc" class="input-block-level" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_tllc ?>"/></strong></td>
    <td><strong>F.C: <input name="exa_fis_fc" class="input-block-level" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_fc ?>"/></strong></td>
    <td><strong>F.R: <input name="exa_fis_fresp" class="input-block-level" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_fresp ?>"/></strong></td>
  </tr>
  <tr>
    <td><strong>PULSO: <input name="exa_fis_pulso" class="input-block-level" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_pulso ?>"/></strong></td>
    <td><strong>TEMPERATURA: <input name="exa_fis_temperat" class="input-block-level" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_temperat ?>"/></strong></td>
    <td><strong>PESO (KG): <input name="exa_fis_peso" class="input-block-level" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $exa_fis_peso ?>"/></strong></td>
  </tr>
</table>

<br>

EXAMEN CLÍNICO
<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td><strong>ACTITUD</strong></td>
    <td colspan="8">
	    <select name="cod_actitud" id="<?php echo $cod_historia_clinica ?>" class="input-block-level" data-show-subtext="false" data-live-search="false" required>
		<?php if (isset($cod_actitud)) { echo "<option value='' >Selecione</option>";
		} else { echo  "<option value='' selected >Selecione</option>"; }
		$consulta2_sql = ("SELECT cod_actitud, nombre_actitud FROM tbl15_actitud ORDER BY cod_actitud ASC");
		$consulta2 = mysqli_query($conectar, $consulta2_sql);
		while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		if(isset($cod_actitud) and $cod_actitud == $datos2['cod_actitud']) {
		$seleccionado = "selected"; } else { $seleccionado = ""; }
		$codigo = $datos2['cod_actitud'];
		$nombre = $datos2['nombre_actitud'];
		echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		</select>
    </td>
  </tr>
  <tr>
    <td><strong>CONDICIÓN CORPORAL</strong></td>
    <td>
	    <select name="cod_condicion_corporal" id="<?php echo $cod_historia_clinica ?>" class="input-block-level" data-show-subtext="false" data-live-search="false" required>
		<?php if (isset($cod_condicion_corporal)) { echo "<option value='' >Selecione</option>";
		} else { echo  "<option value='' selected >Selecione</option>"; }
		$consulta2_sql = ("SELECT cod_condicion_corporal, nombre_condicion_corporal, descripcion_condicion_corporal FROM tbl15_condicion_corporal ORDER BY cod_condicion_corporal ASC");
		$consulta2 = mysqli_query($conectar, $consulta2_sql);
		while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		if(isset($cod_condicion_corporal) and $cod_condicion_corporal == $datos2['cod_condicion_corporal']) {
		$seleccionado = "selected"; } else { $seleccionado = ""; }
		$codigo = $datos2['cod_condicion_corporal'];
		$nombre = $datos2['nombre_condicion_corporal'].'  '.$datos2['descripcion_condicion_corporal'];

		echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		</select>
    </td>
  </tr>
  <tr>
    <td><strong>ESTADO HIDRATACIÓN</strong></td>
    <td>
	    <select name="cod_estado_hidratacion" id="<?php echo $cod_historia_clinica ?>" class="input-block-level" data-show-subtext="false" data-live-search="false" required>
		<?php if (isset($cod_estado_hidratacion)) { echo "<option value='' >Selecione</option>";
		} else { echo  "<option value='' selected >Selecione</option>"; }
		$consulta2_sql = ("SELECT cod_estado_hidratacion, nombre_estado_hidratacion FROM tbl15_estado_hidratacion ORDER BY cod_estado_hidratacion ASC");
		$consulta2 = mysqli_query($conectar, $consulta2_sql);
		while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		if(isset($cod_estado_hidratacion) and $cod_estado_hidratacion == $datos2['cod_estado_hidratacion']) {
		$seleccionado = "selected"; } else { $seleccionado = ""; }
		$codigo = $datos2['cod_estado_hidratacion'];
		$nombre = $datos2['nombre_estado_hidratacion'];
		echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		</select>
    </td>
  </tr>
</table>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td>MUCOSAS:</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="mucosas" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($mucosas=='NORMAL')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="mucosas" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($mucosas=='ANORMAL')?'checked':'' ?> >
    </td>
    <td style="text-align:center">Observaciones</td>
  </tr>
  <tr>
    <td>Conjuntival</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="conjuntival" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($conjuntival=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="conjuntival" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($conjuntival=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="conjuntival_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $conjuntival_observ ?>"/></td>
  </tr>
  <tr>
    <td>Oral</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="oral" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($oral=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="oral" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($oral=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="oral_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $oral_observ ?>"/></td>
  </tr>
  <tr>
    <td>Vulvar/Prepucial</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="vulvar_prepucial" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($vulvar_prepucial=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="vulvar_prepucial" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($vulvar_prepucial=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="vulvar_prepucial_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $vulvar_prepucial_observ ?>"/></td>
  </tr>
  <tr>
    <td>Rectal</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="rectal" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($rectal=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="rectal" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($rectal=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="rectal_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $rectal_observ ?>"/></td>
  </tr>
  <tr>
    <td>OJOS</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="ojos" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($ojos=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="ojos" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($ojos=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="ojos_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $ojos_observ ?>"/></td>
  </tr>
  <tr>
    <td>OÍDOS</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="oidos" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($oidos=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="oidos" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($oidos=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="oidos_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $oidos_observ ?>"/></td>
  </tr>
  <tr>
    <td>NÓDULOS LINFÁTICOS</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="nodulos_linfa" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($nodulos_linfa=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="nodulos_linfa" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($nodulos_linfa=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="nodulos_linfa_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $nodulos_linfa_observ ?>"/></td>
  </tr>
  <tr>
    <td>PIEL Y ANEXOS</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="piel_anexos" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($piel_anexos=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="piel_anexos" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($piel_anexos=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="piel_anexos_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $piel_anexos_observ ?>"/></td>
  </tr>
  <tr>
    <td>LOCOMOCIÓN</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="locomocion" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($locomocion=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="locomocion" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($locomocion=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="locomocion_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $locomocion_observ ?>"/></td>
  </tr>
  <tr>
    <td>A. MUSCULOESQUELÉTICO</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="aparato_musculoesquelet" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($aparato_musculoesquelet=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="aparato_musculoesquelet" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($aparato_musculoesquelet=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="aparato_musculoesquelet_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $aparato_musculoesquelet_observ ?>"/></td>
  </tr>
  <tr>
    <td>NORMALSTEMA NERVIOSO</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="sistem_nervioso" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($sistem_nervioso=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="sistem_nervioso" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($sistem_nervioso=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="sistem_nervioso_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $sistem_nervioso_observ ?>"/></td>
  </tr>
  <tr>
    <td>A. CARDIOVASCULAR</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="aparato_cardiovascu" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($aparato_cardiovascu=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="aparato_cardiovascu" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($aparato_cardiovascu=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="aparato_cardiovascu_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $aparato_cardiovascu_observ ?>"/></td>
  </tr>
  <tr>
    <td>A. RESPIRATORIO</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="aparato_respirat" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($aparato_respirat=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="aparato_respirat" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($aparato_respirat=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="aparato_respirat_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $aparato_respirat_observ ?>"/></td>
  </tr>
  <tr>
    <td>A. DIGESTIVO</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="aparato_digestivo" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($aparato_digestivo=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="aparato_digestivo" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($aparato_digestivo=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="aparato_digestivo_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $aparato_digestivo_observ ?>"/></td>
  </tr>
  <tr>
    <td>A. GENITOURINARIO</td>
    <td style="text-align:center">
		NORMAL<input type="radio" name="aparato_genitourinario" id="<?php echo $cod_historia_clinica ?>" value="NORMAL" <?php echo ($aparato_genitourinario=='NORMAL')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
		ANORMAL<input type="radio" name="aparato_genitourinario" id="<?php echo $cod_historia_clinica ?>" value="ANORMAL" <?php echo ($aparato_genitourinario=='ANORMAL')?'checked':'' ?> >
    </td>
    <td><input class="input-block-level" name="aparato_genitourinario_observ" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $aparato_genitourinario_observ ?>"/></td>
  </tr>
</table>

<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td colspan="3"><strong><em>LISTA DE PROBLEMAS</em></strong></td>
  </tr>
  <tr>
    <td style="text-align:center"><strong>LISTA DE PROBLEMAS</strong></td>
    <td style="text-align:center"><strong>LISTA MAESTRA</strong></td>
    <td style="text-align:center"><strong>DIAGNOSTICO DIFERENCIAL (DAMNVIT)</strong></td>
    <td style="text-align:center"><strong>ELIM</strong></td>
  </tr>
<?php
$tab_lista_problema       = 'tbl15_lista_problema';
$campo_lista_problema     = 'cod_lista_problema';
$tipo                     = 'eliminar';

$sql_animal = "SELECT * FROM tbl15_lista_problema WHERE cod_historia_clinica = '$cod_historia_clinica' ORDER BY cod_lista_problema ASC";
$resultado_animal = mysqli_query($conectar, $sql_animal);
while ($info_animal = mysqli_fetch_assoc($resultado_animal)) {
 	 	 
$cod_lista_problema                = $info_animal['cod_lista_problema'];
$nombre_lista_problema             = $info_animal['nombre_lista_problema'];
$nombre_lista_maestra              = $info_animal['nombre_lista_maestra'];
$nombre_diagnostico_diferencial    = $info_animal['nombre_diagnostico_diferencial'];
?>
  <tr id="tr<?php echo $cod_lista_problema;?>">
    <input class="input-block-level" name="cod_lista_problema[]" id="<?php echo $cod_lista_problema ?>" type="hidden" value="<?php echo $cod_lista_problema ?>"/>
    <td style="text-align:center" id="nombre_lista_problema<?php echo $cod_lista_problema;?>"><input class="input-block-level" name="nombre_lista_problema[]" id="<?php echo $cod_lista_problema ?>" type="text" value="<?php echo $nombre_lista_problema ?>"/></td>
    <td style="text-align:center" id="nombre_lista_maestra<?php echo $cod_lista_problema;?>"><input class="input-block-level" name="nombre_lista_maestra[]" id="<?php echo $cod_lista_problema ?>" type="text" value="<?php echo $nombre_lista_maestra ?>"/></td>
    <td style="text-align:center" id="nombre_diagnostico_diferencial<?php echo $cod_lista_problema;?>"><input class="input-block-level" name="nombre_diagnostico_diferencial[]" id="<?php echo $cod_lista_problema ?>" type="text" value="<?php echo $nombre_diagnostico_diferencial ?>"/></td>
	<td style="text-align:center" id="cod_lista_problema<?php echo $cod_lista_problema;?>" id="cod_lista_problema<?php echo $cod_lista_problema ?>" data="<?php echo $cod_lista_problema ?>"><a class="eliminar_lista_problema" id="cod_lista_problema<?php echo $cod_lista_problema ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
  </tr id="tr<?php echo $cod_lista_problema;?>">
<?php } ?>
</table>
<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td><a id="tbl15_lista_problema" href="../admin/reg_nuevo_registro_multi_hist_clinic_reg.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&tabla=tbl15_lista_problema&foco=tbl15_lista_problema&pagina=<?php echo $pagina_actual ?>"><img src="../imagenes/mas.png" class="" alt=""></a></td>
  </tr>
</table>

<br>

<table align="center" border="0" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td style="text-align:left"><strong>(D</strong>: Degenerativa &ndash; <strong>A</strong>:  Anomalía congénita &ndash; <strong>M</strong>: Metabólica &ndash; <strong>N</strong>: Nutricional y neoplásica &ndash; <strong>V</strong>:  Vascular &ndash; <strong>I: </strong>Infecciosa, inflamatoria o idiomática &ndash; <strong>T</strong>: Trauma)</td>
  </tr>
</table>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td colspan="7"><strong><em>PLAN DIAGNOSTICO</em></strong></td>
  </tr>
  <tr>
    <td style="text-align:center"><strong>EXAMEN</strong></td>

    <td style="text-align:center">
	SI<input type="radio" name="plan_diag" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag=='SI')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">AUTORIZADO 
	SI<input type="radio" name="plan_diag_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_autorizado=='SI')?'checked':'' ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><strong>FECHA</strong></td>
    <td style="text-align:center"><strong>LABORATORIO</strong></td>
    <td style="text-align:center"><strong>RESULTADOS</strong></td>
  </tr>
  <tr>
    <td style="text-align:left">Cuadro Hemático</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_cuadhemat" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_cuadhemat=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_cuadhemat" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_cuadhemat=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_cuadhemat_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_cuadhemat_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_cuadhemat_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_cuadhemat_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_cuadhemat_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_cuadhemat_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_cuadhemat_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_cuadhemat_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_cuadhemat_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_cuadhemat_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">Parcial de orina</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_parcialorina" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_parcialorina=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_parcialorina" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_parcialorina=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_parcialorina_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_parcialorina_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_parcialorina_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_parcialorina_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_parcialorina_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_parcialorina_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_parcialorina_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_parcialorina_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_parcialorina_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_parcialorina_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">Coprológico</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_coprologico" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_coprologico=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_coprologico" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_coprologico=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_coprologico_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_coprologico_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_coprologico_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_coprologico_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_coprologico_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_coprologico_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_coprologico_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_coprologico_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_coprologico_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_coprologico_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">Citología fecal</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_citologfecal" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_citologfecal=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_citologfecal" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_citologfecal=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_citologfecal_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_citologfecal_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_citologfecal_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_citologfecal_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_citologfecal_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_citologfecal_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_citologfecal_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_citologfecal_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_citologfecal_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_citologfecal_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">Citología</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_citolog" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_citolog=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_citolog" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_citolog=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_citolog_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_citolog_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_citolog_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_citolog_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_citolog_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_citolog_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_citolog_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_citolog_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_citolog_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_citolog_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">Química sanguínea: 1.</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_quimicsang1" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_quimicsang1=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_quimicsang1" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_quimicsang1=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_quimicsang1_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_quimicsang1_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_quimicsang1_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_quimicsang1_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_quimicsang1_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_quimicsang1_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_quimicsang1_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_quimicsang1_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_quimicsang1_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_quimicsang1_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">2.</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_quimicsang2" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_quimicsang2=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_quimicsang2" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_quimicsang2=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_quimicsang2_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_quimicsang2_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_quimicsang2_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_quimicsang2_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_quimicsang2_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_quimicsang2_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_quimicsang2_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_quimicsang2_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_quimicsang2_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_quimicsang2_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">3.</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_quimicsang3" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_quimicsang3=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_quimicsang3" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_quimicsang3=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_quimicsang3_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_quimicsang3_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_quimicsang3_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_quimicsang3_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_quimicsang3_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_quimicsang3_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_quimicsang3_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_quimicsang3_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_quimicsang3_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_quimicsang3_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">4.</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_quimicsang4" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_quimicsang4=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_quimicsang4" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_quimicsang4=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_quimicsang4_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_quimicsang4_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_quimicsang4_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_quimicsang4_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_quimicsang4_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_quimicsang4_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_quimicsang4_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_quimicsang4_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_quimicsang4_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_quimicsang4_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">Rayos x</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_rayx" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_rayx=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_rayx" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_rayx=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_rayx_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_rayx_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_rayx_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_rayx_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_rayx_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_rayx_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_rayx_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_rayx_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_rayx_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_rayx_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">USG</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_usg" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_usg=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_usg" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_usg=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_usg_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_usg_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_usg_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_usg_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_usg_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_usg_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_usg_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_usg_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_usg_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_usg_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">Cultivo</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_cultivo" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_cultivo=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_cultivo" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_cultivo=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_cultivo_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_cultivo_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_cultivo_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_cultivo_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_cultivo_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_cultivo_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_cultivo_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_cultivo_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_cultivo_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_cultivo_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">Antibiograma</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_antibiograma" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_antibiograma=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_antibiograma" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_antibiograma=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_antibiograma_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_antibiograma_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_antibiograma_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_antibiograma_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_antibiograma_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_antibiograma_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_antibiograma_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_antibiograma_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_antibiograma_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_antibiograma_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">Encimas Hepáticas </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_encima_hepatica" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_encima_hepatica=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_encima_hepatica" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_encima_hepatica=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_encima_hepatica_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_encima_hepatica_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_encima_hepatica_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_encima_hepatica_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_encima_hepatica_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_encima_hepatica_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_encima_hepatica_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_encima_hepatica_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_encima_hepatica_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_encima_hepatica_resul ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:left">Otro:</td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_otro" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_otro=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_otro" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_otro=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center">
	SI<input type="radio" name="plan_diag_otro_autorizado" id="<?php echo $cod_historia_clinica ?>" value="SI" <?php echo ($plan_diag_otro_autorizado=='SI')?'checked':'' ?> <?php echo $required ?>>&nbsp;&nbsp;&nbsp;
	NO<input type="radio" name="plan_diag_otro_autorizado" id="<?php echo $cod_historia_clinica ?>" value="NO" <?php echo ($plan_diag_otro_autorizado=='NO')?'checked':'' ?> >
    </td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_otro_fecha" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $plan_diag_otro_fecha ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_otro_lab" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_otro_lab ?>"/></td>
    <td style="text-align:center"><input class="input-block-level" name="plan_diag_otro_resul" id="<?php echo $cod_historia_clinica ?>" type="text" value="<?php echo $plan_diag_otro_resul ?>"/></td>
  </tr>
</table>

<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td><strong><em>INTERPRETACION DE RESULTADOS</em></strong></td>
    <td><strong><em>IMPRESIÓN DIAGNOSTICA</em></strong></td>
  </tr>
  <tr>
    <td><textarea rows="4" name="plan_diag_interpre_resul" id="<?php echo $cod_historia_clinica ?>" class="input-block-level"><?php echo ($plan_diag_interpre_resul) ?></textarea></td>
    <td><textarea rows="4" name="plan_diag_impresion_diag" id="<?php echo $cod_historia_clinica ?>" class="input-block-level"><?php echo ($plan_diag_impresion_diag) ?></textarea></td>
  </tr>
</table>

<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td colspan="10"><strong><em>PLAN TERAPEUTICO</em></strong></td>
  </tr>
  <tr>
    <td style="text-align:center"><strong>ELIM</strong></td>
    <td style="text-align:center"><strong>TS</strong></td>
    <td style="text-align:center"><strong>P</strong><strong> </strong></td>
    <td style="text-align:center"><strong>S</strong><strong> </strong></td>
    <td style="text-align:center"><strong>E</strong><strong> </strong></td>
    <!--<td style="text-align:center"><strong>COB</strong><strong> </strong></td>-->
    <td style="text-align:center"><strong>PRINCIPIO ACTIVO A ADMINISTRAR</strong></td>
    <td style="text-align:center"><strong>PRESENTACION</strong></td>
    <td style="text-align:center"><strong>POSOLOGIA (CM)</strong></td>
    <td style="text-align:center"><strong>POSOLOGIA (KG)</strong></td>
    <td style="text-align:center"><strong>DOSIS TOTAL (CM)</strong></td>
    <td style="text-align:center"><strong>VIA</strong></td>
    <td style="text-align:center"><strong>FRECUENCIA Y    DURACIÓN</strong></td>
    <td style="text-align:center"><strong>OK</strong></td>
  </tr>
<?php
$tab_plan_terapeutico     = 'tbl15_plan_terapeutico';
$campo_plan_terapeutico   = 'cod_plan_terapeutico';
$tipo                     = 'eliminar';

$sql_animal = "SELECT * FROM tbl15_plan_terapeutico WHERE cod_historia_clinica = '$cod_historia_clinica' ORDER BY cod_plan_terapeutico ASC";
$resultado_animal = mysqli_query($conectar, $sql_animal);
while ($info_animal = mysqli_fetch_assoc($resultado_animal)) {
 	 	 
$cod_plan_terapeutico                       = $info_animal['cod_plan_terapeutico'];
$plan_terapeutico_ts                        = $info_animal['plan_terapeutico_ts'];
$plan_terapeutico_p                         = $info_animal['plan_terapeutico_p'];
$plan_terapeutico_s                         = $info_animal['plan_terapeutico_s'];
$plan_terapeutico_e                         = $info_animal['plan_terapeutico_e'];
$nombre_producto                            = $info_animal['nombre_producto'];
$nombre_tipo_presentacion                   = $info_animal['nombre_tipo_presentacion'];
$posologia_cantidad                         = $info_animal['posologia_cantidad'];
$posologia_peso                             = $info_animal['posologia_peso'];
$und_producto                               = $info_animal['und_producto'];
$nombre_via_administracion                  = $info_animal['nombre_via_administracion'];
$nombre_frec_duracion                       = $info_animal['nombre_frec_duracion'];
$cod_producto                               = $info_animal['cod_producto'];
$facturar                                   = $info_animal['facturar'];
?>
  <tr>
	<input class="cod_plan_terapeutico<?php echo $cod_plan_terapeutico ?>" name="cod_plan_terapeutico[]" id="cod_plan_terapeutico__<?php echo $cod_plan_terapeutico ?>" type="hidden" value="<?php echo $cod_plan_terapeutico ?>"/>
	<td style="text-align:center" id="cod_plan_terapeutico<?php echo $cod_plan_terapeutico;?>" data="<?php echo $cod_plan_terapeutico ?>"><a class="eliminar_plan_terapeutico" id="cod_plan_terapeutico<?php echo $cod_plan_terapeutico ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
    <td style="text-align:center" id="plan_terapeutico_ts<?php echo $cod_plan_terapeutico;?>"><input class="input-block-level" name="plan_terapeutico_ts[]" id="<?php echo $cod_plan_terapeutico ?>" type="text" value="<?php echo $plan_terapeutico_ts ?>"/></td>
    <td style="text-align:center" id="plan_terapeutico_p<?php echo $cod_plan_terapeutico;?>"><input class="input-block-level" name="plan_terapeutico_p[]" id="<?php echo $cod_plan_terapeutico ?>" type="text" value="<?php echo $plan_terapeutico_p ?>"/></td>
    <td style="text-align:center" id="plan_terapeutico_s<?php echo $cod_plan_terapeutico;?>"><input class="input-block-level" name="plan_terapeutico_s[]" id="<?php echo $cod_plan_terapeutico ?>" type="text" value="<?php echo $plan_terapeutico_s ?>"/></td>
    <td style="text-align:center" id="plan_terapeutico_e<?php echo $cod_plan_terapeutico;?>"><input class="input-block-level" name="plan_terapeutico_e[]" id="<?php echo $cod_plan_terapeutico ?>" type="text" value="<?php echo $plan_terapeutico_e ?>"/></td>
	<!--<td style="text-align:center" id="facturar<?php echo $cod_plan_terapeutico;?>"><input class="facturar" name="facturar[]" id="facturar__<?php echo $cod_plan_terapeutico ?>" type='checkbox' value='1' <?php if($facturar=='1'){ echo 'checked'; } ?>></td>-->
    <td style="text-align:center" id="nombre_producto<?php echo $cod_plan_terapeutico;?>"><input class="nombre_producto" name="nombre_producto[]" id="nombre_producto__<?php echo $cod_plan_terapeutico ?>" type="text" value="<?php echo $nombre_producto ?>"/></td>
    <td style="text-align:center" id="nombre_tipo_presentacion<?php echo $cod_plan_terapeutico;?>"><input class="input-block-level" name="nombre_tipo_presentacion[]" id="<?php echo $cod_plan_terapeutico ?>" type="text" value="<?php echo $nombre_tipo_presentacion ?>"/></td>
    <td style="text-align:center" id="posologia_cantidad<?php echo $cod_plan_terapeutico;?>"><input class="input-block-level" name="posologia_cantidad[]" id="<?php echo $cod_plan_terapeutico ?>" type="text" value="<?php echo $posologia_cantidad ?>"/></td>
    <td style="text-align:center" id="posologia_peso<?php echo $cod_plan_terapeutico;?>"><input class="input-block-level" name="posologia_peso[]" id="<?php echo $cod_plan_terapeutico ?>" type="text" value="<?php echo $posologia_peso ?>"/></td>
    <td style="text-align:center" id="und_producto<?php echo $cod_plan_terapeutico;?>"><input class="input-block-level" name="und_producto[]" id="<?php echo $cod_plan_terapeutico ?>" type="text" value="<?php echo $und_producto ?>"/></td>
    <td style="text-align:center" id="nombre_via_administracion<?php echo $cod_plan_terapeutico;?>"><input class="input-block-level" name="nombre_via_administracion[]" id="<?php echo $cod_plan_terapeutico ?>" type="text" value="<?php echo $nombre_via_administracion ?>"/></td>
    <td style="text-align:center" id="nombre_frec_duracion<?php echo $cod_plan_terapeutico;?>"><input class="input-block-level" name="nombre_frec_duracion[]" id="<?php echo $cod_plan_terapeutico ?>" type="text" value="<?php echo $nombre_frec_duracion ?>"/></td>
    <td style="text-align:center" id="ok<?php echo $cod_plan_terapeutico;?>"><a href="<?php echo $pagina_actual ?>?cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&tabla=tbl15_plan_terapeutico&foco=tbl15_plan_terapeutico&pagina=<?php echo $pagina_actual ?>"><img src="../imagenes/correcto.png" class="" alt=""></a></td>
	<input class="cod_producto<?php echo $cod_plan_terapeutico ?>" name="cod_producto[]" id="cod_producto__<?php echo $cod_plan_terapeutico ?>" type="hidden" value="<?php echo $cod_producto ?>"/>
  </tr>
<?php } ?>
</table>
<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td><a id="tbl15_plan_terapeutico" href="../admin/reg_nuevo_registro_multi_hist_clinic_reg.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&tabla=tbl15_plan_terapeutico&foco=tbl15_plan_terapeutico&pagina=<?php echo $pagina_actual ?>"><img src="../imagenes/mas.png" class="" alt=""></a></td>
  </tr>
</table>
<table align="center" border="0" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td style="text-align:left">(<strong>T</strong><strong>S</strong>: Terapia de Sostén - <strong>P</strong>: Tratamiento preventivo &ndash; <strong>S</strong>: Tratamiento Sintomático &ndash; <strong>E</strong>:  Tratamiento Etiológico)
</td>
  </tr>
</table>

<table align="center" border="0" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td style="text-align:right"><strong>CONTROL (Fecha): <input name="fecha_control" id="<?php echo $cod_historia_clinica ?>" type="date" value="<?php echo $fecha_control ?>"/></strong></td>
  </tr>
</table>
<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td colspan="4"><strong><em>AUXILIARES, PASANTES O ROTANTES</em></strong></td>
  </tr>
  <tr>
    <td style="text-align:center"><strong>ELIM</strong></td>
    <td style="text-align:center"><strong>NOMBRES Y APELLIDOS</strong></td>
    <td style="text-align:center"><strong>DOCUMENTO</strong></td>
    <td style="text-align:center"><strong>SEMESTRE</strong></td>
    <td style="text-align:center"><strong>OK</strong></td>
  </tr>
<?php
$tab_auxiliar_pasante     = 'tbl15_auxiliar_pasante';
$campo_auxiliar_pasante   = 'cod_auxiliar_pasante';
$tipo                     = 'eliminar';

$sql_animal = "SELECT * FROM tbl15_auxiliar_pasante WHERE (cod_historia_clinica = '$cod_historia_clinica') ORDER BY cod_auxiliar_pasante ASC";
$resultado_animal = mysqli_query($conectar, $sql_animal);
while ($info_animal = mysqli_fetch_assoc($resultado_animal)) {
 	 	 
$cod_auxiliar_pasante              = $info_animal['cod_auxiliar_pasante'];
$nombre_auxiliar_pasante           = $info_animal['nombre_auxiliar_pasante'];
$doc_auxiliar_pasante              = $info_animal['doc_auxiliar_pasante'];
$semestre_auxiliar_pasante         = $info_animal['semestre_auxiliar_pasante'];
$url_firma_auxiliar_pasante        = $info_animal['url_firma_auxiliar_pasante'];
$cod_administrador                 = $info_animal['cod_administrador'];
?>
  <tr>
	<td style="text-align:center" style="text-align:center" id="cod_auxiliar_pasante<?php echo $cod_auxiliar_pasante;?>" data="<?php echo $cod_auxiliar_pasante ?>"><a class="eliminar_auxiliar_pasante" id="cod_auxiliar_pasante<?php echo $cod_auxiliar_pasante ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
    <input class="input-block-level" name="cod_auxiliar_pasante[]" id="<?php echo $cod_auxiliar_pasante ?>" type="hidden" value="<?php echo $cod_auxiliar_pasante ?>"/>
    <td style="text-align:center" id="nombre_auxiliar_pasante<?php echo $cod_auxiliar_pasante;?>"><input class="nombre_auxiliar_pasante" name="nombre_auxiliar_pasante[]" id="nombre_auxiliar_pasante__<?php echo $cod_auxiliar_pasante ?>" type="text" value="<?php echo $nombre_auxiliar_pasante ?>"/></td>
    <td style="text-align:center" id="doc_auxiliar_pasante<?php echo $cod_auxiliar_pasante;?>"><input class="input-block-level" name="doc_auxiliar_pasante[]" id="<?php echo $cod_auxiliar_pasante ?>" type="text" value="<?php echo $doc_auxiliar_pasante ?>"/></td>
    <td style="text-align:center" id="semestre_auxiliar_pasante<?php echo $cod_auxiliar_pasante;?>"><input class="input-block-level" name="semestre_auxiliar_pasante[]" id="<?php echo $cod_auxiliar_pasante ?>" type="text" value="<?php echo $semestre_auxiliar_pasante ?>"/></td>
    <td style="text-align:center" id="ok<?php echo $cod_auxiliar_pasante;?>"><a href="<?php echo $pagina_actual ?>?cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&tabla=tbl15_plan_terapeutico&foco=tbl15_auxiliar_pasante&pagina=<?php echo $pagina_actual ?>"><img src="../imagenes/correcto.png" class="" alt=""></a></td>
	<input class="cod_administrador<?php echo $cod_auxiliar_pasante ?>" name="cod_administrador[]" id="cod_administrador__<?php echo $cod_auxiliar_pasante ?>" type="hidden" value="<?php echo $cod_administrador ?>"/>
  </tr>
<?php } ?>
</table>
<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: <?php echo $tamano_font_emp ?>pt;">
  <tr>
    <td><a id="tbl15_auxiliar_pasante" href="../admin/reg_nuevo_registro_multi_hist_clinic_reg.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&cod_cliente=<?php echo $cod_cliente?>&tabla=tbl15_auxiliar_pasante&foco=tbl15_auxiliar_pasante&pagina=<?php echo $pagina_actual ?>"><img src="../imagenes/mas.png" class="" alt=""></a></td>
  </tr>
</table>

<br>
<?php
$sql_archivo_adjunto = "SELECT * FROM tbl15_archivo_adjunto WHERE cod_historia_clinica = '$cod_historia_clinica' ORDER BY cod_archivo_adjunto DESC";
$query_archivo_adjunto = mysqli_query($conectar, $sql_archivo_adjunto);
$existe_adjunto = mysqli_num_rows($query_archivo_adjunto);

if ($existe_adjunto <> '0') { ?>
<table class="table table-striped jambo_table bulk_action">
<thead>
<tr class="headings">
<th style="text-align:center" class="column-title">Hc</th>
<th style="text-align:center" class="column-title">TIPO</th>
<th style="text-align:center" class="column-title">NOMBRE</th>
<th style="text-align:center" class="column-title">DESCRIPCION</th>
<th style="text-align:center" class="column-title">VER</th>
<th style="text-align:center" class="column-title">FORMATO</th>
<th style="text-align:center" class="column-title">FECHA</th>
<th style="text-align:center" class="column-title">HORA</th>
<th style="text-align:center" class="column-title">ID</th>

</tr>
</thead>
<tbody>
<?php
$fecha_hoy = time();
//main query to fetch the data
while ($datos_archivo_adjunto = mysqli_fetch_array($query_archivo_adjunto)) { 	

$cod_archivo_adjunto                = $datos_archivo_adjunto['cod_archivo_adjunto'];
$nombre_archivo_adjunto             = $datos_archivo_adjunto['nombre_archivo_adjunto'];
$descripcion_archivo_adjunto        = $datos_archivo_adjunto['descripcion_archivo_adjunto'];
$nombre_tipo_certificado            = $datos_archivo_adjunto['nombre_tipo_certificado'];
$cod_cliente                        = $datos_archivo_adjunto['cod_cliente'];
$cod_empresa                        = $datos_archivo_adjunto['cod_empresa'];
$url_archivo_adjunto                = $datos_archivo_adjunto['url_archivo_adjunto'];
$fecha_creacion                     = $datos_archivo_adjunto['fecha_creacion'];
$fecha_modificacion                 = $datos_archivo_adjunto['fecha_modificacion'];
$fecha_hora                         = $datos_archivo_adjunto['fecha_hora'];
$cuenta                             = $datos_archivo_adjunto['cuenta'];
$formato                            = $datos_archivo_adjunto['formato'];
?>
<tr class="even pointer">
<td style="text-align:center"><?php echo $cod_historia_clinica?></td>
<td><?php echo $nombre_tipo_certificado?></td>
<td><?php echo $nombre_archivo_adjunto?></td>
<td><?php echo $descripcion_archivo_adjunto?></td>
<td style="text-align:center"><a href="<?php echo $url_archivo_adjunto?>" target="_blank"><img src="../imagenes/ver_peq.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:center"><?php echo $formato?></td>
<td style="text-align:center"><?php echo $fecha_creacion?></td>
<td style="text-align:center"><?php echo $fecha_hora?></td>
<td style="text-align:center"><?php echo $cod_archivo_adjunto?></td>
</tr>
<?php } ?>
</tr>
</table>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>"/>
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>"/>
<input type="hidden" name="fecha_dmy" value="<?php echo $fecha_hoy ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#fecha_ymd_hora').datetimepicker({ format: 'yyyy/MM/dd hh:mm:ss', language: 'es' });</script>
<script type="text/javascript">$('#fecha_nac_ymd').datetimepicker({ format: 'yyyy/MM/dd', language: 'es' });</script>

<script src="js/funcion_select_dependiente_area_cargo_ajax.js"></script>

<script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="../js/jquery-ui.js"></script>

<script type="text/javascript">
$(function(){
  $("#guardar_area_y_cargo").click(function(){
    window.location.reload();
  });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $('#activar_area_y_cargo').on('change',function(){
  	 if (this.checked) {
     $("#nombre_grupo_area_nuevo").show();
     $("#nombre_grupo_area_cargo_nuevo").show();
     $("#guardar_area_y_cargo").show();
     $("#cod_grupo_area_cargo").hide();
    } else {
     $("#nombre_grupo_area_nuevo").hide();
     $("#nombre_grupo_area_cargo_nuevo").hide();
     $("#guardar_area_y_cargo").hide();
     $("#cod_grupo_area_cargo").show();
    }  
  })
});
</script>

<script type="text/javascript">
$(function() {
$("#nombre_grupo_area").autocomplete({
source: "autocompletar_grupo_area_ajax.php",
minLength: 1,
select: function(event, ui) {
event.preventDefault();

$('#cod_grupo_area').val(ui.item.cod_grupo_area);
$('#nombre_grupo_area').val(ui.item.nombre_grupo_area);

}
});
});
</script>


<script type="text/javascript">
$(function() {
$("#cod_grupo_area_cargo").autocomplete({
source: "autocompletar_grupo_area_cargo_ajax.php",
minLength: 1,
select: function(event, ui) {
event.preventDefault();

$('#cod_grupo_area_cargo').val(ui.item.cod_grupo_area_cargo);
$('#nombre_grupo_area_cargo').val(ui.item.nombre_grupo_area_cargo);
$('#cod_grupo_area').val(ui.item.cod_grupo_area);

$('#clasrieg_fis1_ruid').val(ui.item.clasrieg_fis1_ruid);
$('#clasrieg_fis1_ilum').val(ui.item.clasrieg_fis1_ilum);
$('#clasrieg_fis1_noionic').val(ui.item.clasrieg_fis1_noionic);
$('#clasrieg_fis1_vibra').val(ui.item.clasrieg_fis1_vibra);
$('#clasrieg_fis1_tempextrem').val(ui.item.clasrieg_fis1_tempextrem);
$('#clasrieg_fis1_cambpres').val(ui.item.clasrieg_fis1_cambpres);
$('#clasrieg_quim1_gasvapor').val(ui.item.clasrieg_quim1_gasvapor);
$('#clasrieg_quim1_aeroliq').val(ui.item.clasrieg_quim1_aeroliq);
$('#clasrieg_quim1_solid').val(ui.item.clasrieg_quim1_solid);
$('#clasrieg_quim1_liquid').val(ui.item.clasrieg_quim1_liquid);
$('#clasrieg_biolog1_viru').val(ui.item.clasrieg_biolog1_viru);
$('#clasrieg_biolog1_bacter').val(ui.item.clasrieg_biolog1_bacter);
$('#clasrieg_biolog1_parasi').val(ui.item.clasrieg_biolog1_parasi);
$('#clasrieg_biolog1_morde').val(ui.item.clasrieg_biolog1_morde);
$('#clasrieg_biolog1_picad').val(ui.item.clasrieg_biolog1_picad);
$('#clasrieg_biolog1_hongo').val(ui.item.clasrieg_biolog1_hongo);
$('#clasrieg_ergo1_trabestat').val(ui.item.clasrieg_ergo1_trabestat);
$('#clasrieg_ergo1_esfuerfis').val(ui.item.clasrieg_ergo1_esfuerfis);
$('#clasrieg_ergo1_carga').val(ui.item.clasrieg_ergo1_carga);
$('#clasrieg_ergo1_postforz').val(ui.item.clasrieg_ergo1_postforz);
$('#clasrieg_ergo1_movrepet').val(ui.item.clasrieg_ergo1_movrepet);
$('#clasrieg_ergo1_jortrab').val(ui.item.clasrieg_ergo1_jortrab);
$('#clasrieg_psi1_monoto').val(ui.item.clasrieg_psi1_monoto);
$('#clasrieg_psi1_relhuman').val(ui.item.clasrieg_psi1_relhuman);
$('#clasrieg_psi1_contentarea').val(ui.item.clasrieg_psi1_contentarea);
$('#clasrieg_psi1_orgtiemptrab').val(ui.item.clasrieg_psi1_orgtiemptrab);
$('#clasrieg_segur1_mecanic').val(ui.item.clasrieg_segur1_mecanic);
$('#clasrieg_segur1_electri').val(ui.item.clasrieg_segur1_electri);
$('#clasrieg_segur1_locat').val(ui.item.clasrieg_segur1_locat);
$('#clasrieg_segur1_fisiquim').val(ui.item.clasrieg_segur1_fisiquim);
$('#clasrieg_segur1_public').val(ui.item.clasrieg_segur1_public);
$('#clasrieg_segur1_espconfi').val(ui.item.clasrieg_segur1_espconfi);
$('#clasrieg_segur1_trabaltura').val(ui.item.clasrieg_segur1_trabaltura);
$('#clasrieg_observ1_otro').val(ui.item.clasrieg_observ1_otro);

$('#clasrieg_segur1_sismo').val(ui.item.clasrieg_segur1_sismo);
$('#clasrieg_segur1_delincuenciacomun').val(ui.item.clasrieg_segur1_delincuenciacomun);
$('#clasrieg_segur1_accitransito').val(ui.item.clasrieg_segur1_accitransito);
$('#clasrieg_segur1_caidaobjetos').val(ui.item.clasrieg_segur1_caidaobjetos);
$('#clasrieg_segur1_puestotrabdesorden').val(ui.item.clasrieg_segur1_puestotrabdesorden);

$('#dat_ocupa_visu1').val(ui.item.dat_ocupa_visu1);
$('#dat_ocupa_audi1').val(ui.item.dat_ocupa_audi1);
$('#dat_ocupa_resp1').val(ui.item.dat_ocupa_resp1);
$('#dat_ocupa_cabeza1').val(ui.item.dat_ocupa_cabeza1);
$('#dat_ocupa_manos1').val(ui.item.dat_ocupa_manos1);
$('#dat_ocupa_tronco1').val(ui.item.dat_ocupa_tronco1);
$('#dat_ocupa_pies1').val(ui.item.dat_ocupa_pies1);
$('#dat_ocupa_altu1').val(ui.item.dat_ocupa_altu1);

var clasrieg_fis1_ruid = $('#clasrieg_fis1_ruid').val();
var clasrieg_fis1_ilum = $('#clasrieg_fis1_ilum').val();
var clasrieg_fis1_noionic = $('#clasrieg_fis1_noionic').val();
var clasrieg_fis1_vibra = $('#clasrieg_fis1_vibra').val();
var clasrieg_fis1_tempextrem = $('#clasrieg_fis1_tempextrem').val();
var clasrieg_fis1_cambpres = $('#clasrieg_fis1_cambpres').val();
var clasrieg_quim1_gasvapor = $('#clasrieg_quim1_gasvapor').val();
var clasrieg_quim1_aeroliq = $('#clasrieg_quim1_aeroliq').val();
var clasrieg_quim1_solid = $('#clasrieg_quim1_solid').val();
var clasrieg_quim1_liquid = $('#clasrieg_quim1_liquid').val();
var clasrieg_biolog1_viru = $('#clasrieg_biolog1_viru').val();
var clasrieg_biolog1_bacter = $('#clasrieg_biolog1_bacter').val();
var clasrieg_biolog1_parasi = $('#clasrieg_biolog1_parasi').val();
var clasrieg_biolog1_morde = $('#clasrieg_biolog1_morde').val();
var clasrieg_biolog1_picad = $('#clasrieg_biolog1_picad').val();
var clasrieg_biolog1_hongo = $('#clasrieg_biolog1_hongo').val();
var clasrieg_ergo1_trabestat = $('#clasrieg_ergo1_trabestat').val();
var clasrieg_ergo1_esfuerfis = $('#clasrieg_ergo1_esfuerfis').val();
var clasrieg_ergo1_carga = $('#clasrieg_ergo1_carga').val();
var clasrieg_ergo1_postforz = $('#clasrieg_ergo1_postforz').val();
var clasrieg_ergo1_movrepet = $('#clasrieg_ergo1_movrepet').val();
var clasrieg_ergo1_jortrab = $('#clasrieg_ergo1_jortrab').val();
var clasrieg_psi1_monoto = $('#clasrieg_psi1_monoto').val();
var clasrieg_psi1_relhuman = $('#clasrieg_psi1_relhuman').val();
var clasrieg_psi1_contentarea = $('#clasrieg_psi1_contentarea').val();
var clasrieg_psi1_orgtiemptrab = $('#clasrieg_psi1_orgtiemptrab').val();
var clasrieg_segur1_mecanic = $('#clasrieg_segur1_mecanic').val();
var clasrieg_segur1_electri = $('#clasrieg_segur1_electri').val();
var clasrieg_segur1_locat = $('#clasrieg_segur1_locat').val();
var clasrieg_segur1_fisiquim = $('#clasrieg_segur1_fisiquim').val();
var clasrieg_segur1_public = $('#clasrieg_segur1_public').val();
var clasrieg_segur1_espconfi = $('#clasrieg_segur1_espconfi').val();
var clasrieg_segur1_trabaltura = $('#clasrieg_segur1_trabaltura').val();
var clasrieg_observ1_otro = $('#clasrieg_observ1_otro').val();

var clasrieg_segur1_sismo = $('#clasrieg_segur1_sismo').val();
var clasrieg_segur1_delincuenciacomun = $('#clasrieg_segur1_delincuenciacomun').val();
var clasrieg_segur1_accitransito = $('#clasrieg_segur1_accitransito').val();
var clasrieg_segur1_caidaobjetos = $('#clasrieg_segur1_caidaobjetos').val();
var clasrieg_segur1_puestotrabdesorden = $('#clasrieg_segur1_puestotrabdesorden').val();

var dat_ocupa_visu1 = $('#dat_ocupa_visu1').val();
var dat_ocupa_audi1 = $('#dat_ocupa_audi1').val();
var dat_ocupa_resp1 = $('#dat_ocupa_resp1').val();
var dat_ocupa_cabeza1 = $('#dat_ocupa_cabeza1').val();
var dat_ocupa_manos1 = $('#dat_ocupa_manos1').val();
var dat_ocupa_tronco1 = $('#dat_ocupa_tronco1').val();
var dat_ocupa_pies1 = $('#dat_ocupa_pies1').val();
var dat_ocupa_altu1 = $('#dat_ocupa_altu1').val();

if (clasrieg_fis1_ruid=='S') { $('#clasrieg_fis1_ruid').val('S'); $('#clasrieg_fis1_ruid').prop('checked',true); } else { $('#clasrieg_fis1_ruid').val('N'); $('#clasrieg_fis1_ruid').prop('checked',false); } 
if (clasrieg_fis1_ilum=='S') { $('#clasrieg_fis1_ilum').val('S'); $('#clasrieg_fis1_ilum').prop('checked',true); } else { $('#clasrieg_fis1_ilum').val('N'); $('#clasrieg_fis1_ilum').prop('checked',false); } 
if (clasrieg_fis1_noionic=='S') { $('#clasrieg_fis1_noionic').val('S'); $('#clasrieg_fis1_noionic').prop('checked',true); } else { $('#clasrieg_fis1_noionic').val('N'); $('#clasrieg_fis1_noionic').prop('checked',false); } 
if (clasrieg_fis1_vibra=='S') { $('#clasrieg_fis1_vibra').val('S'); $('#clasrieg_fis1_vibra').prop('checked',true); } else { $('#clasrieg_fis1_vibra').val('N'); $('#clasrieg_fis1_vibra').prop('checked',false); } 
if (clasrieg_fis1_tempextrem=='S') { $('#clasrieg_fis1_tempextrem').val('S'); $('#clasrieg_fis1_tempextrem').prop('checked',true); } else { $('#clasrieg_fis1_tempextrem').val('N'); $('#clasrieg_fis1_tempextrem').prop('checked',false); } 
if (clasrieg_fis1_cambpres=='S') { $('#clasrieg_fis1_cambpres').val('S'); $('#clasrieg_fis1_cambpres').prop('checked',true); } else { $('#clasrieg_fis1_cambpres').val('N'); $('#clasrieg_fis1_cambpres').prop('checked',false); } 
if (clasrieg_quim1_gasvapor=='S') { $('#clasrieg_quim1_gasvapor').val('S'); $('#clasrieg_quim1_gasvapor').prop('checked',true); } else { $('#clasrieg_quim1_gasvapor').val('N'); $('#clasrieg_quim1_gasvapor').prop('checked',false); } 
if (clasrieg_quim1_aeroliq=='S') { $('#clasrieg_quim1_aeroliq').val('S'); $('#clasrieg_quim1_aeroliq').prop('checked',true); } else { $('#clasrieg_quim1_aeroliq').val('N'); $('#clasrieg_quim1_aeroliq').prop('checked',false); } 
if (clasrieg_quim1_solid=='S') { $('#clasrieg_quim1_solid').val('S'); $('#clasrieg_quim1_solid').prop('checked',true); } else { $('#clasrieg_quim1_solid').val('N'); $('#clasrieg_quim1_solid').prop('checked',false); } 
if (clasrieg_quim1_liquid=='S') { $('#clasrieg_quim1_liquid').val('S'); $('#clasrieg_quim1_liquid').prop('checked',true); } else { $('#clasrieg_quim1_liquid').val('N'); $('#clasrieg_quim1_liquid').prop('checked',false); } 
if (clasrieg_biolog1_viru=='S') { $('#clasrieg_biolog1_viru').val('S'); $('#clasrieg_biolog1_viru').prop('checked',true); } else { $('#clasrieg_biolog1_viru').val('N'); $('#clasrieg_biolog1_viru').prop('checked',false); } 
if (clasrieg_biolog1_bacter=='S') { $('#clasrieg_biolog1_bacter').val('S'); $('#clasrieg_biolog1_bacter').prop('checked',true); } else { $('#clasrieg_biolog1_bacter').val('N'); $('#clasrieg_biolog1_bacter').prop('checked',false); } 
if (clasrieg_biolog1_parasi=='S') { $('#clasrieg_biolog1_parasi').val('S'); $('#clasrieg_biolog1_parasi').prop('checked',true); } else { $('#clasrieg_biolog1_parasi').val('N'); $('#clasrieg_biolog1_parasi').prop('checked',false); } 
if (clasrieg_biolog1_morde=='S') { $('#clasrieg_biolog1_morde').val('S'); $('#clasrieg_biolog1_morde').prop('checked',true); } else { $('#clasrieg_biolog1_morde').val('N'); $('#clasrieg_biolog1_morde').prop('checked',false); } 
if (clasrieg_biolog1_picad=='S') { $('#clasrieg_biolog1_picad').val('S'); $('#clasrieg_biolog1_picad').prop('checked',true); } else { $('#clasrieg_biolog1_picad').val('N'); $('#clasrieg_biolog1_picad').prop('checked',false); } 
if (clasrieg_biolog1_hongo=='S') { $('#clasrieg_biolog1_hongo').val('S'); $('#clasrieg_biolog1_hongo').prop('checked',true); } else { $('#clasrieg_biolog1_hongo').val('N'); $('#clasrieg_biolog1_hongo').prop('checked',false); } 
if (clasrieg_ergo1_trabestat=='S') { $('#clasrieg_ergo1_trabestat').val('S'); $('#clasrieg_ergo1_trabestat').prop('checked',true); } else { $('#clasrieg_ergo1_trabestat').val('N'); $('#clasrieg_ergo1_trabestat').prop('checked',false); } 
if (clasrieg_ergo1_esfuerfis=='S') { $('#clasrieg_ergo1_esfuerfis').val('S'); $('#clasrieg_ergo1_esfuerfis').prop('checked',true); } else { $('#clasrieg_ergo1_esfuerfis').val('N'); $('#clasrieg_ergo1_esfuerfis').prop('checked',false); } 
if (clasrieg_ergo1_carga=='S') { $('#clasrieg_ergo1_carga').val('S'); $('#clasrieg_ergo1_carga').prop('checked',true); } else { $('#clasrieg_ergo1_carga').val('N'); $('#clasrieg_ergo1_carga').prop('checked',false); } 
if (clasrieg_ergo1_postforz=='S') { $('#clasrieg_ergo1_postforz').val('S'); $('#clasrieg_ergo1_postforz').prop('checked',true); } else { $('#clasrieg_ergo1_postforz').val('N'); $('#clasrieg_ergo1_postforz').prop('checked',false); } 
if (clasrieg_ergo1_movrepet=='S') { $('#clasrieg_ergo1_movrepet').val('S'); $('#clasrieg_ergo1_movrepet').prop('checked',true); } else { $('#clasrieg_ergo1_movrepet').val('N'); $('#clasrieg_ergo1_movrepet').prop('checked',false); } 
if (clasrieg_ergo1_jortrab=='S') { $('#clasrieg_ergo1_jortrab').val('S'); $('#clasrieg_ergo1_jortrab').prop('checked',true); } else { $('#clasrieg_ergo1_jortrab').val('N'); $('#clasrieg_ergo1_jortrab').prop('checked',false); } 
if (clasrieg_psi1_monoto=='S') { $('#clasrieg_psi1_monoto').val('S'); $('#clasrieg_psi1_monoto').prop('checked',true); } else { $('#clasrieg_psi1_monoto').val('N'); $('#clasrieg_psi1_monoto').prop('checked',false); } 
if (clasrieg_psi1_relhuman=='S') { $('#clasrieg_psi1_relhuman').val('S'); $('#clasrieg_psi1_relhuman').prop('checked',true); } else { $('#clasrieg_psi1_relhuman').val('N'); $('#clasrieg_psi1_relhuman').prop('checked',false); } 
if (clasrieg_psi1_contentarea=='S') { $('#clasrieg_psi1_contentarea').val('S'); $('#clasrieg_psi1_contentarea').prop('checked',true); } else { $('#clasrieg_psi1_contentarea').val('N'); $('#clasrieg_psi1_contentarea').prop('checked',false); } 
if (clasrieg_psi1_orgtiemptrab=='S') { $('#clasrieg_psi1_orgtiemptrab').val('S'); $('#clasrieg_psi1_orgtiemptrab').prop('checked',true); } else { $('#clasrieg_psi1_orgtiemptrab').val('N'); $('#clasrieg_psi1_orgtiemptrab').prop('checked',false); } 
if (clasrieg_segur1_mecanic=='S') { $('#clasrieg_segur1_mecanic').val('S'); $('#clasrieg_segur1_mecanic').prop('checked',true); } else { $('#clasrieg_segur1_mecanic').val('N'); $('#clasrieg_segur1_mecanic').prop('checked',false); } 
if (clasrieg_segur1_electri=='S') { $('#clasrieg_segur1_electri').val('S'); $('#clasrieg_segur1_electri').prop('checked',true); } else { $('#clasrieg_segur1_electri').val('N'); $('#clasrieg_segur1_electri').prop('checked',false); } 
if (clasrieg_segur1_locat=='S') { $('#clasrieg_segur1_locat').val('S'); $('#clasrieg_segur1_locat').prop('checked',true); } else { $('#clasrieg_segur1_locat').val('N'); $('#clasrieg_segur1_locat').prop('checked',false); } 
if (clasrieg_segur1_fisiquim=='S') { $('#clasrieg_segur1_fisiquim').val('S'); $('#clasrieg_segur1_fisiquim').prop('checked',true); } else { $('#clasrieg_segur1_fisiquim').val('N'); $('#clasrieg_segur1_fisiquim').prop('checked',false); } 
if (clasrieg_segur1_public=='S') { $('#clasrieg_segur1_public').val('S'); $('#clasrieg_segur1_public').prop('checked',true); } else { $('#clasrieg_segur1_public').val('N'); $('#clasrieg_segur1_public').prop('checked',false); } 
if (clasrieg_segur1_espconfi=='S') { $('#clasrieg_segur1_espconfi').val('S'); $('#clasrieg_segur1_espconfi').prop('checked',true); } else { $('#clasrieg_segur1_espconfi').val('N'); $('#clasrieg_segur1_espconfi').prop('checked',false); } 
if (clasrieg_segur1_trabaltura=='S') { $('#clasrieg_segur1_trabaltura').val('S'); $('#clasrieg_segur1_trabaltura').prop('checked',true); } else { $('#clasrieg_segur1_trabaltura').val('N'); $('#clasrieg_segur1_trabaltura').prop('checked',false); } 
if (clasrieg_observ1_otro=='S') { $('#clasrieg_observ1_otro').val('S'); $('#clasrieg_observ1_otro').prop('checked',true); } else { $('#clasrieg_observ1_otro').val('N'); $('#clasrieg_observ1_otro').prop('checked',false); } 

if (clasrieg_segur1_sismo=='S') { $('#clasrieg_segur1_sismo').val('S'); $('#clasrieg_segur1_sismo').prop('checked',true); } else { $('#clasrieg_segur1_sismo').val('N'); $('#clasrieg_segur1_sismo').prop('checked',false); } 
if (clasrieg_segur1_delincuenciacomun=='S') { $('#clasrieg_segur1_delincuenciacomun').val('S'); $('#clasrieg_segur1_delincuenciacomun').prop('checked',true); } else { $('#clasrieg_segur1_delincuenciacomun').val('N'); $('#clasrieg_segur1_delincuenciacomun').prop('checked',false); } 
if (clasrieg_segur1_accitransito=='S') { $('#clasrieg_segur1_accitransito').val('S'); $('#clasrieg_segur1_accitransito').prop('checked',true); } else { $('#clasrieg_segur1_accitransito').val('N'); $('#clasrieg_segur1_accitransito').prop('checked',false); } 
if (clasrieg_segur1_caidaobjetos=='S') { $('#clasrieg_segur1_caidaobjetos').val('S'); $('#clasrieg_segur1_caidaobjetos').prop('checked',true); } else { $('#clasrieg_segur1_caidaobjetos').val('N'); $('#clasrieg_segur1_caidaobjetos').prop('checked',false); } 
if (clasrieg_segur1_puestotrabdesorden=='S') { $('#clasrieg_segur1_puestotrabdesorden').val('S'); $('#clasrieg_segur1_puestotrabdesorden').prop('checked',true); } else { $('#clasrieg_segur1_puestotrabdesorden').val('N'); $('#clasrieg_segur1_puestotrabdesorden').prop('checked',false); } 

if (dat_ocupa_visu1=='S') { $('#dat_ocupa_visu1').val('S'); $('#dat_ocupa_visu1').prop('checked',true); } else { $('#dat_ocupa_visu1').val('N'); $('#dat_ocupa_visu1').prop('checked',false); } 
if (dat_ocupa_audi1=='S') { $('#dat_ocupa_audi1').val('S'); $('#dat_ocupa_audi1').prop('checked',true); } else { $('#dat_ocupa_audi1').val('N'); $('#dat_ocupa_audi1').prop('checked',false); } 
if (dat_ocupa_resp1=='S') { $('#dat_ocupa_resp1').val('S'); $('#dat_ocupa_resp1').prop('checked',true); } else { $('#dat_ocupa_resp1').val('N'); $('#dat_ocupa_resp1').prop('checked',false); } 
if (dat_ocupa_cabeza1=='S') { $('#dat_ocupa_cabeza1').val('S'); $('#dat_ocupa_cabeza1').prop('checked',true); } else { $('#dat_ocupa_cabeza1').val('N'); $('#dat_ocupa_cabeza1').prop('checked',false); } 
if (dat_ocupa_manos1=='S') { $('#dat_ocupa_manos1').val('S'); $('#dat_ocupa_manos1').prop('checked',true); } else { $('#dat_ocupa_manos1').val('N'); $('#dat_ocupa_manos1').prop('checked',false); } 
if (dat_ocupa_tronco1=='S') { $('#dat_ocupa_tronco1').val('S'); $('#dat_ocupa_tronco1').prop('checked',true); } else { $('#dat_ocupa_tronco1').val('N'); $('#dat_ocupa_tronco1').prop('checked',false); } 
if (dat_ocupa_pies1=='S') { $('#dat_ocupa_pies1').val('S'); $('#dat_ocupa_pies1').prop('checked',true); } else { $('#dat_ocupa_pies1').val('N'); $('#dat_ocupa_pies1').prop('checked',false); } 
if (dat_ocupa_altu1=='S') { $('#dat_ocupa_altu1').val('S'); $('#dat_ocupa_altu1').prop('checked',true); } else { $('#dat_ocupa_altu1').val('N'); $('#dat_ocupa_altu1').prop('checked',false); } 
}
});
});
</script>

<script>  
 $(document).ready(function(){ 
/* -------------------------------------------------------------------------------------------------------------- */
$(".dat_ocupa_visu1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_visu1").val("S"); } else {	$(".dat_ocupa_visu1").val("N"); } });
$(".dat_ocupa_audi1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_audi1").val("S"); } else {	$(".dat_ocupa_audi1").val("N"); } });
$(".dat_ocupa_altu1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_altu1").val("S"); } else {	$(".dat_ocupa_altu1").val("N"); } });
$(".dat_ocupa_resp1").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_resp1").val("S"); } else {	$(".dat_ocupa_resp1").val("N"); } });
$(".dat_ocupa_visu2").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_visu2").val("S"); } else {	$(".dat_ocupa_visu2").val("N"); } });
$(".dat_ocupa_audi2").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_audi2").val("S"); } else {	$(".dat_ocupa_audi2").val("N"); } });
$(".dat_ocupa_altu2").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_altu2").val("S"); } else {	$(".dat_ocupa_altu2").val("N"); } });
$(".dat_ocupa_resp2").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_resp2").val("S"); } else {	$(".dat_ocupa_resp2").val("N"); } });
$(".dat_ocupa_visu3").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_visu3").val("S"); } else {	$(".dat_ocupa_visu3").val("N"); } });
$(".dat_ocupa_audi3").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_audi3").val("S"); } else {	$(".dat_ocupa_audi3").val("N"); } });
$(".dat_ocupa_altu3").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_altu3").val("S"); } else {	$(".dat_ocupa_altu3").val("N"); } });
$(".dat_ocupa_resp3").change(function(){ if( $(this).is(':checked') ){ $(".dat_ocupa_resp3").val("S"); } else {	$(".dat_ocupa_resp3").val("N"); } });
/* -------------------------------------------------------------------------------------------------------------- */
$(".clasrieg_fis1_ruid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_ruid").val("S"); } else {	$(".clasrieg_fis1_ruid").val("N"); } });
$(".clasrieg_fis1_ilum").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_ilum").val("S"); } else {	$(".clasrieg_fis1_ilum").val("N"); } });
$(".clasrieg_fis1_noionic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_noionic").val("S"); } else {	$(".clasrieg_fis1_noionic").val("N"); } });
$(".clasrieg_fis1_vibra").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_vibra").val("S"); } else {	$(".clasrieg_fis1_vibra").val("N"); } });
$(".clasrieg_fis1_tempextrem").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_tempextrem").val("S"); } else {	$(".clasrieg_fis1_tempextrem").val("N"); } });
$(".clasrieg_fis1_cambpres").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis1_cambpres").val("S"); } else {	$(".clasrieg_fis1_cambpres").val("N"); } });
$(".clasrieg_quim1_gasvapor").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim1_gasvapor").val("S"); } else {	$(".clasrieg_quim1_gasvapor").val("N"); } });
$(".clasrieg_quim1_aeroliq").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim1_aeroliq").val("S"); } else {	$(".clasrieg_quim1_aeroliq").val("N"); } });
$(".clasrieg_quim1_solid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim1_solid").val("S"); } else {	$(".clasrieg_quim1_solid").val("N"); } });
$(".clasrieg_quim1_liquid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim1_liquid").val("S"); } else {	$(".clasrieg_quim1_liquid").val("N"); } });
$(".clasrieg_biolog1_viru").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_viru").val("S"); } else {	$(".clasrieg_biolog1_viru").val("N"); } });
$(".clasrieg_biolog1_bacter").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_bacter").val("S"); } else {	$(".clasrieg_biolog1_bacter").val("N"); } });
$(".clasrieg_biolog1_parasi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_parasi").val("S"); } else {	$(".clasrieg_biolog1_parasi").val("N"); } });
$(".clasrieg_biolog1_morde").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_morde").val("S"); } else {	$(".clasrieg_biolog1_morde").val("N"); } });
$(".clasrieg_biolog1_picad").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_picad").val("S"); } else {	$(".clasrieg_biolog1_picad").val("N"); } });
$(".clasrieg_biolog1_hongo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog1_hongo").val("S"); } else {	$(".clasrieg_biolog1_hongo").val("N"); } });
$(".clasrieg_ergo1_trabestat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_trabestat").val("S"); } else {	$(".clasrieg_ergo1_trabestat").val("N"); } });
$(".clasrieg_ergo1_esfuerfis").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_esfuerfis").val("S"); } else {	$(".clasrieg_ergo1_esfuerfis").val("N"); } });
$(".clasrieg_ergo1_carga").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_carga").val("S"); } else {	$(".clasrieg_ergo1_carga").val("N"); } });
$(".clasrieg_ergo1_postforz").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_postforz").val("S"); } else {	$(".clasrieg_ergo1_postforz").val("N"); } });
$(".clasrieg_ergo1_movrepet").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_movrepet").val("S"); } else {	$(".clasrieg_ergo1_movrepet").val("N"); } });
$(".clasrieg_ergo1_jortrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo1_jortrab").val("S"); } else {	$(".clasrieg_ergo1_jortrab").val("N"); } });
$(".clasrieg_psi1_monoto").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi1_monoto").val("S"); } else {	$(".clasrieg_psi1_monoto").val("N"); } });
$(".clasrieg_psi1_relhuman").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi1_relhuman").val("S"); } else {	$(".clasrieg_psi1_relhuman").val("N"); } });
$(".clasrieg_psi1_contentarea").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi1_contentarea").val("S"); } else {	$(".clasrieg_psi1_contentarea").val("N"); } });
$(".clasrieg_psi1_orgtiemptrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi1_orgtiemptrab").val("S"); } else {	$(".clasrieg_psi1_orgtiemptrab").val("N"); } });
$(".clasrieg_segur1_mecanic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_mecanic").val("S"); } else {	$(".clasrieg_segur1_mecanic").val("N"); } });
$(".clasrieg_segur1_electri").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_electri").val("S"); } else {	$(".clasrieg_segur1_electri").val("N"); } });
$(".clasrieg_segur1_locat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_locat").val("S"); } else {	$(".clasrieg_segur1_locat").val("N"); } });
$(".clasrieg_segur1_fisiquim").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_fisiquim").val("S"); } else {	$(".clasrieg_segur1_fisiquim").val("N"); } });
$(".clasrieg_segur1_public").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_public").val("S"); } else {	$(".clasrieg_segur1_public").val("N"); } });
$(".clasrieg_segur1_espconfi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_espconfi").val("S"); } else {	$(".clasrieg_segur1_espconfi").val("N"); } });
$(".clasrieg_segur1_trabaltura").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_trabaltura").val("S"); } else {	$(".clasrieg_segur1_trabaltura").val("N"); } });
$(".clasrieg_segur1_sismo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_sismo").val("S"); } else {   $(".clasrieg_segur1_sismo").val("N"); } });
$(".clasrieg_segur1_delincuenciacomun").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_delincuenciacomun").val("S"); } else {   $(".clasrieg_segur1_delincuenciacomun").val("N"); } });
$(".clasrieg_segur1_accitransito").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_accitransito").val("S"); } else {   $(".clasrieg_segur1_accitransito").val("N"); } });
$(".clasrieg_segur1_caidaobjetos").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_caidaobjetos").val("S"); } else {   $(".clasrieg_segur1_caidaobjetos").val("N"); } });
$(".clasrieg_segur1_puestotrabdesorden").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur1_puestotrabdesorden").val("S"); } else {   $(".clasrieg_segur1_puestotrabdesorden").val("N"); } });
$(".clasrieg_observ1_otro").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_observ1_otro").val("S"); } else {	$(".clasrieg_observ1_otro").val("N"); } });
$(".clasrieg_fis2_ruid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis2_ruid").val("S"); } else {	$(".clasrieg_fis2_ruid").val("N"); } });
$(".clasrieg_fis2_ilum").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis2_ilum").val("S"); } else {	$(".clasrieg_fis2_ilum").val("N"); } });
$(".clasrieg_fis2_noionic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis2_noionic").val("S"); } else {	$(".clasrieg_fis2_noionic").val("N"); } });
$(".clasrieg_fis2_vibra").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis2_vibra").val("S"); } else {	$(".clasrieg_fis2_vibra").val("N"); } });
$(".clasrieg_fis2_tempextrem").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis2_tempextrem").val("S"); } else {	$(".clasrieg_fis2_tempextrem").val("N"); } });
$(".clasrieg_fis2_cambpres").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis2_cambpres").val("S"); } else {	$(".clasrieg_fis2_cambpres").val("N"); } });
$(".clasrieg_quim2_gasvapor").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim2_gasvapor").val("S"); } else {	$(".clasrieg_quim2_gasvapor").val("N"); } });
$(".clasrieg_quim2_aeroliq").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim2_aeroliq").val("S"); } else {	$(".clasrieg_quim2_aeroliq").val("N"); } });
$(".clasrieg_quim2_solid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim2_solid").val("S"); } else {	$(".clasrieg_quim2_solid").val("N"); } });
$(".clasrieg_quim2_liquid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim2_liquid").val("S"); } else {	$(".clasrieg_quim2_liquid").val("N"); } });
$(".clasrieg_biolog2_viru").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog2_viru").val("S"); } else {	$(".clasrieg_biolog2_viru").val("N"); } });
$(".clasrieg_biolog2_bacter").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog2_bacter").val("S"); } else {	$(".clasrieg_biolog2_bacter").val("N"); } });
$(".clasrieg_biolog2_parasi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog2_parasi").val("S"); } else {	$(".clasrieg_biolog2_parasi").val("N"); } });
$(".clasrieg_biolog2_morde").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog2_morde").val("S"); } else {	$(".clasrieg_biolog2_morde").val("N"); } });
$(".clasrieg_biolog2_picad").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog2_picad").val("S"); } else {	$(".clasrieg_biolog2_picad").val("N"); } });
$(".clasrieg_biolog2_hongo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog2_hongo").val("S"); } else {	$(".clasrieg_biolog2_hongo").val("N"); } });
$(".clasrieg_ergo2_trabestat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo2_trabestat").val("S"); } else {	$(".clasrieg_ergo2_trabestat").val("N"); } });
$(".clasrieg_ergo2_esfuerfis").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo2_esfuerfis").val("S"); } else {	$(".clasrieg_ergo2_esfuerfis").val("N"); } });
$(".clasrieg_ergo2_carga").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo2_carga").val("S"); } else {	$(".clasrieg_ergo2_carga").val("N"); } });
$(".clasrieg_ergo2_postforz").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo2_postforz").val("S"); } else {	$(".clasrieg_ergo2_postforz").val("N"); } });
$(".clasrieg_ergo2_movrepet").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo2_movrepet").val("S"); } else {	$(".clasrieg_ergo2_movrepet").val("N"); } });
$(".clasrieg_ergo2_jortrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo2_jortrab").val("S"); } else {	$(".clasrieg_ergo2_jortrab").val("N"); } });
$(".clasrieg_psi2_monoto").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi2_monoto").val("S"); } else {	$(".clasrieg_psi2_monoto").val("N"); } });
$(".clasrieg_psi2_relhuman").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi2_relhuman").val("S"); } else {	$(".clasrieg_psi2_relhuman").val("N"); } });
$(".clasrieg_psi2_contentarea").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi2_contentarea").val("S"); } else {	$(".clasrieg_psi2_contentarea").val("N"); } });
$(".clasrieg_psi2_orgtiemptrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi2_orgtiemptrab").val("S"); } else {	$(".clasrieg_psi2_orgtiemptrab").val("N"); } });
$(".clasrieg_segur2_mecanic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_mecanic").val("S"); } else {	$(".clasrieg_segur2_mecanic").val("N"); } });
$(".clasrieg_segur2_electri").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_electri").val("S"); } else {	$(".clasrieg_segur2_electri").val("N"); } });
$(".clasrieg_segur2_locat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_locat").val("S"); } else {	$(".clasrieg_segur2_locat").val("N"); } });
$(".clasrieg_segur2_fisiquim").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_fisiquim").val("S"); } else {	$(".clasrieg_segur2_fisiquim").val("N"); } });
$(".clasrieg_segur2_public").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_public").val("S"); } else {	$(".clasrieg_segur2_public").val("N"); } });
$(".clasrieg_segur2_espconfi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_espconfi").val("S"); } else {	$(".clasrieg_segur2_espconfi").val("N"); } });
$(".clasrieg_segur2_trabaltura").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_trabaltura").val("S"); } else {	$(".clasrieg_segur2_trabaltura").val("N"); } });
$(".clasrieg_segur2_sismo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_sismo").val("S"); } else {   $(".clasrieg_segur2_sismo").val("N"); } });
$(".clasrieg_segur2_delincuenciacomun").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_delincuenciacomun").val("S"); } else {   $(".clasrieg_segur2_delincuenciacomun").val("N"); } });
$(".clasrieg_segur2_accitransito").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_accitransito").val("S"); } else {   $(".clasrieg_segur2_accitransito").val("N"); } });
$(".clasrieg_segur2_caidaobjetos").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_caidaobjetos").val("S"); } else {   $(".clasrieg_segur2_caidaobjetos").val("N"); } });
$(".clasrieg_segur2_puestotrabdesorden").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur2_puestotrabdesorden").val("S"); } else {   $(".clasrieg_segur2_puestotrabdesorden").val("N"); } });
$(".clasrieg_observ2_otro").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_observ2_otro").val("S"); } else {	$(".clasrieg_observ2_otro").val("N"); } });
$(".clasrieg_fis3_ruid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis3_ruid").val("S"); } else {	$(".clasrieg_fis3_ruid").val("N"); } });
$(".clasrieg_fis3_ilum").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis3_ilum").val("S"); } else {	$(".clasrieg_fis3_ilum").val("N"); } });
$(".clasrieg_fis3_noionic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis3_noionic").val("S"); } else {	$(".clasrieg_fis3_noionic").val("N"); } });
$(".clasrieg_fis3_vibra").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis3_vibra").val("S"); } else {	$(".clasrieg_fis3_vibra").val("N"); } });
$(".clasrieg_fis3_tempextrem").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis3_tempextrem").val("S"); } else {	$(".clasrieg_fis3_tempextrem").val("N"); } });
$(".clasrieg_fis3_cambpres").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_fis3_cambpres").val("S"); } else {	$(".clasrieg_fis3_cambpres").val("N"); } });
$(".clasrieg_quim3_gasvapor").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim3_gasvapor").val("S"); } else {	$(".clasrieg_quim3_gasvapor").val("N"); } });
$(".clasrieg_quim3_aeroliq").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim3_aeroliq").val("S"); } else {	$(".clasrieg_quim3_aeroliq").val("N"); } });
$(".clasrieg_quim3_solid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim3_solid").val("S"); } else {	$(".clasrieg_quim3_solid").val("N"); } });
$(".clasrieg_quim3_liquid").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_quim3_liquid").val("S"); } else {	$(".clasrieg_quim3_liquid").val("N"); } });
$(".clasrieg_biolog3_viru").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog3_viru").val("S"); } else {	$(".clasrieg_biolog3_viru").val("N"); } });
$(".clasrieg_biolog3_bacter").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog3_bacter").val("S"); } else {	$(".clasrieg_biolog3_bacter").val("N"); } });
$(".clasrieg_biolog3_parasi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog3_parasi").val("S"); } else {	$(".clasrieg_biolog3_parasi").val("N"); } });
$(".clasrieg_biolog3_morde").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog3_morde").val("S"); } else {	$(".clasrieg_biolog3_morde").val("N"); } });
$(".clasrieg_biolog3_picad").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog3_picad").val("S"); } else {	$(".clasrieg_biolog3_picad").val("N"); } });
$(".clasrieg_biolog3_hongo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_biolog3_hongo").val("S"); } else {	$(".clasrieg_biolog3_hongo").val("N"); } });
$(".clasrieg_ergo3_trabestat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo3_trabestat").val("S"); } else {	$(".clasrieg_ergo3_trabestat").val("N"); } });
$(".clasrieg_ergo3_esfuerfis").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo3_esfuerfis").val("S"); } else {	$(".clasrieg_ergo3_esfuerfis").val("N"); } });
$(".clasrieg_ergo3_carga").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo3_carga").val("S"); } else {	$(".clasrieg_ergo3_carga").val("N"); } });
$(".clasrieg_ergo3_postforz").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo3_postforz").val("S"); } else {	$(".clasrieg_ergo3_postforz").val("N"); } });
$(".clasrieg_ergo3_movrepet").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo3_movrepet").val("S"); } else {	$(".clasrieg_ergo3_movrepet").val("N"); } });
$(".clasrieg_ergo3_jortrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_ergo3_jortrab").val("S"); } else {	$(".clasrieg_ergo3_jortrab").val("N"); } });
$(".clasrieg_psi3_monoto").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi3_monoto").val("S"); } else {	$(".clasrieg_psi3_monoto").val("N"); } });
$(".clasrieg_psi3_relhuman").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi3_relhuman").val("S"); } else {	$(".clasrieg_psi3_relhuman").val("N"); } });
$(".clasrieg_psi3_contentarea").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi3_contentarea").val("S"); } else {	$(".clasrieg_psi3_contentarea").val("N"); } });
$(".clasrieg_psi3_orgtiemptrab").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_psi3_orgtiemptrab").val("S"); } else {	$(".clasrieg_psi3_orgtiemptrab").val("N"); } });
$(".clasrieg_segur3_mecanic").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_mecanic").val("S"); } else {	$(".clasrieg_segur3_mecanic").val("N"); } });
$(".clasrieg_segur3_electri").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_electri").val("S"); } else {	$(".clasrieg_segur3_electri").val("N"); } });
$(".clasrieg_segur3_locat").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_locat").val("S"); } else {	$(".clasrieg_segur3_locat").val("N"); } });
$(".clasrieg_segur3_fisiquim").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_fisiquim").val("S"); } else {	$(".clasrieg_segur3_fisiquim").val("N"); } });
$(".clasrieg_segur3_public").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_public").val("S"); } else {	$(".clasrieg_segur3_public").val("N"); } });
$(".clasrieg_segur3_espconfi").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_espconfi").val("S"); } else {	$(".clasrieg_segur3_espconfi").val("N"); } });
$(".clasrieg_segur3_trabaltura").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_trabaltura").val("S"); } else {	$(".clasrieg_segur3_trabaltura").val("N"); } });
$(".clasrieg_segur3_sismo").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_sismo").val("S"); } else {   $(".clasrieg_segur3_sismo").val("N"); } });
$(".clasrieg_segur3_delincuenciacomun").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_delincuenciacomun").val("S"); } else {   $(".clasrieg_segur3_delincuenciacomun").val("N"); } });
$(".clasrieg_segur3_accitransito").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_accitransito").val("S"); } else {   $(".clasrieg_segur3_accitransito").val("N"); } });
$(".clasrieg_segur3_caidaobjetos").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_caidaobjetos").val("S"); } else {   $(".clasrieg_segur3_caidaobjetos").val("N"); } });
$(".clasrieg_segur3_puestotrabdesorden").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_segur3_puestotrabdesorden").val("S"); } else {   $(".clasrieg_segur3_puestotrabdesorden").val("N"); } });
$(".clasrieg_observ3_otro").change(function(){ if( $(this).is(':checked') ){ $(".clasrieg_observ3_otro").val("S"); } else {	$(".clasrieg_observ3_otro").val("N"); } });
/* -------------------------------------------------------------------------------------------------------------- */
$(".ant_fam_hiper_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_hiper_pad").val("S"); } else {	$(".ant_fam_hiper_pad").val("N"); } });
$(".ant_fam_hiper_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_hiper_mad").val("S"); } else {	$(".ant_fam_hiper_mad").val("N"); } });
$(".ant_fam_hiper_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_hiper_herm").val("S"); } else {	$(".ant_fam_hiper_herm").val("N"); } });
$(".ant_fam_hiper_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_hiper_otro").val("S"); } else {	$(".ant_fam_hiper_otro").val("N"); } });
$(".ant_fam_cadio_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_cadio_pad").val("S"); } else {	$(".ant_fam_cadio_pad").val("N"); } });
$(".ant_fam_cadio_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_cadio_mad").val("S"); } else {	$(".ant_fam_cadio_mad").val("N"); } });
$(".ant_fam_cadio_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_cadio_herm").val("S"); } else {	$(".ant_fam_cadio_herm").val("N"); } });
$(".ant_fam_cadio_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_cadio_otro").val("S"); } else {	$(".ant_fam_cadio_otro").val("N"); } });
$(".ant_fam_osteomusc_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_osteomusc_pad").val("S"); } else {	$(".ant_fam_osteomusc_pad").val("N"); } });
$(".ant_fam_osteomusc_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_osteomusc_mad").val("S"); } else {	$(".ant_fam_osteomusc_mad").val("N"); } });
$(".ant_fam_osteomusc_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_osteomusc_herm").val("S"); } else {	$(".ant_fam_osteomusc_herm").val("N"); } });
$(".ant_fam_osteomusc_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_osteomusc_otro").val("S"); } else {	$(".ant_fam_osteomusc_otro").val("N"); } });
$(".ant_fam_diabet_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_diabet_pad").val("S"); } else {	$(".ant_fam_diabet_pad").val("N"); } });
$(".ant_fam_diabet_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_diabet_mad").val("S"); } else {	$(".ant_fam_diabet_mad").val("N"); } });
$(".ant_fam_diabet_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_diabet_herm").val("S"); } else {	$(".ant_fam_diabet_herm").val("N"); } });
$(".ant_fam_diabet_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_diabet_otro").val("S"); } else {	$(".ant_fam_diabet_otro").val("N"); } });
$(".ant_fam_trans_convul_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trans_convul_pad").val("S"); } else {	$(".ant_fam_trans_convul_pad").val("N"); } });
$(".ant_fam_trans_convul_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trans_convul_mad").val("S"); } else {	$(".ant_fam_trans_convul_mad").val("N"); } });
$(".ant_fam_trans_convul_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trans_convul_herm").val("S"); } else {	$(".ant_fam_trans_convul_herm").val("N"); } });
$(".ant_fam_trans_convul_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trans_convul_otro").val("S"); } else {	$(".ant_fam_trans_convul_otro").val("N"); } });
$(".ant_fam_artitri_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_artitri_pad").val("S"); } else {	$(".ant_fam_artitri_pad").val("N"); } });
$(".ant_fam_artitri_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_artitri_mad").val("S"); } else {	$(".ant_fam_artitri_mad").val("N"); } });
$(".ant_fam_artitri_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_artitri_herm").val("S"); } else {	$(".ant_fam_artitri_herm").val("N"); } });
$(".ant_fam_artitri_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_artitri_otro").val("S"); } else {	$(".ant_fam_artitri_otro").val("N"); } });
$(".ant_fam_trombos_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trombos_pad").val("S"); } else {	$(".ant_fam_trombos_pad").val("N"); } });
$(".ant_fam_trombos_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trombos_mad").val("S"); } else {	$(".ant_fam_trombos_mad").val("N"); } });
$(".ant_fam_trombos_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trombos_herm").val("S"); } else {	$(".ant_fam_trombos_herm").val("N"); } });
$(".ant_fam_trombos_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_trombos_otro").val("S"); } else {	$(".ant_fam_trombos_otro").val("N"); } });
$(".ant_fam_enf_gene_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_gene_pad").val("S"); } else {	$(".ant_fam_enf_gene_pad").val("N"); } });
$(".ant_fam_enf_gene_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_gene_mad").val("S"); } else {	$(".ant_fam_enf_gene_mad").val("N"); } });
$(".ant_fam_enf_gene_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_gene_herm").val("S"); } else {	$(".ant_fam_enf_gene_herm").val("N"); } });
$(".ant_fam_enf_gene_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_gene_otro").val("S"); } else {	$(".ant_fam_enf_gene_otro").val("N"); } });
$(".ant_fam_varice_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_varice_pad").val("S"); } else {	$(".ant_fam_varice_pad").val("N"); } });
$(".ant_fam_varice_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_varice_mad").val("S"); } else {	$(".ant_fam_varice_mad").val("N"); } });
$(".ant_fam_varice_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_varice_herm").val("S"); } else {	$(".ant_fam_varice_herm").val("N"); } });
$(".ant_fam_varice_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_varice_otro").val("S"); } else {	$(".ant_fam_varice_otro").val("N"); } });
$(".ant_fam_tum_malig_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tum_malig_pad").val("S"); } else {	$(".ant_fam_tum_malig_pad").val("N"); } });
$(".ant_fam_tum_malig_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tum_malig_mad").val("S"); } else {	$(".ant_fam_tum_malig_mad").val("N"); } });
$(".ant_fam_tum_malig_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tum_malig_herm").val("S"); } else {	$(".ant_fam_tum_malig_herm").val("N"); } });
$(".ant_fam_tum_malig_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tum_malig_otro").val("S"); } else {	$(".ant_fam_tum_malig_otro").val("N"); } });
$(".ant_fam_alerg_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_alerg_pad").val("S"); } else {	$(".ant_fam_alerg_pad").val("N"); } });
$(".ant_fam_alerg_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_alerg_mad").val("S"); } else {	$(".ant_fam_alerg_mad").val("N"); } });
$(".ant_fam_alerg_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_alerg_herm").val("S"); } else {	$(".ant_fam_alerg_herm").val("N"); } });
$(".ant_fam_alerg_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_alerg_otro").val("S"); } else {	$(".ant_fam_alerg_otro").val("N"); } });
$(".ant_fam_otro_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_otro_pad").val("S"); } else {	$(".ant_fam_otro_pad").val("N"); } });
$(".ant_fam_otro_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_otro_mad").val("S"); } else {	$(".ant_fam_otro_mad").val("N"); } });
$(".ant_fam_otro_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_otro_herm").val("S"); } else {	$(".ant_fam_otro_herm").val("N"); } });
$(".ant_fam_otro_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_otro_otro").val("S"); } else {	$(".ant_fam_otro_otro").val("N"); } });
$(".ant_fam_enf_ment_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_ment_pad").val("S"); } else {	$(".ant_fam_enf_ment_pad").val("N"); } });
$(".ant_fam_enf_ment_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_ment_mad").val("S"); } else {	$(".ant_fam_enf_ment_mad").val("N"); } });
$(".ant_fam_enf_ment_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_ment_herm").val("S"); } else {	$(".ant_fam_enf_ment_herm").val("N"); } });
$(".ant_fam_enf_ment_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_enf_ment_otro").val("S"); } else {	$(".ant_fam_enf_ment_otro").val("N"); } });
$(".ant_fam_tuber_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tuber_pad").val("S"); } else {	$(".ant_fam_tuber_pad").val("N"); } });
$(".ant_fam_tuber_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tuber_mad").val("S"); } else {	$(".ant_fam_tuber_mad").val("N"); } });
$(".ant_fam_tuber_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tuber_herm").val("S"); } else {	$(".ant_fam_tuber_herm").val("N"); } });
$(".ant_fam_tuber_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_tuber_otro").val("S"); } else {	$(".ant_fam_tuber_otro").val("N"); } });

$(".ant_fam_asma_pad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_asma_pad").val("S"); } else {	$(".ant_fam_asma_pad").val("N"); } });
$(".ant_fam_asma_mad").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_asma_mad").val("S"); } else {	$(".ant_fam_asma_mad").val("N"); } });
$(".ant_fam_asma_herm").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_asma_herm").val("S"); } else {	$(".ant_fam_asma_herm").val("N"); } });
$(".ant_fam_asma_otro").change(function(){ if( $(this).is(':checked') ){ $(".ant_fam_asma_otro").val("S"); } else {	$(".ant_fam_asma_otro").val("N"); } });
/* -------------------------------------------------------------------------------------------------------------- */
$('input:radio[name="sintoma_covid19"]').change(function(){ 
var sintoma_covid19 = $(this).val();
if ((sintoma_covid19=='SI')) { $('#modulo_covid19').show(); } else { $('#modulo_covid19').hide(); }
});
/* -------------------------------------------------------------------------------------------------------------- */
$('input:radio[name="mucosas"]').change(function(){ 
var tbl15_estado = $(this).val();

if(tbl15_estado == 'NORMAL' ){ 
$("input:radio[name=conjuntival][value='NORMAL']").prop("checked",true);
$("input:radio[name=oral][value='NORMAL']").prop("checked",true);
$("input:radio[name=vulvar_prepucial][value='NORMAL']").prop("checked",true);
$("input:radio[name=rectal][value='NORMAL']").prop("checked",true);
$("input:radio[name=ojos][value='NORMAL']").prop("checked",true);
$("input:radio[name=oidos][value='NORMAL']").prop("checked",true);
$("input:radio[name=nodulos_linfa][value='NORMAL']").prop("checked",true);
$("input:radio[name=piel_anexos][value='NORMAL']").prop("checked",true);
$("input:radio[name=locomocion][value='NORMAL']").prop("checked",true);
$("input:radio[name=aparato_musculoesquelet][value='NORMAL']").prop("checked",true);
$("input:radio[name=sistem_nervioso][value='NORMAL']").prop("checked",true);
$("input:radio[name=aparato_cardiovascu][value='NORMAL']").prop("checked",true);
$("input:radio[name=aparato_respirat][value='NORMAL']").prop("checked",true);
$("input:radio[name=aparato_digestivo][value='NORMAL']").prop("checked",true);
$("input:radio[name=aparato_genitourinario][value='NORMAL']").prop("checked",true);
} else { 
$("input:radio[name=conjuntival][value='ANORMAL']").prop("checked",true);
$("input:radio[name=oral][value='ANORMAL']").prop("checked",true);
$("input:radio[name=vulvar_prepucial][value='ANORMAL']").prop("checked",true);
$("input:radio[name=rectal][value='ANORMAL']").prop("checked",true);
$("input:radio[name=ojos][value='ANORMAL']").prop("checked",true);
$("input:radio[name=oidos][value='ANORMAL']").prop("checked",true);
$("input:radio[name=nodulos_linfa][value='ANORMAL']").prop("checked",true);
$("input:radio[name=piel_anexos][value='ANORMAL']").prop("checked",true);
$("input:radio[name=locomocion][value='ANORMAL']").prop("checked",true);
$("input:radio[name=aparato_musculoesquelet][value='ANORMAL']").prop("checked",true);
$("input:radio[name=sistem_nervioso][value='ANORMAL']").prop("checked",true);
$("input:radio[name=aparato_cardiovascu][value='ANORMAL']").prop("checked",true);
$("input:radio[name=aparato_respirat][value='ANORMAL']").prop("checked",true);
$("input:radio[name=aparato_digestivo][value='ANORMAL']").prop("checked",true);
$("input:radio[name=aparato_genitourinario][value='ANORMAL']").prop("checked",true);
}
});
/* -------------------------------------------------------------------------------------------------------------- */
$('input:radio[name="plan_diag"]').change(function(){ 
var tbl15_estado = $(this).val();
if(tbl15_estado == 'SI' ){ 
$("input:radio[name=plan_diag_cuadhemat][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_parcialorina][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_coprologico][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_citologfecal][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_citolog][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang1][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang2][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang3][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang4][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_rayx][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_usg][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_cultivo][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_antibiograma][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_encima_hepatica][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_otro][value='SI']").prop("checked",true);
} else { 
$("input:radio[name=plan_diag_cuadhemat][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_parcialorina][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_coprologico][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_citologfecal][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_citolog][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang1][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang2][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang3][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang4][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_rayx][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_usg][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_cultivo][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_antibiograma][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_encima_hepatica][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_otro][value='NO']").prop("checked",true);
}
});
/* -------------------------------------------------------------------------------------------------------------- */
$('input:radio[name="plan_diag_autorizado"]').change(function(){ 
var tbl15_estado = $(this).val();
if(tbl15_estado == 'SI' ){ 
$("input:radio[name=plan_diag_cuadhemat_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_parcialorina_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_coprologico_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_citologfecal_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_citolog_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang1_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang2_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang3_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang4_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_rayx_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_usg_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_cultivo_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_antibiograma_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_encima_hepatica_autorizado][value='SI']").prop("checked",true);
$("input:radio[name=plan_diag_otro_autorizado][value='SI']").prop("checked",true);
} else { 
$("input:radio[name=plan_diag_cuadhemat_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_parcialorina_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_coprologico_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_citologfecal_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_citolog_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang1_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang2_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang3_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_quimicsang4_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_rayx_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_usg_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_cultivo_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_antibiograma_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_encima_hepatica_autorizado][value='NO']").prop("checked",true);
$("input:radio[name=plan_diag_otro_autorizado][value='NO']").prop("checked",true);
}
});
/* -------------------------------------------------------------------------------------------------------------- */
$('input:radio[name="sintoma_covid19_todo"]').change(function(){ 
var tbl15_estado = $(this).val();
var pos = 'SI';
var neg = 'NO';

if( tbl15_estado == 'SI' ){ 
console.log(neg);
$("input:radio[name=covid19_fiebre][value='SI']").prop("checked",true);
$("input:radio[name=covid19_escolofrio][value='SI']").prop("checked",true);
$("input:radio[name=covid19_cansansio][value='SI']").prop("checked",true);
$("input:radio[name=covid19_malestar_gral][value='SI']").prop("checked",true);
$("input:radio[name=covid19_fatiga][value='SI']").prop("checked",true);
$("input:radio[name=covid19_tos_seca][value='SI']").prop("checked",true);
$("input:radio[name=covid19_cefaleas][value='SI']").prop("checked",true);
$("input:radio[name=covid19_congestion_nasal][value='SI']").prop("checked",true);
$("input:radio[name=covid19_secrecion_nasal][value='SI']").prop("checked",true);
$("input:radio[name=exaosteo_epicond_lat][value='SI']").prop("checked",true);
$("input:radio[name=covid19_dorlor_garganta][value='SI']").prop("checked",true);
$("input:radio[name=covid19_diarrea][value='SI']").prop("checked",true);
$("input:radio[name=covid19_dificul_resp][value='SI']").prop("checked",true);
$("input:radio[name=covid19_inapetencia][value='SI']").prop("checked",true);
$("input:radio[name=covid19_perdida_olfato][value='SI']").prop("checked",true);
$("input:radio[name=covid19_perdida_gusto][value='SI']").prop("checked",true);
$("input:radio[name=covid19_dedos_covid][value='SI']").prop("checked",true);
$("input:radio[name=covid19_dolor_pecho][value='SI']").prop("checked",true);
$("input:radio[name=covid19_confusion][value='SI']").prop("checked",true);
$("input:radio[name=covid19_color_azul_labios][value='SI']").prop("checked",true);

$("input:radio[name=covid19_artralgia][value='SI']").prop("checked",true);
$("input:radio[name=covid19_mialgia][value='SI']").prop("checked",true);
$("input:radio[name=covid19_astenia][value='SI']").prop("checked",true);
$("input:radio[name=covid19_odinofagia][value='SI']").prop("checked",true);
$("input:radio[name=covid19_irritacion_ardor_ojos][value='SI']").prop("checked",true);
$("input:radio[name=covid19_nauseas][value='SI']").prop("checked",true);
$("input:radio[name=covid19_contacto_person_sospech_covid][value='SI']").prop("checked",true);
} 
else if( tbl15_estado == 'NO' ){ 
console.log(pos);
$("input:radio[name=covid19_fiebre][value='NO']").prop("checked",true);
$("input:radio[name=covid19_escolofrio][value='NO']").prop("checked",true);
$("input:radio[name=covid19_cansansio][value='NO']").prop("checked",true);
$("input:radio[name=covid19_malestar_gral][value='NO']").prop("checked",true);
$("input:radio[name=covid19_fatiga][value='NO']").prop("checked",true);
$("input:radio[name=covid19_tos_seca][value='NO']").prop("checked",true);
$("input:radio[name=covid19_cefaleas][value='NO']").prop("checked",true);
$("input:radio[name=covid19_congestion_nasal][value='NO']").prop("checked",true);
$("input:radio[name=covid19_secrecion_nasal][value='NO']").prop("checked",true);
$("input:radio[name=exaosteo_epicond_lat][value='NO']").prop("checked",true);
$("input:radio[name=covid19_dorlor_garganta][value='NO']").prop("checked",true);
$("input:radio[name=covid19_diarrea][value='NO']").prop("checked",true);
$("input:radio[name=covid19_dificul_resp][value='NO']").prop("checked",true);
$("input:radio[name=covid19_inapetencia][value='NO']").prop("checked",true);
$("input:radio[name=covid19_perdida_olfato][value='NO']").prop("checked",true);
$("input:radio[name=covid19_perdida_gusto][value='NO']").prop("checked",true);
$("input:radio[name=covid19_dedos_covid][value='NO']").prop("checked",true);
$("input:radio[name=covid19_dolor_pecho][value='NO']").prop("checked",true);
$("input:radio[name=covid19_confusion][value='NO']").prop("checked",true);
$("input:radio[name=covid19_color_azul_labios][value='NO']").prop("checked",true);

$("input:radio[name=covid19_artralgia][value='NO']").prop("checked",true);
$("input:radio[name=covid19_mialgia][value='NO']").prop("checked",true);
$("input:radio[name=covid19_astenia][value='NO']").prop("checked",true);
$("input:radio[name=covid19_odinofagia][value='NO']").prop("checked",true);
$("input:radio[name=covid19_irritacion_ardor_ojos][value='NO']").prop("checked",true);
$("input:radio[name=covid19_nauseas][value='NO']").prop("checked",true);
$("input:radio[name=covid19_contacto_person_sospech_covid][value='NO']").prop("checked",true);
}
else { console.log(neg); } 
});
/* -------------------------------------------------------------------------------------------------------------- */
$("input").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
console.log("input");
$.ajax({  
    url:"guardar_edit_historia_clinica_mejorada_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:id, cod_cliente:<?php echo $cod_cliente ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});
/* -------------------------------------------------------------------------------------------------------------- */
$("select").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
console.log("select");
$.ajax({  
    url:"guardar_edit_historia_clinica_mejorada_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:id, cod_cliente:<?php echo $cod_cliente ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});
/* -------------------------------------------------------------------------------------------------------------- */
$("textarea").change(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");
let id = this.id;
console.log("textarea");
$.ajax({  
    url:"guardar_edit_historia_clinica_mejorada_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:campo, id:id, cod_cliente:<?php echo $cod_cliente ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});
/* -------------------------------------------------------------------------------------------------------------- */
$('input[name="exa_fis_talla"]').focusout(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");  
let id = <?php echo $cod_historia_clinica ?>;
$.ajax({  
    url:"guardar_edit_historia_clinica_mejorada_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:"exa_fis_talla", id:id, cod_cliente:<?php echo $cod_cliente ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});
/* -------------------------------------------------------------------------------------------------------------- */
$('input[name="exa_fis_peso"]').focusout(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");  
let id = <?php echo $cod_historia_clinica ?>;
$.ajax({  
    url:"guardar_edit_historia_clinica_mejorada_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:"exa_fis_peso", id:id, cod_cliente:<?php echo $cod_cliente ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});
/* -------------------------------------------------------------------------------------------------------------- */
$('input[name="exa_fis_imc"]').focusout(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");  
let id = <?php echo $cod_historia_clinica ?>;
$.ajax({  
    url:"guardar_edit_historia_clinica_mejorada_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:"exa_fis_imc", id:id, cod_cliente:<?php echo $cod_cliente ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});
/* -------------------------------------------------------------------------------------------------------------- */
$('input[name="exa_fis_interpreimc"]').focusout(function(){  
var valor = $(this).val();
var campo = $(this).attr("name");  
let id = <?php echo $cod_historia_clinica ?>;
$.ajax({  
    url:"guardar_edit_historia_clinica_mejorada_ajax.php",  
    method:"POST",  
    data:{valor:valor, campo:"exa_fis_interpreimc", id:id, cod_cliente:<?php echo $cod_cliente ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});  
});
/* -------------------------------------------------------------------------------------------------------------- */
 });  
 </script> 

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar_lista_problema').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_lista_problema = $(this).parent().attr('data');
        var dataString = 'llave='+cod_lista_problema+'&'+'tab='+'<?php echo $tab_lista_problema ?>'+'&'+'campo='+'<?php echo $campo_lista_problema ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_lista_problema+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_lista_problema'+cod_lista_problema).fadeOut("slow");
                $('#nombre_lista_problema'+cod_lista_problema).fadeOut("slow");
                $('#nombre_lista_maestra'+cod_lista_problema).fadeOut("slow");
                $('#nombre_diagnostico_diferencial'+cod_lista_problema).fadeOut("slow");
                $('#tr'+cod_lista_problema).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar_plan_terapeutico').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_plan_terapeutico = $(this).parent().attr('data');
        var dataString = 'llave='+cod_plan_terapeutico+'&'+'tab='+'<?php echo $tab_plan_terapeutico ?>'+'&'+'campo='+'<?php echo $campo_plan_terapeutico ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_plan_terapeutico+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_plan_terapeutico'+cod_plan_terapeutico).fadeOut("slow");
                $('#plan_terapeutico_ts'+cod_plan_terapeutico).fadeOut("slow");
                $('#plan_terapeutico_p'+cod_plan_terapeutico).fadeOut("slow");
                $('#plan_terapeutico_s'+cod_plan_terapeutico).fadeOut("slow");
                $('#plan_terapeutico_e'+cod_plan_terapeutico).fadeOut("slow");
                $('#facturar'+cod_plan_terapeutico).fadeOut("slow");
                $('#nombre_producto'+cod_plan_terapeutico).fadeOut("slow");
                $('#nombre_tipo_presentacion'+cod_plan_terapeutico).fadeOut("slow");
                $('#posologia_cantidad'+cod_plan_terapeutico).fadeOut("slow");
                $('#posologia_peso'+cod_plan_terapeutico).fadeOut("slow");
                $('#und_producto'+cod_plan_terapeutico).fadeOut("slow");
                $('#nombre_via_administracion'+cod_plan_terapeutico).fadeOut("slow");
                $('#nombre_frec_duracion'+cod_plan_terapeutico).fadeOut("slow");
                $('#cod_producto__'+cod_plan_terapeutico).fadeOut("slow");
                $('#ok'+cod_plan_terapeutico).fadeOut("slow");
                $('#tr'+cod_plan_terapeutico).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>


<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar_auxiliar_pasante').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_auxiliar_pasante = $(this).parent().attr('data');
        var dataString = 'llave='+cod_auxiliar_pasante+'&'+'tab='+'<?php echo $tab_auxiliar_pasante ?>'+'&'+'campo='+'<?php echo $campo_auxiliar_pasante ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_auxiliar_pasante+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_auxiliar_pasante'+cod_auxiliar_pasante).fadeOut("slow");
                $('#nombre_auxiliar_pasante'+cod_auxiliar_pasante).fadeOut("slow");
                $('#doc_auxiliar_pasante'+cod_auxiliar_pasante).fadeOut("slow");
                $('#semestre_auxiliar_pasante'+cod_auxiliar_pasante).fadeOut("slow");
                $('#url_firma_auxiliar_pasante'+cod_auxiliar_pasante).fadeOut("slow");
                $('#ok'+cod_auxiliar_pasante).fadeOut("slow");
                $('#tr'+cod_auxiliar_pasante).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>


<script type="text/javascript">
$(function() {
$(".nombre_producto").autocomplete({
source: "autocompletar_producto_ajax.php",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
var campo = this.name;
var id_conbinado = this.id;
var frag = id_conbinado.split("__");
var id = frag[1];

$("#"+id_conbinado).val(ui.item.nombre_producto);
$("#cod_producto__"+id).val(ui.item.cod_producto);

var cod_producto = $("#cod_producto__"+id).val();

$.ajax({  
    url:"guardar_producto_plan_teraupeutico_ajax.php",  
    method:"POST",  
    data:{cod_producto:cod_producto, campo:"producto_plan_terapeutico", id:id, cod_historia_clinica:<?php echo $cod_historia_clinica ?>, cod_cliente:<?php echo $cod_cliente ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});


}

});
});
</script>


<script type="text/javascript">
$(function() {
$(".nombre_auxiliar_pasante").autocomplete({
source: "autocompletar_auxiliar_pasante_ajax.php",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
var campo = this.name;
var id_conbinado = this.id;
var frag = id_conbinado.split("__");
var id = frag[1];

$("#"+id_conbinado).val(ui.item.nombre_auxiliar_pasante);
$("#cod_administrador__"+id).val(ui.item.cod_administrador);

var cod_administrador = $("#cod_administrador__"+id).val();

$.ajax({  
    url:"guardar_auxiliar_pasante_hist_clinic_ajax.php",  
    method:"POST",  
    data:{cod_administrador:cod_administrador, campo:"auxiliar_pasante_hist_clinic", id:id, cod_historia_clinica:<?php echo $cod_historia_clinica ?>, cod_cliente:<?php echo $cod_cliente ?>},  
    success:function(data){  
         $('#result').html(data);  
    }  
});


}

});
});
</script>


<script type="text/javascript">
$(".facturar").change(function(){ if( $(this).is(':checked') ){ $(".facturar").val("1"); } else {	$(".facturar").val("0"); } });
</script>

<script>
window.onload = function() {
document.getElementById("<?php echo $foco ?>").focus();
}
</script>
<!-- 1****************************************************************************************************** -->
</body>
</html>