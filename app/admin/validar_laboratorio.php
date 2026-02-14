<?php
sleep(1);
include_once('../conexiones/conexione.php');

if($_REQUEST) {
$nombre_laboratorio = addslashes($_GET['nombre_laboratorio']);

$obtener_nombre_laboratorio = "SELECT nombre_laboratorio FROM tbl15_laboratorio WHERE nombre_laboratorio = '".($nombre_laboratorio)."'";
$consultar_nombre_laboratorio = mysqli_query($conectar, $obtener_nombre_laboratorio) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_nombre_laboratorio);

$nombre_laboratorio = $info_cliente['nombre_laboratorio'];

if(mysqli_num_rows(@$consultar_nombre_laboratorio) > 0) 	{
echo '<img src="../imagenes/advertencia.gif"> EL LABORATORIO '. $nombre_laboratorio.' YA ESTA REGISTRADO.</div>';
} else {
//echo '<img src="../imagenes/si.jpg">Disponible</div>';
}
}
?>