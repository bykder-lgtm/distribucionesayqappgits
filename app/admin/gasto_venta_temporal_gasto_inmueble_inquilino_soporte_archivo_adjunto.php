<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/json2.min.js"></script>
<script type="text/javascript" src="js/jquery.number.js"></script>

<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

<script type="text/javascript">
$(function(){
// Set up the number formatting.
$('#abonado_number').on('change',function(){
//console.log('Change event.');
var abonado_number = $('#abonado_number').val();
$('#the_number').text( abonado_number !== '' ? abonado_number : '(empty)' );
});
//$('#abonado').change(function(){ console.log('Second change event...'); });
$('#abonado_number').number( true, 0 );

$("#abonado_number").keyup(function () {
    var abonado = $(this).val();
    $("#abonado").val(abonado);
});

});
</script>

</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php 
$pagina                         = $_SERVER['PHP_SELF'];
$cod_administrador_sesion       = $cod_administrador;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_gasto_inmueble_inquilino_venta_temporal    = intval($_GET['cod_gasto_inmueble_inquilino_venta_temporal']);
$cod_info_gasto_inmueble_inquilino_venta        = intval($_GET['cod_info_gasto_inmueble_inquilino_venta']);
$cod_caja_virtual                               = addslashes($_GET['cod_caja_virtual']);
$cuenta                                         = addslashes($_GET['cuenta']);
$pagina                                         = addslashes($_GET['pagina']);
$pagina_redirect                                = $pagina.'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_gasto_inmueble_inquilino_venta='.$cod_info_gasto_inmueble_inquilino_venta;

$sql_gasto_inmueble_inquilino_venta_temporal = "SELECT * FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cod_gasto_inmueble_inquilino_venta_temporal = '$cod_gasto_inmueble_inquilino_venta_temporal')";
$consulta_gasto_inmueble_inquilino_venta_temporal = mysqli_query($conectar, $sql_gasto_inmueble_inquilino_venta_temporal);
$datos_gasto_inmueble_inquilino_venta_temporal = mysqli_fetch_assoc($consulta_gasto_inmueble_inquilino_venta_temporal);

$und_venta                                       = $datos_gasto_inmueble_inquilino_venta_temporal['und_venta'];
$cod_gasto_inmueble                              = $datos_gasto_inmueble_inquilino_venta_temporal['cod_gasto_inmueble'];
$nombre_gasto_inmueble_detalle                   = $datos_gasto_inmueble_inquilino_venta_temporal['nombre_gasto_inmueble_detalle'];
$descripcion_gasto_inmueble_detalle              = $datos_gasto_inmueble_inquilino_venta_temporal['descripcion_gasto_inmueble_detalle'];
$precio_venta_producto                           = $datos_gasto_inmueble_inquilino_venta_temporal['precio_venta_producto'];
$precio_compra_producto                          = $datos_gasto_inmueble_inquilino_venta_temporal['precio_compra_producto'];
$fecha_gasto_inmueble_detalle                    = $datos_gasto_inmueble_inquilino_venta_temporal['fecha_gasto_inmueble_detalle'];
$cod_tipo_estado_incluido                        = $datos_gasto_inmueble_inquilino_venta_temporal['cod_tipo_estado_incluido'];
$cod_tipo_forma_pago                             = $datos_gasto_inmueble_inquilino_venta_temporal['cod_tipo_forma_pago'];
$url_img_orig_producto                           = $datos_gasto_inmueble_inquilino_venta_temporal['url_img_orig_producto'];
$cod_tercero                                     = $datos_gasto_inmueble_inquilino_venta_temporal['cod_tercero'];
$cod_factura                                     = $datos_gasto_inmueble_inquilino_venta_temporal['cod_factura'];
?>
<div class="container">
<div class="breadcrumbs">
<a class="btn btn-primary" href="<?php echo $pagina_redirect;?>">Regresar</a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_gasto_inmueble_inquilino_venta = "SELECT * FROM tbl15_info_gasto_inmueble_inquilino_venta WHERE cod_info_gasto_inmueble_inquilino_venta = '$cod_info_gasto_inmueble_inquilino_venta'";
$consulta_info_gasto_inmueble_inquilino_venta = mysqli_query($conectar, $sql_info_gasto_inmueble_inquilino_venta) or die(mysqli_error($conectar));
$datos_info_gasto_inmueble_inquilino_venta = mysqli_fetch_assoc($consulta_info_gasto_inmueble_inquilino_venta);

