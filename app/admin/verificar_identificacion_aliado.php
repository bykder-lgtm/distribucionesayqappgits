<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); }

if(isset($_POST['identificacion']) && !empty($_POST['identificacion'])) {
    $identificacion = mysqli_real_escape_string($conectar, $_POST['identificacion']);
    $cod_aliado_excluir = isset($_POST['cod_aliado']) ? (int)$_POST['cod_aliado'] : null;
    
    // Consulta para verificar si existe la identificación (solo aliados estratégicos)
    if($cod_aliado_excluir) {
        // Si es edición, excluir el aliado actual
        $sql = "SELECT COUNT(*) as total FROM tbl15_administrador WHERE identificacion_tercero = '$identificacion' AND cod_tipo_tercero = '13' AND cod_administrador != '$cod_aliado_excluir'";
    } else {
        // Si es nuevo registro
        $sql = "SELECT COUNT(*) as total FROM tbl15_administrador WHERE identificacion_tercero = '$identificacion' AND cod_tipo_tercero = '13'"; 
    }
    $resultado = mysqli_query($conectar, $sql);
    if($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        if($fila['total'] > 0) { echo json_encode(['existe' => true]); } else { echo json_encode(['existe' => false]); }
    } else {
        echo json_encode(['existe' => false, 'error' => 'Error en la consulta: ' . mysqli_error($conectar)]);
    }
} else {
    echo json_encode(['existe' => false, 'error' => 'No se proporcionó identificación']);
}
?>
