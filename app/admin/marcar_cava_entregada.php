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


if (isset($_GET['cod_info_factura_venta'])) {

$cod_info_factura_venta             = intval($_GET['cod_info_factura_venta']);
$cod_venta_producto                 = intval($_GET['cod_venta_producto']);
$pagina                             = '../admin/edit_factura_venta.php'.'?cod_info_factura_venta='.$cod_info_factura_venta.'&cod_venta_producto='.$cod_venta_producto;

	if ($cod_venta_producto == '0') {
		$sql_und_cava_debol = "SELECT SUM(und_venta) AS total_und_debol FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_estado_cava = '1')";
		$consulta_und_cava_debol = mysqli_query($conectar, $sql_und_cava_debol) or die(mysqli_error($conectar));
		$datos_und_cava_debol = mysqli_fetch_assoc($consulta_und_cava_debol);

		$total_und_debol                  = $datos_und_cava_debol['total_und_debol'];

		$actualizar_sql = "UPDATE tbl15_info_factura_venta SET cod_estado_cava = '0' WHERE cod_info_factura_venta = '$cod_info_factura_venta'"; 
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql); 

		$actualizar_sql = "UPDATE tbl15_venta_producto SET cod_estado_cava = '0' WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);

		$sql_und_producto = "SELECT und_producto FROM tbl15_producto WHERE (cod_producto_barra = '55555555')";
		$consulta_und_producto = mysqli_query($conectar, $sql_und_producto) or die(mysqli_error($conectar));
		$datos_und_producto = mysqli_fetch_assoc($consulta_und_producto);

		$und_producto                  = $datos_und_producto['und_producto'] + $total_und_debol;

		$actualizar_sql = "UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '55555555'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);
	} else {
		$sql_und_cava_debol = "SELECT und_venta AS total_und_debol FROM tbl15_venta_producto WHERE (cod_venta_producto = '$cod_venta_producto')";
		$consulta_und_cava_debol = mysqli_query($conectar, $sql_und_cava_debol) or die(mysqli_error($conectar));
		$datos_und_cava_debol = mysqli_fetch_assoc($consulta_und_cava_debol);

		$total_und_debol                  = $datos_und_cava_debol['total_und_debol'];

		$actualizar_sql = "UPDATE tbl15_venta_producto SET cod_estado_cava = '0' WHERE cod_venta_producto = '$cod_venta_producto'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);

		$sql_total_venta_credito = "SELECT cod_estado_cava FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_estado_cava = '1')";
		$consulta_total_venta_credito = mysqli_query($conectar, $sql_total_venta_credito) or die(mysqli_error($conectar));
		$existe_cava_sin_entregar = mysqli_num_rows($consulta_total_venta_credito);

		$sql_und_producto = "SELECT und_producto FROM tbl15_producto WHERE (cod_producto_barra = '55555555')";
		$consulta_und_producto = mysqli_query($conectar, $sql_und_producto) or die(mysqli_error($conectar));
		$datos_und_producto = mysqli_fetch_assoc($consulta_und_producto);

		$und_producto                  = $datos_und_producto['und_producto'] + $total_und_debol;

		$actualizar_sql = "UPDATE tbl15_producto SET und_producto = '$und_producto' WHERE cod_producto_barra = '55555555'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);

		if ($existe_cava_sin_entregar == '0') { 
			$actualizar_sql = "UPDATE tbl15_info_factura_venta SET cod_estado_cava = '0' WHERE cod_info_factura_venta = '$cod_info_factura_venta'"; 
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql); 
		}
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php
}
?>
