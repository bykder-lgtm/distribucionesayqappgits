<?php
if (isset($_GET['valor']) && isset($_GET['id'])) {
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$valor_intro                     = addslashes($_GET['valor']);
$campo                           = addslashes($_GET['campo']);
$cod_remision                    = intval($_GET['id']);

if ($campo=='fecha_ymd_hora') {

$fecha_ymd_hora                  = $valor_intro;
$fecha_time                      = strtotime($fecha_ymd_hora);
$fecha_ymd                       = date("Y/m/d", $fecha_time);
$fecha_mes                       = date("m/Y", $fecha_time);
$fecha_anyo                      = date("Y", $fecha_time);
$fecha_dmy                       = date("d/m/Y", $fecha_time);
$hora                            = date("H:i:s", $fecha_time);
$fecha_reg_time                  = time();

$data_sql = ("UPDATE tbl15_remision SET fecha_ymd = '$fecha_ymd', fecha_time = '$fecha_time', fecha_mes = '$fecha_mes', 
fecha_anyo = '$fecha_anyo', fecha_dmy = '$fecha_dmy', fecha_reg_time = '$fecha_reg_time' WHERE cod_remision = '$cod_remision'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

} 
elseif ($campo=='cod_grupo_area_cargo') {
$obtener_grupo_area_cargo = "SELECT nombre_grupo_area_cargo, cod_grupo_area FROM tbl15_grupo_area_cargo WHERE cod_grupo_area_cargo = '".($valor_intro)."'";
$consultar_grupo_area_cargo = mysqli_query($conectar, $obtener_grupo_area_cargo) or die(mysqli_error($conectar));
$info_grupo_area_cargo= mysqli_fetch_assoc($consultar_grupo_area_cargo);

$cargo_empresa                  = $info_grupo_area_cargo['nombre_grupo_area_cargo'];
$cod_grupo_area                 = $info_grupo_area_cargo['cod_grupo_area'];

$obtener_grupo_area = "SELECT nombre_grupo_area FROM tbl15_grupo_area WHERE cod_grupo_area = '".($cod_grupo_area)."'";
$consultar_grupo_area = mysqli_query($conectar, $obtener_grupo_area) or die(mysqli_error($conectar));
$info_grupo_area= mysqli_fetch_assoc($consultar_grupo_area);

$area_empresa                   = $info_grupo_area['nombre_grupo_area'];

$data_sql = ("UPDATE tbl15_remision SET $campo = '$valor_intro', cargo_empresa = '$cargo_empresa', area_empresa = '$area_empresa', cod_grupo_area = '$cod_grupo_area' WHERE cod_remision = '$cod_remision'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
else {

$data_sql = ("UPDATE tbl15_remision SET $campo = '$valor_intro' WHERE cod_remision = '$cod_remision'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }

}

}
?>