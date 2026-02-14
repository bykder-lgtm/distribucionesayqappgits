<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php'); 
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                = ($_SESSION['usuario']);
$tab                                   = addslashes($_GET['tab']);
$tipo                                  = addslashes($_GET['tipo']);
$campo                                 = addslashes($_GET['campo']);
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if (($tipo == 'editar') && ($campo == 'descripcion_archivo_adjunto')) {
$descripcion_archivo_adjunto           = addslashes($_GET['valor']);
$cod_archivo_adjunto                   = intval($_GET['id']);

$actualizar_sql1 = "UPDATE tbl15_archivo_adjunto SET descripcion_archivo_adjunto = '$descripcion_archivo_adjunto' WHERE (cod_archivo_adjunto = '$cod_archivo_adjunto')";
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>