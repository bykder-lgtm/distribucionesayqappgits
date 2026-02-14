<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual = addslashes($_SESSION['usuario']);

if (isset($_GET['cod_historia_clinica'])) {

$cod_historia_clinica                 = intval($_GET['cod_historia_clinica']);
$cod_cliente                          = intval($_GET['cod_cliente']);
$tabla                                = addslashes($_GET['tabla']);
$foco                                 = addslashes($_GET['foco']);
$pagina                               = addslashes($_GET['pagina']);
$cuenta                               = $cuenta_actual;

$url_redirect =  $pagina.'?cod_historia_clinica='.$cod_historia_clinica.'&cod_cliente='.$cod_cliente.'&pagina='.$pagina.'&foco='.$foco;

$agreg_reg = "INSERT INTO $tabla (cod_historia_clinica) VALUES ('$cod_historia_clinica')";
$resultado_ventas = mysqli_query($conectar, $agreg_reg) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $url_redirect?>">
<?php } ?>