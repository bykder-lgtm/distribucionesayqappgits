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
if (isset($_GET["cod_producto_imagen"])) {

$cod_producto_imagen             = intval($_GET['cod_producto_imagen']);

$mostrar_datos_sql = "SELECT * FROM tbl15_producto_imagen WHERE cod_producto_imagen = '$cod_producto_imagen'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_producto                    = $matriz_consulta['cod_producto'];
$cod_producto_barra              = $matriz_consulta['cod_producto_barra'];
$url_img_orig_producto           = $matriz_consulta['url_img_orig_producto'];
$url_img_min_producto            = $matriz_consulta['url_img_min_producto'];
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_max_imagen = "SELECT MAX(cod_posicion) AS cod_posicion FROM tbl15_producto_imagen WHERE cod_producto_barra = '$cod_producto_barra'";
$consulta_max_imagen = mysqli_query($conectar, $sql_max_imagen) or die(mysqli_error($conectar));
$info_max_imagen = mysqli_fetch_assoc($consulta_max_imagen);

$cod_posicion                       = 1;
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_data = sprintf("UPDATE tbl15_producto_imagen SET cod_posicion = '0' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$sql_data = sprintf("UPDATE tbl15_producto_imagen SET cod_posicion = '$cod_posicion' WHERE cod_producto_imagen = '$cod_producto_imagen'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$sql_data = sprintf("UPDATE tbl15_producto SET url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto' WHERE cod_producto = '$cod_producto'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_producto_imagen.php?cod_producto=<?php echo $cod_producto ?>&pagina=<?php echo $pagina_else ?>">
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