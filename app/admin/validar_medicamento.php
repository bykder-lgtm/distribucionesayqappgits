<?php
sleep(1);
include_once('../conexiones/conexione.php');

if($_REQUEST) {
$nombre_medicamento = addslashes($_GET['nombre_medicamento']);

$obtener_nombre_laboratorio = "SELECT nombre_medicamento FROM tbl15_medicamento WHERE nombre_medicamento = '".($nombre_medicamento)."'";
$consultar_nombre_laboratorio = mysqli_query($conectar, $obtener_nombre_laboratorio) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_nombre_laboratorio);

$nombre_medicamento = $info_cliente['nombre_medicamento'];

if(mysqli_num_rows(@$consultar_nombre_laboratorio) > 0) 	{
echo '<img src="../imagenes/advertencia.gif"> EL MEDICAMENTO '. $nombre_medicamento.' YA ESTA REGISTRADO.</div>';
} else {
//echo '<img src="../imagenes/si.jpg">Disponible</div>';
}
}
?>