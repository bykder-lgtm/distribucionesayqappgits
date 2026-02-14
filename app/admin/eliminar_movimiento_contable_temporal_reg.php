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

if (isset($_GET["cod_movimiento_contable"])) {
	$cod_movimiento_contable = intval($_GET['cod_movimiento_contable']);

	$pagina = '../admin/reg_movimiento_contable_temporal.php';
	
	$borrar_sql = sprintf("DELETE FROM tbl15_movimiento_contable_temporal_concepto WHERE (cod_movimiento_contable = '$cod_movimiento_contable')");
	$Result1 = mysqli_query($conectar, $borrar_sql);

	$borrar_sql = sprintf("DELETE FROM tbl15_movimiento_contable WHERE (cod_movimiento_contable = '$cod_movimiento_contable') AND (nombre_estado_factura = 'ABIERTA')");
	$Result1 = mysqli_query($conectar, $borrar_sql);
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
<?php } ?>