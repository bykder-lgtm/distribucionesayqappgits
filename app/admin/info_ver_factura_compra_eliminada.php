<?php if ($total_datos <> 0) { ?>

<?php
$suma_temporal = "SELECT Sum(total_compra_producto) As total_compra FROM tbl15_factura_compra_producto_copia WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_compra                = $matriz_temporal['total_compra'];

$datos_data_info_factura = "SELECT tbl15_info_factura_compra_copia.cod_factura, tbl15_info_factura_compra_copia.cod_tercero, tbl15_info_factura_compra_copia.cod_caja_virtual, tbl15_info_factura_compra_copia.nombre_estado_factura, 
tbl15_info_factura_compra_copia.nombre_tipo_cargue_factura, tbl15_info_factura_compra_copia.nombre_tipo_compra, tbl15_info_factura_compra_copia.cod_empresa, tbl15_info_factura_compra_copia.nombre_empresa, 
tbl15_info_factura_compra_copia.razonsocial_empresa, tbl15_info_factura_compra_copia.total_muestra, tbl15_info_factura_compra_copia.fecha_ymdhis, tbl15_info_factura_compra_copia.cuenta, 
tbl15_info_factura_compra_copia.cod_estado_factura, tbl15_info_factura_compra_copia.cod_base_caja, tbl15_info_factura_compra_copia.descuento_ptj, tbl15_info_factura_compra_copia.iva_ptj, 
tbl15_info_factura_compra_copia.flete_ptj, tbl15_info_factura_compra_copia.subtotal, tbl15_info_factura_compra_copia.valor_iva, tbl15_info_factura_compra_copia.cod_cliente, 
tbl15_info_factura_compra_copia.vlr_cancelado, tbl15_info_factura_compra_copia.vlr_vuelto, tbl15_info_factura_compra_copia.fecha_dia, tbl15_info_factura_compra_copia.fecha_mes, 
tbl15_info_factura_compra_copia.fecha_anyo, tbl15_info_factura_compra_copia.anyo, tbl15_info_factura_compra_copia.fecha_hora, tbl15_info_factura_compra_copia.fecha_remision, 
tbl15_info_factura_compra_copia.nombre_ccosto, tbl15_info_factura_compra_copia.garantia_meses, tbl15_info_factura_compra_copia.observacion, tbl15_info_factura_compra_copia.cod_tipo_pago, 
tbl15_info_factura_compra_copia.cod_administrador, tbl15_info_factura_compra_copia.nombre_tipo_producto, tbl15_info_factura_compra_copia.total_precio_costo, tbl15_info_factura_compra_copia.total_precio_compra, 
tbl15_info_factura_compra_copia.total_precio_venta, tbl15_info_factura_compra_copia.cod_dependencia, tbl15_info_factura_compra_copia.servicio, tbl15_info_factura_compra_copia.cod_tipo_forma_pago, 
tbl15_info_factura_compra_copia.descripcion_tipo_forma_pago, tbl15_info_factura_compra_copia.nombre_tipo_factura, 
tbl15_info_factura_compra_copia.nombre_tipo_moneda, tbl15_info_factura_compra_copia.cod_cierre_caja, tbl15_info_factura_compra_copia.fecha_creacion, tbl15_info_factura_compra_copia.fecha_modificacion, 
tbl15_info_factura_compra_copia.nombre_maquina, tbl15_info_factura_compra_copia.cod_tipo_cobrar, tbl15_info_factura_compra_copia.cod_estado_vacuna, tbl15_info_factura_compra_copia.cod_resolucion_facturacion, 
tbl15_info_factura_compra_copia.total_datos_data, tbl15_info_factura_compra_copia.tiempo_ejecucion, tbl15_info_factura_compra_copia.ipc_ptj, tbl15_info_factura_compra_copia.precio_ipc, 
tbl15_info_factura_compra_copia.precio_ipc_total, tbl15_info_factura_compra_copia.ret_ica_ptj, tbl15_info_factura_compra_copia.total_ret_ica, tbl15_info_factura_compra_copia.iva_teorico_ptj, 
tbl15_info_factura_compra_copia.total_iva_teorico, tbl15_info_factura_compra_copia.tarifa_rete_vigente_ptj, tbl15_info_factura_compra_copia.total_tarifa_rete_vigente, 
tbl15_info_factura_compra_copia.rete_iva_asumido_ptj, tbl15_info_factura_compra_copia.total_rete_iva_asumido, tbl15_info_factura_compra_copia.iva_19, tbl15_info_factura_compra_copia.iva_5, 
tbl15_info_factura_compra_copia.nombre_rete_fuente_ptj, tbl15_info_factura_compra_copia.total_compra_imp, tbl15_info_factura_compra_copia.total_precio_ipc, tbl15_info_factura_compra_copia.total_descuento, 
tbl15_info_factura_compra_copia.total_rete_fuente, tbl15_info_factura_compra_copia.total_factura_compra_retefuente, tbl15_info_factura_compra_copia.total_factura_compra, 
tbl15_info_factura_compra_copia.cod_doc_soporte, tbl15_info_factura_compra_copia.total_inv_precio_costo, tbl15_info_factura_compra_copia.total_inv_precio_compra, 
tbl15_info_factura_compra_copia.total_inv_precio_venta, tbl15_info_factura_compra_copia.total_compra_precio_costo, tbl15_info_factura_compra_copia.total_compra_precio_compra, 
tbl15_info_factura_compra_copia.total_compra_precio_venta, tbl15_info_factura_compra_copia.total_inv_compra_desp_factura, tbl15_info_factura_compra_copia.cod_estado, 
tbl15_info_factura_compra_copia.subtotal_total_precio_compra, tbl15_info_factura_compra_copia.subtotal_total_precio_costo, 
tbl15_tercero.nombre1_tercero, tbl15_tipo_pago.nombre_tipo_pago, tbl15_tipo_forma_pago.nombre_tipo_forma_pago, 
tbl15_info_factura_compra_copia.cod_tipo_inventario, tbl15_info_factura_compra_copia.cod_tipo_producto_consumo, tbl15_info_factura_compra_copia.fecha_entrega
FROM tbl15_tipo_pago RIGHT JOIN (tbl15_tipo_forma_pago RIGHT JOIN (tbl15_tercero RIGHT JOIN tbl15_info_factura_compra_copia ON tbl15_tercero.cod_tercero = tbl15_info_factura_compra_copia.cod_tercero) 
ON tbl15_tipo_forma_pago.cod_tipo_forma_pago = tbl15_info_factura_compra_copia.cod_tipo_forma_pago) ON tbl15_tipo_pago.cod_tipo_pago = tbl15_info_factura_compra_copia.cod_tipo_pago
WHERE (tbl15_info_factura_compra_copia.cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_factura                              = $data_info_factura['cod_factura'];
$cod_tercero                              = $data_info_factura['cod_tercero'];
$cod_caja_virtual                         = $data_info_factura['cod_caja_virtual'];
$nombre_estado_factura                    = $data_info_factura['nombre_estado_factura'];
$nombre_tipo_cargue_factura               = $data_info_factura['nombre_tipo_cargue_factura'];
$nombre_tipo_compra                       = $data_info_factura['nombre_tipo_compra'];
$cod_empresa                              = $data_info_factura['cod_empresa'];
$nombre_empresa                           = $data_info_factura['nombre_empresa'];
$razonsocial_empresa                      = $data_info_factura['razonsocial_empresa'];
$total_muestra                            = $data_info_factura['total_muestra'];
$fecha_ymdhis                             = $data_info_factura['fecha_ymdhis'];
$cuenta                                   = $data_info_factura['cuenta'];
$cod_estado_factura                       = $data_info_factura['cod_estado_factura'];
$cod_base_caja                            = $data_info_factura['cod_base_caja'];
$descuento_ptj                            = $data_info_factura['descuento_ptj'];
$iva_ptj                                  = $data_info_factura['iva_ptj'];
$flete_ptj                                = $data_info_factura['flete_ptj'];
$subtotal                                 = $data_info_factura['subtotal'];
$valor_iva                                = $data_info_factura['valor_iva'];
$cod_cliente                              = $data_info_factura['cod_cliente'];
$vlr_cancelado                            = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                               = $data_info_factura['vlr_vuelto'];
$fecha_dia                                = $data_info_factura['fecha_dia'];
$fecha_mes                                = $data_info_factura['fecha_mes'];
$fecha_anyo                               = $data_info_factura['fecha_anyo'];
$anyo                                     = $data_info_factura['anyo'];
$fecha_hora                               = $data_info_factura['fecha_hora'];
$fecha_remision                           = $data_info_factura['fecha_remision'];
$nombre_ccosto                            = $data_info_factura['nombre_ccosto'];
$garantia_meses                           = $data_info_factura['garantia_meses'];
$observacion                              = $data_info_factura['observacion'];
$cod_tipo_pago                            = $data_info_factura['cod_tipo_pago'];
$cod_administrador                        = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                     = $data_info_factura['nombre_tipo_producto'];
$total_precio_costo                       = $data_info_factura['total_precio_costo'];
$total_precio_compra                      = $data_info_factura['total_precio_compra'];
$total_precio_venta                       = $data_info_factura['total_precio_venta'];
$cod_dependencia                          = $data_info_factura['cod_dependencia'];
$servicio                                 = $data_info_factura['servicio'];
$cod_tipo_forma_pago                      = $data_info_factura['cod_tipo_forma_pago'];
$descripcion_tipo_forma_pago              = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura                      = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda                       = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja                          = $data_info_factura['cod_cierre_caja'];
$fecha_creacion                           = $data_info_factura['fecha_creacion'];
$fecha_modificacion                       = $data_info_factura['fecha_modificacion'];
$nombre_maquina                           = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar                          = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna                        = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion               = $data_info_factura['cod_resolucion_facturacion'];
$total_datos_data                         = $data_info_factura['total_datos_data'];
$tiempo_ejecucion                         = $data_info_factura['tiempo_ejecucion'];
$ipc_ptj                                  = $data_info_factura['ipc_ptj'];
$precio_ipc                               = $data_info_factura['precio_ipc'];
$precio_ipc_total                         = $data_info_factura['precio_ipc_total'];
$ret_ica_ptj                              = $data_info_factura['ret_ica_ptj'];
$total_ret_ica                            = $data_info_factura['total_ret_ica'];
$iva_teorico_ptj                          = $data_info_factura['iva_teorico_ptj'];
$total_iva_teorico                        = $data_info_factura['total_iva_teorico'];
$tarifa_rete_vigente_ptj                  = $data_info_factura['tarifa_rete_vigente_ptj'];
$total_tarifa_rete_vigente                = $data_info_factura['total_tarifa_rete_vigente'];
$rete_iva_asumido_ptj                     = $data_info_factura['rete_iva_asumido_ptj'];
$total_rete_iva_asumido                   = $data_info_factura['total_rete_iva_asumido'];
$iva_19                                   = $data_info_factura['iva_19'];
$iva_5                                    = $data_info_factura['iva_5'];
$nombre_rete_fuente_ptj                   = $data_info_factura['nombre_rete_fuente_ptj'];
$total_compra_imp                         = $data_info_factura['total_compra_imp'];
$total_precio_ipc                         = $data_info_factura['total_precio_ipc'];
$total_descuento                          = $data_info_factura['total_descuento'];
$total_rete_fuente                        = $data_info_factura['total_rete_fuente'];
$total_factura_compra_retefuente          = $data_info_factura['total_factura_compra_retefuente'];
$total_factura_compra                     = $data_info_factura['total_factura_compra'];
$cod_doc_soporte                          = $data_info_factura['cod_doc_soporte'];
$total_inv_precio_costo                   = $data_info_factura['total_inv_precio_costo'];
$total_inv_precio_compra                  = $data_info_factura['total_inv_precio_compra'];
$total_inv_precio_venta                   = $data_info_factura['total_inv_precio_venta'];
$total_compra_precio_costo                = $data_info_factura['total_compra_precio_costo'];
$total_compra_precio_compra               = $data_info_factura['total_compra_precio_compra'];
$total_compra_precio_venta                = $data_info_factura['total_compra_precio_venta'];
$total_inv_compra_desp_factura            = $data_info_factura['total_inv_compra_desp_factura'];
$cod_estado                               = $data_info_factura['cod_estado'];
$subtotal_total_precio_compra             = $data_info_factura['subtotal_total_precio_compra'];
$subtotal_total_precio_costo              = $data_info_factura['subtotal_total_precio_costo'];
$nombre1_tercero                          = $data_info_factura['nombre1_tercero'];
$nombre_tipo_pago                         = $data_info_factura['nombre_tipo_pago'];
$nombre_tipo_forma_pago                   = $data_info_factura['nombre_tipo_forma_pago'];
$cod_tipo_inventario                      = $data_info_factura['cod_tipo_inventario'];
$cod_tipo_producto_consumo                = $data_info_factura['cod_tipo_producto_consumo'];
$fecha_entrega                            = $data_info_factura['fecha_entrega'];

$suma_temporal = "SELECT nombre_tipo_inventario FROM tbl15_tipo_inventario WHERE (cod_tipo_inventario = '$cod_tipo_inventario')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$nombre_tipo_inventario                  = $matriz_temporal['nombre_tipo_inventario'];

$suma_temporal_consumo = "SELECT nombre_tipo_producto_consumo FROM tbl15_tipo_producto_consumo WHERE (cod_tipo_producto_consumo = '$cod_tipo_producto_consumo')";
$consulta_temporal_consumo = mysqli_query($conectar, $suma_temporal_consumo);
$matriz_temporal_consumo = mysqli_fetch_assoc($consulta_temporal_consumo);

$nombre_tipo_producto_consumo            = $matriz_temporal_consumo['nombre_tipo_producto_consumo'];

$sql_info_factura_compra_copia = "SELECT url_img_orig_producto, url_img_min_producto FROM tbl15_info_factura_compra_copia WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_info_factura_compra_copia = mysqli_query($conectar, $sql_info_factura_compra_copia);
$matriz_info_factura_compra_copia = mysqli_fetch_assoc($consulta_info_factura_compra_copia);

$url_img_orig_producto                   = $matriz_info_factura_compra_copia['url_img_orig_producto'];
$url_img_min_producto                    = $matriz_info_factura_compra_copia['url_img_min_producto'];

$tab                                     = 'tbl15_info_factura_compra';
$tipo                                    = 'eliminar';
$campo                                   = 'cod_info_factura_compra';

$mostrar_cuentas_pagar = "SELECT * FROM tbl15_cuentas_pagar WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_cuentas_pagar = mysqli_query($conectar, $mostrar_cuentas_pagar) or die(mysqli_error($conectar));
$existe_cuenta_pagar = mysqli_num_rows($consulta_cuentas_pagar);

if (($cod_tipo_pago == '2') || ($existe_cuenta_pagar <> '0')) { $pagina_redirec_elim = '../admin/eliminar_compra_credito.php'; } else { $pagina_redirec_elim = '../admin/eliminar_compra.php'; }
?>
<script language="javascript">
$(document).ready(function(){
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#fecha_entrega").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_entrega";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#observacion").on('change', function () {
            var valor = $(this).val();
            var campo = "observacion";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_forma_pago";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_cargue_factura").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_cargue_factura";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>


<script language="javascript">
$(document).ready(function(){
    $("#cod_factura").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_factura";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>


<script language="javascript">
$(document).ready(function(){
    $("#nombre_rete_fuente_ptj").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_rete_fuente_ptj";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#ret_ica_ptj").on('change', function () {
            var valor = $(this).val();
            var campo = "ret_ica_ptj";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#total_compra").on('change', function () {
            var valor = $(this).val();
            var campo = "total_compra";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#subtotal").on('change', function () {
            var valor = $(this).val();
            var campo = "subtotal";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>


<script language="javascript">
$(document).ready(function(){
    $("#valor_iva").on('change', function () {
            var valor = $(this).val();
            var campo = "valor_iva";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#total_descuento").on('change', function () {
            var valor = $(this).val();
            var campo = "total_descuento";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#total_precio_ipc").on('change', function () {
            var valor = $(this).val();
            var campo = "total_precio_ipc";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#total_compra_imp").on('change', function () {
            var valor = $(this).val();
            var campo = "total_compra_imp";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>


<script language="javascript">
$(document).ready(function(){
    $("#total_rete_fuente").on('change', function () {
            var valor = $(this).val();
            var campo = "total_rete_fuente";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#total_ret_ica").on('change', function () {
            var valor = $(this).val();
            var campo = "total_ret_ica";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#total_factura_compra_retefuente").on('change', function () {
            var valor = $(this).val();
            var campo = "total_factura_compra_retefuente";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#cod_cliente").html(data);
            });     
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
            var tipo_ajax = "tbl15_factura_compra_producto";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_y_factura_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;"></th>
    <th style="text-align:center;">ID</th>
    <th style="text-align:center;">FECHA COMPRA</th>

    <?php if ($cod_estado_fecha_entrega_factura_compra == '1') { ?>
    <th style="text-align:center;">FECHA ENTREGA</th>
    <?php } ?>

    <?php if ($cod_estado_observacion_factura_compra == '1') { ?>
    <th style="text-align:center;">OBSERVACION</th>
    <?php } ?>

    <?php if ($cod_estado_producto_consumo_global == '1') { ?>
    <th style="text-align:center;">TIPO CONSUMIBLE</th>
    <?php } ?>
    <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
    <th style="text-align:center;">TIPO INVENTARIO</th>
    <?php } ?>
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO PAGO</th>
    <th style="text-align:center;">PROVEEDOR</th>
    <th style="text-align:center;">FACTURA</th>
    <th style="text-align:center;">%RETE FUENTE</th>
    <th style="text-align:center;">%RETE ICA</th>
    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <th style="text-align:center;"></th>
    <th style="text-align:center;"><?php echo $cod_info_factura_compra ?></th>
    <td style="text-align:center;"><?php echo $fecha_anyo ?></td>

    <?php if ($cod_estado_fecha_entrega_factura_compra == '1') { ?>
    <td style="text-align:center;"><?php echo $fecha_entrega ?></td>
    <?php } ?>

    <?php if ($cod_estado_observacion_factura_compra == '1') { ?>
    <td style="text-align:center;"><?php echo $observacion ?></td>
    <?php } ?>

    <?php if ($cod_estado_producto_consumo_global == '1') { ?>
    <td style="text-align:center;"><?php echo $nombre_tipo_producto_consumo ?></td>
    <?php } ?>
    <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
    <td style="text-align:center;"><?php echo $nombre_tipo_inventario ?></td>
    <?php } ?>
    <td style="text-align:center;"><?php echo $nombre_tipo_forma_pago ?></td>
    <td style="text-align:center;"><?php echo $nombre_tipo_pago ?></td>
    <td style="text-align:center;"><?php echo $nombre1_tercero ?></td>
    <td style="text-align:center;"><?php echo $cod_factura ?></td>
    <td style="text-align:center;"><?php echo $nombre_rete_fuente_ptj ?></td>
    <td style="text-align:center;"><?php echo $ret_ica_ptj ?></td>
    <th style="text-align:center;"></th>
  </tr>
</table>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;"></th>
<?php if ($cod_estado_observacion_factura_compra_global == '1') { ?>
    <th style="text-align:center;">OBSERVACION</th>
<?php } ?>
    <th style="text-align:center;">VENDEDOR</th>
    <th style="text-align:center;">SUBTOTAL</th>
    <th style="text-align:center;">TOTAL IVA</th>
    <th style="text-align:center;">DESCUENTO</th>
    <th style="text-align:center;">IMPOCONSUMO</th>
    <th style="text-align:center;">TOTAL COMPRA + IVA</th>
    <th style="text-align:center;">TOTAL RETEFUENTE</th>
    <th style="text-align:center;">TOTAL RETEICA</th>
    <th style="text-align:center;">TOTAL COMPRA</th>
    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <td style="text-align:center;"></td>
<?php if ($cod_estado_observacion_factura_compra_global == '1') { ?>
    <td style="text-align:center;"><?php echo $observacion ?></td>
<?php } ?>
    <td style="text-align:center;"><?php echo $cuenta ?></td>
    <td style="text-align:center;"><?php echo number_format($subtotal, 0, ",", ".") ?></td>
    <td style="text-align:center;"><?php echo number_format($valor_iva, 0, ",", ".") ?></td>
    <td style="text-align:center;"><?php echo number_format($total_descuento, 0, ",", ".") ?></td>
    <td style="text-align:center;"><?php echo number_format($total_precio_ipc, 0, ",", ".") ?></td>
    <td style="text-align:center;"><?php echo number_format($total_compra_imp, 0, ",", ".") ?></td>
    <td style="text-align:center;"><?php echo number_format($total_rete_fuente, 0, ",", ".") ?></td>
    <td style="text-align:center;"><?php echo number_format($total_ret_ica, 0, ",", ".") ?></td>
    <td style="text-align:center;"><?php echo number_format($total_factura_compra_retefuente, 0, ",", ".") ?></td>
    <td style="text-align:center;"></td>
  </tr>
</table>
<?php } else { } ?>