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
$cod_cuentas_cobrar_abonos      = intval($_GET['cod_cuentas_cobrar_abonos']);
$cod_cuentas_cobrar             = intval($_GET['cod_cuentas_cobrar']);
$cod_tercero                    = intval($_GET['cod_tercero']);
$cod_factura                    = intval($_GET['cod_factura']);

$pagina                         = $_SERVER['PHP_SELF'];

$calcular_datos_cuenta_cobrar_abono = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_abonos='$cod_cuentas_cobrar_abonos')";
$consulta_datos_cuenta_cobrar_abono = mysqli_query($conectar, $calcular_datos_cuenta_cobrar_abono) or die(mysqli_error($conectar));
$datos_cuenta_cobrar_abono = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar_abono);

$numero_alerta                  = $datos_cuenta_cobrar_abono['numero_alerta'];
$abonado                        = $datos_cuenta_cobrar_abono['abonado'];
$fecha_pago                     = $datos_cuenta_cobrar_abono['fecha_pago'];
$url_img_orig_producto          = $datos_cuenta_cobrar_abono['url_img_orig_producto'];
$url_img_min_producto           = $datos_cuenta_cobrar_abono['url_img_min_producto'];

$calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar='$cod_cuentas_cobrar')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$monto_deuda                    = $datos_cuenta_cobrar['monto_deuda'];
$subtotal                       = $datos_cuenta_cobrar['subtotal'];

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
?>
<div class="table-responsive">

<table class="table table-striped">
<tr>
<td style="text-align:center"><strong><a href="../admin/cuentas_cobrar_abonos_prestamo.php?cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar;?>&cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><font size="3px">REGRESAR</font></a></strong></td>
</tr>
<tr>
<td style="text-align:center"><strong><font size="3px">TERCERO: <?php echo $cliente; ?></font></strong></td>
</tr>
<tr>
<td style="text-align:center"><strong><font size="3px">FACTURA: <?php echo $cod_factura; ?></font></strong></td>
</tr>
<tr>
<td style="text-align:center"><strong><font size="3px"># CUOTA: <?php echo $numero_alerta; ?></font></strong></td>
</tr>
<tr>
<td style="text-align:center"><strong><font size="3px">VALOR ABONADO: <?php echo number_format($abonado, 0, ",", "."); ?></font></strong></td>
</tr>
<!--
<td><a href="../admin/productos_fiados.php?cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><center><strong><font color='yellow' size="5px">VER PRODUCTOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></strong></center></a></td>
<td><a href="../admin/cuentas_cobrar_abonos.php?cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><center><strong><font color='yellow' size="5px">VER ABONOS</font></strong></center></a></td>
-->
</table>

<br>
<form name="formulario_de_actualizacion" method="post" enctype="multipart/form-data" action="../admin/edit_soporte_cuenta_cobrar_abonos_prestamo_reg.php">
<table class="table table-striped">
<tr>
<th style="text-align:center">CARGAR SOPORTE</th>
</tr>
<tr>
<td style="text-align:center"><input type="file" name="url_img1" id="url_img1" required></td>
</tr>
</table>
<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_cuentas_cobrar_abonos" value="<?php echo $cod_cuentas_cobrar_abonos; ?>">
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