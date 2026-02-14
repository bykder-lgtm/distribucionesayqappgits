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
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_bascula_balanza_electronica_pesar_producto_global      = $info_empresa_data['cod_estado_bascula_balanza_electronica_pesar_producto_global'];
$cod_estado_bascula_balanza_cod_barras_pesar_producto_global       = $info_empresa_data['cod_estado_bascula_balanza_cod_barras_pesar_producto_global'];
$cod_estado_limite_venta_pos_factura_electronica_global            = $info_empresa_data['cod_estado_limite_venta_pos_factura_electronica_global'];
$limite_venta_pos_factura_electronica                              = $info_empresa_data['limite_venta_pos_factura_electronica'];
// ------------------------------------------------------------------------------------------------- //
$cod_cotizacion_venta_producto_temporal                            = intval($_GET['cod_cotizacion_venta_producto_temporal']);
$cod_info_cotizacion_factura_venta                                 = intval($_GET['cod_info_cotizacion_factura_venta']);
$nombre_tipo_precio_venta                                          = addslashes($_GET['nombre_tipo_precio_venta']);
$cuenta                                                            = addslashes($_GET['cuenta']);
$cod_caja_virtual                                                  = intval($_GET['cod_caja_virtual']);
$pagina                                                            = addslashes($_GET['pagina']).'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual;

$sql_temporal = "SELECT * FROM tbl15_cotizacion_venta_producto_temporal WHERE cod_cotizacion_venta_producto_temporal = '$cod_cotizacion_venta_producto_temporal'";
$consulta_temporal = mysqli_query($conectar, $sql_temporal);
$temporal = mysqli_fetch_assoc($consulta_temporal);

$cod_producto_barra                 = $temporal['cod_producto_barra'];
$und_venta                          = $temporal['und_venta'];
$precio_compra_producto             = $temporal['precio_compra_producto'];
$total_compra_producto              = $precio_compra_producto * $und_venta;

$sql_productos = "SELECT * FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
$consulta_productos = mysqli_query($conectar, $sql_productos);
$productos = mysqli_fetch_assoc($consulta_productos);

if ($productos['precio_venta_producto'] == '0') { $precio_venta_producto1 = $productos['precio_venta_producto']; } else {$precio_venta_producto1 = $productos['precio_venta_producto']; }
if ($productos['precio_venta_producto2'] == '0') { $precio_venta_producto2 = $precio_venta_producto1; } else {$precio_venta_producto2 = $productos['precio_venta_producto2']; }
if ($productos['precio_venta_producto3'] == '0') { $precio_venta_producto3 = $precio_venta_producto1; } else {$precio_venta_producto3 = $productos['precio_venta_producto3']; }
if ($productos['precio_venta_producto4'] == '0') { $precio_venta_producto4 = $precio_venta_producto1; } else {$precio_venta_producto4 = $productos['precio_venta_producto4']; }
if ($productos['precio_venta_producto5'] == '0') { $precio_venta_producto5 = $precio_venta_producto1; } else {$precio_venta_producto5 = $productos['precio_venta_producto5']; }

$total_precio_venta_producto1      = $und_venta * $precio_venta_producto1;
$total_precio_venta_producto2      = $und_venta * $precio_venta_producto2;
$total_precio_venta_producto3      = $und_venta * $precio_venta_producto3;
$total_precio_venta_producto4      = $und_venta * $precio_venta_producto4;
$total_precio_venta_producto5      = $und_venta * $precio_venta_producto5;


