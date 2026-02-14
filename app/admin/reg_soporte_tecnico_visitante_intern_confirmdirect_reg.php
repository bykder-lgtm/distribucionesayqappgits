<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_intern_confirmdirect.php");

$cuenta_actual                                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                             = $_SESSION['usuario'];
$tipo_soporte                                 = "SOPORTE_TECNICO";
$cod_tipo_nota_observacion                    = 0;
/* ----------------------------------------------------------------------------------------------------------/ */
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formulario_de_actualizacion")) {

	$problema_soporte_tecnico                                  = nl2br($_POST['problema_soporte_tecnico']);
	$correo_registro_soporte_tecnico                           = addslashes($_POST['correo_registro_soporte_tecnico']);
	$correo_contrasena_perfil_cuenta_danada_soporte_tecnico    = nl2br($_POST['correo_contrasena_perfil_cuenta_danada_soporte_tecnico']);
	$cod_perfil_cuenta_completa                                = intval($_POST['cod_perfil_cuenta_completa']);
	$fecha_compra_soporte_tecnico                              = addslashes($_POST['fecha_compra_soporte_tecnico']);
	$fecha_vencimiento_soporte_tecnico                         = addslashes($_POST['fecha_vencimiento_soporte_tecnico']);
	$cod_plataforma_streaming                                  = intval($_POST['cod_plataforma_streaming']);
	if (isset($_POST['cod_tipo_reporte_fallo'])) { $cod_tipo_reporte_fallo = intval($_POST['cod_tipo_reporte_fallo']); } else { $cod_tipo_reporte_fallo = 1; }
	if (isset($_POST['cod_estado_acepta_terminos_condiciones'])) { $cod_estado_acepta_terminos_condiciones = 1; } else { $cod_estado_acepta_terminos_condiciones = 0; }
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_autoincremento_soporte_tecnico = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_soporte_tecnico'";
	$exec_autoincremento_soporte_tecnico = mysqli_query($conectar, $sql_autoincremento_soporte_tecnico) or die(mysqli_error($conectar));
	$datos_autoincremento_soporte_tecnico = mysqli_fetch_assoc($exec_autoincremento_soporte_tecnico);
	$cod_soporte_tecnico = $datos_autoincremento_soporte_tecnico['AUTO_INCREMENT'];

	$nombre_nota_observacion                            = 'SOPORTE TECNICO';
	$pagina_redirect                                    = '../admin/lista_soporte_tecnico_visitante_intern_confirmdirect.php'.'?cod_soporte_tecnico='.$cod_soporte_tecnico;
/* ----------------------------------------------------------------------------------------------------------/ */
	$buscar_usuario = "SELECT cod_administrador, cuenta FROM tbl15_administrador WHERE cuenta = '$cuenta_visitante'";
	$ejecutar_sql = mysqli_query($conectar, $buscar_usuario);
	$datax = mysqli_fetch_assoc($ejecutar_sql);

	$cod_administrador                                  = $datax['cod_administrador'];
	$cuenta                                             = $datax['cuenta'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$time                                               = time();
	$fecha_ymdHis                                       = date("YmdHis");
	$formato                                            = 'jpg';
	$fecha_hora                                         = date("H:i:s");
	$fecha_ymd                                          = date("Y-m-d");
	$fecha_creacion                                     = date("Y-m-d H:i:s");
	$fecha_soporte_tecnico                              = date("Y-m-d");
	$hora_soporte_tecnico                               = date("H:i:s");

	$ruta_firma_miniatura                               = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura                                = '../archivador/foto/miniatura/';
	$ruta_firma_orig                                    = '../archivador/firma/original/';
	$ruta_foto_orig                                     = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
		$formato_img2                                   = explode(".", $url_img1);
		$formato_img2                                   = end($formato_img2);
		$nombre_normal2                                 = $tipo_soporte.'_'.$fecha_ymdHis.'.'.$formato_img2;
		$url_img_orig_producto                          = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto                           = $ruta_foto_orig.$nombre_normal2;
	} else { 
		$formato_img2                                   = "";
		$formato_img2                                   = "";
		$nombre_normal2                                 = "";
		$url_img_orig_producto                          = "";
		$url_img_min_producto                           = "";
	}
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
	$agreg = "INSERT INTO tbl15_soporte_tecnico (problema_soporte_tecnico, fecha_soporte_tecnico, hora_soporte_tecnico, cod_administrador, url_img_orig_producto, url_img_min_producto, 
	correo_registro_soporte_tecnico, correo_contrasena_perfil_cuenta_danada_soporte_tecnico, cod_perfil_cuenta_completa, 
	fecha_compra_soporte_tecnico, fecha_vencimiento_soporte_tecnico, cod_tipo_reporte_fallo, cod_plataforma_streaming, cod_estado_acepta_terminos_condiciones) 
	VALUES ('$problema_soporte_tecnico', '$fecha_soporte_tecnico', '$hora_soporte_tecnico', '$cod_administrador', '$url_img_orig_producto', '$url_img_min_producto', 
	'$correo_registro_soporte_tecnico', '$correo_contrasena_perfil_cuenta_danada_soporte_tecnico', '$cod_perfil_cuenta_completa', 
	'$fecha_compra_soporte_tecnico', '$fecha_vencimiento_soporte_tecnico', '$cod_tipo_reporte_fallo', '$cod_plataforma_streaming', '$cod_estado_acepta_terminos_condiciones')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));

	$agreg = "INSERT INTO tbl15_nota_observacion (cod_soporte_tecnico, nombre_nota_observacion, fecha_ymd, fecha_hora, cuenta, cod_administrador, fecha_creacion, url_img_orig_producto, url_img_min_producto, cod_tipo_nota_observacion) 
	VALUES ('$cod_soporte_tecnico', '$nombre_nota_observacion', '$fecha_ymd', '$fecha_hora', '$cuenta', '$cod_administrador', '$fecha_creacion', '$url_img_orig_producto', '$url_img_min_producto', '$cod_tipo_nota_observacion')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
	if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto); }
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>