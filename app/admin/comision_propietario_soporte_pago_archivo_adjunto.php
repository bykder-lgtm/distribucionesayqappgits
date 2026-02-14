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
$cod_cuentas_cobrar_factura_comision_propietario      = intval($_GET['cod_cuentas_cobrar_factura_comision_propietario']);
$cod_cuentas_cobrar_alerta                            = intval($_GET['cod_cuentas_cobrar_alerta']);
$cod_cuentas_cobrar                                   = intval($_GET['cod_cuentas_cobrar']);
$cod_tercero                                          = intval($_GET['cod_tercero']);
$cod_factura                                          = intval($_GET['cod_factura']);
$pagina                                               = addslashes($_GET['pagina']);
$palabra                                              = '';
$pagina_redirect                                      = $pagina.'?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&cod_factura='.$cod_factura.'&pagina='.$pagina.'&palabra='.$palabra;
?>
<div id="contentOuterSeparator"></div>
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
$fecha_impr                     = date("Ymd");
$hora_impr                      = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$monto_deuda_smtr       = 0;
$abonado_smtr           = 0;
$subtotal_smtr          = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_cuentas_cobrar_factura_comision_propietario = "SELECT * FROM tbl15_cuentas_cobrar_factura_comision_propietario WHERE (cod_cuentas_cobrar_factura_comision_propietario = '$cod_cuentas_cobrar_factura_comision_propietario')";
$consulta_cuentas_cobrar_factura_comision_propietario = mysqli_query($conectar, $sql_cuentas_cobrar_factura_comision_propietario) or die(mysqli_error($conectar));
$datos_cuentas_cobrar_factura_comision_propietarior = mysqli_fetch_assoc($consulta_cuentas_cobrar_factura_comision_propietario);

