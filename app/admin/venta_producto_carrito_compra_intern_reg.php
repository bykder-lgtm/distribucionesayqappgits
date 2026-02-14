<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_ext.php");

$cuenta_actual                                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                             = $_SESSION['usuario'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_info_factura_venta_carrito_compra        = intval($_POST['cod_info_factura_venta_carrito_compra']);
$cod_tercero                                  = 1;
$nombre_tipo_moneda                           = 'COP';
$nombre_tipo_factura                          = 'POS';
$cod_tipo_pago                                = '1';
$total_datos                                  = count($_POST['cod_carrito_compra_temporal']);
//$pagina                                       = addslashes($_POST['pagina']);
$fecha_anyo                                   = date("Y-m-d");
$fecha_dia                                    = date("Y-m-d");
$fecha_mes                                    = date("Y-m");
$anyo                                         = date("Y");
$fecha_hora                                   = date("Y-m-d");
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['nombre1_tercero'])) { $nombre1_tercero = addslashes($_POST['nombre1_tercero']); } else { $nombre1_tercero = ''; }
if (isset($_POST['telefono1_tercero'])) { $telefono1_tercero = addslashes($_POST['telefono1_tercero']); } else { $telefono1_tercero = ''; }
if (isset($_POST['correo_tercero'])) { $correo_tercero = addslashes($_POST['correo_tercero']); } else { $correo_tercero = ''; }
if (isset($_POST['direccion_tercero'])) { $direccion_tercero = addslashes($_POST['direccion_tercero']); } else { $direccion_tercero = ''; }
if (isset($_POST['observacion'])) { $observacion = addslashes($_POST['observacion']); } else { $observacion = ''; }
if (isset($_POST['direcion_misma_factura'])) { $direcion_misma_factura = addslashes($_POST['direcion_misma_factura']); } else { $direcion_misma_factura = ''; }
if (isset($_POST['guarda_info_prox'])) { $guarda_info_prox = addslashes($_POST['guarda_info_prox']); } else { $guarda_info_prox = ''; }
if (isset($_POST['cod_info_factura_venta_carrito_compra_codifcryp'])) { $cod_info_factura_venta_carrito_compra_codifcryp = addslashes($_POST['cod_info_factura_venta_carrito_compra_codifcryp']); } else { $cod_info_factura_venta_carrito_compra_codifcryp = ''; }
if (isset($_POST['nombre_tipo_entrega'])) { $nombre_tipo_entrega = addslashes($_POST['nombre_tipo_entrega']); } else { $nombre_tipo_entrega = ''; }
if (isset($_POST['cod_factura_codifcryp'])) { $cod_factura_codifcryp = addslashes($_POST['cod_factura_codifcryp']); } else { $cod_factura_codifcryp = ''; }
if (isset($_POST['accion_codifcryp'])) { $accion_codifcryp = addslashes($_POST['accion_codifcryp']); } else { $accion_codifcryp = ''; }
if (isset($_POST['tipo_codifcryp'])) { $tipo_codifcryp = addslashes($_POST['tipo_codifcryp']); } else { $tipo_codifcryp = ''; }
if (isset($_POST['origen_codifcryp'])) { $origen_codifcryp = addslashes($_POST['origen_codifcryp']); } else { $origen_codifcryp = ''; }
if (isset($_POST['cod_tipo_forma_pago'])) { $cod_tipo_forma_pago = intval($_POST['cod_tipo_forma_pago']); } else { $cod_tipo_forma_pago = '0'; }
if (isset($_POST['cod_zona_envio'])) { $cod_zona_envio = intval($_POST['cod_zona_envio']); } else { $cod_zona_envio = '0'; }
if (isset($_POST['cod_tipo_aplicacion'])) { $cod_tipo_aplicacion = intval($_POST['cod_tipo_aplicacion']); } else { $cod_tipo_aplicacion = '0'; }
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_anyo_seg                               = strtotime($fecha_anyo);
$total_datos_data                             = $total_datos;
$nombre_estado_factura                        = 'CERRADA';
$nombre_maquina                               = gethostname();
$cod_check_imp                                = '1';
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_imp_factura = "SELECT * FROM tbl15_info_factura_venta_carrito_compra WHERE cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra'";
$modificar_info_imp_factura = mysqli_query($conectar, $sql_info_imp_factura) or die(mysqli_error($conectar));
$total_encontrado_info_imp_factura = mysqli_num_rows($modificar_info_imp_factura);
$matriz_info_imp_factura  = mysqli_fetch_assoc($modificar_info_imp_factura);

