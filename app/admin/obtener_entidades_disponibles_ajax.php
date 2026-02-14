<?php
include_once('../conexiones/conexione.php'); 
include_once('../admin/class_php/funcion_cryptor_descryptor_class.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");
include ("../session/funciones_admin.php");
if (verificar_usuario()){ } else { header("Location:../index.php"); }

// Verificar sesión
if (!isset($_SESSION["cod_administrador"])) { echo json_encode(['success' => false, 'mensaje' => 'Sesión no válida']); exit; }
$cod_administrador = isset($_POST['cod_administrador']) ? mysqli_real_escape_string($conectar, $_POST['cod_administrador']) : '';
if (empty($cod_administrador)) { echo json_encode(['success' => false, 'mensaje' => 'Falta el código de administrador']); exit; }

// Consultar entidades que NO están asignadas a este aliado
$sql = "SELECT ec.cod_entidad_crediticia, ec.nombre_entidad_crediticia, ec.url_pagina_web_consulta, ec.aliado_estrategico_interes_ptj
FROM tbl15_entidad_crediticia ec
WHERE ec.cod_estado = '1'
AND ec.cod_entidad_crediticia NOT IN (SELECT peca.cod_entidad_crediticia FROM tbl15_parametrizacion_entidad_crediticia_aliado peca WHERE peca.cod_aliado_estrategico = '$cod_administrador' AND peca.cod_estado = '1')
ORDER BY ec.cod_posicion ASC";
$resultado = mysqli_query($conectar, $sql);

if (!$resultado) {
    error_log("Error en consulta obtener_entidades_disponibles_ajax.php: " . mysqli_error($conectar));
    echo json_encode(['success' => false, 'mensaje' => 'Error en la consulta a la base de datos']);
    exit;
}

$entidades = [];
while ($row = mysqli_fetch_assoc($resultado)) {
    $entidades[] = ['cod_entidad_crediticia' => $row['cod_entidad_crediticia'], 'nombre_entidad_crediticia' => $row['nombre_entidad_crediticia'], 'url_pagina_web_consulta' => $row['url_pagina_web_consulta'], 'aliado_estrategico_interes_ptj' => $row['aliado_estrategico_interes_ptj']];
}

echo json_encode(['success' => true, 'entidades' => $entidades, 'count' => count($entidades)]);
mysqli_close($conectar);
?>
