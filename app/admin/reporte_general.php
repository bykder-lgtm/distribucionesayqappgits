<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="../estilo_css/area_imprimible_invisible.css">
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Reporte General Por Rango de Fechas</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<?php
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");
$seleccionado                            = 0;
$cod_estado_ignorar_venta                = 0;

$contado                                 = '1';
$credito                                 = '2';
$efectivo                                = '1';
$transfer                                = '10';
$cod_servicio_propina                    = '22222222';
$cod_servicio_cava                       = '55555555';
$cod_servicio_domicilio                  = '44444444';
$cod_servicio_descuento_punto_redimible  = '11112222';

if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
  $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
  $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
  $fecha                                   = date("Y-m-d");
} else {
  $fecha_ymd_venta_producto_ini            = date("Y-m-d");
  $fecha_ymd_venta_producto_fin            = date("Y-m-d");
  $fecha                                   = date("Y-m-d");
}
$resta                                   = 1516399999;
$time_seg                                = time();
$time_date_ymd                           = strtotime(date("Y-m-d"));
$hora                                    = date("His");
$fecha_venta_ymd                         = date("Ymd");
$hora_venta_his                          = date("His");
$fecha_impr                              = date("Ymd");
$hora_impr                               = date("His");
?>
<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;"><a href="#">FECHA INICIAL</a></th>
    <th style="text-align:center;"><a href="#">FECHA FINAL</a></th>
    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" required/></td>
    <td style="text-align:center;"><input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" required/></td>
    <td style="text-align:center;"></td>
  </tr>
