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
$cod_info_parqueo_cotizacion_factura_venta        = intval($_POST['cod_info_parqueo_cotizacion_factura_venta']);
$fecha_anyo                               = addslashes($_POST['fecha_anyo']);
$cod_tercero                              = intval($_POST['cod_tercero']);
$nombre_tipo_moneda                       = addslashes($_POST['nombre_tipo_moneda']);
$nombre_tipo_factura                      = addslashes($_POST['nombre_tipo_factura']);
$cod_tipo_forma_pago                      = intval($_POST['cod_tipo_forma_pago']);
$cod_tipo_pago                            = intval($_POST['cod_tipo_pago']);
$cod_administrador                        = intval($_POST['cod_administrador']);
$total_datos                              = intval($_POST['total_datos']);
$cod_tipo_cotizacion                      = intval($_POST['cod_tipo_cotizacion']);
$vlr_cancelado                            = addslashes($_POST['vlr_cancelado']);
$pagina                                   = addslashes($_POST['pagina']);
$fecha_anyo_seg                           = strtotime($fecha_anyo);
$total_datos_data                         = $total_datos;
$nombre_estado_factura                    = 'CERRADA';
$nombre_maquina                           = gethostname();

$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion 
WHERE (nombre_tipo_resolucion_facturacion = '$nombre_tipo_factura') AND (nombre_tipo_estado = 'ACTIVO')";
$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

$cod_resolucion_facturacion       = intval($matriz_resol_fact['cod_resolucion_facturacion']);

$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_parqueo_cotizacion_factura_venta 
WHERE (cod_tipo_cotizacion = '$cod_tipo_cotizacion') AND (nombre_estado_factura = '$nombre_estado_factura')";
$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

$cod_factura                         = $maxima_factura['cod_factura']+1;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_imp_factura = "SELECT * FROM tbl15_info_parqueo_cotizacion_factura_venta WHERE cod_info_parqueo_cotizacion_factura_venta = '$cod_info_parqueo_cotizacion_factura_venta'";
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
//$cod_administrador                 = $matriz_info_imp_factura['cod_administrador'];

$fecha_ymd_venta_producto          = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes_venta_producto          = date("Y-m", $fecha_anyo_seg);
$fecha_anyo_venta_producto         = date("Y", $fecha_anyo_seg);
$fecha_seg_venta_producto          = time();
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_venta_producto_temporal = "SELECT SUM(und_venta * precio_venta_producto) AS total_precio_venta, SUM(und_venta * precio_costo_producto) AS total_precio_compra
FROM tbl15_parqueo_cotizacion_venta_producto_temporal WHERE (cod_info_parqueo_cotizacion_factura_venta = '$cod_info_parqueo_cotizacion_factura_venta')";
$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
$datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal);

