<?php
require_once('../conexiones/conexione.php'); 
date_default_timezone_set("America/Bogota");
include ("../registro_movimientos/registro_movimientos.php");

$cod_info_factura_compra     = intval($_GET['cod_info_factura_compra']);
$cod_factura                 = addslashes($_GET['cod_factura']);
$proveedor1                  = addslashes($_GET['proveedor']);
$fecha                       = date("Y-m-d");
$fecha_ymdhis_seg            = time();
$hora                        = date("H:i:s");
$proveedor                   = preg_replace('/\\s/', '_', $proveedor1);
$nombre                      = 'FACTURA_COMPRA_INTERNA_'.$proveedor.'_'.$cod_factura.'_'.$fecha.'_Hora_'.$hora.'.csv';
$salida                      = "";

// Obtener los Registros de la tabla 
$sql_cliente = "SELECT tbl15_factura_compra_producto.cod_factura_compra_producto, tbl15_factura_compra_producto.cod_producto, tbl15_factura_compra_producto.cod_producto_barra, 
tbl15_factura_compra_producto.cod_info_factura_compra, tbl15_factura_compra_producto.cod_factura, tbl15_factura_compra_producto.cod_historia_clinica, tbl15_factura_compra_producto.nombre_producto, 
tbl15_factura_compra_producto.und_compra, tbl15_factura_compra_producto.precio_costo_producto, tbl15_factura_compra_producto.total_costo_producto, tbl15_factura_compra_producto.precio_compra_producto, 
tbl15_factura_compra_producto.total_compra_producto, tbl15_factura_compra_producto.nombre_tipo_producto, tbl15_factura_compra_producto.nombre_tipo_unidad_medida, 
tbl15_factura_compra_producto.nombre_tipo_presentacion, tbl15_factura_compra_producto.nombre_via_administracion, tbl15_factura_compra_producto.nombre_frec_duracion, 
tbl15_factura_compra_producto.fecha_ymd_venta_producto, tbl15_factura_compra_producto.cod_administrador, tbl15_factura_compra_producto.iva_ptj, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_factura_compra_producto.cuenta, tbl15_factura_compra_producto.cod_tipo_cobrar, tbl15_factura_compra_producto.comision_ptj, tbl15_factura_compra_producto.cod_tipo_pago, 
tbl15_factura_compra_producto.cod_tipo_forma_pago, tbl15_factura_compra_producto.cod_dependencia, tbl15_factura_compra_producto.precio_venta_producto, 
tbl15_factura_compra_producto.precio_venta_producto2, tbl15_factura_compra_producto.precio_venta_producto3, tbl15_factura_compra_producto.precio_venta_producto4, 
tbl15_factura_compra_producto.precio_venta_producto5, tbl15_factura_compra_producto.total_venta_producto, tbl15_factura_compra_producto.cod_interno,
tbl15_factura_compra_producto.nombre_tipo_precio_venta, tbl15_factura_compra_producto.cod_tercero, tbl15_factura_compra_producto.descuento, 
tbl15_factura_compra_producto.dto1, tbl15_factura_compra_producto.dto2, tbl15_factura_compra_producto.valor_iva, tbl15_factura_compra_producto.cod_original, 
tbl15_factura_compra_producto.codificacion, tbl15_factura_compra_producto.ganancia_ptj, tbl15_factura_compra_producto.tope_min, 
tbl15_factura_compra_producto.fecha_seg_venta_producto, tbl15_factura_compra_producto.fecha_mes_venta_producto, tbl15_factura_compra_producto.fecha_anyo_venta_producto, 
tbl15_factura_compra_producto.ipc_ptj, tbl15_factura_compra_producto.precio_ipc, tbl15_factura_compra_producto.precio_ipc_total, 
tbl15_factura_compra_producto.fecha_vencimiento, tbl15_factura_compra_producto.precio_compra_producto_viejo, tbl15_factura_compra_producto.precio_costo_producto_viejo, 
tbl15_factura_compra_producto.und_unidades, tbl15_factura_compra_producto.und_caja, tbl15_factura_compra_producto.cajas_sobre, tbl15_factura_compra_producto.und_sobre, 
tbl15_factura_compra_producto.nombre_tipo_compra, tbl15_factura_compra_producto.und_producto
FROM tbl15_tercero RIGHT JOIN tbl15_factura_compra_producto ON tbl15_tercero.cod_tercero = tbl15_factura_compra_producto.cod_tercero 
WHERE (tbl15_factura_compra_producto.cod_info_factura_compra = '$cod_info_factura_compra') 
ORDER BY tbl15_factura_compra_producto.cod_factura_compra_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_factura_compra_producto   = $info_cliente['cod_factura_compra_producto'];
$cod_producto                  = $info_cliente['cod_producto'];
$cod_producto_barra            = $info_cliente['cod_producto_barra'];
$cod_info_factura_compra       = $info_cliente['cod_info_factura_compra'];
$cod_factura                   = $info_cliente['cod_factura'];
$nombre_producto               = $info_cliente['nombre_producto'];
$und_compra                    = $info_cliente['und_compra'];
$precio_compra_producto        = $info_cliente['precio_compra_producto'];
$precio_costo_producto         = $info_cliente['precio_costo_producto'];
$total_costo_producto          = $info_cliente['total_costo_producto'];
$total_compra_producto         = $info_cliente['total_compra_producto'];
$precio_venta_producto         = $info_cliente['precio_venta_producto'];
$precio_venta_producto2        = $info_cliente['precio_venta_producto2'];
$precio_venta_producto3        = $info_cliente['precio_venta_producto3'];
$precio_venta_producto4        = $info_cliente['precio_venta_producto4'];
$precio_venta_producto5        = $info_cliente['precio_venta_producto5'];
$total_venta_producto          = $info_cliente['total_venta_producto'];
$nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
$nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
$fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
$cod_interno                   = $info_cliente['cod_interno'];
$nombre_tipo_precio_venta      = $info_cliente['nombre_tipo_precio_venta'];
$cod_tercero                   = $info_cliente['cod_tercero'];
$descuento                     = $info_cliente['descuento'];
$dto1                          = $info_cliente['dto1'];
$dto2                          = $info_cliente['dto2'];
$valor_iva                     = $info_cliente['valor_iva'];

