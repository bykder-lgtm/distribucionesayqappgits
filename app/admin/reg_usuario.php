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
<a href="#"><h4>Registrar Usuarios&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_usuario.php">Lista de Usuarios</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF']; ?>

<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_usuario_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">CODUMENTO</th>
			<th style="text-align:center">NOMBRES</th>
			<th style="text-align:center">APELLIDOS</th>
			<th style="text-align:center">USUARIO</th>
			<th style="text-align:center">TIPO USUARIO</th>
			<th style="text-align:center">TIPO PROFESIONAL</th>
			<th style="text-align:center">REG</th>
		</tr></thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><input class="input-block-level" name="cedula" type="text" value="" placeholder="Escribe tu Cedula"/></td>
			<td style="text-align:center"><input class="input-block-level" name="nombres" type="text" value="" placeholder="Escribe tus Nombres" required/></td>
			<td style="text-align:center"><input class="input-block-level" name="apellidos" type="text" value="" placeholder="Escribe tus apellidos" required/></td>
			<td style="text-align:center"><input class="input-block-level" name="cuenta" type="text" value="" placeholder="Escribe tu nombre de usuario" required/></td>
			<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
			<td style="text-align:center"><select style="width:150px" name="cod_seguridad" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
			<?php if (isset($cod_seguridad)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
			$consulta2_sql = ("SELECT cod_seguridad, nombre_seguridad FROM tbl15_seguridad WHERE (cod_estado = '1') ORDER BY cod_seguridad ASC");
			$consulta2 = mysqli_query($conectar, $consulta2_sql);
			while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			if(isset($cod_seguridad) and $cod_seguridad == $datos2['cod_seguridad']) {
			$seleccionado = "selected"; } else { $seleccionado = ""; }
			$codigo = $datos2['cod_seguridad'];
			$nombre = $datos2['nombre_seguridad'];
			echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
			</td>
			<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->	
			<td style="text-align:center"><select style="width:150px" name="cod_tipo_historia_clinica" class="selectpicker" data-show-subtext="true" data-live-search="true">
			<?php if (isset($cod_tipo_historia_clinica)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
			$consulta2_sql = ("SELECT cod_tipo_historia_clinica, nombre_tipo_historia_clinica FROM tbl15_tipo_historia_clinica ORDER BY cod_tipo_historia_clinica ASC");
			$consulta2 = mysqli_query($conectar, $consulta2_sql);
			while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			if(isset($cod_tipo_historia_clinica) and $cod_tipo_historia_clinica == $datos2['cod_tipo_historia_clinica']) {
			$seleccionado = "selected"; } else { $seleccionado = ""; }
			$codigo = $datos2['cod_tipo_historia_clinica'];
			$nombre = $datos2['nombre_tipo_historia_clinica'];
			echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
			</td>
			<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
			<td style="text-align:center"><input type="text" name="reg_medico" value=""  class="input-block-level"/></td>
			<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">SEXO</th>
			<th style="text-align:center">CONTRASEÑA</th>
			<th style="text-align:center">CONTRASEÑA</th>
			<th style="text-align:center">CORREO</th>
			<th style="text-align:center">TELEFONO</th>
		</tr></thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><select style="width:150px" name="nombre_sexo" class="selectpicker" data-show-subtext="true" data-live-search="true">
			<?php if (isset($cod_sexo)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
			$consulta2_sql = ("SELECT cod_sexo, nombre_sexo FROM tbl15_sexo ORDER BY cod_sexo ASC");
			$consulta2 = mysqli_query($conectar, $consulta2_sql);
			while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			if(isset($cod_sexo) and $cod_sexo == $datos2['cod_sexo']) {
			$seleccionado = "selected"; } else { $seleccionado = ""; }
			$codigo = $datos2['cod_sexo'];
			$nombre = $datos2['nombre_sexo'];
			echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select>
			</td>
			<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
			<td style="text-align:center"><input class="input-block-level" name="contrasena1" type="password" value="" placeholder="Escribe tu contraseña" required autofocus/></td>
			<td style="text-align:center"><input class="input-block-level" name="contrasena2" type="password" value="" placeholder="Repita la contraseña" required autofocus/></td>
			<td style="text-align:center"><input class="input-block-level" name="correo" type="email" value="" placeholder="ejemplo@dominio.com"/></td>
			<td style="text-align:center"><input class="input-block-level" name="telefono" type="text" value="" placeholder="Escribe tu telefono"/></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<?php if ($cod_estado_tienda_global == '1') { ?><th style="text-align:center">TIENDA</th><?php } ?>
			<th style="text-align:center">BASE CAJA CIERE</th>
			<th style="text-align:center">NUM MAX <?php echo $nombre_concepto_multi_virtual ?>S</th>
			<th style="text-align:center">LIMITE DE VENTA MAX POR <?php echo $nombre_concepto_multi_virtual ?></th>
			<?php if ($cod_estado_saldo_recarga_global == '1') { ?><th style="text-align:center">SALDO RECARGA</th><?php } ?>
			<th style="text-align:center">PAGINA INICIO REDIRECT (../admin/pagina.php)</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<?php if ($cod_estado_tienda_global == '1') { ?>
			<th style="text-align:center">
				<select name="cod_tienda" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 200px;">
					<?php if (isset($cod_tienda)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' selected >Selecione</option>"; }
					$consulta2_sql = ("SELECT cod_tienda, nombre_tienda FROM tbl15_tienda WHERE (cod_estado = '1') ORDER BY cod_tienda ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_tienda) and $cod_tienda == $datos2['cod_tienda']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_tienda'];
					$nombre = $datos2['nombre_tienda'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</th>
			<?php } ?>
			<td style="text-align:center"><input type="number" name="total_base_cierre_caja" value="<?php echo ($total_base_cierre_caja) ?>" class="input-block-level" style="width: 100px;"/></td>
			<td style="text-align:center"><input type="number" name="num_max_caja_mesa_usuario" value="<?php echo $num_max_caja_mesa_usuario ?>" min="0" max="99" class="input-block-level" style="width: 70px;"/></td>
			<td style="text-align:center"><input type="number" name="limite_max_venta_temp_por_caja_mesa_usuario" value="<?php echo ($limite_max_venta_temp_por_caja_mesa_usuario) ?>" class="input-block-level" style="width: 100px;" min="0"/></td>
			<?php if ($cod_estado_saldo_recarga_global == '1') { ?><td style="text-align:center"><input type="number" name="total_saldo_recarga" value="<?php echo $total_saldo_recarga ?>" min="0" class="input-block-level" style="width: 100px;"/></td><?php } ?>
			<td style="text-align:center"><input type="text" name="url_pag_redirec_ini_sesion" value="<?php echo ($url_pag_redirec_ini_sesion) ?>" class="input-block-level"/></td>
    	</tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input id="estilo_css" name="estilo_css" type="hidden" value="azul_verdoso.css">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
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