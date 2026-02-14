<?php
// Archivo de prueba para verificar la funcionalidad de upload
header('Content-Type: application/json; charset=utf-8');

echo json_encode([
    'success' => true,
    'message' => 'Servidor funcionando correctamente',
    'timestamp' => date('Y-m-d H:i:s'),
    'php_version' => phpversion(),
    'upload_max_filesize' => ini_get('upload_max_filesize'),
    'post_max_size' => ini_get('post_max_size'),
    'max_execution_time' => ini_get('max_execution_time'),
    'memory_limit' => ini_get('memory_limit')
]);
?>