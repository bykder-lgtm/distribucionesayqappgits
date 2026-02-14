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
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                           = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                         = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                       = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion                  = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                   = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                      = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                    = ($_SESSION['cod_cliente_sesion']);
$cod_administrador                     = ($_SESSION['cod_administrador']);
$cod_base_caja                         = ($_SESSION['cod_base_caja']);
$fecha_modificacion_cuenta_pagar       = date("Y-m-d H:i:s");

if (isset($_GET['valor'])) {

	$valor_intro                  = addslashes($_GET['valor']);
	$campo                        = addslashes($_GET['campo']);
	$cod_cuentas_pagar_abonos     = intval($_GET['id']);
//----------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------//
	$sql = "SELECT cod_tercero, cod_factura, cod_cuentas_pagar, cod_info_factura_compra FROM tbl15_cuentas_pagar_abonos WHERE (cod_cuentas_pagar_abonos = '$cod_cuentas_pagar_abonos')";
	$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
	$datos = mysqli_fetch_assoc($consulta);

	$cod_tercero                 = $datos['cod_tercero'];
	$cod_factura                 = $datos['cod_factura'];
	$cod_cuentas_pagar           = $datos['cod_cuentas_pagar'];
	$cod_info_factura_compra     = $datos['cod_info_factura_compra'];
//----------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------//
	$sql_edit_cuenta_cob = "UPDATE tbl15_cuentas_pagar_abonos SET $campo = '$valor_intro' WHERE (cod_cuentas_pagar_abonos = '$cod_cuentas_pagar_abonos')";
	$consulta_edit_cuenta_cob = mysqli_query($conectar, $sql_edit_cuenta_cob) or die(mysqli_error($conectar));
	//----------------------------------------------------------------------------------------------------//
	//----------------------------------------------------------------------------------------------------//
	$sql_cuenta_pagar_factura = "SELECT monto_deuda FROM tbl15_cuentas_pagar WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')";
	$consulta_cuenta_pagar_factura = mysqli_query($conectar, $sql_cuenta_pagar_factura) or die(mysqli_error($conectar));
	$dato_cuenta_pagar_factura = mysqli_fetch_assoc($consulta_cuenta_pagar_factura);

	$monto_deuda                 = $dato_cuenta_pagar_factura['monto_deuda'];
//----------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------//
	$sql_total_abono_factura = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_pagar_abonos WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')";
	$consulta_total_abono_factura = mysqli_query($conectar, $sql_total_abono_factura) or die(mysqli_error($conectar));
	$total_abono_factura = mysqli_fetch_assoc($consulta_total_abono_factura);

	$abonado_total               = $total_abono_factura['abonado'];
	$subtotal                    = $monto_deuda - $abonado_total;

	$actualizar_sql1 = sprintf("UPDATE tbl15_cuentas_pagar SET abonado = '$abonado_total', subtotal = '$subtotal' WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')");
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	$actualizar_sql1 = sprintf("UPDATE tbl15_info_factura_compra SET abonado = '$abonado_total', subtotal = '$subtotal' WHERE (cod_info_factura_compra = '$cod_info_factura_compra')");
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));


	$sql_datos_cuenta_pagar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_pagar, SUM(subtotal) AS total_subtotal_cuenta_pagar, SUM(abonado) AS total_abonado_cuenta_pagar 
	FROM tbl15_cuentas_pagar WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuenta_pagar = mysqli_query($conectar, $sql_datos_cuenta_pagar);
	$datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar);

	$total_monto_deuda_cuenta_pagar       = $datos_cuenta_pagar['total_monto_deuda_cuenta_pagar'];

	$sql_datos_cuentas_pagar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_pagar FROM tbl15_cuentas_pagar_abonos WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuentas_pagar_abonos = mysqli_query($conectar, $sql_datos_cuentas_pagar_abonos);
	$datos_cuentas_pagar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_pagar_abonos);

	$total_abonado_cuenta_pagar           = $datos_cuentas_pagar_abonos['total_abonado_cuenta_pagar'];
	$total_subtotal_cuenta_pagar          = $total_monto_deuda_cuenta_pagar - $total_abonado_cuenta_pagar;

	$sql_cuenta_pagar_tercero = sprintf("UPDATE tbl15_tercero SET total_monto_deuda_cuenta_pagar = '$total_monto_deuda_cuenta_pagar', 
	total_subtotal_cuenta_pagar = '$total_subtotal_cuenta_pagar', total_abonado_cuenta_pagar = '$total_abonado_cuenta_pagar', fecha_modificacion_cuenta_pagar = '$fecha_modificacion_cuenta_pagar' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_pagar_tercero = mysqli_query($conectar, $sql_cuenta_pagar_tercero) or die(mysqli_error($conectar));
}
?>