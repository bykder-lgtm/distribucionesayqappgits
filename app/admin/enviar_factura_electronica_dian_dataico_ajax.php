<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php //$pagina = addslashes($_GET['pagina']); ?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">

<div class="breadcrumbs"></div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<div class="table-responsive">


<?php if (isset($_GET['cod_info_factura_venta'])) { 
	$cod_info_factura_venta                 = intval($_GET['cod_info_factura_venta']);
	$cod_tipo_pago                          = intval($_GET['cod_tipo_pago']);
	$conexion_internet                      = addslashes($_GET['conexion_internet']);
	$pagina                                 = addslashes($_GET['pagina']);
	$datos_url_ajax                         = '../admin/venta_productos_opcion_imprimir.php'.'?'.'cod_info_factura_venta='.$cod_info_factura_venta.'&'.'pagina='.$pagina;

	$sql_info_factura_venta = "SELECT cod_factura, cod_tercero, cod_resolucion_facturacion FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	$consulta_info_factura_venta = mysqli_query($conectar, $sql_info_factura_venta) or die(mysqli_error($conectar));
	$matriz_info_factura_venta = mysqli_fetch_assoc($consulta_info_factura_venta);

	$cod_factura                            = $matriz_info_factura_venta['cod_factura'];
	$cod_tercero                            = $matriz_info_factura_venta['cod_tercero'];
	$cod_resolucion_facturacion             = $matriz_info_factura_venta['cod_resolucion_facturacion'];

	$sql_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion')";
	$consulta_resolucion_facturacion = mysqli_query($conectar, $sql_resolucion_facturacion) or die(mysqli_error($conectar));
	$matriz_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

	$cod_tipo_resolucion_facturacion        = $matriz_resolucion_facturacion['cod_tipo_resolucion_facturacion'];
	$nombre_tipo_resolucion_facturacion     = $matriz_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
	$numero_resolucion_facturacion          = $matriz_resolucion_facturacion['numero_resolucion_facturacion'];
	$ini_resolucion_facturacion             = $matriz_resolucion_facturacion['ini_resolucion_facturacion'];
	$fin_resolucion_facturacion             = $matriz_resolucion_facturacion['fin_resolucion_facturacion'];
	$prefijo_resolucion_facturacion         = $matriz_resolucion_facturacion['prefijo_resolucion_facturacion'];
	$fecha_resolucion_facturacion           = $matriz_resolucion_facturacion['fecha_resolucion_facturacion'];
	$vigencia_meses_resolucion_facturacion  = $matriz_resolucion_facturacion['vigencia_meses_resolucion_facturacion'];
	$nombre_tipo_estado                     = $matriz_resolucion_facturacion['nombre_tipo_estado'];
?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th style="text-align:center"><img src="../imagenes/ajax-loader.gif"><br>Enviando Factura Electronica <?php echo $prefijo_resolucion_facturacion.$cod_factura; ?></th>
			</tr>
			<tr>
				<th style="text-align:center" id="segundos_cronometro_redirecionar_imprimir"></th>
			</tr>
		</thead>
	</table>

	<script>
	$(document).ready(function() {

	    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta;?>";
	    var tab = "tbl15_info_factura_venta";
	    var campo = "cod_info_factura_venta";
	    var tipo_ajax = "tbl15_info_factura_venta";
	    var cod_tipo_pago = "<?php echo $cod_tipo_pago;?>";
	    var conexion_internet = "<?php echo $conexion_internet;?>";
	    var pagina = "<?php echo $pagina;?>";
	    var pagina_redirect_imprimir = '../admin/venta_productos_opcion_imprimir.php'+'?'+'cod_info_factura_venta='+cod_info_factura_venta+'&cod_tipo_pago='+cod_tipo_pago+'&conexion_internet='+conexion_internet+'&pagina='+pagina

	    var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina;

	    $.ajax({
	        type: "GET",
	        url: "../admin/enviar_datos_factura_venta_dian_json.php",
	        data: datos_url_ajax,
	        //dataType: 'json',
	        beforeSend: function(objeto){
	            //$('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
	        },
	        success:function(respuesta){

	            if(respuesta.errors) {
	                var dataico_dian_error = respuesta.errors[0].error;
	                var dataico_dian_path = respuesta.errors[0].path;
	                var error_respuesta = "Error";
	                var imagen_status_error = "../imagenes/error.jpg";
	                var imagen_status_dian = "../imagenes/btn_dian_peq_gris.png";
	                var imagen_status_dataico = "../imagenes/btn_dataico_gris.png";
	                var resultado_envio_dian = "No Enviado a la Dian";
	                var resultado_envio_dataico = "No Enviado a Dataico";

	    			var datos_url_ajax = 'id='+cod_info_factura_venta+'&'+'cod_info_factura_venta='+cod_info_factura_venta+'&'+'tab='+tab+'&'+'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'pagina='+pagina+'&'+'dataico_dian_error='+dataico_dian_error+'&'+'dataico_dian_path='+dataico_dian_path;
	                $.ajax({
	                    type: "POST",
	                    url: "../admin/guardar_factura_venta_enviada_error_dian_dataico_json_ajax.php",
	                    data: datos_url_ajax,
	                    beforeSend: function(objeto){
	                        //$('#loader').html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
	                    },
	                    success:function(respuesta){
	                        location.href = pagina_redirect_imprimir;
	                    }
	                });
	              	//$('#enviando_cargador'+cod_info_factura_venta).html("");
	                //$('#resultado_error_envio_dian_dataico'+cod_info_factura_venta).html("<img src="+imagen_status_error+" class='img-polaroid'>"+"<br>"+dataico_dian_error+" ["+dataico_dian_path+"]");
	            } else {
	            	if (respuesta.number) { var cod_factura_prefijo = respuesta.number; } else { var cod_factura_prefijo = ''; }
	            	if (respuesta.numbering.prefix) { var prefijo_resolucion_facturacion = respuesta.numbering.prefix; } else { var prefijo_resolucion_facturacion = ''; }
	            	if (respuesta.numbering.resolution_number) { var numero_resolucion_facturacion = respuesta.numbering.resolution_number; } else { var numero_resolucion_facturacion = ''; }
	            	if (respuesta.email_status) { var dataico_email_status = respuesta.email_status; } else { var dataico_email_status = ''; }
	            	if (respuesta.uuid) { var dataico_uuid = respuesta.uuid; } else { var dataico_uuid = ''; }
	            	if (respuesta.cufe) { var cod_cufe = respuesta.cufe; } else { var cod_cufe = ''; }
	            	if (respuesta.issue_date) { var dataico_issue_date = respuesta.issue_date; } else { var dataico_issue_date = ''; }
	            	if (respuesta.dian_messages) { var dataico_dian_messages = respuesta.dian_messages; } else { var dataico_dian_messages = ''; }
	            	if (respuesta.payment_date) { var dataico_payment_date = respuesta.payment_date; } else { var dataico_payment_date = ''; }
	            	if (respuesta.customer_status) { var dataico_customer_status = respuesta.customer_status; } else { var dataico_customer_status = ''; }
	            	if (respuesta.xml_url) { var dataico_xml_url = respuesta.xml_url; } else { var dataico_xml_url = ''; }
	            	if (respuesta.validation_date) { var dataico_validation_date = respuesta.validation_date; } else { var dataico_validation_date = ''; }
	            	if (respuesta.qrcode) { var dataico_qrcode = respuesta.qrcode; } else { var dataico_qrcode = ''; }
	            	if (respuesta.xml) { var dataico_xml = respuesta.xml; } else { var dataico_xml = ''; }
	            	if (respuesta.invoice_type_code) { var dataico_invoice_type_code = respuesta.invoice_type_code; } else { var dataico_invoice_type_code = ''; }
	            	if (respuesta.pdf_url) { var dataico_pdf_url = respuesta.pdf_url; } else { var dataico_pdf_url = ''; }
	            	if (respuesta.dian_status) { var dataico_dian_status = respuesta.dian_status; } else { var dataico_dian_status = ''; }

	                if (dataico_dian_status == 'DIAN_ACEPTADO') {
	                    var cod_estado_factura_electronica_enviado_dian = 1;
	                    var cod_estado_factura_electronica_enviado_dataico = 1;
						var datos_url_ajax = 'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_factura_prefijo='+cod_factura_prefijo+'&'+'prefijo_resolucion_facturacion='+prefijo_resolucion_facturacion+'&'+'numero_resolucion_facturacion='+numero_resolucion_facturacion+'&'+'cod_estado_factura_electronica_enviado_dian='+cod_estado_factura_electronica_enviado_dian+'&'+'cod_estado_factura_electronica_enviado_dataico='+cod_estado_factura_electronica_enviado_dataico+'&'+'dataico_email_status='+dataico_email_status+'&'+'dataico_uuid='+dataico_uuid+'&'+'cod_cufe='+cod_cufe+'&'+'dataico_issue_date='+dataico_issue_date+'&'+'dataico_dian_messages='+dataico_dian_messages+'&'+'dataico_payment_date='+dataico_payment_date+'&'+'dataico_customer_status='+dataico_customer_status+'&'+'dataico_xml_url='+dataico_xml_url+'&'+'dataico_validation_date='+dataico_validation_date+'&'+'dataico_qrcode='+dataico_qrcode+'&'+'dataico_xml='+dataico_xml+'&'+'dataico_invoice_type_code='+dataico_invoice_type_code+'&'+'dataico_pdf_url='+dataico_pdf_url+'&'+'dataico_dian_status='+dataico_dian_status;
	                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
	                    $.ajax({
	                        type: "POST",
	                        url: "../admin/guardar_factura_venta_enviada_dian_dataico_json_ajax.php",
	                        data: datos_url_ajax,
	                        beforeSend: function(objeto){
		                        //$('#estadodian'+cod_info_factura_venta).html("");
		                        //$('#estadodataico'+cod_info_factura_venta).html("");
	                            //$('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
	                        },
	                        success:function(respuesta){
	                            var cod_info_factura_venta = respuesta.cod_info_factura_venta;
	                            var cod_estado_factura_electronica_enviado_dian = respuesta.cod_estado_factura_electronica_enviado_dian;
	                            var cod_estado_factura_electronica_enviado_dataico = respuesta.cod_estado_factura_electronica_enviado_dataico;
	                            var resultado_envio_dian = respuesta.resultado_envio_dian;
	                            var resultado_envio_dataico = respuesta.resultado_envio_dataico;
	                            var imagen_status_dian = "../imagenes/btn_dian_peq.png";
	                            var imagen_status_dataico = "../imagenes/btn_dataico.png";
	                           	location.href = pagina_redirect_imprimir;

	                            //$('#resultado_envio_dian'+cod_info_factura_venta).html("<img src="+imagen_status_dian+" class='img-polaroid'>"+"<br>"+resultado_envio_dian);
	                            //$('#resultado_envio_dataico'+cod_info_factura_venta).html("<img src="+imagen_status_dataico+" class='img-polaroid'>"+"<br>"+resultado_envio_dataico);
	                          	//$('#enviando_cargador'+cod_info_factura_venta).html("");
	                        }
	                    });
	                } 
	                if (dataico_dian_status == 'DIAN_NO_ENVIADO') {
	                    var cod_estado_factura_electronica_enviado_dian = 0;
	                    var cod_estado_factura_electronica_enviado_dataico = 1;
						var datos_url_ajax = 'campo='+campo+'&'+'tipo_ajax='+tipo_ajax+'&'+'cod_factura_prefijo='+cod_factura_prefijo+'&'+'prefijo_resolucion_facturacion='+prefijo_resolucion_facturacion+'&'+'numero_resolucion_facturacion='+numero_resolucion_facturacion+'&'+'cod_estado_factura_electronica_enviado_dian='+cod_estado_factura_electronica_enviado_dian+'&'+'cod_estado_factura_electronica_enviado_dataico='+cod_estado_factura_electronica_enviado_dataico+'&'+'dataico_email_status='+dataico_email_status+'&'+'dataico_uuid='+dataico_uuid+'&'+'cod_cufe='+cod_cufe+'&'+'dataico_issue_date='+dataico_issue_date+'&'+'dataico_dian_messages='+dataico_dian_messages+'&'+'dataico_payment_date='+dataico_payment_date+'&'+'dataico_customer_status='+dataico_customer_status+'&'+'dataico_xml_url='+dataico_xml_url+'&'+'dataico_validation_date='+dataico_validation_date+'&'+'dataico_qrcode='+dataico_qrcode+'&'+'dataico_xml='+dataico_xml+'&'+'dataico_invoice_type_code='+dataico_invoice_type_code+'&'+'dataico_pdf_url='+dataico_pdf_url+'&'+'dataico_dian_status='+dataico_dian_status;
	                    
	                    $.ajax({
	                        type: "POST",
	                        url: "../admin/guardar_factura_venta_enviada_dataico_json_ajax.php",
	                        data: datos_url_ajax,
	                        beforeSend: function(objeto){
		                        //$('#estadodian'+cod_info_factura_venta).html("");
		                        //$('#estadodataico'+cod_info_factura_venta).html("");
	                            //$('#apidian'+cod_info_factura_venta).html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
	                        },
	                        success:function(respuesta){
	                            var cod_info_factura_venta = respuesta.cod_info_factura_venta;
	                            var cod_estado_factura_electronica_enviado_dian = respuesta.cod_estado_factura_electronica_enviado_dian;
	                            var cod_estado_factura_electronica_enviado_dataico = respuesta.cod_estado_factura_electronica_enviado_dataico;
	                            var resultado_envio_dian = respuesta.resultado_envio_dian;
	                            var resultado_envio_dataico = respuesta.resultado_envio_dataico;
	                            var imagen_status_dian = "../imagenes/btn_dian_peq_gris.png";
	                            var imagen_status_dataico = "../imagenes/btn_dataico.png";
	                            var longitud_cod_cufe = cod_cufe.length;
	                            var mitad_longitud_cod_cufe = longitud_cod_cufe / 2;
	                            var cod_cufe_parte1 = cod_cufe.substr(0, mitad_longitud_cod_cufe);
	                            var cod_cufe_parte2 = cod_cufe.substr(mitad_longitud_cod_cufe + 1, longitud_cod_cufe);
	                            location.href = pagina_redirect_imprimir;

	                            //$('#resultado_envio_dian'+cod_info_factura_venta).html("<img src="+imagen_status_dian+" class='img-polaroid'>"+"<br>"+resultado_envio_dian);
	                            //$('#resultado_envio_dataico'+cod_info_factura_venta).html("<img src="+imagen_status_dataico+" class='img-polaroid'>"+"<br>"+resultado_envio_dataico);
	                            //$('#enviando_cargador'+cod_info_factura_venta).html("");

	                            //$('#cufe_factura_electronica1').html(cod_cufe_parte1);
	                            //$('#cufe_factura_electronica2').html(cod_cufe_parte2);
	                        }
	                    });
	                } else {
	                    $.ajax({
	                        type: "POST",
	                        url: "../admin/guardar_info_factura_y_compra_producto_temporal_json_ajax.php",
	                        data: datos_url_ajax,
	                        beforeSend: function(objeto){
	                            //$('#loader').html('<img src="../imagenes/ajax-loader.gif"> Enviando...');
	                        },
	                        success:function(respuesta){
	                            //var ok_ajax = respuesta.ok_ajax;
	                            location.href = pagina_redirect_imprimir;
	                        }
	                    });

	                }

	            }
	        }
	    });
	});
	</script>


	<script>
    var cod_info_factura_venta = "<?php echo $cod_info_factura_venta;?>";
    var tab = "tbl15_info_factura_venta";
    var campo = "cod_info_factura_venta";
    var tipo_ajax = "tbl15_info_factura_venta";
    var cod_tipo_pago = "<?php echo $cod_tipo_pago;?>";
    var conexion_internet = "<?php echo $conexion_internet;?>";
    var pagina = "<?php echo $pagina;?>";
    var tiempo_espera_resp = "agotado";

	var milisegundos = 1000;
	var tiempo_espera_respuesta_factura_venta_electronica_global = "<?php echo $tiempo_espera_respuesta_factura_venta_electronica_global;?>";
	var segundos_espera = (milisegundos * tiempo_espera_respuesta_factura_venta_electronica_global);
	const tiempo_repeticion_ciclo = milisegundos / 1;

	var url_redirect = '../admin/venta_productos_opcion_imprimir.php'+'?'+'cod_info_factura_venta='+cod_info_factura_venta+'&cod_tipo_pago='+cod_tipo_pago+'&conexion_internet='+conexion_internet+'&tiempo_espera_resp='+tiempo_espera_resp+'&pagina='+pagina;
		//location.href = url_redirect;

	const ciclo_conteo = () => {
		tiempo_espera_respuesta_factura_venta_electronica_global--;

		if (tiempo_espera_respuesta_factura_venta_electronica_global > '0') {
			setTimeout(ciclo_conteo, tiempo_repeticion_ciclo);
		}

		document.getElementById("segundos_cronometro_redirecionar_imprimir").innerHTML=""+tiempo_espera_respuesta_factura_venta_electronica_global;

		if (tiempo_espera_respuesta_factura_venta_electronica_global == '0') {
			document.getElementById("segundos_cronometro_redirecionar_imprimir").innerHTML="";
			document.getElementById("segundos_cronometro_redirecionar_imprimir").innerHTML = "<a href="+url_redirect+">"+"<img src=../imagenes/imprimir_directa_pos.png>"+"</a>";
			//document.getElementById("segundos_cronometro_redirecionar_imprimir").innerHTML = "<a href="+url_redirect+" target='_blank'>"+"<img src=../imagenes/imprimir_directa_pos.png>"+"</a>";
		}
	}

	if (tiempo_espera_respuesta_factura_venta_electronica_global > '0') {
		setTimeout(ciclo_conteo, tiempo_repeticion_ciclo);
	}
	</script>

<?php } ?>
</div>
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* FIN MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
</div>
<!--End Main Content Area-->
</div>
<div id="footerInnerSeparator"></div>
</div>
</div>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<?php include_once('../admin/04_modulo_footer.php'); ?>
<!-- 1******************************************************* MODULO FOOTER *********************************************** -->
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
</body>
</html>