<?php
sleep(1);
include_once('../conexiones/conexione.php');

if($_REQUEST) {
$nombre_ayuda_diagnostica = addslashes($_GET['nombre_ayuda_diagnostica']);

$obtener_nombre_laboratorio = "SELECT nombre_ayuda_diagnostica FROM tbl15_ayuda_diagnostica WHERE nombre_ayuda_diagnostica = '".($nombre_ayuda_diagnostica)."'";
$consultar_nombre_laboratorio = mysqli_query($conectar, $obtener_nombre_laboratorio) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_nombre_laboratorio);

$nombre_ayuda_diagnostica = $info_cliente['nombre_ayuda_diagnostica'];

if(mysqli_num_rows(@$consultar_nombre_laboratorio) > 0) 	{
echo '<img src="../imagenes/advertencia.gif"> LA AYUDA DIAGNOSTICA '. $nombre_ayuda_diagnostica.' YA ESTA REGISTRADA.</div>';
} else {
//echo '<img src="../imagenes/si.jpg">Disponible</div>';
}
}
?>