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
<?php
if (isset($_GET["cod_publicidad"])) {

$cod_publicidad             = intval($_GET['cod_publicidad']);
$pagina                          = addslashes($_GET['pagina']);

$mostrar_datos_sql = "SELECT * FROM tbl15_publicidad WHERE cod_publicidad = '$cod_publicidad'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_publicidad                   = $matriz_consulta['cod_publicidad'];
$nombre_deporte                   = $matriz_consulta['nombre_deporte'];
$nombre_publicidad                = $matriz_consulta['nombre_publicidad'];
$descripcion_publicidad           = $matriz_consulta['descripcion_publicidad'];
$cod_estado                       = $matriz_consulta['cod_estado'];
$url_imagen                       = $matriz_consulta['url_imagen'];
$url_imagen_min                   = $matriz_consulta['url_imagen_min'];
$alineacion_texto_publicidad      = $matriz_consulta['alineacion_texto_publicidad'];
$fecha_time                       = $matriz_consulta['fecha_time'];
$fecha_dmy                        = $matriz_consulta['fecha_dmy'];
$hora                             = $matriz_consulta['hora'];
$cuenta                           = $matriz_consulta['cuenta'];
$cod_posicion                     = $matriz_consulta['cod_posicion'];
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<!--<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Lista Imagenes Producto</h4></a></div>-->
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">

<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><font size='+2'>Cambiar Imagenes de Producto</font></a></th>
    </tr>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center"><?php echo $cod_publicidad ?></th>
		</tr>
		<tr>
			<th style="text-align:center"><?php echo $nombre_publicidad ?></th>
		</tr>
	</thead>
</table>

<table border="1" class="table table-responsive">
	<thead>
		<tr>
		  <th style="text-align:center"><img src="<?php echo $url_imagen ?>" width="50%" class="img-rounded" /></th>
		</tr>
	</thead>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/edit_publicidad_url_img_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">CAMBIAR IMAGEN</th>
		</tr>
		<tr>
			<th style="text-align:center">
			<input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)" required/><a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a>
			<div id="vista_archivo">
			</th>
		</tr>
	</thead>
</table>
<input type="hidden" name="cod_publicidad" value="<?php echo $cod_publicidad ?>">
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
</body>
</html>


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