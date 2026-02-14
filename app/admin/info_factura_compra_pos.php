<?php if ($total_datos <> 0) { ?>

<?php
$suma_temporal = "SELECT Sum(total_compra_producto) As total_compra FROM tbl15_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_compra                = $matriz_temporal['total_compra'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
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
$nombre_tipo_forma_pago                   = $data_info_factura['nombre_tipo_forma_pago'];
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

$tab                                     = 'tbl15_compra_producto';
$tipo                                    = 'eliminar';
$campo                                   = 'cod_compra_producto';
?>
<script language="javascript">
$(document).ready(function(){
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            var tipo_ajax = "tbl15_compra_producto";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;"></th>
    <th style="text-align:center;">ID</th>
    <th style="text-align:center;">FECHA</th>
    <td style="text-align:center;"></td>
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO PAGO</th>
    <td style="text-align:center;">PROVEEDOR</td>
    <th style="text-align:center;">FACTURA</th>
    <th style="text-align:center;">%RETE FUENTE</th>
    <th style="text-align:center;">%RETE ICA</th>
    <th style="text-align:center;">GUARDAR</th>
    <th style="text-align:center;"></th>
  </tr>
  <tr>
    <th style="text-align:center;"></th>
    <th style="text-align:center;"><?php echo $cod_info_factura_compra ?></th>

<?php if ($cod_seguridad==1) { ?>
   <td style="text-align:center;"><input name="fecha_anyo" id="fecha_anyo" type="date" value="<?php echo $fecha_anyo ?>" style="width: 110px;" required/></td>
<?php } else { ?>
   <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
   <input name="fecha_anyo" id="fecha_anyo" type="hidden" value="<?php echo $fecha_anyo ?>" required/>
<?php } ?>

    <input name="nombre_tipo_moneda" id="nombre_tipo_moneda" type="hidden" value="COP" style="width: 110px;" required/>
    <input name="nombre_tipo_factura" id="nombre_tipo_factura" type="hidden" value="POS" style="width: 110px;" required/>

    <td style="text-align:center;">
        <select name="nombre_tipo_cargue_factura" id="nombre_tipo_cargue_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($nombre_tipo_cargue_factura)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT nombre_tipo_cargue_factura, cod_tipo_cargue_factura FROM tbl15_tipo_cargue_factura WHERE (nombre_tipo_cargue_factura = '$nombre_tipo_cargue_factura') ORDER BY nombre_tipo_cargue_factura ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_cargue_factura) AND $nombre_tipo_cargue_factura == $datos2['nombre_tipo_cargue_factura']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_cargue_factura'];
            $nombre = $datos2['nombre_tipo_cargue_factura'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT cod_tipo_forma_pago, nombre_tipo_forma_pago FROM tbl15_tipo_forma_pago WHERE (cod_estado = '1') ORDER BY cod_tipo_forma_pago ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_forma_pago) AND $cod_tipo_forma_pago == $datos2['cod_tipo_forma_pago']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_forma_pago'];
            $nombre = $datos2['nombre_tipo_forma_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_pago)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT cod_tipo_pago, nombre_tipo_pago FROM tbl15_tipo_pago ORDER BY cod_tipo_pago ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_pago) AND $cod_tipo_pago == $datos2['cod_tipo_pago']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_pago'];
            $nombre = $datos2['nombre_tipo_pago'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tercero)) { echo "<option value='' >...</option>";
            } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
            FROM tbl15_tercero WHERE (nombre_tipo_tercero='PROVEEDOR') OR (nombre_tipo_tercero='AMBOS') ORDER BY nombre1_tercero ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tercero) AND $cod_tercero == $datos2['cod_tercero']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tercero'];
            $nombre = $datos2['nombre1_tercero'].' '.$datos2['nombre2_tercero'].' '.$datos2['apellido1_tercero'].' '.$datos2['apellido2_tercero'].' - '.$datos2['identificacion_tercero'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <a href="#" id="modal_abrir"><img src="../imagenes/boton_mas_blanco.png"></a>
    </td>

   <td style="text-align:center;"><input name="cod_factura" id="cod_factura" type="text" value="<?php echo $cod_factura ?>" style="width: 110px;" required/></td>
   <td style="text-align:center;"><input name="nombre_rete_fuente_ptj" id="nombre_rete_fuente_ptj" type="text" value="<?php echo $nombre_rete_fuente_ptj ?>" style="width: 30px;" required/></td>
   <td style="text-align:center;"><input name="ret_ica_ptj" id="ret_ica_ptj" type="text" value="<?php echo $ret_ica_ptj ?>" style="width: 30px;" required/></td>
    <td style="text-align:center;"><a href="../admin/edit_factura_cotizacion_compra.php?cod_info_factura_compra=<?php echo $cod_info_factura_compra ?>"><img src="../imagenes/guardar.png" class="img-polaroid" alt=""></a></td>
    <th style="text-align:center;"></th>
  </tr>
</table>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;"></th>
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
    <td style="text-align:center;">
        <select name="cod_administrador" id="cod_administrador" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_tipo_forma_pago)) { echo ""; } else { echo  ""; }
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

   <td style="text-align:center;"><input name="subtotal" id="subtotal" type="text" value="<?php echo $subtotal ?>" style="width: 110px;" required/></td>
   <td style="text-align:center;"><input name="valor_iva" id="valor_iva" type="text" value="<?php echo $valor_iva ?>" style="width: 110px;" required/></td>
   <td style="text-align:center;"><input name="total_descuento" id="total_descuento" type="text" value="<?php echo $total_descuento ?>" style="width: 110px;" required/></td>
   <td style="text-align:center;"><input name="total_precio_ipc" id="total_precio_ipc" type="text" value="<?php echo $total_precio_ipc ?>" style="width: 110px;" required/></td>
   <td style="text-align:center;"><input name="total_compra_imp" id="total_compra_imp" type="text" value="<?php echo $total_compra_imp ?>" style="width: 110px;" required/></td>
   <td style="text-align:center;"><input name="total_rete_fuente" id="total_rete_fuente" type="text" value="<?php echo $total_rete_fuente ?>" style="width: 110px;" required/></td>
   <td style="text-align:center;"><input name="total_ret_ica" id="total_ret_ica" type="text" value="<?php echo $total_ret_ica ?>" style="width: 110px;" required/></td>
   <td style="text-align:center;"><input name="total_factura_compra_retefuente" id="total_factura_compra_retefuente" type="text" value="<?php echo $total_factura_compra_retefuente ?>" style="width: 110px;" required/></td>
    <td style="text-align:center;"></td>
  </tr>
</table>
<?php $pagina ='facturacion_cotizacion_compra_temporal_producto_manual_pos.php'; ?>
<input type="hidden" name="cod_info_factura_compra" value="<?php echo $cod_info_factura_compra ?>" size="10">
<input type="hidden" name="total_datos" value="<?php echo $total_datos; ?>" size="4">
<input type="hidden" name="pagina" value="<?php echo $pagina_local?>" size="15">
<input type="hidden" name="flete" value="0" size="15">
<input type="hidden" name="verificacion_envio" value="1" size="15">
<input type="hidden" name="cod_estado_vacuna" value="0" size="15">
</form>
<?php } else { } ?>