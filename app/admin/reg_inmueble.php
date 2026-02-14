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
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs">
<!--<a class="btn btn-info" href="../admin/menu_lista.php">Lista de Productos</a>-->
<a class="btn btn-success" href="#">Registrar Inmueble</a>
<?php if ($cod_estado_prod_inventario_producto == '1') { ?><a class="btn btn-primary" href="../admin/lista_producto.php">Lista de Inmuebles</a><?php } ?>
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

$mostrar_datos_sql = "SELECT cod_inmueble_barra FROM tbl15_inmueble ORDER BY LPAD(lower(cod_inmueble_barra), 20,0) DESC LIMIT 0,1";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_inmueble_barra        = $matriz_consulta['cod_inmueble_barra'] + 1;
$nombre_tipo_tercero       = 'PROPIETARIO';
?>
<?php if ($cod_estado_prod_reg_producto == '1') { ?>
<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_inmueble_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center" id="mensaje_verificacion_inmueble">.</th>
    	</tr>
	</thead>
</table>
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
				<select name="cod_tipo_inmueble" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 100px;">
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
			<td style="text-align:center"><input class="input-block-level" name="nombre_inmueble" type="text" value="" size="100" required/></td>
			<th style="text-align:center"><textarea class="input-block-level" name="descripcion_inmueble" rows="2" cols="100"></textarea></th>
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
			<td style="text-align:center"><input class="input-block-level" name="direccion_inmueble" type="text" value="" size="30" /></td>
			<td style="text-align:center"><input class="input-block-level" name="precio_alquiler_inmueble" type="number" value="" size="10" step="any"/></td>
			<td style="text-align:left">
    			<select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
					<?php if (isset($cod_tercero)) { echo "<option value='' $seleccionado >Selecione</option>"; } else { echo  "<option value='' $seleccionado >Selecione</option>"; }
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

</fieldset>
</div>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input id="estilo_css" name="estilo_css" type="hidden" value="azul_verdoso.css">
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
    $("#cod_inmueble_barra").on('change', function () {
            var cod_inmueble_barra = $(this).val();
            var campo = "cod_inmueble_barra";
            var tipo_ajax = "tbl15_inmueble";
            $.post("verificar_existencia_inmueble_ajax.php", { cod_inmueble_barra:cod_inmueble_barra, campo:campo, tipo_ajax:tipo_ajax }, function(data){
                $("#mensaje_verificacion_inmueble").html(data);
        });
   });
});
</script>



<?php if ($cod_estado_img_producto_global == '1') { ?>
<script language="JavaScript">
window.URL = window.URL || window.webkitURL;

var archivo_selecionado = document.getElementById("archivo_selecionado"),
    url_img1 = document.getElementById("url_img1"),
    vista_archivo = document.getElementById("vista_archivo");

archivo_selecionado.addEventListener("click", function (e) {
  if (url_img1) {
    url_img1.click();
  }
  e.preventDefault(); // prevent navigation to "#"
}, false);

function handleFiles(files) {
  if (!files.length) {
    vista_archivo.innerHTML = "<p>No files selected!</p>";
  } else {
    vista_archivo.innerHTML = "";
    var list = document.createElement("ul");
    vista_archivo.appendChild(list);
    for (var i = 0; i < files.length; i++) {
      var li = document.createElement("li");
      list.appendChild(li);
      
      var img = document.createElement("img");
      img.src = window.URL.createObjectURL(files[i]);
      img.height = 60;
      img.onload = function() {
        window.URL.revokeObjectURL(this.src);
      }
      li.appendChild(img);
      var info = document.createElement("span");
      li.appendChild(info);
    }
  }
}
</script>
<?php } ?>

</body>
</html>