//$nombre1_tercero                              = $matriz_info_imp_factura['nombre1_tercero'];
$nombre2_tercero                              = $matriz_info_imp_factura['nombre2_tercero'];
$apellido1_tercero                            = $matriz_info_imp_factura['apellido1_tercero'];
$apellido2_tercero                            = $matriz_info_imp_factura['apellido2_tercero'];
$identificacion_tercero                       = $matriz_info_imp_factura['identificacion_tercero'];
$fecha_nac_tercero                            = $matriz_info_imp_factura['fecha_nac_tercero'];
//$direccion_tercero                            = $matriz_info_imp_factura['direccion_tercero'];
//$telefono1_tercero                            = $matriz_info_imp_factura['telefono1_tercero'];
//$correo_tercero                               = $matriz_info_imp_factura['correo_tercero'];
$fecha_ymdhis                                 = $matriz_info_imp_factura['fecha_ymdhis'];

$latitud                                      = $matriz_info_imp_factura['latitud'];
$longitud                                     = $matriz_info_imp_factura['longitud'];
$latitud_longitud                             = $matriz_info_imp_factura['latitud_longitud'];
$cod_base_caja                                = $matriz_info_imp_factura['cod_base_caja'];

$cod_tipo_metodo_envio                        = $matriz_info_imp_factura['cod_tipo_metodo_envio'];
//$cod_tipo_aplicacion                          = $matriz_info_imp_factura['cod_tipo_aplicacion'];
//$cod_zona_envio                               = $matriz_info_imp_factura['cod_zona_envio'];

