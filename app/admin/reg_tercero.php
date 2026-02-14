<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="js/jquery-1.12.3.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
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
<a href="#"><h4>Registrar Terceros&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_tercero.php">Lista de Terceros</h4></a>
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
$pagina_local = $_SERVER['PHP_SELF'];
$cod_puntos_redimibles_campanya = 0;
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_tercero_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tbody>
		<tr>
			<th style="text-align:center">TIPO TERCERO</th>
			<th style="text-align:center">TIPO IDENTIFICACION</th>
			<th style="text-align:center">DOCUMENTO</th>
			<th style="text-align:center">DIGITO</th>
		</tr>
    	<tr>
			<td>
				<select id="select_nombre_tipo_tercero" name="nombre_tipo_tercero" class="input-block-level"  style="font-size:15px">
				<?php $sql_consulta = "SELECT * FROM tbl15_tipo_tercero WHERE (cod_estado = '1')";
				$resultado = mysqli_query($conectar, $sql_consulta);
				while ($contenedor = mysqli_fetch_assoc($resultado)) { 
				$cod_tipo_tercero = $contenedor['cod_tipo_tercero'];
				$nombre_tipo_tercero = $contenedor['nombre_tipo_tercero'];
				?>
				<option value="<?php echo $nombre_tipo_tercero ?>"><?php echo $nombre_tipo_tercero ?></option>
				<?php } ?>
				</select>
			</td>
			<td>
				<select id="select_nombre_tipo_identificacion" name="nombre_tipo_identificacion" class="input-block-level"  style="font-size:15px">
				<?php $sql_consulta = "SELECT * FROM tbl15_tipo_identificacion";
				$resultado = mysqli_query($conectar, $sql_consulta);
				while ($contenedor = mysqli_fetch_assoc($resultado)) { 
				$cod_tipo_identificacion = $contenedor['cod_tipo_identificacion'];
				$nombre_tipo_identificacion = $contenedor['nombre_tipo_identificacion'];
				?>
				<option value="<?php echo $nombre_tipo_identificacion ?>"><?php echo $nombre_tipo_identificacion ?></option>
				<?php } ?>
				</select>
			</td>
			<td><input class="input-block-level" name="identificacion_tercero" type="number" value=""/></td>
			<td><input class="input-block-level" name="digito_tercero" type="number" value=""/></td>
    	<tr>
    	</tr>
		<tr>
			<th style="text-align:center">NOMBRE 1</th>
			<th style="text-align:center">NOMBRE 2</th>
			<th style="text-align:center">APELLIDO 1</th>
			<th style="text-align:center">APELLIDO 2</th>
		</tr>
    	<tr>
			<td><input class="input-block-level" name="nombre1_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="nombre2_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="apellido1_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="apellido2_tercero" type="text" value=""/></td>
    	</tr>
		<tr>
			<th style="text-align:center">DIRECCION</th>
			<th style="text-align:center">TELEFONO 1</th>
			<th style="text-align:center">TELEFONO 2</th>
			<th style="text-align:center">CORREO</th>
		</tr>
    	<tr>
			<td><input class="input-block-level" name="direccion_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="telefono1_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="telefono2_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="correo_tercero" type="text" value=""/></td>
    	</tr>
		<tr>
			<th style="text-align:center">PAIS</th>
			<th style="text-align:center">DEPARTAMENTO</th>
			<th style="text-align:center">CIUDAD</th>
			<th style="text-align:center">TIPO CLIENTE</th>
		</tr>
    	<tr>
			<td>
				<select id="cod_pais" name="cod_pais" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_pais_defec_global)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_pais WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_pais_defec_global) and $nombre_pais_defec_global == $datos2['nombre_pais']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_pais'];
			        $nombre           = $datos2['nombre_pais'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>

			<td>
            	<select name="cod_departamento" id="cod_departamento" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
			        <?php if (isset($nombre_departamento_defec_global)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_departamento WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_departamento_defec_global) and $nombre_departamento_defec_global == $datos2['cod_departamento']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_departamento'];
			        $nombre           = $datos2['nombre_departamento'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>

			<td id="cod_municipio_select">
            	<select name="cod_municipio" id="cod_municipio" class="chosen" data-show-subtext="true" data-live-search="true" required>
			        <?php if (isset($nombre_ciudad_defec_global)) { echo "<option value='0' selected >Selecione</option>"; } else { echo "<option value='0' selected >Selecione</option>"; }
			        $consulta2_sql = "SELECT * FROM tbl15_municipio WHERE (cod_departamento = '$nombre_departamento_defec_global') AND (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_ciudad_defec_global) and $nombre_ciudad_defec_global == $datos2['cod_municipio']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_municipio'];
			        $nombre           = $datos2['nombre_municipio'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>

			<td>
				<select id="select_nombre_tipo_cliente" name="nombre_tipo_cliente" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_tipo_cliente_defec_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_cliente WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_cliente_defec_global) and $nombre_tipo_cliente_defec_global == $datos2['nombre_tipo_cliente']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_cliente'];
			        $nombre           = $datos2['nombre_tipo_cliente'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>
    	</tr>
		<tr>
			<th style="text-align:center">TIPO REGIMEN</th>
			<th style="text-align:center">TIPO IMPUESTO</th>
			<th style="text-align:center">CONTACTO</th>
			<th style="text-align:center">FAX</th>
		</tr>
    	<tr>
			<td>
				<select id="select_nombre_tipo_regimen" name="nombre_tipo_regimen" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_tipo_regimen_defec_global)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_regimen WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_regimen_defec_global) and $nombre_tipo_regimen_defec_global == $datos2['nombre_tipo_regimen']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_regimen'];
			        $nombre           = $datos2['nombre_tipo_regimen'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>
			<td>
				<select id="select_nombre_tipo_impuesto" name="nombre_tipo_impuesto" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_tipo_impuesto_defec_global)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_impuesto WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_impuesto_defec_global) and $nombre_tipo_impuesto_defec_global == $datos2['nombre_tipo_impuesto']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_impuesto'];
			        $nombre           = $datos2['nombre_tipo_impuesto'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>
			<td><input class="input-block-level" name="contacto_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="fax_tercero" type="text" value=""/></td>
    	</tr>

		<tr>
			<th style="text-align:center">FECHA NACIMIENTO</th>
			<th style="text-align:center">USUARIO</th>
			<th style="text-align:center">DTO 1 CON IVA</th>
			<th style="text-align:center">DTO 2 CON IVA</th>
		</tr>
    	<tr>
			<td><input class="input-block-level" name="fecha_nac_tercero" type="date" value=""/></td>
			<td>
				<select id="cod_administrador" name="cod_administrador" class="input-block-level"  style="font-size:15px">
				<?php $sql_consulta = "SELECT * FROM tbl15_administrador";
				$resultado = mysqli_query($conectar, $sql_consulta);
				while ($contenedor = mysqli_fetch_assoc($resultado)) { 
				$codigo = $contenedor['cod_administrador'];
				$nombre = $contenedor['nombres'].' '.$contenedor['apellidos'].' | '.$datos2['cuenta'];
				?>
				<option value="<?php echo $codigo ?>"><?php echo $nombre ?></option>
				<?php } ?>
				</select>
			</td>
			<td><input class="input-block-level" name="dto1_con_iva_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="dto2_con_iva_tercero" type="text" value=""/></td>
    	</tr>
		<tr>
			<th style="text-align:center">DTO 1 SIN IVA</th>
			<th style="text-align:center">DTO 2 SIN IVA</th>
			<th style="text-align:center">DTO 1 EXCENTO IVA</th>
			<th style="text-align:center">DTO 2 EXCENTO IVA</th>
		</tr>
    	<tr>
			<td><input class="input-block-level" name="dto1_sin_iva_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="dto2_sin_iva_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="dto1_excento_iva_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="dto2_excento_iva_tercero" type="text" value=""/></td>
    	</tr>
    </tbody>
</table>


<table border="1" class="table table-responsive">
	<tr>
		<?php if ($cod_estado_retefuente_global == '1') { ?><th style="text-align:center">APLICAR RETEFUENTE</th><?php } ?>
		<?php if ($cod_estado_reteica_global == '1') { ?><th style="text-align:center">APLICAR RETEICA</th><?php } ?>
		<?php if ($cod_estado_reteiva_global == '1') { ?><th style="text-align:center">APLICAR RETEIVA</th><?php } ?>
	</tr>
	<tr>
		<?php if ($cod_estado_retefuente_global == '1') { ?>
		<td style="text-align:center">
            <select name="retefuente_ptj" id="retefuente_ptj" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" tabindex="1">
                <?php if (isset($retefuente_ptj)) { echo "<option value='0'>0%</option>"; } else { echo "<option value='0'>0%</option>"; }
                $consulta2_sql = "SELECT cod_tipo_retefuente, retefuente_ptj FROM tbl15_tipo_retefuente WHERE (cod_estado = '1') ORDER BY retefuente_ptj ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($retefuente_ptj) AND $retefuente_ptj == $datos2['retefuente_ptj']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['retefuente_ptj'];
                $nombre = $datos2['retefuente_ptj'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."%</option>"; } ?>
            </select>
		</td>
		<?php } ?>
		<?php if ($cod_estado_reteica_global == '1') { ?>
		<td style="text-align:center">
            <select name="reteica_ptj" id="reteica_ptj" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" tabindex="1">
                <?php if (isset($reteica_ptj)) { echo "<option value='0'>0%</option>"; } else { echo "<option value='0'>0%</option>"; }
                $consulta2_sql = "SELECT cod_tipo_retefuente, retefuente_ptj FROM tbl15_tipo_retefuente WHERE (cod_estado = '1') ORDER BY retefuente_ptj ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($reteica_ptj) AND $reteica_ptj == $datos2['retefuente_ptj']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['retefuente_ptj'];
                $nombre = $datos2['retefuente_ptj'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."%</option>"; } ?>
            </select>
		</td>
		<?php } ?>
		<?php if ($cod_estado_reteiva_global == '1') { ?>
		<td style="text-align:center">
            <select name="reteiva_ptj" id="reteiva_ptj" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" tabindex="1">
                <?php if (isset($reteiva_ptj)) { echo "<option value='0'>0%</option>"; } else { echo "<option value='0'>0%</option>"; }
                $consulta2_sql = "SELECT cod_tipo_retefuente, retefuente_ptj FROM tbl15_tipo_retefuente WHERE (cod_estado = '1') ORDER BY retefuente_ptj ASC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($reteiva_ptj) AND $reteiva_ptj == $datos2['retefuente_ptj']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['retefuente_ptj'];
                $nombre = $datos2['retefuente_ptj'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."%</option>"; } ?>
            </select>
		</td>
		<?php } ?>
	</tr>
</table>


<?php
if ($cod_estado_puntos_redimibles_campanya_global == '1') { ?>
	<table border="1" class="table table-responsive">
		<tr>
			<th style="text-align:center">CAMPAÑA PUNTOS REDIMIBLES</th>
		</tr>
		<tr>
			<td style="text-align:center">
	            <select name="cantidad_puntos_x_valor_redimibles_campanya" id="cantidad_puntos_x_valor_redimibles_campanya" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 400px;" tabindex="1">
	                <?php if (isset($cod_puntos_redimibles_campanya)) { echo "<option value='0' selected ></option>"; } else { echo "<option value='0' selected ></option>"; }
	                $consulta2_sql = "SELECT cod_puntos_redimibles_campanya, nombre_puntos_redimibles_campanya, cantidad_puntos_x_valor_redimibles_campanya FROM tbl15_puntos_redimibles_campanya WHERE (cod_estado <> '1') ORDER BY cod_puntos_redimibles_campanya ASC";
	                $consulta2 = mysqli_query($conectar, $consulta2_sql);
	                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	                if(isset($cod_puntos_redimibles_campanya) AND $cod_puntos_redimibles_campanya == $datos2['cod_puntos_redimibles_campanya']) {
	                $seleccionado = "selected"; } else { $seleccionado = ""; }
	                $codigo = $datos2['cantidad_puntos_x_valor_redimibles_campanya'];
	                $nombre = $datos2['nombre_puntos_redimibles_campanya'].' (CANTIDAD PUNTOS: '.$codigo.')';
	                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
	            </select>
			</td>
		</tr>
	</table>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="js/jquery-ui.js"></script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_departamento").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_departamento";
        var tipo_ajax = "tbl15_tercero";
        var id = "0";
        var pagina_local = "<?php echo $pagina_local; ?>";

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id;

        $.ajax({
            type: "POST",
            url: "../admin/recargar_consulta_municipio_select_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
            	$("#cod_municipio_select").html(respuesta);
            }
        });

   });
});
</script>

<script type="text/javascript">
$('#nombre_ciudad').on('keypress',function(){
	var nombre_campo = $(this).attr("name");
	var nombre_sexo = 'HEMBRA';
	var nombre_tipo_producto = 'ANIMAL';
	//var cod_departamento = $("#cod_departamento option:selected").text();
	var cod_departamento = document.getElementById('cod_departamento').value;

	$(function() {
		$("#"+nombre_campo).autocomplete({
		source: "autocompletar_cod_nombre_municipio.php?nombre_campo="+nombre_campo+"&cod_departamento="+cod_departamento+"&nombre_tipo_producto="+nombre_tipo_producto+"",
		minLength: 1,
			select: function(event, ui) {
				event.preventDefault();
				var cod_municipio = ui.item.cod_municipio;
				var nombre_municipio = ui.item.nombre_municipio;

				$('#cod_municipio').val(cod_municipio);
				$('#'+nombre_campo).val(nombre_municipio);

			}
		});
	});

});
</script>

</body>
</html>