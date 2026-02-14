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


$valor_intro             = addslashes($_GET['valor']);
$campo                   = addslashes($_GET['campo']);
$cod_cuentas_pagar       = intval($_GET['id']);

if ($campo == 'cod_tercero') {

$cod_tercero     = intval($valor_intro);

$data_sql = ("UPDATE tbl15_cuentas_pagar SET cod_tercero = '$cod_tercero' WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'abonado') {

$calcular_datos_cuenta_pagar = "SELECT monto_deuda FROM tbl15_cuentas_pagar WHERE (cod_cuentas_pagar='$cod_cuentas_pagar')";
$consulta_datos_cuenta_pagar = mysqli_query($conectar, $calcular_datos_cuenta_pagar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_pagar);
$datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar);

$abonado                        = addslashes($valor_intro);
$monto_deuda                    = $datos_cuenta_pagar['monto_deuda'];
$subtotal                       = $monto_deuda - $abonado;

$data_sql = ("UPDATE tbl15_cuentas_pagar SET abonado = '$abonado', subtotal = '$subtotal' WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'monto_deuda') {

$calcular_datos_cuenta_pagar = "SELECT monto_deuda FROM tbl15_cuentas_pagar WHERE (cod_cuentas_pagar='$cod_cuentas_pagar')";
$consulta_datos_cuenta_pagar = mysqli_query($conectar, $calcular_datos_cuenta_pagar);
$total_datos = mysqli_num_rows($consulta_datos_cuenta_pagar);
$datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar);

$monto_deuda                   = addslashes($valor_intro);
$subtotal                       = $monto_deuda - $abonado;;

$data_sql = ("UPDATE tbl15_cuentas_pagar SET monto_deuda = '$monto_deuda', subtotal = '$subtotal' WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
else {

$$valor_intro     = addslashes($valor_intro);

$data_sql = ("UPDATE tbl15_cuentas_pagar SET $campo = '$valor_intro' WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>