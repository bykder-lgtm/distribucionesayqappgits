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

//$nombre_actualizaciones                  = time().'-'.$_FILES['file']['name'];
$fecha                                   = date("d/m/Y");
$fecha_invert                            = date("Y/m/d");
$hora                                    = date("H:i:s");
$ip                                      = $_SERVER['REMOTE_ADDR'];
$fecha_cargue                            = date("Y/m/d - H:i:s");
$fecha_llegada                           = date("d/m/Y");
//$url_archivo                             = "../facturas_cargadas/".$nombre_actualizaciones;

$ruta_archivador                         = "../facturas_cargadas/";
$nombre_archivo                          = "INFO_IMPUESTO_FACTURAS_TODO.csv";                     
$ruta_archivo_excel                      = $ruta_archivador.$nombre_archivo;                     
$contador                                = 0;

$cod_info_impuesto_facturas              = '';
$descuento                               = '';
$iva                                     = '';
$flete                                   = '';
$cod_factura                             = '';
$cod_clientes                            = '';
$vlr_cancelado                           = '';
$vlr_vuelto                              = '';
$vendedor                                = '';
$estado                                  = '';
$fecha_dia                               = '';
$fecha_mes                               = '';
$fecha_anyo                              = '';
$anyo                                    = '';
$fecha_hora                              = '';
$tipo_pago                               = '';
$fecha_remision                          = '';
$nombre_ccosto                           = '';
$garantia_meses                          = '';
$observacion                             = '';
$bolsa                                   = '';
$cod_base_caja                           = '';
$tiempo_ejecucion                        = '';
$envio_dian                              = '';
$envio_dian_fecha_ymdhis                 = '';
$envio_dian_usuario                      = '';
$cod_factura_dian                        = '';
$cod_tipo_forma_pago                     = '';
$nombre_tipo_forma_pago                  = '';
$descripcion_tipo_forma_pago             = '';
$servicio                                = '';
$nombre_tipo_factura                     = '';
$nombre_tipo_moneda                      = '';
$cod_factura_electronica                 = '';
$ptj_ipc                                 = '';
$precio_ipc                              = '';
$precio_ipc_total                        = '';
$cod_dependencia                         = '';

try {
	//Lokasi file excel       
	$leer_documento_excel = ReaderFactory::create(Type::CSV); //set Type file xlsx
	$leer_documento_excel->open($ruta_archivo_excel); //open the file

	foreach ($leer_documento_excel->getSheetIterator() as $contar_hojas) {
	//Rows iterator                
		foreach ($contar_hojas->getRowIterator() as $datos_reg_excel) {
			++$contador;
			if ($contador > 1) {

			$cod_info_impuesto_facturas              = ($datos_reg_excel[0]);
			$descuento                               = ($datos_reg_excel[1]);
			$iva                                     = ($datos_reg_excel[2]);
			$flete                                   = ($datos_reg_excel[3]);
			$cod_factura                             = ($datos_reg_excel[4]);
			$cod_clientes                            = ($datos_reg_excel[5]);
			$vlr_cancelado                           = ($datos_reg_excel[6]);
			$vlr_vuelto                              = ($datos_reg_excel[7]);
			$vendedor                                = ($datos_reg_excel[8]);
			$estado                                  = ($datos_reg_excel[9]);
			$fecha_dia                               = ($datos_reg_excel[10]);
			$fecha_mes                               = ($datos_reg_excel[11]);
			$fecha_anyo                              = ($datos_reg_excel[12]);
			$anyo                                    = ($datos_reg_excel[13]);
			$fecha_hora                              = ($datos_reg_excel[14]);
			$tipo_pago                               = ($datos_reg_excel[15]);
			$fecha_remision                          = ($datos_reg_excel[16]);
			$nombre_ccosto                           = ($datos_reg_excel[17]);
			$garantia_meses                          = ($datos_reg_excel[18]);
			$observacion                             = ($datos_reg_excel[19]);
			$bolsa                                   = ($datos_reg_excel[20]);
			$cod_base_caja                           = ($datos_reg_excel[21]);
			$tiempo_ejecucion                        = ($datos_reg_excel[22]);
			$envio_dian                              = ($datos_reg_excel[23]);
			$envio_dian_fecha_ymdhis                 = ($datos_reg_excel[24]);
			$envio_dian_usuario                      = ($datos_reg_excel[25]);
			$cod_factura_dian                        = ($datos_reg_excel[26]);
			$cod_tipo_forma_pago                     = ($datos_reg_excel[27]);
			$nombre_tipo_forma_pago                  = ($datos_reg_excel[28]);
			$descripcion_tipo_forma_pago             = ($datos_reg_excel[29]);
			$servicio                                = ($datos_reg_excel[30]);
			$nombre_tipo_factura                     = ($datos_reg_excel[31]);
			$nombre_tipo_moneda                      = ($datos_reg_excel[32]);
			$cod_factura_electronica                 = ($datos_reg_excel[33]);
			$ptj_ipc                                 = ($datos_reg_excel[34]);
			$precio_ipc                              = ($datos_reg_excel[35]);
			$precio_ipc_total                        = ($datos_reg_excel[36]);
			$cod_dependencia                         = ($datos_reg_excel[37]);

			$query = "INSERT INTO info_impuesto_facturas (cod_info_impuesto_facturas, descuento, iva, flete, cod_factura, cod_clientes, vlr_cancelado, vlr_vuelto, vendedor, 
			estado, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, tipo_pago, fecha_remision, nombre_ccosto, garantia_meses, observacion, 
			bolsa, cod_base_caja, tiempo_ejecucion, envio_dian, envio_dian_fecha_ymdhis, envio_dian_usuario, cod_factura_dian, cod_tipo_forma_pago, 
			nombre_tipo_forma_pago, descripcion_tipo_forma_pago, servicio, nombre_tipo_factura, nombre_tipo_moneda, cod_factura_electronica, 
			ptj_ipc, precio_ipc, precio_ipc_total, cod_dependencia) 
			VALUES ('$cod_info_impuesto_facturas', '$descuento', '$iva', '$flete', '$cod_factura', '$cod_clientes', '$vlr_cancelado', '$vlr_vuelto', '$vendedor', 
			'$estado', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$tipo_pago', '$fecha_remision', '$nombre_ccosto', '$garantia_meses', '$observacion', 
			'$bolsa', '$cod_base_caja', '$tiempo_ejecucion', '$envio_dian', '$envio_dian_fecha_ymdhis', '$envio_dian_usuario', '$cod_factura_dian', '$cod_tipo_forma_pago', 
			'$nombre_tipo_forma_pago', '$descripcion_tipo_forma_pago', '$servicio', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_factura_electronica', 
			'$ptj_ipc', '$precio_ipc', '$precio_ipc_total', '$cod_dependencia')";
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