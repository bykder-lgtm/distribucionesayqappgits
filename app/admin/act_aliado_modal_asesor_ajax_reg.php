<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); }

$cuenta_actual                                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$retorno_array                                                      = array();
$respuesta_ajax                                                     = array();

if (isset($_POST['cod_administrador']) && isset($_POST['action']) && $_POST['action'] == 'editar') {
    
    $cod_administrador                                                  = intval($_POST['cod_administrador']);
    $identificacion_tercero                                             = trim(addslashes($_POST['identificacion_tercero']));
    $nombre1_tercero                                                    = trim(addslashes($_POST['nombre1_tercero']));
    $apellido1_tercero                                                  = trim(addslashes($_POST['apellido1_tercero']));
    $telefono1_tercero                                                  = trim(addslashes($_POST['telefono1_tercero']));
    $correo_tercero                                                     = trim(addslashes($_POST['correo_tercero']));
    $cod_estado_activacion_usuario                                      = intval($_POST['cod_estado_activacion_usuario']);
    
    // Campos adicionales y jerarquía
    $nombre_tipo_cliente                                                = isset($_POST['nombre_tipo_cliente']) ? trim(addslashes($_POST['nombre_tipo_cliente'])) : "";
    $cod_tipo_sector                                                    = isset($_POST['cod_tipo_sector']) ? intval($_POST['cod_tipo_sector']) : 0;
    $nit_razon_social                                                   = isset($_POST['nit_razon_social']) ? trim(addslashes($_POST['nit_razon_social'])) : '';
    $nombre_tipo_identificacion                                         = isset($_POST['nombre_tipo_identificacion']) ? trim(addslashes($_POST['nombre_tipo_identificacion'])) : "";
    $cod_asesor                                                         = isset($_POST['cod_asesor']) ? intval($_POST['cod_asesor']) : 0;
    $cod_lider                                                          = isset($_POST['cod_lider']) ? intval($_POST['cod_lider']) : 0;
    $cod_coordinador                                                    = isset($_POST['cod_coordinador']) ? intval($_POST['cod_coordinador']) : 0;
    $cod_tipo_aliado                                                    = isset($_POST['cod_tipo_aliado']) ? intval($_POST['cod_tipo_aliado']) : 0;
    
    $nombres_apellidos_tercero                                          = isset($_POST['nombres_apellidos_tercero']) ? trim(addslashes($_POST['nombres_apellidos_tercero'])) : ($nombre1_tercero . ' ' . $apellido1_tercero);
    $nombre_razon_social                                                = isset($_POST['nombre_razon_social']) ? trim(addslashes($_POST['nombre_razon_social'])) : '';
    $cod_departamento                                                   = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : 0;
    $cod_municipio                                                      = isset($_POST['cod_municipio']) ? intval($_POST['cod_municipio']) : 0;
    $direccion_tercero                                                  = isset($_POST['direccion_tercero']) ? trim(addslashes($_POST['direccion_tercero'])) : '';
    $barrio_tercero                                                     = isset($_POST['barrio_tercero']) ? trim(addslashes($_POST['barrio_tercero'])) : '';

    // Verificar si se debe cambiar el usuario
    $nuevo_usuario                                                      = '';
    if (isset($_POST['nuevo_usuario'])) {
        $nuevo_usuario_raw                                              = trim($_POST['nuevo_usuario']);
        if ($nuevo_usuario_raw !== '') {
            $nuevo_usuario                                              = trim(addslashes($nuevo_usuario_raw));
            // Validar que el nuevo usuario no exista
            $check_usuario_sql = "SELECT cod_administrador FROM tbl15_administrador WHERE cuenta = '$nuevo_usuario' AND cod_administrador != '$cod_administrador'";
            $check_usuario_result = mysqli_query($conectar, $check_usuario_sql);
            if (mysqli_num_rows($check_usuario_result) > 0) { header('Content-Type: application/json'); echo json_encode(['afectado' => 'NO', 'mensaje' => 'El nombre de usuario ya está en uso. Por favor elija otro.']); exit; } 
        }
    }
    // Verificar si se debe cambiar la contraseña
    $cambiar_password                                                   = isset($_POST['cambiar_password']) && $_POST['cambiar_password'] == 'on';
    $nueva_password                                                     = '';
    if ($cambiar_password && isset($_POST['nueva_password']) && !empty($_POST['nueva_password'])) { $nueva_password = trim(addslashes($_POST['nueva_password'])); }
    
    // Check if cod_administrador exists
    $check_sql = "SELECT cod_administrador FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $check_result = mysqli_query($conectar, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        // Preparar la consulta SQL base
        $sql_update = "UPDATE tbl15_administrador SET identificacion_tercero = '$identificacion_tercero',  cedula = '$identificacion_tercero', nombre1_tercero = UPPER('$nombre1_tercero'),
        nombres = UPPER('$nombre1_tercero'), apellido1_tercero = UPPER('$apellido1_tercero'), apellidos = UPPER('$apellido1_tercero'), nombres_apellidos_tercero = UPPER('$nombres_apellidos_tercero'),
        telefono1_tercero = '$telefono1_tercero', telefono = '$telefono1_tercero', correo_tercero = '$correo_tercero', correo = '$correo_tercero', cod_estado_activacion_usuario = '$cod_estado_activacion_usuario',
        nombre_tipo_cliente = '$nombre_tipo_cliente', cod_tipo_sector = '$cod_tipo_sector', nit_razon_social = '$nit_razon_social', nombre_razon_social = UPPER('$nombre_razon_social'), 
        cod_departamento = '$cod_departamento', cod_municipio = '$cod_municipio', direccion_tercero = UPPER('$direccion_tercero'), barrio_tercero = UPPER('$barrio_tercero'),
        nombre_tipo_identificacion = '$nombre_tipo_identificacion',
        cod_asesor = '$cod_asesor', cod_lider = '$cod_lider', cod_coordinador = '$cod_coordinador', cod_tipo_aliado = '$cod_tipo_aliado'";
        
        // Si se debe cambiar el usuario, agregarlo a la consulta
        if (!empty($nuevo_usuario)) { $sql_update .= ", cuenta = '$nuevo_usuario'"; }
        // Si se debe cambiar la contraseña, agregarla a la consulta
        if ($cambiar_password && !empty($nueva_password)) { $sql_update .= ", contrasena = '$nueva_password'"; }
        
        $sql_update .= " WHERE cod_administrador = '$cod_administrador'";
        $exec_update = mysqli_query($conectar, $sql_update);
        
        if ($exec_update) { 
            // PROCESAR DOCUMENTACIÓN LEGAL
            $campos_documentos = array('url_documentacion_rut_aliado', 'url_documentacion_camaracomercio_aliado', 'url_documentacion_cedula_aliado', 'url_documentacion_contratofirma_aliado', 'url_documentacion_extra1_aliado', 'url_documentacion_extra2_aliado');
            $sql_update_docs = "UPDATE tbl15_administrador SET ";
            $docs_para_actualizar = false;
            
            foreach ($campos_documentos as $campo) {
                if (isset($_FILES[$campo]) && $_FILES[$campo]['error'] == 0) {
                    $uData = $_FILES[$campo];
                    $uName = $uData['name'];
                    $uParts = pathinfo($uName);
                    $uExt = isset($uParts['extension']) ? $uParts['extension'] : '';
                    $uExt = strtolower($uExt);
                    $uAllow = array('pdf');
                    
                    if (in_array($uExt, $uAllow)) {
                        $uDir = '../archivador/documentacion_aliado/';
                        if (!is_dir($uDir)) { mkdir($uDir, 0755, true); }
                        $uFile = $campo . '_' . $cod_administrador . '_' . time() . '.' . $uExt;
                        $uTarget = $uDir . $uFile;
                        $uTmp = $uData['tmp_name'];
                        if (move_uploaded_file($uTmp, $uTarget)) {
                            if ($docs_para_actualizar) { $sql_update_docs .= ", "; }
                            $sql_update_docs .= "$campo = '$uTarget'";
                            $docs_para_actualizar = true;
                        }
                    }
                }
            }
            if ($docs_para_actualizar) { $sql_update_docs .= ", fecha_documentacion = '".date('Y-m-d H:i:s')."' WHERE cod_administrador = '$cod_administrador'"; mysqli_query($conectar, $sql_update_docs); }
            
            // Actualizar parametrización de entidades crediticias
            if (isset($_POST['entidades']) && is_array($_POST['entidades'])) {
                $sql_desactivar = "UPDATE tbl15_parametrizacion_entidad_crediticia_aliado SET cod_estado = '0' WHERE cod_aliado_estrategico = '$cod_administrador'";
                mysqli_query($conectar, $sql_desactivar);
                foreach ($_POST['entidades'] as $cod_entidad) {
                    $cod_entidad = intval($cod_entidad);
                    $interes_ptj = 0;
                    if (isset($_POST['interes_' . $cod_entidad]) && !empty($_POST['interes_' . $cod_entidad])) { $interes_ptj = floatval($_POST['interes_' . $cod_entidad]); }
                    $cod_estado_entrar_portal = isset($_POST['cod_estado_entrar_portal_' . $cod_entidad]) ? '1' : '0';
                    $url_pagina_web_consulta = isset($_POST['url_pagina_web_consulta_' . $cod_entidad]) ? trim(addslashes($_POST['url_pagina_web_consulta_' . $cod_entidad])) : '';
                    
                    $sql_nombre_entidad = "SELECT nombre_entidad_crediticia, cod_posicion FROM tbl15_entidad_crediticia WHERE cod_entidad_crediticia = '$cod_entidad'";
                    $data_nombre_entidad = mysqli_fetch_assoc(mysqli_query($conectar, $sql_nombre_entidad));
                    $nombre_entidad_crediticia = isset($data_nombre_entidad['nombre_entidad_crediticia']) ? $data_nombre_entidad['nombre_entidad_crediticia'] : '';
                    $cod_posicion = isset($data_nombre_entidad['cod_posicion']) ? $data_nombre_entidad['cod_posicion'] : 0;
                    
                    $result_check = mysqli_query($conectar, "SELECT cod_parametrizacion_entidad_crediticia_aliado FROM tbl15_parametrizacion_entidad_crediticia_aliado WHERE cod_aliado_estrategico = '$cod_administrador' AND cod_entidad_crediticia = '$cod_entidad'");
                    
                    if (mysqli_num_rows($result_check) > 0) {
                        mysqli_query($conectar, "UPDATE tbl15_parametrizacion_entidad_crediticia_aliado SET interes_ptj = '$interes_ptj', cod_estado_entrar_portal = '$cod_estado_entrar_portal', url_pagina_web_consulta = '$url_pagina_web_consulta', cod_posicion = '$cod_posicion', cod_estado = '1' WHERE cod_aliado_estrategico = '$cod_administrador' AND cod_entidad_crediticia = '$cod_entidad'");
                    } else {
                        mysqli_query($conectar, "INSERT INTO tbl15_parametrizacion_entidad_crediticia_aliado (cod_administardor, cod_aliado_estrategico, cod_entidad_crediticia, nombre_entidad_crediticia, cod_posicion, interes_ptj, aval_ptj, cod_estado_entrar_portal, url_pagina_web_consulta, fecha_creacion, cod_estado) VALUES ('$cod_administrador', '$cod_administrador', '$cod_entidad', '$nombre_entidad_crediticia', '$cod_posicion', '$interes_ptj', '0.00', '$cod_estado_entrar_portal', '$url_pagina_web_consulta', '".date("Y-m-d")."', '1')");
                    }
                }
            } else {
                mysqli_query($conectar, "UPDATE tbl15_parametrizacion_entidad_crediticia_aliado SET cod_estado = '0' WHERE cod_aliado_estrategico = '$cod_administrador'");
            }
            $afectado = "SI"; 
            $mensaje = "Aliado actualizado correctamente.";
        } else { $afectado = "NO"; $mensaje = "Error al actualizar: " . mysqli_error($conectar); }
    } else { $afectado = "NO"; $mensaje = "El aliado no existe."; }
    header('Content-Type: application/json');
    echo json_encode(['afectado' => $afectado, 'mensaje' => $mensaje]);
} else {
    header('Content-Type: application/json');
    echo json_encode(['afectado' => 'NO', 'mensaje' => 'Datos incompletos o acción no válida.']);
}
?>
