<script language="javascript">
setInterval("mandar_aviso_timbre_pagina_ajax()", 3000);

function mandar_aviso_timbre_pagina_ajax(){

    var nombre_estado_factura = 'ABIERTA';
    var cod_estado_cocina = '0';
    var tipo_ajax = 'refrescar';
    var cuenta = "<?php echo $cuenta_actual;?>";
    var cod_administrador = <?php echo $cod_administrador;?>;

    var datos_url_ajax = 'nombre_estado_factura='+nombre_estado_factura+'&'+'cuenta='+cuenta+'&'+'cod_administrador='+tipo_ajax+'&'+'cod_administrador='+cod_administrador;

    $.ajax({
        type: "POST",
        url: "../admin/aviso_timbre_despachado_vendedor_cocina_facturacion_venta_temporal_producto_manual_pos_ajax.php",
        data: datos_url_ajax,
        //dataType: 'json',
        beforeSend: function(objeto){
            $('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
        },
        success:function(respuesta){
            var salida_aviso_tombre_despachado_vendedor_cocina_ajax = respuesta.salida_aviso_tombre_despachado_vendedor_cocina_ajax;
            $('#salida_aviso_tombre_despachado_vendedor_cocina_ajax').html(salida_aviso_tombre_despachado_vendedor_cocina_ajax);
        }
    });
}
</script>