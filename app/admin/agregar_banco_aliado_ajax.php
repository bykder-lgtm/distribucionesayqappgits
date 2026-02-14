<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); }
error_reporting(0);

header('Content-Type: application/json');

if(isset($_POST['cod_administrador']) && isset($_POST['cod_banco']) && isset($_POST['numero_banco_cuenta']) && isset($_POST['cod_tipo_cuenta_banco'])) {
    $cod_administrador                                                  = intval($_POST['cod_administrador']);
    $cod_banco                                                          = intval($_POST['cod_banco']);
    $numero_banco_cuenta                                                = trim(addslashes($_POST['numero_banco_cuenta']));
    $cod_tipo_cuenta_banco                                              = intval($_POST['cod_tipo_cuenta_banco']);
    $cod_estado                                                         = isset($_POST['cod_estado']) ? intval($_POST['cod_estado']) : 1;
    $nombre_titular_cuenta                                              = isset($_POST['nombre_titular_cuenta']) ? trim(addslashes($_POST['nombre_titular_cuenta'])) : '';
    $identificacion_titular_cuenta                                      = isset($_POST['identificacion_titular_cuenta']) ? trim(addslashes($_POST['identificacion_titular_cuenta'])) : '';
    $url_certificado_banco_cuenta                                       = '';
    // Validar que el número de cuenta no esté vacío
    if(empty($numero_banco_cuenta)) { echo json_encode(array('success' => false, 'mensaje' => 'El número de cuenta no puede estar vacío')); exit; }
    
    // Procesar archivo de certificado bancario si se envió
    if(isset($_FILES['certificado_banco']) && $_FILES['certificado_banco']['error'] == 0) {
        $archivo                                                            = $_FILES['certificado_banco'];
        $nombre_original                                                    = $archivo['name'];
        $extension                                                          = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
        $extensiones_permitidas                                             = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx');

        if(in_array($extension, $extensiones_permitidas)) {
            // Crear directorio si no existe
            $directorio                                                         = '../archivador/documentacion_tienda/';
            if(!is_dir($directorio)) { mkdir($directorio, 0755, true); }
            // Generar nombre único para el archivo
            $nombre_archivo                                                     = 'cert_' . $cod_administrador . '_' . $cod_banco . '_' . time() . '.' . $extension;
            $ruta_destino                                                       = $directorio . $nombre_archivo;
            if(move_uploaded_file($archivo['tmp_name'], $ruta_destino)) { $url_certificado_banco_cuenta = $directorio.$nombre_archivo; }
        }
    }
    // Obtener el nombre del banco
    $sql_banco = "SELECT nombre_banco FROM tbl15_banco WHERE cod_banco = '$cod_banco' AND cod_estado = '1'";
    $resultado_banco = mysqli_query($conectar, $sql_banco);
    if($resultado_banco && mysqli_num_rows($resultado_banco) > 0) {
        $row_banco = mysqli_fetch_assoc($resultado_banco);
        $nombre_banco = $row_banco['nombre_banco'];
        // Insertar la cuenta bancaria
        $sql = "INSERT INTO tbl15_banco_cuenta (nombre_banco_cuenta, numero_banco_cuenta, cod_tipo_cuenta_banco, cod_aliado_estrategico, cod_estado, url_certificado_banco_cuenta, nombre_titular_cuenta, identificacion_titular_cuenta) 
        VALUES ('$nombre_banco', '$numero_banco_cuenta', '$cod_tipo_cuenta_banco', '$cod_administrador', '$cod_estado', '$url_certificado_banco_cuenta', UPPER('$nombre_titular_cuenta'), '$identificacion_titular_cuenta')";
        $resultado = mysqli_query($conectar, $sql);
        if($resultado && mysqli_affected_rows($conectar) > 0) { echo json_encode(array('success' => true, 'mensaje' => 'Cuenta bancaria agregada correctamente')); } else { echo json_encode(array('success' => false, 'mensaje' => 'Error al agregar la cuenta bancaria')); }
    } else {
        echo json_encode(array('success' => false, 'mensaje' => 'Banco no encontrado'));
    }
} else {
    echo json_encode(array('success' => false, 'mensaje' => 'Datos incompletos'));
}
mysqli_close($conectar);
?>
