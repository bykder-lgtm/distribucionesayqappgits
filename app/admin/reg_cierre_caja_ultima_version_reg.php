<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->

<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->

<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->

<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"><a href="#">Guardando...</a> <img src="../imagenes/popup_ajax_loader.gif" class="img-polaroid" alt=""></div>

<div class="row-fluid">
<div class="span12" id="divMain">
<?php
require '../PHPMailer/PHPMailerAutoload.php';
include_once '../admin/class_php/smtp.conf.outlook.php';

$nombres_apellidos                                              = 'Cierre de Caja';
$cod_curl                                                       = '1';
$pagina_local                                                   = $_SERVER['PHP_SELF'];
$nombre_emisor                                                  = "Alertas y Notificaciones ".ucwords(strtolower($nombre_emp));
$correo_emisor                                                  = $Username;
$nombre_receptor                                                = $nombres_apellidos;
$correo_receptor                                                = $correo_notificacion_alerta;
$cod_curl_strpad                                                = str_pad($cod_curl, 6, "0", STR_PAD_LEFT);
$correo_enviar                                                  = $correo_notificacion_alerta;
$invitacion                                                     = "Alertas y Notificaciones";
$nombre_tipo_asunto                                             = 'Cierre de caja';
$fecha_anyo_hoy                                                 = date("Y-m-d");
$fecha_anyo_seg                                                 = strtotime($fecha_anyo_hoy);
$fecha_dia                                                      = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                                                      = date("Y-m", $fecha_anyo_seg);
$anyo                                                           = date("Y", $fecha_anyo_seg);
$asunto_correo_enviar                                           = "".ucwords(strtolower($nombre_emp)).' - '.$nombre_tipo_asunto;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_administrador'])) {

  $cod_administrador                                            = intval($_POST['cod_administrador']);
  $fecha_ymd_venta_producto                                     = addslashes($_POST['fecha_ymd_venta_producto']);
  $fecha_anyo                                                   = $fecha_ymd_venta_producto;
  $total_fisico_cierre_caja                                     = addslashes($_POST['total_fisico_cierre_caja']);
  $total_sistema_cierre_caja                                    = addslashes($_POST['total_sistema_cierre_caja']);
  $total_base_cierre_caja                                       = addslashes($_POST['total_base_cierre_caja']);
  $total_sistema_contado_efectivo_cierre_caja                   = addslashes($_POST['total_sistema_contado_efectivo_cierre_caja']);
  $total_base_mas_fisico_cierre_caja                            = addslashes($_POST['total_base_mas_fisico_cierre_caja']);
  $total_abono_efectivo_cuenta_cobrar_cierre_caja               = addslashes($_POST['total_abono_efectivo_cuenta_cobrar_cierre_caja']);
  $resultado_cierre_caja                                        = addslashes($_POST['resultado_cierre_caja']);
  $cod_tipo_cierre_caja                                         = intval($_POST['cod_tipo_cierre_caja']);

  if ($cod_tipo_cierre_caja == '0') { $moneda_50 = intval($_POST['moneda_50']); $moneda_100 = intval($_POST['moneda_100']); $moneda_200 = intval($_POST['moneda_200']); $moneda_500 = intval($_POST['moneda_500']); $moneda_1000 = intval($_POST['moneda_1000']); $moneda_2000 = intval($_POST['moneda_2000']); $moneda_5000 = intval($_POST['moneda_5000']); $moneda_10000 = intval($_POST['moneda_10000']); $moneda_20000 = intval($_POST['moneda_20000']); $moneda_50000 = intval($_POST['moneda_50000']); $moneda_100000 = intval($_POST['moneda_100000']);
  } else { $moneda_50 = 0; $moneda_100 = 0; $moneda_200 = 0; $moneda_500 = 0; $moneda_1000 = 0; $moneda_2000 = 0; $moneda_5000 = 0; $moneda_10000 = 0; $moneda_20000 = 0; $moneda_50000 = 0; $moneda_100000 = 0; }

  $fecha_mes                                                    = date("Y-m", strtotime($fecha_anyo));
  $hora                                                         = date("H:i:s");
  $fecha_cierre_caja                                            = date("Y-m-d");
  $hora_cierre_caja                                             = date("H:i:s");
  $fecha_time_cierre_caja                                       = time();
  $contado                                                      = '1';
  $credito                                                      = '2';
  $efectivo                                                     = '1';
  $transferencia_electronica                                    = '10';
  $cod_tercero                                                  = "1";
  if (isset($_POST['total_compra_producto_sistema_cierre_caja'])) { $total_compra_producto_sistema_cierre_caja = addslashes($_POST['total_compra_producto_sistema_cierre_caja']); } else { $total_compra_producto_sistema_cierre_caja = '0'; }
//---------------------------------------------------------------------------------------------------------------------------------------------//
  $sql_tercero = "SELECT * FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
  $resultado_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
  $datos_tercero = mysqli_fetch_assoc($resultado_tercero);

  $nombre1_tercero                                               = $datos_tercero['nombre1_tercero'];
  $apellido1_tercero                                             = $datos_tercero['apellido1_tercero'];
  $nit_cliente                                                   = $datos_tercero['identificacion_tercero'];
  $nombres_clientes                                              = $nombre1_tercero.' '.$apellido1_tercero;
