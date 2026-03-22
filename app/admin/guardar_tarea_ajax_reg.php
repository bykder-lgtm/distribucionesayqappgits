<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
// Obtener quien lo esta creando
$sql_user = "SELECT cod_administrador FROM tbl15_administrador WHERE cuenta = '$cuenta_actual' AND cod_estado != '0'";
$res_user = mysqli_query($conectar, $sql_user);
$row_user = mysqli_fetch_assoc($res_user);
$cod_administrador_creador = $row_user['cod_administrador'];

$retorno_array = array();

if(isset($_POST['titulo'])) {
    
    $nombre_tarea                   = strtoupper(trim(addslashes($_POST['titulo'])));
    $descripcion_tarea              = isset($_POST['descripcion']) ? trim(addslashes($_POST['descripcion'])) : '';
    $nombre_tipo_tarea              = isset($_POST['tipo']) ? strtoupper(trim(addslashes($_POST['tipo']))) : 'TAREA';
    $nombre_prioridad_tarea         = isset($_POST['prioridad']) ? strtoupper(trim(addslashes($_POST['prioridad']))) : 'MEDIA';
    $nombre_tipo_asignacion_tarea   = isset($_POST['tipo_asignacion']) ? strtoupper(trim(addslashes($_POST['tipo_asignacion']))) : 'PROPIA';
    
    $criterios_aceptacion_tarea     = isset($_POST['criterios']) ? trim(addslashes($_POST['criterios'])) : '';
    $story_points_tarea             = isset($_POST['puntos']) ? intval($_POST['puntos']) : 0;
    
    $fecha_entrega_raw              = isset($_POST['fecha_entrega']) ? trim($_POST['fecha_entrega']) : '';
    if ($fecha_entrega_raw != '') {
        $fecha_entrega_tarea = date("Y-m-d H:i:s", strtotime($fecha_entrega_raw));
    } else {
        $fecha_entrega_tarea = date("Y-m-d 23:59:59", strtotime('+7 days')); // default a una semana
    }
    
    $fecha_finalizacion_tarea       = "0000-00-00 00:00:00";
    $orden_tarea                    = 0;
    
    // Obtener asignado segun tipo de asignacion
    if ($nombre_tipo_asignacion_tarea == 'EXTERNO' && isset($_POST['asignado']) && $_POST['asignado'] != '') {
        $cod_administrador_asignado = intval($_POST['asignado']);
    } else {
        $cod_administrador_asignado = $cod_administrador_creador;
        $nombre_tipo_asignacion_tarea = 'PROPIA'; // Forzar a propia si no se manda asignado
    }
    $nombre_estado_tarea            = 'POR HACER'; // Default al crear, se va a "Por Hacer"
    // Asignar codigos base / estandar
    $cod_estado_tarea               = 1;
    $cod_tipo_tarea                 = 1;
    $cod_prioridad_tarea            = 1;
    $fecha_creacion                 = date("Y-m-d H:i:s");
    $fecha_modificacion             = date("Y-m-d H:i:s");
    // Verificamos si existe el campo "cod_estado" en la base de datos
    $cod_estado_str = "";
    $val_estado_str = "";
    $check_col = mysqli_query($conectar, "SHOW COLUMNS FROM tbl15_tarea LIKE 'cod_estado'");
    if(mysqli_num_rows($check_col) > 0) { $cod_estado_str = ", cod_estado"; $val_estado_str = ", '1'"; }
    
    if($nombre_tarea != '') {
        
        $sql_insert = "INSERT INTO tbl15_tarea (nombre_tarea, descripcion_tarea, nombre_estado_tarea, nombre_tipo_tarea, nombre_prioridad_tarea, 
        nombre_tipo_asignacion_tarea, criterios_aceptacion_tarea, story_points_tarea, orden_tarea, fecha_entrega_tarea, fecha_finalizacion_tarea, cod_estado_tarea, cod_tipo_tarea, cod_prioridad_tarea, cod_administrador_asignado, cod_administrador_creador, 
        fecha_creacion, fecha_modificacion $cod_estado_str) 
        VALUES ('$nombre_tarea', '$descripcion_tarea', '$nombre_estado_tarea', '$nombre_tipo_tarea', '$nombre_prioridad_tarea', 
        '$nombre_tipo_asignacion_tarea', '$criterios_aceptacion_tarea', '$story_points_tarea', '$orden_tarea', '$fecha_entrega_tarea', '$fecha_finalizacion_tarea', '$cod_estado_tarea', '$cod_tipo_tarea', '$cod_prioridad_tarea', '$cod_administrador_asignado', '$cod_administrador_creador', 
        '$fecha_creacion', '$fecha_modificacion' $val_estado_str)";
        $resultado = mysqli_query($conectar, $sql_insert);
        
        if($resultado) {
            $retorno_array['afectado'] = 'SI';
            $retorno_array['mensaje']  = 'La tarea ha sido registrada exitosamente en Por Hacer.';
        } else {
            $retorno_array['afectado'] = 'NO';
            $retorno_array['mensaje']  = 'Error al procesar el guardado de la tarea.';
            $retorno_array['error_sql'] = mysqli_error($conectar);
        }
    } else {
        $retorno_array['afectado'] = 'NO';
        $retorno_array['mensaje']  = 'El titulo de la tarea es obligatorio.';
    }
} else {
    $retorno_array['afectado'] = 'NO';
    $retorno_array['mensaje']  = 'No se han recibido los datos esperados.';
}
header('Content-Type: application/json');
echo json_encode($retorno_array);
?>
