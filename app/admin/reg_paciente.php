<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link rel="stylesheet" href="../estilo_css/chosen.css">
<link href="../estilo_css/jquery.signaturepad.css" rel="stylesheet">
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/numeric-1.2.6.min.js"></script> 
<script src="../js/bezier.js"></script>
<script type='text/javascript' src="../js/html2canvas.js"></script>
<link rel="stylesheet" type="text/css" href="../estilo_css/estilo_modal.css">
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<script src="../js/jquery.signaturepad.js"></script>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<a href="../admin/lista_paciente_buscar.php"><h4>Registrar Paciente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/lista_paciente.php">Lista de Pacientes</h4></a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php $pagina = $_SERVER['PHP_SELF']; ?>

<div class="table-responsive">
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_paciente_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="Info"></div></td>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="left" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead><tr><th>DATOS DEL PACIENTE</th></tr></thead></table>

<table align="center" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead>
	<tr>
		<th>NOMBRE</th>
		<th>ESPECIE</th>
		<th>RAZA</th>
	</tr>
</thead>
<tbody><tr>
<td><input class="input-block-level" name="nombres" type="text" value="" required/></td>

<td style="text-align:left">
<div id="id_nombre_especie" class="input-append date">
	<select name="nombre_especie" id="select_nombre_especie" class="selectpicker" data-show-subtext="false" data-live-search="false" required>
	<?php if (isset($nombre_especie)) { echo "<option value='' >Selecione</option>";
	} else { echo  "<option value='' selected >Selecione</option>"; }
	$consulta2_sql = ("SELECT cod_especie, nombre_especie FROM tbl15_especie ORDER BY cod_especie ASC");
	$consulta2 = mysqli_query($conectar, $consulta2_sql);
	while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	if(isset($nombre_especie) and $nombre_especie == $datos2['nombre_especie']) {
	$seleccionado = "selected"; } else { $seleccionado = ""; }
	$codigo = $datos2['nombre_especie'];
	$nombre = $datos2['nombre_especie'];
	echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?>
	</select>

<input type="text" id="input_nombre_especie" name="input_nombre_especie" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_especie_mas"><button type="button" id="func_boton_nombre_especie_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_especie_reg"><button type="button" id="func_boton_nombre_especie_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>

<td style="text-align:left">
<div id="id_nombre_raza" class="input-append date">
	<select name="nombre_raza" id="select_nombre_raza" class="selectpicker" data-show-subtext="false" data-live-search="false" required>
	<?php if (isset($nombre_raza)) { echo "<option value='' >Selecione</option>";
	} else { echo  "<option value='' selected >Selecione</option>"; }
	$consulta2_sql = ("SELECT cod_raza, nombre_raza FROM tbl15_raza ORDER BY cod_raza ASC");
	$consulta2 = mysqli_query($conectar, $consulta2_sql);
	while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	if(isset($nombre_raza) and $nombre_raza == $datos2['nombre_raza']) {
	$seleccionado = "selected"; } else { $seleccionado = ""; }
	$codigo = $datos2['nombre_raza'];
	$nombre = $datos2['nombre_raza'];
	echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?>
	</select>

<input type="text" id="input_nombre_raza" name="input_nombre_raza" value="" class="form-control">

<span class="add-on">
<div id="boton_nombre_raza_mas"><button type="button" id="func_boton_nombre_raza_mas"><i class="fa fa-plus-circle"></i></button></div>
<div id="boton_nombre_raza_reg"><button type="button" id="func_boton_nombre_raza_reg"><i class="fa fa-check"></i></button></div>
</span>
</div>
</td>

