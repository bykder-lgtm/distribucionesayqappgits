<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

$cod_tarea = isset($_POST['cod_tarea']) ? intval($_POST['cod_tarea']) : 0;
$retorno = array('encontrado' => 'NO');

$sql = "SELECT t.*, a.nombres_apellidos_tercero AS asignado, c.nombres_apellidos_tercero AS creador 
FROM tbl15_tarea t LEFT JOIN tbl15_administrador a ON t.cod_administrador_asignado = a.cod_administrador 
LEFT JOIN tbl15_administrador c ON t.cod_administrador_creador = c.cod_administrador WHERE t.cod_tarea = '$cod_tarea'";
$res = mysqli_query($conectar, $sql);
if($res && mysqli_num_rows($res) > 0) {
    $tarea = mysqli_fetch_assoc($res);
    $retorno['encontrado'] = 'SI';
    $retorno['tarea'] = $tarea;
    // Get comments
    $sql_com = "SELECT tc.*, adm.nombres_apellidos_tercero as autor FROM tbl15_tarea_comentario tc 
    LEFT JOIN tbl15_administrador adm ON tc.cod_administrador = adm.cod_administrador 
    WHERE tc.cod_tarea = '$cod_tarea' AND tc.cod_estado = 1 ORDER BY tc.fecha_creacion ASC";
    $res_com = mysqli_query($conectar, $sql_com);
    $comentarios = array();
    if($res_com) {
        while($row = mysqli_fetch_assoc($res_com)) { $comentarios[] = $row; }
    }
    $retorno['comentarios'] = $comentarios;
}
echo json_encode($retorno);
?>
