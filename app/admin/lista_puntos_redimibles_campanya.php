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
<a href="#"><h4>Lista de Campaña Puntos Redimibles&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_puntos_redimibles_campanya.php">Registrar Campaña Puntos Redimibles</h4></a>
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
	<th style="text-align:center">COD</th>
	<th style="text-align:center">NOMBRE CAMPAÑA PUNTOS REDIMIBLES</th>
	<th style="text-align:center">POR CADA ($PESOS)</th>
	<th style="text-align:center">GANAS (PUNTO)</th>
	<th style="text-align:center">EQUIVALENCIA EN PESOS DE UN PUNTO (VALOR DEL PUNTO)</th>
	<th style="text-align:center">ESTADO</th>
	<th style="text-align:center">FECHA CREACION</th>
	<th style="text-align:center">EDIT</th>
</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_puntos_redimibles_campanya ORDER BY cod_puntos_redimibles_campanya DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_puntos_redimibles_campanya                           = $matriz_consulta['cod_puntos_redimibles_campanya'];
	$nombre_puntos_redimibles_campanya                        = $matriz_consulta['nombre_puntos_redimibles_campanya'];
	$valor_puntos_redimibles_campanya                         = $matriz_consulta['valor_puntos_redimibles_campanya'];
	$cantidad_puntos_x_valor_redimibles_campanya              = $matriz_consulta['cantidad_puntos_x_valor_redimibles_campanya'];
	$equivalencia_en_pesos_de_un_punto                        = $matriz_consulta['equivalencia_en_pesos_de_un_punto'];
	$fecha_creacion                                           = $matriz_consulta['fecha_creacion'];
	$cod_estado                                               = $matriz_consulta['cod_estado'];

	$consulta2_sql = ("SELECT nombre_tipo_estado FROM tbl15_tipo_estado WHERE (cod_tipo_estado = '$cod_estado')");
	$consulta2 = mysqli_query($conectar, $consulta2_sql);
	$datos2 = mysqli_fetch_assoc($consulta2);

	$nombre_tipo_estado = $datos2['nombre_tipo_estado'];
?>
<tr>
	<td style="text-align:center"><?php echo $cod_puntos_redimibles_campanya; ?></td>
	<td style="text-align:left"><?php echo $nombre_puntos_redimibles_campanya; ?></td>
	<td style="text-align:center"><?php echo number_format($valor_puntos_redimibles_campanya, 0, ",", "."); ?></td>
	<td style="text-align:center"><?php echo $cantidad_puntos_x_valor_redimibles_campanya; ?></td>
	<td style="text-align:center"><?php echo $equivalencia_en_pesos_de_un_punto; ?></td>
	<td style="text-align:center"><?php echo $nombre_tipo_estado; ?></td>
	<td style="text-align:center"><?php echo $fecha_creacion; ?></td>
	<td style="text-align:center"><a href="../admin/edit_puntos_redimibles_campanya.php?cod_puntos_redimibles_campanya=<?php echo $cod_puntos_redimibles_campanya?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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