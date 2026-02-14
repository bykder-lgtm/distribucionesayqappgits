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
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

$cod_historia_clinica    = intval($_POST['cod_historia_clinica']);
$cod_cliente             = intval($_POST['cod_cliente']);
$nombre_evolucion        = addslashes($_POST['nombre_evolucion']);
$fecha_ymd_hora          = addslashes($_POST['fecha_ymd_hora']);

$fecha_time = strtotime($fecha_ymd_hora);
$fecha_ymd = date("Y/m/d", $fecha_time);
$fecha_dmy = date("d/m/Y", $fecha_time);
$fecha_mes = date("m/Y", $fecha_time);
$fecha_anyo = date("Y", $fecha_time);
$hora = date("H:i", $fecha_time);
$fecha_reg_time = time();
$cuenta = $cuenta_actual;
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = "INSERT INTO tbl15_evolucion (nombre_evolucion, cod_historia_clinica, cod_cliente, fecha_ymd, fecha_time, cuenta) 
VALUES ('$nombre_evolucion', '$cod_historia_clinica', '$cod_cliente', '$fecha_ymd', '$fecha_time', '$cuenta')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<h3>Se ha guardado correctamente la evolución</h3>
<META HTTP-EQUIV="REFRESH" CONTENT="3; ../admin/lista_paciente.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_else?>">
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