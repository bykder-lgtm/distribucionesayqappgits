$(document).ready(function(){
	load(1);
});

function load(page){	
	var nombre_tabla_anyo = $("#nombre_tabla_anyo").val();
	var cod_estado_pago = $("#cod_estado_pago").val();
	var cod_estado_envio_correo_cuenta_cobro = $("#cod_estado_envio_correo_cuenta_cobro").val();
	var action = "ajax";
	var tabla = $("#tabla").val();
	var cod_estado_hoy = $("#cod_estado_hoy").val();
	var buscar_por = $("#buscar_por").val();
	var pagina = $("#pagina").val();

	$("#loader").fadeIn('slow');
	$.ajax({
		url:'../admin/busqueda_paginacion_cuenta_cobro_alquiler_historial_ajax.php?nombre_tabla_anyo='+nombre_tabla_anyo+'&cod_estado_pago='+cod_estado_pago+'&cod_estado_envio_correo_cuenta_cobro='+cod_estado_envio_correo_cuenta_cobro+'&pagina='+pagina+'&page='+page+'&action='+action+'&tabla='+tabla+'&cod_estado_hoy='+cod_estado_hoy+'&buscar_por='+buscar_por, 
		beforeSend: function(objeto){
			$('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})
}
