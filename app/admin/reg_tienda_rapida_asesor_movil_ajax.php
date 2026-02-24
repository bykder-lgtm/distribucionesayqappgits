<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

$cod_administrador = ($_SESSION['cod_administrador']);
if (isset($_POST['nombre1_tercero']) && !empty($_POST['nombre1_tercero'])) {
    $nombre_tienda = trim(addslashes($_POST['nombre1_tercero']));
    $nombre1_tercero = $nombre_tienda;
    // Valores fijos para Tienda Rápida
    $cod_aliado_estrategico = 0;
    $cod_tipo_tienda = 1; // 1 = Tienda Rápida
    $cod_estado = 1;
    $fecha_creacion = date("Y-m-d H:i:s");
    // Otros campos opcionales con valores vacíos o por defecto
    $identificacion_tercero = isset($_POST['identificacion_tercero']) ? trim(addslashes($_POST['identificacion_tercero'])) : '';
    $telefono1_tercero = isset($_POST['telefono1_tercero']) ? trim(addslashes($_POST['telefono1_tercero'])) : '';
    $correo_tercero = isset($_POST['correo_tercero']) ? trim(addslashes($_POST['correo_tercero'])) : '';
    $direccion_tercero = isset($_POST['direccion_tercero']) ? trim(addslashes($_POST['direccion_tercero'])) : '';
    $barrio_tercero = isset($_POST['barrio_tercero']) ? trim(addslashes($_POST['barrio_tercero'])) : '';
    $cod_departamento = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : 0;
    $cod_municipio = isset($_POST['cod_municipio']) ? intval($_POST['cod_municipio']) : 0;
    // Obtener autoincremento para generar abreviatura y códigos
    $sql_auto = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_tienda'";
    $res_auto = mysqli_query($conectar, $sql_auto);
    $datos_auto = mysqli_fetch_assoc($res_auto);
    $cod_tienda = $datos_auto['AUTO_INCREMENT'];
    
    $abrev_tienda = 'TIENDA'.$cod_tienda;
    $cod_tienda_codif = DAXCODIFCRYPTOR::encodifdax($cod_tienda);
    $cod_tienda_codifcryp = DAXCODIFCRYPTOR::encriptardax($cod_tienda_codif);

    $sql_insert = "INSERT INTO tbl15_tienda (nombre_tienda, nombre1_tercero, abrev_tienda, cod_aliado_estrategico, cod_tipo_tienda, cod_administrador, cod_estado, fecha_creacion, identificacion_tercero, telefono1_tercero, 
    correo_tercero, direccion_tercero, barrio_tercero, cod_departamento, cod_municipio, nombre_tipo_tercero, nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto,
    descripcion_tienda, nit_razon_social, garantia_tienda) 
    VALUES (UPPER('$nombre_tienda'), UPPER('$nombre1_tercero'), UPPER('$abrev_tienda'), '$cod_aliado_estrategico', '$cod_tipo_tienda', '$cod_administrador', '$cod_estado', '$fecha_creacion', '$identificacion_tercero', '$telefono1_tercero', 
    '$correo_tercero', '$direccion_tercero', UPPER('$barrio_tercero'), '$cod_departamento', '$cod_municipio', 'TIENDA', 'PERSONA_NATURAL', 'SIMPLE', 'NO_RESPONSABLE_DE_IVA',
    '', '$identificacion_tercero', '')";
    if (mysqli_query($conectar, $sql_insert)) {
        echo json_encode(['success' => true, 'cod_tienda' => $cod_tienda, 'cod_tienda_codifcryp' => $cod_tienda_codifcryp, 'nombre_tienda' => $nombre_tienda, 'correo_tercero' => $correo_tercero, 'telefono1_tercero' => $telefono1_tercero, 'mensaje' => 'Tienda rápida creada con éxito.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear tienda rápida: ' . mysqli_error($conectar)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'El nombre de la tienda es obligatorio.']);
}
?>
