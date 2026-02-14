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
$cod_producto                  = intval($_GET['cod_producto']);
$pagina                        = addslashes($_GET['pagina']);

$mostrar_datos_sql = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_producto_barra           = $matriz_consulta['cod_producto_barra'];
$nombre_producto              = $matriz_consulta['nombre_producto'];
$und_producto                 = $matriz_consulta['und_producto'];
$precio_compra_producto       = $matriz_consulta['precio_compra_producto'];
$precio_costo_producto        = $matriz_consulta['precio_costo_producto'];
$precio_venta_producto        = $matriz_consulta['precio_venta_producto'];
$nombre_tipo_producto         = $matriz_consulta['nombre_tipo_producto'];
$nombre_tipo_unidad_medida    = $matriz_consulta['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion     = $matriz_consulta['nombre_tipo_presentacion'];
$nombre_tipo_precio_venta     = $matriz_consulta['nombre_tipo_precio_venta'];
$tope_min                     = $matriz_consulta['tope_min'];
$iva_ptj                      = $matriz_consulta['iva_ptj'];
$fecha_vencimiento1           = $matriz_consulta['fecha_vencimiento1'];
$vencimiento_lote1            = $matriz_consulta['vencimiento_lote1'];
$comision_ptj                 = $matriz_consulta['comision_ptj'];
$cod_dependencia              = $matriz_consulta['cod_dependencia'];
$url_img_orig_producto        = $matriz_consulta['url_img_orig_producto'];
$url_img_min_producto         = $matriz_consulta['url_img_min_producto'];
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
        <th style="text-align:left"><a href="../admin/lista_producto.php"><font size='+2'>Lista Imagenes de Producto</font></a></th>
    </tr>
</table>

<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_producto_imagen_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center"><?php echo $cod_producto_barra ?></th>
		</tr>
		<tr>
			<th style="text-align:center"><?php echo $nombre_producto ?></th>
		</tr>
	</thead>
</table>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">PRINC</th>
			<th style="text-align:center">IMAGEN</th>
			<th style="text-align:center">FECHA</th>
			<th style="text-align:center">POSICION</th>
			<th style="text-align:center">CAMBIAR</th>
		</tr>
<?php
$fecha_hoy = time();
//main query to fetch the data
$sql_consulta = "SELECT * FROM tbl15_producto_imagen WHERE (cod_producto = '$cod_producto') ORDER BY fecha_ymd";
$query_consulta = mysqli_query($conectar, $sql_consulta);
while ($datos_consulta = mysqli_fetch_array($query_consulta)) {

    $cod_producto_imagen       = $datos_consulta['cod_producto_imagen'];
    $cod_producto              = $datos_consulta['cod_producto'];
    $cod_producto_barra        = $datos_consulta['cod_producto_barra'];
    $nombre_producto           = $datos_consulta['nombre_producto'];
    $fecha_ymd                 = $datos_consulta['fecha_ymd'];
    $cod_posicion              = $datos_consulta['cod_posicion'];
    $url_img_orig_producto     = $datos_consulta['url_img_orig_producto'];
    $url_img_min_producto      = $datos_consulta['url_img_min_producto'];
    $cod_posicion              = $datos_consulta['cod_posicion'];

    if ($url_img_orig_producto == '') { $url_img_min_producto = '../imagenes/img_disponible.png'; } else { $url_img_min_producto = $url_img_min_producto; }
	if ($cod_posicion == 1) { $url_img_active = "../imagenes/active.png"; } else { $url_img_active = "../imagenes/inactive.png"; }
?>
		<tr>
    		<td style="text-align:center"><a href="../admin/imagen_principal_producto_url_img_reg.php?cod_producto_imagen=<?php echo $cod_producto_imagen?>&pagina=<?php echo $pagina ?>"><img src="<?php echo $url_img_active ?>" class="img-polaroid" alt=""></a></td>
			<td style="text-align:center"><img src="<?php echo $url_img_min_producto ?>" class="img-polaroid" widht="30px" alt=""></td>
			<td style="text-align:center"><?php echo $fecha_ymd; ?></td>
			<td style="text-align:center"><?php echo $cod_posicion; ?></td>
    		<td style="text-align:center"><a href="../admin/edit_producto_url_img.php?cod_producto_imagen=<?php echo $cod_producto_imagen?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
		</tr>
<?php } //end while ?>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_producto_imagen_reg.php">
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
<input type="hidden" name="cod_producto" value="<?php echo $cod_producto ?>">
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