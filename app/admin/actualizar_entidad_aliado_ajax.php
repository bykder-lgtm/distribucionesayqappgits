<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

header('Content-Type: application/json');

if(isset($_POST['cod_parametrizacion'])) {
    $cod_parametrizacion = intval($_POST['cod_parametrizacion']);
    $interes_ptj = isset($_POST['interes_ptj']) ? floatval($_POST['interes_ptj']) : 0;
    $cod_estado_entrar_portal = isset($_POST['cod_estado_entrar_portal']) ? intval($_POST['cod_estado_entrar_portal']) : 0;
    $cod_estado = isset($_POST['cod_estado']) ? intval($_POST['cod_estado']) : 1;
    $url_pagina_web_consulta = isset($_POST['url_pagina_web_consulta']) ? trim(addslashes($_POST['url_pagina_web_consulta'])) : '';
    
    // Actualizar la parametrización de entidad crediticia
    $sql = "UPDATE tbl15_parametrizacion_entidad_crediticia_aliado SET 
    interes_ptj = '$interes_ptj', cod_estado_entrar_portal = '$cod_estado_entrar_portal', cod_estado = '$cod_estado', 
    url_pagina_web_consulta = '$url_pagina_web_consulta' WHERE cod_parametrizacion_entidad_crediticia_aliado = '$cod_parametrizacion'";
    $resultado = mysqli_query($conectar, $sql);
    
    if($resultado) {
        echo json_encode(array('success' => true, 'mensaje' => 'Entidad actualizada correctamente'));
    } else {
        echo json_encode(array('success' => false, 'mensaje' => 'Error al actualizar: ' . mysqli_error($conectar)));
    }
} else {
    echo json_encode(array('success' => false, 'mensaje' => 'Parámetros incompletos'));
}
?>
