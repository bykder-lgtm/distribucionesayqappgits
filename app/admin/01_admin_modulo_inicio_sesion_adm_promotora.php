<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../gestor_administrar_msj_alerta_error/gestor_alerta_error.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

if (!isset($_SESSION['cod_administrador']) && $_SESSION['cod_administrador']==null) {
    header("location: ../index.php");
} else {
    $cod_administrador                    = $_SESSION['cod_administrador'];
    $token                                = $_SESSION['token'];

    $sql_usuario = "SELECT cod_administrador, cuenta, cedula, contrasena, cod_seguridad, nombres, apellidos, 
    nombre_sexo, correo, url_img_foto_prof_min, url_img_foto_prof_orig, estilo_css, cod_tienda, cod_aliado_estrategico FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador') AND cod_estado != '0'";
    $consultar_usuario = mysqli_query($conectar, $sql_usuario) or die(mysqli_error($conectar));
    $datos_usuar = mysqli_fetch_array($consultar_usuario);

    $cuenta_usuario                      = $datos_usuar['cuenta'];
    $cod_seguridad_usuario               = $datos_usuar['cod_seguridad'];

    // PROMOTORA is 29
    if ($cod_seguridad_usuario != '29' && $cod_seguridad_usuario != '1') { header("location: ../index.php"); exit(); }

    $nombres_usuario                     = $datos_usuar['nombres'];
    $apellidos_usuario                   = $datos_usuar['apellidos'];
    $nombre_sexo_usuario                 = $datos_usuar['nombre_sexo'];
    $correo_usuario                      = $datos_usuar['correo'];
    $url_img_foto_prof_min_usuario       = $datos_usuar['url_img_foto_prof_min'];
    $url_img_foto_prof_orig_usuario      = $datos_usuar['url_img_foto_prof_orig'];
    $estilo_css_usuario                  = $datos_usuar['estilo_css'];
    $cod_tienda                          = $datos_usuar['cod_tienda'];
    $cod_aliado_estrategico              = $datos_usuar['cod_aliado_estrategico'];

    if ($url_img_foto_prof_min_usuario == '') { $url_img_foto_prof_min_usuario = '../archivador/perfil_usuario/miniatura/perfil-avatar-hombre-icono-redondo_24640-14044.jpg'; }
}
?>
