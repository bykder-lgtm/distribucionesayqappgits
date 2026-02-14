<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php'); 
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
$cuenta_actual = addslashes($_SESSION['usuario']);

$tab       = addslashes($_GET['tab']);
$tipo      = addslashes($_GET['tipo']);
$campo     = addslashes($_GET['campo']);
$pagina    = addslashes($_GET['pagina']);

if ($tipo == 'eliminar' && $tab == 'tbl15_info_plan_accion_correctiva_preventiva_mejora') {
$cod_info_plan_accion_correctiva_preventiva_mejora = intval($_GET['llave']);

$borrar_sql = sprintf("DELETE FROM tbl15_info_plan_accion_correctiva_preventiva_mejora WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

$borrar_sql = sprintf("DELETE FROM tbl15_plan_accion_correctiva_preventiva_mejora WHERE cod_info_plan_accion_correctiva_preventiva_mejora = '$cod_info_plan_accion_correctiva_preventiva_mejora'");
$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/admin/lista_info_factura_plan_accion_correctiva_preventiva_mejora_venta.php">
<?php } ?>