$total_precio_compra               = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_precio_venta                = $datos_total_venta_producto_temporal['total_precio_venta'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------- LLAVE DE INICIO DEL CONDICIONAL VENDER POR CONTADO ------------------------------------------//
if (isset($_POST['cod_info_parqueo_cotizacion_factura_venta'])) {

for ($i=0; $i < $total_datos; $i++) {

$cod_parqueo_cotizacion_venta_producto_temporal       = $_POST['cod_parqueo_cotizacion_venta_producto_temporal'][$i];

$sql_mconsulta = "SELECT * FROM tbl15_parqueo_cotizacion_venta_producto_temporal WHERE (cod_parqueo_cotizacion_venta_producto_temporal = '$cod_parqueo_cotizacion_venta_producto_temporal')";
$mconsulta = mysqli_query($conectar, $sql_mconsulta) or die(mysqli_error($conectar));
$datos_temp = mysqli_fetch_assoc($mconsulta);

$cod_producto                      = $datos_temp['cod_producto'];
$cod_producto_barra                = $datos_temp['cod_producto_barra'];
$nombre_tipo_precio_venta          = $datos_temp['nombre_tipo_precio_venta'];

$sqlr_consulta = "SELECT und_producto, iva_ptj, comision_ptj FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
$datos_prod = mysqli_fetch_assoc($modificar_consulta);
//-----------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------TIPO DE VENTA PUEDES SER MENUDIADO O POR UNIDADES----------------------------------------------------//
$cod_producto                      = $datos_temp['cod_producto'];
$cod_producto_barra                = $datos_temp['cod_producto_barra'];
$nombre_producto                   = $datos_temp['nombre_producto'];
$und_venta                         = $datos_temp['und_venta'];
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

$placa_producto                    = $datos_temp['placa_producto'];
$comentario_producto               = $datos_temp['comentario_producto'];
$fecha_ymd_parqueo_ini             = $datos_temp['fecha_ymd_parqueo_ini'];
$fecha_hora_parqueo_ini            = $datos_temp['fecha_hora_parqueo_ini'];
$fecha_ymd_parqueo_fin             = $datos_temp['fecha_ymd_parqueo_fin'];
$fecha_hora_parqueo_fin            = $datos_temp['fecha_hora_parqueo_fin'];

$fecha_alerta                      = $datos_temp['fecha_alerta'];
$iva_ptj                           = $datos_prod['iva_ptj'];
$und_producto_inv                  = $datos_prod['und_producto'];
$comision_ptj                      = $datos_prod['comision_ptj'];
$und_producto                      = $und_producto_inv - $und_venta;
//----------------------------- INSERTAR PRODUCTOS A LAS VENTAS -----------------------------//
$agregar_reg_venta_producto = "INSERT INTO tbl15_parqueo_cotizacion_venta_producto (cod_info_parqueo_cotizacion_factura_venta, cod_factura, cod_producto, cod_producto_barra, 
nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, 
total_venta_producto, nombre_tipo_producto, und_producto, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, nombre_tipo_presentacion,
fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
fecha_alerta, cod_resolucion_facturacion, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, comision_ptj, 
placa_producto, comentario_producto, fecha_ymd_parqueo_ini, fecha_hora_parqueo_ini, fecha_ymd_parqueo_fin, fecha_hora_parqueo_fin)
VALUES ('$cod_info_parqueo_cotizacion_factura_venta', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', 
'$total_venta_producto', '$nombre_tipo_producto', '$und_producto', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
'$nombre_tipo_unidad_medida', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_presentacion',
'$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
'$fecha_alerta', '$cod_resolucion_facturacion', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$comision_ptj', 
'$placa_producto', '$comentario_producto', '$fecha_ymd_parqueo_ini', '$fecha_hora_parqueo_ini', '$fecha_ymd_parqueo_fin', '$fecha_hora_parqueo_fin')";
$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));
}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
$borrar_sql = sprintf("DELETE FROM tbl15_parqueo_cotizacion_venta_producto_temporal WHERE (cod_info_parqueo_cotizacion_factura_venta = '$cod_info_parqueo_cotizacion_factura_venta')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//   
$tiempo_final                 = microtime(true);
$tiempo_ejecucion             = $tiempo_final - $tiempo_inicial;
$vlr_vuelto                   = $vlr_cancelado - $total_precio_venta;

$agregar_regis = sprintf("UPDATE tbl15_info_parqueo_cotizacion_factura_venta SET cod_estado_factura = '$cod_estado_factura', cod_factura = '$cod_factura', fecha_anyo = '$fecha_anyo', 
fecha_dia = '$fecha_dia',fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', total_precio_compra = '$total_precio_compra', 
total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data', cod_tercero = '$cod_tercero', nombre_estado_factura = '$nombre_estado_factura',
cuenta = '$cuenta', vlr_cancelado = '$vlr_cancelado', vlr_vuelto = '$vlr_vuelto', cod_tipo_pago = '$cod_tipo_pago', cod_administrador = '$cod_administrador', 
cod_tipo_forma_pago = '$cod_tipo_forma_pago', nombre_tipo_factura = '$nombre_tipo_factura',  nombre_tipo_moneda = '$nombre_tipo_moneda', 
nombre_maquina = '$nombre_maquina', tiempo_ejecucion = '$tiempo_ejecucion', cod_resolucion_facturacion = '$cod_resolucion_facturacion', 
cod_tipo_cotizacion = '$cod_tipo_cotizacion'
WHERE cod_info_parqueo_cotizacion_factura_venta = '$cod_info_parqueo_cotizacion_factura_venta'");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

$url_redir = "../admin/parqueo_cotizacion_venta_productos_opcion_imprimir.php?cod_info_parqueo_cotizacion_factura_venta=".$cod_info_parqueo_cotizacion_factura_venta."&cod_tipo_pago=".$cod_tipo_pago."&pagina=".$pagina;
header("Location: $url_redir");
}
//-------------------------------------- LLAVE DE CIERRE DEL CONDICIONAL VENDER ------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
?>