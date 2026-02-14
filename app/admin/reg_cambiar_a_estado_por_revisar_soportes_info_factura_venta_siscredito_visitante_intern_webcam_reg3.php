<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_intern.php");
include("../admin/class_php/class.upload.php");

$cuenta_actual                                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                             = $_SESSION['usuario'];
$cod_administrador                            = $_SESSION['cod_administrador'];
$cuenta                                       = $cuenta_visitante;
$retorno_array                                = array();
$retorno_array2                               = array();
$codigoHTML_menu                              = '';
$codigoHTML_menu_total_reg                    = '';
$respuesta_ajax                               = array();

if (isset($_GET['cod_nota_observacion'])) {
	$cod_info_factura_venta                             = intval($_GET['cod_info_factura_venta']);
	$cod_nota_observacion                               = intval($_GET['cod_nota_observacion']);
	$pagina                                             = addslashes($_GET['pagina']);
    $codigo_estado_revision                             = 1; //POR REVISAR

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_nota_observacion SET codigo_estado_revision = '$codigo_estado_revision' WHERE (cod_nota_observacion = '$cod_nota_observacion')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	$url_redir = $pagina."?cod_info_factura_venta=".$cod_info_factura_venta."&cod_nota_observacion=".$cod_nota_observacion."&cod_tercero=".$cod_tercero."&pagina=".$pagina;

	header("Location: $url_redir");
}
?>
