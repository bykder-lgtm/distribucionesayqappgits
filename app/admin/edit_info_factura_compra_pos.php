<?php if ($total_datos <> 0) { ?>

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
    $("#fecha_entrega").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_entrega";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
    $("#cod_tipo_inventario").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_inventario";
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

<?php if ($cod_estado_tipo_compra_global == '1') { ?>
<script language="javascript">
$(document).ready(function(){
    $("#nombre_tipo_compra").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre_tipo_compra";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<?php } ?>

<script>
$(document).ready(function(){
    $("#fecha_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_pago";
            var tipo_ajax = "tbl15_info_factura_compra";
            $.post("guardar_info_factura_y_compra_producto_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_factura_compra; ?> }, function(data){
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
            var tipo_ajax = "tbl15_factura_compra_producto";
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
    <th style="text-align:center;">FECHA COMPRA</th>

    <?php if ($cod_estado_fecha_entrega_factura_compra == '1') { ?>
    <th style="text-align:center;">FECHA ENTREGA</th>
    <?php } ?>

    <th style="text-align:center;">TIPO COMPRA</th>
    <?php if ($cod_estado_tipo_compra_global == '1') { ?><th style="text-align:center;">Tipo Compra</th><?php } ?>

    <?php if ($cod_estado_observacion_factura_compra == '1') { ?>
    <th style="text-align:center;">OBSERVACION</th>
    <?php } ?>

    <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
    <th style="text-align:center;">TIPO INVENTARIO</th>
    <?php } ?>
    <th style="text-align:center;">FORMA PAGO</th>
    <th style="text-align:center;">TIPO PAGO</th>
    <th style="text-align:center;">TERCERO</th>
    <th style="text-align:center;">FACTURA</th>
    <th style="text-align:center;">%RETE FUENTE</th>
    <th style="text-align:center;">%RETE ICA</th>
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

    <?php if ($cod_estado_fecha_entrega_factura_compra == '1') { ?>
    <td style="text-align:center;"><input name="fecha_entrega" id="fecha_entrega" type="date" value="<?php echo $fecha_entrega ?>" style="width: 110px;"/></td>
    <?php } ?>

    <td style="text-align:center;">
        <select name="nombre_tipo_cargue_factura" id="nombre_tipo_cargue_factura" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
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

        <?php if ($cod_estado_tipo_compra_global == '1') { ?>
        <td style="text-align:center;">
            <select name="nombre_tipo_compra" id="nombre_tipo_compra" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
                <?php if (isset($nombre_tipo_compra)) { echo ""; } else { echo  ""; }
                $consulta2_sql = "SELECT nombre_tipo_compra, cod_tipo_compra FROM tbl15_tipo_compra WHERE (cod_estado = '1') ORDER BY nombre_tipo_compra DESC";
                $consulta2 = mysqli_query($conectar, $consulta2_sql);
                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                if(isset($nombre_tipo_compra) AND $nombre_tipo_compra == $datos2['nombre_tipo_compra']) {
                $seleccionado = "selected"; } else { $seleccionado = ""; }
                $codigo = $datos2['nombre_tipo_compra'];
                $nombre = $datos2['nombre_tipo_compra'];
                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
            </select>
        </td>
        <?php } ?>

    <?php if ($cod_estado_observacion_factura_compra == '1') { ?>
    <td style="text-align:center;"><input name="observacion" id="observacion" type="text" value="<?php echo $observacion ?>" style="width: 110px;"/></td>
    <?php } ?>

    <input name="nombre_tipo_moneda" id="nombre_tipo_moneda" type="hidden" value="COP" style="width: 110px;" required/>
    <input name="nombre_tipo_factura" id="nombre_tipo_factura" type="hidden" value="POS" style="width: 110px;" required/>

    <?php if ($cod_estado_inventario_bodega_global == '1') { ?>
    <td style="text-align:center;">
        <select name="cod_tipo_inventario" id="cod_tipo_inventario" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 190px;" required>
            <?php if (isset($cod_tipo_inventario)) { echo "<option value='' >...</option>"; } else { echo  "<option value='' >...</option>"; }
            $consulta2_sql = "SELECT nombre_tipo_inventario, cod_tipo_inventario FROM tbl15_tipo_inventario ORDER BY cod_tipo_inventario ASC";
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_tipo_inventario) AND $cod_tipo_inventario == $datos2['cod_tipo_inventario']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $codigo = $datos2['cod_tipo_inventario'];
            $nombre = $datos2['nombre_tipo_inventario'];
            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
        </select>
    </td>
    <?php } ?>

    <td style="text-align:center;">
        <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 170px;" required>
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
        <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 140px;" required>
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
        <?php if ($cod_tipo_pago == '2') { ?><br><strong>FECHA PAGO: </strong><input name="fecha_pago" id="fecha_pago" type="date" value="<?php echo $fecha_pago ?>" style="width: 110px;"/><?php } ?>
    </td>

    <td style="text-align:center;">
        <select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true" style="width: 200px;" required>
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
<?php } else { } ?>