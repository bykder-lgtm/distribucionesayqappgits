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
<?php
$pagina = $_SERVER['PHP_SELF'];
//-----------------------------------------------------------------------------------------------------------------//
if (isset($_GET['nombre_tipo_tercero'])) { $nombre_tipo_tercero = addslashes($_GET['nombre_tipo_tercero']); } else { $nombre_tipo_tercero = 'ENTIDAD_CREDITICIA'; }
$nombre_tipo_tercero_titulo = str_replace('_', ' ', $nombre_tipo_tercero);
$nombre_tipo_tercero_titulo = ucwords($nombre_tipo_tercero_titulo);
$nombre_tipo_tercero_titulo = ucwords(strtolower($nombre_tipo_tercero_titulo));
//-----------------------------------------------------------------------------------------------------------------//
?>
<div class="breadcrumbs">
<a href="#"><h4>Registrar <?php echo $nombre_tipo_tercero_titulo?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_siscredito_entidad_crediticia.php?nombre_tipo_tercero=<?php echo $nombre_tipo_tercero?>">Lista de <?php echo $nombre_tipo_tercero_titulo?></h4></a>
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
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_siscredito_entidad_crediticia_reg.php?nombre_tipo_tercero=<?php echo $nombre_tipo_tercero ?>">
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
			        <?php if (isset($nombre_tipo_tercero)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_tercero WHERE (nombre_tipo_tercero = '$nombre_tipo_tercero') OR (nombre_tipo_tercero = 'TODO') AND (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_tercero) and $nombre_tipo_tercero == $datos2['nombre_tipo_tercero']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_tercero'];
			        $nombre           = $datos2['nombre_tipo_tercero'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
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
			<th style="text-align:center">FECHA NACIMIENTO</th>
			<th style="text-align:center">USUARIO</th>
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
    	</tr>
    </tbody>
</table>


<table border="1" class="table table-responsive">
	<tbody>
		<tr>
			<th style="text-align:center">TASA INTERES LIDERES</th>
			<th style="text-align:center">TASA INTERES COORDINADORES</th>
			<th style="text-align:center">TASA INTERES ASESORES</th>
			<th style="text-align:center">TASA INTERES VENDEDORES</th>
			<th style="text-align:center">TASA INTERES PROVEEDORES</th>
			<th style="text-align:center">TASA INTERES ALIADOS ESTRATEGICOS</th>
			<th style="text-align:center">TASA INTERES ENTIDAD CREDITICIA</th>
		</tr>
		<tr>
			<td style="text-align:center"><input class="input-block-level" name="lider_interes_ptj" type="text" value=""/></td>
			<td style="text-align:center"><input class="input-block-level" name="coordinador_interes_ptj" type="text" value=""/></td>
			<td style="text-align:center"><input class="input-block-level" name="asesor_interes_ptj" type="text" value=""/></td>
			<td style="text-align:center"><input class="input-block-level" name="vendedor_interes_ptj" type="text" value=""/></td>
			<td style="text-align:center"><input class="input-block-level" name="proveedor_interes_ptj" type="text" value=""/></td>
			<td style="text-align:center"><input class="input-block-level" name="aliado_estrategico_interes_ptj" type="text" value=""/></td>
			<td style="text-align:center"><input class="input-block-level" name="entidad_crediticia_interes_ptj" type="text" value=""/></td>
		</tr>
    </tbody>
</table>
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