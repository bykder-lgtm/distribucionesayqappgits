<?php include_once("../admin/01_modulo_inicio_sesion_visitante.php"); ?>
<?php error_reporting(E_ALL ^ E_NOTICE);
header('Content-Type: application/json');
//header('Content-Type: application/json');

//include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
//include_once('../evitar_mensaje_error/error.php'); 
 
//include_once("../session/funciones_admin.php");
//if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
	//} else { header("Location:../index.php");
//}
//$cuenta_actual                 = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$tab_codifcryp                      = $_POST['tab_codifcryp'];
$tab_codif                          = DAXCODIFCRYPTOR::descriptardax($tab_codifcryp);
$tab                                = addslashes(DAXCODIFCRYPTOR::descodiftextodax($tab_codif));

$accion_codifcryp                   = $_POST['accion_codifcryp'];
$accion_codif                       = DAXCODIFCRYPTOR::descriptardax($accion_codifcryp);
$accion                             = addslashes(DAXCODIFCRYPTOR::descodiftextodax($accion_codif));

$tipo_codifcryp                     = $_POST['tipo_codifcryp'];
$tipo_codif                         = DAXCODIFCRYPTOR::descriptardax($tipo_codifcryp);
$tipo                               = addslashes(DAXCODIFCRYPTOR::descodiftextodax($tipo_codif));

$origen_codifcryp                   = $_POST['origen_codifcryp'];
$origen_codif                       = DAXCODIFCRYPTOR::descriptardax($origen_codifcryp);
$origen                             = addslashes(DAXCODIFCRYPTOR::descodiftextodax($origen_codif));

$campo_codifcryp                    = $_POST['campo_codifcryp'];
$campo_codif                        = DAXCODIFCRYPTOR::descriptardax($campo_codifcryp);
$campo                              = addslashes(DAXCODIFCRYPTOR::descodiftextodax($campo_codif));

$vendedor_codifcryp                 = $_POST['vendedor_codifcryp'];
$vendedor_codif                     = DAXCODIFCRYPTOR::descriptardax($vendedor_codifcryp);
$vendedor                           = addslashes(DAXCODIFCRYPTOR::descodiftextodax($vendedor_codif));

$und_vendida                        = intval($_POST['und_vendida']);
//$und_vendida_codifcryp              = ($_POST['und_vendida_codifcryp']);
//$und_vendida_codif                  = DAXCODIFCRYPTOR::descriptardax($und_vendida_codifcryp);
//$und_vendida                        = intval(DAXCODIFCRYPTOR::descodifdax($und_vendida_codif));
$retorno_array                      = array();
$retorno_array2                     = array();
$codigoHTML_menu                    = '';
$codigoHTML_menu_total_reg          = '';

//$datos_array['salida_info_actualizada_carrito_compra_menu_total_reg_ajax']                     = '';
//$datos_array['salida_info_actualizada_carrito_compra_menu_ajax']                              = '';
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
if ($accion == 'registrar' && $origen == 'carrito') {

$cod_producto_codifcryp              = ($_POST['llave_codifcryp']);
$cod_producto_codif                  = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
$cod_producto                        = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));

$maxima_factura = "SELECT Max(cod_factura) AS cod_factura FROM tbl15_info_factura_venta";
$consulta_maxima = mysqli_query($conectar, $maxima_factura) or die(mysqli_error($conectar));
$maxima = mysqli_fetch_assoc($consulta_maxima);

$sqlr_consulta = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$modificar_consulta = mysqli_query($conectar, $sqlr_consulta) or die(mysqli_error($conectar));
$datos_prod = mysqli_fetch_assoc($modificar_consulta);

$cod_producto                   = $datos_prod['cod_producto'];
$cod_factura                    = 1;
$cod_base_caja                  = 1;
$nombre_producto                = $datos_prod['nombre_producto'];
$precio_compra_producto         = $datos_prod['precio_compra_producto'];
$precio_costo_producto          = $datos_prod['precio_costo_producto'];
$precio_venta_producto          = $datos_prod['precio_venta_producto'];
$precio_venta_producto2         = $precio_venta_producto;
$vlr_total_venta                = $precio_venta_producto * $und_vendida;
$vlr_total_compra               = $precio_compra_producto * $und_vendida;
$comentario                     = '';
$tipo_venta                     = 1;
$tipo_pago                      = 1;
$iva_ptj                        = $datos_prod['iva_ptj'];
$detalle_producto               = $datos_prod['detalle_producto'];
$descripcion_producto           = $datos_prod['descripcion_producto'];
$nombre_linea                   = $datos_prod['nombre_linea'];
$nombre_ccosto                  = $datos_prod['nombre_ccosto'];
$descuento                      = 0;
$ip                             = 0;
$url_img_min_producto           = $datos_prod['url_img_min_producto'];
$url_img_orig_producto          = $datos_prod['url_img_orig_producto'];
$fecha_time                     = time();
$fecha_mes                      = date("Y-m");
$fecha_anyo                     = date("Y-m-d");
$fecha_hora                     = date("H:i:s");
$bolsa                          = 0;
$cod_dependencia                = 1;
$cod_tipo_forma_pago            = 1;
$nombre_tipo_forma_pago         = 1;
$iva_valor                      = $und_vendida * ($precio_venta_producto - ($precio_venta_producto/(($iva_ptj/100)+1)));

