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

$nivel_acceso = '3';
if ($seguridad_acceso['cod_seguridad'] <> $nivel_acceso) {
header("Location:../admin/acceso_denegado.php");
}
include ("../registro_movimientos/registro_movimientos.php");
//include ("../registro_movimientos/registro_cierre_caja.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8"> 
<title>ALMACEN</title>
</head>
<body>
<center>
<br><br>
<a href="../admin/producto_mas_vendido_mes.php"><strong><font size='+1' color='white'>PRODUCTOS MAS VENDIDOS DEL MES</a> - </font><font size='+1' color='yellow'>PRODUCTOS MAS VENDIDOS</font></strong>
<br><br>
<table widht='80%'>
<tr>
<td align="center"><strong>C&Oacute;DIGO</strong></td>
<td align="center"><strong>PRODUCTO</strong></td>
<td align="center"><strong>UND INVENTARIO</strong></td>
<td align="center"><strong>UND VENDIDAS</strong></td>
<td align="center"><strong>P.VENTA</strong></td>
<td align="center"><strong>TOTAL</strong></td>
</tr>
<?php
$mostrar_datos_sql = "SELECT nombre_productos, Sum(unidades_vendidas) AS unidades_vendidas, vlr_total_venta, cod_productos,  
precio_venta, fecha_mes FROM ventas GROUP BY  cod_productos ORDER BY unidades_vendidas DESC LIMIT 0,500";
$consulta = mysql_query($mostrar_datos_sql, $conectar) or die(mysql_error());

while ($datos = mysql_fetch_assoc($consulta)) { 

$cod_productos           = $datos['cod_productos'];
$nombre_productos        = $datos['nombre_productos'];
$unidades_vendidas       = $datos['unidades_vendidas'];
$precio_venta            = $datos['precio_venta'];
$total                   = $unidades_vendidas * $precio_venta;
$fecha_mes               = $datos['fecha_mes'];

$mostrar_und_invent = "SELECT unidades_faltantes FROM productos WHERE cod_productos_var = '$cod_productos'";
$consulta_und_inven = mysql_query($mostrar_und_invent, $conectar) or die(mysql_error());
$datos_und_inven = mysql_fetch_assoc($consulta_und_inven);

$unidades_faltantes     = $datos_und_inven['unidades_faltantes'];
?>
<tr>
<td ><font size='+1'><?php echo $cod_productos; ?></font></td>
<td ><font size='+1'><?php echo $nombre_productos; ?></font></td>
<td align="center"><font size='+1'><?php echo number_format($unidades_faltantes, 0, ",", "."); ?></font></td>
<td align="center"><font size='+1'><?php echo number_format($unidades_vendidas, 0, ",", "."); ?></font></td>
<td align="right"><font size='+1'><?php echo number_format($precio_venta, 0, ",", "."); ?></font></td>
<td align="right"><font size='+1'><?php echo number_format($total, 0, ",", "."); ?></font></td>
</tr>
<?php }  ?>
</table>