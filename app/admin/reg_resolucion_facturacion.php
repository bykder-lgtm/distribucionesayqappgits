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
<!--<a class="btn btn-info" href="../admin/menu_lista.php">Lista de Productos</a>-->
<a class="btn btn-success" href="#">Registrar Resolucion</a>
<a class="btn btn-primary" href="../admin/lista_resolucion_facturacion.php">Lista de Resolucion</a>
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
?>
<form name="formulario_insersion" accept-charset="utf-8" method="post" action="../admin/reg_resolucion_facturacion_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center" id="mensaje_verificacion_producto">.</th>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">TIPO DE MODULO</th>
			<th style="text-align:center">TIPO DE FACTURACION</th>
			<th style="text-align:center">NUMERO DE RESOLUCION</th>
			<th style="text-align:center">INICIO DE NUMERACION</th>
			<th style="text-align:center">FINAL DE NUMERACION</th>
		</tr>
    	<tr>
			<td style="text-align:center">
				<select name="cod_origen_resolucion_facturacion" id="cod_origen_resolucion_facturacion" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 220px;" required>
					<?php if (isset($cod_origen_resolucion_facturacion)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_origen_resolucion_facturacion, nombre_origen_resolucion_facturacion FROM tbl15_origen_resolucion_facturacion ORDER BY cod_origen_resolucion_facturacion ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($cod_origen_resolucion_facturacion) and $cod_origen_resolucion_facturacion == $datos2['cod_origen_resolucion_facturacion']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['cod_origen_resolucion_facturacion'];
					$nombre = $datos2['nombre_origen_resolucion_facturacion'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center">
				<select name="nombre_tipo_resolucion_facturacion"  id="nombre_tipo_resolucion_facturacion_select" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 220px;" required>
					<?php if (isset($nombre_tipo_resolucion_facturacion)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_tipo_resolucion_facturacion, nombre_tipo_resolucion_facturacion FROM tbl15_tipo_resolucion_facturacion WHERE (cod_origen_resolucion_facturacion = '1') AND (cod_estado = '1') ORDER BY cod_tipo_resolucion_facturacion ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($nombre_tipo_resolucion_facturacion) and $nombre_tipo_resolucion_facturacion == $datos2['nombre_tipo_resolucion_facturacion']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['nombre_tipo_resolucion_facturacion'];
					$nombre = $datos2['nombre_tipo_resolucion_facturacion'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<td style="text-align:center"><input class="input-block-level" name="numero_resolucion_facturacion" type="text" value="" required /></td>
			<td style="text-align:center"><input class="input-block-level" name="ini_resolucion_facturacion" type="text" value="" required /></td>
			<td style="text-align:center"><input class="input-block-level" name="fin_resolucion_facturacion" type="text" value="" required /></td>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">PREFIJO DE NUMERACION</th>
			<th style="text-align:center">FECHA DE RESOLUCION</th>
			<th style="text-align:center">VIGENICA RESOLUCION (MESES)</th>
			<th style="text-align:center">ESTADO</th>
		</tr>
    	<tr>
			<td style="text-align:center"><input class="input-block-level" name="prefijo_resolucion_facturacion" type="text" value="" required /></td>
			<td style="text-align:center"><input class="input-block-level" name="fecha_resolucion_facturacion" type="date" value="" required /></td>
			<td style="text-align:center"><input class="input-block-level" name="vigencia_meses_resolucion_facturacion" type="number" min="1" value="0" /></td>
			<td style="text-align:center">
				<select name="nombre_tipo_estado" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
					<?php if (isset($nombre_tipo_estado)) { echo "";
					} else { echo  ""; }
					$consulta2_sql = ("SELECT cod_tipo_estado, nombre_tipo_estado FROM tbl15_tipo_estado ORDER BY cod_tipo_estado ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($nombre_tipo_estado) and $nombre_tipo_estado == $datos2['nombre_tipo_estado']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['nombre_tipo_estado'];
					$nombre = $datos2['nombre_tipo_estado'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
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
<script language="javascript">
$(document).ready(function(){
    $("#cod_origen_resolucion_facturacion").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_origen_resolucion_facturacion";
        var tipo_ajax = "tbl15_origen_resolucion_facturacion";
        var id = "0";
        var pagina_local = "<?php echo $pagina; ?>";

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id;

        $.ajax({
            type: "POST",
            url: "../admin/recargar_consulta_tipo_resolucion_facturacion_select_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
            	$("#nombre_tipo_resolucion_facturacion_select").html(respuesta);
            }
        });

   });
});
</script>
</body>
</html>