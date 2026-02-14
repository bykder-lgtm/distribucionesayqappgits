<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
//$tamano_archivo = $_FILES['csv']['size'];
require_once __DIR__ . '/class_php/Spout-2.7.3/Spout/Autoloader/autoload.php';
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

//$nombre_actualizaciones                = time().'-'.$_FILES['file']['name'];
$fecha                                   = date("d/m/Y");
$fecha_invert                            = date("Y/m/d");
$hora                                    = date("H:i:s");
$ip                                      = $_SERVER['REMOTE_ADDR'];
$fecha_cargue                            = date("Y/m/d - H:i:s");
$fecha_llegada                           = date("d/m/Y");
//$url_archivo                           = "../facturas_cargadas/".$nombre_actualizaciones;

$ruta_archivador                         = "../facturas_cargadas/";
$nombre_archivo                          = "PRODUCTOS_TODO.ods";                     
$ruta_archivo_excel                      = $ruta_archivador.$nombre_archivo;                     
$contador                                = 0;

$cod_productos                           = '';
$cod_productos_var                       = '';
$nombre_productos                        = '';
$cod_marcas                              = '';
$cod_proveedores                         = '';
$cod_nomenclatura                        = '';
$cod_tipo                                = '';
$cod_lineas                              = '';
$cod_ccosto                              = '';
$cod_paises                              = '';
$numero_factura                          = '';
$unidades                                = '';
$cajas                                   = '';
$und_caja                                = '';
$und_sobre                               = '';
$unidades_total                          = '';
$unidades_faltantes                      = '';
$unidades_vendidas                       = '';
$und_orig                                = '';
$precio_compra                           = '';
$precio_costo                            = '';
$precio_venta                            = '';
$precio_venta2                           = '';
$precio_venta3                           = '';
$precio_venta4                           = '';
$precio_venta5                           = '';
$vlr_total_compra                        = '';
$vlr_total_venta                         = '';
$cod_interno                             = '';
$tope_minimo                             = '';
$utilidad                                = '';
$total_utilidad                          = '';
$total_mercancia                         = '';
$total_venta                             = '';
$gasto                                   = '';
$descuento                               = '';
$tipo_pago                               = '';
$ip                                      = '';
$codificacion                            = '';
$url                                     = '';
$cod_original                            = '';
$detalles                                = '';
$descripcion                             = '';
$dto1                                    = '';
$dto2                                    = '';
$iva                                     = '';
$iva_v                                   = '';
$fechas_dia                              = '';
$fechas_mes                              = '';
$fechas_anyo                             = '';
$fechas_hora                             = '';
$fechas_vencimiento                      = '';
$porcentaje_vendedor                     = '';
$fechas_vencimiento_seg                  = '';
$fechas_agotado                          = '';
$fechas_agotado_seg                      = '';
$vendedor                                = '';
$cuenta                                  = '';
$promo                                   = '';
$cod_dependencia                         = '';
$precio_compra_viejo                     = '';
$precio_costo_viejo                      = '';
$und_min_precio_venta_desc               = '';
$fecha_ult_compra                        = '';
$fecha_ult_venta                         = '';
$nombre_marcas                           = '';
$nombre_tipo_producto                    = '';
$nombre_tipo_referencia                  = '';
$nombre_tipo_unidad_medida               = '';
$nombre_clase_producto                   = '';
$cod_tercero                             = '';
$precio_ipc                              = '';
$precio_ipc_total                        = '';

