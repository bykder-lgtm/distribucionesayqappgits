<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

$cuenta_actual = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$sql_user = "SELECT cod_administrador FROM tbl15_administrador WHERE cuenta = '$cuenta_actual'";
$res_user = mysqli_query($conectar, $sql_user);
$row_user = mysqli_fetch_assoc($res_user);
$cod_admin = $row_user['cod_administrador'];

$retorno = array('afectado' => 'NO');
$cod_tarea = isset($_POST['cod_tarea']) ? intval($_POST['cod_tarea']) : 0;
$comentario = isset($_POST['comentario']) ? trim(addslashes($_POST['comentario'])) : '';
$fecha = date("Y-m-d H:i:s");

$ruta_archivo_adjunto = '';

if ($cod_tarea > 0 && $comentario != '') {
    $sql = "INSERT INTO tbl15_tarea_comentario (cod_tarea, cod_administrador, comentario_texto, ruta_archivo_adjunto, cod_estado, fecha_creacion)
            VALUES ('$cod_tarea', '$cod_admin', '$comentario', '$ruta_archivo_adjunto', 1, '$fecha')";
    if(mysqli_query($conectar, $sql)) {
        $retorno['afectado'] = 'SI';
        $retorno['mensaje'] = 'Comentario agregado exitosamente.';
    } else {
        $retorno['mensaje'] = 'Error SQL al agregar comentario.';
    }
}
echo json_encode($retorno);
?>
