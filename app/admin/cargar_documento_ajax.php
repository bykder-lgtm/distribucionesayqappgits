<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (verificar_usuario()){ } else { header('Content-Type: application/json'); echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $cod_tienda = intval($_POST['cod_tienda']);
    $cod_administrador = intval($_POST['cod_administrador']);
    $tipo_documento = trim($_POST['tipo_documento']);
    $descripcion_documento = trim(addslashes($_POST['descripcion_documento']));
    // Validaciones básicas
    if (empty($tipo_documento)) { echo json_encode(['success' => false, 'message' => 'Debe seleccionar un tipo de documento']); exit; }
    if (!isset($_FILES['documento']) || $_FILES['documento']['error'] !== UPLOAD_ERR_OK) { echo json_encode(['success' => false, 'message' => 'Debe seleccionar un archivo']); exit; }
    // Verificar que la tienda existe
    $check_tienda = "SELECT cod_tienda FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
    $result_tienda = mysqli_query($conectar, $check_tienda);
    
    if (mysqli_num_rows($result_tienda) == 0) { echo json_encode(['success' => false, 'message' => 'La tienda no existe']); exit; }
    
    // Procesar archivo
    $file = $_FILES['documento'];
    $upload_dir = '../archivador/tienda/documentos/';
    
    // Crear directorio si no existe
    if (!is_dir($upload_dir)) { mkdir($upload_dir, 0777, true); }

    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    // Validar tipo de archivo
    $allowed_types = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
    if (!in_array($file_ext, $allowed_types)) { echo json_encode(['success' => false, 'message' => 'Tipo de archivo no permitido']); exit; }
    // Validar tamaño (10MB)
    if ($file_size > 10 * 1024 * 1024) { echo json_encode(['success' => false, 'message' => 'El archivo es demasiado grande (máx. 10MB)']); exit; }
    // Generar nombre único para el archivo
    $new_filename = $tipo_documento . '_' . $cod_tienda . '_' . time() . '.' . $file_ext;
    $upload_path = $upload_dir . $new_filename;
    
    // Mover archivo
    if (move_uploaded_file($file_tmp, $upload_path)) {
        $url_documento = '../archivador/tienda/documentos/'.$new_filename;
        
        // Determinar el campo de la base de datos
        $campo_bd = '';
        switch ($tipo_documento) {
            case 'rut':
                $campo_bd = 'url_documentacion_rut_tienda';
                break;
            case 'camaracomercio':
                $campo_bd = 'url_documentacion_camaracomercio_tienda';
                break;
            case 'contratofirma':
                $campo_bd = 'url_documentacion_contratofirma_tienda';
                break;
            case 'extra1':
                $campo_bd = 'url_documentacion_extra1_tienda';
                break;
            case 'extra2':
                $campo_bd = 'url_documentacion_extra2_tienda';
                break;
            default:
                echo json_encode(['success' => false, 'message' => 'Tipo de documento no válido']);
                exit;
        }
        // Actualizar base de datos
        $sql_update = "UPDATE tbl15_tienda SET $campo_bd = '$url_documento', fecha_modificacion = NOW() WHERE cod_tienda = '$cod_tienda'";
        $result_update = mysqli_query($conectar, $sql_update);
        
        if ($result_update) {
            // Registrar en log de movimientos
            $fecha_movimiento = date("Y-m-d H:i:s");
            $descripcion_mov = "Documento $tipo_documento cargado para tienda ID: $cod_tienda";
            
            $sql_log = "INSERT INTO tbl15_registro_movimiento (cod_administrador, cod_tienda, fecha_movimiento, descripcion_movimiento, tipo_movimiento) 
            VALUES ('$cod_administrador', '$cod_tienda', '$fecha_movimiento', '$descripcion_mov', 'DOCUMENTO_CARGADO')";
            mysqli_query($conectar, $sql_log);
            echo json_encode(['success' => true, 'message' => 'Documento cargado correctamente', 'url_documento' => $url_documento]);
        } else {
            // Eliminar archivo si no se pudo actualizar la BD
            unlink($upload_path);
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la base de datos: ' . mysqli_error($conectar)]);
        }
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al cargar el archivo']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>