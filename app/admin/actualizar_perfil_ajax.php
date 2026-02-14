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
