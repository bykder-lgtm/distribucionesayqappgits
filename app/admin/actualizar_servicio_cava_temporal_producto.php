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
$cod_base_caja                      = ($_SESSION['cod_base_caja']);

if (isset($_GET['cod_caja_virtual'])) {

	$cod_producto_barra                 = addslashes($_GET['cod_producto_barra']);
	$cod_producto_auxiliar              = intval($_GET['cod_producto_auxiliar']);
	$cuenta                             = addslashes($_GET['cuenta']);
	$cod_caja_virtual                   = addslashes($_GET['cod_caja_virtual']);
	$pagina                             = addslashes($_GET['pagina']);
	$pagina_local                       = addslashes($_GET['pagina_local']).'?cuenta='.$cuenta.'&cod_caja_virtual='.$cod_caja_virtual.'&pagina='.$pagina;
//-------------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------// 	
	$datos_data_info_factura = "SELECT * FROM tbl15_info_factura_venta WHERE (nombre_estado_factura = 'ABIERTA') AND (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_data_info_factura = mysqli_query($conectar, $datos_data_info_factura);
	$data_info_factura = mysqli_fetch_assoc($consulta_data_info_factura);
	$factura_ocupada = mysqli_num_rows($consulta_data_info_factura);

	$cod_info_factura_venta             = $data_info_factura['cod_info_factura_venta'];
//-------------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------//
	$sql_producto_auxiliar = "SELECT * FROM tbl15_producto_auxiliar WHERE (cod_producto_barra = '$cod_producto_barra')";
	$resultado_producto_auxiliar = mysqli_query($conectar, $sql_producto_auxiliar);
	$info_producto_auxiliar = mysqli_fetch_assoc($resultado_producto_auxiliar);

	$nombre_producto                    = $info_producto_auxiliar['nombre_producto'];
	$precio_compra_producto             = $info_producto_auxiliar['precio_compra_producto'];
	$precio_venta_producto              = $info_producto_auxiliar['precio_venta_producto'];
	$iva_ptj                            = $info_producto_auxiliar['iva_ptj'];
	$nombre_tipo_producto               = $info_producto_auxiliar['nombre_tipo_producto'];
	$nombre_tipo_unidad_medida          = $info_producto_auxiliar['nombre_tipo_unidad_medida'];
	$nombre_tipo_precio_venta           = $info_producto_auxiliar['nombre_tipo_precio_venta'];
	$cod_dependencia                    = $info_producto_auxiliar['cod_dependencia'];
	$und_venta                          = '1';
	$cod_tipo_cobrar 		            = '1';
	$cod_estado_cava                    = '1';
	$total_venta_producto               = $und_venta * $precio_venta_producto;
	$cod_tercero                        = '1';
	$fecha_seg_venta_producto           = time();
	$cupo_credito_ptj                   = $iva_ptj;
//-------------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------//
/*
	$sql_venta_producto_temporal = "SELECT Sum(total_venta_producto) As total_venta, Sum(total_costo_producto) As total_compra 
	FROM tbl15_venta_producto_temporal WHERE (cuenta = '$cuenta') AND (cod_caja_virtual = '$cod_caja_virtual')";
	$consulta_venta_producto_temporal = mysqli_query($conectar, $sql_venta_producto_temporal);
	$datos_venta_producto_temporal = mysqli_fetch_assoc($consulta_venta_producto_temporal);

	$total_venta                        = $datos_venta_producto_temporal['total_venta'];
*/
	$agreg = "INSERT INTO tbl15_venta_producto_temporal (cod_info_factura_venta, cod_tercero, cod_caja_virtual, cod_producto_barra, nombre_producto, 
	und_venta, precio_venta_producto, total_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_precio_venta, 
	cod_tipo_cobrar, cuenta, cod_estado_cava, fecha_seg_venta_producto) 
	VALUES ('$cod_info_factura_venta', '$cod_tercero', '$cod_caja_virtual', '$cod_producto_barra', '$nombre_producto', 
	'$und_venta', '$precio_venta_producto', '$total_venta_producto', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_precio_venta', 
	'$cod_tipo_cobrar', '$cuenta', '$cod_estado_cava', '$fecha_seg_venta_producto')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_local?>">
<?php } ?>