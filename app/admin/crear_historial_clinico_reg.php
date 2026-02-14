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

$cod_cliente = intval($_POST['cod_cliente']);
$motivo = (addslashes($_POST['motivo']));
$descripcion_medicamento = (addslashes($_POST['descripcion_medicamento']));
$descripcion_ayuda_diagnostica = (addslashes($_POST['descripcion_ayuda_diagnostica']));
$fecha_dmy = addslashes($_POST['fecha_dmy']);
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
$cuenta = $cuenta_actual;
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
$nombre_laboratorio = "";
if (isset($_POST['nombre_laboratorio']) && ($_POST['nombre_laboratorio'] != '')) {
foreach ($_POST['nombre_laboratorio'] as &$valor_laboratorio) {
$nombre_laboratorio_ = $valor_laboratorio;
$nombre_laboratorio .= $valor_laboratorio.'<br>';
}
unset($valor_laboratorio);
$nombre_laboratorio = '<p><strong>Laboratorio</strong>:<br> '.$nombre_laboratorio.'</p>';
} else { $nombre_laboratorio = ""; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
$nombre_medicamento = "";
if (isset($_POST['nombre_medicamento']) && ($_POST['nombre_medicamento'] != '')) {
foreach ($_POST['nombre_medicamento'] as &$valor_medicamento) {
$nombre_medicamento_ = $valor_medicamento;
$nombre_medicamento .= $valor_medicamento.'<br>';
}
unset($valor_medicamento);
$nombre_medicamento = '<p><strong>Medicamentos</strong>: '.$nombre_medicamento.'</p>';
} else { $nombre_medicamento = ""; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
$nombre_ayuda_diagnostica = "";
if (isset($_POST['cod_ayuda_diagnostica']) && ($_POST['cod_ayuda_diagnostica'] != '')) {
foreach ($_POST['cod_ayuda_diagnostica'] as &$valor_ayuda_diagnostica) {
$cod_ayuda_diagnostica_ = $valor_ayuda_diagnostica;
$sql_ayuda_diagnostica = "SELECT cod_ayuda_diagnostica, nombre_ayuda_diagnostica FROM tbl15_ayuda_diagnostica WHERE cod_ayuda_diagnostica = '$cod_ayuda_diagnostica_'";
$consulta_ayuda_diagnostica = mysqli_query($conectar, $sql_ayuda_diagnostica) or die(mysqli_error($conectar));
$datos_ayuda_diagnostica = mysqli_fetch_assoc($consulta_ayuda_diagnostica);
$nombre_ayuda_diagnostica .= $datos_ayuda_diagnostica['nombre_ayuda_diagnostica'].'<br>';
}
unset($valor_ayuda_diagnostica);
$nombre_ayuda_diagnostica = '<p><strong>Ayudas Diagnosticas</strong>: '.$nombre_ayuda_diagnostica.'</p>';
} else { $nombre_ayuda_diagnostica = ""; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = "INSERT INTO tbl15_historia_clinica (cod_cliente, motivo, nombre_laboratorio, nombre_medicamento, descripcion_medicamento, nombre_ayuda_diagnostica, descripcion_ayuda_diagnostica, fecha_ymd, fecha_dmy, fecha_mes, fecha_anyo, fecha_time, hora, fecha_reg_time, cuenta) 
VALUES ('$cod_cliente', '$motivo', '$nombre_laboratorio', '$nombre_medicamento', '$descripcion_medicamento', '$nombre_ayuda_diagnostica', '$descripcion_ayuda_diagnostica', '$fecha_ymd', '$fecha_dmy', '$fecha_mes', '$fecha_anyo', '$fecha_time', '$hora', '$fecha_reg_time', '$cuenta')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<h3>Se ha guardado correctamente la historia clinica</h3>
<META HTTP-EQUIV="REFRESH" CONTENT="3; ../admin/lista_historia_clinica_individual.php">
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