$ipc_ptj                       = $info_cliente['ipc_ptj'];
$precio_ipc                    = $info_cliente['precio_ipc'];
$precio_ipc_total              = $info_cliente['precio_ipc_total'];
$cod_original                  = $info_cliente['cod_original'];
$codificacion                  = $info_cliente['codificacion'];
$ganancia_ptj                  = $info_cliente['ganancia_ptj'];
$tope_min                      = $info_cliente['tope_min'];
$fecha_seg_venta_producto      = $info_cliente['fecha_seg_venta_producto'];
$fecha_mes_venta_producto      = $info_cliente['fecha_mes_venta_producto'];
$fecha_anyo_venta_producto     = $info_cliente['fecha_anyo_venta_producto'];
$fecha_hora                    = date("H:i.s", $fecha_seg_venta_producto);
$fecha_vencimiento             = $info_cliente['fecha_vencimiento'];
$fechas_vencimiento_seg        = 0;
$ip                            = 0;
$precio_compra_producto_viejo  = $info_cliente['precio_compra_producto_viejo'];
$precio_costo_producto_viejo   = $info_cliente['precio_costo_producto_viejo'];
$und_min_precio_venta_desc     = 0;
$und_unidades                  = $info_cliente['und_unidades'];
$und_caja                      = $info_cliente['und_caja'];
$cajas_sobre                   = $info_cliente['cajas_sobre'];
$und_sobre                     = $info_cliente['und_sobre'];

		
//$cuenta                        = $info_cliente['cuenta'];
$cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
$cod_administrador_db          = $info_cliente['cod_administrador'];
$nombre_propietario            = $info_cliente['nombre1_tercero'];
$comision_ptj                  = $info_cliente['comision_ptj'];
$cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
$cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
$cod_dependencia               = $info_cliente['cod_dependencia'];
$nombre_tipo_compra            = $info_cliente['nombre_tipo_compra'];
$iva_ptj                       = $info_cliente['iva_ptj'];
$und_producto                  = $info_cliente['und_producto'];

$total_comision                = ($total_compra_producto * ($comision_ptj/100));

$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                        = $datos_administrador['cuenta'];

$sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

$nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

$sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
$datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

$nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

$sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

$nombre_dependencia            = $datos_dependencia['nombre_dependencia'];

$sql_info_factura_compra = "SELECT nombre_rete_fuente_ptj FROM tbl15_info_factura_compra WHERE cod_info_factura_compra = '$cod_info_factura_compra'";
$consulta_info_factura_compra = mysqli_query($conectar, $sql_info_factura_compra) or die(mysqli_error($conectar));
$datos_info_factura_compra = mysqli_fetch_assoc($consulta_info_factura_compra);

$nombre_rete_fuente_ptj            = $datos_info_factura_compra['nombre_rete_fuente_ptj'];

$salida .= $cod_factura_compra_producto.';'.$cod_producto_barra.';'.$nombre_producto.';'.$und_unidades.';'.$und_caja.';'.$und_caja.';'.$und_sobre.';'.$und_compra.';'.$precio_compra_producto.';'.
$precio_costo_producto.';'.$precio_venta_producto.';'.$precio_venta_producto2.';'.$precio_venta_producto3.';'.$precio_venta_producto4.';'.$precio_venta_producto5.';'.
$total_venta_producto.';'.$total_compra_producto.';'.$precio_compra_producto.';'.$cod_interno.';'.$nombre_tipo_precio_venta.';'.
$cod_tercero.';'.$cod_tipo_pago.';'.$descuento.';'.$dto1.';'.$dto2.';'.$iva_ptj.';'.$valor_iva.';'.$valor_iva.';'.$nombre_rete_fuente_ptj.';'.$ipc_ptj.';'.$precio_ipc.';'.$precio_ipc_total.';'.
$cod_factura.';'.$cod_original.';'.$codificacion.';'.$comision_ptj.';'.$ganancia_ptj.';'.$tope_min.';'.$cuenta.';'.$fecha_seg_venta_producto.';'.$fecha_mes_venta_producto.';'.$fecha_ymd_venta_producto.';'.
$fecha_anyo_venta_producto.';'.$fecha_hora.';'.$fecha_vencimiento.';'.$fechas_vencimiento_seg.';'.$ip.';'.$cod_dependencia.';'.$fecha_ymdhis_seg.';'.$precio_compra_producto_viejo.';'.
$precio_costo_producto_viejo.';'.$nombre_tipo_compra.';'.$und_min_precio_venta_desc.';'.$cod_tercero.';'.$cod_info_factura_compra.';';

$salida .="\n";
}
// DESCARGAR ARCHIVO
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$nombre);

echo $salida;
exit;
?>