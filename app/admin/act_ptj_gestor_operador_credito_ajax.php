<?php
/* ============================================================
   act_ptj_gestor_operador_credito_ajax.php
   Actualiza el campo ptj_gestor_operador_credito de la tabla
   tbl15_gestor_operador_credito.
   Solo accesible para el rol lider (cod_seguridad 20).
   ============================================================ */
session_start();
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
header('Content-Type: application/json; charset=utf-8');

// Verificar sesión activa del lider
if (!isset($_SESSION['cod_administrador']) || $_SESSION['cod_administrador'] == null) { echo json_encode(['success' => false, 'message' => 'Sesión no válida.']); exit(); }

$cod_administrador = $_SESSION['cod_administrador'];
// Verificar rol lider (cod_seguridad 20)
$sql_rol = "SELECT cod_seguridad FROM tbl15_administrador WHERE cod_administrador = '" . (int)$cod_administrador . "' AND cod_estado != '0'";
$res_rol = mysqli_query($conectar, $sql_rol) or die(mysqli_error($conectar));
$datos_rol = mysqli_fetch_assoc($res_rol);

if (!$datos_rol || ($datos_rol['cod_seguridad'] != '20' && $datos_rol['cod_seguridad'] != '1')) { echo json_encode(['success' => false, 'message' => 'Sin permisos suficientes.']); exit(); }
// Validar datos recibidos por POST
if (!isset($_POST['cod_gestor_operador_credito']) || !isset($_POST['ptj_gestor_operador_credito'])) { echo json_encode(['success' => false, 'message' => 'Datos incompletos.']); exit(); }

$cod_gestor = (int)$_POST['cod_gestor_operador_credito'];
$ptj        = (int)$_POST['ptj_gestor_operador_credito'];
// Validar rango del porcentaje
if ($ptj < 0 || $ptj > 99) { echo json_encode(['success' => false, 'message' => 'El porcentaje debe estar entre 0 y 99.']); exit(); }
// Verificar que el registro exista
$sql_check = "SELECT cod_gestor_operador_credito FROM tbl15_gestor_operador_credito WHERE cod_gestor_operador_credito = '$cod_gestor'";
$res_check = mysqli_query($conectar, $sql_check) or die(mysqli_error($conectar));
if (mysqli_num_rows($res_check) === 0) { echo json_encode(['success' => false, 'message' => 'El gestor operador de crédito no existe.']); exit(); }
// Actualizar el porcentaje
$sql_update = "UPDATE tbl15_gestor_operador_credito SET ptj_gestor_operador_credito = '$ptj' WHERE cod_gestor_operador_credito = '$cod_gestor'";
$resultado = mysqli_query($conectar, $sql_update);
if ($resultado && mysqli_affected_rows($conectar) >= 0) { echo json_encode(['success' => true, 'message' => 'Porcentaje actualizado correctamente.']); } else { echo json_encode(['success' => false, 'message' => 'Error al actualizar en la base de datos: ' . mysqli_error($conectar)]); }
exit();
?>
