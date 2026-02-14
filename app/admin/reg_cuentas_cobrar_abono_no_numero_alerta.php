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
$cod_factura                    = intval($_GET['cod_factura']);
$cod_tercero                    = intval($_GET['cod_tercero']);
$cliente                        = addslashes($_GET['cliente']);
$pagina                         = $_SERVER['PHP_SELF'];

$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda  AS total_venta, tbl15_tercero.nombre1_tercero, tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.apellido2_tercero, 
Sum(tbl15_cuentas_cobrar_abonos.abonado) AS total_abonado, tbl15_cuentas_cobrar.monto_cuota
FROM tbl15_cuentas_cobrar_abonos RIGHT JOIN (tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero) 
ON tbl15_cuentas_cobrar_abonos.cod_cuentas_cobrar = tbl15_cuentas_cobrar.cod_cuentas_cobrar
GROUP BY tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, tbl15_cuentas_cobrar.monto_deuda, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero HAVING (((tbl15_cuentas_cobrar.cod_cuentas_cobrar)='$cod_cuentas_cobrar'))";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$total_venta                    = $datos_cuenta_cobrar['total_venta'];
$total_abonado                  = $datos_cuenta_cobrar['total_abonado'];
$monto_cuota                    = $datos_cuenta_cobrar['monto_cuota'];
$total_deuda                    = $total_venta - $total_abonado;
$cliente                        = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['nombre2_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero']." ".$datos_cuenta_cobrar['apellido2_tercero'];
$cod_tipo_forma_pago            = '1';

if (isset($_GET['cod_cuentas_cobrar_alerta'])) { 
$cod_cuentas_cobrar_alerta      = intval($_GET['cod_cuentas_cobrar_alerta']);
$numero_alerta                  = intval($_GET['numero_alerta']);
} else { 
$calcular_datos_cuenta_cobrar = "SELECT MAX(numero_alerta) AS numero_alerta FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$numero_alerta           = $datos_cuenta_cobrar['numero_alerta']+1;

$calcular_datos_cuenta_cobrar = "SELECT cod_cuentas_cobrar_alerta FROM tbl15_cuentas_cobrar_alerta 
WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (numero_alerta = '$numero_alerta')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$cod_cuentas_cobrar_alerta           = $datos_cuenta_cobrar['cod_cuentas_cobrar_alerta'];
}
?>
<div class="table-responsive">

<table class="table table-striped">
<tr>
<td style="text-align:center"><strong><a href="../admin/cuentas_cobrar_abonos.php?cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><font size="3px">REGRESAR</font></a></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
<td style="text-align:center"><strong><font size="3px">VALOR CUOTA: <?php echo number_format($monto_cuota, 0, ",", "."); ?></font></strong></td>
</tr>
<!--
<td><a href="../admin/productos_fiados.php?cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><center><strong><font color='yellow' size="5px">VER PRODUCTOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></strong></center></a></td>
<td><a href="../admin/cuentas_cobrar_abonos.php?cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><center><strong><font color='yellow' size="5px">VER ABONOS</font></strong></center></a></td>
-->
</table>

<table class="table table-striped">
<tr>
<td style="text-align:center"><font size="3"><strong>TOTAL DEUDA:</strong></font></td>
<td style="text-align:left"><font size="3"><strong><?php echo number_format($total_venta, 0, ",", "."); ?></strong></font></td>
</tr>
<tr>
<td style="text-align:center"><font size="3"><strong>TOTAL PENDIENTE:</strong></font></td>
<td style="text-align:left"><font size="3"><strong><?php echo number_format($total_deuda, 0, ",", "."); ?></strong></font></td>
</tr>
</table>

<br>

<form method="post" name="formulario_de_actualizacion" action="../admin/reg_cuentas_cobrar_abono_reg.php">
<table class="table table-striped">
<tr>
<td style="text-align:center"><strong>VALOR ABONO</strong></td>
</tr>
<tr>
<td style="text-align:center"><input style="font-size:24px" class="input-block-level" type="number" name="abonado" value="" size="10"  required></td>
</tr>
<tr>
<td style="text-align:center"><strong>FORMA DE PAGO</strong></td>
</tr>
<tr>
<td style="text-align:center">
    <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="input-block-level" data-show-subtext="true" data-live-search="true" required>
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
</tr>
<tr>
<td style="text-align:center"><strong>COMENTARIO</strong></td>
</tr>
<tr>
<td style="text-align:center"><input style="font-size:24px" class="input-block-level" type="text" name="mensaje" value="" size="50"></td>
</tr>
<tr>
<td style="text-align:center"><strong>FECHA PAGO</strong></td>
</tr>
<tr>
<td style="text-align:center"><input style="font-size:24px" class="input-block-level" type="date" name="fecha_pago" value="<?php echo date("Y-m-d");?>" size="10" required></td>
</tr>
</table>
<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_cuentas_cobrar" value="<?php echo $cod_cuentas_cobrar; ?>">
<input type="hidden" name="cod_factura" value="<?php echo $cod_factura; ?>">
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero; ?>">
<input type="hidden" name="numero_alerta" value="<?php echo $numero_alerta; ?>">
<input type="hidden" name="cod_cuentas_cobrar_alerta" value="<?php echo $cod_cuentas_cobrar_alerta; ?>">
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>