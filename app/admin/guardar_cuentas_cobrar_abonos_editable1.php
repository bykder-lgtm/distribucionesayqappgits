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
$fecha_modificacion_cuenta_cobrar      = date("Y-m-d H:i:s");

if (isset($_GET['valor'])) {

	$valor_intro                  = addslashes($_GET['valor']);
	$campo                        = addslashes($_GET['campo']);
	$cod_cuentas_cobrar_abonos    = intval($_GET['id']);
//----------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------//
	$sql = "SELECT cod_tercero, cod_factura, cod_cuentas_cobrar, cod_info_factura_venta FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')";
	$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
	$datos = mysqli_fetch_assoc($consulta);

	$cod_tercero                 = $datos['cod_tercero'];
	$cod_factura                 = $datos['cod_factura'];
	$cod_cuentas_cobrar          = $datos['cod_cuentas_cobrar'];
	$cod_info_factura_venta      = $datos['cod_info_factura_venta'];
//----------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------//
	$sql_edit_cuenta_cob = "UPDATE tbl15_cuentas_cobrar_abonos SET $campo = '$valor_intro' WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')";
	$consulta_edit_cuenta_cob = mysqli_query($conectar, $sql_edit_cuenta_cob) or die(mysqli_error($conectar));
	//----------------------------------------------------------------------------------------------------//
	//----------------------------------------------------------------------------------------------------//
	$sql_cuenta_cobrar_factura = "SELECT monto_deuda FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (cod_estado_archivado = '0')";
	$consulta_cuenta_cobrar_factura = mysqli_query($conectar, $sql_cuenta_cobrar_factura) or die(mysqli_error($conectar));
	$dato_cuenta_cobrar_factura = mysqli_fetch_assoc($consulta_cuenta_cobrar_factura);

	$monto_deuda                 = $dato_cuenta_cobrar_factura['monto_deuda'];
//----------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------//
	$sql_total_abono_factura = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (cod_estado_archivado = '0')";
	$consulta_total_abono_factura = mysqli_query($conectar, $sql_total_abono_factura) or die(mysqli_error($conectar));
	$total_abono_factura = mysqli_fetch_assoc($consulta_total_abono_factura);

	$abonado_total               = $total_abono_factura['abonado'];
	$subtotal                    = $monto_deuda - $abonado_total;

	$actualizar_sql1 = sprintf("UPDATE tbl15_cuentas_cobrar SET abonado = '$abonado_total', subtotal = '$subtotal' WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (cod_estado_archivado = '0')");
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	$actualizar_sql1 = sprintf("UPDATE tbl15_info_factura_venta SET abonado = '$abonado_total', subtotal = '$subtotal' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));


	$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
	FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

	$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];

	$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0')";
	$consulta_datos_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_datos_cuentas_cobrar_abonos);
	$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_cobrar_abonos);

	$total_abonado_cuenta_cobrar           = $datos_cuentas_cobrar_abonos['total_abonado_cuenta_cobrar'];
	$total_subtotal_cuenta_cobrar          = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar;

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
	total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
}
?>