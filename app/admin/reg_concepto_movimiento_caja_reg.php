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

	if (isset($_POST['nombre_concepto_movimiento_caja']) <> '') { $nombre_concepto_movimiento_caja = mysqli_real_escape_string($conectar, strip_tags($_POST['nombre_concepto_movimiento_caja'])); } else { $nombre_concepto_movimiento_caja = ''; }
	if (isset($_POST['nombre_tipo_puc']) <> '') { $nombre_tipo_puc = mysqli_real_escape_string($conectar, strip_tags($_POST['nombre_tipo_puc'])); } else { $nombre_tipo_puc = ''; }
	if (isset($_POST['cod_puc']) <> '') { $cod_puc = mysqli_real_escape_string($conectar, strip_tags($_POST['cod_puc'])); } else { $cod_puc = ''; }

	$sql_tipo_puc = "SELECT simbolo_tipo_operacion FROM tbl15_tipo_puc WHERE (nombre_tipo_puc = '$nombre_tipo_puc')";
	$resultado_tipo_puc = mysqli_query($conectar, $sql_tipo_puc) or die(mysqli_error($conectar));
	$info_tipo_puc = mysqli_fetch_assoc($resultado_tipo_puc);

	$simbolo_tipo_operacion         = $info_tipo_puc['simbolo_tipo_operacion'];

	$sql_puc = "SELECT codigo_puc, nombre_puc, tipo_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	$resultado_puc = mysqli_query($conectar, $sql_puc) or die(mysqli_error($conectar));
	$info_puc = mysqli_fetch_assoc($resultado_puc);

	$codigo_puc                     = $info_puc['codigo_puc'];
	$nombre_puc                     = $info_puc['nombre_puc'];
	$tipo_puc                       = $info_puc['tipo_puc'];
	$cod_estado                     = 1;

	$agreg = "INSERT INTO tbl15_concepto_movimiento_caja (nombre_concepto_movimiento_caja, nombre_tipo_puc, simbolo_tipo_operacion, cod_puc, codigo_puc, nombre_puc, tipo_puc, cod_estado) 
	VALUES ('$nombre_concepto_movimiento_caja', '$nombre_tipo_puc', '$simbolo_tipo_operacion', '$cod_puc' '$codigo_puc', '$nombre_puc', '$tipo_puc', '$cod_estado')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_movimiento_contable_cuenta_personal.php">
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