<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

$cod_administrador_actual                                           = ($_SESSION['cod_administrador']);
$fecha_creacion                                                     = date("Y-m-d H:i:s");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $identificacion                                                     = isset($_POST['identificacion_tercero']) ? trim(addslashes($_POST['identificacion_tercero'])) : '';
    $nombre1                                                            = isset($_POST['nombre1_tercero']) ? trim(addslashes($_POST['nombre1_tercero'])) : '';
    $nombre2                                                            = '';
    $apellido1                                                          = isset($_POST['apellido1_tercero']) ? trim(addslashes($_POST['apellido1_tercero'])) : '';
    $apellido2                                                          = '';
    $correo                                                             = isset($_POST['correo_tercero']) ? trim(addslashes($_POST['correo_tercero'])) : '';
    $telefono                                                           = isset($_POST['telefono1_tercero']) ? trim(addslashes($_POST['telefono1_tercero'])) : '';
    $sexo                                                               = isset($_POST['nombre_sexo']) ? trim(addslashes($_POST['nombre_sexo'])) : 'O';
    $cod_aliado                                                         = isset($_POST['cod_aliado']) ? intval($_POST['cod_aliado']) : 0;
    $direccion                                                          = isset($_POST['direccion_tercero']) ? trim(addslashes($_POST['direccion_tercero'])) : '';
    $barrio                                                             = isset($_POST['barrio_tercero']) ? trim(addslashes($_POST['barrio_tercero'])) : '';
    $cod_departamento                                                   = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : 0;
    $cod_municipio                                                      = isset($_POST['cod_municipio']) ? intval($_POST['cod_municipio']) : 0;
    // Validar campos obligatorios
    if (empty($identificacion) || empty($nombre1) || empty($apellido1) || empty($correo) || empty($telefono) || empty($cod_aliado)) { echo json_encode(['status' => 'error', 'message' => 'Por favor complete todos los campos obligatorios.']); exit; }
    // Verificar si ya existe (por cédula)
    $sql_check = "SELECT cod_administrador FROM tbl15_administrador WHERE (cedula = '$identificacion')";
    $res_check = mysqli_query($conectar, $sql_check);
    if (mysqli_num_rows($res_check) > 0) {  echo json_encode(['status' => 'error', 'message' => 'El vendedor ya se encuentra registrado (cédula duplicada).']);  exit; }
    // Obtener información del aliado para asignar jerarquía
    $sql_aliado = "SELECT cod_asesor, cod_coordinador, cod_lider FROM tbl15_administrador WHERE cod_administrador = '$cod_aliado'";
    $res_aliado = mysqli_query($conectar, $sql_aliado);
    $datos_aliado = mysqli_fetch_assoc($res_aliado);
    $cod_asesor = isset($datos_aliado['cod_asesor']) ? $datos_aliado['cod_asesor'] : 0;
    $cod_coordinador = isset($datos_aliado['cod_coordinador']) ? $datos_aliado['cod_coordinador'] : 0;
    $cod_lider = isset($datos_aliado['cod_lider']) ? $datos_aliado['cod_lider'] : 0;
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_autoincremento_administrador = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_administrador'";
    $exec_autoincremento_administrador = mysqli_query($conectar, $sql_autoincremento_administrador) or die(mysqli_error($conectar));
    $datos_autoincremento_administrador = mysqli_fetch_assoc($exec_autoincremento_administrador);

    $cod_administrador_incre                                            = $datos_autoincremento_administrador['AUTO_INCREMENT'];
    $cuenta                                                             = $identificacion.'-'.$cod_administrador_incre;
    //---------------------------------------------------------------------------------------------------------------------------------//
    // Preparar datos calculados
    $nombres_apellidos_tercero                                          = trim("$nombre1 $nombre2 $apellido1 $apellido2");
    $nombres                                                            = trim("$nombre1 $nombre2");
    $apellidos                                                          = trim("$apellido1 $apellido2");
    $contrasena                                                         = sha1($identificacion); // Encriptación SHA1
    // Valores fijos para Vendedor
    $cod_seguridad                                                      = 2; // VENDEDOR
    $nombre_tipo_tercero                                                = 'VENDEDOR';
    $nombre_tipo_identificacion                                         = 'CC';
    $nombre_tipo_cliente                                                = 'PERSONA_NATURAL';
    $nombre_tipo_regimen                                                = 'SIMPLE';
    $nombre_tipo_impuesto                                               = 'NO_RESPONSABLE_DE_IVA';
    $cod_estado_activacion_usuario                                      = 1; // Activo por defecto para vendedores según requerimientos previos
    $url_pag_redirec_ini_sesion                                         = '../index.php';
    // Insertar Nuevo Vendedor
    $sql_insert = "INSERT INTO tbl15_administrador (cedula, nombres, apellidos, nombre_sexo, cuenta, contrasena, correo, telefono, cod_seguridad, nombre_tipo_tercero, nombre_tipo_identificacion, identificacion_tercero, 
    nombres_apellidos_tercero, digito_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, telefono1_tercero, correo_tercero, 
    nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto, cod_lider, cod_coordinador, cod_asesor, cod_aliado_estrategico,
    cod_estado_activacion_usuario, cod_estado, fecha_creacion, url_pag_redirec_ini_sesion, direccion_tercero, barrio_tercero, cod_departamento, cod_municipio) 
    VALUES ('$identificacion', UPPER('$nombres'), UPPER('$apellidos'), '$sexo', '$cuenta', '$contrasena', '$correo', '$telefono', '$cod_seguridad', '$nombre_tipo_tercero', '$nombre_tipo_identificacion', '$identificacion', 
    UPPER('$nombres_apellidos_tercero'), '', UPPER('$nombre1'), UPPER('$nombre2'), UPPER('$apellido1'), UPPER('$apellido2'), '$telefono', '$correo', 
    '$nombre_tipo_cliente', '$nombre_tipo_regimen', '$nombre_tipo_impuesto', '$cod_lider', '$cod_coordinador', '$cod_asesor', '$cod_aliado', 
    '$cod_estado_activacion_usuario', '1', '$fecha_creacion', '$url_pag_redirec_ini_sesion', UPPER('$direccion'), UPPER('$barrio'), '$cod_departamento', '$cod_municipio')";
    if (mysqli_query($conectar, $sql_insert)) { echo json_encode(['status' => 'success', 'message' => 'Vendedor registrado correctamente.']); } else { echo json_encode(['status' => 'error', 'message' => 'Error al registrar en base de datos: ' . mysqli_error($conectar)]); }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
