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
<a href="#"><h4>Lista de Producto Auxiliar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_producto_auxiliar.php">Registrar Producto Auxiliar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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
	<th style="text-align:center" class="column-title">Id</th>
    <th style="text-align:center" class="column-title">Codigo</th>
    <th style="text-align:center" class="column-title">Nombre Producto</th>
	<th style="text-align:center" class="column-title">Precio Compra</th>
    <th style="text-align:center" class="column-title">Precio Venta</th>
    <th style="text-align:center" class="column-title">Iva</th>
    <th style="text-align:center" class="column-title">Tipo Precio</th>
    <th style="text-align:center" class="column-title">Tipo Producto</th>
	<th style="text-align:center" class="column-title">Edit</th>
</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_producto_auxiliar ORDER BY cod_producto_auxiliar DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

$cod_producto_auxiliar              = $matriz_consulta['cod_producto_auxiliar'];
$cod_producto_barra                 = $matriz_consulta['cod_producto_barra'];
$nombre_producto                    = $matriz_consulta['nombre_producto'];
$precio_compra_producto             = $matriz_consulta['precio_compra_producto'];
$precio_venta_producto              = $matriz_consulta['precio_venta_producto'];
$iva_ptj                            = $matriz_consulta['iva_ptj'];
$nombre_tipo_unidad_medida          = $matriz_consulta['nombre_tipo_unidad_medida'];
$nombre_tipo_producto               = $matriz_consulta['nombre_tipo_producto'];
$nombre_tipo_precio_venta           = $matriz_consulta['nombre_tipo_precio_venta'];
$cod_dependencia                    = $matriz_consulta['cod_dependencia'];
?>
<tr>
	<td ><?php echo $cod_producto_auxiliar; ?></td>
	<td ><?php echo $cod_producto_barra; ?></td>
	<td ><?php echo $nombre_producto; ?></td>
	<td ><?php echo $precio_compra_producto; ?></td>
	<td ><?php echo $precio_venta_producto; ?></td>
	<td ><?php echo $iva_ptj; ?></td>
	<td ><?php echo $nombre_tipo_precio_venta; ?></td>
	<td ><?php echo $nombre_tipo_producto; ?></td>
	<td align="center"><a href="../admin/edit_producto_auxiliar.php?cod_producto_auxiliar=<?php echo $cod_producto_auxiliar?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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