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
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                           = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                         = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                       = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion                  = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                   = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                      = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                    = ($_SESSION['cod_cliente_sesion']);
//$cod_administrador                     = ($_SESSION['cod_administrador']);
$cod_base_caja                         = ($_SESSION['cod_base_caja']);

if (isset($_GET["cod_gasto_inmueble_inquilino_venta_temporal"])) {

$cod_gasto_inmueble_inquilino_venta_temporal     = intval($_GET['cod_gasto_inmueble_inquilino_venta_temporal']);
$cod_tipo_estado_incluido                        = intval($_GET['cod_tipo_estado_incluido']);
$cod_info_gasto_inmueble_inquilino_venta         = intval($_GET['cod_info_gasto_inmueble_inquilino_venta']);
$cuenta                                          = addslashes($_GET['cuenta']);
$cod_caja_virtual                                = addslashes($_GET['cod_caja_virtual']);
$pagina                                          = addslashes($_GET['pagina']);

$cod_cuentas_cobrar_alerta                       = intval($_GET['cod_cuentas_cobrar_alerta']);
$cod_cuentas_cobrar                              = intval($_GET['cod_cuentas_cobrar']);
$cod_factura                                     = intval($_GET['cod_factura']);
$numero_alerta                                   = intval($_GET['numero_alerta']);
$cod_tercero                                     = intval($_GET['cod_tercero']);
$cliente                                         = addslashes($_GET['cliente']);
$palabra                                         = addslashes($_GET['palabra']);

$pagina_redirect                                 = $pagina.'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_gasto_inmueble_inquilino_venta='.$cod_info_gasto_inmueble_inquilino_venta.'&cod_cuentas_cobrar_alerta='.$cod_cuentas_cobrar_alerta.'&cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_factura='.$cod_factura.'&numero_alerta='.$numero_alerta.'&cod_tercero='.$cod_tercero.'&cliente='.$cliente.'&palabra='.$palabra;
//-------------------------------------- -----------------------------------------------------------------//
if ($cod_tipo_estado_incluido == '0') { $cod_tipo_estado_incluido = '1'; } else { $cod_tipo_estado_incluido = '0'; }

$actualizar_sql1 = "UPDATE tbl15_gasto_inmueble_inquilino_venta_temporal SET cod_tipo_estado_incluido = '$cod_tipo_estado_incluido' WHERE (cod_gasto_inmueble_inquilino_venta_temporal = '$cod_gasto_inmueble_inquilino_venta_temporal')";
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>