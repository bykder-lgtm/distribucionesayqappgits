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
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs">
<a class="btn btn-primary" href="#"><h6>Lista Facturas Compra Eliminadas</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];
$tab                         = 'tbl15_informe_condiciones_salud';
$tipo                        = 'eliminar';
$campo                       = 'cod_informe_condiciones_salud';
$fecha                       = date("Y/m/d");
$origen                      = 'PARACLINICOS';
?>
<br>
<table class="table table-striped">
    <tr>
        <th style="text-align:left"><a href="../admin/lista_info_factura_compra.php"><font size='+2'>Lista Facturas Compra Eliminadas</font></th>
    </tr>
</table>

<div class="table-responsive">
<div id="eliminar-ok" style="display:none;">&nbsp;</div>

<table class="table table-striped">
<thead>
<tr>
<!--<th style="text-align:center">Elm</th>-->
<?php if ($cod_estado_facturacion_compra == '1') { ?><th style="text-align:center">Ver</th><?php } ?>
<th style="text-align:center">Factura</th>
<th style="text-align:center">Proveedor</th>
<th style="text-align:center">Total</th>
<th style="text-align:center">Fecha</th>
<th style="text-align:center">Hora</th>
<th style="text-align:center">Tipo Cargue</th>
<th style="text-align:center">Origen</th>
<?php if ($cod_estado_inventario_bodega_global == '1') { ?><th style="text-align:center">Tipo Inventario</th><?php } ?>
<th style="text-align:center">ID</th>
<th style="text-align:center">FECHA ELIMINACION</th>
<th style="text-align:center">USUARIO ELIMINACION</th>
</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_info_factura_compra_copia ORDER BY cod_info_factura_compra DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {
    
$cod_info_factura_compra               = $info_info_factura['cod_info_factura_compra'];
$cod_factura                           = $info_info_factura['cod_factura'];
$nombre_empresa                        = $info_info_factura['nombre_empresa'];
$razonsocial_empresa                   = $info_info_factura['razonsocial_empresa'];
$cuenta                                = $info_info_factura['cuenta'];
$cod_estado_factura                    = $info_info_factura['cod_estado_factura'];
$fecha_anyo                            = $info_info_factura['fecha_anyo'];
$fecha_hora                            = $info_info_factura['fecha_hora'];
$cod_administrador                     = $info_info_factura['cod_administrador'];
$nombre_tipo_producto                  = $info_info_factura['nombre_tipo_producto'];
$total_factura_compra_retefuente       = $info_info_factura['total_factura_compra_retefuente'];
$cod_tipo_forma_pago                   = $info_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_factura                   = $info_info_factura['nombre_tipo_factura'];
$cod_tercero                           = $info_info_factura['cod_tercero'];
$cod_tipo_inventario                   = $info_info_factura['cod_tipo_inventario'];
$nombre_tipo_cargue_factura            = $info_info_factura['nombre_tipo_cargue_factura'];
$cod_tipo_origen_factura_compra        = $info_info_factura['cod_tipo_origen_factura_compra'];
$fecha_elim                            = $info_info_factura['fecha_elim'];
$usuario_elim                          = $info_info_factura['usuario_elim'];

$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$nombre_cliente                        = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                            = $matriz_cliente['identificacion_tercero'];
$direccion_cli                         = $matriz_cliente['direccion_tercero'];

$obtener_cliente = "SELECT * FROM tbl15_tipo_inventario WHERE (cod_tipo_inventario = '$cod_tipo_inventario')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$nombre_tipo_inventario                = $matriz_cliente['nombre_tipo_inventario'];

$obtener_tipo_origen_factura_compra = "SELECT * FROM tbl15_tipo_origen_factura_compra WHERE (cod_tipo_origen_factura_compra = '$cod_tipo_origen_factura_compra')";
$resultado_tipo_origen_factura_compra = mysqli_query($conectar, $obtener_tipo_origen_factura_compra) or die(mysqli_error($conectar));
$matriz_tipo_origen_factura_compra = mysqli_fetch_assoc($resultado_tipo_origen_factura_compra);

$nombre_tipo_origen_factura_compra     = $matriz_tipo_origen_factura_compra['nombre_tipo_origen_factura_compra'];
?>
<tr id="<?php echo $cod_info_factura_compra;?>">
<?php if ($cod_estado_facturacion_compra == '1') { ?><td style="text-align:center"><a href="../admin/ver_factura_compra_eliminada.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></td><?php } ?>
<td style="text-align:center"><?php echo $cod_factura?></td>
<td style="text-align:left"><?php echo $nombre_cliente?></td>
<td style="text-align:right"><?php echo number_format($total_factura_compra_retefuente, 0, ",", ".") ?></td>
<td style="text-align:center"><?php echo $fecha_anyo?></td>
<td style="text-align:center"><?php echo $fecha_hora?></td>
<td style="text-align:center"><?php echo $nombre_tipo_cargue_factura?></td>
<?php if ($cod_estado_inventario_bodega_global == '1') { ?><td style="text-align:center"><?php echo $nombre_tipo_inventario?></td><?php } ?>
<td style="text-align:center"><?php echo $nombre_tipo_origen_factura_compra?></td>
<td style="text-align:center"><?php echo $cod_info_factura_compra?></td>
<td style="text-align:center"><?php echo $fecha_elim?></td>
<td style="text-align:center"><?php echo $usuario_elim?></td>
</tr id="<?php echo $cod_info_factura_compra;?>">
<?php } ?>
</tbody>
</table>
</div>
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>

</div>
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
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>