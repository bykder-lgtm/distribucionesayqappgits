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
$pagina                                      = addslashes($_POST['pagina']);
$cod_info_producto_copia_inventario          = intval($_POST['cod_info_producto_copia_inventario']);
$fecha_copia_inventario                      = date("Y-m-d");
$hora_copia_inventario                       = date("H:i:s");
$fecha_creacion                              = date("Y-m-d");
$und_producto                                = "0";
$und_producto_bodega                         = "0";
$cod_estado_inventario_a_cero                = "1";
//*************************************************************************************************************************//
if (isset($_POST['si'])) {

$sql_info_factura = "SELECT cod_producto_barra FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_producto_barra                          = $info_info_factura['cod_producto_barra'];

$sql_data = "UPDATE tbl15_producto SET und_producto = '$und_producto', und_producto_bodega = '$und_producto_bodega' WHERE (cod_producto_barra = '$cod_producto_barra')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$sql_data = "UPDATE tbl15_info_producto_copia_inventario SET cod_estado_inventario_a_cero = '$cod_estado_inventario_a_cero' WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; lista_info_producto_copia_inventario.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>">
<?php } else { ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
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