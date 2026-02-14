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
<a href="#"><h4>Lista <?php echo $nombre_concepto_multi_virtual; ?>S de usuario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_caja_mesa.php">Registrar <?php echo $nombre_concepto_multi_virtual; ?> a usuario</h4></a>
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
<!--<th style="text-align:center">ID</th>-->
<th style="text-align:center">USUARIO</th>
<th style="text-align:center"><?php echo $nombre_concepto_multi_virtual; ?></th>
<th style="text-align:center">EDIT</th>
</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_caja_mesa ORDER BY cod_base_caja ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

$cod_caja_mesa       = $matriz_consulta['cod_caja_mesa'];
$cod_base_caja       = $matriz_consulta['cod_base_caja'];
$cod_administrador   = $matriz_consulta['cod_administrador'];

$nombre_usuario      = '';

$sql_usuario = "SELECT nombres, apellidos, cuenta FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_usuario = mysqli_query($conectar, $sql_usuario) or die(mysqli_error($conectar));
$matriz_usuario = mysqli_fetch_assoc($consulta_usuario);

$nombres             = $matriz_usuario['nombres'];
$apellidos           = $matriz_usuario['apellidos'];
$cuenta              = $matriz_usuario['cuenta'];

$nombre_usuario      = $nombres.' '.$apellidos.' ('.$cuenta.')';
?>
<tr>
<!--<td style="text-align:center"><?php echo $cod_caja_mesa; ?></td>-->
<td style="text-align:left"><?php echo $nombre_usuario; ?></td>
<td style="text-align:center"><?php echo $cod_base_caja; ?></td>
<td style="text-align:center"><a href="../admin/edit_caja_mesa.php?cod_caja_mesa=<?php echo $cod_caja_mesa?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
</tr>
<?php
}
?>
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