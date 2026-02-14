<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php'); 
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$cuenta_actual = addslashes($_SESSION['usuario']);
date_default_timezone_set("America/Bogota");

$tab                                                      = addslashes($_GET['tab']);
$tipo                                                     = addslashes($_GET['tipo']);
$campo                                                    = addslashes($_GET['campo']);
//$pagina                                                   = addslashes($_GET['pagina']);
//----------------------------------------------------------------------------------------------------------------------------------//
if ($tipo == 'eliminar' && $tab == 'tbl15_info_factura_compra') {
	$cod_info_factura_compra                                  = intval($_GET['llave']);
	$cod_cuentas_pagar                                        = intval($_GET['cod_cuentas_pagar']);
	$comentario                                               = 'devolucion compra btn elim sup';
	$fecha_elim                                               = date("Y-m-d H:i:s");	
	$usuario_elim                                             = $cuenta_actual;

	$sql_factura_compra_producto = "SELECT * FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$resultado_factura_compra_producto = mysqli_query($conectar, $sql_factura_compra_producto);
	while ($info_factura_compra_producto = mysqli_fetch_assoc($resultado_factura_compra_producto)) {

		$cod_factura_compra_producto                              = $info_factura_compra_producto['cod_factura_compra_producto'];
		//$cod_info_factura_compra                                  = $info_factura_compra_producto['cod_info_factura_compra'];
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
//----------------------------------------------------------------------------------------------------------------------------------//
	$sql_info_factura_compra = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$resultado_info_factura_compra = mysqli_query($conectar, $sql_info_factura_compra);
	$info_info_factura_compra = mysqli_fetch_assoc($resultado_info_factura_compra);

	//$cod_info_factura_compra                                      = $info_info_factura_compra['cod_info_factura_compra'];
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

	$borrar_sql_info_factura_compra = sprintf("DELETE FROM tbl15_info_factura_compra WHERE cod_info_factura_compra = '$cod_info_factura_compra'");
	$Result1_info_factura_compra = mysqli_query($conectar, $borrar_sql_info_factura_compra) or die(mysqli_error($conectar));
//----------------------------------------------------------------------------------------------------------------------------------//
	$sql_venta_producto_temporal = "SELECT * FROM tbl15_cuentas_pagar WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')";
	$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
	$datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

	$cod_cuentas_pagar                 = $datos_venta_producto_temporal['cod_cuentas_pagar']; 
	$cod_factura                       = $datos_venta_producto_temporal['cod_factura']; 
	$cod_proveedores                   = $datos_venta_producto_temporal['cod_proveedores']; 
	$monto_deuda                       = $datos_venta_producto_temporal['monto_deuda']; 
	$subtotal                          = $datos_venta_producto_temporal['subtotal']; 
	$descuento                         = $datos_venta_producto_temporal['descuento']; 
	$abonado                           = $datos_venta_producto_temporal['abonado']; 
	$mensaje                           = $datos_venta_producto_temporal['mensaje']; 
	$vendedor                          = $datos_venta_producto_temporal['vendedor']; 
	$cuenta                            = $datos_venta_producto_temporal['cuenta']; 
	$fecha_pago                        = $datos_venta_producto_temporal['fecha_pago']; 
	$fecha                             = $datos_venta_producto_temporal['fecha']; 
	$fecha_invert                      = $datos_venta_producto_temporal['fecha_invert']; 
	$fecha_seg                         = $datos_venta_producto_temporal['fecha_seg']; 
	$cod_info_factura_compra           = $datos_venta_producto_temporal['cod_info_factura_compra'];
	$cod_abono_global                  = $datos_venta_producto_temporal['cod_abono_global']; 
	$cod_administrador                 = $datos_venta_producto_temporal['cod_administrador']; 
	$cod_estado                        = $datos_venta_producto_temporal['cod_estado'];  	
	 	
	$sql_data = "INSERT INTO tbl15_cuentas_pagar_copia (cod_cuentas_pagar, cod_factura, cod_proveedores, cod_tercero, monto_deuda, subtotal, descuento, abonado, mensaje, vendedor, 
	cuenta, fecha_pago, fecha, fecha_invert, fecha_seg, cod_info_factura_compra, cod_abono_global, cod_administrador, cod_estado, fecha_elim, usuario_elim) 
	VALUES ('$cod_cuentas_pagar', '$cod_factura', '$cod_proveedores', '$cod_tercero', '$monto_deuda', '$subtotal', '$descuento', '$abonado', '$mensaje', '$vendedor', 
	'$cuenta', '$fecha_pago', '$fecha', '$fecha_invert', '$fecha_seg', '$cod_info_factura_compra', '$cod_abono_global', '$cod_administrador', '$cod_estado', '$fecha_elim', '$usuario_elim')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_pagar WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
//----------------------------------------------------------------------------------------------------------------------------------//
	$sql_pagar_abono = "SELECT * FROM tbl15_cuentas_pagar_abonos WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')";
	$consulta_pagar_abono = mysqli_query($conectar, $sql_pagar_abono);
	while ($datos_pagar_abono = mysqli_fetch_assoc($consulta_pagar_abono)) { 
	 	
		$cod_cuentas_pagar_abonos          = $datos_pagar_abono['cod_cuentas_pagar_abonos']; 
		$cod_factura                       = $datos_pagar_abono['cod_factura']; 
		$cod_proveedores                   = $datos_pagar_abono['cod_proveedores']; 
		$monto_deuda                       = $datos_pagar_abono['monto_deuda']; 
		$subtotal                          = $datos_pagar_abono['subtotal']; 
		$descuento                         = $datos_pagar_abono['descuento']; 
		$abonado                           = $datos_pagar_abono['abonado']; 
		$mensaje                           = $datos_pagar_abono['mensaje']; 
		$vendedor                          = $datos_pagar_abono['vendedor']; 
		$cuenta                            = $datos_pagar_abono['cuenta']; 
		$fecha_pago                        = $datos_pagar_abono['fecha_pago']; 
		$fecha_anyo                        = $datos_pagar_abono['fecha_anyo']; 
		$fecha_mes                         = $datos_pagar_abono['fecha_mes']; 
		$anyo                              = $datos_pagar_abono['anyo']; 
		$fecha_invert                      = $datos_pagar_abono['fecha_invert'];
		$fecha_seg                         = $datos_pagar_abono['fecha_seg']; 
		$hora                              = $datos_pagar_abono['hora']; 
		$nombre_rete_fuente_ptj            = $datos_pagar_abono['nombre_rete_fuente_ptj'];  	
		$cod_cuentas_pagar                 = $datos_pagar_abono['cod_cuentas_pagar'];  	
		$cod_info_factura_compra           = $datos_pagar_abono['cod_info_factura_compra'];  	
		$cod_abono_global                  = $datos_pagar_abono['cod_abono_global'];  	
		$cod_administrador                 = $datos_pagar_abono['cod_administrador'];  	
		$cod_estado                        = $datos_pagar_abono['cod_estado'];  	
		$cod_tipo_forma_pago               = $datos_pagar_abono['cod_tipo_forma_pago'];  	
		$cod_dependencia                   = $datos_pagar_abono['cod_dependencia'];  	
			
		$sql_data = "INSERT INTO tbl15_cuentas_pagar_abonos_copia (cod_cuentas_pagar_abonos, cod_factura, cod_proveedores, cod_tercero, monto_deuda, subtotal, descuento, abonado, mensaje, vendedor, 
		cuenta, fecha_pago, fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, nombre_rete_fuente_ptj, cod_cuentas_pagar, 
		cod_info_factura_compra, cod_abono_global, cod_administrador, cod_estado, cod_tipo_forma_pago, cod_dependencia, fecha_elim, usuario_elim) 
		VALUES ('$cod_cuentas_pagar_abonos', '$cod_factura', '$cod_proveedores', '$cod_tercero', '$monto_deuda', '$subtotal', '$descuento', '$abonado', '$mensaje', '$vendedor', 
		'$cuenta', '$fecha_pago', '$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$nombre_rete_fuente_ptj', '$cod_cuentas_pagar', 
		'$cod_info_factura_compra', '$cod_abono_global', '$cod_administrador', '$cod_estado', '$cod_tipo_forma_pago', '$cod_dependencia', '$fecha_elim', '$usuario_elim')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
	$borrar_sql = sprintf("DELETE FROM tbl15_cuentas_pagar_abonos WHERE cod_cuentas_pagar = '$cod_cuentas_pagar'");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_info_factura_compra.php">
<?php } ?>
