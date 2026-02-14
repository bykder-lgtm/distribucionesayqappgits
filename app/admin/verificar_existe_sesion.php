<?php
//Si existe una session iniciada, devuelve 1
if (isset($_SESSION["usuario"]) && $_SESSION["usuario"] === true) {
	echo "Existe sesion: ".$_SESSION["usuario"];
	echo "<br>";
} else {
	session_start();
	echo "No existe sesion<br>";
	$_SESSION['usuario']                          = "usuariosesion";
	echo "<br>Sesion Iniciada: ".$_SESSION['usuario'];
}
?>