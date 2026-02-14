<input type="number" class="form-control" name="precio_venta_producto_formateado" id="precio_venta_producto_formateado" min='0' value="" placeholder="" required>
<input type="number" class="form-control" name="precio_venta_producto" id="precio_venta_producto" min='0' value="" placeholder="" required>

<script language="javascript">
const precio_venta_producto_formateado = document.getElementById('precio_venta_producto_formateado');

precio_venta_producto_formateado.addEventListener('keyup', (e) => {
	const valor_entrada_retroalimentado = e.target.value;
	const numeroFormateado = formatearNumero(valor_entrada_retroalimentado);
	e.target.value = numeroFormateado;
	console.log("e = "+e);
	//document.getElementById('precio_venta_producto').value(""+numeroFormateado);
});

function formatearNumero(numero) {
	// Elimina todos los caracteres que no sean dígitos
	let valorNumerico = String(numero).replace(/\D/g, '');
	// Formatea el número según la configuración regional del navegador
	// Puedes especificar una locale, como 'es-ES' para España o 'en-US' para Estados Unidos
	return valorNumerico === '' ? valorNumerico : Number(valorNumerico).toLocaleString("es-CO");
}
</script>