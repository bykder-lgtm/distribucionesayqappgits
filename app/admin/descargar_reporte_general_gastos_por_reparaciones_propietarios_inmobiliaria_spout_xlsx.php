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
	$nombre_archivo                = "REPORTE_GENERAL_GASTOS_POR_REPARACIONES_PROPIETARIOS_".$fecha_pago_reg_ini.'_A_'.$fecha_pago_reg_fin;
	$cabecera_emp                  = "REPORTE_GENERAL_GASTOS_POR_REPARACIONES_PROPIETARIOS";
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
	$writer->addRow(array('CONTRATO', 'PROPIETARIO | INMUEBLE', 'CONCEPTO', 'DESCRIPCION', 'COSTO FINAL (P.VENTA)', 'COSTO ADMINISTRACION DE REPARACION (P.COMPRA)', 'GANANCIA', 'FECHA', 'ID'));
// Then a foreach
	$sql_total_tipo_factura = "SELECT * FROM tbl15_gasto_inmueble_detalle_venta 
	WHERE (fecha_gasto_inmueble_detalle BETWEEN '$fecha_pago_reg_ini' AND '$fecha_pago_reg_fin') 
	ORDER BY cod_info_gasto_inmueble_detalle_venta DESC";
	$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
	while ($datos_total_tipo_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

		$cod_gasto_inmueble_detalle_venta                  = $datos_total_tipo_factura['cod_gasto_inmueble_detalle_venta'];
		$cod_info_gasto_inmueble_detalle_venta             = $datos_total_tipo_factura['cod_info_gasto_inmueble_detalle_venta'];
		$cod_factura                                       = $datos_total_tipo_factura['cod_factura'];
		$cod_tercero_propietario                           = $datos_total_tipo_factura['cod_tercero_propietario'];
		$fecha_gasto_inmueble_detalle                      = $datos_total_tipo_factura['fecha_gasto_inmueble_detalle'];
		$cod_administrador                                 = $datos_total_tipo_factura['cod_administrador'];
		$nombre_gasto_inmueble_detalle                     = $datos_total_tipo_factura['nombre_gasto_inmueble_detalle'];
		$descripcion_gasto_inmueble_detalle                = $datos_total_tipo_factura['descripcion_gasto_inmueble_detalle'];
		$nombre_producto                                   = $datos_total_tipo_factura['nombre_producto'];
		$precio_venta_producto                             = $datos_total_tipo_factura['precio_venta_producto'];
		$precio_compra_producto                            = $datos_total_tipo_factura['precio_compra_producto'];
		$total_ganancia                                    = $precio_venta_producto - $precio_compra_producto;

		$cod_cuentas_cobrar_factura_comision_propietario   = $datos_total_tipo_factura['cod_cuentas_cobrar_factura_comision_propietario'];
		$cod_cuentas_cobrar_alerta                         = $datos_total_tipo_factura['cod_cuentas_cobrar_alerta'];
		$fecha_mes                                         = '';
		$nombre_tabla_mes                                  = '';
		$nombre_tabla_anyo                                 = '';
		$cod_estado_pago                                   = '';
		$cod_estado_aprobado                               = 1;
		$pagina                                            = '';

		$sql_dependencia = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero_propietario'";
		$consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
		$datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

		$nombre_tercero                               = $datos_dependencia['nombre1_tercero'].' '.$datos_dependencia['apellido1_tercero'];

		$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
		$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
		$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

		$cuenta                        = $datos_administrador['cuenta'];

		$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero_propietario')";
		$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
		$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

		$cliente                             = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
		$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
		$direccion_cli                       = $matriz_cliente['direccion_tercero'];
		$nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
		$digito_tercero                      = $matriz_cliente['digito_tercero'];
		if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }
		
		$writer->addRow(array($cod_factura, $nombre_tercero.' | '.$nombre_producto, $nombre_gasto_inmueble_detalle, $descripcion_gasto_inmueble_detalle, $precio_venta_producto, $precio_compra_producto, $total_ganancia, date("d-m-Y", strtotime($fecha_gasto_inmueble_detalle)), $cod_info_gasto_inmueble_detalle_venta));
	}
	$writer->addRow(array('', '', '', 'TOTAL', $sum_precio_venta_producto, $sum_precio_compra_producto, $total_ingreso_por_reparaciones));

	$writer->close();
}