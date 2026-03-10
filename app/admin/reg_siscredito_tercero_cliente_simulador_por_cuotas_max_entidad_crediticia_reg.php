<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_intern.php");

$cuenta_actual                                                  = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                                               = $_SESSION['usuario'];
$cod_administrador                                              = ($_SESSION['cod_administrador']);
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if (isset($_POST['nombre_tipo_origen_simulacion'])) {

	if (isset($_POST['nombre_tipo_origen_simulacion'])) { $nombre_tipo_origen_simulacion = addslashes($_POST['nombre_tipo_origen_simulacion']); } else { $nombre_tipo_origen_simulacion = ''; }
	if (isset($_POST['nombre_tipo_identificacion'])) { $nombre_tipo_identificacion = addslashes($_POST['nombre_tipo_identificacion']); } else { $nombre_tipo_identificacion = 'CC'; }
	if (isset($_POST['identificacion_tercero'])) { $identificacion_tercero = addslashes($_POST['identificacion_tercero']); } else { $identificacion_tercero = ''; }
	if (isset($_POST['nombre1_tercero'])) { $nombre1_tercero = addslashes(trim($_POST['nombre1_tercero'])); } else { $nombre1_tercero = ''; }
	if (isset($_POST['nombre2_tercero'])) { $nombre2_tercero = addslashes(trim($_POST['nombre2_tercero'])); } else { $nombre2_tercero = ''; }
	if (isset($_POST['apellido1_tercero'])) { $apellido1_tercero = addslashes(trim($_POST['apellido1_tercero'])); } else { $apellido1_tercero = ''; }
	if (isset($_POST['apellido2_tercero'])) { $apellido2_tercero = addslashes(trim($_POST['apellido2_tercero'])); } else { $apellido2_tercero = ''; }
	if (isset($_POST['fecha_nac_tercero'])) { $fecha_nac_tercero = addslashes($_POST['fecha_nac_tercero']); } else { $fecha_nac_tercero = ''; }
	if (isset($_POST['fecha_expedicion_tercero'])) { $fecha_expedicion_tercero = addslashes($_POST['fecha_expedicion_tercero']); } else { $fecha_expedicion_tercero = ''; }
	if (isset($_POST['telefono1_tercero'])) { $telefono1_tercero = addslashes($_POST['telefono1_tercero']); } else { $telefono1_tercero = ''; }
	if (isset($_POST['correo_tercero'])) { $correo_tercero = addslashes($_POST['correo_tercero']); } else { $correo_tercero = ''; }
	if (isset($_POST['direccion_tercero'])) { $direccion_tercero = addslashes($_POST['direccion_tercero']); } else { $direccion_tercero = ''; }
	if (isset($_POST['nombre_estado_civil'])) { $nombre_estado_civil = addslashes($_POST['nombre_estado_civil']); } else { $nombre_estado_civil = ''; }
	if (isset($_POST['fecha_pago'])) { $fecha_pago = addslashes($_POST['fecha_pago']); } else { $fecha_pago = date("Y-m-d"); }
	if (isset($_POST['cod_categoria'])) { $cod_categoria = addslashes($_POST['cod_categoria']); } else { $cod_categoria = ''; }
	//---------------------------------------------------------------------------------------------------------------------------------//
    $cod_producto_codifcryp                                         = ($_POST['cod_producto_codifcryp']);
    $cod_producto_codif                                             = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
    $cod_producto                                                   = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));
    $valor_credito                                                  = intval($_POST['valor_credito']);
    $cod_entidad_crediticia                                         = intval($_POST['cod_entidad_crediticia']);
    $cod_tipo_cobro                                                 = intval($_POST['cod_tipo_cobro']);
    $cod_meses_credito                                              = intval($_POST['cod_meses_credito']);
    $nombre_tipo_tercero                                            = addslashes($_POST['nombre_tipo_tercero']);
    $nombre_tipo_tercero_modulo_creacion                            = addslashes($_POST['nombre_tipo_tercero_modulo_creacion']);
    $cod_seguridad                                                  = intval($_POST['cod_seguridad']);
	//---------------------------------------------------------------------------------------------------------------------------------//
	$fecha_creacion                                                 = date("Y-m-d H:i:s");
    $direccion_contacto1                                            = $_SERVER["REMOTE_ADDR"];
	$tel_contacto1                                                  = $cuenta_actual;
	$cod_estado_cliente                                             = 1;
	$fecha_anyo                                                     = date("Y-m-d", strtotime($fecha_creacion));
	$fecha_seg       	                                            = time();
	$fecha_mes	                                                    = date("Y-m", strtotime($fecha_creacion));
	$anyo		                                                    = date("Y", strtotime($fecha_creacion));
	$fecha	                                                        = $fecha_creacion;
	$fecha_invert	                                                = $fecha_creacion;
	$hora	                                                        = date("H:i:s");
	$cuenta                                                         = $cuenta_actual;
	$vendedor                                                       = $cuenta_actual;
	$cod_dependencia                                                = 1;
	$nombre_maquina                                                 = gethostname();
	$fecha_ymd                                                      = $fecha_creacion;
	$fecha_anyo_seg                                                 = strtotime($fecha_anyo);
	$fecha_dia                                                      = date("Y-m-d", $fecha_anyo_seg);
	$fecha_hora_venta_producto                                      = date("H:i:s");
	$nombre_tipo_moneda                                             = "COP";
	$cod_tipo_pago                                                  = 2;
	$cod_tipo_forma_pago                                            = 22;
	$cod_tipo_nota_observacion                                      = 20;
	$codigo_estado_revision                                         = 0;
	$fecha_ymd_venta_producto                                       = date("Y-m-d");
	$fecha_mes_venta_producto                                       = date("Y-m");
	$fecha_anyo_venta_producto                                      = date("Y");
	$fecha_seg_venta_producto                                       = time();
	$cod_estado_factura                                             = '0';
	$fecha_hora                                                     = date("H:i:s");
	$fecha_ymdhis                                                   = date("Y-m-d H:i:s");
	$nombre_estado_factura                                          = 'ABIERTA';
	$cod_caja_virtual                                               = 1;
	$cod_base_caja                                                  = 1;
	$cod_resolucion_facturacion                                     = 1;
	//---------------------------------------------------------------------------------------------------------------------------------//
    if ($cod_seguridad = '23') { //ALIADO ESTRATEGICO
        $nombre_compo_interes_ptj                                   = 'aliado_estrategico_interes_ptj';
        $nombre_compo_aval_ptj                                      = 'aliado_estrategico_aval_ptj';
    } elseif ($cod_seguridad = '22') { //ASESOR
        $nombre_compo_interes_ptj                                   = 'asesor_interes_ptj';
        $nombre_compo_aval_ptj                                      = 'asesor_aval_ptj';
    } else { //ALIADO ESTRATEGICO
        $nombre_compo_interes_ptj                                   = 'aliado_estrategico_interes_ptj';
        $nombre_compo_aval_ptj                                      = 'aliado_estrategico_aval_ptj';
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_resolucion_facturacion = "SELECT nombre_tipo_resolucion_facturacion FROM tbl15_resolucion_facturacion WHERE cod_resolucion_facturacion = '$cod_resolucion_facturacion'";
	$resultado_resolucion_facturacion = mysqli_query($conectar, $obtener_resolucion_facturacion) or die(mysqli_error($conectar));
	$info_resolucion_facturacion = mysqli_fetch_assoc($resultado_resolucion_facturacion);

	$nombre_tipo_factura                                            = $info_resolucion_facturacion['nombre_tipo_resolucion_facturacion'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_autoincremento_info_factura_venta = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_info_factura_venta'";
	$exec_autoincremento_info_factura_venta = mysqli_query($conectar, $sql_autoincremento_info_factura_venta) or die(mysqli_error($conectar));
	$datos_autoincremento_info_factura_venta = mysqli_fetch_assoc($exec_autoincremento_info_factura_venta);

	$cod_info_factura_venta                                         = $datos_autoincremento_info_factura_venta['AUTO_INCREMENT'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_administrador = "SELECT cod_lider, cod_coordinador, cod_asesor, cod_aliado_estrategico, cod_tienda FROM tbl15_administrador WHERE cod_administrador = '$cod_administrador'";
	$resultado_administrador = mysqli_query($conectar, $obtener_administrador) or die(mysqli_error($conectar));
	$info_administrador = mysqli_fetch_assoc($resultado_administrador);

	$cod_lider                                                      = $info_administrador['cod_lider'];
	$cod_coordinador                                                = $info_administrador['cod_coordinador'];
	$cod_asesor                                                     = $info_administrador['cod_asesor'];
	$cod_aliado_estrategico                                         = $cod_administrador;
	$cod_tienda                                                     = $info_administrador['cod_tienda'];

	$cod_administrador_lider                                        = $cod_lider;
	$cod_administrador_coordinador                                  = $cod_coordinador;
	$cod_administrador_asesor                                       = $cod_asesor;
	$cod_administrador_aliado_estrategico                           = $cod_aliado_estrategico;
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_lider = "SELECT comision_ptj FROM tbl15_administrador WHERE cod_administrador = '$cod_lider'";
	$resultado_lider = mysqli_query($conectar, $obtener_lider) or die(mysqli_error($conectar));
	$info_lider = mysqli_fetch_assoc($resultado_lider);

	$lider_comision_ptj                                             = $info_lider['comision_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_coordinador = "SELECT comision_ptj FROM tbl15_administrador WHERE cod_administrador = '$cod_coordinador'";
	$resultado_coordinador = mysqli_query($conectar, $obtener_coordinador) or die(mysqli_error($conectar));
	$info_coordinador = mysqli_fetch_assoc($resultado_coordinador);

	$coordinador_comision_ptj                                       = $info_coordinador['comision_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$obtener_asesor = "SELECT comision_ptj FROM tbl15_administrador WHERE cod_administrador = '$cod_asesor'";
	$resultado_asesor = mysqli_query($conectar, $obtener_asesor) or die(mysqli_error($conectar));
	$info_asesor = mysqli_fetch_assoc($resultado_asesor);

	$asesor_comision_ptj                                            = $info_asesor['comision_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
    $sql_tipo_cobro = "SELECT cod_tipo_cobro, nombre_tipo_cobro FROM tbl15_tipo_cobro WHERE (cod_tipo_cobro = '$cod_tipo_cobro')";
    $consulta_tipo_cobro = mysqli_query($conectar, $sql_tipo_cobro) or die(mysqli_error($conectar));
    $datos_tipo_cobro = mysqli_fetch_assoc($consulta_tipo_cobro);

    $nombre_tipo_cobro                                              = $datos_tipo_cobro['nombre_tipo_cobro'];
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_dato_tercero = "SELECT * FROM tbl15_tercero WHERE identificacion_tercero = '".($identificacion_tercero)."'";
	$consultar_dato_tercero = mysqli_query($conectar, $sql_dato_tercero) or die(mysqli_error($conectar));
	$info_dato_tercero = mysqli_fetch_assoc($consultar_dato_tercero);
	$existe_dato_tercero = mysqli_num_rows(@$consultar_dato_tercero);

	$cod_tercero                                                    = intval($info_dato_tercero['cod_tercero']);
   	$cod_tercero_codif                                              = DAXCODIFCRYPTOR::encodifdax($cod_tercero);
	$cod_tercero_codifcryp                                          = DAXCODIFCRYPTOR::encriptardax($cod_tercero_codif);
	//---------------------------------------------------------------------------------------------------------------------------------//
    $sql_meses_credito = "SELECT * FROM tbl15_meses_credito WHERE (cod_meses_credito = '$cod_meses_credito')";
    $consulta_meses_credito = mysqli_query($conectar, $sql_meses_credito) or die(mysqli_error($conectar));
    $datos_meses_credito = mysqli_fetch_assoc($consulta_meses_credito);

    $codigo_meses_credito                                           = $datos_meses_credito['codigo_meses_credito'];
    $nombre_meses_credito                                           = $datos_meses_credito['nombre_meses_credito'];
    //---------------------------------------------------------------------------------------------------------------------------------//
    $sql_entidad_crediticia_predeterminada_interes_defect = "SELECT entidad_crediticia_interes_ptj FROM tbl15_entidad_crediticia WHERE cod_estado_entidad_predeterminada_interes_defect = '1'";
    $consulta_entidad_crediticia_predeterminada_interes_defect = mysqli_query($conectar, $sql_entidad_crediticia_predeterminada_interes_defect) or die(mysqli_error($conectar));
    $matriz_entidad_crediticia_predeterminada_interes_defect = mysqli_fetch_assoc($consulta_entidad_crediticia_predeterminada_interes_defect);

    $entidad_crediticia_interes_ptj                                 = $matriz_entidad_crediticia_predeterminada_interes_defect['entidad_crediticia_interes_ptj'];
	//---------------------------------------------------------------------------------------------------------------------------------//
    $sql_entidad_crediticia = "SELECT * FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $cod_entidad_crediticia                                         = $datos_entidad_crediticia['cod_entidad_crediticia'];
    $nombre_entidad_crediticia                                      = $datos_entidad_crediticia['nombre_entidad_crediticia'];
    $meses_max_entidad_crediticia                                   = $datos_entidad_crediticia['meses_max_entidad_crediticia'];
    $quicenal_max_entidad_crediticia                                = $datos_entidad_crediticia['quicenal_max_entidad_crediticia'];
	//---------------------------------------------------------------------------------------------------------------------------------//
    if (($meses_max_entidad_crediticia <> '0' && $quicenal_max_entidad_crediticia == '0')) { //CUANDO SEA POR MES Y NO QUINCENAL
        $nombre_tipo_cobro = 'MENSUAL';
        $numero_tipo_cobro = 1;
        $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
        $condicional_mostrar_numero_maximo_cuotas = "AND (cod_meses_credito <= '$meses_max_entidad_crediticia')";
        $condicional_cod_meses_credito = $numero_cuotas;
        if ($numero_cuotas > $meses_max_entidad_crediticia) {
            $numero_cuotas = $meses_max_entidad_crediticia  * $numero_tipo_cobro;
        } else {
            $numero_cuotas = $numero_cuotas;
        }
    } elseif (($meses_max_entidad_crediticia == '0' && $quicenal_max_entidad_crediticia <> '0')) { //CUANDO NO SEA POR MES Y SI QUINCENAL
        $nombre_tipo_cobro = 'QUINCENAL';
        $numero_tipo_cobro = 2;
        $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
        $condicional_mostrar_numero_maximo_cuotas = "AND (cod_meses_credito <= '$quicenal_max_entidad_crediticia')";
        $condicional_cod_meses_credito = $numero_cuotas;
        if ($numero_cuotas > $quicenal_max_entidad_crediticia) {
            $numero_cuotas = $quicenal_max_entidad_crediticia;
        } else {
            $numero_cuotas = $numero_cuotas;
        }
    } else { //CUANDO SEA POR MES Y QUINCENAL O NINGUNO DE LOS DOS (TIENE PRIORIDAD EL MES)
        $nombre_tipo_cobro = 'MENSUAL';
        $numero_tipo_cobro = 1;
        $numero_cuotas = $numero_tipo_cobro * $codigo_meses_credito;
        $condicional_mostrar_numero_maximo_cuotas = "AND (cod_meses_credito <= '$meses_max_entidad_crediticia')";
        $condicional_cod_meses_credito = $numero_cuotas;
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
    if ($nombre_tipo_origen_simulacion == 'TIENDA_VIRTUAL') {
		$sql_producto = "SELECT * FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
		$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
		$existe_producto = mysqli_num_rows($consulta_producto);
		$datos_producto = mysqli_fetch_assoc($consulta_producto);

		$cod_producto                                                   = $datos_producto['cod_producto'];
		$cod_producto_barra                                             = $datos_producto['cod_producto_barra'];
		$nombre_producto                                                = $datos_producto['nombre_producto'];
		$und_producto                                                   = $datos_producto['und_producto'];
		$precio_compra_producto                                         = $datos_producto['precio_compra_producto'];
		$precio_costo_producto                                          = $datos_producto['precio_costo_producto'];
		$precio_venta_producto                                          = $datos_producto['precio_venta_producto'];
		$nombre_tipo_unidad_medida                                      = $datos_producto['nombre_tipo_unidad_medida'];
		$iva_ptj                                                        = $datos_producto['iva_ptj'];
		$cod_marca                                                      = $datos_producto['cod_marca'];
		$cod_dependencia                                                = $datos_producto['cod_dependencia'];
		$nombre_tipo_precio_venta                                       = $datos_producto['nombre_tipo_precio_venta'];
    } elseif ($nombre_tipo_origen_simulacion == 'SIMULACION_VALOR_LIBRE') {
		$cod_producto                                                   = '';
		$cod_producto_barra                                             = '';
        $nombre_producto                                                = addslashes($_REQUEST['nombre_producto']);
		$und_producto                                                   = 1;
		$precio_compra_producto                                         = 0;
		$precio_costo_producto                                          = 0;
        $precio_venta_producto                                          = intval($_REQUEST['precio_venta_producto']);
		$nombre_tipo_unidad_medida                                      = 'UND';
		$iva_ptj                                                        = 0;
		$cod_marca                                                      = 0;
		$cod_dependencia                                                = 0;
		$nombre_tipo_precio_venta                                       = 'PV1';
    } else {
		$cod_producto                                                   = '';
		$cod_producto_barra                                             = '';
        $nombre_producto                                                = '';
		$und_producto                                                   = 0;
		$precio_compra_producto                                         = 0;
		$precio_costo_producto                                          = 0;
        $precio_venta_producto                                          = 0;
		$nombre_tipo_unidad_medida                                      = 'UND';
		$iva_ptj                                                        = 0;
		$cod_marca                                                      = 0;
		$cod_dependencia                                                = 0;
		$nombre_tipo_precio_venta                                       = 'PV1';
    }
	//$cod_tienda                                                     = $datos_producto['cod_tienda'];
	//---------------------------------------------------------------------------------------------------------------------------------//
    $interes_ptj                                                    = $datos_entidad_crediticia[$nombre_compo_interes_ptj];
    $aval_ptj                                                       = $datos_entidad_crediticia[$nombre_compo_aval_ptj];
    $total_pagar                                                    = round($precio_venta_producto / ((100/100) - ($interes_ptj / 100)), -3);
    $total_interes                                                  = $total_pagar - $precio_venta_producto;
    //$total_interes                                                  = $valor_credito * ($interes_ptj / 100);
    //$total_pagar                                                    = $valor_credito + $total_interes;
    $cuota_credito                                                  = $total_pagar / $numero_cuotas;
    $precio_venta_producto_mas_comision_funcionamiento              = round($precio_venta_producto / ((100/100) - ($entidad_crediticia_interes_ptj/100)), -3);
    $valor_credito                                                  = $precio_venta_producto;
    $calculo_diferencia_de_precios                                  = $precio_venta_producto_mas_comision_funcionamiento - $total_pagar;
    $calculo_descuento_respecto_al_mayor                            = round((($calculo_diferencia_de_precios / $precio_venta_producto_mas_comision_funcionamiento) * 100), 2);
	//---------------------------------------------------------------------------------------------------------------------------------//
	$und_venta                                                      = "1";
	$total_compra_producto                                          = $precio_compra_producto * $und_venta;
	$total_costo_producto                                           = $precio_costo_producto * $und_venta;
	$precio_venta_producto_orig                                     = $precio_venta_producto;
    $total_interes                                                  = $valor_credito * ($interes_ptj / 100);
    $monto_deuda                                                    = $total_pagar;
    $monto_deuda_sin_interes                                        = $precio_venta_producto;
    $subtotal                                                       = $total_pagar;
    $subtotal_sin_interes                                           = $precio_venta_producto;
    $numero_cuota                                                   = $codigo_meses_credito;
    $monto_cuota                                                    = $cuota_credito;
    $monto_deuda_mas_interes                                        = $total_pagar;
    $monto_cuota_interes                                            = $total_interes;
    $total_pendiente                                                = $total_pagar;
	$total_valor_venta                                              = $total_pagar;
	$total_valor_recibir                                            = $total_pagar;
	$total_precio_compra                                            = $precio_compra_producto;
	$total_precio_venta                                             = $total_pagar;
	$precio_venta_producto                                          = $total_pagar;
	$total_venta_producto                                           = $total_pagar * $und_venta;
/* ----------------------------------------------------------------------------------------------------------/ */
    $obtener_administrador_revisor_rand = "SELECT cod_administrador FROM tbl15_administrador WHERE (cod_seguridad = '27') ORDER BY RAND()";
    $resultado_administrador_revisor_rand = mysqli_query($conectar, $obtener_administrador_revisor_rand) or die(mysqli_error($conectar));
    $info_administrador_revisor_rand = mysqli_fetch_assoc($resultado_administrador_revisor_rand);

    $cod_administrador_revisor                                      = $info_administrador_revisor_rand['cod_administrador'];
    $cod_revisor                                                    = $cod_administrador_revisor;
	//---------------------------------------------------------------------------------------------------------------------------------//
    if($existe_dato_tercero > 0) {

    } else {
		$sql_autoincremento_info_factura = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$base_datos' AND TABLE_NAME = 'tbl15_tercero'";
		$exec_autoincremento_info_factura = mysqli_query($conectar, $sql_autoincremento_info_factura) or die(mysqli_error($conectar));
		$datos_autoincremento_info_factura = mysqli_fetch_assoc($exec_autoincremento_info_factura);

		$cod_tercero                                                = $datos_autoincremento_info_factura['AUTO_INCREMENT'];
	   	$cod_tercero_codif                                          = DAXCODIFCRYPTOR::encodifdax($cod_tercero);
    	$cod_tercero_codifcryp                                      = DAXCODIFCRYPTOR::encriptardax($cod_tercero_codif);

		$sql_data = "INSERT INTO tbl15_tercero (cod_tercero, nombre_tipo_tercero, nombre_tipo_tercero_modulo_creacion, cod_producto, valor_credito, cod_entidad_crediticia, cod_tipo_cobro, cod_meses_credito, 
		nombre_tipo_identificacion, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, 
		fecha_nac_tercero, fecha_expedicion_tercero, telefono1_tercero, correo_tercero, direccion_tercero, nombre_estado_civil, fecha_creacion, 
		cod_administrador, cod_estado_cliente, direccion_contacto1, tel_contacto1, cod_seguridad, cod_intermediario_credito) 
		VALUES ('$cod_tercero', '$nombre_tipo_tercero', '$nombre_tipo_tercero_modulo_creacion', '$cod_producto', '$valor_credito', '$cod_entidad_crediticia', '$cod_tipo_cobro', '$cod_meses_credito', 
		'$nombre_tipo_identificacion', '$identificacion_tercero', UPPER('$nombre1_tercero'), UPPER('$nombre2_tercero'), UPPER('$apellido1_tercero'), UPPER('$apellido2_tercero'), 
		'$fecha_nac_tercero', '$fecha_expedicion_tercero', '$telefono1_tercero', '$correo_tercero', '$direccion_tercero', '$nombre_estado_civil', '$fecha_creacion', 
		'$cod_administrador', '$cod_estado_cliente', '$direccion_contacto1', '$tel_contacto1', '$cod_seguridad', '1')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_data = "INSERT INTO tbl15_info_factura_venta (cod_info_factura_venta, nombre_estado_factura, fecha_ymdhis, cuenta, cod_estado_factura, cod_caja_virtual, fecha_dia, fecha_mes, 
	fecha_anyo, anyo, fecha_hora, cod_tipo_pago, cod_tipo_forma_pago, cod_administrador, nombre_tipo_factura, nombre_tipo_moneda, cod_tercero, cod_base_caja, fecha_creacion, 
	cod_resolucion_facturacion, monto_deuda, monto_deuda_sin_interes, subtotal, subtotal_sin_interes, numero_cuota, monto_cuota, interes_ptj, monto_deuda_mas_interes, 
	monto_cuota_interes, nombre_tipo_cobro, identificacion_tercero, nombre1_tercero, nombre2_tercero, apellido1_tercero, apellido2_tercero, fecha_nac_tercero, telefono1_tercero, 
	correo_tercero, direccion_tercero, total_precio_compra, total_precio_venta, cod_entidad_crediticia, cod_tienda, cod_administrador_revisor, 
	cod_administrador_lider, cod_administrador_coordinador, cod_administrador_asesor, cod_administrador_aliado_estrategico, cod_intermediario_credito) 
	VALUES ('$cod_info_factura_venta', '$nombre_estado_factura', '$fecha_ymdhis', '$cuenta', '$cod_estado_factura', '$cod_caja_virtual', '$fecha_dia', '$fecha_mes', 
	'$fecha_anyo', '$anyo', '$fecha_hora', '$cod_tipo_pago', '$cod_tipo_forma_pago', '$cod_administrador', '$nombre_tipo_factura', '$nombre_tipo_moneda', '$cod_tercero', '$cod_base_caja', '$fecha_creacion', 
	'$cod_resolucion_facturacion', '$monto_deuda', '$monto_deuda_sin_interes', '$subtotal', '$subtotal_sin_interes', '$numero_cuota', '$monto_cuota', '$interes_ptj', '$monto_deuda_mas_interes', 
	'$monto_cuota_interes', '$nombre_tipo_cobro', '$identificacion_tercero', UPPER('$nombre1_tercero'), UPPER('$nombre2_tercero'), UPPER('$apellido1_tercero'), UPPER('$apellido2_tercero'), '$fecha_nac_tercero', '$telefono1_tercero', 
	'$correo_tercero', '$direccion_tercero', '$total_precio_compra', '$total_precio_venta', '$cod_entidad_crediticia', '$cod_tienda', '$cod_administrador_revisor', 
	'$cod_administrador_lider', '$cod_administrador_coordinador', '$cod_administrador_asesor', '$cod_administrador_aliado_estrategico', '1')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = "INSERT INTO tbl15_venta_producto_temporal (cod_info_factura_venta, cod_tercero, cod_producto, cod_producto_barra, nombre_producto, und_venta, 
	precio_compra_producto, total_compra_producto, precio_costo_producto, total_costo_producto, precio_venta_producto, total_venta_producto, precio_venta_producto_orig, 
	nombre_tipo_unidad_medida, fecha_ymd_venta_producto, fecha_mes_venta_producto, fecha_anyo_venta_producto, fecha_seg_venta_producto, cuenta, 
	cod_administrador, cod_caja_virtual, nombre_tipo_precio_venta, und_producto, cod_base_caja, iva_ptj, cod_categoria) 
	VALUES ('$cod_info_factura_venta', '$cod_tercero', '$cod_producto', '$cod_producto_barra', '$nombre_producto', '$und_venta', 
	'$precio_compra_producto', '$total_compra_producto', '$precio_costo_producto', '$total_costo_producto', '$precio_venta_producto', '$total_venta_producto',	'$precio_venta_producto_orig', 
	'$nombre_tipo_unidad_medida', '$fecha_ymd_venta_producto', '$fecha_mes_venta_producto', '$fecha_anyo_venta_producto', '$fecha_seg_venta_producto', '$cuenta', 
	'$cod_administrador', '$cod_caja_virtual', '$nombre_tipo_precio_venta', '$und_producto', '$cod_base_caja', '$iva_ptj', '$cod_categoria')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	//---------------------------------------------------------------------------------------------------------------------------------//
	$sql_data = "INSERT INTO tbl15_comision_ptj_factura_venta (cod_info_factura_venta, cod_lider, lider_comision_ptj, cod_coordinador, coordinador_comision_ptj, cod_asesor, asesor_comision_ptj, 
	cod_aliado_estrategico, cod_revisor, fecha_creaccion) 
	VALUES ('$cod_info_factura_venta', '$cod_lider', '$lider_comision_ptj', '$cod_coordinador', '$coordinador_comision_ptj', '$cod_asesor', '$asesor_comision_ptj', 
	'$cod_aliado_estrategico', '$cod_revisor', '$fecha_creacion')";
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
	//---------------------------------------------------------------------------------------------------------------------------------//
	$mostrar_datos_sql = "SELECT * FROM tbl15_documento_requisito_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia' AND cod_estado = '1') ORDER BY cod_documento_requisito_entidad_crediticia DESC";
	$consulta = mysqli_query($conectar, $mostrar_datos_sql) or die(mysqli_error($conectar));
	while ($matriz_consulta = mysqli_fetch_assoc($consulta)) {

	    $cod_documento_requisito_entidad_crediticia                 = $matriz_consulta['cod_documento_requisito_entidad_crediticia'];
	    $nombre_documento_requisito_entidad_crediticia              = $matriz_consulta['nombre_documento_requisito_entidad_crediticia'];
	    $nombre_tipo_recorte_foto                                   = $matriz_consulta['nombre_tipo_recorte_foto'];
	    $nombre_nota_observacion                                    = $nombre_documento_requisito_entidad_crediticia;

		$sql_data = "INSERT INTO tbl15_nota_observacion (cod_info_factura_venta, nombre_nota_observacion, cuenta, cod_administrador, cod_tercero, cod_tipo_nota_observacion, fecha_creacion, codigo_estado_revision, 
		nombre_tipo_recorte_foto, cod_documento_requisito_entidad_crediticia) 
		VALUES ('$cod_info_factura_venta', '$nombre_nota_observacion', '$cuenta', '$cod_administrador', '$cod_tercero', '$cod_tipo_nota_observacion', '$fecha_creacion', '$codigo_estado_revision', 
		'$nombre_tipo_recorte_foto', '$cod_documento_requisito_entidad_crediticia')";
		$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
    if ($cod_seguridad == '25') { // CLIENTE
    	$pagina_redirect  = "../admin/lista_cliente_siscredito_visitante_intern.php";
    	$pagina           = "../admin/lista_cliente_siscredito_visitante_intern.php";
    } elseif ($cod_seguridad == '23') { // ALIADO ESTRATEGICO
    	$pagina_redirect  = "../admin/registro_cliente_y_precredito_opcion_imprimir_siscredito_visitante_intern.php";
    	$pagina           = "../admin/registro_cliente_y_precredito_opcion_imprimir_siscredito_visitante_intern.php";
    } else {
    	$pagina_redirect = "../admin/lista_cliente_siscredito_visitante_intern.php";
    	$pagina          = "../admin/lista_cliente_siscredito_visitante_intern.php";
    }
    $pagina_notificacion_chatbot_telegram          = "../admin/enviar_notificacion_chatbot_canal_telegram_registro_cliente_simulador_credito_ajax.php";
	//---------------------------------------------------------------------------------------------------------------------------------//
	$url_redir = $pagina_notificacion_chatbot_telegram."?cod_info_factura_venta=".$cod_info_factura_venta."&cod_entidad_crediticia=".$cod_entidad_crediticia."&cod_tercero_codifcryp=".$cod_tercero_codifcryp."&pagina=".$pagina;
	header("Location: $url_redir");
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
	//----------------------------------------------------------------------- ---------------------------------------------------------//
}
?>