<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                                        = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                                      = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                                    = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion                               = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                                = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                                   = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                                 = ($_SESSION['cod_cliente_sesion']);
//$cod_administrador                                  = ($_SESSION['cod_administrador']);
$cod_base_caja                                      = ($_SESSION['cod_base_caja']);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formulario_de_actualizacion")) {

$cod_egreso                                         = intval($_POST['cod_egreso']);
$fecha_dmy_ini                                      = addslashes($_POST['fecha_dmy_ini']);
$fecha_dmy_fin                                      = addslashes($_POST['fecha_dmy_fin']);
$cod_tipo_forma_pago                                = intval($_POST['cod_tipo_forma_pago']);
$cod_dependencia                                    = intval($_POST['cod_dependencia']);
$nombre_tipo_puc                                    = addslashes($_POST['nombre_tipo_puc']);
$pagina                                             = addslashes($_POST['pagina']);
$palabra                                            = '';

$pagina_redirect                                    = '../admin/lista_egreso_ingreso_movimiento_caja_inmobiliaria.php'.'?fecha_dmy_ini='.$fecha_dmy_ini.'&fecha_dmy_fin='.$fecha_dmy_fin.'&cod_tipo_forma_pago='.$cod_tipo_forma_pago.'&cod_dependencia='.$cod_dependencia.'&nombre_tipo_puc='.$nombre_tipo_puc;

if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
/* ----------------------------------------------------------------------------------------------------------/ */
$time                                               = time();
$fecha_ymdHis                                       = date("YmdHis");
$formato                                            = 'jpg';
$fecha_hora                                         = date("H:i:s");
$fecha_ymd                                          = date("Y-m-d");

$ruta_firma_miniatura                               = '../archivador/firma/miniatura/';
$ruta_foto_miniatura                                = '../archivador/foto/miniatura/';
$ruta_firma_orig                                    = '../archivador/firma/original/';
$ruta_foto_orig                                     = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
if ($url_img1 <> '') { 
$formato_img2                                       = explode(".", $url_img1);
$formato_img2                                       = end($formato_img2);
$nombre_normal2                                     = $fecha_ymdHis.'_'.$nombre_tipo_puc.'_'.$cod_egreso.'.'.$formato_img2;
$url_img_orig_producto                              = $ruta_foto_orig.$nombre_normal2;
$url_img_min_producto                               = $ruta_foto_orig.$nombre_normal2;
} else { 
$formato_img2                                       = "";
$formato_img2                                       = "";
$nombre_normal2                                     = "";
$url_img_orig_producto                              = "";
$url_img_min_producto                               = "";
}
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
$actualizar_sql1 = "UPDATE tbl15_egreso SET url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto' WHERE (cod_egreso = '$cod_egreso')";
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
if ($url_img1 <> '') { copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto); }
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>