<?php if ($total_datos <> 0) { ?>

<?php
$suma_temporal = "SELECT Sum(total_venta_producto) As total_venta, Sum(total_costo_producto) As total_compra FROM tbl15_mantenimiento_producto_temporal 
WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_venta                 = $matriz_temporal['total_venta'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_mantenimiento WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
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
$cod_tipo_mantenimiento      = $data_info_factura['cod_tipo_mantenimiento'];
$fecha_mantenimiento         = $data_info_factura['fecha_mantenimiento'];


$cod_info_factura_strpad     = str_pad($cod_info_factura_venta, 6, "0", STR_PAD_LEFT);

$sql_user_vendedor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_user_vendedor = mysqli_query($conectar, $sql_user_vendedor);
$matriz_user_vendedor = mysqli_fetch_assoc($consulta_user_vendedor);

$nombres_vendedor            = $matriz_user_vendedor['nombres'].' '.$matriz_user_vendedor['apellidos'];

$tab                         = 'tbl15_mantenimiento_producto_temporal';
$tipo                        = 'eliminar';
$campo                       = 'cod_venta_producto_temporal';

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
            var tipo_ajax = "tbl15_info_factura_mantenimiento";
            $.post("guardar_info_factura_y_mantenimiento_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_mantenimiento";
            $.post("guardar_info_factura_y_mantenimiento_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_mantenimiento";
            $.post("guardar_info_factura_y_mantenimiento_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_mantenimiento";
            $.post("guardar_info_factura_y_mantenimiento_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_mantenimiento";
            $.post("guardar_info_factura_y_mantenimiento_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_mantenimiento";
            $.post("guardar_info_factura_y_mantenimiento_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_mantenimiento";
            $.post("guardar_info_factura_y_mantenimiento_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_mantenimiento";
            $.post("guardar_info_factura_y_mantenimiento_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#cod_cliente").html(data);
            });     
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_mantenimiento").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_mantenimiento";
            var tipo_ajax = "tbl15_info_factura_mantenimiento";
            if (valor=='8') {
            document.getElementById("fecha_mantenimiento_div").style.display = "block";
            } else {
            document.getElementById("fecha_mantenimiento_div").style.display = "none";
            }
            $.post("guardar_info_factura_y_mantenimiento_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#fecha_mantenimiento").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_mantenimiento";
            var tipo_ajax = "tbl15_info_factura_mantenimiento";
            $.post("guardar_info_factura_y_mantenimiento_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("textarea").on('change', function () {
            var valor = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_mantenimiento_producto_temporal";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_y_mantenimiento_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#error_identificacion_repetida").html(data);
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
            var tipo_ajax = "tbl15_mantenimiento_producto_temporal";
            var id = $(this).attr("class");
            //let id = this.id;
            $.post("guardar_info_factura_y_mantenimiento_producto_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#error_identificacion_repetida").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
var cod_tipo_mantenimiento = $("#cod_tipo_mantenimiento").val();

if (cod_tipo_mantenimiento=='8') {
document.getElementById("fecha_mantenimiento_div").style.display = "block";
} else {
document.getElementById("fecha_mantenimiento_div").style.display = "none";
}

});
</script>

<form method="post" name="formulario" action="../admin/mantenimiento_producto_reg.php">
<table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
  <tr>
    <td style="text-align:center;"></td>
    <th style="text-align:center;">ID</th>
    <th style="text-align:center;">FECHA</th>
    <th style="text-align:center;">VENDEDOR</th>
<!--
    <th style="text-align:center;">MONEDA</th>
    <th style="text-align:center;">TIPO FACTURA</th>
-->
    <th style="text-align:center;">FORMA PAGO</th>
    <!--<th style="text-align:center;">TIPO PAGO</th>-->
    <th style="text-align:center;">TERCERO</th>
    <th style="text-align:center;">TIPO MANTENIMIENTO</th>
    <th style="text-align:center;">TOTAL FACTURA</th>
    <th style="text-align:center;">RECIBIDO</th>
    <th style="text-align:center;">FACTURAR</th>
    <td style="text-align:center;"></td>
  </tr>
  <tr>
    <td style="text-align:center;"></td>
    <!--<td style="text-align:center;"><a href="javascript:void(0);" id="foco_btn_imprimir" onclick="printPageArea('area_imprimible_invisible')"><img src="../imagenes/imprimir_directa_pos.png" alt="imprimir"></a></td>-->
   <td style="text-align:center;"><?php echo $cod_info_factura_venta ?></td>
<?php if ($cod_seguridad==1) { ?>
   <td style="text-align:center;"><input name="fecha_anyo" id="fecha_anyo" type="date" value="<?php echo $fecha_anyo ?>" style="width: 105px;" required/></td>
<?php } else { ?>
   <td style="text-align:center;"><?php echo $fecha_anyo ?></td>
   <input name="fecha_anyo" id="fecha_anyo" type="hidden" value="<?php echo $fecha_anyo ?>" required/>
<?php } ?>
<!--
   <td style="text-align:center;"><?php echo $nombre_tipo_moneda ?></td>
   <td style="text-align:center;"><?php echo $nombre_tipo_factura ?></td>
-->
    <input name="nombre_tipo_moneda" id="nombre_tipo_moneda" type="hidden" value="COP" style="width: 110px;" required/>
    <input name="nombre_tipo_factura" id="nombre_tipo_factura" type="hidden" value="POS" style="width: 110px;" required/>
    <input name="cod_tipo_pago" id="cod_tipo_pago" type="hidden" value="1" style="width: 110px;" required/>


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
<!--
    <td style="text-align:center;">
        <select name="nombre_tipo_moneda" id="nombre_tipo_moneda" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 70px;" required>
            <?php if (isset($nombre_tipo_moneda)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT * FROM tbl15_tipo_moneda WHERE (nombre_tipo_moneda='COP')";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_moneda) AND $nombre_tipo_moneda == $datos2['nombre_tipo_moneda']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_moneda'];
            $nombre = $datos2['nombre_tipo_moneda'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>

    <td style="text-align:center;">
        <select name="nombre_tipo_factura" id="nombre_tipo_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" required>
            <?php if (isset($nombre_tipo_factura)) { echo ""; } else { echo  ""; }
            $consulta2_sql = "SELECT * FROM tbl15_tipo_factura";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($nombre_tipo_factura) AND $nombre_tipo_factura == $datos2['nombre_tipo_factura']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['nombre_tipo_factura'];
            $nombre = $datos2['nombre_tipo_factura'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
-->
    <td style="text-align:center;">
        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" required>
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
<!--
    <td style="text-align:center;">
        <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" required>
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
-->
    <td style="text-align:left; width:300px">
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
        <p><a href="#" id="modal_abrir"><img src="../imagenes/boton_mas_blanco.png"></a></p>
    </td>

    <td style="text-align:left; width:300px">
        <select name="cod_tipo_mantenimiento" id="cod_tipo_mantenimiento" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 250px;" required>
            <?php if (isset($cod_tipo_mantenimiento)) { echo "<option value='' ></option>"; } else { echo  "<option value='' selected ></option>"; }
            $consulta2_sql = "SELECT cod_tipo_mantenimiento, nombre_tipo_mantenimiento FROM tbl15_tipo_mantenimiento WHERE (cod_estado='1') ORDER BY cod_tipo_mantenimiento ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_mantenimiento) AND $cod_tipo_mantenimiento == $datos2['cod_tipo_mantenimiento']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_mantenimiento'];
            $nombre = $datos2['nombre_tipo_mantenimiento'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
        <div id="fecha_mantenimiento_div"><input name="fecha_mantenimiento" id="fecha_mantenimiento" type="date" value="<?php echo $fecha_mantenimiento; ?>"/></div>
    </td>

    <td style="text-align:center; font-size:30;" id="total_venta"><?php echo number_format($total_venta, 0, ",", "."); ?></td>
    <td style="text-align:center;"><input name="vlr_cancelado_number" id="vlr_cancelado_number" type="text" value="" style="width: 110px;" required/></td>
    <input type="hidden" name="vlr_cancelado" id="vlr_cancelado" value="">
    <td style="text-align:center;"><input type="image" src="../imagenes/guardar.png" tabindex=3 name="vender" value="Guardar" /></td>
    <td style="text-align:center;"></td>

<?php 
$sql_temporal = "SELECT cod_venta_producto_temporal FROM tbl15_mantenimiento_producto_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_temporal = mysqli_query($conectar, $sql_temporal);
$total_datos = mysqli_num_rows($consulta_temporal);
while ($datos_temporal = mysqli_fetch_assoc($consulta_temporal)) { ?>
<input type="hidden" name="cod_venta_producto_temporal[]" value="<?php echo $datos_temporal['cod_venta_producto_temporal']; ?>" size="4">
<?php } ?>

<?php $pagina ='facturacion_mantenimiento_temporal_producto_manual_pos.php'; ?>
<input type="hidden" name="cod_info_factura_venta" value="<?php echo $cod_info_factura_venta ?>" size="10">
<input type="hidden" name="total_datos" value="<?php echo $total_datos; ?>" size="4">
<input type="hidden" name="pagina" value="<?php echo $pagina_local?>" size="15">
<input type="hidden" name="flete" value="0" size="15">
<input type="hidden" name="verificacion_envio" value="1" size="15">
<input type="hidden" name="cod_estado_vacuna" value="0" size="15">
  </tr>
</table>
</form>

<?php } else { } ?>