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

if ($campo == 'cod_producto_barra') {
	$cod_producto_barra          = addslashes($_REQUEST['cod_producto_barra']);

	$sql_dato_producto = "SELECT nombre_producto FROM tbl15_producto WHERE cod_producto_barra = '".($cod_producto_barra)."'";
	$consultar_dato_producto = mysqli_query($conectar, $sql_dato_producto) or die(mysqli_error($conectar));
	$info_dato_producto = mysqli_fetch_assoc($consultar_dato_producto);
	$existe_dato_producto = mysqli_num_rows(@$consultar_dato_producto);

	$sql_dato_producto_auxiliar = "SELECT nombre_producto FROM tbl15_producto_auxiliar WHERE cod_producto_barra = '".($cod_producto_barra)."'";
	$consultar_dato_producto_auxiliar = mysqli_query($conectar, $sql_dato_producto_auxiliar) or die(mysqli_error($conectar));
	$info_dato_producto_auxiliar = mysqli_fetch_assoc($consultar_dato_producto_auxiliar);
	$existe_dato_producto_auxiliar = mysqli_num_rows(@$consultar_dato_producto_auxiliar);

	if ($existe_dato_producto > 0) { $estado_existe_producto = 1; $msj_inv = 'INVENTARIO PRINCIPAL. '; $nombre_producto = $info_dato_producto['nombre_producto']; } else { $estado_existe_producto = 0; }
	if ($existe_dato_producto_auxiliar > 0) { $estado_existe_producto_auxiliar = 1; $msj_inv = 'INVENTARIO AUXILIAR. '; $nombre_producto = $info_dato_producto_auxiliar['nombre_producto']; } else { $estado_existe_producto_auxiliar = 0; }

	if($estado_existe_producto == 1 || $estado_existe_producto_auxiliar == 1) {
		echo "<img src=../imagenes/advertencia.gif>EL CODIGO: ".$cod_producto_barra." EXISTE EN EL ".$msj_inv."(".$nombre_producto.")<img src=../imagenes/advertencia.gif>";
	} else {
		echo "<img src=../imagenes/corecto.png>";
	}
}
?>