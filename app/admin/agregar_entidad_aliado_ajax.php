<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); }

// Verificar sesión
if (!isset($_SESSION["cod_administrador"])) { echo json_encode([ 'success' => false, 'mensaje' => 'Sesión no válida']); exit; }

// Obtener datos del POST
$cod_administrador = isset($_POST['cod_administrador']) ? mysqli_real_escape_string($conectar, $_POST['cod_administrador']) : '';
$cod_entidad_crediticia = isset($_POST['cod_entidad_crediticia']) ? mysqli_real_escape_string($conectar, $_POST['cod_entidad_crediticia']) : '';
$interes_ptj = isset($_POST['interes_ptj']) ? mysqli_real_escape_string($conectar, $_POST['interes_ptj']) : '0';
$cod_estado_entrar_portal = isset($_POST['cod_estado_entrar_portal']) ? '1' : '0';
$url_pagina_web_consulta = isset($_POST['url_pagina_web_consulta']) ? mysqli_real_escape_string($conectar, $_POST['url_pagina_web_consulta']) : '';
// Validaciones
if (empty($cod_administrador)) { echo json_encode(['success' => false, 'mensaje' => 'Falta el código de administrador']); exit; }
if (empty($cod_entidad_crediticia)) { echo json_encode(['success' => false, 'mensaje' => 'Debe seleccionar una entidad crediticia']); exit; }

// Obtener el nombre de la entidad crediticia
$sql_entidad = "SELECT nombre_entidad_crediticia, cod_posicion FROM tbl15_entidad_crediticia WHERE cod_entidad_crediticia = '$cod_entidad_crediticia'";
$resultado_entidad = mysqli_query($conectar, $sql_entidad);

if (!$resultado_entidad || mysqli_num_rows($resultado_entidad) == 0) { echo json_encode(['success' => false, 'mensaje' => 'Entidad crediticia no encontrada']); exit; }

$row_entidad = mysqli_fetch_assoc($resultado_entidad);
$nombre_entidad_crediticia = $row_entidad['nombre_entidad_crediticia'];
$cod_posicion = $row_entidad['cod_posicion'];
// Verificar si ya existe la parametrización (por si acaso)
$sql_verificar = "SELECT cod_parametrizacion_entidad_crediticia_aliado FROM tbl15_parametrizacion_entidad_crediticia_aliado WHERE cod_aliado_estrategico = '$cod_administrador' AND cod_entidad_crediticia = '$cod_entidad_crediticia' AND cod_estado = '1'";
$resultado_verificar = mysqli_query($conectar, $sql_verificar);

if ($resultado_verificar && mysqli_num_rows($resultado_verificar) > 0) { echo json_encode(['success' => false, 'mensaje' => 'Esta entidad ya está asignada a este aliado']); exit; }

// Obtener el cod_administardor (asesor) del aliado (usuario que está en sesión)
$cod_administardor_sesion = $_SESSION["cod_administrador"];

// Insertar la nueva parametrización
$sql_insertar = "INSERT INTO tbl15_parametrizacion_entidad_crediticia_aliado (
cod_administardor, cod_aliado_estrategico, cod_entidad_crediticia, nombre_entidad_crediticia, cod_posicion, interes_ptj, aval_ptj, cod_estado_entrar_portal, url_pagina_web_consulta, fecha_creacion, cod_estado) 
VALUES ('$cod_administardor_sesion', '$cod_administrador', '$cod_entidad_crediticia', '$nombre_entidad_crediticia', '$cod_posicion', '$interes_ptj', '0', '$cod_estado_entrar_portal', '$url_pagina_web_consulta', NOW(), '1')";
$resultado_insertar = mysqli_query($conectar, $sql_insertar);

if (!$resultado_insertar) { error_log("Error al insertar en agregar_entidad_aliado_ajax.php: " . mysqli_error($conectar)); echo json_encode(['success' => false, 'mensaje' => 'Error al guardar la entidad: ' . mysqli_error($conectar)]); exit; }

// Obtener el ID insertado
$cod_parametrizacion_insertado = mysqli_insert_id($conectar);

echo json_encode(['success' => true, 'mensaje' => 'Entidad agregada correctamente', 'cod_parametrizacion_entidad_crediticia_aliado' => $cod_parametrizacion_insertado, 'cod_entidad_crediticia' => $cod_entidad_crediticia, 'nombre_entidad_crediticia' => $nombre_entidad_crediticia]);
mysqli_close($conectar);
?>
