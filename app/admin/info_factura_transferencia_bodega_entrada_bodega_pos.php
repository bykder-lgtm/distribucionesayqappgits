<?php if ($total_datos <> 0) { ?>

<?php
$suma_temporal = "SELECT Sum(total_venta_producto) As total_venta, Sum(total_compra_producto) As total_compra FROM tbl15_transferencia_bodega_entrada_producto 
WHERE (cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                                         = $matriz_temporal['total_venta'];
$total_compra                                        = $matriz_temporal['total_compra'];

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
$cod_info_factura_strpad                            = str_pad($cod_info_factura_transferencia_bodega_entrada, 6, "0", STR_PAD_LEFT);

$sql_user_vendedor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_user_vendedor = mysqli_query($conectar, $sql_user_vendedor);
$matriz_user_vendedor = mysqli_fetch_assoc($consulta_user_vendedor);

$nombres_vendedor                                   = $matriz_user_vendedor['nombres'].' '.$matriz_user_vendedor['apellidos'];

$sql_user_tecero = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_user_tecero = mysqli_query($conectar, $sql_user_tecero);
$matriz_user_tecero = mysqli_fetch_assoc($consulta_user_tecero);

$nombres_tecero                                     = $matriz_user_tecero['nombre1_tercero'];
?>
<script language="javascript">
$(document).ready(function(){
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_factura_transferencia_bodega_entrada";
            $.post("guardar_info_factura_transferencia_bodega_entrada_temporal_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_transferencia_bodega_entrada; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_moneda").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_moneda";
            var tipo_ajax = "tbl15_info_factura_transferencia_bodega_entrada";
            $.post("guardar_info_factura_transferencia_bodega_entrada_temporal_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_transferencia_bodega_entrada; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_factura").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_factura";
            var tipo_ajax = "tbl15_info_factura_transferencia_bodega_entrada";
            $.post("guardar_info_factura_transferencia_bodega_entrada_temporal_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_transferencia_bodega_entrada; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_forma_pago";
            var tipo_ajax = "tbl15_info_factura_transferencia_bodega_entrada";
            $.post("guardar_info_factura_transferencia_bodega_entrada_temporal_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_transferencia_bodega_entrada; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_inventario").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_inventario";
            var tipo_ajax = "tbl15_info_factura_transferencia_bodega_entrada";
            $.post("guardar_info_factura_transferencia_bodega_entrada_temporal_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_transferencia_bodega_entrada; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_pago";
            var tipo_ajax = "tbl15_info_factura_transferencia_bodega_entrada";
            $.post("guardar_info_factura_transferencia_bodega_entrada_temporal_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_transferencia_bodega_entrada; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_administrador").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_administrador";
            var tipo_ajax = "tbl15_info_factura_transferencia_bodega_entrada";
            $.post("guardar_info_factura_transferencia_bodega_entrada_temporal_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_transferencia_bodega_entrada; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tercero").on('change', function () {
        $("#cod_tercero option:selected").each(function () {
            var valor = $(this).val();
            var campo = "cod_tercero";
            var tipo_ajax = "tbl15_info_factura_transferencia_bodega_entrada";
            $.post("guardar_info_factura_transferencia_bodega_entrada_temporal_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_transferencia_bodega_entrada; ?> }, function(data){
                $("#cod_cliente").html(data);
            });     
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_producto_consumo").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_producto_consumo";
            var tipo_ajax = "tbl15_info_factura_transferencia_bodega_entrada";
            $.post("guardar_info_factura_transferencia_bodega_entrada_temporal_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_transferencia_bodega_entrada; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_transferencia_bodega_entrada_producto";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_transferencia_bodega_entrada_temporal_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#error_identificacion_repetida").html(data);
        });
   });
});
</script>

<form method="post" name="formulario" action="../admin/transferencia_bodega_entrada_producto_reg.php">
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:center;"></td>
    <th style="text-align:center;">ID</th>
    <th style="text-align:center;">FECHA - HORA</th>
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">TERCERO</th>
    <th style="text-align:center;">TOTAL FACTURA (P.COMPRA)</th>
    <th style="text-align:center;">TOTAL FACTURA (P.VENTA)</th>
    <td style="text-align:center;"></td>
  </tr>
  <tr>
    <td style="text-align:center;"></td>
    <td style="text-align:center;"><?php echo $cod_info_factura_transferencia_bodega_entrada ?></td>
    <td style="text-align:center;"><?php echo $fecha_anyo.' '.$fecha_hora ?></td>
    <td style="text-align:center;"><?php echo $nombres_vendedor ?></td>
    <td style="text-align:center;"><?php echo $nombre_empresa ?></td>
    <td style="text-align:center; font-size:30;" id="total_compra"><?php echo number_format($total_compra, 0, ",", "."); ?></td>
    <td style="text-align:center; font-size:30;" id="total_venta"><?php echo number_format($total_venta, 0, ",", "."); ?></td>
    <td style="text-align:center;"></td>

<?php 
$sql_temporal = "SELECT cod_transferencia_bodega_entrada_producto FROM tbl15_transferencia_bodega_entrada_producto WHERE (cod_info_factura_transferencia_bodega_entrada = '$cod_info_factura_transferencia_bodega_entrada')";
$consulta_temporal = mysqli_query($conectar, $sql_temporal);
$total_datos = mysqli_num_rows($consulta_temporal);
while ($datos_temporal = mysqli_fetch_assoc($consulta_temporal)) { ?>
<input type="hidden" name="cod_transferencia_bodega_entrada_producto[]" value="<?php echo $datos_temporal['cod_transferencia_bodega_entrada_producto']; ?>" size="4">
<?php } ?>

<?php $pagina ='facturacion_transferencia_temporal_producto_manual_pos.php'; ?>
<input type="hidden" name="cod_info_factura_transferencia_bodega_entrada" value="<?php echo $cod_info_factura_transferencia_bodega_entrada ?>" size="10">
<input type="hidden" name="total_datos" value="<?php echo $total_datos; ?>" size="4">
<input type="hidden" name="pagina" value="<?php echo $pagina_local?>" size="15">
<input type="hidden" name="flete" value="0" size="15">
<input type="hidden" name="verificacion_envio" value="1" size="15">
<input type="hidden" name="cod_estado_vacuna" value="0" size="15">
  </tr>
</table>
</form>

<?php } else { } ?>