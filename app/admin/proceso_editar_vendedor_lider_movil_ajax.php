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
    $cod_aliado_edit        = isset($_POST['cod_aliado_edit']) ? intval($_POST['cod_aliado_edit']) : 0;
    $codigo_tipo_vendedor_edit = isset($_POST['codigo_tipo_vendedor_edit']) ? intval($_POST['codigo_tipo_vendedor_edit']) : 0;
    // Validar campos obligatorios
    if (empty($cod_administrador_edit) || empty($cedula) || empty($nombres) || empty($apellidos) || empty($correo) || empty($telefono) || empty($cod_aliado_edit)) { echo json_encode(['status' => 'error', 'message' => 'Por favor complete todos los campos obligatorios.']); exit; }
    // Obtener información del aliado para asignar jerarquía
    $sql_aliado = "SELECT cod_asesor, cod_coordinador, cod_lider FROM tbl15_administrador WHERE cod_administrador = '$cod_aliado_edit'";
    $res_aliado = mysqli_query($conectar, $sql_aliado);
    $datos_aliado = mysqli_fetch_assoc($res_aliado);
    $cod_asesor = isset($datos_aliado['cod_asesor']) ? $datos_aliado['cod_asesor'] : 0;
    $cod_coordinador = isset($datos_aliado['cod_coordinador']) ? $datos_aliado['cod_coordinador'] : 0;
    $cod_lider = isset($datos_aliado['cod_lider']) ? $datos_aliado['cod_lider'] : 0;
    // Preparar nombres completos
    $nombres_apellidos_tercero = trim("$nombres $apellidos");
    // Actualizar Vendedor
    $sql_update = "UPDATE tbl15_administrador SET codigo_tipo_vendedor = '$codigo_tipo_vendedor_edit', cedula = '$cedula', identificacion_tercero = '$cedula', nombres = UPPER('$nombres'), apellidos = UPPER('$apellidos'),
    nombres_apellidos_tercero = UPPER('$nombres_apellidos_tercero'), correo = '$correo', correo_tercero = '$correo',  telefono = '$telefono', telefono1_tercero = '$telefono', 
    cod_aliado_estrategico = '$cod_aliado_edit', cod_asesor = '$cod_asesor', cod_coordinador = '$cod_coordinador', cod_lider = '$cod_lider'
    WHERE cod_administrador = '$cod_administrador_edit' AND cod_seguridad = '2'";
    if (mysqli_query($conectar, $sql_update)) { echo json_encode(['status' => 'success', 'message' => 'Vendedor actualizado correctamente.']); } else { echo json_encode(['status' => 'error', 'message' => 'Error al actualizar: ' . mysqli_error($conectar)]); }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
