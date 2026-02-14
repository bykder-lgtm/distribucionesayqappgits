<?php include_once('../conexiones/conexione.php'); ?>

<?php 
if ($_REQUEST['campo'] == 'nombre_categoria') {
$nombre_categoria = addslashes(strtoupper($_REQUEST['valor']));
?>
<select name="nombre_categoria" class="form-control" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_categoria)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT nombre_categoria FROM tbl15_categoria ORDER BY cod_categoria ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_categoria) and $nombre_categoria == $datos2['nombre_categoria']) {
$seleccionado                    = "selected"; } else { $seleccionado = ""; }
$codigo                          = $datos2['nombre_categoria'];
$nombre                          = $datos2['nombre_categoria'];
?>
<option value="<?php echo $nombre ?>" <?php echo $seleccionado ?>><?php echo $nombre ?></option>
<?php } ?>
</select>
<?php } ?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php 
if ($_REQUEST['campo'] == 'nombre_marca') {
$nombre_marca = addslashes(strtoupper($_REQUEST['valor']));
?>
<select name="nombre_marca" class="form-control" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_marca)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT nombre_marca FROM tbl15_marca ORDER BY cod_marca ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_marca) and $nombre_marca == $datos2['nombre_marca']) {
$seleccionado                    = "selected"; } else { $seleccionado = ""; }
$codigo                          = $datos2['nombre_marca'];
$nombre                          = $datos2['nombre_marca'];
?>
<option value="<?php echo $nombre ?>" <?php echo $seleccionado ?>><?php echo $nombre ?></option>
<?php } ?>
</select>
<?php } ?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php 
if ($_REQUEST['campo'] == 'nombre_tipo_aplicacion') {
$nombre_tipo_aplicacion = addslashes(strtoupper($_REQUEST['valor']));
?>
<select name="nombre_tipo_aplicacion" class="form-control" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_tipo_aplicacion)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT nombre_tipo_aplicacion FROM tbl15_tipo_aplicacion ORDER BY cod_tipo_aplicacion ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_tipo_aplicacion) and $nombre_tipo_aplicacion == $datos2['nombre_tipo_aplicacion']) {
$seleccionado                    = "selected"; } else { $seleccionado = ""; }
$codigo                          = $datos2['nombre_tipo_aplicacion'];
$nombre                          = $datos2['nombre_tipo_aplicacion'];
?>
<option value="<?php echo $nombre ?>" <?php echo $seleccionado ?>><?php echo $nombre ?></option>
<?php } ?>
</select>
<?php } ?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php 
if ($_REQUEST['campo'] == 'nombre_tipo_referencia') {
$nombre_tipo_referencia = addslashes(strtoupper($_REQUEST['valor']));
?>
<select name="nombre_tipo_referencia" class="form-control" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_tipo_referencia)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT nombre_tipo_referencia FROM tbl15_tipo_referencia ORDER BY cod_tipo_referencia ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_tipo_referencia) and $nombre_tipo_referencia == $datos2['nombre_tipo_referencia']) {
$seleccionado                    = "selected"; } else { $seleccionado = ""; }
$codigo                          = $datos2['nombre_tipo_referencia'];
$nombre                          = $datos2['nombre_tipo_referencia'];
?>
<option value="<?php echo $nombre ?>" <?php echo $seleccionado ?>><?php echo $nombre ?></option>
<?php } ?>
</select>
<?php } ?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php 
if ($_REQUEST['campo'] == 'nombre_promocion') {
$nombre_promocion = addslashes(strtoupper($_REQUEST['valor']));
?>
<select name="nombre_promocion" class="form-control" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_promocion)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT nombre_promocion FROM tbl15_promocion ORDER BY cod_promocion ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_promocion) and $nombre_promocion == $datos2['nombre_promocion']) {
$seleccionado                    = "selected"; } else { $seleccionado = ""; }
$codigo                          = $datos2['nombre_promocion'];
$nombre                          = $datos2['nombre_promocion'];
?>
<option value="<?php echo $nombre ?>" <?php echo $seleccionado ?>><?php echo $nombre ?></option>
<?php } ?>
</select>
<?php } ?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php 
if ($_REQUEST['campo'] == 'nombre_estado') {
$nombre_estado = addslashes(strtoupper($_REQUEST['valor']));
?>
<select name="nombre_estado" class="form-control" data-show-subtext="true" data-live-search="true" required>
<?php if (isset($nombre_estado)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT nombre_estado FROM tbl15_estado ORDER BY cod_estado ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_estado) and $nombre_estado == $datos2['nombre_estado']) {
$seleccionado                    = "selected"; } else { $seleccionado = ""; }
$codigo                          = $datos2['nombre_estado'];
$nombre                          = $datos2['nombre_estado'];
?>
<option value="<?php echo $nombre ?>" <?php echo $seleccionado ?>><?php echo $nombre ?></option>
<?php } ?>
</select>
<?php } ?>

<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->