<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">
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
<?php if ($cod_estado_fecha_vencimiento_global == '1') { ?>
<a class="btn btn-primary" href="../admin/reporte_fecha_vencimiento.php"><h6>Reporte Fecha de Vencimiento</h6></a>
<?php } ?>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center"><a href="#">Elim</a></th>
<th style="text-align:center"><a href="#">Codigo</a></th>
<th style="text-align:center"><a href="#">Nombre Producto</a></th>
<th style="text-align:center"><a href="#">P.Venta</a></th>
<th style="text-align:center"><a href="#">Fecha Vencimiento</a></th>
<th style="text-align:center"><a href="#">Lote</a></th>
<th style="text-align:center"><a href="#">Vencio Hace</a></th>
<th style="text-align:center"><a href="#">Factura</a></th>
<th style="text-align:center"><a href="#">Proveedor</a></th>
</tr>
</thead>
<tbody>
<?php
$fecha_vencimiento_hoy   = date("Y-m-d");
$fecha_hoy_seg           = strtotime(date("Y-m-d"));
$pagina                  = $_SERVER['PHP_SELF'];
$tab                     = 'tbl15_historial_fecha_vencimiento';
$tipo                    = 'eliminar';
$campo                   = 'cod_historial_fecha_vencimiento';

$sql_total_forma_pago = "SELECT tbl15_historial_fecha_vencimiento.cod_historial_fecha_vencimiento, tbl15_producto.cod_producto_barra, 
tbl15_producto.nombre_producto, tbl15_historial_fecha_vencimiento.fecha_compra, tbl15_historial_fecha_vencimiento.fecha_vencimiento, 
tbl15_historial_fecha_vencimiento.vencimiento_lote, tbl15_historial_fecha_vencimiento.cod_factura, 
tbl15_historial_fecha_vencimiento.cod_info_factura_compra, tbl15_producto.precio_venta_producto
FROM tbl15_producto RIGHT JOIN tbl15_historial_fecha_vencimiento ON tbl15_producto.cod_producto_barra = tbl15_historial_fecha_vencimiento.cod_producto_barra
WHERE (tbl15_historial_fecha_vencimiento.fecha_vencimiento < '$fecha_vencimiento_hoy') 
ORDER BY tbl15_historial_fecha_vencimiento.fecha_vencimiento DESC";
$consulta_total_forma_pago = mysqli_query($conectar, $sql_total_forma_pago) or die(mysqli_error($conectar));
while ($datos_total_forma_pago = mysqli_fetch_assoc($consulta_total_forma_pago)) {

$cod_historial_fecha_vencimiento        = $datos_total_forma_pago['cod_historial_fecha_vencimiento'];
$cod_producto_barra                     = $datos_total_forma_pago['cod_producto_barra'];
$nombre_producto                        = $datos_total_forma_pago['nombre_producto'];
$fecha_compra                           = $datos_total_forma_pago['fecha_compra'];
$fecha_vencimiento                      = $datos_total_forma_pago['fecha_vencimiento'];
$vencimiento_lote                       = $datos_total_forma_pago['vencimiento_lote'];
$cod_factura                            = $datos_total_forma_pago['cod_factura'];
$cod_info_factura_compra                = $datos_total_forma_pago['cod_info_factura_compra'];
$precio_venta_producto                  = $datos_total_forma_pago['precio_venta_producto'];
$difrencia_seg                          = strtotime($fecha_vencimiento) - $fecha_hoy_seg;
$dias_a_vencer                          = ((($difrencia_seg / 60) /60) / 24);

$sql_infos_empresas = "SELECT cod_tercero FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_tercero                            = $info_empresa_data['cod_tercero'];

$sql_infos_empresas = "SELECT nombre1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$nombre1_tercero                        = $info_empresa_data['nombre1_tercero'];
?>
<tr>
<td style="text-align:center;" class="service_list" id="cod_historial_fecha_vencimiento<?php echo $cod_historial_fecha_vencimiento ?>" data="<?php echo $cod_historial_fecha_vencimiento ?>"><a class="eliminar" id="cod_historial_fecha_vencimiento<?php echo $cod_historial_fecha_vencimiento ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>
<td style="text-align:left" id="cod_producto_barra<?php echo $cod_historial_fecha_vencimiento;?>"><?php echo $cod_producto_barra?></td>
<td style="text-align:left" id="nombre_producto<?php echo $cod_historial_fecha_vencimiento;?>"><?php echo $nombre_producto?></td>
<td style="text-align:right" id="precio_venta_producto<?php echo $cod_historial_fecha_vencimiento;?>"><?php echo number_format($precio_venta_producto, 0, ",", ".")?></td>
<td style="text-align:center" id="fecha_vencimiento<?php echo $cod_historial_fecha_vencimiento;?>"><?php echo $fecha_vencimiento?></td>
<td style="text-align:center" id="vencimiento_lote<?php echo $cod_historial_fecha_vencimiento;?>"><?php echo $vencimiento_lote?></td>
<td style="text-align:center" id="dias_a_vencer<?php echo $cod_historial_fecha_vencimiento;?>"><?php echo ($dias_a_vencer * -1)?> Dias</td>
<td style="text-align:center" id="cod_factura<?php echo $cod_historial_fecha_vencimiento;?>"><?php echo $cod_factura?></td>
<td style="text-align:center" id="nombre1_tercero<?php echo $cod_historial_fecha_vencimiento;?>"><?php echo $nombre1_tercero?></td>
</tr>
<?php } ?>
</tbody>
</table>
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
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->


<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_historial_fecha_vencimiento = $(this).parent().attr('data');
        var dataString = 'llave='+cod_historial_fecha_vencimiento+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_historial_fecha_vencimiento+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_producto_barra'+cod_historial_fecha_vencimiento).fadeOut("slow");
                $('#nombre_producto'+cod_historial_fecha_vencimiento).fadeOut("slow");
                $('#precio_venta_producto'+cod_historial_fecha_vencimiento).fadeOut("slow");
                $('#fecha_vencimiento'+cod_historial_fecha_vencimiento).fadeOut("slow");
                $('#vencimiento_lote'+cod_historial_fecha_vencimiento).fadeOut("slow");
                $('#dias_a_vencer'+cod_historial_fecha_vencimiento).fadeOut("slow");
                $('#cod_factura'+cod_historial_fecha_vencimiento).fadeOut("slow");
                $('#nombre1_tercero'+cod_historial_fecha_vencimiento).fadeOut("slow");
                $('#tr'+cod_historial_fecha_vencimiento).fadeOut("slow");
            }
        });
    });

});
</script>
</body>
</html>