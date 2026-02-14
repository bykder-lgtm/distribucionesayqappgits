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
$cuenta_actual                           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                  = $_SESSION['usuario'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT cod_estado_generar_movimiento_contable_automatico_global, cod_estado_promediar_precio_compra_y_venta_cargar_factura_global, 
cod_estado_enviar_factura_documento_soporte_dian_api_global, cod_estado_movimiento_contable_cuenta_personal_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_generar_movimiento_contable_automatico_global         = $info_empresa_data['cod_estado_generar_movimiento_contable_automatico_global'];
$cod_estado_promediar_precio_compra_y_venta_cargar_factura_global = $info_empresa_data['cod_estado_promediar_precio_compra_y_venta_cargar_factura_global'];
$cod_estado_enviar_factura_documento_soporte_dian_api_global      = $info_empresa_data['cod_estado_enviar_factura_documento_soporte_dian_api_global'];
$cod_estado_movimiento_contable_cuenta_personal_global            = $info_empresa_data['cod_estado_movimiento_contable_cuenta_personal_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_info_factura_compra                                          = intval($_POST['cod_info_factura_compra']);
$fecha_anyo                                                       = addslashes($_POST['fecha_anyo']);
$cod_tercero                                                      = intval($_POST['cod_tercero']);
$nombre_rete_fuente_ptj                                           = addslashes($_POST['nombre_rete_fuente_ptj']);
$ret_ica_ptj                                                      = addslashes($_POST['ret_ica_ptj']);
$subtotal                                                         = addslashes($_POST['subtotal']);
$total_valor_iva                                                  = addslashes($_POST['valor_iva']);
$total_descuento                                                  = addslashes($_POST['total_descuento']);
$total_precio_ipc                                                 = addslashes($_POST['total_precio_ipc']);
$total_compra_imp                                                 = addslashes($_POST['total_compra_imp']);
$total_rete_fuente                                                = addslashes($_POST['total_rete_fuente']);
$total_ret_ica                                                    = addslashes($_POST['total_ret_ica']);
$total_factura_compra_retefuente                                  = addslashes($_POST['total_factura_compra_retefuente']);
$cod_tipo_forma_pago                                              = intval($_POST['cod_tipo_forma_pago']);
$cod_tipo_pago                                                    = intval($_POST['cod_tipo_pago']);
$cod_administrador                                                = intval($_POST['cod_administrador']);
$cod_factura                                                      = addslashes($_POST['cod_factura']);
$total_datos                                                      = intval($_POST['total_datos']);
$vlr_cancelado                                                    = 0;
$pagina                                                           = addslashes($_POST['pagina']);
$fecha_anyo_seg                                                   = strtotime($fecha_anyo);
$total_datos_data                                                 = $total_datos;
$nombre_estado_factura                                            = 'CERRADA';
$nombre_maquina                                                   = gethostname();
$fecha_ult_compra                                                 = date("Y-m-d");
$total                                                            = $total_factura_compra_retefuente;
$subtotal_total_precio_compra                                     = $subtotal;
$subtotal_total_precio_costo                                      = $subtotal;
$total_factura_compra                                             = $total_factura_compra_retefuente;
$fecha_compra                                                     = $fecha_anyo;
$fecha_seg	                                                      = time();
$comentario                                                       = '';
$venta_movimiento_contable                                        = '0';
$total_venta_movimiento_contable                                  = '0';
$cod_cuentas_pagar                                                = '0';
$conexion_internet                                                = 'NO';
$cod_estado_cuenta_pagar                                          = 1;
$fecha_modificacion_cuenta_pagar                                  = date("Y-m-d H:i:s");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_tipo_inventario'])) { $cod_tipo_inventario = intval($_POST['cod_tipo_inventario']); } else { $cod_tipo_inventario = '1'; }
if (isset($_POST['cod_tipo_producto_consumo'])) { $cod_tipo_producto_consumo = intval($_POST['cod_tipo_producto_consumo']); } else { $cod_tipo_producto_consumo = '1'; }
if (isset($_POST['nombre_tipo_compra'])) { $nombre_tipo_compra = addslashes($_POST['nombre_tipo_compra']); } else { $nombre_tipo_compra = 'NORMAL'; }
if (isset($_POST['nombre_tipo_moneda'])) { $nombre_tipo_moneda = addslashes($_POST['nombre_tipo_moneda']); } else { $nombre_tipo_moneda = 'COP'; }
if (isset($_POST['nombre_tipo_cargue_factura'])) { $nombre_tipo_cargue_factura = addslashes($_POST['nombre_tipo_cargue_factura']); } else { $nombre_tipo_cargue_factura = 'FACTURA_COMPRA_NORMAL'; }
if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
if (isset($_POST['cod_puc'])) { $cod_puc = intval($_POST['cod_puc']); $cod_puc_post = intval($_POST['cod_puc']); } else { $cod_puc = 0; $cod_puc_post = 0; }
if (isset($_POST['cod_sino_crear_mov_contable'])) { $cod_sino_crear_mov_contable = intval($_POST['cod_sino_crear_mov_contable']); } else { $cod_sino_crear_mov_contable = 1; }
if (isset($_POST['cod_resolucion_facturacion'])) { $cod_resolucion_facturacion = intval($_POST['cod_resolucion_facturacion']); } else { $cod_resolucion_facturacion = 0; }
if (isset($_POST['cod_movimiento_contable_cuenta_personal'])) { $cod_movimiento_contable_cuenta_personal = intval($_POST['cod_movimiento_contable_cuenta_personal']); } else { $cod_movimiento_contable_cuenta_personal = 0; }
if (isset($_POST['fecha_pago'])) { $fecha_pago = addslashes($_POST['fecha_pago']); } else { $fecha_pago = ''; }
//if (isset($_POST['nombre_tipo_factura'])) { $nombre_tipo_factura = addslashes($_POST['nombre_tipo_factura']); } else { $nombre_tipo_factura = ''; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion')";
$resultado_resolucion_facturacion = mysqli_query($conectar, $sql_resolucion_facturacion);
$info_resolucion_facturacion = mysqli_fetch_assoc($resultado_resolucion_facturacion);

$nombre_tipo_resolucion_facturacion                 = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
$nombre_tipo_factura                                = $nombre_tipo_resolucion_facturacion;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_max_factura = "SELECT MAX(cod_factura_doc_soporte) AS cod_factura_doc_soporte FROM tbl15_info_factura_compra WHERE (nombre_tipo_factura = 'DOCUMENTO_SOPORTE')";
$consulta_max_factura = mysqli_query($conectar, $sql_max_factura) or die(mysqli_error($conectar));
$datos_max_factura = mysqli_fetch_assoc($consulta_max_factura);

$cod_factura_doc_soporte_max                        = $datos_max_factura['cod_factura_doc_soporte'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_info_cliente = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

$nit_cliente                                        = $info_cliente['identificacion_tercero'];
$nombres_clientes                                   = trim($info_cliente['nombre1_tercero'].' '.$info_cliente['nombre2_tercero'].' '.$info_cliente['apellido1_tercero'].' '.$info_cliente['apellido2_tercero']);
$digito                                             = $info_cliente['digito_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($nombre_tipo_factura == 'DOCUMENTO_SOPORTE') { $cod_factura_doc_soporte = $cod_factura_doc_soporte_max+1; $cod_factura = $cod_factura_doc_soporte; } else { $cod_factura_doc_soporte = 0; $cod_factura = $cod_factura; } 
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_tipo_inventario == '1') { $campo_und_inventario = 'und_producto'; } elseif ($cod_tipo_inventario == '2') { $campo_und_inventario = 'und_producto_bodega'; } else { $campo_und_inventario = 'und_producto'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$time                                              = time();
$fecha_ymdHis                                      = date("YmdHis");
$formato                                           = 'jpg';
$fecha_hora                                        = date("H:i:s");
$fecha_ymd                                         = date("Y-m-d");
$fecha_factura                                     = date("Y-m-d");
$nombre_origen_cargue                              = "CARGUE_FACTURA_COMPRA";
/* ----------------------------------------------------------------------------------------------------------/ */
$ruta_firma_miniatura                              = '../archivador/firma/miniatura/';
$ruta_foto_miniatura                               = '../archivador/foto/miniatura/';
$ruta_firma_orig                                   = '../archivador/firma/original/';
$ruta_foto_orig                                    = '../archivador/documentos/';
$url_img_orig_producto                             = "";
$url_img_min_producto                              = "";
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_totales_temporal = "SELECT SUM(total_costo_producto) AS total_precio_costo, SUM(total_compra_producto) AS total_precio_compra, 
SUM(und_compra * precio_venta_producto) AS total_precio_venta FROM tbl15_compra_producto_temporal WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_totales_temporal = mysqli_query($conectar, $sql_totales_temporal) or die(mysqli_error($conectar));
$datos_totales_temporal = mysqli_fetch_assoc($consulta_totales_temporal);

$total_precio_costo                                = $datos_totales_temporal['total_precio_costo'];
$total_precio_compra                               = $datos_totales_temporal['total_precio_compra'];
$total_precio_venta                                = $datos_totales_temporal['total_precio_venta'];
$total_compra_precio_costo                         = $total_precio_costo;
$total_compra_precio_compra                        = $total_precio_compra;
$total_compra_precio_venta                         = $total_precio_venta;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_totales_inv = "SELECT SUM(und_producto * precio_costo_producto) AS total_inv_precio_costo, SUM(und_producto * precio_compra_producto) AS total_inv_precio_compra, 
SUM(und_producto * precio_venta_producto) AS total_inv_precio_venta FROM tbl15_producto";
$consulta_totales_inv = mysqli_query($conectar, $sql_totales_inv) or die(mysqli_error($conectar));
$datos_totales_inv = mysqli_fetch_assoc($consulta_totales_inv);

$total_inv_precio_costo                            = $datos_totales_inv['total_inv_precio_costo'];
$total_inv_precio_compra                           = $datos_totales_inv['total_inv_precio_compra'];
$total_inv_precio_venta                            = $datos_totales_inv['total_inv_precio_venta'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_imp_factura = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$modificar_info_imp_factura = mysqli_query($conectar, $sql_info_imp_factura) or die(mysqli_error($conectar));
$total_encontrado_info_imp_factura = mysqli_num_rows($modificar_info_imp_factura);
$matriz_info_imp_factura  = mysqli_fetch_assoc($modificar_info_imp_factura);

$fecha_ymdhis                                      = $matriz_info_imp_factura['fecha_ymdhis'];
//$cuenta                                            = $cuenta_actual;
$cod_estado_factura                                = '0';
$descuento_ptj                                     = '0';
$iva_ptj                                           = '0';
$flete_ptj                                         = '0';
//$cod_cliente                                       = '0';
$vlr_vuelto                                        = '0';
$fecha_dia                                         = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                                         = date("Y-m", $fecha_anyo_seg);
$anyo                                              = date("Y", $fecha_anyo_seg);
$fecha_hora_venta_producto                         = date("H:i:s");
$fecha_remision                                    = $matriz_info_imp_factura['fecha_remision'];
$nombre_ccosto                                     = $matriz_info_imp_factura['nombre_ccosto'];
$garantia_meses                                    = $matriz_info_imp_factura['garantia_meses'];
$observacion                                       = $matriz_info_imp_factura['observacion'];
$mensaje                                           = $observacion;
//$cod_administrador                                 = $matriz_info_imp_factura['cod_administrador'];
$fecha_ymd_venta_producto                          = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes_venta_producto                          = date("Y-m", $fecha_anyo_seg);
$fecha_anyo_venta_producto                         = date("Y", $fecha_anyo_seg);
$fecha_seg_venta_producto                          = time();
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_venta_producto_temporal = "SELECT SUM(und_venta * precio_venta_producto) AS total_precio_venta, SUM(und_venta * precio_compra_producto) AS total_precio_compra, 
SUM(und_venta * precio_costo_producto) AS total_precio_costo
FROM tbl15_compra_producto_temporal WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
$datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal);

$total_precio_compra                               = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_precio_venta                                = $datos_total_venta_producto_temporal['total_precio_venta'];
$total_compra_precio_costo                         = $datos_total_venta_producto_temporal['total_precio_costo'];
$total_compra_precio_compra                        = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_compra_precio_venta                         = $datos_total_venta_producto_temporal['total_precio_venta'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------- LLAVE DE INICIO DEL CONDICIONAL VENDER POR CONTADO ---------------------------------------//
if (isset($_POST['cod_info_factura_compra'])) {

	$sql_mconsulta = "SELECT * FROM tbl15_compra_producto_temporal WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$mconsulta = mysqli_query($conectar, $sql_mconsulta) or die(mysqli_error($conectar));
	while ($datos_temp = mysqli_fetch_assoc($mconsulta)) {
		//$datos_temp = mysqli_fetch_assoc($mconsulta);

		$cod_compra_producto_temporal      = $datos_temp['cod_compra_producto_temporal'];
		$cod_producto                      = $datos_temp['cod_producto'];
		$cod_producto_barra                = $datos_temp['cod_producto_barra'];
		$nombre_tipo_precio_venta          = $datos_temp['nombre_tipo_precio_venta'];

		$sqlr_consulta = "SELECT und_producto, und_producto_bodega, comision_ptj, precio_compra_producto, precio_costo_producto FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
		$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
		$datos_prod = mysqli_fetch_assoc($modificar_consulta);

		$precio_compra_producto_viejo      = $datos_prod['precio_compra_producto'];
		$precio_costo_producto_viejo       = $datos_prod['precio_costo_producto'];
		$und_producto_inv                  = $datos_prod['und_producto'];
		$und_producto_bodega_inv           = $datos_prod['und_producto_bodega'];
		//$comision_ptj                      = $datos_prod['comision_ptj'];
		//-----------------------------------------------------------------------------------------------------------------------------------------//
		//------------------------------------TIPO DE VENTA PUEDES SER MENUDIADO O POR UNIDADES----------------------------------------------------//
		$cod_producto                      = $datos_temp['cod_producto'];
		$nombre_producto                   = $datos_temp['nombre_producto'];
		$und_compra                        = $datos_temp['und_compra'];
		$precio_compra_producto            = $datos_temp['precio_compra_producto'];
		$total_compra_producto             = $datos_temp['total_compra_producto'];
		$precio_costo_producto             = $datos_temp['precio_costo_producto'];
		$total_costo_producto              = $datos_temp['total_costo_producto'];
		$precio_venta_producto             = $datos_temp['precio_venta_producto'];
		$total_venta_producto              = $datos_temp['total_venta_producto'];
		$nombre_tipo_producto              = $datos_temp['nombre_tipo_producto'];
		$nombre_tipo_unidad_medida         = $datos_temp['nombre_tipo_unidad_medida'];
		$posologia_cantidad                = $datos_temp['posologia_cantidad'];
		$posologia_peso                    = $datos_temp['posologia_peso'];
		$nombre_tipo_presentacion          = $datos_temp['nombre_tipo_presentacion'];
		$nombre_via_administracion         = $datos_temp['nombre_via_administracion'];
		$nombre_frec_duracion              = $datos_temp['nombre_frec_duracion'];
		$cod_caja_virtual                  = $datos_temp['cod_caja_virtual'];
		$fecha_alerta                      = $datos_temp['fecha_alerta'];

		$und_unidades                      = $datos_temp['und_unidades'];
		$und_caja                          = $datos_temp['und_caja'];
		$unidades_total                    = $datos_temp['unidades_total'];
		$precio_venta_producto2            = $datos_temp['precio_venta_producto2'];
		$precio_venta_producto3            = $datos_temp['precio_venta_producto3'];
		$precio_venta_producto4            = $datos_temp['precio_venta_producto4'];
		$precio_venta_producto5            = $datos_temp['precio_venta_producto5'];
		$total_venta_producto              = $datos_temp['total_venta_producto'];
		$nombre_tipo_precio                = $datos_temp['nombre_tipo_precio'];
		$dto1                              = $datos_temp['dto1'];
		$dto2                              = $datos_temp['dto2'];
		$descuento                         = $datos_temp['descuento'];
		$total_dto                         = $datos_temp['total_dto'];
		$total_iva                         = $datos_temp['total_iva'];
		$iva_ptj                           = $datos_temp['iva_ptj'];
		$valor_iva                         = $datos_temp['valor_iva'];
		$ganancia_ptj                      = $datos_temp['ganancia_ptj'];
		$fecha_vencimiento                 = $datos_temp['fecha_vencimiento'];
		$fecha_vencimiento1                = $fecha_vencimiento;
		$lote_vencimiento                  = $datos_temp['lote_vencimiento'];
		$ipc_ptj                           = $datos_temp['ipc_ptj'];
		$precio_ipc                        = $datos_temp['precio_ipc'];
		$precio_ipc_total                  = $datos_temp['precio_ipc_total'];
		$iva_teorico_ptj                   = $datos_temp['iva_teorico_ptj'];
		$total_iva_teorico                 = $datos_temp['total_iva_teorico'];
		$tarifa_rete_vigente_ptj           = $datos_temp['tarifa_rete_vigente_ptj'];
		$total_tarifa_rete_vigente         = $datos_temp['total_tarifa_rete_vigente'];
		$rete_iva_asumido_ptj              = $datos_temp['rete_iva_asumido_ptj'];
		$total_rete_iva_asumido            = $datos_temp['total_rete_iva_asumido'];
		$nombre_tipo_bienes_serv           = $datos_temp['nombre_tipo_bienes_serv'];
		//$nombre_tipo_compra                = $datos_temp['nombre_tipo_compra'];
		$nombre_tipo_medida                = $datos_temp['nombre_tipo_medida'];
		$cajas                             = $datos_temp['cajas'];
		$cajas_sobre                       = $datos_temp['cajas_sobre'];
		$und_sobre                         = $datos_temp['und_sobre'];
		$check_caja                        = $datos_temp['check_caja'];
		$check_und                         = $datos_temp['check_und'];
		$chk                               = $datos_temp['chk'];
		$cod_interno                       = $datos_temp['cod_interno'];
		$cod_proveedor                     = $datos_temp['cod_proveedor'];
		$cod_original                      = $datos_temp['cod_original'];
		$codificacion                      = $datos_temp['codificacion'];
		$nombre_proveedor                  = $datos_temp['nombre_proveedor'];
		$tope_min                          = $datos_temp['tope_min'];
		$posologia_cantidad                = $datos_temp['posologia_cantidad'];
		$posologia_peso                    = $datos_temp['posologia_peso'];
		$nombre_frec_duracion              = $datos_temp['nombre_frec_duracion'];
		$nombre_via_administracion         = $datos_temp['nombre_via_administracion'];
		$cod_tipo_cobrar                   = $datos_temp['cod_tipo_cobrar'];
		$cod_estado_vacuna                 = $datos_temp['cod_estado_vacuna'];
		$cod_estado_permitir_venta         = $datos_temp['cod_estado_permitir_venta'];
		$cod_base_caja                     = $datos_temp['cod_base_caja'];
		$cod_guia                          = $datos_temp['cod_guia'];
		$cuenta                            = $datos_temp['cuenta'];
		$cod_doc_soporte                   = $datos_temp['cod_doc_soporte'];
		$comision_ptj                      = $datos_temp['comision_ptj'];
		$fecha_mantenimiento               = $datos_temp['fecha_mantenimiento'];
		$meses_mantenimiento               = $datos_temp['meses_mantenimiento'];
		$meses_garantia                    = $datos_temp['meses_garantia'];
		$peso_producto                     = $datos_temp['peso_producto'];
		$unidad_medida_peso                = $datos_temp['unidad_medida_peso'];
		$cod_dependencia                   = $datos_temp['cod_dependencia'];

		$precio_compra_producto_ant_desc   = $datos_temp['precio_compra_producto_ant_desc'];
		$total_compra_producto_ant_desc    = $datos_temp['total_compra_producto_ant_desc'];
		$check_ant_desc                    = $datos_temp['check_ant_desc'];
		$check_obsequio                    = $datos_temp['check_obsequio'];
		$precio_compra_producto_promedio   = $datos_temp['precio_compra_producto_promedio'];
		$precio_venta_producto_promedio    = $datos_temp['precio_venta_producto_promedio'];

		$precio_compra_producto_por_caja   = $datos_temp['precio_compra_producto_por_caja'];
		$precio_venta_producto_por_caja    = $datos_temp['precio_venta_producto_por_caja'];
		$precio_venta_producto2_por_caja   = $datos_temp['precio_venta_producto2_por_caja'];
		$precio_venta_producto3_por_caja   = $datos_temp['precio_venta_producto3_por_caja'];

		if ($cod_estado_promediar_precio_compra_y_venta_cargar_factura_global == '1') { $precio_compra_producto_inv = $precio_compra_producto_promedio; } else { $precio_compra_producto_inv = $precio_compra_producto; }
		if ($cod_tipo_inventario == '1') { $und_producto = $und_compra + $und_producto_inv; } elseif ($cod_tipo_inventario == '2') { $und_producto = $und_compra + $und_producto_bodega_inv; } else { $und_producto = $und_compra + $und_producto_inv; }
		//----------------------------- INSERTAR PRODUCTOS A LAS VENTAS -----------------------------//
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
		meses_garantia, peso_producto, unidad_medida_peso, precio_compra_producto_ant_desc, total_compra_producto_ant_desc, check_ant_desc, check_obsequio, 
		precio_compra_producto_promedio, precio_venta_producto_promedio, cod_puc, 
		precio_compra_producto_por_caja, precio_venta_producto_por_caja, precio_venta_producto2_por_caja, precio_venta_producto3_por_caja)
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
		'$meses_garantia', '$peso_producto', '$unidad_medida_peso', '$precio_compra_producto_ant_desc', '$total_compra_producto_ant_desc', '$check_ant_desc', '$check_obsequio', 
		'$precio_compra_producto_promedio', '$precio_venta_producto_promedio', '$cod_puc', 
		'$precio_compra_producto_por_caja', '$precio_venta_producto_por_caja', '$precio_venta_producto2_por_caja', '$precio_venta_producto3_por_caja')";
		$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
		if ($cod_tipo_producto_consumo == '1') {
			$agregar_regis = sprintf("UPDATE tbl15_producto SET nombre_producto = '$nombre_producto', $campo_und_inventario = '$und_producto', precio_compra_producto = '$precio_compra_producto_inv', 
			precio_costo_producto = '$precio_costo_producto', precio_venta_producto = '$precio_venta_producto', precio_venta_producto2 = '$precio_venta_producto2', 
			precio_venta_producto3 = '$precio_venta_producto3', precio_venta_producto4 = '$precio_venta_producto4', precio_venta_producto5 = '$precio_venta_producto5', 
			posologia_cantidad = '$posologia_cantidad', posologia_peso = '$posologia_peso', iva_ptj = '$iva_ptj', cod_tercero = '$cod_tercero', 
			fecha_ult_compra = '$fecha_ult_compra', tope_min = '$tope_min', cod_info_factura_compra = '$cod_info_factura_compra', 
			comision_ptj = '$comision_ptj', und_unidades = '$und_unidades', und_caja = '$und_caja', dto1 = '$dto1', dto2 = '$dto2', ipc_ptj = '$ipc_ptj', 
			precio_ipc = '$precio_ipc', precio_ipc_total = '$precio_ipc_total', ret_ica_ptj = '$ret_ica_ptj', iva_teorico_ptj = '$iva_teorico_ptj', 
			tarifa_rete_vigente_ptj = '$tarifa_rete_vigente_ptj', rete_iva_asumido_ptj = '$rete_iva_asumido_ptj', nombre_tipo_compra = '$nombre_tipo_compra', 
			nombre_tipo_cargue_factura = '$nombre_tipo_cargue_factura', cajas_sobre = '$cajas_sobre', und_sobre = '$und_sobre', fecha_vencimiento = '$fecha_vencimiento', 
			lote_vencimiento = '$lote_vencimiento', fecha_vencimiento1 = '$fecha_vencimiento1', nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida', 
			fecha_mantenimiento = '$fecha_mantenimiento', meses_mantenimiento = '$meses_mantenimiento', meses_garantia = '$meses_garantia', 
			peso_producto = '$peso_producto', unidad_medida_peso = '$unidad_medida_peso', cod_dependencia = '$cod_dependencia', precio_compra_producto_promedio = '$precio_compra_producto_promedio', 
			precio_venta_producto_promedio = '$precio_venta_producto_promedio', 
			precio_compra_producto_por_caja = '$precio_compra_producto_por_caja', precio_venta_producto_por_caja = '$precio_venta_producto_por_caja', 
			precio_venta_producto2_por_caja = '$precio_venta_producto2_por_caja', precio_venta_producto3_por_caja = '$precio_venta_producto3_por_caja'
			WHERE (cod_producto_barra = '$cod_producto_barra')");
			$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
		} else {
			$agregar_regis = sprintf("UPDATE tbl15_producto SET nombre_producto = '$nombre_producto', precio_compra_producto = '$precio_compra_producto_inv', 
			precio_costo_producto = '$precio_costo_producto', precio_venta_producto = '$precio_venta_producto', precio_venta_producto2 = '$precio_venta_producto2', 
			precio_venta_producto3 = '$precio_venta_producto3', precio_venta_producto4 = '$precio_venta_producto4', precio_venta_producto5 = '$precio_venta_producto5', 
			posologia_cantidad = '$posologia_cantidad', posologia_peso = '$posologia_peso', iva_ptj = '$iva_ptj', cod_tercero = '$cod_tercero', 
			fecha_ult_compra = '$fecha_ult_compra', tope_min = '$tope_min', cod_info_factura_compra = '$cod_info_factura_compra', 
			comision_ptj = '$comision_ptj', und_unidades = '$und_unidades', und_caja = '$und_caja', dto1 = '$dto1', dto2 = '$dto2', ipc_ptj = '$ipc_ptj', 
			precio_ipc = '$precio_ipc', precio_ipc_total = '$precio_ipc_total', ret_ica_ptj = '$ret_ica_ptj', iva_teorico_ptj = '$iva_teorico_ptj', 
			tarifa_rete_vigente_ptj = '$tarifa_rete_vigente_ptj', rete_iva_asumido_ptj = '$rete_iva_asumido_ptj', nombre_tipo_compra = '$nombre_tipo_compra', 
			nombre_tipo_cargue_factura = '$nombre_tipo_cargue_factura', cajas_sobre = '$cajas_sobre', und_sobre = '$und_sobre', fecha_vencimiento = '$fecha_vencimiento', 
			lote_vencimiento = '$lote_vencimiento', fecha_vencimiento1 = '$fecha_vencimiento1', nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida', 
			fecha_mantenimiento = '$fecha_mantenimiento', meses_mantenimiento = '$meses_mantenimiento', meses_garantia = '$meses_garantia', 
			peso_producto = '$peso_producto', unidad_medida_peso = '$unidad_medida_peso', cod_dependencia = '$cod_dependencia', precio_compra_producto_promedio = '$precio_compra_producto_promedio', 
			precio_venta_producto_promedio = '$precio_venta_producto_promedio', 
			precio_compra_producto_por_caja = '$precio_compra_producto_por_caja', precio_venta_producto_por_caja = '$precio_venta_producto_por_caja', 
			precio_venta_producto2_por_caja = '$precio_venta_producto2_por_caja', precio_venta_producto3_por_caja = '$precio_venta_producto3_por_caja'
			WHERE (cod_producto_barra = '$cod_producto_barra')");
			$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
		}


		if ($fecha_vencimiento <> "") {
			$agreg = "INSERT INTO tbl15_historial_fecha_vencimiento (cod_producto_barra, fecha_compra, fecha_vencimiento, vencimiento_lote, cod_factura, cod_info_factura_compra) 
			VALUES ('$cod_producto_barra', '$fecha_compra', '$fecha_vencimiento', '$lote_vencimiento', '$cod_factura', '$cod_info_factura_compra')";
			$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
		}
		if ($fecha_mantenimiento <> "") {
			$sql_reg = "INSERT INTO tbl15_historial_fecha_mantenimiento (cod_producto_barra, fecha_compra, fecha_mantenimiento, cod_factura, cod_info_factura_compra, meses_mantenimiento)
			VALUES ('$cod_producto_barra', '$fecha_compra', '$fecha_mantenimiento', '$cod_factura', '$cod_info_factura_compra', '$meses_mantenimiento')";
			$resultado_venta_producto = mysqli_query($conectar, $sql_reg) or die(mysqli_error($conectar));
		}

	}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
	$borrar_sql = sprintf("DELETE FROM tbl15_compra_producto_temporal WHERE (cod_info_factura_compra = '$cod_info_factura_compra')");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	$sql_totales_inv_desp = "SELECT SUM(und_producto * precio_compra_producto) AS total_inv_compra_desp_factura FROM tbl15_producto";
	$consulta_totales_inv_desp = mysqli_query($conectar, $sql_totales_inv_desp) or die(mysqli_error($conectar));
	$datos_totales_inv_desp = mysqli_fetch_assoc($consulta_totales_inv_desp);

	$total_inv_compra_desp_factura           = $datos_totales_inv_desp['total_inv_compra_desp_factura'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$tiempo_final                            = microtime(true);
	$tiempo_ejecucion                        = $tiempo_final - $tiempo_inicial;
	$vlr_vuelto                              = $vlr_cancelado - $total_precio_venta;
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($url_img1 <> '') { 
		$formato_img2                    = explode(".", $url_img1);
		$formato_img2                    = end($formato_img2);
		$formato_orig2                   = strtolower($formato_img2);
		$nombre_foto_cryp                = crc32($url_img1);
		$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_info_factura_compra.'_'.$cod_tercero.'_ori'.'.'.$formato_orig2;
		$url_img_orig_producto           = $ruta_foto_orig.$nombre_normal2;
		$url_img_min_producto            = $ruta_foto_orig.$nombre_normal2;

		copy($_FILES['url_img1']['tmp_name'], $url_img_orig_producto);
	}
	if ($cod_tipo_pago=='2') {
		//$monto_deuda_credit	             = $total_factura_compra_retefuente;
		//$subtotal_credit	                 = $total_factura_compra_retefuente;
		$monto_deuda_credit	               = ($total_factura_compra_retefuente);
		$subtotal_credit	               = ($total_factura_compra_retefuente);
		$vendedor	                       = $cuenta;
		$fecha	                           = $fecha_anyo;
		$fecha_invert	                   = $fecha_anyo;

		$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cuentas_pagar'";
		$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
		$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

		$cod_cuentas_pagar  = $datos_autoincremento_egresos['AUTO_INCREMENT'];

		$agregar_reg_compra_producto = "INSERT INTO tbl15_cuentas_pagar (cod_cuentas_pagar, cod_factura, cod_tercero, monto_deuda, subtotal, 
		vendedor, cuenta, fecha_pago, fecha, fecha_invert, fecha_seg, cod_info_factura_compra, fecha_hora, nombre_origen_cargue, mensaje)
		VALUES ('$cod_cuentas_pagar', '$cod_factura', '$cod_tercero', '$monto_deuda_credit', '$subtotal_credit', 
		'$vendedor', '$cuenta', '$fecha_pago', '$fecha', '$fecha_invert', '$fecha_seg', '$cod_info_factura_compra', '$fecha_hora', '$nombre_origen_cargue', '$mensaje')";
		$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));

		$sql_datos_cuenta_pagar = "SELECT SUM(monto_deuda) AS total_monto_deuda_cuenta_pagar, SUM(subtotal) AS total_subtotal_cuenta_pagar, SUM(abonado) AS total_abonado_cuenta_pagar 
		FROM tbl15_cuentas_pagar WHERE (cod_tercero = '$cod_tercero')";
		$consulta_datos_cuenta_pagar = mysqli_query($conectar, $sql_datos_cuenta_pagar);
		$datos_cuenta_pagar = mysqli_fetch_assoc($consulta_datos_cuenta_pagar);

		$total_monto_deuda_cuenta_pagar       = $datos_cuenta_pagar['total_monto_deuda_cuenta_pagar'];

		$sql_datos_cuentas_pagar_abonos = "SELECT SUM(abonado) AS total_abonado_cuenta_pagar FROM tbl15_cuentas_pagar_abonos WHERE (cod_tercero = '$cod_tercero')";
		$consulta_datos_cuentas_pagar_abonos = mysqli_query($conectar, $sql_datos_cuentas_pagar_abonos);
		$datos_cuentas_pagar_abonos = mysqli_fetch_assoc($consulta_datos_cuentas_pagar_abonos);

		$total_abonado_cuenta_pagar           = $datos_cuentas_pagar_abonos['total_abonado_cuenta_pagar'];
		$total_subtotal_cuenta_pagar          = $total_monto_deuda_cuenta_pagar - $total_abonado_cuenta_pagar;

		$sql_cuenta_pagar_tercero = sprintf("UPDATE tbl15_tercero SET cod_estado_cuenta_pagar = '$cod_estado_cuenta_pagar', total_monto_deuda_cuenta_pagar = '$total_monto_deuda_cuenta_pagar', 
		total_subtotal_cuenta_pagar = '$total_subtotal_cuenta_pagar', total_abonado_cuenta_pagar = '$total_abonado_cuenta_pagar', fecha_modificacion_cuenta_pagar = '$fecha_modificacion_cuenta_pagar' 
		WHERE (cod_tercero = '$cod_tercero')");
		$resultado_cuenta_pagar_tercero = mysqli_query($conectar, $sql_cuenta_pagar_tercero) or die(mysqli_error($conectar));
	}
//---------------------------------------------------------------------------------------------------------------------------------//
	$agregar_regis = sprintf("UPDATE tbl15_info_factura_compra SET total = '$total', subtotal_total_precio_compra = '$subtotal_total_precio_compra', 
	subtotal_total_precio_costo = '$subtotal_total_precio_costo', total_factura_compra = '$total_factura_compra', total_precio_costo = '$total_precio_costo', 
	cod_estado_factura = '$cod_estado_factura', cod_factura = '$cod_factura', fecha_anyo = '$fecha_anyo', 
	fecha_dia = '$fecha_dia', fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', total_precio_compra = '$total_precio_compra', 
	total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data', cod_tercero = '$cod_tercero', nombre_estado_factura = '$nombre_estado_factura',
	cuenta = '$cuenta', vlr_cancelado = '$vlr_cancelado', vlr_vuelto = '$vlr_vuelto', cod_tipo_pago = '$cod_tipo_pago', cod_administrador = '$cod_administrador', 
	cod_tipo_forma_pago = '$cod_tipo_forma_pago', nombre_tipo_factura = '$nombre_tipo_factura', nombre_tipo_moneda = '$nombre_tipo_moneda', 
	nombre_tipo_cargue_factura = '$nombre_tipo_cargue_factura', nombre_rete_fuente_ptj = '$nombre_rete_fuente_ptj', ret_ica_ptj = '$ret_ica_ptj', 
	subtotal = '$subtotal', valor_iva = '$total_valor_iva', total_descuento = '$total_descuento', total_precio_ipc = '$total_precio_ipc', 
	total_compra_imp = '$total_compra_imp', total_rete_fuente = '$total_rete_fuente', total_ret_ica = '$total_ret_ica', 
	total_factura_compra_retefuente = '$total_factura_compra_retefuente', nombre_maquina = '$nombre_maquina', tiempo_ejecucion = '$tiempo_ejecucion', 
	cod_resolucion_facturacion = '$cod_resolucion_facturacion', total_inv_precio_costo = '$total_inv_precio_costo', total_inv_precio_compra = '$total_inv_precio_compra', 
	total_inv_precio_venta = '$total_inv_precio_venta', total_inv_compra_desp_factura = '$total_inv_compra_desp_factura', 
	total_compra_precio_costo = '$total_compra_precio_costo', total_compra_precio_compra = '$total_compra_precio_compra', 
	total_compra_precio_venta = '$total_compra_precio_venta', cod_tipo_inventario = '$cod_tipo_inventario', 
	cod_tipo_producto_consumo = '$cod_tipo_producto_consumo', cod_cuentas_pagar = '$cod_cuentas_pagar', cod_puc = '$cod_puc', 
	cod_sino_crear_mov_contable = '$cod_sino_crear_mov_contable', cod_factura_doc_soporte = '$cod_factura_doc_soporte', fecha_pago = '$fecha_pago'
	WHERE (cod_info_factura_compra = '$cod_info_factura_compra')");
	$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {

		if ($cod_tipo_pago == '1') { $nombre_tipo_documento = 'COMPROBANTE DE EGRESO'; } else { $nombre_tipo_documento = 'MOVIMIENTO INTERNO'; }
		//$nombre_tipo_documento                                 = 'COMPROBANTE DE EGRESO';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");
		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		$cod_puc                                               = '814';
		$codigo_puc                                            = '236540';
		$nombre_puc                                            = 'COMPRAS';
		$tipo_puc                                              = 'PASIVOS';
		$und_vendida                                           = '1';

		$costo_movimiento_contable                             = $total_factura_compra_retefuente;
		$total_costo_movimiento_contable                       = $total_factura_compra_retefuente;
		$fecha_ymd                                             = date("Y-m-d", strtotime($fecha_anyo));
		$fecha_mes                                             = date("Y-m", strtotime($fecha_anyo));
		$anyo                                                  = date("Y", strtotime($fecha_anyo));
		$fecha_seg                                             = time();
		$comentario                                            = 'factura de compra cargada por modulo administrativo ID: '.$cod_info_factura_compra.' - factura: '.$cod_factura.' - proveedor: '.$nombres_clientes;

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

		$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
		WHERE (nombre_modulo_puc = 'COMPRAS') AND (cod_tipo_pago = '$cod_tipo_pago')";
		$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
		$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

		$cod_puc                                               = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//754//765
		$codigo_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//22//23
		$nombre_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//PAGO A PROVEEDORES//CUENTAS POR PAGAR
		$tipo_puc                                              = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//EGRESOS//PASIVOS

		if ($cod_tipo_pago == '1') {
			$nombre_tipo_movimiento 	                           = 'DEBITOS';
			//$cod_puc                                               = '754';
			//$codigo_puc                                            = '22';
			//$nombre_puc                                            = 'PAGO A PROVEEDORES';
			$tipo_puc                                              = 'PASIVOS';

			$actualizar_sql = "UPDATE tbl15_movimiento_contable_cuenta_personal SET total_saldo = '$total_saldo', saldo_actual_puc = '$saldo_actual_puc', subtotal_puc = '$subtotal_puc'
			WHERE (cod_movimiento_contable_cuenta_personal = '$cod_movimiento_contable_cuenta_personal')";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		} else {
			$nombre_tipo_movimiento 	                           = 'DEBITOS';
			//$cod_puc                                               = '765';
			//$codigo_puc                                            = '23';
			//$nombre_puc                                            = 'CUENTAS POR PAGAR';
			$tipo_puc                                              = 'PASIVOS';
		}
		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_cuenta_personal_concepto (cod_movimiento_contable_cuenta_personal, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, 
		nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, 
		cuenta, comentario, cod_tercero, cod_tipo_forma_pago, simbolo_tipo_operacion, total_saldo, cod_info_factura_compra, cod_tipo_pago)
		VALUES ('$cod_movimiento_contable_cuenta_personal', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', 
		'$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', 
		'$cuenta', '$comentario', '$cod_tercero', '$cod_tipo_forma_pago', '$simbolo_tipo_operacion', '$total_saldo_movimiento_contable_cuenta_personal', '$cod_info_factura_compra', '$cod_tipo_pago')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
	}
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
	if ($cod_estado_generar_movimiento_contable_automatico_global == '1' && $cod_sino_crear_mov_contable == '2') {
		$fecha_ymd                                             = date("Y-m-d", strtotime($fecha_anyo));
		$fecha_mes                                             = date("Y-m", strtotime($fecha_anyo));
		$anyo                                                  = date("Y", strtotime($fecha_anyo));
		$fecha_seg                                             = strtotime($fecha_anyo);

		if ($cod_tipo_pago == '1') { $nombre_tipo_documento = 'FACTURA DE COMPRA'; } else { $nombre_tipo_documento = 'MOVIMIENTO INTERNO'; }
		//$nombre_tipo_documento                                 = 'COMPROBANTE DE EGRESO';
		$nombre_estado_factura                                 = 'CERRADA';
		$ip                                                    = $_SERVER["REMOTE_ADDR"];
		$total_costo_movimiento_contable_smrt                  = 0;
		$fecha_movimiento_contable_cuenta_personal             = date("Y-m-d");

		$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
		$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
		$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

		$cod_movimiento_contable                               = $datos_autoincremento_egresos['AUTO_INCREMENT'];

		$sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
		$consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
		$info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

		$cod_guia                                              = $info_guia_movimiento['cod_guia']+1;
/* ----------------------------------------------------------------------------------------------------------/ */
		$doc_modifica                                          = "FACTURA COMPRA: ".$cod_factura." | ".$nombres_clientes." | ".(($subtotal + $total_valor_iva) - $total_rete_fuente)." | ".$fecha_anyo." | ID ".$cod_info_factura_compra;
		$descripcion_movimiento                                = "factura compra: ".$cod_factura;
		$total_costo_movimiento_contable                       = $total_compra_imp;
		$cod_tipo_nota_observacion                             = 3;
/* ----------------------------------------------------------------------------------------------------------/ */
		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable (nombre_estado_factura, cod_factura, doc_modifica, nombre_tipo_documento, descripcion_movimiento, total_costo_movimiento_contable,  
		cod_tercero, nombres_clientes, nit_cliente, fecha_anyo, fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, cod_tipo_forma_pago, ip, cuenta, cod_guia, cod_tipo_nota_observacion, cod_info_factura_compra)
		VALUES ('$nombre_estado_factura', '$cod_factura',  '$doc_modifica', '$nombre_tipo_documento', '$descripcion_movimiento', '$total_costo_movimiento_contable', 
		'$cod_tercero', '$nombres_clientes', '$nit_cliente', '$fecha_anyo', '$fecha_ymd', '$fecha_mes', '$anyo', '$fecha_seg', '$fecha_factura', '$cod_tipo_forma_pago', '$ip', '$cuenta', '$cod_guia', '$cod_tipo_nota_observacion', '$cod_info_factura_compra')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
		$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
		WHERE (nombre_modulo_puc = 'COMPRAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '9')";
		$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
		$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

		$cod_puc                                               = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//1659
		$codigo_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//470510
		$nombre_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//INVENTARIOS (CR)
		$tipo_puc                                              = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//ACTIVO

		$nombre_tipo_movimiento 	                           = 'DEBITOS';
		//$cod_puc                                               = '1659';
		//$codigo_puc                                            = '470510';
		//$nombre_puc                                            = 'INVENTARIOS (CR)';
		//$tipo_puc                                              = 'ACTIVO';
		$und_vendida                                           = '1';
		$costo_movimiento_contable                             = $subtotal;
		$total_costo_movimiento_contable                       = $subtotal;	

		$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
		venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
		VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
		'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
		$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

		$sql_puc_debito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
	    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
	    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

	    $saldo_actual_puc_debito_db                        = $info_puc_debito['saldo_actual_puc'];
		$saldo_actual_puc_debito                           = $saldo_actual_puc_debito_db + $costo_movimiento_contable;

		$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
		$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
		if ($total_valor_iva > 0) {
			$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
			WHERE (nombre_modulo_puc = 'COMPRAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '10')";
			$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
			$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

			$cod_puc                                               = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//1914
			$codigo_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//521570
			$nombre_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//IVA DESCONTABLE
			$tipo_puc                                              = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//GASTOS

			$nombre_tipo_movimiento 	                           = 'DEBITOS';
			//$cod_puc                                               = '1914';
			//$codigo_puc                                            = '521570';
			//$nombre_puc                                            = 'IVA DESCONTABLE';
			//$tipo_puc                                              = 'GASTOS';
			$und_vendida                                           = '1';
			$costo_movimiento_contable                             = $total_valor_iva;
			$total_costo_movimiento_contable                       = $total_valor_iva;	

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
			venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
			VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$sql_puc_debito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $saldo_actual_puc_debito_db                        = $info_puc_debito['saldo_actual_puc'];
			$saldo_actual_puc_debito                           = $saldo_actual_puc_debito_db + $costo_movimiento_contable;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}
/* ----------------------------------------------------------------------------------------------------------/ */

		if ($total_rete_fuente > 0) {
			$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
			WHERE (nombre_modulo_puc = 'COMPRAS') AND (codigo_parametrizacion_puc_cuentas_estaticas = '11')";
			$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
			$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

			$cod_puc                                               = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//211
			$codigo_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//135515
			$nombre_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//RETENCION EN LA FUENTE
			$tipo_puc                                              = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//ACTIVO

			$nombre_tipo_movimiento 	                           = 'CREDITOS';
			//$cod_puc                                               = '211';
			//$codigo_puc                                            = '135515';
			//$nombre_puc                                            = 'RETENCION EN LA FUENTE';
			//$tipo_puc                                              = 'ACTIVO';
			$und_vendida                                           = '1';
			$costo_movimiento_contable                             = $total_rete_fuente;
			$total_costo_movimiento_contable                       = $total_rete_fuente;	

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
			venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
			VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$sql_puc_debito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $saldo_actual_puc_debito_db                        = $info_puc_debito['saldo_actual_puc'];
			$saldo_actual_puc_debito                           = $saldo_actual_puc_debito_db + $costo_movimiento_contable;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}
/* ----------------------------------------------------------------------------------------------------------/ */
		if ($cod_tipo_pago == '1') { //CONTADO

		    $sql_puc_credito = "SELECT * FROM tbl15_puc WHERE (cod_puc = '$cod_puc_post')";
		    $resultado_puc_credito = mysqli_query($conectar, $sql_puc_credito);
		    $info_puc_credito = mysqli_fetch_assoc($resultado_puc_credito);
	        //$existe_reg = mysqli_num_rows($resultado_puc_credito);

		    $cod_puc_credito_db                                = $info_puc_credito['cod_puc'];
		    $codigo_puc_credito_db                             = $info_puc_credito['codigo_puc'];
		    $nombre_puc_credito_db                             = $info_puc_credito['nombre_puc'];
		    $tipo_puc_credito_db                               = $info_puc_credito['tipo_puc'];
		    $saldo_actual_puc_credito_db                       = $info_puc_credito['saldo_actual_puc'];

			$nombre_tipo_movimiento 	                       = 'CREDITOS';
			$cod_puc                                           = $cod_puc_credito_db;
			$codigo_puc                                        = $codigo_puc_credito_db;
			$nombre_puc                                        = $nombre_puc_credito_db;
			$tipo_puc                                          = $tipo_puc_credito_db;
			$und_vendida                                       = '1';
			$costo_movimiento_contable                         = ($subtotal + $total_valor_iva) - $total_rete_fuente;
			$total_costo_movimiento_contable                   = ($subtotal + $total_valor_iva) - $total_rete_fuente;	

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
			venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
			VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$sql_puc_debito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $saldo_actual_puc_debito_db                        = $info_puc_debito['saldo_actual_puc'];
			$saldo_actual_puc_debito                           = $saldo_actual_puc_debito_db + $costo_movimiento_contable;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));

		} else { //CREDITO
			$sql_parametrizacion_puc_cuentas_estaticas = "SELECT cod_puc, codigo_puc, nombre_puc,tipo_puc  FROM tbl15_parametrizacion_puc_cuentas_estaticas 
			WHERE (nombre_modulo_puc = 'COMPRAS') AND (cod_tipo_pago = '$cod_tipo_pago')";
			$resultado_parametrizacion_puc_cuentas_estaticas = mysqli_query($conectar, $sql_parametrizacion_puc_cuentas_estaticas);
			$info_parametrizacion_puc_cuentas_estaticas = mysqli_fetch_assoc($resultado_parametrizacion_puc_cuentas_estaticas);

			$cod_puc                                               = $info_parametrizacion_puc_cuentas_estaticas['cod_puc'];//765
			$codigo_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['codigo_puc'];//23
			$nombre_puc                                            = $info_parametrizacion_puc_cuentas_estaticas['nombre_puc'];//CUENTAS POR PAGAR
			$tipo_puc                                              = $info_parametrizacion_puc_cuentas_estaticas['tipo_puc'];//PASIVOS

			$nombre_tipo_movimiento 	                           = 'CREDITOS';
			//$cod_puc                                               = '765';
			//$codigo_puc                                            = '23';
			//$nombre_puc                                            = 'CUENTAS POR PAGAR';
			//$tipo_puc                                              = 'PASIVOS';
			$und_vendida                                           = '1';
			$costo_movimiento_contable                             = ($subtotal + $total_valor_iva) - $total_rete_fuente;
			$total_costo_movimiento_contable                       = ($subtotal + $total_valor_iva) - $total_rete_fuente;	

			$agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc,  tipo_puc, und_vendida, costo_movimiento_contable, 
			venta_movimiento_contable, total_costo_movimiento_contable, total_venta_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia)
			VALUES ('$cod_movimiento_contable', '$cod_puc',  '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
			'$venta_movimiento_contable', '$total_costo_movimiento_contable', '$total_venta_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia')";
			$resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));

			$sql_puc_debito = "SELECT saldo_actual_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
		    $resultado_puc_debito = mysqli_query($conectar, $sql_puc_debito);
		    $info_puc_debito = mysqli_fetch_assoc($resultado_puc_debito);

		    $saldo_actual_puc_debito_db                        = $info_puc_debito['saldo_actual_puc'];
			$saldo_actual_puc_debito                           = $saldo_actual_puc_debito_db + $costo_movimiento_contable;

			$actualizar_sql = "UPDATE tbl15_puc SET saldo_actual_puc = '$saldo_actual_puc_debito' WHERE cod_puc = '$cod_puc'";
			$resultado_actualizacion = mysqli_query($conectar, $actualizar_sql) or die(mysqli_error($conectar));
		}

	}
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_estado_enviar_factura_documento_soporte_dian_api_global == '1' && $nombre_tipo_factura == 'DOCUMENTO_SOPORTE') {
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
	if ($cod_estado_enviar_factura_documento_soporte_dian_api_global == '1' && $nombre_tipo_factura == 'DOCUMENTO_SOPORTE') { 
		$pagina_redirect_imprimir = '../admin/enviar_factura_documento_soporte_dian_dataico_ajax.php';
		$url_redir = $pagina_redirect_imprimir."?cod_info_factura_compra=".$cod_info_factura_compra."&cod_tipo_pago=".$cod_tipo_pago."&conexion_internet=".$conexion_internet."&pagina=".$pagina;
	} else { 
		$pagina_redirect_imprimir = '../admin/factura_compra_productos_opcion_imprimir.php';
		$url_redir = $pagina_redirect_imprimir."?cod_info_factura_compra=".$cod_info_factura_compra."&cod_tipo_pago=".$cod_tipo_pago."&conexion_internet=".$conexion_internet."&pagina=".$pagina;
	}
	header("Location: $url_redir");
}
?>