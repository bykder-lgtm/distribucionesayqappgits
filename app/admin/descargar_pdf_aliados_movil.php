<?php
error_reporting(0);
require_once('../conexiones/conexione.php');
include_once('../evitar_mensaje_error/error.php');
date_default_timezone_set("America/Bogota");

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Verificar si el usuario está logueado
$cod_administrador_logueado = $_SESSION['cod_administrador'];
if (empty($cod_administrador_logueado)) {    die("Acceso denegado. Por favor, inicie sesión."); }

// Capturar parámetros de filtros si existen
$busqueda               = isset($_GET['busqueda']) ? mysqli_real_escape_string($conectar, $_GET['busqueda']) : '';
$filtro_doc             = isset($_GET['filtro_doc']) ? mysqli_real_escape_string($conectar, $_GET['filtro_doc']) : '';
$cod_asesor_filtro      = isset($_GET['cod_asesor']) ? intval($_GET['cod_asesor']) : 0;
$cod_departamento_filtro = isset($_GET['cod_departamento']) ? intval($_GET['cod_departamento']) : 0;
$cod_municipio_filtro    = isset($_GET['cod_municipio']) ? intval($_GET['cod_municipio']) : 0;
$fecha_reg_filtro       = isset($_GET['fecha_registro']) ? mysqli_real_escape_string($conectar, $_GET['fecha_registro']) : '';
$fecha_doc_filtro       = isset($_GET['fecha_documentacion']) ? mysqli_real_escape_string($conectar, $_GET['fecha_documentacion']) : '';
$cod_coordinador_filtro = isset($_GET['cod_coordinador']) ? intval($_GET['cod_coordinador']) : 0;

// Consulta SQL optimizada
$sql = "SELECT NOW() as fecha_descarga, aliado.fecha as fecha_visita, asesor.cod_administrador as id_asesor, asesor.nombres_apellidos_tercero as nombre_asesor,
asesor.correo as correo_asesor, asesor.telefono as tel_asesor, aliado.cod_administrador as id_aliado, aliado.nit_razon_social as nit_aliado,
aliado.nombres_apellidos_tercero as nombre_aliado, aliado.telefono as tel_aliado, tienda.cod_tienda as id_tienda, tienda.nombre_tienda as nombre_tienda,
tienda.telefono1_tercero as tel_tienda, tienda.correo_tercero as correo_tienda, tienda.direccion_tercero as direccion_tienda,
tienda.barrio_tercero as barrio_tienda, sector.nombre_tipo_sector as sector, depto.nombre_departamento as departamento,
muni.nombre_municipio as municipio, tienda.url_img_fachada_tienda as foto_fachada, 
tienda.url_img_interna_tienda as foto_interna, tienda.url_img_selfieadmin_tienda as foto_selfie
FROM tbl15_administrador aliado
LEFT JOIN tbl15_tienda tienda ON aliado.cod_administrador = tienda.cod_aliado_estrategico
LEFT JOIN tbl15_administrador asesor ON aliado.cod_asesor = asesor.cod_administrador
LEFT JOIN tbl15_tipo_sector sector ON aliado.cod_tipo_sector = sector.cod_tipo_sector
LEFT JOIN tbl15_departamento depto ON (tienda.cod_departamento = depto.cod_departamento OR (tienda.cod_departamento IS NULL AND aliado.cod_departamento = depto.cod_departamento))
LEFT JOIN tbl15_municipio muni ON (tienda.cod_municipio = muni.cod_municipio OR (tienda.cod_municipio IS NULL AND aliado.cod_municipio = muni.cod_municipio))
WHERE aliado.cod_seguridad = '23' AND aliado.cod_estado != '0' AND aliado.cod_estado_activacion_usuario != '3'
AND (aliado.cod_lider = '$cod_administrador_logueado' OR 
aliado.cod_coordinador IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador_logueado') OR 
aliado.cod_asesor IN (SELECT c.cod_administrador FROM tbl15_administrador c WHERE c.cod_lider = '$cod_administrador_logueado'))";

if (!empty($busqueda)) { 
    $sql .= " AND (aliado.cod_administrador = '$busqueda' OR aliado.cedula LIKE '%$busqueda%' OR aliado.nombres_apellidos_tercero LIKE '%$busqueda%' OR aliado.nombres LIKE '%$busqueda%' OR aliado.apellidos LIKE '%$busqueda%' OR aliado.nit_razon_social LIKE '%$busqueda%' OR aliado.nombre_razon_social LIKE '%$busqueda%' OR aliado.barrio_tercero LIKE '%$busqueda%' OR tienda.nombre_tienda LIKE '%$busqueda%')"; 
}
if ($cod_asesor_filtro > 0) { $sql .= " AND aliado.cod_asesor = '$cod_asesor_filtro'"; }
if ($cod_departamento_filtro > 0) { $sql .= " AND (tienda.cod_departamento = '$cod_departamento_filtro' OR (tienda.cod_departamento IS NULL AND aliado.cod_departamento = '$cod_departamento_filtro'))"; }
if ($cod_municipio_filtro > 0) { $sql .= " AND (tienda.cod_municipio = '$cod_municipio_filtro' OR (tienda.cod_municipio IS NULL AND aliado.cod_municipio = '$cod_municipio_filtro'))"; }
if ($cod_coordinador_filtro > 0) { $sql .= " AND aliado.cod_coordinador = '$cod_coordinador_filtro'"; }
if (!empty($fecha_reg_filtro)) { $sql .= " AND DATE(aliado.fecha) = '$fecha_reg_filtro'"; }
if (!empty($fecha_doc_filtro)) { $sql .= " AND DATE(aliado.fecha_documentacion) = '$fecha_doc_filtro'"; }

