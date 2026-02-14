<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar = addslashes($_POST['buscar']);

if($buscar <> NULL) {

$sql_cie10 = "SELECT cod_cie10, codigo_cie10, descripcion_cie10 FROM tbl15_cie10 WHERE descripcion_cie10 LIKE '%$buscar%' AND cod_estado_cie10 = '1' ORDER BY codigo_cie10 ASC";
$consulta_cie10 = mysqli_query($conectar, $sql_cie10);
$total_resul = mysqli_num_rows($consulta_cie10);
}
if ($total_resul <> 0) {
?>
<table border="1" class="table table-responsive" style="height:50px; width:1024px">
<thead>
<tr>
<th>DESCRIPCIÓN CIE 10</th>
<th>CODIGO CIE 10</th>
</tr>
</thead>
<tbody>
<?php
while ($datos_cie = mysqli_fetch_assoc($consulta_cie10)) {
$cod_cie10 = $datos_cie['cod_cie10'];
$codigo_cie10 = $datos_cie['codigo_cie10'];
$descripcion_cie10 = $datos_cie['descripcion_cie10'];
?>
<tr>
<td><?php echo ($descripcion_cie10) ?></td>
<td><?php echo ($codigo_cie10) ?></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php } else { } ?>