<?php
header('Content-type: application/json; charset=UTF-8');
include_once ('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

$respuesta_ajax = array();
//--------------------------------------------------------------------------------------------------------//
//---------------------------------------------------ELIMINAR CLIENTE-------------------------------------//
//--------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_cliente'])) {

	$cod_cliente = intval($_POST['cod_cliente']);

	$sql_cliente_elim = "SELECT cedula, nombres, apellido1, apellido2 FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
	$consultar_cliente_elim = mysqli_query($conectar, $sql_cliente_elim) or die(mysqli_error($conectar));
	$datos_cliente_elim = mysqli_fetch_array($consultar_cliente_elim);

	$cedula                         = $datos_cliente_elim['cedula'];
	$nombres                        = $datos_cliente_elim['nombres'];
	$apellido1                      = $datos_cliente_elim['apellido1'];
	$apellido2                      = $datos_cliente_elim['apellido2'];
	$nombres_apellidos              = $nombres.' '.$apellido1.' '.$apellido2;

    $sql_copiar = "INSERT INTO tbl15_cliente_copia SELECT * FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
    $exec_copiar = mysqli_query($conectar, $sql_copiar) or die(mysqli_error($conectar));

	$sql_eliminar_registro = "DELETE FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']          = 'success';
		$respuesta_ajax['message']         = 'Registro eliminado exitosamente ...<br>'.$nombres_apellidos;
	} else {
		$respuesta_ajax['status']          = 'error';
		$respuesta_ajax['message']         = 'No se puede eliminar el registro ...<br>'.$nombres_apellidos;
	}
	echo json_encode($respuesta_ajax);
}
//--------------------------------------------------------------------------------------------------------//
//------------------------------------------ELIMINAR HISTORIA CLINICA-------------------------------------//
//--------------------------------------------------------------------------------------------------------//
if (isset($_POST['cod_historia_clinica'])) {

	$cod_historia_clinica = intval($_POST['cod_historia_clinica']);

	$sql_hist_clinic_elim = "SELECT cod_cliente FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
	$consultar_hist_clinic_elim = mysqli_query($conectar, $sql_hist_clinic_elim) or die(mysqli_error($conectar));
	$datos_hist_clinic_elim = mysqli_fetch_array($consultar_hist_clinic_elim);

	$cod_cliente                    = $datos_hist_clinic_elim['cod_cliente'];

	$sql_cliente_elim = "SELECT cedula, nombres, apellido1, apellido2 FROM tbl15_cliente WHERE cod_cliente = '$cod_cliente'";
	$consultar_cliente_elim = mysqli_query($conectar, $sql_cliente_elim) or die(mysqli_error($conectar));
	$datos_cliente_elim = mysqli_fetch_array($consultar_cliente_elim);

	$cedula                         = $datos_cliente_elim['cedula'];
	$nombres                        = $datos_cliente_elim['nombres'];
	$apellido1                      = $datos_cliente_elim['apellido1'];
	$apellido2                      = $datos_cliente_elim['apellido2'];
	$nombres_apellidos              = $nombres.' '.$apellido1.' '.$apellido2;

	$sql_data = "INSERT INTO tbl15_historia_clinica_copia SELECT * FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_eliminar_registro = sprintf("DELETE FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'");
	$consultar_eliminar_registro = mysqli_query($conectar, $sql_eliminar_registro) or die(mysqli_error($conectar));

	if ($consultar_eliminar_registro) {
		$respuesta_ajax['status']          = 'success';
		$respuesta_ajax['message']         = 'Registro eliminado exitosamente ...<br>'.$nombres_apellidos.'<br>('.$cod_historia_clinica.')';
	} else {
		$respuesta_ajax['status']          = 'error';
		$respuesta_ajax['message']         = 'No se puede eliminar el registro ...<br>'.$nombres_apellidos.'<br>('.$cod_historia_clinica.')';
	}
	echo json_encode($respuesta_ajax);
}
//--------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------//
