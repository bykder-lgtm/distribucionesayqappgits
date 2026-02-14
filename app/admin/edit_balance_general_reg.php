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

if (isset($_POST['cod_balance_general'])) {

	$cod_balance_general              = intval($_POST['cod_balance_general']);
	$total_activo_corriente           = addslashes($_POST['total_activo_corriente']);
	$total_propied_planta_equipo      = addslashes($_POST['total_propied_planta_equipo']);
	$total_activo                     = addslashes($_POST['total_activo']);
	$total_pasivo                     = addslashes($_POST['total_pasivo']);
	$total_pasivo_corriente           = addslashes($_POST['total_pasivo_corriente']);
	$total_patrimonio                 = addslashes($_POST['total_patrimonio']);
	$total_pasivo_patrimonio          = addslashes($_POST['total_pasivo_patrimonio']);
	$ip                               = $_SERVER["REMOTE_ADDR"];
	$cuenta                           = $cuenta_actual;

	$agregar_reg_pyg = "UPDATE tbl15_balance_general SET total_activo_corriente = '$total_activo_corriente', total_propied_planta_equipo = '$total_propied_planta_equipo',  
	total_propied_planta_equipo = '$total_propied_planta_equipo', total_activo = '$total_activo', total_pasivo = '$total_pasivo', 
	total_pasivo_corriente = '$total_pasivo_corriente', total_patrimonio = '$total_patrimonio', total_pasivo_patrimonio = '$total_pasivo_patrimonio' 
	WHERE cod_balance_general = '$cod_balance_general'";
	$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
	//-----------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------//
	//for ($i=0; $i < $total_datos_ingre_operacional; $i++) {
	foreach ($_POST["cod_activo_corriente"] as $clave => $cod_activo_corriente) { 

		$puc_activo_corriente        = $_POST["puc_activo_corriente"][$clave];
		$nombre_activo_corriente     = $_POST["nombre_activo_corriente"][$clave];
		$costo_activo_corriente      = $_POST["costo_activo_corriente"][$clave];

		$agregar_reg_pyg = "UPDATE tbl15_activo_corriente SET puc_activo_corriente = '$puc_activo_corriente', 
		nombre_activo_corriente = '$nombre_activo_corriente', costo_activo_corriente = '$costo_activo_corriente' 
		WHERE cod_activo_corriente = '$cod_activo_corriente'";
		$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
	}
	//-----------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------//
	foreach ($_POST["cod_propied_planta_equipo"] as $clave => $cod_propied_planta_equipo) { 

		$puc_propied_planta_equipo        = $_POST["puc_propied_planta_equipo"][$clave];
		$nombre_propied_planta_equipo     = $_POST["nombre_propied_planta_equipo"][$clave];
		$costo_propied_planta_equipo      = $_POST["costo_propied_planta_equipo"][$clave];

		$agregar_reg_pyg = "UPDATE tbl15_propied_planta_equipo SET puc_propied_planta_equipo = '$puc_propied_planta_equipo', 
		nombre_propied_planta_equipo = '$nombre_propied_planta_equipo', costo_propied_planta_equipo = '$costo_propied_planta_equipo' 
		WHERE cod_propied_planta_equipo = '$cod_propied_planta_equipo'";
		$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
	}
	//-----------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------//
	foreach ($_POST["cod_pasivo_corriente"] as $clave => $cod_pasivo_corriente) { 

		$puc_pasivo_corriente        = $_POST["puc_pasivo_corriente"][$clave];
		$nombre_pasivo_corriente     = $_POST["nombre_pasivo_corriente"][$clave];
		$costo_pasivo_corriente      = $_POST["costo_pasivo_corriente"][$clave];

		$agregar_reg_pyg = "UPDATE tbl15_pasivo_corriente SET puc_pasivo_corriente = '$puc_pasivo_corriente', 
		nombre_pasivo_corriente = '$nombre_pasivo_corriente', costo_pasivo_corriente = '$costo_pasivo_corriente' 
		WHERE cod_pasivo_corriente = '$cod_pasivo_corriente'";
		$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
	}
	//-----------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------//
	foreach ($_POST["cod_patrimonio"] as $clave => $cod_patrimonio) { 

		$puc_patrimonio        = $_POST["puc_patrimonio"][$clave];
		$nombre_patrimonio     = $_POST["nombre_patrimonio"][$clave];
		$costo_patrimonio      = $_POST["costo_patrimonio"][$clave];

		$agregar_reg_pyg = "UPDATE tbl15_patrimonio SET puc_patrimonio = '$puc_patrimonio', nombre_patrimonio = '$nombre_patrimonio', 
		costo_patrimonio = '$costo_patrimonio' WHERE cod_patrimonio = '$cod_patrimonio'";
		$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));
	}
	//-----------------------------------------------------------------------------------------------------------------//
	//-----------------------------------------------------------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; ../admin/lista_balance_general.php">
<?php } ?>