try {
	//Lokasi file excel       
	$leer_documento_excel = ReaderFactory::create(Type::ODS); //set Type file xlsx
	$leer_documento_excel->open($ruta_archivo_excel); //open the file          

	foreach ($leer_documento_excel->getSheetIterator() as $contar_hojas) {
	//Rows iterator                
		foreach ($contar_hojas->getRowIterator() as $datos_reg_excel) {
			++$contador;
			if ($contador > 1) {

				$cod_productos                           = ($datos_reg_excel['cod_productos']);
				$cod_productos_var                       = ($datos_reg_excel['cod_productos_var']);
				$nombre_productos                        = ($datos_reg_excel['nombre_productos']);
				$cod_marcas                              = ($datos_reg_excel['cod_marcas']);
				$cod_proveedores                         = ($datos_reg_excel['cod_proveedores']);
				$cod_nomenclatura                        = ($datos_reg_excel['cod_nomenclatura']);
				$cod_tipo                                = ($datos_reg_excel['cod_tipo']);
				$cod_lineas                              = ($datos_reg_excel['cod_lineas']);
				$cod_ccosto                              = ($datos_reg_excel['cod_ccosto']);
				$cod_paises                              = ($datos_reg_excel['cod_paises']);
				$numero_factura                          = ($datos_reg_excel['numero_factura']);
				$unidades                                = ($datos_reg_excel['unidades']);
				$cajas                                   = ($datos_reg_excel['cajas']);
				$und_caja                                = ($datos_reg_excel['und_caja']);
				$und_sobre                               = ($datos_reg_excel['und_sobre']);
				$unidades_total                          = ($datos_reg_excel['unidades_total']);
				$unidades_faltantes                      = ($datos_reg_excel['unidades_faltantes']);
				$unidades_vendidas                       = ($datos_reg_excel['unidades_vendidas']);
				$und_orig                                = ($datos_reg_excel['und_orig']);
				$precio_compra                           = ($datos_reg_excel['precio_compra']);
				$precio_costo                            = ($datos_reg_excel['precio_costo']);
				$precio_venta                            = ($datos_reg_excel['precio_venta']);
				$precio_venta2                           = ($datos_reg_excel['precio_venta2']);
				$precio_venta3                           = ($datos_reg_excel['precio_venta3']);
				$precio_venta4                           = ($datos_reg_excel['precio_venta4']);
				$precio_venta5                           = ($datos_reg_excel['precio_venta5']);
				$vlr_total_compra                        = ($datos_reg_excel['vlr_total_compra']);
				$vlr_total_venta                         = ($datos_reg_excel['vlr_total_venta']);
				$cod_interno                             = ($datos_reg_excel['cod_interno']);
				$tope_minimo                             = ($datos_reg_excel['tope_minimo']);
				$utilidad                                = ($datos_reg_excel['utilidad']);
				$total_utilidad                          = ($datos_reg_excel['total_utilidad']);
				$total_mercancia                         = ($datos_reg_excel['total_mercancia']);
				$total_venta                             = ($datos_reg_excel['total_venta']);
				$gasto                                   = ($datos_reg_excel['gasto']);
				$descuento                               = ($datos_reg_excel['descuento']);
				$tipo_pago                               = ($datos_reg_excel['tipo_pago']);
				$ip                                      = ($datos_reg_excel['ip']);
				$codificacion                            = ($datos_reg_excel['codificacion']);
				$url                                     = ($datos_reg_excel['url']);
				$cod_original                            = ($datos_reg_excel['cod_original']);
				$detalles                                = ($datos_reg_excel['detalles']);
				$descripcion                             = ($datos_reg_excel['descripcion']);
				$dto1                                    = ($datos_reg_excel['dto1']);
				$dto2                                    = ($datos_reg_excel['dto2']);
				$iva                                     = ($datos_reg_excel['iva']);
				$iva_v                                   = ($datos_reg_excel['iva_v']);
				$fechas_dia                              = ($datos_reg_excel['fechas_dia']);
				$fechas_mes                              = ($datos_reg_excel['fechas_mes']);
				$fechas_anyo                             = ($datos_reg_excel['fechas_anyo']);
				$fechas_hora                             = ($datos_reg_excel['fechas_hora']);
				$fechas_vencimiento                      = ($datos_reg_excel['fechas_vencimiento']);
				$porcentaje_vendedor                     = ($datos_reg_excel['porcentaje_vendedor']);
				$fechas_vencimiento_seg                  = ($datos_reg_excel['fechas_vencimiento_seg']);
				$fechas_agotado                          = ($datos_reg_excel['fechas_agotado']);
				$fechas_agotado_seg                      = ($datos_reg_excel['fechas_agotado_seg']);
				$vendedor                                = ($datos_reg_excel['vendedor']);
				$cuenta                                  = ($datos_reg_excel['cuenta']);
				$promo                                   = ($datos_reg_excel['promo']);
				$cod_dependencia                         = ($datos_reg_excel['cod_dependencia']);
				$precio_compra_viejo                     = ($datos_reg_excel['precio_compra_viejo']);
				$precio_costo_viejo                      = ($datos_reg_excel['precio_costo_viejo']);
				$und_min_precio_venta_desc               = ($datos_reg_excel['und_min_precio_venta_desc']);
				$fecha_ult_compra                        = ($datos_reg_excel['fecha_ult_compra']);
				$fecha_ult_venta                         = ($datos_reg_excel['fecha_ult_venta']);
				$nombre_marcas                           = ($datos_reg_excel['nombre_marcas']);
				$nombre_tipo_producto                    = ($datos_reg_excel['nombre_tipo_producto']);
				$nombre_tipo_referencia                  = ($datos_reg_excel['nombre_tipo_referencia']);
				$nombre_tipo_unidad_medida               = ($datos_reg_excel['nombre_tipo_unidad_medida']);
				$nombre_clase_producto                   = ($datos_reg_excel['nombre_clase_producto']);
				$cod_tercero                             = ($datos_reg_excel['cod_tercero']);
				$precio_ipc                              = ($datos_reg_excel['precio_ipc']);
				$precio_ipc_total                        = ($datos_reg_excel['precio_ipc_total']);

				$query = "INSERT INTO productos (cod_productos, cod_productos_var, nombre_productos, cod_marcas, cod_proveedores, cod_nomenclatura, cod_tipo, cod_lineas, cod_ccosto, 
				cod_paises, numero_factura, unidades, cajas, und_caja, und_sobre, unidades_total, unidades_faltantes, unidades_vendidas, und_orig, precio_compra, 
				precio_costo, precio_venta, precio_venta2, precio_venta3, precio_venta4, precio_venta5, vlr_total_compra, vlr_total_venta, cod_interno, tope_minimo, 
				utilidad, total_utilidad, total_mercancia, total_venta, gasto, descuento, tipo_pago, ip, codificacion, url, cod_original, detalles, descripcion, 
				dto1, dto2, iva, iva_v, fechas_dia, fechas_mes, fechas_anyo, fechas_hora, fechas_vencimiento, porcentaje_vendedor, fechas_vencimiento_seg, 
				fechas_agotado, fechas_agotado_seg, vendedor, cuenta, promo, cod_dependencia, precio_compra_viejo, precio_costo_viejo, und_min_precio_venta_desc, 
				fecha_ult_compra, fecha_ult_venta, nombre_marcas, nombre_tipo_producto, nombre_tipo_referencia, nombre_tipo_unidad_medida, nombre_clase_producto, 
				cod_tercero, precio_ipc, precio_ipc_total) 
				VALUES ('$cod_productos', '$cod_productos_var', '$nombre_productos', '$cod_marcas', '$cod_proveedores', '$cod_nomenclatura', '$cod_tipo', '$cod_lineas', '$cod_ccosto', 
				'$cod_paises', '$numero_factura', '$unidades', '$cajas', '$und_caja', '$und_sobre', '$unidades_total', '$unidades_faltantes', '$unidades_vendidas', '$und_orig', '$precio_compra', 
				'$precio_costo', '$precio_venta', '$precio_venta2', '$precio_venta3', '$precio_venta4', '$precio_venta5', '$vlr_total_compra', '$vlr_total_venta', '$cod_interno', '$tope_minimo', 
				'$utilidad', '$total_utilidad', '$total_mercancia', '$total_venta', '$gasto', '$descuento', '$tipo_pago', '$ip', '$codificacion', '$url', '$cod_original', '$detalles', '$descripcion', 
				'$dto1', '$dto2', '$iva', '$iva_v', '$fechas_dia', '$fechas_mes', '$fechas_anyo', '$fechas_hora', '$fechas_vencimiento', '$porcentaje_vendedor', '$fechas_vencimiento_seg', 
				'$fechas_agotado', '$fechas_agotado_seg', '$vendedor', '$cuenta', '$promo', '$cod_dependencia', '$precio_compra_viejo', '$precio_costo_viejo', '$und_min_precio_venta_desc', 
				'$fecha_ult_compra', '$fecha_ult_venta', '$nombre_marcas', '$nombre_tipo_producto', '$nombre_tipo_referencia', '$nombre_tipo_unidad_medida', '$nombre_clase_producto', 
				'$cod_tercero', '$precio_ipc', '$precio_ipc_total')";
				$resultados = mysqli_query($conectar, $query) or die(mysqli_error($conectar));
			}
		}
		$agregar_registros_sql1 = "INSERT INTO actualizaciones (nombre_actualizaciones, fecha, fecha_invert, hora, ip) 
		VALUES ('$nombre_actualizaciones', '$fecha', '$fecha_invert', '$hora', '$ip')";
		$resultado_sql1 = mysqli_query($conectar, $agregar_registros_sql1) or die(mysqli_error($conectar));

		$agregar_registros_sql1 = ("INSERT INTO facturas_cargadas (fecha_llegada, nombre_archivo, url_archivo, fecha_cargue) 
		VALUES ('$fecha_llegada', '$nombre_archivo', '$url_archivo', '$fecha_cargue')");
		$resultado_sql1 = mysqli_query($conectar, $agregar_registros_sql1) or die(mysqli_error($conectar));

		echo "<br><br><center><font color='yellow' size= '+2'>SE HA ACTUALIZADO CORRECTAMENTE LA TABLA VENTAS</font></center>";
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='4; menu_subir_archivo_spout_vendedor.php'>";
	}
    $leer_documento_excel->close();
//"Peak memory:", (memory_get_peak_usage(true) / 1024 / 1024), " MB";
} catch (Exception $e) { echo $e->getMessage(); exit; }
?>