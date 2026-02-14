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
    $identificacion_tercero                                             = intval($_POST['identificacion_tercero']);
    $nombre1_tercero                                                    = trim(addslashes($_POST['nombre1_tercero']));
    $apellido1_tercero                                                  = trim(addslashes($_POST['apellido1_tercero']));
    $telefono1_tercero                                                  = trim(addslashes($_POST['telefono1_tercero']));
    $correo_tercero                                                     = trim(addslashes($_POST['correo_tercero']));
    $cod_estado_activacion_usuario                                      = intval($_POST['cod_estado_activacion_usuario']);
    
    // Campos nuevos
    $nombres_apellidos_tercero_form                                     = isset($_POST['nombres_apellidos_tercero']) ? trim(addslashes($_POST['nombres_apellidos_tercero'])) : '';
    $nombre_tipo_cliente                                                = isset($_POST['nombre_tipo_cliente']) ? trim(addslashes($_POST['nombre_tipo_cliente'])) : '';
    $cod_tipo_sector                                                    = isset($_POST['cod_tipo_sector']) ? intval($_POST['cod_tipo_sector']) : 0;
    $nit_razon_social                                                   = isset($_POST['nit_razon_social']) ? trim(addslashes($_POST['nit_razon_social'])) : '';
    // Verificar si se debe cambiar el usuario
    $nuevo_usuario                                                      = '';
    if (isset($_POST['nuevo_usuario'])) {
        $nuevo_usuario_raw                                              = trim($_POST['nuevo_usuario']);
        if ($nuevo_usuario_raw !== '') {
            $nuevo_usuario                                              = trim(addslashes($nuevo_usuario_raw));
        // Validar que el nuevo usuario no exista
        $check_usuario_sql = "SELECT cod_administrador FROM tbl15_administrador WHERE usuario = '$nuevo_usuario' AND cod_administrador != '$cod_administrador'";
        $check_usuario_result = mysqli_query($conectar, $check_usuario_sql);
            if (mysqli_num_rows($check_usuario_result) > 0) { header('Content-Type: application/json'); echo json_encode(['afectado' => 'NO', 'mensaje' => 'El nombre de usuario ya está en uso. Por favor elija otro.']); exit; } 
        }
    }
    // Verificar si se debe cambiar la contraseña
    $cambiar_password                                                   = isset($_POST['cambiar_password']) && $_POST['cambiar_password'] == 'on';
    $nueva_password                                                     = '';
    if ($cambiar_password && isset($_POST['nueva_password']) && !empty($_POST['nueva_password'])) { $nueva_password = trim(addslashes($_POST['nueva_password'])); }
    // Calculated fields
    // Usar el nombre comercial del formulario si existe, sino concatenar nombre y apellido
    if (!empty($nombres_apellidos_tercero_form)) {
        $nombres_apellidos_tercero                                      = $nombres_apellidos_tercero_form;
    } else {
        $nombres_apellidos_tercero                                      = $nombre1_tercero . ' ' . $apellido1_tercero;
    }
    
    // Calcular nombre_razon_social según tipo de cliente
    if ($nombre_tipo_cliente == 'PERSONA_JURIDICA' || $nombre_tipo_cliente == '2') {
        $nombre_razon_social                                            = $nombres_apellidos_tercero;
    } else {
        $nombre_razon_social                                            = '';
    }
    
    $fecha_modificacion                                                 = date("Y-m-d");
    $fecha_hora_modificacion                                            = date("H:i:s");
    // Check if cod_administrador exists
    $check_sql = "SELECT cod_administrador FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
    $check_result = mysqli_query($conectar, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        // Preparar la consulta SQL base
        $sql_update = "UPDATE tbl15_administrador SET identificacion_tercero = '$identificacion_tercero',  cedula = '$identificacion_tercero', nombre1_tercero = UPPER('$nombre1_tercero'),
        nombres = UPPER('$nombre1_tercero'), apellido1_tercero = UPPER('$apellido1_tercero'), apellidos = UPPER('$apellido1_tercero'), nombres_apellidos_tercero = UPPER('$nombres_apellidos_tercero'),
        telefono1_tercero = '$telefono1_tercero', telefono = '$telefono1_tercero', correo_tercero = '$correo_tercero', correo = '$correo_tercero', cod_estado_activacion_usuario = '$cod_estado_activacion_usuario',
        nombre_tipo_cliente = '$nombre_tipo_cliente', cod_tipo_sector = '$cod_tipo_sector', nit_razon_social = '$nit_razon_social', nombre_razon_social = UPPER('$nombre_razon_social')";
        
        // Si se debe cambiar el usuario, agregarlo a la consulta
        if (!empty($nuevo_usuario)) { $sql_update .= ", usuario = '$nuevo_usuario'"; }
        // Si se debe cambiar la contraseña, agregarla a la consulta
        if ($cambiar_password && !empty($nueva_password)) { $sql_update .= ", contrasena = '$nueva_password'"; }
        
        $sql_update .= " WHERE cod_administrador = '$cod_administrador'";
        $exec_update = mysqli_query($conectar, $sql_update);
        
        if ($exec_update) { 
            // ========================================================================================
            // PROCESAR DOCUMENTACIÓN LEGAL
            // ========================================================================================
            $campos_documentos = array('url_documentacion_rut_aliado', 'url_documentacion_camaracomercio_aliado', 'url_documentacion_cedula_aliado', 'url_documentacion_contratofirma_aliado', 'url_documentacion_extra1_aliado', 'url_documentacion_extra2_aliado');
            
            $sql_update_docs = "UPDATE tbl15_administrador SET ";
            $docs_para_actualizar = false;
            
            foreach ($campos_documentos as $campo) {
                if (isset($_FILES[$campo]) && $_FILES[$campo]['error'] == 0) {
                    $archivo = $_FILES[$campo];
                    $nombre_original = $archivo['name'];
                    $extension = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
                    $extensiones_permitidas = array('jpg', 'jpeg', 'png', 'pdf');
                    
                    if (in_array($extension, $extensiones_permitidas)) {
                        $directorio = '../archivador/documentacion_aliado/';
                        if (!is_dir($directorio)) { mkdir($directorio, 0755, true); }
                        
                        $nombre_archivo = $campo . '_' . $cod_administrador . '_' . time() . '.' . $extension;
                        $ruta_destino = $directorio . $nombre_archivo;
                        
                        if (move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
                            // Si es el primer campo a actualizar, no lleva coma, si no, lleva coma antes
                            if ($docs_para_actualizar) { $sql_update_docs .= ", "; }
                            $sql_update_docs .= "$campo = '$ruta_destino'";
                            $docs_para_actualizar = true;
                        }
                    }
                }
            }
            // Ejecutar actualización de documentos solo si hay cambios
            if ($docs_para_actualizar) { $sql_update_docs .= " WHERE cod_administrador = '$cod_administrador'"; mysqli_query($conectar, $sql_update_docs); }
            // Actualizar parametrización de entidades crediticias
            if (isset($_POST['entidades']) && is_array($_POST['entidades'])) {
                // Primero, desactivar todas las parametrizaciones existentes de este aliado
                $sql_desactivar = "UPDATE tbl15_parametrizacion_entidad_crediticia_aliado SET cod_estado = '0' WHERE cod_aliado_estrategico = '$cod_administrador'";
                mysqli_query($conectar, $sql_desactivar);
                // Insertar o actualizar las nuevas entidades seleccionadas
                foreach ($_POST['entidades'] as $cod_entidad) {
                    $cod_entidad                                                     = intval($cod_entidad);
                    $interes_ptj                                                     = 0;
                    // Obtener el porcentaje de interés si existe
                    if (isset($_POST['interes_' . $cod_entidad]) && !empty($_POST['interes_' . $cod_entidad])) { $interes_ptj = floatval($_POST['interes_' . $cod_entidad]); }
                    // Obtener campos adicionales
                    $cod_estado_entrar_portal_field                                  = 'cod_estado_entrar_portal_' . $cod_entidad;
                    $cod_estado_entrar_portal                                        = isset($_POST[$cod_estado_entrar_portal_field]) ? '1' : '0';
                    $url_pagina_web_consulta_field                                   = 'url_pagina_web_consulta_' . $cod_entidad;
                    $url_pagina_web_consulta                                         = isset($_POST[$url_pagina_web_consulta_field]) ? trim(addslashes($_POST[$url_pagina_web_consulta_field])) : '';
                    // Obtener nombre de la entidad crediticia
                    $sql_nombre_entidad = "SELECT nombre_entidad_crediticia FROM tbl15_entidad_crediticia WHERE cod_entidad_crediticia = '$cod_entidad'";
                    $res_nombre_entidad = mysqli_query($conectar, $sql_nombre_entidad);
                    $data_nombre_entidad = mysqli_fetch_assoc($res_nombre_entidad);

                    $nombre_entidad_crediticia                                       = isset($data_nombre_entidad['nombre_entidad_crediticia']) ? $data_nombre_entidad['nombre_entidad_crediticia'] : '';
                    // Verificar si ya existe el registro
                    $sql_check = "SELECT cod_parametrizacion_entidad_crediticia_aliado FROM tbl15_parametrizacion_entidad_crediticia_aliado WHERE cod_aliado_estrategico = '$cod_administrador' AND cod_entidad_crediticia = '$cod_entidad'";
                    $result_check = mysqli_query($conectar, $sql_check);
                    
                    if (mysqli_num_rows($result_check) > 0) {
                        // Actualizar registro existente
                        $sql_update_entidad = "UPDATE tbl15_parametrizacion_entidad_crediticia_aliado SET interes_ptj = '$interes_ptj', cod_estado_entrar_portal = '$cod_estado_entrar_portal', 
                        url_pagina_web_consulta = '$url_pagina_web_consulta', cod_estado = '1' WHERE cod_administrador = '$cod_administrador' AND cod_entidad_crediticia = '$cod_entidad'";
                        mysqli_query($conectar, $sql_update_entidad);
                    } else {
                        // Insertar nuevo registro
                        $fecha = date("Y-m-d");
                        $sql_insert_entidad = "INSERT INTO tbl15_parametrizacion_entidad_crediticia_aliado 
                        (cod_administardor, cod_aliado_estrategico, cod_entidad_crediticia, nombre_entidad_crediticia, interes_ptj, aval_ptj, cod_estado_entrar_portal, url_pagina_web_consulta, fecha_creacion, cod_estado) 
                        VALUES ('$cod_administrador', '$cod_administrador', '$cod_entidad', '$nombre_entidad_crediticia', '$interes_ptj', '0.00', '$cod_estado_entrar_portal', '$url_pagina_web_consulta', '$fecha', '1')";
                        mysqli_query($conectar, $sql_insert_entidad);
                    }
                }
            } else {
                // Si no se seleccionó ninguna entidad, desactivar todas
                $sql_desactivar = "UPDATE tbl15_parametrizacion_entidad_crediticia_aliado SET cod_estado = '0' WHERE cod_administrador = '$cod_administrador'";
                mysqli_query($conectar, $sql_desactivar);
            }
            $afectado = "SI"; 
            // Construir mensaje según lo que se actualizó
            $cambios = array();
            if (!empty($nuevo_usuario)) { $cambios[] = "nombre de usuario"; }
            if ($cambiar_password && !empty($nueva_password)) { $cambios[] = "contraseña"; }
            if (count($cambios) > 0) { $mensaje = "Aliado actualizado correctamente. Se modificó: " . implode(" y ", $cambios) . "."; } else { $mensaje = "Aliado actualizado correctamente."; }
        } else { 
            $afectado = "NO"; 
            $mensaje = "Error al actualizar: " . mysqli_error($conectar); 
        }
    } else {
        $afectado = "NO";
        $mensaje = "El aliado no existe.";
    }
    header('Content-Type: application/json');
    $respuesta_ajax['afectado'] = $afectado;
    $respuesta_ajax['mensaje'] = $mensaje;
    echo json_encode($respuesta_ajax);
} else {
    header('Content-Type: application/json');
    echo json_encode(['afectado' => 'NO', 'mensaje' => 'Datos incompletos o acción no válida.']);
}
?>
