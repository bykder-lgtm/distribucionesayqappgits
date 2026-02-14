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
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
if ((isset($_POST["ins_edit"])) && ($_POST["ins_edit"] == "formulario_insert_edit")) {

	$cod_inmueble                   = intval($_POST['cod_inmueble']);

	if (isset($_POST['cod_inmueble_barra']) <> '') { $cod_inmueble_barra = mysqli_real_escape_string($conectar, addslashes(($_POST['cod_inmueble_barra']))); } else { $cod_inmueble_barra = ''; }
	if (isset($_POST['nombre_inmueble']) <> '') { $nombre_inmueble = mysqli_real_escape_string($conectar, addslashes(($_POST['nombre_inmueble']))); } else { $nombre_inmueble = ''; }
	if (isset($_POST['descripcion_inmueble']) <> '') { $descripcion_inmueble = mysqli_real_escape_string($conectar, addslashes(($_POST['descripcion_inmueble']))); } else { $descripcion_inmueble = ''; }
	if (isset($_POST['direccion_inmueble']) <> '') { $direccion_inmueble = mysqli_real_escape_string($conectar, addslashes(($_POST['direccion_inmueble']))); } else { $direccion_inmueble = ''; }
	if (isset($_POST['precio_alquiler_inmueble']) <> '') { $precio_alquiler_inmueble = intval($_POST['precio_alquiler_inmueble']); } else { $precio_alquiler_inmueble = ''; }
	if (isset($_POST['latitud_inmueble']) <> '') { $latitud_inmueble = mysqli_real_escape_string($conectar, ($_POST['latitud_inmueble'])); } else { $latitud_inmueble = ''; }
	if (isset($_POST['longitud_inmueble']) <> '') { $longitud_inmueble = mysqli_real_escape_string($conectar, addslashes(($_POST['longitud_inmueble']))); } else { $longitud_inmueble = ''; }
	if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = intval($_POST['cod_tercero']); } else { $cod_tercero = ''; }
	if (isset($_POST['cod_tipo_inmueble']) <> '') { $cod_tipo_inmueble = intval($_POST['cod_tipo_inmueble']); } else { $cod_tipo_inmueble = ''; }
	if (isset($_POST['cod_estado_inmueble']) <> '') { $cod_estado_inmueble = intval($_POST['cod_estado_inmueble']); } else { $cod_estado_inmueble = '1'; }

	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	if (isset($_FILES['archivo_adjunto']) <> '') { $archivo_adjunto = $_FILES['archivo_adjunto']['name']; } else { $archivo_adjunto = ''; }

$sql_data = sprintf("UPDATE tbl15_inmueble SET cod_inmueble_barra = '$cod_inmueble_barra', nombre_inmueble = '$nombre_inmueble', descripcion_inmueble = '$descripcion_inmueble', 
direccion_inmueble = '$direccion_inmueble', precio_alquiler_inmueble = '$precio_alquiler_inmueble', latitud_inmueble = '$latitud_inmueble', 
longitud_inmueble = '$longitud_inmueble', cod_tercero = '$cod_tercero', cod_tipo_inmueble = '$cod_tipo_inmueble', 
cod_estado_inmueble = '$cod_estado_inmueble' WHERE cod_inmueble = '$cod_inmueble'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$pagina                       = addslashes($_POST['pagina']);
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_inmueble.php">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_inmueble.php">
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