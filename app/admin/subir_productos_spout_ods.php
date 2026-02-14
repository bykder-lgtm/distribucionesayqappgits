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
$nombre_archivo               = "PRODUCTOS_TODO.ods";                     
$ruta_archivo_excel           = $ruta_archivador.$nombre_archivo;                     
$contador                     = 0;

$cod_productos                = '';
$cod_productos_var = '';
$nombre_productos = '';
$cod_marcas = '';
$cod_proveedores = '';
$cod_nomenclatura = '';
$cod_tipo = '';
$cod_lineas = '';
$cod_ccosto = '';
$cod_paises = '';
$numero_factura = '';
$unidades = '';
$cajas = '';
$und_caja = '';
$und_sobre = '';
$unidades_total = '';
$unidades_faltantes = '';
$unidades_vendidas = '';
$und_orig = '';
$precio_compra = '';
$precio_costo = '';
$precio_venta = '';
$precio_venta2 = '';
$precio_venta3 = '';
$precio_venta4 = '';
$precio_venta5 = '';
$vlr_total_compra = '';
$vlr_total_venta = '';
$cod_interno = '';
$tope_minimo = '';
$utilidad = '';
$total_utilidad = '';
$total_mercancia = '';
$total_venta = '';
$gasto = '';
$descuento = '';
$tipo_pago = '';
$ip = '';
$codificacion = '';
$url = '';
$cod_original = '';
$detalles = '';
$descripcion = '';
$dto1 = '';
$dto2 = '';
$iva = '';
$iva_v = '';
$fechas_dia = '';
$fechas_mes = '';
$fechas_anyo = '';
$fechas_hora = '';
$fechas_vencimiento = '';
$porcentaje_vendedor = '';
$fechas_vencimiento_seg = '';
$fechas_agotado = '';
$fechas_agotado_seg = '';
$vendedor = '';
$cuenta = '';
$promo = '';
$cod_dependencia = '';
$precio_compra_viejo = '';
$precio_costo_viejo = '';
$und_min_precio_venta_desc = '';
$fecha_ult_compra = '';
$fecha_ult_venta = '';
$nombre_marcas = '';
$nombre_tipo_producto = '';
$nombre_tipo_referencia = '';
$nombre_tipo_unidad_medida = '';
$nombre_clase_producto = '';
$cod_tercero = '';
$precio_ipc = '';
$precio_ipc_total = '';

