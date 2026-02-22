<?php
/** * Guardar firma electrónica de tienda * Recibe la firma en base64 y el cod_tienda encriptado */

include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
header('Content-Type: application/json');
$respuesta = array('success' => false, 'message' => 'Error desconocido');
// Obtener datos JSON
$json = file_get_contents('php://input');
$datos = json_decode($json, true);
if (!$datos || !isset($datos['cod_tienda_cryp']) || !isset($datos['firma'])) { $respuesta['message'] = 'Datos incompletos'; echo json_encode($respuesta); exit; }
$cod_tienda_cryp                                                = $datos['cod_tienda_cryp'];
$firma_base64                                                   = $datos['firma'];

try {
    // Desencriptar el código de tienda
    $cod_tienda_codif                                               = DAXCODIFCRYPTOR::descriptardax($cod_tienda_cryp);
    $cod_tienda                                                     = DAXCODIFCRYPTOR::descodifdax($cod_tienda_codif);

    if ($cod_tienda <= 0) { $respuesta['message'] = 'Código de tienda no válido'; echo json_encode($respuesta); exit; }
    
    // Verificar que existe la tienda
    $sql_tienda = "SELECT cod_tienda, nombre_tienda, cod_administrador FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
    $consulta_tienda = mysqli_query($conectar, $sql_tienda);
    if (!$consulta_tienda || mysqli_num_rows($consulta_tienda) == 0) { $respuesta['message'] = 'Tienda no encontrada'; echo json_encode($respuesta); exit; }
    $datos_tienda = mysqli_fetch_assoc($consulta_tienda);

    $nombre_tienda                                                  = $datos_tienda['nombre_tienda'];
    $cod_administrador                                              = $datos_tienda['cod_administrador'];
    $nombre_notificacion_alerta_renovacion                          = 'La tienda ' . $nombre_tienda . ' ha subido su firma';
    $descipcion_notificacion_alerta_renovacion                      = 'La tienda ' . $nombre_tienda . ' ha subido su firma';
    $cod_tipo_notificacion_alerta                                   = 1;
    $fecha_creacion                                                 = date('Y-m-d H:i:s');
    $fecha                                                          = date('Y-m-d');
    $fecha_mes                                                      = date('Y-m');
    $anyo                                                           = date('Y');
    $fecha_invert                                                   = date('Y-m-d');
    $fecha_seg                                                      = time();
    $cod_estado                                                     = '0';
    $cod_estado_aviso                                               = '0';
    // Definir directorio de firmas primero
    $directorio_firmas                                              = '../archivador/firma/';
    if (!file_exists($directorio_firmas)) { mkdir($directorio_firmas, 0777, true); }
    $nombre_archivo                                                 = 'firma_tienda_'.$cod_tienda.'_'.date('YmdHis').'.png';
    $ruta_archivo                                                   = $directorio_firmas . $nombre_archivo;
    $url_firma                                                      = '../archivador/firma/'.$nombre_archivo;
    // Insertar la notificación en la base de datos
    $sql_insert = "INSERT INTO tbl15_notificacion_alerta_renovacion (cod_administrador, cod_tienda, nombre_notificacion_alerta_renovacion, descipcion_notificacion_alerta_renovacion, 
    cod_tipo_notificacion_alerta, fecha_creacion, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_estado, cod_estado_aviso) 
    VALUES ('$cod_administrador', '$cod_tienda', '$nombre_notificacion_alerta_renovacion', '$descipcion_notificacion_alerta_renovacion', 
    '$cod_tipo_notificacion_alerta', '$fecha_creacion', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_estado', '$cod_estado_aviso')";
    $resultado = mysqli_query($conectar, $sql_insert);
    
    // Procesar y guardar la imagen de firma
    $firma_data                                                     = str_replace('data:image/png;base64,', '', $firma_base64);
    $firma_data                                                     = str_replace(' ', '+', $firma_data);
    $firma_decoded                                                  = base64_decode($firma_data);
    // Guardar archivo
    if (file_put_contents($ruta_archivo, $firma_decoded)) {
        // Actualizar la base de datos con la URL de la firma
        $fecha_firma                                                 = date('Y-m-d H:i:s');
        $sql_update = "UPDATE tbl15_tienda SET url_firma_electronica = '$url_firma', fecha_firma_electronica = '$fecha_firma' WHERE cod_tienda = '$cod_tienda'";
        if (mysqli_query($conectar, $sql_update)) { $respuesta['success'] = true; $respuesta['message'] = 'Firma guardada correctamente'; } else { $respuesta['message'] = 'Error al actualizar la base de datos'; }
    } else {
        $respuesta['message'] = 'Error al guardar el archivo de firma';
    }
} catch (Exception $e) {
    $respuesta['message'] = 'Error al procesar la firma: ' . $e->getMessage();
}
echo json_encode($respuesta);
?>
