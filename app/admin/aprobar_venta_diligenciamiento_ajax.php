<?php
// Endpoint para actualizar el estado de revisión de una imagen
ob_start();
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

function sendJsonResponse($data) { echo json_encode($data); exit; }

try {
	// Obtener parámetros
    if (!isset($conectar) || !$conectar) { sendJsonResponse(['success' => false, 'message' => 'Error de conexión a la base de datos']); }
    $cod_info_factura_venta = isset($_POST['cod_info_factura_venta']) ? intval($_POST['cod_info_factura_venta']) : 0;
    if ($cod_info_factura_venta <= 0) { throw new Exception('Código de factura de venta no válido'); }
	//---------------------------------------------------------------------------------------------------------------------------------//
    $cod_caja_virtual                                               = 1;
    $modo_venta_por_defecto                                         = '';
    $pagina                                                         = '';
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
    $fecha_anyo                                                     = date("Y-m-d");
	$fecha_venta_ymd_dian                                           = $fecha_anyo;
	$fecha_venta_hora_dian                                          = date("Y-m-d");
	$total_datos                                                    = 1;
	$vlr_cancelado                                                  = 0;
    $cod_resolucion_facturacion                                     = 1;
    $cod_estado_factura                                             = '0';
	$fecha_anyo_seg                                                 = strtotime($fecha_anyo);
	$total_datos_data                                               = $total_datos;
	$nombre_estado_factura                                          = 'CERRADA';
	$nombre_maquina                                                 = gethostname();
	$fecha_pago_abono                                               = date("Y-m-d");
	$fecha                                                          = date("Y-m-d");
	$fecha_invert                                                   = date("Y-m-d");
	$fecha_seg                                                      = time();
	$fecha_creacion                                                 = date("Y-m-d H:i:s");
	$fecha_hoy                                                      = date("Y-m-d");
	$cod_estado_cuenta_cobrar                                       = 1;
	$fecha_modificacion_cuenta_cobrar                               = date("Y-m-d H:i:s");
	$conexion_internet                                              = "";
	$total_puntos_redimibles_campanya                               = 0;
	$valor_puntos_redimibles_campanya                               = 1;
	$cantidad_puntos_x_valor_redimibles_campanya                    = 0;
	$total_puntos_redimibles_campanya_producto                      = 0;
	$total_valor_dinero_puntos_redimibles_campanya                  = 0;
	$total_puntos_redimibles_campanya_tercero                       = 0;
	$descuento_ptj                                                  = '0';
	$iva_ptj                                                        = '0';
	$flete_ptj                                                      = '0';
	$vlr_vuelto                                                     = '0';
	$fecha_dia                                                      = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes                                                      = date("Y-m", $fecha_anyo_seg);
	$anyo                                                           = date("Y", $fecha_anyo_seg);
	$fecha_hora                                                     = date("H:i:s");
	$fecha_hora_venta_producto                                      = date("H:i:s");
	$fecha_ymd_venta_producto                                       = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes_venta_producto                                       = date("Y-m", $fecha_anyo_seg);
	$fecha_anyo_venta_producto                                      = date("Y", $fecha_anyo_seg);
	$fecha_seg_venta_producto                                       = time();
	$observacion_tercero                                            = "";
	$codigo_estado_facturacion                                      = "3"; //Venta Aprobada
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_infos_empresas = "SELECT cod_estado_subproducto_global, cod_estado_venta_dependencia_de_usuario_global, cod_estado_tipo_venta_zapateria_global, cod_estado_limite_venta_pos_factura_electronica_global, 
	cod_estado_enviar_factura_venta_electronica_dian_api_global, cod_estado_dia_sin_iva_global, cod_estado_puntos_redimibles_campanya_global, cod_estado_movimiento_contable_caja_personal_global, 
	cod_estado_movimiento_contable_cuenta_personal_global, cod_estado_verificar_precio_venta_en_cero_venta_temp_global, cod_estado_verificar_unidad_venta_en_cero_venta_temp_global, modo_venta_por_defecto_global, 
	limite_base_venta_aplicar_retefuente_global
	FROM tbl15_info_empresa WHERE (cod_info_empresa = '1')";
	$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
	$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

	$cod_estado_subproducto_global                                   = $info_empresa_data['cod_estado_subproducto_global'];
	$cod_estado_venta_dependencia_de_usuario_global                  = $info_empresa_data['cod_estado_venta_dependencia_de_usuario_global'];
	$cod_estado_tipo_venta_zapateria_global                          = $info_empresa_data['cod_estado_tipo_venta_zapateria_global'];
	$cod_estado_limite_venta_pos_factura_electronica_global          = $info_empresa_data['cod_estado_limite_venta_pos_factura_electronica_global'];
	$cod_estado_enviar_factura_venta_electronica_dian_api_global     = $info_empresa_data['cod_estado_enviar_factura_venta_electronica_dian_api_global'];
	$cod_estado_dia_sin_iva_global                                   = $info_empresa_data['cod_estado_dia_sin_iva_global'];
	$cod_estado_puntos_redimibles_campanya_global                    = $info_empresa_data['cod_estado_puntos_redimibles_campanya_global'];
	$cod_estado_movimiento_contable_caja_personal_global             = $info_empresa_data['cod_estado_movimiento_contable_caja_personal_global'];
	$cod_estado_movimiento_contable_cuenta_personal_global           = $info_empresa_data['cod_estado_movimiento_contable_cuenta_personal_global'];
	$cod_estado_verificar_precio_venta_en_cero_venta_temp_global     = $info_empresa_data['cod_estado_verificar_precio_venta_en_cero_venta_temp_global'];
	$cod_estado_verificar_unidad_venta_en_cero_venta_temp_global     = $info_empresa_data['cod_estado_verificar_unidad_venta_en_cero_venta_temp_global'];
	$modo_venta_por_defecto_global                                   = $info_empresa_data['modo_venta_por_defecto_global'];
	$limite_base_venta_aplicar_retefuente_global                     = $info_empresa_data['limite_base_venta_aplicar_retefuente_global'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$calcular_datos_cuenta_cobrar = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
	$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

	$monto_deuda                                                    = $datos_cuenta_cobrar['monto_deuda'];
	$monto_cuota                                                    = $datos_cuenta_cobrar['monto_cuota'];
	$cod_tercero                                                    = $datos_cuenta_cobrar['cod_tercero'];
	$cod_factura                                                    = $datos_cuenta_cobrar['cod_factura'];
	$direccion_tercero                                              = $datos_cuenta_cobrar['direccion_tercero'];
	$telefono1_tercero                                              = $datos_cuenta_cobrar['telefono1_tercero'];
	$identificacion_tercero                                         = $datos_cuenta_cobrar['identificacion_tercero'];
	$nombre_tipo_cobro                                              = $datos_cuenta_cobrar['nombre_tipo_cobro'];
	$correo_tercero                                                 = $datos_cuenta_cobrar['correo_tercero'];
	$cuenta                                                         = $datos_cuenta_cobrar['cuenta'];
	$cod_tipo_inventario                                            = $datos_cuenta_cobrar['cod_tipo_inventario'];
	
	// Obtener nombre del tercero
	$sql_tercero = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
	$consulta_tercero = mysqli_query($conectar, $sql_tercero);
	if ($consulta_tercero && mysqli_num_rows($consulta_tercero) > 0) {
	    $datos_tercero = mysqli_fetch_assoc($consulta_tercero);
	    $nombres_apellidos = trim($datos_tercero['nombre1_tercero'] . ' ' . $datos_tercero['nombre2_tercero'] . ' ' . $datos_tercero['apellido1_tercero'] . ' ' . $datos_tercero['apellido2_tercero']);
	} else {
	    $nombres_apellidos = 'Cliente';
	}
	$cod_tipo_pago                                                  = $datos_cuenta_cobrar['cod_tipo_pago'];
	$cod_tipo_forma_pago                                            = $datos_cuenta_cobrar['cod_tipo_forma_pago'];
	$nombre_tipo_moneda                                             = $datos_cuenta_cobrar['nombre_tipo_moneda'];
	$cod_tipo_metodo_envio                                          = $datos_cuenta_cobrar['cod_tipo_metodo_envio'];
	$cod_puntos_redimibles_campanya                                 = $datos_cuenta_cobrar['cod_puntos_redimibles_campanya'];
	$total_precio_compra                                            = $datos_cuenta_cobrar['total_precio_compra'];
	$total_precio_venta                                             = $datos_cuenta_cobrar['total_precio_venta'];
    $cod_entidad_crediticia                                         = $datos_cuenta_cobrar['cod_entidad_crediticia'];
    $cod_tienda                                                     = $datos_cuenta_cobrar['cod_tienda'];
    $cod_operador_credito                                           = $datos_cuenta_cobrar['cod_operador_credito'];
    $cod_tipo_forma_pago_operador_credito                           = $datos_cuenta_cobrar['cod_tipo_forma_pago_operador_credito'];
    $descripcion_tipo_forma_pago_operador_credito                   = $datos_cuenta_cobrar['descripcion_tipo_forma_pago_operador_credito'];
    $cod_administrador                                              = !empty($datos_cuenta_cobrar['cod_administrador_aliado_estrategico']) ? $datos_cuenta_cobrar['cod_administrador_aliado_estrategico'] : $datos_cuenta_cobrar['cod_administrador'];
 	//---------------------------------------------------------------------------------------------------------------------------------//
    if ($cod_tipo_inventario == '1') { $campo_und_inventario = 'und_producto'; } elseif ($cod_tipo_inventario == '2') { $campo_und_inventario = 'und_producto_bodega'; } else { $campo_und_inventario = 'und_producto'; }
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_resolucion_facturacion = "SELECT nombre_tipo_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
	$resultado_resolucion_facturacion = mysqli_query($conectar, $obtener_resolucion_facturacion) or die(mysqli_error($conectar));
	$info_resolucion_facturacion = mysqli_fetch_assoc($resultado_resolucion_facturacion);

	$nombre_tipo_factura                                            = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$cod_servicio_propina                                 = '22222222';
	$cod_servicio_cava                                    = '55555555';
	$cod_servicio_domicilio                               = '44444444';
	$cod_servicio_descuento_punto_redimible               = '11112222';
	$cod_servicio_descuento                               = '33333333';
	$cod_servicio_imp_bolsa                               = '11111111';
	$cod_servicio_retefuente                              = '11113333';
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_limite_venta_pos_factura_electronica_global == '1' && $nombre_tipo_factura == 'ELECTRONICA') {

	    $sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_venta WHERE (nombre_tipo_factura = 'ELECTRONICA') AND (nombre_estado_factura = 'CERRADA')";
	    $consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
	    $maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

	    $cod_factura                         = $maxima_factura['cod_factura']+1;
	} else {
		$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_venta WHERE (nombre_tipo_factura = '$nombre_tipo_factura') AND (nombre_estado_factura = 'CERRADA')";
		$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
		$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

		$cod_factura                         = $maxima_factura['cod_factura']+1;
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_mconsulta = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto_temporal ASC";
	$mconsulta = mysqli_query($conectar, $sql_mconsulta) or die(mysqli_error($conectar));
	$existen_reg = mysqli_num_rows($consulta_maxima_factura);
	while ($datos_temp = mysqli_fetch_assoc($mconsulta)) {

		$cod_venta_producto_temporal                = $datos_temp['cod_venta_producto_temporal'];
		$cod_producto                               = $datos_temp['cod_producto'];
		$cod_producto_barra                         = $datos_temp['cod_producto_barra'];
		$nombre_producto                            = $datos_temp['nombre_producto'];
		$und_venta                                  = $datos_temp['und_venta'];
		$nombre_tipo_precio_venta                   = $datos_temp['nombre_tipo_precio_venta'];
		$precio_compra_producto                     = $datos_temp['precio_compra_producto'];
		$cod_producto_barra_madre                   = $cod_producto_barra;

		$sqlr_consulta = "SELECT und_producto, und_producto_bodega, iva_ptj, comision_ptj, cod_dependencia, cod_opcion_descontable_inv, precio_compra_producto, precio_costo_producto, nombre_tipo_compra, iva_saludable_ptj, cod_marca 
		FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
		$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
		$datos_prod = mysqli_fetch_assoc($modificar_consulta);

		$nombre_tipo_compra                         = $datos_prod['nombre_tipo_compra'];
		if ($nombre_tipo_compra == '') { $nombre_tipo_compra = 'NORMAL'; } else { $nombre_tipo_compra = $datos_prod['nombre_tipo_compra']; }
		$total_compra_producto                      = $precio_compra_producto * $und_venta;
		$precio_costo_producto                      = $datos_prod['precio_costo_producto'];
		$total_costo_producto                       = $precio_costo_producto * $und_venta;
		$precio_venta_producto                      = $datos_temp['precio_venta_producto'];
		$total_venta_producto                       = $datos_temp['total_venta_producto'];
		$nombre_tipo_producto                       = $datos_temp['nombre_tipo_producto'];
		$nombre_tipo_unidad_medida                  = $datos_temp['nombre_tipo_unidad_medida'];
		$posologia_cantidad                         = $datos_temp['posologia_cantidad'];
		$posologia_peso                             = $datos_temp['posologia_peso'];
		$nombre_tipo_presentacion                   = $datos_temp['nombre_tipo_presentacion'];
		$nombre_via_administracion                  = $datos_temp['nombre_via_administracion'];
		$nombre_frec_duracion                       = $datos_temp['nombre_frec_duracion'];
		$cod_caja_virtual                           = $datos_temp['cod_caja_virtual'];
		$fecha_alerta                               = $datos_temp['fecha_alerta'];
		$und_producto_inv                           = $datos_prod['und_producto'];
		$und_producto_bodega_inv                    = $datos_prod['und_producto_bodega'];
		$comision_ptj                               = $datos_prod['comision_ptj'];
		if ($cod_estado_venta_dependencia_de_usuario_global == '1') { $cod_dependencia = $cod_dependencia_user; } else { $cod_dependencia = $datos_prod['cod_dependencia']; }
		$precio_venta_producto_orig                 = $datos_temp['precio_venta_producto_orig'];
		$comentario_producto                        = $datos_temp['comentario_producto'];
		$und_venta_ext                              = $datos_temp['und_venta'];

		$placa_producto                             = $datos_temp['placa_producto'];
		$fecha_ymd_parqueo_ini                      = $datos_temp['fecha_ymd_parqueo_ini'];
		$fecha_hora_parqueo_ini                     = $datos_temp['fecha_hora_parqueo_ini'];
		$fecha_ymd_parqueo_fin                      = $datos_temp['fecha_ymd_parqueo_fin'];
		$fecha_hora_parqueo_fin                     = $datos_temp['fecha_hora_parqueo_fin'];
		$cod_parqueo_cotizacion_venta_producto      = $datos_temp['cod_parqueo_cotizacion_venta_producto'];
		$cod_info_parqueo_cotizacion_factura_venta  = $datos_temp['cod_info_parqueo_cotizacion_factura_venta'];
		$cod_info_hotel_cotizacion_factura_venta    = $datos_temp['cod_info_hotel_cotizacion_factura_venta'];
		$cod_hotel_cotizacion_venta_producto        = $datos_temp['cod_hotel_cotizacion_venta_producto'];
		$cod_opcion_descontable_inv                 = $datos_prod['cod_opcion_descontable_inv'];

		$cod_categoria                              = $datos_temp['cod_categoria'];
		$cod_categoria_sub                          = $datos_temp['cod_categoria_sub'];
		$cod_tipo_producto_cocina                   = $datos_temp['cod_tipo_producto_cocina'];
		$nombre_tipo_precio                         = $datos_temp['nombre_tipo_precio'];
		$peso_producto                              = $datos_temp['peso_producto'];
		$unidad_medida_peso                         = $datos_temp['unidad_medida_peso'];
		$cod_estado_cava                            = $datos_temp['cod_estado_cava'];
		$und_caja_sobre                             = $datos_temp['und_caja_sobre'];
		$cajas_sobre                                = $datos_temp['cajas_sobre'];
		$und_sobre                                  = $datos_temp['und_sobre'];
		$nombre_tipo_und_caja_sobre                 = $datos_temp['nombre_tipo_und_caja_sobre'];
		$cod_estado_tipo_hotel_parqueo              = $datos_temp['cod_estado_tipo_hotel_parqueo'];

		$total_horas                                = $datos_temp['total_horas'];
		$total_dias                                 = $datos_temp['total_dias'];
		$cod_tipo_cod_barra                         = $datos_temp['cod_tipo_cod_barra'];
		$iva_saludable_ptj                          = $datos_prod['iva_saludable_ptj'];
		$nombre_tipo_cobro                          = $datos_temp['nombre_tipo_cobro'];
		$cod_marca                                  = $datos_prod['cod_marca'];
		$cupo_credito_ptj                           = $datos_temp['cupo_credito_ptj'];
		$serial1_producto                           = $datos_temp['serial1_producto'];
		$serial2_producto                           = $datos_temp['serial2_producto'];

		$descuento_valor_pesos                      = $precio_venta_producto_orig - $precio_venta_producto;
		//$descuento_ptj                            = ($descuento_valor_pesos / $precio_venta_producto_orig) * 100;
		$und_producto                               = $und_producto_inv - $und_venta;
		$total_puntos_redimibles_campanya_producto  = ($total_venta_producto / $valor_puntos_redimibles_campanya) * $cantidad_puntos_x_valor_redimibles_campanya;

		$iva_ptj                                    = $datos_prod['iva_ptj'];
		if ($cod_estado_dia_sin_iva_global == '1') { $iva_ptj = '0'; }

		if ($cod_tipo_inventario == '1') { 
			if ($cod_opcion_descontable_inv == '0') { $und_producto = $und_producto_inv - $und_venta; } else { $und_producto = 0; }
		} elseif ($cod_tipo_inventario == '2') { 
			if ($cod_opcion_descontable_inv == '0') { $und_producto = $und_producto_bodega_inv - $und_venta; } else { $und_producto = 0; }
		} else { 
			$und_producto = $und_producto_inv - $und_venta; 
		}

		$agregar_reg_venta_producto = "INSERT INTO tbl15_venta_producto (cod_info_factura_venta, cod_factura, cod_producto, cod_producto_barra, 
		nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, 
		total_venta_producto, nombre_tipo_producto, und_producto, und_producto_bodega_inv, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
		nombre_tipo_unidad_medida, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
		cod_resolucion_facturacion, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, comision_ptj, 
		cod_tipo_pago, cod_tipo_forma_pago, total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, vlr_cancelado, vlr_vuelto, 
		cod_dependencia, cod_tipo_inventario, precio_venta_producto_orig, descuento_ptj, 
		cod_opcion_descontable_inv, cod_categoria, nombre_tipo_precio, nombre_tipo_compra, cod_tipo_metodo_envio, cod_venta_producto_temporal, 
		total_horas, total_dias, cod_tipo_cod_barra, iva_saludable_ptj, cod_puntos_redimibles_campanya, total_puntos_redimibles_campanya_producto, cod_marca, 
		cupo_credito_ptj, serial1_producto, serial2_producto)
		VALUES ('$cod_info_factura_venta', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
		'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', 
		'$total_venta_producto', '$nombre_tipo_producto', '$und_producto', '$und_producto_bodega_inv', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
		'$nombre_tipo_unidad_medida', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
		'$cod_resolucion_facturacion', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$comision_ptj', 
		'$cod_tipo_pago', '$cod_tipo_forma_pago', '$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$vlr_cancelado', '$vlr_vuelto', 
		'$cod_dependencia', '$cod_tipo_inventario', '$precio_venta_producto_orig', '$descuento_ptj', 
		'$cod_opcion_descontable_inv', '$cod_categoria', '$nombre_tipo_precio', '$nombre_tipo_compra', '$cod_tipo_metodo_envio', '$cod_venta_producto_temporal', 
		'$total_horas', '$total_dias', '$cod_tipo_cod_barra', '$iva_saludable_ptj', '$cod_puntos_redimibles_campanya', '$total_puntos_redimibles_campanya_producto', '$cod_marca', 
		'$cupo_credito_ptj', '$serial1_producto', '$serial2_producto')";
		$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));

		$actualiza_producto = sprintf("UPDATE tbl15_producto SET $campo_und_inventario = '$und_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
		$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));
	}
	$borrar_sql = sprintf("DELETE FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

	$agregar_regis = sprintf("UPDATE tbl15_info_factura_venta SET cod_estado_factura = '$cod_estado_factura', cod_factura = '$cod_factura', fecha_anyo = '$fecha_anyo', 
	fecha_dia = '$fecha_dia', fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', total_precio_compra = '$total_precio_compra', 
	total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data', cod_tercero = '$cod_tercero', nombre_estado_factura = '$nombre_estado_factura',
	cuenta = '$cuenta', vlr_cancelado = '$vlr_cancelado', vlr_vuelto = '$vlr_vuelto', cod_tipo_pago = '$cod_tipo_pago', cod_administrador = '$cod_administrador', 
	cod_tipo_forma_pago = '$cod_tipo_forma_pago', nombre_tipo_factura = '$nombre_tipo_factura',  nombre_tipo_moneda = '$nombre_tipo_moneda', 
	nombre_maquina = '$nombre_maquina', cod_resolucion_facturacion = '$cod_resolucion_facturacion', 
	observacion_tercero = '$observacion_tercero', codigo_estado_facturacion = '$codigo_estado_facturacion' 
	WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$resultado = mysqli_query($conectar, $agregar_regis);
    if (!$resultado) { sendJsonResponse(['success' => false, 'message' => 'Error al actualizar: ' . mysqli_error($conectar)]); }

    // Obtener información del nuevo estado
    $sql_estado = "SELECT nombre_estado_facturacion, color_fondo_celda_estado FROM tbl15_estado_facturacion WHERE codigo_estado_facturacion = '$codigo_estado_facturacion'";
    $resultado_estado = mysqli_query($conectar, $sql_estado);
    $datos_estado = mysqli_fetch_assoc($resultado_estado);
    
    $nombre_estado_facturacion = isset($datos_estado['nombre_estado_facturacion']) ? $datos_estado['nombre_estado_facturacion'] : 'VENTA APROBADA';
    $color_estado              = isset($datos_estado['color_fondo_celda_estado']) ? $datos_estado['color_fondo_celda_estado'] : '#28a745';

    $nombre_notificacion_alerta_renovacion            = '';
    $descipcion_notificacion_alerta_renovacion        = '¡Felicitaciones, Se ha aprobado la venta!';
    $cod_tipo_notificacion_alerta                     = '6';
    $fecha_creacion                                   = date('Y-m-d H:i:s');
    $fecha                                            = date('Y-m-d');
    $fecha_mes                                        = date('Y-m');
    $anyo                                             = date('Y');
    $fecha_invert                                     = date('Y-m-d');
    $fecha_seg                                        = time();
    $cod_estado                                       = '0';
    $cod_estado_aviso                                 = '0';

    $sql_insert = "INSERT INTO tbl15_notificacion_alerta_renovacion (cod_info_factura_venta, cod_administrador, cod_tienda, nombre_notificacion_alerta_renovacion, descipcion_notificacion_alerta_renovacion, 
    cod_tipo_notificacion_alerta, fecha_creacion, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_estado, cod_estado_aviso) 
    VALUES ('$cod_info_factura_venta', '$cod_administrador', '$cod_tienda', '$nombre_notificacion_alerta_renovacion', '$descipcion_notificacion_alerta_renovacion', 
    '$cod_tipo_notificacion_alerta', '$fecha_creacion', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_estado', '$cod_estado_aviso')";
    $resultado = mysqli_query($conectar, $sql_insert);

    sendJsonResponse(['success' => true, 'message' => 'Estado actualizado correctamente', 'cod_info_factura_venta' => $cod_info_factura_venta, 'codigo_estado_facturacion' => $codigo_estado_facturacion, 'nombre_estado_facturacion' => $nombre_estado_facturacion, 'color_estado' => $color_estado]);
} catch (Exception $e) {
    sendJsonResponse(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
 