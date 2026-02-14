<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar = addslashes($_POST['buscar']);

if($buscar <> NULL) {

$consulta2_sql = "SELECT cod_cie10, codigo_cie10, descripcion_cie10 FROM tbl15_cie10 WHERE descripcion_cie10 LIKE '%$buscar%' AND cod_estado_cie10 = '1' ORDER BY codigo_cie10 ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
$total_resultados = mysqli_num_rows($consulta2);

//echo $total_resultados." Resultados para: ".$buscar."<br>";
}
if ($total_resultados <> 0) {
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
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
$cod_cie10 = $datos2['cod_cie10'];
$codigo_cie10 = $datos2['codigo_cie10'];
$descripcion_cie10 = $datos2['descripcion_cie10'];
?>
  <tr>
    <td><?php echo ($descripcion_cie10) ?></td>
    <td><?php echo ($codigo_cie10) ?></td>
  </tr>
<?php 
} 
?>
</tbody>
</table>
<?php
} else {
}
?>