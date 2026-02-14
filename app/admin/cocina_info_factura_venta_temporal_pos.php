<?php if ($total_datos <> 0) { ?>

<?php
$suma_temporal = "SELECT Sum(total_venta_producto) As total_venta, Sum(total_costo_producto) As total_compra FROM tbl15_venta_producto_temporal 
WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                 = $matriz_temporal['total_venta'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cod_info_factura_venta = '$cod_info_factura_venta')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

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
$cod_tipo_inventario         = $data_info_factura['cod_tipo_inventario'];
$observacion_tercero         = $data_info_factura['observacion_tercero'];
$cod_prioridad               = $data_info_factura['cod_prioridad'];

$cod_info_factura_strpad     = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);

$sql_user_vendedor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_user_vendedor = mysqli_query($conectar, $sql_user_vendedor);
$matriz_user_vendedor = mysqli_fetch_assoc($consulta_user_vendedor);

$nombres_vendedor            = $matriz_user_vendedor['nombres'].' '.$matriz_user_vendedor['apellidos'];

$sql_user_tercero = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_user_tercero = mysqli_query($conectar, $sql_user_tercero);
$matriz_user_tercero = mysqli_fetch_assoc($consulta_user_tercero);

$nombres_tercero             = $matriz_user_tercero['nombre1_tercero'].' '.$matriz_user_tercero['nombre2_tercero'].' '.$matriz_user_tercero['apellido1_tercero'].' '.$matriz_user_tercero['apellido2_tercero'];

$tab                         = 'tbl15_venta_producto_temporal';
$tipo                        = 'eliminar';
$campo                       = 'cod_venta_producto_temporal';

if ($cod_seguridad == '1') {
$condicion_inventario = 'cod_tipo_inventario = "1" OR cod_tipo_inventario = "2"';
} else {
$condicion_inventario = 'cod_tipo_inventario = "1"';
}
?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:center;"></td>
    <th style="text-align:center;">REGRESAR</th>
    <th style="text-align:center;">ID</th>
    <th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
    <th style="text-align:center;">PRIORIDAD</th>
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">FECHA</th>
    <th style="text-align:center;">ATENDIDO</th>
    <!--<th style="text-align:center;">TERCERO</th>-->
    <!--<th style="text-align:center;">TOTAL FACTURA</th>-->
    <td style="text-align:center;"></td>
  </tr>
  <tr>
    <td style="text-align:center;"></td>
    <td style="text-align:center;"><a href="../admin/lista_caja_virtual_cocina.php"><img src=../imagenes/btn_regresar.png alt="btn_regresar"></td>
    <td style="text-align:center;"><?php echo $cod_info_factura_venta ?></td>
    <td style="text-align:center;"><?php echo $cod_base_caja ?></td>
    <td style="text-align:center;"><?php echo $cod_prioridad ?></td>
    <td style="text-align:center;"><?php echo $nombres_vendedor ?></td>
    <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
    <td style="text-align:center;"><a href="../admin/entregar_servicio_comida_caja_virtual.php?cod_info_factura_venta=<?php echo $cod_info_factura_venta ?>&cod_caja_virtual=<?php echo $cod_caja_virtual ?>&pagina=<?php echo $pagina ?>"><img src=../imagenes/entregar_servicio_comida.png alt="entregar_servicio_comida"></td>
   <!--<td style="text-align:center;"><?php echo $nombres_tercero ?></td>-->
    <!--<td style="text-align:center; font-size:30;" id="total_venta"><?php echo number_format($total_venta, 0, ",", "."); ?></td>-->
    <td style="text-align:center;"></td>
  </tr>
</table>

<?php } else { } ?>