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
$cuenta_actual                                                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                                                  = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                                                = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                                              = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion                                         = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                                          = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                                             = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                                           = ($_SESSION['cod_cliente_sesion']);
$cod_administrador                                            = ($_SESSION['cod_administrador']);
$cod_base_caja                                                = ($_SESSION['cod_base_caja']);
$cuenta                                                       = ($cuenta_actual);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formulario_de_actualizacion")) {

	$cod_cuentas_cobrar_abonos                                = intval($_POST['cod_cuentas_cobrar_abonos']);
	$cod_movimiento_contable_cuenta_personal_viejo            = intval($_POST['cod_movimiento_contable_cuenta_personal_viejo']);
	$cod_movimiento_contable_cuenta_personal_nuevo            = intval($_POST['cod_movimiento_contable_cuenta_personal_nuevo']);
	$cod_tercero                                              = intval($_POST['cod_tercero']);
	$cod_cuentas_cobrar                                       = intval($_POST['cod_cuentas_cobrar']);
	$pagina                                                   = addslashes($_POST['pagina']);
	$cod_movimiento_contable_cuenta_personal                  = $cod_movimiento_contable_cuenta_personal_nuevo;
//-------------------------------------- -----------------------------------------------------------------//
    $sql = "SELECT abonado FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')";
    $consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
    $total_datos = mysqli_num_rows($consulta);
    $datos = mysqli_fetch_assoc($consulta);

    $abonado                                           = $datos['abonado'];
//-------------------------------------- -----------------------------------------------------------------//
    $sql_datos_cuenta_cobrar = "SELECT cod_factura FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
    $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
    $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

    $cod_factura                                       = $datos_cuenta_cobrar['cod_factura'];
//-------------------------------------- -----------------------------------------------------------------//
	$sql_datos_movimiento_contable_cuenta_personal_viejo = "SELECT total_saldo FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_viejo')";
	$consulta_datos_movimiento_contable_cuenta_personal_viejo = mysqli_query($conectar, $sql_datos_movimiento_contable_cuenta_personal_viejo);
	$datos_movimiento_contable_cuenta_personal_viejo = mysqli_fetch_assoc($consulta_datos_movimiento_contable_cuenta_personal_viejo);

	$total_saldo_viejo_db                              = $datos_movimiento_contable_cuenta_personal_viejo['total_saldo'];
//-------------------------------------- -----------------------------------------------------------------//
	$sql_datos_movimiento_contable_cuenta_personal_nuevo = "SELECT total_saldo, cod_tipo_forma_pago FROM tbl15_movimiento_contable_cuenta_personal WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_nuevo')";
	$consulta_datos_movimiento_contable_cuenta_personal_nuevo = mysqli_query($conectar, $sql_datos_movimiento_contable_cuenta_personal_nuevo);
	$datos_movimiento_contable_cuenta_personal_nuevo = mysqli_fetch_assoc($consulta_datos_movimiento_contable_cuenta_personal_nuevo);

	$total_saldo_nuevo_db                              = $datos_movimiento_contable_cuenta_personal_nuevo['total_saldo'];
	$cod_tipo_forma_pago                               = $datos_movimiento_contable_cuenta_personal_nuevo['cod_tipo_forma_pago'];
//-------------------------------------- -----------------------------------------------------------------//
	$total_saldo_viejo                                 = $total_saldo_viejo_db - $abonado;
	$total_saldo_nuevo                                 = $total_saldo_nuevo_db + $abonado;
//-------------------------------------- -----------------------------------------------------------------//
	$actualizar_movimiento_contable_cuenta_personal_viejo = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo_viejo'
	WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_viejo')";
	$resultado_movimiento_contable_cuenta_personal_viejo = mysqli_query($conectar, $actualizar_movimiento_contable_cuenta_personal_viejo) or die(mysqli_error($conectar));

	$actualizar_movimiento_contable_cuenta_personal_nuevo = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo_nuevo'
	WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_nuevo')";
	$resultado_movimiento_contable_cuenta_personal_nuevo = mysqli_query($conectar, $actualizar_movimiento_contable_cuenta_personal_nuevo) or die(mysqli_error($conectar));

	$actualizar_movimiento_contable_cuenta_personal_concepto = "UPDATE tbl15_movimiento_contable_cuenta_personal_concepto SET cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal_nuevo'
	WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')";
	$resultado_movimiento_contable_cuenta_personal_concepto = mysqli_query($conectar, $actualizar_movimiento_contable_cuenta_personal_concepto) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
	$actualizar_cuentas_cobrar_abonos = "UPDATE tbl15_cuentas_cobrar_abonos SET cod_tipo_forma_pago = '$cod_tipo_forma_pago' WHERE (cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos')";
	$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $actualizar_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/cuentas_cobrar_abonos.php?cod_tercero=<?php echo $cod_tercero ?>&cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos ?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_factura=<?php echo $cod_factura ?>&cliente=<?php echo $cliente ?>&pagina=<?php echo $pagina ?>">
<?php } ?>