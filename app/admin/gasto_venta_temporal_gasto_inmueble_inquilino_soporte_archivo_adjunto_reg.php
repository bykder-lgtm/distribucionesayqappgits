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
//$cod_administrador       = ($_SESSION['cod_administrador']);
$cod_base_caja           = ($_SESSION['cod_base_caja']);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formulario_de_actualizacion")) {

	$cod_gasto_inmueble_inquilino_venta_temporal    = intval($_POST['cod_gasto_inmueble_inquilino_venta_temporal']);
	$cod_info_gasto_inmueble_inquilino_venta        = intval($_POST['cod_info_gasto_inmueble_inquilino_venta']);
	$cod_caja_virtual                               = intval($_POST['cod_caja_virtual']);
	$cuenta                                         = addslashes($_POST['cuenta']);
	$pagina                                         = addslashes($_POST['pagina']);
	$pagina_redirect                                = $pagina.'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_gasto_inmueble_inquilino_venta='.$cod_info_gasto_inmueble_inquilino_venta;

	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	/* ----------------------------------------------------------------------------------------------------------/ */
	$time                            = time();
	$fecha_ymdHis                    = date("YmdHis");
	$formato                         = 'jpg';
	$fecha_hora                      = date("H:i:s");
	$fecha_ymd                       = date("Y-m-d");

	$ruta_firma_miniatura            = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura             = '../archivador/foto/miniatura/';
	$ruta_firma_orig                 = '../archivador/firma/original/';
	$ruta_foto_orig                  = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
		$formato_img2                    = explode(".", $url_img1);
		$formato_img2                    = end($formato_img2);
		$nombre_normal2                  = 'GASTO_INQUILINO_'.$fecha_ymdHis.'_'.$cod_gasto_inmueble_inquilino_venta_temporal.'_'.$cod_info_gasto_inmueble_inquilino_venta.'.'.$formato_img2;
		$url_img_orig_producto           = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto            = $ruta_foto_orig.$nombre_normal2;
	} else { 
		$formato_img2                    = "";
		$formato_img2                    = "";
		$nombre_normal2                  = "";
		$url_img_orig_producto           = "";
		$url_img_min_producto            = "";
	}
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
	$actualizar_sql1 = "UPDATE tbl15_gasto_inmueble_inquilino_venta_temporal SET url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto' 
	WHERE (cod_gasto_inmueble_inquilino_venta_temporal = '$cod_gasto_inmueble_inquilino_venta_temporal')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
	if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto); }
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>