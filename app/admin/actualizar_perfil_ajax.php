<?php
error_reporting(E_ALL ^ E_NOTICE);
header('Content-Type: application/json');

include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include_once("../session/funciones_admin_visitante_intern.php");

$response = array('success' => false, 'message' => '');

// Verificar que se reciban los datos necesarios
if (!isset($_POST['cod_administrador']) || empty($_POST['cod_administrador'])) { $response['message'] = 'Error: No se recibió el ID del usuario'; echo json_encode($response); exit; }
if (!isset($_POST['seccion']) || empty($_POST['seccion'])) { $response['message'] = 'Error: No se especificó la sección a actualizar'; echo json_encode($response); exit; }
$cod_administrador                                              = mysqli_real_escape_string($conectar, $_POST['cod_administrador']);
$seccion                                                        = mysqli_real_escape_string($conectar, $_POST['seccion']);
$campos_actualizar                                              = array(); // Construir la consulta según la sección

switch ($seccion) {
    case 'info_personal':
        $cedula                                                         = isset($_POST['cedula']) ? mysqli_real_escape_string($conectar, trim($_POST['cedula'])) : '';
        $nombres                                                        = isset($_POST['nombres']) ? mysqli_real_escape_string($conectar, strtoupper(trim($_POST['nombres']))) : '';
        $apellidos                                                      = isset($_POST['apellidos']) ? mysqli_real_escape_string($conectar, strtoupper(trim($_POST['apellidos']))) : '';
        $fecha_nac_tercero                                              = isset($_POST['fecha_nac_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['fecha_nac_tercero'])) : '';
        $nombre_sexo                                                    = isset($_POST['nombre_sexo']) ? mysqli_real_escape_string($conectar, strtoupper(trim($_POST['nombre_sexo']))) : '';
        $campos_actualizar                                              = array();
        $campos_actualizar[]                                            = "cedula = '$cedula'";
        $campos_actualizar[]                                            = "nombres = '$nombres'";
        $campos_actualizar[]                                            = "apellidos = '$apellidos'";
        $campos_actualizar[]                                            = "nombre_sexo = '$nombre_sexo'";
        $campos_actualizar[]                                            = "nombre1_tercero = '$nombres'";
        $campos_actualizar[]                                            = "apellido1_tercero = '$apellidos'";
        $campos_actualizar[]                                            = "identificacion_tercero = '$cedula'";
        $campos_actualizar[]                                            = "nombres_apellidos_tercero = '$nombres $apellidos'";
        if (!empty($fecha_nac_tercero)) { $campos_actualizar[] = "fecha_nac_tercero = '$fecha_nac_tercero'"; }
        break;
        
    case 'contacto':
        $correo                                                         = isset($_POST['correo']) ? mysqli_real_escape_string($conectar, strtolower(trim($_POST['correo']))) : '';
        $telefono                                                       = isset($_POST['telefono']) ? mysqli_real_escape_string($conectar, trim($_POST['telefono'])) : '';
        $celular                                                        = isset($_POST['celular']) ? mysqli_real_escape_string($conectar, trim($_POST['celular'])) : '';
        $campos_actualizar[]                                            = "correo = '$correo'";
        $campos_actualizar[]                                            = "telefono = '$telefono'";
        break;
        
    case 'ubicacion':
        $direccion_tercero                                              = isset($_POST['direccion_tercero']) ? mysqli_real_escape_string($conectar, trim($_POST['direccion_tercero'])) : '';
        $ciudad                                                         = isset($_POST['ciudad']) ? mysqli_real_escape_string($conectar, strtoupper(trim($_POST['ciudad']))) : '';
        $departamento                                                   = isset($_POST['departamento']) ? mysqli_real_escape_string($conectar, strtoupper(trim($_POST['departamento']))) : '';
        $campos_actualizar[]                                            = "direccion_tercero = '$direccion_tercero'";
        $campos_actualizar[]                                            = "ciudad = '$ciudad'";
        $campos_actualizar[]                                            = "departamento = '$departamento'";
        break;

    case 'documentacion':
        $upload_dir = '../archivador/documentacion_aliados/' . $cod_administrador . '/';
        if (!file_exists($upload_dir)) { mkdir($upload_dir, 0777, true); }
        $permitidos = array('jpg', 'jpeg', 'png', 'pdf');
        
        $files_to_process = ['url_documentacion_cedula_aliado' => 'cedula', 'url_documentacion_rut_aliado' => 'rut', 'url_documentacion_camaracomercio_aliado' => 'camara_comercio'];

        foreach ($files_to_process as $field => $prefix) {
            if (isset($_FILES[$field]) && $_FILES[$field]['error'] == 0) {
                $archivo = $_FILES[$field];
                $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
                if (in_array($extension, $permitidos)) {
                    $nombre_archivo = $prefix . '_' . time() . '_' . uniqid() . '.' . $extension;
                    $url_destino = $upload_dir . $nombre_archivo;
                    if (move_uploaded_file($archivo['tmp_name'], $url_destino)) { $campos_actualizar[] = "$field = '" . mysqli_real_escape_string($conectar, $url_destino) . "'"; }
                }
            }
        }

        if (!empty($campos_actualizar)) {
            $campos_actualizar[] = "cod_estado_documentacion = '1'";
            $campos_actualizar[] = "fecha_documentacion = '" . date('Y-m-d H:i:s') . "'";
            
            // --- NOTIFICACIÓN AL ASESOR SI ES USUARIO DE PRUEBA ---
            $sql_check_prueba = "SELECT cod_estado_usuario_prueba, cod_asesor, nombres_apellidos_tercero FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
            $res_check_prueba = mysqli_query($conectar, $sql_check_prueba);
            $data_prueba = mysqli_fetch_assoc($res_check_prueba);
            
            if ($data_prueba['cod_estado_usuario_prueba'] == '1') {
                $cod_asesor = $data_prueba['cod_asesor'];
                $nombre_aliado = $data_prueba['nombres_apellidos_tercero'];
                // Verificar si ya tiene todos los documentos cargados (después de esta actualización)
                // Para simplificar, si subió algo en esta vuelta, notificamos que hay actualizaciones.
                // En un sistema real, verificaríamos que cedula, rut y camara no estén vacíos.
                $titulo_notif = "Documentos cargados: $nombre_aliado";
                $mensaje_notif = "El aliado de prueba $nombre_aliado ha cargado nuevos documentos. Por favor revise su perfil para habilitarlo.";
                $fecha_notif_f = date('Y-m-d');
                $fecha_notif_h = date('Y-m-d H:i:s');
                
                // Insertar en tabla de notificaciones real
                $sql_notif = "INSERT INTO tbl15_notificacion_alerta_renovacion (cod_administrador, nombre_notificacion_alerta_renovacion, descipcion_notificacion_alerta_renovacion, cod_tipo_notificacion_alerta, cod_estado, cod_estado_aviso, fecha, fecha_creacion) 
                VALUES ('$cod_asesor', '$titulo_notif', '$mensaje_notif', '3', '0', '0', '$fecha_notif_f', '$fecha_notif_h')";
                mysqli_query($conectar, $sql_notif);
            }
        }
        break;
        
    default:
        $response['message']                                            = 'Error: Sección no válida';
        echo json_encode($response);
        exit;
}
// Construir y ejecutar la consulta
if (!empty($campos_actualizar)) {
    $sql_actualizar = "UPDATE tbl15_administrador SET ".implode(', ', $campos_actualizar)." WHERE cod_administrador = '$cod_administrador'";
    
    if (mysqli_query($conectar, $sql_actualizar)) {
        if (mysqli_affected_rows($conectar) >= 0) {
            $response['success'] = true;
            $response['message'] = 'Información actualizada correctamente';
        } else {
            $response['message'] = 'No se realizaron cambios';
        }
    } else {
        $response['message'] = 'Error al actualizar: ' . mysqli_error($conectar);
    }
} else {
    $response['message'] = 'Error: No hay campos para actualizar';
}
echo json_encode($response);
?>
