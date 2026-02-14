<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php'); 
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$cuenta_actual = addslashes($_SESSION['usuario']);

$tab                      = addslashes($_GET['tab']);
$tipo                     = addslashes($_GET['tipo']);
$campo                    = addslashes($_GET['campo']);
$pagina                   = addslashes($_GET['pagina']);

if ($tipo == 'eliminar' && $tab == 'tbl15_info_factura_auditoria') {
$cod_info_factura_auditoria             = intval($_GET['llave']);

$sql_factura_auditoria_producto = "SELECT * FROM tbl15_factura_auditoria_producto WHERE (cod_info_factura_auditoria = '$cod_info_factura_auditoria') 
ORDER BY cod_factura_auditoria_producto DESC";
$consulta_factura_auditoria_producto = mysqli_query($conectar, $sql_factura_auditoria_producto);
while ($datos_factura_auditoria_producto = mysqli_fetch_assoc($consulta_factura_auditoria_producto)) {

$cod_factura_auditoria_producto         = $datos_factura_auditoria_producto['cod_factura_auditoria_producto'];
$cod_factura                            = $datos_factura_auditoria_producto['cod_factura'];
$cod_producto                           = $datos_factura_auditoria_producto['cod_producto'];
$cod_producto_barra                     = $datos_factura_auditoria_producto['cod_producto_barra'];
$nombre_producto                        = $datos_factura_auditoria_producto['nombre_producto'];
$und_producto                           = $datos_factura_auditoria_producto['und_producto'];
$und_compra                             = $datos_factura_auditoria_producto['und_compra'];
$corregir_inventario                    = $datos_factura_auditoria_producto['corregir_inventario'];
$comentario                             = $datos_factura_auditoria_producto['comentario'];
$precio_compra_producto                 = $datos_factura_auditoria_producto['precio_compra_producto'];
$precio_costo_producto                  = $datos_factura_auditoria_producto['precio_costo_producto'];
$precio_venta_producto                  = $datos_factura_auditoria_producto['precio_venta_producto'];
$nombre_tipo_unidad_medida              = $datos_factura_auditoria_producto['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion               = $datos_factura_auditoria_producto['nombre_tipo_presentacion'];
$fecha_ymd_venta_producto               = $datos_factura_auditoria_producto['fecha_ymd_venta_producto'];
$fecha_mes_venta_producto               = $datos_factura_auditoria_producto['fecha_mes_venta_producto'];
$fecha_anyo_venta_producto              = $datos_factura_auditoria_producto['fecha_anyo_venta_producto'];
$fecha_seg_venta_producto               = $datos_factura_auditoria_producto['fecha_seg_venta_producto'];
$cod_administrador                      = $datos_factura_auditoria_producto['cod_administrador'];
$cuenta                                 = $datos_factura_auditoria_producto['cuenta'];

$agregar_reg_compra_producto = "INSERT INTO tbl15_factura_auditoria_producto_copia (cod_factura_auditoria_producto, cod_info_factura_auditoria, cod_producto, cod_producto_barra, nombre_producto, 
und_compra, und_producto, precio_compra_producto, precio_costo_producto, precio_venta_producto, nombre_tipo_unidad_medida, 
fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, 
nombre_tipo_precio_venta, cod_administrador, cuenta, comentario, corregir_inventario)
VALUES ('$cod_factura_auditoria_producto', '$cod_info_factura_auditoria', '$cod_producto', '$cod_producto_barra', '$nombre_producto', 
'$und_compra', '$und_producto', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', '$nombre_tipo_unidad_medida', 
'$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', 
'$nombre_tipo_precio_venta', '$cod_administrador', '$cuenta', '$comentario', '$corregir_inventario')";
$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));
}
$borrar_sql = sprintf("DELETE FROM tbl15_info_factura_auditoria WHERE cod_info_factura_auditoria = '$cod_info_factura_auditoria'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM tbl15_factura_auditoria_producto WHERE cod_info_factura_auditoria = '$cod_info_factura_auditoria'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$pagina_redirect = $pagina."?cod_info_factura_auditoria=".$cod_info_factura_auditoria;
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>
