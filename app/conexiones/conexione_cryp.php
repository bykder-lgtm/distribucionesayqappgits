<?php
date_default_timezone_set("America/Bogota");
$conexion_servidor3              = "localhost";
$base_datos3                     = "distribucionesayqapp";
$conexion_usuario3               = "dataeditaxe";
$conexion_contrasena_descrip3    = "editaxe951";

$clave3                          = stripslashes($conexion_contrasena_descrip3);
$clave3                          = strip_tags($clave3);
$conexion_contrasena3            = sha1($clave3);

$conectar3                       = mysqli_connect($conexion_servidor3, $conexion_usuario3, $conexion_contrasena3, $base_datos3);
mysqli_set_charset($conectar3,"utf8");
?>