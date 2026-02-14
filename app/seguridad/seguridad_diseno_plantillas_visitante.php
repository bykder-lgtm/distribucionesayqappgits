<?php
//Propagación en URL//La forma de prevenir esto es no utilizar la URL para el identificador de sesión; utilizar únicamente las cookies.
//ini_set('session.use_only_cookies', 1);
//Robo por Cross-Site Scripting
//Este tipo de ataque se puede prevenir (además de evitando los ataques XSS) haciendo que las cookies de sesión tengan el atributo HttpOnly, que evita que puedan ser manejadas por javascript en la mayoría de navegadores.
//ini_set('session.cookie_httponly', 1);

//header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//header("Cache-Control: no-store, no-cache, must-revalidate");
//header("Cache-Control: post-check=0, pre-check=0", false);
//header("Pragma: no-cache");

$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
$_SESSION['SKey'] = uniqid(mt_rand(), true);
//$_SESSION['IPaddress'] = ExtractUserIpAddress();
$_SESSION['LastActivity'] = $_SERVER['REQUEST_TIME'];

if (($inicio_sesion == 'SI') && ($cod_seguridad == '1')) { 
	include_once('../menu/05_modulo_menu_visitante.php');
}
elseif (($inicio_sesion == 'SI') && ($cod_seguridad == '2')) { 
	include_once('../menu/05_modulo_menu_visitante.php'); 
}
elseif (($inicio_sesion == 'SI') && ($cod_seguridad == '3')) { 
	include_once('../menu/05_modulo_menu_visitante.php'); 
}
elseif (($inicio_sesion == 'NO')) { 
	include_once('../menu/05_modulo_menu_visitante.php'); 
}
else { 
	header("Location:acceso_denegado.php"); 
}
?>