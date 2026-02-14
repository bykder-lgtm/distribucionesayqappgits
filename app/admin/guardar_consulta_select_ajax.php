<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
// ------------------------------------------------------------------------------------------------- //
$tipo_ajax                 = addslashes($_POST['tipo_ajax']);
$campo                     = addslashes($_POST['campo']);
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($_POST['nombre1_tercero'] <> '') && ($tipo_ajax=='registrar')) {
	$cod_info_factura_venta      = intval($_POST['cod_info_factura_venta']);
	$nombre_tipo_tercero         = addslashes($_POST['nombre_tipo_tercero']);
	$nombre_tipo_identificacion  = addslashes($_POST['nombre_tipo_identificacion']);
	$identificacion_tercero      = addslashes($_POST['identificacion_tercero']);
	if (isset($_POST['identificacion_tercero'])) { $identificacion_tercero = addslashes($_POST['identificacion_tercero']); } else { $identificacion_tercero = ""; }
	$digito_tercero              = addslashes($_POST['digito_tercero']);
	$nombre1_tercero             = addslashes(trim($_POST['nombre1_tercero']));
	$nombre2_tercero             = addslashes(trim($_POST['nombre2_tercero']));
	$apellido1_tercero           = addslashes(trim($_POST['apellido1_tercero']));
	$apellido2_tercero           = addslashes(trim($_POST['apellido2_tercero']));
	$nombre_tipo_cliente         = addslashes($_POST['nombre_tipo_cliente']);
	$nombre_tipo_regimen         = addslashes($_POST['nombre_tipo_regimen']);
	$nombre_tipo_impuesto        = addslashes($_POST['nombre_tipo_impuesto']);
	$cod_pais                    = intval($_POST['cod_pais']);
	$cod_departamento            = intval($_POST['cod_departamento']);
	$cod_municipio               = intval($_POST['cod_municipio']);
	$direccion_tercero           = addslashes(trim($_POST['direccion_tercero']));
	$telefono1_tercero           = addslashes($_POST['telefono1_tercero']);
	$correo_tercero              = addslashes($_POST['correo_tercero']);
	$fax_tercero                 = addslashes($_POST['fax_tercero']);
	$fecha_nac_tercero           = addslashes($_POST['fecha_nac_tercero']);
	$nombre_sino                 = addslashes($_POST['nombre_sino']);
	$valor                       = addslashes($_POST['valor']);

	$obtener_pais = "SELECT nombre_pais FROM tbl15_pais WHERE cod_pais = '".($cod_pais)."'";
	$consultar_pais = mysqli_query($conectar, $obtener_pais);
	$info_pais = mysqli_fetch_assoc($consultar_pais);

	$nombre_pais           = $info_pais['nombre_pais'];

	$obtener_departamento = "SELECT nombre_departamento FROM tbl15_departamento WHERE cod_departamento = '".($cod_departamento)."'";
	$consultar_departamento = mysqli_query($conectar, $obtener_departamento);
	$info_departamento = mysqli_fetch_assoc($consultar_departamento);

	$nombre_departamento           = $info_departamento['nombre_departamento'];

	$obtener_municipio = "SELECT nombre_municipio FROM tbl15_municipio WHERE cod_municipio = '".($cod_municipio)."'";
	$consultar_municipio = mysqli_query($conectar, $obtener_municipio);
	$info_municipio = mysqli_fetch_assoc($consultar_municipio);

	$nombre_ciudad           = $info_municipio['nombre_municipio'];

	if ($nombre_sino == 'SI') {
		$obtener_existencia = "SELECT identificacion_tercero FROM tbl15_tercero WHERE identificacion_tercero = '".($identificacion_tercero)."'";
		$consultar_existencia = mysqli_query($conectar, $obtener_existencia);
		$info_existencia = mysqli_num_rows($consultar_existencia);


		if ($info_existencia=='0') {

			$sql_autoincremento_tercero = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_tercero'";
			$exec_autoincremento_tercero = mysqli_query($conectar, $sql_autoincremento_tercero);
			$datos_autoincremento_tercero = mysqli_fetch_assoc($exec_autoincremento_tercero);
			$cod_tercero = $datos_autoincremento_tercero['AUTO_INCREMENT'];

			$data_sql = "INSERT INTO tbl15_tercero (nombre_tipo_tercero, nombre_tipo_identificacion, identificacion_tercero, digito_tercero, 
			nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, nombre_tipo_cliente, nombre_tipo_regimen, 
			nombre_tipo_impuesto, cod_pais, cod_departamento, cod_municipio, direccion_tercero, telefono1_tercero, correo_tercero, 
			fax_tercero, nombre_sino, fecha_nac_tercero, nombre_pais, nombre_departamento, nombre_ciudad) 
			VALUE ('$nombre_tipo_tercero', '$nombre_tipo_identificacion', '$identificacion_tercero', '$digito_tercero', 
			UPPER('$nombre1_tercero'), UPPER('$nombre2_tercero'), UPPER('$apellido1_tercero'), UPPER('$apellido2_tercero'), '$nombre_tipo_cliente', '$nombre_tipo_regimen', 
			'$nombre_tipo_impuesto', '$cod_pais', '$cod_departamento',  UPPER('$cod_municipio'),  UPPER('$direccion_tercero'), '$telefono1_tercero', '$correo_tercero', 
			'$fax_tercero', '$nombre_sino', '$fecha_nac_tercero', '$nombre_pais', '$nombre_departamento', '$nombre_ciudad')";
			$exec_data = mysqli_query($conectar, $data_sql);

			$sql_data = "UPDATE tbl15_info_factura_venta SET cod_tercero = '$cod_tercero' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
			$exec_data = mysqli_query($conectar, $sql_data);

			if (mysqli_affected_rows($conectar) > 0) { echo "GUARDADO SI"; } else { echo "GUARDADO NO"; }
		} 
		else { echo "<font color='yellow'>EL DOCUMENTO ".$identificacion_tercero.", YA ESTA REGISTRADO</font>"; 
		}
	} else {
		$sql_autoincremento_tercero = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_tercero'";
		$exec_autoincremento_tercero = mysqli_query($conectar, $sql_autoincremento_tercero);
		$datos_autoincremento_tercero = mysqli_fetch_assoc($exec_autoincremento_tercero);
		$cod_tercero = $datos_autoincremento_tercero['AUTO_INCREMENT'];

		$sql_max_cedula_tercero = "SELECT MAX(identificacion_tercero) AS identificacion_tercero FROM tbl15_tercero";
		$consulta_max_cedula_tercero = mysqli_query($conectar, $sql_max_cedula_tercero);
		$info_max_cedula_tercero = mysqli_fetch_assoc($consulta_max_cedula_tercero);

		$identificacion_tercero = $info_max_cedula_tercero['identificacion_tercero']+1;

		$data_sql = "INSERT INTO tbl15_tercero (nombre_tipo_tercero, nombre_tipo_identificacion, identificacion_tercero, digito_tercero, 
		nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto, 
		cod_pais, cod_departamento, cod_municipio, direccion_tercero, telefono1_tercero, correo_tercero, 
		fax_tercero, nombre_sino, fecha_nac_tercero, nombre_pais, nombre_departamento, nombre_ciudad) 
		VALUE ('$nombre_tipo_tercero', '$nombre_tipo_identificacion', '$identificacion_tercero', '$digito_tercero', 
		UPPER('$nombre1_tercero'), UPPER('$nombre2_tercero'), UPPER('$apellido1_tercero'), UPPER('$apellido2_tercero'), '$nombre_tipo_cliente', '$nombre_tipo_regimen', 
		'$nombre_tipo_impuesto', '$cod_pais', '$cod_departamento',  UPPER('$cod_municipio'),  UPPER('$direccion_tercero'), '$telefono1_tercero', '$correo_tercero', 
		'$fax_tercero', '$nombre_sino', '$fecha_nac_tercero', '$nombre_pais', '$nombre_departamento', '$nombre_ciudad')";
		$exec_data = mysqli_query($conectar, $data_sql);

		$sql_data = "UPDATE tbl15_info_factura_venta SET cod_tercero = '$cod_tercero' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
		$exec_data = mysqli_query($conectar, $sql_data);

		if (mysqli_affected_rows($conectar) > 0) { echo "GUARDADO SI"; } else { echo "GUARDADO NO"; }
	}

}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
?>