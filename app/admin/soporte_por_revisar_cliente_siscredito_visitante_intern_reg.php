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
	if (isset($_POST['cod_cuentas_cobrar']) <> '') { $cod_cuentas_cobrar = mysqli_real_escape_string($conectar, strip_tags($_POST['cod_cuentas_cobrar'])); } else { $cod_cuentas_cobrar = ''; }
	if (isset($_POST['cod_tercero']) <> '') { $cod_tercero = mysqli_real_escape_string($conectar, strip_tags($_POST['cod_tercero'])); } else { $cod_tercero = ''; }
	if (isset($_POST['codigo_estado_revision']) <> '') { $codigo_estado_revision = intval($_POST['codigo_estado_revision']); } else { $codigo_estado_revision = ''; }
	if (isset($_POST['descripcion_nota_observacion']) <> '') { $descripcion_nota_observacion = mysqli_real_escape_string($conectar, strip_tags($_POST['descripcion_nota_observacion'])); } else { $descripcion_nota_observacion = ''; }
	$pagina = addslashes($_POST['pagina']); 
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
	$time                                               = time();
	$fecha_hora                                         = date("H:i:s");
	$fecha_ymd                                          = date("Y-m-d");
	$fecha_creacion                                     = date("Y-m-d");
	$nombre_paciente                                    = 'FECHA REVISION: '.$fecha_ymd.' | '.$fecha_hora.' | cuenta: '.$cuenta;
/* ----------------------------------------------------------------------------------------------------------/ */
/* ----------------------------------------------------------------------------------------------------------/ */
	$sql_cuenta_cobrar_tercero = sprintf("UPDATE tbl15_nota_observacion SET codigo_estado_revision = '$codigo_estado_revision', descripcion_nota_observacion = '$descripcion_nota_observacion'
	WHERE (cod_nota_observacion = '$cod_nota_observacion')");
	$resultado_cuenta_cobrar_tercero = mysqli_query($conectar, $sql_cuenta_cobrar_tercero) or die(mysqli_error($conectar));
/* ----------------------------------------------------------------------------------------------------------/ */
	$url_redir = "../admin/lista_soportes_cuenta_cobrar_siscredito_visitante_intern.php?cod_cuentas_cobrar=".$cod_cuentas_cobrar."&cod_tercero=".$cod_tercero."&pagina=".$pagina;
	header("Location: $url_redir");
}
?>