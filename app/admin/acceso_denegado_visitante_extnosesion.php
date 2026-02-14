<?php error_reporting(E_ALL ^ E_NOTICE);
session_unset();
session_destroy();
session_start();
session_regenerate_id(true);
ini_set("session.use_trans_sid','0");
ini_set("session.use_only_cookies','1");

header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
echo "<center><br><br><br><font color='yellow'><center><img src=../imagenes/advertencia.gif alt='Advertencia'>
<strong> ACCESO DENEGADO <br><br>EL ACCESO A ESTE SITIO ESTA RESTRINGIDO</strong></font>
<img src=../imagenes/advertencia.gif alt='Advertencia'></center>";
echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; ../index_visitante_extnosesion.php">';
include ("../session/funciones_admin_visitante_extnosesion.php");
if (verificar_usuario()){
	session_unset();
	session_destroy();
	session_start();
	session_regenerate_id(true);
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; index_visitante_extnosesion.php">';
} else {
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; index_visitante_extnosesion.php">';
}
?>
<style type="text/css"> <!--body { background-color: #333333;}--></style>
<body>
<link href="../imagenes/icono.ico" type="image/x-icon" rel="shortcut icon" />
<title>Acceso Denegado</title>
</body>