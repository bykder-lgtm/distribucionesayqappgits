<?php
if (isset($_REQUEST['id'])) {
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){
//print "Bienvenido (a), <strong>".$_SESSION['usuario'].", </strong>al sistema.";
    } else { header("Location:../index.php");
}
$cod_plan_terapeutico            = intval($_REQUEST['id']);
$cod_historia_clinica            = intval($_REQUEST['cod_historia_clinica']);
$cod_producto                    = intval($_REQUEST['cod_producto']);
$campo                           = ($_REQUEST['campo']); 
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
if (isset($_REQUEST['cod_cliente']) <> '') { $cod_cliente = intval($_REQUEST['cod_cliente']); } else { $cod_cliente = '0'; }
/* -------------------------------------------------------------------------------------------------------------- */
if ($campo=='producto_plan_terapeutico') {

$sql_producto = "SELECT * FROM tbl15_producto WHERE cod_producto = '$cod_producto'";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($consulta_producto);
 	 	 
$cod_producto_barra              = $datos_producto['cod_producto_barra'];
$nombre_producto                 = $datos_producto['nombre_producto'];
$precio_costo_producto           = $datos_producto['precio_costo_producto'];
$precio_venta_producto           = $datos_producto['precio_venta_producto'];
$nombre_tipo_producto            = $datos_producto['nombre_tipo_producto'];
$nombre_tipo_unidad_medida       = $datos_producto['nombre_tipo_unidad_medida'];
$posologia_cantidad              = $datos_producto['posologia_cantidad'];
$posologia_peso                  = $datos_producto['posologia_peso'];
$nombre_tipo_presentacion        = $datos_producto['nombre_tipo_presentacion'];
$nombre_via_administracion       = $datos_producto['nombre_via_administracion'];
$nombre_frec_duracion            = $datos_producto['nombre_frec_duracion'];

$sql_historia_clinica = "SELECT exa_fis_peso FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_historia_clinica = mysqli_query($conectar, $sql_historia_clinica) or die(mysqli_error($conectar));
$datos_historia_clinica = mysqli_fetch_assoc($consulta_historia_clinica);

$exa_fis_peso                    = $datos_historia_clinica['exa_fis_peso'];
$und_producto                    = ($posologia_cantidad * $exa_fis_peso) / $posologia_peso;

$data_sql = ("UPDATE tbl15_plan_terapeutico SET cod_producto = '$cod_producto', cod_producto_barra = '$cod_producto_barra', nombre_producto = '$nombre_producto', 
precio_costo_producto = '$precio_costo_producto', precio_venta_producto = '$precio_venta_producto', nombre_tipo_producto = '$nombre_tipo_producto', 
nombre_tipo_unidad_medida = '$nombre_tipo_unidad_medida', posologia_cantidad = '$posologia_cantidad', posologia_peso = '$posologia_peso', und_producto = '$und_producto', 
nombre_tipo_presentacion = '$nombre_tipo_presentacion', nombre_via_administracion = '$nombre_via_administracion', nombre_frec_duracion = '$nombre_frec_duracion'
WHERE cod_plan_terapeutico = '$cod_plan_terapeutico'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
elseif ($campo=='exa_fis_peso') {

$sql_producto = "SELECT exa_fis_talla FROM tbl15_historia_clinica WHERE cod_historia_clinica = '$cod_historia_clinica'";
$consulta_producto = mysqli_query($conectar, $sql_producto) or die(mysqli_error($conectar));
$datos_producto = mysqli_fetch_assoc($consulta_producto);

$exa_fis_peso                     = $valor_intro;
$exa_fis_talla                    = $datos_producto['exa_fis_talla'];
$exa_fis_imc                      = round($exa_fis_peso / pow($exa_fis_talla, 2), 2);

if (($exa_fis_imc  < 18.50)) { $exa_fis_interpreimc = "BAJO PESO"; }
if (($exa_fis_imc  >= 18.50) && ($exa_fis_imc  <= 24.99)) { $exa_fis_interpreimc = "PESO NORMAL"; }
if (($exa_fis_imc  >= 25.0) && ($exa_fis_imc  <= 29.99)) { $exa_fis_interpreimc = "SOBREPESO"; }
if (($exa_fis_imc  >= 30.0) && ($exa_fis_imc  <= 34.99)) { $exa_fis_interpreimc = "OBESIDAD I"; }
if (($exa_fis_imc  >= 35.0) && ($exa_fis_imc  <= 39.99)) { $exa_fis_interpreimc = "OBESIDAD II"; }
if (($exa_fis_imc  >= 40.0) && ($exa_fis_imc  <= 49.99)) { $exa_fis_interpreimc = "OBESIDAD III"; }
if (($exa_fis_imc  >= 50.0)) { $exa_fis_interpreimc = "OBESIDAD EXTREMA"; }

$data_sql = ("UPDATE tbl15_historia_clinica SET exa_fis_peso = '$exa_fis_peso', exa_fis_imc = '$exa_fis_imc', exa_fis_interpreimc = '$exa_fis_interpreimc' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------------- */
else {

$data_sql = ("UPDATE tbl15_historia_clinica SET $campo = '$valor_intro' WHERE cod_historia_clinica = '$cod_historia_clinica'");
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if (mysqli_affected_rows($conectar) > 0) { echo "AFECTADO SI"; } else { echo "AFECTADO NO"; }
}
/* -------------------------------------------------------------------------------------------------------------- */
}
?>