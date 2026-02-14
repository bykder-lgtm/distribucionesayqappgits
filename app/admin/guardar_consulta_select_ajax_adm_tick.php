<?php
include_once('../conexiones/conexione.php'); 
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
// ------------------------------------------------------------------------------------------------- //
$tipo_ajax                 = mysqli_real_escape_string($conectar,(($_POST['tipo_ajax'])));
$campo                     = mysqli_real_escape_string($conectar,(($_POST['campo'])));
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($_POST['valor'] <> '') && ($campo=='nombre_categoria') && ($tipo_ajax=='nombre_categoria')) {
$nombre_categoria                    = mysqli_real_escape_string($conectar,(strtoupper($_POST['valor'])));

$obtener_existencia = "SELECT nombre_categoria FROM tbl15_categoria WHERE nombre_categoria = '".($nombre_categoria)."'";
$consultar_existencia = mysqli_query($conectar, $obtener_existencia) or die(mysqli_error($conectar));
$info_existencia = mysqli_fetch_assoc($consultar_existencia);

if ($info_existencia==0) {
$data_sql = "INSERT INTO tbl15_categoria (nombre_categoria) VALUE (\"$nombre_categoria\")";
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "GUARDADO"; } else { echo "NO GUARDADO"; }
} else { echo $nombre_categoria.", YA ESTA REGISTRADO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($_POST['valor'] <> '') && ($campo=='nombre_marca') && ($tipo_ajax=='nombre_marca')) {
$nombre_marca                    = mysqli_real_escape_string($conectar,(strtoupper($_POST['valor'])));

$obtener_existencia = "SELECT nombre_marca FROM tbl15_marca WHERE nombre_marca = '".($nombre_marca)."'";
$consultar_existencia = mysqli_query($conectar, $obtener_existencia) or die(mysqli_error($conectar));
$info_existencia = mysqli_fetch_assoc($consultar_existencia);

if ($info_existencia==0) {
$data_sql = "INSERT INTO tbl15_marca (nombre_marca) VALUE (\"$nombre_marca\")";
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "GUARDADO"; } else { echo "NO GUARDADO"; }
} else { echo $nombre_marca.", YA ESTA REGISTRADO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($_POST['valor'] <> '') && ($campo=='nombre_tipo_aplicacion') && ($tipo_ajax=='nombre_tipo_aplicacion')) {
$nombre_tipo_aplicacion                    = mysqli_real_escape_string($conectar,(strtoupper($_POST['valor'])));

$obtener_existencia = "SELECT nombre_tipo_aplicacion FROM tbl15_tipo_aplicacion WHERE nombre_tipo_aplicacion = '".($nombre_tipo_aplicacion)."'";
$consultar_existencia = mysqli_query($conectar, $obtener_existencia) or die(mysqli_error($conectar));
$info_existencia = mysqli_fetch_assoc($consultar_existencia);

if ($info_existencia==0) {
$data_sql = "INSERT INTO tbl15_tipo_aplicacion (nombre_tipo_aplicacion) VALUE (\"$nombre_tipo_aplicacion\")";
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "GUARDADO"; } else { echo "NO GUARDADO"; }
} else { echo $nombre_tipo_aplicacion.", YA ESTA REGISTRADO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($_POST['valor'] <> '') && ($campo=='nombre_tipo_referencia') && ($tipo_ajax=='nombre_tipo_referencia')) {
$nombre_tipo_referencia                    = mysqli_real_escape_string($conectar,(strtoupper($_POST['valor'])));

$obtener_existencia = "SELECT nombre_tipo_referencia FROM tbl15_tipo_referencia WHERE nombre_tipo_referencia = '".($nombre_tipo_referencia)."'";
$consultar_existencia = mysqli_query($conectar, $obtener_existencia) or die(mysqli_error($conectar));
$info_existencia = mysqli_fetch_assoc($consultar_existencia);

if ($info_existencia==0) {
$data_sql = "INSERT INTO tbl15_tipo_referencia (nombre_tipo_referencia) VALUE (\"$nombre_tipo_referencia\")";
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "GUARDADO"; } else { echo "NO GUARDADO"; }
} else { echo $nombre_tipo_referencia.", YA ESTA REGISTRADO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($_POST['valor'] <> '') && ($campo=='nombre_promocion') && ($tipo_ajax=='nombre_promocion')) {
$nombre_promocion                    = mysqli_real_escape_string($conectar,(strtoupper($_POST['valor'])));

$obtener_existencia = "SELECT nombre_promocion FROM tbl15_promocion WHERE nombre_promocion = '".($nombre_promocion)."'";
$consultar_existencia = mysqli_query($conectar, $obtener_existencia) or die(mysqli_error($conectar));
$info_existencia = mysqli_fetch_assoc($consultar_existencia);

if ($info_existencia==0) {
$data_sql = "INSERT INTO tbl15_promocion (nombre_promocion) VALUE (\"$nombre_promocion\")";
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "GUARDADO"; } else { echo "NO GUARDADO"; }
} else { echo $nombre_promocion.", YA ESTA REGISTRADO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($_POST['valor'] <> '') && ($campo=='nombre_estado') && ($tipo_ajax=='nombre_estado')) {
$nombre_estado                    = mysqli_real_escape_string($conectar,(strtoupper($_POST['valor'])));

$obtener_existencia = "SELECT nombre_estado FROM tbl15_estado WHERE nombre_estado = '".($nombre_estado)."'";
$consultar_existencia = mysqli_query($conectar, $obtener_existencia) or die(mysqli_error($conectar));
$info_existencia = mysqli_fetch_assoc($consultar_existencia);

if ($info_existencia==0) {
$data_sql = "INSERT INTO tbl15_estado (nombre_estado) VALUE (\"$nombre_estado\")";
$exec_data = mysqli_query($conectar, $data_sql) or die(mysqli_error($conectar));

if ( mysqli_affected_rows($conectar) > 0) { echo "GUARDADO"; } else { echo "NO GUARDADO"; }
} else { echo $nombre_estado.", YA ESTA REGISTRADO"; }
}
// ------------------------------------------------------------------------------------------------- //
// ------------------------------------------------------------------------------------------------- //
if (($_POST['valor'] <> '') && ($campo=='cod_recurso') && ($tipo_ajax=='cosnsulta')) {
$cod_recurso                    = intval($_POST['valor']);

$obtener_recurso = "SELECT nombre_recurso, descripcion_recurso FROM tbl15_recurso WHERE cod_recurso = '".($cod_recurso)."'";
$consultar_recurso = mysqli_query($conectar, $obtener_recurso) or die(mysqli_error($conectar));
$info_recurso = mysqli_fetch_assoc($consultar_recurso);

$nombre_campanya                = $info_recurso['nombre_recurso'];
$descripcion_campanya           = $info_recurso['descripcion_recurso'];

echo $nombre_campanya."|||".$descripcion_campanya;
}
?>