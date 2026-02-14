<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link href="../estilo_css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<!--<link href="../estilo_css/bootstrap-combined.min.css" rel="stylesheet">-->
<link href="../estilo_css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" media="screen">
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php 
//$pagina = addslashes($_GET['pagina']);
$pagina_red = $_SERVER['PHP_SELF']; 
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="#"><h4>Editar Paciente</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_cliente         = intval($_GET['cod_cliente']);
$pagina              = addslashes($_GET['pagina']);

$sql_cliente = "SELECT * FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$datos_cliente = mysqli_fetch_assoc($consulta_cliente);

$cedula                      = $datos_cliente['cedula'];
$nombres                     = $datos_cliente['nombres'];
$nombre_especie              = $datos_cliente['nombre_especie'];
$nombre_raza                 = $datos_cliente['nombre_raza'];
$nombre_color                = $datos_cliente['nombre_color'];
$nombre_sexo                 = $datos_cliente['nombre_sexo'];
$fecha_nac_ymd               = $datos_cliente['fecha_nac_ymd'];
$edad_anyo                   = $datos_cliente['edad_anyo'];
$senas_particulares          = $datos_cliente['senas_particulares'];
$nombre_procedencia          = $datos_cliente['nombre_procedencia'];
$nombre_contacto1            = $datos_cliente['nombre_contacto1'];
$identificacion_contacto1    = $datos_cliente['identificacion_contacto1'];
$direccion_contacto1         = $datos_cliente['direccion_contacto1'];
$estrato_contacto1           = $datos_cliente['estrato_contacto1'];
$municipio_contacto1         = $datos_cliente['municipio_contacto1'];
$tel_contacto1               = $datos_cliente['tel_contacto1'];
$ocupacion_contacto1         = $datos_cliente['ocupacion_contacto1'];
$correo_contacto1            = $datos_cliente['correo_contacto1'];
$cod_empresa                 = $datos_cliente['cod_empresa'];
?>
<div class="table-responsive">
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_paciente_reg.php">
<fieldset>
	
<div id="Info"></div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table align="left" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead><tr><th>DATOS DEL PACIENTE</th></tr></thead></table>

<table align="center" border="1" class="table table-responsive" cellspacing="0" cellpadding="0" style="font-family:mono; font-size:<?php echo $tamano_font_emp ?>pt; width:100%">
    <thead>
        <tr>
            <th valign="middle"><a href="../admin/edit_cargar_foto_cliente.php?cod_cliente=<?php echo $cod_cliente?>&pagina_red=<?php echo $pagina_red ?>"><img src="<?php echo $url_img_foto_min_cli ?>" class="img-polaroid" alt="Foto Paciente" style="border-style:dotted;border-width:1px;" width="71px"/></a></th>
        </tr>
    </thead>
</table>

<table align="center" border="1" width="100%" style="font-family: Mono; font-size: 10pt;">
<thead>
	<tr>
		<th>NOMBRE</th>
		<th>ESPECIE</th>
		<th>RAZA</th>
	</tr>
</thead>
<tbody><tr>
<td><input class="input-block-level" name="nombres" type="text" value="<?php echo $nombres ?>" required/></td>

<td><select name="nombre_especie" class="selectpicker" data-show-subtext="false" data-live-search="false" required>
<?php if (isset($nombre_especie)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_especie, nombre_especie FROM tbl15_especie ORDER BY cod_especie ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_especie) and $nombre_especie == $datos2['nombre_especie']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_especie'];
$nombre = $datos2['nombre_especie'];
echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select></td>

<td><select name="nombre_raza" class="selectpicker" data-show-subtext="false" data-live-search="false" required>
<?php if (isset($nombre_raza)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_raza, nombre_raza FROM tbl15_raza ORDER BY cod_raza ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_raza) and $nombre_raza == $datos2['nombre_raza']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['nombre_raza'];
$nombre = $datos2['nombre_raza'];
echo "<option value='".$nombre."' $seleccionado >".$nombre."</option>"; } ?></select></td>

</tr>
	<tr>
		<th>COLOR</th>
		<th>SEXO</th>
		<th>FECHA NACIMIENTO</th>
	</tr>
	<tr>
		<td><input class="input-block-level" name="nombre_color" type="text" value="<?php echo $nombre_color ?>" /></td>
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
		<td><input class="input-block-level" name="fecha_nac_ymd" type="date" value="<?php echo $fecha_nac_ymd ?>" required/></td>
	</tr>
	<tr>
		<th>EDAD</th>
		<th>SEÑAS PARTICULARES</th>
		<th>PROCEDENCIA</th>
	</tr>
	<tr>
		<td><input class="input-block-level" name="edad_anyo" type="number" value="<?php echo $edad_anyo ?>" /></td>
		<td><input class="input-block-level" name="senas_particulares" type="text" value="<?php echo $senas_particulares ?>" /></td>

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
<td style="text-align:center"><select name="cod_empresa" class="" data-show-subtext="false" data-live-search="false" required>
<?php if (isset($cod_empresa)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT cod_empresa, nit_empresa, nombre_empresa FROM tbl15_empresa ORDER BY cod_empresa ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_empresa) and $cod_empresa == $datos2['cod_empresa']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$codigo = $datos2['cod_empresa'];
$nombre = $datos2['nombre_empresa'];
$nit_empresa = $datos2['nit_empresa'];
echo "<option value='".$codigo."' $seleccionado >".$nombre.' - '.$nit_empresa."</option>"; } ?></select></td>
	</tr>
</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="ins_edit" value="formulario_insert_edit">
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<script src="../js/bootstrap-select.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.es.js"></script>
<script type="text/javascript">$('#fecha_nac_ymd').datetimepicker({ format: 'yyyy/MM/dd', language: 'es' });</script>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>