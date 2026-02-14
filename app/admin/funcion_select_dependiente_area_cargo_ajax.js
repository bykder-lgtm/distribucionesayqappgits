$(function(){
	// Lista de tbl15_grupo_area
	$.post( '../admin/grupo_area_ajax.php' ).done( function(respuesta) {
		$( '#tbl15_grupo_area' ).html( respuesta );
	});
	// lista de tbl15_grupo_area_cargo	
	$('#tbl15_grupo_area').change(function() {
		var cod_grupo_area = $(this).val();
		// Lista de tbl15_grupo_area_cargo
		$.post( '../admin/grupo_area_cargo_ajax.php', { cod_grupo_area: cod_grupo_area} ).done( function( respuesta ) {
			$( '#tbl15_grupo_area_cargo' ).html( respuesta );
		});
	});
	// Lista de Ciudades
	$( '#tbl15_grupo_area_cargo' ).change( function() {
		var pais = $(this).children('option:selected').html();
	});

})