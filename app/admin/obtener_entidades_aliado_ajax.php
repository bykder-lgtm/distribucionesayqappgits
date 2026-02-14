<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
header('Content-Type: application/json');

if (verificar_usuario()){ } else { echo json_encode(['success' => false, 'mensaje' => 'Sesión no válida']); exit(); }

if (isset($_POST['cod_administrador'])) {
    $cod_administrador = intval($_POST['cod_administrador']);
    
    // Log para depuración
    error_log("Buscando entidades para cod_administrador: " . $cod_administrador);
    
    // Consultar las entidades crediticias asignadas a este aliado desde la tabla de parametrización
    $sql = "SELECT peca.*, ec.url_entidad_crediticia_imag_min 
    FROM tbl15_parametrizacion_entidad_crediticia_aliado peca INNER JOIN tbl15_entidad_crediticia ec ON peca.cod_entidad_crediticia = ec.cod_entidad_crediticia 
    WHERE peca.cod_aliado_estrategico = '$cod_administrador' ORDER BY peca.cod_posicion ASC";   
    $resultado = mysqli_query($conectar, $sql);
    
    if ($resultado) {
        $entidades = array();
        while ($row = mysqli_fetch_assoc($resultado)) {
            $entidades[] = array('cod_parametrizacion_entidad_crediticia_aliado' => $row['cod_parametrizacion_entidad_crediticia_aliado'], 'cod_entidad_crediticia' => $row['cod_entidad_crediticia'], 'nombre_entidad_crediticia' => $row['nombre_entidad_crediticia'], 'interes_ptj' => $row['interes_ptj'], 'cod_estado_entrar_portal' => $row['cod_estado_entrar_portal'], 'url_pagina_web_consulta' => $row['url_pagina_web_consulta'], 'cod_estado' => $row['cod_estado'], 'url_entidad_crediticia_imag_min' => $row['url_entidad_crediticia_imag_min']);
        }
        error_log("Entidades encontradas: " . count($entidades));
        error_log("Datos: " . json_encode($entidades));
        echo json_encode(['success' => true, 'entidades' => $entidades, 'count' => count($entidades)]);
    } else {
        error_log("Error en consulta: " . mysqli_error($conectar));
        echo json_encode(['success' => false, 'mensaje' => 'Error en la consulta: ' . mysqli_error($conectar)]);
    }
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Parámetro cod_administrador no proporcionado']);
}
?>
