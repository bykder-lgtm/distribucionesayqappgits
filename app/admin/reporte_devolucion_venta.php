<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
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
<a class="btn btn-primary" href="#"><h6>Devoluciones en Venta</h6></a>
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina                      = $_SERVER['PHP_SELF'];

if ($cod_seguridad == '1') { $filtro_vendedor = ''; } else { $filtro_vendedor = "AND (vendedor = '$cuenta_actual')"; }

if (isset($_GET['fecha_devolucion_ini'])) {
$fecha_devolucion_ini                           = addslashes($_GET['fecha_devolucion_ini']);
$fecha_devolucion_fin                           = addslashes($_GET['fecha_devolucion_fin']);
}
?>
<br>
<div class="table-responsive">

<form action="" id="" method="GET">

<table class="table table-striped" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:right;">FECHA INI: </td>
    <td style="text-align:left;"><input class="input-block-level" name="fecha_devolucion_ini" type="date" value="<?php echo $fecha_devolucion_ini ?>" required/></td>
  </tr>
  <tr>
    <td style="text-align:right;">FECHA FIN: </td>
    <td style="text-align:left;"><input class="input-block-level" name="fecha_devolucion_fin" type="date" value="<?php echo $fecha_devolucion_fin ?>" required/></td>
  </tr>
  <tr>
    <td style="text-align:right;"></td>
    <td style="text-align:left;"><button type="submit">Ver Registros</button></td>
  </tr>
</table>
</form>

<?php if (isset($_GET['fecha_devolucion_ini'])) { ?>
<table class="table table-striped">
<thead>
  <tr>
    <th style="text-align:center">IDINFO</th>
    <th style="text-align:center">FACTURA</th>
    <th style="text-align:center">CLIENTE</th>
    <th style="text-align:center">CODIGO</th>
    <th style="text-align:center">PRODUCTO</th>
    <th style="text-align:center">UND VENDIDAS ANTES DE DEVOLUCIÓN</th>
    <th style="text-align:center">UND DEVUELTAS</th>
    <th style="text-align:center">UND VENDIDAS DESPUES DE DEVOLUCIÓN</th>
    <th style="text-align:center">COMENTARIO</th>
    <th style="text-align:center">PRECIO COMPRA</th>
    <th style="text-align:center">PRECIO VENTA</th>
    <th style="text-align:center">FECHA VENTA</th>
    <th style="text-align:center">VENDEDOR</th>
    <th style="text-align:center">FECHA DEVOLUCIÓN</th>
    <th style="text-align:center">DEVOLUCIÓN</th>
    <th style="text-align:center">ID</th>
  </tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_operacion WHERE (fecha_devolucion BETWEEN '$fecha_devolucion_ini' AND '$fecha_devolucion_fin') AND (origen_operacion = 'ventas') $filtro_vendedor ORDER BY cod_operacion DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {

$cod_operacion                          = $info_info_factura['cod_operacion'];
$cod_venta_producto                     = $info_info_factura['cod_venta_producto'];
$cod_producto_barra                     = $info_info_factura['cod_producto_barra'];
$nombre_producto                        = $info_info_factura['nombre_producto'];
$cod_factura                            = $info_info_factura['cod_factura'];
$und_nuevas                             = $info_info_factura['und_nuevas'];
$und_inventario                         = $info_info_factura['und_inventario'];
$unidades_faltantes                     = $info_info_factura['unidades_faltantes'];
$unidades_vendidas                      = $info_info_factura['unidades_vendidas'];
$und_vend_orig                          = $info_info_factura['und_vend_orig'];
$devoluciones                           = $info_info_factura['devoluciones'];
$precio_compra_producto                 = $info_info_factura['precio_compra_producto'];
$precio_venta_producto                  = $info_info_factura['precio_venta_producto'];
$comentario                             = $info_info_factura['comentario'];
$fecha_devolucion                       = $info_info_factura['fecha_devolucion'];
$hora_devolucion                        = $info_info_factura['hora_devolucion'];
$fecha_orig                             = $info_info_factura['fecha_orig'];
$vendedor                               = $info_info_factura['vendedor'];
$cuenta                                 = $info_info_factura['cuenta'];
$cod_administrador                      = $info_info_factura['cod_administrador'];
$cod_tercero                            = $info_info_factura['cod_tercero'];
$cod_info_factura_venta                 = $info_info_factura['cod_info_factura_venta'];

$sql_tercero = "SELECT nombre1_tercero FROM tbl15_tercero WHERE cod_tercero  = '$cod_tercero'";
$consulta_tercero = mysqli_query($conectar, $sql_tercero) or die(mysqli_error($conectar));
$matriz_tercero = mysqli_fetch_assoc($consulta_tercero);

$nombre1_tercero                        = $matriz_tercero['nombre1_tercero'];
?>
  <tr>
    <td style="text-align:center"><?php echo $cod_info_factura_venta?></td>
    <td style="text-align:center"><?php echo $cod_factura?></td>
    <td style="text-align:left"><?php echo $nombre1_tercero?></td>
    <td style="text-align:left"><?php echo $cod_producto_barra?></td>
    <td style="text-align:left"><?php echo $nombre_producto?></td>
    <td style="text-align:center"><?php echo $und_vend_orig?></td>
    <td style="text-align:center"><?php echo $devoluciones?></td>
    <td style="text-align:center"><?php echo $unidades_vendidas?></td>
    <td style="text-align:left"><?php echo $comentario?></td>
    <td style="text-align:right"><?php echo number_format($precio_compra_producto, 0, ",", ".") ?></td>
    <td style="text-align:right"><?php echo number_format($precio_venta_producto, 0, ",", ".") ?></td>
    <td style="text-align:center"><?php echo $fecha_orig.' | '.$hora_devolucion?></td>
    <td style="text-align:center"><?php echo $vendedor?></td>
    <td style="text-align:center"><?php echo $fecha_devolucion.' | '.$hora_devolucion ?></td>
    <td style="text-align:center"><?php echo $cuenta?></td>
    <td style="text-align:center"><?php echo $cod_operacion?></td>
  </tr>
<?php } ?>
</tbody>
</table>
<?php } ?>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>