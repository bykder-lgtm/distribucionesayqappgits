<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="js/json2.min.js"></script>

<link rel="stylesheet" href="../estilo_css/chosen.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

<script>
    $(document).ready(function(){
        $("#cod_tercero").chosen();
   });
</script>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Editar Inquilino</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

$cod_inmueble = intval($_GET['cod_inmueble']);

$sql_cliente = "SELECT * FROM tbl15_inmueble WHERE cod_inmueble = '$cod_inmueble'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consulta_cliente);

$cod_inmueble_barra            = $info_cliente['cod_inmueble_barra'];
$nombre_inmueble               = $info_cliente['nombre_inmueble'];
$descripcion_inmueble          = $info_cliente['descripcion_inmueble'];
$direccion_inmueble            = $info_cliente['direccion_inmueble'];
$precio_alquiler_inmueble      = $info_cliente['precio_alquiler_inmueble'];
$url_img_orig_inmueble         = $info_cliente['url_img_orig_inmueble'];
$url_img_min_inmueble          = $info_cliente['url_img_min_inmueble'];
$latitud_inmueble              = $info_cliente['latitud_inmueble'];
$longitud_inmueble             = $info_cliente['longitud_inmueble'];
$cod_tercero                   = $info_cliente['cod_tercero'];
$cod_tipo_inmueble             = $info_cliente['cod_tipo_inmueble'];
$cod_estado_inmueble           = $info_cliente['cod_estado_inmueble'];

$nombre_tipo_tercero           = 'PROPIETARIO';
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_inmueble_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">TIPO INMUEBLE</th>
      		<th style="text-align:center">COD INMUEBLE</th>
			<th style="text-align:center">NOMBRE INMUEBLE</th>
			<th style="text-align:center">DESCRIPCIÓN INMUEBLE</th>

		</tr>
    	<tr>
			<td style="text-align:center">
				<select name="cod_tipo_inmueble" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
					<?php if (isset($cod_tipo_inmueble)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_tipo_inmueble, nombre_tipo_inmueble FROM tbl15_tipo_inmueble WHERE (cod_estado = '1') ORDER BY cod_tipo_inmueble ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_tipo_inmueble) and $cod_tipo_inmueble == $datos2['cod_tipo_inmueble']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_tipo_inmueble'];
					$nombre = $datos2['nombre_tipo_inmueble'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
      <td style="text-align:center"><input class="input-block-level" name="cod_inmueble_barra" type="text" value="<?php echo $cod_inmueble_barra ?>" size="30" id="cod_inmueble_barra" required/></td>
			<td style="text-align:center"><input class="input-block-level" name="nombre_inmueble" type="text" value="<?php echo $nombre_inmueble ?>" size="100" required/></td>
			<th style="text-align:center"><textarea class="input-block-level" name="descripcion_inmueble" rows="2" cols="100"><?php echo $descripcion_inmueble ?></textarea></th>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">DIRECCIÓN INMUEBLE</th>
			<th style="text-align:center">PRECIO ALQUILER</th>
			<th style="text-align:center">PROPIETARIO INMUEBLE</th>

		</tr>
    	<tr>
			<td style="text-align:center"><input class="input-block-level" name="direccion_inmueble" type="text" value="<?php echo $direccion_inmueble ?>" size="30" /></td>
			<td style="text-align:center"><input class="input-block-level" name="precio_alquiler_inmueble" type="number" value="<?php echo $precio_alquiler_inmueble ?>" size="10" step="any"/></td>
			<td style="text-align:left">
    			<select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
					<?php if (isset($cod_tercero)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_tercero, identificacion_tercero, digito_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
					FROM tbl15_tercero WHERE ((nombre_tipo_tercero = '$nombre_tipo_tercero') OR (nombre_tipo_tercero = 'AMBOS')) ORDER BY cod_tercero ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_tercero) and $cod_tercero == $datos2['cod_tercero']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_tercero'];
					$nombre = $datos2['nombre1_tercero'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_inmueble" value="<?php echo $cod_inmueble ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="ins_edit" value="formulario_insert_edit">
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