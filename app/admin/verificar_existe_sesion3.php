<?php
session_start();
//Si existe una session iniciada, devuelve 1
if (isset($_SESSION["usuario"])) {
	echo "Existe sesion: ".$_SESSION["usuario"];
	echo "<br>";
} else {
	echo "No existe sesion<br>";
	$_SESSION['usuario']                          = "usuariosesion";
	echo "Sesion Iniciada: ".$_SESSION['usuario'];
}
?>