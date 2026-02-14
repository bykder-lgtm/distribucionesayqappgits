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
$cod_info_gasto_inmueble_detalle_venta        = intval($_POST['cod_info_gasto_inmueble_detalle_venta']);
$fecha_anyo                                   = addslashes($_POST['fecha_anyo']);
$cod_tercero                                  = intval($_POST['cod_tercero']);
$nombre_tipo_moneda                           = addslashes($_POST['nombre_tipo_moneda']);
$nombre_tipo_factura                          = addslashes($_POST['nombre_tipo_factura']);
$cod_tipo_forma_pago                          = intval($_POST['cod_tipo_forma_pago']);
$cod_administrador                            = intval($_POST['cod_administrador']);
$total_datos                                  = intval($_POST['total_datos']);
$vlr_cancelado                                = addslashes($_POST['vlr_cancelado']);
$observacion_tercero                          = addslashes($_POST['observacion_tercero']);
$pagina                                       = addslashes($_POST['pagina']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_tipo_pago'])) { $cod_tipo_pago = intval($_POST['cod_tipo_pago']); } else { $cod_tipo_pago = '1'; }
if (isset($_POST['cod_tipo_metodo_envio'])) { $cod_tipo_metodo_envio = addslashes($_POST['cod_tipo_metodo_envio']); } else { $cod_tipo_metodo_envio = '1'; }
if (isset($_POST['nombre1_tercero'])) { $nombre1_tercero = addslashes($_POST['nombre1_tercero']); } else { $nombre1_tercero = ''; }
if (isset($_POST['fecha_entrega'])) { $fecha_entrega = addslashes($_POST['fecha_entrega']); } else { $fecha_entrega = ''; }
if (isset($_POST['descripcion_tipo_forma_pago'])) { $descripcion_tipo_forma_pago = addslashes($_POST['descripcion_tipo_forma_pago']); } else { $descripcion_tipo_forma_pago = ''; }
if (isset($_POST['fecha_pago'])) { $fecha_pago = addslashes($_POST['fecha_pago']); } else { $fecha_pago = ''; }
if (isset($_FILES['url_img1']) <> '') { $url_img1 = $_FILES['url_img1']['name']; } else { $url_img1 = ''; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_ymdHis                    = date("YmdHis");
$ruta_firma_miniatura            = '../archivador/firma/miniatura/';
$ruta_foto_miniatura             = '../archivador/foto/miniatura/';
$ruta_firma_orig                 = '../archivador/firma/original/';
$ruta_foto_orig                  = '../archivador/documentos/';
/* ----------------------------------------------------------------------------------------------------------/ */
if ($url_img1 <> '') { 
$formato_img2                    = explode(".", $url_img1);
$formato_img2                    = end($formato_img2);
$nombre_normal2                  = $fecha_ymdHis.'_'.$cod_info_gasto_inmueble_detalle_venta.'_'.$cod_tercero.'_'.$cod_administrador.'.'.$formato_img2;
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
$fecha_anyo_seg                = strtotime($fecha_anyo);
$total_datos_data              = $total_datos;
$nombre_estado_factura         = 'CERRADA';
$nombre_maquina                = gethostname();
$fecha_pago_abono              = date("Y-m-d");
$fecha                         = date("Y-m-d");
$fecha_invert                  = date("Y-m-d");
$fecha_seg                     = time();
$fecha_creacion                = date("Y-m-d H:i:s");
$fecha_hoy                     = date("Y-m-d");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_admin_user_dep = "SELECT cod_dependencia_user, cod_tipo_aplicacion FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_admin_user_dep = mysqli_query($conectar, $sql_admin_user_dep);
$info_admin_user_dep = mysqli_fetch_assoc($resultado_admin_user_dep);

$cod_dependencia_user                     = $info_admin_user_dep['cod_dependencia_user'];
$cod_tipo_aplicacion                      = $info_admin_user_dep['cod_tipo_aplicacion'];

if ($cod_tipo_aplicacion == '0') {
$pagina_redirect_imprimir = '../admin/venta_productos_opcion_imprimir.php'; 
} elseif ($cod_tipo_aplicacion == '3') {
$pagina_redirect_imprimir = '../admin/venta_productos_opcion_imprimir_version_tactil.php'; 
} else {
$pagina_redirect_imprimir = '../admin/venta_productos_opcion_imprimir.php'; 
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT cod_estado_subproducto_global, cod_estado_venta_dependencia_de_usuario_global, cod_estado_tipo_venta_zapateria_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_subproducto_global                     = $info_empresa_data['cod_estado_subproducto_global'];
$cod_estado_venta_dependencia_de_usuario_global    = $info_empresa_data['cod_estado_venta_dependencia_de_usuario_global'];
$cod_estado_tipo_venta_zapateria_global            = $info_empresa_data['cod_estado_tipo_venta_zapateria_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion 
WHERE (nombre_tipo_resolucion_facturacion = '$nombre_tipo_factura') AND (nombre_tipo_estado = 'ACTIVO')";
$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

$cod_resolucion_facturacion       = intval($matriz_resol_fact['cod_resolucion_facturacion']);

$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_gasto_inmueble_detalle_venta 
WHERE (nombre_tipo_factura = '$nombre_tipo_factura') AND (nombre_estado_factura = 'CERRADA')";
$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

$cod_factura                         = $maxima_factura['cod_factura']+1;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_imp_factura = "SELECT * FROM tbl15_info_gasto_inmueble_detalle_venta WHERE cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta'";
$modificar_info_imp_factura = mysqli_query($conectar, $sql_info_imp_factura) or die(mysqli_error($conectar));
$total_encontrado_info_imp_factura = mysqli_num_rows($modificar_info_imp_factura);
$matriz_info_imp_factura  = mysqli_fetch_assoc($modificar_info_imp_factura);

$fecha_ymdhis                      = $matriz_info_imp_factura['fecha_ymdhis'];
//$cuenta                            = $cuenta_actual;
$cod_estado_factura                = '0';
$descuento_ptj                     = '0';
$iva_ptj                           = '0';
$flete_ptj                         = '0';
//$cod_cliente                       = '0';
$vlr_vuelto                        = '0';
$fecha_dia                         = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                         = date("Y-m", $fecha_anyo_seg);
$anyo                              = date("Y", $fecha_anyo_seg);
$fecha_hora                        = date("H:i:s");
$fecha_hora_venta_producto         = date("H:i:s");
$fecha_remision                    = $matriz_info_imp_factura['fecha_remision'];
$nombre_ccosto                     = $matriz_info_imp_factura['nombre_ccosto'];
$garantia_meses                    = $matriz_info_imp_factura['garantia_meses'];
$observacion                       = $matriz_info_imp_factura['observacion'];
$cod_tipo_inventario               = $matriz_info_imp_factura['cod_tipo_inventario'];

$fecha_ymd_venta_producto          = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes_venta_producto          = date("Y-m", $fecha_anyo_seg);
$fecha_anyo_venta_producto         = date("Y", $fecha_anyo_seg);
$fecha_seg_venta_producto          = time();
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_venta_producto_temporal = "SELECT SUM(und_venta * precio_venta_producto) AS total_precio_venta, SUM(und_venta * precio_costo_producto) AS total_precio_compra
FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta')";
$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
$datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal);

$total_precio_compra               = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_precio_venta                = $datos_total_venta_producto_temporal['total_precio_venta'];

$tiempo_final                      = microtime(true);
$tiempo_ejecucion                  = $tiempo_final - $tiempo_inicial;
$vlr_vuelto                        = $vlr_cancelado - $total_precio_venta;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------- LLAVE DE INICIO DEL CONDICIONAL VENDER POR CONTADO ------------------------------------------//
$sql_mconsulta = "SELECT * FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta')";
$mconsulta = mysqli_query($conectar, $sql_mconsulta) or die(mysqli_error($conectar));
while ($datos_temp = mysqli_fetch_assoc($mconsulta)) {

	$cod_producto                               = $datos_temp['cod_producto'];
	$cod_producto_barra                         = $datos_temp['cod_producto_barra'];
	$nombre_tipo_precio_venta                   = $datos_temp['nombre_tipo_precio_venta'];

	$sqlr_consulta = "SELECT und_producto, und_producto_bodega, iva_ptj, comision_ptj, cod_dependencia, cod_opcion_descontable_inv, precio_compra_producto, precio_costo_producto, nombre_tipo_compra 
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
	$iva_ptj                                    = $datos_prod['iva_ptj'];
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
	$nombre_tipo_und_caja_sobre                 = $datos_temp['nombre_tipo_und_caja_sobre'];
	 
	$descuento_valor_pesos                      = $precio_venta_producto_orig - $precio_venta_producto;
//--------------------------------------------------------------------------------------------//
//----------------------------- INSERTAR PRODUCTOS A LAS VENTAS -----------------------------//
	$agregar_reg_venta_producto = "INSERT INTO tbl15_gasto_inmueble_detalle_venta (cod_info_gasto_inmueble_detalle_venta, cod_factura, cod_producto, cod_producto_barra, 
	nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, 
	total_venta_producto, nombre_tipo_producto, und_producto_bodega_inv, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
	nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, nombre_tipo_presentacion,
	fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
	fecha_alerta, cod_resolucion_facturacion, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, comision_ptj, 
	cod_tipo_pago, cod_tipo_forma_pago, total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, vlr_cancelado, vlr_vuelto, 
	cod_dependencia, cod_tipo_inventario, precio_venta_producto_orig, descuento_ptj, comentario_producto, 
	fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin, placa_producto, 
	cod_parqueo_cotizacion_venta_producto, cod_info_parqueo_cotizacion_factura_venta, cod_info_hotel_cotizacion_factura_venta, cod_hotel_cotizacion_venta_producto, 
	cod_opcion_descontable_inv, cod_categoria, cod_categoria_sub, cod_tipo_producto_cocina, nombre_tipo_precio, nombre_tipo_compra, cod_tipo_metodo_envio, 
	peso_producto, unidad_medida_peso, cod_estado_cava, und_caja_sobre, nombre_tipo_und_caja_sobre)
	VALUES ('$cod_info_gasto_inmueble_detalle_venta', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
	'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', 
	'$total_venta_producto', '$nombre_tipo_producto', '$und_producto_bodega_inv', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
	'$nombre_tipo_unidad_medida', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_presentacion',
	'$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
	'$fecha_alerta', '$cod_resolucion_facturacion', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$comision_ptj', 
	'$cod_tipo_pago', '$cod_tipo_forma_pago', '$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$vlr_cancelado', '$vlr_vuelto', 
	'$cod_dependencia', '$cod_tipo_inventario', '$precio_venta_producto_orig', '$descuento_ptj', '$comentario_producto', 
	'$fecha_ymd_parqueo_ini', '$fecha_hora_parqueo_ini', '$fecha_ymd_parqueo_fin', '$fecha_hora_parqueo_fin', '$placa_producto', 
	'$cod_parqueo_cotizacion_venta_producto', '$cod_info_parqueo_cotizacion_factura_venta', '$cod_info_hotel_cotizacion_factura_venta', '$cod_hotel_cotizacion_venta_producto', 
	'$cod_opcion_descontable_inv', '$cod_categoria', '$cod_categoria_sub', '$cod_tipo_producto_cocina', '$nombre_tipo_precio', '$nombre_tipo_compra', '$cod_tipo_metodo_envio', 
	'$peso_producto', '$unidad_medida_peso', '$cod_estado_cava', '$und_caja_sobre', '$nombre_tipo_und_caja_sobre')";
	$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));
}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
$borrar_sql = sprintf("DELETE FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cod_info_gasto_inmueble_detalle_venta = '$cod_info_gasto_inmueble_detalle_venta')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
$url_redir = $pagina_redirect_imprimir."?cod_info_gasto_inmueble_detalle_venta=".$cod_info_gasto_inmueble_detalle_venta."&cod_tipo_pago=".$cod_tipo_pago."&pagina=".$pagina;
header("Location: $url_redir");
}
else { 
//$url_redir = "../admin/venta_productos_valor_cancelado_demasiado_grande.php?cod_info_gasto_inmueble_detalle_venta=".$cod_info_gasto_inmueble_detalle_venta."&cod_tipo_pago=".$cod_tipo_pago."&total_precio_venta=".$total_precio_venta."&vlr_cancelado=".$vlr_cancelado."&pagina=".$pagina;
//header("Location: $url_redir");
}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
?>