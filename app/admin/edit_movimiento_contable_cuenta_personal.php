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
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="../admin/lista_parametrizacion_movimiento_contable_cuenta_personal.php"><h4></h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<?php
$cod_movimiento_contable_cuenta_personal          = intval($_GET['cod_movimiento_contable_cuenta_personal']);
$pagina                                           = addslashes($_GET['pagina']);
?>
<table align="center" border="0" cellpadding="0" cellspacing="0" style="font-family:mono; width:100%">
    <tbody><tr>
        <td bgcolor="#fff" align="center"><strong><a href="../admin/lista_parametrizacion_movimiento_contable_cuenta_personal.php">Editar Información</a></strong></td>
    </tr></tbody>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$mostrar_datos_sql = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal WHERE cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

	$total_compra_producto               = $matriz_consulta['total_compra_producto'];
	$total_venta_producto                = $matriz_consulta['total_venta_producto'];
	$total_saldo                         = $matriz_consulta['total_saldo'];
	$fecha_ymd_movimiento_caja           = $matriz_consulta['fecha_ymd_movimiento_caja'];
	$fecha_mes_movimiento_caja           = $matriz_consulta['fecha_mes_movimiento_caja'];
	$fecha_anyo_movimiento_caja          = $matriz_consulta['fecha_anyo_movimiento_caja'];
	$fecha_hora_movimiento_caja          = $matriz_consulta['fecha_hora_movimiento_caja'];
	$fecha_seg_movimiento_caja           = $matriz_consulta['fecha_seg_movimiento_caja'];
	$fecha_creacion                      = $matriz_consulta['fecha_creacion'];
	$fecha_modificacion                  = $matriz_consulta['fecha_modificacion'];
	$cuenta                              = $matriz_consulta['cuenta'];
    $cod_puc                             = $matriz_consulta['cod_puc'];
    $codigo_puc                          = $matriz_consulta['codigo_puc'];
    $nombre_puc                          = $matriz_consulta['nombre_puc'];
    $tipo_puc                            = $matriz_consulta['tipo_puc'];
    $saldo_inicial_puc                   = $matriz_consulta['saldo_inicial_puc'];
    $subtotal_puc                        = $matriz_consulta['subtotal_puc'];
    $saldo_actual_puc                    = $matriz_consulta['saldo_actual_puc'];
    $nombre_modulo_puc                   = $matriz_consulta['nombre_modulo_puc'];
    $cod_estado                          = $matriz_consulta['cod_estado'];
    $cod_tipo_forma_pago                 = $matriz_consulta['cod_tipo_forma_pago'];
?>
<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_movimiento_contable_cuenta_personal_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">Id Puc</th>
			<th style="text-align:center">Codigo Cuenta Puc</th>
			<th style="text-align:center">Nombre Cuenta Puc</th>
			<th style="text-align:center">Total Saldo</th>
			<th style="text-align:center">Tipo Forma Pago</th>
			<th style="text-align:center">Fecha</th>
			<th style="text-align:center">Estado</th>
			<th style="text-align:center">Id</th>
		</tr></thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><?php echo ($cod_puc) ?></td>
			<td style="text-align:center"><?php echo ($codigo_puc) ?></td>
			<td style="text-align:center"><?php echo ($nombre_puc) ?></td>
			<td style="text-align:center"><input type="number" name="total_saldo" value="<?php echo ($total_saldo) ?>" step="any" class="input-block-level" required/></td>

			<td style="text-align:center">
				<select name="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
					<?php if (isset($cod_tipo_forma_pago)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
					$consulta2_sql = ("SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_tipo_forma_pago) and $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_tipo_forma_pago'];
					$nombre = $datos2['nombre_tipo_forma_pago'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>

			<td style="text-align:center"><input type="date" name="fecha_ymd_movimiento_caja" value="<?php echo ($fecha_ymd_movimiento_caja) ?>"  class="input-block-level" required/></td>
			<td style="text-align:center">
				<select name="cod_estado" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
					<?php if (isset($cod_estado)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_tipo_estado, nombre_tipo_estado FROM tbl15_tipo_estado ORDER BY cod_tipo_estado ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_estado) and $cod_estado == $datos2['cod_tipo_estado']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_tipo_estado'];
					$nombre = $datos2['nombre_tipo_estado'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center"><?php echo ($cod_movimiento_contable_cuenta_personal) ?></td>

    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_movimiento_contable_cuenta_personal" value="<?php echo $cod_movimiento_contable_cuenta_personal ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions">
<input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
</form>
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