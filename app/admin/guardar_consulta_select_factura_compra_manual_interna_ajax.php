<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
// ------------------------------------------------------------------------------------------------- //
$tipo_ajax                 = addslashes($_POST['tipo_ajax']);
$campo                     = addslashes($_POST['campo']);
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($_POST['identificacion_tercero'] <> '') && ($tipo_ajax=='registrar')) {
$cod_info_factura_compra      = intval($_POST['cod_info_factura_compra']);
$nombre_tipo_tercero                     = addslashes($_POST['nombre_tipo_tercero']);
$nombre_tipo_identificacion              = addslashes($_POST['nombre_tipo_identificacion']);
$identificacion_tercero                  = addslashes($_POST['identificacion_tercero']);
$digito_tercero                          = addslashes($_POST['digito_tercero']);
$nombre1_tercero                         = addslashes(strtoupper($_POST['nombre1_tercero']));
$nombre2_tercero                         = addslashes(strtoupper($_POST['nombre2_tercero']));
$apellido1_tercero                       = addslashes(strtoupper($_POST['apellido1_tercero']));
$apellido2_tercero                       = addslashes(strtoupper($_POST['apellido2_tercero']));
$nombre_tipo_cliente                     = addslashes($_POST['nombre_tipo_cliente']);
$nombre_tipo_regimen                     = addslashes($_POST['nombre_tipo_regimen']);
$nombre_tipo_impuesto                    = addslashes($_POST['nombre_tipo_impuesto']);
$nombre_pais                             = addslashes($_POST['nombre_pais']);
$nombre_departamento                     = addslashes($_POST['nombre_departamento']);
$nombre_ciudad                           = addslashes(strtoupper($_POST['nombre_ciudad']));
$direccion_tercero                       = addslashes(strtoupper($_POST['direccion_tercero']));
$telefono1_tercero                       = addslashes($_POST['telefono1_tercero']);
$correo_tercero                          = addslashes($_POST['correo_tercero']);
$fax_tercero                             = addslashes($_POST['fax_tercero']);
$valor                                   = addslashes($_POST['valor']);

$obtener_existencia = "SELECT identificacion_tercero FROM tbl15_tercero WHERE identificacion_tercero = '".($identificacion_tercero)."'";
$consultar_existencia = mysqli_query($conectar, $obtener_existencia);
$info_existencia = mysqli_num_rows($consultar_existencia);

if ($info_existencia==0) {

$sql_autoincremento_tercero = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_tercero'";
$exec_autoincremento_tercero = mysqli_query($conectar, $sql_autoincremento_tercero);
$datos_autoincremento_tercero = mysqli_fetch_assoc($exec_autoincremento_tercero);
$cod_tercero = $datos_autoincremento_tercero['AUTO_INCREMENT'];

$data_sql = "INSERT INTO tbl15_tercero (nombre_tipo_tercero, nombre_tipo_identificacion, identificacion_tercero, digito_tercero, nombre1_tercero, nombre2_tercero, 
apellido1_tercero, apellido2_tercero, nombre_tipo_cliente, nombre_tipo_regimen, nombre_tipo_impuesto, nombre_pais, 
nombre_departamento, nombre_ciudad, direccion_tercero, telefono1_tercero, correo_tercero, fax_tercero) 
VALUE ('$nombre_tipo_tercero', '$nombre_tipo_identificacion', '$identificacion_tercero', '$digito_tercero', '$nombre1_tercero', '$nombre2_tercero', 
'$apellido1_tercero', '$apellido2_tercero', '$nombre_tipo_cliente', '$nombre_tipo_regimen', '$nombre_tipo_impuesto', '$nombre_pais', 
'$nombre_departamento', '$nombre_ciudad', '$direccion_tercero', '$telefono1_tercero', '$correo_tercero', '$fax_tercero')";
$exec_data = mysqli_query($conectar, $data_sql);

if ( mysqli_affected_rows($conectar) > 0) { echo "GUARDADO"; } else { echo "NO GUARDADO"; }
} else { echo "<font color='yellow'>EL DOCUMENTO ".$identificacion_tercero.", YA ESTA REGISTRADO</font>"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
?>