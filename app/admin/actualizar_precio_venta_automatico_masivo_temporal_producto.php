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
$cuenta_actual                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                        = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                      = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                    = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion               = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                   = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                 = ($_SESSION['cod_cliente_sesion']);
$cod_administrador                  = ($_SESSION['cod_administrador']);
$cod_base_caja                      = ($_SESSION['cod_base_caja']);

if (isset($_GET['cod_info_factura_venta'])) {

$cod_info_factura_venta             = intval($_GET['cod_info_factura_venta']);
$nombre_tipo_precio_venta           = addslashes($_GET['nombre_tipo_precio_venta']);
$cuenta                             = addslashes($_GET['cuenta']);
$cod_caja_virtual                   = intval($_GET['cod_caja_virtual']);
$pagina                             = addslashes($_GET['pagina']);
$pagina_local                       = addslashes($_GET['pagina']).'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&pagina='.$pagina;

if ($nombre_tipo_precio_venta == 'PV1') {
	$precio_venta_producto_titulo = 'precio_venta_producto';
} elseif ($nombre_tipo_precio_venta == 'PV2') {
	$precio_venta_producto_titulo = 'precio_venta_producto2';
} elseif ($nombre_tipo_precio_venta == 'PV3') {
	$precio_venta_producto_titulo = 'precio_venta_producto3';
} elseif ($nombre_tipo_precio_venta == 'PV4') {
	$precio_venta_producto_titulo = 'precio_venta_producto4';
} elseif ($nombre_tipo_precio_venta == 'PV5') {
	$precio_venta_producto_titulo = 'precio_venta_producto5';
} else  {
	$precio_venta_producto_titulo = 'precio_venta_producto1';
}

$sql_venta_producto_temporal = "SELECT cod_venta_producto_temporal, cod_producto_barra, und_venta, precio_compra_producto, precio_venta_producto, nombre_tipo_precio_venta 
FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_tipo_precio_venta <> 'PVAR')";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

$cod_venta_producto_temporal       = $datos_venta_producto_temporal['cod_venta_producto_temporal'];
$cod_producto_barra                = $datos_venta_producto_temporal['cod_producto_barra'];
$und_venta                         = $datos_venta_producto_temporal['und_venta'];
$precio_compra_producto            = $datos_venta_producto_temporal['precio_compra_producto'];
$total_compra_producto             = $precio_compra_producto * $und_venta;

$sql_producto = "SELECT $precio_venta_producto_titulo AS precio_venta_producto_final, precio_venta_producto FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
$consulta_producto = mysqli_query($conectar, $sql_producto);
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$precio_venta_producto             = $datos_producto['precio_venta_producto_final'];

if ($precio_venta_producto <= 0) { $precio_venta_producto = $datos_producto['precio_venta_producto']; $nombre_tipo_precio_venta = 'PV1'; } else { $precio_venta_producto = $datos_producto['precio_venta_producto_final']; }

$total_venta_producto              = $precio_venta_producto * $und_venta;

if ($total_compra_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

$sql_data = sprintf("UPDATE tbl15_venta_producto_temporal SET precio_venta_producto = '$precio_venta_producto', total_venta_producto = '$total_venta_producto', 
nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', cod_estado_permitir_venta = '$cod_estado_permitir_venta' WHERE cod_venta_producto_temporal = '$cod_venta_producto_temporal'");
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_local?>">
<?php } ?>



