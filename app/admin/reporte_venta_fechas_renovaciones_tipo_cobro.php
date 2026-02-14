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
    <a class="btn btn-primary" href="#"><h6>Reporte Renovaciones</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php if ($cod_estado_subreporte_ventasgenerales==1) { ?>
<table class="table table-striped">
<thead>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo Factura</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Factura</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Cod</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Concepto</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Cliente</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Unidades</th>
        <?php if ($cod_estado_prod_precio_compra== '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">P.Compra</th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">P.Venta</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Total Venta</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Fecha</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Forma Pago</th>
        <?php if ($cod_estado_ptj_comision_global == '1') { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">% Comision</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">$ Comision</th>
        <?php } ?>
        <?php if ($cod_estado_tipo_compra_global == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo Compra</th><?php } ?>
        <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;">Metodo Envio</th><?php } ?>
        <?php if ($cod_estado_tipo_cobro_aviso_alerta_renovacion_global==1) { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">Tipo Cobro</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">VENCE</th>
        <?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">IdKey</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">IdForeG</th>
    </tr>
</thead>
<tbody>
<?php
$total_total_venta_producto                      = 0;
$total_ganancia_venta_sum                        = 0;
$fecha_hoy                                       = date("Y-m-d");

$sql_cliente = "SELECT tbl15_venta_producto.cod_venta_producto, tbl15_venta_producto.cod_producto, tbl15_venta_producto.cod_producto_barra, 
tbl15_venta_producto.cod_info_factura_venta, tbl15_venta_producto.cod_factura, tbl15_venta_producto.cod_historia_clinica, tbl15_venta_producto.nombre_producto, 
tbl15_venta_producto.und_venta, tbl15_venta_producto.precio_compra_producto, tbl15_venta_producto.precio_costo_producto, tbl15_venta_producto.total_compra_producto, 
tbl15_venta_producto.precio_venta_producto, 
tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.nombre_tipo_producto, tbl15_venta_producto.nombre_tipo_unidad_medida, 
tbl15_venta_producto.nombre_tipo_presentacion, tbl15_venta_producto.nombre_via_administracion, tbl15_venta_producto.nombre_frec_duracion, 
tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.fecha_hora_venta_producto, tbl15_venta_producto.cod_administrador,
tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.identificacion_tercero, tbl15_tercero.direccion_tercero, 
tbl15_venta_producto.cuenta, tbl15_venta_producto.cod_tipo_cobrar, tbl15_venta_producto.comision_ptj, tbl15_venta_producto.cod_tipo_pago, 
tbl15_venta_producto.cod_tipo_forma_pago, tbl15_venta_producto.cod_dependencia, tbl15_venta_producto.nombre_tipo_factura, tbl15_venta_producto.und_producto, 
tbl15_venta_producto.nombre_tipo_compra, tbl15_venta_producto.cod_tipo_metodo_envio, tbl15_venta_producto.nombre_tipo_cobro, tbl15_venta_producto.fecha_cobro_renovacion
FROM tbl15_tercero RIGHT JOIN tbl15_venta_producto ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
WHERE (tbl15_venta_producto.nombre_tipo_cobro <> '') ORDER BY tbl15_venta_producto.fecha_ymd_venta_producto ASC";
$resultado_cliente = mysqli_query($conectar, $sql_cliente) or die(mysqli_error($conectar));
while ($info_cliente = mysqli_fetch_assoc($resultado_cliente)) {

    $cod_venta_producto                             = $info_cliente['cod_venta_producto'];
    $cod_producto                                   = $info_cliente['cod_producto'];
    $cod_producto_barra                             = $info_cliente['cod_producto_barra'];
    $cod_info_factura_venta                         = $info_cliente['cod_info_factura_venta'];
    $cod_factura                                    = $info_cliente['cod_factura'];
    $cod_historia_clinica                           = $info_cliente['cod_historia_clinica'];
    $nombre_producto                                = $info_cliente['nombre_producto'];
    $und_venta                                      = $info_cliente['und_venta'];
    $precio_compra_producto                         = $info_cliente['precio_compra_producto'];
    $precio_costo_producto                          = $info_cliente['precio_costo_producto'];
    $total_compra_producto                          = $info_cliente['total_compra_producto'];
    $precio_venta_producto                          = $info_cliente['precio_venta_producto'];
    $total_venta_producto                           = $info_cliente['total_venta_producto'];
    ///if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
    if ($cod_tipo_sistema_numeracion_und_venta == '2') { $und_venta = intval($und_venta); } else { $und_venta = $und_venta; }
    if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }
    if ($cod_tipo_sistema_numeracion_precio_venta == '2') { $precio_venta_producto = intval($precio_venta_producto); } else { $precio_venta_producto = $precio_venta_producto; }
    $nombre_tipo_producto                           = $info_cliente['nombre_tipo_producto'];
    $nombre_tipo_unidad_medida                      = $info_cliente['nombre_tipo_unidad_medida'];
    $nombre_tipo_presentacion                       = $info_cliente['nombre_tipo_presentacion'];
    $nombre_via_administracion                      = $info_cliente['nombre_via_administracion'];
    $nombre_frec_duracion                           = $info_cliente['nombre_frec_duracion'];
    $fecha_ymd_venta_producto                       = $info_cliente['fecha_ymd_venta_producto'];
    $fecha_hora_venta_producto                      = $info_cliente['fecha_hora_venta_producto'];
    //$cuenta                                         = $info_cliente['cuenta'];
    $cod_tipo_cobrar                                = $info_cliente['cod_tipo_cobrar'];
    $cod_administrador_db                           = $info_cliente['cod_administrador'];
    $nombre_propietario                             = $info_cliente['nombre1_tercero'].' '.$info_cliente['apellido1_tercero'];
    $comision_ptj                                   = $info_cliente['comision_ptj'];
    $cod_tipo_pago                                  = $info_cliente['cod_tipo_pago'];
    $cod_tipo_forma_pago                            = $info_cliente['cod_tipo_forma_pago'];
    $cod_dependencia                                = $info_cliente['cod_dependencia'];
    $nombre_tipo_factura                            = $info_cliente['nombre_tipo_factura'];
    $nombre_tipo_compra                             = $info_cliente['nombre_tipo_compra'];
    $und_producto                                   = $info_cliente['und_producto'];
    $cod_tipo_metodo_envio                          = $info_cliente['cod_tipo_metodo_envio'];
    $nombre_tipo_cobro                              = $info_cliente['nombre_tipo_cobro'];
    $fecha_cobro_renovacion                         = $info_cliente['fecha_cobro_renovacion'];


    if ($total_compra_producto == '0') { $total_compra_producto = 1; } else { $total_compra_producto = $info_cliente['total_compra_producto']; }
    if ($total_venta_producto == '0') { $total_venta_producto = 1; } else { $total_venta_producto = $info_cliente['total_venta_producto']; }

    $total_ganancia_venta          = ($total_venta_producto - $total_compra_producto);
    $total_comision                                 = ($total_venta_producto * ($comision_ptj/100));
    $total_ganancia_venta_sum                      += $total_ganancia_venta;

    $sql_administrador = "SELECT cuenta FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador_db'";
    $consulta_administrador = mysqli_query($conectar, $sql_administrador) or die(mysqli_error($conectar));
    $datos_administrador = mysqli_fetch_assoc($consulta_administrador);

    $cuenta                                         = $datos_administrador['cuenta'];

    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '$cod_tipo_pago'";
    $consulta_tipo_pago = mysqli_query($conectar, $sql_tipo_pago) or die(mysqli_error($conectar));
    $datos_tipo_pago = mysqli_fetch_assoc($consulta_tipo_pago);

    $nombre_tipo_pago                               = $datos_tipo_pago['nombre_tipo_pago'];

    $sql_forma_pago = "SELECT nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE cod_tipo_forma_pago = '$cod_tipo_forma_pago'";
    $consulta_forma_pago = mysqli_query($conectar, $sql_forma_pago) or die(mysqli_error($conectar));
    $datos_forma_pago = mysqli_fetch_assoc($consulta_forma_pago);

    $nombre_tipo_forma_pago                         = $datos_forma_pago['nombre_tipo_forma_pago'];

    $sql_dependencia = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE cod_dependencia = '$cod_dependencia'";
    $consulta_dependencia = mysqli_query($conectar, $sql_dependencia) or die(mysqli_error($conectar));
    $datos_dependencia = mysqli_fetch_assoc($consulta_dependencia);

    $nombre_dependencia                             = $datos_dependencia['nombre_dependencia'];


    $sql_tipo_metodo_envio = "SELECT nombre_tipo_metodo_envio FROM tbl15_tipo_metodo_envio WHERE cod_tipo_metodo_envio = '$cod_tipo_metodo_envio'";
    $consulta_tipo_metodo_envio = mysqli_query($conectar, $sql_tipo_metodo_envio) or die(mysqli_error($conectar));
    $datos_tipo_metodo_envio = mysqli_fetch_assoc($consulta_tipo_metodo_envio);

    $nombre_tipo_metodo_envio                       = $datos_tipo_metodo_envio['nombre_tipo_metodo_envio'];
    $total_total_venta_producto                    += $total_venta_producto;

    if ($cod_estado_calcular_ptjganancia_venta_ref_pcompra_pventa_global == '1') { $porcentaje_ganancia_venta = (($total_ganancia_venta / $total_compra_producto) * 100); } else { $porcentaje_ganancia_venta = (($total_ganancia_venta / $total_venta_producto) * 100); }
    
    $fecha_alerta_vence_vigencia                    = strtotime($fecha_cobro_renovacion) - strtotime($fecha_hoy);
    $dias_vence_vigencia                            = $fecha_alerta_vence_vigencia/(60*60*24);
    if ($dias_vence_vigencia < 0) { $titulo_alerta  = '<br>(VENCIO HACE '.abs($dias_vence_vigencia).' DIAS)'; } elseif ($dias_vence_vigencia > 0) { $titulo_alerta  = '<br>(FALTAN '.abs($dias_vence_vigencia).' DIAS)'; } else { $titulo_alerta  = '<br>(ES HOY)'; }
?>
    <tr>
        <td style="text-align:center"><?php echo $nombre_tipo_factura?></td>
        <td style="text-align:center"><?php echo $cod_factura?></td>
        <td style="text-align:left"><?php echo $cod_producto_barra?></td>
        <td style="text-align:left"><?php echo $nombre_producto?></td>
        <td style="text-align:left"><?php echo $nombre_propietario?></td>
        <td style="text-align:center"><?php echo $und_venta?></td>
        <?php if ($cod_estado_prod_precio_compra== '1') { ?>
        <td style="text-align:right"><p class="text-warning"><strong><?php echo number_format($precio_compra_producto, 0, ",", ".")?></strong></p></td>
        <?php } ?>
        <td style="text-align:right"><p class="text-info"><strong><?php echo number_format($precio_venta_producto, 0, ",", ".")?></strong></p></td>
        <td style="text-align:right"><p class="text-info"><strong><?php echo number_format($total_venta_producto, 0, ",", ".")?></strong></p></td>
        <td style="text-align:center"><?php echo $fecha_ymd_venta_producto?></td>
        <td style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
        <?php if ($cod_estado_ptj_comision_global == '1') { ?>
        <td style="text-align:center"><?php echo $comision_ptj.'%' ?></td>
        <td style="text-align:right"><?php echo number_format($total_comision, 0, ",", ".")?></td>
        <?php } ?>
        <?php if ($cod_estado_tipo_compra_global == '1') { ?><td style="text-align:center"><?php echo $nombre_tipo_compra?></td><?php } ?>
        <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?><td style="text-align:center"><?php echo $nombre_tipo_metodo_envio?></td><?php } ?>
        <?php if ($cod_estado_tipo_cobro_aviso_alerta_renovacion_global==1) { ?>
        <td style="text-align:center"><?php echo $nombre_tipo_cobro?></td>
        <td style="text-align:center"><?php echo $fecha_cobro_renovacion.' '.$titulo_alerta.''; ?></td>
        <?php } ?>
        <td style="text-align:center"><?php echo $cod_venta_producto?></td>
        <td style="text-align:center"><?php echo $cod_info_factura_venta?></td>
    </tr>
<?php } ?>
    <tr>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <?php if ($cod_estado_prod_precio_compra== '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;"></th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;">TOTAL</th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"><?php echo number_format($total_total_venta_producto, 0, ",", ".")?></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <?php if ($cod_estado_ptj_comision_global == '1') { ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <?php } ?>
        <?php if ($cod_seguridad==1) { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;"></th><?php } ?>
        <?php if ($cod_estado_tipo_compra_global == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;"></th><?php } ?>
        <?php if ($cod_estado_tipo_metodo_envio_global == '1') { ?><th style="text-align:center; background-color:#DBE0F3; color:#000;"></th><?php } ?>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
        <th style="text-align:center; background-color:#DBE0F3; color:#000;"></th>
    </tr>
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