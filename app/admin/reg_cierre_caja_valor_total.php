<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/json2.min.js"></script>
<script type="text/javascript" src="js/jquery.number.js"></script>
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">

<script type="text/javascript">
$(function(){

	$('#total_base_cierre_caja').number( true, 0 );
	$("#total_base_cierre_caja").keyup(function () {
	    var total_base_cierre_caja = $(this).val();
	    $("#total_base_cierre_caja_hidden").val(total_base_cierre_caja);
	});

	$('#total_fisico_cierre_caja').number( true, 0 );
	$("#total_fisico_cierre_caja").keyup(function () {
	    var total_fisico_cierre_caja = $(this).val();
	    $("#total_fisico_cierre_caja_hidden").val(total_fisico_cierre_caja);
	});

});
</script>
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

<div class="breadcrumbs">
<!--<a class="btn btn-info" href="../admin/menu_lista.php">Lista de Productos</a>-->
<!--<a class="btn btn-success" href="#">Cierre de Caja</a>-->
</div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php 
$pagina                                        = $_SERVER['PHP_SELF']; 
$cod_administrador_sesion                      = $_SESSION['cod_administrador'];
$cod_tipo_cierre_caja                          = '1';
$fecha_ymd_venta_producto                      = date("Y-m-d");
$cod_tipo_pago                                 = '1';
$cod_tipo_forma_pago                           = '1';
$fecha                                         = date("Y-m-d");
//-----------------------------------------------------------------------------------------------------------------//
$sql_venta_total = "SELECT SUM(total_venta_producto) AS total_sistema_cierre_caja FROM tbl15_venta_producto 
WHERE (cod_administrador = '$cod_administrador') AND (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_cierre_caja = '0')";
$consulta_venta_total = mysqli_query($conectar, $sql_venta_total) or die(mysqli_error($conectar));
$info_venta_total = mysqli_fetch_assoc($consulta_venta_total);

$total_sistema_cierre_caja                     = $info_venta_total['total_sistema_cierre_caja'];
//-----------------------------------------------------------------------------------------------------------------//
$sql_venta_total_contado_efectivo = "SELECT SUM(total_venta_producto) AS total_sistema_contado_efectivo_cierre_caja FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador') AND (cod_cierre_caja = '0')
AND (cod_tipo_pago = '$cod_tipo_pago') AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$consulta_venta_total_contado_efectivo = mysqli_query($conectar, $sql_venta_total_contado_efectivo) or die(mysqli_error($conectar));
$info_venta_total_contado_efectivo = mysqli_fetch_assoc($consulta_venta_total_contado_efectivo);

$total_sistema_contado_efectivo_cierre_caja    = $info_venta_total_contado_efectivo['total_sistema_contado_efectivo_cierre_caja'];
//-----------------------------------------------------------------------------------------------------------------//
$sql_venta_total_credito = "SELECT SUM(total_venta_producto) AS total_sistema_credito_cierre_caja FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_administrador = '$cod_administrador') AND (cod_tipo_pago = '2') AND (cod_cierre_caja = '0')";
$consulta_venta_total_credito = mysqli_query($conectar, $sql_venta_total_credito) or die(mysqli_error($conectar));
$info_venta_total_credito = mysqli_fetch_assoc($consulta_venta_total_credito);

$total_sistema_credito_cierre_caja             = $info_venta_total_credito['total_sistema_credito_cierre_caja'];
//-----------------------------------------------------------------------------------------------------------------//
$sql_base_admin = "SELECT total_base_cierre_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_base_admin = mysqli_query($conectar, $sql_base_admin) or die(mysqli_error($conectar));
$info_base_admin = mysqli_fetch_assoc($consulta_base_admin);

$total_base_cierre_caja                     = $info_base_admin['total_base_cierre_caja'];
//-----------------------------------------------------------------------------------------------------------------//
if ($cod_seguridad == '1') { $condicional_consulta_admin = ''; } else { $condicional_consulta_admin = 'WHERE cod_administrador = "'.$cod_administrador.'"'; }
?>
<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_cierre_caja_reg.php">
<fieldset>
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">CIERRE DE CAJA</th>
    	</tr>
	</thead>
</table>

