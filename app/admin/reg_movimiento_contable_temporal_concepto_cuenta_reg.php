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
$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);

if (isset($_GET['cod_movimiento_contable'])) {

$cod_movimiento_contable              = intval($_GET['cod_movimiento_contable']);
$nombre_tipo_movimiento               = addslashes($_GET['nombre_tipo_movimiento']);
$nombre_tipo_documento                = addslashes($_GET['nombre_tipo_documento']);
$und_vendida                          = 1;
$nombre_nota_credito_concepto         = "";
$costo_nota_credito_concepto          = "";
$puc_nota_credito_concepto            = "";
$total_nota_credito                   = "";
$fecha_anyo                           = date("d/m/Y");
$fecha_mes                            = date("m/Y");
$fecha_seg                            = strtotime(date("Y/m/d"));
$fecha_ymd                            = date("Y/m/d");
$anyo                                 = date("Y");
$ip                                   = $_SERVER["REMOTE_ADDR"];
$cuenta                               = $cuenta_actual;

$agreg_reg = "INSERT INTO tbl15_movimiento_contable_temporal_concepto (cod_movimiento_contable, nombre_tipo_movimiento, 
nombre_tipo_documento, und_vendida, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta)
VALUES ('$cod_movimiento_contable', '$nombre_tipo_movimiento', 
'$nombre_tipo_documento', '$und_vendida', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta')";
$resultado_ventas = mysqlI_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/edit_movimiento_contable_cuenta_temporal.php?cod_movimiento_contable=<?php echo $cod_movimiento_contable?>">
<?php } ?>