<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
include_once('../evitar_mensaje_error/error.php');

$fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$cod_administrador                       = intval($_GET['cod_administrador']);
$cod_tercero                             = intval($_GET['cod_tercero']);
$cod_tipo_pago                           = intval($_GET['cod_tipo_pago']);
$cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
$cod_dependencia                         = intval($_GET['cod_dependencia']);
$nombre_tipo_factura                     = addslashes($_GET['nombre_tipo_factura']);

if (isset($_GET['nombre_tipo_compra'])) { $nombre_tipo_compra = addslashes($_GET['nombre_tipo_compra']); } else { $nombre_tipo_compra = "0"; }
if (isset($_GET['cod_tipo_metodo_envio'])) { $cod_tipo_metodo_envio = intval($_GET['cod_tipo_metodo_envio']); } else { $cod_tipo_metodo_envio = "0"; }

if ($cod_administrador == "0") {
    $filtro_consulta_vendedor = "";
    $filtro_consulta_vendedor_rel = "";
} else {
    $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
    $filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
}

if ($cod_tercero == "0") {
    $filtro_consulta_tercero = "";
    $filtro_consulta_tercero_rel = "";
} else {
    $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
    $filtro_consulta_tercero_rel = "AND (tbl15_venta_producto.cod_tercero = '$cod_tercero')";
}

if ($cod_tipo_pago == "0") {
    $filtro_consulta_tipo_pago = "";
    $filtro_consulta_tipo_pago_rel = "";
} else {
    $filtro_consulta_tipo_pago = "AND (cod_tipo_pago = '$cod_tipo_pago')";
    $filtro_consulta_tipo_pago_rel = "AND (tbl15_venta_producto.cod_tipo_pago = '$cod_tipo_pago')";
}

if ($cod_tipo_forma_pago == "0") {
    $filtro_consulta_tipo_forma_pago = "";
    $filtro_consulta_tipo_forma_pago_rel = "";
} else {
    $filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    $filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_venta_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
}

if ($cod_dependencia == "0") {
    $filtro_consulta_dependencia = "";
    $filtro_consulta_dependencia_rel = "";
} else {
    $filtro_consulta_dependencia = "AND (cod_dependencia = '$cod_dependencia')";
    $filtro_consulta_dependencia_rel = "AND (tbl15_venta_producto.cod_dependencia = '$cod_dependencia')";
}

if ($nombre_tipo_factura =='0') {
    $filtro_consulta_nombre_tipo_factura = "";
    $filtro_consulta_nombre_tipo_factura_rel = "";
} else {
    $filtro_consulta_nombre_tipo_factura = "AND (nombre_tipo_factura = '$nombre_tipo_factura')";
    $filtro_consulta_nombre_tipo_factura_rel = "AND (tbl15_venta_producto.nombre_tipo_factura = '$nombre_tipo_factura')";
}

if ($nombre_tipo_compra =='0') {
    $filtro_consulta_nombre_tipo_compra = "";
    $filtro_consulta_nombre_tipo_compra_rel = "";
} else {
    $filtro_consulta_nombre_tipo_compra = "AND (nombre_tipo_compra = '$nombre_tipo_compra')";
    $filtro_consulta_nombre_tipo_compra_rel = "AND (tbl15_venta_producto.nombre_tipo_compra = '$nombre_tipo_compra')";
}

if ($cod_tipo_metodo_envio == "0") {
    $filtro_consulta_tipo_metodo_envio = "";
    $filtro_consulta_tipo_metodo_envio_rel = "";
} else {
    $filtro_consulta_tipo_metodo_envio = "AND (cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
    $filtro_consulta_tipo_metodo_envio_rel = "AND (tbl15_venta_producto.cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
}
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$fecha_hora                              = date("H:i:s");
$fecha                                   = date("Ymd");
$hora                                    = date("His");
$nombre_archivo                          = "VENTAS_POR_FACTURA".$fecha_ymd_venta_producto_ini.'_AL_'.$fecha_ymd_venta_producto_fin.'_'.$fecha.''.$hora;
$cabecera_emp                            = "VENTAS POR FACTURA";
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
require_once __DIR__ . '/class_php/Spout-2.7.3/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
$writer = WriterFactory::create(Type::XLSX);
$writer->openToBrowser($nombre_archivo);
// Headers

