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
<a class="btn btn-primary" href="#"><h6>Lista Transferencias Salida</h6></a>
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
        <th style="text-align:left"><a href="#"><font size='+2'>Lista de Transferencia Entrada Temporal</font></a></th>
        <?php if ($cod_estado_prod_transferencia_extern_registrar == '1') { ?>
        <th style="text-align:left"><a href="../admin/lista_info_factura_trasnferencia_bodega.php"><font size='+2'>Regresar</font></a></th>
        <?php } ?>
    </tr>
</table>



<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<?php if ($cod_estado_prod_transferencia_extern == '1') { ?>
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center">Ver</th>
<th style="text-align:center">Id</th>
<th style="text-align:center">Empresa</th>
<!--<th style="text-align:center">Total</th>-->
<th style="text-align:center">Fecha</th>
<th style="text-align:center">Hora</th>
<?php if ($cod_estado_prod_transferencia_extern_imprimir==1) { ?>
<!--<th style="text-align:center">Imp</th>-->
<?php } ?>
</tr>
</thead>
<tbody>
<?php

$sql_info_factura = "SELECT * FROM tbl15_info_factura_transferencia_bodega_entrada WHERE (nombre_estado_factura = 'ABIERTA') ORDER BY cod_info_factura_transferencia_bodega_entrada DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {
    
    $cod_info_factura_transferencia_bodega_entrada      = $info_info_factura['cod_info_factura_transferencia_bodega_entrada'];
    $cod_factura                                        = $info_info_factura['cod_factura'];
    $nombre_empresa                                     = $info_info_factura['nombre_empresa'];
    $razonsocial_empresa                                = $info_info_factura['razonsocial_empresa'];
    $cuenta                                             = $info_info_factura['cuenta'];
    $cod_estado_factura                                 = $info_info_factura['cod_estado_factura'];
    $fecha_anyo                                         = $info_info_factura['fecha_anyo'];
    $fecha_hora                                         = $info_info_factura['fecha_hora'];
    $cod_administrador                                  = $info_info_factura['cod_administrador'];
    $nombre_tipo_producto                               = $info_info_factura['nombre_tipo_producto'];
    $total_precio_venta                                 = $info_info_factura['total_precio_venta'];
    $cod_tipo_forma_pago                                = $info_info_factura['cod_tipo_forma_pago'];
    $nombre_tipo_factura                                = $info_info_factura['nombre_tipo_factura'];
    $cod_tercero                                        = $info_info_factura['cod_tercero'];
    $cod_tipo_pago                                      = $info_info_factura['cod_tipo_pago'];
    $cod_empresa_transferencia_directa                  = $info_info_factura['cod_empresa_transferencia_directa'];

    $obtener_tipo_inventario = "SELECT * FROM tbl15_empresa_transferencia_directa WHERE (cod_empresa_transferencia_directa = '$cod_empresa_transferencia_directa')";
    $resultado_tipo_inventario = mysqli_query($conectar, $obtener_tipo_inventario) or die(mysqli_error($conectar));
    $matriz_tipo_inventario = mysqli_fetch_assoc($resultado_tipo_inventario);

    $nombre_empresa_transferencia_directa               = $matriz_tipo_inventario['nombre_empresa_transferencia_directa'];

    $obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
    $matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

    $nombre_cliente                      = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
    $cedula_cli                          = $matriz_cliente['identificacion_tercero'];
    $direccion_cli                       = $matriz_cliente['direccion_tercero'];

    $obtener_tipo_pago = "SELECT * FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
    $resultado_tipo_pago = mysqli_query($conectar, $obtener_tipo_pago) or die(mysqli_error($conectar));
    $matriz_tipo_pago = mysqli_fetch_assoc($resultado_tipo_pago);

    $nombre_tipo_pago                    = $matriz_tipo_pago['nombre_tipo_pago'];

    $obtener_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    $resultado_forma_pago = mysqli_query($conectar, $obtener_forma_pago) or die(mysqli_error($conectar));
    $matriz_forma_pago = mysqli_fetch_assoc($resultado_forma_pago);

    $nombre_tipo_forma_pago              = $matriz_forma_pago['nombre_tipo_forma_pago'];
?>
<tr id="<?php echo $cod_info_factura_transferencia_bodega_entrada;?>">
<td style="text-align:center"><a href="../admin/facturacion_transferencia_bodega_entrada_temporal_producto_manual_pos.php?cod_info_factura_transferencia_bodega_entrada=<?php echo $cod_info_factura_transferencia_bodega_entrada ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></td>
<!--<td class="service_list" id="cod_info_factura_transferencia_bodega_entrada<?php echo $cod_info_factura_transferencia_bodega_entrada ?>" data="<?php echo $cod_info_factura_transferencia_bodega_entrada ?>"><a class="eliminar" id="cod_info_factura_transferencia_bodega_entrada<?php echo $cod_info_factura_transferencia_bodega_entrada ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>-->
<td style="text-align:center" id="cod_info_factura_transferencia_bodega_entrada<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><?php echo $cod_info_factura_transferencia_bodega_entrada?></td>
<td style="text-align:left" id="nombre_empresa<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:left"><?php echo $nombre_empresa_transferencia_directa?></td>
<!--<td style="text-align:right" id="nombre_empresa<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:left"><?php echo number_format($total_precio_venta, 0, ",", ".") ?></td>-->
<td style="text-align:center" id="fecha_anyo<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><?php echo $fecha_anyo?></td>
<td style="text-align:center" id="fecha_hora<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><?php echo $fecha_hora?></td>
<?php if ($cod_estado_prod_transferencia_extern_imprimir==1) { ?>
<!--<td style="text-align:center" id="edit<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><a href="../admin/transferenica_bodega_productos_opcion_imprimir.php?cod_info_factura_transferencia_bodega_entrada=<?php echo $cod_info_factura_transferencia_bodega_entrada ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/imprimir_directa_pos_peq2.png" class="img-polaroid" alt=""></a></td>-->
<?php } ?>
<!--
<td id="excel<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=EXCEL&cod_info_factura_transferencia_bodega_entrada=<?php echo $cod_info_factura_transferencia_bodega_entrada ?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/excel.png" class="img-polaroid" alt=""></a></td>
<td id="lista<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=LISTA&cod_info_factura_transferencia_bodega_entrada=<?php echo $cod_info_factura_transferencia_bodega_entrada?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/ver_lista_peq.png" class="img-polaroid" alt=""></a></td>
-->
</tr id="<?php echo $cod_info_factura_transferencia_bodega_entrada;?>">
<?php } ?>
</tbody>
</table>
<?php } ?>
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
        var cod_info_factura_transferencia_bodega_entrada = $(this).parent().attr('data');
        var dataString = 'llave='+cod_info_factura_transferencia_bodega_entrada+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_info_factura_transferencia_bodega_entrada+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_info_factura_'+cod_info_factura_transferencia_bodega_entrada).fadeOut("slow");
                $('#cod_factura'+cod_info_factura_transferencia_bodega_entrada).fadeOut("slow");
                $('#nombre_empresa'+cod_info_factura_transferencia_bodega_entrada).fadeOut("slow");
                $('#fecha_anyo'+cod_info_factura_transferencia_bodega_entrada).fadeOut("slow");
                $('#fecha_hora'+cod_info_factura_transferencia_bodega_entrada).fadeOut("slow");
                $('#nombre_tipo_producto'+cod_info_factura_transferencia_bodega_entrada).fadeOut("slow");
                $('#edit'+cod_info_factura_transferencia_bodega_entrada).fadeOut("slow");
                $('#excel'+cod_info_factura_transferencia_bodega_entrada).fadeOut("slow");
                $('#imp'+cod_info_factura_transferencia_bodega_entrada).fadeOut("slow");
                $('#lista'+cod_info_factura_transferencia_bodega_entrada).fadeOut("slow");
                $('#tr'+cod_info_factura_transferencia_bodega_entrada).fadeOut("slow");
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