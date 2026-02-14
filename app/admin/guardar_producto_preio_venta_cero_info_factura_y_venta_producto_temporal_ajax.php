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
$cuenta_actual                              = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                     = $_SESSION['usuario'];
$cod_administrador_sesion                   = $_SESSION['cod_administrador'];
$tipo_ajax                                  = addslashes($_POST['tipo_ajax']);
$campo                                      = addslashes($_POST['campo']);
$cod_info_factura_venta                     = intval($_POST['cod_info_factura_venta']);
// ------------------------------------------------------------------------------------------------- //
$retorno_array                              = array();
$retorno_array2                             = array();
$codigoHTML_menu                            = '';
$codigoHTML_menu_total_reg                  = '';
$respuesta_ajax                             = array();
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_bascula_balanza_electronica_pesar_producto_global      = $info_empresa_data['cod_estado_bascula_balanza_electronica_pesar_producto_global'];
$cod_estado_bascula_balanza_cod_barras_pesar_producto_global       = $info_empresa_data['cod_estado_bascula_balanza_cod_barras_pesar_producto_global'];
$cod_estado_limite_venta_pos_factura_electronica_global            = $info_empresa_data['cod_estado_limite_venta_pos_factura_electronica_global'];
$limite_venta_pos_factura_electronica                              = $info_empresa_data['limite_venta_pos_factura_electronica'];
$cod_estado_pvar_calculo_automatico_pcompra_global                 = $info_empresa_data['cod_estado_pvar_calculo_automatico_pcompra_global'];
$ptj_pvar_calculo_automatico_pcompra                               = $info_empresa_data['ptj_pvar_calculo_automatico_pcompra'];
$cod_estado_mostrar_venta_por_caja_global                          = $info_empresa_data['cod_estado_mostrar_venta_por_caja_global'];
// ------------------------------------------------------------------------------------------------- //
$datos_info = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_estado_factura = '1') AND (cuenta = '$cuenta_actual')";
$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
$info = mysqli_fetch_assoc($consulta_info);
$factura_ocupada = mysqli_num_rows($consulta_info);
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_modificar_und_venta_una_sola_vez_global                = $info_empresa_data['cod_estado_modificar_und_venta_una_sola_vez_global'];
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_venta_producto') && ($tipo_ajax=='tbl15_venta_producto_temporal')) {
	$precio_venta_producto        = addslashes($_POST['valor']);
	$cod_venta_producto_temporal  = intval($_POST['id']);

	$datos_info_temporal = "SELECT und_venta, precio_costo_producto, cod_producto_barra, cod_info_factura_venta, nombre_tipo_precio_venta FROM tbl15_venta_producto_temporal WHERE (cod_venta_producto_temporal = '$cod_venta_producto_temporal')";
	$consulta_info_temporal = mysqli_query($conectar, $datos_info_temporal) or die(mysqli_error($conectar));
	$info_temporal = mysqli_fetch_assoc($consulta_info_temporal);

	$total_costo_producto         = $info_temporal['precio_costo_producto'] * $info_temporal['und_venta'];
	$cod_producto_barra           = $info_temporal['cod_producto_barra'];
	$cod_info_factura_venta       = $info_temporal['cod_info_factura_venta'];
	$nombre_tipo_precio_venta     = $info_temporal['nombre_tipo_precio_venta'];

	$sql_prod_depend = "SELECT cod_dependencia, comision_ptj FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
	$consulta_prod_depend = mysqli_query($conectar, $sql_prod_depend) or die(mysqli_error($conectar));
	$suma_prod_depend = mysqli_fetch_assoc($consulta_prod_depend);

	$cod_dependencia               = $suma_prod_depend['cod_dependencia'];
	$comision_ptj                  = $suma_prod_depend['comision_ptj'];

	$sql_depend = "SELECT nombre_dependencia FROM tbl15_dependencia WHERE (cod_dependencia = '$cod_dependencia')";
	$consulta_depend = mysqli_query($conectar, $sql_depend) or die(mysqli_error($conectar));
	$suma_depend = mysqli_fetch_assoc($consulta_depend);

	$nombre_dependencia               = $suma_depend['nombre_dependencia'];

	if ($nombre_dependencia == 'RECARGA') {
		$base_precio_compra = ($precio_venta_producto * ($comision_ptj/100));
		$precio_compra_producto = $precio_venta_producto - $base_precio_compra;
		$total_compra_producto = $precio_compra_producto * $info_temporal['und_venta'];

		$data_sql = ("UPDATE tbl15_venta_producto_temporal SET precio_compra_producto = '$precio_compra_producto', total_compra_producto = '$total_compra_producto' 
		WHERE cod_venta_producto_temporal = '$cod_venta_producto_temporal'");
		$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
	}

	if ($cod_producto_barra == '33333333' || $cod_producto_barra == '11112222') {
		if ($precio_venta_producto > 0) { $precio_venta_producto = $precio_venta_producto * -1; }

		$suma_temporal = "SELECT Sum(total_venta_producto) As total_venta 
		FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '33333333') AND (cod_producto_barra <> '22222222') AND (cod_producto_barra <> '11112222')";
		$consulta_temporal = mysqli_query($conectar, $suma_temporal) or die(mysqli_error($conectar));
		$suma = mysqli_fetch_assoc($consulta_temporal);

		$total_venta_sin_descuento    = ($suma['total_venta']);
		$total_venta_producto         = ($precio_venta_producto * $info_temporal['und_venta']);
		$total_venta_neta             = ($total_venta_sin_descuento - $precio_venta_producto);
		$total_descuento_venta        = ($total_venta_sin_descuento - $total_venta_neta);
		$descuento_ptj_dif            = ($total_descuento_venta / $total_venta_sin_descuento) * 100;
		$nombre_tipo_precio           = abs($descuento_ptj_dif);
	} else {
		$total_venta_producto         = $precio_venta_producto * $info_temporal['und_venta'];
		$nombre_tipo_precio           = 0;
	}

	if ($total_costo_producto > $total_venta_producto) { $cod_estado_permitir_venta = '1'; } else { $cod_estado_permitir_venta = '0'; }

	if (($cod_estado_pvar_calculo_automatico_pcompra_global == '1') && ($nombre_tipo_precio_venta == 'PVAR')) {
		$precio_compra_producto    = $precio_venta_producto - ($precio_venta_producto * ($ptj_pvar_calculo_automatico_pcompra/100));
		$total_compra_producto     = $precio_compra_producto * $info_temporal['und_venta'];
		$precio_costo_producto     = $precio_compra_producto;
		$total_costo_producto      = $total_compra_producto;

		$data_sql = ("UPDATE tbl15_venta_producto_temporal SET precio_compra_producto = '$precio_compra_producto', total_compra_producto = '$total_compra_producto', precio_costo_producto = '$precio_costo_producto', total_costo_producto = '$total_costo_producto' 
		WHERE cod_venta_producto_temporal = '$cod_venta_producto_temporal'");
		$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
	}
	$data_sql = ("UPDATE tbl15_venta_producto_temporal SET precio_venta_producto = '$precio_venta_producto', total_venta_producto = '$total_venta_producto',
	cod_estado_permitir_venta = '$cod_estado_permitir_venta', nombre_tipo_precio = '$nombre_tipo_precio' WHERE cod_venta_producto_temporal = '$cod_venta_producto_temporal'");
	$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

	$sql_verificar_precio_venta_en_cero_venta_temp = "SELECT * FROM tbl15_venta_producto_temporal WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (precio_venta_producto <= '0')";
	$consulta_verificar_precio_venta_en_cero_venta_temp = mysqli_query($conectar, $sql_verificar_precio_venta_en_cero_venta_temp);
	$existe_precio_venta_en_cero_venta_temp = mysqli_num_rows($consulta_verificar_precio_venta_en_cero_venta_temp);

	header('Content-Type: application/json');

	$respuesta_ajax['afectado']                                    = $afectado;
	$respuesta_ajax['emisor']                                      = $campo;
	$respuesta_ajax['id']                                          = $cod_venta_producto_temporal;
	$respuesta_ajax['existe_precio_venta_en_cero_venta_temp']      = $existe_precio_venta_en_cero_venta_temp;
	$respuesta_ajax['mensaje']                                     = 'Datos actualizados correctamente.';

	echo json_encode($respuesta_ajax);
}
?>