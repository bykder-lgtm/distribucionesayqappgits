<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }
header('Content-Type: application/json');
// Consultar bancos activos
$sql = "SELECT cod_banco, nombre_banco FROM tbl15_banco WHERE cod_estado = '1' ORDER BY cod_posicion ASC, nombre_banco ASC";
$resultado = mysqli_query($conectar, $sql);
if($resultado) {
    $bancos = array();
    while($row = mysqli_fetch_assoc($resultado)) {
        $bancos[] = array('cod_banco' => $row['cod_banco'], 'nombre_banco' => $row['nombre_banco']);
    }
    echo json_encode(array('success' => true, 'bancos' => $bancos));
} else {
    echo json_encode(array('success' => false, 'mensaje' => 'Error al obtener los bancos: ' . mysqli_error($conectar)));
}
?>
