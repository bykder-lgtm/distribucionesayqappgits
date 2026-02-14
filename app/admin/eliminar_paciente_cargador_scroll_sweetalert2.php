<?php
	header('Content-type: application/json; charset=UTF-8');
	
$respuesta_ajax = array();

if ($_POST['cod_tercero']) {
	
	require_once '../conexiones/conexione.php';
	
	$cod_tercero = intval($_POST['cod_tercero']);

	$sql_eliminar_registro = "DELETE FROM tbl15_cliente WHERE cod_tercero = '$cod_tercero'";
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']  = 'success';
		$respuesta_ajax['message'] = 'Registro eliminado exitosamente ...';
	} else {
		$respuesta_ajax['status']  = 'error';
		$respuesta_ajax['message'] = 'No se puede eliminar el tbl15_producto ...';
	}
	echo json_encode($respuesta_ajax);
}