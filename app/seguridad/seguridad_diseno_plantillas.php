<?php
//Propagación en URL//La forma de prevenir esto es no utilizar la URL para el identificador de sesión; utilizar únicamente las cookies.
ini_set('session.use_only_cookies', 1);
//Robo por Cross-Site Scripting
//Este tipo de ataque se puede prevenir (además de evitando los ataques XSS) haciendo que las cookies de sesión tengan el atributo HttpOnly, que evita que puedan ser manejadas por javascript en la mayoría de navegadores.
ini_set('session.cookie_httponly', 1);

//header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//header("Cache-Control: no-store, no-cache, must-revalidate");
//header("Cache-Control: post-check=0, pre-check=0", false);
//header("Pragma: no-cache");

$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
$_SESSION['SKey'] = uniqid(mt_rand(), true);
//$_SESSION['IPaddress'] = ExtractUserIpAddress();
$_SESSION['LastActivity'] = $_SERVER['REQUEST_TIME'];

if ($cod_seguridad == '1') { 
include_once('../menu/03_menu_navegacion_01_super_administrador.php');
} 
elseif ($cod_seguridad == '2') { 
include_once('../menu/03_menu_navegacion_02_asistente.php');
} 
elseif ($cod_seguridad == '3') { 
include_once('../menu/03_menu_navegacion_01_administrador.php');
} 
elseif ($cod_seguridad == '4') { 
include_once('../menu/03_menu_navegacion_01_propietario.php');
} 
elseif ($cod_seguridad == '5') {
include_once('../menu/03_menu_navegacion_01_usuario_principal.php');
}
elseif ($cod_seguridad == '6') { 
include_once('../menu/03_menu_navegacion_01_usuario_de_consulta.php');
} 
elseif ($cod_seguridad == '7') { 
include_once('../menu/03_menu_navegacion_01_usuario_de_explotacion.php');
} 
elseif ($cod_seguridad == '8') {
include_once('../menu/03_menu_navegacion_01_usuario_de_auditoria.php');
}
elseif ($cod_seguridad == '9') { 
include_once('../menu/03_menu_navegacion_01_asistente.php');
} 
elseif ($cod_seguridad == '10') { 
include_once('../menu/03_menu_navegacion_01_secretaria.php');
} 
elseif ($cod_seguridad == '11') { 
include_once('../menu/03_menu_navegacion_01_medico.php');
}
elseif ($cod_seguridad == '12') { 
include_once('../menu/03_menu_navegacion_01_chef.php');
}
elseif ($cod_seguridad == '15') { 
include_once('../menu/03_menu_navegacion_01_chef.php');
}
else {
header("Location:../admin/acceso_denegado.php");
}
?>