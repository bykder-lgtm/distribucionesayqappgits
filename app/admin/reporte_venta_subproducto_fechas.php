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
<!--<div class="container">-->
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Reporte Ventas Por Rango de Fechas</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$fecha_impr                        = date("Ymd");
$hora_impr                         = date("His");
$seleccionado                      = 0;


if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
    $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
    $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
    $total_productos                         = count($_GET['cod_producto_barra']);
    $filtro_cod_producto_barra               = "";
    $filtro_cod_producto_barra_rel           = "";
    $contador                                = 0;
    $filtro_cod_producto_barra              .= "";


    if ($_GET['cod_producto_barra'][0] == '0') {
        $filtro_cod_producto_barra        .= "";
        $filtro_cod_producto_barra_rel    .= "";
        $nombre_producto_get               = 'TODOS';
    } else {
        foreach ($_GET['cod_producto_barra'] as &$valor_cod_producto_barra) {
        $cod_producto_barra           = $valor_cod_producto_barra;
        $contador ++;

            if ($contador > 1) {
              $filtro_cod_producto_barra        .= " OR (cod_producto_barra LIKE '".$cod_producto_barra."')";
              $filtro_cod_producto_barra_rel    .= " OR (tbl15_venta_producto_sub.cod_producto_barra LIKE '".$cod_producto_barra."')";
            } else {
              $filtro_cod_producto_barra        .= " AND ((cod_producto_barra LIKE '".$cod_producto_barra."')";
              $filtro_cod_producto_barra_rel    .= " AND ((tbl15_venta_producto_sub.cod_producto_barra LIKE '".$cod_producto_barra."')";
            }
        }
        $filtro_cod_producto_barra              .= ")";
        $filtro_cod_producto_barra_rel          .= ")";
        unset($valor_cod_producto_barra);
        $nombre_producto_get                     = $_GET['cod_producto_barra'][0];
    }
} else {
    $fecha_ymd_venta_producto_ini            = date("Y-m-d");
    $fecha_ymd_venta_producto_fin            = date("Y-m-d");
}
?>
<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;">FECHA INICIAL</th>
    <th style="text-align:center;">FECHA FINAL</th>
    <th style="text-align:left;">PRODUCTO</th>
    <th style="text-align:center;"></th>

  </tr>
  <tr>
    <td style="text-align:center;">
        <input class="input-block-level" name="fecha_ymd_venta_producto_ini" type="date" value="<?php echo $fecha_ymd_venta_producto_ini ?>" style="width: 140px;" required/>
        <?php if ($cod_estado_hora_reporte_venta_global == '1') { ?>
        <input class="input-block-level" name="fecha_hora_venta_producto_ini" type="time" value="<?php echo $fecha_hora_venta_producto_ini ?>" style="width: 140px;" required/>
        <?php } ?>
    </td>

    <td style="text-align:center;">
        <input class="input-block-level" name="fecha_ymd_venta_producto_fin" type="date" value="<?php echo $fecha_ymd_venta_producto_fin ?>" style="width: 140px;" required/>
        <?php if ($cod_estado_hora_reporte_venta_global == '1') { ?>
        <input class="input-block-level" name="fecha_hora_venta_producto_fin" type="time" value="<?php echo $fecha_hora_venta_producto_fin ?>" style="width: 140px;" required/>
        <?php } ?>
    </td>
    <td style="text-align:left;">
        <select name="cod_producto_barra[]" id="cod_producto_barra" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" tabindex="1" required>
            <?php if (isset($cod_tercero)) { echo "<option value='0' $seleccionado >TODOS</option>"; } else { echo  "<option value='0' $seleccionado >TODOS</option>"; }
            $consulta2_sql = "SELECT cod_producto, cod_producto_barra, nombre_producto  FROM tbl15_producto ORDER BY nombre_producto ASC";
            $consulta2 = mysqlI_query($conectar, $consulta2_sql);
            while ($datos2 = mysqlI_fetch_assoc($consulta2)) {
            $cod_producto         = $datos2['cod_producto'];
            $cod_producto_barra   = $datos2['cod_producto_barra'];
            $nombre_producto      = $datos2['nombre_producto']; ?>
            <option value="<?php echo $cod_producto_barra ?>"><?php echo $cod_producto_barra.' | '.$nombre_producto ?></option>
            <?php } ?>
        </select>
    </td>
    <th style="text-align:left;"><input type="submit" value="Ver Registros" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></th>
  </tr>
