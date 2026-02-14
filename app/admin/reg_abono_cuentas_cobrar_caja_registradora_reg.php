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
$cod_estado_cuenta_cobrar              = 1;
$fecha_modificacion_cuenta_cobrar      = date("Y-m-d H:i:s");

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formulario_de_actualizacion")) {

	$cod_tercero             = intval($_POST['cod_tercero']);
	$abonado                 = addslashes($_POST['abonado']);
	$mensaje                 = addslashes($_POST['mensaje']);
	$fecha_pago              = addslashes($_POST['fecha_pago']);
	$cod_tipo_forma_pago     = intval($_POST['cod_tipo_forma_pago']);
	$cod_dependencia         = intval($_POST['cod_dependencia']);
	if (isset($_POST['pagina'])) { $pagina = addslashes($_POST['pagina']); } else { $pagina = "../admin/cuentas_cobrar_abonos.php"; }
	$cliente                 = "";
//-------------------------------------- -----------------------------------------------------------------//
	$fecha_anyo              = date("Y-m-d", strtotime($fecha_pago));
	$fecha_mes               = date("Y-m", strtotime($fecha_pago));
	$anyo                    = date("Y", strtotime($fecha_pago));
	$fecha_invert            = date("Y-m-d", strtotime($fecha_pago));
	$fecha_seg               = strtotime($fecha_pago);
	$hora                    = date("H:i:s");

	$sql_autoincremento_cuentas_cobrar_abonos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar_abonos'";
	$exec_autoincremento_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_cobrar_abonos = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar_abonos);
	$cod_cuentas_cobrar_abonos = $datos_autoincremento_cuentas_cobrar_abonos['AUTO_INCREMENT'];
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
	$agregar_reg_cuentas_cobrar_abonos = "INSERT INTO tbl15_cuentas_cobrar_abonos (cod_tercero, abonado, cuenta, fecha_pago, fecha_anyo, fecha_mes, 
	anyo, fecha_invert, fecha_seg, hora, mensaje, cod_administrador, cod_tipo_forma_pago, cod_dependencia) 
	VALUES ('$cod_tercero', '$abonado', '$cuenta_actual', '$fecha_pago', '$fecha_anyo', '$fecha_mes', 
	'$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$mensaje', '$cod_administrador', '$cod_tipo_forma_pago', '$cod_dependencia')";
	$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $agregar_reg_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
	$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
	FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

	$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];

	$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero')";
	$consulta_datos_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_datos_cuentas_cobrar_abonos);
	$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_cobrar_abonos);

	$total_abonado_cuenta_cobrar           = $datos_cuentas_cobrar_abonos['total_abonado_cuenta_cobrar'];
	$total_subtotal_cuenta_cobrar          = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar;

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
	total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
	WHERE (cod_tercero = '$cod_tercero')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/abono_cuentas_cobrar_por_tercero_opcion_imprimir.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>&pagina=<?php echo $pagina ?>">
<?php } ?>