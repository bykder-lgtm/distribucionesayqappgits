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
<a href="#"><h4>Cuentas por Pagar</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$cod_tercero            = intval($_GET['cod_tercero']);
$pagina_local           = $_SERVER['PHP_SELF'];
if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = "../admin/cuentas_pagar_detalle_factura_caja_registradora.php"; }

$calcular_datos_cuenta_pagar = "SELECT identificacion_tercero, nombre1_tercero, apellido1_tercero, total_monto_deuda_cuenta_pagar, total_subtotal_cuenta_pagar, total_abonado_cuenta_pagar 
FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_datos_cuenta_pagar = mysqli_query($conectar, $calcular_datos_cuenta_pagar);
$datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar);

$total_monto_deuda_cuenta_pagar                    = $datos_cuenta_pagar['total_monto_deuda_cuenta_pagar'];
$total_subtotal_cuenta_pagar                       = $datos_cuenta_pagar['total_subtotal_cuenta_pagar'];
$total_abonado_cuenta_pagar                        = $datos_cuenta_pagar['total_abonado_cuenta_pagar'];
$identificacion_tercero                            = $datos_cuenta_pagar['identificacion_tercero'];
$nombre1_tercero                                   = $datos_cuenta_pagar['nombre1_tercero'];
$apellido1_tercero                                 = $datos_cuenta_pagar['apellido1_tercero'];
$nombre_cliente                                    = $nombre1_tercero.' '.$apellido1_tercero;
$cliente                                           = $nombre1_tercero.' '.$apellido1_tercero;

$monto_deuda_smtr                                  = 0;
$abonado_smtr                                      = 0;
$subtotal_smtr                                     = 0;
$cod_tipo_forma_pago                               = '1';
?>
<div class="table-responsive">

<table class="table table-striped">
<tr>
<td style="text-align:center"><strong><a href="../admin/cuentas_pagar_detalle_factura_caja_registradora.php?cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><font size="5px">REGRESAR</font></a></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="text-align:center"><strong><font size="6px">PROVEEDOR: <?php echo $cliente; ?></font></strong></td>
</tr>
</table>

<table class="table table-striped">
<tr>
<td nowrap align="left"><font size="6">TOTAL DEUDA:</font></td>
<td><font size="6"><?php echo number_format($total_monto_deuda_cuenta_pagar, 0, ",", "."); ?></font></td>
</tr>
<tr valign="baseline">
<td nowrap align="left"><font size="6">TOTAL PENDIENTE:</font></td>
<td><font size="6"><?php echo number_format($total_subtotal_cuenta_pagar, 0, ",", "."); ?></font></td>
</tr>
</table>

<br>

<form method="post" name="formulario_de_actualizacion" action="reg_abono_cuentas_pagar_por_tercero_reg.php">
<table class="table table-striped">
<tr>
<td style="text-align:center"><strong>VALOR ABONO</strong></td>
<td style="text-align:center"><strong>FORMA DE PAGO</strong></td>
<td style="text-align:center"><strong>COMENTARIO</strong></td>
<td style="text-align:center"><strong>DEPENDENCIA</strong></td>
<td style="text-align:center"><strong>FECHA PAGO</strong></td>
<tr>
<tr>
<td style="text-align:center"><input style="font-size:24px" type="number" name="abonado" value="" size="10" max="<?php echo $total_subtotal_cuenta_pagar; ?>" required></td>
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
<td style="text-align:center"><input style="font-size:24px" type="text" name="mensaje" value="" size="50"></td>
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
<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero; ?>">
<input type="hidden" name="pagina" value="<?php echo $pagina; ?>">

<tr valign="baseline">
<td nowrap align="right">&nbsp;</td>
<td bordercolor="1"><input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td>
<input type="hidden" name="insertar_datos" value="formulario">
</tr>
</form>

<table class="table table-striped">
<tr>
<td style="text-align: center;"><strong>ABONOS</strong></td>
<td style="text-align: center;"><strong>PAGO A</strong></td>
<td style="text-align: center;"><strong>MENSAJE</strong></td>
<td style="text-align: center;"><strong>FORMA PAGO</strong></td>
<td style="text-align: center;"><strong>FECHA</strong></td>
<td style="text-align: center;"><strong>HORA</strong></td>
<td style="text-align: center;"><strong>ID</strong></td>
</tr>
<?php
$sql = "SELECT * FROM tbl15_cuentas_pagar_abonos WHERE (cod_tercero = '$cod_tercero') ORDER BY cod_cuentas_pagar_abonos DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

    $cod_cuentas_pagar_abonos  = $datos['cod_cuentas_pagar_abonos'];
    $abonado                    = $datos['abonado'];
    $cuenta                     = $datos['cuenta'];
    $mensaje                    = $datos['mensaje'];
    $fecha_pago                 = $datos['fecha_pago'];
    $hora                       = $datos['hora'];
    $cod_dependencia            = $datos['cod_dependencia'];
    $cod_tipo_forma_pago        = $datos['cod_tipo_forma_pago'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];
?>
<tr>
<td style="text-align: center;"><font size="4px"><?php echo number_format($abonado, 0, ",", "."); ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $cuenta; ?></font></td>
<td style="text-align: left;"><font size="4px"><?php echo $mensaje; ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $nombre_tipo_forma_pago; ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $fecha_pago; ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $hora; ?></font></td>
<td style="text-align: center;"><font size="4px"><?php echo $cod_cuentas_pagar_abonos; ?></font></td>
</tr>
<?php } ?>
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
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>