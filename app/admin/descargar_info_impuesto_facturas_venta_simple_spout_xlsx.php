<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/fecha_en_espanol_mes.php');
include_once('../admin/class_php/fecha_en_espanol_mes_anyo.php');
include_once('../admin/class_php/numeros_a_letras_funcion.php');
date_default_timezone_set("America/Bogota");
include_once('../evitar_mensaje_error/error.php');

$fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
$fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
$cod_administrador                       = intval($_GET['cod_administrador']);
$cod_tercero                             = intval($_GET['cod_tercero']);
$cod_tipo_pago                           = intval($_GET['cod_tipo_pago']);
$cod_tipo_forma_pago                     = intval($_GET['cod_tipo_forma_pago']);
$cod_dependencia                         = intval($_GET['cod_dependencia']);
$nombre_tipo_factura                     = addslashes($_GET['nombre_tipo_factura']);

if (isset($_GET['nombre_tipo_compra'])) { $nombre_tipo_compra = addslashes($_GET['nombre_tipo_compra']); } else { $nombre_tipo_compra = "0"; }
if (isset($_GET['cod_tipo_metodo_envio'])) { $cod_tipo_metodo_envio = intval($_GET['cod_tipo_metodo_envio']); } else { $cod_tipo_metodo_envio = "0"; }

if ($cod_administrador == "0") {
    $filtro_consulta_vendedor = "";
    $filtro_consulta_vendedor_rel = "";
} else {
    $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
    $filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";
}

if ($cod_tercero == "0") {
    $filtro_consulta_tercero = "";
    $filtro_consulta_tercero_rel = "";
} else {
    $filtro_consulta_tercero = "AND (cod_tercero = '$cod_tercero')";
    $filtro_consulta_tercero_rel = "AND (tbl15_venta_producto.cod_tercero = '$cod_tercero')";
}

if ($cod_tipo_pago == "0") {
    $filtro_consulta_tipo_pago = "";
    $filtro_consulta_tipo_pago_rel = "";
} else {
    $filtro_consulta_tipo_pago = "AND (cod_tipo_pago = '$cod_tipo_pago')";
    $filtro_consulta_tipo_pago_rel = "AND (tbl15_venta_producto.cod_tipo_pago = '$cod_tipo_pago')";
}

