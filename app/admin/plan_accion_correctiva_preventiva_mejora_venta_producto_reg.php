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
$cod_info_plan_accion_correctiva_preventiva_mejora        = intval($_POST['cod_info_plan_accion_correctiva_preventiva_mejora']);

if (isset($_POST['fecha_anyo'])) { $fecha_anyo = addslashes($_POST['fecha_anyo']); } else { $fecha_anyo = date("Y-m-d"); }
if (isset($_POST['cod_tercero'])) { $cod_tercero = intval($_POST['cod_tercero']); } else { $cod_tercero = "COP"; }
if (isset($_POST['nombre_tipo_moneda'])) { $nombre_tipo_moneda = addslashes($_POST['nombre_tipo_moneda']); } else { $nombre_tipo_moneda = "COP"; }
if (isset($_POST['nombre_tipo_factura'])) { $nombre_tipo_factura = addslashes($_POST['nombre_tipo_factura']); } else { $nombre_tipo_factura = "POS"; }
if (isset($_POST['cod_tipo_forma_pago'])) { $cod_tipo_forma_pago = addslashes($_POST['cod_tipo_forma_pago']); } else { $cod_tipo_forma_pago = "1"; }
if (isset($_POST['cod_tipo_pago'])) { $cod_tipo_pago = addslashes($_POST['cod_tipo_pago']); } else { $cod_tipo_pago = "1"; }
if (isset($_POST['cod_administrador'])) { $cod_administrador = intval($_POST['cod_administrador']); } else { $cod_administrador = "1"; }
if (isset($_POST['total_datos'])) { $total_datos = intval($_POST['total_datos']); } else { $total_datos = "1"; }
if (isset($_POST['vlr_cancelado'])) { $vlr_cancelado = addslashes($_POST['vlr_cancelado']); } else { $vlr_cancelado = "0"; }
if (isset($_POST['nombre_comentario'])) { $nombre_comentario = addslashes($_POST['nombre_comentario']); } else { $nombre_comentario = ""; }
if (isset($_POST['nombre_tipo_pendiente'])) { $nombre_tipo_pendiente = addslashes($_POST['nombre_tipo_pendiente']); } else { $nombre_tipo_pendiente = ""; }
if (isset($_POST['descripcion_tipo_pendiente'])) { $descripcion_tipo_pendiente = addslashes($_POST['descripcion_tipo_pendiente']); } else { $descripcion_tipo_pendiente = ""; }
if (isset($_POST['fecha_entrega'])) { $fecha_entrega = addslashes($_POST['fecha_entrega']); } else { $fecha_entrega = ""; }
if (isset($_POST['hora_entrega'])) { $hora_entrega = addslashes($_POST['hora_entrega']); } else { $hora_entrega = ""; }
if (isset($_POST['pagina'])) { $pagina = addslashes($_POST['pagina']); } else { $pagina = ""; }
if (isset($_POST['cod_factura'])) { $cod_factura = addslashes($_POST['cod_factura']); } else { $cod_factura = ""; }
if (isset($_POST['cod_version'])) { $cod_version = addslashes($_POST['cod_version']); } else { $cod_version = ""; }

$fecha_anyo_seg                = strtotime($fecha_anyo);
$total_datos_data              = $total_datos;
$nombre_estado_factura         = 'CERRADA';
$nombre_maquina                = gethostname();
$nombre_elaboro                = $cod_administrador;

$sql_resol_fact = "SELECT MAX(cod_resolucion_facturacion) AS cod_resolucion_facturacion FROM tbl15_resolucion_facturacion 
WHERE (nombre_tipo_resolucion_facturacion = '$nombre_tipo_factura') AND (nombre_tipo_estado = 'ACTIVO')";
$consulta_resol_fact = mysqli_query($conectar, $sql_resol_fact) or die(mysqli_error($conectar));
$total_datos_resol_fact = mysqli_num_rows($consulta_resol_fact);
$matriz_resol_fact = mysqli_fetch_assoc($consulta_resol_fact);

$cod_resolucion_facturacion       = intval($matriz_resol_fact['cod_resolucion_facturacion']);

if ($cod_factura == '') {
$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_plan_accion_correctiva_preventiva_mejora WHERE (nombre_estado_factura = 'CERRADA')";
$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

$cod_factura                         = $maxima_factura['cod_factura']+1;
} 
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_info_imp_factura = "SELECT * FROM tbl15_info_plan_accion_correctiva_preventiva_mejora WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'";
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
FROM tbl15_plan_accion_correctiva_preventiva_mejora_temporal WHERE (cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora')";
$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
$datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal);

