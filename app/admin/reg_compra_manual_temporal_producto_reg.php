<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
if (isset($_GET['nombre_tipo_cargue_factura'])) {

$nombre_tipo_cargue_factura         = addslashes($_GET['nombre_tipo_cargue_factura']);
$foco                               = 'busqueda';
$buscar_por                         = $nombre_buscar_por;
$nombre_tipo_moneda	                = "COP";
$nombre_tipo_factura                = "POS";
$cod_estado_vacuna                  = "0";

$cuenta                             = $cuenta_actual;
$cod_estado_factura                 = '1';
$descuento_ptj                      = '0';
$flete_ptj                          = '0';
$vlr_cancelado                      = '';
$vlr_vuelto                         = '';
$fecha_dia                          = strtotime(date("Y/m/d"));
$fecha_mes                          = date("Y-m");
$fecha_anyo                         = date("Y-m-d");
$anyo                               = date("Y");
$fecha_hora                         = date("H:i:s");
$fecha_remision                     = date("Y-m-d");
$nombre_ccosto                      = '';
$garantia_meses                     = '';
$observacion                        = '';
$cod_tipo_pago                      = '1';
$cod_empresa                        = '0';
$fecha_ymdhis                       = date("Y-m-d H:is");
$cod_tipo_cobrar                    = '1';
$cod_tercero                        = '1';
$nombre_estado_factura              = 'ABIERTA';
$nombre_tipo_compra                 = 'NORMAL';
$cod_tipo_producto_consumo          = '1';
$cod_tipo_forma_pago                = "1";
$und_venta                          = "1";
$cod_tipo_inventario                = "1";
$cod_dependencia                    = "1";
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_compra'";
$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

$cod_info_factura_compra            = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_animal = "SELECT MAX(cod_caja_virtual) AS cod_caja_virtual, MAX(cod_base_caja) AS cod_base_caja FROM tbl15_info_factura_compra";
$resultado_animal = mysqli_query($conectar, $sql_animal);
$info_animal = mysqli_fetch_assoc($resultado_animal);

$cod_caja_virtual                   = $info_animal['cod_caja_virtual'] + 1;
$cod_base_caja                      = $info_animal['cod_base_caja'] + 1;
$_SESSION['cod_base_caja']          = $cod_base_caja;
$_SESSION['cod_caja_virtual']       = $cod_caja_virtual;
//---------------------------------------------------------------------------------------------------------------------------------------------//
$pagina                             = addslashes($_GET['pagina'])."?&cuenta=".$cuenta."&cod_caja_virtual=".$cod_caja_virtual."&cod_info_factura_compra=".$cod_info_factura_compra;
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = "INSERT INTO tbl15_info_factura_compra (cod_info_factura_compra, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, cod_tipo_forma_pago, 
nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, nombre_tipo_cargue_factura, cod_tipo_inventario, nombre_tipo_compra, 
cod_tipo_producto_consumo) 
VALUES ('$cod_info_factura_compra', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', 
'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$nombre_tipo_cargue_factura', '$cod_tipo_inventario', '$nombre_tipo_compra', 
'$cod_tipo_producto_consumo')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
} 
//---------------------------------------------------------------------------------------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>