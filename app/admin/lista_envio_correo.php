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
<!--<div class="container">-->
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="#"><h4>Lista de Correos Enviados&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_correo_smtp.php">Lista de Correos Smtp</h4></a>
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
			<th style="text-align:center;">MODULO ENVIO</th>
<!--
			<th style="text-align:center;">ID ORIGEN</th>
			<th style="text-align:center;">TABLA ORIGEN</th>
			<th style="text-align:center;">CAMPO ORIGEN</th>
			<th style="text-align:center;">EMISOR</th>
-->
			<th style="text-align:center;">RECEPTOR</th>
			<th style="text-align:center;">ESTADO ENVIO</th>
			<th style="text-align:center;">DESCRIPCION ERROR</th>
			<th style="text-align:center;">ASUNTO</th>
			<th style="text-align:center;">URL ORIGEN</th>
			<th style="text-align:center;">FECHA - HORA</th>
			<th style="text-align:center;">ID</th>
		</tr>
	</thead>
	<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_envio_correo ORDER BY cod_envio_correo DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_envio_correo                               = $matriz_consulta['cod_envio_correo'];
	$cod_tipo_modulo_envio_correo                   = $matriz_consulta['cod_tipo_modulo_envio_correo'];
	$nombre_tipo_modulo_envio_correo                = $matriz_consulta['nombre_tipo_modulo_envio_correo'];
	$id_origen_correo                               = $matriz_consulta['id_origen_correo'];
	$nombre_tabla_origen_correo                     = $matriz_consulta['nombre_tabla_origen_correo'];
	$nombre_campo_origen_correo                     = $matriz_consulta['nombre_campo_origen_correo'];
	$nombre_origen_correo                           = $matriz_consulta['nombre_origen_correo'];
	$correo_emisor                                  = $matriz_consulta['correo_emisor'];
	$correo_receptor                                = $matriz_consulta['correo_receptor'];
	$cod_estado_envio_correo                        = $matriz_consulta['cod_estado_envio_correo'];
	$nombre_estado_envio_correo                     = $matriz_consulta['nombre_estado_envio_correo'];
	$descripcion_error_envio_correo                 = $matriz_consulta['descripcion_error_envio_correo'];
	$asunto_correo                                  = $matriz_consulta['asunto_correo'];
	$mensaje_correo                                 = $matriz_consulta['mensaje_correo'];
	$url_origen_correo                              = $matriz_consulta['url_origen_correo'];
	$fecha_envio_correo                             = $matriz_consulta['fecha_envio_correo'];
	$hora_envio_correo                              = $matriz_consulta['hora_envio_correo'];
	$fecha_ymd_his                                  = $matriz_consulta['fecha_ymd_his'];
	$fecha_time                                     = $matriz_consulta['fecha_time'];
?>
		<tr>
			<td style="text-align:center;"><?php echo $nombre_tipo_modulo_envio_correo; ?></td>
<!--
			<td style="text-align:center;"><?php echo $id_origen_correo; ?></td>
			<td style="text-align:center;"><?php echo $nombre_tabla_origen_correo; ?></td>
			<td style="text-align:center;"><?php echo $nombre_campo_origen_correo; ?></td>
			<td style="text-align:center;"><?php echo $correo_emisor; ?></td>
-->
			<td style="text-align:center;"><?php echo $correo_receptor; ?></td>
			<td style="text-align:center;"><?php echo $nombre_estado_envio_correo; ?></td>
			<td style="text-align:left;"><?php echo $descripcion_error_envio_correo; ?></td>
			<td style="text-align:left;"><?php echo $asunto_correo; ?></td>
			<td style="text-align:center;"><?php echo $url_origen_correo; ?></td>
			<td style="text-align:center;"><?php echo $fecha_ymd_his; ?></td>
			<td style="text-align:center;"><?php echo $cod_envio_correo; ?></td>
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
<!--</div>-->
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