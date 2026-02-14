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
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	if (isset($_POST['cod_nota_observacion']) <> '') { $cod_nota_observacion = mysqli_real_escape_string($conectar, strip_tags($_POST['cod_nota_observacion'])); } else { $cod_nota_observacion = ''; }
	if (isset($_POST['cod_info_factura_venta']) <> '') { $cod_info_factura_venta = mysqli_real_escape_string($conectar, strip_tags($_POST['cod_info_factura_venta'])); } else { $cod_info_factura_venta = ''; }
	if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = mysqli_real_escape_string($conectar, strip_tags($_POST['cod_tercero'])); } else { $cod_tercero = ''; }
	if (isset($_POST['nombre_nota_observacion']) <> '') { $nombre_nota_observacion = mysqli_real_escape_string($conectar, strip_tags($_POST['nombre_nota_observacion'])); } else { $nombre_nota_observacion = ''; }
	if (isset($_POST['fecha_ymd']) <> '') { $fecha_ymd = mysqli_real_escape_string($conectar, strip_tags($_POST['fecha_ymd'])); } else { $fecha_ymd = date("Y-m-d"); }
	if (isset($_POST['cod_tipo_nota_observacion']) <> '') { $cod_tipo_nota_observacion = intval($_POST['cod_tipo_nota_observacion']); } else { $cod_tipo_nota_observacion = '1'; }
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	$pagina = addslashes($_POST['pagina']); 
/* ----------------------------------------------------------------------------------------------------------/ */
	/*
    $obtener_info_fact = "SELECT cod_administrador_revisor FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
    $info_fact = mysqli_fetch_assoc($resultado_info_fact);

    $cod_administrador_revisor                          = $info_fact['cod_administrador_revisor'];

    if ($cod_administrador_revisor == '0') {
	    $obtener_administrador_revisor_rand = "SELECT cod_administrador FROM tbl15_administrador WHERE (cod_seguridad = '27') ORDER BY RAND()";
	    $resultado_administrador_revisor_rand = mysqli_query($conectar, $obtener_administrador_revisor_rand) or die(mysqli_error($conectar));
	    $info_administrador_revisor_rand = mysqli_fetch_assoc($resultado_administrador_revisor_rand);

	    $cod_administrador_revisor                          = $info_administrador_revisor_rand['cod_administrador'];

		$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_info_factura_venta SET cod_administrador_revisor = '$cod_administrador_revisor' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
		$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
    }
    */
/* ----------------------------------------------------------------------------------------------------------/ */
    $obtener_administrador_revisor = "SELECT telefono FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_revisor')";
    $resultado_administrador_revisor = mysqli_query($conectar, $obtener_administrador_revisor) or die(mysqli_error($conectar));
    $info_administrador_revisor = mysqli_fetch_assoc($resultado_administrador_revisor);

    $telefono_revisor                                   = $info_administrador_revisor['telefono'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$tipo_soporte                                       = "DOCUMENTO";
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

    $informacion_imagen                                 = getimagesize($_FILES['url_img1']['tmp_name']);
    $ancho_imagen                                       = $informacion_imagen[0];
    $alto_imagen                                        = $informacion_imagen[1];
    $tipo_imagen                                        = $informacion_imagen[2]; // Tipo de imagen (1=GIF, 2=JPG, 3=PNG, etc.)
    $atributos_imagen                                   = $informacion_imagen['3']; // Cadena para usar en la etiqueta img
    $codigo_estado_revision                             = 1; //POR REVISAR
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
			copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
		}
		$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_nota_observacion SET nombre_nota_observacion = '$nombre_nota_observacion', fecha_ymd = '$fecha_ymd', fecha_hora = '$fecha_hora', cuenta = '$cuenta', 
		cod_administrador = '$cod_administrador', codigo_estado_revision = '$codigo_estado_revision', url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto'
		WHERE (cod_nota_observacion = '$cod_nota_observacion')");
		$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
	}
/* ----------------------------------------------------------------------------------------------------------/ */
	//$url_redir = "../admin/soportes_info_factura_venta_productos_opcion_imprimir_siscredito_visitante_intern.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_nota_observacion=".$cod_nota_observacion."&cod_tercero=".$cod_tercero."&pagina=".$pagina;
	$url_redir = "../admin/lista_soportes_info_factura_venta_siscredito_visitante_intern.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_nota_observacion=".$cod_nota_observacion."&cod_tercero=".$cod_tercero."&pagina=".$pagina;

	header("Location: $url_redir");
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
}
?>