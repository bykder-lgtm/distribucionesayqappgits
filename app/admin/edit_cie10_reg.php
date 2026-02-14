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
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

$cod_historia_clinica = intval($_POST['cod_historia_clinica']);
$cod_cliente          = intval($_POST['cod_cliente']);
$total_datos          = intval($_POST['total_datos']);

for ($i=0; $i < $total_datos; $i++) {

$cod_cie10diag        = $_POST['cod_cie10diag'][$i];
$cie10_cod            = addslashes($_POST['cie10_cod'][$i]);
$cie10_diag           = addslashes($_POST['cie10_diag'][$i]);
$cie10_impdiag        = addslashes($_POST['cie10_impdiag'][$i]);
$cie10_confirnuev     = addslashes($_POST['cie10_confirnuev'][$i]);
$cie10_confirepet     = addslashes($_POST['cie10_confirepet'][$i]);
$cie10_diagprinc      = addslashes($_POST['cie10_diagprinc'][$i]);
//$pagina = addslashes($_POST['pagina']);
/* ------------------------------------------------------------------------------------------------------------------------ */
$sql_data = "UPDATE tbl15_cie10diag SET cie10_cod = '$cie10_cod', cie10_diag = '$cie10_diag', cie10_impdiag = '$cie10_impdiag', 
cie10_confirnuev = '$cie10_confirnuev', cie10_confirepet = '$cie10_confirepet', cie10_diagprinc = '$cie10_diagprinc' 
WHERE cod_cie10diag = '$cod_cie10diag'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
/* ------------------------------------------------------------------------------------------------------------------------ */
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/escoger_opcion_concepto_actitud_laboral_o_verlistapaciente.php?cod_historia_clinica=<?php echo $cod_historia_clinica ?>&cod_cliente=<?php echo $cod_cliente ?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/escoger_opcion_concepto_actitud_laboral_o_verlistapaciente.php?cod_historia_clinica=<?php echo $cod_historia_clinica ?>&cod_cliente=<?php echo $cod_cliente ?>">
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