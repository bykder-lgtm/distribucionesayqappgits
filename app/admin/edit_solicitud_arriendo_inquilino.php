<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>

<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/json2.min.js"></script>
<script type="text/javascript" src="js/jquery.number.js"></script>

<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

<script type="text/javascript">
$(function(){
	$('#valor_solicitud_arriendo').number( true, 0 );

	$("#valor_solicitud_arriendo").keyup(function () {
	    var valor_solicitud_arriendo = $(this).val();
	    $("#valor_solicitud_arriendo_hidden").val(parseFloat(valor_solicitud_arriendo));
	});
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
<div class="breadcrumbs"><a href="<?php echo $pagina ?>"><h4>Editar Solicitud de Arriendo</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];

$cod_tercero = intval($_GET['cod_tercero']);

$sql_cliente = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consulta_cliente);

$nombre_tipo_tercero                  = $info_cliente['nombre_tipo_tercero'];
$nombre_tipo_identificacion           = $info_cliente['nombre_tipo_identificacion'];
$identificacion_tercero               = $info_cliente['identificacion_tercero'];
$digito_tercero                       = $info_cliente['digito_tercero'];
$nombre1_tercero                      = $info_cliente['nombre1_tercero'];
$nombre2_tercero                      = $info_cliente['nombre2_tercero'];
$apellido1_tercero                    = $info_cliente['apellido1_tercero'];
$apellido2_tercero                    = $info_cliente['apellido2_tercero'];
$direccion_tercero                    = $info_cliente['direccion_tercero'];
$telefono1_tercero                    = $info_cliente['telefono1_tercero'];
$telefono2_tercero                    = $info_cliente['telefono2_tercero'];
$correo_tercero                       = $info_cliente['correo_tercero'];
$nombre_pais                          = $info_cliente['nombre_pais'];
$nombre_departamento                  = $info_cliente['nombre_departamento'];
$nombre_ciudad                        = $info_cliente['nombre_ciudad'];
$nombre_tipo_cliente                  = $info_cliente['nombre_tipo_cliente'];
$nombre_tipo_regimen                  = $info_cliente['nombre_tipo_regimen'];
$nombre_tipo_impuesto                 = $info_cliente['nombre_tipo_impuesto'];
$contacto_tercero                     = $info_cliente['contacto_tercero'];
$fax_tercero                          = $info_cliente['fax_tercero'];
$cod_administrador                    = $info_cliente['cod_administrador'];
$fecha_nac_tercero                    = $info_cliente['fecha_nac_tercero'];
$cod_estado                           = $info_cliente['cod_estado'];
$nombre_tipo_producto                 = $info_cliente['nombre_tipo_producto'];

