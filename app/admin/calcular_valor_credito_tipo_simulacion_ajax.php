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
$cuenta_actual                                                      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                                                   = $_SESSION['usuario'];
$cod_administrador                                                  = ($_SESSION['cod_administrador']);
//$cuenta                                     = $_SESSION['usuario'];

$retorno_array                                                      = array();
$retorno_array2                                                     = array();
$codigoHTML_menu                                                    = '';
$codigoHTML_menu_total_reg                                          = '';
$respuesta_ajax                                                     = array();

if (isset($_POST['cod_entidad_crediticia'])) {

    $precio_venta_producto                                          = intval($_POST['precio_venta_producto']);
    $numero_cuotas                                                  = intval($_POST['numero_cuotas']);
    $cod_entidad_crediticia                                         = intval($_POST['cod_entidad_crediticia']);
    $cod_tipo_simulacion_credito                                    = intval($_POST['cod_tipo_simulacion_credito']);

    $sql_entidad_crediticia = "SELECT aliado_estrategico_interes_ptj, aliado_estrategico_aval_ptj FROM tbl15_entidad_crediticia WHERE (cod_entidad_crediticia = '$cod_entidad_crediticia')";
    $consulta_entidad_crediticia = mysqli_query($conectar, $sql_entidad_crediticia) or die(mysqli_error($conectar));
    $datos_entidad_crediticia = mysqli_fetch_assoc($consulta_entidad_crediticia);

    $interes_ptj                                                    = $datos_entidad_crediticia['aliado_estrategico_interes_ptj'];
    $aval_ptj                                                       = $datos_entidad_crediticia['aliado_estrategico_aval_ptj'];

    if ($cod_tipo_simulacion_credito == 1 || $cod_tipo_simulacion_credito == 0) { // OPCIÓN 1: Calcular crédito CON intereses (partir del valor de contado)
        $total_pagar_calc                                              = ($precio_venta_producto) / ((100/100) - ($interes_ptj / 100));
	    $total_pagar                                                   = round($total_pagar_calc, -3);
        $total_interes                                                 = $total_pagar - $precio_venta_producto;
        $cuota_credito                                                 = $total_pagar / $numero_cuotas;
        $text_label_valor                                              = 'Valor de Contado';
        $valor_contado                                                 = $precio_venta_producto; // El precio ingresado es el de contado
        $valor_credito_calculado                                       = $total_pagar; // El total a pagar es el crédito calculado
    } else { // OPCIÓN 2: Calcular crédito con PRECIO A CRÉDITO (el valor ingresado ya incluye intereses)
        $total_pagar                                                   = $precio_venta_producto; // El valor ingresado YA es el total a pagar
        $valor_contado_calc                                            = ($total_pagar) * ((100/100) - ($interes_ptj / 100));
        $valor_contado                                                 = round($valor_contado_calc, -3);
        $total_interes                                                 = $total_pagar - $valor_contado;
        $cuota_credito                                                 = $total_pagar / $numero_cuotas;
        $text_label_valor                                              = 'Valor a Crédito';
        $valor_credito_calculado                                       = $total_pagar; // El precio ingresado es el de crédito
    }
	header('Content-Type: application/json');
	$respuesta_ajax['total_pagar']                                     = $total_pagar;
	$respuesta_ajax['cuota_credito']                                   = $cuota_credito;
	$respuesta_ajax['numero_cuotas']                                   = $numero_cuotas;
	$respuesta_ajax['precio_venta_producto']                           = $precio_venta_producto;
	$respuesta_ajax['interes_ptj']                                     = $interes_ptj;
	$respuesta_ajax['total_interes']                                   = $total_interes;
	$respuesta_ajax['cod_tipo_simulacion_credito']                     = $cod_tipo_simulacion_credito;
	$respuesta_ajax['cod_entidad_crediticia']                          = $cod_entidad_crediticia;
	$respuesta_ajax['text_label_valor']                                = $text_label_valor;
	$respuesta_ajax['valor_contado']                                   = $valor_contado;
	$respuesta_ajax['valor_credito_calculado']                         = $valor_credito_calculado;
    $respuesta_ajax['success']                                         = 'true';
    $respuesta_ajax['mensaje']                                         = 'Calculo hecho correctamente.';

	echo json_encode($respuesta_ajax);
}
?>