$sql_datos_info = "SELECT cod_info_factura_venta FROM tbl15_info_factura_venta WHERE (cod_estado = '1' OR cod_estado = '0') AND (vendedor = '$vendedor')";
$consulta_info = mysqli_query($conectar, $sql_datos_info) or die(mysqli_error($conectar));
$datos_info = mysqli_fetch_assoc($consulta_info);
$cantidad_resultado = mysqli_num_rows($consulta_info);

if ($cantidad_resultado == 0) {

$sql_autoincre_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
$exec_autoincre_info_factura = mysqli_query($conectar, $sql_autoincre_info_factura) or die(mysqli_error($conectar));
$datos_autoincre_info_factura = mysqli_fetch_assoc($exec_autoincre_info_factura);

$cod_info_factura_venta         = $datos_autoincre_info_factura['AUTO_INCREMENT'];
$cod_factura                    = $maxima['cod_factura']+1;
$cod_estado_factura             = '3';
$nombre_estado_factura          = 'EN PROCESO';
$cod_estado                     = '1';
$nombre_estado                  = 'abierto';
$descuento_ptj                  = '0';
$iva_ptj                        = '0';
$flete_ptj                      = '0';
$cod_cliente                    = '0';
$vlr_cancelado                  = '';
$vlr_vuelto                     = '';
$fecha_dia                      = date("Y-m-d");
$fecha_mes                      = date("Y-m");
$fecha_anyo                     = date("Y-m-d");
$anyo                           = date("Y");
$fecha_hora                     = date("H:i:s");
$fecha_remision                 = date("Y-m-d");
$nombre_ccosto                  = '';
$garantia_meses                 = '';
$observacion                    = '';
$cod_tipo_pago                  = '1';
$nombre_empresa                 = '';
$fecha_ymdhis                   = date("Y-m-d H:is");

$sqlr_adm = "SELECT cedula, nombres, apellidos, correo, direccion FROM tbl15_administrador 
WHERE cod_administrador = '$cod_administrador'";
$modificar_adm = mysqli_query($conectar, $sqlr_adm) or die(mysqli_error($conectar));
$datos_adm = mysqli_fetch_assoc($modificar_adm);

$cedula                         = $datos_adm['cedula'];
$nombres                        = $datos_adm['nombres'];
$apellidos                      = $datos_adm['apellidos'];
$correo                         = $datos_adm['correo'];
$direccion                      = $datos_adm['direccion'];

$sql_data = "INSERT INTO tbl15_info_factura_venta (cod_factura, cod_estado_factura, nombre_estado_factura, 
cod_estado, cod_administrador, cuenta, nombre_estado, descuento_ptj, 
cod_cliente, vlr_cancelado, vlr_vuelto, fecha_dia, fecha_mes, fecha_anyo, anyo, fecha_hora, 
fecha_remision, nombre_ccosto, garantia_meses, observacion, cod_tipo_pago, nombre_empresa, 
fecha_ymdhis, vendedor, cedula, nombres, apellidos, correo, direccion) 
VALUES ('$cod_factura', '$cod_estado_factura', '$nombre_estado_factura', 
'$cod_estado', '$cod_administrador', '$vendedor', '$nombre_estado', '$descuento_ptj',
'$cod_cliente', '$vlr_cancelado', '$vlr_vuelto', '$fecha_dia', '$fecha_mes', '$fecha_anyo', '$anyo', '$fecha_hora', 
'$fecha_remision', '$nombre_ccosto', '$garantia_meses', '$observacion', '$cod_tipo_pago', '$nombre_empresa', 
'$fecha_ymdhis', '$vendedor' ,'$cedula' , '$nombres', '$apellidos', '$correo', '$direccion')";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
} else { 
$cod_info_factura_venta         = $datos_info['cod_info_factura_venta']; 
} 

