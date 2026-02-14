<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php'); 
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$fecha                                 = date("Y_m_d");
$hora                                  = date("H_i_s");
$fecha_mes_venta_producto              = addslashes($_GET['fecha_mes_venta_producto']);
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_info_empresa = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_info_empresa = mysqli_query($conectar, $sql_info_empresa);
$info_empresa_data = mysqli_fetch_assoc($resultado_info_empresa);

$titulo_emp                        = $info_empresa_data['titulo'];
$nombre_emp                        = $info_empresa_data['nombre'];
$nombre_empresa                    = str_replace(" ", "_", $nombre_emp);

$salida                            = "";
$tabla                             = "tbl15_venta_producto";
$nombre_archivo                    = 'MAS_VENDIDOS_MES_'.$fecha_mes_venta_producto.'_'.$nombre_empresa.'_'.$fecha.'__'.$hora.'.csv';
$cabecera_emp                      = "MAS_VENDIDOS_MES_";
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$salida .='cod_producto'.';';
$salida .='cod_producto_barra'.';';
$salida .='nombre_producto'.';';
$salida .='und_venta'.';';
$salida .='und_producto'.';';
$salida .='precio_venta_producto'.';';
$salida .='total_venta_producto'.';';
$salida .='fecha_mes_venta_producto'.';';
$salida .='nombre_empresa'.'';
$salida .="\n";

$sql_info_factura = "SELECT  cod_producto, cod_producto_barra, nombre_producto, precio_venta_producto, total_venta_producto, Sum(und_venta) AS und_venta, fecha_mes_venta_producto 
FROM tbl15_venta_producto WHERE (fecha_mes_venta_producto = '$fecha_mes_venta_producto') GROUP BY cod_producto_barra ORDER BY und_venta DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$und_venta                                    = $info_info_factura['und_venta'];
$cod_producto                                 = $info_info_factura['cod_producto'];
$cod_producto_barra                           = $info_info_factura['cod_producto_barra'];
$nombre_producto                              = $info_info_factura['nombre_producto'];
$precio_venta_producto                        = $info_info_factura['precio_venta_producto'];
$total_venta_producto                         = $info_info_factura['total_venta_producto'];
$fecha_mes_venta_producto                     = $info_info_factura['fecha_mes_venta_producto'];

$sql_tercero = "SELECT und_producto FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
$resultado_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
$info_tercero = mysqli_fetch_assoc($resultado_tercero);

$und_producto                                 = $info_tercero['und_producto'];

$salida .= ''.$cod_producto.';'.$cod_producto_barra.';'.$nombre_producto.';'.$und_venta.';'.$und_producto.';'.$precio_venta_producto.';'.$total_venta_producto.';'.$fecha_mes_venta_producto.';'.$nombre_empresa.';';
$salida .="\n";
}
// DESCARGAR ARCHIVO
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$nombre_archivo);

echo $salida;
exit;
?>