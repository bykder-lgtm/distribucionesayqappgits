<?php
require_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_codif_cryptor_class.php');
require_once('../evitar_mensaje_error/error.php'); 
date_default_timezone_set("America/Bogota");

include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
      } else { header("Location:../index.php");
}
$cuenta_actual                        = addslashes($_SESSION['usuario']);

$sql_info_impresora = "SELECT tamano_papel_impresora FROM tbl15_administrador WHERE cuenta = '$cuenta_actual'";
$consultar_info_impresora = mysqli_query($conectar, $sql_info_impresora) or die(mysqli_error($conectar));
$info_impresora = mysqli_fetch_assoc($consultar_info_impresora);

$tamano_papel_impresora                     = $info_impresora['tamano_papel_impresora'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_info_parqueo_cotizacion_factura_venta               = intval($_GET['cod_info_parqueo_cotizacion_factura_venta']);

$obtener_informacion = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$consultar_informacion = mysqli_query($conectar, $obtener_informacion) or die(mysqli_error($conectar));
$info_emp = mysqli_fetch_assoc($consultar_informacion);

$titulo_emp                              = $info_emp['titulo'];
$desarrollador_emp                       = $info_emp['desarrollador'];
$pag_desarrollador_emp                   = $info_emp['pag_desarrollador'];
$correo_desarrollador_emp                = $info_emp['correo_desarrollador'];
$anyo_emp                                = $info_emp['anyo'];
$nombre_emp                              = $info_emp['nombre'];
$eslogan_emp                             = $info_emp['eslogan'];
$nombre_propietario_emp                  = $info_emp['nombre_propietario'];
$cedula_propietario_emp                  = $info_emp['cedula_propietario'];
$res_emp                                 = $info_emp['res'];
$res1_emp                                = $info_emp['res1'];
$res2_emp                                = $info_emp['res2'];
$fecha_res_emp                           = $info_emp['fecha_res'];
$prefijo_res_emp                         = $info_emp['prefijo_res'];
$pais_emp                                = $info_emp['pais'];
$departamento_emp                        = $info_emp['departamento'];
$ciudad_emp                              = $info_emp['ciudad'];
$localidad_emp                           = $info_emp['localidad'];
$direccion_emp                           = $info_emp['direccion'];
$correo_emp                              = $info_emp['correo'];
$cabecera_emp                            = $info_emp['cabecera'];
$telefono_emp                            = $info_emp['telefono'];
$nit_empresa_emp                         = $info_emp['nit_empresa'];
$regimen_emp                             = $info_emp['regimen'];
$propietario_nombres_apellidos_emp       = $info_emp['propietario_nombres_apellidos'];
$propietario_nit_emp                     = $info_emp['propietario_nit'];
$propietario_url_firma_emp               = $info_emp['propietario_url_firma'];
$nombre_concepto_multi_virtual           = $info_emp['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta                = $info_emp['nombre_tipo_precio_venta'];
$numero_precio                           = $info_emp['numero_precio'];
$nombre_tipo_empresa                     = $info_emp['nombre_tipo_empresa'];
$dias_vencimiento_producto_alerta        = $info_emp['dias_vencimiento_producto_alerta'];
$cod_estado_fecha_vencimiento_global            = $info_emp['cod_estado_fecha_vencimiento_global'];
$cod_estado_ptj_comision_global                 = $info_emp['cod_estado_ptj_comision_global'];
$cod_estado_impoconsumo_global                  = $info_emp['cod_estado_impoconsumo_global'];
$cod_estado_dto1_global                         = $info_emp['cod_estado_dto1_global'];
$cod_estado_dto2_global                         = $info_emp['cod_estado_dto2_global'];
$cod_estado_preventa_global                     = $info_emp['cod_estado_preventa_global'];
$cod_estado_propina_global                      = $info_emp['cod_estado_propina_global'];
$cod_estado_img_impimir_factura_global          = $info_emp['cod_estado_img_impimir_factura_global'];
$url_encuesta_experiencia_compra         = $info_emp['url_encuesta_experiencia_compra'];
$cod_estado_encuesta_experiencia_compra_global  = $info_emp['cod_estado_encuesta_experiencia_compra_global'];
$version_emp                             = $info_emp['version'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_info_fact = "SELECT * FROM tbl15_info_parqueo_cotizacion_factura_venta WHERE (cod_info_parqueo_cotizacion_factura_venta = '$cod_info_parqueo_cotizacion_factura_venta')";
$resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
$info_fact = mysqli_fetch_assoc($resultado_info_fact);

$cod_factura                         = $info_fact['cod_factura'];
$fecha_anyo                          = $info_fact['fecha_anyo'];
$fecha_hora                          = $info_fact['fecha_hora'];
$total_precio_compra                 = $info_fact['total_precio_compra'];
$total_precio_venta                  = $info_fact['total_precio_venta'];
$total_datos_data                    = $info_fact['total_datos_data'];
$cod_tercero                         = $info_fact['cod_tercero'];
$cuenta                              = $info_fact['cuenta'];
$vlr_cancelado                       = $info_fact['vlr_cancelado'];
$vlr_vuelto                          = $info_fact['vlr_vuelto'];
$cod_tipo_pago                       = $info_fact['cod_tipo_pago'];
$cod_administrador                   = $info_fact['cod_administrador'];
$cod_tipo_forma_pago                 = $info_fact['cod_tipo_forma_pago'];
$nombre_tipo_factura                 = $info_fact['nombre_tipo_factura'];
$nombre_tipo_moneda                  = $info_fact['nombre_tipo_moneda'];
$cod_resolucion_facturacion          = $info_fact['cod_resolucion_facturacion'];
$descuento_ptj                       = $info_fact['descuento_ptj'];

$cod_info_parqueo_cotizacion_factura_venta_codif        = DAXCODIFCRYPTOR::encodifdax($cod_info_parqueo_cotizacion_factura_venta);
$cod_info_parqueo_cotizacion_factura_venta_codif_cryp   = DAXCODIFCRYPTOR::encriptardax($cod_info_parqueo_cotizacion_factura_venta_codif);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);

$nombre_tipo_forma_pago                         = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_resolucion_facturacion = "SELECT * FROM tbl15_resolucion_facturacion WHERE (cod_resolucion_facturacion = '$cod_resolucion_facturacion')";
$consulta_resolucion_facturacion = mysqli_query($conectar, $sql_resolucion_facturacion) or die(mysqli_error($conectar));
$matriz_resolucion_facturacion = mysqli_fetch_assoc($consulta_resolucion_facturacion);

$cod_tipo_resolucion_facturacion        = $matriz_resolucion_facturacion['cod_tipo_resolucion_facturacion'];
$nombre_tipo_resolucion_facturacion     = $matriz_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
$numero_resolucion_facturacion          = $matriz_resolucion_facturacion['numero_resolucion_facturacion'];
$ini_resolucion_facturacion             = $matriz_resolucion_facturacion['ini_resolucion_facturacion'];
$fin_resolucion_facturacion             = $matriz_resolucion_facturacion['fin_resolucion_facturacion'];
$prefijo_resolucion_facturacion         = $matriz_resolucion_facturacion['prefijo_resolucion_facturacion'];
$fecha_resolucion_facturacion           = $matriz_resolucion_facturacion['fecha_resolucion_facturacion'];
$vigencia_meses_resolucion_facturacion  = $matriz_resolucion_facturacion['vigencia_meses_resolucion_facturacion'];
$nombre_tipo_estado                     = $matriz_resolucion_facturacion['nombre_tipo_estado'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_diseno_usario_vendedor = "SELECT nombres, apellidos, cod_caja FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador')";
$resultado_diseno_usario_vendedor = mysqli_query($conectar, $obtener_diseno_usario_vendedor) or die(mysqli_error($conectar));
$matriz_usario_vendedor = mysqli_fetch_assoc($resultado_diseno_usario_vendedor);

$usario_vendedor                     = $matriz_usario_vendedor['nombres'].' '.$matriz_usario_vendedor['apellidos'];
$cod_caja                            = $matriz_usario_vendedor['cod_caja'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_cliente = "SELECT * FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$resultado_cliente = mysqli_query($conectar, $obtener_cliente) or die(mysqli_error($conectar));
$matriz_cliente = mysqli_fetch_assoc($resultado_cliente);

$nombre_cliente                      = $matriz_cliente['nombre1_tercero'].' '.$matriz_cliente['apellido1_tercero'];
$cedula_cli                          = $matriz_cliente['identificacion_tercero'];
$direccion_cli                       = $matriz_cliente['direccion_tercero'];
$nombre_tipo_identificacion          = $matriz_cliente['nombre_tipo_identificacion'];
$digito_tercero                      = $matriz_cliente['digito_tercero'];
if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$suma_temporal = "SELECT Sum(total_venta_producto -(total_venta_producto*(descuento_ptj/100))) As total_venta, 
Sum((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100))) As subtotal_base, 
Sum(((total_venta_producto - ((descuento_ptj/100)*total_venta_producto))/((iva_ptj/100)+(100/100)))*(iva_ptj/100)) As total_iva, 
Sum(total_venta_producto*(descuento_ptj/100)) AS total_desc, Sum(total_venta_producto) AS total_venta_neta FROM tbl15_parqueo_cotizacion_venta_producto 
WHERE (cod_info_parqueo_cotizacion_factura_venta= '$cod_info_parqueo_cotizacion_factura_venta')";
$consulta_temporal = mysqli_query($conectar, $suma_temporal) or die(mysqli_error($conectar));
$suma = mysqli_fetch_assoc($consulta_temporal);

$total_venta_neta                    = ($suma['total_venta_neta']);
$subtotal_base                       = ($suma['subtotal_base']);
$total_desc                          = ($suma['total_desc']);
$total_iva                           = ($suma['total_iva']);
$total_venta_temp                    = ($suma['total_venta']);
$vlr_cambio                          = ($vlr_cancelado - $total_venta_temp);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
$resultado_tipo_pago = mysqli_query($conectar, $obtener_tipo_pago) or die(mysqli_error($conectar));
$data_tipo_pago = mysqli_fetch_assoc($resultado_tipo_pago);

$nombre_tipo_pago                     = $data_tipo_pago['nombre_tipo_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad                   = str_pad($cod_factura, 3, "0", STR_PAD_LEFT);
$cod_info_factura_strpad              = str_pad($cod_info_parqueo_cotizacion_factura_venta, 3, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$resta                               = 1516399999;
$time_seg                            = time();
$time_date_ymd                       = strtotime(date("Y/m/d"));
$fecha                               = date("Ymd");
$hora                                = date("His");
$fecha_venta_ymd                     = date("Ymd", strtotime($fecha_anyo));
$hora_venta_his                      = date("His");
$fecha_hoy                           = date("Y-m-d");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$obtener_info_mquina_impr = "SELECT nombre_maquina, nombre_impresora FROM tbl15_administrador WHERE cuenta = '$cuenta_actual'";
$resultado_info_mquina_impr = mysqli_query($conectar, $obtener_info_mquina_impr)or die(mysqli_error($conectar));
$info_mquina_impr = mysqli_fetch_assoc($resultado_info_mquina_impr);

$nombre_maquina             = $info_mquina_impr['nombre_maquina'];
$nombre_impresora           = $info_mquina_impr['nombre_impresora'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
require __DIR__ . '/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
//use Mike42\Escpos\CapabilityProfiles\EposTepCapabilityProfile;
//$connector = new WindowsPrintConnector($nombre_impresora);
$connector = new WindowsPrintConnector("smb://".$nombre_maquina."/".$nombre_impresora);
//$nombre_impresora = "\\192.168.1.213 \ Etiq2";
//$connector = new WindowsPrintConnector($nombre_impresora);
//$connector = new WindowsPrintConnector("smb://DESKTOP-5KUV4DP/POS-80C (copy 1)");

//$printer = new Printer($connector, $profile);
$printer = new Printer($connector);
#Mando un numero de respuesta para saber que se conecto correctamente.

if ($tamano_papel_impresora == '58') {

$printer->setFont(Printer::FONT_B);
$printer->setTextSize(1, 1);

$printer->setJustification(Printer::JUSTIFY_CENTER);
if ($cod_estado_img_impimir_factura_global == '1') { 
try{
$logo = EscposImage::load("../imagenes/logo_empresa_factura_pos_blanco_negro.jpg", false);
$printer->bitImage($logo);
}catch(Exception $e){ }
}

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setEmphasis(true);
$printer->text($cabecera_emp."\n");
$printer->setEmphasis(false);
$printer->text($localidad_emp."\n");
$printer->text("NIT: ".$nit_empresa_emp."\n");
$printer->text("DIRECCION: ".$direccion_emp."\n");
$printer->text("TELEFONO: ".$telefono_emp."\n");

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<======================================>>");
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);
$printer->text(str_pad("FECHA: ".$fecha_anyo, 17));
$printer->text(str_pad(" TICKET INGRESO #: ".$cod_factura, 25));
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);
$printer->text(str_pad($nombre_tipo_identificacion." CLIENTE: ".$cedula_cli.$digito_tercero, 26));
$printer->text("\n");
$printer->text(str_pad("CLIENTE: ".utf8_decode($nombre_cliente), 25));
$printer->text("\n");

$printer->setEmphasis(true);
$printer->text("USUARIO: ");
$printer->text($usario_vendedor);
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<======================================>>");
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);
$printer->text(str_pad("SERVICIO", 15));
$printer->text(str_pad("PLACA", 10));
$printer->text(str_pad("FECHA", 10));
$printer->text(str_pad("HORA", 5));
$printer->text("\n");
$printer->text(str_pad("VALOR", 8));
$printer->setEmphasis(false);
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("-----------------------------------------");
$printer->text("\n");

$resultado_sql = "SELECT * FROM tbl15_parqueo_cotizacion_venta_producto WHERE (cod_info_parqueo_cotizacion_factura_venta = '$cod_info_parqueo_cotizacion_factura_venta')";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

$cod_producto                      = $info_venta['cod_producto'];
$cod_producto_barra                = $info_venta['cod_producto_barra'];
$nombre_producto                   = $info_venta['nombre_producto'];
$und_venta                         = $info_venta['und_venta'];
$precio_venta_producto             = $info_venta['precio_venta_producto'];
$total_venta_producto              = $info_venta['total_venta_producto'];
$iva_ptj                           = $info_venta['iva_ptj'];
$precio_ipc                        = $info_venta['precio_ipc'];

$placa_producto                    = $info_venta['placa_producto'];
$comentario_producto               = $info_venta['comentario_producto'];
$fecha_ymd_parqueo_ini             = $info_venta['fecha_ymd_parqueo_ini'];
$fecha_hora_parqueo_ini            = substr($info_venta['fecha_hora_parqueo_ini'], 0, 5);
$fecha_ymd_parqueo_fin             = $info_venta['fecha_ymd_parqueo_fin'];
$fecha_hora_parqueo_fin            = $info_venta['fecha_hora_parqueo_fin'];

$total_caracteres = strlen($nombre_producto);
//---------------------------------------------------------------------------------------------------------------------------------//
if ($total_caracteres > 30) {
$nombre_producto1   = substr(trim($nombre_producto), 0, 15);
$nombre_producto2   = substr(trim($nombre_producto), 15, 20);

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad($nombre_producto1, 10));
$printer->text(str_pad($placa_producto, 8));
$printer->text(str_pad($fecha_ymd_parqueo_ini, 10,' ',STR_PAD_LEFT));
$printer->text(str_pad($fecha_hora_parqueo_ini, 5,' ',STR_PAD_LEFT));
$printer->text("\n");
$printer->text(str_pad(number_format($total_venta_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT));

if ($nombre_producto2 <> "") {
$printer->text("\n");
$printer->text(str_pad("", 6));
$printer->text(str_pad($nombre_producto2, 15));
$printer->text(str_pad("", 7,' ',STR_PAD_LEFT));
$printer->text(str_pad("", 9,' ',STR_PAD_LEFT));
}

$printer->text("\n");
} else {
$nombre_producto1   = substr($nombre_producto, 0, 15);
$nombre_producto2   = "";

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad($nombre_producto1, 15));
$printer->text(str_pad($placa_producto, 6));
$printer->text(str_pad($fecha_ymd_parqueo_ini, 11,' ',STR_PAD_LEFT));
$printer->text(str_pad($fecha_hora_parqueo_ini, 7,' ',STR_PAD_LEFT));
$printer->text(str_pad(number_format($total_venta_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT));
$printer->text("\n");
}
//---------------------------------------------------------------------------------------------------------------------------------//
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<======================================>>");
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setTextSize(1, 2);
$printer->setEmphasis(true);
$printer->text(str_pad("TOTAL A PAGAR: ", 25));
$printer->text(str_pad("".number_format($total_venta_temp, 0, ",", "."), 8));
$printer->setEmphasis(false);
$printer->setTextSize(1, 1);
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<======================================>>");
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
/*
if ($cod_tipo_pago == '1') {
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setEmphasis(true);
$printer->text(str_pad("RECIBIDO", 30));
$printer->text(str_pad("CAMBIO", 10));
$printer->setEmphasis(false);
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setEmphasis(true);
$printer->text(str_pad("$ ".number_format($vlr_cancelado, 0, ",", "."), 30));
$printer->text(str_pad("$ ".number_format($vlr_cambio, 0, ",", "."), 10));
$printer->setEmphasis(false);
$printer->text("\n");
}
*/
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->text("<== Software ".$titulo_emp." Version ".$version_emp." ==>");
$printer->text("\n");
$printer->text("<== ".$desarrollador_emp." : ".$pag_desarrollador_emp." ==>");
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$estandar_a = "{A";
$estandar_b = "{B";
$estandar_c = "{C" . chr(01) . chr(23) . chr(23) . chr(39) . chr(29) . chr(82);
$barra      = $estandar_b.str_pad($cod_factura, 5, "0", STR_PAD_LEFT);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> setBarcodeHeight(60);
//$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
$printer -> barcode($barra, Printer::BARCODE_CODE128);
//$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_estado_encuesta_experiencia_compra_global == '1') { 
$url_qr = $url_encuesta_experiencia_compra."/pageditaxe/admin/inicio.php?cod_info_parqueo_cotizacion_factura_venta_codif_cryp=".$cod_info_parqueo_cotizacion_factura_venta_codif_cryp;  
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("Califica tu experiencia de compra en:\n");
$printer -> text($url_encuesta_experiencia_compra."\n");
$printer -> qrCode($url_qr, Printer::QR_ECLEVEL_L, 3);

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->setEmphasis(true);
$printer -> text("ESCANEAME");
$printer->text("\n");
}
$printer->text("<== ".$fecha.$hora."-".$cod_factura."-".$cod_info_parqueo_cotizacion_factura_venta."_parqimposdriv58 ==>");
$printer->feed(3);

} else { 

$printer->setFont(Printer::FONT_B);
$printer->setTextSize(1, 1);

$printer->setJustification(Printer::JUSTIFY_CENTER);
if ($cod_estado_img_impimir_factura_global == '1') { 
try{
$logo = EscposImage::load("../imagenes/logo_empresa_factura_pos_blanco_negro.jpg", false);
$printer->bitImage($logo);
}catch(Exception $e){ }
}

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setEmphasis(true);
$printer->text($cabecera_emp."\n");
$printer->setEmphasis(false);
$printer->text($localidad_emp."\n");
$printer->text("NIT: ".$nit_empresa_emp."\n");
$printer->text("DIRECCION: ".$direccion_emp."\n");
$printer->text("TELEFONO: ".$telefono_emp."\n");

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<======================================>>");
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);
$printer->text(str_pad("FECHA: ".$fecha_anyo, 17));
$printer->text(str_pad(" TICKET INGRESO #: ".$cod_factura, 25));
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);
$printer->text(str_pad($nombre_tipo_identificacion." CLIENTE: ".$cedula_cli, 26));
$printer->text("\n");
$printer->text(str_pad("CLIENTE: ".utf8_decode($nombre_cliente), 25));
$printer->text("\n");

$printer->setEmphasis(true);
$printer->text("USUARIO: ");
$printer->text($usario_vendedor);
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<======================================>>");
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setEmphasis(true);
$printer->text(str_pad("SERVICIO", 15));
$printer->text(str_pad("PLACA", 10));
$printer->text(str_pad("FECHA", 10));
$printer->text(str_pad("HORA", 5));
$printer->text("\n");
$printer->text(str_pad("VALOR", 8));
$printer->setEmphasis(false);
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("-----------------------------------------");
$printer->text("\n");

$resultado_sql = "SELECT * FROM tbl15_parqueo_cotizacion_venta_producto WHERE (cod_info_parqueo_cotizacion_factura_venta = '$cod_info_parqueo_cotizacion_factura_venta')";
$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

$cod_producto                      = $info_venta['cod_producto'];
$cod_producto_barra                = $info_venta['cod_producto_barra'];
$nombre_producto                   = $info_venta['nombre_producto'];
$und_venta                         = $info_venta['und_venta'];
$precio_venta_producto             = $info_venta['precio_venta_producto'];
$total_venta_producto              = $info_venta['total_venta_producto'];
$iva_ptj                           = $info_venta['iva_ptj'];
$precio_ipc                        = $info_venta['precio_ipc'];

$placa_producto                    = $info_venta['placa_producto'];
$comentario_producto               = $info_venta['comentario_producto'];
$fecha_ymd_parqueo_ini             = $info_venta['fecha_ymd_parqueo_ini'];
$fecha_hora_parqueo_ini            = substr($info_venta['fecha_hora_parqueo_ini'], 0, 5);
$fecha_ymd_parqueo_fin             = $info_venta['fecha_ymd_parqueo_fin'];
$fecha_hora_parqueo_fin            = $info_venta['fecha_hora_parqueo_fin'];

$total_caracteres = strlen($nombre_producto);
//---------------------------------------------------------------------------------------------------------------------------------//
if ($total_caracteres > 30) {
$nombre_producto1   = substr(trim($nombre_producto), 0, 15);
$nombre_producto2   = substr(trim($nombre_producto), 15, 20);

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad($nombre_producto1, 10));
$printer->text(str_pad($placa_producto, 8));
$printer->text(str_pad($fecha_ymd_parqueo_ini, 10,' ',STR_PAD_LEFT));
$printer->text(str_pad($fecha_hora_parqueo_ini, 5,' ',STR_PAD_LEFT));
$printer->text("\n");
$printer->text(str_pad(number_format($total_venta_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT));

if ($nombre_producto2 <> "") {
$printer->text("\n");
$printer->text(str_pad("", 6));
$printer->text(str_pad($nombre_producto2, 15));
$printer->text(str_pad("", 7,' ',STR_PAD_LEFT));
$printer->text(str_pad("", 9,' ',STR_PAD_LEFT));
}

$printer->text("\n");
} else {
$nombre_producto1   = substr($nombre_producto, 0, 15);
$nombre_producto2   = "";

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text(str_pad($nombre_producto1, 15));
$printer->text(str_pad($placa_producto, 6));
$printer->text(str_pad($fecha_ymd_parqueo_ini, 11,' ',STR_PAD_LEFT));
$printer->text(str_pad($fecha_hora_parqueo_ini, 7,' ',STR_PAD_LEFT));
$printer->text(str_pad(number_format($total_venta_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT));
$printer->text("\n");
}
//---------------------------------------------------------------------------------------------------------------------------------//
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<======================================>>");
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->setTextSize(1, 2);
$printer->setEmphasis(true);
$printer->text(str_pad("TOTAL A PAGAR: ", 25));
$printer->text(str_pad("".number_format($total_venta_temp, 0, ",", "."), 8));
$printer->setEmphasis(false);
$printer->setTextSize(1, 1);
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->text("<<======================================>>");
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
/*
if ($cod_tipo_pago == '1') {
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setEmphasis(true);
$printer->text(str_pad("RECIBIDO", 30));
$printer->text(str_pad("CAMBIO", 10));
$printer->setEmphasis(false);
$printer->text("\n");

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setEmphasis(true);
$printer->text(str_pad("$ ".number_format($vlr_cancelado, 0, ",", "."), 30));
$printer->text(str_pad("$ ".number_format($vlr_cambio, 0, ",", "."), 10));
$printer->setEmphasis(false);
$printer->text("\n");
}
*/
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$printer->text("<== Software ".$titulo_emp." Version ".$version_emp." ==>");
$printer->text("\n");
$printer->text("<== ".$desarrollador_emp." : ".$pag_desarrollador_emp." ==>");
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$estandar_a = "{A";
$estandar_b = "{B";
$estandar_c = "{C" . chr(01) . chr(23) . chr(23) . chr(39) . chr(29) . chr(82);
$barra      = $estandar_b.str_pad($cod_factura, 5, "0", STR_PAD_LEFT);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> setBarcodeHeight(60);
//$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
$printer -> barcode($barra, Printer::BARCODE_CODE128);
//$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ($cod_estado_encuesta_experiencia_compra_global == '1') { 
$url_qr = $url_encuesta_experiencia_compra."/pageditaxe/admin/inicio.php?cod_info_parqueo_cotizacion_factura_venta_codif_cryp=".$cod_info_parqueo_cotizacion_factura_venta_codif_cryp;  
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("Califica tu experiencia de compra en:\n");
$printer -> text($url_encuesta_experiencia_compra."\n");
$printer -> qrCode($url_qr, Printer::QR_ECLEVEL_L, 3);

$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer->setEmphasis(true);
$printer -> text("ESCANEAME");
$printer->text("\n");
}
$printer->text("<== ".$fecha.$hora."-".$cod_factura."-".$cod_info_parqueo_cotizacion_factura_venta."_parqimposdriv58 ==>");
$printer->feed(1);
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
/*Alimentamos el papel 3 veces*/
/* 	Cortamos el papel. Si nuestra impresora no tiene soporte para ello, no generará ningún error */
$printer->cut();
/* 	Por medio de la impresora mandamos un pulso. Esto es útil cuando la tenemos conectada por ejemplo a un cajón */
$printer->pulse();
/* Para imprimir realmente, tenemos que "cerrar" la conexión con la impresora. Recuerda incluir esto al final de todos los archivos */
$printer->close();
?>