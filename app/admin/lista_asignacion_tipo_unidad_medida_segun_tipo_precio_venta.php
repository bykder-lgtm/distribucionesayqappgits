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
<a href="../admin/lista_asignacion_tipo_unidad_medida_segun_tipo_precio_venta.php"><h4>Lista de Asignacion de Precios Segun Tipo de Venta&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<!--<a href="../admin/reg_asignacion_tipo_unidad_medida_segun_tipo_precio_venta.php">Registrar Dependencia&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>-->
</h4></a>
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
	<th style="text-align:center">Cod</th>
	<th style="text-align:center">Nombre</th>
	<th style="text-align:center">Tipo de Precio Predeterminado</th>
	<th style="text-align:center">Edit</th>
</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_tipo_unidad_medida WHERE (cod_estado_tipo_precio_venta = '1')";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_tipo_unidad_medida                  = $matriz_consulta['cod_tipo_unidad_medida'];
	$nombre_tipo_unidad_medida               = $matriz_consulta['nombre_tipo_unidad_medida'];
	$nombre_completo_tipo_unidad_medida      = $matriz_consulta['nombre_completo_tipo_unidad_medida'];
	$nombre_tipo_unidad_medida_abrev         = $matriz_consulta['nombre_tipo_unidad_medida_abrev'];
	$valor_equivalencia                      = $matriz_consulta['valor_equivalencia'];
	$nombre_equivalencia                     = $matriz_consulta['nombre_equivalencia'];
	$nombre_tipo_precio_venta                = $matriz_consulta['nombre_tipo_precio_venta'];
	$cod_estado                              = $matriz_consulta['cod_estado'];
	$cod_estado_tipo_precio_venta            = $matriz_consulta['cod_estado_tipo_precio_venta'];
?>
<tr>
	<td style="text-align:center"><?php echo $cod_tipo_unidad_medida; ?></td>
	<td style="text-align:center"><?php echo $nombre_tipo_unidad_medida; ?></td>
	<td style="text-align:center"><?php echo $nombre_tipo_precio_venta; ?></td>
	<td style="text-align:center"><a href="../admin/edit_asignacion_tipo_unidad_medida_segun_tipo_precio_venta.php?cod_tipo_unidad_medida=<?php echo $cod_tipo_unidad_medida?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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