<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center" id="mensaje_verificacion_producto">.</th>
    	</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:right; font-size: 20px">USUARIO:</th>
			<td style="text-align:center">
				<select name="cod_administrador" id="cod_administrador" class="input-block-level" style="font-size: 20px" data-show-subtext="true" data-live-search="true" required>
				        <?php if (isset($cod_administrador_sesion)) { echo ""; } else { echo ""; }
				        $consulta2_sql = ("SELECT * FROM tbl15_administrador $condicional_consulta_admin");
				        $consulta2 = mysqli_query($conectar, $consulta2_sql);
				        while ($datos2 = mysqli_fetch_assoc($consulta2)) {
				        if(isset($cod_administrador_sesion) and $cod_administrador_sesion == $datos2['cod_administrador']) {
				        $seleccionado = "selected"; } else { $seleccionado = ""; }
				        $codigo = $datos2['cod_administrador'];
				        $nombre = $datos2['nombres'].' '.$datos2['apellidos'].' | '.$datos2['cuenta'];
				        echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
				</select>
			</td>
			<input type="hidden" name="vendedor" id="vendedor" value="<?php echo $cuenta_actual ?>" size="5">
		</tr>
		<tr>
			<th style="text-align:right; font-size: 20px">FECHA:</th>
			<?php if ($cod_seguridad == '1') { ?>
			<td style="text-align:right"><input type="date" style="font-size: 20px" name="fecha_ymd_venta_producto" id="fecha_ymd_venta_producto" class="input-block-level" value="<?php echo $fecha_ymd_venta_producto ?>" required></td>
			<?php } else { ?>
			<td style="text-align:right; font-size: 40px"><?php echo $fecha_ymd_venta_producto ?></td>
			<input type="hidden" name="fecha_ymd_venta_producto" id="fecha_ymd_venta_producto" value="<?php echo $fecha_ymd_venta_producto ?>">
			<?php } ?>
		</tr>

		<?php if ($cod_seguridad == '1') { ?>
		<tr>
			<th style="text-align:right; font-size: 20px">TOTAL VENTA (EFECTIVO + TRANSFERENCIA SISTEMA):</th>
			<td style="text-align:right; font-size: 30px" id="total_sistema_cierre_caja"><?php echo number_format($total_sistema_cierre_caja, 0, ",", ".") ?></td>
    		<input type="hidden" name="total_sistema_cierre_caja" id="total_sistema_cierre_caja_hidden" value="<?php echo $total_sistema_cierre_caja ?>">
		</tr>
		<?php } else { ?>
		<input type="hidden" name="total_sistema_cierre_caja" id="total_sistema_cierre_caja_hidden" value="<?php echo $total_sistema_cierre_caja ?>">
		<?php } ?>

		<?php if ($cod_seguridad == '1') { ?>
		<tr>
			<th style="text-align:right; font-size: 20px">TOTAL VENTA EN EFECTIVO (SISTEMA):</th>
			<td style="text-align:right; font-size: 40px" id="total_sistema_contado_efectivo_cierre_caja"><?php echo number_format($total_sistema_contado_efectivo_cierre_caja, 0, ",", ".") ?></td>
    		<input type="hidden" name="total_sistema_contado_efectivo_cierre_caja" id="total_sistema_contado_efectivo_cierre_caja_hidden" value="<?php echo $total_sistema_contado_efectivo_cierre_caja ?>">
		</tr>
		<?php } else { ?>
		<input type="hidden" name="total_sistema_contado_efectivo_cierre_caja" id="total_sistema_contado_efectivo_cierre_caja_hidden" value="<?php echo $total_sistema_contado_efectivo_cierre_caja ?>">
		<?php } ?>
		
		<tr>
			<th style="text-align:right; font-size: 20px">CONTEO CAJA EN EFECTIVO + BASE:</th>
			<td style="text-align:right; font-size: 20px" id="total_base_mas_fisico_cierre_caja"></td>
			<input type="hidden" name="total_base_mas_fisico_cierre_caja" id="total_base_mas_fisico_cierre_caja_hidden" value="">
		</tr>
		<tr>
			<th style="text-align:right; font-size: 20px">BASE CAJA:</th>
			<td style="text-align:right"><input type="text" style="font-size: 30px" name="total_base_cierre_caja_calc" class="input-block-level" id="total_base_cierre_caja" onChange="calc_total_caja();" value="<?php echo $total_base_cierre_caja ?>" step="any" min=0 oninput="validity.valid||(value='');" required></td>
			<input type="hidden" name="total_base_cierre_caja" class="input-block-level" id="total_base_cierre_caja_hidden" value="<?php echo $total_base_cierre_caja ?>">
		</tr>
		<tr>
			<th style="text-align:right; font-size: 20px" title="No contar la base">TOTAL CONTEO CAJA EN EFECTIVO:</th>
			<!--<td style="text-align:right" id="total_fisico_cierre_caja"></td>-->
			<td style="text-align:right"><input type="text" style="font-size: 30px" name="total_fisico_cierre_caja_calc" class="input-block-level" id="total_fisico_cierre_caja" onChange="calc_total_caja();" value="" required></td>
			<input type="hidden" name="total_fisico_cierre_caja" class="input-block-level" id="total_fisico_cierre_caja_hidden" value="">
		</tr>
		<tr>
			<!--
			<th style="text-align:right">RESULTADO:</th>
			<td style="text-align:right" id="resultado_cierre_caja"></td>
			 -->
			<input type="hidden" name="resultado_cierre_caja" id="resultado_cierre_caja_hidden" value="">
		</tr>
<?php
$incre = 0;

$sql = "SELECT * FROM tbl15_moneda WHERE (cod_estado = '1') ORDER BY cod_moneda ASC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_registr = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {

	$cod_moneda                     = $datos['cod_moneda'];
	$nombre_moneda                  = $datos['nombre_moneda'];
	$valor_moneda                   = $datos['valor_moneda'];
	$und_moneda                     = $datos['und_moneda'];
	$cod_estado                     = $datos['cod_estado'];
$incre++;
?>
    		<input type="hidden" name="<?php echo $nombre_moneda ?>" class="input-block-level" id="und_moneda<?php echo $incre;?>" value="0">
   			<input type="hidden" name="valor_moneda" class="valor_moneda" id="valor_moneda<?php echo $incre;?>" value="<?php echo $valor_moneda ?>" size="5">
<?php } ?>
	</thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
