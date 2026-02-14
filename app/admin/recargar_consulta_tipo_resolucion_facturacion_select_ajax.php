<?php include_once('../conexiones/conexione.php'); ?>

<?php 
if ($_REQUEST['campo'] == 'cod_origen_resolucion_facturacion') {
	$cod_origen_resolucion_facturacion   = addslashes($_REQUEST['valor']);
	?>
    <select name="nombre_tipo_resolucion_facturacion" id="nombre_tipo_resolucion_facturacion" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
	<?php if (isset($cod_origen_resolucion_facturacion)) { echo ""; } else { echo ""; }
	$consulta2_sql = "SELECT cod_tipo_resolucion_facturacion, nombre_tipo_resolucion_facturacion FROM tbl15_tipo_resolucion_facturacion WHERE (cod_origen_resolucion_facturacion = '$cod_origen_resolucion_facturacion') ORDER BY nombre_tipo_resolucion_facturacion ASC";
	$consulta2 = mysqli_query($conectar, $consulta2_sql);
	while ($datos2 = mysqli_fetch_assoc($consulta2)) {

	$codigo                = $datos2['nombre_tipo_resolucion_facturacion'];
	$nombre                = $datos2['nombre_tipo_resolucion_facturacion'];
	echo "<option value='".$codigo."'>".$nombre."</option>"; } ?>
	</select>
<?php } ?>