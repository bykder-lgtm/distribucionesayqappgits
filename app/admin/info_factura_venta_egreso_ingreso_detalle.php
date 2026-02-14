<?php
$suma_temporal = "SELECT Sum(precio_venta_producto) As total_gasto_venta, Sum(precio_compra_producto) As total_gasto_compra, Sum(peso_producto * und_venta) As total_peso_producto 
FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal);
$matriz_temporal = mysqli_fetch_assoc($consulta_temporal);

$total_gasto_venta            = $matriz_temporal['total_gasto_venta'];
$total_gasto_compra           = $matriz_temporal['total_gasto_compra'];
$total_peso_producto          = $matriz_temporal['total_peso_producto'];

$sql_base_iva = "SELECT Sum((total_venta_producto)/((iva_ptj/100)+(100/100))) As subtotal_base_iva
FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_base_iva = mysqli_query($conectar, $sql_base_iva);
$matriz_base_iva = mysqli_fetch_assoc($consulta_base_iva);

$subtotal_base_iva            = $matriz_base_iva['subtotal_base_iva'];

$datos_data_info_factura = "SELECT * FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

$cod_info_gasto_inmueble_detalle_venta      = $data_info_factura['cod_info_gasto_inmueble_detalle_venta'];
$cod_factura                                = $data_info_factura['cod_factura'];
$cod_tercero                                = $data_info_factura['cod_tercero'];
$fecha_ymdhis                               = $data_info_factura['fecha_ymdhis'];
$cuenta                                     = $data_info_factura['cuenta'];
$cod_estado_factura                         = $data_info_factura['cod_estado_factura'];
$cod_base_caja                              = $data_info_factura['cod_base_caja'];
$descuento_ptj                              = $data_info_factura['descuento_ptj'];
$cod_tipo_pago                              = $data_info_factura['cod_tipo_pago'];
$cod_administrador                          = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                       = $data_info_factura['nombre_tipo_producto'];
$cod_tipo_forma_pago                        = $data_info_factura['cod_tipo_forma_pago'];
$fecha_creacion                             = $data_info_factura['fecha_creacion'];
$fecha_modificacion                         = $data_info_factura['fecha_modificacion'];
$cod_resolucion_facturacion                 = $data_info_factura['cod_resolucion_facturacion'];
$fecha_pago                                 = $data_info_factura['fecha_pago'];

$cod_info_factura_strpad                    = str_pad($cod_info_gasto_inmueble_detalle_venta, 6, "0", STR_PAD_LEFT);

$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (nombre_tipo_factura = 'ELECTRONICA') AND (nombre_estado_factura = 'CERRADA')";
$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

$cod_ultima_factura_electronica             = $maxima_factura['cod_factura'];

$sql_user_vendedor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_user_vendedor = mysqli_query($conectar, $sql_user_vendedor);
$matriz_user_vendedor = mysqli_fetch_assoc($consulta_user_vendedor);

$nombres_vendedor                           = $matriz_user_vendedor['nombres'].' '.$matriz_user_vendedor['apellidos'];

$tab                         = 'tbl15_gasto_inmueble_detalle_venta_temporal';
$tipo                        = 'eliminar';
$campo                       = 'cod_gasto_inmueble_detalle_venta_temporal';

if ($cod_seguridad == '1') { $condicion_inventario = 'cod_tipo_inventario = "1" OR cod_tipo_inventario = "2"'; } else { $condicion_inventario = 'cod_tipo_inventario = "1"'; }
if ($cod_estado_cambiar_vendedor_al_vender == '1') { $condicion_vendedor = ''; } else { $condicion_vendedor = 'WHERE cod_administrador = '.$cod_administrador; }

