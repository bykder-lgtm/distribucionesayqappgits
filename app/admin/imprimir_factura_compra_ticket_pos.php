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
$cod_info_factura_compra                         = intval($_REQUEST['cod_info_factura_compra']);
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
$obtener_info_fact = "SELECT * FROM tbl15_info_factura_compra WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
$resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
$data_info_factura = mysqli_fetch_assoc($resultado_info_fact);

$cod_info_factura_compra                  = $data_info_factura['cod_info_factura_compra'];
$cod_factura                              = $data_info_factura['cod_factura'];
$cod_tercero                              = $data_info_factura['cod_tercero'];
//$cod_caja_virtual                         = $data_info_factura['cod_caja_virtual'];
$nombre_estado_factura                    = $data_info_factura['nombre_estado_factura'];
$nombre_tipo_cargue_factura               = $data_info_factura['nombre_tipo_cargue_factura'];
$nombre_tipo_compra                       = $data_info_factura['nombre_tipo_compra'];
$cod_empresa                              = $data_info_factura['cod_empresa'];
$nombre_empresa                           = $data_info_factura['nombre_empresa'];
$razonsocial_empresa                      = $data_info_factura['razonsocial_empresa'];
$total_muestra                            = $data_info_factura['total_muestra'];
$fecha_ymdhis                             = $data_info_factura['fecha_ymdhis'];
$cuenta                                   = $data_info_factura['cuenta'];
$cod_estado_factura                       = $data_info_factura['cod_estado_factura'];
$cod_base_caja                            = $data_info_factura['cod_base_caja'];
$descuento_ptj                            = $data_info_factura['descuento_ptj'];
$iva_ptj                                  = $data_info_factura['iva_ptj'];
$flete_ptj                                = $data_info_factura['flete_ptj'];
$subtotal                                 = $data_info_factura['subtotal'];
$valor_iva                                = $data_info_factura['valor_iva'];
$cod_cliente                              = $data_info_factura['cod_cliente'];
$vlr_cancelado                            = $data_info_factura['vlr_cancelado'];
$vlr_vuelto                               = $data_info_factura['vlr_vuelto'];
$fecha_dia                                = $data_info_factura['fecha_dia'];
$fecha_mes                                = $data_info_factura['fecha_mes'];
$fecha_anyo                               = $data_info_factura['fecha_anyo'];
$anyo                                     = $data_info_factura['anyo'];
$fecha_hora                               = $data_info_factura['fecha_hora'];
$fecha_remision                           = $data_info_factura['fecha_remision'];
$nombre_ccosto                            = $data_info_factura['nombre_ccosto'];
$garantia_meses                           = $data_info_factura['garantia_meses'];
$observacion                              = $data_info_factura['observacion'];
$cod_tipo_pago                            = $data_info_factura['cod_tipo_pago'];
$cod_administrador                        = $data_info_factura['cod_administrador'];
$nombre_tipo_producto                     = $data_info_factura['nombre_tipo_producto'];
$total_precio_costo                       = $data_info_factura['total_precio_costo'];
$total_precio_compra                      = $data_info_factura['total_precio_compra'];
$total_precio_venta                       = $data_info_factura['total_precio_venta'];
$cod_dependencia                          = $data_info_factura['cod_dependencia'];
$servicio                                 = $data_info_factura['servicio'];
$cod_tipo_forma_pago                      = $data_info_factura['cod_tipo_forma_pago'];
$nombre_tipo_forma_pago                   = $data_info_factura['nombre_tipo_forma_pago'];
$descripcion_tipo_forma_pago              = $data_info_factura['descripcion_tipo_forma_pago'];
$nombre_tipo_factura                      = $data_info_factura['nombre_tipo_factura'];
$nombre_tipo_moneda                       = $data_info_factura['nombre_tipo_moneda'];
$cod_cierre_caja                          = $data_info_factura['cod_cierre_caja'];
$fecha_creacion                           = $data_info_factura['fecha_creacion'];
$fecha_modificacion                       = $data_info_factura['fecha_modificacion'];
$nombre_maquina                           = $data_info_factura['nombre_maquina'];
$cod_tipo_cobrar                          = $data_info_factura['cod_tipo_cobrar'];
$cod_estado_vacuna                        = $data_info_factura['cod_estado_vacuna'];
$cod_resolucion_facturacion               = $data_info_factura['cod_resolucion_facturacion'];
$total_datos_data                         = $data_info_factura['total_datos_data'];
$tiempo_ejecucion                         = $data_info_factura['tiempo_ejecucion'];
$ipc_ptj                                  = $data_info_factura['ipc_ptj'];
$precio_ipc                               = $data_info_factura['precio_ipc'];
$precio_ipc_total                         = $data_info_factura['precio_ipc_total'];
$ret_ica_ptj                              = $data_info_factura['ret_ica_ptj'];
$total_ret_ica                            = $data_info_factura['total_ret_ica'];
$iva_teorico_ptj                          = $data_info_factura['iva_teorico_ptj'];
$total_iva_teorico                        = $data_info_factura['total_iva_teorico'];
$tarifa_rete_vigente_ptj                  = $data_info_factura['tarifa_rete_vigente_ptj'];
$total_tarifa_rete_vigente                = $data_info_factura['total_tarifa_rete_vigente'];
$rete_iva_asumido_ptj                     = $data_info_factura['rete_iva_asumido_ptj'];
$total_rete_iva_asumido                   = $data_info_factura['total_rete_iva_asumido'];
$iva_19                                   = $data_info_factura['iva_19'];
$iva_5                                    = $data_info_factura['iva_5'];
$nombre_rete_fuente_ptj                   = $data_info_factura['nombre_rete_fuente_ptj'];
$total_compra_imp                         = $data_info_factura['total_compra_imp'];
$total_precio_ipc                         = $data_info_factura['total_precio_ipc'];
$total_descuento                          = $data_info_factura['total_descuento'];
$total_rete_fuente                        = $data_info_factura['total_rete_fuente'];
$total_factura_compra_retefuente          = $data_info_factura['total_factura_compra_retefuente'];
$total_factura_compra                     = $data_info_factura['total_factura_compra'];
$cod_doc_soporte                          = $data_info_factura['cod_doc_soporte'];
$total_inv_precio_costo                   = $data_info_factura['total_inv_precio_costo'];
$total_inv_precio_compra                  = $data_info_factura['total_inv_precio_compra'];
$total_inv_precio_venta                   = $data_info_factura['total_inv_precio_venta'];
$total_compra_precio_costo                = $data_info_factura['total_compra_precio_costo'];
$total_compra_precio_compra               = $data_info_factura['total_compra_precio_compra'];
$total_compra_precio_venta                = $data_info_factura['total_compra_precio_venta'];
$total_inv_compra_desp_factura            = $data_info_factura['total_inv_compra_desp_factura'];
$cod_estado                               = $data_info_factura['cod_estado'];
$subtotal_total_precio_compra             = $data_info_factura['subtotal_total_precio_compra'];
$subtotal_total_precio_costo              = $data_info_factura['subtotal_total_precio_costo'];
$cod_tipo_inventario                      = $data_info_factura['cod_tipo_inventario'];
$cod_tipo_producto_consumo                = $data_info_factura['cod_tipo_producto_consumo'];
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
$obtener_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE (cod_tipo_pago = '$cod_tipo_pago')";
$resultado_tipo_pago = mysqli_query($conectar, $obtener_tipo_pago) or die(mysqli_error($conectar));
$data_tipo_pago = mysqli_fetch_assoc($resultado_tipo_pago);

