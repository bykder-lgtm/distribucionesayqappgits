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
$cuenta_actual                                  = addslashes($_SESSION['usuario']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_tercero                                    = intval($_REQUEST['cod_tercero']);
if (isset($_REQUEST['origen'])) { $origen = $_REQUEST['origen']; } else { $origen = 0; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                                        = $info_empresa_data['titulo'];
$nombre_emp                                                        = $info_empresa_data['nombre'];
$eslogan_emp                                                       = $info_empresa_data['eslogan'];
$direccion_emp                                                     = $info_empresa_data['direccion'];
$ciudad_emp                                                        = $info_empresa_data['ciudad'];
$pais_emp                                                          = $info_empresa_data['pais'];
$correo_emp                                                        = $info_empresa_data['correo'];
$img_cabecera_emp                                                  = $info_empresa_data['img_cabecera'];
$telefono_emp                                                      = $info_empresa_data['telefono'];
$info_legal_emp                                                    = $info_empresa_data['info_legal'];
$logotipo_emp                                                      = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp                                 = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                                               = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                                                   = $info_empresa_data['nit_empresa'];
$cabecera_emp                                                      = $info_empresa_data['cabecera'];
$icono_emp                                                         = $info_empresa_data['icono'];
$desarrollador_emp                                                 = $info_empresa_data['desarrollador'];
$pag_desarrollador_emp                                             = $info_empresa_data['pag_desarrollador'];
$anyo_emp                                                          = $info_empresa_data['anyo'];
$url_pag                                                           = $info_empresa_data['url_pag'];
$nombre_font                                                       = $info_empresa_data['nombre_font'];
$res_emp                                                           = $info_empresa_data['res'];
$res1_emp                                                          = $info_empresa_data['res1'];
$res2_emp                                                          = $info_empresa_data['res2'];
$departamento_emp                                                  = $info_empresa_data['departamento'];
$localidad_emp                                                     = $info_empresa_data['localidad'];
$reg_medico_emp                                                    = $info_empresa_data['reg_medico'];
$regimen_emp                                                       = $info_empresa_data['regimen'];
$version_emp                                                       = $info_empresa_data['version'];
$propietario_url_firma_emp                                         = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                                                    = $info_empresa_data['fecha_time'];
$licencia_emp                                                      = $info_empresa_data['licencia'];
$tamano_font_emp                                                   = $info_empresa_data['tamano_font'];
$info_histclinic_emp                                               = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                                               = $info_empresa_data['info_aptlaboral'];
$dia_ini_facturacion_emp                                           = $info_empresa_data['dia_ini_facturacion'];
$dia_fin_facturacion_emp                                           = $info_empresa_data['dia_fin_facturacion'];
$smtp_correo_host_emp                                              = $info_empresa_data['smtp_correo_host'];
$smtp_correo_auth_emp                                              = $info_empresa_data['smtp_correo_auth'];
$smtp_correo_username_emp                                          = $info_empresa_data['smtp_correo_username'];
$smtp_correo_password_emp                                          = $info_empresa_data['smtp_correo_password'];
$smtp_correo_secure_emp                                            = $info_empresa_data['smtp_correo_secure'];
$smtp_correo_port_emp                                              = $info_empresa_data['smtp_correo_port'];
$nombre_concepto_multi_virtual                                     = $info_empresa_data['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta                                          = $info_empresa_data['nombre_tipo_precio_venta'];
$numero_precio                                                     = $info_empresa_data['numero_precio'];
$nombre_tipo_empresa                                               = $info_empresa_data['nombre_tipo_empresa'];
$cantidad_caja_mesa                                                = $info_empresa_data['cantidad_caja_mesa'];

$cod_estado_habilitar_btn_imp_venta_nav_global                     = $info_empresa_data['cod_estado_habilitar_btn_imp_venta_nav_global'];
$cod_estado_habilitar_btn_imp_venta_direct_driv_global             = $info_empresa_data['cod_estado_habilitar_btn_imp_venta_direct_driv_global'];
$cod_estado_habilitar_btn_imp_nav_carta_pdf_global                 = $info_empresa_data['cod_estado_habilitar_btn_imp_nav_carta_pdf_global'];
$cod_estado_habilitar_btn_imp_preventodo_nav_global                = $info_empresa_data['cod_estado_habilitar_btn_imp_preventodo_nav_global'];
$cod_estado_habilitar_btn_imp_preventodo_direct_driv_global        = $info_empresa_data['cod_estado_habilitar_btn_imp_preventodo_direct_driv_global'];
$cod_estado_habilitar_btn_imp_cocina_nav_global                    = $info_empresa_data['cod_estado_habilitar_btn_imp_cocina_nav_global'];
$cod_estado_habilitar_btn_imp_cocina_direct_driv_global            = $info_empresa_data['cod_estado_habilitar_btn_imp_cocina_direct_driv_global'];
$cod_estado_habilitar_btn_imp_repventa_consol_nav_global           = $info_empresa_data['cod_estado_habilitar_btn_imp_repventa_consol_nav_global'];
$cod_estado_habilitar_btn_imp_repventa_direct_driv_global          = $info_empresa_data['cod_estado_habilitar_btn_imp_repventa_direct_driv_global'];
$tamano_papel_impresora                                            = $info_empresa_data['tamano_papel_impresora'];

$cod_tipo_sistema_numeracion_und_compra                            = $info_empresa_data['cod_tipo_sistema_numeracion_und_compra'];
$cod_tipo_sistema_numeracion_und_venta                             = $info_empresa_data['cod_tipo_sistema_numeracion_und_venta'];
$cod_tipo_sistema_numeracion_precio_compra                         = $info_empresa_data['cod_tipo_sistema_numeracion_precio_compra'];
$cod_tipo_sistema_numeracion_precio_venta                          = $info_empresa_data['cod_tipo_sistema_numeracion_precio_venta'];

$nombre_tipo_campo_componente_html_und_venta                       = $info_empresa_data['nombre_tipo_campo_componente_html_und_venta'];
$nombre_tipo_campo_componente_html_und_compra                      = $info_empresa_data['nombre_tipo_campo_componente_html_und_compra'];
$nombre_tipo_campo_componente_html_precio_compra                   = $info_empresa_data['nombre_tipo_campo_componente_html_precio_compra'];
$nombre_tipo_campo_componente_html_precio_venta                    = $info_empresa_data['nombre_tipo_campo_componente_html_precio_venta'];
$cod_estado_comentario_venta_mostrar_imprimir_global               = $info_empresa_data['cod_estado_comentario_venta_mostrar_imprimir_global'];
$cod_estado_img_impimir_factura_global                             = $info_empresa_data['cod_estado_img_impimir_factura_global'];


if ($nombre_tipo_campo_componente_html_und_venta == 'text') { $nombre_tipo_campo_componente_html_und_venta = 'text'; } else { $nombre_tipo_campo_componente_html_und_venta = 'number'; }
if ($nombre_tipo_campo_componente_html_und_compra == 'text') { $nombre_tipo_campo_componente_html_und_compra = 'text'; } else { $nombre_tipo_campo_componente_html_und_compra = 'number'; }
if ($nombre_tipo_campo_componente_html_precio_compra == 'text') { $nombre_tipo_campo_componente_html_precio_compra = 'text'; } else { $nombre_tipo_campo_componente_html_precio_compra = 'number'; }
if ($nombre_tipo_campo_componente_html_precio_venta == 'text') { $nombre_tipo_campo_componente_html_precio_venta = 'text'; } else { $nombre_tipo_campo_componente_html_precio_venta = 'number'; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (strlen($cabecera_emp) > 25) { $tamano_letra_cabecera_emp_80mm = 1; $tamano_letra_cabecera_emp_58mm = 1; } else { $tamano_letra_cabecera_emp_80mm = 2; $tamano_letra_cabecera_emp_58mm = 2; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                          = date("Ymd");
$hora_impr                           = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$resta                               = 1516399999;
$time_seg                            = time();
$time_date_ymd                       = strtotime(date("Y/m/d"));
$fecha                               = date("Ymd");
$hora_venta_his                      = date("His");
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$calcular_datos_cuenta_cobrar = "SELECT identificacion_tercero, nombre_tipo_identificacion, nombre1_tercero, apellido1_tercero, total_monto_deuda_cuenta_cobrar, total_subtotal_cuenta_cobrar, total_abonado_cuenta_cobrar 
FROM tbl15_tercero WHERE (cod_tercero = '$cod_tercero')";
$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
$datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar);

$total_monto_deuda_cuenta_cobrar                   = $datos_cuenta_cobrar['total_monto_deuda_cuenta_cobrar'];
$total_subtotal_cuenta_cobrar                      = $datos_cuenta_cobrar['total_subtotal_cuenta_cobrar'];
$total_abonado_cuenta_cobrar                       = $datos_cuenta_cobrar['total_abonado_cuenta_cobrar'];
$identificacion_tercero                            = $datos_cuenta_cobrar['identificacion_tercero'];
$nombre_tipo_identificacion                        = $datos_cuenta_cobrar['nombre_tipo_identificacion'];
$nombre1_tercero                                   = $datos_cuenta_cobrar['nombre1_tercero'];
$apellido1_tercero                                 = $datos_cuenta_cobrar['apellido1_tercero'];
$nombre_cliente                                    = $nombre1_tercero.' '.$apellido1_tercero;
$cliente                                           = $nombre1_tercero.' '.$apellido1_tercero;

$monto_deuda_smtr                                  = 0;
$abonado_smtr                                      = 0;
$subtotal_smtr                                     = 0;
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
		} catch(Exception $e) { }
	}

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->setTextSize($tamano_letra_cabecera_emp_80mm, $tamano_letra_cabecera_emp_80mm);
	$printer->setEmphasis(true);
	$printer->text($cabecera_emp."\n");
	$printer->setTextSize(1, 1);
	$printer->setEmphasis(false);

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");

	$printer->text("ABONO CUENTA POR COBRAR (CLIENTE)"."\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("FECHA: ".$fecha_pago.' - '.$hora, 30));
	$printer->text(str_pad("ID ABONO: ".$cod_cuentas_cobrar_abonos, 16));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("FORMA DE PAGO: ".$nombre_tipo_forma_pago, 26));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad($nombre_tipo_identificacion." CLIENTE: ".$identificacion_tercero, 20));
	$printer->text(str_pad("NOMBRE CLIENTE: ".utf8_decode($nombre_cliente), 25));
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("ABONO", 10));
	$printer->text(str_pad("FECHA", 10));
	$printer->text(str_pad("PAGO A", 10));
	$printer->setEmphasis(false);
	$printer->text("\n");


	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad(number_format($abonado, 0, ",", "."), 10));
	$printer->text(str_pad($fecha_pago, 10));
	$printer->text(str_pad($cuenta, 10));
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad("TOTAL CREDITO", 10));
	$printer->text(str_pad(number_format($total_monto_deuda_cuenta_cobrar, 0, ",", "."), 10));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad("TOTAL ABONADO", 10));
	$printer->text(str_pad(number_format($total_abonado_cuenta_cobrar, 0, ",", "."), 10));
	$printer->text("\n");

	$printer->setTextSize(1, 1);
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("SALDO PENDIENTE", 10));
	$printer->text(str_pad(number_format($total_subtotal_cuenta_cobrar, 0, ",", "."), 10));
	$printer->setEmphasis(false);
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");
	$printer->text("Software ".$titulo_emp." Version ".$version_emp."");
	$printer->text("\n");
	$printer->text("".$desarrollador_emp." : ".$pag_desarrollador_emp."");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$estandar_a = "{A";
	$estandar_b = "{B";
	$estandar_c = "{C" . chr(01) . chr(23) . chr(23) . chr(39) . chr(29) . chr(82);
	$barra      = $estandar_b.str_pad($cod_tercero, 5, "0", STR_PAD_LEFT);
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> setBarcodeHeight(60);
	//$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
	$printer -> barcode($barra, Printer::BARCODE_CODE128);
	//$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->text("<== ".$fecha_impr.$hora_impr."-".$cod_tercero."_imposabnccrepdriv58 ==>");
	$printer->feed(3);

	echo "1";
} else { 

	$printer->setFont(Printer::FONT_B);
	$printer->setTextSize(1, 1);

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	if ($cod_estado_img_impimir_factura_global == '1') { 
		try{
		$logo = EscposImage::load("../imagenes/logo_empresa_factura_pos_blanco_negro.jpg", false);
		$printer->bitImage($logo);
		} catch(Exception $e) { }
	}

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->setTextSize($tamano_letra_cabecera_emp_80mm, $tamano_letra_cabecera_emp_80mm);
	$printer->setEmphasis(true);
	$printer->text($cabecera_emp."\n");
	$printer->setTextSize(1, 1);
	$printer->setEmphasis(false);

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");

	$printer->text("ABONOS Y CUENTAS CUENTA POR COBRAR (CLIENTE)"."\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad($nombre_tipo_identificacion." CLIENTE: ".$identificacion_tercero, 25));
	$printer->text(str_pad("NOMBRE CLIENTE: ".utf8_decode($nombre_cliente), 25));
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");

	$printer->text("FACTURAS EN CREDITO CLIENTE"."\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("CREDITO", 18));
	$printer->text(str_pad("FACTURA", 18));
	$printer->text(str_pad("FECHA REG", 18));
	$printer->text(str_pad("IDC", 10));
	$printer->setEmphasis(false);
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");

	$calcular_datos_cuenta_cobrar = "SELECT tbl15_cuentas_cobrar.cod_cuentas_cobrar, tbl15_cuentas_cobrar.cod_factura, tbl15_cuentas_cobrar.cod_tercero, 
	tbl15_cuentas_cobrar.monto_deuda, tbl15_cuentas_cobrar.abonado, tbl15_cuentas_cobrar.subtotal, tbl15_tercero.nombre1_tercero, tbl15_tercero.apellido1_tercero, 
	tbl15_cuentas_cobrar.mensaje, tbl15_cuentas_cobrar.fecha_pago, tbl15_cuentas_cobrar.fecha, tbl15_cuentas_cobrar.vendedor, tbl15_cuentas_cobrar.cod_info_factura_venta
	FROM tbl15_tercero RIGHT JOIN tbl15_cuentas_cobrar ON tbl15_tercero.cod_tercero = tbl15_cuentas_cobrar.cod_tercero 
	WHERE (tbl15_cuentas_cobrar.cod_tercero='$cod_tercero') ORDER BY tbl15_cuentas_cobrar.cod_cuentas_cobrar DESC";
	$consulta_datos_cuenta_cobrar = mysqli_query($conectar, $calcular_datos_cuenta_cobrar);
	$total_datos = mysqli_num_rows($consulta_datos_cuenta_cobrar);
	while ($datos_cuenta_cobrar = mysqli_fetch_assoc($consulta_datos_cuenta_cobrar)) {

		$cod_cuentas_cobrar             = $datos_cuenta_cobrar['cod_cuentas_cobrar'];
		$cod_info_factura_venta         = $datos_cuenta_cobrar['cod_info_factura_venta'];
		$cod_factura                    = $datos_cuenta_cobrar['cod_factura'];
		$cliente                        = $datos_cuenta_cobrar['nombre1_tercero']." ".$datos_cuenta_cobrar['apellido1_tercero'];
		$monto_deuda                    = $datos_cuenta_cobrar['monto_deuda'];
		$abonado                        = $datos_cuenta_cobrar['abonado'];
		$subtotal                       = $datos_cuenta_cobrar['subtotal'];
		$mensaje                        = $datos_cuenta_cobrar['mensaje'];
		$fecha                          = $datos_cuenta_cobrar['fecha'];
		$fecha_pago                     = $datos_cuenta_cobrar['fecha_pago'];
		$vendedor                       = $datos_cuenta_cobrar['vendedor'];
		$monto_deuda_smtr               = $monto_deuda_smtr + $monto_deuda;
		$abonado_smtr                   = $abonado_smtr + $abonado;
		$subtotal_smtr                  = $subtotal_smtr + $subtotal;

		$printer->setJustification(Printer::JUSTIFY_LEFT);
		$printer->text(str_pad(number_format($monto_deuda, 0, ",", "."), 18));
		$printer->text(str_pad($cod_factura, 18));
		$printer->text(str_pad($fecha, 18));
		$printer->text(str_pad($cod_cuentas_cobrar, 10));
		$printer->text("\n");
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");

	$printer->text("ABONOS CLIENTE"."\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("ABONO", 18));
	$printer->text(str_pad("PAGO A", 18));
	$printer->text(str_pad("FECHA REG", 18));
	$printer->text(str_pad("IDA", 10));
	$printer->setEmphasis(false);
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");

	$sql = "SELECT * FROM tbl15_cuentas_cobrar_abonos WHERE (cod_tercero = '$cod_tercero') ORDER BY cod_cuentas_cobrar_abonos DESC";
	$consulta = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));
	$total_datos = mysqli_num_rows($consulta);
	while ($datos = mysqli_fetch_assoc($consulta)) {

		$cod_cuentas_cobrar_abonos  = $datos['cod_cuentas_cobrar_abonos'];
		$abonado                    = $datos['abonado'];
		$cuenta                     = $datos['cuenta'];
		$mensaje                    = $datos['mensaje'];
		$fecha_pago                 = $datos['fecha_pago'];
		$hora                       = $datos['hora'];
		$cod_dependencia            = $datos['cod_dependencia'];

		$printer->setJustification(Printer::JUSTIFY_LEFT);
		$printer->text(str_pad(number_format($abonado, 0, ",", "."), 18));
		$printer->text(str_pad($cuenta, 18));
		$printer->text(str_pad($fecha_pago, 18));
		$printer->text(str_pad($cod_cuentas_cobrar_abonos, 10));
		$printer->text("\n");
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad("TOTAL CREDITO", 22));
	$printer->text(str_pad(number_format($total_monto_deuda_cuenta_cobrar, 0, ",", "."), 10));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad("TOTAL ABONADO", 22));
	$printer->text(str_pad(number_format($total_abonado_cuenta_cobrar, 0, ",", "."), 10));
	$printer->text("\n");

	$printer->setTextSize(2, 2);
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("SALDO PENDIENTE", 20));
	$printer->text(str_pad(number_format($total_subtotal_cuenta_cobrar, 0, ",", "."), 10));
	$printer->setEmphasis(false);
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setTextSize(1, 1);
	$printer->setEmphasis(false);

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");

	$printer->text("<== Software ".$titulo_emp." Version ".$version_emp." ==>");
	$printer->text("\n");
	$printer->text("<== ".$desarrollador_emp." : ".$pag_desarrollador_emp." ==>");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$estandar_a = "{A";
	$estandar_b = "{B";
	$estandar_c = "{C" . chr(01) . chr(23) . chr(23) . chr(39) . chr(29) . chr(82);
	$barra      = $estandar_b.str_pad($cod_tercero, 5, "0", STR_PAD_LEFT);
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> setBarcodeHeight(60);
	//$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
	$printer -> barcode($barra, Printer::BARCODE_CODE128);

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<== ".$fecha_impr.$hora_impr."-".$cod_tercero."_imposabnccrepdriv80 ==>");
	$printer->feed(2);

	echo "1";
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
/*Alimentamos el papel 3 veces*/
/* 	Cortamos el papel. Si nuestra impresora no tiene soporte para ello, no generará ningún error */
$printer->cut();
/* Para imprimir realmente, tenemos que "cerrar" la conexión con la impresora. Recuerda incluir esto al final de todos los archivos */
$printer->close();
?>