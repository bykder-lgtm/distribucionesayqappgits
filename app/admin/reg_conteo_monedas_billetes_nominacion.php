<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<link rel="stylesheet" href="../estilo_css/jquery-ui.css">
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
<!--
<div class="breadcrumbs">
<a class="btn btn-info" href="../admin/lista_conteo_monedas_billetes_nominacion.php">Registrar Billetes Y Monedas</a>
</div>
-->
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php 
$pagina                                        = $_SERVER['PHP_SELF']; 
$cod_administrador_sesion                      = $_SESSION['cod_administrador'];
$cod_tipo_cierre_caja                          = '0';
$fecha_ymd_venta_producto                      = date("Y-m-d");
$cod_tipo_pago                                 = '1';
$cod_tipo_forma_pago                           = '1';
$fecha                                         = date("Y-m-d");
$cod_conteo_monedas_billetes_nominacion        = 1;
//-----------------------------------------------------------------------------------------------------------------//
//$sql_cierre_caja = "SELECT SUM(total_retirar_caja) AS total_retirar_caja FROM tbl15_conteo_monedas_billetes_nominacion WHERE (cod_administrador = '$cod_administrador' AND fecha_anyo = '$fecha_ymd_venta_producto')";
$sql_cierre_caja = "SELECT SUM(total_retirar_caja) AS total_retirar_caja FROM tbl15_conteo_monedas_billetes_nominacion_historial WHERE (fecha_anyo = '$fecha_ymd_venta_producto')";
$consulta_cierre_caja = mysqli_query($conectar, $sql_cierre_caja) or die(mysqli_error($conectar));
$info_cierre_caja = mysqli_fetch_assoc($consulta_cierre_caja);

$total_retirar_caja                        = intval($info_cierre_caja['total_retirar_caja']);
//-----------------------------------------------------------------------------------------------------------------//
/*
$sql_venta_total = "SELECT SUM(total_venta_producto) AS total_sistema_cierre_caja FROM tbl15_venta_producto 
WHERE (cod_administrador = '$cod_administrador') AND (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto')";
*/
$sql_venta_total = "SELECT SUM(total_venta_producto) AS total_sistema_cierre_caja FROM tbl15_venta_producto  WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto')";
$consulta_venta_total = mysqli_query($conectar, $sql_venta_total) or die(mysqli_error($conectar));
$info_venta_total = mysqli_fetch_assoc($consulta_venta_total);

$total_sistema_cierre_caja                     = $info_venta_total['total_sistema_cierre_caja'];
//-----------------------------------------------------------------------------------------------------------------//
/*
$sql_venta_total_contado_efectivo = "SELECT SUM(total_venta_producto) AS total_sistema_contado_efectivo_cierre_caja FROM tbl15_venta_producto 
WHERE (cod_administrador = '$cod_administrador') AND (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto')
AND (cod_tipo_pago = '$cod_tipo_pago') AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
*/
$sql_venta_total_contado_efectivo = "SELECT SUM(total_venta_producto) AS total_sistema_contado_efectivo_todo FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto')
AND (cod_tipo_pago = '$cod_tipo_pago') AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$consulta_venta_total_contado_efectivo = mysqli_query($conectar, $sql_venta_total_contado_efectivo) or die(mysqli_error($conectar));
$info_venta_total_contado_efectivo = mysqli_fetch_assoc($consulta_venta_total_contado_efectivo);

$total_sistema_contado_efectivo_todo           = $info_venta_total_contado_efectivo['total_sistema_contado_efectivo_todo'];
$total_sistema_contado_efectivo_cierre_caja    = $total_sistema_contado_efectivo_todo - $total_retirar_caja;
//-----------------------------------------------------------------------------------------------------------------//
/*
$sql_venta_total_contado_efectivo = "SELECT SUM(total_venta_producto) AS total_sistema_contado_efectivo_cierre_caja FROM tbl15_venta_producto 
WHERE (cod_administrador = '$cod_administrador') AND (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto')
AND (cod_tipo_pago = '$cod_tipo_pago') AND (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
*/
$sql_venta_total_contado_transferencia = "SELECT SUM(total_venta_producto) AS total_sistema_contado_transferencia FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto')
AND (cod_tipo_pago = '$cod_tipo_pago') AND (cod_tipo_forma_pago = '10')";
$consulta_venta_total_contado_transferencia = mysqli_query($conectar, $sql_venta_total_contado_transferencia) or die(mysqli_error($conectar));
$info_venta_total_contado_transferencia = mysqli_fetch_assoc($consulta_venta_total_contado_transferencia);