try {
	//Lokasi file excel       
	$leer_documento_excel = ReaderFactory::create(Type::ODS); //set Type file xlsx
	$leer_documento_excel->open($ruta_archivo_excel); //open the file

	foreach ($leer_documento_excel->getSheetIterator() as $contar_hojas) {
	//Rows iterator                
		foreach ($contar_hojas->getRowIterator() as $datos_reg_excel) {
	  		++$contador;
			if ($contador > 1) {

				$cod_productos               = ($datos_reg_excel[0]);
				$cod_productos_var = ($datos_reg_excel[1]);
				$nombre_productos = ($datos_reg_excel[2]);
				$cod_marcas = ($datos_reg_excel[3]);
				$cod_proveedores = ($datos_reg_excel[4]);
				$cod_nomenclatura = ($datos_reg_excel[5]);
				$cod_tipo = ($datos_reg_excel[6]);
				$cod_lineas = ($datos_reg_excel[7]);
				$cod_ccosto = ($datos_reg_excel[8]);
				$cod_paises = ($datos_reg_excel[9]);
				$numero_factura = ($datos_reg_excel[10]);
				$unidades = ($datos_reg_excel[11]);
				$cajas = ($datos_reg_excel[12]);
				$und_caja = ($datos_reg_excel[13]);
				$und_sobre = ($datos_reg_excel[14]);
				$unidades_total = ($datos_reg_excel[15]);
				$unidades_faltantes = ($datos_reg_excel[16]);
				$unidades_vendidas = ($datos_reg_excel[17]);
				$und_orig = ($datos_reg_excel[18]);
				$precio_compra = ($datos_reg_excel[19]);
				$precio_costo = ($datos_reg_excel[20]);
				$precio_venta = ($datos_reg_excel[21]);
				$precio_venta2 = ($datos_reg_excel[22]);
				$precio_venta3 = ($datos_reg_excel[23]);
				$precio_venta4 = ($datos_reg_excel[24]);
				$precio_venta5 = ($datos_reg_excel[25]);
				$vlr_total_compra = ($datos_reg_excel[26]);
				$vlr_total_venta = ($datos_reg_excel[27]);
				$cod_interno = ($datos_reg_excel[28]);
				$tope_minimo = ($datos_reg_excel[29]);
				$utilidad = ($datos_reg_excel[30]);
				$total_utilidad = ($datos_reg_excel[31]);
				$total_mercancia = ($datos_reg_excel[32]);
				$total_venta = ($datos_reg_excel[33]);
				$gasto = ($datos_reg_excel[34]);
				$descuento = ($datos_reg_excel[35]);
				$tipo_pago = ($datos_reg_excel[36]);
				$ip = ($datos_reg_excel[37]);
				$codificacion = ($datos_reg_excel[38]);
				$url = ($datos_reg_excel[39]);
				$cod_original = ($datos_reg_excel[40]);
				$detalles = ($datos_reg_excel[41]);
				$descripcion = ($datos_reg_excel[42]);
				$dto1 = ($datos_reg_excel[43]);
				$dto2 = ($datos_reg_excel[44]);
				$iva = ($datos_reg_excel[45]);
				$iva_v = ($datos_reg_excel[46]);
				$fechas_dia = ($datos_reg_excel[47]);
				$fechas_mes = ($datos_reg_excel[48]);
				$fechas_anyo = ($datos_reg_excel[49]);
				$fechas_hora = ($datos_reg_excel[50]);
				$fechas_vencimiento = ($datos_reg_excel[51]);
				$porcentaje_vendedor = ($datos_reg_excel[52]);
				$fechas_vencimiento_seg = ($datos_reg_excel[53]);
				$fechas_agotado = ($datos_reg_excel[54]);
				$fechas_agotado_seg = ($datos_reg_excel[55]);
				$vendedor = ($datos_reg_excel[56]);
				$cuenta = ($datos_reg_excel[57]);
				$promo = ($datos_reg_excel[58]);
				$cod_dependencia = ($datos_reg_excel[59]);
				$precio_compra_viejo = ($datos_reg_excel[60]);
				$precio_costo_viejo = ($datos_reg_excel[61]);
				$und_min_precio_venta_desc = ($datos_reg_excel[62]);
				$fecha_ult_compra = ($datos_reg_excel[63]);
				$fecha_ult_venta = ($datos_reg_excel[64]);
				$nombre_marcas = ($datos_reg_excel[65]);
				$nombre_tipo_producto = ($datos_reg_excel[66]);
				$nombre_tipo_referencia = ($datos_reg_excel[67]);
				$nombre_tipo_unidad_medida = ($datos_reg_excel[68]);
				$nombre_clase_producto = ($datos_reg_excel[69]);
				$cod_tercero = ($datos_reg_excel[70]);
				$precio_ipc = ($datos_reg_excel[71]);
				$precio_ipc_total = ($datos_reg_excel[72]);

				$query = "INSERT INTO productos (cod_productos, cod_productos_var, nombre_productos, cod_marcas, cod_proveedores, cod_nomenclatura, 
				cod_tipo, cod_lineas, cod_ccosto, cod_paises, numero_factura, unidades, cajas, und_caja, und_sobre, unidades_total, unidades_faltantes, 
				unidades_vendidas, und_orig, precio_compra, precio_costo, precio_venta, precio_venta2, precio_venta3, precio_venta4, precio_venta5, 
				vlr_total_compra, vlr_total_venta, cod_interno, tope_minimo, utilidad, total_utilidad, total_mercancia, total_venta, gasto, descuento, 
				tipo_pago, ip, codificacion, url, cod_original, detalles, descripcion, dto1, dto2, iva, iva_v, fechas_dia, fechas_mes, fechas_anyo, 
				fechas_hora, fechas_vencimiento, porcentaje_vendedor, fechas_vencimiento_seg, fechas_agotado, fechas_agotado_seg, vendedor, cuenta, 
				promo, cod_dependencia, precio_compra_viejo, precio_costo_viejo, und_min_precio_venta_desc, fecha_ult_compra, fecha_ult_venta, nombre_marcas, 
				nombre_tipo_producto, nombre_tipo_referencia, nombre_tipo_unidad_medida, nombre_clase_producto, cod_tercero, precio_ipc, precio_ipc_total) 
				VALUES ('$cod_productos', '$cod_productos_var', '$nombre_productos', '$cod_marcas', '$cod_proveedores', '$cod_nomenclatura', 
				'$cod_tipo', '$cod_lineas', '$cod_ccosto', '$cod_paises', '$numero_factura', '$unidades', '$cajas', '$und_caja', '$und_sobre', '$unidades_total', '$unidades_faltantes', 
				'$unidades_vendidas', '$und_orig', '$precio_compra', '$precio_costo', '$precio_venta', '$precio_venta2', '$precio_venta3', '$precio_venta4', '$precio_venta5', 
				'$vlr_total_compra', '$vlr_total_venta', '$cod_interno', '$tope_minimo', '$utilidad', '$total_utilidad', '$total_mercancia', '$total_venta', '$gasto', '$descuento', 
				'$tipo_pago', '$ip', '$codificacion', '$url', '$cod_original', '$detalles', '$descripcion', '$dto1', '$dto2', '$iva', '$iva_v', '$fechas_dia', '$fechas_mes', '$fechas_anyo', 
				'$fechas_hora', '$fechas_vencimiento', '$porcentaje_vendedor', '$fechas_vencimiento_seg', '$fechas_agotado', '$fechas_agotado_seg', '$vendedor', '$cuenta', 
				'$promo', '$cod_dependencia', '$precio_compra_viejo', '$precio_costo_viejo', '$und_min_precio_venta_desc', '$fecha_ult_compra', '$fecha_ult_venta', '$nombre_marcas', 
				'$nombre_tipo_producto', '$nombre_tipo_referencia', '$nombre_tipo_unidad_medida', '$nombre_clase_producto', '$cod_tercero', '$precio_ipc', '$precio_ipc_total')";
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