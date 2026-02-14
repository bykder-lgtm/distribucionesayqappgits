<?php error_reporting(E_ALL ^ E_NOTICE);
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php'); 
 
include_once("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	} else { header("Location:../index.php");
}
date_default_timezone_set("America/Bogota");
$cuenta_actual             = addslashes($_SESSION['usuario']);
$cuenta                    = addslashes($_SESSION['usuario']);
$cod_caja_virtual          = addslashes($_SESSION['cod_caja_virtual']);

if (isset($_GET['cod_cuentas_pagar'])) {
	$cod_cuentas_pagar                = intval($_GET['cod_cuentas_pagar']);
	$cod_factura                      = addslashes($_GET['cod_factura']);
	$cod_info_factura_compra          = intval($_GET['cod_info_factura_compra']);
	$cod_tercero                      = intval($_GET['cod_tercero']);
	$cod_estado_pago                  = intval($_GET['cod_estado_pago']);
	$pagina                           = addslashes($_GET['pagina']);
	$pagina_redirect                  = $pagina.'?cod_tercero='.$cod_tercero;

	$sql_data = sprintf("UPDATE tbl15_cuentas_pagar SET cod_estado_pago = '$cod_estado_pago' WHERE (cod_cuentas_pagar = '$cod_cuentas_pagar')");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">
<?php
}

?>