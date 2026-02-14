<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cuenta_actual                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                        = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                      = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                    = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion               = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                   = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                 = ($_SESSION['cod_cliente_sesion']);
$cod_administrador                  = ($_SESSION['cod_administrador']);
$cuenta                             = ($cuenta_actual);

$sql_infos_empresas = "SELECT cod_movimiento_contable_cuenta_personal_defect_global, cod_movimiento_caja_defect_global, cod_puc_defect_global FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$cod_movimiento_contable_cuenta_personal_defect_global         = $info_empresa_data['cod_movimiento_contable_cuenta_personal_defect_global'];
$cod_movimiento_caja_defect_global                             = $info_empresa_data['cod_movimiento_caja_defect_global'];
$cod_puc_defect_global                                         = $info_empresa_data['cod_puc_defect_global'];

$cod_estado_factura                                            = '1';
$descuento_ptj                                                 = '0';
$flete_ptj                                                     = '0';
$vlr_cancelado                                                 = '';
$vlr_vuelto                                                    = '';
$fecha_dia                                                     = strtotime(date("Y/m/d"));
$fecha_mes                                                     = date("Y-m");
$fecha_anyo                                                    = date("Y-m-d");
$anyo                                                          = date("Y");
$fecha_hora                                                    = date("H:i:s");
$fecha_remision                                                = date("Y-m-d");
$nombre_ccosto                                                 = '';
$garantia_meses                                                = '';
$observacion                                                   = '';
$cod_tipo_pago                                                 = '1';
$cod_empresa                                                   = '0';
$fecha_ymdhis                                                  = date("Y-m-d H:is");
$cod_tipo_cobrar                                               = '1';
$cod_tercero                                                   = '1';
$nombre_estado_factura                                         = 'ABIERTA';
$cod_tipo_forma_pago                                           = "1";
$nombre_tipo_factura                                           = "POS";
$nombre_tipo_moneda                                            = "COP";
$cod_tipo_inventario                                           = "1";
$cod_tipo_metodo_envio                                         = '1';
$modo_venta_por_defecto                                        = 'manual';

$cod_movimiento_contable_cuenta_personal                      = $cod_movimiento_contable_cuenta_personal_defect_global;
$cod_movimiento_caja                                          = $cod_movimiento_caja_defect_global;
$cod_puc                                                      = $cod_puc_defect_global;

if (isset($_REQUEST["cod_caja_virtual"])) {
	$cod_base_caja                      = intval($_REQUEST['cod_base_caja']);
	$cod_caja_virtual                   = intval($_REQUEST['cod_caja_virtual']);
	if (isset($_REQUEST['nombre_tipo_producto'])) { $nombre_tipo_producto = addslashes($_REQUEST['cod_caja_virtual']); } else { $nombre_tipo_producto = 'PRODUCTO'; }
	if (isset($_REQUEST['cod_tercero'])) { $cod_tercero = intval($_REQUEST['cod_tercero']); $cod_empresa = intval($_REQUEST['cod_tercero']); } else { $cod_tercero = '1'; $cod_empresa = '0'; }

	$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
	$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
	$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

	$cod_info_factura_venta             = $datos_autoincremento_info_factura['AUTO_INCREMENT'];

	$datos_info = "SELECT * FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura') AND (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_info = mysqli_query($conectar, $datos_info) or die(mysqli_error($conectar));
	$factura_abierta = mysqli_num_rows($consulta_info);


	if ($factura_abierta == '0') {
		$sql_max_prioridad = "SELECT MAX(cod_prioridad) AS cod_prioridad FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = '$nombre_estado_factura')";
		$consulta_max_prioridad = mysqli_query($conectar, $sql_max_prioridad) or die(mysqli_error($conectar));
		$datos_max_prioridad = mysqli_fetch_assoc($consulta_max_prioridad);

		$cod_prioridad                      = $datos_max_prioridad['cod_prioridad']+1;
		//---------------------------------------------------------------------------------------------------------------------------------------------//
		$sql_data = "INSERT INTO tbl15_info_factura_venta (cod_info_factura_venta, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
		fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_administrador, cod_tipo_forma_pago, 
		nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_tipo_inventario, cod_prioridad, cod_base_caja, cod_tipo_metodo_envio, nombre_tipo_producto, cod_empresa, 
		cod_movimiento_contable_cuenta_personal, cod_movimiento_caja, cod_puc) 
		VALUES ('$cod_info_factura_venta', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
		'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_administrador', '$cod_tipo_forma_pago', 
		'$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_tipo_inventario', '$cod_prioridad', '$cod_base_caja', '$cod_tipo_metodo_envio', '$nombre_tipo_producto', '$cod_empresa', 
		'$cod_movimiento_contable_cuenta_personal', '$cod_movimiento_caja', '$cod_puc')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	}
	$_SESSION['cod_base_caja']        = $cod_base_caja;
	$_SESSION['cod_caja_virtual']     = $cod_caja_virtual;
	$pagina                           = addslashes($_REQUEST['pagina']).'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_factura_venta='.$cod_info_factura_venta.'&modo_venta_por_defecto='.$modo_venta_por_defecto;
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina ?>">
<?php } ?>