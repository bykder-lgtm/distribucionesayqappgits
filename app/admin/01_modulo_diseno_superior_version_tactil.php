<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../admin/detectar_tipo_dispositivo.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
//$cuenta_actual = addslashes($_SESSION['usuario']);
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                           = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                         = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                       = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion                  = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                   = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                      = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                    = ($_SESSION['cod_cliente_sesion']);
$cod_administrador                     = ($_SESSION['cod_administrador']);
$cod_base_caja                         = ($_SESSION['cod_base_caja']);
$cod_seguridad                         = ($_SESSION['cod_seguridad']);
$cod_caja_virtual                      = ($_SESSION['cod_caja_virtual']);
$token                                 = ($_SESSION['token']);

$cuenta                                = $cuenta_actual;
$vendedor_usuario                      = $cuenta_actual;
$vendedor                              = $cuenta_actual;
$usuario_cryp                          = $cuenta_actual;
$cs_cryp                               = $_SESSION['cs_cryp'];
$ca_cryp                               = $_SESSION['ca_cryp'];
$tokn_cryp                             = $_SESSION['token'];
$pag_redirec_sesion_cryp               = $_SESSION['pag_redirec_sesion_cryp'];
$estilo_css                            = $_SESSION['estilo_css'];
$tipo_usuario                          = $_SESSION['tipo_usuario'];
$vendedor_codifcryp                    = $_SESSION['vendedor_codifcryp'];
$inicio_sesion                         = $_SESSION['inicio_sesion'];
$tipo_menu                             = $_SESSION['tipo_menu'];
$pagina_salir_visitante                = $_SESSION['pagina_salir_visitante'];
$descripcion_producto                  = "";
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_seguridad_des  = DAXCRYPTOR::descriptardax($_SESSION['cs_cryp']);
$cod_seguridad_codif = ($cod_seguridad_des);
$frag1 = str_split($cod_seguridad_codif);
$numero_de_digitos1 = $frag1[0];
if ($numero_de_digitos1 == 1) { $cod_seguridad = $frag1[5]; } 
if ($numero_de_digitos1 == 2) { $cod_seguridad = $frag1[5].$frag1[6]; } 
if ($numero_de_digitos1 == 3) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7]; } 
if ($numero_de_digitos1 == 4) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8]; } 
if ($numero_de_digitos1 == 5) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9]; } 
if ($numero_de_digitos1 == 6) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10]; } 
if ($numero_de_digitos1 == 7) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11]; }
if ($numero_de_digitos1 == 8) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12]; }
if ($numero_de_digitos1 == 9) { $cod_seguridad = $frag1[5].$frag1[6].$frag1[7].$frag1[8].$frag1[9].$frag1[10].$frag1[11].$frag1[12].$frag1[13]; }
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_administrador_des = DAXCRYPTOR::descriptardax($_SESSION['ca_cryp']);
$cod_administrador_codif = ($cod_administrador_des);
$frag2 = str_split($cod_administrador_codif);
$numero_de_digitos2 = $frag2[0];
if ($numero_de_digitos2 == 1) { $cod_administrador = $frag2[5]; } 
if ($numero_de_digitos2 == 2) { $cod_administrador = $frag2[5].$frag2[6]; } 
if ($numero_de_digitos2 == 3) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7]; } 
if ($numero_de_digitos2 == 4) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7].$frag2[8]; } 
if ($numero_de_digitos2 == 5) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7].$frag2[8].$frag2[9]; } 
if ($numero_de_digitos2 == 6) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7].$frag2[8].$frag2[9].$frag2[10]; } 
if ($numero_de_digitos2 == 7) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7].$frag2[8].$frag2[9].$frag2[10].$frag2[11]; }
if ($numero_de_digitos2 == 8) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7].$frag2[8].$frag2[9].$frag2[10].$frag2[11].$frag2[12]; }
if ($numero_de_digitos2 == 9) { $cod_administrador = $frag2[5].$frag2[6].$frag2[7].$frag2[8].$frag2[9].$frag2[10].$frag2[11].$frag2[12].$frag2[13]; }
//---------------------------------------------------------------------------------------------------------------------------------//
$tokn_des = DAXCRYPTOR::descriptardax($_SESSION['tokn_cryp']);
$cod_sesion_codif = ($tokn_des);
$frag3 = str_split($cod_sesion_codif);
$numero_de_digitos3 = $frag3[0];
if ($numero_de_digitos3 == 1) { $cod_sesion = $frag3[5]; } 
if ($numero_de_digitos3 == 2) { $cod_sesion = $frag3[5].$frag3[6]; } 
if ($numero_de_digitos3 == 3) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7]; } 
if ($numero_de_digitos3 == 4) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7].$frag3[8]; } 
if ($numero_de_digitos3 == 5) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7].$frag3[8].$frag3[9]; } 
if ($numero_de_digitos3 == 6) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7].$frag3[8].$frag3[9].$frag3[10]; } 
if ($numero_de_digitos3 == 7) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7].$frag3[8].$frag3[9].$frag3[10].$frag3[11]; }
if ($numero_de_digitos3 == 8) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7].$frag3[8].$frag3[9].$frag3[10].$frag3[11].$frag3[12]; }
if ($numero_de_digitos3 == 9) { $cod_sesion = $frag3[5].$frag3[6].$frag3[7].$frag3[8].$frag3[9].$frag3[10].$frag3[11].$frag3[12].$frag3[13]; }
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_tipo_historia_clinica_des = DAXCRYPTOR::descriptardax($_SESSION['cod_tipo_historia_clinica_cryp']);
$cod_tipo_historia_clinica_codif = ($cod_tipo_historia_clinica_des);
$frag4 = str_split($cod_tipo_historia_clinica_codif);
$numero_de_digitos4 = $frag4[0];
if ($numero_de_digitos4 == 1) { $cod_tipo_historia_clinica = $frag4[5]; } 
if ($numero_de_digitos4 == 2) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6]; } 
if ($numero_de_digitos4 == 3) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7]; } 
if ($numero_de_digitos4 == 4) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7].$frag4[8]; } 
if ($numero_de_digitos4 == 5) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7].$frag4[8].$frag4[9]; } 
if ($numero_de_digitos4 == 6) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7].$frag4[8].$frag4[9].$frag4[10]; } 
if ($numero_de_digitos4 == 7) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7].$frag4[8].$frag4[9].$frag4[10].$frag4[11]; }
if ($numero_de_digitos4 == 8) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7].$frag4[8].$frag4[9].$frag4[10].$frag4[11].$frag4[12]; }
if ($numero_de_digitos4 == 9) { $cod_tipo_historia_clinica = $frag4[5].$frag4[6].$frag4[7].$frag4[8].$frag4[9].$frag4[10].$frag4[11].$frag4[12].$frag4[13]; }
//---------------------------------------------------------------------------------------------------------------------------------//
$pag_redirec_sesion = DAXCRYPTOR::descriptardax($_SESSION['pag_redirec_sesion_cryp']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
?>