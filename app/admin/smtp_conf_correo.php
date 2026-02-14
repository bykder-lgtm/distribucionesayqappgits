<?php
$sql_info_correo_smtp = "SELECT * FROM tbl15_correo_smtp WHERE (cod_estado_correo_predeterminado = '1' AND cod_estado = '1')";
$resultado_info_correo_smtp = mysqli_query($conectar, $sql_info_correo_smtp);
$info_emprecorreo_smtp = mysqli_fetch_assoc($resultado_info_correo_smtp);

$nombre_correo_smtp                             = $info_emprecorreo_smtp['nombre_correo_smtp'];
$contrasena_app_correo_smtp                     = $info_emprecorreo_smtp['contrasena_app_correo_smtp'];
$host_correo_smtp                               = $info_emprecorreo_smtp['host_correo_smtp'];
$auth_correo_smtp                               = $info_emprecorreo_smtp['auth_correo_smtp'];
$secure_correo_smtp                             = $info_emprecorreo_smtp['secure_correo_smtp'];
$port_correo_smtp                               = $info_emprecorreo_smtp['port_correo_smtp'];

$Host                                           = $host_correo_smtp;
$SMTPAuth                                       = $auth_correo_smtp;
$Username                                       = $nombre_correo_smtp;
$Password                                       = $contrasena_app_correo_smtp;
$SMTPSecure                                     = $secure_correo_smtp;
$Port                                           = $port_correo_smtp;
?>