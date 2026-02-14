<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar = addslashes($_POST['buscar']);

if($buscar <> NULL) {

$sql_laboratorio = "SELECT cod_laboratorio, nombre_laboratorio, cod_estado, cod_tipo_historia_clinica FROM tbl15_laboratorio WHERE nombre_laboratorio LIKE '%$buscar%' ORDER BY nombre_laboratorio ASC";
$consulta_laboratorio = mysqli_query($conectar, $sql_laboratorio);
$total_resul = mysqli_num_rows($consulta_laboratorio);
}
if ($total_resul <> 0) {
?>
<table border="1" class="table table-responsive" style="height:50px; width:1024px">
<thead>
<tr>
<th>NOMBRE LABORATORIO</th>
</tr>
</thead>
<tbody>
<?php
while ($datos_cie = mysqli_fetch_assoc($consulta_laboratorio)) {
$cod_laboratorio = $datos_cie['cod_laboratorio'];
$nombre_laboratorio = $datos_cie['nombre_laboratorio'];
?>
<tr>
<td><?php echo ($nombre_laboratorio) ?></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php } else { } ?>