</tr>
	<tr>
		<th>COLOR</th>
		<th>SEXO</th>
		<th>FECHA NACIMIENTO</th>
	</tr>
	<tr>
		<td><input class="input-block-level" name="nombre_color" type="text" value="" /></td>
		<td><select name="nombre_sexo" class="selectpicker" data-show-subtext="false" data-live-search="false" required>
		<?php if (isset($nombre_sexo)) { echo "<option value='' >Selecione</option>";
		} else { echo  "<option value='' selected >Selecione</option>"; }
		$consulta2_sql = ("SELECT cod_sexo, nombre_sexo FROM tbl15_sexo ORDER BY cod_sexo ASC");
		$consulta2 = mysqli_query($conectar, $consulta2_sql);
		while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		if(isset($nombre_sexo) and $nombre_sexo == $datos2['nombre_sexo']) {
		$seleccionado = "selected"; } else { $seleccionado = ""; }
		$codigo = $datos2['nombre_sexo'];
		$nombre = $datos2['nombre_sexo'];
		echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select></td>
		<td><input class="input-block-level" name="fecha_nac_ymd" id="fecha_nac_ymd" type="date" value="" required/></td>
	</tr>
	<tr>
		<th>EDAD (MESES)</th>
		<th>SEÑAS PARTICULARES</th>
		<th>PROCEDENCIA</th>
	</tr>
	<tr>
		<td>
			<input class="input-block-level" name="edad_mes" id="edad_mes" type="number" value="" />
			<strong>EDAD (AÑOS)</strong>
			<input class="input-block-level" name="edad_anyo" id="edad_anyo" type="number" value="" />
		</td>
		<td><input class="input-block-level" name="senas_particulares" type="text" value="" /></td>

		<td><select name="nombre_procedencia" class="selectpicker" data-show-subtext="false" data-live-search="false" required>
		<?php if (isset($nombre_procedencia)) { echo "<option value='' >Selecione</option>";
		} else { echo  "<option value='' selected >Selecione</option>"; }
		$consulta2_sql = ("SELECT cod_procedencia, nombre_procedencia FROM tbl15_procedencia ORDER BY cod_procedencia ASC");
		$consulta2 = mysqli_query($conectar, $consulta2_sql);
		while ($datos2 = mysqli_fetch_assoc($consulta2)) {
		if(isset($nombre_procedencia) and $nombre_procedencia == $datos2['nombre_procedencia']) {
		$seleccionado = "selected"; } else { $seleccionado = ""; }
		$codigo = $datos2['nombre_procedencia'];
		$nombre = $datos2['nombre_procedencia'];
		echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select></td>
	</tr>
</tbody>
</table>
<br>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="left" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead><tr><th>DATOS DEL PROPIETARIO</th></tr></thead></table>

<table align="center" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead>
	<tr>
		<th>NOMBRE</th>
		<th>IDENTIFICACIÓN</th>
		<th>DIRECCIÓN</th>
	</tr>
	<tr>
	<tr>
		<td><input class="input-block-level" name="nombre_contacto1" id="nombre_empresa" type="text" value="" required /></td>
		<td><input class="input-block-level" name="identificacion_contacto1" id="nit_empresa" type="text" value=""/></td>
		<td><input class="input-block-level" name="direccion_contacto1" id="direccion_empresa" type="text" value=""/></td>
	</tr>
	<tr>
		<th>ESTRATO</th>
		<th>MUNICIPIO</th>
		<th>TELÉFONO</th>
	</tr>
	<tr>
		<td><input class="input-block-level" name="estrato_contacto1" id="estrato_empresa" type="number" value=""/></td>
		<td><input class="input-block-level" name="municipio_contacto1" id="municipio_empresa" type="text" value=""/></td>
		<td><input class="input-block-level" name="tel_contacto1" id="telefono_empresa" type="text" value=""/></td>
	</tr>
	<tr>
		<th>EMAIL</th>
		<th>OCUPACIÓN</th>
	</tr>
	<tr>
		<td><input class="input-block-level" name="correo_contacto1" id="correo_empresa" type="text" value=""/></td>
		<td><input class="input-block-level" name="ocupacion_contacto1" id="ocupacion_empresa" type="text" value=""/></td>
		<input class="input-block-level" name="cod_empresa" id="cod_empresa" type="hidden" value=""/>
	</tr>
</thead>
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
</div>
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
<script src="../js/chosen.jquery.js" type="text/javascript"></script>
<script src="../js/init.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/json2.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<!--<script type="text/javascript" src="js/webcam.js"></script>-->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

	$("#select_nombre_especie").change(function(){

		var valor = $("#select_nombre_especie").val();
		var campo = 'nombre_especie';
		var tipo_ajax = 'nombre_especie';
			
		$.ajax({
		    type: "POST",
		    dataType: 'html',
		    url: "../admin/recargar_especie_raza_select_dependiente_ajax.php",
		    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
		    success: function(resp){
		        $('#select_nombre_raza').html(resp);
		    }
		});

	});

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

	$("#fecha_nac_ymd").change(function(){

		var fecha_nac_ymd = $("#fecha_nac_ymd").val();
		var frag = "";
		var edad_anyo = "";
		var edad_mes = "";

		$.ajax({
		    type: "POST",
		    dataType: 'html',
		    url: "../admin/convertir_facha_nac_en_anyos_meses_ajax.php",
		    data: "fecha_nac_ymd="+fecha_nac_ymd,
		    success: function(resp){
		        $('#respuesta_ajax').html(resp);
		        frag = resp.split("-");
		        edad_anyo = frag[0];
		        edad_mes = frag[1];
				document.getElementById("edad_anyo").value = edad_anyo;
				document.getElementById("edad_mes").value = edad_mes;
		    }
		});

	});

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_especie_reg').hide();
$('#input_nombre_especie').hide();

$("#func_boton_nombre_especie_mas").click(function(){
    $('#input_nombre_especie').show();
    $('#boton_nombre_especie_reg').show();
    $('#select_nombre_especie').hide();
    $('#boton_nombre_especie_mas').hide();
    document.getElementById("input_nombre_especie").focus();
});

$("#func_boton_nombre_especie_reg").click(function(){
    $('#boton_nombre_especie_mas').show();
    $('#select_nombre_especie').show();
    $('#boton_nombre_especie_reg').hide();
    $('#input_nombre_especie').hide();

		var valor = $("#input_nombre_especie").val();
		var campo = 'nombre_especie';
		var tipo_ajax = 'nombre_especie';

		$.ajax({
		    type: "POST",
		    dataType: 'html',
		    url: "../admin/guardar_consulta_select_ajax.php",
		    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
		    success: function(resp){
		        $('#respuesta_ajax').html(resp);
		        Limpiar_tipo_doc();
		        Cargar_tipo_doc(valor, campo);
		    }
		});

});

function Cargar_tipo_doc(valor, campo) {
var capa_cargar_datos = 'select_nombre_especie';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo });
}

