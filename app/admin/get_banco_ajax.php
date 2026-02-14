<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

try {
    // Validar que se reciba el código del banco
    if (!isset($_POST['cod_banco_cuenta']) || empty($_POST['cod_banco_cuenta'])) { throw new Exception('Código de banco no proporcionado'); }

    $cod_banco_cuenta = intval($_POST['cod_banco_cuenta']);
    // Consultar los datos del banco
    $sql = "SELECT * FROM tbl15_banco_cuenta WHERE cod_banco_cuenta = '$cod_banco_cuenta' AND cod_estado = '1'";
    $resultado = mysqli_query($conectar, $sql);

    if (!$resultado) { throw new Exception('Error en la consulta: ' . mysqli_error($conectar)); }
    if (mysqli_num_rows($resultado) == 0) { throw new Exception('No se encontró la cuenta bancaria'); }

    $banco = mysqli_fetch_assoc($resultado);
    // Preparar respuesta exitosa
    $response = array('success' => true, 'message' => 'Datos obtenidos correctamente', 'banco' => $banco);

} catch (Exception $e) {
    // Preparar respuesta de error
    $response = array('success' => false, 'message' => $e->getMessage());
}
// Enviar respuesta JSON
echo json_encode($response);
?>