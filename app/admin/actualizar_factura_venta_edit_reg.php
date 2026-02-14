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

if (isset($_GET["cod_info_factura_venta"])) {
$cod_info_factura_venta             = intval($_GET['cod_info_factura_venta']);
$pagina                             = addslashes($_GET['pagina'])."?cod_info_factura_venta=".$cod_info_factura_venta;

$sql_calc_total_venta = "SELECT SUM(total_venta_producto) AS total_precio_venta,  SUM(total_compra_producto) AS total_precio_compra 
FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_calc_total_venta = mysqli_query($conectar, $sql_calc_total_venta) or die(mysqli_error($conectar));
$dato_calc_total_venta = mysqli_fetch_assoc($consulta_calc_total_venta);

$total_precio_compra                = $dato_calc_total_venta['total_precio_compra'];
$total_precio_venta                 = $dato_calc_total_venta['total_precio_venta'];

$actualizar_sql1 = sprintf("UPDATE tbl15_info_factura_venta SET total_precio_compra = '$total_precio_compra', total_precio_venta = '$total_precio_venta' 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
<?php } ?>