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
<div class="breadcrumbs"><a href="#"><h3>Registro</h3></a></div>
<div class="row-fluid">
<div class="span12" id="divMain">
<?php
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {
$pagina = addslashes($_POST['pagina']);

$cod_informe_condiciones_salud = intval($_POST['cod_informe_condiciones_salud']);
if (isset($_POST['titulo_informe_condiciones_salud']) <> '') { $titulo_informe_condiciones_salud = addslashes($_POST['titulo_informe_condiciones_salud']); } else { $titulo_informe_condiciones_salud = ''; }
if (isset($_POST['portada_informe_condiciones_salud']) <> '') { $portada_informe_condiciones_salud = addslashes($_POST['portada_informe_condiciones_salud']); } else { $portada_informe_condiciones_salud = ''; }
if (isset($_POST['introduccion_informe_condiciones_salud']) <> '') { $introduccion_informe_condiciones_salud = addslashes($_POST['introduccion_informe_condiciones_salud']); } else { $introduccion_informe_condiciones_salud = ''; }
if (isset($_POST['objetivo_informe_condiciones_salud']) <> '') { $objetivo_informe_condiciones_salud = addslashes($_POST['objetivo_informe_condiciones_salud']); } else { $objetivo_informe_condiciones_salud = ''; }
if (isset($_POST['material_metodo_informe_condiciones_salud']) <> '') { $material_metodo_informe_condiciones_salud = addslashes($_POST['material_metodo_informe_condiciones_salud']); } else { $material_metodo_informe_condiciones_salud = ''; }
if (isset($_POST['resultado_nivel_nal_informe_condiciones_salud']) <> '') { $resultado_nivel_nal_informe_condiciones_salud = addslashes($_POST['resultado_nivel_nal_informe_condiciones_salud']); } else { $resultado_nivel_nal_informe_condiciones_salud = ''; }
if (isset($_POST['caracter_sociodemo_informe_condiciones_salud']) <> '') { $caracter_sociodemo_informe_condiciones_salud = addslashes($_POST['caracter_sociodemo_informe_condiciones_salud']); } else { $caracter_sociodemo_informe_condiciones_salud = ''; }
if (isset($_POST['area_cargo_informe_condiciones_salud']) <> '') { $area_cargo_informe_condiciones_salud = addslashes($_POST['area_cargo_informe_condiciones_salud']); } else { $area_cargo_informe_condiciones_salud = ''; }
if (isset($_POST['distrib_sexo_informe_condiciones_salud']) <> '') { $distrib_sexo_informe_condiciones_salud = addslashes($_POST['distrib_sexo_informe_condiciones_salud']); } else { $distrib_sexo_informe_condiciones_salud = ''; }
if (isset($_POST['distrib_grup_etarico_informe_condiciones_salud']) <> '') { $distrib_grup_etarico_informe_condiciones_salud = addslashes($_POST['distrib_grup_etarico_informe_condiciones_salud']); } else { $distrib_grup_etarico_informe_condiciones_salud = ''; }
if (isset($_POST['distrib_nivel_escolar_informe_condiciones_salud']) <> '') { $distrib_nivel_escolar_informe_condiciones_salud = addslashes($_POST['distrib_nivel_escolar_informe_condiciones_salud']); } else { $distrib_nivel_escolar_informe_condiciones_salud = ''; }
if (isset($_POST['caracteristica_lab_cargo_informe_condiciones_salud']) <> '') { $caracteristica_lab_cargo_informe_condiciones_salud = addslashes($_POST['caracteristica_lab_cargo_informe_condiciones_salud']); } else { $caracteristica_lab_cargo_informe_condiciones_salud = ''; }
if (isset($_POST['distrib_poblacion_antig_informe_condiciones_salud']) <> '') { $distrib_poblacion_antig_informe_condiciones_salud = addslashes($_POST['distrib_poblacion_antig_informe_condiciones_salud']); } else { $distrib_poblacion_antig_informe_condiciones_salud = ''; }
if (isset($_POST['peligro_precibid_informe_condiciones_salud']) <> '') { $peligro_precibid_informe_condiciones_salud = addslashes($_POST['peligro_precibid_informe_condiciones_salud']); } else { $peligro_precibid_informe_condiciones_salud = ''; }
if (isset($_POST['habit_extra_lab_informe_condiciones_salud']) <> '') { $habit_extra_lab_informe_condiciones_salud = addslashes($_POST['habit_extra_lab_informe_condiciones_salud']); } else { $habit_extra_lab_informe_condiciones_salud = ''; }
if (isset($_POST['consumo_cigarr_informe_condiciones_salud']) <> '') { $consumo_cigarr_informe_condiciones_salud = addslashes($_POST['consumo_cigarr_informe_condiciones_salud']); } else { $consumo_cigarr_informe_condiciones_salud = ''; }
if (isset($_POST['actividad_fisica_informe_condiciones_salud']) <> '') { $actividad_fisica_informe_condiciones_salud = addslashes($_POST['actividad_fisica_informe_condiciones_salud']); } else { $actividad_fisica_informe_condiciones_salud = ''; }
if (isset($_POST['masa_corp_informe_condiciones_salud']) <> '') { $masa_corp_informe_condiciones_salud = addslashes($_POST['masa_corp_informe_condiciones_salud']); } else { $masa_corp_informe_condiciones_salud = ''; }
if (isset($_POST['enf_laboral_informe_condiciones_salud']) <> '') { $enf_laboral_informe_condiciones_salud = addslashes($_POST['enf_laboral_informe_condiciones_salud']); } else { $enf_laboral_informe_condiciones_salud = ''; }
if (isset($_POST['enf_laboral_reportada_informe_condiciones_salud']) <> '') { $enf_laboral_reportada_informe_condiciones_salud = addslashes($_POST['enf_laboral_reportada_informe_condiciones_salud']); } else { $enf_laboral_reportada_informe_condiciones_salud = ''; }
if (isset($_POST['accidente_lab_informe_condiciones_salud']) <> '') { $accidente_lab_informe_condiciones_salud = addslashes($_POST['accidente_lab_informe_condiciones_salud']); } else { $accidente_lab_informe_condiciones_salud = ''; }
if (isset($_POST['diag_principales_informe_condiciones_salud']) <> '') { $diag_principales_informe_condiciones_salud = addslashes($_POST['diag_principales_informe_condiciones_salud']); } else { $diag_principales_informe_condiciones_salud = ''; }
if (isset($_POST['recomendacion_general_informe_condiciones_salud']) <> '') { $recomendacion_general_informe_condiciones_salud = addslashes($_POST['recomendacion_general_informe_condiciones_salud']); } else { $recomendacion_general_informe_condiciones_salud = ''; }
if (isset($_POST['recomendacion_especif_informe_condiciones_salud']) <> '') { $recomendacion_especif_informe_condiciones_salud = addslashes($_POST['recomendacion_especif_informe_condiciones_salud']); } else { $recomendacion_especif_informe_condiciones_salud = ''; }
if (isset($_POST['promo_preven_salud_informe_condiciones_salud']) <> '') { $promo_preven_salud_informe_condiciones_salud = addslashes($_POST['promo_preven_salud_informe_condiciones_salud']); } else { $promo_preven_salud_informe_condiciones_salud = ''; }
if (isset($_POST['control_riesg_ocupa_informe_condiciones_salud']) <> '') { $control_riesg_ocupa_informe_condiciones_salud = addslashes($_POST['control_riesg_ocupa_informe_condiciones_salud']); } else { $control_riesg_ocupa_informe_condiciones_salud = ''; }
if (isset($_POST['divulg_resultado_informe_condiciones_salud']) <> '') { $divulg_resultado_informe_condiciones_salud = addslashes($_POST['divulg_resultado_informe_condiciones_salud']); } else { $divulg_resultado_informe_condiciones_salud = ''; }
if (isset($_POST['medida_control_informe_condiciones_salud']) <> '') { $medida_control_informe_condiciones_salud = addslashes($_POST['medida_control_informe_condiciones_salud']); } else { $medida_control_informe_condiciones_salud = ''; }
if (isset($_POST['seguimiento_informe_condiciones_salud']) <> '') { $seguimiento_informe_condiciones_salud= addslashes($_POST['seguimiento_informe_condiciones_salud']); } else { $seguimiento_informe_condiciones_salud = ''; }
if (isset($_POST['pagina']) <> '') { $pagina = addslashes($_POST['pagina']); } else { $pagina = ''; }
if (isset($_POST['fecha_ymd']) <> '') { $fecha_ymd = addslashes($_POST['fecha_ymd']); } else { $fecha_ymd = ''; }
$fecha_time                = strtotime($fecha_ymd);
$fecha_mes                 = date("m/Y", $fecha_time);
$fecha_anyo                = date("Y", $fecha_time);
$fecha_ymd                 = date("Y/m/d", $fecha_time);
$fecha_dmy                 = date("d/m/Y", $fecha_time);
$hora                      = date("H:i:s");
$fecha_reg_time            = time();
$cuenta                    = $cuenta_actual;
$cuenta_reg                = $cuenta_actual;

$query2 = "SELECT * FROM tbl15_informe_condiciones_salud WHERE (cod_informe_condiciones_salud = '$cod_informe_condiciones_salud')";
$result2 = mysqli_query($conectar, $query2);
$datos2 = mysqli_fetch_assoc($result2);

$fecha_ini                = $datos2['fecha_ini'];
$fecha_fin                = $datos2['fecha_fin'];
$nombre_empresa_contratante           = $datos2['nombre_empresa'];
$total_muestra            = $datos2['total_muestra'];
$total_motivo             = $datos2['total_motivo'];
$motivo                   = $datos2['motivo'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
$actualizar_historia_clinica = "UPDATE tbl15_informe_condiciones_salud SET titulo_informe_condiciones_salud = '$titulo_informe_condiciones_salud', portada_informe_condiciones_salud = '$portada_informe_condiciones_salud', 
introduccion_informe_condiciones_salud = '$introduccion_informe_condiciones_salud', objetivo_informe_condiciones_salud = '$objetivo_informe_condiciones_salud', 
material_metodo_informe_condiciones_salud = '$material_metodo_informe_condiciones_salud', resultado_nivel_nal_informe_condiciones_salud = '$resultado_nivel_nal_informe_condiciones_salud', 
caracter_sociodemo_informe_condiciones_salud = '$caracter_sociodemo_informe_condiciones_salud', area_cargo_informe_condiciones_salud = '$area_cargo_informe_condiciones_salud', 
distrib_sexo_informe_condiciones_salud = '$distrib_sexo_informe_condiciones_salud', distrib_grup_etarico_informe_condiciones_salud = '$distrib_grup_etarico_informe_condiciones_salud', 
distrib_nivel_escolar_informe_condiciones_salud = '$distrib_nivel_escolar_informe_condiciones_salud', caracteristica_lab_cargo_informe_condiciones_salud = '$caracteristica_lab_cargo_informe_condiciones_salud', 
distrib_poblacion_antig_informe_condiciones_salud = '$distrib_poblacion_antig_informe_condiciones_salud', peligro_precibid_informe_condiciones_salud = '$peligro_precibid_informe_condiciones_salud', 
habit_extra_lab_informe_condiciones_salud = '$habit_extra_lab_informe_condiciones_salud', consumo_cigarr_informe_condiciones_salud = '$consumo_cigarr_informe_condiciones_salud', 
actividad_fisica_informe_condiciones_salud = '$actividad_fisica_informe_condiciones_salud', masa_corp_informe_condiciones_salud = '$masa_corp_informe_condiciones_salud', 
enf_laboral_informe_condiciones_salud = '$enf_laboral_informe_condiciones_salud', enf_laboral_reportada_informe_condiciones_salud = '$enf_laboral_reportada_informe_condiciones_salud', 
accidente_lab_informe_condiciones_salud = '$accidente_lab_informe_condiciones_salud', diag_principales_informe_condiciones_salud = '$diag_principales_informe_condiciones_salud', 
recomendacion_general_informe_condiciones_salud = '$recomendacion_general_informe_condiciones_salud', recomendacion_especif_informe_condiciones_salud = '$recomendacion_especif_informe_condiciones_salud', 
promo_preven_salud_informe_condiciones_salud = '$promo_preven_salud_informe_condiciones_salud', control_riesg_ocupa_informe_condiciones_salud = '$control_riesg_ocupa_informe_condiciones_salud', 
divulg_resultado_informe_condiciones_salud = '$divulg_resultado_informe_condiciones_salud', medida_control_informe_condiciones_salud = '$medida_control_informe_condiciones_salud', 
seguimiento_informe_condiciones_salud = '$seguimiento_informe_condiciones_salud', 
fecha_time = '$fecha_time', fecha_mes = '$fecha_mes', fecha_anyo = '$fecha_anyo', fecha_ymd = '$fecha_ymd', fecha_dmy = '$fecha_dmy', 
hora = '$hora', fecha_reg_time = '$fecha_reg_time', cuenta = '$cuenta', cuenta_reg = '$cuenta_reg'
WHERE cod_informe_condiciones_salud = '$cod_informe_condiciones_salud'";
$resultado_historia_clinica = mysqli_query($conectar, $actualizar_historia_clinica) or die(mysqli_error($conectar));
?>
<h3>Se ha guardado correctamente</h3>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/vista_archivo_modificable_informe_diagnostico_condiciones_salud_fecharango_empresa_contratante_motivo.php?cod_informe_condiciones_salud=<?php echo $cod_informe_condiciones_salud ?>&fecha_ini=<?php echo $fecha_ini ?>&fecha_fin=<?php echo $fecha_fin ?>&nombre_empresa_contratante=<?php echo $nombre_empresa_contratante ?>&total_muestra=<?php echo $total_muestra ?>&total_motivo=<?php echo $total_motivo ?>&motivo=<?php echo $motivo ?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
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