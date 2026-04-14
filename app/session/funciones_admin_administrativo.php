<?php
/**
 * Sesión exclusiva del portal administrativo DAyQ.
 * Solo usuarios con tbl15_tipo_rol_sistecredito.nombre_tipo_rol_sistecredito = PORTAL_ADMINISTRATIVO_DAYQ.
 */
@ob_start();
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

function conexiones_portal_administrativo($usuario, $clave) {
	include_once(__DIR__ . '/../conexiones/conexione_sesion.php');
	include_once(__DIR__ . '/../admin/class_php/funcion_cryptor_descryptor_class.php');
	include_once(__DIR__ . '/../admin/detectar_tipo_dispositivo.php');

	$usuario_esc = mysqli_real_escape_string($conectar2, $usuario);
	$clave_esc = mysqli_real_escape_string($conectar2, $clave);

	$buscar_usuario = "
		SELECT a.cod_administrador, a.cuenta, a.contrasena, a.cod_seguridad, a.cod_tipo_historia_clinica,
			a.nombres, a.apellidos, a.nombre_sexo, a.url_pag_redirec_ini_sesion, a.cod_estado_activacion_usuario,
			a.cod_estado_multirol, a.cod_administrador_padre_multirol
		FROM tbl15_administrador a
		INNER JOIN tbl15_tipo_rol_sistecredito r
			ON a.cod_tipo_rol_sistecredito = r.cod_tipo_rol_sistecredito
		WHERE a.cuenta = '$usuario_esc' AND a.contrasena = '$clave_esc'
			AND r.nombre_tipo_rol_sistecredito = 'PORTAL_ADMINISTRATIVO_DAYQ'
	";
	$ejecutar_sql = mysqli_query($conectar2, $buscar_usuario);
	if (!$ejecutar_sql) {
		die('ERROR SQL portal administrativo: ' . mysqli_error($conectar2));
	}
	if (mysqli_num_rows($ejecutar_sql) === 0) {
		return false;
	}
	$datax = mysqli_fetch_assoc($ejecutar_sql);

	$cod_seguridad_sec = $datax['cod_seguridad'];
	$cod_estado_activacion_usuario_sec = $datax['cod_estado_activacion_usuario'];
	$cod_administrador_sec = $datax['cod_administrador'];
	$cod_tipo_historia_clinica_sec = $datax['cod_tipo_historia_clinica'];
	$nombres_sec = $datax['nombres'];
	$apellidos_sec = $datax['apellidos'];
	$nombre_sexo_sec = $datax['nombre_sexo'];
	$url_pag_redirec_ini_sesion = $datax['url_pag_redirec_ini_sesion'];
	$cod_estado_multirol_sec = $datax['cod_estado_multirol'];
	$cod_adm_padre_multirol_sec = $datax['cod_administrador_padre_multirol'];

	$pag_redirec_sesion_descryp = '../admin/administrativo/index.php';
	$pag_redirec_sesion_cryp = DAXCRYPTOR::encriptardax($pag_redirec_sesion_descryp);
	$cod_base_caja = '1';

	$sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos2' AND TABLE_NAME = 'tbl15_sesion'";
	$exec_autoincremento_sesion = mysqli_query($conectar2, $sql_autoincremento_sesion) or die(mysqli_error($conectar2));
	$datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);
	$cod_sesion = $datos_autoincremento_sesion['AUTO_INCREMENT'];

	$randomize1_pos4_ini = rand(1000, 9999);
	$randomize1_pos4_fin = rand(1000, 9999);
	$cantidad_digito1 = strlen((string) $cod_seguridad_sec);
	$codif_cod_seguridad = $cantidad_digito1 . $randomize1_pos4_ini . $cod_seguridad_sec . $randomize1_pos4_fin;

	$randomize2_pos4_ini = rand(1000, 9999);
	$randomize2_pos4_fin = rand(1000, 9999);
	$cantidad_digito2 = strlen((string) $cod_administrador_sec);
	$codif2 = $cantidad_digito2 . $randomize2_pos4_ini . $cod_administrador_sec . $randomize2_pos4_fin;

	$randomize3_pos4_ini = rand(1000, 9999);
	$randomize3_pos4_fin = rand(1000, 9999);
	$cantidad_digito3 = strlen((string) $cod_sesion);
	$codif3 = $cantidad_digito3 . $randomize3_pos4_ini . $cod_sesion . $randomize3_pos4_fin;

	$randomize4_pos4_ini = rand(1000, 9999);
	$randomize4_pos4_fin = rand(1000, 9999);
	$cantidad_digito4 = strlen((string) $cod_tipo_historia_clinica_sec);
	$codif4 = $cantidad_digito4 . $randomize4_pos4_ini . $cod_tipo_historia_clinica_sec . $randomize4_pos4_fin;

	$codif_cod_seguridad_redondeo15 = str_pad($codif_cod_seguridad, 15, (string) $randomize1_pos4_ini, STR_PAD_RIGHT);
	$cod_administrador_codif = str_pad($codif2, 15, (string) $randomize2_pos4_ini, STR_PAD_RIGHT);
	$tokn_codif = str_pad($codif3, 15, (string) $randomize3_pos4_ini, STR_PAD_RIGHT);
	$cod_tipo_historia_clinica_codif = str_pad($codif4, 15, (string) $randomize4_pos4_ini, STR_PAD_RIGHT);

	$usuario_cryp = DAXCRYPTOR::encriptardax($usuario);
	$cod_seguridad_cryp = DAXCRYPTOR::encriptardax($codif_cod_seguridad_redondeo15);
	$cod_administrador_cryp = DAXCRYPTOR::encriptardax($cod_administrador_codif);
	$tokn_cryp = DAXCRYPTOR::encriptardax($tokn_codif);
	$cod_tipo_historia_clinica_cryp = DAXCRYPTOR::encriptardax($cod_tipo_historia_clinica_codif);
	$nombres_cryp = DAXCRYPTOR::encriptardax($nombres_sec);
	$apellidos_cryp = DAXCRYPTOR::encriptardax($apellidos_sec);
	$nombre_sexo_cryp = DAXCRYPTOR::encriptardax($nombre_sexo_sec);

	if (empty($cod_estado_activacion_usuario_sec) || $cod_estado_activacion_usuario_sec === '' || $cod_estado_activacion_usuario_sec === null) {
		$cod_estado_activacion_usuario_sec = 1;
	}

	$sql_estado_activacion = "SELECT codigo_estado_activacion_usuario FROM tbl15_estado_activacion_usuario WHERE cod_estado_activacion_usuario = '$cod_estado_activacion_usuario_sec'";
	$exec_estado_activacion = mysqli_query($conectar2, $sql_estado_activacion);
	$datos_estado_activacion = mysqli_fetch_assoc($exec_estado_activacion);
	$codigo_estado_activacion = isset($datos_estado_activacion['codigo_estado_activacion_usuario']) ? $datos_estado_activacion['codigo_estado_activacion_usuario'] : 1;

	if ((int) $codigo_estado_activacion === 0) {
		return 'INACTIVO';
	}
	$requiere_cambio_contrasena = ((int) $codigo_estado_activacion === 2);

	session_set_cookie_params(60 * 60 * 24 * 2);
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

	$_SESSION['cod_administrador'] = $cod_administrador_sec;
	$_SESSION['usuario'] = $usuario;
	$_SESSION['usuario_cryp'] = $usuario_cryp;
	$_SESSION['cs_cryp'] = $cod_seguridad_cryp;
	$_SESSION['ca_cryp'] = $cod_administrador_cryp;
	$_SESSION['tokn_cryp'] = $tokn_cryp;
	$_SESSION['pag_redirec_sesion_cryp'] = $pag_redirec_sesion_cryp;
	$_SESSION['url_pag_redirec_ini_sesion_real'] = DAXCRYPTOR::encriptardax($url_pag_redirec_ini_sesion);
	$_SESSION['cod_tipo_historia_clinica_cryp'] = $cod_tipo_historia_clinica_cryp;
	$_SESSION['nombres_cryp'] = $nombres_cryp;
	$_SESSION['apellidos_cryp'] = $apellidos_cryp;
	$_SESSION['nombre_sexo_cryp'] = $nombre_sexo_cryp;
	$_SESSION['url_img_firma_sesion'] = '';
	$_SESSION['url_img_foto_sesion'] = '';
	$_SESSION['tipo_dispositivo'] = $tipo_dispositivo_encontrado;
	$_SESSION['cod_cliente_sesion'] = '';
	$_SESSION['cod_base_caja'] = $cod_base_caja;
	$_SESSION['cod_seguridad'] = $cod_seguridad_sec;
	$_SESSION['cod_caja_virtual'] = '1';
	$_SESSION['cod_sesion'] = $cod_sesion;
	$_SESSION['token'] = sha1(uniqid((string) mt_rand(), true));
	$_SESSION['cuenta_actual'] = $usuario;
	$_SESSION['estilo_css'] = '';
	$_SESSION['tipo_usuario'] = 'portal_administrativo';
	$_SESSION['tipo_menu'] = 'portal_administrativo';
	$_SESSION['vendedor_codifcryp'] = '';
	$_SESSION['inicio_sesion'] = 'SI';
	$_SESSION['pagina_salir_visitante'] = '../session/salir_administrativo.php';
	$_SESSION['requiere_cambio_contrasena'] = $requiere_cambio_contrasena;
	$_SESSION['cod_estado_activacion_usuario'] = $cod_estado_activacion_usuario_sec;
	$_SESSION['cod_estado_multirol'] = $cod_estado_multirol_sec;
	$_SESSION['cod_administrador_padre_multirol'] = $cod_adm_padre_multirol_sec;
	$_SESSION['portal_administrativo'] = 'SI';

	if ($requiere_cambio_contrasena) {
		return 'ESPERA_ACTIVACION';
	}
	return true;
}

function verificar_usuario_portal_administrativo() {
	header('Expires: Tue, 01 Jul 2001 06:00:00 GMT');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header('Pragma: no-cache');
	session_set_cookie_params(60 * 60 * 24 * 2);
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	$portal = isset($_SESSION['portal_administrativo']) ? $_SESSION['portal_administrativo'] : '';
	return !empty($_SESSION['usuario_cryp']) && $portal === 'SI';
}
