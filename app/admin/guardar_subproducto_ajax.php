<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                       = $_SESSION['usuario'];
$cod_administrador            = $_SESSION['cod_administrador'];
$tipo_ajax                    = addslashes($_POST['tipo_ajax']);
$campo                        = addslashes($_POST['campo']);

// ------------------------------------------------------------------------------------------------- //
if (($campo=='und_producto') && ($tipo_ajax=='tbl15_subproducto')) {
$und_producto                 = addslashes($_POST['valor']);
$cod_subproducto              = intval($_POST['id']);

$data_sql = ("UPDATE tbl15_subproducto SET und_producto = '$und_producto' WHERE cod_subproducto = '$cod_subproducto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>