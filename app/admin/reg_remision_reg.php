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
$cod_historia_clinica           = intval($_POST['cod_historia_clinica']);
$cod_cliente                    = intval($_POST['cod_cliente']);

if (isset($_POST['nombre_tipo_remision']) <> '') { $nombre_tipo_remision = addslashes($_POST['nombre_tipo_remision']); } else { $nombre_tipo_remision = ''; }
if (isset($_POST['estructura_remision']) <> '') { $estructura_remision = addslashes($_POST['estructura_remision']); } else { $estructura_remision = ''; }

if (isset($_POST['exa_fis_talla']) <> '') { $exa_fis_talla = addslashes($_POST['exa_fis_talla']); } else { $exa_fis_talla = ''; }
if (isset($_POST['exa_fis_peso']) <> '') { $exa_fis_peso = addslashes($_POST['exa_fis_peso']); } else { $exa_fis_peso = ''; }
if (isset($_POST['exa_fis_imc']) <> '') { $exa_fis_imc = addslashes($_POST['exa_fis_imc']); } else { $exa_fis_imc = ''; }
if (isset($_POST['exa_fis_interpreimc']) <> '') { $exa_fis_interpreimc = addslashes($_POST['exa_fis_interpreimc']); } else { $exa_fis_interpreimc = ''; }
if (isset($_POST['exa_fis_fresp']) <> '') { $exa_fis_fresp = addslashes($_POST['exa_fis_fresp']); } else { $exa_fis_fresp = ''; }
if (isset($_POST['exa_fis_ta']) <> '') { $exa_fis_ta = addslashes($_POST['exa_fis_ta']); } else { $exa_fis_ta = ''; }
if (isset($_POST['exa_fis_fc']) <> '') { $exa_fis_fc = addslashes($_POST['exa_fis_fc']); } else { $exa_fis_fc = ''; }
if (isset($_POST['exa_fis_lateral']) <> '') { $exa_fis_lateral = addslashes($_POST['exa_fis_lateral']); } else { $exa_fis_lateral = ''; }
if (isset($_POST['exa_fis_periabdom']) <> '') { $exa_fis_periabdom = addslashes($_POST['exa_fis_periabdom']); } else { $exa_fis_periabdom = ''; }
if (isset($_POST['exa_fis_temperat']) <> '') { $exa_fis_temperat = addslashes($_POST['exa_fis_temperat']); } else { $exa_fis_temperat = ''; }
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
//---------------------------------------------------------------------------------------------------------------------------------------------//
$actualizar_historia_clinica = "UPDATE tbl15_historia_clinica SET nombre_tipo_remision = '$nombre_tipo_remision', estructura_remision = '$estructura_remision', 
exa_fis_talla = '$exa_fis_talla', exa_fis_peso = '$exa_fis_peso', exa_fis_imc = '$exa_fis_imc', exa_fis_interpreimc = '$exa_fis_interpreimc', 
exa_fis_fresp = '$exa_fis_fresp', exa_fis_ta = '$exa_fis_ta', exa_fis_fc = '$exa_fis_fc', exa_fis_lateral = '$exa_fis_lateral', 
exa_fis_periabdom = '$exa_fis_periabdom', exa_fis_temperat = '$exa_fis_temperat', exa_fis_ojoder_sncorre_vlejan = '$exa_fis_ojoder_sncorre_vlejan', 
exa_fis_ojoder_sncorre_vcerca = '$exa_fis_ojoder_sncorre_vcerca', exa_fis_ojoder_cncorre_vlejan = '$exa_fis_ojoder_cncorre_vlejan', 
exa_fis_ojoder_cncorre_vcerca = '$exa_fis_ojoder_cncorre_vcerca', exa_fis_ojoizq_sncorre_vlejan = '$exa_fis_ojoizq_sncorre_vlejan', 
exa_fis_ojoizq_sncorre_vcerca = '$exa_fis_ojoizq_sncorre_vcerca', exa_fis_ojoizq_cncorre_vlejan = '$exa_fis_ojoizq_cncorre_vlejan', 
exa_fis_ojoizq_cncorre_vcerca = '$exa_fis_ojoizq_cncorre_vcerca', exa_fis_ojoamb_sncorre_vlejan = '$exa_fis_ojoamb_sncorre_vlejan', 
exa_fis_ojoamb_sncorre_vcerca = '$exa_fis_ojoamb_sncorre_vcerca', exa_fis_oojoamb_cncorre_vlejan = '$exa_fis_oojoamb_cncorre_vlejan', 
exa_fis_ojoamb_cncorre_vcerca = '$exa_fis_ojoamb_cncorre_vcerca'
WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_historia_clinica = mysqli_query($conectar, $actualizar_historia_clinica) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------------------//
?>
<h3>Se ha guardado correctamente</h3>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_remision.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_remision.php">
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