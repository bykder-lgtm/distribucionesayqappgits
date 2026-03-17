<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
date_default_timezone_set("America/Bogota");
session_start();

$res = array('status' => 'error', 'message' => 'Solicitud no válida.', 'perfil_actual' => null, 'otros_perfiles' => array());
header('Content-Type: application/json');

if (!isset($_SESSION['cod_estado_multirol']) || $_SESSION['cod_estado_multirol'] != '1') { $res['message'] = 'Acceso denegado o sesión inválida.'; echo json_encode($res); exit; }
$cod_admin_actual = $_SESSION['cod_administrador'];
$cod_admin_padre = $_SESSION['cod_administrador_padre_multirol'];
// Si por alguna razón el padre es 0 o vacío, asumiremos que él mismo es el padre de sus clones
if (empty($cod_admin_padre) || $cod_admin_padre == '0') { $cod_admin_padre = $cod_admin_actual; }
// Obtener detalles del perfil actual para mostrarlo primero
$sql_actual = "SELECT cod_administrador, nombre_tipo_tercero, url_pag_redirec_ini_sesion 
               FROM tbl15_administrador WHERE cod_administrador = '$cod_admin_actual' LIMIT 1";
$query_actual = mysqli_query($conectar, $sql_actual);
if ($row_actual = mysqli_fetch_assoc($query_actual)) {
    // Limpiar el '_' para mejor visualizacion, ej: ALIADO_ESTRATEGICO a ALIADO ESTRATEGICO
    $cargo = str_replace('_', ' ', $row_actual['nombre_tipo_tercero']);
    $res['perfil_actual'] = array('cod_administrador' => $row_actual['cod_administrador'], 'nombre_tipo_tercero' => $row_actual['nombre_tipo_tercero'], 'cargo' => $cargo, 'url' => $row_actual['url_pag_redirec_ini_sesion']);
}
// Obtener los otros perfiles (hermanos y el padre, excluyendo el actual)
$sql_otros = "SELECT cod_administrador, nombre_tipo_tercero, url_pag_redirec_ini_sesion FROM tbl15_administrador 
WHERE (cod_administrador = '$cod_admin_padre' OR cod_administrador_padre_multirol = '$cod_admin_padre') AND cod_administrador != '$cod_admin_actual' AND cod_estado = 1";
$query_otros = mysqli_query($conectar, $sql_otros);

while ($row = mysqli_fetch_assoc($query_otros)) {
    $cargo2 = str_replace('_', ' ', $row['nombre_tipo_tercero']);
    $res['otros_perfiles'][] = array('cod_administrador' => $row['cod_administrador'], 'nombre_tipo_tercero' => $row['nombre_tipo_tercero'], 'cargo' => $cargo2, 'url' => $row['url_pag_redirec_ini_sesion']);
}
$res['status'] = 'success';
$res['message'] = 'Perfiles recuperados con éxito.';
echo json_encode($res);
?>
