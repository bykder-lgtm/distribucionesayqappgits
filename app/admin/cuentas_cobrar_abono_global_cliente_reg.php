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

$cod_tercero                    = intval($_POST['cod_tercero']);
$abonado_global                 = addslashes($_POST['abonado']);
$mensaje                        = addslashes($_POST['mensaje']);
$fecha_pago                     = addslashes($_POST['fecha_pago']);
$cod_tipo_forma_pago            = intval($_POST['cod_tipo_forma_pago']);
$cod_dependencia                = intval($_POST['cod_dependencia']);
$residuo                        = $abonado_global;
$contador = 0;
//-------------------------------------- -----------------------------------------------------------------//
$fecha_anyo                     = date("Y-m-d", strtotime($fecha_pago));
$fecha_mes                      = date("Y-m", strtotime($fecha_pago));
$anyo                           = date("Y", strtotime($fecha_pago));
$fecha_invert                   = date("Y-m-d", strtotime($fecha_pago));
$hora                           = date("H:i:s");
//-------------------------------------- -----------------------------------------------------------------//
$sql_tercero = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$exec_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
$datos_tercero = mysqli_fetch_assoc($exec_tercero);

$cliente                       = $datos_tercero['nombre1_tercero']." ".$datos_tercero['apellido1_tercero'];
//-------------------------------------- -----------------------------------------------------------------//
$sql_calcular_cod_abono_global = "SELECT MAX(cod_abono_global) AS cod_abono_global FROM tbl15_cuentas_cobrar_abonos";
$exec_calcular_cod_abono_global = mysqli_query($conectar, $sql_calcular_cod_abono_global) or die(mysqli_error($conectar));
$datos_calcular_cod_abono_global = mysqli_fetch_assoc($exec_calcular_cod_abono_global);
$cod_abono_global              = $datos_calcular_cod_abono_global['cod_abono_global']+1;
//-------------------------------------- -----------------------------------------------------------------//
$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.vendedor
FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero') AND (tbl15_cuentas_cobrar.subtotal > 0) ORDER BY tbl15_cuentas_cobrar.subtotal ASC LIMIT 0,1";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$subtotal_db               = $datos_cuenta_cobrar['subtotal'];
$cod_factura_db            = $datos_cuenta_cobrar['cod_factura'];
$cod_cuentas_cobrar_db     = $datos_cuenta_cobrar['cod_cuentas_cobrar'];

