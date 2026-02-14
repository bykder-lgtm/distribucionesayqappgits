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
//-------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------//
if (isset($_GET['cod_info_producto_copia_inventario'])) {
$cod_info_producto_copia_inventario          = intval($_GET['cod_info_producto_copia_inventario']);

$sql_info_factura = "SELECT * FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') 
AND (fecha_actualizacion <> '') AND ((und_producto_nuevo - und_producto_viejo) > '0') ORDER BY fecha_modificacion DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
$total = mysqli_num_rows($resultado_info_factura);
//-------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------//
/*
$calculos_inventario_costo_viejo = "SELECT total_precio_compra_producto_inv_viejo, total_precio_venta_producto_inv_viejo    
FROM tbl15_info_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')";
$consulta_calculos_inventario_costo_viejo = mysqli_query($conectar, $calculos_inventario_costo_viejo) or die(mysqli_error($conectar));
$matriz_inventario_viejo = mysqli_fetch_assoc($consulta_calculos_inventario_costo_viejo);

$total_precio_compra_producto_inv_viejo       = $matriz_inventario_viejo['total_precio_compra_producto_inv_viejo'];
$total_precio_venta_producto_inv_viejo        = $matriz_inventario_venta_nuevo['total_precio_venta_producto_inv_viejo'];
*/
//-------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------//
$calculos_inventario_copia = "SELECT SUM(und_producto_nuevo * precio_compra_producto) AS total_precio_compra_producto_inv_nuevo, SUM(und_producto_nuevo * precio_venta_producto) AS total_precio_venta_producto_inv_nuevo, 
SUM(und_producto_viejo * precio_compra_producto) AS total_precio_compra_producto_inv_viejo, SUM(und_producto_viejo * precio_venta_producto) AS total_precio_venta_producto_inv_viejo 
FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') AND (fecha_actualizacion <> '')";
$consulta_calculos_inventario_copia = mysqli_query($conectar, $calculos_inventario_copia) or die(mysqli_error($conectar));
$matriz_inventario_copia = mysqli_fetch_assoc($consulta_calculos_inventario_copia);

$total_precio_compra_producto_inv_nuevo        = $matriz_inventario_copia['total_precio_compra_producto_inv_nuevo'];
$total_precio_venta_producto_inv_nuevo         = $matriz_inventario_copia['total_precio_venta_producto_inv_nuevo'];
$total_precio_compra_producto_inv_viejo        = $matriz_inventario_copia['total_precio_compra_producto_inv_viejo'];
$total_precio_venta_producto_inv_viejo         = $matriz_inventario_copia['total_precio_venta_producto_inv_viejo'];

$total_desfase_precio_compra_inv               = $total_precio_compra_producto_inv_nuevo - $total_precio_compra_producto_inv_viejo;
$total_desfase_precio_venta_inv                = $total_precio_venta_producto_inv_nuevo - $total_precio_venta_producto_inv_viejo;
//-------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------//
$calculos_inventario_venta_sobra = "SELECT SUM((und_producto_nuevo - und_producto_viejo) * precio_compra_producto) AS total_precio_compra_producto_inv_sobra, 
SUM((und_producto_nuevo - und_producto_viejo) * precio_venta_producto) AS total_precio_venta_producto_inv_sobra
FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') 
AND (fecha_actualizacion <> '') AND ((und_producto_nuevo - und_producto_viejo) > '0')";
$consulta_calculos_inventario_venta_sobra = mysqli_query($conectar, $calculos_inventario_venta_sobra) or die(mysqli_error($conectar));
$matriz_inventario_venta_sobra = mysqli_fetch_assoc($consulta_calculos_inventario_venta_sobra);

$total_precio_compra_producto_inv_sobra        = $matriz_inventario_venta_sobra['total_precio_compra_producto_inv_sobra'];
$total_precio_venta_producto_inv_sobra         = $matriz_inventario_venta_sobra['total_precio_venta_producto_inv_sobra'];
//-------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------//
$calculos_inventario_venta_falta = "SELECT SUM((und_producto_nuevo - und_producto_viejo) * precio_compra_producto) AS total_precio_compra_producto_inv_falta, 
SUM((und_producto_nuevo - und_producto_viejo) * precio_venta_producto) AS total_precio_venta_producto_inv_falta
FROM tbl15_producto_copia_inventario WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario') 
AND (fecha_actualizacion <> '') AND ((und_producto_nuevo - und_producto_viejo) < '0')";
$consulta_calculos_inventario_venta_falta = mysqli_query($conectar, $calculos_inventario_venta_falta) or die(mysqli_error($conectar));
$matriz_inventario_venta_falta = mysqli_fetch_assoc($consulta_calculos_inventario_venta_falta);

$total_precio_compra_producto_inv_falta        = $matriz_inventario_venta_falta['total_precio_compra_producto_inv_falta'];
$total_precio_venta_producto_inv_falta         = $matriz_inventario_venta_falta['total_precio_venta_producto_inv_falta'];
//-------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------//
?>
<table class="table table-striped">
    <tbody><tr>
        <th style="text-align:center"><a href="../admin/producto_copia_inventario_con_existencia_no_cargados.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>">CON EXISTENCIA NO CARGADO</a></th>
        <th style="text-align:center"><a href="../admin/producto_copia_inventario_resultado_sobrantes.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>">SOBRANTES</a></th>
        <th style="text-align:center"><a href="../admin/producto_copia_inventario_resultado_faltantes.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>&pagina=<?php echo $pagina ?>">FALTANTES</a></th>
        <th style="text-align:center"><a href="../admin/producto_copia_inventario_resultado_correctos.php?cod_info_producto_copia_inventario=<?php echo $cod_info_producto_copia_inventario ?>&pagina=<?php echo $pagina ?>">CORRECTOS</a></th>
    </tr></tbody>
</table>

<table class="table table-striped">
    <tbody><tr>
        <th style="text-align:center">TOTAL INV VIEJO (P.COMPRA)</th>
        <th style="text-align:center">TOTAL INV NUEVO (P.VENTA)</th>
        <th style="text-align:center">TOTAL INV VIEJO (P.VENTA)</th>
        <th style="text-align:center">SOBRAN INV (P.VENTA)</th>
        <th style="text-align:center">FALTAN INV (P.VENTA)</th>
        <th style="text-align:center">DESFASE TOTAL INV (P.VENTA)</th>
    </tr></tbody>
    <tr>
        <td style="text-align:center"><?php echo number_format($total_precio_compra_producto_inv_viejo, 0, ",", "."); ?></td>
        <td style="text-align:center"><?php echo number_format($total_precio_venta_producto_inv_nuevo, 0, ",", "."); ?></td>
        <td style="text-align:center"><?php echo number_format($total_precio_venta_producto_inv_viejo, 0, ",", "."); ?></td>
        <td style="text-align:center"><?php echo number_format($total_precio_venta_producto_inv_sobra, 0, ",", "."); ?></td>
        <td style="text-align:center"><?php echo number_format($total_precio_venta_producto_inv_falta, 0, ",", "."); ?></td>
        <td style="text-align:center"><?php echo number_format($total_desfase_precio_venta_inv, 0, ",", "."); ?></td>
    </tr>
</table>

<table class="table table-striped">
    <tbody>
        <tr>
        <th style="text-align:center"><a>SOBRANTES</a></th>
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
<th style="text-align:center"></th>
<th style="text-align:center">COMENTARIO</th>
<th style="text-align:center">P.COMPRA</th>
<th style="text-align:center">P.VENTA</th>
<th style="text-align:center">FECHA</th>
<th style="text-align:center">CUENTA</th>
<th style="text-align:center">COPIA</th>
</tr>
</thead>
<tbody>
<?php
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_producto_copia_inventario          = $info_info_factura['cod_producto_copia_inventario'];
$cod_producto_barra                     = $info_info_factura['cod_producto_barra'];
$nombre_producto                        = $info_info_factura['nombre_producto'];
$und_producto_nuevo                     = $info_info_factura['und_producto_nuevo'];
$und_producto_viejo                     = $info_info_factura['und_producto_viejo'];
$precio_compra_producto                 = $info_info_factura['precio_compra_producto'];
$precio_venta_producto                  = $info_info_factura['precio_venta_producto'];
$comentario_copia_inventario            = $info_info_factura['comentario_copia_inventario'];
$fecha_actualizacion                    = $info_info_factura['fecha_actualizacion'];
$cod_administrador                      = $info_info_factura['cuenta'];

$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                                 = $datos_administrador['cuenta'];

$resta                                  = ($und_producto_viejo - $und_producto_nuevo) * -1;
if ($resta < 0) { $titulo_resultado = " UNDS FALTAN"; } elseif ($resta > 0) { $titulo_resultado = " UNDS SOBRAN"; } else { $titulo_resultado = "BIEN"; }
?>
<tr>
<td style="text-align:left"><?php echo $cod_producto_barra?></td>
<td style="text-align:left"><?php echo $nombre_producto?></td>
<td style="text-align:center"><?php echo $und_producto_nuevo?></td>
<td style="text-align:center"><?php echo $und_producto_viejo?></td>
<td style="text-align:left"><?php echo abs($resta).$titulo_resultado?></td>
<td style="text-align:left"><?php echo $comentario_copia_inventario?></td>
<td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></td>
<td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
<td style="text-align:center"><?php echo $fecha_actualizacion?></td>
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