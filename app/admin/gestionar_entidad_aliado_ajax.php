<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (!verificar_usuario()) { header('Content-Type: application/json'); echo json_encode(['success' => false, 'message' => 'No autorizado']); exit; }

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = isset($_POST['accion']) ? $_POST['accion'] : '';
    $cod_aliado_estrategico = isset($_POST['cod_aliado_estrategico']) ? intval($_POST['cod_aliado_estrategico']) : 0;
    $cod_entidad_crediticia = isset($_POST['cod_entidad_crediticia']) ? intval($_POST['cod_entidad_crediticia']) : 0;
    $interes_ptj = isset($_POST['interes_ptj']) ? floatval($_POST['interes_ptj']) : 0.00;
    $aval_ptj = isset($_POST['aval_ptj']) ? floatval($_POST['aval_ptj']) : 0.00;
    $cod_parametrizacion = isset($_POST['cod_parametrizacion']) ? intval($_POST['cod_parametrizacion']) : 0;
    $cod_tienda = isset($_POST['cod_tienda']) ? intval($_POST['cod_tienda']) : 0;
    
    if ($cod_aliado_estrategico <= 0) { $response['message'] = 'Aliado no válido'; echo json_encode($response); exit; }
    if ($cod_entidad_crediticia <= 0) { $response['message'] = 'Seleccione una entidad crediticia'; echo json_encode($response); exit; }
    
    // Obtener nombre de la entidad crediticia
    $sql_nombre = "SELECT nombre_entidad_crediticia FROM tbl15_entidad_crediticia WHERE cod_entidad_crediticia = '$cod_entidad_crediticia'";
    $res_nombre = mysqli_query($conectar, $sql_nombre);
    $nombre_entidad_crediticia = '';
    if ($res_nombre && mysqli_num_rows($res_nombre) > 0) { $data_nombre = mysqli_fetch_assoc($res_nombre); $nombre_entidad_crediticia = $data_nombre['nombre_entidad_crediticia']; }
    
    $fecha = date("Y-m-d");
    $cod_administrador = $_SESSION['cod_administrador'];
    
    if ($accion === 'editar' && $cod_parametrizacion > 0) {
        // Obtener el estado enviado
        $cod_estado = isset($_POST['cod_estado']) ? intval($_POST['cod_estado']) : 1;
        
        // Obtener los nuevos campos de portal
        $cod_estado_activar_portal = isset($_POST['cod_estado_activar_portal']) ? intval($_POST['cod_estado_activar_portal']) : 0;
        $url_pagina_web_consulta = isset($_POST['url_pagina_web_consulta']) ? mysqli_real_escape_string($conectar, $_POST['url_pagina_web_consulta']) : '';
        
        // Si el portal no está activado, limpiar la URL
        if ($cod_estado_activar_portal != 1) {
            $url_pagina_web_consulta = '';
        }
        
        // Actualizar registro existente
        $sql = "UPDATE tbl15_parametrizacion_entidad_crediticia_aliado SET interes_ptj = '$interes_ptj', aval_ptj = '$aval_ptj', nombre_entidad_crediticia = '$nombre_entidad_crediticia', cod_estado = '$cod_estado', cod_estado_activar_portal = '$cod_estado_activar_portal', url_pagina_web_consulta = '$url_pagina_web_consulta' 
        WHERE cod_parametrizacion_entidad_crediticia_aliado = '$cod_parametrizacion'";
        if (mysqli_query($conectar, $sql)) { $response['success'] = true; $response['message'] = 'Entidad actualizada correctamente'; } else { $response['message'] = 'Error al actualizar: ' . mysqli_error($conectar); }
        
    } elseif ($accion === 'agregar') {
        // Verificar si ya existe esta entidad para el aliado
        $sql_check = "SELECT cod_parametrizacion_entidad_crediticia_aliado FROM tbl15_parametrizacion_entidad_crediticia_aliado WHERE cod_aliado_estrategico = '$cod_aliado_estrategico' AND cod_entidad_crediticia = '$cod_entidad_crediticia' AND cod_estado = '1'";
        $res_check = mysqli_query($conectar, $sql_check);
        if ($res_check && mysqli_num_rows($res_check) > 0) { $response['message'] = 'Esta entidad ya está configurada para este aliado'; echo json_encode($response); exit; }
        // Insertar nuevo registro
        $sql = "INSERT INTO tbl15_parametrizacion_entidad_crediticia_aliado (cod_administardor, cod_aliado_estrategico, cod_tienda, cod_entidad_crediticia, nombre_entidad_crediticia, interes_ptj, aval_ptj, fecha_creacion, cod_estado) 
        VALUES ('$cod_administrador', '$cod_aliado_estrategico', '$cod_tienda', '$cod_entidad_crediticia', '$nombre_entidad_crediticia', '$interes_ptj', '$aval_ptj', '$fecha', '1')";
        if (mysqli_query($conectar, $sql)) {
            $response['success'] = true;
            $response['message'] = 'Entidad agregada correctamente';
            $response['cod_parametrizacion'] = mysqli_insert_id($conectar);
        } else {
            $response['message'] = 'Error al agregar: ' . mysqli_error($conectar);
        }
    } else {
        $response['message'] = 'Acción no válida';
    }
} else {
    $response['message'] = 'Método no permitido';
}
echo json_encode($response);
?>
