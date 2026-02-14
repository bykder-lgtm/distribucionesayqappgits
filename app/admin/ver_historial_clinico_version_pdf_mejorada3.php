<?php ob_start();?>
<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');  
date_default_timezone_set("America/Bogota");
//$fecha_hoy = time();
$fecha_hoy                          = date("Y/m/d");
$fecha_hoy_time                     = strtotime(date("Y/m/d"));
$cod_historia_clinica               = intval($_GET['cod_historia_clinica']);
$cod_cliente                        = intval($_GET['cod_cliente']);
$required                           = '';

if ($cod_seguridad == 1) { $required = 'required'; } elseif ($cod_seguridad == 2) { $required = ''; } elseif ($cod_seguridad == 3) { $required = ''; } else { $required = '';  }

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
tbl15_historia_clinica.aparato_genitourinario_observ, tbl15_historia_clinica.plan_diag_cuadhemat, 
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
tbl15_historia_clinica.plan_diag_antibiograma_resul, tbl15_historia_clinica.plan_diag_otro, 
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
tbl15_historia_clinica.nombre_arl, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, 
tbl15_historia_clinica.cargo_empresa, tbl15_historia_clinica.area_empresa, tbl15_historia_clinica.ciudad_empresa, 
tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.tel_cliente, tbl15_historia_clinica.correo, 
tbl15_historia_clinica.cod_entidad, tbl15_historia_clinica.lugar_residencia,  
tbl15_historia_clinica.nombre_pais, tbl15_historia_clinica.nombre_departamento, 
tbl15_historia_clinica.nombre_municipio, tbl15_historia_clinica.fecha_mes, tbl15_historia_clinica.fecha_anyo, 
tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, 
tbl15_historia_clinica.fecha_reg_time, tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, 
tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, tbl15_historia_clinica.cuenta
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
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$fecha_ymd_hora                      = date("Y/m/d H:i:s", $fecha_time);
$fecha_reg_time_dmy                  = date("d/m/Y", $fecha_reg_time);
$fecha_hisroria_clinica              = date("Y/m/d", $fecha_time);
$nombres_completos                   = "HISTORIA CLÍNICA-".$nombres_cli.' '.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_historia_clinica;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
include_once('mpdf/mpdf.php');
$margen_izq                          = '10';
$margen_der                          = '10';
$margen_inf_encabezado               = '20';
$margen_sup_encabezado               = '30';
$posicion_sup_encabezado             = '5';
$posicion_inf_encabezado             = '20';

