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
<?php if ($cod_estado_usuario == '1') { ?><a href="../admin/lista_usuario.php"><h4>Lista de Recargas Monedero&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><?php } ?>
<?php if ($cod_estado_usuario_registrar == '1') { ?></h4><?php } ?>
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
		<th style="text-align:center">Vendedor</th>
		<th style="text-align:center">Recarga en Monedero</th>
		<th style="text-align:center">Saldo en ese momento</th>
		<th style="text-align:center">Fecha</th>
		<th style="text-align:center">Hora</th>
		<th style="text-align:center">IDV</th>
	</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_recarga_vendedor ORDER BY cod_recarga_vendedor DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

  	$cod_recarga_vendedor                                  = $matriz_consulta['cod_recarga_vendedor'];
	$recarga_actual                                        = $matriz_consulta['recarga_actual'];
	$saldo_recarga                                         = $matriz_consulta['saldo_recarga'];
	$cod_administrador_vendedor                            = $matriz_consulta['cod_administrador_vendedor'];
	$cod_administrador_recarga                             = $matriz_consulta['cod_administrador_recarga'];
	$fecha_recarga_vendedor                                = $matriz_consulta['fecha_recarga_vendedor'];
	$hora_recarga_vendedor                                 = $matriz_consulta['hora_recarga_vendedor'];
	$fecha_seg_recarga_vendedor                            = $matriz_consulta['fecha_seg_recarga_vendedor'];
	//$cuenta                                                = $matriz_consulta['cuenta'];

	$sql_producto_total = "SELECT * FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_vendedor')";
	$consulta_producto_total = mysqli_query($conectar, $sql_producto_total) or die(mysqli_error($conectar));
	$datos_producto_total = mysqli_fetch_assoc($consulta_producto_total);

	$cuenta                                                = $datos_producto_total['cuenta'];
	$identificacion_tercero                                = $datos_producto_total['identificacion_tercero'];
	$nombre1_tercero                                       = $datos_producto_total['nombre1_tercero'];
	$apellido1_tercero                                     = $datos_producto_total['apellido1_tercero'];
	$telefono1_tercero                                     = $datos_producto_total['telefono1_tercero'];
	$correo_tercero                                        = $datos_producto_total['correo_tercero'];
?>
	<tr>
		<td style="text-align:left"><?php echo $nombre1_tercero.' '.$apellido1_tercero; ?> | <?php echo $cuenta; ?></td>
		<td style="text-align:right"><?php echo number_format($recarga_actual, 0, ",", "."); ?></td>
		<td style="text-align:right"><?php echo number_format($saldo_recarga, 0, ",", "."); ?></td>
		<td style="text-align:center"><?php echo $fecha_recarga_vendedor; ?></td>
		<td style="text-align:center"><?php echo $hora_recarga_vendedor; ?></td>
		<td style="text-align:center"><?php echo $cod_recarga_vendedor; ?></td>
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