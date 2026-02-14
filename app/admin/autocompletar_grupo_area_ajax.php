<?php
include_once('../conexiones/conexione.php');
//----------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------//
$buscar = addslashes($_REQUEST['term']);

if($buscar <> NULL) {

$retorno_array = array();
$retorno_array2 = array();

$sql_grupo_area = "SELECT * FROM tbl15_grupo_area WHERE nombre_grupo_area LIKE '%$buscar%'";
$consulta_grupo_area = mysqli_query($conectar, $sql_grupo_area);
$total_resul = mysqli_num_rows($consulta_grupo_area);

while ($datos_grupo_area = mysqli_fetch_assoc($consulta_grupo_area)) {
$cod_grupo_area                              = $datos_grupo_area['cod_grupo_area'];
$nombre_grupo_area                           = $datos_grupo_area['nombre_grupo_area'];
$datos_array['id']                           = $cod_grupo_area;
$datos_array['value']                        = $nombre_grupo_area;
$datos_array['cod_grupo_area']               = $cod_grupo_area;
$datos_array['nombre_grupo_area']            = $nombre_grupo_area;

array_push($retorno_array, $datos_array);
}
echo json_encode($retorno_array);
} else { } ?>