$titulo_doc_pdf                      = $nombres_completos;
$autor_doc_pdf                       = $propietario_nombres_apellidos_emp;
$creador_doc_pdf                     = $propietario_nombres_apellidos_emp;
$tema_doc_pdf                        = "HISTORIA CLÍNICA";
$palabras_claves_doc_pdf             = $nombres_cli.' '.$apellido1_cli.'-'.$nombre_empresa.'-'.$cedula.'-'.$cod_historia_clinica;
$cod_historia_clinica_strpad         = str_pad($cod_historia_clinica, 6, "0", STR_PAD_LEFT);
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
//$mpdf                                = new mPDF('c','A4');
$mpdf                                = new mPDF('en-GB-x','Legal','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
$header = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_hc_emp.'pt; width:100%">
  <tr>
    <td width="25%" rowspan="3" align="center"><img src="../imagenes/logo_superior_gerencia_salud_ocupacional.png" /></td>
    <td width="50%" rowspan="3" align="center">HISTORIA CLÍNICA</td>
    <td width="25%" align="center"><barcode code="'.$cod_historia_clinica_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr >
    <td align="center">FECHA: '.$fecha_hisroria_clinica.'</td>
  </tr>
  <tr>
    <td align="center">HC: '.$cod_historia_clinica.'</td>
  </tr>
</table>
';
$headerE = '
<table align="center" border="1" cellspacing="0" cellpadding="0" style="font-family:mono;  font-size:'.$tamano_font_hc_emp.'pt; width:100%">
  <tr>
    <td width="25%" rowspan="3" align="center"><img src="../imagenes/logo_superior_gerencia_salud_ocupacional.png" /></td>
    <td width="50%" rowspan="3" align="center">HISTORIA CLÍNICA</td>
    <td width="25%" align="center"><barcode code="'.$cod_historia_clinica_strpad.'" type="C128A" size="0.5" height="1" /></td>
  </tr>
  <tr >
    <td align="center">FECHA: '.$fecha_hisroria_clinica.'</td>
  </tr>
  <tr>
    <td align="center">HC: '.$cod_historia_clinica.'</td>
  </tr>
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

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<br>

<table align="center" border="1" cellpadding="0" cellspacing="0" style="font-family:mono; font-size:'.$tamano_font_hc_emp.'pt; width:100%"><thead><tr><th valign="middle"><span style="color:#FF0000">1. DATOS DEL TRABAJADOR</span></th></tr></thead></table>

<table align="center" border="1" cellspacing="0" width="100%"><thead><tr><th valign="middle"><img src="'.$url_img_foto_min_cli.'" width="71px"/></th></tr></thead></table>

<table align="center" border="1" width="100%" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;"><thead><tr><th bgcolor="#FAC090" valign="middle"><span style="color:#FF0000">1. DATOS DEL TRABAJADOR</span></th></tr></thead></table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" width="100%">
	<thead><tr>
		<th valign="middle">
			<img src="'.$url_img_foto_min_cli.'" class="img-thumbnail" alt="Foto Paciente" style="border-style:dotted;border-width:1px;" width="71px"/>
		</th>
	</tr></thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;">
  <tr>
    <td><strong>FECHA DE ADMISIÓN:</td>
    <td>'.$fecha_ymd.'</td>
    <td><strong>HORA:</strong></td>
    <td>'.$hora.'</td>
    <td><strong>H.C:</strong></td>
    <td>'.$cod_historia_clinica.'</td>
  <tr>
    <td><strong>MÉDICO VETERINARIO:</td>
    <td>'.$nombres_prof.' '.$apellidos_prof.'</td>
    <td><strong>T.P.:</strong></td>
    <td>'.$licencia_emp.'</td>
    <td><strong>CHIP:</strong></td>
    <td></td>
  </tr>
</table>


<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;">
  <tr>
    <td colspan="5"><strong><em>RESEÑA DEL PACIENTE</em></strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>NOMBRE: '.$nombres_completos.'</strong></td>
    <td><strong>ESPECIE: '.$nombre_especie.'</strong></td>
    <td colspan="2"><strong>RAZA: '.$nombre_raza.'</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>COLOR: '.$nombre_color.'</strong></td>
    <td><strong>SEXO: '.$nombre_sexo.'</strong></td>
    <td colspan="2"><strong>FECHA NACIMIENTO: '.$fecha_nac_ymd.'</strong></td>
  </tr>
  <tr>
    <td><strong>EDAD (MESES): '.$edad_mes.'</strong></td>
    <td colspan="3"><strong>SEÑAS PARTICULARES: '.$senas_particulares.'</strong></td>
    <td><strong>PROCEDENCIA: '.$nombre_procedencia.'</strong></td>
  </tr>
</table>


<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;">
  <tr>
    <td colspan="5"><strong><em>DATOS DEL PROPIETARIO</em></strong></td>
  </tr>
  <tr>
    <td><strong>NOMBRE: '.$nombre_contacto1.'</strong></td>
    <td colspan="2"><strong>IDENTIFICACIÓN: '.$identificacion_contacto1.'</strong></td>
    <td colspan="2"><strong>DIRECCIÓN: '.$direccion_contacto1.'</strong></td>
  </tr>
   <tr>
    <td><strong>ESTRATO: '.$estrato_contacto1.'</strong></td>
    <td colspan="2"><strong>MUNICIPIO: '.$municipio_contacto1.'</strong></td>
    <td colspan="2"><strong>TELÉFONO: '.$tel_contacto1.'</strong></td>
  </tr>
   <tr>
    <td colspan="2"><strong>EMAIL: '.$correo_contacto1.'</strong></td>
    <td><strong>OCUPACIÓN: '.$ocupacion_contacto1.'</strong></td>
    <td colspan="2"><strong></strong></td>
  </tr>
</table>


<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;">
  <tr>
    <td><strong><em>MOTIVO DE LA CONSULTA: </em></strong></td>
  </tr>
  <tr>
    <td>'.$motivo.'</td>
  </tr>
  <tr>
    <td><strong><em>ANAMNÉSICOS: </em></strong></td>
  </tr>
  <tr>
    <td>'.$anamnesicos.'</td>
  </tr>
</table>


<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td colspan="7"><strong><em>HISTORIA DEL PACIENTE</em></strong></td>
  </tr>
  <tr>
    <td style="text-align:center" rowspan="7"><strong>VACUNACIÓN</strong></td>
    <td style="text-align:center" colspan="3"><strong>'.$nombre_especie.'</strong></td>
  </tr>
  <tr>
    <td>NO</td>
    <td style="text-align:center">'.$vacum_can.'</td>
    <td></td>
  </tr>
  <tr>
    <td>PVC</td>
    <td style="text-align:center">'.$vacum_can_pvc.'</td>
    <td>Fecha: '.$vacum_can_pvc_fecha.'</td>
  </tr>
  <tr>
    <td>TRIPLE</td>
    <td style="text-align:center">'.$vacum_can_triple.'</td>
    <td>Fecha: '.$vacum_can_triple_fecha.'</td>
  </tr>
  <tr>
    <td>RABIA</td>
    <td style="text-align:center">'.$vacum_can_rabia.'</td>
    <td>Fecha: '.$vacum_can_rabia_fecha.'</td>
  </tr>
  <tr>
    <td>OTRA</td>
    <td style="text-align:center">'.$vacum_can_otra.'</td>
    <td>Fecha: '.$vacum_can_otra_fecha.'</td>
  </tr>
  <tr>
    <td>¿Cuál?</td>
    <td style="text-align:center">'.$vacum_can_otra_cual.'</td>
    <td>Fecha: '.$vacum_can_otra_fecha.'</td>
  </tr>
</table>


<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td style="text-align:center"><strong><em>ULTIMA DESPARASITACION</em></strong></td>
    <td style="text-align:center"><strong>PRODUCTO</strong></td>
    <td style="text-align:center"><strong>FECHA</strong></td>
    <td style="text-align:center"><strong>ALIMENTACIÓN</strong></td>
  </tr>
  <tr>
    <td style="text-align:center">'.$ult_desparacit.'</td>
    <td style="text-align:center">'.$ult_desparacit_producto.'</td>
    <td style="text-align:center">'.$ult_desparacit_fecha.'</td>
    <td style="text-align:center">'.$nombre_alimentacion.'</td>
  </tr>
</table>


<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td><strong><em>ESTADO REPRODUCTIVO:</em></strong></td>
    <td>'.$nombre_estado_reproductivo.'</td>
    <td>ALERGIAS:</td>
    <td>'.$nombre_alergias.'</td>
  </tr>
</table>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td><strong><em>ENFERMEDADES ANTERIORES:</em></strong></td>
    <td>'.$nombre_enf_ant.'</td>
    <td><strong><em>CIRUGÍAS:</em></strong></td>
    <td>'.$nombre_cirugias.'</td>
  </tr>
</table>


<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td><strong><em>ANTECEDENTES FAMILIARES:</em></strong></td>
    <td>'.$ant_fam.'</td>
  </tr>
</table>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td><strong><em>HÁBITAT:</em></strong></td>
    <td>'.$nombre_habitat.'</td>
  </tr>
</table>

<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td colspan="3"><strong><em>CONSTANTES FISIOLÓGICAS</em></strong></td>
  </tr>
  <tr>
    <td><strong>T.Ll.C: '.$exa_fis_tllc.'</strong></td>
    <td><strong>F.C: '.$exa_fis_fc.'</strong></td>
    <td><strong>F.R: '.$exa_fis_fresp.'</strong></td>
  </tr>
  <tr>
    <td><strong>PULSO: '.$exa_fis_pulso.'</td>
    <td><strong>TEMPERATURA: '.$exa_fis_temperat.'</td>
    <td><strong>PESO: '.$exa_fis_peso.'</strong></td>
  </tr>
</table>

<br>

EXAMEN CLÍNICO
<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td><strong>ACTITUD</strong></td>
    <td colspan="8">'.$nombre_actitud.'</td>
  </tr>
  <tr>
    <td><strong>CONDICIÓN CORPORAL</strong></td>
    <td>'.$nombre_condicion_corporal.'</td>
  </tr>
  <tr>
    <td><strong>ESTADO HIDRATACIÓN</strong></td>
    <td>'.$nombre_estado_hidratacion.'
    </td>
  </tr>
</table>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: MoANORMAL; font-size: '.$tamaANORMAL_font_emp.'pt;">
  <tr>
    <td>MUCOSAS:</td>
    <td style="text-align:center">NORMAL - ANORMAL</td>
    <td style="text-align:center">Observaciones</td>
  </tr>
  <tr>
    <td>Conjuntival</td>
    <td style="text-align:center">'.$conjuntival.'</td>
    <td>'.$conjuntival_observ.'</td>
  </tr>
  <tr>
    <td>Oral</td>
    <td style="text-align:center">'.$oral.'</td>
    <td>'.$oral_observ.'</td>
  </tr>
  <tr>
    <td>Vulvar/Prepucial</td>
    <td style="text-align:center">'.$vulvar_prepucial.'</td>
    <td>'.$vulvar_prepucial_observ.'</td>
  </tr>
  <tr>
    <td>Rectal</td>
    <td style="text-align:center">'.$rectal.'</td>
    <td>'.$rectal_observ.'</td>
  </tr>
  <tr>
    <td>OJOS</td>
    <td style="text-align:center">'.$ojos.'</td>
    <td>'.$ojos_observ.'</td>
  </tr>
  <tr>
    <td>OÍDOS</td>
    <td style="text-align:center">'.$oidos.'</td>
    <td>'.$oidos_observ.'</td>
  </tr>
  <tr>
    <td>NÓDULOS LINFÁTICOS</td>
    <td style="text-align:center">'.$nodulos_linfa.'</td>
    <td>'.$nodulos_linfa_observ.'</td>
  </tr>
  <tr>
    <td>PIEL Y ANEXOS</td>
    <td style="text-align:center">'.$piel_anexos.'</td>
    <td>'.$piel_anexos_observ.'</td>
  </tr>
  <tr>
    <td>LOCOMOCIÓN</td>
    <td style="text-align:center">'.$locomocion.'</td>
    <td>'.$locomocion_observ.'</td>
  </tr>
  <tr>
    <td>A. MUSCULOESQUELÉTICO</td>
    <td style="text-align:center">'.$aparato_musculoesquelet.'</td>
    <td>'.$aparato_musculoesquelet_observ.'</td>
  </tr>
  <tr>
    <td>NORMALSTEMA NERVIOSO</td>
    <td style="text-align:center">'.$sistem_nervioso.'</td>
    <td>'.$sistem_nervioso_observ.'</td>
  </tr>
  <tr>
    <td>A. CARDIOVASCULAR</td>
    <td style="text-align:center">'.$aparato_cardiovascu.'</td>
    <td>'.$aparato_cardiovascu_observ.'</td>
  </tr>
  <tr>
    <td>A. RESPIRATORIO</td>'.$aparato_respira.'</td>
    <td>'.$aparato_respirat_observ.'</td>
  </tr>
  <tr>
    <td>A. DIGESTIVO</td>
    <td style="text-align:center">'.$aparato_digestivo.'</td>
    <td>'.$aparato_digestivo_observ.'</td>
  </tr>
  <tr>
    <td>A. GENITOURINARIO</td>
    <td style="text-align:center">'.$aparato_genitourinario.'</td>
    <td>'.$aparato_genitourinario_observ.'</td>
  </tr>
</table>

<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td colspan="3"><strong><em>LISTA DE PROBLEMAS</em></strong></td>
  </tr>
  <tr>
    <td style="text-align:center"><strong>LISTA DE PROBLEMAS</strong></td>
    <td style="text-align:center"><strong>LISTA MAESTRA</strong></td>
    <td style="text-align:center"><strong>DIAGNOSTICO DIFERENCIAL (DAMNVIT)</strong></td>
  </tr>
';
$sql_animal = "SELECT * FROM tbl15_lista_problema WHERE cod_historia_clinica = '$cod_historia_clinica' ORDER BY cod_lista_problema DESC";
$resultado_animal = mysqli_query($conectar, $sql_animal);
while ($info_animal = mysqli_fetch_assoc($resultado_animal)) {
 	 	 
$cod_lista_problema                = $info_animal['cod_lista_problema'];
$nombre_lista_problema             = $info_animal['nombre_lista_problema'];
$nombre_lista_maestra              = $info_animal['nombre_lista_maestra'];
$nombre_diagnostico_diferencial    = $info_animal['nombre_diagnostico_diferencial'];

$codigoHTML .= '
  <tr>
    <td>'.$nombre_lista_problema.'</td>
    <td>'.$nombre_lista_maestra.'</td>
    <td>'.$nombre_diagnostico_diferencial.'</td>
  </tr>
';
}
$codigoHTML .= '
</table>

<br>

<table align="center" border="0" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td style="text-align:left"><strong>(D</strong>: Degenerativa &ndash; <strong>A</strong>:  Anomalía congénita &ndash; <strong>M</strong>: Metabólica &ndash; <strong>N</strong>: Nutricional y neoplásica &ndash; <strong>V</strong>:  Vascular &ndash; <strong>I: </strong>Infecciosa, inflamatoria o idiomática &ndash; <strong>T</strong>: Trauma)</td>
  </tr>
</table>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td colspan="7"><strong><em>PLAN DIAGNOSTICO</em></strong></td>
  </tr>
  <tr>
    <td style="text-align:center"><strong>EXAMEN</strong></td>
    <td style="text-align:center"><strong>SI</strong></td>
    <td style="text-align:center"><strong>AUTORIZADO</strong></td>
    <td style="text-align:center"><strong>FECHA</strong></td>
    <td style="text-align:center"><strong>LABORATORIO</strong></td>
    <td style="text-align:center"><strong>RESULTADOS</strong></td>
  </tr>
  <tr>
    <td style="text-align:left">Cuadro Hemático</td>
    <td style="text-align:center">'.$plan_diag_cuadhemat.'</td>
    <td style="text-align:center">'.$plan_diag_cuadhemat_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_cuadhemat_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_cuadhemat_lab.'</td>
    <td style="text-align:center">'.$plan_diag_cuadhemat_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">Parcial de orina</td>
    <td style="text-align:center">'.$plan_diag_parcialorina.'</td>
    <td style="text-align:center">'.$plan_diag_parcialorina_autorizado.' </td>
    <td style="text-align:center">'.$plan_diag_parcialorina_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_parcialorina_lab.'</td>
    <td style="text-align:center">'.$plan_diag_parcialorina_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">Coprológico</td>
    <td style="text-align:center">'.$plan_diag_coprologico.'</td>
    <td style="text-align:center">'.$plan_diag_coprologico_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_coprologico_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_coprologico_lab.'</td>
    <td style="text-align:center">'.$plan_diag_coprologico_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">Citología fecal</td>
    <td style="text-align:center">'.$plan_diag_citologfecal.'</td>
    <td style="text-align:center">'.$plan_diag_citologfecal_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_citologfecal_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_citologfecal_lab.'</td>
    <td style="text-align:center">'.$plan_diag_citologfecal_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">Citología</td>
    <td style="text-align:center">'.$plan_diag_citolog.'</td>
    <td style="text-align:center">'.$plan_diag_citolog_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_citolog_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_citolog_lab.'</td>
    <td style="text-align:center">'.$plan_diag_citolog_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">Química sanguínea: 1.</td>
    <td style="text-align:center">'.$plan_diag_quimicsang1.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang1_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang1_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang1_lab.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang1_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">2.</td>
    <td style="text-align:center">'.$plan_diag_quimicsang2.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang2_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang2_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang2_lab.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang2_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">3.</td>
    <td style="text-align:center">'.$plan_diag_quimicsang3.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang3_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang3_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang3_lab.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang3_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">4.</td>
    <td style="text-align:center">'.$plan_diag_quimicsang4.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang4_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang4_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang4_lab.'</td>
    <td style="text-align:center">'.$plan_diag_quimicsang4_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">Rayos x</td>
    <td style="text-align:center">'.$plan_diag_rayx.'</td>
    <td style="text-align:center">'.$plan_diag_rayx_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_rayx_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_rayx_lab.'</td>
    <td style="text-align:center">'.$plan_diag_rayx_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">USG</td>
    <td style="text-align:center">'.$plan_diag_usg.'</td>
    <td style="text-align:center">'.$plan_diag_usg_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_usg_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_usg_lab.'</td>
    <td style="text-align:center">'.$plan_diag_usg_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">Cultivo</td>
    <td style="text-align:center">'.$plan_diag_cultivo.'</td>
    <td style="text-align:center">'.$plan_diag_cultivo_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_cultivo_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_cultivo_lab.'</td>
    <td style="text-align:center">'.$plan_diag_cultivo_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">Antibiograma</td>
    <td style="text-align:center">'.$plan_diag_antibiograma.'</td>
    <td style="text-align:center">'.$plan_diag_antibiograma_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_antibiograma_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_antibiograma_lab.'</td>
    <td style="text-align:center">'.$plan_diag_antibiograma_resul.'</td>
  </tr>
  <tr>
    <td style="text-align:left">Otro:</td>
    <td style="text-align:center">'.$plan_diag_otro.'</td>
    <td style="text-align:center">'.$plan_diag_otro_autorizado.'</td>
    <td style="text-align:center">'.$plan_diag_otro_fecha.'</td>
    <td style="text-align:center">'.$plan_diag_otro_lab.'</td>
    <td style="text-align:center">'.$plan_diag_otro_resul.'</td>
  </tr>
</table>

<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td><strong><em>INTERPRETACION DE RESULTADOS</em></strong></td>
    <td><strong><em>IMPRESIÓN DIAGNOSTICA</em></strong></td>
  </tr>
  <tr>
    <td>'.($plan_diag_interpre_resul).'</td>
    <td>'.($plan_diag_impresion_diag).'</td>
  </tr>
</table>

<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td colspan="10"><strong><em>PLAN TERAPEUTICO</em></strong></td>
  </tr>
  <tr>
    <td style="text-align:center"><strong>TS</strong></td>
    <td style="text-align:center"><strong>P</strong><strong> </strong></td>
    <td style="text-align:center"><strong>S</strong><strong> </strong></td>
    <td style="text-align:center"><strong>E</strong><strong> </strong></td>
    <td style="text-align:center"><strong>PRINCIPIO ACTIVO A ADMINISTRAR</strong></td>
    <td style="text-align:center"><strong>PRESENTACION</strong></td>
    <td style="text-align:center"><strong>POSOLOGIA</strong></td>
    <td style="text-align:center"><strong>DOSIS TOTAL</strong></td>
    <td style="text-align:center"><strong>VIA</strong></td>
    <td style="text-align:center"><strong>FRECUENCIA Y DURACIÓN</strong></td>
  </tr>
';
$sql_animal = "SELECT * FROM tbl15_plan_terapeutico WHERE cod_historia_clinica = '$cod_historia_clinica' ORDER BY cod_plan_terapeutico DESC";
$resultado_animal = mysqli_query($conectar, $sql_animal);
while ($info_animal = mysqli_fetch_assoc($resultado_animal)) {
 	 	 
$cod_plan_terapeutico              = $info_animal['cod_plan_terapeutico'];
$plan_terapeutico_ts               = $info_animal['plan_terapeutico_ts'];
$plan_terapeutico_p                = $info_animal['plan_terapeutico_p'];
$plan_terapeutico_s                = $info_animal['plan_terapeutico_s'];
$plan_terapeutico_e                = $info_animal['plan_terapeutico_e'];
$nombre_producto  = $info_animal['nombre_producto'];
$nombre_tipo_presentacion     = $info_animal['nombre_tipo_presentacion'];
$plan_terapeutico_posologia_cantidad        = $info_animal['plan_terapeutico_posologia_cantidad'];
$und_producto      = $info_animal['und_producto'];
$nombre_via_administracion              = $info_animal['nombre_via_administracion'];
$nombre_frec_duracion    = $info_animal['nombre_frec_duracion'];

$codigoHTML .= '
  <tr>
    <td style="text-align:center">'.$plan_terapeutico_ts.'</td>
    <td style="text-align:center">'.$plan_terapeutico_p.'</td>
    <td style="text-align:center">'.$plan_terapeutico_s.'</td>
    <td style="text-align:center">'.$plan_terapeutico_e.'</td>
    <td style="text-align:center">'.$nombre_producto.'</td>
    <td style="text-align:center">'.$nombre_tipo_presentacion.'</td>
    <td style="text-align:center">'.$plan_terapeutico_posologia_cantidad.'</td>
    <td style="text-align:center">'.$und_producto.'</td>
    <td style="text-align:center">'.$nombre_via_administracion.'</td>
    <td style="text-align:center">'.$nombre_frec_duracion.'</td>
  </tr>
';
}
$codigoHTML .= '
</table>

<table align="center" border="0" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td style="text-align:left">(<strong>T</strong><strong>S</strong>: Terapia de Sostén - <strong>P</strong>: Tratamiento preventivo &ndash; <strong>S</strong>: Tratamiento Sintomático &ndash; <strong>E</strong>:  Tratamiento Etiológico)
</td>
  </tr>
</table>

<table align="center" border="0" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td style="text-align:right"><strong>CONTROL (Fecha): '.$fecha_control.'</strong></td>
  </tr>
</table>
<br>

<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_emp.'pt;">
  <tr>
    <td colspan="4"><strong><em>AUXILIARES, PASANTES O ROTANTES</em></strong></td>
  </tr>
  <tr>
    <td style="text-align:center"><strong>NOMBRES Y APELLIDOS</strong></td>
    <td style="text-align:center"><strong>DOCUMENTO</strong></td>
    <td style="text-align:center"><strong>SEMESTRE</strong></td>
    <td style="text-align:center"><strong>FIRMA</strong></td>
  </tr>
';
$sql_animal = "SELECT * FROM tbl15_auxiliar_pasante WHERE cod_historia_clinica = '$cod_historia_clinica' ORDER BY cod_auxiliar_pasante DESC";
$resultado_animal = mysqli_query($conectar, $sql_animal);
while ($info_animal = mysqli_fetch_assoc($resultado_animal)) {
 	 	 
$cod_auxiliar_pasante              = $info_animal['cod_auxiliar_pasante'];
$cod_historia_clinica              = $info_animal['cod_historia_clinica'];
$nombre_auxiliar_pasante           = $info_animal['nombre_auxiliar_pasante'];
$doc_auxiliar_pasante              = $info_animal['doc_auxiliar_pasante'];
$semestre_auxiliar_pasante         = $info_animal['semestre_auxiliar_pasante'];
$url_firma_auxiliar_pasante        = $info_animal['url_firma_auxiliar_pasante'];

$codigoHTML .= '
  <tr>
    <td>'.$nombre_auxiliar_pasante.'</td>
    <td>'.$doc_auxiliar_pasante.'</td>
    <td>'.$semestre_auxiliar_pasante.'</td>
    <td>'.$url_firma_auxiliar_pasante.'</td>
  </tr>
';
}
$codigoHTML .= '
</table>

<!-- /////////////////////////////////////////////////// -->
<br>
<!-- /////////////////////////////////////////////////// -->
<table align="center" border="1" cellspacing="0" style="font-family:mono; font-size:10pt; width:100%">
  <tr>
    <td width="387" valign="top"><strong>Medico</strong>
    <div style="text-align:center"><img src="'.$propietario_url_firma_emp.'" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong>'.$nombres_prof.' '.$apellidos_prof.'</strong>
    <br />
    <strong>Reg. Medico '.$reg_medico_emp.'</strong>
    <br />
    <strong>Licencia Salud Ocupacional '.$licencia_emp.'</strong> </td>
    <td width="387" valign="top"><strong>Paciente</strong>
    <div style="text-align:center"><img src="'.$url_img_firma_min_cli.'" height="60px"/></div>
    <div>_________________________________________ </div>
    <strong>'.$nombres_cli.' '.$apellido1_cli.'</strong><br />
    <strong>C.C '.$cedula.'</strong> </td>
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
$nombre_archivo = 'HC_'.$nombres_cli.'_'.$apellido1_cli.'_'.$nombre_empresa.'_'.$fecha_ymd.'-'.$cedula.'-'.$fecha_hoy.'.pdf';
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