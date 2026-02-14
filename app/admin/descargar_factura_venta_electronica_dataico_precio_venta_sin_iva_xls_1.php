<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
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

$nombre             = "FACTURA_".$nombre_tipo_factura."_DATAICO_".$cod_factura.'_'.$fecha.''.$hora.'_'.$cod_info_factura_venta.'.xls';
$observacion        = "";

header("Content-type: application/vnd.ms-excel" ) ;
header("Content-Disposition: attachment; filename=$nombre" );

echo "<table border=1>";
echo "<tr>";
echo "<td>DESCUENTO_GLOBAL</td>";
echo "<td>FECHA_EXPEDICION</td>";
echo "<td>FECHA_VENCIMIENTO</td>";
echo "<td>NUMERO</td>";
echo "<td>MEDIO_DE_PAGO</td>";
echo "<td>TIPO_MEDIO_DE_PAGO</td>";
echo "<td>ORDEN_DE_COMPRA</td>";
echo "<td>MONEDA</td>";
echo "<td>CLIENTE_PAIS</td>";
echo "<td>CLIENTE_NOMBRE</td>";
echo "<td>CLIENTE_PRIMER_NOMBRE</td>";
echo "<td>CLIENTE_APELLIDO</td>";
echo "<td>CLIENTE_IDENTIFICATION</td>";
echo "<td>CLIENTE_TIPO_IDENTIFICATION</td>";
echo "<td>CLIENTE_DIRECCION</td>";
echo "<td>CLIENTE_TELEFONO</td>";
echo "<td>CLIENTE_CIUDAD</td>";
echo "<td>CLIENTE_DEPARTAMENTO</td>";
echo "<td>CLIENTE_TIPO</td>";
echo "<td>CLIENTE_CORREO</td>";
echo "<td>CLIENTE_TAX_LEVEL</td>";
echo "<td>CLIENTE_REGIMEN</td>";
echo "<td>ITEM_DESCRIPCION</td>";
echo "<td>ITEM_REFERENCIA</td>";
echo "<td>ITEM_CANTIDAD</td>";
echo "<td>ITEM_PRECIO</td>";
echo "<td>IVA%</td>";
echo "<td>IMP_CONSUMO%</td>";
echo "<td>RET_IVA%</td>";
echo "<td>RET_ICA%</td>";
echo "<td>RET_FUENTE%</td>";
echo "</tr>";
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

echo "<tr>";
echo "<td>".$descuento_ptj."</td>";
echo "<td>".$fecha_ymd_venta_producto."</td>";
echo "<td>".$fecha_ymd_venta_producto."</td>";
echo "<td>".$cod_factura."</td>";
echo "<td>".$nombre_tipo_forma_pago2."</td>";
echo "<td>".$tipo_medio_pago."</td>";
echo "<td>".$observacion."</td>";
echo "<td>".$nombre_tipo_moneda."</td>";
echo "<td>".$nombre_pais."</td>";
echo "<td>".$nombre1_tercero."</td>";
echo "<td>".$nombre2_tercero."</td>";
echo "<td>".$apellidos_tercero."</td>";
echo "<td>".$identificacion_tercero."</td>";
echo "<td>".$nombre_tipo_identificacion."</td>";
echo "<td>".$direccion_tercero."</td>";
echo "<td>".$telefono1_tercero."</td>";
echo "<td>".$nombre_ciudad."</td>";
echo "<td>".$nombre_departamento."</td>";
echo "<td>".$nombre_tipo_cliente."</td>";
echo "<td>".$correo_tercero."</td>";
echo "<td>".$nombre_tipo_impuesto."</td>";
echo "<td>".$nombre_tipo_regimen."</td>";
echo "<td>".$nombre_producto."</td>";
echo "<td>".$cod_producto_barra."</td>";
echo "<td>".$und_venta."</td>";
echo "<td>".round($precio_venta_producto_sin_iva, 2)."</td>";
echo "<td>".$iva_ptj."</td>";
echo "<td>".$ptj_imp_consumo."</td>";
echo "<td>".$ptj_ret_iva."</td>";
echo "<td>".$ptj_ret_ica."</td>";
echo "<td>".$ptj_ret_fuente."</td>";
echo "</tr>";
}
echo "</table>";
}
?>