$total_sistema_contado_transferencia    = $info_venta_total_contado_transferencia['total_sistema_contado_transferencia'];
//-----------------------------------------------------------------------------------------------------------------//
/*
$sql_venta_total_credito = "SELECT SUM(total_venta_producto) AS total_sistema_credito_cierre_caja FROM tbl15_venta_producto 
WHERE (cod_administrador = '$cod_administrador') AND (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_tipo_pago = '2')";
$consulta_venta_total_credito = mysqli_query($conectar, $sql_venta_total_credito) or die(mysqli_error($conectar));
$info_venta_total_credito = mysqli_fetch_assoc($consulta_venta_total_credito);
*/
$sql_venta_total_credito = "SELECT SUM(total_venta_producto) AS total_sistema_credito_cierre_caja FROM tbl15_venta_producto 
WHERE (fecha_ymd_venta_producto = '$fecha_ymd_venta_producto') AND (cod_tipo_pago = '2')";
$consulta_venta_total_credito = mysqli_query($conectar, $sql_venta_total_credito) or die(mysqli_error($conectar));
$info_venta_total_credito = mysqli_fetch_assoc($consulta_venta_total_credito);

$total_sistema_credito_cierre_caja             = $info_venta_total_credito['total_sistema_credito_cierre_caja'];
//-----------------------------------------------------------------------------------------------------------------//
$sql_base_admin = "SELECT total_base_cierre_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$consulta_base_admin = mysqli_query($conectar, $sql_base_admin) or die(mysqli_error($conectar));
$info_base_admin = mysqli_fetch_assoc($consulta_base_admin);

$total_base_cierre_caja                        = $info_base_admin['total_base_cierre_caja'];
//-----------------------------------------------------------------------------------------------------------------//
if ($cod_seguridad == '1') { $condicional_consulta_admin = ''; } else { $condicional_consulta_admin = 'WHERE cod_administrador = "'.$cod_administrador.'"'; }
?>
<table border="1" class="table table-responsive">
	<tr>
		<th style="text-align:center; font-size:30px; width: 600px; height: 40px;">TOTAL VENTA: <?php echo "$ ".number_format($total_sistema_contado_efectivo_todo, 0, ",", ".") ?></th>
	</tr>
</table>

<form name="formulario_insersion" method="post" enctype="multipart/form-data" action="../admin/reg_conteo_monedas_billetes_nominacion_reg.php">
<fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
			<input type="hidden" name="cod_administrador" id="cod_administrador" value="<?php echo $cod_administrador_sesion ?>" size="5">