if ($filtro_doc == '1') {
    $sql .= " AND (aliado.url_documentacion_rut_aliado != '' OR aliado.url_documentacion_camaracomercio_aliado != '' OR (aliado.url_documentacion_cedula_aliado IS NOT NULL AND aliado.url_documentacion_cedula_aliado != ''))";
} elseif ($filtro_doc == '2') {
    $sql .= " AND (aliado.url_documentacion_rut_aliado != '' AND aliado.url_documentacion_camaracomercio_aliado != '' AND (aliado.url_documentacion_cedula_aliado IS NOT NULL AND aliado.url_documentacion_cedula_aliado != ''))";
} elseif ($filtro_doc == '3') {
    $sql .= " AND (aliado.url_documentacion_rut_aliado = '' AND aliado.url_documentacion_camaracomercio_aliado = '' AND (aliado.url_documentacion_cedula_aliado IS NULL OR aliado.url_documentacion_cedula_aliado = ''))";
}

$sql .= " GROUP BY aliado.cod_administrador";
$sql .= " ORDER BY aliado.cod_administrador DESC";

$resultado = mysqli_query($conectar, $sql) or die(mysqli_error($conectar));

// Incluir mPDF
include_once('mpdf/mpdf.php');

$mpdf = new mPDF('c', 'A4-L'); // Landscape for many columns
$mpdf->SetTitle("Reporte Aliados y Tiendas");

$html = '
<style>
    body { font-family: sans-serif; font-size: 8pt; }
    table { width: 100%; border-collapse: collapse; border: 1px solid #ccc; }
    th { background-color: #8b5cf6; color: #fff; padding: 5px; border: 1px solid #ccc; }
    td { padding: 5px; border: 1px solid #ccc; }
    .header { text-align: center; margin-bottom: 20px; }
    .header h2 { color: #8b5cf6; margin: 0; }
    .date { text-align: right; margin-bottom: 10px; font-style: italic; }
</style>

<div class="header">
    <h2>REPORTE DE ALIADOS Y TIENDAS</h2>
    <p>Distribuciones AYQ - Sistema de Gestión</p>
</div>

<div class="date">Fecha de descarga: '.date("Y-m-d H:i:s").'</div>

<table>
    <thead>
        <tr>
            <th>VISITA</th>
            <th>ASESOR</th>
            <th>ALIADO</th>
            <th>TIENDA</th>
            <th>TELÉFONO</th>
            <th>DIRECCIÓN / BARRIO</th>
            <th>UBICACIÓN</th>
            <th>SECTOR</th>
            <th>FOTOS TIENDA</th>
        </tr>
    </thead>
    <tbody>';

while ($row = mysqli_fetch_assoc($resultado)) {
    $ubicacion = $row['municipio'] . ', ' . $row['departamento'];
    $direccion = $row['direccion_tienda'] . ($row['barrio_tienda'] ? ' - ' . $row['barrio_tienda'] : '');
    
    $html .= '
        <tr>
            <td style="text-align:center;">'.$row['fecha_visita'].'</td>
            <td>'.($row['nombre_asesor'] ? $row['nombre_asesor'] : 'N/A').'</td>
            <td>'.$row['nombre_aliado'].'<br><small>NIT: '.$row['nit_aliado'].'</small></td>
            <td>'.$row['nombre_tienda'].'</td>
            <td>'.$row['tel_tienda'].'</td>
            <td>'.$direccion.'</td>
            <td>'.$ubicacion.'</td>
            <td>'.$row['sector'].'</td>
            <td style="text-align:center;">
                '.(!empty($row['foto_fachada']) ? '<div><a href="http://'.$_SERVER['HTTP_HOST'].'/sistemaseditaxe/mysqli/distribucionesayqapp/'.$row['foto_fachada'].'" style="color:#8b5cf6; text-decoration:none;">FACHADA</a></div>' : '').'
                '.(!empty($row['foto_interna']) ? '<div><a href="http://'.$_SERVER['HTTP_HOST'].'/sistemaseditaxe/mysqli/distribucionesayqapp/'.$row['foto_interna'].'" style="color:#8b5cf6; text-decoration:none;">INTERNA</a></div>' : '').'
                '.(!empty($row['foto_selfie']) ? '<div><a href="http://'.$_SERVER['HTTP_HOST'].'/sistemaseditaxe/mysqli/distribucionesayqapp/'.$row['foto_selfie'].'" style="color:#8b5cf6; text-decoration:none;">SELFIE</a></div>' : (empty($row['foto_fachada']) && empty($row['foto_interna']) ? '---' : '')).'
            </td>
        </tr>';
}

$html .= '
    </tbody>
</table>';

$mpdf->WriteHTML($html);

// Nombre del archivo
$fecha_descarga = date("Y-m-d_H-i-s");
$nombre_archivo = "REPORTE_ALIADOS_TIENDAS_" . $fecha_descarga . ".pdf";

$mpdf->Output($nombre_archivo, 'D');
exit;
