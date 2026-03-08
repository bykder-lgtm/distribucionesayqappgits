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
    $cod_lider              = isset($_POST['cod_lider_edit']) ? trim(addslashes($_POST['cod_lider_edit'])) : '';
    $direccion              = isset($_POST['direccion_edit']) ? trim(addslashes($_POST['direccion_edit'])) : '';
    $barrio                 = isset($_POST['barrio_edit']) ? trim(addslashes($_POST['barrio_edit'])) : '';
    $cod_departamento       = isset($_POST['cod_departamento_edit']) ? intval($_POST['cod_departamento_edit']) : 0;
    $cod_municipio          = isset($_POST['cod_municipio_edit']) ? intval($_POST['cod_municipio_edit']) : 0;
    
    // Validar campos obligatorios
    if (empty($cod_administrador_edit) || empty($cedula) || empty($nombres) || empty($apellidos) || empty($correo) || empty($telefono) || empty($cod_lider)) { 
        echo json_encode(['status' => 'error', 'message' => 'Por favor complete todos los campos obligatorios.']); 
        exit; 
    }
    // Preparar nombres completos
    $nombres_apellidos_tercero = trim("$nombres $apellidos");
    // Actualizar Revisor
    $sql_update = "UPDATE tbl15_administrador SET cedula = '$cedula', identificacion_tercero = '$cedula', nombres = UPPER('$nombres'),
        apellidos = UPPER('$apellidos'), nombres_apellidos_tercero = UPPER('$nombres_apellidos_tercero'), correo = '$correo',
        correo_tercero = '$correo', telefono = '$telefono', telefono1_tercero = '$telefono', cod_lider = '$cod_lider',
        direccion_tercero = UPPER('$direccion'), barrio_tercero = UPPER('$barrio'), 
        cod_departamento = '$cod_departamento', cod_municipio = '$cod_municipio'
        WHERE cod_administrador = '$cod_administrador_edit' AND cod_seguridad = '27'";
        
    if (mysqli_query($conectar, $sql_update)) { 
        echo json_encode(['status' => 'success', 'message' => 'Revisor actualizado correctamente.']); 
    } else { 
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar: ' . mysqli_error($conectar)]); 
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
