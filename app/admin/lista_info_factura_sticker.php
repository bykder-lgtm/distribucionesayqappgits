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
<a class="btn btn-primary" href="#"><h6>Lista Stickers</h6></a>
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
        <th style="text-align:left"><a href="#"><font size='+2'>Lista Stickers</font></a></th>
        <?php if ($cod_estado_sticker_barra_registrar == '1') { ?>
        <th style="text-align:right"><a href="../admin/facturacion_sticker_temporal_producto_barras_pos.php"><font size='+2'>Generar Nuevos Stickers</font></a></th>
        <?php } ?>
    </tr>
</table>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<?php if ($cod_estado_sticker_barra_editar == '1') { ?>
<th style="text-align:center">Edit</th>
<?php } ?>
<th style="text-align:center">ID</th>
<th style="text-align:center">Fecha</th>
<th style="text-align:center">Hora</th>
<th style="text-align:center">Observacion</th>
<th style="text-align:center">Tipo</th>
<?php if ($cod_estado_sticker_barra_imprimir == '1') { ?>
<th style="text-align:center">Imp</th>
<?php } ?>
</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_info_factura_sticker ORDER BY cod_info_factura_sticker DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_info_factura_sticker      = $info_info_factura['cod_info_factura_sticker'];
$cod_factura                   = $info_info_factura['cod_factura'];
$nombre_empresa                = $info_info_factura['nombre_empresa'];
$razonsocial_empresa           = $info_info_factura['razonsocial_empresa'];
$cuenta                        = $info_info_factura['cuenta'];
$cod_estado_factura            = $info_info_factura['cod_estado_factura'];
$fecha_anyo                    = $info_info_factura['fecha_anyo'];
$fecha_hora                    = $info_info_factura['fecha_hora'];
$cod_administrador             = $info_info_factura['cod_administrador'];
$nombre_tipo_producto          = $info_info_factura['nombre_tipo_producto'];
$total_precio_venta            = $info_info_factura['total_precio_venta'];
$cod_tipo_forma_pago           = $info_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_factura           = $info_info_factura['nombre_tipo_factura'];
$cod_tercero                   = $info_info_factura['cod_tercero'];
$observacion                   = $info_info_factura['observacion'];

$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$nombre_cliente                      = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
$direccion_cli                       = $matriz_cliente['direccion_tercero'];
?>
<tr id="<?php echo $cod_info_factura_sticker;?>">
<?php if ($cod_estado_sticker_barra_editar == '1') { ?>
<td style="text-align:center" id="edit<?php echo $cod_info_factura_sticker;?>" style="text-align:center"><a href="../admin/edit_facturacion_sticker_producto_barras_pos.php?cod_info_factura_sticker=<?php echo $cod_info_factura_sticker ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
<?php } ?>
<td style="text-align:center" id="cod_factura<?php echo $cod_info_factura_sticker;?>" style="text-align:center"><?php echo $cod_info_factura_sticker?></td>
<td style="text-align:center" id="fecha_anyo<?php echo $cod_info_factura_sticker;?>" style="text-align:center"><?php echo $fecha_anyo?></td>
<td style="text-align:center" id="fecha_hora<?php echo $cod_info_factura_sticker;?>" style="text-align:center"><?php echo $fecha_hora?></td>
<td style="text-align:left" id="fecha_hora<?php echo $cod_info_factura_sticker;?>" style="text-align:center"><?php echo $observacion?></td>
<td style="text-align:center" id="nombre_tipo_producto<?php echo $cod_info_factura_sticker;?>" style="text-align:center"><?php echo $nombre_tipo_factura?></td>
<?php if ($cod_estado_sticker_barra_imprimir == '1') { ?>
<td style="text-align:center" id="edit<?php echo $cod_info_factura_sticker;?>" style="text-align:center"><a href="../admin/sticker_tiketeadora_productos_opcion_imprimir_js.php?cod_info_factura_sticker=<?php echo $cod_info_factura_sticker ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/imprimir_peq.png" class="img-polaroid" alt=""></a></td>
<?php } ?>
</tr id="<?php echo $cod_info_factura_sticker;?>">
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
        var cod_info_factura_sticker = $(this).parent().attr('data');
        var dataString = 'llave='+cod_info_factura_sticker+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_info_factura_sticker+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_info_factura_'+cod_info_factura_sticker).fadeOut("slow");
                $('#cod_factura'+cod_info_factura_sticker).fadeOut("slow");
                $('#nombre_empresa'+cod_info_factura_sticker).fadeOut("slow");
                $('#fecha_anyo'+cod_info_factura_sticker).fadeOut("slow");
                $('#fecha_hora'+cod_info_factura_sticker).fadeOut("slow");
                $('#nombre_tipo_producto'+cod_info_factura_sticker).fadeOut("slow");
                $('#edit'+cod_info_factura_sticker).fadeOut("slow");
                $('#excel'+cod_info_factura_sticker).fadeOut("slow");
                $('#imp'+cod_info_factura_sticker).fadeOut("slow");
                $('#lista'+cod_info_factura_sticker).fadeOut("slow");
                $('#tr'+cod_info_factura_sticker).fadeOut("slow");
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