<!--
		<tr>
			<th style="text-align:right; font-size:30px; width: 600px; height: 40px;">USUARIO:</th>
			<td style="text-align:center">
				<select name="cod_administrador" id="cod_administrador" class="input-block-level" data-show-subtext="true" data-live-search="true" style="font-size:30px; width: 400px; height: 40px;" required>
				        <?php if (isset($cod_administrador_sesion)) { echo ""; } else { echo  ""; }
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
-->

		<tr>
			<th style="text-align:right; font-size:30px; width: 600px; height: 40px;">FECHA:</th>
			<td style="text-align:left"><input type="date" name="fecha_ymd_venta_producto" id="fecha_ymd_venta_producto" class="input-block-level" value="<?php echo $fecha_ymd_venta_producto ?>" style="font-size:30px; width: 400px; height: 40px;" required></td>
		</tr>

		<?php if ($cod_seguridad == '1') { ?>
		<tr>
			<th style="text-align:right; font-size:30px; width: 600px; height: 40px;">TOTAL EN CAJA (VENTA EN EFECTIVO):</th>
			<td style="font-size:40px; width: 400px; height: 40px;" id="total_sistema_contado_efectivo_cierre_caja"><?php echo "$ ".number_format($total_sistema_contado_efectivo_cierre_caja, 0, ",", ".") ?></td>
    		<input type="hidden" name="total_sistema_contado_efectivo_cierre_caja" id="total_sistema_contado_efectivo_cierre_caja_oculto" value="<?php echo $total_sistema_contado_efectivo_cierre_caja ?>">
		</tr>
		<?php } else { ?>
		<input type="hidden" name="total_sistema_contado_efectivo_cierre_caja" id="total_sistema_contado_efectivo_cierre_caja_oculto" value="<?php echo $total_sistema_contado_efectivo_cierre_caja ?>">
		<?php } ?>

		<tr>
			<th style="text-align:right; font-size:30px; width: 600px; height: 40px;">TOTAL VENTA POR TRANSFERENCIA:</th>
			<td style="font-size:40px; width: 400px; height: 40px;" id="total_sistema_contado_transferencia"><?php echo "$ ".number_format($total_sistema_contado_transferencia, 0, ",", ".") ?></td>
    		<input type="hidden" name="total_sistema_contado_transferencia" value="<?php echo $total_sistema_contado_transferencia ?>">
		</tr>
		<tr>
			<th style="text-align:right; font-size:30px; width: 600px; height: 40px;">OBSERVACION:</th>
			<td style="text-align:left"><input type="text" name="comentario" class="input-block-level" id="comentario" value="" style="width: 400px; height: 40px;"></td>
		</tr>
		<tr>
			<th style="text-align:right; font-size:30px; width: 600px; height: 40px;">BASE CAJA:</th>
			<td style="text-align:left"><input type="number" name="total_base_cierre_caja" class="input-block-level" id="total_base_cierre_caja" onChange="calc_valor();" value="<?php echo $total_base_cierre_caja ?>" step="any" min=0 oninput="validity.valid||(value='');" style="font-size:40px; width: 400px; height: 40px;" required></td>
		</tr>
		<tr>
			<th style="text-align:right; font-size:30px; width: 600px; height: 40px;">RETIRAR DE CAJA:</th>
			<td style="text-align:left"><input type="number" name="total_retirar_caja" class="input-block-level" id="total_retirar_caja" value="" step="any" min=0 oninput="validity.valid||(value='');" style="font-size:40px; width: 400px; height: 40px;" required></td>
		</tr>
		<tr>
			<th style="text-align:right; font-size:30px; width: 600px; height: 40px;">TOTAL CONTEO EN EFECTIVO:</th>
			<td style="font-size:40px; width: 400px; height: 40px;" id="total_fisico_cierre_caja"></td>
			<input type="hidden" name="total_fisico_cierre_caja" id="total_fisico_cierre_caja_oculto" value="">
		</tr>
		<tr>
			<th style="text-align:right; font-size:30px; width: 600px; height: 40px;">TOTAL RETIRO EN EFECTIVO:</th>
			<td style="font-size:40px; width: 400px; height: 40px;" id="total_retiro_fisico_cierre_caja"></td>
			<input type="hidden" name="total_retiro_fisico_cierre_caja" id="total_retiro_fisico_cierre_caja_oculto" value="">
		</tr>
<!--
		<tr>
			<th style="text-align:right; font-size:30px; width: 600px; height: 40px;">TOTAL CONTEO EN EFECTIVO + BASE CAJA:</th>
			<td style="font-size:40px; width: 400px; height: 40px;" id="total_base_mas_fisico_cierre_caja"></td>
			<input type="hidden" name="total_base_mas_fisico_cierre_caja" id="total_base_mas_fisico_cierre_caja_oculto" value="">
		</tr>
-->
			<input type="hidden" name="total_base_mas_fisico_cierre_caja" id="total_base_mas_fisico_cierre_caja_oculto" value="">
		<tr>
			<input type="hidden" name="resultado_cierre_caja" id="resultado_cierre_caja_oculto" value="">
			<input type="hidden" name="total_sistema_cierre_caja" id="total_sistema_cierre_caja_oculto" value="<?php echo $total_sistema_cierre_caja ?>">
		</tr>
	</thead>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center; font-size:25px; width: 200px; height: 40px;">NOMINACION</th>
			<th style="text-align:center; font-size:25px; width: 400px; height: 40px;">CONTEO EN EFECTIVO CAJA</th>
			<th style="text-align:center; font-size:25px; width: 400px; height: 40px;">TOTAL CONTEO</th>
			<th style="text-align:center; font-size:25px; width: 400px; height: 40px;">CONTEO RETIRO</th>
			<th style="text-align:center; font-size:25px; width: 400px; height: 40px;">TOTAL RETIRO</th>
		</tr>
<?php
$incre                         = 0;
$total_conteo_efectivo_caja    = 0;

