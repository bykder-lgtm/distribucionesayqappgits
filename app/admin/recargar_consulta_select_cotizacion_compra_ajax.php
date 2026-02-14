<?php include_once('../conexiones/conexione.php'); ?>

<?php 
if ($_REQUEST['campo'] == 'nombres_clientes') {
$identificacion_tercero   = addslashes($_REQUEST['valor']);

$obtener_existencia = "SELECT cod_tercero FROM tbl15_tercero WHERE identificacion_tercero = '".($identificacion_tercero)."'";
$consultar_existencia = mysqli_query($conectar, $obtener_existencia);
$info_existencia = mysqli_fetch_assoc($consultar_existencia);

$cod_tercero                = $info_existencia['cod_tercero'];
?>
<select name="cod_tercero" id="cod_tercero" class="chosen-select" data-show-subtext="true" data-live-search="true">
<?php if (isset($cod_tercero)) { echo "<option value='1' >...</option>";
} else { echo  "<option value='1' selected ></option>"; }
$consulta2_sql = "SELECT cod_tercero, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero 
FROM tbl15_tercero WHERE nombre_tipo_tercero = 'PROVEEDOR' ORDER BY nombre1_tercero ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($cod_tercero) and $cod_tercero == $datos2['cod_tercero']) {
$seleccionado = "selected"; } else { $seleccionado = ""; }
$ceduladb              = $datos2['identificacion_tercero'];
$codigo                = $datos2['cod_tercero'];
$nombres               = $datos2['nombres'];
$apellidos             = $datos2['apellidos'];
$nombre_tipo_tercero   = $datos2['nombre_tipo_tercero'];
$nombre                = $datos2['nombre1_tercero'].' - '.$datos2['identificacion_tercero'];

echo "<option value='".$codigo."' $seleccionado >".$nombre."</option>"; } ?>
</select>
<?php } ?>