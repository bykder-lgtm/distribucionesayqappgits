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
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

$cod_historia_clinica = intval($_POST['cod_historia_clinica']);
$motivo = (addslashes($_POST['motivo']));
$nombre_medicamento = (addslashes($_POST['nombre_medicamento']));
$descripcion_medicamento = (addslashes($_POST['descripcion_medicamento']));
$nombre_ayuda_diagnostica = (addslashes($_POST['nombre_ayuda_diagnostica']));
$descripcion_ayuda_diagnostica = (addslashes($_POST['descripcion_ayuda_diagnostica']));
$nombre_laboratorio = (addslashes($_POST['nombre_laboratorio']));
$fecha_dmy = (addslashes($_POST['fecha_dmy']));
$frag = explode('/', $fecha_dmy);
$dia = $frag[0];
$mes = $frag[1];
$anyo = $frag[2];

$fecha_ymd = $anyo.'/'.$mes.'/'.$dia;
$fecha_time = strtotime($fecha_ymd);
$hora = date("H:i:s");
$fecha_reg_time = time();
$fecha_mes = $mes.'/'.$anyo;
$fecha_anyo = $anyo;

$pagina = '../admin/ver_historia_clinica_html.php?cod_historia_clinica='.$cod_historia_clinica;

$actualizar_historia_clinica = "UPDATE tbl15_historia_clinica SET motivo = '$motivo', nombre_medicamento = '$nombre_medicamento', 
descripcion_medicamento = '$descripcion_medicamento', nombre_ayuda_diagnostica = '$nombre_ayuda_diagnostica', 
descripcion_ayuda_diagnostica = '$descripcion_ayuda_diagnostica', nombre_laboratorio = '$nombre_laboratorio', 
fecha_dmy = '$fecha_dmy', fecha_ymd = '$fecha_ymd', fecha_time = '$fecha_time', 
fecha_mes = '$fecha_mes', fecha_anyo = '$fecha_anyo' WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_historia_clinica = mysqli_query($conectar, $actualizar_historia_clinica) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_else?>">
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