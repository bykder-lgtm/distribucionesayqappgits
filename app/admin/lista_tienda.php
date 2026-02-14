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
<a href="../admin/menu_lista.php"><h4>Lista de Tiendas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_tienda.php">Registrar Tienda&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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
		<th style="text-align:center">Abrev</th>
		<th style="text-align:center">Ver Producto</th>
		<th style="text-align:center">Edit</th>
	</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_tienda ORDER BY cod_tienda DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_tienda                            = $matriz_consulta['cod_tienda'];
	$nombre_tienda                         = $matriz_consulta['nombre_tienda'];
	$abrev_tienda                          = $matriz_consulta['abrev_tienda'];

    $sql_producto = "SELECT COUNT(cod_tienda) AS contero_producto FROM tbl15_producto WHERE (cod_tienda = '$cod_tienda')";
	$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
	$datos_producto = mysqli_fetch_assoc($consulta_producto);

    $contero_producto                      = $datos_producto['contero_producto'];
?>
	<tr>
		<td style="text-align:center"><?php echo $cod_tienda; ?></td>
		<td style="text-align:left"><?php echo $nombre_tienda; ?></td>
		<td style="text-align:center"><?php echo $abrev_tienda; ?></td>
		<td style="text-align:center"><a href="../admin/ver_producto_tienda.php?cod_tienda=<?php echo $cod_tienda?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""><?php echo $contero_producto ?></a></td>
		<td style="text-align:center"><a href="../admin/edit_tienda.php?cod_tienda=<?php echo $cod_tienda?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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