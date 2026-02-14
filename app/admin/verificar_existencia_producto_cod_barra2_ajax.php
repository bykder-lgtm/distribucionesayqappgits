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

if ($campo == 'cod_producto_barra2') {
	$cod_producto_barra2          = addslashes($_REQUEST['cod_producto_barra2']);

	$obtener_entidad = "SELECT cod_producto_barra, nombre_producto FROM tbl15_producto WHERE cod_producto_barra2 = '".($cod_producto_barra2)."'";
	$consultar_entidad = mysqli_query($conectar, $obtener_entidad) or die(mysqli_error($conectar));
	$existe_producto = mysqli_num_rows(@$consultar_entidad);
	$info_entidad = mysqli_fetch_assoc($consultar_entidad);

	if($existe_producto > 0) {
		$cod_producto_barra          = $info_entidad['cod_producto_barra'];
		$nombre_producto             = $info_entidad['nombre_producto'];

		echo "<img src=../imagenes/advertencia.gif>EL CODIGO DE BARRAS 2: ".$cod_producto_barra2." EXISTE EN EL INVENTARIO. (".$nombre_producto." | CODIGO BARRA 1 = ".$cod_producto_barra.")<img src=../imagenes/advertencia.gif>";
	} else {
		echo "<img src=../imagenes/corecto.png>";
	}
}
?>