<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
header('Content-Type: application/json');

// Función para responder con JSON
function responderJSON($success, $message, $data = null) {
    $response = [
        'success' => $success,
        'message' => $message
    ];
    if ($data !== null) {
        $response['data'] = $data;
    }
    echo json_encode($response);
    exit;
}

try {
    // Verificar que sea una petición POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        responderJSON(false, 'Método no permitido');
    }
    // Obtener parámetros
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? trim($_POST['cod_info_factura_venta']) : '';
    $cod_tercero = isset($_POST['cod_tercero']) ? trim($_POST['cod_tercero']) : '';
    $cod_nota_observacion = isset($_POST['cod_nota_observacion']) ? trim($_POST['cod_nota_observacion']) : '';
    // Validar parámetros requeridos
    if (empty($cod_nota_observacion)) {
        responderJSON(false, 'Parámetro faltante: cod_nota_observacion es requerido');
    }
    // Sanitizar parámetros
    $cod_info_factura_venta = mysqli_real_escape_string($conectar, $cod_info_factura_venta);
    $cod_tercero = mysqli_real_escape_string($conectar, $cod_tercero);
    $cod_nota_observacion = mysqli_real_escape_string($conectar, $cod_nota_observacion);
    
    // Buscar la foto en la base de datos
    $sql_buscar_foto = "SELECT url_img_orig_producto, url_img_min_producto FROM tbl15_nota_observacion WHERE cod_nota_observacion = '$cod_nota_observacion'";
    $consulta_foto = mysqli_query($conectar, $sql_buscar_foto);
    
    if (!$consulta_foto) {
        responderJSON(false, 'Error en consulta de base de datos: ' . mysqli_error($conectar));
    }
    
    $datos_foto = mysqli_fetch_assoc($consulta_foto);
    
    if (!$datos_foto) {
        responderJSON(false, 'No se encontró la foto en la base de datos');
    }
    
    $url_img_orig         = $datos_foto['url_img_orig_producto'];
    $url_img_min          = $datos_foto['url_img_min_producto'];
    
    // Arrays para track de archivos eliminados y errores
    $archivos_eliminados  = [];
    $errores_eliminacion  = [];
    
    // Eliminar imagen original si existe
    if (!empty($url_img_orig)) {
        // Convertir URL relativa a ruta absoluta del servidor
        $ruta_original = $_SERVER['DOCUMENT_ROOT'] . str_replace('../', '/', $url_img_orig);
        
        if (file_exists($url_img_orig)) {
            if (unlink($url_img_orig)) {
                $archivos_eliminados[] = $url_img_orig;
            } else {
                $errores_eliminacion[] = "No se pudo eliminar: $url_img_orig";
            }
        } else {
            $errores_eliminacion[] = "Archivo no encontrado: $url_img_orig";
        }
    }
    
    // Eliminar imagen miniatura si existe
    if (!empty($url_img_min)) {
        // Convertir URL relativa a ruta absoluta del servidor
        $ruta_miniatura = $_SERVER['DOCUMENT_ROOT'] . str_replace('../', '/', $url_img_min);
        
        if (file_exists($url_img_min)) {
            if (unlink($url_img_min)) {
                $archivos_eliminados[] = $url_img_min;
            } else {
                $errores_eliminacion[] = "No se pudo eliminar: $url_img_min";
            }
        } else {
            $errores_eliminacion[] = "Archivo no encontrado: $url_img_min";
        }
    }
    // Actualizar base de datos para limpiar las URLs
    $sql_limpiar_urls = "UPDATE tbl15_nota_observacion SET url_img_orig_producto = '', url_img_min_producto = '' WHERE cod_nota_observacion = '$cod_nota_observacion'";
    $consulta_limpiar = mysqli_query($conectar, $sql_limpiar_urls);
    
    if (!$consulta_limpiar) {
        responderJSON(false, 'Error al actualizar base de datos: ' . mysqli_error($conectar));
    }
    // Preparar respuesta
    $mensaje = 'Foto eliminada exitosamente';
    $datos_respuesta = [
        'archivos_eliminados' => $archivos_eliminados,
        'cod_nota_observacion' => $cod_nota_observacion
    ];
    
    if (!empty($errores_eliminacion)) {
        $mensaje .= '. Advertencias: ' . implode(', ', $errores_eliminacion);
        $datos_respuesta['advertencias'] = $errores_eliminacion;
    }
    
    responderJSON(true, $mensaje, $datos_respuesta);
    
} catch (Exception $e) {
    error_log("Error en eliminar_foto_camara.php: " . $e->getMessage());
    responderJSON(false, 'Error interno del servidor: ' . $e->getMessage());
}
?>