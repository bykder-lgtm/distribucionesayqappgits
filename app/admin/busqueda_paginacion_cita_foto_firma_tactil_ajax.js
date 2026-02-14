$(document).ready(function(){
	load(1);
});

function load(page){
	var busqueda_ajax= $("#busqueda_ajax").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'../admin/busqueda_paginacion_cita_foto_firma_tactil_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax,
		beforeSend: function(objeto){
			$('#loader').html('<img src="../imagenes/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})
}



function eliminar (id){
	var busqueda_ajax= $("#busqueda_ajax").val();
	if (confirm("Realmente deseas eliminar el proyecto?")){	
		$.ajax({
		type: "GET",
		url: "../admin/busqueda_paginacion_cita_foto_firma_tactil_ajax.php",
		data: "id="+id,"busqueda_ajax":busqueda_ajax,
		beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		},
		success: function(datos){
			$("#resultados").html(datos);
			load(1);
		}
		});
	}
}