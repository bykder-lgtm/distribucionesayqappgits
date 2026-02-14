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
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="#"><h3>Historia Clinica Individual</h3></a></div>
<div class="row-fluid">
<div class="span12" id="divMain">
<?php
$cod_cliente = intval($_GET['cod_cliente']);

$sql_cliente = "SELECT cod_historia_clinica, cod_cliente, motivo, fecha_dmy, fecha_time FROM tbl15_historia_clinica WHERE (cod_cliente = '$cod_cliente') ORDER BY fecha_time";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);

$sql_historia_clinica = "SELECT * FROM tbl15_historia_clinica WHERE cod_cliente = '$cod_cliente'";
$resultado_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
$info_historia_clinica = mysqli_fetch_assoc($resultado_historia_clinica);

$motivo = $info_historia_clinica['motivo'];
$fecha_reg_time = $info_historia_clinica['fecha_reg_time'];
$fecha_time = $info_historia_clinica['fecha_time'];
$fecha_ymd = $info_historia_clinica['fecha_ymd'];
$hora = $info_historia_clinica['hora'];
$cuenta = $info_historia_clinica['cuenta'];

$sql_cliente = "SELECT * FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$cedula = $datos_cliente['cedula'];
$nombres = $datos_cliente['nombres'];
$apellido1 = $datos_cliente['apellido1'];
$apellido2 = $datos_cliente['apellido2'];
?>
<fieldset>
<p><a>CC:</a>
<td><?php echo ($cedula) ?></td></p>
<hr>
<p><a>Nombres:</a>
<td><?php echo ($nombres.' '.$apellido1.' '.$apellido2) ?></td></p>
<hr>
<p><a>Motivo De Consulta:</a></p>
<td><?php echo ($motivo) ?></td>
<hr>
</fieldset>
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