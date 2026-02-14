<!DOCTYPE html>
<html lang="es">
<!-- Basic -->
<head>
<link rel="stylesheet" href="../estilo_css/bootstrap.min_visitante.css">
<link rel="stylesheet" href="../estilo_css/estilo_pagina_visitante.css">
<link rel="stylesheet" href="../estilo_css/responsive_visitante.css">
<link rel="stylesheet" href="../estilo_css/font-awesome.min.css">
<link rel="stylesheet" href="../estilo_css/normalize_visitante.css">
<link rel="stylesheet" href="../estilo_css/facebook_messenger_flotante.css">
<link rel="stylesheet" href="../estilo_css/whatsapp_messenger_flotante.css">

<script src="../js/jquery-3.2.1.min_visitante.js"></script>
<script type="text/javascript" src="js/jquery.number.js"></script>
</head>

<body>

<div class="col-sm-6 col-md-6 col-lg-4 col-xl-4"><a class="agregar_carrito_compra" data-id="1001" id="1">Agregar</a></div>

<div class="rounded p-2 bg-light" id="div_madre">
	<div class="blog-test-cont">
		<p class="blog-test">Pulsa para probar</p>
	</div>
</div>

	<div class="media mb-2 border-bottom" id="elim1">
	    <div class="media-body"><a class="eliminar" data="1" id="cod_venta_producto_temporal1"><i class="fas fa-times"></i></a><span class="mx-2">|</span><a href="#">RON MEDELLIN</a><span class="mx-2">|</span>10:20
	        <div class="small text-muted">Precio: $120.000<span class="mx-2">|</span>Cant: 1<span class="mx-2">|</span>Total: $120.000</div>
	    </div>
	</div>

<script type="text/javascript">
$(document).ready(function() {

     
      $("body").on("click","a.agregar_carrito_compra",function(event){
            event.preventDefault();
             
            alert("Probando asignación");

      });
 
      // Generamos el enlace dinámicamente
 


	var bt_count = 0;

	//$(".agregar_carrito_compra").on("click", ".blog-test", function(){
		//$(this).before("<p class=\"blog-test\">Pulsa para probar " + (++bt_count) + "</p>");
	//});

	$(".media mb-2 border-bottom").on("click", ".eliminar", function(){
		$(this).after("<p class=\"blog-test\">Pulsa para probar " + (++bt_count) + "</p>");
	});


$("#tabla-fija").on('click','.eliminar', function() {
console.log('hola click');
});

});
</script>
</body>
</html>