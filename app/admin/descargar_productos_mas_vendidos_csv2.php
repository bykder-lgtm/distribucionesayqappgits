<?php
require_once('../conexiones/conexione.php'); 
mysql_select_db($base_datos, $conectar); 
date_default_timezone_set("America/Bogota");
include ("../registro_movimientos/registro_movimientos.php");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}

$cuenta_actual                  = addslashes($_SESSION['usuario']);
$fecha                          = date("Y_m_d");
$hora                           = date("H_i_s");
$fecha_mes                      = addslashes($_GET['fecha_mes']);
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$obtener_informacion = "SELECT nombre FROM informacion_almacen WHERE cod_informacion_almacen = '1'";
$consultar_informacion = mysql_query($obtener_informacion, $conectar) or die(mysql_error());
$matriz_informacion = mysql_fetch_assoc($consultar_informacion);

$nombre_empresa1                = $matriz_informacion['nombre'];
$nombre_empresa                 = str_replace(" ", "_", $nombre_empresa1);
$salida                         = "";
$tabla                          = "ventas";
$nombre_archivo                 = 'MAS_VENDIDOS_MES_'.$fecha_mes.'_'.$nombre_empresa.'_'.$fecha.'__'.$hora.'.csv';
$cabecera_emp                   = "MAS_VENDIDOS_MES_";
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
/*
$salida                              = "";
$COD_PRODUCTOS                       = 'COD_PRODUCTOS';
$NOMBRE_PRODUCTOS                    = 'NOMBRE_PRODUCTOS';
$UNIDADES_INV                        = 'UNIDADES_INV';
$UNIDADES_VENDIDAS                   = 'UNIDADES_VENDIDAS';
$PRECIO_VENTA                        = 'PRECIO_VENTA';
$TOTAL_VENTA                         = 'TOTAL_VENTA';
$MES                                 = 'MES';
$CUENTA                              = 'CUENTA';
$salida                             .= ''.$COD_PRODUCTOS.','.$NOMBRE_PRODUCTOS.','.$UNIDADES_INV.','.$UNIDADES_VENDIDAS.','.$PRECIO_VENTA.','.$TOTAL_VENTA.','.$MES.','.$CUENTA.','.$EMPRESA.',';
$salida                             .="\n";
*/

$sql_datos = "SELECT ventas.cod_productos, ventas.nombre_productos, productos.unidades_faltantes, 
Sum(ventas.unidades_vendidas) AS unidades_vendidas, ventas.precio_venta, ventas.vlr_total_venta, 
ventas.fecha_mes, '$cuenta_actual', '$nombre_empresa' 
FROM ventas INNER JOIN productos ON ventas.cod_productos = productos.cod_productos_var AND (ventas.fecha_mes = '$fecha_mes') 
GROUP BY ventas.cod_productos ORDER BY ventas.unidades_vendidas DESC";
$consulta_datos = mysql_query($sql_datos, $conectar) or die(mysql_error());
while ($datos_reg_excel = mysql_fetch_array($consulta_datos)) {

$cod_productos                           = ($datos_reg_excel['cod_productos']);
$nombre_productos_orig                   = $datos_reg_excel['nombre_productos'];
$nombre_productos                        = trim(str_replace(",", ".", $nombre_productos_orig));
$unidades_faltantes                      = ($datos_reg_excel['unidades_faltantes']);
$unidades_vendidas                       = ($datos_reg_excel['unidades_vendidas']);
$precio_venta                            = ($datos_reg_excel['precio_venta']);
$vlr_total_venta                         = ($datos_reg_excel['vlr_total_venta']);
$fecha_mes                               = ($datos_reg_excel['fecha_mes']);

//$mostrar_und_invent = "SELECT unidades_faltantes FROM productos WHERE cod_productos_var = '$cod_productos'";
//$consulta_und_inven = mysql_query($mostrar_und_invent, $conectar) or die(mysql_error());
//$datos_und_inven = mysql_fetch_assoc($consulta_und_inven);
//$unidades_faltantes      = $datos_und_inven['unidades_faltantes'];

$salida .= ''.$cod_productos.','.$nombre_productos.','.$unidades_faltantes.','.$unidades_vendidas.','.$precio_venta.','.$vlr_total_venta.','.$fecha_mes.','.$cuenta_actual.','.$nombre_empresa.',';
$salida .="\n";
}
// DESCARGAR ARCHIVO
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$nombre_archivo);

echo $salida;
exit;
?>