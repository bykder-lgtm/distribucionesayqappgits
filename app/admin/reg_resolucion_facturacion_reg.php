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

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina_else = addslashes($_POST['pagina']);

if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	if (isset($_POST['nombre_tipo_resolucion_facturacion']) <> '') { $nombre_tipo_resolucion_facturacion = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_resolucion_facturacion'])); } else { $nombre_tipo_resolucion_facturacion = ''; }
	if (isset($_POST['cod_origen_resolucion_facturacion']) <> '') { $cod_origen_resolucion_facturacion = intval($_POST['cod_origen_resolucion_facturacion']); } else { $cod_origen_resolucion_facturacion = '0'; }
	if (isset($_POST['numero_resolucion_facturacion']) <> '') { $numero_resolucion_facturacion = mysqli_real_escape_string($conectar, ($_POST['numero_resolucion_facturacion'])); } else { $numero_resolucion_facturacion = ''; }
	if (isset($_POST['ini_resolucion_facturacion']) <> '') { $ini_resolucion_facturacion = mysqli_real_escape_string($conectar, ($_POST['ini_resolucion_facturacion'])); } else { $ini_resolucion_facturacion = ''; }
	if (isset($_POST['fin_resolucion_facturacion']) <> '') { $fin_resolucion_facturacion = mysqli_real_escape_string($conectar, ($_POST['fin_resolucion_facturacion'])); } else { $fin_resolucion_facturacion = ''; }
	if (isset($_POST['prefijo_resolucion_facturacion']) <> '') { $prefijo_resolucion_facturacion = mysqli_real_escape_string($conectar, ($_POST['prefijo_resolucion_facturacion'])); } else { $prefijo_resolucion_facturacion = ''; }
	if (isset($_POST['fecha_resolucion_facturacion']) <> '') { $fecha_resolucion_facturacion = mysqli_real_escape_string($conectar, ($_POST['fecha_resolucion_facturacion'])); } else { $fecha_resolucion_facturacion = ''; }
	if (isset($_POST['vigencia_meses_resolucion_facturacion']) <> '') { $vigencia_meses_resolucion_facturacion = mysqli_real_escape_string($conectar, ($_POST['vigencia_meses_resolucion_facturacion'])); } else { $vigencia_meses_resolucion_facturacion = ''; }
	if (isset($_POST['nombre_tipo_estado']) <> '') { $nombre_tipo_estado = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_estado'])); } else { $nombre_tipo_estado = ''; }
	$fecha_vencimiento_resolucion_facturacion = date('Y-m-d', strtotime($fecha_resolucion_facturacion.' + '.$vigencia_meses_resolucion_facturacion.' month'));

	//$obtener_resolucion_facturacion = "SELECT cod_origen_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE nombre_tipo_resolucion_facturacion = '$nombre_tipo_resolucion_facturacion'";
	//$resultado_resolucion_facturacion = mysqli_query($conectar, $obtener_resolucion_facturacion) or die(mysqli_error($conectar));
	//$info_resolucion_facturacion = mysqli_fetch_assoc($resultado_resolucion_facturacion);

	//$cod_origen_resolucion_facturacion                    = $info_resolucion_facturacion['cod_origen_resolucion_facturacion'];

	$obtener_tipo_resolucion_facturacion = "SELECT cod_tipo_resolucion_facturacion FROM tbl15_tipo_resolucion_facturacion WHERE nombre_tipo_resolucion_facturacion = '$nombre_tipo_resolucion_facturacion'";
	$resultado_tipo_resolucion_facturacion = mysqli_query($conectar, $obtener_tipo_resolucion_facturacion) or die(mysqli_error($conectar));
	$info_tipo_resolucion_facturacion = mysqli_fetch_assoc($resultado_tipo_resolucion_facturacion);

	$cod_tipo_resolucion_facturacion                      = $info_tipo_resolucion_facturacion['cod_tipo_resolucion_facturacion'];

	$agreg = "INSERT INTO tbl15_resolucion_facturacion (nombre_tipo_resolucion_facturacion, numero_resolucion_facturacion, ini_resolucion_facturacion, 
	fin_resolucion_facturacion, prefijo_resolucion_facturacion, fecha_resolucion_facturacion, 
	vigencia_meses_resolucion_facturacion, nombre_tipo_estado, fecha_vencimiento_resolucion_facturacion, cod_tipo_resolucion_facturacion, cod_origen_resolucion_facturacion) 
	VALUES ('$nombre_tipo_resolucion_facturacion', '$numero_resolucion_facturacion', '$ini_resolucion_facturacion', 
	'$fin_resolucion_facturacion', '$prefijo_resolucion_facturacion', '$fecha_resolucion_facturacion', 
	'$vigencia_meses_resolucion_facturacion', '$nombre_tipo_estado', '$fecha_vencimiento_resolucion_facturacion', '$cod_tipo_resolucion_facturacion', '$cod_origen_resolucion_facturacion')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_resolucion_facturacion.php">
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