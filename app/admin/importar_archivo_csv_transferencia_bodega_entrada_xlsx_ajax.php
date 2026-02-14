<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
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
<a href="../admin/lista_info_factura_trasnferencia_bodega.php"><h4>Cargar Archivo Plano Transferencia Entrada&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$pagina = $_SERVER['PHP_SELF'];
?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="table-responsive">
<form name="formulario_insersion" enctype="multipart/form-data" accept-charset="utf-8" action="../admin/importar_archivo_xlsx_transferencia_bodega_entrada_ajax_reg.php" id="formulario_subir_archio_csv" method="POST">
<table border="0" class="table table-responsive">
  <thead>
    <tr>
      <th>Selecionar archivo: 
        <select name="nombre_tipo_formato_archivo_plano" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;" required>
          <?php if (isset($nombre_tipo_formato_archivo_plano)) { echo ""; } else { echo ""; }
          $consulta2_sql = ("SELECT cod_tipo_formato_archivo_plano, nombre_tipo_formato_archivo_plano 
          FROM tbl15_tipo_formato_archivo_plano WHERE (cod_estado = '1') ORDER BY cod_tipo_formato_archivo_plano ASC");
          $consulta2 = mysqli_query($conectar, $consulta2_sql);
          while ($datos2 = mysqli_fetch_assoc($consulta2)) {
          if(isset($nombre_tipo_formato_archivo_plano) and $nombre_tipo_formato_archivo_plano == $datos2['nombre_tipo_formato_archivo_plano']) {
          $seleccionado = "selected"; } else { $seleccionado = ""; }
          $codigo = $datos2['nombre_tipo_formato_archivo_plano'];
          $nombre = $datos2['nombre_tipo_formato_archivo_plano'];
          echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <input type="file" name="csv" id="csv" accept=".csv,.xls,.xlsx" required><input type="submit" value="Cargar Archivo" name="import" id="btn_subir_archico" class="btn btn-info pull-center" title="Cargar Archivo" /></th>
    </tr>
  </thead>
</table>
</form>
</div>

<table class="table table-striped">
<thead>
<tr>
<!--<th style="text-align:center">Elm</th>-->
<?php if ($cod_seguridad==1) { ?>
<!--<th style="text-align:center">Edit</th>-->
<?php } ?>
<th style="text-align:center">Ver</th>
<th style="text-align:center">Factura</th>
<th style="text-align:center">Tipo Inventario</th>
<!--<th style="text-align:center">Total</th>-->
<th style="text-align:center">Fecha</th>
<th style="text-align:center">Hora</th>
<th style="text-align:center">Tipo Pago</th>
<th style="text-align:center">Forma Pago</th>
<th style="text-align:center">Tipo</th>
</tr>
</thead>
<tbody>
<?php
$sql_info_factura = "SELECT * FROM tbl15_info_factura_transferencia_bodega_entrada WHERE (nombre_estado_factura = 'CERRADA') ORDER BY cod_info_factura_transferencia_bodega_entrada DESC";
$resultado_info_factura = mysqli_query($conectar, $sql_info_factura) or die(mysqli_error($conectar));
while ($info_info_factura = mysqli_fetch_assoc($resultado_info_factura)) {
    
$cod_info_factura_transferencia_bodega_entrada      = $info_info_factura['cod_info_factura_transferencia_bodega_entrada'];
$cod_factura                                        = $info_info_factura['cod_factura'];
$nombre_empresa                                     = $info_info_factura['nombre_empresa'];
$razonsocial_empresa                                = $info_info_factura['razonsocial_empresa'];
$cuenta                                             = $info_info_factura['cuenta'];
$cod_estado_factura                                 = $info_info_factura['cod_estado_factura'];
$fecha_anyo                                         = $info_info_factura['fecha_anyo'];
$fecha_hora                                         = $info_info_factura['fecha_hora'];
$cod_administrador                                  = $info_info_factura['cod_administrador'];
$nombre_tipo_producto                               = $info_info_factura['nombre_tipo_producto'];
$total_precio_venta                                 = $info_info_factura['total_precio_venta'];
$cod_tipo_forma_pago                                = $info_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_factura                                = $info_info_factura['nombre_tipo_factura'];
$cod_tercero                                        = $info_info_factura['cod_tercero'];
$cod_tipo_pago                                      = $info_info_factura['cod_tipo_pago'];
$cod_tipo_inventario                                = $info_info_factura['cod_tipo_inventario'];
$nombre_empresa                                     = $info_info_factura['nombre_empresa'];

$obtener_tipo_inventario = "SELECT * FROM tbl15_tipo_inventario WHERE (cod_tipo_inventario = '$cod_tipo_inventario')";
$resultado_tipo_inventario = mysqli_query($conectar, $obtener_tipo_inventario) or die(mysqli_error($conectar));
$matriz_tipo_inventario = mysqli_fetch_assoc($resultado_tipo_inventario);

$nombre_tipo_inventario                    = $matriz_tipo_inventario['nombre_tipo_inventario'];

$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$nombre_cliente                      = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
$direccion_cli                       = $matriz_cliente['direccion_tercero'];

$obtener_tipo_pago = "SELECT * FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
$resultado_tipo_pago = mysqli_query($conectar, $obtener_tipo_pago) or die(mysqli_error($conectar));
$matriz_tipo_pago = mysqli_fetch_assoc($resultado_tipo_pago);

$nombre_tipo_pago                    = $matriz_tipo_pago['nombre_tipo_pago'];

$obtener_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$resultado_forma_pago = mysqli_query($conectar, $obtener_forma_pago) or die(mysqli_error($conectar));
$matriz_forma_pago = mysqli_fetch_assoc($resultado_forma_pago);

$nombre_tipo_forma_pago              = $matriz_forma_pago['nombre_tipo_forma_pago'];
?>
<tr id="<?php echo $cod_info_factura_transferencia_bodega_entrada;?>">
<?php if ($cod_seguridad==1) { ?>
<!--<td id="edit<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><a href="../admin/edit_factura_venta.php?cod_info_factura_transferencia_bodega_entrada=<?php echo $cod_info_factura_transferencia_bodega_entrada ?>"><img src="../imagenes/editar.png" class="img-polaroid" alt=""></a></td>-->
<?php } ?>
<td style="text-align:center"><a href="../admin/facturacion_transferencia_bodega_entrada_producto_manual_pos.php?cod_info_factura_transferencia_bodega_entrada=<?php echo $cod_info_factura_transferencia_bodega_entrada ?>"><img src="../imagenes/ver.png" class="img-polaroid" alt=""></a></td>
<!--<td class="service_list" id="cod_info_factura_transferencia_bodega_entrada<?php echo $cod_info_factura_transferencia_bodega_entrada ?>" data="<?php echo $cod_info_factura_transferencia_bodega_entrada ?>"><a class="eliminar" id="cod_info_factura_transferencia_bodega_entrada<?php echo $cod_info_factura_transferencia_bodega_entrada ?>"><img src="../imagenes/eliminar_grand.png" class="img-polaroid" alt=""></a></td>-->
<td style="text-align:center" id="cod_factura<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><?php echo $cod_factura?></td>
<td style="text-align:left" id="nombre_empresa<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:left"><?php echo $nombre_empresa?></td>
<!--<td style="text-align:right" id="nombre_empresa<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:left"><?php echo number_format($total_precio_venta, 0, ",", ".") ?></td>-->
<td style="text-align:center" id="fecha_anyo<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><?php echo $fecha_anyo?></td>
<td style="text-align:center" id="fecha_hora<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><?php echo $fecha_hora?></td>
<td style="text-align:center" id="fecha_anyo<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><?php echo $nombre_tipo_pago?></td>
<td style="text-align:center" id="nombre_tipo_producto<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><?php echo $nombre_tipo_forma_pago?></td>
<td style="text-align:center" id="nombre_tipo_producto<?php echo $cod_info_factura_transferencia_bodega_entrada;?>" style="text-align:center"><?php echo $nombre_tipo_factura?></td>
</tr id="<?php echo $cod_info_factura_transferencia_bodega_entrada;?>">
<?php } ?>
</tbody>
</table>
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