$sql = "SELECT * FROM tbl15_moneda WHERE (cod_estado = '1') ORDER BY cod_moneda ASC";
$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
$total_registr = mysqli_num_rows($consulta);
while ($datos = mysqli_fetch_assoc($consulta)) {
	$incre++;

	$cod_moneda                     = $datos['cod_moneda'];
	$nombre_moneda                  = $datos['nombre_moneda'];
	$nombre_moneda_retiro           = $datos['nombre_moneda_retiro'];
	$valor_moneda                   = $datos['valor_moneda'];
	$und_moneda                     = $datos['und_moneda'];
	$cod_estado                     = $datos['cod_estado'];

	$sql_conteo_monedas_billetes_nominacion = "SELECT * FROM tbl15_conteo_monedas_billetes_nominacion WHERE (cod_conteo_monedas_billetes_nominacion = '1')";
	$consulta_conteo_monedas_billetes_nominacion = mysqli_query($conectar, $sql_conteo_monedas_billetes_nominacion) or die(mysqli_error($conectar));
	$info_conteo_monedas_billetes_nominacion = mysqli_fetch_assoc($consulta_conteo_monedas_billetes_nominacion);

	$und_moneda_ultimo_cambio       = $info_conteo_monedas_billetes_nominacion[$nombre_moneda.'_actual'];
	$valor_moneda_efectivo_caja     = $valor_moneda * $und_moneda_ultimo_cambio;
	$total_conteo_efectivo_caja     = $valor_moneda_efectivo_caja + $total_conteo_efectivo_caja
/*
	$sql_conteo_monedas_billetes_nominacion = "SELECT moneda_50, moneda_100, moneda_200, moneda_500, moneda_1000, moneda_2000, moneda_5000, moneda_10000, moneda_20000, moneda_50000, moneda_100000 
	FROM tbl15_conteo_monedas_billetes_nominacion WHERE (cod_administrador = '$cod_administrador')";
	$consulta_conteo_monedas_billetes_nominacion = mysqli_query($conectar, $sql_conteo_monedas_billetes_nominacion) or die(mysqli_error($conectar));
	$info_conteo_monedas_billetes_nominacion = mysqli_fetch_assoc($consulta_conteo_monedas_billetes_nominacion);

	$moneda_50                      = $info_conteo_monedas_billetes_nominacion['moneda_50'];
	$moneda_100                     = $info_conteo_monedas_billetes_nominacion['moneda_100'];
	$moneda_200                     = $info_conteo_monedas_billetes_nominacion['moneda_200'];
	$moneda_500                     = $info_conteo_monedas_billetes_nominacion['moneda_500'];
	$moneda_1000                    = $info_conteo_monedas_billetes_nominacion['moneda_1000'];
	$moneda_2000                    = $info_conteo_monedas_billetes_nominacion['moneda_2000'];
	$moneda_5000                    = $info_conteo_monedas_billetes_nominacion['moneda_5000'];
	$moneda_10000                   = $info_conteo_monedas_billetes_nominacion['moneda_10000'];
	$moneda_20000                   = $info_conteo_monedas_billetes_nominacion['moneda_20000'];
	$moneda_50000                   = $info_conteo_monedas_billetes_nominacion['moneda_50000'];
	$moneda_100000                  = $info_conteo_monedas_billetes_nominacion['moneda_100000'];

	$valores_nominacion_usuario     = array($nombre_moneda=>$moneda_50, "moneda_100"=>$moneda_100, "moneda_200"=>$moneda_200, "moneda_500"=>$moneda_500, "moneda_1000"=>$moneda_1000, "moneda_2000"=>$moneda_2000, 
	"moneda_5000"=>$moneda_5000, "moneda_10000"=>$moneda_10000, "moneda_20000"=>$moneda_20000, "moneda_50000"=>$moneda_50000, "moneda_100000"=>$moneda_100000);

	foreach ($valores_nominacion_usuario as $clave=>$valor) { }
*/
?>
		<tr>
			<th style="text-align:right; font-size:25px;">$ <?php echo number_format($valor_moneda, 0, ",", ".") ?></th>
    		<td style="text-align:center"><input type="number" name="<?php echo $nombre_moneda ?>" class="input-block-level" id="und_moneda<?php echo $incre;?>" value="<?php echo $und_moneda_ultimo_cambio;?>" onChange="calc_valor();" step="any" min=0 oninput="validity.valid||(value='');" style="font-size:40px; width: 200px; height: 40px;" required></td>
			<th style="text-align:right; font-size:25px; width: 400px; height: 40px;" id="valor_moneda_efectivo_caja<?php echo $incre;?>">$ <?php echo number_format($valor_moneda_efectivo_caja, 0, ",", ".") ?></th>
       		<td style="text-align:center"><input type="number" name="<?php echo $nombre_moneda_retiro ?>" class="input-block-level" id="und_moneda_retirar<?php echo $incre;?>" value=""  onChange="calc_valor_retirar();" step="any" min=0 oninput="validity.valid||(value='');" style="font-size:40px; width: 200px; height: 40px;" required></td>
			<th style="text-align:right; font-size:25px; width: 400px; height: 40px;" id="valor_moneda_retiro<?php echo $incre;?>"></th>
   			<input type="hidden" name="valor_moneda" class="valor_moneda" id="valor_moneda<?php echo $incre;?>" value="<?php echo $valor_moneda ?>" size="5">
		</tr>
<?php } ?>
		<tr>
			<th style="text-align:right; font-size:30px; width: 400px; height: 40px;">TOTALES</th>
			<th style="text-align:center; font-size:30px; width: 400px; height: 40px;"></th>
			<th style="text-align:right; font-size:30px; width: 400px; height: 40px;" id="total_conteo_efectivo_caja">$ <?php echo number_format($total_conteo_efectivo_caja, 0, ",", ".") ?></th>
			<th style="text-align:center; font-size:30px; width: 400px; height: 40px;"></th>
			<th style="text-align:right; font-size:30px; width: 400px; height: 40px;" id="total_retirar_efectivo_caja"></th>
   			<input type="hidden" name="total_retirar_efectivo_caja" id="total_retirar_efectivo_caja_oculto" value="" size="5">
		</tr>
	</thead>
