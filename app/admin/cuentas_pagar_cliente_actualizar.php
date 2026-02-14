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

if (isset($_GET["cod_tercero"])) {
$cod_tercero             = intval($_GET['cod_tercero']);
$pagina                  = addslashes($_GET['pagina']);

$sql_cuenta_pagar = "SELECT cod_factura FROM tbl15_cuentas_pagar WHERE cod_tercero = '$cod_tercero'";
$consulta_cuenta_pagar = mysqli_query($conectar, $sql_cuenta_pagar) or die(mysqli_error($conectar));
$total_datos = mysqli_num_rows($consulta_cuenta_pagar);
while ($datos_cuenta_pagar = mysqli_fetch_assoc($consulta_cuenta_pagar)) {

$cod_factura             = $datos_cuenta_pagar['cod_factura'];

$sql_cuenta_pagar_factura = "SELECT monto_deuda FROM tbl15_cuentas_pagar WHERE cod_factura = '$cod_factura'";
$consulta_cuenta_pagar_factura = mysqli_query($conectar, $sql_cuenta_pagar_factura) or die(mysqli_error($conectar));
$dato_cuenta_pagar_factura = mysqli_fetch_assoc($consulta_cuenta_pagar_factura);

$sql_total_abono_factura = "SELECT SUM(abonado) AS abonado FROM tbl15_cuentas_pagar_abonos WHERE cod_factura = '$cod_factura'";
$consulta_total_abono_factura = mysqli_query($conectar, $sql_total_abono_factura) or die(mysqli_error($conectar));
$total_abono_factura = mysqli_fetch_assoc($consulta_total_abono_factura);

$monto_deuda             = $dato_cuenta_pagar_factura['monto_deuda'];
$abonado                 = $total_abono_factura['abonado'];
$subtotal                = $monto_deuda - $abonado;

$actualizar_sql1 = sprintf("UPDATE tbl15_cuentas_pagar SET abonado = '$abonado', subtotal = '$subtotal' WHERE cod_factura = '$cod_factura'");
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
<?php } ?>