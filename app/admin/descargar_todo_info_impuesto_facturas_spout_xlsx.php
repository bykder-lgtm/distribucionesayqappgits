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
$nombre_archivo             = "INFO_IMPUESTO_FACTURAS_TODO_".$fecha.'__'.$hora;
$cabecera_emp               = "INFO_IMPUESTO_FACTURAS_TODO";
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
require_once __DIR__ . '/class_php/Spout-2.7.3/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
$writer = WriterFactory::create(Type::XLSX);
$writer->openToBrowser($nombre_archivo);
// Headers
$writer->addRow(array('cod_info_impuesto_facturas', 'descuento', 'iva', 'flete', 'cod_factura', 'cod_clientes', 'vlr_cancelado', 'vlr_vuelto', 'vendedor', 
'estado', 'fecha_dia', 'fecha_mes', 'fecha_anyo', 'anyo', 'fecha_hora', 'tipo_pago', 'fecha_remision', 'nombre_ccosto', 'garantia_meses', 'observacion', 
'bolsa', 'cod_base_caja', 'tiempo_ejecucion', 'envio_dian', 'envio_dian_fecha_ymdhis', 'envio_dian_usuario', 'cod_factura_dian', 'cod_tipo_forma_pago', 
'nombre_tipo_forma_pago', 'descripcion_tipo_forma_pago', 'servicio', 'nombre_tipo_factura', 'nombre_tipo_moneda', 'cod_factura_electronica', 
'ptj_ipc', 'precio_ipc', 'precio_ipc_total', 'cod_dependencia'));
// Then a foreach
	$sql = "SELECT cod_info_impuesto_facturas, descuento, iva, flete, cod_factura, cod_clientes, vlr_cancelado, vlr_vuelto, vendedor, 
	estado, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, tipo_pago, fecha_remision, nombre_ccosto, garantia_meses, observacion, 
	bolsa, cod_base_caja, tiempo_ejecucion, envio_dian, envio_dian_fecha_ymdhis, envio_dian_usuario, cod_factura_dian, cod_tipo_forma_pago, 
	nombre_tipo_forma_pago, descripcion_tipo_forma_pago, servicio, nombre_tipo_factura, nombre_tipo_moneda, cod_factura_electronica, 
	ptj_ipc, precio_ipc, precio_ipc_total, cod_dependencia 
	FROM info_impuesto_facturas ORDER BY cod_info_impuesto_facturas DESC";
	$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
	while ($datos = mysqli_fetch_assoc($consulta)) {

	$cod_info_impuesto_facturas              = $datos['cod_info_impuesto_facturas'];
	$descuento                               = $datos['descuento'];
	$iva                                     = $datos['iva'];
	$flete                                   = $datos['flete'];
	$cod_factura                             = $datos['cod_factura'];
	$cod_clientes                            = $datos['cod_clientes'];
	$vlr_cancelado                           = $datos['vlr_cancelado'];
	$vlr_vuelto                              = $datos['vlr_vuelto'];
	$vendedor                                = $datos['vendedor'];
	$estado                                  = $datos['estado'];
	$fecha_dia                               = $datos['fecha_dia'];
	$fecha_mes                               = $datos['fecha_mes'];
	$fecha_anyo                              = $datos['fecha_anyo'];
	$anyo                                    = $datos['anyo'];
	$fecha_hora                              = $datos['fecha_hora'];
	$tipo_pago                               = $datos['tipo_pago'];
	$fecha_remision                          = $datos['fecha_remision'];
	$nombre_ccosto                           = $datos['nombre_ccosto'];
	$garantia_meses                          = $datos['garantia_meses'];
	$observacion                             = $datos['observacion'];
	$bolsa                                   = $datos['bolsa'];
	$cod_base_caja                           = $datos['cod_base_caja'];
	$tiempo_ejecucion                        = $datos['tiempo_ejecucion'];
	$envio_dian                              = $datos['envio_dian'];
	$envio_dian_fecha_ymdhis                 = $datos['envio_dian_fecha_ymdhis'];
	$envio_dian_usuario                      = $datos['envio_dian_usuario'];
	$cod_factura_dian                        = $datos['cod_factura_dian'];
	$cod_tipo_forma_pago                     = $datos['cod_tipo_forma_pago'];
	$nombre_tipo_forma_pago                  = $datos['nombre_tipo_forma_pago'];
	$descripcion_tipo_forma_pago             = $datos['descripcion_tipo_forma_pago'];
	$servicio                                = $datos['servicio'];
	$nombre_tipo_factura                     = $datos['nombre_tipo_factura'];
	$nombre_tipo_moneda                      = $datos['nombre_tipo_moneda'];
	$cod_factura_electronica                 = $datos['cod_factura_electronica'];
	$ptj_ipc                                 = $datos['ptj_ipc'];
	$precio_ipc                              = $datos['precio_ipc'];
	$precio_ipc_total                        = $datos['precio_ipc_total'];
	$cod_dependencia                         = $datos['cod_dependencia'];

	$writer->addRow(array($cod_info_impuesto_facturas, $descuento, $iva, $flete, $cod_factura, $cod_clientes, $vlr_cancelado, $vlr_vuelto, $vendedor, 
	$estado, $fecha_dia, $fecha_mes, $fecha_anyo, $anyo, $fecha_hora, $tipo_pago, $fecha_remision, $nombre_ccosto, $garantia_meses, $observacion, 
	$bolsa, $cod_base_caja, $tiempo_ejecucion, $envio_dian, $envio_dian_fecha_ymdhis, $envio_dian_usuario, $cod_factura_dian, $cod_tipo_forma_pago, 
	$nombre_tipo_forma_pago, $descripcion_tipo_forma_pago, $servicio, $nombre_tipo_factura, $nombre_tipo_moneda, $cod_factura_electronica, 
	$ptj_ipc, $precio_ipc, $precio_ipc_total, $cod_dependencia));
	//$writer->addRow(array((int) 00, 'Customer name', (double) 23.12, '20-01-2016'));
}
$writer->close();