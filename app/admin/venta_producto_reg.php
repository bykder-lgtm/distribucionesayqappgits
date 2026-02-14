<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                        = $_SESSION['usuario'];
$cod_sesion                    = intval($_SESSION['cod_sesion']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_info_factura_venta'])) {

	$cod_info_factura_venta                          = intval($_POST['cod_info_factura_venta']);
	$fecha_anyo                                      = addslashes($_POST['fecha_anyo']);
	$cod_tercero                                     = intval($_POST['cod_tercero']);
	$nombre_tipo_moneda                              = addslashes($_POST['nombre_tipo_moneda']);
	$cod_resolucion_facturacion                      = intval($_POST['cod_resolucion_facturacion']);
	$cod_tipo_forma_pago                             = intval($_POST['cod_tipo_forma_pago']);
	$cod_administrador                               = intval($_POST['cod_administrador']);
	$total_datos                                     = intval($_POST['total_datos']);
	$vlr_cancelado                                   = addslashes($_POST['vlr_cancelado']);
	$pagina                                          = addslashes($_POST['pagina']);
	$fecha_venta_ymd_dian                            = $fecha_anyo;
	$fecha_venta_hora_dian                           = date("Y-m-d");
	$total_saldo_movimiento_contable_cuenta_personal = 0;
	$total_saldo_movimiento_caja_fnr                 = 0;
	$total_saldo_puc                                 = 0;
	//---------------------------------------------------------------------------------------------------------------------------------//
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
	//---------------------------------------------------------------------------------------------------------------------------------//
	if (isset($_POST['cod_tipo_pago'])) { $cod_tipo_pago = intval($_POST['cod_tipo_pago']); } else { $cod_tipo_pago = '1'; }
	if (isset($_POST['cod_tipo_metodo_envio'])) { $cod_tipo_metodo_envio = addslashes($_POST['cod_tipo_metodo_envio']); } else { $cod_tipo_metodo_envio = '1'; }
	if (isset($_POST['nombre1_tercero'])) { $nombre1_tercero = addslashes($_POST['nombre1_tercero']); } else { $nombre1_tercero = ''; }
	if (isset($_POST['fecha_entrega'])) { $fecha_entrega = addslashes($_POST['fecha_entrega']); } else { $fecha_entrega = ''; }
	if (isset($_POST['descripcion_tipo_forma_pago'])) { $descripcion_tipo_forma_pago = addslashes($_POST['descripcion_tipo_forma_pago']); } else { $descripcion_tipo_forma_pago = ''; }
	if (isset($_POST['fecha_pago'])) { $fecha_pago = addslashes($_POST['fecha_pago']); } else { $fecha_pago = ''; }
	if (isset($_POST['cod_domiciliario'])) { $cod_domiciliario = addslashes($_POST['cod_domiciliario']); } else { $cod_domiciliario = '0'; }
	if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
	if (isset($_POST['vlr_cancelado_number'])) { $vlr_cancelado_number = addslashes($_POST['vlr_cancelado_number']); } else { $vlr_cancelado_number = ''; }
	if (isset($_POST['cod_puc'])) { $cod_puc = intval($_POST['cod_puc']); $cod_puc_post = intval($_POST['cod_puc']); } else { $cod_puc = 0; $cod_puc_post = 1; }
	if (isset($_POST['nombre_tipo_factura'])) { $nombre_tipo_factura = addslashes($_POST['nombre_tipo_factura']); } else { $nombre_tipo_factura = ''; }
	if (isset($_POST['observacion_tercero'])) { $observacion_tercero = addslashes($_POST['observacion_tercero']); } else { $observacion_tercero = ''; }
	if (isset($_POST['cod_sino_crear_mov_contable'])) { $cod_sino_crear_mov_contable = intval($_POST['cod_sino_crear_mov_contable']); } else { $cod_sino_crear_mov_contable = '1'; }
	if (isset($_POST['cod_puntos_redimibles_campanya'])) { $cod_puntos_redimibles_campanya = intval($_POST['cod_puntos_redimibles_campanya']); } else { $cod_puntos_redimibles_campanya = '0'; }
	if (isset($_POST['cod_movimiento_contable_cuenta_personal'])) { $cod_movimiento_contable_cuenta_personal = intval($_POST['cod_movimiento_contable_cuenta_personal']); } else { $cod_movimiento_contable_cuenta_personal = 0; }
	if (isset($_POST['cod_movimiento_caja'])) { $cod_movimiento_caja = intval($_POST['cod_movimiento_caja']); } else { $cod_movimiento_caja = 1; }
	if (isset($_POST['retefuente_ptj'])) { $retefuente_ptj = addslashes($_POST['retefuente_ptj']); } else { $retefuente_ptj = '0'; }
	if (isset($_POST['reteica_ptj'])) { $reteica_ptj = addslashes($_POST['reteica_ptj']); } else { $reteica_ptj = '0'; }
	if (isset($_POST['reteiva_ptj'])) { $reteiva_ptj = addslashes($_POST['reteiva_ptj']); } else { $reteiva_ptj = '0'; }
	if (isset($_POST['cod_estado_alquiler_renta'])) { $cod_estado_alquiler_renta = intval($_POST['cod_estado_alquiler_renta']); } else { $cod_estado_alquiler_renta = '0'; }
	if (isset($_POST['fecha_ini_renta_alquiler'])) { $fecha_ini_renta_alquiler = addslashes($_POST['fecha_ini_renta_alquiler']); } else { $fecha_ini_renta_alquiler = ''; }
	if (isset($_POST['fecha_fin_renta_alquiler'])) { $fecha_fin_renta_alquiler = addslashes($_POST['fecha_fin_renta_alquiler']); } else { $fecha_fin_renta_alquiler = ''; }
	if (isset($_POST['cod_tipo_servicio'])) { $cod_tipo_servicio = intval($_POST['cod_tipo_servicio']); } else { $cod_tipo_servicio = '0'; }
	if (isset($_POST['modo_venta_por_defecto'])) { $modo_venta_por_defecto = addslashes($_POST['modo_venta_por_defecto']); } else { $modo_venta_por_defecto = $modo_venta_por_defecto_global; }
	if (isset($_POST['cod_estado_ignorar_venta'])) { $cod_estado_ignorar_venta = intval($_POST['cod_estado_ignorar_venta']); } else { $cod_estado_ignorar_venta = '0'; }
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$vlr_cancelado_number = str_replace ( ",", '', $vlr_cancelado_number);
	$vlr_cancelado_number = str_replace ( ".", '', $vlr_cancelado_number);
	if ($vlr_cancelado_number <> $vlr_cancelado) { $vlr_cancelado = $vlr_cancelado_number; } else { $vlr_cancelado = $vlr_cancelado; }
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_resolucion_facturacion = "SELECT nombre_tipo_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
	$resultado_resolucion_facturacion = mysqli_query($conectar, $obtener_resolucion_facturacion) or die(mysqli_error($conectar));
	$info_resolucion_facturacion = mysqli_fetch_assoc($resultado_resolucion_facturacion);

	$nombre_tipo_factura                       = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$cod_servicio_propina                                 = '22222222';
	$cod_servicio_cava                                    = '55555555';
	$cod_servicio_domicilio                               = '44444444';
	$cod_servicio_descuento_punto_redimible               = '11112222';
	$cod_servicio_descuento                               = '33333333';
	$cod_servicio_imp_bolsa                               = '11111111';
	$cod_servicio_retefuente                              = '11113333';
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_tercero = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, digito_tercero, 
	retefuente_ptj, reteica_ptj, reteiva_ptj, total_puntos_redimibles_campanya_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
	$resultado_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
	$info_tercero = mysqli_fetch_assoc($resultado_tercero);

	$retefuente_ptj_tercero                                = $info_tercero['retefuente_ptj'];
	$reteica_ptj                                           = $info_tercero['reteica_ptj'];
	$reteiva_ptj                                           = $info_tercero['reteiva_ptj'];
	$nit_cliente                                           = $info_tercero['identificacion_tercero'];
	$nombres_clientes                                      = $info_tercero['nombre1_tercero'].' '.$info_tercero['nombre2_tercero'].' '.$info_tercero['apellido1_tercero'].' '.$info_tercero['apellido2_tercero'];
	$digito                                                = $info_tercero['digito_tercero'];
	$fecha_ymd                                             = $fecha_anyo;
	$fecha_factura                                         = $fecha_anyo;
	$comentario                                            = $observacion_tercero;
	/* ----------------------------------------------------------------------------------------------------------/ */
	$verificar_si_existe_retefuente_en_factura = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_retefuente')";
	$resultado_si_existe_retefuente_en_factura  = mysqli_query($conectar, $verificar_si_existe_retefuente_en_factura);
	$existe_retefuente_en_factura = mysqli_num_rows($resultado_si_existe_retefuente_en_factura);
	$info_existe_retefuente_en_factura = mysqli_fetch_assoc($resultado_si_existe_retefuente_en_factura);
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_total_venta_temp_aplic_rete = "SELECT SUM(und_venta * precio_compra_producto) AS total_compra_temp_aplic_rete, SUM(und_venta * precio_venta_producto) AS total_venta_temp_aplic_rete 
	FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_propina') 
	AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible')";
	$consulta_total_venta_temp_aplic_rete = mysqli_query($conectar, $sql_total_venta_temp_aplic_rete) or die(mysqli_error($conectar));
	$datos_total_venta_temp_aplic_rete = mysqli_fetch_assoc($consulta_total_venta_temp_aplic_rete);

	$total_compra_temp_aplic_rete                = $datos_total_venta_temp_aplic_rete['total_compra_temp_aplic_rete'];
	$total_venta_temp_aplic_rete                 = $datos_total_venta_temp_aplic_rete['total_venta_temp_aplic_rete'];
	/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_retefuente_en_factura = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base 
	FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_propina') 
	AND (cod_producto_barra <> '$cod_servicio_domicilio') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible')";
	$resultado_retefuente_en_factura  = mysqli_query($conectar, $sql_retefuente_en_factura);
	$info_retefuente_en_factura = mysqli_fetch_assoc($resultado_retefuente_en_factura);

    $subtotal_base                                        = $info_retefuente_en_factura['subtotal_base'];

	if (($retefuente_ptj_tercero <> '0') && ($subtotal_base >= $limite_base_venta_aplicar_retefuente_global) && ($existe_retefuente_en_factura == '0')) {
		$condicion_aplicar_retefuente = false; 
	} else {
		$condicion_aplicar_retefuente = true; 
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$fecha_ymdHis                              = date("YmdHis");
	$ruta_firma_miniatura                      = '../archivador/firma/miniatura/';
	$ruta_foto_miniatura                       = '../archivador/foto/miniatura/';
	$ruta_firma_orig                           = '../archivador/firma/original/';
	$ruta_foto_orig                            = '../archivador/documentos/';
	/* ----------------------------------------------------------------------------------------------------------/ */
	if ($url_img1 <> '') { 
		$formato_img2                    = explode(".", $url_img1);
		$formato_img2                    = end($formato_img2);
		$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_info_factura_venta.'_'.$cod_tercero.'_'.$cod_administrador.'.'.$formato_img2;
		$url_img_orig_producto           = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto            = $ruta_foto_orig.$nombre_normal2;
		copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
	} else { 
		$formato_img2                    = "";
		$formato_img2                    = "";
		$nombre_normal2                  = "";
		$url_img_orig_producto           = "";
		$url_img_min_producto            = "";
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
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
//-------------------------------------- -------------------------------------------------------------
	$sql_existe_producto_con_unidad_venta_cero = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta' AND und_venta = '0')";
	$consulta_existe_producto_con_unidad_venta_cero = mysqli_query($conectar, $sql_existe_producto_con_unidad_venta_cero) or die(mysqli_error($conectar));
	$total_existe_producto_con_unidad_venta_cero = mysqli_num_rows($consulta_existe_producto_con_unidad_venta_cero);
	$info_existe_producto_con_unidad_venta_cero = mysqli_fetch_assoc($consulta_existe_producto_con_unidad_venta_cero);
	//$cod_venta_producto_temporal                                                    = $info_existe_producto_con_unidad_venta_cero['cod_venta_producto_temporal'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_admin_user_dep = "SELECT cod_dependencia_user, cod_tipo_aplicacion, cod_estado_enviar_factura_venta_electronica_dian_api FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
	$resultado_admin_user_dep = mysqli_query($conectar, $sql_admin_user_dep);
	$info_admin_user_dep = mysqli_fetch_assoc($resultado_admin_user_dep);

	$cod_dependencia_user                                            = $info_admin_user_dep['cod_dependencia_user'];
	$cod_tipo_aplicacion                                             = $info_admin_user_dep['cod_tipo_aplicacion'];
	$cod_estado_enviar_factura_venta_electronica_dian_api            = $info_admin_user_dep['cod_estado_enviar_factura_venta_electronica_dian_api'];

	if ($cod_tipo_aplicacion == '0') {
		$pagina_redirect_imprimir = '../admin/venta_productos_opcion_imprimir.php'; 
	} elseif ($cod_tipo_aplicacion == '3') {
		$pagina_redirect_imprimir = '../admin/venta_productos_opcion_imprimir_version_tactil.php'; 
	} else {
		$pagina_redirect_imprimir = '../admin/venta_productos_opcion_imprimir.php'; 
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
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
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	/*
	$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion 
	WHERE (nombre_tipo_resolucion_facturacion = '$nombre_tipo_factura') AND (nombre_tipo_estado = 'ACTIVO')";
	$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
	$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
	$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

	$cod_resolucion_facturacion       = intval($matriz_resol_fact['cod_resolucion_facturacion']);
	*/
	if ($cod_estado_limite_venta_pos_factura_electronica_global == '1' && $nombre_tipo_factura == 'ELECTRONICA') {
	    //$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_venta WHERE (nombre_tipo_factura = 'ELECTRONICA') AND (nombre_estado_factura = 'CERRADA') AND (cod_estado_check_factura_electronica = '1')";
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
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_info_imp_factura = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
	$modificar_info_imp_factura = mysqli_query($conectar, $sql_info_imp_factura) or die(mysqli_error($conectar));
	$total_encontrado_info_imp_factura = mysqli_num_rows($modificar_info_imp_factura);
	$matriz_info_imp_factura  = mysqli_fetch_assoc($modificar_info_imp_factura);

	$fecha_ymdhis                                                   = $matriz_info_imp_factura['fecha_ymdhis'];
	//$cuenta                                                       = $cuenta_actual;
	$cod_estado_factura                                             = '0';
	$descuento_ptj                                                  = '0';
	$iva_ptj                                                        = '0';
	$flete_ptj                                                      = '0';
	//$cod_cliente                                                    = '0';
	$vlr_vuelto                                                     = '0';
	$fecha_dia                                                      = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes                                                      = date("Y-m", $fecha_anyo_seg);
	$anyo                                                           = date("Y", $fecha_anyo_seg);
	$fecha_hora                                                     = date("H:i:s");
	$fecha_hora_venta_producto                                      = date("H:i:s");
	$fecha_remision                                                 = $matriz_info_imp_factura['fecha_remision'];
	$nombre_ccosto                                                  = $matriz_info_imp_factura['nombre_ccosto'];
	$garantia_meses                                                 = $matriz_info_imp_factura['garantia_meses'];
	$observacion                                                    = $matriz_info_imp_factura['observacion'];
	$cod_tipo_inventario                                            = $matriz_info_imp_factura['cod_tipo_inventario'];
	$cod_base_caja                                                  = $matriz_info_imp_factura['cod_base_caja'];
	$cuenta_vendedor                                                = $matriz_info_imp_factura['cuenta'];
	$cod_caja_virtual_vendedor                                      = $matriz_info_imp_factura['cod_caja_virtual'];
	//$cod_administrador                                              = $matriz_info_imp_factura['cod_administrador'];
	$fecha_ymd_venta_producto                                       = date("Y-m-d", $fecha_anyo_seg);
	$fecha_mes_venta_producto                                       = date("Y-m", $fecha_anyo_seg);
	$fecha_anyo_venta_producto                                      = date("Y", $fecha_anyo_seg);
	$fecha_seg_venta_producto                                       = time();
	//---------------------------------------------------------    ------------------------------------------------------------------------//
	if ($cod_tipo_inventario == '1') { $campo_und_inventario = 'und_producto'; } elseif ($cod_tipo_inventario == '2') { $campo_und_inventario = 'und_producto_bodega'; } else { $campo_und_inventario = 'und_producto'; }
	//---------------------------------------------------------    ------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_total_venta_producto_temporal = "SELECT SUM(total_venta_producto) AS total_precio_venta, SUM(total_compra_producto) AS total_precio_compra
	FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
	$datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal);

	$total_precio_compra                                            = $datos_total_venta_producto_temporal['total_precio_compra'];
	$total_precio_venta                                             = $datos_total_venta_producto_temporal['total_precio_venta'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_total_venta_producto_temporal_movimiento_caja_efectivo = "SELECT SUM(und_venta * precio_venta_producto) AS total_precio_venta_movimiento_caja_puc, SUM(und_venta * precio_costo_producto) AS total_precio_compra_movimiento_caja_puc
	FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	$consulta_total_venta_producto_temporal_movimiento_caja_efectivo = mysqli_query($conectar, $sql_total_venta_producto_temporal_movimiento_caja_efectivo) or die(mysqli_error($conectar));
	$datos_total_venta_producto_temporal_movimiento_caja_efectivo = mysqli_fetch_assoc($consulta_total_venta_producto_temporal_movimiento_caja_efectivo);

	$total_precio_compra_movimiento_caja_puc                        = $datos_total_venta_producto_temporal_movimiento_caja_efectivo['total_precio_compra_movimiento_caja_puc'];
	$total_precio_venta_movimiento_caja_puc                         = $datos_total_venta_producto_temporal_movimiento_caja_efectivo['total_precio_venta_movimiento_caja_puc'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$tiempo_final                                                   = microtime(true);
	$tiempo_ejecucion                                               = $tiempo_final - $tiempo_inicial;
	$vlr_vuelto                                                     = $vlr_cancelado - $total_precio_venta;
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_puntos_redimibles_campanya_global == '1') {

		$obtener_puntos_redimibles_campanya = "SELECT valor_puntos_redimibles_campanya, cantidad_puntos_x_valor_redimibles_campanya, equivalencia_en_pesos_de_un_punto 
		FROM tbl15_puntos_redimibles_campanya WHERE (cod_puntos_redimibles_campanya = '$cod_puntos_redimibles_campanya')";
		$resultado_puntos_redimibles_campanya = mysqli_query($conectar, $obtener_puntos_redimibles_campanya) or die(mysqli_error($conectar));
		$info_puntos_redimibles_campanya = mysqli_fetch_assoc($resultado_puntos_redimibles_campanya);

		$valor_puntos_redimibles_campanya                         = intval($info_puntos_redimibles_campanya['valor_puntos_redimibles_campanya']);
		$cantidad_puntos_x_valor_redimibles_campanya              = intval($info_puntos_redimibles_campanya['cantidad_puntos_x_valor_redimibles_campanya']);
		$equivalencia_en_pesos_de_un_punto                        = intval($info_puntos_redimibles_campanya['equivalencia_en_pesos_de_un_punto']);
		$total_puntos_redimibles_campanya_tercero_acumulado       = $info_tercero['total_puntos_redimibles_campanya_tercero'];

    	if ($valor_puntos_redimibles_campanya == '0') { $valor_puntos_redimibles_campanya = '1'; } else { $valor_puntos_redimibles_campanya = $valor_puntos_redimibles_campanya; }

		$sql_total_venta_producto_temporal_puntos_redimibles = "SELECT SUM(total_venta_producto) AS total_precio_venta
		FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '$cod_servicio_descuento') AND (cod_producto_barra <> '$cod_servicio_propina') AND (cod_producto_barra <> '$cod_servicio_descuento_punto_redimible')";
		$consulta_total_venta_producto_temporal_puntos_redimibles = mysqli_query($conectar, $sql_total_venta_producto_temporal_puntos_redimibles) or die(mysqli_error($conectar));
		$datos_total_venta_producto_temporal_puntos_redimibles = mysqli_fetch_assoc($consulta_total_venta_producto_temporal_puntos_redimibles);

		$total_precio_venta                                       = $datos_total_venta_producto_temporal_puntos_redimibles['total_precio_venta'];
		$total_puntos_redimibles_campanya                         = ($total_precio_venta / $valor_puntos_redimibles_campanya) * $cantidad_puntos_x_valor_redimibles_campanya;
		$total_puntos_redimibles_campanya_tercero                 = ($total_puntos_redimibles_campanya + $total_puntos_redimibles_campanya_tercero_acumulado);

		$sql_valor_del_descuento_puntos_redimibles = "SELECT SUM(total_venta_producto) AS valor_del_descuento_puntos_redimibles FROM tbl15_venta_producto_temporal 
		WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_descuento_punto_redimible')";
		$consulta_valor_del_descuento_puntos_redimibles = mysqli_query($conectar, $sql_valor_del_descuento_puntos_redimibles) or die(mysqli_error($conectar));
		$datos_valor_del_descuento_puntos_redimibles = mysqli_fetch_assoc($consulta_valor_del_descuento_puntos_redimibles);

		$valor_del_descuento_puntos_redimibles                    = intval($datos_valor_del_descuento_puntos_redimibles['valor_del_descuento_puntos_redimibles']);
		$puntos_gastados_aplicar_descuento_puntos_redimible       = abs($valor_del_descuento_puntos_redimibles / $equivalencia_en_pesos_de_un_punto);
		$total_puntos_sobrantes_descuento_puntos_redimibles       = $total_puntos_redimibles_campanya_tercero - $puntos_gastados_aplicar_descuento_puntos_redimible;
		$total_puntos_redimibles_campanya                         = $puntos_gastados_aplicar_descuento_puntos_redimible;
		$total_valor_dinero_puntos_redimibles_campanya            = $valor_del_descuento_puntos_redimibles;

		$sql_existe_descuento_puntos_redimibles = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra = '$cod_servicio_descuento_punto_redimible')";
		$consulta_existe_descuento_puntos_redimibles = mysqli_query($conectar, $sql_existe_descuento_puntos_redimibles) or die(mysqli_error($conectar));
		$existe_descuento_puntos_redimibles = mysqli_num_rows($consulta_existe_descuento_puntos_redimibles);

		if ($existe_descuento_puntos_redimibles == '0') {
			$sql_acumular_puntos_redimibles_tercero = sprintf("UPDATE tbl15_tercero SET total_puntos_redimibles_campanya_tercero = '$total_puntos_redimibles_campanya_tercero' WHERE (cod_tercero = '$cod_tercero')");
			$resultado_acumular_puntos_redimibles_tercero  = mysqli_query($conectar, $sql_acumular_puntos_redimibles_tercero) or die(mysqli_error($conectar));
		} else {
			$sql_acumular_puntos_redimibles_tercero = sprintf("UPDATE tbl15_tercero SET total_puntos_redimibles_campanya_tercero = '$total_puntos_sobrantes_descuento_puntos_redimibles' WHERE (cod_tercero = '$cod_tercero')");
			$resultado_acumular_puntos_redimibles_tercero  = mysqli_query($conectar, $sql_acumular_puntos_redimibles_tercero) or die(mysqli_error($conectar));
		}
	}
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	if ($cod_estado_movimiento_contable_caja_personal_global == '1' && $cod_tipo_pago == '1') {

		$sql_movimiento_caja = "SELECT total_compra_producto, total_venta_producto, total_saldo, fecha_ymd_movimiento_caja FROM tbl15_movimiento_caja WHERE (cod_movimiento_caja = '$cod_movimiento_caja')";
		$consulta_movimiento_caja = mysqli_query($conectar, $sql_movimiento_caja) or die(mysqli_error($conectar));
		$datos_movimiento_caja = mysqli_fetch_assoc($consulta_movimiento_caja);

		$fecha_ymd_movimiento_caja                  = $datos_movimiento_caja['fecha_ymd_movimiento_caja'];
		$total_saldo_movimiento_caja_fnr            = $datos_movimiento_caja['total_saldo'];

		if (($fecha_ymd_movimiento_caja == $fecha_anyo)) {

			$total_compra_producto                  = $datos_movimiento_caja['total_compra_producto'] + $total_precio_compra_movimiento_caja_puc;
			$total_venta_producto                   = $datos_movimiento_caja['total_venta_producto'] + $total_precio_venta_movimiento_caja_puc;
			$total_saldo                            = $total_precio_venta_movimiento_caja_puc + $datos_movimiento_caja['total_saldo'];

			$agregar_regis = sprintf("UPDATE tbl15_movimiento_caja SET total_compra_producto = '$total_compra_producto', total_venta_producto = '$total_venta_producto', total_saldo = '$total_saldo', 
			fecha_hora_movimiento_caja = '$fecha_hora_venta_producto', fecha_seg_movimiento_caja = '$fecha_seg_venta_producto', fecha_creacion = '$fecha_creacion', cuenta = '$cuenta' 
			WHERE (cod_movimiento_caja = '$cod_movimiento_caja')");
			$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
		} else {

			$total_compra_producto                  = $total_precio_compra_movimiento_caja_puc;
			$total_venta_producto                   = $total_precio_venta_movimiento_caja_puc;
			$total_saldo                            = $total_precio_venta_movimiento_caja_puc + $datos_movimiento_caja['total_saldo'];

			$agregar_regis = sprintf("UPDATE tbl15_movimiento_caja SET total_compra_producto = '$total_compra_producto', total_venta_producto = '$total_venta_producto', total_saldo = '$total_saldo', 
			fecha_ymd_movimiento_caja = '$fecha_ymd_venta_producto', fecha_mes_movimiento_caja = '$fecha_mes_venta_producto', fecha_anyo_movimiento_caja = '$fecha_anyo_venta_producto', 
			fecha_hora_movimiento_caja = '$fecha_hora_venta_producto', fecha_seg_movimiento_caja = '$fecha_seg_venta_producto', fecha_creacion = '$fecha_creacion', cuenta = '$cuenta' 
			WHERE (cod_movimiento_caja = '$cod_movimiento_caja')");
			$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
		}
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_verificar_precio_venta_en_cero_venta_temp_global == '1') { 
		$sql_verificar_precio_venta_en_cero_venta_temp = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (precio_venta_producto <= '0')";
		$consulta_verificar_precio_venta_en_cero_venta_temp = mysqli_query($conectar, $sql_verificar_precio_venta_en_cero_venta_temp) or die(mysqli_error($conectar));
		$existe_verificar_precio_venta_en_cero_venta_temp = mysqli_num_rows($consulta_verificar_precio_venta_en_cero_venta_temp);
		//$datos_verificar_precio_venta_en_cero_venta_temp = mysqli_fetch_assoc($consulta_verificar_precio_venta_en_cero_venta_temp);
		if ($existe_verificar_precio_venta_en_cero_venta_temp <> '0') { 
			$condicion_producto_con_precio_venta_cero = false; 
		} else { 
			$condicion_producto_con_precio_venta_cero = true; 
		}
		
	} else { 
		$condicion_producto_con_precio_venta_cero = true; 
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_verificar_unidad_venta_en_cero_venta_temp_global == '1') { 
		$sql_verificar_unidad_venta_en_cero_venta_temp = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (und_venta <= '0')";
		$consulta_verificar_unidad_venta_en_cero_venta_temp = mysqli_query($conectar, $sql_verificar_unidad_venta_en_cero_venta_temp) or die(mysqli_error($conectar));
		$existe_verificar_unidad_venta_en_cero_venta_temp = mysqli_num_rows($consulta_verificar_unidad_venta_en_cero_venta_temp);
		//$datos_verificar_unidad_venta_en_cero_venta_temp = mysqli_fetch_assoc($consulta_verificar_unidad_venta_en_cero_venta_temp);
		if ($existe_verificar_unidad_venta_en_cero_venta_temp <> '0') { 
			$condicion_producto_con_unidad_venta_cero = false; 
		} else { 
			$condicion_producto_con_unidad_venta_cero = true; 
		}
		
	} else { 
		$condicion_producto_con_unidad_venta_cero = true; 
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	if (($cod_estado_tipo_venta_zapateria_global == '1') && ($vlr_vuelto < '0')) { $condicion_zapateria = true; } elseif (($cod_estado_tipo_venta_zapateria_global == '0') && ($vlr_vuelto < '0')) { $condicion_zapateria = false; } else { $condicion_zapateria = true; }
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	//-------------------------------------- LLAVE DE INICIO DEL CONDICIONAL VENDER POR CONTADO ------------------------------------------//
	if (($condicion_producto_con_precio_venta_cero) && ($condicion_producto_con_unidad_venta_cero) && ($condicion_zapateria) && ($condicion_aplicar_retefuente) && ($vlr_cancelado <= 99999999) && ($cod_tipo_pago == '1')) {

		$sql_mconsulta = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto_temporal ASC";
		$mconsulta = mysqli_query($conectar, $sql_mconsulta) or die(mysqli_error($conectar));
		while ($datos_temp = mysqli_fetch_assoc($mconsulta)) {
		//$datos_temp = mysqli_fetch_assoc($mconsulta);

			$cod_venta_producto_temporal                = $datos_temp['cod_venta_producto_temporal'];
			$cod_producto                               = $datos_temp['cod_producto'];
			$cod_producto_barra                         = $datos_temp['cod_producto_barra'];
			$nombre_tipo_precio_venta                   = $datos_temp['nombre_tipo_precio_venta'];
			$cod_producto_barra_madre                   = $cod_producto_barra;

			$sqlr_consulta = "SELECT und_producto, und_producto_bodega, iva_ptj, comision_ptj, cod_dependencia, cod_opcion_descontable_inv, precio_compra_producto, precio_costo_producto, nombre_tipo_compra, iva_saludable_ptj, cod_marca 
			FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
			$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
			$datos_prod = mysqli_fetch_assoc($modificar_consulta);
			//-----------------------------------------------------------------------------------------------------------------------------------------//
			//------------------------------------TIPO DE VENTA PUEDES SER MENUDIADO O POR UNIDADES----------------------------------------------------//
			$cod_producto                               = $datos_temp['cod_producto'];
			$cod_producto_barra                         = $datos_temp['cod_producto_barra'];
			$nombre_producto                            = $datos_temp['nombre_producto'];
			$und_venta                                  = $datos_temp['und_venta'];
			$nombre_tipo_compra                         = $datos_prod['nombre_tipo_compra'];
			if ($nombre_tipo_compra == '') { $nombre_tipo_compra = 'NORMAL'; } else { $nombre_tipo_compra = $datos_prod['nombre_tipo_compra']; }
			$precio_compra_producto                     = $datos_temp['precio_compra_producto'];
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

			$descuento_valor_pesos                      = $precio_venta_producto_orig - $precio_venta_producto;
			//$descuento_ptj                            = ($descuento_valor_pesos / $precio_venta_producto_orig) * 100;
			$und_producto                               = $und_producto_inv - $und_venta;
			$total_puntos_redimibles_campanya_producto  = ($total_venta_producto / $valor_puntos_redimibles_campanya) * $cantidad_puntos_x_valor_redimibles_campanya;

			$iva_ptj                                    = $datos_prod['iva_ptj'];
			if ($cod_estado_dia_sin_iva_global == '1') { $iva_ptj = '0'; } else { $iva_ptj = $iva_ptj; }


			if ($nombre_tipo_cobro == 'ANUAL') { $fecha_cobro_renovacion = date('Y-m-d', strtotime($fecha_ymd_venta_producto.' +1'.' year')); } elseif ($nombre_tipo_cobro == 'MENSUAL') { $fecha_cobro_renovacion = date('Y-m-d', strtotime($fecha_ymd_venta_producto.' +1'.' month')); } else { $fecha_cobro_renovacion = ''; }

			if ($cod_tipo_inventario == '1') { 
				if ($cod_opcion_descontable_inv == '0') { $und_producto = $und_producto_inv - $und_venta; } else { $und_producto = 0; }
			} elseif ($cod_tipo_inventario == '2') { 
				if ($cod_opcion_descontable_inv == '0') { $und_producto = $und_producto_bodega_inv - $und_venta; } else { $und_producto = 0; }
			} else { 
				$und_producto = $und_producto_inv - $und_venta; 
			}
		//--------------------------------------------------------------------------------------------//
			if ($vlr_vuelto < '0') { $cod_tipo_pago = '2'; } else { $cod_tipo_pago = '1'; }
		//----------------------------- INSERTAR PRODUCTOS A LAS VENTAS -----------------------------//
			$agregar_reg_venta_producto = "INSERT INTO tbl15_venta_producto (cod_info_factura_venta, cod_factura, cod_producto, cod_producto_barra, 
			nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, 
			total_venta_producto, nombre_tipo_producto, und_producto, und_producto_bodega_inv, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
			nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, nombre_tipo_presentacion,
			fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
			fecha_alerta, cod_resolucion_facturacion, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, comision_ptj, 
			cod_tipo_pago, cod_tipo_forma_pago, total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, vlr_cancelado, vlr_vuelto, 
			cod_dependencia, cod_tipo_inventario, precio_venta_producto_orig, descuento_ptj, comentario_producto, 
			fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin, placa_producto, 
			cod_parqueo_cotizacion_venta_producto, cod_info_parqueo_cotizacion_factura_venta, cod_info_hotel_cotizacion_factura_venta, cod_hotel_cotizacion_venta_producto, 
			cod_opcion_descontable_inv, cod_categoria, cod_categoria_sub, cod_tipo_producto_cocina, nombre_tipo_precio, nombre_tipo_compra, cod_tipo_metodo_envio, 
			peso_producto, unidad_medida_peso, cod_estado_cava, und_caja_sobre, nombre_tipo_und_caja_sobre, cod_base_caja, cod_venta_producto_temporal, cod_estado_tipo_hotel_parqueo, 
			total_horas, total_dias, cod_tipo_cod_barra, cajas_sobre, iva_saludable_ptj, nombre_tipo_cobro, fecha_cobro_renovacion, cod_puc, 
			cod_puntos_redimibles_campanya, total_puntos_redimibles_campanya_producto, cod_marca, cupo_credito_ptj, cod_estado_ignorar_venta)
			VALUES ('$cod_info_factura_venta', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
			'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', 
			'$total_venta_producto', '$nombre_tipo_producto', '$und_producto', '$und_producto_bodega_inv', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
			'$nombre_tipo_unidad_medida', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_presentacion',
			'$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
			'$fecha_alerta', '$cod_resolucion_facturacion', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$comision_ptj', 
			'$cod_tipo_pago', '$cod_tipo_forma_pago', '$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$vlr_cancelado', '$vlr_vuelto', 
			'$cod_dependencia', '$cod_tipo_inventario', '$precio_venta_producto_orig', '$descuento_ptj', '$comentario_producto', 
			'$fecha_ymd_parqueo_ini', '$fecha_hora_parqueo_ini', '$fecha_ymd_parqueo_fin', '$fecha_hora_parqueo_fin', '$placa_producto', 
			'$cod_parqueo_cotizacion_venta_producto', '$cod_info_parqueo_cotizacion_factura_venta', '$cod_info_hotel_cotizacion_factura_venta', '$cod_hotel_cotizacion_venta_producto', 
			'$cod_opcion_descontable_inv', '$cod_categoria', '$cod_categoria_sub', '$cod_tipo_producto_cocina', '$nombre_tipo_precio', '$nombre_tipo_compra', '$cod_tipo_metodo_envio', 
			'$peso_producto', '$unidad_medida_peso', '$cod_estado_cava', '$und_caja_sobre', '$nombre_tipo_und_caja_sobre', '$cod_base_caja', '$cod_venta_producto_temporal', '$cod_estado_tipo_hotel_parqueo', 
			'$total_horas', '$total_dias', '$cod_tipo_cod_barra', '$cajas_sobre', '$iva_saludable_ptj', '$nombre_tipo_cobro', '$fecha_cobro_renovacion', '$cod_puc', 
			'$cod_puntos_redimibles_campanya', '$total_puntos_redimibles_campanya_producto', '$cod_marca', '$cupo_credito_ptj', '$cod_estado_ignorar_venta')";
			$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));

			$actualiza_producto = sprintf("UPDATE tbl15_producto SET $campo_und_inventario = '$und_producto', peso_producto = '$peso_producto', 
			cod_estado_habitacion_hotel = '0', cod_info_factura_venta = '0', cod_venta_producto_temporal = '0' WHERE cod_producto_barra = '$cod_producto_barra'");
			$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));

			if ($cod_estado_cava == '1') { $agregar_regis = "UPDATE tbl15_info_factura_venta SET cod_estado_cava = '$cod_estado_cava' WHERE cod_info_factura_venta = '$cod_info_factura_venta'"; $resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar)); }
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
			if ($cod_estado_subproducto_global == '1') {
				$sql_subproducto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto FROM tbl15_subproducto WHERE (cod_producto_barra_madre = '$cod_producto_barra_madre')";
				$consulta_subproducto = mysqli_query($conectar, $sql_subproducto) or die(mysqli_error($conectar));
				while ($datos_subproducto = mysqli_fetch_assoc($consulta_subproducto)) {

				$cod_producto                      = $datos_subproducto['cod_producto'];
				$cod_producto_barra                = $datos_subproducto['cod_producto_barra'];
				$nombre_producto                   = $datos_subproducto['nombre_producto'];
				$und_venta                         = $datos_subproducto['und_producto'] * $und_venta_ext;
				$nombre_tipo_compra                = 'NORMAL';

				$sql_producto = "SELECT und_producto, nombre_tipo_precio_venta, iva_ptj, cod_dependencia, nombre_tipo_producto, nombre_tipo_unidad_medida, und_producto_bodega, iva_saludable_ptj 
				FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
				$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
				$datos_producto = mysqli_fetch_assoc($consulta_producto);

				$und_producto_inv                           = $datos_producto['und_producto'];
				$nombre_tipo_precio_venta                   = $datos_producto['nombre_tipo_precio_venta'];
				$nombre_tipo_producto                       = $datos_producto['nombre_tipo_producto'];
				$cod_dependencia                            = $datos_producto['cod_dependencia'];
				$nombre_tipo_unidad_medida                  = $datos_producto['nombre_tipo_unidad_medida'];
				$und_producto_bodega_inv                    = $datos_producto['und_producto_bodega'];
				$iva_saludable_ptj                          = $datos_producto['iva_saludable_ptj'];
				$iva_ptj                                    = $datos_producto['iva_ptj'];
				if ($cod_estado_dia_sin_iva_global == '1') { $iva_ptj = '0'; } else { $iva_ptj = $iva_ptj; }
				if ($cod_estado_venta_dependencia_de_usuario_global == '1') { $cod_dependencia = $cod_dependencia_user; } else { $cod_dependencia = $datos_prod['cod_dependencia']; }

				$agregar_reg_venta_producto_sub = "INSERT INTO tbl15_venta_producto_sub (cod_info_factura_venta, cod_producto_barra_madre, cod_factura, cod_producto, cod_producto_barra, 
				nombre_producto, und_venta, nombre_tipo_producto, und_producto, und_producto_bodega_inv, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
				nombre_tipo_unidad_medida, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
				cod_resolucion_facturacion, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, 
				cod_tipo_pago, cod_tipo_forma_pago, total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, vlr_cancelado, vlr_vuelto, cod_dependencia, 
				nombre_tipo_compra, cod_tipo_metodo_envio, peso_producto, unidad_medida_peso, cod_base_caja, iva_saludable_ptj)
				VALUES ('$cod_info_factura_venta', '$cod_producto_barra_madre', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
				'$nombre_producto', '$und_venta', '$nombre_tipo_producto', '$und_producto_inv',  '$und_producto_bodega_inv', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
				'$nombre_tipo_unidad_medida', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
				'$cod_resolucion_facturacion', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', 
				'$cod_tipo_pago', '$cod_tipo_forma_pago', '$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$vlr_cancelado', '$vlr_vuelto', '$cod_dependencia', 
				'$nombre_tipo_compra', '$cod_tipo_metodo_envio', '$peso_producto', '$unidad_medida_peso', '$cod_base_caja', '$iva_saludable_ptj')";
				$resultado_venta_producto_sub = mysqli_query($conectar, $agregar_reg_venta_producto_sub) or die(mysqli_error($conectar));
/*
				$agregar_reg_venta_producto = "INSERT INTO tbl15_venta_producto (cod_info_factura_venta, cod_producto_barra_madre, cod_factura, cod_producto, cod_producto_barra, 
				nombre_producto, und_venta, nombre_tipo_producto, und_producto, und_producto_bodega_inv, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
				nombre_tipo_unidad_medida, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
				cod_resolucion_facturacion, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, 
				cod_tipo_pago, cod_tipo_forma_pago, total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, vlr_cancelado, vlr_vuelto, cod_dependencia, 
				nombre_tipo_compra, cod_tipo_metodo_envio, peso_producto, unidad_medida_peso, cod_base_caja, iva_saludable_ptj)
				VALUES ('$cod_info_factura_venta', '$cod_producto_barra_madre', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
				'$nombre_producto', '$und_venta', '$nombre_tipo_producto', '$und_producto_inv',  '$und_producto_bodega_inv', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
				'$nombre_tipo_unidad_medida', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
				'$cod_resolucion_facturacion', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', 
				'$cod_tipo_pago', '$cod_tipo_forma_pago', '$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$vlr_cancelado', '$vlr_vuelto', '$cod_dependencia', 
				'$nombre_tipo_compra', '$cod_tipo_metodo_envio', '$peso_producto', '$unidad_medida_peso', '$cod_base_caja', '$iva_saludable_ptj')";
				$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));
*/
				$und_producto                      = $und_producto_inv - $und_venta;

				$actualiza_producto = sprintf("UPDATE tbl15_producto SET $campo_und_inventario = '$und_producto', peso_producto = '$peso_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
				$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));
				//----------------------------------------------------------------------- ---------------------------------------------------------//
				$sql_eliminar_parqueo_ingreso = ("DELETE FROM tbl15_parqueo_cotizacion_venta_producto WHERE (cod_parqueo_cotizacion_venta_producto = '$cod_parqueo_cotizacion_venta_producto')");
				$exec_parqueo_ingreso = mysqli_query($conectar, $sql_eliminar_parqueo_ingreso) or die(mysqli_error($conectar));
				//----------------------------------------------------------------------- ---------------------------------------------------------//
				$sql_eliminar_info_parqueo_ingreso = ("DELETE FROM tbl15_info_parqueo_cotizacion_factura_venta WHERE (cod_info_parqueo_cotizacion_factura_venta = '$cod_info_parqueo_cotizacion_factura_venta')");
				$exec_info_parqueo_ingreso = mysqli_query($conectar, $sql_eliminar_info_parqueo_ingreso) or die(mysqli_error($conectar));
				//----------------------------------------------------------------------- ---------------------------------------------------------//
				$sql_eliminar_hotel_ingreso = ("DELETE FROM tbl15_hotel_cotizacion_venta_producto WHERE (cod_hotel_cotizacion_venta_producto = '$cod_hotel_cotizacion_venta_producto')");
				$exec_parqueo_hotel_ingreso = mysqli_query($conectar, $sql_eliminar_hotel_ingreso) or die(mysqli_error($conectar));
				//----------------------------------------------------------------------- ---------------------------------------------------------//
				$sql_eliminar_info_hotel_ingreso = ("DELETE FROM tbl15_info_hotel_cotizacion_factura_venta WHERE (cod_info_hotel_cotizacion_factura_venta = '$cod_info_hotel_cotizacion_factura_venta')");
				$exec_info_hotel_ingreso = mysqli_query($conectar, $sql_eliminar_info_hotel_ingreso) or die(mysqli_error($conectar));
			}
		}
	}
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	if ($vlr_vuelto < '0') { 

		$sql_autoincremento_cuentas_cobrar = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar'";
		$exec_autoincremento_cuentas_cobrar = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar) or die(mysqli_error($conectar));
		$datos_autoincremento_cuentas_cobrar = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar);

		$cod_cuentas_cobrar           = $datos_autoincremento_cuentas_cobrar['AUTO_INCREMENT'];
		$monto_deuda                  = $total_precio_venta; 
		$subtotal                     = $total_precio_venta - $vlr_cancelado; 
		$abonado                      = $vlr_cancelado; 
		$hora                         = $fecha_hora;
		$mensaje                      = '';
		$vendedor                     = $cuenta;

		$agregar_reg_cuentas_cobrar = "INSERT INTO tbl15_cuentas_cobrar (cod_factura, cod_tercero, monto_deuda, subtotal, vendedor, cuenta, abonado, 
		fecha_pago, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_info_factura_venta, nombre1_tercero, mensaje)
		VALUES ('$cod_factura', '$cod_tercero', '$monto_deuda', '$subtotal', '$vendedor', '$cuenta', '$abonado', 
		'$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_info_factura_venta', '$nombre1_tercero', '$observacion_tercero')";
		$resultado_cuentas_cobrar = mysqli_query($conectar, $agregar_reg_cuentas_cobrar) or die(mysqli_error($conectar));

		$agregar_reg_cuentas_cobrar_abonos = "INSERT INTO tbl15_cuentas_cobrar_abonos (cod_tercero, cod_factura, abonado, cuenta, fecha_pago, fecha_anyo, fecha_mes, 
		anyo, fecha_invert, fecha_seg, hora, mensaje, cod_administrador, cod_tipo_forma_pago, cod_dependencia, cod_cuentas_cobrar) 
		VALUES ('$cod_tercero', '$cod_factura', '$abonado', '$cuenta_actual', '$fecha_pago_abono', '$fecha_anyo', '$fecha_mes', 
		'$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$mensaje', '$cod_administrador', '$cod_tipo_forma_pago', '$cod_dependencia', '$cod_cuentas_cobrar')";
		$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $agregar_reg_cuentas_cobrar_abonos) or die(mysqli_error($conectar));

		$agregar_regis = sprintf("UPDATE tbl15_info_factura_venta SET cod_cuentas_cobrar = '$cod_cuentas_cobrar' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
		$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
	//----------------------------------------------------------------------- ---------------------------------------------------------//
		$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
		FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0')";
		$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
		$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

		$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];

		$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0')";
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
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	if ($cod_estado_movimiento_contable_cuenta_personal_global == '1' && $cod_tipo_pago == '1' && $cod_estado_ignorar_venta == '0') {

		$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
		WHERE (nombre_modulo_puc = 'VENTAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '1')";
		$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
		$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

		$cod_puc                                               = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//1473
		$codigo_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//4205
		$nombre_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//OTRAS VENTAS
		$tipo_puc                                              = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//INGRESOS

		$nombre_tipo_documento                                 = 'RECIBO DE CAJA';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");

		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		//$cod_puc                                               = '1473';
		//$codigo_puc                                            = '4205';
		//$nombre_puc                                            = 'OTRAS VENTAS';
		//$tipo_puc                                              = 'INGRESOS';
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
		'$fecha_seg_movimiento_caja', '$fecha_ymd_movimiento_caja', '$fecha_anyo_movimiento_caja', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$cod_info_factura_venta', 
		'$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_tipo_pago')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	}

	if ($cod_sino_crear_mov_contable == '2' && $cod_estado_ignorar_venta == '0') {

		$nombre_tipo_documento                                                        = 'FACTURA DE VENTA';
		$nombre_estado_factura                                                        = 'CERRADA';
		$ip                                                                           = $_SERVER["REMOTE_ADDR"];
		$total_costo_movimiento_contable_smrt                                         = 0;
		$fecha_movimiento_contable_cuenta_personal                                    = date("Y-m-d");
		$cod_estado_automatico                                                        = "1";
		$cod_tipo_nota_observacion                                                    = 1;
		$cod_factura                                                                  = '';
		$venta_movimiento_contable                                                    = '';
		$total_venta_movimiento_contable                                              = '';

		$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
		$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
		$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

		$cod_movimiento_contable                                                      = $datos_autoincremento_egresos['AUTO_INCREMENT'];
		$cod_movimiento_contable2                                                     = $cod_movimiento_contable;

		$sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
		$consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
		$info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

		$cod_guia                                                                     = $info_guia_movimiento['cod_guia']+1;
		$descripcion_movimiento                                                       = "Recibo de caja por venta | fecha: ".$fecha_ymd_venta_producto." | vendedor: ".$cuenta.' - '.$observacion_tercero." | ID VENTA: ".$cod_info_factura_venta;
		$total_costo_movimiento_contable                                              = $total_precio_venta;

		$agreg_mov_contable_reg = "INSERT INTO tbl15_movimiento_contable (nombre_estado_factura, nombre_tipo_documento, descripcion_movimiento, total_costo_movimiento_contable, cod_tercero, fecha_anyo, 
		fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, cod_tipo_forma_pago, ip, cuenta, cod_guia, cod_tipo_nota_observacion, cod_estado_automatico, nit_cliente, nombres_clientes)
		VALUES ('$nombre_estado_factura',  '$nombre_tipo_documento', '$descripcion_movimiento', '$total_costo_movimiento_contable', '$cod_tercero', '$fecha_anyo', 
		'$fecha_ymd', '$fecha_mes', '$anyo', '$fecha_seg', '$fecha_factura', '$cod_tipo_forma_pago', '$ip', '$cuenta', '$cod_guia', '$cod_tipo_nota_observacion', '$cod_estado_automatico', '$nit_cliente', '$nombres_clientes')";
		$resultado_mov_contable = mysqli_query($conectar, $agreg_mov_contable_reg) or die(mysqli_error($conectar));
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		$sql_total_tipos_iva = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
		Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
		Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
		FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
		$consulta_total_tipos_iva = mysqli_query($conectar, $sql_total_tipos_iva) or die(mysqli_error($conectar));
		$datos_total_tipos_iva = mysqli_fetch_assoc($consulta_total_tipos_iva);

		$total_venta                                                                  = $datos_total_tipos_iva['total_venta'];
		$total_base_iva                                                               = $datos_total_tipos_iva['total_base_iva'];
		$total_iva                                                                    = $datos_total_tipos_iva['total_iva'];

	    $sql_puc_debito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc_post')";
	    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
	    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

	    $cod_puc_debito_db                                                            = $info_puc_debito['cod_puc'];
	    $codigo_puc_debito_db                                                         = $info_puc_debito['codigo_puc'];
	    $nombre_puc_debito_db                                                         = $info_puc_debito['nombre_puc'];
	    $tipo_puc_debito_db                                                           = $info_puc_debito['tipo_puc'];
	    $saldo_actual_puc_debito_db                                                   = $info_puc_debito['saldo_actual_puc'];
		$total_saldo_puc                                                              = $info_puc_debito['saldo_actual_puc'];

		$nombre_tipo_movimiento 	                                                  = 'DEBITOS';
		$cod_puc                                                                      = $cod_puc_debito_db;
		$codigo_puc                                                                   = $codigo_puc_debito_db;
		$nombre_puc                                                                   = $nombre_puc_debito_db;
		$tipo_puc                                                                     = $tipo_puc_debito_db;
		$und_vendida                                                                  = '1';
		$costo_movimiento_contable                                                    = $total_precio_venta - $total_iva;
		$total_costo_movimiento_contable                                              = $total_precio_venta - $total_iva;	

		$agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
		total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
		VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
		$resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

	    $sql_puc_debito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
	    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

	    $saldo_actual_puc_debito_db                                                   = $info_puc_debito['saldo_actual_puc'];
		$saldo_actual_puc_debito                                                      = $saldo_actual_puc_debito_db + $total_precio_venta;

		$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

		if ($total_iva <> '0') {
			$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
			WHERE (nombre_modulo_puc = 'VENTAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '2')";
			$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
			$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

			$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//1728
			$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//511570
			$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//IVA DESCONTABLE
			$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//GASTOS

			$nombre_tipo_movimiento 	                                                  = 'DEBITOS';
			//$cod_puc                                                                      = '1728';
			//$codigo_puc                                                                   = '511570';
			//$nombre_puc                                                                   = 'IVA DESCONTABLE';
			//$tipo_puc                                                                     = 'GASTOS';
			$und_vendida                                                                  = '1';
			$costo_movimiento_contable                                                    = $total_iva;
			$total_costo_movimiento_contable                                              = $total_iva;

			$agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
			total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
			VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
			$resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

		    $sql_puc_debito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $saldo_actual_puc_debito_db                                                   = $info_puc_debito['saldo_actual_puc'];
			$saldo_actual_puc_debito                                                      = $saldo_actual_puc_debito_db + $total_precio_venta;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
		WHERE (nombre_modulo_puc = 'VENTAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '1')";
		$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
		$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

		$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//1473
		$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//4205
		$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//OTRAS VENTAS
		$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//INGRESOS

		$nombre_tipo_movimiento                                                       = 'CREDITOS';
		//$cod_puc                                                                      = '1473';
		//$codigo_puc                                                                   = '4205';
		//$nombre_puc                                                                   = 'OTRAS VENTAS';
		//$tipo_puc                                                                     = 'INGRESOS';
		$und_vendida                                                                  = '1';
		$costo_movimiento_contable                                                    = $total_precio_venta;
		$total_costo_movimiento_contable                                              = $total_precio_venta;

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
		total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
		VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

		$sql_puc_credito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	    $resultado_puc_credito = mysqli_query($conectar, $sql_puc_credito);
	    $info_puc_credito = mysqli_fetch_assoc($resultado_puc_credito);

	    $saldo_actual_puc_credito_db                                                  = $info_puc_credito['saldo_actual_puc'];
		$saldo_actual_puc_credito                                                     = $saldo_actual_puc_credito_db - $total_precio_venta;

		$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_credito' WHERE cod_puc = '$cod_puc'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		$nombre_tipo_documento                                                        = 'MOVIMIENTO INTERNO';
		$nombre_estado_factura                                                        = 'CERRADA';
		$ip                                                                           = $_SERVER["REMOTE_ADDR"];
		$total_costo_movimiento_contable_smrt                                         = 0;
		$fecha_movimiento_contable_cuenta_personal                                    = date("Y-m-d");
		$cod_estado_automatico                                                        = "1";
		$cod_tipo_nota_observacion                                                    = 1;
		$cod_factura                                                                  = '';
		$venta_movimiento_contable                                                    = '';
		$total_venta_movimiento_contable                                              = '';

		$sql_autoincremento_mov_contable = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
		$exec_autoincremento_mov_contable = mysqli_query($conectar, $sql_autoincremento_mov_contable) or die(mysqli_error($conectar));
		$datos_autoincremento_mov_contable = mysqli_fetch_assoc($exec_autoincremento_mov_contable);

		$cod_movimiento_contable                                                      = $datos_autoincremento_mov_contable['AUTO_INCREMENT'];
		$cod_movimiento_contable2                                                     = $datos_autoincremento_egresos['AUTO_INCREMENT'];

		$sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
		$consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
		$info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

		$cod_guia                                                                     = $info_guia_movimiento['cod_guia']+1;
		$nombre_tipo_documento                                                        = 'MOVIMIENTO INTERNO';
		$descripcion_movimiento                                                       = "COSTOS DE VENTA - INVENT (Mov intern)| fecha: ".$fecha_ymd_venta_producto." | vendedor: ".$cuenta." | ID VENTA: ".$cod_info_factura_venta;
		$total_costo_movimiento_contable                                              = $total_precio_compra;

		$agreg_mov_contable_reg = "INSERT INTO tbl15_movimiento_contable (nombre_estado_factura, nombre_tipo_documento, descripcion_movimiento, total_costo_movimiento_contable, cod_tercero, fecha_anyo, 
		fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, cod_tipo_forma_pago, ip, cuenta, cod_guia, cod_tipo_nota_observacion, cod_estado_automatico, nit_cliente, nombres_clientes)
		VALUES ('$nombre_estado_factura',  '$nombre_tipo_documento', '$descripcion_movimiento', '$total_costo_movimiento_contable', '$cod_tercero', '$fecha_anyo', 
		'$fecha_ymd', '$fecha_mes', '$anyo', '$fecha_seg', '$fecha_factura', '$cod_tipo_forma_pago', '$ip', '$cuenta', '$cod_guia', '$cod_tipo_nota_observacion', '$cod_estado_automatico', '$nit_cliente', '$nombres_clientes')";
		$resultado_mov_contable = mysqli_query($conectar, $agreg_mov_contable_reg) or die(mysqli_error($conectar));
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
		WHERE (nombre_modulo_puc = 'VENTAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '3')";
		$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
		$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

		$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//2094
		$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//6
		$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//COSTOS DE VENTAS
		$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//COSTOS DE VENTAS

		$nombre_tipo_movimiento                                                       = 'DEBITOS';
		//$cod_puc                                                                      = '2094';
		//$codigo_puc                                                                   = '6';
		//$nombre_puc                                                                   = 'COSTOS DE VENTAS';
		//$tipo_puc                                                                     = 'COSTOS DE VENTAS';
		$und_vendida                                                                  = '1';
		$costo_movimiento_contable                                                    = $total_precio_compra;
		$total_costo_movimiento_contable                                              = $total_precio_compra;

		$agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
		total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
		VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
		$resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

	    $sql_puc_debito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
	    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

	    $saldo_actual_puc_debito_db                                                   = $info_puc_debito['saldo_actual_puc'];
		$saldo_actual_puc_debito                                                      = $saldo_actual_puc_debito_db - $total_precio_compra;

		$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
		WHERE (nombre_modulo_puc = 'VENTAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '4')";
		$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
		$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

		$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//263
		$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//14
		$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//INVENTARIOS
		$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//ACTIVO

		$nombre_tipo_movimiento                                                       = 'CREDITOS';
		//$cod_puc                                                                      = '263';
		//$codigo_puc                                                                   = '14';
		//$nombre_puc                                                                   = 'INVENTARIOS';
		//$tipo_puc                                                                     = 'ACTIVO';
		$und_vendida                                                                  = '1';
		$costo_movimiento_contable                                                    = $total_precio_compra;
		$total_costo_movimiento_contable                                              = $total_precio_compra;

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
		total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
		VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	}
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	$borrar_sql = sprintf("DELETE FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	$monto_deuda                  = $total_precio_venta; 
	$subtotal                     = $total_precio_venta - $vlr_cancelado;
	$abonado	                  = $vlr_cancelado; 

	$agregar_regis = sprintf("UPDATE tbl15_info_factura_venta SET cod_estado_factura = '$cod_estado_factura', cod_factura = '$cod_factura', fecha_anyo = '$fecha_anyo', 
	fecha_dia = '$fecha_dia',fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', total_precio_compra = '$total_precio_compra', 
	total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data', cod_tercero = '$cod_tercero', nombre_estado_factura = '$nombre_estado_factura',
	cuenta = '$cuenta', vlr_cancelado = '$vlr_cancelado', vlr_vuelto = '$vlr_vuelto', cod_tipo_pago = '$cod_tipo_pago', cod_administrador = '$cod_administrador', 
	cod_tipo_forma_pago = '$cod_tipo_forma_pago', nombre_tipo_factura = '$nombre_tipo_factura',  nombre_tipo_moneda = '$nombre_tipo_moneda', 
	nombre_maquina = '$nombre_maquina', tiempo_ejecucion = '$tiempo_ejecucion', cod_resolucion_facturacion = '$cod_resolucion_facturacion', 
	observacion_tercero = '$observacion_tercero', cod_tipo_metodo_envio = '$cod_tipo_metodo_envio', monto_deuda = '$monto_deuda', subtotal = '$subtotal', abonado = '$abonado', 
	fecha_entrega = '$fecha_entrega', descripcion_tipo_forma_pago = '$descripcion_tipo_forma_pago', fecha_pago = '$fecha_pago', 
	url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto', cod_domiciliario = '$cod_domiciliario', cod_puc = '$cod_puc', 
	cod_sino_crear_mov_contable = '$cod_sino_crear_mov_contable', fecha_venta_ymd_dian = '$fecha_venta_ymd_dian', fecha_venta_hora_dian = '$fecha_venta_hora_dian', 
	cod_puntos_redimibles_campanya = '$cod_puntos_redimibles_campanya', total_puntos_redimibles_campanya = '$total_puntos_redimibles_campanya', 
	total_valor_dinero_puntos_redimibles_campanya = '$total_valor_dinero_puntos_redimibles_campanya', 
	cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal', cod_movimiento_caja = '$cod_movimiento_caja', 
	retefuente_ptj = '$retefuente_ptj', reteica_ptj = '$reteica_ptj', reteiva_ptj = '$reteiva_ptj', 
	fecha_ini_renta_alquiler = '$fecha_ini_renta_alquiler', fecha_fin_renta_alquiler = '$fecha_fin_renta_alquiler', cod_estado_alquiler_renta = '$cod_estado_alquiler_renta', 
	cod_tipo_servicio = '$cod_tipo_servicio', cod_sesion = '$cod_sesion', cod_estado_ignorar_venta = '$cod_estado_ignorar_venta', 
	total_saldo_movimiento_contable_cuenta_personal = '$total_saldo_movimiento_contable_cuenta_personal', total_saldo_movimiento_caja_fnr = '$total_saldo_movimiento_caja_fnr', total_saldo_puc = '$total_saldo_puc'
	WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	$url_redir = $pagina_redirect_imprimir."?cod_info_factura_venta=".$cod_info_factura_venta."&cod_tipo_pago=".$cod_tipo_pago."&conexion_internet=".$conexion_internet."&condicion_producto_con_precio_venta_cero=".$condicion_producto_con_precio_venta_cero."&condicion_producto_con_unidad_venta_cero=".$condicion_producto_con_unidad_venta_cero."&pagina=".$pagina;
	//header("Location: $url_redir");
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	if ($cod_estado_enviar_factura_venta_electronica_dian_api == '1' && $nombre_tipo_factura == 'ELECTRONICA' && $conexion_internet == 'SI') { 
		$pagina_redirect_imprimir = '../admin/enviar_factura_electronica_dian_dataico_ajax.php';
		$url_redir = $pagina_redirect_imprimir."?cod_info_factura_venta=".$cod_info_factura_venta."&cod_tipo_pago=".$cod_tipo_pago."&conexion_internet=".$conexion_internet."&condicion_producto_con_precio_venta_cero=".$condicion_producto_con_precio_venta_cero."&condicion_producto_con_unidad_venta_cero=".$condicion_producto_con_unidad_venta_cero."&pagina=".$pagina;
	}
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	?>
		<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $url_redir;?>">
	<?php
	}
	//-------------------------------------- LLAVE DE CIERRE DEL CONDICIONAL VENDER POR CONTADO ------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//-------------------------------------- LLAVE DE INICIO DEL CONDICIONAL VENDER POR CREDITO ------------------------------------------//
	elseif (($vlr_cancelado == '0') && ($cod_tipo_pago == '2') && ($condicion_aplicar_retefuente)) {
	//for ($i=0; $i < $total_datos; $i++) {
	//$cod_venta_producto_temporal       = $_POST['cod_venta_producto_temporal'][$i];

		$sql_mconsulta = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto_temporal ASC";
		$mconsulta = mysqli_query($conectar, $sql_mconsulta) or die(mysqli_error($conectar));
		while ($datos_temp = mysqli_fetch_assoc($mconsulta)) {
		//$datos_temp = mysqli_fetch_assoc($mconsulta);

			$cod_venta_producto_temporal                = $datos_temp['cod_venta_producto_temporal'];
			$cod_producto                               = $datos_temp['cod_producto'];
			$cod_producto_barra                         = $datos_temp['cod_producto_barra'];
			$nombre_tipo_precio_venta                   = $datos_temp['nombre_tipo_precio_venta'];
			$cod_producto_barra_madre                   = $cod_producto_barra;

			$sqlr_consulta = "SELECT und_producto, und_producto_bodega, iva_ptj, comision_ptj, cod_dependencia, cod_opcion_descontable_inv, precio_compra_producto, precio_costo_producto, nombre_tipo_compra, iva_saludable_ptj, cod_marca
			FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
			$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
			$datos_prod = mysqli_fetch_assoc($modificar_consulta);
			//-----------------------------------------------------------------------------------------------------------------------------------------//
			//------------------------------------TIPO DE VENTA PUEDES SER MENUDIADO O POR UNIDADES----------------------------------------------------//
			$cod_producto                               = $datos_temp['cod_producto'];
			$cod_producto_barra                         = $datos_temp['cod_producto_barra'];
			$nombre_producto                            = $datos_temp['nombre_producto'];
			$und_venta                                  = $datos_temp['und_venta'];
			$nombre_tipo_compra                         = $datos_prod['nombre_tipo_compra'];
			if ($nombre_tipo_compra == '') { $nombre_tipo_compra = 'NORMAL'; } else { $nombre_tipo_compra = $datos_prod['nombre_tipo_compra']; }
			$precio_compra_producto                     = $datos_temp['precio_compra_producto'];
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

			$descuento_valor_pesos                      = $precio_venta_producto_orig - $precio_venta_producto;
			$total_puntos_redimibles_campanya_producto  = ($total_venta_producto / $valor_puntos_redimibles_campanya) * $cantidad_puntos_x_valor_redimibles_campanya;
			//$descuento_ptj                            = ($descuento_valor_pesos / $precio_venta_producto_orig) * 100;
			$iva_ptj                                    = $datos_prod['iva_ptj'];
			if ($cod_estado_dia_sin_iva_global == '1') { $iva_ptj = '0'; } else { $iva_ptj = $iva_ptj; }

			if ($nombre_tipo_cobro == 'ANUAL') { $fecha_cobro_renovacion = date('Y-m-d', strtotime($fecha_ymd_venta_producto.' +1'.' year')); } elseif ($nombre_tipo_cobro == 'MENSUAL') { $fecha_cobro_renovacion = date('Y-m-d', strtotime($fecha_ymd_venta_producto.' +1'.' month')); } else { $fecha_cobro_renovacion = ''; }

			$und_producto = $und_producto_inv - $und_venta;

			if ($cod_tipo_inventario == '1') { 
				if ($cod_opcion_descontable_inv == '0') { $und_producto = $und_producto_inv - $und_venta; } else { $und_producto = 0; }
			} elseif ($cod_tipo_inventario == '2') { 
				if ($cod_opcion_descontable_inv == '0') { $und_producto = $und_producto_bodega_inv - $und_venta; } else { $und_producto = 0; }
			} else { 
				$und_producto = $und_producto_inv - $und_venta; 
			}
		//----------------------------- INSERTAR PRODUCTOS A LAS VENTAS -----------------------------//
			$agregar_reg_venta_producto = "INSERT INTO tbl15_venta_producto (cod_info_factura_venta, cod_factura, cod_producto, cod_producto_barra, 
			nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, 
			total_venta_producto, nombre_tipo_producto, und_producto, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
			nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, nombre_tipo_presentacion,
			fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
			fecha_alerta, cod_resolucion_facturacion, iva_ptj, und_producto_inv, und_producto_bodega_inv, cod_tercero, cod_caja_virtual, 
			nombre_tipo_precio_venta, comision_ptj,cod_tipo_pago, cod_tipo_forma_pago, total_datos_data, nombre_tipo_factura, 
			nombre_tipo_moneda, vlr_cancelado, vlr_vuelto, cod_dependencia, cod_tipo_inventario, precio_venta_producto_orig, descuento_ptj, comentario_producto, 
			fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin, placa_producto, 
			cod_parqueo_cotizacion_venta_producto, cod_info_parqueo_cotizacion_factura_venta, cod_info_hotel_cotizacion_factura_venta, cod_hotel_cotizacion_venta_producto, 
			cod_opcion_descontable_inv, cod_categoria, cod_categoria_sub, cod_tipo_producto_cocina, nombre_tipo_precio, nombre_tipo_compra, cod_tipo_metodo_envio, 
			peso_producto, unidad_medida_peso, cod_estado_cava, und_caja_sobre, nombre_tipo_und_caja_sobre, cod_base_caja, cod_venta_producto_temporal, cod_estado_tipo_hotel_parqueo, 
			total_horas, total_dias, cod_tipo_cod_barra, cajas_sobre, iva_saludable_ptj, nombre_tipo_cobro, fecha_cobro_renovacion, cod_puc, 
			cod_puntos_redimibles_campanya, total_puntos_redimibles_campanya_producto, cod_marca, cupo_credito_ptj, cod_estado_ignorar_venta)
			VALUES ('$cod_info_factura_venta', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
			'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', 
			'$total_venta_producto', '$nombre_tipo_producto', '$und_producto', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
			'$nombre_tipo_unidad_medida', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_presentacion',
			'$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
			'$fecha_alerta', '$cod_resolucion_facturacion', '$iva_ptj', '$und_producto_inv', '$und_producto_bodega_inv', '$cod_tercero', '$cod_caja_virtual', 
			'$nombre_tipo_precio_venta', '$comision_ptj', '$cod_tipo_pago', '$cod_tipo_forma_pago', '$total_datos_data', '$nombre_tipo_factura', 
			'$nombre_tipo_moneda', '$vlr_cancelado', '$vlr_vuelto', '$cod_dependencia', '$cod_tipo_inventario', '$precio_venta_producto_orig', '$descuento_ptj', '$comentario_producto', 
			'$fecha_ymd_parqueo_ini', '$fecha_hora_parqueo_ini', '$fecha_ymd_parqueo_fin', '$fecha_hora_parqueo_fin', '$placa_producto', 
			'$cod_parqueo_cotizacion_venta_producto', '$cod_info_parqueo_cotizacion_factura_venta', '$cod_info_hotel_cotizacion_factura_venta', '$cod_hotel_cotizacion_venta_producto', 
			'$cod_opcion_descontable_inv', '$cod_categoria', '$cod_categoria_sub', '$cod_tipo_producto_cocina', '$nombre_tipo_precio', '$nombre_tipo_compra', '$cod_tipo_metodo_envio', 
			'$peso_producto', '$unidad_medida_peso', '$cod_estado_cava', '$und_caja_sobre', '$nombre_tipo_und_caja_sobre', '$cod_base_caja', '$cod_venta_producto_temporal', '$cod_estado_tipo_hotel_parqueo', 
			'$total_horas', '$total_dias', '$cod_tipo_cod_barra', '$cajas_sobre', '$iva_saludable_ptj', '$nombre_tipo_cobro', '$fecha_cobro_renovacion', '$cod_puc', 
			'$cod_puntos_redimibles_campanya', '$total_puntos_redimibles_campanya_producto', '$cod_marca', '$cupo_credito_ptj', '$cod_estado_ignorar_venta')";
			$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));

			$actualiza_producto = sprintf("UPDATE tbl15_producto SET $campo_und_inventario = '$und_producto', peso_producto = '$peso_producto', 
			cod_estado_habitacion_hotel = '0', cod_info_factura_venta = '0', cod_venta_producto_temporal = '0' WHERE cod_producto_barra = '$cod_producto_barra'");
			$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));

			if ($cod_estado_cava == '1') { $agregar_regis = "UPDATE tbl15_info_factura_venta SET cod_estado_cava = '$cod_estado_cava' WHERE cod_info_factura_venta = '$cod_info_factura_venta'"; $resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar)); }
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
			if ($cod_estado_subproducto_global == '1') {
				$sql_subproducto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto FROM tbl15_subproducto WHERE (cod_producto_barra_madre = '$cod_producto_barra_madre')";
				$consulta_subproducto = mysqli_query($conectar, $sql_subproducto) or die(mysqli_error($conectar));
				while ($datos_subproducto = mysqli_fetch_assoc($consulta_subproducto)) {

					$cod_producto                               = $datos_subproducto['cod_producto'];
					$cod_producto_barra                         = $datos_subproducto['cod_producto_barra'];
					$nombre_producto                            = $datos_subproducto['nombre_producto'];
					$und_venta                                  = $datos_subproducto['und_producto'] * $und_venta_ext;
					$nombre_tipo_compra                         = 'NORMAL';

					$sql_producto = "SELECT und_producto, nombre_tipo_precio_venta, iva_ptj, cod_dependencia, nombre_tipo_producto, nombre_tipo_unidad_medida, und_producto_bodega, iva_saludable_ptj
					FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
					$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
					$datos_producto = mysqli_fetch_assoc($consulta_producto);

					$und_producto_inv                           = $datos_producto['und_producto'];
					$nombre_tipo_precio_venta                   = $datos_producto['nombre_tipo_precio_venta'];
					$nombre_tipo_producto                       = $datos_producto['nombre_tipo_producto'];
					$cod_dependencia                            = $datos_producto['cod_dependencia'];
					$nombre_tipo_unidad_medida                  = $datos_producto['nombre_tipo_unidad_medida'];
					$und_producto_bodega_inv                    = $datos_producto['und_producto_bodega'];
					$iva_saludable_ptj                          = $datos_producto['iva_saludable_ptj'];
					$iva_ptj                                    = $datos_producto['iva_ptj'];
					if ($cod_estado_dia_sin_iva_global == '1') { $iva_ptj = '0'; } else { $iva_ptj = $iva_ptj; }
					if ($cod_estado_venta_dependencia_de_usuario_global == '1') { $cod_dependencia = $cod_dependencia_user; } else { $cod_dependencia = $datos_prod['cod_dependencia']; }

					$agregar_reg_venta_producto_sub = "INSERT INTO tbl15_venta_producto_sub (cod_info_factura_venta, cod_producto_barra_madre, cod_factura, cod_producto, cod_producto_barra, 
					nombre_producto, und_venta, nombre_tipo_producto, und_producto, und_producto_bodega_inv, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
					nombre_tipo_unidad_medida, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
					cod_resolucion_facturacion, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, 
					cod_tipo_pago, cod_tipo_forma_pago, total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, vlr_cancelado, vlr_vuelto, cod_dependencia, 
					nombre_tipo_compra, cod_tipo_metodo_envio, peso_producto, unidad_medida_peso, cod_base_caja, iva_saludable_ptj)
					VALUES ('$cod_info_factura_venta', '$cod_producto_barra_madre', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
					'$nombre_producto', '$und_venta', '$nombre_tipo_producto', '$und_producto_inv',  '$und_producto_bodega_inv', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
					'$nombre_tipo_unidad_medida', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
					'$cod_resolucion_facturacion', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', 
					'$cod_tipo_pago', '$cod_tipo_forma_pago', '$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$vlr_cancelado', '$vlr_vuelto', '$cod_dependencia', 
					'$nombre_tipo_compra', '$cod_tipo_metodo_envio', '$peso_producto', '$unidad_medida_peso', '$cod_base_caja', '$iva_saludable_ptj')";
					$resultado_venta_producto_sub = mysqli_query($conectar, $agregar_reg_venta_producto_sub) or die(mysqli_error($conectar));
	/*
					$agregar_reg_venta_producto = "INSERT INTO tbl15_venta_producto (cod_info_factura_venta, cod_producto_barra_madre, cod_factura, cod_producto, cod_producto_barra, 
					nombre_producto, und_venta, nombre_tipo_producto, und_producto, und_producto_bodega_inv, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
					nombre_tipo_unidad_medida, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
					cod_resolucion_facturacion, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, 
					cod_tipo_pago, cod_tipo_forma_pago, total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, vlr_cancelado, vlr_vuelto, cod_dependencia, 
					nombre_tipo_compra, cod_tipo_metodo_envio, peso_producto, unidad_medida_peso, cod_base_caja, iva_saludable_ptj)
					VALUES ('$cod_info_factura_venta', '$cod_producto_barra_madre', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
					'$nombre_producto', '$und_venta', '$nombre_tipo_producto', '$und_producto_inv',  '$und_producto_bodega_inv', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
					'$nombre_tipo_unidad_medida', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
					'$cod_resolucion_facturacion', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', 
					'$cod_tipo_pago', '$cod_tipo_forma_pago', '$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$vlr_cancelado', '$vlr_vuelto', '$cod_dependencia', 
					'$nombre_tipo_compra', '$cod_tipo_metodo_envio', '$peso_producto', '$unidad_medida_peso', '$cod_base_caja', '$iva_saludable_ptj')";
					$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));
	*/
					$und_producto                      = $und_producto_inv - $und_venta;

					$actualiza_producto = sprintf("UPDATE tbl15_producto SET $campo_und_inventario = '$und_producto', peso_producto = '$peso_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
					$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));
					//----------------------------------------------------------------------- ---------------------------------------------------------//
					$sql_eliminar_parqueo_ingreso = ("DELETE FROM tbl15_parqueo_cotizacion_venta_producto WHERE (cod_parqueo_cotizacion_venta_producto = '$cod_parqueo_cotizacion_venta_producto')");
					$exec_parqueo_ingreso = mysqli_query($conectar, $sql_eliminar_parqueo_ingreso) or die(mysqli_error($conectar));
					//----------------------------------------------------------------------- ---------------------------------------------------------//
					$sql_eliminar_info_parqueo_ingreso = ("DELETE FROM tbl15_info_parqueo_cotizacion_factura_venta WHERE (cod_info_parqueo_cotizacion_factura_venta = '$cod_info_parqueo_cotizacion_factura_venta')");
					$exec_info_parqueo_ingreso = mysqli_query($conectar, $sql_eliminar_info_parqueo_ingreso) or die(mysqli_error($conectar));
					//----------------------------------------------------------------------- ---------------------------------------------------------//
					$sql_eliminar_hotel_ingreso = ("DELETE FROM tbl15_hotel_cotizacion_venta_producto WHERE (cod_hotel_cotizacion_venta_producto = '$cod_hotel_cotizacion_venta_producto')");
					$exec_parqueo_hotel_ingreso = mysqli_query($conectar, $sql_eliminar_hotel_ingreso) or die(mysqli_error($conectar));
					//----------------------------------------------------------------------- ---------------------------------------------------------//
					$sql_eliminar_info_hotel_ingreso = sprintf("DELETE FROM tbl15_info_hotel_cotizacion_factura_venta WHERE (cod_info_hotel_cotizacion_factura_venta = '$cod_info_hotel_cotizacion_factura_venta')");
					$exec_info_hotel_ingreso = mysqli_query($conectar, $sql_eliminar_info_hotel_ingreso) or die(mysqli_error($conectar));
				}
			}
		}
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
		$monto_deuda                                = $total_venta_temp_aplic_rete;
		$subtotal                                   = $monto_deuda;
		//$fecha_pago                                 = $fecha_anyo;
		$fecha                                      = $fecha_anyo;
		$fecha_mes                                  = date("Y-m", strtotime($fecha_anyo));
		$anyo                                       = date("Y", strtotime($fecha_anyo));
		$fecha_invert                               = $fecha_anyo;
		$fecha_seg                                  = strtotime($fecha_anyo);
		$vendedor                                   = $cuenta;
		$total_utilidad_bruta                       = $total_venta_temp_aplic_rete - $total_compra_temp_aplic_rete;

		$sql_autoincremento_cuentas_cobrar = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_cobrar'";
		$exec_autoincremento_cuentas_cobrar = mysqli_query($conectar, $sql_autoincremento_cuentas_cobrar) or die(mysqli_error($conectar));
		$datos_autoincremento_cuentas_cobrar = mysqli_fetch_assoc($exec_autoincremento_cuentas_cobrar);

		$cod_cuentas_cobrar                         = $datos_autoincremento_cuentas_cobrar['AUTO_INCREMENT'];

		$agregar_reg_cuentas_cobrar = "INSERT INTO tbl15_cuentas_cobrar (cod_factura, cod_tercero, monto_deuda, subtotal, vendedor, cuenta, 
		fecha_pago, fecha, fecha_mes, anyo, fecha_invert, fecha_seg, cod_info_factura_venta, nombre1_tercero, mensaje, total_precio_compra, total_precio_venta, total_utilidad_bruta)
		VALUES ('$cod_factura', '$cod_tercero', '$monto_deuda', '$subtotal', '$vendedor', '$cuenta', 
		'$fecha_pago', '$fecha', '$fecha_mes', '$anyo', '$fecha_invert', '$fecha_seg', '$cod_info_factura_venta', '$nombre1_tercero', '$observacion_tercero', '$total_precio_compra', '$total_precio_venta', '$total_utilidad_bruta')";
		$resultado_cuentas_cobrar = mysqli_query($conectar, $agregar_reg_cuentas_cobrar) or die(mysqli_error($conectar));
	/*
		$agregar_reg_cuentas_cobrar_abonos = "INSERT INTO tbl15_cuentas_cobrar_abonos (cod_tercero, cod_factura, abonado, cuenta, fecha_pago, fecha_anyo, fecha_mes, 
		anyo, fecha_invert, fecha_seg, hora, mensaje, cod_administrador, cod_tipo_forma_pago, cod_dependencia, cod_cuentas_cobrar) 
		VALUES ('$cod_tercero', '$cod_factura', '$abonado', '$cuenta_actual', '$fecha_pago_abono', '$fecha_anyo', '$fecha_mes', 
		'$anyo', '$fecha_invert', '$fecha_seg', '$hora', '$mensaje', '$cod_administrador', '$cod_tipo_forma_pago', '$cod_dependencia', '$cod_cuentas_cobrar')";
		$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $agregar_reg_cuentas_cobrar_abonos) or die(mysqli_error($conectar));
	*/
		$agregar_regis = sprintf("UPDATE tbl15_info_factura_venta SET cod_cuentas_cobrar = '$cod_cuentas_cobrar' WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
		$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
		//----------------------------------------------------------------------- ---------------------------------------------------------//   
		$sql_datos_cuenta_cobrar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_cobrar, SUM(subtotal) AS total_subtotal_cuenta_cobrar, SUM(abonado) AS total_abonado_cuenta_cobrar 
		FROM tbl15_cuentas_cobrar WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0')";
		$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $sql_datos_cuenta_cobrar);
		$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

		$total_monto_deuda_cuenta_cobrar       = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];

		$sql_datos_cuentas_cobrar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero') AND (cod_estado_archivado = '0')";
		$consulta_datos_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_datos_cuentas_cobrar_abonos);
		$datos_cuentas_cobrar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_cobrar_abonos);

		$total_abonado_cuenta_cobrar           = $datos_cuentas_cobrar_abonos['total_abonado_cuenta_cobrar'];
		$total_subtotal_cuenta_cobrar          = $total_monto_deuda_cuenta_cobrar - $total_abonado_cuenta_cobrar;

		$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_cobrar = '$cod_estado_cuenta_cobrar', total_monto_deuda_cuenta_cobrar = '$total_monto_deuda_cuenta_cobrar', 
		total_subtotal_cuenta_cobrar = '$total_subtotal_cuenta_cobrar', total_abonado_cuenta_cobrar = '$total_abonado_cuenta_cobrar', fecha_modificacion_cuenta_cobrar = '$fecha_modificacion_cuenta_cobrar' 
		WHERE (cod_tercero = '$cod_tercero')");
		$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		if ($cod_sino_crear_mov_contable == '2' && $cod_estado_ignorar_venta == '0') {

    		$nombre_tipo_documento                                                        = 'MOVIMIENTO INTERNO';
			$nombre_estado_factura                                                        = 'CERRADA';
			$ip                                                                           = $_SERVER["REMOTE_ADDR"];
			$total_costo_movimiento_contable_smrt                                         = 0;
			$fecha_movimiento_contable_cuenta_personal                                    = date("Y-m-d");
			$cod_estado_automatico                                                        = "1";
			$cod_tipo_nota_observacion                                                    = 1;
			$cod_factura                                                                  = '';
			$venta_movimiento_contable                                                    = '';
			$total_venta_movimiento_contable                                              = '';

			$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
			$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
			$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

			$cod_movimiento_contable                                                      = $datos_autoincremento_egresos['AUTO_INCREMENT'];
			$cod_movimiento_contable2                                                     = $cod_movimiento_contable;

			$sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
			$consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
			$info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

			$cod_guia                                                                     = $info_guia_movimiento['cod_guia']+1;
			$nombre_tipo_documento                                                        = 'MOVIMIENTO INTERNO';
			$descripcion_movimiento                                                       = "COSTOS DE VENTA - INVENT (Mov intern)| fecha: ".$fecha_ymd_venta_producto." | vendedor: ".$cuenta." | ID VENTA: ".$cod_info_factura_venta;
			$total_costo_movimiento_contable                                              = $total_precio_compra;

			$agreg_mov_contable_reg = "INSERT INTO tbl15_movimiento_contable (nombre_estado_factura, nombre_tipo_documento, descripcion_movimiento, total_costo_movimiento_contable, cod_tercero, fecha_anyo, 
			fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, cod_tipo_forma_pago, ip, cuenta, cod_guia, cod_tipo_nota_observacion, cod_estado_automatico, nit_cliente, nombres_clientes)
			VALUES ('$nombre_estado_factura',  '$nombre_tipo_documento', '$descripcion_movimiento', '$total_costo_movimiento_contable', '$cod_tercero', '$fecha_anyo', 
			'$fecha_ymd', '$fecha_mes', '$anyo', '$fecha_seg', '$fecha_factura', '$cod_tipo_forma_pago', '$ip', '$cuenta', '$cod_guia', '$cod_tipo_nota_observacion', '$cod_estado_automatico', '$nit_cliente', '$nombres_clientes')";
			$resultado_mov_contable = mysqli_query($conectar, $agreg_mov_contable_reg) or die(mysqli_error($conectar));
		//----------------------------------------------------------------------- ---------------------------------------------------------//
			$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
			WHERE (nombre_modulo_puc = 'VENTAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '4')";
			$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
			$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

			$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//263
			$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//14
			$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//INVENTARIOS
			$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//ACTIVO

			$nombre_tipo_movimiento                                                       = 'DEBITOS';
			//$cod_puc                                                                      = '263';
			//$codigo_puc                                                                   = '14';
			//$nombre_puc                                                                   = 'INVENTARIOS';
			//$tipo_puc                                                                     = 'ACTIVO';
			$und_vendida                                                                  = '1';
			$costo_movimiento_contable                                                    = $total_precio_compra;
			$total_costo_movimiento_contable                                              = $total_precio_compra;

			$agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
			total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
			VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
			$resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

		    $sql_puc_debito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $saldo_actual_puc_debito_db                                                   = $info_puc_debito['saldo_actual_puc'];
			$saldo_actual_puc_debito                                                      = $saldo_actual_puc_debito_db - $total_precio_compra;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		//----------------------------------------------------------------------- ---------------------------------------------------------//
			$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
			WHERE (nombre_modulo_puc = 'VENTAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '3')";
			$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
			$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

			$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//2094
			$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//6
			$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//COSTOS DE VENTAS
			$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//COSTOS DE VENTAS

			$nombre_tipo_movimiento                                                       = 'CREDITOS';
			//$cod_puc                                                                      = '2094';
			//$codigo_puc                                                                   = '6';
			//$nombre_puc                                                                   = 'COSTOS DE VENTAS';
			//$tipo_puc                                                                     = 'COSTOS DE VENTAS';
			$und_vendida                                                                  = '1';
			$costo_movimiento_contable                                                    = $total_precio_compra;
			$total_costo_movimiento_contable                                              = $total_precio_compra;

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
			total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
			VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$sql_puc_credito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_credito = mysqli_query($conectar, $sql_puc_credito);
		    $info_puc_credito = mysqli_fetch_assoc($resultado_puc_credito);

		    $saldo_actual_puc_credito_db                                                  = $info_puc_credito['saldo_actual_puc'];
			$saldo_actual_puc_credito                                                     = $saldo_actual_puc_credito_db + $total_precio_compra;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_credito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
			//----------------------------------------------------------------------- ---------------------------------------------------------//
			//----------------------------------------------------------------------- ---------------------------------------------------------//
	   		$nombre_tipo_documento                                                        = 'MOVIMIENTO INTERNO';
			$nombre_estado_factura                                                        = 'CERRADA';
			$ip                                                                           = $_SERVER["REMOTE_ADDR"];
			$total_costo_movimiento_contable_smrt                                         = 0;
			$fecha_movimiento_contable_cuenta_personal                                    = date("Y-m-d");
			$cod_estado_automatico                                                        = "1";
			$costo_movimiento_contable                                                    = $total_precio_venta;
			$total_costo_movimiento_contable                                              = $total_precio_venta;
			
			$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
			$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
			$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

			$cod_movimiento_contable                                                      = $datos_autoincremento_egresos['AUTO_INCREMENT'];
			//$cod_movimiento_contable2                                                     = $cod_movimiento_contable;

			$sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
			$consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
			$info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

			$cod_guia                                                                     = $info_guia_movimiento['cod_guia']+1;
			$nombre_tipo_documento                                                        = 'MOVIMIENTO INTERNO';
			$descripcion_movimiento                                                       = "Movimiento interno venta credito cuenta por cobrar| fecha: ".$fecha_ymd_venta_producto." | vendedor: ".$cuenta." | ID VENTA: ".$cod_info_factura_venta;

			$agreg_mov_contable_reg = "INSERT INTO tbl15_movimiento_contable (nombre_estado_factura, nombre_tipo_documento, descripcion_movimiento, total_costo_movimiento_contable, cod_tercero, fecha_anyo, 
			fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, cod_tipo_forma_pago, ip, cuenta, cod_guia, cod_tipo_nota_observacion, cod_estado_automatico, nit_cliente, nombres_clientes)
			VALUES ('$nombre_estado_factura',  '$nombre_tipo_documento', '$descripcion_movimiento', '$total_costo_movimiento_contable', '$cod_tercero', '$fecha_anyo', 
			'$fecha_ymd', '$fecha_mes', '$anyo', '$fecha_seg', '$fecha_factura', '$cod_tipo_forma_pago', '$ip', '$cuenta', '$cod_guia', '$cod_tipo_nota_observacion', '$cod_estado_automatico', '$nit_cliente', '$nombres_clientes')";
			$resultado_mov_contable = mysqli_query($conectar, $agreg_mov_contable_reg) or die(mysqli_error($conectar));
			//----------------------------------------------------------------------- ---------------------------------------------------------//
			$sql_total_tipos_iva = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
			Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As total_base_iva, 
			Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva 
			FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
			$consulta_total_tipos_iva = mysqli_query($conectar, $sql_total_tipos_iva) or die(mysqli_error($conectar));
			$datos_total_tipos_iva = mysqli_fetch_assoc($consulta_total_tipos_iva);

			$total_venta                                                                  = $datos_total_tipos_iva['total_venta'];
			$total_base_iva                                                               = $datos_total_tipos_iva['total_base_iva'];
			$total_iva                                                                    = $datos_total_tipos_iva['total_iva'];

		    $sql_puc_debito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc_post')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $cod_puc_debito_db                                                            = $info_puc_debito['cod_puc'];
		    $codigo_puc_debito_db                                                         = $info_puc_debito['codigo_puc'];
		    $nombre_puc_debito_db                                                         = $info_puc_debito['nombre_puc'];
		    $tipo_puc_debito_db                                                           = $info_puc_debito['tipo_puc'];
		    $saldo_actual_puc_debito_db                                                   = $info_puc_debito['saldo_actual_puc'];
			$total_saldo_puc                                                              = $info_puc_debito['saldo_actual_puc'];

			$nombre_tipo_movimiento 	                                                  = 'DEBITOS';
			$cod_puc                                                                      = $cod_puc_debito_db;
			$codigo_puc                                                                   = $codigo_puc_debito_db;
			$nombre_puc                                                                   = $nombre_puc_debito_db;
			$tipo_puc                                                                     = $tipo_puc_debito_db;
			$und_vendida                                                                  = '1';
			$costo_movimiento_contable                                                    = $total_precio_venta - $total_iva;
			$total_costo_movimiento_contable                                              = $total_precio_venta - $total_iva;

			$agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
			total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
			VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
			$resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

		    $sql_puc_debito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $saldo_actual_puc_debito_db                                                   = $info_puc_debito['saldo_actual_puc'];
			$saldo_actual_puc_debito                                                      = $saldo_actual_puc_debito_db + $total_precio_compra;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

			if ($total_iva <> '0') {

				$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
				WHERE (nombre_modulo_puc = 'VENTAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '2')";
				$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
				$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

				$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//1728
				$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//511570
				$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//IVA DESCONTABLE
				$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//GASTOS

				$nombre_tipo_movimiento 	                                                  = 'DEBITOS';
				//$cod_puc                                                                      = '1728';
				//$codigo_puc                                                                   = '511570';
				//$nombre_puc                                                                   = 'IVA DESCONTABLE';
				//$tipo_puc                                                                     = 'GASTOS';
				$und_vendida                                                                  = '1';
				$costo_movimiento_contable                                                    = $total_iva;
				$total_costo_movimiento_contable                                              = $total_iva;

				$agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
				total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
				VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
				'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
				$resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

			    $sql_puc_debito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
			    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
			    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

			    $saldo_actual_puc_debito_db                                                   = $info_puc_debito['saldo_actual_puc'];
				$saldo_actual_puc_debito                                                      = $saldo_actual_puc_debito_db + $total_precio_venta;

				$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
				$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
			}
			//----------------------------------------------------------------------- ---------------------------------------------------------//
			$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
			WHERE (nombre_modulo_puc = 'VENTAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '1')";
			$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
			$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

			$cod_puc                                                                      = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//1473
			$codigo_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//4205
			$nombre_puc                                                                   = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//OTRAS VENTAS
			$tipo_puc                                                                     = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//INGRESOS

			$nombre_tipo_movimiento                                                       = 'CREDITOS';
			//$cod_puc                                                                      = '1473';
			//$codigo_puc                                                                   = '4205';
			//$nombre_puc                                                                   = 'OTRAS VENTAS';
			//$tipo_puc                                                                     = 'INGRESOS';
			$und_vendida                                                                  = '1';
			$costo_movimiento_contable                                                    = $total_precio_venta;
			$total_costo_movimiento_contable                                              = $total_precio_venta;

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
			total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
			VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$sql_puc_credito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_credito = mysqli_query($conectar, $sql_puc_credito);
		    $info_puc_credito = mysqli_fetch_assoc($resultado_puc_credito);

		    $saldo_actual_puc_credito_db                                                  = $info_puc_credito['saldo_actual_puc'];
			$saldo_actual_puc_credito                                                     = $saldo_actual_puc_credito_db - $total_precio_compra;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_credito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		$borrar_sql = sprintf("DELETE FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
		$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		//----------------------------------------------------------------------- ---------------------------------------------------------//   
		$agregar_regis = sprintf("UPDATE tbl15_info_factura_venta SET cod_estado_factura = '$cod_estado_factura', cod_factura = '$cod_factura', fecha_anyo = '$fecha_anyo', 
		fecha_dia = '$fecha_dia',fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', total_precio_compra = '$total_precio_compra', 
		total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data', cod_tercero = '$cod_tercero', nombre_estado_factura = '$nombre_estado_factura',
		cuenta = '$cuenta', vlr_cancelado = '$vlr_cancelado', vlr_vuelto = '$vlr_vuelto', cod_tipo_pago = '$cod_tipo_pago', cod_administrador = '$cod_administrador', 
		cod_tipo_forma_pago = '$cod_tipo_forma_pago', nombre_tipo_factura = '$nombre_tipo_factura',  nombre_tipo_moneda = '$nombre_tipo_moneda', 
		nombre_maquina = '$nombre_maquina', tiempo_ejecucion = '$tiempo_ejecucion', cod_resolucion_facturacion = '$cod_resolucion_facturacion', 
		observacion_tercero = '$observacion_tercero', cod_tipo_metodo_envio = '$cod_tipo_metodo_envio', monto_deuda = '$monto_deuda', subtotal = '$subtotal', 
		cod_cuentas_cobrar = '$cod_cuentas_cobrar', fecha_entrega = '$fecha_entrega', descripcion_tipo_forma_pago = '$descripcion_tipo_forma_pago', fecha_pago = '$fecha_pago', 
		url_img_orig_producto = '$url_img_orig_producto', url_img_min_producto = '$url_img_min_producto', cod_domiciliario = '$cod_domiciliario', cod_puc = '$cod_puc', 
		cod_sino_crear_mov_contable = '$cod_sino_crear_mov_contable', fecha_venta_ymd_dian = '$fecha_venta_ymd_dian', fecha_venta_hora_dian = '$fecha_venta_hora_dian', 
		cod_puntos_redimibles_campanya = '$cod_puntos_redimibles_campanya', total_puntos_redimibles_campanya = '$total_puntos_redimibles_campanya', 
		cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal', cod_movimiento_caja = '$cod_movimiento_caja', 
		retefuente_ptj = '$retefuente_ptj' , reteica_ptj = '$reteica_ptj' , reteiva_ptj = '$reteiva_ptj', 
		fecha_ini_renta_alquiler = '$fecha_ini_renta_alquiler', fecha_fin_renta_alquiler = '$fecha_fin_renta_alquiler', cod_estado_alquiler_renta = '$cod_estado_alquiler_renta', 
		cod_tipo_servicio = '$cod_tipo_servicio', cod_sesion = '$cod_sesion', cod_estado_ignorar_venta = '$cod_estado_ignorar_venta', 
		total_saldo_movimiento_contable_cuenta_personal = '$total_saldo_movimiento_contable_cuenta_personal', total_saldo_movimiento_caja_fnr = '$total_saldo_movimiento_caja_fnr', total_saldo_puc = '$total_saldo_puc'
		WHERE cod_info_factura_venta = '$cod_info_factura_venta'");
		$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		//----------------------------------------------------------------------- ---------------------------------------------------------//
		$url_redir = $pagina_redirect_imprimir."?cod_info_factura_venta=".$cod_info_factura_venta."&cod_tipo_pago=".$cod_tipo_pago."&conexion_internet=".$conexion_internet."&condicion_producto_con_precio_venta_cero=".$condicion_producto_con_precio_venta_cero."&condicion_producto_con_unidad_venta_cero=".$condicion_producto_con_unidad_venta_cero."&pagina=".$pagina;
		//header("Location: $url_redir");
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	if ($cod_estado_enviar_factura_venta_electronica_dian_api == '1' && $nombre_tipo_factura == 'ELECTRONICA' && $conexion_internet == 'SI') { 
		$pagina_redirect_imprimir = '../admin/enviar_factura_electronica_dian_dataico_ajax.php';
		$url_redir = $pagina_redirect_imprimir."?cod_info_factura_venta=".$cod_info_factura_venta."&cod_tipo_pago=".$cod_tipo_pago."&conexion_internet=".$conexion_internet."&condicion_producto_con_precio_venta_cero=".$condicion_producto_con_precio_venta_cero."&condicion_producto_con_unidad_venta_cero=".$condicion_producto_con_unidad_venta_cero."&pagina=".$pagina;
	}
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	?>
		<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $url_redir;?>">
	<?php
	}
	//-------------------------------------- LLAVE DE CIERRE CONDICIONAL VENDER POR CREDITO ------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------- SI EL VALOR CANCELADO ES MENOR QUE EL TOTAL MOSTRAR ERROR -----------------------------//
	elseif ((intval($total_precio_venta) > intval($vlr_cancelado)) && ($cod_tipo_pago == '1')) { 
		$url_redir = "../admin/venta_productos_valor_cancelado_menor_venta_total.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_tipo_pago=".$cod_tipo_pago."&total_precio_venta=".$total_precio_venta."&vlr_cancelado=".$vlr_cancelado."&conexion_internet=".$conexion_internet."&condicion_producto_con_precio_venta_cero=".$condicion_producto_con_precio_venta_cero."&condicion_producto_con_unidad_venta_cero=".$condicion_producto_con_unidad_venta_cero."&pagina=".$pagina;
		//header("Location: $url_redir");
	?>
		<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $url_redir;?>">
	<?php
	}
	elseif ($condicion_producto_con_precio_venta_cero == false) { 
		$url_redir = "../admin/venta_productos_con_precio_venta_cero.php?cod_info_factura_venta=".$cod_info_factura_venta."&cuenta=".$cuenta_vendedor."&cod_caja_virtual=".$cod_caja_virtual_vendedor."&modo_venta_por_defecto=".$modo_venta_por_defecto."&cod_tipo_pago=".$cod_tipo_pago."&total_precio_venta=".$total_precio_venta."&vlr_cancelado=".$vlr_cancelado."&conexion_internet=".$conexion_internet."&condicion_producto_con_precio_venta_cero=".$condicion_producto_con_precio_venta_cero."&condicion_producto_con_unidad_venta_cero=".$condicion_producto_con_unidad_venta_cero."&pagina=".$pagina;
		//header("Location: $url_redir");
	?>
		<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $url_redir;?>">
	<?php
	}

	elseif ($condicion_producto_con_unidad_venta_cero == false) { 
		$url_redir = "../admin/alerta_venta_productos_con_unidades_venta_en_cero.php?cod_info_factura_venta=".$cod_info_factura_venta."&cuenta=".$cuenta_vendedor."&cod_caja_virtual=".$cod_caja_virtual_vendedor."&modo_venta_por_defecto=".$modo_venta_por_defecto."&cod_tipo_pago=".$cod_tipo_pago."&total_precio_venta=".$total_precio_venta."&vlr_cancelado=".$vlr_cancelado."&conexion_internet=".$conexion_internet."&condicion_producto_con_precio_venta_cero=".$condicion_producto_con_precio_venta_cero."&condicion_producto_con_unidad_venta_cero=".$condicion_producto_con_unidad_venta_cero."&pagina=".$pagina;
		//header("Location: $url_redir");
	?>
		<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $url_redir;?>">
	<?php
	}

	elseif ($condicion_aplicar_retefuente == false) { 
		$url_redir = "../admin/alerta_venta_productos_aplicar_retefuente.php?cod_info_factura_venta=".$cod_info_factura_venta."&cuenta=".$cuenta_vendedor."&cod_caja_virtual=".$cod_caja_virtual_vendedor."&modo_venta_por_defecto=".$modo_venta_por_defecto."&cod_tipo_pago=".$cod_tipo_pago."&total_precio_venta=".$total_precio_venta."&vlr_cancelado=".$vlr_cancelado."&conexion_internet=".$conexion_internet."&condicion_aplicar_retefuente=".$condicion_aplicar_retefuente."&pagina=".$pagina;
		//header("Location: $url_redir");
	?>
		<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $url_redir;?>">
	<?php
	}

	elseif ($vlr_cancelado > 99999999) { 
		$url_redir = "../admin/venta_productos_valor_cancelado_demasiado_grande.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_tipo_pago=".$cod_tipo_pago."&total_precio_venta=".$total_precio_venta."&vlr_cancelado=".$vlr_cancelado."&conexion_internet=".$conexion_internet."&condicion_producto_con_precio_venta_cero=".$condicion_producto_con_precio_venta_cero."&condicion_producto_con_unidad_venta_cero=".$condicion_producto_con_unidad_venta_cero."&pagina=".$pagina;
		//header("Location: $url_redir");
	?>
		<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $url_redir;?>">
	<?php
	}
	elseif (($vlr_cancelado <> '0') && ($cod_tipo_pago == '2')) {
		$url_redir = "../admin/venta_productos_credito_valor_no_cero.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_tipo_pago=".$cod_tipo_pago."&total_precio_venta=".$total_precio_venta."&vlr_cancelado=".$vlr_cancelado."&conexion_internet=".$conexion_internet."&condicion_producto_con_precio_venta_cero=".$condicion_producto_con_precio_venta_cero."&condicion_producto_con_unidad_venta_cero=".$condicion_producto_con_unidad_venta_cero."&pagina=".$pagina;
		//header("Location: $url_redir");
	?>
		<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=<?php echo $url_redir;?>">
	<?php
	}
	else { 
	//$url_redir = "../admin/venta_productos_valor_cancelado_demasiado_grande.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_tipo_pago=".$cod_tipo_pago."&total_precio_venta=".$total_precio_venta."&vlr_cancelado=".$vlr_cancelado."&conexion_internet=".$conexion_internet."&condicion_producto_con_precio_venta_cero=".$condicion_producto_con_precio_venta_cero."&condicion_producto_con_unidad_venta_cero=".$condicion_producto_con_unidad_venta_cero."&pagina=".$pagina;
	//header("Location: $url_redir");
	}

}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
?>