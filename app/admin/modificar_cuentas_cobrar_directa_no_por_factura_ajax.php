<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                = $_SESSION['usuario'];
$cod_administrador                     = $_SESSION['cod_administrador'];
$tipo_ajax                             = addslashes($_POST['tipo_ajax']);
$campo                                 = addslashes($_POST['campo']);
$valor                                 = addslashes($_POST['valor']);
$opcion                                = addslashes($_POST['opcion']);
// ------------------------------------------------------------------------------------------------- //
$cod_cuentas_cobrar                    = intval($_POST['cod_cuentas_cobrar']);
$cod_tercero                           = intval($_POST['cod_tercero']);
$cod_tipo_forma_pago                   = intval($_POST['cod_tipo_forma_pago']);
$abonado                               = $valor;
$mensaje                               = '';
$fecha_pago                            = date("Y-m-d");
$cod_dependencia                       = 1;
//-------------------------------------- -----------------------------------------------------------------//
$sql_cuenta_cobrar_factura = "SELECT cod_factura FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_cuenta_cobrar_factura = mysqli_query($conectar, $sql_cuenta_cobrar_factura) or die(mysqli_error($conectar));
$dato_cuenta_cobrar_factura = mysqli_fetch_assoc($consulta_cuenta_cobrar_factura);

$cod_factura                           = $dato_cuenta_cobrar_factura['cod_factura'];
//-------------------------------------- -----------------------------------------------------------------//
$fecha_anyo                            = date("Y-m-d", strtotime($fecha_pago));
$fecha_mes                             = date("Y-m", strtotime($fecha_pago));
$anyo                                  = date("Y", strtotime($fecha_pago));
$fecha_invert                          = date("Y-m-d", strtotime($fecha_pago));
$fecha_seg                             = strtotime($fecha_pago);
$hora                                  = date("H:i:s");

$sql_autoincremento_cuentas_cobrar_abonos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar_abonos'";
$exec_autoincremento_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
$datos_autoincremento_cuentas_cobrar_abonos = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar_abonos);
$cod_cuentas_cobrar_abonos             = $datos_autoincremento_cuentas_cobrar_abonos['AUTO_INCREMENT'];
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
$agregar_reg_cuentas_cobrar_abonos = "INSERT INTO tbl15_cuentas_cobrar_abonos (cod_tercero, cod_factura, abonado, cuenta, fecha_pago, fecha_anyo, fecha_mes, 
anyo, fecha_invert, fecha_seg, hora, mensaje, cod_administrador, cod_tipo_forma_pago, cod_dependencia, cod_cuentas_cobrar) 
VALUES ('$cod_tercero', '$cod_factura', '$abonado', '$cuenta_actual', '$fecha_pago', '$fecha_anyo', '$fecha_mes', 
'$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$mensaje', '$cod_administrador', '$cod_tipo_forma_pago', '$cod_dependencia', '$cod_cuentas_cobrar')";
$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $agregar_reg_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
$sql_cuenta_cobrar_factura = "SELECT monto_deuda, cod_info_factura_venta FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (cod_estado_archivado = '0')";
$consulta_cuenta_cobrar_factura = mysqli_query($conectar, $sql_cuenta_cobrar_factura) or die(mysqli_error($conectar));
$dato_cuenta_cobrar_factura = mysqli_fetch_assoc($consulta_cuenta_cobrar_factura);

$sql_total_abono_factura = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_cobrar_abonos WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (cod_estado_archivado = '0')";
$consulta_total_abono_factura = mysqli_query($conectar, $sql_total_abono_factura) or die(mysqli_error($conectar));
$total_abono_factura = mysqli_fetch_assoc($consulta_total_abono_factura);

$monto_deuda                                = $dato_cuenta_cobrar_factura['monto_deuda'];
$cod_info_factura_venta                     = $dato_cuenta_cobrar_factura['cod_info_factura_venta'];
$abonado_total                              = $total_abono_factura['abonado'];
$subtotal                                   = $monto_deuda - $abonado_total;

$actualizar_sql1 = sprintf("UPDATE tbl15_cuentas_cobrar SET abonado = '$abonado_total', subtotal = '$subtotal' WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar') AND (cod_estado_archivado = '0')");
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

$actualizar_sql1 = sprintf("UPDATE tbl15_info_factura_venta SET abonado = '$abonado_total', subtotal = '$subtotal' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
$respuesta_ajax['llave']                    = $cod_cuentas_cobrar_abonos;
$respuesta_ajax['abonado']                  = $abonado;
$respuesta_ajax['vlr_cancelado']            = 0;
$respuesta_ajax['vlr_vuelto']               = 0;
$respuesta_ajax['estado']                   = '1';
$respuesta_ajax['total_datos_data']         = 1;

echo json_encode($respuesta_ajax);
?>