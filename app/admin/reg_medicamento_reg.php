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
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

$pagina_else                   = addslashes($_POST['pagina']);
$nombre_medicamento            = strtoupper(addslashes($_POST['nombre_medicamento']));
$cod_tipo_historia_clinica     = intval($_POST['cod_tipo_historia_clinica']);
$cod_tipo_pos                  = intval($_POST['cod_tipo_pos']);
$cod_estado                    = intval($_POST['cod_estado']);
$principio_activo              = addslashes($_POST['principio_activo']);
$concentracion                 = addslashes($_POST['concentracion']);
$forma                         = addslashes($_POST['forma']);
$aclaracion                    = addslashes($_POST['aclaracion']);
$cod_atc                       = addslashes($_POST['cod_atc']);

$sql_data = "INSERT INTO tbl15_medicamento (nombre_medicamento, cod_tipo_historia_clinica, cod_tipo_pos, cod_estado, principio_activo, concentracion, forma, aclaracion, cod_atc) 
VALUES ('$nombre_medicamento', '$cod_tipo_historia_clinica', '$cod_tipo_pos', '$cod_estado', '$principio_activo', '$concentracion', '$forma', '$aclaracion', '$cod_atc')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_medicamento.php">
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