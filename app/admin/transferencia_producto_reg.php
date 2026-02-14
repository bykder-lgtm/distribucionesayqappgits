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
$cod_info_factura_transferencia        = intval($_POST['cod_info_factura_transferencia']);
$fecha_anyo                            = addslashes($_POST['fecha_anyo']);
$cod_tercero                           = intval($_POST['cod_tercero']);
$nombre_tipo_moneda                    = addslashes($_POST['nombre_tipo_moneda']);
$nombre_tipo_factura                   = addslashes($_POST['nombre_tipo_factura']);
$cod_tipo_forma_pago                   = intval($_POST['cod_tipo_forma_pago']);
$cod_tipo_pago                         = intval($_POST['cod_tipo_pago']);
$cod_administrador                     = intval($_POST['cod_administrador']);
$total_datos                           = intval($_POST['total_datos']);
$pagina                                = addslashes($_POST['pagina']);
$fecha_anyo_seg                        = strtotime($fecha_anyo);
$total_datos_data                      = $total_datos;
$nombre_estado_factura                 = 'CERRADA';
$nombre_maquina                        = gethostname();

if (isset($_POST['cod_tipo_producto_consumo'])) { $cod_tipo_producto_consumo = addslashes($_POST['cod_tipo_producto_consumo']); } else { $cod_tipo_producto_consumo = '1'; }

$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_transferencia 
WHERE (nombre_tipo_factura = '$nombre_tipo_factura') AND (nombre_estado_factura = 'CERRADA')";
$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

$cod_factura                         = $maxima_factura['cod_factura']+1;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_imp_factura = "SELECT * FROM tbl15_info_factura_transferencia WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'";
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
//$cod_administrador                 = $matriz_info_imp_factura['cod_administrador'];
if ($cod_tipo_inventario == '1') { $campo_und_inventario = 'und_producto'; } elseif ($cod_tipo_inventario == '2') { $campo_und_inventario = 'und_producto_bodega';
} else { $campo_und_inventario = 'und_producto'; }

$fecha_ymd_venta_producto          = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes_venta_producto          = date("Y-m", $fecha_anyo_seg);
$fecha_anyo_venta_producto         = date("Y", $fecha_anyo_seg);
$fecha_seg_venta_producto          = time();
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_venta_producto_temporal = "SELECT SUM(und_venta * precio_venta_producto) AS total_precio_venta, SUM(und_venta * precio_costo_producto) AS total_precio_compra
FROM tbl15_transferencia_producto_temporal WHERE (cod_info_factura_transferencia = '$cod_info_factura_transferencia')";
$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
$datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal);

$total_precio_compra               = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_precio_venta                = $datos_total_venta_producto_temporal['total_precio_venta'];

