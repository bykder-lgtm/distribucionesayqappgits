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
$cod_info_factura_transferencia_bodega   = intval($_POST['cod_info_factura_transferencia_bodega']);
$fecha_anyo                              = addslashes($_POST['fecha_anyo']);
$cod_tercero                             = intval($_POST['cod_tercero']);
$nombre_tipo_moneda                      = addslashes($_POST['nombre_tipo_moneda']);
$nombre_tipo_factura                     = addslashes($_POST['nombre_tipo_factura']);
$nombre_tipo_cargue_factura              = addslashes($_POST['nombre_tipo_cargue_factura']);
$nombre_rete_fuente_ptj                  = addslashes($_POST['nombre_rete_fuente_ptj']);
$ret_ica_ptj                             = addslashes($_POST['ret_ica_ptj']);
$subtotal                                = addslashes($_POST['subtotal']);
$total_valor_iva                         = addslashes($_POST['valor_iva']);
$total_descuento                         = addslashes($_POST['total_descuento']);
$total_precio_ipc                        = addslashes($_POST['total_precio_ipc']);
$total_compra_imp                        = addslashes($_POST['total_compra_imp']);
$total_rete_fuente                       = addslashes($_POST['total_rete_fuente']);
$total_ret_ica                           = addslashes($_POST['total_ret_ica']);
$total_factura_compra_retefuente         = addslashes($_POST['total_factura_compra_retefuente']);
$cod_tipo_forma_pago                     = intval($_POST['cod_tipo_forma_pago']);
$cod_tipo_pago                           = intval($_POST['cod_tipo_pago']);
$cod_administrador                       = intval($_POST['cod_administrador']);
$cod_factura                             = intval($_POST['cod_factura']);
$total_datos                             = intval($_POST['total_datos']);
$vlr_cancelado                           = 0;
$pagina                                  = addslashes($_POST['pagina']);
$fecha_anyo_seg                          = strtotime($fecha_anyo);
$total_datos_data                        = $total_datos;
$nombre_estado_factura                   = 'CERRADA';
$nombre_maquina                          = gethostname();
$fecha_ult_compra                        = date("Y-m-d");
$total                                   = $total_factura_compra_retefuente;
$subtotal_total_precio_compra            = $subtotal;
$subtotal_total_precio_costo             = $subtotal;
$total_factura_compra                    = $total_factura_compra_retefuente;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_totales_temporal = "SELECT SUM(total_costo_producto) AS total_precio_costo, SUM(total_compra_producto) AS total_precio_compra, 
SUM(und_compra * precio_venta_producto) AS total_precio_venta FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_totales_temporal = mysqli_query($conectar, $sql_totales_temporal) or die(mysqli_error($conectar));
$datos_totales_temporal = mysqli_fetch_assoc($consulta_totales_temporal);

$total_precio_costo                      = $datos_totales_temporal['total_precio_costo'];
$total_precio_compra                     = $datos_totales_temporal['total_precio_compra'];
$total_precio_venta                      = $datos_totales_temporal['total_precio_venta'];
$total_compra_precio_costo               = $total_precio_costo;
$total_compra_precio_compra              = $total_precio_compra;
$total_compra_precio_venta               = $total_precio_venta;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion 
WHERE (nombre_tipo_resolucion_facturacion = '$nombre_tipo_factura') AND (nombre_tipo_estado = 'ACTIVO')";
$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

