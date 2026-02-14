<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cuenta_actual                               = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                      = $_SESSION['usuario'];
$cod_administrador_sesion                    = $_SESSION['cod_administrador'];
$tipo_ajax                                   = addslashes($_POST['tipo_ajax']);
$campo                                       = addslashes($_POST['campo']);
$cod_cuentas_cobrar                          = addslashes($_POST['id']);

if (isset($_POST['filtro'])) { $filtro_incluido = ""; } else { $filtro_incluido = "AND (cod_tipo_estado_incluido = '0')"; }
// ------------------------------------------------------------------------------------------------- //
$retorno_array                      = array();
$retorno_array2                     = array();
$codigoHTML_menu                    = '';
$codigoHTML_menu_total_reg          = '';
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_bascula_balanza_electronica_pesar_producto_global      = $info_empresa_data['cod_estado_bascula_balanza_electronica_pesar_producto_global'];
$cod_estado_bascula_balanza_cod_barras_pesar_producto_global       = $info_empresa_data['cod_estado_bascula_balanza_cod_barras_pesar_producto_global'];
$cod_estado_limite_venta_pos_factura_electronica_global            = $info_empresa_data['cod_estado_limite_venta_pos_factura_electronica_global'];
$limite_venta_pos_factura_electronica                              = $info_empresa_data['limite_venta_pos_factura_electronica'];
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_modificar_und_venta_una_sola_vez_global                = $info_empresa_data['cod_estado_modificar_und_venta_una_sola_vez_global'];
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='deduccion_saldo_favor') && ($tipo_ajax=='tbl15_cuentas_cobrar')) {
	header('Content-Type: application/json');
	$respuesta_ajax                             = array();
	
	$deduccion_saldo_favor                      = addslashes($_POST['valor']);
	$cod_cuentas_cobrar                         = intval($_POST['id']);

	$data_sql = ("UPDATE tbl15_cuentas_cobrar SET deduccion_saldo_favor = '$deduccion_saldo_favor' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	$respuesta_ajax['afectado']                        = $afectado;
	$respuesta_ajax['emisor']                          = 'deduccion_saldo_favor';
	$respuesta_ajax['mensaje']                         = 'Datos cargados correctamente.';

	echo json_encode($respuesta_ajax);
}
// ------------------------------------------------------------------------------------------------- //
?>