<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

if (verificar_usuario()){ } else { header("Location:../index.php"); exit; }

header('Content-Type: application/json');

if(isset($_POST['cod_banco_cuenta']) && isset($_POST['numero_banco_cuenta']) && isset($_POST['cod_tipo_cuenta_banco'])) {
    $cod_banco_cuenta = intval($_POST['cod_banco_cuenta']);
    $numero_banco_cuenta = trim(addslashes($_POST['numero_banco_cuenta']));
    $cod_tipo_cuenta_banco = intval($_POST['cod_tipo_cuenta_banco']);
    $cod_estado = isset($_POST['cod_estado']) ? intval($_POST['cod_estado']) : 1;
    $nombre_titular_cuenta = isset($_POST['nombre_titular_cuenta']) ? trim(addslashes($_POST['nombre_titular_cuenta'])) : '';
    $identificacion_titular_cuenta = isset($_POST['identificacion_titular_cuenta']) ? trim(addslashes($_POST['identificacion_titular_cuenta'])) : ''; // Se usa text/varchar para guardar sin problemas
    $url_certificado_banco_cuenta = '';
    
    // Validar que el número de cuenta no esté vacío
    if(empty($numero_banco_cuenta)) { echo json_encode(array('success' => false, 'mensaje' => 'El número de cuenta no puede estar vacío')); exit; }
    
    // Procesar archivo de certificado bancario si se envió
    if(isset($_FILES['certificado_banco']) && $_FILES['certificado_banco']['error'] == 0) {
        $archivo = $_FILES['certificado_banco'];
        $nombre_original = $archivo['name'];
        $extension = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
        $extensiones_permitidas = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx');
        
        if(in_array($extension, $extensiones_permitidas)) {
            // Crear directorio si no existe
            $directorio = '../archivador/documentacion_tienda/';
            if(!is_dir($directorio)) { mkdir($directorio, 0755, true); }
            // Generar nombre único para el archivo
            $nombre_archivo = 'cert_' . $cod_banco_cuenta . '_' . time() . '.' . $extension;
            $ruta_destino = $directorio . $nombre_archivo;
            if(move_uploaded_file($archivo['tmp_name'], $ruta_destino)) { $url_certificado_banco_cuenta = $directorio . $nombre_archivo; }
        }
    }
    // Actualizar la cuenta bancaria
    $sql = "UPDATE tbl15_banco_cuenta SET numero_banco_cuenta = '$numero_banco_cuenta', cod_tipo_cuenta_banco = '$cod_tipo_cuenta_banco', cod_estado = '$cod_estado', nombre_titular_cuenta = UPPER('$nombre_titular_cuenta'), identificacion_titular_cuenta = '$identificacion_titular_cuenta'";
    // Solo actualizar el certificado si se subió uno nuevo
    if(!empty($url_certificado_banco_cuenta)) { $sql .= ", url_certificado_banco_cuenta = '$url_certificado_banco_cuenta'"; }
    
    $sql .= " WHERE cod_banco_cuenta = '$cod_banco_cuenta'";    
    $resultado = mysqli_query($conectar, $sql);
    if($resultado) { echo json_encode(array('success' => true, 'mensaje' => 'Cuenta bancaria actualizada correctamente')); } else { echo json_encode(array('success' => false, 'mensaje' => 'Error al actualizar la cuenta. ' . mysqli_error($conectar))); }
} else {
    echo json_encode(array('success' => false, 'mensaje' => 'Parámetros incompletos'));
}
?>
