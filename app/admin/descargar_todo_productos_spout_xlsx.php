<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$fecha                       = date("Y_m_d");
$hora                        = date("H_i_s");
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$nombre_archivo             = "PRODUCTOS_TODO_".$fecha.'__'.$hora;
$cabecera_emp               = "PRODUCTOS_TODO";
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
require_once __DIR__ . '/class_php/Spout-2.7.3/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
$writer = WriterFactory::create(Type::XLSX);
$writer->openToBrowser($nombre_archivo);
// Headers
$writer->addRow(array('cod_productos', 'cod_productos_var', 'nombre_productos', 'cod_marcas', 'cod_proveedores', 'cod_nomenclatura', 'cod_tipo', 'cod_lineas', 'cod_ccosto', 
'cod_paises', 'numero_factura', 'unidades', 'cajas', 'und_caja', 'und_sobre', 'unidades_total', 'unidades_faltantes', 'unidades_vendidas', 'und_orig', 'precio_compra', 
'precio_costo', 'precio_venta', 'precio_venta2', 'precio_venta3', 'precio_venta4', 'precio_venta5', 'vlr_total_compra', 'vlr_total_venta', 'cod_interno', 'tope_minimo', 
'utilidad', 'total_utilidad', 'total_mercancia', 'total_venta', 'gasto', 'descuento', 'tipo_pago', 'ip', 'codificacion', 'url', 'cod_original', 'detalles', 'descripcion', 
'dto1', 'dto2', 'iva', 'iva_v', 'fechas_dia', 'fechas_mes', 'fechas_anyo', 'fechas_hora', 'fechas_vencimiento', 'porcentaje_vendedor', 'fechas_vencimiento_seg', 
'fechas_agotado', 'fechas_agotado_seg', 'vendedor', 'cuenta', 'promo', 'cod_dependencia', 'precio_compra_viejo', 'precio_costo_viejo', 'und_min_precio_venta_desc', 
'fecha_ult_compra', 'fecha_ult_venta', 'nombre_marcas', 'nombre_tipo_producto', 'nombre_tipo_referencia', 'nombre_tipo_unidad_medida', 'nombre_clase_producto', 
'cod_tercero', 'precio_ipc', 'precio_ipc_total'));
// Then a foreach
$sql = "SELECT cod_productos, cod_productos_var, nombre_productos, cod_marcas, cod_proveedores, cod_nomenclatura, cod_tipo, cod_lineas, cod_ccosto, 
cod_paises, numero_factura, unidades, cajas, und_caja, und_sobre, unidades_total, unidades_faltantes, unidades_vendidas, und_orig, precio_compra, 
precio_costo, precio_venta, precio_venta2, precio_venta3, precio_venta4, precio_venta5, vlr_total_compra, vlr_total_venta, cod_interno, tope_minimo, 
utilidad, total_utilidad, total_mercancia, total_venta, gasto, descuento, tipo_pago, ip, codificacion, url, cod_original, detalles, descripcion, 
dto1, dto2, iva, iva_v, fechas_dia, fechas_mes, fechas_anyo, fechas_hora, fechas_vencimiento, porcentaje_vendedor, fechas_vencimiento_seg, 
fechas_agotado, fechas_agotado_seg, vendedor, cuenta, promo, cod_dependencia, precio_compra_viejo, precio_costo_viejo, und_min_precio_venta_desc, 
fecha_ult_compra, fecha_ult_venta, nombre_marcas, nombre_tipo_producto, nombre_tipo_referencia, nombre_tipo_unidad_medida, nombre_clase_producto, 
cod_tercero, precio_ipc, precio_ipc_total  
FROM productos ORDER BY cod_productos DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
while ($datos = mysqli_fetch_assoc($consulta)) {

	$cod_productos                           = $datos['cod_productos'];
	$cod_productos_var                       = $datos['cod_productos_var'];
	$nombre_productos                        = $datos['nombre_productos'];
	$cod_marcas                              = $datos['cod_marcas'];
	$cod_proveedores                         = $datos['cod_proveedores'];
	$cod_nomenclatura                        = $datos['cod_nomenclatura'];
	$cod_tipo                                = $datos['cod_tipo'];
	$cod_lineas                              = $datos['cod_lineas'];
	$cod_ccosto                              = $datos['cod_ccosto'];
	$cod_paises                              = $datos['cod_paises'];
	$numero_factura                          = $datos['numero_factura'];
	$unidades                                = $datos['unidades'];
	$cajas                                   = $datos['cajas'];
	$und_caja                                = $datos['und_caja'];
	$und_sobre                               = $datos['und_sobre'];
	$unidades_total                          = $datos['unidades_total'];
	$unidades_faltantes                      = $datos['unidades_faltantes'];
	$unidades_vendidas                       = $datos['unidades_vendidas'];
	$und_orig                                = $datos['und_orig'];
	$precio_compra                           = $datos['precio_compra'];
	$precio_costo                            = $datos['precio_costo'];
	$precio_venta                            = $datos['precio_venta'];
	$precio_venta2                           = $datos['precio_venta2'];
	$precio_venta3                           = $datos['precio_venta3'];
	$precio_venta4                           = $datos['precio_venta4'];
	$precio_venta5                           = $datos['precio_venta5'];
	$vlr_total_compra                        = $datos['vlr_total_compra'];
	$vlr_total_venta                         = $datos['vlr_total_venta'];
	$cod_interno                             = $datos['cod_interno'];
	$tope_minimo                             = $datos['tope_minimo'];
	$utilidad                                = $datos['utilidad'];
	$total_utilidad                          = $datos['total_utilidad'];
	$total_mercancia                         = $datos['total_mercancia'];
	$total_venta                             = $datos['total_venta'];
	$gasto                                   = $datos['gasto'];
	$descuento                               = $datos['descuento'];
	$tipo_pago                               = $datos['tipo_pago'];
	$ip                                      = $datos['ip'];
	$codificacion                            = $datos['codificacion'];
	$url                                     = $datos['url'];
	$cod_original                            = $datos['cod_original'];
	$detalles                                = $datos['detalles'];
	$descripcion                             = $datos['descripcion'];
	$dto1                                    = $datos['dto1'];
	$dto2                                    = $datos['dto2'];
	$iva                                     = $datos['iva'];
	$iva_v                                   = $datos['iva_v'];
	$fechas_dia                              = $datos['fechas_dia'];
	$fechas_mes                              = $datos['fechas_mes'];
	$fechas_anyo                             = $datos['fechas_anyo'];
	$fechas_hora                             = $datos['fechas_hora'];
	$fechas_vencimiento                      = $datos['fechas_vencimiento'];
	$porcentaje_vendedor                     = $datos['porcentaje_vendedor'];
	$fechas_vencimiento_seg                  = $datos['fechas_vencimiento_seg'];
	$fechas_agotado                          = $datos['fechas_agotado'];
	$fechas_agotado_seg                      = $datos['fechas_agotado_seg'];
	$vendedor                                = $datos['vendedor'];
	$cuenta                                  = $datos['cuenta'];
	$promo                                   = $datos['promo'];
	$cod_dependencia                         = $datos['cod_dependencia'];
	$precio_compra_viejo                     = $datos['precio_compra_viejo'];
	$precio_costo_viejo                      = $datos['precio_costo_viejo'];
	$und_min_precio_venta_desc               = $datos['und_min_precio_venta_desc'];
	$fecha_ult_compra                        = $datos['fecha_ult_compra'];
	$fecha_ult_venta                         = $datos['fecha_ult_venta'];
	$nombre_marcas                           = $datos['nombre_marcas'];
	$nombre_tipo_producto                    = $datos['nombre_tipo_producto'];
	$nombre_tipo_referencia                  = $datos['nombre_tipo_referencia'];
	$nombre_tipo_unidad_medida               = $datos['nombre_tipo_unidad_medida'];
	$nombre_clase_producto                   = $datos['nombre_clase_producto'];
	$cod_tercero                             = $datos['cod_tercero'];
	$precio_ipc                              = $datos['precio_ipc'];
	$precio_ipc_total                        = $datos['precio_ipc_total'];

	$writer->addRow(array($cod_productos, $cod_productos_var, $nombre_productos, $cod_marcas, $cod_proveedores, $cod_nomenclatura, $cod_tipo, $cod_lineas, $cod_ccosto, 
	$cod_paises, $numero_factura, $unidades, $cajas, $und_caja, $und_sobre, $unidades_total, $unidades_faltantes, $unidades_vendidas, $und_orig, $precio_compra, 
	$precio_costo, $precio_venta, $precio_venta2, $precio_venta3, $precio_venta4, $precio_venta5, $vlr_total_compra, $vlr_total_venta, $cod_interno, $tope_minimo, 
	$utilidad, $total_utilidad, $total_mercancia, $total_venta, $gasto, $descuento, $tipo_pago, $ip, $codificacion, $url, $cod_original, $detalles, $descripcion, 
	$dto1, $dto2, $iva, $iva_v, $fechas_dia, $fechas_mes, $fechas_anyo, $fechas_hora, $fechas_vencimiento, $porcentaje_vendedor, $fechas_vencimiento_seg, 
	$fechas_agotado, $fechas_agotado_seg, $vendedor, $cuenta, $promo, $cod_dependencia, $precio_compra_viejo, $precio_costo_viejo, $und_min_precio_venta_desc, 
	$fecha_ult_compra, $fecha_ult_venta, $nombre_marcas, $nombre_tipo_producto, $nombre_tipo_referencia, $nombre_tipo_unidad_medida, $nombre_clase_producto, 
	$cod_tercero, $precio_ipc, $precio_ipc_total));
	//$writer->addRow(array((int) 00, 'Customer name', (double) 23.12, '20-01-2016'));
}
$writer->close();