<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); }

$cuenta_actual = isset($_SESSION['usuario']) ? addslashes($_SESSION['usuario']) : '';
$token_sesion = isset($_SESSION['token']) ? addslashes($_SESSION['token']) : '';
$token_verificador = isset($_GET['token']) ? addslashes($_GET['token']) : '';
$cod_sesion = isset($_SESSION['cod_sesion']) ? addslashes($_SESSION['cod_sesion']) : '';
$fecha_salida_time = time();
$fecha_salida = date("Y-m-d H:i:s");

if (verificar_usuario() && !empty($token_verificador) && !empty($token_sesion) && ($token_verificador == $token_sesion)) {
    
    if (!empty($cod_sesion)) {
        $agregar_regis = sprintf("UPDATE tbl15_sesion SET fecha_salida_time = '%s', fecha_salida = '%s' WHERE cod_sesion = '%s'", 
        mysqli_real_escape_string($conectar, $fecha_salida_time), mysqli_real_escape_string($conectar, $fecha_salida), mysqli_real_escape_string($conectar, $cod_sesion));
        mysqli_query($conectar, $agregar_regis);
    }
    
    mysqli_close($conectar);
    session_unset(); 
    session_destroy(); 
    session_start(); 
    session_regenerate_id(true); 
    header("Location:../../index.php");
    exit;

} else { 
    mysqli_close($conectar);
    header("Location:../admin/ver_producto_visitante_intern_simulador_credito_interes_max_entidad_crediticia.php");
    exit;
}
?>