$nombre_tipo_pago                     = $data_tipo_pago['nombre_tipo_pago'];
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_factura_strpad = str_pad($cod_factura, 4, "0", STR_PAD_LEFT);
$cod_info_factura_strpad   = str_pad($cod_info_factura_compra, 6, "0", STR_PAD_LEFT);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$resta                               = 1516399999;
$time_seg                            = time();
$time_date_ymd                       = strtotime(date("Y/m/d"));
$fecha                               = date("Ymd");
$hora                                = date("His");
$fecha_venta_ymd                     = date("Ymd", strtotime($fecha_anyo));
$hora_venta_his                      = date("His");
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

	$printer->text("FACTURA DE COMPRA"."\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("FECHA: ".$fecha_anyo.' - '.$fecha_hora, 30));
	$printer->text(str_pad("FACTURA DE COMPRA: ".$prefijo_resolucion_facturacion.' '.$cod_factura, 16));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("FORMA DE PAGO: ".$nombre_tipo_forma_pago, 26));
	$printer->text(str_pad("TIPO DE PAGO: ".$nombre_tipo_pago, 25));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad($nombre_tipo_identificacion." PROVEEDOR: ".$cedula_cli, 26));
	$printer->text(str_pad("NOMBRE PROVEEDOR: ".utf8_decode($nombre_cliente), 25));
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	if ($origen == '0') { $printer->text(str_pad("CANT", 5)); }
	$printer->text(str_pad("DESCRIPCION", 12));
	if ($origen == '0') { $printer->text(str_pad("P.COMPRA", 7)); }
	$printer->text(str_pad("P.TOTAL", 7));
	$printer->setEmphasis(false);
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");

	$resultado_sql = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_compra, precio_compra_producto, total_compra_producto, iva_ptj, 
	precio_ipc, nombre_tipo_unidad_medida FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
	while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

		$cod_producto                = $info_venta['cod_producto'];
		$cod_producto_barra          = $info_venta['cod_producto_barra'];
		$nombre_producto             = $info_venta['nombre_producto'];
		$und_compra                  = $info_venta['und_compra'];
		$precio_compra_producto      = $info_venta['precio_compra_producto'];
		$total_compra_producto       = $info_venta['total_compra_producto'];
		$iva_ptj                     = $info_venta['iva_ptj'];
		$precio_ipc                  = $info_venta['precio_ipc'];
		$nombre_tipo_unidad_medida   = $info_venta['nombre_tipo_unidad_medida'];

		if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
		if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }

		$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
		$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
		$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

		$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

		if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }

		$total_caracteres_producto = strlen($nombre_producto);
		//---------------------------------------------------------------------------------------------------------------------------------//
		if ($total_caracteres_producto > 17) {
			$nombre_producto1   = substr(trim($nombre_producto), 0, 17);
			$nombre_producto2   = substr(trim($nombre_producto), 17, 25);

			$printer->setJustification(Printer::JUSTIFY_LEFT);
			if ($origen == '0') { $printer->text(str_pad($und_compra, 4)); }
			$printer->text(str_pad($nombre_producto1, 17));
			if ($origen == '0') { $printer->text(str_pad(number_format($precio_compra_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT)); }
			$printer->text(str_pad(number_format($total_compra_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT));

			if ($nombre_producto2 <> "") {
				$printer->text("\n");
				if ($origen == '0') { $printer->text(str_pad("", 4)); }
				$printer->text(str_pad($nombre_producto2, 17));
				if ($origen == '0') { $printer->text(str_pad("", 4)); }
				$printer->text(str_pad("", 1,' ',STR_PAD_LEFT));
			}
			$printer->text("\n");
		} else {
			$nombre_producto1   = substr($nombre_producto, 0, 17);
			$nombre_producto2   = "";

			$printer->setJustification(Printer::JUSTIFY_LEFT);
			if ($origen == '0') { $printer->text(str_pad($und_compra, 4)); }
			$printer->text(str_pad($nombre_producto1, 17));
			if ($origen == '0') { $printer->text(str_pad(number_format($precio_compra_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT)); }
			$printer->text(str_pad(number_format($total_compra_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT));
			$printer->text("\n");
		}
	//---------------------------------------------------------------------------------------------------------------------------------//
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<==========================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad("SUBTOTAL", 18));
	$printer->text(str_pad(number_format($subtotal, 0, ",", "."), 10));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad("DESCUENTO", 18));
	$printer->text(str_pad(number_format($total_descuento, 0, ",", "."), 10));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad("IVA", 18));
	$printer->text(str_pad(number_format($valor_iva, 0, ",", "."), 10));
	$printer->text("\n");

	$printer->setTextSize(1, 1);
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("TOTAL COMPRA", 10));
	$printer->text(str_pad(number_format($total_factura_compra_retefuente, 0, ",", "."), 7));
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
	$barra      = $estandar_b.str_pad($cod_info_factura_compra, 5, "0", STR_PAD_LEFT);
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> setBarcodeHeight(60);
	//$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
	$printer -> barcode($barra, Printer::BARCODE_CODE128);
	//$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//

	$printer->text("".$fecha.$hora."-".$cod_info_factura_compra."-".$cod_info_factura_compra."_imposcomdriv58");
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

	$printer->text("FACTURA DE COMPRA"."\n");

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("FECHA: ".$fecha_anyo.' - '.$fecha_hora, 30));
	$printer->text(str_pad("FACTURA DE COMPRA: ".$prefijo_resolucion_facturacion.' '.$cod_factura, 25));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad("FORMA DE PAGO: ".$nombre_tipo_forma_pago, 30));
	$printer->text(str_pad("TIPO DE PAGO: ".$nombre_tipo_pago, 25));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(false);
	$printer->text(str_pad($nombre_tipo_identificacion." PROVEEDOR: ".$cedula_cli, 30));
	$printer->text(str_pad("NOMBRE PROVEEDOR: ".utf8_decode($nombre_cliente), 25));
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	if ($origen == '0') { $printer->text(str_pad("CANT", 6)); }
	$printer->text(str_pad("DESCRIPCION", 31));
	if ($origen == '0') { $printer->text(str_pad("P.COMPRA", 12)); }
	$printer->text(str_pad("P.TOTAL", 12));
	$printer->setEmphasis(false);
	$printer->text("\n");
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");

	$resultado_sql = "SELECT cod_producto, cod_producto_barra, nombre_producto, und_compra, precio_compra_producto, total_compra_producto, iva_ptj, 
	precio_ipc, nombre_tipo_unidad_medida FROM tbl15_factura_compra_producto WHERE (cod_info_factura_compra = '$cod_info_factura_compra')";
	$resultado_info_venta = mysqli_query($conectar, $resultado_sql) or die(mysqli_error($conectar));
	while ($info_venta = mysqli_fetch_assoc($resultado_info_venta)) {

		$cod_producto                = $info_venta['cod_producto'];
		$cod_producto_barra          = $info_venta['cod_producto_barra'];
		$nombre_producto             = $info_venta['nombre_producto'];
		$und_compra                  = $info_venta['und_compra'];
		$precio_compra_producto      = $info_venta['precio_compra_producto'];
		$total_compra_producto       = $info_venta['total_compra_producto'];
		$iva_ptj                     = $info_venta['iva_ptj'];
		$precio_ipc                  = $info_venta['precio_ipc'];
		$nombre_tipo_unidad_medida   = $info_venta['nombre_tipo_unidad_medida'];

		if ($cod_tipo_sistema_numeracion_und_compra == '2') { $und_compra = intval($und_compra); } else { $und_compra = $und_compra; }
		if ($cod_tipo_sistema_numeracion_precio_compra == '2') { $precio_compra_producto = intval($precio_compra_producto); } else { $precio_compra_producto = $precio_compra_producto; }

		$sql_tipo_iva = "SELECT nombre_tipo_iva, descripcion_tipo_iva, iva FROM tbl15_tipo_iva WHERE (iva = '$iva_ptj')";
		$resultado_tipo_iva = mysqli_query($conectar, $sql_tipo_iva) or die(mysqli_error($conectar));
		$info_tipo_iva = mysqli_fetch_assoc($resultado_tipo_iva);

		$nombre_tipo_iva            = $info_tipo_iva['nombre_tipo_iva'];

		if ($precio_ipc <> '0') { $nombre_tipo_iva = 'I'; }

		$total_caracteres_producto = strlen($nombre_producto);
		//---------------------------------------------------------------------------------------------------------------------------------//
		if ($total_caracteres_producto > 25) {
			$nombre_producto1   = substr(trim($nombre_producto), 0, 31);
			$nombre_producto2   = substr(trim($nombre_producto), 31, 30);

			$printer->setJustification(Printer::JUSTIFY_LEFT);
			if ($origen == '0') { $printer->text(str_pad($und_compra, 6)); }
			$printer->text(str_pad($nombre_producto1, 30));
			if ($origen == '0') { $printer->text(str_pad(number_format($precio_compra_producto, 0, ",", "."), 8,' ',STR_PAD_LEFT)); }
			$printer->text(str_pad(number_format($total_compra_producto, 0, ",", "."), 10,' ',STR_PAD_LEFT));

			if ($nombre_producto2 <> "") {
				$printer->text("\n");
				if ($origen == '0') { $printer->text(str_pad("", 6)); }
				$printer->text(str_pad($nombre_producto2, 30));
				if ($origen == '0') { $printer->text(str_pad("", 7)); }
				$printer->text(str_pad("", 10,' ',STR_PAD_LEFT));
			}
			$printer->text("\n");
		} else {
			$nombre_producto1   = substr($nombre_producto, 0, 30);
			$nombre_producto2   = "";

			$printer->setJustification(Printer::JUSTIFY_LEFT);
			if ($origen == '0') { $printer->text(str_pad($und_compra, 6)); }
			$printer->text(str_pad($nombre_producto1, 30));
			if ($origen == '0') { $printer->text(str_pad(number_format($precio_compra_producto, 0, ",", "."), 12,' ',STR_PAD_LEFT)); }
			$printer->text(str_pad(number_format($total_compra_producto, 0, ",", "."), 12,' ',STR_PAD_LEFT));
			$printer->text("\n");
		}
		//---------------------------------------------------------------------------------------------------------------------------------//
	}
	//---------------------------------------------------------------------------------------------------------------------------------//
	//---------------------------------------------------------------------------------------------------------------------------------//
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<<=========================================================>>");
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad("SUBTOTAL", 22));
	$printer->text(str_pad(number_format($subtotal, 0, ",", "."), 10));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad("DESCUENTO", 22));
	$printer->text(str_pad(number_format($total_descuento, 0, ",", "."), 10));
	$printer->text("\n");

	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text(str_pad("IVA", 22));
	$printer->text(str_pad(number_format($valor_iva, 0, ",", "."), 10));
	$printer->text("\n");

	$printer->setTextSize(2, 2);
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->setEmphasis(true);
	$printer->text(str_pad("TOTAL COMPRA", 20));
	$printer->text(str_pad(number_format($total_factura_compra_retefuente, 0, ",", "."), 10));
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
	$barra      = $estandar_b.str_pad($cod_info_factura_compra, 5, "0", STR_PAD_LEFT);
	$printer -> setJustification(Printer::JUSTIFY_CENTER);
	$printer -> setBarcodeHeight(60);
	//$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
	$printer -> barcode($barra, Printer::BARCODE_CODE128);

	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("<== ".$fecha.$hora."-".$cod_factura."-".$cod_info_factura_compra."_imposcomdriv80 ==>");
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