<?php
include_once('../conexiones/conexione.php');

$sql_grupo_area = "SELECT * FROM tbl15_grupo_area";
$consulta_grupo_area = mysqli_query($conectar, $sql_grupo_area) or die(mysqli_error($conectar));

echo '<option value="0">Seleccione</option>';

while ($datos_grupo_area = mysqli_fetch_assoc($consulta_grupo_area)) {
$cod_grupo_area = $datos_grupo_area['cod_grupo_area'];
$nombre_grupo_area = $datos_grupo_area['nombre_grupo_area'];

echo '<option value="' . $cod_grupo_area. '">' . $nombre_grupo_area . '</option>' . "\n";
}