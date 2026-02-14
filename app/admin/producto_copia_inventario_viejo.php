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
<!--<a class="btn btn-primary" href="#"><h6></h6></a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_informe_condiciones_salud';
$tipo                        = 'eliminar';
$campo                       = 'cod_informe_condiciones_salud';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
$tipo                        = 'eliminar';
$tab                         = 'elim_productos_copia_inventario';

if (isset($_GET['cod_info_producto_copia_inventario'])) {
$cod_info_producto_copia_inventario          = intval($_GET['cod_info_producto_copia_inventario']);

$sql_info_factura = "SELECT * FROM tbl15_info_producto_copia_inventario  WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

$total_precio_compra_producto_inv_viejo      = $info_info_factura['total_precio_compra_producto_inv_viejo'];
$total_precio_costo_producto_inv_viejo       = $info_info_factura['total_precio_costo_producto_inv_viejo'];
$total_precio_venta_producto_inv_viejo       = $info_info_factura['total_precio_venta_producto_inv_viejo'];
$fecha_copia_inventario                      = $info_info_factura['fecha_copia_inventario'];
$hora_copia_inventario                       = $info_info_factura['hora_copia_inventario'];
$cod_administrador                           = $info_info_factura['cod_administrador'];
$fecha_creacion                              = $info_info_factura['fecha_creacion'];
$fecha_modificacion                          = $info_info_factura['fecha_modificacion'];
$total_reg                                   = $info_info_factura['total_reg'];
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
<table class="table table-striped">
    <tr>
        <th style="text-align:center"><font size='+2'>INVENTARIO DE PRODUCTOS COPIA <?php echo $cod_info_producto_copia_inventario ?></font></th>
    </tr>
    <tr>
        <th style="text-align:center"><font size='+2'>DEPENDENCIA: <?php echo $nombre_dependencia ?></font></th>
    </tr>
    <?php if ($cod_estado_inventario_a_cero == '0') { ?>
    <tr>
        <th style="text-align:center"><a href="../admin/pregunta_inventario_a_cero.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>&pagina=<?php echo $pagina ?>"><font size='+2'>LLEVAR INVENTARIO A CERO</font></a></th>
    </tr>
    <?php } ?>
</table>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">TOTAL PRODUCTOS</th>
<th style="text-align:center">TOTAL COMPRA</th>
<th style="text-align:center">TOTAL VENTA</th>
</tr>
</thead>
<tbody>
<tr>
<td style="text-align:center"><?php echo $total_reg?></td>
<td style="text-align:center"><?php echo number_format($total_precio_compra_producto_inv_viejo, 0, ",", ".") ?></td>
<td style="text-align:center"><?php echo number_format($total_precio_venta_producto_inv_viejo, 0, ",", ".") ?></td>
</tr>
</tbody>
</table>

<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">CÓDIGO</th>
<th style="text-align:center">PRODUCTO</th>
<th style="text-align:center">UND</th>
<th style="text-align:center">MD</th>
<th style="text-align:center">P.COMPRA</th>
<th style="text-align:center">P.VENTA</th>
</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') ORDER BY nombre_producto DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_producto_copia_inventario          = $info_info_factura['cod_producto_copia_inventario'];
$cod_producto_barra                     = $info_info_factura['cod_producto_barra'];
$nombre_producto                        = $info_info_factura['nombre_producto'];
$und_producto_viejo                     = $info_info_factura['und_producto_viejo'];
$und_producto_nuevo                     = $info_info_factura['und_producto_nuevo'];
$precio_compra_producto                 = $info_info_factura['precio_compra_producto'];
$precio_venta_producto                  = $info_info_factura['precio_venta_producto'];
$nombre_tipo_unidad_medida              = $info_info_factura['nombre_tipo_unidad_medida'];
?>
<tr>
<td style="text-align:left"><?php echo $cod_producto_barra?></td>
<td style="text-align:left"><?php echo $nombre_producto?></td>
<td style="text-align:center"><?php echo $und_producto_viejo?></td>
<td style="text-align:center"><?php echo $nombre_tipo_unidad_medida?></td>
<td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></td>
<td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
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

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_info_factura_compra = $(this).parent().attr('data');
        var dataString = 'llave='+cod_info_factura_compra+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_info_factura_compra+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_info_factura_'+cod_info_factura_compra).fadeOut("slow");
                $('#cod_factura'+cod_info_factura_compra).fadeOut("slow");
                $('#nombre_empresa'+cod_info_factura_compra).fadeOut("slow");
                $('#fecha_anyo'+cod_info_factura_compra).fadeOut("slow");
                $('#fecha_hora'+cod_info_factura_compra).fadeOut("slow");
                $('#nombre_tipo_producto'+cod_info_factura_compra).fadeOut("slow");
                $('#edit'+cod_info_factura_compra).fadeOut("slow");
                $('#excel'+cod_info_factura_compra).fadeOut("slow");
                $('#imp'+cod_info_factura_compra).fadeOut("slow");
                $('#lista'+cod_info_factura_compra).fadeOut("slow");
                $('#tr'+cod_info_factura_compra).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>

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