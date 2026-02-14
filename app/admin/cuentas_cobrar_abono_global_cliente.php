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
<a href="#"><h4>Cuentas por Cobrar</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$edicion_de_formulario   = $_SERVER['PHP_SELF'];
$cod_cuentas_cobrar_get  = intval($_GET['cod_cuentas_cobrar']);
$cod_tercero             = intval($_GET['cod_tercero']);
$pagina                  = $_SERVER['PHP_SELF'];

$calcular_datos_cuenta_cobrar = "SELECT tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_cuentas_cobrar.cod_tercero, 
Sum(tbl15_cuentas_cobrar.monto_deuda) AS monto_deuda, Sum(tbl15_cuentas_cobrar.subtotal) AS 
subtotal, Sum(tbl15_cuentas_cobrar.abonado) AS abonado, tbl15_tercero.direccion_tercero, 
tbl15_tercero.nombre_ciudad, tbl15_tercero.telefono1_tercero, tbl15_tercero.identificacion_tercero
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero
WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$monto_deuda             = $datos_cuenta_cobrar['monto_deuda'];
$subtotal                = $datos_cuenta_cobrar['subtotal'];
$abonado                 = $datos_cuenta_cobrar['abonado'];
$cod_tercero             = $datos_cuenta_cobrar['cod_tercero'];
//$cod_factura             = $datos_cuenta_cobrar['cod_factura'];
$cliente                 = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
$direccion_tercero       = $datos_cuenta_cobrar['direccion_tercero'];
$telefono1_tercero       = $datos_cuenta_cobrar['telefono1_tercero'];
$nombre_ciudad           = $datos_cuenta_cobrar['nombre_ciudad'];
$identificacion_tercero  = $datos_cuenta_cobrar['identificacion_tercero'];
$cliente                 = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];

//$calcular_abonado = "SELECT Sum(abonado) AS abonado FROM cuentas_cobrar_abonos WHERE cod_tercero = '$cod_tercero'";
//$consulta_abonado = mysqli_query($calcular_abonado, $conectar) or die(mysqli_error($conectar));
//$datos_abonado = mysqli_fetch_assoc($consulta_abonado);

//$abonado               = $datos_abonado['abonado'];
$cod_tipo_forma_pago     = '1';
?>
<div class="table-responsive">
<table class="table table-striped">
<tr>
<td><strong><a href="../admin/cuentas_cobrar_detalle_factura.php?cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><font size="5px">REGRESAR</font></a></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td><strong><font size="6px">CLIENTE: <?php echo $cliente; ?></font></strong></td>
</tr>
<!--
<td><a href="../admin/productos_fiados.php?cod_factura=<?php //echo $cod_factura;?>&cod_tercero=<?php //echo $cod_tercero;?>&cliente=<?php //echo $cliente;?>"><center><strong><font color='yellow' size="5px">VER PRODUCTOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></strong></center></a></td>
<td><a href="../admin/cuentas_cobrar_abonos.php?cod_factura=<?php //echo $cod_factura;?>&cod_tercero=<?php //echo $cod_tercero;?>&cliente=<?php //echo $cliente;?>"><center><strong><font color='yellow' size="5px">VER ABONOS</font></strong></center></a></td>
-->
</table>

<table class="table table-striped">
<tr valign="baseline">
<td nowrap align="left"><font size="6">TOTAL DEUDA:</font></td>
<td><font size="6"><?php echo number_format($monto_deuda, 0, ",", "."); ?></font></td>
</tr>
<tr>
<td nowrap align="left"><font size="6">TOTAL ABONADO:</font></td>
<td><font size="6"><?php echo number_format($abonado, 0, ",", "."); ?></font></td>
</tr>
<tr valign="baseline">
<td nowrap align="left"><font size="6">TOTAL PENDIENTE:</font></td>
<td><font size="6"><?php echo number_format($subtotal, 0, ",", "."); ?></font></td>
</tr>
</table>

<form method="post" name="formulario_de_actualizacion" action="cuentas_cobrar_abono_global_cliente_reg.php">
<table class="table table-striped">
<tr>
<td style="text-align:center"><strong>VALOR ABONO GLOBAL</strong></td>
<td style="text-align:center"><strong>FORMA DE PAGO</strong></td>
<td style="text-align:center"><strong>COMENTARIO</strong></td>
<td style="text-align:center"><strong>DEPENDENCIA</strong></td>
<td style="text-align:center"><strong>FECHA PAGO</strong></td>
</tr>
<tr>
<td style="text-align:center"><input style="font-size:24px" type="text" name="abonado" value="" size="10"  required autofocus></td>
<td style="text-align:center">
    <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
        <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo  ""; }
        $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_tipo_forma_pago'];
        $nombre = $datos2['nombre_tipo_forma_pago'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>
<td style="text-align:center"><input style="font-size:24px" type="text" name="mensaje" value="Abono global" size="50"></td>
<td style="text-align:center">
    <select name="cod_dependencia" id="cod_dependencia" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
        <?php if (isset($cod_dependencia)) { echo ""; } else { echo  ""; }
        $consulta2_sql = "SELECT cod_dependencia, nombre_dependencia FROM tbl15_dependencia WHERE (cod_estado = '1') ORDER BY cod_dependencia ASC";
        $consulta2 = mysqli_query($conectar, $consulta2_sql);
        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
        if(isset($cod_dependencia) AND $cod_dependencia == $datos2['cod_dependencia']) {
        $seleccionado = "selected"; } else { $seleccionado = ""; }
        $codigo = $datos2['cod_dependencia'];
        $nombre = $datos2['nombre_dependencia'];
        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
    </select>
</td>
<td style="text-align:center"><input style="font-size:24px" type="date" name="fecha_pago" value="<?php echo date("Y-m-d");?>" size="10" required></td>
</tr>
</table>
<?php 
$monto_deuda_smtr       = 0;
$abonado_smtr           = 0;
$subtotal_smtr          = 0;

$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero') AND (tbl15_cuentas_cobrar.subtotal > 0) ORDER BY tbl15_cuentas_cobrar.subtotal ASC";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

$cod_cuentas_cobrar     = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
$cod_factura            = $datos_cuenta_cobrar['cod_factura'];
$cliente                = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
$monto_deuda            = $datos_cuenta_cobrar['monto_deuda'];
$abonado                = $datos_cuenta_cobrar['abonado'];
$subtotal               = $datos_cuenta_cobrar['subtotal'];
$mensaje                = $datos_cuenta_cobrar['mensaje'];
$fecha_pago             = $datos_cuenta_cobrar['fecha_pago'];
$vendedor               = $datos_cuenta_cobrar['vendedor'];
$monto_deuda_smtr       = $monto_deuda_smtr + $monto_deuda;
$abonado_smtr           = $abonado_smtr + $abonado;
$subtotal_smtr          = $subtotal_smtr + $subtotal;
?>
<input type="hidden" name="cod_cuentas_cobrar[]" id="<?php echo $cod_cuentas_cobrar;?>" value="<?php echo $cod_cuentas_cobrar;?>" size="10">
<input type="hidden" name="cod_factura[]" id="<?php echo $cod_factura;?>" value="<?php echo $cod_factura;?>" size="10">
<?php } ?>
<tr valign="baseline">
<td nowrap align="right">&nbsp;</td>
<input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
<input type="hidden" name="insertar_datos" value="formulario">
<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero; ?>">
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>