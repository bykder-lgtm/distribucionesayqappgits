<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
header('Content-Type: application/json');

$response                                                           = array('success' => false, 'mensaje' => '');
$cod_estado_documentacion                                           = 1;
$fecha_documentacion                                                = date('Y-m-d H:i:s');
try {
    $cod_administrador                                              = 0;
    // Verificar por cod_aliado (desde formulario público con código encriptado)
    $cod_aliado                                                     = isset($_POST['cod_aliado']) ? intval($_POST['cod_aliado']) : 0;
    
    if ($cod_aliado > 0) {
        // Verificar que el aliado exista y sea un aliado estratégico (cod_seguridad = 23)
        $sql_verify = "SELECT cod_administrador FROM tbl15_administrador WHERE cod_administrador = '$cod_aliado' AND cod_seguridad = '23'";
        $res_verify = mysqli_query($conectar, $sql_verify);
        if (!$res_verify || mysqli_num_rows($res_verify) == 0) { throw new Exception('Aliado no encontrado'); }
        $cod_administrador                                            = $cod_aliado;
    } else {
        throw new Exception('Datos de identificación no válidos');
    }
    $action                                                           = isset($_POST['action']) ? $_POST['action'] : '';
    $accion                                                           = isset($_POST['accion']) ? $_POST['accion'] : '';
    // Unificar el nombre de la acción
    if (empty($action) && !empty($accion)) { $action = $accion; }
    // Carpeta para subir documentos
    $upload_dir                                                       = '../archivador/documentacion_aliados/' . $cod_administrador . '/';
    // Crear carpeta si no existe
    if (!file_exists($upload_dir)) { mkdir($upload_dir, 0777, true); }
    
    switch ($action) {
        case 'guardar_todo':
            // Acción unificada: guarda documentos Y cuenta bancaria en una sola petición
            $updates                                                          = array();
            $permitidos                                                       = array('pdf');
            $mensajes                                                         = array();
            // ===== PROCESAR DOCUMENTOS =====
            // Procesar Cédula
            $cedula_field = isset($_FILES['cedula_file']) && $_FILES['cedula_file']['error'] == 0 ? 'cedula_file' : '';
            if (!empty($cedula_field)) {
                $archivo                                                      = $_FILES[$cedula_field];
                $extension                                                    = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                if (!in_array($extension, $permitidos)) { throw new Exception('Formato de archivo Cédula no permitido'); }
                if ($archivo['size'] > 5 * 1024 * 1024) { throw new Exception('El archivo Cédula excede el tamaño máximo de 5MB'); }
                $nombre_archivo                                               = 'cedula_' . time() . '_' . uniqid() . '.' . $extension;
                $url_documentacion_cedula_aliado                              = $upload_dir . $nombre_archivo;
                if (move_uploaded_file($archivo['tmp_name'], $url_documentacion_cedula_aliado)) {
                    $updates[]                                                = "url_documentacion_cedula_aliado = '" . mysqli_real_escape_string($conectar, $url_documentacion_cedula_aliado) . "'";
                    $mensajes[]                                               = 'Cédula';
                } else {
                    throw new Exception('Error al subir el archivo Cédula');
                }
            }
            // Procesar RUT
            $rut_field = isset($_FILES['rut_file']) && $_FILES['rut_file']['error'] == 0 ? 'rut_file' : '';
            if (!empty($rut_field)) {
                $archivo                                                      = $_FILES[$rut_field];
                $extension                                                    = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                if (!in_array($extension, $permitidos)) { throw new Exception('Formato de archivo RUT no permitido'); }
                if ($archivo['size'] > 5 * 1024 * 1024) { throw new Exception('El archivo RUT excede el tamaño máximo de 5MB'); }
                $nombre_archivo                                               = 'rut_' . time() . '_' . uniqid() . '.' . $extension;
                $url_documentacion_cedula_aliado                              = $upload_dir . $nombre_archivo;
                if (move_uploaded_file($archivo['tmp_name'], $url_documentacion_cedula_aliado)) {
                    $updates[]                                                = "url_documentacion_rut_aliado = '" . mysqli_real_escape_string($conectar, $url_documentacion_cedula_aliado) . "'";
                    $mensajes[]                                               = 'RUT';
                } else {
                    throw new Exception('Error al subir el archivo RUT');
                }
            }
            // Procesar Cámara de Comercio
            $camara_field = isset($_FILES['camara_file']) && $_FILES['camara_file']['error'] == 0 ? 'camara_file' : '';
            if (!empty($camara_field)) {
                $archivo                                                      = $_FILES[$camara_field];
                $extension                                                    = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                if (!in_array($extension, $permitidos)) { throw new Exception('Formato de archivo Cámara de Comercio no permitido'); }
                if ($archivo['size'] > 10 * 1024 * 1024) { throw new Exception('El archivo Cámara de Comercio excede el tamaño máximo de 5MB'); }
                $nombre_archivo                                               = 'camara_comercio_' . time() . '_' . uniqid() . '.' . $extension;
                $url_documentacion_cedula_aliado                              = $upload_dir . $nombre_archivo;
                if (move_uploaded_file($archivo['tmp_name'], $url_documentacion_cedula_aliado)) {
                    $updates[]                                                = "url_documentacion_camaracomercio_aliado = '" . mysqli_real_escape_string($conectar, $url_documentacion_cedula_aliado) . "'";
                    $mensajes[]                                               = 'Cámara de Comercio';
                } else {
                    throw new Exception('Error al subir el archivo Cámara de Comercio');
                }
            }
            // Actualizar documentos en BD
            if (count($updates) > 0) {
                $sql_update = "UPDATE tbl15_administrador SET cod_estado_documentacion = '$cod_estado_documentacion', fecha_documentacion = '$fecha_documentacion', ".implode(', ', $updates)." WHERE cod_administrador = '$cod_administrador'";
                if (!mysqli_query($conectar, $sql_update)) { throw new Exception('Error al actualizar los documentos: ' . mysqli_error($conectar)); }
            }
            
            // ===== PROCESAR FIRMA ELECTRÓNICA =====
            if (isset($_POST['firma_electronica']) && !empty($_POST['firma_electronica'])) {
                $firmaBase64 = $_POST['firma_electronica'];
                
                // Validar que sea una imagen base64 válida
                if (preg_match('/^data:image\/(png|jpeg|jpg);base64,/', $firmaBase64)) {
                    // Extraer la data base64
                    $firmaData = preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $firmaBase64);
                    $firmaData = str_replace(' ', '+', $firmaData);
                    $firmaDecoded = base64_decode($firmaData);
                    
                    if ($firmaDecoded !== false) {
                        // Generar nombre único para la firma
                        $nombreFirma = 'firma_electronica_' . time() . '_' . uniqid() . '.png';
                        $rutaFirma = $upload_dir . $nombreFirma;
                        
                        // Guardar la imagen
                        if (file_put_contents($rutaFirma, $firmaDecoded)) {
                            // Actualizar en BD
                            $sql_update_firma = "UPDATE tbl15_administrador SET url_img_firma_prof_ori = '" . mysqli_real_escape_string($conectar, $rutaFirma) . "' WHERE cod_administrador = '$cod_administrador'";
                            
                            if (mysqli_query($conectar, $sql_update_firma)) {
                                $mensajes[] = 'Firma electrónica';
                            } else {
                                throw new Exception('Error al guardar la firma en la base de datos: ' . mysqli_error($conectar));
                            }
                        } else {
                            throw new Exception('Error al guardar el archivo de firma');
                        }
                    } else {
                        throw new Exception('Error al decodificar la firma');
                    }
                } else {
                    throw new Exception('Formato de firma no válido');
                }
            }
            // ===== PROCESAR CUENTA BANCARIA =====
            $nombre_banco_cuenta                                      = isset($_POST['nombre_banco_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_banco_cuenta'])) : '';
            $numero_banco_cuenta                                      = isset($_POST['numero_banco_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['numero_banco_cuenta'])) : '';
            $cod_tipo_cuenta_banco                                    = isset($_POST['cod_tipo_cuenta_banco']) ? intval($_POST['cod_tipo_cuenta_banco']) : 0;
            $nombre_titular_cuenta                                    = isset($_POST['nombre_titular_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_titular_cuenta'])) : '';
            $identificacion_titular_cuenta                            = isset($_POST['identificacion_titular_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['identificacion_titular_cuenta'])) : '';
            // Procesar certificado bancario
            $url_certificado_banco = '';
            $certificado_field = isset($_FILES['certificado_banco']) && $_FILES['certificado_banco']['error'] == 0 ? 'certificado_banco' : '';
            if (!empty($certificado_field)) {
                $archivo = $_FILES[$certificado_field];
                $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                if (!in_array($extension, $permitidos)) { throw new Exception('Formato de certificado bancario no permitido'); }
                if ($archivo['size'] > 5 * 1024 * 1024) { throw new Exception('El certificado bancario excede el tamaño máximo de 5MB'); }
                $nombre_archivo                                           = 'certificado_banco_' . time() . '_' . uniqid() . '.' . $extension;
                $url_documentacion_cedula_aliado                                            = $upload_dir . $nombre_archivo;
                if (move_uploaded_file($archivo['tmp_name'], $url_documentacion_cedula_aliado)) { $url_certificado_banco = $url_documentacion_cedula_aliado; } else { throw new Exception('Error al subir el certificado bancario'); }
            }
            // Solo procesar cuenta si se llenaron los campos requeridos
            if (!empty($nombre_banco_cuenta) && !empty($numero_banco_cuenta) && $cod_tipo_cuenta_banco > 0) {
                // Determinar nombre del tipo de cuenta
                $nombre_tipo_cuenta                                       = '';
                if ($cod_tipo_cuenta_banco == 1) { $nombre_tipo_cuenta = 'Ahorros'; } elseif ($cod_tipo_cuenta_banco == 2) { $nombre_tipo_cuenta = 'Corriente'; }
                // Verificar si ya existe esta cuenta
                $sql_verificar = "SELECT cod_banco_cuenta FROM tbl15_banco_cuenta WHERE cod_aliado_estrategico = '$cod_administrador' AND numero_banco_cuenta = '$numero_banco_cuenta' AND cod_estado = '1'";
                $res_verificar = mysqli_query($conectar, $sql_verificar);
                if (!$res_verificar || mysqli_num_rows($res_verificar) == 0) {
                    // Insertar cuenta bancaria
                    $fecha_actual                                         = date('Y-m-d H:i:s');
                    $sql_insert = "INSERT INTO tbl15_banco_cuenta (cod_aliado_estrategico, nombre_banco_cuenta, numero_banco_cuenta, cod_tipo_cuenta_banco, nombre_tipo_cuenta_banco, nombre_titular_cuenta, identificacion_titular_cuenta, url_certificado_banco_cuenta, cod_estado, fecha_creacion) 
                    VALUES ('$cod_administrador', '$nombre_banco_cuenta', '$numero_banco_cuenta', '$cod_tipo_cuenta_banco', '$nombre_tipo_cuenta', '$nombre_titular_cuenta', '$identificacion_titular_cuenta', '$url_certificado_banco', '1', '$fecha_actual')";
                    if (mysqli_query($conectar, $sql_insert)) { $mensajes[] = 'Cuenta bancaria'; } else { throw new Exception('Error al agregar la cuenta bancaria: ' . mysqli_error($conectar)); }
                } else {
                    // La cuenta ya existe, no es error, solo aviso
                    $mensajes[]                                           = 'Cuenta bancaria (ya existía)';
                }
            }
            // Respuesta final
            if (count($mensajes) > 0) { $response['success'] = true; $response['mensaje'] = 'Guardado correctamente: '.implode(', ', $mensajes); } else { $response['success'] = true; $response['mensaje'] = 'No se realizaron cambios'; }
            break;
            
        case 'guardar_documentos':
            $updates                                               = array();
            $permitidos                                            = array('pdf');
            // Procesar RUT - soporta ambos nombres de campo
            $rut_field                                             = isset($_FILES['url_documentacion_rut_aliado']) ? 'url_documentacion_rut_aliado' : (isset($_FILES['rut_file']) ? 'rut_file' : '');
            if (!empty($rut_field) && $_FILES[$rut_field]['error'] == 0) {
                $archivo                                           = $_FILES[$rut_field];
                $extension                                         = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                
                if (!in_array($extension, $permitidos)) { throw new Exception('Formato de archivo RUT no permitido'); }
                if ($archivo['size'] > 5 * 1024 * 1024) { throw new Exception('El archivo RUT excede el tamaño máximo de 5MB'); }
                $nombre_archivo                                       = 'rut_' . time() . '_' . uniqid() . '.' . $extension;
                $url_documentacion_cedula_aliado                                        = $upload_dir . $nombre_archivo;
                if (move_uploaded_file($archivo['tmp_name'], $url_documentacion_cedula_aliado)) {
                    $url_rut                                          = $url_documentacion_cedula_aliado;
                    $updates[]                                        = "url_documentacion_rut_aliado = '" . mysqli_real_escape_string($conectar, $url_rut) . "'";
                } else {
                    throw new Exception('Error al subir el archivo RUT');
                }
            }
            // Procesar Cámara de Comercio - soporta ambos nombres de campo
            $camara_field = isset($_FILES['url_documentacion_camaracomercio_aliado']) ? 'url_documentacion_camaracomercio_aliado' : (isset($_FILES['camara_file']) ? 'camara_file' : '');
            if (!empty($camara_field) && $_FILES[$camara_field]['error'] == 0) {
                $archivo                                            = $_FILES[$camara_field];
                $extension                                          = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                
                if (!in_array($extension, $permitidos)) { throw new Exception('Formato de archivo Cámara de Comercio no permitido'); }
                if ($archivo['size'] > 10 * 1024 * 1024) { throw new Exception('El archivo Cámara de Comercio excede el tamaño máximo de 5MB'); }
                $nombre_archivo                                       = 'camara_comercio_' . time() . '_' . uniqid() . '.' . $extension;
                $url_documentacion_cedula_aliado                                        = $upload_dir . $nombre_archivo;
                if (move_uploaded_file($archivo['tmp_name'], $url_documentacion_cedula_aliado)) {
                    $url_camara                                       = $url_documentacion_cedula_aliado;
                    $updates[]                                        = "url_documentacion_camaracomercio_aliado = '" . mysqli_real_escape_string($conectar, $url_camara) . "'";
                } else {
                    throw new Exception('Error al subir el archivo Cámara de Comercio');
                }
            }
            // Procesar Cédula - soporta ambos nombres de campo
            $cedula_field = isset($_FILES['url_documentacion_cedula_aliado']) ? 'url_documentacion_cedula_aliado' : (isset($_FILES['cedula_file']) ? 'cedula_file' : '');
            if (!empty($cedula_field) && $_FILES[$cedula_field]['error'] == 0) {
                $archivo                                           = $_FILES[$cedula_field];
                $extension                                         = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                if (!in_array($extension, $permitidos)) { throw new Exception('Formato de archivo Cédula no permitido'); }
                if ($archivo['size'] > 5 * 1024 * 1024) { throw new Exception('El archivo Cédula excede el tamaño máximo de 5MB'); }
                $nombre_archivo                                    = 'cedula_' . time() . '_' . uniqid() . '.' . $extension;
                $url_documentacion_cedula_aliado                   = $upload_dir . $nombre_archivo;
                if (move_uploaded_file($archivo['tmp_name'], $url_documentacion_cedula_aliado)) {
                    $url_cedula                                       = $url_documentacion_cedula_aliado;
                    $updates[]                                        = "url_documentacion_cedula_aliado = '" . mysqli_real_escape_string($conectar, $url_cedula) . "'";
                } else {
                    throw new Exception('Error al subir el archivo Cédula');
                }
            }
            
            if (count($updates) > 0) {
                $sql_update = "UPDATE tbl15_administrador SET cod_estado_documentacion = '$cod_estado_documentacion', fecha_documentacion = '$fecha_documentacion', ".implode(', ', $updates)." WHERE cod_administrador = '$cod_administrador'";
                if (mysqli_query($conectar, $sql_update)) {
                    $response['success'] = true;
                    $response['mensaje'] = 'Documentos guardados correctamente';
                } else {
                    throw new Exception('Error al actualizar los documentos: ' . mysqli_error($conectar));
                }
            } else {
                $response['success'] = true;
                $response['mensaje'] = 'No se seleccionaron documentos para actualizar';
            }
            break;
        
        case 'agregar_cuenta':
            // Validar campos requeridos (nuevo formato del formulario público)
            $nombre_banco_cuenta                              = isset($_POST['nombre_banco_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_banco_cuenta'])) : '';
            $numero_banco_cuenta                              = isset($_POST['numero_banco_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['numero_banco_cuenta'])) : '';
            $cod_tipo_cuenta_banco                            = isset($_POST['cod_tipo_cuenta_banco']) ? intval($_POST['cod_tipo_cuenta_banco']) : 1;
            $nombre_titular_cuenta                            = isset($_POST['nombre_titular_cuenta']) ? mysqli_real_escape_string($conectar, trim($_POST['nombre_titular_cuenta'])) : '';
            // Determinar nombre del tipo de cuenta
            $nombre_tipo_cuenta                               = '';
            if ($cod_tipo_cuenta_banco == 1) { $nombre_tipo_cuenta = 'Ahorros'; } elseif ($cod_tipo_cuenta_banco == 2) { $nombre_tipo_cuenta = 'Corriente'; }
            if (empty($nombre_banco_cuenta) || empty($numero_banco_cuenta)) { throw new Exception('El banco y el número de cuenta son requeridos'); }
            // Verificar si ya existe esta cuenta
            $sql_verificar = "SELECT cod_banco_cuenta FROM tbl15_banco_cuenta WHERE cod_aliado_estrategico = '$cod_administrador' AND numero_banco_cuenta = '$numero_banco_cuenta' AND cod_estado = '1'";
            $res_verificar = mysqli_query($conectar, $sql_verificar);
            if ($res_verificar && mysqli_num_rows($res_verificar) > 0) { throw new Exception('Esta cuenta ya está registrada'); }
            
            // Insertar cuenta bancaria
            $fecha_actual = date('Y-m-d H:i:s');
            $sql_insert = "INSERT INTO tbl15_banco_cuenta (cod_aliado_estrategico, nombre_banco_cuenta, numero_banco_cuenta, 
            cod_tipo_cuenta_banco, nombre_tipo_cuenta_banco,  nombre_titular_cuenta, cod_estado, fecha_creacion) 
            VALUES ('$cod_administrador', '$nombre_banco_cuenta', '$numero_banco_cuenta', 
            '$cod_tipo_cuenta_banco', '$nombre_tipo_cuenta', '$nombre_titular_cuenta', '1', '$fecha_actual')";
            if (mysqli_query($conectar, $sql_insert)) { $response['success'] = true; $response['mensaje'] = 'Cuenta bancaria agregada correctamente'; $response['cod_banco_cuenta'] = mysqli_insert_id($conectar); } else { throw new Exception('Error al agregar la cuenta bancaria: ' . mysqli_error($conectar)); }
            break;
            
        case 'agregar_banco':
            // Validar campos requeridos
            $cod_banco                                        = isset($_POST['cod_banco']) ? mysqli_real_escape_string($conectar, $_POST['cod_banco']) : '';
            $numero_banco_cuenta                              = isset($_POST['numero_banco_cuenta']) ? mysqli_real_escape_string($conectar, $_POST['numero_banco_cuenta']) : '';
            $cod_tipo_cuenta_banco                            = isset($_POST['cod_tipo_cuenta_banco']) ? mysqli_real_escape_string($conectar, $_POST['cod_tipo_cuenta_banco']) : '1';
            $cod_estado                                       = isset($_POST['cod_estado']) ? mysqli_real_escape_string($conectar, $_POST['cod_estado']) : '1';
            $nombre_titular_cuenta                            = isset($_POST['nombre_titular_cuenta']) ? mysqli_real_escape_string($conectar, $_POST['nombre_titular_cuenta']) : '';
            $identificacion_titular_cuenta                    = isset($_POST['identificacion_titular_cuenta']) ? mysqli_real_escape_string($conectar, $_POST['identificacion_titular_cuenta']) : '';
            if (empty($cod_banco) || empty($numero_banco_cuenta)) { throw new Exception('El banco y el número de cuenta son requeridos'); }
            // Obtener nombre del banco
            $sql_banco = "SELECT nombre_banco FROM tbl15_banco WHERE cod_banco = '$cod_banco'";
            $res_banco = mysqli_query($conectar, $sql_banco);
            $banco = mysqli_fetch_assoc($res_banco);

            $nombre_banco_cuenta                              = $banco ? $banco['nombre_banco'] : '';
            // Procesar certificado bancario si existe
            $url_certificado = '';
            if (isset($_FILES['certificado_banco']) && $_FILES['certificado_banco']['error'] == 0) {
                $archivo                                      = $_FILES['certificado_banco'];
                $extension                                    = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                $permitidos                                   = ['pdf'];
                if (!in_array($extension, $permitidos)) { throw new Exception('Formato de certificado no permitido'); }
                if ($archivo['size'] > 5 * 1024 * 1024) { throw new Exception('El certificado excede el tamaño máximo de 5MB'); }
                $nombre_archivo                               = 'certificado_banco_' . time() . '_' . uniqid() . '.' . $extension;
                $url_documentacion_cedula_aliado                                = $upload_dir . $nombre_archivo;
                if (move_uploaded_file($archivo['tmp_name'], $url_documentacion_cedula_aliado)) { $url_certificado = $url_documentacion_cedula_aliado; } else { throw new Exception('Error al subir el certificado bancario'); }
            }
            // Insertar cuenta bancaria
            $sql_insert = "INSERT INTO tbl15_banco_cuenta (cod_administrador, cod_banco, nombre_banco_cuenta, numero_banco_cuenta, cod_tipo_cuenta_banco, 
            cod_estado, nombre_titular_cuenta, identificacion_titular_cuenta, url_certificado_banco_cuenta, fecha_registro) 
            VALUES ('$cod_administrador', '$cod_banco', '$nombre_banco_cuenta', '$numero_banco_cuenta', '$cod_tipo_cuenta_banco',
            '$cod_estado', '$nombre_titular_cuenta', '$identificacion_titular_cuenta', '$url_certificado', NOW())";
            if (mysqli_query($conectar, $sql_insert)) {
                $response['success'] = true;
                $response['mensaje'] = 'Cuenta bancaria agregada correctamente';
                $response['cod_banco_cuenta'] = mysqli_insert_id($conectar);
            } else {
                throw new Exception('Error al agregar la cuenta bancaria: ' . mysqli_error($conectar));
            }
            break;
        default:
            throw new Exception('Acción no válida');
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['mensaje'] = $e->getMessage();
}
echo json_encode($response);
