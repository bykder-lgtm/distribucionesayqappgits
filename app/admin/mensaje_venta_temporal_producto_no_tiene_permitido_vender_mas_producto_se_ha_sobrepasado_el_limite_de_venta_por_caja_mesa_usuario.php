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
<!--
<div class="breadcrumbs">
<a href="#"><h4></a>
</div>
-->
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
//$cod_info_factura_venta               = intval($_GET['cod_info_factura_venta']);
$foco                                 = addslashes($_GET['foco']);
$buscar_por                           = addslashes($_GET['buscar_por']);
$cuenta                               = addslashes($_GET['cuenta']);
$cod_caja_virtual                     = addslashes($_GET['cod_caja_virtual']);
$modo_venta_por_defecto               = addslashes($_GET['modo_venta_por_defecto']);
$pagina_get                           = addslashes($_GET['pagina']);
$cod_producto_barra_get               = addslashes($_GET['cod_producto_barra_get']);
$pagina_local                         = $_SERVER['PHP_SELF'];
$paginar_edirect                      = $pagina_get."?&foco=".$foco."&buscar_por=".$buscar_por."&cuenta=".$cuenta."&cod_caja_virtual=".$cod_caja_virtual."&modo_venta_por_defecto=".$modo_venta_por_defecto."&pagina=".$pagina_get;
//---------------------------------------------------------------------------------------------------------------------------------------------//
if (($cod_estado_cod_barra2_global == '1') && ($buscar_por == 'cod_producto_barra')) {
    $campo_busqueda = "(cod_producto_barra = '".$cod_producto_barra_get."') OR (cod_producto_barra2 = '".$cod_producto_barra_get."')";
} elseif (($cod_estado_cod_barra2_global == '1') && ($buscar_por == 'cod_producto_barra2')) {
    $campo_busqueda = "(cod_producto_barra = '".$cod_producto_barra_get."') OR (cod_producto_barra2 = '".$cod_producto_barra_get."')";
} else {
    $campo_busqueda = "(cod_producto_barra = '".$cod_producto_barra_get."')";
}
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto FROM tbl15_producto WHERE $campo_busqueda";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$existe_producto = mysqli_num_rows($consulta_producto);
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$cod_producto                       = $datos_producto['cod_producto'];
$cod_producto_barra                 = $datos_producto['cod_producto_barra'];
$nombre_producto                    = $datos_producto['nombre_producto'];
?>
<div class="table-responsive">
    <table class="table table-striped">
        <tr>
            <th style="text-align:center"><a href="<?php echo $paginar_edirect?>"><h3>Regresar</h3></a></th>
        </tr>
        <tr>
            <th style="text-align:center">
                <h4>
                    <img src=../imagenes/advertencia.gif alt='Advertencia'>
                    ESTA <?php echo $nombre_concepto_multi_virtual ?> NO TIENE PERMITIDO VENDER MAS DE <?php echo number_format($limite_max_venta_temp_por_caja_mesa_usuario, 0, ",", ".") ?> PESOS
                    <img src=../imagenes/advertencia.gif alt='Advertencia'>
                </h4>
            </th>
        </tr>
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