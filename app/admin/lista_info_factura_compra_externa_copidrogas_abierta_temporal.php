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
<!--<div class="container">-->
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Lista Compra</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$pagina_local                = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_informe_condiciones_salud';
$tipo                        = 'eliminar';
$campo                       = 'cod_informe_condiciones_salud';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
$nombre_tipo_cargue_factura  = "FACTURA_COMPRA_NORMAL";

if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'facturacion_compra_iva_inc_temporal_producto_manual_pos.php'; }
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:center"><a href="../admin/facturacion_compra_iva_inc_temporal_producto_manual_pos.php"><font size='+1'>Lista Factura Compra Abierta</font></a></th>
        <?php if ($cod_estado_cargar_archivo_plano_externo_factura_compra_global == '1') { ?><th style="text-align:center"><a href="../admin/subir_archivo_plano_externo_copidrogas_factura_compra.php"><font size='+1'>Cargar Por Archivo Plano Externo</font></a></th><?php } ?>
        <?php if ($cod_estado_cargar_archivo_plano_interno_factura_compra_global == '1') { ?><th style="text-align:center"><a href="../admin/subir_archivo_plano_interno_factura_compra.php"><font size='+1'>Cargar Por Archivo Plano Interno</font></a></th><?php } ?>
        <?php if ($cod_estado_cargar_archivo_plano_interno_factura_compra_global == '1') { ?><th style="text-align:center"><a href="../admin/subir_archivo_plano_interno_factura_compra_por_caja.php"><font size='+1'>Cargar Por Archivo Plano Interno (Por Caja)</font></a></th><?php } ?>
        <?php if ($cod_estado_cargar_factura_compra_simplificada_carniceria_global == '1') { ?><th style="text-align:center"><a href="../admin/facturacion_compra_iva_inc_temporal_producto_manual_pos_simplificada_carniceria.php"><font size='+1'>Cargar Factura Compra Simplificada</font></a></th><?php } ?>
        <th style="text-align:center"><a href="../admin/cargar_factura_factura_compra_manual_interna.php?nombre_tipo_cargue_factura=<?php echo $nombre_tipo_cargue_factura?>&pagina=<?php echo $pagina?>"><font size='+1'>Nueva Factura Compra Manual</font></a></th>
    </tr>
</table>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
        <tr>
        <!--<th style="text-align:center">Elm</th>-->
        <?php if ($cod_estado_facturacion_compra == '1') { ?><th style="text-align:center">Ver</th><?php } ?>
        <th style="text-align:center">Factura</th>
        <th style="text-align:center">Proveedor</th>
        <th style="text-align:center">Descripcion</th>
        <th style="text-align:center">Fecha</th>
        <th style="text-align:center">Hora</th>
        <th style="text-align:center">Tipo Cargue</th>
        <th style="text-align:center">Origen</th>
        <?php if ($cod_estado_inventario_bodega_global == '1') { ?><th style="text-align:center">Tipo Inventario</th><?php } ?>
        <th style="text-align:center">ID</th>
        <th style="text-align:center">CV</th>
        <th style="text-align:center">Elim</th>
    </tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_info_factura_compra WHERE (nombre_estado_factura = 'ABIERTA') ORDER BY cod_info_factura_compra DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {
    
    $cod_info_factura_compra               = $info_info_factura['cod_info_factura_compra'];
    $cod_factura                           = $info_info_factura['cod_factura'];
    $nombre_empresa                        = $info_info_factura['nombre_empresa'];
    $razonsocial_empresa                   = $info_info_factura['razonsocial_empresa'];
    $cuenta                                = $info_info_factura['cuenta'];
    $cod_estado_factura                    = $info_info_factura['cod_estado_factura'];
    $fecha_anyo                            = $info_info_factura['fecha_anyo'];
    $fecha_hora                            = $info_info_factura['fecha_hora'];
    $cod_administrador                     = $info_info_factura['cod_administrador'];
    $nombre_tipo_producto                  = $info_info_factura['nombre_tipo_producto'];
    $total_factura_compra_retefuente       = $info_info_factura['total_factura_compra_retefuente'];
    $cod_tipo_forma_pago                   = $info_info_factura['cod_tipo_forma_pago'];
    $nombre_tipo_factura                   = $info_info_factura['nombre_tipo_factura'];
    $cod_tercero                           = $info_info_factura['cod_tercero'];
    $cod_tipo_inventario                   = $info_info_factura['cod_tipo_inventario'];
    $nombre_tipo_cargue_factura            = $info_info_factura['nombre_tipo_cargue_factura'];
    $cod_tipo_origen_factura_compra        = $info_info_factura['cod_tipo_origen_factura_compra'];
    $observacion                           = $info_info_factura['observacion'];
    $cod_caja_virtual_db                   = $info_info_factura['cod_caja_virtual'];

    $obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
    $matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

    $nombre_cliente                        = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
    $cedula_cli                            = $matriz_cliente['identificacion_tercero'];
    $direccion_cli                         = $matriz_cliente['direccion_tercero'];

    $obtener_cliente = "SELECT * FROM tbl15_tipo_inventario WHERE (cod_tipo_inventario = '$cod_tipo_inventario')";
    $resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
    $matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

    $nombre_tipo_inventario                = $matriz_cliente['nombre_tipo_inventario'];

    $obtener_tipo_origen_factura_compra = "SELECT * FROM tbl15_tipo_origen_factura_compra WHERE (cod_tipo_origen_factura_compra = '$cod_tipo_origen_factura_compra')";
    $resultado_tipo_origen_factura_compra = mysqli_query($conectar, $obtener_tipo_origen_factura_compra) or die(mysqli_error($conectar));
    $matriz_tipo_origen_factura_compra = mysqli_fetch_assoc($resultado_tipo_origen_factura_compra);

    $nombre_tipo_origen_factura_compra                = $matriz_tipo_origen_factura_compra['nombre_tipo_origen_factura_compra'];
    $nombre_producto_concat                           = '';

    $sql_datos_venta_temp = "SELECT cod_compra_producto_temporal, cod_producto_barra, und_compra, nombre_producto 
    FROM tbl15_compra_producto_temporal WHERE (cod_info_factura_compra = '$cod_info_factura_compra') ORDER BY cod_compra_producto_temporal DESC LIMIT 0, 10";
    $consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
    while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

        $nombre_producto_con                 = $datos_venta_temp['nombre_producto'];
        $und_compra_con                      = $datos_venta_temp['und_compra'];

        $nombre_producto_concat .= "".intval($und_compra_con)." | ".$nombre_producto_con.'<br>';
    }
    $nombre_producto_concat = substr($nombre_producto_concat, 0, 200)."...";
