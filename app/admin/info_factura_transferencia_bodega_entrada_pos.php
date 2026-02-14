<?php if ($total_datos <> 0) { ?>

<?php
$suma_temporal = "SELECT Sum(total_venta_producto) As total_venta, Sum(total_compra_producto) As total_compra FROM tbl15_transferencia_bodega_entrada_producto_temporal 
WHERE (cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                                        = $matriz_temporal['total_venta'];
$total_compra                                       = $matriz_temporal['total_compra'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_transferencia_bodega_entrada WHERE (cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_transferencia_bodega_entrada      = $data_info_factura['cod_info_factura_transferencia_bodega_entrada'];
$cod_factura                                        = $data_info_factura['cod_factura'];
$cod_tercero                                        = $data_info_factura['cod_tercero'];
$cod_empresa                                        = $data_info_factura['cod_empresa'];
$nombre_empresa                                     = $data_info_factura['nombre_empresa'];
$razonsocial_empresa                                = $data_info_factura['razonsocial_empresa'];
$total_muestra                                      = $data_info_factura['total_muestra'];
$fecha_ymdhis                                       = $data_info_factura['fecha_ymdhis'];
$cuenta                                             = $data_info_factura['cuenta'];
$cod_estado_factura                                 = $data_info_factura['cod_estado_factura'];
$cod_base_caja                                      = $data_info_factura['cod_base_caja'];
$descuento_ptj                                      = $data_info_factura['descuento_ptj'];
$iva_ptj                                            = $data_info_factura['iva_ptj'];
$flete_ptj                                          = $data_info_factura['flete_ptj'];
$cod_cliente                                        = $data_info_factura['cod_cliente'];
$vlr_cancelado                                      = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                                         = $data_info_factura['vlr_vuelto'];
$fecha_dia                                          = $data_info_factura['fecha_dia'];
$fecha_mes                                          = $data_info_factura['fecha_mes'];
$fecha_anyo                                         = $data_info_factura['fecha_anyo'];
$anyo                                               = $data_info_factura['anyo'];
$fecha_hora                                         = $data_info_factura['fecha_hora'];
$fecha_remision                                     = $data_info_factura['fecha_remision'];
$nombre_ccosto                                      = $data_info_factura['nombre_ccosto'];
$garantia_meses                                     = $data_info_factura['garantia_meses'];
$observacion                                        = $data_info_factura['observacion'];
$cod_tipo_pago                                      = $data_info_factura['cod_tipo_pago'];
$cod_administrador                                  = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                               = $data_info_factura['nombre_tipo_producto'];
$total_precio_compra                                = $data_info_factura['total_precio_compra'];
$total_precio_venta                                 = $data_info_factura['total_precio_venta'];
$cod_dependencia                                    = $data_info_factura['cod_dependencia'];
$servicio                                           = $data_info_factura['servicio'];
$cod_tipo_forma_pago                                = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago                             = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago                        = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura                                = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda                                 = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja                                    = $data_info_factura['cod_cierre_caja'];
$fecha_creacion                                     = $data_info_factura['fecha_creacion'];
$fecha_modificacion                                 = $data_info_factura['fecha_modificacion'];
$nombre_maquina                                     = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar                                    = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna                                  = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion                         = $data_info_factura['cod_resolucion_facturacion'];
$cod_tipo_inventario                                = $data_info_factura['cod_tipo_inventario'];
$cod_tipo_producto_consumo                          = $data_info_factura['cod_tipo_producto_consumo'];
$cod_empresa_transferencia_directa                  = $data_info_factura['cod_empresa_transferencia_directa'];

$cod_info_factura_strpad                            = str_pad($cod_info_factura_transferencia_bodega_entrada, 6, "0", STR_PAD_LEFT);
$cod_sino                                           = 1;

$sql_user_vendedor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_user_vendedor = mysqli_query($conectar, $sql_user_vendedor);
$matriz_user_vendedor = mysqli_fetch_assoc($consulta_user_vendedor);

$nombres_vendedor                                   = $matriz_user_vendedor['nombres'].' '.$matriz_user_vendedor['apellidos'];

$sql_empresa_transferencia_directa = "SELECT nombre_empresa_transferencia_directa FROM tbl15_empresa_transferencia_directa WHERE (cod_empresa_transferencia_directa = '$cod_empresa_transferencia_directa')";
$consulta_empresa_transferencia_directa = mysqli_query($conectar, $sql_empresa_transferencia_directa) or die(mysqli_error($conectar));
$datos_empresa_transferencia_directa = mysqli_fetch_assoc($consulta_empresa_transferencia_directa);

$nombre_empresa_transferencia_directa               = $datos_empresa_transferencia_directa['nombre_empresa_transferencia_directa'];
?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<form method="post" name="formulario" action="../admin/transferencia_bodega_entrada_producto_reg.php">
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:center;"></td>
    <th style="text-align:center;">ID</th>
    <th style="text-align:center;">FECHA</th>
    <th style="text-align:center;">INGRESAR A FACTURA DE COMPRA</th>
    <th style="text-align:center;">DE</th>
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">TERCERO</th>
    <th style="text-align:center;">TOTAL FACTURA (P.COMPRA)</th>
    <th style="text-align:center;">TOTAL FACTURA (P.VENTA)</th>
    <th style="text-align:center;">GUARDAR</th>
    <td style="text-align:center;"></td>
  </tr>
  <tr>
    <td style="text-align:center;"></td>
   <td style="text-align:center;"><?php echo $cod_info_factura_transferencia_bodega_entrada ?></td>

<?php if ($cod_seguridad==1) { ?>
   <td style="text-align:center;"><input name="fecha_anyo" id="fecha_anyo" type="date" value="<?php echo $fecha_anyo ?>" style="width: 105px;" required/></td>
<?php } else { ?>
   <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
   <input name="fecha_anyo" id="fecha_anyo" type="hidden" value="<?php echo $fecha_anyo ?>" required/>
<?php } ?>

    <td style="text-align:center;">
        <select name="cod_sino" id="cod_sino" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;" required>
            <?php if (isset($cod_sino)) { echo ""; } else { echo ""; }
            $consulta2_sql = "SELECT cod_sino, nombre_sino FROM tbl15_sino ORDER BY cod_sino ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_sino) AND $cod_sino == $datos2['cod_sino']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_sino'];
            $nombre = $datos2['nombre_sino'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <?php if ($cod_estado_empresa_transferencia_directa_global == '1') { ?>
   <td style="text-align:center;"><?php echo $nombre_empresa_transferencia_directa ?></td>
    <?php } ?>
<!--
   <td style="text-align:center;"><?php echo $nombre_tipo_moneda ?></td>
   <td style="text-align:center;"><?php echo $nombre_tipo_factura ?></td>

    <input name="nombre_tipo_moneda" id="nombre_tipo_moneda" type="hidden" value="COP" style="width: 110px;" required/>
    <input name="nombre_tipo_factura" id="nombre_tipo_factura" type="hidden" value="POS" style="width: 110px;" required/>
-->

    <td style="text-align:center;">
        <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" required>
            <?php if (isset($cod_administrador)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT cod_administrador, cuenta FROM tbl15_administrador ORDER BY cod_administrador ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_administrador) AND $cod_administrador == $datos2['cod_administrador']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_administrador'];
            $nombre = $datos2['cuenta'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:left;">
        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
            <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>";
            } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
            FROM tbl15_tercero WHERE (nombre_tipo_tercero='CLIENTE') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center; font-size:30;" id="total_compra"><br><br><?php echo number_format($total_compra, 0, ",", "."); ?></td>
    <td style="text-align:center; font-size:30;" id="total_venta"><br><br><?php echo number_format($total_venta, 0, ",", "."); ?></td>

    <td style="text-align:center;"><input type="image" src="../imagenes/guardar.png" tabindex=3 name="vender" value="Guardar" /></td>
    <td style="text-align:center;"></td>

<?php 
$sql_temporal = "SELECT cod_transferencia_bodega_entrada_producto_temporal FROM tbl15_transferencia_bodega_entrada_producto_temporal WHERE (cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada')";
$consulta_temporal = mysqli_query($conectar, $sql_temporal);
$total_datos = mysqli_num_rows($consulta_temporal);
while ($datos_temporal = mysqli_fetch_assoc($consulta_temporal)) { ?>
<input type="hidden" name="cod_transferencia_bodega_entrada_producto_temporal[]" value="<?php echo $datos_temporal['cod_transferencia_bodega_entrada_producto_temporal']; ?>" size="4">
<?php } ?>

<?php $pagina ='facturacion_transferencia_temporal_producto_manual_pos.php'; ?>
<input type="hidden" name="cod_info_factura_transferencia_bodega_entrada" value="<?php echo $cod_info_factura_transferencia_bodega_entrada ?>" size="10">
<input type="hidden" name="total_datos" value="<?php echo $total_datos; ?>" size="4">
<input type="hidden" name="pagina" value="<?php echo $pagina_local?>" size="15">
<input type="hidden" name="flete" value="0" size="15">
<input type="hidden" name="cod_tipo_origen_factura_compra" value="4" size="15">

<input type="hidden" name="verificacion_envio" value="1" size="15">
<input type="hidden" name="cod_estado_vacuna" value="0" size="15">
  </tr>
</table>
</form>

<?php } else { } ?>