<?php error_reporting(E_ALL ^ E_NOTICE);?>
<?php require_once('../conexiones/conexione.php');
require_once('../evitar_mensaje_error/error.php'); 
mysql_select_db($base_datos, $conectar);
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$cuenta_actual = addslashes($_SESSION['usuario']);
include ("../seguridad/seguridad_diseno_plantillas.php");

$edicion_de_formulario   = $_SERVER['PHP_SELF'];
$cod_tercero             = intval($_GET['cod_tercero']);
$pagina                  = $_SERVER['PHP_SELF'];

$calcular_datos_cuenta_cobrar = "SELECT tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_cuentas_cobrar.cod_tercero, 
Sum(tbl15_cuentas_cobrar.monto_deuda) AS monto_deuda, Sum(tbl15_cuentas_cobrar.subtotal) AS 
subtotal, Sum(tbl15_cuentas_cobrar.abonado) AS abonado, tbl15_tercero.direccion_tercero, 
tbl15_tercero.ciudad_tercero, tbl15_tercero.telefono1_tercero, tbl15_tercero.identificacion_tercero
FROM tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero
WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$monto_deuda             = $datos_cuenta_cobrar['monto_deuda'];
$subtotal                = $datos_cuenta_cobrar['subtotal'];
$abonado                 = $datos_cuenta_cobrar['abonado'];
$cod_tercero             = $datos_cuenta_cobrar['cod_tercero'];
$cod_factura             = $datos_cuenta_cobrar['cod_factura'];
$cliente                 = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
$direccion_tercero       = $datos_cuenta_cobrar['direccion_tercero'];
$telefono1_tercero       = $datos_cuenta_cobrar['telefono1_tercero'];
$ciudad_tercero          = $datos_cuenta_cobrar['ciudad_tercero'];
$identificacion_tercero  = $datos_cuenta_cobrar['identificacion_tercero'];
$cliente                 = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];

//$calcular_abonado = "SELECT Sum(abonado) AS abonado FROM cuentas_cobrar_abonos WHERE cod_tercero = '$cod_tercero'";
//$consulta_abonado = mysqli_query($calcular_abonado, $conectar) or die(mysqli_error($conectar));
//$datos_abonado = mysqli_fetch_assoc($consulta_abonado);

//$abonado               = $datos_abonado['abonado'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<title></title>
</head>
<body>
<center>

<table>
<td><strong><a href="../admin/cuentas_cobrar_detalle_factura.php?cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><font color='yellow' size="5px">REGRESAR</font></a></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<!--
<td><a href="../admin/productos_fiados.php?cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><center><strong><font color='yellow' size="5px">VER PRODUCTOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></strong></center></a></td>
<td><a href="../admin/cuentas_cobrar_abonos.php?cod_factura=<?php echo $cod_factura;?>&cod_tercero=<?php echo $cod_tercero;?>&cliente=<?php echo $cliente;?>"><center><strong><font color='yellow' size="5px">VER ABONOS</font></strong></center></a></td>
-->
</table>
<br><br>
<td><strong><font color='yellow' size="6px">CLIENTE: <?php echo $cliente; ?></font></strong></td><br>
<br>
<table style="text-align:center" width="50%">
<tr valign="baseline">
<td nowrap align="left"><font size="6">TOTAL DEUDA:</font></td>
<td><font size="6"><?php echo number_format($monto_deuda, 0, ",", "."); ?></font></td>
</tr>
<tr>
<td nowrap align="left"><font size="6">TOTAL ABONADO:</font></td>
<td><font size="6"><?php echo number_format($abonado, 0, ",", "."); ?></font></td>
</tr>
<tr valign="baseline">
<td nowrap align="left"><font color='yellow' size="6">DEUDA ACTUAL:</font></td>
<td><font color='yellow' size="6"><?php echo number_format($subtotal, 0, ",", "."); ?></font></td>
</tr>
</table>

<br>

<form method="post" name="formulario_de_actualizacion" action="cuentas_cobrar_abono_global_cliente_reg.php">
<table width="90%">
<tr>
<td style="text-align:center"><strong>VALOR ABONO GLOBAL</strong></td>
<td style="text-align:center"><strong>COMENTARIO</strong></td>
<td style="text-align:center"><strong>FECHA PAGO</strong></td>
</tr>
<tr>
<td style="text-align:center"><input style="font-size:24px" type="text" name="abonado" value="" size="10"  required autofocus></td>
<td style="text-align:center"><input style="font-size:24px" type="text" name="mensaje" value="Abono global" size="50"></td>
<td style="text-align:center"><input style="font-size:24px" type="text" name="fecha_pago" value="<?php echo date("d/m/Y");?>" size="10" required autofocus></td>
</tr>
</table>
<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="cod_tercero" value="<?php echo $cod_tercero; ?>">

<?php 
$monto_deuda_smtr       = 0;
$abonado_smtr           = 0;
$subtotal_smtr          = 0;

$calcular_datos_cuenta_cobrar = "SELECT cuentas_cobrar.cod_cuentas_cobrar, cuentas_cobrar.cod_factura, cuentas_cobrar.cod_tercero, 
cuentas_cobrar.monto_deuda, cuentas_cobrar.abonado, cuentas_cobrar.subtotal, tercero.nombre1_tercero, tercero.apellido1_tercero, 
cuentas_cobrar.mensaje, cuentas_cobrar.fecha_pago, cuentas_cobrar.vendedor
FROM tercero RIGHT JOIN cuentas_cobrar ON tercero.cod_tercero = cuentas_cobrar.cod_tercero 
WHERE (cuentas_cobrar.cod_tercero='$cod_tercero') AND (cuentas_cobrar.subtotal > 0) ORDER BY cuentas_cobrar.subtotal ASC";
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
<input type="hidden" name="cod_factura[]" id="<?php echo $cod_factura;?>" value="<?php echo $cod_factura;?>" size="10">
<?php } ?>

<tr valign="baseline">
<td nowrap align="right">&nbsp;</td>
<td bordercolor="1"><input type="submit" id="boton1" value="Agregar"></td>
<input type="hidden" name="insertar_datos" value="formulario">
</tr>
</form>

</center>
</body>
</html>