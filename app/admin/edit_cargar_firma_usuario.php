cargar_foto<?php $serguridad_pagina = 1; ?>
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
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="#"><h4>Firma Usuario</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php 
$cod_administrador = intval($_GET['cod_administrador']);

$sql_foto_cliente = "SELECT * FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$cons_foto_cliente = mysqli_query($conectar, $sql_foto_cliente) or die(mysqli_error($conectar));
$dato_foto_cliente = mysqli_fetch_assoc($cons_foto_cliente);

$cedula = $dato_foto_cliente['cedula'];
$nombres = $dato_foto_cliente['nombres'];
$apellidos = $dato_foto_cliente['apellidos'];
$cuenta = $dato_foto_cliente['cuenta'];
$url_img_firma_prof_min = $dato_foto_cliente['url_img_firma_prof_min'];
$url_img_firma_prof_ori = $dato_foto_cliente['url_img_firma_prof_ori'];
?>
<div class="table-responsive">
<table class="table table-striped">
<div class="col-lg-6">
<label><?php echo $nombres.' '.$apellidos.' - '.$cedula ?></label>
<img src="<?php echo $url_img_firma_prof_min ?>" class="favth-img-polaroid" alt="">
</div>

<br>
<form name="frmSubir" method="post" enctype="multipart/form-data" action="edit_cargar_firma_usuario_reg.php">
<p><input type="file" name="url_img_firma" id="url_img_firma" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)" required="required"/></p>
<input type="hidden" name="cod_administrador" value="<?php echo $cod_administrador ?>"/>

<a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a><div id="vista_archivo"><p><!--No ha selecionado ningun archivo!</p>--></div>
<p><button type="submit" id="archivo_selecionado" name="submit" class="btn btn-primary btn-lg" required="required">Guardar imagen</button></p>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">
</form>
</table>
</div>

<script language="JavaScript">
window.URL = window.URL || window.webkitURL;

var archivo_selecionado = document.getElementById("archivo_selecionado"),
    url_img_firma = document.getElementById("url_img_firma"),
    vista_archivo = document.getElementById("vista_archivo");

archivo_selecionado.addEventListener("click", function (e) {
  if (url_img_firma) {
    url_img_firma.click();
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
      info.innerHTML = files[i].name + ": " + Math.round(files[i].size/1024) + " KB";
      li.appendChild(info);
    }
  }
}
</script>
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