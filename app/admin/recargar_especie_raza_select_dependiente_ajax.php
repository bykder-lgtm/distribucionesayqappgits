<?php include_once('../conexiones/conexione.php'); ?>

<?php 
if ($_REQUEST['campo'] == 'nombre_especie') {
$nombre_especie = addslashes(strtoupper($_REQUEST['valor']));
?>
<select id="select_nombre_raza" name="nombre_raza" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($nombre_raza)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT nombre_raza FROM tbl15_raza WHERE nombre_especie = '$nombre_especie' ORDER BY nombre_raza ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_raza) and $nombre_raza == $datos2['nombre_raza']) {
$seleccionado                    = "selected"; } else { $seleccionado = ""; }
$codigo                          = $datos2['nombre_raza'];
$nombre                          = $datos2['nombre_raza'];
?>
<option value="<?php echo $nombre ?>" <?php echo $seleccionado ?>><?php echo $nombre ?></option>
<?php } ?>
</select>
<?php } ?>