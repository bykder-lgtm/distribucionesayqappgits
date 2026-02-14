<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);

if (isset($_POST['cod_pyg'])) {

	$cod_pyg                          = intval($_POST['cod_pyg']);
	$total_ingre_operacional          = addslashes($_POST['total_ingre_operacional']);
	$total_costo_operacional          = addslashes($_POST['total_costo_operacional']);
	$total_utilidad_bruta             = addslashes($_POST['total_utilidad_bruta']);
	$total_gasto_operacional          = addslashes($_POST['total_gasto_operacional']);
	$total_resultado_operacional      = addslashes($_POST['total_resultado_operacional']);
	$total_resultado_antes_impuesto   = addslashes($_POST['total_resultado_antes_impuesto']);
	$total_resultado_ejercicio        = addslashes($_POST['total_resultado_ejercicio']);
	$ip                               = $_SERVER["REMOTE_ADDR"];
	$cuenta                           = $cuenta_actual;
	$contador                         = 0;

	$agregar_reg_pyg = "UPDATE tbl15_pyg SET total_ingre_operacional = '$total_ingre_operacional', total_costo_operacional = '$total_costo_operacional',  
	total_utilidad_bruta = '$total_utilidad_bruta', total_gasto_operacional = '$total_gasto_operacional', total_resultado_operacional = '$total_resultado_operacional', 
	total_resultado_antes_impuesto = '$total_resultado_antes_impuesto', total_resultado_ejercicio = '$total_resultado_ejercicio' 
	WHERE cod_pyg = '$cod_pyg'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
	//-----------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------//
	//for ($i=0; $i < $total_datos_ingre_operacional; $i++) {
	foreach ($_POST["cod_ingre_operacional"] as $clave => $cod_ingre_operacional) { 

		$puc_ingre_operacional        = $_POST["puc_ingre_operacional"][$clave];
		$nombre_ingre_operacional     = $_POST["nombre_ingre_operacional"][$clave];
		$costo_ingre_operacional      = $_POST["costo_ingre_operacional"][$clave];

		$agregar_reg_pyg = "UPDATE tbl15_ingre_operacional SET puc_ingre_operacional = '$puc_ingre_operacional', nombre_ingre_operacional = '$nombre_ingre_operacional', costo_ingre_operacional = '$costo_ingre_operacional' 
		WHERE cod_ingre_operacional = '$cod_ingre_operacional'";
		$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
	}
	//-----------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------//
	foreach ($_POST["cod_costo_operacional"] as $clave => $cod_costo_operacional) { 

		$puc_costo_operacional        = $_POST["puc_costo_operacional"][$clave];
		$nombre_costo_operacional     = $_POST["nombre_costo_operacional"][$clave];
		$costo_costo_operacional      = $_POST["costo_costo_operacional"][$clave];

		$agregar_reg_pyg = "UPDATE tbl15_costo_operacional SET puc_costo_operacional = '$puc_costo_operacional', nombre_costo_operacional = '$nombre_costo_operacional', costo_costo_operacional = '$costo_costo_operacional' 
		WHERE cod_costo_operacional = '$cod_costo_operacional'";
		$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
	}
	//-----------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------//
	foreach ($_POST["cod_gasto_operacional"] as $clave => $cod_gasto_operacional) { 

		$puc_gasto_operacional        = $_POST["puc_gasto_operacional"][$clave];
		$nombre_gasto_operacional     = $_POST["nombre_gasto_operacional"][$clave];
		$costo_gasto_operacional      = $_POST["costo_gasto_operacional"][$clave];

		$agregar_reg_pyg = "UPDATE tbl15_gasto_operacional SET puc_gasto_operacional = '$puc_gasto_operacional', nombre_gasto_operacional = '$nombre_gasto_operacional', costo_gasto_operacional = '$costo_gasto_operacional' 
		WHERE cod_gasto_operacional = '$cod_gasto_operacional'";
		$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
	}
	//-----------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_pyg.php">
<?php } ?>