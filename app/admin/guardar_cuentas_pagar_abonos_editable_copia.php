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
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des             = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des           = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des         = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion    = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion     = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo        = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion      = ($_SESSION['cod_cliente_sesion']);
$cod_administrador       = ($_SESSION['cod_administrador']);
$cod_base_caja           = ($_SESSION['cod_base_caja']);

if (isset($_GET['valor'])) {

	$valor_intro                  = addslashes($_GET['valor']);
	$campo                        = addslashes($_GET['campo']);
	$cod_cuentas_pagar_abonos    = intval($_GET['id']);
	//----------------------------------------------------------------------------------------------------//
	//----------------------------------------------------------------------------------------------------//
	$sql = "SELECT cod_factura FROM tbl15_cuentas_pagar_abonos WHERE cod_cuentas_pagar_abonos = '$cod_cuentas_pagar_abonos'";
	$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
	$datos = mysqli_fetch_assoc($consulta);

	$cod_factura                 = $datos['cod_factura'];
	//----------------------------------------------------------------------------------------------------//
	//----------------------------------------------------------------------------------------------------//
	$sql_edit_cuenta_cob = "UPDATE tbl15_cuentas_pagar_abonos SET $campo = '$valor_intro' WHERE cod_cuentas_pagar_abonos = '$cod_cuentas_pagar_abonos'";
	$consulta_edit_cuenta_cob = mysqli_query($conectar, $sql_edit_cuenta_cob) or die(mysqli_error($conectar));
	//----------------------------------------------------------------------------------------------------//
	//----------------------------------------------------------------------------------------------------//
	$sql_cuenta_cobrar_factura = "SELECT monto_deuda FROM tbl15_cuentas_pagar WHERE cod_factura = '$cod_factura'";
	$consulta_cuenta_cobrar_factura = mysqli_query($conectar, $sql_cuenta_cobrar_factura) or die(mysqli_error($conectar));
	$dato_cuenta_cobrar_factura = mysqli_fetch_assoc($consulta_cuenta_cobrar_factura);

	$monto_deuda                 = $dato_cuenta_cobrar_factura['monto_deuda'];
	//----------------------------------------------------------------------------------------------------//
	//----------------------------------------------------------------------------------------------------//
	$sql_total_abono_factura = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_pagar_abonos WHERE cod_factura = '$cod_factura'";
	$consulta_total_abono_factura = mysqli_query($conectar, $sql_total_abono_factura) or die(mysqli_error($conectar));
	$total_abono_factura = mysqli_fetch_assoc($consulta_total_abono_factura);

	$abonado_total               = $total_abono_factura['abonado'];
	$subtotal                    = $monto_deuda - $abonado_total;

	$actualizar_sql1 = sprintf("UPDATE tbl15_cuentas_pagar SET abonado = '$abonado_total', subtotal = '$subtotal' WHERE cod_factura = '$cod_factura'");
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
}
?>