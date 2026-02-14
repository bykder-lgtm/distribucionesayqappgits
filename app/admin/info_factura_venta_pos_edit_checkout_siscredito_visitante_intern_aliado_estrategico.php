<script language="javascript">
$(document).ready(function(){
    $("input").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "<?php echo $tipo_ajax;?>";
        var id = $(this).attr("class");
        var cod_seguridad = <?php echo $cod_seguridad;?>;
        var cod_estado_modificar_und_venta_una_sola_vez_global = <?php echo $cod_estado_modificar_und_venta_una_sola_vez_global;?>;
        var cod_estado_bascula_balanza_electronica_pesar_producto_global = <?php echo $cod_estado_bascula_balanza_electronica_pesar_producto_global;?>;
        var pagina_local = "<?php echo $pagina_local;?>";
        var foco = '';

        console.log("id atrib class = "+id);
        console.log("id atrib class = "+id);

        var nombre_campo_incre = $(this).attr("id");
        let framentador_nombre = nombre_campo_incre.split("und_venta");
        var nombre_campo = framentador_nombre[0];
        var increm = framentador_nombre[1];

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id+'&'+'foco='+foco+'&'+'nombre_campo_incre='+nombre_campo_incre;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php",
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


                $("#total_venta").html(total_venta);
                $("#div_und_caja_sobre"+incre).html(und_venta);
                $("#total_venta_producto"+incre).html(total_venta_producto);
                $("#und_venta"+incre).val(und_venta);
                $("#error_identificacion_repetida").html(respuesta);

                if ((cod_estado_modificar_und_venta_una_sola_vez_global == '1') && (cod_seguridad != '1')) {
                    if (nombre_campo == "") {
                        $("#"+nombre_campo_incre).attr("disabled",true);
                        console.log("increm = "+increm);
                        $("#cod_estado_componente_und_venta"+increm).val("1");
                    }
                }
                if (ok_ajax == 'REFRESCAR_BASCULA') { 
                    window.location.href = pagina_local;
                }
            }
        });
    });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $('select[name="cod_origen_produccion"]').change(function(){  
    //$("#cod_origen_produccion").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "<?php echo $tipo_ajax;?>";
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
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php",
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
<script language="javascript">
$(document).ready(function(){
    $('select[name="nombre_tipo_cobro"]').change(function(){  
    //$("#nombre_tipo_cobro").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "<?php echo $tipo_ajax;?>";
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
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php",
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
<script language="javascript">
$(document).ready(function(){
    $('input[name="comentario_producto"]').keydown(function(){  
    //$("#cod_origen_produccion").on('change', function () {
        var valor = $(this).val();
        var campo = $(this).attr("name");
        var tipo_ajax = "<?php echo $tipo_ajax;?>";
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
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php",
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
    $("#fecha_anyo").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_anyo";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_domiciliario").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_domiciliario";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_administrador").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_administrador";
        var tipo_ajax = "tbl15_info_factura_venta";
        var id = "<?php echo $cod_info_factura_venta; ?>";
        var pagina_local = "<?php echo $pagina_local; ?>";

        var datos_url_ajax = 'valor='+valor+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'id='+id;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var cuenta = respuesta.cuenta;
                var cod_caja_virtual = respuesta.cod_caja_virtual;
                var cod_info_factura_venta = respuesta.cod_info_factura_venta;
                var afectado = respuesta.afectado;
                var ok_ajax = respuesta.ok_ajax;

                if (afectado == 'SI') { 
                    window.location.href = pagina_local+"?cuenta="+cuenta+"&cod_caja_virtual="+cod_caja_virtual+"&cod_info_factura_venta="+cod_info_factura_venta;
                }
            }
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_tercero").on('change', function () {
        $("#cod_tercero option:selected").each(function () {
            var valor = $(this).val();
            var campo = "cod_tercero";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                //$("#cod_cliente").html(data);
            });     
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_metodo_envio").on('change', function () {
            var valor = $(this).val();
            var campo = "cod_tipo_metodo_envio";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#nombre1_tercero").on('change', function () {
            var valor = $(this).val();
            var campo = "nombre1_tercero";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#fecha_entrega").on('change', function () {
            var valor = $(this).val();
            var campo = "fecha_entrega";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#observacion_tercero").on('change', function () {
            var valor = $(this).val();
            var campo = "observacion_tercero";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_venta";
            var id = $(this).attr("class");
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
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
            var tipo_ajax = "tbl15_info_factura_venta";
            var id = $(this).attr("class");
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, id:id }, function(data){
                $("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_pago").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_tipo_pago";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            $("#modelo").html(data);
            window.location.href = pagina_local;
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--
<script>
$(document).ready(function(){
    var cod_tipo_pago = $("#cod_tipo_pago").val();

        if (cod_tipo_pago == '1') {
            document.getElementById("fecha_pago").style.display = 'none';
        } else {
            document.getElementById("fecha_pago").style.display = 'block';
        }

    $("#cod_tipo_pago").change(function(){
    var cod_tipo_pago = document.getElementById('cod_tipo_pago').value;

        if (cod_tipo_pago == "1") {
            document.getElementById('fecha_pago').style.display = 'none';
        } else {
            document.getElementById('fecha_pago').style.display = 'block';
        }
    });

});
</script>
-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_forma_pago").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_tipo_forma_pago";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            $("#modelo").html(data);

            window.location.href = pagina_local;
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--
<script>
$(document).ready(function(){
    var cod_tipo_forma_pago = $("#cod_tipo_forma_pago").val();

        if (cod_tipo_forma_pago == '1') {
            document.getElementById("<?php echo $cod_info_factura_venta ?>").style.display = 'none';
        } else {
            document.getElementById("<?php echo $cod_info_factura_venta ?>").style.display = 'block';
        }

    $("#cod_tipo_forma_pago").change(function(){
    var cod_tipo_forma_pago = document.getElementById('cod_tipo_forma_pago').value;

        if (cod_tipo_forma_pago == "1") {
            document.getElementById('<?php echo $cod_info_factura_venta ?>').style.display = 'none';
        } else {
            document.getElementById('<?php echo $cod_info_factura_venta ?>').style.display = 'block';
        }
    });
});
</script>
-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_resolucion_facturacion").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_resolucion_facturacion";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_entidad_crediticia").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_entidad_crediticia";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_tienda").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_tienda";
        var tipo_ajax = "tbl15_info_factura_venta";
        var id = "<?php echo $cod_info_factura_venta;?>";
        var nombre_modulo_puc = "<?php echo $nombre_modulo_puc;?>";
        var pagina_local = "<?php echo $pagina_local;?>";

        var datos_url_ajax = "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax+"&nombre_modulo_puc="+nombre_modulo_puc+"&id="+id;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#btn_guardar_registro_modal').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var afectado = respuesta.afectado;
                var cod_info_factura_venta = respuesta.cod_info_factura_venta;
                var ok_ajax = respuesta.ok_ajax;

                if (afectado ==  'SI') {
                    window.location.reload();
                }
            }
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_operador_credito").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_operador_credito";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_tipo_forma_pago_operador_credito").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_tipo_forma_pago_operador_credito";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_administrador_lider").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_administrador_lider";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_administrador_coordinador").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_administrador_coordinador";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_administrador_asesor").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_administrador_asesor";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_administrador_aliado_estrategico").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_administrador_aliado_estrategico";
        var tipo_ajax = "tbl15_info_factura_venta";
        var id = "<?php echo $cod_info_factura_venta;?>";
        var nombre_modulo_puc = "<?php echo $nombre_modulo_puc;?>";
        var pagina_local = "<?php echo $pagina_local;?>";

        var datos_url_ajax = "valor="+valor+"&campo="+campo+"&tipo_ajax="+tipo_ajax+"&nombre_modulo_puc="+nombre_modulo_puc+"&id="+id;

        $.ajax({
            type: "POST",
            url: "../admin/guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php",
            data: datos_url_ajax,
            //dataType: 'json',
            beforeSend: function(objeto){
                $('#btn_guardar_registro_modal').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
            },
            success:function(respuesta){
                var afectado = respuesta.afectado;
                var cod_info_factura_venta = respuesta.cod_info_factura_venta;
                var ok_ajax = respuesta.ok_ajax;

                if (afectado ==  'SI') {
                    window.location.reload();
                }

            }
        });

   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_administrador_revisor").on('change', function () {
        var valor = $(this).val();
        var campo = "cod_administrador_revisor";
        var tipo_ajax = "tbl15_info_factura_venta";
        var pagina_local = "<?php echo $pagina_local;?>";

        $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
            //$("#modelo").html(data);
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_banco_cuenta").on('change', function () {
        $("#cod_banco_cuenta option:selected").each(function () {
            var valor = $(this).val();
            var campo = "cod_banco_cuenta";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                //$("#cod_cliente").html(data);
            });     
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<script language="javascript">
$(document).ready(function(){
    $("#cod_vendedor").on('change', function () {
        $("#cod_vendedor option:selected").each(function () {
            var valor = $(this).val();
            var campo = "cod_vendedor";
            var tipo_ajax = "tbl15_info_factura_venta";
            $.post("guardar_info_factura_y_venta_producto_temporal_siscredito_visitante_intern_ajax.php", { valor:valor, campo:campo, tipo_ajax:tipo_ajax, nombre_modulo_puc:"<?php echo $nombre_modulo_puc; ?>", id:<?php echo $cod_info_factura_venta; ?> }, function(data){
                //$("#cod_cliente").html(data);
            });     
        });
   });
});
</script>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php
if ($nombre_estado_factura == 'ABIERTA') {
    $pagina_redirect_regresar = '../admin/ver_info_factura_venta_abierta_siscredito_visitante_intern_aliado_estrategico.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&modo_venta_por_defecto='.$modo_venta_por_defecto.'&pagina='.$pagina;
} else {
    $pagina_redirect_regresar = '../admin/ver_info_factura_venta_cerrada_siscredito_visitante_intern_aliado_estrategico.php?cod_info_factura_venta='.$cod_info_factura_venta.'&cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&modo_venta_por_defecto='.$modo_venta_por_defecto.'&pagina='.$pagina;
}
?>
    <?php include_once("../admin/modal_editar_tercero_factura_venta_revisor.php"); ?>
    <?php include_once("../admin/modal_editar_valor_credito_factura_venta_revisor.php"); ?>
    <?php include_once("../admin/modal_reg_nuevo_vendedor_revisor.php"); ?>
    <?php include_once("../admin/modal_reg_nuevo_banco_cuenta_revisor.php"); ?>
    <?php include_once("../admin/modal_reg_nuevo_tienda_revisor.php"); ?>
<!-- Start Cart -->
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                    <div class="contact-form-right">
                        <div class="row title-left">

                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                <div class=""><a href="<?php echo $pagina_redirect_regresar ?>"><i class="fa fa-undo fa-2x"></i></a></div>
                            </div>

                            <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                                <div class=""><h3><?php echo $nombre_tipo_transaccion ?></h3></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="contact-form-right">
                        <form action="../admin/reg_siscredito_tercero_cliente_simulador_por_cuotas_max_entidad_crediticia_reg.php" method="post" id="contactForm">
                            <div class="row">

                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                    <div class="form-group"><strong>Cliente / Comprador</strong>
                                        <br><?php echo $nombre_cliente ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                    <div class="form-group"><strong>Detalle del Credito</strong>
                                        <br>
                                        Total Credito: <?php echo number_format($monto_deuda, 0, ",", "."); ?>
                                        <br>
                                        Cuota: <?php echo number_format($monto_cuota, 0, ",", "."); ?>
                                        <br>
                                        Numero de Cuotas: <?php echo $numero_cuota.' '.$nombre_tipo_cobro; ?>
                                        <br>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                    <div class="form-group"><strong>Tienda <a href="#" onclick="obtener_datos_nuevo_tienda_factura_venta_modal('<?php echo $cod_info_factura_venta; ?>');" data-toggle="modal" data-target=".abrir_previsualizacion_datos_nuevo_tienda"><i class="fa fa-plus-circle fa-2x"></i></a></strong>
                                        <select name="cod_tienda" id="cod_tienda" class="form-control" data-show-subtext="true" data-live-search="true" tabindex="1" required>
                                            <?php if (isset($cod_tienda)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                                            $consulta2_sql = "SELECT cod_tienda, nombre_tienda FROM tbl15_tienda WHERE (cod_aliado_estrategico = '$cod_administrador_aliado_estrategico') ORDER BY cod_tienda DESC";
                                            $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                            if(isset($cod_tienda) AND $cod_tienda == $datos2['cod_tienda']) {
                                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                                            $codigo = $datos2['cod_tienda'];
                                            $nombre = $datos2['nombre_tienda'].' | '.$datos2['cod_tienda'];
                                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                    <div class="form-group"><strong>Vendedor <a href="#" onclick="obtener_datos_nuevo_vendedor_factura_venta_modal('<?php echo $cod_info_factura_venta; ?>');" data-toggle="modal" data-target=".abrir_previsualizacion_datos_nuevo_vendedor"><i class="fa fa-plus-circle fa-2x"></i></a></strong>
                                        <select name="cod_vendedor" id="cod_vendedor" class="form-control" data-show-subtext="true" data-live-search="true" tabindex="1" required>
                                            <?php if (isset($cod_vendedor)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                                            $consulta2_sql = "SELECT cod_vendedor, cuenta, nombres, apellidos FROM tbl15_vendedor WHERE (cod_aliado_estrategico = '$cod_administrador_aliado_estrategico') ORDER BY cod_vendedor DESC";
                                            $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                            if(isset($cod_vendedor) AND $cod_vendedor == $datos2['cod_vendedor']) {
                                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                                            $codigo = $datos2['cod_vendedor'];
                                            $nombre = $datos2['nombres'].' '.$datos2['apellidos'].' | '.$datos2['cod_vendedor'];
                                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                    <div class="form-group"><strong>Cuenta de Banco <a href="#" onclick="obtener_datos_nuevo_banco_cuenta_factura_venta_modal('<?php echo $cod_info_factura_venta; ?>');" data-toggle="modal" data-target=".abrir_previsualizacion_datos_nuevo_banco_cuenta"><i class="fa fa-plus-circle fa-2x"></i></a></strong>
                                        <select name="cod_banco_cuenta" id="cod_banco_cuenta" class="form-control" data-show-subtext="true" data-live-search="true" tabindex="1" required>
                                            <?php if (isset($cod_banco_cuenta)) { echo "<option value='' selected >Seleccione</option>"; } else { echo "<option value='' selected >Seleccione</option>"; }
                                            $consulta2_sql = "SELECT cod_banco_cuenta, nombre_banco_cuenta, numero_banco_cuenta, nombre_titular_cuenta 
                                            FROM tbl15_banco_cuenta WHERE (cod_aliado_estrategico = '$cod_administrador_aliado_estrategico' AND cod_estado = '1') ORDER BY cod_banco_cuenta DESC";
                                            $consulta2 = mysqli_query($conectar, $consulta2_sql);
                                            while ($datos2 = mysqli_fetch_assoc($consulta2)) {
                                            if(isset($cod_banco_cuenta) AND $cod_banco_cuenta == $datos2['cod_banco_cuenta']) {
                                            $seleccionado = "selected"; } else { $seleccionado = ""; }
                                            $codigo = $datos2['cod_banco_cuenta'];
                                            $nombre = $datos2['nombre_banco_cuenta'].' | '.$datos2['numero_banco_cuenta'].' | '.$datos2['nombre_titular_cuenta'].' | '.$datos2['cod_banco_cuenta'];
                                            echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                    <div class="form-group"><strong>Linea de Credito</strong>
                                        <br><?php echo $nombre_entidad_crediticia ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <!--
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                    <div class="form-group"><strong>Operador del Credito</strong>
                                        <br><?php echo $nombre_operador_credito ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                    <div class="form-group"><strong>Medio de Pago Credito</strong>
                                        <br><?php echo $nombre_tipo_forma_pago_operador_credito ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                -->
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group"><strong>Observaciones</strong>
                                        <textarea class="form-control" name="observacion_tercero" id="observacion_tercero" placeholder="" rows="2" cols="5"><?php echo $observacion_tercero ?></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>


                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-xxl-2">
                                    <div class="form-group"><strong>Fecha</strong>
                                        <br><?php echo $fecha_anyo ?>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <hr>