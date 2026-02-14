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
$cuenta_actual                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                       = $_SESSION['usuario'];
$cod_administrador            = $_SESSION['cod_administrador'];
$campo                        = addslashes($_REQUEST['campo']);
// ------------------------------------------------------------------------------------------------- //
if ($campo=='comentario') {
$comentario                          = addslashes($_REQUEST['valor']);
$cod_factura_auditoria_producto      = intval($_REQUEST['id']);

$data_sql = ("UPDATE tbl15_factura_auditoria_producto SET comentario = '$comentario' WHERE cod_factura_auditoria_producto = '$cod_factura_auditoria_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if ($campo=='corregir_inventario') {
$corregir_inventario                = addslashes($_REQUEST['valor']);
$cod_factura_auditoria_producto     = intval($_REQUEST['id']);

$origen_operacion                   = 'auditoria';
$fecha_hora                         = date("H:i:s");
$fecha_actual_hoy                   = date("Y-m-d");
$ip                                 = $_SERVER['REMOTE_ADDR'];
$fecha_time                         = time();
$cod_estado_correccion              = 1;
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_factura_auditoria_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_producto, und_compra, comentario 
FROM tbl15_factura_auditoria_producto WHERE (cod_factura_auditoria_producto = '$cod_factura_auditoria_producto')";
$consulta_factura_auditoria_producto = mysqli_query($conectar, $sql_factura_auditoria_producto);
$datos_factura_auditoria_producto = mysqli_fetch_assoc($consulta_factura_auditoria_producto);

$cod_producto                       = $datos_factura_auditoria_producto['cod_producto'];
$cod_producto_barra                 = $datos_factura_auditoria_producto['cod_producto_barra'];
$nombre_producto                    = $datos_factura_auditoria_producto['nombre_producto'];
$und_producto                       = $datos_factura_auditoria_producto['und_producto'];
$und_compra                         = $datos_factura_auditoria_producto['und_compra'];
$comentario                         = $datos_factura_auditoria_producto['comentario'];
$und_nuevas                         = $und_producto - $und_compra;
//---------------------------------------------------------------------------------------------------------------------------------------------//
$sql_producto = "SELECT * FROM tbl15_producto WHERE (cod_producto_barra = '$cod_producto_barra')";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$existe_producto = mysqli_num_rows($consulta_producto);
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$und_producto_inv                   = $datos_producto['und_producto'];
$rasteo_anterior                    = $datos_producto['nombre_frec_duracion'];
$unidades_vendidas                  = $und_compra;
$und_vend_orig                      = $und_producto_inv;
$devoluciones                       = $und_producto - $und_producto_inv;
$precio_compra_producto             = $datos_producto['precio_compra_producto'];
$precio_costo_producto              = $datos_producto['precio_costo_producto'];
$precio_venta_producto              = $datos_producto['precio_venta_producto'];
$vlr_total_compra                   = $datos_producto['total_precio_costo_producto'];
$vlr_total_venta                    = $datos_producto['total_precio_venta_producto'];
$cod_tercero                        = $datos_producto['cod_tercero'];
$iva_ptj                            = $datos_producto['iva_ptj'];
$und_inventario                     = $und_producto_inv;
$unidades_faltantes                 = $und_compra;

$fecha_devolucion                   = date("Y-m-d");
$hora_devolucion                    = date("H:i:s");
$fecha_anyo                         = $fecha_devolucion;
$fecha_hora                         = $hora_devolucion;
$fecha_orig                         = $fecha_devolucion;
$fecha                              = $fecha_time;
$fecha_mes                          = date("Y-m");
//---------------------------------------------------------------------------------------------------------------------------------------------//
$nombre_frec_duracion               = $rasteo_anterior.' - '.$origen_operacion.' - '.$cuenta.' - '.$ip.' - und_producto = '.$und_producto;
$und_producto                       = $und_inventario + $corregir_inventario;
//--------------------------------------------------------------------------------------------------------------------------------------------
$data_sql = ("UPDATE tbl15_factura_auditoria_producto SET corregir_inventario = '$corregir_inventario', cod_estado_correccion = '$cod_estado_correccion' WHERE cod_factura_auditoria_producto = '$cod_factura_auditoria_producto'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

$sql_data = "UPDATE tbl15_producto SET und_producto = '$und_producto', nombre_frec_duracion = '$nombre_frec_duracion' WHERE cod_producto_barra = '$cod_producto_barra'";
$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

$agregar_operacion = "INSERT INTO tbl15_operacion (cod_producto_barra, nombre_producto, origen_operacion, unidades_vendidas, 
und_vend_orig, devoluciones, precio_compra_producto, precio_costo_producto, precio_venta_producto, 
vlr_total_compra, vlr_total_venta, cod_tercero, iva_ptj, fecha_devolucion, hora_devolucion, fecha_orig, fecha_anyo, 
fecha_hora, cuenta, fecha_time, und_inventario, unidades_faltantes, und_nuevas, comentario, fecha, fecha_mes) 
VALUES ('$cod_producto_barra', '$nombre_producto', '$origen_operacion', '$unidades_vendidas', 
'$und_vend_orig', '$devoluciones', '$precio_compra_producto', '$precio_costo_producto', '$precio_venta_producto', 
'$vlr_total_compra', '$vlr_total_venta', '$cod_tercero', '$iva_ptj', '$fecha_devolucion', '$hora_devolucion', '$fecha_orig', '$fecha_anyo', 
'$fecha_hora', '$cuenta', '$fecha_time', '$und_inventario', '$unidades_faltantes', '$und_nuevas', '$comentario', '$fecha', '$fecha_mes')";
$resultado_operacion = mysqli_query($conectar, $agregar_operacion) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
?>