$total_precio_compra               = $datos_total_venta_producto_temporal['total_precio_compra'];
$total_precio_venta                = $datos_total_venta_producto_temporal['total_precio_venta'];
$vlr_vuelto                        = $total_precio_venta - $vlr_cancelado;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
//-------------------------------------- LLAVE DE INICIO DEL CONDICIONAL VENDER POR CONTADO ------------------------------------------//
if (isset($_POST['cod_info_plan_accion_correctiva_preventiva_mejora'])) {

for ($i=0; $i < $total_datos; $i++) {

$cod_plan_accion_correctiva_preventiva_mejora_temporal       = $_POST['cod_plan_accion_correctiva_preventiva_mejora_temporal'][$i];

$sql_mconsulta = "SELECT * FROM tbl15_plan_accion_correctiva_preventiva_mejora_temporal WHERE (cod_plan_accion_correctiva_preventiva_mejora_temporal = '$cod_plan_accion_correctiva_preventiva_mejora_temporal')";
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
$fecha_alerta                      = $datos_temp['fecha_alerta'];
$iva_ptj                           = $datos_prod['iva_ptj'];
$und_producto_inv                  = $datos_prod['und_producto'];
$comision_ptj                      = $datos_prod['comision_ptj'];
$und_producto                      = $und_producto_inv - $und_venta;

$nombre_tipo_accion                = $datos_temp['nombre_tipo_accion'];
$nombre_tipo_fuente                = $datos_temp['nombre_tipo_fuente'];
$nombre_tipo_actividad             = $datos_temp['nombre_tipo_actividad'];
$descripcion_hallazgo              = $datos_temp['descripcion_hallazgo'];
$nombre_tipo_accion_tomada         = $datos_temp['nombre_tipo_accion_tomada'];
$recurso_humano                    = $datos_temp['recurso_humano'];
$recurso_financiero                = $datos_temp['recurso_financiero'];
$recurso_tecnologico               = $datos_temp['recurso_tecnologico'];
$nombre_responsable_implantar_accion = $datos_temp['nombre_responsable_implantar_accion'];
$fecha_prevista                    = $datos_temp['fecha_prevista'];
$seguimiento_cumplimiento          = $datos_temp['seguimiento_cumplimiento'];
$seguimiento_eficacia              = $datos_temp['seguimiento_eficacia'];
$seguimiento_soporte               = $datos_temp['seguimiento_soporte'];

//----------------------------- INSERTAR PRODUCTOS A LAS VENTAS -----------------------------//
$agregar_reg_venta_producto = "INSERT INTO tbl15_plan_accion_correctiva_preventiva_mejora (cod_info_plan_accion_correctiva_preventiva_mejora, cod_factura, cod_producto, cod_producto_barra, 
nombre_producto, und_venta, precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, 
total_venta_producto, nombre_tipo_producto, und_producto, fecha_ymd_venta_producto, fecha_hora_venta_producto, 
nombre_tipo_unidad_medida, posologia_cantidad, posologia_peso, nombre_tipo_presentacion,
fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, cod_administrador, 
fecha_alerta, cod_resolucion_facturacion, iva_ptj, und_producto_inv, cod_tercero, cod_caja_virtual, nombre_tipo_precio_venta, comision_ptj, cod_version, 
nombre_tipo_accion, nombre_tipo_fuente, nombre_tipo_actividad, descripcion_hallazgo, nombre_tipo_accion_tomada, recurso_humano, recurso_financiero, 
recurso_tecnologico, nombre_responsable_implantar_accion, fecha_prevista, seguimiento_cumplimiento, seguimiento_eficacia, seguimiento_soporte)
VALUES ('$cod_info_plan_accion_correctiva_preventiva_mejora', '$cod_factura', '$cod_producto', '$cod_producto_barra', 
'$nombre_producto', '$und_venta', '$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', 
'$total_venta_producto', '$nombre_tipo_producto', '$und_producto', '$fecha_ymd_venta_producto', '$fecha_hora_venta_producto',
'$nombre_tipo_unidad_medida', '$posologia_cantidad', '$posologia_peso', '$nombre_tipo_presentacion',
'$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', '$cod_administrador', 
'$fecha_alerta', '$cod_resolucion_facturacion', '$iva_ptj', '$und_producto_inv', '$cod_tercero', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$comision_ptj', '$cod_version', 
'$nombre_tipo_accion', '$nombre_tipo_fuente', '$nombre_tipo_actividad', '$descripcion_hallazgo', '$nombre_tipo_accion_tomada', '$recurso_humano', '$recurso_financiero', 
'$recurso_tecnologico', '$nombre_responsable_implantar_accion', '$fecha_prevista', '$seguimiento_cumplimiento', '$seguimiento_eficacia', '$seguimiento_soporte')";
$resultado_venta_producto = mysqli_query($conectar, $agregar_reg_venta_producto) or die(mysqli_error($conectar));
}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
$borrar_sql = sprintf("DELETE FROM tbl15_plan_accion_correctiva_preventiva_mejora_temporal WHERE (cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora')");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//   
$tiempo_final                 = microtime(true);
$tiempo_ejecucion             = $tiempo_final - $tiempo_inicial;
$monto_deuda 	              = $total_precio_venta;
$abonado 	                  = $vlr_cancelado;
$total_abono 	              = $vlr_cancelado;
$subtotal 	                  = $monto_deuda - $abonado;
$vendedor                     = $cuenta;
$cuenta 	                  = $cuenta;
$fecha_pago 	              = date("Y-m-d", strtotime($fecha_anyo));
$fecha_anyo 	              = date("Y-m-d", strtotime($fecha_anyo));
$fecha_mes 	                  = date("Y-m", strtotime($fecha_anyo));
$anyo 	                      = date("Y", strtotime($fecha_anyo));
$fecha_invert 	              = date("Y-m-d", strtotime($fecha_anyo));
$fecha_seg 	                  = strtotime($fecha_anyo);
$hora 	                      = date("H:i:s");
$fecha_creacion 	          = date("Y-m-d", strtotime($fecha_anyo));

