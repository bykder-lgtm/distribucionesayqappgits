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
<?php 

$cod_tercero                                 = intval($_GET['cod_tercero']);
$pagina                                      = addslashes($_GET['pagina']);

if (isset($_GET['nombre_tipo_tercero'])) { $nombre_tipo_tercero = addslashes($_GET['nombre_tipo_tercero']); } else { $nombre_tipo_tercero = 'CLIENTE'; }
$nombre_tipo_tercero_titulo = str_replace('_', ' ', $nombre_tipo_tercero);
$nombre_tipo_tercero_titulo = ucwords($nombre_tipo_tercero_titulo);
$nombre_tipo_tercero_titulo = ucwords(strtolower($nombre_tipo_tercero_titulo));
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="../admin/lista_siscredito_tercero.php?nombre_tipo_tercero=<?php echo $nombre_tipo_tercero?>"><h4>Editar <?php echo $nombre_tipo_tercero_titulo?></h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local                                = $_SERVER['PHP_SELF'];

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
	$cod_tercero_consulta                    = intval($_GET['cod_tercero_consulta']);
    $fecha_ymd_venta_producto_ini_consulta   = addslashes($_GET['fecha_ymd_venta_producto_ini']);
    $fecha_ymd_venta_producto_fin_consulta   = addslashes($_GET['fecha_ymd_venta_producto_fin']);
    $cod_administrador_consulta              = intval($_GET['cod_administrador']);
    $cod_tipo_pago_consulta                  = intval($_GET['cod_tipo_pago']);
    $cod_tipo_forma_pago_consulta            = intval($_GET['cod_tipo_forma_pago']);
    $cod_dependencia_consulta                = intval($_GET['cod_dependencia']);
    $nombre_tipo_factura_consulta            = addslashes($_GET['nombre_tipo_factura']);
    $nombre_tipo_compra_consulta             = addslashes($_GET['nombre_tipo_compra']);
} else {
    $cod_tercero_consulta                    = '';
    $fecha_ymd_venta_producto_ini_consulta   = '';
    $fecha_ymd_venta_producto_fin_consulta   = '';
    $cod_administrador_consulta              = '';
    $cod_tipo_pago_consulta                  = '';
    $cod_tipo_forma_pago_consulta            = '';
    $cod_dependencia_consulta                = '';
    $nombre_tipo_factura_consulta            = '';
    $nombre_tipo_compra_consulta             = '';
}

$sql_cliente = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consulta_cliente);

$nombre_tipo_tercero                                      = $info_cliente['nombre_tipo_tercero'];
$nombre_tipo_identificacion                               = $info_cliente['nombre_tipo_identificacion'];
$identificacion_tercero                                   = $info_cliente['identificacion_tercero'];
$digito_tercero                                           = $info_cliente['digito_tercero'];
$nombre1_tercero                                          = $info_cliente['nombre1_tercero'];
$nombre2_tercero                                          = $info_cliente['nombre2_tercero'];
$apellido1_tercero                                        = $info_cliente['apellido1_tercero'];
$apellido2_tercero                                        = $info_cliente['apellido2_tercero'];
$direccion_tercero                                        = $info_cliente['direccion_tercero'];
$telefono1_tercero                                        = $info_cliente['telefono1_tercero'];
$telefono2_tercero                                        = $info_cliente['telefono2_tercero'];
$correo_tercero                                           = $info_cliente['correo_tercero'];
$nombre_pais                                              = $info_cliente['nombre_pais'];
$nombre_departamento                                      = $info_cliente['nombre_departamento'];
$nombre_ciudad                                            = $info_cliente['nombre_ciudad'];
$nombre_tipo_cliente                                      = $info_cliente['nombre_tipo_cliente'];
$nombre_tipo_regimen                                      = $info_cliente['nombre_tipo_regimen'];
$nombre_tipo_impuesto                                     = $info_cliente['nombre_tipo_impuesto'];
$contacto_tercero                                         = $info_cliente['contacto_tercero'];
$fax_tercero                                              = $info_cliente['fax_tercero'];
$cod_administrador                                        = $info_cliente['cod_administrador'];
$fecha_nac_tercero                                        = $info_cliente['fecha_nac_tercero'];