if ($abonado_global >= $subtotal_db) {
$smtr_val                  = 0;
$smtr_abonar               = 0;
//-------------------------------------- -----------------------------------------------------------------//
foreach($_POST["cod_cuentas_cobrar"] as $key => $cod_cuentas_cobrar) {

$sql_cuenta_cobrar = "SELECT monto_deuda, abonado, subtotal, cod_tercero, cod_factura, cod_cuentas_cobrar FROM tbl15_cuentas_cobrar WHERE (cod_cuentas_cobrar = '$cod_cuentas_cobrar')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_cuenta_cobrar) or die(mysqli_error($conectar));
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$monto_deuda                   = $datos_cuenta_cobrar['monto_deuda'];
$abonado                       = $datos_cuenta_cobrar['abonado'];
$abonar                        = $datos_cuenta_cobrar['subtotal'];
$cod_factura                   = $datos_cuenta_cobrar['cod_factura'];

$residuo                       = $residuo - $abonar;
$smtr_val                     += $abonado_global - $abonar;
$smtr_abonar                  += $abonar;
//-------------------------------------- -----------------------------------------------------------------//
if ($residuo >= 0) { 
$abono_residual                = $residuo;

$agreg_reg = "INSERT INTO tbl15_cuentas_cobrar_abonos (cod_tercero, cod_factura, abonado, cuenta, fecha_pago, fecha_anyo, 
fecha_mes, anyo, fecha_invert, hora, mensaje, cod_abono_global, cod_administrador, cod_tipo_forma_pago, cod_dependencia, cod_cuentas_cobrar) 
VALUES ('$cod_tercero', '$cod_factura', '$abonar', '$cuenta_actual', '$fecha_pago', '$fecha_anyo', 
'$fecha_mes', '$anyo', '$fecha_invert', '$hora', '$mensaje', '$cod_abono_global', '$cod_administrador', '$cod_tipo_forma_pago', '$cod_dependencia', '$cod_cuentas_cobrar')";
$resultado_tbl15_cuentas_cobrar_abonos = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
$sql_cuenta_cobrar_factura = "SELECT monto_deuda FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
$consulta_cuenta_cobrar_factura = mysqli_query($conectar, $sql_cuenta_cobrar_factura) or die(mysqli_error($conectar));
$dato_cuenta_cobrar_factura = mysqli_fetch_assoc($consulta_cuenta_cobrar_factura);

$sql_tot_abono_fact = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_cobrar_abonos WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
$consulta_total_abono_factura = mysqli_query($conectar, $sql_tot_abono_fact) or die(mysqli_error($conectar));
$total_abono_factura = mysqli_fetch_assoc($consulta_total_abono_factura);

$monto_deuda                   = $dato_cuenta_cobrar_factura['monto_deuda'];
$abonado_total                 = $total_abono_factura['abonado'];
$subtotal                      = $monto_deuda - $abonado_total;

$actualizar_sql1 = sprintf("UPDATE tbl15_cuentas_cobrar SET abonado = '$abonado_total', subtotal = '$subtotal' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
$deuda = $subtotal;

if ($deuda <= '0') { //$borrar_alerta  = sprintf("DELETE FROM notificacion_alerta WHERE cod_tercero = '$cod_tercero'"); //$Resultado1 = mysqli_query($borrar_alerta , $conectar) or die(mysqli_error($conectar)); 
}

$contador++;
}
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- -----------------------------------------------------------------//
if ($contador == $key) { 
$abonar                        = $abono_residual;

$agreg_reg = "INSERT INTO tbl15_cuentas_cobrar_abonos (cod_tercero, cod_factura, abonado, cuenta, fecha_pago, fecha_anyo, 
fecha_mes, anyo, fecha_invert, hora, mensaje, cod_abono_global, cod_administrador, cod_tipo_forma_pago, cod_dependencia, cod_cuentas_cobrar) 
VALUES ('$cod_tercero', '$cod_factura', '$abonar', '$cuenta_actual', '$fecha_pago', '$fecha_anyo', 
'$fecha_mes', '$anyo', '$fecha_invert', '$hora', '$mensaje', '$cod_abono_global', '$cod_administrador', '$cod_tipo_forma_pago', '$cod_dependencia', '$cod_cuentas_cobrar')";
$resultado_tbl15_cuentas_cobrar_abonos = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
$sql_cuenta_cobrar_factura = "SELECT monto_deuda FROM tbl15_cuentas_cobrar WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
$consulta_cuenta_cobrar_factura = mysqli_query($conectar, $sql_cuenta_cobrar_factura) or die(mysqli_error($conectar));
$dato_cuenta_cobrar_factura = mysqli_fetch_assoc($consulta_cuenta_cobrar_factura);

$sql_tot_abono_fact = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_cobrar_abonos WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'";
$consulta_total_abono_factura = mysqli_query($conectar, $sql_tot_abono_fact) or die(mysqli_error($conectar));
$total_abono_factura = mysqli_fetch_assoc($consulta_total_abono_factura);

$monto_deuda                   = $dato_cuenta_cobrar_factura['monto_deuda'];
$abonado_total                 = $total_abono_factura['abonado'];
$subtotal                      = $monto_deuda - $abonado_total;

$actualizar_sql1 = sprintf("UPDATE tbl15_cuentas_cobrar SET abonado = '$abonado_total', subtotal = '$subtotal' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
$deuda = $subtotal;

if ($deuda <= '0') { //$borrar_alerta  = sprintf("DELETE FROM notificacion_alerta WHERE cod_tercero = '$cod_tercero'"); //$Resultado1 = mysqli_query($borrar_alerta , $conectar) or die(mysqli_error($conectar)); 
}

}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/cuentas_cobrar_abono_global_opcion_imprimir.php?cod_abono_global=<?php echo $cod_abono_global ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>">
<?php
}
// FIN CONDICIONAL ($abonado_global >= $subtotal_db)
} else {
$sql_autoincremento_tbl15_cuentas_cobrar_abonos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar_abonos'";
$exec_autoincremento_tbl15_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_autoincremento_tbl15_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
$datos_autoincremento_tbl15_cuentas_cobrar_abonos = mysqli_fetch_assoc($exec_autoincremento_tbl15_cuentas_cobrar_abonos);
$cod_cuentas_cobrar_abonos = $datos_autoincremento_tbl15_cuentas_cobrar_abonos['AUTO_INCREMENT'];
//-------------------------------------- -----------------------------------------------------------------//
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
$agregar_reg_tbl15_cuentas_cobrar_abonos = "INSERT INTO tbl15_cuentas_cobrar_abonos (cod_tercero, cod_factura, abonado, cuenta, fecha_pago, fecha_anyo, 
fecha_mes, anyo, fecha_invert, hora, mensaje, cod_administrador, cod_tipo_forma_pago, cod_dependencia, cod_cuentas_cobrar) 
VALUES ('$cod_tercero', '$cod_factura_db', '$abonado_global', '$cuenta_actual', '$fecha_pago', '$fecha_anyo', 
'$fecha_mes', '$anyo', '$fecha_invert', '$hora', '$mensaje', '$cod_administrador', '$cod_tipo_forma_pago', '$cod_dependencia', '$cod_cuentas_cobrar')";
$resultado_tbl15_cuentas_cobrar_abonos = mysqli_query($conectar, $agregar_reg_tbl15_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
//-------------------------------------- REGISTRAR DATOS --------------------------------------//
$sql_cuenta_cobrar_factura = "SELECT monto_deuda FROM tbl15_cuentas_cobrar WHERE cod_factura = '$cod_cuentas_cobrar_db'";
$consulta_cuenta_cobrar_factura = mysqli_query($conectar, $sql_cuenta_cobrar_factura) or die(mysqli_error($conectar));
$dato_cuenta_cobrar_factura = mysqli_fetch_assoc($consulta_cuenta_cobrar_factura);

$sql_total_abono_factura = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_cobrar_abonos WHERE cod_factura = '$cod_cuentas_cobrar_db'";
$consulta_total_abono_factura = mysqli_query($conectar, $sql_total_abono_factura) or die(mysqli_error($conectar));
$total_abono_factura = mysqli_fetch_assoc($consulta_total_abono_factura);

$monto_deuda                   = $dato_cuenta_cobrar_factura['monto_deuda'];
$abonado_total                 = $total_abono_factura['abonado'];
$subtotal                      = $monto_deuda - $abonado_total;

$actualizar_sql1 = sprintf("UPDATE tbl15_cuentas_cobrar SET abonado = '$abonado_total', subtotal = '$subtotal' WHERE cod_factura = '$cod_cuentas_cobrar_db'");
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
//-------------------------------------- -----------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/cuentas_cobrar_opcion_imprimir.php?cod_cuentas_cobrar_abonos=<?php echo $cod_cuentas_cobrar_abonos ?>&cod_factura=<?php echo $cod_factura_db ?>&cod_tercero=<?php echo $cod_tercero ?>&cliente=<?php echo $cliente ?>">
<?php } ?>
<?php } ?>