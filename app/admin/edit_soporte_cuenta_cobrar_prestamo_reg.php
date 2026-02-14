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
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des             = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des           = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des         = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion    = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion     = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo        = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion      = ($_SESSION['cod_cliente_sesion']);
$cod_administrador       = ($_SESSION['cod_administrador']);
$cod_base_caja           = ($_SESSION['cod_base_caja']);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formulario_de_actualizacion")) {

$cod_cuentas_cobrar            = intval($_POST['cod_cuentas_cobrar']);
$cod_factura                   = intval($_POST['cod_factura']);
$cod_tercero                   = intval($_POST['cod_tercero']);
if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
$cliente                       = "";
/* ----------------------------------------------------------------------------------------------------------/ */
$time                            = time();
$fecha_ymdHis                    = date("YmdHis");
$formato                         = 'jpg';
$fecha_hora                      = date("H:i:s");
$fecha_ymd                       = date("Y-m-d");
/* ----------------------------------------------------------------------------------------------------------/ */
$ruta_firma_miniatura            = '../archivador/firma/miniatura/';
$ruta_foto_miniatura             = '../archivador/foto/miniatura/';
$ruta_firma_orig                 = '../archivador/firma/original/';
$ruta_foto_orig                  = '../archivador/documentos/';

$formato_img2                    = explode(".", $url_img1);
$formato_img2                    = end($formato_img2);
$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_cuentas_cobrar.'_'.$cod_tercero.'.'.$formato_img2;
$url_img_orig_producto           = $ruta_foto_orig.$nombre_normal2;
$url_img_min_producto            = $ruta_foto_orig.$nombre_normal2;
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
$actualizar_sql1 = sprintf("UPDATE tbl15_cuentas_cobrar SET url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto' 
WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
if ($url_img1 <> '') { 
copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
}
//-------------------------------------- -----------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/cuentas_cobrar_detalle_factura_tercero_prestamo.php?&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_factura=<?php echo $cod_factura ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>">
<?php } ?>