</table>
</fieldset>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
</div>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>">
<input type="hidden" name="insersion" value="formulario_de_insersion">
<hr>
<div class="actions">
<input type="submit" value="Guardar Informacion" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" />
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
<?php include_once('../admin/05_modulo_js.php'); ?>
<!-- 1******************************************************* MODULO PLANTILLA JS *********************************************** -->
<script src="js/jquery-ui.js"></script>

<script>
function calc_valor_retirar(){

	var total_sistema_cierre_caja_oculto = 0;
	var total_fisico_cierre_caja = 0;
	var total_fisico_cierre_caja_sub = 0;
	var total_base_cierre_caja = 0;
	var und_moneda_retirar = 0;
	var valor_moneda = 0;
	var total_retirar_efectivo_caja = 0;
	var total_base_mas_fisico_cierre_caja = 0;
	var total_base_mas_fisico_cierre_caja_oculto = 0;

	var resultado_cierre_caja = 0;
	var valor_cierre_caja = 0;
	var incre = <?php echo $total_registr;?>;
	var und_moneda_retirar_text = "";
	var valor_moneda_text = "";
	var valor_moneda_retiro = 0;

	var i = 0;

	total_sistema_cierre_caja_oculto = document.getElementById("total_sistema_contado_efectivo_cierre_caja_oculto").value;
	total_base_cierre_caja = document.getElementById("total_base_cierre_caja").value;

	for (i=1; i<=incre; i++){

		und_moneda_retirar_text = "und_moneda_retirar"+i;
		valor_moneda_text = "valor_moneda"+i;

		und_moneda_retirar = document.getElementById(und_moneda_retirar_text).value;
		valor_moneda = document.getElementById(valor_moneda_text).value;

		if (und_moneda_retirar == '') { und_moneda_retirar = 0; } else { und_moneda_retirar = und_moneda_retirar; }

		valor_moneda_retiro = (und_moneda_retirar * valor_moneda);
		total_retirar_efectivo_caja = (und_moneda_retirar * valor_moneda) + total_retirar_efectivo_caja;

		total_fisico_cierre_caja_sub = total_retirar_efectivo_caja;
		total_fisico_cierre_caja_oculto = total_retirar_efectivo_caja;
		document.getElementById("valor_moneda_retiro"+i).innerHTML="$ "+valor_moneda_retiro.toLocaleString("es-ES");
	}
	total_fisico_cierre_caja = total_fisico_cierre_caja_sub;
	resultado_cierre_caja = total_sistema_cierre_caja_oculto - total_fisico_cierre_caja_oculto;


	//total_base_mas_fisico_cierre_caja = parseInt(total_base_cierre_caja) + parseInt(total_fisico_cierre_caja_sub);
	//total_base_mas_fisico_cierre_caja_oculto = parseInt(total_base_cierre_caja) + parseInt(total_fisico_cierre_caja_sub);
	total_base_mas_fisico_cierre_caja = parseInt(total_fisico_cierre_caja_sub);
	total_base_mas_fisico_cierre_caja_oculto = parseInt(total_fisico_cierre_caja_sub);

	document.getElementById("total_retirar_efectivo_caja").innerHTML="$ "+total_retirar_efectivo_caja.toLocaleString("es-ES");
	document.getElementById("total_retirar_efectivo_caja_oculto").value = total_retirar_efectivo_caja;

	document.getElementById("total_retiro_fisico_cierre_caja").innerHTML="$ "+total_retirar_efectivo_caja.toLocaleString("es-ES");
	document.getElementById("total_retiro_fisico_cierre_caja_oculto").innerHTML="$ "+total_retirar_efectivo_caja.toLocaleString("es-ES");
	document.getElementById("total_retirar_caja").value = total_retirar_efectivo_caja;
}
</script>


