<?php
date_default_timezone_set("America/Bogota");
$conexion_servidor               = "localhost";
$base_datos                      = "distribucionesayqapp";
$conexion_usuario                = "dataeditaxe";
$conexion_contrasena_descrip     = "editaxe951";

$clave                           = stripslashes($conexion_contrasena_descrip);
$clave                           = strip_tags($clave);
$conexion_contrasena             = sha1($clave);

$conectar                        = mysqli_connect($conexion_servidor, $conexion_usuario, $conexion_contrasena, $base_datos);
mysqli_set_charset($conectar,"utf8");
mysqli_query($conectar, "SET time_zone = '-05:00'");
?>