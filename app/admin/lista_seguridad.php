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

<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista Tipo de Rol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<!--<a href="../admin/reg_seguridad.php">Registrar Tipo de Rol</h4></a>-->
</div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
$pagina = $_SERVER['PHP_SELF'];
?>
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr>
<th>Tipo de Rol</th>
<th>Funcion</th>
<th>Id</th>
<?php if ($cod_estado_tipo_roles_editar == '1') { ?><th>Edit</th><?php } ?>
</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT cod_seguridad, nombre_seguridad, funcion, cod_estado FROM tbl15_seguridad WHERE (cod_estado = '1') ORDER BY cod_seguridad ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

$cod_seguridad                             = $matriz_consulta['cod_seguridad'];
$nombre_seguridad                          = $matriz_consulta['nombre_seguridad'];
$funcion                                   = $matriz_consulta['funcion'];
$cod_estado                                = $matriz_consulta['cod_estado'];
?>
<tr>
<td ><?php echo $nombre_seguridad; ?></td>
<td ><?php echo $funcion; ?></td>
<td ><?php echo $cod_seguridad; ?></td>
<?php if ($cod_estado_tipo_roles_editar == '1') { ?><td align="center"><a href="../admin/edit_seguridad.php?cod_seguridad=<?php echo $cod_seguridad?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td><?php } ?>
</tr>
<?php } ?>
</tr>
</tbody>
</table>
</div>
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