$agregar_regis = sprintf("UPDATE tbl15_info_plan_accion_correctiva_preventiva_mejora SET cod_estado_factura = '$cod_estado_factura', cod_factura = '$cod_factura', fecha_anyo = '$fecha_anyo', 
fecha_dia = '$fecha_dia',fecha_mes = '$fecha_mes', anyo = '$anyo', fecha_hora = '$fecha_hora', total_precio_compra = '$total_precio_compra', 
total_precio_venta = '$total_precio_venta', total_datos_data = '$total_datos_data', cod_tercero = '$cod_tercero', nombre_estado_factura = '$nombre_estado_factura',
cuenta = '$cuenta', vlr_cancelado = '$vlr_cancelado', vlr_vuelto = '$vlr_vuelto', cod_tipo_pago = '$cod_tipo_pago', cod_administrador = '$cod_administrador', 
cod_tipo_forma_pago = '$cod_tipo_forma_pago', nombre_tipo_factura = '$nombre_tipo_factura',  nombre_tipo_moneda = '$nombre_tipo_moneda', 
nombre_maquina = '$nombre_maquina', tiempo_ejecucion = '$tiempo_ejecucion', cod_resolucion_facturacion = '$cod_resolucion_facturacion', 
nombre_comentario = '$nombre_comentario', nombre_tipo_pendiente = '$nombre_tipo_pendiente', descripcion_tipo_pendiente = '$descripcion_tipo_pendiente',
fecha_entrega = '$fecha_entrega', hora_entrega = '$hora_entrega', nombre_elaboro = '$nombre_elaboro', 
monto_deuda = '$monto_deuda', total_abono = '$total_abono', subtotal = '$subtotal', cod_version = '$cod_version'
WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$resultado_regis = mysqli_query($conectar, $agregar_regis) or die(mysqli_error($conectar));
/*
if ($vlr_cancelado <> '0') {
$agregar_reg_abono = "INSERT INTO tbl15_plan_accion_correctiva_preventiva_mejora_abonos (cod_info_plan_accion_correctiva_preventiva_mejora, cod_factura,  
monto_deuda, subtotal, abonado, cod_administrador, vendedor, cuenta, fecha_pago, fecha_anyo, hora,
anyo, fecha_invert, fecha_seg, fecha_creacion, cod_tipo_forma_pago)
VALUES ('$cod_info_plan_accion_correctiva_preventiva_mejora', '$cod_factura',  
'$monto_deuda', '$subtotal', '$abonado', '$cod_administrador', '$vendedor','$cuenta', '$fecha_pago', '$fecha_anyo', '$hora',
'$anyo', '$fecha_invert', '$fecha_seg', '$fecha_creacion', '$cod_tipo_forma_pago')";
$resultado_abono = mysqli_query($conectar, $agregar_reg_abono) or die(mysqli_error($conectar));
}
*/
$url_redir = "../admin/plan_accion_correctiva_preventiva_mejora_venta_productos_opcion_imprimir.php?cod_info_plan_accion_correctiva_preventiva_mejora=".$cod_info_plan_accion_correctiva_preventiva_mejora."&cod_tipo_pago=".$cod_tipo_pago."&pagina=".$pagina;
header("Location: $url_redir");
}
//-------------------------------------- LLAVE DE CIERRE DEL CONDICIONAL VENDER ------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
?>