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
$cuenta_actual                              = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta                                     = $_SESSION['usuario'];

$retorno_array                              = array();
$retorno_array2                             = array();
$codigoHTML_menu                            = '';
$codigoHTML_menu_total_reg                  = '';
$respuesta_ajax                             = array();

if (isset($_POST['id'])) {
	$cod_nota_observacion                          = intval($_POST['id']);
	$codigo_estado_revision                        = intval($_POST['valor']);
	$cod_info_factura_venta                        = intval($_POST['cod_info_factura_venta']);
	$tipo_ajax                                     = addslashes($_POST['tipo_ajax']);

    $sql_estado_revision = "SELECT * FROM tbl15_estado_revision WHERE (codigo_estado_revision = '$codigo_estado_revision')";
    $consulta_estado_revision = mysqli_query($conectar, $sql_estado_revision);
    $datos_estado_revision = mysqli_fetch_assoc($consulta_estado_revision);

    $nombre_estado_revision                         = $datos_estado_revision['nombre_estado_revision'];
    $color_fondo_celda_estado                       = $datos_estado_revision['color_fondo_celda_estado'];
    $color_letra_celda_estado                       = $datos_estado_revision['color_letra_celda_estado'];
    $color_fondo_celda                              = $datos_estado_revision['color_fondo_celda'];
    $color_letra_celda                              = $datos_estado_revision['color_letra_celda'];

	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_nota_observacion SET codigo_estado_revision = '$codigo_estado_revision' WHERE (cod_nota_observacion = '$cod_nota_observacion')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));

	if (mysqli_affected_rows($conectar) > 0) { $afectado = "SI"; } else { $afectado = "NO"; }

    $sql_conteo_soportes_factura = "SELECT count(codigo_estado_revision) AS total_soportes_factura FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $consulta_conteo_soportes_factura = mysqli_query($conectar, $sql_conteo_soportes_factura);
    $datos_conteo_soportes_factura = mysqli_fetch_assoc($consulta_conteo_soportes_factura);

    $total_soportes_factura                         = intval($datos_conteo_soportes_factura['total_soportes_factura']);

    $sql_conteo_soportes_aceptados = "SELECT count(codigo_estado_revision) AS total_soportes_aceptados FROM tbl15_nota_observacion WHERE (cod_info_factura_venta = '$cod_info_factura_venta') AND (codigo_estado_revision = '2')";
    $consulta_conteo_soportes_aceptados = mysqli_query($conectar, $sql_conteo_soportes_aceptados);
    $datos_conteo_soportes_aceptados = mysqli_fetch_assoc($consulta_conteo_soportes_aceptados);

    $total_soportes_aceptados                       = intval($datos_conteo_soportes_aceptados['total_soportes_aceptados']);

    if ($total_soportes_factura == $total_soportes_aceptados) { $accion_soportes = 'REFRESCAR_PAGINA'; } else { $accion_soportes = 'NO_GENERAR_FACTURA'; }

	header('Content-Type: application/json');

	$respuesta_ajax['afectado']                    = $afectado;
	$respuesta_ajax['cod_nota_observacion']        = $cod_nota_observacion;
	$respuesta_ajax['codigo_estado_revision']      = $codigo_estado_revision;
	$respuesta_ajax['nombre_estado_revision']      = $nombre_estado_revision;
	$respuesta_ajax['color_fondo_celda']           = $color_fondo_celda;
	$respuesta_ajax['color_letra_celda']           = $color_letra_celda;
	$respuesta_ajax['accion_soportes']             = $accion_soportes;
	$respuesta_ajax['mensaje']                     = 'Hecho correctamente.';

	echo json_encode($respuesta_ajax);
}
?>