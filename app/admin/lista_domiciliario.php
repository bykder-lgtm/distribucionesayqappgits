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
<a href="../admin/menu_lista.php"><h4>Lista de Domiciliarios&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="../admin/lista_domiciliario_inhabilitado.php">.</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="../admin/reg_domiciliario.php">Registrar Domiciliarios</h4></a>
</div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
$pagina                 = $_SERVER['PHP_SELF'];
$fecha_hoy              = date("Y-m-d");
?>
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr>
	<th style="text-align:center">NOMBRES DOMICILIARIO</th>
	<th style="text-align:center">APELLIDOS DOMICILIARIO</th>
	<th style="text-align:center">ESTADO</th>
	<th style="text-align:center">ID</th>
	<th style="text-align:center">EDIT</th>
</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_domiciliario WHERE (cod_estado = '1') ORDER BY cod_domiciliario ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_domiciliario                                = $matriz_consulta['cod_domiciliario'];
	$nombres_domiciliario                            = $matriz_consulta['nombres_domiciliario'];
	$apellidos_domiciliario                          = $matriz_consulta['apellidos_domiciliario'];
	$cod_estado                                      = $matriz_consulta['cod_estado'];
	$fecha_creacion                                  = $matriz_consulta['fecha_creacion'];
	$fecha_modificacion                              = $matriz_consulta['fecha_modificacion'];

    $sql_estado = "SELECT * FROM tbl15_estado WHERE (cod_estado = '$cod_estado')";
    $consulta_estado = mysqli_query($conectar, $sql_estado);
    $datos_estado = mysqli_fetch_assoc($consulta_estado);

    $nombre_estado                                   = $datos_estado['nombre_estado'];
?>
<tr>
	<td style="text-align:left"><?php echo $nombres_domiciliario; ?></td>
	<td style="text-align:left"><?php echo $apellidos_domiciliario; ?></td>
	<td style="text-align:center"><?php echo $nombre_estado; ?></td>
	<td style="text-align:center"><?php echo $cod_domiciliario; ?></td>
	<td style="text-align:center"><a href="../admin/edit_domiciliario.php?cod_domiciliario=<?php echo $cod_domiciliario?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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