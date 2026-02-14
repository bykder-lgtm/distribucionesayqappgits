<?php
header('Content-Type: application/json; charset=UTF-8');
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');

$response = ["success" => false];

if (!isset($_POST['cod_info_factura_venta'])) { echo json_encode($response); exit; }

$cod_info_factura_venta = mysqli_real_escape_string($conectar, $_POST['cod_info_factura_venta']);
// Consulta principal para obtener los datos del crédito
$calcular_datos_cuenta_cobrar = "SELECT tbl15_info_factura_venta.cod_info_factura_venta, tbl15_info_factura_venta.cod_factura, tbl15_info_factura_venta.monto_deuda_sin_interes, 
tbl15_info_factura_venta.nombre_tipo_cobro, tbl15_info_factura_venta.cod_tercero, tbl15_info_factura_venta.monto_deuda, 
tbl15_info_factura_venta.monto_cuota, tbl15_info_factura_venta.cod_entidad_crediticia, tbl15_info_factura_venta.nombre_estado_factura, 
tbl15_info_factura_venta.cod_resolucion_facturacion, tbl15_info_factura_venta.cod_estado_factura, tbl15_info_factura_venta.fecha_creacion, 
tbl15_info_factura_venta.cod_tienda, tbl15_info_factura_venta.cod_administrador, tbl15_info_factura_venta.cod_tipo_pago, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.apellido2_tercero, 
tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, tbl15_tercero.telefono1_tercero, tbl15_tercero.correo_tercero, 
tbl15_info_factura_venta.cod_operador_credito, tbl15_info_factura_venta.cod_tipo_forma_pago_operador_credito, 
tbl15_info_factura_venta.cod_administrador_lider, tbl15_info_factura_venta.cod_administrador_coordinador, tbl15_info_factura_venta.cod_administrador_asesor, 
tbl15_info_factura_venta.cod_administrador_aliado_estrategico, tbl15_info_factura_venta.cod_administrador_revisor, 
tbl15_info_factura_venta.cod_vendedor, tbl15_info_factura_venta.cod_banco_cuenta, tbl15_info_factura_venta.cod_tipo_forma_pago, tbl15_info_factura_venta.observacion_tercero, 
tbl15_info_factura_venta.cod_estado_facturacion, tbl15_info_factura_venta.codigo_estado_facturacion, tbl15_info_factura_venta.codigo_tipo_estado_cargue_documentacion, tbl15_info_factura_venta.numero_cuota
FROM tbl15_tercero RIGHT JOIN tbl15_info_factura_venta ON tbl15_tercero.cod_tercero = tbl15_info_factura_venta.cod_tercero LEFT JOIN tbl15_entidad_crediticia ON tbl15_info_factura_venta.cod_entidad_crediticia = tbl15_entidad_crediticia.cod_entidad_crediticia
WHERE tbl15_info_factura_venta.cod_info_factura_venta = '$cod_info_factura_venta'";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar) or die(mysqli_error($conectar));
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$cod_info_factura_venta                                         = $datos_cuenta_cobrar['cod_info_factura_venta'];
$monto_deuda_sin_interes                                        = $datos_cuenta_cobrar['monto_deuda_sin_interes'];
$monto_deuda                                                    = $datos_cuenta_cobrar['monto_deuda'];
$monto_cuota                                                    = $datos_cuenta_cobrar['monto_cuota'];
$cod_tercero                                                    = $datos_cuenta_cobrar['cod_tercero'];
$cod_factura                                                    = $datos_cuenta_cobrar['cod_factura'];
$nombres_apellidos                                              = trim($datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['nombre2_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero']." ".$datos_cuenta_cobrar['apellido2_tercero']);
$direccion_tercero                                              = $datos_cuenta_cobrar['direccion_tercero'];
$telefono1_tercero                                              = $datos_cuenta_cobrar['telefono1_tercero'];
$identificacion_tercero                                         = $datos_cuenta_cobrar['identificacion_tercero'];
$nombre_tipo_cobro                                              = $datos_cuenta_cobrar['nombre_tipo_cobro'];
$correo_tercero                                                 = $datos_cuenta_cobrar['correo_tercero'];
$nombre_estado_factura                                          = $datos_cuenta_cobrar['nombre_estado_factura'];
$cod_resolucion_facturacion                                     = $datos_cuenta_cobrar['cod_resolucion_facturacion'];
$cod_estado_factura                                             = $datos_cuenta_cobrar['cod_estado_factura'];
$fecha_creacion                                                 = $datos_cuenta_cobrar['fecha_creacion'];
$cod_administrador_factura                                      = $datos_cuenta_cobrar['cod_administrador'];
$cod_tipo_pago                                                  = $datos_cuenta_cobrar['cod_tipo_pago'];
$cod_tipo_forma_pago                                            = $datos_cuenta_cobrar['cod_tipo_forma_pago'];
$cod_entidad_crediticia                                         = $datos_cuenta_cobrar['cod_entidad_crediticia'];
$cod_tienda                                                     = $datos_cuenta_cobrar['cod_tienda'];
$cod_operador_credito                                           = $datos_cuenta_cobrar['cod_operador_credito'];
$cod_tipo_forma_pago_operador_credito                           = $datos_cuenta_cobrar['cod_tipo_forma_pago_operador_credito'];
$cod_administrador_lider                                        = $datos_cuenta_cobrar['cod_administrador_lider'];
$cod_administrador_coordinador                                  = $datos_cuenta_cobrar['cod_administrador_coordinador'];
$cod_administrador_asesor                                       = $datos_cuenta_cobrar['cod_administrador_asesor'];
$cod_administrador_aliado_estrategico                           = $datos_cuenta_cobrar['cod_administrador_aliado_estrategico'];
$cod_administrador_revisor                                      = $datos_cuenta_cobrar['cod_administrador_revisor'];
$cod_vendedor                                                   = $datos_cuenta_cobrar['cod_vendedor'];
$cod_banco_cuenta                                               = $datos_cuenta_cobrar['cod_banco_cuenta'];
$observacion_tercero                                            = $datos_cuenta_cobrar['observacion_tercero'];
$cod_estado_facturacion                                         = $datos_cuenta_cobrar['cod_estado_facturacion'];
$codigo_estado_facturacion                                      = $datos_cuenta_cobrar['codigo_estado_facturacion'];
$codigo_tipo_estado_cargue_documentacion                           = $datos_cuenta_cobrar['codigo_tipo_estado_cargue_documentacion'];
$numero_cuota                                                   = $datos_cuenta_cobrar['numero_cuota'];     
/* ----------------------------------------------------------------------------------------------------------/ */
$contanenar_nombre_producto                                      = "";
$sql_venta_producto_temporal = "SELECT cod_producto_barra, nombre_producto FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
while ($datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal)) {

    $cod_producto_barra                                         = $datos_venta_producto_temporal['cod_producto_barra'];
    $nombre_producto                                            = $datos_venta_producto_temporal['nombre_producto'];
    $contanenar_nombre_producto                                .= $nombre_producto.' '; 
}
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
$sql_tienda = "SELECT nombre_tienda FROM tbl15_tienda WHERE cod_tienda = '$cod_tienda'";
$consulta_tienda = mysqli_query($conectar, $sql_tienda);
$datos_tienda = mysqli_fetch_assoc($consulta_tienda);
$existe_tienda = mysqli_num_rows($consulta_tienda);
if ($existe_tienda > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

$nombre_tienda                                                = $datos_tienda['nombre_tienda'] ?: "No especificada";
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_operador_credito = "SELECT * FROM tbl15_operador_credito WHERE (cod_operador_credito = '$cod_operador_credito')";
$consulta_operador_credito = mysqli_query($conectar, $sql_operador_credito) or die(mysqli_error($conectar));
$datos_operador_credito = mysqli_fetch_assoc($consulta_operador_credito);

$nombre_operador_credito                                      = $datos_operador_credito['nombre_operador_credito'];
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_banco_cuenta = "SELECT * FROM tbl15_banco_cuenta WHERE (cod_banco_cuenta = '$cod_banco_cuenta')";
$consulta_banco_cuenta = mysqli_query($conectar, $sql_banco_cuenta) or die(mysqli_error($conectar));
$datos_banco_cuenta = mysqli_fetch_assoc($consulta_banco_cuenta);
$existe_banco_cuenta = mysqli_num_rows($consulta_banco_cuenta);
if ($existe_banco_cuenta > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

$nombre_banco_cuenta                                          = $datos_banco_cuenta['nombre_banco_cuenta'] ?: "No especificado";
$numero_banco_cuenta                                          = $datos_banco_cuenta['numero_banco_cuenta'] ?: "No especificado";
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_vendedor = "SELECT * FROM tbl15_vendedor WHERE (cod_vendedor = '$cod_vendedor')";
$consulta_vendedor = mysqli_query($conectar, $sql_vendedor) or die(mysqli_error($conectar));
$datos_vendedor = mysqli_fetch_assoc($consulta_vendedor);
$existe_vendedor = mysqli_num_rows($consulta_vendedor);
if ($existe_vendedor > 0) { $separador_texto = ' '; } else { $separador_texto = ''; }

$nombre_vendedor                                              = $datos_vendedor['nombres'].$separador_texto.$datos_vendedor['apellidos'] ?: "No especificado";
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago);
$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);
$existe_tipo_pago = mysqli_num_rows($consulta_tipo_pago);
if ($existe_tipo_pago > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

$nombre_tipo_pago                                             = $datos_tipo_pago['nombre_tipo_pago'] ?: "No especificado";
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);
$existe_tipo_forma_pago = mysqli_num_rows($consulta_tipo_forma_pago);
if ($existe_tipo_forma_pago > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

$nombre_tipo_forma_pago                                       = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_tipo_forma_pago_operador_credito = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago_operador_credito')";
$consulta_tipo_forma_pago_operador_credito = mysqli_query($conectar, $sql_tipo_forma_pago_operador_credito) or die(mysqli_error($conectar));
$datos_tipo_forma_pago_operador_credito = mysqli_fetch_assoc($consulta_tipo_forma_pago_operador_credito);
$existe_tipo_forma_pago_operador_credito = mysqli_num_rows($consulta_tipo_forma_pago_operador_credito);
if ($existe_tipo_forma_pago_operador_credito > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

$nombre_tipo_forma_pago_operador_credito                      = $datos_tipo_forma_pago_operador_credito['nombre_tipo_forma_pago'];
/* ----------------------------------------------------------------------------------------------------------/ */
// Obtener nombre del administrador (aliado)
$sql_aliado = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_factura'";
$consulta_aliado = mysqli_query($conectar, $sql_aliado);
$datos_aliado = mysqli_fetch_assoc($consulta_aliado);
$existe_aliado = mysqli_num_rows($consulta_aliado);
if ($existe_aliado > 0) { $separador_texto = ' | '; } else { $separador_texto = ''; }

$nombre_aliado                                                = trim($datos_aliado['nombre1_tercero'].' '.$datos_aliado['apellido1_tercero']) ?: "No especificado";
//$nombre_aliado                                                = trim($datos_aliado['nombre1_tercero'].$separador_texto.$datos_aliado['apellido1_tercero']) ?: "No especificado";
/* ----------------------------------------------------------------------------------------------------------/ */
$sql_estado_facturacion = "SELECT * FROM tbl15_estado_facturacion WHERE (codigo_estado_facturacion = '$codigo_estado_facturacion')";
$consulta_estado_facturacion = mysqli_query($conectar, $sql_estado_facturacion) or die(mysqli_error($conectar));
$datos_estado_facturacion = mysqli_fetch_assoc($consulta_estado_facturacion);

$nombre_estado_facturacion                                    = $datos_estado_facturacion['nombre_estado_facturacion'];
$estilo_css_estado_factura                                    = $datos_estado_facturacion['color_fondo_celda_estado'];
/* ----------------------------------------------------------------------------------------------------------/ */
$mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_nota_observacion DESC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_nota_observacion                                           = $matriz_consulta['cod_nota_observacion'];
$nombre_nota_observacion                                        = $matriz_consulta['nombre_nota_observacion'];
$fecha_ymd                                                      = $matriz_consulta['fecha_ymd'];
$fecha_hora                                                     = $matriz_consulta['fecha_hora'];
$cuenta                                                         = $matriz_consulta['cuenta'];
$url_img_orig_producto                                          = $matriz_consulta['url_img_orig_producto'];
$url_img_min_producto                                           = $matriz_consulta['url_img_min_producto'];
$cod_posicion                                                   = $matriz_consulta['cod_posicion'];
$active                                                         = $matriz_consulta['active'];
$codigo_estado_revision                                         = $matriz_consulta['codigo_estado_revision'];
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_estado_revision = "SELECT * FROM tbl15_estado_revision WHERE (codigo_estado_revision = '$codigo_estado_revision')";
$consulta_estado_revision = mysqli_query($conectar, $sql_estado_revision);
$datos_estado_revision = mysqli_fetch_assoc($consulta_estado_revision);

$nombre_estado_revision                                         = $datos_estado_revision['nombre_estado_revision'];
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_resolucion_facturacion = "SELECT nombre_tipo_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
$resultado_resolucion_facturacion = mysqli_query($conectar, $obtener_resolucion_facturacion) or die(mysqli_error($conectar));
$info_resolucion_facturacion = mysqli_fetch_assoc($resultado_resolucion_facturacion);

$nombre_tipo_factura                                            = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_nota_observacion_cedula_en_mano = "SELECT url_img_min_producto FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_nota_observacion = 'FOTO DEL CLIENTE CON CEDULA EN MANO')";
$resultado_nota_observacion_cedula_en_mano = mysqli_query($conectar, $obtener_nota_observacion_cedula_en_mano) or die(mysqli_error($conectar));
$info_nota_observacion_cedula_en_mano = mysqli_fetch_assoc($resultado_nota_observacion_cedula_en_mano);

$url_img_min_producto_cedula_en_mano                            = $info_nota_observacion_cedula_en_mano['url_img_min_producto'];
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_nota_observacion_prod_const_entrega = "SELECT url_img_min_producto FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (nombre_nota_observacion = 'FOTO CON EL PRODUCTO COMO CONSTANCIA DE ENTREGA')";
$resultado_nota_observacion_prod_const_entrega = mysqli_query($conectar, $obtener_nota_observacion_prod_const_entrega) or die(mysqli_error($conectar));
$info_nota_observacion_prod_const_entrega = mysqli_fetch_assoc($resultado_nota_observacion_prod_const_entrega);

$url_img_min_producto_prod_const_entrega                        = $info_nota_observacion_prod_const_entrega['url_img_min_producto'];
/* ----------------------------------------------------------------------------------------------------------/ */
if ($nombre_estado_factura == 'ABIERTA') { $tabla_productos_venta = 'tbl15_venta_producto_temporal'; } else { $tabla_productos_venta = 'tbl15_venta_producto'; }

$sql_venta_producto_temporal = "SELECT cod_producto_barra, nombre_producto, serial1_producto, serial2_producto FROM $tabla_productos_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal) or die(mysqli_error($conectar));
$datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

$cod_producto_barra                                             = $datos_venta_producto_temporal['cod_producto_barra'];
$nombre_producto                                                = $datos_venta_producto_temporal['nombre_producto'];
$serial1_producto                                               = $datos_venta_producto_temporal['serial1_producto'];
$serial2_producto                                               = $datos_venta_producto_temporal['serial2_producto'];
/* ----------------------------------------------------------------------------------------------------------/ */
$porcentaje_interes_ganancia                                    = (($monto_deuda - $monto_deuda_sin_interes) / $monto_deuda_sin_interes) * 100;
/* ----------------------------------------------------------------------------------------------------------/ */
if ($consulta_datos_cuenta_cobrar && $datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {
    // Puedes ajustar los nombres de los campos según tu base de datos
    $response = [
        "success" => true,
        "nombres_apellidos" => $nombres_apellidos,
        "identificacion_tercero" => $identificacion_tercero,
        "monto_deuda" => $monto_deuda,
        "monto_deuda_sin_interes" => $monto_deuda_sin_interes,
        "monto_cuota" => $monto_cuota,
        "nombre_tipo_pago" => $nombre_tipo_pago,
        "cod_entidad_crediticia" => $cod_entidad_crediticia,
        "nombre_entidad_crediticia" => $nombre_entidad_crediticia,
        "nombre_operador_credito" => $nombre_operador_credito,
        "nombre_tienda" => $nombre_tienda,
        "nombre_aliado" => $nombre_aliado,
        "nombre_banco_cuenta" => $nombre_banco_cuenta,
        "nombre_estado_facturacion" => $nombre_estado_facturacion,
        "nombre_estado_revision" => $nombre_estado_revision,
        "nombres_apellidos_asesor" => $nombres_apellidos_asesor,
        "observacion_tercero" => $observacion_tercero,
        "fecha_formateada" => date('d/m/Y', strtotime($fecha_creacion)),
        "hora_formateada" => date('h:i A', strtotime($fecha_creacion)),
        "contanenar_nombre_producto" => $contanenar_nombre_producto,
        "nombre_vendedor" => $nombre_vendedor,
        "cod_tercero" => $cod_tercero,
        "cod_info_factura_venta" => $cod_info_factura_venta,
        "cod_vendedor" => $cod_vendedor,
        "cod_tienda" => $cod_tienda,
        "cod_banco_cuenta" => $cod_banco_cuenta,
        "numero_cuota" => $numero_cuota,
        "nombres_apellidos_lider" => $nombres_apellidos_lider,
        "nombres_apellidos_coordinador" => $nombres_apellidos_coordinador,
        "nombres_apellidos_aliado_estrategico" => $nombres_apellidos_aliado_estrategico,
        "nombres_apellidos_revisor" => $nombres_apellidos_revisor,
        "cod_administrador_lider" => $cod_administrador_lider,
        "cod_administrador_coordinador" => $cod_administrador_coordinador,
        "cod_administrador_asesor" => $cod_administrador_asesor,
        "cod_administrador_aliado_estrategico" => $cod_administrador_aliado_estrategico,
        "cod_administrador_revisor" => $cod_administrador_revisor,
        "cod_operador_credito" => $cod_operador_credito
    ];
}
echo json_encode($response);
exit;