//---------------------------------------------------------------------------------------------------------------------------------------------//
  $obtener_info_cliente = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
  $resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
  $info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

  $usuario_cuenta                                               = $info_cliente['cuenta'];
  $cuenta                                                       = $info_cliente['cuenta'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
  $sql_autoincremento_sesion = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_cierre_caja'";
  $exec_autoincremento_sesion = mysqli_query($conectar, $sql_autoincremento_sesion) or die(mysqli_error($conectar));
  $datos_autoincremento_sesion = mysqli_fetch_assoc($exec_autoincremento_sesion);
  $cod_cierre_cajas                                             = $datos_autoincremento_sesion['AUTO_INCREMENT'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_venta = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_suma_compra_producto, 
  SUM(total_venta_producto * (comision_ptj/100)) AS total_comision 
  FROM tbl15_venta_producto WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador') AND (cod_cierre_caja = '0')";
  $consulta_total_venta = mysqli_query($conectar, $sql_total_venta) or die(mysqli_error($conectar));
  $datos_total_venta = mysqli_fetch_assoc($consulta_total_venta);

  $total_precio_venta                                           = $datos_total_venta['total_suma_venta_producto'];
  $total_precio_compra                                          = $datos_total_venta['total_suma_compra_producto'];
  $total_ganancia                                               = $total_precio_venta - $total_precio_compra;
  $total_comision_venta                                         = $datos_total_venta['total_comision'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_venta_contado_efectivo = "SELECT SUM(total_venta_producto) AS total_venta_producto_contado_efectivo, SUM(total_compra_producto) AS total_compra_producto
  FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador') AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo') AND (cod_cierre_caja = '0')";
  $consulta_total_venta_contado_efectivo = mysqli_query($conectar, $sql_total_venta_contado_efectivo) or die(mysqli_error($conectar));
  $datos_total_venta_contado_efectivo = mysqli_fetch_assoc($consulta_total_venta_contado_efectivo);

  $total_venta_efectivo                                         = $datos_total_venta_contado_efectivo['total_venta_producto_contado_efectivo'];
  $total_venta_producto_contado_efectivo                        = $datos_total_venta_contado_efectivo['total_venta_producto_contado_efectivo'];
  $total_compra_producto_contado                                = $datos_total_venta_contado_efectivo['total_compra_producto'];
  $total_venta_contado_efectivo_cierre_caja                     = $total_venta_efectivo;
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_venta_contado_transferencia_electronica = "SELECT SUM(total_venta_producto) AS total_venta_contado_transferencia_electronica, 
  SUM(total_compra_producto) AS total_compra_producto_contado_transferencia_electronica FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador') AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$transferencia_electronica') AND (cod_cierre_caja = '0')";
  $consulta_total_venta_contado_transferencia_electronica = mysqli_query($conectar, $sql_total_venta_contado_transferencia_electronica) or die(mysqli_error($conectar));
  $datos_total_venta_contado_transferencia_electronica = mysqli_fetch_assoc($consulta_total_venta_contado_transferencia_electronica);

  $total_venta_contado_transferencia_electronica                = $datos_total_venta_contado_transferencia_electronica['total_venta_contado_transferencia_electronica'];
  $total_compra_producto_contado_transferencia_electronica      = $datos_total_venta_contado_transferencia_electronica['total_compra_producto_contado_transferencia_electronica'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_cuentas_cobrar_abonos_efectivo = "SELECT SUM(abonado) AS total_abono_cuenta_cobrar FROM tbl15_cuentas_cobrar_abonos 
  WHERE (fecha_anyo = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador')";
  $consulta_cuentas_cobrar_abonos_efectivo = mysqli_query($conectar, $sql_cuentas_cobrar_abonos_efectivo) or die(mysqli_error($conectar));
  $info_cuentas_cobrar_abonos_efectivo = mysqli_fetch_assoc($consulta_cuentas_cobrar_abonos_efectivo);

  $total_abono_cuenta_cobrar    = $info_cuentas_cobrar_abonos_efectivo['total_abono_cuenta_cobrar'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_venta_contado = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto
  FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador') AND (cod_tipo_pago = '$contado') AND (cod_cierre_caja = '0')";
  $consulta_total_venta_contado = mysqli_query($conectar, $sql_total_venta_contado) or die(mysqli_error($conectar));
  $datos_total_venta_contado = mysqli_fetch_assoc($consulta_total_venta_contado);

  $total_venta_contado                                          = $datos_total_venta_contado['total_venta_producto'];
  $total_compra_producto_contado                                = $datos_total_venta_contado['total_compra_producto'];
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_venta_credito = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto 
  FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador') AND (cod_tipo_pago = '$credito') AND (cod_cierre_caja = '0')";
  $consulta_total_venta_credito = mysqli_query($conectar, $sql_total_venta_credito) or die(mysqli_error($conectar));
  $datos_total_venta_credito = mysqli_fetch_assoc($consulta_total_venta_credito);

  $total_venta_credito                                          = $datos_total_venta_credito['total_venta_producto'];
  $total_venta_producto_credito_cuenta_cobrar                   = $datos_total_venta_credito['total_venta_producto'];
  $total_compra_producto_credito                                = $datos_total_venta_credito['total_compra_producto'];
//---------------------------------------------------------------------------------------------------------------------------------------------//
  $max_cierre_caja_venta = "SELECT MAX(cod_cierre_caja) AS cod_cierre_caja FROM tbl15_venta_producto WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador')";
  $consulta_cierre_caja_ventas = mysqli_query($conectar, $max_cierre_caja_venta) or die(mysqli_error($conectar));
  $max_cierre_caja = mysqli_fetch_assoc($consulta_cierre_caja_ventas);

  $cod_cierre_caja                                              = $max_cierre_caja['cod_cierre_caja'] + 1;
  $pagina                                                       = "../admin/factura_cierre_caja_opcion_imprimir_ultima_version.php"."?cod_cierre_cajas=".$cod_cierre_cajas;
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
  $sql_data = "UPDATE tbl15_venta_producto SET cod_cierre_caja = '$cod_cierre_caja', fecha_cierre_caja = '$fecha_cierre_caja', 
  hora_cierre_caja = '$hora_cierre_caja', fecha_time_cierre_caja = '$fecha_time_cierre_caja'
  WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador') AND (cod_cierre_caja = '0')";
  $exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

  $agregar_operacion = "INSERT INTO tbl15_cierre_caja (cod_cierre_caja, total_sistema_cierre_caja, total_sistema_contado_efectivo_cierre_caja, total_base_mas_fisico_cierre_caja, 
  resultado_cierre_caja, total_fisico_cierre_caja, total_abono_cuenta_cobrar, total_venta_contado_efectivo_cierre_caja, total_abono_efectivo_cuenta_cobrar_cierre_caja, 
  moneda_50, moneda_100, moneda_200, moneda_500, moneda_1000, moneda_2000, moneda_5000, 
  moneda_10000, moneda_20000, moneda_50000, moneda_100000, vendedor, fecha_anyo, fecha_mes, fecha_cierre_caja, 
  hora_cierre_caja, fecha_time_cierre_caja, total_base_cierre_caja, cod_administrador, 
  total_venta_credito, total_venta_contado, total_venta_efectivo, total_precio_venta, total_precio_compra, total_ganancia, total_comision_venta, cod_tipo_cierre_caja)
  VALUES ('$cod_cierre_caja', '$total_sistema_cierre_caja', '$total_sistema_contado_efectivo_cierre_caja', '$total_base_mas_fisico_cierre_caja', 
  '$resultado_cierre_caja', '$total_fisico_cierre_caja', '$total_abono_cuenta_cobrar', '$total_venta_contado_efectivo_cierre_caja', '$total_abono_efectivo_cuenta_cobrar_cierre_caja', 
  '$moneda_50', '$moneda_100', '$moneda_200', '$moneda_500', '$moneda_1000', '$moneda_2000', '$moneda_5000', 
  '$moneda_10000', '$moneda_20000', '$moneda_50000', '$moneda_100000', '$cuenta_actual', '$fecha_anyo', '$fecha_mes', '$fecha_cierre_caja', 
  '$hora_cierre_caja', '$fecha_time_cierre_caja', '$total_base_cierre_caja', '$cod_administrador', 
  '$total_venta_credito', '$total_venta_contado', '$total_venta_efectivo', '$total_precio_venta', '$total_precio_compra', '$total_ganancia', '$total_comision_venta', '$cod_tipo_cierre_caja')";
  $resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));
//---------------------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------------------//
/*
  if ($cod_estado_generar_movimiento_contable_automatico_global == '1') {
    $nombre_tipo_documento                                      = 'RECIBO DE CAJA';
    $nombre_estado_factura                                      = 'CERRADA';
    $ip                                                         = $_SERVER["REMOTE_ADDR"];
    $total_costo_movimiento_contable_smrt                       = 0;
    $fecha_movimiento_contable_cuenta_personal                  = date("Y-m-d");
    $cod_estado_automatico                                      = "1";

    $sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
    $exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
    $datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

    $cod_movimiento_contable                                    = $datos_autoincremento_egresos['AUTO_INCREMENT'];
    $cod_movimiento_contable2                                   = $cod_movimiento_contable;

    $sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
    $consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
    $info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

    $cod_guia                                                   = $info_guia_movimiento['cod_guia']+1;

    $cod_tipo_forma_pago                                        = 1;
    $fecha_anyo_hoy                                             = date("Y-m-d H:i:s");
    $fecha_anyo_seg                                             = strtotime($fecha_anyo_hoy);
    $fecha_dia                                                  = date("Y-m-d", $fecha_anyo_seg);
    $fecha_mes                                                  = date("Y-m", $fecha_anyo_seg);
    $anyo                                                       = date("Y", $fecha_anyo_seg);
    $fecha_anyo                                                 = date("Y-m-d", $fecha_anyo_seg);
    $fecha_ymd                                                  = date("Y-m-d", $fecha_anyo_seg);
    $fecha_seg                                                  = strtotime($fecha_anyo_hoy);
    $fecha_factura                                              = date("Y-m-d", $fecha_anyo_seg);

    $doc_modifica                                               = "total_sistema: ".$total_sistema_cierre_caja." | total_sistema_efectivo: ".$total_sistema_contado_efectivo_cierre_caja." | total_base: ".$total_base_cierre_caja." | total_fisico: ".$total_fisico_cierre_caja." | resultado: ".$resultado_cierre_caja;
    $descripcion_movimiento                                     = "cierre de caja ventas | fecha: ".$fecha_ymd_venta_producto." | vendedor: ".$usuario_cuenta." | hora_cierre_caja: ".$hora_cierre_caja;
    $total_costo_movimiento_contable                            = $total_fisico_cierre_caja;
    $cod_tipo_nota_observacion                                  = 0;
    $comentario                                                 = "";

    $agreg_mov_contable_reg = "INSERT INTO tbl15_movimiento_contable (nombre_estado_factura, doc_modifica, nombre_tipo_documento, descripcion_movimiento, total_costo_movimiento_contable, 
    cod_tercero, fecha_anyo, fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, cod_tipo_forma_pago, ip, cuenta, cod_guia, cod_tipo_nota_observacion, cod_estado_automatico, nit_cliente, nombres_clientes)
    VALUES ('$nombre_estado_factura',  '$doc_modifica', '$nombre_tipo_documento', '$descripcion_movimiento', '$total_costo_movimiento_contable', 
    '$cod_tercero', '$fecha_anyo', '$fecha_ymd', '$fecha_mes', '$anyo', '$fecha_seg', '$fecha_factura', '$cod_tipo_forma_pago', '$ip', '$cuenta', '$cod_guia', '$cod_tipo_nota_observacion', '$cod_estado_automatico', '$nit_cliente', '$nombres_clientes')";
    $resultado_mov_contable = mysqli_query($conectar, $agreg_mov_contable_reg) or die(mysqli_error($conectar));

    $nombre_tipo_movimiento                                     = 'DEBITOS';
    $cod_puc                                                    = '4';
    $codigo_puc                                                 = '110505';
    $nombre_puc                                                 = 'CAJA GENERAL';
    $tipo_puc                                                   = 'ACTIVO';
    $und_vendida                                                = '1';
    $costo_movimiento_contable                                  = $total_fisico_cierre_caja;
    $total_costo_movimiento_contable                            = $total_fisico_cierre_caja;  

    $agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
    total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
    VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
    '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
    $resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

    $nombre_tipo_movimiento                                     = 'CREDITOS';
    $cod_puc                                                    = '1473';
    $codigo_puc                                                 = '4205';
    $nombre_puc                                                 = 'OTRAS VENTAS';
    $tipo_puc                                                   = 'INGRESOS';
    $und_vendida                                                = '1';
    $costo_movimiento_contable                                  = $total_fisico_cierre_caja;
    $total_costo_movimiento_contable                            = $total_fisico_cierre_caja;  

    $agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
    total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
    VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
    '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
    $resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));



    $sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
    $exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
    $datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

    $cod_movimiento_contable                                    = $datos_autoincremento_egresos['AUTO_INCREMENT'];
    $cod_movimiento_contable2                                   = $cod_movimiento_contable;

    $sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
    $consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
    $info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

    $cod_guia                                                   = $info_guia_movimiento['cod_guia']+1;
    $nombre_tipo_documento                                      = 'MOVIMIENTO INTERNO';
    $descripcion_movimiento                                     = "Movimiento interno crrcajvent diner totl | fecha: ".$fecha_ymd_venta_producto." | vendedor: ".$usuario_cuenta;

    $agreg_mov_contable_reg = "INSERT INTO tbl15_movimiento_contable (nombre_estado_factura, nombre_tipo_documento, descripcion_movimiento, total_costo_movimiento_contable,  
    cod_tercero, fecha_anyo, fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, cod_tipo_forma_pago, ip, cuenta, cod_guia, cod_tipo_nota_observacion, cod_estado_automatico, nit_cliente, nombres_clientes)
    VALUES ('$nombre_estado_factura',  '$nombre_tipo_documento', '$descripcion_movimiento', '$total_costo_movimiento_contable', 
    '$cod_tercero', '$fecha_anyo', '$fecha_ymd', '$fecha_mes', '$anyo', '$fecha_seg', '$fecha_factura', '$cod_tipo_forma_pago', '$ip', '$cuenta', '$cod_guia', '$cod_tipo_nota_observacion', '$cod_estado_automatico', '$nit_cliente', '$nombres_clientes')";
    $resultado_mov_contable = mysqli_query($conectar, $agreg_mov_contable_reg) or die(mysqli_error($conectar));

    if ($total_venta_producto_contado_efectivo > 0) {

      $sql_total_venta_contado_efectivo_agrupado_puc = "SELECT cod_puc, SUM(total_venta_producto) AS total_venta_producto_contado_efectivo_agrupado_puc, SUM(total_compra_producto) AS total_compra_producto_contado_agrupado_puc
      FROM tbl15_venta_producto 
      WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador') 
      AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo') AND (cod_cierre_caja = '0') GROUP BY cod_puc";
      $consulta_total_venta_contado_efectivo_agrupado_puc = mysqli_query($conectar, $sql_total_venta_contado_efectivo_agrupado_puc) or die(mysqli_error($conectar));
      $datos_total_venta_contado_efectivo_agrupado_puc = mysqli_fetch_assoc($consulta_total_venta_contado_efectivo_agrupado_puc);
      while ($datos_total_venta_contado_efectivo_agrupado_puc = mysqli_fetch_assoc($consulta_total_venta_contado_efectivo_agrupado_puc)) {

        $cod_puc                                                                   = $datos_total_venta_contado_efectivo_agrupado_puc['cod_puc'];
        $total_venta_efectivo_agrupado_puc                                         = $datos_total_venta_contado_efectivo_agrupado_puc['total_venta_producto_contado_efectivo_agrupado_puc'];
        $total_venta_producto_contado_efectivo_agrupado_puc                        = $datos_total_venta_contado_efectivo_agrupado_puc['total_venta_producto_contado_efectivo_agrupado_puc'];
        $total_compra_producto_contado_agrupado_puc                                = $datos_total_venta_contado_efectivo_agrupado_puc['total_compra_producto_contado_agrupado_puc'];

        $sql_puc = "SELECT codigo_puc, nombre_puc, tipo_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
        $consulta_puc = mysqli_query($conectar, $sql_puc) or die(mysqli_error($conectar));
        $datos_puc = mysqli_fetch_assoc($consulta_puc);

        $nombre_tipo_movimiento                                                    = 'DEBITOS';
        $codigo_puc                                                                = $datos_puc['codigo_puc'];
        $nombre_puc                                                                = $datos_puc['nombre_puc'];
        $tipo_puc                                                                  = $datos_puc['tipo_puc'];
        $und_vendida                                                               = '1';
        $costo_movimiento_contable                                                 = $total_venta_producto_contado_efectivo_agrupado_puc;
        $total_costo_movimiento_contable                                           = $total_venta_producto_contado_efectivo_agrupado_puc * $und_vendida; 

        $agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
        total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
        VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
        '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
        $resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));
        
      }
    }

    if ($total_venta_contado_transferencia_electronica > 0) {

      $sql_total_venta_contado_transferencia_electronica_agrupado_puc = "SELECT cod_puc, SUM(total_venta_producto) AS total_venta_contado_transferencia_electronica_agrupado_puc, 
      SUM(total_compra_producto) AS total_compra_producto_contado_transferencia_electronica_agrupado_puc FROM tbl15_venta_producto 
      WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador') AND (cod_tipo_pago = '$contado') 
      AND (cod_tipo_forma_pago = '$transferencia_electronica') AND (cod_cierre_caja = '0') GROUP BY cod_puc";
      $consulta_total_venta_contado_transferencia_electronica_agrupado_puc = mysqli_query($conectar, $sql_total_venta_contado_transferencia_electronica_agrupado_puc) or die(mysqli_error($conectar));
      while ($datos_total_venta_contado_transferencia_electronica_agrupado_puc = mysqli_fetch_assoc($consulta_total_venta_contado_transferencia_electronica_agrupado_puc)) {

        $cod_puc                                                                   = $datos_total_venta_contado_transferencia_electronica_agrupado_puc['cod_puc'];
        $total_venta_contado_transferencia_electronica_agrupado_puc                = $datos_total_venta_contado_transferencia_electronica_agrupado_puc['total_venta_contado_transferencia_electronica_agrupado_puc'];
        $total_compra_producto_contado_transferencia_electronica_agrupado_puc      = $datos_total_venta_contado_transferencia_electronica_agrupado_puc['total_compra_producto_contado_transferencia_electronica_agrupado_puc'];

        $sql_puc = "SELECT codigo_puc, nombre_puc, tipo_puc FROM tbl15_puc WHERE (cod_puc = '$cod_puc')";
        $consulta_puc = mysqli_query($conectar, $sql_puc) or die(mysqli_error($conectar));
        $datos_puc = mysqli_fetch_assoc($consulta_puc);

        $nombre_tipo_movimiento                                                    = 'DEBITOS';
        $codigo_puc                                                                = $datos_puc['codigo_puc'];
        $nombre_puc                                                                = $datos_puc['nombre_puc'];
        $tipo_puc                                                                  = $datos_puc['tipo_puc'];
        $und_vendida                                                               = '1';
        $costo_movimiento_contable                                                 = $total_venta_contado_transferencia_electronica_agrupado_puc;
        $total_costo_movimiento_contable                                           = $total_venta_contado_transferencia_electronica_agrupado_puc * $und_vendida; 

        $agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
        total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
        VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
        '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
        $resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));
      }
    }

    if ($total_venta_producto_credito_cuenta_cobrar > 0) {
      $nombre_tipo_movimiento                                                     = 'DEBITOS';
      $cod_puc                                                                    = '142';
      $codigo_puc                                                                 = '13';
      $nombre_puc                                                                 = 'CUENTAS POR COBRAR (DEUDORES)';
      $tipo_puc                                                                   = 'ACTIVO';
      $und_vendida                                                                = '1';
      $costo_movimiento_contable                                                  = $total_venta_producto_credito_cuenta_cobrar;
      $total_costo_movimiento_contable                                            = $total_venta_producto_credito_cuenta_cobrar;

      $agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
      total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
      VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
      '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
      $resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));
    }

    $nombre_tipo_movimiento                                                       = 'CREDITOS';
    $cod_puc                                                                      = '1473';
    $codigo_puc                                                                   = '4205';
    $nombre_puc                                                                   = 'OTRAS VENTAS';
    $tipo_puc                                                                     = 'INGRESOS';
    $und_vendida                                                                  = '1';
    $costo_movimiento_contable                                                    = $total_venta_producto_contado_efectivo + $total_venta_contado_transferencia_electronica + $total_venta_producto_credito_cuenta_cobrar;
    $total_costo_movimiento_contable                                              = $total_venta_producto_contado_efectivo + $total_venta_contado_transferencia_electronica + $total_venta_producto_credito_cuenta_cobrar;

    $agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
    total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
    VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
    '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
    $resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));



    $sql_autoincremento_egresos = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_movimiento_contable'";
    $exec_autoincremento_egresos = mysqli_query($conectar, $sql_autoincremento_egresos) or die(mysqli_error($conectar));
    $datos_autoincremento_egresos = mysqli_fetch_assoc($exec_autoincremento_egresos);

    $cod_movimiento_contable                                                      = $datos_autoincremento_egresos['AUTO_INCREMENT'];
    $cod_movimiento_contable2                                                     = $cod_movimiento_contable;

    $sql_guia_movimiento = "SELECT MAX(cod_guia) AS cod_guia FROM tbl15_movimiento_contable WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (nombre_tipo_documento = '$nombre_tipo_documento')";
    $consulta_guia_movimiento = mysqli_query($conectar, $sql_guia_movimiento) or die(mysqli_error($conectar));
    $info_guia_movimiento = mysqli_fetch_assoc($consulta_guia_movimiento);

    $cod_guia                                                                     = $info_guia_movimiento['cod_guia']+1;
    $nombre_tipo_documento                                                        = 'MOVIMIENTO INTERNO';
    $descripcion_movimiento                                                       = "Movimiento interno crrcajvent cost vent - invent| fecha: ".$fecha_ymd_venta_producto." | vendedor: ".$usuario_cuenta;

    $agreg_mov_contable_reg = "INSERT INTO tbl15_movimiento_contable (nombre_estado_factura, nombre_tipo_documento, descripcion_movimiento, total_costo_movimiento_contable, cod_tercero, fecha_anyo, 
    fecha_ymd, fecha_mes, anyo, fecha_seg, fecha_factura, cod_tipo_forma_pago, ip, cuenta, cod_guia, cod_tipo_nota_observacion, cod_estado_automatico, nit_cliente, nombres_clientes)
    VALUES ('$nombre_estado_factura',  '$nombre_tipo_documento', '$descripcion_movimiento', '$total_costo_movimiento_contable', '$cod_tercero', '$fecha_anyo', 
    '$fecha_ymd', '$fecha_mes', '$anyo', '$fecha_seg', '$fecha_factura', '$cod_tipo_forma_pago', '$ip', '$cuenta', '$cod_guia', '$cod_tipo_nota_observacion', '$cod_estado_automatico', '$nit_cliente', '$nombres_clientes')";
    $resultado_mov_contable = mysqli_query($conectar, $agreg_mov_contable_reg) or die(mysqli_error($conectar));

    $nombre_tipo_movimiento                                                       = 'DEBITOS';
    $cod_puc                                                                      = '263';
    $codigo_puc                                                                   = '14';
    $nombre_puc                                                                   = 'INVENTARIOS';
    $tipo_puc                                                                     = 'ACTIVO';
    $und_vendida                                                                  = '1';
    $costo_movimiento_contable                                                    = $total_precio_compra;
    $total_costo_movimiento_contable                                              = $total_precio_compra;

    $agreg_mov_debito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
    total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
    VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
    '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
    $resultado_mov_debito = mysqli_query($conectar, $agreg_mov_debito_reg) or die(mysqli_error($conectar));

    $nombre_tipo_movimiento                                                       = 'CREDITOS';
    $cod_puc                                                                      = '2539';
    $codigo_puc                                                                   = '61';
    $nombre_puc                                                                   = 'COSTOS DE VENTAS';
    $tipo_puc                                                                     = 'COSTOS DE VENTAS';
    $und_vendida                                                                  = '1';
    $costo_movimiento_contable                                                    = $total_precio_compra;
    $total_costo_movimiento_contable                                              = $total_precio_compra;

    $agreg_mov_credito_reg = "INSERT INTO tbl15_movimiento_contable_concepto (cod_movimiento_contable, cod_puc, nombre_tipo_movimiento, nombre_tipo_documento, codigo_puc, nombre_puc, tipo_puc, und_vendida, costo_movimiento_contable, 
    total_costo_movimiento_contable, fecha_anyo, fecha_mes, fecha_seg, fecha_ymd, anyo, ip, cuenta, comentario, cod_tercero, cod_guia, cod_movimiento_contable2, cod_estado_automatico)
    VALUES ('$cod_movimiento_contable', '$cod_puc', '$nombre_tipo_movimiento', '$nombre_tipo_documento', '$codigo_puc', '$nombre_puc', '$tipo_puc', '$und_vendida', '$costo_movimiento_contable', 
    '$total_costo_movimiento_contable', '$fecha_anyo', '$fecha_mes', '$fecha_seg', '$fecha_ymd', '$anyo', '$ip', '$cuenta', '$comentario', '$cod_tercero', '$cod_guia', '$cod_movimiento_contable2', '$cod_estado_automatico')";
    $resultado_mov_credito = mysqli_query($conectar, $agreg_mov_credito_reg) or die(mysqli_error($conectar));
  }
*/
//---------------------------------------------------------------------------------------------------------------------------------------------//
  if ($cod_estado_envio_correo_global == '1') {
    $mensaje = "
    <!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
    <html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
    <head>
    <!--[if gte mso 9]>
    <xml>
      <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
      <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <meta name='x-apple-disable-message-reformatting'>
      <!--[if !mso]><!--><meta http-equiv='X-UA-Compatible' content='IE=edge'><!--<![endif]-->
      <title></title>
      
    <style type='text/css'>
    table, td { color: #000000; } a { color: #0000ee; text-decoration: underline; }
    @media only screen and (min-width: 620px) { .u-row { width: 600px !important; }
    .u-row .u-col { vertical-align: top; }
    .u-row .u-col-100 { width: 600px !important; }
    }
    @media (max-width: 620px) { .u-row-container { max-width: 100% !important; padding-left: 0px !important; padding-right: 0px !important; }
    .u-row .u-col { min-width: 320px !important; max-width: 100% !important; display: block !important; }
    .u-row { width: calc(100% - 40px) !important; }
    .u-col { width: 100% !important; }
    .u-col > div { margin: 0 auto; }
    }
    body { margin: 0; padding: 0; }
    table, tr, td { vertical-align: top; border-collapse: collapse; }
    p { margin: 0; }
    .ie-container table, .mso-container table { table-layout: fixed; }
    * { line-height: inherit; }
    a[x-apple-data-detectors='true'] { color: inherit !important; text-decoration: none !important; }
    @media (max-width: 480px) { .hide-mobile { display: none !important; max-height: 0px; overflow: hidden; }
    }
    </style>

    <!--[if !mso]><!--><link href='https://fonts.googleapis.com/css?family=Lato:400,700&display=swap' rel='stylesheet' type='text/css'><link href='https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap' rel='stylesheet' type='text/css'><!--<![endif]-->

    </head>
    ";
    $mensaje .= "<body class='clean-body' style='margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff;color: #000000'>";

    $mensaje .= "
      <!--[if IE]><div class='ie-container'><![endif]-->
      <!--[if mso]><div class='mso-container'><![endif]-->
      <table style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%' cellpadding='0' cellspacing='0'>
      <tbody>
      <tr style='vertical-align: top'>
        <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
        <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td align='center' style='background-color: #ffffff;'><![endif]-->
        

    <div class='u-row-container' style='padding: 0px;background-color: transparent'>
      <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ecf0f1;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
          <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #ecf0f1;'><![endif]-->
          
    <!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
    <div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
      <div style='width: 100% !important;'>
      <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
      
    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:8px;font-family:arial,helvetica,sans-serif;' align='left'>
            
      <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #ffffff;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
        <tbody>
          <tr style='vertical-align: top'>
            <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
              <span>&#160;</span>
            </td>
          </tr>
        </tbody>
      </table>

          </td>
        </tr>
      </tbody>
    </table>

    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;' align='left'>
            
    <table width='100%' cellpadding='0' cellspacing='0' border='0'>
      <tr>
        <td style='padding-right: 0px;padding-left: 0px;' align='center'>
          
          <img align='center' border='0' src='../imagenes/cabecera_correo_hclinica.png' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 150px;' width='150'/>
          
        </td>
      </tr>
    </table>

          </td>
        </tr>
      </tbody>
    </table>

    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:6px;font-family:arial,helvetica,sans-serif;' align='left'>
            
      <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #ffffff;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
        <tbody>
          <tr style='vertical-align: top'>
            <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
              <span>&#160;</span>
            </td>
          </tr>
        </tbody>
      </table>

          </td>
        </tr>
      </tbody>
    </table>

      <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
      </div>
    </div>
    <!--[if (mso)|(IE)]></td><![endif]-->
          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>



    <div class='u-row-container' style='padding: 0px;background-color: transparent'>
      <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #0CCBFF;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
          <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #0CCBFF;'><![endif]-->
          
    <!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
    <div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
      <div style='width: 100% !important;'>
      <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
    ";

    $mensaje .= "
    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:30px 10px 15px 25px;font-family:arial,helvetica,sans-serif;' align='left'>
            
      <div style='line-height: 140%; text-align: center; word-wrap: break-word;'>
        <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='font-size: 48px; line-height: 67.2px;'><span style='line-height: 67.2px; font-family: 'book antiqua', palatino; color: #000000; font-size: 48px;'><span style='line-height: 67.2px; font-size: 48px;'>Cierre de Caja</span></span></span></p>
      </div>

          </td>
        </tr>
      </tbody>
    </table>
    ";

    $time_seg                                = time();
    $time_date_ymd                           = strtotime(date("Y-m-d"));
    $hora                                    = date("His");
    $fecha_venta_ymd                         = date("Ymd");
    $hora_venta_his                          = date("His");
    $fecha_impr                              = date("Ymd");
    $hora_impr                               = date("His");
    $anyo_actual                             = date("Y");
    $fecha_actual                            = date("Y-m-d");
    $concat_observ                           = "";

    $obtener_info_fact = "SELECT * FROM tbl15_cierre_caja WHERE (cod_cierre_cajas = '$cod_cierre_cajas')";
    $resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
    $info_fact = mysqli_fetch_assoc($resultado_info_fact);

    $total_fisico_cierre_caja                           = $info_fact['total_fisico_cierre_caja'];
    $total_sistema_cierre_caja                          = $info_fact['total_sistema_cierre_caja'];
    $total_sistema_contado_efectivo_cierre_caja         = $info_fact['total_sistema_contado_efectivo_cierre_caja'];
    $total_sistema_credito_cierre_caja                  = $info_fact['total_sistema_credito_cierre_caja'];
    $total_base_cierre_caja                             = $info_fact['total_base_cierre_caja'];
    $total_abono_cuenta_cobrar                          = $info_fact['total_abono_cuenta_cobrar'];
    $moneda_50                                          = $info_fact['moneda_50'];
    $moneda_100                                         = $info_fact['moneda_100'];
    $moneda_200                                         = $info_fact['moneda_200'];
    $moneda_500                                         = $info_fact['moneda_500'];
    $moneda_1000                                        = $info_fact['moneda_1000'];
    $moneda_2000                                        = $info_fact['moneda_2000'];
    $moneda_5000                                        = $info_fact['moneda_5000'];
    $moneda_10000                                       = $info_fact['moneda_10000'];
    $moneda_20000                                       = $info_fact['moneda_20000'];
    $moneda_50000                                       = $info_fact['moneda_50000'];
    $moneda_100000                                      = $info_fact['moneda_100000'];
    $comentario                                         = $info_fact['comentario'];
    $vendedor                                           = $info_fact['vendedor'];
    $fecha_anyo                                         = $info_fact['fecha_anyo'];
    $fecha_mes                                          = $info_fact['fecha_mes'];
    $fecha_cierre_caja                                  = $info_fact['fecha_cierre_caja'];
    $hora_cierre_caja                                   = $info_fact['hora_cierre_caja'];
    $fecha_time_cierre_caja                             = $info_fact['fecha_time_cierre_caja'];
    $cod_cierre_caja                                    = $info_fact['cod_cierre_caja'];
    $cod_administrador                                  = $info_fact['cod_administrador'];
    $resultado_cierre_caja                              = $info_fact['resultado_cierre_caja'];
    $total_venta_credito                                = $info_fact['total_venta_credito'];
    $total_venta_contado                                = $info_fact['total_venta_contado'];
    $total_venta_efectivo                               = $info_fact['total_venta_efectivo'];
    $total_precio_venta                                 = $info_fact['total_precio_venta'];
    $total_precio_compra                                = $info_fact['total_precio_compra'];
    $total_ganancia                                     = $info_fact['total_ganancia'];
    $total_comision_venta                               = $info_fact['total_comision_venta'];
     

    $obtener_diseno_usario_vendedor = "SELECT cuenta, nombres, apellidos, cod_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
    $resultado_diseno_usario_vendedor = mysqli_query($conectar, $obtener_diseno_usario_vendedor) or die(mysqli_error($conectar));
    $matriz_usario_vendedor = mysqli_fetch_assoc($resultado_diseno_usario_vendedor);

    $usario_vendedor                                    = $matriz_usario_vendedor['nombres'].' '.$matriz_usario_vendedor['apellidos'];
    $cod_caja                                           = $matriz_usario_vendedor['cod_caja'];
    $cuenta                                             = $matriz_usario_vendedor['cuenta'];

    $mensaje .= "
    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tr>
        <td><font color='black' size= '+3'>EMPRESA:</font></td>
        <td style='text-align:right;' colspan='2'><font color='black' size= '+3'>".$nombre_emp."</font></td>
      </tr>
      <tr>
        <td><font color='black' size= '+3'>CIERRE:</font></td>
        <td style='text-align:right;' colspan='2'><font color='black' size= '+3'>".$cod_cierre_caja."</font></td>
      </tr>
      <tr>
        <td><font color='black' size= '+3'>VENDEDOR:</font></td>
        <td style='text-align:right;' colspan='2'><font color='black' size= '+3'>".$cuenta."</font></td>
      </tr>
      <tr>
        <td><font color='black' size= '+3'>BASE:</font></td>
        <td style='text-align:right;' colspan='2'><font color='black' size= '+3'>".number_format($total_base_cierre_caja, 0, ",", ".")."</font></td>
      </tr>
      <tr>
        <td><font color='black' size= '+3'>TOTAL FISICO:</font></td>
        <td style='text-align:right;' colspan='2'><font color='black' size= '+3'>".number_format($total_fisico_cierre_caja, 0, ",", ".")."</font></td>
      </tr>
      <tr>
        <td><font color='black' size= '+3'>BASE + FISICO:</font></td>
        <td style='text-align:right;' colspan='2'><font color='black' size= '+3'>".number_format($total_base_cierre_caja + $total_fisico_cierre_caja, 0, ",", ".")."</font></td>
      </tr>
      <tr>
        <td><font color='black' size= '+3'>TOTAL SISTEMA:</font></td>
        <td style='text-align:right;' colspan='2'><font color='black' size= '+3'>".number_format($total_sistema_cierre_caja, 0, ",", ".")."</font></td>
      </tr>
      <tr>
        <td><font color='black' size= '+3'>TOTAL GANANCIA:</font></td>
        <td style='text-align:right;' colspan='2'><font color='black' size= '+3'>".number_format($total_ganancia, 0, ",", ".")."</font></td>
      </tr>
      <tr>
        <td><font color='black' size= '+3'>RESULTADO:</font></td>
        <td style='text-align:right;' colspan='2'><font color='black' size= '+3'>".number_format($resultado_cierre_caja, 0, ",", ".")."</font></td>
      </tr>
      <tr>
        <td><font color='black' size= '+3'>FECHA DE CIERRE:</font></td>
        <td style='text-align:right;' colspan='2'><font color='black' size= '+3'>".$fecha_anyo."</font></td>
      </tr>
      <tr>
        <td><font color='black' size= '+3'>HORA DE CIERRE:</font></td>
        <td style='text-align:right;' colspan='2'><font color='black' size= '+3'>".$hora_cierre_caja."</font></td>
      </tr>
    </table>


      <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
      </div>
    </div>
    <!--[if (mso)|(IE)]></td><![endif]-->
          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>



    <div class='u-row-container' style='padding: 0px;background-color: transparent'>
      <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ecf0f1;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
          <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #ecf0f1;'><![endif]-->
          
    <!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
    <div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
      <div style='width: 100% !important;'>
      <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
      

    <!--
    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:0px 20px 0px 0px;font-family:arial,helvetica,sans-serif;' align='left'>
            
    <table width='100%' cellpadding='0' cellspacing='0' border='0'>
      <tr>
        <td style='padding-right: 0px;padding-left: 0px;' align='center'>
          
          <img align='center' border='0' src='../imagenes/image-6.png' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 217px;' width='217'/>
          
        </td>
      </tr>
    </table>

          </td>
        </tr>
      </tbody>
    </table>
    -->

    <!--
    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:30px 40px 10px;font-family:arial,helvetica,sans-serif;' align='left'>
            
      <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
        <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='font-family: Lato, sans-serif; font-size: 16px; line-height: 22.4px;'>Hola, </span><span style='font-family: Lato, sans-serif; font-size: 16px; line-height: 22.4px;'>Por medio de este correo enviamos un archivo adjunto en pdf de la historia clínica</span></p>
      </div>
          </td>
        </tr>
      </tbody>
    </table>


    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:10px 30px;font-family:arial,helvetica,sans-serif;' align='left'>
      <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
        <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='font-size: 16px; line-height: 22.4px; font-family: Lato, sans-serif;'>As a sorry, we offer a <span style='color: #ef0d33; font-size: 16px; line-height: 22.4px;'><strong><span style='font-size: 18px; line-height: 25.2px;'><span style='line-height: 25.2px; font-size: 18px;'>15% off</span> </span></strong></span>all items in your cart this week!</span></p>
      </div>
          </td>
        </tr>
      </tbody>
    </table>

    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:arial,helvetica,sans-serif;' align='left'>
      <div style='line-height: 140%; text-align: center; word-wrap: break-word;'>
        <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='font-size: 16px; line-height: 22.4px;'><strong><span style='font-family: Lato, sans-serif; line-height: 22.4px; font-size: 16px;'>U S E&nbsp; &nbsp; C O D E:&nbsp; &nbsp; </span><span style='font-family: Lato, sans-serif; line-height: 22.4px; font-size: 16px; color: #218838;'>HAPPY15%</span></strong></span></p>
      </div>
          </td>
        </tr>
      </tbody>
    </table>

    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:10px 10px 50px;font-family:arial,helvetica,sans-serif;' align='left'>
    <div align='center'>
        <a href='' target='_blank' style='box-sizing: border-box;display: inline-block;font-family:arial,helvetica,sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #0CCBFF; border-radius: 0px; -webkit-border-radius: 0px; -moz-border-radius: 0px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;'>
          <span style='display:block;padding:13px 28px;line-height:120%;'><span style='font-size: 16px; line-height: 19.2px; font-family: Lato, sans-serif;'>START&nbsp; &nbsp;SHOPPING</span></span>
        </a>
    </div>
          </td>
        </tr>
      </tbody>
    </table>
    -->
      <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
      </div>
    </div>
    <!--[if (mso)|(IE)]></td><![endif]-->
          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>

    <div class='u-row-container' style='padding: 0px;background-color: transparent'>
      <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ecf0f1;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
          <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #ecf0f1;'><![endif]-->
          
    <!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
    <div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
      <div style='width: 100% !important;'>
      <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
      
    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:arial,helvetica,sans-serif;' align='left'>
    <table width='100%' cellpadding='0' cellspacing='0' border='0'>
      <tr>
        <td style='padding-right: 0px;padding-left: 0px;' align='center'>
          <img align='center' border='0' src='../imagenes/image-4.png' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 552px;' width='552'/>
        </td>
      </tr>
    </table>

          </td>
        </tr>
      </tbody>
    </table>

      <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
      </div>
    </div>
    <!--[if (mso)|(IE)]></td><![endif]-->
          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>

    <div class='u-row-container' style='padding: 0px;background-color: transparent'>
      <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #000000;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
          <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #000000;'><![endif]-->
          
    <!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
    <div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
      <div style='width: 100% !important;'>
      <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
      
    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:40px 10px 20px;font-family:arial,helvetica,sans-serif;' align='left'>
    <div align='center'>
      <div style='display: table; max-width:207px;'>
      <!--[if (mso)|(IE)]><table width='207' cellpadding='0' cellspacing='0' border='0'><tr><td style='border-collapse:collapse;' align='center'><table width='100%' cellpadding='0' cellspacing='0' border='0' style='border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:207px;'><tr><![endif]-->
      
        <!--[if (mso)|(IE)]><td width='32' style='width:32px; padding-right: 20px;' valign='top'><![endif]-->
        <table align='left' border='0' cellspacing='0' cellpadding='0' width='32' height='32' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 20px'>
          <tbody><tr style='vertical-align: top'><td align='left' valign='middle' style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
            <a href='https://twitter.com/' title='Twitter' target='_blank'>
              <img src='../imagenes/image-2.png' alt='Twitter' title='Twitter' width='32' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important'>
            </a>
          </td></tr>
        </tbody></table>
        <!--[if (mso)|(IE)]></td><![endif]-->
        
        <!--[if (mso)|(IE)]><td width='32' style='width:32px; padding-right: 20px;' valign='top'><![endif]-->
        <table align='left' border='0' cellspacing='0' cellpadding='0' width='32' height='32' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 20px'>
          <tbody><tr style='vertical-align: top'><td align='left' valign='middle' style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
            <a href='https://linkedin.com/' title='LinkedIn' target='_blank'>
              <img src='../imagenes/image-3.png' alt='LinkedIn' title='LinkedIn' width='32' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important'>
            </a>
          </td></tr>
        </tbody></table>
        <!--[if (mso)|(IE)]></td><![endif]-->
        
        <!--[if (mso)|(IE)]><td width='32' style='width:32px; padding-right: 20px;' valign='top'><![endif]-->
        <table align='left' border='0' cellspacing='0' cellpadding='0' width='32' height='32' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 20px'>
          <tbody><tr style='vertical-align: top'><td align='left' valign='middle' style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
            <a href='https://instagram.com/' title='Instagram' target='_blank'>
              <img src='../imagenes/image-1.png' alt='Instagram' title='Instagram' width='32' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important'>
            </a>
          </td></tr>
        </tbody></table>
        <!--[if (mso)|(IE)]></td><![endif]-->
        
        <!--[if (mso)|(IE)]><td width='32' style='width:32px; padding-right: 0px;' valign='top'><![endif]-->
        <table align='left' border='0' cellspacing='0' cellpadding='0' width='32' height='32' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px'>
          <tbody><tr style='vertical-align: top'><td align='left' valign='middle' style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
            <a href='https://github.com/' title='GitHub' target='_blank'>
              <img src='../imagenes/image-7.png' alt='GitHub' title='GitHub' width='32' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important'>
            </a>
          </td></tr>
        </tbody></table>
        <!--[if (mso)|(IE)]></td><![endif]-->
        
        
        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
      </div>
    </div>

          </td>
        </tr>
      </tbody>
    </table>

      <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
      </div>
    </div>
    <!--[if (mso)|(IE)]></td><![endif]-->
          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>

    <div class='u-row-container' style='padding: 0px;background-color: transparent'>
      <div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #000000;'>
        <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
          <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px;background-color: transparent;' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #000000;'><![endif]-->
          
    <!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
    <div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
      <div style='width: 100% !important;'>
      <!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->
    <!--
    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:10px 40px;font-family:arial,helvetica,sans-serif;' align='left'>
            
      <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
        <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #ffffff; font-size: 14px; line-height: 19.6px; font-family: Lato, sans-serif;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse </span></p>
      </div>

          </td>
        </tr>
      </tbody>
    </table>
    -->
    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:20px 10px 2px;font-family:arial,helvetica,sans-serif;' align='left'>
            
      <table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='90%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #6e7074;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
        <tbody>
          <tr style='vertical-align: top'>
            <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
              <span>&#160;</span>
            </td>
          </tr>
        </tbody>
      </table>

          </td>
        </tr>
      </tbody>
    </table>

    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:7px 40px 5px;font-family:arial,helvetica,sans-serif;' align='left'>
      <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
        <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #ffffff; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>&copy; Editaxe Pos &nbsp;| &nbsp;".$anyo_actual."</span></p>
      </div>
          </td>
        </tr>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:7px 40px 5px;font-family:arial,helvetica,sans-serif;' align='left'>
      <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
        <p style='font-size: 14px; line-height: 140%; text-align: center;'>
        <span style='color: #ffffff; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Soporte Y Mantenimiento: <a href='".$pag_desarrollador_emp."'>".$desarrollador_emp."</a></span>
        </p>
      </div>
          </td>
        </tr>
      </tbody>
    </table>

    <table style='font-family:arial,helvetica,sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
      <tbody>
        <tr>
          <td style='overflow-wrap:break-word;word-break:break-word;padding:7px 40px 20px;font-family:arial,helvetica,sans-serif;' align='left'>
      <div style='line-height: 140%; text-align: left; word-wrap: break-word;'>
        <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #666666; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Ha recibido este correo electrónico como usuario registrado de ".$pag_desarrollador_emp."</span></p>
    <p style='font-size: 14px; line-height: 140%; text-align: center;'><span style='color: #666666; font-size: 12px; line-height: 16.8px; font-family: Lato, sans-serif;'>Usted puede <span style='text-decoration: underline; line-height: 16.8px; font-size: 12px;'>darse de baja </span>de estos correos electrónicos aquí.</span></p>
      </div>
          </td>
        </tr>
      </tbody>
    </table>

      <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
      </div>
    </div>
    <!--[if (mso)|(IE)]></td><![endif]-->
          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
        </div>
      </div>
    </div>


        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
        </td>
      </tr>
      </tbody>
      </table>
      <!--[if mso]></div><![endif]-->
      <!--[if IE]></div><![endif]-->
    ";
    $mensaje .= "</body>";
    $mensaje .= "</html>";


    $cod_tipo_modulo_envio_correo         = "8";
    $nombre_tipo_modulo_envio_correo      = "CIERRE DE CAJA - EDITAXE POS";
    $id_origen_correo                     = "";
    $nombre_tabla_origen_correo           = "";
    $nombre_campo_origen_correo           = "";
    $nombre_origen_correo                 = "Recordatorio cierre de caja";
    $correo_emisor                        = $correo_emisor;
    $correo_receptor                      = $correo_receptor;
    $asunto_correo                        = $asunto_correo_enviar;
    $mensaje_correo                       = $mensaje;
    $fecha_envio_correo                   = date("Y-m-d");
    $hora_envio_correo                    = date("H:i:s");
    $fecha_ymd_his                        = date("Y-m-d H:i:s");
    $fecha_time                           = time();
    $url_origen_correo                    = $_SERVER['PHP_SELF'];

    $sql_envio_correo = "SELECT * FROM tbl15_envio_correo WHERE (cod_tipo_modulo_envio_correo = '$cod_tipo_modulo_envio_correo') AND (fecha_envio_correo = '$fecha_envio_correo') AND (cod_estado_envio_correo = '1')";
    $consultar_envio_correo = mysqli_query($conectar, $sql_envio_correo) or die(mysqli_error($conectar));
    $existe_reg_envio_correo_repetido = mysqli_num_rows($consultar_envio_correo);

    $mail = new PHPMailer;
    $mail->SMTPDebug = 3;                          // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $Host;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = $SMTPAuth;                               // Enable SMTP authentication
    $mail->Username = $Username;                   // SMTP username
    $mail->Password = $Password;                             // SMTP password
    $mail->SMTPSecure = $SMTPSecure;                              // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $Port;                                      // TCP port to connect to
    $mail->setFrom($correo_emisor, $correo_notificacion_alerta);
    $mail->addAddress($correo_receptor, $nombre_receptor);
    $mail->Subject = $asunto_correo_enviar;
    $mail->MsgHTML($mensaje);
    //$mail->AddAttachment($ruta_global_archivo, $nombre_documento);
    //$mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

    if(!$mail->send()) { //INICIO SI EL CORREO NO SE ENVIA PORQUE HAY ERRORES
      $cod_estado_envio_correo            = 0;
      $nombre_estado_envio_correo         = "No Enviado";
      $descripcion_error_envio_correo     = $mail->ErrorInfo;
    }
    else { // INICIO SI EN CORREO SE ENVIO CORRECTAMENTE
      $cod_estado_envio_correo            = 1;
      $nombre_estado_envio_correo         = "Enviado Correctamente";
      $descripcion_error_envio_correo     = "";
    } //FIN SI EN CORREO SE ENVIO CORRECTAMENTE
    $sql_envio_correo = "INSERT INTO tbl15_envio_correo (cod_tipo_modulo_envio_correo, nombre_tipo_modulo_envio_correo, id_origen_correo, nombre_tabla_origen_correo, nombre_campo_origen_correo, 
    nombre_origen_correo, correo_emisor, correo_receptor, cod_estado_envio_correo, nombre_estado_envio_correo, descripcion_error_envio_correo, fecha_envio_correo, hora_envio_correo, 
    url_origen_correo, fecha_ymd_his, fecha_time, asunto_correo) 
    VALUES ('$cod_tipo_modulo_envio_correo', '$nombre_tipo_modulo_envio_correo', '$id_origen_correo', '$nombre_tabla_origen_correo', '$nombre_campo_origen_correo', 
    '$nombre_origen_correo', '$correo_emisor', '$correo_receptor', '$cod_estado_envio_correo', '$nombre_estado_envio_correo', '$descripcion_error_envio_correo', '$fecha_envio_correo', '$hora_envio_correo', 
    '$url_origen_correo', '$fecha_ymd_his', '$fecha_time', '$asunto_correo')";
    $resultado_envio_correo = mysqli_query($conectar, $sql_envio_correo) or die(mysqli_error($conectar));
  }
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina?>">
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

  <!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->

<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->

</body>
</html>