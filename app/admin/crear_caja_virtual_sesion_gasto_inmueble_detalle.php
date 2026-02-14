<?php $serguridad_pagina = 1; ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<?php include_once('../admin/01_modulo_diseno_superior.php'); ?>
<!-- 1******************************************************* MODULO SUPERIOR *********************************************** -->
<!-- 1******************************************************* MODULO DE PLANTILLAS CSS *********************************************** -->
<?php include_once('../admin/02_modulo_estilo_css_chosen_600px.php'); ?>
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
<a href="../admin/lista_gasto_inmueble_detalle_temporal_virtual.php"><h4>Crear Gastos a Propietario de Inmuebles</a>
</div>
<hr>
<div class="row-fluid">
 <!--Edit Main Content Area here-->
<div class="span12" id="divMain">
<!-- ***************************************************************************************************************************** -->
<!-- 1******************************************************* INICIO MODULO PRINCIPAL *********************************************** -->
<!-- ***************************************************************************************************************************** -->
<?php
$smtr = 0;
$contador_mesas_array = 1;

if (isset($_GET['pagina'])) { $pagina = addslashes($_GET['pagina']); } else { $pagina = 'facturacion_venta_temporal_producto_manual_pos.php'; } 
$nombre_estado_factura              = 'ABIERTA';

$mesas_caja_en_uso                = array();

$sql_mesas_caja_en_uso = "SELECT cod_base_caja FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (nombre_estado_factura = 'ABIERTA') ORDER BY cod_base_caja";
$consulta_mesas_caja_en_uso = mysqli_query($conectar, $sql_mesas_caja_en_uso);
while ($datos_mesas_caja_en_uso = mysqli_fetch_assoc($consulta_mesas_caja_en_uso)) {

$cod_base_caja_en_uso             = $datos_mesas_caja_en_uso['cod_base_caja'];

$mesas_caja_en_uso[$contador_mesas_array] = $cod_base_caja_en_uso;
$contador_mesas_array ++;
}

if (isset($_GET['pagina'])) { 
$sql_animal = "SELECT MAX(cod_caja_virtual) AS cod_caja_virtual, MAX(cod_base_caja) AS cod_base_caja FROM tbl15_info_gasto_inmueble_detalle_venta";
$resultado_animal = mysqli_query($conectar, $sql_animal);
$info_animal = mysqli_fetch_assoc($resultado_animal);

$cod_caja_virtual                   = $info_animal['cod_caja_virtual'] + 1;
$cod_base_caja                      = $info_animal['cod_base_caja'] + 1;

$sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_gasto_inmueble_detalle_venta WHERE (nombre_estado_factura = '$nombre_estado_factura')";
$consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
$datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

$cod_prioridad                      = $datos_max_prioridad['cod_prioridad'] + 1;

if ($cod_estado_cantidad_caja_mesa_global == 1) { ?>
<table class="table table-striped">
<tr>
<?php for ($i=1; $i < $cantidad_caja_mesa+1; $i++) { 
		if ($smtr % 4 == 0) { echo "<tr></tr>"; }
		$smtr++;
		$indice_mesas_caja_en_uso = array_search($i, $mesas_caja_en_uso, false);
		if ($indice_mesas_caja_en_uso == '') { ?>
		<th style="text-align:center"><a href="../admin/crear_caja_virtual_sesion_gasto_inmueble_detalle_sesion_reg.php?cod_caja_virtual=<?php echo $cod_caja_virtual?>&cod_base_caja=<?php echo $i ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/mesa_caja_disponible.png"><br><?php echo $nombre_concepto_multi_virtual.' '.$i; ?></a></th>
		<?php
		} else { ?>
		<th style="text-align:center"><img src="../imagenes/mesa_caja_disponible_no.png"><br><?php echo $nombre_concepto_multi_virtual.' '.$i; ?></th>
		<?php } ?>
<?php } ?>
</tr>
</table>
<?php } else { ?>
<div class="table-responsive">
<form method="post" name="formulario_de_actualizacion" action="../admin/crear_caja_virtual_sesion_gasto_inmueble_detalle_sesion_reg.php">
<table class="table table-striped">
<tr>
<th style="text-align:left;">ESCOGER CONTRATO:</th>
<td style="text-align:left">
    <select name="cod_factura" id="cod_factura" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
    <?php if (isset($cod_factura)) { echo "<option value='' >Selecione</option>"; } else { echo "<option value='' >Selecione</option>"; }
    $consulta2_sql = ("SELECT * FROM tbl15_cuentas_cobrar WHERE (cod_estado_contrato = '0') GROUP BY cod_factura ASC");
    $consulta2 = mysqli_query($conectar, $consulta2_sql);
    while ($datos2 = mysqli_fetch_assoc($consulta2)) {
    if(isset($cod_factura) and $cod_factura == $datos2['cod_factura']) {
    $seleccionado = "selected"; } else { $seleccionado = ""; }
	$cod_tercero_inquilino          = $datos2['cod_tercero'];
	$cod_tercero_propietario        = $datos2['cod_tercero_propietario'];
	$cod_producto                   = $datos2['cod_producto'];
	$cod_producto_barra             = $datos2['cod_producto_barra'];
	$nombre_producto                = $datos2['nombre_producto'];	 	 	 	

	$sql_inquilino = "SELECT nombre1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero_inquilino')";
	$consulta_inquilino = mysqli_query($conectar, $sql_inquilino) or die(mysqli_error($conectar));
	$datos_inquilino = mysqli_fetch_assoc($consulta_inquilino);

	$nombre1_tercero_inquilino      = $datos_inquilino['nombre1_tercero'];

	$sql_propietario = "SELECT nombre1_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero_propietario')";
	$consulta_propietario = mysqli_query($conectar, $sql_propietario) or die(mysqli_error($conectar));
	$datos_propietario = mysqli_fetch_assoc($consulta_propietario);

	$nombre1_tercero_propietario      = $datos_propietario['nombre1_tercero'];

    $codigo                         = $datos2['cod_factura'];
    $nombre                         = 'CONT: '.$datos2['cod_factura'].' |  PROP: '.$nombre1_tercero_propietario.' ['.$nombre_producto.']';

    echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?></select>
</td>

<input type="hidden" name="cod_caja_virtual" value="<?php echo $cod_caja_virtual; ?>" size="2" required>

<!--
<th style="text-align:left;">PRIORIDAD</th>
<td style="text-align:left;"><input type="number" name="cod_prioridad" value="<?php echo $cod_prioridad; ?>" size="2" required></td>
-->
<td style="text-align:left;"><input type="submit" class="btn btn-success" value="CREAR"></td>
<input type="hidden" name="MM_update" value="formulario_de_actualizacion">
<input type="hidden" name="pagina" value="facturacion_venta_temporal_gasto_inmueble_detalle.php">
</tr>
</table>
</form>
</div>
<?php } ?>

<?php } ?>
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