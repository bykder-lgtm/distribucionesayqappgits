<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include_once('../admin/enviar_correo_bienvenida_aliado.php');
date_default_timezone_set("America/Bogota");
include_once ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); }

$cuenta_actual                                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                                                   = $_SESSION['usuario'];
$cod_administrador                                                  = ($_SESSION['cod_administrador']);
//$cuenta                                     = $_SESSION['usuario'];
$retorno_array                                                      = array();
$retorno_array2                                                     = array();
$codigoHTML_menu                                                    = '';
$codigoHTML_menu_total_reg                                          = '';
$respuesta_ajax                                                     = array();
$url_pag_redirec_ini_sesion                                         = '../admin/dashboard_aliado_movil.php';
$cod_caja_virtual                                                   = 1;
$cod_caja                                                           = 1;
$nombre_maquina                                                     = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$cod_tipo_tercero                                                   = "13";
$nombre_tipo_tercero                                                = 'ALIADO_ESTRATEGICO';
$nombre_tipo_cliente                                                = isset($_POST['nombre_tipo_cliente']) ? trim(addslashes($_POST['nombre_tipo_cliente'])) : "PERSONA_NATURAL";
$nombre_tipo_regimen                                                = "SIMPLE";
$nombre_tipo_impuesto                                               = "NO_RESPONSABLE_DE_IVA";
$nombre_tipo_identificacion                                         = "CC";
$cod_seguridad                                                      = "23";
$cod_estado_activacion_usuario                                      = "2"; // Pendiente de activación
$fecha                                                              = date("Y-m-d");
$fecha_hora                                                         = date("H:i:s");
$creador                                                            = $cuenta_actual;
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['identificacion_tercero'])) {
	$identificacion_tercero                                         = addslashes($_POST['identificacion_tercero']);
	$nombre1_tercero                                                = trim(addslashes($_POST['nombre1_tercero']));
	$apellido1_tercero                                              = trim(addslashes($_POST['apellido1_tercero']));
	$telefono1_tercero                                              = trim(addslashes($_POST['telefono1_tercero']));
	$correo_tercero                                                 = trim(addslashes($_POST['correo_tercero']));
	$nombres_apellidos_tercero                                      = trim(addslashes($_POST['nombres_apellidos_tercero']));
	$cod_asesor                                                     = intval($_POST['cod_asesor']);
	$direccion_tercero                                              = '';
	// Nuevos campos de tipo de cliente y sector
	$nombre_tipo_cliente                                            = isset($_POST['nombre_tipo_cliente']) ? addslashes($_POST['nombre_tipo_cliente']) : 1;
	$cod_tipo_sector                                                = isset($_POST['cod_tipo_sector']) ? intval($_POST['cod_tipo_sector']) : 0;
	$nit_razon_social                                               = isset($_POST['nit_razon_social']) ? trim(addslashes($_POST['nit_razon_social'])) : '';
    //$cod_asesor                                                     = intval($_POST['cod_asesor']);
	//$nombres_apellidos_tercero                                      = $nombre1_tercero.' '.$apellido1_tercero;
    $cedula                                                         = $identificacion_tercero;
    $nombres                                                        = $nombre1_tercero;
    $apellidos                                                      = $apellido1_tercero;
    $correo                                                         = $correo_tercero;
    $telefono                                                       = $telefono1_tercero;
    $contrasena                                                     = sha1($identificacion_tercero); // Contraseña inicial encriptada
	//---------------------------------------------------------------------------------------------------------------------------------//
    $sql_autoincremento_administrador = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_administrador'";
    $exec_autoincremento_administrador = mysqli_query($conectar, $sql_autoincremento_administrador) or die(mysqli_error($conectar));
    $datos_autoincremento_administrador = mysqli_fetch_assoc($exec_autoincremento_administrador);

    $cod_administrador                                              = $datos_autoincremento_administrador['AUTO_INCREMENT'];
    $cod_aliado_estrategico                                         = $cod_administrador;
    $cuenta                                                         = $identificacion_tercero.'-'.$cod_administrador;
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_dato_aliado = "SELECT cod_administrador FROM tbl15_administrador WHERE identificacion_tercero = '".($identificacion_tercero)."' AND cod_tipo_tercero = '13'";
	$consultar_dato_aliado = mysqli_query($conectar, $sql_dato_aliado) or die(mysqli_error($conectar));
	$info_dato_aliado = mysqli_fetch_assoc($consultar_dato_aliado);
	$existe_dato_aliado = mysqli_num_rows(@$consultar_dato_aliado);

	//$cod_administrador                                              = intval($info_dato_aliado['cod_administrador']);
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_matriz_lider_coord = "SELECT cod_lider, cod_coordinador FROM tbl15_administrador WHERE cod_administrador = '".($cod_asesor)."'";
	$consultar_matriz_lider_coord = mysqli_query($conectar, $sql_matriz_lider_coord) or die(mysqli_error($conectar));
	$info_matriz_lider_coord = mysqli_fetch_assoc($consultar_matriz_lider_coord);
	$existe_matriz_lider_coord = mysqli_num_rows(@$consultar_matriz_lider_coord);

	$cod_lider                                                      = $info_matriz_lider_coord['cod_lider'];
    $cod_coordinador                                                = $info_matriz_lider_coord['cod_coordinador'];
	//---------------------------------------------------------------------------------------------------------------------------------//
    if($existe_dato_aliado > 0) {
        // El aliado ya existe, no se registra nuevamente
        $afectado = "EXISTE";
        $cod_administrador = intval($info_dato_aliado['cod_administrador']);
    } else {
		$sql_data = "INSERT INTO tbl15_administrador (identificacion_tercero, nombre1_tercero, apellido1_tercero, telefono1_tercero, correo_tercero, direccion_tercero, 
        nombres_apellidos_tercero, cod_tipo_tercero, nombre_tipo_tercero, nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto, nombre_tipo_identificacion, 
        cod_seguridad, cod_estado_activacion_usuario, fecha, fecha_hora, creador, cedula, nombres, apellidos, correo, telefono, cuenta, contrasena, 
        cod_aliado_estrategico, url_pag_redirec_ini_sesion, cod_caja_virtual, cod_caja, nombre_maquina, cod_lider, cod_coordinador, cod_asesor, cod_tipo_sector, nit_razon_social) 
		VALUES ('$identificacion_tercero', UPPER('$nombre1_tercero'), UPPER('$apellido1_tercero'), '$telefono1_tercero', '$correo_tercero', '$direccion_tercero', 
        UPPER('$nombres_apellidos_tercero'), '$cod_tipo_tercero', '$nombre_tipo_tercero', '$nombre_tipo_cliente', '$nombre_tipo_regimen', '$nombre_tipo_impuesto', '$nombre_tipo_identificacion', 
        '$cod_seguridad', '$cod_estado_activacion_usuario', '$fecha', '$fecha_hora', '$creador', '$cedula', UPPER('$nombres'), UPPER('$apellidos'), '$correo', '$telefono', '$cuenta', '$contrasena', 
        '$cod_aliado_estrategico', '$url_pag_redirec_ini_sesion', '$cod_caja_virtual', '$cod_caja', '$nombre_maquina', '$cod_lider', '$cod_coordinador', '$cod_asesor', '$cod_tipo_sector', '$nit_razon_social')";
		$exec_data = mysqli_query($conectar, $sql_data);
        //---------------------------------------------------------------------------------------------------------------------------------//
        if ($exec_data && mysqli_affected_rows($conectar) > 0) { 
            $afectado = "SI";
            // Obtener el cod_administrador recién insertado
            $cod_administrador = mysqli_insert_id($conectar);
            
            // Guardar parametrización de entidades crediticias
            if (isset($_POST['entidades']) && is_array($_POST['entidades'])) {
                foreach ($_POST['entidades'] as $cod_entidad) {

                    $interes_field                                                  = 'interes_' . $cod_entidad;
                    $interes_ptj                                                    = isset($_POST[$interes_field]) && $_POST[$interes_field] !== '' ? floatval($_POST[$interes_field]) : 0.00;
                    // Obtener campos adicionales
                    $cod_estado_entrar_portal_field                                 = 'cod_estado_entrar_portal_'.$cod_entidad;
                    $cod_estado_entrar_portal                                       = isset($_POST[$cod_estado_entrar_portal_field]) ? '1' : '0';
                    $url_pagina_web_consulta_field                                  = 'url_pagina_web_consulta_'.$cod_entidad;
                    $url_pagina_web_consulta                                        = isset($_POST[$url_pagina_web_consulta_field]) ? trim(addslashes($_POST[$url_pagina_web_consulta_field])) : '';
                    // Obtener nombre de la entidad crediticia
                    $sql_nombre_entidad = "SELECT nombre_entidad_crediticia, cod_posicion FROM tbl15_entidad_crediticia WHERE cod_entidad_crediticia = '$cod_entidad'";
                    $res_nombre_entidad = mysqli_query($conectar, $sql_nombre_entidad);
                    $data_nombre_entidad = mysqli_fetch_assoc($res_nombre_entidad);

                    $nombre_entidad_crediticia                                      = $data_nombre_entidad['nombre_entidad_crediticia'];
                    $cod_posicion                                                   = $data_nombre_entidad['cod_posicion'];

                    $sql_parametrizacion = "INSERT INTO tbl15_parametrizacion_entidad_crediticia_aliado 
                    (cod_administardor, cod_aliado_estrategico, cod_entidad_crediticia, nombre_entidad_crediticia, cod_posicion, interes_ptj, aval_ptj, cod_estado_entrar_portal, url_pagina_web_consulta, fecha_creacion, cod_estado) 
                    VALUES ('$cod_administrador', '$cod_aliado_estrategico', '$cod_entidad', '$nombre_entidad_crediticia', '$cod_posicion', '$interes_ptj', '0.00', '$cod_estado_entrar_portal', '$url_pagina_web_consulta', '$fecha', '1')";
                    mysqli_query($conectar, $sql_parametrizacion);
                }
            }
            // Guardar cuentas bancarias
            if (isset($_POST['bancos']) && is_array($_POST['bancos'])) {
                foreach ($_POST['bancos'] as $cod_banco) {

                    $numero_cuenta_field                                            = 'numero_cuenta_' . $cod_banco;
                    $tipo_cuenta_field                                              = 'tipo_cuenta_' . $cod_banco;
                    $certificado_field                                              = 'certificado_banco_' . $cod_banco;
                    $nombre_titular_field                                           = 'nombre_titular_cuenta_' . $cod_banco;
                    $identificacion_titular_field                                   = 'identificacion_titular_cuenta_' . $cod_banco;

                    $numero_banco_cuenta                                            = isset($_POST[$numero_cuenta_field]) ? trim(addslashes($_POST[$numero_cuenta_field])) : '';
                    $cod_tipo_cuenta_banco                                          = isset($_POST[$tipo_cuenta_field]) ? intval($_POST[$tipo_cuenta_field]) : 1;
                    $nombre_titular_cuenta                                          = isset($_POST[$nombre_titular_field]) ? trim(addslashes($_POST[$nombre_titular_field])) : '';
                    $identificacion_titular_cuenta                                  = isset($_POST[$identificacion_titular_field]) ? trim(addslashes($_POST[$identificacion_titular_field])) : '';
                    $url_certificado_banco_cuenta                                   = '';
                    // Procesar certificado bancario si se envió
                    if(isset($_FILES[$certificado_field]) && $_FILES[$certificado_field]['error'] == 0) {
                        $archivo                                                        = $_FILES[$certificado_field];
                        $nombre_original                                                = $archivo['name'];
                        $extension                                                      = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
                        $extensiones_permitidas                                         = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx');

                        if(in_array($extension, $extensiones_permitidas)) {
                            $directorio                                                     = '../archivador/documentacion_tienda/';
                            if(!is_dir($directorio)) { mkdir($directorio, 0755, true); }
                            $nombre_archivo                                                 = 'cert_' . $cod_administrador . '_' . $cod_banco . '_' . time() . '.' . $extension;
                            $ruta_destino                                                   = $directorio . $nombre_archivo;
                            if(move_uploaded_file($archivo['tmp_name'], $ruta_destino)) { $url_certificado_banco_cuenta = $directorio . $nombre_archivo; }
                        }
                    }
                    // Obtener nombre del banco
                    $sql_nombre_banco = "SELECT nombre_banco FROM tbl15_banco WHERE cod_banco = '$cod_banco'";
                    $res_nombre_banco = mysqli_query($conectar, $sql_nombre_banco);
                    $data_nombre_banco = mysqli_fetch_assoc($res_nombre_banco);

                    $nombre_banco_cuenta                                            = $data_nombre_banco['nombre_banco'];
                    // Insertar cuenta bancaria
                    $sql_banco = "INSERT INTO tbl15_banco_cuenta (nombre_banco_cuenta, numero_banco_cuenta, cod_tipo_cuenta_banco, cod_aliado_estrategico, cod_estado, url_certificado_banco_cuenta, nombre_titular_cuenta, identificacion_titular_cuenta) 
                    VALUES ('$nombre_banco_cuenta', '$numero_banco_cuenta', '$cod_tipo_cuenta_banco', '$cod_aliado_estrategico', '1', '$url_certificado_banco_cuenta', UPPER('$nombre_titular_cuenta'), '$identificacion_titular_cuenta')";
                    mysqli_query($conectar, $sql_banco);
                }
            }
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
            if ($docs_para_actualizar) { $sql_update_docs .= " WHERE cod_administrador = '$cod_administrador'"; mysqli_query($conectar, $sql_update_docs); }
            
            // ========================================================================================
            // CREAR TIENDA AUTOMÁTICAMENTE SI SE SOLICITÓ
            // ========================================================================================
            if (isset($_POST['crear_tienda_al_guardar']) && $_POST['crear_tienda_al_guardar'] == '1') {
                $nombre_tienda = $nombres_apellidos_tercero;
                $abrev_tienda = 'TIENDA_' . $identificacion_tercero;
                $cod_departamento_tienda = isset($_POST['cod_departamento']) ? intval($_POST['cod_departamento']) : 0;
                $cod_municipio_tienda = isset($_POST['cod_municipio']) ? intval($_POST['cod_municipio']) : 0;
                $direccion_tienda = isset($_POST['direccion_tercero']) ? trim(addslashes($_POST['direccion_tercero'])) : '';
                $fecha_creacion_tienda = date("Y-m-d H:i:s");
                
                $sql_insert_tienda = "INSERT INTO tbl15_tienda (
                    identificacion_tercero, nombre_tienda, abrev_tienda, nombre1_tercero, telefono1_tercero, correo_tercero, direccion_tercero, 
                    cod_aliado_estrategico, cod_departamento, cod_municipio, nombre_tipo_tercero, nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto, fecha_creacion, cod_estado, cod_administrador
                ) VALUES (
                    '$identificacion_tercero', UPPER('$nombre_tienda'), UPPER('$abrev_tienda'), UPPER('$nombre1_tercero'), '$telefono1_tercero', '$correo_tercero', '$direccion_tienda', 
                    '$cod_administrador', '$cod_departamento_tienda', '$cod_municipio_tienda', 'TIENDA', 'PERSONA_NATURAL', 'SIMPLE', 'NO_RESPONSABLE_DE_IVA', '$fecha_creacion_tienda', '1', '$cod_administrador'
                )";
                
                if (mysqli_query($conectar, $sql_insert_tienda)) {
                    $cod_tienda_creada = mysqli_insert_id($conectar);
                    $respuesta_ajax['cod_tienda'] = $cod_tienda_creada;
                }
            }
            // ========================================================================================
            // ENVIAR CORREO DE BIENVENIDA CON CREDENCIALES AL NUEVO ALIADO
            // ========================================================================================
            $correo_enviado = false;
            $error_correo = '';
            if (!empty($correo_tercero)) {
                $resultado_correo = enviarCorreoBienvenidaAliado($conectar, $cod_administrador, $nombre1_tercero, $apellido1_tercero, $correo_tercero, $cuenta, $identificacion_tercero);
                $correo_enviado = isset($resultado_correo['success']) ? $resultado_correo['success'] : false;
                $error_correo = isset($resultado_correo['error']) ? $resultado_correo['error'] : (isset($resultado_correo['mensaje']) ? $resultado_correo['mensaje'] : '');
            }
            // ========================================================================================
        } else { 
            $afectado = "NO";
            $error_mysql = mysqli_error($conectar);
        }
    }
	// Limpiar cualquier output buffer antes de enviar JSON
	if (ob_get_length()) ob_clean();
	header('Content-Type: application/json');
	$respuesta_ajax['afectado']                    = $afectado;
	$respuesta_ajax['cod_administrador']           = $cod_administrador;
    
    if ($afectado == "SI") {
        // Generar código encriptado del aliado para compartir enlace
        $cod_aliado_cryp = DAXCODIFCRYPTOR::encriptardax(DAXCODIFCRYPTOR::encodifdax($cod_administrador));
        $respuesta_ajax['cod_aliado_cryp']         = $cod_aliado_cryp;
        $respuesta_ajax['nombre_completo']         = $nombres_apellidos_tercero;
        $respuesta_ajax['telefono']                = $telefono1_tercero;
        $respuesta_ajax['correo']                  = $correo_tercero;
        
        if (isset($correo_enviado) && $correo_enviado) {
            $respuesta_ajax['mensaje']             = 'Aliado registrado correctamente. Se ha enviado un correo con las credenciales de acceso.';
            $respuesta_ajax['correo_enviado']      = true;
        } else {
            $respuesta_ajax['mensaje']             = 'Aliado registrado correctamente. No se pudo enviar el correo de bienvenida.';
            $respuesta_ajax['correo_enviado']      = false;
            $respuesta_ajax['error_correo']        = $error_correo;
        }
    } elseif ($afectado == "EXISTE") {
        $respuesta_ajax['mensaje']                 = 'El aliado ya existe en el sistema.';
    } else {
        $respuesta_ajax['mensaje']                 = 'Error al registrar el aliado.';
        $respuesta_ajax['error']                   = isset($error_mysql) ? $error_mysql : 'Error desconocido';
    }
	echo json_encode($respuesta_ajax);
}
?>