<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script src="../js/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="../estilo_css/chosen.css">
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
<a class="btn btn-primary" href="#"><h6>Reporte historial de comportamiento por producto</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<body id="pageBody">
<?php
if ($cod_seguridad == '1') {
  $condicion_inventario = 'cod_tipo_inventario = "1" OR cod_tipo_inventario = "2"';
  $condicion_vendedor_option = '<option value="0" $seleccionado >TODOS</option>';
} else {
if ($cod_estado_facturacion_venta_acceso_facturas_otros_user == '1') {
  $condicion_inventario = 'cod_tipo_inventario = "1"';
  $condicion_vendedor_option = '<option value="0" $seleccionado >TODOS</option>';
} else {
  $condicion_inventario = 'cod_tipo_inventario = "1"';
  $condicion_vendedor_option = '';
}
}

if (isset($_GET['fecha_operacion_ini'])) {
  $fecha_operacion_ini            = addslashes($_GET['fecha_operacion_ini']);
  $fecha_operacion_fin            = addslashes($_GET['fecha_operacion_fin']);
  $fecha                                   = date("Y-m-d");

  $total_productos                         = count($_GET['cod_producto_barra']);
  $filtro_cod_producto_barra               = "";
  $filtro_cod_producto_barra_rel           = "";
  $contador                                = 0;
  $filtro_cod_producto_barra              .= "";


  foreach ($_GET['cod_producto_barra'] as &$valor_cod_producto_barra) {
    $cod_producto_barra           = $valor_cod_producto_barra;
    $contador ++;

    if ($contador > 1) {
      $filtro_cod_producto_barra        .= " OR (cod_producto_barra LIKE '".$cod_producto_barra."')";
      $filtro_cod_producto_barra_rel    .= " OR (tbl15_venta_producto.cod_producto_barra LIKE '".$cod_producto_barra."')";
    } else {
      $filtro_cod_producto_barra        .= " AND ((cod_producto_barra LIKE '".$cod_producto_barra."')";
      $filtro_cod_producto_barra_rel    .= " AND ((tbl15_venta_producto.cod_producto_barra LIKE '".$cod_producto_barra."')";
    }
  }

  $filtro_cod_producto_barra              .= ")";
  $filtro_cod_producto_barra_rel          .= ")";
  unset($valor_cod_producto_barra);

} else {
  $fecha_operacion_ini            = date("Y-m-d");
  $fecha_operacion_fin            = date("Y-m-d");
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
    <td style="text-align:right;">FECHA INI: </td>
    <td style="text-align:left;"><input class="input-block-level" name="fecha_operacion_ini" type="date" value="<?php echo $fecha_operacion_ini ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:right;">FECHA FIN: </td>
    <td style="text-align:left;"><input class="input-block-level" name="fecha_operacion_fin" type="date" value="<?php echo $fecha_operacion_fin ?>"/></td>
  </tr>
  <tr>
    <td style="text-align:right;">PRODUCTO: </td>
    <td style="text-align:left;">
      <select name="cod_producto_barra[]" id="cod_producto_barra" data-placeholder="Productos" class="chosen-select" tabindex="4" required>
      <?php $consulta2_sql = "SELECT cod_producto, cod_producto_barra, nombre_producto FROM tbl15_producto ORDER BY nombre_producto ASC";
      $consulta2 = mysqlI_query($conectar, $consulta2_sql);
      while ($datos2 = mysqlI_fetch_assoc($consulta2)) {
      $cod_producto         = $datos2['cod_producto'];
      $cod_producto_barra   = $datos2['cod_producto_barra'];
      $nombre_producto      = $datos2['nombre_producto']; ?>
      <option value="<?php echo $cod_producto_barra ?>"><?php echo $cod_producto_barra.' | '.$nombre_producto ?></option>
      <?php } ?>
      </select>
    </td>
  </tr>
  <tr>
    <td style="text-align:right;"></td>
    <td style="text-align:left;"><button type="submit">Ver Registros</button></td>
  </tr>
</table>
</form>
<?php
if (isset($_GET['fecha_operacion_ini'])) {
  $motivo               = 'TODOS';
  $fecha_operacion_ini            = addslashes($_GET['fecha_operacion_ini']);
  $fecha_operacion_fin            = addslashes($_GET['fecha_operacion_fin']);
  $fecha                                   = date("Y/m/d");
  $pagina                                  = $_SERVER['PHP_SELF'];
  $contado                                 = '1';
  $credito                                 = '2';
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
if ($cod_administrador==0) {
  $sql_total_venta = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_compra_producto, SUM(total_venta_producto * (comision_ptj/100)) AS total_comision, 
  SUM(und_venta) AS total_suma_und_venta FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin') $filtro_cod_producto_barra";
  $consulta_total_venta = mysqli_query($conectar, $sql_total_venta) or die(mysqli_error($conectar));
  $datos_total_venta = mysqli_fetch_assoc($consulta_total_venta);

  $total_suma_venta_producto       = $datos_total_venta['total_suma_venta_producto'];
  $total_compra_producto           = $datos_total_venta['total_compra_producto'];
  $total_ganancia                  = $total_suma_venta_producto - $total_compra_producto;
  $total_comision_venta            = $datos_total_venta['total_comision'];
  $total_suma_und_venta            = $datos_total_venta['total_suma_und_venta'];

  $sql_total_venta_contado = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto
  FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin') $filtro_cod_producto_barra AND (cod_tipo_pago = '$contado')";
  $consulta_total_venta_contado = mysqli_query($conectar, $sql_total_venta_contado) or die(mysqli_error($conectar));
  $datos_total_venta_contado = mysqli_fetch_assoc($consulta_total_venta_contado);

  $total_venta_producto_contado    = $datos_total_venta_contado['total_venta_producto'];
  $total_compra_producto_contado   = $datos_total_venta_contado['total_compra_producto'];

  $sql_total_venta_credito = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto 
  FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin') $filtro_cod_producto_barra AND (cod_tipo_pago = '$credito')";
  $consulta_total_venta_credito = mysqli_query($conectar, $sql_total_venta_credito) or die(mysqli_error($conectar));
  $datos_total_venta_credito = mysqli_fetch_assoc($consulta_total_venta_credito);

  $total_venta_producto_credito    = $datos_total_venta_credito['total_venta_producto'];
  $total_compra_producto_credito   = $datos_total_venta_credito['total_compra_producto'];

  $sql_total_cuenta_credito_abono = "SELECT SUM(abonado) AS total_cuenta_credito_abonado FROM tbl15_cuentas_cobrar_abonos 
  WHERE (fecha_anyo BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin')";
  $consulta_cuenta_credito_abono = mysqli_query($conectar, $sql_total_cuenta_credito_abono) or die(mysqli_error($conectar));
  $datos_cuenta_credito_abono = mysqli_fetch_assoc($consulta_cuenta_credito_abono);

  $total_cuenta_credito_abonado    = $datos_cuenta_credito_abono['total_cuenta_credito_abonado'];

  $total_caja_venta_fisica         = $total_venta_producto_contado + $total_cuenta_credito_abonado;
} else {
  $sql_total_venta = "SELECT SUM(total_venta_producto) AS total_suma_venta_producto, SUM(total_compra_producto) AS total_compra_producto, SUM(total_venta_producto * (comision_ptj/100)) AS total_comision, 
  SUM(und_venta) AS total_suma_und_venta FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin') $filtro_cod_producto_barra AND (cod_administrador = '$cod_administrador')";
  $consulta_total_venta = mysqli_query($conectar, $sql_total_venta) or die(mysqli_error($conectar));
  $datos_total_venta = mysqli_fetch_assoc($consulta_total_venta);

  $total_suma_venta_producto       = $datos_total_venta['total_suma_venta_producto'];
  $total_compra_producto           = $datos_total_venta['total_compra_producto'];
  $total_ganancia                  = $total_suma_venta_producto - $total_compra_producto;
  $total_comision_venta            = $datos_total_venta['total_comision'];
  $total_suma_und_venta            = $datos_total_venta['total_suma_und_venta'];

  $sql_total_venta_contado = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto 
  FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin') AND (cod_tipo_pago = '$contado') $filtro_cod_producto_barra AND (cod_administrador = '$cod_administrador')";
  $consulta_total_venta_contado = mysqli_query($conectar, $sql_total_venta_contado) or die(mysqli_error($conectar));
  $datos_total_venta_contado = mysqli_fetch_assoc($consulta_total_venta_contado);

  $total_venta_producto_contado    = $datos_total_venta_contado['total_venta_producto'];
  $total_compra_producto_contado    = $datos_total_venta_contado['total_compra_producto'];

  $sql_total_venta_credito = "SELECT SUM(total_venta_producto) AS total_venta_producto, SUM(total_compra_producto) AS total_compra_producto 
  FROM tbl15_venta_producto 
  WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin') AND (cod_tipo_pago = '$credito') $filtro_cod_producto_barra AND (cod_administrador = '$cod_administrador')";
  $consulta_total_venta_credito = mysqli_query($conectar, $sql_total_venta_credito) or die(mysqli_error($conectar));
  $datos_total_venta_credito = mysqli_fetch_assoc($consulta_total_venta_credito);

  $total_venta_producto_credito    = $datos_total_venta_credito['total_venta_producto'];
  $total_compra_producto_credito    = $datos_total_venta_credito['total_compra_producto'];

  $sql_total_cuenta_credito_abono = "SELECT SUM(abonado) AS total_cuenta_credito_abonado FROM tbl15_cuentas_cobrar_abonos 
  WHERE (fecha_anyo BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin') AND (cod_administrador = '$cod_administrador')";
  $consulta_cuenta_credito_abono = mysqli_query($conectar, $sql_total_cuenta_credito_abono) or die(mysqli_error($conectar));
  $datos_cuenta_credito_abono = mysqli_fetch_assoc($consulta_cuenta_credito_abono);

  $total_cuenta_credito_abonado    = $datos_cuenta_credito_abono['total_cuenta_credito_abonado'];

  $total_caja_venta_fisica         = $total_venta_producto_contado + $total_cuenta_credito_abonado;
}
/* --------------------------------------------------------------------------------------------------------------------------------- */
/* --------------------------------------------------------------------------------------------------------------------------------- */
?>
<br>
<?php
$total_total_venta_producto    = 0;
$total_ganancia_venta_sum      = 0;
$contador_array                = 1;
$datos_vectores                = array();

$sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_compra_producto, tbl15_venta_producto.total_compra_producto, tbl15_venta_producto.precio_venta_producto, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, tbl15_venta_producto.fecha_seg_venta_producto, 
tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, tbl15_venta_producto.und_producto_inv, 
tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_venta_producto.cod_administrador, tbl15_venta_producto.comentario_producto, 
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar, tbl15_venta_producto.comision_ptj, tbl15_venta_producto.und_producto, tbl15_venta_producto.cod_estado_cava
FROM tbl15_tercero RIGHT JOIN (tbl15_cliente RIGHT JOIN tbl15_venta_producto ON tbl15_cliente.cod_cliente = tbl15_venta_producto.cod_cliente) 
ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.fecha_ymd_venta_producto BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin') $filtro_cod_producto_barra 
ORDER BY tbl15_venta_producto.cod_venta_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

  $cod_venta_producto                                 = $info_cliente['cod_venta_producto'];
  $cod_producto                                       = $info_cliente['cod_producto'];
  $cod_producto_barra                                 = $info_cliente['cod_producto_barra'];
  $cod_info_factura_venta                             = $info_cliente['cod_info_factura_venta'];
  $cod_factura                                        = $info_cliente['cod_factura'];
  $nombre_producto                                    = $info_cliente['nombre_producto'];
  $und_venta                                          = $info_cliente['und_venta'];
  $precio_compra_producto                             = $info_cliente['precio_compra_producto'];
  $total_compra_producto                              = $info_cliente['total_compra_producto'];
  $precio_venta_producto                              = $info_cliente['precio_venta_producto'];
  $total_venta_producto                               = $info_cliente['total_venta_producto'];
  $fecha_ymd_venta_producto                           = $info_cliente['fecha_ymd_venta_producto'];
  $fecha_hora_venta_producto                          = $info_cliente['fecha_hora_venta_producto'];
  $fecha_seg_venta_producto                           = $info_cliente['fecha_seg_venta_producto'];
  $und_producto_inv                                   = $info_cliente['und_producto_inv'];
  $comentario_producto                                = $info_cliente['comentario_producto'];
  $nombre_tipo_unidad_medida                          = $info_cliente['nombre_tipo_unidad_medida'];
  $cod_administrador_db                               = $info_cliente['cod_administrador'];
  $und_producto                                       = $info_cliente['und_producto'];
  $nombre1_tercero                                    = $info_cliente['nombre1_tercero'];

  $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
  $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
  $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

  $cuenta                                             = $datos_administrador['cuenta'];

  $id_operacion                                       = $cod_venta_producto;
  $tipo_operacion                                     = "VENTA";
  $und_operacion                                      = $und_venta;
  $und_inv_antes_operacion                            = $und_producto_inv;
  $und_inv_despues_operacion                          = $und_producto;
  $nombre_tipo_unidad_medida_operacion                = $nombre_tipo_unidad_medida;
  $usuario_operacion                                  = $cuenta;
  $fecha_operacion                                    = $fecha_ymd_venta_producto;
  $hora_operacion                                     = $fecha_hora_venta_producto;
  $fecha_seg_operacion                                = $fecha_seg_venta_producto;
  $comentario_operacion                               = $comentario_producto.' | '.$nombre1_tercero.' | ID INFO: '.$cod_info_factura_venta.' | FACTURA: '.$cod_factura;

  $datos_vectores[$contador_array]          = array("id_operacion"=>$id_operacion, "tipo_operacion"=>$tipo_operacion, "cod_producto_barra"=>$cod_producto_barra, "nombre_producto"=>$nombre_producto, "precio_venta_producto"=>$precio_venta_producto, "und_operacion"=>$und_operacion, "und_inv_antes_operacion"=>$und_inv_antes_operacion, "und_inv_despues_operacion"=>$und_inv_despues_operacion, "nombre_tipo_unidad_medida_operacion"=>$nombre_tipo_unidad_medida_operacion, "usuario_operacion"=>$usuario_operacion, "fecha_operacion"=>$fecha_operacion, "hora_operacion"=>$hora_operacion, "comentario_operacion"=>$comentario_operacion, "fecha_seg_operacion"=>$fecha_seg_operacion);
  $contador_array ++;
} 
?>


<?php
$sql_info_factura = "SELECT * FROM tbl15_operacion WHERE (fecha_devolucion BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin') $filtro_cod_producto_barra ORDER BY cod_operacion DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

  $cod_operacion                                      = $info_info_factura['cod_operacion'];
  $cod_venta_producto                                 = $info_info_factura['cod_venta_producto'];
  $cod_producto_barra                                 = $info_info_factura['cod_producto_barra'];
  $nombre_producto                                    = $info_info_factura['nombre_producto'];
  $und_nuevas                                         = $info_info_factura['und_nuevas'];
  $und_inventario                                     = $info_info_factura['und_inventario'];
  $unidades_faltantes                                 = $info_info_factura['unidades_faltantes'];
  $unidades_vendidas                                  = $info_info_factura['unidades_vendidas'];
  $und_vend_orig                                      = $info_info_factura['und_vend_orig'];
  $devoluciones                                       = $info_info_factura['devoluciones'];
  $precio_compra_producto                             = $info_info_factura['precio_compra_producto'];
  $precio_venta_producto                              = $info_info_factura['precio_venta_producto'];
  $comentario                                         = $info_info_factura['comentario'];
  $fecha_devolucion                                   = $info_info_factura['fecha_devolucion'];
  $hora_devolucion                                    = $info_info_factura['hora_devolucion'];
  $fecha_orig                                         = $info_info_factura['fecha_orig'];
  $vendedor                                           = $info_info_factura['vendedor'];
  $cuenta                                             = $info_info_factura['cuenta'];
  $cod_administrador                                  = $info_info_factura['cod_administrador'];
  $origen_operacion                                   = $info_info_factura['origen_operacion'];
  $fecha_time                                         = $info_info_factura['fecha_time'];

  $id_operacion                                       = $cod_operacion;
  $tipo_operacion                                     = $origen_operacion;
  $und_operacion                                      = $und_nuevas;
  $und_inv_antes_operacion                            = $und_inventario;
  $und_inv_despues_operacion                          = $unidades_faltantes;
  $nombre_tipo_unidad_medida_operacion                = 'UND';
  $usuario_operacion                                  = $cuenta;
  $fecha_operacion                                    = $fecha_devolucion;
  $hora_operacion                                     = $hora_devolucion;
  $fecha_seg_operacion                                = $fecha_time;
  $comentario_operacion                               = $comentario;

  $datos_vectores[$contador_array]          = array("id_operacion"=>$id_operacion, "tipo_operacion"=>$tipo_operacion, "cod_producto_barra"=>$cod_producto_barra, "nombre_producto"=>$nombre_producto, "precio_venta_producto"=>$precio_venta_producto, "und_operacion"=>$und_operacion, "und_inv_antes_operacion"=>$und_inv_antes_operacion, "und_inv_despues_operacion"=>$und_inv_despues_operacion, "nombre_tipo_unidad_medida_operacion"=>$nombre_tipo_unidad_medida_operacion, "usuario_operacion"=>$usuario_operacion, "fecha_operacion"=>$fecha_operacion, "hora_operacion"=>$hora_operacion, "comentario_operacion"=>$comentario_operacion, "fecha_seg_operacion"=>$fecha_seg_operacion);
  $contador_array ++;
} 
?>


<?php
$sql_cliente = "SELECT cod_factura_compra_producto, cod_producto, cod_producto_barra, cod_info_factura_compra, cod_factura, nombre_producto, 
und_compra, precio_compra_producto, precio_venta_producto, nombre_tipo_unidad_medida, fecha_ymd_venta_producto, fecha_seg_venta_producto, 
cod_administrador, cuenta, und_producto, cod_tercero
FROM tbl15_factura_compra_producto WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin') $filtro_cod_producto_barra 
ORDER BY cod_factura_compra_producto DESC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

  $cod_factura_compra_producto                        = $info_cliente['cod_factura_compra_producto'];
  $cod_producto                                       = $info_cliente['cod_producto'];
  $cod_producto_barra                                 = $info_cliente['cod_producto_barra'];
  $cod_info_factura_compra                            = $info_cliente['cod_info_factura_compra'];
  $cod_factura                                        = $info_cliente['cod_factura'];
  $nombre_producto                                    = $info_cliente['nombre_producto'];
  $und_compra                                         = $info_cliente['und_compra'];
  $precio_compra_producto                             = $info_cliente['precio_compra_producto'];
  $precio_venta_producto                              = $info_cliente['precio_venta_producto'];
  $nombre_tipo_unidad_medida                          = $info_cliente['nombre_tipo_unidad_medida'];
  $fecha_ymd_venta_producto                           = $info_cliente['fecha_ymd_venta_producto'];
  $fecha_seg_venta_producto                           = $info_cliente['fecha_seg_venta_producto'];
  $fecha_hora                                         = date("H:i:s", $fecha_seg_venta_producto);
  $cod_administrador_db                               = $info_cliente['cod_administrador'];
  $und_producto                                       = $info_cliente['und_producto'];
  $cod_tercero                                        = $info_cliente['cod_tercero'];

  $sql_tercero = "SELECT nombre1_tercero FROM tbl15_tercero WHERE cod_tercero = '$cod_tercero'";
  $consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
  $datos_tercero = mysqli_fetch_assoc($consulta_tercero);

  $nombre1_tercero                                    = $datos_tercero['nombre1_tercero'];

  $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
  $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
  $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

  $cuenta                                             = $datos_administrador['cuenta'];

  $id_operacion                                       = $cod_factura_compra_producto;
  $tipo_operacion                                     = 'COMPRA';
  $und_operacion                                      = $und_compra;
  $und_inv_antes_operacion                            = $und_producto;
  $und_inv_despues_operacion                          = $und_producto + $und_operacion;
  $nombre_tipo_unidad_medida_operacion                = 'UND';
  $usuario_operacion                                  = $cuenta;
  $fecha_operacion                                    = $fecha_ymd_venta_producto;
  $hora_operacion                                     = $fecha_hora;
  $fecha_seg_operacion                                = $fecha_seg_venta_producto;
  $comentario_operacion                               = ''.$nombre1_tercero.' | ID INFO: '.$cod_info_factura_compra.' | FACTURA: '.$cod_factura;

  $datos_vectores[$contador_array]          = array("id_operacion"=>$id_operacion, "tipo_operacion"=>$tipo_operacion, "cod_producto_barra"=>$cod_producto_barra, "nombre_producto"=>$nombre_producto, "precio_venta_producto"=>$precio_venta_producto, "und_operacion"=>$und_operacion, "und_inv_antes_operacion"=>$und_inv_antes_operacion, "und_inv_despues_operacion"=>$und_inv_despues_operacion, "nombre_tipo_unidad_medida_operacion"=>$nombre_tipo_unidad_medida_operacion, "usuario_operacion"=>$usuario_operacion, "fecha_operacion"=>$fecha_operacion, "hora_operacion"=>$hora_operacion, "comentario_operacion"=>$comentario_operacion, "fecha_seg_operacion"=>$fecha_seg_operacion);
  $contador_array ++;
}
?>

<?php
$sql_transferencia_bodega_producto = "SELECT * FROM tbl15_transferencia_bodega_producto WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin') $filtro_cod_producto_barra 
ORDER BY cod_transferencia_bodega_producto DESC";
$consulta_transferencia_bodega_producto = mysqli_query($conectar, $sql_transferencia_bodega_producto);
while ($datos_transferencia_bodega_producto = mysqli_fetch_assoc($consulta_transferencia_bodega_producto)) {

  $cod_transferencia_bodega_producto                  = $datos_transferencia_bodega_producto['cod_transferencia_bodega_producto'];
  $cod_producto                                       = $datos_transferencia_bodega_producto['cod_producto'];
  $cod_producto_barra                                 = $datos_transferencia_bodega_producto['cod_producto_barra'];
  $nombre_producto                                    = $datos_transferencia_bodega_producto['nombre_producto'];
  $und_compra                                         = $datos_transferencia_bodega_producto['und_compra'];
  $und_venta                                          = $datos_transferencia_bodega_producto['und_venta'];
  $und_producto                                       = $datos_transferencia_bodega_producto['und_producto'];
  $und_producto_inv                                   = $datos_transferencia_bodega_producto['und_producto_inv'];
  $precio_venta_producto                              = $datos_transferencia_bodega_producto['precio_venta_producto'];
  $nombre_tipo_unidad_medida                          = $datos_transferencia_bodega_producto['nombre_tipo_unidad_medida'];
  $cuenta                                             = $datos_transferencia_bodega_producto['cuenta'];
  $fecha_ymd_venta_producto                           = $datos_transferencia_bodega_producto['fecha_ymd_venta_producto'];
  $fecha_hora_venta_producto                          = $datos_transferencia_bodega_producto['fecha_hora_venta_producto'];
  $fecha_seg_venta_producto                           = $datos_transferencia_bodega_producto['fecha_seg_venta_producto'];

  $id_operacion                                       = $cod_transferencia_bodega_producto;
  $tipo_operacion                                     = 'TRANSFERENCIA DE SALIDA';
  $und_operacion                                      = $und_venta;
  $und_inv_antes_operacion                            = $und_producto_inv;
  $und_inv_despues_operacion                          = $und_producto;
  $nombre_tipo_unidad_medida_operacion                = 'UND';
  $usuario_operacion                                  = $cuenta;
  $fecha_operacion                                    = $fecha_ymd_venta_producto;
  $hora_operacion                                     = $fecha_hora_venta_producto;
  $fecha_seg_operacion                                = $fecha_seg_venta_producto;
  $comentario_operacion                               = '';

  $datos_vectores[$contador_array]                    = array("id_operacion"=>$id_operacion, "tipo_operacion"=>$tipo_operacion, "cod_producto_barra"=>$cod_producto_barra, "nombre_producto"=>$nombre_producto, "precio_venta_producto"=>$precio_venta_producto, "und_operacion"=>$und_operacion, "und_inv_antes_operacion"=>$und_inv_antes_operacion, "und_inv_despues_operacion"=>$und_inv_despues_operacion, "nombre_tipo_unidad_medida_operacion"=>$nombre_tipo_unidad_medida_operacion, "usuario_operacion"=>$usuario_operacion, "fecha_operacion"=>$fecha_operacion, "hora_operacion"=>$hora_operacion, "comentario_operacion"=>$comentario_operacion, "fecha_seg_operacion"=>$fecha_seg_operacion);
  $contador_array ++;
}
?>

<?php
$sql_transferencia_bodega_entrada_producto = "SELECT * FROM tbl15_transferencia_bodega_entrada_producto WHERE (fecha_ymd_venta_producto BETWEEN '$fecha_operacion_ini' AND '$fecha_operacion_fin') $filtro_cod_producto_barra 
ORDER BY cod_transferencia_bodega_entrada_producto DESC";
$consulta_transferencia_bodega_entrada_producto = mysqli_query($conectar, $sql_transferencia_bodega_entrada_producto);
while ($datos_transferencia_bodega_entrada_producto = mysqli_fetch_assoc($consulta_transferencia_bodega_entrada_producto)) {

  $cod_transferencia_bodega_entrada_producto          = $datos_transferencia_bodega_entrada_producto['cod_transferencia_bodega_entrada_producto'];
  $cod_producto                                       = $datos_transferencia_bodega_entrada_producto['cod_producto'];
  $cod_producto_barra                                 = $datos_transferencia_bodega_entrada_producto['cod_producto_barra'];
  $nombre_producto                                    = $datos_transferencia_bodega_entrada_producto['nombre_producto'];
  $precio_venta_producto                              = $datos_transferencia_bodega_entrada_producto['precio_venta_producto'];
  $nombre_tipo_unidad_medida                          = $datos_transferencia_bodega_entrada_producto['nombre_tipo_unidad_medida'];
  $und_venta                                          = $datos_transferencia_bodega_entrada_producto['und_venta'];
  $und_producto                                       = $datos_transferencia_bodega_entrada_producto['und_producto'];
  $und_producto_inv                                   = $datos_transferencia_bodega_entrada_producto['und_producto_inv'];
  $cuenta                                             = $datos_transferencia_bodega_entrada_producto['cuenta'];
  $fecha_ymd_venta_producto                           = $datos_transferencia_bodega_entrada_producto['fecha_ymd_venta_producto'];
  $fecha_hora_venta_producto                          = $datos_transferencia_bodega_entrada_producto['fecha_hora_venta_producto'];
  $fecha_seg_venta_producto                           = $datos_transferencia_bodega_entrada_producto['fecha_seg_venta_producto'];

  $id_operacion                                       = $cod_transferencia_bodega_entrada_producto;
  $tipo_operacion                                     = 'TRANSFERENCIA DE ENTRADA';
  $und_operacion                                      = $und_venta;
  $und_inv_antes_operacion                            = $und_producto_inv;
  $und_inv_despues_operacion                          = $und_producto;
  $nombre_tipo_unidad_medida_operacion                = 'UND';
  $usuario_operacion                                  = $cuenta;
  $fecha_operacion                                    = $fecha_ymd_venta_producto;
  $hora_operacion                                     = $fecha_hora_venta_producto;
  $fecha_seg_operacion                                = $fecha_seg_venta_producto;
  $comentario_operacion                               = '';

  $datos_vectores[$contador_array]                    = array("id_operacion"=>$id_operacion, "tipo_operacion"=>$tipo_operacion, "cod_producto_barra"=>$cod_producto_barra, "nombre_producto"=>$nombre_producto, "precio_venta_producto"=>$precio_venta_producto, "und_operacion"=>$und_operacion, "und_inv_antes_operacion"=>$und_inv_antes_operacion, "und_inv_despues_operacion"=>$und_inv_despues_operacion, "nombre_tipo_unidad_medida_operacion"=>$nombre_tipo_unidad_medida_operacion, "usuario_operacion"=>$usuario_operacion, "fecha_operacion"=>$fecha_operacion, "hora_operacion"=>$hora_operacion, "comentario_operacion"=>$comentario_operacion, "fecha_seg_operacion"=>$fecha_seg_operacion);
  $contador_array ++;
}
?>

<?php $total_reg = count($datos_vectores); ?>
<form action="" method="GET">
<table class="table table-striped">
  <tr>
    <th style="text-align:center;">FECHA INI: <?php echo $fecha_operacion_ini ?></th>
    <th style="text-align:center;">FECHA FIN: <?php echo $fecha_operacion_fin ?></th>
    <th style="text-align:center;">REGISTROS: <?php echo $nombre_producto ?> | <?php echo $cod_producto_barra ?> | (<?php echo $total_reg ?>)</th>
  </tr>
</table>
</form> 

<?php if ($total_reg <> '0') { ?>
  <table class="table table-striped">
  <thead>
    <tr>
      <th style="text-align:center">TIPO OPERACION</th>
      <th style="text-align:center">CODIGO</th>
      <th style="text-align:center">PRODUCTO</th>
      <th style="text-align:center">UND ANTES DE MODIFICAR</th>
      <th style="text-align:center">UND NUEVAS / VENDIDAS / INGRESADAS</th>
      <th style="text-align:center">UND DESPUES DE MODIFICAR</th>
      <th style="text-align:center">COMENTARIO</th>
      <th style="text-align:center">PRECIO VENTA</th>
      <th style="text-align:center">FECHA HORA</th>
      <th style="text-align:center">USUARIO</th>
    </tr>
  </thead>
  <tbody>
  <?php
  foreach ($datos_vectores as $key => $fecha_operacion_seg) {
      $datos_fecha_para_ordenar[$key] = $fecha_operacion_seg['fecha_seg_operacion'];
  }

  array_multisort($datos_fecha_para_ordenar, SORT_DESC, $datos_vectores);
  foreach ($datos_vectores as $clave=>$value) {

     $id_operacion                                      = $value['id_operacion'];
     $tipo_operacion                                    = $value['tipo_operacion'];
     $nombre_producto                                   = $value['nombre_producto'];
     $cod_producto_barra                                = $value['cod_producto_barra'];
     $precio_venta_producto                             = $value['precio_venta_producto'];
     $und_operacion                                     = $value['und_operacion'];
     $und_inv_antes_operacion                           = $value['und_inv_antes_operacion'];
     $und_inv_despues_operacion                         = $value['und_inv_despues_operacion'];
     $nombre_tipo_unidad_medida_operacion               = $value['nombre_tipo_unidad_medida_operacion'];
     $usuario_operacion                                 = $value['usuario_operacion'];
     $fecha_operacion                                   = $value['fecha_operacion'];
     $hora_operacion                                    = $value['hora_operacion'];
     $comentario_operacion                              = $value['comentario_operacion'];
     $fecha_seg_operacion                               = $value['fecha_seg_operacion'];

     if ($tipo_operacion == 'VENTA') {
       $tipo_operacion = 'VENTA';
     } elseif ($tipo_operacion == 'ventas' & $und_operacion > 0) {
       $tipo_operacion = 'DEVOLUCION POR VENTA';
     } elseif ($tipo_operacion == 'inventario' & $und_operacion > 0) {
       $tipo_operacion = 'CARGADO POR INVENTARIO';
     } elseif ($tipo_operacion == 'inventario' & $und_operacion < 0) {
       $tipo_operacion = 'DEVOLUCION POR INVENTARIO';
     } elseif ($tipo_operacion == 'COMPRA' & $und_operacion > 0) {
       $tipo_operacion = 'CARGADO POR FACTURA DE COMPRA';
     } elseif ($tipo_operacion == 'TRANSFERENCIA DE ENTRADA' & $und_operacion > 0) {
       $tipo_operacion = 'TRANSFERENCIA DE ENTRADA';
     } elseif ($tipo_operacion == 'TRANSFERENCIA DE SALIDA' & $und_operacion > 0) {
       $tipo_operacion = 'TRANSFERENCIA DE SALIDA';
     } else {
       $tipo_operacion = '';
     }
     ?>
    <tr>
      <td style="text-align:left"><?php echo $tipo_operacion?></td>
      <td style="text-align:left"><?php echo $cod_producto_barra?></td>
      <td style="text-align:left"><?php echo $nombre_producto?></td>
      <td style="text-align:center"><?php echo $und_inv_antes_operacion?></td>
      <td style="text-align:center"><?php echo $und_operacion?></td>
      <td style="text-align:center"><?php echo $und_inv_despues_operacion?></td>
      <td style="text-align:left"><?php echo $comentario_operacion?></td>
      <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
      <td style="text-align:center"><?php echo $fecha_operacion.' | '.$hora_operacion?></td>
      <td style="text-align:center"><?php echo $usuario_operacion?></td>

    </tr>
  <?php } ?>
  </tbody>
  </table>
<?php } ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript" charset="utf-8"></script>
</body>
</html>