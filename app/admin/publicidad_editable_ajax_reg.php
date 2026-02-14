<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);


$valor_intro               = addslashes($_GET['valor']);
$campo                     = addslashes($_GET['campo']);
$cod_publicidad            = addslashes($_GET['id']);

if ($campo == 'nombre_publicidad') {

	$nombre_publicidads0 = mysqli_real_escape_string($conectar, ($valor_intro)); 
	$nombre_publicidads1 = preg_replace("/,/", '.', $nombre_publicidads0);
	$nombre_publicidads2 = preg_replace("/'/", '.', $nombre_publicidads1);
	$nombre_publicidads3 = preg_replace("/;/", ' :', $nombre_publicidads2);
	$nombre_publicidads4 = preg_replace("/#/", ' NO ', $nombre_publicidads3);
	$nombre_publicidad = trim(preg_replace('/"/', '.', $nombre_publicidads4));

	$data_sql = ("UPDATE tbl15_publicidad SET nombre_publicidad = ('$nombre_publicidad') WHERE cod_publicidad = '$cod_publicidad'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'descripcion_publicidad') {

	$descripcion_publicidad = addslashes($valor_intro);

	$data_sql = ("UPDATE tbl15_publicidad SET descripcion_publicidad = '$descripcion_publicidad' WHERE cod_publicidad = '$cod_publicidad'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'fecha_dmy') {

	$fecha_dmy = addslashes($valor_intro);

	$data_sql = ("UPDATE tbl15_publicidad SET fecha_dmy = '$fecha_dmy' WHERE cod_publicidad = '$cod_publicidad'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'cod_posicion') {

	$cod_posicion = intval($valor_intro);

	$data_sql = ("UPDATE tbl15_publicidad SET cod_posicion = '$cod_posicion' WHERE cod_publicidad = '$cod_publicidad'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
elseif ($campo == 'cod_estado') {

	$cod_publicidad_frag = explode('-', $_GET['id']);
	$cod_publicidad = $cod_publicidad_frag[1];
	$cod_estado = intval($valor_intro);

	$data_sql = ("UPDATE tbl15_publicidad SET cod_estado = '$cod_estado' WHERE cod_publicidad = '$cod_publicidad'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
else {
	$valor_intro     = addslashes($valor_intro);

	$data_sql = ("UPDATE tbl15_publicidad SET $campo = '$valor_intro' WHERE cod_publicidad = '$cod_publicidad'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>