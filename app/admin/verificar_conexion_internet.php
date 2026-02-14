<?php
include_once('../evitar_mensaje_error/error.php');
function VerificarConexionInternet() {
$conexion = @fsockopen("www.google.com", 80);
	if ($conexion) {
		fclose($conexion);
		return true;
	} else {
		return false;
	}
}
if (VerificarConexionInternet() == '1') { $conexion_internet = 'SI'; } else { $conexion_internet = 'NO'; }
echo($conexion_internet);
?>