</table>
<div class="actions">
<input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</form>
<?php
if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
  $motivo                                  = 'TODOS';
  $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
  $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
  $fecha                                   = date("Y/m/d");
  $pagina                                  = $_SERVER['PHP_SELF'];
  $contado                                 = '1';
  $credito                                 = '2';
  $efectivo                                = '1';
  $cod_servicio_propina                    = '22222222';
  $cod_producto_barra                      = $cod_servicio_propina;
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  if ($cod_administrador==0) {
      $filtro_consulta_vendedor = "";
      $filtro_consulta_vendedor_rel = "";

      $sql_total_base_venddor = "SELECT SUM(total_base_cierre_caja) AS total_base_cierre_caja FROM tbl15_administrador";
      $consulta_total_base_venddor = mysqli_query($conectar, $sql_total_base_venddor) or die(mysqli_error($conectar));
      $datos_total_base_venddor = mysqli_fetch_assoc($consulta_total_base_venddor);

      $total_base_cierre_caja                                  = intval($datos_total_base_venddor['total_base_cierre_caja']);
  } else {
      $filtro_consulta_vendedor = "AND (cod_administrador = '$cod_administrador')";
      $filtro_consulta_vendedor_rel = "AND (tbl15_venta_producto.cod_administrador = '$cod_administrador')";

      $sql_total_base_venddor = "SELECT SUM(total_base_cierre_caja) AS total_base_cierre_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
      $consulta_total_base_venddor = mysqli_query($conectar, $sql_total_base_venddor) or die(mysqli_error($conectar));
      $datos_total_base_venddor = mysqli_fetch_assoc($consulta_total_base_venddor);

      $total_base_cierre_caja                                  = intval($datos_total_base_venddor['total_base_cierre_caja']);
  }
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_venta = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_compra_producto, 
  SUM(total_venta_producto * (comision_ptj/100)) AS total_comision 
  FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
  $consulta_total_venta = mysqli_query($conectar, $sql_total_venta) or die(mysqli_error($conectar));
  $datos_total_venta = mysqli_fetch_assoc($consulta_total_venta);

  $total_suma_venta_producto       = $datos_total_venta['total_suma_venta_producto'];
  $total_compra_producto            = $datos_total_venta['total_compra_producto'];
  $total_ganancia                  = $total_suma_venta_producto - $total_compra_producto;
  $total_comision_venta            = $datos_total_venta['total_comision'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_venta_contado_efectivo = "SELECT SUM(total_venta_producto) AS total_venta_producto_contado_efectivo, SUM(total_compra_producto) AS total_compra_producto
  FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
  AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo')";
  $consulta_total_venta_contado_efectivo = mysqli_query($conectar, $sql_total_venta_contado_efectivo) or die(mysqli_error($conectar));
  $datos_total_venta_contado_efectivo = mysqli_fetch_assoc($consulta_total_venta_contado_efectivo);

  $total_venta_producto_contado_efectivo    = $datos_total_venta_contado_efectivo['total_venta_producto_contado_efectivo'];
  $total_compra_producto_contado             = $datos_total_venta_contado_efectivo['total_compra_producto'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_venta_contado = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto
  FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '1')";
  $consulta_total_venta_contado = mysqli_query($conectar, $sql_total_venta_contado) or die(mysqli_error($conectar));
  $datos_total_venta_contado = mysqli_fetch_assoc($consulta_total_venta_contado);

  $total_venta_producto_contado    = $datos_total_venta_contado['total_venta_producto'];
  $total_compra_producto_contado    = $datos_total_venta_contado['total_compra_producto'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_venta_credito = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto 
  FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '2')";
  $consulta_total_venta_credito = mysqli_query($conectar, $sql_total_venta_credito) or die(mysqli_error($conectar));
  $datos_total_venta_credito = mysqli_fetch_assoc($consulta_total_venta_credito);

  $total_venta_producto_credito    = $datos_total_venta_credito['total_venta_producto'];
  $total_compra_producto_credito    = $datos_total_venta_credito['total_compra_producto'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_cuenta_credito_abono = "SELECT SUM(abonado) AS total_cuenta_credito_abonado FROM tbl15_cuentas_cobrar_abonos 
  WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
  $consulta_cuenta_credito_abono = mysqli_query($conectar, $sql_total_cuenta_credito_abono) or die(mysqli_error($conectar));
  $datos_cuenta_credito_abono = mysqli_fetch_assoc($consulta_cuenta_credito_abono);

  $total_cuenta_credito_abonado    = $datos_cuenta_credito_abono['total_cuenta_credito_abonado'];

  $total_caja_venta_fisica         = $total_venta_producto_contado_efectivo + $total_cuenta_credito_abonado;
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_servicio_propina = "SELECT SUM(total_venta_producto) AS total_suma_servicio_propina FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
  AND (cod_producto_barra = '$cod_producto_barra')";
  $consulta_total_servicio_propina = mysqli_query($conectar, $sql_total_servicio_propina) or die(mysqli_error($conectar));
  $datos_total_servicio_propina = mysqli_fetch_assoc($consulta_total_servicio_propina);

  $total_suma_servicio_propina       = $datos_total_servicio_propina['total_suma_servicio_propina'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_total_egreso = "SELECT SUM(costo) AS total_egreso FROM tbl15_egreso 
  WHERE (fecha_dmy BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
  $consulta_total_egreso = mysqli_query($conectar, $sql_total_egreso) or die(mysqli_error($conectar));
  $datos_total_egreso = mysqli_fetch_assoc($consulta_total_egreso);

  $total_egreso                      = $datos_total_egreso['total_egreso'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $total_utilidad                    = $total_ganancia - $total_egreso;
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  $sql_cliente = "SELECT SUM(total_factura_compra_retefuente) AS total_factura_compra_retefuente
  FROM tbl15_info_factura_compra WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
  AND (nombre_estado_factura = 'CERRADA')";
  $resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
  $info_cliente = mysqli_fetch_assoc($resultado_cliente);

  $total_factura_compra_retefuente         = $info_cliente['total_factura_compra_retefuente'];
  /* --------------------------------------------------------------------------------------------------------------------------------- */
  /* --------------------------------------------------------------------------------------------------------------------------------- */





    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_suma_compra_producto, 
    SUM(total_venta_producto * (comision_ptj/100)) AS total_comision 
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')";
    $consulta_total_venta = mysqli_query($conectar, $sql_total_venta) or die(mysqli_error($conectar));
    $datos_total_venta = mysqli_fetch_assoc($consulta_total_venta);

    $total_suma_venta_producto                                    = $datos_total_venta['total_suma_venta_producto'];
    $total_suma_compra_producto                                   = $datos_total_venta['total_suma_compra_producto'];
    $total_ganancia                                               = $total_suma_venta_producto - $total_suma_compra_producto;
    $total_utilidad_bruta                                         = $total_suma_venta_producto - $total_suma_compra_producto;
    $total_ganancia_venta                                         = $total_suma_venta_producto - $total_suma_compra_producto;
    $total_comision_venta                                         = $datos_total_venta['total_comision'];
    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $total_ganancia_porcentaje = (($total_ganancia / $total_suma_compra_producto) * 100); } else { $total_ganancia_porcentaje = (($total_ganancia / $total_suma_venta_producto) * 100); }
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_credito_utilidad_neta_abono = "SELECT SUM(total_utilidad_neta) AS total_utilidad_neta_abono_cuenta_cobrar_credito FROM tbl15_cuentas_cobrar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
    $consulta_cuenta_credito_utilidad_neta_abono = mysqli_query($conectar, $sql_total_cuenta_credito_utilidad_neta_abono) or die(mysqli_error($conectar));
    $datos_cuenta_credito_utilidad_neta_abono = mysqli_fetch_assoc($consulta_cuenta_credito_utilidad_neta_abono);

    $total_utilidad_neta_abono_cuenta_cobrar_credito              = $datos_cuenta_credito_utilidad_neta_abono['total_utilidad_neta_abono_cuenta_cobrar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_utilidad_bruta_contado = "SELECT SUM(total_venta_producto) AS total_venta_producto_utilidad_bruta_contado, SUM(total_compra_producto) AS total_compra_producto_utilidad_bruta_contado 
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') AND (cod_tipo_pago = '$contado')";
    $consulta_total_venta_utilidad_bruta_contado = mysqli_query($conectar, $sql_total_venta_utilidad_bruta_contado) or die(mysqli_error($conectar));
    $datos_total_venta_utilidad_bruta_contado = mysqli_fetch_assoc($consulta_total_venta_utilidad_bruta_contado);

    $total_venta_producto_utilidad_bruta_contado                  = $datos_total_venta_utilidad_bruta_contado['total_venta_producto_utilidad_bruta_contado'];
    $total_compra_producto_utilidad_bruta_contado                 = $datos_total_venta_utilidad_bruta_contado['total_compra_producto_utilidad_bruta_contado'];
    $total_utilidad_bruta_contado                                 = ($total_venta_producto_utilidad_bruta_contado + $total_utilidad_neta_abono_cuenta_cobrar_credito) - $total_compra_producto_utilidad_bruta_contado;
    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $total_utilidad_bruta_contado_porcentaje = (($total_utilidad_bruta_contado / $total_compra_producto_utilidad_bruta_contado) * 100); } else { $total_utilidad_bruta_contado_porcentaje = (($total_utilidad_bruta_contado / $total_venta_producto_utilidad_bruta_contado) * 100); }
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_contado_efectivo = "SELECT SUM(total_venta_producto) AS total_venta_producto_contado_efectivo, SUM(total_compra_producto) AS total_compra_producto
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo')";
    $consulta_total_venta_contado_efectivo = mysqli_query($conectar, $sql_total_venta_contado_efectivo) or die(mysqli_error($conectar));
    $datos_total_venta_contado_efectivo = mysqli_fetch_assoc($consulta_total_venta_contado_efectivo);

    $total_venta_producto_contado_efectivo                = $datos_total_venta_contado_efectivo['total_venta_producto_contado_efectivo'];
    $total_compra_producto_contado                        = $datos_total_venta_contado_efectivo['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_contado_transferencia = "SELECT SUM(total_venta_producto) AS total_venta_producto_contado_transferencia, SUM(total_compra_producto) AS total_compra_producto_transfrencia
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$transfer')";
    $consulta_total_venta_contado_transferencia = mysqli_query($conectar, $sql_total_venta_contado_transferencia) or die(mysqli_error($conectar));
    $datos_total_venta_contado_transferencia = mysqli_fetch_assoc($consulta_total_venta_contado_transferencia);

    $total_venta_producto_contado_transferencia           = $datos_total_venta_contado_transferencia['total_venta_producto_contado_transferencia'];
    $total_compra_producto_contado_transfrencia           = $datos_total_venta_contado_transferencia['total_compra_producto_transfrencia'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_contado = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') AND (cod_tipo_pago = '$contado')";
    $consulta_total_venta_contado = mysqli_query($conectar, $sql_total_venta_contado) or die(mysqli_error($conectar));
    $datos_total_venta_contado = mysqli_fetch_assoc($consulta_total_venta_contado);

    $total_venta_producto_contado                         = $datos_total_venta_contado['total_venta_producto'];
    $total_compra_producto_contado                        = $datos_total_venta_contado['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_venta_credito = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto 
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') AND (cod_tipo_pago = '$credito')";
    $consulta_total_venta_credito = mysqli_query($conectar, $sql_total_venta_credito) or die(mysqli_error($conectar));
    $datos_total_venta_credito = mysqli_fetch_assoc($consulta_total_venta_credito);

    $total_venta_producto_credito                         = $datos_total_venta_credito['total_venta_producto'];
    $total_compra_producto_credito                        = $datos_total_venta_credito['total_compra_producto'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_servicio_propina = "SELECT SUM(total_venta_producto) AS total_suma_servicio_propina FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') AND (cod_producto_barra = '$cod_servicio_propina')";
    $consulta_total_servicio_propina = mysqli_query($conectar, $sql_total_servicio_propina) or die(mysqli_error($conectar));
    $datos_total_servicio_propina = mysqli_fetch_assoc($consulta_total_servicio_propina);

    $total_suma_servicio_propina                          = $datos_total_servicio_propina['total_suma_servicio_propina'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_servicio_cava = "SELECT SUM(total_venta_producto) AS total_suma_servicio_cava FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') AND (cod_producto_barra = '$cod_servicio_cava')";
    $consulta_total_servicio_cava = mysqli_query($conectar, $sql_total_servicio_cava) or die(mysqli_error($conectar));
    $datos_total_servicio_cava = mysqli_fetch_assoc($consulta_total_servicio_cava);

    $total_suma_servicio_cava                          = $datos_total_servicio_cava['total_suma_servicio_cava'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_servicio_domicilio = "SELECT SUM(total_venta_producto) AS total_suma_servicio_domicilio FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') AND (cod_producto_barra = '$cod_servicio_domicilio')";
    $consulta_total_servicio_domicilio = mysqli_query($conectar, $sql_total_servicio_domicilio) or die(mysqli_error($conectar));
    $datos_total_servicio_domicilio = mysqli_fetch_assoc($consulta_total_servicio_domicilio);

    $total_suma_servicio_domicilio                          = $datos_total_servicio_domicilio['total_suma_servicio_domicilio'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_servicio_descuento_punto_redimible = "SELECT SUM(total_venta_producto) AS total_suma_servicio_descuento_punto_redimible FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta') AND (cod_producto_barra = '$cod_servicio_descuento_punto_redimible')";
    $consulta_total_servicio_descuento_punto_redimible = mysqli_query($conectar, $sql_total_servicio_descuento_punto_redimible) or die(mysqli_error($conectar));
    $datos_total_servicio_descuento_punto_redimible = mysqli_fetch_assoc($consulta_total_servicio_descuento_punto_redimible);

    $total_suma_servicio_descuento_punto_redimible                          = $datos_total_servicio_descuento_punto_redimible['total_suma_servicio_descuento_punto_redimible'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_credito_abono_en_efectivo = "SELECT SUM(abonado) AS total_abono_en_efectivo_cuenta_cobrar_credito FROM tbl15_cuentas_cobrar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_forma_pago = '1')";
    $consulta_cuenta_credito_abono_en_efectivo = mysqli_query($conectar, $sql_total_cuenta_credito_abono_en_efectivo) or die(mysqli_error($conectar));
    $datos_cuenta_credito_abono_en_efectivo = mysqli_fetch_assoc($consulta_cuenta_credito_abono_en_efectivo);

    $total_abono_en_efectivo_cuenta_cobrar_credito        = $datos_cuenta_credito_abono_en_efectivo['total_abono_en_efectivo_cuenta_cobrar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_credito_abono_en_transferencia = "SELECT SUM(abonado) AS total_abono_en_transferencia_cuenta_cobrar_credito FROM tbl15_cuentas_cobrar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_forma_pago = '10')";
    $consulta_cuenta_credito_abono_en_transferencia = mysqli_query($conectar, $sql_total_cuenta_credito_abono_en_transferencia) or die(mysqli_error($conectar));
    $datos_cuenta_credito_abono_en_transferencia = mysqli_fetch_assoc($consulta_cuenta_credito_abono_en_transferencia);

    $total_abono_en_transferencia_cuenta_cobrar_credito        = $datos_cuenta_credito_abono_en_transferencia['total_abono_en_transferencia_cuenta_cobrar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_credito_abono = "SELECT SUM(abonado) AS total_abono_cuenta_cobrar_credito FROM tbl15_cuentas_cobrar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
    $consulta_cuenta_credito_abono = mysqli_query($conectar, $sql_total_cuenta_credito_abono) or die(mysqli_error($conectar));
    $datos_cuenta_credito_abono = mysqli_fetch_assoc($consulta_cuenta_credito_abono);

    $total_abono_cuenta_cobrar_credito                    = $datos_cuenta_credito_abono['total_abono_cuenta_cobrar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_pagar_credito_abono_en_efectivo = "SELECT SUM(abonado) AS total_abono_en_efectivo_cuenta_pagar_credito FROM tbl15_cuentas_pagar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_forma_pago = '1')";
    $consulta_cuenta_pagar_credito_abono_en_efectivo = mysqli_query($conectar, $sql_total_cuenta_pagar_credito_abono_en_efectivo) or die(mysqli_error($conectar));
    $datos_cuenta_pagar_credito_abono_en_efectivo = mysqli_fetch_assoc($consulta_cuenta_pagar_credito_abono_en_efectivo);

    $total_abono_en_efectivo_cuenta_pagar_credito         = $datos_cuenta_pagar_credito_abono_en_efectivo['total_abono_en_efectivo_cuenta_pagar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_pagar_credito_abono_en_transferencia = "SELECT SUM(abonado) AS total_abono_en_transferencia_cuenta_cobrar_credito FROM tbl15_cuentas_pagar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_forma_pago = '10')";
    $consulta_cuenta_pagar_credito_abono_en_transferencia = mysqli_query($conectar, $sql_total_cuenta_pagar_credito_abono_en_transferencia) or die(mysqli_error($conectar));
    $datos_cuenta_pagar_credito_abono_en_transferencia = mysqli_fetch_assoc($consulta_cuenta_pagar_credito_abono_en_transferencia);

    $total_abono_en_transferencia_cuenta_pagar_credito         = $datos_cuenta_pagar_credito_abono_en_transferencia['total_abono_en_transferencia_cuenta_cobrar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_cuenta_pagar_credito_abono = "SELECT SUM(abonado) AS total_abono_cuenta_pagar_credito FROM tbl15_cuentas_pagar_abonos 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
    $consulta_cuenta_pagar_credito_abono = mysqli_query($conectar, $sql_total_cuenta_pagar_credito_abono) or die(mysqli_error($conectar));
    $datos_cuenta_pagar_credito_abono = mysqli_fetch_assoc($consulta_cuenta_pagar_credito_abono);

    $total_abono_cuenta_pagar_credito                     = $datos_cuenta_pagar_credito_abono['total_abono_cuenta_pagar_credito'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $total_caja_venta_fisica                              = ($total_venta_producto_contado_efectivo + $total_abono_en_efectivo_cuenta_cobrar_credito) - $total_abono_en_efectivo_cuenta_pagar_credito;
    //$total_caja_venta_fisica                              = ($total_venta_producto_contado_efectivo + $total_abono_en_efectivo_cuenta_cobrar_credito);
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_egreso_normal = "SELECT SUM(costo) AS total_egreso FROM tbl15_egreso 
    WHERE (fecha_dmy BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
    $consulta_total_egreso_normal = mysqli_query($conectar, $sql_total_egreso_normal) or die(mysqli_error($conectar));
    $datos_total_egreso_normal = mysqli_fetch_assoc($consulta_total_egreso_normal);

    $total_egreso_normal                                  = $datos_total_egreso_normal['total_egreso'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_egreso_movimiento_contable = "SELECT SUM(total_costo_movimiento_contable) AS total_egreso_movimiento_contable FROM tbl15_movimiento_contable 
    WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND ((nombre_tipo_documento = 'COMPROBANTE DE EGRESO') AND (nombre_estado_factura = 'CERRADA'))";
    $consulta_total_egreso_movimiento_contable = mysqli_query($conectar, $sql_total_egreso_movimiento_contable) or die(mysqli_error($conectar));
    $datos_total_egreso_movimiento_contable = mysqli_fetch_assoc($consulta_total_egreso_movimiento_contable);

    $total_egreso_movimiento_contable                      = $datos_total_egreso_movimiento_contable['total_egreso_movimiento_contable'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_info_totales_egresos_efectivo = "SELECT SUM(costo_movimiento_contable) AS total_costo_movimiento_contable_egresos FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tipo_puc = 'EGRESOS') AND (cod_tipo_forma_pago = '$efectivo')";
    $resultado_info_totales_egresos_efectivo = mysqli_query($conectar, $sql_info_totales_egresos_efectivo) or die(mysqli_error($conectar));
    $info_info_totales_egresos_efectivo = mysqli_fetch_assoc($resultado_info_totales_egresos_efectivo);

    $total_costo_movimiento_contable_egresos_efectivo   = $info_info_totales_egresos_efectivo['total_costo_movimiento_contable_egresos'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_info_totales_egresos_transfer = "SELECT SUM(costo_movimiento_contable) AS total_costo_movimiento_contable_egresos FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tipo_puc = 'EGRESOS') AND (cod_tipo_forma_pago = '$transfer')";
    $resultado_info_totales_egresos_transfer = mysqli_query($conectar, $sql_info_totales_egresos_transfer) or die(mysqli_error($conectar));
    $info_info_totales_egresos_transfer = mysqli_fetch_assoc($resultado_info_totales_egresos_transfer);

    $total_costo_movimiento_contable_egresos_transfer         = $info_info_totales_egresos_transfer['total_costo_movimiento_contable_egresos'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_info_totales_egresos = "SELECT SUM(costo_movimiento_contable) AS total_costo_movimiento_contable_egresos FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (tipo_puc = 'EGRESOS')";
    $resultado_info_totales_egresos = mysqli_query($conectar, $sql_info_totales_egresos) or die(mysqli_error($conectar));
    $info_info_totales_egresos = mysqli_fetch_assoc($resultado_info_totales_egresos);

    $total_costo_movimiento_contable_egresos         = $info_info_totales_egresos['total_costo_movimiento_contable_egresos'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_total_iva_venta = "SELECT SUM((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
    SUM(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva_producto_venta 
    FROM tbl15_venta_producto 
    WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_estado_ignorar_venta = '$cod_estado_ignorar_venta')";
    $consulta_total_iva_venta = mysqli_query($conectar, $sql_total_iva_venta) or die(mysqli_error($conectar));
    $datos_total_iva_venta = mysqli_fetch_assoc($consulta_total_iva_venta);

    $subtotal_base                                         = $datos_total_iva_venta['subtotal_base'];
    $total_iva_producto_venta                              = $datos_total_iva_venta['total_iva_producto_venta'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_movimiento_contable_cuenta_personal_concepto = "SELECT SUM(costo_movimiento_contable) AS total_factura_compra_movimiento_contable_personal FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_info_factura_compra <> '0')";
    $consulta_movimiento_contable_cuenta_personal_concepto = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_concepto) or die(mysqli_error($conectar));
    $datos_movimiento_contable_cuenta_personal_concepto = mysqli_fetch_assoc($consulta_movimiento_contable_cuenta_personal_concepto);

    $total_factura_compra_movimiento_contable_personal   = $datos_movimiento_contable_cuenta_personal_concepto['total_factura_compra_movimiento_contable_personal'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_movimiento_contable_cuenta_personal_concepto_efectivo = "SELECT SUM(costo_movimiento_contable) AS total_factura_compra_movimiento_contable_personal FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo') AND (cod_info_factura_compra <> '0')";
    $consulta_movimiento_contable_cuenta_personal_concepto_efectivo = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_concepto_efectivo) or die(mysqli_error($conectar));
    $datos_movimiento_contable_cuenta_personal_concepto_efectivo = mysqli_fetch_assoc($consulta_movimiento_contable_cuenta_personal_concepto_efectivo);

    $total_factura_compra_movimiento_contable_personal_efectivo   = $datos_movimiento_contable_cuenta_personal_concepto_efectivo['total_factura_compra_movimiento_contable_personal'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_movimiento_contable_cuenta_personal_concepto_transfer = "SELECT SUM(costo_movimiento_contable) AS total_factura_compra_movimiento_contable_personal FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_forma_pago = '$transfer') AND (cod_info_factura_compra <> '0')";
    $consulta_movimiento_contable_cuenta_personal_concepto_transfer = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_concepto_transfer) or die(mysqli_error($conectar));
    $datos_movimiento_contable_cuenta_personal_concepto_transfer = mysqli_fetch_assoc($consulta_movimiento_contable_cuenta_personal_concepto_transfer);

    $total_factura_compra_movimiento_contable_personal_transfer   = $datos_movimiento_contable_cuenta_personal_concepto_transfer['total_factura_compra_movimiento_contable_personal'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_movimiento_contable_cuenta_personal_concepto_contado = "SELECT SUM(costo_movimiento_contable) AS total_factura_compra_movimiento_contable_personal FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '$contado') AND (cod_info_factura_compra <> '0')";
    $consulta_movimiento_contable_cuenta_personal_concepto_contado = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_concepto_contado) or die(mysqli_error($conectar));
    $datos_movimiento_contable_cuenta_personal_concepto_contado = mysqli_fetch_assoc($consulta_movimiento_contable_cuenta_personal_concepto_contado);

    $total_factura_compra_movimiento_contable_personal_contado   = $datos_movimiento_contable_cuenta_personal_concepto_contado['total_factura_compra_movimiento_contable_personal'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_movimiento_contable_cuenta_personal_concepto_credito = "SELECT SUM(costo_movimiento_contable) AS total_factura_compra_movimiento_contable_personal FROM tbl15_movimiento_contable_cuenta_personal_concepto 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '$credito') AND (cod_info_factura_compra <> '0')";
    $consulta_movimiento_contable_cuenta_personal_concepto_credito = mysqli_query($conectar, $sql_movimiento_contable_cuenta_personal_concepto_credito) or die(mysqli_error($conectar));
    $datos_movimiento_contable_cuenta_personal_concepto_credito = mysqli_fetch_assoc($consulta_movimiento_contable_cuenta_personal_concepto_credito);

    $total_factura_compra_movimiento_contable_personal_credito   = $datos_movimiento_contable_cuenta_personal_concepto_credito['total_factura_compra_movimiento_contable_personal'];
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    if ($cod_estado_movimiento_contable_cuenta_personal_global == '1') {
        $total_egreso                                          = $total_costo_movimiento_contable_egresos;
    } else {
        $total_egreso                                          = $total_egreso_normal + $total_egreso_movimiento_contable;
    }
    $total_utilidad_neta                                       = $total_utilidad_bruta_contado - $total_egreso;
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $total_caja_venta_fisica_mas_base_vendedor                 = $total_caja_venta_fisica + $total_base_cierre_caja;
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_info_factura_compra = "SELECT SUM(total_factura_compra_retefuente) AS total_factura_compra_retefuente FROM tbl15_info_factura_compra 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')";
    $consulta_info_factura_compra = mysqli_query($conectar, $sql_info_factura_compra);
    $data_info_factura_compra = mysqli_fetch_assoc($consulta_info_factura_compra);

    $total_factura_compra_retefuente                              = $data_info_factura_compra['total_factura_compra_retefuente'];
      /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_info_factura_compra_contado = "SELECT SUM(total_factura_compra_retefuente) AS total_factura_compra_retefuente_contado FROM tbl15_info_factura_compra 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '$contado')";
    $consulta_info_factura_compra_contado = mysqli_query($conectar, $sql_info_factura_compra_contado);
    $data_info_factura_compra_contado = mysqli_fetch_assoc($consulta_info_factura_compra_contado);

    $total_factura_compra_retefuente_contado                      = $data_info_factura_compra_contado['total_factura_compra_retefuente_contado'];
      /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_info_factura_compra_credito = "SELECT SUM(total_factura_compra_retefuente) AS total_factura_compra_retefuente_credito FROM tbl15_info_factura_compra 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '$credito')";
    $consulta_info_factura_compra_credito = mysqli_query($conectar, $sql_info_factura_compra_credito);
    $data_info_factura_compra_credito = mysqli_fetch_assoc($consulta_info_factura_compra_credito);

    $total_factura_compra_retefuente_credito                      = $data_info_factura_compra_credito['total_factura_compra_retefuente_credito'];
      /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_info_factura_compra_contado_efectivo = "SELECT SUM(total_factura_compra_retefuente) AS total_factura_compra_retefuente_contado_efectivo FROM tbl15_info_factura_compra 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$efectivo')";
    $consulta_info_factura_compra_contado_efectivo = mysqli_query($conectar, $sql_info_factura_compra_contado_efectivo);
    $data_info_factura_compra_contado_efectivo = mysqli_fetch_assoc($consulta_info_factura_compra_contado_efectivo);

    $total_factura_compra_retefuente_contado_efectivo             = $data_info_factura_compra_contado_efectivo['total_factura_compra_retefuente_contado_efectivo'];
      /* --------------------------------------------------------------------------------------------------------------------------------- */
    $sql_info_factura_compra_contado_transfer = "SELECT SUM(total_factura_compra_retefuente) AS total_factura_compra_retefuente_contado_transfer FROM tbl15_info_factura_compra 
    WHERE (fecha_anyo BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') AND (cod_tipo_pago = '$contado') AND (cod_tipo_forma_pago = '$transfer')";
    $consulta_info_factura_compra_contado_transfer = mysqli_query($conectar, $sql_info_factura_compra_contado_transfer);
    $data_info_factura_compra_contado_transfer = mysqli_fetch_assoc($consulta_info_factura_compra_contado_transfer);

    $total_factura_compra_retefuente_contado_transfer             = $data_info_factura_compra_contado_transfer['total_factura_compra_retefuente_contado_transfer'];
?>
<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="#">FECHA INICAL: <?php echo $fecha_ymd_venta_producto_ini ?></a></td>
<td style="text-align:center;"><a href="#">FECHA FINAL: <?php echo $fecha_ymd_venta_producto_fin ?></a></td>
</tr>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<hr>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<!--
<table class="table table-striped">
<tr>
<th style="text-align:center;"><a href="#">Imprimir Reporte General</a></th>
</tr>
</table>

<table class="table table-striped">
<tr>
<td style="text-align:center;"><a href="../admin/imprimir_datos_reporte_general_pdf.php?fecha_ymd_venta_producto_ini=<?php echo $fecha_ymd_venta_producto_ini?>&fecha_ymd_venta_producto_fin=<?php echo $fecha_ymd_venta_producto_fin?>" target="_blank"><img src=../imagenes/imprimir_.png alt="imprimir_peq"></a></td>
</tr>
</table>
-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <table class="table table-striped">
    <tr>
    <th style="text-align:center;"><a href="#">Totales Ventas</a></th>
    </tr>
    </table>

    <table class="table table-striped">
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total suma venta producto">Total P.Venta</a></th>
            <?php if ($cod_estado_prod_precio_compra==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total suma compra producto">Total P.Compra</a></th><?php } ?>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total venta producto contado">Total Venta Contado</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total venta producto credito">Total Venta Credito</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total venta producto contado efectivo">Total Venta (En Efectivo)</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total venta producto contado transferencia">Total Venta (Transferencia)</a></th>
            <!--<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">Total Iva</a></th>-->
            <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
              <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total ganancia venta">Total Ganancia Venta (Proyeccion)</th>
              <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_ganancia_porcentaje">%Ganancia</th>
            <!--<th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#">%Utilidad Bruta</th>-->
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total utilidad bruta contado">Total Utilidad Bruta</th>
            <?php } ?>
            <?php if ($cod_estado_reporte_venta_total_utilidad==1) { ?>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total utilidad neta">Total Utilidad Neta</th>
            <?php } ?>
        </tr>
        <tr>
            <td style="text-align:center;"><?php echo number_format($total_suma_venta_producto, 0, ",", ".") ?></td>
            <?php if ($cod_estado_prod_precio_compra==1) { ?><td style="text-align:center;"><?php echo number_format($total_suma_compra_producto, 0, ",", ".") ?></td><?php } ?>
            <td style="text-align:center;"><?php echo number_format($total_venta_producto_contado, 0, ",", ".") ?></td>
            <td style="text-align:center;"><?php echo number_format($total_venta_producto_credito, 0, ",", ".") ?></td>
            <td style="text-align:center;"><?php echo number_format($total_venta_producto_contado_efectivo, 0, ",", ".") ?></td>
            <td style="text-align:center;"><?php echo number_format($total_venta_producto_contado_transferencia, 0, ",", ".") ?></td>
            <!--<td style="text-align:center;"><?php echo number_format($total_iva_producto_venta, 0, ",", ".") ?></td>-->
            <?php if ($cod_estado_reporte_venta_total_ganancia==1) { ?>
            <td style="text-align:center;"><?php echo number_format($total_ganancia_venta, 0, ",", ".") ?></td>
            <td style="text-align:center;"><?php echo number_format($total_ganancia_porcentaje, 0, ",", ".") ?>%</td>
            <!--<td style="text-align:center;"><?php echo number_format($total_utilidad_bruta_porcentaje, 0, ",", ".") ?>%</td>-->
            <td style="text-align:center;"><?php echo number_format($total_utilidad_bruta_contado, 0, ",", ".") ?></td>
            <?php } ?>
            <?php if ($cod_estado_reporte_venta_total_utilidad==1) { ?>
            <td style="text-align:center;"><?php echo number_format($total_utilidad_neta, 0, ",", ".") ?></td>
            <?php } ?>
        </tr>
    </table>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <?php if ($cod_estado_egreso_registrar==1) { ?>
    <table class="table table-striped">
    <tr>
    <th style="text-align:center;"><a href="#">Totales Egresos</a></th>
    </tr>
    </table>

    <table class="table table-striped">
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total egreso">Total Egresos</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total costo movimiento contable egresos efectivo">Total Egresos (En Efectivo)</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total costo movimiento contable egresos transfer">Total Egresos (Transferencia)</a></th>
        </tr>
        <tr>
            <td style="text-align:center;"><?php echo number_format($total_egreso, 0, ",", ".") ?></td>
            <td style="text-align:center;"><?php echo number_format($total_costo_movimiento_contable_egresos_efectivo, 0, ",", ".") ?></td>
            <td style="text-align:center;"><?php echo number_format($total_costo_movimiento_contable_egresos_transfer, 0, ",", ".") ?></td>
        </tr>
    </table>
    <?php } ?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <?php if ($cod_estado_facturacion_compra==1) { ?>
    <table class="table table-striped">
    <tr>
    <th style="text-align:center;"><a href="#">Totales Compras</a></th>
    </tr>
    </table>

    <table class="table table-striped">
        <tr>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_factura_compra_retefuente">Total Compra</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_factura_compra_retefuente_contado">Total Compra (Contado)</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_factura_compra_retefuente_credito">Total Compra (Credito)</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_factura_compra_retefuente_contado_efectivo">Total Compra (En Efectivo)</a></th>
            <th style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#" title="total_factura_compra_retefuente_contado_transfer">Total Compra (Transferencia)</a></th>
        </tr>
        <tr>
            <td style="text-align:center;"><?php echo number_format($total_factura_compra_retefuente, 0, ",", ".") ?></td>
            <td style="text-align:center;"><?php echo number_format($total_factura_compra_retefuente_contado, 0, ",", ".") ?></td>
            <td style="text-align:center;"><?php echo number_format($total_factura_compra_retefuente_credito, 0, ",", ".") ?></td>
            <td style="text-align:center;"><?php echo number_format($total_factura_compra_retefuente_contado_efectivo, 0, ",", ".") ?></td>
            <td style="text-align:center;"><?php echo number_format($total_factura_compra_retefuente_contado_transfer, 0, ",", ".") ?></td>
        </tr>
    </table>
    <?php } ?>

<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table class="table table-striped">
<tr>
<th style="text-align:center;"><a href="#">Detallado Venta</a></th>
</tr>
</table>

<table class="table table-striped">
<thead>
  <tr>
    <th style="text-align:center">Tipo Factura</th>
    <th style="text-align:center">Factura</th>
    <th style="text-align:center">Cod</th>
    <th style="text-align:center">Concepto</th>
    <th style="text-align:center">Cliente</th>
    <th style="text-align:center">Unidades</th>
    <th style="text-align:center">P.Venta</th>
    <th style="text-align:center">Total Venta</th>
    <th style="text-align:center">Tipo Pago</th>
    <th style="text-align:center">Forma Pago</th>
    <th style="text-align:center">Fecha</th>
    <th style="text-align:center">Hora</th>
    <?php if ($cod_seguridad == '1') { ?>
    <th style="text-align:center">Inv</th>
    <?php } ?>
    <th style="text-align:center">Id</th>
  </tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT cod_venta_producto, cod_producto, cod_producto_barra, cod_info_factura_venta, cod_factura, cod_historia_clinica, nombre_producto, 
und_venta, precio_costo_producto, total_compra_producto, precio_venta_producto, total_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, 
nombre_tipo_presentacion, nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, fecha_hora_venta_producto, cod_administrador,
cuenta, cod_tipo_cobrar, comision_ptj, cod_tipo_pago, cod_tipo_forma_pago, cod_dependencia, nombre_tipo_factura, cod_tercero, und_producto_inv
FROM tbl15_venta_producto
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')
ORDER BY cod_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

  $cod_venta_producto            = $info_cliente['cod_venta_producto'];
  $cod_producto                  = $info_cliente['cod_producto'];
  $cod_producto_barra            = $info_cliente['cod_producto_barra'];
  $cod_info_factura_venta        = $info_cliente['cod_info_factura_venta'];
  $cod_factura                   = $info_cliente['cod_factura'];
  $cod_historia_clinica          = $info_cliente['cod_historia_clinica'];
  $nombre_producto               = $info_cliente['nombre_producto'];
  $und_venta                     = $info_cliente['und_venta'];
  $precio_costo_producto         = $info_cliente['precio_costo_producto'];
  $total_compra_producto         = $info_cliente['total_compra_producto'];
  $precio_venta_producto         = $info_cliente['precio_venta_producto'];
  $total_venta_producto          = $info_cliente['total_venta_producto'];
  $nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
  $nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
  $nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
  $nombre_via_administracion     = $info_cliente['nombre_via_administracion'];
  $nombre_frec_duracion          = $info_cliente['nombre_frec_duracion'];
  $fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
  $fecha_hora_venta_producto     = $info_cliente['fecha_hora_venta_producto'];
  //$cuenta                        = $info_cliente['cuenta'];
  $cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
  $cod_administrador_db          = $info_cliente['cod_administrador'];
  $comision_ptj                  = $info_cliente['comision_ptj'];
  $cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
  $cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
  $cod_dependencia               = $info_cliente['cod_dependencia'];
  $nombre_tipo_factura           = $info_cliente['nombre_tipo_factura'];
  $cod_tercero                   = $info_cliente['cod_tercero'];
  $und_producto_inv              = $info_cliente['und_producto_inv'];

  $total_comision                = ($total_venta_producto * ($comision_ptj/100));

  $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
  $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
  $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

  $cuenta                        = $datos_administrador['cuenta'];

  $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
  $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
  $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

  $nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

  $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
  $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
  $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

  $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

  $sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
  $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
  $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

  $nombre_dependencia            = $datos_dependencia['nombre_dependencia'];

  $sql_tercero = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
  $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
  $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

  $nombre_propietario            = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido1_tercero'];
?>
  <tr>
    <td style="text-align:center"><?php echo $nombre_tipo_factura?></td>
    <td style="text-align:center"><?php echo $cod_factura?></td>
    <td style="text-align:left"><?php echo $cod_producto_barra?></td>
    <td style="text-align:left"><?php echo $nombre_producto?></td>
    <td style="text-align:left"><?php echo $nombre_propietario?></td>
    <td style="text-align:center"><?php echo $und_venta?></td>
    <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".")?></td>
    <td style="text-align:right"><?php echo number_format($total_venta_producto, 0, ",", ".")?></td>
    <td style="text-align:center"><?php echo $nombre_tipo_pago?></td>
    <td style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
    <td style="text-align:center"><?php echo $fecha_ymd_venta_producto?></td>
    <td style="text-align:center"><?php echo $fecha_hora_venta_producto?></td>
    <?php if ($cod_seguridad == '1') { ?>
    <td style="text-align:center"><?php echo $und_producto_inv?></td>
    <?php } ?>
    <td style="text-align:center"><?php echo $cod_venta_producto?></td>
  </tr>
<?php } ?>
</tbody>
</table>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table class="table table-striped">
<tr>
<th style="text-align:center;"><a href="#">Detallado Compra</a></th>
</tr>
</table>

<table class="table table-striped">
<thead>
  <tr>
    <th style="text-align:center"><a href="#">Tipo Factura</a></th>
    <th style="text-align:center"><a href="#">Factura</a></th>
    <th style="text-align:center"><a href="#">Cod</a></th>
    <th style="text-align:center"><a href="#">Concepto</a></th>
    <th style="text-align:center"><a href="#">Proveedor</a></th>
    <th style="text-align:center"><a href="#">Unidades</a></th>
    <th style="text-align:center"><a href="#">P.Compra</a></th>
    <th style="text-align:center"><a href="#">Total Compra</a></th>
    <th style="text-align:center"><a href="#">%Iva</a></th>
    <th style="text-align:center"><a href="#">Tipo Pago</a></th>
    <th style="text-align:center"><a href="#">Vendedor</a></th>
    <th style="text-align:center"><a href="#">Fecha</a></th>
    <th style="text-align:center"><a href="#">Inv</a></th>
    <th style="text-align:center"><a href="#">Id</a></th>
  </tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT cod_factura_compra_producto, cod_producto, cod_producto_barra, cod_info_factura_compra, cod_factura, cod_historia_clinica, nombre_producto, 
und_compra, precio_costo_producto, total_costo_producto, precio_compra_producto, total_compra_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, 
nombre_tipo_presentacion, nombre_via_administracion, nombre_frec_duracion, fecha_ymd_venta_producto, cod_administrador, iva_ptj, cod_tercero, 
cuenta, cod_tipo_cobrar, comision_ptj, cod_tipo_pago, cod_tipo_forma_pago, cod_dependencia, nombre_tipo_compra, und_producto
FROM tbl15_factura_compra_producto 
WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin')
ORDER BY cod_factura_compra_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

  $cod_factura_compra_producto   = $info_cliente['cod_factura_compra_producto'];
  $cod_producto                  = $info_cliente['cod_producto'];
  $cod_producto_barra            = $info_cliente['cod_producto_barra'];
  $cod_info_factura_compra       = $info_cliente['cod_info_factura_compra'];
  $cod_factura                   = $info_cliente['cod_factura'];
  $nombre_producto               = $info_cliente['nombre_producto'];
  $und_compra                    = $info_cliente['und_compra'];
  $precio_costo_producto         = $info_cliente['precio_costo_producto'];
  $total_costo_producto          = $info_cliente['total_costo_producto'];
  $precio_compra_producto        = $info_cliente['precio_compra_producto'];
  $total_compra_producto         = $info_cliente['total_compra_producto'];
  $nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
  $nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
  $nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
  $fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
  //$cuenta                        = $info_cliente['cuenta'];
  $cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
  $cod_administrador_db          = $info_cliente['cod_administrador'];
  $comision_ptj                  = $info_cliente['comision_ptj'];
  $cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
  $cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
  $cod_dependencia               = $info_cliente['cod_dependencia'];
  $nombre_tipo_compra            = $info_cliente['nombre_tipo_compra'];
  $iva_ptj                       = $info_cliente['iva_ptj'];
  $cod_tercero                   = $info_cliente['cod_tercero'];
  $und_producto                  = $info_cliente['und_producto'];

  $total_comision                = ($total_compra_producto * ($comision_ptj/100));

  $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
  $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
  $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

  $cuenta                        = $datos_administrador['cuenta'];

  $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
  $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
  $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

  $nombre_tipo_pago              = $datos_tipo_pago['nombre_tipo_pago'];

  $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
  $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
  $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

  $nombre_tipo_forma_pago        = $datos_forma_pago['nombre_tipo_forma_pago'];

  $sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
  $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
  $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

  $nombre_dependencia            = $datos_dependencia['nombre_dependencia'];

  $sql_tercero = "SELECT nombre1_tercero, apellido1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
  $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
  $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

  $nombre_propietario            = $datos_tercero['nombre1_tercero'].' '.$datos_tercero['apellido1_tercero'];
?>
  <tr>
    <td style="text-align:center"><?php echo $nombre_tipo_compra?></td>
    <td style="text-align:center"><?php echo $cod_factura?></td>
    <td style="text-align:left"><?php echo $cod_producto_barra?></td>
    <td style="text-align:left"><?php echo $nombre_producto?></td>
    <td style="text-align:left"><?php echo $nombre_propietario?></td>
    <td style="text-align:center"><?php echo $und_compra?></td>
    <td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", ".")?></td>
    <td style="text-align:right"><?php echo number_format($total_compra_producto, 0, ",", ".")?></td>
    <td style="text-align:center"><?php echo $iva_ptj?></td>
    <td style="text-align:center"><?php echo $nombre_tipo_pago?></td>
    <td style="text-align:center"><?php echo $cuenta?></td>
    <td style="text-align:center"><?php echo $fecha_ymd_venta_producto?></td>
    <td style="text-align:center"><?php echo $und_producto?></td>
    <td style="text-align:center"><?php echo $cod_factura_compra_producto?></td>
  </tr>
<?php } ?>
</tbody>
</table>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table class="table table-striped">
<tr>
<th style="text-align:center;"><a href="#">Reporte Movimientos Contables</a></th>
</tr>
</table>

<table class="table table-striped">
<thead>
<tr>
<th style="text-align:center;"><a href="#">Tipo Movimiento Contable</a></th>
<th style="text-align:center;"><a href="#">Tercero</a></th>
<th style="text-align:center;"><a href="#">Total Movimiento</a></th>
<th style="text-align:center;"><a href="#">Forma pago</a></th>
<th style="text-align:center;"><a href="#"></a></th>
<th style="text-align:center;"><a href="#">Fecha</a></th>

</tr>
</thead>
<tbody>
<?php
$sql_mov_detalle = "SELECT * FROM tbl15_movimiento_contable WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (nombre_estado_factura = 'CERRADA') ORDER BY fecha_ymd DESC";
$resultado_mov_detalle = mysqli_query($conectar, $sql_mov_detalle) or die(mysqli_error($conectar));
while ($info_mov_detalle = mysqli_fetch_assoc($resultado_mov_detalle)) {

$cod_movimiento_contable                 = $info_mov_detalle['cod_movimiento_contable'];
$nombre_estado_factura                   = $info_mov_detalle['nombre_estado_factura'];
$cod_factura                             = $info_mov_detalle['cod_factura'];
$doc_modifica                            = $info_mov_detalle['doc_modifica'];
$nombre_tipo_documento                   = $info_mov_detalle['nombre_tipo_documento'];
$descripcion_movimiento                  = $info_mov_detalle['descripcion_movimiento'];
$total_costo_movimiento_contable         = $info_mov_detalle['total_costo_movimiento_contable'];
$cod_tercero                             = $info_mov_detalle['cod_tercero'];
$fecha_ymd                               = $info_mov_detalle['fecha_ymd'];
$cod_guia                                = $info_mov_detalle['cod_guia'];
$cod_tipo_forma_pago                     = $info_mov_detalle['cod_tipo_forma_pago'];
$descripcion_tipo_forma_pago             = $info_mov_detalle['descripcion_tipo_forma_pago'];

$sql_tipo_pago = "SELECT identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
$consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
$datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

$identificacion_tercero       = $datos_tipo_pago['identificacion_tercero'];
$nombre1_tercero              = $datos_tipo_pago['nombre1_tercero'];
$nombre2_tercero              = $datos_tipo_pago['nombre2_tercero'];
$apellido1_tercero            = $datos_tipo_pago['apellido1_tercero'];
$apellido2_tercero            = $datos_tipo_pago['apellido2_tercero'];
$nombre_tercero               = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;

$sql_tipo_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
$consulta_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$datos_tipo_forma_pago = mysqli_fetch_assoc($consulta_tipo_forma_pago);

$nombre_tipo_forma_pago                        = $datos_tipo_forma_pago['nombre_tipo_forma_pago'];
?>
<tr>
<td style="text-align:left"><?php echo $nombre_tipo_documento?></td>
<td style="text-align:left"><?php echo $nombre_tercero?></td>
<td style="text-align:right"><?php echo number_format($total_costo_movimiento_contable, 0, ",", ".")?></td>
<td style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
<td style="text-align:left"><?php echo $descripcion_tipo_forma_pago?></td>
<td style="text-align:center"><?php echo $fecha_ymd?></td>
</tr>
<?php } ?>
</tbody>
</table>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table class="table table-striped">
<thead>
<tr>
<th style="text-align:left;"><a href="#">Tipo Movimiento Contable</a></th>
<th style="text-align:left;"><a href="#">Total Movimiento</a></th>
</tr>
</thead>
<tbody>
<?php
$sql_cliente = "SELECT SUM(total_costo_movimiento_contable) AS total_costo_movimiento_contable, nombre_tipo_documento 
FROM tbl15_movimiento_contable WHERE (fecha_ymd BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
AND (nombre_estado_factura = 'CERRADA') GROUP BY nombre_tipo_documento DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$nombre_tipo_documento                   = $info_cliente['nombre_tipo_documento'];
$total_costo_movimiento_contable         = $info_cliente['total_costo_movimiento_contable'];
?>
<tr>
<td style="text-align:left"><?php echo $nombre_tipo_documento?></td>
<td style="text-align:left"><?php echo number_format($total_costo_movimiento_contable, 0, ",", ".")?></td>
</tr>
<?php } ?>
</tbody>
</table>

<hr>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->

<script>
function printPageArea(areaID){

var printContent = document.getElementById(areaID);
var WinPrint = window.open('', '', 'width=400,height=1000');
WinPrint.document.write(printContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div id="wrapper" style="width: 99%;">

<div id="area_imprimible_invisible" style="width: 99%;text-align: center;"><div>

<?php if ($cod_estado_img_impimir_factura_global == '1') { ?>
<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 98%; font-family: Courier; font-size:12pt;"><img src="../imagenes/logo_empresa_factura_pos_blanco_negro.jpg" width="100px"></td>
</tr>
</table>
<?php } ?>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $localidad_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>NIT: <?php echo $nit_empresa_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>DIRECCION: <?php echo $direccion_emp; ?></strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong>TELEFONO: <?php echo $telefono_emp; ?></strong></td>
</tr>
</table>


<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>REPORTE VENTAS</strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>VENDEDOR: <?php echo $cuenta_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TERCERO: <?php echo $nombre_cliente; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>DEPENDENCIA: <?php echo $nombre_dependencia_get; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TIPO PAGO: <?php echo $nombre_tipo_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FORMA DE PAGO: <?php echo $nombre_tipo_forma_pago; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA INI: <?php echo $fecha_ymd_venta_producto_ini; ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>FECHA FIN: <?php echo $fecha_ymd_venta_producto_fin; ?></strong></td>
  </tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL VENTA:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_suma_venta_producto, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL VENTA CONTADO:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto_contado, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL VENTA CREDITO:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto_credito, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL ABONOS:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_cuenta_credito_abonado, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL CAJA:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_caja_venta_fisica, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
<?php if ($cod_seguridad==1) { ?>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL GRESOS:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier;total_caja_venta_fisica font-size:8pt;"><strong><?php echo number_format($total_egreso, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL UTILIDAD:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"> <strong><?php echo number_format($total_utilidad, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL GANACIA:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_ganancia, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
<?php if ($cod_estado_ptj_comision_global == '1') { ?>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL COMISION:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"> <strong><?php echo number_format($total_comision_venta, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
<?php } ?>
<?php if ($cod_estado_propina_global == '1') { ?>
  <tr>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong>TOTAL PROPINA:</strong></td>
    <td style="text-align: right; width: 98%; font-family: Courier; font-size:8pt;"> <strong><?php echo number_format($total_suma_servicio_propina, 0, ",", ".") ?></strong></td>
    <td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
<?php } ?>

<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><strong>FORMAS DE PAGO</strong></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<thead>
<tr>
<th style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong></strong></th>
<th style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong></strong></th>
<td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
</tr>
</thead>
<tbody>
<?php
$sql_total_forma_pago = "SELECT Sum(tbl15_venta_producto.total_venta_producto) AS suma_total_venta_producto, tbl15_tipo_forma_pago.nombre_tipo_forma_pago
FROM tbl15_tipo_forma_pago RIGHT JOIN tbl15_venta_producto ON tbl15_tipo_forma_pago.cod_tipo_forma_pago = tbl15_venta_producto.cod_tipo_forma_pago
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
GROUP BY tbl15_tipo_forma_pago.cod_tipo_forma_pago";
$consulta_total_forma_pago = mysqli_query($conectar, $sql_total_forma_pago) or die(mysqli_error($conectar));
while ($datos_total_forma_pago = mysqli_fetch_assoc($consulta_total_forma_pago)) {

$nombre_tipo_forma_pago        = $datos_total_forma_pago['nombre_tipo_forma_pago'];
$suma_total_venta_producto     = $datos_total_forma_pago['suma_total_venta_producto'];

?>
<tr>
<td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_tipo_forma_pago?>:</strong></td>
<td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($suma_total_venta_producto, 0, ",", ".")?></strong></td>
<td style="text-align: left; width: 98%; font-family: Courier; font-size:8pt;"></td>
  </tr>
<?php } ?>
</tbody>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="2" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center; width:5%; font-family: Courier; font-size:8pt;"><strong>Und</strong></td>
<td style="text-align: center; width:50%; font-family: Courier; font-size:8pt;"><strong>Concepto</strong></td>
<td style="text-align: center; width:30%; font-family: Courier; font-size:8pt;"><strong>P.Total</strong></td>
<td style="text-align: center; width:3%; font-family: Courier; font-size:8pt;"><strong>Id</strong></td>
</tr>
<?php
$suma_total_venta = 0;
$sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_costo_producto, tbl15_venta_producto.total_compra_producto, tbl15_venta_producto.precio_venta_producto, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, 
tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, 
tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_venta_producto.cod_administrador,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar, tbl15_venta_producto.comision_ptj
FROM tbl15_tercero RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_venta_producto ON tbl15_cliente.cod_cliente = tbl15_venta_producto.cod_cliente) 
ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') 
ORDER BY tbl15_venta_producto.cod_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

$cod_venta_producto            = $info_cliente['cod_venta_producto'];
$cod_producto                  = $info_cliente['cod_producto'];
$cod_producto_barra            = $info_cliente['cod_producto_barra'];
$cod_info_factura_venta        = $info_cliente['cod_info_factura_venta'];
$cod_factura                   = $info_cliente['cod_factura'];
$cod_historia_clinica          = $info_cliente['cod_historia_clinica'];
$nombre_producto               = $info_cliente['nombre_producto'];
$und_venta                     = $info_cliente['und_venta'];
$precio_costo_producto         = $info_cliente['precio_costo_producto'];
$total_compra_producto          = $info_cliente['total_compra_producto'];
$precio_venta_producto         = $info_cliente['precio_venta_producto'];
$total_venta_producto          = $info_cliente['total_venta_producto'];
$nombre_tipo_producto          = $info_cliente['nombre_tipo_producto'];
$nombre_tipo_unidad_medida     = $info_cliente['nombre_tipo_unidad_medida'];
$nombre_tipo_presentacion      = $info_cliente['nombre_tipo_presentacion'];
$nombre_via_administracion     = $info_cliente['nombre_via_administracion'];
$nombre_frec_duracion          = $info_cliente['nombre_frec_duracion'];
$fecha_ymd_venta_producto      = $info_cliente['fecha_ymd_venta_producto'];
$fecha_hora_venta_producto     = $info_cliente['fecha_hora_venta_producto'];
//$cuenta                        = $info_cliente['cuenta'];
$cod_tipo_cobrar               = $info_cliente['cod_tipo_cobrar'];
$comision_ptj                  = $info_cliente['comision_ptj'];
$cod_administrador_db          = $info_cliente['cod_administrador'];
$nombre_propietario            = $info_cliente['nombre1_tercero'].' '.$info_cliente['apellido1_tercero'];
$suma_total_venta              = $suma_total_venta + $total_venta_producto;
$total_comision                = $total_comision + ($total_venta_producto * ($comision_ptj/100));

$sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
$consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
$datos_administrador = mysqli_fetch_assoc($consulta_administrador);

$cuenta                        = $datos_administrador['cuenta'];
?>
<tr>
<td style="text-align: center; width:5%; font-family: Courier; font-size:8pt;"><strong><?php echo $und_venta ?></strong></td>
<td style="text-align: left; width:50%; font-family: Courier; font-size:8pt;"><strong><?php echo $nombre_producto ?></strong></td>
<td style="text-align: right; width:30%; font-family: Courier; font-size:8pt;"><strong><?php echo number_format($total_venta_producto, 0, ",", ".") ?></strong></td>
<td style="text-align: right; width:3%; font-family: Courier; font-size:5pt;"><?php echo $cod_venta_producto ?></td>
</tr>
<?php } ?>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
<tr>
<td style="text-align: center;"><=======================================></td>
</tr>
</table>

<table border="0" width="275px" cellspacing="0" cellpadding="0" style="font-family: Courier; font-size:8pt;">
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong>Software <?php echo $titulo_emp ?> Version <?php echo $version_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 98%; font-family: Courier; font-size:8pt;"><strong><?php echo $desarrollador_emp ?> : <?php echo $pag_desarrollador_emp ?></strong></td>
  </tr>
  <tr>
    <td style="text-align: center; width: 99%; font-family: Courier; font-size:8pt;"><strong><?php echo $fecha_impr.$hora_impr.'_'?></strong>_imp_repvent</td>
  </tr>
</table>
</div>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>