</div>
<input type="hidden" name="cod_tipo_cierre_caja" value="<?php echo $cod_tipo_cierre_caja ?>">
<input type="hidden" name="total_compra_producto_sistema_cierre_caja" id="total_compra_producto_sistema_cierre_caja" value="">
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<hr>
<div class="actions">
<input type="submit" value="Cerrar Caja" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
</div>
</fieldset>
</form>
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
<?php include_once('../admin/05_modulo_js_sin_jquery.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script>
function calc_total_caja(){

	var total_sistema_cierre_caja_hidden = 0;
	var total_fisico_cierre_caja = 0;
	var total_fisico_cierre_caja_sub = 0;
	var total_base_cierre_caja = 0;
	var total_base_mas_fisico_cierre_caja = 0;
	var total_base_mas_fisico_cierre_caja_oculto = 0;
	var resultado_cierre_caja = 0;
	var total_sistema_cierre_caja = 0;

	var total_sistema_contado_efectivo_cierre_caja_hidden = document.getElementById("total_sistema_contado_efectivo_cierre_caja_hidden").value;

    total_base_cierre_caja = parseFloat($('#total_base_cierre_caja').val());
    if (isNaN(total_base_cierre_caja)) { total_base_cierre_caja = 0; } else { total_base_cierre_caja = total_base_cierre_caja; }
	total_base_cierre_caja_hidden = total_base_cierre_caja;
	document.getElementById("total_base_cierre_caja_hidden").value = total_base_cierre_caja_hidden;

	total_fisico_cierre_caja = parseFloat($('#total_fisico_cierre_caja').val());
	if (isNaN(total_fisico_cierre_caja)) { total_fisico_cierre_caja = 0; } else { total_fisico_cierre_caja = total_fisico_cierre_caja; }
	total_fisico_cierre_caja_hidden = total_fisico_cierre_caja;
	document.getElementById("total_fisico_cierre_caja_hidden").value = total_fisico_cierre_caja_hidden;

	total_base_mas_fisico_cierre_caja = total_base_cierre_caja_hidden + total_fisico_cierre_caja_hidden;
	document.getElementById("total_base_mas_fisico_cierre_caja_hidden").value = total_base_mas_fisico_cierre_caja;

    total_sistema_cierre_caja_hidden = parseFloat($('#total_sistema_cierre_caja_hidden').val());

	resultado_cierre_caja = total_fisico_cierre_caja_hidden - total_sistema_contado_efectivo_cierre_caja_hidden;

	if (resultado_cierre_caja > 0) { var mensaje = "SOBRA "; }
	if (resultado_cierre_caja < 0) { var mensaje = "FALTA "; }
	if (resultado_cierre_caja == 0) { var mensaje = ""; }


	document.getElementById("resultado_cierre_caja_hidden").value = resultado_cierre_caja;
	document.getElementById("total_base_mas_fisico_cierre_caja").innerHTML="$ "+total_base_mas_fisico_cierre_caja.toLocaleString("es-ES");
}
</script>

<script>
function calc_valor(){

	var total_sistema_cierre_caja_hidden = 0;
	var total_fisico_cierre_caja = 0;
	var total_fisico_cierre_caja_sub = 0;
	var total_base_cierre_caja = 0;
	var und_moneda = 0;
	var valor_moneda = 0;
	var valor_moneda_total = 0;
	var total_base_mas_fisico_cierre_caja = 0;
	var total_base_mas_fisico_cierre_caja_oculto = 0;

	var resultado_cierre_caja = 0;
	var valor_cierre_caja = 0;
	var incre = <?php echo $total_registr;?>;
	var und_moneda_text = "";
	var valor_moneda_text = "";
	var i = 0;

	total_sistema_cierre_caja_hidden = document.getElementById("total_sistema_cierre_caja_hidden").value;
	total_base_cierre_caja = document.getElementById("total_base_cierre_caja").value;

	for (i=1; i<=incre; i++){

		und_moneda_text = "und_moneda"+i;
		valor_moneda_text = "valor_moneda"+i;

		und_moneda = document.getElementById(und_moneda_text).value;
		valor_moneda = document.getElementById(valor_moneda_text).value;
		valor_moneda_total = (und_moneda * valor_moneda) + valor_moneda_total;

		total_fisico_cierre_caja_sub = valor_moneda_total;
		total_fisico_cierre_caja_oculto = valor_moneda_total;
	}
	total_fisico_cierre_caja = total_fisico_cierre_caja_sub;
	resultado_cierre_caja = total_fisico_cierre_caja - total_sistema_cierre_caja_hidden;

	if (resultado_cierre_caja > 0) { var mensaje = "SOBRA "; }
	if (resultado_cierre_caja < 0) { var mensaje = "FALTA "; }
	if (resultado_cierre_caja == 0) { var mensaje = ""; }

	total_base_mas_fisico_cierre_caja = parseInt(total_base_cierre_caja) + total_fisico_cierre_caja_sub;
	total_base_mas_fisico_cierre_caja_oculto = parseInt(total_base_cierre_caja) + total_fisico_cierre_caja_sub;

	//document.getElementById("total_sistema_cierre_caja").innerHTML="$ "+total_fisico_cierre_caja.toLocaleString("es-ES");
	//document.getElementById("total_sistema_cierre_caja_hidden").value = total_fisico_cierre_caja;

	//document.getElementById("total_sistema_contado_efectivo_cierre_caja").innerHTML="$ "+total_fisico_cierre_caja.toLocaleString("es-ES");
	//document.getElementById("total_sistema_contado_efectivo_cierre_caja_hidden").value = total_fisico_cierre_caja;

	//document.getElementById("total_fisico_cierre_caja").innerHTML="$ "+total_fisico_cierre_caja.toLocaleString("es-ES");
	document.getElementById("total_fisico_cierre_caja_oculto").value = total_fisico_cierre_caja;

	//document.getElementById("resultado_cierre_caja").innerHTML=mensaje+" $ "+resultado_cierre_caja.toLocaleString("es-ES");
	document.getElementById("resultado_cierre_caja_hidden").value = resultado_cierre_caja;

	document.getElementById("total_base_mas_fisico_cierre_caja").innerHTML="$ "+total_base_mas_fisico_cierre_caja.toLocaleString("es-ES");
	document.getElementById("total_base_mas_fisico_cierre_caja_oculto").value = total_base_mas_fisico_cierre_caja_oculto;
}
</script>


<script language="javascript">
$(document).ready(function(){
    $("#cod_administrador").on('change', function () {
            var cod_administrador = $(this).val();
            var fecha_ymd_venta_producto = $('#fecha_ymd_venta_producto').val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_venta_producto";
            var datos_enviar = 'cod_administrador='+cod_administrador+'&fecha_ymd_venta_producto='+fecha_ymd_venta_producto+'&campo='+campo+'&tipo_ajax='+tipo_ajax;

	   		$.ajax({
	            type: "POST",
	            url: "../admin/calcular_venta_cierre_caja_ajax.php",
	            data: { cod_administrador: cod_administrador, fecha_ymd_venta_producto: fecha_ymd_venta_producto, campo: campo, tipo_ajax: tipo_ajax }, 
	            dataType: "json",
			        //contentType: false,
			        //processData: false,
	            beforeSend: function(entrada){
	                //$("#icono_estado").html('<img src="../imagenes/cargador.gif">');
	                //$("#estado").html('Cargando...');
	              },
	            success: function(respuesta){
	          		var total_sistema_cierre_caja = respuesta.total_sistema_cierre_caja;
	          		var total_sistema_contado_efectivo_cierre_caja = respuesta.total_sistema_contado_efectivo_cierre_caja;
	          		var total_sistema_credito_cierre_caja = respuesta.total_sistema_credito_cierre_caja;
	          		var total_base_cierre_caja = respuesta.total_base_cierre_caja;
	          		var total_compra_producto_sistema_cierre_caja = respuesta.total_compra_producto_sistema_cierre_caja;

	                $("#total_sistema_cierre_caja_hidden").val(total_sistema_cierre_caja);
	                $("#total_sistema_contado_efectivo_cierre_caja_hidden").val(total_sistema_cierre_caja);
	                $("#total_sistema_cierre_caja").html(total_sistema_cierre_caja.toLocaleString("es-ES"));
	                $("#total_sistema_contado_efectivo_cierre_caja").html(total_sistema_contado_efectivo_cierre_caja.toLocaleString("es-ES"));
	                $("#total_sistema_credito_cierre_caja").html(total_sistema_credito_cierre_caja.toLocaleString("es-ES"));
	                $("#total_base_cierre_caja").val(total_base_cierre_caja);
	                $("#total_compra_producto_sistema_cierre_caja").val(total_compra_producto_sistema_cierre_caja);

	            }
	   		});
    });
});
</script>

<script language="javascript">
$(document).ready(function(){
    $("#fecha_ymd_venta_producto").on('change', function () {
            var cod_administrador = $('#cod_administrador').val();
            var fecha_ymd_venta_producto = $(this).val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_venta_producto";
            var datos_enviar = 'cod_administrador='+cod_administrador+'&fecha_ymd_venta_producto='+fecha_ymd_venta_producto+'&campo='+campo+'&tipo_ajax='+tipo_ajax;

	   		$.ajax({
	            type: "POST",
	            url: "../admin/calcular_venta_cierre_caja_ajax.php",
	            data: { cod_administrador: cod_administrador, fecha_ymd_venta_producto: fecha_ymd_venta_producto, campo: campo, tipo_ajax: tipo_ajax }, 
	            dataType: "json",
			        //contentType: false,
			        //processData: false,
	            beforeSend: function(entrada){
	                //$("#icono_estado").html('<img src="../imagenes/cargador.gif">');
	                //$("#estado").html('Cargando...');
	              },
	            success: function(respuesta){
	          		var total_sistema_cierre_caja = respuesta.total_sistema_cierre_caja;
	          		var total_sistema_contado_efectivo_cierre_caja = respuesta.total_sistema_contado_efectivo_cierre_caja;
	          		var total_sistema_credito_cierre_caja = respuesta.total_sistema_credito_cierre_caja;
	          		var total_compra_producto_sistema_cierre_caja = respuesta.total_compra_producto_sistema_cierre_caja;

	                $("#total_sistema_cierre_caja_hidden").val(total_sistema_cierre_caja);
	                $("#total_sistema_contado_efectivo_cierre_caja_hidden").val(total_sistema_cierre_caja);
	                $("#total_sistema_cierre_caja").html(total_sistema_cierre_caja.toLocaleString("es-ES"));
	                $("#total_sistema_contado_efectivo_cierre_caja").html(total_sistema_contado_efectivo_cierre_caja.toLocaleString("es-ES"));
	                $("#total_sistema_credito_cierre_caja").html(total_sistema_credito_cierre_caja.toLocaleString("es-ES"));
	                $("#total_compra_producto_sistema_cierre_caja").val(total_compra_producto_sistema_cierre_caja);
	            }
	   		});
    });
});
</script>

</body>
</html>