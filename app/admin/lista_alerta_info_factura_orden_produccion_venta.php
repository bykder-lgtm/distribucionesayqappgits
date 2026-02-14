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
<a class="btn btn-primary" href="#"><h6>Lista Ordenes de Produccion</h6></a>
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
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="#"><font size='+2'>Lista Ordenes de Produccion</font></a></th>
        <th style="text-align:right"><a href="../admin/facturacion_orden_produccion_venta_temporal_producto_manual_pos.php"><font size='+2'>Orden Produccion</font></a></th>
    </tr>
</table>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<!--<th style="text-align:center">Elm</th>-->
<!--<th style="text-align:center">Edit</th>-->
<th style="text-align:center">ID</th>
<th style="text-align:center">Cliente</th>
<th style="text-align:center">Total</th>
<th style="text-align:center">Fecha</th>
<th style="text-align:center">Fecha - Hora Entrega</th>
<th style="text-align:center">Dias Entrega</th>
<th style="text-align:center">Imp1</th>
</tr>
</thead>
<tbody>
<?php
$fecha_hoy_seg                              = time();
$fecha_hora_alerta_seg                      = 0;
$dias_aviso                                 = 10;
$dias_seg                                   = $dias_aviso * (60 * 60 * 24);
$correos                                    = 'editaxe@yandex.com';

$sql_info_factura = "SELECT * FROM tbl15_info_orden_produccion_factura_venta WHERE (nombre_estado_factura = 'CERRADA') ORDER BY cod_info_orden_produccion_factura_venta DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {
    
$cod_info_orden_produccion_factura_venta    = $info_info_factura['cod_info_orden_produccion_factura_venta'];
$cod_factura                                = $info_info_factura['cod_factura'];
$nombre_empresa                             = $info_info_factura['nombre_empresa'];
$razonsocial_empresa                        = $info_info_factura['razonsocial_empresa'];
$cuenta                                     = $info_info_factura['cuenta'];
$cod_estado_factura                         = $info_info_factura['cod_estado_factura'];
$fecha_anyo                                 = $info_info_factura['fecha_anyo'];
$fecha_hora                                 = $info_info_factura['fecha_hora'];
$cod_administrador                          = $info_info_factura['cod_administrador'];
$nombre_tipo_producto                       = $info_info_factura['nombre_tipo_producto'];
$total_precio_venta                         = $info_info_factura['total_precio_venta'];
$cod_tipo_forma_pago                        = $info_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_factura                        = $info_info_factura['nombre_tipo_factura'];
$cod_tercero                                = $info_info_factura['cod_tercero'];

$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$nombre_cliente                             = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                                 = $matriz_cliente['identificacion_tercero'];
$direccion_cli                              = $matriz_cliente['direccion_tercero'];

$fecha_entrega                              = $info_info_factura['fecha_entrega'];
$hora_entrega                               = $info_info_factura['hora_entrega'];
$fecha_hora_alerta_seg                      = strtotime($fecha_entrega.' '.$hora_entrega);
$hoy_aumentado_dias_seg                     = ($fecha_hoy_seg + $dias_seg);
$hoy_diminuido_dias_seg                     = intval(($fecha_hora_alerta_seg - $fecha_hoy_seg));
$dias_calc                                  = intval(($hoy_diminuido_dias_seg / (60 * 60)) / 24);

