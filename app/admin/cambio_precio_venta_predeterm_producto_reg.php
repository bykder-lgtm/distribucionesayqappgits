<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                        = $_SESSION['usuario'];
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_GET['cod_info_cambio_precio_venta_predeterm_producto'])) {

	$cod_info_cambio_precio_venta_predeterm_producto         = intval($_GET['cod_info_cambio_precio_venta_predeterm_producto']);
	$pagina                                                  = addslashes($_GET['pagina']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_total_venta_producto_temporal = "SELECT * FROM tbl15_cambio_precio_venta_predeterm_producto WHERE (cod_info_cambio_precio_venta_predeterm_producto = '$cod_info_cambio_precio_venta_predeterm_producto')";
	$consulta_total_venta_producto_temporal = mysqli_query($conectar, $sql_total_venta_producto_temporal) or die(mysqli_error($conectar));
	while ($datos_total_venta_producto_temporal = mysqli_fetch_assoc($consulta_total_venta_producto_temporal)) {

		$cod_producto_barra                = $datos_total_venta_producto_temporal['cod_producto_barra'];
		$precio_venta_producto             = $datos_total_venta_producto_temporal['precio_venta_producto'];
		$nombre_tipo_precio_venta          = $datos_total_venta_producto_temporal['nombre_tipo_precio_venta'];

		if ($nombre_tipo_precio_venta == 'PV1') { $tipo_precio_venta = 'precio_venta_producto'; } elseif ($nombre_tipo_precio_venta == 'PV2') { $tipo_precio_venta = 'precio_venta_producto2'; } elseif ($nombre_tipo_precio_venta == 'PV3') { $tipo_precio_venta = 'precio_venta_producto3'; } elseif ($nombre_tipo_precio_venta == 'PV4') { $tipo_precio_venta = 'precio_venta_producto4'; } elseif ($nombre_tipo_precio_venta == 'PV5') { $tipo_precio_venta = 'precio_venta_producto5'; } else { $tipo_precio_venta = 'precio_venta_producto'; }
		
		$actualiza_producto = sprintf("UPDATE tbl15_producto SET $tipo_precio_venta = '$precio_venta_producto', nombre_tipo_precio_venta = '$nombre_tipo_precio_venta' WHERE cod_producto_barra = '$cod_producto_barra'");
		$resultado_actualiza_producto = mysqli_query($conectar, $actualiza_producto) or die(mysqli_error($conectar));
	}
//----------------------------------------------------------------------- ---------------------------------------------------------//
//----------------------------------------------------------------------- ---------------------------------------------------------//
	$url_redir = "../admin/cambio_precio_venta_predeterm_producto_opcion_imprimir.php?cod_info_cambio_precio_venta_predeterm_producto=".$cod_info_cambio_precio_venta_predeterm_producto."&cod_tipo_pago=".$cod_tipo_pago."&pagina=".$pagina;
	header("Location: $url_redir");
}
?>