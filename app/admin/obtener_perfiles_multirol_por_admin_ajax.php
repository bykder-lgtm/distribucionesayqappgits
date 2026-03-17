<?php
include_once('../conexiones/conexione.php');
date_default_timezone_set("America/Bogota");
session_start();

$res = array('status' => 'error', 'message' => 'Solicitud no válida.', 'perfiles' => array());
header('Content-Type: application/json');

if (!isset($_POST['cod_administrador'])) { echo json_encode($res); exit; }

$cod_admin = intval($_POST['cod_administrador']);
// Ubicar al admin y saber si tiene un padre o es el padre
$sql_padre = "SELECT cod_administrador, cod_administrador_padre_multirol FROM tbl15_administrador WHERE cod_administrador = '$cod_admin'";
$q_padre = mysqli_query($conectar, $sql_padre);
if ($row_p = mysqli_fetch_assoc($q_padre)) {
    $padre = (!empty($row_p['cod_administrador_padre_multirol']) && $row_p['cod_administrador_padre_multirol'] != 0) ? $row_p['cod_administrador_padre_multirol'] : $cod_admin;

    // Traer todos los involucrados
    $sql_todos = "SELECT cod_administrador, nombre_tipo_tercero FROM tbl15_administrador 
    WHERE (cod_administrador = '$padre' OR cod_administrador_padre_multirol = '$padre') AND cod_estado = 1 ORDER BY cod_administrador ASC";
    $q_todos = mysqli_query($conectar, $sql_todos);
    
    while ($row = mysqli_fetch_assoc($q_todos)) {
        $res['perfiles'][] = array('cod_administrador' => $row['cod_administrador'], 'cargo' => str_replace('_', ' ', $row['nombre_tipo_tercero']));
    }
    $res['status'] = 'success';
    $res['message'] = 'OK';
} else {
    $res['message'] = 'Administrador no encontrado.';
}
echo json_encode($res);
?>
