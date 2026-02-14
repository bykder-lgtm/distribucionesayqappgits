<?php if ($total_datos <> 0) { ?>

<?php
$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_subproducto WHERE (nombre_estado_factura = 'CERRADA') AND (cod_producto_barra = '$cod_producto_barra_madre')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_factura_subproducto      = $data_info_factura['cod_info_factura_subproducto'];
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
$cod_producto_madre          = $data_info_factura['cod_producto'];
$cod_producto_barra_madre    = $data_info_factura['cod_producto_barra'];
$nombre_producto_madre       = $data_info_factura['nombre_producto'];
$cod_info_factura_strpad     = str_pad($cod_info_factura_subproducto, 6, "0", STR_PAD_LEFT);

$sql_user_vendedor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_user_vendedor = mysqli_query($conectar, $sql_user_vendedor);
$matriz_user_vendedor = mysqli_fetch_assoc($consulta_user_vendedor);

$nombres_vendedor            = $matriz_user_vendedor['nombres'].' '.$matriz_user_vendedor['apellidos'];

$tab                         = 'tbl15_subproducto';
$tipo                        = 'eliminar';
$campo                       = 'cod_subproducto';

if ($cod_seguridad == '1') {
$condicion_inventario = 'cod_tipo_inventario = "1" OR cod_tipo_inventario = "2"';
} else {
$condicion_inventario = 'cod_tipo_inventario = "1"';
}
?>
<script language="javascript">
$(document).ready(function(){
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_factura_subproducto";
            $.post("guardar_info_factura_y_subproducto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_subproducto; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_subproducto";
            $.post("guardar_info_factura_y_subproducto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_subproducto; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_subproducto";
            $.post("guardar_info_factura_y_subproducto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_subproducto; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_subproducto";
            $.post("guardar_info_factura_y_subproducto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_subproducto; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_subproducto";
            $.post("guardar_info_factura_y_subproducto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_subproducto; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_subproducto";
            $.post("guardar_info_factura_y_subproducto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_subproducto; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_subproducto";
            $.post("guardar_info_factura_y_subproducto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_subproducto; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_subproducto";
            $.post("guardar_info_factura_y_subproducto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_subproducto; ?> }, function(data){
                $("#cod_cliente").html(data);
            });     
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_producto_barra_madre").on('change', function () {
        $("#cod_producto_barra_madre option:selected").each(function () {
            var valor = $(this).val();
            var campo = "cod_producto_barra_madre";
            var tipo_ajax = "tbl15_info_factura_subproducto";
            $.post("guardar_info_factura_y_subproducto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_subproducto; ?> }, function(data){
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
            var tipo_ajax = "tbl15_subproducto";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_y_subproducto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#error_identificacion_repetida").html(data);
        });
   });
});
</script>

<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <th style="text-align:center;"></th>
    <th style="text-align:center;">ID</th>
    <th style="text-align:center;"><?php echo $nombre_concepto_multi_virtual; ?></th>
    <th style="text-align:center;">NOMBRE PRODUCTO PRINCIPAL</th>
    <th style="text-align:center;">GUARDAR</th>
    <th style="text-align:center;"></th>

  </tr>
  <tr>
    <td style="text-align:center;"></td>
   <td style="text-align:center;"><?php echo $cod_info_factura_subproducto ?></td>
   <td style="text-align:center;"><?php echo $cod_caja_virtual ?></td>
    <td style="text-align:left; width:300px">
        <select name="cod_producto_barra_madre" id="cod_producto_barra_madre" class="form-control" data-show-subtext="true" data-live-search="true" style="width: 400px;" required>
            <?php if (isset($cod_producto_barra_madre)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT cod_producto_barra, nombre_producto, cod_producto FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra_madre')";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_producto_barra_madre) AND $cod_producto_barra_madre == $datos2['cod_producto_barra']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_producto_barra'];
            $nombre = $datos2['nombre_producto'].' | '.$datos2['cod_producto_barra'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

   <input name="cod_tipo_inventario" id="cod_tipo_inventario" type="hidden" value="<?php echo $cod_tipo_inventario ?>" />
   <input name="fecha_anyo" id="fecha_anyo" type="hidden" value="<?php echo $fecha_anyo ?>" />
   <input name="cod_administrador" id="cod_administrador" type="hidden" value="<?php echo $cod_administrador ?>" />
   <input name="nombre_tipo_moneda" id="nombre_tipo_moneda" type="hidden" value="<?php echo $nombre_tipo_moneda ?>"/>
   <input name="nombre_tipo_factura" id="nombre_tipo_factura" type="hidden" value="<?php echo $nombre_tipo_factura ?>" />
   <input name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" type="hidden" value="<?php echo $cod_tipo_forma_pago ?>" />
   <input name="cod_tipo_pago" id="cod_tipo_pago" type="hidden" value="<?php echo $cod_tipo_pago ?>" />
   <input name="cod_tercero" id="cod_tercero" type="hidden" value="<?php echo $cod_tercero ?>" />
   <td style="text-align:center;"><a href="../admin/lista_subproducto.php?cod_producto_barra_madre=<?php echo $cod_producto_barra_madre?>&pagina=<?php echo $pagina?>"><img src="../imagenes/guardar.png"></a></td>
   <td style="text-align:center;"></td>

<?php 
$sql_temporal = "SELECT cod_subproducto FROM tbl15_subproducto WHERE (cod_producto_barra_madre = '$cod_producto_barra_madre')";
$consulta_temporal = mysqli_query($conectar, $sql_temporal);
$total_datos = mysqli_num_rows($consulta_temporal);
while ($datos_temporal = mysqli_fetch_assoc($consulta_temporal)) { ?>
<input type="hidden" name="cod_subproducto[]" value="<?php echo $datos_temporal['cod_subproducto']; ?>" size="4">
<?php } ?>

<?php $pagina ='facturacion_subproducto_producto_manual_pos.php'; ?>
<input type="hidden" name="cod_info_factura_subproducto" value="<?php echo $cod_info_factura_subproducto ?>" size="10">
<input type="hidden" name="total_datos" value="<?php echo $total_datos; ?>" size="4">
<input type="hidden" name="pagina" value="<?php echo $pagina_local?>" size="15">
<input type="hidden" name="flete" value="0" size="15">
<input type="hidden" name="verificacion_envio" value="1" size="15">
<input type="hidden" name="cod_estado_vacuna" value="0" size="15">
  </tr>
</table>

<?php } else { } ?>