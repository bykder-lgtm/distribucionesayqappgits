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
$cuenta_actual                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                             = $_SESSION['usuario'];
$cod_administrador_sesion           = $_SESSION['cod_administrador'];

$retorno_array                              = array();
$retorno_array2                             = array();
$codigoHTML_menu                            = '';
$codigoHTML_menu_total_reg                  = '';
$respuesta_ajax                             = array();

if (isset($_POST['cod_entidad_crediticia'])) {
	$cod_entidad_crediticia                        = intval($_POST['cod_entidad_crediticia']);
	$valor_credito                                 = intval($_POST['valor_credito']);
	$precio_venta_producto                         = intval($_POST['precio_venta_producto']);
	$nombre_tipo_origen_simulacion                 = addslashes($_POST['nombre_tipo_origen_simulacion']);
	$cod_tipo_simulacion_credito                   = intval($_POST['cod_tipo_simulacion_credito']);
	$numero_cuotas                                 = intval($_POST['numero_cuotas']);
	$nombre_tipo_cobro                             = addslashes($_POST['nombre_tipo_cobro']);
	$tipo_ajax                                     = addslashes($_POST['tipo_ajax']);
	$pagina                                        = addslashes($_POST['pagina']);
	$cod_producto_codifcryp                        = addslashes($_POST['cod_producto_codifcryp']);
    $cod_producto_codif                            = DAXCODIFCRYPTOR::descriptardax($cod_producto_codifcryp);
    $cod_producto                                  = intval(DAXCODIFCRYPTOR::descodifdax($cod_producto_codif));

    $sql_entidad_crediticia = "SELECT aliado_estrategico_interes_ptj FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $aliado_estrategico_interes_ptj                = $datos_entidad_crediticia['aliado_estrategico_interes_ptj'];
	$interes_ptj                                   = $aliado_estrategico_interes_ptj;

    if ($nombre_tipo_origen_simulacion == 'TIENDA_VIRTUAL') {
	    $sql_producto = "SELECT cod_producto, cod_producto_barra, nombre_producto, precio_venta_producto, nombre_promocion FROM tbl15_producto WHERE (cod_producto = '$cod_producto')";
	    $consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
	    $datos_producto = mysqli_fetch_assoc($consulta_producto);

	    $precio_venta_producto                                        = $datos_producto['precio_venta_producto'];
        // Solo aplicar interés si es precio de contado (cod_tipo_simulacion_credito == 1)
        if ($cod_tipo_simulacion_credito == 1 || $cod_tipo_simulacion_credito == 0) {
            $precio_venta_producto_mas_comision_funcionamiento        = round($precio_venta_producto / ((100/100) - ($interes_ptj/100)), -3);
        } else {
            // Si es precio a crédito, el valor ya incluye el interés
            $precio_venta_producto_mas_comision_funcionamiento        = $precio_venta_producto;
        }
    } elseif ($nombre_tipo_origen_simulacion == 'SIMULACION_VALOR_LIBRE') {
        $precio_venta_producto                                        = intval($_REQUEST['precio_venta_producto']);
        // Solo aplicar interés si es precio de contado (cod_tipo_simulacion_credito == 1)
        if ($cod_tipo_simulacion_credito == 1 || $cod_tipo_simulacion_credito == 0) {
            $precio_venta_producto_mas_comision_funcionamiento        = round($precio_venta_producto / ((100/100) - ($interes_ptj/100)), -3);
        } else {
            // Si es precio a crédito, el valor ya incluye el interés
            $precio_venta_producto_mas_comision_funcionamiento        = $precio_venta_producto;
        }
    } else {
        $precio_venta_producto                                        = 0;
        $precio_venta_producto_mas_comision_funcionamiento            = 0;
    }
	//---------------------------------------------------------------------------------------------------------------------------------//
	if ($cod_tipo_simulacion_credito == 1 || $cod_tipo_simulacion_credito == 0) { // OPCIÓN 1: Calcular crédito CON intereses (partir del valor de contado)
		$total_pagar_calc                                              = ($precio_venta_producto) / ((100/100) - ($interes_ptj / 100));
		$total_pagar                                                   = round($total_pagar_calc, -3);
		$total_interes                                                 = $total_pagar - $precio_venta_producto;
		$cuota_credito                                                 = $total_pagar / $numero_cuotas;
		$text_label_valor                                              = 'Valor de Contado';
	} else { // OPCIÓN 2: Calcular crédito con PRECIO A CRÉDITO (el valor ingresado ya incluye intereses)
		$total_pagar                                                   = $precio_venta_producto; // El valor ingresado YA es el total a pagar
		$valor_contado_calc                                            = ($total_pagar) * ((100/100) - ($interes_ptj / 100));
		$valor_contado                                                 = round($valor_contado_calc, -3);
		$total_interes                                                 = $total_pagar - $valor_contado;
		$cuota_credito                                                 = $total_pagar / $numero_cuotas;
		$text_label_valor                                              = 'Valor a Crédito';
	}
	//$total_pagar                                                      = round($precio_venta_producto / ((100/100) - ($interes_ptj / 100)), -3);
	//$total_interes                                                    = $total_pagar - $precio_venta_producto;
    //$cuota_credito                                                    = $total_pagar / $numero_cuotas;
	
	// Generar HTML con la estructura correcta para mantener el diseño
	$mensaje_cuota_credito = '<div class="label">Cuota <strong>'.strtolower($nombre_tipo_cobro).'</strong> aproximada:</div>';
	$mensaje_cuota_credito .= '<div class="valor">$'.number_format($cuota_credito, 0, ",", ".").'</div>';

	header('Content-Type: application/json');

	$respuesta_ajax['mensaje_cuota_credito']       = $mensaje_cuota_credito;
	$respuesta_ajax['total_pagar']                 = $total_pagar;
	$respuesta_ajax['cuota_credito']               = $cuota_credito;
	$respuesta_ajax['numero_cuotas']               = $numero_cuotas;
	$respuesta_ajax['aliado_estrategico_interes_ptj']               = $aliado_estrategico_interes_ptj;
	$respuesta_ajax['mensaje']                     = 'Calculo hecho correctamente.';

	echo json_encode($respuesta_ajax);
}
?>