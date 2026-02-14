<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");

include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}

$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_administrador       = ($_SESSION['cod_administrador']);
$cod_base_caja           = ($_SESSION['cod_base_caja']);
$cod_seguridad           = ($_SESSION['cod_seguridad']);
$cod_caja_virtual        = ($_SESSION['cod_caja_virtual']);
//$tamano_archivo = $_FILES['csv']['size'];
require_once __DIR__ . '/class_php/Spout-2.7.3/Spout/Autoloader/autoload.php';
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

//$nombre_actualizaciones                      = time().'-'.$_FILES['file']['name'];
$fecha                                       = date("d/m/Y");
$fecha_invert                                = date("Y/m/d");
$hora                                        = date("H:i:s");
$ip                                          = $_SERVER['REMOTE_ADDR'];
$fecha_cargue                                = date("Y/m/d - H:i:s");
$fecha_llegada                               = date("d/m/Y");
//$url_archivo                                 = "../facturas_cargadas/".$nombre_actualizaciones;

$ruta_archivador                             = "../archivador/archivador_office/";
$nombre_archivo                              = "INVENTARIO_DATA EDITAXE__20231224_154817.xlsx";                     
$ruta_archivo_excel                          = $ruta_archivador.$nombre_archivo;                     
$contador                                    = 0;

if (isset($_POST['und_producto'])) { $cod_estado_und_producto = 1; } else { $cod_estado_und_producto = 0; }
if (isset($_POST['nombre_producto'])) { $cod_estado_nombre_producto = 1; } else { $cod_estado_nombre_producto = 0; }
if (isset($_POST['precio_compra_producto'])) { $cod_estado_precio_compra_producto = 1; } else { $cod_estado_precio_compra_producto = 0; }
if (isset($_POST['precio_venta_producto'])) { $cod_estado_precio_venta_producto = 1; } else { $cod_estado_precio_venta_producto = 0; }
if (isset($_POST['precio_venta_producto2'])) { $cod_estado_precio_venta_producto2 = 1; } else { $cod_estado_precio_venta_producto2 = 0; }
if (isset($_POST['precio_venta_producto3'])) { $cod_estado_precio_venta_producto3 = 1; } else { $cod_estado_precio_venta_producto3 = 0; }
if (isset($_POST['precio_venta_producto4'])) { $cod_estado_precio_venta_producto4 = 1; } else { $cod_estado_precio_venta_producto4 = 0; }
if (isset($_POST['precio_venta_producto5'])) { $cod_estado_precio_venta_producto5 = 1; } else { $cod_estado_precio_venta_producto5 = 0; }
if (isset($_POST['iva_ptj'])) { $cod_estado_iva_ptj = 1; } else { $cod_estado_iva_ptj = 0; }
if (isset($_POST['comision_ptj'])) { $cod_estado_comision_ptj = 1; } else { $cod_estado_comision_ptj = 0; }
if (isset($_POST['cod_dependencia'])) { $cod_estado_cod_dependencia = 1; } else { $cod_estado_cod_dependencia = 0; }
if (isset($_POST['cajas_sobre'])) { $cod_estado_cajas_sobre = 1; } else { $cod_estado_cajas_sobre = 0; }
if (isset($_POST['und_sobre'])) { $cod_estado_und_sobre = 1; } else { $cod_estado_und_sobre = 0; }

$sql_autoincremento_info_reg_actualizacion_tabla_sistema = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_reg_actualizacion_tabla_sistema'";
$exec_autoincremento_info_reg_actualizacion_tabla_sistema = mysqli_query($conectar, $sql_autoincremento_info_reg_actualizacion_tabla_sistema) or die(mysqli_error($conectar));
$datos_autoincremento_info_reg_actualizacion_tabla_sistema = mysqli_fetch_assoc($exec_autoincremento_info_reg_actualizacion_tabla_sistema);
$cod_info_reg_actualizacion_tabla_sistema = $datos_autoincremento_info_reg_actualizacion_tabla_sistema['AUTO_INCREMENT'];

$pagina                                      = addslashes($_POST['pagina']).'?cod_info_reg_actualizacion_tabla_sistema='.$cod_info_reg_actualizacion_tabla_sistema;
$longitudDeLinea                             = 1000;
$delimitador                                 = ";"; # Separador de columnas
$caracterCircundante                         = '"'; # A veces los valores son encerrados entre comillas
$cuenta                                      = $cuenta_actual;
$cod_administrador                           = $cod_administrador;
$fecha_reg                                   = date("Y-m-d");
$hora_reg                                    = date("H:i:s");
$fecha_creacion                              = date("Y-m-d H:i:s");
$total_reg_insertado                         = 0;
$total_reg_actualizado                       = 0;