?>
    <tr id="<?php echo $cod_info_factura_compra;?>">
        <?php if ($cod_estado_facturacion_compra == '1') { ?><td style="text-align:center;"><a href="../admin/entrar_sesion_caja_virtual_factura_compra.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual_db ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></td><?php } ?>
        <td style="text-align:center"><?php echo $cod_factura?></td>
        <td style="text-align:left"><?php echo $nombre_cliente?></td>
        <td style="text-align:left"><?php echo $nombre_producto_concat?></td>
        <td style="text-align:center"><?php echo $fecha_anyo?></td>
        <td style="text-align:center"><?php echo $fecha_hora?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_cargue_factura?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_origen_factura_compra?></td>
        <?php if ($cod_estado_inventario_bodega_global == '1') { ?><td style="text-align:center"><?php echo $nombre_tipo_inventario?></td><?php } ?>
        <td style="text-align:center"><?php echo $cod_info_factura_compra?></td>
        <td style="text-align:center"><?php echo $cod_caja_virtual_db?></td>
        <td style="text-align:center;"><a href="../admin/eliminar_caja_virtual_compra.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra ?>&cuenta=<?php echo $cuenta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual_db ?>&cod_base_caja=<?php echo $cod_base_caja ?>&pagina=<?php echo $pagina_local ?>"><img src="../imagenes/eliminar.png" class="img-polaroid" alt=""></a></td>
        <!--
        <td id="excel<?php echo $cod_info_factura_compra;?>" style="text-align:center"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=EXCEL&cod_info_factura_compra=<?php echo $cod_info_factura_compra ?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/excel.png" class="img-polaroid" alt=""></a></td>
        <td id="lista<?php echo $cod_info_factura_compra;?>" style="text-align:center"><a href="../admin/redireccionador_evaluados_paraclinicos.php?fecha=<?php echo $fecha_anyo ?>&origen=<?php echo $origen ?>&destino=LISTA&cod_info_factura_compra=<?php echo $cod_info_factura_compra?>&cod_factura=<?php echo $cod_factura ?>" target="_blank"><img src="../imagenes/ver_lista_peq.png" class="img-polaroid" alt=""></a></td>
        -->
    </tr id="<?php echo $cod_info_factura_compra;?>">
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
<!--</div>-->
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