</table>
</form>
<?php
if (isset($_GET['fecha_ymd_venta_producto_ini'])) {
    $motivo                                  = 'TODOS';
    $fecha_ymd_venta_producto_ini            = addslashes($_GET['fecha_ymd_venta_producto_ini']);
    $fecha_ymd_venta_producto_fin            = addslashes($_GET['fecha_ymd_venta_producto_fin']);
    $fecha_mes_venta_producto_ini            = date("Y-m", strtotime($fecha_ymd_venta_producto_ini));
    $fecha_mes_venta_producto_fin            = date("Y-m", strtotime($fecha_ymd_venta_producto_fin));
?>
<table class="table table-striped">
<tr>
    <td style="text-align:left;">FECHA INICAL: <?php echo $fecha_ymd_venta_producto_ini ?><?php if ($cod_estado_hora_reporte_venta_global == '1') { ?> | <?php echo $fecha_hora_venta_producto_ini ?><?php } ?></td>
    <td style="text-align:left;">FECHA FINAL: <?php echo $fecha_ymd_venta_producto_fin ?><?php if ($cod_estado_hora_reporte_venta_global == '1') { ?> | <?php echo $fecha_hora_venta_producto_fin ?><?php } ?></td>
    <td style="text-align:left;">PRODUCTO: <?php echo $nombre_producto_get ?></td>
</tr>
</table>
<!-- ********************************************************************************************************************************* -->
<!-- ********************************************************************************************************************************* -->
<hr>
<table class="table table-striped">
<tr>
<td style="text-align:center; background-color:#DBE0F3; color:#000;"><a href="#"><strong>VENTAS SUBPRODUCTOS</strong></a></td>
</tr>
</table>

<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Ver</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo Factura</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Factura</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Cod</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Concepto</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Cliente</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Unidades</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Vendedor</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Fecha</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Hora</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo Pago</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Forma Pago</th>
        <?php if ($cod_seguridad==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Inv</th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">IdForeG</th>
    </tr>
</thead>
<tbody>
<?php
$total_total_venta_producto    = 0;
$total_ganancia_venta_sum      = 0;
$contador_reg_prod_venta       = 0;

$sql_cliente = "SELECT tbl15_venta_producto_sub.cod_venta_producto, tbl15_venta_producto_sub.cod_producto, tbl15_venta_producto_sub.cod_producto_barra, 
tbl15_venta_producto_sub.cod_info_factura_venta, tbl15_venta_producto_sub.cod_factura, tbl15_venta_producto_sub.cod_historia_clinica, tbl15_venta_producto_sub.nombre_producto, 
tbl15_venta_producto_sub.und_venta, tbl15_venta_producto_sub.precio_compra_producto, tbl15_venta_producto_sub.precio_costo_producto, tbl15_venta_producto_sub.total_compra_producto, 
tbl15_venta_producto_sub.precio_venta_producto, tbl15_venta_producto_sub.iva_ptj, tbl15_venta_producto_sub.descuento_ptj, 
tbl15_venta_producto_sub.total_venta_producto, tbl15_venta_producto_sub.nombre_tipo_producto, tbl15_venta_producto_sub.nombre_tipo_unidad_medida, 
tbl15_venta_producto_sub.nombre_tipo_presentacion, tbl15_venta_producto_sub.nombre_via_administracion, tbl15_venta_producto_sub.nombre_frec_duracion, 
tbl15_venta_producto_sub.fecha_ymd_venta_producto, tbl15_venta_producto_sub.fecha_hora_venta_producto, tbl15_venta_producto_sub.cod_administrador,
tbl15_tercero.cod_tercero, tbl15_tercero.nombre1_tercero, tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.apellido2_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_venta_producto_sub.cuenta, tbl15_venta_producto_sub.cod_tipo_cobrar, tbl15_venta_producto_sub.comision_ptj, tbl15_venta_producto_sub.cod_tipo_pago, 
tbl15_venta_producto_sub.cod_tipo_forma_pago, tbl15_venta_producto_sub.cod_dependencia, tbl15_venta_producto_sub.nombre_tipo_factura, tbl15_venta_producto_sub.und_producto, 
tbl15_venta_producto_sub.nombre_tipo_compra, tbl15_venta_producto_sub.cod_tipo_metodo_envio, tbl15_venta_producto_sub.nombre_tipo_cobro
FROM tbl15_tercero RIGHT JOIN tbl15_venta_producto_sub ON tbl15_tercero.cod_tercero = tbl15_venta_producto_sub.cod_tercero 
WHERE (tbl15_venta_producto_sub.fecha_ymd_venta_producto BETWEEN '$fecha_ymd_venta_producto_ini' AND '$fecha_ymd_venta_producto_fin') $filtro_cod_producto_barra
ORDER BY tbl15_venta_producto_sub.cod_venta_producto DESC";
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
    $precio_compra_producto        = $info_cliente['precio_compra_producto'];
    $precio_costo_producto         = $info_cliente['precio_costo_producto'];
    $total_compra_producto         = $info_cliente['total_compra_producto'];
    $precio_venta_producto         = $info_cliente['precio_venta_producto'];
    $total_venta_producto          = $info_cliente['total_venta_producto'];
    $cod_tercero                   = $info_cliente['cod_tercero'];
    ///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
    if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
    if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
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
    $nombre_propietario            = $info_cliente['nombre1_tercero'].' '.$info_cliente['nombre2_tercero'].''.$info_cliente['apellido1_tercero'].' '.$info_cliente['apellido2_tercero'].' | '.$info_cliente['identificacion_tercero'].' | '.$cod_tercero;
    $comision_ptj                  = $info_cliente['comision_ptj'];
    $cod_tipo_pago                 = $info_cliente['cod_tipo_pago'];
    $cod_tipo_forma_pago           = $info_cliente['cod_tipo_forma_pago'];
    $cod_dependencia               = $info_cliente['cod_dependencia'];
    $nombre_tipo_factura           = $info_cliente['nombre_tipo_factura'];
    $nombre_tipo_compra            = $info_cliente['nombre_tipo_compra'];
    $und_producto                  = $info_cliente['und_producto'];
    $cod_tipo_metodo_envio         = $info_cliente['cod_tipo_metodo_envio'];
    $nombre_tipo_cobro             = $info_cliente['nombre_tipo_cobro'];
    $iva_ptj                       = $info_cliente['iva_ptj'];
    $descuento_ptj                 = $info_cliente['descuento_ptj'];
    $total_iva_por_producto_venta  = ((($total_venta_producto - (($descuento_ptj/100)*$total_venta_producto))/(($iva_ptj/100)+(100/100)))*($iva_ptj/100));

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
    $contador_reg_prod_venta ++;
?>
    <tr>
        <td style="text-align:center"><a href="../admin/edit_factura_venta.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta; ?>"><img src="../imagenes/ver.png"></a></td>
        <td style="text-align:center"><?php echo $nombre_tipo_factura?></td>
        <td style="text-align:center"><?php echo $cod_factura?></td>
        <td style="text-align:left"><?php echo $cod_producto_barra?></td>
        <td style="text-align:left"><?php echo $nombre_producto?></td>
        <td style="text-align:left"><?php echo trim($nombre_propietario)?></td>
        <td style="text-align:center"><?php echo $und_venta?></td>
        <td style="text-align:center"><?php echo $cuenta?></td>
        <td style="text-align:center"><?php echo $fecha_ymd_venta_producto?></td>
        <td style="text-align:center"><?php echo $fecha_hora_venta_producto?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_pago?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
        <?php if ($cod_seguridad==1) { ?><td style="text-align:center"><?php echo $und_producto?></td><?php } ?>
        <td style="text-align:center"><?php echo $cod_info_factura_venta?></td>
    </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
<!--</div>-->
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php //include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>