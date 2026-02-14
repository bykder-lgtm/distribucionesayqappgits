<?php if ($total_datos <> 0) { ?>

<?php
$suma_temporal = "SELECT Sum(total_compra_producto) As total_compra FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_compra                = $matriz_temporal['total_compra'];

$datos_data_info_factura = "SELECT tbl15_info_factura_compra.cod_factura, tbl15_info_factura_compra.cod_tercero, tbl15_info_factura_compra.cod_caja_virtual, tbl15_info_factura_compra.nombre_estado_factura, 
tbl15_info_factura_compra.nombre_tipo_cargue_factura, tbl15_info_factura_compra.nombre_tipo_compra, tbl15_info_factura_compra.cod_empresa, tbl15_info_factura_compra.nombre_empresa, 
tbl15_info_factura_compra.razonsocial_empresa, tbl15_info_factura_compra.total_muestra, tbl15_info_factura_compra.fecha_ymdhis, tbl15_info_factura_compra.cuenta, 
tbl15_info_factura_compra.cod_estado_factura, tbl15_info_factura_compra.cod_base_caja, tbl15_info_factura_compra.descuento_ptj, tbl15_info_factura_compra.iva_ptj, 
tbl15_info_factura_compra.flete_ptj, tbl15_info_factura_compra.subtotal, tbl15_info_factura_compra.valor_iva, tbl15_info_factura_compra.cod_cliente, 
tbl15_info_factura_compra.vlr_cancelado, tbl15_info_factura_compra.vlr_vuelto, tbl15_info_factura_compra.fecha_dia, tbl15_info_factura_compra.fecha_mes, 
tbl15_info_factura_compra.fecha_anyo, tbl15_info_factura_compra.anyo, tbl15_info_factura_compra.fecha_hora, tbl15_info_factura_compra.fecha_remision, 
tbl15_info_factura_compra.nombre_ccosto, tbl15_info_factura_compra.garantia_meses, tbl15_info_factura_compra.observacion, tbl15_info_factura_compra.cod_tipo_pago, 
tbl15_info_factura_compra.cod_administrador, tbl15_info_factura_compra.nombre_tipo_producto, tbl15_info_factura_compra.total_precio_costo, tbl15_info_factura_compra.total_precio_compra, 
tbl15_info_factura_compra.total_precio_venta, tbl15_info_factura_compra.cod_dependencia, tbl15_info_factura_compra.servicio, tbl15_info_factura_compra.cod_tipo_forma_pago, 
tbl15_info_factura_compra.descripcion_tipo_forma_pago, tbl15_info_factura_compra.nombre_tipo_factura, 
tbl15_info_factura_compra.nombre_tipo_moneda, tbl15_info_factura_compra.cod_cierre_caja, tbl15_info_factura_compra.fecha_creacion, tbl15_info_factura_compra.fecha_modificacion, 
tbl15_info_factura_compra.nombre_maquina, tbl15_info_factura_compra.cod_tipo_cobrar, tbl15_info_factura_compra.cod_estado_vacuna, tbl15_info_factura_compra.cod_resolucion_facturacion, 
tbl15_info_factura_compra.total_datos_data, tbl15_info_factura_compra.tiempo_ejecucion, tbl15_info_factura_compra.ipc_ptj, tbl15_info_factura_compra.precio_ipc, 
tbl15_info_factura_compra.precio_ipc_total, tbl15_info_factura_compra.ret_ica_ptj, tbl15_info_factura_compra.total_ret_ica, tbl15_info_factura_compra.iva_teorico_ptj, 
tbl15_info_factura_compra.total_iva_teorico, tbl15_info_factura_compra.tarifa_rete_vigente_ptj, tbl15_info_factura_compra.total_tarifa_rete_vigente, 
tbl15_info_factura_compra.rete_iva_asumido_ptj, tbl15_info_factura_compra.total_rete_iva_asumido, tbl15_info_factura_compra.iva_19, tbl15_info_factura_compra.iva_5, 
tbl15_info_factura_compra.nombre_rete_fuente_ptj, tbl15_info_factura_compra.total_compra_imp, tbl15_info_factura_compra.total_precio_ipc, tbl15_info_factura_compra.total_descuento, 
tbl15_info_factura_compra.total_rete_fuente, tbl15_info_factura_compra.total_factura_compra_retefuente, tbl15_info_factura_compra.total_factura_compra, 
tbl15_info_factura_compra.cod_doc_soporte, tbl15_info_factura_compra.total_inv_precio_costo, tbl15_info_factura_compra.total_inv_precio_compra, 
tbl15_info_factura_compra.total_inv_precio_venta, tbl15_info_factura_compra.total_compra_precio_costo, tbl15_info_factura_compra.total_compra_precio_compra, 
tbl15_info_factura_compra.total_compra_precio_venta, tbl15_info_factura_compra.total_inv_compra_desp_factura, tbl15_info_factura_compra.cod_estado, 
tbl15_info_factura_compra.subtotal_total_precio_compra, tbl15_info_factura_compra.subtotal_total_precio_costo, 
tbl15_tercero.nombre1_tercero, tbl15_tipo_pago.nombre_tipo_pago, tbl15_tipo_forma_pago.nombre_tipo_forma_pago, 
tbl15_info_factura_compra.cod_tipo_inventario, tbl15_info_factura_compra.cod_tipo_producto_consumo, tbl15_info_factura_compra.fecha_entrega
FROM tbl15_tipo_pago RIGHT JOIN (tbl15_tipo_forma_pago RIGHT JOIN (tbl15_tercero RIGHT JOIN tbl15_info_factura_compra ON tbl15_tercero.cod_tercero = tbl15_info_factura_compra.cod_tercero) 
ON tbl15_tipo_forma_pago.cod_tipo_forma_pago = tbl15_info_factura_compra.cod_tipo_forma_pago) ON tbl15_tipo_pago.cod_tipo_pago = tbl15_info_factura_compra.cod_tipo_pago
WHERE (tbl15_info_factura_compra.cod_info_factura_compra = '$cod_info_factura_compra')";
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

$sql_info_factura_compra = "SELECT url_img_orig_producto, url_img_min_producto FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_info_factura_compra = mysqli_query($conectar, $sql_info_factura_compra);
$matriz_info_factura_compra = mysqli_fetch_assoc($consulta_info_factura_compra);

$url_img_orig_producto                   = $matriz_info_factura_compra['url_img_orig_producto'];
$url_img_min_producto                    = $matriz_info_factura_compra['url_img_min_producto'];

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
    <?php if ($cod_estado_facturacion_compra_eliminar == '1') { ?>
    <th style="text-align:center;">ELIM (DEVOLUCION - NOTA DEBITO)</th>
    <?php } ?>

    <th style="text-align:center;">ID</th>
    <th style="text-align:center;">FECHA COMPRA</th>

    <?php if ($cod_estado_fecha_entrega_factura_compra == '1') { ?>
    <th style="text-align:center;">FECHA ENTREGA</th>
    <?php } ?>

    <th style="text-align:center;">Tipo Cargue</th>
    <?php if ($cod_estado_tipo_compra_global == '1') { ?><th style="text-align:center;">Tipo Compra</th><?php } ?>

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

    <th style="text-align:center;">PLANO CSV</th>
    <th style="text-align:center;">EXCEL XLSX</th>

    <?php if ($cod_estado_recalcular_factura_compra_global == '1') { ?>
    <th style="text-align:center;">RECALCULAR</th>
    <?php } ?>

    <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
    <th style="text-align:center;">TRANSFERIR</th>
    <?php } ?>

    <?php if ($cod_estado_sticker_barras_global == '1') { ?>
    <th style="text-align:center;">GENERAR STICKER</th>
    <?php } ?>

    <?php if ($cod_estado_prod_auditoria_registrar == '1') { ?>
    <th style="text-align:center;">AUDITORIA</th>
    <?php } ?>

    <?php if ($cod_estado_soporte_factura_compra_global == '1') { ?>
    <th style="text-align:center;">SOPORTE</th>
    <?php } ?>

    <th style="text-align:center;">IMP</th>

    <?php if ($cod_estado_facturacion_compra_editar == '1') { ?>
        <th style="text-align:center;">EDIT</th>
    <?php } ?>

    <?php if ($cod_estado_edicion_fact_compra_e_inv_global == '1') { ?>
        <th style="text-align:center;">EDIT COMPRA E INVENT</th>
    <?php } ?>

    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <th style="text-align:center;"></th>
    <?php if ($cod_estado_facturacion_compra_eliminar == '1') { ?>
    <th style="text-align:center;"><a href="<?php echo $pagina_redirec_elim?>?llave=<?php echo $cod_info_factura_compra?>&tab=<?php echo $tab?>&tipo=<?php echo $tipo?>&campo=<?php echo $campo?>&pagina=<?php echo $pagina_redirect?>"><img src=../imagenes/eliminar_grand.png alt="Eliminar"></a></th>
    <?php } ?>

    <td style="text-align:center;"><?php echo $cod_info_factura_compra ?></td>
    <td style="text-align:center;"><?php echo $fecha_anyo ?></td>

    <?php if ($cod_estado_fecha_entrega_factura_compra == '1') { ?>
    <td style="text-align:center;"><?php echo $fecha_entrega ?></td>
    <?php } ?>

    <td style="text-align:center;"><?php echo $nombre_tipo_cargue_factura ?></td>
    <?php if ($cod_estado_tipo_compra_global == '1') { ?><td style="text-align:center;"><?php echo $nombre_tipo_compra ?></td><?php } ?>


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

    <th style="text-align:center;"><a href="../admin/descargar_factura_compra_campos_punto_y_coma_csv.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra?>&tab=<?php echo $tab?>&tipo=<?php echo $tipo?>&campo=<?php echo $campo?>&cod_factura=<?php echo $cod_factura?>&proveedor=<?php echo $nombre1_tercero?>"><img src=../imagenes/btn_csv.png alt="Csv"></a></th>
    <th style="text-align:center;"><a href="../admin/descargar_factura_compra_xlsx.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra?>&tab=<?php echo $tab?>&tipo=<?php echo $tipo?>&campo=<?php echo $campo?>"><img src=../imagenes/btn_xlsx.png alt="Excel"></a></th>

    <?php if ($cod_estado_recalcular_factura_compra_global == '1') { ?>
    <th style="text-align:center;"><a href="../admin/recalcular_factura_compra_reg.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra?>&tab=<?php echo $tab?>&tipo=<?php echo $tipo?>&campo=<?php echo $campo?>&pagina=<?php echo $pagina?>"><img src=../imagenes/boton_actualizar.png alt="Eliminar"></a></th>
    <?php } ?>

    <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
    <th style="text-align:center;"><a href="../admin/reg_factura_compra_transferencia_temporal_producto_reg.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra?>&tab=<?php echo $tab?>&tipo=<?php echo $tipo?>&campo=<?php echo $campo?>"><img src=../imagenes/repetir.png alt="Eliminar"></a></th>
    <?php } ?>

    <?php if ($cod_estado_sticker_barras_global == '1') { ?>
    <th style="text-align:center;"><a href="../admin/reg_sticker_factura_compra_reg.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra?>&tab=<?php echo $tab?>&tipo=<?php echo $tipo?>&campo=<?php echo $campo?>"><img src=../imagenes/sticker_estandar_128_pdf_con_barra_peq.png alt="Eliminar"></a></th>
    <?php } ?>

    <?php if ($cod_estado_prod_auditoria_registrar == '1') { ?>
    <th style="text-align:center;"><a href="../admin/enviar_auditoria_temporal_producto_factura_compra_reg.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra?>&tab=<?php echo $tab?>&tipo=<?php echo $tipo?>&campo=<?php echo $campo?>"><img src=../imagenes/cruze.png alt="Eliminar"></a></th>
    <?php } ?>

    <?php if ($cod_estado_soporte_factura_compra_global == '1') { ?>
    <th style="text-align:center;"><a href="<?php echo $url_img_orig_producto?>" target="_blank"><img src=../imagenes/adjuntar_archivo.png alt="Eliminar"></a>
        <br>
        <a href="../admin/edit_soporte_archivo_adjunto_info_factura_compra.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra;?>&pagina=<?php echo $pagina_local;?>">CARGAR SOPORTE<a/>
    </th>
    <?php } ?>

    <th style="text-align:center;"><a href="../admin/factura_compra_productos_opcion_imprimir.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra?>&tab=<?php echo $tab?>&tipo=<?php echo $tipo?>&campo=<?php echo $campo?>&pagina=<?php echo $pagina?>"><img src=../imagenes/imprimir_directa_pos.png alt="Eliminar"></a></th>

    <?php if ($cod_estado_facturacion_compra_editar == '1') { ?>
    <th style="text-align:center;"><a href="../admin/edit_facturacion_compra_iva_inc_producto_manual_pos.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra?>&tab=<?php echo $tab?>&tipo=<?php echo $tipo?>&campo=<?php echo $campo?>"><img src=../imagenes/editar.png alt="Eliminar"></a></th>
    <?php } ?>
    
    <?php if ($cod_estado_edicion_fact_compra_e_inv_global == '1') { ?>
    <th style="text-align:center;"><a href="../admin/edit_facturacion_compra_iva_inc_producto_e_inventario_manual_pos.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra?>&tab=<?php echo $tab?>&tipo=<?php echo $tipo?>&campo=<?php echo $campo?>"><img src=../imagenes/editar.png alt="Eliminar"></a></th>
    <?php } ?>
    
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