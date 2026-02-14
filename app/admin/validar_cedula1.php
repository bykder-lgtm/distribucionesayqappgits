<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
$cedula = intval($_GET['cedula']);

$obtener_cedula = "SELECT nombres, apellidos, cedula FROM tbl15_cliente WHERE cedula = '$cedula'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$datos = mysqli_fetch_assoc($consultar_cedula);
$total = mysqli_num_rows($consultar_cedula);

$tbl15_cliente = $datos['nombres'].' '.$datos['apellidos'];
if($total == 0) {
} else {
?>
LA CEDULA: <?php echo $cedula?> YA ESTA REGISTRADA A NOMBRE DE: <?php echo ($tbl15_cliente)?>
<?php
}
?>