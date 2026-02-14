<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_administrador       = ($_SESSION['cod_administrador']);

//$tamano_archivo = $_FILES['csv']['size'];
header('Content-Type: application/json');

$nombre_tipo_formato_archivo_plano       = $_POST['nombre_tipo_formato_archivo_plano'];

if ($nombre_tipo_formato_archivo_plano == 'CSV') { $delimitador = ','; } elseif ($nombre_tipo_formato_archivo_plano == 'XLS') { $delimitador = ';'; } else { $delimitador = ','; }

$nombre_actualizaciones                  = 'STICKER_BARRAS_'.time().'_'.$_FILES['csv']['name'];
$fecha                                   = date("d/m/Y");
$fecha_invert                            = date("Y/m/d");
$hora                                    = date("H:i:s");
$ip                                      = $_SERVER['REMOTE_ADDR'];
$fecha_cargue_import                     = date("Y-m-d");
$fecha_cargue                            = date("Y/m/d - H:i:s");
$fecha_llegada                           = date("d/m/Y");
$url_archivo                             = "../archivador/".$nombre_actualizaciones;
$nombre_archivo                          = $_FILES['csv']['name'];
$nombre_tipo_import                      = "IMPORT_STICKER_BARAS";
$respuesta_ajax                          = array();
$contador                                = '0';
$contador_alter                          = '0';
$confirm                                 = '1';
$fecha_cargue_import                     = date("Y-m-d");

$sql_info_impuesto_facturas = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_sticker'";
$exec_info_impuesto_facturas = mysqli_query($conectar, $sql_info_impuesto_facturas) or die(mysqli_error($conectar));
$datos_info_impuesto_facturas = mysqli_fetch_assoc($exec_info_impuesto_facturas);

$cod_info_factura_sticker               = $datos_info_impuesto_facturas['AUTO_INCREMENT'];
$cod_factura                            = $cod_info_factura_sticker;
$datos_reg_excel                        = 0;

if ($confirm == '1') {
//get the csv archivo_plano_cargar
$archivo_plano_cargar                    = $_FILES['csv']['tmp_name'];
$abrir_archivo_plano                     = fopen($archivo_plano_cargar, "r");
//loop through the csv file and insert into database
do {
if ($datos_reg_excel[0]) {
$contador++;

if ($contador > '1') {

$cod_producto_barra                      = addslashes($datos_reg_excel[0]);
$nombre_producto                         = addslashes($datos_reg_excel[1]);
$und_venta                               = addslashes($datos_reg_excel[2]);
$precio_compra_producto                  = addslashes($datos_reg_excel[3]);
$precio_venta_producto                   = addslashes($datos_reg_excel[4]);
$codif_letra_precio_compra               = addslashes($datos_reg_excel[5]);
$codif_letra_precio_venta                = addslashes($datos_reg_excel[6]);
$fecha_ult_compra                        = addslashes($datos_reg_excel[7]);
$cod_tercero                             = addslashes($datos_reg_excel[8]);

$sql = "INSERT INTO tbl15_sticker_producto (cod_producto_barra, nombre_producto, und_venta, precio_compra_producto, 
precio_venta_producto, fecha_ult_compra, cod_tercero, cod_info_factura_sticker) 
VALUES ('$cod_producto_barra', '$nombre_producto', '$und_venta', '$precio_compra_producto', 
'$precio_venta_producto', '$fecha_ult_compra', '$cod_tercero', '$cod_info_factura_sticker')";
$consulta_sql = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
}

}
} while ($datos_reg_excel = fgetcsv($abrir_archivo_plano, 1000, $delimitador, "'"));

$cod_tercero 	           = 1;
$cod_caja_virtual 	 	   = 1;
$nombre_estado_factura     = 'CERRADA';
$fecha_ymdhis 	           = date("Y-m-d H:i:s");
$cuenta 	               = $cuenta_actual;
$cod_estado_factura        = 0;
$fecha_dia 	               = date("Y-m-d");
$fecha_mes 	               = date("m-Y");
$fecha_anyo 	           = date("Y-m-d");
$anyo 	                   = date("Y");
$fecha_hora                = date("H:i:s");
$cod_tipo_pago 	           = 1;
$cod_administrador         = $cod_administrador;
$cod_dependencia 	       = 1;
$cod_tipo_forma_pago       = 1;
$nombre_tipo_factura 	   = 'POS';
$nombre_tipo_moneda        = 'COP';
$fecha_modificacion        = date("Y-m-d H:i:s");

$sql = "INSERT INTO tbl15_info_factura_sticker (cod_factura, cod_tercero, cod_caja_virtual, nombre_estado_factura, 
fecha_ymdhis, cuenta, cod_estado_factura, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, cod_tipo_pago, 
cod_administrador, cod_dependencia, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, fecha_modificacion, 
cod_info_factura_sticker) 
VALUES ('$cod_factura', '$cod_tercero', '$cod_caja_virtual', '$nombre_estado_factura', 
'$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', 
'$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$fecha_modificacion', 
'$cod_info_factura_sticker')";
$consulta_sql = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));

copy($_FILES['csv']['tmp_name'], "../archivador/".$nombre_actualizaciones);


$contador_alter                             = $contador -1;
$respuesta_ajax['estado']                   = 'OK';
$respuesta_ajax['total_reg']                = $contador_alter;
$respuesta_ajax['mensaje']                  = 'Datos cargados correctamente.';

echo '{';
echo '"estado":"OK",';
echo '"total_reg":'.($contador_alter).',';
echo '"cod_info_factura_sticker":'.$cod_info_factura_sticker.',';
echo '"mensaje":"Datos cargados correctamente."';
echo '}';
//echo json_encode($respuesta_ajax);
}
?>