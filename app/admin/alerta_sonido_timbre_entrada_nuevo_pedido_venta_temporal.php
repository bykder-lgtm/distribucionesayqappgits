<script language="javascript">
setInterval("refrescar_timbre_entrada_nuevo_pedido_venta_temporal_ajax()",30000);

function refrescar_timbre_entrada_nuevo_pedido_venta_temporal_ajax(){

	var verificar_pedido_venta_temporal = 'SI';
	var tipo_ajax = 'refrescar';
    var pagina = 'pag.php';

    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "../admin/refrescar_alerta_sonido_timbre_entrada_nuevo_pedido_venta_temporal_ajax.php",
        data: "verificar_pedido_venta_temporal="+verificar_pedido_venta_temporal+"&tipo_ajax="+tipo_ajax+"&pagina="+pagina,
        success: function(resp){
            $('#refrescar_automatico_ajax').html(resp);
        }
    })
}
</script>