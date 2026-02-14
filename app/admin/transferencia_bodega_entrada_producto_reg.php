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
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT cod_estado_generar_movimiento_contable_automatico_global, cod_estado_promediar_precio_compra_y_venta_cargar_factura_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_generar_movimiento_contable_automatico_global         = $info_empresa_data['cod_estado_generar_movimiento_contable_automatico_global'];
$cod_estado_promediar_precio_compra_y_venta_cargar_factura_global = $info_empresa_data['cod_estado_promediar_precio_compra_y_venta_cargar_factura_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_info_factura_transferencia_bodega_entrada   = intval($_POST['cod_info_factura_transferencia_bodega_entrada']);
$fecha_anyo                                      = addslashes($_POST['fecha_anyo']);
$cod_tercero                                     = intval($_POST['cod_tercero']);
$cod_administrador                               = intval($_POST['cod_administrador']);
$total_datos                                     = intval($_POST['total_datos']);
$cod_tipo_origen_factura_compra                  = intval($_POST['cod_tipo_origen_factura_compra']);

$pagina                                          = addslashes($_POST['pagina']);
$fecha_anyo_seg                                  = strtotime($fecha_anyo);
$total_datos_data                                = $total_datos;
$nombre_estado_factura                           = 'CERRADA';
$nombre_maquina                                  = gethostname();

if (isset($_POST['cod_sino'])) { $cod_sino = intval($_POST['cod_sino']); } else { $cod_sino = '1'; }
if (isset($_POST['cod_tipo_inventario'])) { $cod_tipo_inventario = intval($_POST['cod_tipo_inventario']); } else { $cod_tipo_inventario = '1'; }
if (isset($_POST['cod_tipo_producto_consumo'])) { $cod_tipo_producto_consumo = intval($_POST['cod_tipo_producto_consumo']); } else { $cod_tipo_producto_consumo = '1'; }
if (isset($_POST['nombre_tipo_compra'])) { $nombre_tipo_compra = addslashes($_POST['nombre_tipo_compra']); } else { $nombre_tipo_compra = 'NORMAL'; }
if (isset($_POST['nombre_tipo_moneda'])) { $nombre_tipo_moneda = addslashes($_POST['nombre_tipo_moneda']); } else { $nombre_tipo_moneda = 'COP'; }
if (isset($_POST['nombre_tipo_factura'])) { $nombre_tipo_factura = addslashes($_POST['nombre_tipo_factura']); } else { $nombre_tipo_factura = 'POS'; }
if (isset($_POST['cod_tipo_forma_pago'])) { $cod_tipo_forma_pago = addslashes($_POST['cod_tipo_forma_pago']); } else { $cod_tipo_forma_pago = '1'; }
if (isset($_POST['cod_tipo_pago'])) { $cod_tipo_pago = addslashes($_POST['cod_tipo_pago']); } else { $cod_tipo_pago = '1'; }

if (isset($_POST['nombre_tipo_cargue_factura'])) { $nombre_tipo_cargue_factura = addslashes($_POST['nombre_tipo_cargue_factura']); } else { $nombre_tipo_cargue_factura = 'FACTURA_COMPRA_NORMAL'; }
if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_compra'";
$exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
$datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

$cod_info_factura_compra  = $datos_autoincremento_egresos['AUTO_INCREMENT'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_empresa = "SELECT nombre FROM tbl15_info_empresa WHERE (cod_info_empresa = '1')";
$consulta_info_empresa = mysqli_query($conectar, $sql_info_empresa) or die(mysqli_error($conectar));
$datos_info_empresa = mysqli_fetch_assoc($consulta_info_empresa);

$nombre_cliente                          = $datos_info_empresa['nombre'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_tercero = "SELECT nombre1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_info_tercero = mysqli_query($conectar, $sql_info_tercero) or die(mysqli_error($conectar));
$datos_info_tercero = mysqli_fetch_assoc($consulta_info_tercero);

$nombre_empresa                          = $nombre_cliente;
$razonsocial_empresa                     = $datos_info_tercero['nombre1_tercero'];
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_venta_producto_temporal = "SELECT SUM(und_venta * precio_venta_producto) AS total_precio_venta, SUM(und_venta * precio_compra_producto) AS total_precio_compra, 
SUM(und_venta * precio_costo_producto) AS total_precio_costo
FROM tbl15_transferencia_bodega_entrada_producto_temporal WHERE (cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada')";
$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
$datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal);

$total_precio_compra                     = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_precio_venta                      = $datos_total_venta_producto_temporal['total_precio_venta'];
$total_compra_precio_costo               = $datos_total_venta_producto_temporal['total_precio_costo'];
$total_compra_precio_compra              = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_compra_precio_venta               = $datos_total_venta_producto_temporal['total_precio_venta'];

$total_factura_compra_retefuente         = $total_precio_compra ;
$subtotal                                = $total_precio_compra ;
$total                                   = $total_factura_compra_retefuente;
$subtotal_total_precio_compra            = $subtotal;
$subtotal_total_precio_costo             = $subtotal;
$total_factura_compra                    = $total_factura_compra_retefuente;
$fecha_compra                            = $fecha_anyo;
$total_precio_costo                      = $total_compra_precio_costo;
$nombre_rete_fuente_ptj                  = 0;
$ret_ica_ptj                             = 0;
$valor_iva                               = 0;
$total_descuento                         = 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_totales_inv_desp = "SELECT SUM(und_producto * precio_compra_producto) AS total_inv_compra_desp_factura FROM tbl15_producto";
$consulta_totales_inv_desp = mysqli_query($conectar, $sql_totales_inv_desp) or die(mysqli_error($conectar));
$datos_totales_inv_desp = mysqli_fetch_assoc($consulta_totales_inv_desp);

$total_inv_compra_desp_factura           = $datos_totales_inv_desp['total_inv_compra_desp_factura'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_totales_inv = "SELECT SUM(und_producto * precio_costo_producto) AS total_inv_precio_costo, SUM(und_producto * precio_compra_producto) AS total_inv_precio_compra, 
SUM(und_producto * precio_venta_producto) AS total_inv_precio_venta FROM tbl15_producto";
$consulta_totales_inv = mysqli_query($conectar, $sql_totales_inv) or die(mysqli_error($conectar));
$datos_totales_inv = mysqli_fetch_assoc($consulta_totales_inv);

$total_inv_precio_costo                  = $datos_totales_inv['total_inv_precio_costo'];
$total_inv_precio_compra                 = $datos_totales_inv['total_inv_precio_compra'];
$total_inv_precio_venta                  = $datos_totales_inv['total_inv_precio_venta'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_tipo_producto_consumo'])) { $cod_tipo_producto_consumo = addslashes($_POST['cod_tipo_producto_consumo']); } else { $cod_tipo_producto_consumo = '1'; }

$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_transferencia_bodega_entrada 
WHERE (nombre_tipo_factura = '$nombre_tipo_factura') AND (nombre_estado_factura = 'CERRADA')";
$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

$cod_factura                             = $maxima_factura['cod_factura']+1;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_imp_factura = "SELECT * FROM tbl15_info_factura_transferencia_bodega_entrada WHERE cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada'";
$modificar_info_imp_factura = mysqli_query($conectar, $sql_info_imp_factura) or die(mysqli_error($conectar));
$total_encontrado_info_imp_factura = mysqli_num_rows($modificar_info_imp_factura);
$matriz_info_imp_factura  = mysqli_fetch_assoc($modificar_info_imp_factura);

$fecha_ymdhis                            = $matriz_info_imp_factura['fecha_ymdhis'];
$cod_empresa_transferencia_directa       = $matriz_info_imp_factura['cod_empresa_transferencia_directa'];
//$cuenta                                  = $cuenta_actual;
$cod_estado_factura                      = '0';
$descuento_ptj                           = '0';
$iva_ptj                                 = '0';
$flete_ptj                               = '0';
//$cod_cliente                             = '0';
$vlr_vuelto                              = '0';
$fecha_dia                               = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                               = date("Y-m", $fecha_anyo_seg);
$anyo                                    = date("Y", $fecha_anyo_seg);
$fecha_hora                              = date("H:i:s");
$fecha_hora_venta_producto               = date("H:i:s");
$fecha_remision                          = $matriz_info_imp_factura['fecha_remision'];
$nombre_ccosto                           = $matriz_info_imp_factura['nombre_ccosto'];
$garantia_meses                          = $matriz_info_imp_factura['garantia_meses'];
$observacion                             = $matriz_info_imp_factura['observacion'];
$cod_tipo_inventario                     = $matriz_info_imp_factura['cod_tipo_inventario'];
//$cod_administrador                       = $matriz_info_imp_factura['cod_administrador'];

$fecha_ymd_venta_producto                = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes_venta_producto                = date("Y-m", $fecha_anyo_seg);
$fecha_anyo_venta_producto               = date("Y", $fecha_anyo_seg);
$fecha_seg_venta_producto                = time();

if ($cod_tipo_inventario == '1') { $campo_und_inventario = 'und_producto'; } elseif ($cod_tipo_inventario == '2') { $campo_und_inventario = 'und_producto_bodega'; } else { $campo_und_inventario = 'und_producto'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_venta_producto_temporal = "SELECT SUM(und_venta * precio_venta_producto) AS total_precio_venta, SUM(und_venta * precio_costo_producto) AS total_precio_compra
FROM tbl15_transferencia_bodega_entrada_producto_temporal WHERE (cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada')";
$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
$datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal);

$total_precio_compra                     = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_precio_venta                      = $datos_total_venta_producto_temporal['total_precio_venta'];

$tiempo_final                            = microtime(true);
$tiempo_ejecucion                        = $tiempo_final - $tiempo_inicial;
$vlr_vuelto                              = 0 - 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------- LLAVE DE INICIO DEL CONDICIONAL VENDER POR CONTADO ------------------------------------------//
for ($i=0; $i < $total_datos; $i++) {

	$cod_transferencia_bodega_entrada_producto_temporal       = $_POST['cod_transferencia_bodega_entrada_producto_temporal'][$i];

	$sql_mconsulta = "SELECT * FROM tbl15_transferencia_bodega_entrada_producto_temporal WHERE (cod_transferencia_bodega_entrada_producto_temporal = '$cod_transferencia_bodega_entrada_producto_temporal')";
	$mconsulta = mysqli_query($conectar, $sql_mconsulta) or die(mysqli_error($conectar));
	$datos_temp = mysqli_fetch_assoc($mconsulta);

	$cod_producto                      = $datos_temp['cod_producto'];
	$cod_producto_barra                = $datos_temp['cod_producto_barra'];
	$nombre_tipo_precio_venta          = $datos_temp['nombre_tipo_precio_venta'];

	$sqlr_consulta = "SELECT und_producto, und_producto_bodega, iva_ptj, comision_ptj, cod_dependencia, precio_compra_producto, precio_costo_producto, cajas_sobre, und_sobre 
	FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
	$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
	$datos_prod = mysqli_fetch_assoc($modificar_consulta);
//-----------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------TIPO DE VENTA PUEDES SER MENUDIADO O POR UNIDADES----------------------------------------------------//
	$cod_producto                      = $datos_temp['cod_producto'];
	$cod_producto_barra                = $datos_temp['cod_producto_barra'];
	$nombre_producto                   = $datos_temp['nombre_producto'];
	$und_venta                         = $datos_temp['und_venta'];
	$und_compra                        = $und_venta;
	$unidades_total                    = $und_venta;
	$precio_compra_producto            = $datos_temp['precio_compra_producto'];
	$total_compra_producto             = $precio_compra_producto * $und_venta;
	$precio_costo_producto             = $datos_temp['precio_costo_producto'];
	$total_costo_producto              = $precio_costo_producto * $und_venta;
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
	$iva_ptj                           = $datos_prod['iva_ptj'];
	$und_producto_inv                  = $datos_prod['und_producto'];
	$und_producto_bodega_inv           = $datos_prod['und_producto_bodega'];
	$comision_ptj                      = $datos_prod['comision_ptj'];
	$cod_dependencia                   = $datos_prod['cod_dependencia'];
	$und_producto                      = $und_producto_inv + $und_venta;
	$precio_compra_producto_viejo      = $datos_prod['precio_compra_producto'];
	$precio_costo_producto_viejo       = $datos_prod['precio_costo_producto'];
	$cajas_sobre                       = $datos_prod['cajas_sobre'];
	$und_sobre                         = $datos_prod['und_sobre'];
	$precio_compra_producto_promedio   = $datos_temp['precio_compra_producto_promedio'];

	if ($cod_estado_promediar_precio_compra_y_venta_cargar_factura_global == '1') { 
		$precio_compra_producto_inv = $precio_compra_producto_promedio; 

		$actualiza_producto = sprintf("UPDATE tbl15_producto SET precio_compra_producto = '$precio_compra_producto_inv' WHERE cod_producto_barra = '$cod_producto_barra'");
		$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));
	} else { 
		$precio_compra_producto_inv = $precio_compra_producto; 
	}
//----------------------------- INSERTAR PRODUCTOS A LAS VENTAS -----------------------------//
	$agregar_reg_venta_producto = "INSERT INTO tbl15_transferencia_bodega_entrada_producto (cod_info_factura_transferencia_bodega_entrada, cod_empresa_transferencia_directa, cod_factura, cod_producto, cod_producto_barra, 
	nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, 
	total_venta_producto, nombre_tipo_producto, und_producto, und_producto_bodega_inv, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
	nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, nombre_tipo_presentacion,
	fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
	fecha_alerta, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, comision_ptj, 
	cod_tipo_pago, cod_tipo_forma_pago, total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, 
	cod_dependencia, cod_tipo_inventario, cod_tipo_producto_consumo, nombre_cliente, precio_compra_producto_promedio)
	VALUES ('$cod_info_factura_transferencia_bodega_entrada', '$cod_empresa_transferencia_directa', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
	'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', 
	'$total_venta_producto', '$nombre_tipo_producto', '$und_producto', '$und_producto_bodega_inv', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
	'$nombre_tipo_unidad_medida', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_presentacion',
	'$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
	'$fecha_alerta', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$comision_ptj', 
	'$cod_tipo_pago', '$cod_tipo_forma_pago', '$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', 
	'$cod_dependencia', '$cod_tipo_inventario', '$cod_tipo_producto_consumo', '$nombre_cliente', '$precio_compra_producto_promedio')";
	$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
	$actualiza_producto = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto', precio_venta_producto = '$precio_venta_producto' WHERE cod_producto_barra = '$cod_producto_barra'");
	$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));

	if ($cod_sino == '1') {
		$agregar_reg_compra_producto = "INSERT INTO tbl15_factura_compra_producto (cod_info_factura_compra, cod_tercero, cod_caja_virtual, 
		cod_producto, cod_producto_barra, nombre_producto, und_compra, und_producto, cajas_sobre, und_sobre, unidades_total, precio_compra_producto, 
		total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, total_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, 
		nombre_tipo_presentacion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, 
		fecha_alerta, nombre_tipo_precio_venta, comision_ptj, iva_ptj, precio_compra_producto_viejo, precio_costo_producto_viejo, 
		nombre_tipo_compra, nombre_tipo_cargue_factura, cod_administrador, cuenta, cod_tipo_inventario,
		cod_tipo_pago, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, cod_factura, cod_tipo_producto_consumo, cod_tipo_origen_factura_compra, precio_compra_producto_promedio)
		VALUES ('$cod_info_factura_compra', '$cod_tercero', '$cod_caja_virtual', 
		'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_compra', '$und_producto_inv', '$cajas_sobre', '$und_sobre', '$unidades_total', '$precio_compra_producto', 
		'$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', '$total_venta_producto', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', 
		'$nombre_tipo_presentacion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', 
		'$fecha_alerta', '$nombre_tipo_precio_venta', '$comision_ptj', '$iva_ptj', '$precio_compra_producto_viejo', '$precio_costo_producto_viejo', 
		'$nombre_tipo_compra', '$nombre_tipo_cargue_factura', '$cod_administrador', '$cuenta', '$cod_tipo_inventario', 
		'$cod_tipo_pago', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_factura', '$cod_tipo_producto_consumo', '$cod_tipo_origen_factura_compra', '$precio_compra_producto_promedio')";
		$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));
	}
}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//   
$agregar_regis = sprintf("UPDATE tbl15_info_factura_transferencia_bodega_entrada SET cod_estado_factura = '$cod_estado_factura', cod_factura = '$cod_factura', fecha_anyo = '$fecha_anyo', 
fecha_dia = '$fecha_dia',fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', total_precio_compra = '$total_precio_compra', 
total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data', cod_tercero = '$cod_tercero', nombre_estado_factura = '$nombre_estado_factura',
cuenta = '$cuenta', cod_tipo_pago = '$cod_tipo_pago', cod_administrador = '$cod_administrador', 
cod_tipo_forma_pago = '$cod_tipo_forma_pago', nombre_tipo_factura = '$nombre_tipo_factura',  nombre_tipo_moneda = '$nombre_tipo_moneda', 
nombre_maquina = '$nombre_maquina', tiempo_ejecucion = '$tiempo_ejecucion', cod_tipo_producto_consumo = '$cod_tipo_producto_consumo', 
nombre_empresa = '$nombre_empresa', razonsocial_empresa = '$razonsocial_empresa' 
WHERE cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada'");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

if ($cod_sino == '1') {
	$agregar_reg_compra_producto = "INSERT INTO tbl15_info_factura_compra (cod_info_factura_compra, total, subtotal_total_precio_compra, 
	subtotal_total_precio_costo, total_factura_compra, total_precio_costo, cod_estado_factura, cod_factura, fecha_anyo, fecha_dia, fecha_mes, anyo, 
	fecha_hora, total_precio_compra, total_precio_venta, total_datos_data, cod_tercero, nombre_estado_factura, cuenta, 
	cod_tipo_pago, cod_administrador, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, 
	nombre_tipo_cargue_factura, nombre_rete_fuente_ptj, ret_ica_ptj, subtotal, valor_iva, total_descuento, 
	total_factura_compra_retefuente, total_inv_precio_costo, total_inv_precio_compra, total_inv_precio_venta, total_inv_compra_desp_factura,
	total_compra_precio_costo, total_compra_precio_compra, total_compra_precio_venta, cod_tipo_producto_consumo, cod_tipo_inventario, cod_tipo_origen_factura_compra)
	VALUES ('$cod_info_factura_compra', '$total', '$subtotal_total_precio_compra', 
	'$subtotal_total_precio_costo', '$total_factura_compra', '$total_precio_costo', '$cod_estado_factura', '$cod_factura', '$fecha_anyo', '$fecha_dia', '$fecha_mes', '$anyo', 
	'$fecha_hora', '$total_precio_compra', '$total_precio_venta', '$total_datos_data', '$cod_tercero', '$nombre_estado_factura', '$cuenta', 
	'$cod_tipo_pago', '$cod_administrador', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', 
	'$nombre_tipo_cargue_factura', '$nombre_rete_fuente_ptj', '$ret_ica_ptj', '$subtotal', '$valor_iva', '$total_descuento', 
	'$total_factura_compra_retefuente', '$total_inv_precio_costo', '$total_inv_precio_compra', '$total_inv_precio_venta', '$total_inv_compra_desp_factura',
	'$total_compra_precio_costo', '$total_compra_precio_compra', '$total_compra_precio_venta', '$cod_tipo_producto_consumo', '$cod_tipo_inventario', '$cod_tipo_origen_factura_compra')";
	$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));
}

//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
$borrar_sql = sprintf("DELETE FROM tbl15_transferencia_bodega_entrada_producto_temporal WHERE (cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$url_redir = "../admin/transferenica_bodega_entrada_productos_opcion_imprimir.php?cod_info_factura_transferencia_bodega_entrada=".$cod_info_factura_transferencia_bodega_entrada."&cod_tipo_pago=".$cod_tipo_pago."&pagina=".$pagina;
header("Location: $url_redir");
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
?>