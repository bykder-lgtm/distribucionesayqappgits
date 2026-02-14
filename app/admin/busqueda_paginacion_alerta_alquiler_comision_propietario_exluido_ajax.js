$(document).ready(function(){
	load(1);
});

function load(page){	
	var cod_estado_hoy = $("#cod_estado_hoy").val();
	var cod_estado_pago = $("#cod_estado_pago").val();
	var buscar_por = $("#buscar_por").val();
	var busqueda_ajax = $("#busqueda_ajax").val();
	var fecha_alerta_ini = $("#fecha_alerta_ini").val();
	var fecha_alerta_fin = $("#fecha_alerta_fin").val();
	var action = "ajax";
	var tabla = $("#tabla").val();
	var pagina = $("#pagina").val();

	$("#loader").fadeIn('slow');
	$.ajax({
		url:'../admin/busqueda_paginacion_alerta_alquiler_comision_propietario_exluido_ajax.php?cod_estado_hoy='+cod_estado_hoy+'&fecha_alerta_ini='+fecha_alerta_ini+'&fecha_alerta_fin='+fecha_alerta_fin+'&cod_estado_pago='+cod_estado_pago+'&buscar_por='+buscar_por+'&busqueda_ajax='+busqueda_ajax+'&page='+page+'&action='+action+'&tabla='+tabla+'&pagina='+pagina,
		beforeSend: function(objeto){
			$('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})
}
