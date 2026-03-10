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
$busqueda                = isset($_GET['busqueda']) ? mysqli_real_escape_string($conectar, $_GET['busqueda']) : '';
$filtro_doc              = isset($_GET['filtro_doc']) ? mysqli_real_escape_string($conectar, $_GET['filtro_doc']) : '';
$cod_asesor_filtro       = isset($_GET['cod_asesor']) ? intval($_GET['cod_asesor']) : 0;
$cod_departamento_filtro = isset($_GET['cod_departamento']) ? intval($_GET['cod_departamento']) : 0;
$cod_municipio_filtro    = isset($_GET['cod_municipio']) ? intval($_GET['cod_municipio']) : 0;
$fecha_reg_filtro        = isset($_GET['fecha_registro']) ? mysqli_real_escape_string($conectar, $_GET['fecha_registro']) : '';
$fecha_doc_filtro        = isset($_GET['fecha_documentacion']) ? mysqli_real_escape_string($conectar, $_GET['fecha_documentacion']) : '';
$cod_coordinador_filtro  = isset($_GET['cod_coordinador']) ? intval($_GET['cod_coordinador']) : 0;

// Incluir PHPExcel
require_once dirname(__FILE__) . '/class_php/PHPExcel/PHPExcel.php';

// Crear nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Propiedades del documento
$objPHPExcel->getProperties()
    ->setCreator("Distribuciones AYQ")
    ->setLastModifiedBy("Sistema")
    ->setTitle("Reporte Aliados y Tiendas")
    ->setSubject("Reporte")
    ->setDescription("Reporte generado por el sistema")
    ->setKeywords("excel aliados tiendas")
    ->setCategory("Reportes");

// Estilos
$estilo_cabecera = array('font' => array('bold' => true, 'color' => array('rgb' => 'FFFFFF')), 'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '8b5cf6')), 'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));

// Cabeceras
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'FECHA DESCARGA')
    ->setCellValue('B1', 'FECHA VISITA')
    ->setCellValue('C1', 'ID ASESOR')
    ->setCellValue('D1', 'NOMBRE ASESOR')
    ->setCellValue('E1', 'CORREO ASESOR')
    ->setCellValue('F1', 'TEL ASESOR')
    ->setCellValue('G1', 'ID ALIADO')
    ->setCellValue('H1', 'NIT ALIADO')
    ->setCellValue('I1', 'NOMBRE ALIADO')
    ->setCellValue('J1', 'TEL ALIADO')
    ->setCellValue('K1', 'ID TIENDA')
    ->setCellValue('L1', 'NOMBRE TIENDA')
    ->setCellValue('M1', 'TEL TIENDA')
    ->setCellValue('N1', 'CORREO TIENDA')
    ->setCellValue('O1', 'DIRECCION TIENDA')
    ->setCellValue('P1', 'BARRIO TIENDA')
    ->setCellValue('Q1', 'SECTOR QUE PERTENECE')
    ->setCellValue('R1', 'DEPARTAMENTO')
    ->setCellValue('S1', 'MUNICIPIO')
    ->setCellValue('T1', 'FOTOS TIENDA');
// Aplicar estilos a cabeceras
foreach(range('A','T') as $columnID) {
    $objPHPExcel->getActiveSheet()->getStyle($columnID.'1')->applyFromArray($estilo_cabecera);
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}

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

$row_num = 2;
while ($row = mysqli_fetch_assoc($resultado)) {
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$row_num, date("Y-m-d H:i:s"))
        ->setCellValue('B'.$row_num, $row['fecha_visita'])
        ->setCellValue('C'.$row_num, $row['id_asesor'])
        ->setCellValue('D'.$row_num, $row['nombre_asesor'])
        ->setCellValue('E'.$row_num, $row['correo_asesor'])
        ->setCellValue('F'.$row_num, $row['tel_asesor'])
        ->setCellValue('G'.$row_num, $row['id_aliado'])
        ->setCellValue('H'.$row_num, $row['nit_aliado'])
        ->setCellValue('I'.$row_num, $row['nombre_aliado'])
        ->setCellValue('J'.$row_num, $row['tel_aliado'])
        ->setCellValue('K'.$row_num, $row['id_tienda'])
        ->setCellValue('L'.$row_num, $row['nombre_tienda'])
        ->setCellValue('M'.$row_num, $row['tel_tienda'])
        ->setCellValue('N'.$row_num, $row['correo_tienda'])
        ->setCellValue('O'.$row_num, $row['direccion_tienda'])
        ->setCellValue('P'.$row_num, $row['barrio_tienda'])
        ->setCellValue('Q'.$row_num, $row['sector'])
        ->setCellValue('R'.$row_num, $row['departamento'])
        ->setCellValue('S'.$row_num, $row['municipio']);
    // Procesar las 3 fotos en una sola celda con saltos de línea
    $fotos_arr = [];
    if (!empty($row['foto_fachada'])) $fotos_arr[] = "FACHADA";
    if (!empty($row['foto_interna'])) $fotos_arr[] = "INTERNA";
    if (!empty($row['foto_selfie']))  $fotos_arr[] = "SELFIE";
    
    $fotos_texto = !empty($fotos_arr) ? implode("\n", $fotos_arr) : "Sin fotos";
    
    $objPHPExcel->getActiveSheet()->setCellValue('T'.$row_num, $fotos_texto);
    $objPHPExcel->getActiveSheet()->getStyle('T'.$row_num)->getAlignment()->setWrapText(true);
    
    // Excel solo permite un link por celda de texto; usamos la primera foto disponible como destino.
    $url_principal = "";
    if (!empty($row['foto_fachada'])) $url_principal = "http://" . $_SERVER['HTTP_HOST'] . "/sistemaseditaxe/mysqli/distribucionesayqapp/" . $row['foto_fachada'];
    elseif (!empty($row['foto_interna'])) $url_principal = "http://" . $_SERVER['HTTP_HOST'] . "/sistemaseditaxe/mysqli/distribucionesayqapp/" . $row['foto_interna'];
    elseif (!empty($row['foto_selfie'])) $url_principal = "http://" . $_SERVER['HTTP_HOST'] . "/sistemaseditaxe/mysqli/distribucionesayqapp/" . $row['foto_selfie'];

    if (!empty($url_principal)) {
        $objPHPExcel->getActiveSheet()->getCell('T'.$row_num)->getHyperlink()->setUrl($url_principal);
        $objPHPExcel->getActiveSheet()->getStyle('T'.$row_num)->getFont()->getColor()->setRGB('0000FF');
        $objPHPExcel->getActiveSheet()->getStyle('T'.$row_num)->getFont()->setUnderline(true);
    }
    $row_num++;
}
// Nombre del archivo
$fecha_descarga = date("Y-m-d_H-i-s");
$nombre_archivo = "REPORTE_ALIADOS_TIENDAS_" . $fecha_descarga . ".xlsx";
// Redirigir salida al navegador
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$nombre_archivo.'"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
