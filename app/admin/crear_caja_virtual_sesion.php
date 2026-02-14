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
<a href="../admin/lista_caja_virtual.php"><h4><?php echo $nombre_concepto_multi_virtual; ?>S Virtuales</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cuenta                             = ($cuenta_actual);
$smtr                               = 0;
$contador_mesas_array               = 1;
$nombre_tipo_producto               = "PRODUCTO";

if ($cod_estado_campos_sector_salud_global == '1') { $cod_tercero = 0; } else { $cod_tercero = 1; }

if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'facturacion_venta_temporal_producto_manual_pos.php'; } 
$nombre_estado_factura              = 'ABIERTA';

$mesas_caja_en_uso                = array();

$sql_mesas_caja_en_uso = "SELECT cod_base_caja FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') ORDER BY cod_base_caja";
$consulta_mesas_caja_en_uso = mysqli_query($conectar, $sql_mesas_caja_en_uso);
while ($datos_mesas_caja_en_uso = mysqli_fetch_assoc($consulta_mesas_caja_en_uso)) {

	$cod_base_caja_en_uso             = $datos_mesas_caja_en_uso['cod_base_caja'];

	$mesas_caja_en_uso[$contador_mesas_array] = $cod_base_caja_en_uso;
	$contador_mesas_array ++;
}

if (isset($_GET['pagina'])) { 
	$sql_animal = "SELECT MAX(cod_caja_virtual) AS cod_caja_virtual, MAX(cod_base_caja) AS cod_base_caja FROM tbl15_venta_producto_temporal";
	$resultado_animal = mysqli_query($conectar, $sql_animal);
	$info_animal = mysqli_fetch_assoc($resultado_animal);

	$cod_caja_virtual                   = $info_animal['cod_caja_virtual'] + 1;
	$cod_base_caja                      = $info_animal['cod_base_caja'] + 1;

	$sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura')";
	$consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
	$datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

	$cod_prioridad                      = $datos_max_prioridad['cod_prioridad'] + 1;

	$datos_factura_venta_abierta = "SELECT * FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (cuenta = '$cuenta')";
	$consulta_factura_venta_abierta = mysqli_query($conectar, $datos_factura_venta_abierta) or die(mysqli_error($conectar));
	$total_factura_venta_abierta = mysqli_num_rows($consulta_factura_venta_abierta);

	$num_max_caja_mesa_usuario_reem = $num_max_caja_mesa_usuario;

	if ($num_max_caja_mesa_usuario_reem == '0') { $num_max_caja_mesa_usuario = '99'; } else { $num_max_caja_mesa_usuario = $num_max_caja_mesa_usuario_reem; }
	if ($total_factura_venta_abierta >= $num_max_caja_mesa_usuario) { $estado_num_max_caja_mesa_usuario = 1; } else { 	$estado_num_max_caja_mesa_usuario = 0; }

	if ($cod_estado_cantidad_caja_mesa_global == 1) { ?>
	<table class="table table-striped">
	<tr>
	<?php for ($i=1; $i < $cantidad_caja_mesa+1; $i++) { 
			if ($smtr % 4 == 0) { echo "<tr></tr>"; }
			$smtr++;
			$indice_mesas_caja_en_uso = array_search($i, $mesas_caja_en_uso, false);
			if (($indice_mesas_caja_en_uso == '') && ($estado_num_max_caja_mesa_usuario == '0')) { ?>
			<th style="text-align:center"><a href="../admin/crear_caja_mesa_virtual_sesion_reg.php?cod_caja_virtual=<?php echo $cod_caja_virtual?>&cod_base_caja=<?php echo $i ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/mesa_caja_disponible.png"><br><?php echo $nombre_concepto_multi_virtual.' '.$i; ?></a></th>
			<?php
			} else { ?>
			<th style="text-align:center"><img src="../imagenes/mesa_caja_disponible_no.png"><br><?php echo $nombre_concepto_multi_virtual.' '.$i; ?></th>
			<?php } ?>
	<?php } ?>
	</tr>
	</table>
	<?php } else { ?>
	<div class="table-responsive">
	<form method="post" name="formulario_de_actualizacion" action="../admin/crear_caja_mesa_virtual_sesion_reg.php">
		<table class="table table-striped">
			<tr>
				<th style="text-align:center;">NUMERO <?php echo $nombre_concepto_multi_virtual; ?></th>
				<th style="text-align:center;">TIPO</th>
				<th style="text-align:center;">TERCERO</th>
			</tr>
			<tr>
				<td style="text-align:center;"><input type="number" name="cod_base_caja" value="<?php echo $cod_base_caja; ?>" style="width: 50px;" required></td>
	            <td style="text-align:center">
	                <select name="nombre_tipo_producto" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" required>
	                    <?php if (isset($nombre_tipo_producto)) { echo ""; } else { echo ""; }
	                    $consulta2_sql = ("SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto WHERE (cod_estado = '1') ORDER BY nombre_tipo_producto DESC");
	                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
	                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	                    if(isset($nombre_tipo_producto) and $nombre_tipo_producto == $datos2['nombre_tipo_producto']) {
	                    $seleccionado = "selected"; } else { $seleccionado = ""; }
	                    $codigo = $datos2['nombre_tipo_producto'];
	                    $nombre = $datos2['nombre_tipo_producto'];
	                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
	                </select>
	            </td>
		        <td style="text-align:left; width:300px">
		            <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" tabindex="1">
		                <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>"; } else { echo "<option value='' selected ></option>"; }
		                $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
		                FROM tbl15_tercero WHERE (nombre_tipo_tercero='CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
		                $consulta2 = mysqli_query($conectar, $consulta2_sql);
		                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		                if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
		                $seleccionado = "selected"; } else { $seleccionado = ""; }
		                $codigo = $datos2['cod_tercero'];
		                $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
		                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		            </select>
		            <!--<p><a href="#" id="modal_abrir" tabindex="1"><img src="../imagenes/boton_mas_blanco.png"></a></p>-->
		            <?php if ($cod_estado_opcion_escribir_nombre_cliente_venta_global == '1') { ?>
		            <p><input name="nombre1_tercero" id="nombre1_tercero" type="text" value="<?php echo $nombre1_tercero_ext ?>" style="width: 220px;" tabindex="1" /></p>
		            <?php } ?>
		        </td>
			</tr>
		</table>
		<table class="table table-striped">
			<tr>
				<td style="text-align:center;"><input type="submit" value="CREAR <?php echo $nombre_concepto_multi_virtual; ?>" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
			</tr>
		</table>
		<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
		<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
		<input type="hidden" name="cod_caja_virtual" value="<?php echo $cod_caja_virtual; ?>" size="2" required>
	</form>
	</div>
	<?php } ?>

<?php } ?>
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