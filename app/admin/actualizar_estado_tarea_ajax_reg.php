<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

$retorno_array = array();

if(isset($_POST['cod_tarea']) && isset($_POST['nuevo_estado'])) {
    
    $cod_tarea          = intval($_POST['cod_tarea']);
    $nuevo_estado       = strtoupper(trim(addslashes($_POST['nuevo_estado'])));
    $fecha_modificacion = date("Y-m-d H:i:s");
    
    if($cod_tarea > 0 && $nuevo_estado != '') {
        
        $sql_update = "UPDATE tbl15_tarea SET nombre_estado_tarea = '$nuevo_estado', fecha_modificacion = '$fecha_modificacion' WHERE cod_tarea = '$cod_tarea'";

        $resultado = mysqli_query($conectar, $sql_update);
        
        if($resultado) {
            $retorno_array['afectado'] = 'SI';
            $retorno_array['mensaje']  = 'El estado de la tarea ha sido actualizado correctamente.';
        } else {
            $retorno_array['afectado'] = 'NO';
            $retorno_array['mensaje']  = 'Error al procesar la actualización del estado.';
            $retorno_array['error_sql'] = mysqli_error($conectar);
        }
    } else {
        $retorno_array['afectado'] = 'NO';
        $retorno_array['mensaje']  = 'Datos insuficientes o erróneos para actualizar la tarea.';
    }
} else {
    $retorno_array['afectado'] = 'NO';
    $retorno_array['mensaje']  = 'No se han recibido los datos esperados.';
}
header('Content-Type: application/json');
echo json_encode($retorno_array);
?>
