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


$cod_orden_produccion_venta_producto_temporal        = intval($_GET['cod_orden_produccion_venta_producto_temporal']);
$cod_info_orden_produccion_factura_venta             = intval($_GET['cod_info_orden_produccion_factura_venta']);
$nombre_tipo_precio_venta                            = addslashes($_GET['nombre_tipo_precio_venta']);
$pagina                                              = addslashes($_GET['pagina']);

$sql_temporal = "SELECT * FROM tbl15_orden_produccion_venta_producto_temporal WHERE cod_orden_produccion_venta_producto_temporal = '$cod_orden_produccion_venta_producto_temporal'";
$consulta_temporal = mysqli_query($conectar, $sql_temporal);
$temporal = mysqli_fetch_assoc($consulta_temporal);

$cod_producto_barra                 = $temporal['cod_producto_barra'];
$und_venta                          = $temporal['und_venta'];

$sql_productos = "SELECT * FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$consulta_productos = mysqli_query($conectar, $sql_productos);
$productos = mysqli_fetch_assoc($consulta_productos);

$precio_venta_producto1            = $productos['precio_venta_producto'];
$precio_venta_producto2            = $productos['precio_venta_producto2'];
$precio_venta_producto3            = $productos['precio_venta_producto3'];
$precio_venta_producto4            = $productos['precio_venta_producto4'];
$precio_venta_producto5            = $productos['precio_venta_producto5'];

$total_precio_venta_producto1      = $und_venta * $precio_venta_producto1;
$total_precio_venta_producto2      = $und_venta * $precio_venta_producto2;
$total_precio_venta_producto3      = $und_venta * $precio_venta_producto3;
$total_precio_venta_producto4      = $und_venta * $precio_venta_producto4;
$total_precio_venta_producto5      = $und_venta * $precio_venta_producto5;


if ($nombre_tipo_precio_venta == 'PV1') {

$actualizar_sql = "UPDATE tbl15_orden_produccion_venta_producto_temporal SET nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', 
precio_venta_producto = '$precio_venta_producto1', total_venta_producto = '$total_precio_venta_producto1'
WHERE cod_orden_produccion_venta_producto_temporal = '$cod_orden_produccion_venta_producto_temporal'";
$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php }

if ($nombre_tipo_precio_venta == 'PV2') {

$actualizar_sql = "UPDATE tbl15_orden_produccion_venta_producto_temporal SET nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', 
precio_venta_producto = '$precio_venta_producto2', total_venta_producto = '$total_precio_venta_producto2' 
WHERE cod_orden_produccion_venta_producto_temporal = '$cod_orden_produccion_venta_producto_temporal'";
$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } 

if ($nombre_tipo_precio_venta == 'PV3') {

$actualizar_sql = "UPDATE tbl15_orden_produccion_venta_producto_temporal SET nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', 
precio_venta_producto = '$precio_venta_producto3', total_venta_producto = '$total_precio_venta_producto3' 
WHERE cod_orden_produccion_venta_producto_temporal = '$cod_orden_produccion_venta_producto_temporal'";
$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php }

if ($nombre_tipo_precio_venta == 'PV4') {

$actualizar_sql = "UPDATE tbl15_orden_produccion_venta_producto_temporal SET nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', 
precio_venta_producto = '$precio_venta_producto4', total_venta_producto = '$total_precio_venta_producto4'
WHERE cod_orden_produccion_venta_producto_temporal = '$cod_orden_produccion_venta_producto_temporal'";
$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } 

if ($nombre_tipo_precio_venta == 'PV5') {

$actualizar_sql = "UPDATE tbl15_orden_produccion_venta_producto_temporal SET nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', 
precio_venta_producto = '$precio_venta_producto5', total_venta_producto = '$total_precio_venta_producto5'
WHERE cod_orden_produccion_venta_producto_temporal = '$cod_orden_produccion_venta_producto_temporal'";
$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">-->
<?php } ?>