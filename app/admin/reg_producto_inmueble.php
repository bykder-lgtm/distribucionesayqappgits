<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="../js/jquery.min.js" type="text/javascript"></script> 
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
<!--<a class="btn btn-info" href="../admin/menu_lista.php">Lista de Inmuebles</a>-->
<a class="btn btn-success" href="#">Registrar Inmueble</a>
<?php if ($cod_estado_prod_inventario_producto == '1') { ?><a class="btn btn-primary" href="../admin/lista_producto_inmueble.php">Lista de Inmuebles</a><?php } ?>
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
//select cod_producto_barra,substring(cod_producto_barra, 1, 2) as bcd, CONVERT(SUBSTRING(cod_producto_barra, 3, 9),UNSIGNED INTEGER) AS num from tbl15_producto order by cod_producto_barra
//$mostrar_datos_sql = "SELECT cod_producto_barra FROM tbl15_producto ORDER BY LPAD(lower(cod_producto_barra ), 10,0) DESC LIMIT 0,1";
$mostrar_datos_sql = "SELECT cod_producto_barra FROM tbl15_producto ORDER BY LPAD(lower(cod_producto_barra), 20,0) DESC LIMIT 0,1";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_producto_barra        = $matriz_consulta['cod_producto_barra'] + 1;
$nombre_tipo_producto      = 'PRODUCTO';
$nombre_tipo_tercero       = 'PROPIETARIO';
?>

