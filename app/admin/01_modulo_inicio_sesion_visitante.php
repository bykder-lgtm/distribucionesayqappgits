<?php
include_once('../conexiones/conexione.php');
include_once('../gestor_administrar_msj_alerta_error/gestor_alerta_error.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

session_start();

if ((isset($_SESSION['inicio_sesion'])) && ($_SESSION['inicio_sesion'] == 'SI')) {

$cod_administrador                      = $_SESSION['cod_administrador'];

$sql_usuario = "SELECT cod_administrador, cod_seguridad, cuenta, contrasena, 
correo, estilo_css, nombres, apellidos, nombre_sexo, telefono
FROM tbl15_administrador WHERE (cod_administrador = $cod_administrador)";
$consultar_usuario = mysqli_query($conectar, $sql_usuario) or die(mysqli_error($conectar));
$datos_usuar = mysqli_fetch_array($consultar_usuario);

$cuenta                                = $_SESSION['cuenta'];
$cuenta_actual                         = $_SESSION['cuenta'];
$cod_caja_virtual                      = $_SESSION['cod_caja_virtual'];
$vendedor_usuario                      = $_SESSION['cuenta'];
$usuario_cryp                          = $_SESSION['usuario_cryp'];
$cs_cryp                               = $_SESSION['cs_cryp'];
$ca_cryp                               = $_SESSION['ca_cryp'];
$tokn_cryp                             = $_SESSION['tokn_cryp'];
$pag_redirec_sesion_cryp               = $_SESSION['pag_redirec_sesion_cryp'];
$vendedor                              = $_SESSION['vendedor'];
$estilo_css                            = $_SESSION['estilo_css'];
$tipo_usuario                          = $_SESSION['tipo_usuario'];
$tipo_menu                             = $_SESSION['tipo_menu'];
$cod_administrador                     = $_SESSION['cod_administrador'];
$cod_seguridad                         = $_SESSION['cod_seguridad'];
$vendedor_codifcryp                    = $_SESSION['vendedor_codifcryp'];
$token                                 = $_SESSION['token'];
$inicio_sesion                         = 'SI';
$tipo_menu                             = 'usuario';
$pagina_salir_visitante                = '../admin/iniciar_sesion_visitante.php';
} else {
$_SESSION['inicio_sesion']             = 'NO';
$_SESSION['tipo_menu']                 = 'visitante';
$inicio_sesion                         = $_SESSION['inicio_sesion'];
$tipo_menu                             = $_SESSION['tipo_menu'];
$global_var                            = (microtime(true));
$vendedor                              = $global_var;
$pagina_salir_visitante                = '../admin/iniciar_sesion_visitante.php';
}
?>