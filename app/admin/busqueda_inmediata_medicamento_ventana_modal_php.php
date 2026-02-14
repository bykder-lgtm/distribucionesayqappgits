<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar = addslashes($_POST['buscar']);

if($buscar <> NULL) {

$sql_medicamento = "SELECT cod_medicamento, cod_tipo_historia_clinica, nombre_medicamento, cod_tipo_pos, cod_estado, cod_laboratorio 
FROM tbl15_medicamento WHERE nombre_medicamento LIKE '%$buscar%' ORDER BY nombre_medicamento ASC";
$consulta_medicamento = mysqli_query($conectar, $sql_medicamento);
$total_resul = mysqli_num_rows($consulta_medicamento);

//echo $total_resul." Resultados para: ".$buscar."<br>";
}
if ($total_resul <> 0) {
?>
<table border="1" class="table table-responsive" style="height:50px; width:1024px">
<thead>
<tr>
<th>NOMBRE MEDICAMENTO</th>
</tr>
</thead>
<tbody>
<?php
while ($datos_cie = mysqli_fetch_assoc($consulta_medicamento)) {
$cod_medicamento = $datos_cie['cod_medicamento'];
$nombre_medicamento = $datos_cie['nombre_medicamento'];
?>
<tr>
<td><?php echo ($nombre_medicamento) ?></td>
</tr>
<?php } ?>
</tbody>
</table>
<?php } else { } ?>