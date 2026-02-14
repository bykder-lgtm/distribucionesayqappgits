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
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="../admin/lista_tercero.php"><h4>Crear Nuevo Credito</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_local                                = $_SERVER['PHP_SELF'];

if (isset($_GET['cod_tercero'])) {
	$cod_tercero                                              = intval($_GET['cod_tercero']);

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
    $cod_pais                                                 = $info_cliente['cod_pais'];
    $cod_departamento                                         = $info_cliente['cod_departamento'];
    $cod_municipio                                            = $info_cliente['cod_municipio'];
    $fecha_pago                                               = date("Y-m-d");
?>
<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_siscredito_tercero_crear_nuevo_credito_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table class="table table-responsive">
    <th style="text-align:left"><h4><a>Información del Cliente</a></h4></th>
</table>

<table border="1" class="table table-responsive">
	<tbody>
		<tr>
			<th style="text-align:center">TIPO IDENTIFICACION</th>
			<th style="text-align:center">DOCUMENTO</th>
			<th style="text-align:center">NOMBRES Y APELLIDOS</th>
			<th style="text-align:center">DIRECCION</th>
			<th style="text-align:center">TELEFONO 1</th>
			<th style="text-align:center">CORREO</th>
		</tr>
    	<tr>
			<td style="text-align:center"><?php echo $nombre_tipo_identificacion ?></td>
			<td style="text-align:center"><?php echo $identificacion_tercero ?></td>
			<td style="text-align:center"><?php echo trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero) ?></td>
			<td style="text-align:center"><?php echo $direccion_tercero ?></td>
			<td style="text-align:center"><?php echo $telefono1_tercero ?></td>
			<td style="text-align:center"><?php echo $correo_tercero ?></td>
    	</tr>
    </tbody>
</table>

<table class="table table-responsive">
    <th style="text-align:left"><h4><a>Información del Credito</a></h4></th>
</table>

