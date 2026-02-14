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
$cuenta_actual           = DAXCRYPTOR::descriptardax($_SESSION['usuario_cryp']);

if (isset($_REQUEST['id'])) { $id = intval($_REQUEST['id']); } else { $id = '0'; }
if (isset($_REQUEST['codigo_puc'])) { $codigo_puc = addslashes($_REQUEST['codigo_puc']); } else { $codigo_puc = '0'; }
if (isset($_REQUEST['nombre_puc'])) { $nombre_puc = addslashes($_REQUEST['nombre_puc']); } else { $nombre_puc = '0'; }
if (isset($_REQUEST['campo'])) { $campo = addslashes($_REQUEST['campo']); } else { $campo = '0'; }
if (isset($_REQUEST['valor'])) { $valor_intro = addslashes($_REQUEST['valor']); } else { $valor_intro = '0'; }
if (isset($_REQUEST['jqui'])) { $jqui = addslashes($_REQUEST['jqui']); } else { $jqui = '0'; }
//**************************************************************************************************//
//**************************************************************************************************//
if ($campo == 'puc_activo_corriente' && $jqui == '0') {
$puc_activo_corriente         = intval($valor_intro);
$cod_activo_corriente         = $id;

$agregar_reg_pyg = "UPDATE tbl15_activo_corriente SET puc_activo_corriente = '$puc_activo_corriente' 
WHERE cod_activo_corriente = '$cod_activo_corriente'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} 
elseif($campo == 'puc_activo_corriente[]' && $jqui == 'jqui') {
$puc_activo_corriente          = $codigo_puc;
$nombre_activo_corriente       = $nombre_puc;
$cod_activo_corriente          = $id;

$agregar_reg_pyg = "UPDATE tbl15_activo_corriente SET puc_activo_corriente = '$puc_activo_corriente',
nombre_activo_corriente = '$nombre_activo_corriente' WHERE cod_activo_corriente = '$cod_activo_corriente'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//**************************************************************************************************//
if ($campo == 'nombre_activo_corriente' && $jqui == '0') {
$nombre_activo_corriente      = addslashes($valor_intro);
$cod_activo_corriente         = $id;

$agregar_reg_pyg = "UPDATE tbl15_activo_corriente SET nombre_activo_corriente = '$nombre_activo_corriente' 
WHERE cod_activo_corriente = '$cod_activo_corriente'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//**************************************************************************************************//
//**************************************************************************************************//
if ($campo == 'puc_propied_planta_equipo' && $jqui == '0') {
$puc_propied_planta_equipo         = intval($valor_intro);
$cod_propied_planta_equipo         = $id;

$agregar_reg_pyg = "UPDATE tbl15_propied_planta_equipo SET puc_propied_planta_equipo = '$puc_propied_planta_equipo' 
WHERE cod_propied_planta_equipo = '$cod_propied_planta_equipo'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} 
elseif($campo == 'puc_propied_planta_equipo[]' && $jqui == 'jqui') {
$puc_propied_planta_equipo          = $codigo_puc;
$nombre_propied_planta_equipo       = $nombre_puc;
$cod_propied_planta_equipo          = $id;

$agregar_reg_pyg = "UPDATE tbl15_propied_planta_equipo SET puc_propied_planta_equipo = '$puc_propied_planta_equipo',
nombre_propied_planta_equipo = '$nombre_propied_planta_equipo' WHERE cod_propied_planta_equipo = '$cod_propied_planta_equipo'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//**************************************************************************************************//
if ($campo == 'nombre_propied_planta_equipo' && $jqui == '0') {
$nombre_propied_planta_equipo      = addslashes($valor_intro);
$cod_propied_planta_equipo         = $id;

$agregar_reg_pyg = "UPDATE tbl15_propied_planta_equipo SET nombre_propied_planta_equipo = '$nombre_propied_planta_equipo' 
WHERE cod_propied_planta_equipo = '$cod_propied_planta_equipo'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//**************************************************************************************************//
//**************************************************************************************************////**************************************************************************************************//
//**************************************************************************************************//
if ($campo == 'puc_pasivo_corriente' && $jqui == '0') {
$puc_pasivo_corriente         = intval($valor_intro);
$cod_pasivo_corriente         = $id;

$agregar_reg_pyg = "UPDATE tbl15_pasivo_corriente SET puc_pasivo_corriente = '$puc_pasivo_corriente' 
WHERE cod_pasivo_corriente = '$cod_pasivo_corriente'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} 
elseif($campo == 'puc_pasivo_corriente[]' && $jqui == 'jqui') {
$puc_pasivo_corriente          = $codigo_puc;
$nombre_pasivo_corriente       = $nombre_puc;
$cod_pasivo_corriente          = $id;

$agregar_reg_pyg = "UPDATE tbl15_pasivo_corriente SET puc_pasivo_corriente = '$puc_pasivo_corriente',
nombre_pasivo_corriente = '$nombre_pasivo_corriente' WHERE cod_pasivo_corriente = '$cod_pasivo_corriente'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//**************************************************************************************************//
if ($campo == 'nombre_pasivo_corriente' && $jqui == '0') {
$nombre_pasivo_corriente      = addslashes($valor_intro);
$cod_pasivo_corriente         = $id;

$agregar_reg_pyg = "UPDATE tbl15_pasivo_corriente SET nombre_pasivo_corriente = '$nombre_pasivo_corriente' 
WHERE cod_pasivo_corriente = '$cod_pasivo_corriente'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//**************************************************************************************************//
//**************************************************************************************************//
if ($campo == 'puc_patrimonio' && $jqui == '0') {
$puc_patrimonio         = intval($valor_intro);
$cod_patrimonio         = $id;

$agregar_reg_pyg = "UPDATE tbl15_patrimonio SET puc_patrimonio = '$puc_patrimonio' 
WHERE cod_patrimonio = '$cod_patrimonio'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
} 
elseif($campo == 'puc_patrimonio[]' && $jqui == 'jqui') {
$puc_patrimonio          = $codigo_puc;
$nombre_patrimonio       = $nombre_puc;
$cod_patrimonio          = $id;

$agregar_reg_pyg = "UPDATE tbl15_patrimonio SET puc_patrimonio = '$puc_patrimonio',
nombre_patrimonio = '$nombre_patrimonio' WHERE cod_patrimonio = '$cod_patrimonio'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//**************************************************************************************************//
if ($campo == 'nombre_patrimonio' && $jqui == '0') {
$nombre_patrimonio      = addslashes($valor_intro);
$cod_patrimonio         = $id;

$agregar_reg_pyg = "UPDATE tbl15_patrimonio SET nombre_patrimonio = '$nombre_patrimonio' 
WHERE cod_patrimonio = '$cod_patrimonio'";
$resultado_pyg = mysqli_query($conectar, $agregar_reg_pyg) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
//**************************************************************************************************//
//**************************************************************************************************//
?>