<?php
session_start();
include_once('../conexiones/conexione.php');

if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['status' => 'error', 'msg' => 'Sesión expirada']); exit(); }
$cod_administrador = $_SESSION['cod_administrador'];
$cedula = mysqli_real_escape_string($conectar, $_POST['cedula']);
$nombres = mysqli_real_escape_string($conectar, $_POST['nombres']);
$apellidos = mysqli_real_escape_string($conectar, $_POST['apellidos']);
$correo = mysqli_real_escape_string($conectar, $_POST['correo']);
$clave = $_POST['clave'];
$clave_hash = sha1(strip_tags(stripslashes($clave)));

$sql_check = "SELECT cod_administrador FROM tbl15_administrador WHERE cedula = '$cedula' OR cuenta = '$correo' OR correo = '$correo'";
$res_check = mysqli_query($conectar, $sql_check);
if (mysqli_num_rows($res_check) > 0) { echo json_encode(['status' => 'error', 'msg' => 'El usuario, cédula o correo ya existe.']); exit(); }

$sql_insert = "INSERT INTO tbl15_administrador (cuenta, contrasena, cod_seguridad, nombres, apellidos, cedula, correo, cod_estado, cod_administrador_autor, cod_aliado_estrategico) 
VALUES ('$correo', '$clave_hash', '29', '$nombres', '$apellidos', '$cedula', '$correo', '1', '$cod_administrador', '$cod_administrador')";
if (mysqli_query($conectar, $sql_insert)) { echo json_encode(['status' => 'success', 'msg' => 'Promotora registrada exitosamente']); } else { echo json_encode(['status' => 'error', 'msg' => 'Error al registrar: ' . mysqli_error($conectar)]); }
?>
