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

$nombre_actualizaciones       = time().'-'.$_FILES['file']['name'];
$fecha                        = date("d/m/Y");
$fecha_invert                 = date("Y/m/d");
$hora                         = date("H:i:s");
$ip                           = $_SERVER['REMOTE_ADDR'];
$fecha_cargue                 = date("Y/m/d - H:i:s");
$fecha_llegada                = date("d/m/Y");
//$url_archivo                  = "../facturas_cargadas/".$nombre_actualizaciones;

$ruta_archivador              = "../facturas_cargadas/";
$nombre_archivo               = "VENTAS_TODO.xlsx";                     
$ruta_archivo_excel           = $ruta_archivador.$nombre_archivo;                     
$contador                     = 0;

$cod_ventas                   = "";
$cod_productos                = '';
$cod_factura                  = '';
$cod_clientes = '';
$cod_proveedores = '';
$cod_marcas = '';
$tipo_pago = '';
$nombre_productos = '';
$unidades_vendidas = '';
$und_vend_orig = '';
$und_caja = '';
$und_sobre = '';
$devoluciones = '';
$precio_compra = '';
$precio_costo = '';
$precio_venta = '';
$vlr_total_venta = '';
$vlr_total_compra = '';
$comentario = '';
$tipo_venta = '';
$iva = '';
$iva_v = '';
$detalles = '';
$nombre_lineas = '';
$nombre_ccosto = '';
$cod_base_caja = '';
$descuento = '';
$descuento_ptj = '';
$precio_compra_con_descuento = '';
$porcentaje_vendedor = '';
$vendedor = '';
$cuenta = '';
$ip = '';
$fecha_devolucion = '';
$hora_devolucion = '';
$fecha_orig = '';
$fecha = '';
$fecha_mes = '';
$fecha_anyo = '';
$anyo = '';
$fecha_hora = '';
$cod_uniq_credito = '';
$unidades_faltantes_inv = '';
$fecha_pago = '';
$bolsa = '';
$cod_dependencia = '';
$promo = '';
$chk = '';
$fecha_ymdhis_seg = '';
$cod_factura_dian = '';
$envio_dian = '';
$envio_dian_fecha_ymdhis = '';
$envio_dian_usuario = '';
$estado_temp_dian = '';
$cod_tipo_forma_pago = '';
$nombre_tipo_forma_pago = '';
$descripcion_tipo_forma_pago = '';
$precio_servicio = '';
$precio_compra_viejo = '';
$precio_costo_viejo = '';
$chk2 = '';
$nombre_tipo_factura = '';
$cod_info_impuesto_facturas = '';
$cod_info_impuesto_facturas_electronica = '';
$cod_cierre_caja = '';
$fecha_cierre_caja = '';
$hora_cierre_caja = '';
$fecha_time_cierre_caja = '';
$nombre_marcas = '';
$nombre_tipo_producto = '';
$nombre_tipo_referencia = '';
$nombre_tipo_unidad_medida = '';
$nombre_clase_producto = '';
$ptj_imp_consumo = '';
$ptj_ret_iva = '';
$ptj_ret_ica = '';
$ptj_ret_fuente = '';
$cod_factura_electronica = '';
$cod_tercero = '';