<table border="1" class="table table-responsive">
    <tbody>
        <tr>
            <th style="text-align:center">ENTIDAD CREDITICIA</th>
            <th style="text-align:center">NOMBRE DEL ARTICULO</th>
            <th style="text-align:center">VALOR DEL ARTICULO</th>
            <th style="text-align:center">VALOR DEL CREDITO</th>
            <th style="text-align:center">FACTURA</th>
            <th style="text-align:center">FECHA</th>
        </tr>
        <tr>
            <td style="text-align:center">
                <select id="cod_entidad_crediticia" name="cod_entidad_crediticia" class="input-block-level"  style="font-size:15px" required>
                    <?php if (isset($cod_entidad_crediticia)) { echo ""; } else { echo "<option value='' selected >Selecione</option>"; }
                    $consulta2_sql = "SELECT * FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'ENTIDAD_CREDITICIA')";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_entidad_crediticia) and $cod_entidad_crediticia == $datos2['cod_tercero']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo           = $datos2['cod_tercero'];
                    $nombre           = trim($datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero']);
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
            <td style="text-align:center"><input class="input-block-level" style="width:400px" name="nombre_producto" type="text" value="" required/></td>
            <td style="text-align:center"><input class="input-block-level" style="width:100px" id="monto_deuda_sin_interes" name="monto_deuda_sin_interes" type="text" value="" required/></td>
            <td style="text-align:center"><input class="input-block-level" style="width:100px" id="monto_deuda_mas_interes" name="monto_deuda_mas_interes" type="text" value="" required/></td>
            <td style="text-align:center"><input class="input-block-level" style="width:100px" id="cod_factura" name="cod_factura" type="text" value=""/></td>
            <td style="text-align:center"><input class="input-block-level" style="width:130px" name="fecha_pago" type="date" value="<?php echo $fecha_pago ?>" required/></td>
        </tr>
    </tbody>
</table>

<table border="1" class="table table-responsive">
    <tbody>
        <tr>
            <th style="text-align:center">LIDER</th>
            <th style="text-align:center">COORDINADOR</th>
            <th style="text-align:center">ASESOR</th>
        </tr>
        <tr>
            <td style="text-align:left">
                <select id="cod_lider" name="cod_lider" class="input-block-level"  style="font-size:15px" required>
                    <?php if (isset($cod_lider)) { echo ""; } else { echo "<option value='' selected >Selecione</option>"; }
                    $consulta2_sql = "SELECT * FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'LIDER')";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_lider) and $cod_lider == $datos2['cod_tercero']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo           = $datos2['cod_tercero'];
                    $nombre           = trim($datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero']);
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
            <td style="text-align:left">
                <select id="cod_coordinador" name="cod_coordinador" class="input-block-level"  style="font-size:15px" required>
                    <?php if (isset($cod_coordinador)) { echo ""; } else { echo "<option value='' selected >Selecione</option>"; }
                    $consulta2_sql = "SELECT * FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'COORDINADOR')";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_coordinador) and $cod_coordinador == $datos2['cod_tercero']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo           = $datos2['cod_tercero'];
                    $nombre           = trim($datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero']);
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
            <td style="text-align:left">
                <select id="cod_asesor" name="cod_asesor" class="input-block-level"  style="font-size:15px" required>
                    <?php if (isset($cod_asesor)) { echo ""; } else { echo "<option value='' selected >Selecione</option>"; }
                    $consulta2_sql = "SELECT * FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'ASESOR')";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_asesor) and $cod_asesor == $datos2['cod_tercero']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo           = $datos2['cod_tercero'];
                    $nombre           = trim($datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero']);
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
        </tr>
        <tr>
            <th style="text-align:center">VENDEDOR</th>
            <th style="text-align:center">PROVEEDOR</th>
            <th style="text-align:center">ALIADO</th>
        </tr>
        <tr>
            <td style="text-align:left">
                <select id="cod_vendedor" name="cod_vendedor" class="input-block-level"  style="font-size:15px" required>
                    <?php if (isset($cod_vendedor)) { echo ""; } else { echo "<option value='' selected >Selecione</option>"; }
                    $consulta2_sql = "SELECT * FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'VENDEDOR')";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_vendedor) and $cod_vendedor == $datos2['cod_tercero']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo           = $datos2['cod_tercero'];
                    $nombre           = trim($datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero']);
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
            <td style="text-align:left">
                <select id="cod_proveedor" name="cod_proveedor" class="input-block-level"  style="font-size:15px" required>
                    <?php if (isset($cod_proveedor)) { echo ""; } else { echo "<option value='' selected >Selecione</option>"; }
                    $consulta2_sql = "SELECT * FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'PROVEEDOR')";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_proveedor) and $cod_proveedor == $datos2['cod_tercero']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo           = $datos2['cod_tercero'];
                    $nombre           = trim($datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero']);
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
            <td style="text-align:left">
                <select id="cod_aliado_estrategico" name="cod_aliado_estrategico" class="input-block-level"  style="font-size:15px" required>
                    <?php if (isset($cod_aliado_estrategico)) { echo ""; } else { echo "<option value='' selected >Selecione</option>"; }
                    $consulta2_sql = "SELECT * FROM tbl15_tercero WHERE (nombre_tipo_tercero = 'ALIADO_ESTRATEGICO')";
                    $consulta2 = mysqli_query($conectar, $consulta2_sql) or die(mysql_error());
                    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                    if(isset($cod_aliado_estrategico) and $cod_aliado_estrategico == $datos2['cod_tercero']) {
                    $seleccionado = "selected"; } else { $seleccionado = ""; }
                    $codigo           = $datos2['cod_tercero'];
                    $nombre           = trim($datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero']);
                    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                </select>
            </td>
        </tr>
    </tbody>
</table>

<table border="1" class="table table-responsive">

<tr>
    <th style="text-align:right">CARGAR SOPORTE</th>
    <td style="text-align:left"><input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)"/><a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a><div id="vista_archivo"></div></td>
</tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<hr>
<div class="actions">
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
</form>
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