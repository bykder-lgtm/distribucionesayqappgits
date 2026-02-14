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
$cuenta_actual                         = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$nombres_des                           = DAXCRYPTOR::descriptardax($_SESSION['nombres_cryp']);
$apellidos_des                         = DAXCRYPTOR::descriptardax($_SESSION['apellidos_cryp']);
$nombre_sexo_des                       = DAXCRYPTOR::descriptardax($_SESSION['nombre_sexo_cryp']);
$url_img_firma_sesion                  = ($_SESSION['url_img_firma_sesion']);
$url_img_foto_sesion                   = ($_SESSION['url_img_foto_sesion']);
$tipo_dispositivo                      = ($_SESSION['tipo_dispositivo']);
$cod_cliente_sesion                    = ($_SESSION['cod_cliente_sesion']);
//$cod_administrador                     = ($_SESSION['cod_administrador']);
$cod_base_caja                         = ($_SESSION['cod_base_caja']);

if (isset($_GET["cod_gasto_inmueble_inquilino_venta_temporal"])) {

	$cod_gasto_inmueble_inquilino_venta_temporal   = intval($_GET["cod_gasto_inmueble_inquilino_venta_temporal"]);
	$cuenta                                        = addslashes($_GET["cuenta"]);
	$pagina                                        = addslashes($_GET["pagina"]);
	$cod_caja_virtual                              = intval($_GET["cod_caja_virtual"]);

	$obtener_cie10diag = "SELECT * FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cod_gasto_inmueble_inquilino_venta_temporal = '$cod_gasto_inmueble_inquilino_venta_temporal')";
	$consultar_cie10diag = mysqli_query($conectar, $obtener_cie10diag) or die(mysqli_error($conectar));
	$info_cie10diag = mysqli_fetch_assoc($consultar_cie10diag);

	$cod_info_gasto_inmueble_inquilino_venta       = $info_cie10diag['cod_info_gasto_inmueble_inquilino_venta'];
	$nombre_gasto_inmueble_detalle                 = $info_cie10diag['nombre_gasto_inmueble_detalle'];
	$descripcion_gasto_inmueble_detalle            = $info_cie10diag['descripcion_gasto_inmueble_detalle'];
	$precio_venta_producto                         = $info_cie10diag['precio_venta_producto'];
	$precio_compra_producto                        = $info_cie10diag['precio_compra_producto'];
	$cod_gasto_inmueble                            = $info_cie10diag['cod_gasto_inmueble'];
	$cod_producto                                  = $info_cie10diag['cod_producto'];
	$cod_producto_barra                            = $info_cie10diag['cod_producto_barra'];
	$nombre_producto                               = $info_cie10diag['nombre_producto'];
	$url_img_orig_producto                         = $info_cie10diag['url_img_orig_producto'];
	$url_img_min_producto                          = $info_cie10diag['url_img_min_producto'];
	$fecha_gasto_inmueble_detalle                  = $info_cie10diag['fecha_gasto_inmueble_detalle'];
	$fecha                                         = $info_cie10diag['fecha'];
	$fecha_mes                                     = $info_cie10diag['fecha_mes'];
	$anyo                                          = $info_cie10diag['anyo'];
	$fecha_invert                                  = $info_cie10diag['fecha_invert'];
	$fecha_seg                                     = $info_cie10diag['fecha_seg'];
	$fecha_creacion                                = $info_cie10diag['fecha_creacion'];
	$cod_tipo_estado_incluido                      = $info_cie10diag['cod_tipo_estado_incluido'];

	$sql_info_gasto_inmueble_inquilino_venta = "SELECT * FROM tbl15_info_gasto_inmueble_inquilino_venta WHERE (cod_info_gasto_inmueble_inquilino_venta = '$cod_info_gasto_inmueble_inquilino_venta')";
	$consultar_info_gasto_inmueble_inquilino_venta = mysqli_query($conectar, $sql_info_gasto_inmueble_inquilino_venta) or die(mysqli_error($conectar));
	$info_info_gasto_inmueble_inquilino_venta = mysqli_fetch_assoc($consultar_info_gasto_inmueble_inquilino_venta);

	$cod_tercero                                   = $info_info_gasto_inmueble_inquilino_venta['cod_tercero'];
	$cod_tercero_propietario                       = $info_info_gasto_inmueble_inquilino_venta['cod_tercero_propietario'];
	$cod_cuentas_cobrar                            = $info_info_gasto_inmueble_inquilino_venta['cod_cuentas_cobrar'];
	$cod_factura                                   = $info_info_gasto_inmueble_inquilino_venta['cod_factura'];
	$cod_cuentas_cobrar_alerta                     = $info_info_gasto_inmueble_inquilino_venta['cod_cuentas_cobrar_alerta'];
	$cliente                                       = "";
	$palabra                                       = "";

	$sql_insert = "INSERT INTO tbl15_gasto_inmueble_inquilino_venta (nombre_gasto_inmueble_detalle, descripcion_gasto_inmueble_detalle, precio_venta_producto, precio_compra_producto, cod_gasto_inmueble, 
	cod_cuentas_cobrar, cod_factura, cod_tercero, cod_tercero_propietario, cod_producto, cod_producto_barra, nombre_producto, 
	url_img_orig_producto, url_img_min_producto, fecha_gasto_inmueble_detalle, fecha, fecha_mes, anyo, 
	fecha_invert, fecha_seg, fecha_creacion, cod_info_gasto_inmueble_inquilino_venta) 
	VALUES ('$nombre_gasto_inmueble_detalle', '$descripcion_gasto_inmueble_detalle', '$precio_venta_producto', '$precio_compra_producto', '$cod_gasto_inmueble', 
	'$cod_cuentas_cobrar', '$cod_factura', '$cod_tercero', '$cod_tercero_propietario', '$cod_producto', '$cod_producto_barra', '$nombre_producto', 
	'$url_img_orig_producto', '$url_img_min_producto', '$fecha_gasto_inmueble_detalle', '$fecha', '$fecha_mes', '$anyo', 
	'$fecha_invert', '$fecha_seg', '$fecha_creacion', '$cod_info_gasto_inmueble_inquilino_venta')";
	$resultado_cuentas_cobrar_abonos = mysqli_query($conectar, $sql_insert) or die(mysqli_error($conectar));

	$borrar_sql = sprintf("DELETE FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE (cod_gasto_inmueble_inquilino_venta_temporal = '$cod_gasto_inmueble_inquilino_venta_temporal')");
	$Result1 = mysqli_query($conectar, $borrar_sql) or die(mysqli_error($conectar));

	$sql_verificar_existencia = "SELECT * FROM tbl15_gasto_inmueble_inquilino_venta_temporal WHERE cod_info_gasto_inmueble_inquilino_venta = '$cod_info_gasto_inmueble_inquilino_venta'";
	$consulta_verificar_existencia = mysqli_query($conectar, $sql_verificar_existencia) or die(mysqli_error($conectar));
	$existe_verificar_existencia = mysqli_num_rows($consulta_verificar_existencia);

	if ($existe_verificar_existencia == '0') {
		$data_sql = ("UPDATE tbl15_info_gasto_inmueble_inquilino_venta SET nombre_estado_factura = 'CERRADA' WHERE cod_info_gasto_inmueble_inquilino_venta = '$cod_info_gasto_inmueble_inquilino_venta'");
		$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));
	}
	$pagina_redirect                                 = $pagina.'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&cod_info_gasto_inmueble_inquilino_venta='.$cod_info_gasto_inmueble_inquilino_venta.'&cod_cuentas_cobrar_alerta='.$cod_cuentas_cobrar_alerta.'&cod_cuentas_cobrar='.$cod_cuentas_cobrar.'&cod_factura='.$cod_factura.'&cod_tercero='.$cod_tercero.'&cliente='.$cliente.'&palabra='.$palabra;
	//-------------------------------------- -----------------------------------------------------------------//
?>
<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect ?>">
<?php } ?>