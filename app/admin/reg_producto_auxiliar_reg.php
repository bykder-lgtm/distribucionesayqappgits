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

	if (isset($_POST['cod_producto_barra']) <> '') { $cod_producto_barra = mysqli_real_escape_string($conectar, strip_tags($_POST['cod_producto_barra'])); } else { $cod_producto_barra = ''; }
	if (isset($_POST['nombre_producto']) <> '') { $nombre_producto = mysqli_real_escape_string($conectar, strip_tags($_POST['nombre_producto'])); } else { $nombre_producto = ''; }
	if (isset($_POST['precio_compra_producto']) <> '') { $precio_compra_producto = mysqli_real_escape_string($conectar, strip_tags($_POST['precio_compra_producto'])); } else { $precio_compra_producto = ''; }
	if (isset($_POST['precio_venta_producto']) <> '') { $precio_venta_producto = mysqli_real_escape_string($conectar, strip_tags($_POST['precio_venta_producto'])); } else { $precio_venta_producto = ''; }
	if (isset($_POST['iva_ptj']) <> '') { $iva_ptj = mysqli_real_escape_string($conectar, strip_tags($_POST['iva_ptj'])); } else { $iva_ptj = ''; }
	if (isset($_POST['nombre_tipo_unidad_medida']) <> '') { $nombre_tipo_unidad_medida = mysqli_real_escape_string($conectar, strip_tags($_POST['nombre_tipo_unidad_medida'])); } else { $nombre_tipo_unidad_medida = ''; }
	if (isset($_POST['nombre_tipo_producto']) <> '') { $nombre_tipo_producto = mysqli_real_escape_string($conectar, strip_tags($_POST['nombre_tipo_producto'])); } else { $nombre_tipo_producto = ''; }
	if (isset($_POST['nombre_tipo_precio_venta']) <> '') { $nombre_tipo_precio_venta = mysqli_real_escape_string($conectar, strip_tags($_POST['nombre_tipo_precio_venta'])); } else { $nombre_tipo_precio_venta = ''; }
	if (isset($_POST['cod_dependencia']) <> '') { $cod_dependencia = mysqli_real_escape_string($conectar, strip_tags($_POST['cod_dependencia'])); } else { $cod_dependencia = ''; }
	$cod_estado = 1;

	$agreg = "INSERT INTO tbl15_producto_auxiliar (cod_producto_barra, nombre_producto, precio_compra_producto, precio_venta_producto, iva_ptj, nombre_tipo_unidad_medida, nombre_tipo_producto, nombre_tipo_precio_venta, cod_dependencia, cod_estado) 
	VALUES ('$cod_producto_barra', '$nombre_producto', '$precio_compra_producto', '$precio_venta_producto', '$iva_ptj', '$nombre_tipo_unidad_medida', '$nombre_tipo_producto', '$nombre_tipo_precio_venta', '$cod_dependencia', '$cod_estado')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_producto_auxiliar.php">
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