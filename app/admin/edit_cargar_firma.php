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
<?php $pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="#"><h4>Firma Paciente</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php 
$cod_historia_clinica = intval($_GET['cod_historia_clinica']);
//$pagina = addslashes($_GET['pagina']);
$sql_info_historia_clinica = "SELECT cod_historia_clinica, cod_cliente, url_img_firma_min, url_img_firma_orig, url_img_foto_min, url_img_foto_orig 
FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$cons_info_historia_clinica = mysqli_query($conectar, $sql_info_historia_clinica) or die(mysqli_error($conectar));
$dato_info_historia_clinica = mysqli_fetch_assoc($cons_info_historia_clinica);

$cod_cliente = $dato_info_historia_clinica['cod_cliente'];
$url_img_firma_min = $dato_info_historia_clinica['url_img_firma_min'];
$url_img_firma_orig = $dato_info_historia_clinica['url_img_firma_orig'];
$url_img_foto_min = $dato_info_historia_clinica['url_img_foto_min'];
$url_img_foto_orig = $dato_info_historia_clinica['url_img_foto_orig'];

$sql_foto_cliente = "SELECT cod_cliente, cedula, nombres, apellido1, apellido2, url_img_foto, url_img_firma_min, url_img_firma, url_img_foto_min, url_img_foto 
FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
$cons_foto_cliente = mysqli_query($conectar, $sql_foto_cliente) or die(mysqli_error($conectar));
$dato_foto_cliente = mysqli_fetch_assoc($cons_foto_cliente);

$cedula = $dato_foto_cliente['cedula'];
$nombres = $dato_foto_cliente['nombres'];
$apellido1 = $dato_foto_cliente['apellido1'];
$apellido2 = $dato_foto_cliente['apellido2'];
$url_img_firma_min = $dato_foto_cliente['url_img_firma_min'];
$url_img_firma = $dato_foto_cliente['url_img_firma'];
?>
<div class="table-responsive">
<table class="table table-striped">
<div class="col-lg-6">
<label><?php echo $nombres.' '.$apellido1.' '.$apellido2.' - '.$cedula ?></label>
<img src="<?php echo $url_img_firma_min ?>" class="favth-img-polaroid" alt="">
</div>

<br>
<form name="frmSubir" method="post" enctype="multipart/form-data" action="edit_cargar_firma_reg.php">
<p>Subir Imagen</p>
<p><input type="file" name="url_img_firma" required="required"/></p>
<input type="hidden" name="cod_historia_clinica" value="<?php echo $cod_historia_clinica ?>"/>
<input type="hidden" name="cod_cliente" value="<?php echo $cod_cliente ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<p><button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Guardar imagen</button></p>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">
</form>
</table>
</div>
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