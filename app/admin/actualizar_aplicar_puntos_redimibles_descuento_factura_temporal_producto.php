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
	$cod_info_factura_venta             = intval($_GET['cod_info_factura_venta']);
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

	$cod_info_factura_venta                              = $data_info_factura['cod_info_factura_venta'];
	$cod_tercero                                         = $data_info_factura['cod_tercero'];
	$cod_puntos_redimibles_campanya                      = $data_info_factura['cod_puntos_redimibles_campanya'];
//-------------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------//
	$obtener_puntos_redimibles_campanya = "SELECT * FROM tbl15_puntos_redimibles_campanya WHERE (cod_puntos_redimibles_campanya = '$cod_puntos_redimibles_campanya')";
	$resultado_puntos_redimibles_campanya = mysqli_query($conectar, $obtener_puntos_redimibles_campanya) or die(mysqli_error($conectar));
	$info_puntos_redimibles_campanya = mysqli_fetch_assoc($resultado_puntos_redimibles_campanya);

    $valor_puntos_redimibles_campanya                    = intval($info_puntos_redimibles_campanya['valor_puntos_redimibles_campanya']);
    $cantidad_puntos_x_valor_redimibles_campanya         = intval($info_puntos_redimibles_campanya['cantidad_puntos_x_valor_redimibles_campanya']);
    $equivalencia_en_pesos_de_un_punto                   = intval($info_puntos_redimibles_campanya['equivalencia_en_pesos_de_un_punto']);
    if ($valor_puntos_redimibles_campanya == '0') { $valor_puntos_redimibles_campanya = '1'; } else { $valor_puntos_redimibles_campanya = $valor_puntos_redimibles_campanya; }
//-------------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------//
	$obtener_info_cliente = "SELECT total_puntos_redimibles_campanya_tercero FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
	$resultado_info_cliente = mysqli_query($conectar, $obtener_info_cliente) or die(mysqli_error($conectar));
	$info_cliente = mysqli_fetch_assoc($resultado_info_cliente);

	$sql_venta_temporal = "SELECT SUM(total_venta_producto) AS total_precio_venta FROM tbl15_venta_producto_temporal 
	WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (cod_producto_barra <> '33333333') AND (cod_producto_barra <> '22222222') AND (cod_producto_barra <> '11112222')";
	$consulta_venta_temporal = mysqli_query($conectar, $sql_venta_temporal) or die(mysqli_error($conectar));
	$info_venta_temporal = mysqli_fetch_assoc($consulta_venta_temporal);

	$total_precio_venta                                           = $info_venta_temporal['total_precio_venta'];
	$total_puntos_redimibles_campanya_factura_actual              = ($total_precio_venta / $valor_puntos_redimibles_campanya) * $cantidad_puntos_x_valor_redimibles_campanya;
    $total_puntos_redimibles_campanya_tercero_acumulado           = $info_cliente['total_puntos_redimibles_campanya_tercero'];
	$total_puntos_redimibles_campanya_factura_mas_acumulado       = ($total_puntos_redimibles_campanya_factura_actual + $total_puntos_redimibles_campanya_tercero_acumulado);
	$total_valor_dinero_puntos_redimibles_campanya                = $total_puntos_redimibles_campanya_factura_mas_acumulado * $equivalencia_en_pesos_de_un_punto;
//-------------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------//
	$sql_producto_auxiliar = "SELECT * FROM tbl15_producto_auxiliar WHERE (cod_producto_barra = '$cod_producto_barra')";
	$resultado_producto_auxiliar = mysqli_query($conectar, $sql_producto_auxiliar);
	$info_producto_auxiliar = mysqli_fetch_assoc($resultado_producto_auxiliar);

	$nombre_producto                    = $info_producto_auxiliar['nombre_producto'];
	$precio_compra_producto             = $info_producto_auxiliar['precio_compra_producto'];
	$precio_venta_producto              = intval($total_valor_dinero_puntos_redimibles_campanya * - 1);
	$iva_ptj                            = $info_producto_auxiliar['iva_ptj'];
	$nombre_tipo_producto               = $info_producto_auxiliar['nombre_tipo_producto'];
	$nombre_tipo_unidad_medida          = $info_producto_auxiliar['nombre_tipo_unidad_medida'];
	$nombre_tipo_precio_venta           = $info_producto_auxiliar['nombre_tipo_precio_venta'];
	$cod_dependencia                    = $info_producto_auxiliar['cod_dependencia'];
	$und_venta                          = '1';
	$cod_tipo_cobrar 		            = '1';
	$cod_estado_cava                    = '1';
	$total_venta_producto               = $und_venta * $precio_venta_producto;
	$precio_venta_producto_orig         = $precio_venta_producto;
//-------------------------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------//
	$agreg = "INSERT INTO tbl15_venta_producto_temporal (cod_info_factura_venta, cod_tercero, cod_caja_virtual, cod_producto_barra, nombre_producto, 
	und_venta, precio_venta_producto, total_venta_producto, nombre_tipo_producto, nombre_tipo_unidad_medida, nombre_tipo_precio_venta, 
	cod_tipo_cobrar, cuenta, precio_venta_producto_orig) 
	VALUES ('$cod_info_factura_venta', '$cod_tercero', '$cod_caja_virtual', '$cod_producto_barra', '$nombre_producto', 
	'$und_venta', '$precio_venta_producto', '$total_venta_producto', '$nombre_tipo_producto', '$nombre_tipo_unidad_medida', '$nombre_tipo_precio_venta', 
	'$cod_tipo_cobrar', '$cuenta', '$precio_venta_producto_orig')";
	$resultado_sql1 = mysqli_query($conectar, $agreg) or die(mysqli_error($conectar));
?>
	<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_local?>">
<?php } ?>