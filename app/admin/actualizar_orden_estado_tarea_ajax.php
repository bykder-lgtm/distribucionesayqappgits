<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

$retorno = array('afectado' => 'NO');
// Se asume que recibe "orden" que es un array de IDs en orden, 
// o un id_tarea y un nuevo estado
if(isset($_POST['estado']) && isset($_POST['orden'])) {
    
    $nuevo_estado = addslashes($_POST['estado']);
    $orden_array = $_POST['orden']; 
    $fecha = date("Y-m-d H:i:s");
    
    if(is_array($orden_array)) {
        foreach($orden_array as $index => $cod_tarea) {
            $cod = intval($cod_tarea);
            if($cod > 0) {
                 // Verificar si el estado anterior no era TERMINADO para registrar la fecha finalizacion si entra a TERMINADO
                 $sql_check = "SELECT nombre_estado_tarea FROM tbl15_tarea WHERE cod_tarea = '$cod'";
                 $res_check = mysqli_query($conectar, $sql_check);
                 $row_check = mysqli_fetch_assoc($res_check);
                 
                 $query_extra = "";
                 if ($row_check['nombre_estado_tarea'] != 'TERMINADO' && $nuevo_estado == 'TERMINADO') { $query_extra = ", fecha_finalizacion_tarea = '$fecha'"; }
                 
                 $sql_up = "UPDATE tbl15_tarea SET nombre_estado_tarea = '$nuevo_estado', orden_tarea = '$index', fecha_modificacion = '$fecha' $query_extra WHERE cod_tarea = '$cod'";
                 mysqli_query($conectar, $sql_up);
            }
        }
        $retorno['afectado'] = 'SI';
    }
}
echo json_encode($retorno);
?>
