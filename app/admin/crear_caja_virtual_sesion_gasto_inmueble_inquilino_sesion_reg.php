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
$url_img_firma_sesion               = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                   = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                 = ($_SESSION['cod_cliente_sesion']);
$cod_administrador                  = ($_SESSION['cod_administrador']);
$cuenta                             = ($cuenta_actual);

$cod_estado_factura                 = '1';
$descuento_ptj                      = '0';
$flete_ptj                          = '0';
$vlr_cancelado                      = '';
$vlr_vuelto                         = '';
$fecha_dia                          = strtotime(date("Y/m/d"));
$fecha_mes                          = date("Y-m");
$fecha_anyo                         = date("Y-m-d");
$anyo                               = date("Y");
$fecha_hora                         = date("H:i:s");
$fecha_remision                     = date("Y-m-d");
$nombre_ccosto                      = '';
$garantia_meses                     = '';
$observacion                        = '';
$cod_tipo_pago                      = '1';
$cod_empresa                        = '0';
$fecha_ymdhis                       = date("Y-m-d H:is");
$cod_tipo_cobrar                    = '1';
$cod_tercero                        = '1';
$nombre_estado_factura              = 'ABIERTA';
$cod_tipo_forma_pago                = "1";
$nombre_tipo_factura                = "POS";
$nombre_tipo_moneda                 = "COP";
$cod_tipo_inventario                = "1";
$cod_tipo_metodo_envio              = '1';


if (isset($_REQUEST["cod_caja_virtual"])) {
	$cod_factura                                       = intval($_REQUEST['cod_factura']);
	$cod_base_caja                                     = intval($_REQUEST['cod_factura']);
	$cod_caja_virtual                                  = intval($_REQUEST['cod_caja_virtual']);
	$pagina                                            = addslashes($_REQUEST['pagina']);

	$sql_total_facturas = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, tbl15_cuentas_cobrar.cod_tercero_propietario, 
	tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
	tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta,
	tbl15_cuentas_cobrar.monto_deuda_sin_interes, tbl15_cuentas_cobrar.subtotal_sin_interes, tbl15_cuentas_cobrar.numero_cuota, tbl15_cuentas_cobrar.monto_cuota, 
	tbl15_cuentas_cobrar.monto_cuota_sin_interes, tbl15_cuentas_cobrar.interes_ptj, tbl15_cuentas_cobrar.monto_cuota_interes,
	tbl15_cuentas_cobrar.nombre_tipo_cobro, 
	tbl15_cuentas_cobrar.cod_tipo_moneda, tbl15_cuentas_cobrar.clausula_alquiler, tbl15_cuentas_cobrar.cod_producto, 
	tbl15_cuentas_cobrar.cod_producto_barra, tbl15_cuentas_cobrar.nombre_producto, tbl15_cuentas_cobrar.cod_administrador, 
	tbl15_cuentas_cobrar.url_img_orig_producto, tbl15_cuentas_cobrar.cod_estado_contrato
	FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
	WHERE (tbl15_cuentas_cobrar.cod_factura = '$cod_factura') AND (tbl15_cuentas_cobrar.cod_estado_archivado = '0')";
	$consulta_total_facturas = mysqli_query($conectar, $sql_total_facturas);
	$total_facturas = mysqli_num_rows($consulta_total_facturas);
	$datos_total_facturas = mysqli_fetch_assoc($consulta_total_facturas);

	$cod_cuentas_cobrar                                = $datos_total_facturas['cod_cuentas_cobrar'];
	$cod_tercero                                       = $datos_total_facturas['cod_tercero'];
	$monto_deuda                                       = $datos_total_facturas['monto_deuda'];
	$monto_deuda_sin_interes                           = $datos_total_facturas['monto_deuda_sin_interes'];
	$subtotal                                          = $datos_total_facturas['subtotal'];
	$subtotal_sin_interes                              = $datos_total_facturas['subtotal_sin_interes'];
	$numero_cuota                                      = $datos_total_facturas['numero_cuota'];
	$monto_cuota                                       = $datos_total_facturas['monto_cuota'];
	$monto_cuota_sin_interes                           = $datos_total_facturas['monto_cuota_sin_interes'];
	$interes_ptj                                       = $datos_total_facturas['interes_ptj'];
	$monto_cuota_interes                               = $datos_total_facturas['monto_cuota_interes'];
	$nombre_tipo_cobro                                 = $datos_total_facturas['nombre_tipo_cobro'];
	$abonado                                           = $datos_total_facturas['abonado'];
	$cod_tipo_moneda                                   = $datos_total_facturas['cod_tipo_moneda'];
	$clausula_alquiler                                 = $datos_total_facturas['clausula_alquiler'];
	$cod_producto                                      = $datos_total_facturas['cod_producto'];
	$cod_producto_barra                                = $datos_total_facturas['cod_producto_barra'];
	$nombre_producto                                   = $datos_total_facturas['nombre_producto'];
	$cod_estado_contrato                               = $datos_total_facturas['cod_estado_contrato'];
	$url_img_orig_producto                             = $datos_total_facturas['url_img_orig_producto'];
	$cod_tercero_propietario                           = $datos_total_facturas['cod_tercero_propietario'];

	$datos_info = "SELECT * FROM tbl15_info_gasto_inmueble_inquilino_venta WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
	$factura_abierta = mysqli_num_rows($consulta_info);

//if ($factura_abierta == '0') {
	$sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_gasto_inmueble_inquilino_venta WHERE (nombre_estado_factura = '$nombre_estado_factura')";
	$consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
	$datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

	$cod_prioridad                                     = $datos_max_prioridad['cod_prioridad']+1;

	$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_gasto_inmueble_inquilino_venta'";
	$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
	$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

	$cod_info_gasto_inmueble_inquilino_venta             = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
	$fecha_gasto_inmueble_detalle                      = date("Y-m-d");
	$fecha                                             = date("Y-m-d");
	$fecha_invert                                      = date("Y-m-d");
	$fecha_seg                                         = time();
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$sql_data = "INSERT INTO tbl15_info_gasto_inmueble_inquilino_venta (cod_info_gasto_inmueble_inquilino_venta, cod_cuentas_cobrar, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
	fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_tipo_forma_pago, 
	nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_tipo_inventario, cod_prioridad, cod_base_caja, cod_tipo_metodo_envio,
	cod_producto, cod_producto_barra, nombre_producto, cod_tercero_propietario, fecha_gasto_inmueble_detalle, fecha, fecha_invert, fecha_seg, cod_factura) 
	VALUES ('$cod_info_gasto_inmueble_inquilino_venta', '$cod_cuentas_cobrar', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
	'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_tipo_forma_pago', 
	'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_tipo_inventario', '$cod_prioridad', '$cod_base_caja', '$cod_tipo_metodo_envio', 
	'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$cod_tercero_propietario', '$fecha_gasto_inmueble_detalle', '$fecha', '$fecha_invert', '$fecha_seg', '$cod_factura')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//}
	$_SESSION['cod_base_caja']        = $cod_base_caja;
	$_SESSION['cod_caja_virtual']     = $cod_caja_virtual;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
<?php } ?>