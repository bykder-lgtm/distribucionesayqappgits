<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); }

$cuenta_actual                                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_administrador_sesion                                           = ($_SESSION['cod_administrador']);
$respuesta_ajax                                                     = array();
$fecha                                                              = date("Y-m-d");
$fecha_hora                                                         = date("H:i:s");
$creador                                                            = $cuenta_actual;
$cod_asesor                                                         = $cod_administrador_sesion;

if (isset($_POST['nombres_apellidos_tercero'])) {
    $nombres_apellidos_tercero                                      = trim(addslashes($_POST['nombres_apellidos_tercero']));
    $telefono1_tercero                                              = trim(addslashes($_POST['telefono1_tercero']));
    $correo_tercero                                                 = trim(addslashes($_POST['correo_tercero']));
    // Para el registro rápido, usamos el teléfono como identificador temporal si no hay NIT
    // O generamos uno basado en el tiempo
    $identificacion_tercero                                         = time(); 
    $nombre1_tercero                                                = $nombres_apellidos_tercero;
    $apellido1_tercero                                              = '';
    $cod_tipo_tercero                                               = "13";
    $nombre_tipo_tercero                                            = 'ALIADO_ESTRATEGICO';
    $cod_seguridad                                                  = "23";
    $cod_estado_activacion_usuario                                  = "1"; // Activo por ser rápido
    $cod_estado_usuario_prueba                                      = "1"; // ES USUARIO DE PRUEBA
    $contrasena                                                     = sha1($telefono1_tercero);
    $url_pag_redirec_ini_sesion                                     = '../admin/dashboard_aliado_movil.php';
    // Obtener autoincremento
    $sql_auto = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_administrador'";
    $res_auto = mysqli_query($conectar, $sql_auto);
    $data_auto = mysqli_fetch_assoc($res_auto);
    $next_id = $data_auto['AUTO_INCREMENT'];
    
    $cuenta                                                         = $telefono1_tercero.'-'.$next_id;
    // Obtener Líder y Coordinador del Asesor
    $sql_matriz = "SELECT cod_lider, cod_coordinador FROM tbl15_administrador WHERE cod_administrador = '$cod_asesor'";
    $res_matriz = mysqli_query($conectar, $sql_matriz);
    $info_matriz = mysqli_fetch_assoc($res_matriz);

    $cod_lider                                                      = $info_matriz['cod_lider'];
    $cod_coordinador                                                = $info_matriz['cod_coordinador'];

    $sql_insert = "INSERT INTO tbl15_administrador (nombre1_tercero, apellido1_tercero, telefono1_tercero, correo_tercero, 
    nombres_apellidos_tercero, cod_tipo_tercero, nombre_tipo_tercero, cod_seguridad, 
    cod_estado_activacion_usuario, cod_estado_usuario_prueba, fecha, fecha_hora, creador, 
    cedula, nombres, correo, telefono, cuenta, contrasena, cod_aliado_estrategico, 
    url_pag_redirec_ini_sesion, cod_lider, cod_coordinador, cod_asesor, cod_estado) 
    VALUES (UPPER('$nombre1_tercero'), UPPER('$apellido1_tercero'), '$telefono1_tercero', '$correo_tercero', 
    UPPER('$nombres_apellidos_tercero'), '$cod_tipo_tercero', '$nombre_tipo_tercero', '$cod_seguridad', 
    '$cod_estado_activacion_usuario', '$cod_estado_usuario_prueba', '$fecha', '$fecha_hora', '$creador', 
    '$identificacion_tercero', UPPER('$nombre1_tercero'), '$correo_tercero', '$telefono1_tercero', '$cuenta', '$contrasena', '$next_id', 
    '$url_pag_redirec_ini_sesion', '$cod_lider', '$cod_coordinador', '$cod_asesor', '1')";
    if (mysqli_query($conectar, $sql_insert)) {
        $cod_aliado = mysqli_insert_id($conectar);
        // Crear tienda automática por defecto para el aliado rápido
        $nombre_tienda                                               = $nombres_apellidos_tercero;
        $abrev_tienda                                                = 'TIENDA'.$cod_aliado;

        $sql_tienda = "INSERT INTO tbl15_tienda (nombre_tienda, abrev_tienda, nombre_tipo_tercero, identificacion_tercero, nombre1_tercero, telefono1_tercero, correo_tercero, cod_administrador, cod_aliado_estrategico, fecha_creacion, cod_estado) 
        VALUES (UPPER(''$nombre_tienda'), '$abrev_tienda', '$nombre_tipo_tercero', '$identificacion_tercero', UPPER('$nombre1_tercero'), '$telefono1_tercero', '$correo_tercero', '$cod_aliado', '$cod_aliado', '$fecha $fecha_hora', '1')";
        mysqli_query($conectar, $sql_tienda);

        $respuesta_ajax['afectado'] = "SI";
        $respuesta_ajax['mensaje'] = "Aliado Rápido registrado correctamente. Tiene un límite de 3 créditos iniciales.";
        $respuesta_ajax['cod_administrador'] = $cod_aliado;
        $respuesta_ajax['cuenta'] = $cuenta;
    } else {
        $respuesta_ajax['afectado'] = "NO";
        $respuesta_ajax['mensaje'] = "Error al registrar: " . mysqli_error($conectar);
    }
    echo json_encode($respuesta_ajax);
}
?>