$cod_producto                                = '';
$cod_producto_barra                          = '';
$cod_producto_barra2                         = '';
$nombre_producto                             = '';
$und_producto                                = '';
$und_producto_bodega                         = '';
$und_producto_bodega2                        = '';
$precio_compra_producto                      = '';
$total_pcompra                               = '';
$precio_venta_producto                       = '';
$total_pventa                                = '';
$precio_venta_producto2                      = '';
$precio_venta_producto3                      = '';
$precio_venta_producto4                      = '';
$precio_venta_producto5                      = '';
$iva_ptj                                     = '';
$iva_saludable_ptj                           = '';
$comision_ptj                                = '';
$precio_ipc                                  = '';
$cod_dependencia                             = '';
$cod_dependencia_sub                         = '';
$peso_producto                               = '';
$nombre_tipo_unidad_medida                   = '';
$nombre_tipo_producto                        = '';
$nombre_tipo_precio_venta                    = '';
$und_unidades                                = '';
$und_caja                                    = '';
$cajas_sobre                                 = '';
$und_sobre                                   = '';
$cod_categoria                               = '';
$cod_categoria_sub                           = '';
$cod_marca                                   = '';
$cod_tercero                                 = '';
$url_img_orig_producto                       = '';
$url_img_min_producto                        = '';
$nombre_estado                               = '';

