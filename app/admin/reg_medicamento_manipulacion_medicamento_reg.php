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
if (isset($_GET['cod_historia_clinica'])) {

$cod_manipulacion_alimento     = intval($_GET['cod_manipulacion_alimento']);
$cod_historia_clinica          = intval($_GET['cod_historia_clinica']);
$cod_cliente                   = intval($_GET['cod_cliente']);
$pagina                        = addslashes($_GET['pagina'])."?cod_manipulacion_alimento=".$cod_manipulacion_alimento."&cod_historia_clinica=".$cod_historia_clinica."&cod_cliente=".$cod_cliente."&pagina=lista_historia_clinica_individual_medico.php";

$nombre_generico       = "";
$concentracion         = "";
$forma_farmaceutica    = "";
$dosis                 = "";
$cantidad_numero       = "";
$cantidad_letra        = "";
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = "INSERT INTO tbl15_medicamento_formulado (nombre_generico, concentracion, forma_farmaceutica, dosis, cantidad_numero, cantidad_letra, cod_manipulacion_alimento, cod_historia_clinica, cod_cliente, cod_administrador) 
VALUES ('$nombre_generico', '$concentracion', '$forma_farmaceutica', '$dosis', '$cantidad_numero', '$cantidad_letra', '$cod_manipulacion_alimento', '$cod_historia_clinica', '$cod_cliente', '$cod_administrador')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//include('manipulacion_alimento_include.php');
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
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