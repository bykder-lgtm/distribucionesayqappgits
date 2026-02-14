<?php
if (isset($_REQUEST['id'])) {
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$id                              = addslashes($_REQUEST['id']);
$campo                           = addslashes($_REQUEST['campo']);
$valor_intro                     = addslashes($_REQUEST['valor']);
/* -------------------------------------------------------------------------------------------------------------- */
if ($campo == 'cod_estado') { 
	$fragmentador                            = explode('__', $id);
	$cod_producto_copia_inventario           = $fragmentador[1];
	$cod_estado                              = $valor_intro;

	$data_sql = ("UPDATE tbl15_producto_copia_inventario SET cod_estado = '$cod_estado' WHERE (cod_producto_copia_inventario = '$cod_producto_copia_inventario')");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo == 'seleccionar_todos') { 
	$cod_info_producto_copia_inventario     = $id;
	$cod_estado                             = $valor_intro;
	$cod_estado_check                       = $cod_estado;

	$data_sql = ("UPDATE tbl15_producto_copia_inventario SET cod_estado = '$cod_estado' WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	$data_sql = ("UPDATE tbl15_info_producto_copia_inventario SET cod_estado_check = '$cod_estado_check' WHERE (cod_info_producto_copia_inventario = '$cod_info_producto_copia_inventario')");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));



	if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
	}
/* -------------------------------------------------------------------------------------------------------------- */
else {
}
/* -------------------------------------------------------------------------------------------------------------- */
}
?>