function Limpiar_tipo_doc() {
var limpiar_datos = 'input_nombre_especie';
$("#"+limpiar_datos).val("");
}

});
</script>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script>
$(document).ready(function() {

$('#boton_nombre_raza_reg').hide();
$('#input_nombre_raza').hide();

$("#func_boton_nombre_raza_mas").click(function(){
    $('#input_nombre_raza').show();
    $('#boton_nombre_raza_reg').show();
    $('#select_nombre_raza').hide();
    $('#boton_nombre_raza_mas').hide();
    document.getElementById("input_nombre_raza").focus();
});

$("#func_boton_nombre_raza_reg").click(function(){
    $('#boton_nombre_raza_mas').show();
    $('#select_nombre_raza').show();
    $('#boton_nombre_raza_reg').hide();
    $('#input_nombre_raza').hide();

	var valor = $("#input_nombre_raza").val();
	var nombre_especie = $("#select_nombre_especie").val();
	var campo = 'nombre_raza';
	var tipo_ajax = 'nombre_raza';

	$.ajax({
	    type: "POST",
	    dataType: 'html',
	    url: "../admin/guardar_consulta_select_ajax.php",
	    data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax+"&nombre_especie="+nombre_especie,
	    success: function(resp){
	        $('#respuesta_ajax').html(resp);
	        Limpiar_tipo_doc();
	        Cargar_tipo_doc(valor, campo, nombre_especie);
	    }
	});

});

function Cargar_tipo_doc(valor, campo, nombre_especie) {
var capa_cargar_datos = 'select_nombre_raza';
$('#'+capa_cargar_datos).load("../admin/recargar_consulta_select_ajax.php", { 'valor': valor, 'campo': campo, 'nombre_especie': nombre_especie });
}

function Limpiar_tipo_doc() {
var limpiar_datos = 'input_nombre_raza';
$("#"+limpiar_datos).val("");
}

});
</script>


<script type="text/javascript">
$(function() {
$("#nombre_empresa").autocomplete({
source: "autocompletar_nombre_empresa_ajax.php",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
console.log(this.name);
console.log(this.id);

$('#cod_empresa').val(ui.item.cod_empresa);
$('#nombre_empresa').val(ui.item.nombre_empresa);
$('#nit_empresa').val(ui.item.nit_empresa);
$('#direccion_empresa').val(ui.item.direccion_empresa);
$('#estrato_empresa').val(ui.item.estrato_empresa);
$('#municipio_empresa').val(ui.item.municipio_empresa);
$('#telefono_empresa').val(ui.item.telefono_empresa);
$('#correo_empresa').val(ui.item.correo_empresa);
$('#ocupacion_empresa').val(ui.item.ocupacion_empresa);
}
});
});
</script>

</body>
</html>