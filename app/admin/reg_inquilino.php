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
<a href="#"><h4>Registrar Arrendatario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_inquilino.php">Lista de Arrendatario</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                    = $_SERVER['PHP_SELF'];
$nombre_tipo_tercero       = 'INQUILINO';
$nombre_departamento       = 'CORDOBA';
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_inquilino_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tbody>
		<tr>
			<th style="text-align:center">TIPO</th>
			<th style="text-align:center">TIPO IDENTIFICACION</th>
			<th style="text-align:center">DOCUMENTO</th>
			<th style="text-align:center">DIGITO</th>
		</tr>
    	<tr>
			<td>
				<select id="select_nombre_tipo_tercero" name="nombre_tipo_tercero" class="input-block-level"  style="font-size:15px">
				<?php $sql_consulta = "SELECT * FROM tbl15_tipo_tercero WHERE ((nombre_tipo_tercero = '$nombre_tipo_tercero') OR (nombre_tipo_tercero = 'AMBOS')) AND (cod_estado = '1') ORDER BY cod_tipo_tercero DESC";
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
    	</tr>
		<tr>
			<th style="text-align:center">NOMBRES Y APELLIDOS</th>
			<th style="text-align:center">DIRECCION</th>
			<th style="text-align:center">TELEFONO</th>
			<th style="text-align:center">CORREO</th>
		</tr>
    	<tr>
			<td><input class="input-block-level" name="nombre1_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="direccion_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="telefono1_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="correo_tercero" type="text" value=""/></td>
    	</tr>
		<tr>
			<th style="text-align:center">PAIS</th>
			<th style="text-align:center">DEPARTAMENTO</th>
			<th style="text-align:center">CIUDAD</th>
			<th style="text-align:center">TIPO PERSONA</th>
		</tr>
    	<tr>
			<td>
				<select id="select_nombre_pais" name="nombre_pais" id="nombre_pais" class="input-block-level"  style="font-size:15px">
				<?php $sql_consulta = "SELECT * FROM tbl15_pais";
				$resultado = mysqli_query($conectar, $sql_consulta);
				while ($contenedor = mysqli_fetch_assoc($resultado)) { 
				$cod_pais = $contenedor['cod_pais'];
				$nombre_pais = $contenedor['nombre_pais'];
				?>
				<option value="<?php echo $nombre_pais ?>"><?php echo $nombre_pais ?></option>
				<?php } ?>
				</select>
			</td>

			<td>
				<select name="nombre_departamento" id="nombre_departamento" class="input-block-level"  style="font-size:15px">
                    <?php if (isset($nombre_departamento)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT * FROM tbl15_departamento ORDER BY nombre_departamento ASC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_departamento) and $nombre_departamento == $datos2['nombre_departamento']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_departamento'];
                    $nombre = $datos2['nombre_departamento'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
			</td>

			<td><input class="input-block-level" name="nombre_ciudad" id="nombre_ciudad" type="text" value=""/></td>
			<td>
				<select id="select_nombre_tipo_cliente" name="nombre_tipo_cliente" class="input-block-level"  style="font-size:15px">
				<?php $sql_consulta = "SELECT * FROM tbl15_tipo_cliente";
				$resultado = mysqli_query($conectar, $sql_consulta);
				while ($contenedor = mysqli_fetch_assoc($resultado)) { 
				$cod_tipo_cliente = $contenedor['cod_tipo_cliente'];
				$nombre_tipo_cliente = $contenedor['nombre_tipo_cliente'];
				?>
				<option value="<?php echo $nombre_tipo_cliente ?>"><?php echo $nombre_tipo_cliente ?></option>
				<?php } ?>
				</select>
			</td>
    	</tr>
		<tr>
			<th style="text-align:center">TIPO REGIMEN</th>
			<th style="text-align:center">TIPO IMPUESTO</th>
			<th style="text-align:center">USUARIO</th>
			<th style="text-align:center"></th>
			<!--
			<th style="text-align:center">FECHA NACIMIENTO</th>
			<th style="text-align:center">CONTACTO</th>
			<th style="text-align:center">FAX</th>
			-->
		</tr>
    	<tr>
			<td>
				<select id="select_nombre_tipo_regimen" name="nombre_tipo_regimen" class="input-block-level"  style="font-size:15px">
				<?php $sql_consulta = "SELECT * FROM tbl15_tipo_regimen WHERE (cod_estado = '1')";
				$resultado = mysqli_query($conectar, $sql_consulta);
				while ($contenedor = mysqli_fetch_assoc($resultado)) { 
				$cod_tipo_regimen = $contenedor['cod_tipo_regimen'];
				$nombre_tipo_regimen = $contenedor['nombre_tipo_regimen'];
				?>
				<option value="<?php echo $nombre_tipo_regimen ?>"><?php echo $nombre_tipo_regimen ?></option>
				<?php } ?>
				</select>
			</td>
			<td>
				<select id="select_nombre_tipo_impuesto" name="nombre_tipo_impuesto" class="input-block-level"  style="font-size:15px">
				<?php $sql_consulta = "SELECT * FROM tbl15_tipo_impuesto  ORDER BY cod_tipo_impuesto DESC";
				$resultado = mysqli_query($conectar, $sql_consulta);
				while ($contenedor = mysqli_fetch_assoc($resultado)) { 
				$cod_tipo_impuesto = $contenedor['cod_tipo_impuesto'];
				$nombre_tipo_impuesto = $contenedor['nombre_tipo_impuesto'];
				?>
				<option value="<?php echo $nombre_tipo_impuesto ?>"><?php echo $nombre_tipo_impuesto ?></option>
				<?php } ?>
				</select>
			</td>
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
			<td></td>
			<!--
			<td><input class="input-block-level" name="fecha_nac_tercero" type="date" value=""/></td>
			<td><input class="input-block-level" name="contacto_tercero" type="text" value=""/></td>
			<td><input class="input-block-level" name="fax_tercero" type="text" value=""/></td>
			-->
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

<script type="text/javascript">
$('#nombre_ciudad').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'HEMBRA';
var nombre_tipo_producto = 'ANIMAL';
var nombre_departamento = $("#nombre_departamento option:selected").text();

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_nombre_municipio.php?nombre_campo="+nombre_campo+"&nombre_departamento="+nombre_departamento+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.nombre_municipio);
}
});
});

});
</script>

</body>
</html>