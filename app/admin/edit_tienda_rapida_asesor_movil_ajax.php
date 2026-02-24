<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

$cod_administrador = ($_SESSION['cod_administrador']);
$cod_tienda = isset($_POST['cod_tienda_edit']) ? intval($_POST['cod_tienda_edit']) : 0;
if ($cod_tienda <= 0) { echo json_encode(['success' => false, 'message' => 'ID de tienda inválido.']); exit; }

if (isset($_POST['nombre1_tercero']) && !empty($_POST['nombre1_tercero'])) {
    
    $nombre_tienda = trim(addslashes($_POST['nombre1_tercero']));
    $identificacion_tercero = isset($_POST['identificacion_tercero']) ? trim(addslashes($_POST['identificacion_tercero'])) : '';
    $telefono1_tercero = isset($_POST['telefono1_tercero']) ? trim(addslashes($_POST['telefono1_tercero'])) : '';
    $correo_tercero = isset($_POST['correo_tercero']) ? trim(addslashes($_POST['correo_tercero'])) : '';
    $direccion_tercero = isset($_POST['direccion_tercero']) ? trim(addslashes($_POST['direccion_tercero'])) : '';
    $barrio_tercero = isset($_POST['barrio_tercero']) ? trim(addslashes($_POST['barrio_tercero'])) : '';
    $cod_departamento = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : 0;
    $cod_municipio = isset($_POST['cod_municipio']) ? intval($_POST['cod_municipio']) : 0;

    $sql_update = "UPDATE tbl15_tienda SET nombre_tienda = UPPER('$nombre_tienda'), nombre1_tercero = UPPER('$nombre_tienda'), identificacion_tercero = '$identificacion_tercero',
    nit_razon_social = '$identificacion_tercero', telefono1_tercero = '$telefono1_tercero', correo_tercero = '$correo_tercero', direccion_tercero = '$direccion_tercero',
    barrio_tercero = UPPER('$barrio_tercero'), cod_departamento = '$cod_departamento', cod_municipio = '$cod_municipio', cod_tipo_tienda = 1, cod_aliado_estrategico = 0
    WHERE cod_tienda = $cod_tienda AND cod_administrador = '$cod_administrador'";
    if (mysqli_query($conectar, $sql_update)) {
        echo json_encode(['success' => true, 'nombre_tienda' => $nombre_tienda, 'mensaje' => 'Tienda rápida actualizada con éxito.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar tienda rápida: ' . mysqli_error($conectar)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'El nombre de la tienda es obligatorio.']);
}
?>