?>
<script language="javascript">
$(document).ready(function(){
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
                //$("#cod_cliente").html(data);
                $("#"+"observacion_tercero").val(data);
            });     
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_factura").on('change', function () {
        $("#cod_factura option:selected").each(function () {
            var valor = $(this).val();
            var campo = "cod_factura";
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
                //$("#cod_cliente").html(data);
                $("#"+"observacion_tercero").val(data);
            });     
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_metodo_envio").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_metodo_envio";
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#nombre1_tercero").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre1_tercero";
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
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
        var tipo_ajax = "tbl15_gasto_inmueble_detalle_venta_temporal";
        var id = $(this).attr("class");
        var cod_seguridad = <?php echo $cod_seguridad;?>;
        var cod_estado_modificar_und_venta_una_sola_vez_global = <?php echo $cod_estado_modificar_und_venta_una_sola_vez_global;?>;
        var cod_estado_bascula_balanza_electronica_pesar_producto_global = <?php echo $cod_estado_bascula_balanza_electronica_pesar_producto_global;?>;
        var pagina_local = "<?php echo $pagina_local;?>";
        var foco = '';
        var filtro = 'global';

        var nombre_campo_incre = $(this).attr("id");
        let framentador_nombre = nombre_campo_incre.split("und_venta");
        var nombre_campo = framentador_nombre[0];
        var increm = framentador_nombre[1];

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco+'&'+'nombre_campo_incre='+nombre_campo_incre+'&'+'filtro='+filtro;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var und_venta = respuesta.und_venta;
                var und_caja_sobre = respuesta.und_caja_sobre;
                var total_venta = respuesta.total_venta;
                var total_venta_producto = respuesta.total_venta_producto;
                var incre = respuesta.incre;
                var ok_ajax = respuesta.ok_ajax;
                var emisor = respuesta.emisor;

                if (emisor == 'precio_compra_producto') {
                    var total_gasto_compra = respuesta.total_gasto_format;
                    $("#total_gasto_compra").html(total_gasto_compra);
                }
                if (emisor == 'precio_venta_producto') {
                    var total_gasto_venta = respuesta.total_gasto_format;
                    $("#total_gasto_venta").html(total_gasto_venta);
                }

                //$("#total_venta").html(total_venta);
                $("#div_und_caja_sobre"+incre).html(und_venta);
                $("#total_venta_producto"+incre).html(total_venta_producto);
                $("#und_venta"+incre).val(und_venta);
                $("#error_identificacion_repetida").html(respuesta);

            }
        });
    });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $('input[name="comentario_producto"]').keydown(function(){  
    //$("#cod_origen_produccion").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_gasto_inmueble_detalle_venta_temporal";
        var id = $(this).attr("class");
        var cod_seguridad = <?php echo $cod_seguridad;?>;
        var cod_estado_modificar_und_venta_una_sola_vez_global = <?php echo $cod_estado_modificar_und_venta_una_sola_vez_global;?>;
        var cod_estado_bascula_balanza_electronica_pesar_producto_global = <?php echo $cod_estado_bascula_balanza_electronica_pesar_producto_global;?>;
        var pagina_local = "<?php echo $pagina_local;?>";
        var foco = '';

        var nombre_campo_incre = $(this).attr("id");
        let framentador_nombre = nombre_campo_incre.split("und_venta");
        var nombre_campo = framentador_nombre[0];
        var increm = framentador_nombre[1];

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco+'&'+'nombre_campo_incre='+nombre_campo_incre;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var ok_ajax = respuesta.ok_ajax;
            }
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
 <script>  
 $(document).ready(function(){  

  $('textarea[name="descripcion_gasto_inmueble_detalle"]').change(function(){ 
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "tbl15_gasto_inmueble_detalle_venta_temporal";
        var id = $(this).attr("class");
        var cod_seguridad = <?php echo $cod_seguridad;?>;
        var cod_estado_modificar_und_venta_una_sola_vez_global = <?php echo $cod_estado_modificar_und_venta_una_sola_vez_global;?>;
        var cod_estado_bascula_balanza_electronica_pesar_producto_global = <?php echo $cod_estado_bascula_balanza_electronica_pesar_producto_global;?>;
        var pagina_local = "<?php echo $pagina_local;?>";
        var foco = '';

        var nombre_campo_incre = $(this).attr("id");
        let framentador_nombre = nombre_campo_incre.split("und_venta");
        var nombre_campo = framentador_nombre[0];
        var increm = framentador_nombre[1];

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco+'&'+'nombre_campo_incre='+nombre_campo_incre;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var ok_ajax = respuesta.ok_ajax;
            }
        });
   });  
 });  
 </script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#observacion_tercero").on('change', function () {
            var valor = $(this).val();
            var campo = "observacion_tercero";
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_base_caja").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_base_caja";
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:<?php echo $cod_info_gasto_inmueble_detalle_venta; ?> }, function(data){
                $("#mensaje_caja_mesa").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#descripcion_tipo_forma_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "descripcion_tipo_forma_pago";
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            var id = $(this).attr("class");
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#fecha_pago").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_pago";
            var tipo_ajax = "tbl15_info_gasto_inmueble_detalle_venta";
            var id = $(this).attr("class");
            $.post("guardar_info_factura_y_egreso_ingreso_detalle_temporal_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<form name="formulario" method="post" enctype="multipart/form-data" action="../admin/venta_gasto_inmueble_detalle_reg.php">

    <table class="table table-striped" border="1" cellspacing="0" cellpadding="20">
      <tr>
        <td style="text-align:center;"></td>
        <th style="text-align:center;">ID</th>
        <th style="text-align:center;">CONTRATO</th>
        <th style="text-align:center;">FORMA PAGO</th>
        <!--<th style="text-align:center;">TIPO PAGO</th>-->
        <th style="text-align:center;">TOTAL ADMINISTRACION DE REPARACION</th>
        <th style="text-align:center;">TOTAL COSTO</th>

        <?php if ($cod_estado_habilitar_btn_facturar_mod_venta == '0') { ?>
        <?php if ($total_datos <> '0') { ?>
        <!--<th style="text-align:center;">FACTURAR</th>-->
        <?php } ?>
        <?php } ?>

        <td style="text-align:center;"></td>
      </tr>
      <tr>
        <td style="text-align:center;"></td>
       <td style="text-align:center;"><?php echo $cod_info_gasto_inmueble_detalle_venta ?></td>

        <td style="text-align:left">
            <select name="cod_factura" id="cod_factura" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
            <?php if (isset($cod_factura)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
            $consulta2_sql = ("SELECT * FROM tbl15_cuentas_cobrar GROUP BY cod_factura ASC");
            $consulta2 = mysqli_query($conectar, $consulta2_sql);
            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
            if(isset($cod_factura) and $cod_factura == $datos2['cod_factura']) {
            $seleccionado = "selected"; } else { $seleccionado = ""; }
            $cod_tercero_inquilino          = $datos2['cod_tercero'];
            $cod_tercero_propietario        = $datos2['cod_tercero_propietario'];
            $cod_producto                   = $datos2['cod_producto'];
            $cod_producto_barra             = $datos2['cod_producto_barra'];
            $nombre_producto                = $datos2['nombre_producto'];               

            $sql_inquilino = "SELECT nombre1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero_inquilino')";
            $consulta_inquilino = mysqli_query($conectar, $sql_inquilino) or die(mysqli_error($conectar));
            $datos_inquilino = mysqli_fetch_assoc($consulta_inquilino);

            $nombre1_tercero_inquilino      = $datos_inquilino['nombre1_tercero'];

            $sql_propietario = "SELECT nombre1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero_propietario')";
            $consulta_propietario = mysqli_query($conectar, $sql_propietario) or die(mysqli_error($conectar));
            $datos_propietario = mysqli_fetch_assoc($consulta_propietario);

            $nombre1_tercero_propietario      = $datos_propietario['nombre1_tercero'];

            $codigo                         = $datos2['cod_factura'];
            $nombre                         = 'CONT: '.$datos2['cod_factura'].' |  PROP: '.$nombre1_tercero_propietario.' ['.$nombre_producto.']';

            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
        </td>

        <td style="text-align:center;">
            <select name="cod_tipo_forma_pago" id="cod_tipo_forma_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" tabindex="1" required>
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
            <select name="cod_tipo_pago" id="cod_tipo_pago" class="selectpicker" data-show-subtext="true" data-live-search="true" style="width: 120px;" tabindex="1" required>
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

       <th style="text-align:center; font-size:40px;"><div id="total_gasto_compra"><?php echo number_format($total_gasto_compra, 0, ",", ".") ?></div></th>
       <th style="text-align:center; font-size:40px;"><div id="total_gasto_venta"><?php echo number_format($total_gasto_venta, 0, ",", ".") ?></div></th>

        <?php if ($cod_estado_habilitar_btn_facturar_mod_venta == '0') { ?>
        <?php if ($total_datos <> '0') { ?>
        <!--<td style="text-align:center;"><input type="image" src="../imagenes/guardar.png" name="vender" value="Guardar" /></td>-->
        <?php } ?>
        <?php } ?>

        <td style="text-align:center;"></td>

        <?php 
        $sql_temporal = "SELECT cod_gasto_inmueble_detalle_venta_temporal FROM tbl15_gasto_inmueble_detalle_venta_temporal WHERE (cuenta = '$cuenta_actual') AND (cod_caja_virtual = '$cod_caja_virtual')";
        $consulta_temporal = mysqli_query($conectar, $sql_temporal);
        $total_datos = mysqli_num_rows($consulta_temporal);
        while ($datos_temporal = mysqli_fetch_assoc($consulta_temporal)) { ?>
        <input type="hidden" name="cod_gasto_inmueble_detalle_venta_temporal[]" value="<?php echo $datos_temporal['cod_gasto_inmueble_detalle_venta_temporal']; ?>">
        <?php } ?>

        <?php $pagina ='facturacion_venta_temporal_producto_manual_pos.php'; ?>
        <input type="hidden" name="cod_info_gasto_inmueble_detalle_venta" value="<?php echo $cod_info_gasto_inmueble_detalle_venta ?>" size="10">
        <input type="hidden" name="total_datos" value="<?php echo $total_datos; ?>" size="4">
        <input type="hidden" name="pagina" value="<?php echo $pagina_local?>" size="15">
        <input type="hidden" name="flete" value="0" size="15">
        <input type="hidden" name="verificacion_envio" value="1" size="15">
        <input type="hidden" name="cod_estado_vacuna" value="0" size="15">
        </tr>
    </table>

</form>
