$(function(){
	// Lista de departamento
	$.post( 'select_empresa_ajax.php' ).done( function(respuesta) {
		$( '#cod_empresa' ).html( respuesta );
	});
	// lista de municipio	
	$('#cod_empresa').change(function() {
		var cod_empresa = $(this).val();
		// Lista de municipio
		$.post( 'select_cliente_ajax.php', { cod_empresa: cod_empresa} ).done( function( respuesta ) {
			$( '#cod_cliente' ).html( respuesta );
		});
	});
	// Lista de Ciudades
	$( '#cod_cliente' ).change( function() {
		var pais = $(this).children('option:selected').html();
	});

})