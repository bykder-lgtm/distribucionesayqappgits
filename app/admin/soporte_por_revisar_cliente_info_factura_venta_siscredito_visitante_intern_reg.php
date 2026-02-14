<?php
$tiempo_inicial = microtime(true);
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin_visitante_intern.php");

$cuenta_actual                                = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cuenta_visitante                             = $_SESSION['usuario'];
$cod_administrador                            = $_SESSION['cod_administrador'];
$cuenta                                       = $cuenta_visitante;
//---------------------------------------------------------------------------------------------------------------------------------//
//---------------------------------------------------------------------------------------------------------------------------------//
if ((isset($_POST["insersion"])) && ($_POST["insersion"] == "formulario_de_insersion")) {

	if (isset($_POST['cod_nota_observacion']) <> '') { $cod_nota_observacion = mysqli_real_escape_string($conectar, strip_tags($_POST['cod_nota_observacion'])); } else { $cod_nota_observacion = ''; }
	if (isset($_POST['cod_info_factura_venta']) <> '') { $cod_info_factura_venta = mysqli_real_escape_string($conectar, strip_tags($_POST['cod_info_factura_venta'])); } else { $cod_info_factura_venta = ''; }
	if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = mysqli_real_escape_string($conectar, strip_tags($_POST['cod_tercero'])); } else { $cod_tercero = ''; }
	if (isset($_POST['codigo_estado_revision']) <> '') { $codigo_estado_revision = intval($_POST['codigo_estado_revision']); } else { $codigo_estado_revision = ''; }
	if (isset($_POST['descripcion_nota_observacion']) <> '') { $descripcion_nota_observacion = mysqli_real_escape_string($conectar, strip_tags($_POST['descripcion_nota_observacion'])); } else { $descripcion_nota_observacion = ''; }
	$pagina = addslashes($_POST['pagina']); 
/* ----------------------------------------------------------------------------------------------------------/ */
    $obtener_info_fact = "SELECT cod_administrador_revisor FROM tbl15_info_factura_venta WHERE (cod_info_factura_venta = '$cod_info_factura_venta')";
    $resultado_info_fact = mysqli_query($conectar, $obtener_info_fact) or die(mysqli_error($conectar));
    $info_fact = mysqli_fetch_assoc($resultado_info_fact);

    $cod_administrador_revisor                          = $info_fact['cod_administrador_revisor'];
/* ----------------------------------------------------------------------------------------------------------/ */
    if ($cod_administrador_revisor == '0') {
	    $obtener_administrador_revisor_rand = "SELECT cod_administrador FROM tbl15_administrador WHERE (cod_seguridad = '27') ORDER BY RAND()";
	    $resultado_administrador_revisor_rand = mysqli_query($conectar, $obtener_administrador_revisor_rand) or die(mysqli_error($conectar));
	    $info_administrador_revisor_rand = mysqli_fetch_assoc($resultado_administrador_revisor_rand);

	    $cod_administrador_revisor                          = $info_administrador_revisor_rand['cod_administrador'];

		$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_info_factura_venta SET cod_administrador_revisor = '$cod_administrador_revisor' WHERE (cod_info_factura_venta = '$cod_info_factura_venta')");
		$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
    }
/* ----------------------------------------------------------------------------------------------------------/ */
    $obtener_administrador_revisor = "SELECT telefono FROM tbl15_administrador WHERE (cod_administrador = '$cod_administrador_revisor')";
    $resultado_administrador_revisor = mysqli_query($conectar, $obtener_administrador_revisor) or die(mysqli_error($conectar));
    $info_administrador_revisor = mysqli_fetch_assoc($resultado_administrador_revisor);

    $telefono_revisor                                   = $info_administrador_revisor['telefono'];
/* ----------------------------------------------------------------------------------------------------------/ */
	$time                                               = time();
	$fecha_hora                                         = date("H:i:s");
	$fecha_ymd                                          = date("Y-m-d");
	$fecha_creacion                                     = date("Y-m-d");
	$nombre_paciente                                    = 'FECHA REVISION: '.$fecha_ymd.' | '.$fecha_hora.' | cuenta: '.$cuenta;
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_nota_observacion SET codigo_estado_revision = '$codigo_estado_revision', descripcion_nota_observacion = '$descripcion_nota_observacion'
	WHERE (cod_nota_observacion = '$cod_nota_observacion')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
	$url_redir = "../admin/soportes_info_factura_venta_productos_opcion_imprimir_siscredito_visitante_intern.php?cod_info_factura_venta=".$cod_info_factura_venta."&cod_nota_observacion=".$cod_nota_observacion."&cod_tercero=".$cod_tercero."&pagina=".$pagina;
	header("Location: $url_redir");
}
?>