<?php
// Prevent display of errors to avoid breaking JSON
ini_set('display_errors', 0);
error_reporting(E_ALL);

include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");

header('Content-Type: application/json');

$respuesta = array('success' => false, 'message' => '');

try {
    if (!verificar_usuario()){ throw new Exception('Sesión expirada o inválida.'); }
    
    $cod_administrador = ($_SESSION['cod_administrador']);
    
    if (isset($_POST['accion']) && isset($_POST['cod_tienda'])) {
        
        $accion = $_POST['accion'];
        $cod_tienda_cryp = $_POST['cod_tienda'];
        
        $cod_tienda_codif = DAXCODIFCRYPTOR::descriptardax($cod_tienda_cryp);
        $cod_tienda = DAXCODIFCRYPTOR::descodifdax($cod_tienda_codif);

        // Validación final del ID
        if (empty($cod_tienda) || !is_numeric($cod_tienda)) {
            // debug: $respuesta['debug'] = "Decrypted: " . $cod_tienda_codif . " | Result: " . $cod_tienda;
            throw new Exception('Error de seguridad: Código de tienda inválido o corrupto.');
        }
    
        if ($accion === 'aceptar') {
            $sql = "UPDATE tbl15_tienda SET cod_estado_firma_signature = '1' WHERE cod_tienda = '$cod_tienda'";
            if (mysqli_query($conectar, $sql)) {
                $respuesta['success'] = true;
                $respuesta['message'] = 'Firma aceptada correctamente.';
            } else {
                throw new Exception('Error al actualizar base de datos: ' . mysqli_error($conectar));
            }
        } elseif ($accion === 'rechazar') {
            // Se actualiza a estado 0, url vacía y fecha NULL (como string 'NULL' o NULL directo si el campo lo permite, aquí asumimos limpieza de datos)
            // Nota: fecha_firma_electronica a NULL o string vacío depende de la definición de BD. Usaremos NULL sin comillas si es permitido, o '' si es varchar.
            // Asumiremos que limpiar la URL es lo principal.
            $sql = "UPDATE tbl15_tienda SET cod_estado_firma_signature = '0', url_firma_electronica = '', fecha_firma_electronica = NULL WHERE cod_tienda = '$cod_tienda'";
            if (mysqli_query($conectar, $sql)) {
                $respuesta['success'] = true;
                $respuesta['message'] = 'Firma rechazada y eliminada.';
            } else {
                throw new Exception('Error al actualizar base de datos: ' . mysqli_error($conectar));
            }
        } else {
            throw new Exception('Acción no reconocida.');
        }
    
    } else {
        throw new Exception('Faltan parámetros requeridos.');
    }

} catch (Exception $e) {
    $respuesta['success'] = false;
    $respuesta['message'] = $e->getMessage();
}

echo json_encode($respuesta);
?>