<script>
function calc_valor(){

	var total_sistema_cierre_caja_oculto = 0;
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
	var valor_moneda_efectivo_caja = 0;
	var total_conteo_efectivo_caja = 0;

	var i = 0;

	total_sistema_cierre_caja_oculto = document.getElementById("total_sistema_contado_efectivo_cierre_caja_oculto").value;
	total_base_cierre_caja = document.getElementById("total_base_cierre_caja").value;

	for (i=1; i<=incre; i++){

		und_moneda_text = "und_moneda"+i;
		valor_moneda_text = "valor_moneda"+i;

		und_moneda = document.getElementById(und_moneda_text).value;

		if (und_moneda == '') { und_moneda = 0; } else { und_moneda = und_moneda; }

		valor_moneda = document.getElementById(valor_moneda_text).value;
		valor_moneda_total = (und_moneda * valor_moneda) + valor_moneda_total;

		total_fisico_cierre_caja_sub = valor_moneda_total;
		total_fisico_cierre_caja_oculto = valor_moneda_total;

		valor_moneda_efectivo_caja = (und_moneda * valor_moneda);
		total_conteo_efectivo_caja = (und_moneda * valor_moneda) + total_conteo_efectivo_caja;

		total_fisico_cierre_caja_sub = total_conteo_efectivo_caja;
		total_fisico_cierre_caja_oculto = total_conteo_efectivo_caja;
		document.getElementById("valor_moneda_efectivo_caja"+i).innerHTML="$ "+valor_moneda_efectivo_caja.toLocaleString("es-ES");

	}
	total_fisico_cierre_caja = total_fisico_cierre_caja_sub;
	resultado_cierre_caja = total_sistema_cierre_caja_oculto - total_fisico_cierre_caja_oculto;

	if (resultado_cierre_caja > 0) { var mensaje = "SOBRA "; }
	if (resultado_cierre_caja < 0) { var mensaje = "FALTA "; }
	if (resultado_cierre_caja == 0) { var mensaje = ""; }

	total_base_mas_fisico_cierre_caja = parseInt(total_base_cierre_caja) + parseInt(total_fisico_cierre_caja_sub);
	total_base_mas_fisico_cierre_caja_oculto = parseInt(total_base_cierre_caja) + parseInt(total_fisico_cierre_caja_sub);

	//document.getElementById("total_sistema_cierre_caja").innerHTML="$ "+total_fisico_cierre_caja.toLocaleString("es-ES");
	//document.getElementById("total_sistema_cierre_caja_oculto").value = total_fisico_cierre_caja;

	//document.getElementById("total_sistema_contado_efectivo_cierre_caja").innerHTML="$ "+total_fisico_cierre_caja.toLocaleString("es-ES");
	//document.getElementById("total_sistema_contado_efectivo_cierre_caja_oculto").value = total_fisico_cierre_caja;

	document.getElementById("total_fisico_cierre_caja").innerHTML="$ "+total_fisico_cierre_caja.toLocaleString("es-ES");
	document.getElementById("total_fisico_cierre_caja_oculto").value = total_fisico_cierre_caja;

	document.getElementById("resultado_cierre_caja_oculto").value = resultado_cierre_caja;

	//document.getElementById("total_base_mas_fisico_cierre_caja").innerHTML="$ "+total_base_mas_fisico_cierre_caja.toLocaleString("es-ES");
	//document.getElementById("total_base_mas_fisico_cierre_caja_oculto").value = total_base_mas_fisico_cierre_caja_oculto;

	document.getElementById("total_conteo_efectivo_caja").innerHTML="$ "+total_conteo_efectivo_caja.toLocaleString("es-ES");
}
</script>