$nombre_tipo_solicitud                = $info_cliente['nombre_tipo_solicitud'];
$cod_solicitud_arriendo               = $info_cliente['cod_solicitud_arriendo'];
$tiempo_contrato_solicitud_arriendo   = $info_cliente['tiempo_contrato_solicitud_arriendo'];
$valor_solicitud_arriendo             = $info_cliente['valor_solicitud_arriendo'];
$fecha_solicitud_arriendo             = $info_cliente['fecha_solicitud_arriendo'];
$nombre_estado_solicitud_arriendo     = $info_cliente['nombre_estado_solicitud_arriendo'];
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_solicitud_arriendo_inquilino_reg.php">
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
			        <?php if (isset($nombre_tipo_identificacion)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_identificacion";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_identificacion) and $nombre_tipo_identificacion == $datos2['nombre_tipo_identificacion']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_identificacion'];
			        $nombre           = $datos2['nombre_tipo_identificacion'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>
			<td><input class="input-block-level" name="identificacion_tercero" type="number" value="<?php echo $identificacion_tercero ?>"/></td>
			<td><input class="input-block-level" name="digito_tercero" type="number" value="<?php echo $digito_tercero ?>"/></td>
    	<tr>
    	</tr>
		<tr>
			<th style="text-align:center">NOMBRE SOLICITUD DE ARRIENDO</th>
			<th style="text-align:center">DIRECCION</th>
			<th style="text-align:center">TELEFONO</th>
			<th style="text-align:center">CORREO</th>
		</tr>
    	<tr>
			<td><input class="input-block-level" name="nombre1_tercero" type="text" value="<?php echo $nombre1_tercero ?>"/></td>
			<td><input class="input-block-level" name="direccion_tercero" type="text" value="<?php echo $direccion_tercero ?>"/></td>
			<td><input class="input-block-level" name="telefono1_tercero" type="text" value="<?php echo $telefono1_tercero ?>"/></td>
			<td><input class="input-block-level" name="correo_tercero" type="text" value="<?php echo $correo_tercero ?>"/></td>
    	</tr>
		<tr>
			<th style="text-align:center">PAIS</th>
			<th style="text-align:center">DEPARTAMENTO</th>
			<th style="text-align:center">CIUDAD</th>
			<th style="text-align:center">TIPO PERSONA</th>
		</tr>
    	<tr>
			<td>
				<select id="nombre_pais" name="nombre_pais" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_pais)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_pais";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_pais) and $nombre_pais == $datos2['nombre_pais']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_pais'];
			        $nombre           = $datos2['nombre_pais'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>

			<td>
				<select id="nombre_departamento" name="nombre_departamento" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_departamento)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_departamento";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_departamento) and $nombre_departamento == $datos2['nombre_departamento']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_departamento'];
			        $nombre           = $datos2['nombre_departamento'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>

			<td><input class="input-block-level" name="nombre_ciudad" id="nombre_ciudad" type="text" value="<?php echo $nombre_ciudad ?>"/></td>
			<td>
				<select id="select_nombre_tipo_cliente" name="nombre_tipo_cliente" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_tipo_cliente)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_cliente";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_cliente) and $nombre_tipo_cliente == $datos2['nombre_tipo_cliente']) {
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
			<th style="text-align:center">USUARIO</th>
			<th style="text-align:center">ESTADO</th>
		<!--
			<th style="text-align:center">FECHA NACIMIENTO</th>
			<th style="text-align:center">CONTACTO</th>
			<th style="text-align:center">FAX</th>
		-->
		</tr>
    	<tr>
			<td>
				<select id="select_nombre_tipo_impuesto" name="nombre_tipo_impuesto" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_tipo_impuesto)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_impuesto";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_impuesto) and $nombre_tipo_impuesto == $datos2['nombre_tipo_impuesto']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_impuesto'];
			        $nombre           = $datos2['nombre_tipo_impuesto'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>
			<td>
				<select id="select_nombre_tipo_regimen" name="nombre_tipo_regimen" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_tipo_regimen)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_regimen WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_regimen) and $nombre_tipo_regimen == $datos2['nombre_tipo_regimen']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['nombre_tipo_regimen'];
			        $nombre           = $datos2['nombre_tipo_regimen'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>
			<td>
				<select id="cod_administrador" name="cod_administrador" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($cod_administrador)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_administrador";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_administrador) and $cod_administrador == $datos2['cod_administrador']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['cod_administrador'];
			        $nombre = $datos2['nombres'].' '.$datos2['apellidos'].' | '.$datos2['cuenta'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>
			<td>
				<select id="cod_estado" name="cod_estado" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($cod_estado)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT cod_estado, nombre_estado FROM tbl15_estado";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_estado) and $cod_estado == $datos2['cod_estado']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['cod_estado'];
			        $nombre = $datos2['nombre_estado'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>
			<!--
			<td><input class="input-block-level" name="fecha_nac_tercero" type="date" value="<?php echo $fecha_nac_tercero ?>"/></td>
			<td><input class="input-block-level" name="contacto_tercero" type="text" value="<?php echo $contacto_tercero ?>"/></td>
			<td><input class="input-block-level" name="fax_tercero" type="text" value="<?php echo $fax_tercero ?>"/></td>
			-->
    	</tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<tbody>
		<tr>
			<th style="text-align:center">TIPO SOLICITUD</th>
			<th style="text-align:center">TIPO INMUEBLE</th>
			<th style="text-align:center">CODIGO SOLICITUD ARRIENDO</th>
			<th style="text-align:center">TIEMPO CONTRATO (MESES)</th>
			<th style="text-align:center">VALOR SOLICITUD ARRIENDO</th>
			<th style="text-align:center">FECHA SOLICITUD ARRIENDO</th>
			<th style="text-align:center">ESTADO SOLICITUD ARRIENDO</th>
		</tr>
		<tr>
			<td>
				<select id="nombre_tipo_solicitud" name="nombre_tipo_solicitud" class="input-block-level">
			        <?php if (isset($nombre_tipo_solicitud)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_solicitud WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_tipo_solicitud) and $nombre_tipo_solicitud == $datos2['nombre_tipo_solicitud']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['nombre_tipo_solicitud'];
			        $nombre = $datos2['nombre_tipo_solicitud'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>

			<td>
                <select name="nombre_tipo_producto" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 150px;">
                    <?php if (isset($nombre_tipo_producto)) { echo ""; } else { echo ""; }
                    $consulta2_sql = ("SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto WHERE (cod_estado = '1') ORDER BY cod_tipo_producto ASC");
                    $consulta2 = mysqli_query($conectar, $consulta2_sql);
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($nombre_tipo_producto) and $nombre_tipo_producto == $datos2['nombre_tipo_producto']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo = $datos2['nombre_tipo_producto'];
                    $nombre = $datos2['nombre_tipo_producto'];
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>

			<td><input style="font-size:24px" class="input-block-level" name="cod_solicitud_arriendo" type="number" value="<?php echo $cod_solicitud_arriendo ?>" required/></td>
			<td><input style="font-size:24px" class="input-block-level" name="tiempo_contrato_solicitud_arriendo" type="number" value="<?php echo $tiempo_contrato_solicitud_arriendo ?>" required/></td>
			<td>
				<input style="font-size:24px" class="input-block-level" name="valor_solicitud_arriendo" id="valor_solicitud_arriendo" type="text" value="<?php echo $valor_solicitud_arriendo ?>" required/>
				<input style="font-size:24px" class="input-block-level" name="valor_solicitud_arriendo_hidden" id="valor_solicitud_arriendo_hidden" type="hidden" value="<?php echo $valor_solicitud_arriendo ?>"/>
			</td>
			<td><input style="font-size:24px" class="input-block-level" name="fecha_solicitud_arriendo" type="date" value="<?php echo $fecha_solicitud_arriendo ?>" required/></td>
			<td>
				<select id="nombre_estado_solicitud_arriendo" name="nombre_estado_solicitud_arriendo" class="input-block-level" style="font-size:20px">
			        <?php if (isset($nombre_estado_solicitud_arriendo)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
			        $consulta2_sql = "SELECT cod_sino, nombre_sino FROM tbl15_sino";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($nombre_estado_solicitud_arriendo) and $nombre_estado_solicitud_arriendo == $datos2['nombre_sino']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo = $datos2['nombre_sino'];
			        $nombre = $datos2['nombre_sino'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>
		</tr>
    </tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero ?>">
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