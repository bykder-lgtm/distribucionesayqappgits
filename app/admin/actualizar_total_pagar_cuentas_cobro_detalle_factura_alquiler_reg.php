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

$sql_fecha_pago_alert = "SELECT * FROM tbl15_cuentas_cobrar_alerta WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
$consulta_fecha_pago_alert = mysqli_query($conectar, $sql_fecha_pago_alert) or die(mysqli_error($conectar));
$datos_fecha_pago_alert = mysqli_fetch_assoc($consulta_fecha_pago_alert);

$monto_deuda_alerta                   = $datos_fecha_pago_alert['monto_deuda'];
$deduccion_retefuente                 = $datos_fecha_pago_alert['deduccion_retefuente'];
$deduccion_reparacion                 = $datos_fecha_pago_alert['deduccion_reparacion'];
$deduccion_otro_impuesto_dian         = $datos_fecha_pago_alert['deduccion_otro_impuesto_dian'];
$ingreso_administracion_incluida      = $datos_fecha_pago_alert['ingreso_administracion_incluida'];
$ingreso_gasto_juridica               = $datos_fecha_pago_alert['ingreso_gasto_juridica'];
$monto_cuota_interes                  = $datos_fecha_pago_alert['monto_cuota_interes'];
$deduccion_otro_concepto              = $datos_fecha_pago_alert['deduccion_otro_concepto'];
$ingreso_otro_concepto                = $datos_fecha_pago_alert['ingreso_otro_concepto'];
$deduccion_servicio_energia           = $datos_fecha_pago_alert['deduccion_servicio_energia'];
$deduccion_servicio_agua              = $datos_fecha_pago_alert['deduccion_servicio_agua'];
$deduccion_servicio_gas               = $datos_fecha_pago_alert['deduccion_servicio_gas'];
$deduccion_deudas_anteriores          = $datos_fecha_pago_alert['deduccion_deudas_anteriores'];

$total_deduccion                      = $deduccion_retefuente + $deduccion_reparacion + $deduccion_otro_impuesto_dian + $deduccion_servicio_energia + $deduccion_servicio_agua + $deduccion_servicio_gas + $deduccion_deudas_anteriores + $deduccion_otro_concepto;
$total_ingreso                        = $monto_deuda_alerta	 + $monto_cuota_interes + $ingreso_gasto_juridica + $ingreso_administracion_incluida + $ingreso_deudas_anteriores + $ingreso_otro_concepto;
$total_pagar                          = $total_ingreso - $total_deduccion;

$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET total_deduccion = '$total_deduccion', total_ingreso = '$total_ingreso', total_pagar = '$total_pagar'
WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>