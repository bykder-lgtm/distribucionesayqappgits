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
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                = $_SESSION['usuario'];
$cod_administrador                     = $_SESSION['cod_administrador'];
$tipo_ajax                             = addslashes($_POST['tipo_ajax']);
$campo                                 = addslashes($_POST['campo']);
$valor                                 = addslashes($_POST['valor']);
$opcion                                = addslashes($_POST['opcion']);
$cod_info_factura_compra                = intval($_POST['cod_info_factura_compra']);
$nombre_tipo_factura                   = 'POS';
$respuesta_ajax                        = array();

$datos_info = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_estado_factura = '1') AND (cuenta = '$cuenta_actual')";
$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
$info = mysqli_fetch_assoc($consulta_info);
$factura_ocupada = mysqli_num_rows($consulta_info);
// ------------------------------------------------------------------------------------------------- //
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_estado_modificar_und_venta_una_sola_vez_global                = $info_empresa_data['cod_estado_modificar_und_venta_una_sola_vez_global'];
// ------------------------------------------------------------------------------------------------- //
$sql_maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_compra WHERE (nombre_tipo_factura = '$nombre_tipo_factura') AND (nombre_estado_factura = 'CERRADA')";
$consulta_maxima_factura = mysqli_query($conectar, $sql_maxima_factura) or die(mysqli_error($conectar));
$maxima_factura = mysqli_fetch_assoc($consulta_maxima_factura);

$cod_factura                         = $maxima_factura['cod_factura']+1;
// ------------------------------------------------------------------------------------------------- //
$cod_producto                        = '0';
$cod_producto_barra                  = '999999';
$nombre_producto                     = 'PRODUCTOS VARIOS';
$und_venta                           = '1';
$precio_compra_producto              = '0';
$total_compra_producto               = '0';
$precio_costo_producto               = '0';
$total_costo_producto                = '0';
$nombre_tipo_producto                = 'PRODUCTO';
$und_producto                        = '0';
$und_producto_bodega_inv             = '0';
$nombre_tipo_unidad_medida           = 'UND';
$iva_ptj                             = '0';
$cod_tercero                         = '1';
$cod_caja_virtual                    = '1';
$nombre_tipo_precio_venta            = 'PV1';
$cod_tipo_pago                       = '1';
$cod_tipo_forma_pago                 = '1';
$nombre_tipo_moneda                  = 'COP';
$cod_dependencia                     = '1';
$cod_categoria                       = '1';
$cod_categoria_sub                   = '1';
$nombre_estado_factura               = 'CERRADA';
$nombre_maquina                      = gethostname();
$total_precio_compra                 = '0';
$cod_tipo_inventario                 = '1';
$comentario_producto                 = 'CAJA_REG';
$direccion_tercero                   = 'CAJA_REG';

$fecha_anyo                          = date("Y-m-d");
$fecha_anyo_seg                      = strtotime($fecha_anyo);
$cod_estado_factura                  = '0';
$descuento_ptj                       = '0';
$iva_ptj                             = '0';
$flete_ptj                           = '0';
$vlr_vuelto                          = '0';
$fecha_dia                           = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes                           = date("m-Y", $fecha_anyo_seg);
$anyo                                = date("Y", $fecha_anyo_seg);
$fecha_hora                          = date("H:i:s");
$fecha_hora_venta_producto           = date("H:i:s");
$fecha_ymd_venta_producto            = date("Y-m-d", $fecha_anyo_seg);
$fecha_mes_venta_producto            = date("m-Y", $fecha_anyo_seg);
$fecha_anyo_venta_producto           = date("Y", $fecha_anyo_seg);
$fecha_seg_venta_producto            = time();
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($campo=='precio_compra_producto') && ($tipo_ajax=='tbl15_compra_producto_temporal')) {

	$precio_compra_producto        = addslashes($_POST['valor']);
	$total_precio_compra           = 0;
	$total_compra_producto          = 0;


	$array_precio_compra_producto  = explode("+", $valor);
	$total_datos_data              = count($array_precio_compra_producto);
	$array_recibido                = explode("|", $valor);

	for($i = 0; $i < $total_datos_data; $i++)   {
		$precio_compra_producto        = intval($array_precio_compra_producto[$i]);
		$total_compra_producto          = $precio_compra_producto;
		$precio_compra_producto_orig   = $precio_compra_producto;

		if (($precio_compra_producto <> '') || ($precio_compra_producto <> '0')) {
			$total_precio_compra    += $precio_compra_producto;
		}
	}

	echo number_format($total_precio_compra, 0, ",", ".");
}
?>