<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor) {
myajax.Link('publicidad_editable_ajax_reg.php?valor='+valor+'&campo='+campo+'&id='+id);
}
}
</script>
</head>
<body onLoad="myajax = new isiAJAX();" id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<!--<div class="breadcrumbs"><h4>Lista Imagenes Producto</h4></a></div>-->
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">

<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_producto.php"><font size='+2'>Lista Imagenes de Publicidad</font></a></th>
    </tr>
</table>

<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_publicidad_imagen_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">IMAGEN</th>
      <th style="text-align:center">NOMBRE</th>
			<th style="text-align:center">DECRIPCION</th>
			<th style="text-align:center">POSICION</th>
      <th style="text-align:center">FECHA</th>
      <th style="text-align:center">ESTADO</th>
			<th style="text-align:center">CAMBIAR IMAG</th>
		</tr>
<?php
$pagina                            = $_SERVER['PHP_SELF'];
$fecha_hoy                         = time();
//main query to fetch the data
$sql_consulta = "SELECT * FROM tbl15_publicidad ORDER BY cod_posicion DESC";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

  $cod_publicidad                   = $datos_consulta['cod_publicidad'];
  $nombre_deporte                   = $datos_consulta['nombre_deporte'];
  $nombre_publicidad                = $datos_consulta['nombre_publicidad'];
  $descripcion_publicidad           = $datos_consulta['descripcion_publicidad'];
  $cod_estado                       = $datos_consulta['cod_estado'];
  $url_imagen                       = $datos_consulta['url_imagen'];
  $url_imagen_min                   = $datos_consulta['url_imagen_min'];
  $alineacion_texto_publicidad      = $datos_consulta['alineacion_texto_publicidad'];
  $fecha_time                       = $datos_consulta['fecha_time'];
  $fecha_dmy                        = $datos_consulta['fecha_dmy'];
  $hora                             = $datos_consulta['hora'];
  $cuenta                           = $datos_consulta['cuenta'];
  $cod_posicion                     = $datos_consulta['cod_posicion'];

  $sql_estado = "SELECT * FROM tbl15_estado WHERE (cod_estado = '$cod_estado')";
  $query_estado = mysqli_query($conectar, $sql_estado);
  $datos_estado = mysqli_fetch_array($query_estado);

  $nombre_estado                     = $datos_estado['nombre_estado'];

  if ($cod_posicion == 1) { $url_img_active = "../imagenes/active.png"; } else { $url_img_active = "../imagenes/inactive.png"; }
?>
		<tr>
			<td style="text-align:center"><img src="<?php echo $url_imagen_min ?>" class="img-polaroid" widht="30px" alt=""></td>
      <td style="text-align:center"><input type="text" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'nombre_publicidad', <?php echo $cod_publicidad;?>)" id="<?php echo $cod_publicidad;?>" value="<?php echo $nombre_publicidad;?>" class="input-block-level" style="width: 250px;"></td>
      <td style="text-align:center"><textarea onFocus="Focus(this.id, this.value)" name="descripcion_publicidad" onBlur="Blur(this.id, this.value, 'descripcion_publicidad', <?php echo $cod_publicidad;?>)" id="<?php echo $cod_publicidad;?>" class="input-block-level" rows="2" cols="50"><?php echo $descripcion_publicidad;?></textarea></td>
			<!--<td style="text-align:center"><?php echo $nombre_publicidad; ?></td>-->
      <!--<td style="text-align:center"><?php echo $fecha_dmy; ?></td>-->
      <td style="text-align:center"><input type="number" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'cod_posicion', <?php echo $cod_publicidad;?>)" id="<?php echo $cod_publicidad;?>" value="<?php echo $cod_posicion;?>" class="input-block-level" style="width: 60px;"></td>

      <td style="text-align:center"><input type="date" onFocus="Focus(this.id, this.value)" onBlur="Blur(this.id, this.value, 'fecha_dmy', <?php echo $cod_publicidad;?>)" id="<?php echo $cod_publicidad;?>" value="<?php echo $fecha_dmy;?>" class="input-block-level" style="width: 130px;"></td>

      <td style="text-align:center">
        <select name="cod_estado" id="cod_estado-<?php echo $cod_publicidad;?>" class="<?php echo $cod_publicidad;?>" style="width: 120px;">
        <?php if (isset($cod_estado)) { echo ""; } else { echo ""; }
        $sql_consulta2 = "SELECT cod_estado, nombre_estado FROM tbl15_estado";
        $consulta2 = mysqli_query($conectar, $sql_consulta2);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_estado) and $cod_estado == $datos2['cod_estado']) {
        $seleccionado = "selected";
        } else { $seleccionado = ""; }
        $codigo = $datos2['cod_estado'];
        $nombre = $datos2['nombre_estado'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
      </td>

    	<td style="text-align:center"><a href="../admin/edit_publicidad_url_img.php?cod_publicidad=<?php echo $cod_publicidad?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
		</tr>
<?php } //end while ?>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_publicidad_imagen_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">CARGAR IMAGEN</th>
		</tr>
		<tr>
			<th style="text-align:center">
			<input type="file" name="url_img1" id="url_img1" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)" required/><a href="#" class="btn btn-default" id="archivo_selecionado">Selecione el archivo</a>
			<div id="vista_archivo">
			</th>
		</tr>
	</thead>
</table>
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
</body>
</html>

<script>  
 $(document).ready(function(){  

  $('select[name="cod_estado"]').change(function(){ 
  var cod_estado = $(this).val();  
  let id = this.id;
    $.ajax({ url:"publicidad_editable_ajax_reg.php", method:"GET", data:{valor:cod_estado, campo:"cod_estado", id:id }, success:function(data){ $('#result').html(data); }  
    });  
  });
 });  
 </script>


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