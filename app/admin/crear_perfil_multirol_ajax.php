<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); }

$cuenta_actual                                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                                                   = $_SESSION['usuario'];
$cod_administrador                                                  = ($_SESSION['cod_administrador']);

$res = array('status' => 'error', 'message' => 'Solicitud no válida.');
header('Content-Type: application/json');

if (!isset($_POST['cod_administrador_origen']) || !isset($_POST['cod_tipo_tercero_nuevo'])) { $res['message'] = 'Faltan datos requeridos.'; echo json_encode($res); exit; }

$cod_origen = intval($_POST['cod_administrador_origen']);
$cod_tipo_nuevo = intval($_POST['cod_tipo_tercero_nuevo']);
// Evitar si es admin super o creador
if ($cod_origen == 1 || $cod_origen == 2) { $res['message'] = 'No se puede modificar la cuenta principal del sistema.'; echo json_encode($res); exit; }
// Obtener datos del perfil origen a clonar
$sql_check = "SELECT * FROM tbl15_administrador WHERE cod_administrador = '$cod_origen'";
$query_check = mysqli_query($conectar, $sql_check);

if (!$row = mysqli_fetch_assoc($query_check)) { $res['message'] = 'Administrador origen no encontrado.'; echo json_encode($res); exit; }
// Determinar el Cod Padre
$cod_padre = (!empty($row['cod_administrador_padre_multirol']) && $row['cod_administrador_padre_multirol'] != 0) ? $row['cod_administrador_padre_multirol'] : $cod_origen;

// Validar que el rol nuevo no lo tenga ya asignado nadie en esta 'familia' multirol
$sql_existe = "SELECT cod_administrador FROM tbl15_administrador WHERE cod_tipo_tercero = '$cod_tipo_nuevo' AND (cod_administrador = '$cod_padre' OR cod_administrador_padre_multirol = '$cod_padre')";
$q_existe = mysqli_query($conectar, $sql_existe);
if (mysqli_num_rows($q_existe) > 0) { $res['message'] = 'Este usuario ya posee un perfil asociado a este cargo.'; echo json_encode($res); exit; }

// Configurar param según nuevo rol
$nombre_tipo_tercero_nuevo = '';
$url_dashboard = '';
$cod_seguridad = '';
$cod_tipo_tercero_bd = '0'; // La mayoría en distribucionesayq usa 0, excepto vendedor etc.

switch($cod_tipo_nuevo){
    case 7: // Lider
        $nombre_tipo_tercero_nuevo = 'LIDER';
        $cod_seguridad = '20';
        $cod_tipo_tercero_bd = '0';
        break;
    case 8: // Coordinador
        $nombre_tipo_tercero_nuevo = 'COORDINADOR';
        $cod_seguridad = '21';
        $cod_tipo_tercero_bd = '0';
        break;
    case 9: // Asesor
        $nombre_tipo_tercero_nuevo = 'ASESOR';
        $cod_seguridad = '22';
        $cod_tipo_tercero_bd = '0';
        break;
    case 10: // Vendedor
        $nombre_tipo_tercero_nuevo = 'VENDEDOR';
        $cod_seguridad = '2';
        $cod_tipo_tercero_bd = '2';
        break;
    case 13: // Aliado Estrategico
        $nombre_tipo_tercero_nuevo = 'ALIADO_ESTRATEGICO';
        $cod_seguridad = '23';
        $cod_tipo_tercero_bd = '0';
        break;
    default:
        $res['message'] = 'Tipo de rol no gestionado para multi-rol aún.';
        echo json_encode($res);
        exit;
}

// === VALIDACIÓN DE JERARQUÍA ESTRICTA ===
// Obtener el rol actual del usuario que está intentando crear el multi-rol (el logueado)
$sql_creador = "SELECT cod_seguridad FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$res_creador = mysqli_query($conectar, $sql_creador);
$row_creador = mysqli_fetch_assoc($res_creador);
$cod_seguridad_creador = $row_creador ? $row_creador['cod_seguridad'] : '99';

$roles_permitidos = array();

// Super Admin puede crear todos los pertinentes
if ($cod_seguridad_creador == '1') {
    $roles_permitidos = array('20', '21', '22', '23', '2'); // Lider, Coordinador, Asesor, Aliado, Vendedor
} 
// Lider (20) puede crear Coordinador (21), Asesor (22), Aliado (23)
else if ($cod_seguridad_creador == '20') {
    $roles_permitidos = array('21', '22', '23'); 
} 
// Coordinador (21) puede crear Asesor (22), Aliado (23)
else if ($cod_seguridad_creador == '21') {
    $roles_permitidos = array('22', '23');
} 
// Asesor (22) puede crear Aliado (23)
else if ($cod_seguridad_creador == '22') {
    $roles_permitidos = array('23');
}

if (!in_array($cod_seguridad, $roles_permitidos)) {
    $res['message'] = 'Acceso denegado. Por jerarquía, no tienes permisos para asignar este rol.';
    echo json_encode($res);
    exit;
}
// ===============================

