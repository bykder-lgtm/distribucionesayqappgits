<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php'); 
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                        = ($_SESSION['usuario']);
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (isset($_GET['cod_cuentas_cobrar_alerta'])) {
	$cod_cuentas_cobrar_alerta             = intval($_GET['cod_cuentas_cobrar_alerta']);
	$cod_cuentas_cobrar                    = intval($_GET['cod_cuentas_cobrar']);
	$cod_tercero                           = intval($_GET['cod_tercero']);
	$cod_factura                           = intval($_GET['cod_factura']);
	$pagina                                = addslashes($_GET['pagina']);
	$pagina_redirect                       = $pagina.'?cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_tercero='.$cod_tercero.'&cod_factura='.$cod_factura.'&pagina='.$pagina;

	$sql_cuentas_cobrar_alerta = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
	$consulta_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta) or die(mysqli_error($conectar));
	$datos_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta);

	$cod_cuentas_cobrar              = $datos_cuentas_cobrar_alerta['cod_cuentas_cobrar'];
	$numero_alerta                   = $datos_cuentas_cobrar_alerta['numero_alerta'];
	$cod_factura                     = $datos_cuentas_cobrar_alerta['cod_factura'];
	$cod_tercero                     = $datos_cuentas_cobrar_alerta['cod_tercero'];
	$cod_producto                    = $datos_cuentas_cobrar_alerta['cod_producto'];
	$cod_producto_barra              = $datos_cuentas_cobrar_alerta['cod_producto_barra'];
	$nombre_producto                 = $datos_cuentas_cobrar_alerta['nombre_producto'];

	$total_pendiente                 = $datos_cuentas_cobrar_alerta['total_pendiente'];
	$monto_deuda                     = $total_pendiente;
	$monto_deuda_sin_interes         = $total_pendiente;
	$subtotal                        = $total_pendiente;
	$subtotal_sin_interes            = $total_pendiente;
	$numero_cuota                    = $datos_cuentas_cobrar_alerta['numero_cuota'];
	$monto_cuota                     = $total_pendiente;
	$monto_cuota_sin_interes         = $total_pendiente;
	$nombre_tipo_cobro               = $datos_cuentas_cobrar_alerta['nombre_tipo_cobro'];
	$vendedor                        = $datos_cuentas_cobrar_alerta['vendedor'];
	$cuenta                          = $datos_cuentas_cobrar_alerta['cuenta'];
	$fecha_pago                      = $datos_cuentas_cobrar_alerta['fecha_pago'];
	$fecha                           = $datos_cuentas_cobrar_alerta['fecha'];
	$fecha_mes                       = $datos_cuentas_cobrar_alerta['fecha_mes'];
	$anyo                            = $datos_cuentas_cobrar_alerta['anyo'];
	$fecha_invert                    = $datos_cuentas_cobrar_alerta['fecha_invert'];
	$fecha_seg                       = $datos_cuentas_cobrar_alerta['fecha_seg'];
	$cod_administrador               = $datos_cuentas_cobrar_alerta['cod_administrador'];
	$cod_tipo_moneda                 = $datos_cuentas_cobrar_alerta['cod_tipo_moneda'];
	$cod_tercero_propietario         = $datos_cuentas_cobrar_alerta['cod_tercero_propietario'];
	$cod_renovacion_contrato         = $datos_cuentas_cobrar_alerta['cod_renovacion_contrato'];
	$fecha_pago_periodo_orig         = $datos_cuentas_cobrar_alerta['fecha_pago_periodo_orig'];
	$cod_estado                      = 2;
	$total_pagar                     = $monto_deuda;
	$cod_cuentas_cobrar_alerta_cbk   = $cod_cuentas_cobrar_alerta;

	$agregar_reg_cuentas_cobrar_abonos = "INSERT INTO tbl15_cuentas_cobrar_alerta (cod_cuentas_cobrar_alerta_cbk, cod_cuentas_cobrar, numero_alerta, cod_factura, cod_tercero, 
	cod_producto, cod_producto_barra, nombre_producto, monto_deuda, monto_deuda_sin_interes, subtotal, subtotal_sin_interes, numero_cuota, monto_cuota, 
	monto_cuota_sin_interes, nombre_tipo_cobro, vendedor, cuenta, fecha_pago, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_administrador, cod_estado, 
	cod_tipo_moneda, cod_renovacion_contrato, cod_tercero_propietario, total_pagar, total_pendiente, fecha_pago_periodo_orig) 
	VALUES ('$cod_cuentas_cobrar_alerta_cbk', '$cod_cuentas_cobrar', '$numero_alerta', '$cod_factura', '$cod_tercero', 
	'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$monto_deuda', '$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', '$numero_cuota', '$monto_cuota', 
	'$monto_cuota_sin_interes', '$nombre_tipo_cobro', '$vendedor', '$cuenta', '$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_administrador', '$cod_estado', 
	'$cod_tipo_moneda', '$cod_renovacion_contrato', '$cod_tercero_propietario', '$total_pagar', '$total_pendiente', '$fecha_pago_periodo_orig')";
	$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $agregar_reg_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>