$cod_estado_dto_tercero                                   = $info_cliente['cod_estado_dto_tercero'];
$dto1_con_iva_tercero                                     = $info_cliente['dto1_con_iva_tercero'];
$dto2_con_iva_tercero                                     = $info_cliente['dto2_con_iva_tercero'];
$dto1_sin_iva_tercero                                     = $info_cliente['dto1_sin_iva_tercero'];
$dto2_sin_iva_tercero                                     = $info_cliente['dto2_sin_iva_tercero'];
$dto1_excento_iva_tercero                                 = $info_cliente['dto1_excento_iva_tercero'];
$dto2_excento_iva_tercero                                 = $info_cliente['dto2_excento_iva_tercero'];

$cod_pais                                                 = $info_cliente['cod_pais'];
$cod_departamento                                         = $info_cliente['cod_departamento'];
$cod_municipio                                            = $info_cliente['cod_municipio'];

$total_puntos_redimibles_campanya_tercero                 = $info_cliente['total_puntos_redimibles_campanya_tercero'];
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/edit_siscredito_tercero_reg.php">
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
			<td><input class="input-block-level" name="identificacion_tercero" type="text" value="<?php echo $identificacion_tercero ?>"/></td>
			<td><input class="input-block-level" name="digito_tercero" type="number" value="<?php echo $digito_tercero ?>"/></td>
    	<tr>
    	</tr>
		<tr>
			<th style="text-align:center">NOMBRE 1</th>
			<th style="text-align:center">NOMBRE 2</th>
			<th style="text-align:center">APELLIDO 1</th>
			<th style="text-align:center">APELLIDO 2</th>
		</tr>
    	<tr>
			<td><input class="input-block-level" name="nombre1_tercero" type="text" value="<?php echo $nombre1_tercero ?>"/></td>
			<td><input class="input-block-level" name="nombre2_tercero" type="text" value="<?php echo $nombre2_tercero ?>"/></td>
			<td><input class="input-block-level" name="apellido1_tercero" type="text" value="<?php echo $apellido1_tercero ?>"/></td>
			<td><input class="input-block-level" name="apellido2_tercero" type="text" value="<?php echo $apellido2_tercero ?>"/></td>
    	</tr>
		<tr>
			<th style="text-align:center">DIRECCION</th>
			<th style="text-align:center">TELEFONO 1</th>
			<th style="text-align:center">TELEFONO 2</th>
			<th style="text-align:center">CORREO</th>
		</tr>
    	<tr>
			<td><input class="input-block-level" name="direccion_tercero" type="text" value="<?php echo $direccion_tercero ?>"/></td>
			<td><input class="input-block-level" name="telefono1_tercero" type="text" value="<?php echo $telefono1_tercero ?>"/></td>
			<td><input class="input-block-level" name="telefono2_tercero" type="text" value="<?php echo $telefono2_tercero ?>"/></td>
			<td><input class="input-block-level" name="correo_tercero" type="text" value="<?php echo $correo_tercero ?>"/></td>
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
			        <?php if (isset($cod_pais)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_pais WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_pais) and $cod_pais == $datos2['cod_pais']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_pais'];
			        $nombre           = $datos2['nombre_pais'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>

			<td>
            	<select name="cod_departamento" id="cod_departamento" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
			        <?php if (isset($cod_departamento)) { echo ""; } else { echo  ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_departamento WHERE (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_departamento) and $cod_departamento == $datos2['cod_departamento']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_departamento'];
			        $nombre           = $datos2['nombre_departamento'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>

			<td id="cod_municipio_select">
            	<select name="cod_municipio" id="cod_municipio" class="chosen" data-show-subtext="true" data-live-search="true" required>
			        <?php if (isset($cod_municipio)) { echo "<option value='0' selected >Selecione</option>"; } else { echo "<option value='0' selected >Selecione</option>"; }
			        $consulta2_sql = "SELECT * FROM tbl15_municipio WHERE (cod_departamento = '$cod_departamento') AND (cod_estado = '1')";
			        $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
			        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
			        if(isset($cod_municipio) and $cod_municipio == $datos2['cod_municipio']) {
			        $seleccionado = "selected"; } else { $seleccionado = ""; }
			        $codigo           = $datos2['cod_municipio'];
			        $nombre           = $datos2['nombre_municipio'];
			        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
		   		</select>
			</td>

			<td>
				<select id="select_nombre_tipo_cliente" name="nombre_tipo_cliente" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_tipo_cliente)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_cliente WHERE (cod_estado = '1')";
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
			<th style="text-align:center">CONTACTO</th>
			<th style="text-align:center">FAX</th>
		</tr>
    	<tr>
			<td>
				<select id="select_nombre_tipo_impuesto" name="nombre_tipo_impuesto" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($nombre_tipo_impuesto)) { echo ""; } else { echo ""; }
			        $consulta2_sql = "SELECT * FROM tbl15_tipo_impuesto WHERE (cod_estado = '1')";
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
			        <?php if (isset($nombre_tipo_regimen)) { echo ""; } else { echo ""; }
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
			<td><input class="input-block-level" name="contacto_tercero" type="text" value="<?php echo $contacto_tercero ?>"/></td>
			<td><input class="input-block-level" name="fax_tercero" type="text" value="<?php echo $fax_tercero ?>"/></td>
    	</tr>
		<tr>
			<th style="text-align:center">FECHA NACIMIENTO</th>
			<th style="text-align:center">USUARIO</th>
			<!--<th style="text-align:center">PUNTOS REDIMIBLES</th>-->
			<th style="text-align:center"></th>
			<th style="text-align:center"></th>
		</tr>
    	<tr>
			<td><input class="input-block-level" name="fecha_nac_tercero" type="date" value="<?php echo $fecha_nac_tercero ?>"/></td>
			<td>
				<select id="cod_administrador" name="cod_administrador" class="input-block-level"  style="font-size:15px">
			        <?php if (isset($cod_administrador)) { echo ""; } else { echo ""; }
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
			<!--<td><input class="input-block-level" name="total_puntos_redimibles_campanya_tercero" type="text" value="<?php echo $total_puntos_redimibles_campanya_tercero ?>"/></td>-->
			<td></td>
			<td></td>
    	</tr>
    </tbody>
</table>
<?php if ($nombre_tipo_tercero == 'ALIADO_ESTRATEGICO') { ?>
<table border="1" class="table table-responsive">
	<tbody>
		<tr>
			<th style="text-align:center">NOMBRE</th>
			<th style="text-align:center">NOMBRE</th>

			<th style="text-align:center">NOMBRE</th>
			<th style="text-align:center">APELLIDO</th>
			<th style="text-align:center">APELLIDO</th>
		</tr>
		<tr>
			<td style="text-align:center">NOMBRE</td>
			<td style="text-align:center">NOMBRE</td>

			<td style="text-align:center">NOMBRE</td>
			<td style="text-align:center">APELLIDO</td>
			<td style="text-align:center">APELLIDO</td>
		</tr>
    </tbody>
</table>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<input type="hidden" name="cod_tercero_consulta" value="<?php echo $cod_tercero_consulta ?>">
<input type="hidden" name="fecha_ymd_venta_producto_ini_consulta" value="<?php echo $fecha_ymd_venta_producto_ini_consulta ?>">
<input type="hidden" name="fecha_ymd_venta_producto_fin_consulta" value="<?php echo $fecha_ymd_venta_producto_fin_consulta ?>">
<input type="hidden" name="cod_administrador_consulta" value="<?php echo $cod_administrador_consulta ?>">
<input type="hidden" name="cod_tipo_pago_consulta" value="<?php echo $cod_tipo_pago_consulta ?>">
<input type="hidden" name="cod_tipo_forma_pago_consulta" value="<?php echo $cod_tipo_forma_pago_consulta ?>">
<input type="hidden" name="cod_dependencia_consulta" value="<?php echo $cod_dependencia_consulta ?>">
<input type="hidden" name="nombre_tipo_factura_consulta" value="<?php echo $nombre_tipo_factura_consulta ?>">
<input type="hidden" name="nombre_tipo_compra_consulta" value="<?php echo $nombre_tipo_compra_consulta ?>">
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