$agre_reg = "INSERT INTO tbl15_carrito_compra_temporal (cod_producto, cod_factura, cod_base_caja, nombre_producto, 
und_vendida, precio_compra_producto, precio_costo_producto, precio_venta_producto, precio_venta_producto2 , vlr_total_venta, vlr_total_compra, 
comentario, tipo_venta, tipo_pago, iva_ptj, detalle_producto, descripcion_producto, nombre_linea, nombre_ccosto, 
descuento, vendedor, ip, url_img_min_producto, url_img_orig_producto, fecha_time, fecha_mes, fecha_anyo,
fecha_hora, bolsa, cod_dependencia, cod_tipo_forma_pago, nombre_tipo_forma_pago, 
cod_info_factura_venta, iva_valor)
VALUES ('$cod_producto', '$cod_factura', '$cod_base_caja', '$nombre_producto', 
'$und_vendida',	'$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', '$precio_venta_producto2', '$vlr_total_venta', '$vlr_total_compra', 
'$comentario', '$tipo_venta', '$tipo_pago', '$iva_ptj', '$detalle_producto', '$descripcion_producto', '$nombre_linea', '$nombre_ccosto', 
'$descuento', '$vendedor', '$ip', '$url_img_min_producto', '$url_img_orig_producto', '$fecha_time', '$fecha_mes', '$fecha_anyo',
'$fecha_hora', '$bolsa', '$cod_dependencia', '$cod_tipo_forma_pago', '$nombre_tipo_forma_pago', 
'$cod_info_factura_venta', '$iva_valor')";
$resultado_agre_reg = mysqli_query($conectar, $agre_reg) or die(mysqli_error($conectar));

$sql_datos_info = "SELECT cod_carrito_compra_temporal FROM tbl15_carrito_compra_temporal WHERE (vendedor = '$vendedor')";
$consulta_info = mysqli_query($conectar, $sql_datos_info) or die(mysqli_error($conectar));
$total_reg = mysqli_num_rows($consulta_info);

//$actualizar_carrito_compra = "UPDATE carrito_compra_temporal SET cod_cupon = '$cod_cupon', costo_cupon = '$costo_cupon' 
//WHERE vendedor = '$vendedor'";
//$resultado_carrito_compra = mysqli_query($conectar, $actualizar_carrito_compra) or die(mysqli_error($conectar));
//if ( mysqli_affected_rows($conectar) > 0) { echo "SI"; } else { echo "NO"; }

$total_venta                    = 0;
$conteo                         = 0;
//************************************************************************************************************************************//
//************************************************************************************************************************************//
$sql_producto = "SELECT cod_carrito_compra_temporal, nombre_producto, und_vendida, precio_venta_producto, 
vlr_total_venta, url_img_min_producto, url_img_orig_producto FROM tbl15_carrito_compra_temporal WHERE vendedor = '$vendedor' 
ORDER BY cod_carrito_compra_temporal DESC";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$total_reg = mysqli_num_rows($consulta_producto);
while ($datos_producto = mysqli_fetch_assoc($consulta_producto)) {

$conteo++;
$cod_carrito_compra_temporal         = $datos_producto['cod_carrito_compra_temporal'];
$nombre_producto                     = $datos_producto['nombre_producto'];
$und_vendida                         = $datos_producto['und_vendida'];
$precio_venta_producto               = $datos_producto['precio_venta_producto'];
$vlr_total_venta                     = $datos_producto['vlr_total_venta'];
$url_img_min_producto                = $datos_producto['url_img_min_producto'];
$url_img_orig_producto               = $datos_producto['url_img_orig_producto'];
$total_venta                        += $und_vendida * $precio_venta_producto;

$codigoHTML_menu .= '        <li>';
$codigoHTML_menu .= '            <a href="#" class="photo"><img src="'.$url_img_min_producto.'" class="cart-thumb" alt="" /></a>';
$codigoHTML_menu .= '            <h6><a href="#">'.$nombre_producto.'</a></h6>';
$codigoHTML_menu .= '            <p>'.$und_vendida.'x - <span class="price">$ '.number_format($precio_venta_producto, 0, ",", ".").'</span></p>';
$codigoHTML_menu .= '        </li>';

}
$codigoHTML_menu .= '        <li class="total">';
$codigoHTML_menu .= '            <a href="../admin/carrito_compra_temporal_visitante.php" class="btn btn-default hvr-hover btn-cart">VER CARRITO</a>';
$codigoHTML_menu .= '            <span class="float-right"><strong></strong>$ '.number_format($total_venta, 0, ",", ".").'</span>';
$codigoHTML_menu .= '        </li>';
//************************************************************************************************************************************//
//************************************************************************************************************************************//
//$datos_array['salida_info_actualizada_carrito_compra_menu_total_reg_ajax']             = $total_reg;
//$datos_array['salida_info_actualizada_carrito_compra_menu_ajax']                       = $codigoHTML_menu;
//array_push($retorno_array, $datos_array);
//echo json_encode($retorno_array);

$datos_array = array('salida_info_actualizada_carrito_compra_menu_total_reg_ajax' => $total_reg, 'salida_info_actualizada_carrito_compra_menu_ajax' => $codigoHTML_menu);
echo json_encode($datos_array);

}
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
?>