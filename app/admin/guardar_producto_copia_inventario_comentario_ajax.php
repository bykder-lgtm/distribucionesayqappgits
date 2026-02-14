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
$campo                        = addslashes($_REQUEST['campo']);
// ------------------------------------------------------------------------------------------------- //
if ($campo=='comentario_copia_inventario') {
$comentario_copia_inventario              = addslashes($_REQUEST['valor']);
$cod_producto_copia_inventario            = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_producto_copia_inventario SET comentario_copia_inventario = '$comentario_copia_inventario' WHERE cod_producto_copia_inventario = '$cod_producto_copia_inventario'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>