$writer->addRow(array('Tipo Factura', 'Factura', 'Tercero', 'Total Venta', 'Total Iva', 'Fecha', 'Hora', 'Vendedor', 'Tipo Pago', 'Forma Pago', 'ID'));
// Then a foreach
$sql_total_tipo_factura = "SELECT * FROM tbl15_info_factura_venta 
WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura 
AND (nombre_estado_factura = 'CERRADA') ORDER BY cod_factura ASC";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

    $cod_info_factura_venta                          = $datos_total_tipo_factura['cod_info_factura_venta'];
    $cod_resolucion_facturacion                      = $datos_total_tipo_factura['cod_resolucion_facturacion'];
    $cod_factura                                     = $datos_total_tipo_factura['cod_factura'];
    $cod_tercero_db                                  = $datos_total_tipo_factura['cod_tercero'];
    $vlr_cancelado                                   = $datos_total_tipo_factura['vlr_cancelado'];
    $vlr_vuelto                                      = $datos_total_tipo_factura['vlr_vuelto'];
    $fecha_anyo                                      = $datos_total_tipo_factura['fecha_anyo'];
    $fecha_hora                                      = $datos_total_tipo_factura['fecha_hora'];
    $cod_tipo_pago_db                                = $datos_total_tipo_factura['cod_tipo_pago'];
    $cod_administrador_db                            = $datos_total_tipo_factura['cod_administrador'];
    $total_precio_compra                             = $datos_total_tipo_factura['total_precio_compra'];
    $total_precio_venta                              = $datos_total_tipo_factura['total_precio_venta'];
    $cod_dependencia_db                              = $datos_total_tipo_factura['cod_dependencia'];
    $cod_tipo_forma_pago_db                          = $datos_total_tipo_factura['cod_tipo_forma_pago'];
    $nombre_tipo_factura_db                          = $datos_total_tipo_factura['nombre_tipo_factura'];
    $nombre_tipo_moneda                              = $datos_total_tipo_factura['nombre_tipo_moneda'];
    $total_datos_data                                = $datos_total_tipo_factura['total_datos_data'];
    $cod_estado_check_factura_electronica            = $datos_total_tipo_factura['cod_estado_check_factura_electronica'];
    $cod_estado_factura_electronica_enviado_dian     = $datos_total_tipo_factura['cod_estado_factura_electronica_enviado_dian'];
    $cod_estado_factura_electronica_enviado_dataico  = $datos_total_tipo_factura['cod_estado_factura_electronica_enviado_dataico'];
    $nombre_estado_factura_dataico_dian              = $datos_total_tipo_factura['nombre_estado_factura_dataico_dian'];

    $mostrar_datos_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
    $consulta_resolucion_facturacion = mysqli_query($conectar, $mostrar_datos_resolucion_facturacion) or die(mysqli_error($conectar));
    $matriz_consulta_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

    $prefijo_resolucion_facturacion                     = $matriz_consulta_resolucion_facturacion['prefijo_resolucion_facturacion'];

    $sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, correo_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_db'";
    $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

    $identificacion_tercero        = $datos_tercero['identificacion_tercero'];
    $nombre_tercero                = trim($datos_tercero['nombre1_tercero'].' '.$datos_tercero['nombre2_tercero'].' '.$datos_tercero['apellido1_tercero'].' '.$datos_tercero['apellido2_tercero'].' | '.$identificacion_tercero);

    $correo_tercero                = $datos_tercero['correo_tercero'];
    if ($correo_tercero <> '') { $correo_tercero = $correo_tercero; } else { $correo_tercero = 'SIN CORREO'; }

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                        = $datos_administrador['cuenta'];

    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago_db'";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago_db'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

    $suma_temporal = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
    Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
    Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
    FROM tbl15_venta_producto 
    WHERE (cod_info_factura_venta= '$cod_info_factura_venta')";
    $consulta_temporal = mysqli_query($conectar, $suma_temporal) or die(mysqli_error($conectar));
    $suma = mysqli_fetch_assoc($consulta_temporal);

    $subtotal_base                       = ($suma['subtotal_base']);
    $total_iva                           = ($suma['total_iva']);

	$writer->addRow(array($nombre_tipo_factura_db, $prefijo_resolucion_facturacion.'|'.$cod_factura, $nombre_tercero, $total_precio_venta, $total_iva, $fecha_anyo, $fecha_hora, $cuenta, $nombre_tipo_pago, $nombre_tipo_forma_pago, $cod_info_factura_venta));
	//$writer->addRow(array((int) 00, 'Customer name', (double) 23.12, '20-01-2016'));
}
$writer->close();