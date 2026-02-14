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
$nombre_archivo             = "VENTAS_TODO_".$fecha.'__'.$hora;
$cabecera_emp               = "VENTAS_TODO";
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
require_once __DIR__ . '/class_php/Spout-2.7.3/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
$writer = WriterFactory::create(Type::CSV);
$writer->openToBrowser($nombre_archivo);
// Headers
$writer->addRow(array('cod_ventas', 'cod_productos', 'cod_factura', 'cod_clientes', 'cod_proveedores', 'cod_marcas', 'tipo_pago', 'nombre_productos', 'unidades_vendidas', 'und_vend_orig', 'und_caja', 
'und_sobre', 'devoluciones', 'precio_compra', 'precio_costo', 'precio_venta', 'vlr_total_venta', 'vlr_total_compra', 'tipo_venta', 'iva', 'iva_v', 'detalles', 'nombre_lineas', 
'nombre_ccosto', 'cod_base_caja', 'descuento', 'descuento_ptj', 'precio_compra_con_descuento', 'porcentaje_vendedor', 'vendedor', 'cuenta', 'ip', 'fecha_devolucion', 'hora_devolucion', 
'fecha_orig', 'fecha', 'fecha_mes', 'fecha_anyo', 'anyo', 'fecha_hora', 'cod_uniq_credito', 'unidades_faltantes_inv', 'fecha_pago', 'bolsa', 'cod_dependencia', 'promo', 'chk', 'fecha_ymdhis_seg', 
'cod_factura_dian', 'envio_dian', 'envio_dian_fecha_ymdhis', 'envio_dian_usuario', 'estado_temp_dian', 'cod_tipo_forma_pago', 'nombre_tipo_forma_pago', 'descripcion_tipo_forma_pago', 
'precio_servicio', 'precio_compra_viejo', 'precio_costo_viejo', 'chk2', 'nombre_tipo_factura', 'cod_info_impuesto_facturas', 'cod_info_impuesto_facturas_electronica', 'cod_cierre_caja', 
'fecha_cierre_caja', 'hora_cierre_caja', 'fecha_time_cierre_caja', 'nombre_marcas', 'nombre_tipo_producto', 'nombre_tipo_referencia', 'nombre_tipo_unidad_medida', 'nombre_clase_producto', 
'ptj_imp_consumo', 'ptj_ret_iva', 'ptj_ret_ica', 'ptj_ret_fuente', 'cod_factura_electronica', 'cod_tercero' ));
// Then a foreach
$sql = "SELECT cod_ventas, cod_productos, cod_factura, cod_clientes, cod_proveedores, cod_marcas, tipo_pago, nombre_productos, unidades_vendidas, und_vend_orig, und_caja, 
und_sobre, devoluciones, precio_compra, precio_costo, precio_venta, vlr_total_venta, vlr_total_compra, tipo_venta, iva, iva_v, detalles, nombre_lineas, 
nombre_ccosto, cod_base_caja, descuento, descuento_ptj, precio_compra_con_descuento, porcentaje_vendedor, vendedor, cuenta, ip, fecha_devolucion, hora_devolucion, 
fecha_orig, fecha, fecha_mes, fecha_anyo, anyo, fecha_hora, cod_uniq_credito, unidades_faltantes_inv, fecha_pago, bolsa, cod_dependencia, promo, chk, fecha_ymdhis_seg, 
cod_factura_dian, envio_dian, envio_dian_fecha_ymdhis, envio_dian_usuario, estado_temp_dian, cod_tipo_forma_pago, nombre_tipo_forma_pago, descripcion_tipo_forma_pago, 
precio_servicio, precio_compra_viejo, precio_costo_viejo, chk2, nombre_tipo_factura, cod_info_impuesto_facturas, cod_info_impuesto_facturas_electronica, cod_cierre_caja, 
fecha_cierre_caja, hora_cierre_caja, fecha_time_cierre_caja, nombre_marcas, nombre_tipo_producto, nombre_tipo_referencia, nombre_tipo_unidad_medida, nombre_clase_producto, 
ptj_imp_consumo, ptj_ret_iva, ptj_ret_ica, ptj_ret_fuente, cod_factura_electronica, cod_tercero 
FROM ventas ORDER BY cod_ventas DESC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
while ($datos = mysqli_fetch_assoc($consulta)) {

	$cod_ventas                              = $datos['cod_ventas'];
	$cod_productos                           = $datos['cod_productos'];
	$cod_factura                             = $datos['cod_factura'];
	$cod_clientes                            = $datos['cod_clientes'];
	$cod_proveedores                         = $datos['cod_proveedores'];
	$cod_marcas                              = $datos['cod_marcas'];
	$tipo_pago                               = $datos['tipo_pago'];
	$nombre_productos                        = $datos['nombre_productos'];
	$unidades_vendidas                       = $datos['unidades_vendidas'];
	$und_vend_orig                           = $datos['und_vend_orig'];
	$und_caja                                = $datos['und_caja'];
	$und_sobre                               = $datos['und_sobre'];
	$devoluciones                            = $datos['devoluciones'];
	$precio_compra                           = $datos['precio_compra'];
	$precio_costo                            = $datos['precio_costo'];
	$precio_venta                            = $datos['precio_venta'];
	$vlr_total_venta                         = $datos['vlr_total_venta'];
	$vlr_total_compra                        = $datos['vlr_total_compra'];
	$tipo_venta                              = $datos['tipo_venta'];
	$iva                                     = $datos['iva'];
	$iva_v                                   = $datos['iva_v'];
	$detalles                                = $datos['detalles'];
	$nombre_lineas                           = $datos['nombre_lineas'];
	$nombre_ccosto                           = $datos['nombre_ccosto'];
	$cod_base_caja                           = $datos['cod_base_caja'];
	$descuento                               = $datos['descuento'];
	$descuento_ptj                           = $datos['descuento_ptj'];
	$precio_compra_con_descuento             = $datos['precio_compra_con_descuento'];
	$porcentaje_vendedor                     = $datos['porcentaje_vendedor'];
	$vendedor                                = $datos['vendedor'];
	$cuenta                                  = $datos['cuenta'];
	$ip                                      = $datos['ip'];
	$fecha_devolucion                        = $datos['fecha_devolucion'];
	$hora_devolucion                         = $datos['hora_devolucion'];
	$fecha_orig                              = $datos['fecha_orig'];
	$fecha                                   = $datos['fecha'];
	$fecha_mes                               = $datos['fecha_mes'];
	$fecha_anyo                              = $datos['fecha_anyo'];
	$anyo                                    = $datos['anyo'];
	$fecha_hora                              = $datos['fecha_hora'];
	$cod_uniq_credito                        = $datos['cod_uniq_credito'];
	$unidades_faltantes_inv                  = $datos['unidades_faltantes_inv'];
	$fecha_pago                              = $datos['fecha_pago'];
	$bolsa                                   = $datos['bolsa'];
	$cod_dependencia                         = $datos['cod_dependencia'];
	$promo                                   = $datos['promo'];
	$chk                                     = $datos['chk'];
	$fecha_ymdhis_seg                        = $datos['fecha_ymdhis_seg'];
	$cod_factura_dian                        = $datos['cod_factura_dian'];
	$envio_dian                              = $datos['envio_dian'];
	$envio_dian_fecha_ymdhis                 = $datos['envio_dian_fecha_ymdhis'];
	$envio_dian_usuario                      = $datos['envio_dian_usuario'];
	$estado_temp_dian                        = $datos['estado_temp_dian'];
	$cod_tipo_forma_pago                     = $datos['cod_tipo_forma_pago'];
	$nombre_tipo_forma_pago                  = $datos['nombre_tipo_forma_pago'];
	$descripcion_tipo_forma_pago             = $datos['descripcion_tipo_forma_pago'];
	$precio_servicio                         = $datos['precio_servicio'];
	$precio_compra_viejo                     = $datos['precio_compra_viejo'];
	$precio_costo_viejo                      = $datos['precio_costo_viejo'];
	$chk2                                    = $datos['chk2'];
	$nombre_tipo_factura                     = $datos['nombre_tipo_factura'];
	$cod_info_impuesto_facturas              = $datos['cod_info_impuesto_facturas'];
	$cod_info_impuesto_facturas_electronica  = $datos['cod_info_impuesto_facturas_electronica'];
	$cod_cierre_caja                         = $datos['cod_cierre_caja'];
	$fecha_cierre_caja                       = $datos['fecha_cierre_caja'];
	$hora_cierre_caja                        = $datos['hora_cierre_caja'];
	$fecha_time_cierre_caja                  = $datos['fecha_time_cierre_caja'];
	$nombre_marcas                           = $datos['nombre_marcas'];
	$nombre_tipo_producto                    = $datos['nombre_tipo_producto'];
	$nombre_tipo_referencia                  = $datos['nombre_tipo_referencia'];
	$nombre_tipo_unidad_medida               = $datos['nombre_tipo_unidad_medida'];
	$nombre_clase_producto                   = $datos['nombre_clase_producto'];
	$ptj_imp_consumo                         = $datos['ptj_imp_consumo'];
	$ptj_ret_iva                             = $datos['ptj_ret_iva'];
	$ptj_ret_ica                             = $datos['ptj_ret_ica'];
	$ptj_ret_fuente                          = $datos['ptj_ret_fuente'];
	$cod_factura_electronica                 = $datos['cod_factura_electronica'];
	$cod_tercero                             = $datos['cod_tercero'];

	$writer->addRow(array($cod_ventas, $cod_productos, $cod_factura, $cod_clientes, $cod_proveedores, $cod_marcas, $tipo_pago, $nombre_productos, $unidades_vendidas, $und_vend_orig, $und_caja, 
	$und_sobre, $devoluciones, $precio_compra, $precio_costo, $precio_venta, $vlr_total_venta, $vlr_total_compra, $tipo_venta, $iva, $iva_v, $detalles, $nombre_lineas, 
	$nombre_ccosto, $cod_base_caja, $descuento, $descuento_ptj, $precio_compra_con_descuento, $porcentaje_vendedor, $vendedor, $cuenta, $ip, $fecha_devolucion, $hora_devolucion, 
	$fecha_orig, $fecha, $fecha_mes, $fecha_anyo, $anyo, $fecha_hora, $cod_uniq_credito, $unidades_faltantes_inv, $fecha_pago, $bolsa, $cod_dependencia, $promo, $chk, $fecha_ymdhis_seg, 
	$cod_factura_dian, $envio_dian, $envio_dian_fecha_ymdhis, $envio_dian_usuario, $estado_temp_dian, $cod_tipo_forma_pago, $nombre_tipo_forma_pago, $descripcion_tipo_forma_pago, 
	$precio_servicio, $precio_compra_viejo, $precio_costo_viejo, $chk2, $nombre_tipo_factura, $cod_info_impuesto_facturas, $cod_info_impuesto_facturas_electronica, $cod_cierre_caja, 
	$fecha_cierre_caja, $hora_cierre_caja, $fecha_time_cierre_caja, $nombre_marcas, $nombre_tipo_producto, $nombre_tipo_referencia, $nombre_tipo_unidad_medida, $nombre_clase_producto, 
	$ptj_imp_consumo, $ptj_ret_iva, $ptj_ret_ica, $ptj_ret_fuente, $cod_factura_electronica, $cod_tercero));
	//$writer->addRow(array((int) 00, 'Customer name', (double) 23.12, '20-01-2016'));
}
$writer->close();