$cod_cuentas_cobrar                         = $datos_cuentas_cobrar_factura_comision_propietarior['cod_cuentas_cobrar'];
$cod_producto                               = $datos_cuentas_cobrar_factura_comision_propietarior['cod_producto'];
$cod_factura                                = $datos_cuentas_cobrar_factura_comision_propietarior['cod_factura'];
$total_recibido                             = $datos_cuentas_cobrar_factura_comision_propietarior['total_recibido'];
$mensaje                                    = $datos_cuentas_cobrar_factura_comision_propietarior['mensaje'];
$fecha_pago                                 = $datos_cuentas_cobrar_factura_comision_propietarior['fecha_pago'];
$url_img_orig_producto                      = $datos_cuentas_cobrar_factura_comision_propietarior['url_img_orig_producto'];
$cod_tipo_forma_pago                        = $datos_cuentas_cobrar_factura_comision_propietarior['cod_tipo_forma_pago'];
$mensaje                                    = $datos_cuentas_cobrar_factura_comision_propietarior['mensaje'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_cuentas_cobrar = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_cuentas_cobrar = mysqli_query($conectar, $sql_cuentas_cobrar) or die(mysqli_error($conectar));
$datos_cuentas_cobrar = mysqli_fetch_assoc($consulta_cuentas_cobrar);
 	
$cod_tercero                                = $datos_cuentas_cobrar['cod_tercero'];
$cod_tercero_propietario                    = $datos_cuentas_cobrar['cod_tercero_propietario'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_propietario = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_propietario'";
$consulta_propietario = mysqli_query($conectar, $sql_consulta_propietario) or die(mysqli_error($conectar));
$total_propietario = mysqli_fetch_assoc($consulta_propietario);

$identificacion_tercero_propietario         = $total_propietario['identificacion_tercero'];
$nombre1_tercero_propietario                = $total_propietario['nombre1_tercero'];
$nombre2_tercero_propietario                = $total_propietario['nombre2_tercero'];
$apellido1_tercero_propietario              = $total_propietario['apellido1_tercero'];
$apellido2_tercero_propietario              = $total_propietario['apellido2_tercero'];
$nombre_cliente_propietario                 = $nombre1_tercero_propietario.' '.$nombre2_tercero_propietario.' '.$apellido1_tercero_propietario.' '.$apellido2_tercero_propietario;
$cliente_propietario                        = $nombre1_tercero_propietario.' '.$nombre2_tercero_propietario.' '.$apellido1_tercero_propietario.' '.$apellido2_tercero_propietario;
$nombre_tipo_identificacion_propietario     = $total_propietario['nombre_tipo_identificacion'];
$telefono1_tercero_propietario              = $total_propietario['telefono1_tercero'];
$correo_tercero_propietario                 = $total_propietario['correo_tercero'];
$nombre_pais_propietario                    = $total_propietario['nombre_pais'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_producto = "SELECT cod_producto_barra, nombre_producto, nombre_tipo_producto, direccion_producto, descripcion_producto FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$cod_producto_barra                         = $datos_producto['cod_producto_barra'];
$nombre_producto                            = $datos_producto['nombre_producto'];
$nombre_tipo_producto                       = $datos_producto['nombre_tipo_producto'];
$direccion_producto                         = $datos_producto['direccion_producto'];
$descripcion_producto                       = $datos_producto['descripcion_producto'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);
 	
$nombre_tipo_forma_pago                    = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
?>
<div class="table-responsive">

<form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/comision_propietario_soporte_pago_archivo_adjunto_reg.php">
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<legend>INFORMACION DEL PROPIETARIO - CARGAR SOPORTE DE PAGO</legend>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">NOMBRE PROPIETARIO</th>
            <th style="text-align:center">TIPO DOCUMENTO</th>
            <th style="text-align:center">NUMERO DOCUMENTO</th>
            <th style="text-align:center">TELEFONO / CELULAR</th>
            <th style="text-align:center">CORREO ELECTRONICO</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre1_tercero_propietario ?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_identificacion_propietario ?></td>
            <td style="text-align:center"><?php echo $identificacion_tercero_propietario ?></td>
            <td style="text-align:center"><?php echo $telefono1_tercero_propietario ?></td>
            <td style="text-align:center"><?php echo $correo_tercero_propietario ?></td>
        </tr>
    </thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">TIPO INMUEBLE</th>
            <th style="text-align:center">CODIGO INMUEBLE</th>
            <th style="text-align:center">NOMBRE INMUEBLE</th>
            <th style="text-align:center">DIRECCION INMUEBLE</th>
            <th style="text-align:center">DESCRIPCION INMUEBLE</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $nombre_tipo_producto ?></td>
            <td style="text-align:center"><?php echo $cod_producto_barra ?></td>
            <td style="text-align:center"><?php echo $nombre_producto ?></td>
            <td style="text-align:center"><?php echo $direccion_producto ?></td>
            <td style="text-align:center"><?php echo $descripcion_producto ?></td>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">FACTURA DE VENTA N°</th>
            <th style="text-align:center">FORMA DE PAGO</th>
            <th style="text-align:center">COMENTARIO</th>
            <th style="text-align:center">CONSIGADO/EFECTIVO</th>
            <th style="text-align:center">FECHA PAGO</th>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo $cod_cuentas_cobrar_factura_comision_propietario ?></td>
            <td style="text-align:center"><?php echo $nombre_tipo_forma_pago ?></td>
            <td style="text-align:center"><?php echo $mensaje ?></td>
            <td style="text-align:center"><?php echo number_format($total_recibido, 0, ",", ".") ?></td>
            <td style="text-align:center"><?php echo $fecha_pago ?></td>
        </tr>
    </thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<fieldset>
<table border="1" class="table table-responsive">
    <thead>
        <tr>
            <th style="text-align:center">CARGAR SOPORTE PAGO</th>
			<?php if ($url_img_orig_producto) { ?><th style="text-align:center">VER SOPORTE PAGO</th><?php } ?>
			<th style="text-align:center">GUARDAR</th>
         </tr>
        <tr>
            <td style="text-align:center"><input type="file" name="url_img1" id="url_img1" required></td>
			<?php if ($url_img_orig_producto) { ?><td style="text-align:center"><a href="<?php echo $url_img_orig_producto ?>" target="_blank"><img src="../imagenes/pdf_peq.png" class="img-polaroid" alt=""></a></td><?php } ?>
			<td style="text-align:center"><input type="image" src="../imagenes/guardar.png" name="vender" value="Guardar" /></td>
        </tr>
    </thead>
</table>
</fieldset>

<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_cuentas_cobrar_factura_comision_propietario" value="<?php echo $cod_cuentas_cobrar_factura_comision_propietario; ?>">
<input type="hidden" name="cod_cuentas_cobrar" value="<?php echo $cod_cuentas_cobrar; ?>">
<input type="hidden" name="cod_cuentas_cobrar_alerta" value="<?php echo $cod_cuentas_cobrar_alerta; ?>">
<input type="hidden" name="cod_factura" value="<?php echo $cod_factura; ?>">
<input type="hidden" name="numero_alerta" value="<?php echo $numero_alerta; ?>">
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero; ?>">
<input type="hidden" name="cliente" value="<?php echo $nombre1_tercero_inquilino; ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
<input type="hidden" name="insertar_datos" value="formulario">
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