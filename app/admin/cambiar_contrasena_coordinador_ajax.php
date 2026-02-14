<?php
session_start();
include_once('../conexiones/conexione.php');

$response = array('success' => false, 'message' => '');

if (!isset($_SESSION['cod_administrador'])) { $response['message'] = 'Sesión no iniciada'; echo json_encode($response); exit; }

$cod_administrador = $_SESSION['cod_administrador'];
$current_password = isset($_POST['current_password']) ? mysqli_real_escape_string($conectar, $_POST['current_password']) : '';
$new_password = isset($_POST['new_password']) ? mysqli_real_escape_string($conectar, $_POST['new_password']) : '';

if (empty($current_password) || empty($new_password)) { $response['message'] = 'Por favor complete todos los campos'; echo json_encode($response); exit; }
// Verificar la contraseña actual
// Nota: Observando el archivo cambiar_contrasena.php original, parece que se usa SHA1 desde el cliente (JS).
// Sin embargo, para seguridad robusta, idealmente verificaríamos el hash almacenado.
// Aquí asumiré que el sistema espera un SHA1 también o la contraseña tal cual si no se hashea al recibir.
// IMPORTANTE: Dado el archivo original usa sha1.js en el cliente, es probable que la base de datos guarde el hash SHA1.
// Comprobaremos si la contraseña actual (que debería llegar hasheada desde el cliente o plana) coincide.
// Para este ejemplo, haré la verificación segura asumiendo que el cliente envía el texto plano y nosotros comparamos con lo que hay en BD.

// 1. Obtener contraseña actual de la BD
$sql = "SELECT contrasena FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
$res = mysqli_query($conectar, $sql);
$row = mysqli_fetch_assoc($res);

if (!$row) { $response['message'] = 'Usuario no encontrado'; echo json_encode($response); exit; }
// IMPORTANTE: Adaptar según cómo se guardan las contraseñas en tu sistema.
// Si el sistema original usa SHA1 desde JS, la BD tiene SHA1.
// Si envía texto plano desde aquí, debemos cifrarlo igual.
// En cambiar_contrasena.php vi: input_pass.value = sha1(input_pass.value); antes de enviar.
// Así que la BD tiene SHA1. 
// Como este es un endpoint AJAX nuevo, recibiré la contraseña "plana" del usuario y la cifraré aquí ó
// el cliente JS la cifrará. Para consistencia, dejaré que el cliente envíe texto y yo lo cifro aquí con SHA1 para validar.
// Si tu sistema usa otro método (password_verify), ajusta esto.
$current_pass_hash = sha1($current_password); // Asumiendo SHA1 por el archivo legacy visto.
if ($current_pass_hash !== $row['contrasena']) { $response['message'] = 'La contraseña actual es incorrecta'; echo json_encode($response); exit; }
// Actualizar contraseña
$new_pass_hash = sha1($new_password);
$sql_update = "UPDATE tbl15_administrador SET contrasena = '$new_pass_hash' WHERE cod_administrador = '$cod_administrador'";

if (mysqli_query($conectar, $sql_update)) {
    $response['success'] = true;
    $response['message'] = 'Contraseña actualizada correctamente';
} else {
    $response['message'] = 'Error al actualizar: ' . mysqli_error($conectar);
}

echo json_encode($response);
?>
