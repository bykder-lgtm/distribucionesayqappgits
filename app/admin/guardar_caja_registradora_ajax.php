<?php
date_default_timezone_set("America/Bogota");
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                              = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                     = $_SESSION['usuario'];
$cod_administrador                          = $_SESSION['cod_administrador'];
$comentario                                 = "";
$pagina_redirect_imprimir                   = "";
$condicion_producto_con_precio_venta_cero   = "";
$conexion_internet                          = "";
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT cod_estado_generar_movimiento_contable_automatico_global, cod_estado_promediar_precio_compra_y_venta_cargar_factura_global, 
cod_estado_enviar_factura_documento_soporte_dian_api_global, cod_estado_movimiento_contable_caja_personal_global, cod_estado_movimiento_contable_cuenta_personal_global
FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_generar_movimiento_contable_automatico_global         = $info_empresa_data['cod_estado_generar_movimiento_contable_automatico_global'];
$cod_estado_promediar_precio_compra_y_venta_cargar_factura_global = $info_empresa_data['cod_estado_promediar_precio_compra_y_venta_cargar_factura_global'];
$cod_estado_enviar_factura_documento_soporte_dian_api_global      = $info_empresa_data['cod_estado_enviar_factura_documento_soporte_dian_api_global'];
$cod_estado_movimiento_contable_caja_personal_global              = $info_empresa_data['cod_estado_movimiento_contable_caja_personal_global'];
$cod_estado_movimiento_contable_cuenta_personal_global            = $info_empresa_data['cod_estado_movimiento_contable_cuenta_personal_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_admin_user_dep = "SELECT cod_dependencia_user, cod_tipo_aplicacion, cod_estado_enviar_factura_venta_electronica_dian_api FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_admin_user_dep = mysqli_query($conectar, $sql_admin_user_dep);
$info_admin_user_dep = mysqli_fetch_assoc($resultado_admin_user_dep);

$cod_dependencia_user                                            = $info_admin_user_dep['cod_dependencia_user'];
$cod_tipo_aplicacion                                             = $info_admin_user_dep['cod_tipo_aplicacion'];
$cod_estado_enviar_factura_venta_electronica_dian_api            = $info_admin_user_dep['cod_estado_enviar_factura_venta_electronica_dian_api'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_tipo_accion_caja_registradora'])) {

	$tipo_ajax                             = addslashes($_POST['tipo_ajax']);
	$campo                                 = addslashes($_POST['campo']);
	$valor                                 = addslashes($_POST['valor']);
	$opcion                                = addslashes($_POST['opcion']);
	$cod_tipo_forma_pago                   = intval($_POST['cod_tipo_forma_pago']);
	$cod_tercero                           = intval($_POST['cod_tercero']);
	$cod_tipo_accion_caja_registradora     = intval($_POST['cod_tipo_accion_caja_registradora']);

	$array_precio_venta_producto           = explode("+", $valor);
	$total_datos_data                      = count($array_precio_venta_producto);
	$total_datos                           = $total_datos_data;
	$array_recibido                        = explode("|", $valor);
	$array_precio_compra_producto          = explode("+", $valor);
	// ------------------------------------------------------------------------------------------------- //
	if (isset($_POST['cod_tipo_pago'])) { $cod_tipo_pago = intval($_POST['cod_tipo_pago']); } else { $cod_tipo_pago = '1'; }
	if (isset($_POST['cod_tipo_metodo_envio'])) { $cod_tipo_metodo_envio = addslashes($_POST['cod_tipo_metodo_envio']); } else { $cod_tipo_metodo_envio = '1'; }
	if (isset($_POST['nombre1_tercero'])) { $nombre1_tercero = addslashes($_POST['nombre1_tercero']); } else { $nombre1_tercero = ''; }
	if (isset($_POST['fecha_entrega'])) { $fecha_entrega = addslashes($_POST['fecha_entrega']); } else { $fecha_entrega = ''; }
	if (isset($_POST['descripcion_tipo_forma_pago'])) { $descripcion_tipo_forma_pago = addslashes($_POST['descripcion_tipo_forma_pago']); } else { $descripcion_tipo_forma_pago = ''; }
	if (isset($_POST['fecha_pago'])) { $fecha_pago = addslashes($_POST['fecha_pago']); } else { $fecha_pago = ''; }
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }

	if (isset($_POST['cod_tipo_inventario'])) { $cod_tipo_inventario = intval($_POST['cod_tipo_inventario']); } else { $cod_tipo_inventario = '1'; }
	if (isset($_POST['cod_tipo_producto_consumo'])) { $cod_tipo_producto_consumo = intval($_POST['cod_tipo_producto_consumo']); } else { $cod_tipo_producto_consumo = '1'; }
	if (isset($_POST['nombre_tipo_compra'])) { $nombre_tipo_compra = addslashes($_POST['nombre_tipo_compra']); } else { $nombre_tipo_compra = 'NORMAL'; }
	if (isset($_POST['nombre_tipo_moneda'])) { $nombre_tipo_moneda = addslashes($_POST['nombre_tipo_moneda']); } else { $nombre_tipo_moneda = 'COP'; }
	if (isset($_POST['nombre_tipo_cargue_factura'])) { $nombre_tipo_cargue_factura = addslashes($_POST['nombre_tipo_cargue_factura']); } else { $nombre_tipo_cargue_factura = 'FACTURA_COMPRA_NORMAL'; }
	if (isset($_POST['cod_resolucion_facturacion'])) { $cod_resolucion_facturacion = addslashes($_POST['cod_resolucion_facturacion']); } else { $cod_resolucion_facturacion = '1'; }
	if (isset($_POST['cod_movimiento_contable_cuenta_personal'])) { $cod_movimiento_contable_cuenta_personal = intval($_POST['cod_movimiento_contable_cuenta_personal']); } else { $cod_movimiento_contable_cuenta_personal = '0'; }
	if (isset($_POST['pagina'])) { $pagina = addslashes($_POST['pagina']); } else { $pagina = ''; }
	// ------------------------------------------------------------------------------------------------- //
	$sql_resol_fact = "SELECT nombre_tipo_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion')";
	$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
	$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
	$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

	$nombre_tipo_factura          = $matriz_resol_fact['nombre_tipo_resolucion_facturacion'];
//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_info_cliente = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
	$resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
	$info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

	$nit_cliente                                        = $info_cliente['identificacion_tercero'];
	$nombres_clientes                                   = trim($info_cliente['nombre1_tercero'].' '.$info_cliente['nombre2_tercero'].' '.$info_cliente['apellido1_tercero'].' '.$info_cliente['apellido2_tercero']);
	$digito                                             = $info_cliente['digito_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_enviar_factura_venta_electronica_dian_api == '1' && $nombre_tipo_factura == 'ELECTRONICA') {
		function VerificarConexionInternet() {
		$conexion_peticion = @fsockopen("www.google.com", 80);
			if ($conexion_peticion) {
				fclose($conexion_peticion);
				return true;
			} else {
				return false;
			}
		}
		if (VerificarConexionInternet() == '1') { $conexion_internet = 'SI'; } else { $conexion_internet = 'NO'; }
	}
	// ------------------------------------------------------------------------------------------------- //
	$fecha_ymdHis                          = date("YmdHis");
	$respuesta_ajax                        = array();
	$fecha_anyo                            = date("Y-m-d");
	$fecha_anyo_seg                        = strtotime($fecha_anyo);
	$nombre_estado_factura                 = 'CERRADA';
	$nombre_maquina                        = gethostname();
	$fecha_pago_abono                      = date("Y-m-d");
	$fecha                                 = date("Y-m-d");
	$fecha_invert                          = date("Y-m-d");
	$fecha_seg                             = time();
	$fecha_creacion                        = date("Y-m-d H:i:s");
	$fecha_hoy                             = date("Y-m-d");

	$cod_estado_factura                    = '0';
	$descuento_ptj                         = '0';
	$iva_ptj                               = '0';
	$flete_ptj                             = '0';
	$vlr_vuelto                            = '0';
	$fecha_dia                             = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes                             = date("Y-m", $fecha_anyo_seg);
	$anyo                                  = date("Y", $fecha_anyo_seg);
	$fecha_hora                            = date("H:i:s");
	$fecha_hora_factura_compra_producto    = date("H:i:s");
	$fecha_ymd_factura_compra_producto     = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes_factura_compra_producto     = date("m-Y", $fecha_anyo_seg);
	$fecha_anyo_factura_compra_producto    = date("Y", $fecha_anyo_seg);
	$fecha_seg_factura_compra_producto     = time();
	$fecha_pago                            = $fecha_anyo;
	$hora                                  = date("H:i:s");
	$cod_estado_cuenta_cobrar              = 1;
	$fecha_modificacion_cuenta_cobrar      = date("Y-m-d H:i:s");

	$time                                    = time();
	$formato                                 = 'jpg';
	$fecha_ymd                               = date("Y-m-d");
	$nombre_origen_cargue                    = "CARGUE_FACTURA_COMPRA";

	$fecha_ymdhis                            = $fecha_ymdHis;
	$fecha_hora_venta_producto               = date("H:i:s");
	$fecha_remision                          = '';
	$nombre_ccosto                           = '';
	$garantia_meses                          = '';
	$observacion                             = '';
	$fecha_ymd_venta_producto                = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes_venta_producto                = date("Y-m", $fecha_anyo_seg);
	$fecha_anyo_venta_producto               = date("Y", $fecha_anyo_seg);
	$fecha_seg_venta_producto                = time();
	$cod_cuentas_pagar                       = '0';
	// ------------------------------------------------------------------------------------------------- //
	$cod_producto                            = '0';
	$cod_producto_barra                      = '999999';
	$nombre_producto                         = 'PRODUCTOS VARIOS';
	$und_venta                               = '1';
	$precio_compra_producto                  = '0.01';
	$total_compra_producto                   = '0.01';
	$precio_costo_producto                   = '0.01';
	$total_costo_producto                    = '0.01';
	$nombre_tipo_producto                    = 'PRODUCTO';
	$und_producto                            = '0';
	$und_producto_bodega_inv                 = '0';
	$nombre_tipo_unidad_medida               = 'UND';
	$iva_ptj                                 = '0';
	$cod_caja_virtual                        = '1';
	$nombre_tipo_precio_venta                = 'PV1';
	$nombre_tipo_moneda                      = 'COP';
	$cod_dependencia                         = '1';
	$cod_categoria                           = '1';
	$cod_categoria_sub                       = '1';
	$total_precio_compra                     = '0';
	$cod_tipo_inventario                     = '1';
	$comentario_producto                     = 'CAJA_REG';
	$direccion_tercero                       = 'CAJA_REG';

	$precio_compra_producto                  = $valor;
	$total_compra_producto                   = $valor;
	$precio_costo_producto                   = $valor;
	$total_costo_producto                    = $valor;
	$cod_doc_soporte                         = '';
	$und_compra                              = '1';
	$und_producto_bodega                     = '';
	$und_unidades                            = '';
	$und_caja                                = '';
	$unidades_total                          = '1';
	$precio_venta_producto                   = $valor;
	$precio_venta_producto2                  = '';
	$precio_venta_producto3                  = '';
	$precio_venta_producto4                  = '';
	$precio_venta_producto5                  = '';
	$total_venta_producto                    = $valor;
	$nombre_tipo_presentacion                = '';
	$fecha_alerta                            = '';
	$nombre_tipo_precio                      = 'PVAR';
	$comision_ptj                            = '';
	$dto1                                    = '';
	$dto2                                    = '';
	$descuento                               = '';
	$total_dto                               = '';
	$iva_ptj                                 = '';
	$total_iva                               = '';
	$valor_iva                               = '';
	$ganancia_ptj                            = '';
	$fecha_vencimiento                       = '';
	$lote_vencimiento                        = '';
	$precio_compra_producto_viejo            = '';
	$precio_costo_producto_viejo             = '';
	$ipc_ptj                                 = '';
	$precio_ipc                              = '';
	$precio_ipc_total                        = '';
	$ret_ica_ptj                             = '';
	$total_ret_ica                           = '';
	$iva_teorico_ptj                         = '';
	$total_iva_teorico                       = '';
	$tarifa_rete_vigente_ptj                 = '';
	$total_tarifa_rete_vigente               = '';
	$rete_iva_asumido_ptj                    = '';
	$total_rete_iva_asumido                  = '';
	$nombre_tipo_bienes_serv                 = '';
	$nombre_tipo_medida                      = '';
	$cajas                                   = '';
	$cajas_sobre                             = '';
	$und_sobre                               = '';
	$check_caja                              = '';
	$check_und                               = '';
	$chk                                     = '';
	$cod_interno                             = '';
	$cod_proveedor                           = '';
	$cod_original                            = '';
	$codificacion                            = '';
	$nombre_proveedor                        = '';
	$tope_min                                = '';
	$posologia_cantidad                      = '';
	$posologia_peso                          = '';
	$nombre_frec_duracion                    = '';
	$nombre_via_administracion               = '';
	$cod_tipo_cobrar                         = '';
	$cod_estado_vacuna                       = '';
	$cod_estado_permitir_venta               = '';
	$cod_base_caja                           = '';
	$cod_guia                                = '';
	$cod_tipo_inventario                     = '';
	$cod_tipo_producto_consumo               = '';
	$fecha_mantenimiento                     = '';
	$meses_mantenimiento                     = '';
	$meses_garantia                          = '';
	$peso_producto                           = '';
	$unidad_medida_peso                      = '';
	$precio_compra_producto_ant_desc         = '';
	$total_compra_producto_ant_desc          = '';
	$und_producto_inv                        = '';

	$fecha_anyo_seg                          = strtotime($fecha_anyo);
	$cod_estado_factura                      = '0';
	$descuento_ptj                           = '0';
	$iva_ptj                                 = '0';
	$flete_ptj                               = '0';
	$vlr_vuelto                              = '0';
	$fecha_dia                               = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes                               = date("m-Y", $fecha_anyo_seg);
	$anyo                                    = date("Y", $fecha_anyo_seg);
	$fecha_hora                              = date("H:i:s");
	$fecha_hora_venta_producto               = date("H:i:s");
	$fecha_ymd_venta_producto                = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes_venta_producto                = date("m-Y", $fecha_anyo_seg);
	$fecha_anyo_venta_producto               = date("Y", $fecha_anyo_seg);
	$fecha_seg_venta_producto                = time();
	$fecha_pago                              = $fecha_anyo;

	$subtotal_total_precio_compra            = $valor;
	$subtotal_total_precio_costo             = $valor;
	$total_factura_compra                    = $valor;
	$total_precio_costo                      = $valor;
	$subtotal                                = $valor;
	$nombre_rete_fuente_ptj                  = 0;
	$total_valor_iva                         = 0;
	$total_descuento                         = 0;
	$total_precio_ipc                        = 0;
	$total_compra_imp                        = $valor;
	$total_rete_fuente                       = 0;
	$total_factura_compra_retefuente         = $valor;
	$total_inv_compra_desp_factura           = 0;
	$total_compra_precio_costo               = $valor;
	$total_compra_precio_compra              = $valor;
	$total_compra_precio_venta               = $valor;
	// ------------------------------------------------------------------------------------------------- //
	$sql_autoincremento_info_factura_venta = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
	$exec_autoincremento_info_factura_venta = mysqli_query($conectar, $sql_autoincremento_info_factura_venta) or die(mysqli_error($conectar));
	$datos_autoincremento_info_factura_venta = mysqli_fetch_assoc($exec_autoincremento_info_factura_venta);

	$cod_info_factura_venta                = $datos_autoincremento_info_factura_venta['AUTO_INCREMENT'];
	// ------------------------------------------------------------------------------------------------- //
	$sql_autoincremento_info_factura_compra = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_compra'";
	$exec_autoincremento_info_factura_compra = mysqli_query($conectar, $sql_autoincremento_info_factura_compra) or die(mysqli_error($conectar));
	$datos_autoincremento_info_factura_compra = mysqli_fetch_assoc($exec_autoincremento_info_factura_compra);

	$cod_info_factura_compra               = $datos_autoincremento_info_factura_compra['AUTO_INCREMENT'];
	// ------------------------------------------------------------------------------------------------- //
	$sql_autoincremento_cuentas_cobrar = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar'";
	$exec_autoincremento_cuentas_cobrar = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_cobrar = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar);

	$cod_cuentas_cobrar           = $datos_autoincremento_cuentas_cobrar['AUTO_INCREMENT'];
	// ------------------------------------------------------------------------------------------------- //
	$sql_autoincremento_cuentas_cobrar_abonos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar_abonos'";
	$exec_autoincremento_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_cobrar_abonos = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar_abonos);

	$cod_cuentas_cobrar_abonos             = $datos_autoincremento_cuentas_cobrar_abonos['AUTO_INCREMENT'];
	// ------------------------------------------------------------------------------------------------- //
	$sql_autoincremento_cuentas_pagar = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_pagar'";
	$exec_autoincremento_cuentas_pagar = mysqli_query($conectar, $sql_autoincremento_cuentas_pagar) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_pagar = mysqli_fetch_assoc($exec_autoincremento_cuentas_pagar);

	$cod_cuentas_pagar                     = $datos_autoincremento_cuentas_pagar['AUTO_INCREMENT'];
	// ------------------------------------------------------------------------------------------------- //
	$sql_autoincremento_cuentas_pagar_abonos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_pagar_abonos'";
	$exec_autoincremento_cuentas_pagar_abonos = mysqli_query($conectar, $sql_autoincremento_cuentas_pagar_abonos) or die(mysqli_error($conectar));
	$datos_autoincremento_cuentas_pagar_abonos = mysqli_fetch_assoc($exec_autoincremento_cuentas_pagar_abonos);

	$cod_cuentas_pagar_abonos                     = $datos_autoincremento_cuentas_pagar_abonos['AUTO_INCREMENT'];
	// ------------------------------------------------------------------------------------------------- //
	$sql_maxima_factura_venta = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_venta WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion') AND (nombre_estado_factura = 'CERRADA')";
	$consulta_maxima_factura_venta = mysqli_query($conectar, $sql_maxima_factura_venta) or die(mysqli_error($conectar));
	$maxima_factura_venta = mysqli_fetch_assoc($consulta_maxima_factura_venta);

	$cod_factura                         = $maxima_factura_venta['cod_factura']+1;
	// ------------------------------------------------------------------------------------------------- //
	// ------------------------------------------------------------------------------------------------- //
	if ($cod_tipo_accion_caja_registradora == '1') { //INGRESAR VENTA

		if (($campo == 'precio_venta_producto') && ($tipo_ajax == 'tbl15_venta_producto_temporal') && ($valor <> '')) {

			$precio_venta_producto_concat = $valor;
			$total_precio_venta           = 0;
			$total_venta_producto         = 0;

			if ($cod_estado_enviar_factura_venta_electronica_dian_api == '1' && $nombre_tipo_factura == 'ELECTRONICA' && $conexion_internet == 'SI') {
				$pagina_redirect_imprimir = '../admin/enviar_factura_electronica_dian_dataico_ajax.php';
				$url_redir = $pagina_redirect_imprimir."?cod_info_factura_venta=".$cod_info_factura_venta."&cod_tipo_pago=".$cod_tipo_pago."&conexion_internet=".$conexion_internet."&condicion_producto_con_precio_venta_cero=".$condicion_producto_con_precio_venta_cero."&pagina=".$pagina;
			}

			for($i = 0; $i < $total_datos_data; $i++)   {
				$precio_venta_producto = intval($array_precio_venta_producto[$i]);
				$total_venta_producto = $precio_venta_producto;
				$precio_venta_producto_orig = $precio_venta_producto;

				if (($precio_venta_producto <> '') || ($precio_venta_producto <> '0')) {

					$agregar_reg_venta_producto = "INSERT INTO tbl15_venta_producto (cod_info_factura_venta, cod_factura, cod_producto, cod_producto_barra, 
					nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, 
					total_venta_producto, nombre_tipo_producto, und_producto, und_producto_bodega_inv, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
					nombre_tipo_unidad_medida, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
					cod_resolucion_facturacion, iva_ptj, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, 
					cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, 
					cod_dependencia, precio_venta_producto_orig, cod_categoria, cod_categoria_sub, total_datos_data, comentario_producto)
					VALUES ('$cod_info_factura_venta', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
					'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', 
					'$total_venta_producto', '$nombre_tipo_producto', '$und_producto', '$und_producto_bodega_inv', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
					'$nombre_tipo_unidad_medida', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
					'$cod_resolucion_facturacion', '$iva_ptj', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', 
					'$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda',
					'$cod_dependencia', '$precio_venta_producto_orig', '$cod_categoria', '$cod_categoria_sub', '$total_datos_data', '$comentario_producto')";
					$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));

					$total_precio_venta    += $precio_venta_producto;
				}
			}

			//if ($total_recibido <> '0') { $vlr_cancelado = end($array_recibido); $vlr_vuelto = $vlr_cancelado - $total_precio_venta; } else { $vlr_cancelado = $total_precio_venta; $vlr_vuelto = '0'; }
			if (strpos($valor, '|') != false) { $vlr_cancelado = end($array_recibido); $vlr_vuelto = $vlr_cancelado - $total_precio_venta; } else { $vlr_cancelado = $total_precio_venta; $vlr_vuelto = '0'; }

			$tiempo_final                      = microtime(true);
			$tiempo_ejecucion                  = $tiempo_final - $tiempo_inicial;

			$agregar_regis = "INSERT INTO tbl15_info_factura_venta (cod_info_factura_venta, cod_cuentas_cobrar, cod_estado_factura, cod_factura, fecha_anyo, fecha_dia, fecha_mes, anyo, 
			fecha_hora, total_precio_compra, total_precio_venta, total_datos_data, cod_tercero, nombre_estado_factura, cuenta, vlr_cancelado, 
			vlr_vuelto, cod_tipo_pago, cod_administrador, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, nombre_maquina, tiempo_ejecucion, 
			cod_resolucion_facturacion, cod_tipo_inventario, direccion_tercero, cod_movimiento_contable_cuenta_personal)
			VALUES ('$cod_info_factura_venta', '$cod_cuentas_cobrar', '$cod_estado_factura', '$cod_factura', '$fecha_anyo', '$fecha_dia', '$fecha_mes', '$anyo', 
			'$fecha_hora', '$total_precio_compra', '$total_precio_venta', '$total_datos_data', '$cod_tercero', '$nombre_estado_factura', '$cuenta', '$vlr_cancelado', 
			'$vlr_vuelto', '$cod_tipo_pago', '$cod_administrador', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$nombre_maquina', '$tiempo_ejecucion', 
			'$cod_resolucion_facturacion', '$cod_tipo_inventario', '$direccion_tercero', '$cod_movimiento_contable_cuenta_personal')";
			$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

			if ($cod_tipo_pago == '2') {
				$monto_deuda                           = $total_precio_venta; 
				$vlr_cancelado_abono                   = 0;
				$subtotal                              = $total_precio_venta - $vlr_cancelado_abono; 
				$abonado                               = $vlr_cancelado_abono; 
				$hora                                  = $fecha_hora;
				$mensaje                               = '';
				$vendedor                              = $cuenta;

				$agregar_reg_cuentas_cobrar = "INSERT INTO tbl15_cuentas_cobrar (cod_cuentas_cobrar, cod_info_factura_venta, cod_factura, cod_tercero, monto_deuda, subtotal, vendedor, cuenta, abonado, 
				fecha_pago, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, nombre1_tercero)
				VALUES ('$cod_cuentas_cobrar', '$cod_info_factura_venta', '$cod_factura', '$cod_tercero', '$monto_deuda', '$subtotal', '$vendedor', '$cuenta', '$abonado', 
				'$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$nombre1_tercero')";
				$resultado_cuentas_cobrar = mysqli_query($conectar, $agregar_reg_cuentas_cobrar) or die(mysqli_error($conectar));

				$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
				FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero')";
				$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
				$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

				$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];

				$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero')";
				$consulta_datos_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_datos_cuentas_cobrar_abonos);
				$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_cobrar_abonos);

				$total_abonado_cuenta_cobrar           = $datos_cuentas_cobrar_abonos['total_abonado_cuenta_cobrar'];
				$total_subtotal_cuenta_cobrar          = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar;

				$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
				total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
				WHERE (cod_tercero = '$cod_tercero')");
				$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
			}
			//----------------------------------------------------------------------- ---------------------------------------------------------//
			if ($cod_estado_movimiento_contable_cuenta_personal_global == '1' && $cod_tipo_pago == '1') {

				$nombre_tipo_documento                                 = 'RECIBO DE CAJA';
				$nombre_estado_factura                                 = 'CERRADA';
				$ip                                                    = $_SERVER["REMOTE_ADDR"];
				$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");

				$nombre_tipo_movimiento 	                           = 'DEBITOS';
				$cod_puc                                               = '1473';
				$codigo_puc                                            = '4205';
				$nombre_puc                                            = 'OTRAS VENTAS';
				$tipo_puc                                              = 'INGRESOS';
				$und_vendida                                           = '1';
				$costo_movimiento_contable                             = $total_precio_venta;
				$total_costo_movimiento_contable                       = $total_precio_venta;

				$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
				WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
				$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
				$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

				$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
				$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal + $total_precio_venta;
				$saldo_actual_puc                                      = $total_precio_venta;
				$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
				$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
				$valor_movimiento_contable_cuenta_personal             = $total_precio_venta;
				$fecha_ymd_movimiento_caja                             = date("Y-m-d");
				$fecha_mes_movimiento_caja                             = date("Y-m");
				$fecha_anyo_movimiento_caja                            = date("Y");
				$fecha_hora_movimiento_caja                            = date("H:i:s");
				$fecha_seg_movimiento_caja                             = time();
				$fecha_creacion                                        = date("Y-m-d H:i:s");
				$simbolo_tipo_operacion                                = "-";

				$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
				WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
				$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

				$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, 
				nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, 
				fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_tipo_forma_pago, cod_info_factura_venta, 
				simbolo_tipo_operacion, total_saldo, cod_tipo_pago)
				VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
				'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_ymd_movimiento_caja', '$fecha_mes_movimiento_caja', 
				'$fecha_seg', '$fecha_ymd_movimiento_caja', '$fecha_anyo_movimiento_caja', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$cod_info_factura_venta', 
				'$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_tipo_pago')";
				$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
			}
			$respuesta_ajax['llave']                                                    = $cod_info_factura_venta;
			$respuesta_ajax['total_precio_venta']                                       = $total_precio_venta;
			$respuesta_ajax['vlr_cancelado']                                            = $vlr_cancelado;
			$respuesta_ajax['vlr_vuelto']                                               = $vlr_vuelto;
			$respuesta_ajax['estado']                                                   = '1';
			$respuesta_ajax['total_datos_data']                                         = $total_datos_data;
			$respuesta_ajax['cod_tipo_accion_caja_registradora']                        = $cod_tipo_accion_caja_registradora;
			$respuesta_ajax['nombre_tipo_factura']                                      = $nombre_tipo_factura;
			$respuesta_ajax['pagina_redirect_imprimir']                                 = $pagina_redirect_imprimir;
			$respuesta_ajax['conexion_internet']                                        = $conexion_internet;
			$respuesta_ajax['cod_estado_enviar_factura_venta_electronica_dian_api']     = $cod_estado_enviar_factura_venta_electronica_dian_api;

			echo json_encode($respuesta_ajax);
		} else {
			$respuesta_ajax['llave']                                                    = 0;
			$respuesta_ajax['total_precio_venta']                                       = 0;
			$respuesta_ajax['vlr_cancelado']                                            = 0;
			$respuesta_ajax['vlr_vuelto']                                               = 0;
			$respuesta_ajax['estado']                                                   = '0';
			$respuesta_ajax['total_datos_data']                                         = 0;
			$respuesta_ajax['cod_tipo_accion_caja_registradora']                        = $cod_tipo_accion_caja_registradora;
			$respuesta_ajax['nombre_tipo_factura']                                      = '';
			$respuesta_ajax['pagina_redirect_imprimir']                                 = '';
			$respuesta_ajax['conexion_internet']                                        = $conexion_internet;
			$respuesta_ajax['cod_estado_enviar_factura_venta_electronica_dian_api']     = $cod_estado_enviar_factura_venta_electronica_dian_api;

			echo json_encode($respuesta_ajax);
		}
	}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
	if ($cod_tipo_accion_caja_registradora == '2') { //INGRESAR COMPRA

		$sql_max_factura = "SELECT MAX(cod_factura) AS cod_factura FROM tbl15_info_factura_compra WHERE (nombre_tipo_cargue_factura = 'FACTURA_COMPRA_DOC_SOPORTE')";
		$consulta_max_factura = mysqli_query($conectar, $sql_max_factura) or die(mysqli_error($conectar));
		$datos_max_factura = mysqli_fetch_assoc($consulta_max_factura);

		if ($nombre_tipo_cargue_factura == 'FACTURA_COMPRA_DOC_SOPORTE') { $cod_factura = $datos_max_factura['cod_factura']+1; } else { $cod_factura = $cod_factura; }
		if ($cod_tipo_inventario == '1') { $campo_und_inventario = 'und_producto'; } elseif ($cod_tipo_inventario == '2') { $campo_und_inventario = 'und_producto_bodega'; } else { $campo_und_inventario = 'und_producto'; }
		//---------------------------------------------------------------------------------------------------------------------------------//
		$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion 
		WHERE (nombre_tipo_resolucion_facturacion = '$nombre_tipo_factura') AND (nombre_tipo_estado = 'ACTIVO')";
		$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
		$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
		$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

		$cod_resolucion_facturacion              = intval($matriz_resol_fact['cod_resolucion_facturacion']);
		//---------------------------------------------------------------------------------------------------------------------------------//
		$sql_totales_inv = "SELECT SUM(und_producto * precio_costo_producto) AS total_inv_precio_costo, SUM(und_producto * precio_compra_producto) AS total_inv_precio_compra, 
		SUM(und_producto * precio_venta_producto) AS total_inv_precio_venta FROM tbl15_producto";
		$consulta_totales_inv = mysqli_query($conectar, $sql_totales_inv) or die(mysqli_error($conectar));
		$datos_totales_inv = mysqli_fetch_assoc($consulta_totales_inv);

		$total_inv_precio_costo                  = $datos_totales_inv['total_inv_precio_costo'];
		$total_inv_precio_compra                 = $datos_totales_inv['total_inv_precio_compra'];
		$total_inv_precio_venta                  = $datos_totales_inv['total_inv_precio_venta'];
		// ------------------------------------------------------------------------------------------------- //
		$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_compra WHERE (nombre_tipo_factura = '$nombre_tipo_factura') AND (nombre_estado_factura = 'CERRADA')";
		$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
		$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

		$cod_factura                         = $maxima_factura['cod_factura']+1;
		// ------------------------------------------------------------------------------------------------- //
		// ------------------------------------------------------------------------------------------------- //
		$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE (nombre_tipo_resolucion_facturacion = '$nombre_tipo_factura') AND (nombre_tipo_estado = 'ACTIVO')";
		$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
		$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
		$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

		$cod_resolucion_facturacion          = intval($matriz_resol_fact['cod_resolucion_facturacion']);
		// ------------------------------------------------------------------------------------------------- //
		$precio_compra_producto_concat = $valor;
		$total_precio_venta            = 0;
		$total_venta_producto          = 0;
        $total                         = $valor;

		for($i = 0; $i < $total_datos_data; $i++)   {
			$precio_compra_producto = intval($array_precio_compra_producto[$i]);
			$total_venta_producto = $precio_compra_producto;
			$precio_compra_producto_orig = $precio_compra_producto;

			if (($precio_compra_producto <> '') || ($precio_compra_producto <> '0')) {

				$agregar_reg_compra_producto = "INSERT INTO tbl15_factura_compra_producto (cod_info_factura_compra, cod_tercero, cod_doc_soporte, cod_caja_virtual, 
				cod_producto, cod_producto_barra, nombre_producto, und_compra, und_producto, und_producto_bodega, und_unidades, und_caja, unidades_total, precio_compra_producto, 
				total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, precio_venta_producto2, precio_venta_producto3, 
				precio_venta_producto4, precio_venta_producto5, total_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, 
				nombre_tipo_presentacion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, 
				fecha_alerta, nombre_tipo_precio, nombre_tipo_precio_venta, comision_ptj, dto1, dto2, descuento, total_dto, iva_ptj, 
				total_iva, valor_iva, ganancia_ptj, fecha_vencimiento, lote_vencimiento, precio_compra_producto_viejo, precio_costo_producto_viejo, 
				cod_dependencia, ipc_ptj, precio_ipc, precio_ipc_total, ret_ica_ptj, total_ret_ica, iva_teorico_ptj, total_iva_teorico, 
				tarifa_rete_vigente_ptj, total_tarifa_rete_vigente, rete_iva_asumido_ptj, total_rete_iva_asumido, nombre_tipo_bienes_serv, 
				nombre_tipo_compra, nombre_tipo_cargue_factura, nombre_tipo_medida, cajas, cajas_sobre, und_sobre, check_caja, 
				check_und, chk, cod_interno, cod_proveedor, cod_original, codificacion, nombre_proveedor, tope_min, 
				posologia_cantidad, posologia_peso, nombre_frec_duracion, nombre_via_administracion, 
				cod_tipo_cobrar, cod_estado_vacuna, cod_estado_permitir_venta, cod_base_caja, cod_guia, cod_administrador, cuenta, cod_tipo_inventario,
				cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, cod_factura, cod_tipo_producto_consumo, fecha_mantenimiento, meses_mantenimiento, 
				meses_garantia, peso_producto, unidad_medida_peso, precio_compra_producto_ant_desc, total_compra_producto_ant_desc)
				VALUES ('$cod_info_factura_compra', '$cod_tercero', '$cod_doc_soporte', '$cod_caja_virtual', 
				'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_compra', '$und_producto_inv', '$und_producto_bodega_inv', '$und_unidades', '$und_caja', '$unidades_total', '$precio_compra_producto', 
				'$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', '$precio_venta_producto2', '$precio_venta_producto3', 
				'$precio_venta_producto4', '$precio_venta_producto5', '$total_venta_producto', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', 
				'$nombre_tipo_presentacion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', 
				'$fecha_alerta', '$nombre_tipo_precio', '$nombre_tipo_precio_venta', '$comision_ptj', '$dto1', '$dto2', '$descuento', '$total_dto', '$iva_ptj', 
				'$total_iva', '$valor_iva', '$ganancia_ptj', '$fecha_vencimiento', '$lote_vencimiento', '$precio_compra_producto_viejo', '$precio_costo_producto_viejo', 
				'$cod_dependencia', '$ipc_ptj', '$precio_ipc', '$precio_ipc_total', '$ret_ica_ptj', '$total_ret_ica', '$iva_teorico_ptj', '$total_iva_teorico', 
				'$tarifa_rete_vigente_ptj', '$total_tarifa_rete_vigente', '$rete_iva_asumido_ptj', '$total_rete_iva_asumido', '$nombre_tipo_bienes_serv', 
				'$nombre_tipo_compra', '$nombre_tipo_cargue_factura', '$nombre_tipo_medida', '$cajas', '$cajas_sobre', '$und_sobre', '$check_caja', 
				'$check_und', '$chk', '$cod_interno', '$cod_proveedor', '$cod_original', '$codificacion', '$nombre_proveedor', '$tope_min', 
				'$posologia_cantidad', '$posologia_peso', '$nombre_frec_duracion', '$nombre_via_administracion', 
				'$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_estado_permitir_venta', '$cod_base_caja', '$cod_guia', '$cod_administrador', '$cuenta', '$cod_tipo_inventario', 
				'$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_factura', '$cod_tipo_producto_consumo', '$fecha_mantenimiento', '$meses_mantenimiento', 
				'$meses_garantia', '$peso_producto', '$unidad_medida_peso', '$precio_compra_producto_ant_desc', '$total_compra_producto_ant_desc')";
				$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));

				$total_precio_venta    += $precio_compra_producto;
			}
		}

		//if ($total_recibido <> '0') { $vlr_cancelado = end($array_recibido); $vlr_vuelto = $vlr_cancelado - $total_precio_venta; } else { $vlr_cancelado = $total_precio_venta; $vlr_vuelto = '0'; }
		if (strpos($valor, '|') != false) { $vlr_cancelado = end($array_recibido); $vlr_vuelto = $vlr_cancelado - $total_precio_venta; } else { $vlr_cancelado = $total_precio_venta; $vlr_vuelto = '0'; }

		$tiempo_final                      = microtime(true);
		$tiempo_ejecucion                  = $tiempo_final - $tiempo_inicial;

		$agregar_regis = "INSERT INTO tbl15_info_factura_compra (cod_info_factura_compra, total, subtotal_total_precio_compra, subtotal_total_precio_costo, total_factura_compra, 
		total_precio_costo, cod_estado_factura, cod_factura, fecha_anyo, fecha_dia, fecha_mes, anyo, fecha_hora, total_precio_compra, total_precio_venta, 
		total_datos_data, cod_tercero, nombre_estado_factura, cuenta, vlr_cancelado, vlr_vuelto, 
		cod_tipo_pago, cod_administrador, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, 
		nombre_tipo_cargue_factura, nombre_rete_fuente_ptj, ret_ica_ptj, subtotal, valor_iva, 
		total_descuento, total_precio_ipc, total_compra_imp, total_rete_fuente, total_ret_ica, total_factura_compra_retefuente, nombre_maquina, tiempo_ejecucion, cod_resolucion_facturacion, 
		total_inv_precio_costo, total_inv_precio_compra, total_inv_precio_venta, total_inv_compra_desp_factura, total_compra_precio_costo, total_compra_precio_compra, total_compra_precio_venta, 
		cod_tipo_inventario, cod_tipo_producto_consumo)
		VALUES ('$cod_info_factura_compra', '$total', '$subtotal_total_precio_compra', '$subtotal_total_precio_costo', '$total_factura_compra', 
		'$total_precio_costo', '$cod_estado_factura', '$cod_factura', '$fecha_anyo', '$fecha_dia', '$fecha_mes', '$anyo', '$fecha_hora', '$total_precio_compra', '$total_precio_venta', 
		'$total_datos_data', '$cod_tercero', '$nombre_estado_factura', '$cuenta', '$vlr_cancelado', '$vlr_vuelto', 
		'$cod_tipo_pago', '$cod_administrador', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', 
		'$nombre_tipo_cargue_factura', '$nombre_rete_fuente_ptj', '$ret_ica_ptj', '$subtotal', '$total_valor_iva', 
		'$total_descuento', '$total_precio_ipc', '$total_compra_imp', '$total_rete_fuente', '$total_ret_ica', '$total_factura_compra_retefuente', '$nombre_maquina', '$tiempo_ejecucion', '$cod_resolucion_facturacion', 
		'$total_inv_precio_costo', '$total_inv_precio_compra', '$total_inv_precio_venta', '$total_inv_compra_desp_factura', '$total_compra_precio_costo', '$total_compra_precio_compra', '$total_compra_precio_venta', 
		'$cod_tipo_inventario', '$cod_tipo_producto_consumo')";
		$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

		if ($cod_tipo_pago == '2') {
			$monto_deuda                          = $valor; 
			$vlr_cancelado_abono                  = 0;
			$subtotal                             = $valor - $vlr_cancelado_abono; 
			$abonado                              = $vlr_cancelado_abono; 
			$hora                                 = $fecha_hora;
			$mensaje                              = 'cargado por caja registradora compra';
			$vendedor                             = $cuenta;
			$cod_estado_cuenta_pagar              = 1;
			$fecha_modificacion_cuenta_pagar      = date("Y-m-d H:i:s");

			$sql_reg_cuentas_pagar = "INSERT INTO tbl15_cuentas_pagar (cod_cuentas_pagar, cod_factura, cod_tercero, monto_deuda, subtotal, vendedor, cuenta, abonado, fecha_pago, fecha, fecha_invert, fecha_seg, mensaje, fecha_hora, cod_administrador, cod_info_factura_compra)
			VALUES ('$cod_cuentas_pagar', '$cod_factura', '$cod_tercero', '$monto_deuda', '$subtotal', '$vendedor', '$cuenta', '$abonado', '$fecha_pago', '$fecha', '$fecha_invert', '$fecha_seg', '$mensaje', '$fecha_hora', '$cod_administrador', '$cod_info_factura_compra')";
			$resultado_cuentas_pagar = mysqli_query($conectar, $sql_reg_cuentas_pagar) or die(mysqli_error($conectar));

			$sql_datos_cuenta_pagar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_pagar, SUM(subtotal) AS total_subtotal_cuenta_pagar, SUM(abonado) AS total_abonado_cuenta_pagar 
			FROM tbl15_cuentas_pagar WHERE (cod_tercero = '$cod_tercero')";
			$consulta_datos_cuenta_pagar = mysqli_query($conectar, $sql_datos_cuenta_pagar);
			$datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar);

			$total_monto_deuda_cuenta_pagar       = $datos_cuenta_pagar['total_monto_deuda_cuenta_pagar'];
			$total_subtotal_cuenta_pagar          = $datos_cuenta_pagar['total_subtotal_cuenta_pagar'];
			$total_abonado_cuenta_pagar           = $datos_cuenta_pagar['total_abonado_cuenta_pagar'];

			$sql_cuenta_pagar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_pagar = '$cod_estado_cuenta_pagar', total_monto_deuda_cuenta_pagar = '$total_monto_deuda_cuenta_pagar', 
			total_subtotal_cuenta_pagar = '$total_subtotal_cuenta_pagar', total_abonado_cuenta_pagar = '$total_abonado_cuenta_pagar', fecha_modificacion_cuenta_pagar = '$fecha_modificacion_cuenta_pagar' 
			WHERE (cod_tercero = '$cod_tercero')");
			$resultado_cuenta_pagar_tercero = mysqli_query($conectar, $sql_cuenta_pagar_tercero) or die(mysqli_error($conectar));
		}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
		if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {

			$nombre_tipo_documento                                 = 'COMPROBANTE DE EGRESO';
			$nombre_estado_factura                                 = 'CERRADA';
			$ip                                                    = $_SERVER["REMOTE_ADDR"];
			$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");

			$nombre_tipo_movimiento 	                           = 'DEBITOS';
			$cod_puc                                               = '754';
			$codigo_puc                                            = '22';
			$nombre_puc                                            = 'PAGO A PROVEEDORES';
			$tipo_puc                                              = 'PASIVOS';
			$und_vendida                                           = '1';
			$costo_movimiento_contable                             = $total_factura_compra_retefuente;
			$total_costo_movimiento_contable                       = $total_factura_compra_retefuente;
			$comentario                                           = "factura de factura compra cargadada por modulo caja registradora ID: ".$cod_info_factura_compra." - factura: ".$cod_factura." - Proveedor: ".$nombres_clientes;

			$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
			$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
			$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

			$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
			$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal - $total_factura_compra_retefuente;
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

			if ($cod_tipo_pago=='1') {
				$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
				WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
				$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
			}
			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, 
			nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
			cuenta, comentario, cod_tercero, cod_tipo_forma_pago, cod_info_factura_compra, simbolo_tipo_operacion, total_saldo, cod_tipo_pago)
			VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
			'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
			'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$cod_info_factura_compra', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_tipo_pago')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
		}
		$respuesta_ajax['llave']                                                    = $cod_info_factura_compra;
		$respuesta_ajax['total_precio_compra']                                      = $valor;
		$respuesta_ajax['vlr_cancelado']                                            = $vlr_cancelado;
		$respuesta_ajax['vlr_vuelto']                                               = $vlr_vuelto;
		$respuesta_ajax['estado']                                                   = '1';
		$respuesta_ajax['total_datos_data']                                         = $total_datos_data;
		$respuesta_ajax['cod_tipo_accion_caja_registradora']                        = $cod_tipo_accion_caja_registradora;
		$respuesta_ajax['nombre_tipo_factura']                                      = $nombre_tipo_factura;
		$respuesta_ajax['pagina_redirect_imprimir']                                 = '';
		$respuesta_ajax['conexion_internet']                                        = $conexion_internet;
		$respuesta_ajax['cod_estado_enviar_factura_venta_electronica_dian_api']     = $cod_estado_enviar_factura_venta_electronica_dian_api;

		echo json_encode($respuesta_ajax);
	}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
	if ($cod_tipo_accion_caja_registradora == '3') { // ABONO CLIENTE (CUENTA POR COBRAR)

		$abonado                               = $valor;
		$mensaje                               = '';
		//-------------------------------------- -----------------------------------------------------------------//
		//-------------------------------------- REGISTRAR DATOS --------------------------------------//
		$insert_cuentas_cobrar_abonos = "INSERT INTO tbl15_cuentas_cobrar_abonos (cod_cuentas_cobrar_abonos, cod_tercero, abonado, cuenta, fecha_pago, fecha_anyo, fecha_mes, anyo, fecha_invert, fecha_seg, hora, mensaje, cod_administrador, cod_tipo_forma_pago, cod_dependencia) 
		VALUES ('$cod_cuentas_cobrar_abonos', '$cod_tercero', '$abonado', '$cuenta_actual', '$fecha_pago', '$fecha_anyo', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$mensaje', '$cod_administrador', '$cod_tipo_forma_pago', '$cod_dependencia')";
		$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $insert_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
		//-------------------------------------- -----------------------------------------------------------------//
		$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
		FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero')";
		$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
		$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

		$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];

		$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero')";
		$consulta_datos_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_datos_cuentas_cobrar_abonos);
		$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_cobrar_abonos);

		$total_abonado_cuenta_cobrar           = $datos_cuentas_cobrar_abonos['total_abonado_cuenta_cobrar'];
		$total_subtotal_cuenta_cobrar          = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar;

		$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
		total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
		WHERE (cod_tercero = '$cod_tercero')");
		$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
		//-------------------------------------- -----------------------------------------------------------------//

		if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {

			$nombre_tipo_documento                                 = 'RECIBO DE CAJA';
			$nombre_estado_factura                                 = 'CERRADA';
			$ip                                                    = $_SERVER["REMOTE_ADDR"];
			$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");

			$nombre_tipo_movimiento 	                           = 'DEBITOS';
			$cod_puc                                               = '238';
			$codigo_puc                                            = '138020';
			$nombre_puc                                            = 'CUENTAS POR COBRAR DE TERCEROS';
			$tipo_puc                                              = 'INGRESOS';
			$und_vendida                                           = '1';
			$costo_movimiento_contable                             = $abonado;
			$total_costo_movimiento_contable                       = $abonado;

			$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
			$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
			$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

			$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
			$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal + $abonado;
			$saldo_actual_puc                                      = $abonado;
			$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
			$nombre_movimiento_contable_cuenta_personal            = $nombre_puc;
			$valor_movimiento_contable_cuenta_personal             = $abonado;
			$fecha_ymd_movimiento_caja                             = date("Y-m-d");
			$fecha_mes_movimiento_caja                             = date("Y-m");
			$fecha_anyo_movimiento_caja                            = date("Y");
			$fecha_hora_movimiento_caja                            = date("H:i:s");
			$fecha_seg_movimiento_caja                             = time();
			$fecha_creacion                                        = date("Y-m-d H:i:s");
			$simbolo_tipo_operacion                                = "+";
			$comentario                                            = 'abono cargado por modulo de caja registradora - tercero: '.$cod_tercero;

			$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, 
			nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
			cuenta, comentario, cod_tercero, cod_tipo_forma_pago, cod_cuentas_cobrar_abonos, simbolo_tipo_operacion, total_saldo, cod_tipo_pago)
			VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
			'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
			'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$cod_cuentas_cobrar_abonos', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_tipo_pago')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
		}

		$respuesta_ajax['llave']                                                    = $cod_cuentas_cobrar_abonos;
		$respuesta_ajax['abonado']                                                  = $abonado;
		$respuesta_ajax['vlr_cancelado']                                            = 0;
		$respuesta_ajax['vlr_vuelto']                                               = 0;
		$respuesta_ajax['estado']                                                   = '1';
		$respuesta_ajax['total_datos_data']                                         = 1;
		$respuesta_ajax['cod_tipo_accion_caja_registradora']                        = $cod_tipo_accion_caja_registradora;
		$respuesta_ajax['nombre_tipo_factura']                                      = $nombre_tipo_factura;
		$respuesta_ajax['pagina_redirect_imprimir']                                 = '';
		$respuesta_ajax['conexion_internet']                                        = $conexion_internet;
		$respuesta_ajax['cod_estado_enviar_factura_venta_electronica_dian_api']     = $cod_estado_enviar_factura_venta_electronica_dian_api;

		echo json_encode($respuesta_ajax);
	}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
	if ($cod_tipo_accion_caja_registradora == '5') { // INGRESAR GASTOS

		$costo                                 = $valor;
		$mensaje                               = '';
		$cod_concepto_movimiento_caja          = $cod_tercero;
		$cod_tercero                           = '1';
		$comentario                            = 'GASTO INGRESADO POR CAJA REGISTRADORA';
		$fecha_dmy                             = $fecha_anyo;
		//-------------------------------------- -----------------------------------------------------------------//
		if (isset($_POST['codigo_puc']) <> '') { $codigo_puc = mysqli_real_escape_string($conectar, ($_POST['codigo_puc'])); } else { $codigo_puc = ''; }
		if (isset($_POST['nombre_puc']) <> '') { $nombre_puc = mysqli_real_escape_string($conectar, ($_POST['nombre_puc'])); } else { $nombre_puc = ''; }
		if (isset($_POST['cod_dependencia']) <> '') { $cod_dependencia = mysqli_real_escape_string($conectar, ($_POST['cod_dependencia'])); } else { $cod_dependencia = ''; }
		if (isset($_POST['nombre_ccosto']) <> '') { $nombre_ccosto = mysqli_real_escape_string($conectar, ($_POST['nombre_ccosto'])); } else { $nombre_ccosto = ''; }
		if (isset($_POST['cod_cuentas_pagar']) <> '') { $cod_cuentas_pagar = intval($_POST['cod_cuentas_pagar']); } else { $cod_cuentas_pagar = '0'; }
		if (isset($_POST['nombre_cuenta_pagar']) <> '') { $nombre_cuenta_pagar = mysqli_real_escape_string($conectar, ($_POST['nombre_cuenta_pagar'])); } else { $nombre_cuenta_pagar = ''; }
		if (isset($_POST['nombre_tipo_cuenta_cobrar_pagar']) <> '') { $nombre_tipo_cuenta_cobrar_pagar = mysqli_real_escape_string($conectar, ($_POST['nombre_tipo_cuenta_cobrar_pagar'])); } else { $nombre_tipo_cuenta_cobrar_pagar = ''; }
		//-------------------------------------- -----------------------------------------------------------------//
		$sql_info_factura = "SELECT * FROM tbl15_concepto_movimiento_caja WHERE (cod_concepto_movimiento_caja = '$cod_concepto_movimiento_caja')";
		$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
		$info_info_factura = mysqli_fetch_assoc($resultado_info_factura);

		$nombre_concepto_movimiento_caja       = $info_info_factura['nombre_concepto_movimiento_caja'];
		$nombre_tipo_puc                       = $info_info_factura['nombre_tipo_puc'];
		$simbolo_tipo_operacion                = $info_info_factura['simbolo_tipo_operacion'];
		$tipo_puc                              = $nombre_tipo_puc;
		$nombre_puc                            = $nombre_concepto_movimiento_caja;

		$fecha_time     	                   = time();
		$fecha_mes_ym	                       = date("Y-m", strtotime($fecha_dmy));
		$anyo		                           = date("Y", strtotime($fecha_dmy));
		$hora	                               = date("H:i:s");
		$cuenta                                = $cuenta_actual;
		$und_vendida                           = 1;
		$costo_movimiento_contable             = $costo;
		$total_costo_movimiento_contable       = $costo;

		$fecha_anyo                            = $fecha_dmy;
		$fecha_mes                             = date("Y-m", strtotime($fecha_dmy));
		$fecha_seg                             = time();
		$fecha_ymd                             = $fecha_dmy;
		$anyo                                  = date("Y", strtotime($fecha_dmy));
		$ip                                    = $_SERVER["REMOTE_ADDR"];
		$fecha_ymd_movimiento_caja             = $fecha_dmy;
		//-------------------------------------- -----------------------------------------------------------------//
		$sql_movimiento_contable_cuenta_personal = "SELECT total_saldo AS total_saldo_movimiento_contable_cuenta_personal FROM tbl15_movimiento_contable_cuenta_personal 
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_movimiento_contable_cuenta_personal = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal);
		$info_movimiento_contable_cuenta_personal = mysqli_fetch_assoc($resultado_movimiento_contable_cuenta_personal);

		$total_saldo_movimiento_contable_cuenta_personal       = $info_movimiento_contable_cuenta_personal['total_saldo_movimiento_contable_cuenta_personal'];
		$total_saldo                                           = $total_saldo_movimiento_contable_cuenta_personal;
		$saldo_actual_puc                                      = $costo;
		$subtotal_puc                                          = $total_saldo_movimiento_contable_cuenta_personal;
		//-------------------------------------- -----------------------------------------------------------------//
		$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_egreso'";
		$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
		$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);
		$cod_egreso                                            = $datos_autoincremento_egresos['AUTO_INCREMENT'];
		//-------------------------------------- -----------------------------------------------------------------//
		if ($nombre_tipo_puc == 'INGRESOS') {
			$total_saldo_final                     = $total_saldo + $costo;
			$nombre_tipo_documento                 = 'RECIBO DE CAJA';
			$nombre_tipo_movimiento                = 'DEBITOS';
		} elseif ($nombre_tipo_puc == 'EGRESOS') {
			$total_saldo_final                     = $total_saldo - $costo;
			$nombre_tipo_documento                 = 'COMPROBANTE DE EGRESO';
			$nombre_tipo_movimiento                = 'DEBITOS';

			$agreg = "INSERT INTO tbl15_egreso (cod_concepto_movimiento_caja, nombre_concepto_movimiento_caja, nombre_tipo_puc, simbolo_tipo_operacion, 
			costo, cod_tercero, comentario, codigo_puc, nombre_puc, cod_dependencia, total_saldo, 
			cod_tipo_forma_pago, fecha_dmy, fecha_time, fecha_mes_ym, anyo, hora, cuenta, nombre_ccosto, fecha_ymd_movimiento_caja, cod_cuentas_pagar, nombre_cuenta_pagar, nombre_tipo_cuenta_cobrar_pagar) 
			VALUES ('$cod_concepto_movimiento_caja', '$nombre_concepto_movimiento_caja', '$nombre_tipo_puc', '$simbolo_tipo_operacion', 
			'$costo', '$cod_tercero', '$comentario', '$codigo_puc', '$nombre_puc', '$cod_dependencia', '$total_saldo',  
			'$cod_tipo_forma_pago', '$fecha_dmy', '$fecha_time', '$fecha_mes_ym', '$anyo', '$hora', '$cuenta', '$nombre_ccosto', '$fecha_ymd_movimiento_caja', '$cod_cuentas_pagar', '$nombre_cuenta_pagar', '$nombre_tipo_cuenta_cobrar_pagar')";
			$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
		} elseif ($nombre_tipo_puc == 'PASIVOS') {
			$total_saldo_final                     = $total_saldo - $costo;
			$nombre_tipo_documento                 = 'COMPROBANTE DE EGRESO';
			$nombre_tipo_movimiento                = 'DEBITOS';
		} else {

		}
		//-------------------------------------- -----------------------------------------------------------------//
		//-------------------------------------- -----------------------------------------------------------------//
		$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo_final', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
		WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		//-------------------------------------- -----------------------------------------------------------------//
		//-------------------------------------- -----------------------------------------------------------------//
		$sql_autoincremento_movimiento_contable_cuenta_personal_concepto = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable_cuenta_personal_concepto'";
		$exec_autoincremento_movimiento_contable_cuenta_personal_concepto = mysqli_query($conectar, $sql_autoincremento_movimiento_contable_cuenta_personal_concepto) or die(mysqli_error($conectar));
		$datos_autoincremento_movimiento_contable_cuenta_personal_concepto = mysqli_fetch_assoc($exec_autoincremento_movimiento_contable_cuenta_personal_concepto);

		$cod_movimiento_contable_cuenta_personal_concepto        = $datos_autoincremento_movimiento_contable_cuenta_personal_concepto['AUTO_INCREMENT'];

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, nombre_tipo_documento, nombre_tipo_movimiento, 
		nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
		cuenta, comentario, cod_tercero, cod_tipo_forma_pago, simbolo_tipo_operacion, total_saldo, cod_egreso, cod_tipo_pago)
		VALUES ('$cod_movimiento_contable_cuenta_personal', '$nombre_tipo_documento', '$nombre_tipo_movimiento', 
		'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
		'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_egreso', '$cod_tipo_pago')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
		//-------------------------------------- -----------------------------------------------------------------//
		//-------------------------------------- -----------------------------------------------------------------//

		$respuesta_ajax['llave']                                                    = $cod_movimiento_contable_cuenta_personal_concepto;
		$respuesta_ajax['costo']                                                    = $costo;
		$respuesta_ajax['vlr_cancelado']                                            = 0;
		$respuesta_ajax['vlr_vuelto']                                               = 0;
		$respuesta_ajax['estado']                                                   = '1';
		$respuesta_ajax['total_datos_data']                                         = 1;
		$respuesta_ajax['cod_tipo_accion_caja_registradora']                        = $cod_tipo_accion_caja_registradora;
		$respuesta_ajax['nombre_tipo_factura']                                      = $nombre_tipo_factura;
		$respuesta_ajax['pagina_redirect_imprimir']                                 = '';
		$respuesta_ajax['conexion_internet']                                        = $conexion_internet;
		$respuesta_ajax['cod_estado_enviar_factura_venta_electronica_dian_api']     = $cod_estado_enviar_factura_venta_electronica_dian_api;

		echo json_encode($respuesta_ajax);
	}
}
?>