<script>
var cod_info_factura_venta = "1";
var cod_tipo_pago = "1";
var conexion_internet = "SI";
var tiempo_espera_resp = "NO";
var pagina = "PAG";

var milisegundos = 1000;
var tiempo_espera_respuesta_factura_venta_electronica_global = 5 + 1;
var segundos_espera = (milisegundos * tiempo_espera_respuesta_factura_venta_electronica_global);
const tiempo_repeticion_ciclo = milisegundos / 1;

var url_redirect = '../admin/venta_productos_opcion_imprimir.php'+'?'+'cod_info_factura_venta='+cod_info_factura_venta+'&cod_tipo_pago='+cod_tipo_pago+'&conexion_internet='+conexion_internet+'&tiempo_espera_resp='+tiempo_espera_resp+'&pagina='+pagina;
	//location.href = url_redirect;

const ciclo_conteo = () => {
	tiempo_espera_respuesta_factura_venta_electronica_global--;

	if (tiempo_espera_respuesta_factura_venta_electronica_global > '1') {
		setTimeout(ciclo_conteo, tiempo_repeticion_ciclo);
	}

	document.getElementById("segundos_cronometro").innerHTML=""+tiempo_espera_respuesta_factura_venta_electronica_global;

	if (tiempo_espera_respuesta_factura_venta_electronica_global == '1') {
		document.getElementById("redirecionar_imprimir").innerHTML = "<a href="+url_redirect+">"+"<img src=../imagenes/imprimir_directa_pos.png>"+"</a>";
	}
}

if (tiempo_espera_respuesta_factura_venta_electronica_global > '1') {
	setTimeout(ciclo_conteo, tiempo_repeticion_ciclo);
}
</script>

<table class="table table-striped">
	<thead>
		<tr>
			<th style="text-align:center"><img src="../imagenes/ajax-loader.gif"><br>Enviando Factura Electronica...</th>
		</tr>
		<tr>
			<th style="text-align:center" id="segundos_cronometro"></th>
		</tr>
		<tr>
			<th style="text-align:center" id="redirecionar_imprimir"></th>
		</tr>
	</thead>
</table>