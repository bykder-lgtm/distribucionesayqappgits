<?php
header('Content-type: application/json; charset=UTF-8');
include_once ('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

$respuesta_ajax = array();

if ($_POST['cod_producto']) {

	$cod_producto = intval($_POST['cod_producto']);

	$sql_producto_elim = "SELECT cod_producto_bar, nombre_producto FROM tbl01_producto WHERE cod_producto = '$cod_producto'";
	$consultar_producto_elim = mysqli_query($conectar, $sql_producto_elim) or die(mysqli_error($conectar));
	$datos_producto_elim = mysqli_fetch_array($consultar_producto_elim);

	$cod_producto_bar               = $datos_producto_elim['cod_producto_bar'];
	$nombre_producto                = $datos_producto_elim['nombre_producto'];
	$nombre_regtro                  = $cod_producto_bar.' | '.$nombre_producto;

    $sql_copiar = "INSERT INTO tbl01_producto_copia SELECT * FROM tbl01_producto WHERE cod_producto = '$cod_producto'";
    $exec_copiar = mysqli_query($conectar, $sql_copiar) or die(mysqli_error($conectar));

	$sql_eliminar_registro = "DELETE FROM tbl01_producto WHERE cod_producto = '$cod_producto'";
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']          = 'success';
		$respuesta_ajax['message']         = 'Registro eliminado exitosamente ...<br>'.$nombre_regtro;
	} else {
		$respuesta_ajax['status']          = 'error';
		$respuesta_ajax['message']         = 'No se puede eliminar el registro ...<br>'.$nombre_regtro;
	}
	echo json_encode($respuesta_ajax);
}
//--------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------//
if ($_POST['cod_cotizar_producto']) {

	$cod_cotizar_producto = intval($_POST['cod_cotizar_producto']);

	$sql_cotizar_producto_elim = "SELECT cod_producto_bar, nombre_producto FROM tbl01_cotizar_producto WHERE cod_cotizar_producto = '$cod_cotizar_producto'";
	$consultar_cotizar_producto_elim = mysqli_query($conectar, $sql_cotizar_producto_elim) or die(mysqli_error($conectar));
	$datos_cotizar_producto_elim = mysqli_fetch_array($consultar_cotizar_producto_elim);

	$cod_producto_bar                       = $datos_cotizar_producto_elim['cod_producto_bar'];
	$nombre_producto                        = $datos_cotizar_producto_elim['nombre_producto'];
	$nombre_regtro                          = $cod_producto_bar.' | '.$nombre_producto;

    $sql_copiar = "INSERT INTO tbl01_cotizar_producto_copia SELECT * FROM tbl01_cotizar_producto WHERE cod_cotizar_producto = '$cod_cotizar_producto'";
    $exec_copiar = mysqli_query($conectar, $sql_copiar) or die(mysqli_error($conectar));

	$sql_eliminar_registro = "DELETE FROM tbl01_cotizar_producto WHERE cod_cotizar_producto = '$cod_cotizar_producto'";
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']          = 'success';
		$respuesta_ajax['message']         = 'Registro eliminado exitosamente ...<br>'.$nombre_regtro;
	} else {
		$respuesta_ajax['status']          = 'error';
		$respuesta_ajax['message']         = 'No se puede eliminar el registro ...<br>'.$nombre_regtro;
	}
	echo json_encode($respuesta_ajax);
}
//--------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------//
if ($_POST['cod_visita']) {

	$cod_visita = intval($_POST['cod_visita']);

	$sql_visita_elim = "SELECT fecha_ymd, nombre_pais FROM tbl01_visita WHERE cod_visita = '$cod_visita'";
	$consultar_visita_elim = mysqli_query($conectar, $sql_visita_elim) or die(mysqli_error($conectar));
	$datos_visita_elim = mysqli_fetch_array($consultar_visita_elim);

	$fecha_ymd                              = $datos_visita_elim['fecha_ymd'];
	$nombre_pais                            = $datos_visita_elim['nombre_pais'];
	$nombre_regtro                          = $fecha_ymd.' | '.$nombre_pais;

    $sql_copiar = "INSERT INTO tbl01_visita_copia SELECT * FROM tbl01_visita WHERE cod_visita = '$cod_visita'";
    $exec_copiar = mysqli_query($conectar, $sql_copiar) or die(mysqli_error($conectar));

	$sql_eliminar_registro = "DELETE FROM tbl01_visita WHERE cod_visita = '$cod_visita'";
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']          = 'success';
		$respuesta_ajax['message']         = 'Registro eliminado exitosamente ...<br>'.$nombre_regtro;
	} else {
		$respuesta_ajax['status']          = 'error';
		$respuesta_ajax['message']         = 'No se puede eliminar el registro ...<br>'.$nombre_regtro;
	}
	echo json_encode($respuesta_ajax);
}
//--------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------//
if ($_POST['cod_visita_detalle_navegacion']) {

	$cod_visita_detalle_navegacion = intval($_POST['cod_visita_detalle_navegacion']);

	$sql_visita_detalle_navegacion_elim = "SELECT fecha_ymd, nombre_pais FROM tbl01_visita_detalle_navegacion WHERE cod_visita_detalle_navegacion = '$cod_visita_detalle_navegacion'";
	$consultar_visita_detalle_navegacion_elim = mysqli_query($conectar, $sql_visita_detalle_navegacion_elim) or die(mysqli_error($conectar));
	$datos_visita_detalle_navegacion_elim = mysqli_fetch_array($consultar_visita_detalle_navegacion_elim);

	$fecha_ymd                              = $datos_visita_detalle_navegacion_elim['fecha_ymd'];
	$nombre_pais                            = $datos_visita_detalle_navegacion_elim['nombre_pais'];
	$nombre_regtro                          = $fecha_ymd.' | '.$nombre_pais;

    $sql_copiar = "INSERT INTO tbl01_visita_copia SELECT * FROM tbl01_visita_detalle_navegacion WHERE cod_visita_detalle_navegacion = '$cod_visita_detalle_navegacion'";
    $exec_copiar = mysqli_query($conectar, $sql_copiar) or die(mysqli_error($conectar));

	$sql_eliminar_registro = "DELETE FROM tbl01_visita_detalle_navegacion WHERE cod_visita_detalle_navegacion = '$cod_visita_detalle_navegacion'";
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']          = 'success';
		$respuesta_ajax['message']         = 'Registro eliminado exitosamente ...<br>'.$nombre_regtro;
	} else {
		$respuesta_ajax['status']          = 'error';
		$respuesta_ajax['message']         = 'No se puede eliminar el registro ...<br>'.$nombre_regtro;
	}
	echo json_encode($respuesta_ajax);
}
//--------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------//
if ($_POST['cod_campanya']) {

	$cod_campanya = intval($_POST['cod_campanya']);

	$sql_campanya_elim = "SELECT nombre_redes_sociales, nombre_campanya FROM tbl01_campanya WHERE cod_campanya = '$cod_campanya'";
	$consultar_campanya_elim = mysqli_query($conectar, $sql_campanya_elim) or die(mysqli_error($conectar));
	$datos_campanya_elim = mysqli_fetch_array($consultar_campanya_elim);

	$nombre_redes_sociales                  = $datos_campanya_elim['nombre_redes_sociales'];
	$nombre_campanya                        = $datos_campanya_elim['nombre_campanya'];
	$nombre_regtro                          = $nombre_redes_sociales.' | '.$nombre_campanya;
	$cod_estado                             = 0;
	$nombre_estado                          = 'INACTIVO';
	
    //$sql_copiar = "INSERT INTO tbl01_campanya_copia SELECT * FROM tbl01_campanya WHERE cod_campanya = '$cod_campanya'";
    //$exec_copiar = mysqli_query($conectar, $sql_copiar) or die(mysqli_error($conectar));
	//$sql_eliminar_registro = "DELETE FROM tbl01_campanya WHERE cod_campanya = '$cod_campanya'";
	//$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	$sql_eliminar_registro = "UPDATE tbl01_campanya SET cod_estado=\"$cod_estado\", nombre_estado=\"$nombre_estado\" WHERE cod_campanya = $cod_campanya";
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro);

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']          = 'success';
		$respuesta_ajax['message']         = 'Registro eliminado exitosamente ...<br>'.$nombre_regtro;
	} else {
		$respuesta_ajax['status']          = 'error';
		$respuesta_ajax['message']         = 'No se puede eliminar el registro ...<br>'.$nombre_regtro;
	}
	echo json_encode($respuesta_ajax);
}
//--------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------//
if ($_POST['cod_recurso']) {

	$cod_recurso = intval($_POST['cod_recurso']);

	$sql_recurso_elim = "SELECT nombre_recurso, nombre_tipo_formato FROM tbl01_recurso WHERE cod_recurso = '$cod_recurso'";
	$consultar_recurso_elim = mysqli_query($conectar, $sql_recurso_elim) or die(mysqli_error($conectar));
	$datos_recurso_elim = mysqli_fetch_array($consultar_recurso_elim);

	$nombre_recurso                         = $datos_recurso_elim['nombre_recurso'];
	$nombre_tipo_formato                    = $datos_recurso_elim['nombre_tipo_formato'];
	$nombre_regtro                          = $nombre_recurso.' | '.$nombre_tipo_formato;

    //$sql_copiar = "INSERT INTO tbl01_recurso_copia SELECT * FROM tbl01_recurso WHERE cod_recurso = '$cod_recurso'";
    //$exec_copiar = mysqli_query($conectar, $sql_copiar) or die(mysqli_error($conectar));

	//$sql_eliminar_registro = "DELETE FROM tbl01_recurso WHERE cod_recurso = '$cod_recurso'";
	//$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	$cod_estado                             = 0;
	$nombre_estado                          = 'INACTIVO';
	
	$sql_eliminar_registro = "UPDATE tbl01_recurso SET cod_estado=\"$cod_estado\", nombre_estado=\"$nombre_estado\" WHERE cod_recurso = $cod_recurso";
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro);

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']          = 'success';
		$respuesta_ajax['message']         = 'Registro eliminado exitosamente ...<br>'.$nombre_regtro;
	} else {
		$respuesta_ajax['status']          = 'error';
		$respuesta_ajax['message']         = 'No se puede eliminar el registro ...<br>'.$nombre_regtro;
	}
	echo json_encode($respuesta_ajax);
}
//--------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------//
if ($_POST['cod_galeria_video']) {

	$cod_galeria_video = intval($_POST['cod_galeria_video']);

	$sql_galeria_video_elim = "SELECT nombre_galeria_video, nombre_tipo_formato FROM tbl01_galeria_video WHERE cod_galeria_video = '$cod_galeria_video'";
	$consultar_galeria_video_elim = mysqli_query($conectar, $sql_galeria_video_elim) or die(mysqli_error($conectar));
	$datos_galeria_video_elim = mysqli_fetch_array($consultar_galeria_video_elim);

	$nombre_galeria_video                   = $datos_galeria_video_elim['nombre_galeria_video'];
	$nombre_tipo_formato                    = $datos_galeria_video_elim['nombre_tipo_formato'];
	$nombre_regtro                          = $nombre_galeria_video.' | '.$nombre_tipo_formato;

    //$sql_copiar = "INSERT INTO tbl01_galeria_video_copia SELECT * FROM tbl01_galeria_video WHERE cod_galeria_video = '$cod_galeria_video'";
    //$exec_copiar = mysqli_query($conectar, $sql_copiar) or die(mysqli_error($conectar));

	//$sql_eliminar_registro = "DELETE FROM tbl01_galeria_video WHERE cod_galeria_video = '$cod_galeria_video'";
	//$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	$cod_estado                             = 0;
	$nombre_estado                          = 'INACTIVO';

	$sql_eliminar_registro = "UPDATE tbl01_galeria_video SET cod_estado=\"$cod_estado\", nombre_estado=\"$nombre_estado\" WHERE cod_galeria_video = $cod_galeria_video";
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro);

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']          = 'success';
		$respuesta_ajax['message']         = 'Registro eliminado exitosamente ...<br>'.$nombre_regtro;
	} else {
		$respuesta_ajax['status']          = 'error';
		$respuesta_ajax['message']         = 'No se puede eliminar el registro ...<br>'.$nombre_regtro;
	}
	echo json_encode($respuesta_ajax);
}
//--------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------//
if ($_POST['cod_nuestro_equipo']) {

	$cod_nuestro_equipo = intval($_POST['cod_nuestro_equipo']);

	$sql_nuestro_equipo_elim = "SELECT nombre_nuestro_equipo, nombre_cargo FROM tbl01_nuestro_equipo WHERE cod_nuestro_equipo = '$cod_nuestro_equipo'";
	$consultar_nuestro_equipo_elim = mysqli_query($conectar, $sql_nuestro_equipo_elim) or die(mysqli_error($conectar));
	$datos_nuestro_equipo_elim = mysqli_fetch_array($consultar_nuestro_equipo_elim);

	$nombre_nuestro_equipo                  = $datos_nuestro_equipo_elim['nombre_nuestro_equipo'];
	$nombre_cargo                           = $datos_nuestro_equipo_elim['nombre_cargo'];
	$nombre_regtro                          = $nombre_nuestro_equipo.' | '.$nombre_cargo;

	$sql_eliminar_registro = "DELETE FROM tbl01_nuestro_equipo WHERE cod_nuestro_equipo = '$cod_nuestro_equipo'";
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']          = 'success';
		$respuesta_ajax['message']         = 'Registro eliminado exitosamente ...<br>'.$nombre_regtro;
	} else {
		$respuesta_ajax['status']          = 'error';
		$respuesta_ajax['message']         = 'No se puede eliminar el registro ...<br>'.$nombre_regtro;
	}
	echo json_encode($respuesta_ajax);
}
//--------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------//
if ($_POST['cod_blog']) {

	$cod_blog = intval($_POST['cod_blog']);

	$sql_blog_elim = "SELECT nombre_blog FROM tbl01_blog WHERE cod_blog = '$cod_blog'";
	$consultar_blog_elim = mysqli_query($conectar, $sql_blog_elim) or die(mysqli_error($conectar));
	$datos_blog_elim = mysqli_fetch_array($consultar_blog_elim);

	$nombre_blog                           = $datos_blog_elim['nombre_blog'];
	$nombre_regtro                         = $nombre_blog;

    $sql_copiar = "INSERT INTO tbl01_blog_copia SELECT * FROM tbl01_blog WHERE cod_blog = '$cod_blog'";
    $exec_copiar = mysqli_query($conectar, $sql_copiar) or die(mysqli_error($conectar));

	$sql_eliminar_registro = "DELETE FROM tbl01_blog WHERE cod_blog = '$cod_blog'";
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']          = 'success';
		$respuesta_ajax['message']         = 'Registro eliminado exitosamente ...<br>'.$nombre_regtro;
	} else {
		$respuesta_ajax['status']          = 'error';
		$respuesta_ajax['message']         = 'No se puede eliminar el registro ...<br>'.$nombre_regtro;
	}
	echo json_encode($respuesta_ajax);
}
//--------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------//
if ($_POST['cod_banner_slider']) {

	$cod_banner_slider = intval($_POST['cod_banner_slider']);

	$sql_banner_slider_elim = "SELECT nombre_banner_slider, nombre_tipo_formato FROM tbl01_banner_slider WHERE cod_banner_slider = '$cod_banner_slider'";
	$consultar_banner_slider_elim = mysqli_query($conectar, $sql_banner_slider_elim) or die(mysqli_error($conectar));
	$datos_banner_slider_elim = mysqli_fetch_array($consultar_banner_slider_elim);

	$nombre_banner_slider                   = $datos_banner_slider_elim['nombre_banner_slider'];
	$nombre_tipo_formato                    = $datos_banner_slider_elim['nombre_tipo_formato'];
	$nombre_regtro                          = $nombre_banner_slider.' | '.$nombre_tipo_formato;

	$sql_eliminar_registro = "DELETE FROM tbl01_banner_slider WHERE cod_banner_slider = '$cod_banner_slider'";
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']          = 'success';
		$respuesta_ajax['message']         = 'Registro eliminado exitosamente ...<br>'.$nombre_regtro;
	} else {
		$respuesta_ajax['status']          = 'error';
		$respuesta_ajax['message']         = 'No se puede eliminar el registro ...<br>'.$nombre_regtro;
	}
	echo json_encode($respuesta_ajax);
}
//--------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------//