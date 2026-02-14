<?php
require_once('../conexiones/conexione.php'); 
require_once('../evitar_mensaje_error/error.php'); 
date_default_timezone_set("America/Bogota");

include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
      } else { header("Location:../index.php");
}
$cuenta_actual                       = addslashes($_SESSION['usuario']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$cod_info_factura_sticker = intval($_GET['cod_info_factura_sticker']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                 = $info_empresa_data['titulo'];
$nombre_emp                                 = $info_empresa_data['nombre'];
$eslogan_emp                                = $info_empresa_data['eslogan'];
$direccion_emp                              = $info_empresa_data['direccion'];
$ciudad_emp                                 = $info_empresa_data['ciudad'];
$pais_emp                                   = $info_empresa_data['pais'];
$correo_emp                                 = $info_empresa_data['correo'];
$img_cabecera_emp                           = $info_empresa_data['img_cabecera'];
$telefono_emp                               = $info_empresa_data['telefono'];
$info_legal_emp                             = $info_empresa_data['info_legal'];
$logotipo_emp                               = $info_empresa_data['logotipo'];
$propietario_nombres_apellidos_emp          = $info_empresa_data['propietario_nombres_apellidos'];
$propietario_nit_emp                        = $info_empresa_data['propietario_nit'];
$nit_empresa_emp                            = $info_empresa_data['nit_empresa'];
$cabecera_emp                               = $info_empresa_data['cabecera'];
$icono_emp                                  = $info_empresa_data['icono'];
$desarrollador_emp                          = $info_empresa_data['desarrollador'];
$pag_desarrollador_emp                      = $info_empresa_data['pag_desarrollador'];
$anyo_emp                                   = $info_empresa_data['anyo'];
$url_pag                                    = $info_empresa_data['url_pag'];
$nombre_font                                = $info_empresa_data['nombre_font'];
$res_emp                                    = $info_empresa_data['res'];
$res1_emp                                   = $info_empresa_data['res1'];
$res2_emp                                   = $info_empresa_data['res2'];
$departamento_emp                           = $info_empresa_data['departamento'];
$localidad_emp                              = $info_empresa_data['localidad'];
$reg_medico_emp                             = $info_empresa_data['reg_medico'];
$regimen_emp                                = $info_empresa_data['regimen'];
$version_emp                                = $info_empresa_data['version'];
$propietario_url_firma_emp                  = $info_empresa_data['propietario_url_firma'];
$fecha_time_emp                             = $info_empresa_data['fecha_time'];
$licencia_emp                               = $info_empresa_data['licencia'];
$tamano_font_emp                            = $info_empresa_data['tamano_font'];
$info_histclinic_emp                        = $info_empresa_data['info_histclinic'];
$info_aptlaboral_emp                        = $info_empresa_data['info_aptlaboral'];
$dia_ini_facturacion_emp                    = $info_empresa_data['dia_ini_facturacion'];
$dia_fin_facturacion_emp                    = $info_empresa_data['dia_fin_facturacion'];
$smtp_correo_host_emp                       = $info_empresa_data['smtp_correo_host'];
$smtp_correo_auth_emp                       = $info_empresa_data['smtp_correo_auth'];
$smtp_correo_username_emp                   = $info_empresa_data['smtp_correo_username'];
$smtp_correo_password_emp                   = $info_empresa_data['smtp_correo_password'];
$smtp_correo_secure_emp                     = $info_empresa_data['smtp_correo_secure'];
$smtp_correo_port_emp                       = $info_empresa_data['smtp_correo_port'];
$nombre_concepto_multi_virtual              = $info_empresa_data['nombre_concepto_multi_virtual'];
$nombre_tipo_precio_venta                   = $info_empresa_data['nombre_tipo_precio_venta'];
$numero_precio                              = $info_empresa_data['numero_precio'];
$nombre_tipo_empresa                        = $info_empresa_data['nombre_tipo_empresa'];
$dias_vencimiento_producto_alerta           = $info_empresa_data['dias_vencimiento_producto_alerta'];
$cod_estado_fecha_vencimiento_global               = $info_empresa_data['cod_estado_fecha_vencimiento_global'];
$cod_estado_ptj_comision_global                    = $info_empresa_data['cod_estado_ptj_comision_global'];
$cod_estado_impoconsumo_global                     = $info_empresa_data['cod_estado_impoconsumo_global'];
$cod_estado_dto1_global                            = $info_empresa_data['cod_estado_dto1_global'];
$cod_estado_dto2_global                            = $info_empresa_data['cod_estado_dto2_global'];
$cod_estado_preventa_global                        = $info_empresa_data['cod_estado_preventa_global'];
$cod_estado_propina_global                         = $info_empresa_data['cod_estado_propina_global'];
$cod_estado_img_impimir_factura_global             = $info_empresa_data['cod_estado_img_impimir_factura_global'];
$url_encuesta_experiencia_compra            = $info_empresa_data['url_encuesta_experiencia_compra'];
$cod_estado_encuesta_experiencia_compra_global     = $info_empresa_data['cod_estado_encuesta_experiencia_compra_global'];
$cod_estado_codif_precio_compra_global             = $info_empresa_data['cod_estado_codif_precio_compra_global'];
$cod_estado_codif_precio_venta_global              = $info_empresa_data['cod_estado_codif_precio_venta_global'];
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
//$connector = new WindowsPrintConnector($nombre_impresora1_emp);
$connector = new WindowsPrintConnector("smb://".$nombre_maquina."/".$nombre_impresora);
//$printer = new Printer($connector, $profile);
$printer = new Printer($connector);
#Mando un numero de respuesta para saber que se conecto correctamente.
//echo $nombre_impresora1_emp;
//echo "<br>";
//echo "smb://".$nombre_maquina.'/'.$nombre_impresora;
# Vamos a alinear al centro lo próximo que imprimamos
$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setFont(Printer::FONT_A);
$printer->setTextSize(1, 1);
/* 	Intentaremos cargar e imprimir 	el logo */
//try{
//$logo = EscposImage::load("../imagenes/logo_empresa_factura_pos.png", false);
//$printer->bitImage($logo);
//}catch(Exception $e){ }
$printer->text("\n");
//---------------------------------------------------------------------------------------------------------------------------------//
$estandar_a = "{A";
$estandar_b = "{B";
$estandar_c = "{C" . chr(01) . chr(23) . chr(23) . chr(39) . chr(29) . chr(82);

$incremento                 = 0;
$arrayCodigos               = array();
$cod_letra_numero_compra    = 0;
$cod_letra_numero_venta     = 0;
$nombre_letra_numero_compra = 0;
$nombre_letra_numero_venta  = 0;

$mostrar_datos_sql = "SELECT und_venta, nombre_producto, cod_producto_barra, precio_compra_producto, precio_venta_producto, cod_tercero
FROM tbl15_sticker_producto WHERE cod_info_factura_sticker = '$cod_info_factura_sticker' ORDER BY cod_sticker_producto ASC";
$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
while ($datos = mysqli_fetch_assoc($consulta)) {

	$und_venta                  = $datos['und_venta'];
	$nombre_producto            = substr($datos['nombre_producto'], 0, 80);
	$cod_producto_barra         = $datos['cod_producto_barra'];
	$precio_compra_producto     = intval($datos['precio_compra_producto']);
	$precio_venta_producto      = intval($datos['precio_venta_producto']);
	//$fecha_ult_compra           = $datos['fecha_ult_compra'];
	$arrayCodigos[]             = (string)$cod_producto_barra; 
	$cantidad_contadores        = substr_count($precio_compra_producto, '0');
	$contar_palabra             = str_word_count($precio_compra_producto, 1, '0');
	$cantidad_separaciones      = count($contar_palabra);

	$cantidad_digitos_compra    = strlen($precio_compra_producto);
	$matriz_digitos_compra      = str_split($precio_compra_producto);
	$codif_letra_precio_compra  = "";

	$cantidad_digitos_venta     = strlen($precio_venta_producto);
	$matriz_digitos_venta       = str_split($precio_venta_producto);
	$codif_letra_precio_venta   = "";

	$total_caracteres           = strlen($nombre_producto);
	$contar_ceros_compra        = 0;
	$contar_ceros_venta         = 0;

	if ($total_caracteres > 28) {
		$nombre_producto1           = substr($nombre_producto, 0, 28);
		$nombre_producto2           = substr($nombre_producto, 28, 27);
	} else {
		$nombre_producto1           = substr($nombre_producto, 0, 28);
		$nombre_producto2           = ".";
	}


	for ($i=0; $i < $cantidad_digitos_compra; $i++) { 
		$cod_letra_numero_compra    = $matriz_digitos_compra[$i];

		$sql_letra_numero_compra = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_compra '";
		$consulta_letra_numero_compra = mysqli_query($conectar, $sql_letra_numero_compra) or die(mysqli_error($conectar));
		$datos_letra_numero_compra = mysqli_fetch_assoc($consulta_letra_numero_compra);

		if ($cod_letra_numero_compra == '0') { $nombre_letra_numero_compra = $contar_ceros_compra++; } else { $nombre_letra_numero_compra = $datos_letra_numero_compra['nombre_letra_numero']; }
		$codif_letra_precio_compra   = $codif_letra_precio_compra.$nombre_letra_numero_compra;
	}

	for ($i=0; $i < $cantidad_digitos_venta; $i++) { 

		$cod_letra_numero_venta     = $matriz_digitos_venta[$i];

		$sql_letra_numero = "SELECT cod_letra_numero, nombre_letra_numero FROM tbl15_letra_numero WHERE cod_letra_numero = '$cod_letra_numero_venta '";
		$consulta_letra_numero = mysqli_query($conectar, $sql_letra_numero) or die(mysqli_error($conectar));
		$datos_letra_numero = mysqli_fetch_assoc($consulta_letra_numero);

		if ($cod_letra_numero_venta == '0') { $nombre_letra_numero_venta = $contar_ceros_venta++; } else { $nombre_letra_numero_venta = $datos_letra_numero['nombre_letra_numero']; }
		$codif_letra_precio_venta   = $codif_letra_precio_venta.$nombre_letra_numero_venta;
	}

	$sql_producto = "SELECT cod_tercero, fecha_ult_compra FROM tbl15_producto WHERE cod_producto_barra = '$cod_producto_barra'";
	$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
	$datos_producto = mysqli_fetch_assoc($consulta_producto);

	$cod_tercero                = $datos_producto['cod_tercero'];
	$fecha_ult_compra           = $datos_producto['fecha_ult_compra'];
	$fecha_compra               = date("mY", strtotime($fecha_ult_compra));

	$incremento++;

	if ($cod_estado_codif_precio_compra_global == '1') { $codif_letra_precio_compra = $codif_letra_precio_compra; } else { $codif_letra_precio_compra = ""; }
	if ($cod_estado_codif_precio_venta_global == '1') { $codif_letra_precio_venta = $codif_letra_precio_venta; } else { $codif_letra_precio_venta = ""; }

	for ($i=0; $i < $und_venta; $i++) {

		$printer->setJustification(Printer::JUSTIFY_CENTER);
		$printer->setEmphasis(true);
		$printer->text($nombre_producto);
		$printer->setEmphasis(false);
		$printer->text("\n");

		$cod_barra = $estandar_b.$cod_producto_barra;
		$printer -> setJustification(Printer::JUSTIFY_CENTER);
		$printer -> setBarcodeHeight(80);
		$printer -> barcode($cod_barra, Printer::BARCODE_CODE128);
		//$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
		//$printer->text("\n");

		$printer->setJustification(Printer::JUSTIFY_CENTER);
		$printer->setEmphasis(true);
		$printer->text('Editaxe '.$cod_producto_barra.' '.$codif_letra_precio_compra.' '.$codif_letra_precio_venta.' '.$fecha_compra.' '.$cod_tercero.' Pos');
		$printer->setEmphasis(false);

		/*Alimentamos el papel 3 veces*/
		$printer->feed(1);
		/* 	Cortamos el papel. Si nuestra impresora no tiene soporte para ello, no generará ningún error */
		$printer->cut();
	}
}
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
/* 	Por medio de la impresora mandamos un pulso. Esto es útil cuando la tenemos conectada por ejemplo a un cajón */
//$printer->pulse();
/* Para imprimir realmente, tenemos que "cerrar" la conexión con la impresora. Recuerda incluir esto al final de todos los archivos */
$printer->close();
?>