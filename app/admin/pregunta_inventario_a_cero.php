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
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6></h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if (isset($_GET['pagina'])) {
$pagina                                        = $_GET['pagina'];
$cod_info_producto_copia_inventario            = intval($_GET['cod_info_producto_copia_inventario']);

$sql_info_factura = "SELECT * FROM tbl15_info_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

$cod_factura                                 = $info_info_factura['cod_factura'];
$total_reg                                   = $info_info_factura['total_reg'];
$fecha_copia_inventario                      = $info_info_factura['fecha_copia_inventario'];
$hora_copia_inventario                       = $info_info_factura['hora_copia_inventario'];
$cod_administrador                           = $info_info_factura['cod_administrador'];
$fecha_creacion                              = $info_info_factura['fecha_creacion'];
$fecha_modificacion                          = $info_info_factura['fecha_modificacion'];
$nombre_tipo_inventario                      = $info_info_factura['nombre_tipo_inventario'];
$nombre_letra_alfabeto                       = $info_info_factura['nombre_letra_alfabeto'];
$cod_estado_inventario_a_cero                = $info_info_factura['cod_estado_inventario_a_cero'];
$cod_dependencia                             = $info_info_factura['cod_factura'];

if ($cod_dependencia <> '0') {
    $sql_dependencia = "SELECT * FROM tbl15_dependencia  WHERE (cod_dependencia = '$cod_dependencia')";
    $resultado_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
    $info_dependencia = mysqli_fetch_assoc($resultado_dependencia);

    $nombre_dependencia                          = $info_dependencia['nombre_dependencia'];
} else {
    $nombre_dependencia                          = 'TODAS';
} 	 
?>
<form method="post" name="formulario" action="../admin/pregunta_inventario_a_cero_reg.php">
<table class="table table-striped">
    <tr>
        <th style="text-align:center">ESTA SEGURO QUE DESEA LLEVAR LAS UNIDADES DE LOS PRODUCTOS DEL INVENTARIO <?php echo $cod_info_producto_copia_inventario ?> A CERO ?</th>
    </tr>
    <tr>
        <th style="text-align:center">DEPENDENCIA: <?php echo $nombre_dependencia ?></th>
    </tr>
    <tr>
        <th style="text-align:center">TIPO DE INVENTARIO: <?php echo $nombre_tipo_inventario ?></th>
    </tr>
    <tr>
        <th style="text-align:center">FECHA DE CREACION: <?php echo $fecha_copia_inventario ?></th>
    </tr>
    <tr>
        <th style="text-align:center">TOTAL REGISTROS: <?php echo $total_reg ?></th>
    </tr>
    <tr>
        <th style="text-align:center"><input type="submit" name="si" value="SI" />&nbsp; &nbsp;<input type="submit" name="no" value="NO" /></th>
        <input name="pagina" type="hidden" value="<?php echo $pagina ?>" />
        <input name="cod_info_producto_copia_inventario" type="hidden" value="<?php echo $cod_info_producto_copia_inventario ?>" />
    </tr>
</table>
</form>
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