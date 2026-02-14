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
<?php if ($cod_estado_usuario == '1') { ?><a href="../admin/menu_lista.php"><h4>Lista de Usuarios&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><?php } ?>
<?php if ($cod_estado_usuario_registrar == '1') { ?><a href="../admin/reg_usuario.php">Registrar Usuarios</h4></a><?php } ?>
</div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
$pagina = $_SERVER['PHP_SELF'];
?>

<?php if ($cod_estado_usuario == '1') { ?>
<div class="table-responsive">
<table class="table table-hover">
<thead>
	<tr>
		<th style="text-align:center">Cuenta</th>
		<th style="text-align:center">Nombres</th>
		<th style="text-align:center">Tipo de Rol</th>
		<!--<th style="text-align:center">Profesional</th>-->
		<th style="text-align:center">Correo</th>
		<th style="text-align:center">Telefono</th>
		<th style="text-align:center">Tpo App</th>
		<?php if ($cod_estado_usuario_editar == '1') { ?>
		<th style="text-align:center">Duplicar</th>
		<th style="text-align:center">Edit</th>
		<?php } ?>
	</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT tbl15_administrador.cod_administrador, tbl15_administrador.nombres, tbl15_administrador.apellidos, tbl15_administrador.cuenta, tbl15_administrador.creador, 
tbl15_administrador.estilo_css, tbl15_tipo_historia_clinica.nombre_tipo_historia_clinica, tbl15_seguridad.nombre_seguridad, tbl15_administrador.telefono, tbl15_administrador.correo, 
tbl15_administrador.fecha, tbl15_administrador.cod_tipo_aplicacion
FROM tbl15_tipo_historia_clinica RIGHT JOIN (tbl15_seguridad RIGHT JOIN tbl15_administrador ON tbl15_seguridad.cod_seguridad = tbl15_administrador.cod_seguridad) ON 
tbl15_tipo_historia_clinica.cod_tipo_historia_clinica = tbl15_administrador.cod_tipo_historia_clinica ORDER BY tbl15_administrador.cod_administrador DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

$cod_administrador             = $matriz_consulta['cod_administrador'];
$cuenta                        = $matriz_consulta['cuenta'];
$nombres                       = $matriz_consulta['nombres'];
$apellidos                     = $matriz_consulta['apellidos'];
$correo                        = $matriz_consulta['correo'];
$nombre_seguridad              = $matriz_consulta['nombre_seguridad'];
$estilo_css                    = $matriz_consulta['estilo_css'];
$creador                       = $matriz_consulta['creador'];
$fecha                         = $matriz_consulta['fecha'];
$telefono                      = $matriz_consulta['telefono'];
$nombre_tipo_historia_clinica  = $matriz_consulta['nombre_tipo_historia_clinica'];
$cod_tipo_aplicacion           = $matriz_consulta['cod_tipo_aplicacion'];

$sql_producto_total = "SELECT nombre_tipo_aplicacion FROM tbl15_tipo_aplicacion WHERE (cod_tipo_aplicacion = '$cod_tipo_aplicacion')";
$consulta_producto_total = mysqli_query($conectar, $sql_producto_total) or die(mysqli_error($conectar));
$datos_producto_total = mysqli_fetch_assoc($consulta_producto_total);

$nombre_tipo_aplicacion              = $datos_producto_total['nombre_tipo_aplicacion'];
?>
	<tr>
		<td style="text-align:left"><?php echo $cuenta; ?></td>
		<td style="text-align:left"><?php echo $nombres.' '.$apellidos; ?></td>
		<td style="text-align:center"><?php echo $nombre_seguridad; ?></td>
		<!--<td style="text-align:center"><?php echo $nombre_tipo_historia_clinica; ?></td>-->
		<td style="text-align:center"><?php echo $correo; ?></td>
		<td style="text-align:center"><?php echo $telefono; ?></td>
		<td style="text-align:center"><?php echo $nombre_tipo_aplicacion; ?></td>
		<?php if ($cod_estado_usuario_editar == '1') { ?>
		<td style="text-align:center"><a href="../admin/duplicar_usuario_reg.php?cod_administrador=<?php echo $cod_administrador?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/duplicar_factura_venta.png" class="img-polaroid" alt=""></a></td>
		<td style="text-align:center"><a href="../admin/edit_usuario.php?cod_administrador=<?php echo $cod_administrador?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
		<?php } ?>
	</tr>
<?php } ?>
</tr>
</tbody>
</table>
</div>
<?php } ?>
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