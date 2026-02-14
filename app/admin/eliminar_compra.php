<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php'); 
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
date_default_timezone_set("America/Bogota");
$cuenta_actual = addslashes($_SESSION['usuario']);

$tab                      = addslashes($_GET['tab']);
$tipo                     = addslashes($_GET['tipo']);
$campo                    = addslashes($_GET['campo']);
//$pagina                   = addslashes($_GET['pagina']);
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT cod_estado_generar_movimiento_contable_automatico_global, cod_estado_movimiento_contable_cuenta_personal_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_generar_movimiento_contable_automatico_global          = $info_empresa_data['cod_estado_generar_movimiento_contable_automatico_global'];
$cod_estado_movimiento_contable_cuenta_personal_global             = $info_empresa_data['cod_estado_movimiento_contable_cuenta_personal_global'];
// ------------------------------------------------------------------------------------------------- //
if ($tipo == 'eliminar' && $tab == 'tbl15_info_factura_compra') {
	$cod_info_factura_compra                                       = intval($_GET['llave']);
	$comentario                                                    = 'devolucion compra btn elim sup';
	$fecha_elim                                                    = date("Y-m-d H:i:s");	
	$usuario_elim                                                  = $cuenta_actual;
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_max_info_nota_debito = "SELECT MAX(cod_factura_nota_debito) AS cod_factura_nota_debito FROM tbl15_info_nota_debito";
	$resultado_max_info_nota_debito = mysqli_query($conectar, $sql_max_info_nota_debito);
	$info_max_info_nota_debito = mysqli_fetch_assoc($resultado_max_info_nota_debito);

	$cod_factura_nota_debito                        = $info_max_info_nota_debito['cod_factura_nota_debito'] + 1; 
	//-------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_info_nota_debito = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_nota_debito'";
	$exec_autoincremento_info_nota_debito = mysqli_query($conectar, $sql_autoincremento_info_nota_debito) or die(mysqli_error($conectar));
	$datos_autoincremento_info_nota_debito = mysqli_fetch_assoc($exec_autoincremento_info_nota_debito);
	$cod_info_nota_debito = $datos_autoincremento_info_nota_debito['AUTO_INCREMENT'];
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_factura_compra_producto = "SELECT * FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$resultado_factura_compra_producto = mysqli_query($conectar, $sql_factura_compra_producto);
	while ($info_factura_compra_producto = mysqli_fetch_assoc($resultado_factura_compra_producto)) {

		$cod_factura_compra_producto                              = $info_factura_compra_producto['cod_factura_compra_producto'];
		$cod_factura                                              = $info_factura_compra_producto['cod_factura'];
		$cod_tercero                                              = $info_factura_compra_producto['cod_tercero'];
		$cod_doc_soporte                                          = $info_factura_compra_producto['cod_doc_soporte'];
		$cod_caja_virtual                                         = $info_factura_compra_producto['cod_caja_virtual'];
		$cod_producto                                             = $info_factura_compra_producto['cod_producto'];
		$cod_producto_barra                                       = $info_factura_compra_producto['cod_producto_barra'];
		$nombre_producto                                          = $info_factura_compra_producto['nombre_producto'];
		$und_venta                                                = $info_factura_compra_producto['und_venta'];
		$und_producto                                             = $info_factura_compra_producto['und_producto'];
		$und_producto_bodega                                      = $info_factura_compra_producto['und_producto_bodega'];
		$und_compra                                               = $info_factura_compra_producto['und_compra'];
		$und_unidades                                             = $info_factura_compra_producto['und_unidades'];
		$und_caja                                                 = $info_factura_compra_producto['und_caja'];
		$unidades_total                                           = $info_factura_compra_producto['unidades_total'];
		$precio_compra_producto                                   = $info_factura_compra_producto['precio_compra_producto'];
		$total_compra_producto                                    = $info_factura_compra_producto['total_compra_producto'];
		$precio_costo_producto                                    = $info_factura_compra_producto['precio_costo_producto'];
		$total_costo_producto                                     = $info_factura_compra_producto['total_costo_producto'];
		$precio_compra_producto_ant_desc                          = $info_factura_compra_producto['precio_compra_producto_ant_desc'];
		$total_compra_producto_ant_desc                           = $info_factura_compra_producto['total_compra_producto_ant_desc'];
		$und_compra_oleina                                        = $info_factura_compra_producto['und_compra_oleina'];
		$precio_compra_producto_oleina                            = $info_factura_compra_producto['precio_compra_producto_oleina'];
		$total_compra_producto_oleina                             = $info_factura_compra_producto['total_compra_producto_oleina'];
		$precio_costo_producto_oleina                             = $info_factura_compra_producto['precio_costo_producto_oleina'];
		$total_costo_producto_oleina                              = $info_factura_compra_producto['total_costo_producto_oleina'];
		$precio_venta_producto                                    = $info_factura_compra_producto['precio_venta_producto'];
		$precio_venta_producto2                                   = $info_factura_compra_producto['precio_venta_producto2'];
		$precio_venta_producto3                                   = $info_factura_compra_producto['precio_venta_producto3'];
		$precio_venta_producto4                                   = $info_factura_compra_producto['precio_venta_producto4'];
		$precio_venta_producto5                                   = $info_factura_compra_producto['precio_venta_producto5'];
		$total_venta_producto                                     = $info_factura_compra_producto['total_venta_producto'];
		$cod_tipo_pago                                            = $info_factura_compra_producto['cod_tipo_pago'];
		$cod_tipo_forma_pago                                      = $info_factura_compra_producto['cod_tipo_forma_pago'];
		$nombre_tipo_factura                                      = $info_factura_compra_producto['nombre_tipo_factura'];
		$nombre_tipo_moneda                                       = $info_factura_compra_producto['nombre_tipo_moneda'];
		$nombre_tipo_producto                                     = $info_factura_compra_producto['nombre_tipo_producto'];
		$nombre_tipo_unidad_medida                                = $info_factura_compra_producto['nombre_tipo_unidad_medida'];
		$nombre_tipo_presentacion                                 = $info_factura_compra_producto['nombre_tipo_presentacion'];
		$fecha_ymd_venta_producto                                 = $info_factura_compra_producto['fecha_ymd_venta_producto'];
		$fecha_mes_venta_producto                                 = $info_factura_compra_producto['fecha_mes_venta_producto'];
		$fecha_anyo_venta_producto                                = $info_factura_compra_producto['fecha_anyo_venta_producto'];
		$fecha_seg_venta_producto                                 = $info_factura_compra_producto['fecha_seg_venta_producto'];
		$fecha_alerta                                             = $info_factura_compra_producto['fecha_alerta'];
		$nombre_tipo_precio                                       = $info_factura_compra_producto['nombre_tipo_precio'];
		$nombre_tipo_precio_venta                                 = $info_factura_compra_producto['nombre_tipo_precio_venta'];
		$comision_ptj                                             = $info_factura_compra_producto['comision_ptj'];
		$dto1                                                     = $info_factura_compra_producto['dto1'];
		$dto2                                                     = $info_factura_compra_producto['dto2'];
		$descuento                                                = $info_factura_compra_producto['descuento'];
		$total_dto                                                = $info_factura_compra_producto['total_dto'];
		$iva_ptj                                                  = $info_factura_compra_producto['iva_ptj'];
		$total_iva                                                = $info_factura_compra_producto['total_iva'];
		$valor_iva                                                = $info_factura_compra_producto['valor_iva'];
		$valor_flete_olina                                        = $info_factura_compra_producto['valor_flete_olina'];
		$total_flete_olina                                        = $info_factura_compra_producto['total_flete_olina'];
		$ganancia_ptj                                             = $info_factura_compra_producto['ganancia_ptj'];
		$fecha_vencimiento                                        = $info_factura_compra_producto['fecha_vencimiento'];
		$lote_vencimiento                                         = $info_factura_compra_producto['lote_vencimiento'];
		$precio_compra_producto_viejo                             = $info_factura_compra_producto['precio_compra_producto_viejo'];
		$precio_costo_producto_viejo                              = $info_factura_compra_producto['precio_costo_producto_viejo'];
		$cod_dependencia                                          = $info_factura_compra_producto['cod_dependencia'];
		$ipc_ptj                                                  = $info_factura_compra_producto['ipc_ptj'];
		$precio_ipc                                               = $info_factura_compra_producto['precio_ipc'];
		$precio_ipc_total                                         = $info_factura_compra_producto['precio_ipc_total'];
		$ret_ica_ptj                                              = $info_factura_compra_producto['ret_ica_ptj'];
		$total_ret_ica                                            = $info_factura_compra_producto['total_ret_ica'];
		$iva_teorico_ptj                                          = $info_factura_compra_producto['iva_teorico_ptj'];
		$total_iva_teorico                                        = $info_factura_compra_producto['total_iva_teorico'];
		$tarifa_rete_vigente_ptj                                  = $info_factura_compra_producto['tarifa_rete_vigente_ptj'];
		$total_tarifa_rete_vigente                                = $info_factura_compra_producto['total_tarifa_rete_vigente'];
		$rete_iva_asumido_ptj                                     = $info_factura_compra_producto['rete_iva_asumido_ptj'];
		$total_rete_iva_asumido                                   = $info_factura_compra_producto['total_rete_iva_asumido'];
		$nombre_tipo_bienes_serv                                  = $info_factura_compra_producto['nombre_tipo_bienes_serv'];
		$nombre_tipo_compra                                       = $info_factura_compra_producto['nombre_tipo_compra'];
		$cod_tipo_producto_consumo                                = $info_factura_compra_producto['cod_tipo_producto_consumo'];
		$nombre_tipo_cargue_factura                               = $info_factura_compra_producto['nombre_tipo_cargue_factura'];
		$nombre_tipo_medida                                       = $info_factura_compra_producto['nombre_tipo_medida'];
		$cajas                                                    = $info_factura_compra_producto['cajas'];
		$cajas_sobre                                              = $info_factura_compra_producto['cajas_sobre'];
		$und_sobre                                                = $info_factura_compra_producto['und_sobre'];
		$check_caja                                               = $info_factura_compra_producto['check_caja'];
		$check_und                                                = $info_factura_compra_producto['check_und'];
		$check_ant_desc                                           = $info_factura_compra_producto['check_ant_desc'];
		$chk                                                      = $info_factura_compra_producto['chk'];
		$check_obsequio                                           = $info_factura_compra_producto['check_obsequio'];
		$cod_interno                                              = $info_factura_compra_producto['cod_interno'];
		$cod_proveedor                                            = $info_factura_compra_producto['cod_proveedor'];
		$cod_original                                             = $info_factura_compra_producto['cod_original'];
		$codificacion                                             = $info_factura_compra_producto['codificacion'];
		$nombre_proveedor                                         = $info_factura_compra_producto['nombre_proveedor'];
		$tope_min                                                 = $info_factura_compra_producto['tope_min'];
		$cedula                                                   = $info_factura_compra_producto['cedula'];
		$nombre_cliente                                           = $info_factura_compra_producto['nombre_cliente'];
		$cod_historia_clinica                                     = $info_factura_compra_producto['cod_historia_clinica'];
		$posologia_cantidad                                       = $info_factura_compra_producto['posologia_cantidad'];
		$posologia_peso                                           = $info_factura_compra_producto['posologia_peso'];
		$peso_producto                                            = $info_factura_compra_producto['peso_producto'];
		$unidad_medida_peso                                       = $info_factura_compra_producto['unidad_medida_peso'];
		$nombre_frec_duracion                                     = $info_factura_compra_producto['nombre_frec_duracion'];
		$nombre_via_administracion                                = $info_factura_compra_producto['nombre_via_administracion'];
		$cod_tipo_cobrar                                          = $info_factura_compra_producto['cod_tipo_cobrar'];
		$cod_estado_vacuna                                        = $info_factura_compra_producto['cod_estado_vacuna'];
		$cod_estado_permitir_venta                                = $info_factura_compra_producto['cod_estado_permitir_venta'];
		$cod_base_caja                                            = $info_factura_compra_producto['cod_base_caja'];
		$cod_guia                                                 = $info_factura_compra_producto['cod_guia'];
		$cod_administrador                                        = $info_factura_compra_producto['cod_administrador'];
		$cod_tipo_inventario                                      = $info_factura_compra_producto['cod_tipo_inventario'];
		$fecha_mantenimiento                                      = $info_factura_compra_producto['fecha_mantenimiento'];
		$meses_mantenimiento                                      = $info_factura_compra_producto['meses_mantenimiento'];
		$meses_garantia                                           = $info_factura_compra_producto['meses_garantia'];
		$cuenta                                                   = $info_factura_compra_producto['cuenta'];
		$nombre_categoria                                         = $info_factura_compra_producto['nombre_categoria'];
		$nombre_categoria_sub                                     = $info_factura_compra_producto['nombre_categoria_sub'];
		$lote_compra                                              = $info_factura_compra_producto['lote_compra'];
		$cod_tipo_origen_factura_compra                           = $info_factura_compra_producto['cod_tipo_origen_factura_compra'];
		$cod_info_factura_transferencia_bodega_entrada            = $info_factura_compra_producto['cod_info_factura_transferencia_bodega_entrada'];
		$cod_cliente                                              = $info_factura_compra_producto['cod_cliente'];
		$cod_dia_semana                                           = $info_factura_compra_producto['cod_dia_semana'];
		$cod_resolucion_facturacion                               = $info_factura_compra_producto['cod_resolucion_facturacion'];
		$cod_puc                                                  = $info_factura_compra_producto['cod_puc'];


		$sql_data = "INSERT INTO tbl15_factura_compra_producto_copia (cod_factura_compra_producto, cod_info_factura_compra, cod_factura, cod_tercero, cod_doc_soporte, 
		cod_caja_virtual, cod_producto, cod_producto_barra, nombre_producto, und_venta, und_producto, und_producto_bodega, und_compra, und_unidades, und_caja, unidades_total, 
		precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_compra_producto_ant_desc, total_compra_producto_ant_desc, 
		und_compra_oleina, precio_compra_producto_oleina, total_compra_producto_oleina, precio_costo_producto_oleina, total_costo_producto_oleina, precio_venta_producto, 
		precio_venta_producto2, precio_venta_producto3, precio_venta_producto4, precio_venta_producto5, total_venta_producto, cod_tipo_pago, cod_tipo_forma_pago, 
		nombre_tipo_factura, nombre_tipo_moneda, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, fecha_ymd_venta_producto, 
		fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, fecha_alerta, nombre_tipo_precio, nombre_tipo_precio_venta, 
		comision_ptj, dto1, dto2, descuento, total_dto, iva_ptj, total_iva, valor_iva, valor_flete_olina, total_flete_olina, ganancia_ptj, fecha_vencimiento, 
		lote_vencimiento, precio_compra_producto_viejo, precio_costo_producto_viejo, cod_dependencia, ipc_ptj, precio_ipc, precio_ipc_total, ret_ica_ptj, 
		total_ret_ica, iva_teorico_ptj, total_iva_teorico, tarifa_rete_vigente_ptj, total_tarifa_rete_vigente, rete_iva_asumido_ptj, total_rete_iva_asumido, 
		nombre_tipo_bienes_serv, nombre_tipo_compra, cod_tipo_producto_consumo, nombre_tipo_cargue_factura, nombre_tipo_medida, cajas, cajas_sobre, und_sobre, 
		check_caja, check_und, check_ant_desc, chk, check_obsequio, cod_interno, cod_proveedor, cod_original, codificacion, nombre_proveedor, tope_min, 
		cedula, nombre_cliente, cod_historia_clinica, posologia_cantidad, posologia_peso, peso_producto, unidad_medida_peso, nombre_frec_duracion, nombre_via_administracion, 
		cod_tipo_cobrar, cod_estado_vacuna, cod_estado_permitir_venta, cod_base_caja, cod_guia, cod_administrador, cod_tipo_inventario, fecha_mantenimiento, meses_mantenimiento, 
		meses_garantia, cuenta, nombre_categoria, nombre_categoria_sub, lote_compra, cod_tipo_origen_factura_compra, cod_info_factura_transferencia_bodega_entrada, 
		cod_cliente, cod_dia_semana, fecha_elim, usuario_elim) 
		VALUES ('$cod_factura_compra_producto', '$cod_info_factura_compra', '$cod_factura', '$cod_tercero', '$cod_doc_soporte', 
		'$cod_caja_virtual', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', '$und_producto', '$und_producto_bodega', '$und_compra', '$und_unidades', '$und_caja', '$unidades_total', 
		'$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_compra_producto_ant_desc', '$total_compra_producto_ant_desc', 
		'$und_compra_oleina', '$precio_compra_producto_oleina', '$total_compra_producto_oleina', '$precio_costo_producto_oleina', '$total_costo_producto_oleina', '$precio_venta_producto', 
		'$precio_venta_producto2', '$precio_venta_producto3', '$precio_venta_producto4', '$precio_venta_producto5', '$total_venta_producto', '$cod_tipo_pago', '$cod_tipo_forma_pago', 
		'$nombre_tipo_factura', '$nombre_tipo_moneda', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', '$fecha_ymd_venta_producto', 
		'$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$fecha_alerta', '$nombre_tipo_precio', '$nombre_tipo_precio_venta', 
		'$comision_ptj', '$dto1', '$dto2', '$descuento', '$total_dto', '$iva_ptj', '$total_iva', '$valor_iva', '$valor_flete_olina', '$total_flete_olina', '$ganancia_ptj', '$fecha_vencimiento', 
		'$lote_vencimiento', '$precio_compra_producto_viejo', '$precio_costo_producto_viejo', '$cod_dependencia', '$ipc_ptj', '$precio_ipc', '$precio_ipc_total', '$ret_ica_ptj', 
		'$total_ret_ica', '$iva_teorico_ptj', '$total_iva_teorico', '$tarifa_rete_vigente_ptj', '$total_tarifa_rete_vigente', '$rete_iva_asumido_ptj', '$total_rete_iva_asumido', 
		'$nombre_tipo_bienes_serv', '$nombre_tipo_compra', '$cod_tipo_producto_consumo', '$nombre_tipo_cargue_factura', '$nombre_tipo_medida', '$cajas', '$cajas_sobre', '$und_sobre', 
		'$check_caja', '$check_und', '$check_ant_desc', '$chk', '$check_obsequio', '$cod_interno', '$cod_proveedor', '$cod_original', '$codificacion', '$nombre_proveedor', '$tope_min', 
		'$cedula', '$nombre_cliente', '$cod_historia_clinica', '$posologia_cantidad', '$posologia_peso', '$peso_producto', '$unidad_medida_peso', '$nombre_frec_duracion', '$nombre_via_administracion', 
		'$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_estado_permitir_venta', '$cod_base_caja', '$cod_guia', '$cod_administrador', '$cod_tipo_inventario', '$fecha_mantenimiento', '$meses_mantenimiento', 
		'$meses_garantia', '$cuenta', '$nombre_categoria', '$nombre_categoria_sub', '$lote_compra', '$cod_tipo_origen_factura_compra', '$cod_info_factura_transferencia_bodega_entrada', 
		'$cod_cliente', '$cod_dia_semana', '$fecha_elim', '$usuario_elim')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));


		$agregar_nota_debito = "INSERT INTO tbl15_nota_debito (cod_info_nota_debito, cod_info_factura_compra, cod_factura_compra_producto, cod_producto, cod_producto_barra, 
		cod_factura, cod_tercero, nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, 
		total_costo_producto, precio_venta_producto, total_venta_producto, peso_producto, unidad_medida_peso, nombre_tipo_producto, 
		nombre_tipo_unidad_medida, nombre_tipo_presentacion, und_producto, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, 
		fecha_seg_venta_producto, cuenta, cod_administrador, descuento_ptj, iva_ptj, precio_ipc_total, precio_ipc, cod_resolucion_facturacion, nombre_tipo_precio, 
		nombre_tipo_precio_venta, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, cod_dependencia, cod_tipo_inventario, nombre_tipo_compra, cod_dia_semana, cod_puc) 
		VALUES ('$cod_info_nota_debito', '$cod_info_factura_compra', '$cod_factura_compra_producto', '$cod_producto', '$cod_producto_barra',
		'$cod_factura', '$cod_tercero', '$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', 
		'$total_costo_producto', '$precio_venta_producto', '$total_venta_producto', '$peso_producto', '$unidad_medida_peso', '$nombre_tipo_producto', 
		'$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', '$und_producto', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', 
		'$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', '$descuento_ptj', '$iva_ptj', '$precio_ipc_total', '$precio_ipc', '$cod_resolucion_facturacion', '$nombre_tipo_precio', 
		'$nombre_tipo_precio_venta', '$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$cod_dependencia', '$cod_tipo_inventario', '$nombre_tipo_compra', '$cod_dia_semana', '$cod_puc')";
		$resultado_nota_debiton = mysqli_query($conectar, $agregar_nota_debito) or die(mysqli_error($conectar));

		$borrar_sql_factura_compra_producto = sprintf("DELETE FROM tbl15_factura_compra_producto WHERE cod_factura_compra_producto = '$cod_factura_compra_producto'");
		$Result1_factura_compra_producto = mysqli_query($conectar, $borrar_sql_factura_compra_producto) or die(mysqli_error($conectar));

		$sql_producto = "SELECT und_producto FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
		$resultado_producto = mysqli_query($conectar, $sql_producto);
		$info_producto = mysqli_fetch_assoc($resultado_producto);

		$und_producto_db                                           = $info_producto['und_producto'];
		$und_producto                                              = $und_producto_db - $und_compra;
		$nombre_via_administracion                                 = "retorno_factura_venta_".$fecha_elim;

		$agregar_regis = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto', nombre_via_administracion = '$nombre_via_administracion' WHERE cod_producto_barra = '$cod_producto_barra'");
		$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
	}
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_info_factura_compra = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$resultado_info_factura_compra = mysqli_query($conectar, $sql_info_factura_compra);
	$info_info_factura_compra = mysqli_fetch_assoc($resultado_info_factura_compra);

	$cod_factura                                                  = $info_info_factura_compra['cod_factura'];
	$cod_tercero                                                  = $info_info_factura_compra['cod_tercero'];
	$cod_caja_virtual                                             = $info_info_factura_compra['cod_caja_virtual'];
	$nombre_estado_factura                                        = $info_info_factura_compra['nombre_estado_factura'];
	$nombre_tipo_cargue_factura                                   = $info_info_factura_compra['nombre_tipo_cargue_factura'];
	$nombre_tipo_compra                                           = $info_info_factura_compra['nombre_tipo_compra'];
	$cod_tipo_producto_consumo                                    = $info_info_factura_compra['cod_tipo_producto_consumo'];
	$cod_empresa                                                  = $info_info_factura_compra['cod_empresa'];
	$nombre_empresa                                               = $info_info_factura_compra['nombre_empresa'];
	$razonsocial_empresa                                          = $info_info_factura_compra['razonsocial_empresa'];
	$total_muestra                                                = $info_info_factura_compra['total_muestra'];
	$fecha_ymdhis                                                 = $info_info_factura_compra['fecha_ymdhis'];
	$cuenta                                                       = $info_info_factura_compra['cuenta'];
	$cod_estado_factura                                           = $info_info_factura_compra['cod_estado_factura'];
	$cod_base_caja                                                = $info_info_factura_compra['cod_base_caja'];
	$descuento_ptj                                                = $info_info_factura_compra['descuento_ptj'];
	$iva_ptj                                                      = $info_info_factura_compra['iva_ptj'];
	$flete_ptj                                                    = $info_info_factura_compra['flete_ptj'];
	$valor_flete                                                  = $info_info_factura_compra['valor_flete'];
	$valor_flete_olina                                            = $info_info_factura_compra['valor_flete_olina'];
	$total_flete_olina                                            = $info_info_factura_compra['total_flete_olina'];
	$subtotal                                                     = $info_info_factura_compra['subtotal'];
	$valor_iva                                                    = $info_info_factura_compra['valor_iva'];
	$cod_cliente                                                  = $info_info_factura_compra['cod_cliente'];
	$vlr_cancelado                                                = $info_info_factura_compra['vlr_cancelado'];
	$vlr_vuelto                                                   = $info_info_factura_compra['vlr_vuelto'];
	$fecha_dia                                                    = $info_info_factura_compra['fecha_dia'];
	$fecha_mes                                                    = $info_info_factura_compra['fecha_mes'];
	$fecha_anyo                                                   = $info_info_factura_compra['fecha_anyo'];
	$anyo                                                         = $info_info_factura_compra['anyo'];
	$fecha_hora                                                   = $info_info_factura_compra['fecha_hora'];
	$fecha_remision                                               = $info_info_factura_compra['fecha_remision'];
	$nombre_ccosto                                                = $info_info_factura_compra['nombre_ccosto'];
	$garantia_meses                                               = $info_info_factura_compra['garantia_meses'];
	$observacion                                                  = $info_info_factura_compra['observacion'];
	$cod_tipo_pago                                                = $info_info_factura_compra['cod_tipo_pago'];
	$cod_administrador                                            = $info_info_factura_compra['cod_administrador'];
	$nombre_tipo_producto                                         = $info_info_factura_compra['nombre_tipo_producto'];
	$total                                                        = $info_info_factura_compra['total'];
	$subtotal_total_precio_compra                                 = $info_info_factura_compra['subtotal_total_precio_compra'];
	$subtotal_total_precio_costo                                  = $info_info_factura_compra['subtotal_total_precio_costo'];
	$total_precio_costo                                           = $info_info_factura_compra['total_precio_costo'];
	$total_precio_compra                                          = $info_info_factura_compra['total_precio_compra'];
	$total_precio_venta                                           = $info_info_factura_compra['total_precio_venta'];
	$total_peso_producto                                          = $info_info_factura_compra['total_peso_producto'];
	$cod_dependencia                                              = $info_info_factura_compra['cod_dependencia'];
	$servicio                                                     = $info_info_factura_compra['servicio'];
	$cod_tipo_forma_pago                                          = $info_info_factura_compra['cod_tipo_forma_pago'];
	$nombre_tipo_forma_pago                                       = $info_info_factura_compra['nombre_tipo_forma_pago'];
	$descripcion_tipo_forma_pago                                  = $info_info_factura_compra['descripcion_tipo_forma_pago'];
	$nombre_tipo_factura                                          = $info_info_factura_compra['nombre_tipo_factura'];
	$nombre_tipo_moneda                                           = $info_info_factura_compra['nombre_tipo_moneda'];
	$cod_cierre_caja                                              = $info_info_factura_compra['cod_cierre_caja'];
	$fecha_creacion                                               = $info_info_factura_compra['fecha_creacion'];
	$fecha_modificacion                                           = $info_info_factura_compra['fecha_modificacion'];
	$nombre_maquina                                               = $info_info_factura_compra['nombre_maquina'];
	$cod_tipo_cobrar                                              = $info_info_factura_compra['cod_tipo_cobrar'];
	$cod_estado_vacuna                                            = $info_info_factura_compra['cod_estado_vacuna'];
	$cod_resolucion_facturacion                                   = $info_info_factura_compra['cod_resolucion_facturacion'];
	$total_datos_data                                             = $info_info_factura_compra['total_datos_data'];
	$tiempo_ejecucion                                             = $info_info_factura_compra['tiempo_ejecucion'];
	$ipc_ptj                                                      = $info_info_factura_compra['ipc_ptj'];
	$precio_ipc                                                   = $info_info_factura_compra['precio_ipc'];
	$precio_ipc_total                                             = $info_info_factura_compra['precio_ipc_total'];
	$ret_ica_ptj                                                  = $info_info_factura_compra['ret_ica_ptj'];
	$total_ret_ica                                                = $info_info_factura_compra['total_ret_ica'];
	$iva_teorico_ptj                                              = $info_info_factura_compra['iva_teorico_ptj'];
	$total_iva_teorico                                            = $info_info_factura_compra['total_iva_teorico'];
	$tarifa_rete_vigente_ptj                                      = $info_info_factura_compra['tarifa_rete_vigente_ptj'];
	$total_tarifa_rete_vigente                                    = $info_info_factura_compra['total_tarifa_rete_vigente'];
	$rete_iva_asumido_ptj                                         = $info_info_factura_compra['rete_iva_asumido_ptj'];
	$total_rete_iva_asumido                                       = $info_info_factura_compra['total_rete_iva_asumido'];
	$iva_19                                                       = $info_info_factura_compra['iva_19'];
	$iva_5                                                        = $info_info_factura_compra['iva_5'];
	$nombre_rete_fuente_ptj                                       = $info_info_factura_compra['nombre_rete_fuente_ptj'];
	$valor_neto                                                   = $info_info_factura_compra['valor_neto'];
	$total_compra_imp                                             = $info_info_factura_compra['total_compra_imp'];
	$total_precio_ipc                                             = $info_info_factura_compra['total_precio_ipc'];
	$total_descuento                                              = $info_info_factura_compra['total_descuento'];
	$total_rete_fuente                                            = $info_info_factura_compra['total_rete_fuente'];
	$total_factura_compra_retefuente                              = $info_info_factura_compra['total_factura_compra_retefuente'];
	$total_factura_compra                                         = $info_info_factura_compra['total_factura_compra'];
	$cod_doc_soporte                                              = $info_info_factura_compra['cod_doc_soporte'];
	$total_inv_precio_costo                                       = $info_info_factura_compra['total_inv_precio_costo'];
	$total_inv_precio_compra                                      = $info_info_factura_compra['total_inv_precio_compra'];
	$total_inv_precio_venta                                       = $info_info_factura_compra['total_inv_precio_venta'];
	$total_compra_precio_costo                                    = $info_info_factura_compra['total_compra_precio_costo'];
	$total_compra_precio_compra                                   = $info_info_factura_compra['total_compra_precio_compra'];
	$total_compra_precio_venta                                    = $info_info_factura_compra['total_compra_precio_venta'];
	$total_inv_compra_desp_factura                                = $info_info_factura_compra['total_inv_compra_desp_factura'];
	$cod_tipo_inventario                                          = $info_info_factura_compra['cod_tipo_inventario'];
	$url_img_orig_producto                                        = $info_info_factura_compra['url_img_orig_producto'];
	$url_img_min_producto                                         = $info_info_factura_compra['url_img_min_producto'];
	$fecha_mantenimiento                                          = $info_info_factura_compra['fecha_mantenimiento'];
	$cod_estado                                                   = $info_info_factura_compra['cod_estado'];
	$cod_tipo_origen_factura_compra                               = $info_info_factura_compra['cod_tipo_origen_factura_compra'];
	$cod_info_factura_transferencia_bodega_entrada                = $info_info_factura_compra['cod_info_factura_transferencia_bodega_entrada'];
	$cod_dia_semana                                               = $info_info_factura_compra['cod_dia_semana'];
	$fecha_entrega                                                = $info_info_factura_compra['fecha_entrega'];

	$cod_cufe                                                     = $info_info_factura_compra['cod_cufe'];
	$dataico_email_status                                         = $info_info_factura_compra['dataico_email_status'];
	$dataico_uuid                                                 = $info_info_factura_compra['dataico_uuid'];
	$dataico_issue_date                                           = $info_info_factura_compra['dataico_issue_date'];
	$dataico_dian_messages                                        = $info_info_factura_compra['dataico_dian_messages'];
	$dataico_xml_url                                              = $info_info_factura_compra['dataico_xml_url'];
	$dataico_customer_status                                      = $info_info_factura_compra['dataico_customer_status'];
	$dataico_validation_date                                      = $info_info_factura_compra['dataico_validation_date'];
	$dataico_qrcode                                               = $info_info_factura_compra['dataico_qrcode'];
	$dataico_xml                                                  = $info_info_factura_compra['dataico_xml'];
	$dataico_invoice_type_code                                    = $info_info_factura_compra['dataico_invoice_type_code'];
	$dataico_pdf_url                                              = $info_info_factura_compra['dataico_pdf_url'];
	$dataico_dian_status                                          = $info_info_factura_compra['dataico_dian_status'];
	$cod_movimiento_caja                                          = $info_info_factura_compra['cod_movimiento_caja'];
	$cod_movimiento_contable_cuenta_personal                      = $info_info_factura_compra['cod_movimiento_contable_cuenta_personal'];
	$cod_puc                                                      = $info_info_factura_compra['cod_puc'];
	$nombre_estado_factura_dataico_dian                           = 'ANULADA';
	//-------------------------------------------------------------------------------------------------------------------//
	$sql_data = "INSERT INTO tbl15_info_factura_compra_copia (cod_info_factura_compra, cod_factura, cod_tercero, cod_caja_virtual, nombre_estado_factura, nombre_tipo_cargue_factura, nombre_tipo_compra, 
	cod_tipo_producto_consumo, cod_empresa, nombre_empresa, razonsocial_empresa, total_muestra, fecha_ymdhis, cuenta, cod_estado_factura, 
	cod_base_caja, descuento_ptj, iva_ptj, flete_ptj, valor_flete, valor_flete_olina, total_flete_olina, subtotal, valor_iva, cod_cliente, 
	vlr_cancelado, vlr_vuelto, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, fecha_remision, nombre_ccosto, garantia_meses, observacion, 
	cod_tipo_pago, cod_administrador, nombre_tipo_producto, total, subtotal_total_precio_compra, subtotal_total_precio_costo, 
	total_precio_costo, total_precio_compra, total_precio_venta, total_peso_producto, cod_dependencia, servicio, cod_tipo_forma_pago, 
	nombre_tipo_forma_pago, descripcion_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, cod_cierre_caja, fecha_creacion, 
	fecha_modificacion, nombre_maquina, cod_tipo_cobrar, cod_estado_vacuna, cod_resolucion_facturacion, total_datos_data, tiempo_ejecucion, 
	ipc_ptj, precio_ipc, precio_ipc_total, ret_ica_ptj, total_ret_ica, iva_teorico_ptj, total_iva_teorico, tarifa_rete_vigente_ptj, 
	total_tarifa_rete_vigente, rete_iva_asumido_ptj, total_rete_iva_asumido, iva_19, iva_5, nombre_rete_fuente_ptj, valor_neto, 
	total_compra_imp, total_precio_ipc, total_descuento, total_rete_fuente, total_factura_compra_retefuente, total_factura_compra, 
	cod_doc_soporte, total_inv_precio_costo, total_inv_precio_compra, total_inv_precio_venta, total_compra_precio_costo, 
	total_compra_precio_compra, total_compra_precio_venta, total_inv_compra_desp_factura, cod_tipo_inventario, 
	url_img_orig_producto, url_img_min_producto, fecha_mantenimiento, cod_estado, cod_tipo_origen_factura_compra, 
	cod_info_factura_transferencia_bodega_entrada, cod_dia_semana, fecha_entrega, fecha_elim, usuario_elim) 
	VALUES ('$cod_info_factura_compra', '$cod_factura', '$cod_tercero', '$cod_caja_virtual', '$nombre_estado_factura', '$nombre_tipo_cargue_factura', '$nombre_tipo_compra', 
	'$cod_tipo_producto_consumo', '$cod_empresa', '$nombre_empresa', '$razonsocial_empresa', '$total_muestra', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', 
	'$cod_base_caja', '$descuento_ptj', '$iva_ptj', '$flete_ptj', '$valor_flete', '$valor_flete_olina', '$total_flete_olina', '$subtotal', '$valor_iva', '$cod_cliente', 
	'$vlr_cancelado', '$vlr_vuelto', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', '$fecha_remision', '$nombre_ccosto', '$garantia_meses', '$observacion', 
	'$cod_tipo_pago', '$cod_administrador', '$nombre_tipo_producto', '$total', '$subtotal_total_precio_compra', '$subtotal_total_precio_costo', 
	'$total_precio_costo', '$total_precio_compra', '$total_precio_venta', '$total_peso_producto', '$cod_dependencia', '$servicio', '$cod_tipo_forma_pago', 
	'$nombre_tipo_forma_pago', '$descripcion_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_cierre_caja', '$fecha_creacion', 
	'$fecha_modificacion', '$nombre_maquina', '$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_resolucion_facturacion', '$total_datos_data', '$tiempo_ejecucion', 
	'$ipc_ptj', '$precio_ipc', '$precio_ipc_total', '$ret_ica_ptj', '$total_ret_ica', '$iva_teorico_ptj', '$total_iva_teorico', '$tarifa_rete_vigente_ptj', 
	'$total_tarifa_rete_vigente', '$rete_iva_asumido_ptj', '$total_rete_iva_asumido', '$iva_19', '$iva_5', '$nombre_rete_fuente_ptj', '$valor_neto', 
	'$total_compra_imp', '$total_precio_ipc', '$total_descuento', '$total_rete_fuente', '$total_factura_compra_retefuente', '$total_factura_compra', 
	'$cod_doc_soporte', '$total_inv_precio_costo', '$total_inv_precio_compra', '$total_inv_precio_venta', '$total_compra_precio_costo', 
	'$total_compra_precio_compra', '$total_compra_precio_venta', '$total_inv_compra_desp_factura', '$cod_tipo_inventario', 
	'$url_img_orig_producto', '$url_img_min_producto', '$fecha_mantenimiento', '$cod_estado', '$cod_tipo_origen_factura_compra', 
	'$cod_info_factura_transferencia_bodega_entrada', '$cod_dia_semana', '$fecha_entrega', '$fecha_elim', '$usuario_elim')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$agreg = "INSERT INTO tbl15_info_nota_debito (cod_info_factura_compra, cod_cufe, dataico_email_status, dataico_uuid, dataico_issue_date, dataico_dian_messages, dataico_customer_status, 
	dataico_xml_url, dataico_validation_date, dataico_qrcode, dataico_xml, dataico_pdf_url, dataico_dian_status, dataico_invoice_type_code, cod_factura, cod_resolucion_facturacion, 
	cod_tercero, cod_caja_virtual, cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, total_precio_compra, total_precio_venta, fecha_dia, fecha_mes, fecha_anyo, anyo, 
	fecha_hora, fecha_creacion) 
	VALUES ('$cod_info_factura_compra', '$cod_cufe', '$dataico_email_status', '$dataico_uuid', '$dataico_issue_date', '$dataico_dian_messages', '$dataico_customer_status', 
	'$dataico_xml_url', '$dataico_validation_date', '$dataico_qrcode', '$dataico_xml', '$dataico_pdf_url', '$dataico_dian_status', '$dataico_invoice_type_code', '$cod_factura', '$cod_resolucion_facturacion', 
	'$cod_tercero', '$cod_caja_virtual', '$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$total_precio_compra', '$total_precio_venta', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', 
	'$fecha_hora', '$fecha_creacion')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
	//-------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {

		$nombre_tipo_documento                                 = 'RECIBO DE CAJA';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");
		$fecha_ymd                                             = $fecha_movimiento_contable_cuenta_personal;
		$fecha_seg                                             = time();
		$anyo                                                  = date("Y");
		$fecha_anyo                                            = $fecha_movimiento_contable_cuenta_personal;

		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		$cod_puc                                               = '2360';
		$codigo_puc                                            = '6225';
		$nombre_puc                                            = 'DEVOLUCIONES EN COMPRAS (CR)';
		$tipo_puc                                              = 'PASIVOS';
		$und_vendida                                           = '1';
		$costo_movimiento_contable                             = $total_factura_compra_retefuente;
		$total_costo_movimiento_contable                       = $total_factura_compra_retefuente;

		$sql_tercero = "SELECT cod_tercero, nombre1_tercero, apellido1_tercero, identificacion_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
		$consulta_tercero = mysqli_query($conectar, $sql_tercero);
		$datos_tercero = mysqli_fetch_assoc($consulta_tercero);
		
		$cod_tercero                                           = $datos_tercero['cod_tercero'];
		$cliente                                               = $datos_tercero['nombre1_tercero']." ".$datos_tercero['apellido1_tercero'];
		$identificacion_tercero                                = $datos_tercero['identificacion_tercero'];

		$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
		$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

		$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
		$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal + $total_factura_compra_retefuente;
		$saldo_actual_puc                                      = $total_factura_compra_retefuente;
		$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
		$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
		$valor_movimiento_contable_cuenta_personal             = $total_factura_compra_retefuente;
		$fecha_ymd_movimiento_caja                             = date("Y-m-d");
		$fecha_mes_movimiento_caja                             = date("Y-m");
		$fecha_anyo_movimiento_caja                            = date("Y");
		$fecha_hora_movimiento_caja                            = date("H:i:s");
		$fecha_seg_movimiento_caja                             = time();
		$fecha_creacion                                        = date("Y-m-d H:i:s");
		$simbolo_tipo_operacion                                = "-";
		$comentario                                            = $comentario." - factura de compra: ".$cod_factura." - proveedor: ".$cliente." - ID: ".$cod_info_factura_compra;

		$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, 
		nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
		cuenta, comentario, cod_tercero, cod_tipo_forma_pago, cod_info_factura_compra, simbolo_tipo_operacion, total_saldo, cod_tipo_pago)
		VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
		'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
		'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$cod_info_factura_compra', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_tipo_pago')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	}
	//-------------------------------------------------------------------------------------------------------------------//
	$actualizar_sql = "UPDATE tbl15_info_factura_compra SET nombre_estado_factura_dataico_dian = '$nombre_estado_factura_dataico_dian' WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
	//$borrar_sql_info_factura_compra = sprintf("DELETE FROM tbl15_info_factura_compra WHERE cod_info_factura_compra = '$cod_info_factura_compra'");
	//$Result1_info_factura_compra = mysqli_query($conectar, $borrar_sql_info_factura_compra) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_info_factura_compra.php">
<?php } ?>
