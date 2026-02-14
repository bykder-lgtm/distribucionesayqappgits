<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");

require_once __DIR__ . '/class_php/Spout-2.7.3/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
$writer = WriterFactory::create(Type::XLSX);
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
if (isset($_GET['fecha_pago_reg_ini'])) { 
    $fecha_pago_reg_ini            = addslashes($_GET['fecha_pago_reg_ini']);
    $fecha_pago_reg_fin            = addslashes($_GET['fecha_pago_reg_fin']);
	$fecha                         = date("Y_m_d");
	$hora                          = date("H_i_s");
	$nombre_archivo                = "REPORTE_GENERAL_TOTAL_INGRESOS_".$fecha.'__'.$fecha;
	$cabecera_emp                  = "REPORTE_GENERAL_TOTAL_INGRESOS";
	$nombre_tipo_solicitud         = 'SOLICITUD DE ARRIENDO';
	//**********************************************************************************************************************************************************//
	$writer->openToBrowser($nombre_archivo);
	//**********************************************************************************************************************************************************//
	$sql_total_cuentas_cobrar_factura_comision_propietario = "SELECT SUM(deduccion_comision) AS total_ingreso_por_comision_administarcion, SUM(total_ingreso) AS total_valor_pagado_a_propietario 
	FROM tbl15_cuentas_cobrar_factura_comision_propietario WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin')";
	$consulta_total_cuentas_cobrar_factura_comision_propietario = mysqli_query($conectar, $sql_total_cuentas_cobrar_factura_comision_propietario) or die(mysqli_error($conectar));
	$datos_total_cuentas_cobrar_factura_comision_propietario = mysqli_fetch_assoc($consulta_total_cuentas_cobrar_factura_comision_propietario);

	$total_ingreso_por_comision_administarcion  = $datos_total_cuentas_cobrar_factura_comision_propietario['total_ingreso_por_comision_administarcion'];
	$total_valor_pagado_a_propietario           = $datos_total_cuentas_cobrar_factura_comision_propietario['total_valor_pagado_a_propietario'];
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_total_tipo_factura = "SELECT SUM(total_recibido) AS total_recibido_pago_inquilino, SUM(monto_cuota_interes) AS total_ingreso_por_interes_inquilino 
	FROM tbl15_cuentas_cobrar_alerta WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (cod_estado = '1')";
	$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
	$datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura);

	$total_recibido_pago_inquilino              = $datos_total_tipo_factura['total_recibido_pago_inquilino'];
	$total_ingreso_por_interes_inquilino        = $datos_total_tipo_factura['total_ingreso_por_interes_inquilino'];
	$total_interes_mas_total_interes            = $total_recibido_pago_inquilino + $total_ingreso_por_interes_inquilino;
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_total_tipo_factura = "SELECT SUM(valor_solicitud_arriendo) AS total_ingreso_por_solicitud_arriendo_inquilino 
	FROM tbl15_tercero 
	WHERE (fecha_solicitud_arriendo BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_solicitud = '$nombre_tipo_solicitud')";
	$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
	$datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura);

	$total_ingreso_por_solicitud_arriendo_inquilino  = $datos_total_tipo_factura['total_ingreso_por_solicitud_arriendo_inquilino'];
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_total_gasto_inmueble_detalle_venta = "SELECT SUM(precio_compra_producto) AS sum_precio_compra_producto, SUM(precio_venta_producto) AS sum_precio_venta_producto 
	FROM tbl15_gasto_inmueble_detalle_venta WHERE (fecha_gasto_inmueble_detalle BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin')";
	$consulta_total_gasto_inmueble_detalle_venta = mysqli_query($conectar, $sql_total_gasto_inmueble_detalle_venta) or die(mysqli_error($conectar));
	$datos_total_gasto_inmueble_detalle_venta = mysqli_fetch_assoc($consulta_total_gasto_inmueble_detalle_venta);

	$sum_precio_compra_producto                        = $datos_total_gasto_inmueble_detalle_venta['sum_precio_compra_producto'];
	$sum_precio_venta_producto                         = $datos_total_gasto_inmueble_detalle_venta['sum_precio_venta_producto'];
	$total_ingreso_por_reparaciones                    = $sum_precio_venta_producto - $sum_precio_compra_producto;
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_ingresos_inmobil = "SELECT SUM(costo) AS total_otros_ingresos_inmobil FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO') AND (cod_dependencia = '1')";
	$resultado_ingresos_inmobil = mysqli_query($conectar, $sql_ingresos_inmobil) or die(mysqli_error($conectar));
	$info_ingresos_inmobil = mysqli_fetch_assoc($resultado_ingresos_inmobil);

	$total_otros_ingresos_inmobil                      = $info_ingresos_inmobil['total_otros_ingresos_inmobil'];
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_ingresos_juridica = "SELECT SUM(costo) AS total_otros_ingresos_juridica FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO') AND (cod_dependencia = '2')";
	$resultado_ingresos_juridica = mysqli_query($conectar, $sql_ingresos_juridica) or die(mysqli_error($conectar));
	$info_ingresos_juridica = mysqli_fetch_assoc($resultado_ingresos_juridica);

	$total_otros_ingresos_juridica                             = $info_ingresos_juridica['total_otros_ingresos_juridica'];
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_ingresos_abogado_yamid = "SELECT SUM(costo) AS total_otros_ingresos_abogado_yamid FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO') AND (cod_dependencia = '3')";
	$resultado_ingresos_abogado_yamid = mysqli_query($conectar, $sql_ingresos_abogado_yamid) or die(mysqli_error($conectar));
	$info_ingresos_abogado_yamid = mysqli_fetch_assoc($resultado_ingresos_abogado_yamid);

	$total_otros_ingresos_abogado_yamid                             = $info_ingresos_abogado_yamid['total_otros_ingresos_abogado_yamid'];
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_ingresos_abogado_trillo = "SELECT SUM(costo) AS total_otros_ingresos_abogado_trillo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'INGRESO') AND (cod_dependencia = '4')";
	$resultado_ingresos_abogado_trillo = mysqli_query($conectar, $sql_ingresos_abogado_trillo) or die(mysqli_error($conectar));
	$info_ingresos_abogado_trillo = mysqli_fetch_assoc($resultado_ingresos_abogado_trillo);

	$total_otros_ingresos_abogado_trillo                             = $info_ingresos_abogado_trillo['total_otros_ingresos_abogado_trillo'];
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_egresos_inmobil = "SELECT SUM(costo) AS total_otros_egresos_inmobil FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'EGRESO') AND (cod_dependencia = '1')";
	$resultado_egresos_inmobil = mysqli_query($conectar, $sql_egresos_inmobil) or die(mysqli_error($conectar));
	$info_egresos_inmobil = mysqli_fetch_assoc($resultado_egresos_inmobil);

	$total_otros_egresos_inmobil                      = $info_egresos_inmobil['total_otros_egresos_inmobil'];
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_egresos_juridica = "SELECT SUM(costo) AS total_otros_egresos_juridica FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'EGRESO') AND (cod_dependencia = '2')";
	$resultado_egresos_juridica = mysqli_query($conectar, $sql_egresos_juridica) or die(mysqli_error($conectar));
	$info_egresos_juridica = mysqli_fetch_assoc($resultado_egresos_juridica);

	$total_otros_egresos_juridica                             = $info_egresos_juridica['total_otros_egresos_juridica'];
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_egresos_abogado_yamid = "SELECT SUM(costo) AS total_otros_egresos_abogado_yamid FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'EGRESO') AND (cod_dependencia = '3')";
	$resultado_egresos_abogado_yamid = mysqli_query($conectar, $sql_egresos_abogado_yamid) or die(mysqli_error($conectar));
	$info_egresos_abogado_yamid = mysqli_fetch_assoc($resultado_egresos_abogado_yamid);

	$total_otros_egresos_abogado_yamid                             = $info_egresos_abogado_yamid['total_otros_egresos_abogado_yamid'];
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_egresos_abogado_trillo = "SELECT SUM(costo) AS total_otros_egresos_abogado_trillo FROM tbl15_egreso WHERE (fecha_dmy BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (nombre_tipo_puc = 'EGRESO') AND (cod_dependencia = '4')";
	$resultado_egresos_abogado_trillo = mysqli_query($conectar, $sql_egresos_abogado_trillo) or die(mysqli_error($conectar));
	$info_egresos_abogado_trillo = mysqli_fetch_assoc($resultado_egresos_abogado_trillo);

	$total_otros_egresos_abogado_trillo                             = $info_egresos_abogado_trillo['total_otros_egresos_abogado_trillo'];
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$total_otros_ingresos                             = $total_otros_ingresos_inmobil + $total_otros_ingresos_juridica + $total_otros_ingresos_abogado_yamid + $total_otros_ingresos_abogado_trillo;
	$total_otros_egresos                              = $total_otros_egresos_inmobil + $total_otros_egresos_juridica + $total_otros_egresos_abogado_yamid + $total_otros_egresos_abogado_trillo;
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_total_cuentas_cobrar_alerta = "SELECT SUM(ingreso_gasto_juridica) AS total_otros_ingresos_juridica_arriendo FROM tbl15_cuentas_cobrar_alerta 
	WHERE (fecha_pago_reg BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') AND (cod_estado = '1')";
	$consulta_total_cuentas_cobrar_alerta = mysqli_query($conectar, $sql_total_cuentas_cobrar_alerta) or die(mysqli_error($conectar));
	$datos_total_cuentas_cobrar_alerta = mysqli_fetch_assoc($consulta_total_cuentas_cobrar_alerta);

	$total_otros_ingresos_juridica_arriendo           = $datos_total_cuentas_cobrar_alerta['total_otros_ingresos_juridica_arriendo'];
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$sql_total_ingreso_por_reparaciones_arrendatario = "SELECT SUM(precio_venta_producto - precio_compra_producto) AS total_ingreso_por_reparaciones_arrendatario FROM tbl15_gasto_inmueble_inquilino_venta 
	WHERE (fecha_gasto_inmueble_detalle BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin')";
	$consulta_total_ingreso_por_reparaciones_arrendatario = mysqli_query($conectar, $sql_total_ingreso_por_reparaciones_arrendatario) or die(mysqli_error($conectar));
	$datos_total_ingreso_por_reparaciones_arrendatario = mysqli_fetch_assoc($consulta_total_ingreso_por_reparaciones_arrendatario);

	$total_ingreso_por_reparaciones_arrendatario           = $datos_total_ingreso_por_reparaciones_arrendatario['total_ingreso_por_reparaciones_arrendatario'];
	//**********************************************************************************************************************************************************//
	//**********************************************************************************************************************************************************//
	$total_ingreso                                    = $total_ingreso_por_interes_inquilino + $total_ingreso_por_reparaciones + $total_ingreso_por_reparaciones_arrendatario + $total_ingreso_por_solicitud_arriendo_inquilino + $total_ingreso_por_comision_administarcion + $total_otros_ingresos_juridica_arriendo + $total_otros_ingresos_inmobil + $total_otros_ingresos_juridica + $total_otros_ingresos_abogado_yamid + $total_otros_ingresos_abogado_trillo;
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
// Headers
	$writer->addRow(array('0TOTAL INGRESO POR INTERESES', 'TOTAL INGRESO POR REPARACIONES (PROPIETARIOS)', 'TOTAL INGRESO POR REPARACIONES (ARRENDATARIO)', 'TOTAL INGRESO POR SOLICITUD DE ESTUDIO', 
	'TOTAL INGRESO POR COMISION DE ADMINISTRACION', 'TOTAL INGRESO GESTION DE JURIDICA (COBRANZA)', 'TOTAL INGRESO INMOBILIARIA (INGRESO_P)', 'TOTAL INGRESO JURIDICA (INGRESO_P)', 
	'TOTAL INGRESO ABOGADO YAMID (INGRESO_P)', 'TOTAL INGRESO ABOGADO TRILLO (INGRESO_P)', 'TOTAL INGRESOS'));
// Then a foreach
/*
	$sql = "SELECT cod_productos, cod_productos_var, nombre_productos, cod_marcas, cod_proveedores, cod_nomenclatura, cod_tipo, cod_lineas, cod_ccosto, 
	cod_paises, numero_factura, unidades, cajas, und_caja, und_sobre, unidades_total, unidades_faltantes, unidades_vendidas, und_orig, precio_compra, 
	precio_costo, precio_venta, precio_venta2, precio_venta3, precio_venta4, precio_venta5, vlr_total_compra, vlr_total_venta, cod_interno, tope_minimo, 
	utilidad, total_utilidad, total_mercancia, total_venta, gasto, descuento, tipo_pago, ip, codificacion, url, cod_original, detalles, descripcion, 
	dto1, dto2, iva, iva_v, fechas_dia, fechas_mes, fechas_anyo, fechas_hora, fechas_vencimiento, porcentaje_vendedor, fechas_vencimiento_seg, 
	fechas_agotado, fechas_agotado_seg, vendedor, cuenta, promo, cod_dependencia, precio_compra_viejo, precio_costo_viejo, und_min_precio_venta_desc, 
	fecha_ult_compra, fecha_ult_venta, nombre_marcas, nombre_tipo_producto, nombre_tipo_referencia, nombre_tipo_unidad_medida, nombre_clase_producto, 
	cod_tercero, precio_ipc, precio_ipc_total  
	FROM productos ORDER BY cod_productos DESC";
	$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
	while ($datos = mysqli_fetch_assoc($consulta)) {

		$cod_productos                           = $datos['cod_productos'];
		$cod_productos_var                       = $datos['cod_productos_var'];
		$nombre_productos                        = $datos['nombre_productos'];
		$cod_marcas                              = $datos['cod_marcas'];
		$cod_proveedores                         = $datos['cod_proveedores'];
		$cod_nomenclatura                        = $datos['cod_nomenclatura'];
		$cod_tipo                                = $datos['cod_tipo'];
		$cod_lineas                              = $datos['cod_lineas'];
*/

		$writer->addRow(array($total_ingreso_por_interes_inquilino, $total_ingreso_por_reparaciones, $total_ingreso_por_reparaciones_arrendatario, $total_ingreso_por_solicitud_arriendo_inquilino, 
		$total_ingreso_por_comision_administarcion, $total_otros_ingresos_juridica_arriendo, $total_otros_ingresos_inmobil, $total_otros_ingresos_juridica, 
		$total_otros_ingresos_abogado_yamid, $total_otros_ingresos_abogado_trillo, $total_ingreso));
	//}
	$writer->close();
}