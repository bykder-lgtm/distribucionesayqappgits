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
<a href="#"><h4>Lista de Correos Smtp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_correo_smtp.php">Registrar Correos Smtp</a>
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
		<th style="text-align:center">Nombre Correo Smtp</th>
	<!--
		<th style="text-align:center">Contraseña Correo Smtp</th>
		<th style="text-align:center">Contraseña Encript Correo Smtp</th>
	-->
		<th style="text-align:center">Contraseña App Correo Smtp</th>
		<th style="text-align:center">Host Smtp</th>
		<th style="text-align:center">Auth Smtp</th>
		<th style="text-align:center">Secure Smtp</th>
		<th style="text-align:center">Puerto Smtp</th>
		<th style="text-align:center">Predeter</th>
		<th style="text-align:center">Estado</th>
		<th style="text-align:center">Edit</th>
	</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_correo_smtp";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_correo_smtp                         = $matriz_consulta['cod_correo_smtp'];
	$nombre_correo_smtp                      = $matriz_consulta['nombre_correo_smtp'];
	$nombre_alterno_correo_smtp              = $matriz_consulta['nombre_alterno_correo_smtp'];
	$contrasena_correo_smtp                  = $matriz_consulta['contrasena_correo_smtp'];
	$contrasena_encrip_correo_smtp           = $matriz_consulta['contrasena_encrip_correo_smtp'];
	$contrasena_app_correo_smtp              = $matriz_consulta['contrasena_app_correo_smtp'];
	$host_correo_smtp                        = $matriz_consulta['host_correo_smtp'];
	$auth_correo_smtp                        = $matriz_consulta['auth_correo_smtp'];
	$secure_correo_smtp                      = $matriz_consulta['secure_correo_smtp'];
	$port_correo_smtp                        = $matriz_consulta['port_correo_smtp'];
	$cod_estado_correo_predeterminado        = $matriz_consulta['cod_estado_correo_predeterminado'];
	$cod_estado                              = $matriz_consulta['cod_estado'];

	if ($cod_estado_correo_predeterminado == '1') { $nombre_estado_correo_predeterminado = 'SI'; } else { $nombre_estado_correo_predeterminado = 'NO'; }
	if ($cod_estado == '1') { $nombre_estado = 'HABILITADO'; } else { $nombre_estado = 'INHABILITADO'; }
?>
	<tr>
		<td style="text-align:center"><?php echo $cod_correo_smtp; ?></td>
		<td style="text-align:center"><?php echo $nombre_correo_smtp; ?></td>
	<!--
		<td style="text-align:center"><?php echo $contrasena_correo_smtp; ?></td>
		<td style="text-align:center"><?php echo $contrasena_encrip_correo_smtp; ?></td>
	-->
		<td style="text-align:center"><?php echo $contrasena_app_correo_smtp; ?></td>
		<td style="text-align:center"><?php echo $host_correo_smtp; ?></td>
		<td style="text-align:center"><?php echo $auth_correo_smtp; ?></td>
		<td style="text-align:center"><?php echo $secure_correo_smtp; ?></td>
		<td style="text-align:center"><?php echo $port_correo_smtp; ?></td>
		<td style="text-align:center"><?php echo $nombre_estado_correo_predeterminado; ?></td>
		<td style="text-align:center"><?php echo $nombre_estado; ?></td>
		<td style="text-align:center"><a href="../admin/edit_correo_smtp.php?cod_correo_smtp=<?php echo $cod_correo_smtp?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
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