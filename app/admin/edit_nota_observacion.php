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
<?php $pagina = addslashes($_GET['pagina']); ?>

<?php
$cod_nota_observacion                           = intval($_GET['cod_nota_observacion']);

$mostrar_datos_sql = "SELECT * FROM tbl15_nota_observacion WHERE cod_nota_observacion = '$cod_nota_observacion'";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
$matriz_consulta = mysqli_fetch_assoc($consulta);

$nombre_nota_observacion                        = $matriz_consulta['nombre_nota_observacion'];
$fecha_ymd                                      = $matriz_consulta['fecha_ymd'];
$cuenta                                         = $matriz_consulta['cuenta'];
$cod_tipo_nota_observacion                      = $matriz_consulta['cod_tipo_nota_observacion'];
$cod_info_factura_venta                         = $matriz_consulta['cod_info_factura_venta'];
$cod_info_factura_compra                        = $matriz_consulta['cod_info_factura_compra'];
$cod_info_cotizacion_factura_compra             = $matriz_consulta['cod_info_cotizacion_factura_compra'];
$cod_info_cotizacion_factura_venta              = $matriz_consulta['cod_info_cotizacion_factura_venta'];
$cod_info_factura_auditoria                     = $matriz_consulta['cod_info_factura_auditoria'];
$cod_info_factura_transferencia                 = $matriz_consulta['cod_info_factura_transferencia'];
$cod_info_factura_transferencia_bodega_entrada  = $matriz_consulta['cod_info_factura_transferencia_bodega_entrada'];
$cod_info_factura_transferencia_bodega          = $matriz_consulta['cod_info_factura_transferencia_bodega'];
$cod_movimiento_contable                        = $matriz_consulta['cod_movimiento_contable'];
$cod_egreso                                     = $matriz_consulta['cod_egreso'];
$url_img_orig_producto                          = $matriz_consulta['url_img_orig_producto'];
$url_img_min_producto                           = $matriz_consulta['url_img_min_producto'];

if ($cod_tipo_nota_observacion == 1) { //NOTAS Y OBSERVACIONES
	$pagina = $pagina;
	$titulo_celda = "";
} elseif ($cod_tipo_nota_observacion == 2) { //SOPORTES FACTURA DE VENTA
	$pagina = $pagina.'?cod_info_factura_venta='.$cod_info_factura_venta;
	$titulo_celda = "ID VENTA";
} elseif ($cod_tipo_nota_observacion == 3) { //SOPORTES FACTURA DE COMPRA
	$pagina = $pagina.'?cod_info_factura_compra='.$cod_info_factura_compra;
	$titulo_celda = "ID COMPRA";
} elseif ($cod_tipo_nota_observacion == 4) { //SOPORTES COTIZACIONES DE COMPRA
	$pagina = $pagina;
	$titulo_celda = "";
} elseif ($cod_tipo_nota_observacion == 5) { //SOPORTES COTIZACIONES DE VENTA
	$pagina = $pagina;
	$titulo_celda = "";
} elseif ($cod_tipo_nota_observacion == 6) { //SOPORTES AUDITORIA
	$pagina = $pagina;
	$titulo_celda = "";
} elseif ($cod_tipo_nota_observacion == 7) { //SOPORTES TRANSFERENCIAS
	$pagina = $pagina;
	$titulo_celda = "";
} elseif ($cod_tipo_nota_observacion == 8) { //SOPORTES TRANSFERENCIA ENTRADA
	$pagina = $pagina;
	$titulo_celda = "";
} elseif ($cod_tipo_nota_observacion == 9) { //SOPORTES TRANSFERENCIA SALIDA
	$pagina = $pagina;
	$titulo_celda = "";
} elseif ($cod_tipo_nota_observacion == 10) { //SOPORTES MOVIMIENTOS CONTABLES
	$pagina = $pagina.'?cod_movimiento_contable='.$cod_movimiento_contable;
	$titulo_celda = "MOVIMIENTOS CONTABLE";
} elseif ($cod_tipo_nota_observacion == 11) { //SOPORTES EGRESOS
	$pagina = $pagina.'?cod_egreso='.$cod_egreso;
	$titulo_celda = "EGRESO";
} else {
	$pagina = $pagina.'?cod_info_factura_compra='.$cod_info_factura_compra;
	$titulo_celda = "";
}
?>
<div id="contentOuterSeparator"></div>
<div class="container">
<div class="divPanel page-content">
<div class="breadcrumbs"><a href="<?php echo $pagina; ?>"><h4>Editar Notas y Observaciones</h4></a></div>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->

<form name="formulario_edicion" accept-charset="utf-8" method="post" action="../admin/edit_nota_observacion_reg.php">
<fieldset>

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<table border="1" class="table table-responsive">
	<thead>
		<tr>
			<th style="text-align:center">ID</th>
			<th style="text-align:center">NOTA OBSERVACION</th>
			<th style="text-align:center">TIPO</th>
			<th style="text-align:center">FECHA</th>
		</tr>
	</thead>
    <tbody>
    	<tr>
			<td style="text-align:center"><?php echo ($cod_nota_observacion) ?></td>
			<td style="text-align:center; width:80%"><input type="text" name="nombre_nota_observacion" value="<?php echo ($nombre_nota_observacion) ?>"  class="input-block-level" required/></td>
			<td style="text-align:center">
	            <select name="cod_tipo_nota_observacion" id="cod_tipo_nota_observacion" class="" data-show-subtext="true" data-live-search="true" style="width: 300px;" tabindex="1" required>
	                <?php if (isset($cod_tipo_nota_observacion)) { echo ""; } else { echo ""; }
	                $consulta2_sql = "SELECT * FROM tbl15_tipo_nota_observacion WHERE (cod_estado = '1')";
	                $consulta2 = mysqli_query($conectar, $consulta2_sql);
	                while ($datos2 = mysqli_fetch_assoc($consulta2)) {
	                if(isset($cod_tipo_nota_observacion) AND $cod_tipo_nota_observacion == $datos2['cod_tipo_nota_observacion']) {
	                $seleccionado = "selected"; } else { $seleccionado = ""; }
	                $codigo = $datos2['cod_tipo_nota_observacion'];
	                $nombre = $datos2['nombre_tipo_nota_observacion'];
	                echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
	            </select>
            </td>
			<td style="text-align:center"><input type="date" name="fecha_ymd" value="<?php echo ($fecha_ymd) ?>"  class="input-block-level" required/></td>
    	</tr>
    	</tbody>
</table>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<hr>
<input type="hidden" name="cod_nota_observacion" value="<?php echo $cod_nota_observacion ?>"/>
<input type="hidden" name="pagina" value="<?php echo $pagina ?>"/>
<input type="hidden" name="ins_edit" value="formulario_insert_edit">

<div class="actions"><td><input type="submit" value="Actualizar Información" name="submit" id="submitButton" class="btn btn-info pull-center" title="Click aqui para enviar" /></td></div>
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