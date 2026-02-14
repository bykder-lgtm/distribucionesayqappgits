<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');

if ((isset($_GET['cod_pyg'])) && ($_GET['cod_pyg'] != "")) {

$cod_pyg = intval($_GET["cod_pyg"]);
$pagina = $_GET["pagina"];

$borrar_sql = ("DELETE FROM tbl15_pyg WHERE cod_pyg = '$cod_pyg'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = ("DELETE FROM tbl15_ingre_operacional WHERE cod_pyg = '$cod_pyg'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = ("DELETE FROM tbl15_costo_operacional WHERE cod_pyg = '$cod_pyg'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = ("DELETE FROM tbl15_gasto_operacional WHERE cod_pyg = '$cod_pyg'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
<?php } ?>