<script language="javascript">
$(document).ready(function(){
    $("#cod_administrador").on('change', function () {
            var cod_administrador = $(this).val();
            var fecha_ymd_venta_producto = $('#fecha_ymd_venta_producto').val();
            var total_base_cierre_caja = $('#total_base_cierre_caja').val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_venta_producto";
            var datos_enviar = 'cod_administrador='+cod_administrador+'&fecha_ymd_venta_producto='+fecha_ymd_venta_producto+'&total_base_cierre_caja='+total_base_cierre_caja+'&campo='+campo+'&tipo_ajax='+tipo_ajax;

	   		$.ajax({
	            type: "POST",
	            url: "../admin/calcular_venta_conteo_monedas_billetes_nominacion_ajax.php",
	            data: { cod_administrador: cod_administrador, fecha_ymd_venta_producto: fecha_ymd_venta_producto, total_base_cierre_caja: total_base_cierre_caja, campo: campo, tipo_ajax: tipo_ajax }, 
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
	          		var total_base_mas_fisico_cierre_caja = respuesta.total_base_mas_fisico_cierre_caja;

	                $("#total_sistema_cierre_caja_oculto").val(total_sistema_cierre_caja);
	                $("#total_sistema_contado_efectivo_cierre_caja_oculto").val(total_sistema_contado_efectivo_cierre_caja);
	                $("#total_sistema_cierre_caja").html(total_sistema_cierre_caja.toLocaleString("es-ES"));
	                $("#total_sistema_contado_efectivo_cierre_caja").html(total_sistema_contado_efectivo_cierre_caja.toLocaleString("es-ES"));
	                $("#total_sistema_credito_cierre_caja").html(total_sistema_credito_cierre_caja.toLocaleString("es-ES"));
	                $("#total_base_mas_fisico_cierre_caja").val(total_base_mas_fisico_cierre_caja);
	                $("#total_base_cierre_caja").html(total_base_cierre_caja.toLocaleString("es-ES"));
	                $("#total_base_mas_fisico_cierre_caja_oculto").val(total_base_cierre_caja);
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
            var total_base_cierre_caja = $('#total_base_cierre_caja').val();
            var campo = $(this).attr("name");
            var tipo_ajax = "tbl15_venta_producto";
            var datos_enviar = 'cod_administrador='+cod_administrador+'&fecha_ymd_venta_producto='+fecha_ymd_venta_producto+'&total_base_cierre_caja='+total_base_cierre_caja+'&campo='+campo+'&tipo_ajax='+tipo_ajax;

	   		$.ajax({
	            type: "POST",
	            url: "../admin/calcular_venta_conteo_monedas_billetes_nominacion_ajax.php",
	            data: { cod_administrador: cod_administrador, fecha_ymd_venta_producto: fecha_ymd_venta_producto, total_base_cierre_caja: total_base_cierre_caja, campo: campo, tipo_ajax: tipo_ajax }, 
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
	          		var total_base_mas_fisico_cierre_caja = respuesta.total_base_mas_fisico_cierre_caja;

	                $("#total_sistema_cierre_caja_oculto").val(total_sistema_cierre_caja);
	                $("#total_sistema_contado_efectivo_cierre_caja_oculto").val(total_sistema_contado_efectivo_cierre_caja);
	                $("#total_sistema_cierre_caja").html(total_sistema_cierre_caja.toLocaleString("es-ES"));
	                $("#total_sistema_contado_efectivo_cierre_caja").html(total_sistema_contado_efectivo_cierre_caja.toLocaleString("es-ES"));
	                $("#total_sistema_credito_cierre_caja").html(total_sistema_credito_cierre_caja.toLocaleString("es-ES"));
	                $("#total_base_mas_fisico_cierre_caja").val(total_base_mas_fisico_cierre_caja);
	                $("#total_base_cierre_caja").html(total_base_cierre_caja.toLocaleString("es-ES"));
	                $("#total_base_mas_fisico_cierre_caja_oculto").val(total_base_cierre_caja);
	            }
	   		});
    });
});
</script>

</body>
</html>