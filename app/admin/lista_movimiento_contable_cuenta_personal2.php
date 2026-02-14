
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
<a href="#"><h4>Lista de Cuentas Personales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_movimiento_contable_cuenta_personal.php">Registrar Cuentas Personales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
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
		<th style="text-align:center">Valor</th>
		<th style="text-align:center">Banco</th>
		<th style="text-align:center">Estado</th>
		<th style="text-align:center">Edit</th>
	</tr>
</thead>
<tbody>
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	$cod_movimiento_contable_cuenta_personal                   = $matriz_consulta['cod_movimiento_contable_cuenta_personal'];
	$nombre_movimiento_contable_cuenta_personal                = $matriz_consulta['nombre_movimiento_contable_cuenta_personal'];
	$valor_movimiento_contable_cuenta_personal                 = $matriz_consulta['valor_movimiento_contable_cuenta_personal'];
	$fecha_movimiento_contable_cuenta_personal                 = $matriz_consulta['fecha_movimiento_contable_cuenta_personal'];
	$cupo_disponible_movimiento_contable_cuenta_personal       = $matriz_consulta['cupo_disponible_movimiento_contable_cuenta_personal'];
	$disponible_avances_movimiento_contable_cuenta_personal    = $matriz_consulta['disponible_avances_movimiento_contable_cuenta_personal'];
	$ptj_tasa_interes                                          = $matriz_consulta['ptj_tasa_interes'];
	$nombre_tipo_puc                                           = $matriz_consulta['nombre_tipo_puc'];
	$fecha_hora_modificacion                                   = $matriz_consulta['fecha_hora_modificacion'];
	$cuenta                                                    = $matriz_consulta['cuenta'];
	$cod_administrador                                         = $matriz_consulta['cod_administrador'];
	$cod_banco                                                 = $matriz_consulta['cod_banco'];
	$cod_estado                                                = $matriz_consulta['cod_estado'];


	$sql_banco = "SELECT * FROM tbl15_banco WHERE cod_banco = '$cod_banco'";
	$resultado_banco = mysqli_query($conectar, $sql_banco) or die(mysqli_error($conectar));
	$info_banco = mysqli_fetch_assoc($resultado_banco);

	$nombre_banco                                              = $info_banco['nombre_banco'];

	$sql_estado = "SELECT * FROM tbl15_estado WHERE cod_estado = '$cod_estado'";
	$resultado_estado = mysqli_query($conectar, $sql_estado) or die(mysqli_error($conectar));
	$info_estado = mysqli_fetch_assoc($resultado_estado);

	$nombre_estado                                             = $info_estado['nombre_estado'];
?>
	<tr>
		<td style="text-align:center"><?php echo $cod_movimiento_contable_cuenta_personal; ?></td>
		<td style="text-align:left"><?php echo $nombre_movimiento_contable_cuenta_personal; ?></td>
		<td style="text-align:right"><?php echo number_format($valor_movimiento_contable_cuenta_personal); ?></td>
		<td style="text-align:center"><?php echo $nombre_banco; ?></td>
		<td style="text-align:center"><?php echo $nombre_estado; ?></td>
		<td style="text-align:center"><a href="../admin/edit_movimiento_contable_cuenta_personal.php?cod_movimiento_contable_cuenta_personal=<?php echo $cod_movimiento_contable_cuenta_personal?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
	</tr>
<?php
}
?>
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