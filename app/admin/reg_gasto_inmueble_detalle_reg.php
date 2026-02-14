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

if (isset($_GET['cod_gasto_inmueble'])) {

$cod_gasto_inmueble                                 = intval($_GET['cod_gasto_inmueble']);
$cod_cuentas_cobrar_factura_comision_propietario    = intval($_GET['cod_cuentas_cobrar_factura_comision_propietario']);
$cod_cuentas_cobrar                                 = intval($_GET['cod_cuentas_cobrar']);
$cod_cuentas_cobrar_alerta                          = intval($_GET['cod_cuentas_cobrar_alerta']);
$fecha_mes                                          = addslashes($_GET['fecha_mes']);
$nombre_tabla_mes                                   = addslashes($_GET['nombre_tabla_mes']);
$nombre_tabla_anyo                                  = addslashes($_GET['nombre_tabla_anyo']);
$cod_estado_envio_correo_cuenta_cobro               = addslashes($_GET['cod_estado_envio_correo_cuenta_cobro']);
$cod_factura                                        = addslashes($_GET['cod_factura']);
$numero_alerta                                      = addslashes($_GET['numero_alerta']);
$cod_tercero                                        = intval($_GET['cod_tercero']);
$cliente                                            = intval($_GET['cliente']);
$cod_estado_hoy                                     = intval($_GET['cod_estado_hoy']);
$cod_estado_pago                                    = intval($_GET['cod_estado_pago']);
$buscar_por                                         = addslashes($_GET['buscar_por']);
$foco                                               = addslashes($_GET['foco']);
$pagina                                             = addslashes($_GET['pagina']);
$pagina_redirect                                    = '../admin/edit_cuentas_cobrar_abonos_alquiler_comprobante_comision_propietario.php'."?cod_cuentas_cobrar_factura_comision_propietario=".$cod_cuentas_cobrar_factura_comision_propietario."&cod_cuentas_cobrar=".$cod_cuentas_cobrar."&cod_cuentas_cobrar_alerta=".$cod_cuentas_cobrar_alerta."&fecha_mes=".$fecha_mes."&nombre_tabla_mes=".$nombre_tabla_mes."&nombre_tabla_anyo=".$nombre_tabla_anyo."&cod_estado_envio_correo_cuenta_cobro=".$cod_estado_envio_correo_cuenta_cobro."&cod_factura=".$cod_factura."&numero_alerta=".$numero_alerta."&cod_tercero=".$cod_tercero."&cliente=".$cliente."&cod_estado_hoy=".$cod_estado_hoy."&cod_estado_pago=".$cod_estado_pago."&buscar_por=".$buscar_por."&foco=".$foco."&pagina=".$pagina;

$sql_gasto_inmueble = "SELECT nombre_gasto_inmueble FROM tbl15_gasto_inmueble WHERE cod_gasto_inmueble = '$cod_gasto_inmueble'";
$consulta_gasto_inmueble = mysqli_query($conectar, $sql_gasto_inmueble) or die(mysqli_error($conectar));
$matriz_gasto_inmueble = mysqli_fetch_assoc($consulta_gasto_inmueble);

$nombre_gasto_inmueble_detalle                      = $matriz_gasto_inmueble['nombre_gasto_inmueble'];

$sql_cuentas_cobrar_alerta = "SELECT * FROM tbl15_cuentas_cobrar_alerta  WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
$consulta_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta) or die(mysqli_error($conectar));
$matriz_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta);

$cod_cuentas_cobrar_abonos                          = $matriz_cuentas_cobrar_alerta['cod_cuentas_cobrar_abonos'];
$cod_tercero_propietario                            = $matriz_cuentas_cobrar_alerta['cod_tercero_propietario'];
$cod_producto                                       = $matriz_cuentas_cobrar_alerta['cod_producto'];
$cod_producto_barra                                 = $matriz_cuentas_cobrar_alerta['cod_producto_barra'];
$nombre_producto                                    = $matriz_cuentas_cobrar_alerta['nombre_producto'];
$fecha_gasto_inmueble_detalle                       = date("Y-m-d");
$fecha                                              = $fecha_gasto_inmueble_detalle;
$fecha_mes                                          = date("Y-m", strtotime($fecha_gasto_inmueble_detalle));
$anyo                                               = date("Y", strtotime($fecha_gasto_inmueble_detalle));
$fecha_invert                                       = $fecha_gasto_inmueble_detalle;
$fecha_seg                                          = time();
$fecha_creacion                                     = date("Y-m-d H:i:s");
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_data = "INSERT INTO tbl15_gasto_inmueble_detalle (cod_gasto_inmueble, nombre_gasto_inmueble_detalle, cod_cuentas_cobrar_factura_comision_propietario, cod_cuentas_cobrar, cod_cuentas_cobrar_alerta, cod_cuentas_cobrar_abonos, cod_factura, cod_tercero, 
cod_tercero_propietario, cod_producto, cod_producto_barra, nombre_producto, fecha_gasto_inmueble_detalle, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, fecha_creacion) 
VALUES ('$cod_gasto_inmueble', '$nombre_gasto_inmueble_detalle', '$cod_cuentas_cobrar_factura_comision_propietario', '$cod_cuentas_cobrar', '$cod_cuentas_cobrar_alerta', '$cod_cuentas_cobrar_abonos', '$cod_factura', '$cod_tercero', 
'$cod_tercero_propietario', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$fecha_gasto_inmueble_detalle', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$fecha_creacion')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>