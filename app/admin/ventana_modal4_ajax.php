<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//$cod_estado_cie10 = intval($_GET['cod_estado_cie10']);
?>
<table border="1" class="table table-responsive">
<thead>
  <tr>
    <th>DESCRIPCIÓN CIE 10</th>
    <th>CODIGO CIE 10</th>
  </tr>
</thead>
<tbody>
<?php
$consulta2_sql = "SELECT cod_cie10, codigo_cie10, descripcion_cie10 FROM tbl15_cie10 WHERE cod_estado_cie10 = '1' ORDER BY codigo_cie10 ASC";
$consulta2 = mysqli_query($conectar, $consulta2_sql);
while ($datos2 = mysqli_fetch_assoc($consulta2)) {
$cod_cie10 = $datos2['cod_cie10'];
$codigo_cie10 = $datos2['codigo_cie10'];
$descripcion_cie10 = $datos2['descripcion_cie10'];
?>
  <tr>
    <td><?php echo ($codigo_cie10) ?></td>
    <td><?php echo ($descripcion_cie10) ?></td>
  </tr>
<?php 
} 
?>
</tbody>
</table>