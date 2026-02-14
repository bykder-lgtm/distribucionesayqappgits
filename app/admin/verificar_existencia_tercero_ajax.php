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

$tipo_ajax                   = $_REQUEST['tipo_ajax'];
$campo                       = $_REQUEST['campo'];

if ($campo == 'identificacion_tercero') {
	$identificacion_tercero          = addslashes($_REQUEST['identificacion_tercero']);

	$obtener_entidad = "SELECT nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero FROM tblhomelabs_tercero WHERE identificacion_tercero = '".($identificacion_tercero)."'";
	$consultar_entidad = mysqli_query($conectar, $obtener_entidad) or die(mysqli_error($conectar));
	$existe_producto = mysqli_num_rows(@$consultar_entidad);
	$info_entidad = mysqli_fetch_assoc($consultar_entidad);

	if($existe_producto > 0) {
		$nombre1_tercero             = $info_entidad['nombre1_tercero'];
		$nombre2_tercero             = $info_entidad['nombre2_tercero'];
		$apellido1_tercero           = $info_entidad['apellido1_tercero'];
		$apellido2_tercero           = $info_entidad['apellido2_tercero'];
		$nombre_completo_tercero     = $nombre1_tercero.''. $nombre2_tercero.''. $apellido1_tercero.''. $apellido2_tercero

		echo "<img src=../imagenes/advertencia.gif>EL DOCUMENTO: ".$identificacion_tercero." EXISTE EN EL REGISTRO DE PACIENTES. (".$nombre_completo_tercero.")<img src=../imagenes/advertencia.gif>";
	} else {
		echo "<img src=../imagenes/corecto.png>";
	}
}
?>