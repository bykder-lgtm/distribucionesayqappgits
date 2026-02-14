<?php
/**
 * ARCHIVO DE VERIFICACIÓN DE DATOS
 * Este archivo te ayudará a verificar qué datos están llegando al servidor
 * cuando registras o editas una tienda.
 * 
 * INSTRUCCIONES:
 * 1. Temporalmente, cambia la URL en el JavaScript del formulario a este archivo
 * 2. Intenta registrar/editar una tienda
 * 3. Revisa la respuesta en la consola del navegador
 * 4. Una vez verificado, vuelve a poner la URL original
 */

header('Content-Type: application/json');

// Capturar todos los datos POST
$post_data = $_POST;

// Capturar todos los archivos
$files_data = [];
foreach ($_FILES as $key => $file) {
    $files_data[$key] = [
        'name' => $file['name'],
        'type' => $file['type'],
        'size' => $file['size'],
        'tmp_name' => $file['tmp_name'],
        'error' => $file['error'],
        'error_message' => $file['error'] === 0 ? 'Sin errores' : 'Error: ' . $file['error']
    ];
}

// Preparar respuesta detallada
$response = [
    'success' => true,
    'message' => 'VERIFICACIÓN DE DATOS RECIBIDOS',
    'timestamp' => date('Y-m-d H:i:s'),
    'datos_recibidos' => [
        'campos_texto' => $post_data,
        'total_campos' => count($post_data),
        'archivos_recibidos' => $files_data,
        'total_archivos' => count($files_data)
    ],
    'verificacion' => [
        'campos_principales' => [
            'accion' => isset($post_data['accion']) ? '✓ ' . $post_data['accion'] : '✗ NO RECIBIDO',
            'nombre_tienda' => isset($post_data['nombre1_tercero']) ? '✓ ' . $post_data['nombre1_tercero'] : '✗ NO RECIBIDO',
            'nit' => isset($post_data['identificacion_tercero']) ? '✓ ' . $post_data['identificacion_tercero'] : '✗ NO RECIBIDO',
            'telefono' => isset($post_data['telefono1_tercero']) ? '✓ ' . $post_data['telefono1_tercero'] : '✗ NO RECIBIDO',
            'correo' => isset($post_data['correo_tercero']) ? '✓ ' . $post_data['correo_tercero'] : '✗ NO RECIBIDO',
            'direccion' => isset($post_data['direccion_tercero']) ? '✓ ' . $post_data['direccion_tercero'] : '✗ NO RECIBIDO',
            'aliado' => isset($post_data['cod_aliado_estrategico']) ? '✓ ' . $post_data['cod_aliado_estrategico'] : '✗ NO RECIBIDO',
            'comision' => isset($post_data['comision_ptj']) ? '✓ ' . $post_data['comision_ptj'] : '✗ NO RECIBIDO',
            'banco' => isset($post_data['cod_banco_cuenta']) ? '✓ ' . $post_data['cod_banco_cuenta'] : '✗ NO RECIBIDO',
            'gps' => isset($post_data['ubicacion_gps_tienda']) ? '✓ ' . $post_data['ubicacion_gps_tienda'] : '✗ NO RECIBIDO',
        ],
        'representante_legal' => [
            'nombre' => isset($post_data['nombre_representante']) ? '✓ ' . $post_data['nombre_representante'] : '✗ NO RECIBIDO',
            'documento' => isset($post_data['documento_representante']) ? '✓ ' . $post_data['documento_representante'] : '✗ NO RECIBIDO',
            'correo' => isset($post_data['correo_representante']) ? '✓ ' . $post_data['correo_representante'] : '✗ NO RECIBIDO',
        ],
        'documentos' => [
            'rut' => isset($_FILES['url_rut_tienda']) && $_FILES['url_rut_tienda']['error'] === 0 ? '✓ ARCHIVO CARGADO' : '✗ NO CARGADO',
            'camara_comercio' => isset($_FILES['url_camara_comercio_tienda']) && $_FILES['url_camara_comercio_tienda']['error'] === 0 ? '✓ ARCHIVO CARGADO' : '✗ NO CARGADO',
        ],
        'imagenes' => [
            'logo' => isset($_FILES['imagen_tienda']) && $_FILES['imagen_tienda']['error'] === 0 ? '✓ IMAGEN CARGADA (' . $_FILES['imagen_tienda']['size'] . ' bytes)' : '✗ NO CARGADA',
            'fachada' => isset($_FILES['url_img_fachada_tienda']) && $_FILES['url_img_fachada_tienda']['error'] === 0 ? '✓ IMAGEN CARGADA (' . $_FILES['url_img_fachada_tienda']['size'] . ' bytes)' : '✗ NO CARGADA',
            'interna' => isset($_FILES['url_img_interna_tienda']) && $_FILES['url_img_interna_tienda']['error'] === 0 ? '✓ IMAGEN CARGADA (' . $_FILES['url_img_interna_tienda']['size'] . ' bytes)' : '✗ NO CARGADA',
            'selfie' => isset($_FILES['url_img_selfieadmin_tienda']) && $_FILES['url_img_selfieadmin_tienda']['error'] === 0 ? '✓ IMAGEN CARGADA (' . $_FILES['url_img_selfieadmin_tienda']['size'] . ' bytes)' : '✗ NO CARGADA',
        ]
    ],
    'configuracion_php' => [
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'post_max_size' => ini_get('post_max_size'),
        'max_file_uploads' => ini_get('max_file_uploads'),
        'max_execution_time' => ini_get('max_execution_time'),
    ]
];

// Devolver la respuesta
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>
