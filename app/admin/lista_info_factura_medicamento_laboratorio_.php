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
<a href="#"><h4>Lista de Facturas Medicamentos y Laboratorios&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/facturacion_venta_temporal_producto_manual_pos.php">Facturar Productos</a></h4>
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
?>
<br>
<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<!--<th style="text-align:center">Elm</th>-->
<th style="text-align:center">Edit</th>
<th style="text-align:center">Factura</th>
<th style="text-align:center">Empresa</th>
<th style="text-align:center">Tipo</th>
<th style="text-align:center">Fecha</th>
<th style="text-align:center">Hora</th>
<th style="text-align:center">Excel</th>
<th style="text-align:center">Factura</th>
<th style="text-align:center">Lista</th>
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT * FROM tbl15_info_factura_venta WHERE fecha_ini = '' GROUP BY cod_factura DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {
    
$cod_info_factura_venta              = $info_cliente['cod_info_factura_venta'];
$cod_factura                   = $info_cliente['cod_factura'];
$nombre_empresa                = $info_cliente['nombre_empresa'];
$razonsocial_empresa           = $info_cliente['razonsocial_empresa'];
$cuenta                        = $info_cliente['cuenta'];
$cod_estado_factura            = $info_cliente['cod_estado_factura'];
$fecha_anyo                    = $info_cliente['fecha_anyo'];
$fecha_hora                    = $info_cliente['fecha_hora'];
$cod_administrador             = $info_cliente['cod_administrador'];
$nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
?>
<tr id="<?php echo $cod_info_factura_venta;?>">
<td id="edit<?php echo $cod_info_factura_venta;?>" style="text-align:center"><a href="../admin/edit_factura_venta.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>
<!--<td class="service_list" id="cod_info_factura_venta<?php echo $cod_info_factura_venta ?>" data="<?php echo $cod_info_factura_venta ?>"><a class="eliminar" id="cod_info_factura_venta<?php echo $cod_info_factura_venta ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>-->
<td id="cod_factura<?php echo $cod_info_factura_venta;?>" style="text-align:center"><?php echo $cod_factura?></td>
<td id="nombre_empresa<?php echo $cod_info_factura_venta;?>" style="text-align:left"><?php echo $nombre_empresa?></td>
<td id="nombre_tipo_producto<?php echo $cod_info_factura_venta;?>" style="text-align:center"><?php echo $nombre_tipo_producto?></td>
<td id="fecha_anyo<?php echo $cod_info_factura_venta;?>" style="text-align:center"><?php echo $fecha_anyo?></td>
<td id="fecha_hora<?php echo $cod_info_factura_venta;?>" style="text-align:center"><?php echo $fecha_hora?></td>
<td id="excel<?php echo $cod_info_factura_venta;?>" style="text-align:center"><a href="../admin/ver_lista_info_factura_venta_version_excel.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>"><img src="../imagenes/excel.png" class="img-polaroid" alt=""></a></td>
<td id="imp<?php echo $cod_info_factura_venta;?>" style="text-align:center"><a href="../admin/ver_factura_venta_pdf.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>" target="_blank"><img src="../imagenes/imprimir_peq.png" class="img-polaroid" alt=""></a></td>
<td id="lista<?php echo $cod_info_factura_venta;?>" style="text-align:center"><a href="../admin/ver_lista_medicamento_laboratorio_version_pdf.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta?>" target="_blank"><img src="../imagenes/ver_lista_peq.png" class="img-polaroid" alt=""></a></td>
</tr id="<?php echo $cod_info_factura_venta;?>">
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
        var cod_info_factura_venta = $(this).parent().attr('data');
        var dataString = 'llave='+cod_info_factura_venta+'&'+'tab='+'<?php echo $tab ?>'+'&'+'campo='+'<?php echo $campo ?>'+'&'+'tipo='+'<?php echo $tipo ?>';

        $.ajax({
            type: "POST",
            url: "../admin/eliminar_ajax.php",
            data: dataString,
            success: function() {           
                $('#eliminar-ok').empty();
                $('#eliminar-ok').append('<div align="center" class="correcto">Se ha eliminado correctamente el codigo = '+cod_info_factura_venta+'.</div>').fadeIn("slow");
                $('#'+parent).fadeOut("slow");
                $('#cod_info_factura_'+cod_info_factura_venta).fadeOut("slow");
                $('#cod_factura'+cod_info_factura_venta).fadeOut("slow");
                $('#nombre_empresa'+cod_info_factura_venta).fadeOut("slow");
                $('#fecha_anyo'+cod_info_factura_venta).fadeOut("slow");
                $('#fecha_hora'+cod_info_factura_venta).fadeOut("slow");
                $('#nombre_tipo_producto'+cod_info_factura_venta).fadeOut("slow");
                $('#edit'+cod_info_factura_venta).fadeOut("slow");
                $('#excel'+cod_info_factura_venta).fadeOut("slow");
                $('#imp'+cod_info_factura_venta).fadeOut("slow");
                $('#lista'+cod_info_factura_venta).fadeOut("slow");
                $('#tr'+cod_info_factura_venta).fadeOut("slow");
                //$('#'+parent).remove();
            }
        });
    });

});
</script>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>