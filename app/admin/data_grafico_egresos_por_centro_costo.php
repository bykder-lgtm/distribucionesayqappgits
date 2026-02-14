<?php require_once('../conexiones/conexione.php'); 

$vector = array();

$sql_egreso = "SELECT SUM(costo) AS costo, nombre_ccosto FROM tbl15_egreso GROUP BY nombre_ccosto DESC";
$result = mysqliquery($conectar, $sql_egreso) or die(mysqli_error($conectar));
while($datos = mysqli_fetch_array($result)) {

$row[0] = utf8_encode($datos['nombre_ccosto']);
$row[1] = ($datos['costo']);
array_push($vector,$row);
}
print json_encode($vector, JSON_NUMERIC_CHECK);
?> 
