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
<a href="../admin/menu_lista.php"><h4>Lista de Operadores de Credito&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_operador_credito.php">Registrar Operadores de Credito&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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
		<th style="text-align:center">Documento</th>
		<th style="text-align:center">Nombre</th>
		<th style="text-align:center">Tipo Cliente</th>
		<th style="text-align:center">Tipo Regimen</th>
		<th style="text-align:center">Tipo Impuesto</th>
		<th style="text-align:center">Edit</th>

	</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_operador_credito ORDER BY cod_operador_credito DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_operador_credito                            = $matriz_consulta['cod_operador_credito'];
	$nombre_operador_credito                         = $matriz_consulta['nombre_operador_credito'];
	$identificacion_tercero                          = $matriz_consulta['identificacion_tercero'];
	$nombre1_tercero                                 = $matriz_consulta['nombre1_tercero'];
	$nombre2_tercero                                 = $matriz_consulta['nombre2_tercero'];
	$apellido1_tercero                               = $matriz_consulta['apellido1_tercero'];
	$apellido2_tercero                               = $matriz_consulta['apellido2_tercero'];
	$direccion_tercero                               = $matriz_consulta['direccion_tercero'];
	$telefono1_tercero                               = $matriz_consulta['telefono1_tercero'];
	$correo_tercero                                  = $matriz_consulta['correo_tercero'];
	$cod_pais                                        = $matriz_consulta['cod_pais'];
	$cod_departamento                                = $matriz_consulta['cod_departamento'];
	$cod_municipio                                   = $matriz_consulta['cod_municipio'];
	$nombre_tipo_cliente                             = $matriz_consulta['nombre_tipo_cliente'];
	$nombre_tipo_regimen                             = $matriz_consulta['nombre_tipo_regimen'];
	$nombre_tipo_impuesto                            = $matriz_consulta['nombre_tipo_impuesto'];
	$nombre_operador_credito_completo                = trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero)
?>
	<tr>
		<td style="text-align:center"><?php echo $cod_operador_credito; ?></td>
		<td style="text-align:center"><?php echo $identificacion_tercero; ?></td>
		<td style="text-align:left"><?php echo $nombre_operador_credito_completo; ?></td>
		<td style="text-align:left"><?php echo $nombre_tipo_cliente; ?></td>
		<td style="text-align:left"><?php echo $nombre_tipo_regimen; ?></td>
		<td style="text-align:left"><?php echo $nombre_tipo_impuesto; ?></td>
		<td style="text-align:center"><a href="../admin/edit_operador_credito.php?cod_operador_credito=<?php echo $cod_operador_credito?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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