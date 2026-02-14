<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_ext.php");

$cuenta_actual                                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                             = $_SESSION['usuario'];
$tipo_soporte                                 = "VENTA";
$cod_tipo_nota_observacion                    = 2;
/* ----------------------------------------------------------------------------------------------------------/ */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formulario_de_actualizacion")) {

	$cuenta                                             = addslashes($_POST['cuenta']);
	$cod_caja_virtual                                   = addslashes($_POST['cod_caja_virtual']);
	$nombre_estado_factura                              = addslashes($_POST['nombre_estado_factura']);
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }

	$nombre_nota_observacion                            = 'SOPORTES FACTURA DE PREVENTA';
	$pagina_redirect                                    = '../admin/checkout_visitante_intern.php'.'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&nombre_estado_factura='.$nombre_estado_factura;
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_datos_info = "SELECT * FROM tbl15_info_factura_venta_carrito_compra WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual') AND (nombre_estado_factura = '$nombre_estado_factura')";
	$consulta_info = mysqli_query($conectar, $sql_datos_info) or die(mysqli_error($conectar));
	$cantidad_resultado = mysqli_num_rows($consulta_info);
	$datos_info = mysqli_fetch_assoc($consulta_info);

	$cod_info_factura_venta_carrito_compra              = $datos_info['cod_info_factura_venta_carrito_compra'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$time                                               = time();
	$fecha_ymdHis                                       = date("YmdHis");
	$formato                                            = 'jpg';
	$fecha_hora                                         = date("H:i:s");
	$fecha_ymd                                          = date("Y-m-d");
	$fecha_creacion                                     = date("Y-m-d");

	$ruta_firma_miniatura                               = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura                                = '../archivador/foto/miniatura/';
	$ruta_firma_orig                                    = '../archivador/firma/original/';
	$ruta_foto_orig                                     = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
		$formato_img2                                       = explode(".", $url_img1);
		$formato_img2                                       = end($formato_img2);
		$nombre_normal2                                     = $tipo_soporte.'_'.$fecha_ymdHis.'.'.$formato_img2;
		$url_img_orig_soporte_visitante                     = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_soporte_visitante                      = $ruta_foto_orig.$nombre_normal2;
	} else { 
		$formato_img2                                       = "";
		$formato_img2                                       = "";
		$nombre_normal2                                     = "";
		$url_img_orig_soporte_visitante                     = "";
		$url_img_min_soporte_visitante                      = "";
	}
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
	$actualizar_sql1 = "UPDATE tbl15_info_factura_venta_carrito_compra SET url_img_orig_soporte_visitante = '$url_img_orig_soporte_visitante' WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual') AND (nombre_estado_factura = '$nombre_estado_factura')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	$agreg = "INSERT INTO tbl15_nota_observacion (nombre_nota_observacion, fecha_ymd, fecha_hora, cuenta, fecha_creacion, cod_info_factura_venta_carrito_compra, url_img_orig_producto, url_img_min_producto, cod_tipo_nota_observacion) 
	VALUES ('$nombre_nota_observacion', '$fecha_ymd', '$fecha_hora', '$cuenta_actual', '$fecha_creacion', '$cod_info_factura_venta_carrito_compra', '$url_img_orig_soporte_visitante', '$url_img_min_soporte_visitante', '$cod_tipo_nota_observacion')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
	if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_soporte_visitante); }
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>