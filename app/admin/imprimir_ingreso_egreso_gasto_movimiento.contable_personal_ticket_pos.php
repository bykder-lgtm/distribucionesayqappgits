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
$cod_movimiento_contable_cuenta_personal_concepto                         = intval($_REQUEST['cod_movimiento_contable_cuenta_personal_concepto']);
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
$cod_estado_img_impimir_factura_global                             = $info_empresa_data['cod_estado_img_impimir_factura_global'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (strlen($cabecera_emp) > 25) { $tamano_letra_cabecera_emp_80mm = 1; $tamano_letra_cabecera_emp_58mm = 1; } else { $tamano_letra_cabecera_emp_80mm = 2; $tamano_letra_cabecera_emp_58mm = 2; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_concepto_movimiento_caja = "SELECT * FROM tbl15_movimiento_contable_cuenta_personal_concepto WHERE (cod_movimiento_contable_cuenta_personal_concepto = '$cod_movimiento_contable_cuenta_personal_concepto')";
$resultado_concepto_movimiento_caja = mysqli_query($conectar, $sql_concepto_movimiento_caja) or die(mysqli_error($conectar));
$info_concepto_movimiento_caja = mysqli_fetch_assoc($resultado_concepto_movimiento_caja);

$codigo_puc                                             = $info_concepto_movimiento_caja['codigo_puc'];
$nombre_puc                                             = $info_concepto_movimiento_caja['nombre_puc'];
$simbolo_tipo_operacion                                 = $info_concepto_movimiento_caja['simbolo_tipo_operacion'];
$costo_movimiento_contable                              = $info_concepto_movimiento_caja['costo_movimiento_contable'];
$comentario                                             = $info_concepto_movimiento_caja['comentario'];
$cod_tercero                                            = $info_concepto_movimiento_caja['cod_tercero'];
$fecha_anyo                                             = $info_concepto_movimiento_caja['fecha_anyo'];
$fecha_seg                                              = $info_concepto_movimiento_caja['fecha_seg'];
$cod_tipo_forma_pago                                    = $info_concepto_movimiento_caja['cod_tipo_forma_pago'];
$cliente                                                = "";
$cod_factura                                            = "0";
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$fecha_impr                          = date("Ymd");
$hora_impr                           = date("His");
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
$cod_estado_cuenta_cobrar            = $matriz_cliente['cod_estado_cuenta_cobrar'];
$total_monto_deuda_cuenta_cobrar     = $matriz_cliente['total_monto_deuda_cuenta_cobrar'];
$total_abonado_cuenta_cobrar         = $matriz_cliente['total_abonado_cuenta_cobrar'];
$total_subtotal_cuenta_cobrar        = $matriz_cliente['total_subtotal_cuenta_cobrar'];
$fecha_modificacion_cuenta_cobrar    = $matriz_cliente['fecha_modificacion_cuenta_cobrar'];

if (($digito_tercero == '0') || ($digito_tercero == '')) { $digito_tercero = ''; } else { $digito_tercero = '-'.$matriz_cliente['digito_tercero']; }
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_tipo_forma_pago = "SELECT * FROM tbl15_tipo_forma_pago WHERE (cod_tipo_forma_pago = '$cod_tipo_forma_pago')";
$resultado_tipo_forma_pago = mysqli_query($conectar, $sql_tipo_forma_pago) or die(mysqli_error($conectar));
$info_tipo_forma_pago = mysqli_fetch_assoc($resultado_tipo_forma_pago);

$nombre_tipo_forma_pago                         = $info_tipo_forma_pago['nombre_tipo_forma_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$resta                               = 1516399999;
$time_seg                            = time();
$time_date_ymd                       = strtotime(date("Y/m/d"));
$fecha                               = date("Ymd");
$fecha_venta_ymd                     = date("Ymd", strtotime($fecha_anyo));
$hora_venta_his                      = date("His");
$hora                                = date("H.i:s", $fecha_seg);
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
	$printer->text("GASTO - EGRESO"."\n");
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("FECHA: ".$fecha_anyo.' - '.$hora, 30));
	$printer->text(str_pad("ID: ".$cod_movimiento_contable_cuenta_personal_concepto, 16));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("FORMA DE PAGO: ".$nombre_tipo_forma_pago, 26));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad($nombre_tipo_identificacion." TERCERO: ".$cedula_cli, 26));
	$printer->text(str_pad("NOMBRE TERCERO: ".utf8_decode($nombre_cliente), 25));
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("CONCEPTO", 20));
	$printer->text(str_pad("VALOR", 10));
	$printer->setEmphasis(false);
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("------------------------------");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad($nombre_puc, 20));
	$printer->text(str_pad(number_format($costo_movimiento_contable, 0, ",", "."), 10));
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
	$barra      = $estandar_b.str_pad($cod_movimiento_contable_cuenta_personal_concepto, 5, "0", STR_PAD_LEFT);
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> setBarcodeHeight(60);
	//$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
	$printer -> barcode($barra, Printer::BARCODE_CODE128);
	//$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->text("<== ".$fecha_impr.$hora_impr."-".$cod_factura."-".$cod_movimiento_contable_cuenta_personal_concepto."_imposegresgastmovcontperdriv58 ==>");
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
	$printer->text("GASTO - EGRESO"."\n");
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("FECHA: ".$fecha_anyo.' - '.$hora, 30));
	$printer->text(str_pad("ID: ".$cod_movimiento_contable_cuenta_personal_concepto, 25));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("FORMA DE PAGO: ".$nombre_tipo_forma_pago, 30));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad($nombre_tipo_identificacion." TERCERO: ".$cedula_cli, 30));
	$printer->text(str_pad("NOMBRE TERCERO: ".utf8_decode($nombre_cliente), 25));
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("CONCEPTO", 40));
	$printer->text(str_pad("VALOR", 20));
	$printer->setEmphasis(false);
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("-----------------------------------------------------------");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad($nombre_puc, 40));
	$printer->text(str_pad(number_format($costo_movimiento_contable, 0, ",", "."), 20));
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
	$barra      = $estandar_b.str_pad($cod_movimiento_contable_cuenta_personal_concepto, 5, "0", STR_PAD_LEFT);
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> setBarcodeHeight(60);
	//$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
	$printer -> barcode($barra, Printer::BARCODE_CODE128);

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<== ".$fecha_impr.$hora_impr."-".$cod_factura."-".$cod_movimiento_contable_cuenta_personal_concepto."_imposegresgastmovcontperdriv80 ==>");
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