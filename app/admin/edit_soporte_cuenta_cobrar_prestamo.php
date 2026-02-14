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
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<!--
<div class="breadcrumbs">
<a href="#"><h4>Cuentas por Cobrar</a>
</div>
-->
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_cuentas_cobrar             = intval($_GET['cod_cuentas_cobrar']);
$cod_tercero                    = intval($_GET['cod_tercero']);
$cod_factura                    = intval($_GET['cod_factura']);

//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                     = date("Ymd");
$hora_impr                      = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_consulta_cliente = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_cliente = mysqli_query($conectar, $sql_consulta_cliente) or die(mysqli_error($conectar));
$total_cliente = mysqli_fetch_assoc($consulta_cliente);

$identificacion_tercero         = $total_cliente['identificacion_tercero'];
$nombre1_tercero                = $total_cliente['nombre1_tercero'];
$nombre2_tercero                = $total_cliente['nombre2_tercero'];
$apellido1_tercero              = $total_cliente['apellido1_tercero'];
$apellido2_tercero              = $total_cliente['apellido2_tercero'];
$nombre_cliente                 = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;
$cliente                        = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

$monto_deuda_smtr       = 0;
$abonado_smtr           = 0;
$subtotal_smtr          = 0;

$sql_total_facturas = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta,
tbl15_cuentas_cobrar.monto_deuda_sin_interes, tbl15_cuentas_cobrar.subtotal_sin_interes, tbl15_cuentas_cobrar.numero_cuota, tbl15_cuentas_cobrar.monto_cuota, 
tbl15_cuentas_cobrar.monto_cuota_sin_interes, tbl15_cuentas_cobrar.interes_ptj, tbl15_cuentas_cobrar.monto_cuota_interes,
tbl15_cuentas_cobrar.nombre_tipo_cobro 
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_cuentas_cobrar='$cod_cuentas_cobrar') ORDER BY tbl15_cuentas_cobrar.fecha_invert DESC";
$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
$total_facturas = mysqli_num_rows($consulta_total_facturas);
$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

$cod_factura                    = $datos_total_facturas['cod_factura'];
$monto_deuda                    = $datos_total_facturas['monto_deuda'];
$monto_deuda_sin_interes        = $datos_total_facturas['monto_deuda_sin_interes'];
$subtotal                       = $datos_total_facturas['subtotal'];
$subtotal_sin_interes           = $datos_total_facturas['subtotal_sin_interes'];
$numero_cuota                   = $datos_total_facturas['numero_cuota'];
$monto_cuota                    = $datos_total_facturas['monto_cuota'];
$monto_cuota_sin_interes        = $datos_total_facturas['monto_cuota_sin_interes'];
$interes_ptj                    = $datos_total_facturas['interes_ptj'];
$monto_cuota_interes            = $datos_total_facturas['monto_cuota_interes'];
$nombre_tipo_cobro              = $datos_total_facturas['nombre_tipo_cobro'];
$abonado                        = $datos_total_facturas['abonado'];
$cod_factura_strpad             = str_pad($cod_factura, 4, "0", STR_PAD_LEFT);
?>
<div class="table-responsive">

<table class="table table-striped">
<tr>
<td style="text-align:center"><strong><a href="../admin/cuentas_cobrar_abonos_prestamo.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><font size="3px">REGRESAR</font></a></strong></td>
</tr>
<tr>
<td style="text-align: center;"><strong><font size="4">TERCERO: <?php echo $cliente;?><br><br>
</tr>
</table>

<table class="table table-striped">
<tr>
<th style="text-align: center;"><font size='3'>TOTAL PRESTAMO</font></th>
<th style="text-align: center;"><font size='3'>% INTERES</font></th>
<th style="text-align: center;"><font size='3'>TOTAL PRESTAMO + INTERES</font></th>
<th style="text-align: center;"><font size='3'># CUOTAS</font></th>
<th style="text-align: center;"><font size='3'>VALOR CUOTA</font></th>
<th style="text-align: center;"><font size='3'>TOTAL ABONADO</font></th>
<th style="text-align: center;"><font size='3'>TOTAL PENDIENTE</font></th>
</tr>
<tr>
<td style="text-align: center;"><font size='3'><?php echo number_format($monto_deuda_sin_interes, 0, ",", ".")?></font></a></td>
<th style="text-align: center;"><font size='3'><?php echo $interes_ptj?></font></a></th>
<th style="text-align: center;"><font size='3'><?php echo number_format($monto_deuda, 0, ",", ".")?></font></a></th>
<th style="text-align: center;"><font size='3'><?php echo $numero_cuota?></font></a></th>
<th style="text-align: center;"><font size='3'><?php echo number_format($monto_cuota, 0, ",", ".")?></font></a></th>
<th style="text-align: center;"><font size='3'><?php echo number_format($abonado, 0, ",", ".");?></font></th>
<th style="text-align: center;"><font size='3'><?php echo number_format($subtotal, 0, ",", "."); ?></font></th>
</tr>
</table>

<br>
<form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/edit_soporte_cuenta_cobrar_prestamo_reg.php">
<table class="table table-striped">
<tr>
<th style="text-align:center">CARGAR SOPORTE</th>
</tr>
<tr>
<td style="text-align:center"><input type="file" name="url_img1" id="url_img1" required></td>
</tr>
</table>
<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_cuentas_cobrar" value="<?php echo $cod_cuentas_cobrar; ?>">
<input type="hidden" name="cod_factura" value="<?php echo $cod_factura; ?>">
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero; ?>">
<tr valign="baseline">
<td nowrap align="right">&nbsp;</td>
<td bordercolor="1"><input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
<input type="hidden" name="insertar_datos" value="formulario">
</tr>
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