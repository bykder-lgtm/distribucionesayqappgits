<?php
session_start();
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/resize-class.php'); 

header('Content-Type: application/json');
$response = array('success' => false, 'message' => '');
if (!isset($_SESSION['cod_administrador'])) { $response['message'] = 'Sesión no iniciada'; echo json_encode($response); exit; }

$cod_administrador = $_SESSION['cod_administrador'];
$nombres           = mysqli_real_escape_string($conectar, $_POST['nombres']);
$apellidos         = mysqli_real_escape_string($conectar, $_POST['apellidos']);

if (empty($nombres) || empty($apellidos)) { $response['message'] = 'Por favor complete los campos obligatorios'; echo json_encode($response); exit; }
// Iniciar transacción
mysqli_autocommit($conectar, FALSE);
$error = false;
// Actualizar datos básicos
$sql_update = "UPDATE tbl15_administrador SET nombres = '$nombres', apellidos = '$apellidos' WHERE cod_administrador = '$cod_administrador'";
if (!mysqli_query($conectar, $sql_update)) { $error = true; $response['message'] = 'Error al actualizar datos: ' . mysqli_error($conectar); }

// Manejo de imagen
if (!$error && isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
    $file = $_FILES['foto_perfil'];
    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    
    if (in_array($file['type'], $allowed_types)) {
        $path_orig = "../archivador/perfil_usuario/original/";
        $path_min  = "../archivador/perfil_usuario/miniatura/";
        
        // Crear directorios si no existen
        if (!file_exists($path_orig)) mkdir($path_orig, 0777, true);
        if (!file_exists($path_min)) mkdir($path_min, 0777, true);
        
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = "perfil_" . $cod_administrador . "_" . time() . "." . $extension;
        
        $target_orig = $path_orig . $filename;
        $target_min  = $path_min . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $target_orig)) {
            // Crear miniatura (usando la clase resize o GD simple si no existe)
            // Asumiré que existe resize-class.php como es común en este proyecto, 
            // si no, usaré GD básico
            
            if (file_exists('../admin/class_php/resize-class.php')) {
                $resizeObj = new resize($target_orig);
                $resizeObj->resizeImage(150, 150, 'crop');
                $resizeObj->saveImage($target_min, 100);
            } else {
                // Fallback GD simple
                copy($target_orig, $target_min); 
            }
            $url_min = "../archivador/perfil_usuario/miniatura/" . $filename;
            $url_orig = "../archivador/perfil_usuario/original/" . $filename;
            
            $sql_img = "UPDATE tbl15_administrador SET url_img_foto_prof_min = '$url_min', url_img_foto_prof_orig = '$url_orig' WHERE cod_administrador = '$cod_administrador'";
            if (!mysqli_query($conectar, $sql_img)) {
                $error = true;
                $response['message'] = 'Error al actualizar imagen en BD';
            }
        } else {
            $error = true;
            $response['message'] = 'Error al subir la imagen';
        }
    } else {
        $error = true;
        $response['message'] = 'Formato de imagen no permitido';
    }
}
if ($error) { mysqli_rollback($conectar); } else { mysqli_commit($conectar); $response['success'] = true; $response['message'] = 'Perfil actualizado correctamente'; }
echo json_encode($response);
?>
