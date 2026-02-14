<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_intern.php");
include("../admin/class_php/class.upload.php");

$cuenta_actual                                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                             = $_SESSION['usuario'];
$cod_administrador                            = $_SESSION['cod_administrador'];
$cuenta                                       = $cuenta_visitante;
$retorno_array                                = array();
$retorno_array2                               = array();
$codigoHTML_menu                              = '';
$codigoHTML_menu_total_reg                    = '';
$respuesta_ajax                               = array();

if (isset($_GET['cod_nota_observacion'])) {
	$cod_info_factura_venta                             = intval($_GET['cod_info_factura_venta']);
	$cod_nota_observacion                               = intval($_GET['cod_nota_observacion']);
	$pagina                                             = addslashes($_GET['pagina']);
	$cod_tipo_nota_observacion                          = '1';

	$formato                                            = '.jpg';
	$fecha_ymdHis                                       = date("YmdHis");
	$nombre_archivo_foto                                = $fecha_ymdHis.'_'.$cod_info_factura_venta.'_'.$cod_nota_observacion.'_ori';
	$time                                               = time();
	$fecha_hora                                         = date("H:i:s");
	$fecha_ymd                                          = date("Y-m-d");
	$fecha_creacion                                     = date("Y-m-d");

	$ruta_firma_miniatura                               = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura                                = '../archivador/foto/miniatura/';
	$ruta_firma_orig                                    = '../archivador/firma/original/';
	$ruta_foto_orig                                     = '../archivador/documentos/';
	$url_img1                                           = $_FILES['webcam']['name'];
    $informacion_imagen                                 = getimagesize($_FILES['webcam']['tmp_name']);
    $ancho_imagen                                       = $informacion_imagen[0];
    $alto_imagen                                        = $informacion_imagen[1];
    $tipo_imagen                                        = $informacion_imagen[2]; // Tipo de imagen (1=GIF, 2=JPG, 3=PNG, etc.)
    $atributos_imagen                                   = $informacion_imagen['3']; // Cadena para usar en la etiqueta img
    $codigo_estado_revision                             = 1; //POR REVISAR
	$url_img_foto_orig                                  = $ruta_foto_orig.$nombre_archivo_foto.$formato;
	$tipo_soporte                                       = "WEBCAM";
	$mensaje                                            = "Datos actualizados correctamente.";
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 

		if ($alto_imagen > 1024) {
			$imagen_foto_miniatura                                  = new upload($_FILES['url_img1']);
			if ($imagen_foto_miniatura->uploaded) {
				$imagen_foto_miniatura->image_resize                = true; // default is true
				$imagen_foto_miniatura->image_convert               = $formato;
				$imagen_foto_miniatura->image_x                     = 1024; // para el ancho a cortar
				$imagen_foto_miniatura->image_ratio_y               = true; // para que se ajuste dependiendo del ancho definido
				$imagen_foto_miniatura->file_new_name_body          = $fecha_ymdHis.'_'.$tipo_soporte.'_transf'; // agregamos un nuevo nombre
				$imagen_foto_miniatura->process($ruta_foto_orig);

				$nombre_miniatura                                   = $fecha_ymdHis.'_'.$tipo_soporte.'_transf'.'.'.$formato;
				$url_img_min_producto                               = $ruta_foto_orig.$nombre_miniatura;
				$url_img_orig_producto                              = $url_img_min_producto;
			} else { echo 'error : ' . $imagen_foto_miniatura->error; }
		} else {
			$formato_img2                                       = explode(".", $url_img1);
			$formato_img2                                       = end($formato_img2);
			$formato_orig2                                      = strtolower($formato_img2);
			$nombre_foto_cryp                                   = crc32($url_img1);
			$nombre_normal2                                     = $fecha_ymdHis.'_'.$tipo_soporte.'_norm'.'.'.$formato_orig2;

			$url_img_min_producto                               = $nombre_normal2;
			$url_img_orig_producto                              = $ruta_foto_orig.$nombre_normal2;
			copy($_FILES['webcam']['tmp_name'], $url_img_orig_producto);
		}
		$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_nota_observacion SET fecha_ymd = '$fecha_ymd', fecha_hora = '$fecha_hora', cuenta = '$cuenta', 
		cod_administrador = '$cod_administrador', url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto'
		WHERE (cod_nota_observacion = '$cod_nota_observacion')");
		$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

		if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }
	}
	//header('Content-Type: application/json');
	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['url_img_orig_producto']           = $url_img_orig_producto;
	$respuesta_ajax['cod_nota_observacion']            = $cod_nota_observacion;
	$respuesta_ajax['cod_info_factura_venta']          = $cod_info_factura_venta;
	$respuesta_ajax['mensaje']                         = $mensaje;
	$concatenar_respuesta                              = $afectado.'__'.$url_img_orig_producto.'__'.$cod_nota_observacion.'__'.$cod_info_factura_venta.'__'.$mensaje.'__'.$pagina;

	//echo json_encode($respuesta_ajax);
	echo $concatenar_respuesta;
	//echo json_encode($url_img_foto_orig);
}
?>
