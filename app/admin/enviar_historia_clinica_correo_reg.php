<?php
include_once('../conexiones/conexione.php');
require '../PHPMailer/PHPMailerAutoload.php';
include_once '../admin/class_php/smtp.conf.gmail.php';
date_default_timezone_set('America/Bogota');
include_once('../evitar_mensaje_error/error.php');
//-----------------------------------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_historia_clinica'])) {

	$cod_historia_clinica                   = intval($_POST['cod_historia_clinica']);
	$nombres_apellidos                      = addslashes($_POST['nombres_apellidos']);
	$correo_enviar                          = addslashes($_POST['correo']);
	$pagina                                 = addslashes($_POST['pagina']);
	$randomize_pos4                         = rand(1000, 9999);
	$cantidad_digito                        = strlen($cod_historia_clinica);
	$codif                                  = $cantidad_digito.$randomize_pos4.$cod_historia_clinica.rand(10000, 99999);
	$cedula_idget                           = str_pad($codif, 15, $randomize_pos4, STR_PAD_RIGHT);
	$fecha_hoy                              = time();
	$fecha_hoy_time                         = time();
	$cod_historia_clinica_strpad            = str_pad($cod_historia_clinica, 8, "0", STR_PAD_LEFT);
	$fecha_ymd_his                          = date("Y-m-d H:i:s");
  	$anyo_actual                            = date("Y");

	$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
	$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
	$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

	$titulo_emp                          = $info_empresa_data['titulo'];
	$nombre_emp                          = $info_empresa_data['nombre'];
	$eslogan_emp                         = $info_empresa_data['eslogan'];
	$direccion_emp                       = $info_empresa_data['direccion'];
	$ciudad_emp                          = $info_empresa_data['ciudad'];
	$pais_emp                            = $info_empresa_data['pais'];
	$correo_emp                          = $info_empresa_data['correo'];
	$img_cabecera_emp                    = $info_empresa_data['img_cabecera'];
	$telefono_emp                        = $info_empresa_data['telefono'];
	$info_legal_emp                      = $info_empresa_data['info_legal'];
	$logotipo_emp                        = $info_empresa_data['logotipo'];
	$propietario_nombres_apellidos_emp   = $info_empresa_data['propietario_nombres_apellidos'];
	$propietario_nit_emp                 = $info_empresa_data['propietario_nit'];
	$nit_empresa_emp                     = $info_empresa_data['nit_empresa'];
	$cabecera_emp                        = $info_empresa_data['cabecera'];
	$icono_emp                           = $info_empresa_data['icono'];
	$desarrollador_emp                   = $info_empresa_data['desarrollador'];
	$pag_desarrollador_emp               = $info_empresa_data['pag_desarrollador'];
	$anyo_emp                            = $info_empresa_data['anyo'];
	$url_pag                             = $info_empresa_data['url_pag'];
	$nombre_font_emp                     = $info_empresa_data['nombre_font'];
	$tamano_font_hc_emp                  = $info_empresa_data['tamano_font_hc'];
	$tamano_font_aptlab_emp              = $info_empresa_data['tamano_font_aptlab'];
	$tamano_font_trabaltu_emp            = $info_empresa_data['tamano_font_trabaltu'];
	$tamano_font_manaliment_emp          = $info_empresa_data['tamano_font_manaliment'];
	$tamano_font_remision_emp            = $info_empresa_data['tamano_font_remision'];
	$tamano_font_factura_emp             = $info_empresa_data['tamano_font_factura'];
	$res_emp                             = $info_empresa_data['res'];
	$res1_emp                            = $info_empresa_data['res1'];
	$res2_emp                            = $info_empresa_data['res2'];
	$departamento_emp                    = $info_empresa_data['departamento'];
	$localidad_emp                       = $info_empresa_data['localidad'];
	$reg_medico_emp                      = $info_empresa_data['reg_medico'];
	$regimen_emp                         = $info_empresa_data['regimen'];
	$version_emp                         = $info_empresa_data['version'];
	$propietario_url_firma_emp           = $info_empresa_data['propietario_url_firma'];
	$fecha_time_emp                      = $info_empresa_data['fecha_time'];
	$licencia_emp                        = $info_empresa_data['licencia'];
	$info_histclinic_emp                 = $info_empresa_data['info_histclinic'];
	$info_aptlaboral_emp                 = $info_empresa_data['info_aptlaboral'];

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
	tbl15_historia_clinica.nombre_arl, tbl15_historia_clinica.nombre_empresa, tbl15_historia_clinica.razonsocial_empresa, 
	tbl15_historia_clinica.cargo_empresa, tbl15_historia_clinica.area_empresa, tbl15_historia_clinica.ciudad_empresa, 
	tbl15_historia_clinica.nombre_empresa_contratante, tbl15_historia_clinica.tel_cliente, tbl15_historia_clinica.correo, 
	tbl15_historia_clinica.cod_empresa, tbl15_historia_clinica.cod_entidad, tbl15_historia_clinica.lugar_residencia,  
	tbl15_historia_clinica.nombre_pais, tbl15_historia_clinica.nombre_departamento, 
	tbl15_historia_clinica.nombre_municipio, tbl15_historia_clinica.fecha_mes, tbl15_historia_clinica.fecha_anyo, 
	tbl15_historia_clinica.fecha_ymd, tbl15_historia_clinica.fecha_dmy, tbl15_historia_clinica.hora, tbl15_historia_clinica.fecha_time, 
	tbl15_historia_clinica.fecha_reg_time, tbl15_historia_clinica.url_img_firma_min, tbl15_historia_clinica.url_img_firma_orig, 
	tbl15_historia_clinica.url_img_foto_min, tbl15_historia_clinica.url_img_foto_orig, tbl15_historia_clinica.cuenta,
	tbl15_historia_clinica.nombre_vacum_can, tbl15_historia_clinica.nombre_vacum_can_pvc, tbl15_historia_clinica.nombre_vacum_can_triple, 
	tbl15_historia_clinica.nombre_vacum_can_rabia, tbl15_historia_clinica.nombre_vacum_can_otra, tbl15_historia_clinica.cod_empresa
	FROM tbl15_cliente RIGHT JOIN tbl15_historia_clinica ON tbl15_cliente.cod_cliente = tbl15_historia_clinica.cod_cliente 
	WHERE (tbl15_historia_clinica.cod_historia_clinica = '$cod_historia_clinica')";
	$resultado_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
	$info_historia_clinica = mysqli_fetch_assoc($resultado_historia_clinica);

	$cod_cliente                              = $info_historia_clinica['cod_cliente'];
	$cod_empresa                              = $info_historia_clinica['cod_empresa'];
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
	//$correo                                   = $info_historia_clinica['correo'];
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
	$sql_profesional = "SELECT nombres, apellidos, licencia, reg_medico, tarjeta_profesional, url_img_firma_prof_min, url_img_firma_prof_ori 
	FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
	$resultado_profesional = mysqli_query($conectar, $sql_profesional);
	$info_profesional = mysqli_fetch_assoc($resultado_profesional);

	$nombres_prof                              = $info_profesional['nombres'];
	$apellidos_prof                            = $info_profesional['apellidos'];
	$licencia_prof                             = $info_profesional['licencia'];
	$reg_medico_prof                           = $info_profesional['reg_medico'];
	$tarjeta_profesional_prof                  = $info_profesional['tarjeta_profesional'];
	$url_img_firma_prof_min_prof               = $info_profesional['url_img_firma_prof_min'];
	$url_img_firma_prof_ori_prof               = $info_profesional['url_img_firma_prof_ori'];
	// ------------------------------------------------------------------------------------------------------------------------- //
	// ------------------------------------------------------------------------------------------------------------------------- //
	$sql_empresa = "SELECT * FROM tbl15_empresa WHERE cod_empresa = '$cod_empresa'";
	$resultado_empresa = mysqli_query($conectar, $sql_empresa);
	$tbl15_info_empresa = mysqli_fetch_assoc($resultado_empresa);

	$nombre_empresa                            = $tbl15_info_empresa['nombre_empresa'];
	$direccion_empresa                         = $tbl15_info_empresa['direccion_empresa'];
	$telefono_empresa                          = $tbl15_info_empresa['telefono_empresa'];
	$nit_empresa                               = $tbl15_info_empresa['nit_empresa'];
	$correo_empresa                            = $tbl15_info_empresa['correo_empresa'];
	$estrato_empresa                           = $tbl15_info_empresa['estrato_empresa'];
	$ocupacion_empresa                         = $tbl15_info_empresa['ocupacion_empresa'];
	$municipio_empresa                         = $tbl15_info_empresa['municipio_empresa'];
	// ------------------------------------------------------------------------------------------------------------------------- //
	// ------------------------------------------------------------------------------------------------------------------------- //
	$pagina_local                             = $_SERVER['PHP_SELF'];
	$nombre_emisor                            = "Notificaciones ".ucwords(strtolower($nombre_emp));
	$correo_emisor                            = $Username;
	$nombre_receptor                          = str_replace(" ", "_", $nombres_apellidos);
	$correo_receptor                          = $correo_enviar;
	$nombre_contacto1_limp                    = str_replace(" ", "_", $nombre_contacto1);
	$motivo_consulta_limp                     = str_replace(" ", "_", $motivo_consulta);
	$nombre_empresa_limp                      = str_replace(" ", "_", $nombre_empresa);
	$nombres_limp                             = str_replace(" ", "_", $nombres);
	$cod_historia_clinica_strpad              = str_pad($cod_historia_clinica, 6, "0", STR_PAD_LEFT);
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	$fecha_ymd_hora                           = date("Y/m/d H:i:s", $fecha_time);
	$fecha_reg_time_dmy                       = date("d/m/Y", $fecha_reg_time);
	$fecha_hisroria_clinica                   = date("Y/m/d", $fecha_time);
	$nombre_documento                         = "HISTORIA CLINICA ".$cod_historia_clinica_strpad.' '.$nombres_limp.' '.$nombre_empresa_limp;
	$invitacion                               = "HISTORIA CLINICA ".$cod_historia_clinica_strpad.' '.$nombres_limp.' '.$nombre_empresa_limp;
	$asunto_correo_enviar                     = $invitacion;
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	include_once('mpdf/mpdf.php');
	$margen_izq                               = '10';
	$margen_der                               = '10';
	$margen_inf_encabezado                    = '30';
	$margen_sup_encabezado                    = '30';
	$posicion_sup_encabezado                  = '10';
	$posicion_inf_encabezado                  = '20';

	$titulo_doc_pdf                           = $nombre_documento;
	$autor_doc_pdf                            = $propietario_nombres_apellidos_emp;
	$creador_doc_pdf                          = $propietario_nombres_apellidos_emp;
	$tema_doc_pdf                             = "HISTORIA CLÍNICA";
	$palabras_claves_doc_pdf                  = $nombres_cli.' '.$cedula.'-'.$cod_historia_clinica;
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	/* --------------------------------------------------------------------------------------------------------------------------------- */
	//$mpdf                                = new mPDF('c','A4');
	$mpdf                                = new mPDF('en-GB-x','Legal','','',$margen_izq, $margen_der, $margen_inf_encabezado, $margen_sup_encabezado, $posicion_sup_encabezado, $posicion_inf_encabezado);
	$mpdf->mirrorMargins = 1; // Use different Odd/Even headers and footers and mirror margins
	//-----------------------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------------------//

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
	<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' - '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
	</table>
	';
	$footerE = '
	<table width="100%" style="border-top: 1px solid #000000; vertical-align: bottom; font-family:serif; font-size: 10pt; color: #000000;">
	<tr><td width="100%" style="text-align: center;"><h6>'.$direccion_emp.' &nbsp;&nbsp; - &nbsp;&nbsp; Tel&eacute;fonos: '.$telefono_emp.'<br>Email: '.$correo_emp.' - '.$ciudad_emp.' - '.$pais_emp.' [Página {PAGENO} de {nbpg}]</h6></td></tr>
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
	<table align="center" border="1" width="100%" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;"><thead><tr><th bgcolor="#FAC090" valign="middle"><span style="color:#FF0000">1. DATOS DEL PACIENTE</span></th></tr></thead></table>
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
	    <td colspan="2"><strong>NOMBRE:</strong> '.$nombres_completos.'</td>
	    <td><strong>ESPECIE:</strong> '.$nombre_especie.'</td>
	    <td colspan="2"><strong>RAZA:</strong> '.$nombre_raza.'</td>
	  </tr>
	  <tr>
	    <td colspan="2"><strong>COLOR:</strong> '.$nombre_color.'</td>
	    <td><strong>SEXO:</strong> '.$nombre_sexo.'</td>
	    <td colspan="2"><strong>FECHA NACIMIENTO:</strong> '.$fecha_nac_ymd.'</td>
	  </tr>
	  <tr>
	    <td><strong>EDAD (MESES):</strong> '.$edad_mes.'</td>
	    <td colspan="3"><strong>SEÑAS PARTICULARES:</strong> '.$senas_particulares.'</td>
	    <td><strong>PROCEDENCIA:</strong> '.$nombre_procedencia.'</td>
	  </tr>
	</table>

	<br>

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;">
	  <tr>
	    <td colspan="5"><strong><em>DATOS DEL PROPIETARIO</em></strong></td>
	  </tr>
	  <tr>
	    <td><strong>NOMBRE:</strong> '.$nombre_empresa.'</td>
	    <td colspan="2"><strong>IDENTIFICACIÓN:</strong> '.$nit_empresa.'</td>
	    <td colspan="2"><strong>DIRECCIÓN:</strong> '.$direccion_empresa.'</td>
	  </tr>
	   <tr>
	    <td><strong>ESTRATO:</strong> '.$estrato_empresa.'</td>
	    <td colspan="2"><strong>MUNICIPIO:</strong> '.$municipio_empresa.'</td>
	    <td colspan="2"><strong>TELÉFONO:</strong> '.$telefono_empresa.'</td>
	  </tr>
	   <tr>
	    <td colspan="2"><strong>EMAIL:</strong> '.$correo_empresa.'</td>
	    <td><strong>OCUPACIÓN:</strong> '.$ocupacion_empresa.'</td>
	    <td colspan="2"><strong></strong></td>
	  </tr>
	</table>

	<br>

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size:'.$tamano_font_hc_emp.'pt;">
	  <tr>
	    <td><strong><em>MOTIVO DE LA CONSULTA: </em></strong>'.$motivo.'</td>
	  </tr>
	  <tr>
	    <td><strong><em>ANAMNÉSICOS: </em></strong>'.$anamnesicos.'</td>
	  </tr>
	</table>

	<br>

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
	  <tr>
	    <td colspan="7"><strong><em>HISTORIA DEL PACIENTE</em></strong></td>
	  </tr>
	  <tr>
	    <td style="text-align:center" rowspan="7"><strong>VACUNACIÓN</strong></td>
	    <td style="text-align:center" colspan="3"><strong>'.$nombre_especie.'</strong></td>
	  </tr>
	  <tr>
	    <td>'.$nombre_vacum_can.'</td>
	    <td style="text-align:center">'.$vacum_can.'</td>
	    <td></td>
	  </tr>
	  <tr>
	    <td>'.$nombre_vacum_can_pvc.'</td>
	    <td style="text-align:center">'.$vacum_can_pvc.'</td>
	    <td>Fecha: '.$vacum_can_pvc_fecha.'</td>
	  </tr>
	  <tr>
	    <td>'.$nombre_vacum_can_triple.'</td>
	    <td style="text-align:center">'.$vacum_can_triple.'</td>
	    <td>Fecha: '.$vacum_can_triple_fecha.'</td>
	  </tr>
	  <tr>
	    <td>'.$nombre_vacum_can_rabia.'</td>
	    <td style="text-align:center">'.$vacum_can_rabia.'</td>
	    <td>Fecha: '.$vacum_can_rabia_fecha.'</td>
	  </tr>
	  <tr>
	    <td>'.$nombre_vacum_can_otra.'</td>
	    <td style="text-align:center">'.$vacum_can_otra.'</td>
	    <td>Fecha: '.$vacum_can_otra_fecha.'</td>
	  </tr>
	  <tr>
	    <td>¿Cuál?</td>
	    <td style="text-align:center">'.$vacum_can_otra_cual.'</td>
	    <td>Fecha: '.$vacum_can_otra_fecha.'</td>
	  </tr>
	</table>

	<br>

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
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


	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
	  <tr>
	    <td><strong><em>ESTADO REPRODUCTIVO:</em></strong></td>
	    <td>'.$nombre_estado_reproductivo.'</td>
	    <td>ALERGIAS:</td>
	    <td>'.$nombre_alergias.'</td>
	  </tr>
	</table>

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
	  <tr>
	    <td><strong><em>ENFERMEDADES ANTERIORES:</em></strong></td>
	    <td>'.$nombre_enf_ant.'</td>
	    <td><strong><em>CIRUGÍAS:</em></strong></td>
	    <td>'.$nombre_cirugias.'</td>
	  </tr>
	</table>


	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
	  <tr>
	    <td><strong><em>ANTECEDENTES FAMILIARES:</em></strong></td>
	    <td>'.$ant_fam.'</td>
	  </tr>
	</table>

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
	  <tr>
	    <td><strong><em>HÁBITAT:</em></strong></td>
	    <td>'.$nombre_habitat.'</td>
	  </tr>
	</table>

	<br>

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
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

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
	  <tr>
	    <td><strong>EXAMEN CLÍNICO</strong></td>
	  </tr>
	</table>

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
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

	<br>

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
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
	    <td style="text-align:center">'.$aparato_respirat.'</td>
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

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
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

	$codigoHTML.='
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

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
	  <tr>
	    <td style="text-align:left"><strong>(D</strong>: Degenerativa &ndash; <strong>A</strong>:  Anomalía congénita &ndash; <strong>M</strong>: Metabólica &ndash; <strong>N</strong>: Nutricional y neoplásica &ndash; <strong>V</strong>:  Vascular &ndash; <strong>I: </strong>Infecciosa, inflamatoria o idiomática &ndash; <strong>T</strong>: Trauma)</td>
	  </tr>
	</table>

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
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
	    <td style="text-align:left">Encimas Hepáticas</td>
	    <td style="text-align:center">'.$plan_diag_encima_hepatica.'</td>
	    <td style="text-align:center">'.$plan_diag_encima_hepatica_autorizado.'</td>
	    <td style="text-align:center">'.$plan_diag_encima_hepatica_fecha.'</td>
	    <td style="text-align:center">'.$plan_diag_encima_hepatica_lab.'</td>
	    <td style="text-align:center">'.$plan_diag_encima_hepatica_resul.'</td>
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

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
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

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
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
	$posologia_cantidad        = $info_animal['posologia_cantidad'];
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
	    <td style="text-align:center">'.$posologia_cantidad.'</td>
	    <td style="text-align:center">'.$und_producto.'</td>
	    <td style="text-align:center">'.$nombre_via_administracion.'</td>
	    <td style="text-align:center">'.$nombre_frec_duracion.'</td>
	  </tr>
	';
	}
	$codigoHTML .= '
	</table>


	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
	  <tr>
	    <td style="text-align:left">(<strong>T</strong><strong>S</strong>: Terapia de Sostén - <strong>P</strong>: Tratamiento preventivo &ndash; <strong>S</strong>: Tratamiento Sintomático &ndash; <strong>E</strong>:  Tratamiento Etiológico)
	</td>
	  </tr>
	</table>

	<table align="center" border="0" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
	  <tr>
	    <td style="text-align:right"><strong>CONTROL (Fecha): '.$fecha_control.'</strong></td>
	  </tr>
	</table>
	<br>

	<!-- /////////////////////////////////////////////////// -->
	<!--<div style="page-break-after: always"></div>-->
	<!-- /////////////////////////////////////////////////// -->

	<table align="center" border="1" width="100%" cellspacing="0" style="font-family: Mono; font-size: '.$tamano_font_hc_emp.'pt;">
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
	$cod_administrador                 = $info_animal['cod_administrador'];

	$sql_producto = "SELECT url_img_firma_prof_ori, url_img_firma_prof_min FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
	$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
	$datos_producto = mysqli_fetch_assoc($consulta_producto);
	 	 	 
	$url_img_firma_prof_ori          = $datos_producto['url_img_firma_prof_ori'];
	$url_img_firma_prof_min          = $datos_producto['url_img_firma_prof_min'];

	$codigoHTML .= '
	  <tr>
	    <td>'.$nombre_auxiliar_pasante.'</td>
	    <td style="text-align:center">'.$doc_auxiliar_pasante.'</td>
	    <td style="text-align:center">'.$semestre_auxiliar_pasante.'</td>
	    <td style="text-align:center"><img src="'.$url_img_firma_prof_ori.'" height="35px"/></td>
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
	    <div style="text-align:center"><img src="'.$url_img_firma_prof_ori_prof.'" height="60px"/></div>
	    <div>_________________________________________ </div>
	    <strong>'.$nombres_prof.' '.$apellidos_prof.'</strong>
	    <br />
	    <strong>Reg. Medico '.$reg_medico_prof.'</strong></td>

	    <td width="387" valign="top"><strong>Propietario</strong>
	    <br /><br /><br /><br />
	    <!--<div style="text-align:center"><img src="'.$url_img_firma_min_cli.'" height="60px"/></div>-->
	    <div>_________________________________________ </div>
	    <strong>'.$nombre_empresa.'</strong><br />
	    <strong>C.C '.$nit_empresa.'</strong> </td>
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

	$nombre_archivo = "HISTORIA_CLINICA__".$cod_historia_clinica_strpad.'__'.$nombres_limp.'__'.$nombre_empresa_limp.'__'.$fecha_hoy.'.pdf';
	$ruta_global_archivo = $ruta.$ruta.$nombre_archivo;
	$mpdf->Output($ruta_global_archivo, 'F');
	//-----------------------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------------------//
	$mensaje = "
	<!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
	<html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
	<head>
	<!--[if gte mso 9]>
	<xml>
	  <o:OfficeDocumentSettings>
	    <o:AllowPNG/>
	    <o:PixelsPerInch>96</o:PixelsPerInch>
	  </o:OfficeDocumentSettings>
	</xml>
	<![endif]-->
	  <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
	  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
	  <meta name='x-apple-disable-message-reformatting'>
	  <!--[if !mso]><!--><meta http-equiv='X-UA-Compatible' content='IE=edge'><!--<![endif]-->
	  <title></title>
	  
	<style type='text/css'>
	table, td { color: #000000; } a { color: #0000ee; text-decoration: underline; }
	@media only screen and (min-width: 620px) { .u-row { width: 600px !important; }
	.u-row .u-col { vertical-align: top; }
	.u-row .u-col-100 { width: 600px !important; }
	}
	@media (max-width: 620px) { .u-row-container { max-width: 100% !important; padding-left: 0px !important; padding-right: 0px !important; }
	.u-row .u-col { min-width: 320px !important; max-width: 100% !important; display: block !important; }
	.u-row { width: calc(100% - 40px) !important; }
	.u-col { width: 100% !important; }
	.u-col > div { margin: 0 auto; }
	}
	body { margin: 0; padding: 0; }
	table, tr, td { vertical-align: top; border-collapse: collapse; }
	p { margin: 0; }
	.ie-container table, .mso-container table { table-layout: fixed; }
	* { line-height: inherit; }
	a[x-apple-data-detectors='true'] { color: inherit !important; text-decoration: none !important; }
	@media (max-width: 480px) { .hide-mobile { display: none !important; max-height: 0px; overflow: hidden; }
	}
	</style>

	<!--[if !mso]><!--><link href='https://fonts.googleapis.com/css?family=Lato:400,700&display=swap' rel='stylesheet' type='text/css'><link href='https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap' rel='stylesheet' type='text/css'><!--<![endif]-->

	</head>
	";
	$mensaje .= "<body class='clean-body' style='margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff;color: #000000'>";

	$mensaje .= "
	  <!--[if IE]><div class='ie-container'><![endif]-->
	  <!--[if mso]><div class='mso-container'><![endif]-->
	  <table style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%' cellpadding='0' cellspacing='0'>
	  <tbody>
	  <tr style='vertical-align: top'>
	    <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
	    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td align='center' style='background-color: #ffffff;'><![endif]-->
	    

	<div class='u-row-container' style='padding: 0px;background-color: transparent'>
	  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ecf0f1;'>
	    <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
	      <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #ecf0f1;'><![endif]-->
	      
	<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
	<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
	  <div style='width: 100% !important;'>
	  <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
	  
	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:8px;font-family:arial,helvetica,sans-serif;' align='left'>
	        
	  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #ffffff;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
	    <tbody>
	      <tr style='vertical-align: top'>
	        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
	          <span>&#160;</span>
	        </td>
	      </tr>
	    </tbody>
	  </table>

	      </td>
	    </tr>
	  </tbody>
	</table>

	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;' align='left'>
	        
	<table width='100%' cellpadding='0' cellspacing='0' border='0'>
	  <tr>
	    <td style='padding-right: 0px;padding-left: 0px;' align='center'>
	      
	      <img align='center' border='0' src='../imagenes/cabecera_correo_hclinica.png' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 150px;' width='150'/>
	      
	    </td>
	  </tr>
	</table>

	      </td>
	    </tr>
	  </tbody>
	</table>

	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:6px;font-family:arial,helvetica,sans-serif;' align='left'>
	        
	  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #ffffff;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
	    <tbody>
	      <tr style='vertical-align: top'>
	        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
	          <span>&#160;</span>
	        </td>
	      </tr>
	    </tbody>
	  </table>

	      </td>
	    </tr>
	  </tbody>
	</table>

	  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
	  </div>
	</div>
	<!--[if (mso)|(IE)]></td><![endif]-->
	      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
	    </div>
	  </div>
	</div>



	<div class='u-row-container' style='padding: 0px;background-color: transparent'>
	  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #0CCBFF;'>
	    <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
	      <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #0CCBFF;'><![endif]-->
	      
	<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
	<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
	  <div style='width: 100% !important;'>
	  <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
	  
	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;' align='left'>
	        
	<div class='menu' style='text-align:center'>
	<!--[if (mso)|(IE)]><table role='presentation' border='0' cellpadding='0' cellspacing='0' align='center'><tr><![endif]-->
	  <!--[if (mso)|(IE)]><td style='padding:4px 15px'><![endif]-->
	  <span style='padding:4px 2px;display:inline;color:#ffffff;font-family:'Raleway',sans-serif;font-size:15px'>COMPRAR PRODUCTOS</span> 
	  <!--[if (mso)|(IE)]></td><![endif]-->
	    <!--[if (mso)|(IE)]><td style='padding:4px 15px'><![endif]-->
	    <span style='padding:4px 2px;display:inline;color:#ffffff;font-family:'Raleway',sans-serif;font-size:15px' class='hide-mobile'>|</span>
	    <!--[if (mso)|(IE)]></td><![endif]-->
	  <!--[if (mso)|(IE)]><td style='padding:4px 15px'><![endif]-->
	  <span style='padding:4px 2px;display:inline;color:#ffffff;font-family:'Raleway',sans-serif;font-size:15px'>COMPRAR MASCOTA</span>
	  <!--[if (mso)|(IE)]></td><![endif]-->
	    <!--[if (mso)|(IE)]><td style='padding:4px 15px'><![endif]-->
	    <span style='padding:4px 2px;display:inline;color:#ffffff;font-family:'Raleway',sans-serif;font-size:15px' class='hide-mobile'>|</span>
	    <!--[if (mso)|(IE)]></td><![endif]-->
	  <!--[if (mso)|(IE)]><td style='padding:4px 15px'><![endif]-->
	  <span style='padding:4px 2px;display:inline;color:#ffffff;font-family:'Raleway',sans-serif;font-size:15px'>NUESTROS SERVICIOS</span>
	  <!--[if (mso)|(IE)]></td><![endif]-->
	<!--[if (mso)|(IE)]></tr></table><![endif]-->
	</div>

	      </td>
	    </tr>
	  </tbody>
	</table>

	  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
	  </div>
	</div>
	<!--[if (mso)|(IE)]></td><![endif]-->
	      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
	    </div>
	  </div>
	</div>



	<div class='u-row-container' style='padding: 0px;background-color: transparent'>
	  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ecf0f1;'>
	    <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
	      <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #ecf0f1;'><![endif]-->
	      
	<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
	<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
	  <div style='width: 100% !important;'>
	  <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
	  
	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:30px 10px 15px 25px;font-family:arial,helvetica,sans-serif;' align='left'>
	        
	  <div style='line-height: 140%; text-align: center; word-wrap: break-word;'>
	    <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='font-size: 48px; line-height: 67.2px;'><span style='line-height: 67.2px; font-family: 'book antiqua', palatino; color: #000000; font-size: 48px;'><span style='line-height: 67.2px; font-size: 48px;'>Historia Clínica</span></span></span></p>
	  </div>

	      </td>
	    </tr>
	  </tbody>
	</table>

	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:0px 20px 0px 0px;font-family:arial,helvetica,sans-serif;' align='left'>
	        
	<table width='100%' cellpadding='0' cellspacing='0' border='0'>
	  <tr>
	    <td style='padding-right: 0px;padding-left: 0px;' align='center'>
	      
	      <img align='center' border='0' src='../imagenes/image-6.png' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 217px;' width='217'/>
	      
	    </td>
	  </tr>
	</table>

	      </td>
	    </tr>
	  </tbody>
	</table>

	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:30px 40px 10px;font-family:arial,helvetica,sans-serif;' align='left'>
	        
	  <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
	    <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='font-family: Lato, sans-serif; font-size: 16px; line-height: 22.4px;'>Hola, </span><span style='font-family: Lato, sans-serif; font-size: 16px; line-height: 22.4px;'>Por medio de este correo enviamos un archivo adjunto en pdf de la historia clínica</span></p>
	  </div>
	      </td>
	    </tr>
	  </tbody>
	</table>
	<!--
	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:10px 30px;font-family:arial,helvetica,sans-serif;' align='left'>
	  <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
	    <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='font-size: 16px; line-height: 22.4px; font-family: Lato, sans-serif;'>As a sorry, we offer a <span style='color: #ef0d33; font-size: 16px; line-height: 22.4px;'><strong><span style='font-size: 18px; line-height: 25.2px;'><span style='line-height: 25.2px; font-size: 18px;'>15% off</span> </span></strong></span>all items in your cart this week!</span></p>
	  </div>
	      </td>
	    </tr>
	  </tbody>
	</table>

	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:arial,helvetica,sans-serif;' align='left'>
	  <div style='line-height: 140%; text-align: center; word-wrap: break-word;'>
	    <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='font-size: 16px; line-height: 22.4px;'><strong><span style='font-family: Lato, sans-serif; line-height: 22.4px; font-size: 16px;'>U S E&nbsp; &nbsp; C O D E:&nbsp; &nbsp; </span><span style='font-family: Lato, sans-serif; line-height: 22.4px; font-size: 16px; color: #218838;'>HAPPY15%</span></strong></span></p>
	  </div>
	      </td>
	    </tr>
	  </tbody>
	</table>

	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:10px 10px 50px;font-family:arial,helvetica,sans-serif;' align='left'>
	<div align='center'>
	    <a href='' target='_blank' style='box-sizing: border-box;display: inline-block;font-family:arial,helvetica,sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #0CCBFF; border-radius: 0px; -webkit-border-radius: 0px; -moz-border-radius: 0px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;'>
	      <span style='display:block;padding:13px 28px;line-height:120%;'><span style='font-size: 16px; line-height: 19.2px; font-family: Lato, sans-serif;'>START&nbsp; &nbsp;SHOPPING</span></span>
	    </a>
	</div>
	      </td>
	    </tr>
	  </tbody>
	</table>
	-->
	  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
	  </div>
	</div>
	<!--[if (mso)|(IE)]></td><![endif]-->
	      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
	    </div>
	  </div>
	</div>

	<div class='u-row-container' style='padding: 0px;background-color: transparent'>
	  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ecf0f1;'>
	    <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
	      <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #ecf0f1;'><![endif]-->
	      
	<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
	<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
	  <div style='width: 100% !important;'>
	  <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
	  
	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:arial,helvetica,sans-serif;' align='left'>
	<table width='100%' cellpadding='0' cellspacing='0' border='0'>
	  <tr>
	    <td style='padding-right: 0px;padding-left: 0px;' align='center'>
	      <img align='center' border='0' src='../imagenes/image-4.png' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 552px;' width='552'/>
	    </td>
	  </tr>
	</table>

	      </td>
	    </tr>
	  </tbody>
	</table>

	  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
	  </div>
	</div>
	<!--[if (mso)|(IE)]></td><![endif]-->
	      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
	    </div>
	  </div>
	</div>

	<div class='u-row-container' style='padding: 0px;background-color: transparent'>
	  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #000000;'>
	    <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
	      <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #000000;'><![endif]-->
	      
	<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
	<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
	  <div style='width: 100% !important;'>
	  <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
	  
	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:40px 10px 20px;font-family:arial,helvetica,sans-serif;' align='left'>
	<div align='center'>
	  <div style='display: table; max-width:207px;'>
	  <!--[if (mso)|(IE)]><table width='207' cellpadding='0' cellspacing='0' border='0'><tr><td style='border-collapse:collapse;' align='center'><table width='100%' cellpadding='0' cellspacing='0' border='0' style='border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:207px;'><tr><![endif]-->
	  
	    <!--[if (mso)|(IE)]><td width='32' style='width:32px; padding-right: 20px;' valign='top'><![endif]-->
	    <table align='left' border='0' cellspacing='0' cellpadding='0' width='32' height='32' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 20px'>
	      <tbody><tr style='vertical-align: top'><td align='left' valign='middle' style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
	        <a href='https://twitter.com/' title='Twitter' target='_blank'>
	          <img src='../imagenes/image-2.png' alt='Twitter' title='Twitter' width='32' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important'>
	        </a>
	      </td></tr>
	    </tbody></table>
	    <!--[if (mso)|(IE)]></td><![endif]-->
	    
	    <!--[if (mso)|(IE)]><td width='32' style='width:32px; padding-right: 20px;' valign='top'><![endif]-->
	    <table align='left' border='0' cellspacing='0' cellpadding='0' width='32' height='32' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 20px'>
	      <tbody><tr style='vertical-align: top'><td align='left' valign='middle' style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
	        <a href='https://linkedin.com/' title='LinkedIn' target='_blank'>
	          <img src='../imagenes/image-3.png' alt='LinkedIn' title='LinkedIn' width='32' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important'>
	        </a>
	      </td></tr>
	    </tbody></table>
	    <!--[if (mso)|(IE)]></td><![endif]-->
	    
	    <!--[if (mso)|(IE)]><td width='32' style='width:32px; padding-right: 20px;' valign='top'><![endif]-->
	    <table align='left' border='0' cellspacing='0' cellpadding='0' width='32' height='32' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 20px'>
	      <tbody><tr style='vertical-align: top'><td align='left' valign='middle' style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
	        <a href='https://instagram.com/' title='Instagram' target='_blank'>
	          <img src='../imagenes/image-1.png' alt='Instagram' title='Instagram' width='32' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important'>
	        </a>
	      </td></tr>
	    </tbody></table>
	    <!--[if (mso)|(IE)]></td><![endif]-->
	    
	    <!--[if (mso)|(IE)]><td width='32' style='width:32px; padding-right: 0px;' valign='top'><![endif]-->
	    <table align='left' border='0' cellspacing='0' cellpadding='0' width='32' height='32' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px'>
	      <tbody><tr style='vertical-align: top'><td align='left' valign='middle' style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
	        <a href='https://github.com/' title='GitHub' target='_blank'>
	          <img src='../imagenes/image-7.png' alt='GitHub' title='GitHub' width='32' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important'>
	        </a>
	      </td></tr>
	    </tbody></table>
	    <!--[if (mso)|(IE)]></td><![endif]-->
	    
	    
	    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
	  </div>
	</div>

	      </td>
	    </tr>
	  </tbody>
	</table>

	  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
	  </div>
	</div>
	<!--[if (mso)|(IE)]></td><![endif]-->
	      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
	    </div>
	  </div>
	</div>

	<div class='u-row-container' style='padding: 0px;background-color: transparent'>
	  <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #000000;'>
	    <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
	      <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #000000;'><![endif]-->
	      
	<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
	<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
	  <div style='width: 100% !important;'>
	  <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
	<!--
	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:10px 40px;font-family:arial,helvetica,sans-serif;' align='left'>
	        
	  <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
	    <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #ffffff; font-size: 14px; line-height: 19.6px; font-family: Lato, sans-serif;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse </span></p>
	  </div>

	      </td>
	    </tr>
	  </tbody>
	</table>
	-->
	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:20px 10px 2px;font-family:arial,helvetica,sans-serif;' align='left'>
	        
	  <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='90%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #6e7074;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
	    <tbody>
	      <tr style='vertical-align: top'>
	        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
	          <span>&#160;</span>
	        </td>
	      </tr>
	    </tbody>
	  </table>

	      </td>
	    </tr>
	  </tbody>
	</table>

	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:7px 40px 5px;font-family:arial,helvetica,sans-serif;' align='left'>
	  <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
	    <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #ffffff; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>&copy; Petshop Clic &nbsp;| &nbsp;2021</span></p>
	  </div>
	      </td>
	    </tr>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:7px 40px 5px;font-family:arial,helvetica,sans-serif;' align='left'>
	  <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
	    <p style='font-size: 14px; line-height: 140%; text-align: center;'>
	    <span style='color: #ffffff; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Soporte Y Mantenimiento: <a href='".$pag_desarrollador_emp."'>".$desarrollador_emp."</a></span>
	    </p>
	  </div>
	      </td>
	    </tr>
	  </tbody>
	</table>

	<table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
	  <tbody>
	    <tr>
	      <td style='overflow-wrap:break-word;word-break:break-word;padding:7px 40px 20px;font-family:arial,helvetica,sans-serif;' align='left'>
	  <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
	    <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #666666; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Ha recibido este correo electrónico como usuario registrado de ".$pag_desarrollador_emp."</span></p>
	<p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #666666; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Usted puede <span style='text-decoration: underline; line-height: 16.8px; font-size: 12px;'>darse de baja </span>de estos correos electrónicos aquí.</span></p>
	  </div>
	      </td>
	    </tr>
	  </tbody>
	</table>

	  <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
	  </div>
	</div>
	<!--[if (mso)|(IE)]></td><![endif]-->
	      <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
	    </div>
	  </div>
	</div>


	    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
	    </td>
	  </tr>
	  </tbody>
	  </table>
	  <!--[if mso]></div><![endif]-->
	  <!--[if IE]></div><![endif]-->
	";
	$mensaje .= "</body>";
	$mensaje .= "</html>";


	$cod_tipo_modulo_envio_correo         = "12";
	$nombre_tipo_modulo_envio_correo      = "HISTORIA CLINICA PDF - CLINICO";
	$id_origen_correo                     = $cod_historia_clinica;
	$nombre_tabla_origen_correo           = "tbl15_historia_clinica";
	$nombre_campo_origen_correo           = "cod_historia_clinica";
	$nombre_origen_correo                 = "Recordatorio historia clinica";
	$correo_emisor                        = $correo_emisor;
	$correo_receptor                      = $correo_receptor;
	$asunto_correo                        = $asunto_correo_enviar;
	$mensaje_correo                       = $mensaje;
	$fecha_envio_correo                   = date("Y-m-d");
	$hora_envio_correo                    = date("H:i:s");
	$fecha_ymd_his                        = date("Y-m-d H:i:s");
	$fecha_time                           = time();
	$url_origen_correo                    = $_SERVER['PHP_SELF'];

	$mail = new PHPMailer;
	//$mail->SMTPDebug = 3;                          // Enable verbose debug output
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = $Host;  // Specify main and backup SMTP servers
	$mail->SMTPAuth = $SMTPAuth;                               // Enable SMTP authentication
	$mail->Username = $Username;                   // SMTP username
	$mail->Password = $Password;                             // SMTP password
	$mail->SMTPSecure = $SMTPSecure;                              // Enable TLS encryption, `ssl` also accepted
	$mail->Port = $Port;                                      // TCP port to connect to
	$mail->setFrom($correo_emisor, $correo_emp);
	$mail->addAddress($correo_receptor, $nombre_receptor);
	$mail->Subject = $invitacion;
	$mail->MsgHTML($mensaje);
	$mail->AddAttachment($ruta_global_archivo, $nombre_documento);

	if(!$mail->send()) { //INICIO SI EL CORREO NO SE ENVIA PORQUE HAY ERRORES
	    $cod_estado_envio_correo            = 0;
	    $nombre_estado_envio_correo         = "No Enviado";
	    $descripcion_error_envio_correo     = $mail->ErrorInfo;

		echo "<br><br><strong>Error nose pudo enviar...</strong>";
	}
	else { // INICIO SI EN CORREO SE ENVIO CORRECTAMENTE
	    $cod_estado_envio_correo            = 1;
	    $nombre_estado_envio_correo         = "Enviado Correctamente";
	    $descripcion_error_envio_correo     = "";

		echo "<br><br><strong>Enviado correctamente...</strong>";
		echo "<br><br>";
		echo '<input name="button" type="button" onclick="window.close();" value="Cerrar esta ventana" />';
	//$email_envio = $email + 1;
	} //FIN SI EN CORREO SE ENVIO CORRECTAMENTE
	$sql_envio_correo = "INSERT INTO tbl15_envio_correo (cod_tipo_modulo_envio_correo, nombre_tipo_modulo_envio_correo, id_origen_correo, nombre_tabla_origen_correo, nombre_campo_origen_correo, 
	nombre_origen_correo, correo_emisor, correo_receptor, cod_estado_envio_correo, nombre_estado_envio_correo, descripcion_error_envio_correo, fecha_envio_correo, hora_envio_correo, 
	url_origen_correo, fecha_ymd_his, fecha_time, asunto_correo) 
	VALUES ('$cod_tipo_modulo_envio_correo', '$nombre_tipo_modulo_envio_correo', '$id_origen_correo', '$nombre_tabla_origen_correo', '$nombre_campo_origen_correo', 
	'$nombre_origen_correo', '$correo_emisor', '$correo_receptor', '$cod_estado_envio_correo', '$nombre_estado_envio_correo', '$descripcion_error_envio_correo', '$fecha_envio_correo', '$hora_envio_correo', 
	'$url_origen_correo', '$fecha_ymd_his', '$fecha_time', '$asunto_correo')";
	$resultado_envio_correo = mysqli_query($conectar, $sql_envio_correo) or die(mysqli_error($conectar));
}
?>