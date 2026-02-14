<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista Unidad Medida&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_tipo_unidad_medida.php">Registrar Unidad Medida</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
?>
<div class="table-responsive">
<table class="table table-striped">
<thead>
	<tr>
		<th>Unidad Medida Abrev</th>
		<th>Unidad Medida</th>
		<th>Valor</th>
		<th>Equivalencia</th>
		<th>Estado</th>
		<th>Cod</th>
		<th>Edit</th>
	</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT * FROM tbl15_tipo_unidad_medida";
$resultado_cliente = mysqli_query($conectar, $sql_cliente);
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
 	
	$cod_tipo_unidad_medida               = $info_cliente['cod_tipo_unidad_medida'];
	$nombre_tipo_unidad_medida            = $info_cliente['nombre_tipo_unidad_medida'];
	$nombre_completo_tipo_unidad_medida   = $info_cliente['nombre_completo_tipo_unidad_medida'];
	$valor_equivalencia                   = $info_cliente['valor_equivalencia'];
	$nombre_equivalencia                  = $info_cliente['nombre_equivalencia'];
	$cod_estado                           = $info_cliente['cod_estado'];

	$sql_conteo_atendido_mujer = "SELECT * FROM tbl15_estado WHERE (cod_estado = '$cod_estado')";
	$consulta_conteo_atendido_mujer = mysqli_query($conectar, $sql_conteo_atendido_mujer) or die(mysqli_error($conectar));
	$datos_conteo_atendido_mujer = mysqli_fetch_assoc($consulta_conteo_atendido_mujer);

	$nombre_estado                           = $datos_conteo_atendido_mujer['nombre_estado'];
?>
	<tr>
		<td><?php echo $nombre_tipo_unidad_medida?></td>
		<td><?php echo $nombre_completo_tipo_unidad_medida?></td>
		<td><?php echo $valor_equivalencia?></td>
		<td><?php echo $nombre_equivalencia?></td>
		<td><?php echo $nombre_estado?></td>
		<td><?php echo $cod_tipo_unidad_medida?></td>
		<td align="center"><a href="../admin/edit_tipo_unidad_medida.php?cod_tipo_unidad_medida=<?php echo $cod_tipo_unidad_medida?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
	</tr>
<?php } ?>
</tbody>
</table>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>