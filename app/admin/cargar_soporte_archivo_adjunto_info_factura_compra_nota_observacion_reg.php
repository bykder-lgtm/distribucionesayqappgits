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
$cuenta_actual                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                                        = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                                      = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                                    = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion                               = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                                = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                                   = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                                 = ($_SESSION['cod_cliente_sesion']);
//$cod_administrador                                  = ($_SESSION['cod_administrador']);
$cod_base_caja                                      = ($_SESSION['cod_base_caja']);
$tipo_soporte                                       = "COMPRA";
/* ----------------------------------------------------------------------------------------------------------/ */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formulario_de_actualizacion")) {

	$cod_info_factura_compra                            = intval($_POST['cod_info_factura_compra']);
	$cuenta                                             = addslashes($_POST['cuenta']);
	$cod_caja_virtual                                   = addslashes($_POST['cod_caja_virtual']);
	$cod_tipo_nota_observacion                          = intval($_POST['cod_tipo_nota_observacion']);
	$pagina                                             = addslashes($_POST['pagina']);
	$nombre_nota_observacion                            = 'SOPORTES FACTURA DE COMPRA';

	$pagina_redirect                                    = $pagina.'?cod_info_factura_compra='.$cod_info_factura_compra.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&pagina='.$pagina;
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
/* ----------------------------------------------------------------------------------------------------------/ */
	$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
	$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
	$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

	//$cod_info_factura_compra                            = $data_info_factura['cod_info_factura_compra'];
	$cod_administrador                                  = $data_info_factura['cod_administrador'];
	$cod_tercero                                        = $data_info_factura['cod_tercero'];
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
		$nombre_normal2                                     = $tipo_soporte.'_'.$fecha_ymdHis.'_'.$cod_info_factura_compra.'_'.$cod_tercero.'_'.$cod_administrador.'.'.$formato_img2;
		$url_img_orig_producto                              = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto                               = $ruta_foto_orig.$nombre_normal2;
	} else { 
		$formato_img2                                       = "";
		$formato_img2                                       = "";
		$nombre_normal2                                     = "";
		$url_img_orig_producto                              = "";
		$url_img_min_producto                               = "";
	}
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
	$actualizar_sql1 = "UPDATE tbl15_info_factura_compra SET url_img_orig_producto = '$url_img_orig_producto' WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

	$agreg = "INSERT INTO tbl15_nota_observacion (nombre_nota_observacion, fecha_ymd, fecha_hora, cuenta, cod_administrador, fecha_creacion, cod_tipo_nota_observacion, cod_info_factura_compra, url_img_orig_producto, url_img_min_producto) 
	VALUES ('$nombre_nota_observacion', '$fecha_ymd', '$fecha_hora', '$cuenta_actual', '$cod_administrador', '$fecha_creacion', '$cod_tipo_nota_observacion', '$cod_info_factura_compra', '$url_img_orig_producto', '$url_img_min_producto')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
	if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto); }
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>