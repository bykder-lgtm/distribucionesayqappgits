<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $cod_administrador_edit = isset($_POST['cod_administrador_edit']) ? trim(addslashes($_POST['cod_administrador_edit'])) : '';
    $cedula                 = isset($_POST['cedula_edit']) ? trim(addslashes($_POST['cedula_edit'])) : '';
    $nombres                = isset($_POST['nombres_edit']) ? trim(addslashes($_POST['nombres_edit'])) : '';
    $apellidos              = isset($_POST['apellidos_edit']) ? trim(addslashes($_POST['apellidos_edit'])) : '';
    $correo                 = isset($_POST['correo_edit']) ? trim(addslashes($_POST['correo_edit'])) : '';
    $telefono               = isset($_POST['telefono1_edit']) ? trim(addslashes($_POST['telefono1_edit'])) : '';
    $cod_coordinador        = isset($_POST['cod_coordinador_edit']) ? trim(addslashes($_POST['cod_coordinador_edit'])) : '';
    $cod_lider              = isset($_POST['cod_lider_edit']) ? trim(addslashes($_POST['cod_lider_edit'])) : '';
    // Validar campos obligatorios
    if (empty($cod_administrador_edit) || empty($cedula) || empty($nombres) || empty($apellidos) || empty($correo) || empty($telefono) || empty($cod_coordinador) || empty($cod_lider)) { echo json_encode(['status' => 'error', 'message' => 'Por favor complete todos los campos obligatorios.']); exit; }
    // Preparar nombres completos
    $nombres_apellidos_tercero = trim("$nombres $apellidos");
    // Actualizar Asesor
    $sql_update = "UPDATE tbl15_administrador SET cedula = '$cedula', identificacion_tercero = '$cedula', nombres = UPPER('$nombres'), apellidos = UPPER('$apellidos'),
    nombres_apellidos_tercero = UPPER('$nombres_apellidos_tercero'), correo = '$correo', correo_tercero = '$correo', telefono = '$telefono',
    telefono1_tercero = '$telefono', cod_coordinador = '$cod_coordinador', cod_lider = '$cod_lider' WHERE cod_administrador = '$cod_administrador_edit' AND cod_seguridad = '22'";
    if (mysqli_query($conectar, $sql_update)) {
        echo json_encode(['status' => 'success', 'message' => 'Asesor actualizado correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar: ' . mysqli_error($conectar)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
