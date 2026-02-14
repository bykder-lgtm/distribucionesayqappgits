<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css.php'); ?>
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
</head>
<body id="pageBody">
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php include_once('../seguridad/seguridad_diseno_plantillas.php'); ?>
<!-- 1******************************************************* MODULO MENU DE NAVEGACION *********************************************** -->
<?php
$cod_info_factura_venta                              = intval($_GET['cod_info_factura_venta']);
$pagina                                              = addslashes($_GET['pagina']);
$fecha_entrega_renta_alquiler                        = date("Y-m-d");
$hora_entrega_renta_alquiler                         = date("H:i:s");

$mostrar_datos_sql = "SELECT * FROM tbl15_info_factura_venta WHERE cod_info_factura_venta = '$cod_info_factura_venta'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$cod_info_factura_venta                          = $matriz_consulta['cod_info_factura_venta'];
$cod_tercero                                     = $matriz_consulta['cod_tercero'];
$cod_factura                                     = $matriz_consulta['cod_factura'];
$total_precio_venta                              = $matriz_consulta['total_precio_venta'];
$fecha_ini_renta_alquiler                        = $matriz_consulta['fecha_ini_renta_alquiler'];
$fecha_fin_renta_alquiler                        = $matriz_consulta['fecha_fin_renta_alquiler'];
$cod_estado_alquiler_renta                       = $matriz_consulta['cod_estado_alquiler_renta'];

$sql_tipo_notificacion_alerta_renovacion = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_tipo_notificacion_alerta_renovacion = mysqli_query($conectar, $sql_tipo_notificacion_alerta_renovacion);
$datos_tipo_notificacion_alerta_renovacion = mysqli_fetch_assoc($consulta_tipo_notificacion_alerta_renovacion);

$nombre1_tercero                                 = $datos_tipo_notificacion_alerta_renovacion['nombre1_tercero'];
$nombre2_tercero                                 = $datos_tipo_notificacion_alerta_renovacion['nombre2_tercero'];
$apellido1_tercero                               = $datos_tipo_notificacion_alerta_renovacion['apellido1_tercero'];
$apellido2_tercero                               = $datos_tipo_notificacion_alerta_renovacion['apellido2_tercero'];

$nombres_apellidos_tercero                       = $nombre1_tercero.' '.$nombre2_tercero.' '.$apellido1_tercero.' '.$apellido2_tercero;
$nombre_producto_concat                          = '';

$sql_datos_venta_temp = "SELECT cod_producto_barra, und_venta, nombre_producto FROM tbl15_venta_producto WHERE (cod_info_factura_venta = '$cod_info_factura_venta') ORDER BY cod_venta_producto DESC";
$consulta_datos_venta_temp = mysqli_query($conectar, $sql_datos_venta_temp);
while ($datos_venta_temp = mysqli_fetch_assoc($consulta_datos_venta_temp)) {

    $nombre_producto_con                 = $datos_venta_temp['nombre_producto'];
    $und_venta_con                       = $datos_venta_temp['und_venta'];
    $nombre_producto_concat             .= "".$nombre_producto_con.' | <br>';
}
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Marcar Entrega Alquiler - Renta</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/marcar_entrega_alquiler_renta_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
		    <th style="text-align:center">ID</th>
		    <th style="text-align:center">TERCERO</th>
		    <th style="text-align:center"></th>
		    <th style="text-align:center">VALOR</th>
			<th style="text-align:center">FECHA INICIO</th>
			<th style="text-align:center">FECHA FINAL</th>
		    <th style="text-align:center">FECHA ENTREGA ALQUILER - RENTA</th>
		    <th style="text-align:center">HORA ENTREGA ALQUILER - RENTA</th>
		</tr>
	</thead>
    <tbody>
	    <tr>
			<td style="text-align:center;"><?php echo $cod_info_factura_venta; ?></td>
		    <td style="text-align:left;"><?php echo $nombres_apellidos_tercero ?></td>
			<td style="text-align:left;"><?php echo $nombre_producto_concat ?></td>
			<td style="text-align:center;"><?php echo number_format($total_precio_venta, 0, ",", "."); ?></td>
			<td style="text-align:center;"><?php echo $fecha_ini_renta_alquiler; ?></td>
			<td style="text-align:center;"><?php echo $fecha_fin_renta_alquiler; ?></td>
		    <td style="text-align:center;"><input class="input-block-level" name="fecha_entrega_renta_alquiler" type="date" value="<?php echo $fecha_entrega_renta_alquiler ?>" placeholder="" required/></td>
		    <td style="text-align:center;"><input class="input-block-level" name="hora_entrega_renta_alquiler" type="time" value="<?php echo $hora_entrega_renta_alquiler ?>" placeholder="" required/></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_info_factura_venta" value="<?php echo $cod_info_factura_venta ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions"><td><input type="submit" value="Registrar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td></div>
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
</body>
</html>