$cod_resolucion_facturacion              = intval($matriz_resol_fact['cod_resolucion_facturacion']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_totales_inv = "SELECT SUM(und_producto * precio_costo_producto) AS total_inv_precio_costo, SUM(und_producto * precio_compra_producto) AS total_inv_precio_compra, 
SUM(und_producto * precio_venta_producto) AS total_inv_precio_venta FROM tbl15_producto_bodega";
$consulta_totales_inv = mysqli_query($conectar, $sql_totales_inv) or die(mysqli_error($conectar));
$datos_totales_inv = mysqli_fetch_assoc($consulta_totales_inv);

$total_inv_precio_costo                  = $datos_totales_inv['total_inv_precio_costo'];
$total_inv_precio_compra                 = $datos_totales_inv['total_inv_precio_compra'];
$total_inv_precio_venta                  = $datos_totales_inv['total_inv_precio_venta'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_imp_factura = "SELECT * FROM tbl15_info_factura_transferencia_bodega WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$modificar_info_imp_factura = mysqli_query($conectar, $sql_info_imp_factura) or die(mysqli_error($conectar));
$total_encontrado_info_imp_factura = mysqli_num_rows($modificar_info_imp_factura);
$matriz_info_imp_factura  = mysqli_fetch_assoc($modificar_info_imp_factura);

$fecha_ymdhis                            = $matriz_info_imp_factura['fecha_ymdhis'];
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
//$cod_administrador                       = $matriz_info_imp_factura['cod_administrador'];
$fecha_ymd_venta_producto                = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes_venta_producto                = date("Y-m", $fecha_anyo_seg);
$fecha_anyo_venta_producto               = date("Y", $fecha_anyo_seg);
$fecha_seg_venta_producto                = time();
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_total_venta_producto_temporal = "SELECT SUM(und_venta * precio_venta_producto) AS total_precio_venta, SUM(und_venta * precio_compra_producto) AS total_precio_compra, 
SUM(und_venta * precio_costo_producto) AS total_precio_costo
FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')";
$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
$datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal);

$total_precio_compra                     = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_precio_venta                      = $datos_total_venta_producto_temporal['total_precio_venta'];
$total_compra_precio_costo               = $datos_total_venta_producto_temporal['total_precio_costo'];
$total_compra_precio_compra              = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_compra_precio_venta               = $datos_total_venta_producto_temporal['total_precio_venta'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------- LLAVE DE INICIO DEL CONDICIONAL VENDER POR CONTADO ------------------------------------------//
if (isset($_POST['cod_info_factura_transferencia_bodega'])) {

for ($i=0; $i < $total_datos; $i++) {

$cod_transferencia_bodega_producto_temporal       = $_POST['cod_transferencia_bodega_producto_temporal'][$i];

$sql_mconsulta = "SELECT * FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_transferencia_bodega_producto_temporal = '$cod_transferencia_bodega_producto_temporal')";
$mconsulta = mysqli_query($conectar, $sql_mconsulta) or die(mysqli_error($conectar));
$datos_temp = mysqli_fetch_assoc($mconsulta);

$cod_producto                      = $datos_temp['cod_producto'];
$cod_producto_barra                = $datos_temp['cod_producto_barra'];
$nombre_tipo_precio_venta          = $datos_temp['nombre_tipo_precio_venta'];

$sqlr_consulta = "SELECT und_producto, comision_ptj, precio_compra_producto, precio_costo_producto FROM tbl15_producto_bodega WHERE (cod_producto_barra = '$cod_producto_barra')";
$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
$datos_prod = mysqli_fetch_assoc($modificar_consulta);

$precio_compra_producto_viejo      = $datos_prod['precio_compra_producto'];
$precio_costo_producto_viejo       = $datos_prod['precio_costo_producto'];
$und_producto_inv                  = $datos_prod['und_producto'];
$comision_ptj                      = $datos_prod['comision_ptj'];
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
$und_producto                      = $und_compra + $und_producto_inv;

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
$cod_dependencia                   = $datos_temp['cod_dependencia'];
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
$nombre_tipo_compra                = $datos_temp['nombre_tipo_compra'];
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
//----------------------------- INSERTAR PRODUCTOS A LAS VENTAS -----------------------------//
$agregar_reg_compra_producto = "INSERT INTO tbl15_factura_transferencia_bodega_producto (cod_info_factura_transferencia_bodega, cod_tercero, cod_doc_soporte, cod_caja_virtual, 
cod_producto, cod_producto_barra, nombre_producto, und_compra, und_producto, und_unidades, und_caja, unidades_total, precio_compra_producto, 
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
cod_tipo_cobrar, cod_estado_vacuna, cod_estado_permitir_venta, cod_base_caja, cod_guia, cod_administrador, cuenta)
VALUES ('$cod_info_factura_transferencia_bodega', '$cod_tercero', '$cod_doc_soporte', '$cod_caja_virtual', 
'$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_compra', '$und_producto_inv', '$und_unidades', '$und_caja', '$unidades_total', '$precio_compra_producto', 
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
'$cod_tipo_cobrar', '$cod_estado_vacuna', '$cod_estado_permitir_venta', '$cod_base_caja', '$cod_guia', '$cod_administrador', '$cuenta')";
$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$agregar_regis = sprintf("UPDATE tbl15_producto_bodega SET nombre_producto = '$nombre_producto', und_producto = '$und_producto', precio_compra_producto = '$precio_compra_producto', 
precio_costo_producto = '$precio_costo_producto', precio_venta_producto = '$precio_venta_producto', precio_venta_producto2 = '$precio_venta_producto2', 
precio_venta_producto3 = '$precio_venta_producto3', precio_venta_producto4 = '$precio_venta_producto4', precio_venta_producto5 = '$precio_venta_producto5', 
posologia_cantidad = '$posologia_cantidad', posologia_peso = '$posologia_peso', iva_ptj = '$iva_ptj', cod_tercero = '$cod_tercero', 
fecha_ult_compra = '$fecha_ult_compra', tope_min = '$tope_min', cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega', 
comision_ptj = '$comision_ptj', und_unidades = '$und_unidades', und_caja = '$und_caja', dto1 = '$dto1', dto2 = '$dto2', ipc_ptj = '$ipc_ptj', 
precio_ipc = '$precio_ipc', precio_ipc_total = '$precio_ipc_total', ret_ica_ptj = '$ret_ica_ptj', iva_teorico_ptj = '$iva_teorico_ptj', 
tarifa_rete_vigente_ptj = '$tarifa_rete_vigente_ptj', rete_iva_asumido_ptj = '$rete_iva_asumido_ptj', nombre_tipo_compra = '$nombre_tipo_compra', 
nombre_tipo_cargue_factura = '$nombre_tipo_cargue_factura', cajas_sobre = '$cajas_sobre', und_sobre = '$und_sobre', fecha_vencimiento = '$fecha_vencimiento', 
lote_vencimiento = '$lote_vencimiento', fecha_vencimiento1 = '$fecha_vencimiento1'
WHERE (cod_producto_barra = '$cod_producto_barra')");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
$borrar_sql = sprintf("DELETE FROM tbl15_transferencia_bodega_producto_temporal WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
$sql_totales_inv_desp = "SELECT SUM(und_producto * precio_compra_producto) AS total_inv_compra_desp_factura FROM tbl15_producto_bodega";
$consulta_totales_inv_desp = mysqli_query($conectar, $sql_totales_inv_desp) or die(mysqli_error($conectar));
$datos_totales_inv_desp = mysqli_fetch_assoc($consulta_totales_inv_desp);

$total_inv_compra_desp_factura           = $datos_totales_inv_desp['total_inv_compra_desp_factura'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$tiempo_final                            = microtime(true);
$tiempo_ejecucion                        = $tiempo_final - $tiempo_inicial;
$vlr_vuelto                              = $vlr_cancelado - $total_precio_venta;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$agregar_regis = sprintf("UPDATE tbl15_info_factura_transferencia_bodega SET total = '$total', subtotal_total_precio_compra = '$subtotal_total_precio_compra', 
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
total_compra_precio_costo = '$total_compra_precio_costo', total_compra_precio_compra = '$total_compra_precio_compra', total_compra_precio_venta = '$total_compra_precio_venta'
WHERE (cod_info_factura_transferencia_bodega = '$cod_info_factura_transferencia_bodega')");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));

if ($cod_tipo_pago=='2') {
$monto_deuda	                   = $total_factura_compra_retefuente;
$subtotal	                       = $total_factura_compra_retefuente;
$vendedor	                       = $cuenta;
$fecha_pago	                       = $fecha_anyo;
$fecha	                           = $fecha_anyo;
$fecha_invert	                   = $fecha_anyo;
$fecha_seg	                       = time();

$agregar_reg_compra_producto = "INSERT INTO tbl15_cuentas_pagar (cod_factura, cod_tercero, monto_deuda, subtotal, 
vendedor, cuenta, fecha_pago, fecha, fecha_invert, fecha_seg, cod_info_factura_transferencia_bodega)
VALUES ('$cod_factura', '$cod_tercero', '$monto_deuda', '$subtotal', 
'$vendedor', '$cuenta', '$fecha_pago', '$fecha', '$fecha_invert', '$fecha_seg', '$cod_info_factura_transferencia_bodega')";
$resultado_compra_producto = mysqli_query($conectar, $agregar_reg_compra_producto) or die(mysqli_error($conectar));
}
$url_redir = "../admin/factura_transferencia_bodega_productos_opcion_imprimir.php?cod_info_factura_transferencia_bodega=".$cod_info_factura_transferencia_bodega."&cod_tipo_pago=".$cod_tipo_pago."&pagina=".$pagina;
header("Location: $url_redir");
}
//-------------------------------------- LLAVE DE CIERRE DEL CONDICIONAL VENDER ------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
?>