<?php if ($cod_estado_prod_reg_producto == '1') { ?>
<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_producto_inmueble_reg.php">
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
      <th style="text-align:center">COD INMUEBLE</th>
			<th style="text-align:center">NOMBRE INMUEBLE</th>
      <th style="text-align:center">PORCENTAJE DE COMISION DEL INMUEBLE</th>
			<th style="text-align:center">TIPO INMUEBLE</th>
		</tr>
    	<tr>
			<td style="text-align:center"><input class="input-block-level" name="cod_producto_barra" id="cod_producto_barra" type="text" value="<?php echo $cod_producto_barra ?>" size="30" required /></td>
			<td style="text-align:center"><input class="input-block-level" name="nombre_producto" type="text" value="" size="120" required /></td>
      <td style="text-align:center"><input class="input-block-level" name="deduccion_comision_ptj_inmueble" type="number" value="" min="0" size="10" required /></td>

			<td style="text-align:center">
				<select name="nombre_tipo_producto" id="nombre_tipo_producto" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" required>
					<?php if (isset($nombre_tipo_producto_predef)) { echo ""; } else { echo ""; }
					$consulta2_sql = ("SELECT cod_tipo_producto, nombre_tipo_producto FROM tbl15_tipo_producto WHERE (cod_estado = '1') ORDER BY cod_tipo_producto ASC");
					$consulta2 = mysqli_query($conectar, $consulta2_sql);
					while ($datos2 = mysqli_fetch_assoc($consulta2)) {
					if(isset($nombre_tipo_producto_predef) and $nombre_tipo_producto_predef == $datos2['nombre_tipo_producto']) {
					$seleccionado = "selected"; } else { $seleccionado = ""; }
					$codigo = $datos2['nombre_tipo_producto'];
					$nombre = $datos2['nombre_tipo_producto'];
					echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>

    	</tr>
	</thead>
</table>

<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">DIRECCIÓN INMUEBLE</th>
			<th style="text-align:center">PRECIO ALQUILER</th>
      <th style="text-align:center">REFERENCIA CATASTRAL</th>
      <th style="text-align:center">NUMERO DE MATRICULA</th>
			<th style="text-align:center">PROPIETARIO INMUEBLE</th>
		</tr>
    	<tr>
			<td style="text-align:center"><input class="input-block-level" name="direccion_inmueble" type="text" value="" size="30" /></td>
			<td style="text-align:center"><input class="input-block-level" name="precio_venta_producto" type="number" value="" size="10" step="any"/ required></td>
      <td style="text-align:center"><input class="input-block-level" name="referencia_catastral_inmueble" type="text" value=""/></td>
      <td style="text-align:center"><input class="input-block-level" name="numero_matricula_inmueble" type="text" value=""/></td>
			<td style="text-align:left">
    			<select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
					<?php if (isset($cod_tercero)) { echo "<option value='' $seleccionado >Selecione</option>"; } else { echo "<option value='' $seleccionado >Selecione</option>"; }
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
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<input class="input-block-level" name="nombre_tipo_unidad_medida" type="hidden" value="UND" size="120" required />
<input class="input-block-level" name="cod_opcion_descontable_inv" type="hidden" value="1" size="120" required />
<input class="input-block-level" name="nombre_tipo_precio_venta" type="hidden" value="PVAR" size="120" required />
<input class="input-block-level" name="precio_compra_producto" type="hidden" value="0" size="120" required />
<input class="input-block-level" name="cod_dependencia" type="hidden" value="1" size="120" required />

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    	<tr>
			<?php if ($cod_estado_img_producto_global == '1') { ?>
			<th style="text-align:center">IMAGEN</th>
			<?php } ?>

			<?php if ($cod_estado_archivo_adjunto_global == '1') { ?>
			<th style="text-align:center">NOMBRE Y ARCHIVO 1</th>
      <th style="text-align:center">NOMBRE Y ARCHIVO 2</th>
      <th style="text-align:center">NOMBRE Y ARCHIVO 3 </th>
			<?php } ?>
		</tr>
    	<tr>
			<?php if ($cod_estado_img_producto_global == '1') { ?>
			<th style="text-align:center">
			<input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)"/><a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a>
			<div id="vista_archivo">
			</th>
			<?php } ?>

			<?php if ($cod_estado_archivo_adjunto_global == '1') { ?>
    		<td style="text-align:center;"><input class="form-control" name="descripcion_archivo_adjunto" type="text" value=""/><input type="hidden" name="archivo_adjunto" id="archivo_adjunto"></td>
        <td style="text-align:center;"><input class="form-control" name="descripcion_archivo_adjunto2" type="text" value=""/><input type="hidden" name="archivo_adjunto2" id="archivo_adjunto2"></td>
        <td style="text-align:center;"><input class="form-control" name="descripcion_archivo_adjunto3" type="text" value=""/><input type="hidden" name="archivo_adjunto3" id="archivo_adjunto3"></td>

			<?php } ?>			
		</tr>
	</thead>
</table>

<table border="1" class="table table-responsive">
    <tr>
      <th style="text-align:center">DESCRIPCIÓN INMUEBLE</th>
    </tr>
    <tr>
      <td style="text-align:center"><textarea class="input-block-level" name="descripcion_producto" rows="2" cols="100"></textarea></td>
    </tr>
  </thead>
</table>
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="js/jquery-ui.js"></script>

<?php if ($cod_estado_ganancia_ptj_global  == '1') { ?>
<script language="javascript">
$(document).ready(function(){
    $("#ganancia_ptj").on('change', function () {
            //var precio_compra_producto = $("#precio_compra_producto").val();
            //var ganancia_ptj = $(this).val();
            var ganancia_ptj = 0;
            var precio_compra_producto = 0;
            ganancia_ptj = document.getElementById("ganancia_ptj").value;
            precio_compra_producto = document.getElementById("precio_compra_producto").value;

            if (precio_compra_producto == '') { precio_compra_producto = 0 };
            if (ganancia_ptj == '') { ganancia_ptj = 0 };

            var precio_venta_producto = parseInt(precio_compra_producto) + parseInt(precio_compra_producto * (ganancia_ptj/100));
            document.getElementById("precio_venta_producto").value = precio_venta_producto;

            console.log(precio_venta_producto);
   });
});
</script>


<script language="javascript">
$(document).ready(function(){
    $("#precio_compra_producto").on('change', function () {
            //var ganancia_ptj = $("#ganancia_ptj").val();
            //var precio_compra_producto = $(this).val();
            var ganancia_ptj = 0;
            var precio_compra_producto = 0;
            ganancia_ptj = document.getElementById("ganancia_ptj").value;
            precio_compra_producto = document.getElementById("precio_compra_producto").value;
            
            if (precio_compra_producto == '') { precio_compra_producto = 0 };
            if (ganancia_ptj == '') { ganancia_ptj = 0 };

            var precio_venta_producto = parseInt(precio_compra_producto) + parseInt(precio_compra_producto * (ganancia_ptj/100));
            document.getElementById("precio_venta_producto").value = precio_venta_producto;

            console.log(precio_venta_producto);
   });
});
</script>
<?php } ?>
<!--
<script type="text/javascript">
function agregarFila(){

var tabla_subproductos = document.getElementById("tabla_subproductos");
var numero_reg = tabla_subproductos.rows.length;
console.log("numero_reg - "+numero_reg);

  document.getElementById("tabla_subproductos").insertRow(-1).innerHTML = ''
  +
  '<td style="text-align:center"><input type="text" name="cod_producto_barra_sub" id="cod_producto_barra_sub" class="cod_producto_barra_sub__'+numero_reg+'" value="" size="10"/></td>'
  +
  '<td style="text-align:center"><input type="text" name="nombre_producto_sub" id="nombre_producto_sub" class="nombre_producto_sub__'+numero_reg+'" value="" size="50"/></td>'
  +
  '<td style="text-align:center"><input type="text" name="und_producto_sub" id="und_producto_sub" class="und_producto_sub__'+numero_reg+'" value="" size="5"/></td>'
  +
  '<td style="text-align:center"><input type="text" name="nombre_tipo_unidad_medida_sub" id="nombre_tipo_unidad_medida_sub" class="nombre_tipo_unidad_medida_sub__'+numero_reg+'" value="" size="5"/></td>'
  ;
}
	
function eliminarFila(){
  var tabla_subproductos = document.getElementById("tabla_subproductos");
  var cantidad_subproductos = tabla_subproductos.rows.length;
  //console.log(cantidad_subproductos);
  
  if(cantidad_subproductos <= 1)
    alert('No se puede eliminar el encabezado');
  else
    tabla_subproductos.deleteRow(cantidad_subproductos -1);
}
</script>
-->
<script language="javascript">
$(document).ready(function(){

var nombre_tipo_producto = $("#nombre_tipo_producto").val();

if (nombre_tipo_producto=='ANIMAL') {
document.getElementById("ganadero").style.display = "block";
} else {
document.getElementById("ganadero").style.display = "none";
}

$("#nombre_tipo_producto").on('change', function () {
var nombre_tipo_producto = $("#nombre_tipo_producto").val();

if (nombre_tipo_producto=='ANIMAL') {
document.getElementById("ganadero").style.display = "block";
} else {
document.getElementById("ganadero").style.display = "none";
}
});

});
</script>


<script language="javascript">
$(document).ready(function(){
    $("#cod_producto_barra").on('change', function () {
            var cod_producto_barra = $(this).val();
            var campo = "cod_producto_barra";
            var tipo_ajax = "tbl15_producto";
            $.post("verificar_existencia_producto_ajax.php", { cod_producto_barra:cod_producto_barra, campo:campo, tipo_ajax:tipo_ajax }, function(data){
                $("#mensaje_verificacion_producto").html(data);
        });
   });
});
</script>


<script>
$(document).ready(function() {
    $("#select_nombre_categoria").change(function(){
        var valor = $("#select_nombre_categoria").val();
        var campo = 'nombre_categoria';
        var tipo_ajax = 'nombre_categoria';
            
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "../admin/recargar_categoria_sub_select_dependiente_ajax.php",
            data: "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax,
            success: function(resp){
                $('#select_nombre_categoria_sub').html(resp);
            }
        });
    });
});
</script>

