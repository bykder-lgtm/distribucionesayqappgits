<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_intern.php");
include("../admin/class_php/class.upload.php");

$cuenta_actual                              = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                           = $_SESSION['usuario'];
$cod_administrador                          = $_SESSION['cod_administrador'];
$cuenta                                     = $cuenta_visitante;

$retorno_array                              = array();
$retorno_array2                             = array();
$codigoHTML_menu                            = '';
$codigoHTML_menu_total_reg                  = '';
$respuesta_ajax                             = array();
$tipo_soporte                               = "DOC_O_CAM";
$cod_nota_observacion                       = '';
$codigo_estado_revision                     = '';
$url_img_orig_producto                      = '';

if (is_array($_FILES) && count($_FILES) > 0) {
    if (isset($_POST['cod_nota_observacion']) <> '') { $cod_nota_observacion = intval($_POST['cod_nota_observacion']); } else { $cod_nota_observacion = ''; }
    if (isset($_POST['cod_info_factura_venta']) <> '') { $cod_info_factura_venta = intval($_POST['cod_info_factura_venta']); } else { $cod_info_factura_venta = ''; }
    if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = intval($_POST['cod_tercero']); } else { $cod_tercero = ''; }
    if (isset($_POST['cod_tipo_nota_observacion']) <> '') { $cod_tipo_nota_observacion = intval($_POST['cod_tipo_nota_observacion']); } else { $cod_tipo_nota_observacion = '1'; }
    if (isset($_POST['nombre_nota_observacion']) <> '') { $nombre_nota_observacion = addslashes($_POST['nombre_nota_observacion']); } else { $nombre_nota_observacion = ''; }
    if (isset($_POST['fecha_ymd']) <> '') { $fecha_ymd = strip_tags($_POST['fecha_ymd']); } else { $fecha_ymd = date("Y-m-d"); }
    if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
    /* ----------------------------------------------------------------------------------------------------------/ */
    $calcular_datos_cuenta_cobrar = "SELECT cod_tercero FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
    $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

    $cod_tercero                                                    = $datos_cuenta_cobrar['cod_tercero'];

    $datos_data_info_factura = "SELECT identificacion_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
    $factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

    $identificacion_tercero                                         = $data_info_factura['identificacion_tercero'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    if (($_FILES["url_img1"]["type"] == "image/pjpeg") || ($_FILES["url_img1"]["type"] == "image/jpeg") || ($_FILES["url_img1"]["type"] == "image/png") || ($_FILES["url_img1"]["type"] == "image/gif")) {

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
                    $imagen_foto_miniatura->file_new_name_body          = $fecha_ymdHis.'_'.$cod_nota_observacion.'_'.$cod_info_factura_venta.'_'.$cod_tercero.'_'.$identificacion_tercero.'_transf'; // agregamos un nuevo nombre
                    $imagen_foto_miniatura->process($ruta_foto_orig);

                    $nombre_miniatura                                   = $fecha_ymdHis.'_'.$cod_nota_observacion.'_'.$cod_info_factura_venta.'_'.$cod_tercero.'_'.$identificacion_tercero.'_transf'.'.'.$formato;
                    $url_img_min_producto                               = $ruta_foto_orig.$nombre_miniatura;
                    $url_img_orig_producto                              = $url_img_min_producto;
                } else { echo 'error : ' . $imagen_foto_miniatura->error; }
            } else {
                $formato_img2                                       = explode(".", $url_img1);
                $formato_img2                                       = end($formato_img2);
                $formato_orig2                                      = strtolower($formato_img2);
                $nombre_foto_cryp                                   = crc32($url_img1);
                $nombre_normal2                                     = $fecha_ymdHis.'_'.$cod_nota_observacion.'_'.$cod_info_factura_venta.'_'.$cod_tercero.'_'.$identificacion_tercero.'_norm'.'.'.$formato_orig2;

                $url_img_min_producto                               = $nombre_normal2;
                $url_img_orig_producto                              = $ruta_foto_orig.$nombre_normal2;
                copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
            }
    /* ----------------------------------------------------------------------------------------------------------/ */
            $sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_nota_observacion SET fecha_ymd = '$fecha_ymd', fecha_hora = '$fecha_hora', cuenta = '$cuenta', 
            cod_administrador = '$cod_administrador', codigo_estado_revision = '$codigo_estado_revision', url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto'
            WHERE (cod_nota_observacion = '$cod_nota_observacion')");
            $resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

            if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }
            
            $respuesta_ajax['afectado']                    = $afectado;
            $respuesta_ajax['cod_afectado']                = 'CARGADO_CORRECTAMENTE';
            $respuesta_ajax['cod_nota_observacion']        = $cod_nota_observacion;
            $respuesta_ajax['codigo_estado_revision']      = $codigo_estado_revision;
            $respuesta_ajax['url_img_orig_producto']       = $url_img_orig_producto;
            $respuesta_ajax['mensaje']                     = 'Cargado Correctamente.';

            echo json_encode($respuesta_ajax);
        }
    /* ----------------------------------------------------------------------------------------------------------/ */
    } else {
        $respuesta_ajax['afectado']                    = 'NO';
        $respuesta_ajax['cod_afectado']                = 'FORMATO_INCORRECTO';
        $respuesta_ajax['cod_nota_observacion']        = $cod_nota_observacion;
        $respuesta_ajax['codigo_estado_revision']      = $codigo_estado_revision;
        $respuesta_ajax['url_img_orig_producto']       = '';
        $respuesta_ajax['mensaje']                     = 'El formato de imagen es incompatible o no es una imagen valida.';

        echo json_encode($respuesta_ajax);
    }
} else {
    $respuesta_ajax['afectado']                    = 'NO';
    $respuesta_ajax['cod_afectado']                = 'NO_SE_ENVIO_ARCHIVO';
    $respuesta_ajax['cod_nota_observacion']        = $cod_nota_observacion;
    $respuesta_ajax['codigo_estado_revision']      = $codigo_estado_revision;
    $respuesta_ajax['url_img_orig_producto']       = '';
    $respuesta_ajax['mensaje']                     = 'No se envio o no se cargo ningun archivo.';

    echo json_encode($respuesta_ajax);
}
?>