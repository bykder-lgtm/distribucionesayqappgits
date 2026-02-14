<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$nombre_campo_undidades_inv1                                       = $info_empresa_data['nombre_campo_undidades_inv1'];
$nombre_campo_undidades_inv2                                       = $info_empresa_data['nombre_campo_undidades_inv2'];
$nombre_campo_undidades_inv3                                       = $info_empresa_data['nombre_campo_undidades_inv3'];
$cod_tipo_sistema_numeracion                                       = $info_empresa_data['cod_tipo_sistema_numeracion'];

$cod_tipo_sistema_numeracion_und_compra                            = $info_empresa_data['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_und_venta                             = $info_empresa_data['cod_tipo_sistema_numeracion_und_venta'];
$cod_tipo_sistema_numeracion_precio_compra                         = $info_empresa_data['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta                          = $info_empresa_data['cod_tipo_sistema_numeracion_precio_venta'];

$nombre_tipo_campo_componente_html_und_venta                       = $info_empresa_data['nombre_tipo_campo_componente_html_und_venta'];
$nombre_tipo_campo_componente_html_und_compra                      = $info_empresa_data['nombre_tipo_campo_componente_html_und_compra'];
$nombre_tipo_campo_componente_html_precio_compra                   = $info_empresa_data['nombre_tipo_campo_componente_html_precio_compra'];
$nombre_tipo_campo_componente_html_precio_venta                    = $info_empresa_data['nombre_tipo_campo_componente_html_precio_venta'];
//-----------------------------------------------------------------------------------------------------//
$fecha                               = date("Ymd");
$hora                                = date("His");
$salida                              = "";

if (isset($_GET['cod_info_factura_transferencia_bodega'])) {

$cod_info_factura_transferencia_bodega            = intval($_GET['cod_info_factura_transferencia_bodega']);

$cod_info_factura_transferencia_bodega         = intval($_GET['cod_info_factura_transferencia_bodega']);

$sql_info_factura_transfer_bodega = "SELECT nombre_empresa, razonsocial_empresa FROM tbl15_info_factura_transferencia_bodega 
WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_info_factura_transfer_bodega = mysqli_query($conectar, $sql_info_factura_transfer_bodega);
$datos_info_factura_transfer_bodega = mysqli_fetch_assoc($consulta_info_factura_transfer_bodega);

$nombre_empresa                 = str_replace(" ", "_", $datos_info_factura_transfer_bodega['nombre_empresa']);
$razonsocial_empresa            = str_replace(" ", "_", $datos_info_factura_transfer_bodega['razonsocial_empresa']);
$nombre_cliente                 = $datos_info_factura_transfer_bodega['razonsocial_empresa'];

$nombre_archivo                 = "TRANSFERENCIA_DE_".$nombre_empresa."_A_".$razonsocial_empresa.'_'.$fecha.''.$hora.'_'.$cod_info_factura_transferencia_bodega.'.csv';
$observacion                    = "";

header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre_archivo" );

$salida .='0ID'.';';
$salida .='COD_TRANSFER'.';';
$salida .='FACTURA'.';';
$salida .='COD_PRODUCTO'.';';
$salida .='COD_BARRA_PRODUCTO'.';';
$salida .='UND'.';';
$salida .='PRECIO_COMPRA'.';';
$salida .='PRECIO_VENTA'.';';
$salida .='TIPO_PRODUCTO'.';';
$salida .='UNIDAD_MEDIDA'.';';
$salida .='FECHA'.';';
$salida .='HORA'.';';
$salida .='TIPO_PRECIO'.';';
$salida .='EMPRESA'.';';
$salida .='NOMBRE_PRODUCTO'.'';

$salida .="\n";

$sql = "SELECT cod_transferencia_bodega_producto, cod_info_factura_transferencia_bodega, cod_factura, cod_producto, cod_producto_barra, 
nombre_producto, und_venta, precio_compra_producto, precio_venta_producto, nombre_tipo_producto, 
nombre_tipo_unidad_medida, fecha_ymd_venta_producto, fecha_hora_venta_producto, nombre_tipo_precio_venta, nombre_cliente
FROM tbl15_transferencia_bodega_producto WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta = mysqli_query($conectar, $sql);
while ($datos = mysqli_fetch_assoc($consulta)) {

$cod_transferencia_bodega_producto              = $datos['cod_transferencia_bodega_producto'];
$cod_info_factura_transferencia_bodega          = $datos['cod_info_factura_transferencia_bodega'];
$cod_factura                                    = $datos['cod_factura'];
$cod_producto                                   = $datos['cod_producto'];
$cod_producto_barra                             = $datos['cod_producto_barra'];
$nombre_producto1                               = str_replace(",", ".", $datos['nombre_producto']);
$nombre_producto2                               = str_replace(",'", "", $nombre_producto1);
$nombre_producto                                = trim($nombre_producto2);
$und_venta                                      = $datos['und_venta'];
$precio_compra_producto                         = $datos['precio_compra_producto'];
$precio_venta_producto                          = $datos['precio_venta_producto'];
$nombre_tipo_producto                           = $datos['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                      = $datos['nombre_tipo_unidad_medida'];
$fecha_ymd_venta_producto                       = $datos['fecha_ymd_venta_producto'];
$fecha_hora_venta_producto                      = $datos['fecha_hora_venta_producto'];
$nombre_tipo_precio_venta                       = $datos['nombre_tipo_precio_venta'];
$nombre_cliente                                 = $datos['nombre_cliente'];

if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }

$salida .=''.$cod_transferencia_bodega_producto.';';
$salida .=''.$cod_info_factura_transferencia_bodega.';';
$salida .=''.$cod_factura.';';
$salida .=''.$cod_producto.';';
$salida .=''.$cod_producto_barra.';';
$salida .=''.$und_venta.';';
$salida .=''.$precio_compra_producto.';';
$salida .=''.$precio_venta_producto.';';
$salida .=''.$nombre_tipo_producto.';';
$salida .=''.$nombre_tipo_unidad_medida.';';
$salida .=''.$fecha_ymd_venta_producto.';';
$salida .=''.$fecha_hora_venta_producto.';';
$salida .=''.$nombre_tipo_precio_venta.';';
$salida .=''.$nombre_cliente.';';
$salida .=''.$nombre_producto.'';
$salida .="\n";
}
echo $salida;
}
?>

