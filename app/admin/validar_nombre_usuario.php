<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');

if ($_GET['nombre_usuario']) {

$cuenta = addslashes($_GET['nombre_usuario']);

$obtener_cedula = "SELECT cuenta FROM tbl15_administrador WHERE cuenta = '$cuenta'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$datos = mysqli_fetch_assoc($consultar_cedula);
$total = mysqli_num_rows($consultar_cedula);

if($total == 0) {
echo "<strong></strong>";
} else {
?>
<img src=../imagenes/advertencia.gif alt='advertencia'> 
<strong><i><font color='yellow' size='3'>EL USUARIO: </i><?php echo $cuenta?> <i>YA ESTA REGISTRADO</font></strong> 
<img src=../imagenes/advertencia.gif alt='advertencia'>
<?php } } ?>