$cod_tercero                                = $datos_info_gasto_inmueble_inquilino_venta['cod_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_propietario = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_propietario = mysqli_query($conectar, $sql_consulta_propietario) or die(mysqli_error($conectar));
$total_propietario = mysqli_fetch_assoc($consulta_propietario);

$identificacion_tercero_propietario         = $total_propietario['identificacion_tercero'];
$nombre1_tercero_propietario                = $total_propietario['nombre1_tercero'];
$nombre2_tercero_propietario                = $total_propietario['nombre2_tercero'];
$apellido1_tercero_propietario              = $total_propietario['apellido1_tercero'];
$apellido2_tercero_propietario              = $total_propietario['apellido2_tercero'];
$nombre_cliente_propietario                 = $nombre1_tercero_propietario.' '.$nombre2_tercero_propietario.' '.$apellido1_tercero_propietario.' '.$apellido2_tercero_propietario;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>
<div class="table-responsive">

<form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/gasto_venta_temporal_gasto_inmueble_inquilino_soporte_archivo_adjunto_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CODIGO CONTRATO</th>
            <th style="text-align:center">INQUILINO</th>
            <?php if ($url_img_orig_producto <> '') { ?><th style="text-align:center">SOPORTE</th><?php } ?>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $cod_factura ?></td>
            <td style="text-align:center"><?php echo $nombre_cliente_propietario ?></td>
            <?php if ($url_img_orig_producto <> '') { ?><td style="text-align:center"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/adjuntar_archivo.png" class="img-polaroid" alt=""></a></td><?php } ?>          
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">NOMBRE CONCEPTO</th>
            <th style="text-align:center">OBSERVACION</th>
            <th style="text-align:center">COSTO ADMINISTRACION DE REPARACION (P.COMPRA)</th>
            <th style="text-align:center">COSTO FINAL (P.VENTA)</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre_gasto_inmueble_detalle ?></td>
            <td style="text-align:left"><?php echo $descripcion_gasto_inmueble_detalle ?></td>
            <td style="text-align:center"><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></td>
            <td style="text-align:center"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
        </tr>
    </thead>
</table>
</fieldset>

<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CARGAR SOPORTE</th>
			<?php if ($url_img_orig_producto) { ?><th style="text-align:center">VER SOPORTE</th><?php } ?>
         </tr>
        <tr>
            <td style="text-align:center"><input type="file" name="url_img1" id="url_img1" required></td>
			<?php if ($url_img_orig_producto) { ?><td style="text-align:center"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td><?php } ?>
        </tr>
    </thead>
</table>
</fieldset>


<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_gasto_inmueble_inquilino_venta_temporal" value="<?php echo $cod_gasto_inmueble_inquilino_venta_temporal; ?>">
<input type="hidden" name="cod_info_gasto_inmueble_inquilino_venta" value="<?php echo $cod_info_gasto_inmueble_inquilino_venta; ?>">
<input type="hidden" name="cod_caja_virtual" value="<?php echo $cod_caja_virtual; ?>">
<input type="hidden" name="cuenta" value="<?php echo $cuenta; ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
<input type="hidden" name="insertar_datos" value="formulario">

<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">GUARDAR</th>
        </tr>
        <tr>
            <td style="text-align:center"><input type="image" src="../imagenes/guardar.png" name="vender" value="Guardar" /></td>
        </tr>
    </thead>
</table>
</form>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>