<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');

if ((isset($_GET['cod_movimiento_contable'])) && ($_GET['cod_movimiento_contable'] != "")) {

	$cod_movimiento_contable        = intval($_GET["cod_movimiento_contable"]);
	$pagina                         = $_GET["pagina"];

	$sql_insert_mov_contable = "INSERT INTO tbl15_movimiento_contable_copia (cod_movimiento_contable, nombre_estado_factura, cod_factura, doc_modifica, nombre_tipo_documento, descripcion_movimiento, 
	total_costo_movimiento_contable, total_venta_movimiento_contable, total_debitos, total_creditos, cod_clientes, cod_tercero, 
	nombres_clientes, nit_cliente, digito, estado_devol, motivo_devol, direccion, no_cuenta, elaborada, revisada, autorizada, 
	contabilizada, motivo_modificacion, fecha_anyo, fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, ip, cuenta, cod_caja_virtual, 
	observacion, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_forma_pago, descripcion_tipo_forma_pago, cod_guia) 
	SELECT cod_movimiento_contable, nombre_estado_factura, cod_factura, doc_modifica, nombre_tipo_documento, descripcion_movimiento, 
	total_costo_movimiento_contable, total_venta_movimiento_contable, total_debitos, total_creditos, cod_clientes, cod_tercero, 
	nombres_clientes, nit_cliente, digito, estado_devol, motivo_devol, direccion, no_cuenta, elaborada, revisada, autorizada, 
	contabilizada, motivo_modificacion, fecha_anyo, fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, ip, cuenta, cod_caja_virtual, 
	observacion, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_forma_pago, descripcion_tipo_forma_pago, cod_guia 
	FROM tbl15_movimiento_contable WHERE (cod_movimiento_contable = '$cod_movimiento_contable')";
	$result_insert_mov_contable = mysqli_query($conectar, $sql_insert_mov_contable) or die(mysqli_error($conectar));

	$sql_insert = "INSERT INTO tbl15_movimiento_contable_concepto_copia (cod_movimiento_contable_concepto, cod_movimiento_contable, nombre_tipo_movimiento, nombre_tipo_documento, 
	codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, 
	fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, cod_guia) 
	SELECT cod_movimiento_contable_concepto, cod_movimiento_contable, nombre_tipo_movimiento, nombre_tipo_documento, 
	codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, 
	fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, cod_guia 
	FROM tbl15_movimiento_contable_concepto WHERE (cod_movimiento_contable = '$cod_movimiento_contable')";
	$result_insert = mysqli_query($conectar, $sql_insert) or die(mysqli_error($conectar));

	$borrar_sql = ("DELETE FROM tbl15_movimiento_contable WHERE cod_movimiento_contable = '$cod_movimiento_contable'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

	$borrar_sql = ("DELETE FROM tbl15_movimiento_contable_concepto WHERE cod_movimiento_contable = '$cod_movimiento_contable'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
<?php } ?>