<script type="text/javascript">
$('#id_padre').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'MACHO';
var nombre_tipo_producto = 'ANIMAL';

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_cod_producto_barra_ajax.php?nombre_campo="+nombre_campo+"&nombre_sexo="+nombre_sexo+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.cod_producto_barra);
}
});
});

});
</script>


<script type="text/javascript">
$('#id_madre').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'HEMBRA';
var nombre_tipo_producto = 'ANIMAL';

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_cod_producto_barra_ajax.php?nombre_campo="+nombre_campo+"&nombre_sexo="+nombre_sexo+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.cod_producto_barra);
}
});
});

});
</script>

<script type="text/javascript">
$('#id_abuelo_paterno').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'MACHO';
var nombre_tipo_producto = 'ANIMAL';

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_cod_producto_barra_ajax.php?nombre_campo="+nombre_campo+"&nombre_sexo="+nombre_sexo+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.cod_producto_barra);
}
});
});

});
</script>

<script type="text/javascript">
$('#id_abuelo_materno').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'MACHO';
var nombre_tipo_producto = 'ANIMAL';

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_cod_producto_barra_ajax.php?nombre_campo="+nombre_campo+"&nombre_sexo="+nombre_sexo+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.cod_producto_barra);
}
});
});

});
</script>

<script type="text/javascript">
$('#id_abuela_paterno').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'HEMBRA';
var nombre_tipo_producto = 'ANIMAL';

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_cod_producto_barra_ajax.php?nombre_campo="+nombre_campo+"&nombre_sexo="+nombre_sexo+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.cod_producto_barra);
}
});
});

});
</script>


<script type="text/javascript">
$('#id_abuela_materno').on('keypress',function(){
var nombre_campo = $(this).attr("name");
var nombre_sexo = 'HEMBRA';
var nombre_tipo_producto = 'ANIMAL';

$(function() {
$("#"+nombre_campo).autocomplete({
source: "autocompletar_cod_producto_barra_ajax.php?nombre_campo="+nombre_campo+"&nombre_sexo="+nombre_sexo+"&nombre_tipo_producto="+nombre_tipo_producto+"",
minLength: 1,
select: function(event, ui) {
event.preventDefault();
$('#'+nombre_campo).val(ui.item.cod_producto_barra);
}
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


<script src="ckeditor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/ckfinder/ckfinder.js" type="text/javascript"></script>

<script type="text/javascript">
window.onload = function() {
    descripcion_producto = CKEDITOR.replace("descripcion_producto");
    CKFinder.setupCKEditor(descripcion_producto, 'ckeditor/ckfinder');
}
</script>

</body>
</html>