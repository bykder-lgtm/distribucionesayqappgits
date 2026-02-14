<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                        = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                      = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                    = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$cod_administrador                  = ($_SESSION['cod_administrador']);

if (isset($_GET["cod_info_cita_factura_venta"])) {

$cod_info_cita_factura_venta  = intval($_GET['cod_info_cita_factura_venta']);
$tab                                = addslashes($_GET['tab']);
$campo                              = addslashes($_GET['campo']);
$tipo                               = addslashes($_GET['tipo']);
$pagina                             = addslashes($_GET['pagina']);

$cuenta 	                        = $cuenta_actual;
$cod_caja_virtual                   = $_SESSION['cod_caja_virtual'];
$fecha_ymd_venta_producto           = date("Y-m-d");
$fecha_mes_venta_producto           = date("Y-m");
$fecha_anyo_venta_producto          = date("Y");
$fecha_seg_venta_producto           = time();
$fecha_dia                          = date("Y-m-d");
$fecha_mes                          = date("Y-m");
$fecha_anyo                         = date("Y-m-d");
$anyo                               = date("Y");
$fecha_hora                         = date("H:i:s");
$fecha_remision                     = date("Y-m-d");
$fecha_ymdhis                       = date("Y-m-d H:i:s");
$cod_tipo_cobrar 	                = "1";

$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

$cod_info_factura_venta                    = $datos_autoincremento_info_factura['AUTO_INCREMENT'];

$sql_info_cita_factura_venta = "SELECT cod_tercero, cod_dependencia, cod_tipo_forma_pago, nombre_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, cod_tipo_pago
FROM tbl15_info_cita_factura_venta WHERE cod_info_cita_factura_venta = '$cod_info_cita_factura_venta'";
$consulta_info_cita_factura_venta = mysqli_query($conectar, $sql_info_cita_factura_venta) or die(mysqli_error($conectar));
$datos_info_cita_factura_venta = mysqli_fetch_assoc($consulta_info_cita_factura_venta);

$cod_tercero                        = $datos_info_cita_factura_venta['cod_tercero'];
$nombre_estado_factura              = 'ABIERTA';
$cod_estado_factura                 = '1';
$cod_dependencia                    = $datos_info_cita_factura_venta['cod_dependencia'];
$cod_tipo_forma_pago                = $datos_info_cita_factura_venta['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago             = $datos_info_cita_factura_venta['nombre_tipo_forma_pago'];
$nombre_tipo_factura                = $datos_info_cita_factura_venta['nombre_tipo_factura'];
$nombre_tipo_moneda                 = $datos_info_cita_factura_venta['nombre_tipo_moneda'];
$cod_tipo_pago                      = $datos_info_cita_factura_venta['cod_tipo_pago'];


$sql_data = "INSERT INTO tbl15_info_factura_venta (cod_info_factura_venta, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, 
fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, cod_tipo_forma_pago, nombre_tipo_factura, 
nombre_tipo_moneda, cod_tercero) 
VALUES ('$cod_info_factura_venta', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', 
'$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', '$nombre_tipo_factura', 
'$nombre_tipo_moneda', '$cod_tercero')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$sql_cotizar_venta = "SELECT * FROM tbl15_cita_venta_producto WHERE cod_info_cita_factura_venta = '$cod_info_cita_factura_venta'";
$consulta_cotizar_venta = mysqli_query($conectar, $sql_cotizar_venta) or die(mysqli_error($conectar));
while ($datos_cotizar_venta = mysqli_fetch_assoc($consulta_cotizar_venta)) {

$cod_producto                       = $datos_cotizar_venta['cod_producto'];
$cod_producto_barra                 = $datos_cotizar_venta['cod_producto_barra'];
$nombre_producto                    = $datos_cotizar_venta['nombre_producto'];
$und_venta                          = $datos_cotizar_venta['und_venta'];
$precio_costo_producto              = $datos_cotizar_venta['precio_costo_producto'];
$total_costo_producto               = $datos_cotizar_venta['total_costo_producto'];
$precio_venta_producto              = $datos_cotizar_venta['precio_venta_producto'];
$total_venta_producto               = $datos_cotizar_venta['total_venta_producto'];
$nombre_tipo_producto               = $datos_cotizar_venta['nombre_tipo_producto'];
$nombre_tipo_unidad_medida          = $datos_cotizar_venta['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion           = $datos_cotizar_venta['nombre_tipo_presentacion'];
$und_producto                       = $datos_cotizar_venta['und_producto'];
$iva_ptj                            = $datos_cotizar_venta['iva_ptj'];
$nombre_tipo_precio                 = $datos_cotizar_venta['nombre_tipo_precio'];
$nombre_tipo_precio_venta           = $datos_cotizar_venta['nombre_tipo_precio_venta'];		 	

$sql_data = "INSERT INTO tbl15_venta_producto_temporal (cod_info_factura_venta, cod_producto, cod_producto_barra, cod_tercero, cod_caja_virtual, nombre_producto, und_venta, precio_costo_producto, total_costo_producto,
precio_venta_producto, total_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, und_producto, 
fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, 
nombre_tipo_precio, nombre_tipo_precio_venta, cuenta, cod_administrador, cod_tipo_cobrar) 
VALUES ('$cod_info_factura_venta', '$cod_producto', '$cod_producto_barra', '$cod_tercero', '$cod_caja_virtual', '$nombre_producto', '$und_venta', '$precio_costo_producto', '$total_costo_producto', 
'$precio_venta_producto', '$total_venta_producto', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', '$und_producto', 
'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', 
'$nombre_tipo_precio', '$nombre_tipo_precio_venta', '$cuenta', '$cod_administrador', '$cod_tipo_cobrar')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/facturacion_venta_temporal_producto_manual_pos.php">
<?php } ?>