if ($cod_tipo_forma_pago == "0") {
    $filtro_consulta_tipo_forma_pago = "";
    $filtro_consulta_tipo_forma_pago_rel = "";
} else {
    $filtro_consulta_tipo_forma_pago = "AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    $filtro_consulta_tipo_forma_pago_rel = "AND (tbl15_venta_producto.cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
}

if ($cod_dependencia == "0") {
    $filtro_consulta_dependencia = "";
    $filtro_consulta_dependencia_rel = "";
} else {
    $filtro_consulta_dependencia = "AND (cod_dependencia = '$cod_dependencia')";
    $filtro_consulta_dependencia_rel = "AND (tbl15_venta_producto.cod_dependencia = '$cod_dependencia')";
}

if ($nombre_tipo_factura =='0') {
    $filtro_consulta_nombre_tipo_factura = "";
    $filtro_consulta_nombre_tipo_factura_rel = "";
} else {
    $filtro_consulta_nombre_tipo_factura = "AND (nombre_tipo_factura = '$nombre_tipo_factura')";
    $filtro_consulta_nombre_tipo_factura_rel = "AND (tbl15_venta_producto.nombre_tipo_factura = '$nombre_tipo_factura')";
}

if ($nombre_tipo_compra =='0') {
    $filtro_consulta_nombre_tipo_compra = "";
    $filtro_consulta_nombre_tipo_compra_rel = "";
} else {
    $filtro_consulta_nombre_tipo_compra = "AND (nombre_tipo_compra = '$nombre_tipo_compra')";
    $filtro_consulta_nombre_tipo_compra_rel = "AND (tbl15_venta_producto.nombre_tipo_compra = '$nombre_tipo_compra')";
}

if ($cod_tipo_metodo_envio == "0") {
    $filtro_consulta_tipo_metodo_envio = "";
    $filtro_consulta_tipo_metodo_envio_rel = "";
} else {
    $filtro_consulta_tipo_metodo_envio = "AND (cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
    $filtro_consulta_tipo_metodo_envio_rel = "AND (tbl15_venta_producto.cod_tipo_metodo_envio = '$cod_tipo_metodo_envio')";
}
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
$fecha_hora                              = date("H:i:s");
$fecha                                   = date("Ymd");
$hora                                    = date("His");
$nombre_archivo                          = "VENTAS_POR_FACTURA".$fecha_ymd_venta_producto_ini.'_AL_'.$fecha_ymd_venta_producto_fin.'_'.$fecha.''.$hora;
$cabecera_emp                            = "VENTAS POR FACTURA";
//-----------------------------------------------------------------------------------------------------//
//-----------------------------------------------------------------------------------------------------//
require_once __DIR__ . '/class_php/Spout-2.7.3/Spout/Autoloader/autoload.php';
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
$writer = WriterFactory::create(Type::XLSX);
$writer->openToBrowser($nombre_archivo);
// Headers
 
$writer->addRow(array('FECHA', 'CREDITO', 'VALOR NETO', 'VALOR CREDITO', 'ASESOR', 'ESTADO DE PAGO', 'ID'));
// Then a foreach
$sql_total_tipo_factura = "SELECT * FROM tbl15_info_factura_venta 
WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
$filtro_consulta_vendedor $filtro_consulta_tercero $filtro_consulta_tipo_pago $filtro_consulta_tipo_forma_pago $filtro_consulta_dependencia $filtro_consulta_nombre_tipo_factura 
AND (nombre_estado_factura = 'CERRADA') ORDER BY cod_factura ASC";
$consulta_total_tipo_factura = mysqli_query($conectar, $sql_total_tipo_factura) or die(mysqli_error($conectar));
while ($data_info_factura = mysqli_fetch_assoc($consulta_total_tipo_factura)) {

    $cod_info_factura_venta                                         = $data_info_factura['cod_info_factura_venta'];
    $cod_factura                                                    = $data_info_factura['cod_factura'];
    $cod_tercero                                                    = $data_info_factura['cod_tercero'];
    $fecha_ini                                                      = $data_info_factura['fecha_ini'];
    $fecha_fin                                                      = $data_info_factura['fecha_fin'];
    $cod_empresa                                                    = $data_info_factura['cod_empresa'];
    $nombre_empresa                                                 = $data_info_factura['nombre_empresa'];
    $razonsocial_empresa                                            = $data_info_factura['razonsocial_empresa'];
    $total_motivo                                                   = $data_info_factura['total_motivo'];
    $total_muestra                                                  = $data_info_factura['total_muestra'];
    $fecha_ymdhis                                                   = $data_info_factura['fecha_ymdhis'];
    $cuenta                                                         = $data_info_factura['cuenta'];
    $cod_estado_factura                                             = $data_info_factura['cod_estado_factura'];
    $cod_base_caja                                                  = $data_info_factura['cod_base_caja'];
    $descuento_ptj                                                  = $data_info_factura['descuento_ptj'];
    $iva_ptj                                                        = $data_info_factura['iva_ptj'];
    $flete_ptj                                                      = $data_info_factura['flete_ptj'];
    $cod_cliente                                                    = $data_info_factura['cod_cliente'];
    $vlr_cancelado                                                  = $data_info_factura['vlr_cancelado'];
    $vlr_vuelto                                                     = $data_info_factura['vlr_vuelto'];
    $fecha_dia                                                      = $data_info_factura['fecha_dia'];
    $fecha_mes                                                      = $data_info_factura['fecha_mes'];
    $fecha_anyo                                                     = $data_info_factura['fecha_anyo'];
    $anyo                                                           = $data_info_factura['anyo'];
    $fecha_hora                                                     = $data_info_factura['fecha_hora'];
    $fecha_remision                                                 = $data_info_factura['fecha_remision'];
    $nombre_ccosto                                                  = $data_info_factura['nombre_ccosto'];
    $garantia_meses                                                 = $data_info_factura['garantia_meses'];
    $observacion                                                    = $data_info_factura['observacion'];
    $cod_tipo_pago                                                  = $data_info_factura['cod_tipo_pago'];
    $cod_administrador                                              = $data_info_factura['cod_administrador'];
    $nombre_tipo_producto                                           = $data_info_factura['nombre_tipo_producto'];
    $total_precio_compra                                            = $data_info_factura['total_precio_compra'];
    $total_precio_venta                                             = $data_info_factura['total_precio_venta'];
    $cod_dependencia                                                = $data_info_factura['cod_dependencia'];
    $servicio                                                       = $data_info_factura['servicio'];
    $cod_tipo_forma_pago                                            = $data_info_factura['cod_tipo_forma_pago'];
    $nombre_tipo_forma_pago                                         = $data_info_factura['nombre_tipo_forma_pago'];
    $descripcion_tipo_forma_pago                                    = $data_info_factura['descripcion_tipo_forma_pago'];
    $nombre_tipo_factura                                            = $data_info_factura['nombre_tipo_factura'];
    $nombre_tipo_moneda                                             = $data_info_factura['nombre_tipo_moneda'];
    $cod_cierre_caja                                                = $data_info_factura['cod_cierre_caja'];
    $fecha_creacion                                                 = $data_info_factura['fecha_creacion'];
    $fecha_modificacion                                             = $data_info_factura['fecha_modificacion'];
    $nombre_maquina                                                 = $data_info_factura['nombre_maquina'];
    $cod_tipo_cobrar                                                = $data_info_factura['cod_tipo_cobrar'];
    $cod_estado_vacuna                                              = $data_info_factura['cod_estado_vacuna'];
    $cod_resolucion_facturacion                                     = $data_info_factura['cod_resolucion_facturacion'];
    $cod_tipo_inventario                                            = $data_info_factura['cod_tipo_inventario'];
    $observacion_tercero                                            = $data_info_factura['observacion_tercero'];
    $cod_tipo_metodo_envio                                          = $data_info_factura['cod_tipo_metodo_envio'];
    $nombre1_tercero_ext                                            = $data_info_factura['nombre1_tercero'];
    $nombre_factura_remision                                        = $data_info_factura['nombre_factura_remision'];
    $nombre_tipo_pendiente                                          = $data_info_factura['nombre_tipo_pendiente'];
    $descripcion_tipo_pendiente                                     = $data_info_factura['descripcion_tipo_pendiente'];
    $fecha_entrega                                                  = $data_info_factura['fecha_entrega'];
    $hora_entrega                                                   = $data_info_factura['hora_entrega'];
    $nombre_elaboro                                                 = $data_info_factura['nombre_elaboro'];
    $fecha_pago                                                     = $data_info_factura['fecha_pago'];
    $cod_domiciliario                                               = $data_info_factura['cod_domiciliario'];
    $cod_puc                                                        = $data_info_factura['cod_puc'];
    $cod_sino_crear_mov_contable                                    = $data_info_factura['cod_sino_crear_mov_contable'];
    $cod_puntos_redimibles_campanya                                 = $data_info_factura['cod_puntos_redimibles_campanya'];
    $cod_movimiento_contable_cuenta_personal                        = $data_info_factura['cod_movimiento_contable_cuenta_personal'];
    $cod_movimiento_caja                                            = $data_info_factura['cod_movimiento_caja'];
    $retefuente_ptj                                                 = $data_info_factura['retefuente_ptj'];
    $reteica_ptj                                                    = $data_info_factura['reteica_ptj'];
    $reteiva_ptj                                                    = $data_info_factura['reteiva_ptj'];
    $cod_estado_alquiler_renta                                      = $data_info_factura['cod_estado_alquiler_renta'];
    $fecha_ini_renta_alquiler                                       = $data_info_factura['fecha_ini_renta_alquiler'];
    $fecha_fin_renta_alquiler                                       = $data_info_factura['fecha_fin_renta_alquiler'];
    $total_precio_venta                                             = $data_info_factura['total_precio_venta'];
    $monto_deuda                                                    = $data_info_factura['monto_deuda'];
    $monto_cuota                                                    = $data_info_factura['monto_cuota'];
    $monto_deuda_sin_interes                                        = $data_info_factura['monto_deuda_sin_interes'];
    $numero_cuota                                                   = $data_info_factura['numero_cuota'];
    $nombre_tipo_cobro                                              = $data_info_factura['nombre_tipo_cobro'];
    $cod_tercero                                                    = $data_info_factura['cod_tercero'];
    $cod_factura                                                    = $data_info_factura['cod_factura'];
    $direccion_tercero                                              = $data_info_factura['direccion_tercero'];
    $telefono1_tercero                                              = $data_info_factura['telefono1_tercero'];
    $nombre_tipo_cobro                                              = $data_info_factura['nombre_tipo_cobro'];
    $correo_tercero                                                 = $data_info_factura['correo_tercero'];
    $nombre_estado_factura                                          = $data_info_factura['nombre_estado_factura'];
    $cuenta                                                         = $data_info_factura['cuenta'];
    $cod_caja_virtual                                               = $data_info_factura['cod_caja_virtual'];
    $cod_entidad_crediticia                                         = $data_info_factura['cod_entidad_crediticia'];
    $cod_tienda                                                     = $data_info_factura['cod_tienda'];
    $cod_operador_credito                                           = $data_info_factura['cod_operador_credito'];
    $cod_tipo_forma_pago_operador_credito                           = $data_info_factura['cod_tipo_forma_pago_operador_credito'];
    $descripcion_tipo_forma_pago_operador_credito                   = $data_info_factura['descripcion_tipo_forma_pago_operador_credito'];
    $cod_administrador_lider                                        = $data_info_factura['cod_administrador_lider'];
    $cod_administrador_coordinador                                  = $data_info_factura['cod_administrador_coordinador'];
    $cod_administrador_asesor                                       = $data_info_factura['cod_administrador_asesor'];
    $cod_administrador_aliado_estrategico                           = $data_info_factura['cod_administrador_aliado_estrategico'];
    $cod_administrador_revisor                                      = $data_info_factura['cod_administrador_revisor'];
    $identificacion_tercero                                         = $data_info_factura['identificacion_tercero'];
    $nombre1_tercero                                                = $data_info_factura['nombre1_tercero'];
    $nombre2_tercero                                                = $data_info_factura['nombre2_tercero'];
    $apellido1_tercero                                              = $data_info_factura['apellido1_tercero'];
    $apellido2_tercero                                              = $data_info_factura['apellido2_tercero'];
    $cod_banco_cuenta                                               = $data_info_factura['cod_banco_cuenta'];
    $cod_vendedor                                                   = $data_info_factura['cod_vendedor'];

    $mostrar_datos_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
    $consulta_resolucion_facturacion = mysqli_query($conectar, $mostrar_datos_resolucion_facturacion) or die(mysqli_error($conectar));
    $matriz_consulta_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

    $prefijo_resolucion_facturacion                     = $matriz_consulta_resolucion_facturacion['prefijo_resolucion_facturacion'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_lider = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_lider')";
    $consulta_administrador_lider = mysqli_query($conectar, $sql_administrador_lider) or die(mysqli_error($conectar));
    $datos_administrador_lider = mysqli_fetch_assoc($consulta_administrador_lider);

    $nombres_apellidos_lider                                        = $datos_administrador_lider['nombres'].' '.$datos_administrador_lider['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_coordinador = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_coordinador')";
    $consulta_administrador_coordinador = mysqli_query($conectar, $sql_administrador_coordinador) or die(mysqli_error($conectar));
    $datos_administrador_coordinador = mysqli_fetch_assoc($consulta_administrador_coordinador);

    $nombres_apellidos_coordinador                                  = $datos_administrador_coordinador['nombres'].' '.$datos_administrador_coordinador['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_asesor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_asesor')";
    $consulta_administrador_asesor = mysqli_query($conectar, $sql_administrador_asesor) or die(mysqli_error($conectar));
    $datos_administrador_asesor = mysqli_fetch_assoc($consulta_administrador_asesor);

    $nombres_apellidos_asesor                                       = $datos_administrador_asesor['nombres'].' '.$datos_administrador_asesor['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_aliado_estrategico = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_aliado_estrategico')";
    $consulta_administrador_aliado_estrategico = mysqli_query($conectar, $sql_administrador_aliado_estrategico) or die(mysqli_error($conectar));
    $datos_administrador_aliado_estrategico = mysqli_fetch_assoc($consulta_administrador_aliado_estrategico);

    $nombres_apellidos_aliado_estrategico                           = $datos_administrador_aliado_estrategico['nombres'].' '.$datos_administrador_aliado_estrategico['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_administrador_revisor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_revisor')";
    $consulta_administrador_revisor = mysqli_query($conectar, $sql_administrador_revisor) or die(mysqli_error($conectar));
    $datos_administrador_revisor = mysqli_fetch_assoc($consulta_administrador_revisor);

    $nombres_apellidos_revisor                                       = $datos_administrador_revisor['nombres'].' '.$datos_administrador_revisor['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $nombre_entidad_crediticia                                      = $datos_entidad_crediticia['nombre_entidad_crediticia'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tienda = "SELECT * FROM tbl15_tienda WHERE (cod_tienda = '$cod_tienda')";
    $consulta_tienda = mysqli_query($conectar, $sql_tienda) or die(mysqli_error($conectar));
    $datos_tienda = mysqli_fetch_assoc($consulta_tienda);

    $nombre_tienda                                      = $datos_tienda['nombre_tienda'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_operador_credito = "SELECT * FROM tbl15_operador_credito WHERE (cod_operador_credito = '$cod_operador_credito')";
    $consulta_operador_credito = mysqli_query($conectar, $sql_operador_credito) or die(mysqli_error($conectar));
    $datos_operador_credito = mysqli_fetch_assoc($consulta_operador_credito);

    $nombre_operador_credito                                      = $datos_operador_credito['nombre_operador_credito'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_venta_producto = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto = mysqli_query($conectar, $sql_venta_producto) or die(mysqli_error($conectar));
    $datos_venta_producto = mysqli_fetch_assoc($consulta_venta_producto);

    $cod_producto_barra                                             = $datos_venta_producto['cod_producto_barra'];
    $nombre_producto                                                = $datos_venta_producto['nombre_producto'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $datos_data_info_factura = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
    $consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
    $data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
    $factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

    $identificacion_tercero                                         = $data_info_factura['identificacion_tercero'];
    $nombre1_tercero                                                = $data_info_factura['nombre1_tercero'];
    $nombre2_tercero                                                = $data_info_factura['nombre2_tercero'];
    $apellido1_tercero                                              = $data_info_factura['apellido1_tercero'];
    $apellido2_tercero                                              = $data_info_factura['apellido2_tercero'];
    $nombre_cliente                                                 = trim($nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero).' - '.$identificacion_tercero;
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_banco_cuenta = "SELECT * FROM tbl15_banco_cuenta WHERE (cod_banco_cuenta = '$cod_banco_cuenta')";
    $consulta_banco_cuenta = mysqli_query($conectar, $sql_banco_cuenta) or die(mysqli_error($conectar));
    $datos_banco_cuenta = mysqli_fetch_assoc($consulta_banco_cuenta);

    $nombre_banco_cuenta                                            = $datos_banco_cuenta['nombre_banco_cuenta'].' | '.$datos_banco_cuenta['numero_banco_cuenta'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_vendedor = "SELECT * FROM tbl15_vendedor WHERE (cod_vendedor = '$cod_vendedor')";
    $consulta_vendedor = mysqli_query($conectar, $sql_vendedor) or die(mysqli_error($conectar));
    $datos_vendedor = mysqli_fetch_assoc($consulta_vendedor);

    $nombre_vendedor                                                = $datos_vendedor['nombres'].' '.$datos_vendedor['apellidos'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_pago = "SELECT * FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago                                        = $datos_tipo_pago['nombre_tipo_pago'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
    $consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
    $datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

    $nombre_tipo_forma_pago                                        = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_tipo_forma_pago_operador_credito = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago_operador_credito')";
    $consulta_tipo_forma_pago_operador_credito = mysqli_query($conectar, $sql_tipo_forma_pago_operador_credito) or die(mysqli_error($conectar));
    $datos_tipo_forma_pago_operador_credito = mysqli_fetch_assoc($consulta_tipo_forma_pago_operador_credito);

    $nombre_tipo_forma_pago_operador_credito                        = $datos_tipo_forma_pago_operador_credito['nombre_tipo_forma_pago'];
    /* ----------------------------------------------------------------------------------------------------------/ */
    $sql_venta_producto = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_venta_producto = mysqli_query($conectar, $sql_venta_producto) or die(mysqli_error($conectar));
    $datos_venta_producto = mysqli_fetch_assoc($consulta_venta_producto);

    $cod_producto_barra                                             = $datos_venta_producto['cod_producto_barra'];
    $nombre_producto                                                = $datos_venta_producto['nombre_producto'];

    $suma_temporal = "SELECT Sum(total_venta_producto) As total_precio_venta_info, Sum(total_costo_producto) As total_compra, Sum(peso_producto * und_venta) As total_peso_producto, 
    Count(cod_venta_producto) As total_art_temp FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_temporal = mysqli_query($conectar, $suma_temporal);
    $matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

    $total_precio_venta_info                                        = $matriz_temporal['total_precio_venta_info'];
    $total_venta                                                    = $matriz_temporal['total_precio_venta_info'];
    $total_peso_producto                                            = $matriz_temporal['total_peso_producto'];
    $total_art_temp                                                 = $matriz_temporal['total_art_temp'];

	$writer->addRow(array($fecha_anyo, $nombre_entidad_crediticia, $monto_deuda_sin_interes, $monto_deuda, $nombres_apellidos_asesor, 'PAGADO', $cod_info_factura_venta));
	//$writer->addRow(array((int) 00, 'Customer name', (double) 23.12, '20-01-2016'));
}
$writer->close();
?>