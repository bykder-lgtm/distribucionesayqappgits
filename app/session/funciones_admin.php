<?php 
function conexiones($usuario, $clave) {
	include_once('../conexiones/conexione_sesion.php');
	include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
	include_once('../admin/detectar_tipo_dispositivo.php');

	$sql_info_empresa = "SELECT url_pag_redirec_ini_sesion_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
	$consulta_info_empresa = mysqli_query($conectar2, $sql_info_empresa);
	$datax_info_empresa = mysqli_fetch_assoc($consulta_info_empresa);

	$url_pag_redirec_ini_sesion_global  = $datax_info_empresa['url_pag_redirec_ini_sesion_global'];

	$buscar_usuario = "SELECT cod_administrador, cuenta, contrasena, cod_seguridad, cod_tipo_historia_clinica, nombres, apellidos, nombre_sexo, url_pag_redirec_ini_sesion, cod_estado_activacion_usuario, cod_estado_multirol, cod_administrador_padre_multirol 
	FROM tbl15_administrador WHERE cuenta = '$usuario' AND contrasena = '$clave'";
	$ejecutar_sql = mysqli_query($conectar2, $buscar_usuario);
	if (!$ejecutar_sql) {
		die("ERROR SQL (Falta actualizar Base de Datos Remota): " . mysqli_error($conectar2));
	}
	$datax = mysqli_fetch_assoc($ejecutar_sql);

	$cod_seguridad_sec                  = $datax['cod_seguridad'];
	$cod_estado_activacion_usuario_sec  = $datax['cod_estado_activacion_usuario'];
	$cod_administrador_sec              = $datax['cod_administrador'];
	$cod_tipo_historia_clinica_sec      = $datax['cod_tipo_historia_clinica'];
	$nombres_sec                        = $datax['nombres'];
	$apellidos_sec                      = $datax['apellidos'];
	$nombre_sexo_sec                    = $datax['nombre_sexo'];
	$url_pag_redirec_ini_sesion         = $datax['url_pag_redirec_ini_sesion'];
	$cod_estado_multirol_sec            = $datax['cod_estado_multirol'];
	$cod_adm_padre_multirol_sec         = $datax['cod_administrador_padre_multirol'];

	if ($url_pag_redirec_ini_sesion == '') { $url_pag_redirec_ini_sesion = '../admin/facturacion_venta_temporal_producto_manual_pos.php'; } else { $url_pag_redirec_ini_sesion = $url_pag_redirec_ini_sesion; }
	if ($url_pag_redirec_ini_sesion_global == '') { $url_pag_redirec_ini_sesion_global = '../admin/facturacion_venta_temporal_producto_manual_pos.php'; } else { $url_pag_redirec_ini_sesion_global = $url_pag_redirec_ini_sesion_global; }

	$pag_redirec_sesion_descryp         = $url_pag_redirec_ini_sesion_global; 
	$pag_redirec_sesion_cryp            = DAXCRYPTOR::encriptardax($pag_redirec_sesion_descryp);
	$cod_base_caja                      = '1';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos2' AND TABLE_NAME = 'tbl15_sesion'";
	$exec_autoincremento_sesion = mysqli_query($conectar2, $sql_autoincremento_sesion) or die(mysqli_error($conectar2));
	$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);
	$cod_sesion = $datos_autoincremento_sesion['AUTO_INCREMENT'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$randomize1_pos4_ini               = rand(1000, 9999);
	$randomize1_pos4_fin               = rand(1000, 9999);
	$cantidad_digito1                  = strlen($cod_seguridad_sec);
	$codif_cod_seguridad               = $cantidad_digito1.$randomize1_pos4_ini.$cod_seguridad_sec.$randomize1_pos4_fin;
//---------------------------------------------------------------------------------------------------------------------------------//
	$randomize2_pos4_ini               = rand(1000, 9999);
	$randomize2_pos4_fin               = rand(1000, 9999);
	$cantidad_digito2                  = strlen($cod_administrador_sec);
	$codif2                            = $cantidad_digito2.$randomize2_pos4_ini.$cod_administrador_sec.$randomize2_pos4_fin;
//---------------------------------------------------------------------------------------------------------------------------------//
	$randomize3_pos4_ini               = rand(1000, 9999);
	$randomize3_pos4_fin               = rand(1000, 9999);
	$cantidad_digito3                  = strlen($cod_sesion);
	$codif3                            = $cantidad_digito3.$randomize3_pos4_ini.$cod_sesion.$randomize3_pos4_fin;
//---------------------------------------------------------------------------------------------------------------------------------//
	$randomize4_pos4_ini               = rand(1000, 9999);
	$randomize4_pos4_fin               = rand(1000, 9999);
	$cantidad_digito4                  = strlen($cod_tipo_historia_clinica_sec);
	$codif4                            = $cantidad_digito4.$randomize4_pos4_ini.$cod_tipo_historia_clinica_sec.$randomize4_pos4_fin;
//---------------------------------------------------------------------------------------------------------------------------------//
	$codif_cod_seguridad_redondeo15    = str_pad($codif_cod_seguridad, 15, $randomize1_pos4_ini, STR_PAD_RIGHT);
	$cod_administrador_codif           = str_pad($codif2, 15, $randomize2_pos4_ini, STR_PAD_RIGHT);
	$tokn_codif                        = str_pad($codif3, 15, $randomize3_pos4_ini, STR_PAD_RIGHT);
	$cod_tipo_historia_clinica_codif   = str_pad($codif4, 15, $randomize4_pos4_ini, STR_PAD_RIGHT);
//---------------------------------------------------------------------------------------------------------------------------------//
	$usuario_cryp                      = DAXCRYPTOR::encriptardax($usuario);
	$cod_seguridad_cryp                = DAXCRYPTOR::encriptardax($codif_cod_seguridad_redondeo15);
	$cod_administrador_cryp            = DAXCRYPTOR::encriptardax($cod_administrador_codif);
	$tokn_cryp                         = DAXCRYPTOR::encriptardax($tokn_codif);
	$cod_tipo_historia_clinica_cryp    = DAXCRYPTOR::encriptardax($cod_tipo_historia_clinica_codif);
	$nombres_cryp                      = DAXCRYPTOR::encriptardax($nombres_sec);
	$apellidos_cryp                    = DAXCRYPTOR::encriptardax($apellidos_sec);
	$nombre_sexo_cryp                  = DAXCRYPTOR::encriptardax($nombre_sexo_sec);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	if (mysqli_num_rows($ejecutar_sql)!=0) {
		// Verificar estado de activación del usuario// cod_estado_activacion_usuario en tbl15_administrador: 1 = ACTIVO, 2 = EN ESPERA, 3 = INACTIVO// Si no tiene valor o es NULL, asumimos que está ACTIVO (valor por defecto = 1)
		if (empty($cod_estado_activacion_usuario_sec) || $cod_estado_activacion_usuario_sec == '' || $cod_estado_activacion_usuario_sec == NULL) { $cod_estado_activacion_usuario_sec = 1; /*Por defecto ACTIVO*/	}
		
		$sql_estado_activacion = "SELECT codigo_estado_activacion_usuario, nombre_estado_activacion_usuario FROM tbl15_estado_activacion_usuario WHERE cod_estado_activacion_usuario = '$cod_estado_activacion_usuario_sec'";
		$exec_estado_activacion = mysqli_query($conectar2, $sql_estado_activacion);
		$datos_estado_activacion = mysqli_fetch_assoc($exec_estado_activacion);
		
		// codigo_estado_activacion_usuario: 1 = ACTIVO, 0 = INACTIVO, 2 = EN ESPERA PARA ACTIVACION
		$codigo_estado_activacion = isset($datos_estado_activacion['codigo_estado_activacion_usuario']) ? $datos_estado_activacion['codigo_estado_activacion_usuario'] : 1;
		
		// Si el usuario está INACTIVO (codigo_estado_activacion_usuario = 0), no permitir inicio de sesión
		if ($codigo_estado_activacion == 0) { return 'INACTIVO'; }
		// Si el usuario está EN ESPERA PARA ACTIVACION (codigo_estado_activacion_usuario = 2), permitir pero marcar para cambio de contraseña
		$requiere_cambio_contrasena = ($codigo_estado_activacion == 2) ? true : false;
		
		//session_name("usuario"); 
		session_set_cookie_params(60*60*24*2); //la sesion dura 2 dias
		session_start();

		//$_SESSION['usuario'] = $usuario;
		$_SESSION['cod_administrador']                = $cod_administrador_sec;
		$_SESSION['usuario']                          = $usuario;
		$_SESSION['usuario_cryp']                     = $usuario_cryp;
		$_SESSION['cs_cryp']                          = $cod_seguridad_cryp;
		$_SESSION['ca_cryp']                          = $cod_administrador_cryp;
		$_SESSION['tokn_cryp']                        = $tokn_cryp;
		$_SESSION['pag_redirec_sesion_cryp']          = $pag_redirec_sesion_cryp;
		$_SESSION['url_pag_redirec_ini_sesion_real']  = DAXCRYPTOR::encriptardax($url_pag_redirec_ini_sesion); // Lo guardamos por si se elude el redireccionamiento dinamico
		$_SESSION['cod_tipo_historia_clinica_cryp']   = $cod_tipo_historia_clinica_cryp;
		$_SESSION['nombres_cryp']                     = $nombres_cryp;
		$_SESSION['apellidos_cryp']                   = $apellidos_cryp;
		$_SESSION['nombre_sexo_cryp']                 = $nombre_sexo_cryp;
		$_SESSION['url_img_firma_sesion']             = '';
		$_SESSION['url_img_foto_sesion']              = '';
		$_SESSION['tipo_dispositivo']                 = $tipo_dispositivo_encontrado;
		$_SESSION['cod_cliente_sesion']               = '';
		$_SESSION['cod_base_caja']                    = $cod_base_caja;
		$_SESSION['cod_seguridad']                    = $cod_seguridad_sec;
		$_SESSION['cod_caja_virtual']                 = '1';
		$_SESSION['cod_sesion']                       = $cod_sesion;
		$_SESSION['token']                            = sha1(uniqid(mt_rand(), true));
		$_SESSION['cuenta_actual']                    = $usuario;
		$_SESSION['estilo_css']                       = '';
		$_SESSION['tipo_usuario']                     = 'visitante';
		$_SESSION['tipo_menu']                        = 'usuario';
		$_SESSION['vendedor_codifcryp']               = '';
		$_SESSION['inicio_sesion']                    = 'SI';
		$_SESSION['pagina_salir_visitante']           = '../admin/iniciar_sesion_visitante.php';
		$_SESSION['requiere_cambio_contrasena']       = $requiere_cambio_contrasena;
		$_SESSION['cod_estado_activacion_usuario']    = $cod_estado_activacion_usuario_sec;
		$_SESSION['cod_estado_multirol']              = $cod_estado_multirol_sec;
		$_SESSION['cod_administrador_padre_multirol'] = $cod_adm_padre_multirol_sec;
		//$usuario_descryp = DAXCRYPTOR::descriptardax($usuario_cryp);
		//$cod_seguridad_descryp = DAXCRYPTOR::descriptardax($cod_seguridad_cryp);
		//$cod_administrador_descryp = DAXCRYPTOR::descriptardax($cod_administrador_cryp);
		
		// Devolver estado según activación
		if ($requiere_cambio_contrasena) { return 'ESPERA_ACTIVACION';	}

		// Validar si el usuario debe pasar primero por el selector de roles antes de enviarlo al url de redirección global
		if ($cod_estado_multirol_sec == '1') { return 'MULTIROL'; }
		return true;
	} else {
		return false;
	}
}
function verificar_usuario() {
	/* Establecemos que las paginas no pueden ser cacheadas */
	header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	//session_name("usuario"); 
	session_set_cookie_params(60*60*24*2); //la sesion dura 2 dias
	session_start();
	if (isset($_SESSION['usuario_cryp']) && $_SESSION['usuario_cryp']) {
		return true;		
	}
}
?>