$tiempo_final                      = microtime(true);
$tiempo_ejecucion                  = $tiempo_final - $tiempo_inicial;
$vlr_vuelto                        = 0 - 0;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------- LLAVE DE INICIO DEL CONDICIONAL VENDER POR CONTADO ------------------------------------------//
for ($i=0; $i < $total_datos; $i++) {

$cod_transferencia_producto_temporal       = $_POST['cod_transferencia_producto_temporal'][$i];

$sql_mconsulta = "SELECT * FROM tbl15_transferencia_producto_temporal WHERE (cod_transferencia_producto_temporal = '$cod_transferencia_producto_temporal')";
$mconsulta = mysqli_query($conectar, $sql_mconsulta) or die(mysqli_error($conectar));
$datos_temp = mysqli_fetch_assoc($mconsulta);

$cod_producto                      = $datos_temp['cod_producto'];
$cod_producto_barra                = $datos_temp['cod_producto_barra'];
$nombre_tipo_precio_venta          = $datos_temp['nombre_tipo_precio_venta'];

$sqlr_consulta = "SELECT und_producto, und_producto_bodega, iva_ptj, comision_ptj, cod_dependencia FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
$datos_prod = mysqli_fetch_assoc($modificar_consulta);
//-----------------------------------------------------------------------------------------------------------------------------------------//
//------------------------------------TIPO DE VENTA PUEDES SER MENUDIADO O POR UNIDADES----------------------------------------------------//
$cod_producto                      = $datos_temp['cod_producto'];
$cod_producto_barra                = $datos_temp['cod_producto_barra'];
$nombre_producto                   = $datos_temp['nombre_producto'];
$und_venta                         = $datos_temp['und_venta'];
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
$cod_factura_compra_producto       = $datos_prod['cod_factura_compra_producto'];
//$und_producto                      = $und_producto_inv - $und_venta;

if ($cod_tipo_inventario == '1') { 
	$und_producto = $und_producto_inv + $und_venta; 
	$und_producto_bodega = $und_producto_bodega_inv - $und_venta; 
} 
elseif ($cod_tipo_inventario == '2') { 
	$und_producto = $und_producto_inv - $und_venta; 
	$und_producto_bodega = $und_producto_bodega_inv + $und_venta; 
} 
else { 
	$und_producto = $und_producto_inv + $und_venta; 
	$und_producto_bodega = $und_producto_bodega_inv - $und_venta; 
}
//----------------------------- INSERTAR PRODUCTOS A LAS VENTAS -----------------------------//
$agregar_reg_venta_producto = "INSERT INTO tbl15_transferencia_producto (cod_info_factura_transferencia, cod_factura, cod_producto, cod_producto_barra, 
nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, 
total_venta_producto, nombre_tipo_producto, und_producto, und_producto_bodega_inv, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, nombre_tipo_presentacion,
fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
fecha_alerta, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, comision_ptj, 
cod_tipo_pago, cod_tipo_forma_pago, total_datos_data, nombre_tipo_factura, nombre_tipo_moneda, 
cod_dependencia, cod_tipo_inventario, cod_tipo_producto_consumo, cod_factura_compra_producto)
VALUES ('$cod_info_factura_transferencia', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', 
'$total_venta_producto', '$nombre_tipo_producto', '$und_producto', '$und_producto_bodega_inv', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
'$nombre_tipo_unidad_medida', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_presentacion',
'$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
'$fecha_alerta', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$comision_ptj', 
'$cod_tipo_pago', '$cod_tipo_forma_pago', '$total_datos_data', '$nombre_tipo_factura', '$nombre_tipo_moneda', 
'$cod_dependencia', '$cod_tipo_inventario', '$cod_tipo_producto_consumo', '$cod_factura_compra_producto')";
$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
if ($cod_tipo_producto_consumo == '1') {
$actualiza_producto = sprintf("UPDATE tbl15_producto SET und_producto = '$und_producto', und_producto_bodega = '$und_producto_bodega', 
nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida' 
WHERE cod_producto_barra = '$cod_producto_barra'");
$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));
} else {
$actualiza_producto = sprintf("UPDATE tbl15_producto SET und_producto_bodega = '$und_producto_bodega', 
nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida' 
WHERE cod_producto_barra = '$cod_producto_barra'");
$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));
}

}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
$borrar_sql = sprintf("DELETE FROM tbl15_transferencia_producto_temporal WHERE (cod_info_factura_transferencia = '$cod_info_factura_transferencia')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//   
$agregar_regis = sprintf("UPDATE tbl15_info_factura_transferencia SET cod_estado_factura = '$cod_estado_factura', cod_factura = '$cod_factura', fecha_anyo = '$fecha_anyo', 
fecha_dia = '$fecha_dia',fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', total_precio_compra = '$total_precio_compra', 
total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data', cod_tercero = '$cod_tercero', nombre_estado_factura = '$nombre_estado_factura',
cuenta = '$cuenta', cod_tipo_pago = '$cod_tipo_pago', cod_administrador = '$cod_administrador', 
cod_tipo_forma_pago = '$cod_tipo_forma_pago', nombre_tipo_factura = '$nombre_tipo_factura',  nombre_tipo_moneda = '$nombre_tipo_moneda', 
nombre_maquina = '$nombre_maquina', tiempo_ejecucion = '$tiempo_ejecucion', cod_tipo_producto_consumo = '$cod_tipo_producto_consumo'  
WHERE cod_info_factura_transferencia = '$cod_info_factura_transferencia'");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

$url_redir = "../admin/transferenica_productos_opcion_imprimir.php?cod_info_factura_transferencia=".$cod_info_factura_transferencia."&cod_tipo_pago=".$cod_tipo_pago."&pagina=".$pagina;
header("Location: $url_redir");
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
?>