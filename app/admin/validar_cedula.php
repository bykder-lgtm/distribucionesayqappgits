<?php
sleep(1);
include_once('../conexiones/conexione.php');

if($_GET['cedula'] <> '') {
$cedula = intval($_GET['cedula']);

$obtener_cedula = "SELECT cod_cliente, nombres, apellido1, apellido2, cedula FROM tbl15_cliente WHERE cedula = '".($cedula)."'";
$consultar_cedula = mysqli_query($conectar, $obtener_cedula) or die(mysqli_error($conectar));
$info_cliente = mysqli_fetch_assoc($consultar_cedula);

$cod_cliente = $info_cliente['cod_cliente'];
$nombres = $info_cliente['nombres'];
$apellido1 = $info_cliente['apellido1'];
$apellido2 = $info_cliente['apellido2'];

$nom_ape = $nombres.' '.$apellido1.' '.$apellido2;
$pagina = "/sistemaseditaxe/mysqli/consultorioips/admin/lista_paciente.php";

if(mysqli_num_rows(@$consultar_cedula) > 0) { ?>
<a href="../admin/reg_asignar_profesional_paciente_firma_tactil.php?cod_cliente=<?php echo $cod_cliente ?>&pagina=<?php echo $pagina ?>"><img src="../imagenes/crear_historia_clinica.gif"><font color="red">LA CEDULA <?php echo $cedula ?> YA ESTA REGISTRADA: <?php echo $nom_ape ?></font></a>
<?php } else {
//echo '<img src="../imagenes/si.jpg">Disponible</div>';
}
}
?>