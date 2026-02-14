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
<?php 
$pagina = $_SERVER['PHP_SELF']; 
$cod_historia_clinica = intval($_GET['cod_historia_clinica']);
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="../admin/edit_historia_clinica.php?cod_historia_clinica=<?php echo $cod_historia_clinica?>&pagina=<?php echo $pagina ?>"><h4>Historia Clinica<img src="../imagenes/actualizar.png" class="img-polaroid"></h4></a></div>
<div class="row-fluid">
<div class="span12" id="divMain">
<?php
$sql_historia_clinica = "SELECT * FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$resultado_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
$info_historia_clinica = mysqli_fetch_assoc($resultado_historia_clinica);

$cod_cliente = $info_historia_clinica['cod_cliente'];
$motivo = $info_historia_clinica['motivo'];
$nombre_laboratorio = $info_historia_clinica['nombre_laboratorio'];
$nombre_medicamento = $info_historia_clinica['nombre_medicamento'];
$descripcion_medicamento = $info_historia_clinica['descripcion_medicamento'];
$nombre_ayuda_diagnostica = $info_historia_clinica['nombre_ayuda_diagnostica'];
$descripcion_ayuda_diagnostica = $info_historia_clinica['descripcion_ayuda_diagnostica'];
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
<p><a>Laboratorio:</a></p>
<td><?php echo ($nombre_laboratorio) ?></td>
<hr>
<p><a>Medicamentos:</a></p>
<td><?php echo ($nombre_medicamento) ?></td>
<hr>
<p><a>Descripción Medicamentos:</a></p>
<td><?php echo ($descripcion_medicamento) ?></td>
<hr>
<p><a>Ayudas Diagnósticas:</a></p>
<td><?php echo ($nombre_ayuda_diagnostica) ?></td>
<hr>
<p><a>Descripción Ayudas Diagnósticas:</a></p>
<td><?php echo ($descripcion_ayuda_diagnostica) ?></td>
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