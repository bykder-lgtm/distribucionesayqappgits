<?php
include_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

$fecha              = date("Y_m_d");
$hora               = date("H_i_s");
$salida             = "";
$sql_infos_empresas = "SELECT nombre FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$nombre_emp                               = Str_replace(" ", "_", $info_empresa_data['nombre']);

if (isset($_GET['cod_info_factura_venta'])) {

	$cod_info_factura_venta      = intval($_GET['cod_info_factura_venta']);

	$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
	$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
	$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
	$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

	$cod_factura                         = $data_info_factura['cod_factura'];
	$cod_tercero                         = $data_info_factura['cod_tercero'];

	$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
	$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

	$cliente                             = str_replace(" ", "_", $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero']);
	$cedula_cli                          = $matriz_cliente['identificacion_tercero'];

	$nombre                              = "FACTURA_EXTERNA_".$cod_info_factura_venta.'_'.$nombre_emp.'_FACTURA_'.$cod_factura.'_CLIENTE_'.$cliente.'_'.$fecha.'_Hora_'.$hora.'.csv';

	header("Content-type: application/vnd.ms-excel" ) ;
	header("Content-Disposition: attachment; filename=$nombre" );

	$sql = "SELECT tbl15_tercero.cod_producto, tbl15_tercero.nombre_tipo_tercero, tbl15_tercero.nombre_tipo_identificacion, tbl15_tercero.identificacion_tercero, 
	tbl15_tercero.digito_tercero, tbl15_tercero.nombre1_tercero, tbl15_tercero.nombre2_tercero, tbl15_tercero.apellido1_tercero, tbl15_tercero.cod_tercero, 
	tbl15_tercero.apellido2_tercero, tbl15_tercero.direccion_tercero, tbl15_tercero.telefono1_tercero, tbl15_tercero.telefono2_tercero, 
	tbl15_tercero.correo_tercero, tbl15_tercero.nombre_pais, tbl15_tercero.nombre_departamento, tbl15_tercero.nombre_ciudad, tbl15_tercero.nombre_tipo_cliente,  
	tbl15_tercero.nombre_tipo_regimen, tbl15_tercero.nombre_tipo_impuesto, 
	tbl15_venta_producto.cod_producto_barra, tbl15_venta_producto.cod_factura, tbl15_venta_producto.nombre_producto, tbl15_venta_producto.und_venta, 
	tbl15_venta_producto.precio_compra_producto, tbl15_venta_producto.total_compra_producto, tbl15_venta_producto.precio_venta_producto, 
	tbl15_venta_producto.total_venta_producto, tbl15_venta_producto.fecha_ymd_venta_producto, tbl15_venta_producto.descuento_ptj, tbl15_venta_producto.iva_ptj, 
	tbl15_venta_producto.ptj_imp_consumo, tbl15_venta_producto.ptj_ret_iva, tbl15_venta_producto.ptj_ret_ica, tbl15_venta_producto.ptj_ret_fuente, 
	tbl15_venta_producto.ptj_ipc, tbl15_venta_producto.precio_ipc_total, tbl15_venta_producto.precio_ipc, tbl15_venta_producto.cod_tipo_pago, 
	tbl15_venta_producto.cod_tipo_forma_pago, tbl15_venta_producto.nombre_tipo_moneda, tbl15_venta_producto.nombre_tipo_unidad_medida 
	FROM tbl15_tercero RIGHT JOIN tbl15_venta_producto ON tbl15_tercero.cod_tercero = tbl15_venta_producto.cod_tercero 
	WHERE (tbl15_venta_producto.cod_info_factura_venta = '$cod_info_factura_venta')";
	$consulta = mysqli_query($conectar, $sql);
	while ($datos_producto = mysqli_fetch_assoc($consulta)) {

		$fecha_ymd_venta_producto               = date("Ymd", strtotime($datos_producto['fecha_ymd_venta_producto']));
		$cod_factura                            = $datos_producto['cod_factura'];
		$precio_compra_producto                 = $datos_producto['precio_compra_producto'];
		$nombre_producto                        = $datos_producto['nombre_producto'];
		$und_venta                              = $datos_producto['und_venta'];
		$precio_venta_producto                  = $datos_producto['precio_venta_producto'];
		$precio_venta_producto                  = $datos_producto['precio_venta_producto'];
		$iva_ptj                                = ($datos_producto['iva_ptj']) / 100;
		$cod_producto                           = $datos_producto['cod_producto'];
		$cod_producto_barra                     = $datos_producto['cod_producto_barra'];
		$cod_tipo_pago                          = $datos_producto['cod_tipo_pago'];
		$cod_tipo_forma_pago                    = $datos_producto['cod_tipo_forma_pago'];
		$cod_tercero                            = $datos_producto['cod_tercero'];
		$nombre_tipo_unidad_medida              = $datos_producto['nombre_tipo_unidad_medida'];
		$vacio                                  = "";
		$vacio2                                 = "";

		$salida .=''.$cod_info_factura_venta.',';
		$salida .=''.$fecha_ymd_venta_producto.',';
		$salida .=''.$cod_factura.',';
		$salida .=''.$precio_compra_producto.',';
		$salida .=''.$nombre_producto.',';
		$salida .=''.$und_venta.',';
		$salida .=''.$precio_venta_producto.',';
		$salida .=''.$precio_venta_producto.',';
		$salida .=''.$iva_ptj.',';
		$salida .=''.$cod_producto.',';
		$salida .=''.$cod_producto_barra.',';
		$salida .=''.$cod_tipo_pago.',';
		$salida .=''.$cod_tipo_forma_pago.',';
		$salida .=''.$cod_tercero.',';
		$salida .=''.$nombre_tipo_unidad_medida.',';
		$salida .=''.$vacio.',';
		$salida .=''.$vacio2.'';
		$salida .="\n";
	}
echo $salida;
}
?>