// Obtener 'url_pag_redirec_ini_sesion' de forma dinámica desde tbl15_seguridad según la indicación
$sql_seg = "SELECT url_pag_redirec_ini_sesion FROM tbl15_seguridad WHERE cod_seguridad = '$cod_seguridad'";
$q_seg = mysqli_query($conectar, $sql_seg);
if ($row_seg = mysqli_fetch_assoc($q_seg)) { $url_pag_redirec_ini_sesion = $row_seg['url_pag_redirec_ini_sesion']; }
if(empty($url_pag_redirec_ini_sesion)){ 
    // Fallback de seguridad por si la BD está vacía en esa columna temporalmente
    if($cod_seguridad == '20') $url_pag_redirec_ini_sesion = '../admin/dashboard_lider_movil.php';
    if($cod_seguridad == '21') $url_pag_redirec_ini_sesion = '../admin/dashboard_coordinador_movil.php';
    if($cod_seguridad == '22') $url_pag_redirec_ini_sesion = '../admin/dashboard_asesor_movil.php';
    if($cod_seguridad == '2') $url_pag_redirec_ini_sesion = '../admin/dashboard_vendedor_movil.php';
}
// Preparar query de clonación - Asumimos la mayoría de los campos son copiados intactos
$cedula                                                             = $row['cedula'];
$nombres                                                            = $row['nombres'];
$apellidos                                                          = $row['apellidos'];
$nombres_apellidos                                                  = $row['nombres_apellidos_tercero'];
$correo                                                             = $row['correo'];
$telefono                                                           = $row['telefono'];
$contrasena                                                         = $row['contrasena'];
$fecha_cre                                                          = date("Y-m-d H:i:s");
//$cod_administrador_padre_multirol = isset($_SESSION['cod_administrador']) ? $_SESSION['cod_administrador'] : 0;
$estado                                                             = '1';
$estado_act                                                         = '1';
// Lider, Coord, Asesor original (Si es vendedor conserva sus ancestros de control)
$cod_lider                                                         = $row['cod_lider'];
$cod_coord                                                         = $row['cod_coordinador'];
$cod_asesor                                                        = $row['cod_asesor'];

$sql_autoincremento_administrador = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_administrador'";
$exec_autoincremento_administrador = mysqli_query($conectar, $sql_autoincremento_administrador) or die(mysqli_error($conectar));
$datos_autoincremento_administrador = mysqli_fetch_assoc($exec_autoincremento_administrador);

$cod_administrador                                                = $datos_autoincremento_administrador['AUTO_INCREMENT'];
$cuenta                                                           = $cedula.'-'.$cod_administrador;
$creador                                                          = $cuenta_actual;
$nombre_tipo_identificacion                                       = $row['nombre_tipo_identificacion'];
$identificacion_tercero                                           = $row['identificacion_tercero'];
$digito_tercero                                                   = $row['digito_tercero'];
$nombre1_tercero                                                  = $row['nombre1_tercero'];
$nombre2_tercero                                                  = $row['nombre2_tercero'];
$apellido1_tercero                                                = $row['apellido1_tercero'];
$apellido2_tercero                                                = $row['apellido2_tercero'];
$direccion_tercero                                                = $row['direccion_tercero'];
$telefono1_tercero                                                = $row['telefono1_tercero'];
$correo_tercero                                                   = $row['correo_tercero'];
$barrio_tercero                                                   = $row['barrio_tercero'];
$nombre_tipo_cliente                                              = $row['nombre_tipo_cliente'];
$nombre_tipo_regimen                                              = $row['nombre_tipo_regimen'];
$nombre_tipo_impuesto                                             = $row['nombre_tipo_impuesto'];

// Insertar Nuevo Perfil Enlazado
$sql_insert = "INSERT INTO tbl15_administrador (cedula, nombres, apellidos, nombres_apellidos_tercero, cuenta, correo, telefono, contrasena, 
cod_tipo_tercero, nombre_tipo_tercero, url_pag_redirec_ini_sesion, cod_seguridad, 
cod_estado_multirol, cod_administrador_padre_multirol, cod_lider, cod_coordinador, cod_asesor, cod_estado, cod_estado_activacion_usuario, fecha_creacion, 
nombre_tipo_identificacion, identificacion_tercero, digito_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, 
direccion_tercero, telefono1_tercero, correo_tercero, barrio_tercero, nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto, creador) 
VALUES ('$cedula', '$nombres', '$apellidos', '$nombres_apellidos', '$cuenta', '$correo', '$telefono', '$contrasena',
'$cod_tipo_tercero_bd', '$nombre_tipo_tercero_nuevo', '$url_pag_redirec_ini_sesion', '$cod_seguridad',
'1', '$cod_padre', '$cod_lider', '$cod_coord', '$cod_asesor', '$estado', '$estado_act', '$fecha_cre', 
'$nombre_tipo_identificacion', '$identificacion_tercero', '$digito_tercero', '$nombre1_tercero', '$nombre2_tercero', '$apellido1_tercero', '$apellido2_tercero', 
'$direccion_tercero', '$telefono1_tercero', '$correo_tercero', '$barrio_tercero', '$nombre_tipo_cliente', '$nombre_tipo_regimen', '$nombre_tipo_impuesto', '$creador')";

if (mysqli_query($conectar, $sql_insert)) {
    // Éxito al insertar. Debemos asegurarnos que el padre y el origen original tengan encendida su bandera Mutirol
    $sql_upd = "UPDATE tbl15_administrador SET cod_estado_multirol = '1' WHERE cod_administrador = '$cod_origen' OR cod_administrador = '$cod_padre'";
    mysqli_query($conectar, $sql_upd);

    $res['status'] = 'success';
    $res['message'] = 'El perfil secundario ('.$nombre_tipo_tercero_nuevo.') fue enlazado correctamente al usuario.';
} else {
    $res['message'] = 'Error al clonar el perfil: ' . mysqli_error($conectar);
}

echo json_encode($res);
?>
