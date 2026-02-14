<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');

if ((isset($_GET['cod_balance_general'])) && ($_GET['cod_balance_general'] != "")) {

$cod_balance_general        = intval($_GET["cod_balance_general"]);
$pagina                     = $_GET["pagina"];

$borrar_sql = ("DELETE FROM tbl15_balance_general WHERE cod_balance_general = '$cod_balance_general'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = ("DELETE FROM tbl15_activo_corriente WHERE cod_balance_general = '$cod_balance_general'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = ("DELETE FROM tbl15_propied_planta_equipo WHERE cod_balance_general = '$cod_balance_general'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = ("DELETE FROM tbl15_pasivo_corriente WHERE cod_balance_general = '$cod_balance_general'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = ("DELETE FROM tbl15_patrimonio WHERE cod_balance_general = '$cod_balance_general'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
<?php } ?>