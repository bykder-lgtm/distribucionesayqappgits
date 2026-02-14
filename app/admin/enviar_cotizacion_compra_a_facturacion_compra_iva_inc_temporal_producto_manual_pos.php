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

if (isset($_GET["cod_info_cotizacion_factura_compra"])) {

$cod_info_cotizacion_factura_compra = intval($_GET['cod_info_cotizacion_factura_compra']);
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

$datos_data_info_factura = "SELECT * FROM tbl15_info_cotizacion_factura_compra WHERE (cod_info_cotizacion_factura_compra = '$cod_info_cotizacion_factura_compra')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$nombre_tipo_cargue_factura               = $data_info_factura['nombre_tipo_cargue_factura'];
$nombre_tipo_compra                       = $data_info_factura['nombre_tipo_compra'];
//$cod_tipo_producto_consumo                = $data_info_factura['cod_tipo_producto_consumo'];
$total                                    = $data_info_factura['total'];
$subtotal_total_precio_compra             = $data_info_factura['subtotal_total_precio_compra'];
$subtotal_total_precio_costo              = $data_info_factura['subtotal_total_precio_costo'];
$total_precio_costo                       = $data_info_factura['total_precio_costo'];
$total_precio_compra                      = $data_info_factura['total_precio_compra'];
$total_precio_venta                       = $data_info_factura['total_precio_venta'];
$total_factura_compra_retefuente          = $data_info_factura['total_factura_compra_retefuente'];
$total_factura_compra                     = $data_info_factura['total_factura_compra'];
$nombre_tipo_cargue_factura              = "FACTURA_COMPRA_NORMAL";

$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_compra'";
$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

$cod_info_factura_compra                  = $datos_autoincremento_info_factura['AUTO_INCREMENT'];

$sql_info_cotizacion_factura_compra = "SELECT cod_tercero, cod_dependencia, cod_tipo_forma_pago, nombre_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, cod_tipo_pago
FROM tbl15_info_cotizacion_factura_compra WHERE (cod_info_cotizacion_factura_compra = '$cod_info_cotizacion_factura_compra')";
$consulta_info_cotizacion_factura_compra = mysqli_query($conectar, $sql_info_cotizacion_factura_compra) or die(mysqli_error($conectar));
$datos_info_cotizacion_factura_compra = mysqli_fetch_assoc($consulta_info_cotizacion_factura_compra);

$cod_tercero                              = $datos_info_cotizacion_factura_compra['cod_tercero'];
$nombre_estado_factura                    = 'ABIERTA';
$cod_estado_factura                       = '1';
$cod_dependencia                          = $datos_info_cotizacion_factura_compra['cod_dependencia'];
$cod_tipo_forma_pago                      = $datos_info_cotizacion_factura_compra['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago                   = $datos_info_cotizacion_factura_compra['nombre_tipo_forma_pago'];
$nombre_tipo_factura                      = $datos_info_cotizacion_factura_compra['nombre_tipo_factura'];
$nombre_tipo_moneda                       = $datos_info_cotizacion_factura_compra['nombre_tipo_moneda'];
$cod_tipo_pago                            = $datos_info_cotizacion_factura_compra['cod_tipo_pago'];

$sql_data = "INSERT INTO tbl15_info_factura_compra (cod_info_factura_compra, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, 
fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_dependencia, cod_tipo_forma_pago, nombre_tipo_factura, 
nombre_tipo_moneda, cod_tercero, nombre_tipo_cargue_factura) 
VALUES ('$cod_info_factura_compra', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', 
'$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_dependencia', '$cod_tipo_forma_pago', '$nombre_tipo_factura', 
'$nombre_tipo_moneda', '$cod_tercero', '$nombre_tipo_cargue_factura')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$sql_cotizar_venta = "SELECT * FROM tbl15_cotizacion_compra_producto WHERE (cod_info_cotizacion_factura_compra = '$cod_info_cotizacion_factura_compra')";
$consulta_cotizar_venta = mysqli_query($conectar, $sql_cotizar_venta) or die(mysqli_error($conectar));
while ($datos_cotizar_venta = mysqli_fetch_assoc($consulta_cotizar_venta)) {

$cod_producto                             = $datos_cotizar_venta['cod_producto'];
$cod_producto_barra                       = $datos_cotizar_venta['cod_producto_barra'];
$nombre_producto                          = $datos_cotizar_venta['nombre_producto'];
$und_compra                               = $datos_cotizar_venta['und_compra'];
$precio_costo_producto                    = $datos_cotizar_venta['precio_costo_producto'];
$precio_compra_producto                   = $datos_cotizar_venta['precio_compra_producto'];
$total_costo_producto                     = $datos_cotizar_venta['total_costo_producto'];
$precio_venta_producto                    = $datos_cotizar_venta['precio_venta_producto'];
$total_venta_producto                     = $datos_cotizar_venta['total_venta_producto'];
$nombre_tipo_producto                     = $datos_cotizar_venta['nombre_tipo_producto'];
$nombre_tipo_unidad_medida                = $datos_cotizar_venta['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion                 = $datos_cotizar_venta['nombre_tipo_presentacion'];
$und_producto                             = $datos_cotizar_venta['und_producto'];
$iva_ptj                                  = $datos_cotizar_venta['iva_ptj'];
$nombre_tipo_precio                       = $datos_cotizar_venta['nombre_tipo_precio'];
$nombre_tipo_precio_venta                 = $datos_cotizar_venta['nombre_tipo_precio_venta'];		 	

$sql_data = "INSERT INTO tbl15_compra_producto_temporal (cod_info_factura_compra, cod_producto, cod_producto_barra, cod_tercero, cod_caja_virtual, nombre_producto, und_compra, 
precio_costo_producto, precio_compra_producto, total_costo_producto, precio_venta_producto, total_venta_producto, nombre_tipo_producto, 
nombre_tipo_unidad_medida, nombre_tipo_presentacion, 
und_producto, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, 
nombre_tipo_precio, nombre_tipo_precio_venta, cuenta, cod_administrador, cod_tipo_cobrar, nombre_tipo_cargue_factura) 
VALUES ('$cod_info_factura_compra', '$cod_producto', '$cod_producto_barra', '$cod_tercero', '$cod_caja_virtual', '$nombre_producto', '$und_compra', 
'$precio_costo_producto', '$precio_compra_producto', '$total_costo_producto', '$precio_venta_producto', '$total_venta_producto', '$nombre_tipo_producto', 
'$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', 
'$und_producto', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', 
'$nombre_tipo_precio', '$nombre_tipo_precio_venta', '$cuenta', '$cod_administrador', '$cod_tipo_cobrar', '$nombre_tipo_cargue_factura')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}

$sql_info_cotizacion_factura_compra_temp = "SELECT SUM(precio_compra_producto * und_compra) AS total_precio_compra, SUM(precio_costo_producto * und_compra) AS total_precio_costo, 
SUM(precio_venta_producto * und_compra) AS total_precio_venta FROM tbl15_compra_producto_temporal WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_info_cotizacion_factura_compra_temp = mysqli_query($conectar, $sql_info_cotizacion_factura_compra_temp) or die(mysqli_error($conectar));
$datos_info_cotizacion_factura_compra_temp = mysqli_fetch_assoc($consulta_info_cotizacion_factura_compra_temp);

$total_precio_compra                      = $datos_info_cotizacion_factura_compra_temp['total_precio_compra'];
$total_precio_costo                       = $datos_info_cotizacion_factura_compra_temp['total_precio_costo'];
$total_precio_venta                       = $datos_info_cotizacion_factura_compra_temp['total_precio_venta'];
$subtotal                                 = $total_precio_compra;
$total 	                                  = $total_precio_compra;
$subtotal_total_precio_compra 	          = $total_precio_compra;
$subtotal_total_precio_costo 	          = $total_precio_costo;
$valor_neto 	                          = $total_precio_compra;
$total_compra_imp                         = $total_precio_compra;
$total_factura_compra_retefuente 	      = $total_precio_compra;
$total_factura_compra                     = $total_precio_compra;

$actualizar_sql1 = sprintf("UPDATE tbl15_info_factura_compra SET total_precio_compra = '$total_precio_compra', total_precio_costo = '$total_precio_costo', 
total_precio_venta = '$total_precio_venta', subtotal = '$subtotal', total = '$total', subtotal_total_precio_compra = '$subtotal_total_precio_compra', 
subtotal_total_precio_costo = '$subtotal_total_precio_costo', valor_neto = '$valor_neto', total_compra_imp = '$total_compra_imp', 
total_factura_compra_retefuente = '$total_factura_compra_retefuente', total_factura_compra = '$total_factura_compra' 
WHERE cod_info_factura_compra = '$cod_info_factura_compra'");
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/facturacion_compra_iva_inc_temporal_producto_manual_pos.php">
<?php } ?>