if ($nombre_tipo_precio_venta == 'PV1') {

	$total_venta_producto         = $precio_venta_producto1 * $und_venta;
	if ($total_compra_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

	$actualizar_sql = "UPDATE tbl15_cotizacion_venta_producto_temporal SET nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', 
	precio_venta_producto = '$precio_venta_producto1', total_venta_producto = '$total_precio_venta_producto1', cod_estado_permitir_venta = '$cod_estado_permitir_venta'
	WHERE cod_cotizacion_venta_producto_temporal = '$cod_cotizacion_venta_producto_temporal'";
	$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);

	$sql_base_iva = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_iva
	FROM tbl15_cotizacion_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_base_iva = mysqli_query($conectar, $sql_base_iva);
	$matriz_base_iva = mysqli_fetch_assoc($consulta_base_iva);

	$subtotal_base_iva            = $matriz_base_iva['subtotal_base_iva'];

	if ($cod_estado_limite_venta_pos_factura_electronica_global == '1') {
		if ($subtotal_base_iva > $limite_venta_pos_factura_electronica) { $nombre_tipo_factura = 'ELECTRONICA'; } else { $nombre_tipo_factura = 'POS'; }	
		$sql_data = sprintf("UPDATE tbl15_info_cotizacion_factura_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE (cod_info_cotizacion_factura_venta = '$cod_info_cotizacion_factura_venta')");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php }

if ($nombre_tipo_precio_venta == 'PV2') {

	$total_venta_producto         = $precio_venta_producto2 * $und_venta;
	if ($total_compra_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

	$actualizar_sql = "UPDATE tbl15_cotizacion_venta_producto_temporal SET nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', 
	precio_venta_producto = '$precio_venta_producto2', total_venta_producto = '$total_precio_venta_producto2', cod_estado_permitir_venta = '$cod_estado_permitir_venta' 
	WHERE cod_cotizacion_venta_producto_temporal = '$cod_cotizacion_venta_producto_temporal'";
	$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);

	$sql_base_iva = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_iva
	FROM tbl15_cotizacion_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_base_iva = mysqli_query($conectar, $sql_base_iva);
	$matriz_base_iva = mysqli_fetch_assoc($consulta_base_iva);

	$subtotal_base_iva            = $matriz_base_iva['subtotal_base_iva'];

	if ($cod_estado_limite_venta_pos_factura_electronica_global == '1') {
		if ($subtotal_base_iva > $limite_venta_pos_factura_electronica) { $nombre_tipo_factura = 'ELECTRONICA'; } else { $nombre_tipo_factura = 'POS'; }	
		$sql_data = sprintf("UPDATE tbl15_info_cotizacion_factura_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE (cod_info_cotizacion_factura_venta = '$cod_info_cotizacion_factura_venta')");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } 

if ($nombre_tipo_precio_venta == 'PV3') {

	$total_venta_producto         = $precio_venta_producto3 * $und_venta;
	if ($total_compra_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

	$actualizar_sql = "UPDATE tbl15_cotizacion_venta_producto_temporal SET nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', 
	precio_venta_producto = '$precio_venta_producto3', total_venta_producto = '$total_precio_venta_producto3', cod_estado_permitir_venta = '$cod_estado_permitir_venta' 
	WHERE cod_cotizacion_venta_producto_temporal = '$cod_cotizacion_venta_producto_temporal'";
	$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);

	$sql_base_iva = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_iva
	FROM tbl15_cotizacion_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_base_iva = mysqli_query($conectar, $sql_base_iva);
	$matriz_base_iva = mysqli_fetch_assoc($consulta_base_iva);

	$subtotal_base_iva            = $matriz_base_iva['subtotal_base_iva'];

	if ($cod_estado_limite_venta_pos_factura_electronica_global == '1') {
		if ($subtotal_base_iva > $limite_venta_pos_factura_electronica) { $nombre_tipo_factura = 'ELECTRONICA'; } else { $nombre_tipo_factura = 'POS'; }	
		$sql_data = sprintf("UPDATE tbl15_info_cotizacion_factura_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE (cod_info_cotizacion_factura_venta = '$cod_info_cotizacion_factura_venta')");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
	?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php }

if ($nombre_tipo_precio_venta == 'PV4') {

	$total_venta_producto         = $precio_venta_producto4 * $und_venta;
	if ($total_compra_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

	$actualizar_sql = "UPDATE tbl15_cotizacion_venta_producto_temporal SET nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', 
	precio_venta_producto = '$precio_venta_producto4', total_venta_producto = '$total_precio_venta_producto4', cod_estado_permitir_venta = '$cod_estado_permitir_venta'
	WHERE cod_cotizacion_venta_producto_temporal = '$cod_cotizacion_venta_producto_temporal'";
	$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);

	$sql_base_iva = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_iva
	FROM tbl15_cotizacion_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_base_iva = mysqli_query($conectar, $sql_base_iva);
	$matriz_base_iva = mysqli_fetch_assoc($consulta_base_iva);

	$subtotal_base_iva            = $matriz_base_iva['subtotal_base_iva'];

	if ($cod_estado_limite_venta_pos_factura_electronica_global == '1') {
		if ($subtotal_base_iva > $limite_venta_pos_factura_electronica) { $nombre_tipo_factura = 'ELECTRONICA'; } else { $nombre_tipo_factura = 'POS'; }	
		$sql_data = sprintf("UPDATE tbl15_info_cotizacion_factura_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE (cod_info_cotizacion_factura_venta = '$cod_info_cotizacion_factura_venta')");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } 

if ($nombre_tipo_precio_venta == 'PV5') {

	$total_venta_producto         = $precio_venta_producto5 * $und_venta;
	if ($total_compra_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

	$actualizar_sql = "UPDATE tbl15_cotizacion_venta_producto_temporal SET nombre_tipo_precio_venta = '$nombre_tipo_precio_venta', 
	precio_venta_producto = '$precio_venta_producto5', total_venta_producto = '$total_precio_venta_producto5', cod_estado_permitir_venta = '$cod_estado_permitir_venta'
	WHERE cod_cotizacion_venta_producto_temporal = '$cod_cotizacion_venta_producto_temporal'";
	$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql);

	$sql_base_iva = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_iva
	FROM tbl15_cotizacion_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_base_iva = mysqli_query($conectar, $sql_base_iva);
	$matriz_base_iva = mysqli_fetch_assoc($consulta_base_iva);

	$subtotal_base_iva            = $matriz_base_iva['subtotal_base_iva'];

	if ($cod_estado_limite_venta_pos_factura_electronica_global == '1') {
		if ($subtotal_base_iva > $limite_venta_pos_factura_electronica) { $nombre_tipo_factura = 'ELECTRONICA'; } else { $nombre_tipo_factura = 'POS'; }	
		$sql_data = sprintf("UPDATE tbl15_info_cotizacion_factura_venta SET nombre_tipo_factura = '$nombre_tipo_factura' WHERE (cod_info_cotizacion_factura_venta = '$cod_info_cotizacion_factura_venta')");
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } ?>