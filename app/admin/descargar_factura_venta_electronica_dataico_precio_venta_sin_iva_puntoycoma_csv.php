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

$fecha              = date("Ymd");
$hora               = date("His");
$salida             = "";

if (isset($_GET['cod_info_factura_venta'])) {

$cod_info_factura_venta         = intval($_GET['cod_info_factura_venta']);

$sql_max = "SELECT cod_factura, nombre_tipo_factura	FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$consulta_max = mysqli_query($conectar, $sql_max);
$datos_max = mysqli_fetch_assoc($consulta_max);

$cod_factura                    = $datos_max['cod_factura'];
$nombre_tipo_factura            = $datos_max['nombre_tipo_factura'];

$nombre             = "FACTURA_".$nombre_tipo_factura."_DATAICO_PUNTOYCOMAS".$cod_factura.'_'.$fecha.''.$hora.'_'.$cod_info_factura_venta.'.csv';
$observacion        = "";

header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

$salida .='DESCUENTO_GLOBAL'.';';
$salida .='FECHA_EXPEDICION'.';';
$salida .='FECHA_VENCIMIENTO'.';';
$salida .='NUMERO'.';';
$salida .='MEDIO_DE_PAGO'.';';
$salida .='TIPO_MEDIO_DE_PAGO'.';';
$salida .='ORDEN_DE_COMPRA'.';';
$salida .='MONEDA'.';';
$salida .='CLIENTE_PAIS'.';';
$salida .='CLIENTE_NOMBRE'.';';
$salida .='CLIENTE_PRIMER_NOMBRE'.';';
$salida .='CLIENTE_APELLIDO'.';';
$salida .='CLIENTE_IDENTIFICATION'.';';
$salida .='CLIENTE_TIPO_IDENTIFICATION'.';';
$salida .='CLIENTE_DIRECCION'.';';
$salida .='CLIENTE_TELEFONO'.';';
$salida .='CLIENTE_CIUDAD'.';';
$salida .='CLIENTE_DEPARTAMENTO'.';';
$salida .='CLIENTE_TIPO'.';';
$salida .='CLIENTE_CORREO'.';';
$salida .='CLIENTE_TAX_LEVEL'.';';
$salida .='CLIENTE_REGIMEN'.';';
$salida .='ITEM_DESCRIPCION'.';';
$salida .='ITEM_REFERENCIA'.';';
$salida .='ITEM_CANTIDAD'.';';
$salida .='ITEM_PRECIO'.';';
$salida .='IVA%'.';';
$salida .='IMP_CONSUMO%'.';';
$salida .='RET_IVA%'.';';
$salida .='RET_ICA%'.';';
$salida .='RET_FUENTE%'.'';
$salida .="\n";

$sql = "SELECT tbl15_tercero.nombre_tipo_tercero, tbl15_tercero.nombre_tipo_identificacion, tbl15_tercero.identificacion_tercero, 
tbl15_tercero.digito_tercero, tbl15_tercero.nombre1_tercero, tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_tercero.apellido2_tercero, tbl15_tercero.direccion_tercero, tbl15_tercero.telefono1_tercero, tbl15_tercero.telefono2_tercero, 
tbl15_tercero.correo_tercero, tbl15_tercero.nombre_pais, tbl15_tercero.nombre_departamento, tbl15_tercero.nombre_ciudad, tbl15_tercero.nombre_tipo_cliente,  
tbl15_tercero.nombre_tipo_regimen, tbl15_tercero.nombre_tipo_impuesto, 
tbl15_venta_producto.cod_producto_barra, tbl15_venta_producto.cod_factura, tbl15_venta_producto.nombre_producto, tbl15_venta_producto.und_venta, 
tbl15_venta_producto.precio_compra_producto, tbl15_venta_producto.total_compra_producto, tbl15_venta_producto.precio_venta_producto, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.descuento_ptj, tbl15_venta_producto.iva_ptj, 
tbl15_venta_producto.ptj_imp_consumo, tbl15_venta_producto.ptj_ret_iva, tbl15_venta_producto.ptj_ret_ica, tbl15_venta_producto.ptj_ret_fuente, 
tbl15_venta_producto.ptj_ipc, tbl15_venta_producto.precio_ipc_total, tbl15_venta_producto.precio_ipc, tbl15_venta_producto.cod_tipo_pago, 
tbl15_venta_producto.cod_tipo_forma_pago, tbl15_venta_producto.nombre_tipo_moneda 
FROM tbl15_tercero RIGHT JOIN tbl15_venta_producto ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta = mysqli_query($conectar, $sql);
while ($datos = mysqli_fetch_assoc($consulta)) {

$cod_producto_barra              = $datos['cod_producto_barra'];
$cod_factura                     = $datos['cod_factura'];
$nombre_producto                 = $datos['nombre_producto'];
$und_venta                       = $datos['und_venta'];
$precio_compra_producto          = $datos['precio_compra_producto'];
$total_compra_producto           = $datos['total_compra_producto'];
$precio_venta_producto           = $datos['precio_venta_producto'];
$total_venta_producto            = $datos['total_venta_producto'];
$fecha_ymd_venta_producto        = $datos['fecha_ymd_venta_producto'];
$descuento_ptj                   = $datos['descuento_ptj'];
$iva_ptj                         = $datos['iva_ptj'];
$ptj_imp_consumo                 = $datos['ptj_imp_consumo'];
$ptj_ret_iva                     = $datos['ptj_ret_iva'];
$ptj_ret_ica                     = $datos['ptj_ret_ica'];
$ptj_ret_fuente                  = $datos['ptj_ret_fuente'];
$ptj_ipc                         = $datos['ptj_ipc'];
$precio_ipc_total                = $datos['precio_ipc_total'];
$precio_ipc                      = $datos['precio_ipc'];
$cod_tipo_pago                   = $datos['cod_tipo_pago'];
$cod_tipo_forma_pago             = $datos['cod_tipo_forma_pago'];
$nombre_tipo_moneda              = $datos['nombre_tipo_moneda'];

$nombre_tipo_tercero             = $datos['nombre_tipo_tercero'];
$nombre_tipo_identificacion      = $datos['nombre_tipo_identificacion'];
$identificacion_tercero          = $datos['identificacion_tercero'];
$digito_tercero                  = $datos['digito_tercero'];
$nombre1_tercero                 = $datos['nombre1_tercero'];
$nombre2_tercero                 = $datos['nombre2_tercero'];
$apellido1_tercero               = $datos['apellido1_tercero'];
$apellido2_tercero               = $datos['apellido2_tercero'];
$direccion_tercero               = $datos['direccion_tercero'];
$telefono1_tercero               = $datos['telefono1_tercero'];
$telefono2_tercero               = $datos['telefono2_tercero'];
$correo_tercero                  = $datos['correo_tercero'];
$nombre_pais                     = $datos['nombre_pais'];
$nombre_departamento             = $datos['nombre_departamento'];
$nombre_ciudad                   = $datos['nombre_ciudad'];
$nombre_tipo_cliente             = $datos['nombre_tipo_cliente'];
$nombre_tipo_regimen             = $datos['nombre_tipo_regimen'];
$nombre_tipo_impuesto            = $datos['nombre_tipo_impuesto'];
$nombre_tipo_identificacion      = 'CC';

$precio_venta_producto_sin_iva   = (($precio_venta_producto - (($descuento_ptj/100) * $precio_venta_producto)) / (($iva_ptj/100) + (100/100)));
$apellidos_tercero               = $apellido1_tercero.' '.$nombre2_tercero;

if ($cod_tipo_pago==1) { $tipo_medio_pago = "DEBITO"; } else { $tipo_medio_pago = "CREDITO"; }
if ($nombre_pais=='COLOMBIA') { $nombre_pais = "CO"; } else { $nombre_pais = $nombre_pais; }
if ($descuento_ptj==0) { $descuento_ptj = ""; } else { $descuento_ptj = $descuento_ptj; }
if ($direccion_tercero=='') { $direccion_tercero = 'SAN PELAYO'; } else { $direccion_tercero = $direccion_tercero; }
if ($telefono1_tercero=='') { $telefono1_tercero = '11111111'; } else { $telefono1_tercero = $telefono1_tercero; }
if ($nombre_ciudad=='') { $nombre_ciudad = 'SAN PELAYO'; } else { $nombre_ciudad = $nombre_ciudad; }
if ($correo_tercero=='') { $correo_tercero = 'sincorreo@gmail.com'; } else { $correo_tercero = $correo_tercero; }

$sql_forma_pago = "SELECT nombre_tipo_forma_pago, nombre_tipo_forma_pago2 FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago);
$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

$nombre_tipo_forma_pago          = $datos_forma_pago['nombre_tipo_forma_pago'];
$nombre_tipo_forma_pago2         = $datos_forma_pago['nombre_tipo_forma_pago2'];

$salida .=''.$descuento_ptj.';';
$salida .=''.$fecha_ymd_venta_producto.';';
$salida .=''.$fecha_ymd_venta_producto.';';
$salida .=''.$cod_factura.';';
$salida .=''.$nombre_tipo_forma_pago2.';';
$salida .=''.$tipo_medio_pago.';';
$salida .=''.$observacion.';';
$salida .=''.$nombre_tipo_moneda.';';
$salida .=''.$nombre_pais.';';
$salida .=''.$nombre1_tercero.';';
$salida .=''.$nombre2_tercero.';';
$salida .=''.$apellidos_tercero.';';
$salida .=''.$identificacion_tercero.';';
$salida .=''.$nombre_tipo_identificacion.';';
$salida .=''.$direccion_tercero.';';
$salida .=''.$telefono1_tercero.';';
$salida .=''.$nombre_ciudad.';';
$salida .=''.$nombre_departamento.';';
$salida .=''.$nombre_tipo_cliente.';';
$salida .=''.$correo_tercero.';';
$salida .=''.$nombre_tipo_impuesto.';';
$salida .=''.$nombre_tipo_regimen.';';
$salida .=''.$nombre_producto.';';
$salida .=''.$cod_producto_barra.';';
$salida .=''.$und_venta.';';
$salida .=''.round($precio_venta_producto_sin_iva, 2).';';
$salida .=''.$iva_ptj.';';
$salida .=''.$ptj_imp_consumo.';';
$salida .=''.$ptj_ret_iva.';';
$salida .=''.$ptj_ret_ica.';';
$salida .=''.$ptj_ret_fuente.'';
$salida .="\n";
}
echo $salida;
}
?>