$cuenta                                       = $cuenta_actual;
$cod_estado_factura                           = '0';
$descuento_ptj                                = '0';
$iva_ptj                                      = '0';
$flete_ptj                                    = '0';
//$cod_cliente                                  = '0';
$vlr_vuelto                                   = '0';
$fecha_dia                                    = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                                    = date("Y-m", $fecha_anyo_seg);
$anyo                                         = date("Y", $fecha_anyo_seg);
$fecha_hora                                   = date("H:i:s");
$fecha_hora_venta_producto                    = date("H:i:s");
$fecha_remision                               = $matriz_info_imp_factura['fecha_remision'];
$nombre_ccosto                                = $matriz_info_imp_factura['nombre_ccosto'];
$garantia_meses                               = $matriz_info_imp_factura['garantia_meses'];
//$observacion                                  = $matriz_info_imp_factura['observacion'];
$cod_tipo_inventario                          = $matriz_info_imp_factura['cod_tipo_inventario'];
$fecha_ymd_venta_producto                     = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes_venta_producto                     = date("Y-m", $fecha_anyo_seg);
$fecha_anyo_venta_producto                    = date("Y", $fecha_anyo_seg);
$fecha_seg_venta_producto                     = time();
$cod_administrador                            = $matriz_info_imp_factura['cod_administrador'];
$cod_administrador_tercero                    = $matriz_info_imp_factura['cod_administrador_tercero'];
$url_img_orig_soporte_visitante               = $matriz_info_imp_factura['url_img_orig_soporte_visitante'];
$url_img_min_soporte_visitante                = $matriz_info_imp_factura['url_img_min_soporte_visitante'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_animal = "SELECT MAX(cod_caja_virtual) AS cod_caja_virtual FROM tbl15_venta_producto_temporal";
$resultado_animal = mysqli_query($conectar, $sql_animal);
$info_animal = mysqli_fetch_assoc($resultado_animal);

$cod_caja_virtual                             = $info_animal['cod_caja_virtual']+1;
//$cod_caja_virtual                             = $_SESSION['cod_caja_virtual'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_caja_mesa = "SELECT cod_administrador FROM tbl15_caja_mesa WHERE cod_base_caja = '$cod_base_caja'";
$modificar_caja_mesa = mysqli_query($conectar, $sql_caja_mesa) or die(mysqli_error($conectar));
$existe_usuario_asigando_mesa_caja = mysqli_num_rows($modificar_caja_mesa);
$matriz_caja_mesa  = mysqli_fetch_assoc($modificar_caja_mesa);
/*
if ($existe_usuario_asigando_mesa_caja == '0') {
	$cod_administrador = 1;
	$cuenta                                   = 'administrador';
} else {
	$cod_administrador = $matriz_caja_mesa['cod_administrador'];

	$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
	$modificar_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
	$matriz_administrador  = mysqli_fetch_assoc($modificar_administrador);

	$cuenta                                   = $matriz_administrador['cuenta'];
}
*/
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_venta_producto_temporal = "SELECT SUM(und_venta * precio_venta_producto) AS total_precio_venta, SUM(und_venta * precio_costo_producto) AS total_precio_compra
FROM tbl15_carrito_compra_temporal WHERE (cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra')";
$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
$datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal);

$total_precio_compra               = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_precio_venta                = $datos_total_venta_producto_temporal['total_precio_venta'];

$tiempo_final                      = microtime(true);
$tiempo_ejecucion                  = $tiempo_final - $tiempo_inicial;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA')";
$consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
$datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

$cod_prioridad                      = $datos_max_prioridad['cod_prioridad']+1;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

$cod_info_factura_venta             = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
//---------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------- LLAVE DE INICIO DEL CONDICIONAL VENDER POR CONTADO ------------------------------------------//
$sql_mconsulta = "SELECT * FROM tbl15_carrito_compra_temporal WHERE (cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra')";
$mconsulta = mysqli_query($conectar, $sql_mconsulta) or die(mysqli_error($conectar));
while ($datos_temp = mysqli_fetch_assoc($mconsulta)) {

	$cod_producto                               = $datos_temp['cod_producto'];
	$cod_producto_barra                         = $datos_temp['cod_producto_barra'];
	$nombre_tipo_precio_venta                   = $datos_temp['nombre_tipo_precio_venta'];

	$sqlr_consulta = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
	$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
	$datos_prod = mysqli_fetch_assoc($modificar_consulta);
	//-----------------------------------------------------------------------------------------------------------------------------------------//
	//------------------------------------TIPO DE VENTA PUEDES SER MENUDIADO O POR UNIDADES----------------------------------------------------//
	$cod_producto                               = $datos_temp['cod_producto'];
	$cod_producto_barra                         = $datos_temp['cod_producto_barra'];
	$nombre_producto                            = $datos_temp['nombre_producto'];
	$und_venta                                  = $datos_temp['und_venta'];
	$precio_compra_producto                     = $datos_temp['precio_compra_producto'];
	$total_compra_producto                      = $precio_compra_producto * $und_venta;
	$precio_costo_producto                      = $datos_temp['precio_costo_producto'];
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
	$fecha_alerta                               = $datos_temp['fecha_alerta'];
	$iva_ptj                                    = $datos_prod['iva_ptj'];
	$und_producto_inv                           = $datos_prod['und_producto'];
	$comision_ptj                               = $datos_prod['comision_ptj'];
	$cod_dependencia                            = $datos_prod['cod_dependencia'];
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
	$cod_categoria                              = $datos_prod['cod_categoria'];
	$cod_categoria_sub                          = $datos_prod['cod_categoria_sub'];
	$cod_tipo_producto_cocina                   = $datos_prod['cod_tipo_producto_cocina'];
	$descuento_valor_pesos                      = $precio_venta_producto_orig - $precio_venta_producto;
	//$descuento_ptj                              = ($descuento_valor_pesos / $precio_venta_producto_orig) * 100;
	$und_producto                               = $und_producto_inv - $und_venta;
	//----------------------------- INSERTAR PRODUCTOS A LAS VENTAS -----------------------------//
	$sql_data = "INSERT INTO tbl15_venta_producto_temporal (cod_info_factura_venta, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_venta, 
	precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, 
	precio_venta_producto, total_venta_producto, posologia_cantidad, posologia_peso, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_presentacion, 
	nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
	cod_administrador, cod_caja_virtual, nombre_tipo_precio_venta, 
	precio_venta_producto_orig, und_producto, cod_base_caja, cod_opcion_descontable_inv, cod_categoria, cod_categoria_sub, cod_tipo_producto_cocina, cod_check_imp, cod_administrador_tercero) 
	VALUES ('$cod_info_factura_venta', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', 
	'$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', 
	'$precio_venta_producto', '$total_venta_producto', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_presentacion', 
	'$nombre_via_administracion', '$nombre_frec_duracion', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
	'$cod_administrador', '$cod_caja_virtual', '$nombre_tipo_precio_venta',
	'$precio_venta_producto_orig', '$und_producto', '$cod_base_caja', '$cod_opcion_descontable_inv', '$cod_categoria', '$cod_categoria_sub', '$cod_tipo_producto_cocina', '$cod_check_imp', '$cod_administrador_tercero')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$agregar_reg_venta_producto = "INSERT INTO tbl15_carrito_compra (cod_info_factura_venta_carrito_compra, cod_info_factura_venta, cod_producto, cod_producto_barra, 
	nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, 
	total_venta_producto, nombre_tipo_producto, und_producto, fecha_ymd_venta_producto, 
	nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, nombre_tipo_presentacion,
	fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
	fecha_alerta, iva_ptj, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, comision_ptj, 
	precio_venta_producto_orig, comentario_producto, 
	fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin, placa_producto, 
	cod_parqueo_cotizacion_venta_producto, cod_info_parqueo_cotizacion_factura_venta, cod_info_hotel_cotizacion_factura_venta, cod_hotel_cotizacion_venta_producto, 
	cod_opcion_descontable_inv, cod_categoria, cod_administrador_tercero)
	VALUES ('$cod_info_factura_venta_carrito_compra', '$cod_info_factura_venta', '$cod_producto', '$cod_producto_barra', 
	'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', 
	'$total_venta_producto', '$nombre_tipo_producto', '$und_producto', '$fecha_ymd_venta_producto',
	'$nombre_tipo_unidad_medida', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_presentacion',
	'$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
	'$fecha_alerta', '$iva_ptj', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$comision_ptj', 
	'$precio_venta_producto_orig', '$comentario_producto', 
	'$fecha_ymd_parqueo_ini', '$fecha_hora_parqueo_ini', '$fecha_ymd_parqueo_fin', '$fecha_hora_parqueo_fin', '$placa_producto', 
	'$cod_parqueo_cotizacion_venta_producto', '$cod_info_parqueo_cotizacion_factura_venta', '$cod_info_hotel_cotizacion_factura_venta', '$cod_hotel_cotizacion_venta_producto', 
	'$cod_opcion_descontable_inv', '$cod_categoria', '$cod_administrador_tercero')";
	$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));
	//----------------------------------------------------------------------- ---------------------------------------------------------//
}
$sql_data = "INSERT INTO tbl15_info_factura_venta (cod_info_factura_venta, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_tipo_forma_pago, nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_prioridad, 
cod_base_caja, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, identificacion_tercero, fecha_nac_tercero, direccion_tercero, telefono1_tercero, 
correo_tercero, cod_info_factura_venta_carrito_compra, cod_tipo_metodo_envio, cod_tipo_aplicacion, observacion, 
latitud, longitud, latitud_longitud, cod_zona_envio, nombre_tipo_entrega, direcion_misma_factura, guarda_info_prox, cod_administrador_tercero, total_precio_venta, 
url_img_orig_soporte_visitante, url_img_min_soporte_visitante) 
VALUES ('$cod_info_factura_venta', 'ABIERTA', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_tipo_forma_pago', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_prioridad', 
'$cod_base_caja', '$nombre1_tercero', '$nombre2_tercero', '$apellido1_tercero', '$apellido2_tercero', '$identificacion_tercero', '$fecha_nac_tercero', '$direccion_tercero', '$telefono1_tercero', 
'$correo_tercero', '$cod_info_factura_venta_carrito_compra', '$cod_tipo_metodo_envio', '$cod_tipo_aplicacion', '$observacion', 
'$latitud', '$longitud', '$latitud_longitud', '$cod_zona_envio', '$nombre_tipo_entrega', '$direcion_misma_factura', '$guarda_info_prox', '$cod_administrador_tercero', '$total_precio_venta', 
'$url_img_orig_soporte_visitante', '$url_img_min_soporte_visitante')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$agregar_regis = sprintf("UPDATE tbl15_info_factura_venta_carrito_compra SET cod_info_factura_venta = '$cod_info_factura_venta', fecha_anyo = '$fecha_anyo', 
fecha_dia = '$fecha_dia',fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', total_precio_compra = '$total_precio_compra', 
total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data', cod_tercero = '$cod_tercero', nombre_estado_factura = '$nombre_estado_factura',
cuenta = '$cuenta_visitante', cod_tipo_pago = '$cod_tipo_pago', cod_administrador = '$cod_administrador', 
cod_tipo_forma_pago = '$cod_tipo_forma_pago', nombre_tipo_factura = '$nombre_tipo_factura',  nombre_tipo_moneda = '$nombre_tipo_moneda', 
nombre_maquina = '$nombre_maquina', tiempo_ejecucion = '$tiempo_ejecucion', observacion = '$observacion', 
cod_tipo_metodo_envio = '$cod_tipo_metodo_envio', cod_tipo_aplicacion = '$cod_tipo_aplicacion', cod_zona_envio = '$cod_zona_envio', 
nombre_tipo_entrega = '$nombre_tipo_entrega', direcion_misma_factura = '$direcion_misma_factura', guarda_info_prox = '$guarda_info_prox', cod_administrador_tercero = '$cod_administrador_tercero' 
WHERE cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra'");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

$actualizar_sql1 = "UPDATE tbl15_nota_observacion SET cod_info_factura_venta = '$cod_info_factura_venta' WHERE (cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra')";
$resultado_actualizacion1 = mysqli_query($conectar, $actualizar_sql1) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM tbl15_carrito_compra_temporal WHERE (cod_info_factura_venta_carrito_compra = '$cod_info_factura_venta_carrito_compra')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$url_redir = "../admin/venta_productos_visitante_intern_opcion_imprimir.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_info_factura_venta_carrito_compra=".$cod_info_factura_venta_carrito_compra;
header("Location: $url_redir");
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
?>