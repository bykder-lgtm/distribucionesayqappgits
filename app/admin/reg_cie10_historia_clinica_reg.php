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

$cod_cie10            = intval($_GET['cod_cie10']);
$cod_historia_clinica = intval($_GET['cod_historia_clinica']);
$cod_cliente          = intval($_GET['cod_cliente']);
$foco                 = addslashes($_GET['foco']);
$pagina               = addslashes($_GET['pagina'])."?cod_historia_clinica=".$cod_historia_clinica."&cod_cliente=".$cod_cliente."&foco=".$foco."&pagina=lista_historia_clinica_individual_medico.php";

$mostrar_datos_sql = "SELECT cod_cie10, codigo_cie10, descripcion_cie10 FROM tbl15_cie10 WHERE cod_cie10 = '$cod_cie10'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cie10_cod            = $matriz_consulta['codigo_cie10'];
$cie10_diag           = $matriz_consulta['descripcion_cie10'];

$cie10_impdiag        = "";
$cie10_confirnuev     = "";
$cie10_confirepet     = "";
$cie10_diagprinc      = "";
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = "INSERT INTO tbl15_cie10diag (cie10_cod, cie10_diag, cie10_impdiag, cie10_confirnuev, cie10_confirepet, cie10_diagprinc, cod_historia_clinica, cod_cliente, cod_administrador) 
VALUES ('$cie10_cod', '$cie10_diag', '$cie10_impdiag', '$cie10_confirnuev', '$cie10_confirepet', '$cie10_diagprinc', '$cod_historia_clinica', '$cod_cliente', '$cod_administrador')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
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