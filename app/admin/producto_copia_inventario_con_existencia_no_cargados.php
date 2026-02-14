<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script language="javascript" src="isiAJAX.js"></script>
<script language="javascript">
var last;
function Focus(elemento, valor) {
$(elemento).className = 'inputon';
last = valor;
}
function Blur(elemento, valor, campo, id) {
$(elemento).className = 'inputoff';
if (last != valor)
myajax.Link('guardar_productos_cargados_inventario_vendedores_comparacion_unidades_ver.php?valor='+valor+'&campo='+campo+'&id='+id);
}
</script>
</head>
<body id="pageBody" onLoad="myajax = new isiAJAX();">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs">
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

$sql_producto_con_existencia_no_cargado = "SELECT * FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') 
AND (und_producto_viejo <> '0.00') AND (fecha_actualizacion = '') ORDER BY fecha_modificacion DESC";
$resultado_producto_con_existencia_no_cargado = mysqli_query($conectar, $sql_producto_con_existencia_no_cargado) or die(mysqli_error($conectar));
$total_producto_con_existencia_no_cargado = mysqlI_num_rows($resultado_producto_con_existencia_no_cargado);
?>
<table class="table table-striped">
    <tbody><tr>
        <th style="text-align:center">CON EXISTENCIA NO CARGADO</th>
        <th style="text-align:center"><a href="../admin/producto_copia_inventario_cargados.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>&pagina=<?php echo $pagina ?>">PRODUCTOS CARGADOS</a></th>
        <th style="text-align:center"><a href="../admin/producto_copia_inventario_sin_cargar.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>&pagina=<?php echo $pagina ?>">FALTAN POR CARGAR</a></th>
        <th style="text-align:center"><a href="../admin/cargar_producto_copia_inventario.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>&pagina=<?php echo $pagina ?>">CARGAR</a></th>

    </tr></tbody>
</table>

<table class="table table-striped">
    <tbody>
        <tr>
        <th style="text-align:center"><a>INVENTARIO DE PRODUCTOS CON EXISTENCIA DE UNIDADES NO CARGADOS [<?php echo $total_producto_con_existencia_no_cargado ?>]</a></th>
    </tr>
</tbody>
</table>

<div class="table-responsive">
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">CÓDIGO</th>
<th style="text-align:center">PRODUCTO</th>
<th style="text-align:center">INV NUEVO</th>
<th style="text-align:center">INV VIEJO</th>
<th style="text-align:center">COMENTARIO</th>
<th style="text-align:center">P.COMPRA</th>
<th style="text-align:center">P.VENTA</th>
<th style="text-align:center">CUENTA</th>
<th style="text-align:center">COPIA</th>
</tr>
</thead>
<tbody>
<?php

while ($info_producto_con_existencia_no_cargado = mysqli_fetch_assoc($resultado_producto_con_existencia_no_cargado)) {

$cod_producto_copia_inventario          = $info_producto_con_existencia_no_cargado['cod_producto_copia_inventario'];
$cod_producto_barra                     = $info_producto_con_existencia_no_cargado['cod_producto_barra'];
$nombre_producto                        = $info_producto_con_existencia_no_cargado['nombre_producto'];
$und_producto_nuevo                     = $info_producto_con_existencia_no_cargado['und_producto_nuevo'];
$und_producto_viejo                     = $info_producto_con_existencia_no_cargado['und_producto_viejo'];
$precio_compra_producto                 = $info_producto_con_existencia_no_cargado['precio_compra_producto'];
$precio_venta_producto                  = $info_producto_con_existencia_no_cargado['precio_venta_producto'];
$comentario_copia_inventario            = $info_producto_con_existencia_no_cargado['comentario_copia_inventario'];
$fecha_actualizacion                    = $info_producto_con_existencia_no_cargado['fecha_actualizacion'];
$cod_administrador                      = $info_producto_con_existencia_no_cargado['cuenta'];

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto_nuevo = intval($und_producto_nuevo); } else { $und_producto_nuevo = $und_producto_nuevo; }
if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_producto_viejo = intval($und_producto_viejo); } else { $und_producto_viejo = $und_producto_viejo; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                                 = $datos_administrador['cuenta'];
?>
<tr>
<td style="text-align:left"><?php echo $cod_producto_barra?></td>
<td style="text-align:left"><?php echo $nombre_producto?></td>
<td style="text-align:center"><?php echo $und_producto_nuevo?></td>
<td style="text-align:center"><?php echo $und_producto_viejo?></td>
<td style="text-align:left"><?php echo $comentario_copia_inventario?></td>
<td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></td>
<td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
<td style="text-align:center"><?php echo $cuenta?></td>
<td style="text-align:center"><?php echo $cod_info_producto_copia_inventario?></td>
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