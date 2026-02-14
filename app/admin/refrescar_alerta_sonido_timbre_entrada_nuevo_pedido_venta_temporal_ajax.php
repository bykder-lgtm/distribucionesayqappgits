<?php 
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
//$cuenta_actual = addslashes($_SESSION['usuario']);
$cuenta_actual                       = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                         = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                       = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                     = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion                = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                 = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                    = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                  = ($_SESSION['cod_cliente_sesion']);
$cod_administrador                   = ($_SESSION['cod_administrador']);
$cod_base_caja                       = ($_SESSION['cod_base_caja']);
$cod_seguridad                       = ($_SESSION['cod_seguridad']);
$cod_caja_virtual                    = ($_SESSION['cod_caja_virtual']);
$token                               = ($_SESSION['token']);
$cod_estado_timbre_entrada           = '1';

if (isset($_REQUEST['verificar_pedido_venta_temporal'])) {

$mostrar_datos_sql = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_estado_timbre_entrada = '0') LIMIT 0,1";
$consulta = mysqli_query($conectar, $mostrar_datos_sql);
$total_registro = mysqli_num_rows($consulta);
$info_data = mysqli_fetch_assoc($consulta);

$cod_info_factura_venta              = $info_data['cod_info_factura_venta'];

if ($total_registro <> '0') { 
$agregar_regis = "UPDATE tbl15_info_factura_venta SET cod_estado_timbre_entrada = '$cod_estado_timbre_entrada' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
?>
<audio autoplay><source src="../sonidos/timbre_entrada_pedido_temporal_cocina.mp3" type="audio/mp3">Tu navegador no soporta HTML5 audio.</audio>
<?php } ?>
<?php } ?>