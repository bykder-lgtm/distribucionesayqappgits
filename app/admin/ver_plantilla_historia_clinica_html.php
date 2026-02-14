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
$cod_tipo_historia_clinica = intval($_GET['cod_tipo_historia_clinica']);
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="../admin/edit_plantilla_historia_clinica.php?cod_tipo_historia_clinica=<?php echo $cod_tipo_historia_clinica?>&pagina=<?php echo $pagina ?>"><h4>Plantilla Historia Clinica<img src="../imagenes/actualizar.png" class="img-polaroid"></h4></a></div>
<div class="row-fluid">
<div class="span12" id="divMain">
<?php
$sql_historia_clinica = "SELECT * FROM tbl15_tipo_historia_clinica WHERE cod_tipo_historia_clinica = '$cod_tipo_historia_clinica'";
$resultado_historia_clinica = mysqli_query($conectar, $sql_historia_clinica);
$info_historia_clinica = mysqli_fetch_assoc($resultado_historia_clinica);

$nombre_tipo_historia_clinica = $info_historia_clinica['nombre_tipo_historia_clinica'];
$estructura_tipo_historia_clinica = $info_historia_clinica['estructura_tipo_historia_clinica'];
?>
<fieldset>
<table border="1" class="table table-responsive">
		<thead><tr><th><?php echo $nombre_tipo_historia_clinica ?></th></tr></thead>
    <tbody><tr><td><?php echo ($estructura_tipo_historia_clinica) ?></td></tr></tbody>
</table>
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