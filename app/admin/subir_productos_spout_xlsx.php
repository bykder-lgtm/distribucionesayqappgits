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
$nombre_archivo               = "PRODUCTOS_TODO.xlsx";                     
$ruta_archivo_excel           = $ruta_archivador.$nombre_archivo;                     
$contador                     = 0;

$cod_producto                = '';
$cod_producto_barra          = '';
$cod_producto_barra2         = '';
$nombre_producto             = '';
$und_producto                = '';
$und_producto_bodega         = '';
$und_producto_bodega2        = '';
$precio_compra_producto      = '';
$total_pcompra               = '';
$precio_venta_producto       = '';
$total_pventa                = '';
$precio_venta_producto2      = '';
$precio_venta_producto3      = '';
$precio_venta_producto4      = '';
$precio_venta_producto5      = '';
$iva_ptj                     = '';
$iva_saludable_ptj           = '';
$comision_ptj                = '';
$precio_ipc                  = '';
$nombre_dependencia          = '';
$cod_dependencia_sub         = '';
$peso_producto               = '';
$nombre_tipo_unidad_medida   = '';
$nombre_tipo_producto        = '';
$nombre_tipo_precio_venta    = '';
$und_unidades                = '';
$und_caja                    = '';
$cajas_sobre                 = '';
$und_sobre                   = '';
$cod_categoria               = '';
$cod_categoria_sub           = '';
$cod_marca                   = '';
$cod_tercero                 = '';
$url_img_orig_producto       = '';
$url_img_min_producto        = '';
$nombre_estado               = '';

try {
	//Lokasi file excel       
	$leer_documento_excel = ReaderFactory::create(Type::XLSX); //set Type file xlsx
	$leer_documento_excel->open($ruta_archivo_excel); //open the file

	foreach ($leer_documento_excel->getSheetIterator() as $contar_hojas) {
	//Rows iterator                
		foreach ($contar_hojas->getRowIterator() as $datos_reg_excel) {
	  		++$contador;
			if ($contador > 1) {

				$cod_producto                = ($datos_reg_excel[0]);
				$cod_producto_barra          = ($datos_reg_excel[1]);
				$cod_producto_barra2         = ($datos_reg_excel[2]);
				$nombre_producto             = ($datos_reg_excel[3]);
				$und_producto                = ($datos_reg_excel[4]);
				$und_producto_bodega         = ($datos_reg_excel[5]);
				$und_producto_bodega2        = ($datos_reg_excel[6]);
				$precio_compra_producto      = ($datos_reg_excel[7]);
				$total_pcompra               = ($datos_reg_excel[8]);
				$precio_venta_producto       = ($datos_reg_excel[9]);
				$total_pventa                = ($datos_reg_excel[10]);
				$precio_venta_producto2      = ($datos_reg_excel[11]);
				$precio_venta_producto3      = ($datos_reg_excel[12]);
				$precio_venta_producto4      = ($datos_reg_excel[13]);
				$precio_venta_producto5      = ($datos_reg_excel[14]);
				$iva_ptj                     = ($datos_reg_excel[15]);
				$iva_saludable_ptj           = ($datos_reg_excel[16]);
				$comision_ptj                = ($datos_reg_excel[17]);
				$precio_ipc                  = ($datos_reg_excel[18]);
				$nombre_dependencia          = ($datos_reg_excel[19]);
				$cod_dependencia_sub         = ($datos_reg_excel[20]);
				$peso_producto               = ($datos_reg_excel[21]);
				$nombre_tipo_unidad_medida   = ($datos_reg_excel[22]);
				$nombre_tipo_producto        = ($datos_reg_excel[23]);
				$nombre_tipo_precio_venta    = ($datos_reg_excel[24]);
				$und_unidades                = ($datos_reg_excel[25]);
				$und_caja                    = ($datos_reg_excel[26]);
				$cajas_sobre                 = ($datos_reg_excel[27]);
				$und_sobre                   = ($datos_reg_excel[28]);
				$cod_categoria               = ($datos_reg_excel[29]);
				$cod_categoria_sub           = ($datos_reg_excel[30]);
				$cod_marca                   = ($datos_reg_excel[31]);
				$cod_tercero                 = ($datos_reg_excel[32]);
				$url_img_orig_producto       = ($datos_reg_excel[33]);
				$url_img_min_producto        = ($datos_reg_excel[34]);
				$nombre_estado               = ($datos_reg_excel[35]);

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