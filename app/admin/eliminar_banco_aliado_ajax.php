<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

header('Content-Type: application/json');

if(isset($_POST['cod_banco_cuenta'])) {
    $cod_banco_cuenta = intval($_POST['cod_banco_cuenta']);
    // Cambiar el estado a 0 (inactivo) en lugar de eliminar físicamente
    $sql = "UPDATE tbl15_banco_cuenta SET cod_estado = '0' WHERE cod_banco_cuenta = '$cod_banco_cuenta'";
    $resultado = mysqli_query($conectar, $sql);
    
    if($resultado && mysqli_affected_rows($conectar) > 0) {
        echo json_encode(array('success' => true, 'mensaje' => 'Cuenta bancaria eliminada correctamente'));
    } else {
        echo json_encode(array('success' => false, 'mensaje' => 'No se pudo eliminar la cuenta bancaria. ' . mysqli_error($conectar)));
    }
} else {
    echo json_encode(array('success' => false, 'mensaje' => 'Parámetros incompletos'));
}
?>
