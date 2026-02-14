<?php
/**
 * AJAX: Obtener datos completos del crédito para el modal de detalle móvil
 * Retorna: JSON con información de equipo de gestión, comercial y adicional
 */
session_start();
include("../conexion/conexion.php");

header('Content-Type: application/json; charset=utf-8');
// Verificar sesión
if (!isset($_SESSION['cod_administrador'])) { echo json_encode(['success' => false, 'message' => 'Sesión no válida']); exit; }
// Obtener código del crédito
$cod_info_factura_venta = isset($_GET['cod']) ? intval($_GET['cod']) : 0;
if ($cod_info_factura_venta <= 0) { echo json_encode(['success' => false, 'message' => 'Código de crédito inválido']); exit; }
// Consulta principal
$sql = "SELECT ifv.*, ter.observacion_tercero FROM tbl15_info_factura_venta ifv LEFT JOIN tbl15_tercero ter ON ifv.cod_tercero = ter.cod_tercero WHERE ifv.cod_info_factura_venta = '$cod_info_factura_venta'";
$resultado = mysqli_query($conectar, $sql);
if (!$resultado || mysqli_num_rows($resultado) == 0) { echo json_encode(['success' => false, 'message' => 'Crédito no encontrado']); exit; }
$datos = mysqli_fetch_assoc($resultado);
// Obtener Líder
$lider = "No especificado";
if (!empty($datos['cod_administrador_lider'])) {
    $sql_lider = "SELECT nombres, apellidos FROM tbl15_administrador WHERE cod_administrador = '{$datos['cod_administrador_lider']}'";
    $res_lider = mysqli_query($conectar, $sql_lider);
    if ($res_lider && mysqli_num_rows($res_lider) > 0) { $d = mysqli_fetch_assoc($res_lider); $lider = trim($d['nombres'] . ' ' . $d['apellidos']); }
}
// Obtener Coordinador
$coordinador = "No especificado";
if (!empty($datos['cod_administrador_coordinador'])) {
    $sql_coord = "SELECT nombres, apellidos FROM tbl15_administrador WHERE cod_administrador = '{$datos['cod_administrador_coordinador']}'";
    $res_coord = mysqli_query($conectar, $sql_coord);
    if ($res_coord && mysqli_num_rows($res_coord) > 0) { $d = mysqli_fetch_assoc($res_coord); $coordinador = trim($d['nombres'] . ' ' . $d['apellidos']); }
}
// Obtener Asesor
$asesor = "No especificado";
if (!empty($datos['cod_administrador_asesor'])) {
    $sql_asesor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE cod_administrador = '{$datos['cod_administrador_asesor']}'";
    $res_asesor = mysqli_query($conectar, $sql_asesor);
    if ($res_asesor && mysqli_num_rows($res_asesor) > 0) { $d = mysqli_fetch_assoc($res_asesor); $asesor = trim($d['nombres'] . ' ' . $d['apellidos']); }
}
// Obtener Aliado Estratégico
$aliado = "No especificado";
if (!empty($datos['cod_administrador_aliado_estrategico'])) {
    $sql_aliado = "SELECT nombres, apellidos FROM tbl15_administrador WHERE cod_administrador = '{$datos['cod_administrador_aliado_estrategico']}'";
    $res_aliado = mysqli_query($conectar, $sql_aliado);
    if ($res_aliado && mysqli_num_rows($res_aliado) > 0) { $d = mysqli_fetch_assoc($res_aliado); $aliado = trim($d['nombres'] . ' ' . $d['apellidos']); }
}
// Obtener Operador del Crédito
$operador = "No especificado";
if (!empty($datos['cod_operador_credito'])) {
    $sql_operador = "SELECT nombre_operador_credito FROM tbl15_operador_credito WHERE cod_operador_credito = '{$datos['cod_operador_credito']}'";
    $res_operador = mysqli_query($conectar, $sql_operador);
    if ($res_operador && mysqli_num_rows($res_operador) > 0) { $d = mysqli_fetch_assoc($res_operador); $operador = $d['nombre_operador_credito']; }
}
// Obtener Vendedor
$vendedor = "No especificado";
if (!empty($datos['cod_vendedor'])) {
    $sql_vendedor = "SELECT nombres, apellidos FROM tbl15_vendedor WHERE cod_vendedor = '{$datos['cod_vendedor']}'";
    $res_vendedor = mysqli_query($conectar, $sql_vendedor);
    if ($res_vendedor && mysqli_num_rows($res_vendedor) > 0) { $d = mysqli_fetch_assoc($res_vendedor); $vendedor = trim($d['nombres'] . ' ' . $d['apellidos']); }
}
// Obtener Tipo de Venta (Tipo de Pago)
$tipo_venta = "No especificado";
if (!empty($datos['cod_tipo_pago'])) {
    $sql_tipo_pago = "SELECT nombre_tipo_pago FROM tbl15_tipo_pago WHERE cod_tipo_pago = '{$datos['cod_tipo_pago']}'";
    $res_tipo_pago = mysqli_query($conectar, $sql_tipo_pago);
    if ($res_tipo_pago && mysqli_num_rows($res_tipo_pago) > 0) { $d = mysqli_fetch_assoc($res_tipo_pago); $tipo_venta = $d['nombre_tipo_pago']; }
}
// Obtener Revisor (Back Office)
$revisor = "No especificado";
if (!empty($datos['cod_administrador_revisor'])) {
    $sql_revisor = "SELECT nombres, apellidos FROM tbl15_administrador WHERE cod_administrador = '{$datos['cod_administrador_revisor']}'";
    $res_revisor = mysqli_query($conectar, $sql_revisor);
    if ($res_revisor && mysqli_num_rows($res_revisor) > 0) { $d = mysqli_fetch_assoc($res_revisor); $revisor = trim($d['nombres'] . ' ' . $d['apellidos']); }
}
// Obtener Cuenta de Banco
$banco = "No especificado";
if (!empty($datos['cod_banco_cuenta'])) {
    $sql_banco = "SELECT nombre_banco_cuenta FROM tbl15_banco_cuenta WHERE cod_banco_cuenta = '{$datos['cod_banco_cuenta']}'";
    $res_banco = mysqli_query($conectar, $sql_banco);
    if ($res_banco && mysqli_num_rows($res_banco) > 0) { $d = mysqli_fetch_assoc($res_banco); $banco = $d['nombre_banco_cuenta']; }
}
// Respuesta JSON
echo json_encode([
    'success' => true,
    'data' => [
        'lider' => $lider ?: "No especificado",
        'coordinador' => $coordinador ?: "No especificado",
        'asesor' => $asesor ?: "No especificado",
        'aliado' => $aliado ?: "No especificado",
        'revisor' => $revisor ?: "No especificado",
        'operador' => $operador ?: "No especificado",
        'vendedor' => $vendedor ?: "No especificado",
        'tipo_venta' => $tipo_venta ?: "No especificado",
        'banco' => $banco ?: "No especificado",
        'observaciones' => $datos['observacion_tercero'] ?: "Sin observaciones"
    ]
]);
?>
