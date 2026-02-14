<?php include_once('../conexiones/conexione.php'); ?>

<?php 
if ($_REQUEST['campo'] == 'nombre_categoria') {
$nombre_categoria = addslashes(strtoupper($_REQUEST['valor']));
?>
<select id="select_nombre_categoria_sub" name="nombre_categoria_sub" class="selectpicker" data-show-subtext="true" data-live-search="true">
<?php if (isset($nombre_categoria_sub)) { echo "<option value='' >Selecione</option>";
} else { echo  "<option value='' selected >Selecione</option>"; }
$consulta2_sql = ("SELECT nombre_categoria_sub FROM tbl15_categoria_sub WHERE nombre_categoria = '$nombre_categoria' ORDER BY nombre_categoria_sub ASC");
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
if(isset($nombre_categoria_sub) and $nombre_categoria_sub == $datos2['nombre_categoria_sub']) {
$seleccionado                    = "selected"; } else { $seleccionado = ""; }
$codigo                          = $datos2['nombre_categoria_sub'];
$nombre                          = $datos2['nombre_categoria_sub'];
?>
<option value="<?php echo $nombre ?>" <?php echo $seleccionado ?>><?php echo $nombre ?></option>
<?php } ?>
</select>
<?php } ?>