try {
	//Lokasi file excel       
	$leer_documento_excel = ReaderFactory::create(Type::XLSX); //set Type file xlsx
	$leer_documento_excel->open($ruta_archivo_excel); //open the file

	foreach ($leer_documento_excel->getSheetIterator() as $contar_hojas) {
	//Rows iterator                
		foreach ($contar_hojas->getRowIterator() as $datos_reg_excel) {
	  		++$contador;
			if ($contador > 1) {

				$cod_producto                = trim($datos_reg_excel[0]);
				$cod_producto_barra          = trim($datos_reg_excel[1]);

				$sql_producto = "SELECT * FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
				$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
				$existe_producto = mysqli_num_rows($consulta_producto);
				$datos_producto = mysqli_fetch_assoc($consulta_producto);

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
				$cod_dependencia             = ($datos_reg_excel[19]);
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

				if ($cod_estado_und_producto == '1') { $und_producto_actualizar = "und_producto = '$und_producto',"; } else { $und_producto_actualizar = ""; }
				if ($cod_estado_nombre_producto == '1') { $nombre_producto_actualizar = "nombre_producto = '$nombre_producto',"; } else { $nombre_producto_actualizar = ""; }
				if ($cod_estado_precio_compra_producto == '1') { $precio_compra_producto_actualizar = "precio_compra_producto = '$precio_compra_producto',"; } else { $precio_compra_producto_actualizar = ""; }
				if ($cod_estado_precio_venta_producto == '1') { $precio_venta_producto_actualizar = "precio_venta_producto = '$precio_venta_producto',"; } else { $precio_venta_producto_actualizar = ""; }
				if ($cod_estado_precio_venta_producto2 == '1') { $precio_venta_producto2_actualizar = "precio_venta_producto2 = '$precio_venta_producto2',"; } else { $precio_venta_producto2_actualizar = ""; }
				if ($cod_estado_precio_venta_producto3 == '1') { $precio_venta_producto3_actualizar = "precio_venta_producto3 = '$precio_venta_producto3',"; } else { $precio_venta_producto3_actualizar = ""; }
				if ($cod_estado_precio_venta_producto4 == '1') { $precio_venta_producto4_actualizar = "precio_venta_producto4 = '$precio_venta_producto4',"; } else { $precio_venta_producto4_actualizar = ""; }
				if ($cod_estado_precio_venta_producto5 == '1') { $precio_venta_producto5_actualizar = "precio_venta_producto5 = '$precio_venta_producto5',"; } else { $precio_venta_producto5_actualizar = ""; }
				if ($cod_estado_iva_ptj == '1') { $iva_ptj_actualizar = "iva_ptj = '$iva_ptj',"; } else { $iva_ptj_actualizar = ""; }
				if ($cod_estado_comision_ptj == '1') { $comision_ptj_actualizar = "comision_ptj = '$comision_ptj',"; } else { $comision_ptj_actualizar = ""; }
				if ($cod_estado_cod_dependencia == '1') { $cod_dependencia_actualizar = "cod_dependencia = '$cod_dependencia',"; } else { $cod_dependencia_actualizar = ""; }
				if ($cod_estado_cajas_sobre == '1') { $cajas_sobre_actualizar = "cajas_sobre = '$cajas_sobre',"; } else { $cajas_sobre_actualizar = ""; }
				if ($cod_estado_und_sobre == '1') { $und_sobre_actualizar = "und_sobre = '$und_sobre',"; } else { $und_sobre_actualizar = ""; }

				if ($existe_producto == '1') {
					$und_productos                           = $und_producto;
					$nombre_tipo_actualizacion_tabla_sistema = "ACTUALIZADO";
					$total_reg_actualizado++;

					$sql_data = sprintf("UPDATE tbl15_producto SET $und_producto_actualizar $nombre_producto_actualizar $precio_compra_producto_actualizar $precio_venta_producto_actualizar 
					$precio_venta_producto2_actualizar $precio_venta_producto3_actualizar $precio_venta_producto4_actualizar $precio_venta_producto5_actualizar $iva_ptj_actualizar 
					$comision_ptj_actualizar $cod_dependencia_actualizar $cajas_sobre_actualizar $und_sobre_actualizar cod_info_reg_actualizacion_tabla_sistema = '$cod_info_reg_actualizacion_tabla_sistema' 
					WHERE cod_producto_barra = '$cod_producto_barra'");
					$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

					$sql_data = "INSERT INTO tbl15_reg_actualizacion_tabla_sistema (cod_info_reg_actualizacion_tabla_sistema, nombre_tipo_actualizacion_tabla_sistema, cod_producto_barra, 
					nombre_producto, und_producto, und_producto_bodega, und_producto_bodega2, precio_compra_producto, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, 
					precio_venta_producto4, precio_venta_producto5, nombre_tipo_unidad_medida, peso_producto, iva_ptj, 
					nombre_tipo_producto, cod_marca, cod_dependencia, cod_dependencia_sub, nombre_tipo_precio_venta, url_img_orig_producto, url_img_min_producto, 
					comision_ptj, und_unidades, und_caja, nombre_estado, cod_categoria, cod_categoria_sub, cajas_sobre, und_sobre, fecha_creacion) 
					VALUES ('$cod_info_reg_actualizacion_tabla_sistema', '$nombre_tipo_actualizacion_tabla_sistema', '$cod_producto_barra', 
					'$nombre_producto', '$und_producto', '$und_producto_bodega', '$und_producto_bodega2', '$precio_compra_producto', '$precio_venta_producto',  '$precio_venta_producto2', '$precio_venta_producto3', 
					'$precio_venta_producto4', '$precio_venta_producto5', '$nombre_tipo_unidad_medida', '$peso_producto', '$iva_ptj', 
					'$nombre_tipo_producto', '$cod_marca', '$cod_dependencia', '$cod_dependencia_sub', '$nombre_tipo_precio_venta', '$url_img_orig_producto', '$url_img_min_producto', 
					'$comision_ptj', '$und_unidades', '$und_caja', '$nombre_estado', '$cod_categoria', '$cod_categoria_sub', '$cajas_sobre', '$und_sobre', '$fecha_creacion')";
					$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
				} else {
					$total_reg_insertado++;
					$nombre_tipo_actualizacion_tabla_sistema = "REGISTRADO";

					$sql_data = "INSERT INTO tbl15_producto (cod_producto_barra, nombre_producto, und_producto, und_producto_bodega, und_producto_bodega2, 
					precio_compra_producto, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, 
					precio_venta_producto4, precio_venta_producto5, nombre_tipo_unidad_medida, peso_producto, iva_ptj, 
					nombre_tipo_producto, cod_marca, cod_dependencia, cod_dependencia_sub, nombre_tipo_precio_venta, url_img_orig_producto, url_img_min_producto, 
					comision_ptj, und_unidades, und_caja, nombre_estado, cod_categoria, cod_categoria_sub, cajas_sobre, und_sobre, fecha_creacion, cod_info_reg_actualizacion_tabla_sistema) 
					VALUES ('$cod_producto_barra', '$nombre_producto', '$und_producto', '$und_producto_bodega', '$und_producto_bodega2', 
					'$precio_compra_producto', '$precio_venta_producto',  '$precio_venta_producto2', '$precio_venta_producto3', 
					'$precio_venta_producto4', '$precio_venta_producto5', '$nombre_tipo_unidad_medida', '$peso_producto', '$iva_ptj', 
					'$nombre_tipo_producto', '$cod_marca', '$cod_dependencia', '$cod_dependencia_sub', '$nombre_tipo_precio_venta', '$url_img_orig_producto', '$url_img_min_producto', 
					'$comision_ptj', '$und_unidades', '$und_caja', '$nombre_estado', '$cod_categoria', '$cod_categoria_sub', '$cajas_sobre', '$und_sobre', '$fecha_creacion', '$cod_info_reg_actualizacion_tabla_sistema')";
					$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

					$sql_data = "INSERT INTO tbl15_reg_actualizacion_tabla_sistema (cod_info_reg_actualizacion_tabla_sistema, nombre_tipo_actualizacion_tabla_sistema, cod_producto_barra, 
					nombre_producto, und_producto, und_producto_bodega, und_producto_bodega2, precio_compra_producto, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, 
					precio_venta_producto4, precio_venta_producto5, nombre_tipo_unidad_medida, peso_producto, iva_ptj, 
					nombre_tipo_producto, cod_marca, cod_dependencia, cod_dependencia_sub, nombre_tipo_precio_venta, url_img_orig_producto, url_img_min_producto, 
					comision_ptj, und_unidades, und_caja, nombre_estado, cod_categoria, cod_categoria_sub, cajas_sobre, und_sobre, fecha_creacion) 
					VALUES ('$cod_info_reg_actualizacion_tabla_sistema', '$nombre_tipo_actualizacion_tabla_sistema', '$cod_producto_barra', 
					'$nombre_producto', '$und_producto', '$und_producto_bodega', '$und_producto_bodega2', '$precio_compra_producto', '$precio_venta_producto',  '$precio_venta_producto2', '$precio_venta_producto3', 
					'$precio_venta_producto4', '$precio_venta_producto5', '$nombre_tipo_unidad_medida', '$peso_producto', '$iva_ptj', 
					'$nombre_tipo_producto', '$cod_marca', '$cod_dependencia', '$cod_dependencia_sub', '$nombre_tipo_precio_venta', '$url_img_orig_producto', '$url_img_min_producto', 
					'$comision_ptj', '$und_unidades', '$und_caja', '$nombre_estado', '$cod_categoria', '$cod_categoria_sub', '$cajas_sobre', '$und_sobre', '$fecha_creacion')";
					$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
				}
			}
		}
	$nombre_tipo_actualizacion_tabla_sistema     = "ACTUALIZACION_POR_ARCHIVO_PLANO";

	$sql_data = "INSERT INTO tbl15_info_reg_actualizacion_tabla_sistema (cod_info_reg_actualizacion_tabla_sistema, nombre_tipo_actualizacion_tabla_sistema, total_reg_insertado, total_reg_actualizado, 
	cod_estado_und_producto, cod_estado_nombre_producto, cod_estado_precio_compra_producto, 
	cod_estado_precio_venta_producto, cod_estado_precio_venta_producto2, cod_estado_precio_venta_producto3, cod_estado_precio_venta_producto4, 
	cod_estado_precio_venta_producto5, cod_estado_iva_ptj, cod_estado_comision_ptj, cod_estado_cod_dependencia, cod_estado_cajas_sobre, 
	cod_estado_und_sobre, cod_administrador, cuenta, fecha_reg, hora_reg) 
	VALUES ('$cod_info_reg_actualizacion_tabla_sistema', '$nombre_tipo_actualizacion_tabla_sistema', '$total_reg_insertado', '$total_reg_actualizado', 
	'$cod_estado_und_producto', '$cod_estado_nombre_producto', '$cod_estado_precio_compra_producto', 
	'$cod_estado_precio_venta_producto', '$cod_estado_precio_venta_producto2', '$cod_estado_precio_venta_producto3', '$cod_estado_precio_venta_producto4', 
	'$cod_estado_precio_venta_producto5', '$cod_estado_iva_ptj', '$cod_estado_comision_ptj', '$cod_estado_cod_dependencia', '$cod_estado_cajas_sobre', 
	'$cod_estado_und_sobre', '$cod_administrador', '$cuenta', '$fecha_reg', '$hora_reg')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
    $leer_documento_excel->close();
} catch (Exception $e) { echo $e->getMessage(); exit; }
?>