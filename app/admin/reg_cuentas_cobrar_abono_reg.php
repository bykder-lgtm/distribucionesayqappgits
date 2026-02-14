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
//$cod_administrador       = ($_SESSION['cod_administrador']);
$cod_base_caja           = ($_SESSION['cod_base_caja']);

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "formulario_de_actualizacion")) {

$cod_cuentas_cobrar            = intval($_POST['cod_cuentas_cobrar']);
$cod_factura                   = intval($_POST['cod_factura']);
$cod_tercero                   = intval($_POST['cod_tercero']);
$abonado                       = addslashes($_POST['abonado']);
$mensaje                       = addslashes($_POST['mensaje']);
$fecha_pago                    = addslashes($_POST['fecha_pago']);
$cod_tipo_forma_pago           = intval($_POST['cod_tipo_forma_pago']);
$numero_alerta                 = intval($_POST['numero_alerta']);
$cod_cuentas_cobrar_alerta     = intval($_POST['cod_cuentas_cobrar_alerta']);
$cod_administrador             = intval($_POST['cod_administrador']);

if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
$cliente                       = "";
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_autoincremento_cuentas_cobrar_abonos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar_abonos'";
$exec_autoincremento_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
$datos_autoincremento_cuentas_cobrar_abonos = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar_abonos);
$cod_cuentas_cobrar_abonos = $datos_autoincremento_cuentas_cobrar_abonos['AUTO_INCREMENT'];
/* ----------------------------------------------------------------------------------------------------------/ */
$time                            = time();
$fecha_ymdHis                    = date("YmdHis");
$formato                         = 'jpg';
$fecha_hora                      = date("H:i:s");
$fecha_ymd                       = date("Y-m-d");

$ruta_firma_miniatura            = '../archivador/firma/miniatura/';
$ruta_foto_miniatura             = '../archivador/foto/miniatura/';
$ruta_firma_orig                 = '../archivador/firma/original/';
$ruta_foto_orig                  = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
if ($url_img1 <> '') { 
$formato_img2                    = explode(".", $url_img1);
$formato_img2                    = end($formato_img2);
$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_cuentas_cobrar.'_'.$cod_tercero.'_'.$cod_cuentas_cobrar_abonos.'.'.$formato_img2;
$url_img_orig_producto           = $ruta_foto_orig.$nombre_normal2;
$url_img_min_producto            = $ruta_foto_orig.$nombre_normal2;
} else { 
$formato_img2                    = "";
$formato_img2                    = "";
$nombre_normal2                  = "";
$url_img_orig_producto           = "";
$url_img_min_producto            = "";
}
//-------------------------------------- -----------------------------------------------------------------//
$fecha_anyo                      = date("Y-m-d", strtotime($fecha_pago));
$fecha_mes                       = date("Y-m", strtotime($fecha_pago));
$anyo                            = date("Y", strtotime($fecha_pago));
$fecha_invert                    = date("Y-m-d", strtotime($fecha_pago));
$fecha_seg                       = strtotime($fecha_pago);
$hora                            = date("H:i:s");
//-------------------------------------- -----------------------------------------------------------------//
$sql_cuentas_cobrar_alerta = "SELECT fecha_pago, monto_cuota FROM tbl15_cuentas_cobrar_alerta WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'";
$consulta_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_cuentas_cobrar_alerta) or die(mysqli_error($conectar));
$datos_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_cuentas_cobrar_alerta);

$monto_cuota_alerta              = $datos_cuentas_cobrar_alerta['monto_cuota'];
$fecha_pago_alerta               = $datos_cuentas_cobrar_alerta['fecha_pago'];
$fecha_pago_alerta_seg           = strtotime($fecha_pago_alerta);
$fecha_pago_seg                  = strtotime($fecha_pago);

if (($fecha_pago_seg > $fecha_pago_alerta_seg) || ($abonado < $monto_cuota_alerta)) { $cod_tipo_calificacion = "2"; $nombre_tipo_calificacion = "MALA"; } else { $cod_tipo_calificacion = "1"; $nombre_tipo_calificacion = "BUENA"; }
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
$agregar_reg_cuentas_cobrar_abonos = "INSERT INTO tbl15_cuentas_cobrar_abonos (cod_cuentas_cobrar, cod_tercero, cod_factura, abonado, cuenta, fecha_pago, 
fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, mensaje, cod_administrador, cod_tipo_forma_pago, 
cod_cuentas_cobrar_alerta, numero_alerta, url_img_orig_producto, url_img_min_producto, cod_tipo_calificacion, nombre_tipo_calificacion) 
VALUES ('$cod_cuentas_cobrar', '$cod_tercero', '$cod_factura', '$abonado', '$cuenta_actual', '$fecha_pago', 
'$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$mensaje', '$cod_administrador', '$cod_tipo_forma_pago', 
'$cod_cuentas_cobrar_alerta', '$numero_alerta', '$url_img_orig_producto', '$url_img_min_producto', '$cod_tipo_calificacion', '$nombre_tipo_calificacion')";
$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $agregar_reg_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
$sql_cuenta_cobrar_factura = "SELECT monto_deuda FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_cuenta_cobrar_factura = mysqli_query($conectar, $sql_cuenta_cobrar_factura) or die(mysqli_error($conectar));
$dato_cuenta_cobrar_factura = mysqli_fetch_assoc($consulta_cuenta_cobrar_factura);

$sql_total_abono_factura = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_cobrar_abonos WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
$consulta_total_abono_factura = mysqli_query($conectar, $sql_total_abono_factura) or die(mysqli_error($conectar));
$total_abono_factura = mysqli_fetch_assoc($consulta_total_abono_factura);

$monto_deuda                     = $dato_cuenta_cobrar_factura['monto_deuda'];
$abonado_total                   = $total_abono_factura['abonado'];
$subtotal                        = $monto_deuda - $abonado_total;
//-------------------------------------- -----------------------------------------------------------------//
$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar SET abonado = '$abonado_total', subtotal = '$subtotal', cod_tipo_calificacion = '$cod_tipo_calificacion', 
nombre_tipo_calificacion = '$nombre_tipo_calificacion' WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
$actualizar_sql1 = "UPDATE tbl15_cuentas_cobrar_alerta SET cod_cuentas_cobrar_abonos = '$cod_cuentas_cobrar_abonos', cod_estado = '1', 
cod_tipo_calificacion = '$cod_tipo_calificacion', nombre_tipo_calificacion = '$nombre_tipo_calificacion' WHERE (cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta')";
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
if ($url_img1 <> '') { 
copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
}
//-------------------------------------- -----------------------------------------------------------------//
$deuda = $subtotal;

if ($deuda <= '0') {
//$borrar_alerta  = sprintf("DELETE FROM notificacion_alerta WHERE cod_tercero = '$cod_tercero'");
//$Resultado1 = mysqli_query($borrar_alerta , $conectar) or die(mysqli_error($conectar));
} ?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/cuentas_cobrar_opcion_prestamo_imprimir.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos ?>&cod_cuentas_cobrar=<?php echo $cod_cuentas_cobrar ?>&cod_factura=<?php echo $cod_factura ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>">
<?php } ?>