try {
	//Lokasi file excel       
	$leer_documento_excel = ReaderFactory::create(Type::XLSX); //set Type file xlsx
	$leer_documento_excel->open($ruta_archivo_excel); //open the file

	foreach ($leer_documento_excel->getSheetIterator() as $contar_hojas) {
	//Rows iterator                
		foreach ($contar_hojas->getRowIterator() as $datos_reg_excel) {
	 		++$contador;
			if ($contador > 1) {
				$cod_ventas                  = ($datos_reg_excel[0]);
				$cod_productos = ($datos_reg_excel[1]);
				$cod_factura = ($datos_reg_excel[2]);
				$cod_clientes = ($datos_reg_excel[3]);
				$cod_proveedores = ($datos_reg_excel[4]);
				$cod_marcas = ($datos_reg_excel[5]);
				$tipo_pago = ($datos_reg_excel[6]);
				$nombre_productos = ($datos_reg_excel[7]);
				$unidades_vendidas = ($datos_reg_excel[8]);
				$und_vend_orig = ($datos_reg_excel[9]);
				$und_caja = ($datos_reg_excel[10]);
				$und_sobre = ($datos_reg_excel[11]);
				$devoluciones = ($datos_reg_excel[12]);
				$precio_compra = ($datos_reg_excel[13]);
				$precio_costo = ($datos_reg_excel[14]);
				$precio_venta = ($datos_reg_excel[15]);
				$vlr_total_venta = ($datos_reg_excel[16]);
				$vlr_total_compra = ($datos_reg_excel[17]);
				$comentario = ($datos_reg_excel[18]);
				$tipo_venta = ($datos_reg_excel[19]);
				$iva = ($datos_reg_excel[20]);
				$iva_v = ($datos_reg_excel[21]);
				$detalles = ($datos_reg_excel[22]);
				$nombre_lineas = ($datos_reg_excel[23]);
				$nombre_ccosto = ($datos_reg_excel[24]);
				$cod_base_caja = ($datos_reg_excel[25]);
				$descuento = ($datos_reg_excel[26]);
				$descuento_ptj = ($datos_reg_excel[27]);
				$precio_compra_con_descuento = ($datos_reg_excel[28]);
				$porcentaje_vendedor = ($datos_reg_excel[29]);
				$vendedor = ($datos_reg_excel[30]);
				$cuenta = ($datos_reg_excel[31]);
				$ip = ($datos_reg_excel[32]);
				$fecha_devolucion = ($datos_reg_excel[33]);
				$hora_devolucion = ($datos_reg_excel[34]);
				$fecha_orig = ($datos_reg_excel[35]);
				$fecha = ($datos_reg_excel[36]);
				$fecha_mes = ($datos_reg_excel[37]);
				$fecha_anyo = ($datos_reg_excel[38]);
				$anyo = ($datos_reg_excel[39]);
				$fecha_hora = ($datos_reg_excel[40]);
				$cod_uniq_credito = ($datos_reg_excel[41]);
				$unidades_faltantes_inv = ($datos_reg_excel[42]);
				$fecha_pago = ($datos_reg_excel[43]);
				$bolsa = ($datos_reg_excel[44]);
				$cod_dependencia = ($datos_reg_excel[45]);
				$promo = ($datos_reg_excel[46]);
				$chk = ($datos_reg_excel[47]);
				$fecha_ymdhis_seg = ($datos_reg_excel[48]);
				$cod_factura_dian = ($datos_reg_excel[49]);
				$envio_dian = ($datos_reg_excel[50]);
				$envio_dian_fecha_ymdhis = ($datos_reg_excel[51]);
				$envio_dian_usuario = ($datos_reg_excel[52]);
				$estado_temp_dian = ($datos_reg_excel[53]);
				$cod_tipo_forma_pago = ($datos_reg_excel[54]);
				$nombre_tipo_forma_pago = ($datos_reg_excel[55]);
				$descripcion_tipo_forma_pago = ($datos_reg_excel[56]);
				$precio_servicio = ($datos_reg_excel[57]);
				$precio_compra_viejo = ($datos_reg_excel[58]);
				$precio_costo_viejo = ($datos_reg_excel[59]);
				$chk2 = ($datos_reg_excel[60]);
				$nombre_tipo_factura = ($datos_reg_excel[61]);
				$cod_info_impuesto_facturas = ($datos_reg_excel[62]);
				$cod_info_impuesto_facturas_electronica = ($datos_reg_excel[63]);
				$cod_cierre_caja = ($datos_reg_excel[64]);
				$fecha_cierre_caja = ($datos_reg_excel[65]);
				$hora_cierre_caja = ($datos_reg_excel[66]);
				$fecha_time_cierre_caja = ($datos_reg_excel[67]);
				$nombre_marcas = ($datos_reg_excel[68]);
				$nombre_tipo_producto = ($datos_reg_excel[69]);
				$nombre_tipo_referencia = ($datos_reg_excel[70]);
				$nombre_tipo_unidad_medida = ($datos_reg_excel[71]);
				$nombre_clase_producto = ($datos_reg_excel[72]);
				$ptj_imp_consumo = ($datos_reg_excel[73]);
				$ptj_ret_iva = ($datos_reg_excel[74]);
				$ptj_ret_ica = ($datos_reg_excel[75]);
				$ptj_ret_fuente = ($datos_reg_excel[76]);
				$cod_factura_electronica = ($datos_reg_excel[77]);
				$cod_tercero = ($datos_reg_excel[78]);

				$query = "INSERT INTO ventas (cod_ventas, cod_productos, cod_factura, cod_clientes, cod_proveedores, cod_marcas, 
				tipo_pago, nombre_productos, unidades_vendidas, und_vend_orig, und_caja, und_sobre, devoluciones, 
				precio_compra, precio_costo, precio_venta, vlr_total_venta, vlr_total_compra, comentario, tipo_venta, 
				iva, iva_v, detalles, nombre_lineas, nombre_ccosto, cod_base_caja, descuento, descuento_ptj, 
				precio_compra_con_descuento, porcentaje_vendedor, vendedor, cuenta, ip, fecha_devolucion, 
				hora_devolucion, fecha_orig, fecha, fecha_mes, fecha_anyo, anyo, fecha_hora, cod_uniq_credito, 
				unidades_faltantes_inv, fecha_pago, bolsa, cod_dependencia, promo, chk, fecha_ymdhis_seg, 
				cod_factura_dian, envio_dian, envio_dian_fecha_ymdhis, envio_dian_usuario, estado_temp_dian, 
				cod_tipo_forma_pago, nombre_tipo_forma_pago, descripcion_tipo_forma_pago, precio_servicio, 
				precio_compra_viejo, precio_costo_viejo, chk2, nombre_tipo_factura, cod_info_impuesto_facturas, 
				cod_info_impuesto_facturas_electronica, cod_cierre_caja, fecha_cierre_caja, hora_cierre_caja, 
				fecha_time_cierre_caja, nombre_marcas, nombre_tipo_producto, nombre_tipo_referencia, nombre_tipo_unidad_medida, 
				nombre_clase_producto, ptj_imp_consumo, ptj_ret_iva, ptj_ret_ica, ptj_ret_fuente, cod_factura_electronica, cod_tercero) 
				VALUES ('".$cod_ventas."', '".$cod_productos."', '".$cod_factura."', '".$cod_clientes."', '".$cod_proveedores."', '".$cod_marcas."', 
				'".$tipo_pago."', '".$nombre_productos."', '".$unidades_vendidas."', '".$und_vend_orig."', '".$und_caja."', '".$und_sobre."', '".$devoluciones."', 
				'".$precio_compra."', '".$precio_costo."', '".$precio_venta."', '".$vlr_total_venta."', '".$vlr_total_compra."', '".$comentario."', '".$tipo_venta."', 
				'".$iva."', '".$iva_v."', '".$detalles."', '".$nombre_lineas."', '".$nombre_ccosto."', '".$cod_base_caja."', '".$descuento."', '".$descuento_ptj."', 
				'".$precio_compra_con_descuento."', '".$porcentaje_vendedor."', '".$vendedor."', '".$cuenta."', '".$ip."', '".$fecha_devolucion."', 
				'".$hora_devolucion."', '".$fecha_orig."', '".$fecha."', '".$fecha_mes."', '".$fecha_anyo."', '".$anyo."', '".$fecha_hora."', '".$cod_uniq_credito."', 
				'".$unidades_faltantes_inv."', '".$fecha_pago."', '".$bolsa."', '".$cod_dependencia."', '".$promo."', '".$chk."', '".$fecha_ymdhis_seg."', 
				'".$cod_factura_dian."', '".$envio_dian."', '".$envio_dian_fecha_ymdhis."', '".$envio_dian_usuario."', '".$estado_temp_dian."', 
				'".$cod_tipo_forma_pago."', '".$nombre_tipo_forma_pago."', '".$descripcion_tipo_forma_pago."', '".$precio_servicio."', 
				'".$precio_compra_viejo."', '".$precio_costo_viejo."', '".$chk2."', '".$nombre_tipo_factura."', '".$cod_info_impuesto_facturas."', 
				'".$cod_info_impuesto_facturas_electronica."', '".$cod_cierre_caja."', '".$fecha_cierre_caja."', '".$hora_cierre_caja."', 
				'".$fecha_time_cierre_caja."', '".$nombre_marcas."', '".$nombre_tipo_producto."', '".$nombre_tipo_referencia."', '".$nombre_tipo_unidad_medida."', 
				'".$nombre_clase_producto."', '".$ptj_imp_consumo."', '".$ptj_ret_iva."', '".$ptj_ret_ica."', '".$ptj_ret_fuente."', '".$cod_factura_electronica."', '".$cod_tercero."')";
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

} catch (Exception $e) { echo $e->getMessage(); exit; }
?>