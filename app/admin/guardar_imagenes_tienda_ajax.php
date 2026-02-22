<?php
/*** Guardar Imágenes de Tienda - AJAX Handler * Procesa las imágenes cargadas desde el formulario público * Guarda los archivos y actualiza la base de datos */

header('Content-Type: application/json');
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

$response = array('success' => false, 'message' => '');

try {
    // Verificar que se recibió el código encriptado
    if (!isset($_POST['cod_tienda_cryp']) || empty($_POST['cod_tienda_cryp'])) { throw new Exception('Código de tienda no válido'); }
    $cod_tienda_cryp = $_POST['cod_tienda_cryp'];
    // Desencriptar el código de tienda
    $cod_tienda_codif = DAXCODIFCRYPTOR::descriptardax($cod_tienda_cryp);
    $cod_tienda = DAXCODIFCRYPTOR::descodifdax($cod_tienda_codif);
    
    if (!$cod_tienda || $cod_tienda <= 0) { throw new Exception('Código de tienda no válido'); }
    // Verificar que la tienda existe
    $sql_tienda = "SELECT * FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
    $consulta_tienda = mysqli_query($conectar, $sql_tienda);
    if (!$consulta_tienda || mysqli_num_rows($consulta_tienda) == 0) { throw new Exception('Tienda no encontrada'); }
    $datos_tienda = mysqli_fetch_assoc($consulta_tienda);
    
    // Crear directorio si no existe
    $directorio_imagenes = '../archivador/imagenes_tienda/';
    if (!file_exists($directorio_imagenes)) { mkdir($directorio_imagenes, 0777, true); }
    
    // Variables para almacenar las rutas de las imágenes
    $imagenes_guardadas = array();
    $campos_actualizados = array();
    
    // Procesar imagen original
    if (isset($_FILES['img_original']) && $_FILES['img_original']['error'] == 0) {
        $nombre_archivo = 'original_' . $cod_tienda . '_' . date('YmdHis') . '_' . uniqid() . '.jpg';
        $ruta_archivo = $directorio_imagenes . $nombre_archivo;
        
        if (move_uploaded_file($_FILES['img_original']['tmp_name'], $ruta_archivo)) {
            $imagenes_guardadas['original'] = $nombre_archivo;
            $campos_actualizados[] = "url_img_orig_tienda = '$ruta_archivo'";
            // Eliminar imagen anterior si existe
            if (!empty($datos_tienda['url_img_orig_tienda']) && file_exists($datos_tienda['url_img_orig_tienda'])) { unlink($datos_tienda['url_img_orig_tienda']); }
        }
    }
    // Procesar imagen de fachada
    if (isset($_FILES['img_fachada']) && $_FILES['img_fachada']['error'] == 0) {
        $nombre_archivo = 'fachada_' . $cod_tienda . '_' . date('YmdHis') . '_' . uniqid() . '.jpg';
        $ruta_archivo = $directorio_imagenes . $nombre_archivo;
        
        if (move_uploaded_file($_FILES['img_fachada']['tmp_name'], $ruta_archivo)) {
            $imagenes_guardadas['fachada'] = $nombre_archivo;
            $campos_actualizados[] = "url_img_fachada_tienda = '$ruta_archivo'";
            // Eliminar imagen anterior si existe
            if (!empty($datos_tienda['url_img_fachada_tienda']) && file_exists($datos_tienda['url_img_fachada_tienda'])) { unlink($datos_tienda['url_img_fachada_tienda']); }
        }
    }
    // Procesar imagen interior
    if (isset($_FILES['img_interior']) && $_FILES['img_interior']['error'] == 0) {
        $nombre_archivo = 'interior_' . $cod_tienda . '_' . date('YmdHis') . '_' . uniqid() . '.jpg';
        $ruta_archivo = $directorio_imagenes . $nombre_archivo;
        
        if (move_uploaded_file($_FILES['img_interior']['tmp_name'], $ruta_archivo)) {
            $imagenes_guardadas['interior'] = $nombre_archivo;
            $campos_actualizados[] = "url_img_interna_tienda = '$ruta_archivo'";
            // Eliminar imagen anterior si existe
            if (!empty($datos_tienda['url_img_interna_tienda']) && file_exists($datos_tienda['url_img_interna_tienda'])) { unlink($datos_tienda['url_img_interna_tienda']); }
        }
    }
    // Procesar imagen selfie con administrador
    if (isset($_FILES['img_selfie']) && $_FILES['img_selfie']['error'] == 0) {
        $nombre_archivo = 'selfie_' . $cod_tienda . '_' . date('YmdHis') . '_' . uniqid() . '.jpg';
        $ruta_archivo = $directorio_imagenes . $nombre_archivo;
        
        if (move_uploaded_file($_FILES['img_selfie']['tmp_name'], $ruta_archivo)) {
            $imagenes_guardadas['selfie'] = $nombre_archivo;
            $campos_actualizados[] = "url_img_selfieadmin_tienda = '$ruta_archivo'";
            // Eliminar imagen anterior si existe
            if (!empty($datos_tienda['url_img_selfieadmin_tienda']) && file_exists($datos_tienda['url_img_selfieadmin_tienda'])) { unlink($datos_tienda['url_img_selfieadmin_tienda']); }
        }
    }
    // Procesar imagen opcional
    if (isset($_FILES['img_opcional']) && $_FILES['img_opcional']['error'] == 0) {
        $nombre_archivo = 'opcional_' . $cod_tienda . '_' . date('YmdHis') . '_' . uniqid() . '.jpg';
        $ruta_archivo = $directorio_imagenes . $nombre_archivo;
        
        if (move_uploaded_file($_FILES['img_opcional']['tmp_name'], $ruta_archivo)) {
            $imagenes_guardadas['opcional'] = $nombre_archivo;
            $campos_actualizados[] = "url_img_otraopcional_tienda = '$ruta_archivo'";
            // Eliminar imagen anterior si existe
            if (!empty($datos_tienda['url_img_otraopcional_tienda']) && file_exists($datos_tienda['url_img_otraopcional_tienda'])) { unlink($datos_tienda['url_img_otraopcional_tienda']); }
        }
    }
    // Verificar que al menos una imagen se guardó
    if (empty($campos_actualizados)) { throw new Exception('No se recibieron imágenes para procesar'); }
    // Actualizar la base de datos
    $campos_sql = implode(', ', $campos_actualizados);
    
    $sql_update = "UPDATE tbl15_tienda SET $campos_sql WHERE cod_tienda = '$cod_tienda'";
    if (!mysqli_query($conectar, $sql_update)) { throw new Exception('Error al actualizar las imágenes en la base de datos: ' . mysqli_error($conectar)); }
    // Crear notificación para el administrador
    $cod_administrador = $datos_tienda['cod_administrador'];
    $nombre_tienda = $datos_tienda['nombre_tienda'];
    $fecha_actual = date('Y-m-d H:i:s');
    $fecha = date('Y-m-d');
    $fecha_mes = date('Y-m');
    $anyo = date('Y');
    $fecha_seg = time();
    
    $nombre_notificacion = "Imágenes cargadas - $nombre_tienda";
    $descripcion_notificacion = "Se han cargado nuevas imágenes para la tienda: $nombre_tienda";
    $cod_tipo_notificacion_alerta = 1;
    $cod_estado = '0';
    $cod_estado_aviso = '0';
    
    $sql_notificacion = "INSERT INTO tbl15_notificacion_alerta_renovacion 
    (cod_administrador, cod_tienda, nombre_notificacion_alerta_renovacion, descipcion_notificacion_alerta_renovacion, 
    cod_tipo_notificacion_alerta, fecha_creacion, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_estado, cod_estado_aviso)
    VALUES ('$cod_administrador', '$cod_tienda', '$nombre_notificacion', '$descripcion_notificacion', 
    '$cod_tipo_notificacion_alerta', '$fecha_actual', '$fecha', '$fecha_mes', '$anyo', '$fecha', '$fecha_seg', '$cod_estado', '$cod_estado_aviso')";
    mysqli_query($conectar, $sql_notificacion);
    
    // Registrar movimiento en el log (si existe la tabla)
    $sql_check_log = "SHOW TABLES LIKE 'tbl_registro_movimientos'";
    $result_check = mysqli_query($conectar, $sql_check_log);
    
    if (mysqli_num_rows($result_check) > 0) {
        $imagenes_texto = implode(', ', array_keys($imagenes_guardadas));
        $sql_log = "INSERT INTO tbl_registro_movimientos (modulo_movimiento, accion_movimiento, fecha_movimiento, cod_referencia)
        VALUES ('Imágenes Tienda', 'Carga de imágenes: $imagenes_texto', '$fecha_actual', '$cod_tienda')";
        mysqli_query($conectar, $sql_log);
    }
    // Preparar respuesta exitosa
    $response['success'] = true;
    $response['message'] = 'Las imágenes se han guardado correctamente';
    $response['imagenes'] = $imagenes_guardadas;
    $response['total'] = count($imagenes_guardadas);
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}
echo json_encode($response);
?>
