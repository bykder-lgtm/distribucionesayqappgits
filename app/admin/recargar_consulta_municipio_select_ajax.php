<?php include_once('../conexiones/conexione.php'); ?>

<?php 
if ($_REQUEST['campo'] == 'cod_departamento') {
	$cod_departamento   = addslashes($_REQUEST['valor']);
	?>
    <select name="cod_municipio" id="cod_municipio" class="chosen-select" data-show-subtext="true" data-live-search="true" required>
	<?php if (isset($cod_departamento)) { echo "<option value='0' >Selecione</option>"; } else { echo  "<option value='0' selected >Selecione</option>"; }
	$consulta2_sql = "SELECT cod_municipio, nombre_municipio FROM tbl15_municipio WHERE (cod_departamento = '$cod_departamento') ORDER BY nombre_municipio ASC";
	$consulta2 = mysqli_query($conectar, $consulta2_sql);
	while ($datos2 = mysqli_fetch_assoc($consulta2)) {

	$codigo                = $datos2['cod_municipio'];
	$nombre                = $datos2['nombre_municipio'];
	echo "<option value='".$codigo."'>".$nombre."</option>"; } ?>
	</select>
<?php } ?>