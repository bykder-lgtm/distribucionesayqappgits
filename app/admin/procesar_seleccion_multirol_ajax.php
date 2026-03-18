<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../admin/detectar_tipo_dispositivo.php');
date_default_timezone_set("America/Bogota");
session_start();

$res = array('status' => 'error', 'message' => 'Solicitud no válida.', 'redirect_url' => '');
header('Content-Type: application/json');

if (!isset($_POST['cod_administrador']) || empty($_POST['cod_administrador'])) { $res['message'] = 'No se recibió el perfil a cargar.'; echo json_encode($res); exit; }

$cod_admin_destino = intval($_POST['cod_administrador']);
$cod_admin_padre_actual = isset($_SESSION['cod_administrador_padre_multirol']) ? $_SESSION['cod_administrador_padre_multirol'] : 0;
$cod_admin_actual = isset($_SESSION['cod_administrador']) ? $_SESSION['cod_administrador'] : 0;

// Validar permiso cruzado (comprobar que la cuenta solicitada sea hija de la misma raíz o sea la misma raíz)
if (empty($cod_admin_padre_actual) || $cod_admin_padre_actual == 0) { $cod_admin_padre_actual = $cod_admin_actual; } // El padre soy yo (si es cuenta original multirol)

$buscar_usuario = "SELECT cod_administrador, cuenta, cod_seguridad, cod_tipo_historia_clinica, nombres, apellidos, nombre_sexo, url_pag_redirec_ini_sesion, cod_estado_activacion_usuario, cod_estado_multirol, cod_administrador_padre_multirol 
FROM tbl15_administrador WHERE cod_administrador = '$cod_admin_destino' 
AND (cod_administrador = '$cod_admin_padre_actual' OR cod_administrador_padre_multirol = '$cod_admin_padre_actual') AND cod_estado = 1";
$ejecutar_sql = mysqli_query($conectar, $buscar_usuario);
if (mysqli_num_rows($ejecutar_sql) > 0) {
    $datax = mysqli_fetch_assoc($ejecutar_sql);
    
    // RECREAR ENTORNO DE SESION CON LA NUEVA IDENTIDAD
    $usuario                            = $datax['cuenta'];
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

    // Info global de la empresa
    $sql_info_empresa = "SELECT url_pag_redirec_ini_sesion_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
    $consulta_info_empresa = mysqli_query($conectar, $sql_info_empresa);
    $datax_info_empresa = mysqli_fetch_assoc($consulta_info_empresa);
    $url_pag_redirec_ini_sesion_global  = $datax_info_empresa['url_pag_redirec_ini_sesion_global'];

    if ($url_pag_redirec_ini_sesion == '') { $url_pag_redirec_ini_sesion = '../admin/facturacion_venta_temporal_producto_manual_pos.php'; }
    if ($url_pag_redirec_ini_sesion_global == '') { $url_pag_redirec_ini_sesion_global = '../admin/facturacion_venta_temporal_producto_manual_pos.php'; }

    // Reutilizar el TOKEN (Cod_Sesion) actual para no generar basuras extras en tbl15_sesion, solo actualizamos las credenciales
    $cod_sesion = isset($_SESSION['cod_sesion']) ? $_SESSION['cod_sesion'] : 1;
    $cod_base_caja = '1';

    // Algoritmos de encriptacion originales del sistema
    $randomize1_pos4_ini               = rand(1000, 9999);
    $randomize1_pos4_fin               = rand(1000, 9999);
    $cantidad_digito1                  = strlen($cod_seguridad_sec);
    $codif_cod_seguridad               = $cantidad_digito1.$randomize1_pos4_ini.$cod_seguridad_sec.$randomize1_pos4_fin;

    $randomize2_pos4_ini               = rand(1000, 9999);
    $randomize2_pos4_fin               = rand(1000, 9999);
    $cantidad_digito2                  = strlen($cod_administrador_sec);
    $codif2                            = $cantidad_digito2.$randomize2_pos4_ini.$cod_administrador_sec.$randomize2_pos4_fin;

    $randomize3_pos4_ini               = rand(1000, 9999);
    $randomize3_pos4_fin               = rand(1000, 9999);
    $cantidad_digito3                  = strlen($cod_sesion);
    $codif3                            = $cantidad_digito3.$randomize3_pos4_ini.$cod_sesion.$randomize3_pos4_fin;

    $randomize4_pos4_ini               = rand(1000, 9999);
    $randomize4_pos4_fin               = rand(1000, 9999);
    $cantidad_digito4                  = strlen($cod_tipo_historia_clinica_sec);
    $codif4                            = $cantidad_digito4.$randomize4_pos4_ini.$cod_tipo_historia_clinica_sec.$randomize4_pos4_fin;

    $codif_cod_seguridad_redondeo15    = str_pad($codif_cod_seguridad, 15, $randomize1_pos4_ini, STR_PAD_RIGHT);
    $cod_administrador_codif           = str_pad($codif2, 15, $randomize2_pos4_ini, STR_PAD_RIGHT);
    $tokn_codif                        = str_pad($codif3, 15, $randomize3_pos4_ini, STR_PAD_RIGHT);
    $cod_tipo_historia_clinica_codif   = str_pad($codif4, 15, $randomize4_pos4_ini, STR_PAD_RIGHT);

    $usuario_cryp                      = DAXCRYPTOR::encriptardax($usuario);
    $cod_seguridad_cryp                = DAXCRYPTOR::encriptardax($codif_cod_seguridad_redondeo15);
    $cod_administrador_cryp            = DAXCRYPTOR::encriptardax($cod_administrador_codif);
    $tokn_cryp                         = DAXCRYPTOR::encriptardax($tokn_codif);
    $cod_tipo_historia_clinica_cryp    = DAXCRYPTOR::encriptardax($cod_tipo_historia_clinica_codif);
    $nombres_cryp                      = DAXCRYPTOR::encriptardax($nombres_sec);
    $apellidos_cryp                    = DAXCRYPTOR::encriptardax($apellidos_sec);
    $nombre_sexo_cryp                  = DAXCRYPTOR::encriptardax($nombre_sexo_sec);

    // DESTRUIR variables vitales e inyectar nuevas (Impersonation completa)
    $_SESSION['cod_administrador']                = $cod_administrador_sec;
    $_SESSION['usuario']                          = $usuario;
    $_SESSION['usuario_cryp']                     = $usuario_cryp;
    $_SESSION['cs_cryp']                          = $cod_seguridad_cryp;
    $_SESSION['ca_cryp']                          = $cod_administrador_cryp;
    $_SESSION['tokn_cryp']                        = $tokn_cryp;
    $_SESSION['url_pag_redirec_ini_sesion_real']  = DAXCRYPTOR::encriptardax($url_pag_redirec_ini_sesion);
    $_SESSION['cod_tipo_historia_clinica_cryp']   = $cod_tipo_historia_clinica_cryp;
    $_SESSION['nombres_cryp']                     = $nombres_cryp;
    $_SESSION['apellidos_cryp']                   = $apellidos_cryp;
    $_SESSION['nombre_sexo_cryp']                 = $nombre_sexo_cryp;
    $_SESSION['cuenta_actual']                    = $usuario;
    $_SESSION['cod_estado_activacion_usuario']    = $cod_estado_activacion_usuario_sec;
    $_SESSION['cod_estado_multirol']              = $cod_estado_multirol_sec;
    $_SESSION['cod_administrador_padre_multirol'] = $cod_adm_padre_multirol_sec;
    $_SESSION['cod_seguridad']                    = $cod_seguridad_sec;
    
    // Devolvemos el EXITO con la URL final de redireccion para que el JS en verificacion.php mueva al usuario allá
    $res['status'] = 'success';
    $res['message'] = 'Identidad asimilada. Redireccionando...';
    $res['redirect_url'] = $url_pag_redirec_ini_sesion;

} else {
    $res['message'] = 'Perfil invàlido o no enlazado a su cuenta principal.';
}

echo json_encode($res);
?>
