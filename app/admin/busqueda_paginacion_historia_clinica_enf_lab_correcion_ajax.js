$(document).ready(function(){
	load(1);
});

function load(page){
	var busqueda_ajax= $("#busqueda_ajax").val();
	var numero_registro_por_pagina= $("#numero_registro_por_pagina").val();
	var buscar_por= $("#buscar_por").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'../admin/busqueda_paginacion_historia_clinica_enf_lab_correcion_ajax.php?action=ajax&page='+page+'&busqueda_ajax='+busqueda_ajax+'&numero_registro_por_pagina='+numero_registro_por_pagina+'&buscar_por='+buscar_por,
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
	var numero_registro_por_pagina= $("#numero_registro_por_pagina").val();
	var buscar_por= $("#buscar_por").val();
	if (confirm("Realmente deseas eliminar el proyecto?")){	
		$.ajax({
		type: "GET",
		url: "../admin/busqueda_paginacion_historia_clinica_enf_lab_correcion_ajax.php",
		data: "id="+id,"busqueda_ajax":busqueda_ajax,"numero_registro_por_pagina":numero_registro_por_pagina,"buscar_por":buscar_por,
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