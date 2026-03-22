<?php
date_default_timezone_set("America/Bogota");
$conexion_servidor2              = "localhost";
$base_datos2                     = "distribucionesayqapp";
$conexion_usuario2               = "dataeditaxe";
$conexion_contrasena_descrip2    = "editaxe951";

$clave2                          = stripslashes($conexion_contrasena_descrip2);
$clave2                          = strip_tags($clave2);
$conexion_contrasena2            = sha1($clave2);

$conectar2                       = mysqli_connect($conexion_servidor2, $conexion_usuario2, $conexion_contrasena2, $base_datos2);
mysqli_set_charset($conectar2,"utf8");
?>