<?php
include_once('../conexiones/conexione.php');
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');

date_default_timezone_set("America/Bogota");
//include_once('../admin/fecha_en_espanol.php');
include_once("../session/funciones_admin.php");
//include("../tbl15_notificacion_alerta/mostrar_noficacion_alerta.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
  } else { header("Location:../index.php");
}
$cod_administrador  = $_SESSION['cod_administrador'];
include_once('../admin/01_modulo_permisos.php');

$sql_infos_empresas = "SELECT * FROM tbl15_info_empresa WHERE cod_info_empresa = '1'";
$resultado_infos_empresas = mysqli_query($conectar, $sql_infos_empresas);
$info_empresa_data = mysqli_fetch_assoc($resultado_infos_empresas);

$titulo_emp                                        = $info_empresa_data['titulo'];
$nombre_emp                                        = $info_empresa_data['nombre'];
$eslogan_emp                                       = $info_empresa_data['eslogan'];
$direccion_emp                                     = $info_empresa_data['direccion'];
$ciudad_emp                                        = $info_empresa_data['ciudad'];
$pais_emp                                          = $info_empresa_data['pais'];
//---------------------------------------------------------------------------------------------------------------------------------//
$cuenta_actual      = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);
$cod_seguridad_des  = DAXCRYPTOR::descriptardax($_SESSION['cs_cryp']);
/* ----------------------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------------------------------------------------------------------------------- */
$tab                                = addslashes($_GET['tab']);
$tipo                               = addslashes($_GET['tipo']);
$campo                              = addslashes($_GET['campo']);
$pagina                             = addslashes($_GET['pagina']);

$fecha_elim                         = date("Y-m-d H:i:s");	
$usuario_elim                       = $cuenta_actual;


if ($tipo == 'archivar' && $tab == 'Eliminar_Archivar_Renovacion_agrupado_cod_cuentas_cobrar') {
	$cod_cuentas_cobrar_alerta     = intval($_GET['llave']);
	$cod_cuentas_cobrar            = intval($_GET['cod_cuentas_cobrar']);
	$cod_tercero                   = intval($_GET['cod_tercero']);
	$cod_factura                   = intval($_GET['cod_factura']);
	$pagina_redirect               = $pagina.'?cod_cuentas_cobrar'.$cod_cuentas_cobrar.'&cod_tercero'.$cod_tercero.'&cod_factura'.$cod_factura.'&pagina'.$pagina;
	$cod_estado_archivado               = 1;

	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_alerta SET cod_estado_archivado = '$cod_estado_archivado', fecha_elim = '$fecha_elim', usuario_elim = '$usuario_elim' WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));

	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_archivado = '$cod_estado_archivado', fecha_elim = '$fecha_elim', usuario_elim = '$usuario_elim' WHERE cod_cuentas_cobrar_alerta = '$cod_cuentas_cobrar_alerta'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//----------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------------------------------------------------------------------------------------------------//
}

if ($tipo == 'archivar' && $tab == 'tbl15_cuentas_cobrar_Eliminar_Archivar_Renovacion_agrupado_cod_cuentas_cobrar_ajax') {

	$cod_cuentas_cobrar     = intval($_GET['llave']);
	$cod_tercero            = intval($_GET['cod_tercero']);
	$cod_factura            = intval($_GET['cod_factura']);
	$pagina_redirect        = $pagina.'?cod_cuentas_cobrar'.$cod_cuentas_cobrar.'&cod_tercero'.$cod_tercero.'&cod_factura'.$cod_factura.'&pagina'.$pagina;
	$cod_estado_archivado               = 1;

	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar SET cod_estado_archivado = '$cod_estado_archivado', fecha_elim = '$fecha_elim', usuario_elim = '$usuario_elim' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//----------------------------------------------------------------------------------------------------------------------------------//
	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_alerta SET cod_estado_archivado = '$cod_estado_archivado', fecha_elim = '$fecha_elim', usuario_elim = '$usuario_elim' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//----------------------------------------------------------------------------------------------------------------------------------//
	$sql_data = sprintf("UPDATE tbl15_cuentas_cobrar_abonos SET cod_estado_archivado = '$cod_estado_archivado', fecha_elim = '$fecha_elim', usuario_elim = '$usuario_elim' WHERE cod_cuentas_cobrar = '$cod_cuentas_cobrar'");
	$exec_data = mysqli_query($conectar, $sql_data) or die(mysqli_error($conectar));
//----------------------------------------------------------------------------------------------------------------------------------//
?>
<!--<META HTTP-EQUIV="REFRESH" CONTENT="0; <?php echo $pagina_redirect?>">-->
<?php } ?>