if (($hoy_aumentado_dias_seg >= $fecha_hoy_seg) && ($fecha_hora_alerta_seg <= $hoy_aumentado_dias_seg)) {

$correo = $correos;
$ymd = date('Y-m-d', $fecha_hora_alerta_seg);

if ($dias_calc == 0) { $dias = 'HOY'; } 
if ($dias_calc == 1) { $dias = 'MAÑANA '; } 
if ($dias_calc > 1) { $dias = 'EN '.intval(($hoy_diminuido_dias_seg / (60 * 60)) / 24).' DIAS '; }
?>
<tr id="<?php echo $cod_info_orden_produccion_factura_venta;?>">
<!--<td id="edit<?php echo $cod_info_orden_produccion_factura_venta;?>" style="text-align:center"><a href="../admin/edit_factura_orden_produccion_venta.php?cod_info_orden_produccion_factura_venta=<?php echo $cod_info_orden_produccion_factura_venta ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>-->
<!--<td class="service_list" id="cod_info_orden_produccion_factura_venta<?php echo $cod_info_orden_produccion_factura_venta ?>" data="<?php echo $cod_info_orden_produccion_factura_venta ?>"><a class="eliminar" id="cod_info_orden_produccion_factura_venta<?php echo $cod_info_orden_produccion_factura_venta ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>-->
<td style="text-align:center" id="cod_factura<?php echo $cod_info_orden_produccion_factura_venta;?>" style="text-align:center"><?php echo $cod_factura?></td>
<td style="text-align:left" id="nombre_empresa<?php echo $cod_info_orden_produccion_factura_venta;?>" style="text-align:left"><?php echo $nombre_cliente?></td>
<td style="text-align:right" id="nombre_empresa<?php echo $cod_info_orden_produccion_factura_venta;?>" style="text-align:left"><?php echo number_format($total_precio_venta, 0, ",", ".") ?></td>
<td style="text-align:center" id="fecha_anyo<?php echo $cod_info_orden_produccion_factura_venta;?>" style="text-align:center"><?php echo $fecha_anyo?></td>
<td style="text-align:center" id="nombre_tipo_producto<?php echo $cod_info_orden_produccion_factura_venta;?>" style="text-align:center"><?php echo $fecha_entrega.' '.$hora_entrega ?></td>
<td style="text-align:center" id="fecha_hora<?php echo $cod_info_orden_produccion_factura_venta;?>" style="text-align:center"><?php echo $dias?></td>
<td style="text-align:center" id="imp<?php echo $cod_info_orden_produccion_factura_venta;?>" style="text-align:center"><a href="../admin/ver_factura_orden_produccion_venta_pdf.php?cod_info_orden_produccion_factura_venta=<?php echo $cod_info_orden_produccion_factura_venta ?>&fecha=<?php echo $fecha_anyo ?>" target="_blank"><img src="../imagenes/imprimir_peq.png" class="img-polaroid" alt=""></a></td>
<!--
<td id="excel<?php echo $cod_info_orden_produccion_factura_venta;?>" style="text-align:center"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=EXCEL&cod_info_orden_produccion_factura_venta=<?php echo $cod_info_orden_produccion_factura_venta ?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/excel.png" class="img-polaroid" alt=""></a></td>
<td id="lista<?php echo $cod_info_orden_produccion_factura_venta;?>" style="text-align:center"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=LISTA&cod_info_orden_produccion_factura_venta=<?php echo $cod_info_orden_produccion_factura_venta?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/ver_lista_peq.png" class="img-polaroid" alt=""></a></td>
-->
</tr id="<?php echo $cod_info_orden_produccion_factura_venta;?>">
<?php } ?>
<?php } ?>
</tbody>
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

<script type="text/javascript">
$(document).ready(function() {

    $('.eliminar').click(function(){
    
        var parent = $(this).parent().attr('id');
        var cod_info_orden_produccion_factura_venta = $(this).parent().attr('data');
        var dataString = 'llave='+cod_info_orden_produccion_factura_venta+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_info_orden_produccion_factura_venta+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_info_factura_'+cod_info_orden_produccion_factura_venta).fadeOut("slow");
                $('#cod_factura'+cod_info_orden_produccion_factura_venta).fadeOut("slow");
                $('#nombre_empresa'+cod_info_orden_produccion_factura_venta).fadeOut("slow");
                $('#fecha_anyo'+cod_info_orden_produccion_factura_venta).fadeOut("slow");
                $('#fecha_hora'+cod_info_orden_produccion_factura_venta).fadeOut("slow");
                $('#nombre_tipo_producto'+cod_info_orden_produccion_factura_venta).fadeOut("slow");
                $('#edit'+cod_info_orden_produccion_factura_venta).fadeOut("slow");
                $('#excel'+cod_info_orden_produccion_factura_venta).fadeOut("slow");
                $('#imp'+cod_info_orden_produccion_factura_venta).fadeOut("slow");
                $('#lista'+cod_info_orden_produccion_factura_venta).fadeOut("slow");
                $('#tr'+cod_info_orden_produccion_factura_venta).fadeOut("slow");
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