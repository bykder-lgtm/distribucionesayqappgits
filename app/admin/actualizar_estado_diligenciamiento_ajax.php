<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

// Verificar sesión de usuario
if (verificar_usuario()){ } else { header('Content-Type: application/json'); echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit(); }

$cuenta_actual = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$respuesta_ajax = array();

// Verificar que los datos lleguen por POST
if (isset($_POST['cod_info_factura_venta']) && isset($_POST['campo_individual']) && isset($_POST['estado_individual']) && isset($_POST['estado_general'])) {
    // Obtener y limpiar los datos recibidos
    $cod_info_factura_venta                      = intval($_POST['cod_info_factura_venta']);
    $nombre_campo_individual                     = mysqli_real_escape_string($conectar, trim($_POST['campo_individual']));
    $estado_individual                           = intval($_POST['estado_individual']);
    $cod_estado_dilig_todo                       = intval($_POST['estado_general']);
    // Validar campos obligatorios
    if ($cod_info_factura_venta <= 0 || empty($nombre_campo_individual) || !in_array($estado_individual, [0, 1]) || !in_array($cod_estado_dilig_todo, [0, 1])) {
        header('Content-Type: application/json');
        $respuesta_ajax['success'] = false;
        $respuesta_ajax['message'] = 'Datos inválidos en la petición';
        echo json_encode($respuesta_ajax);
        exit();
    }
    // Lista de campos válidos
    $nombre_campos_validos = ['cod_estado_dilig_infocliente', 'cod_estado_dilig_infoproducto', 'cod_estado_dilig_infocreditval', 'cod_estado_dilig_infoequipogest', 'cod_estado_dilig_infocomercial', 'cod_estado_dilig_infodocumentfoto'];
    
    // Validar que el campo sea válido
    if (!in_array($nombre_campo_individual, $nombre_campos_validos)) {
        header('Content-Type: application/json');
        $respuesta_ajax['success'] = false;
        $respuesta_ajax['message'] = 'Campo de diligenciamiento no válido';
        echo json_encode($respuesta_ajax);
        exit();
    }
    
    try {
        // Actualizar el estado del campo específico y el estado general en una sola consulta
        $sql_actualizar = sprintf("UPDATE tbl15_info_factura_venta SET %s = '$estado_individual', cod_estado_dilig_todo = '$cod_estado_dilig_todo' WHERE cod_info_factura_venta = '$cod_info_factura_venta'", $nombre_campo_individual);
        $resultado = mysqli_query($conectar, $sql_actualizar);
        if (!$resultado) { throw new Exception('Error al actualizar los estados: ' . mysqli_error($conectar)); }
        // Preparar respuesta exitosa
        header('Content-Type: application/json');
        $respuesta_ajax['success'] = true;
        $respuesta_ajax['message'] = 'Estados de diligenciamiento actualizados correctamente';
        $respuesta_ajax['campo'] = $nombre_campo_individual;
        $respuesta_ajax['estado_individual'] = $estado_individual;
        $respuesta_ajax['estado_general'] = $cod_estado_dilig_todo;
        $respuesta_ajax['cod_info_factura_venta'] = $cod_info_factura_venta;
        
        echo json_encode($respuesta_ajax);
        
    } catch (Exception $e) {
        header('Content-Type: application/json');
        $respuesta_ajax['success'] = false;
        $respuesta_ajax['message'] = 'Error en la base de datos: ' . $e->getMessage();
        echo json_encode($respuesta_ajax);
    }
} else {
    // No se recibieron los datos necesarios
    header('Content-Type: application/json');
    $respuesta_ajax['success'] = false;
    $respuesta_ajax['message'] = 'Datos incompletos en la petición';
    echo json_encode($respuesta_ajax);
}
?>