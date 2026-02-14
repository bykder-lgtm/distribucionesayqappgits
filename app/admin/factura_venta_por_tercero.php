<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<!--<div class="container">-->
<div class="divPanel page-content">
<!--
<div class="breadcrumbs">
<a href="../admin/menu_lista.php"><h4>Lista de Area a Laborar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
<a href="../admin/reg_grupo_area.php">Registrar Area a Laborar</h4></a>
</div>
-->
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                            = $_SERVER['PHP_SELF'];
$pagina_local                      = $_SERVER['PHP_SELF'];
$cod_tercero                       = intval($_GET['cod_tercero']);
$origen                            = 'PARACLINICOS';

$incre                             = 0;
$tab                               = 'tbl15_venta_producto';
$campo                             = 'cod_venta_producto';
$tipo                              = 'eliminar';
$tab2                              = 'tbl15_venta_producto_eliminar_sin_devolucion';
?>

<div class="table-responsive">
<!-- ***************************************************************************************************************************** -->
<script src="../js/jquery-3.2.1.min.js"></script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_tercero = '$cod_tercero') ORDER BY cod_info_factura_venta DESC";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
while ($data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura)) {

$cod_info_factura_venta      = $data_info_factura['cod_info_factura_venta'];
$cod_factura                 = $data_info_factura['cod_factura'];
$cod_tercero                 = $data_info_factura['cod_tercero'];
$cod_historia_clinica        = $data_info_factura['cod_historia_clinica'];
$fecha_ini                   = $data_info_factura['fecha_ini'];
$fecha_fin                   = $data_info_factura['fecha_fin'];
$cod_empresa                 = $data_info_factura['cod_empresa'];
$nombre_empresa              = $data_info_factura['nombre_empresa'];
$razonsocial_empresa         = $data_info_factura['razonsocial_empresa'];
$total_motivo                = $data_info_factura['total_motivo'];
$total_muestra               = $data_info_factura['total_muestra'];
$fecha_ymdhis                = $data_info_factura['fecha_ymdhis'];
$cuenta                      = $data_info_factura['cuenta'];
$cod_estado_factura          = $data_info_factura['cod_estado_factura'];
$cod_base_caja               = $data_info_factura['cod_base_caja'];
$descuento_ptj               = $data_info_factura['descuento_ptj'];
$iva_ptj                     = $data_info_factura['iva_ptj'];
$flete_ptj                   = $data_info_factura['flete_ptj'];
$cod_cliente                 = $data_info_factura['cod_cliente'];
$vlr_cancelado               = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                  = $data_info_factura['vlr_vuelto'];
$fecha_dia                   = $data_info_factura['fecha_dia'];
$fecha_mes                   = $data_info_factura['fecha_mes'];
$fecha_anyo                  = $data_info_factura['fecha_anyo'];
$anyo                        = $data_info_factura['anyo'];
$fecha_hora                  = $data_info_factura['fecha_hora'];
$fecha_remision              = $data_info_factura['fecha_remision'];
$nombre_ccosto               = $data_info_factura['nombre_ccosto'];
$garantia_meses              = $data_info_factura['garantia_meses'];
$observacion                 = $data_info_factura['observacion'];
$cod_tipo_pago               = $data_info_factura['cod_tipo_pago'];
$cod_administrador           = $data_info_factura['cod_administrador'];
$nombre_tipo_producto        = $data_info_factura['nombre_tipo_producto'];
$total_precio_compra         = $data_info_factura['total_precio_compra'];
$total_precio_venta          = $data_info_factura['total_precio_venta'];
$cod_dependencia             = $data_info_factura['cod_dependencia'];
$servicio                    = $data_info_factura['servicio'];
$cod_tipo_forma_pago         = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago      = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura         = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda          = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja             = $data_info_factura['cod_cierre_caja'];
$fecha_creacion              = $data_info_factura['fecha_creacion'];
$fecha_modificacion          = $data_info_factura['fecha_modificacion'];
$nombre_maquina              = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar             = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna           = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion  = $data_info_factura['cod_resolucion_facturacion'];
$cod_cufe                    = $data_info_factura['cod_cufe'];
$observacion_tercero         = $data_info_factura['observacion_tercero'];
?>
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:center;"></td>
    <th style="text-align:center;">ID</th>
    <th style="text-align:center;">FECHA</th>
    <th style="text-align:center;">TIPO FACTURA</th>
    <th style="text-align:center;">FACTURA</th>
   <?php if ($nombre_tipo_factura == 'ELECTRONICA') { ?><th style="text-align:center;">CUFE</th><?php } ?>
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">MONEDA</th>
    <th style="text-align:center;">TIPO FACTURA</th>
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO PAGO</th>
    <th style="text-align:center;">CLIENTE</th>
    <?php if ($cod_estado_observacion_tercero_venta_global == '1') { ?><th style="text-align:center;">OBSERVACION</th><?php } ?>
    <th style="text-align:center;">TOTAL FACTURA</th>
    <td style="text-align:center;"></td>
  </tr>
  <tr>
   <td style="text-align:center;"></td>
   <td style="text-align:center;"><?php echo $cod_info_factura_venta ?></td>
   <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
   <td style="text-align:center;"><?php echo $nombre_tipo_factura ?></td>
   <td style="text-align:center;"><?php echo $cod_factura;?></td>
   <?php if ($nombre_tipo_factura == 'ELECTRONICA') { ?>   <td style="text-align:center;"><?php echo $cod_cufe;?></td>   <?php } ?>
    <td style="text-align:center;"><?php echo $cod_administrador;?></td>
    <td style="text-align:center;"><?php echo $nombre_tipo_moneda;?></td>
    <td style="text-align:center;"><?php echo $nombre_tipo_factura;?></td>
    <td style="text-align:center;"><?php echo $cod_tipo_forma_pago;?></td>
    <td style="text-align:center;"><?php echo $cod_tipo_pago;?></td>
    <td style="text-align:center;"><?php echo $cod_tercero;?></td>
    <?php if ($cod_estado_observacion_tercero_venta_global == '1') { ?><td style="text-align:center;"><?php echo $observacion_tercero ?></td><?php } ?>
    <td style="text-align:center; font-size:30;" id="total_venta"><?php echo number_format($total_precio_venta, 0, ",", "."); ?></td>
    <td style="text-align:center;"></td>
  </tr>
</table>
<!-- ***************************************************************************************************************************** -->
<table class="table table-striped" border="1" cellspacing="0" cellpadding="0">
<thead>
<tr>
<th style="text-align:center;"></th>
<th style="text-align:center;">CODIGO</th>
<th style="text-align:center;">NOMBRE CONCEPTO</th>
<th style="text-align:center;">CANTIDAD</th>
<?php if ($cod_estado_comentario_venta_global == '1') { ?><th style="text-align:center;">COMENTARIO</th><?php } ?>
<th style="text-align:center;">T.P</th>
<th style="text-align:center;">VALOR UNITARIO</th>
<th style="text-align:center;">VALOR TOTAL</th>
<th style="text-align:center;"></th>
</tr>
</thead>
<tbody>
<?php
$sql_venta_producto = "SELECT * FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
$consulta_venta_producto = mysqli_query($conectar, $sql_venta_producto);
while ($datos_venta_producto = mysqli_fetch_assoc($consulta_venta_producto)) {
  	 	 	 	 	 	
$cod_venta_producto                = $datos_venta_producto['cod_venta_producto'];
$cod_producto                      = $datos_venta_producto['cod_producto'];
$cod_producto_barra                = $datos_venta_producto['cod_producto_barra'];
$nombre_producto                   = $datos_venta_producto['nombre_producto'];
$cedula                            = $datos_venta_producto['cedula'];
$nombre_cliente                    = $datos_venta_producto['nombre_cliente'];
$und_venta                         = $datos_venta_producto['und_venta'];
$precio_costo_producto             = $datos_venta_producto['precio_costo_producto'];
$total_costo_producto              = $datos_venta_producto['total_costo_producto'];
$precio_venta_producto             = $datos_venta_producto['precio_venta_producto'];
$total_venta_producto              = $datos_venta_producto['total_venta_producto'];
$nombre_tipo_producto              = $datos_venta_producto['nombre_tipo_producto'];
$nombre_tipo_unidad_medida         = $datos_venta_producto['nombre_tipo_unidad_medida'];
$posologia_cantidad                = $datos_venta_producto['posologia_cantidad'];
$posologia_peso                    = $datos_venta_producto['posologia_peso'];
$nombre_tipo_presentacion          = $datos_venta_producto['nombre_tipo_presentacion'];
$nombre_via_administracion         = $datos_venta_producto['nombre_via_administracion'];
$nombre_frec_duracion              = $datos_venta_producto['nombre_frec_duracion'];
$cod_tipo_cobrar                   = $datos_venta_producto['cod_tipo_cobrar'];
$cod_info_factura_venta            = $datos_venta_producto['cod_info_factura_venta'];
$nombre_tipo_precio_venta          = $datos_venta_producto['nombre_tipo_precio_venta'];
$comentario_producto               = $datos_venta_producto['comentario_producto'];

$incre++;
?>
<tr style="text-align:center;" id="tr<?php echo $cod_venta_producto;?>">
<td style="text-align:center;"></td>
<td style="text-align:center;" id="cod_producto_barra_<?php echo $incre;?>"><?php echo $cod_producto_barra ?></td>
<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_producto ?></td>
<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $und_venta ?></td>
<?php if ($cod_estado_comentario_venta_global == '1') { ?><td style="text-align:center;"><?php echo $comentario_producto;?></td><?php } ?>
<td style="text-align:left;"  id="nombre_producto_<?php echo $incre;?>"><?php echo $nombre_tipo_precio_venta ?></td>
<td style="text-align:right;" id="precio_venta_producto_<?php echo $incre;?>"><?php echo number_format($precio_venta_producto, 0, ",", "."); ?></td>
<td style="text-align:right;" id="total_venta_producto_<?php echo $incre;?>"><?php echo number_format($total_venta_producto, 0, ",", ".");?></td>
</tr style="text-align:right;" id="tr<?php echo $cod_venta_producto;?>">
<?php } ?>
</tbody>
</table>
<hr><hr><hr>
<?php } ?>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
<!--</div>-->
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>